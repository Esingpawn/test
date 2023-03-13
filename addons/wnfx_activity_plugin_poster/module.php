<?php

defined('IN_IA') or exit('Access Denied');
define("MODULE_NAME", "wnfx_activity");
define("MODULE_PLUGIN_NAME", "wnfx_activity_plugin_poster");
require IA_ROOT . '/addons/' . MODULE_NAME . '/core/common/defines.php';
require FX_CORE . '/class/loader.class.php';
fx_load()->func('global');
fx_load()->func('template');
load()->func('tpl');
class Wnfx_activity_plugin_posterModule extends WeModule {
	public function welcomeDisplay(){
		global $_W, $_GPC;		
		$modules = uni_modules();
		$main1 = $modules['fx_activity'];
		$main2 = $modules['wnfx_activity'];
		if ($main1['wxapp_support']==2 || $main2['wxapp_support']==2){
			$result = pdo_update('modules', array('wxapp_support' => 2), array('wxapp_support'=>1, 'name' => $_W['current_module']['name']));
			if ($result) cache_clean();
		}
		$entry = pdo_get('modules_bindings', array('module' => $_W['current_module']['name'], 'entry' => 'cover'));
		header('location: index.php?c=platform&a=cover&eid='.$entry['eid'].'&version_id=0');
		exit();
	}
	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		
		$modules = uni_modules();
		$_W['main_module'] = $modules[MODULE_NAME];
		$taskurl = 'index.php?c=module&a=manage-account&do=setting&m=wnfx_activity&version_id=0';
		if ($_W['main_module']['version'] > '4.0') {
			$taskurl = web_url('sysset/task','','wnfx_activity');
		}
		if(checksubmit()) {
			$cfg = $_GPC['module'];
            if ($this->saveSettings($cfg)) {
                message('保存成功', 'refresh');
            }
		}
		include fx_template('setting');
	}
}
