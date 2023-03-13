<?php 
defined('IN_IA') or exit('Access Denied');
function main()
{
	global $_W, $_GPC;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$where=array();
	if($_GPC['keyword']) $where['id^uname^name^linkman_name^linkman_mobile'] = $_GPC['keyword'];
	$mcert = intval($_GPC['mcert']);
	if ($mcert) {
		switch($mcert){
		case 1:
			$where['sql'][] = '(select count(1) as num from '.tablename ('fx_merchant_mcert') . ' B where '.tablename ('fx_merchant').'.id = B.mid) = 0 ';
			break;
		case 2:
			$where['sql'][] = '(select count(1) as num from '.tablename ('fx_merchant_mcert') . ' B where '.tablename ('fx_merchant').'.id = B.mid AND B.status=1) > 0 ';
			break;
		case 3:
			$where['sql'][] = '(select count(1) as num from '.tablename ('fx_merchant_mcert') . ' B where '.tablename ('fx_merchant').'.id = B.mid AND B.status=0) > 0 ';
			break;
		case 4:
			$where['sql'][] = '(select count(1) as num from '.tablename ('fx_merchant_mcert') . ' B where '.tablename ('fx_merchant').'.id = B.mid AND B.status=2) > 0 ';
			break;
		case 5:
			$where['sql'][] = '(select count(1) as num from '.tablename ('fx_merchant_mcert') . ' B where '.tablename ('fx_merchant').'.id = B.mid AND B.status=1 AND UNIX_TIMESTAMP()>B.endtime) > 0 ';
			break;
		}
	}	
	$merchData = Util::getNumData('*', 'fx_merchant', $where, 'id desc', $pindex,$psize,1);
	$list = $merchData[0];
	$pager = $merchData[1];
	
	foreach($list as $key=>&$s){
		$account =  pdo_fetch("SELECT amount,no_money FROM ".tablename('fx_merchant_account')." WHERE uniacid = {$_W['uniacid']} and merchantid={$s['id']}");
		$delivery = pdo_fetchcolumn("select SUM(price) from".tablename('fx_activity_records')." where (paytype='delivery' or paytype='admin') and status in(3) and merchantid={$s['id']}");
		
		$s['amount'] = sprintf("%.2f", $account['amount']);
		$s['no_money'] = sprintf("%.2f", $account['no_money']);		
		$s['delivery'] = sprintf("%.2f", $delivery);
		$s['percent'] = sprintf("%.2f", $s['percent']);
		$s['mcert'] = Util::getSingelData('*', 'fx_merchant_mcert', array('mid' => $s['id']));
	}
	include fx_template();
}
function delete() {//删除主办方
	global $_W, $_GPC;
	$id = intval($_GPC['id'])?intval($_GPC['id']):0;
	$ids = $_GPC['ids'];
	if(pdo_delete('fx_merchant', array('id'=>empty($ids)?$id:$ids))){
		web_json();
	} else {
		web_json('删除主办方失败', 0);
	}
}
function query() {
	global $_W, $_GPC;
	$kwd = trim($_GPC['keyword']);
	$params = array();
	$params[':uniacid'] = $_W['uniacid'];
	$condition = 'uniacid=:uniacid AND status=1';
	
	if (!empty($kwd)) {
		$condition .= ' AND `name` LIKE :keyword';
		$params[':keyword'] = '%' . $kwd . '%';
	}
	
	$ds = pdo_fetchall('SELECT * FROM ' . tablename('fx_merchant') . (' WHERE ' . $condition . ' order by id asc'), $params);
	include fx_template();
	exit;
}

function add()
{
	post();
}
function edit()
{
	post();
}

