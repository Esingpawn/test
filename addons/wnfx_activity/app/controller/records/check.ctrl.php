<?php
if ($_W['account']->typeSign == 'account') {
	m('member')->getInfo();
}
$orderid = intval($_GPC['orderid'])?intval($_GPC['orderid']):intval($_GPC['id']);
$result = $_GPC['result'];
$pagetitle = $result =='success' ?'核销结果' :'确认核销';
$records = model_records::getSingleRecords($orderid);

$error = false;
if (!in_array($records['status'], array('1','2','3')) || $records['review']!=1){
	$error = true;
	$msg = '此订单状态不可核销';
}else{
	$activity = model_activity::getSingleActivity($records['activityid'], '*');
	if (TIMESTAMP > strtotime($activity['endtime'])){
		$error = true;
		$msg = '当前活动已结束，核销失败!';
	}
}
$redirect = $_GPC['from']=='qrcode' || $_GPC['from']=='wxapp' ? 'javascript:wx.closeWindow();' : '';
if ($error){
	fx_message($msg, $redirect, 'warning');
}


$ishexiao_member = FALSE;
$store = array();
$store_ids=array();
$_W['merchant']  = model_activity::getActivityMerchant($activity['merchantid']);//读取主办方

if ($activity['hasstore']){//判断位置是否活动中定义
	$_W['merchant']['lng']       = $activity['lng'];
	$_W['merchant']['lat']       = $activity['lat'];
	$_W['merchant']['tel']       = $activity['tel'];
	$_W['merchant']['address']   = $activity['address'];
	$_W['merchant']['storename'] = $activity['addname'];
}elseif (!empty($activity['storeids'])){//判断活动门店
	$all_stores = model_activity::getNumActivityStore($activity['storeids']);
	$store_ids = $activity['storeids'];
}else{
	$all_stores = pdo_fetchall("select * from" . tablename('fx_store') . "where uniacid='{$_W['uniacid']}' and status=1 and merchantid=".$activity['merchantid']);
	foreach($all_stores as $key=>$value){
		$store_ids[] = $value['id'];
	}		
}
$con = '';
if(!empty($activity['merchantid'])){
	$con .=  " and merchantid={$activity['merchantid']}";
}else{
	$con .=  " and merchantid=0";
}

if ($_W['op'] =="display"){
	 //*判断是否是核销人员*/
	if (!empty($_W['openid'])){
		$saler = pdo_fetch("select * from " . tablename('fx_saler')." where INSTR(`openid`, '{$_W['openid']}') and  uniacid='{$_W['uniacid']}' and status=1 {$con} ");
		if($saler){
			if($saler['storeid']==''){
				$store = $store_ids;
				$ishexiao_member = TRUE;
			}else{
				$hexiao_ids = explode(',', $saler['storeid']); //核销员属于门店的id
				foreach($hexiao_ids as$key=> $value){
					if(in_array($value,$store_ids)){
						$store[] = $value;
						$ishexiao_member = TRUE;
					}
				}
			}
	
			if(!empty($saler['merchantid']) && !empty($activity['merchantid'])){
				if($saler['merchantid'] != $activity['merchantid']){
					$ishexiao_member = FALSE;
				}
			}
		}else{
			$ishexiao_member = FALSE;
		}
	}else{
		$ishexiao_member = FALSE;
	}
	//可核销的门店信息
	foreach($store as$key=>$value){
		if($value) $stores[$key] =  pdo_fetch("select * from".tablename('fx_store')."where id='{$value}' and uniacid='{$_W['uniacid']}'");
	}
	$cond = " uniacid = '{$_W['uniacid']}' and activityid = {$records['activityid']} and (status in(1,2,3) or (status=0 and paytype='delivery'))";
	$cond = " uniacid = '{$_W['uniacid']}' and activityid = {$records['activityid']}";
	$NO = pdo_fetchcolumn("SELECT rownum FROM (SELECT (@rownum:=@rownum+1) AS rownum, a.* FROM ".tablename('fx_activity_records')." a, (SELECT @rownum:= 0) r WHERE $cond ORDER BY a.`id` ASC) AS b  WHERE id={$records['id']}");
	include fx_template('records/check');
}

if($_W['isajax'] && $_W['op'] =="post"){
	$storeid = $_GPC['storeid'];
	if($records['ishexiao']==1){
		die(json_encode(array('errno'=>1,'message'=>'该报名已核销！')));
	}elseif($records['status'] > 2 || ($records['paytype'] != 'delivery' && $records['status'] == 0)){
		die(json_encode(array('errno'=>1,'message'=>'报名状态错误！')));
	}else{
		$data = array(
			'payprice' => $records['price'], 
			'status'=>3,
			'ishexiao'=>1,
			'veropenid' => $_W['openid'],
			'sendtime'=>date('Y-m-d H:i:s',TIMESTAMP),
			'storeid'=>$storeid
		);
		if (!empty($_GPC['usernum'])) $data['usernum'] = $_GPC['usernum'];
		$result = pdo_update('fx_activity_records', $data ,array('id'=>$orderid));
		if($result){
			model_records::orderAccount($records,3,'二维码核销');//账目结算
			//积分奖励
			if ($_W['_config']['creditstatus'] == 1 && $activity['prize']['sign_credit'] > 0) {
				$credit = intval($activity['prize']['sign_credit']);//赠送积分额度
				$result = m('member')->credit_update_credit1($records['uid'], $credit, "核销获取" . $credit . m('member')->getCreditName('credit1'), $records['merchantid']);
			}
			$url = app_url('order/detail', array('id'=>$records['id'], 'type'=>'u')); // 核销成功通知
			message::hexiao_notice($records['openid'], $activity, $url);
			die(json_encode(array('errno'=>0,'message'=>'核销成功！')));
		}else{
			die(json_encode(array('errno'=>2,'message'=>'核销失败！')));
		}
	}
	
}