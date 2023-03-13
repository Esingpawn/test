<?php 
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
global $_W,$_GPC;
$_W['op'] = !empty($_W['op']) ? $_W['op'] : 'upload';
if($_W['op'] == 'upload'){
	load()->func('file');
	$type = in_array($_GPC['type'], array('image', 'thumb', 'voice', 'video', 'audio')) ? $_GPC['type'] : 'image';
	$harmtype = array('asp', 'php', 'jsp', 'js', 'css', 'php3', 'php4', 'php5', 'ashx', 'aspx', 'exe', 'cgi');
	
	$fdata = getFile();	
	$ext = pathinfo($fdata['type'], PATHINFO_BASENAME);
	//$ext = pathinfo($fdata['name'], PATHINFO_EXTENSION);
	$ext = strtolower($ext);
	
	$setting = $_W['setting'];
	switch ($type) {
		case 'image':
		case 'thumb':
			$allowExt = array('gif', 'jpg', 'jpeg', 'bmp', 'png', 'ico');
			$limit = $setting['upload']['image']['limit'];
			break;
		case 'voice':
		case 'audio':
			$allowExt = array('mp3', 'wma', 'wav', 'amr');
			$limit = $setting['upload']['audio']['limit'];
			break;
		case 'video':
			$allowExt = array('rm', 'rmvb', 'wmv', 'avi', 'mpg', 'mpeg', 'mp4');
			$limit = $setting['upload']['audio']['limit'];
			break;
	}
	
	$type_setting = in_array($type, array('image', 'thumb')) ? 'image' : 'audio';
	$setting = $_W['setting']['upload'][$type_setting];
	
	if (!empty($setting['extentions'])) {
		$allowExt = $setting['extentions'];
	}
	if (!in_array(strtolower($ext), $allowExt) || in_array(strtolower($ext), $harmtype)) {
		$result['error']['code'] = 1;
		$result['error']['message'] = '不允许上传' . $ext . '文件';
		die(json_encode($result));
	}
	if (!empty($limit) && $limit * 1024 < filesize($fdata['tmp_name'])) {
		$result['error']['code'] = 1;
		$result['error']['message'] = "上传的文件超过大小限制，请上传小于 {$limit}k 的文件";
		die(json_encode($result));
	}
	
	//$size = intval($fdata['size']);
	$ext = pathinfo($_GPC['name'], PATHINFO_EXTENSION);
	$ext = strtolower($ext);
	$uniacid = intval($_W['uniacid']);
	$setting['folder'] = "{$type}s/{$uniacid}";
	$setting['folder'] .= '/' . date('Y/m/');
	mkdirs(ATTACHMENT_ROOT . $setting['folder']);//创建目录
	$filename = file_random_name(ATTACHMENT_ROOT . $setting['folder'], $ext);
	$pathname = $setting['folder'] . $filename;
	$fullname = ATTACHMENT_ROOT . $pathname;
	
	if($type == 'image'){
		$result = array(
			'jsonrpc' => '2.0',
			'id' => 'id',
			'error' => array('code' => 0, 'message'=>''),
		);
		if (!file_is_image($fdata['tmp_name'])) {
			$result['error']['code'] = 1;
		}
		if ($fdata['error'] != 0) {
			$result['error']['code'] = 1;
			$result['error']['message'] = '非法文件，请重试！';
			die(json_encode($result));
		}
		
		if (pathinfo($fdata['type'],PATHINFO_DIRNAME)=='image'){
			//验证通过，上传Blob类型图片
			if (file_put_contents($fullname, file_get_contents($fdata['tmp_name']))){
				$info = array(
					'name' => $_GPC['name'],
					'filename' => $filename,
					'attachment' => $pathname,
					'url' => tomedia($pathname),
					'is_image' => 1,
					'filesize' => filesize($fullname),
				);
			}
		}else{
			$result['error']['code'] = 1;
			$result['error']['message'] = '不允许上传此类文件';
			die(json_encode($result));
		}
	}else{
		$file = file_upload($fdata, $type, $setting['folder'] . $filename, true);
		if (is_error($file)) {
			$result['error']['code'] = 1;
			$result['error']['message'] = $file['message'];
			die(json_encode($result));
		}else{
			$info = array(
				'name' => $_GPC['name'],
				'filename' => $filename,
				'attachment' => $pathname,
				'url' => tomedia($pathname),
				'is_image' => 1,
				'filesize' => filesize($fullname),
			);
		}
	}
	
	setting_load('remote');
	$uni_remote_setting = uni_setting_load('remote');
	if ($uniacid != 0 && !empty($uni_remote_setting['remote']['type'])) {
		$_W['setting']['remote'] = $uni_remote_setting['remote'];
	}
	if ($uniacid == 0) {
		$_W['setting']['remote'] = $_W['setting']['remote_complete_info'];
	}
	if (!empty($_W['setting']['remote']['type'])) {
		error_reporting(0);
		$remotestatus = file_remote_upload($pathname);
		if (is_error($remotestatus)) {
			$result['error']['code'] = 1;
			$result['message'] = '远程附件上传失败，请检查配置并重新上传';
			file_delete($pathname);
			die(json_encode($result));
		} else {
			file_delete($pathname);
			$info['url'] = tomedia($pathname);
		}
	}
	pdo_insert('core_attachment', array(
		'uniacid' => $uniacid,
		'uid' => $_W['member']['uid'] ? $_W['member']['uid'] : $_W['uid'],
		'filename' => $_GPC['name'],
		'attachment' => $pathname,
		'type' =>  'image' == $type ? 1 : ('audio' == $type || 'voice' == $type ? 2 : 3),
		'createtime' => TIMESTAMP,
		'group_id' => -1,
		'merch_id'=> MERCHANTID
	));
	$info['id'] = pdo_insertid();
	$info['token'] = $_W['token'];
	$info['error']['code'] = 0;
	die(json_encode($info));
}

