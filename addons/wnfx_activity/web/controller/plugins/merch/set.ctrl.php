<?php 
defined('IN_IA') or exit('Access Denied');
$tab = empty($_GPC['tab'])?'basic':str_replace('#tab_', '', $_GPC['tab']);
$settings = $_W['_config'];
$_W['page']['title'] = '基础设置';

$operator_prems=array();
$role_perms = array();
$user_perms = array();
$perms = perms::formatPerms();
$item = pdo_fetch('SELECT * FROM ' . tablename('fx_merch_perm_role') . ' WHERE deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));

if (!empty($item)) {
	$user_perms = $role_perms = explode(',', $item['perms']);
}
if ($_W['ispost']) {
	$initData = [
		'sname' => "",
		'slogo' => "",
		'followno' => 0,
		'detail' => "",
		'storename' => "",
		'lng' => "",
		'lat' => "",
		'adinfo' => "",
		'address' => "",
		'linkman_name' => "",
		'mobile' => "",
		'kefutel' => "",
		'kefuwixin' => "",
		'copyright' => ['title' => "", 'link' => "", 'logo' => ""],
		'openids' => "",
		'sys' => ['waterfall' => 0],
		'caterow' => 0,
		'home' => ['recom' => 1],
		'navswitch' => 1,
		'fbtn' => 1,
		'homebtn' => 1,
		'homeurl' => "",
		'slogan' => "",
		'kefu' => ['switch' => 0, 'type' => 1, 'qrcode' => "", 'url' => ""],
		'creditstatus' => 1,
		'credit1link' => "",
		'credit2' => 1,
		'credit2link' => "",
		'allowswitch' => 0,
		'cateswitch' => 1,
		'catesindex' => 1,
		'catemore' => 0,
		'catemoreico' => "",
		'mmsg' => 1,
		'm_join' => "",
		'm_cancle' => "",
		'm_hexiao' => "",
		'm_review' => "",
		'm_cash' => "",
		'm_status' => "",
		'm_mcert' => "",
		'm_refund' => "",
		'smsswitch' => 0,
		'sms_type' => 1,
		'sms_appkey' => "",
		'sms_appsecret' => "",
		'sms_signname' => "",
		'sms_code' => "",
		'sms_notify' => "",
		'sms_group' => "",
		'wechatstatus' => 2,
		'creditpay' => 0,
		'deliverystatus' => 1,
		'task' => ['user' => "", '0'=>'', '1'=>''],
		'cancle_time' => "",
		'cash_time' => "",
		'onlyonce' => 0,
		'joinmsg' => 0,
		'image' => ['ratio' => "1/1", 'pxsize' => ""],
		'output' => ['pagesize' => ""],
		'location' => 0,
		'citys' => 0,
		'countrie' => 1,
		'distance' => 0,
		'merch' => 0,
		'bond' => 1,
		'certswitch' => 1,
		'percent' => "",
		'merch_amount' => "",
		'merch_maximum' => "",
		'merch_thumb' => "",
		'merch_logo' => "",
		'agreement' =>['0' => 1],
		'proagreement' => "",
		'share' => ['title' => "", 'pic' => "", 'desc' => ""],
		'guanzhu_join' => 1,
		'guanzhu' => 2,
		'followed_image' => "",
		'joinagreement' => "",
		'buytitle' => "",
		'countdown' => 1,
		'search' => 1,
		'probtn' => 1,
		'nav_home' => 1,
		'homeswitch' => 1,
		'merch_loginbg' => "",
		'stock_lock' => 1
	];
	
	$settings = empty($settings) || !is_array($settings) ? $initData : $settings;
	$config = $settings;
	$module = $_GPC['module'];
	load()->func('file');
	foreach ($module as $k => $value) {		
		switch($k){
			case 'percent':
				$config[$k] = $value >= 0.6 ? $value : '';
				break;
			case 'merch_amount':
				$config[$k] = $value >= 1 ? $value : '';
				break;
			case 'joinagreement':
				$config[$k] = html_format($value);
				break;
			case 'proagreement':
				$config[$k] = html_format($value);
				break;
			default:
				$config[$k] = $value;
				break;
		}
	}
	$bytes = strlen(serialize($config))-65000;
	if ($bytes > 0){
		web_json('协议内容已超出存储范围：约超' . round($bytes/3) . '个汉字',0);
	}else{
		$site = WeUtility::createModuleSite(IN_MODULE);
		$site->saveSettings($config);
		
		$data = array('uniacid' => $_W['uniacid'], 'rolename' => trim($merch['name']), 'status' => intval($_GPC['status']), 'perms' => is_array($_GPC['perms']) ? implode(',', $_GPC['perms']) : '');
		if (!empty($item)) {
			pdo_update('fx_merch_perm_role', $data, array('uniacid' => $_W['uniacid']));
		}
		else {
			pdo_insert('fx_merch_perm_role', $data);
			$id = pdo_insertid();
		}

		web_json(array('message'=>'操作成功', 'url'=>referer() . '&tab=' . $tab));
	}
}
include fx_template();