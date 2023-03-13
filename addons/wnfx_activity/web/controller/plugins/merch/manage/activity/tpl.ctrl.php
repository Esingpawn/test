<?php
defined('IN_IA') or exit('Access Denied');

$ops = array('form', 'formitem', 'spec', 'specitem');


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
		"id" => $_GPC['formid']
	);
	$formitem = array(
		"id" => random(32),
		"title" => $_GPC['title'],
		"show" => 1,
		"placeholder" => $_GPC['placeholder']
	);
	include fx_template("activity/tpl/form_item");
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
	global $_W, $_GPC;
	$days = (array)$_GPC['checkbox'];
	$item['clock1'] = $_GPC['clock1'];
	$item['clock2'] = $_GPC['clock2'];
	$item['starttime'] = $_GPC['starttime'];
	$item['endtime'] = $_GPC['endtime'];
	$s = strtotime($item['starttime']);
	$e = strtotime($item['endtime']);
	$list = array();
	for($i=$s; $i<=$e; $i+=86400){		
		$week = getWeek(date('N', $i));
		if ($_GPC['phasetype']==1) {
			$list[] = date('Y-m-d', $i) . ' ' . $week;
		}
		if ($_GPC['phasetype']==2) {
			if(in_array($week, $days)) $list[] = date('Y-m-d', $i) . ' ' . $week;
		}
		if ($_GPC['phasetype']==3) {
			if(in_array(date('j', $i).'号', $days)) $list[] = date('Y-m-d', $i) . ' ' . $week;
		}
	}
	include fx_template("activity/tpl/phase");
}