if($_W['op'] == 'update'){
	$uniacid = intval($_W['uniacid']);
	$id = intval($_GPC['id']);
	pdo_update('core_attachment', array('uniacid' => $uniacid, 'uid' => $_W['member']['uid']), array('id' => $id));
}

if($_W['op'] == 'delete' && $_W['isajax']){
	$result = array('error' => 1, 'message' => '');
	$id = intval($_GPC['id']);
	if (!empty($id)) {
		$attachment = pdo_get('core_attachment', array('id' => $id), array('attachment', 'uniacid', 'uid'));
		if (!empty($attachment)) {
			if ($attachment['uniacid'] != $_W['uniacid'] || empty($_W['openid']) || (!empty($_W['fans']) && $attachment['uid'] != $_W['fans']['from_user']) || (!empty($_W['member']) && $attachment['uid'] != $_W['member']['uid'])) {
				//return message(error(1, '无权删除！'), '', 'ajax');
			}
			load()->func('file');
			setting_load('remote');
			$uni_remote_setting = uni_setting_load('remote');
			if (!empty($uni_remote_setting['remote']['type'])) {
				$_W['setting']['remote'] = $uni_remote_setting['remote'];
			}
			if ($_W['setting']['remote']['type']) {
				$result['error'] = file_remote_delete($attachment['attachment']);
			} else {
				$result['error'] = file_delete($attachment['attachment']);
			}
			if (!is_error($result['error'])) {
				pdo_delete('core_attachment', array('id' => $id));
			}
			if (!is_error($result)) {
				$result['error'] = 0;
				$result['message'] = '删除成功';
			} else {
				$result['error'] = 0;
				$result['message'] = '删除失败';
			}
		} else {
			$result['error']   = 0;
			$result['message'] = '不存在或已删除';
		}
	} else {
		$result['error']   = 0;
		$result['message'] = '不存在或已删除';
	}
	die(json_encode($result));
}