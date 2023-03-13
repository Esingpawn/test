<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-lg control-label">是否开启</label>
    <div class="col-sm-9 col-xs-12">
        <label class="radio-inline">
            <input type="radio" name="module[agreement][1]" value="1" <?php  if($settings['agreement']['1']==1) { ?>checked="checked"<?php  } ?>> 开启
        </label>
        <label class="radio-inline">
            <input type="radio" name="module[agreement][1]" value="0" <?php  if(empty($settings['agreement']['1'])) { ?>checked="checked"<?php  } ?>> 关闭
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">协议内容</label>
    <div class="col-sm-9 col-xs-12">
    <?php  echo tpl_ueditor('module[proagreement]', $settings['proagreement']);?>
    </div>
</div>