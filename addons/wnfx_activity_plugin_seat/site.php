<?php
/**
 * 活动报名模块微站定义
 *
 * @author 奔跑的蜗牛
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
define("MODULE_NAME", "wnfx_activity");
define("MODULE_PLUGIN_NAME", "wnfx_activity_plugin_seat");
require IA_ROOT . '/addons/' . MODULE_NAME . '/core/common/defines.php';
require FX_CORE . '/class/loader.class.php';
$autoload = FX_CORE . '/class/autoload.php';
if(file_exists($autoload)) require $autoload;
load()->func('tpl');
fx_load()->func('global');
fx_load()->func('template');
class Wnfx_activity_plugin_seatModuleSite extends WeModuleSite {
	public $settings;
	public function __construct()
	{
		global $_W,$_GPC;
		$_W['isv2'] = true;
		$modules = uni_modules();		
		$module = $modules[MODULE_PLUGIN_NAME];
		$this->settings = $module['config'];
	}
	
	public function doWebWeb()
	{
		RouteModel::run();
	}
	
	public function doMobileMobile()
	{
		RouteModel::run(false);
	}
}