<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
global $_W,$_GPC;
$do = $_GPC['do'];
load()->func('file');
load()->model('material');
load()->model('attachment');
load()->model('module');
if (empty($_W['setting']['remote'])){
	$remote =uni_setting($_W['uniacid'],array('remote_complete_info','remote'));
	$_W['setting']['remote'] = $remote['remote'];
}

$_W['setting']['remote'] = !empty($_W['account']['setting']['remote']) ? $_W['account']['setting']['remote'] : $_W['setting']['remote'];

if (!empty($_W['setting']['remote']['type'])) {
	if ($_W['setting']['remote']['type'] == ATTACH_FTP) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['ftp']['url'] . '/';
	} elseif ($_W['setting']['remote']['type'] == ATTACH_OSS) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['alioss']['url'].'/';
	} elseif ($_W['setting']['remote']['type'] == ATTACH_QINIU) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['qiniu']['url'].'/';
	} elseif ($_W['setting']['remote']['type'] == ATTACH_COS) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['cos']['url'].'/';
	}
}
if (!in_array($do, array('upload', 'fetch', 'browser', 'delete', 'image', 'module', 'video', 'voice', 'news', 'keyword', 'networktowechat', 'networktolocal', 'towechat', 
	'tolocal', 'wechat_upload', 'group_list', 'add_group', 'change_group', 'del_group', 'move_to_group', 'change_name'))) {
	exit('Access Denied');
}
$result = array(
	'error' => 1,
	'message' => '',
	'data' => ''
);

error_reporting(0);
$type = $_GPC['upload_type'];
$type = in_array($type, array('image', 'audio', 'video')) ? $type : 'image';
$option = array();
$option = array_elements(array('uploadtype', 'global', 'dest_dir'), $_POST);
$option['width'] = intval($option['width']);
$option['global'] = !empty($_COOKIE['__fileupload_global']);
if (!empty($option['global']) && empty($_W['isfounder'])) {
	$result['message'] = '没有向 global 文件夹上传文件的权限.';
	iajax(-1, $result['message']);
}

$dest_dir = $_COOKIE['__fileupload_dest_dir'];
if (preg_match('/^[a-zA-Z0-9_\/]{0,50}$/', $dest_dir, $out)) {
	$dest_dir = trim($dest_dir, '/');
	$pieces = explode('/', $dest_dir);
	if(count($pieces) > 3){
		$dest_dir = '';
	}
} else {
	$dest_dir = '';
}

$setting = $_W['setting']['upload'][$type];
$uniacid = intval($_W['uniacid']);

if (!empty($option['global'])) {
	$setting['folder'] = "{$type}s/global/";
	if (!empty($dest_dir)) {
		$setting['folder'] .= '/'.$dest_dir.'/';
	}
} else {
	$setting['folder'] = "{$type}s/{$uniacid}";
	if(empty($dest_dir)){
		$setting['folder'] .= '/'.date('Y/m/');
	} else {
		$setting['folder'] .= '/'.$dest_dir.'/';
	}
}


if ('fetch' == $do) {
	$url = trim($_GPC['url']);
	load()->func('communication');
	$resp = ihttp_get($url);
	if (is_error($resp)) {
		$result['message'] = '提取文件失败, 错误信息: '.$resp['message'];
		iajax(-1, $result['message']);
	}
	if (intval($resp['code']) != 200) {
		$result['message'] = '提取文件失败: 未找到该资源文件.';
		iajax(-1, $result['message']);
	}
	$ext = '';
	if ($type == 'image') {
		switch ($resp['headers']['Content-Type']){
			case 'application/x-jpg':
			case 'image/jpeg':
				$ext = 'jpg';
				break;
			case 'image/png':
				$ext = 'png';
				break;
			case 'image/gif':
				$ext = 'gif';
				break;
			default:
				$result['message'] = '提取资源失败, 资源文件类型错误.';
				iajax(-1, $result['message']);
				break;
		}
	} else {
		$result['message'] = '提取资源失败, 仅支持图片提取.';
		iajax(-1, $result['message']);
	}
	
	if (intval($resp['headers']['Content-Length']) > $setting['limit'] * 1024) {
		$result['message'] = '上传的媒体文件过大('.sizecount($size).' > '.sizecount($setting['limit'] * 1024);
		iajax(-1, $result['message']);
	}
	$originname = pathinfo($url, PATHINFO_BASENAME);
	$filename = file_random_name(ATTACHMENT_ROOT .'/'. $setting['folder'], $ext);
	$pathname = $setting['folder'] . $filename;
	$fullname = ATTACHMENT_ROOT . '/' . $pathname;
	if (file_put_contents($fullname, $resp['content']) == false) {
		$result['message'] = '提取失败.';
		iajax(-1, $result['message']);
	}
}


