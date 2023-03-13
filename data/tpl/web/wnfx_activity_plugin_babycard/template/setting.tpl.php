<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=20170826" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/util.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>web/resource/js/util.min.js?v=20170912"></script>
<style>
.multi-img-details .multi-item{height:auto;}
#member.multi-img-details .multi-item{text-align:center; max-width:100px;}
#member.multi-img-details .multi-item img{ max-width:90px; max-height:90px;}
#member.multi-img-details .multi-item .title{ overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
</style>
<form class="form-horizontal form" action="" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">系统设置</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">年卡开启</label>
                <div class="col-xs-12 col-sm-8">
                    <label class="radio radio-inline">
                        <input type="radio" name="module[card_enable]" value="1" <?php  if($settings['card_enable']) { ?>checked="checked"<?php  } ?>> 开启
                    </label>
                    <label class="radio radio-inline">
                        <input type="radio" name="module[card_enable]" value="0" <?php  if(!$settings['card_enable']) { ?>checked="checked"<?php  } ?>> 关闭
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">首页显示</label>
                <div class="col-xs-12 col-sm-8">
                    <label class="radio radio-inline">
                        <input type="radio" name="module[index_enable]" value="1" <?php  if($settings['index_enable']) { ?>checked="checked"<?php  } ?>> 开启
                    </label>
                    <label class="radio radio-inline">
                        <input type="radio" name="module[index_enable]" value="0" <?php  if(!$settings['index_enable']) { ?>checked="checked"<?php  } ?>> 关闭
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">亲友绑定</label>
                <div class="col-xs-12 col-sm-8">
                    <label class="radio radio-inline">
                        <input type="radio" name="module[friend_enable]" value="1" <?php  if($settings['friend_enable']) { ?>checked="checked"<?php  } ?>> 开启
                    </label>
                    <label class="radio radio-inline">
                        <input type="radio" name="module[friend_enable]" value="0" <?php  if(!$settings['friend_enable']) { ?>checked="checked"<?php  } ?>> 关闭
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">双倍积分</label>
                <div class="col-xs-12 col-sm-8">
                    <label class="radio radio-inline">
                        <input type="radio" name="module[credit_double]" value="1" <?php  if($settings['credit_double']) { ?>checked="checked"<?php  } ?>> 开启
                    </label>
                    <label class="radio radio-inline">
                        <input type="radio" name="module[credit_double]" value="0" <?php  if(!$settings['credit_double']) { ?>checked="checked"<?php  } ?>> 关闭
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">专享折扣</label>
                <div class="col-xs-12 col-sm-4">
                	<div class="input-group">
						<input type="text" name="module[percent]" class="form-control" value="<?php  echo $settings['percent'];?>" placeholder="所有活动默认享受最低折扣值">
                        <span class="input-group-addon">折</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="form-group col-sm-12">
        <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
        <input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
    </div>
</form>
<script type="text/javascript">
require(['jquery', 'util'], function($, util){
	$('.js-copy').click(function(){
		util.clip(".js-copy", $(this).attr('data-url'));
	});
});
$('.js-clip').each(function(){
	util.clip(this, $(this).data('url'));
});
//系统0.8显示switch
require(['bootstrap.switch'],function($){
	$('.js-flag:checkbox').bootstrapSwitch({onText: '开启', offText: '关闭'});
	$('.js-flag:checkbox').on('switchChange.bootstrapSwitch', function(event, state) {
		var id = $(this).data('id');
		var ban = state ? 1 : 0;
	});
});
//系统1.0+显示switch
$('.switch').click(function(e){
	var id = $(this).data('id');
	var state = $(this).hasClass("switchOff");
	var show = state ? 1 : 0;	
	$(this).toggleClass("switchOff");
	$(this).toggleClass("switchOn");

});
//管理员通知配制
function search_members() {
	if( $.trim($('#search-kwd').val())==''){
		Tip.focus('#search-kwd','请输入关键词');
		return;
	}
	$("#module-menus").html("正在搜索....")
	$.get("<?php  echo web_url('member/member/selectmember')?>", {
		keyword: $.trim($('#search-kwd').val())
	}, function(dat){
		$('#module-menus').html(dat);
	});
}
function select_member(o) {
	var hh = '', istrue = true, modalobj = $('#modal-module-menus');
	$("input[name='module[openids][]']").each(function(){
		if ($(this).val()==o.openid){
			alert('管理员不能重复');
			istrue = false;
			return false;
		}
	});
	if (!istrue) return false;
	hh += '<div class="multi-item"><img src="'+o.avatar+'" onerror="this.src=\'./resource/images/nopic.jpg\'; this.title=\'图片未找到.\'" class="img-responsive img-thumbnail">'
	+'	<input type="hidden" name="module[openids][]" value="'+o.openid+'">'
	+'	<em class="close" title="删除管理员" onclick="deleteMultiImage(this)">×</em>'
	+'	<p class="help-block title">'+o.nickname+'</p>'
	+'</div>';
	$("#member").append(hh);
	modalobj.modal('hide');
}
function reset_admin(){
	$("#member").html('');
}
function deleteMultiImage(obj){
	$(obj).parents(".multi-item").remove();
}
$(function () {
	window.optionchanged = false;
	$('#myTab a').click(function (e) {
		e.preventDefault();//阻止a链接的跳转行为
		$(this).tab('show');//显示当前选中的链接及关联的content
	})
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>