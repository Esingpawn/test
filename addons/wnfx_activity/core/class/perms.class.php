<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 权限模型
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
class perms{
	static public $allPerms = array();
	static public $getLogTypes = array();
	static public $formatPerms = array();
	
	static function allPerms()
	{
		global $_W;
		if (empty(self::$allPerms)) {
			$perms = array(
				'shop' => self::perm_shop(), 
				'goods' => self::perm_goods(), 
				'member' => self::perm_member(), 
				'order' => self::perm_order(), 
				'store' => self::perm_store(), 
				'finance' => array(), 
				'sysset' => self::perm_sysset(), 
				'sale' => self::perm_sale(), 
				'poster' => self::perm_poster(), 
				'vipcard' => self::perm_vipcard(),
				'seat'=> self::perm_seat(),
				'diyform' => self::perm_diyform(), 
				'poster' => self::perm_poster(), 
				'merch' => self::perm_merch(), 
				'perm' => self::perm_perm(),
				'sign' => self::perm_sign(), 
				'task' => self::perm_task(), 
				'messages' => self::perm_messages(), 
				'mmanage' => self::perm_mmanage()				
			);
			if (strpos($_W['routes'],'merch') !== false){
				$perms = array(
					'goods' => self::perm_goods(), 
					'order' => self::perm_order(), 
					'store' => self::perm_store(), 
					'sale' => self::perm_sale(),
					'apply' => self::perm_apply(),
					'seat' => self::perm_seat(),
					'merchset' => self::perm_merchset(), 					
					'diyform' => self::perm_diyform(), 
					'sign' => self::perm_sign(), 
					'task' => self::perm_task(), 
					'messages' => self::perm_messages(), 
				);
			}
			self::$allPerms = $perms;
		}

		return self::$allPerms;
	}
	static function formatPerms()
	{
		if (empty(self::$formatPerms)) {
			$perms = self::allPerms();
			$array = array();
			foreach ($perms as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $ke => $val) {
						if (!is_array($val)) {
							$array['parent'][$key][$ke] = $val;
						}

						if (is_array($val) && $ke != 'xxx') {
							foreach ($val as $k => $v) {
								if (!is_array($v)) {
									$array['son'][$key][$ke][$k] = $v;
								}

								if (is_array($v) && $k != 'xxx') {
									foreach ($v as $kk => $vv) {
										if (!is_array($vv)) {
											$array['grandson'][$key][$ke][$k][$kk] = $vv;
										}
									}
								}
							}
						}
					}
				}
			}

