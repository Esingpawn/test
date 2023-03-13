<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="mui-content pay-method">
	<h5 class="mui-desc-title mui-pl10">支付详情</h5>
	<ul class="mui-table-view">
		<li class="mui-table-view-cell">
			订单名称<span class="mui-pull-right mui-text-muted"><?php  echo $params['title'];?></span>
		</li>
		<li class="mui-table-view-cell">
			支付编号<span class="mui-pull-right mui-text-muted"><?php  echo $params['ordersn'];?></span>
		</li>
		<li class="mui-table-view-cell">
			商家名称<span class="mui-pull-right mui-text-muted"><?php  echo $params['account_name'];?></span>
		</li>
		<?php  if(!empty($mine)) { ?>
		<li class="mui-table-view-cell">
			优惠信息<span class="mui-pull-right mui-text-muted"><?php  echo $mine['name'];?></span>
		</li>
		<?php  } ?>
        <?php  if($_GPC['r']!='recharge.pay') { ?>
        <li class="mui-table-view-cell">下单数量<span class="mui-pull-right mui-text-muted"><?php  echo $_SESSION['pay']['buynum'];?></span></li>
        <?php  } ?>
		<li class="mui-table-view-cell">
			订单金额<span class="mui-pull-right mui-text-success mui-big mui-rmb"><?php  echo sprintf('%.2f', $params['fee']);?> 元</span>
		</li>
	</ul>
	<?php  if(!empty($token) || !empty($coupon)) { ?>
	<h5 class="mui-desc-title mui-pl10">可用卡券</h5>
	<ul class="mui-table-view ">
		<?php  if(!empty($token)) { ?>
		<li class="mui-table-view-cell mui-table-view-chevron">
			<a href="#pay-select-token-modal" class="mui-navigate-right js-token">
				代金券
				<?php  if(!empty($token)) { ?>
				<span class="used-num"><?php  echo count($token);?>张可用</span>
				<?php  } ?>
				<span class="mui-pull-right mui-mr10">
					<span class="mui-mr10 js-card-info"><?php  if(!empty($token)) { ?>未使用<?php  } else { ?>无可用<?php  } ?></span>
				</span>
			</a>
		</li>
		<?php  } ?>
		<?php  if(!empty($coupon)) { ?>
		<li class="mui-table-view-cell mui-table-view-chevron">
			<a href="#pay-select-coupon-modal" class="mui-navigate-right js-coupon">
				折扣券
				<?php  if(!empty($coupon)) { ?>
				<span class="used-num"><?php  echo count($coupon);?>张可用</span>
				<?php  } ?>
				<span class="mui-pull-right mui-mr10">
					<span class="mui-mr10 js-card-info"><?php  if(!empty($coupon)) { ?>未使用<?php  } else { ?>无可用<?php  } ?></span>
				</span>
			</a>
		</li>
		<?php  } ?>
	</ul>
	<?php  } ?>
    <ul class="mui-table-view">
		<li class="mui-table-view-cell mui-table-view-chevron">
			还需支付<span class="mui-pull-right mui-text-success mui-big mui-rmb js-need-pay" data-price="<?php  echo sprintf('%.2f', $params['fee']);?>"><?php  echo sprintf('%.2f', $params['fee']);?> 元</span>
		</li>
	</ul>
	<h5 class="mui-desc-title mui-pl10">选择支付方式</h5>
	<ul class="mui-table-view mui-table-view-chevron pay-style hide">
		<?php  if(!empty($pay['unionpay']['switch'])) { ?>
		<li class="mui-table-view-cell">
			<a class="mui-navigate-right mui-media js-pay" href="javascript:;">
				<form action="<?php  echo url('mc/cash/unionpay');?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/yl-icon.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					银联支付
					<span class="mui-block mui-text-muted mui-mt5">银联安全支付服务</span>
				</span>
			</a>
		</li>
		<?php  } ?>
        
        <?php  if(!empty($_W['_config']['creditpay'])) { ?>
        <li class="mui-table-view-cell credit">
			<a class="mui-navigate-right mui-media credit-js-pay" href="javascript:;">
				<form action="<?php  echo url('mc/cash/credit');?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/money.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					余额
					<span class="mui-block mui-text-muted mui-rmb mui-mt5"> <?php  echo sprintf('%.2f', $credtis['credit2']);?></span>
				</span>
			</a>
		</li>
        <?php  } ?>
        
        <?php  if($_W['_config']['wechatstatus']==2) { ?>
		<li class="mui-table-view-cell mui-disabled js-wechat-pay">
			<a class="mui-navigate-right mui-media js-pay" id="wechat" href="javascript:;">
				<form action="<?php  echo app_url('pay/cash/wechat')?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/wx-icon.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					<span id="wetitle">微信支付(必须使用微信内置浏览器)</span>
					<span class="mui-block mui-text-muted mui-mt5">微信支付,安全快捷</span>
				</span>
                <span class="mui-badge mui-badge-success">确认支付</span>
			</a>
		</li>
        <?php  } ?>
        
        <?php  if($_W['_config']['deliverystatus']==2) { ?>
		<li class="mui-table-view-cell">
			<a class="mui-navigate-right mui-media js-pay" id="delivery" href="javascript:;">
            	<form action="<?php  echo app_url('pay/success/delivery',array('id'=>$orderid))?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
				</form>
                <img src="<?php echo FX_URL;?>app/resource/images/huo.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					线下付款
					<span class="mui-block mui-text-muted mui-mt5">支持线下付款</span>
				</span>
			</a>
		</li>
        <?php  } ?>
	</ul>
    <div class="mui-content-padded mui-padded-top-15 mui-text-center" style="display:none">
    	<button type="button" class="mui-btn mui-btn-cancel mui-btn-block js-cancel">取消支付</button>
    </div>
