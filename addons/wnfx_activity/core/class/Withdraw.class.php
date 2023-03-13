<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 分销商基础模型
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
class Withdraw{
	static $model;
	static $set;
	static function handler($set) {
		global $_W, $_GPC;
		self::$set = $set;
        //POST数据
		return array('postdata'=>$_GPC['postdata'], 'manual'=>$_GPC['manual']);
	}
	static function getWithdraw($id) {
	    global $_W;
		$where['id'] = $id;
		$item = Util::getSingelData('*', 'fx_withdraw', $where);
		if(empty($item)) return array();
		$item['member'] = m('member')->getMember($item['member_id']);
		$item['pay_way_name'] = self::getPayname($item['pay_way']);
		$item['status_name'] = $item['status']?($item['status']==1?'未打款':'已打款'):'待审核';
		$item['created_at'] = date('Y-m-d H:i:s', $item['created_at']);
		$item['audit_at'] = !empty($item['audit_at']) ? date('Y-m-d H:i:s', $item['audit_at']) : '';
		$item['pay_at'] = !empty($item['pay_at']) ? date('Y-m-d H:i:s', $item['pay_at']) : '';
		$item['arrival_at'] = !empty($item['arrival_at']) ? date('Y-m-d H:i:s', $item['arrival_at']) : '';
		return $item;
	}
	static function addWithdraw($model) {
		global $_W, $_GPC;
		$order_id = '';
		$type_id = '';
		$amounts = $model['postdata']['amounts'];//提现总金额
		$poundage_rate = self::$set['commission']['poundage_rate'];//提现手续费比例
		$servicetax_rate = self::$set['income']['servicetax_rate'];//劳务税比例
		$actual_amounts = 0;//实际打款金额
		$actual_poundage = 0;//实际手续费
		$actual_servicetax = 0;//实际劳务税
		
		if ($amounts < self::$set['commission']['roll_out_limit']) {
			return array('error' => 1,'msg'=>'可提现额度不足 '.self::$set['commission']['roll_out_limit'].' 元');
		}
		
		$condition = "uniacid = '{$_W['uniacid']}' AND date(FROM_UNIXTIME(created_at)) = curdate() AND member_id=".$_W['member']['uid'];
		$today_withdraw = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_withdraw') . " WHERE $condition");
		if ($today_withdraw >= self::$set['commission']['max_time_out_limit']){
			return array('error' => 1,'msg'=>'每天只可提现 '.self::$set['commission']['max_time_out_limit'].' 次');
		}
		
		$type = $model['postdata']['type'];
		if ($type=='commission') {
			$type_name = '分销佣金';
			$where = array(
				'member_id' => $_W['member']['uid'],
				'status' => 0
			);
			$incomeData = Util::getNumData('*', 'fx_member_income', $where, 'id DESC', 1, 1, 0);
			foreach ($incomeData[0] as $k => $item) {
				$type_id .= $item['id'].',';
				$order_id .= $item['incometable_id'].',';
			}
		}elseif($type=='balance'){
			$type_name = '余额提现';
		}
		$poundage = sprintf("%.2f", $amounts * $poundage_rate * 0.01);
		$servicetax = sprintf("%.2f", ($amounts - $poundage) * $servicetax_rate * 0.01);
		if (self::$set['income']['free_audit']) {
			$actual_poundage = $poundage;
			$actual_servicetax = $servicetax;
			$actual_amounts = $amounts - $actual_poundage - $actual_servicetax;
		}
		$withdrawData = array(
			'uniacid' => $_W['uniacid'],
			'withdraw_sn' => 'WS'.date('YmdHis').substr(microtime(), 2, 6),
			'member_id' => $_W['member']['uid'],
			'type' => $type,
			'type_id' => $type_id,
			'type_name' => $type_name,
			'amounts' => $amounts,
			'poundage' => $poundage,
			'poundage_rate' => $poundage_rate,
			'pay_way' => $model['manual']==2?'wechat':($model['manual']==3?'alipay':($model['manual']==4?'balance':'bank')),
			'status' => self::$set['income']['free_audit']?1:0,
			'created_at' => time(),
			'actual_amounts' => $actual_amounts,
			'actual_poundage' => $actual_poundage,
			'servicetax' => $servicetax,
			'servicetax_rate' => $servicetax_rate,
			'actual_servicetax' => $actual_servicetax,
			'manual_type' => $model['manual'],
		);
		$id = self::insertWithdraw($withdrawData);
		if ($id && $type=='commission'){
			$pay_status = 0;
			if (self::$set['income']['free_audit']) {
				$pay_status = 1;
			}
			pdo_update('fx_commission_order', array('withdraw'=>1), array ('id' => explode(',',$order_id)));
			pdo_update('fx_member_income', array('status'=>1,'pay_status'=>$pay_status,'updated_at'=>time()), array ('id' => explode(',',$type_id)));
		}else{
			return array('error' => 1,'msg'=>'提现失败!');
		}
		if ($model['manual']==4 && self::$set['income']['free_audit']) {//自动充值到余额
			$_GPC['id'] = $id;
			Withdraw::payController();
		}
		return array('error' => 0,'msg'=>'提现成功，等待审核打款!');
	}
	
