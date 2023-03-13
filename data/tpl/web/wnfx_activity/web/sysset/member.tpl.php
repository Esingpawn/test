<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline {
    padding-top: 0;
    line-height: 0.95;
}
.multi-img-details .multi-item{height:auto}
</style>
<div class="page-header">当前位置：<span class="text-primary">会员设置</span></div>
<div class="page-content">
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" style="" novalidate="novalidate">
    <div class="form-group">
        <label class="col-lg control-label"><?php  echo m('member')->getCreditName('credit1')?></label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group">
                <span class="input-group-addon">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="switchCheck" value="1"<?php  if($settings['creditstatus']==1) { ?> checked="checked"<?php  } ?>>开启
                        <input name="module[creditstatus]" value="<?php  echo $settings['creditstatus'];?>" type="hidden"/>
                    </label>
                </span>
                <input type="text" name="module[credit1link]" class="form-control" value="<?php  echo $settings['credit1link'];?>" placeholder="自定义<?php  echo m('member')->getCreditName('credit1')?>跳转网址，不填写系统默认.">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">余额</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group">
                <span class="input-group-addon">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="switchCheck" value="1"<?php  if($settings['credit2']==1) { ?> checked="checked"<?php  } ?>>开启
                        <input name="module[credit2]" value="<?php  echo $settings['credit2'];?>" type="hidden"/>
                    </label>
                </span>
                <input type="text" name="module[credit2link]" class="form-control" value="<?php  echo $settings['credit2link'];?>" placeholder="自定义余额跳转网址，不填写系统默认.">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">权限</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[allowswitch]" value="1" <?php  if($settings['allowswitch']==1) { ?>checked="checked"<?php  } ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[allowswitch]" value="0" <?php  if($settings['allowswitch']==0 || $settings['allowswitch']=='') { ?>checked="checked"<?php  } ?>> 关闭【允许查看他人报名信息】
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <input type="submit" value="提交" class="btn btn-primary">
        </div>
    </div>
</form>
</div>
<script>
$(function () {
	$(":checkbox[name='switchCheck']").click(function(){
		var obj = $(this);
		if (obj.get(0).checked){
			obj.next().val(obj.val());
		}else{
			obj.next().val('');
		}
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>