<?php
/**
 * 活动报名模块微站定义
 *
 * @author 微链网络科技
 * @url https//www.sxwelink.com/
 */
defined('IN_IA') or exit('Access Denied');
define("MODULE_NAME", "wnfx_activity");
define("MODULE_PLUGIN_NAME", "wnfx_activity_plugin_babycard");
require IA_ROOT . '/addons/' . MODULE_NAME . '/core/common/defines.php';
require FX_CORE . '/class/loader.class.php';
$autoload = FX_CORE . '/class/autoload.php';
if(file_exists($autoload)) require $autoload;
fx_load()->func('global');
fx_load()->func('template');
load()->func('tpl');
class Wnfx_activity_plugin_babycardModuleSite extends WeModuleSite {
	
	public $settings;
	
	public function __construct() {
		global $_W,$_GPC;
		$modules = uni_modules();		
		$module = $modules[MODULE_PLUGIN_NAME];
		$this->settings = $module['config'];
	}
	
	public function doWebCardset() {
		global $_W,$_GPC;
		$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($op == 'display') {
			$where = array();
			$card = Util::getSingelData('*', 'fx_yearcard',$where);
			$card['value'] = unserialize($card['value']);
			$card['value_first'] = unserialize($card['value_first']);
		}
		if ($_W['ispost']) {
			$cardid = intval($_GPC['cardid']);
			$data = $_GPC['card'];
			$data['value'] = serialize($data['value']);
			$data['value_first'] = serialize($data['value_first']);
			$data['description'] = htmlspecialchars_decode($data['description']);
			$data['detail'] = htmlspecialchars_decode($data['detail']);
			$data['uniacid'] = $_W['uniacid'];
			$data['createtime'] = TIMESTAMP;
			if (!empty($cardid)) {
				pdo_update ('fx_yearcard', $data, array ('id' => $cardid));
			} else {
				pdo_insert ('fx_yearcard', $data);
				$cardid = pdo_insertid();
			}
			message ('更新成功！', referer(), 'success');
		}
		include fx_template('card');
	}
	
