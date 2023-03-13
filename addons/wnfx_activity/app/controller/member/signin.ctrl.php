<?php
$_W['page']['title'] = '签到结果';
$id = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
$midkey = $_GPC['midkey']?$_GPC['midkey']:$_GPC['mid'];
$redirect = 'javascript:wx.closeWindow();';
if (!$id) fx_message('请重新扫描二维码', $redirect, 'warning');
$activity = model_activity::getSingleActivity($id, '*');

if ($activity['signin']['rangeon'] && $activity['hasonline']!=1 && igetcookie('_location')!="success"){
	isetcookie("_location", 'success', 86400, true);
	include fx_template('member/singin');
	exit;
}

if ($_W['op'] =="consumption"){
	if (!$activity['switch']['signin']){
		fx_message('当前活动未开启签到', $redirect, 'warning');
	}
	$condition = "activityid = $id and status IN(1,2,3) and review=1 and openid='{$_W['openid']}'";
	$list = pdo_fetchall("select * from" . tablename('fx_activity_records') . " where $condition");
	$total = pdo_fetchcolumn('SELECT SUM(buynum) FROM ' . tablename('fx_activity_records') . " where $condition");
	if (empty($list)){
		fx_message('签到失败', $redirect, 'error', '无权限,可能您没有参与当前活动');
	}
	
	//线下活动，签到位置读取
	if ($activity['signin']['rangeon'] && $activity['hasonline']!=1){
		isetcookie('_location', '', -7 * 86400, true);
		$position = json_decode($_COOKIE["position"], true);
		//$position['lng']="117.186855";
		//$position['lat']="34.266669";
		$round = "ROUND(6378.138*2*ASIN(SQRT(POW(SIN((".$position['lat']."*3.1416/180-lat*3.1416/180)/2),2)+COS(".$position['lat']."*3.1416/180)*COS(lat*3.1416/180)*POW(SIN((".$position['lng']."*3.1416/180-lng*3.1416/180)/2),2)))*1000)";	
		if ($activity['hasstore']!=1){
			if (empty($activity['storeids'])){
				$distance = pdo_fetchcolumn("SELECT $round as distance FROM ".tablename('fx_store')." WHERE merchantid=".$activity['merchantid']." ORDER BY distance ASC limit 1");
				$distance = empty($distance) ? getDistance_map($position['lat'], $position['lng'], $activity['lat'], $activity['lng']) : $distance;
			}else{
				$distance = pdo_fetchcolumn("SELECT $round as distance FROM ".tablename('fx_store')." WHERE FIND_IN_SET(id,'".implode(',',$activity['storeids'])."') ORDER BY distance ASC limit 1");
			}
		}else{
			$distance = getDistance_map($position['lat'], $position['lng'], $activity['lat'], $activity['lng']);
		}
		$activity['signin']['range'] = $activity['signin']['range']>0?$activity['signin']['range']:500;	
		if ($distance>$activity['signin']['range']) fx_message('签到失败', $redirect, 'error', '抱歉！未到现场，不可签到');
	}
	
	//限制签到时间
	if ($activity['signin']['istime']!=1){
		if ($activity['signin']['istime']==2 && (TIMESTAMP < strtotime($activity['signin']['start']) || TIMESTAMP > strtotime($activity['signin']['end']))){
			fx_message('您好，正确签到时间<br>'.date('Y年m月d H:i',strtotime($activity['signin']['start'])).' ~ '.date('Y年m月d H:i',strtotime($activity['signin']['end'])), $redirect, 'warning');
		}
		if ($activity['signin']['istime']!=2 && TIMESTAMP < strtotime($activity['starttime']) - 0.5 * 3600){
			fx_message('请在活动开始前30分钟再进行签到', $redirect, 'warning');
		}
	}
	
	$signnum = intval($activity['signin']['num'])<1?1:$activity['signin']['num'];
	foreach ($list as $key => $record) {
		if (date('Y_m_d',strtotime($record['sendtime']))!=date('Y_m_d') && $key==0) {
			isetcookie("_signin", $record['signin'], 86400, true);
		}
		if (!$record['ishexiao']) {
			$data = array(
				'payprice'  => $record['price'], 
				'status'    => 3,
				'ishexiao'  => 1,
				'veropenid' => $_W['openid'],
				'sendtime'  => date('Y-m-d H:i:s',TIMESTAMP)
			);
			$result = pdo_update('fx_activity_records', $data ,array('orderno'=>$record['orderno']));
			model_records::orderAccount($record,3,'二维码签到');//账目结算
		}
		//签到
		if ($record['signin'] - intval(igetcookie('_signin'))<$signnum) {
			$data = array(
				'signin'    => $record['signin']+1,
				'sendtime'  => date('Y-m-d H:i:s',TIMESTAMP)
			);
			pdo_update('fx_activity_records', $data ,array('orderno'=>$record['orderno']));
			$error = 0;
		} else {
			$error = 1;
		}
	}
	if (!$error){
		$msg = '签到成功';
		$remark = '参与名额  <font color="#FF0000">' . $total . '</font> 人';
		//积分奖励
		if ($_W['_config']['creditstatus'] == 1 && $activity['prize']['sign_credit'] > 0) {
			$credit = intval($activity['prize']['sign_credit']);//赠送积分额度
			$result = m('member')->credit_update_credit1($_W['member']['uid'], $credit, "签到获取" . $credit . m('member')->getCreditName('credit1'), $activity['merchantid']);
			$remark .= '，获取 <font color="#FF0000">' . $credit . '</font> ' . m('member')->getCreditName('credit1');
		}
		fx_message($msg, $redirect, 'success', $remark);
	}else{
		fx_message("当前活动每天最多签到 $signnum 次", $redirect, 'error');
	}
}