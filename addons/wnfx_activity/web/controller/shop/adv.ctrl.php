<?php 
defined('IN_IA') or exit('Access Denied');
function main() {
	global $_W, $_GPC;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$keyword = $_GPC['keyword'];
	$where=array();
	if (!empty($keyword)) {
		$where['@advname'] = $keyword;
	}
	if ($_GPC['enabled']!='')  $where['enabled'] = $_GPC['enabled'];
	$listData = Util::getNumData('*', 'fx_adv', $where, 'displayorder DESC', $pindex,$psize,1);
	$list = $listData[0];
	//ihttp_post('https://m.xijiangjun.net/web/', array('uid' =>$uid,'mid' =>$mid));
	include fx_template();
}
function add() {
	post();
}

function edit() {
	post();
}

function post() {
	global $_W, $_GPC;
	$id = intval($_GPC['id']);
	$adv = pdo_fetch("select * from " . tablename('fx_adv') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $_W['uniacid']));
	if ($adv['color']=='') $adv['color'] = '#a6835a';
	if ($_W['ispost']) {
		$data = array(
			'uniacid' => $_W['uniacid'],
			'advname' => $_GPC['advname'],
			'link' => $_GPC['link'],
			'applink' => $_GPC['applink'],
			'enabled' => intval($_GPC['enabled']),
			'displayorder' => intval($_GPC['displayorder']),
			'thumb'=>$_GPC['thumb'],
			'color'=>$_GPC['color']
		);
		if (!empty($id)) {
			pdo_update('fx_adv', $data, array('id' => $id));
		} else {
			pdo_insert('fx_adv', $data);
			$id = pdo_insertid();
		}
		web_json(array('url' => web_url('shop/adv')));
	}
	include fx_template();
}

function delete() {
	global $_W, $_GPC;
	$id = empty(intval($_GPC['id']))?$_GPC['ids']:intval($_GPC['id']);
	pdo_delete('fx_adv', array('id' => $id));
	web_json();
}

function enabled() {
	global $_W, $_GPC;
	$id = empty(intval($_GPC['id']))?$_GPC['ids']:intval($_GPC['id']);
	$enabled = intval($_GPC['enabled']);
	$result = pdo_update('fx_adv', array('enabled' => $enabled), array('id' => $id));
	web_json();
}


function displayorder()	{
	global $_W, $_GPC;
	$id = intval($_GPC['id']);
	$displayorder = intval($_GPC['value']);
	$item = pdo_fetchall('SELECT id,advname FROM ' . tablename('fx_adv') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);

	if (!empty($item)) {
		pdo_update('fx_adv', array('displayorder' => $displayorder), array('id' => $id));
	}

	web_json();
}