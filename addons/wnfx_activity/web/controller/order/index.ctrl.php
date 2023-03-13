<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * order.ctrl
 * 订单管理控制器
 */
defined('IN_IA') or exit('Access Denied');
function ajaxorder() {
	global $_W, $_GPC;
	$day = (int) $_GPC['day'];

	if ($day == 30) {
	}

	$order = selectOrderPrice($day);
	unset($order['fetchall']);
	$allorder = selectOrderPrice($day, true);
	unset($allorder['fetchall']);
	$avg = selectOrderPrice($day, true, true);
	unset($allorder['fetchall']);
	$orders = array('order_count' => $order['count'], 'order_price' => number_format($order['price'], 2), 'allorder_count' => $allorder['count'], 'allorder_price' => number_format($allorder['price'], 2), 'avg' => number_format($avg['avg'], 2));
	show_json(array('order' => $orders));
}

function ajaxgettotals(){
	global $_W, $_GPC;
	$merch = intval(MERCHANTID);
	$totals = model_records::getTotals($merch);
	$result = empty($totals) ? array() : $totals;
	show_json($result);
}

function ajaxtransaction() {
	global $_W, $_GPC;
	
	$orderPrice = selectOrderPrice(7);
	$transaction = selectTransaction($orderPrice['fetchall'], 7);

	if (empty($transaction)) {
		$i = 7;

		while (1 <= $i) {
			$transaction['price'][date('Y-m-d', time() - $i * 3600 * 24)] = 0;
			$transaction['count'][date('Y-m-d', time() - $i * 3600 * 24)] = 0;
			--$i;
		}
	}else {
		foreach ($transaction['price'] as &$item) {
			$item = round($item, 2);
		}

		unset($item);
	}

	$allorderPrice = selectOrderPrice(7, true);
	$alltransaction = selectTransaction($allorderPrice['fetchall'], 7, true);

	if (empty($alltransaction)) {
		$i = 7;

		while (1 <= $i) {
			$alltransaction['price'][date('Y-m-d', time() - $i * 3600 * 24)] = 0;
			$alltransaction['count'][date('Y-m-d', time() - $i * 3600 * 24)] = 0;
			--$i;
		}
	}else {
		foreach ($alltransaction['price'] as &$item) {
			$item = round($item, 2);
		}

		unset($item);
	}
	
	die(json_encode(array(
	'price_key' => array_keys($transaction['price']), 
	'price_value' => array_values($transaction['price']), 
	'count_value' => array_values($transaction['count']), 
	'allprice_value' => array_values($alltransaction['price']), 
	'allcount_value' => array_values($alltransaction['count'])
	)));
}

/**
 * 查询订单金额
 * @param int $day 查询天数
 * @param bool $is_all 是否是全部订单
 * @param bool $is_avg 是否是查询付款平均数
 * @return bool
 */
function selectOrderPrice($day = 0, $is_all = false, $is_avg = false) {
	global $_W;
	$day = (int) $day;

	if ($day != 0) {
		if ($day == 30) {
			$yest = date('Y-m-d');
			$nowday = substr(date('Y-m-d', time()), -2);
			$nowday = (int) $nowday;
			$createtime1 = strtotime(date('Y-m-d', strtotime('-' . $nowday . 'day')));
			$createtime2 = strtotime($yest . ' 23:59:59');
		}else if ($day == 7) {
			$yest = date('Y-m-d');
			$createtime1 = strtotime(date('Y-m-d', strtotime('-7 day')));
			$createtime2 = strtotime($yest . ' 23:59:59');
		}else {
			$yesterday = strtotime('-1 day');
			$yy = date('Y', $yesterday);
			$ym = date('m', $yesterday);
			$yd = date('d', $yesterday);
			$createtime1 = strtotime($yy . '-' . $ym . '-' . $yd . ' 00:00:00');
			$createtime2 = strtotime($yy . '-' . $ym . '-' . $yd . ' 23:59:59');
		}
	}else {
		$createtime1 = strtotime(date('Y-m-d', time()));
		$createtime2 = strtotime(date('Y-m-d', time())) + 3600 * 24 - 1;
	}
	
	$time = 'UNIX_TIMESTAMP(paytime) as paytime';
	$where = ' and (( status > 0 and (UNIX_TIMESTAMP(paytime) between :createtime1 and :createtime2)) or ((UNIX_TIMESTAMP(jointime) between :createtime1 and :createtime2 ) and status>=0 and paytype<>""))';

	if (!empty($is_all)) {
		$time = 'UNIX_TIMESTAMP(jointime) as jointime';
		$where = ' and UNIX_TIMESTAMP(jointime) between :createtime1 and :createtime2';
	}

	if (!empty($is_avg)) {
		$time = 'UNIX_TIMESTAMP(paytime) as paytime';
		$where = ' and (status >0 and (UNIX_TIMESTAMP(paytime) between :createtime1 and :createtime2))';
	}

	$sql = 'select id,payprice as price,openid,' . $time . ' from ' . tablename('fx_activity_records') . ' where uniacid = :uniacid ' . $where;
	$param = array(':uniacid' => $_W['uniacid'], ':createtime1' => $createtime1, ':createtime2' => $createtime2);
	$pdo_res = pdo_fetchall($sql, $param);
	$price = 0;
	$avg = 0;
	$member = array();

	foreach ($pdo_res as $arr) {
		$arr['price'] = empty($arr['price']) ? 0 : $arr['price'];
		$price += $arr['price'];
		$member[] = $arr['openid'];
	}

	if (!empty($is_avg)) {
		$member_num = count(array_unique($member));
		$avg = empty($member_num) ? 0 : round($price / $member_num, 2);
	}
	
	$result = array('price' => $price, 'count' => count($pdo_res), 'avg' => $avg, 'fetchall' => $pdo_res);
	return $result;
}

/**
 * 查询近七天交易记录
 * @param array $pdo_fetchall 查询订单的记录
 * @param int $days 查询天数默认7
 * @param int $is_all 是否是全部订单
 * @return $transaction["price"] 七日 每日交易金额
 * @return $transaction["count"] 七日 每日交易订单数
 */
function selectTransaction(array $pdo_fetchall, $days = 7, $is_all = false)
{
	$transaction = array();
	$days = (int) $days;

	if (!empty($pdo_fetchall)) {
		$i = $days;

		while (1 <= $i) {
			$transaction['price'][date('Y-m-d', time() - $i * 3600 * 24)] = 0;
			$transaction['count'][date('Y-m-d', time() - $i * 3600 * 24)] = 0;
			--$i;
		}

		if (empty($is_all)) {
			foreach ($pdo_fetchall as $key => $value) {
				if (array_key_exists(date('Y-m-d', $value['paytime']), $transaction['price'])) {
					$transaction['price'][date('Y-m-d', $value['paytime'])] += $value['price'];
					$transaction['count'][date('Y-m-d', $value['paytime'])] += 1;
				}
			}
		}else {
			foreach ($pdo_fetchall as $key => $value) {
				if (array_key_exists(date('Y-m-d', $value['jointime']), $transaction['price'])) {
					$value['price'] = empty($value['price']) ? 0 : $value['price'];
					$transaction['price'][date('Y-m-d', $value['jointime'])] += $value['price'];
					$transaction['count'][date('Y-m-d', $value['jointime'])] += 1;
				}
			}
		}

		return $transaction;
	}

	return array();
}