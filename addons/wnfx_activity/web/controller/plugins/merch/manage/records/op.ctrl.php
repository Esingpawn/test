<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * op.ctrl
 * 操作控制器
 */
defined('IN_IA') or exit('Access Denied');
$ops = array('display','remarksaler','cancel','changeprice','pay','paycancel','hexiao','refund','review');
$uniacid = $_W['uniacid'];
$id = intval($_GPC['id'])?intval($_GPC['id']):0;
if (in_array($_W['op'], $ops)){
	$item = model_records::getSingleRecords($id, '*');
	if ($_W['ispost']) {
		$where = array('id'=>$id);
		$url = $_SERVER['HTTP_REFERER'];
		switch($_W['op']){
			case 'remarksaler':
				$data = array('remark'=>$_GPC['remark'], 'operation' => 'admin');
				break;
			case 'cancel':
				$data = array('remark'=>$_GPC['remark'],'status' => 5, 'operation' => 'admin');
				$activity = model_activity::getSingleActivity($item['activityid'], '*');
				$creditoff = $activity['prize']['credit'];
				$costcredit = $activity['costcredit'];
				//积分变更，如果符合条件的话
				if ($_W['_config']['creditstatus'] == 1){
					if($creditoff > 0) {
						m('member')->credit_update_credit1($item['uid'], 0-$creditoff, "取消报名：扣除原奖励" . $creditoff . m('member')->getCreditName('credit1'), $activity['merchantid']);
					}
					if($costcredit > 0) {
						m('member')->credit_update_credit1($item['uid'], $costcredit, "取消报名：返回原消耗" . $costcredit . m('member')->getCreditName('credit1'), $activity['merchantid']);
					}
				}
				$url = app_url('order/detail', array('id'=>$id,'type'=>'u')); // 取消报名通知
				message::join_cancel($item['openid'], $activity['title'], $activity['starttime'], $id, $url);
				break;
			case 'changeprice':
				$data = array('status' => 5, 'operation' => 'admin');
				break;
			case 'pay':
				$paytype = empty($item['paytype']) ? 'admin' : $item['paytype'];
				$data = array('payprice' => $item['price'], 'status' => 1, 'operation' => 'admin', 'paytype' => $paytype, 'paytime' => date('Y-m-d H:i:s',TIMESTAMP));
				if ($item['paytype']!=1) $data['review']=1;
				if ($item['status']==0)
				model_records::orderAccount($item, 1);//账目结算
				break;
			case 'paycancel':
				$paytype = $item['paytype']=='admin' ? '' : $item['paytype'];
				$data = array('payprice' => '', 'status' => 0, 'operation' => 'admin', 'paytype' => $paytype, 'paytime' => NULL);
				if ($item['status']==1)
				model_records::orderAccount($item, 0);//账目结算
				break;
			case 'hexiao':
				model_records::orderAccount($item);//账目结算				
				$data = array('payprice' => $item['price'], 'status' => 3, 'ishexiao' =>1, 'operation' => 'admin', 'sendtime'=>date('Y-m-d H:i:s',TIMESTAMP));
				$activity = model_activity::getSingleActivity($item['activityid'], '*');
				//积分奖励
				if ($_W['_config']['creditstatus'] == 1 && $activity['prize']['sign_credit'] > 0) {
					$credit = intval($activity['prize']['sign_credit']);//赠送积分额度
					m('member')->credit_update_credit1($item['uid'], $credit, "核销获取" . $credit . m('member')->getCreditName('credit1'), $item['merchantid']);
				}				
				message::hexiao_notice($item['openid'], $activity, app_url('order/detail', array('id'=>$item['id'], 'type'=>'u')));
				break;
			case 'refund':
				$type = $_GPC['value'];
				$url = app_url('order/detail',array('type'=>'u', 'id'=>$id));
				if ($type!=2){
					$data = array('remark'=>$_GPC['remark'], 'status' => 7, 'operation' => 'admin');
					$res = model_records::refundMoney($id,$item['payprice'],'',2);
					if($res['status']){
						$item['status'] = 7;
						message::refund($item['openid'], $item, $url, $_GPC['remark']);// 退款通知
						web_json();
					}else{
						web_json($res['message'], 0);
					}
				}else{
					$data = array('remark'=>$_GPC['remark'], 'status' => 1, 'operation' => 'admin');
					$item['status'] = 1;
					message::refund($item['openid'], $item, $url, $_GPC['remark']);// 退款通知
					pdo_update('fx_activity_records', $data, $where);
					web_json();
				}
				break;
			case 'review':
				$review = $_GPC['value'];
				$data = array('remark'=>$_GPC['remark'] ,'review' => $review, 'operation' => 'admin');
				$activity = model_activity::getSingleActivity($item['activityid'], '*');
				$merch = model_merchant::getSingleMerchant($activity['merchantid'], '*');//读取主办方
				message::join_review($item['openid'], $activity, $review, app_url('order/detail', array('id'=>$item['id'], 'type'=>'u')),$_GPC['remark']);
				if($activity['smsnotify']['switch'] && $review==1){//短信通知
					$smsparams=array(
						'product' => $_W['_config']['sname'],
						'item'    => $activity['title'],
						'name'    => $item['realname'],
						'timestr' => date('m月d日 H:i',strtotime($activity['starttime'])),
						'idcode'  => $item['hexiaoma'],
						'address' => model_activity::getAddress($activity['id'])
					);
					$template_id = empty($activity['smsnotify']['join']) ? $_W['_config']['sms_notify'] : $activity['smsnotify']['join'];
					sendSMS($item['mobile'], $smsparams, $template_id, $_W['_config']['sms_type']);
				}
				break;
			default:;
		}
		$result = pdo_update('fx_activity_records', $data, $where);
		web_json();
	}else{
		include fx_template();
	}
}