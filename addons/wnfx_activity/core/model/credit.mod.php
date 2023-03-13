<?php
function credit_get_by_uid($uid = '' ,$credit_type=1) {
	global $_W;
	if($credit_type==1){
		load()->model('mc');
		$result = mc_fetch($uid, array('credit1','credit2'));
	}
	return $result;
} 

 function credit_update_credit1($uid, $credit1 = 0, $remark = '', $store_id = 0, $clerk_type = 1) {
	global $_W;
	load()->model('mc');
	$result = mc_credit_update($uid, 'credit1', $credit1, array($uid, $remark, IN_MODULE, '', $store_id, $clerk_type));
	if($result){
		$openid = mc_uid2openid($uid);
		mc_notice_credit1($openid, $uid, $credit1, $remark, '', '谢谢您的参与!');
		return TRUE;
	}
	return FALSE;			
}

function credit_update_credit2($uid, $credit2 = 0, $remark = '', $store_id = 0, $clerk_type = 1) {
	global $_W;
	load()->model('mc');
	$result= mc_credit_update($uid, 'credit2', $credit2, array($uid, $remark, IN_MODULE, '', $store_id, $clerk_type));
	if($result){
		$openid = mc_uid2openid($uid);
		$credit = mc_credit_fetch($uid);			
		$time = date('Y-m-d H:i');
		$url = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=mc&a=bond&do=credits&credittype=credit2&type=record&period=1";
		$info = "【{$_W['account']['name']}】余额变更通知\n";
		$info .= "您在{$time}进行会员余额操作，余额增加【{$credit2}】元，变更后余额【{$credit['credit2']}】元。\n";
		$info .= !empty($remark) ? "备注：{$remark}\n\n" : '';
		sendCustomNotice($openid,$info,$url,'');
		return TRUE;
	}
	return FALSE;
}