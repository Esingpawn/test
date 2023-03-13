<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * activity.ctrl
 * 我的报名控制器
 */
defined('IN_IA') or exit('Access Denied');
if ($_W['account']->typeSign == 'account') {
	m('member')->getInfo();
}
$pagetitle = '我的报名';
if($_W['op'] =='display' || $_W['op'] =='list'){
	$index = intval($_GPC['index']);
	include fx_template('records/index');
	exit;
}

if($_W['op'] =='ajax'){
	$pindex = max(1, intval($_GPC['page']));
	$psize = max(1, intval($_GPC['pagesize']));
	$condition = " uniacid = '{$_W['uniacid']}' and openid = '{$_W['openid']}'";
	switch($_GPC['status']){
		case 0:$condition .=" and status = 0";break;
		case 1:$condition .=" and (status = 1 or status = 2)";break;
		case 3:$condition .=" and status = 3 ";break;
		case 5:$condition .=" and status = 5";break;
		case 7:$condition .=" and status = 7";break;
		default:'';
	}
	
	$list = pdo_fetchall ("SELECT a.* FROM " . tablename ('fx_activity_records') . " AS a RIGHT JOIN (SELECT MIN(id) as id FROM " . tablename ('fx_activity_records') . " WHERE $condition GROUP BY orderno) AS b ON a.id=b.id WHERE $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
	//读取商户信息
	foreach ($list as &$s) {
		$activity = model_activity::getSingleActivity($s['activityid'], '*');
		if ($activity['switch']['form']) {
			$orderCount = model_records::getOrderCount($s['id']);
			$s['buynum'] = $orderCount['buynum'];
			$s['price'] = $orderCount['price'];
			$s['payprice'] = $orderCount['payprice'];
			$s['seats'] = $orderCount['seats'];
			$s['marketing'] = $orderCount['marketing'];
		}
		$s['title'] = $activity['title'];
		$s['starttime'] = empty($activity['starttime'])? date("Y-m-d h:i:s") :$activity['starttime'];
		$s['endtime'] = empty($activity['endtime'])? date("Y-m-d h:i:s") :$activity['endtime'];
		$s['joinstime'] = empty($activity['joinstime'])? date("Y-m-d h:i:s") :$activity['joinstime'];
		$s['joinetime'] = empty($activity['joinetime'])? date("Y-m-d h:i:s") :$activity['joinetime'];
		$s['thumb'] = $activity['thumb'];
		$s['hasoption'] = $activity['hasoption'];
		$s['joincancel'] = $activity['switch']['joincancel'];
		
		if ($s['merchantid']){
			$merchant = model_merchant::getSingleMerchant($s['merchantid'], '*');
			$s['merchant']['name']  = $merchant['name'];
			$s['merchant']['logo'] = tomedia($merchant['logo']);
		}else{
			$s['merchant']['name']  = $_W['_config']['sname'];
			$s['merchant']['logo'] = tomedia($_W['_config']['slogo']);
		}
		if ($_GPC['status']==-1 && $s['status']<>0) $s['status'] = m('order')->getStatus($s['orderno']);
		$s['thumb'] = tomedia($s['thumb']);
	}
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename ('fx_activity_records') . " WHERE $condition");
	$data['list']=$list;
	$data['tpage']=(empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);
	$data['total']=$total;
	die(json_encode($data));
	exit;
}

if($_W['op'] =='cancel'){//取消我的报名
	$aid = intval($_GPC['aid'])?intval($_GPC['aid']):intval($_GPC['activityid']);
	$result = pdo_update('fx_activity_records', array ('status' => 5) , array ('id' => $_GPC['id']));
	$activity = model_activity::getSingleActivity($aid, '*');
	$creditoff = $activity['prize']['credit'];
	$costcredit = $activity['costcredit'];
	//积分变更，如果符合条件的话
	if ($result && $_W['_config']['creditstatus'] == 1){
		if($creditoff > 0) {
			m('member')->credit_update_credit1($_W['member']['uid'], 0-$creditoff, "取消报名：扣除原奖励" . $creditoff . m('member')->getCreditName('credit1'), $activity['merchantid']);
		}
		if($costcredit > 0) {
			m('member')->credit_update_credit1($_W['member']['uid'], $costcredit, "取消报名：返回原消耗" . $costcredit . m('member')->getCreditName('credit1'), $activity['merchantid']);
		}
	}
	
	$url = app_url('records/list'); // 取消报名通知
	message::join_cancel($_W['openid'], $activity['title'], $activity['starttime'],$_GPC['id'], $url);
	die(json_encode(array("result" => $result)));
	exit;
}