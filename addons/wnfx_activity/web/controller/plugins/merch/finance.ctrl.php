<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * op.ctrl
 * 操作控制器
 */
defined('IN_IA') or exit('Access Denied');
$uniacid = $_W['uniacid'];
$id = intval($_GPC['id'])?intval($_GPC['id']):MERCHANTID;
$tab = empty($_GPC['tab'])?'weixin':str_replace('#tab_', '', $_GPC['tab']);
if ($_W['op']!='permissions')
	$item = model_merchant::getSingleMerchant($id, '*');
switch($_W['op']){
	case 'account':
		$_GPC['accountType'] = $_GPC['accountType']?$_GPC['accountType']:'weixin';
		$account =  pdo_fetch("SELECT * FROM ".tablename('fx_merchant_account')." WHERE uniacid = {$_W['uniacid']} and merchantid={$id}");
		$delivery = pdo_fetchcolumn("select SUM(price) from".tablename('fx_activity_records')." where (paytype='delivery' or paytype='admin') and status in(3) and merchantid={$id}");
		$item['amount'] = $account['amount'];
		$item['delivery'] = $delivery;
		$item['no_money'] = $account['no_money'];
		$item['no_money_doing'] = $account['no_money_doing'];
		if ($_W['ispost']) {
			/*先判断是否有正在申请中的结算申请*/
			if($account['no_money_doing']>0) web_json('上一笔申请未处理完成，不可重复操作！', 0);
			$money = $_GPC['money'];//提现金额（元）
			$no_money = model_merchant::getNoSettlementMoney($id); //未结算金额
			$minimum = empty($_W['_config']['merch_amount']) ? 1 : $_W['_config']['merch_amount'];//每笔提现金额最低值
			$maximum = empty($_W['_config']['merch_maximum']) ? 10000 : $_W['_config']['merch_maximum'];//每笔提现金额最大值
			
			if (is_numeric($money)){
				$commission = '0.00';//手续费
				$money = sprintf("%.2f", $money);
				if(!empty($item['percent'])){
					$commission = sprintf("%.2f", $money*$item['percent']*0.01);
					$get_money = sprintf("%.2f", $money-$commission);//实到金额
				}else{
					$get_money = $money;//实到金额
				}
				if($get_money<$minimum) web_json('输入金额不得小于'.$minimum.'元', 0);
				if($get_money>$maximum) web_json('单次提现金额不得大于'.$maximum.'元', 0);
				if($no_money<$money) web_json('您没有足够的可结算金额！', 0);
				
				$orderno = date('Ymd').substr(time(), -5).substr(microtime(), 2, 5).sprintf('%02d', rand(0, 99));
				$time = TIMESTAMP;
				if($_GPC['accountType']=='weixin'){
					/*先判断是否有正在申请中的结算申请*/
					if(empty($item['openid'])) web_json('未绑定提现微信号！', 0);
					
					if(MERCHANTID){//主办方提现
						pdo_update('fx_merchant_account',array('no_money_doing'=>$money),array('merchantid'=>$id));
						pdo_insert("fx_merchant_record",array('status'=>1,'updatetime'=>$time,'percent'=>$item['percent'],'get_money'=>$get_money,'merchantid'=>$id,'money'=>$money,'commission'=>$commission,'uid'=>$_W['uid'],'createtime'=>$time,'uniacid'=>$_W['uniacid'],'orderno'=>$orderno));
					}else{
						$result = model_merchant::finance($item['openid'], $get_money * 100, '主办方提现');  //结算操作
						if ($result['return_code'] != 'SUCCESS' || $result['result_code'] != 'SUCCESS'){
							web_json('微信钱包提现失败: ' .$result['err_code']."|" .$result['err_code_des'], 0);
						}else{ //结算成功
							pdo_insert("fx_merchant_money_record",array('merchantid'=>$id,'uniacid'=>$_W['uniacid'],'money'=>0-$get_money,'recordsid'=>'','createtime'=>$time,'type'=>4,'detail'=>$orderno));
							if($commission>0)
							pdo_insert("fx_merchant_money_record",array('merchantid'=>$id,'uniacid'=>$_W['uniacid'],'money'=>0-$commission,'recordsid'=>'','createtime'=>$time,'type'=>7,'detail'=>$orderno));
							$res = model_merchant::updateNoSettlementMoney(0-$money, $id);
							if($res){
								pdo_update('fx_merchant_account',array('no_money_doing'=>0),array('merchantid'=>$id));
								pdo_insert("fx_merchant_record",array('type'=>1,'status'=>3,'updatetime'=>$time,'percent'=>$item['percent'],'get_money'=>$get_money,'merchantid'=>$id,'money'=>$money,'commission'=>$commission,'uid'=>$_W['uid'],'createtime'=>$time,'uniacid'=>$_W['uniacid'],'orderno'=>$orderno));
							}else{
								web_json('结算成功，更新结算金额失败！', 0);
							}
						}
					}
				}elseif($_GPC['accountType']=='f2f') {
					pdo_insert("fx_merchant_money_record",array('merchantid'=>$id,'uniacid'=>$_W['uniacid'],'money'=>0-$get_money,'recordsid'=>'','createtime'=>$time,'type'=>4,'detail'=>$orderno));
					if($commission>0)
					pdo_insert("fx_merchant_money_record",array('merchantid'=>$id,'uniacid'=>$_W['uniacid'],'money'=>0-$commission,'recordsid'=>'','createtime'=>$time,'type'=>7,'detail'=>$orderno));
					$res = model_merchant::updateNoSettlementMoney(0-$money, $id);
					if($res){
						pdo_update('fx_merchant_account',array('no_money_doing'=>0),array('merchantid'=>$id));
						pdo_insert("fx_merchant_record",array('type'=>2,'status'=>3,'updatetime'=>$time,'percent'=>$item['percent'],'get_money'=>$get_money,'merchantid'=>$id,'money'=>$money,'commission'=>$commission,'uid'=>$_W['uid'],'createtime'=>$time,'uniacid'=>$_W['uniacid'],'orderno'=>$orderno));
					}else{
						web_json('结算成功，更新结算金额失败！', 0);
					}
				}
				web_json(referer());
			}else{
				web_json('结算金额输入错误！', 0);
			}
		}
		break;		
	case 'record':
		$account =  pdo_fetch("SELECT * FROM ".tablename('fx_merchant_account')." WHERE uniacid = {$_W['uniacid']} and merchantid={$id}");
		$delivery = pdo_fetchcolumn("select SUM(price) from".tablename('fx_activity_records')." where (paytype='delivery' or paytype='admin') and status in(3) and merchantid={$id}");
		$item['amount'] = $account['amount'];
		$item['delivery'] = $delivery;
		$item['no_money'] = $account['no_money'];
		$item['no_money_doing'] = $account['no_money_doing'];
		
		$pindex = max(1, intval($_GPC['page']));
		$psize = 15;
		$where=array();
		$where['merchantid'] = $id;
		$merchData = Util::getNumData('*', 'fx_merchant_record', $where, 'id desc', $pindex,$psize,1);
		$list = $merchData[0];
		$pager = $merchData[1];
		break;
	case 'moneylog':
		$account =  pdo_fetch("SELECT * FROM ".tablename('fx_merchant_account')." WHERE uniacid = {$_W['uniacid']} and merchantid={$id}");
		$delivery = pdo_fetchcolumn("select SUM(price) from".tablename('fx_activity_records')." where (paytype='delivery' or paytype='admin') and status in(3) and merchantid={$id}");
		$item['amount'] = $account['amount'];
		$item['delivery'] = $delivery;
		$item['no_money'] = $account['no_money'];
		$pindex = max(1, intval($_GPC['page']));
		$psize = 15;
		$moneyRecordData = model_merchant::getMoneyRecord($id, $pindex, $psize, 1);
		$moneyRecord = $moneyRecordData[0];
		$pager = $moneyRecordData[1];
		foreach($moneyRecord as &$s){
			if($s['recordsid'])$s['records'] = model_records::getSingleRecords($s['recordsid'], '*');
		}
		break;
}
include fx_template();