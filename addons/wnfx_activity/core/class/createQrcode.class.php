<?php
class createQrcode {
	static function creategroupQrcode($mid = 0, $pid = 0, $folder = '') {
		global $_W, $_GPC;
		$path = IA_ROOT . "/addons/". IN_MODULE ."/data/qrcode/" . $_W['uniacid'] . "/";
		if (!empty($folder)) {
			$path .= $folder . "/";
			$folder = $folder . "/";
		}
		if (!is_dir($path)) {
			load() -> func('file');
			mkdirs($path);
		}
		$url = app_url('records/check', array('orderid' => $pid, 'from'=>'qrcode'));
		$file = $mid . '_' . $pid . '.png';
		$qrcode_file = $path . $file;
		if (!is_file($qrcode_file)) {
			require_once IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
			QRcode :: png($url, $qrcode_file, QR_ECLEVEL_L, 10, 1);
		} 
		return $_W['siteroot'] . 'addons/'. IN_MODULE .'/data/qrcode/' . $_W['uniacid'] . '/' . $folder . $file;
	
	}
	
	static public function createverQrcode($url, $mid = 0 , $pid = 0, $folder = '', $root = 0) {
		global $_W, $_GPC;
		$path = IA_ROOT . "/addons/". IN_MODULE ."/data/qrcode/" . $_W['uniacid'] . "/";
		if (!empty($folder)) {
			$path .= $folder . "/";
			$folder = $folder . "/";
		} 
		if (!is_dir($path)) {
			load() -> func('file');
			mkdirs($path);
		} 
		$file = 'ver_qrcode_' . $mid . '_' . $pid . '.png';
		if ($_W['account']->typeSign == 'wxapp' || $_GPC['from']=='wxapp'){
			$file = 'ver_qrcode_' . $mid . '_' . $pid . '_wxapp.png';
		}
		$qrcode_file = $path . $file;		
		if (!is_file($qrcode_file)) {
			if ($_W['account']->typeSign == 'wxapp' || $_GPC['from']=='wxapp'){
				$link_uniacid = igetcookie('link_uniacid') ? igetcookie('link_uniacid') : $_W['uniacid'];
				$webview = $url;
				if (strpos($url,'r=activity.detail') !== false) 
					$webview = IN_MODULE.'/pages/goods/detail?id='.$pid;
				if (strpos($url,'r=member.signin.consumption') !== false) 
					$webview = IN_MODULE.'/pages/webview/index?r=member.signin.consumption&id='.$pid;
				if (strpos($url,'r=records.check') !== false) 
					$webview = IN_MODULE.'/pages/webview/index?r=records.check&id='.$pid;
				$url = $_W['siteroot'].'app/index.php?i='.$link_uniacid.'&c=entry&a=wxapp&m='.IN_MODULE.'&do=qrcode';
				ihttp_post($url, array(
				    'url' => urlencode($webview),
				    'qrcode_file' => $qrcode_file,
				));
				//getImage($wxappQrcode, $path, 'ver_qrcode_' . $mid . '_' . $pid, 1);
			}else{				
				require_once  IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
				QRcode :: png($url, $qrcode_file, QR_ECLEVEL_L, 10, 1);
			}
		} 
		$file_path = $_W['siteroot'] . 'addons/' . IN_MODULE .'/data/qrcode/' . $_W['uniacid'] . '/' . $folder . $file;
		if ($root) {
			$file_path = MODULE_ROOT . '/data/qrcode/' . $_W['uniacid'] . '/' . $folder . $file;
		}
		return $file_path;
	} 
} 