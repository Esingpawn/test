<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline {
    padding-top: 0;
    line-height: 0.95;
}
.multi-img-details .multi-item{height:auto}
</style>
<div class="page-header">当前位置：<span class="text-primary">模板消息</span></div>
<div class="page-content">
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" style="" novalidate="novalidate">
    <div class="alert alert-info">
    	<p>说明:</p>
        <ol>
            <li>仅限 <b>认证服务号</b> 添加消息模板后才可以使用模板消息功能（不设置，默认文本消息）。</li>
            <li>登陆<a target="_blank" href="https://mp.weixin.qq.com/">【微信公众平台】</a>-【功能】-【模板消息】</li>
            <li>选择行业为："IT科技/互联网|电子商务"，"IT科技/IT软件与服务"</li>
            <li>在【模板库】搜索对应模板 <b>"标题"</b> 找到对应模板，点击详情 <b>"添加"</b>，重复执行。</li>
            <li>在【我的模板】下对应标题复制 <b>"模板ID"</b> 到本页设置对应位置。</li>
        </ol>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">通知开启</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[mmsg]" value="1" <?php  if($settings['mmsg']==1 || $settings['mmsg']=='') { ?>checked="checked"<?php  } ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[mmsg]" value="0" <?php  if($settings['mmsg']=='0') { ?>checked="checked"<?php  } ?>> 关闭
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">报名成功通知模板ID</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="module[m_join]" class="form-control" value="<?php  echo $settings['m_join'];?>">
            <span class="help-block">公众平台模板消息编号：OPENTM406157086 ——【标题：报名成功通知】</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">报名取消通知模板ID</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="module[m_cancle]" class="form-control" value="<?php  echo $settings['m_cancle'];?>">
            <span class="help-block">公众平台模板消息编号：OPENTM406447723 ——【标题：报名取消通知】</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">消费成功通知模板ID</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="module[m_hexiao]" class="form-control" value="<?php  echo $settings['m_hexiao'];?>">
            <span class="help-block">公众平台模板消息编号：OPENTM410000708 ——【标题：消费成功通知】</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">审核结果通知模板ID</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="module[m_review]" class="form-control" value="<?php  echo $settings['m_review'];?>">
            <span class="help-block">公众平台模板消息编号：OPENTM411984401 ——【标题：审核结果通知】</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">提现申请提醒模板ID</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="module[m_cash]" class="form-control" value="<?php  echo $settings['m_cash'];?>">
            <span class="help-block">公众平台模板消息编号：OPENTM205459480 ——【标题：提现申请提醒】</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">活动状态通知模板ID</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="module[m_status]" class="form-control" value="<?php  echo $settings['m_status'];?>">
            <span class="help-block">公众平台模板消息编号：OPENTM409570196 ——【标题：报名结果通知】</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">认证审核通知模板ID</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="module[m_mcert]" class="form-control" value="<?php  echo $settings['m_mcert'];?>">
            <span class="help-block">公众平台模板消息编号：OPENTM408469323 ——【标题：认证审核通知】</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">订单退款提醒ID</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="module[m_refund]" class="form-control" value="<?php  echo $settings['m_refund'];?>">
            <span class="help-block">公众平台模板消息编号：OPENTM200565278 ——【标题：订单退款提醒】</span>
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