<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * map.ctrl
 * 地图控制器
 */
defined('IN_IA') or exit('Access Denied');
if($_W['op'] =='tencent'){
	$pagetitle = '腾讯地图开放API - 轻快小巧,简单易用!';
	include fx_template('map/map_tencent');
	exit;
}