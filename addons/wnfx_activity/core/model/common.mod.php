<?php
/*红客联盟  hon123.com*/
if (!defined('IN_IA')) {
	exit('Access Denied');
}
class Common_FxModel
{
	public $public_build;

	public function getSetData($uniacid = 0)
	{
		global $_W;

		if (empty($uniacid)) {
			$uniacid = $_W['uniacid'];
		}

		$set = m('cache')->getArray('sysset', $uniacid);

		if (empty($set)) {
			$set = pdo_fetch('select * from ' . tablename('fx_activity_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));

			if (empty($set)) {
				$set = array();
			}

			m('cache')->set('sysset', $set, $uniacid);
		}

		return $set;
	}

	/**
     * 获取配置
     */
	public function getSysset($key = '', $uniacid = 0)
	{
		global $_W;
		global $_GPC;
		$set = $this->getSetData($uniacid);
		$allset = iunserializer($set['sets']);
		$retsets = array();

		if (!empty($key)) {
			if (is_array($key)) {
				foreach ($key as $k) {
					$retsets[$k] = isset($allset[$k]) ? $allset[$k] : array();
				}
			}
			else {
				$retsets = isset($allset[$key]) ? $allset[$key] : array();
			}

			return $retsets;
		}

		return $allset;
	}

	public function getPluginset($key = '', $uniacid = 0)
	{
		global $_W;
		global $_GPC;
		$set = $this->getSetData($uniacid);
		$allset = iunserializer($set['plugins']);
		$retsets = array();

		if (!empty($key)) {
			if (is_array($key)) {
				foreach ($key as $k) {
					$retsets[$k] = isset($allset[$k]) ? $allset[$k] : array();
				}
			}
			else {
				$retsets = isset($allset[$key]) ? $allset[$key] : array();
			}

			return $retsets;
		}

		return $allset;
	}

	public function updateSysset($values, $uniacid = 0)
	{
		global $_W;
		global $_GPC;

		if (empty($uniacid)) {
			$uniacid = $_W['uniacid'];
		}

		$setdata = pdo_fetch('select * from ' . tablename('fx_activity_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));

		if (empty($setdata)) {
			$res = pdo_insert('fx_activity_sysset', array('sets' => iserializer($values), 'uniacid' => $uniacid));
			$setdata = array('sets' => $values);
		}
		else {
			$sets = iunserializer($setdata['sets']);
			$sets = is_array($sets) ? $sets : array();

			foreach ($values as $key => $value) {
				foreach ($value as $k => $v) {
					$sets[$key][$k] = $v;
				}
			}

			$res = pdo_update('fx_activity_sysset', array('sets' => iserializer($sets)), array('id' => $setdata['id']));

			if ($res) {
				$setdata['sets'] = $sets;
			}
		}

		if (empty($res)) {
			$setdata = pdo_fetch('select * from ' . tablename('fx_activity_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));
		}

		m('cache')->set('sysset', $setdata, $uniacid);
		$this->setGlobalSet($uniacid);
	}

	public function deleteSysset($key, $uniacid = 0)
	{
		global $_W;
		global $_GPC;

		if (empty($uniacid)) {
			$uniacid = $_W['uniacid'];
		}

		$setdata = pdo_fetch('select id, sets from ' . tablename('fx_activity_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));

		if (!empty($setdata)) {
			$sets = iunserializer($setdata['sets']);
			$sets = is_array($sets) ? $sets : array();

			if (!empty($key)) {
				if (is_array($key)) {
					foreach ($key as $k) {
						unset($sets[$k]);
					}
				}
				else {
					unset($sets[$key]);
				}
			}

			pdo_update('fx_activity_sysset', array('sets' => iserializer($sets)), array('id' => $setdata['id']));
		}

		$setdata = pdo_fetch('select * from ' . tablename('fx_activity_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));
		m('cache')->set('sysset', $setdata, $uniacid);
		$this->setGlobalSet($uniacid);
	}

	public function updatePluginset($values, $uniacid = 0)
	{
		global $_W;
		global $_GPC;

		if (empty($uniacid)) {
			$uniacid = $_W['uniacid'];
		}

		$setdata = pdo_fetch('select * from ' . tablename('fx_activity_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));

		if (empty($setdata)) {
			$res = pdo_insert('fx_activity_sysset', array('plugins' => iserializer($values), 'uniacid' => $uniacid));
			$setdata = array('plugins' => $values);
		}
		else {
			$plugins = iunserializer($setdata['plugins']);

			if (!is_array($plugins)) {
				$plugins = array();
			}

			foreach ($values as $key => $value) {
				foreach ($value as $k => $v) {
					if (!isset($plugins[$key]) || !is_array($plugins[$key])) {
						$plugins[$key] = array();
					}

					$plugins[$key][$k] = $v;
				}
			}

			$res = pdo_update('fx_activity_sysset', array('plugins' => iserializer($plugins)), array('id' => $setdata['id']));

			if ($res) {
				$setdata['plugins'] = $plugins;
			}
		}

		if (empty($res)) {
			$setdata = pdo_fetch('select * from ' . tablename('fx_activity_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $uniacid));
		}

		m('cache')->set('sysset', $setdata, $uniacid);
		$this->setGlobalSet($uniacid);
	}

	public function setGlobalSet($uniacid = 0)
	{
		$sysset = $this->getSysset('', $uniacid);
		$sysset = is_array($sysset) ? $sysset : array();
		$pluginset = $this->getPluginset('', $uniacid);

		if (is_array($pluginset)) {
			foreach ($pluginset as $k => $v) {
				$sysset[$k] = $v;
			}
		}

		m('cache')->set('globalset', $sysset, $uniacid);
		return $sysset;
	}
	
	public function globalVar(){
		global $uniacid, $yearcard, $vipdata, $is_vip, $agent, $mid;
		return array(
			'uniacid'=>$uniacid, 
			'yearcard'=>$yearcard, 
			'vipdata'=>$vipdata, 
			'is_vip'=>$is_vip, 
			'agent'=>$agent, 
			'mid'=>$mid
		);
	}
	
	public function arrayLevel($arr){
		$al = array(0);
		
		$this->aL($arr,$al);	
		return max($al);	
	}
	public function aL($arr,&$al,$level=0){
		if(is_array($arr)){
			$level++;
			$al[] = $level;
			foreach($arr as $v){
				$this->aL($v,$al,$level);
			}
		}
	}
}
?>