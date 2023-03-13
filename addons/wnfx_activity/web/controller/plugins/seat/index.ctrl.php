<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * plugins
 * 应用控制器
 */
defined('IN_IA') or exit('Access Denied');

function main(){
	global $_W,$_GPC;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$params = array(':uniacid' => $_W['uniacid']);
	$condition = ' uniacid = :uniacid';
	if (!empty($_GPC['keyword'])) {
		$_GPC['keyword'] = trim($_GPC['keyword']);
		$condition .= ' AND (name LIKE \'%' . $_GPC['keyword'] . '%\')';
	}

	if (MERCHANTID) {
		$condition .= ' AND merchid = :merchid';
		$params[':merchid'] = MERCHANTID;
	}
	
	$sql = "select * from" . tablename('fx_seat') . (' WHERE ' . $condition . ' ORDER BY id desc');
	$sql .= ' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
	$sql_count = 'SELECT count(1) FROM ' . tablename('fx_seat') . (' WHERE ' . $condition);
	$total = pdo_fetchcolumn($sql_count, $params);
	$pager = pagination($total, $pindex, $psize);
	$list  = pdo_fetchall($sql, $params);
	foreach($list as$key=>&$s){
		if ($s['merchid']>0) 
			$s['merchname'] = pdo_fetchcolumn("SELECT name FROM " . tablename('fx_merchant') . " WHERE uniacid = '{$_W['uniacid']}' and id={$s['merchid']}");
	}
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
	$id      = intval($_GPC['id']);
	$rows    = 15;
	$columns = 15;
	$map     = array('ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc', 		'ccccccccccccccc', 'ccccccccccccccc', 'ccccccccccccccc');
	$item = pdo_fetch('SELECT * FROM ' . tablename('fx_seat') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));
	
	
	if ($_W['ispost']) {
		$seat = $_GPC['seat'];
		$seat['rows'] = empty($seat['rows']) ? $rows : $seat['rows'];
		$seat['columns'] = empty($seat['columns']) ? $columns : $seat['columns'];
		$data = array(
			'uniacid' => $_W['uniacid'],
			'merchid' => $_GPC['merchid'],
			'gid' 	  => $_GPC['gid'],
			'storeid' => $_GPC['storeid']
		);
		$data = array_merge($data, $seat);
		
		if (!empty($id)) {
			pdo_update('fx_seat', $data, array('id' => $id));
		}
		else {
			pdo_insert('fx_seat', $data);
			$id = pdo_insertid();
		}
		web_json(array('url' => web_url('seat/edit', array('id' => $id))));
	}
	
	//读取主办方
	$merchid = !MERCHANTID ? $item['merchid']  : MERCHANTID;
	$merch = model_merchant::getSingleMerchant($merchid, 'id, name');
	if (!empty($item)) {
		$arr = array();
		$rows = $item['rows'];
		$columns = $item['columns'];		
		for($i = 0; $i < $item['rows']; $i++){
			$c = '';
			for($ii = 0; $ii < $item['columns']; $ii++){
				$c = $c . 'c';
			}
			$arr[$i] = $c;
		}
		$map = $arr;
	}
	include fx_template();	
}

function query() {
	global $_W, $_GPC;
	$kwd = trim($_GPC['keyword']);
	$merchid = empty($_GPC['merchid']) ? 0 : intval($_GPC['merchid']);
	$params = array();
	$params[':uniacid'] = $_W['uniacid'];
	$condition = ' and uniacid=:uniacid  and merchid =' . $merchid;
	
	if (!empty($kwd)) {
		$condition .= ' AND `name` LIKE :keyword';
		$params[':keyword'] = '%' . $kwd . '%';
	}

	$ds = pdo_fetchall('SELECT * FROM ' . tablename('fx_seat') . (' WHERE 1 ' . $condition . ' order by id asc'), $params);
	include fx_template();
}

function delete() {
	global $_W,$_GPC;
	$uniacid = $_W['uniacid'];
	$id = intval($_GPC['id']);
	$ids = $_GPC['ids'];
	if (!is_array($ids)) $ids = array($id);
	$result = pdo_delete('fx_seat', array('id' => $ids));
	web_json();
}