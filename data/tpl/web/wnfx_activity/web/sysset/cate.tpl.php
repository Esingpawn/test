<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline {
    padding-top: 0;
    line-height: 0.95;
}
.multi-img-details .multi-item{height:auto}
</style>
<div class="page-header">当前位置：<span class="text-primary">分类设置</span></div>
<div class="page-content">
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" style="" novalidate="novalidate">
    <div class="form-group">
        <label class="col-lg control-label">开启分类</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[cateswitch]" value="1" <?php  if($settings['cateswitch']) { ?>checked="checked"<?php  } ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[cateswitch]" value="0" <?php  if(!$settings['cateswitch']) { ?>checked="checked"<?php  } ?>> 关闭
            </label>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg control-label">首页推荐</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[catesindex]" value="1" <?php  if($settings['catesindex']) { ?>checked="checked"<?php  } ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[catesindex]" value="0" <?php  if(!$settings['catesindex']) { ?>checked="checked"<?php  } ?>> 关闭
            </label>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg control-label">更多图标</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[catemore]" value="1" <?php  if($settings['catemore'] || $settings['catemore']=='') { ?>checked="checked"<?php  } ?>> 显示
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[catemore]" value="0" <?php  if($settings['catemore']=='0') { ?>checked="checked"<?php  } ?>> 关闭
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php echo tpl_form_field_image('module[catemoreico]', empty($settings['catemoreico'])?'addons/wnfx_activity/app/resource/images/icon-class-all.png':$settings['catemoreico']);?>		
            <span class="help-block">不设置系统默认，建议150×150像素</span>
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
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>