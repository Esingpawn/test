<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * entry.ctrl
 * 蜗牛科技
 */
defined('IN_IA') or exit('Access Denied');
$opp = !empty($_GPC['opp']) ? $_GPC['opp'] : 'display';

$con     = "A.uniacid='{$_W['uniacid']}' and A.uid = B.uid ";
$keyword = $_GPC['keyword'];
if ($keyword != '') {
	$con .= " and (A.nickname LIKE '%{$keyword}%' or B.openid LIKE '%{$keyword}%'or A.mobile LIKE '%{$keyword}%') ";
}
$field  = "A.uid, A.nickname, A.mobile, avatar, B.openid";
$inner  = tablename ('mc_members') . "A , " . tablename ('mc_mapping_fans') . "B ";
$ds = pdo_fetchall("select ".$field." from" . $inner . "where $con");
include fx_template();
exit;