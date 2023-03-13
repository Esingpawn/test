<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * opp.ctrl
 * 操作控制器
 */
defined('IN_IA') or exit('Access Denied');

function opData() {
	global $_W, $_GPC;
	return array('id' => $id, 'item' => $item, 'tab'=>$tab);
}

function sendmsg() {
	global $_W, $_GPC;
	set_time_limit(0);
	$uniacid = $_W['uniacid'];
	$id = intval($_GPC['id'])?intval($_GPC['id']):$_GPC['aid'];
	$rids = empty($_GPC['ids'])?'':(is_array($_GPC['ids'])?implode(',', $_GPC['ids']):$_GPC['ids']);
	$activity = model_activity::getSingleActivity($id, '*');
	$pindex = max(1, intval($_GPC['page']));
	$psize  = 1;//每页条数
	$limit = " LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
	$fans_group = intval($_GPC['fans_group']);
	$condition = "uniacid = $uniacid";
	switch($fans_group){
		case 1:
			$fans = pdo_fetchall ("SELECT uid,openid FROM " . tablename('mc_mapping_fans') . " WHERE $condition and follow=1 $limit" );
			$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('mc_mapping_fans') . " WHERE $condition and follow=1");
			break;
		case 2:
			$fans = pdo_fetchall ("SELECT uid,openid FROM ".tablename('fx_merchant_fans')." WHERE $condition and follow=1 and uid<>0 and merchantid=".$activity['merchantid'].$limit);
			$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename('fx_merchant_fans')." WHERE $condition and follow=1 and uid<>0 and merchantid=".$activity['merchantid']);
			break;
		case 3:
			$fans = pdo_fetchall ("SELECT * FROM " . tablename('fx_activity_records') . " WHERE $condition and status=3 and activityid=" . $id . $limit);
			$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE  $condition and status=3 and activityid=" . $id);
			break;
		case 4:
			$fans = pdo_fetchall ("SELECT * FROM " . tablename('fx_activity_records') . " WHERE $condition and status in (1,2) and activityid=" . $id . $limit);
			$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE  $condition and status in (1,2) and activityid=" . $id);
			break;
		default:
			if (!empty($rids))
				$con ="$condition AND id in ($rids)";
			else
				$con ="$condition AND status in (1,2,3)";
			$fans = pdo_fetchall ("SELECT * FROM " . tablename('fx_activity_records') . " WHERE $con and activityid=" . $id . $limit);
			$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE  $con and activityid=" . $id);
			break;
	}
	$tpage  = (empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);
	$uid = $fans[0]['uid'];
	$mobile = $fans[0]['mobile'];
	$openid = $fans[0]['openid'];
	$params = array(
		"status" => intval($_GPC['status']),
		"first"  => $_GPC['messge_title'],
		"remark" => $_GPC['messge_remark'],
		"messge_type" => intval($_GPC['messge_type']),
		"messge_url" => trim($_GPC['messge_url'])
	);
	fx_load()->model('mc');
	if ($params['messge_type']==1){
		$url = empty($params['messge_url']) ? app_url('activity/detail',array('id'=>$id)) : $params['messge_url'];
		if (mc_fans_follow($uid) && $openid!='')
		message::send_msg($openid, $activity, $params, $url);
	}else{
		$merchant['name'] = $_W['_config']['sname'];
		$address = model_activity::getAddress($id);
		switch($params['status']){
			case 1:
				$first  = $activity['title'];
				$timestr = date('m月d H:i',strtotime($activity['joinstime']));
				$remark = "机会不容错过！";
				break;
			case 2:
				$first   = $activity['title'];
				$timestr = date('m月d H:i',strtotime($activity['starttime']));
				$remark  = "届时请准时参加！";
				break;
			case 3:
				$first   = $activity['title'];
				$timestr = date('m月d H:i',strtotime($activity['endtime']));
				$remark  = "在此感谢您的热情参与！";
				break;
			default:;
		}
		$first  = empty($params['first']) ? $first : $params['first'];
		$remark = empty($params['remark']) ? $remark : $params['remark'];
		foreach($fans as $key=> $v){
			$member = m('member')->getMember($v['openid']);
			$smsparams=array(
				'item'    => $first,
				'timestr' => $timestr,
				'product' => $_W['_config']['sname'],
				'name'    => $v['realname'],
				'idcode'  => $v['hexiaoma'],
				'address' => $address,
				'remark'  => $remark
			);
			
			$template_id = empty($activity['smsnotify']['group']) ? $_W['_config']['sms_group'] : $activity['smsnotify']['group'];
			$sendmsg = sendSMS($member['mobile'], $smsparams,$template_id,$_W['_config']['sms_type']);
		}
	}
	$res = array(
		'result'=>array(
			'tpage' => $tpage,
			'message' => $sendmsg
		),
		'status'=>1
	);
	die(json_encode($res));
}

function msg() {
	global $_W, $_GPC;
	$uniacid = $_W['uniacid'];
	$id = intval($_GPC['id'])?intval($_GPC['id']):$_GPC['aid'];
	include fx_template();	
}

function entry() {
	global $_W, $_GPC;
	$uniacid = $_W['uniacid'];
	$id = intval($_GPC['id'])?intval($_GPC['id']):$_GPC['aid'];
	include fx_template();	
}

function phase() {
	global $_W, $_GPC;
	$id = intval($_GPC['id'])?intval($_GPC['id']):$_GPC['aid'];
	if (!empty($id)) {
		$item = model_activity::getSingleActivity($id, '*');
		$specs = model_activity::getNumActivitySpec($id);//活动规格
	}
	$item['clock1'] = empty($item['clock1']) ? '09:00' : $item['clock1'];
	$item['clock2'] = empty($item['clock2']) ? '18:00' : $item['clock2'];
	$item['starttime'] = empty($item['starttime']) ? date("Y-m-d",strtotime("+1days",time())) : $item['starttime'];
	$item['endtime'] = empty($item['endtime']) ? date("Y-m-d",strtotime("+1months",time())) : $item['endtime'];
	include fx_template();	
}