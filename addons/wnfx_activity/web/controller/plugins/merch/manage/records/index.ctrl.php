<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * records.ctrl
 * 报名记录管理控制器
 */
defined('IN_IA') or exit('Access Denied');
function orderData(){
	global $_W, $_GPC;
	$uniacid    = $_W['uniacid'];
	$aid        = $_GPC['aid']?intval($_GPC['aid']):$_GPC['activityid'];
	$optionid   = $_GPC['optionid']?intval($_GPC['optionid']):0;
	$keyword    = trim($_GPC['keyword']);
	$status     = $_GPC['status'];
	$merchid = MERCHANTID ? MERCHANTID : intval($_GPC['merchantid']);
	return array('uniacid' => $uniacid, 'aid' => $aid, 'keyword'=>$keyword, 'status'=>$status, 'merchid'=>$merchid,'optionid'=>$optionid);
}

function main(){
	global $_W, $_GPC;
	if ($_GPC['export'] == 1) {
		output();
	}elseif ($_GPC['export'] == 2) {
		hexiao();
	}else{
		order();
	}	
}

function order(){
	global $_W, $_GPC;
	extract(orderData());
	$pindex = max(1, intval($_GPC['page']));		
	$psize = 20;
	if ($merchid) {
		$merch = model_merchant::getSingleMerchant($merchid, 'id,name');
	}else{
		$merchsData = model_merchant::getNumMerchant(0,0,0,0);
		$merchs     = $merchsData[0];
	}
	$condition = " uniacid = $uniacid";	
	if ($merchid) {//商家筛选
		$condition .= " AND merchantid=$merchid";
		
	}
	
	if (!empty($aid)) {
		$condition .= " AND activityid = $aid";
		$activity = pdo_get('fx_activity', array('id' => $aid));
		$specs = model_activity::getNumActivitySpec($aid);//活动规格
	}
	$searchfield = $_GPC['searchfield'];
	if (!empty($keyword)) {
		$params[':keyword'] = htmlspecialchars_decode($_GPC['keyword'], ENT_QUOTES);
		if (!empty($searchfield)) {
			if ($searchfield=='mid')
			$condition .= ' AND uid = :keyword';
			
		}else{
			$condition .= " AND (INSTR(`realname`, :keyword) or INSTR(`mobile`, :keyword) or INSTR(`nickname`, :keyword) or INSTR(`optionname`, :keyword) or hexiaoma=:keyword or transid=:keyword or uniontid=:keyword or orderno=:keyword)";
		}
	}
	if (!empty($optionid)) {
		$condition .= " AND optionid = :optionid";
		$params[':optionid'] = $optionid;
	}
	if (empty($starttime) || empty($endtime)) {//初始化时间
		$starttime = strtotime('-1 month');
		$endtime = time();
	}
	if (!empty($_GPC['time']) && !empty($_GPC['timetype'])) {
		$starttime = strtotime($_GPC['time']['start']);
		$endtime = strtotime($_GPC['time']['end']);
		switch($_GPC['timetype']){
			case 1:$condition .= " and UNIX_TIMESTAMP(jointime)>" . $starttime . " and UNIX_TIMESTAMP(jointime)<" . $endtime;break;
			case 2:$condition .= " and UNIX_TIMESTAMP(paytime)>" . $starttime . " and UNIX_TIMESTAMP(paytime)<" . $endtime;break;
			case 3:$condition .= " and UNIX_TIMESTAMP(sendtime)>" . $starttime . " and UNIX_TIMESTAMP(sendtime)<" . $endtime;break;
			default:break;
		}
	}

	$totals = array();
	$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition", $params);
	$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status IN (1,2) AND review = 1", $params);
	$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 3", $params);
	$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 0 AND (paytype<>'delivery' or (review=1 AND paytype='delivery'))", $params);
	$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 5", $params);
	$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 6", $params);
	$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status = 7", $params);
	$totals[] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition AND (status IN (1,2) || paytype='delivery') AND review <> 1", $params);
	foreach ($totals as $k => &$s) {
		$s = $s>=10000 ? (int)($s/10000) .'w+' : $s;
	}
	if ($status!='') {
		switch($status){
			case 0:$condition .= " AND status = 0 AND (paytype<>'delivery' or (review=1 AND paytype='delivery'))";break;
			case 1:$condition .= " AND review = 1 AND status IN (1,2)";break;
			case 3:$condition .= " AND status = 3";break;
			case 5:$condition .= " AND status = 5";break;
			case 6:$condition .= " AND status = 6";break;
			case 7:$condition .= " AND status = 7";break;
			case 8:$condition .= " AND review <> 1 AND (status IN (1,2) || paytype='delivery')";break;
			default:;
		}
	}else{
		$total_payprice = sprintf("%.2f", pdo_fetchcolumn('SELECT SUM(payprice) AS payprice FROM ' . tablename('fx_activity_records') . " WHERE $condition AND status IN (1, 3)", $params));
	}
	
	$list = pdo_fetchall ("SELECT * FROM " . tablename ('fx_activity_records') . " WHERE $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, $params);
	foreach ($list as $k => &$s) {
		$s['marketing'] = unserialize($s['marketing']);
		$s['saler'] = m('member')->getMember($s['veropenid']);
		$s['store'] = model_records::getSingleStore($s['storeid']);
		if ($s['status']==7) {
			$s['refundtime'] = pdo_getcolumn('fx_refund_record', array('recordid' => $s['id']), 'createtime');
		}
		$s['refundtime'] = $s['refundtime'];
		if (!$aid) $s['goods'] = pdo_fetch('SELECT * FROM ' . tablename('fx_activity') . " WHERE id=".$s['activityid']);
	}
	$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition", $params);
	$total_price = sprintf("%.2f", pdo_fetchcolumn('SELECT SUM(price) AS price FROM ' . tablename('fx_activity_records') . " WHERE $condition", $params));
	$pager = pagination($total, $pindex, $psize);
	include fx_template();
}

function output(){
	global $_W, $_GPC;
	extract(orderData());
	$condition = " uniacid = $uniacid";	
	if ($merchid) {//商家筛选
		$condition .= " AND merchantid=$merchid";
	}
	
	if (!empty($aid)) {
		$condition .= " AND activityid = $aid";
		$activity = model_activity::getSingleActivity($aid, '*');
		$sysform  = $activity['form'];
	}
	if (!empty($keyword)) {
		$condition .= " AND (INSTR(`realname`, '$keyword') or INSTR(`mobile`, '$keyword') or INSTR(`nickname`, '$keyword') or INSTR(`optionname`, '$keyword') or hexiaoma='$keyword' or transid='$keyword' or uniontid='$keyword' or orderno='$keyword')";
	}
	if (!empty($optionid)) {
		$condition .= " AND optionid = $optionid";
	}
	if (!empty($_GPC['time']) && !empty($_GPC['timetype'])) {
		$starttime = strtotime($_GPC['time']['start']);
		$endtime = strtotime($_GPC['time']['end']);
		switch($_GPC['timetype']){
			case 1:$condition .= " and UNIX_TIMESTAMP(jointime)>" . $starttime . " and UNIX_TIMESTAMP(jointime)<" . $endtime;break;
			case 2:$condition .= " and UNIX_TIMESTAMP(paytime)>" . $starttime . " and UNIX_TIMESTAMP(paytime)<" . $endtime;break;
			case 3:$condition .= " and UNIX_TIMESTAMP(sendtime)>" . $starttime . " and UNIX_TIMESTAMP(sendtime)<" . $endtime;break;
			default:break;
		}
	}
	//设置表头部信息
	$title = empty($activity['title']) ? "报名数据" : $activity['title'];
	$columns = array(
		array('title' => '订单编号', 'field' => 'orderno', 'width' => 24),
		array('title' => '姓名', 'field' => 'realname', 'width' => 12),
		array('title' => '昵称', 'field' => 'nickname', 'width' => 12),
		array('title' => '性别', 'field' => 'gender', 'width' => 12),
		array('title' => '电话', 'field' => 'mobile', 'width' => 20), 
		array('title' => '规格', 'field' => 'optionname', 'width' => 24),
		array('title' => '名额', 'field' => 'buynum', 'width' => 12), 		
		array('title' => '支付费用', 'field' => 'price', 'width' => 12), 
		array('title' => '签到次数', 'field' => 'signin', 'width' => 12), 
		array('title' => '状态', 'field' => 'status', 'width' => 12),
		array('title' => '核销码', 'field' => 'hexiaoma', 'width' => 12),
		array('title' => '核销员', 'field' => 'salerinfo', 'width' => 12),
		array('title' => '核销时间', 'field' => 'sendtime', 'width' => 24),
		array('title' => '核销场地', 'field' => 'storename', 'width' => 12),		
		array('title' => '交易单号', 'field' => 'transid', 'width' => 30)
	);
	
	if (checkplugin('seat')) $columns[] = array('title' => '座位', 'field' => 'seats', 'width' => 24);
	
	switch($status){
		case '0':$condition .= " AND status = 0";$title.='-待支付';break;
		case '1':$condition .= " AND review = 1 AND status IN (1,2)";$title.='-待参与';break;
		case '2':$condition .= " AND review = 1 AND status IN (1,2)";$title.='-待参与';break;
		case '3':$condition .= " AND status = 3";$title.='-已参与';break;
		case '5':$condition .= " AND status = 5";$title.='-已取消';break;
		case '6':$condition .= " AND status = 6";$title.='-待退款';break;
		case '7':$condition .= " AND status = 7";$title.='-已退款';break;
		case '8':$condition .= " AND review <> 1 AND status IN (1,2)";$title.='-待审核';break;
		default:$title.='-所有记录';
	}
	if (!empty($aid)){
		//自定义表单标题
		$forms = model_activity::getNumActivityForm($aid);
		foreach ($forms[0] as $key => $form) {			
			if (!empty($form['fieldstype'])){
				//常用表单
				if ($form['fieldstype']!='gender'){
					switch($form['fieldstype']){
						case 'qq':
						case 'email':
						case 'idcard':
						case 'studentid':$width = 20;break;
						case 'address':$width = 30;break;
						default:$width = 12;
					}
					$columns[] = array('title' => $form['title'], 'field' => $form['fieldstype'], 'width' => $width);
				}
			}else{
				//自定义表单
				$field = 'data_' . $key;
				switch($form['displaytype']){
					case '5':
					case '6':						
					case '12':$width = 90;break;
					case '10':$width = 20;break;
					default:$width = 12;
				}
				$columns[] = array('title' => $form['title'], 'field' => $field, 'width' => $width);
			}
		}
		unset($key);
		unset($form);
	}else{
		$columns[] = array('title' => '活动名称', 'field' => 'goods_title', 'width' => 24);
		$columns[] = array('title' => '商户名称', 'field' => 'merch_title', 'width' => 24);
	}	
	$columns = array_merge($columns, array(
		array('title' => '报名时间', 'field' => 'jointime', 'width' => 24),
		array('title' => '留言信息', 'field' => 'msg', 'width' => 30)
	));
	
	$columnCount = count($columns); 
	
	$pindex = max(1, intval($_GPC['page']));
	$psize  = intval($_W['_config']['output']['pagesize']) ? intval($_W['_config']['output']['pagesize']) : 200;//数据导出每个文件数据条数
	$order = "ORDER BY id DESC";
	$list   = pdo_fetchall ("SELECT * FROM " . tablename ('fx_activity_records') . " WHERE $condition $order LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
	$total  = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition");
	$tpage  = (empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);
	
	if ($total) {
		session_start();
		//$sheetName = ($pindex - 1) * $psize + 1 . '至' . (count($list) < $psize ? ($pindex - 1) * $psize + count($list) : $pindex * $psize) .' 条';
		//$objExcel = Excel::newPHPExcel($sheetName, $title, $columnCount, $columns);
		$exportlist = array();
		foreach ($list as $k => &$v) {
			$v['orderno'] = "\t".$v['orderno'];						
			$v['mobile'] = "\t".$v['mobile'];
			$v['transid'] = "\t".$v['transid'];
			$v['hexiaoma'] = "\t".$v['hexiaoma'];
			$v['seats'] = "\t".$v['seats'];
			$v['nickname'] = filterEmoji($v['nickname']);
			
			if ($v['price'] > 0) 
				$v['price'] =  $v['payprice'] > 0 ? $v['payprice'] : '0.00';
			else
				$v['price'] = 0;			
			
			$hexiao = m('member')->getMember($v['veropenid']);
			$v['salerinfo'] = $v['status'] == 3 ? (empty(filterEmoji($hexiao['nickname'])) ? '后台核销' : filterEmoji($hexiao['nickname'])) : '';
			
			$store = model_records::getSingleStore($v['storeid']);
			$v['storename'] = $store['storename'];
			
			if (!empty($aid)){
				$formdata_common = Util::getSingelData('*', 'fx_form_data_common', array('rid'=>$v['id']));
				$formdata_common = empty($formdata_common)?m('member')->getMember($v['openid']):$formdata_common;
				foreach ($forms[0] as $key => $form) {
					if (!empty($form['fieldstype'])){
						//常用表单
						if ($form['fieldstype']!='gender'){
							switch($form['fieldstype']){
								case 'age':$v['age'] = $formdata_common['age'].'岁';break;
								case 'birthyear':$v['birthyear'] = "\t".$formdata_common['birthyear'].'年'.$formdata_common['birthmonth'].'月'.$formdata_common['birthday'].'日';break;
								case 'resideprovince':$v['resideprovince'] = $formdata_common['resideprovince'].$formdata_common['residecity'].$formdata_common['residedist'];break;
								case 'qq':
								case 'studentid':
								case 'idcard':$v[$form['fieldstype']] = "\t".$formdata_common[$form['fieldstype']];break;
								default:$v[$form['fieldstype']] = $formdata_common[$form['fieldstype']];
							}
						}
					}else{
						//自定义表单
						$field = 'data_' . $key;
						$formdata = model_records::getSingleFormData($v['id'],$form['id']);
						if(in_array($form['displaytype'], array(5,6))){
							$imgs = '';
							//$pic_path = $temp_path.iconv('utf-8', 'gbk', '/相关图片');
							//mkdirs($pic_path);//创建目录			
							if ($formdata['data']!=""){
								foreach (explode(',',$formdata['data']) as $i => $pic) {
									//$pic_name = $form['displaytype']==5?$v['orderno']:$v['orderno'].'_'.($i+1);
									//getImage(tomedia($pic), $pic_path, $pic_name, 1);
									if ($i>0) $imgs .= "\r\n";
									$imgs .= tomedia($pic);									
								}
							}
							$v[$field] = $imgs;
						}elseif(in_array($form['displaytype'], array(3,10))){
							$v[$field] = "\t".$formdata['data'];
						}elseif($form['displaytype']==12){
							$v[$field] = "\t".tomedia($formdata['data']);
						}else{							
							$v[$field] = $form['displaytype'] == 7 || $form['displaytype'] == 8 || $form['displaytype'] == 11 ? str_replace(',','-',$formdata['data']) : $formdata['data'];
						}
					}
				}
			}else{
				$activity = model_activity::getSingleActivity($v['activityid'], 'title');
				$merch = model_merchant::getSingleMerchant($v['merchantid'], 'name');
				$v['goods_title'] = $activity['title'];
				$v['merch_title'] = $merch['name'];
			}
			switch($v['status']){
				case '0':$v['status'] = '待支付';break;
				case '1':
				case '2':$v['status'] = '待参与';break;
				case '3':$v['status'] = '已参与';break;
				case '5':$v['status'] = '已取消';break;
				case '6':$v['status'] = '待退款';break;
				case '7':$v['status'] = '已退款';break;
				default:$v['status'] = '已生效';break;
			}
			//Excel::fillExcelRow($objExcel, $data[$k], $k);
			$exportlist[] = $v;
		}
		$excelName = "data_" . $pindex;
		//Excel::saveExcelFile($objExcel, $excelName, $temp_path);
	}
	if (!empty($exportlist)) {
		$exflag = false;
	}
	else {
		$exflag = true;
	}
	m('excel')->exportCSV($exportlist, array('title' => $title, 'columns' => $columns), FX_DATA . '/order/', $pindex, $exflag);
	$res = array(
		'result'=>array(
			'tpage' => $tpage,
			'title' => $title,
			'temp_folder' => $temp_folder,
			'message'=>$tpage<=0?'没有可处理的记录！':'生成完毕'
		),
		'status'=>1
	);
	die(json_encode($res));
}

if ($_W['op'] == 'download') {
	$uniacid = $_W['uniacid'];
	$temp_folder = $_GPC['temp_folder'];
	$file_title  = charReplace($_GPC['file_title']);;
	Excel::getZipFile($temp_folder, $file_title, FX_DATA . "/files/temp_$uniacid/");
}

function hexiao() {
	global $_W,$_GPC;
	set_time_limit(0);
	ini_set('max_execution_time', 0);
	extract(orderData());
	$pindex = 1;
	$psize  = 1;//每页条数
	$condition = " uniacid = $uniacid AND status in(1,2)";
	if (!empty($aid)) {
		$condition .= " AND activityid = $aid";
	}
	if (!empty($keyword)) {
		$condition .= " AND (INSTR(`realname`, '$keyword') or INSTR(`mobile`, '$keyword') or INSTR(`nickname`, '$keyword') or INSTR(`optionname`, '$keyword') or hexiaoma='$keyword' or transid='$keyword' or uniontid='$keyword' or orderno='$keyword')";
	}
	$list  = pdo_fetchall("SELECT * FROM " . tablename ('fx_activity_records') . " WHERE $condition LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $condition");
	$tpage = (empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);
	foreach ($list as $k => $item) {
		model_records::orderAccount($item);//账目结算
		$data = array('payprice' => $item['price'], 'status' => 3, 'ishexiao' =>1, 'operation' => 'admin', 'sendtime'=>date('Y-m-d H:i:s',TIMESTAMP));
		$result = pdo_update ('fx_activity_records', $data, array ('id' => $item['id']));
		$activity = model_activity::getSingleActivity($item['activityid'], '*');
		//积分奖励
		if ($_W['_config']['creditstatus'] == 1 && $activity['prize']['sign_credit'] > 0) {
			$credit = intval($activity['prize']['sign_credit']);//赠送积分额度
			m('member')->credit_update_credit1($item['uid'], $credit, "核销获取" . $credit . m('member')->getCreditName('credit1'), $item['merchantid']);
		}
		$url = app_url('order/detail', array('id'=>$item['id'], 'type'=>'u')); // 核销通知
		message::hexiao_notice($item['openid'], $activity, $url);
	}
	$res = array(
	'result'=>array(
			'tpage' => $tpage,
			'message'=>$tpage<=0?'没有可处理的记录！':'处理完成！'
		),
		'status'=>1
	);
	die(json_encode($res));
}

function delete() {
	global $_W,$_GPC;
	$uniacid = $_W['uniacid'];
	load()->func('file');
	$id = intval($_GPC['id']);
	$ids = $_GPC['ids'];
	if (!is_array($ids)) $ids = array($id);
	$result = pdo_delete('fx_activity_records', array('id' => $ids));
	fun_delete($ids);
	web_json();
}

function order_refund() {
	global $_W,$_GPC;
	$id = intval($_GPC['id']);
	$ids = $_GPC['ids'];
	if (!is_array($ids)) $ids = array($id);
	foreach ($ids as $k => $id) {
		$item = model_records::getSingleRecords($id, '*');
		$url = app_url('order/detail',array('type'=>'u', 'id'=>$id));
		$res = model_records::refundMoney($id,$item['payprice'],'',2);
		if($res['status']){
			$item['status'] = 7;
			message::refund($item['openid'], $item, $url);// 退款通知			
		}else{
			web_json($res['message'], 0);
		}
	}
	web_json();
}

function review() {
	global $_W,$_GPC;
	$uniacid = $_W['uniacid'];
	$id = intval($_GPC['id']);
	$ids = $_GPC['ids'];
	if (!is_array($ids)) $ids = array($id);
	$result = pdo_update ('fx_activity_records', array('review' => 1), array ('id' => $ids));
	foreach ($ids as $k => $rid) {		
		$item = model_records::getSingleRecords($rid);
		$activity = model_activity::getSingleActivity($item['activityid'], '*');
		$merch = model_merchant::getSingleMerchant($activity['merchantid'], '*');//读取主办方
		$url = app_url('order/detail', array('id'=>$rid, 'type'=>'u')); // 审核通知
		//message::join_review($item['openid'], $activity, $review, $url);
		if($activity['smsnotify']['switch']){//短信通知
			$smsparams=array(
				'product' => $_W['_config']['sname'],
				'item'    => $activity['title'],
				'name'    => $item['realname'],
				'timestr' => date('m月d日 H:i',strtotime($activity['starttime'])),
				'idcode'  => $item['hexiaoma'],
				'address' => model_activity::getAddress($activity['id'])
			);
			$template_id = empty($activity['smsnotify']['join']) ? $_W['_config']['sms_notify'] : $activity['smsnotify']['join'];
			sendSMS($item['mobile'], $smsparams, $template_id, $_W['_config']['sms_type']);
		}
	}
	web_json();
}

//执行删除
function fun_delete($ids) {
	global $_W,$_GPC;
	$uniacid = $_W['uniacid'];
	load()->func('file');
	foreach ($ids as $k => $id) {
		$row = pdo_fetch("SELECT id,orderno,pic FROM " . tablename('fx_activity_records') . " WHERE id = $id");
		$qrcode = MODULE_ROOT .'/data/qrcode/' . $uniacid . '/' . $row['orderno'] . '.png';
		file_delete($row['pic']);
		file_delete($qrcode);
		pdo_delete('fx_activity_records', array('id' => $id));
		pdo_delete('core_paylog', array('tid' => $row['orderno']));
		pdo_delete('fx_form_data', array('recordid' => $id));
		pdo_delete('fx_form_data_common', array('rid' => $id));
	}
}