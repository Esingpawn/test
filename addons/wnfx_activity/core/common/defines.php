<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
} 
!defined('IN_MODULE') && define('IN_MODULE', 'wnfx_activity');
!defined('MAIN_MODULE') && define('MAIN_MODULE', 'wnfx_activity');
!defined('MODULE_ROOT') && define('MODULE_ROOT', IA_ROOT . '/addons/wnfx_activity');

!defined('FX_CORE') && define('FX_CORE', MODULE_ROOT . '/core');
!defined('FX_APP')  && define('FX_APP', MODULE_ROOT . '/app');
!defined('FX_WEB')  && define('FX_WEB', MODULE_ROOT . '/web');
!defined('FX_DATA') && define('FX_DATA', MODULE_ROOT . '/data');

!defined('FX_URL') && define('FX_URL', $_W['siteroot'] . 'addons/wnfx_activity/');
!defined('FX_PATH') && define('FX_PATH', '../');
!defined('FX_BASE') && define('FX_BASE', '../addons/wnfx_activity/');
!defined('FX_ACTIVITY_PREFIX') && define('FX_ACTIVITY_PREFIX', 'fx_activity_');
//插件常量
!defined('MODULE_PLUGIN_NAME') && define('MODULE_PLUGIN_NAME', '');
!defined('FX_PLUGIN_TEMPLATE') && define('FX_PLUGIN_TEMPLATE', '../../'.MODULE_PLUGIN_NAME . '/template');
!defined('FX_RELEASE_DATE') && define('FX_RELEASE_DATE', '202208010001');