if ('upload' == $do) {
	$fileData = getFile();
	if (empty($fileData['name'])) {
		$result['message'] = '上传失败, 请选择要上传的文件！';
		iajax(-1, $result['message']);
	}
	if ($fileData['error'] != 0) {
		$result['message'] = '上传失败, 请重试.';
		iajax(-1, $result['message']);
	}
	$ext = pathinfo($fileData['name'], PATHINFO_EXTENSION);
	$ext = strtolower($ext);
	$size = intval($fileData['size']);
	$originname = $fileData['name'];
	$filename = file_random_name(ATTACHMENT_ROOT .'/'. $setting['folder'], $ext);
	$file = file_upload($fileData, $type, $setting['folder'] . $filename);
	if (is_error($file)) {
		$result['message'] = $file['message'];
		iajax(-1, $result['message']);
	}
	$pathname = $file['path'];
	$fullname = ATTACHMENT_ROOT . '/' . $pathname;
}

if ('fetch' == $do || 'upload' == $do) {
	if($type == 'image'){
		$thumb = empty($setting['thumb']) ? 0 : 1; 		$width = intval($setting['width']); 
		if(isset($option['thumb'])){
			$thumb = empty($option['thumb']) ? 0 : 1;
		}
		if (isset($option['width']) && !empty($option['width'])) {
			$width = intval($option['width']);
		}
		if ($thumb == 1 && $width > 0) {
			$thumbnail = file_image_thumb($fullname, '', $width);
			@unlink($fullname);
			if (is_error($thumbnail)) {
				$result['message'] = $thumbnail['message'];
				iajax(-1, $result['message']);
			} else {
				$filename = pathinfo($thumbnail, PATHINFO_BASENAME);
				$pathname = $thumbnail;
				$fullname = ATTACHMENT_ROOT .'/'.$pathname;
			}
		}
	}
	$group_id = safe_gpc_int($_GPC['group_id']);
	$info = array(
		'name' => $originname,
		'ext' => $ext,
		'filename' => $pathname,
		'attachment' => $pathname,
		'url' => tomedia($pathname),
		'is_image' => $type == 'image' ? 1 : 0,
		'filesize' => filesize($fullname),
		'group_id' => $group_id,
	);
	if ($type == 'image') {
		$size = getimagesize($fullname);
		$info['width'] = $size[0];
		$info['height'] = $size[1];
	} else {
		$size = filesize($fullname);
		$info['size'] = sizecount($size);
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
			$result['message'] = '远程附件上传失败，请检查配置并重新上传';
			file_delete($pathname);
			iajax(-1, $result['message']);
		} else {
			file_delete($pathname);
			$info['url'] = tomedia($pathname);
		}
	}
	pdo_insert('core_attachment', array(
		'uniacid' => $uniacid,
		'uid' => 0,
		'filename' => $originname,
		'attachment' => $pathname,
		'type' => 'image' == $type ? 1 : ('audio' == $type || 'voice' == $type ? 2 : 3),
		'createtime' => TIMESTAMP,
		'group_id' => intval($_GPC['group_id']),
		'merch_id' => $_W['uid']
	));
	if ($_W['isw7_request']) {
		iajax(0, '上传成功！');
	}
	$info['state'] = 'SUCCESS';
	die(json_encode($info));
}

if ($do == 'change_name') {
	if (empty($_W['isfounder']) && ACCOUNT_MANAGE_NAME_MANAGER != $_W['role'] && ACCOUNT_MANAGE_NAME_OWNER != $_W['role']) {
		//iajax(1, '您没有权限修改文件');
	}
	$id = intval($_GPC['id']);
	$core_attachment_table = table('core_attachment');
	$condition = array('id' => $id, 'type' => ATTACH_TYPE_IMAGE);
	if (empty($uniacid)) {
		$condition['uid'] = $_W['uid'];
	} else {
		$condition['uniacid'] = $uniacid;
	}
	$new_filename = safe_gpc_string($_GPC['new_filename']);
	$data = array('filename' => $new_filename);
	$result = $core_attachment_table->where($condition)->fill($data)->save();
	if ($result) {
		iajax(0, '修改成功！');
	} else {
		iajax(-1, '修改失败!');
	}
}
if ($do == 'networktolocal') {
	$url = $_GPC['url'];
	$type = $_GPC['type'];

	if (!in_array($type, array('image', 'video'))) {
		$type = 'image';
	}	
	$path = file_remote_attach_fetch($url);
	
	if(is_error($path)) {
		iajax(1, $path['message']);
	}
	$filename = pathinfo($path,PATHINFO_FILENAME);
	$data = array('uniacid' => $uniacid, 'uid' => 0,
		'filename' => $filename,
		'attachment' => $path,
		'type' => $type == 'image' ? ATTACH_TYPE_IMAGE : ($type == 'audio'||$type == 'voice' ? ATTACH_TYPE_VOICE : ATTACH_TYPE_VEDIO),
		'createtime'=>TIMESTAMP,
		'group_id' => intval($_GPC['group_id']),
		'merch_id'=>$_W['uid']
	);
	pdo_insert('core_attachment', $data);
	$id = pdo_insertid();
	$data['id'] = $id;
	$data['url'] = tomedia($path);
	
	if (is_error($data)) {
		iajax(1, $data['message']);
		return;
	}

	iajax(0, $data);

}

