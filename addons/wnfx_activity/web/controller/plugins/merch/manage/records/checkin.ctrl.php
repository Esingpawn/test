<?php
defined('IN_IA') or exit('Access Denied');
function main() {
	global $_W, $_GPC;
	$uniacid = $_W['uniacid'];
    $aid = intval($_GPC['aid'])?intval($_GPC['aid']):0;
	if ($aid){
		$activity = pdo_get('fx_activity', array('id' => $aid));
		$condition .= "uniacid = $uniacid AND activityid = $aid";
		$totals = array();
		$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition");
		$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND review = 1 AND status IN (1,2)");
		$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 3");
		$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 0");	
		$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 5");
		$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 6");
		$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 7");
		$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND review <> 1 AND status IN (1,2)");
		
		$midkey = createRandomNumber(8);
		if (empty($activity['midkey'])){
			pdo_update('fx_activity', array('midkey' => $midkey), array('id' => $aid));
		}else{
			$midkey = 	$activity['midkey'];
		}
		$url =  app_url('member/signin/consumption', array('midkey' => $midkey, 'activityid' => $aid));
		$qrcode[0]['name'] = "现场签到";
		$qrcode[0]['url'] = $url;
		$qrcode[0]['desc'] = "适用大型活动现场，报名用户自主签到";
		$qrcode[0]['qr'] = createQrcode::createverQrcode($url,$midkey,$aid,"signin");
		include fx_template();
	}else{
		message ('入口参数错误！', '', 'error');
	}
}

function down() {
	global $_W, $_GPC;
	$filename = $_GPC['name'];
    $aid = intval($_GPC['id'])?intval($_GPC['id']):0;
	$activity = pdo_get('fx_activity', array('id' => $aid));
	$qr_pic = IA_ROOT . "/addons/wnfx_activity/data/qrcode/".$_W['uniacid']."/signin/ver_qrcode_".$activity['midkey']."_$aid.png";
	if ($_W['account']->typeSign == 'wxapp'){
		$qr_pic = IA_ROOT . "/addons/wnfx_activity/data/qrcode/".$_W['uniacid']."/signin/ver_qrcode_".$activity['midkey']."_$aid.jpg";
	}
	header('cache-control:private');
	header('content-type:image/jpeg');
	header('content-disposition: attachment;filename="'.$filename.'.jpg"');
	readfile($qr_pic);
}