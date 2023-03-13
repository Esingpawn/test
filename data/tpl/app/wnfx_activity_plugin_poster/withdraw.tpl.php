<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-table-view.mui-grid-view .mui-table-view-cell{font-size:18px;border:none;background-color:#fff;padding:12px 15px; position:relative;margin-right:0px;}
.mui-table-view.mui-grid-view .mui-table-view-cell>a:not(.mui-btn){margin: -11px -14px;}
.mui-table-view.mui-grid-view .mui-table-view-cell:last-child:after{ border:none;}
.mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body{color:#777777; font-size:80%;margin-top:0;height:auto;line-height:inherit}
.mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body b{color:#f15353;}
.mui-table-view.mui-grid-view span.mui-ext-icon{ position:relative; width:30px; height:25px; margin:0 auto;display:inline-block;}
.mui-table-view.mui-grid-view span.mui-ext-icon:before{ left:50%;transform: translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);font-size:1.2rem; color:#999}
.mui-table-view.mui-grid-view span.mui-ext-icon.mui-icon-qianbao:before{font-size:18px;}
.mui-table-view.mui-grid-view .mui-badge{ position:absolute;}
.line.mui-table-view.mui-grid-view .mui-table-view-cell:after{content: ""; position:absolute; right:0; left:auto; top:50%;border-right:1px solid #e0e0e0; height:60%;-webkit-transform: translateY(-50%) scaleX(0.5); transform: translateY(-50%) scaleX(0.5);}
.withdraw>.tablebox .mui-table-view.mui-grid-view .mui-table-view-cell{padding:10px;}
.withdraw>.tablebox .mui-table-view.mui-grid-view .mui-table-view-cell:first-child{}
.withdraw>.tablebox .mui-checkbox input{left:0}
.withdraw>.tablebox .mui-table-view:first-child{background:none;}
.withdraw>.tablebox .mui-table-view:first-child .mui-table-view-cell{background:none;padding:8px 10px; font-weight:500}
</style>
    <div class="mui-content" style="z-index:1">
    	<form id="formdata" action="" method="post" onSubmit="return check(this)" style="position:initial">
            <div class="withdraw">
                <div class="tablebox">
                    <ul class="mui-table-view mui-grid-view mui-afterbefore-no mui-text-gray" style="margin:0;padding:0;">
                        <li class="mui-table-view-cell mui-media mui-col-xs-2 mui-col-sm-2">
                            <a href="javascript:;" class="mui-text-gray">
                            <div class="mui-media-body">
                                <div class="mui-checkbox mui-left js-checkall" style="height:28px">
                                    <input name="checkall" value="Item 2" type="checkbox" <?php  if($amounts<=0) { ?>disabled="disabled"<?php  } ?>/>
                                </div>
                            </div>
                            </a>
                        </li>
                       <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
                            <a href="javascript:;" class="mui-text-gray"><div class="mui-media-body">类型</div></a>
                        </li>
                        <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
                            <a href="javascript:;" class="mui-text-gray"><div class="mui-media-body">金额</div></a>
                        </li>
                        <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
                            <a href="javascript:;" class="mui-text-gray"><div class="mui-media-body">手续费</div></a>
                        </li>
                    </ul>
                    <ul class="mui-table-view mui-grid-view mui-afterbefore-no mui-text-gray" style="margin:0;padding:0;">
                        <li class="mui-table-view-cell mui-media mui-col-xs-2 mui-col-sm-2">
                            <a href="javascript:;" class="mui-text-gray">
                            <div class="mui-media-body">
                                <div class="mui-checkbox mui-left js-check" style="height:28px">
                                    <input name="postdata[type]" value="commission" type="checkbox" data-amounts="<?php  echo $amounts;?>" data-poundage="<?php  echo $poundage;?>" data-servicetax="<?php  echo $servicetax;?>" class="items" <?php  if($amounts<=0) { ?>disabled="disabled"<?php  } ?>/>
                                    <input name="postdata[amounts]" value="<?php  echo $amounts;?>" type="hidden" data-amounts="" />
                                </div>
                            </div>
                            </a>
                        </li>
                        <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
                            <a href="javascript:;" class="mui-text-gray"><div class="mui-media-body">推客佣金</div></a>
                        </li>
                        <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
                            <a href="javascript:;" class="mui-text-gray"><div class="mui-media-body"><?php  echo number_format($amounts,2)?></div></a>
                        </li>
                        <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
                            <a href="javascript:;" class="mui-text-gray"><div class="mui-media-body"><?php  echo number_format($poundage,2)?></div></a>
                        </li>
                    </ul>
                </div>
                <ul class="mui-table-view mui-grid-view mui-afterbefore-no mui-text-gray line" style="padding:0;" id="info">
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;" class="mui-text-gray">
                        <div class="mui-media-body"><b>0.00</b> 元<br>提现金额合计</div></a>
                    </li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;" class="mui-text-gray">
                        <div class="mui-media-body"><b>0.00</b> 元<br>手续费合计</div></a>
                    </li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;" class="mui-text-gray">
                        <div class="mui-media-body"><b>0.00</b> 元<br>劳务税合计</div></a>
                    </li>
                </ul>
            </div>
            <div class="mui-content-padded">
            	<?php  if($set['income']['balance']) { ?>
                <button class="mui-btn mui-btn-danger mui-btn-block js-button" type="button" data-manual="4">提现到余额</button>
                <?php  } ?>
                <?php  if($set['income']['wechat']) { ?>
                <button class="mui-btn mui-btn-success mui-btn-block js-button" type="button" data-manual="2">提现到微信</button>
                <?php  } ?>
                <?php  if($set['income']['alipay']) { ?>
                <button class="mui-btn mui-btn-warning mui-btn-block js-button" type="button" data-manual="3">提现到支付宝</button>
                <?php  } ?>
                <?php  if($set['income']['manual']) { ?>
                <button class="mui-btn mui-btn-danger mui-btn-block js-button" type="button" data-manual="1">提现手动打款</button>
                <?php  } ?>
                <button class="mui-btn mui-btn-outlined mui-btn-block" type="button" onclick="location.href='<?php  echo app_url('commission',array('op' => 'withdraw.list'), MODULE_PLUGIN_NAME)?>'">提现记录</button>
            </div>
        </form>
    </div>
<script>
$(function(){
	//屏蔽slider选项卡弹出遮罩
	$('.mui-slider .mui-control-item').on('tap',function(e) {
		setTimeout(function(){
			$('.mui-backdrop').remove();
			$("body").css('overflow','');
			$('.mui-content').css('overflow','');
		});
		$("body").addClass('mui-backdrop-none');
	});
	$('.js-checkall :checkbox').on('click',function(e) {
		var ck = this.checked;
		$('.js-check :checkbox').each(function(){this.checked = ck});
		checkResult();
	});
	$('.js-check :checkbox').on('click',function(e) {
		checkResult();
	});
	$('.js-button').on('click',function(e) {
		var ids = [];
		var $checkboxes = $('.items:checkbox:checked');
		$checkboxes.each(function() {
			if (this.checked) {
				ids.push(this.value);
			};
		});
	
		if (ids.length == 0) {
			util.tips('请选择要操作的信息!', 2000);
			return false;
		}
		util.loading();
		$.post("<?php  echo app_url('commission', array('op' => 'withdraw'))?>", $.param({manual:$(this).data('manual')})+'&'+$("#formdata").serialize(), function(data){
			//console.log(data);
			util.loading().close();
			util.tips(data.msg);
			if (!data.error){
				setTimeout(function(){
					history.go(-1);
				}, 2000);
			}
		},"json");
	});
});
function checkResult(){
	var amounts=0,poundage=0,servicetax=0;
	$('.js-check :checkbox').each(function(){
		if (this.checked){
			amounts += Number($(this).data('amounts'));
			poundage += Number($(this).data('poundage'));
			servicetax += Number($(this).data('servicetax'));
		}
	});
	$("#info").find('li').eq(0).find('.mui-media-body b').text(amounts.toFixed(2));
	$("#info").find('li').eq(1).find('.mui-media-body b').text(poundage.toFixed(2));
	$("#info").find('li').eq(2).find('.mui-media-body b').text(servicetax.toFixed(2));
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>