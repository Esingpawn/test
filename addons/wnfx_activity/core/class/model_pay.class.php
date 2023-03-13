<?php


// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 发起支付
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
class model_pay
{
	static function wechat_proxy_build($params, $wechat, $notify_url='') {
		global $_W;
		$uniacid = !empty($wechat['service']) ? $wechat['service'] : $wechat['borrow'];
		$oauth_account = uni_setting($uniacid, array('payment'));
		if (intval($wechat['switch']) == '2') {
			$_W['uniacid'] = $uniacid;
			$wechat['signkey'] = $oauth_account['payment']['wechat']['signkey'];
			$wechat['mchid'] = $oauth_account['payment']['wechat']['mchid'];
			unset($wechat['sub_mch_id']);
		} else {
			$wechat['signkey'] = $oauth_account['payment']['wechat_facilitator']['signkey'];
			$wechat['mchid'] = $oauth_account['payment']['wechat_facilitator']['mchid'];
		}
		$acid = pdo_getcolumn('uni_account', array('uniacid' => $uniacid), 'default_acid');
		$wechat['appid'] = pdo_getcolumn('account_wechats', array('acid' => $acid), 'key');
		$wechat['version'] = 2;
		return self::wechat_build($params, $wechat, $notify_url);
	}
	
	static function wechat_build($params, $wechat, $notify_url='') {
		global $_W;
		load()->func('communication');
		if(empty($notify_url)) $notify_url = $_W['siteroot'] . 'payment/wechat/notify.php';
		if (empty($wechat['version']) && !empty($wechat['signkey'])) {
			$wechat['version'] = 1;
		}
		$wOpt = array();
		if ($wechat['version'] == 1) {
			$wOpt['appId'] = $wechat['appid'];
			$wOpt['timeStamp'] = strval(TIMESTAMP);
			$wOpt['nonceStr'] = random(8);
			$package = array();
			$package['bank_type'] = 'WX';
			$package['body'] = $params['title'];
			$package['attach'] = $_W['uniacid'];
			$package['partner'] = $wechat['partner'];
			$package['out_trade_no'] = $params['uniontid'];
			$package['total_fee'] = $params['fee'] * 100;
			$package['fee_type'] = '1';
			$package['notify_url'] = $notify_url;
			$package['spbill_create_ip'] = CLIENT_IP;
			$package['time_start'] = date('YmdHis', TIMESTAMP);
			$package['time_expire'] = date('YmdHis', TIMESTAMP + 600);
			$package['input_charset'] = 'UTF-8';
			if (!empty($wechat['sub_mch_id'])) {
				$package['sub_mch_id'] = $wechat['sub_mch_id'];
			}
			ksort($package);
			$string1 = '';
			foreach($package as $key => $v) {
				if (empty($v)) {
					continue;
				}
				$string1 .= "{$key}={$v}&";
			}
			$string1 .= "key={$wechat['key']}";
			$sign = strtoupper(md5($string1));
	
			$string2 = '';
			foreach($package as $key => $v) {
				$v = urlencode($v);
				$string2 .= "{$key}={$v}&";
			}
			$string2 .= "sign={$sign}";
			$wOpt['package'] = $string2;
	
			$string = '';
			$keys = array('appId', 'timeStamp', 'nonceStr', 'package', 'appKey');
			sort($keys);
			foreach($keys as $key) {
				$v = $wOpt[$key];
				if($key == 'appKey') {
					$v = $wechat['signkey'];
				}
				$key = strtolower($key);
				$string .= "{$key}={$v}&";
			}
			$string = rtrim($string, '&');
			$wOpt['signType'] = 'SHA1';
			$wOpt['paySign'] = sha1($string);
			return $wOpt;
		} else {
			$package = array();
			$package['appid'] = $wechat['appid'];
			$package['mch_id'] = $wechat['mchid'];
			$package['nonce_str'] = random(8);
			$package['body'] = cutstr($params['title'], 26);
			$package['attach'] = $_W['uniacid'];
			$package['out_trade_no'] = $params['uniontid'];
			$package['total_fee'] = $params['fee'] * 100;
			$package['spbill_create_ip'] = CLIENT_IP;
			$package['time_start'] = date('YmdHis', TIMESTAMP);
			$package['time_expire'] = date('YmdHis', TIMESTAMP + 600);
			$package['notify_url'] = $notify_url;
			$package['trade_type'] = 'JSAPI';
			$package['openid'] = empty($wechat['openid']) ? $_W['fans']['from_user'] : $wechat['openid'];
			if (!empty($wechat['sub_mch_id'])) {
				$package['sub_mch_id'] = $wechat['sub_mch_id'];
			}
			ksort($package, SORT_STRING);
			$string1 = '';
			foreach($package as $key => $v) {
				if (empty($v)) {
					continue;
				}
				$string1 .= "{$key}={$v}&";
			}
			$string1 .= "key={$wechat['signkey']}";
			$package['sign'] = strtoupper(md5($string1));
			$dat = array2xml($package);
			$response = ihttp_request('https://api.mch.weixin.qq.com/pay/unifiedorder', $dat);
			if (is_error($response)) {
				return $response;
			}
			$xml = @isimplexml_load_string($response['content'], 'SimpleXMLElement', LIBXML_NOCDATA);
			if (strval($xml->return_code) == 'FAIL') {
				return error(-1, strval($xml->return_msg));
			}
			if (strval($xml->result_code) == 'FAIL') {
				return error(-1, strval($xml->err_code).': '.strval($xml->err_code_des));
			}
			$prepayid = $xml->prepay_id;
			$wOpt['appId'] = $wechat['appid'];
			$wOpt['timeStamp'] = strval(TIMESTAMP);
			$wOpt['nonceStr'] = random(8);
			$wOpt['package'] = 'prepay_id='.$prepayid;
			$wOpt['signType'] = 'MD5';
			ksort($wOpt, SORT_STRING);
			foreach($wOpt as $key => $v) {
				$string .= "{$key}={$v}&";
			}
			$string .= "key={$wechat['signkey']}";
			$wOpt['paySign'] = strtoupper(md5($string));
			return $wOpt;
		}
	}
	
