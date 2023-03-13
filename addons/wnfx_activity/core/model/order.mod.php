<?php
/*红客联盟  hon123.com*/
if (!defined('IN_IA')) {
	exit('Access Denied');
}
class Order_FxModel
{
	public function getStatus($orderno = '')
	{
		global $_W;
		$uniacid = $_W['uniacid'];
		$condition = " and uniacid={$uniacid} and orderno='{$orderno}'";
		$sql = 'SELECT COUNT(*) FROM ' .tablename ('fx_activity_records') . " WHERE 1 $condition";
		$n = pdo_fetchcolumn($sql . " and status in(1,2)");
		if ($n)
			$status = 1;
		else{
			$n = pdo_fetchcolumn($sql . " and status in(3)");
			if ($n) 
				$status = 3;
			else{
				$n = pdo_fetchcolumn($sql . " and status in(5)");
				if ($n) 
					$status = 5;
				else{
					$n = pdo_fetchcolumn($sql . " and status in(6)");
					if ($n) 
						$status = 6;
					else{
						$n = pdo_fetchcolumn($sql . " and status in(7)");
						if ($n) 
							$status = 7;
					}
				}
			}
		}
		return $status;
	}
	
	public function getGoodsOrder($aid=0)
	{
		global $_W;
		$orderData = array();
		$condition = "uniacid={$_W['uniacid']} and activityid = $aid";
		$condition.= $optionid ? "" :'';
		$total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_activity_records') . " WHERE $condition");
		return $total;
	}
}
?>