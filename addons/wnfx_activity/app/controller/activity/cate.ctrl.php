<?php
defined('IN_IA') or exit('Access Denied');
function main(){
	global $_W,$_GPC;
	$pagetitle  = '分类';
	$category = Util::getNumData('*', 'fx_category', array('enabled'=>1,'redirect'=>''), 'displayorder DESC',0,0,0);
	$children = array();
	if (!empty($category[0])) {
		foreach ($category[0] as $ci=>$v) {
			if (!empty($v['parentid'])){
				$children[$v['parentid']][] = $v;
				unset($category[0][$ci]);				
			}			
		}
	}
	include fx_template();
}