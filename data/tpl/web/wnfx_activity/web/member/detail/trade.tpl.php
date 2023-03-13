<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-lg control-label">成交订单</label>
	<div class="col-sm-9 col-xs-12">
		<div class='form-control-static'><?php  echo $member['ordercount'];?> </div>
	</div>
</div>
<div class="form-group">
	<label class="col-lg control-label">成交金额</label>
	<div class="col-sm-9 col-xs-12">
		<div class='form-control-static'><?php  echo floatval($member['ordermoney'])?> 元</div>
	</div>
</div>
<div class="form-group">
	<label class="col-lg control-label">最后一次成交时间</label>
	<div class="col-sm-9 col-xs-12">
		<div class='form-control-static'><?php  if(!empty($member['last_ordertime'])) { ?><?php  echo date('Y-m-d H:i:s', $member['last_ordertime']);?><?php  } else { ?>无任何交易<?php  } ?></div>
	</div>
</div>
