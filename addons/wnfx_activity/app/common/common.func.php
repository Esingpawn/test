<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 */
defined('IN_IA') or exit('Access Denied');

function wx_jssdk($debug = false){	
	global $_W;
	
	if (defined('HEADER')) {
		echo '';
		return;
	}
	
	$sysinfo = array(
		'uniacid' 	=> $_W['uniacid'],
		'acid' 		=> $_W['acid'],
		'siteroot' 	=> $_W['siteroot'],
		'siteurl' 	=> $_W['siteurl'],
		'attachurl' => $_W['attachurl'],
		'cookie' 	=> array('pre'=>$_W['config']['cookie']['pre'])
	);
	if (!empty($_W['acid'])) {
		$sysinfo['acid'] = $_W['acid'];
	}
	if (!empty($_W['openid'])) {
		$sysinfo['openid'] = $_W['openid'];
	}
	if (defined('MODULE_URL')) {
		$sysinfo['MODULE_URL'] = MODULE_URL;
	}
	$sysinfo = json_encode($sysinfo);
	$_W['account']['jssdkconfig'] = $_W['container']=='workwechat' ? m('weixin')->getJssdkConfig() : $_W['account']['jssdkconfig'];
	$jssdkconfig = json_encode($_W['account']['jssdkconfig']);
	$debug = $debug ? 'true' : 'false';
	
	$script = <<<EOF
<script src="//res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
<script type="text/javascript">
	window.sysinfo = window.sysinfo || $sysinfo || {};
	
	// jssdk config 对象
	jssdkconfig = $jssdkconfig || {};
	
	jssdkconfig.beta = true;
	// 是否启用调试
	jssdkconfig.debug = $debug;
	
	jssdkconfig.jsApiList = [
		'checkJsApi',
		'onMenuShareWechat',		
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'updateAppMessageShareData',
		'updateTimelineShareData',
		'onMenuShareQQ',
		'onMenuShareWeibo',
		'hideMenuItems',
		'showMenuItems',
		'hideAllNonBaseMenuItem',
		'showAllNonBaseMenuItem',
		'translateVoice',
		'startRecord',
		'stopRecord',
		'onRecordEnd',
		'playVoice',
		'pauseVoice',
		'stopVoice',
		'uploadVoice',
		'downloadVoice',
		'chooseImage',
		'previewImage',
		'uploadImage',
		'downloadImage',
		'getNetworkType',
		'openLocation',
		'getLocation',
		'hideOptionMenu',
		'showOptionMenu',
		'closeWindow',
		'scanQRCode',
		'chooseWXPay',
		'openProductSpecificView',
		'addCard',
		'chooseCard',
		'openCard',
		'openAddress',
		'invoke'
	];
	
	wx.config(jssdkconfig);
</script>
EOF;
	echo $script;
}