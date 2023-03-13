<?php
$_W['uniacid'] = $_GPC['i'];
if ($_W['ispost']) {
	_login();
}else{
	$modules = uni_modules();
	$module = $modules[IN_MODULE];
	$set = $module['config'];
	$set['merch_logo'] = empty($set['merch_logo']) ? FX_PATH . 'web/resource/images/logo/login-logo.png' : $set['merch_logo']; 
	$set['merch_loginbg'] = empty($set['merch_loginbg']) ? FX_PATH . '/web/resource/images/bg-login.png' : $set['merch_loginbg']; 
	include fx_template('merch/manage/login');	
}

function _login() {
	global $_GPC, $_W;
	$username = trim($_GPC['username']);
	$password = trim($_GPC['password']);
    $verify = trim($_GPC['verify']);
	if(empty($_W['uniacid'])) {
        web_json('登录入口缺少对应平台参数："i"', 0);
    }
    if(empty($username)) {
		$_W['merch_error'] = 1;
        web_json('请输入账户名！',0);
    }
    if(empty($password)) {
		$_W['merch_error'] = 1;
        web_json('请输入密码！', 0);
    }
     if(empty($verify)) {
        //message('请输入验证码！', '', 'error');
    }
    //$result = checkcaptcha($verify);
    if (empty($result)) {
       // message('验证码错误，请重新输入！', '', 'error');
    }
    $record = __user_single($username, $password);
	if (!empty($record)) {
		$_W['uniacid'] = $record['uniacid'];
		$cookie = array();
		$cookie['uid'] = $record['uid'];
		$cookie['fx_mall']['merch_id'] = $record['id'];
		$cookie['fx_mall']['uniacid'] = $record['uniacid'];
		$session = base64_encode(json_encode($cookie));
		isetcookie('__fx_session', $session, !empty($_GPC['rember']) ? 7 * 86400 : 43200, true);
		isetcookie('__merchantid', $record['id'], 7 * 86400, true);
		isetcookie('__uid', $record['uid'], 7 * 86400, true);
		isetcookie('__uniacid', $_W['uniacid'], 7 * 86400, true);
		isetcookie('__role', 'merchant', 7 * 86400, true);
		isetcookie('__role_id',$record['id'], 7 * 86400, true);
		isetcookie('__role_name',$record['name'], 7 * 86400, true);
		isetcookie('__role_logo', $record['logo'], 7 * 86400, true);
		
		$modules = uni_modules();
		$_W['current_module'] = $modules[IN_MODULE];
		$_W['_config'] = $_W['current_module']['config'];
		$_W['setting']['copyright']['blogo'] = empty($_W['_config']['merch_logo']) ? $_W['setting']['copyright']['blogo'] : $_W['_config']['merch_logo'];
		
		web_json(array('message'=>"欢迎回来{$record['uname']}！", 'url'=>$_W['siteroot'] . 'addons/wnfx_activity/web/merch.php?do=web&r=activity'));
	} else {
		$_W['merch_error'] = 1;
		web_json('登录失败，请检查您的账号和密码，或者您的商户没有被授权！', 0);
	}
}

function __user_single($username, $password) {
    global $_W;
    $sql = "SELECT * FROM ".tablename('fx_merchant')." WHERE uniacid=:uniacid and uname=:uname and open=:open";
    $params = array(
		':uniacid'=>$_W['uniacid'],
        ':uname' => $username,
		 ':open' => 1
    );
    $record = pdo_fetch($sql, $params);
    if (empty($record)) {
        return false;
    }
	$password = user_hash($password, $record['salt']);
    if ($password != $record['password']) {
        return false;
    }
    return $record;
}
