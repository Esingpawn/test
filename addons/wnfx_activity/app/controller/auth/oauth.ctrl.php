<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
$_W['op'] = !empty($_W['op']) ? $_W['op'] : 'info';
if ($_W['account']->typeSign == 'account') {
	m('member')->getInfo();
}
if(empty($_W['member']['uid'])){
	load()->model('mc');
	if(!empty($_W['openid'])) {
		$fan = mc_fansinfo($_W['openid']);
		if (!empty($fan['fanid'])) {
			$map_fans = $fan['tag'];
		} else {
			$fan['tag']['subscribe'] = 1;
			$fan['tag']['subscribe_time'] = TIMESTAMP;
			$fan['tag']['groupid'] = 0;
			$fan['tag']['tagid_list'] = array();
			$record = array();
			$record['updatetime'] = TIMESTAMP;
			$record['nickname'] = stripslashes($fan['nickname']);
			$record['salt'] = random(8);
			$record['tag'] = base64_encode(iserializer($fan['tag']));
			$record['openid'] = $_W['openid'];
			$record['acid'] = $_W['acid'];
			$record['uniacid'] = $_W['uniacid'];
			$record['unionid'] = $_W['unionid'];
			pdo_insert('mc_mapping_fans', $record);
			$fan['fanid'] = pdo_insertid();
		}
		if (empty($map_fans) && isset($_SESSION['userinfo'])) {
			$map_fans = unserialize(base64_decode($_SESSION['userinfo']));
		}
	}
	if(!empty($map_fans)) {
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
		$user['uid'] = pdo_insertid();
	}
	if (!empty($fan) && !empty($fan['fanid'])) {
		pdo_update('mc_mapping_fans', array('uid'=>$user['uid']), array('fanid'=>$fan['fanid']));
	}
	if(_mc_login($user)) {
		echo "<script>location.href = ".$_SESSION['oauth_url'].";</script >";
		fx_message('注册成功', $_SESSION['oauth_url'], 'success','');
	}
}else{
	fx_message('注册成功', $_SESSION['oauth_url'], 'success','');
}