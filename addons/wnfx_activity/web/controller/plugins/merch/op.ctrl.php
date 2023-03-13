<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * op.ctrl
 * 操作控制器
 */
defined('IN_IA') or exit('Access Denied');

function opData()
{
	global $_W;
	global $_GPC;
	$id = intval($_GPC['id']);
	$tab = empty($_GPC['tab'])?'weixin':str_replace('#tab_', '', $_GPC['tab']);
	$item = model_merchant::getSingleMerchant($id, '*');
	return array('id' => $id, 'item' => $item, 'tab'=>$tab);
}
function mcert(){
	global $_W, $_GPC;
	$opdata = opData();
	extract($opdata);
	$mcert = Util::getSingelData('*', 'fx_merchant_mcert', array('mid' => $id));
	if (!empty($mcert)) $mcert['detail'] = unserialize($mcert['detail']);
	if ($_W['ispost']){
		if ($_GPC['status']){
			$data['status'] = $_GPC['status'];
			$data['createtime'] = TIMESTAMP;
			$data['endtime'] = strtotime("+1 year", TIMESTAMP);
			$result = pdo_update('fx_merchant_mcert', $data, array('mid' => $id));
			fx_load()->model('mc');
			if (mc_fans_follow($mcert['openid'])){
				$params = array(
					'type' => $mcert['type'],
					'name' => $mcert['detail']['name'],
					'mname' => $item['name'],
					'status' => $_GPC['status'],
					'createtime' => $mcert['createtime'],
					'remark' => $_GPC['messge_remark'],
				);
				$url = app_url('member/merch');
				message::mcert_review($mcert['openid'], $params, $url);
			}
		}
		web_json();
	}
	include fx_template();
}

function updateData(){
	global $_W, $_GPC;
	$opdata = opData();
	extract($opdata);
	if ($_W['ispost']) {
		$no_money = $_GPC['no_money'];
		$amount   = $_GPC['amount'];
		$data = array();
		if(is_numeric($no_money)){
			$data['no_money'] = sprintf("%.2f", $no_money);			
		}
		if(is_numeric($amount)){
			$data['amount'] = sprintf("%.2f", $amount);			
		}
		if(!empty($data)) {
			$merchant = pdo_fetch("select amount from".tablename('fx_merchant_account')."where uniacid={$_W['uniacid']} and merchantid={$id}");
			if(empty($merchant))
				$result = pdo_insert("fx_merchant_account",array('no_money'=>$no_money,'merchantid'=>$id,'uniacid'=>$_W['uniacid'],'uid'=>$_W['uid'],'amount'=>$amount,'updatetime'=>TIMESTAMP));
			else
				$result = pdo_update('fx_merchant_account', $data, array('merchantid'=>$id));
		}
		if ($result){
			 web_json();
		}else{
			 web_json('更新失败, 金额输入错误', 0);
		}
	}else{
		$account =  pdo_fetch("SELECT amount,no_money,no_money_doing FROM ".tablename('fx_merchant_account')." WHERE uniacid = {$_W['uniacid']} and merchantid={$id}");
		if(!empty($item['percent']))
		$account['no_money'] = $account['no_money'];
		$records = pdo_fetchall("SELECT * FROM ".tablename('fx_merchant_record')." WHERE uniacid = {$_W['uniacid']} and merchantid={$id}");
		$rm = $delivery = 0;
		foreach($records as $key => $val){
			$rm += $val['money'];
		}
		$orders = pdo_fetchall('select price,status,paytype from'.tablename('fx_activity_records').'where merchantid='.$id.' and status in(1,3,4,6)');
		$km = 0;
		$zm = 0;
		foreach($orders as $ke => $va){
			if($va['pay_type']==4)  $delivery += $va['price'];
			if(in_array($va['status'], array(3,4)))
				$km += $va['price'];
			$zm += $va['price'];
			
		}				
		$am = $km - $rm;
		$am = $am>0?$am:0;
	}
	include fx_template();
}