<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * home.ctrl
 * 个人中心首页控制器
 */
defined('IN_IA') or exit('Access Denied');
if ($_W['account']->typeSign == 'account') {
	m('member')->getInfo();
}
//print_r($_W['account']['setting']['payment']);
$pagetitle = '我的';
if($_W['op'] =='display'){
	global $_W;
	$member = m('member')->getMember($_W['openid']);
	$member = empty($member)?$_W['fans']:$member;
	$member['avatar'] = tomedia($member['avatar']);
	$member['gender'] = $member['gender']==0 ? '保密' : ($member['gender']==1?'男':'女');	
	$credits = m('member')->credit_get_by_uid($_W['member']['uid'], 1);
	$condition = " uniacid = '{$_W['uniacid']}' and (openid = '{$_W['openid']}' or uid='{$_W['member']['uid']}')";
	$total1 = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 0");
	$total2 = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 1");
	$total3 = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 2");
	$total4 = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 3");
	$total5 = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 5");
	$total7 = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 7");
	if (MERCHANTID || ADMIN){
		$merchant = model_merchant::getSingleMerchant(MERCHANTID, '*');
		$mcert = Util::getSingelData('*', 'fx_merchant_mcert', array('mid' => MERCHANTID));
	}

	$credit1link = empty($_W['_config']['credit1link'])?$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=mc&a=bond&do=credits&credittype=credit1&type=record&period=1":$_W['_config']['credit1link'];
	$credit2link = empty($_W['_config']['credit2link'])?$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=mc&a=bond&do=credits&credittype=credit2&type=record&period=1":$_W['_config']['credit2link'];

	if ($_W['plugin']['poster']['config']['commission_api']) {
		//$commission_url = app_url('commission', array('op'=>'display','mid'=>$mid), PLUGIN_POSTER);
		$commission_url = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=commission&m='.PLUGIN_POSTER.'&mid='.$mid;
	}else{
		$commission_url = $_W['siteroot']."addons/yun_shop/?menu=#/member/extension?i=".$_W['uniacid'];
	}
	include fx_template();
	exit;
}
//更新个人信息
if ($_W['op'] == 'mc' && $_W['isajax']) {
	$type = $_GPC['type'];
	$data = array();
	switch($type){
		case 'nickname':
		case 'realname':
		case 'qq'      :
		case 'gender'  :
		case 'age'     :$data[$type] = trim($_GPC[$type]);break;
		case 'address' :
		$data['address'] = trim($_GPC['address']);
		$data['resideprovince'] = $_GPC['reside']['province'];
		$data['residecity'] = $_GPC['reside']['city'];
		$data['residedist'] = $_GPC['reside']['district'];
		break;
		default:;
	}
	
	if (mc_update($_W['member']['uid'], $data)) {
		message('更新资料成功！', referer(), 'success');
	}else{
		message('更新失败！', referer(), 'error');
	}
	exit;
}