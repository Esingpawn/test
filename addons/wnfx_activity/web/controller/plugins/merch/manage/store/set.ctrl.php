<?php 
defined('IN_IA') or exit('Access Denied');
$params[':uniacid'] = $_W['uniacid'];
$params[':module'] = IN_MODULE;
$params[':name'] = '活动报名核销回复';
$rule = pdo_fetch("select id from " . tablename('rule') . 'where uniacid=:uniacid and module=:module and name=:name', $params);
if ($rule) {
	$set = pdo_fetch("select content from " . tablename('rule_keyword') . 'where uniacid=:uniacid and rid=:rid', array(
		':uniacid' => $_W['uniacid'],
		':rid' => $rule['id']
	));
	$keyword = $set['content'];
}
if ($_W['ispost']) {
	$keyword = empty($_GPC['keyword']) ? '核销' : $_GPC['keyword'];
	if (empty($rule)) {
		$rule_data = array(
			'uniacid' => $_W['uniacid'],
			'name' => '活动报名核销回复',
			'module' => IN_MODULE,
			'displayorder' => 0,
			'status' => 1
		);
		pdo_insert('rule', $rule_data);
		$rid          = pdo_insertid();
		$keyword_data = array(
			'uniacid' => $_W['uniacid'],
			'rid' => $rid,
			'module' => IN_MODULE,
			'content' => trim($keyword),
			'type' => 1,
			'displayorder' => 0,
			'status' => 1
		);
		pdo_insert('rule_keyword', $keyword_data);
	} else {
		pdo_update('rule_keyword', array(
			'content' => trim($keyword)
		), array(
			'rid' => $rule['id']
		));
	}
	web_json();
}
include fx_template();