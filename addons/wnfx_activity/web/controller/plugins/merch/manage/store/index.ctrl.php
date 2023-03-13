<?php 
defined('IN_IA') or exit('Access Denied');
if ($_W['op'] == 'display') {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$paras = array(':uniacid' => $_W['uniacid']);
	$condition = ' uniacid = :uniacid' . FX_MERCHANTID;
	if (!empty($_GPC['keyword'])) {
		$_GPC['keyword'] = trim($_GPC['keyword']);
		$condition .= ' AND (storename LIKE \'%' . $_GPC['keyword'] . '%\' OR address LIKE \'%' . $_GPC['keyword'] . '%\' OR tel LIKE \'%' . $_GPC['keyword'] . '%\')';
	}

	if (!empty($_GPC['type'])) {
		$type = intval($_GPC['type']);
		$condition .= ' AND type = :type';
		$paras[':type'] = $type;
	}
	
	$sql = "select * from" . tablename('fx_store') . (' WHERE ' . $condition . ' ORDER BY id desc');
	$sql .= ' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
	$sql_count = 'SELECT count(1) FROM ' . tablename('fx_store') . (' WHERE ' . $condition);
	$total = pdo_fetchcolumn($sql_count, $paras);
	$pager = pagination($total, $pindex, $psize);
	$list  = pdo_fetchall($sql, $paras);
	
	foreach($list as$key=>&$s){
		if ($s['merchantid']>0) 
			$s['merchname'] = pdo_fetchcolumn("SELECT name FROM " . tablename('fx_merchant') . " WHERE uniacid = '{$_W['uniacid']}' and id={$s['merchantid']}");
		$s['salercount'] = pdo_fetchcolumn('select count(*) from ' . tablename('fx_saler') . ' where FIND_IN_SET(:storeid,storeid)>0 limit 1', array(':storeid' => $s['id']));
	}
	include fx_template();
}

if ($_W['op'] == 'query') {
	$kwd = trim($_GPC['keyword']);
	$limittype = empty($_GPC['limittype']) ? 0 : intval($_GPC['limittype']);
	$merchid = empty($_GPC['merchid']) ? 0 : intval($_GPC['merchid']);
	$params = array();
	$params[':uniacid'] = $_W['uniacid'];
	$condition = ' and uniacid=:uniacid  and status=1 and merchantid =' . $merchid;

	if ($limittype == 0) {
		//$condition .= '  and type in (1,2,3) ';
	}
	
	if (!empty($kwd)) {
		$condition .= ' AND `storename` LIKE :keyword';
		$params[':keyword'] = '%' . $kwd . '%';
	}

	$ds = pdo_fetchall('SELECT id,storename FROM ' . tablename('fx_store') . (' WHERE 1 ' . $condition . ' order by id asc'), $params);

	if ($_GPC['suggest']) {
		exit(json_encode(array('value' => $ds)));
	}
	include fx_template();
}
if ($_W['op'] == 'delete') { //删除主办方
	$id = intval($_GPC['id'])?intval($_GPC['id']):0;
	$ids = $_GPC['ids'];
	if(pdo_delete('fx_store', array('id'=>empty($ids)?$id:$ids))){
		web_json();
	} else {
		web_json('删除失败', 0);
	}
}
if ($_W['op'] == 'status') {
	$id = empty(intval($_GPC['id']))?$_GPC['ids']:intval($_GPC['id']);
	$status = intval($_GPC['status']);
	$result = pdo_update('fx_store', array('status' => $status), array('id' => $id));
	web_json();
}