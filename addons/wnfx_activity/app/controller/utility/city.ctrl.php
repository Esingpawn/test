<?php 
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
global $_W,$_GPC;
if($_W['op'] =='display'){
	$pagetitle = '选择城市';
	include fx_template('utility/city');
	exit;
}