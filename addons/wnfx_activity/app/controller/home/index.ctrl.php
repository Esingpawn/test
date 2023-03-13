<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * index.ctrl
 * 首页控制器
 */
defined('IN_IA') or exit('Access Denied');
function main(){
	global $_W, $_GPC;
	extract(m('common')->globalVar());
	$pagetitle = !empty($_W['_config']['sname']) ? $_W['_config']['sname'] : '活动首页';
	$catePro = Util::getNumData('*', 'fx_category', array('enabled'=>1,'visible_level'=>1), 'displayorder DESC',0,0,1);
	if (strpos($_W['siteroot'], 'https') !== false){//修复全部图标url中的https,影响腾讯定位
		$_W['_config']['catemoreico'] = tomedia($_W['_config']['catemoreico']);
		if (strpos($_W['_config']['catemoreico'], 'http://') !== false) {
			$_W['_config']['catemoreico'] = str_replace('http:', '', $_W['_config']['catemoreico']);
		}
	}else{
		$_W['_config']['catemoreico'] = tomedia($_W['_config']['catemoreico']);
	}
	$catemoreico = empty($_W['_config']['catemoreico']) ? tomedia('addons/wnfx_activity/app/resource/images/icon-class-all.png') : tomedia($_W['_config']['catemoreico']);
	//读取幻灯片
	$advlist = pdo_fetchall("SELECT * FROM " . tablename('fx_adv') . " WHERE uniacid = '{$_W['uniacid']}' and enabled=1 ORDER BY displayorder DESC");
	foreach ($advlist as $i => &$row) {
		if ($row['color']=='') $row['color'] = '#a6835a';
		$row['link'] = ($_W['account']->typeSign=='wxapp' ||  $_GPC['from']=='wxapp') && !empty($row['applink']) ? $row['applink'] : $row['link'];
	}
	if ($_W['_config']['location'] && !$_COOKIE['position'] && $_W['container']!='unknown') {
		include fx_template('common/header');
		exit;
	}
	if ($_W['_config']['sys']['waterfall']){
		include fx_template('index');
	}else{
		include fx_template('index_1');
	}
}

