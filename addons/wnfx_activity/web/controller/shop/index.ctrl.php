<?php 
defined('IN_IA') or exit('Access Denied');
function main() {
	global $_W, $_GPC;
	if (perm('shop.adv')) {
		header('location: ' . web_url('shop/adv'));
	}else {
		header('location: ' . web_url());
	}
}

function ajax() {
	global $_W, $_GPC;
	$paras = array(':uniacid' => $_W['uniacid']);
	$goods_totals = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity') . " WHERE uniacid = :uniacid AND UNIX_TIMESTAMP()<UNIX_TIMESTAMP(endtime) AND `show`=1 AND cycle=0 AND review=1", $paras);
	
	$finance_total = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_merchant_record') . ' WHERE uniacid = :uniacid and status=1', $paras);
	
	$commission_agent_total = pdo_fetchcolumn('select count(1) from' . tablename('fx_agents') . ' dm ' . ' left join ' . tablename('mc_members') . ' p on p.uid = dm.member_id ' . ' left join ' . tablename('mc_mapping_fans') . 'f on f.uid=dm.member_id' . ' where dm.uniacid =:uniacid and dm.is_pass =1 and dm.is_black =0', array(':uniacid' => $_W['uniacid']));
	
	$commission_agent_status0_total = pdo_fetchcolumn('select count(1) from' . tablename('fx_agents') . ' dm ' . ' left join ' . tablename('mc_members') . ' p on p.uid = dm.member_id ' . ' left join ' . tablename('mc_mapping_fans') . 'f on f.uid=dm.member_id' . ' where dm.uniacid =:uniacid and dm.is_pass =0 and dm.is_black =0', array(':uniacid' => $_W['uniacid']));
	
	$commission_apply_status1_total = pdo_fetchcolumn('select count(1) from' . tablename('fx_withdraw') . ' where uniacid=:uniacid and status=:status', array(':uniacid' => $_W['uniacid'], ':status' => 0));
	
	$commission_apply_status2_total = pdo_fetchcolumn('select count(1) from' . tablename('fx_withdraw') . ' where uniacid=:uniacid and status=:status', array(':uniacid' => $_W['uniacid'], ':status' => 1));
	
	show_json(array('goods_totals' => $goods_totals, 'finance_total' => $finance_total, 'commission_agent_total' => $commission_agent_total, 'commission_agent_status0_total' => $commission_agent_status0_total, 'commission_apply_status1_total' => $commission_apply_status1_total, 'commission_apply_status2_total' => $commission_apply_status2_total));
}