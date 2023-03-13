<?php
defined('IN_IA') or exit('Access Denied');

$ops = array('form', 'formitem', 'formitemitem', 'spec', 'specitem');

if ($_W['op'] == 'form') {
	$type = $_GPC['type'];
	$form_type = trim($_GPC['form_type']);
	//if (in_array($form_type, array('0','1','2','3','4','5','6','7','8','9'))) {
	$placeholder = '输入'.str_replace('+','',$_GPC['title']).'标题';
	$form = array(
		"id" => $type=='sys'?$form_type:random(32),
		"title" => $type=='sys'?$_GPC['title']:'',
		"fieldstype" => $type=='sys'?$form_type:'',
		"displaytype" => $type=='diy'?$form_type:'',
		"placeholder" => $placeholder,
		"description" => ''	
	);
	if ($form['displaytype']!=='' && in_array($form['displaytype'], array(0,1,2))){
		$form['items'] = array(
			array('id'=>random(32),'show'=>1,'placeholder'=>'输入选项1'),
			array('id'=>random(32),'show'=>1,'placeholder'=>'输入选项2'),
		);
	}
	include fx_template("activity/tpl/form");
}

if ($_W['op'] == 'formitem') {
	$form = array(
		"id" => $_GPC['formid'],
		"displaytype" => $_GPC['displaytype']
	);
	$formitem = array(
		"id" => random(32),
		"title" => $_GPC['title'],
		"show" => 1,
		"placeholder" => $_GPC['placeholder']
	);
	include fx_template("activity/tpl/form_item");
}

if ($_W['op'] == 'formitemitem') {
	$formitem = array(
		"id" => $_GPC['formitemid']
	);
	$formitemitem = array(
		"id" => random(32),
		"title" => $_GPC['title'],
		"show" => 1,
		"placeholder" => $_GPC['placeholder']
	);
	include fx_template("activity/tpl/form_item_item");
}

if ($_W['op'] == 'spec') {
	$spec = array(
		"id" => random(32),
		"title" => $_GPC['title']
	);
	include fx_template("activity/tpl/spec");
}

if ($_W['op'] == 'specitem') {
	$spec = array(
		"id" => $_GPC['specid']
	);
	$specitem = array(
		"id" => random(32),
		"title" => $_GPC['title'],
		"show" => 1
	);
	include fx_template("activity/tpl/spec_item");
}

function phase() {
	global $_W, $_GPC;
	$days = (array)$_GPC['checkbox'];
	$clock1 = $_GPC['clock1'];
	$clock2 = $_GPC['clock2'];
	$item['starttime'] = $_GPC['starttime'];
	$item['endtime'] = $_GPC['endtime'];
	$s = strtotime($item['starttime']);
	$e = strtotime($item['endtime']);
	
	
	$spec_item_titles = $_GPC['spec_item_title'];
	$option_marketprice = $_GPC['option_marketprice'];
	$option_costprice = $_GPC['option_costprice'];
	$option_stock = $_GPC['option_stock'];
	$specs = array();
	$k = 0;
	for($i=$s; $i<=$e; $i+=86400){	
		$title = '';
		$week = getWeek(date('N', $i));
		if ($_GPC['phasetype']==1) {
			$title = date('Y-m-d', $i) . ' ' . $week;
		}
		if ($_GPC['phasetype']==2) {
			if(in_array($week, $days)) $title = date('Y-m-d', $i) . ' ' . $week;
		}
		if ($_GPC['phasetype']==3) {
			if(in_array(date('j', $i).'号', $days)) $title = date('Y-m-d', $i) . ' ' . $week;
		}
		if (!empty($title)) {
			$k++;
			$spec_items = array();
			foreach($spec_item_titles as $key=>$value) {
				$spec_items[] = array(
					"id" => random(32),
					"title" => $value,
					"placeholder" => "票种" . ($key+1)
				);
			}
			$specs[0][] = array(
				"id" => random(32),
				"title" => "第{$k}场 " . $title,
				"clock1" => $clock1,
				"clock2" => $clock2,
				"items" => $spec_items
			);
		}
	}
	unset($key);
	include fx_template();
}
function phaseitem() {
	global $_W, $_GPC;
	$spec = array(
		"id" => $_GPC['specid']
	);
	$specitem = array(
		"id" => random(32),
		"title" => $_GPC['title'],
		"placeholder" => $_GPC['placeholder'],
		"show" => 1
	);
	include fx_template("activity/tpl/phase_item");
}