	static function addWithdraw1($item) {
		global $_W, $_GPC;
		$order_id = '';
		$type_id = '';
		$amounts = $item['amount'];//提现总金额
		$poundage_rate = self::$set['commission']['poundage_rate'];//提现手续费比例
		$servicetax_rate = self::$set['income']['servicetax_rate'];//劳务税比例
		$actual_amounts = 0;//实际打款金额
		$actual_poundage = 0;//实际手续费
		$actual_servicetax = 0;//实际劳务税
		
		$type = 'commission';
		$type_name = '分销佣金';
		$type_id .= $item['id'];
		$order_id .= $item['incometable_id'];
			
		$poundage = sprintf("%.2f", $amounts * $poundage_rate * 0.01);
		$servicetax = sprintf("%.2f", ($amounts - $poundage) * $servicetax_rate * 0.01);
		
		$actual_poundage = $poundage;
		$actual_servicetax = $servicetax;
		$actual_amounts = $amounts - $actual_poundage - $actual_servicetax;
		if ($actual_amounts < 1) return false;
		$withdrawData = array(
			'uniacid' => $_W['uniacid'],
			'withdraw_sn' => 'WS'.date('YmdHis').substr(microtime(), 2, 6),
			'member_id' => $item['member_id'],
			'type' => $type,
			'type_id' => $type_id,
			'type_name' => $type_name,
			'amounts' => $amounts,
			'poundage' => $poundage,
			'poundage_rate' => $poundage_rate,
			'pay_way' => $_GPC['manual']==2?'wechat':($_GPC['manual']==3?'alipay':($_GPC['manual']==4?'balance':'bank')),
			'status' => self::$set['income']['free_audit']?1:0,
			'created_at' => time(),
			'actual_amounts' => $actual_amounts,
			'actual_poundage' => $actual_poundage,
			'servicetax' => $servicetax,
			'servicetax_rate' => $servicetax_rate,
			'actual_servicetax' => $actual_servicetax,
			'manual_type' => $_GPC['manual'],
		);
		
		$id = self::insertWithdraw($withdrawData);
		if ($id && $type=='commission'){
			$pay_status = 0;
			if (self::$set['income']['free_audit']) {
				$pay_status = 1;
			}
			pdo_update('fx_commission_order', array('withdraw'=>1), array ('id' => explode(',',$order_id)));
			pdo_update('fx_member_income', array('status'=>1,'pay_status'=>$pay_status,'updated_at'=>time()), array ('id' => explode(',',$type_id)));
		}
		$_GPC['id'] = $id;
		Withdraw::payController();
	}
	
	static function insertWithdraw($data){
		pdo_insert('fx_withdraw', $data);
		$id = pdo_insertid();
		return $id;
	}
	
