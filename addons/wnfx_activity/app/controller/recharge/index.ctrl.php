<?php
defined('IN_IA') or exit('Access Denied');
function main(){
	global $_W,$_GPC;
	$_W['page']['title'] = '充值中心';
	load() -> model('card');
	$data = m('common')->getPluginset('sale');
	$recharge = iunserializer($data['recharges']);
	if (empty($recharge)) {		
		$recharge_settings = card_params_setting('cardRecharge');
	}else{
		foreach ($recharge as $key => &$value) {			
			if(strpos($value['give'],'%') !== false)
				$value['back'] = $value['enough'] * (float)$value['give']/100;
			else
				$value['back'] = $value['give'];
		}
	}
	if($_W['ispost']) {
		$fee = floatval($_GPC['fee']);
		$backtype = trim($_GPC['backtype']);
		$back= floatval($_GPC['back']);
		if (empty($fee) || $fee <= 0) {
			message('请选择充值金额', referer(), 'error');
		}
		$chargerecord = array(
			'uid' => $_W['member']['uid'],
			'openid' => $_W['openid'],
			'uniacid' => $_W['uniacid'],
			'tid' => date('YmdHi').random(8, 1),
			'fee' => $fee,
			'type' => 'credit',
			'tag' => $back,
			'backtype' => $backtype,
			'status' => 0,
			'createtime' => TIMESTAMP,
		);
		if (!pdo_insert('mc_credits_recharge', $chargerecord)) {
			message('创建充值订单失败，请重试！', app_url('recharge'), 'error');
		}
		show_json(app_url("recharge/pay", array('tid'=>$chargerecord['tid'])));
	}
	include fx_template();
}

function pay() {
	global $_W,$_GPC;
	$_W['page']['title'] = '充值订单';
	session_start();
	$tid = $_GPC['tid'];
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
	$order = pdo_get('mc_credits_recharge', array('tid'=>$tid));
	$params = array(
		'tid' => $order['tid'],
		'ordersn' => $order['tid'],
		'title' => '会员余额充值',
		'fee' => $order['fee'],
		'user' => $_W['member']['uid'],
		'account_name' => $_W['account']['name'],
	);
	$mine = array();
	if (empty($order['backtype'])) {
		$condition = $order['fee'];
		$mine = array(
			'name' => "充{$condition}送{$order['tag']}元",
			'value' => $order['fee']
		);
	} elseif ($order['backtype'] == '1') {
		$condition = $order['fee'];
		$mine = array(
			'name' => "充{$condition}送{$order['tag']}" . m('member')->getCreditName('credit1'),
			'value' => $order['fee']
		);
	} elseif ($order['backtype'] == '2') {
		$condition = $order['fee'];
	}
	
	//$_W['current_module']['name'];
	$_SESSION['pay']['token'] = $_W['token'];//设置验证相关参数SESSION
	$params['module'] = IN_MODULE;
	$sql = 'SELECT * FROM ' . tablename('core_paylog') . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid';
	$pars = array();
	$pars[':uniacid'] = $_W['uniacid'];
	$pars[':module'] = $params['module'];
	$pars[':tid'] = $params['tid'];
	$log = pdo_fetch($sql, $pars);
	if(!empty($log) && $log['status'] == '1') {
		itoast('这个订单已经支付成功, 不需要重复支付.', '', 'info');
	}
	$setting = uni_setting($_W['uniacid'], array('payment', 'creditbehaviors'));
	if(!is_array($setting['payment'])) {
		itoast('没有有效的支付方式, 请联系网站管理员.', '', 'error');
	}
	$log = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $params['module'], 'tid' => $params['tid']));
	if (empty($log)) {
		$log = array(
			'uniacid' => $_W['uniacid'],
			'acid' => $_W['acid'],
			'openid' => $_W['openid'],
			'module' => IN_MODULE,
			'tid' => $params['tid'],
			'fee' => $params['fee'],
			'type' => 'wechat',
			'tag' => iserializer(array('order_type'=>'recharge')),
			'card_fee' => $params['fee'],
			'status' => '0',
			'is_usecard' => '0',
		);
		pdo_insert('core_paylog', $log);
	}
	$pay = $setting['payment'];
	
	foreach ($pay as &$value) {
		if ($_W['account']->typeSign != 'wxapp'){
			$value['switch'] = $value['recharge_switch'];
		}		
	}
	unset($value);
	$pay['credit']['switch'] = false;
	$pay['delivery']['switch'] = false;
	$_W['_config']['deliverystatus'] = false;
	include fx_template('pay/paytype');
}