if ($do == 'delete') {
	$id = $_GPC['id'];
	if (!is_array($id)) {
		$id = array(intval($id));
	}
	$id = safe_gpc_array($id);
	$media = pdo_get('core_attachment', array('uniacid' => $_W['uniacid'], 'id' => $id));
	if(empty($media)) {
		iajax(1, $_GPC['id'].'文件不存在或已经删除');
	}
	if(empty($_W['isfounder']) && $_W['role'] != 'manager') {
		//iajax(1, '您没有权限删除该文件');
	}
	load()->func('file');
	setting_load('remote');
	$uni_remote_setting = uni_setting_load('remote');
	if (!empty($uni_remote_setting['remote']['type'])) {
		$_W['setting']['remote'] = $uni_remote_setting['remote'];
	}
	if (!empty($_W['setting']['remote']['type'])) {
		$status = file_remote_delete($media['attachment']);
	} else {
		$status = file_delete($media['attachment']);
	}
	if(is_error($status)) {
		exit($status['message']);
	}
	pdo_delete('core_attachment', array('uniacid' => $uniacid, 'id' => $id));
	iajax(0, '删除成功');
}

$type = $_GPC['type'];
$resourceid = intval($_GPC['resource_id']);
$uid = intval($_W['uid']);
$acid = intval($_W['acid']);
$url = $_GPC['url'];
$isnetwork_convert = !empty($url);
$islocal = 'local' == $_GPC['local'];

$is_local_image = ($islocal ? true : false);

if ('add_group' == $do) {
	$table = table('core_attachment_group');
	$fields = array(
		'uid' => 0,
		'uniacid' => $uniacid,
		'name' => safe_gpc_string($_GPC['name']),
		'type' => $is_local_image ? 0 : 1,
	);
	if (!empty($_GPC['pid'])) {
		$fields['pid'] = safe_gpc_int($_GPC['pid']);
	}
	$table->fill($fields);
	$result = $table->save();
	$id = pdo_insertid();
	
	$fields = array(
		'uniacid' => $uniacid,
		'group_id' => $id,
		'merch_id' => $_W['uid']
	);
	pdo_insert('fx_attachment_group', $fields);
	
	if (is_error($result)) {
		iajax($result['errno'], $result['message']);
	}
	iajax(0, array('id' => pdo_insertid()));
}

if ('change_group' == $do) {
	$table = table('core_attachment_group');
	$type = $is_local_image ? 0 : 1;
	$name = safe_gpc_string($_GPC['name']);
	$id = intval($_GPC['id']);
	$table->searchWithUniacidOrUid($uniacid, $_W['uid']);
	$updated = $table->where('type', $type)
		->fill('name', $name)
		->where('id', $id)->save();
	iajax($updated ? 0 : 1, $updated ? '更新成功' : '更新失败');
}

if ('del_group' == $do) {
	$id = intval($_GPC['group_id']);
	$deleted = pdo_delete('fx_attachment_group', array('uniacid' => $uniacid, 'group_id' => $id, 'merch_id'=>$_W['uid']));
	if ($deleted)
	$deleted = pdo_delete('attachment_group', array('uniacid' => $uniacid, 'id' => $id));	 
	iajax($deleted ? 0 : 1, $deleted ? '删除成功' : '删除失败');
}

if ('move_to_group' == $do) {
	$group_id = intval($_GPC['group_id']);
	$ids = safe_gpc_array($_GPC['id']);

	if ($is_local_image) {
		$table = table('core_attachment');
	} else {
		$table = table('wechat_attachment');
	}
	$updated = $table->where('id', $ids)->where('uniacid', $uniacid)->fill('group_id', $group_id)->save();

	iajax($updated ? 0 : -1, $updated ? '更新成功' : '更新失败');
}

