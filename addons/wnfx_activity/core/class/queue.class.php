<?php 

class queue {
	private $islock = array('value'=>0,'expire'=>0);
	private $expiretime = 900; //锁过期时间，秒
	
	//初始赋值
	public function __construct(){
		$lock = Util::getCache('queuelock','first');
		if(!empty($lock)) $this->islock = $lock;
	}
	
	//加锁
	private function setLock(){
		$array = array('value'=>1,'expire'=>time());
		Util::setCache('queuelock','first',$array);
		$this->islock = $array;
	}
	
	//删除锁
	private function deleteLock(){
		Util::deleteCache('queuelock','first');
		$this->islock = array('value'=>0,'expire'=>time());
	}	
	
	//检查是否锁定
	public function checkLock(){
		$lock = $this->islock;	
		if($lock['value'] == 1 && $lock['expire'] < (time() - $this->expiretime )){ //过期了，删除锁
			$this->deleteLock();
			return false;
		}
		if(empty($lock['value'])){
			return false;
		}else{
			return true;
		}
	}
	
	public function queueMain(){
		set_time_limit(0); //解除超时限制
		if(self::checkLock()){
			return false; //锁定的时候直接返回
		}else{
			self::setLock(); //没锁的话锁定
		}
		self::autoDealOrder(); //自动处理订单
		self::autoGoods();//自动处理活动相关状态
		self::auto_cash(); //自动处理提现
		self::autoSettlement(); //自动结算分销订单
		self::autoWithdraw();
		self::deleteLock(); //执行完删除锁
		self::agentUnlock(); //分销关系，超过 N 天自动解除
	}

	//自动处理订单
	static function autoDealOrder(){
		global $_W;
		$config =  $_W['_config'];
		$config['task'] = is_array($config['task'])?$config['task']:array();
		
		$pay = new WeixinPay;
		//自动取消订单
		if(in_array('cancle', $config['task'])){
			$config['cancle_time'] = !empty($config['cancle_time'])?$config['cancle_time']:1;
			$canceltime = time() - $config['cancle_time']*3600;
			$orderdata = pdo_fetchall("select id,status,orderno,uniontid from".tablename("fx_activity_records")."where paytype<>'delivery' and status=0 and UNIX_TIMESTAMP(jointime) < '{$canceltime}'");
			foreach($orderdata as $k=>$v){
				if (empty($v['uniontid'])) 
				$v['uniontid'] = pdo_getcolumn('core_paylog', array('module' => IN_MODULE, 'tid' => $v['orderno']), 'uniontid');
				$result = $pay->closeOrder($v['uniontid']);
				model_records::cancelDoNotPayOrder($v);
			}
		}
	}
	
	//自动处理活动相关状态
	static function autoGoods(){
		global $_W;
		$config =  $_W['_config'];
		//已结束的活动自动取消推荐
		pdo_query("UPDATE ".tablename('fx_activity')." SET recommend=0 WHERE (UNIX_TIMESTAMP(joinetime)<:time OR UNIX_TIMESTAMP(endtime)<:time) AND recommend=1", array(':time' => time()));
	}
	
