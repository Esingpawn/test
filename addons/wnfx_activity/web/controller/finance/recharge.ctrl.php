<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * op.ctrl
 * 操作控制器
 */
defined('IN_IA') or exit('Access Denied');
$uniacid = $_W['uniacid'];
$id = intval($_GPC['id'])?intval($_GPC['id']):0;
$tab = empty($_GPC['tab'])?'weixin':str_replace('#tab_', '', $_GPC['tab']);
function main(){
	global $_W, $_GPC;
	$uid = intval($_GPC['id']);
	$type = trim($_GPC['type']);
	//$this->message('你没有相应的权限查看');
	$profile = m('member')->getMember($uid);
	//print_r($profile);
	load()->model('mc');
	if ($_W['ispost']) {
		$type = trim($_GPC['type']);
		$num = floatval($_GPC['num']);
		$names = array('credit1' => m('member')->getCreditName('credit1'), 'credit2' => '元');
		$credits = mc_credit_fetch($uid);
		$changetype = intval($_GPC['changetype']);
		
		if ($changetype==2) {
			$num -= $profile[$type];
		}else{			
			if ($changetype == 1) {
				$num = 0 - $num;
				if($num < 0 && abs($num) > $credits[$type]) {
					web_json("会员账户{$names[$type]}不够",0);
				}
			}
		}
		$status = mc_credit_update($uid, $type, $num, array($uid, '后台会员充值'.$num. $names[$type] .' '.trim($_GPC['remark']), IN_MODULE, 0, 0, 2));
		
		if(is_error($status)) {
			web_json($status['message'],0);
		}
		if($type == 'credit1') {
			mc_group_update($uid);
		}
		$openid = $profile['openid'];
		if(!empty($openid)) {
			if($type == 'credit1') {
				mc_notice_credit1($openid, $uid, $num, '后台会员充值' . m('member')->getCreditName('credit1'));
			}
			if($type == 'credit2') {
				if($num > 0) {
					mc_notice_recharge($openid, $uid, $num, '', "后台会员充值余额,增加{$value}元");
				} else {
					mc_notice_credit2($openid, $uid, $num, 0, '', '',  "后台会员充值余额,减少{$value}元");
				}
			}
		}
		web_json();
	}

	include fx_template();
}