<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * plugins
 * 应用控制器
 */
defined('IN_IA') or exit('Access Denied');

function main(){
	global $_W,$_GPC;
	$uniacid = $_W['uniacid'];
	$aid = intval($_GPC['aid'])?intval($_GPC['aid']):0;
	$group_plugin = pdo_fetchall('SELECT type FROM ' . tablename('modules') . ' WHERE name LIKE :name GROUP BY type', array(':name' =>"%fx_activity_plugin%"));
	foreach ($group_plugin as &$v) {
		$v['mod'] = pdo_getall('modules', array('name LIKE' => "%fx_activity_plugin%", 'type'=>$v['type']));
		foreach ($v['mod'] as $k => $m) {
			switch($m['name']){
				case 'fx_activity_plugin_poster' :
				case PLUGIN_POSTER :
					if (!perm('poster')) unset($v['mod'][$k]);
					break;
				case 'fx_activity_plugin_babycard' :
				case PLUGIN_CARD:
					if (!perm('vipcard')) unset($v['mod'][$k]);
					break;
				case 'fx_activity_plugin_seat' :
				case PLUGIN_SEAT:
					if (!perm('seat')) unset($v['mod'][$k]);
					break;
			}
		}
		switch($v['type']){
			case "business ":
				$v['type'] = '业务类';
				break;
			case "activity":
				$v['type'] = '营销类';
				break;
			case "services":
				$v['type'] = '工具类';
				break;
			case "biz":
				$v['type'] = '辅助类';
				break;
			case "enterprise":
				$v['type'] = '企业类';
				break;
			case "h5game":
				$v['type'] = '游戏';
				break;
			default:
				$v['type'] = '其它';
				break;
		}
	}	
	$result = pdo_update('modules', array('wxapp_support' => 2), array('name LIKE' => "%fx_activity_plugin%"));
	if ($result) cache_clean();	
	include fx_template();
}