<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 */
defined('IN_IA') or exit('Access Denied');

if (defined('IN_MOBILE')) {
	fx_load()->app('tpl');	
} else {
	fx_load()->web('tpl');
}