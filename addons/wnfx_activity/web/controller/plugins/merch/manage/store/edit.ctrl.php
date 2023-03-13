<?php 
defined('IN_IA') or exit('Access Denied');
$id = intval($_GPC['id'])?intval($_GPC['id']):0;
$tab = empty($_GPC['tab'])?'basic':str_replace('#tab_', '', $_GPC['tab']);
$_W['page']['title'] = '编辑门店';
if(!empty($id)){
	$item = pdo_fetch("select * from" . tablename('fx_store') . "where uniacid='{$_W['uniacid']}' and id = '{$id}'");
	$item['storehours'] = unserialize($item['storehours']);
	if (!empty($item['merchantid'])) {
		$merch = pdo_fetch('select id,name from ' . tablename('fx_merchant') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $item['merchantid'], ':uniacid' => $_W['uniacid']));
	}else{
		$merch=array('id'=>0,'name'=>$_W['_config']['sname']);
	}
}else{
	$merch = model_merchant::getSingleMerchant($_GPC['merchid']?$_GPC['merchid']:MERCHANTID, 'id,name');
}
if ($_W['ispost']) {
	$data = array(
		'uniacid' => $_W['uniacid'],
		'storename' => $_GPC['storename'],
		'address' => $_GPC['address'],
		'tel' => $_GPC['tel'],
		'lng' => $_GPC['map']['lng'],
		'lat' => $_GPC['map']['lat'],
		'adinfo' => $_GPC['map']['adinfo'],
		'status' => $_GPC['status'],
		'merchantid'=>$_GPC['merchid']
	);
	$registerdate     = $_GPC['registerdate'];
	$data['storehours']= serialize($registerdate);
	if ($id) {
		pdo_update('fx_store', $data, array(
			'id' => $id
		));
	} else {
		pdo_insert('fx_store', $data);
		$id = pdo_insertid();
	}
	web_json(array('message'=>'操作成功', 'url'=>web_url("store/edit",array('id'=>$id))));
}
include fx_template();