function post() {
	global $_W, $_GPC;
	$id = intval($_GPC['id'])?intval($_GPC['id']):MERCHANTID;
	$tab = empty($_GPC['tab'])?'basic':str_replace('#tab_', '', $_GPC['tab']);
	$no_left = MERCHANTID ? true : false;
	$_W['page']['title'] = '编辑商户';
	
	$item = pdo_fetch('select * from ' . tablename('fx_merchant') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
	if(!empty($item)){
		$binduid = $item['uid'];	
		$bindmember = m('member')->getMember($item['uid']);
		$user = m('member')->getMember($item['openid']);
		$openids = unserialize($item['messageopenid']);
		if (is_array($openids)){
			foreach($openids as $key=>$openid){
				$members[] = m('member')->getMember($openid);
			}
		}else{
			$members=array();
		}
		$mcert = Util::getSingelData('*', 'fx_merchant_mcert', array('mid' => $id));
		if (!empty($mcert)) $mcert['detail'] = unserialize($mcert['detail']);
	}
	
	if ($_W['ispost']) {
		$data = $_GPC['merchant']; // 获取打包值
		$data_img = $_GPC['data_img'];
		$data_tag = $_GPC['data_tag'];
		$data_status = $_GPC['data_status'];
		$len = count($data_img);
		$data['tag'] = array();
		for ($k = 0; $k < $len; $k++) {
			$data['tag'][$k]['data_img'] = $data_img[$k];
			$data['tag'][$k]['data_tag'] = $data_tag[$k];
			$data['tag'][$k]['data_status'] = $data_status[$k];
		}
		$data['tag'] = serialize($data['tag']);
		$data['detail'] = htmlspecialchars_decode($data['detail']);
		$data['messageopenid'] = serialize($_GPC['openids']);
		$data['allsalenum'] = intval($data['salenum'])  + $data['falsenum'];
		if (!MERCHANTID) {
			$data['openid'] = $_GPC['openid']; 
			$data['uid'] = $_GPC['uid']; 
			$binduid = $data['uid'];
		}
		if(empty($item)){
			$data['uniacid'] = $_W['uniacid'];
			$data['createtime'] = TIMESTAMP;
			  
			if($data['open']==1){
				load()->model('user');
				fx_load()->model('merchant');
				if(!preg_match(REGULAR_USERNAME, $data['uname'])) {
					web_json('必须输入用户名，格式为 3-15 位字符，可以包括汉字、字母（不区分大小写）、数字、下划线和句点。', 0);
				}
				if(merchant_check(array('uname' => $data['uname']))) {
					web_json('非常抱歉，此用户名已经被注册，你需要更换注册名称！', 0);
				}else{
					$tpwd = trim($_GPC['tpwd']);
					$data['password'] = trim($data['password']);
					if(empty($data['password']) || empty($tpwd)){
						web_json('密码不能为！空', 0);
					}
					if($data['password']!=$tpwd){
						web_json('两次密码输入不一致！', 0);
					}
					if(istrlen($data['password']) < 8) {
						web_json('必须输入密码，且密码长度不得低于8位！', 0);
					}
				}
			}
			$data['password'] = user_hash($data['password'], '');
			pdo_insert('fx_merchant', $data);
			$id = pdo_insertid();
		} else {
			$user = pdo_fetch("select * from".tablename("users")."where uid=:uid",array(':uid'=>$item['uid']));
			$opwd = trim($_GPC['opwd']);
			$npwd = trim($_GPC['npwd']);
			$tpwd = trim($_GPC['tpwd']);
			if($data['open']==2){
				//$ret = pdo_update('users', array('status'=>1), array('uid'=>$item['uid']));
			}else{
				if(empty($npwd)|| empty($tpwd)){
				}else{
					if($npwd!=$tpwd){
						web_json('两次密码输入不一致！', 0);
					}
					if(istrlen($npwd) < 8) {
						web_json('必须输入密码，且密码长度不得低于8位致！', 0);
					}
					$data['password'] = user_hash($npwd, '');
				}
				
			}
			$ret = pdo_update('fx_merchant', $data, array('id'=>$id));
		}
		$mcertdata = $_GPC['mcert'];
		if (!empty($mcertdata['status'])){
			load()->model('mc');			
			$mcertdata['detail'] = serialize($mcertdata['detail']);
			$mcertdata['uniacid'] = $_W['uniacid'];
			$mcertdata['openid'] = mc_uid2openid($binduid);
			$mcertdata['mid'] = $id;
			$mcertdata['status'] = $mcertdata['status'];
			$mcertdata['createtime'] = TIMESTAMP;
			$mcertdata['endtime'] = strtotime("+1 year", TIMESTAMP);
					
			if (!empty($mcert)) {
				$result = pdo_update('fx_merchant_mcert', $mcertdata, array('mid' => $id));
			} else {
				$result = pdo_insert('fx_merchant_mcert', $mcertdata);
			}
		}
		web_json(array('message'=>'操作成功', 'url'=>web_url('merch/user/edit', array('id'=>$id, 'tab'=>$tab))));
	}
	include fx_template();
}

function status() {
	global $_W, $_GPC;
	$id = empty(intval($_GPC['id']))?$_GPC['ids']:intval($_GPC['id']);
	$status = intval($_GPC['status']);
	$result = pdo_update('fx_merchant', array('status' => $status), array('id' => $id));
	web_json();
}