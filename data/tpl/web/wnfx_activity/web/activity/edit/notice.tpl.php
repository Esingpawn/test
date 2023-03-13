<?php defined('IN_IA') or exit('Access Denied');?><div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">用户通知</div>
    <div class="region-activity-right col-sm-10">
        <?php  if(perm('messages.run')) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">短信通知</label>
            <div class="col-sm-5 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[smsnotify][switch]" value="1"<?php  if($item['smsnotify']['switch']) { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[smsnotify][switch]" value="0"<?php  if(!$item['smsnotify']['switch']) { ?> checked<?php  } ?>> 关闭
                </label>
            </div>
        </div>
        
        <div class="form-group"<?php  if(MERCHANTID) { ?> style="display:none"<?php  } ?>>
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">报名成功ID</span>
                    <input type="text" name="activity[smsnotify][join]" class="form-control encrypt" value="<?php  echo $item['smsnotify']['join'];?>" placeholder='"SMS_" 开头的字串【不设置应用全局】'>
                </div>
            </div>
        </div>
        <div class="form-group"<?php  if(MERCHANTID) { ?> style="display:none"<?php  } ?>>
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">群发通知ID</span>
                    <input type="text" name="activity[smsnotify][group]" class="form-control encrypt" value="<?php  echo $item['smsnotify']['group'];?>" placeholder='"SMS_" 开头的字串【不设置应用全局】'>
                </div>
            </div>
        </div>
        <?php  } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">模板消息</label>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">标题</span>
                    <input type="text" class="form-control" name="activity[tmplmsg][jointitle]" value="<?php  echo $item['tmplmsg']['jointitle'];?>" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">备注</span>
                    <input type="text" class="form-control" name="activity[tmplmsg][joinremark]" value="<?php  echo $item['tmplmsg']['joinremark'];?>" />
                </div>
                <span class="help-block">用于定义 "报名成功模板通知" 显示的标题内容和备注内容，留空系统默认。</span>
            </div>
        </div>
    </div>
</div>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">商家通知</div>
    <div class="region-activity-right col-sm-10">
    	<div class="form-group">
            <label class="col-lg control-label">选择会员</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_selector('openids',array('key'=>'openid', 'required'=>false, 'text'=>'nickname', 'thumb'=>'avatar','multi'=>1,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择会员 ', 'items'=>$members,'url'=>web_url('member/query',array('no_wa'=>1))))?>
        		<span class='help-block'>可指定多个微信用户【不设置应用全局】</span>
            </div>
        </div>
    </div>
</div>
<!--蜗牛科技-->