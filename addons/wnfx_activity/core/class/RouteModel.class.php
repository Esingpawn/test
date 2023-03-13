<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 入口模型
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
class RouteModel
{
	static function run($isweb = true)
	{
		global $_W,$_GPC;
		if ($isweb) {
			require_once FX_CORE . '/inc/web.php';
		}else{
			require_once FX_CORE . '/inc/mobile.php';
		}
		$r = str_replace('//', '/', trim($_GPC['r'], '/'));
		$routes = !empty($r) ? explode('.', $r) : array();
		$len = count($routes);
		$method = 'main';
		$root = $isweb ? FX_WEB . '/controller/' : FX_APP . '/controller/';
		$isMerch = false;
		if (strexists($_W['siteurl'], 'web/merch.php')) {
			if (empty($r)) {
				$r = 'merch.manage';
				$routes = explode('.', $r);
			}

			$isMerch = true;
			$isplugin = true;
		}else{
			$isplugin = !empty($r) && is_dir($root . 'plugins/' . $routes[0]);
		}
		
		if ($isplugin) {
			$_W['_plugin'] = $routes[0];
			$root .= 'plugins/';
			if ($isMerch) {
				$_W['_plugin'] = 'merch';
				$root .=  'merch/manage/';
			}
		}

		switch ($len) {
		case 0:
			$root = $isweb ? FX_WEB : FX_APP;
			$file = $root . '/' . 'index.php';
			break;
		case 1: 
			$file = $root . $routes[0] . '/' . $routes[0] . '.ctrl.php';
			if (!file_exists($file)) {
				if (is_dir($root . $routes[0])) {
					$file = $root . $routes[0] . '/index.ctrl.php';
				}else{
					$file = $root . 'index.ctrl.php';
					$method = $routes[0];
				}
			}
			$_W['action'] = $routes[0];
			$_W['op'] = $_GPC['op'] = 'display';
			break;
		case 2:
			$file = $root . $routes[0] . '/' . $routes[1] . '.ctrl.php';
			if (!file_exists($file)) {
				$file = $root . $routes[0] . '/' . $routes[1] . '/index.ctrl.php';
			}			
			if (!is_file($file)) {
				$file = $root . $routes[0] . '.ctrl.php';
				if (!file_exists($file)) {					
					$file = $root . $routes[0] . '/' . $routes[0] . '.ctrl.php';
				}
				if (!file_exists($file)) {					
					$file = $root . $routes[0] . '/index.ctrl.php';
				}
				$method = $_W['op'] = $_GPC['op'] = $routes[1];
			}else{
				$_W['op'] = $_GPC['op'] = 'display';
			}
			$_W['action'] = $routes[0] . '.' . $routes[1];
			break;
		case 3:
			$_W['action'] = $routes[0] . '.' . $routes[1] . '.' . $routes[2];
			$file = $root . $routes[0] . '/' . $routes[1] . '/' . $routes[2] . '.ctrl.php';
			if (!file_exists($file)) {
				$file = $root . $routes[0] . '/' . $routes[1] . '/' . $routes[2] . '/index.ctrl.php';
			}
			if (!is_file($file)) {
				$file = $root . $routes[0] . '/' . $routes[1] . '.ctrl.php';
				if (!file_exists($file)) {
					$file = $root . $routes[0] . '/' . $routes[1] . '/index.ctrl.php';
				}
				if (!file_exists($file)) {
					$file = $root . $routes[0] . '/index.ctrl.php';
				}
				$method = $_W['op'] = $_GPC['op'] = $routes[2];
				$_W['action'] = $routes[0] . '.' . $routes[1];
			}else{
				$_W['op'] = $_GPC['op'] = 'display';
			}
			break;
		case 4:
			$file = $root . $routes[0] . '/' . $routes[1] . '/' . $routes[2] . '/' . $routes[3] . '.ctrl.php';
			if (!file_exists($file)) {
				$file = $root . $routes[0] . '/' . $routes[1] . '/' . $routes[2] . '/' . $routes[3] . '/index.ctrl.php';
			}
			if (!is_file($file)) {
				$file = $root . $routes[0] . '/' . $routes[1] . '/' . $routes[2] . '.ctrl.php';
				if (!file_exists($file)) {
					$file = $root . $routes[0] . '/' . $routes[1] . '/' . $routes[2] . '/index.ctrl.php';
				}
				if (!file_exists($file)) {
					$file = $root . $routes[0] . '/' . $routes[1] . '/index.ctrl.php';
				}
				if (!file_exists($file)) {
					$file = $root . $routes[0] . '/index.ctrl.php';
				}
				$method = $_W['op'] = $_GPC['op'] = $routes[3];	
			}else{
				$_W['op'] = $_GPC['op'] = 'display';
			}
			$_W['action'] = $routes[0] . '.' . $routes[1] . '.' . $routes[2];
			break;
		}
		if (!is_file($file)) {
			exit('未找到控制器 ' . $file);
		}
		$_W['routes'] = $r;
		$_W['isplugin'] = $isplugin;
		$_W['controller'] = $routes[0];
		
		include $file;
		
		if (function_exists($method)) {
			$method();
		}else{
			if ($isweb) {
				if (!$_W['ispost'] && !$_W['isajax']) {
					exit('<!--控制器 ' . $_W['controller'] . ' 方法 ' . $method . ' 未找到!-->');
				}else{
					//web_json('控制器 ' . $_W['controller'] . ' 方法 ' . $method . ' 未找到!');
				}
			}else{
				//fx_message('控制器 ' . $_W['controller'] . ' 方法 ' . $method . ' 未找到!','', 'warning', '');
			}
		}
		exit();
	}
}

