<?php
defined('IN_IA') or exit('Access Denied');
function main() {
	global $_W,$_GPC;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 10;
	$keyword = $_GPC['keyword'];
	$uniacid = "uniacid = '{$_W['uniacid']}'";
	$condition = "$uniacid";
	$merchid = MERCHANTID ? MERCHANTID : $_GPC['merchantid'];
	$category  = model_category::getNumCategory();
	
	if (!empty($keyword)) {
		$m = pdo_fetchcolumn("select group_concat(id) from".tablename('fx_merchant')."where INSTR(`name`, '{$keyword}') and $uniacid");
		if(!empty($m)) {
			$search_merch = " or merchantid in ($m)";
		}
		
		if(strpos($_W['_config']['sname'], $keyword) !== false){
			$search_merch .= " or merchantid = 0";
		}
		$condition .= " AND (title LIKE '%{$keyword}%' or id='{$keyword}'".$search_merch.")";
	}
	
	if (!empty($_GPC['cate'])){
		$condition .= " AND (parentid = '{$_GPC['cate']}' or childid = '{$_GPC['cate']}')";
	}
	
	if ($merchid) {//商家筛选
		$condition .= " AND merchantid=$merchid";
	}
	
	$totals = model_activity::getTotals($condition);
	
	$type = empty($_GPC['type'])?'sale':$_GPC['type'];
	switch($type){
		case "out":$condition .= " AND UNIX_TIMESTAMP()>UNIX_TIMESTAMP(endtime) AND `show`=1 AND cycle=0 AND review=1";break;
		case "stock":$condition .= " AND `show`=0 AND cycle=0 AND review=1";break;
		case "cycle":$condition .= " AND cycle=1 AND review=1";break;
		case "verify":$condition .= " AND review in (0,2) AND cycle=0";break;
		default:
			$condition .= " AND UNIX_TIMESTAMP()<UNIX_TIMESTAMP(endtime) AND `show`=1 AND cycle=0 AND review=1";
			break;
	}
	$activity = pdo_fetchall ("SELECT * FROM " . tablename ('fx_activity') . " WHERE $condition ORDER BY displayorder DESC,joinetime DESC,id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
	//读取规格名额
	foreach ($activity as $k=>&$s) {
		if($s['hasoption']==1){
			//读取规格总名额，总虚拟人数
			$opt['stock'] = pdo_fetchcolumn("SELECT SUM(stock) FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$s['id']);
			$opt['nolimit'] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_spec_option') . " WHERE stock = 0 and activityid = ".$s['id']);
			$opt['falsenum'] = pdo_fetchcolumn("SELECT SUM(falsenum) FROM " . tablename('fx_spec_option') . " WHERE activityid = ".$s['id']);
			if ($opt['nolimit']){
				$s['gnum'] = 0;
			}else{
				$s['gnum'] = $opt['stock'];
			}
		}
		$catemode = model_category::getMode(array($s['parentid'],$s['childid']));
		$s['catename'] = $catemode['name'];
		$s['sales'] = (int)pdo_fetchcolumn('SELECT SUM(buynum) FROM ' . tablename('fx_activity_records') . " WHERE activityid = ".$s['id']);
		$s['buynum'] = (int)pdo_fetchcolumn('SELECT SUM(buynum) FROM ' . tablename('fx_activity_records') . " WHERE activityid = ".$s['id']." and (status = 1 or status = 2 or status=3)");
		$s['amount'] = pdo_fetchcolumn("SELECT sum(payprice) FROM ".tablename('fx_activity_records') . " WHERE status in (1,3,6) and activityid = ".$s['id']);
		$s['amount'] = number_format(floatval($s['amount'] ),2);
		$s['thumb'] = tomedia($s['thumb']);
		$s['qrcode'] = createQrcode::createverQrcode(app_url('activity/detail', array('id' => $s['id'])), $s['merchantid'], $s['id'], "activity");
		if ($s['merchantid']>0) 
			$s['merchname'] = pdo_fetchcolumn("SELECT name FROM " . tablename('fx_merchant') . " WHERE uniacid = '{$_W['uniacid']}' and id={$s['merchantid']}");
	}
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity') . " WHERE $condition");
	$pager = pagination($total, $pindex, $psize);
	include fx_template();
}

function down() {
	global $_W, $_GPC;
	$id  = $_GPC['id'];
	$res = pdo_fetch('SELECT * FROM ' . tablename('fx_activity') . ' WHERE `id`=:id AND `uniacid`=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
	$filename = $res['title'];
	$qr_pic = tomedia("addons/wnfx_activity/data/qrcode/".$_W['uniacid']."/activity/ver_qrcode_".$res['merchantid']."_$id.png");
	if ($_W['account']->typeSign == 'wxapp'){
		$qr_pic = tomedia("addons/wnfx_activity/data/qrcode/".$_W['uniacid']."/activity/ver_qrcode_".$res['merchantid']."_$id.jpg");
	}
	header('cache-control:private');
	header('content-type:image/jpeg');
	header('content-disposition: attachment;filename="'.$filename.'.jpg"');
	readfile($qr_pic);
}

function delete() {
	global $_W,$_GPC;
	$id = intval($_GPC['id']);
	$ids = $_GPC['ids'];
	$result = pdo_update('fx_activity', array('cycle' => 1), array('id' => empty($ids)?$id:$ids));
	web_json();
}

function delete1() {
	global $_W,$_GPC;
	$id = intval($_GPC['id']);
	$ids = $_GPC['ids'];
	if (!empty($ids)) {
		foreach ($ids as $v) {
			fun_delete($v);
		}
	}else{
		fun_delete($id);
	}
	$result = pdo_delete('fx_activity', array('id' => empty($ids)?$id:$ids));
	web_json();
}

function restore() {
	global $_W,$_GPC;
	$id = intval($_GPC['id']);
	if (empty($id)) {
		$id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
	}
	$items = pdo_fetchall('SELECT id,title FROM ' . tablename('fx_activity') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);
	foreach ($items as $item) {
		pdo_update('fx_activity', array('cycle' => 0), array('id' => $item['id']));
	}
	web_json();
}

function copyitem() {
	global $_W,$_GPC;
	$id = $_GPC['id'];
	$field = "uid,uniacid,concat('请编辑！',title),pagetitle,aprice,sharetitle,sharepic,sharedesc,tel,intro,detail,starttime,endtime,joinstime,joinetime,thumb,atlas,gnum,lng,lat,adinfo,addname,address,prize,form,displayorder,limitnum,hasoption,0,smsnotify,parentid,childid,recommend,viewauth,review,openids,tmplmsg,merchantid,storeids,hasstore,agreement,info,falsedata,hasonline,unitstr,gnumshow,switch,atype,iscard,signin,cycle,thumbsize,seatid";
	$fieldto = "uid,uniacid,title,pagetitle,aprice,sharetitle,sharepic,sharedesc,tel,intro,detail,starttime,endtime,joinstime,joinetime,thumb,atlas,gnum,lng,lat,adinfo,addname,address,prize,form,displayorder,limitnum,hasoption,`show`,smsnotify,parentid,childid,recommend,viewauth,review,openids,tmplmsg,merchantid,storeids,hasstore,agreement,info,falsedata,hasonline,unitstr,gnumshow,switch,atype,iscard,signin,cycle,thumbsize,seatid";
	$result = pdo_query("insert into " . tablename('fx_activity') . "($fieldto) select $field from " . tablename ('fx_activity') . " where id= $id;");
	$insertid = pdo_insertid();
	if ($insertid){
		$forms = model_activity::getNumActivityForm($id);//活动表单
		foreach ($forms[0] as $form) {//复制自定义表单
			pdo_query("insert into " . tablename('fx_form') . "(uniacid,title,description,displaytype,content,activityid,displayorder,essential,fieldstype) select uniacid,title,description,displaytype,content,$insertid,displayorder,essential,fieldstype from " . tablename ('fx_form') . " where id = ".$form['id'].";");
			$tihsid = pdo_insertid();
			pdo_query("insert into " . tablename('fx_form_item') . "(uniacid,formid,title,`show`,content,displayorder) select uniacid,$tihsid,title,`show`,content,displayorder from " . tablename ('fx_form_item') . " where formid= ".$form['id'].";");
		}
		
		$specs = model_activity::getNumActivitySpec($id);//活动规格
		foreach ($specs[0] as $spec) {//复制规格
			pdo_query("insert into " . tablename('fx_spec') . "(uniacid,title,content,activityid,displayorder,essential) select uniacid,title,content,$insertid,displayorder,essential from " . tablename ('fx_spec') . " where id = ".$spec['id'].";");
			$tihsid = pdo_insertid();
			pdo_query("insert into " . tablename('fx_spec_item') . "(uniacid,specid,title,`show`,displayorder) select uniacid,$tihsid,title,`show`,displayorder from " . tablename ('fx_spec_item') . " where specid= ".$spec['id'].";");
		}
	}
	if ($result)
		web_json(web_url('activity',array('type'=>'stock')));
	else
		web_json('操作失败',0);
}

function query(){
	global $_W, $_GPC;
	$keyword = $_GPC['keyword'];
	$id      = $_GPC['id'];
	$con     = "uniacid='{$_W['uniacid']}'";
	
	if ($keyword != '') {
		$con .= " and title LIKE '%{$keyword}%' ";
	}
	$ds = pdo_fetchall("select id,title,thumb from" . tablename('fx_activity') . "where $con ORDER BY displayorder DESC, id DESC");
	
	foreach ($ds as &$value) {
		$value['thumb'] = tomedia($value['thumb']);
	}
	include fx_template();
}

function property()
{
	global $_W, $_GPC;
	$id = intval($_GPC['id']);
	$type = $_GPC['type'];
	$data = intval($_GPC['value']);
	
	if (empty($id)) {
		$id = is_array($_GPC['ids']) ? $_GPC['ids'] : 0;
	}
	
	if (in_array($type, array('new', 'hot', 'recommend', 'discount', 'time', 'sendfree', 'nodiscount', 'hasonline', 'show', 'review'))) {
		$items = pdo_getall('fx_activity', array('uniacid' => $_W['uniacid'], 'id'=>$id));
		foreach ($items as $item) {
			pdo_update('fx_activity', array($type => $data), array('id' => $item['id']));
		}
		
		if ($type == 'new') {
			$typestr = '新品';
		}else if ($type == 'hot') {
			$typestr = '热卖';
		}else if ($type == 'recommend') {
			$typestr = '推荐';
		}else if ($type == 'discount') {
			$typestr = '促销';
		}else if ($type == 'time') {
			$typestr = '限时卖';
		}else if ($type == 'sendfree') {
			$typestr = '包邮';
		}else if ($type == 'hasonline') {
			$typestr = '线上';
		}else if ($type == 'show') {
			$typestr = '上下架';
		}else if ($type == 'review') {
			$typestr = '审核';
			
			foreach ($items as $k => $item) {
				$merch = model_merchant::getSingleMerchant($item['merchantid'], '*');//读取主办方
				$openids  = unserialize($merch['messageopenid']);
				$openids  = !empty($openids) ? $openids : $_W['_config']['openids'];
				$url = app_url('activity/detail',array('activityid'=>$item['id']));
				if (!empty($openids)){
					foreach($openids as $key=> $openid){
						message::activity_review($openid, $item, $data, $url);
					}
				}
			}
		}else {
			if ($type == 'nodiscount') {
				$typestr = '不参与折扣状态';
			}
		}
		//载入日志函数
		load()->func('logging');
		logging_run($_W['routes'], '修改活动' . $typestr . '状态   ID: ' . $id);
	}
	web_json();
}

//删除相关数据
function fun_delete($id) {
	global $_W,$_GPC;
	$activity = model_activity::getSingleActivity($id, '*');
	$forms = model_activity::getNumActivityForm($id);//活动表单
	$specs = model_activity::getNumActivitySpec($id);//活动规格
	foreach ($forms[0] as $form) {
		pdo_delete('fx_form_item', array ('formid' => $form['id']));
	}
	
	pdo_delete('fx_form', array ('activityid' => $id));
	foreach ($specs[0] as $spec) {
		pdo_delete ('fx_spec_item', array ('specid' => $spec['id']));
	}
	pdo_delete ('fx_spec_option', array ('activityid' => $id));
	pdo_delete ('fx_spec', array ('activityid' => $id));
	
	load()->func('file');
	$filepath[] = MODULE_ROOT .'/data/qrcode/' . $_W['uniacid'] . '/signin/' . 'ver_qrcode_' . $activity['midkey'] . '_' . $id . '.png';
	foreach ($filepath as $v) {
		if(file_exists($v)) file_delete($v);	
	}
	$rmdirspath[] = MODULE_ROOT .'/data/qrcode/' . $_W['uniacid'] . '/poster/' . $id;
	foreach ($rmdirspath as $v) {
		if(file_exists($v)) rmdirs($v);
	}
}