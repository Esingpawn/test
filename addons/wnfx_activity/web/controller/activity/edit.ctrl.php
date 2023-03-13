<?php
defined('IN_IA') or exit('Access Denied');
$uniacid = "uniacid = '{$_W['uniacid']}'";
$id = intval($_GPC['id'])?intval($_GPC['id']):0;
$tab = empty($_GPC['tab'])?'basic':str_replace('#tab_', '', $_GPC['tab']);
$item = model_activity::getSingleActivity($id, '*');
$totals = model_activity::getTotals();

if ($_W['ispost']) {
    // var_dump($_GPC);
    // die();
// return json_encode();
	$discount = $_GPC['marketing']; //折扣
	$data = $_GPC['activity'];
	$data['merchantid'] = empty($_GPC['merchid'])?0:$_GPC['merchid'];//主办方ID
	$data['storeids']  = empty($_GPC['storeid'])?'':implode(',', $_GPC['storeid']);//核销门店ID
	$data['seatid']    = $_GPC['seatid'];//座位ID
	$data['gnumshow']  = empty($data['gnumshow'])?0:$data['gnumshow'];//开启库存
	$data['hasoption'] = empty($data['hasoption'])?0:$data['hasoption'];//开启规格
	$data['hasstore']  = empty($data['hasstore'])?0:$data['hasstore'];//自定义地址
	$data['hasonline'] = empty($data['hasonline'])?0:$data['hasonline'];//线上活动
	$data['recommend'] = empty($data['recommend'])?0:1;
	$data['info']      = htmlspecialchars_decode($data['info']);
	$data['detail']    = htmlspecialchars_decode($data['detail']);
	$data['openids']   = empty($_GPC['openids']) ? '' : serialize($_GPC['openids']);
	$data['form']      = empty($data['form']) ? '' : serialize($data['form']);	
	$data['tmplmsg']   = empty($data['tmplmsg']) ? '' : serialize($data['tmplmsg']);
	$data['kefu']      = empty($data['kefu']) ? '' : serialize($data['kefu']);
	$data['switch']    = empty($data['switch']) ? '' : serialize($data['switch']);
	$data['smsnotify'] = empty($data['smsnotify']) ? '' : serialize($data['smsnotify']);
	$data['signin']    = empty($data['signin']) ? '' : serialize($data['signin']);
	//$data['info']      = html_format($data['info'], array('img'));
	$data['thumbsize'] = serialize(igetimagesize(tomedia($data['thumb'])));
	
	$cates = empty($_GPC['cates'])?0:explode(',', $_GPC['cates']);
	$data['parentid'] = $cates[0];
	$data['childid'] = $cates[1];
	
	//虚拟信息
	$data['falsedata']['name'] = str_replace(',','，',$data['falsedata']['name']);
	$data['falsedata']['head'] = $_GPC['head'];
	$data['falsedata'] = serialize($data['falsedata']);
	
	//协议字数处理
	$data['agreement'] = html_format($data['agreement']);
	$bytes = strlen(html_format($data['agreement']))-65000;
	if ($bytes > 0){
		web_json('协议内容已超出存储范围：约超' . round($bytes/3) . "个汉字", 0);
	}
	
	//用来判断是否收费活动
	$aprice = $data['aprice'];
	if (!empty($data['hasoption'])){
		$option_idss = $_GPC['option_ids'];
		for ($k = 0; $k < count($option_idss); $k++) {
			$ids = $option_idss[$k];
			if ($_GPC['option_aprice_' . $ids][0] > 0){
				$aprice =  $_GPC['option_aprice_' . $ids][0];
				break;
			}
		}
	}
	
	//其它设置项
	$prize = $_GPC['prize'];
	if ($_W['plugin']['card']['config']['card_enable']){
		if ($prize['cardper']['enable']){
			$prize['cardper']['percent'] = !empty($prize['cardper']['percent'])>0 ? $prize['cardper']['percent'] : (empty($_W['plugin']['card']['config']['percent']) ? '8.8' : $_W['plugin']['card']['config']['percent']);
		}else{
			$prize['cardper']['percent']='';
		}
	}
	$otherdata = array (
		'uniacid' 	 => $_W['uniacid'],
		'starttime'  => empty($_GPC['starttime'])?$_GPC['activityTime']['start']:$_GPC['starttime'],
		'endtime' 	 => empty($_GPC['endtime'])?$_GPC['activityTime']['end']:$_GPC['endtime'],
		'joinstime'  => $_GPC['joinTime']['start'],
		'joinetime'  => $_GPC['joinTime']['end'],
		'atlas' 	 => serialize($_GPC['atlas']),
		'prize' 	 => serialize($prize),
		'review'     => (!MERCHANTID || perm('goods.senior.ischeck')) ? 1 : 0,
		'video'      => $_GPC['video']
	);
	//读取门店地址
	if (!$data['hasstore']){
		if (!empty($_GPC['storeid'])){//判断活动门店
			$stores = model_activity::getNumActivityStore($_GPC['storeid']);
			$data['tel']     = $stores[0]['tel'];
			$data['lng']     = $stores[0]['lng'];
			$data['lat']     = $stores[0]['lat'];
			$data['adinfo']  = $stores[0]['adinfo'];
			$data['address'] = $stores[0]['address'];
			$data['addname'] = $stores[0]['storename'];
		}else{//无设置默认商家
			$merch  = model_activity::getActivityMerchant($data['merchantid']);//读取主办方
			$data['tel']     = $merch['tel'];
			$data['lng']     = $merch['lng'];
			$data['lat']     = $merch['lat'];
			$data['adinfo']  = $merch['adinfo'];
			$data['address'] = $merch['address'];
			$data['addname'] = $merch['storename'];
		}
	}
	$data = array_merge($data,$otherdata);
	if (!empty($id)) {
		pdo_update ('fx_activity', $data, array ('id' => $id));
		if ($data['merchantid']!=$item['merchantid']){
			pdo_update ('fx_activity_records', array('merchantid'=>$data['merchantid']), array ('activityid' => $id));
		}
	} else {
		pdo_insert ('fx_activity', $data);
		$id = pdo_insertid();
	}
	model_activity::UpdateForm($id,$_GPC);//更新表单
	model_activity::UpdateSpec($id,$_GPC);//更新规格
	$discount = $_GPC['discount']; //折扣
	$enough = $_GPC['enough']; //满减
	$deduction = $_GPC['deduction'];//抵扣
	$mcgroup = $_GPC['mcgroup']; //会员优惠
	model_activity::updateMarketing($discount,$enough,$deduction,$mcgroup,$id);//更新优惠
	
	web_json(web_url('activity/edit', array('id'=>$id, 'tab'=>$tab)));
}

