<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * map.ctrl
 * 地图控制器
 */
defined('IN_IA') or exit('Access Denied');

function tencent(){
	global $_W,$_GPC;
	include fx_template('map/map_tencent');
	exit;
}