	public function doWebRecord() {
		global $_W,$_GPC;
		$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($op == 'display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			
			$where = array();
			if ($_GPC['status']!='') $where['status'] = $_GPC['status'];
			
			if (!empty($_GPC['keyword'])) {
				$w['sql'][] = "(INSTR(`mobile`, '".$_GPC['keyword']."') or INSTR(`realname`, '".$_GPC['keyword']."') or INSTR(`nickname`, '".$_GPC['keyword']."')) ";
				$membersData = Util::getNumData('uid', 'mc_members', $w, 'uid DESC', 1, 1, 0);
				if (!empty($membersData[0])){
					foreach ($membersData[0] as $v) {
						$memberuid[] = $v['uid'];
					}
				}else{
					$memberuid[] = 0;
				}
				$where['sql'][] ="buyuid IN (".implode(',',$memberuid).") ";
			}
			
			$recordData = Util::getNumData('*', 'fx_yearcard_record', $where, 'id DESC', $pindex, $psize, 1);
			fx_load()->model('member');
			foreach ($recordData[0] as &$s) {
				$buymember = getMember($s['buyuid']);
				$s['realname'] = $buymember['realname']?$buymember['realname']:$buymember['nickname'];
				$s['mobile'] = $buymember['mobile'];
				if($s['fid']){
					$friend = Util::getSingelData('*', 'fx_yearcard_friend',array('id'=>$s['fid']));
					$s['whois'] = $friend['realname'];
					$s['relation'] = $friend['relation'];
				}else if ($s['uid']) {
					if ($s['uid']==$s['buyuid']){
						$s['whois'] = '自己';
						$s['relation'] = '本人';
					}else{
						$member = getMember($s['uid']);
						$s['whois'] = $member['realname'];
						$s['relation'] = '朋友';
					}
				}else{
					$s['whois'] = '待领取';
				}
			}
			$record = $recordData[0];
			$pager = $recordData[1];
			$total = $recordData[2];
		}elseif ($op == 'post') {
			$id = intval($_GPC['id']);
			$record = Util::getSingelData('*', 'fx_yearcard_record', array('id'=>$id));
			$record['createtime'] = empty($record['createtime']) ? date("Y-m-d H:i", TIMESTAMP) : date("Y-m-d H:i",$record['createtime']);
			$record['end_time'] =empty($record['end_time']) ? date("Y-m-d H:i", TIMESTAMP) : date("Y-m-d H:i",$record['end_time']);
			fx_load()->model('member');
			$member = $record['openid'] ? getMember($record['openid']) : array();
			if ($_W['ispost']){
				$data = $_GPC['record'];
				$card = Util::getSingelData('*', 'fx_yearcard', array());
				$tobuy = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_yearcard_record') . " WHERE buyuid = ".$data['buyuid']);
				$data1 = array (
						'uniacid' => $_W['uniacid'],
						'uid' => $data['buyuid'],
						'fid' => 0,
						'cid' => $card['id'],
						'value' => 0,
						'value_first' => 0,
						'fee' => sprintf("%.2f", 0),
						'buynum' => 0,
						'pay_fee' => sprintf("%.2f", 0),
						'createtime' => strtotime($_GPC['time']['start']),
						'end_time' => strtotime($_GPC['time']['end']),
						'is_first' => 0,
						'enable' => 1,
				);
				$data = array_merge($data, $data1);
				if (!$id){
					if ($tobuy){
						message ('已存在，不可重复添加！', referer(), 'success');
					}
					$data['orderno'] = createUniontid();
					pdo_insert('fx_yearcard_record', $data);
					$rid = pdo_insertid();
				}else{
					$data['uid'] = $record['uid'];
					$data['fid'] = $record['fid'];
					pdo_update ('fx_yearcard_record', $data, array ('id' => $record['id']));
					$rid = $record['id'];
				}
				message ('更新成功！', $this->createWeburl('record', array('version_id'=>$_GPC['version_id'])), 'success');
			}
		}elseif ($_W['isajax'] && $op == 'delete') {
			$id = $_GPC['id'];
			if (!is_array($id)){
				$id = intval($id);
				$record = Util::getSingelData('id,orderno', 'fx_yearcard_record', array('id'=>$id));
				if (empty($record)) {
					message('抱歉，记录不存在或是已经被删除！', '', 'error');
				}
				
				pdo_delete('fx_yearcard_record', array('id' => $id));
				pdo_delete('core_paylog', array('tid' => $record['orderno']));
				die(json_encode(array("errno" => 0,'message'=>'删除成功')));
				exit;
			}else{
				if (empty($id)){
					echo json_encode(array('errno' => 1, 'message'=>'至少选择一条信息'));
					exit;
				}
				foreach ($id as $k => $bid) {
					$id = intval($bid);		
					$record = Util::getSingelData('id,orderno', 'fx_yearcard_record', array('id'=>$id));
					if (empty($record)) {
						echo json_encode(array('errno' => 1, 'message'=>'记录不存在或是已经被删除'));
						exit;
					}
					pdo_delete('fx_yearcard_record', array('id' => $id));
					pdo_delete('core_paylog', array('tid' => $record['orderno']));
				}
				die(json_encode(array("errno" => 0, 'message'=>'删除成功')));
				exit;
			}
		}
		include fx_template('record');
	}
	
