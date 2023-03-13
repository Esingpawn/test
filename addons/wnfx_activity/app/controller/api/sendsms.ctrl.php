<?php
$_W['op'] = !empty($_W['op']) ? $_W['op'] : 'code';
$mobile = $_GPC['mobile'];
if($_W['isajax'] && $_W['op'] =='code'){//验证码；
	$smscode = createRandomNumber(6);
	$keystr = $_GPC['key'] == '' ? '' : '_' . $_GPC['key'];
	setcookie("sms_mobile" . $keystr, $mobile, time()+600);
	setcookie("sms_code" . $keystr, $smscode, time()+600);
	$params=array(
		'code' => $smscode
	);
	die(json_encode(sendSMS($mobile, $params, $_W['_config']['sms_code'], $_W['_config']['sms_type'])));
}

if($_W['isajax'] && $_W['op'] =='notify'){//短信通知；
	$params=array(
		'product' => $_W['account']['name'],
		'item'    => $_GPC['title']
	);
	die(json_encode(sendSMS($mobile,$params,$_W['_config']['sms_notify'], $_W['_config']['sms_type'])));
}