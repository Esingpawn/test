<?php 
defined('IN_IA') or exit('Access Denied');
function main()
{
	global $_W,$_GPC;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$condition = ' s.uniacid = :uniacid' . FX_MERCHANTID;
	$params = array(':uniacid' => $_W['uniacid']);
	if ($_GPC['status'] != '') {
		$condition .= ' and s.status = :status';
		$params[':status'] = $_GPC['status'];
	}

	if (!empty($_GPC['keyword'])) {
		$_GPC['keyword'] = trim($_GPC['keyword']);
		$condition .= ' and (m.realname like :keyword or m.mobile like :keyword or m.nickname like :keyword)';
		$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
	}

	$sql = 'SELECT s.*,m.nickname,m.avatar,m.realname FROM ' . tablename('fx_saler') . ' s ' . ' left join ' . tablename('mc_mapping_fans') . ' f on s.openid=f.openid and f.uniacid = s.uniacid' . ' left join ' . tablename('mc_members') . ' m on f.uid=m.uid and m.uniacid = s.uniacid ' . (' WHERE ' . $condition . ' ORDER BY id desc');
	$sql .= ' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;	
	$sql_count = 'SELECT count(1) FROM ' . tablename('fx_saler') . ' s ' . ' left join ' . tablename('mc_mapping_fans') . ' f on s.openid=f.openid and f.uniacid = s.uniacid' . ' left join ' . tablename('mc_members') . ' m on f.uid=m.uid and m.uniacid = s.uniacid ' . (' WHERE ' . $condition );
	
	$total = pdo_fetchcolumn($sql_count, $params);
	$pager = pagination($total, $pindex, $psize);
	$list  = pdo_fetchall($sql, $params);
	foreach ($list as $k=>&$s) {
		$storeid_arr = explode(',', $s['storeid']);
		$storename   = '';
		//所属门店
		foreach ($storeid_arr as $k => $v) {
			if ($v) {
				$store = pdo_fetch("select * from" . tablename('fx_store') . "where id='{$v}'");
				$storename .= $store['storename'] . "/";
			}
		}
		$s['storename'] = substr($storename, 0, strlen($storename) - 1);
		if ($s['merchantid']>0) 
			$s['merchname'] = pdo_fetchcolumn("SELECT name FROM " . tablename('fx_merchant') . " WHERE uniacid = '{$_W['uniacid']}' and id={$s['merchantid']}");
	}
	include fx_template();
}

function edit()
{
	global $_W,$_GPC;
	$id = intval($_GPC['id']);
	$item = pdo_fetch('SELECT * FROM ' . tablename('fx_saler') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));
	if (!empty($item)) {
		$saler = m('member')->getMember($item['openid']);
		$storeid_arr = explode(',', $item['storeid']);		
		foreach ($storeid_arr as $k=>$v) {
			if ($v) {
				$store[$k] = pdo_fetch("select * from" . tablename('fx_store') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'],':id' => $v));
			}
		}
				
		$merch = pdo_fetch('select id,name from ' . tablename('fx_merchant') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $item['merchantid'], ':uniacid' => $_W['uniacid']));
	}	
	if (empty($merch)){
		$merch['id'] = MERCHANTID;
		$merch['name'] = $_W['_config']['sname'];
	}
	
	if ($_W['ispost']) {
		load()->model('mc');
		$storeid = $_GPC['storeid'];		
		$openid = $_GPC['openid'];
		if (!empty($storeid)) {
			$storeid = implode(',',$storeid);
		}
		$data = array(
			'uniacid' => $_W['uniacid'],
			'openid'  => $openid,
			'storeid' => $storeid,
			'status'  => $_GPC['status'],
			'merchantid'=>$_GPC['merchid']
		);
		if (empty($data['openid'])) {
			web_json('请选择会员',0);
		}
		$uid  = mc_openid2uid($data['openid']);
		$info = mc_fetch($uid, array('nickname','avatar'));
		$data['avatar']   = $info['avatar'];
		$data['nickname'] = $info['nickname'];
		if ($id) {
			pdo_update('fx_saler', $data, array(
				'id' => $id
			));
		} else {
			pdo_insert('fx_saler', $data);
			$id = pdo_insertid();
		}
		web_json(web_url('store/saler'));
	}
	include fx_template();
}

function delete()
{
	global $_W,$_GPC;
	$id = intval($_GPC['id'])?intval($_GPC['id']):0;
	$ids = $_GPC['ids'];
	if(pdo_delete('fx_saler', array('id'=>empty($ids)?$id:$ids))){
		web_json();
	} else {
		web_json('删除失败', 0);
	}
}
function status()
{
	global $_W,$_GPC;
	$id = empty(intval($_GPC['id']))?$_GPC['ids']:intval($_GPC['id']);
	$status = intval($_GPC['status']);
	$result = pdo_update('fx_saler', array('status' => $status), array('id' => $id));
	web_json();
}