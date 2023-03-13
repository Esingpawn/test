<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * order.ctrl
 * 报名订单控制器
 */
defined('IN_IA') or exit('Access Denied');
function main(){
	global $_W,$_GPC;
	//current_module
	$account = (array)$_W['account'];
	show_json($_W['_config'], 1);
}

function config(){
	global $_W,$_GPC;
	$_W['_config']['homeswitch'] = $_W['_config']['homeswitch'] || $_W['_config']['homeswitch'] == '' ? 1 : 0;
	show_json($_W['_config'], 1);
}