<?php
/**
 * 活动报名模块处理程序
 * @author 山西微链网络科技有限公司
 * @url https://www.sxwelink.com/
 */
defined('IN_IA') or exit('Access Denied');
require IA_ROOT . '/addons/wnfx_activity/core/common/defines.php';
require FX_CORE . '/class/loader.class.php';
$autoload = FX_CORE . '/class/autoload.php';
if(file_exists($autoload)) require $autoload;
fx_load()->func('global');
fx_load()->model('plugin');
class Wnfx_activityModuleProcessor extends WeModuleProcessor {
	public function respond() {
		global $_W;
		//这里定义此模块进行消息处理时的具体过程, 请查看微擎文档来编写你的代码
		$_W['_config'] = $this->module['config'];
		$message = $this -> message;
		$openid = $this -> message['from'];
		$content = $this -> message['content'];
		$msgtype = strtolower($message['msgtype']);
		$event = strtolower($message['event']);
		if ($msgtype == 'text' || $event == 'click') {
			$saler = pdo_fetch('select * from ' . tablename('fx_saler') . " where INSTR(`openid`, '$openid') and status=:status and uniacid=:uniacid", array(':status' => 1, ':uniacid' => $_W['uniacid']));
			if (empty($saler)) {
				$this -> endContext();
				return $this -> respText('您无核销权限!');
				return $this -> salerEmpty();
			} 
			if (!$this -> inContext) {
				$this -> beginContext();
				return $this -> respText('请输入核销码:');
			} else if ($this -> inContext && is_numeric($content)) {
				$records = pdo_fetch('select * from ' . tablename('fx_activity_records') . ' where hexiaoma=:hexiaoma and uniacid=:uniacid', array(':hexiaoma' => $content, ':uniacid' => $_W['uniacid']));
				if (empty($records)) {
					return $this -> respText('未找到要核销的报名,请重新输入!');
				}
				if ($records['ishexiao'] == 1) {
					$this -> endContext();
					return $this -> respText('此报名已核销，无需重复核销!');
				} 
				if ($records['status'] != 1 && $records['status'] != 2) {
					$this -> endContext();
					return $this -> respText('报名状态错误，无法核销!');
				} 
				$storeids = array();
				$salerids = array();
				$activity = model_activity::getSingleActivity($records['activityid'], '*');
				$storeids = array_merge($activity['storeids'], $storeids);
				$salerids = array_merge(explode(',', $saler['storeid']), $salerids);
				if (!empty($saler['storeid'])) {
					$inter = array_intersect($storeids, $salerids);
					if (empty($inter)) {
						return $this -> respText('您对当前活动无核销权限!');
					}
				}
				$data = array(
					'payprice' => $records['price'], 
					'status'=>3,
					'ishexiao'=>1,
					'veropenid' => $openid,
					'sendtime'=>date('Y-m-d H:i:s',TIMESTAMP)
				);
				$result = pdo_update('fx_activity_records', $data, array('id' => $records['id']));
				model_records::orderAccount($records,3,'核销码核销');//账目结算
				$remark = '参与名额 ' . $records['buynum'] . ' 人';
				//积分奖励
				if ($_W['_config']['creditstatus'] == 1 && $activity['prize']['sign_credit'] > 0) {
					$credit = intval($activity['prize']['sign_credit']);//赠送积分额度
					m('member')->credit_update_credit1($records['uid'], $credit, "核销获取" . $credit . m('member')->getCreditName('credit1'), $records['merchantid']);
				}
				$url = app_url('order/detail', array('id'=>$records['id'], 'type'=>'u')); // 报名成功通知
				message::hexiao_notice($records['openid'], $activity, $url);
				$this -> endContext();
				return $this -> respText("核销成功!\n\n" . $remark);
			} 
		} 
	}
	private function salerEmpty() {
		ob_clean();
		ob_start();
		echo '';
		ob_flush();
		ob_end_flush();
		exit(0);
	}
}