<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 报名操作模型类
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
 class model_records
 {
	/** 
	* 获取单条报名信息
	* 
	* @access static
	* @name getSingleRecords 
	* @param mixed  参数一的说明 
	* @return array 
	*/  
	static function getSingleRecords($id){
		global $_W;
		$records = pdo_get('fx_activity_records', array('uniacid'=>$_W['uniacid'],'id' => $id));
		$records['marketing'] = unserialize($records['marketing']);
		return $records;
	}
	
	static function getNumFormData($id){
		global $_W;
		$formdata = pdo_fetchall("select * from " . tablename('fx_form_data') . " where recordid=".$id." order by id asc");
		return $formdata;
	}
	
	static function getSingleFormData($id,$formid){
		global $_W;
		$formdata = pdo_get("fx_form_data",array('recordid' => $id,'formid' => $formid));
		return $formdata;
	}
	static function getSingleStore($id){
		global $_W;
		if (!empty($id)) {
			$store = pdo_get('fx_store', array('uniacid'=>$_W['uniacid'],'id' => $id));
		}else{
			$merchant = model_merchant::getSingleMerchant($mid,'*');
			$store['storename'] = $merchant['storename'];
		}
		return $store;
	}
	/** 
	* 统计当前已报名数量 
	*/
	static function getJoinNum($id, $optionid = 0, $falsenum = 0, $is_pay = false){
		global $_W;
		$stock_lock = isset($_W['_config']['stock_lock']) ? $_W['_config']['stock_lock'] : 1;
		$status = !$is_pay && $stock_lock == 2 ? '5,7' : '0,5,7';//并发支付时，未支付订单在有效期内设置为占用库存
		$condition = "uniacid={$_W['uniacid']} and activityid = $id and (status not in($status) or paytype = 'delivery') and `review`<>2";
		$condition.= $optionid ? " and optionid = $optionid" :'';
		$joinnum = pdo_fetchcolumn("SELECT SUM(buynum) FROM " . tablename('fx_activity_records') . " WHERE $condition");
		$joinnum = ($joinnum?$joinnum:0) + $falsenum;
		return $joinnum;
	}
	
	static function checkOrderConfirm($orderno, $params = array()){
		global $_W, $_GPC;
		$order = pdo_getall('fx_activity_records', array('orderno' => $orderno, 'uniacid' =>$_W['uniacid']));
		
		if (empty($order)) return false;
		if ($params['type']=='wxapp') $params['type'] = 'wechat';
		foreach($order as $key=> $item){
			//生成核销码、二维码
			$data['hexiaoma'] = createRandomNumber(8);
			$url = app_url('records/check', array('orderid' => $item['id'], 'from'=>'qrcode'));
			createQrcode::createverQrcode($url, $item['orderno'], $item['id'], 'order');
			//支付处理
			if (!empty($params)) {
				$fee = $item['price'];
				$data['paytype'] = $params['type'];
				$data['status']	= 0;
				
				if ($params['type']!='delivery') {
					$data['status']	= 1;
					$data['paytime'] = date('Y-m-d H:i:s',TIMESTAMP);
					$data['payprice'] = $fee;
					if(!empty($params['tag'])) {
						$data['uniontid'] = $params['uniontid'];
						$data['transid'] = $params['tag']['transaction_id'];
					}
					//主办方进账
					if(!empty($item['merchantid'])){
						model_merchant::updateAmount($fee, $item['merchantid'], $item['id'], 1, '订单支付成功'); 
						pdo_insert("fx_merchant_money_record",array('merchantid'=>$item['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>$item['price'],'recordsid'=>$item['id'],'createtime'=>TIMESTAMP,'type'=>1,'detail'=>'支付成功<br>订单号：' . $item['orderno']));
					}
				}				
			}
			
			pdo_update('fx_activity_records', $data, array('id' => $item['id']));
		}
		return true;
	}
	
	static function getOrderCount($orderid, $status = ''){
		global $_W, $_GPC;
		if (is_numeric($orderid))
			$sql = 'select * from ' . tablename('fx_activity_records') . ' where id=:orderid and uniacid=:uniacid limit 1';
		else
			$sql = 'select * from ' . tablename('fx_activity_records') . ' where orderno=:orderid and uniacid=:uniacid order by id ASC limit 1';
		$order = pdo_fetch($sql, array(':orderid' => $orderid, ':uniacid' =>$_W['uniacid']));
		$order['marketing'] = unserialize($order['marketing']);
		
		$condition = 'and uniacid=:uniacid and orderno=:orderno';
		$params = array(':uniacid' => $_W['uniacid'], ':orderno' => $order['orderno']);
		if (!empty($status)) {
			$condition .= ' and status in('.$status.')';			
		}
		$count = pdo_fetch('select SUM(buynum) as buynum, SUM(price) as price, SUM(payprice) as payprice, group_concat(seats) as seats from ' . tablename('fx_activity_records') . ' where 1 ' . $condition, $params);
		$order['buynum'] = $count['buynum'];
		$order['price'] = sprintf("%.2f", $count['price']);
		$order['payprice'] = sprintf("%.2f", $count['payprice']);
		$order['seats'] = $count['seats'];
		
		$order['marketing']['market_price'] = $order['buynum'] * $order['marketing']['market_price'];
		$order['marketing']['deduct'][0] = $order['buynum'] * $order['marketing']['deduct'][0];
		$order['marketing']['deduct'][1] = sprintf("%.2f", $order['buynum'] * $order['marketing']['deduct'][1]);
		return $order;
	}
	
	static function getTotals($merch = 0) {
		global $_W;
		$paras = array(':uniacid' => $_W['uniacid']);
		$merch = intval($merch);

		if ($merch > 0) {//当前商户
			$condition .= ' and merchantid='.$merch;
		}
		if ($merch < 0) {//所有商户
			$condition .= ' and merchantid<>0';
		}

		$totals['all'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_activity_records') . '' . (' WHERE uniacid = :uniacid ' . $condition), $paras);
		$totals['status0'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_activity_records') . '' . (' WHERE uniacid = :uniacid ' . $condition . ' and status = 0'), $paras);
		$totals['status1'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_activity_records') . '' . (' WHERE uniacid = :uniacid ' . $condition . ' and status in (1,2) and review = 1'), $paras);
		$totals['status2'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_activity_records') . '' . (' WHERE uniacid = :uniacid ' . $condition . ' and status = 3'), $paras);
		$totals['status3'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_activity_records') . '' . (' WHERE uniacid = :uniacid ' . $condition . ' and status = 5'), $paras);
		$totals['status4'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_activity_records') . '' . (' WHERE uniacid = :uniacid ' . $condition . ' and status = 6'), $paras);
		$totals['status5'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_activity_records') . '' . (' WHERE uniacid = :uniacid ' . $condition . ' and status = 7'), $paras);
		$totals['status6'] = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('fx_activity_records') . '' . (' WHERE uniacid = :uniacid ' . $condition . ' and status = 8'), $paras);
		return $totals;
	}
	
	/** 
	* 订单账目结算 
	* 
	* @access static
	* @name orderAccount 
	* @param $item  订单信息
	* @param $item  订单信息
	*/  
	static function orderAccount($item=array(), $status=3, $detail='后台核销'){
		global $_W, $_GPC;
		if(!empty($item['price'])){
			if ($status==3){
				if($item['paytype']!='admin') {
					if ($_W['plugin']['poster']['config']['commission_enable']){
						//完成分销定单
						model_api::handler($_W['plugin']['poster']['config']);
						$complete = model_api::commission_completeOrder($item['orderno']);
						//读取当前订单分销佣金
						if ($complete=='OK') {
							$commission = model_api::commission_data($item['orderno']);
						}
					}
				}
				if(!empty($item['merchantid'])) {
					$type = 2;
					if($item['paytype']=='wechat' || $item['paytype']=='alipay' || $item['paytype']=='credit') {//只有微信、支付宝、余额成功支付的才可更新结算金额
						model_merchant::updateNoSettlementMoney($item['payprice'], $item['merchantid']);//更新可结算金额
					}elseif($item['paytype']=='delivery'){
						$msg = '，线下付款';
						$type = 6;
					}
					foreach ((array)$commission as $row) {
						model_merchant::updateNoSettlementMoney(0-$row['commission'], $item['merchantid']);
						//金额变更日志
						pdo_insert("fx_merchant_money_record",array('merchantid'=>$item['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>0-$row['commission'],'recordsid'=>$item['id'],'createtime'=>TIMESTAMP,'type'=>10,'detail'=>'推客佣金结算'.$msg));
					}
					//金额变更日志
					if ($item['paytype']!='admin' && $item['paytype']!='delivery')//后台支付订单不记录
						pdo_insert("fx_merchant_money_record",array('merchantid'=>$item['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>$item['payprice'],'recordsid'=>$item['id'],'createtime'=>TIMESTAMP,'type'=>$type,'detail'=>$detail.'<br>订单号：'.$item['orderno']));
				}
			}else{
				if (!empty($item['merchantid'])) {
					$money = $item['price'];
					$detail = '<br>订单号：' . $item['orderno'];
					switch($status){
						case '0':
							$type = 0;
							$money = 0 - $money;
							$detail = ($item['paytype']=='delivery'?'线下付款取消':'后台取消付款') . $detail;
							break;
						case '1':
							$type = 1;
							$detail = ($item['paytype']=='delivery'?'线下付款确认':'后台付款') . $detail;
							break;
						case '7':
							$type = 5;
							$money = 0 - $money;
							$detail = '退款' . $detail;
							//更新可结算金额
							($item['status']==3 || $item['ishexiao']==1) && model_merchant::updateNoSettlementMoney($money, $item['merchantid']);
							break;
					}
					model_merchant::updateAmount($money, $item['merchantid'], $item['id'], 1, $detail);  //主办方总账变更
					pdo_insert("fx_merchant_money_record",array('merchantid'=>$item['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>$money,'recordsid'=>$item['id'],'createtime'=>TIMESTAMP,'type'=>$type,'detail'=>$detail));
					
					if ($_W['plugin']['poster']['config']['commission_enable'] && $activity['prize']['commission'] && $_W['plugin']['poster']['config']['settlement_event']){
						if($item['paytype']!='admin') {
							if ($_W['plugin']['poster']['config']['commission_enable']){
								//完成分销定单
								model_api::handler($_W['plugin']['poster']['config']);
								$complete = model_api::commission_completeOrder($item['orderno']);
								//读取当前订单分销佣金
								if ($complete=='OK') {
									$commission = model_api::commission_data($item['orderno']);
								}
							}
						}
						if(!empty($item['merchantid'])) {
							foreach ((array)$commission as $row) {
								model_merchant::updateNoSettlementMoney(0-$row['commission'], $item['merchantid']);
								//金额变更日志
								pdo_insert("fx_merchant_money_record",array('merchantid'=>$item['merchantid'],'uniacid'=>$_W['uniacid'],'money'=>0-$row['commission'],'recordsid'=>$item['id'],'createtime'=>TIMESTAMP,'type'=>10,'detail'=>'推客佣金结算，'.$detail));
							}
						}
					}
				}
			}
		}
	}
	/** 
	* 单个订单退款 
	* 
	* @access static
	* @name refundMoney 
	* @param $orderno  订单号
	* @param $money    退款金额
	* @param $refund_reason  退款原因
	* @param $type     退款类型
	* @return array 
	*/  
	static function refundMoney($id,$money,$refund_reason,$type=5){
		global $_W;	
		$records  = model_records::getSingleRecords($id, '*');
		$activity = model_activity::getSingleActivity($records['activityid'], '*');
		
		if($records['paytype']=='credit') $records['transid']='余额支付';
		if($money<=0 || $records['price']<=0 || empty($records['transid'])){
			pdo_update("fx_activity_records", array('status'=>7), array('id'=>$records['id']));
			Util::deleteCache('records', $id);
			$res['status'] = false;
			$res['message'] = '退款额度必须大于0元';
			$res['error_code'] = '余额退款失败';
			return $res;
		}
		if ($records['merchantid'] && $records['ishexiao']){//已参与报名用户特殊情况退款需要核对主办方可结算额度
			$no_money = model_merchant::getNoSettlementMoney($records['merchantid']);
			if ($no_money < $money) {
				Util::deleteCache('records', $id);
				$res['status'] = false;
				$res['message'] = '可结算额度不足';
				$res['error_code'] = '余额退款失败';
				return $res;
			}
		}
		
		$data2 = array('refund_id'=>'','merchantid' => $activity['uid'], 'transid' => $records['transid'], 'createtime' => TIMESTAMP, 'status' => 0, 'type' => $type, 'activityid' => $records['activityid'], 'recordid' => $records['id'], 'payfee' => $records['price'], 'refundfee' => $money, 'refundername' => $records['realname'], 'refundermobile' => $records['mobile'], 'activityname' => $activity['title'], 'uniacid' => $_W['uniacid']);
		$refund_record = pdo_get('fx_refund_record', array('uniacid' => $_W['uniacid'], 'recordid' => $records['id']));
		if (empty($refund_record))
			pdo_insert('fx_refund_record', $data2);
		
		if($records['paytype'] == 'credit'){ //余额支付
			load()->model('mc');
			$uid = mc_openid2uid($records['openid']);
			if(mc_credit_update($uid, 'credit2', $money, array($_W['uid'], '余额退款操作',IN_MODULE, 0, 0, 2))) {
				$credit = mc_credit_fetch($uid);
				$time = date('Y-m-d H:i');
				$url = murl('mc/bond/credits', array('credittype' => 'credit2', 'type' => 'record', 'period' => '1'), true, true);
				$info = "【{$_W['account']['name']}】余额变更通知\n";
				$info .= "您在{$time}进行会员余额操作，余额增加{$money}】元，变更后余额【{$credit['credit2']}】元。\n";
				$info .= "备注：退款返还\n\n";
				sendCustomNotice($records['openid'],$info,$url,'');
				$refund = TRUE;
			}
		}elseif($records['paytype'] == 'wechat'){ //微信支付
			load()->model('refund');
			if ($paytype=='sys'){
				load()->model('refund');
				$tid = $records['orderno'];
				$fee = $money;
				$reason = '用户申请退款';
				$refund_id = refund_create_order($tid, IN_MODULE, $fee, $reason);
				if (is_error($refund_id)) { 
					$refund = FALSE;
					//itoast($refund_id['message'], referer(), 'error');
				}
				//发起退款
				$refund_result = refund($refund_id);
				if (is_error($refund_result)) {
					//itoast($refund_result['message'], referer(), 'error');
					$refund = FALSE;
				} else {
					pdo_update('core_refundlog', array('status' => 1), array('id' => $refund_id));
					//itoast('退款成功', referer(), 'info');
					$refund = TRUE;
				}
			}else{
				$tid = $records['orderno'];
				$fee = $money;
				$reason = '用户申请退款';
				$pay = new WeixinPay;
				//$arr = array('transid'=>$records['transid'],'totalmoney'=>$records['price'],'refundmoney'=>$money);
				
				$refund_id = refund_create_order($tid, IN_MODULE, $fee, $reason);
				$data = $pay -> refund($refund_id);
				
				if($data['err_code'] == 'NOTENOUGH') {
					$data = $pay -> refund($refund_id, 2);
				}
				if (empty($data)) {
					$data['err_code_des'] = '证书配置不正确';
					$data['err_code']     = 'ERROR';
				}
				if($data['return_code'] == 'FAIL') {
					$data['err_code_des'] = $data['return_msg'];
					$data['err_code']     = 'ERROR';
				}
				if(!empty($data['refund_id']) && $data['return_code']=='SUCCESS' && $data['result_code']=='SUCCESS') {
					pdo_update('core_refundlog', array('status' => 1), array('id' => $refund_id));
					$refund = TRUE;
				}else{
					pdo_update('core_refundlog', array('status' => '-1'), array('id' => $refund_id));
					$refund = FALSE;
				}
			}
		}

		if($refund){
			//主办方减帐
			model_records::orderAccount($records, 7);//账目结算
			pdo_update("fx_activity_records", array('status'=>7), array('id'=>$records['id']));
			pdo_update('fx_refund_record', array('status' => 1, 'refund_id' => $records['paytype']=='credit'?'余额退款':$data['refund_id']), array('recordid' => $records['id']));
			$url = app_url('order/detail',array('id'=>$id));
			$refund_reason=empty($refund_reason)?'报名取消':$refund_reason;
			//message::refund_success($records['orderno'], $records['openid'], $money, $url,$refund_reason);
			$res['status'] = true;
			$res['message'] = '退款成功';		
			$records['time'] = date("Y-m-d H:i:s",time());
			file_put_contents(FX_DATA . "/refundSuccess.log", var_export($records, true).PHP_EOL, FILE_APPEND);			
		}else{
			pdo_update('fx_refund_record', array('status' => 0, 'refund_id' => $records['paytype']=='credit'?'余额退款':$data['err_code_des']), array('recordid' => $records['id']));
			$res['status'] = false;
			$res['message'] = $records['paytype']=='credit'?'余额退款失败':$data['err_code_des'];
			$res['error_code'] = $records['paytype']=='credit'?'余额退款失败':$data['err_code'];
			$records['time'] = date("Y-m-d H:i:s",time());
			file_put_contents(FX_DATA . "/refundFail.log", var_export($records, true).PHP_EOL, FILE_APPEND);			
		}
		return $res;
	}
	/** 
	* 获取多个退款订单
	* 
	* @access static
	* @name getNumRefundRecords 
	* @param $num  个数
	* @return array 
	*/  
	static function getNumRefundRecords($num){
		global $_W;
		if($num==0){
			return pdo_fetchall("select price,status,transid,pay_type,orderno,id from".tablename("fx_activity_records")."where uniacid={$_W['uniacid']} and status=6");
		}else{
			return pdo_fetchall("select price,status,transid,pay_type,orderno,id from".tablename("fx_activity_records")."where uniacid={$_W['uniacid']} and status=6 ORDER BY ptime DESC " . "LIMIT 0,". $num);
		}
	}
	
	/** 
	* 更改订单为取消
	* 
	* @access static
	* @name cancelDoNotPayOrder 
	* @param $orderinfo  订单信息
	* @return  
	*/  
	static function cancelDoNotPayOrder($orderinfo){
		global $_W;
		if($orderinfo['status'] != 0) return false; //不是待支付的订单
		$res = pdo_update('fx_activity_records',array('status'=>5),array('id'=>$orderinfo['id'],'status'=>0));
		return $res;
	}
	/** 
	* 处理报名生成时活动优惠 
	* 
	* @access static
	* @name getafterMarketing 
	* @param $pay_price  处理前 名额数量*价格（不包括运费） 
	* @param $num  名额数量
	* @param $id  活动ID 
	* @param $shouldFreight  应该支付的运费 
	* @param $deduct  是否抵扣 
	* @return array 
	*/  
	static function getafterMarketing($pay_price,$num,$id,$deduct,$yearcard,$ismore=0,$count=0){
		global $_W;
		$marketing = model_activity::getMarketing($id); //获取营销参数
		$m1 = $m2 = $m3 = $m4 = FALSE;
		$max = $p = $cardReduce = 0;
		$cardReduce = $yearcard['money']?$yearcard['money']:0;
		$orderMarket=array();
		if(empty($marketing[2])){ //非VIP
			if($marketing[0]){ //折扣
				foreach($marketing[0] as $key => $value){
					if($num >= $value['meet']){
						$p = $value['meet']>$max?$value['give']:$p;
						$max = $value['meet']>$max?$value['meet']:$max;
						$m1 = TRUE;
					}
				}
				$orderMarket['discount'] = serialize(array($max,$p));
				$pay_price = $m1 ? $pay_price * $p * 0.1 : $pay_price;
			}elseif($marketing[1]){ //满减
				foreach($marketing[1] as $key => $value){
					if($num >= $value['meet']){
						$p = $value['meet']>$max?$value['give']:$p;
						$max = $value['meet']>$max?$value['meet']:$max;
						$m2 = TRUE;
					}
				}
				$p = $ismore ? $p/$num : $p;
				$max=sprintf("%.2f", $max);
				$orderMarket['enough'] = serialize(array($max,$p));
				$pay_price = $m2 ? $pay_price - $p : $pay_price;
			}
		}else{ //VIP级别
			$groupid = 0;
			foreach($marketing[2] as $key => $value){
				$group1 = pdo_get('mc_groups', array('uniacid' => $_W['uniacid'], 'groupid' => $value['groupid']), array('groupid', 'credit'));
				$group2 = pdo_get('mc_groups', array('uniacid' => $_W['uniacid'], 'groupid' => $_W['member']['groupid']), array('groupid', 'credit'));
				if ($_W['member']['groupid'] == $value['groupid']){
					if($value['discount']){
						$p = $value['discount'];
						$type = 1;
					}elseif($value['money']){
						$p = $value['money'];
						$type = 2;
					}
					$groupid = $value['groupid'];
					$m3 = TRUE;
				}
			}
			if ($type==1){
				$pay_price =  $pay_price * $p * 0.1;
			}elseif ($type==2){
				$p = $ismore ? $p/$num : $p;
				$pay_price = $pay_price >= $p ? $pay_price - $p : sprintf("%.2f", 0);
			}
			$orderMarket['vip'] = array('type' => $type, 'groupid' => $groupid);
		}
		if (!$ismore) {//非均摊算法处理
			$pay_price = sprintf("%.2f", $pay_price);
			$cardReduce = sprintf("%.2f", $cardReduce);
		}
		if (!empty($yearcard['money'])){//年卡
			$orderMarket['cardper'] = FALSE;
		}
		
		if (!empty($yearcard['percent'])){//年卡折扣
			$cardReduce = $pay_price * (1-$yearcard['percent'] * 0.1);
			$orderMarket['cardper'] = TRUE;
			$pay_price = $pay_price * $yearcard['percent']* 0.1;
		}
		
		if($marketing[3]['deduct']){ //积分抵扣
			$m4 = TRUE;
			$credit1 = $_W['member']['credit1'];
			$money = $marketing[3]['money']; //1积分抵扣多少钱
			$singleMax=$marketing[3]['deduct']; // 单件最多抵扣
			if($marketing[3]['manydeduct']){ //累计抵扣
				$manydeduct = $num * $singleMax; //累计可以抵扣金额
				if($money*$credit1 >= $manydeduct) {//有足够积分
					$deductMoney = $manydeduct;
					$deductCredit = $manydeduct/$money;
				}else{
					$deductMoney = $money*$credit1;
					$deductCredit = $credit1;
				}
			}else{ //只抵扣一件商品
				if($money*$credit1 >= $singleMax) {//有足够积分
					$deductMoney = $singleMax;
					$deductCredit = $singleMax/$money;
				}else{
					$deductMoney = $money*$credit1;
					$deductCredit = $credit1;
				}
			}
			$deductMoney = $ismore ? $deductMoney/$num : $deductMoney;
			$deductCredit = $ismore ? $deductCredit/$num : $deductCredit;
			
			$deductCredit = $pay_price >= $deductMoney ? $deductCredit : $pay_price/$money;
			$deductMoney = $pay_price >= $deductMoney ? $deductMoney : $pay_price;
			
			$orderMarket['deduct'] = array((int)$deductCredit, sprintf("%.2f", $deductMoney));			
		}
		
		$pay_price = sprintf("%.2f", $pay_price);
		$cardReduce = sprintf("%.2f", $cardReduce);
		
		if ($count){
			$pay_price = sprintf("%.2f", $pay_price * $num);
			$cardReduce = sprintf("%.2f", $cardReduce * $num);
			if ($orderMarket['vip']['type']==2 || $m2){
				$p = sprintf("%.2f", $p * $num);
			}
			$deductCredit = $deductCredit * $num;
			$deductMoney = sprintf("%.2f", $deductMoney * $num);			
		}
		
		if($deduct){
			$pay_price = $pay_price >= $deductMoney ? $pay_price - $deductMoney : 0;
		}
		
		return array(
				'pay_price'=>$pay_price,
				'm1'=>$m1,
				'm2'=>$m2,
				'm3'=>$m3,
				'm4'=>$m4,
				'max'=>$max ,
				'p'=>$p,
				'cardReduce'=>$cardReduce,
				'deductMoney'=>$deductMoney,
				'deductCredit'=>$deductCredit,
				'orderMarket'=>$orderMarket,
		); 
	}
}