<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * user.ctrl
 * 前端用户控制器
 */
defined('IN_IA') or exit('Access Denied');
function main(){
	global $_W, $_GPC;
	$pagetitle = '已报名用户';
	$id = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
	$uniacid = "uniacid={$_W['uniacid']}";
	$condition = " $uniacid and activityid=$id and (`status`<>0 or paytype='delivery') and `status` NOT IN(5,7)";
	
	$sql = 'SELECT * FROM ' . tablename('fx_activity_records') . " WHERE $condition AND openid = :openid";
	$join  = pdo_fetch($sql, array(':openid' =>$_W['openid']));
	$activity = model_activity::getSingleActivity($id, '*');
	$activity['falsedata']['nickname'] = explode('，',$activity['falsedata']['nickname']);
	
	$records = pdo_fetchall ("SELECT * FROM " . tablename ('fx_activity_records') . " WHERE $condition ORDER BY id DESC");
	foreach ($records as $k => &$item) {
		$item['avatar'] = str_replace('http:','https:',$item['headimgurl']);
		$item['nickname'] = mb_substr_replace($item['nickname'], '**', 1, -1);
	}
	if ($activity['hasoption']){//虚拟名额
		$opt['falsenum'] = pdo_fetchcolumn("SELECT SUM(falsenum) FROM " . tablename('fx_spec_option') . " WHERE activityid = $id");
		$activity['falsedata']['num'] = $opt['falsenum'] ? $opt['falsenum'] : 0;
	}	
	$joinnum = model_records::getJoinNum($id) + $activity['falsedata']['num'];
	include fx_template('userlist');
	exit;
}
function show(){
	global $_W, $_GPC;
	$pagetitle = '参与者';
	$rid = intval($_GPC['rid']);
	$records = model_records::getSingleRecords($rid);
	$records['avatar'] = str_replace('http:','https:',$records['headimgurl']);
	$activity = model_activity::getSingleActivity($records['activityid'], '*');
	$formdata = model_records::getNumFormData($rid);
	$records['mobile'] = preg_replace('/(1[3456789]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$records['mobile']);
	include fx_template('user');
	exit;
}