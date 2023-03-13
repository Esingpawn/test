<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.mui-bar a{color: #ff9900;}
.mui-btn-primary{background-color:#059aff!important;border: 1px solid #059aff;}
.mui-textarea{ height:auto!important; width:100%;background-color: #FFF!important;}
.area {margin: 20px auto 0px auto;}
.mui-input-group:first-child {margin-top:10px;}
.mui-rmb i{ font-style:normal; }
.mui-input-row #get_code{ padding:8px; width:auto; border-radius: 0;line-height: 1.7;}
.mui-help-top{ margin-bottom:10px;margin-top:0;}
.mui-help-top .mui-table-view-cell{padding: 9px 12px!important}
.mui-help-top .mui-icon-help:before{color:#059aff;font-weight:700;font-size:18px;top:45%;}
.mui-help-top .mui-small{ font-size:85%!important;font-weight:700}
.mui-help-top .mui-help-info:before{position:absolute;content: ""; height:99%!important;left:0;top:0;width:3px; background:#059aff;}
.mui-input-row>input{font-weight:700}
.mui-input-row label,.mui-input-row .mui-label{color:#6e6e6e}
.mui-input-row label~input{text-align:right;font-weight:normal}
.mui-input-row .mui-input-inline{position:relative; width:27%;line-height:1.3;color:#6e6e6e;font-size: 0.55rem;text-align:center}
.mui-input-row .mui-input-inline:last-child input{text-align:right;}
.mui-input-row .mui-input-inline input{padding: 0.5rem 0}
[data-type=date] .mui-dtpicker-title h5, [data-type=date] .mui-picker{width: 20%!important;}
.mui-dtpicker-title h5,.mui-picker{ display:inline-block!important;}
.mui-table-view-cell label {font-family:"Microsoft Yahei","微软雅黑",Arial,"Hiragino Sans GB","宋体","Helvetica Neue",Helvetica,sans-serif;white-space:nowrap;text-overflow:ellipsis;}
.mui-table-view .mui-table-view-cell>a p{color:#6e6e6e}
footer .mui-input-row{ height:49px!important; border:none;}
footer .mui-input-row label{line-height:2; padding:11px 0; text-align:right; float:right;}
footer .mui-input-row span{line-height:2; padding:11px 10px 11px 0;}
footer .mui-input-row span.mui-rmb{line-height:1.8!important;}
footer .mui-input-row .mui-btn{top: 0; font-size:16px;line-height:1.6!important;border-radius:0; width:35%}
footer.mui-bar{box-shadow:0 -2px 8px rgba(0,0,0,.1);}
.map-container{position: fixed;top: 0; left:0;bottom: 0; right:0;z-index: 11;height:auto;overflow:hidden;display:none;background:#FFF;}
.map-container.map-active{display:block}
.map-container iframe{width:100%;height:100%; padding-bottom:60px;border: none;}
</style>
<form class="formmain" action="" method="post" onSubmit="return check(this);return false;" style="position: initial">
<footer class="mui-bar mui-bar-tab">
    <div class="mui-content-padded" style="margin-top:0px;">
        <input type="submit" name="submit" class="mui-btn mui-btn-yellow mui-btn-block js-submit" value="发布"/>
    </div>
    <input type="hidden" name="op" value="post"/>
    <input type="hidden" name="activityid" value="<?php  echo $id;?>" />
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
</footer>
<div class="mui-content" style="z-index:1">
	<div class="mui-input-group">
        <div class="mui-input-row">
            <input type="text" name="activity[title]" id="name" placeholder="标题名称 (必填)" value="<?php  echo $activity['title'];?>">
        </div>
        <div class="mui-input-row">
            <input type="text" name="activity[pagetitle]" id="name" placeholder="副标题显示在顶部标题栏 (选填)" value="<?php  echo $activity['pagetitle'];?>">
        </div>
        <div class="mui-input-row">
        	<label><?php  echo $_W['_config']['buytitle'];?>时间</label>
            <div class="mui-input-inline mui-pull-left">
			<input class="mui-calendar-picker1" type="text" placeholder="开始时间" value="<?php echo empty($activity['joinstime'])?'':date('m-d H:i',strtotime($activity['joinstime']))?>" readonly>
            <input type="hidden" value="<?php  echo $activity['joinstime'];?>" name="activity[joinstime]">
            <script type="text/javascript">
				$(document).on("tap", ".mui-calendar-picker1", function(){
					var $this = $(this);
					util.datepicker({type: "date", beginYear: 2000, endYear: 2050}, function(rs){
						$this.val(rs.m.value + '-' + rs.d.value + ' ' + rs.h.value + ':' + rs.i.value)
						.next().val(rs.value + ' ' + rs.h.value + ':' + rs.i.value)
					});
				});
			</script>
            </div>
            <div class="mui-input-inline mui-pull-left" style="width:5%;padding:0.5rem 0;">~</div>
            <div class="mui-input-inline mui-pull-left">
			<input class="mui-calendar-picker2" type="text" placeholder="结束时间" value="<?php echo empty($activity['joinetime'])?'':date('m-d H:i',strtotime($activity['joinetime']))?>" readonly>
            <input type="hidden" value="<?php  echo $activity['joinetime'];?>" name="activity[joinetime]">
            <script type="text/javascript">
				$(document).on("tap", ".mui-calendar-picker2", function(){
					var $this = $(this);
					util.datepicker({type: "date", beginYear: 2000, endYear: 2050}, function(rs){
						$this.val(rs.m.value + '-' + rs.d.value + ' ' + rs.h.value + ':' + rs.i.value)
						.next().val(rs.value + ' ' + rs.h.value + ':' + rs.i.value)
					});
				});
			</script>
            </div>
        </div>
        <div class="mui-input-row">
        	<label>活动时间</label>
            <div class="mui-input-inline mui-pull-left">
			<input class="mui-calendar-picker3" type="text" placeholder="开始时间" value="<?php echo empty($activity['starttime'])?'':date('m-d H:i',strtotime($activity['starttime']))?>" readonly>
            <input type="hidden" value="<?php  echo $activity['starttime'];?>" name="activity[starttime]">
            <script type="text/javascript">
				$(document).on("tap", ".mui-calendar-picker3", function(){
					var $this = $(this);
					util.datepicker({type: "date", beginYear: 2000, endYear: 2050}, function(rs){
						$this.val(rs.m.value + '-' + rs.d.value + ' ' + rs.h.value + ':' + rs.i.value)
						.next().val(rs.value + ' ' + rs.h.value + ':' + rs.i.value)
					});
				});
			</script>
            </div>
            <div class="mui-input-inline mui-pull-left" style="width:5%;padding:0.5rem 0;">~</div>
            <div class="mui-input-inline mui-pull-left">
			<input class="mui-calendar-picker4" type="text" placeholder="结束时间" value="<?php echo empty($activity['endtime'])?'':date('m-d H:i',strtotime($activity['endtime']))?>" readonly>
            <input type="hidden" value="<?php  echo $activity['endtime'];?>" name="activity[endtime]">
            <script type="text/javascript">
				$(document).on("tap", ".mui-calendar-picker4", function(){
					var $this = $(this);
					util.datepicker({type: "date", beginYear: 2000, endYear: 2050}, function(rs){
						$this.val(rs.m.value + '-' + rs.d.value + ' ' + rs.h.value + ':' + rs.i.value)
						.next().val(rs.value + ' ' + rs.h.value + ':' + rs.i.value)
					});
				});
			</script>
            </div>
        </div>
        <ul class="mui-table-view mui-afterbefore-no" style="margin-top:0;">
        	<li class="mui-table-view-cell mui-media js-popover" data-popover='act_spec'>
                <a class="mui-navigate-right js-price">
                    <p><?php  echo $_W['_config']['buytitle'];?>费用</p>
                    <span class="mui-badge mui-badge-inverted<?php  if($id) { ?> mui-rmb<?php  } ?>">
                    <?php  if($id) { ?>
                        <?php  if($activity['aprice'] > 0 || $activity['maxprice']['aprice']>0) { ?>
                        <?php echo $activity['maxprice']['aprice'] > $activity['minprice']['aprice'] ? $activity['minprice']['aprice'].' ~ '.$activity['maxprice']['aprice']:$activity['aprice']?>
                        <?php  } else { ?>0.00<?php  } ?>
                    <?php  } ?>
                    </span>
                </a>
            </li>
        </ul>
        <p></p>
        <div class="mui-textarea">
           <textarea id="textarea" class="mui-input-clear" name="activity[intro]" placeholder="在此输入简要概述(建议30个字符左右)"><?php  echo $activity['intro'];?></textarea>
        </div>
        <p></p>
        <link rel="stylesheet" type="text/css" href="<?php echo FX_URL;?>app/resource/components/editormobile/dist/css/wangEditor-mobile.css?v=20170716">
        <style type="text/css">
        .noscroll,.noscroll body,.noscroll .mui-content {overflow: hidden!important;}
		.noscroll nav {display:none!important}
		.wangEditor-mobile-txt{min-height:120px;padding:0 0.65rem;}
		.wangEditor-mobile-txt img{margin:0!important;max-width: 100%;height: auto!important;vertical-align: bottom;font-size: 0;}
		.wangEditor-mobile-menu-container{top:0!important;left: 0!important;right: 0;border-radius:0px!important;max-width:100%;opacity: 0.9!important; display:block; position:fixed;}
		.wangEditor-mobile-menu-container .tip{ display:none;}
		.wangEditor-mobile-modal{ max-height:180px; overflow:auto; z-index:999;}
		.command-color{width:25px;height:25px;display:inline-block;border-radius:2px;margin: 4px;line-height: 26px;text-align: center;}
		.placeholder:before{content:attr(placeholder);font-size:0.55rem;position:absolute;z-index:2;top:3px;color:#a9a9a9;}
		.placeholder:focus{content:none;}
		.mui-editor{padding:10px 0 10px 0; background-color:#fff;}
		.mui-editor .container{background-color:#FFF;height:5rem;overflow:auto;}
		.mui-editor .mui-help-top{ display:none;}
		.mui-editor .mui-bar{display:none;height:auto!important;}
		.mui-editor footer{display:none; text-align:center}
		.mui-editor .mui-btn{ border:none;font-weight:700;color:#059aff}
		.text-editor.container{position: fixed;top: 0; left:0;bottom: 0; right:0;z-index: 11;height:auto;max-height:100%;overflow: hidden;}
		.text-editor .wangEditor-mobile-txt{-webkit-overflow-scrolling:touch;position:absolute;top:48px;bottom:0;overflow:auto;padding:0 10px;}
		.text-editor .mui-help-top{ display: block;}
		.text-editor footer{ display:inline-table;}
		.text-editor .mui-bar{display:block;padding-bottom:1px;}
		.none-editor .wangEditor-mobile-txt p{ height:100%;}
		</style>
        <div class="mui-editor">
            <div class="container">
                <div class="mui-bar mui-bar-tab">
                    <div class="mui-content-padded" style="margin-top:0px;text-align:right">
                        <span class="mui-btn end-editor">完成</span>
                    </div>
                </div>
                <ul class="mui-table-view mui-help-top">
                    <li class="mui-table-view-cell mui-help-info">
                        <span class="mui-navigate-left mui-icon-help mui-text-primary mui-small"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 说明：点击当前行，可以编辑样式.</span>
                    </li>
                </ul>
                <textarea id="textarea1" style="width:100%;height:100%;" name="activity[detail]"><?php  echo $activity['detail'];?></textarea>
            </div>
        </div>
        <p></p>
        <ul class="mui-table-view mui-afterbefore-no" style="margin-top:0;">
        	<li class="mui-table-view-cell mui-media js-popover" data-popover='act_setting'>
                <a class="mui-navigate-right js-setting">
                    <p><?php  echo $_W['_config']['buytitle'];?>设置</p>
                    <span class="mui-badge mui-badge-inverted"></span>
                </a>
            </li>
            <?php  if($_W['_config']['cateswitch']) { ?>
            <li class="mui-table-view-cell mui-media">
                <a class="mui-navigate-right js-category-options">
                    <p>活动类型</p>
                    <span class="mui-badge mui-badge-inverted js-category">
                    <?php  if($id) { ?>
                    <?php  if(is_array($category['0'])) { foreach($category['0'] as $v) { ?>
                    	<?php  if($v['value']==$activity['parentid']) { ?>
                        	<?php  echo $v['text'];?> 
                            <?php  if(is_array($v['children'])) { foreach($v['children'] as $child) { ?>
                            	<?php  if($child['value']==$activity['childid']) { ?>,<?php  echo $child['text'];?><?php  break;?><?php  } ?>
                            <?php  } } ?>
                            <?php  break;?>
                        <?php  } ?>
                    <?php  } } ?>
                    <?php  } else { ?>
                    	(必填)
                    <?php  } ?>
                    </span>
                </a>
                <input type="hidden" value="<?php  echo $activity['parentid'];?>" name="activity[parentid]">
            	<input type="hidden" value="<?php  echo $activity['childid'];?>" name="activity[childid]">
                <script type="text/javascript">
					$(".js-category-options").on("tap", function(){
						var options = {data: <?php  echo json_encode($category['0'])?>,layer:2};
						var $this = $(this);
						util.poppicker(options, function(items){
							var checkText; 
							checkText = items[1].value!=undefined ? items[0].text+", "+items[1].text : items[0].text;
							$this.find('.js-category').text(checkText);
							$this.next().val(items[0].value).next().val(items[1].value!=undefined ? items[1].value:0);
						});
					});
				</script>
            </li>
            <?php  } ?>
            <li class="mui-table-view-cell mui-media js-popover" data-popover='map_selector'>
                <a class="mui-navigate-right js-address">
                    <div class="mui-media-body">
                        <p>设置场地</p>
                    </div>
                    <span class="mui-badge mui-badge-inverted mui-ellipsis-2 address" style="max-width:60%;line-height:1.2;text-align:right;">
                    <?php  if($activity['hasonline']) { ?>线上活动<?php  } else { ?><?php echo empty($activity['address'])?'(必填)':$activity['address']?><?php  } ?>
                    </span>
                    <input type="hidden" value="<?php  echo $activity['address'];?>" name="activity[address]" />
                    <input type="hidden" value="<?php  echo $activity['lat'];?>" name="activity[lat]" />
                    <input type="hidden" value="<?php  echo $activity['lng'];?>" name="activity[lng]" />
                    <input type="hidden" value="<?php  echo $activity['adinfo'];?>" name="activity[adinfo]" />
                    <input type="hidden" value="<?php echo $activity['hasonline']?1:0?>" name="activity[hasonline]" />
                </a>
            </li>
            <li style="display:none"></li>
        </ul>
        <div class="mui-input-row js-addname" style="<?php  if($activity['hasonline'] || $activity['hasonline']=='') { ?>display:none<?php  } ?>">
            <label>场地名称</label>
            <input type="text" name="activity[addname]" placeholder="例如XXX大厦 (必填)" value="<?php  echo $activity['addname'];?>">
        </div>
        <div class="mui-input-row">
            <label>咨询电话</label>
            <input type="number" name="activity[tel]" id="name" placeholder="咨询电话 (必填)" value="<?php  echo $activity['tel'];?>">
        </div>
        <div class="mui-input-row mui-after-no">
            <label>是否上线</label>
            <div class="mui-switch mui-switch-mini<?php echo $activity['show']==1?' mui-active':''?>">
                <div class="mui-switch-handle"></div>
                <input type="hidden" name="activity[show]" value="<?php echo $activity['show']==1?1:0?>">
            </div>
        </div>
        <p></p>
        <div class="mui-input-cell">
            <div class="mui-table-view-chevron">
                <div class="mui-image-uploader">
                    <div class="mui-image-preview js-image-preview">
                    	<div class="file-item js-thumb" data-id="<?php  echo attachment_id($activity['thumb'])?>"<?php echo empty($activity['thumb'])?' style="display:none;"':''?>>
                        <img src="<?php echo empty($activity['thumb'])?FX_URL.'app/resource/images/nopic.jpg':tomedia($activity['thumb'])?>" data-preview-src="<?php  echo tomedia($activity['thumb'])?>" data-preview-group="__IMG_UPLOAD_pic"/>
                        <input type="hidden" value="<?php  echo $activity['thumb'];?>" id="pic" name="activity[thumb]" />
                        <div class="file-panel"><span>×</span></div>
                    	</div>
                    </div>
                    <a href="javascript:;" class="mui-upload-btn js-image-pic mui-inline"></a>
                    <label class="mui-block"><span class="mui-badge mui-badge-inverted" style="padding:0;">请上传清晰的图片,建议图片尺寸640*480 <font class="mui-text-error"> *</font></span></label>
                </div>
                <script>
                    var obj=".js-image-pic";
                    util.img(obj, function(url){
                        $(obj).parent().find('.js-image-preview').find('#pic').val(url.attachment);
                        $(obj).parent().find('.js-image-preview').find('img').attr("src",url.url);                       
                        $(obj).parent().find('.js-image-preview').find('img').attr("data-preview-src",url.url);
						$(obj).parent().find('.js-image-preview').find('.js-thumb').attr("data-id",url.id);
						$(obj).parent().find('.js-image-preview').find('.js-thumb').show();
                    }, {
                        crop : true,
                        multiple : false,
                        preview : '__IMG_UPLOAD_pic',
						aspectRatio:4/3,
						resizable:1
                    });
					setTimeout(function(){
                       $('.js-image-pic').append('<div class="btn-intro" style="position:absolute;color:#d7d7d7;top:54px;line-height:1.2;left:0;right:0;">封面图<br>(最多1张)</div>');
                    },1500);
                </script>
            </div>
        </div>
        <div class="mui-input-cell mui-after-no">
            <div class="mui-table-view-chevron">
                <div class="mui-image-uploader">
                    <div class="mui-image-preview js-image-nopic mui-pull-left" style="display:none">
                        <img src="<?php echo FX_URL;?>app/resource/images/nopic.jpg"/>
                    </div>
                    <div class="mui-image-preview js-image-preview">
                    	<?php  if(!empty($activity['atlas'])) { ?>
                        	<?php  if(is_array($activity['atlas'])) { foreach($activity['atlas'] as $url) { ?>
                            <div class="file-item js-thumb-item" data-id="<?php  echo attachment_id($url)?>">
                        	<input type="hidden" value="<?php  echo $url;?>" name="activity[atlas][]" />
                            <img src="<?php  echo tomedia($url)?>" data-preview-src="<?php  echo tomedia($url)?>" data-preview-group="__IMG_UPLOAD_image" />
                            <div class="file-panel"><span>×</span></div>
                            </div>
                            <?php  } } ?>
                        <?php  } ?>
                    </div>
                    <a href="javascript:;" class="mui-upload-btn js-image-atlas mui-inline"></a>
                    <label class="mui-block"><span class="mui-badge mui-badge-inverted" style="padding:0;">请上传清晰的图片,建议图片尺寸640*480 <font class="mui-text-error"> *</font></span></label>
                </div>
                <script>
                    var objs=".js-image-atlas";
                    util.img(objs, function(url){
                        $(objs).parent().find('.js-image-preview').append('<div class="file-item js-thumb-item" data-id="'+url.id+'"><input type="hidden" value="'+url.attachment+'" name="activity[atlas][]" /><img src="'+url.url+'" data-preview-src="'+url.url+'" data-preview-group="__IMG_UPLOAD_image"/><div class="file-panel"><span>×</span></div></div>');
                        $(".js-image-nopic").hide();
                    }, {
                        crop : true,
                        multiple : false,
                        preview : '__IMG_UPLOAD_image',
						aspectRatio:4/3,
						resizable:1
                    });
					setTimeout(function(){
                       $('.js-image-atlas').append('<div class="btn-intro" style="position:absolute;color:#d7d7d7;top:54px;line-height:1.2;left:0;right:0;">活动图集<br>(最多8张)</div>')
                    },1500);
                </script>
                <p></p>
            </div>
        </div>
        <p>&nbsp;</p>
        <?php  if($_W['_config']['agreement']['1']) { ?>
        <div class="mui-content-padded">
            <div class="mui-checkbox mui-agreement js-popover" data-popover="agreement">
                <input name="agreement" value="1" type="checkbox"><label>已阅读并同意《<a>活动发布协议</a>》</label>
            </div>
        </div>
        <p>&nbsp;</p>
        <?php  } ?>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('member/setting', TEMPLATE_INCLUDEPATH)) : (include fx_template('member/setting', TEMPLATE_INCLUDEPATH));?>
</form>
<script type="text/javascript" src="<?php echo FX_URL;?>app/resource/components/editormobile/dist/js/lib/zepto.js"></script>
<script type="text/javascript" src="<?php echo FX_URL;?>app/resource/components/editormobile/dist/js/lib/zepto.touch.js"></script>
<script type="text/javascript" src="<?php echo FX_URL;?>app/resource/components/editormobile/dist/js/wangEditor-mobile.js?v=202106091124"></script>
<script type="text/javascript">
$(function () {
	$('input[type=text]').each(function(key){
		if ($(this).attr("readonly")) $(this).attr('onfocus','this.blur()');
	});
	var wHeight = window.innerHeight;//获取初始可视窗口高度
	// ___E 三个下划线
	var editor = new ___E('textarea1');
	editor.config.menus = ['head','bold','color','quote','center','list','img','happy'];
	editor.config.uploadImgUrl = "<?php  echo app_url('utility/file/upload')?>";
	editor.config.uploadTimeout = 20 * 10000;     // 设置为 20s
	editor.init();
	var text = $('#textarea1').text();
	if (text.length == 0){
		$('.container').addClass('none-editor');
	}
	$('.end-editor').on('click',function(e){
		$('.container').removeClass("text-editor");
		$('html').removeClass("noscroll");
		$('footer.mui-bar').show();
		history.back(-1);
	});
	$('.wangEditor-mobile-txt').on('tap',function(e){
		location.href = location.href + '#texteditor';
		$('.container').addClass("text-editor");
		$('.container').removeClass('none-editor');
		$('footer.mui-bar').hide();
		$('html').addClass("noscroll");
		if (util.ios()){
			var target = this;
			setTimeout(function(){
				target.scrollIntoViewIfNeeded(true);
				target.scrollIntoViewIfNeeded(false);
			},50);
			setTimeout(function(){$(".wangEditor-mobile-txt").height(wHeight/2-85)},200);	
			$(window).scroll(function(){
				$(window).scrollTop(false);
			});
		}
	});
	$('.wangEditor-mobile-txt').on('blur',function(e){
		var text = $('.wangEditor-mobile-txt').text();
		if (text.length > 0){
			$('.wangEditor-mobile-txt').removeClass('placeholder');
		}else{
			$('.container').addClass('none-editor');
		}
		if (util.ios()){
			$(".wangEditor-mobile-txt").height('auto');
			$(".wangEditor-mobile-txt")[0].offsetHeight;
			$(window).unbind("scroll");
		}
	});	
	if (!util.ios()){
		//激活编辑模式禁用window滚动
		window.addEventListener('resize', function(){//监测窗口大小的变化事件  
			var hh = window.innerHeight;//当前可视窗口高度 
			var viewTop = $(window).scrollTop();//可视窗口高度顶部距离网页顶部的距离
			if(wHeight > hh && $("html").hasClass("noscroll")){//可以作为虚拟键盘弹出事件
				//$(".content").animate({scrollTop:viewTop+100});    //调整可视页面的位置
				$(".wangEditor-mobile-txt").height(hh-110);
				$(window).scroll(function(){
					$(window).scrollTop(false);
				});
			}else{         //可以作为虚拟键盘关闭事件 
				$(".wangEditor-mobile-txt").height('auto');
				$(window).unbind( "scroll" );
				//$(".content").animate({scrollTop:viewTop-100});  
			}  
			wHeight = hh;
		});
	}
	//开关
	$('.mui-switch').on('tap',function(e){
		if ($(this).hasClass("mui-active")){
			$(this).find('input').val(1);
		}else{
			$(this).find('input').val(0);
		}
		//console.log("你启动了开关");
	});	
});
//表单验证
var checksubmit = false;
function check(form) {
	if (!form['activity[title]'].value) {
		util.alert('请输入活动名称', ' ', function() {
			$("input[name='activity[title]']").focus();
		});
		return false;
	}
	if (!form['activity[joinstime]'].value) {
		util.alert('请输入<?php  echo $_W['_config']['buytitle'];?>开始时间', ' ', function() {
			$(".mui-calendar-picker1").trigger('tap');
		});
		return false;
	}
	if (!form['activity[joinetime]'].value) {
		util.alert('请输入<?php  echo $_W['_config']['buytitle'];?>结束时间', ' ', function() {
			$(".mui-calendar-picker2").trigger('tap');
		});
		return false;
	}
	if (!form['activity[starttime]'].value) {
		util.alert('请输入活动开始时间', ' ', function() {
			$(".mui-calendar-picker3").trigger('tap');
		});
		return false;
	}
	if (!form['activity[endtime]'].value) {
		util.alert('请输入活动结束时间', ' ', function() {
			$(".mui-calendar-picker4").trigger('tap');
		});
		return false;
	}
	if (!form['activity[intro]'].value) {
		util.alert('简要概述不能为空', ' ', function() {
			$("textarea[name='activity[intro]']").focus();
		});
		return false;
	}
	if (!form['activity[detail]'].value) {
		util.alert('图文详情不能为空', ' ', function() {
			$(".wangEditor-mobile-txt").trigger('tap');
		});
		return false;
	}
	<?php  if($_W['_config']['cateswitch']) { ?>
	if (form['activity[parentid]'].value=='') {
		util.alert('请设置活动类型', ' ', function() {
			$(".js-category-options").trigger('tap');
		});
		return false;
	}
	<?php  } ?>
	if (form['activity[hasonline]'].value=='0' && !form['activity[address]'].value) {
		util.alert('请设置活动场地', ' ', function() {
			$(".js-address").parent().trigger('tap');
		});
		return false;
	}	
	if (form['activity[hasonline]'].value=='0' && !form['activity[addname]'].value) {
		util.alert('请输入场地名称', ' ', function() {
			$("input[name='activity[addname]']").focus();
		});
		return false;
	}
	if (!form['activity[tel]'].value) {
		util.alert('请输入联系电话', ' ', function() {
			$("input[name='activity[tel]']").focus();
		});
		return false;
	}
	if (!form['activity[thumb]'].value) {
		util.alert('请上传一张封面缩略图', ' ', function() {});
		return false;
	}
	if (typeof(form['activity[atlas][]'])=='undefined') {
		util.alert('请输上传活动图集', ' ', function() {});
		return false;
	}
	<?php  if($_W['_config']['agreement']['1']) { ?>
	if (!$("input[name='agreement']").is(':checked')) {
		util.alert('请阅读并同意活动发布协议', ' ', function() {
			$("input[name='agreement']").focus();
		});
		return false;
	}
	<?php  } ?>
	var id="<?php  echo $id;?>",proreview="<?php echo perm('goods.senior.ischeck')?1:0;?>";
	if (id!='' && !checksubmit && proreview=='0'){
		util.confirm('修改后将进入审核状态，是否确认？', ' ', function(e) {
			if (e.index == 1) {
				checksubmit = true;
				$('.js-submit').trigger('click');
			}
		});
	}else{
		checksubmit = true;
	}
	return checksubmit;
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>