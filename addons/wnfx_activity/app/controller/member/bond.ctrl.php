<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * login.ctrl
 * 收藏控制器
 */
defined('IN_IA') or exit('Access Denied');
if ($_W['account']->typeSign == 'account' && $_W['fans']['nickname'] == '') {
	m('member')->getInfo();
}
$pagetitle = '用户登录';
$actype = $_GPC['actype'];
$username = trim($_GPC['username']);
$password = trim($_GPC['password']);
if($_W['op'] =='mobile'){
	$pagetitle = $actype=='project'?'手机验证':'手机绑定';
	$mode = trim($_GPC['mode']);
	$member = m('member')->getMember($_W['openid']);
	$_W['fans']['avatar'] = $_W['fans']['headimgurl'] = $member['avatar'];
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
		
		if(empty($_W['fans']['uid'])){//用户不存在自动注册
			m('member')->autoRegister();
		}
		if (!empty($_W['fans']['uid'])){
			$result = mc_update($_W['fans']['uid'], array('mobile' => $username));
		}
		
		if($result) {
			if ($actype=='project'){
				fx_message('手机绑定成功', app_url('member/project/post'), 'success', '');
			}elseif ($actype=='merch'){
				fx_message('手机绑定成功', app_url('member/merch'), 'success', '');
			}else{
				fx_message('手机绑定成功', app_url('member'), 'success', '');
			}
		}else{
			fx_message('绑定失败', '', 'error', '');
		}
		exit;
	}
}
include fx_template('member/bond');