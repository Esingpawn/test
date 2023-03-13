<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-lg control-label">商户平台</label>
    <div class="col-sm-9 col-xs-12">
        <label class="radio-inline">
            <input type="radio" name="module[merch]" value="1" <?php  if($settings['merch']) { ?>checked="checked"<?php  } ?>> 开启
        </label>
        <label class="radio-inline">
            <input type="radio" name="module[merch]" value="0" <?php  if(!$settings['merch']) { ?>checked="checked"<?php  } ?>> 关闭
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">发布按钮</label>
    <div class="col-sm-9 col-xs-12">
        <label class="radio-inline">
            <input type="radio" name="module[probtn]" value="1" <?php  if($settings['probtn'] || $settings['probtn']=='') { ?>checked="checked"<?php  } ?>> 开启
        </label>
        <label class="radio-inline">
            <input type="radio" name="module[probtn]" value="0" <?php  if($settings['probtn']=='0') { ?>checked="checked"<?php  } ?>> 关闭
        </label>
        <label class="radio-inline" style="padding-left:0;">【关闭后不影响移动端进入主办方入口发布活动】</label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">绑定手机</label>
    <div class="col-sm-9 col-xs-12">
        <label class="radio-inline">
            <input type="radio" name="module[bond]" value="1" <?php  if($settings['bond']) { ?>checked="checked"<?php  } ?>> 开启
        </label>
        <label class="radio-inline">
            <input type="radio" name="module[bond]" value="0" <?php  if(!intval($settings['bond'])) { ?>checked="checked"<?php  } ?>> 关闭
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">强制认证</label>
    <div class="col-sm-9 col-xs-12">
        <label class="radio-inline">
            <input type="radio" name="module[certswitch]" value="1" <?php  if($settings['certswitch']==1) { ?>checked="checked"<?php  } ?>> 开启
        </label>
        <label class="radio-inline">
            <input type="radio" name="module[certswitch]" value="0" <?php  if($settings['certswitch']==0 || $settings['certswitch']=='') { ?>checked="checked"<?php  } ?>> 关闭
        </label>
        <label class="radio-inline" style="padding-left:0;">【开启后商户必须认证才可提现】</label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">商户佣金</label>
    <div class="col-xs-12 col-sm-4">
        <div class="input-group">
            <span class="input-group-addon">佣金比例</span>
            <input type="text" name="module[percent]" class="form-control" value="<?php  echo $settings['percent'];?>" placeholder='默认佣金比：0.6'>
            <span class="input-group-addon">%</span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">商户提现</label>
    <div class="col-sm-9 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon">最低限额</span>
            <input type="text" name="module[merch_amount]" class="form-control" value="<?php  echo $settings['merch_amount'];?>" placeholder='系统默认最低：1'>
            <span class="input-group-addon">元，最大限额</span>
            <input type="text" name="module[merch_maximum]" class="form-control" value="<?php  echo $settings['merch_maximum'];?>" placeholder='默认：10000，最大：20000'>
            <span class="input-group-addon">元</span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">主页封面</label>
    <div class="col-sm-9 col-xs-12">
        <?php  echo tpl_form_field_image('module[merch_thumb]', $settings['merch_thumb']);?>
        <span class="help-block">建议900×900像素，主办方主页默认封面背景</span>
    </div>
</div>