$mcgroups = mc_groups();
$category = model_category::getNumCategory();
$creditName = m('member')->getCreditName('credit1');
if (empty($item)) {
	$item['joinstime']=$item['joinetime']=$item['starttime']=$item['endtime']=date('Y-m-d H:i');
	$sysform = array();
	$sysform['realname'] = array('title'=>'','show'=>1,'need'=>1);
	$sysform['mobile'] = array('title'=>'','show'=>1,'need'=>1);
}else{
	$sysform  = $item['form'];
	$forms = model_activity::getNumActivityForm($id);//活动表单
	$specs = model_activity::getNumActivitySpec($id);//活动规格
	$option = $specs[2];
	$marketing = model_activity::getMarketing($id);//优惠
	$store     = model_activity::getNumActivityStore($item['storeids']);//店铺
	$hasorder = m('order')->getGoodsOrder($id);	
	$members = array();
	foreach ((array)$item['openids'] as $openid) {
		$members[] = m('member')->getMember($openid);
	}
}
//读取主办方
$merchid = !MERCHANTID ? $item['merchantid']  : MERCHANTID;
$merch = model_merchant::getSingleMerchant($merchid, 'id,name');
if (checkplugin('seat')){
	$seat = pdo_get('fx_seat', array('uniacid' => intval($_W['uniacid']), 'id' => $item['seatid']));
}
include fx_template();