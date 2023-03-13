<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-card{border-radius:0.2rem!important;margin:0.55rem!important;}
.mui-card.border:before{border-radius:0.36rem;border:0.04rem solid rgba(0,0,0,.18)}
.mui-card-header{background:none; font-size:0.55rem}
.mui-card-header.border:before{border:none;border-bottom:0.04rem solid rgba(0,0,0,.18)}
.mui-card .mui-card-content-inner{padding:0.35rem;}
</style>
<div class="mui-content">
<?php  if($ishexiao_member) { ?>
	<?php  if($result=='success') { ?>
	<div class="mui-content-padded">
        <div class="mui-message">
            <div class="mui-message-icon">
            <span class="mui-msg-success"></span>
            </div>
            <h4 class="title">核销成功</h4>
            <p class="mui-desc">点击确定，可返回微信</p>
            <div class="mui-button-area">
                <a href="javascript:wx.closeWindow();" class="mui-btn mui-btn-success mui-btn-block">确定</a>
            </div>
        </div>
    </div>
    <?php  } else { ?>
    <div class="mui-card border">
        <div class="mui-card-header border">电子票<span class="mui-pull-right mui-text-gray">NO.<?php  echo $NO;?></span></div>
        <div class="mui-card-content">
            <div class="mui-card-content-inner">                
                <?php  if($records['ishexiao']==1) { ?>
                	<div class="voucher-code">
                    	<p style="margin:10% 0;"><font class="mui-text-success">已完成核销</font></p>
                    </div>
                <?php  } else { ?>
                	<?php  if($records['paytype']=='delivery' && $records['status']=='0') { ?>
                        <div class="voucher-code">
                            <p style="margin:10% 0;"><font class="mui-text-error">线下付款需确认</font></p>
                        </div>
                    <?php  } ?>
                <?php  } ?>
                <div class="voucher-address font-size-14">
                	<p>参与用户：<?php  echo $records['realname'];?></p>
                    <p>用户手机：<?php  echo $records['mobile'];?></p>
                    <p>活动时间：<?php  echo $activity['starttime'];?></p>
                </div>
                <div class="voucher-goods-info" style="border-bottom: 1px dashed #e5e5e5;">
                	<p class="mui-text-gray">选择核销场地</p>
                	<table style="width: 13rem;">
                    <?php  if($activity['hasonline']) { ?>
                    	<tr>
                            <td><input type="radio" name="radio" id="radio" value="" checked="checked"/></td>
                            <td>线上活动（无须现场参与）</td>
                        </tr>
                	<?php  } else if(!empty($stores)) { ?>
                    <?php  if(is_array($stores)) { foreach($stores as $store) { ?>
                        <tr>
                            <td><input type="radio" name="radio" id="radio<?php  echo $store['id'];?>" value="<?php  echo $store['id'];?>" <?php  if($store['id']==$stores[0]['id']) { ?>checked="checked"<?php  } ?>/></td>
                            <td>
                                <label for="radio<?php  echo $store['id'];?>">
                                <div class="store mui-small" style="padding:5px">
                                    <div class="info">
                                    <div class="ico"></div>
                                    <div class="info1">
                                        <div class="inner">
                                             <div class="user"><?php  echo $store['storename'];?></div>
                                             <div class="addresss">地址: <?php  echo $store['address'];?></div>
                                             <div class="tel">电话: <?php  echo $store['tel'];?></div>
                                         </div>
                                     </div>
                                    </div>
                                </div>
                                </label>
                            </td>
                        </tr>
                    <?php  } } ?>
                    <?php  } else { ?>
                        <tr>
                            <td><input type="radio" name="radio" id="radio0" value="0" checked="checked"/></td>
                            <td>
                                <label for="radio<?php  echo $store['id'];?>">
                                <div class="store mui-small" style="padding:5px">
                                    <div class="info">
                                    <div class="ico"></div>
                                    <div class="info1">
                                        <div class="inner">
                                             <div class="user"><?php  echo $_W['merchant']['storename'];?></div>
                                             <div class="addresss">地址: <?php  echo $_W['merchant']['address'];?></div>
                                             <div class="tel">电话: <?php  echo $_W['merchant']['tel'];?></div>
                                         </div>
                                     </div>
                                    </div>
                                </div>
                                </label>
                            </td>
                        </tr>
                    <?php  } ?>
                    </table>
                </div>
                <div class="voucher-goods-info font-size-14">
                    <p>活动名称：<?php  echo $activity['title'];?> </p>
                    <p>参加名额：<?php  echo $records['buynum'];?> 人</p>
                    <?php  if($activity['switch']['seat']) { ?><p>座&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位：<?php  echo $records['seats'];?></p><?php  } ?>
                    <?php  if(!empty($records['optionname'])) { ?><p><?php  echo $_W['_config']['buytitle'];?>规格：<?php  echo $records['optionname'];?></p><?php  } ?>
                    <?php  if($records['aprice']>0) { ?>
                        <?php  if($records['payprice']) { ?>
                        <p>实付金额：<font class="mui-text-success mui-rmb"><?php  echo $records['payprice'];?> 元</font></p>
                        <?php  } else if($records['price']) { ?>
                        <p>应付金额：<font class="mui-text-error mui-rmb"><?php  echo $records['price'];?> 元</font></p>
                        <?php  } ?>
                    <?php  } ?>
                    <p>用户昵称：<?php  echo $records['nickname'];?></p>
                    <p><?php  echo $_W['_config']['buytitle'];?>时间：<?php  echo $records['jointime'];?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mui-content-padded mui-button-area">
    	<?php  if($records['ishexiao']!=1) { ?>
    	<a href="javascript:;" id="conbdel" class="mui-btn mui-btn-yellow mui-btn-block">核销<?php  echo $_W['_config']['buytitle'];?></a>
        <?php  } ?>
		<a href="javascript:<?php echo $_GPC['from']=='qrcode' || $_GPC['from']=='wxapp' ? 'wx.closeWindow()' : 'history.go(-1)'?>;"  class="mui-btn mui-btn-default mui-btn-block">返回</a>
	</div>
    <?php  } ?>
<?php  } else { ?>
	<div class="mui-content-padded">
        <div class="mui-message">
            <div class="mui-message-icon">
            <span class="mui-msg-error"></span>
            </div>
            <h4 class="title">非核销人员</h4>
            <p class="mui-desc">点击确定，可返回微信</p>
            <div class="mui-button-area">
                <a href="javascript:wx.closeWindow();" id="closewindow" class="mui-btn mui-btn-success mui-btn-block">确定</a>
            </div>
        </div>
    </div>
<?php  } ?>
</div>
<script>
	$(document).on('click','#conbdel',function(){
		util.confirm('是否确认核销？', ' ', function(e) {
			if (e.index == 1) {
				var value = e.value;
	        	var storeid = $('input:radio:checked').val();
	        	var slen = $(':radio:checked');
	        	if(slen.length<1){
	        		//$.confirm('未选择核销场地');return false;
	        	}
				<?php  if($activity['atype']==2) { ?>
				var r = /^\+?[1-9][0-9]*$/;
				if(!r.test(value)){
	        		util.tips('必须是有效的整数！',2000);return false;
	        	}
				<?php  } ?>
	          	$.post("<?php  echo app_url('records/check/post',array('orderid' => $orderid))?>",{storeid:storeid,usernum:value},function(d){
					console.log(d);
					if(!d.errno){
						location.href = "<?php  echo app_url('records/check',array('orderid' => $orderid,'result' => 'success'))?>";
					}else{
						util.toast(d.message,'', 'error');
					}
				},"json");
	        }
		});
	});

	$('#closewindow').click(function(){
		wx.closeWindow();
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>