	//自动处理提现
	static function auto_cash(){
		global $_W;
		$config =  $_W['_config'];
		$config['task'] = is_array($config['task'])?$config['task']:array();
		if(in_array('cash', $config['task'])){			
			$config['cash_time'] = !empty($config['cash_time'])?$config['cash_time']:1;
			$cashtime = time() - $config['cash_time']*3600;
			$time = TIMESTAMP;
			
			$recorddata = pdo_fetchall("select * from".tablename("fx_merchant_record")."where status <> 3 and createtime < '{$cashtime}'");
			foreach($recorddata as $k=>$v){
				$merchant = model_merchant::getSingleMerchant($v['merchantid'], 'openid');
				if(!empty($merchant['openid'])){
					$money = $v['money'];//实扣金额（元）
					$get_money = $v['get_money'];//实到金额（元）
					$commission = sprintf("%.2f",$v['commission']);//手续费
					
					$result = model_merchant::finance($merchant['openid'], $get_money * 100, '主办方提现');  //结算操作
					if ($result['result_code'] == 'SUCCESS'){
						pdo_update('fx_merchant_account',array('no_money_doing'=>0),array('merchantid'=>$v['merchantid']));
						pdo_insert("fx_merchant_money_record",array('uniacid'=>$v['uniacid'],'merchantid'=>$v['merchantid'],'money'=>0-$get_money,'recordsid'=>'','createtime'=>$time,'type'=>4,'detail'=>$v['orderno']));
						if($commission>0)
						pdo_insert("fx_merchant_money_record",array('uniacid'=>$v['uniacid'],'merchantid'=>$v['merchantid'],'money'=>0-$commission,'recordsid'=>'','createtime'=>$time,'type'=>7,'detail'=>$v['orderno']));
						$res = model_merchant::updateNoSettlementMoney(0-$money, $v['merchantid']);
						if($res){
							pdo_update('fx_merchant_record',array('status'=>3,'updatetime'=>$time, 'paytime'=>$time, 'type'=>1),array('id'=>$v['id']));
						}							
					}else{
						load()->func('logging');
						$rearr = array(
							'error'=> 1,
							'msg'=> $result['return_msg'].': ' .$result['err_code']."|" .$result['err_code_des'],
							'order' => "金额:".$get_money."|,手续费:".$commission
						);
						logging_run($rearr);
					}
				}
			}
		}
	}
	//分销佣金结算
	static function autoSettlement(){
		global $_W;
		$config = $_W['plugin']['poster']['config'];
		$times = time();
		$settle_time = $times - $config['settle_days'] * 24 * 3600;
		if ($config['settlement_model']) {
			$orders = pdo_getall('fx_commission_order', array('status'=>1,'recrive_at <='=>$settle_time));
			foreach ($orders as $k => $order) {
				$data = [
					'commission' => [
						'title' => '分销',
						'data' => [
							'0' => [
								'title' => '佣金',
								'value' => $order['commission'] . "元",
							],
							'1' => [
								'title' => '分销层级',
								'value' => $order['hierarchy'] . "级",
							],
							'2' => [
								'title' => '佣金比例',
								'value' => $order['commission_rate'] . "%",
							],
							'3' => [
								'title' => '结算天数',
								'value' => $order['settle_days'] . "天",
							],
							'4' => [
								'title' => '佣金方式',
								'value' => $order['formula'],
							],
							'5' => [
								'title' => '分佣时间',
								'value' => date("Y-m-d H:i:s", $order['recrive_at']),
							],
							'6' => [
								'title' => '结算时间',
								'value' => date("Y-m-d H:i:s", $times)
							],
						]
					
					],
					'order' => [
						'title' => '订单',
						'data' => [
							'0' => [
								'title' => '订单号',
								'value' => $order['order_sn'],
							],
							'1' => [
								'title' => '状态',
								'value' => "交易完成",
							],
						]
					]
				];

				$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fx_member_income') . " WHERE member_id=".$order['member_id']." and `detail` LIKE '%" . $order['order_sn'] . "%'");
				
				if (empty($total)) {
					//收入明细数据
					$incomeDetail = json_encode($data);
					$orderData = array(
						'uniacid' => $order['uniacid'],
						'member_id' => $order['member_id'],
						'incometable_type' => 'commission',
						'incometable_id' => $order['id'],
						'type_name' => '分销佣金',
						'amount' => $order['commission'],
						'status' => 0,
						'pay_status' => 0,
						'detail' => $incomeDetail,
						'create_month' => date('Y-m'),
						'created_at' => $times
					);
					pdo_insert('fx_member_income', $orderData);
					pdo_update('fx_agents', array('commission_total +=' => $order['commission']), array ('member_id' => $order['member_id']));
					pdo_update('fx_commission_order', array('updated_at'=>$times,'status'=>2), array ('id'=>$order['id']));
				}
			}
		}
		return true;
	}
	//分销提现处理
	static function autoWithdraw() {
		global $_W,$_GPC;
		$config =  $_W['plugin']['poster']['config'];
		if($config['income']['free_audit']) {
			Withdraw::payController();
		}
	}	
	//分销关系，超过 N 天自动解除
	static function agentUnlock(){
		global $_W,$_GPC;		
		$config = $_W['plugin']['poster']['config'];
		if (isset($config['unlock_days']) && $config['unlock_days'] > 0){
			//$agents = pdo_fetchall("SELECT * FROM " . tablename('fx_agents') . " WHERE updated_at IS NULL and DATE_SUB(CURDATE(), INTERVAL 30 DAY) > FROM_UNIXTIME(created_at, '%Y-%m-%d')");
			$agents = pdo_fetchall("SELECT * FROM " . tablename('fx_agents') . " WHERE del=0 and DATE_SUB(CURDATE(), INTERVAL " . $config['unlock_days'] . " DAY)>FROM_UNIXTIME(updated_at,'%Y-%m-%d')");
			foreach ($agents as $k => $agent) {	
				$is_pass = $agent['is_pass'];
				if ($config['become'] && $agent['parent_id']) {
					$is_pass = 0;//总店需要审核
				}
				if ($agent['parent_id']>0) {
					pdo_update('fx_agents', array('parent_id'=>0,'parent'=>'','updated_at'=>time(),'is_pass'=>$is_pass,'del'=>1), array ('member_id' => $agent['member_id']));						
					pdo_query("UPDATE ".tablename('fx_agents')." SET `parent`=left(parent,locate(',".$agent['member_id']."',parent)-1) where parent like '%,".$agent['member_id']."%' and FIND_IN_SET(".$agent['member_id'].",parent)>1");
				}
				//pdo_query("UPDATE ".tablename('fx_agents')." SET `parent_id`=0,`parent`='',`is_pass`=".$is_pass.",`del`=1 WHERE FIND_IN_SET(".$agent['member_id'].",`parent`)=1");
				
			}
		}
	}
}

