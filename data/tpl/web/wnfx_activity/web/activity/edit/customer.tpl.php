<?php defined('IN_IA') or exit('Access Denied');?><div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">客服设置</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">内部设置</label>
            <div class="col-sm-9 col-xs-12">
                <label class="checkbox-inline">
                    <input type="checkbox" value="1" name="activity[kefu][switch]" <?php  if($item['kefu']['switch']) { ?>checked<?php  } ?> onclick='if($(this).get(0).checked){$("#kefu").show()}else{$("#kefu").hide()}' /> 开启
                </label>
                <div class="help-block">
                    客服优先级：内部设置 > 主办方 > 平台，显示在详情页面下方菜单。
                </div>
            </div>
        </div>
        <div class="form-group" id="kefu"<?php  if($item['kefu']['switch']!=1) { ?> style="display:none"<?php  } ?>>
            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">客服设置</label>
            <div class="col-sm-9 col-xs-12">
                <div style="<?php  if(MERCHANTID) { ?>display:none<?php  } ?>">
                <label class="radio-inline">
                    <input type="radio" value="1" name="activity[kefu][type]" <?php  if($item['kefu']['type']=='1' || $item['kefu']['type']=='') { ?>checked<?php  } ?> /> 微信二维码
                </label>
                <label class="radio-inline">
                    <input type="radio" value="2" name="activity[kefu][type]" <?php  if($item['kefu']['type']=='2') { ?>checked<?php  } ?> /> 第三方入口
                </label>
                </div>
                <div class="kefu-item" style="<?php  if(!MERCHANTID) { ?>margin-top:15px;<?php  } ?><?php  if($item['kefu']['type']=='2') { ?>display:none<?php  } ?>">
                    <?php  echo tpl_form_field_image('activity[kefu][qrcode]', $item['kefu']['qrcode']);?>
                    <span class="help-block">尺寸建议宽度为640</span>
                </div>
                <div class="input-group kefu-item" style="margin-top:15px;<?php  if($item['kefu']['type']!='2' || MERCHANTID) { ?>display:none<?php  } ?>">
                    <span class="input-group-addon">入口连接</span>
                    <input type="text" name="activity[kefu][url]" class="form-control" value="<?php  echo $item['kefu']['url'];?>">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">订单完成</div>
    <div class="region-activity-right col-sm-10">
    	<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">是否开启</label>
            <div class="col-sm-9 col-xs-12">
                <label class="checkbox-inline">
                    <input type="checkbox" value="1" name="activity[kefu][switch1]" <?php  if($item['kefu']['switch1']) { ?>checked<?php  } ?> onclick='if($(this).get(0).checked){$("#kefu1").show()}else{$("#kefu1").hide()}' /> 开启
                </label>
                <div class="help-block">
                    用于显示在订单完成页面。
                </div>
            </div>
        </div>
        <div id="kefu1"<?php  if($item['kefu']['switch1']!=1) { ?> style="display:none"<?php  } ?>>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">弹窗海报</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('activity[kefu][thumb]', $item['kefu']['thumb']);?>
                <span class="help-block">尺寸建议宽度为640</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">跳转连接</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" name="activity[kefu][url1]" class="form-control" value="<?php  echo $item['kefu']['url1'];?>">
                <span class="help-block">点击海报跳转的网址，不设置不跳转</span>
            </div>
        </div>
        </div>
    </div>
</div>