$attachment_by_uid = STATUS_OFF;
if (!empty($_W['setting']['upload']['attachment_by_uid']) && !empty($uniacid) && in_array($_W['role'], array(ACCOUNT_MANAGE_NAME_CLERK, ACCOUNT_MANAGE_NAME_OPERATOR, ACCOUNT_MANAGE_NAME_MANAGER))) {
	$attachment_by_uid = STATUS_ON;
}

if ('image' == $do || 'video' == $do || 'voice' == $do) {
	$types = array('image', 'voice', 'video');
	$type = in_array($do, $types) ? $do : 'image';
	$typeindex = array('image' => 1, 'voice' => 2, 'video' => 3);
	$condition = ' WHERE uniacid = :uniacid AND type = :type AND merch_id = :merch_id';
	$params = array(':uniacid' => $_W['uniacid'], ':type' => $typeindex[$type], ':merch_id'=>$_W['uid']);
	$year = intval($_GPC['year']);
	$month = intval($_GPC['month']);
	$search = addslashes($_GPC['keyword']);
	$groupid = safe_gpc_int($_GPC['group_id']);
	$order = safe_gpc_string($_GPC['order']);

	if(!empty($search)) {
		$condition .= ' AND `filename` LIKE :filename';
		$params[':filename'] = "%{$search}%";
	}
	
	if($year > 0 || $month > 0) {
		if($month > 0 && !$year) {
			$year = date('Y');
			$starttime = strtotime("{$year}-{$month}-01");
			$endtime = strtotime("+1 month", $starttime);
		} elseif($year > 0 && !$month) {
			$starttime = strtotime("{$year}-01-01");
			$endtime = strtotime("+1 year", $starttime);
		} elseif($year > 0 && $month > 0) {
			$starttime = strtotime("{$year}-{$month}-01");
			$endtime = strtotime("+1 month", $starttime);
		}
		$condition .= ' AND createtime >= :starttime AND createtime <= :endtime';
		$params[':starttime'] = $starttime;
		$params[':endtime'] = $endtime;
	}
	
	if ($groupid > 0){
		$condition .= ' AND group_id = :groupid';
		$params[':groupid'] = $groupid;
	}
	
	if ($groupid == 0) {
		$condition .= ' AND group_id <= :groupid';
		$params[':groupid'] = 0;
	}
	
	if (!empty($order)) {
		if (in_array($order, array('asc', 'desc'))) {
			$orderby = 'id ' . $order;
		}
		if (in_array($order, array('filename_asc', 'filename_desc'))) {
			$order = $order == 'filename_asc' ? 'asc' : 'desc';
			$orderby = "filename $order";
		}
	}else{
		$orderby = "id desc";
	}
		
	$page = intval($_GPC['page']);
	$page = max(1, $page);
	$page_size = $_GPC['pagesize'] ? intval($_GPC['pagesize']) : 18;

	$sql = 'SELECT * FROM '.tablename('core_attachment')." {$condition} ORDER BY $orderby LIMIT ".(($page-1)*$page_size).','.$page_size;
	$list = pdo_fetchall($sql, $params);

	foreach ($list as &$item) {
		if (!empty($_W['setting']['remote']['type'])) {
			$item['attach'] = tomedia($item['attachment']);
		} else {
			$item['attach'] = tomedia($item['attachment'], true);
		}
		$item['url'] = $item['attach'];
		unset($item['uid']);
	}
	$total = pdo_fetchcolumn('SELECT count(*) FROM '.tablename('core_attachment') ." {$condition}", $params);
	$pager = pagination($total, $page, $page_size,'',$context = array('before' => 5, 'after' => 4, 'isajax' => $_W['isajax']));
	$result = array('items' => $list, 'list' => $list, 'total' => $total, 'page' => $page, 'page_size' => $page_size, 'pager' => $pager,'ss'=>$order);
	iajax(0, $result);
}

if ('group_list' == $do) {
	$condition = ' AND gp.uniacid = :uniacid AND type = :type AND f.merch_id = :merch_id';
	$join = ' join ' . tablename('fx_attachment_group') . ' f on f.group_id=gp.id';
	$params = array(':uniacid' => $uniacid, ':type' => $is_local_image ? 0 : 1, ':merch_id'=>$_W['uid']);
	$sql = 'SELECT gp.*,f.merch_id FROM '.tablename('attachment_group')." gp " . $join. " WHERE 1 {$condition} ORDER BY id asc";
	$list = pdo_fetchall($sql, $params);
	iajax(0, $list);
}