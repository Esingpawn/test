<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * join.ctrl
 * 报名入口控制器
 */
defined('IN_IA') or exit('Access Denied');
if ($_W['account']->typeSign == 'account') {
	m('member')->getInfo();
}
$_W['member'] = m('member')->getMember($_W['openid']);
$id = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
$activity   = model_activity::getSingleActivity($id, '*');
$optionid   = intval($_GPC['optionid'])?intval($_GPC['optionid']):0;
$buynum     = intval($_GPC['buynum']) ? intval($_GPC['buynum']) : 1;
$formnum    = $activity['switch']['form'] ? $buynum : 1;
$sysform    = $activity['form'];
$gnum       = $activity['gnum'];//验证名额，每次进入加载剩余名额数量、及规格
$ismore     = intval($activity['switch']['form']);//单次购买产生多订单时，采取订单均摊模式
$status     = isset($_W['_config']['stock_lock']) && $_W['_config']['stock_lock'] == 2 ? '5,7' : '0,5,7';//并发支付时，未支付订单在有效期内设置为占用库存
$is_daili=0;
$parent_id= pdo_fetch("SELECT * FROM " . tablename('fx_agents') . " WHERE member_id = " .$_W['member']['uid']);
$modules = uni_modules();
$is_poster = $modules['wnfx_activity_plugin_poster'];
$is_poster =$is_poster['config']["commission_enable"];
// var_dump($is_poster);
// var_dump($parent_id);
// die();
if ($is_poster==1) {
    if ($parent_id['parent_id']>0) {
		    $daili= pdo_fetch("SELECT * FROM " . tablename('fx_agents') . " WHERE member_id = " .$parent_id['parent_id']." AND  is_pass =1");
		    if ($daili) {
		    // code...
		    $is_daili=1;
    		}else {
    		$is_daili=0;
    		}
		}
}
		
		
if ($activity['hasoption']){//规格选项
	$option = model_activity::getSingleActivityOption($optionid);
	if ($is_daili==1) {
	    $activity['aprice'] = $option['distribution'];
	    // code...
	} else {
	    // code...
	    $activity['aprice'] = $option['marketprice'];
	}
	
	
	$activity['costprice'] = $option['costprice'];
	$activity['falsedata']['num'] = $option['falsenum'] ? $option['falsenum'] : 0;
	$gnum = $option['stock'];
}

$price = $aprice = $amount = $activity['aprice'];
$pay_price = 0;
$orderMarket = array();
$joinnum = model_records::getJoinNum($id, $optionid, $activity['falsedata']['num']);

if ($_W['plugin']['card']['config']['card_enable'] && $is_vip) {//年卡
	if ($activity['iscard']==1){
		if (!$activity['prize']['cardper']['enable']){//年卡价格
			$price = $activity['costprice'];
			$yc['money'] = sprintf("%.2f", $activity['aprice'] - $activity['costprice']);
		}else {//年卡打折
			$yc['percent'] = $activity['prize']['cardper']['percent'];
		}
	}
	$orderMarket['credit_double'] = $_W['plugin']['card']['config']['credit_double']?1:0;
}

if ($price > 0){
	$dc = $_GPC['dc'] == 'yes' ? TRUE : FALSE; //是否积分抵扣
	$pay_price = sprintf("%.2f", $price);
}

if (!$ismore) {
	$pay_price = $price > 0 ? sprintf("%.2f", $price * $buynum) : 0;
	$amount = $aprice > 0 ? sprintf("%.2f", $aprice * $buynum) : 0;
	$yc['money'] = $yc['money'] > 0 ? $yc['money'] * $buynum : 0;
}

$afterMarketing = model_records::getafterMarketing($pay_price, $buynum, $id, $dc, $yc, $ismore, $ismore?1:0);//获取订单营销后的价格统计参数据

//获取价格参数
if($_W['isajax'] && $_W['op'] == 'getprice') {
	$pay_price = $afterMarketing['pay_price'];  //营销后的价格
	$afterMarketing['price'] = $price;
	$afterMarketing['joinnum'] = $joinnum;
	$afterMarketing['token'] = $_W['token'];
	die(json_encode(array('errno'=>0, 'params'=>$afterMarketing)));
}

