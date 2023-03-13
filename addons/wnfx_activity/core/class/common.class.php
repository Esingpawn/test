<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: common
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
class common
{
	static function keyExist($key = '')	{
		global $_W;

		if (empty($key)) {
			return NULL;
		}

		$keyword = pdo_fetch('SELECT * FROM ' . tablename('rule_keyword') . ' WHERE content=:content and uniacid=:uniacid limit 1 ', array(':content' => trim($key), ':uniacid' => $_W['uniacid']));

		if (!empty($keyword)) {
			$rule = pdo_fetch('SELECT * FROM ' . tablename('rule') . ' WHERE id=:id and uniacid=:uniacid limit 1 ', array(':id' => $keyword['rid'], ':uniacid' => $_W['uniacid']));

			if (!empty($rule)) {
				return $rule;
			}
		}
	} 
}