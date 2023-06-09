<?php
defined('IN_IA') or exit('Access Denied');

function main()
{
	global $_W, $_GPC;
	if (!perm('perm.user')) {
		message('暂无此操作权限！', referer(), 'error');
	}
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$status = $_GPC['status'];
	$condition = ' and u.uniacid = :uniacid and u.deleted=0 and u.uid<>' . $_W['uid'];
	$params = array(':uniacid' => $_W['uniacid']);

	if (!empty($_GPC['keyword'])) {
		$_GPC['keyword'] = trim($_GPC['keyword']);
		$condition .= ' and ( u.realname like :keyword or u.username like :keyword or u.mobile like :keyword)';
		$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
	}

	if ($_GPC['roleid'] != '') {
		$condition .= ' and u.roleid=' . intval($_GPC['roleid']);
	}

	if ($_GPC['status'] != '') {
		$condition .= ' and u.status=' . intval($_GPC['status']);
	}

	$list = pdo_fetchall('SELECT u.*,r.rolename FROM ' . tablename('fx_perm_user') . ' u  ' . ' left join ' . tablename('fx_perm_role') . ' r on u.roleid =r.id  ' . (' WHERE 1 ' . $condition . ' ORDER BY id desc LIMIT ') . ($pindex - 1) * $psize . ',' . $psize, $params);
	$total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('fx_perm_user') . ' u  ' . ' left join ' . tablename('fx_perm_role') . ' r on u.roleid =r.id  ' . (' WHERE 1 ' . $condition . ' '), $params);
	$pager = pagination($total, $pindex, $psize);
	$roles = pdo_fetchall('select id,rolename from ' . tablename('fx_perm_role') . ' where uniacid=:uniacid and deleted=0 and merchid=0', array(':uniacid' => $_W['uniacid']));
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
	global $_W, $_GPC;
	load()->model('ufser');
	$id = intval($_GPC['id']);
	$accounts_plugin = explode(',', $accounts['plugins']);
	$accounts_com = explode(',', $accounts['coms']);
	$_perm = array('shop', 'goods', 'order', 'member', 'store', 'sale', 'finance', 'statistics', 'sysset');
	$accounts_perms = array_merge($accounts_com, $accounts_plugin, $_perm);
	$operator_prems = array();

	if ($_W['role'] == 'operator') {
		$operator = pdo_fetch('SELECT * FROM ' . tablename('fx_perm_user') . ' WHERE uid = :uid AND uniacid = :uniacid ', array(':uid' => $_W['user']['uid'], ':uniacid' => $_W['uniacid']));
		$operator_prems = explode(',', $operator['perms2']);
	}

	$item = pdo_fetch('SELECT * FROM ' . tablename('fx_perm_user') . ' WHERE id =:id and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));
	$perms = perms::formatPerms();
	$user_perms = array();
	$role_perms = array();

	if (!empty($item)) {
		if ($item['uid'] == $_W['uid']) {
			$this->message('无法修改自己的权限！', referer(), 'error');
		}

		$role = pdo_fetch('SELECT * FROM ' . tablename('fx_perm_role') . ' WHERE id =:id and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $item['roleid']));

		if (!empty($role)) {
			$role_perms = explode(',', $role['perms2']);
		}

		$user_perms = explode(',', $item['perms2']);
	}
	
	if ($_W['ispost']) {
		$data = array('uniacid' => $_W['uniacid'], 'username' => trim($_GPC['username']), 'realname' => trim($_GPC['realname']), 'mobile' => trim($_GPC['mobile']), 'roleid' => intval($_GPC['roleid']), 'status' => intval($_GPC['status']), 'perms2' => trim($_GPC['permsarray']), 'openid' => trim($_GPC['openid']));

		if (!empty($_GPC['password'])) {
			$password = trim($_GPC['password']);

			if (strlen($password) < 8) {
				web_json('密码长度至少8位', 0);
			}

			$score = 0;

			if (preg_match('/[0-9]+/', $password)) {
				++$score;
			}

			if (preg_match('/[a-z]+/', $password)) {
				++$score;
			}

			if (preg_match('/[A-Z]+/', $password)) {
				++$score;
			}

			if (preg_match('/[_|\\-|+|=|*|!|@|#|$|%|^|&|(|)]+/', $password)) {
				++$score;
			}

			if ($score < 2) {
				web_json('密码必须包含大小写字母、数字、标点符号的其中两项', 0);
			}
		}
		
		if (!empty($item['id'])) {
			
			$user = user_single(array('username' => $item['username']));
			
			if (!empty($user)) {
				$salt = pdo_get('users', array('uid' => $user['uid']), 'salt');
			}

			if (!empty($salt)) {
				$user['salt'] = $salt['salt'];
			}
			else {
				web_json('账号信息异常，请重新创建该操作员', 0);
			}

			$data['uid'] = $user['uid'];

			if (!empty($_GPC['password'])) {
				$data['password'] = $_GPC['password'];
			}
			if (!empty($_GPC['password'])) {
				if (function_exists('user_update')) {				
					user_update(array('uid' => $item['uid'], 'password' => $_GPC['password'], 'salt' => $user['salt']));
				}else{
					$newpwd = user_password($_GPC['password'], $item['uid']);
					$newpwd_hash = user_password_hash($newpwd, $item['uid']);
					if ($newpwd_hash != $user['hash'])
						pdo_update('users', array('password' => $newpwd), array('uid' => $item['uid']));
				}
			}
			pdo_update('fx_perm_user', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
			//plog('perm.user.edit', '编辑操作员 ID: ' . $id . ' 用户名: ' . $data['username'] . ' ');
		}else {
			if (user_check(array('username' => $data['username']))) {
				if (!user_check(array('username' => $data['username'], 'password' => $_GPC['password']))) {
					web_json('此用户为系统存在用户，但是您输入的密码不正确，无法添加', 0);
				}

				$user = user_single(array('username' => $data['username']));
				$data['uid'] = $user['uid'];
				$data['password'] = $user['password'];
			}
			else {
				$user = array('username' => $data['username'], 'password' => $_GPC['password']);
				$data['uid'] = user_register($user, 'admin');
				if (is_array($data['uid']) && is_error($data['uid'])) {
					web_json('密码' . $data['uid']['message'], 0);
				}

				pdo_insert('uni_account_users', array('uid' => $data['uid'], 'uniacid' => $data['uniacid'], 'role' => 'operator'));
			}

			pdo_insert('fx_perm_user', $data);
			$id = pdo_insertid();
			//plog('perm.user.add', '添加操作员 ID: ' . $id . ' 用户名: ' . $data['username'] . ' ');
		}

		web_json(array('url' => web_url('perm/user/edit', array('id' => $id))));
	}

	if (!empty($item['openid'])) {
		$member = m('member')->getMember($item['openid']);
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

	$items = pdo_fetchall('SELECT id,username FROM ' . tablename('fx_perm_user') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);

	foreach ($items as $item) {
		pdo_delete('fx_perm_user', array('id' => $item['id']));
		//plog('perm.user.delete', '删除操作员 ID: ' . $item['id'] . ' 操作员名称: ' . $item['username'] . ' ');
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
	$items = pdo_fetchall('SELECT id,username FROM ' . tablename('fx_perm_user') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);

	foreach ($items as $item) {
		pdo_update('fx_perm_user', array('status' => $status), array('id' => $item['id']));
		//plog('perm.user.edit', '修改操作员状态 ID: ' . $item['id'] . ' 操作员名称: ' . $item['username'] . ' 状态: ' . ($status == 0 ? '禁用' : '启用'));
	}

	web_json();
}

?>
