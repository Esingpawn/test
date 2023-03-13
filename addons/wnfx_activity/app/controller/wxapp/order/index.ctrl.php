<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * order.ctrl
 * 报名订单控制器
 */
defined('IN_IA') or exit('Access Denied');
function main(){
	global $_W,$_GPC;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
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
	$data['pagesize']=$psize;
	$data['total']=(int)$total;
	$data['tpage']=(empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);	
	show_json($data, 1);
}