if($_W['op'] == 'display'){

	$pagetitle  = '信息填写';
	if ($_W['container']!='wechat'){
		fx_message('请用微信打开此连接报名', '', 'error');
	}
	if ($activity['show']==0 || $activity['review']!=1){
		fx_message('当前活动没有开放报名', '', 'error');
	}
	if ($_W['_config']['guanzhu_join']==2 && empty($_W['fans']['follow'])){
		fx_message('您还未关注,不能报名', app_url('activity/detail', array ('id' => $id)), 'warning');
	}	
	if ($activity['iscard']==2 && !$is_vip){
		fx_message('你还没有购买'.$yearcard['name'], $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=cardfans&m=' . PLUGIN_CARD, 'warning','不可报名');
	}
	if ($_W['member']['isblack']){
		fx_message('对不起您被主办方屏蔽了', app_url('activity/detail', array ('id' => $id)), 'error','请联系主办方解封');
	}
	if ($activity['costcredit'] && $activity['costcredit'] > $_W['member']['credit1']){
		fx_message('对不起您的' . m('member')->getCreditName('credit1') . '不足', '', 'error', '参与当前活动需要 '.$activity['costcredit'].' ' . m('member')->getCreditName('credit1') . '，分享当前活动可以赚取积分哦！');
	}
	if ($_W['_config']['onlyonce']) {
		$isonly = pdo_getcolumn("fx_activity_records", array('uniacid'=>$_W['uniacid'],'uid'=>$_W['member']['uid'],'status'=>array(1,2)), 'COUNT(*)');;
		if ($isonly) fx_message('抱歉，您有其它活动待参与，不可以重复参加多个活动！', '', 'error', '');
	}	
	if(!$optionid && $activity['hasoption']){
		fx_message('请选择活动类型', app_url('activity/detail', array ('id' => $id)), 'warning');
	}
	if($joinnum >= $gnum && $gnum>0) {
		fx_message('很遗憾！名额已经满了', app_url('activity/detail', array ('id' => $id)), 'warning');
	}
	
	$pay_price = $afterMarketing['pay_price'];  //营销后的价格
	$marketing = model_activity::getMarketing($id);//优惠
	$forms     = model_activity::getNumActivityForm($id,'app');//读取表单
	$profile   = $_W['member'];
	$profile['email'] = substr($profile['email'], -6) == 'we7.cc' ? '' : $profile['email'];
	
	//读取选座插件
	if (checkplugin('seat') && $activity['switch']['seat']) {
		$seat = pdo_get('fx_seat', array('uniacid' => $_W['uniacid'], 'id' => $activity['seatid']));
		$init_seat = array('ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 		'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc');
		if (!empty($seat)) {
			$noavailable = explode(',', $seat['noavailable']);
			$init_seat = array();
			for($si = 0; $si < $seat['rows']; $si++){
				$c = '';
				for($sii = 0; $sii < $seat['columns']; $sii++){
					if (in_array(($si+1).'_'.($sii+1), $noavailable))
						$c = $c . '_';
					else
						$c = $c . 'c';
				}
				$init_seat[$si] = $c;
			}
		}
		
		$rs = pdo_fetchall("SELECT seats FROM " . tablename ('fx_activity_records') . " WHERE activityid = $id and (status not in($status) or paytype='delivery') and seats<>''");
		foreach ($rs as $sk => $r) {
			$seat['unavailable'] .= ','.str_replace("座", "",  str_replace("排", "_", $r['seats']));
		}
	}
	include fx_template();
	exit;
}

if($_W['ispost'] && $_W['op'] == 'post') {
	$fp = fopen(IA_ROOT . '/addons/' . IN_MODULE . '/data/files/order.lock', "r");
	if(flock($fp, LOCK_EX)){
		$condition = " activityid=$id and `status` NOT IN(5,7) and openid='{$_W['openid']}'";
		$findUser = pdo_fetch("SELECT id FROM " . tablename ('fx_activity_records') . " WHERE $condition");
		if(!empty($findUser) && !$activity['switch']['rejoin']){
			show_json('不可重复报名！', 0);
		}else{		
			if ($gnum>0){
				$joinnum = model_records::getJoinNum($id, $optionid , $activity['falsedata']['num']);
				if($joinnum >= $gnum) {				
					show_json('很遗憾！名额已经满了', 0);
				}elseif($joinnum + $buynum > $gnum){
					show_json("当前活动仅剩 " . ($gnum - $joinnum) . ' 个名额，点击确定重新填写', 0);
				}
			}
			if (checkplugin('seat') && $activity['switch']['seat']) {
				$seats = $_GPC['seats'];
				if (!empty($seats)){
					$seats = explode(',', $seats);
					$hasSeat = '';
					$unavailable = array();
					foreach ($seats as $seat) {
						 $rs = pdo_fetch("SELECT id FROM " . tablename ('fx_activity_records') . " WHERE activityid = $id and (status not in($status) or paytype='delivery') and FIND_IN_SET('".$seat."', seats)");
						 if (!empty($rs)) {
							 $unavailable[] = str_replace("座", "",  str_replace("排", "_", $seat));
							 $hasSeat .= $seat . '，';
						 }
					}
					if (!empty($hasSeat))
						exit(json_encode(array("status" => 0, "result" => array('type'=>'seat','seats'=>$unavailable,'message'=> $hasSeat.'已被占用！'))));
				}
			}
			$afterMarketing = model_records::getafterMarketing($pay_price, $buynum, $id, $dc, $yc, $ismore);
			$pay_price = $afterMarketing['pay_price'];  //营销后的价格
			if($dc == 'yes'){
				$deduct[0] = $afterMarketing['orderMarket']['deduct'][0];
				$deduct[1] = $afterMarketing['orderMarket']['deduct'][1];
				$orderMarket['deduct'] = $deduct;
			}	
			$orderMarket['market_price'] =  $amount > 0 ? sprintf("%.2f", $amount - $pay_price) : 0.00;
			
			$orderno = createUniontid();
			for ($i = 0; $i < $formnum; $i++) {
				setcookie("sms_code_".$i, '');
				$postMember = $_GPC['member_'.$i];
				$postMember['birthyear'] = $_GPC['birth_'.$i]['year'];
				$postMember['birthmonth'] = $_GPC['birth_'.$i]['month'];
				$postMember['birthday'] = $_GPC['birth_'.$i]['day'];
				$postMember['resideprovince'] = $_GPC['reside_'.$i]['province'];
				$postMember['residecity'] = $_GPC['reside_'.$i]['city'];
				$postMember['residedist'] = $_GPC['reside_'.$i]['district'];
				$postMember['gender'] = $_GPC['gender_'.$i];
				$postMember['education'] = $_GPC['education_'.$i];
				$postMember['constellation'] = $_GPC['constellation_'.$i];
				$postMember['zodiac'] = $_GPC['zodiac_'.$i];
				$postMember['bloodtype'] = $_GPC['bloodtype_'.$i];
				
				$data = array (
					'uid' => $_W['member']['uid'],
					'activityid' => $id,
					'uniacid' => $_W['uniacid'],
					'openid' => $_W['openid'],
					'buynum' => $activity['switch']['form'] ? 1 : $buynum,
					'aprice' => $aprice,
					'price' => $pay_price,
					'vipdeduct' => $afterMarketing['cardReduce'],
					'nickname' => $_W['member']['nickname'],
					'headimgurl' => $_W['member']['avatar'],
					'orderno' => $orderno,
					'realname' => $postMember['realname'],
					'mobile' => $postMember['mobile'],
					'gender' => $postMember['gender']==0 ? '保密' : ($postMember['gender']==1?'男':'女'),
					'pic' => $_GPC['pic'],
					'msg' => htmlspecialchars_decode($_GPC['msg']),
					'optionid' => $optionid,
					'optionname' => $option['title'],
					'review' => $activity['switch']['joinreview']?0:1,
					'status' => 2,
					'merchantid' => $activity['merchantid']?$activity['merchantid']:0,
					'marketing' => serialize($orderMarket),
					'seats' => $formnum > 1 ? $seats[$i] : $_GPC['seats']
				);
				if ($pay_price > 0){//获取付费金额
					$data['status'] = 0;
				}		
				
				pdo_insert('fx_activity_records', $data);
				$insertid = pdo_insertid();
				
				//保存自定义表单信息
				$form_ids = $_GPC['form_id_'.$i];
				$len = count($form_ids);
				$form_items = array();
				for ($k = 0; $k < $len; $k++) {
					$form_items[$k] = is_array($_GPC["form_item_val_".$k."_".$i]) ? implode(',', $_GPC["form_item_val_".$k."_".$i]) : $_GPC["form_item_val_".$k."_".$i];
					$form_id = $form_ids[$k];
					$a = array(
						"activityid" => $id,
						"recordid" => $insertid,
						"formid" => $form_id,
						"data" => $form_items[$k]
					);
					//表单数据
					pdo_insert("fx_form_data", $a);
				}
				
				if ($i==0) {
					$orderid = $insertid;
					//同步会员信息
					$memberData = array();
					foreach($postMember as $key=> $item){
						if (empty($_W['member'][$key])) $memberData[$key] = $item;
					}		
					if (count($memberData)>0){
						mc_update($_W['member']['uid'], $memberData);
					}
				}
				
				//插入常用表单数据	
				$postMember['rid'] = $insertid;
				$postMember['uniacid'] = $_W['uniacid'];
				pdo_insert('fx_form_data_common', $postMember);			
				
				if ($pay_price > 0){				
					//分销处理
					if ($_W['plugin']['poster']['config']['commission_enable'] && $activity['prize']['commission']){
						$order_data = $data;
						$order_data['gnum'] = $gnum;
						$order_data['order_id'] = $insertid;
						$order_data['merchant_id'] = $activity['merchantid']?$activity['merchantid']:0;
						$order_data['is_commission'] = $activity['prize']['commission'];
						$order_data['commission_rule'] = $activity['prize']['commission_rule'];
						model_api::handler($_W['plugin']['poster']['config']);
						model_api::commission_order($mid,$order_data);
						//model_api::commission_completeOrder($order_data['orderno']);
					}
				}
				$result = true;
			}
			
			if ($result){			
				//判断是否为付费活动
				if ($pay_price > 0){
					show_json(app_url("pay/paytype", array('id'=>$orderid, 'newoder'=>1)));
				}else{				
					//积分变更
					if ($_W['_config']['creditstatus'] == 1){
						$credit = $activity['prize']['credit'] * $buynum;
						if ($credit > 0){
							$credit = $credit_double ? $credit * 2 : $credit;
							m('member')->credit_update_credit1($_W['member']['uid'], $credit, "参与活动奖励：增加" . $credit . m('member')->getCreditName('credit1'), $activity['merchantid']);
						}
						if ($dc == 'yes'){ 
							m('member')->credit_update_credit1($_W['member']['uid'], -1 * $deduct[0], "支付抵扣：减少" . $deduct[0] . m('member')->getCreditName('credit1'), $activity['merchantid']);
						}
						if ($activity['costcredit']){
							m('member')->credit_update_credit1($_W['member']['uid'], -1 * $activity['costcredit'], "参与活动消耗：减少" . $activity['costcredit'] . m('member')->getCreditName('credit1'), $activity['merchantid']);
						}
					}
					
					//订单确认处理程序
					model_records::checkOrderConfirm($orderno);
					
					//消息处理				
					if (!$activity['switch']['joinreview']) {
						$item =  pdo_get('fx_activity_records', array('id' => $orderid), array('realname', 'mobile','hexiaoma'));
						//报名成功通知
						message::join_success($_W['openid'], $activity, $orderid, app_url('order/detail',array('id'=>$orderid,'type'=>'u')));
						if($activity['smsnotify']['switch']){//短信通知
							$smsparams=array(
								'product' => $_W['_config']['sname'],
								'item'    => $activity['title'],
								'name'    => $item['realname'],
								'timestr' => date('m月d日 H:i',strtotime($activity['starttime'])),
								'idcode'  => $item['hexiaoma'],
								'address' => model_activity::getAddress($id)
							);
							$template_id = empty($activity['smsnotify']['join']) ? $_W['_config']['sms_notify'] : $activity['smsnotify']['join'];
							sendSMS($item['mobile'], $smsparams, $template_id, $_W['_config']['sms_type']);
						}
					}else{
						//待审核通知
						message::join_review($_W['openid'], $activity, 0, app_url('order/detail',array('id'=>$orderid, 'type'=>'u')));
					}
					if ($_W['_config']['mmsg']){//管理通知
						if ($activity['merchantid'])
						$merchant = model_merchant::getSingleMerchant($activity['merchantid'], '*');//读取主办方
						$openids = $activity['openids'];
						$openids = !empty($openids) ? $openids : unserialize($merchant['messageopenid']);
						$openids = !empty($openids) ? $openids : $_W['_config']['openids'];
						if (!empty($openids)){
							foreach($openids as $key=> $value){
								message::admin_notice($value, $activity, $orderid, '');
							}
						}
					}
					show_json(app_url("pay/success", array('id'=>$orderid)));
				}
			}
		}
		flock($fp, LOCK_UN);
	}
	fclose($fp);
}