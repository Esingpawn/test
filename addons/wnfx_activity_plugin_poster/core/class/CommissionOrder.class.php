<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2020.
// +----------------------------------------------------------------------
// | Describe: 订单佣金模型
// +----------------------------------------------------------------------
// | Author: woniu
// +----------------------------------------------------------------------
class CommissionOrder{
	static $model;
	static $set;
	
	static function handler($set) {
		self::$set = $set;
        //订单model
        self::$model = self::getOrderModel();
		return self::$model;
	}
	/** 
	* 购买者身份
	* 
	* @access static
	* @name getAgent 
	* @return array 
	*/  
	static function getCommission($orderModel, $agent, $set) {
	    global $_W;
        $commissionAmount = 0;
        $formula = '';
        $commissionRate = 0;
        $commission = 0;
		
		//临时解决分销等级删除后，分销订单不能使用默认等级计算问题
        if ($agent['agent_level_id']) {
           
        }
		
		//商品独立佣金
		$commissionAmount = $orderModel['price']; //分佣计算金额
		$formula = "+商品独立佣金";//分佣计算方式
		$rule = $set['rule'];
		if ($orderModel['commission_rule'][$agent['hierarchy'] . '_rate'] > 0) {
			$rule[$agent['hierarchy'] . '_rate'] = $orderModel['commission_rule'][$agent['hierarchy'] . '_rate'];
		}	
		if ($rule[$agent['hierarchy'] . '_rate'] > 0) {
			$commissionRate = $rule[$agent['hierarchy'] . '_rate'];
			$commission = $commissionAmount / 100 * $commissionRate;
		}

        return [
            'commission_amount' => $commissionAmount,
            'formula' => $formula,
            'commission_rate' => $commissionRate,
            'commission' => $commission
        ];
	}
	/**
     * @param $commission
     * @param $agent
     * @param $hierarchy
     * @param $level
     */
	static function addCommissionOrder($commission, $agent, $hierarchy, $level) {
		global $_W,$_GPC;
		//分销订单数据
		$orderData = array(
			'uniacid' => $_W['uniacid'],
			'order_sn' => self::$model['order_sn'],
			'ordertable_id' => self::$model['order_id'],
			'buy_id' => self::$model['uid'],
			'member_id' => $agent['member_id'],
			'hierarchy' => $hierarchy,//分销层级
			'commission_amount' => $commission['commission_amount'],// 计算金额,
			'formula' => $commission['formula'],// 计算公式
			'commission_rate' => $commission['commission_rate'],// 佣金比例
			'commission' => $commission['commission'],// 佣金
			'status' => '0',
			'settle_days' => self::$set['settle_days'],
			'created_at' => time(),
		);
		if ($agent['is_black']) {
			return '已列入黑名单';
		}
		//添加分销订单数据 生成ID
		$insertId = CommissionOrder::insertGetId($orderData);
		return $insertId;
	}
	/**
     * @param $level
     * @return string
     * 分销商层级转换
     */
    static function getHierarchy($level) {
        switch ($level) {
            case 'first_level':
                $hierarchy = '1';//分销层级
                break;
            case 'second_level':
                $hierarchy = '2';//分销层级
                break;
            default:
                $hierarchy = '3';//分销层级
        }
        return $hierarchy;
    }
	/**
     * @function getOrderModel
     * @return array
     * 接收POST分销订单数据
     */
	static function getOrderModel() {
		global $_W,$_GPC;
		//分销订单数据
		$orderData = array(			
			'uniacid'      => (int)$_W['uniacid'],
			'goods_total'  => (int)$_GPC['gnum'], 
			'uid'          => (int)$_GPC['uid'],
			'member_id'    => (int)$_GPC['mid'],//推荐人ID
			'merchant_id ' => (int)$_GPC['merchant_id'],
			'order_sn'     => $_GPC['order_sn'],
			'price'        => $_GPC['price'],
			'goods_price'  => $_GPC['goods_price'],
			'status'       => $_GPC['status'],//订单状态：0下单, 3已完成 
			'realname'     => $_GPC['realname'],
			'mobile'       => $_GPC['mobile'],
			'address'      => $_GPC['address'], 
			'province'     => $_GPC['province'],
			'city'         => $_GPC['city'],
			'county'       => $_GPC['county'],
			'detailed_address' => $_GPC['detailed_address'],
			'order_id'         => $_GPC['order_id'],
			'is_commission'    => $_GPC['is_commission'],
			'commission_rule'  => $_GPC['commission_rule']
		);
		 return $orderData;
	}
	static function insertGetId($orderData) {
		global $_W,$_GPC;
		pdo_insert('fx_commission_order', $orderData);
		$id = pdo_insertid();
		return $id;
	}
	/**
     * 活动报名订单状态转完成
     * @return string
     */
    static function completeOrder() {
		global $_W,$_GPC;
		if ($_GPC['status']==1) {
			$_time = time();
			$result = pdo_update('fx_commission_order', array('recrive_at'=>$_time,'updated_at'=>$_time,'status'=>$_GPC['status']), array ('status'=>0,'order_sn'=>$_GPC['order_sn']));
		}
		switch ($_GPC['status']) {
            case '0':
                $msg = '取消支付，待支付';
                break;
            case '1':
                $msg = '支付成功，待结算';
                break;
            default:
                $msg = '订单完成，待提现';
        }
		if ($result) {
			$content = 'OK';
		}else{
			$content = 'NO';
		}
        return $content;
    }
}
?>
