<?php
if (empty($_GPC)) {
	require_once '../../../framework/bootstrap.inc.php';
	if ($_GPC['c'] == 'utility') {
		require IA_ROOT . '/addons/wnfx_activity/web/merch.php';
		exit ;
	}
}
function main() {
	global $_W, $_GPC;
	$shop_data['name'] = $_W['_config']['sname'];
	$shop_data['description'] = $_W['_config']['detail'];
	
	$pluginnum = plugin::getCount();
	$ordercol = 12;
	$hascommission = false;
	
	if (plugin::p('commission')) {
		$hascommission = 1;
	}
	
	$no_left = true;
	include fx_template();
}