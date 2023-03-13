<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * goods.ctrl
 * 报名订单控制器
 */
defined('IN_IA') or exit('Access Denied');
function share(){
	global $_W,$_GPC;
	$id = intval($_GPC['id']);
	$_W['uniacid'] = $_W['wxacid'];
	$_W['member']['uid'] = intval($_GPC['uid']);
	$activity = model_activity::getSingleActivity($id, '*');
	pdo_query("UPDATE ".tablename('fx_activity')." SET trueshare=trueshare+1 WHERE id = :id", array(':id' => $id));
	if (TIMESTAMP > strtotime($activity['joinetime']) || TIMESTAMP > strtotime($activity['endtime'])){//报名结束或者活动结束，不奖励积分;
		show_json('报名结束或者活动结束，不奖励' . m('member')->getCreditName('credit1'), 0);
	}elseif ($_W['_config']['creditstatus'] && $activity['prize']['share_times']>0){
		$credit = intval($activity['prize']['share_credit']);//赠送积分额度
		$share_times = intval($activity['prize']['share_times']);//每天分享获取奖励次数
		$credit_type = $_W['_config']['credit_type']?$_W['_config']['credit_type']:1;
		$credit_data = array(
			':uniacid'=>$_W['uniacid'],
			':uid'=>$_W['member']['uid'],
			':module'=>IN_MODULE,
			':store_id'=>$activity['merchantid'],
			':clerk_type'=>4
		);
		$log['nums'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('mc_credits_record') . ' WHERE to_days(FROM_UNIXTIME(createtime))=to_days(now()) AND uniacid=:uniacid AND uid=:uid AND module=:module AND store_id=:store_id AND clerk_type=:clerk_type', $credit_data);
		if ($share_times > $log['nums']) {
			if ($_W['plugin']['card']['config']['card_enable'] && $is_vip) {//年卡
				if ($_W['plugin']['card']['config']['credit_double']) {
					$credit = $credit * 2;
					$cardRemark = '，'.$yearcard['name'].'翻倍';
				}
			}
			$result = m('member')->credit_update_credit1($_W['member']['uid'], $credit, "分享获取：" . $credit . m('member')->getCreditName('credit1'), $activity['merchantid'], 4);
			show_json(array('message'=>'恭喜您获取 ' . $credit . m('member')->getCreditName('credit1') . $cardRemark));
		}else{
			show_json('您当天分享' . m('member')->getCreditName('credit1') . '已送完，请明日再领取', 0);
		}
	}
}