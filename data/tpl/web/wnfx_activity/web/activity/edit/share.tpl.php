<?php defined('IN_IA') or exit('Access Denied');?><div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">分享</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">分享标题</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" name="activity[sharetitle]" class="form-control" value="<?php  echo $item['sharetitle'];?>">
                <span class='help-block'>如果不填写，默认为活动名称</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">分享图标</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('activity[sharepic]', $item['sharepic']);?>
                <span class='help-block'>如果不选择，默认为活动缩略图片</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">分享描述</label>
            <div class="col-sm-9 col-xs-12">
                <textarea name="activity[sharedesc]" class="form-control"rows="5"><?php  echo $item['sharedesc'];?></textarea>
                <span class='help-block'>如果不填写，则使用活动副标题，如活动副标题为空则使用店铺名称</span>
            </div>
        </div>
    </div>
</div>