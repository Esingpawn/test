<?php 
defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '系统设置';

function main(){
	global $_W,$_GPC;
	if ($_W['routes']=='sysset'){
		$item = pdo_fetch('SELECT * FROM ' . tablename('fx_perm_user') . ' WHERE uid =:uid and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':uid' => $_W['uid']));
		$arr = explode(',', $item['perms2']);
		$offset = array_search('sysset', $arr);
		if ($offset !== false && $_W['role']=='operator'){			
			$r = str_replace('//', '/', $arr[$offset+1]);
			$r = str_replace('follow','share',$r);
			header('location: ' . web_url($r));
		}else{	
			header('location: ' . web_url('sysset/sys'));
		}
	}
}

function qrupdate(){
	global $_W,$_GPC;
	$filepath[] = IA_ROOT.'/addons/wnfx_activity/data/qrcode/'.$_W['uniacid'];
	load()->func('file');
	foreach ($filepath as $v) {
		if(file_exists($v)) rmdirs($v);
	}
	web_json();
}

function tpl(){
	global $_W,$_GPC;
	if ($_W['ispost']) {
		$data = is_array($_GPC['data']) ? $_GPC['data'] : array();
		m('common')->updateSysset(array('template' => $data));
		$shop = m('common')->getSysset('shop');
		$shop['style'] = $data['style'];
		m('common')->updateSysset(array('shop' => $shop));
		m('cache')->set('template_shop', $data['style']);
		web_json();
	}

	$styles = array();
	$dir = IA_ROOT . '/addons/wnfx_activity/template/mobile/';

	if ($handle = opendir($dir)) {
		while (($file = readdir($handle)) !== false) {
			if ($file != '..' && $file != '.') {
				if (is_dir($dir . '/' . $file)) {
					$styles[] = $file;
				}
			}
		}

		closedir($handle);
	}

	$data = m('common')->getSysset('template', false);
	include fx_template();
}

function edit(){
	global $_W,$_GPC;	
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
	
	$settings = empty($_W['_config']) || !is_array($_W['_config']) ? $initData : $_W['_config'];
	
	if ($_W['ispost']) {
		$config = $settings;
		$module = $_GPC['module'];
		if ($_W['action']=='sysset.shop'){
			$module['openids'] = $_GPC['openids'];
		}
		if ($_W['routes']=='sysset.share'){
			$data = is_array($_GPC['data']) ? $_GPC['data'] : array();
			m('common')->updateSysset(array('workwe' => $data['workwe']));
			m('cache')->set('workwe', $data['workwe']);
		}
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
			web_json();
		}
	}else{
		if (is_array($settings['openids'])){
			foreach($settings['openids'] as $key=>$openid){
				$members[] = m('member')->getMember($openid);
			}
		}else{
			$members=array();
		}
		if ($_W['routes']!='sysset'){
			if ($_W['routes']=='sysset.sys'){
				include fx_template('sysset/index');
			}else{			
				if ($_W['routes']=='sysset.share') $data = m('common')->getSysset('workwe', false);
				include fx_template();
			}
		}
	}
}

switch($_W['routes']){
	case 'sysset.tpl':
	case 'sysset.qrupdate':
		break;
	default:
		edit();
		break;
}