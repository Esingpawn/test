<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18 
 * 会员model
 */
if (!defined('IN_IA')) {
	exit('Access Denied');
}
class Member_FxModel {
	public function getInfo() {
		global $_W, $_GPC;
		
		if ($_W['isajax']) return;
		
		$userinfo = array();
		if (isset($_SESSION['userinfo'])) {
			$userinfo = iunserializer(base64_decode($_SESSION['userinfo']));
			if (empty($userinfo['nickname']) || empty($userinfo['avatar'])) {
				unset($_SESSION['userinfo']);
			}
		}
		
		if (!empty($_W['fans']['nickname']) && $_W['fans']['nickname']!='微信用户') {
			return;
		}
		
		if ($_W['fans']['nickname']=='微信用户') {
			$temp_uid = pdo_fetchcolumn("SELECT uid FROM ".tablename('mc_mapping_fans').' WHERE uniacid=:uniacid and openid=:openid and nickname=:nickname',
			array('uniacid' => $_W['uniacid'], ':openid' => $_W['fans']['openid'], ':nickname' => '微信用户'));
			if (!empty($temp_uid)) {				
				pdo_delete('mc_mapping_fans', array('uniacid' => $_W['uniacid'], 'openid' => $_W['fans']['openid']));
				pdo_delete('mc_members', array('uniacid' => $_W['uniacid'], 'uid' => $temp_uid));
				cache_build_memberinfo($temp_uid);
			}
			unset($_SESSION['userinfo']);
		}
		
		$userinfo = mc_oauth_userinfo();
		$uid = mc_openid2uid($userinfo['openid']);
		if ($uid && $uid != $_SESSION['uid']) {
			$_SESSION['uid'] = $uid;
			header('Location: ' . $_W['siteurl']);
			exit;
		}
		$member = pdo_get('mc_members', array('uniacid' => $_W['uniacid'], 'uid' => $uid), array('nickname', 'avatar'));
		if (empty($member)) {
			$uid = $_W['fans']['uid'] = $this->autoRegister($userinfo);
		} else {
			mc_update($uid, array('nickname' => $userinfo['nickname'],'avatar' => $userinfo['avatar']));
			cache_build_memberinfo($uid);
		}
		if (!empty($_W['fans']['uid']) && !empty($userinfo['nickname'])) {
			pdo_update('mc_mapping_fans', array(
				'nickname'=>$userinfo['nickname'],
				'tag' => base64_encode(iserializer($userinfo))
			), array('fanid'=>$_W['fans']['fanid']));
		}
		return $userinfo;
	}
	//根据openid，获取会员信息
	public function getMember($openid = '') {
		global $_W, $_GPC;
		$uid = mc_openid2uid($openid);		
		$member = mc_fetch($uid);
		if (empty($member['nickname']) || empty($member['avatar'])) {
			$member = pdo_get('mc_members', array('uniacid' => $_W['uniacid'], 'uid' => $uid));
		}
		$fan = mc_fansinfo($uid);		
		$member['follow'] = $fan['follow'];
		$member['openid'] = $fan['openid'];	
		$member['groupname'] = $_W['uniaccount']['groups'][$member['groupid']]['title'];
		$member['isblack'] = pdo_fetchcolumn("SELECT isblack FROM ".tablename('fx_member').' WHERE uid=:uid',array(':uid' => $uid));
		return $member;
	}
	//防删除会员自动注册
	public function autoRegister($userinfo = array()) {
		global $_W, $_GPC;
		if ($_W['container'] != 'wechat') {
			return;
		}
		if (empty($userinfo)) {
			$userinfo = mc_oauth_userinfo();
		}
		if ($_W['fans']['nickname'] == '微信用户') return;
		if (empty($_W['fans']['uid'])) {
			$fan = mc_fansinfo($_W['fans']['openid']);
			$fan['tag']['nickname'] = $userinfo['nickname'];
			$fan['tag']['avatar'] = $userinfo['avatar'];
			$map_fans = $fan['tag'];			
			if (empty($fan['fanid'])) {
				$fan['tag']['subscribe'] = 1;
				$fan['tag']['subscribe_time'] = TIMESTAMP;
				$fan['tag']['groupid'] = 0;
				$fan['tag']['tagid_list'] = array();
				$record = array();
				$record['updatetime'] = TIMESTAMP;
				$record['nickname'] = stripslashes($fan['nickname']);
				$record['salt'] = random(8);
				$record['tag'] = base64_encode(iserializer($fan['tag']));
				$record['openid'] = $_W['fans']['openid'];
				$record['acid'] = $_W['fans']['uniacid'] = $_W['acid'];
				$record['uniacid'] = $_W['fans']['uniacid'] = $_W['uniacid'];
				$record['unionid'] = $_W['unionid'];
				pdo_insert('mc_mapping_fans', $record);
				$fan['fanid'] = $_W['fans']['fanid'] = pdo_insertid();
			}
			$default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' .tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $_W['uniacid']));
			$data = array(
				'uniacid' => $_W['uniacid'],
				'email' => md5($map_fans['openid']).'@we7.cc',
				'salt' => random(8),
				'groupid' => $default_groupid,
				'createtime' => TIMESTAMP,
				'password' => md5($message['from'] . $data['salt'] . $_W['config']['setting']['authkey']),
				'nickname' => $map_fans['nickname'],
				'avatar' => $map_fans['headimgurl']?$map_fans['headimgurl']:$map_fans['avatar'],
				'gender' => $map_fans['sex'],
				'nationality' => $map_fans['country'],
				'resideprovince' => $map_fans['province'] . '省',
				'residecity' => $map_fans['city'] . '市',
			);
			pdo_insert('mc_members', $data);
			$uid = $_W['fans']['uid'] = pdo_insertid();
			if (!empty($fan) && !empty($fan['fanid'])) {
				pdo_update('mc_mapping_fans', array('uid'=>$uid), array('fanid'=>$fan['fanid']));
			}
			cache_build_memberinfo($uid);
		}
		return $_W['fans']['uid'];
	}
	
