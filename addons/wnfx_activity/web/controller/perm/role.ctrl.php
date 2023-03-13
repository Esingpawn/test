<?php
defined('IN_IA') or exit('Access Denied');
function main()
{
	global $_W, $_GPC;
	if (!perm('perm.role')) {
		message('暂无此操作权限！', referer(), 'error');
	}
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$status = $_GPC['status'];
	$condition = ' and uniacid = :uniacid and merchid=0 and deleted=0';
	$params = array(':uniacid' => $_W['uniacid']);

	if (!empty($_GPC['keyword'])) {
		$_GPC['keyword'] = trim($_GPC['keyword']);
		$condition .= ' and rolename like :keyword';
		$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
	}

	if ($_GPC['status'] != '') {
		$condition .= ' and status=' . intval($_GPC['status']);
	}

	$list = pdo_fetchall('SELECT *  FROM ' . tablename('fx_perm_role') . (' WHERE 1 ' . $condition . ' ORDER BY id desc LIMIT ') . ($pindex - 1) * $psize . ',' . $psize, $params);

	foreach ($list as &$row) {
		$row['usercount'] = pdo_fetchcolumn('select count(*) from ' . tablename('fx_perm_user') . ' where roleid=:roleid limit 1', array(':roleid' => $row['id']));
	}

	unset($row);
	$total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('fx_perm_role') . ('  WHERE 1 ' . $condition . ' '), $params);
	$pager = pagination($total, $pindex, $psize);
	include fx_template();
}

function add() {
	post();
}

function edit() {
	post();
}

function post()
{
	global $_W, $_GPC;
	$id = intval($_GPC['id']);
	$accounts_plugin = explode(',', $accounts['plugins']);
	$accounts_com = explode(',', $accounts['coms']);
	$public_perm = array('shop', 'goods', 'sale', 'store', 'order', 'member', 'finance', 'statistics', 'sysset');
	$accounts_perms = array_merge($accounts_com, $accounts_plugin, $public_perm);
	$operator_prems = array();

	if ($_W['role'] == 'operator') {
		$operator = pdo_fetch('SELECT * FROM ' . tablename('fx_perm_user') . ' WHERE uid = :uid AND uniacid = :uniacid ', array(':uid' => $_W['user']['uid'], ':uniacid' => $_W['uniacid']));
		$operator_prems = explode(',', $operator['perms2']);
	}

	$perms = perms::formatPerms();
	$role_perms = array();
	$user_perms = array();
	$data_perms = '';
	$item = pdo_fetch('SELECT * FROM ' . tablename('fx_perm_role') . ' WHERE id =:id and merchid=0 and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));

	if (!empty($item)) {
		$data_perms = $item['perms2'];
		$role_perms = explode(',', $item['perms2']);
	}

	$user_perms = explode(',', $data_perms);

	if ($_W['ispost']) {
		$data = array('uniacid' => $_W['uniacid'], 'rolename' => trim($_GPC['rolename']), 'status' => intval($_GPC['status']), 'perms2' => is_array($_GPC['perms']) ? implode(',', $_GPC['perms']) : '');
		if (!empty($id)) {
			pdo_update('fx_perm_role', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
			//plog('perm.role.edit', '修改角色 ID: ' . $id);
		}
		else {
			pdo_insert('fx_perm_role', $data);
			$id = pdo_insertid();
			//plog('perm.role.add', '添加角色 ID: ' . $id . ' ');
		}

		web_json(array('url' => web_url('perm/role/edit', array('id' => $id))));
	}
	include fx_template();
}

function delete()
{
	global $_W, $_GPC;
	$id = intval($_GPC['id']);

	if (empty($id)) {
		$id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
	}
	$items = pdo_fetchall('SELECT id,rolename FROM ' . tablename('fx_perm_role') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);
	foreach ($items as $item) {
		pdo_delete('fx_perm_role', array('id' => $item['id']));
		//plog('perm.role.delete', '删除角色 ID: ' . $item['id'] . ' 角色名称: ' . $item['rolename'] . ' ');
	}
	web_json();
}

function status()
{
	global $_W, $_GPC;
	$id = intval($_GPC['id']);

	if (empty($id)) {
		$id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
	}

	$status = intval($_GPC['status']);
	$items = pdo_fetchall('SELECT id,rolename FROM ' . tablename('fx_perm_role') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);

	foreach ($items as $item) {
		pdo_update('fx_perm_role', array('status' => $status), array('id' => $item['id']));
		//plog('perm.role.edit', '修改角色状态 ID: ' . $item['id'] . ' 角色名称: ' . $item['rolename'] . ' 状态: ' . ($status == 0 ? '禁用' : '启用'));
	}
	web_json();
}

function query()
{
	global $_W, $_GPC;
	$kwd = trim($_GPC['keyword']);
	$params = array();
	$params[':uniacid'] = $_W['uniacid'];
	$condition = ' and uniacid=:uniacid and merchid=0 and deleted=0';

	if (!empty($kwd)) {
		$condition .= ' AND `rolename` LIKE :keyword';
		$params[':keyword'] = '%' . $kwd . '%';
	}

	$ds = pdo_fetchall('SELECT id,rolename,perms2 FROM ' . tablename('fx_perm_role') . (' WHERE status=1 ' . $condition . ' order by id asc'), $params);
	include fx_template();
}
?>
