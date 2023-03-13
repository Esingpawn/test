<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline {
    padding-top: 0;
    line-height: 0.95;
}
.multi-img-details .multi-item{height:auto}
</style>
<div class="page-header">当前位置：<span class="text-primary">计划任务</span></div>
<div class="page-content">
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" style="" novalidate="novalidate">
    <div class="alert alert-info">
        <p style="text-indent: 18px;">配制说明：阿里云控制台->产品服务->云监控->站点管理->创建监控点，参数设置默认即可。【也可以在宝塔计划任务中设置】</p>
    </div>
    <div class="form-group">
    	<input type="hidden" name="module[task]['user']" value="">
        <label class="col-lg control-label">关闭订单</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group fixsingle-input-group">
                <span class="input-group-addon">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="module[task][0]" value="cancle" <?php  if($settings['task']['0']=='cancle') { ?>checked="checked"<?php  } ?>>开启
                    </label>
                </span>
                <input type="text" name="module[cancle_time]" class="form-control" value="<?php  echo $settings['cancle_time'];?>" placeholder='默认为1小时'>
                <span class="input-group-addon">小时</span>
            </div>
            <span class="help-block">超过当前时间，自动关闭未付款订单</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">商户提现</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group fixsingle-input-group">
                <span class="input-group-addon">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="module[task][1]" value="cash" <?php  if($settings['task']['1']=='cash') { ?>checked="checked"<?php  } ?>>开启
                    </label>
                </span>
                <input type="text" name="module[cash_time]" class="form-control" value="<?php  echo $settings['cash_time'];?>" placeholder='默认为1小时'>
                <span class="input-group-addon">小时</span>
            </div>
            <span class="help-block">超过当前时间，自动处理满足条件的提现记录.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">任务接口</label>
        <div class="col-sm-9 col-xs-12">
            <div class="bs-example bs-example-images" data-example-id="image-shapes" style="position:relative;">
                <a href="javascript:;" class="btn btn-default btn-sm js-clip" data-url="<?php  echo app_url('home/auto_task');?>" id="js-copy"><i class="fa fa-link"></i> 复制链接</a>                
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