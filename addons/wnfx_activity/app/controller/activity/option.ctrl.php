<?php
defined('IN_IA') or exit('Access Denied');
$ops = array('option', 'form', 'formitem', 'spec', 'specitem');
$_W['op'] = in_array($_W['op'], $ops) ? $_W['op'] : 'option';

if ($_W['op'] == 'option') {
	$tag = random(32);
	include fx_template('activity/option');
}

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
	include fx_template('activity/form');
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
	include fx_template('activity/form_item');
}

if ($_W['op'] == 'spec') {
	$spec = array(
		"id" => random(32),
		"title" => $_GPC['title'],
		"placeholder" => $_GPC['placeholder']
	);
	include fx_template('activity/spec');
}

if ($_W['op'] == 'specitem') {
	$spec = array(
		"id" => $_GPC['specid']
	);
	$specitem = array(
		"id" => random(32),
		"title" => $_GPC['title'],
		"placeholder" => $_GPC['placeholder'],
		"show" => 1
	);
	include fx_template('activity/spec_item');
}
