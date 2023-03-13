<?php
class message{	
	static function join_success($openid, $activity = array(), $recordid, $url) {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_join = $_W['_config']['m_join'];
		$timestr = date('Y年m月d日 H:i',strtotime($activity['starttime'])).' ~ '.date('Y年m月d H:i',strtotime($activity['endtime']));
		$item = model_records::getOrderCount($recordid);
		if (empty($item['aprice']))
		{
			$price = '免支付';	
		}else{
			$price = $item['paytype']=='delivery' ? '￥'.$item['price']." [线下支付待确认]" : '￥'.$item['price'];
		}
		$optionname = empty($item['optionname'])?"无":$item['optionname'];
		$first = empty($activity['tmplmsg']['jointitle'])?"尊敬的客户您好,您已成功报名":$activity['tmplmsg']['jointitle'];
		$remark = empty($activity['tmplmsg']['joinremark'])?"":"\n\n".$activity['tmplmsg']['joinremark'];
		//读取活动地址
		if ($activity['hasonline']){//线上
			$address = '线上活动';
		}elseif ($activity['hasstore']){//内部设置
			$address = $activity['address'];
		}else{//门店
			if (!empty($activity['storeids'])){
				if (count($activity['storeids'])>1){
					$address  = "多个场地请见详情";
				}else{
					$stores = model_activity::getNumActivityStore($activity['storeids']);
					$address = $stores[0]['address'];
				}
			}else{
				$uniacid = "uniacid = '{$_W['uniacid']}'";
				$total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_store') . " WHERE $uniacid and merchantid = ".$activity['merchantid']);
				if ($total > 0){
					$address  = "多个场地请见详情";
				}else{
					$merchant  = model_activity::getActivityMerchant($activity['merchantid']);//读取主办方
					$address  = $merchant['address'];
				}
			}
		}
		
		if (empty($m_join)){
			$msg = '';
			$msg .= "【报名提醒】尊敬的用户您好,您已成功报名.\n—— 活动时间：".$timestr."\n";
			$msg .= "";
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => "$first.\n",
					"color" => "#4a5077"
				) ,
				"keyword1" => array(
					'value' => $item['nickname'],
					"color" => "#4a5077"
				) ,
				"keyword2" => array(
					'value' => $activity['title'],
					"color" => "#4a5077"
				) ,
				"keyword3" => array(
					"value" => $timestr,
					"color" => "#4a5077"
				) ,
				"keyword4" => array(
					"value" => $item['buynum'] . "名",
					"color" => "#4a5077"
				) ,
				"keyword5" => array(
					"value" => $price,
					"color" => "#ff0000"
				) ,
				"remark" => array(
					"value" => "所选规格：".$optionname."\n\n活动地点：".$address.$remark,
				) ,
			);
			sendtplnotice($openid, $m_join, $postdata, $url."&from=msg");
		}
	}
	
	static function admin_notice($openid, $activity = array(), $recordid, $url) {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_join = $_W['_config']['m_join'];
		$timestr = date('Y年m月d日 H:i',strtotime($activity['starttime'])).' ~ '.date('Y年m月d H:i',strtotime($activity['endtime']));
		$item = model_records::getOrderCount($recordid);
		if (empty($item['aprice']))
		{
			$price = '免支付';	
		}else{
			$price = $item['paytype']=='delivery' ? '￥'.$item['price']." [线下支付待确认]" : '￥'.$item['price'];
		}
		if (empty($m_join)){
			$msg = '';
			$msg .= "【报名提醒】\n".$activity['title']."\n\n用户昵称：".$item['nickname'].".\n报名时间：".date('Y-m-d H:i:s',time())."\n用户手机：".$item['mobile'];
			$msg .= "";
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => "编号：".$item['orderno'] . "\n",
					"color" => "#4a5077"
				) ,
				"keyword1" => array(
					'value' => $item['nickname'],
					"color" => "#4a5077"
				) ,
				"keyword2" => array(
					'value' => $activity['title'],
					"color" => "#4a5077"
				) ,
				"keyword3" => array(
					"value" => $timestr,
					"color" => "#4a5077"
				) ,
				"keyword4" => array(
					"value" => $item['buynum'] . "名",
					"color" => "#4a5077"
				) ,
				"keyword5" => array(
					"value" => $price,
					"color" => "#ff0000"
				) ,
				"remark" => array(
					"value" => "用户手机：".$item['mobile'],
					"color" => "#4a5077"
				) ,
			);
			sendtplnotice($openid, $m_join, $postdata, $url);
		}
	}
	
	static function hexiao_notice($openid, $activity = array(), $url) {
		global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_hexiao = $_W['_config']['m_hexiao'];
		if (empty($m_hexiao)){
			$msg = "【核销提醒】尊敬的用户您好,您的活动凭证已成功消费.\n\n活动名称：".$activity['title'].".\n消费时间：".date('Y年m月d日 H:i:s',time())."\n\n";
			$url = app_url('records'); // 报名成功通知
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => "尊敬的用户您好,您的活动凭证已成功消费.\n",
					"color" => "#4a5077"
				) ,
				"keyword1" => array(
					'value' => $activity['title'],
				) ,
				"keyword2" => array(
					'value' => date('Y年m月d H:i:s',time()),
					"color" => "#4a5077"
				) ,
				"remark" => array(
					"value" => "",
					"color" => "#4a5077"
				) ,
			);
			sendtplnotice($openid, $m_hexiao, $postdata, $url);
		}
	}
	
	static function join_cancel($openid, $title, $starttime, $recordid, $url) {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_cancle = $_W['_config']['m_cancle'];
	    $item = model_records::getSingleRecords($recordid);
		$price = ($item['status']==0 || $item['status']==5) && $item['aprice'] > 0 && empty($item['payprice']) ? '￥'.$item['price']."[未支付]" : '￥'.$item['price'];
		$price = empty($item['aprice']) ? '免费' : $price;
		if (empty($m_cancle)){
			$msg = '';
			$msg .= "【报名提醒】尊敬的用户您好,您已成功取消报名.\n——".date('Y-m-d H:i:s',time())."\n";
			$msg .= "";
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => "您好，报名已被取消!",
					"color" => "#4a5077"
				) ,
				"keyword1" => array(
					'value' => $item['nickname'],
					"color" => "#4a5077"
				) ,
				"keyword2" => array(
					'value' => $title,
					"color" => "#4a5077"
				) ,
				"keyword3" => array(
					"value" => date('m月d日 H:i',strtotime($starttime)),
					"color" => "#4a5077"
				) ,
				"keyword4" => array(
					"value" => $price,
					"color" => "#4a5077"
				) ,
				"keyword5" => array(
					"value" => empty($item['payprice'])? "￥0" : "￥" . $item['payprice'],
					"color" => "#4a5077"
				) ,
				"remark" => array(
					"value" => "感谢您对\"".$_W['_config']['sname']."\"的支持，期待下次您的热情参与!",
					"color" => "#4a5077"
				) ,
			);
			sendtplnotice($openid, $m_cancle, $postdata, $url);
		}
	}
	
	static function join_review($openid, $activity = array(), $review, $url, $remark='') {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_review = $_W['_config']['m_review'];
		$timestr = date('Y年m月d日 H:i',strtotime($activity['starttime'])).' ~ '.date('Y年m月d H:i',strtotime($activity['endtime']));
		$first = $review ? ($review==1 ? "恭喜您，您的活动报名已审核通过.\n" : "很遗憾，您的活动报名审核未通过.\n") : "报名成功，已通知管理员审核.\n";
		if (empty($remark)){
			$remark = $review==2 ? "信息不符，官方已拒绝" : "点击详情查看更多详细信息";
		}
		switch($review){
			case 1:$result = '已通过';break;
			case 2:$result = '拒审';break;
			case 3:$result = '驳回修改';break;
			default:$result = '待审核';break;
		}
		if (empty($m_review)){
			$msg = '';
			$msg .= "【审核结果】\n尊敬的用户您好,您的报名审核" . $result . ".\n\n活动名称：" . $activity['title'] . "\n活动时间：" . $timestr . "\n";
			$msg .= "";
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => $first,
					"color" => "#4a5077"
				) ,
				"keyword1" => array(
					'value' => $activity['title'],
					"color" => "#4a5077"
				) ,
				"keyword2" => array(
					'value' => $timestr,
					"color" => "#4a5077"
				) ,
				"keyword3" => array(
					"value" => $result,
					"color" => "#FF0000"
				) ,
				"keyword4" => array(
					"value" => $remark,
					"color" => "#4a5077"
				) ,
				"remark" => array(
					"value" => '',
					"color" => "#4a5077"
				) ,
			);
			sendtplnotice($openid, $m_review, $postdata, $url);
		}
	}
	
	static function activity_review($openid, $activity = array(), $review, $url) {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_review = $_W['_config']['m_review'];
		$timestr = date('Y年m月d日 H:i',strtotime($activity['starttime'])).' ~ '.date('Y年m月d H:i',strtotime($activity['endtime']));
		$first = $review==1 ? "恭喜您，您发起的活动已审核通过.\n" : "很遗憾，您发起的活动审核未通过.\n";
		$remark = $review==1 ? "点击详情查看更多详细信息" : "请联系官方人员";
		//$url = $review ? $url : "";
		$result = $review==1 ? "已通过" : "未通过";
		if (empty($m_review)){
			$msg = '';
			$msg .= "【审核结果】\n尊敬的用户您好,您发起的活动审核" . $result . ".\n\n活动名称：" . $activity['title'] . "\n活动时间：" . $timestr . "\n";
			$msg .= "";
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => $first,
					"color" => "#4a5077"
				) ,
				"keyword1" => array(
					'value' => $activity['title'],
					"color" => "#4a5077"
				) ,
				"keyword2" => array(
					'value' => $timestr,
					"color" => "#4a5077"
				) ,
				"keyword3" => array(
					"value" => $result,
					"color" => "#4a5077"
				) ,
				"remark" => array(
					"value" => $remark,
					"color" => "#4a5077"
				) ,
			);
			sendtplnotice($openid, $m_review, $postdata, $url);
		}
	}
	
	static function admin_notice_cash($openid, $merchant = array(),$url) {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_cash = $_W['_config']['m_cash'];
		$first = "商户【".$merchant['name']."】提交了提现申请\n";
		$remark = "\n请及时处理！";
		//$url = $review ? $url : "";
		$result = $review==1 ? "已通过" : "未通过";
		if (empty($m_cash)){
			$msg = "商户【".$merchant['name']."】提交了提现申请\n\n";
			$msg .= "申请金额：￥".$merchant['money']."\n";
			$msg .= "提现订单：".$merchant['orderno']."\n";
			$msg .= "提现账户：".$merchant['account']."\n";
			$msg .= "申请时间：".date("Y-m-d H:i:s",$merchant['createtime'])."\n\n请及时处理！";
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => $first,
					"color" => "#4a5077"
				) ,
				"keyword1" => array(
					'value' => $merchant['name'],
					"color" => "#4a5077"
				) ,
				"keyword2" => array(
					'value' => "￥".$merchant['money'],
					"color" => "#4a5077"
				) ,
				"keyword3" => array(
					"value" => $merchant['orderno'],
					"color" => "#4a5077"
				) ,
				"keyword4" => array(
					"value" => $merchant['account'],
					"color" => "#4a5077"
				) ,
				"keyword5" => array(
					"value" => date("Y-m-d H:i:s",$merchant['createtime']),
					"color" => "#4a5077"
				) ,
				"remark" => array(
					"value" => $remark,
					"color" => "#4a5077"
				) ,
			);
			sendtplnotice($openid, $m_cash, $postdata, $url);
		}
	}
	
	static function send_msg($openid, $activity = array(), $params = array(), $url) {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_status = $_W['_config']['m_status'];
		$merchant['name'] = $_W['_config']['sname'];
		//读取活动地址
		if ($activity['hasonline']){//线上
			$address = '线上活动';
		}elseif ($activity['hasstore']){//内部设置
			$address = $activity['address'];
		}else{//门店
			if (!empty($activity['storeids'])){
				$stores = model_activity::getNumActivityStore($activity['storeids']);
				foreach ($stores as $key => $row) {
					$address = $row['address'];
					break;
				}
			}else{
				$merchant  = model_activity::getActivityMerchant($activity['merchantid']);//读取主办方
				$address  = $merchant['address'];
			}
		}
		switch($params['status']){
			case 1:
				$first  = $merchant['name']."：发布了新活动，快去报名吧！";
				$status_msg = '报名开始';
				$remark = "点击“详情”查看最新活动信息";
				$date   = date('Y年m月d H:i',strtotime($activity['starttime']))." ~ ".date('Y年m月d H:i',strtotime($activity['endtime']));
				break;
			case 2:
				$first  = "您参加的活动即将开始，请留意查看！";
				$status_msg = '活动开始';
				$remark = "点击“详情”查看您参加的活动信息";
				$date   = date('Y年m月d H:i',strtotime($activity['starttime']))." ~ ".date('Y年m月d H:i',strtotime($activity['endtime']));
				break;
			case 3:
				$first  = "您参加的活动圆满结束了";
				$status_msg = '活动结束';
				$remark = "【".$merchant['name']."】在此感谢所有用户的热情参与！";
				$date   = date('Y年m月d H:i',strtotime($activity['starttime']))." ~ ".date('Y年m月d H:i',strtotime($activity['endtime']));
				break;
			default:;
		}
		$first  = empty($params['first']) ? $first : $params['first'];
		$remark = empty($params['remark']) ? $remark : $params['remark'];
		if (empty($m_status)){
			$msg = "【活动状态】".$first.".\n\n活动名称：".$activity['title'].".\n活动时间：".date('Y年m月d H:i:s',strtotime($activity['starttime']))."\n\n".$remark;
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => $first."\n\n",
				) ,
				"keyword1" => array(
					'value' => $activity['title'],
				) ,
				"keyword2" => array(
					'value' => $date,
				) ,
				"keyword3" => array(
					'value' => $address,
				) ,
				"keyword4" => array(
					'value' => $status_msg,
				) ,
				"remark" => array(
					"value" => "\n\n".$remark,
				) ,
			);
			sendtplnotice($openid, $m_status, $postdata, $url);
		}
	}
	
	static function mcert_review($openid, $params = array(), $url) {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_mcert = $_W['_config']['m_mcert'];
		
		$first  = '尊敬的：'.$params['mname']."，您申请的主办方实名认证处理如下.";
		$remark = $params['status']==1 ? '认证资料已审核通过，请点击查看详情！' : '认证资料不符合要求，请仔细阅读认证相关说明！';
		$remark = empty($params['remark']) ? $remark : $params['remark'];
				
		if (empty($m_mcert)){
			$msg = $first . '\n认证类型：'.($params['type']==1 ? '个人认证' : '企业认证').'\n认证状态：'.($params['status']==1 ? '通过' : '被驳回').'\n审核时间：'.date('Y年m月d H:i:s', $params['createtime'])."\n\n".$remark;
			sendCustomNotice($openid,$msg,$url,'');
		}else{
			$postdata = array(
				"first" => array(
					"value" => $first."\n",
				) ,
				"keyword1" => array(
					'value' => $params['type']==1 ? '个人认证' : '企业认证',
				) ,
				"keyword2" => array(
					'value' => $params['name'],
				) ,
				"keyword3" => array(
					'value' => $params['status']==1 ? '通过' : '被驳回',
					"color" => $params['status']==1 ? "#008000" : "#ff0000"
				) ,
				"keyword4" => array(
					'value' => date('Y年m月d H:i', $params['createtime']),
				) ,
				"remark" => array(
					"value" => "\n\n".$remark,
				) ,
			);
			sendtplnotice($openid, $m_mcert, $postdata, $url);
		}
	}

	static function refund($openid, $order = array(), $url, $remark='') {
	    global $_W;
		if ($_W['_config']['mmsg']=='0' || $_W['account']->typeSign == 'wxapp') return false;
	    $m_refund = $_W['_config']['m_refund'];
				
		$first  = $order['status']==6 ? "亲，您的订单已经申请退款." : ($order['status']==7 ? "亲，订单已经完成退款，请注意查收.": "订单退款变更.");
		$status = $order['status']==6 ? '待处理，2-5个工作日' : ($order['paytype']=='wechat'?'1-5个工作日':'即时到账');
		$status = $order['status']==1 ? '退款失败' : $status;
		if (!empty($m_refund)){
			$postdata = array(
				"first" => array(
					"value" => $first."\n",
				) ,
				"keyword1" => array(
					'value' => $order['orderno'],
				) ,
				"keyword2" => array(
					'value' => "￥ " . $order['price'],
				) ,
				"keyword3" => array(
					'value' => $order['paytype']=='wechat' ? '微信零钱' : '余额',
				) ,
				"keyword4" => array(
					'value' => $status,
					"color" => $order['status']==6 || $order['status']==1 ? "#ff0000" : "#008000"
				) ,
				"remark" => array(
					"value" => $remark,
				) ,
			);
			sendtplnotice($openid, $m_refund, $postdata, $url);
		}
	}
}
?>