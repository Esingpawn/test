<?php 
defined('IN_IA') or exit('Access Denied');

function main()
{
	global $_W, $_GPC;
	if (perm('merch.user')) {
		header('location: ' . web_url('merch/user'));
	}elseif (perm('merch.check')) {
		header('location: ' . web_url('merch/apply/status1'));
	}elseif (perm('merch.set')) {
		header('location: ' . web_url('merch/set'));
	}else{
		header('location: ' . web_url());
	}
}