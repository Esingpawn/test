<?php
/**
 * [woniu] Copyright (c) 2016/8/18
 * register.ctrl
 * 注册控制器
 */
defined('IN_IA') or exit('Access Denied');
$pagetitle = '完善主办信息';
$actype = $_GPC['actype'];
$username = trim($_GPC['username']);
$password = trim($_GPC['password']);
if($_W['op'] =='merchant'){
	$pagetitle = '完善主办信息';
	$mode = trim($_GPC['mode']);
	if ($_W['ispost']){
		load()->model('mc');
		$sql = 'SELECT `uid` FROM ' . tablename('mc_members') . ' WHERE `uniacid`=:uniacid';
		$pars = array();
		$pars[':uniacid'] = $_W['uniacid'];
		$code = trim($_GPC['code']);
		if (empty($username)) {
			fx_message('手机不能为空', '', 'error', '点击确定返回');
		}
		if(preg_match(REGULAR_MOBILE, $username)) {
			$type = 'mobile';
			$sql .= ' AND `mobile`=:mobile';
			$pars[':mobile'] = $username;
		} else {
			fx_message('手机号不合法', referer(), 'error', '点击确定重新输入');
		}
		
		if(!empty($_W['openid'])) {
			$fan = mc_fansinfo($_W['openid']);
			if (!empty($fan)) {
				$map_fans = $fan['tag'];
			}
			if (empty($map_fans) && isset($_SESSION['userinfo'])) {
				$map_fans = unserialize(base64_decode($_SESSION['userinfo']));
			}
		}
		if(!empty($map_fans)) {
			$data['nickname'] = $map_fans['nickname'];
			$data['gender'] = $map_fans['sex'];
			$data['residecity'] = $map_fans['city'] ? $map_fans['city'] . '市' : '';
			$data['resideprovince'] = $map_fans['province'] ? $map_fans['province'] . '省' : '';
			$data['nationality'] = $map_fans['country'];
			$data['avatar'] = rtrim($map_fans['headimgurl'], '0') . 132;
		}
		if (!empty($_W['member']['uid'])){
			$user['uid'] = $_W['member']['uid'];
			$result = mc_update($user['uid'], array('mobile'=>$username));
		}
		if($result) {
			if ($actype=='project'){
				fx_message('手机绑定成功', app_url('member/project/post'), 'success', '恭喜您，现在可以发起活动了');
			}else{
				fx_message('手机绑定成功', app_url('member'), 'success', '');
			}
		}else{
			fx_message('绑定失败', '', 'error', '');
		}
		exit;
	}
}
include fx_template('member/setting');                                                                   