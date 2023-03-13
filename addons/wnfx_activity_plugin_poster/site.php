<?php
/**
 * 活动报名模块微站定义
 *
 * @author 微链网络科技
 * @url https//www.sxwelink.com/
 */
defined('IN_IA') or exit('Access Denied');
define("MODULE_NAME", "wnfx_activity");
define("MODULE_PLUGIN_NAME", "wnfx_activity_plugin_poster");
require IA_ROOT . '/addons/' . MODULE_NAME . '/core/common/defines.php';
require FX_CORE . '/class/loader.class.php';
$autoload = FX_CORE . '/class/autoload.php';
if(file_exists($autoload)) require $autoload;
fx_load()->func('global');
fx_load()->func('template');
load()->func('tpl');
class Wnfx_activity_plugin_posterModuleSite extends WeModuleSite {
	public $settings;
	public $op;
	
	public $orderModel;
	
	public function __construct() {
		global $_W,$_GPC;
		$this->op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';		
		$modules = uni_modules();		
		$module = $modules[MODULE_PLUGIN_NAME];
		$this->settings = $module['config'];
		
		if ($_GPC['route']=='api') {
			$this->orderModel = CommissionOrder::handler($this->settings);
		}
	}

	public function doWebPoster() {
		global $_W,$_GPC;
		$op = $this->op;
		if ($op == 'display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 10;
			$order = "id DESC";
			$search_type = intval($_GPC['search_type']) == 1 || intval($_GPC['search_type']) == 0 ? '1' : '2';
			$where = array();
			if (!empty($_GPC['keyword'])){
				if ($search_type == 1) {
					$where['name'] = $_GPC['keyword'];
				}else{
					$where['@name@'] = $_GPC['keyword'];
				}
			}
			$getNumData = Util::getNumData('*', 'fx_poster', $where, $order, $pindex, $psize, 1);
			$list = $getNumData[0];
			$pager = $getNumData[1];
		}elseif ($op == 'post') {
			$id = intval($_GPC['id']);
			$poster = Util::getSingelData('*', 'fx_poster', array('id'=>$id));
			if (!empty($poster)) {
				$img_data = unserialize($poster['imgdata']);
				$text_data = unserialize($poster['textdata']);
				$bgimg = $_W['setting']['remote']['type'] ? tomedia($poster['thumb']) : ATTACHMENT_ROOT . $poster['thumb'];
				list($bg_w, $bg_h, $bg_type) =  getimagesize($bgimg);
				$boxH = round(320 / $bg_w * $bg_h);
				for ($c = 0; $c < 7; $c++) {
					if (empty($text_data['color'][$c])){
						array_unshift($text_data['color'], $poster['rgb']);
					}else{
						if (!is_array($text_data['color'][$c])){
							$text_data['color'][$c] = $poster['rgb'];
						}else{
							$text_data['color'][$c] = implode(',',$text_data['color'][$c]);
						}
					}
				}
			}
			if ($_W['ispost']){
				$data  = $_GPC['poster'];
				$param = $_GPC['param'];
				$data['uniacid'] = $_W['uniacid'];
				$data['createtime'] = TIMESTAMP;
				$data['textdata'] = serialize(array(
					'x'=>array($param['nickname']['x'], $param['title']['x'], $param['time']['x'], $param['add']['x'], $param['realname']['x'], $param['idcode']['x'], $param['endtime']['x']),
					'y'=>array($param['nickname']['y'], $param['title']['y'], $param['time']['y'], $param['add']['y'], $param['realname']['y'], $param['idcode']['y'], $param['endtime']['y']),
					'w'=>array($param['nickname']['w'], $param['title']['w'], $param['time']['w'], $param['add']['w'], $param['realname']['w'], $param['idcode']['w'], $param['endtime']['w']),
					'size'=>array($param['nickname']['size'], $param['title']['size'], $param['time']['size'], $param['add']['size'], $param['realname']['size'], $param['idcode']['size'], $param['endtime']['size']),
					'color'=>array(
						empty($param['nickname']['color'])?explode(',',$data['rgb']):explode(',',$param['nickname']['color']), 
						empty($param['title']['color'])?explode(',',$data['rgb']):explode(',',$param['title']['color']), 
						empty($param['time']['color'])?explode(',',$data['rgb']):explode(',',$param['time']['color']), 
						empty($param['add']['color'])?explode(',',$data['rgb']):explode(',',$param['add']['color']), 
						empty($param['realname']['color'])?explode(',',$data['rgb']):explode(',',$param['realname']['color']), 
						empty($param['idcode']['color'])?explode(',',$data['rgb']):explode(',',$param['idcode']['color']),
						empty($param['endtime']['color'])?explode(',',$data['rgb']):explode(',',$param['endtime']['color']), 
					),
					'show'=>array(
						intval($param['nickname']['show']),
						intval($param['title']['show']),
						intval($param['time']['show']),
						intval($param['add']['show']),
						intval($param['realname']['show']),
						intval($param['idcode']['show']),
						intval($param['endtime']['show'])
					)
				));
				$data['imgdata'] = serialize(array(
					'x'=>array($param['head']['x'], $param['pic']['x'], $param['qr']['x']),
					'y'=>array($param['head']['y'], $param['pic']['y'], $param['qr']['y']),
					'w'=>array($param['head']['w'], $param['pic']['w'], $param['qr']['w']),
					'h'=>array($param['head']['h'], $param['pic']['h'], $param['qr']['h']),
					'show'=>array(intval($param['head']['show']),intval($param['pic']['show']),intval($param['qr']['show']))
				));
				if (!$id){
					pdo_insert('fx_poster', $data);
					$rid = pdo_insertid();
				}else{
					pdo_update ('fx_poster', $data, array ('id' => $id));
					$rid = $id;
				}
				message ('更新成功！', $this->createWeburl('poster', array('version_id'=>$_GPC['version_id'])), 'success');
			}
		}elseif ($op == 'enable' && $_W['isajax']) {
			$id = $_GPC['id'];
			$enable = $_GPC['enable'];
			$result = pdo_update ('fx_poster', array('enable' => $enable), array ('id' => $id));
			die(json_encode(array('message' => $result ? '设置成功' : '设置失败')));
		}elseif ($op == 'copy') {
			$id = intval($_GPC['id']);
			$field = "uniacid,name,thumb,textdata,imgdata,hex,rgb,enable,gname,goodsid";
			$fieldto = "uniacid,name,thumb,textdata,imgdata,hex,rgb,enable,gname,goodsid";
			$result = pdo_query("insert into " . tablename('fx_poster') . "($fieldto) select $field from " . tablename ('fx_poster') . " where id= $id;");
			$insertid = pdo_insertid();
			die(json_encode(array('message' => $result ? '操作成功' : '操作失败')));			
		}elseif ($op == 'delete' && $_W['isajax']) {
			$id = $_GPC['id'];
			if (!is_array($id)){
				$id = intval($id);
				$poster = Util::getSingelData('id', 'fx_poster', array('id'=>$id));
				if (empty($poster)) {
					die(json_encode(array("errno" => 0,'message'=>'抱歉，记录不存在或是已经被删除！')));
				}

				pdo_delete('fx_poster', array('id' => $id));
				die(json_encode(array("errno" => 0,'message'=>'删除成功')));
			}else{
				foreach ($id as $k => $bid) {
					$bid = intval($bid);
					$poster = Util::getSingelData('id', 'fx_poster', array('id'=>$bid));
					if (empty($poster)) {
						die(json_encode(array("errno" => 0,'message'=>'抱歉，记录不存在或是已经被删除！')));
					}	
					pdo_delete('fx_poster', array('id' => $bid));
				}
				die(json_encode(array("errno" => 0, 'message'=>'删除成功')));
			}
		}elseif ($op == 'selectgoods' && $_W['isajax']) {
			$con     = "uniacid='{$_W['uniacid']}'";
			$keyword = $_GPC['keyword'];
			if ($keyword != '') {
				$con .= " and title LIKE '%{$keyword}%' ";
			}
			$goods = pdo_fetchall("select id,title from" . tablename('fx_activity') . "where $con ORDER BY displayorder DESC, id DESC");
			include fx_template('select_goods');
			exit;
		}
		include fx_template('poster');
	}
	public function doWebOrder() {
		global $_W,$_GPC;
		$op = $this->op;
		if ($op=='display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$order = "id DESC";
			$search = $_GPC['search'];
			$search['membertype'] = intval($search['membertype']) > 0 ? $search['membertype'] : 0;
			$condition = " uniacid = '{$_W['uniacid']}'";
			$where = array();
			if (!empty($search)){
				if (trim($search['member'])!=''){
					$w['sql'][] = "mobile='".$search['member']."' or uid='".$search['member']."' or nickname LIKE '%".$search['member']."%'";
					$membersData = Util::getNumData('uid', 'mc_members', $w, 'uid DESC', 1, 1, 0);
					if (!empty($membersData[0])){
						foreach ($membersData[0] as $v) {
							$member[] = $v['uid'];
						}
					}else{
						$member[] = -1;
					}
					$uids = implode(',',$member);
					if ($search['membertype'] == 0) {
						$where['sql'][] ="buy_id IN (".$uids.") or member_id IN (".$uids.") ";
						$condition .= " AND buy_id in (".$uids.") or member_id in (".$uids.")";
					}elseif ($search['membertype'] == 1){
						$where['#buy_id'] = "(".$uids.")";
						$condition .= " AND buy_id in (".$uids.")";
					}else{
						$where['#member_id'] = "(".$uids.")";
						$condition .= " AND member_id in (".$uids.")";
					}
				}
				if (trim($search['order'])!=''){
					$where['order_sn'] = $search['order'];
				}
				if (trim($search['hierarchy'])!=''){
					$where['hierarchy'] = $search['hierarchy'];
				}
			}
			$status = trim($_GPC['status']);			
			$total = array();
			if ($status!="") {
				if (intval($status) == 2){
					$total3 = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE uniacid = '{$_W['uniacid']}' and status = 2 and withdraw = 0");
					$total4 = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE uniacid = '{$_W['uniacid']}' and status = 2 and withdraw = 1");
				}
				if (intval($status) == 3){
					$where['withdraw'] = 0;
					$status = 2;
					$condition .= " and withdraw=0";
				}
				if (intval($status) == 4){
					$where['withdraw'] = 1;
					$status = 2;
					$condition .= " and withdraw=1";
				}
				$condition .= " and status=$status";
				$where['status'] = $status;
			}else{
				$total0 = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE uniacid = '{$_W['uniacid']}' and status = 0");
				$total1 = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE uniacid = '{$_W['uniacid']}' and status = 1");
				$total2 = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE uniacid = '{$_W['uniacid']}' and status = 2");
				$total3 = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE uniacid = '{$_W['uniacid']}' and status = 2 and withdraw = 0");
				$total4 = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE uniacid = '{$_W['uniacid']}' and status = 2 and withdraw = 1");
			}
			
			$total['coms'][] = pdo_fetchcolumn('SELECT SUM(commission) FROM ' . tablename('fx_commission_order') . " WHERE $condition");
			$total['coms'][] = pdo_fetchcolumn('SELECT SUM(commission_amount) FROM ' . tablename('fx_commission_order') . " WHERE $condition");
			$total['coms'][] = $_GPC['status']=='0' ? $total['coms'][0] : $total0;
			$total['coms'][] = $_GPC['status']=='1' ? $total['coms'][0] : $total1;
			$total['coms'][] = $_GPC['status']=='2' ? $total['coms'][0] : $total2;
			$total['coms'][] = $_GPC['status']=='3' ? $total['coms'][0] : $total3;
			$total['coms'][] = $_GPC['status']=='4' ? $total['coms'][0] : $total4;
			$getNumData = Util::getNumData('*', 'fx_commission_order', $where, $order, $pindex, $psize, 1);
			$list = $getNumData[0];
			$pager = $getNumData[1];
			fx_load()->model('member');
			foreach ($list as $k => &$item) {
				$item['member'] = getMember($item['buy_id']);
				$item['parentMember'] = getMember($item['member_id']);
				$item['commission_rate'] = $item['commission_rate'] .'%';
			}
		}elseif($op=='edit' && $_W['isajax']){
			pdo_update ('fx_commission_order', array('commission'=>$_GPC['commission']), array ('id' => $_GPC['id']));
			die(json_encode(array("result" => 0, 'msg'=>'佣金修改成功')));
		}
		include fx_template('commission_order');
	}
	public function doWebAgent() {
		global $_W,$_GPC;
		$op = $this->op;
		$set = $this->settings;
		$member_id = intval($_GPC['uid']);
		if (strpos($op,'display') !== false) {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$order = "id DESC";
			$search = $_GPC['search'];
			$where = array();
			if (!empty($search)){
				$search['membertype'] = intval($search['membertype']) > 0 ? $search['membertype'] : 0;
				$keywords = $search['member'];
				if (trim($search['member'])!=''){
					if (!empty($keywords)){
						$uid = mc_openid2uid($keywords);
						$keywords = empty($uid) ? $keywords : $uid;
						$w['sql'][] = "(mobile='".$keywords."' or uid='".$keywords."' or nickname LIKE '%".$keywords."%' or realname LIKE '%".$keywords."%')";
					}
					$membersData = Util::getNumData('uid', 'mc_members', $w, 'uid DESC', 1, 1, 0);
					if (!empty($membersData[0])){
						foreach ($membersData[0] as $v) {
							$member[] = $v['uid'];
						}
					}else{
						$member[] = -1;
					}
					
					$uids = implode(',',$member);
					if ($search['membertype'] == 0) {
						$where['sql'][] = "(member_id in ($uids) or parent_id in($uids))";
					}elseif ($search['membertype'] == 1){					
						$where['#parent_id'] = "(".$uids.")";
					}else{
						$where['#member_id'] = "(".$uids.")";
						$where['parent_id'] = 0;
					}
				}
				if ($search['follow']!='') {
					$where['sql'][] = "member_id IN(SELECT uid FROM " . tablename('mc_mapping_fans') . " WHERE follow=1)";
				}
				if ($search['is_black']!="") $where['is_black'] = $search['is_black'];
			}
			
			if ($member_id) $where['parent_id'] = $member_id;
			
			if (strpos($op,'pass') !== false) {
				$where['is_pass'] = 0;
			}else{
				$where['is_pass'] = 1;
			}
			$nopass =  pdo_getcolumn("fx_agents",array('is_pass'=>0,'uniacid'=>$_W['uniacid']), 'COUNT(*)');
			$getNumData = Util::getNumData('*', 'fx_agents', $where, $order, $pindex, $psize, 1);
			
			$list = $getNumData[0];
			$pager = $getNumData[1];
			$total = $getNumData[2];
			fx_load()->model('member');
			$condition = " uniacid = '{$_W['uniacid']}'";
			foreach ($list as $k => &$s) {
				$s = array_merge($s, Agents::getLower($s['member_id'], $set['level']));
				$s['member'] = getMember($s['member_id']);
				$s['parentMember'] = getMember($s['parent_id']);
				$s['created_at'] = date('Y.m.d', $s['created_at']);
			}
			
			if (strpos($op,'pass') !== false) {
				include fx_template('agent_list_pass');
				exit;
			}
			
			if (strpos($op,'lower') !== false) {
				$member = getMember($member_id);
				$lower = Agents::getLower($member_id, $set['level']);
				include fx_template('agent_lower');
				exit;
			}
			include fx_template('agent_list');	
		}elseif($op=='edit' && $_W['isajax']){
			if ($_GPC['is_unlock']) {
				$is_pass = 1;
				if ($set['become']) {
					$is_pass = 0;//总店需要审核
				}		
				pdo_query("UPDATE ".tablename('fx_agents')." SET `parent_id`=0,`parent`=0,`is_pass`=".$is_pass.",`del`=1 WHERE FIND_IN_SET(".$_GPC['id'].",`parent`)=1");							
				pdo_query("UPDATE ".tablename('fx_agents')." SET parent = left(parent,locate(',".$_GPC['id']."',parent)-1) where parent like '%,".$_GPC['id']."%' and FIND_IN_SET(".$_GPC['id'].",parent)>1");
				pdo_update('fx_agents', array('parent_id'=>0,'parent'=>0,'is_pass'=>$is_pass,'del'=>1), array ('member_id' => $_GPC['id']));
			}else{
				pdo_update ('fx_agents', array('is_black'=>$_GPC['is_black']), array ('id' => $_GPC['id']));
			}
			die(json_encode(array("result" => 0, 'msg'=>'操作成功')));
		}elseif($op=='pass' && $_W['isajax']){
			$result = pdo_update ('fx_agents', array('is_pass'=>1), array ('member_id' => $_GPC['id']));
			if ($result) {
				$openid = mc_uid2openid($_GPC['id']);				
				if ($set['commission_api']) {
					$commission_url = app_url('commission', array('op'=>'display'), 'wnfx_activity_plugin_poster');
				}else{
					$commission_url = $_W['siteroot']."addons/yun_shop/?menu=#/member/extension?i=".$_W['uniacid'];
				}
				sendCustomNotice($openid,'您好，您的推广身份审核通过.\n',$commission_url,'');
			}
			die(json_encode(array("result" => 0, 'msg'=>'操作成功')));
		}elseif($op=='detail'){
			$agent = Agents::getAgent($member_id);
			fx_load()->model('member');
			$agent['member'] = getMember($member_id);
			$agent['created_at'] =  date('Y-m-d H:i:s', $agent['created_at']);
			include fx_template('agent_info');
			exit;
		}elseif(strpos($op,'post') !== false && $_W['ispost']){
			$id = intval($_GPC['id']);
			$result = Agents::updateAgent($id);
			message ('操作完成', web_url('agent', array('op'=>'detail','uid'=>$member_id)), 'success');
		}
	}
	public function doWebWithdraw() {
		global $_W,$_GPC;
		$op = $this->op;
		if ($op=='display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$order = "id DESC";
			$search = $_GPC['search'];
			$where = array();
			if (!empty($search)){
				$keywords = $search['member'];
				if (trim($search['member'])!=''){
					if (!empty($keywords)){
						$uid = mc_openid2uid($keywords);
						$keywords = empty($uid) ? $keywords : $uid;
						$w['sql'][] = "mobile='".$keywords."' or uid='".$keywords."' or nickname LIKE '%".$keywords."%' or realname LIKE '%".$keywords."%'";
					}
					$membersData = Util::getNumData('uid', 'mc_members', $w, 'uid DESC', 1, 1, 0);
					if (!empty($membersData[0])){
						foreach ($membersData[0] as $v) {
							$member[] = $v['uid'];
						}
					}else{
						$member[] = -1;
					}
					$uids = implode(',',$member);
					$where['#member_id'] = "(".$uids.")";	
				}
				if (trim($search['withdraw_sn'])!=''){
					$where['withdraw_sn'] = trim($search['withdraw_sn']);
				}
			}
			
			$status = trim($_GPC['status']);
			if ($status!="") {
				$where['status'] = $status;
			}
			$getNumData = Util::getNumData('*', 'fx_withdraw', $where, $order, $pindex, $psize, 1);
			
			$list = $getNumData[0];
			$pager = $getNumData[1];
			$total = $getNumData[2];
			fx_load()->model('member');
			foreach ($list as $k => &$item) {
				$item['member'] = getMember($item['member_id']);
				$item['pay_way_name'] = Withdraw::getPayname($item['pay_way']);
				$item['created_at'] = date('Y-m-d H:i:s', $item['created_at']);
				$item['status_name'] = $item['status']?($item['status']==1?'未打款':'已打款'):'待审核';
			}
			include fx_template('withdraw');
		}elseif(strpos($op,'detail') !== false){
			$id = intval($_GPC['id']);
			$item = Withdraw::getWithdraw($id);
			$item['agent']  = Agents::getAgent($item['member_id']);
			$item['incomes'] = pdo_getall('fx_member_income', array('id' => explode(',', $item['type_id'])));
			$item['income_total'] =  pdo_getcolumn("fx_member_income",array('id' => explode(',', $item['type_id'])), 'COUNT(*)');
			foreach ($item['incomes'] as $k => &$s) {
				$s['created_at'] = date('Y-m-d H:i:s', $s['created_at']);
				$s['status_name'] = $s['status']?'已提现':'未提现';
				switch ($s['pay_status']) {
					case '0':
						$pay_status_name = '未审核';
						break;
					case '1':
						$pay_status_name = '未打款';
						break;
					case '2':
						$pay_status_name = '已打款';
						break;
					case '3':
						$pay_status_name = '已驳回';
						break;
					default:
						$pay_status_name = '无效';
				}
				$s['pay_status_name'] = $pay_status_name;
				$s['detail'] = json_decode($s['detail'], true);
			}
			include fx_template('withdraw_detail');
		}elseif(strpos($op,'post') !== false){
			$id = intval($_GPC['id']);
			if ($_W['ispost']){
				$result = Withdraw::dealt();
				message ($result['msg'], web_url('withdraw', array('op'=>'detail','id'=>$id)), $result['error']?'error':'success');
			}
		}
	}
	public function doWebIncome() {
		global $_W,$_GPC;
		$op = $this->op;
		if ($op=='display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$order = "id DESC";
			$search = $_GPC['search'];
			$where = array();
			if (!empty($search)){
				$keywords = $search['member'];
				if (trim($search['member'])!=''){
					if (!empty($keywords)){
						$uid = mc_openid2uid($keywords);
						$keywords = empty($uid) ? $keywords : $uid;
						$w['sql'][] = "mobile='".$keywords."' or uid='".$keywords."' or nickname LIKE '%".$keywords."%' or realname LIKE '%".$keywords."%'";
					}
					$membersData = Util::getNumData('uid', 'mc_members', $w, 'uid DESC', 1, 1, 0);
					if (!empty($membersData[0])){
						foreach ($membersData[0] as $v) {
							$member[] = $v['uid'];
						}
					}else{
						$member[] = -1;
					}
					$uids = implode(',',$member);
					$where['#member_id'] = "(".$uids.")";
				}
				$status = $search['status'];
				if ($status!="") {
					$where['status'] = $status;
				}
			}
			
			$pay_status = trim($_GPC['pay_status']);
			if ($pay_status!="") {
				$where['pay_status'] = $pay_status;
				$where['status'] = 1;
			}
			if ($_GPC['status']=='0') $where['status'] = 0;
			$getNumData = Util::getNumData('*', 'fx_member_income', $where, $order, $pindex, $psize, 1);
			
			$list = $getNumData[0];
			$pager = $getNumData[1];
			$total = $getNumData[2];
			fx_load()->model('member');
			$condition = " uniacid = '{$_W['uniacid']}'";
			foreach ($list as $k => &$item) {
				$item['member'] = getMember($item['member_id']);
				$item['created_at'] = date('Y-m-d H:i:s', $item['created_at']);
				$item['status_name'] = $item['status']?'已提现':'未提现';
				switch ($item['pay_status']) {
					case '0':
						$pay_status_name = $item['status'] ? '未审核' : '-';
						break;
					case '1':
						$pay_status_name = '未打款';
						break;
					case '2':
						$pay_status_name = '已打款';
						break;
					case '3':
						$pay_status_name = '已驳回';
						break;
					default:
						$pay_status_name = '无效';
				}
				$item['pay_status_name'] = $pay_status_name;
			}
			include fx_template('income');
		}elseif ($op == 'withdraw') {
			$set = $this->settings;
			$id = intval($_GPC['id']);
			if (empty($id)) {
				$id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
			}
			Withdraw::handler($set);
			$list = pdo_fetchall('SELECT * FROM ' . tablename('fx_member_income') . (' WHERE id in( ' . $id . ' ) AND status=0 AND uniacid=') . $_W['uniacid']);
			if(!empty($list)) {
				foreach ($list as $k => $item) {
					Withdraw::addWithdraw1($item);
				}
			}else{
				 die(json_encode(array('error' => 1,'msg'=>'不可重复提现!')));
			}
			
			die(json_encode(array('error' => 0,'msg'=>'处理成功，系统会自动打款!')));
		}	
	}
	public function doMobileCommission() {
		global $_W,$_GPC;
		$op = $this->op;
		$set = $this->settings;
		if ($_GPC['route']=='api') {
			if(strpos($op,'order') !== false) {
				if(strpos($op,'post') !== false) {
					//验证分销插件是否开启
					if (!$set['commission_enable']) {	
						return '未开启分销';
					}
					
					//购买者身份
					$buyer = Agents::getAgent($this->orderModel['uid']);
					if (!$buyer) {
						return '非推广员';
					}
					if ($buyer['is_black']) {
						return '已列入黑名单';
					}
					if ($buyer['is_pass']==0) {
						return '审核状态终止分销';
					}
					//获取分销商层级
					$agents = Agents::getParentAgents($this->orderModel['uid'], $set['self_buy']);

					foreach ($agents as $level => $agent) {
						$hierarchy = CommissionOrder::getHierarchy($level);
						$agent['hierarchy'] = $level;
						//获取佣金 计算金额 计算公式 佣金比例 分销订单商品等数据
						$commission = CommissionOrder::getCommission($this->orderModel, $agent, $set);
						CommissionOrder::addCommissionOrder($commission, $agent, $hierarchy, $level);
						//分销层级限制
						if ($set['level'] == $hierarchy) break;
					}
					
					return '分销订单添加成功';
				}elseif(strpos($op,'complete') !== false) {
					$result = CommissionOrder::completeOrder();//触发完成订单监听
					if (!$result) {
						return false;
					}
					return $result;
				}
			}elseif(strpos($op,'member') !== false){
			    //载入日志函数
    load()->func('logging');
			    logging_run('分销入口开始');
    
				$agentModel = Agents::handler();
				$result = Agents::addAgent($agentModel,$set);
				logging_run($result);
				return $result;
			
			}
		}else {
			if(strpos($op,'display') !== false){
				$pagetitle = '我的推广';
				$condition = "uniacid = '{$_W['uniacid']}'";
				fx_load()->model('member');				
				if ($_W['account']->typeSign == 'account' && empty($_W['fans']['nickname'])) {
					getInfo();
				}
				$_W['member'] = getMember($_W['openid']);
				$agent = Agents::getAgent($_W['member']['uid']);
				
				if (empty($agent)) {
					$agentModel['member_id'] = $_W['member']['uid'];
					$agentModel['parent_id'] = 0;
					$result = Agents::addAgent($agentModel,$set);
					if ($result)
					$agent = Agents::getAgent($_W['member']['uid']);
				}else{
					if ($agent['is_black'] > 0) {
						fx_message("抱歉您的推广身份已被禁用！", '', 'error');
					}
				}
				
				$agent['created_at'] = date("Y-m-d H:i:s",$agent['created_at']);
				
				if ($agent['parent_id'] > 0) {
					$parent = getMember($agent['parent_id']);
					$agent['level'] = $parent['nickname'];
				}else{
					$agent['level'] = '自己' ;
				}
				
				$condition .= " and member_id=".$_W['member']['uid'];
				$commission[] = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE $condition");
				$commission[] = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE $condition and status = 0");
				$commission[] = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE $condition and status = 1");
				$commission[] = pdo_fetchcolumn("SELECT SUM(commission) FROM " . tablename('fx_commission_order') . " WHERE $condition and status = 2");
				$commission[] = pdo_getcolumn("fx_member_income", array('uniacid'=>$_W['uniacid'],'member_id'=>$_W['member']['uid'],'status'=>0), 'SUM(amount)');
				$commission[] = pdo_getcolumn("fx_member_income", array('uniacid'=>$_W['uniacid'],'member_id'=>$_W['member']['uid'],'status'=>1), 'SUM(amount)');
				
				$total0 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_commission_order') . " WHERE $condition");
				$total1 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_commission_order') . " WHERE $condition and status = 0");
				$total2 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_commission_order') . " WHERE $condition and status = 1");
				$total3 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_commission_order') . " WHERE $condition and status = 2");
				
				if(strpos($op,'detail') !== false){
					$pagetitle = '分销商';
					$agent['lowers'] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_agents') . " WHERE $condition");
					$agent = array_merge($agent, Agents::getLower($_W['member']['uid'], $set['level']));
					include fx_template('member_detail');
					exit;
				}
				include fx_template('member');
			}elseif(strpos($op,'lower') !== false){
				$pagetitle = '我的客户';
				if ($_W['isajax']) {
					$pindex = max(1, intval($_GPC['page']));
					$psize = $_GPC['pagesize']?$_GPC['pagesize']:15;
					$order = "id DESC";
					$level = max(1, intval($_GPC['level']));
					$member_id = $_GPC['uid'];					
					if ($level==1) {
						$where['parent_id'] = $_W['member']['uid'];
					}elseif ($level==2){
						$where['sql'][] = "FIND_IN_SET(".$_W['member']['uid'].",parent)=2";
					}else{
						$where['sql'][] = "FIND_IN_SET(".$_W['member']['uid'].",parent)=3";
					}
					if ($member_id) $where['parent_id'] = $member_id;
					$where['is_pass'] = 1;
					$getNumData = Util::getNumData('*', 'fx_agents', $where, $order, $pindex, $psize, 1);
					fx_load()->model('member');
					foreach ($getNumData[0] as $k => &$item) {
						$item['member'] = getMember($item['member_id']);
						$agentData = Agents::getAgentData($item['member_id'],$_W['member']['uid'],$set);
						$item['ordernum'] = $agentData['ordernum'];
						$item['lower_amount'] = $agentData['lower_amount'];
						$item['amounts'] = $agentData['amounts'];
						$item['lowers'] = $agentData['lowers'];
					}
					$data = array();
					$data['list'] = $getNumData[0]?$getNumData[0]:array();
					$data['total'] = $getNumData[2];
					$data['tpage']=(empty($psize) || $psize < 0) ? 1 : ceil($getNumData[2] / $psize);
					die(json_encode($data));
				}else{
					if (empty($_GPC['uid'])) {				
						$agent['amounts'] = pdo_getcolumn("fx_commission_order", array('uniacid'=>$_W['uniacid'],'member_id'=>$_W['member']['uid']), 'SUM(commission_amount)');
						$agent['commission'] = pdo_getcolumn("fx_commission_order", array('uniacid'=>$_W['uniacid'],'member_id'=>$_W['member']['uid'],'status'=>array(1,2)), 'SUM(commission)');
						$agent = array_merge($agent, Agents::getLower($_W['member']['uid'], $set['level']));
					}else{
						$agent = Agents::getAgentData($_GPC['uid'],$_W['member']['uid'],$set);						
					}
					
				}
				include fx_template('lower');
			}elseif(strpos($op,'withdraw') !== false){
				$pagetitle = '收入提现';
				if(strpos($op,'list') !== false){
					$pagetitle = '提现记录';
					if ($_W['isajax']) {
						$pindex = max(1, intval($_GPC['page']));
						$psize = $_GPC['pagesize']?$_GPC['pagesize']:15;
						$order = "id DESC";
						$where['member_id'] = $_W['member']['uid'];
						$where['type'] = 'commission';
						
						$getNumData = Util::getNumData('*', 'fx_withdraw', $where, $order, $pindex, $psize, 1);
						$data = array();
						$data['list'] = $getNumData[0]?$getNumData[0]:array();
						$data['total'] = $getNumData[2];
						$data['tpage']=(empty($psize) || $psize < 0) ? 1 : ceil($getNumData[2] / $psize);
						die(json_encode($data));
					}
					include fx_template('withdraw_list');
				}else{
					if ($_W['ispost']){
						$model = Withdraw::handler($set);
						$result = Withdraw::addWithdraw($model);
						die(json_encode($result));
					}else{
						$poundage_rate = $set['commission']['poundage_rate'];
						$servicetax_rate = $set['income']['servicetax_rate'];
						$where = array(
							'uniacid' => $_W['uniacid'],
							'member_id' => $_W['member']['uid'],
							'status' => 0
						);
						$amounts = pdo_getcolumn("fx_member_income", $where, 'SUM(amount)');	
						$amounts = sprintf("%.2f", $amounts);	
						$poundage =  sprintf("%.2f", $amounts*$poundage_rate*0.01,2);
						$servicetax = sprintf("%.2f", ($amounts - $poundage) * $servicetax_rate * 0.01);
						include fx_template('withdraw');
					}
				}
			}elseif(strpos($op,'income') !== false){
				$pagetitle = '收入明细';
				if ($_W['isajax']) {
					$pindex = max(1, intval($_GPC['page']));
					$psize = $_GPC['pagesize']?$_GPC['pagesize']:15;
					$order = "id DESC";
					$where['member_id'] = $_W['member']['uid'];
					$where['incometable_type'] = 'commission';
					
					$getNumData = Util::getNumData('*', 'fx_member_income', $where, $order, $pindex, $psize, 1);
					
					$data = array();
					$data['list'] = $getNumData[0]?$getNumData[0]:array();
					$data['total'] = $getNumData[2];
					$data['tpage']=(empty($psize) || $psize < 0) ? 1 : ceil($getNumData[2] / $psize);
					die(json_encode($data));
				}
				include fx_template('income_list');
			}
		}
	}
}