<?php defined('IN_IA') or exit('Access Denied');?><div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">协议内容</div>
    <div class="region-activity-right col-sm-10">
        <?php  echo tpl_ueditor('activity[agreement]', $item['agreement']);?>
    </div>
</div>