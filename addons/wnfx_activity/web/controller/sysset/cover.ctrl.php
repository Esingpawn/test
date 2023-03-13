<?php 
defined('IN_IA') or exit('Access Denied');
$settings = $_W['_config'];
$_W['page']['title'] = '系统设置';

function main(){
	global $_W,$_GPC;
}

function _cover($key, $name, $url)
{
	global $_W, $_GPC;
	$rule = pdo_fetch('select * from ' . tablename('rule') . ' where uniacid=:uniacid and module=:module and name=:name limit 1', array(':uniacid' => $_W['uniacid'], ':module' => 'cover', ':name' => IN_MODULE . $name . '入口设置'));
	$keyword = false;
	$cover = false;

	if (!empty($rule)) {
		$keyword = pdo_fetch('select * from ' . tablename('rule_keyword') . ' where uniacid=:uniacid and rid=:rid limit 1', array(':uniacid' => $_W['uniacid'], ':rid' => $rule['id']));
		$cover = pdo_fetch('select * from ' . tablename('cover_reply') . ' where uniacid=:uniacid and rid=:rid limit 1', array(':uniacid' => $_W['uniacid'], ':rid' => $rule['id']));
	}
	if ($_W['ispost']) {
		$data = is_array($_GPC['cover']) ? $_GPC['cover'] : array();

		if (empty($data['keyword'])) {
			web_json('请输入关键词!', 0);
		}

		$keyword1 = common::keyExist($data['keyword']);

		if (!empty($keyword1)) {
			if ($keyword1['name'] != IN_MODULE . $name . '入口设置') {
				web_json('关键字已存在!', 0);
			}
		}

		if (!empty($rule)) {
			pdo_delete('rule', array('id' => $rule['id'], 'uniacid' => $_W['uniacid']));
			pdo_delete('rule_keyword', array('rid' => $rule['id'], 'uniacid' => $_W['uniacid']));
			pdo_delete('cover_reply', array('rid' => $rule['id'], 'uniacid' => $_W['uniacid']));
		}

		$rule_data = array('uniacid' => $_W['uniacid'], 'name' => IN_MODULE . $name . '入口设置', 'module' => 'cover', 'displayorder' => 0, 'status' => intval($data['status']));
		pdo_insert('rule', $rule_data);
		$rid = pdo_insertid();
		$keyword_data = array('uniacid' => $_W['uniacid'], 'rid' => $rid, 'module' => 'cover', 'content' => trim($data['keyword']), 'type' => 1, 'displayorder' => 0, 'status' => intval($data['status']));
		pdo_insert('rule_keyword', $keyword_data);
		$cover_data = array('uniacid' => $_W['uniacid'], 'rid' => $rid, 'module' => IN_MODULE, 'title' => trim($data['title']), 'description' => trim($data['desc']), 'thumb' => tomedia($data['thumb']), 'url' => $url);
		pdo_insert('cover_reply', $cover_data);
		//plog('sysset.cover.' . $key . '.edit', '修改' . $name . '入口设置');
		web_json();
	}

	return array('rule' => $rule, 'cover' => $cover, 'keyword' => $keyword, 'url' => $url, 'name' => $name, 'key' => $key);
}
function _cover_wxapp($key, $name, $url)
{
	global $_W, $_GPC;
	return array('url' => $url, 'name' => $name, 'key' => $key);
}
function shop()
{
	global $_W, $_GPC;
	if ($_W['account']->typeSign == 'wxapp')
		$cover = _cover_wxapp('home', '商城', IN_MODULE.'/pages/index/index');
	else
		$cover = _cover('shop', '商城', app_url('', array(), false));
	include fx_template('sysset/cover');
}
function member()
{
	global $_W, $_GPC;
	
	if ($_W['account']->typeSign == 'wxapp')
		$cover = _cover_wxapp('member', '会员中心', IN_MODULE.'/pages/user/user');
	else
		$cover = _cover('member', '会员中心', app_url('member', array(), false));
	include fx_template('sysset/cover');
}
function order()
{
	global $_W, $_GPC;
	if ($_W['account']->typeSign == 'wxapp')
		$cover = _cover_wxapp('order', '订单', IN_MODULE.'/pages/order/order');
	else
		$cover = _cover('order', '订单', app_url('records', array(), false));
	include fx_template('sysset/cover');
}
function merch()
{
	global $_W, $_GPC;
	if ($_W['account']->typeSign == 'wxapp')
		$cover = _cover_wxapp('merch', '商户中心', IN_MODULE.'/pages/webview/index?r=member.merch');
	else
		$cover = _cover('merch', '商户中心', app_url('member/merch', array(), false));
	include fx_template('sysset/cover');
}