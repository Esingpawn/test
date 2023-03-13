<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * url2qr.ctrl
 * 主办方二维码控制器
 */
global $_W, $_GPC; 
$id = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
$midkey = createRandomNumber(8);
$activity = model_activity::getSingleActivity($id, '*');
if ($_W['op'] == 'display') {
	if (empty($activity['midkey'])){
		pdo_update('fx_activity', array('midkey' => $midkey), array('id' => $id));
	}else{
		$midkey = 	$activity['midkey'];
	}
	$url =  app_url('member/signin/consumption', array('midkey' => $midkey, 'activityid' => $id));
	$qrcode[0]['name'] = "现场签到";
	$qrcode[0]['url'] = $url;
	$qrcode[0]['desc'] = "适用大型活动现场，报名用户自主签到";
	$qrcode[0]['qr'] = createQrcode::createverQrcode($url,$midkey,$id,"signin");
	include fx_template('activity/entry');
}
function down_qr() {
	$name = $_GPC['name'];
	$qr_pic = $_W['siteroot'] . "addons/wnfx_activity/data/qrcode/".$_W['uniacid']."/signin/ver_qrcode_".$activity['midkey']."_$id.png";
	header('cache-control:private');
	header('content-type:image/jpeg');
	header('content-disposition: attachment;filename="'.$name.'.jpg"');
	readfile($qr_pic);
	exit;
}