	public function credit_get_by_uid($uid = '' ,$credit_type=1) {
		global $_W;
		if ($credit_type==1) {
			load()->model('mc');
			$result = mc_fetch($uid, array('credit1','credit2'));
		}
		return $result;
	} 
	
	 public function credit_update_credit1($uid, $credit1 = 0, $remark = '', $store_id = 0, $clerk_type = 1) {
		global $_W;
		load()->model('mc');
		$result = mc_credit_update($uid, 'credit1', $credit1, array($uid, $remark, IN_MODULE, '', $store_id, $clerk_type));
		if ($result) {
			$openid = mc_uid2openid($uid);
			mc_notice_credit1($openid, $uid, $credit1, $remark, '', '谢谢您的参与!');
			return TRUE;
		}
		return FALSE;			
	}
	
	public function credit_update_credit2($uid, $credit2 = 0, $remark = '', $store_id = 0, $clerk_type = 1) {
		global $_W;
		load()->model('mc');
		$result= mc_credit_update($uid, 'credit2', $credit2, array($uid, $remark, IN_MODULE, '', $store_id, $clerk_type));
		if ($result) {
			$openid = mc_uid2openid($uid);
			$credit = mc_credit_fetch($uid);			
			$time = date('Y-m-d H:i');
			$url = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=mc&a=bond&do=credits&credittype=credit2&type=record&period=1";
			$info = "【{$_W['account']['name']}】余额变更通知\n";
			$info .= "您在{$time}进行会员余额操作，余额增加【{$credit2}】元，变更后余额【{$credit['credit2']}】元。\n";
			$info .= !empty($remark) ? "备注：{$remark}\n\n" : '';
			sendCustomNotice($openid,$info,$url,'');
			return TRUE;
		}
		return FALSE;
	}
	
	public function getCreditName($credit_type) {
		global $_W;
		return $_W['account']['setting']['creditnames'][$credit_type]['title'];		
	}
}