function hot(){
	global $_W, $_GPC;
	extract(m('common')->globalVar());
	$lat = $_GPC['lat'];
	$lng = $_GPC['lng'];
	$pindex = max(1, intval($_GPC['page']));
	$psize = intval($_GPC['pagesize']) ? intval($_GPC['pagesize']) : 15;
	
	$where = array('show' => 1, 'review' => 1, 'viewauth' => 0, 'recommend' => 1, 'cycle' => 0);
	if ($_W['_config']['location']){
		if (!empty($_GPC['ucity']) && $_GPC['ucity']!='全国')
		$where['sql'][] = "(INSTR(`adinfo`, '".$_GPC['ucity']."') or INSTR(`address`, '".$_GPC['ucity']."') or hasonline=1)";
	}
	$where['sql'][] = "UNIX_TIMESTAMP() <= UNIX_TIMESTAMP(joinetime) and UNIX_TIMESTAMP() <= UNIX_TIMESTAMP(endtime)";
	$order = "displayorder DESC,trueread DESC,id DESC";
	$field = "*";
	$activityData = Util::getNumData($field, 'fx_activity', $where, $order, $pindex, $psize, 1);
	foreach ($activityData[0] as &$s) {
		$s['minprice'] = array();
		$s['maxprice'] = array();
		$s['falsedata'] = unserialize($s['falsedata']);
		$s['falsedata']['num'] = intval($s['falsedata']['num']);
		$s['falsedata']['read'] = intval($s['falsedata']['read']);
		$s['falsedata']['share'] = intval($s['falsedata']['share']);
		$s['prize'] = unserialize($s['prize']);
		$s['prize']['cardper']['enable'] = empty($s['prize']['cardper']['enable'])?0:1;
		//读取规格名额
		if($s['hasoption']==1){
			//处理常规价格范围
			$s['minprice'] = pdo_fetch("SELECT min(marketprice) as aprice, min(costprice) as costprice FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$s['id']);
			$s['maxprice'] = pdo_fetch("SELECT max(marketprice) as aprice, max(costprice) as costprice FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$s['id']);
			$s['minaprice'] = floatval($s['minprice']['aprice']);
			$s['price'] = floatval($s['maxprice']['aprice']);
			$s['aprice'] = floatval($s['minprice']['aprice']);
			$s['costprice'] = floatval($s['minprice']['costprice']);
			//读取规格总名额，总虚拟人数
			$stock    = pdo_fetchcolumn("SELECT SUM(stock) FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$s['id']);
			$falsenum = pdo_fetchcolumn("SELECT SUM(falsenum) FROM " . tablename('fx_spec_option') . " WHERE activityid = ".$s['id']);
			$nolimit  = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_spec_option') . " WHERE stock = 0 and activityid = ".$s['id']);
			if ($nolimit){
				$s['gnum'] = 0;
			}else{
				$s['gnum'] = $stock;
			}
			$s['falsedata']['num'] = $falsenum ? $falsenum : 0;
		}
		
		$s['aprice'] = floatval($s['aprice']);
		$s['mprice'] = floatval($s['mprice']);		
		$s['joinnum'] = model_records::getJoinNum($s['id']) + $s['falsedata']['num'];		
		$s['rstock'] = $s['gnum']>0 && $s['gnum'] >= $s['joinnum'] ? '剩余' . ($s['gnum'] - $s['joinnum']) : '名额不限';
		
		$s['favorite'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE openid = '".$_W['openid']."' and activityid = ".$s['id']);
		$s['ftimes'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE activityid = ".$s['id']);
		$s['switch'] = unserialize($s['switch']);
		$s['freetitle'] = empty($s['freetitle'])?'免费活动':$s['freetitle'];		
		$s['thumb'] = tomedia($s['thumb']);
		$s['catename'] = pdo_fetchcolumn('SELECT name FROM ' . tablename('fx_category') . " WHERE id = {$s['childid']}");
	}
	$data['list'] = $activityData[0];
	$data['total'] = $activityData[2];
	$data['tpage'] = (empty($psize) || $psize < 0) ? 1 : ceil($activityData[2] / $psize);
	die(json_encode($data));
}

function getlist(){
	global $_W, $_GPC;
	extract(m('common')->globalVar());
	$lat = $_GPC['lat'];
	$lng = $_GPC['lng'];
	$pindex = max(1, intval($_GPC['page']));
	$psize = intval($_GPC['pagesize']) ? intval($_GPC['pagesize']) : 8;
	
	$where = ' WHERE `show` = 1 AND review = 1 AND cycle = 0 AND viewauth = 0 AND recommend=0 AND uniacid = :uniacid ';
	$params = array(':uniacid' => $_W['uniacid']);
	if ($_W['_config']['location']){
		if (!empty($_GPC['ucity']) && $_GPC['ucity']!='全国')
		$where .= " AND (INSTR(`adinfo`, '".$_GPC['ucity']."') or INSTR(`address`, '".$_GPC['ucity']."') or hasonline=1) ";
	}
	$round = "ROUND(6378.138*2*ASIN(SQRT(POW(SIN((".$lat."*3.1416/180-lat*3.1416/180)/2),2)+COS(".$lat."*3.1416/180)*COS(lat*3.1416/180)*POW(SIN((".$lng."*3.1416/180-lng*3.1416/180)/2),2)))*1000)";
	$distance = !$_W['_config']['location'] ? "0 AS distance" : "(CASE 
		WHEN hasstore<>1 and storeids<>'' THEN (SELECT $round as d FROM ".tablename('fx_store')." WHERE FIND_IN_SET(id, a.storeids) ORDER BY d ASC limit 1)
		WHEN hasstore<>1 and storeids='' and (SELECT COUNT(*) FROM ".tablename('fx_store')." WHERE merchantid=a.merchantid)>0 THEN (SELECT $round as dd FROM ".tablename('fx_store')." WHERE merchantid=a.merchantid ORDER BY dd ASC limit 1)
		else $round
		END) AS distance";
	$state = "(CASE 
		WHEN UNIX_TIMESTAMP(joinstime) > UNIX_TIMESTAMP() THEN 1
		WHEN UNIX_TIMESTAMP(joinstime) <= UNIX_TIMESTAMP() AND UNIX_TIMESTAMP(joinetime)>=UNIX_TIMESTAMP() THEN 2
		WHEN UNIX_TIMESTAMP(joinetime) < UNIX_TIMESTAMP() THEN 0
		END) AS st";
	$field = "*, $state, $distance";
	$order = "ORDER BY displayorder DESC,st DESC,".($_W['_config']['distance'] ? "distance ASC," : "")."id DESC";
	$list = pdo_fetchall("SELECT $field FROM " . tablename ('fx_activity') . " as a $where $order LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);
	$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity') . $where , $params);
	foreach ($list as &$s) {
		$s['minprice'] = array();
		$s['maxprice'] = array();
		$s['falsedata'] = unserialize($s['falsedata']);
		$s['falsedata']['num'] = intval($s['falsedata']['num']);
		$s['falsedata']['read'] = intval($s['falsedata']['read']);
		$s['falsedata']['share'] = intval($s['falsedata']['share']);
		$s['atlas'] = unserialize($s['atlas']);
		$s['prize'] = unserialize($s['prize']);
		$s['prize']['cardper']['enable'] = empty($s['prize']['cardper']['enable'])?0:1;
		if (empty($s['thumbsize'])){
			$s['thumbsize'] = igetimagesize(tomedia($s['thumb']));
			pdo_update ('fx_activity', array('thumbsize'=>serialize($s['thumbsize'])), array ('id' => $s['id']));
		}else{
			$s['thumbsize'] = unserialize($s['thumbsize']);
		}
		
		//读取规格名额
		if($s['hasoption']==1){
			//处理常规价格范围
			$s['minprice'] = pdo_fetch("SELECT min(marketprice) as aprice, min(costprice) as costprice FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$s['id']);
			$s['maxprice'] = pdo_fetch("SELECT max(marketprice) as aprice, max(costprice) as costprice FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$s['id']);
			$s['minaprice'] = floatval($s['minprice']['aprice']);
			$s['price'] = floatval($s['maxprice']['aprice']);
			$s['aprice'] = floatval($s['minprice']['aprice']);
			$s['costprice'] = floatval($s['minprice']['costprice']);
			//读取规格总名额，总虚拟人数
			$stock    = pdo_fetchcolumn("SELECT SUM(stock) FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$s['id']);
			$falsenum = pdo_fetchcolumn("SELECT SUM(falsenum) FROM " . tablename('fx_spec_option') . " WHERE activityid = ".$s['id']);
			$nolimit  = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_spec_option') . " WHERE stock = 0 and activityid = ".$s['id']);
			if ($nolimit){
				$s['gnum'] = 0;
			}else{
				$s['gnum'] = $stock;
			}
			$s['falsedata']['num'] = $falsenum ? $falsenum : 0;
		}
		
		if ($_W['_config']['location']) {
			$s['distance'] = $s['distance'] >= 1000 ? sprintf("%.1f", $s['distance']*0.001).'km' : ($s['distance'] >= 100 ? $s['distance']."m" : '<100m');
		}
		
		$s['aprice'] = floatval($s['aprice']);
		$s['mprice'] = floatval($s['mprice']);		
		$s['joinnum'] = model_records::getJoinNum($s['id']) + $s['falsedata']['num'];		
		$s['rstock'] = $s['gnum']>0 && $s['gnum'] >= $s['joinnum'] ? '剩余' . ($s['gnum'] - $s['joinnum']) : '名额不限';
		$s['favorite'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE openid = '".$_W['openid']."' and activityid = ".$s['id']);
		$s['ftimes'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE activityid = ".$s['id']);
		$s['switch'] = unserialize($s['switch']);
		$s['freetitle'] = empty($s['freetitle'])?'免费活动':$s['freetitle'];
		$s['thumb'] = tomedia($s['thumb']);
		foreach ((array)$s['atlas'] as $i=>$img) {
			$s['atlas'][$i] = tomedia($img);
		}
	}
	$data['list'] = $list;
	$data['total'] = $list;
	$data['tpage'] = (empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);
	die(json_encode($data));
}