<?php 
defined('IN_IA') or exit('Access Denied');

function main()
{
	
}
function updatelogin()
{
	global $_W, $_GPC;
	$no_left = true;
	
	$item = model_merchant::getSingleMerchant(MERCHANTID, '*');
	if ($_W['ispost']) {
		$password = trim($_GPC['password']);
		$newpassword = trim($_GPC['newpassword']);
		$surenewpassword = trim($_GPC['surenewpassword']);
		strlen($newpassword) < 6 && web_json('密码至少是6位!', 0);
		$newpassword != $surenewpassword && web_json('两次输入密码不一致!', 0);
		$item['password'] != user_hash($password, '') && web_json('原密码输入不正确!', 0);
		//$date = array('salt' => random(8));
		$newpassword = user_hash($newpassword, '');
		$date['password'] = $newpassword;
		pdo_update('fx_merchant', $date, array('id' => MERCHANTID, 'uniacid' => $_W['uniacid']));
		web_json();
	}

	include fx_template();
}

function logout()
{
	global $_W;
	global $_GPC;
	isetcookie('__merch_' . $_W['uniacid'] . '_session', 0);
	isetcookie('__uniacid', 0);
	isetcookie('__acid', 0);
	isetcookie('__fx_session', '', -7 * 86400, true);
	isetcookie('__merchantid', '', -7 * 86400, true);
	unset($_SESSION['__merch_uniacid']);
	//header('location: ' . web_url('login') . '&i=' . $_W['uniacid']);
	@header('Location: ' . $_W['siteroot'] . 'addons/'.IN_MODULE.'/web/merch.php?i='.$_W['uniacid']);
	exit();
}

function plugins(){
	global $_W,$_GPC;
	$uniacid = $_W['uniacid'];
	$aid = intval($_GPC['aid'])?intval($_GPC['aid']):0;
	$group_plugin = pdo_fetchall('SELECT type FROM ' . tablename('modules') . ' WHERE name LIKE :name GROUP BY type', array(':name' =>"%fx_activity_plugin%"));
	foreach ($group_plugin as &$v) {
		$v['mod'] = pdo_getall('modules', array('name LIKE' => "%fx_activity_plugin%", 'type'=>$v['type']));
		foreach ($v['mod'] as $k => $m) {
			switch($m['name']){
				case 'fx_activity_plugin_poster' :
				case PLUGIN_POSTER :
					if (!perm('poster')) unset($v['mod'][$k]);
					break;
				case 'fx_activity_plugin_babycard' :
				case PLUGIN_CARD:
					if (!perm('vipcard')) unset($v['mod'][$k]);
					break;
				case 'fx_activity_plugin_seat' :
				case PLUGIN_SEAT:
					if (!perm('seat')) unset($v['mod'][$k]);
					break;
			}
		}
		switch($v['type']){
			case "business ":
				$v['type'] = '业务类';
				break;
			case "activity":
				$v['type'] = '营销类';
				break;
			case "services":
				$v['type'] = '工具类';
				break;
			case "biz":
				$v['type'] = '辅助类';
				break;
			case "enterprise":
				$v['type'] = '企业类';
				break;
			case "h5game":
				$v['type'] = '游戏';
				break;
			default:
				$v['type'] = '其它';
				break;
		}
	}
	$result = pdo_update('modules', array('wxapp_support' => 2), array('name LIKE' => "%fx_activity_plugin%"));
	if ($result) cache_clean();
	include fx_template();
}