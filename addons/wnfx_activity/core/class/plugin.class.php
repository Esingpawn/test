<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 插件模型
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
class plugin{
	static public $modules='';
	static public $getCount = 0;
	static public $getList = array();
	
	
	static function getSet($name='')
	{
		global $_W;
		$uni_modules = uni_modules();
		return $uni_modules['fx_activity_plugin_'.$name];
	}
	
	static function getCount()
	{
		global $_W;
		self::$getCount = count($_W['current_module']['plugin_list']) + 1;
		return self::$getCount;
	}
	
	static function p($name='')
	{
		global $_W;
		return perm_isopen($name, false);
	}
}

