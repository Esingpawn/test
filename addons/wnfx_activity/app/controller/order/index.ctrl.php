<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * order.ctrl
 * 报名订单控制器
 */
defined('IN_IA') or exit('Access Denied');
$pagetitle  = '报名管理';
$id = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
$keyword = trim($_GPC['keyword']);

if($_W['op'] =='display'){
	$activity = model_activity::getSingleActivity($id, '*');
	if ($activity['merchantid']!=MERCHANTID){
		fx_message('无权限访问', '', 'warning');
	}	
	include fx_template();
	exit;
}

if($_W['op'] =='detail'){
	global $_W,$_GPC;
	$pagetitle  = '报名详情';
	$id = intval($_GPC['id']);
	$type = trim($_GPC['type']);
	$item = model_records::getOrderCount($id);
	
	if ($item['merchantid']!=MERCHANTID && $item['openid']!=$_W['openid']){
		fx_message('无权限访问', 'javascript:wx.closeWindow();', 'warning');
	}
	$activity = model_activity::getSingleActivity($item['activityid'], '*');
	$merchant = model_merchant::getSingleMerchant($activity['merchantid'], '*');//读取主办方
	$item['saler'] = m('member')->getMember($item['veropenid']);
	$item['store'] = model_records::getSingleStore($item['storeid']);
	$forms = model_activity::getNumActivityForm($item['activityid']);
	$formdata_common = Util::getSingelData('*', 'fx_form_data_common', array('rid'=>$item['id']));
	
	$list = pdo_getall('fx_activity_records', array('orderno' => $item['orderno'], 'uniacid' =>$_W['uniacid']), '*', '', 'id asc');
	foreach ($list as $k => &$s) {
		$s['forms'] = model_activity::getNumActivityForm($s['activityid']);
		$s['formdata_common'] = Util::getSingelData('*', 'fx_form_data_common', array('rid'=>$s['id']));
	}
	include fx_template();
	exit;
}

if($_W['op'] =='getOrder'){
	$pindex = max(1, intval($_GPC['page']));
	$psize = 10;
	$status = trim($_GPC['status']);
	$review = trim($_GPC['review']);
	
	$where = array('activityid' => $id);
	
	if ($status!='') {
		if ($status==1 || $status==2){
			$where['#status'] = "(1,2)";
		}else{
			$where['status'] = $status;
		}
	}
	if ($review!='') $where['review'] = $review;
	if (!empty($keyword)){
		$where['sql'][] = "(INSTR(`realname`, '$keyword') or INSTR(`mobile`, '$keyword') or INSTR(`nickname`, '$keyword'))";
	}
	
	$order = "id DESC";
	$orderData = Util::getNumData('*', 'fx_activity_records', $where, $order, $pindex, $psize, 1);
	foreach ($orderData[0] as &$s) {
		$user_info = mc_fetch_one($s['uid']);
		$s['realname'] = empty($s['realname']) ? $user_info['nickname'] : $s['realname'];
		$s['avatar'] = tomedia($user_info['avatar']);
		$marketing = unserialize($s['marketing']);
		$s['market_price'] = $marketing['market_price'] ? $marketing['market_price'] : 0;
	}
	$data['list'] = $orderData[0];
	$data['total'] = $orderData[2];
	$data['tpage'] = (empty($psize) || $psize < 0) ? 1 : ceil($orderData[2] / $psize);
	die(json_encode($data));
	exit;
}

if($_W['ispost'] && $_W['op'] =='refund'){
	$id = intval($_GPC['id']);
	$result = pdo_update('fx_activity_records', array('status'=>6, 'refundtime'=>TIMESTAMP), array('id' => $id));	
	if($result){
		$item = model_records::getSingleRecords($id);
		$url = app_url('order/detail',array('type'=>'u', 'id'=>$id)); // 通知
		message::refund($item['openid'], $item, $url);
	}
	show_json(array('text'=>'待退款'));
}

if($_W['op'] =='cancel'){//取消我的报名
	$aid = intval($_GPC['aid']);
	$result = pdo_update('fx_activity_records', array ('status' => 5) , array ('id' => $_GPC['id']));
	$activity = model_activity::getSingleActivity($aid, '*');
	$creditoff = $activity['prize']['credit'];
	$costcredit = $activity['costcredit'];
	//积分变更，如果符合条件的话
	if ($result && $_W['_config']['creditstatus'] == 1){
		if($creditoff > 0) {
			m('member')->credit_update_credit1($_W['member']['uid'], 0-$creditoff, "取消报名：扣除原奖励" . $creditoff . m('member')->getCreditName('credit1'), $activity['merchantid']);
		}
		if($costcredit > 0) {
			m('member')->credit_update_credit1($_W['member']['uid'], $costcredit, "取消报名：返回原消耗" . $costcredit . m('member')->getCreditName('credit1'), $activity['merchantid']);
		}
	}
	
	$url = app_url('order/detail', array('id'=>$_GPC['id'],'type'=>'u')); // 取消报名通知
	message::join_cancel($_W['openid'], $activity['title'], $activity['starttime'],$_GPC['id'],$url);
	show_json(array('text'=>'已取消'));
}