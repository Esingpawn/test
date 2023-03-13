<?php 

class WeixinPay
{
	public $wxpay;

	public function __construct($module = '') {
		global $_W;

		if (!empty($module) && 'store' == $module) {
			$setting = setting_load('store_pay');
			$wxpay = $setting['store_pay']['wechat'];
		} else {
			$setting = uni_setting($_W['uniacid']);
			$wxpay = $setting['payment']['wechat'];
		}

		if (3 == intval($wxpay['switch'])) {
			$oauth_account = uni_setting($wxpay['service'], array('payment'));
			$oauth_acid = pdo_getcolumn('uni_account', array('uniacid' => $wxpay['service']), 'default_acid');
			$oauth_appid = pdo_getcolumn('account_wechats', array('acid' => $oauth_acid), 'key');
			$this->wxpay = array(
				'appid' => $oauth_appid,
				'mch_id' => $oauth_account['payment']['wechat_facilitator']['mchid'],
				'sub_mch_id' => $wxpay['sub_mch_id'],
				'key' => $oauth_account['payment']['wechat_facilitator']['signkey'],
				'notify_url' => $_W['siteroot'] . 'payment/wechat/notify.php',
			);
		} else {
			$this->wxpay = array(
				'appid' => 'store' == $module ? $wxpay['appid'] : $_W['account']['key'],
				'mch_id' => $wxpay['mchid'],
				'key' => !empty($wxpay['apikey']) ? $wxpay['apikey'] : $wxpay['signkey'],
				'notify_url' => $_W['siteroot'] . 'payment/wechat/notify.php',
			);
		}
	}
	
	//退款
	public function refund($refund_id, $refund_account='') {
		global $_W;
		$refund_param = $this->refund_build($refund_id);
		if($refund_param['refund_fee'] > $refund_param['total_fee']){
			$rearr['err_code']='ERROR';
			$rearr['err_code_des']='退款金额不能大于实际支付金额';
			return $rearr;			
		}
		if(!empty($refund_account)){
			$refund_param['refund_account'] = 'REFUND_SOURCE_RECHARGE_FUNDS';
		}
		$refund_param['sign'] = $this->getSign($refund_param);
		
		$xml = $this->arrayToXml($refund_param);
		$url ="https://api.mch.weixin.qq.com/secapi/pay/refund";
		$re = $this->wxHttpsRequestPem($xml,$url);
		$rearr = $this->xmlToArray($re);
		
		$cert_file = ATTACHMENT_ROOT . $_W['uniacid'] . '_wechat_refund_all.pem';
		unlink($cert_file);
		
		if(empty($rearr)){
			$rearr['err_code']='ERROR';
			$rearr['err_code_des']='证书配置不正确';
			return $rearr;
		}
		return $rearr;
	}
	
	public function refund_build($refund_id, $is_wish = 0) {
		global $_W;
		$setting = uni_setting($_W['uniacid'], array('payment'));
		$pay_setting = $setting['payment'];
		$refund_setting = $setting['payment']['wechat_refund'];
		
		$refundlog = pdo_get('core_refundlog', array('id' => $refund_id));
		
		$uniacid = $refundlog['is_wish'] == 1 ? $refundlog['uniacid'] : $_W['uniacid'];
		$paylog = pdo_get('core_paylog', array('uniacid' => $uniacid, 'uniontid' => $refundlog['uniontid']));
		$paylog['tag'] = iunserializer($paylog['tag']);	
		$account = uni_fetch($uniacid);
		settype($pay_setting['wechat']['switch'], 'integer');
		//借用支付		
		if ($pay_setting['wechat']['switch'] == 2) {
		    $account = uni_fetch($setting['payment']['wechat']['borrow']);
			$setting = $account['setting']['payment'];
          	$pay_setting = $setting['payment'];
			$refund_setting = $setting['payment']['wechat_refund'];
        }
		
		$refund_param = array(
			'appid' => $account['key'],
			'mch_id' => $pay_setting['wechat']['mchid'],
			'transaction_id' => $paylog['tag']['transaction_id'],
			'out_refund_no' => $paylog['tag']['transaction_id'] . rand(1000,9999),
			'total_fee' => $paylog['card_fee'] * 100,
			'refund_fee' => $refundlog['fee'] * 100,
			'nonce_str' => $this->createNoncestr(),
			'refund_desc' => $refundlog['reason'],
			'op_user_id' => $pay_setting['wechat']['mchid']

		);
		//服务商支付
		if ($pay_setting['wechat']['switch'] == 3) {
			$refund_param['sub_mch_id'] = $pay_setting['wechat']['sub_mch_id'];
			$refund_param['sub_appid'] = $account['key'];
			$proxy_account = uni_fetch($pay_setting['wechat']['service']);
			$refund_param['appid'] = $proxy_account['key'];
			$refund_param['mch_id'] = $proxy_account['setting']['payment']['wechat_facilitator']['mchid'];
			$refund_param['op_user_id'] = $proxy_account['setting']['payment']['wechat_facilitator']['mchid'];
			//print_r($refund_param);
		}		
		
		$cert = authcode($refund_setting['cert'], 'DECODE');
		$key = authcode($refund_setting['key'], 'DECODE');
		$cert_file = $_W['uniacid'] . '_wechat_refund_all.pem';
		file_put_contents(ATTACHMENT_ROOT . $cert_file, $cert . $key);
		
		return $refund_param;
	}
	
