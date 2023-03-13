<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * record.ctrl
 * 我的报名控制器
 */
defined('IN_IA') or exit('Access Denied');
$id = intval($_GPC['id']);
$pagetitle = '电子票';
if($id){
	$item = model_records::getOrderCount($id, '1,2,3');
	$activity = model_activity::getSingleActivity($item['activityid'], '*');
	$merch  = model_activity::getActivityMerchant($activity['merchantid']);//读取主办方
	$activity['starttime'] = date('Y-m-d H:i', strtotime($activity['starttime']));
	$activity['endtime'] = date('Y-m-d H:i', strtotime($activity['endtime']));
	if ($item['review']!=1){
		switch($item['review']){
			case '0':
				$msg = '待审核';
				break;
			case '2':
				$msg = '已拒审';
				$des = $item['remark'];
				break;
			default:
			$msg = '驳回修改';
			$des = '请返回上一页面，顶部查看详情并修改';
			break;
		}
		$redirect = $_GPC['from']=='qrcode' || $_GPC['from']=='wxapp' ? 'javascript:wx.closeWindow();' : '';
		fx_message($msg, $redirect, 'warning', $des, '返回');
	}
	if ($activity['hasstore']){//判断位置是否活动中定义
		$merch['lng']       = $activity['lng'];
		$merch['lat']       = $activity['lat'];
		$merch['tel']       = $activity['tel'];
		$merch['address']   = $activity['address'];
		$merch['storename'] = $activity['addname'];
	}elseif (!empty($activity['storeids'])){//判断活动门店
		$stores = model_activity::getNumActivityStore($activity['storeids']);
	}else{
		$stores = pdo_fetchall("select * from" . tablename('fx_store') . "where uniacid='{$_W['uniacid']}' and status=1 and merchantid=".$activity['merchantid']);
	}
	if (count($stores) < 2) {
		$store = empty($stores) ? $merch : $stores[0];
	}
	$list = pdo_getall('fx_activity_records', array('orderno' => $item['orderno'], 'uniacid' =>$_W['uniacid']), '*', '', 'id asc');
	foreach ($list as $k => &$s) {		
		if (empty($s['hexiaoma'])){
			$hexiaoma = createRandomNumber(8);
			pdo_update('fx_activity_records', array('hexiaoma' => $hexiaoma), array('id' => $s['id']));
			$s['hexiaoma'] = $hexiaoma;
		}
		
		//生成二维码	
		$url = app_url('records/check', array('orderid' => $s['id'], 'from'=>'qrcode'));
		$s['qrcode'] = createQrcode::createverQrcode($url,$s['orderno'],$s['id'],"order");
		$s['qrcodeurl'] = urlencode($url);
		$cond = " uniacid = '{$_W['uniacid']}' and activityid = {$item['activityid']} and (status in(1,2,3) or (status=0 and paytype='delivery'))";
		$cond = " uniacid = '{$_W['uniacid']}' and activityid = {$item['activityid']}";
		$s['NO'] = pdo_fetchcolumn("SELECT rownum FROM (SELECT (@rownum:=@rownum+1) AS rownum, a.* FROM ".tablename('fx_activity_records')." a, (SELECT @rownum:= 0) r WHERE $cond ORDER BY a.`id` ASC) AS b  WHERE id=$id");
	}
	$total = count($list);
	if ($total > 1) {
		$pagetitle .= '(1/'.$total.')';
	}
}
include fx_template('records/qrcode');