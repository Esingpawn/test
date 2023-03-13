<?php

defined('IN_IA') or exit('Access Denied');
define("MODULE_NAME", "wnfx_activity");
define("MODULE_PLUGIN_NAME", "wnfx_activity_plugin_seat");
require IA_ROOT . '/addons/' . MODULE_NAME . '/core/common/defines.php';
require FX_CORE . '/class/loader.class.php';
fx_load()->func('global');
fx_load()->func('template');
load()->func('tpl');
class Wnfx_activity_plugin_seatModule extends WeModule {
	public function welcomeDisplay(){
		global $_W, $_GPC;
		$modules = uni_modules();
		$main1 = $modules['fx_activity'];
		$main2 = $modules['wnfx_activity'];
		if ($main1['wxapp_support']==2 || $main2['wxapp_support']==2){
			$result = pdo_update('modules', array('wxapp_support' => 2), array('wxapp_support'=>1, 'name' => $_W['current_module']['name']));
			if ($result) cache_clean();
		}
		if (!empty($main2))
			header('location:'.web_url('seat','','wnfx_activity'));
		else
			header('location:'.web_url('seat','','fx_activity'));
		exit();
	}
}