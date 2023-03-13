<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline {
    padding-top: 0;
    line-height: 0.95;
}
.multi-img-details .multi-item{height:auto}
</style>
<div class="page-header">当前位置：<span class="text-primary">交易设置</span></div>
<div class="page-content">
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" style="" novalidate="novalidate">
	<div class="form-group-title">未付款订单占用库存</div>
    <div class="form-group">
        <label class="col-lg control-label">是否开启</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[stock_lock]" value="1" <?php  if($settings['stock_lock']==1 || $settings['stock_lock']=='') { ?>checked="checked"<?php  } ?>> 关闭
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[stock_lock]" value="2" <?php  if($settings['stock_lock']==2) { ?>checked="checked"<?php  } ?>> 开启
            </label>
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
<script>

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>