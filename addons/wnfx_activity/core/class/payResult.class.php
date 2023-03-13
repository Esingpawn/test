<?php 

// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 支付结果处理类
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------

class payResult{
	/** 
	* 异步支付结果回调 ，处理业务逻辑
	* 
	* @access public
	* @name  
	* @param mixed  参数一的说明 
	* @return array 
	*/  
	static function payNotify($params){
		global $_W;
		if($params['result'] == 'success') {
			if($params['tag']['order_type']=='card') {//年卡支付处理
				$where['orderno'] = $params['tid'];
				$record = Util::getSingelData('*', 'fx_yearcard_record', $where);
				$card = Util::getSingelData('*', 'fx_yearcard', array('id' => $record['cid']));
				$buynum = $record['buynum'];
				
				switch($record['cycletype']){
					case 1:$cycle_type = "+".$buynum." month";break;
					case 2:$cycle_type = "+".($buynum * 3)." month";break;
					case 3:$cycle_type = "+".$buynum." year";break;
					default:;
				}
				$data = array(
					'status' => 1,
					'pay_fee'  => $params['fee']+$record['pay_fee'],
					'end_time' => $record['end_time'] && TIMESTAMP < $record['end_time'] ? strtotime($cycle_type, $record['end_time']) : strtotime($cycle_type, TIMESTAMP),
					'remind'   => 1
				);
				if (!$record['createtime']) $data['createtime'] = TIMESTAMP;
				pdo_update('fx_yearcard_record', $data, array('orderno' => $params['tid'], 'uniacid' => $_W['uniacid']));
				if (intval($card['credit'])){
					m('member')->credit_update_credit1($record['uid'], $card['credit'], "购买年卡：增加" . $card['credit'] . m('member')->getCreditName('credit1'), 0);
				}
				$log = "系统日志:活动报名-年卡消费【{$params['fee']}】元; openid = ".$params['user'];
				//载入日志函数
				load()->func('logging');
				//记录数组数据
				logging_run($log);
			}elseif($params['tag']['order_type']=='recharge') {//余额充值
				load()-> model('mc');
				load() -> model('card');
				$order = pdo_fetch("SELECT * FROM ".tablename('mc_credits_recharge')." WHERE tid = :tid", array(':tid' => $params['tid']));
				if ($params['result'] == 'success' && $params['from'] == 'notify') {
					$fee = $params['fee'];
					$total_fee = $fee;
					$data = array('status' => $params['result'] == 'success' ? 1 : -1);
					if ($params['type'] == 'wechat') {
						$data['transid'] = $params['tag']['transaction_id'];
						$params['user'] = mc_openid2uid($params['user']);
					}
					pdo_update('mc_credits_recharge', $data, array('tid' => $params['tid']));
					$paydata = array('wechat' => '微信', 'alipay' => '支付宝', 'baifubao' => '百付宝', 'unionpay' => '银联');
					if(empty($order['type']) || $order['type'] == 'credit') {
						$setting = uni_setting($_W['uniacid'], array('creditbehaviors', 'recharge'));
						$credit = $setting['creditbehaviors']['currency'];
						$recharge_settings = card_params_setting('cardRecharge');
						$recharge_params = $recharge_settings['params'];
						if(empty($credit)) {
							//message('站点积分行为参数配置错误,请联系服务商', '', 'error');
						} else {							
							if ($order['backtype'] == '2') {
								$total_fee = $fee;
							} else {
								if ($order['backtype'] == '1') {
									$total_fee = $fee;
									$add_credit = $order['tag'];
								} else {
									$total_fee = $fee + $order['tag'];
								}
							}
							if ($order['backtype'] == '1') {
								$add_str = ",充值成功,返" . m('member')->getCreditName('credit1') . $add_credit .",本次操作共增加余额{$total_fee}元," . m('member')->getCreditName('credit1') . $add_credit;
								$remark = '用户通过' . $paydata[$params['type']] . '充值' . $fee . $add_str;
								$record[] = $params['user'];
								$record[] = $remark;
								mc_credit_update($order['uid'], 'credit1', $add_credit, $record);
								mc_credit_update($order['uid'], 'credit2', $total_fee, $record);
								if ($_W['account']->typeSign == 'account')
								mc_notice_recharge($order['openid'], $order['uid'], $total_fee, '', $remark);
							} else {
								$add_str = ",充值成功,本次操作共增加余额{$total_fee}元";
								$remark = '用户通过' . $paydata[$params['type']] . '充值' . $fee . $add_str;
								$record[] = $params['user'];
								$record[] = $remark;
								mc_credit_update($order['uid'], 'credit2', $total_fee, $record);
								if ($_W['account']->typeSign == 'account')
								mc_notice_recharge($order['openid'], $order['uid'], $total_fee, '', $remark);
							}
						}
					}
		
					if($order['type'] == 'card_nums') {
						$member_card = pdo_get('mc_card_members', array('uniacid' => $order['uniacid'], 'uid' => $order['uid']));
						$total_num = $member_card['nums'] + $order['tag'];
						pdo_update('mc_card_members', array('nums' => $total_num), array('uniacid' => $order['uniacid'], 'uid' => $order['uid']));
										$log = array(
							'uniacid' => $order['uniacid'],
							'uid' => $order['uid'],
							'type' => 'nums',
							'fee' => $params['fee'],
							'model' => '1',
							'tag' => $order['tag'],
							'note' => date('Y-m-d H:i') . "通过{$paydata[$params['type']]}充值{$params['fee']}元，返{$order['tag']}次，总共剩余{$total_num}次",
							'addtime' => TIMESTAMP
						);
						pdo_insert('mc_card_record', $log);
						$type = pdo_fetchcolumn('SELECT nums_text FROM ' . tablename('mc_card') . ' WHERE uniacid = :uniacid', array(':uniacid' => $order['uniacid']));
						$total_num = $member_card['nums'] + $order['tag'];
						if ($_W['account']->typeSign == 'account')
						mc_notice_nums_plus($order['openid'], $type, $order['tag'], $total_num);
					}
		
					if($order['type'] == 'card_times') {
						$member_card = pdo_get('mc_card_members', array('uniacid' => $order['uniacid'], 'uid' => $order['uid']));
						if($member_card['endtime'] > TIMESTAMP) {
							$endtime = $member_card['endtime'] + $order['tag'] * 86400;
						} else {
							$endtime = strtotime($order['tag'] . 'days');
						}
						pdo_update('mc_card_members', array('endtime' => $endtime), array('uniacid' => $order['uniacid'], 'uid' => $order['uid']));
						$log = array(
							'uniacid' => $order['uniacid'],
							'uid' => $order['uid'],
							'type' => 'times',
							'model' => '1',
							'fee' => $params['fee'],
							'tag' => $order['tag'],
							'note' => date('Y-m-d H:i') . "通过{$paydata[$params['type']]}充值{$params['fee']}元，返{$order['tag']}天，充值后到期时间:". date('Y-m-d', $endtime),
							'addtime' => TIMESTAMP
						);
						pdo_insert('mc_card_record', $log);
						$type = pdo_fetchcolumn('SELECT times_text FROM ' . tablename('mc_card') . ' WHERE uniacid = :uniacid', array(':uniacid' => $order['uniacid']));
						$endtime = date('Y-m-d', $endtime);
						if ($_W['account']->typeSign == 'account')
						mc_notice_times_plus($order['openid'], $member_card['cardsn'], $type, $fee, $order['tag'], $endtime);
					}
				}
			}else{//产品订单支付处理				
				$order = model_records::getOrderCount($params['tid']);
				$activity = model_activity::getSingleActivity($order['activityid'], '*');
				if ($order['status'] == 0) {
					//订单确认处理程序
					model_records::checkOrderConfirm($params['tid'], $params);
					//模板通知			
					$url = app_url('order/detail',array('id'=>$order['id'],'type'=>'u'));
					if (!$activity['switch']['joinreview']) {
						message::join_success($order['openid'], $activity, $order['id'], $url);
					}else{
						//审核通知
						message::join_review($order['openid'], $activity, 0, $url);
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
					
					if($activity['smsnotify']['switch'] && !$activity['switch']['joinreview']){//短信通知
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
					//积分变更
					if ($_W['_config']['creditstatus'] == 1){
						$orderMarket = $order['marketing'];
						$credit = $activity['prize']['credit'] * $order['buynum'];
						if($credit > 0){
							$credit = $orderMarket['credit_double'] ? $credit * 2 : $credit;
							m('member')->credit_update_credit1($order['uid'], $credit, "参与活动奖励：增加" . $credit . m('member')->getCreditName('credit1'), $activity['merchantid']);
						}
						if($orderMarket['deduct']){
							$deduct = $orderMarket['deduct'];
							if($deduct[0]) m('member')->credit_update_credit1($order['uid'], -1 * $deduct[0], "支付抵扣：减少" . $deduct[0] . m('member')->getCreditName('credit1'), $activity['merchantid']);
						}						
						if($activity['costcredit']){
							m('member')->credit_update_credit1($order['uid'], -1 * $activity['costcredit'], "参与活动消耗：减少" .$activity['costcredit'] . m('member')->getCreditName('credit1'), $activity['merchantid']);
						}
					}
					
					if ($_W['plugin']['poster']['config']['commission_enable'] && $activity['prize']['commission'] && $_W['plugin']['poster']['config']['settlement_event']){
						//完成分销订单
						model_api::handler($_W['plugin']['poster']['config']);
						$complete = model_api::commission_completeOrder($order['orderno']);
						//读取当前订单分销佣金
						if ($complete=='OK') {
							$commission = model_api::commission_data($order['orderno']);
						}
						if(!empty($order['merchantid'])) {
							foreach ((array)$commission as $row) {
								model_merchant::updateNoSettlementMoney(0-$row['commission'], $order['merchantid']);//更新可结算金额
								pdo_insert("fx_merchant_money_record",array('merchantid'=>$order['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>0-$row['commission'],'recordsid'=>$order['id'],'createtime'=>TIMESTAMP,'type'=>10,'detail'=>'推客佣金结算'.($record['paytype']=='delivery'?'，线下付款':'')));
							}
						}
					}
				}
				if ($params['type'] == 'credit'){
					show_json(app_url("pay/success", array('id'=>$order['id'])));
				}
			}
		}
	}
	/** 
	* 函数的含义说明 
	* 
	* @access public
	* @name 方法名称 
	* @param mixed  参数一的说明 
	* @return array 
	*/  
	static function payReturn($params){
		global $_W;

	}
	/** 
	* 函数的含义说明 
	* 
	* @access public
	* @name 方法名称 
	* @param mixed  参数一的说明 
	* @return array 
	*/  
	static function getPayData($params,$order_out,$goodsInfo){
	 	global $_W;
	
	}
}
?>