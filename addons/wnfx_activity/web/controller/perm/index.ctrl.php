<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * perm
 * 权限设置控制器
 */
defined('IN_IA') or exit('Access Denied');
function main()
{
	global $_W, $_GPC;
	if ($_W['routes']=='perm.role') {
		header('location: ' . web_url('perm/role'));
		exit();
	}else if ($_W['routes']=='perm.user') {
		header('location: ' . web_url('perm/user'));
		exit();
	}else if ($_W['routes']=='perm.log') {
		header('location: ' . web_url('perm/log'));
		exit();
	}else if ($_W['routes']=='perm.merch') {
		header('location: ' . web_url('perm/merch'));
		exit();
	}else {
		header('location: ' . web_url('perm/role'));
		exit();
	}
}
?>
