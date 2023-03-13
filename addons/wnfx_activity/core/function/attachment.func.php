<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18 
 * attachment_
 */
defined('IN_IA') or exit('Access Denied');

function attachment_id($filepath) {
	global $_W;
	$attachment = pdo_get('core_attachment', array('attachment' => $filepath), array('id'));
	if (empty($attachment))
	{
		$attachment['id'] = 0;
	}
	return $attachment['id'];
}
function attachment_uid($filepath) {
	global $_W;
	$attachment = pdo_get('core_attachment', array('attachment' => $filepath), array('uid'));
	if (empty($attachment))
	{
		$attachment['id'] = 0;
	}
	return $attachment['uid'];
}