	public function doMobileCard() {
		global $_W,$_GPC;
		$_W['page']['title'] = '年卡';
		$config  = $this->module['config'];
		$op      = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$buytype = intval($_GPC['buytype'])?intval($_GPC['buytype']):1;
		$fid     = $_GPC['fid'];
		if ($fid){//判断是否属于自己名下亲友
			$myfriend = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_yearcard_friend') . " WHERE id = $fid and uid = ".$_W['member']['uid']);
			$fid = $myfriend ? $fid : '';
		}
		if (empty($_W['member']['mobile'])){
			$_W['isv2'] = true;
			header("Location:" . app_url('member/bond/mobile','','wnfx_activity'));
			exit;
		}
		if ($op == 'display') {	
			$card = Util::getSingelData('*', 'fx_yearcard', array());
			$card['value'] = unserialize($card['value']);
			$card['value_first'] = unserialize($card['value_first']);
			foreach ($card['value'] as $index => $v) {
            	if ($v[0]==1){
					$value = $v[1];
					$value_first = $card['value_first'][$index][1];
					$cycletype = $index == 'y' ? 3 : ($index == 'q' ? 2 : 1);
					break;
				}
			}
			$tobuy = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_yearcard_record') . " WHERE status<>0 and buyuid = ".$_W['member']['uid']);
			$_W['page']['title'] = empty($card['name'])?$_W['page']['title']:$card['name'];
			$where = array('buyuid'=>$_W['member']['uid']);
			if($buytype==1){
				if($fid){
					$friend = Util::getSingelData('*', 'fx_yearcard_friend',array('id'=>$fid));
					$where['fid'] = $fid;
					$uid = 0;
				}else{
					$where['uid'] = $uid = $_W['member']['uid'];
				}
			}else{
				$uid = 0;
			}
			$record = Util::getSingelData('*', 'fx_yearcard_record', $where);
		}
		include fx_template('card');
	}
	
	public function doMobileCardfans() {
		global $_W,$_GPC;
		session_start();
		$_SESSION['from_url'] = $_SERVER['HTTP_REFERER'];
		$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$buytype  = intval($_GPC['buytype'])?intval($_GPC['buytype']):1;
		$card = Util::getSingelData('*', 'fx_yearcard', array());
		$card['value'] = unserialize($card['value']);
		$card['value_first'] = unserialize($card['value_first']);
		foreach ($card['value'] as $index => $v) {			
			if ($v[0]==1){
				$max_value = $v[1];
				$max_value_first = $card['value_first'][$index][1];
				break;
			}
		}
		foreach (array_reverse($card['value']) as $index => $v) {
			if ($v[0]==1){
				$min_value = $v[1];
				$min_value_first = $card['value_first'][$index][1];
				break;
			}
		}
		$_W['page']['title'] = empty($card['name'])?'年卡中心':$card['name'].'中心';
		fx_load()->model('member');
		if ($_W['account']->typeSign == 'account' && empty($_W['fans']['nickname'])) {
			getInfo();
		}
		$tobuy = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_yearcard_record') . " WHERE status<>0 and buyuid = ".$_W['member']['uid']);
		$where = array(
			'status' => array(1, 2, 3),
            'uid' => $_W['member']['uid'],
            'uniacid' => $_W['uniacid']
        );
		$getFee = pdo_get('fx_activity_records', $where, array('SUM(price) as price, SUM(vipdeduct) as vipdeduct'));
		fx_load()->model('member');
		$member = getMember($_W['openid']);
		$member['avatar'] = tomedia($member['avatar']);
		
		include fx_template('card_fans');
	}
	
	public function doMobileCardfriend() {
		global $_W,$_GPC;
		$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$config = $this->module['config'];
		$_W['page']['title'] = '选择亲友';
		//添加亲友
		if($_W['isajax'] && $op == 'add') {
			$friend = $_GPC['friend'];
			$data = array (
					'uid' => $_W['member']['uid'],
					'uniacid' => $_W['uniacid'],
					'realname' => $friend['realname'],
					'relation' => $friend['relation'],
					'gender' => $_GPC['gender'],
					'birthyear' => $_GPC['birth']['year'],
					'birthmonth' => $_GPC['birth']['month'],
					'birthday' => $_GPC['birth']['day'],
					'createtime' => TIMESTAMP
			);
			if ($data['uid']){
				$result = pdo_insert('fx_yearcard_friend', $data);
				if (!empty($result)) 
					message(error(0, '添加成功'),  '', 'ajax');
				else
					message(error(-1, '添加失败'),  '', 'ajax');
			}else{
				message(error(-1, '非会员不可添加'),  '', 'ajax');
			}
			exit;
		}
		//读取亲友数据
		$pindex = max(1, intval($_GPC['page']));
		$psize = 15;
		$where = array(
			'uid' => $_W['member']['uid'],
		);
		$friendData = Util::getNumData('*', 'fx_yearcard_friend', $where, 'id DESC', $pindex, $psize, 0);
		$friend = $friendData[0];
		foreach ($friend as &$s) {
			$s['record'] = Util::getSingelData('*', 'fx_yearcard_record', array('fid'=>$s['id']));
		}
		//判读自己是否开通
		$tobuy = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_yearcard_record') . " WHERE status<>0 and uid = ".$_W['member']['uid']);
		if ($tobuy) 
			$my_record = Util::getSingelData('*', 'fx_yearcard_record', array('uid'=>$_W['member']['uid']));
		include fx_template('card_friend');
	}
	
