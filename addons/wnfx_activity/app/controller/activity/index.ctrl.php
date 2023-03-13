<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * index.ctrl
 * 首页控制器
 */
defined('IN_IA') or exit('Access Denied');
$pagetitle = !empty($_W['_config']['sname']) ? $_W['_config']['sname'] : '活动首页';

if($_W['op'] =='display'){
	$keyword = $_GPC['keyword'];
	/*顶部菜单栏*/
	$pid  = intval($_GPC['pid']) ? intval($_GPC['pid']) : 0;
	$cid  = intval($_GPC['cid']) ? intval($_GPC['cid']) : 0;
	$item = 0;
	$cates = pdo_fetchall("SELECT * FROM " . tablename('fx_category') . " WHERE enabled = 1 and uniacid = '{$_W['uniacid']}' and redirect='' ORDER BY displayorder DESC");
	$children = array();
	if (!empty($cates)) {
		foreach ($cates as $index => $row) {
			if (!empty($row['parentid'])){
				$children[$row['parentid']][] = $row;
				if ($cid == $row['id']) {
					$item = count($children[$pid]);
				}
				unset($cates[$index]);
			}
			if ($pid == $row['id']) $catename = $row['name'];
		}
	}
	
	if ($_W['_config']['sys']['waterfall']){
		include fx_template('activity/activity_list');
	}else{
		include fx_template('activity/activity_list_1');
	}
	exit;
}
//$_W['isajax'] && 
if($_W['op'] =='ajax'){
	$pindex = max(1, intval($_GPC['page']));
	$psize = 8;
	$lat = $_GPC['lat'];
	$lng = $_GPC['lng'];
	$status = intval($_GPC['status']);
	$price_type = intval($_GPC['pricetype']);
	$order_type = intval($_GPC['ordertype']);
	
	$where = ' WHERE `show` = 1 AND review = 1 AND viewauth = 0 AND cycle=0 AND uniacid = :uniacid';
	$params = array(':uniacid' => $_W['uniacid']);
	
	if (!empty($_GPC['parentid'])) $where .= " AND parentid = ".intval($_GPC['parentid']);
	if (!empty($_GPC['childid'])) $where .= " AND childid = ".intval($_GPC['childid']);
	if (!empty($_GPC['keyword'])){
		$merchantsData = Util::getNumData('id', 'fx_merchant', array('@name@'=>$_GPC['keyword']), 'id desc', 0,0,0);
		$merchantid = array();
		foreach ($merchantsData[0] as $v) {
			$merchantid[] = $v['id'];
		}
		if (strpos($_W['_config']['sname'], $_GPC['keyword']) !== false) $merchantid[] = 0;
		$where .= empty($merchantid) ? " AND INSTR(`title`, '".$_GPC['keyword']."') ":" AND (INSTR(`title`, '".$_GPC['keyword']."') OR merchantid IN (".implode(',',$merchantid).")) ";
	}
	if ($price_type){
		switch($price_type){
			case 1:$where .= " AND aprice=0";break;
			case 2:$where .= " AND aprice>0";break;
			default:;
		}
	}
	
	if ($status){
		switch($status){
			case 1 :$where .= ' AND UNIX_TIMESTAMP()>=UNIX_TIMESTAMP(joinstime) AND UNIX_TIMESTAMP()<=UNIX_TIMESTAMP(joinetime) ';break;
			case 2 :$where .= ' AND UNIX_TIMESTAMP()<UNIX_TIMESTAMP(joinstime) ';break;
			case 3 :$where .= ' AND UNIX_TIMESTAMP()>UNIX_TIMESTAMP(joinetime) ';break;
			default:;
		}
	}
	
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
	$order = "displayorder DESC,st DESC,".($_W['_config']['distance']?"distance ASC,":"")."id DESC";
	if ($order_type){
		switch($order_type){
			case 1:$order = "id DESC";break;
			case 2:$order = "trueread DESC";break;
			case 3:$order = "distance ASC";break;
			default:;
		}
	}
	$list = pdo_fetchall("SELECT $field FROM " . tablename ('fx_activity') . " as a $where ORDER BY $order LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);
	$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity') . $where , $params);
	//$activityData = Util::getNumData($field, 'fx_activity', $where, $order, $pindex, $psize, 1);
	
	foreach ($list as &$s) {
		$s['minprice'] = array();
		$s['maxprice'] = array();
		$s['minaprice'] = '0.00';
		$s['falsedata'] = unserialize($s['falsedata']);
		$s['falsedata']['num'] = intval($s['falsedata']['num']);
		$s['falsedata']['read'] = intval($s['falsedata']['read']);
		$s['falsedata']['share'] = intval($s['falsedata']['share']);
		$s['atlas'] = unserialize($s['atlas']);
		$s['prize'] = unserialize($s['prize']);
		$s['prize']['cardper']['enable'] = empty($s['prize']['cardper']['enable'])?0:1;
		$s['price'] = floatval($s['aprice']);
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
		
		$s['aprice'] = floatval($s['aprice']);
		$s['mprice'] = floatval($s['mprice']);		
		$s['joinnum'] = model_records::getJoinNum($s['id']) + $s['falsedata']['num'];		
		$s['rstock'] = $s['gnum']>0 && $s['gnum'] >= $s['joinnum'] ? '剩余' . ($s['gnum'] - $s['joinnum']) : '名额不限';
		
		//读取商户信息
		$s['merchant'] = model_activity::getActivityMerchant($s['merchantid']);//读取主办方
		if ($s['hasstore']){//判断位置是否活动中定义
			$s['merchant']['storename'] = $s['addname'];
			$s['merchant']['address'] = $s['address'];
			$s['merchant']['lng'] = $s['lng'];
			$s['merchant']['lat'] = $s['lat'];
		}elseif (is_array(unserialize($s['storeids']))){//判断活动门店
			$stores = model_activity::getNumActivityStore(explode(',', $s['storeids']));
			$s['merchant']['storename'] = $stores[0]['storename'];
		}
		$s['favorite'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE uniacid = '{$_W['uniacid']}' and activityid = {$s['id']} and openid = '".$_W['openid']."' and favo=1");
		$s['ftimes']   = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE uniacid = '{$_W['uniacid']}' and activityid = {$s['id']} and favo=1");
		$s['ftimes']   = $s['falsedata']['favorite']?$s['falsedata']['favorite']+$s['ftimes']:$s['ftimes'];
		$s['distance'] = $s['distance'] >= 1000 ? sprintf("%.1f", $s['distance']*0.001).'km' : ($s['distance'] >= 100 ? $s['distance']."m" : '<100m');
		$s['switch']   = unserialize($s['switch']);
		$s['freetitle'] = empty($s['freetitle'])?'免费活动':$s['freetitle'];
		$s['thumb'] = tomedia($s['thumb']);
		foreach ((array)$s['atlas'] as $i=>$img) {
			$s['atlas'][$i] = tomedia($img);
		}
	}
	//array_merge数组拼接
	$data['list'] = $list;
	$data['total'] = $total;
	$data['tpage'] = (empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);
	$data['bigimg']=$_W['_config']['bigimg'];
	
	die(json_encode($data));
	exit;
}