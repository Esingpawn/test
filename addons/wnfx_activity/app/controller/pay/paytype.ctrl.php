<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * paytype.ctrl
 * 支付方式控制器
 */
defined('IN_IA') or exit('Access Denied');
session_start();
$pagetitle = '支付方式'; //title
$orderid = $_GPC['id']; //支付订单ID
$setting = uni_setting($_W['uniacid'], array('payment'));
if (intval($setting['payment']['wechat']['switch']) == 2 || intval($setting['payment']['wechat']['switch']) == 3) {
	load()->model('payment');
    $proxy_pay_account = payment_proxy_pay_account();
	if (!empty($_GPC['code'])) {
    	$oauth = $proxy_pay_account->getOauthInfo($_GPC['code']);
    	if (!empty($oauth['openid'])) {
			$_SESSION['pay_openid'] = $oauth['openid'];
    	}
    }
	if(empty($_SESSION['pay_openid'])){
        $oauth_url = uni_account_oauth_host();
        if (!empty($oauth_url)) {
            $callback = app_url('pay/paytype',array('id'=>$orderid));
        }
        if (!is_error($proxy_pay_account)) {
            $forward = $proxy_pay_account->getOauthCodeUrl(urlencode($callback), 'we7sid-'.$_W['session_id']);
            header('Location: ' . $forward);
            exit;
        }
    }    
	$payopenid = $_SESSION['pay_openid'];
}

if ($_W['_config']['onlyonce']) {
	$isonly = pdo_getcolumn("fx_activity_records", array('uniacid'=>$_W['uniacid'],'uid'=>$_W['openid'],'status'=>array(1,2)), 'COUNT(*)');
	if ($isonly) fx_message('抱歉，您有其它活动待参与，不可以重复参加多个活动！', '', 'error', '');
}

$creditType = $_GPC['creditType']?$_GPC['creditType']:'pay'; // =recharge为余额充值。
if($creditType=='recharge'){ //余额充值订单
	$goods['title'] = $pagetitle = '余额充值';
	$order = pdo_fetch("select * from".tablename('mc_credits_recharge')."where id={$orderid}");
	$order['pay_price'] = $order['num']; // 兼容：无论app还是微信充值 充值金额 都为 $order['pay_price']。。
	$_W['_config']['paytype']['balancestatus'] = $setting['helpbuy'] = $_W['_config']['paytype']['deliverystatus'] = 0; //若为余额充值仅允许微信支付，其他支付置空。
}else{ //支付订单
	$_W['merchant']['name'] = $_W['_config']['sname'];
	$order = model_records::getOrderCount($orderid, '0');
	$goods = model_activity::getSingleActivity($order['activityid'], '*');
	if (TIMESTAMP > strtotime($goods['endtime'])){
		fx_message("活动已结束，不可支付.",app_url('records/list'),'warning');
	}
	if ($goods['merchantid']){
		$merchant  = model_merchant::getSingleMerchant($goods['merchantid'], '*');//读取主办方
		$_W['merchant']['name']      = $merchant['name'];
	}
}

$_paydata = array(
	'activityid' => $goods['id'],    //当前活动ID
	'buynum'    => $order['buynum'],   //当前支付订单参加名额
	'token' => $_W['token']
);
$_SESSION['pay'] = $_paydata;//设置验证相关参数SESSION

if($order['status']!=0 && $order['status']!=5)
fx_message("该订单已支付了.",app_url('records/list'),'warning'); // 判断订单是否已支付。

if(empty($order['openid'])){ //兼容缓存中openid为空的订单。
	//Util::deleteCache('order', $orderid);
	//$order = model_order::getSingleOrder($orderid, '*');
}
if($order['price'] <= 0) {
	fx_message("支付金额错误,支付金额需大于0元.");
}

if($_W['op'] =='display'){
	$pay = $setting['payment'];
	$pay['credit']['switch'] = !empty($pay['credit']['pay_switch']) ? $pay['credit']['pay_switch'] : $pay['credit']['switch'];
	if (!empty($_W['_config']['creditpay'])) {
		$credtis = mc_credit_fetch($_W['member']['uid']);		
		$credit_pay_setting = mc_fetch($_W['member']['uid'], array('pay_password'));
		$credit_pay_setting = $credit_pay_setting['pay_password'];
	}
	$params = array(
		'tid'     => $order['orderno'],      //充值模块中的订单号，此号码用于业务模块中区分订单，交易的识别码
		'ordersn' => $order['orderno'],  //收银台中显示的订单号
		'title'   => $goods['title'],          //收银台中显示的标题
		'fee'     => $order['price'],      //收银台中显示需要支付的金额,只能大于 0
		'user'    => $_W['openid'],     //付款用户, 付款的用户名(选填项)
		'module'  => IN_MODULE, //模块名称，请保证$this可用
		'account_name' => $_W['merchant']['name'],
	);
	//生成paylog记录
	$log = pdo_get('core_paylog', array('module' => $params['module'], 'tid' => $params['tid']));
	$moduleid = $_W['current_module']['mid'];
	$moduleid = empty($moduleid) ? '000000' : sprintf("%06d", $moduleid);
	$uniontid = date('YmdHis').$moduleid.random(8,1);
	if (empty($log)) {		
		$data = array(
			'type' => $_W['account']->typeSign == 'account' ? 'wechat' : 'wxapp',
			'uniacid' => $_W['uniacid'],
			'acid' => $_W['acid'],
			'openid' => $_W['openid'],
			'uniontid' => $uniontid,
			'tid' => $params['tid'],
			'fee' => $params['fee'],
			'status' => '0',
			'module' => IN_MODULE, //模块名称，请保证$this可用
			'card_fee' => $params['fee'],
			'is_usecard' => '0',
		);
		pdo_insert('core_paylog', $data);
		pdo_update('fx_activity_records',array('uniontid'=>$uniontid), array('orderno'=>$params['tid']));
	}else{
		if ($_GPC['from']!='wxapp') {
			pdo_update('core_paylog',array('uniacid'=>$_W['uniacid'], 'acid'=>$_W['uniacid'], 'openid'=>$_W['openid'], 'uniontid' => $uniontid, 'type'=>'wechat'), array('tid'=>$params['tid'], 'module'=>IN_MODULE, 'type'=>array('wxapp')));
			pdo_update('fx_activity_records',array('uniontid'=>$uniontid), array('orderno'=>$params['tid']));
		}
	}
	
	include fx_template('pay/paytype');
}