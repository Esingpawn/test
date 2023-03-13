<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * 蜗牛科技
 */
defined('IN_IA') or exit('Access Denied');
$opp = !empty($_GPC['opp']) ? $_GPC['opp'] : 'display';

if ($_W['op'] == 'display') {
	$_W['page']['title'] = '会员列表 - 会员 - 会员中心';
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$condition = " a.uniacid={$_W['uniacid']} ";
	$params = array();
	$type = intval($_GPC['type']);
	$keyword = trim($_GPC['keyword']);
	$groups = mc_groups($_W['uniacid']);
	if (!empty($keyword)) {
		$condition .= ' and ( a.realname like :keyword or a.nickname like :keyword or a.mobile like :keyword or a.uid like :keyword)';
		$params[':keyword'] = '%' . $keyword . '%';
	}
	$join = '';
	if ($_GPC['groupid'] != '') {
		$condition .= ' and find_in_set(' . intval($_GPC['groupid']) . ', groupid) ';
	}
	
	if ($_GPC['iscommission'] != '') {		
		if ($_GPC['iscommission'] == 0) {
			$condition .= ' and (g.is_pass<>1 or gg.member_id IS NULL)';
			$join .= ' left outer join ' . tablename('fx_agents') . ' gg on gg.member_id=a.uid';
		}else {
			$condition .= ' and g.is_pass=1';
		}
		$join .= ' left join ' . tablename('fx_agents') . ' g on g.member_id=a.uid';
	}
	
	if ($_GPC['followed'] != '') {
		if ($_GPC['followed'] == 2) {
			$condition .= ' and f.follow=0 and f.unfollowtime<>0';
		}else if ($_GPC['followed'] == 1) {
			$condition .= ' and f.follow=' . intval($_GPC['followed']);
		}else {
			$condition .= ' and f.follow=' . intval($_GPC['followed']) . ' and f.unfollowtime=0 ';
		}
		$join .= ' left join ' . tablename('mc_mapping_fans') . ' f on f.uid=a.uid';
	}
	
	if (!empty($_GPC['datelimit']['start']) && !empty($_GPC['datelimit']['end'])) {
		$starttime = strtotime($_GPC['datelimit']['start']);
		$endtime = strtotime($_GPC['datelimit']['end']);
		$condition .= ' AND a.createtime >= :starttime AND a.createtime <= :endtime ';
		$params[':starttime'] = $starttime;
		$params[':endtime'] = $endtime;
	}
	
	if ($_GPC['isblack'] != '') {
		if ($_GPC['isblack'] == 0) {
			$condition .= ' and (bb.uid IS NULL or b.isblack=' . intval($_GPC['isblack']).')';
			$join .= ' left outer join ' . tablename('fx_member') . ' bb on bb.uid=a.uid';
		}else{
			$condition .= ' and b.isblack=' . intval($_GPC['isblack']);
		}
		$join .= ' left join ' . tablename('fx_member') . ' b on b.uid=a.uid';
	}
	$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('mc_members')." a ".$join." WHERE $condition", $params);
	$sql = "SELECT a.* FROM " . tablename ('mc_members') . " a ". $join . " WHERE $condition ORDER BY `credit1` DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
	$list = pdo_fetchall ($sql, $params);
	$pager = pagination($total, $pindex, $psize);
	$list_black = array();
	$list_agent = array();
	$list_uid = array();
	$list_fans = array();
	
	foreach ($list as $val) {
		$list_uid[] = trim($val['uid'], ',');
		$list_fans[] = trim($val['openid'], ',');
	}
	if (!empty($list_uid)) {
		$res_fans = pdo_fetchall('select uid,fanid,openid,follow,unfollowtime from ' . tablename('mc_mapping_fans') . ' where uid in (\'' . implode('\',\'', $list_uid) . '\') and uniacid = :uniacid', array('uniacid' => $_W['uniacid']), 'uid');
		$res_black = pdo_fetchall('select uid,isblack from ' . tablename('fx_member') . ' where uid in (\'' . implode('\',\'', $list_uid) . '\') and uniacid = :uniacid', array('uniacid' => $_W['uniacid']), 'uid');
		if ($_W['plugin']['poster']['config']['commission_enable'])
		$res_agent = pdo_fetchall('select is_pass as isagent,member_id as agentid,parent_id from ' . tablename('fx_agents') . ' where member_id in (\'' . implode('\',\'', $list_uid) . '\') and uniacid = :uniacid', array('uniacid' => $_W['uniacid']), 'agentid');
	}
	
	foreach ($list as &$s) {
		$s['group'] = $groups[$s['groupid']];		
		$s['isblack'] = isset($res_black[$s['uid']]) ? $res_black[$s['uid']]['isblack'] : '';
		$s['follow'] = isset($res_fans[$s['uid']]) ? $res_fans[$s['uid']]['follow'] : '';
		$s['unfollowtime'] = isset($res_fans[$s['uid']]) ? $res_fans[$s['uid']]['unfollowtime'] : '';
		$s['fanid'] = isset($res_fans[$s['uid']]) ? $res_fans[$s['uid']]['fanid'] : '';
		
		$s['isagent'] = isset($res_agent[$s['uid']]) ? $res_agent[$s['uid']]['isagent'] : '';
		$s['agentid'] = isset($res_agent[$s['uid']]) ? $res_agent[$s['uid']]['agentid'] : '';
		$s['parent_id'] = isset($res_agent[$s['uid']]) ? $res_agent[$s['uid']]['parent_id'] : '';
				
		$s['ordercount'] = pdo_fetchcolumn('select count(*) from ' . tablename('fx_activity_records') . ' where uniacid=:uniacid and uid=:uid and status=3', array(':uniacid' => $_W['uniacid'], ':uid' => $s['uid']));
		$s['ordermoney'] = pdo_fetchcolumn('select sum(payprice) from ' . tablename('fx_activity_records') . ' where uniacid=:uniacid and uid=:uid and status=3', array(':uniacid' => $_W['uniacid'], ':uid' => $s['uid']));
		if ($s['parent_id']) {
			$s['agent'] = m('member')->getMember($s['parent_id']);
		}
	}
	include fx_template();
}