	//查询退款
	public function checkRefund($transid) {
		global $_W;
		$setting = uni_setting($_W['uniacid'], array('payment'));
		$wechat = $setting['payment']['wechat'];
		//借用支付
		if ($setting['payment']['wechat']['switch']==2){
			$setting = uni_setting($setting['payment']['wechat']['borrow'], array('payment'));
          	$wechat = $setting['payment']['wechat'];
        }elseif ($setting['payment']['wechat']['switch']==3){
         	$wechat = $setting['payment']['wechat_facilitator'];
          	$data['sub_mch_id'] =  $setting['payment']['wechat']['sub_mch_id'];
        }
		$data['appid'] = $_W['account']['key'];
		$data['mch_id'] = $wechat['mchid'];
		$data['transaction_id'] = $transid;
		$data['nonce_str'] = $this->createNoncestr();
		$data['sign'] = $this->getSign($data);		
		
		if(empty($data['appid']) || empty($data['mch_id'])){
			$rearr['return_msg']='请先在微擎的功能选项-支付参数内设置微信商户号和秘钥';
			return $rearr;
		}
		$xml = $this->arrayToXml($data);
		$url ="https://api.mch.weixin.qq.com/pay/refundquery";
		$re = $this->wxHttpsRequestPem($xml,$url);
		$rearr = $this->xmlToArray($re);

		return $rearr;
	}
	
	public function createNoncestr( $length = 32 ) {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$str ="";
		for ( $i = 0; $i < $length; $i++ ) 
		{
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
		}
		return $str;
	}
	
	function formatBizQueryParaMap($paraMap, $urlencode) {
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v) 
		{
			if($urlencode) 
			{
				$v = urlencode($v);
			}
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0) 
		{
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	
	public function getSign($Obj) {
		global $_W;		
		$setting = uni_setting($_W['uniacid'], array('payment'));
		$pay_setting = $setting['payment'];
		settype($pay_setting['wechat']['switch'], 'integer');
		//借用支付
		if ($pay_setting['wechat']['switch']==2){
			$setting = uni_setting($pay_setting['wechat']['borrow'], array('payment'));
          	$pay_setting = $setting['payment'];
        }
		if ($pay_setting['wechat']['switch']==3){
			$proxy_account = uni_fetch($pay_setting['wechat']['service']);
			$pay_setting['wechat']['mchid'] =  $proxy_account['setting']['payment']['wechat_facilitator']['mchid'];
			$pay_setting['wechat']['signkey'] = $proxy_account['setting']['payment']['wechat_facilitator']['signkey'];
        }
		foreach ($Obj as $k => $v) 
		{
			$Parameters[$k] = $v;
		}
		ksort($Parameters);
		$String = $this->formatBizQueryParaMap($Parameters, false);
		$String = $String."&key=".$pay_setting['wechat']['signkey'];
		$String = md5($String);
		$result_ = strtoupper($String);
		return $result_;
	}
	
	public function arrayToXml($arr) {
		$xml = "<xml>";
		foreach ($arr as $key=>$val) 
		{
			if (is_numeric($val)) 
			{
				$xml.="<".$key.">".$val."</".$key.">";
			}
			else $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
		}
		$xml.="</xml>";
		return $xml;
	}
	public function xmlToArray($xml) {
		$array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		return $array_data;
	}
	
	public function wxHttpsRequestPem($vars,$url, $second=30,$aHeader=array()) {
		global $_W;
		$cert_file = ATTACHMENT_ROOT . $_W['uniacid'] . '_wechat_refund_all.pem';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLCERT, $cert_file);
		//curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
		//curl_setopt($ch,CURLOPT_SSLKEY,IA_ROOT . '/attachment/'.IN_MODULE.'/cert/' . $_W['uniacid'] . '/apiclient_key.pem');
		//curl_setopt($ch,CURLOPT_CAINFO,'PEM');
		//curl_setopt($ch,CURLOPT_CAINFO,IA_ROOT . '/attachment/'.IN_MODULE.'/cert/' . $_W['uniacid'] . '/rootca.pem');
		if( count($aHeader) >= 1 )
		{
			curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
		}
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
		$data = curl_exec($ch);
		if($data)
		{
			curl_close($ch);
			return $data;
		}else {
			$error = curl_errno($ch);
			if ($error) {
				$return_code = 'FAIL';
			}
			curl_close($ch);
			return false;
		}
	}
	
