<?php
function plugin_setting($mod='') {
	global $_W;
	$uni_modules = $_W['account']['modules'];
	$plugin = array();
	$plugin['card'] = $uni_modules[PLUGIN_CARD];
	$plugin['poster'] = $uni_modules[PLUGIN_POSTER];	
	return $plugin;
} 

function checkplugin($comname) {
	global $_W;
	$uni_modules = $_W['account']['modules'];
	$module = $uni_modules['wnfx_activity_plugin_'.$comname];
	$module = empty($module) ? $uni_modules['fx_activity_plugin_'.$comname] : $module;
	if (empty($module)) return false;
	return true;
}
function getplugin($comname) {
	global $_W;
	
}
