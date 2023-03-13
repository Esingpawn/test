<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
	.trhead td {  background:#efefef;text-align: center}
    .trbody td {  text-align: center; vertical-align:top;border-left:1px solid #f2f2f2;overflow: hidden; font-size:12px;}
    .trorder { background:#f8f8f8;border:1px solid #f2f2f2;text-align:left;}
    .ops { border-right:1px solid #f2f2f2; text-align: center;}
    .ops a,.ops span{
        margin: 3px 0;
    }
    .table-top .op:hover{
        color: #000;
    }
    .tables{
        border:1px solid #e5e5e5;
        line-height: 18px;
		margin-top:20px;
		overflow:hidden
    }
    .tables:hover{
        border:1px solid #b1d8f5;
    }
    .table-row,.table-header,.table-footer,.table-top{
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        -webkit-justify-content: center;
        -webkit-align-content: space-around;
        align-content: space-around;
    }
    .tables .table-row>div{
        padding: 14px 0 !important;
    }
    .tables .table-row>div.columnFlex{
        padding: 0 !important;
    }
    .tables .table-row.table-top>div{
        margin: 0 !important;
        padding: 16px 0;
    }
    .tables .table-row .ops.list-inner{
        border-right:none;
    }
    .tables .list-inner{
       border-right: 1px solid #efefef;
        vertical-align: middle;
    }
	.tables .list-inner .btn~.btn{
		margin-top:3px;
	}
    .table-row .goods-des .title{
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .table-row .goods-des{
        width:300px;
        border-right: 1px solid #efefef;
        vertical-align: middle;
    }
    .table-row .goods-des.singleRefund{
        padding: 0px !important;
        display: flex;
        flex-direction: column;
        margin: 0 !important;
    }
    .table-row .goods-des.singleRefund{
        padding: 16px 0;

    }
    .table-row .goods-des.singleRefund .goodsRefund{
        border-bottom: 1px solid #efefef;
        flex-direction: initial;
        margin: 0 !important;
    }
    .table-row .list-inner{
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
        text-align: center;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-flex-direction: column;
        flex-direction: column;
    }
	.table-row.table-con{padding:0 20px;overflow:hidden;height:0;-webkit-transition:all .5s;transition:all .5s;border-top: 1px solid #efefef;position:relative;bottom:-1px;margin-top:-1px;}
	.table-row.active{padding-top:15px;padding-bottom:15px;height:auto;border-top:1px solid #efefef;}
    .saler>div{
        width:130px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .table-row .list-inner.ops, .table-row .list-inner.paystyle{
        -webkit-flex-direction: column;
        flex-direction: column;
       -webkit-justify-content: center;
       justify-content: center;
    }
    .table-header .others{
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
		text-align:center;
    }
	.table-header .others.text-left{text-align:left;}
    .table-footer>div, .table-top>div{
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
        height:100%;
    }
    .fixed-header div{
        padding:0;
    }
    .fixed-header.table-header{
        display: none;
    }
    .fixed-header.table-header.active{
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
		padding:0 50px;
    }
    .shop{
        display: inline-block;
        width:48px;
        height:18px;
        text-align: center;
        border:1px solid #1b86ff;
        color: #1b86ff;
        margin-right: 10px;
    }
    .min_program{
        display: inline-block;
        width:48px;
        height:18px;
        text-align: center;
        border:1px solid #ff5555;
        color: #ff5555;
        margin-right: 10px;
    }
    .columnFlex{
        display: flex;
        flex-direction: column;
    }
    .columnFlex .noRefund{
        flex:1;
        width:100%;
        position: relative;
        display: flex;
		padding: 16px 10px;
        flex-direction: column;
        justify-content: center;        
        align-items: center;
    }
	.noRefund.text-left{align-items:left;}
    .goodsRefund{
        height:103px;
        display: flex;
        width:100%;
        position: relative;
        flex-direction: column;
        justify-content: center;
        border-bottom: 1px solid #efefef;
        padding: 16px 10px;
        align-items: center;
    }
    .table-row .list-inner.goodsRefund{
        flex: inherit;
    }
    .rr-label{
        width: 75px;
        margin-right: 8px;
        padding: 5px;
        border: 1px solid #eee;
        border-radius: 4px;
        background: #44ABF7;
        color: #fff;
        text-align: center;
    }
    .rr-process{
        color: #44ABF7;
        cursor: pointer;

    }
    .rr-process .input-group {
        display: none;
    }
    .rr-process .input-group:first-of-type{
        display: block;
    }
    .rr-process .form-control {
        display: none;
    }
    .rr-process .input-group-btn .btn{
        background: none!important;
        border: none!important;
        color: #44ABF7!important;
        outline: none!important;
    }
    .rr-process .input-group-btn .btn:active {
        border: none!important;
        box-shadow: none!important;
    }
</style>
<div class="page-header">	
	<span>
    订单数:  <span class="text-danger"><?php  echo $total;?></span> 总金额:  <span class="text-danger"><?php  echo $total_price;?></span>
    <?php  if(!empty($total_payprice)) { ?> 收入金额:  <span class="text-danger"><?php  echo $total_payprice;?></span><?php  } ?>
    </span>
</div>
<div class="page-content">
	<div class="fixed-header table-header">
    	<div style="width:30px;"></div>
		<div style="width:300px;text-align:left;">基本信息</div>
        <div class="others">票种</div>
        <div class="others">金额（元）</div>
        <div class="others">支付</div>
        <div class="others">票数</div>
        <div class="others">核销码</div>
        <?php  if(checkplugin('seat')) { ?><div class="others">座位</div><?php  } ?>
        <div class="others">签到</div>
        <div class="others">状态</div>
        <div class="others">操作</div>
	</div>
	<form action="" method="get" class="form-horizontal form-search form-ajax" role="form" id="search">
    	<?php  if(!MERCHANTID) { ?>
        <input type="hidden" name="c" value="site">
        <input type="hidden" name="a" value="entry">
        <input type="hidden" name="m" value="<?php echo IN_MODULE;?>">
        <?php  } ?>
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="<?php  echo $_W['routes'];?>" />
        <input type="hidden" name="status"  value="<?php  echo $status;?>" />
        <input type="hidden" name="aid" value="<?php  echo $aid;?>">
        <input type="hidden" name="merchantid" value="<?php  echo $merchantid;?>">
        <input type="hidden" name="export" id="export" value="0">
        <div class="page-toolbar">
            <div class="input-group">
                <span class="input-group-select">
                    <select name="timetype" class="form-control" style="width:150px;">
                        <option value="">时间类型</option>
                        <option value="1" <?php  if($_GPC['timetype']==1) { ?>selected="selected"<?php  } ?>>报名时间</option>
                        <option value="2" <?php  if($_GPC['timetype']==2) { ?>selected="selected"<?php  } ?>>支付时间</option>
                        <option value="3" <?php  if($_GPC['timetype']==3) { ?>selected="selected"<?php  } ?>>核销时间</option>
                    </select>
                </span>
                <?php  if(!empty($aid)) { ?>
                <span class="input-group-select">
                    <select name="optionid" class='form-control select2' style="width:150px;" data-placeholder="规格名称">
                        <option value=""<?php  if(empty($_GPC['optionid'])) { ?> selected<?php  } ?>>规格名称</option>
                        <?php  if(is_array($specs['2'])) { foreach($specs['2'] as $option) { ?>
                            <option value="<?php  echo $option['id'];?>"<?php  if($_GPC['optionid']==$option['id']) { ?> selected<?php  } ?>><?php  echo $option['title'];?></option>
                        <?php  } } ?>
                    </select>
                </span>
                <?php  } ?>
                <span class="input-group-select">
                    <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
                </span>
                <input type="text" class="input-sm form-control" id="keyword" name='keyword' value="<?php  echo $keyword;?>" placeholder="姓名/昵称/电话/核销码/单号/规格">
                <span class="input-group-btn">
                	<button type="button" data-export="0" class="btn btn-primary btn-submit">搜索</button>
                	<?php  if(perm('order.batch.verify')) { ?><button type="button" data-export="1" class="btn btn-success btn-submit">导出Excel</button><?php  } ?>
                    <?php  if(perm('order.batch.verify')) { ?><button type="button" data-export="2" class="btn btn-warning btn-submit">一键核销</button><?php  } ?>
                </span>
    
            </div>
        </div>
    </form>
    <?php  if(!empty($list)) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="page-table-header" style="padding-left:21px;overflow:hidden">
                <?php  if(perm('order.list.delete') || (perm('order.batch.check') && $status==8) || (perm('messages.main') && $aid>0)) { ?><input type="checkbox"><?php  } ?>
                <div class="btn-group">
                    <?php  if(perm('order.list.delete')) { ?>
                    <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要删除吗，删除后不可恢复?" data-href="<?php  echo web_url('records/delete')?>" disabled><i class="icow icow-shanchu1"></i> 删除</button>
                    <?php  } ?>
                    <?php  if(perm('order.batch.check') && $status==8) { ?>
                    <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确定要通过审核吗?" data-href="<?php  echo web_url('records/review')?>"><i class='icow icow-shenhetongguo'></i> 批量审核通过</button>
                    <?php  } ?>
                    <?php  if(perm('order.op.refund')) { ?>
                    <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确定退款选中的订单吗?" data-href="<?php  echo web_url('records/order_refund')?>"><i class='icow icow-youqiatuikuanxiecha'></i> 批量退款</button>
                    <?php  } ?>
                </div>
                <?php  if(!empty($aid)) { ?>
                <div class="btn-group pull-right">
                	<button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-modal" data-href="<?php  echo web_url('activity/op/msg',array('aid'=>$aid))?>">群发信息</button>
                </div>
                <?php  } ?>
                
            </div>
            <div class="table-responsive">
            	<div class="table-header" style="background:#f8f8f8;height:35px;line-height:35px;padding:0 20px">
                    <div style="border-left:1px solid #f2f2f2;width:30px;"></div>
                    <div style="border-left:1px solid #f2f2f2;width:300px;text-align:left;">基本信息</div>
                    <div class="others">票种</div>
                    <div class="others">金额（元）</div>
                    <div class="others">支付</div>
                    <div class="others">票数</div>
                    <div class="others">核销码</div>
                    <?php  if(checkplugin('seat')) { ?><div class="others">座位</div><?php  } ?>
                    <div class="others">签到</div>
                    <div class="others">状态</div>
                    <div class="others">操作</div>
                </div>
                <?php  if(is_array($list)) { foreach($list as $k => $row) { ?>
                <div class="tables">
                    <div class="table-row table-top" style="padding:0 20px;background:#f7f7f7">
                        <div style="text-align:left;color:#8f8e8e">
                            <span style="font-weight:700;margin-right:10px;color:#2d2d31"><?php  echo $row['jointime'];?> </span>订单号: <?php  echo $row['orderno'];?><?php  if(!empty($row['uniontid'])) { ?>，商户单号: <?php  echo $row['uniontid'];?><?php  } ?>
                        </div>
                        <div style="flex:none;text-align:right;font-size:12px" class="aops">
                            <a class="op" data-toggle="ajaxModal" href="<?php  echo web_url('records/op/remarksaler',array('id'=>$row['id']))?>"><i class="icow icow-<?php echo empty($row['remark'])?'yibiaoji':'flag-o'?>" style="color:#<?php echo empty($row['remark'])?'999':'df5254'?>;display:inline-block;vertical-align:middle" title="<?php echo empty($row['remark'])?'添加':'查看'?>备注"></i> 备注 &nbsp; </a>
                            <a class="op" data-toggle="ajaxModal" href="<?php  echo web_url('records/op/changeprice',array('id'=>$row['id']))?>" style="display:none"><i class="icow icow-gaijia" title="订单改价" style="color:#999;display:inline-block;vertical-align:middle"></i> 订单改价 &nbsp; </a>
                            <?php  if($row['status']!=5 && ($row['status']==0 || $row['status']==2)) { ?>
                            <a class="op" data-toggle="ajaxModal" href="<?php  echo web_url('records/op/cancel',array('id'=>$row['id']))?>"><i class="icow icow-shutDown" title="取消报名" style="color:#999;display:inline-block;vertical-align:middle"></i> 取消报名 &nbsp;</a>
                            <?php  } ?>
                            <?php  if(perm('order.list.delete')) { ?>
                            <?php  if(in_array($row['status'], [0, 2, 5])) { ?>
                            <a class="op" data-toggle="ajaxRemove" href="<?php  echo web_url('records/delete',array('id'=>$row['id']))?>" data-confirm="确认删除此记录？"><i class="icow icow-shanchu" title="删除" style="color:#999;display:inline-block;vertical-align:middle"></i> 删除 &nbsp;</a>
                            <?php  } ?>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="table-row" style="margin:0 20px">
                    	<?php  if(perm('order.list.delete') || (perm('order.batch.check') && $status==8) || (perm('messages.main') && $aid>0)) { ?>
                        <div style="width:30px;display:flex;text-align:left;align-items:center;"><input type="checkbox" value="<?php  echo $row['id'];?>" style="margin:0"></div>
                        <?php  } ?>
                        
                        <div class="goods-des singleRefund" style="width:300px;text-align:left">
                            <div style="display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;margin:10px 0">
                            	<?php  if(!empty($row['goods'])) { ?><img src="<?php  echo tomedia($row['goods']['thumb'])?>" style='width:70px;height:70px;border:1px solid #efefef; padding:1px;'onerror="this.src='<?php echo FX_BASE;?>web/resource_v2/images/nopic.png'"><?php  } ?>
                                <div class="title" style="<?php  if(!empty($row['goods'])) { ?>margin-left: 8px;<?php  } ?>">
                                	<?php  if(!empty($row['goods'])) { ?><?php  echo $row['goods']['title'];?><br><?php  } ?>
                                    姓名：<?php  echo $row['realname'];?><br>
                                    昵称：<?php  echo $row['nickname'];?><br>
                                    手机：<?php  echo $row['mobile'];?><br>
                                    <span style="color:#999"></span>
                                </div> 
                            </div>
                        </div>                        
                        <div class="list-inner columnFlex">
                            <div class="noRefund text-left"><?php  if(!empty($row['optionname'])) { ?><?php  echo $row['optionname'];?><?php  } else { ?>无<?php  } ?></div>
                        </div>
                        <div class="list-inner columnFlex" data-toggle="popover" data-html="true" data-placement="right" data-trigger="hover" data-content="<table style='width:100%;'>
                            <tr>
                                <td style='border:none;text-align:right;'>小计：</td>
                                <td style='border:none;text-align:right;'>￥<?php  echo sprintf('%.2f', $row['aprice']*$row['buynum'])?></td>
                            </tr>
                            <tr>
                                <td style='border:none;text-align:right;'>优惠：</td>
                                <td style='border:none;text-align:right;;'>￥<?php  echo sprintf('%.2f',$row['marketing']['market_price'])?></td>
                            </tr>
                            <tr>
                                <td style='border:none;text-align:right;'>应收款：</td>
                                <td style='border:none;text-align:right;color:green;'>￥<?php  echo sprintf('%.2f',$row['price'])?></td>
                            </tr></table>">
                            <div style="text-align:center">
                                <?php  if($row['aprice'] > 0) { ?>
                                    ￥<?php  echo sprintf("%.2f",$row['price'])?>
                                <?php  } else { ?>
                                    免费
                                <?php  } ?>
                            </div>
                        </div>
                        <div class="list-inner columnFlex paystyle">
                            <?php  if(empty($row['paytype']) && $row['price']>0) { ?>
                            <span class="label label-default">未支付</span>
                            <?php  } else if($row['paytype']=='wechat' || $row['paytype']=='wxapp') { ?>
                            <span class="label label-success">微信支付</span>
                            <?php  } else if($row['paytype']=='delivery') { ?>
                            <span class="label label-warning">线下支付</span>
                            <span class="text-warning"><?php  if($row['status']==1) { ?>已核实<?php  } else { ?>待核实<?php  } ?></span>
                            <?php  } else if($row['paytype']=='credit') { ?>
                            <span class="label label-primary">余额支付</span>                    
                            <?php  } else if($row['paytype']=='admin') { ?>
                            <span class="text-warning">后台付款</span>
                            <?php  } else { ?>
                            <span class="label label-info">免支付</span>
                            <?php  } ?>
                        </div>
                        <div class="list-inner columnFlex">
                            <?php  echo $row['buynum'];?>
                        </div>
                        <div class="list-inner columnFlex">
                            <?php  echo $row['hexiaoma'];?>
                        </div>
                        <?php  if(checkplugin('seat')) { ?>
                        <div class="list-inner columnFlex">
                            <?php  echo $row['seats'];?>
                        </div>  
                        <?php  } ?>
                        <div class="list-inner columnFlex">
                            <div class="noRefund">
                                <?php  echo $row['signin'];?> 次
                            </div>
                        </div>
                        <div class="list-inner columnFlex">
                        <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('records/ops', TEMPLATE_INCLUDEPATH)) : (include fx_template('records/ops', TEMPLATE_INCLUDEPATH));?>
                        </div>
                        <div class="ops list-inner columnFlex">
                            <div class="noRefund">
                                <a class="op text-primary" href="javascript:;" onclick="showDetail(this)">查看详情</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-row table-con">
                        <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('records/form_data', TEMPLATE_INCLUDEPATH)) : (include fx_template('records/form_data', TEMPLATE_INCLUDEPATH));?>
                    </div>
                    <?php  if($row['status']==3 || $row['status']==6 || $row['status']==7) { ?>
                    <div class="table-row table-footer" style="padding:0 20px;background:#f7f7f7">
                    	<div style="color:#8f8e8e">
                        <span class="pull-right text-right">
                        <?php  if($row['status']==6 || $row['status']==7) { ?>
                        	<?php echo $row['status']==6 ? '申请时间' : '退款时间'?>：<?php echo $row['refundtime']>0?date('Y-m-d H:i:s', $row['refundtime']):'暂无'?>
                        <?php  } else { ?>
                        	<?php  if($row['ishexiao']) { ?>核销门店：<?php  echo $row['store']['storename'];?> ， 核销人员：<?php echo empty($row['saler']['nickname'])?'后台核销':$row['saler']['nickname']?> ， 核销时间：<?php  echo $row['sendtime'];?><?php  } ?>
                        <?php  } ?>
                        </span>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
                <?php  } } ?>
                <div class="table-row"><div style="height:20px;padding:0;border-top:none;">&nbsp;</div></div>
                <div class="table-footer" style="padding:20px;">
                    <div style="margin-left:1px;flex:unset;">
                        <?php  if(perm('order.list.delete') || (perm('order.batch.check') && $status==8) || (perm('messages.main') && $aid>0)) { ?><input type="checkbox"><?php  } ?>
                        <div class="btn-group">
                            <?php  if(perm('order.list.delete')) { ?><button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要删除吗，删除后不可恢复?" data-href="<?php  echo web_url('records/delete')?>" disabled><i class="icow icow-shanchu1"></i> 删除</button><?php  } ?>    
                            <?php  if(perm('order.batch.check') && $status==8) { ?><button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch-remove' data-confirm="确定要通过审核吗?" data-href="<?php  echo web_url('records/review')?>"><i class='icow icow-shenhetongguo'></i> 批量审核通过</button><?php  } ?>
                            <?php  if(perm('order.op.refund') && $status==6) { ?><button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确定退款选中的订单吗?" data-href="<?php  echo web_url('records/order_refund')?>"><i class='icow icow-youqiatuikuanxiecha'></i> 批量退款</button><?php  } ?>          
                        </div>
                    </div>
                    <div style="text-align:right">
                    	<?php  echo $pager;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php  } else { ?>
    <div class="panel panel-default">
        <div class="panel-body empty-data">暂时没有任何订单!</div>
    </div>
    <?php  } ?>
</div>
<script>
//批处理
$(function () {
	var output = false;
	$('#search').bind('submit', function(){
		output && tip.msgbox.suc("执行完成，下载中");
		output = false;
	});
	$('.btn-submit').click(function () {
		var e = $(this).data('export');
		if(e==1){
			$('#export').val(e);
			biz.ProgressBar(this, function(r){				
				var input = $("<input name='page'>").attr("type", "hidden").val(r.tpage+1);
				output = true;
				$('#search').append($(input)).submit();
				$(input).remove();
			}, ["<?php  echo web_url('records/output')?>"], '数据导出中请稍后');
		}else if(e==2){
			var that = this;
			tip.confirm('确定核销当前待参与所有记录吗？', function(){
				$('#export').val(e);
				biz.ProgressBar(that, function(r){
					location.reload();
				}, ["<?php  echo web_url('records/hexiao')?>"]);
			});
		}else{
			$('#export').val(0);
			$('#search').submit();
		}
	})
});
function showDetail(obj){
	$(obj).parents('.table-row').next().toggleClass('active');
	if ($(obj).hasClass('open')) 
		$(obj).text('查看详情').removeClass('open');
	else
		$(obj).text('关闭详情').addClass('open');
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>