	static function dealt(){
		global $_W,$_GPC;
		if (isset($_GPC['submit_check'])) {
           //审核
           return self::audited();
        } elseif (isset($_GPC['submit_pay'])) {
            //打款
			return self::payController();
        } elseif (isset($_GPC['submit_cancel'])) {
            //重新审核
            return self::audited();
        } elseif (isset($_GPC['confirm_pay'])) {
            return  self::payController();
            //确认打款
        }elseif (isset($_GPC['audited_rebut'])) {
            //审核后驳回
            return self::auditedRebut();
        }
	}
	static function audited(){
		global $_W,$_GPC;
		$id = intval($_GPC['id']);
		$audit = $_GPC['audit'];
		$_time = time();
		$actual_poundage = 0;
		$amounts = 0;
		$actual_servicetax = 0;
		$res = 0;
		$ids = array();
		
		$withdraw = self::getWithdraw($id);
		foreach ($audit as $k => $item) {
			$ids[] = $k;
		}
		$incomes = pdo_getall('fx_member_income', array('id' => $ids));
		foreach ($incomes as $k => $v) {
			if ($v['pay_status'] != $audit[$v['id']]) {
				$incomeData = array('status' => 1,'pay_status' => $audit[$v['id']], 'updated_at'=>$_time);
				if ($audit[$v['id']]==3) {
					$incomeData = array('status' => 0,'pay_status' => $audit[$v['id']], 'updated_at'=>$_time);
				}
				$res = pdo_update('fx_member_income', $incomeData, array ('id' => $v['id']));
			}
			if ($audit[$v['id']]==1) {
				$actual_poundage += sprintf("%.2f", $v['amount'] * $withdraw['poundage_rate'] * 0.01);
				$amounts += $v['amount'];
			}	
		}
		$actual_servicetax = sprintf("%.2f", ($amounts -$actual_poundage) * $withdraw['servicetax_rate'] * 0.01);
		//if ($res){
			$data = array(
				'status' => 1,
				'actual_amounts' => $amounts - $actual_poundage - $actual_servicetax,
				'actual_poundage' => $actual_poundage,
				'actual_servicetax' => $actual_servicetax,
				'audit_at' => $_time,
				'updated_at' => $_time,
			);
			$result = self::updateWithdraw($data, $id);
		//}
		return array('error'=>!$result, 'msg'=> $result ? '审核成功！':'审核失败！');
	}
	static function auditedRebut(){
		global $_W,$_GPC;
		$id = intval($_GPC['id']);
		$audit = $_GPC['audit'];
		$_time = time();
		$ids = array();
		foreach ($audit as $k => $item) {
			$ids[] = $k;
		}
		$incomeData = array('status' => 0,'pay_status' => 3,'updated_at'=>$_time);
		$result = pdo_update('fx_member_income', $incomeData, array ('id' => $ids, 'pay_status'=>1));
		if ($result){
			$data = array(
				'status' => 2,
				'actual_amounts' => 0,
				'actual_poundage' => 0,
				'actual_servicetax' => 0,
				'updated_at' => $_time,
			);
			self::updateWithdraw($data, $id);
		}
		return array('error'=>!$result, 'msg'=> $result ? '驳回成功！':'驳回失败！');
	}
	static function updateWithdraw($data, $id){
		global $_W,$_GPC;
		$result = pdo_update('fx_withdraw', $data, array ('id' => $id));
		return $result;
	}
	/**
     * @param $level
     * @return string
     * 分销商层级转换
     */
    static function getPayname($pay_way) {
        switch ($pay_way) {
            case 'wechat':
                $payname = '微信';//分销层级
                break;
            case 'alipay':
                $payname = '支付宝';//分销层级
                break;
			case 'balance':
                $payname = '余额';//分销层级
                break;
            default:
                $payname = '银行卡';//分销层级
        }
        return $payname;
    }
	/** 
	* 打款处理 
	* 
	* @access static
	* @name payController 
	* @param $openid  收款人OPENID 
	* @param $money   收款（分）
	* @param $desc    说明 
	* @return array 
	*/  
	static function payController() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);
		$list = array();
		if ($id) {
			$list[] = self::getWithdraw($id);
		}else{
			$list = pdo_getall('fx_withdraw', array('uniacid'=>$_W['uniacid'], 'status'=>1));
		}
		//载入日志函数
		load()->func('logging');
		foreach ($list as $k => $withdraw) {
			if ($withdraw['status']!=1) {
				$rearr = array('error'=> 1, 'msg'=> '打款状态错误！');
			}else{
				$withdraw['member'] = m('member')->getMember($withdraw['member_id']);
				$request = array(
					'openid' =>$withdraw['member']['openid'],
					'money'  =>$withdraw['actual_amounts'],
					'desc'   =>$withdraw['type']=='commission'?'分销佣金提现':'商家提现'
				);
				
				if (empty($_GPC['confirm_pay']) && empty($_GPC['submit_pay'])) {//自动打款
					if ($withdraw['pay_way']=='wechat') {
						$pay = new WeixinPay;
						$result = $pay->pay($request);
						if ($result['return_code'] != 'SUCCESS' || $result['result_code'] != 'SUCCESS' || $result['result_code']=='FAIL') {
							$rearr = array(
								'error'=> 1,
								'msg'=> $result['return_msg'].': ' .$result['err_code']."|" .$result['err_code_des']
							);
						}else{
							$rearr = array(
								'error'=> 0,								
								'msg'=> '打款到微信钱包：金额'.$withdraw['actual_amounts'],
								'openid'=>$withdraw['member']['openid'],
								'nickname'=>$withdraw['member']['nickname']
							);
						}
						$rearr['operation'] = '自动打款';
						$rearr['type'] = $withdraw['type']=='commission'?'分销佣金提现':'商家提现';
					}elseif($withdraw['pay_way']=='balance'){
						credit_update_credit2($withdraw['member_id'], $withdraw['actual_amounts'], $remark = '佣金提现到余额');
						$rearr = array(
							'error'=> 0,
							'msg'=> '充值到余额：金额'.$withdraw['actual_amounts'],
							'openid'=>$withdraw['member']['openid'],
							'nickname'=>$withdraw['member']['nickname'],
						);
					}else{
						$rearr = array(
							'error'=>1,
							'msg'=>'自动打款只支持余额、微信钱包，跳过当前打款类型！'
						);
					}
				}else{//后台打款
					if ($_GPC['submit_pay']=='打款到微信钱包'){
						$pay = new WeixinPay;
						$result = $pay->pay($request);
						if ($result['return_code'] != 'SUCCESS' || $result['result_code'] != 'SUCCESS' || $result['result_code']=='FAIL') {
							$rearr = array(
								'error'=> 1,
								'msg'=> $result['return_msg'].': ' .$result['err_code']."|" .$result['err_code_des']
							);
						}else{
							$rearr = array(
								'error'=> 0,
								'msg'=> '打款到微信钱包：金额'.$withdraw['actual_amounts'],
								'openid'=>$withdraw['member']['openid'],
								'nickname'=>$withdraw['member']['nickname'],
							);
						}
						$rearr['operation'] = '后台打款';
						$rearr['type'] = $withdraw['type']=='commission'?'分销佣金提现':'商家提现';
					}elseif($_GPC['submit_pay']=='打款到支付宝'){
						
					}elseif($_GPC['submit_pay']=='打款到余额'){
						credit_update_credit2($withdraw['member_id'], $withdraw['actual_amounts'], $remark = '佣金提现到余额');
						$rearr = array(
							'error'=> 0,
							'msg'=> '充值到余额：金额'.$withdraw['actual_amounts'],
							'openid'=>$withdraw['member']['openid'],
							'nickname'=>$withdraw['member']['nickname'],
						);
					}elseif($_GPC['submit_pay']=='打款到银行卡'){
						
					}elseif($_GPC['submit_pay']=='手动打款'){
						
					}elseif($_GPC['confirm_pay']=='线下确认打款'){
						$rearr = array('error'=> 0, 'msg'=> '线下确认打款：金额'.$withdraw['actual_amounts']);
					}
				}
				if (!$rearr['error']) {
					$_time = time();
					$ids = array();			
					$ids = explode(',', $withdraw['type_id']);
					$res = pdo_update('fx_member_income', array('pay_status' => 2,'updated_at'=>$_time), array ('id' => $ids,'pay_status'=>1));
					if ($res){
						$data = array(
							'status' => 2,
							'pay_at' => $_time,
							'arrival_at' => $_time,
						);
						self::updateWithdraw($data, $withdraw['id']);
						pdo_update('fx_agents', array('commission_pay +=' => $withdraw['actual_amounts']), array ('member_id' => $withdraw['member_id']));
					}
				}
			}
			if (!empty($rearr)) {
				$rearr['order'] = "金额:".$request['money']."|".$withdraw['withdraw_sn'];
				logging_run($rearr);
			}
		}
		return $rearr;
	}
}
?>