if ($_W['op'] == 'credit_record') {
	$uid = $_GPC['uid'];
	load()->model('mc');
	$member = mc_fetch($uid);
	$type = trim($_GPC['type']) ? trim($_GPC['type']) : 'credit1';
	$pindex = max(1, intval($_GPC['page']));//当前页码
	$psize = 50;//设置分页大小
	$total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('mc_credits_record') . ' WHERE uid = :uid AND uniacid = :uniacid AND credittype = :credittype ', array(':uniacid' => $_W['uniacid'], ':uid' => $uid, ':credittype' => $type));
	$credits_records = pdo_fetchall("SELECT * FROM " . tablename('mc_credits_record') . ' WHERE uid = :uid AND uniacid = :uniacid AND credittype = :credittype ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize .',' . $psize, array(':uniacid' => $_W['uniacid'], ':uid' => $uid, ':credittype' => $type));
	$pager = pagination($total, $pindex, $psize);
	$modules = pdo_getall('modules', array('issystem' => 0), array('title', 'name'), 'name');
	$modules['card'] = array('title' => '会员卡', 'name' => 'card');
	include fx_template('member/member');
	exit;
}

if ($_W['op'] == 'selectmember') {
	$con     = "A.uniacid='{$_W['uniacid']}' and A.uid = B.uid ";
	$keyword = $_GPC['keyword'];
	if ($keyword != '') {
		$con .= " and (A.nickname LIKE '%{$keyword}%' or B.openid LIKE '%{$keyword}%') ";
	}
	$field  = "A.uid, A.nickname, avatar, B.openid";
	$inner  = tablename ('mc_members') . "A , " . tablename ('mc_mapping_fans') . "B ";
	$ds = pdo_fetchall("select ".$field." from" . $inner . "where $con");
	include fx_template('member/query_member');
	exit;
}

if ($_W['op'] == 'setblack') {
	$id = intval($_GPC['id']);
	if (empty($id)) {
		$id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
	}
	$black = intval($_GPC['isblack']);
	$member = pdo_fetchall('select * from ' . tablename('fx_member') . (' WHERE uid in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);
	if(!empty($member)){
		$result = pdo_update('fx_member', array('isblack' => $black), array('uid' => $id));
	}else{
		$result = pdo_insert ('fx_member', array (
			'uid' => $id,
			'uniacid' => $_W['uniacid'],
			'isblack' => $black
		));
	}
	if ($result)
		web_json();
	else
		web_json('操作失败！', 0);
}
function detail(){
	global $_W, $_GPC;
	$uid = intval($_GPC['id']);
	$member = m('member')->getMember($uid);
	if ($_W['ispost']) {
		$data = is_array($_GPC['data']) ? $_GPC['data'] : array();
		$member = array_merge($member, $data);
		mc_update($uid, $member);
		pdo_update('fx_member', array('isblack'=>$_GPC['isblack']), array('uid' => $uid, 'uniacid' => $_W['uniacid']));
		web_json();
	}
	$groups = mc_groups($_W['uniacid']);	
	$join .= ' left join ' . tablename('fx_agents') . ' b on g.member_id=a.uid';	
	$m = pdo_fetch('SELECT * FROM ' . tablename('fx_member') . " a ". (' WHERE a.uid=' . $uid . ' AND a.uniacid=') . $_W['uniacid']);
	$member['isblack'] = $m['isblack'];
	$member['ordercount'] = pdo_fetchcolumn('select count(*) from ' . tablename('fx_activity_records') . ' where uniacid=:uniacid and uid=:uid and status=3', array(':uniacid' => $_W['uniacid'], ':uid' => $uid));
	$member['ordermoney'] = pdo_fetchcolumn('select sum(payprice) from ' . tablename('fx_activity_records') . ' where uniacid=:uniacid and uid=:uid and status=3', array(':uniacid' => $_W['uniacid'], ':uid' => $uid));
	$order = pdo_fetch('select sendtime from ' . tablename('fx_activity_records') . ' where uniacid=:uniacid and uid=:uid and status=3 Limit 1', array(':uniacid' => $_W['uniacid'], ':uid' => $uid));
	$member['last_ordertime'] = strtotime($order['sendtime']);
	$group = $groups[$member['groupid']];
	
	include fx_template();
}