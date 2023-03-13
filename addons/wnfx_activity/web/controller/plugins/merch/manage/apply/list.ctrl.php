<?php 
defined('IN_IA') or exit('Access Denied');
function main($status = 1)
{
	global $_W,$_GPC;
	if ($status == 1) {
		$applytitle = '待确认';
	}
	else if ($status == 2) {
		$applytitle = '待打款';
	}
	else if ($status == 3) {
		$applytitle = '已打款';
	}
	else {
		if ($status == -1) {
			$action_status = '_1';
			$applytitle = '已无效';
		}
	}
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$condition = ' and u.uniacid=:uniacid ';
	$params = array(':uniacid' => $_W['uniacid']);
	if(MERCHANTID){
		$condition .= ' and b.merchantid=:merchantid ';
		$params[':merchantid'] = MERCHANTID;
	}
	
	$timetype = $_GPC['timetype'];
	if (!empty($_GPC['timetype'])) {
		$starttime = strtotime($_GPC['time']['start']);
		$endtime = strtotime($_GPC['time']['end']);

		if (!empty($timetype)) {
			$condition .= ' AND b.' . $timetype . ' >= :starttime AND b.' . $timetype . '  <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
		}
	}
	
	$condition .= ' and b.status=:status';
	$params[':status'] = (int) $status;
	if ($_GPC['status'] !== '' && $_GPC['status'] !== NULL) {
		$_GPC['status'] = intval($_GPC['status']);
		$params[':status'] = $_GPC['status'];
	}
	
	$searchfield = strtolower(trim($_GPC['searchfield']));
	$keyword = trim($_GPC['keyword']);
	if (!empty($keyword)) {
		if ($searchfield == 'orderno') {
			$condition .= ' and b.orderno like :keyword';
		}
		else {
			if ($searchfield == 'member') {
				$condition .= ' and ( u.name like :keyword or u.linkman_mobile like :keyword or u.linkman_name like :keyword)';
			}else{
				$condition .= ' and b.orderno like :keyword';
			}
		}

		$params[':keyword'] = '%' . $keyword . '%';
	}
	
	$sql = 'select b.*,u.name,u.linkman_name,u.linkman_mobile from ' . tablename('fx_merchant_record') . ' b ' . ' left join ' . tablename('fx_merchant') . ' u on b.merchantid = u.id' . (' where 1 ' . $condition . ' ORDER BY b.id desc ');
	$sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;

	$list = pdo_fetchall($sql, $params);
	
	$total = pdo_fetchcolumn('select COUNT(1) from ' . tablename('fx_merchant_record') . ' b ' . ' left join ' . tablename('fx_merchant') . ' u on b.merchantid = u.id' . (' where 1 ' . $condition), $params);
	$pager = pagination($total, $pindex, $psize);
	
	foreach($list as$key=>&$value){
		$value['percent'] = empty($value['percent'])?'0.00':$value['percent'];
		$value['merchant'] = model_merchant::getSingleMerchant($value['merchantid'], '*');
	}
	include fx_template('merch/apply');
}
function status1()
{
	main(1);
}

function status2()
{
	main(2);
}

function status3()
{
	main(3);
}

