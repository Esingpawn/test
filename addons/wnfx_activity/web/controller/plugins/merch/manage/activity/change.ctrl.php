<?php
defined('IN_IA') or exit('Access Denied');
$id = $_GPC['id'];
$ids = $_GPC['ids'];
$type = $_GPC['type'];
$value = $_GPC['value'];

$where = array('id' => empty($ids)?$id:$ids);
$data = array($_W['op'] => $value);
if ($_W['op'] =='restore') {
	$_W['op'] = 'cycle';
	$value = 0;
}
if ($_W['isajax']){
	$result = pdo_update('fx_activity', array($_W['op'] => $value),$where);
}	
if ($result){
	web_json();
}else{
	web_json('操作失败',0);
}