<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-lg control-label">登录地址</label>
    <div class="col-sm-9 col-xs-12">
        <div class='form-control-static'>
            <a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php echo $_W['siteroot'] . 'addons/wnfx_activity/web/merch.php?i=' . $_W['uniacid'];?>" ><?php echo $_W['siteroot'] . 'addons/wnfx_activity/web/merch.php?i=' . $_W['uniacid'];?></a>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">平台图标</label>
    <div class="col-sm-7 col-xs-12">
        <?php  echo tpl_form_field_image('module[merch_logo]', $settings['merch_logo'])?>
        <span class="help-block">建议110×35像素，位于主办方登录平台左上角</span>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">登录封面</label>
    <div class="col-sm-7 col-xs-12">
        <?php  echo tpl_form_field_image('module[merch_loginbg]', $settings['merch_loginbg'])?>
        <span class="help-block">图片建议为2560*1440</span>
    </div>
</div>