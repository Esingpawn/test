<?php 
defined('IN_IA') or exit('Access Denied');
function shop()
{
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
		web_json(array('message'=>'操作成功', 'url'=>web_url('sysset/shop', array('tab'=>$tab))));
	}
	include fx_template('sysset/index');
}