<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * detail.ctrl
 * 活动详情控制器
 */
defined('IN_IA') or exit('Access Denied');
define("MODULE_NAME", "wnfx_activity");
if ($_W['account']->typeSign == 'account') {
	m('member')->getInfo();
}

function main(){
	global $_W, $_GPC;
	extract(m('common')->globalVar());
	$id = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
	$activity  = model_activity::getSingleActivity($id, '*');
	if (empty($activity)) {
		fx_message('访问失败', app_url('home'), 'warning', '活动可能没有上线，或者不存在');
	}


	//绑定分销关系
	if ($_W['plugin']['poster']['config']['commission_enable']) {
		if ($_GPC['mid'] && $_W['fans']['nickname']!='微信用户'){
			model_api::handler($_W['plugin']['poster']['config']);
		    model_api::commission_member($mid);
			
		}
	}
	
	$pagetitle = '活动详情';	
	$pagetitle = !empty($activity['pagetitle'])?$activity['pagetitle']:$pagetitle;
	$marketing = model_activity::getMarketing($id);//优惠
	$merchant  = model_activity::getActivityMerchant($activity['merchantid']);//读取主办方
	$_W['share']['title'] = $activity['sharetitle'] != '' ? $activity['sharetitle'] : $activity['title'];
	$_W['share']['title'] = str_replace('"','\"',str_replace("'","\'",htmlspecialchars_decode($_W['share']['title'])));
	$_W['share']['desc']  = $activity['sharedesc'] != '' ? $activity['sharedesc'] : $activity['intro'];
	$_W['share']['desc']  = str_replace('"','\"',str_replace("'","\'",htmlspecialchars_decode($_W['share']['desc'])));
	$_W['share']['desc']  = preg_replace("/\s/","",$_W['share']['desc']);
	$_W['share']['pic']   = $activity['sharepic'] != '' ? $activity['sharepic'] : $activity['thumb'];
	
	$activity['falsedata']['nickname'] = explode('，',$activity['falsedata']['nickname']);
	$activity['unitstr'] = empty($activity['unitstr'])?'人':$activity['unitstr'];
	if ($activity['kefu']['switch']){
		$_W['_config']['kefu']['type'] = $activity['kefu']['type'];
		$_W['_config']['kefu']['url']  = $activity['kefu']['url'];
		$merchant['kefuimg'] = tomedia($activity['kefu']['qrcode']);
	}
	
	$condition = " activityid=$id and (`status`<>0 or paytype='delivery') and `status` NOT IN(5,7)";
	$records = pdo_fetchall ("SELECT * FROM " . tablename ('fx_activity_records') . " WHERE $condition ORDER BY id DESC limit 30");
	foreach ($records as $k => &$item) {
		$item['avatar'] = str_replace('http:','https:',$item['headimgurl']);
		if (mb_strlen($item['nickname']) > 4) {
            $item['nickname'] = mb_substr_replace($item['nickname'], '**', 2, -1);
        }
	}
	 $activity['is_daili']=0;	
	//读取规格名额与价格
	if($activity['hasoption']){
		//处理常规价格范围
		$activity['minprice'] = pdo_fetch("SELECT min(marketprice) as aprice,min(distribution) as distributionprice, min(costprice) as costprice FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$id);
		$activity['maxprice'] = pdo_fetch("SELECT max(marketprice) as aprice,max(distribution) as distributionprice, max(costprice) as costprice FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$id);
		$activity['costprice'] = $activity['minprice']['costprice'];
		if ($_GPC['mid']) {
		    $mid=$_GPC['mid'];
		    // code...
		}else{
		   
		    $mid= pdo_fetch("SELECT * FROM " . tablename('fx_agents') . " WHERE member_id = " .$_W['member']['uid']." AND  is_pass =1");
		    $mid=$mid['parent_id'];
		}
		 
		$is_daili= pdo_fetch("SELECT * FROM " . tablename('fx_agents') . " WHERE member_id = " .$mid." AND  is_pass =1");
		$modules = uni_modules();
		$is_poster = $modules['wnfx_activity_plugin_poster'];
		$is_poster =$is_poster['config']["commission_enable"];
// 		var_dump($is_poster==1);
// 		die();
		if ($is_poster==1) {
		    if ($is_daili) {
		    // code...
    		    $activity['is_daili']=1;
    		    $activity['maxprice']['aprice']=$activity['maxprice']['distributionprice'];
    		    $activity['minprice']['aprice']=$activity['minprice']['distributionprice'];
    		}else {
    		    $activity['is_daili']=0;
    		}
		}
		
// 		var_dump($activity['maxprice']['distributionprice']);
// 		var_dump($activity['maxprice']['aprice']);
// 		die();
// 		var_dump($activity['is_daili'],$_GPC['mid']);
// 		var_dump("SELECT * FROM " . tablename('fx_agents') . " WHERE member_id = " .$_GPC['mid']." AND WHERE is_pass =1");
// 		die();
		$specsData = model_activity::getNumActivitySpec($id,'app'); // 规格
		$specs = $specsData[0];
		$options = $specsData[1];
// 		var_dump($options);
// 		die();
	    if ($activity['is_daili']) {
		        foreach ($specs as $key=>$value) {
	               foreach ($value['items'] as $keyc=>$valuec) {
	                   //var_dump($specs[$key]['items'][$keyc]['option']['distribution']);
	                   //die();
	                   $specs[$key]['items'][$keyc]['option']['marketprice']=$valuec['option']['distribution'];
	                   // code...
	               }
		        }
		        foreach ($options as $key=>$value) {
	               $options[$key]['marketprice']=$value['distribution'];
		        }
		    }
		
// 		var_dump($specs);
// 		die();
		$usednum = model_records::getJoinNum($id,  $options[0]['id']);
		$optionid  = count($specs) > 1 ? 0 : $options[0]['id'];
		if ($activity['is_daili']) {
		   $marketprice = $payprice = $options[0]['distribution'];
		} else {
		   $marketprice = $payprice = $options[0]['marketprice'];
		}
		
		
		if ($_W['plugin']['card']['config']['card_enable'] && $activity['iscard']==1 && !$activity['prize']['cardper']['enable']){
			$costprice = $options[0]['costprice'];
			if ($is_vip && $s['iscard']==1) $payprice = $costprice;
		}
		$forgnum  = $options[0]['stock'] > $usednum+$options[0]['falsenum'] ? $options[0]['stock'] - $usednum - $options[0]['falsenum'] : 0;
		$optgnum  = $options[0]['stock'];
		
		$initCheck = false;
		foreach ($options as &$s) {
			$s['usednum'] = model_records::getJoinNum($id, $s['id']);
			if (count($specs)==1 && !$initCheck && $s['stock']-$s['usednum']-$s['falsenum']>0) {
				$initCheck = true;
				$s['check'] = 1;
				$optionid = $s['id'];
				if ($activity['is_daili']) {
				  	$payprice = $is_vip && $s['iscard']==1 ? $s['costprice'] : $s['distribution'];
				} else {
				 	$payprice = $is_vip && $s['iscard']==1 ? $s['costprice'] : $s['marketprice'];
				}
				
			
			}else{
				$s['check'] = 0;
			}
		}
		
		//读取规格总名额，总虚拟人数
		$opt['stock'] = pdo_fetchcolumn("SELECT SUM(stock) FROM " . tablename('fx_spec_option') . " WHERE activityid = $id");
		$opt['nolimit'] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_spec_option') . " WHERE stock = 0 and activityid = $id");
		$opt['falsenum'] = pdo_fetchcolumn("SELECT SUM(falsenum) FROM " . tablename('fx_spec_option') . " WHERE activityid = $id");
		if ($opt['nolimit']){
			$activity['gnum'] = 0;
		}else{
			$activity['gnum'] = $opt['stock'];
		}
		$activity['falsedata']['num'] = $opt['falsenum'] ? $opt['falsenum'] : 0;		
	}
	$joinnum = model_records::getJoinNum($id, 0, $activity['falsedata']['num']);
// 		var_dump($joinnum);
// 	die();
	$uniacid = "uniacid = '{$_W['uniacid']}'";
	//统计报名、收藏、关注数量
	$fansnum = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_merchant_fans') . " WHERE $uniacid and merchantid='{$merchant['id']}' and follow=1");
	$fansnum = $merchant['followno'] ? $merchant['followno']+$fansnum:$fansnum;
	$favonum = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE $uniacid and favo=1 and activityid = $id");
	$favonum = $activity['falsedata']['favorite'] ? $favonum+$activity['falsedata']['favorite']:$favonum;
	$merchant['goods']= pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity') . " WHERE $uniacid and (merchantid='{$merchant['id']}' or atype=3) and review=1");
	//收藏、关注
	$favo = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE $uniacid and activityid=$id and favo=1 and openid='{$_W['openid']}'");
	$fans = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_merchant_fans') . " WHERE $uniacid and follow=1 and merchantid={$merchant['id']} and uid='{$_W['member']['uid']}'");
	if ($_W['plugin']['poster']['config']['commission_api']) {
		$commission_url = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=commission&m='.PLUGIN_POSTER.'&mid='.$mid;
	}else{
		$commission_url = $_W['siteroot']."addons/yun_shop/?menu=#/member/extension?i=".$_W['uniacid'];
	}
	if($activity['prize']['commission_rule']['first_level_rate']) {
		$commission_rule = $activity['prize']['commission_rule'];
	}else{
		$commission_rule = $_W['plugin']['poster']['config']['rule'];
	}
	
	//读取关注参数二维码
	if (($_W['_config']['guanzhu'] == 1 || $_W['_config']['guanzhu_join'] == 2) && empty($_W['fans']['follow'])){
		$data = array(
			'name'=>$activity['title'],
			'id'=>$id,
			'seconds'=>2592000,
			'model'=>1,
			'scene_str'=>'activity',
		);
		$qr = qr::getQrcode($data);
		if (!$qr['error']) {
			qr::setReply(array(
				'id'=>$id,
				'title'=>$activity['title'],
				'description'=>$activity['intro'],
				'thumb'=>$activity['thumb'],
			));
			$_W['_config']['followed_image'] = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$qr['ticket'];
		}		
	}
	
	$joinJs = 'js-join';
	$joinUrl = app_url('order/create', array('id'=>$id));
	$joinbtnName = '立即'.$_W['_config']['buytitle'];
	$joinbtnActive = true;  
	
	$findUser = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE activityid=$id and `status` NOT IN(5,7) and openid='{$_W['openid']}'");

    if ($findUser > 0 && !$activity['switch']['rejoin']){
		$sql = 'select id from ' . tablename('fx_activity_records') . ' where `status` NOT IN(5,7) and activityid=:id and openid=:openid order by id ASC limit 1';
		$orderid = pdo_fetchcolumn($sql,  array(':openid' => $_W['openid'], 'id'=>$id));
		$joinJs = '';
		$joinUrl = app_url('order/detail',array('id'=>$orderid,'type'=>'u'));
        $joinbtnName = '已'.$_W['_config']['buytitle'].'点击查看';
    }else{
		if (TIMESTAMP < strtotime($activity['joinetime']) && TIMESTAMP >= strtotime($activity['joinstime'])){
		   if ($joinnum < $activity['gnum'] || $activity['gnum']==0){
				if ($activity['hasoption']){
					$joinUrl = "javascript:;";
					$joinJs .= ' js-selector';
				}
				if ($_W['plugin']['card']['config']['card_enable']){
					if (!$is_vip && $activity['iscard']==2){
						$joinUrl = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=cardfans&m=' . PLUGIN_CARD;
					}
					$joinbtnName =  $activity['iscard']==2 ? $yearcard['name'].'专享' : $joinbtnName;
				}
			}else{
				$joinJs = '';
				$joinbtnActive = false;
				$joinUrl = "javascript:;";
				$joinbtnName = '已经抢光了';
			}
		}else{
			$joinbtnActive = false;
			$joinbtnName = $_W['_config']['buytitle'];
			$joinbtnName .= TIMESTAMP < strtotime($activity['joinstime']) ? '还未开始' : '结束';
			$joinUrl = "javascript:;";
		}
	}
	 
    if (($_W['_config']['guanzhu_join']==2 && !$_W['fans']['follow']) || $_W['container']!='wechat'){
        $joinUrl="javascript:;";
        $joinJs='js-join js-follow';
    }
	
	if ($_W['openid']=='o7CHdvlvTW37Kg51Hmycd0y9EmUk'){
		include fx_template('activity/detail_1');
	}else{
		include fx_template('activity/detail');
	}
}

function share(){
	global $_W, $_GPC;
	extract(m('common')->globalVar());
	$id = intval($_GPC['id']);
	$activity = model_activity::getSingleActivity($id, '*');
	pdo_query("UPDATE ".tablename('fx_activity')." SET trueshare=trueshare+1 WHERE id = :id", array(':id' => $id));
	if (TIMESTAMP > strtotime($activity['joinetime']) || TIMESTAMP > strtotime($activity['endtime'])){//报名结束或者活动结束，不奖励积分;
		die(json_encode(array("result" => 3, "data" => '')));
	}elseif ($_W['_config']['creditstatus'] && $activity['prize']['share_times']>0){
		$credit = intval($activity['prize']['share_credit']);//赠送积分额度
		$share_times = intval($activity['prize']['share_times']);//每天分享获取奖励次数
		$credit_type = $_W['_config']['credit_type']?$_W['_config']['credit_type']:1;
		$credit_data = array(
			':uniacid'=>$_W['uniacid'],
			':uid'=>$_W['member']['uid'],
			':module'=>IN_MODULE,
			':store_id'=>$activity['merchantid'],
			':clerk_type'=>4
		);
		$log['nums'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('mc_credits_record') . ' WHERE to_days(FROM_UNIXTIME(createtime))=to_days(now()) AND uniacid=:uniacid AND uid=:uid AND module=:module AND store_id=:store_id AND clerk_type=:clerk_type', $credit_data);
		if ($share_times > $log['nums']) {
			if ($_W['plugin']['card']['config']['card_enable'] && $is_vip) {//年卡
				if ($_W['plugin']['card']['config']['credit_double']) {
					$credit = $credit * 2;
					$cardRemark = '，'.$yearcard['name'].'翻倍';
				}
			}
			$result = m('member')->credit_update_credit1($_W['member']['uid'], $credit, "分享获取：" . $credit . m('member')->getCreditName('credit1'), $activity['merchantid'], 4);
			$result ? die(json_encode(array("result" => 1, "data" => '恭喜您获取 ' . $credit . m('member')->getCreditName('credit1') . $cardRemark))) : die(json_encode(array("result" => 0, "data" => '失败')));
		}else{
			die(json_encode(array("result" => 2, "data" => '您当天分享' . m('member')->getCreditName('credit1') . '已送完，请明日再领取')));
		}
	}else{
		die(json_encode(array("result" => 3, "data" => '')));
	}
}

function favorite(){
	global $_W, $_GPC;
	$id = intval($_GPC['id']);
	$favo = intval($_GPC['favorite']);
	if (!$_W['member']['uid']){
		$arr = array();
		if ($id) $arr['activityid'] = $id;
		$_SESSION['oauth_url'] = app_url('activity' . $_GPC['type'] . '', $arr);
		die(json_encode(array("result" => 2, "data" => '')));
	}
	$condition = "uniacid = '{$_W['uniacid']}' and activityid = $id and (openid = '{$_W['openid']}' or uid='{$_W['member']['uid']}')";
	$favorite = pdo_fetch("SELECT * FROM " . tablename ('fx_activity_favorite') . " WHERE $condition");
	if(!empty($favorite)){
		$where = array('activityid' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $_W['openid']);
		$result = pdo_update('fx_activity_favorite', array('favo' => $favo, 'uid'=>$_W['member']['uid']), $where);
		if ($result){
			die(json_encode(array("result" => $result, "data" => $favo ? 0 : 1)));
		}else{
			die(json_encode(array("result" => $result, "data" => $favo)));
		}
	}else{
		if (!empty($_W['openid'])){
			$result = pdo_insert('fx_activity_favorite', array (
				'activityid' => $id,
				'uniacid'    => $_W['uniacid'],
				'uid'        => $_W['member']['uid'],
				'openid'     => $_W['openid'],
				'favo'       => 1
			));
		}
		if ($result){
			die(json_encode(array("result" => $result, "data" => 0)));
		}else{
			die(json_encode(array("result" => $result, "data" => 1)));
		}
	}
}

function read(){
	global $_W, $_GPC;
	$id = intval($_GPC['id']);
	pdo_query("UPDATE ".tablename('fx_activity')." SET trueread=trueread+1 WHERE id = :id", array(':id' => $id));
	$item = model_activity::getSingleActivity($id, 'trueread');	
	die(json_encode($item));
}

function getstore(){
	global $_W, $_GPC;
	$id = intval($_GPC['id']);
	$lat = $_GPC['lat'];
	$lng = $_GPC['lng'];
	$activity  = model_activity::getSingleActivity($id, '*');
	if (!$activity['hasstore']){//判断活动门店
		$pindex = max(1, intval($_GPC['page']));
		$psize = 10;
		$order = $_W['_config']['location'] ? "distance ASC":'id DESC';
		$where = array();
		$where['merchantid'] = $activity['merchantid'];
		if (!empty($activity['storeids'])) $where['#id#'] = '('.implode(',',$activity['storeids']).')';
		$field = "*,0 AS distance";
		$field = $_W['_config']['location']?"*, ROUND(6378.138*2*ASIN(SQRT(POW(SIN((".$lat."*3.1416/180-lat*3.1416/180)/2),2)+COS(".$lat."*3.1416/180)*COS(lat*3.1416/180)*POW(SIN((".$lng."*3.1416/180-lng*3.1416/180)/2),2)))*1000) AS distance":$field;
		$storesData = Util::getNumData($field, 'fx_store', $where, $order, $pindex, $psize, 1);
		if (empty($storesData[0])){
			$merchant  = model_activity::getActivityMerchant($activity['merchantid']);//读取主办方
			$distance = getDistance_map($lat, $lng, $merchant['lat'], $merchant['lng']);
			$distance = $distance >= 1000 ? sprintf("%.1f", $distance*0.001).'km' : ($distance >= 100 ? $distance."m" : '<100m');
			$stores[0]['lng']       = $merchant['lng'];
			$stores[0]['lat']       = $merchant['lat'];
			$stores[0]['tel']       = $merchant['tel'];
			$stores[0]['address']   = $merchant['address'];
			$stores[0]['storename'] = $merchant['storename'];
			$stores[0]['distance']  = $_W['_config']['location']?$distance:0;
			$storesData[0] = $stores;
			$storesData[2] = 1;
		}else{
			foreach ($storesData[0] as &$s) {
				$s['distance'] = $s['distance'] >= 1000 ? sprintf("%.1f", $s['distance']*0.001).'km' : ($s['distance'] >= 100 ? $s['distance']."m" : '<100m');
			}
		}
		$data['list'] = $storesData[0];
		$data['total'] = $storesData[2];
		$data['tpage'] = (empty($psize) || $psize < 0) ? 1 : ceil($storesData[2] / $psize);
		die(json_encode($data));
	}else{
		$distance = getDistance_map($lat, $lng, $activity['lat'], $activity['lng']);
		$distance = $distance >= 1000 ? sprintf("%.1f", $distance*0.001).'km' : ($distance >= 100 ? $distance."m" : '<100m');
		$stores[0]['lng']       = $activity['lng'];
		$stores[0]['lat']       = $activity['lat'];
		$stores[0]['tel']       = $activity['tel'];
		$stores[0]['address']   = $activity['address'];
		$stores[0]['storename'] = $activity['addname'];
		$stores[0]['distance']  = $_W['_config']['location']?$distance:0;
		$data['list'] = $stores;
		$data['total'] = 1;
		$data['tpage'] = 1;
	}
	die(json_encode($data));
}