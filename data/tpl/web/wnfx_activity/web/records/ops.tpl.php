<?php defined('IN_IA') or exit('Access Denied');?><?php  if($row['review']<>1 && (in_array($row['status'], array(1,2)) || $row['paytype']=='delivery')) { ?>
    <span class="text-danger"><?php  if($row['review']==3) { ?>驳回修改<?php  } else if($row['review']==2) { ?>已拒审<?php  } else { ?>待审核<?php  } ?></span>
    <?php  if(perm('order.op.check')) { ?>
    <a class="btn btn-danger-o btn-xs" data-toggle="ajaxModal" href="<?php  echo web_url('records/op/review',array('id'=>$row['id']))?>">审核</a>
    <?php  } ?>
    <?php  if($row['review']==2 && perm('order.op.refund')) { ?>
    	<?php  if(!($row['status']==3 && MERCHANTID) && in_array($row['paytype'], array('credit','wechat'))) { ?>
        <a class="btn btn-danger btn-xs" data-toggle="ajaxPost" href="<?php  echo web_url('records/op/refund',array('id'=>$row['id']))?>" data-confirm="确认退款此订单吗？">确认退款</a>
        <?php  } ?>
    <?php  } ?>
<?php  } else { ?>    
    <?php  if($row['status']==0) { ?>
    <span class="text-danger">待付款</span>
    <?php  if(perm('order.op.pay')) { ?>
    <a class="btn btn-danger btn-xs" data-toggle="ajaxPost" href="<?php  echo web_url('records/op/pay',array('id'=>$row['id']))?>" data-confirm="确认此订单已付款吗？">确认付款</a>
    <?php  } ?>
    <?php  } ?>
    
    <?php  if($row['status']==1 || $row['status']==2) { ?>
        <span class="text-primary">待核销</span>
        <?php  if(perm('order.op.verify')) { ?>
        <a class="btn btn-primary btn-xs" data-toggle="ajaxPost" href="<?php  echo web_url('records/op/hexiao',array('id'=>$row['id']))?>" data-confirm="确认核销此订单吗？">确认核销</a>
        <?php  } ?>
        <?php  if(perm('order.op.paycancel')) { ?>
        <?php  if($row['paytype']=='delivery' || $row['paytype']=='admin') { ?>
        <a class="btn btn-white btn-xs" data-toggle="ajaxPost" href="<?php  echo web_url('records/op/paycancel',array('id'=>$row['id']))?>" data-confirm="确认取消付款吗？">取消付款</a>
        <?php  } ?>
        <?php  } ?>
    <?php  } ?>
    
    <?php  if($row['status']==3) { ?><span class="text-success">已完成</span><?php  } ?>
    
    <?php  if($row['status']==5) { ?>
    	<span class="text-default">已取消</span>
    	<?php  if(perm('order.op.refund') && in_array($row['paytype'], array('credit','wechat'))) { ?>
        <a class="btn btn-danger btn-xs" data-toggle="ajaxPost" href="<?php  echo web_url('records/op/refund',array('id'=>$row['id']))?>" data-confirm="确认退款此订单吗？">确认退款</a>
        <?php  } ?>
    <?php  } ?>
    
    <?php  if($row['status']==6) { ?>
        <span class="text-warning">待退款</span>
        <?php  if(perm('order.op.refund')) { ?>
        <a class="btn btn-warning btn-xs" data-toggle="ajaxModal" href="<?php  echo web_url('records/op/refund',array('id'=>$row['id']))?>">确认退款</a>
        <?php  } ?>
    <?php  } else { ?>
    	<?php  if($row['status']==7) { ?>
        <span class="text-default">已退款</span>
        <?php  } else if(in_array($row['status'], array(1,3)) && in_array($row['paytype'], array('credit','wechat'))) { ?>
        <?php  if(perm('order.op.refund')) { ?>
        <?php  if(!($row['status']==3 && MERCHANTID)) { ?>
        <a class="btn btn-danger btn-xs" data-toggle="ajaxPost" href="<?php  echo web_url('records/op/refund',array('id'=>$row['id']))?>" data-confirm="确认退款此订单吗？">确认退款</a>
        <?php  } ?>
        <?php  } ?>
        <?php  } ?>    	
    <?php  } ?>
<?php  } ?>