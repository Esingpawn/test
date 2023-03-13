<?php
if (empty(trim($_GPC['r']))){
	header('location: ' . app_url('home'));
}
load()->func('communication');
global $uniacid, $yearcard, $vipdata, $is_vip, $agent, $mid;
$uniacid = "uniacid = '{$_W['uniacid']}'";
$_W['page']['title'] = '消息提醒';
$_W['share'] = $_W['_config']['share'];
$_W['share']['title'] = str_replace('"','\"',str_replace("'","\'",htmlspecialchars_decode($_W['share']['title'])));
$_W['share']['desc'] = str_replace('"','\"',str_replace("'","\'",htmlspecialchars_decode($_W['share']['desc'])));
$_W['_config']['image']['ratio'] = $_W['_config']['image']['ratio']=='' ? "1/1" : $_W['_config']['image']['ratio'];//图片附件缩放比
$_W['_config']['buytitle'] = empty($_W['_config']['buytitle']) ? "报名" : $_W['_config']['buytitle'];//购买标题
$_W['_config']['countdown'] = $_W['_config']['countdown'] || $_W['_config']['countdown']=='' ? 1 : 0;//详情计时器
$_W['_config']['search'] = $_W['_config']['search'] || $_W['_config']['search']=='' ? 1 : 0;//搜索
$_W['member'] =  empty($_W['member']) ? m('member')->getMember($_W['openid']) : $_W['member'];

if (empty(igetcookie('wnfx'))) isetcookie('wnfx', 1, 30 * 86400, true);

if (trim($_GPC['r'])!='home.auto_task'){//计划任务不执行此条件语句内代码
	if ($_GPC['i'] != $_W['uniacid'] && $_GPC['do']!='api'){
		isetcookie('link_uniacid', $_GPC['i'], 30 * 86400, true);
		header('location: ' . str_replace('i='.$_GPC['i'], 'i='.$_W['uniacid'], $_W['siteurl']) . '&from=wxapp');
		exit;
	}
	if (intval($_W['account']['level']) < 4 && $_W['account']['oauth']['acid']==$_W['uniacid'] && ACCOUNT_TYPE_APP_NORMAL!=$_W['oauth_account']['type']) {
		fx_message('获取用户信息权限不足！请借用认证服务号权限。', '', 'warning');
	}
	//判断当前用户是否主办方
	$uid = empty($_W['member']['uid']) ? 0 : $_W['member']['uid'];
	$merchid = pdo_fetchcolumn("SELECT id FROM " . tablename ('fx_merchant') . " WHERE uid = $uid");
	$_W['_config']['openids'] = empty($_W['_config']['openids']) ? array() : $_W['_config']['openids'];
	define('ADMIN', in_array($_W['openid'], $_W['_config']['openids']) ? 1 : 0);
	define('MERCHANTID', $merchid && !ADMIN ? $merchid : 0);
	
	//读取年卡
	if ($_W['plugin']['card']['config']['card_enable']) {
		$yearcard = Util::getSingelData('*', 'fx_yearcard', array());
		$vipdata = Util::getSingelData('*', 'fx_yearcard_record', array('status>'=>0, 'buyuid'=>$uid));
		$is_vip = !empty($vipdata) && TIMESTAMP <= $vipdata['end_time'] ? 1 : 0;
	}
	
	//读取分销
	if ($_W['plugin']['poster']['config']['commission_enable']) {
		$agent = Util::getSingelData('*', 'fx_agents', array('member_id'=>$_W['member']['uid'],'is_pass'=>1));
		if (!empty($agent) && !$agent['del']) {
			$mid = $agent['parent_id'];
		}else{
			$mid = intval($_GPC['mid']);
		}
	}
	$_W['_config']['probtn']  = $_W['_config']['merch'] && ($_W['_config']['probtn'] || MERCHANTID || ADMIN) ? 1 : 0;
}