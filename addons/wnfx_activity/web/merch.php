<?php
global $_W,$_GPC;
define('IN_SYS', true);
define("IN_MODULE", 'wnfx_activity');
define('MERCH', true);
define('FRAME', '');
define('FX_PATH', '../../../');
define('FX_BASE', '../../../addons/' . IN_MODULE . '/');
require_once '../../../framework/bootstrap.inc.php';
require_once IA_ROOT . '/addons/wnfx_activity/web/common/bootstrap.sys.inc.php';
require_once IA_ROOT . '/addons/wnfx_activity/core/common/defines.php';
require_once FX_CORE . '/class/loader.class.php';
$autoload =  FX_CORE . '/class/autoload.php';
if(file_exists($autoload)) require $autoload;
load()->web('template');
fx_load()->web('common');
fx_load()->func('template');
fx_load()->func('global');;
fx_load()->model('plugin');
fx_load()->func('tpl');
session_start();
$_W['isv2'] = true;
if(igetcookie('__fx_session')==''){	
	require MODULE_ROOT . '/web/source/user/login.ctrl.php';
}else{
	if($_GPC['c']=='utility'){
		$_W['uid'] = $_SESSION['role_id'];
		require MODULE_ROOT . '/web/source/utility/file.ctrl.php';
	}else{
		$_SESSION['role'] = igetcookie('__role');
		$_SESSION['role_id'] = igetcookie('__role_id');
		$_SESSION['role_name'] = igetcookie('__role_name');
		$_SESSION['role_logo'] = igetcookie('__role_logo');
		define('UNIACID', $_GPC['__uniacid']);
		define('FX_ID', " and id = '{$_SESSION['role_id']}' ");
		define('FX_MERCHANTID', " and merchantid = '{$_SESSION['role_id']}' ");
		define('MERCHANTID', $_SESSION['role_id']);
		
		$_W['uniacid'] = $_GPC['__uniacid'];
		$_W['account']['modules'] = $modules = uni_modules();
		$_W['current_module'] = $modules[IN_MODULE];
		$_W['_config'] = $_W['current_module']['config'];
		//兼容新老用户插件调用
		define("PLUGIN_CARD", (empty($modules['wnfx_activity_plugin_babycard']) ? '' : 'wn') . 'fx_activity_plugin_babycard');
		define("PLUGIN_POSTER", (empty($modules['wnfx_activity_plugin_poster']) ? '' : 'wn') . 'fx_activity_plugin_poster');
		define("PLUGIN_SEAT", (empty($modules['wnfx_activity_plugin_seat']) ? '' : 'wn') . 'fx_activity_plugin_seat');
		
		if (empty(trim($_GPC['r']))) {			
			header('location: ' . web_url('activity'));
		}else{
			if ($_GPC['r'] == PLUGIN_SEAT) header('location: ' . web_url('seat'));
		}
		
		$_W['plugin'] = plugin_setting();
		$_W['setting']['copyright']['blogo'] = empty($_W['_config']['merch_logo'])?$_W['setting']['copyright']['blogo']:$_W['_config']['merch_logo'];
		$_W['uniaccount']['name'] = $_SESSION['role_name'];
		if (empty($_W['setting']['remote'])){
			$remote =uni_setting($_W['uniacid'],array('remote_complete_info','remote'));
			$_W['setting']['remote'] = $remote['remote'];
		}
		$_W['setting']['remote'] = !empty($_W['account']['setting']['remote']) ? $_W['account']['setting']['remote'] : $_W['setting']['remote'];
		if (!empty($_W['setting']['remote']['type'])) {
			if ($_W['setting']['remote']['type'] == ATTACH_FTP) {
				$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['ftp']['url'] . '/';
			} elseif ($_W['setting']['remote']['type'] == ATTACH_OSS) {
				$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['alioss']['url'].'/';
			} elseif ($_W['setting']['remote']['type'] == ATTACH_QINIU) {
				$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['qiniu']['url'].'/';
			} elseif ($_W['setting']['remote']['type'] == ATTACH_COS) {
				$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['cos']['url'].'/';
			}
		}
		RouteModel::run();
	}
}