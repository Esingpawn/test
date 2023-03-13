<?php defined('IN_IA') or exit('Access Denied');?><div class="region-activity-details row">	
    <div class="region-activity-left col-sm-2">
    	顶端标题
    </div>
    <div class=" region-activity-right col-sm-10">
        <input type="text" name="activity[pagetitle]" class="form-control" value="<?php  echo $item['pagetitle'];?>"/>
        <div class="help-block">
            显示在详情页面顶端位置，不设置默认“活动详情”
        </div>
    </div>
</div>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">
        报名须知<span class="help-block" style="padding-left:10px;font-size:12px;">PS：(这里填写一些报名规则条款，不支持图片)</span>
    </div>
    <div class=" region-activity-right col-sm-10">
        <?php  echo tpl_ueditor('activity[info]', $item['info']);?>
    </div>
</div>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">活动详情</div>
    <div class=" region-activity-right col-sm-10">
        <?php  echo tpl_ueditor('activity[detail]', $item['detail'], array('height'=>300));?>
    </div>
</div>
<!--OTEzNzAyMDIzNTAzMjQyOTE0-->