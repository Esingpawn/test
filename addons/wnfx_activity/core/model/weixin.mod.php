<?php
/*红客联盟  hon123.com*/
if (!defined('IN_IA')) {
	exit('Access Denied');
}
class Weixin_FxModel {
	public function getAccessToken() {
		global $_W;
		$workwe = $template = m('cache')->getArray('workwe');
		$cachekey = "accesstoken:{$workwe['key']}";
		$cache = cache_load($cachekey);
		if (!empty($cache) && !empty($cache['token'])) {
			return $cache['token'];
		}
		
		if (empty($workwe['key']) || empty($workwe['secret'])) {
			return error('-1', '未填写企业微信的 企业ID 或 secret！');
		}
	
		$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid={$workwe['key']}&corpsecret={$workwe['secret']}";
		$content = ihttp_get($url);
		if (is_error($content)) {
			return error('-1', '获取企业微信授权失败, 请稍后重试！错误详情: ' . $content['message']);
		}
		if (empty($content['content'])) {
			return error('-1', 'AccessToken获取失败，请检查appid和appsecret的值是否与微信公众平台一致！');
		}
		$token = @json_decode($content['content'], true);
	
		if ('40164' == $token['errcode']) {
			return error('-1', '获取企业微信授权失败！错误代码:' . $token['errcode'] . '，错误信息:' . $token['errmsg']);
		}
		if (empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['expires_in'])) {
			return error('-1', '获取企业微信授权失败！错误代码:' . $token['errcode'] . '，错误信息:' . $token['errmsg']);
		}
		$record = array();
		$record['token'] = $token['access_token'];
		$record_expire = $token['expires_in'] - 200;
		cache_write($cachekey, $record, $record_expire);
		return $record['token'];
	}
	public function getJsApiTicket() {
		$workwe = $template = m('cache')->getArray('workwe');
		if (empty($workwe)) {
			$workwe = m('common')->getSysset('workwe');
			m('cache')->set('workwe', $workwe);
		}
		$cachekey = "jsticket:{$workwe['key']}";
		$cache = cache_load($cachekey);
		if (!empty($cache) && !empty($cache['ticket'])) {
			return $cache['ticket'];
		}
		$access_token = $this->getAccessToken();
		if (is_error($access_token)) {
			return $access_token;
		}
		$url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token={$access_token}";
		$content = ihttp_get($url);
		if (is_error($content)) {
			return error(-1, '调用接口获取企业微信 jsapi_ticket 失败, 错误信息: ' . $content['message']);
		}
		$result = @json_decode($content['content'], true);
		if (empty($result) || 0 != intval(($result['errcode'])) || 'ok' != $result['errmsg']) {
			return error(-1, '获取企业微信 jsapi_ticket 结果错误, 错误信息: ' . $result['errcode'], $result['errmsg']);
		}
		$record = array();
		$record['ticket'] = $result['ticket'];
		$record_expire = $result['expires_in'] - 200;
		cache_write($cachekey, $record, $record_expire);

		return $record['ticket'];
	}

	
	public function getJssdkConfig($url = '') {
		global $_W, $urls;
		$jsapiTicket = $this->getJsApiTicket();
		if (is_error($jsapiTicket)) {
			$jsapiTicket = $jsapiTicket['message'];
		}
		$nonceStr = random(16);
		$timestamp = TIMESTAMP;
		$url = empty($url) ? ($urls['scheme'] . '://' . $urls['host'] . $_SERVER['REQUEST_URI']) : $url;
		$string1 = "jsapi_ticket={$jsapiTicket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";
		$signature = sha1($string1);
		$workwe = $template = m('cache')->getArray('workwe');
		$config = array(
			'appId' => $workwe['key'],
			'nonceStr' => $nonceStr,
			'timestamp' => "$timestamp",
			'signature' => $signature,
		);
		if (DEVELOPMENT) {
			$config['url'] = $url;
			$config['string1'] = $string1;
			$config['name'] = $this->account['name'];
		}

		return $config;
	}
}
?>