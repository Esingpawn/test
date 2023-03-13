<?php
/**
 * 活动报名模块微站定义
 * @author 山西微链网络科技有限公司
 * @url https://www.sxwelink.com/
 */
defined('IN_IA') or exit('Access Denied');
require IA_ROOT . '/addons/wnfx_activity/core/common/defines.php';
require FX_CORE . '/class/loader.class.php';
$autoload = FX_CORE . '/class/autoload.php';
if(file_exists($autoload)) require $autoload;
fx_load()->func('global');
fx_load()->model('plugin');
load()->func('tpl');
fx_load()->func('tpl');
fx_load()->func('template');
class Wnfx_activityModuleSite extends WeModuleSite {
	public $settings;
	
	public function __construct()
	{
		global $_W,$_GPC;
		$_W['isv2'] = true;
		$_W['account']['modules'] = $modules = uni_modules();
		$module = $modules['wnfx_activity'];
		$this->settings = $_W['_config'] = $module['config'];
		//兼容新老用户插件调用
		define("PLUGIN_CARD", (empty($modules['wnfx_activity_plugin_babycard']) ? '' : 'wn') . 'fx_activity_plugin_babycard');
		define("PLUGIN_POSTER", (empty($modules['wnfx_activity_plugin_poster']) ? '' : 'wn') . 'fx_activity_plugin_poster');
		define("PLUGIN_SEAT", (empty($modules['wnfx_activity_plugin_seat']) ? '' : 'wn') . 'fx_activity_plugin_seat');
		$_W['plugin'] = plugin_setting();
	}
	
	function __call($name, $arguments) {
		global $_W,$_GPC;
		$isWeb = stripos($name, 'doWeb') === 0;
		$isMobile = stripos($name, 'doMobile') === 0;
		$segment = $_GPC['do'];
		if (!empty($_GPC['ac'])) {
			$segment .= ".{$_GPC['ac']}";
		}
		if (!empty($_GPC['op'])) {
			$segment .= ".{$_GPC['op']}";
		}
		$_GPC['r'] = $segment;
		
		if($isWeb) {
			RouteModel::run();
		}
		
		if($isMobile) {
			RouteModel::run(false);
		}
		exit;
	}
	
	public function doWebWeb()
	{
		RouteModel::run();
	}
	
	public function doMobileMobile()
	{
		RouteModel::run(false);
	}
	
	/*兼容系统默认入口*/
	public function doMobileIndex()
	{
		RouteModel::run(false);
	}
	
	/*兼容老版本计划任务*/
	public function doMobileHome()
	{
		global $_W,$_GPC;
		if ($_GPC['ac']=='auto_task'){
			$_GPC['r'] = 'home.auto_task';
		}
		RouteModel::run(false);
	}
	
	/*结果返回*/
	public function payResult($params) {
		global $_W;
		$_W['page']['title'] = '支付结果';
		$_W['oauth']['uniacid'] = $_W['uniacid'];
		$_W['uniacid'] = $_W['acid'] = $params['uniacid'];
		load()->model('module');
		$this->module = module_fetch('wnfx_activity');
		$_W['_config'] = $this->module['config'];
		$_W['plugin'] = plugin_setting();
		if(!empty($params['tag'])) {
			$params['tag'] = iunserializer($params['tag']);	
		}
		payResult::payNotify($params);
	}
}