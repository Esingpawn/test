<?php
/*红客联盟  hon123.com*/
if (!defined('IN_IA')) {
	exit('Access Denied');
}

function main()	{
	if (perm('sale.recharge')) {
		header('location: ' . web_url('sale/recharge'));
	}
	else {
		header('location: ' . web_url());
	}
}

function recharge() {
	global $_W, $_GPC;

	if ($_W['ispost']) {
		$recharges = array();
		$datas = is_array($_GPC['enough']) ? $_GPC['enough'] : array();

		foreach ($datas as $key => $value) {
			$enough = trim($value);

			if (!empty($enough)) {
				$recharges[] = array('enough' => trim($_GPC['enough'][$key]), 'give' => trim($_GPC['give'][$key]), 'credit' => trim($_GPC['credit'][$key]));
			}
		}

		$data['recharges'] = iserializer($recharges);
		m('common')->updatePluginset(array('sale' => $data));
		web_json();
	}

	$data = m('common')->getPluginset('sale');
	$recharges = iunserializer($data['recharges']);
	include fx_template();
}
?>
