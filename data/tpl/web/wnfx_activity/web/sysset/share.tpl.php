<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline {
    padding-top: 0;
    line-height: 0.95;
}
.multi-img-details .multi-item{height:auto}
</style>
<div class="page-header">当前位置：<span class="text-primary">分享关注</span></div>
<div class="page-content">
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" style="" novalidate="novalidate">
	<div class="form-group-title">分享设置</div>
	<div class="form-group">
        <label class="col-lg control-label">分享标题</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" name="module[share][title]" class="form-control" value="<?php  echo $settings['share']['title'];?>" placeholder="">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">分享图片</label>
        <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_form_field_image('module[share][pic]', $settings['share']['pic']);?>
            (建议150*150)
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">分享描述</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" name="module[share][desc]" class="form-control" value="<?php  echo $settings['share']['desc'];?>" placeholder="">
        </div>
    </div>
    
    <?php  if($_W['account']->typeSign=='account') { ?>
        <div class="form-group-title">关注设置</div>
        <div class="form-group">
            <label class="col-lg control-label">强制关注</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="module[guanzhu_join]" value="2" <?php  if($settings['guanzhu_join']==2) { ?>checked="checked"<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="module[guanzhu_join]" value="1" <?php  if($settings['guanzhu_join']==1 || $settings['guanzhu_join']=='') { ?>checked="checked"<?php  } ?>> 关闭【认证服务号】
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">关注引导</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="module[guanzhu]" value="1" <?php  if($settings['guanzhu']==1) { ?>checked="checked"<?php  } ?>> 显示
                </label>
                <label class="radio-inline">
                    <input type="radio" name="module[guanzhu]" value="2" <?php  if($settings['guanzhu']==2 || $settings['guanzhu']=='') { ?>checked="checked"<?php  } ?>> 关闭【认证服务号】
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">关注二维码</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('module[followed_image]', $settings['followed_image']);?>
            </div>
        </div>
    <?php  } ?>
    
    <div<?php  if(!perm('sysset.workwe.edit')) { ?> style="display:none"<?php  } ?>>
        <div class="form-group-title">企业微信</div>
        <div class="form-group">
            <label class="col-lg control-label">企业ID</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" name="data[workwe][key]" class="form-control" value="<?php  echo $data['key'];?>" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">Secret</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" name="data[workwe][secret]" class="form-control" value="<?php  echo $data['secret'];?>" placeholder="">
            </div>
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