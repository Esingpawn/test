<?php
defined('IN_IA') or exit('Access Denied');
function main()
{
	global $_W, $_GPC;	
	include fx_template();
}

function add()
{
	post();
}

function edit()
{
	post();
}

function post()
{
	global $_W,$_GPC;
	$no_left = true;
	$mid = intval($_GPC['mid']);
	$operator_prems=array();
	$role_perms = array();
	$user_perms = array();
	$perms = perms::formatPerms();
	if (empty($mid)) {
		message('缺少商户 ID 参数！', '', 'error');
	}
	$merch = pdo_fetch('SELECT name FROM ' . tablename('fx_merchant') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $mid));
	$item = pdo_fetch('SELECT * FROM ' . tablename('fx_perm_role') . ' WHERE merchid =:merchid and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':merchid' => $mid));
	
	if ($_W['ispost']) {
		$data = array('uniacid' => $_W['uniacid'], 'merchid' => $mid, 'rolename' => trim($merch['name']), 'status' => intval($_GPC['status']), 'perms' => is_array($_GPC['perms']) ? implode(',', $_GPC['perms']) : '');
		if (!empty($item)) {
			pdo_update('fx_perm_role', $data, array('merchid' => $mid, 'uniacid' => $_W['uniacid']));
			//plog('perm.role.edit', '修改角色 ID: ' . $id);
		}
		else {
			pdo_insert('fx_perm_role', $data);
			$id = pdo_insertid();
		}
		web_json();
	}else{
		$rolename = $merch['name'];
		if (!empty($item)) {
			$user_perms = $role_perms = explode(',', $item['perms']);
		}
	}
	include fx_template();
}

function delete()
{
	global $_W;
	global $_GPC;
	$id = intval($_GPC['id']);

	if (empty($id)) {
		$id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
	}

	$items = pdo_fetchall('SELECT id,rolename FROM ' . tablename('fx_perm_role') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);

	foreach ($items as $item) {
		pdo_delete('fx_perm_role', array('id' => $item['id']));
		plog('perm.role.delete', '删除角色 ID: ' . $item['id'] . ' 角色名称: ' . $item['rolename'] . ' ');
	}

	web_json(1, array('url' => referer()));
}

function status()
{
	global $_W;
	global $_GPC;
	$id = intval($_GPC['id']);

	if (empty($id)) {
		$id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
	}

	$status = intval($_GPC['status']);
	$items = pdo_fetchall('SELECT id,rolename FROM ' . tablename('fx_perm_role') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);

	foreach ($items as $item) {
		pdo_update('fx_perm_role', array('status' => $status), array('id' => $item['id']));
		plog('perm.role.edit', '修改角色状态 ID: ' . $item['id'] . ' 角色名称: ' . $item['rolename'] . ' 状态: ' . ($status == 0 ? '禁用' : '启用'));
	}

	show_json(1, array('url' => referer()));
}

function query()
{
	global $_GPC;
	global $_W;
	$kwd = trim($_GPC['keyword']);
	$params = array();
	$params[':uniacid'] = $_W['uniacid'];
	$condition = ' and uniacid=:uniacid and deleted=0';

	if (!empty($kwd)) {
		$condition .= ' AND `rolename` LIKE :keyword';
		$params[':keyword'] = '%' . $kwd . '%';
	}

	$ds = pdo_fetchall('SELECT id,rolename,perms2 FROM ' . tablename('fx_perm_role') . (' WHERE status=1 ' . $condition . ' order by id asc'), $params);
	include fx_template();
	exit();
}