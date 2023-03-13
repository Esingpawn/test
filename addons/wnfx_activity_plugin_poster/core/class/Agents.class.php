<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2020.
// +----------------------------------------------------------------------
// | Describe: 分销商基础模型
// +----------------------------------------------------------------------
// | Author: woniu
// +----------------------------------------------------------------------
class Agents{
	static $model;
	static function handler() {
		global $_W, $_GPC;
        //代理会员数据
		return array('member_id'=>$_GPC['uid'],'parent_id'=>$_GPC['mid']);
	}
	static function getLower($member_id, $level=1) {
	    global $_W;
		$condition = "uniacid = '{$_W['uniacid']}'";
		$lower['first']  = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_agents') . " WHERE $condition AND FIND_IN_SET($member_id, parent)=1");
		$lower['second'] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_agents') . " WHERE $condition AND FIND_IN_SET($member_id, parent)=2");
		$lower['third']  = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_agents') . " WHERE $condition AND FIND_IN_SET($member_id, parent)=3");
		$lower['lowers'] = $lower['first'] + $lower['second'] + $lower['third'];
		switch ($level) {
			case '1':
				$lower['lowers'] = $lower['first'] ;
				break;
			case '2':
				$lower['lowers'] = $lower['first'] + $lower['second'];
				break;
			case '3':
				$lower['lowers'] = $lower['first'] + $lower['second'] + $lower['third'];
				break;
			default:
		}
		return $lower;
	}
	/** 
	* 购买者身份
	* 
	* @access static
	* @name getAgent 
	* @return array 
	*/  
	static function getAgent($uid=0,$id=0) {
	    global $_W;
		if ($id)
			$where['id'] = $id;
		else
			$where['member_id'] = $uid;
		$agent = Util::getSingelData('*', 'fx_agents', $where);
		if(empty($agent)) return array();
		return $agent;
	}
	static function getParentAgents($uid, $self_buy=0) {
	    global $_W;
		$agent = self::getAgent($uid);
		$agents = array();
		if ($agent['parent_id']>0) {
			$parent = $self_buy ? $uid.','.$agent['parent'] : $agent['parent'];
		}else{
			$parent = $self_buy ? $uid : '';
		}
		$parent_ids = !empty($parent) ? explode(',', $parent) : '';
		
		if(empty($parent_ids)) {
			return array();
		} else {
			foreach ($parent_ids as $key=>$v) {
				$agent = $self_buy && $key==0 ? $agent : Util::getSingelData('*', 'fx_agents', array('is_black'=>0, 'member_id'=>$v));
				switch ($key) {
					case 0:
						$agents['first_level'] = $agent;
						break;
					case 1:
						$agents['second_level'] = $agent;
						break;
					case 2:
						$agents['third_level'] = $agent;
						break;
					default:
				}
			}
		}
		return $agents;
	}
	static function addAgent($agentModel, $set) {
   
	global $_W,$_GPC;
	$arrAgent = array(
		'uniacid'    => $_W['uniacid'],
		'member_id'  => $agentModel['member_id'],
		'parent_id'  => $agentModel['parent_id'],
		'parent'     => 0,
		'is_pass'    => 1,
		'created_at' => time(),
	);
	
	if ((int)$agentModel['member_id']==0) return '-1';//会员ID空返回
	
	$member = self::getAgent($agentModel['member_id']);//获取推广员信息
	$recommend = self::getAgent($agentModel['parent_id']);//获取推荐者信息
	logging_run('获得相关数据');
    logging_run($recommend);
    logging_run($agentModel['parent_id']);
	//载入日志函数
    load()->func('logging');
    
	if (!empty($recommend)) {
		if ($recommend['is_pass']==0) {
			 return -3;//推荐者审核状态返回
		}
		if ($recommend['parent']!=0) {
			$parent = substr_count($recommend['parent'], ',') < 2 ? $recommend['parent'] : substr($recommend['parent'],0,strrpos($recommend['parent'],','));
			$arrAgent['parent'] = $agentModel['parent_id'].','.$parent;
		}else{
			$arrAgent['parent'] = $agentModel['parent_id'];
		}
		if ($set['become_check']) {
			$arrAgent['is_pass'] = 0;//线下需要审核
		}
	}else{
		if ($agentModel['parent_id']) return -2;//推荐者不存在返回
		$arrAgent['parent_id'] = 0;
		if ($set['become']) {
			$arrAgent['is_pass'] = 0;//总店需要审核
		}
	}
	//记录文本日志
    logging_run('查询推荐者信息');
    logging_run($recommend);
    logging_run('代理请求数据');
    logging_run($agentModel);
	logging_run('查询到会员');
    logging_run($member);
	if (!empty($member)) {		
	 logging_run('有会员开始更新');
    logging_run($agentModel['parent_id']);
    logging_run($arrAgent['is_pass']);
    logging_run($member['id']);
		$result = pdo_update('fx_agents',  array('parent_id' => $agentModel['parent_id'], 'parent' => $agentModel['parent_id'], 'is_pass'=>$arrAgent['is_pass'], 'del'=>0), array ('id' => $member['id']));
	
	}else{
	    $result = self::insertAgent($arrAgent);
	}
		
	
	return $result;
}
// 	static function addAgent($agentModel, $set) {
	   
// 		global $_W,$_GPC;
// 		$arrAgent = array(
// 			'uniacid'    => $_W['uniacid'],
// 			'member_id'  => $agentModel['member_id'],
// 			'parent_id'  => $agentModel['parent_id'],
// 			'parent'     => 0,
// 			'is_pass'    => 1,
// 			'created_at' => time(),
// 		);
		
// 		if ((int)$agentModel['member_id']==0) return '-1';//会员ID空返回
		
// 		$member = self::getAgent($agentModel['member_id']);//获取推广员信息
// 		$recommend = self::getAgent($agentModel['parent_id']);//获取推荐者信息
		
// 		if (!empty($recommend)) {
// 			if ($recommend['is_pass']==0) {
// 				 return -3;//推荐者审核状态返回
// 			}
// 			if ($recommend['parent']!=0) {
// 				$parent = substr_count($recommend['parent'], ',') < 2 ? $recommend['parent'] : substr($recommend['parent'],0,strrpos($recommend['parent'],','));
// 				$arrAgent['parent'] = $agentModel['parent_id'].','.$parent;
// 			}else{
// 				$arrAgent['parent'] = $agentModel['parent_id'];
// 			}
// 			if ($set['become_check']) {
// 				$arrAgent['is_pass'] = 0;//线下需要审核
// 			}
// 		}else{
// 			if ($agentModel['parent_id']) return -2;//推荐者不存在返回
// 			$arrAgent['parent_id'] = 0;
// 			if ($set['become']) {
// 				$arrAgent['is_pass'] = 0;//总店需要审核
// 			}
// 		}
		
// 		if (!empty($member)) {		
// 		    if ($member['parent_id'] != 0 || in_array($agentModel['member_id'], explode(',', $recommend['parent']))) 
// 		    return '已绑定';//推广员已存在，且已绑定关系
// 			$result = pdo_update('fx_agents',  array('parent_id' => $agentModel['parent_id'], 'parent' => $agentModel['parent_id'], 'is_pass'=>$arrAgent['is_pass'], 'del'=>0), array ('id' => $member['id'],'del'=>1));
// 		}else
// 			$result = self::insertAgent($arrAgent);
		
// 		return $result;
// 	}
	static function insertAgent($arrAgent) {
		global $_W,$_GPC;
		pdo_insert('fx_agents', $arrAgent);
		$id = pdo_insertid();
		return $id;
	}
	static function updateAgent($id){
	 	global $_W, $_GPC;
		$data = $_GPC['agent'];
		$result = pdo_update('fx_agents', $data, array ('id' => $id));
		return array('error'=>!$result, 'msg'=> $result ? '修改成功！':'修改失败！');
	}
	static function getAgentData($member_id, $parent_id, $set) {
	    global $_W;
		$condition = "uniacid = '{$_W['uniacid']}'";		
		if ($set['level']==1) {
			$condition .= " AND FIND_IN_SET(".$member_id.",parent)=1";
		}elseif ($set['level']==2){
			$condition .= " AND FIND_IN_SET(".$member_id.",parent) IN(1,2)";
		}else{
			$condition .= " AND FIND_IN_SET(".$member_id.",parent)";
		}
		//$condition .= " AND FIND_IN_SET(".$member_id.",parent)";
		$lowers = pdo_fetchall("SELECT member_id FROM " . tablename('fx_agents') . " WHERE $condition");
		$buy_ids = array();
		foreach ($lowers as $key=>$v) {
			$buy_ids[] = $v['member_id'];
		}
		$agent_amount = pdo_getcolumn("fx_commission_order", array('uniacid'=>$_W['uniacid'],'member_id'=>$parent_id,'buy_id'=>$member_id), 'SUM(commission_amount)');
		
		$lower_amount = pdo_getcolumn("fx_commission_order", array('uniacid'=>$_W['uniacid'],'member_id'=>$parent_id,'buy_id'=>$buy_ids), 'SUM(commission_amount)');
		
		$agent_commission = pdo_getcolumn("fx_commission_order", array('uniacid'=>$_W['uniacid'],'member_id'=>$parent_id,'buy_id'=>$member_id), 'SUM(commission)');
		
		$lower_commission = pdo_getcolumn("fx_commission_order", array('uniacid'=>$_W['uniacid'],'member_id'=>$parent_id,'buy_id'=>$buy_ids), 'SUM(commission)');
		
		$agent_orders = pdo_getcolumn("fx_commission_order", array('uniacid'=>$_W['uniacid'],'member_id'=>$parent_id,'buy_id'=>$member_id), 'COUNT(*)');
		
		$lower_orders = pdo_getcolumn("fx_commission_order", array('uniacid'=>$_W['uniacid'],'member_id'=>$parent_id,'buy_id'=>$buy_ids), 'COUNT(*)');
		
		$agentData['ordernum'] = $agent_orders + $lower_orders;
		$agentData['lower_amount'] = sprintf("%.2f", $lower_amount);
		$agentData['amounts'] = $agentData['lower_amount'] + sprintf("%.2f", $agent_amount);
		$agentData['commission'] = sprintf("%.2f", ($agent_commission + $lower_commission));
		$agentData['lowers'] = count($lowers);
		return $agentData;
	}
}
?>
