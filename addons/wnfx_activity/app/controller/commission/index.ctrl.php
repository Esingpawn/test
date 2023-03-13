<?php
define('IN_MOBILE', true);

function order() {
	global $_W, $_GPC;
	$pagetitle  = '订单明细';
	$condition = " uniacid = '{$_W['uniacid']}' and member_id = '{$_W['member']['uid']}'";
	$total = array();
	switch($_GPC['status']){
		case '0':
			$pagetitle = '未支付';
			$condition .=" and status = 0";
			break;
		case '1':
		case '2':
			$pagetitle = '已支付';
			$condition .=" and (status = 1 or status = 2) and withdraw = 0";
			break;
		case '3':
			$pagetitle = '已完成';
			$condition .=" and status = 2 and withdraw = 1";
			break;
		default:
			$total[] = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE $condition and status = 0");
			$total[] = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE $condition and status in (1,2) and withdraw=0");
			$total[] = pdo_fetchcolumn('SELECT SUM(commission) FROM ' . tablename('fx_commission_order') . " WHERE $condition and status=2 and withdraw=1");
			$total[0] = sprintf("%.2f", $total[0]);
			$total[1] = sprintf("%.2f", $total[1]);
			$total[2] = sprintf("%.2f", $total[2]);
			break;
	}
	$orderTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_commission_order') . " WHERE $condition");
	$commission = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE $condition");
	$amount = pdo_fetchcolumn('SELECT SUM(commission_amount) FROM ' . tablename('fx_commission_order') . " WHERE $condition");
	$commission = sprintf("%.2f", $commission);
	$amount = sprintf("%.2f", $amount);
	include fx_template();
}

function orderData() {
	global $_W, $_GPC;	
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$condition = " uniacid = '{$_W['uniacid']}' and member_id = '{$_W['member']['uid']}'";
	switch($_GPC['status']){
		case '0':$condition .=" and status = 0";break;
		case '1':
		case '2':
			$condition .=" and (status = 1 or status = 2) and withdraw = 0";
			break;
		case '3':
			$condition .=" and status = 2 and withdraw = 1";
			break;
		default:'';
	}
	$list = pdo_fetchall ("SELECT * FROM " . tablename ('fx_commission_order') . "  WHERE $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename ('fx_commission_order') . " WHERE $condition");
	foreach ($list as $k => &$item) {
		$item['member'] = m('member')->getMember($item['buy_id']);
		$item['parentMember'] = m('member')->getMember($item['member_id']);
		$item['commission_rate'] = $item['commission_rate'] .'%';
	}
	$data['list'] = $list;
	$data['pagesize'] = $psize;
	$data['total'] = (int)$total;
	$data['tpage'] = (empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);	
	show_json($data, 1);
}