	public function pay($request) {
		global $_W;
		if (empty($request['openid'])) {
			$rearr['err_code']='ERROR';
			$rearr['err_code_des']='openid不能为空';
			return $rearr;
		}
		load() -> func('communication');
		$setting = uni_setting($_W['uniacid'], array('payment'));
		$refund_setting = $setting['payment']['wechat_refund'];
		
		if (!is_array($setting['payment'])) {
			$rearr['err_code']='ERROR';
			$rearr['err_code_des']='没有设定支付参数';
			return $rearr;
		}
		
		$wechat = $setting['payment']['wechat'];
		//借用支付
		if ($setting['payment']['wechat']['switch']==2){
			$setting = uni_setting($setting['payment']['wechat']['borrow'], array('payment'));
          	$wechat = $setting['payment']['wechat'];
        }elseif ($setting['payment']['wechat']['switch']==3){
         	$wechat = $setting['payment']['wechat_facilitator'];
          	$data['sub_mch_id'] =  $setting['payment']['wechat']['sub_mch_id'];
        }
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
		$pars = array();
		$pars['mch_appid'] = $_W['account']['key'];
		$pars['mchid'] = $wechat['mchid'];
		$pars['nonce_str'] = $this->createNoncestr();
		$pars['partner_trade_no'] = time() . random(4, true);
		$pars['openid'] = $request['openid'];
		$pars['check_name'] = 'NO_CHECK';
		$pars['amount'] = $request['money'] * 100;
		$pars['desc'] = empty($request['desc']) ? '用户提现' : $request['desc'];
		$pars['spbill_create_ip'] = gethostbyname($_SERVER["HTTP_HOST"]);
		$pars['sign'] = $this->getSign($pars);
		
		if(empty($pars['mch_appid']) || empty($pars['mchid'])){
			$rearr['err_code']='ERROR';
			$rearr['err_code_des']='请先在微擎的功能选项-支付参数内设置微信商户号和秘钥';
			return $rearr;
		}
		
		$cert = authcode($refund_setting['cert'], 'DECODE');
		$key = authcode($refund_setting['key'], 'DECODE');
		$cert_file = $_W['uniacid'] . '_wechat_refund_all.pem';
		file_put_contents(ATTACHMENT_ROOT . $cert_file, $cert . $key);
		
		$xml = $this->arrayToXml($pars);		
		$resp = $this->wxHttpsRequestPem($xml,$url);
		$rearr = $this->xmlToArray($resp);
		if(empty($rearr)){
			$rearr['err_code']='ERROR';
			$rearr['err_code_des']='证书配置不正确';
			return $rearr;
		}
		$cert_file = ATTACHMENT_ROOT . $_W['uniacid'] . '_wechat_refund_all.pem';
		unlink($cert_file);
		return $rearr;
	}
	
	public function array2url($params) {
		$str = '';
		foreach($params as $key => $val) {
			if(empty($val) || is_array($val)) {
				continue;
			}
			$str .= "{$key}={$val}&";
		}
		$str = trim($str, '&');
		return $str;
	}

	public function bulidSign($params) {
		unset($params['sign']);
		ksort($params);
		$string = $this->array2url($params);
		$string = $string . "&key={$this->wxpay['key']}";
		$string = md5($string);
		$result = strtoupper($string);
		return $result;
	}
	
	public function parseResult($result) {
		if(substr($result, 0 , 5) != "<xml>"){
			return $result;
		}
		$result = json_decode(json_encode(isimplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		if(!is_array($result)) {
			return error(-1, 'xml结构错误');
		}
		if((isset($result['return_code']) && $result['return_code'] != 'SUCCESS') || ($result['err_code'] == 'ERROR' && !empty($result['err_code_des']))) {
			$msg = empty($result['return_msg']) ? $result['err_code_des'] : $result['return_msg'];
			return error(-1, $msg);
		}
		if($this->bulidsign($result) != $result['sign']) {
			return error(-1, '验证签名出错');
		}
		return $result;
	}
	
	public function closeOrder($trade_no) {
		$params = array(
			'appid' => $this->wxpay['appid'],
			'mch_id' => $this->wxpay['mch_id'],
			'nonce_str' =>  random(32),
			'out_trade_no' => trim($trade_no),
		);
		$params['sign'] = $this->bulidSign($params);
		$xml = array2xml($params);
		$response = ihttp_request('https://api.mch.weixin.qq.com/pay/closeorder', $xml);				
		if(is_error($response)) {
			return $response;
		}
		$result = $this->parseResult($response['content']);
		return $result;
	}
}
?>