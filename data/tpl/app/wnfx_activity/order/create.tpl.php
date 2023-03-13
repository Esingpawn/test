<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.mui-bar a{color: #ff9900;}
.mui-btn-primary{background-color: #ff9900;}
.mui-btn-primary:enabled:active{background-color: #ec7230!important;}
.mui-textarea{ height:auto!important; width:100%;}
.area {margin: 20px auto 0px auto;}
.mui-input-group:first-child {margin-top:0;}
.mui-rmb i{ font-style:normal; }
.mui-input-row label~input, .mui-input-row label~select, .mui-input-row label~textarea {width: 65%;}
.mui-del{color:#999}
footer .mui-input-row {line-height:1.6}
footer .mui-input-row label{line-height:2!important;width:auto;margin:-1px 0;text-align:right; float:right;}
footer .mui-input-row span{ padding:0.5rem 0.5rem 0.5rem 0;font-size:0.55rem}
footer .mui-input-row .mui-btn{top:0;font-size:0.65rem;line-height:1.6!important;padding: 0.5rem 0.45rem!important;;border-radius:0; width:35%}
.mui-input-row #get_code{width:auto; border-radius: 0;line-height: 1.7;}
.mui-help-top .mui-table-view-cell{padding: 9px 12px;}
.mui-help-top .mui-icon-help:before{ color:#fe5001;font-size:18px;top:43%;}
.mui-help-top .mui-small{ font-size:90%!important;}
.mui-help-top .mui-help-info:before{position: absolute;content: ""; height:99%!important;left:0;top:0;width:3px; background-color:#fe5001;}
.mui-input-row.mui-help .mui-help-info{padding-right:30px;}
.mui-input-row{height:auto!important;min-height:40px;}
.mui-input-row.mui-radio label, .mui-input-row.mui-checkbox label{padding-right:50px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;white-space:normal;word-wrap: break-word;}
.mui-input-row.mui-group-title:before{position: absolute;content: "";border-radius:2px;height:38%;left:10px;top:50%;width:2px;background-color: #fe5001;-webkit-transform: translateY(-50%);transform: translateY(-50%);}
</style>
<form id="formdata" action="" method="post" onSubmit="return check(this)" style="position:initial">
<footer class="mui-bar mui-bar-footer basic"<?php  if($aprice>0) { ?> style="padding:0;"<?php  } ?>>
    <?php  if($aprice>0) { ?>
    <div class="mui-input-row">
    <input type="submit" class="mui-btn mui-btn-yellow" name="submit_btn" value="提交信息" />
    <span class="mui-pull-right mui-text-rmb"><font class="mui-rmb mui-small"></font> <font class="mui-big js-pay-totaled"><?php  echo $pay_price;?></font> </span>
    <label>合计：</label>
    </div>
    <?php  } else { ?>
    <input type="submit" class="mui-btn mui-btn-yellow mui-btn-block" name="submit_btn" value="提交信息" />
    <?php  } ?>
    <input type="hidden" name="submit" value="提交信息" />
    <input type="hidden" name="activityid" value="<?php  echo $id;?>" />
    <input type="hidden" name="optionid" value="<?php  echo $optionid;?>" />
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    <?php  if(checkplugin('seat')) { ?>
    <input type="hidden" name="seats" value="" />
    <?php  } ?>
</footer>
<div class="mui-content">
    <ul class="mui-table-view mui-help-top" style="margin-top:0;display:none">
        <li class="mui-table-view-cell">
        	<p class="mui-pl20">&nbsp;余额充值</p>
            <span class="mui-navigate-left mui-icon-help mui-text-orange mui-small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;凡是"*"，"必填"，"必选"的为必填选项</span>
        </li>
    </ul>
    <?php  if(checkplugin('seat') && $activity['switch']['seat']) { ?>
    <div class="mui-input-group basic mui-afterbefore-no">
        <ul class="mui-table-view mui-afterbefore-no" style="margin-bottom:10px;">
            <li class="mui-table-view-cell js-popover" data-popover="seatbox">
                <a class="mui-navigate-right">           
                    <p style="color:#000">选座</p>
                    <span class="mui-badge mui-badge-inverted mui-ellipsis-1" id="seat_show" style="width:70%;text-align: right;"></span>  
                </a>
            </li>
        </ul>
    </div>
    <?php  } ?>
    <div id="forms">
        <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('order/form', TEMPLATE_INCLUDEPATH)) : (include fx_template('order/form', TEMPLATE_INCLUDEPATH));?>
    </div>
    <div class="mui-input-group basic mui-afterbefore-no">
    	<ul class="mui-table-view mui-afterbefore-no">
            <li class="mui-table-view-cell" style="<?php  if($activity['limitnum']==1) { ?>display:none<?php  } ?>">
            	<span style="line-height:2.5;"><?php echo empty($activity['unitstr'])?'数量':$activity['unitstr']?></span>
                <span class="mui-numbox mui-pull-right">
                <button class="mui-btn mui-btn-numbox-minus" type="button">-</button>
                <input name="buynum" class="mui-input-numbox js-pay-num" type="number" value="<?php  echo $buynum;?>" pattern="[0-9]*">
                <button class="mui-btn mui-btn-numbox-plus" type="button">+</button></span>
            </li>
        <?php  if($aprice >0) { ?>
        	<input type="hidden" name="price" value="<?php  echo $pay_price;?>" class="js-pay-price"/>
            <input type="hidden" name="aprice" value="<?php  echo $aprice;?>" />
        	<?php  if($_W['plugin']['card']['config']['card_enable'] && $is_vip && $activity['iscard']==1 && !$activity['prize']['cardper']['enable']) { ?>
                <li class="mui-table-view-cell">单价<span class="mui-pull-right mui-del"><font class="mui-small mui-rmb"></font> <font class="mui-big"><?php  echo $aprice;?></font></span></li>
                <li class="mui-table-view-cell"><?php  echo $yearcard['name'];?>专享价<span class="mui-pull-right"><font class="mui-small mui-rmb"></font> <font class="mui-big"><?php  echo $activity['costprice'];?></font></span></li>
            <?php  } else { ?>
            	<li class="mui-table-view-cell">单价<span class="mui-pull-right"><font class="mui-small mui-rmb"></font> <font class="mui-big"><?php  echo $aprice;?></font></span></li>
            <?php  } ?>
            <?php  if($afterMarketing['m1']) { ?>
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right js-marketing js-popover" data-popover='marketing'>活动优惠<span class="mui-badge mui-badge-inverted">满<?php  echo $afterMarketing['max'];?>名：可享 <?php  echo $afterMarketing['p'];?> 折</span></a>
                </li>
            <?php  } else if($afterMarketing['m2']) { ?>
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right js-marketing js-popover" data-popover='marketing'>活动优惠<span class="mui-badge mui-badge-inverted">满<?php  echo $afterMarketing['max'];?>名：立减 <?php  echo $afterMarketing['p'];?> 元</span></a>
                </li>
            <?php  } else if($afterMarketing['m3']) { ?>
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right js-marketing js-popover" data-popover='marketing'>活动优惠<span class="mui-badge mui-badge-inverted">会员组 <?php  echo $_W['member']['groupname'];?> 专享：<?php  if($afterMarketing['orderMarket']['vip']['type']==1) { ?><?php  echo $afterMarketing['p'];?> 折<?php  } else { ?>立减 <?php  echo $afterMarketing['p'];?> 元<?php  } ?></span></a>
                </li>
            <?php  } else { ?>
                <li class="mui-table-view-cell" style="display:none">
                    <a class="mui-navigate-right js-marketing js-popover" data-popover='marketing'>活动优惠<span class="mui-badge mui-badge-inverted"></span></a>
                </li>
            <?php  } ?>
            <li class="mui-table-view-cell">小计<span class="mui-pull-right mui-text-rmb"><font class="mui-small mui-rmb"></font> <font class="mui-big js-pay-total">
            <?php  if($activity['prize']['cardper']['enable']) { ?>
            	<?php  echo sprintf("%.2f", $pay_price + $afterMarketing['cardReduce'])?>
            <?php  } else { ?>
            	<?php  echo $pay_price;?>
            <?php  } ?>
            </font></span></li>
        <?php  } ?>
        <?php  if($_W['plugin']['card']['config']['card_enable'] && $is_vip && $activity['iscard']==1 && $aprice >0) { ?>
        	<?php  if($activity['prize']['cardper']['enable']) { ?>
        	<li class="mui-table-view-cell">
                <a href="javascript:;"><?php  echo $yearcard['name'];?>专享优惠<span class="mui-badge mui-badge-inverted js-card-reduce">- <?php  echo $afterMarketing['cardReduce'];?> 元</span></a>
            </li>
            <?php  } ?>
        <?php  } ?>
        <?php  if($afterMarketing['m4']) { ?>
            <li class="mui-table-view-cell">
            	<?php  echo m('member')->getCreditName('credit1')?>抵扣
                <span style="display: inline-block;padding-right:60px;" class="mui-small mui-text-org">当前<?php  echo m('member')->getCreditName('credit1')?><?php  echo $_W['member']['credit1'];?>，<span class="js-deduct">可消耗<?php  echo $afterMarketing['orderMarket']['deduct']['0'];?><?php  echo m('member')->getCreditName('credit1')?>抵扣 ￥<?php  echo $afterMarketing['orderMarket']['deduct']['1'];?></span></span>
                <div class="mui-switch mui-switch-blue mui-switch-mini">
                    <div class="mui-switch-handle"></div>
                    <input type="hidden" name="dc" value=""  class="js-dc"/>
                </div>
            </li>
        <?php  } ?>
        <?php  if($activity['costcredit']) { ?>
        <li class="mui-table-view-cell mui-media">
            <div class="mui-media-body">
                <?php  echo m('member')->getCreditName('credit1')?>消耗
                <p class="mui-ellipsis mui-small mui-text-org">参与当前活动需要消耗 <?php  echo $activity['costcredit'];?> <?php  echo m('member')->getCreditName('credit1')?></p>
            </div>
        </li>
        <?php  } ?>
        </ul>
        
    	<?php  if($_W['_config']['joinmsg']) { ?>
        <p></p>
        <div style="background:#FFF;overflow:hidden">
            <div class="mui-content-padded">
                <textarea id="textarea" class="mui-input-clear" name="msg" placeholder="给主办方留言" style="padding:3px;"></textarea>
            </div>
        </div>        
        <?php  } ?>        
        <?php  if($_W['_config']['agreement']['0']) { ?>
        <p></p>
        <div class="mui-content-padded">
            <div class="mui-checkbox mui-agreement">
                <input name="agreement" value="1" type="checkbox"><label class="js-popover" data-popover='agreement'>已阅读并同意《<a>用户<?php  echo $_W['_config']['buytitle'];?>协议</a>》</label>
            </div>
        </div>
        <?php  } ?>
        <p>&nbsp;</p>        
    </div>
</div>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
mui('.mui-scroll-wrapper').scroll();
$(function(){
	$('input[type=text]').each(function(key){
		if ($(this).attr("readonly")) $(this).attr('onfocus','this.blur()');
	});
	var oldMoble = "<?php  echo $profile['mobile'];?>";
	$('.js-check-mobile').on("tap",function(e) {
		if (!$(this).parent().next().hasClass('active')){
			$(this).parent().next().show().addClass('active');
			$(this).prev().removeAttr('onfocus');
			$(this).find('span').text('取消变更');
		}else{
			$(this).parent().next().hide().removeClass('active');
			$(this).prev().attr('onfocus','this.blur()').val(oldMoble).blur();
			$(this).find('span').text('点此变更');
		}
	});
	<?php  if($afterMarketing['m4']==1) { ?>
	//开关
	$('.mui-switch').on('tap',function(e){
		var buynum = $('.js-pay-num').val();
		if ($(this).hasClass("mui-active")){
			$(this).find('input').val('yes');
			getPrice(buynum, 'yes');
		}else{
			$(this).find('input').val('');
			getPrice(buynum, '');
		}
		//console.log("你启动了开关");
	});
	<?php  } ?>
	//<?php  echo $_W['_config']['buytitle'];?>人数控制
	var payprice, aprice =<?php  echo $aprice;?>,limitnum=parseInt(<?php  echo $activity['limitnum'];?>),gnum=parseInt(<?php  echo $gnum;?>),joinnum=parseInt(<?php  echo $joinnum;?>);
	var forgnum = gnum?gnum-joinnum:0;
	$("input.js-pay-num").bind('input propertychange, change', function(e) {
		e.stopPropagation();
		if ($(this).val()==0){
			$(this).val(1);
		}
		//判断名额
		if($(this).val() > forgnum && gnum > 0){
			$(this).val(forgnum);
			util.alert('已超出剩余数量范围', ' ', function() {
				$(".js-pay-num").val(forgnum);
			});
		}
		//团名额限制
		if ($(this).val() > limitnum && limitnum > 0){
			$(".js-pay-num").val(limitnum);
			util.alert('已达该票输入最大值', ' ', function() {
				$('.js-pay-price').val(payprice);
			});
		}
		var buynum = $(this).val(),dc = $('.js-dc').val();
		//读取价格
		if(aprice>0){
			getPrice(buynum, dc);
		}
		<?php  if($activity['switch']['form']) { ?>
		var formlen = $('#forms .form').length;
		if (formlen < buynum){
			var url = "<?php  echo app_url('order/form', array('id'=>$id))?>&buynum="+buynum+"&formlen="+formlen;
			$.ajax({
				"url": url,
				success:function(data){		
					$('#forms').append(data);
					$('.mui-group-title').show();
					countdown(formlen);					
				}
			});
		}else{
			$('#forms .form').eq(buynum-1).nextAll().remove();
			buynum ==1 ? $('.mui-group-title').hide() : '';
		}		
		<?php  } ?>
	});

	<?php  if($_W['_config']['smsswitch']) { ?>
	$('#forms .form').each(function(i, d){
		countdown(i);
	});
	
	$('body').delegate('.send_code','tap', function(e) {
		var formkey = $(this).data("key"), count = $.getCookie("countdown_"+formkey);
		if(count==null){ 
			//验证电话号码手机号码 
			var phoneObj = $(this).parents('.mui-input-row').prev().find('.mobile');
			if (phoneObj.val() != ""){  
				var phoneVal=phoneObj.val();  
				if (!util.mobile(phoneVal)){
					phoneObj.val('');
					util.alert('手机号不合法', ' ', function() {
						phoneObj.focus(); 
					}); 
					return false;
				}else{ 
					countdown(formkey, 60);	
					$.ajax({
						type: 'POST',
						url: "<?php  echo app_url('api/sendsms/code')?>&mobile="+phoneVal+"&key="+formkey,
						dataType: 'json',
						success: function(data){
							console.log(data);
							if(data.hasOwnProperty("result") || data.Code=='OK'){
								util.toast('发送成功');
							}else{
								var err_msg = data.hasOwnProperty("Message") ? data.Message : data.sub_msg;
								util.alert(err_msg, ' ', function() {return false;});
							}
						},
						error:function(){
							util.alert('服务器错误, 请联系官方人员', ' ', function() {return false;});
						}
					});
				} 
			}else{ 
				util.toast('手机不能为空',"","error");
				return false; 
			} 
		} 
	});
	<?php  } ?>
});

//校验表单
function check(form) {
	var checksubmit = true, value='';	
	$('#forms .form').each(function(index, d){
		var _this = $(this),
			checkmsg = $('#forms .form').length>1?'第'+(index+1)+'位的':'';
		<?php  if($sysform['realname']['show']!='0') { ?>
			var realname = _this.find(form['member_'+index+'[realname]']);
			if ($.trim(realname.val()) == '') {
				util.alert('请输入'+checkmsg+'姓名', ' ', function() {
					realname.focus();
				});
				checksubmit = false;
				return false;
			}
		<?php  } ?>
		<?php  if($sysform['mobile']['show']!='0') { ?>
			var mobile = _this.find(form['member_'+index+'[mobile]']);
			if (!mobile.val()) {
				util.alert('请输入'+checkmsg+'手机号', ' ', function() {
					mobile.focus();
				});
				checksubmit = false;
				return false;
			}else{
				if (!util.mobile(mobile.val())) {
					util.alert(checkmsg+'手机号不合法', ' ', function() {
						mobile.focus();
					});
					checksubmit = false;
					return false;
				}
			}
			
			<?php  if($_W['_config']['smsswitch']) { ?>
			var smscode = _this.find(form['smscode']), 
				check_tel = smscode.parent().hasClass('active');
			if (check_tel){
				if (!smscode.val()) {
					util.alert('请输入验证码', ' ', function() {
						smscode.focus();
					});
					checksubmit = false;
					return false;
				}else{	  
					if ($.getCookie("sms_code_"+index)!=smscode.val()) {
						util.alert('验证码不正确', ' ', function() {
							smscode.focus();
						});
						checksubmit = false;
						return false;
					}else if(mobile.val()!=$.getCookie("sms_mobile_"+index)){
						console.log(data);
						util.alert('当前手机号与验证码不符', ' ', function() {
							smscode.focus();
						});
						checksubmit = false;
						return false;
					}
				}
			}
			<?php  } ?>
		<?php  } ?>
		$($(this).find(form['must'])).each(function(){
			var inputkey = $(this).val();
			var formtype = $(this).data('type');
			var inputName = 'form_item_val_'+$(this).val()+'_'+index;
			if (inputkey!=''){
				if (_this.find(form[inputName+'[]']).length || formtype=='6'){
					inputName = inputName+'[]';
					if (_this.find(form[inputName]).attr("type")=='checkbox' && _this.find(form[inputName]).filter(':checked').length == 0) {
						util.alert(checkmsg+$(this).attr("title")+'为必选项', ' ', function() {
							_this.find(form[inputName]).focus();
						});
						checksubmit = false;
					}else if(formtype=='6' && !_this.find(form[inputName]).length){
						util.alert(checkmsg+$(this).attr("title")+'不能为空', ' ', function() {});
						checksubmit = false;
					}
				}else if(_this.find(form[inputName+'[province]']).length){
					if (!_this.find(form[inputName+'[province]']).val()) {
						util.alert(checkmsg+$(this).attr("title")+'为必选项', ' ', function() {
							$('.mui-district-picker-'+inputName).trigger('tap');
						});
						checksubmit = false;
					}
				}else if(formtype=='10'){
					if (!util.mobile(_this.find(form[inputName]).val())){
						util.alert(checkmsg+$(this).attr("title")+'不合法', ' ', function() {
							_this.find(form[inputName]).focus();
						});
						checksubmit = false;
					}
				}else{
					if ($.trim(_this.find(form[inputName]).val())=="" && _this.find(form[inputName]).attr("type")!='radio' && !_this.find(form[inputName]).next().val()) {
						var msg = _this.find(form[inputName]).siblings('.mui-calendar-picker'+inputkey+'-'+index).length?'为必选项':'不能为空';
						util.alert(checkmsg+$(this).attr("title")+msg, ' ', function() {
							if (formtype=='3' || formtype=='4'){
								_this.find(form[inputName]).focus();
							}
							_this.find(form[inputName]).siblings('.mui-calendar-picker'+inputkey+'-'+index).trigger('tap');
							_this.find(form[inputName]).trigger('tap');
	
						});
						checksubmit = false;
					}else if(_this.find(form[inputName]).attr("type")=='radio' && $('input:radio[name="'+inputName+'"]:checked').length == 0){
						util.alert(checkmsg+$(this).attr("title")+'为必选项', ' ', function() {
							_this.find(form[inputName]).focus();
							_this.find(form[inputName]).trigger('tap');
						});
						checksubmit = false;
					}
				}
			}else{
				inputName = "member_"+index+"["+formtype+"]";
				var typeStr = "education,birthyear,resideprovince,constellation,zodiac,bloodtype";
				if (typeStr.indexOf(formtype)>-1){
						if (formtype=='birthyear' && _this.find(form['birth_'+index]).val()==""){
							util.alert(checkmsg+$(this).attr("title")+'为必选项', ' ', function() {
								_this.find(form['birth_'+index]).trigger('tap');
							});
							checksubmit = false;
						}else if(formtype=='resideprovince' && $('.mui-district-picker-reside_'+index).val()==""){
							util.alert(checkmsg+$(this).attr("title")+'为必选项', ' ', function() {
								$('.mui-district-picker-reside_'+index).trigger('tap');
							});
							checksubmit = false;
						}else if (_this.find(form[formtype]).val()==""){
							util.alert(checkmsg+$(this).attr("title")+'为必选项', ' ', function() {
								_this.find(form[formtype]).siblings('.mui-'+formtype+'-picker_'+index).trigger('tap');
							});
							checksubmit = false;
						}					
				}else if($.trim(_this.find(form[inputName]).val())=="" && _this.find(form[inputName]).length){
					util.alert(checkmsg+$(this).attr("title")+'不能为空', ' ', function() {
						_this.find(form[inputName]).focus();
					});
					checksubmit = false;
				}else{
					if (formtype == 'idcard' && !util.idcard(_this.find(form[inputName]).val())){
						util.alert(checkmsg+$(this).attr("title")+'不合法', ' ', function() {
							_this.find(form[inputName]).focus();
						});
						checksubmit = false;
					}
				}
			}
			if (!checksubmit) return false;
		});
		if (!checksubmit) return false;
	});
	//if (form['gender'].value=='') {
	//	util.alert('请选择您的性别', ' ', function() {
	//		$(".js-user-options").trigger('tap');
	//	});
	//	return false;
	//}
	if (checksubmit){
		<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('order/seat', TEMPLATE_INCLUDEPATH)) : (include fx_template('order/seat', TEMPLATE_INCLUDEPATH));?>
		<?php  if($_W['_config']['agreement']['0']) { ?>
		if ($('input:checkbox[name="agreement"]:checked').length == 0) {
			util.alert('请阅读并同意<?php  echo $_W['_config']['buytitle'];?>协议', ' ', function() {
				$("input[name='agreement']").focus();
				mui('#agreement').popover('toggle');
			});
			return false;
		}
		<?php  } ?>
		
		
		<?php  if($activity['costcredit']) { ?>
		util.confirm("参与当前活动需要消耗 <?php  echo $activity['costcredit'];?><?php  echo m('member')->getCreditName('credit1')?>", ' ',['取消', '确认'], function(e) {
			if (e.index == 1){
				postData();
			}
		});
		<?php  } else { ?>
		postData();
		<?php  } ?>
	}
	return false;
}

//数据发送
function postData(){
	var submit_btn = $("input[name='submit_btn']").val();
	$("input[name='submit_btn']").val('信息提交中...').attr("disabled", "true");
	util.loading();
	$.ajaxSettings.timeout = '3000';
	$.post("<?php  echo app_url('order/create/post')?>", $("#formdata").serialize(), function(data){
		//console.log(data);
		util.loading().close();
		if (data.status){
			util.program.navigate(data.result.url);
		}else{
			$("input[name='submit_btn']").val(submit_btn).removeAttr("disabled");
			util.tips(data.result.message);
			if (data.result.type=='seat') {
				mui('#seatbox').popover('toggle');
				sc.get(data.result.seats).status('unavailable');
			}
		}
	},"json").error(function (xhr, status, info) {
		console.log(xhr);
		util.loading().close();
		$("input[name='submit_btn']").val(submit_btn).removeAttr("disabled");
		util.tips('系统错误，请尝试再次提交！');
	});
}
//价格计算
function getPrice(buynum, dc){
	util.loading();
	$.post("<?php  echo app_url('order/create/getprice',array('id'=>$id,'optionid'=>$optionid))?>", {buynum:buynum,dc:dc}, function(data){
		util.loading().close();
		console.log(data);
		if(!data.errno){
			var pay_price = parseFloat(data.params.pay_price), pay_total = parseFloat(<?php  echo $price;?>) * buynum;
			if (data.params.m1 || data.params.m2 || data.params.m3){
				$('.js-marketing').parent().show();
				if (data.params.m3){
					if (data.params.orderMarket.vip.type==1){
						$('.js-marketing').find('span').html("VIP <?php  echo $_W['member']['groupname'];?> 专享："+data.params.p+' 折');
					}else{
						$('.js-marketing').find('span').html("VIP <?php  echo $_W['member']['groupname'];?> 立减：-"+data.params.p+' 元');
						//pay_total = pay_total + parseFloat(data.params.p);
					}
				}else{
					var maxmeet=0, obj_ = new Object();
					$("#marketing .mui-input-row").each(function(key){
						$(this).find('input').attr('disabled',"true");
						$(this).find('input').removeAttr("checked");
						$(this).addClass('mui-disabled');
						if (buynum >= $(this).data("meet")){
							if ($(this).data("meet") > maxmeet) obj_ = this;
							maxmeet = $(this).data("meet")>maxmeet ? $(this).data("meet"):maxmeet;						
						}else{maxmeet=0}
					});
					$(obj_).find('input').prop("checked",'true');
					$(obj_).removeClass('mui-disabled');
					if (data.params.m1)
						$('.js-marketing').find('span').html('满'+data.params.max+'名：可享 '+data.params.p+' 折');
					if (data.params.m2){
						$('.js-marketing').find('span').html('满'+data.params.max+'名：立减 -'+data.params.p+' 元')
						//pay_total = pay_total + parseFloat(data.params.p);
					}
				}
				
			}else{
				$('.js-marketing').parent().hide();
			}
			
			if (dc){			
				//pay_total = pay_total + parseFloat(data.params.deductMoney);
			}			
			
			if (data.params.orderMarket.cardper){
				//pay_total = pay_total + parseFloat(data.params.cardReduce);
				$('.js-card-reduce').text('- '+data.params.cardReduce+' 元');
			}
			
			if (data.params.deductCredit>0){
				$('.js-deduct').text('可消耗'+data.params.deductCredit+"<?php  echo m('member')->getCreditName('credit1') ?>抵扣 ￥"+data.params.deductMoney);
			}
			$('.js-pay-total').text(pay_total.toFixed(2));			
			$('.js-pay-totaled').text(pay_price.toFixed(2));
			$('.js-pay-price').val(pay_price.toFixed(2));
			$("input[name='token']"). val(data.params.token);
		}
	},"json");
}
//验证码计时器
function countdown(key, count){
	var count = count > 0 ? count : $.getCookie("countdown_"+key);
	var btn = $('#forms .form').eq(key).find('.send_code');
	var resend = setInterval(function(){  
		count--;
		if (count > 0){  
			btn.html(count+"秒后可重发");
			$.setCookie("countdown_"+key, count);
		}else {  
			clearInterval(resend);  
			btn.html("获取验证码");
			$.delCookie("countdown_"+key);
		}
		console.log(count);
	}, 1000);
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>