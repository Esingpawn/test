<?php
/**
 * fx_activity模块小程序接口定义
 *
 * @author lzy305
 * @url
 */

defined('IN_IA') or exit('Access Denied');
require IA_ROOT . '/addons/wnfx_activity/core/common/defines.php';
require FX_CORE . '/class/loader.class.php';
$autoload = FX_CORE . '/class/autoload.php';
if(file_exists($autoload)) require $autoload;
fx_load()->func('global');
fx_load()->model('plugin');
class Wnfx_activityModuleWxapp extends WeModuleWxapp {
	//public $token = '83a5733403f118'; //接口通信token
	public $config;
	
	public function __construct()
	{
		global $_W,$_GPC;
		$uniacid = $_W['wxacid'] = $_W['uniacid'];
		$uni_link = pdo_get('uni_link_uniacid', array('uniacid' => $_W['uniacid']), 'link_uniacid');
		if (!empty($uni_link)){
			$uniacid = $_W['wxacid'] = $uni_link['link_uniacid'];			
		}
		$sql = 'SELECT `settings` FROM ' . tablename('uni_account_modules') . ' WHERE `uniacid` = :uniacid AND `module` = :module';
		$settings = pdo_fetchcolumn($sql, array(':uniacid' => $uniacid, ':module' => 'wnfx_activity'));
		$this->config = $_W['_config'] = unserialize($settings);
		$_W['_config']['link_uniacid'] = $uniacid;
	}
	public function doPageConfig(){
		global $_GPC, $_W;
		return $this->result(0, '', $_W['container']);
	}
	public function doPageApi(){
		global $_GPC, $_W;
		RouteModel::run(false);
	}
	public function doPageUser(){
		global $_GPC, $_W;
		return $this->result(0, '', $_W['fans']);
	}
	
	public function doPageQrcode(){
		global $_GPC, $_W;
		$account_api = WeAccount::create();
		$response = $account_api->getCodeLimit(urldecode($_GPC['url']));
		file_put_contents($_GPC['qrcode_file'], $response);
	}
	
	public function doPagePay() {
        global $_GPC, $_W;
		$ordertype = $_GPC['order_type'];
		$paytype = $_GPC['pay_type'];
        $ordersn = $_GPC['orderid'];
		$title = '订单支付';
		if ($ordertype=='goods'){
			$order = pdo_fetch("SELECT id, activityid, SUM(`price`) as price FROM ".tablename('fx_activity_records')." WHERE orderno = '{$ordersn}' AND status = 0");
			$goods = pdo_get('fx_activity', array('id'=>$order['activityid']), 'title');
			$title = $goods['title'];
		}
		if ($ordertype=='card'){
			$order = pdo_fetch("SELECT id, SUM(`fee`) as price FROM ".tablename('fx_yearcard_record')." WHERE orderno = '{$ordersn}'");
			$title = '年卡支付';
		}
		if ($ordertype=='recharge'){
			$order = pdo_fetch("SELECT id, SUM(`fee`) as price FROM ".tablename('mc_credits_recharge')." WHERE tid = '{$ordersn}'");
			$title = '余额充值';
		}
		
		$fee = $order['price'];
		
		if (!empty($order['id'])) {
			pdo_update('core_paylog', array(
				'uniacid'=>$_W['uniacid'], 
				'acid'=>$_W['acid'], 
				'openid'=>$_W['openid'],
				'type'=>'wxapp', 
				'module'=>IN_MODULE, 
				'is_wish'=>1
			), array('tid'=>$ordersn, 'type'=>'wechat', 'status'=>0));
		}else{
			return $this->result(1, '订单不存在', $order);
		}
		
        //构造支付参数
        $order = array(
            'tid' => $ordersn,
            'user' => $_W['openid'], //用户OPENID
            'fee' => floatval($fee), //金额
            'title' => $title,
        );
		
		//生成支付参数，返回给小程序端
		$pay_params = $this->pay($order);
		if (strpos($pay_params['message'], '商户订单号重复') !== false) {
			$moduleid = $_W['current_module']['mid'];
			$moduleid = empty($moduleid) ? '000000' : sprintf("%06d", $moduleid);
			$uniontid = date('YmdHis').$moduleid.random(8,1);
			pdo_update('core_paylog', array('uniontid' => $uniontid), array('tid'=>$ordersn, 'status'=>0));
			$pay_params = $this->pay($order);
		}
		return $this->result(0, '', $pay_params);
    }
	
	public function payResult($params) {
		global $_GPC, $_W;
		$uni_link = pdo_get('uni_link_uniacid', array('uniacid' => $params['uniacid']), 'link_uniacid');
		if (!empty($uni_link)){
			$_W['uniacid'] = $_W['acid'] = $uni_link['link_uniacid'];
		}else{
			$_W['uniacid'] = $params['uniacid'];
			$_W['acid'] = $params['acid'];
		}
		
		//修改paylog, uniacid
		pdo_update('core_paylog',array('uniacid'=>$_W['uniacid'], 'acid'=>$_W['acid']), array('tid'=>$params['tid'], 'uniacid'=>$params['uniacid']));
		
		$sql = 'SELECT `settings` FROM ' . tablename('uni_account_modules') . ' WHERE `uniacid` = :uniacid AND `module` = :module';
		$settings = pdo_fetchcolumn($sql, array(':uniacid' => $_W['uniacid'], ':module' => 'wnfx_activity'));
		$_W['_config'] = unserialize($settings);
		$_W['plugin'] = plugin_setting();
		
		if(!empty($params['tag'])) {
			$params['tag'] = iunserializer($params['tag']);	
		}
		payResult::payNotify($params);		
	}
}