function getInfo() {
	global $_W, $_GPC;
	$userinfo = array();
	if (isset($_SESSION['userinfo'])) {
		$userinfo = iunserializer(base64_decode($_SESSION['userinfo']));
		if (empty($userinfo['nickname']) || empty($userinfo['avatar'])) {
			unset($_SESSION['userinfo']);
		}
	}
	$userinfo = mc_oauth_userinfo();
	$uid = mc_openid2uid($userinfo['openid']);
	if ($uid && $uid != $_SESSION['uid']) {
	    $_SESSION['uid'] = $uid;
	    header('Location: ' . $_W['siteurl']);
	    exit;
	}
	$member = pdo_get('mc_members', array('uniacid' => $_W['uniacid'], 'uid' => $uid), array('nickname', 'avatar'));
	if (empty($member)) {
		$uid = $_W['fans']['uid'] = autoRegister($userinfo);	
	} elseif (empty($member['nickname']) || empty($member['avatar'])) {
		mc_update($uid, array('nickname' => $userinfo['nickname'],'avatar' => $userinfo['avatar']));
	}
	if (!empty($_W['fans']['uid']) && !empty($userinfo['nickname'])) {
		pdo_update('mc_mapping_fans', array(
			'nickname'=>$userinfo['nickname'],
			'tag' => base64_encode(iserializer($userinfo))
		), array('fanid'=>$_W['fans']['fanid']));
	}
	return $userinfo;
} 
//根据openid，获取会员信息
function getMember($openid = '') {
	global $_W, $_GPC;
	$uid = mc_openid2uid($openid);
	$member = mc_fetch($uid);
	if (empty($member['nickname']) || empty($member['avatar'])) {
		$member = pdo_get('mc_members', array('uniacid' => $_W['uniacid'], 'uid' => $uid));
	}
	$fan = mc_fansinfo($uid);	
	$member['follow'] = $fan['follow'];
	$member['openid'] = $fan['openid'];	
	$member['groupname'] = $_W['member']['groupname'];
	$member['realname'] = empty($member['realname'])?$member['nickname']:$member['realname'];
	$member['isblack'] = pdo_fetchcolumn("SELECT isblack FROM " . tablename('fx_member') . ' WHERE uid=:uid',array(':uid' => $uid));
	return $member;
}
//防删除会员自动注册
function autoRegister($userinfo = array()) {
	global $_W, $_GPC;
	if ($_W['container'] != 'wechat') {
		return;
	}
	if (empty($userinfo)) {
		$userinfo = mc_oauth_userinfo();
	}
	if (empty($_W['fans']['uid'])) {
		$fan = mc_fansinfo($_W['fans']['openid']);
		$fan['tag']['nickname'] = $userinfo['nickname'];
		$fan['tag']['avatar'] = $userinfo['avatar'];
		$map_fans = $fan['tag'];			
		if (empty($fan['fanid'])) {
			$fan['tag']['subscribe'] = 1;
			$fan['tag']['subscribe_time'] = TIMESTAMP;
			$fan['tag']['groupid'] = 0;
			$fan['tag']['tagid_list'] = array();
			$record = array();
			$record['updatetime'] = TIMESTAMP;
			$record['nickname'] = stripslashes($fan['nickname']);
			$record['salt'] = random(8);
			$record['tag'] = base64_encode(iserializer($fan['tag']));
			$record['openid'] = $_W['fans']['openid'];
			$record['acid'] = $_W['fans']['uniacid'] = $_W['acid'];
			$record['uniacid'] = $_W['fans']['uniacid'] = $_W['uniacid'];
			$record['unionid'] = $_W['unionid'];
			pdo_insert('mc_mapping_fans', $record);
			$fan['fanid'] = $_W['fans']['fanid'] = pdo_insertid();
		}
		$default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' .tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $_W['uniacid']));
		$data = array(
			'uniacid' => $_W['uniacid'],
			'email' => md5($map_fans['openid']).'@we7.cc',
			'salt' => random(8),
			'groupid' => $default_groupid,
			'createtime' => TIMESTAMP,
			'password' => md5($message['from'] . $data['salt'] . $_W['config']['setting']['authkey']),
			'nickname' => $map_fans['nickname'],
			'avatar' => $map_fans['headimgurl']?$map_fans['headimgurl']:$map_fans['avatar'],
			'gender' => $map_fans['sex'],
			'nationality' => $map_fans['country'],
			'resideprovince' => $map_fans['province'] . '省',
			'residecity' => $map_fans['city'] . '市',
		);
		pdo_insert('mc_members', $data);
		$uid = $_W['fans']['uid'] = pdo_insertid();
		if (!empty($fan) && !empty($fan['fanid'])) {
			pdo_update('mc_mapping_fans', array('uid'=>$uid), array('fanid'=>$fan['fanid']));
		}
		cache_build_memberinfo($uid);
	}
	return $_W['fans']['uid'];
}