function merchpay(){
	global $_W,$_GPC;
	$id = intval($_GPC['id'])?intval($_GPC['id']):0;
	if ($_W['ispost'] && $id) {
		$record = pdo_fetch("select * from".tablename('fx_merchant_record')."where uniacid={$_W['uniacid']} and id={$id}");
		$item = model_merchant::getSingleMerchant($record['merchantid'], '*');
		$orderno = $record['orderno'];
		$time = TIMESTAMP;
		if($_GPC['type']==1){
			pdo_update('fx_merchant_record',array('status'=>2, 'updatetime'=>$time, 'checktime'=>$time), array('id'=>$id));
			web_json();
		}elseif($_GPC['type']==2){//打款到微信钱包
			if($record['status']==3) web_json('当前提现已完成，无需重复处理！', 0);
			if(empty($item['openid'])) web_json('您未绑定提现微信号！', 0);			
			$money = $record['money'];//实扣金额（元）
			$get_money = $record['get_money'];//实到金额（元）
			$commission = sprintf("%.2f",$record['commission']);//手续费
			$no_money  = model_merchant::getNoSettlementMoney($record['merchantid']); //未结算金额
			$minimum = empty($_W['_config']['merch_amount']) ? 1 : $_W['_config']['merch_amount'];//每笔提现金额最低值
			$maximum = empty($_W['_config']['merch_maximum']) ? 10000 : $_W['_config']['merch_maximum'];//每笔提现金额最大值
			
			if($get_money<$minimum) web_json('输入金额不得小于'.$minimum.'元', 0);
			if($get_money>$maximum) web_json('单次提现金额不得大于'.$maximum.'元', 0);
			if($no_money<$money) web_json('您没有足够的可结算金额！', 0);
			$result = model_merchant::finance($item['openid'], $get_money * 100, '主办方提现');  //结算操作
			if ($result['return_code'] != 'SUCCESS' || $result['result_code'] != 'SUCCESS'){
				web_json('微信钱包提现失败: ' .$result['err_code']."|" .$result['err_code_des'], 0);
			}else{
				pdo_update('fx_merchant_account',array('no_money_doing'=>0),array('merchantid'=>$record['merchantid']));
				pdo_insert("fx_merchant_money_record",array('merchantid'=>$record['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>0-$get_money,'recordsid'=>'','createtime'=>$time,'type'=>4,'detail'=>$orderno));
				if($commission>0)
				pdo_insert("fx_merchant_money_record",array('merchantid'=>$record['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>0-$commission,'recordsid'=>'','createtime'=>$time,'type'=>7,'detail'=>$orderno));
				$res = model_merchant::updateNoSettlementMoney(0-$money, $record['merchantid']);
				if($res){
					pdo_update('fx_merchant_record',array('status'=>3,'updatetime'=>$time, 'paytime'=>$time, 'type'=>1),array('id'=>$id));
				}else{
					web_json('打款成功，更新结算金额失败！' , 0);
				}		
			} 
			web_json(referer());
		}elseif($_GPC['type']==3){ //手动处理，不打款
			if($record['status']==3) web_json('当前提现已完成，无需重复处理！', 0);
			$money = $record['money'];//实扣金额（元）
			$get_money = $record['get_money'];//实到金额（元）
			$commission = sprintf("%.2f",$record['commission']);//手续费
			$no_money  = model_merchant::getNoSettlementMoney($record['merchantid']); //未结算金额
			$minimum = empty($_W['_config']['merch_amount']) ? 1 : $_W['_config']['merch_amount'];//每笔提现金额最低值
			$maximum = empty($_W['_config']['merch_maximum']) ? 10000 : $_W['_config']['merch_maximum'];//每笔提现金额最大值		
			
			if($get_money<$minimum) web_json('输入金额不得小于'.$minimum.'元', 0);
			if($get_money>$maximum) web_json('单次提现金额不得大于'.$maximum.'元', 0);
			if($no_money<$money) web_json('您没有足够的可结算金额！', 0);
			pdo_update('fx_merchant_account',array('no_money_doing'=>0),array('merchantid'=>$record['merchantid']));
			pdo_insert("fx_merchant_money_record",array('merchantid'=>$record['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>0-$get_money,'recordsid'=>'','createtime'=>$time,'type'=>4,'detail'=>$orderno));
			if($commission>0)
			pdo_insert("fx_merchant_money_record",array('merchantid'=>$record['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>0-$commission,'recordsid'=>'','createtime'=>$time,'type'=>7,'detail'=>$orderno));
			$res = model_merchant::updateNoSettlementMoney(0-$money, $record['merchantid']);
			if($res){//更新结算后主办方可结算余额
				pdo_update('fx_merchant_record',array('status'=>3,'updatetime'=>$time, 'paytime'=>$time, 'type'=>2),array('id'=>$id));
			}else{
				web_json('结算成功，更新结算金额失败！', 0);
			}
			web_json(referer());
		}
		web_json('缺少参数！', 0);
	}else{
		web_json('缺少参数！', 0);
	}
}