	static function pay_center($params = array(), $mine = array()) {

		global $_W,$_GPC;
		load()->model('activity');

		load()->model('module');

		activity_coupon_type_init();
		
		$params['module'] = $_W['current_module']['name'];

		$log = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $params['module'], 'tid' => $params['tid']));

		if (empty($log)) {

			$log = array(

				'uniacid' => $_W['uniacid'],

				'acid' => $_W['acid'],

				'openid' => $_W['member']['uid'],

				'module' => $params['module'],

				'tid' => $params['tid'],

				'fee' => $params['fee'],

				'card_fee' => $params['fee'],

				'status' => '0',

				'is_usecard' => '0',

			);

			pdo_insert('core_paylog', $log);

		}

		if ('1' == $log['status']) {

			message('这个订单已经支付成功, 不需要重复支付.', '', 'info');

		}

		$setting = uni_setting($_W['uniacid'], array('payment', 'creditbehaviors'));

		if (!is_array($setting['payment'])) {

			message('没有有效的支付方式, 请联系网站管理员.', '', 'error');

		}

		$pay = $setting['payment'];

		$we7_coupon_info = module_fetch('we7_coupon');

		if (!empty($we7_coupon_info)) {

			$cards = activity_paycenter_coupon_available();

			if (!empty($cards)) {

				foreach ($cards as $key => &$val) {

					if ('1' == $val['type']) {

						$val['discount_cn'] = sprintf('%.2f', $params['fee'] * (1 - $val['extra']['discount'] * 0.01));

						$coupon[$key] = $val;

					} else {

						$val['discount_cn'] = sprintf('%.2f', $val['extra']['reduce_cost'] * 0.01);

						$token[$key] = $val;

						if ($log['fee'] < $val['extra']['least_cost'] * 0.01) {

							unset($token[$key]);

						}

					}

					unset($val['icon']);

					unset($val['description']);

				}

			}

			$cards_str = json_encode($cards);

		}

		foreach ($pay as &$value) {

			$value['switch'] = $value['pay_switch'];

		}

		unset($value);

		if (empty($_W['member']['uid'])) {

			$pay['credit']['switch'] = false;

		}

		if ('paycenter' == $params['module']) {

			$pay['delivery']['switch'] = false;

			$pay['line']['switch'] = false;

		}

		if (!empty($pay['credit']['switch'])) {

			$credtis = mc_credit_fetch($_W['member']['uid']);

			$credit_pay_setting = mc_fetch($_W['member']['uid'], array('pay_password'));

			$credit_pay_setting = $credit_pay_setting['pay_password'];

		}

		$you = 0;

		include fx_template('pay/paytype');

	}
}