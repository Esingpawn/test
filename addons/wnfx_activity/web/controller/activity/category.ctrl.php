<?php
defined('IN_IA') or exit('Access Denied');
function main(){
	global $_W, $_GPC;	
	$_W['page']['title'] = '分类管理';
	$list = pdo_fetchall("SELECT * FROM ".tablename('fx_category')."WHERE uniacid = {$_W['uniacid']} ORDER BY `displayorder` DESC, id ASC");
	if ($_W['ispost']) {		
		$datas = json_decode(html_entity_decode($_GPC['datas']), true);

		if (!is_array($datas)) {
			web_json('分类保存失败，请重试!', 0);
		}
		
		$cateids = array();
		$count = count($list);
		$displayorder = count($list);
		
		foreach ($datas as $row) {
			$cateids[] = $row['id'];
			pdo_update('fx_category', array('parentid' => 0, 'displayorder' => $count), array('id' => $row['id']));
			if ($row['children'] && is_array($row['children'])) {
				$displayorder_child = count($row['children']);
				
				foreach ($row['children'] as $child) {
					$cateids[] = $child['id'];
					--$count;
					pdo_query('update ' . tablename('fx_category') . ' set  parentid=:parentid,displayorder=:displayorder where id=:id', array(':displayorder' => $count, ':parentid' => $row['id'], ':id' => $child['id']));
					--$displayorder_child;
					if ($child['children'] && is_array($child['children'])) {
						$displayorder_third = count($child['children']);

						foreach ($child['children'] as $third) {
							$cateids[] = $third['id'];
							--$count;
							pdo_query('update ' . tablename('fx_category') . ' set  parentid=:parentid,displayorder=:displayorder where id=:id', array(':displayorder' => $count, ':parentid' => $child['id'], ':id' => $third['id']));
							--$displayorder_third;
							if ($third['children'] && is_array($third['children'])) {
								$displayorder_fourth = count($third['children']);

								foreach ($child['children'] as $fourth) {
									$cateids[] = $fourth['id'];
									--$count;
									pdo_query('update ' . tablename('fx_category') . ' set  parentid=:parentid,displayorder=:displayorder where id=:id', array(':displayorder' => $count, ':parentid' => $third['id'], ':id' => $fourth['id']));
									--$displayorder_fourth;
								}
							}
						}
					}					
				}
			}
			--$count;
			--$displayorder;
		}		
		web_json();
	}
	
	$children = array();
	if (!empty($list)) {
		foreach ($list as $index => $row) {
			if (!empty($row['parentid'])){
				$children[$row['parentid']][] = $row;
				unset($list[$index]);
			}
		}
	}
	$totals = model_activity::getTotals();
	include fx_template();
}
function edit(){
	global $_W, $_GPC;
	$cateTitle = '编辑';
	$_W['page']['title'] = $cateTitle . ' - 分类管理';
	post();
}
function add(){
	global $_W, $_GPC;
	$cateTitle = '添加';
	$_W['page']['title'] = $cateTitle . ' - 分类管理';
	post();
}
function post(){
	global $_W, $_GPC;
	$id = intval($_GPC['id']);
	$parentid = intval($_GPC['parentid']);	
	if (!empty($id)) {
		$item = pdo_get('fx_category', array('id' => $id));
		$parentid = $item['parentid'];
	}
	if (!empty($parentid)) {
		$parent = pdo_get('fx_category', array('id' => $parentid));
		if (empty($parent)) {
			web_json('抱歉，上级分类不存在或是已经被删除！',0);
		}
	}
	if ($_W['ispost']) {		
		if (empty($_GPC['catename'])) {
			web_json('分类名称不能为空！',0);
		}
		$where = array(
			'name' => $_GPC['catename'], 
			'uniacid' => $_W['uniacid']
		);
		if (!empty($parentid)) $where['parentid'] = $parentid;
		$exists = pdo_get('fx_category', $where, array('id'));
		if (!empty($result)) {
			web_json('当前分类已存在',0);
		}
		$data = array(
			'uniacid'       => $_W['uniacid'],
			'name' 			=> $_GPC['catename'],
			'description' 	=> $_GPC['description'],
			'displayorder' 	=> $_GPC['displayorder'],
			'enabled' 		=> $_GPC['enabled'],
			'open' 			=> $_GPC['open'],
			'thumb' 		=> $_GPC['thumb'],
			'parentid' 		=> $parentid,
			'visible_level' => $_GPC['visible_level']?$_GPC['visible_level']:0,
			'color' => $_GPC['color'],
			'redirect' => $_GPC['redirect']
		);
		if (!empty($id)) {
			pdo_update('fx_category', $data, array('id' => $id));
		}else{
			pdo_insert('fx_category', $data);
			$id = pdo_insertid();
		}
		web_json(web_url('activity/category'));
	}
	$totals = model_activity::getTotals();
	include fx_template();
}

if ($_W['op'] == 'delete') {
	$cateId = intval($_GPC['id']);
	$item = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_category') . " WHERE id = " . $cateId);
	if (empty($item)) {
		web_json('操作失败: 未指定活动分类.',0);
	}
	$result = pdo_delete('fx_category', array('id' => $cateId));
	if ($result) 
		pdo_delete('fx_category', array('parentid' => $cateId));
	web_json();
}

if ($_W['op'] == 'enabled') {
	$id = intval($_GPC['id']);
	$enabled = intval($_GPC['enabled']);
	$result = pdo_update('fx_category', array('enabled' => $enabled), array('id' => $id));
	web_json();
}