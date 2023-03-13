<?php 

// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 支付结果处理类
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------

class model_api {
	static $set;	
	static function handler($set = array()) {
		global $_W;
		self::$set = $set;
	}
	/** 
	* 分销入口
	* 
	* @access static
	* @name commission_order 
	* @return array 
	*/  
	static function commission_order($mid,$data){
		global $_W;
		$member = m('member')->getMember($_W['openid']);
		$post_data = array(			
			'uniacid'     => (int)$_W['uniacid'],
			'goods_total' => (int)$data['gnum'], 
			'uid'         => (int)$_W['fans']['uid'],
			'mid'         => (int)$data['mid'],//推荐人ID
			'merchant_id '=> (int)$data['merchant_id'],
			'order_sn'    => $data['orderno'],
			'price'       => $data['price'],
			'goods_price' => $data['price'],
			'status'      => 0,//订单状态：0下单, 3已完成 
			'realname'    => $data['realname'],
			'mobile'      => $data['mobile'],
			'address'     => $member['resideprovince'].$member['residecity'].$member['residedist'].$member['address'], 
			'province'    => $member['resideprovince'],
			'city'        => $member['residecity'],
			'county'      => $member['residedist'],
			'detailed_address' => $member['address'],
			'order_id'         => $data['order_id'],
			'is_commission'    => $data['is_commission'],
			'commission_rule'  => $data['commission_rule']
		);
		//post到商城
		$url= $_W['siteroot'] . 'addons/yun_shop/api.php?i=' .$_W['uniacid'].'&route=plugin.fx_activity.admin.order.postOrders';
		if (self::$set['commission_api']) {
			$url= $_W['siteroot'] . 'app/index.php?i='.$_W['uniacid'].'&c=entry&m='.PLUGIN_POSTER.'&do=commission&op=order.post&route=api';
		}
		$res = ihttp_post($url, $post_data);
		$data_obj = @json_encode($res['content'], true);
		return $data_obj;
	}

	/** 
	* 异步支付结果回调 ，处理业务逻辑
	* 
	* @access public
	* @name  
	* @param mixed  参数一的说明 
	* @return array 
	*/  
	static function commission_member($mid){
		global $_W;
		//成为分销员
		$i = $_W['uniacid'];
		$uid = $_W['fans']['uid'];
		$url = $_W['siteroot'] . 'addons/yun_shop/api.php?i='.$i.'&type=1&route=member.member.memberFromHXQModule';
	   // 判断是否是自己访问的或者没有上级
		if ($mid) {
			if ($mid == $uid) {
				$mid = 0;
			} else {
				$mid = (int)$mid;
			}
		} else {
			$mid = 0;
		}
		
		if (self::$set['commission_api']) {
			$url= $_W['siteroot'] . 'app/index.php?i='.$_W['uniacid'].'&c=entry&m='.PLUGIN_POSTER.'&do=commission&op=member&route=api';
		}
	
		$res = ihttp_post($url, array('uid' =>$uid,'mid' =>$mid));
	
		return @json_encode($res['content'], true);
	}
	
	static function commission_completeOrder($order_sn, $status = 0){
		global $_W;
		$post_data = array(
			'status' => 3,
			'order_sn' => $order_sn,
		);
		//post到商城
		$url = $_W['siteroot'] . 'addons/yun_shop/api.php?i=' .$_W['uniacid'].'&route=plugin.fx_activity.admin.order.completeOrder';
		if (self::$set['commission_api']) {
			$url= $_W['siteroot'] . 'app/index.php?i='.$_W['uniacid'].'&c=entry&m='.PLUGIN_POSTER.'&do=commission&op=order.complete&route=api';
			$post_data['status'] = $status ? $status : 1;
		}
		$res = ihttp_post($url, $post_data);
		//$data_obj = @json_encode($res['content'],true);
		return $res['content'];
	}
	
	static function commission_data($order_sn){
		global $_W;
		if (self::$set['commission_api']) {
			$commission_order = pdo_getall('fx_commission_order', array('uniacid'=>$_W['uniacid'], 'order_sn' => $order_sn), array('commission'));
		}else{
			$order = pdo_get('yz_fx_activity_order', array('uniacid'=>$_W['uniacid'],'order_sn' => $order_sn));
			$commission_order = pdo_getall('yz_commission_order', array('uniacid'=>$_W['uniacid'],'ordertable_id' => $order['order_id']), array('commission'));
		}
		return $commission_order;
	}
}
?>