</div>

<?php  if(!empty($cards)) { ?>
<div id="pay-select-coupon-modal" class="mui-modal">
	<header class="mui-bar mui-bar-nav">
		<a class="mui-icon mui-icon-close mui-pull-right" href="#pay-select-coupon-modal"></a>
		<h1 class="mui-title">请选择卡券</h1>
	</header>
	<nav class="mui-bar mui-bar-footer">
		<div class="js-coupon-submit">
			<input type="hidden" name="couponid" value="">
			<button class="mui-btn mui-btn-success mui-btn-block js-submit">确定</button>
		</div>
	</nav>
	<div class="mui-content">
		<div class="pay-select-coupon">
			<div class="js-coupon-show">
				<?php  if(is_array($coupon)) { foreach($coupon as $li) { ?>
				<div class="mui-input-row mui-radio">
					<label>
						<div class="coupon-panel">
							<div class="mui-row">
								<div class="mui-col-xs-4 mui-text-center">
									<div class="coupon-panel-left">
										<?php  echo $li['icon'];?>
									</div>
								</div>
								<div class="mui-col-xs-8">
									<div class="store-title mui-ellipsis"><?php  echo $li['title'];?></div>
									<div class="date"><?php  echo $li['extra_date_info'];?></div>
								</div>
							</div>
						</div>
						<input type="radio" name="coupon" value="<?php  echo $li['id'];?>" />
					</label>
					<ol class="coupon-rules" style="display:none;">
						<?php  if(empty($li['description'])) { ?>
						暂无说明
						<?php  } else { ?>
						<?php  echo htmlspecialchars_decode($li['description'])?>
						<?php  } ?>
					</ol>
					<div class="scan-rules js-scan-rules">折扣券使用规则<span class="fa fa-angle-up"></span></div>
				</div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</div>

<div id="pay-select-token-modal" class="mui-modal">
	<header class="mui-bar mui-bar-nav">
		<a class="mui-icon mui-icon-close mui-pull-right" href="#pay-select-token-modal"></a>
		<h1 class="mui-title">请选择卡券</h1>
	</header>
	<nav class="mui-bar mui-bar-footer">
		<div class="js-coupon-submit">
			<input type="hidden" name="couponid" value="">
			<button class="mui-btn mui-btn-success mui-btn-block js-submit">确定</button>
		</div>
	</nav>
	<div class="mui-content">
		<div class="pay-select-coupon">
			<div class="js-token-show">
				<?php  if(is_array($token)) { foreach($token as $li) { ?>
				<div class="mui-input-row mui-radio">
					<label>
						<div class="coupon-panel">
							<div class="mui-row">
								<div class="mui-col-xs-4 mui-text-center">
									<div class="coupon-panel-left">
										<?php  echo $li['icon'];?>
									</div>
								</div>
								<div class="mui-col-xs-8">
									<div class="store-title mui-ellipsis"><?php  echo $li['title'];?></div>
									<div class="date"><?php  echo $li['extra_date_info'];?></div>
								</div>
							</div>
						</div>
						<input type="radio" name="coupon" value="<?php  echo $li['id'];?>" />
					</label>
					<ol class="coupon-rules" style="display:none;">
						<?php  if(empty($li['description'])) { ?>
						暂无说明
						<?php  } else { ?>
						<?php  echo htmlspecialchars_decode($li['description'])?>
						<?php  } ?>
					</ol>
					<div class="scan-rules js-scan-rules">代金券使用规则<span class="fa fa-angle-up"></span></div>
				</div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on('click', '.js-scan-rules', function() {
		$(this).prev().toggle();
		$(this).find('span').toggleClass('fa-angle-up');
		$(this).find('span').toggleClass('fa-angle-down');
	});
	$(document).on('click', 'input[type="radio"]', function() {
		hidden_couponid = $('input[name="couponid"]').val();
		var couponid = $(this).val();
		if (!hidden_couponid) {
			$('input[type="radio"]').prop('checked', false);
			$(this).prop('checked', true);
			$('input[name="couponid"]').val(couponid);
		} else {
			if (hidden_couponid == couponid) {
				$(this).prop('checked', false);
				$('input[name="couponid"]').val('');
			} else {
				$('input[type="radio"]').prop('checked', false);
				$(this).prop('checked', true);
				$('input[name="couponid"]').val(couponid);
			}
		}
	});
	var cards_str = '<?php  echo $cards_str;?>';
	if (cards_str) {
		cards_str = $.parseJSON(cards_str);
	} else {
		cards_str = {};
	}
	$(document).on('click', '.js-submit', function() {
		var checked_card = $('input[name="couponid"]').val();
		if(checked_card && cards_str[checked_card]) {
			if (cards_str[checked_card].type == '1') {
				$('.js-coupon .js-card-info').html('已抵用'+cards_str[checked_card].discount_cn+'元');
				$('.js-token .js-card-info').html('未使用');
			};
			if (cards_str[checked_card].type == '2') {
				$('.js-token .js-card-info').html('已抵用'+cards_str[checked_card].discount_cn+'元');
				$('.js-coupon .js-card-info').html('未使用');
			};
			$('.js-pay input[name="coupon_id"]').val(checked_card);
			$('.js-pay input[name="code"]').val(cards_str[checked_card]['code']);
		} else {
			$('.js-token .js-card-info').html('未使用');
			$('.js-coupon .js-card-info').html('未使用');
			$('.js-pay input[name="coupon_id"]').val(0);
		}
		$('#pay-select-coupon-modal').removeClass('mui-active');
		$('#pay-select-token-modal').removeClass('mui-active');
		$('.mui-backdrop').remove('.mui-backdrop');
		$('.pay-method').removeAttr('style');
	})
</script>
<?php  } ?>
<script type="text/javascript">
$('.credit-js-pay').click(function() {
	<?php  if(empty($credit_pay_setting)) { ?>
	util.loading();
	$.post("<?php  echo app_url('pay/cash/credit')?>", $(this).find('form').serialize(), function(data){
		if (data.status){
			util.program.navigate(data.result.url);
		}else{
			util.tips(data.message);
		}
	},"json").error(function (d) {
       console.log(d)
    });
	return false;
	<?php  } ?>
	mui.prompt('','','请输入6位数的密码',['<div id="submit_password">确定</div>'],function(){
		$.post("<?php  echo url('mc/cash/check_password');?>", {'password' : $(".mui-popup-input input").val()}, function(data) {
			data = $.parseJSON(data);
			if (data.message == 0) {
				check_password = 'pass';
				$('#credit_pay').submit();
				return false;
			} else {
				alert('密码输入错误');
				return false;
			}
		});
	},'div')
	document.querySelector('.mui-popup-input input').type='password';
	return false;
});

document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	$('.js-wechat-pay').removeClass('mui-disabled');
	$('.js-wechat-pay a').addClass('js-pay');
	$('#wetitle').html('微信支付');
});

$(document).on('click', '.js-cancel', function() {
	location.href = "<?php  echo app_url('records')?>";
});

$(function(){
	var autoCancle = "<?php  echo $_W['_config']['task']['0'];?>",cancleTime = "<?php  echo $_W['_config']['cancle_time'];?>",cancleMsg='';
		cancleTime = cancleTime==''?1:cancleTime;
		cancleMsg = parseInt(cancleTime) ? cancleTime+'小时内付款有效':(cancleTime*60).toFixed(0)+'分钟内付款有效';
	
	$(document).on('click', '.js-pay', function() {
		var paytype = $(this).attr('id'); // 支付方式。
		var params = $(this).find("input[name^='params']").val(),
		code =  $(this).find("input[name^='code']").val(),
		coupon_id = $(this).find("input[name^='coupon_id']").val();
		
		if(paytype =='delivery'){//线下付款。
			util.confirm('确认线下付款？', ' ', function(e) {
				if (e.index == 1){
					util.program.navigate("<?php  echo app_url('pay/success/delivery',array('id'=>$orderid))?>");	
				}
			});
		}
		if(paytype =='wechat'){ //微信支付。
			if (autoCancle=='cancle'){
				util.confirm(cancleMsg, ' ',['取消', '确认支付'], function(e) {
					if (e.index == 1){
						initPay(params,code,coupon_id);
					}else{
						util.tips('已取消支付');
					}
				});
			}else{
				initPay(params,code,coupon_id);
			}
		}
	})
});
function initPay(params,code,coupon_id){
	var order_type='', redirect = "<?php  echo app_url('pay/success', array('id' => $orderid))?>";
	if ('recharge.pay'=="<?php  echo $_GPC['r'];?>"){
		order_type = 'recharge';
		redirect = "<?php  echo app_url('pay/success/recharge')?>";
	}
    wx.miniProgram.getEnv(function (res) {
        if (res.miniprogram) { //只有在小程序环境下，才跳转到小程序支付页面去支付，否则的话都是跳转到订单详情去让它重新选支付方式。
			var url = encodeURIComponent(redirect+'&paytype=wxapp');
            wx.miniProgram.navigateTo({ //这将唤起小程序的原生页面
                url: '/wnfx_activity/pages/pay/pay?orderid=<?php  echo $params['ordersn'];?>&type='+order_type+'&url='+url
            })
        }else {
			util.loading();
            $.post("<?php  echo app_url('pay/cash/wechat',array('payopenid'=>$payopenid))?>",{params:params,code:code,coupon_id:coupon_id},function(m){
        		util.loading().close();
        		if(!m.errno){ //验证通过，开始微信支付。
        			var data = <?php  echo json_encode($params)?>;
        			
        			WeixinJSBridge.invoke('getBrandWCPayRequest', {
        				appId: m.data.appid ? m.data.appid : m.data.appId,
        				timeStamp: m.data.timeStamp+'',
        				nonceStr: m.data.nonceStr,
        				package: m.data.package,
        				signType: m.data.signType,
        				paySign: m.data.paySign
        			}, function(res) {
        				if("get_brand_wcpay_request:ok" == res.err_msg) {
        						location.href = redirect;
        				}else if ("get_brand_wcpay_request:cancel" == res.err_msg){
        					util.tips('已取消支付');
        				}else {
        					util.tips(res.err_msg);
        				}
        			});
        			/*util.pay({
        				orderFee : data.fee,
        				payMethod : 'wechat',
        				orderTitle : data.title,
        				orderTid : data.ordersn,
        				module : data.module,
        				success : function(result) {
        					util.tips('支付成功');
        					setTimeout(function(e) {
        						location.href = "<?php  echo app_url('pay/success', array('payprice' => $params['fee'], 'done'=>1))?>";
        					},100);
        				},
        				fail : function(result) {
        					util.tips('支付失败 : ' + result.message);
        				},
        				complete : function(result) {
        					//{"errno";-1,"message":"get_brand_wcpay_request:cancel"}
        					if (result.errno==-1){
        						util.tips('取消支付');
        					}
        				}
        			});*/
        		}else{
        			util.alert(m.message, ' ', function() {history.go(-1);});
        		}
        	},"json");
        }
    })
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>