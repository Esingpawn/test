<?php
defined('IN_IA') or exit('Access Denied');
$_SESSION['role']='';
isetcookie('__fx_session', '', -7 * 86400, true);
isetcookie('__merchantid', '', -7 * 86400, true);
@header('Location: ' . $_W['siteroot'] . 'addons/'.IN_MODULE.'/web/merch.php?i='.$_W['uniacid']);