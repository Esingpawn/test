<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * join/form.ctrl
 * 报名表单控制器
 */
defined('IN_IA') or exit('Access Denied');
function main(){
	global $_W,$_GPC;
	$id = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
	$activity = model_activity::getSingleActivity($id, '*');
	
	$formnum  = intval($_GPC['buynum']);
	$index    = intval($_GPC['formlen']);
	$sysform  = $activity['form'];
	$forms = model_activity::getNumActivityForm($id,'app');//读取表单
	
	if(empty($profile['email']) || (!empty($profile['email']) && substr($profile['email'], -6) == 'we7.cc' && strlen($profile['email']) == 39)) {
		$profile['email'] = '';
	}
	
	define('TPL_INIT_CALENDAR', true);
	include fx_template();
}