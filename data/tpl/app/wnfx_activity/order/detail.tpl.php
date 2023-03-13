<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.mui-card.mui-one {box-shadow:none;}
.mui-card-footer.contact a{width:50%;text-align:center; position:relative;color:#828282!important}
.mui-card-footer.contact a:after{content: ""; position:absolute;right:0;left:auto;top:50%;width:1px;background:#E0E0E0;height:100%;-webkit-transform: translateY(-50%) scaleX(0.5); transform: translateY(-50%) scaleX(0.5);}
.mui-card-footer.contact a:last-child:after{width:0px;}
.mui-card.mui-one .mui-card-header img:first-child {width:0.75rem!important;height:0.75rem!important}
.mui-card.mui-one .mui-card-header.mui-card-media{padding:0.45rem}
.mui-card.mui-one .mui-card-header.mui-card-media .mui-media-body {font-weight:normal;margin-left:0.85rem;height:auto;min-height:auto;overflow: hidden}
.mui-card.mui-one .mui-card-header.mui-card-media .mui-media-body p{font-size:0.45rem}
.mui-card.mui-one .mui-card-content-inner{padding:0.38rem}
.mui-card.mui-one .mui-card-content-inner p{font-size:0.55rem;margin:0;line-height:1.8;margin-bottom:0}
.mui-card-footer .mui-btn-yellow{color:#72400b;}
.list li{border-radius:0.1rem!important;margin-bottom:0.35rem!important;border-left: 0.1rem solid #fcd64f}
.list li:last-child{margin:0!important}
.list .r{position:absolute;z-index:999;width:0.52rem;height:100%;top:0;right:1.25rem;overflow:hidden}
.list .r span{position:absolute;width:0.52rem;height:0.52rem;left:0;background:#FFF;border:0.03rem solid rgba(0,0,0,.085)}
.list .r span.t{border-radius:0 0 50% 50%;border-top:none;top:-0.26rem;}
.list .r span.b{border-radius:50% 50% 0 0;border-bottom:none;bottom:-0.25rem;}
.list .mui-media.border:before{border-radius:0 0.2rem 0.2rem 0;border-left:none;}
.list .mui-media .mui-btn.no{border:1px solid rgba(0,0,0,.1);color:#454545}
.list .mui-media-body{min-height:3.2rem}
.list .mui-media-body p{font-size:0.5rem;line-height:1.8}
.list .mui-media-body .mui-btn{padding:0.13rem 0.35rem; font-size:0.45rem}
.list .mui-media-body~.mui-navigate-right{width:1.5rem;top:50%;font-size:0.55rem;display:flex;align-items: center;padding:0.2rem 0.5rem;padding-bottom:0.65rem;white-space:normal;border:none;line-height:1!important;right:0; background:none;}
.list .mui-media-body~.mui-navigate-right:after{top:auto;left:53%;bottom:0;transform:translate(-50%); right:auto;font-family:Muiext;content: "\e647"; color:#fcd64f}
.list .mui-media-body~.mui-navigate-right.border:before{border:none;border-left:0.04rem dashed rgba(0,0,0,.1);transform: scale(.7);width:0.04rem;height:142%!important;}
.mui-bar-footer{padding:0; background:#fff;height:45px;line-height:50px;}
.mui-bar-footer .mui-btn{width:40%;height:100%;top:0px;font-size:0.65rem;border-radius:0;float:right;display:grid;align-items: center;}
</style>
<script type="text/javascript" charset="utf-8">
    wx.ready(function(){  //微信读取
        var srcList = [];
        $.each($('.imgprev img'),function(i,item){  //$('.info_detail .container img') 容器中的图片
            if(item.src) {
                srcList.push(item.src);
                $(item).click(function(e){
                    // 通过这个API就能直接调起微信客户端的图片播放组件了
                    wx.previewImage({
                        current: this.src,
                        urls: srcList
                    });
                });
            }
        });
    });
</script>
<?php  if($type=='u') { ?>
<?php  if($item['status']==0 && $item['paytype']!='delivery' && strtotime($activity['endtime']) > TIMESTAMP) { ?>
<footer class="mui-bar mui-bar-footer basic"<?php  if($aprice>0) { ?> style="padding:0;"<?php  } ?>>
    <p class="mui-pl10" id="option_aprice" style="width:60%;display:inline-block;">
    	合计：<span class="mui-rmb mui-big mui-text-rmb"><?php  if(is_numeric($item['aprice'])) { ?><?php  echo sprintf("%.2f", $item['aprice']*$item['buynum'])?><?php  } else { ?>0<?php  } ?></span>
    </p>
    <a class="mui-btn mui-btn-yellow" href="<?php  echo app_url('pay/paytype',array('id'=>$id))?>">去支付</a>
</footer>
<?php  } ?>
<div class="mui-content">
	<ul class="mui-table-view mui-afterbefore-no" style="margin-top:0;">
        <li class="mui-table-view-cell mui-media js-popover" data-popover="member_form">
            <a class="mui-navigate-right js-setting">
                <p style="color:#6e6e6e"><?php  echo $_W['_config']['buytitle'];?>信息</p>
                <span class="mui-badge mui-badge-inverted">查看详情<?php  if($item['review']==3) { ?>（已驳回）<?php  } ?></span>
            </a>
        </li>
    </ul>
    <div class="mui-card mui-one mui-card-line">
        <div class="mui-card-header mui-card-media mui-after-no">
            <img src="<?php  echo $merchant['logo'];?>">
            <div class="mui-media-body">
            	<p style="line-height:1.6!important;"><?php  echo $merchant['name'];?></p>
            </div>
        </div>
        <div class="mui-card-content">        	
            <div class="mui-card-content-inner" style="background:#f8f8f8">
            	<a href="<?php  echo app_url('activity/detail',array('id'=>$activity['id']))?>">
                    <img src="<?php  echo tomedia($activity['thumb'])?>" class="mui-pull-left" style="height:2.8rem;margin-right:0.5rem">
                    <p style="margin-bottom:0.3rem;line-height:1.2"><?php  echo $activity['title'];?></p>
                    <p class="mui-text-gray" style="font-size:0.42rem;line-height:1.5">时间：<?php  echo date('y年m月d日 H:i',strtotime($activity['starttime']))?> 开始<br>规格：<?php  if(empty($item['optionname'])) { ?>暂无<?php  } else { ?><?php  echo $item['optionname'];?><?php  } ?></p>
                </a>
            </div>
            <?php  if($item['status']!=0 || $item['paytype']=='delivery') { ?>
            <ul class="mui-table-view mui-afterbefore-no list" style="margin:0.38rem;border-radius:0;">
            	<?php  if(is_array($list)) { foreach($list as $i => $row) { ?>
                <li class="mui-table-view-cell mui-after-no mui-media border">
                	<div class="mui-media-body" style="border-radius:0.1rem;">
                        <p style="position:relative;line-height:1.5;<?php  if(count($list)>1) { ?>padding-left:0.6rem<?php  } ?>">
                        	<?php  if(count($list)>1) { ?><span style="position:absolute;color:#9e9e9e;left:0"><?php  echo $i+1?></span><?php  } ?>
                            票价:<span class="mui-rmb"><?php  if(is_numeric($row['price'])) { ?><?php  echo sprintf("%.2f", $row['price'])?><?php  } else { ?>0<?php  } ?></span><br>
                            <?php  echo $row['realname'];?> <?php  echo $row['mobile'];?><br>
                            <?php  if(!empty($row['remark'])) { ?><span class="mui-text-error">备注：<?php  echo $row['remark'];?></span><?php  } ?>
                            <span class="showMsg<?php  echo $i;?>" style="position:absolute;color:#9e9e9e;top:0;right:2.2rem">
                            	<?php  if($row['review']==1) { ?>
                                	<?php  if(in_array($row['status'],array(1,2))) { ?>
                                    	<?php  if(TIMESTAMP > strtotime($activity['endtime'])) { ?>
                                        	<font class="mui-text-error">已过期</font>
                                        <?php  } else { ?>
                                        	待参与
                                        <?php  } ?>
                                    <?php  } else if($row['status']==3) { ?>已完成
                                    <?php  } else if($row['status']==5) { ?>已取消
                                    <?php  } else if($row['status']==6) { ?>待退款
                                    <?php  } else if($row['status']==7) { ?><font class="mui-text-error">已退款</font><?php  } ?>
                                <?php  } else if($row['review']==2) { ?>已拒审<?php  } else { ?>审核中<?php  } ?>
                            </span>
                        </p>
                        <p style="padding-right:2.2rem;text-align:right;margin-top:0.55rem">                        	
                            <?php  if(in_array($row['status'], array('0','2')) && $activity['switch']['joincancel']) { ?>
                            <a class="mui-btn no ajaxPost" data-toggle="ajaxPost" href="<?php  echo app_url('order/cancel',array('id'=>$row['id']))?>" data-key="<?php  echo $i;?>" data-confirm="确认取消当前订单么？" data-set='{"aid":<?php  echo $item['activityid'];?>}'>取消报名</a>
                            <?php  } ?>
                            <?php  if($activity['switch']['refund'] && !in_array($row['status'], array(0,2,3,6,7)) && in_array($row['paytype'], array('credit','wechat','alipay'))) { ?>
                            <a class="mui-btn mui-btn-yellow" data-toggle="ajaxPost" href="<?php  echo app_url('order/refund',array('id'=>$row['id']))?>" data-key="<?php  echo $i;?>" data-confirm="确认申请退款么？" data-type='refund'>申请退款</a>
                            <?php  } ?>
                        </p>
                        
                    </div>                   
                    <div class="mui-btn mui-navigate-right border"><a href="<?php  echo app_url('records/qrcode',array('id'=>$row['id']))?>" style="color:#7e7e7e;">查看电子票</a></div>
                    <div class="r">
                        <span class="t"></span>
                        <span class="b"></span>
                    </div>
                </li>                
                <?php  } } ?>
            </ul>
            <?php  } ?>
        </div>        
    </div>    
    <?php  if($item['aprice']>0) { ?>
    <div class="mui-card mui-one">
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
            	<p>总票价<span class="mui-rmb mui-text-gray mui-pull-right"><?php  if(is_numeric($item['aprice'])) { ?><?php  echo sprintf("%.2f", $item['aprice']*$item['buynum'])?><?php  } else { ?>0<?php  } ?></span></p>
                <?php  if($item['marketing']['market_price']) { ?><p>优惠金额<span class="mui-rmb mui-pull-right"><?php  echo $item['marketing']['market_price'];?></span></p><?php  } ?>
                <p>订单实付金额<span class="mui-rmb mui-text-orange mui-pull-right"><?php  if($item['payprice']) { ?><?php  echo $item['payprice'];?><?php  } else { ?>0<?php  } ?></span></p>
            </div>
        </div>
    </div>
    <?php  } ?>
    <?php  if($item['status']==3) { ?>
    <div class="mui-card mui-one">
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
            	<p>核销门店：<span class="mui-text-gray"><?php  echo $item['store']['storename'];?> </span></p>
            	<p>核销人员：<span class="mui-text-gray"><?php echo empty($item['saler']['nickname'])?'后台核销':$item['saler']['nickname']?></span></p>
                <p>核销时间：<span class="mui-text-gray"><?php  echo $item['sendtime'];?></span></p>
            </div>
        </div>
    </div>
    <?php  } ?>
    <div class="mui-card mui-one">
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
            	<?php  if($item['aprice']>0 && $item['status']!=0) { ?><p>支付方式：<span class="mui-text-gray"><?php echo $item['paytype']=='delivery'?'线下付款':($item['paytype']=='wechat'?'微信支付':'后台付款')?></span></p><?php  } ?>
                <p>订单编号：<span class="mui-text-gray"><?php  echo $item['orderno'];?></span></p>
                <?php  if($item['status']!=0) { ?><p>交易编号：<span class="mui-text-gray"><?php  if(empty($item['transid'])) { ?>暂无<?php  } else { ?><?php  echo $item['transid'];?><?php  } ?></span></p><?php  } ?>
                <p>创建时间：<span class="mui-text-gray"><?php  echo date('Y-m-d H:i', strtotime($item['jointime']))?></span></p>
            </div>
        </div>
    </div>
    <script type="text/javascript" charset="utf-8">
		$(document).on("tap", '[data-toggle="ajaxPost"]', function(e) {
			e.preventDefault();
			var obj = $(this),
				confirm = obj.data("confirm"),
				url = obj.data("href") || obj.attr("href"),
				data = obj.data("set") || {},
				key = obj.data("key") || '',
				html = obj.html();
			"1" != obj.html('<i class="fa fa-spinner fa-spin"></i>').attr("submitting") && (obj.attr("submitting",1), util.confirm(confirm,' ',function(e) {
				if (e.index == 1) {
					$.post(url, data, function(rs){
						util.tips('操作完成！');
						$('.showMsg'+key).text(rs.result.text);
						obj.data("type")=='refund' && obj.parent().remove();
						obj.remove();
					}, "json").fail(function(rs) {
						console.log(rs);
						util.tips('操作失败！');
					})
				}else obj.removeAttr("submitting").html(html);
			}));
		});
	</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('member/setting', TEMPLATE_INCLUDEPATH)) : (include fx_template('member/setting', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<div class="mui-content">
    <div class="mui-card mui-one">
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
                <p>所选票种：<span class="mui-text-gray"><?php  if(!empty($item['optionname'])) { ?><?php  echo $item['optionname'];?><?php  } else { ?>暂无<?php  } ?></span></p>
                <p>购票数量：<span class="mui-text-gray"><?php  echo $item['buynum'];?> 张</span></p>
                <p>票价总额：<span class="mui-text-gray mui-rmb"><?php  if($item['aprice']) { ?><?php  echo $item['aprice'] * $item['buynum']?><?php  } else { ?>0.00<?php  } ?></span></p>
                <p>实付金额：<span class="mui-text-yellow mui-rmb"><?php  if($item['payprice']) { ?><?php  echo $item['payprice'];?><?php  } else { ?>0.00<?php  } ?></span></p>
                <p><?php  echo $_W['_config']['buytitle'];?>状态：<span class="mui-text-gray"><?php  if($item['status']==0) { ?><font class="mui-text-rmb">待支付<?php  if($item['paytype']=='delivery') { ?>（线下支付）<?php  } ?></font>
                <?php  } else if($item['status']==1 || $item['status']==2) { ?>待参与
                <?php  } else if($item['status']==3) { ?>已参与
                <?php  } else if($item['status']==5) { ?>已取消
                <?php  } else if($item['status']==6) { ?><font class="mui-text-yellow">待退款</font>
                <?php  } else if($item['status']==7) { ?><font class="mui-text-error">已退款</font><?php  } ?>
                </span></p>
            </div>
        </div>
    </div>
    
    <div class="mui-card mui-one mui-card-line imgprev">
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
            	<p>姓名：<span class="mui-text-gray"><?php  echo $item['realname'];?></span></p>
                <p>手机：<span class="mui-text-gray"><?php  echo $item['mobile'];?></span></p>
            	<?php  if(is_array($forms['0'])) { foreach($forms['0'] as $form) { ?>
                <?php  if($form['fieldstype']!='') { ?>
                	<p><?php  echo $form['title'];?>：<span class="mui-text-gray">
                	<?php  if($form['fieldstype']=='gender') { ?>
                    	<?php echo $formdata_common['gender']==0 ? '保密' :( $formdata_common['gender']==1?'男':'女')?>
                    <?php  } else if($form['fieldstype']=='age') { ?>
                        <?php  echo $formdata_common['age'];?> 岁
                    <?php  } else if($form['fieldstype']=='birthyear') { ?>
                         <?php  echo $formdata_common['birthyear'].'年'.$formdata_common['birthmonth'].'月'.$formdata_common['birthday'].'日'?>
                    <?php  } else if($form['fieldstype']=='resideprovince') { ?>
                        <?php  echo $formdata_common['resideprovince'];?><?php  echo $formdata_common['residecity'];?><?php  echo $formdata_common['residedist'];?>
                    <?php  } else { ?>
                        <?php  echo $formdata_common[$form['fieldstype']];?>
                    <?php  } ?>
                    </span></p>
                <?php  } else { ?>
                    <?php  $formdata = model_records::getSingleFormData($id, $form['id']);?>
                    <p><?php  echo $form['title'];?>：
                    <?php  if($form['displaytype']==5 && $formdata['data']!='') { ?>
                        <img src="<?php  echo tomedia($formdata['data']);?>" height="100" style="display:-webkit-box">
                    <?php  } else if($form['displaytype']==6 && $formdata['data']!='') { ?>
                    	<br>
                        <?php  $pics = explode(',', $formdata['data']);?>
                        <?php  if(is_array($pics)) { foreach($pics as $v) { ?>
                        <img src="<?php  echo tomedia($v);?>" height="30%" width="100" style="margin:0 5px 5px 0;display:inline-block">
                        <?php  } } ?>
                    <?php  } else if($form['displaytype']==7) { ?>
                    	<span class="mui-text-gray"><?php  echo str_replace(',', '-', $formdata['data'])?></span>
                    <?php  } else if($form['displaytype']==12) { ?>
                    	<?php  if(!empty($formdata['data'])) { ?><a class="mui-text-primary" href="<?php  echo tomedia($formdata['data'])?>" target="_blank">播放</a><?php  } ?>
                    <?php  } else { ?>
                    	<span class="mui-text-gray"><?php  echo str_replace(',', ' ', $formdata['data'])?></span>
                    <?php  } ?></p>
                <?php  } ?>
                <?php  } } ?>
                
            </div>
        </div>
        <div class="mui-card-footer contact">
        	<a href="tel:<?php  echo $item['mobile'];?>">打电话</a>
        	<a href="sms:<?php  echo $item['mobile'];?>">发短信</a>
        </div>
    </div>
    
    <div class="mui-card mui-one">
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
            	<p>订单编号：<span class="mui-text-gray"><?php  echo $item['orderno'];?></span></p>
                <p>交易编号：<span class="mui-text-gray "><?php  if(empty($item['transid'])) { ?>暂无<?php  } else { ?><?php  echo $item['transid'];?><?php  } ?></span></p>
                <p>创建时间：<span class="mui-text-gray"><?php  echo date('Y-m-d H:i', strtotime($item['jointime']))?></span></p>
            </div>
        </div>
    </div>    
    <?php  if($item['status']==1 || $item['status']==2) { ?>
    <div class="mui-content-padded">
        <a href="<?php  echo app_url('records/check', array('orderid'=>$item['id']))?>" class="mui-btn mui-btn-block mui-btn-yellow">确认验票</a>
    </div>
    <?php  } ?>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>