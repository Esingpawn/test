<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="./resource/css/app.css" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=20170826" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/util.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>web/resource/js/util.min.js?v=20170912"></script>
<style>
.app .panel {background-color: #FFF;}
.app .app-preview.wap-editor-footer{border-radius:18px;padding-bottom:100px;position:relative}
.app .app-preview .app-content {width: 322px;margin: 0 auto;padding-bottom: 0px;border: 1px solid #c5c5c5;min-height: 400px;background: #fff}
.app .app-side{width:58%;}
.app .app-side>div{width:auto}
.app .app-coupon .promote-card {-webkit-tap-highlight-color:transparent;position:relative;height: 180px;overflow:hidden;border-radius:10px;margin:10px;color: #fff;-webkit-box-shadow: 0 4px 5px rgba(0,0,0,.15);box-shadow: 0 4px 5px rgba(0,0,0,.15)}
.app .app-coupon .promote-card>img{border-radius:10px;}
.app .app-coupon .promote-card .dot {width:100%;height: 5px;background-size: auto 5px;margin-top: 3px}
.app .app-coupon .promote-card .name {position: relative;padding: 0 70px 0 10px;height: 60px;line-height: 60px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;font-size: 18px}
.app .app-coupon .promote-card .promote-value {font-size: 30px;line-height: 40px}
.app .app-coupon .promote-card .promote-limit {font-size: 14px;line-height: 40px}
.app .app-coupon .promote-card .card-info{background-color:#FFF;position:absolute; left:0;bottom:0; right:0;}
.app .app-coupon .promote-card .card-info .promote-state{color: rgba(0,0,0,0.8);padding-left:15px; line-height:2}
.app .app-coupon .promote-card .card-info .promote-time {padding-left:15px;color: rgba(0,0,0,0.5);font-size: 12px;padding-bottom: 5px;border-radius:0  0 8px 8px}
.app .app-coupon .promote-desc{ background:#f2f2f2}
.app .app-coupon .promote-desc>div{background:#FFF}
.app .app-coupon .promote-desc .promote-desc-title {padding: 2px 15px; text-align:center; border-bottom: 1px solid #ddd;}
.app .app-coupon .promote-desc .promote-desc-title .nav.nav-tabs{margin:0;border-bottom:none;width: 60%;margin: auto;}
.app .app-coupon .promote-desc .promote-desc-title .nav>li{width:50%;}
.app .app-coupon .promote-desc .promote-desc-title .nav>li>a{padding:5px 10px;border:none;margin:0;position:relative;color:#999}
.app .app-coupon .promote-desc .promote-desc-title .nav-tabs>li.active>a{color:#000}
.app .app-coupon .promote-desc .promote-desc-title .nav-tabs>li.active>a:after{position:absolute;left:30px;right:30px;bottom: 0;height: 2px;background-color: #EC0000;content: "";}
.app .app-coupon .promote-desc .desc-detail {min-height:80px;padding: 15px}
.app .app-coupon .promote-desc .list-group{margin-bottom:0;}
.app .app-coupon .promote-desc .list-group-item{padding-left:0;margin-left:15px;border:none;border-top: 1px solid #ddd;border-radius:0;}
.app .app-coupon .promote-desc .list-group-item:first-child{border:none;}
.app .app-coupon .promote-desc .list-group-item .fa{ color:#83c53f}
.app .app-coupon .promote-desc .promote-desc-friends{background:#FFF;margin:10px 0; padding:8px 15px; font-size:18px;}
.app .app-coupon .promote-desc .promote-desc-friends span{ color:#999;font-size:12px;}
.app .app-coupon-edit .panel {border-radius: 0;border-bottom: 0}
.app .app-coupon-edit .panel:last-child {border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;border-bottom: 1px solid #ddd}
</style>
<form action="" method="post" class="form-horizontal">
	<div class="panel panel-default">
		<div class="panel-heading">设置年卡</div>
		<div class="panel-body">
			<div class="app clearfix">
				<div class="app-preview wap-editor-footer">
					<div class="app-header"></div>
					<div class="app-content app-coupon">
						<div class="inner">
							<div class="title">
								<h1><span class="js-name">年卡</span></h1>
							</div>
							<div class="con">
								<div class="ump-coupon-detail-wrap">
									<div class="promote-card">
                                    	<img class="card-bg ng-scope js-card-bg" width="100%" height="100%" src="<?php  if($card['thumb']) { ?><?php  echo tomedia($card['thumb'])?><?php  } else { ?>../addons/wnfx_activity/web/resource/images/card/1.png<?php  } ?>" ng-if="module.params.background.image" ng-src="<?php  if($card['thumb']) { ?><?php  echo tomedia($card['thumb'])?><?php  } else { ?>../addons/wnfx_activity/web/resource/images/card/1.png<?php  } ?>">
                                        <div class="card-info">
                                            <div class="promote-state"><span class="js-name">年卡</span>待激活</div>
                                            <div class="promote-time">
                                                有效期：<span class="js-start-time">自激活日算起之后的一年内有效</span><span class="js-end-time"></span>
                                            </div>
                                        </div>
									</div>
									<div class="promote-desc">
                                    	<div class="list-group">
                                        	<div class="list-group-item">年卡价格 <div class="pull-right text-danger"><span class="js-value">0.00</span> 元 / 年</div></div>
                                            <div class="list-group-item js-first"<?php  if(!$card['value_first']) { ?> style="display:none"<?php  } ?>>首次激活 <div class="pull-right text-danger"><span class="js-value-first">0.00</span> 元 / 年</div></div>
                                        	<div class="list-group-item">购买数量 <span class="pull-right"><i class="fa fa-minus-square-o"></i> 1 <i class="fa fa-plus-square"></i></span></div>
                                        </div>
										<div class="promote-desc-friends">
                                        	<div class="red">+绑定亲友信息</div>
                                            <span>请选择要开通的年卡亲友</span>
                                        </div>
                                        <div class="promote-desc-title">
                                            <ul class="nav nav-tabs" id="myTab">
                                                <li class="active"><a href="#tab_1">专属特权</a></li>
                                                <li><a href="#tab_2">使用说明</a></li>
                                            </ul>
                                            <script>
											$('#myTab a').click(function (e) {
												e.preventDefault();//阻止a链接的跳转行为
												$(this).tab('show');//显示当前选中的链接及关联的content
											})
											</script>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active desc-detail js-description" id="tab_1">这里显示专属特权，保存后请在移动端预览</div>
                                            <div class="tab-pane desc-detail js-detail" id="tab_2">这里显示使用说明，保存后请在移动端预览</div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="app-side" style="margin: 0;">
					<div class="app-coupon-edit">
						<div class="arrow-left"></div>
						<div class="inner">
							<div class="panel panel-default">
								<div class="panel-heading b">年卡基本信息</div>
								<div class="panel-body">
									<div class="form-group">
										<label class="col-md-3 control-label"><span class="red">*</span>年卡名称</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="card[name]" value="<?php  echo $card['name'];?>">
										</div>
									</div>
									<div class="form-group" id="value">
										<label class="col-md-3 control-label"><span class="red">*</span>价格设置</label>
										<div class="col-md-9">
                                        	<div class="group-item">
                                            	<div class="input-group">
                                                    <span class="input-group-addon">
                                                        <label class="checkbox-inline">
                                                           <input type="checkbox" name=""<?php  if($card['value']['y']['0']) { ?> checked<?php  } ?> value="1" onclick="showItem(this);">显示
                                                           <input type="hidden" name="card[value][y][]" VALUE="<?php echo $card['value']['y'][0]=='0'?0:1;?>" />
                                                        </label>
                                                    </span>
                                                    <input type="text" class="form-control" name="card[value][y][]" value="<?php  echo $card['value']['y']['1'];?>" data-key='0' />
                                                    <span class="input-group-addon">元 / 年</span>
                                                </div>
                                            </div>
                                            <div class="group-item" style="margin-top:10px;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name=""<?php  if($card['value']['q']['0']) { ?> checked<?php  } ?> value="1" onclick="showItem(this);">显示
                                                            <input type="hidden" name="card[value][q][]" VALUE="<?php echo $card['value']['q'][0]=='0'?0:1;?>" />
                                                        </label>
                                                    </span>
                                                    <input type="text" class="form-control" name="card[value][q][]" value="<?php  echo $card['value']['q']['1'];?>" data-key='1' />
                                                    <span class="input-group-addon">元 / 季</span>
                                                </div>
                                            </div>
                                            <div class="group-item" style="margin-top:10px;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name=""<?php  if($card['value']['m']['0']) { ?> checked<?php  } ?> value="1" onclick="showItem(this);">显示
                                                            <input type="hidden" name="card[value][m][]" VALUE="<?php echo $card['value']['m'][0]=='0'?0:1;?>" />
                                                        </label>
                                                    </span>
                                                    <input type="text" class="form-control" name="card[value][m][]" value="<?php  echo $card['value']['m']['1'];?>" data-key='2' />
                                                    <span class="input-group-addon">元 / 月</span>
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group" id="value_first">
										<label class="col-md-3 control-label">首次激活</label>
										<div class="col-md-9">
                                        	<label class="radio-inline">
												<input type="radio" value="1" name="card[is_first]"<?php  if($card['is_first']==1) { ?> checked<?php  } ?> />开启
											</label>
                                            <label class="radio-inline">
												<input type="radio" value="0" name="card[is_first]"<?php  if($card['is_first']=='' || $card['is_first']==0) { ?> checked<?php  } ?> />不开启
											</label>
                                            <div class="first-item"<?php  if($card['is_first']!=1) { ?> style="display:none"<?php  } ?>>
                                                <div class="group-item" style="margin-top:10px;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name=""<?php  if($card['value_first']['y']['0']) { ?> checked<?php  } ?> value="1" onclick="showItem(this);">显示
                                                                <input type="hidden" name="card[value_first][y][]" VALUE="<?php echo $card['value_first']['y'][0]=='0'?0:1;?>" />
                                                            </label>
                                                        </span>
                                                        <input type="text" class="form-control" name="card[value_first][y][]" value="<?php  echo $card['value_first']['y']['1'];?>" data-key='0' />
                                                        <span class="input-group-addon">元 / 年</span>                                              
                                                    </div>
                                                </div>
                                                <div class="group-item" style="margin-top:10px;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name=""<?php  if($card['value_first']['q']['0']) { ?> checked<?php  } ?> value="1" onclick="showItem(this);">显示
                                                                <input type="hidden" name="card[value_first][q][]" VALUE="<?php echo $card['value_first']['q'][0]=='0'?0:1;?>" />
                                                            </label>
                                                        </span>
                                                        <input type="text" class="form-control" name="card[value_first][q][]" value="<?php  echo $card['value_first']['q']['1'];?>" data-key='1' />
                                                        <span class="input-group-addon">元 / 季</span>
                                                    </div>
                                                </div>
                                                <div class="group-item" style="margin-top:10px;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name=""<?php  if($card['value_first']['m']['0']) { ?> checked<?php  } ?> value="1" onclick="showItem(this);">显示
                                                                <input type="hidden" name="card[value_first][m][]" VALUE="<?php echo $card['value_first']['m'][0]=='0'?0:1;?>" />
                                                            </label>
                                                        </span>
                                                        <input type="text" class="form-control" name="card[value_first][m][]" value="<?php  echo $card['value_first']['m']['1'];?>" data-key='2' />
                                                        <span class="input-group-addon">元 / 月</span>
                                                    </div>
                                                </div>
                                                <label class="radio-inline">
                                                    <input type="radio" value="1" name="card[is_first_num]"<?php  if($card['is_first_num']==1 || $card['is_first_num']=='') { ?> checked<?php  } ?> />允许累计
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="2" name="card[is_first_num]"<?php  if($card['is_first_num']==2) { ?> checked<?php  } ?> />不可累计
                                                </label>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-md-3 control-label">年卡封面</label>
										<div class="col-md-9">
											<script type="text/javascript">
												function showImageDialog(elm, opts, options) {
													require(["util"], function(util){
														var btn = $(elm);
														var ipt = btn.parent().prev();
														var val = ipt.val();
														var img = ipt.parent().next().children();
														options = {'global':false,'class_extra':'','direct':true,'multiple':false,'fileSizeLimit':5120000};
														util.image(val, function(url){
															if(url.url){
																if(img.length > 0){
																	img.get(0).src = url.url;
																}
																ipt.val(url.attachment);
																ipt.attr("filename",url.filename);
																ipt.attr("url",url.url);
																$('.js-card-bg').attr('src',url.url);
															}
															if(url.media_id){
																if(img.length > 0){
																	img.get(0).src = "";
																}
																ipt.val(url.media_id);
															}
														}, options);
													});
												}
												function deleteImage(elm){
													$(elm).prev().attr("src", "./resource/images/nopic.jpg");
													$(elm).parent().prev().find("input").val("");
													$('.js-card-bg').attr('src','../addons/wnfx_activity/web/resource/images/card/1.png');
												}
											</script>
                                            <div class="input-group ">
                                                <input type="text" name="card[thumb]" value="<?php  echo $card['thumb'];?>" class="form-control" autocomplete="off">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>
                                                </span>
                                            </div>
                                            <div class="input-group " style="margin-top:.5em;">
                                                <img src="<?php  if($card['thumb']) { ?><?php  echo tomedia($card['thumb'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="this.src='<?php  if($card['thumb']) { ?><?php  echo tomedia($card['thumb'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>'; this.title='图片未找到.'" class="img-responsive img-thumbnail"  width="150" />
                                                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
                                            </div>
                                            <span class="help-block">图片建议大小：530×330像素（不上传系统默认）</span>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading b">规则说明</div>
								<div class="panel-body">
									<div class="form-group hidden">
										<label class="col-md-3 control-label"><span class="red">*</span>每人限购</label>
										<div class="col-md-8">
											<select name="quota" class="form-control">
												<option value="" selected="">不限张</option>
												<option value="1">1张</option>
												<option value="2">2张</option>
												<option value="3">3张</option>
												<option value="4">4张</option>
												<option value="5">5张</option>
												<option value="10">10张</option>
											</select>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-md-3 control-label">赠送积分</label>
										<div class="col-md-9">
                                        	<div class="input-group">
                                                <input type="text" class="form-control" name="card[credit]" value="<?php  echo $card['credit'];?>" style="display:inline-block;">
                                                <span class="input-group-addon">分</span>
                                            </div>
										</div>
									</div>
									<div class="form-group hidden">
										<label class="col-md-3 control-label">到期提醒</label>
										<div class="col-md-9">
											<label class="checkbox-inline">
												<input type="checkbox" value="2" name="expire_notice">到期前4天提醒一次
											</label>
										</div>
									</div>
									<div class="form-group hidden">
										<label class="col-md-3 control-label"><span class="red">*</span>可使用商品</label>
										<div class="col-md-9">
											<label class="radio-inline">
												<input type="radio" value="2" name="range_type" checked="checked">全店通用
											</label>
											<label class="radio-inline">
												<input type="radio" value="1" name="range_type">指定商品
											</label>
											<br>
											<label class="checkbox-inline">
												<input type="checkbox" value="2" name="is_forbid_preference">仅原价购买商品时可用
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">专属特权</label>
										<div class="col-md-9">
                                            <?php  echo tpl_ueditor('card[description]', $card['description'], array('height'=>100));?>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-md-3 control-label">使用须知</label>
										<div class="col-md-9">
                                            <?php  echo tpl_ueditor('card[detail]', $card['detail'], array('height'=>100));?>
										</div>
									</div>
	
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9 col-lg-10" style="position: absolute;bottom: 0;left: 0;width: 100%;">
					<div class="text-center alert alert-warning">
						<input name="submit" type="submit" class="btn btn-primary min-width" value="保存">
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
                        <input type="hidden" name="cardid" value="<?php  echo $card['id'];?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
$(function() {
	var $name = $('input[name="card[name]"]'),
	re = /^\d+$/,
	$value = $('#value').find('input.form-control'),
	$value_first = $('#value_first').find('input.form-control'),	
	$card_thumb = $('input[name="card[thumb]"]'),
	$description = $('textarea[name="card[description]"]'),
	$detail = $('textarea[name="card[detail]"]');
	
	$('form').submit(function() {
		if ($('#value').find('.has-error').length > 0 || ($('#value_first').find('.has-error').length > 0 && $('input[name="card[is_first]"]').get(0).checked)) {
			console.log('错误has-error');
			return false;
		};
		if ($name.val() == '') {
			util.tips('年卡名称不能为空', 2000);
			$name.focus().parent().append('<span class="text-danger">年卡名称必须在 1-10 个字内</span>').addClass('has-error');
			return false;
		};
		var checksubmit = false;
		$value.each(function(i, e){
			var info = '<span class="text-danger">当前价必须大于等于 0.01 元</span>';
			$(this).parent().parent().removeClass('has-error').find('.text-danger').remove();
			if (isNaN(parseFloat($(this).val())) || parseFloat($(this).val()) < 0.01){
				$(this).parent().parent().addClass('has-error').append(info);
				checksubmit = false;
				return false;
			}else{
				checksubmit = true;
			};
		});
		return checksubmit;
	});

	$name.blur(function() {
		$(this).parent().removeClass('has-error').find('.text-danger').remove();
		if ($(this).val() == '') {
			$(this).parent().append('<span class="text-danger">年卡名称必须在 1-10 个字内</span>').addClass('has-error');
		} else {
			$('.js-name').text($(this).val());
		};
	});
	$value.blur(function() {
		var value = $(this).val();
		$(this).parent().parent().removeClass('has-error').find('.text-danger').remove();
		//console.log($('input[name="card[is_first]"]').get(0).checked);
		if ($('input[name="card[is_first]"]').get(0).checked && $value_first.eq($(this).data('key')).val() && parseFloat(value) <= parseFloat($value_first.eq($(this).data('key')).val())) {
			$(this).parent().parent().addClass('has-error').append('<div class="text-danger">当前价必须大于激活价</div>');
			return false;
		};
		if (isNaN(parseFloat(value)) || parseFloat(value) < 0.01){
			$('.js-value').text('0.00');
			$(this).parent().parent().addClass('has-error').append('<div class="text-danger">当前价必须大于等于 0.01 元</div>');
			return false;
		} else {
			$(this).parent().parent().removeClass('has-error').find('.text-danger').remove();
		};
		$('.js-value').text(value);
	});
	$value_first.blur(function() {
		$(this).parent().parent().removeClass('has-error').find('.text-danger').remove();
		var value = $(this).val();
		if ($value.eq($(this).data('key')).val() && parseFloat(value) >= parseFloat($value.eq($(this).data('key')).val())) {
			$(this).parent().addClass('has-error').after('<div class="text-danger">当前激活价必须小于对应原价</div>');
			return false;
		};
		
		if (isNaN(parseFloat(value)) || parseFloat(value) < 0.01){
			$(this).parent().parent().addClass('has-error').append('<div class="text-danger">当前价必须大于等于 0.01 元</div>');
			return false;
		} else {
			$(this).parent().removeClass('has-error').find('.text-danger').remove();
		};
		$('.js-value-first').text(value);
		$('.js-first').show();
	});
	$('#reset').click(function(){
		$('#goodsid').val('');
		$('#saler').val('');
	});
	$("#value_first").find('input[name="card[is_first]"]').click(function(){
		var isPermanentValue = $(this).val();
		if($(this).val()==1){
			$(".first-item").show();
		}else{
			$(".first-item").hide();
		}
	})
});
function showItem(obj){
	var show = $(obj).get(0).checked?"1":"0";
	$(obj).parent('label').find('input').next().val(show);
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>