			self::$formatPerms = $array;
		}

		return self::$formatPerms;
	}
	static function perm_shop(){
		return array(
			'text'          => '店铺管理',
			'adv'           => array(
				'text'   => '幻灯片',
				'main'   => '查看列表',
				'view'   => '查看内容',
				'add'    => '添加-log',
				'edit'   => '修改-log',
				'delete' => '删除-log',
				'xxx'    => array('displayorder' => 'edit', 'enabled' => 'edit')
			)
		);
	}
	static function perm_goods()
	{
		return array(
			'text'      => '活动管理',
			'main'      => '浏览列表',
			'view'      => '查看详情',
			'add'       => '添加-log',
			'edit'      => '修改-log',			
			'delete'    => '删除-log',
			'delete1'   => '彻底删除-log',
			'xxx'       => array('status' => 'edit', 'property' => 'edit', 'goodsprice' => 'edit', 'change' => 'edit', 'ajax_batchcates' => 'edit'),
			'switch' => array(
				'text' => '常用开关',
				'buycheck' => '报名审核',
				'refund'   => '支持退款',
				'xxx'  => array('enabled' => 'edit')
			),
			'senior' => array(
				'text' => '高级权限',
				'ischeck' => '发布免审',
				'credit'   =>  m('member')->getCreditName('credit1') . '设置',
				'xxx'  => array('enabled' => 'edit')
			),
			'price' => self::isopen('price', true) ? array(
				'text' => '活动价格',
				'edit' => '修改-log',
				'xxx'  => array('enabled' => 'edit')
			) : array(),
			'category' => self::isopen('category', true) ? array(
				'text'   => '活动分类',
				'add'    => '添加-log',
				'edit'   => '修改-log',
				'delete' => '删除-log',
				'xxx'    => array('enabled' => 'edit')
			) : array(),
			'group' => !self::isopen('merch', true) ? array(
				'text'   => '活动组',
				'view'   => '浏览',
				'add'    => '添加-log',
				'edit'   => '修改-log',
				'delete' => '删除-log',
				'xxx'    => array('enabled' => 'edit')
			) : array(),
			'label' => !self::isopen('merch', true) ? array(
				'text'   => '标签管理',
				'view'   => '浏览',
				'add'    => '添加-log',
				'edit'   => '修改-log',
				'delete' => '删除-log',
				'xxx'    => array('enabled' => 'edit')
			) : array(),
			'fixedinfo' => !self::isopen('merch', true) ? array(
				'text'   => '固定信息',
				'view'   => '浏览',
				'add'    => '添加-log',
				'edit'   => '修改-log',
				'delete' => '删除-log',
				'xxx'    => array('enabled' => 'edit')
			) : array(),
			'virtual' => self::isopen('virtual', true) ? array(
				'text'     => '虚拟卡密',
				'temp'     => array('text' => '卡密模板管理', 'view' => '浏览', 'add' => '添加-log', 'edit' => '修改-log', 'delete' => '删除-log'),
				'category' => array('text' => '卡密分类管理', 'add' => '添加-log', 'edit' => '编辑-log', 'delete' => '删除-log'),
				'data'     => array('text' => '卡密数据', 'add' => '添加-log', 'edit' => '修改-log', 'delete' => '删除-log', 'export' => '导出-log', 'temp' => '下载模板', 'import' => '导入-log')
			) : array()
		);
	}
	
	static function perm_order()
	{
		return array(
			'text'      => '订单管理',
			'batch' => array(
				'text' => '批量处理',
				'verify' => '一键核销-log',
				'check' => '批量审核',
				'xxx'  => array('import' => 'main')
			),
			'list'      => array(
				'text' => '订单管理', 
				'main' => '浏览全部订单', 
				'delete' => '删除', 
			),
			'op'        => array(
				'text'          => '操作',
				'pay'           => '确认付款-log',
				'send'          => self::isopen('send', true) ? '发货-log' : array(),
				'sendcancel'    => self::isopen('sendcancel', true) ? '取消发货-log' : array(),
				'finish'        => self::isopen('finish', true) ? '确认收货(快递单)-log' : array(),
				'verify'        => '确认核销-log',
				'cancel'        => '取消订单-log',
				'changeprice'   => self::isopen('changeprice', true) ? '订单改价-log': array(),
				'changeaddress' => self::isopen('changeaddress', true) ? '修改收货地址-log' : array(),
				'remarksaler'   => '订单备注-log',
				'paycancel'     => '订单取消付款-log',
				'fetchcancel'   => self::isopen('fetchcancel', true) ? '订单取消取货-log' : array(),
				'refund'        => '允许退款-log',
				'check'         => '审核',
				'xxx'           => array('changeexpress' => 'send')
			)
		);
	}
	
	static function perm_member()
	{
		return array(
			'text'     => '会员管理',
			'list'     => array(
				'text'   => '会员管理',
				'main'   => '浏览',
				'edit'   => '修改-log',
				'view'   => '查看-log',
				'delete' => '删除-log',
				'xxx'    => array('setblack' => 'edit')
			)
		);
	}
	
	static function perm_store()
	{
		$perm = array(
			'text'            => '门店管理',
			'main'            => '浏览列表',
			'view'            => '查看详情',
			'add'             => '添加-log',
			'edit'            => '修改-log',
			'delete'          => '删除-log',
			'set'             => '关键词设置-log',
			'saler'           => array('text' => '店员管理', 'main' => '查看列表', 'add' => '添加-log', 'edit' => '修改-log', 'view' => '查看', 'delete' => '删除-log'),
		);

		return $perm;
	}
	
	static function perm_finance()
	{
		return array(
			'text'         => '财务管理',
			'log'          => array('text' => '财务管理', 'recharge' => '充值记录', 'withdraw' => '提现申请', 'refund' => '充值退款-log', 'alipay' => '支付宝提现-log', 'wechat' => '微信提现-log', 'manual' => '手动提现-log', 'refuse' => '拒绝提现-log', 'recharge.export' => '充值记录导出-log', 'withdraw.export' => '提现申请导出-log'),
			'downloadbill' => array('text' => '对账单', 'main' => '下载-log'),
			'recharge'     => array('text' => '充值', 'credit1' => '充值' . m('member')->getCreditName('credit1') . '-log', 'credit2' => '充值余额-log'),
			'credit'       => array('text' => m('member')->getCreditName('credit1') . '余额明细', 'credit1' => m('member')->getCreditName('credit1') . '明细', 'credit1.export' => '导出' . m('member')->getCreditName('credit1') . '明细', 'credit2' => '余额明细', 'credit2.export' => '导出余额明细')
		);
	}
	
	static function perm_sysset()
	{
		return array(
			'text'     => '设置',
			'sys'      => array('text' => '基本设置', 'main' => '查看', 'edit' => '修改-log'),
			'shop'     => array('text' => '信息设置', 'main' => '查看', 'edit' => '修改-log'),
			'follow'   => array('text' => '分享及关注', 'main' => '查看', 'edit' => '修改-log'),
			'pay'      => array('text' => '支付设置', 'edit' => '修改-log'),
			'tpl'      => array('text' => '模板设置', 'main' => '查看', 'edit' => '修改'),
			'agreement' => array('text' => '协议设置', 'edit' => '修改-log'),
			'task'     => array('text' => '计划任务', 'edit' => '修改-log'),
			'sms'      => array('text' => '短信设置', 'set' => '设置-log'),
			'temp'     => array('text' => '模板消息', 'set' => '设置-log'),
			'member' => array('text' => '会员设置', 'main' => '查看', 'edit' => '修改-log'),
			'cate'   => array('text' => '分类设置', 'main' => '查看', 'edit' => '修改-log'),
			'page'   => array('text' => 'WAP设置', 'main' => '查看', 'edit' => '修改-log'),
			'cover'  => array(
				'shop'     => array('text' => '报名入口', 'main' => '查看', 'edit' => '修改-log'),
				'member'   => array('text' => '会员中心入口', 'main' => '查看', 'edit' => '修改-log'),				
				'order'    => array('text' => '订单入口', 'main' => '查看', 'edit' => '修改-log'),
				'merch'    => array('text' => '商户入口', 'main' => '查看', 'edit' => '修改-log')
			)
		);
	}
	
	static function perm_merchset()
	{
		return array(
			'text' => '设置'
		);
	}
	
	static function perm_sale()
	{
		$array = array(
			'text'       => '营销',
			'coupon'     => self::isopen('coupon', true) ? array(
				'text'        => '优惠券管理',
				'view'        => '浏览',
				'add'         => '添加-log',
				'edit'        => '修改-log',
				'delete'      => '删除-log',
				'send'        => '发放-log',
				'set'         => '修改设置-log',
				'xxx'         => array('displayorder' => 'edit'),
				'category'    => array('text' => '优惠券分类', 'main' => '查看', 'edit' => '修改-log'),
				'log'         => array('text' => '优惠券记录', 'main' => '查看', 'export' => '导出记录'),
				'sendcoupon'  => array('text' => '手动发券', 'main' => '查看'),
				'goodssend'   => array('text' => '购物送券', 'main' => '查看', 'add' => '添加', 'edit' => '编辑'),
				'sendtask'    => array('text' => '满额送券', 'main' => '查看', 'add' => '添加', 'edit' => '编辑'),
				'usesendtask' => array('text' => '用券送券', 'main' => '查看', 'add' => '添加', 'edit' => '编辑'),
				'setticket'   => array('text' => '新人发券', 'main' => '查看'),
				'shareticket' => array('text' => '分享发券', 'main' => '查看', 'add' => '添加活动', 'edit' => '编辑活动', 'status' => '编辑状态', 'delete1' => '删除活动', 'change' => '修改参数')
			) : array(),
			'wxcard'     => array('text' => '微信卡券管理', 'view' => '浏览', 'add' => '添加', 'edit' => '修改', 'stock' => '修改库存', 'qrcode' => '下载推送二维码', 'delete' => '删除', 'set' => '修改设置-log'),
			'virtual'    => array('text' => '关注回复', 'view' => '浏览', 'edit' => '修改-log'),
			'package'    => array(
				'text'    => '套餐管理',
				'view'    => '浏览',
				'add'     => '添加-log',
				'edit'    => '修改-log',
				'delete1' => '彻底删除-log',
				'xxx'     => array('status' => 'edit', 'change' => 'edit')
			),
			'gift'       => array(
				'text'    => '赠品管理',
				'view'    => '浏览',
				'add'     => '添加-log',
				'edit'    => '修改-log',
				'delete1' => '彻底删除-log',
				'xxx'     => array('status' => 'edit', 'change' => 'edit')
			),
			'fullback'   => array(
				'text'    => '全返管理',
				'view'    => '浏览',
				'add'     => '添加-log',
				'edit'    => '修改-log',
				'delete1' => '彻底删除-log',
				'xxx'     => array('status' => 'edit', 'change' => 'edit')
			),
			'peerpay'    => array('text' => '找人代付', 'main' => '查看', 'edit' => '编辑'),
			'bindmobile' => array('text' => '绑定送' . m('member')->getCreditName('credit1'), 'main' => '查看', 'edit' => '编辑')
		);
		if (self::isopen('sale', true)) {
			$sale = array('deduct' => '修改抵扣设置-log', 'enough' => '修改满额立减-log', 'enoughfree' => '修改满额包邮-log', 'recharge' => '修改充值优惠设置-log', 'credit1' => m('member')->getCreditName('credit1') . '优惠优惠设置-log');
			$array = array_merge($array, $sale);
		}

		return array();
	}
	static function perm_apply(){
		return array(
			'text' => '结算'
		);
	}
	
	static function perm_poster()
	{
		return self::isopen('poster') ? array(
			'text'       => '分销海报'
		) : array();
	}
	
	static function perm_vipcard()
	{
		return self::isopen('vipcard') ? array(
			'text'       => '年卡'
		) : array();
	}
	
	static function perm_seat()
	{
		return self::isopen('seat') ? array(
			'text'       => '选座工具'
		) : array();
	}
	
	static function perm_perm()
	{
		return array(
			'text' => '权限系统',
			'log'  => self::isopen('log') ? array('text' => '操作日志', 'main' => '查看列表'):array(),
			'role' => array(
				'text'   => '角色管理',
				'main'   => '查看列表',
				'add'    => '添加-log',
				'edit'   => '修改-log',
				'delete' => '删除-log',
				'xxx'    => array('status' => 'edit', 'query' => 'main')
			),
			'user' => array(
				'text'   => '操作员管理',
				'main'   => '查看列表',
				'add'    => '添加-log',
				'edit'   => '修改-log',
				'delete' => '删除-log',
				'xxx'    => array('status' => 'edit')
			)
		);
	}
	
	static function perm_merch()
	{
		return self::isopen('merch') ? array(
			'text'       => '多商户',
			'reg'        => self::isopen('log') ? array('text' => '入驻申请', 'detail' => '查看详情', 'delete' => '删除-log'):array(),
			'user'       => array('text' => '商户管理', 'view' => '查看详情', 'add' => '添加-log', 'edit' => '修改-log', 'delete' => '删除-log'),
			'check'      => array('text' => '提现申请', 'status1' => '待确认的申请', 'status2' => '待打款的申请', 'status3' => '已打款的申请'),
			'set'        => array('text' => '基本设置', 'main' => '查看', 'edit' => '修改-log')
		) : array();
	}
	
	static function perm_messages()
	{
		return array(
			'text' => '消息',
			'main' => '消息群发',
			'run'  => '消息发送',
			'template' => self::isopen('template', true) ? array('text' => '模板编辑', 'view' => '查看模板', 'add' => '新建模板', 'edit' => '编辑模板', 'delete' => '删除模板') : array()
		);
	}
	static function perm_diyform(){
		//自己定义表单
		return array();
	}
	static function perm_sign()
	{
		return self::isopen('sign') ? array(
			'text'    => '签到',
			'rule'    => array('text' => '签到规则', 'main' => '查看', 'edit' => '编辑-log'),
			'set'     => array('text' => '签到入口', 'main' => '查看', 'edit' => '编辑-log'),
			'records' => array('text' => '签到记录', 'main' => '查看')
		) : array();
	}
	static function perm_task(){
		//任务管理
		return array();
	}
	static function perm_mmanage(){
		//手机端口商家管理
		return array();
	}
	static function isopen($name = '', $iscom = false)
	{
		return perm_isopen($name, $iscom);
	}
	static function check_perm($permtypes = '')
	{
		global $_W;
		$check = true;

		if (empty($permtypes)) {
			return false;
		}

		if (!strexists($permtypes, '&') && !strexists($permtypes, '|')) {
			$check = self::check($permtypes);
		}
		else if (strexists($permtypes, '&')) {
			$pts = explode('&', $permtypes);

			foreach ($pts as $pt) {
				$check = self::check($pt);

				if (!$check) {
					break;
				}
			}
		}
		else {
			if (strexists($permtypes, '|')) {
				$pts = explode('|', $permtypes);

				foreach ($pts as $pt) {
					$check = self::check($pt);

					if ($check) {
						break;
					}
				}
			}
		}

		return $check;
	}

	static function check($permtype = '')
	{
		global $_W, $_GPC;
		if ($_W['role'] == 'manager' || $_W['role'] == 'founder' || $_W['role'] == 'owner') {
			return true;
		}
		if ($_W['role']=='operator' && strpos($permtype,'finance.recharge') !== false) {
			return false;
		}
		$uid = $_W['uid'];

		if ($_W['role'] == 'vice_founder') {
			$vice_founder = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename('uni_account_users') . 'WHERE uid=:uid AND role=:role AND uniacid=:uniacid', array(':uid' => $uid, ':role' => 'vice_founder', ':uniacid' => intval($_W['uniacid'])));

			if (!empty($vice_founder)) {
				return true;
			}

			$info = pdo_get('uni_account_users', array('uniacid' => intval($_W['uniacid']), 'uid' => $uid));
			if (!empty($info) && $info['role'] == 'owner') {
				return true;
			}

			return false;
		}

		if (empty($permtype)) {
			return false;
		}
		
		if (MERCHANTID) {
			$role = pdo_fetch('select * from ' . tablename('fx_perm_role') .' where merchid=:merchid and uniacid = :uniacid limit 1 ', array(':merchid' => MERCHANTID, ':uniacid' => intval($_W['uniacid'])));
			if (empty($role['perms'])){
				$role = pdo_fetch('select * from ' . tablename('fx_merch_perm_role') . ' where uniacid = :uniacid limit 1 ', array(':uniacid' => intval($_W['uniacid'])));
			}
			$perms = explode(',', $role['perms']);
		}
		
		if (empty($perms)){
			$user = pdo_fetch('select u.status as userstatus,r.status as rolestatus,u.perms2 as userperms,r.perms2 as roleperms,u.roleid from ' . tablename('fx_perm_user') . ' u ' . ' left join ' . tablename('fx_perm_role') . ' r on u.roleid = r.id ' . ' where u.uid=:uid and u.uniacid = :uniacid limit 1 ', array(':uid' => $uid, ':uniacid' => intval($_W['uniacid'])));
			if (empty($user) || empty($user['userstatus'])) {				
				return false;
			}
	
			if (!empty($user['roleid']) && empty($user['rolestatus'])) {
				return false;
			}
			$role_perms = explode(',', $user['roleperms']);
			$user_perms = explode(',', $user['userperms']);
			$perms = array_merge($role_perms, $user_perms);
		}
		
		if (empty($perms)) {
			return false;
		}

		$is_xxx = self::check_xxx($permtype);

		if ($is_xxx) {
			if (!in_array($is_xxx, $perms)) {
				return false;
			}
		}
		else {
			if (!in_array($permtype, $perms)) {
				return false;
			}
		}

		return true;
	}

	/**
     * 查看是不是继承
     * @param $permtype
     * @return bool|string
     */
	static function check_xxx($permtype)
	{
		if ($permtype) {
			$allPerm = self::allPerms();
			$permarr = explode('.', $permtype);

			if (isset($permarr[3])) {
				$is_xxx = isset($allPerm[$permarr[0]][$permarr[1]][$permarr[2]]['xxx'][$permarr[3]]) ? $allPerm[$permarr[0]][$permarr[1]][$permarr[2]]['xxx'][$permarr[3]] : false;
			}
			else if (isset($permarr[2])) {
				$is_xxx = isset($allPerm[$permarr[0]][$permarr[1]]['xxx'][$permarr[2]]) ? $allPerm[$permarr[0]][$permarr[1]]['xxx'][$permarr[2]] : false;
			}
			else if (isset($permarr[1])) {
				$is_xxx = isset($allPerm[$permarr[0]]['xxx'][$permarr[1]]) ? $allPerm[$permarr[0]]['xxx'][$permarr[1]] : false;
			}
			else {
				$is_xxx = false;
			}

			if ($is_xxx) {
				$permarr = explode('.', $permtype);
				array_pop($permarr);
				$is_xxx = implode('.', $permarr) . '.' . $is_xxx;
			}

			return $is_xxx;
		}

		return false;
	}
}

