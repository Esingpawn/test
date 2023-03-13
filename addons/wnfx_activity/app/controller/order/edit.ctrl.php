<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * edit.ctrl
 * 报名订单控制器
 */
defined('IN_IA') or exit('Access Denied');
fx_load()->func('attachment');
$pagetitle  = '报名管理';
$id = intval($_GPC['id'])?intval($_GPC['id']):0;
$item = pdo_fetch('select * from ' . tablename('fx_activity_records') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
if($item['review'] != 3) {
	fx_message('当前状态不可编辑！', '', 'error');
}
$activity = model_activity::getSingleActivity($item['activityid'], '*');
if ($_W['ispost']) {
	//插入常用表单数据
	$postMember = $_GPC['member'];
	$postMember['birthyear'] = $_GPC['birth']['year'];
	$postMember['birthmonth'] = $_GPC['birth']['month'];
	$postMember['birthday'] = $_GPC['birth']['day'];
	$postMember['resideprovince'] = $_GPC['reside']['province'];
	$postMember['residecity'] = $_GPC['reside']['city'];
	$postMember['residedist'] = $_GPC['reside']['district'];
	$postMember['gender'] = $_GPC['gender'];
	$postMember['education'] = $_GPC['education'];
	$postMember['constellation'] = $_GPC['constellation'];
	$postMember['zodiac'] = $_GPC['zodiac'];
	$postMember['bloodtype'] = $_GPC['bloodtype'];
	pdo_update('fx_form_data_common', $postMember, array('rid' => $id));
	
	//保存自定义表单信息
	$form_ids = $_GPC['form_id'];
	$len = count($form_ids);
	$form_items = array();
	for ($k = 0; $k < $len; $k++) {
		$form_items[$k] = is_array($_GPC["form_item_val_".$k]) ? implode(',', $_GPC["form_item_val_".$k]) : $_GPC["form_item_val_".$k];
		$form_id = $form_ids[$k];
		$a = array(
			"activityid" => $item['activityid'],
			"recordid" => $id,
			"formid" => $form_id,
			"data" => $form_items[$k]
		);
		$form_data = pdo_fetch('select * from ' . tablename('fx_form_data') . ' where recordid=:recordid and formid=:formid limit 1', array(':recordid' => $id, ':formid' => $form_id));
		//表单数据
		if (empty($form_data)){
			pdo_insert("fx_form_data", $a);
		}else{
			pdo_update('fx_form_data', $a, array('recordid' => $id, 'formid' => $form_id));
		}
	}
	
	$data = array (
		'uid' => $_W['member']['uid'],
		'uniacid' => $_W['uniacid'],
		'openid' => $_W['openid'],
		'nickname' => $_W['fans']['nickname'],
		'headimgurl' => $_W['fans']['avatar'],
		'realname' => $postMember['realname'],
		'mobile' => $postMember['mobile'],
		'gender' => $_GPC['gender']==0 ? '保密' : ($_GPC['gender']==1?'男':'女'),
		'review' => $activity['switch']['joinreview']?0:1,
		'msg' => htmlspecialchars_decode($_GPC['msg']),
		'remark' =>''
	);
	pdo_update('fx_activity_records', $data, array('id' => $id));
	show_json(array('message'=>'操作成功', 'url'=>app_url("order/detail",array('id'=>$id, 'type'=>'u'))));
}

$forms = model_activity::getNumActivityForm($item['activityid']);
foreach ($forms[0] as $k => &$s) {
	if (empty($s['fieldstype'])){
		$formData = model_records::getSingleFormData($id, $s['id']);
		if (($s['displaytype']==1 || $s['displaytype']==6 || $s['displaytype']==8)){
			$s['data'] = !empty($formData['data']) ? explode(',', $formData['data']) : array();
		}else{
			$s['data'] = $formData['data'];
		}
	}
}
$formdata_common = Util::getSingelData('*', 'fx_form_data_common', array('rid'=>$item['id']));
$formdata_common = empty($formdata_common)?m('member')->getMember($item['openid']):$formdata_common;
$sysform  = $activity['form'];

include fx_template();