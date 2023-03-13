<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2050.
// | Describe: project
// | 移动端活动发布
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
if ($_W['account']->typeSign == 'account') {
	m('member')->getInfo();
}
$id = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
$pagetitle = '发起活动 - ' . $_W['_config']['sname'];
if($_W['op'] == 'display'){
	$pagetitle = '我的活动';
	include fx_template('member/project_list');
	exit;
}

if ($_W['op'] == 'post') {
	if (empty($_W['member']['mobile']) && $_W['_config']['bond']){
		header("Location:".app_url('member/bond/mobile',array('actype'=>'project')));
		exit;
	}
	if (MERCHANTID || ADMIN) $merchant = model_merchant::getSingleMerchant(MERCHANTID, '*');
	if (!$merchant['status']) {
		fx_message('抱歉，你的账户已禁用', app_url('member'), 'warning');
	}
	if (empty($merchant['logo']) || empty($merchant['name']) || empty($merchant['linkman_mobile']) || empty($merchant['linkman_name']) || empty($merchant['detail'])){
		fx_message('亲！您还没有完善信息哦&#9786', app_url('member/merch',array('opp'=>'data')), 'warning', '', '去完善&#9997');
	}
	//读取分类
	$category = Util::getNumData('name as text,id as value','fx_category',array('parentid'=>0,'enabled'=>1,'redirect'=>''),'displayorder DESC, id ASC',0,0,0);
	foreach($category[0] as $key=> &$s){
		$children = pdo_fetchall("SELECT name as text,id as value FROM " . tablename('fx_category') . " WHERE uniacid = {$_W['uniacid']} and parentid={$s['value']} and enabled=1 ORDER BY displayorder DESC");
		$s['children'] = $children;
	}
	fx_load()->func('attachment');
	if (!empty($id)) {
		$activity = model_activity::getSingleActivity($id, '*');
		if (empty($activity)) {
			fx_message('抱歉，主题不存在或是已经删除！', '', 'error');
		}		
		$sysform  = $activity['form'];
		$forms = model_activity::getNumActivityForm($id);//活动表单
		$specs = model_activity::getNumActivitySpec($id);//活动规格
	}
	if($activity['hasoption']){
		//处理常规价格范围
		$activity['minprice'] = pdo_fetch("SELECT min(marketprice) as aprice, min(costprice) as costprice FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$id);
		$activity['maxprice'] = pdo_fetch("SELECT max(marketprice) as aprice, max(costprice) as costprice FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$id);
	}
	if ($_W['ispost']) {
		$data = $_GPC['activity'];
		if (empty($data['title'])) {
			message ('请输入活动主题名称');
		}
		$data['thumbsize'] = serialize(igetimagesize(tomedia($data['thumb'])));
		$data['detail'] = htmlspecialchars_decode($data['detail']);
		$data['form'] = serialize($data['form']);
		$data['hasoption'] = empty($data['hasoption'])?0:$data['hasoption'];//开启规格
		$data['switch'] = serialize(array('avatar'=>1, 'joinnum'=>1));
		$aprice = $data['aprice'];//用来判断是否收费活动
		$otherdata = array (
			'uid' 	     => $_W['member']['uid'],
			'uniacid' 	 => $_W['uniacid'],
			'atlas' 	 => serialize($data['atlas']),
			'merchantid' => MERCHANTID,
			'hasstore'   => 1,
			'viewauth'   => 0,
			'review'     => perm('goods.senior.ischeck') ? 1 : 0
		);
		$data = array_merge($data,$otherdata);
		if (!empty($id)) {
			pdo_update ('fx_activity', $data, array (
					'id' => $id 
			));
		} else {
			pdo_insert ('fx_activity', $data);
			$id = pdo_insertid();
		}
		model_activity::UpdateForm($id,$_GPC);//更新表单
		if (!$_GPC['isSpecs']){
			model_activity::UpdateSpec($id,$_GPC);//更新规格
		}
		fx_message('发布成功！', app_url ('member/project'), 'success','','查看');
	}
	include fx_template('member/project');
}
//活动操作
if ($_W['op'] == 'operation') {
	if ($_W['isajax']) {
		$id = $_GPC['id'];
		if ($_GPC['type'] == 'setShow'){//设置活动上下线
			$show = $_GPC['show'];
			$result = pdo_update ('fx_activity', array('show' => $show), array ('id' => $id));
			die(json_encode(array('message' => $result ? '设置成功' : '设置失败')));
		}elseif($_GPC['type'] == 'copy') {//复制一个新的活动
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
			die(json_encode(array('message' => $result ? '操作成功,正在为您返回活动列表！' : '操作失败！')));
		}
	}else{
		$activity  = model_activity::getSingleActivity($id, '*');
		$pagetitle = $activity['title'];
		
		$favonum = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_favorite') . " WHERE $uniacid and favo=1 and activityid = $id");		
		$joinnum = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity_records') . " WHERE $uniacid and activityid=$id and (`status`<>0 or paytype='delivery') and `status` NOT IN(5,7)");
	}
	include fx_template('member/project_operation');
}
//读取活动列表
if($_W['op'] =='ajax'){
	$pindex = max(1, intval($_GPC['page']));		
	//当前页码
	$psize = max(1, intval($_GPC['psize']));
	$condition = " uniacid = '{$_W['uniacid']}'";
	$condition.= " and merchantid=" . MERCHANTID;
	$field = "*";
	$activity = pdo_fetchall ("SELECT $field FROM " . tablename ('fx_activity') . " WHERE $condition ORDER BY displayorder DESC,id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_activity') . " WHERE $condition");
	$merchant = model_merchant::getSingleMerchant(MERCHANTID, '*');
	foreach ($activity as &$s) {
		$s['switch'] = unserialize($s['switch']);
		$s['falsedata'] = unserialize($s['falsedata']);
		$s['falsedata']['num'] = intval($s['falsedata']['num']);
		$s['falsedata']['read'] = intval($s['falsedata']['read']);
		$s['falsedata']['share'] = intval($s['falsedata']['share']);
		$s['minaprice'] = 0;
		$condition = "activityid = {$s['id']} and (`status`<>0 or paytype='delivery') and `status` NOT IN(5,7)";
		$s['joinnum'] = pdo_fetchcolumn("SELECT SUM(buynum) FROM " . tablename('fx_activity_records') . " WHERE $condition");
		//读取规格名额
		if($s['hasoption']==1){
			$aprice['max'] = pdo_fetchcolumn("SELECT max(marketprice) as aprice FROM " . tablename('fx_spec_option') . " WHERE marketprice > 0 and activityid = " .$s['id']);
			$aprice['min'] = pdo_fetchcolumn("SELECT min(marketprice) as aprice FROM " . tablename('fx_spec_option') . " WHERE marketprice > 0 and activityid = " .$s['id']);
			$s['minaprice'] = !empty($aprice['min']) && $aprice['max'] > $aprice['min']?$aprice['min']:0;
			//读取规格总名额，总虚拟人数
			$opt['stock'] = pdo_fetchcolumn("SELECT SUM(stock) FROM " . tablename('fx_spec_option') . " WHERE activityid = " .$s['id']);
			$opt['nolimit'] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_spec_option') . " WHERE stock = 0 and activityid = ".$s['id']);
			$opt['falsenum'] = pdo_fetchcolumn("SELECT SUM(falsenum) FROM " . tablename('fx_spec_option') . " WHERE activityid = ".$s['id']);
			if ($opt['nolimit']){
				$s['gnum'] = 0;
			}else{
				$s['gnum'] = $opt['stock'];
			}
			$s['falsedata']['num'] = $opt['falsenum'] ? $opt['falsenum'] : 0;
		}
		$s['joinnum'] = !empty($s['joinnum'])?$s['joinnum']+$s['falsedata']['num']:0+$s['falsedata']['num'];
		//读取商户信息
		$s['merchant']  = $merchant;
		$s['merchant']['logo'] = tomedia($merchant['logo']);
		if ($s['hasstore']){//判断位置是否活动中定义
			$s['merchant']['storename'] = $s['addname'];
			$s['merchant']['address'] = $s['address'];
			$s['merchant']['lng'] = $s['lng'];
			$s['merchant']['lat'] = $s['lat'];
		}elseif (is_array(unserialize($s['storeids']))){//判断活动门店
				$stores = model_activity::getNumActivityStore(explode(',', $s['storeids']));
				$s['merchant']['storename'] = $stores[0]['storename'];
		}
	}	
	//array_merge数组拼接
	$data['list'] = $activity;
	$data['total'] = $total;
	$data['tpage']=(empty($psize) || $psize < 0) ? 1 : ceil($total / $psize);
	die(json_encode($data));
}