	public function doMobileCardrecord() {
		global $_W,$_GPC;
		session_start();
		$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$config = $this->module['config'];
		$buynum  = intval($_GPC['buynum']);
		$cycletype  = $_GPC['cycletype'];
		$fid  = intval($_GPC['fid']);
		$buytype = intval($_GPC['buytype']);
		if ($_W['member']['uid']) {
			$_W['page']['title'] = '开卡支付-活动年卡';
			$card = Util::getSingelData('*', 'fx_yearcard', array());
			$card['value'] = unserialize($card['value']);
			$card['value_first'] = unserialize($card['value_first']);
			$tobuy = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_yearcard_record') . " WHERE status<>0 and buyuid = ".$_W['member']['uid']);
			
			$where = array('buyuid'=>$_W['member']['uid']);
			if($buytype==1){
				if($fid){
					$friend = Util::getSingelData('*', 'fx_yearcard_friend', array('id'=>$fid));
					$where['fid'] = $fid;
					$uid = 0;
				}else{
					$where['uid'] = $uid = $_W['member']['uid'];
				}
			}else{
				$uid = 0;
			}
			$record = Util::getSingelData('*', 'fx_yearcard_record', $where);
			switch($cycletype){
				case 1:$value = $card['value']['m'][1];$value_first = $card['value_first']['m'][1];break;
				case 2:$value = $card['value']['q'][1];$value_first = $card['value_first']['q'][1];break;
				case 3:$value = $card['value']['y'][1];$value_first = $card['value_first']['y'][1];break;
				default:;
			}
			if ($card['is_first'] && !$tobuy){
				$fee = $card['is_first_num'] == 1 ? $value_first * $buynum : $value * ($buynum - 1) + $value_first;
			}else{
				$fee =  $value * $buynum;
			}
			$data = array (
				'uniacid' => $_W['uniacid'],
				'uid' => $uid,
				'buyuid' => $_W['member']['uid'],
				'openid' => $_W['openid'],
				'fid' => $fid,
				'cid' => $card['id'],
				'fee' => sprintf("%.2f", $fee),
				'buynum' => $buynum,
				'is_first' => !$tobuy ? 1 : 0,
				'cycletype' => $cycletype,
				'enable' => 1,
			);
			$paylog = pdo_get('core_paylog', array('status'=>0, 'tid' => $record['orderno']));
			$data['orderno'] = createUniontid();
			if (empty($record)){
				$data['status'] = 0;
				pdo_insert('fx_yearcard_record', $data);
				$rid = pdo_insertid();
				$paylog = pdo_get('core_paylog', array('status'=>0, 'tid' => $data['orderno']));
			}else{
				pdo_update('fx_yearcard_record', $data, array ('id' => $record['id']));
				$rid = $record['id'];
			}
			$moduleid = $_W['current_module']['mid'];
			$moduleid = empty($moduleid) ? '000000' : sprintf("%06d", $moduleid);
			$uniontid = date('YmdHis').$moduleid.random(8,1);
			$paydata = array(
				'type' => 'wechat',
				'uniacid' => $_W['uniacid'],
				'acid' => $_W['acid'],
				'openid' => $_W['openid'],
				'uniontid' => $uniontid,
				'tid' => $data['orderno'],
				'fee' => $data['fee'],
				'module' => MODULE_PLUGIN_NAME, //模块名称，请保证$this可用
				'tag' => iserializer(array('order_type'=>'card')),
				'card_fee' => $data['fee'],
				'is_usecard' => '1',
			);
			
			if (empty($paylog)) {
				$paydata['status'] = 0;
				pdo_insert('core_paylog', $paydata);	
			}else{
				pdo_update('core_paylog', $paydata, array('tid'=>$record['orderno']));
			}
		}
		
		//借权支付
		$setting = uni_setting($_W['uniacid'], array('payment'));
		if (intval($setting['payment']['wechat']['switch']) == 2 || intval($setting['payment']['wechat']['switch']) == 3) {
			load()->model('payment');
			$proxy_pay_account = payment_proxy_pay_account();
			if (!empty($_GPC['code'])) {
				$oauth = $proxy_pay_account->getOauthInfo($_GPC['code']);
				if (!empty($oauth['openid'])) {
					$_SESSION['pay_openid'] = $oauth['openid'];
				}
			}
			if(empty($_SESSION['pay_openid'])){
				$oauth_url = uni_account_oauth_host();
				if (!empty($oauth_url)) {
					$callback = app_url('cardrecord', array('op' => 'display','buytype'=>1,'fid'=>$fid))."&buynum=".$buynum."&cycletype=".$cycletype;
				}
				if (!is_error($proxy_pay_account)) {
					$forward = $proxy_pay_account->getOauthCodeUrl(urlencode($callback), 'we7sid-'.$_W['session_id']);
					header('Location: ' . $forward);
					exit;
				}
			}			
			$payopenid = $_SESSION['pay_openid'];
		}

		include fx_template('card_record');
	}
	public function doMobileSet() {
		global $_W, $_GPC;
		$result = pdo_update('fx_yearcard_record', array('remind'=>0), array('id' => $_GPC['id']));
		die(json_encode(array('result'=>$result)));
	}
	public function doMobilePaycenter() {
		global $_W, $_GPC;
		$op = !empty($_GPC['op']) ? $_GPC['op'] : 'pay';
		$where['id'] = intval($_GPC['id']);
		$record = Util::getSingelData('*', 'fx_yearcard_record', $where);
		$title = '年卡支付费用';
		$module = MODULE_PLUGIN_NAME;
		$log = pdo_get('core_paylog', array('module' => $module, 'tid' => $record['orderno']));
		if(!empty($log) && $log['status'] != '0') {
			die(json_encode(array('errno'=>1,'message'=>"这个订单已经支付成功, 不需要重复支付.")));
		}
		load()->model('payment');
		$_W['uniacid'] = $log['uniacid'];
		$payopenid = $_GPC['payopenid'];
		$payopenid = $payopenid ? $payopenid : $log['openid'];
		$setting = uni_setting($_W['uniacid'], array('payment'));
		
		if(!is_array($setting['payment'])) {
			die(json_encode(array('errno'=>1,'message'=>"没有设定支付参数.")));
		}
		$wechat = $setting['payment']['wechat'];
		$sql = 'SELECT `key`,`secret` FROM ' . tablename('account_wechats') . ' WHERE `acid`=:acid';
		$row = pdo_fetch($sql, array(':acid' => $wechat['account']));
		
		$wechat['appid'] = $row['key'];
		$wechat['secret'] = $row['secret'];
		$wechat['openid'] = $payopenid;
		$params = array(
			'tid' => $log['tid'],
			'fee' => $log['card_fee'],
			'user' => $payopenid,
			'title' => urldecode($title),
			'uniontid' => $log['uniontid'],
		);
		if (intval($wechat['switch']) == 2 || intval($wechat['switch']) == 3) {
			if(!empty($plid)) {
				$tag = array();
				$tag['acid'] = $_W['acid'];
				$tag['uid'] = $_W['member']['uid'];
				pdo_update('core_paylog', array('openid' => $payopenid, 'tag' => iserializer($tag)), array('tid' => $log['tid']));
			}
			$wOpt = wechat_proxy_build($params, $wechat);
		} else {
			unset($wechat['sub_mch_id']);
			$wOpt = wechat_build($params, $wechat);
		}
		die(json_encode(array('data'=>$wOpt)));
	}
	/*结果返回*/
	public function payResult($params) {
		global $_W;
		$_W['oauth']['uniacid'] = $_W['uniacid'];
		$_W['uniacid'] = $_W['acid'] = $params['uniacid'];
		if(!empty($params['tag'])) {
			$params['tag'] = iunserializer($params['tag']);	
		}
		payResult::payNotify($params);	
	}
}