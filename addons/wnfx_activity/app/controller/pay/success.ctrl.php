<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * success.ctrl
 * 支付成功控制器
 */
defined('IN_IA') or exit('Access Denied');

$_W['page']['title'] = '报名结果';//这里的标题借用系统全局变量解决外部方法获取不到标题的问题
if($_W['op'] =='recharge'){
	$_W['page']['title'] = '充值结果';
	fx_message('充值成功', app_url('member', array('done'=>1)), 'success', $remark);
}
$order = model_records::getOrderCount($_GPC['id'], '1,2');
$orderMarket = $order['marketing'];

$activity = model_activity::getSingleActivity($order['activityid'], '*');
if (!$order['id']) fx_message("SQL Error:", '', 'error');
$_W['pay']['price'] = $order['price'];
$_W['pay']['paytype'] = $order['paytype'];
$_W['kefu'] = $activity['kefu'];

if($_W['op'] =='display'){
	if ($_W['_config']['creditstatus'] == 1 && $activity['prize']['credit'] > 0){
		$credit = $activity['prize']['credit'] * $order['buynum'];
		$credit = $orderMarket['credit_double'] ? $credit * 2 : $credit;
		$cardRemark = $orderMarket['credit_double'] ? '，' . $yearcard['name'] . m('member')->getCreditName('credit1') . '奖励翻倍' : '';
		$credit_remark = '<br>系统奖励您<font color=" color="#FF7B33">' . $credit . '</font>' . m('member')->getCreditName('credit1') . $cardRemark;
	}
	$tmplmsg = $activity['tmplmsg'];
	$remark  = empty($tmplmsg['joinremark']) ? $activity['title'] : $tmplmsg['joinremark'];
	$msg_title = $order['status']==1?'支付成功':'报名成功';
	if ($_W['plugin']['poster']['config']['commission_enable'] && $activity['prize']['commission']){
		$_W['commission']['commission_enable'] = $_W['plugin']['poster']['config']['commission_enable'];
		if($activity['prize']['commission_rule']['first_level_rate']) {
			$_W['commission']['rule'] = $activity['prize']['commission_rule'];
		}else{
			$_W['commission']['rule'] = $_W['plugin']['poster']['config']['rule'];
		}
	}
	$_W['commission']['url'] = app_url('activity/poster',array('id'=>$order['activityid'],'orderid'=>$order['id']));
	$_W['lottery'] = $activity['prize']['lottery'];//抽奖
	fx_message($msg_title, app_url('records', array('done'=>1)), 'success', $remark . $credit_remark);
}

if($_W['op'] =='delivery'){
	if ($activity['hasoption']){//规格选项
		$option = model_activity::getSingleActivityOption($order['optionid']);
		$activity['falsedata']['num'] = $option['falsenum'] ? $option['falsenum'] : 0;
	}
	$gnum = $option['stock']?$option['stock']:$activity['gnum'];
	if ($gnum > 0){
		$joinnum = model_records::getJoinNum($activity['id'], $order['optionid']) + $activity['falsedata']['num'];
		if($joinnum >= $gnum) {
			fx_message("很遗憾！名额已经满了", '', 'error');
		}elseif($joinnum + $_SESSION['pay']['buynum'] > $gnum){
			fx_message("当前活动仅剩 " . ($gnum - $joinnum) . ' 个名额', '', 'error');
		}
	}
	//保存修改信息
	//$listNum = pdo_fetchall("SELECT hexiaoma as num FROM " . tablename ('fx_activity_records') . " WHERE activityid = ".$activity['id']);
	//$hexiaoma = createNumber($listNum);
	$params = array('type' => 'delivery');
	$check = model_records::checkOrderConfirm($order['orderno'], $params);
	$order = model_records::getOrderCount($_GPC['id'], 0);
	
	if ($check){
		//积分变更
		if ($_W['_config']['creditstatus'] == 1){
			if($activity['costcredit']){
				m('member')->credit_update_credit1($_W['member']['uid'], -1 * $activity['costcredit'], "参与活动消耗：减少" . $activity['costcredit'] . m('member')->getCreditName('credit1'), $activity['merchantid']);
			}
		}
		
		if (!$activity['switch']['joinreview']) {//只有已审核发送通知
			$url = app_url('order/detail',array('id'=>$order['id'],'type'=>'u')); // 报名成功通知
			message::join_success($_W['openid'], $activity, $order['id'], $url);		
			if($activity['smsnotify']['switch']){//发送短信
				$smsparams=array(
					'product' => $_W['_config']['sname'],
					'item'    => $activity['title'],
					'name'    => $order['realname'],
					'timestr' => date('m月d日 H:i',strtotime($activity['starttime'])),
					'idcode'  => $order['hexiaoma'],
					'address' => model_activity::getAddress($activity['id'])
				);
				$template_id = empty($activity['smsnotify']['join']) ? $_W['_config']['sms_notify'] : $activity['smsnotify']['join'];
				sendSMS($order['mobile'], $smsparams, $template_id, $_W['_config']['sms_type']);
			}
		}else{
			//审核通知
			message::join_review($_W['openid'], $activity, 0, app_url('records'));
		}

		if ($_W['_config']['mmsg']){//管理通知
			if ($activity['merchantid'])
			$merchant = model_merchant::getSingleMerchant($activity['merchantid'], '*');//读取主办方
			$openids = $activity['openids'];
			$openids = !empty($openids) ? $openids : unserialize($merchant['messageopenid']);
			$openids = !empty($openids) ? $openids : $_W['_config']['openids'];
			if (!empty($openids)){
				foreach($openids as $key=> $value){
					message::admin_notice($value, $activity, $order['id'], '');
				}
			}
		}
	}
	$tmplmsg = $activity['tmplmsg'];
	$remark  = empty($tmplmsg['joinremark'])?$activity['title']:$tmplmsg['joinremark'];
	fx_message('线下支付待确认', app_url('records', array('done'=>1)), 'warning', $remark);
}