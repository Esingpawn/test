<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=20170826" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/util.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>web/resource/js/util.min.js?v=20170912"></script>
<style>
.we7-page-title{display:block!important;border-bottom: 1px solid #ddd;font-size:14px!important;padding:0 10px 5px 0px;margin-bottom: 15px;}
</style>
<div class="we7-page-title">分销商详细信息</div>
<form class="we7-form" action="" method="post">
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">粉丝</label>
        <div class="col-sm-9 col-xs-12">
            <img src="<?php  echo $agent['member']['avatar'];?>" style="width:65px;height:65px;padding:1px;border:1px solid #ccc">
            <?php  echo $agent['member']['nickname'];?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">真实姓名</label>
        <div class="col-sm-9 col-xs-12">
            <div class="form-control-static">
                 <?php  echo $agent['member']['realname'];?>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">联系电话</label>
        <div class="col-sm-9 col-xs-12">
            <div class="form-control-static">
                 <?php  echo $agent['member']['mobile'];?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">累计佣金</label>
        <div class="col-sm-9 col-xs-12">
            <div class="form-control-static"> <?php  echo $agent['commission_total'];?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">已打款佣金</label>
        <div class="col-sm-9 col-xs-12">
            <div class="form-control-static"> <?php  echo $agent['commission_pay'];?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">注册时间</label>
        <div class="col-sm-9 col-xs-12">
            <div class="form-control-static"> <?php  echo $agent['created_at'];?>
            </div>
        </div>
    </div>
    
    
    <div class="form-group" style="display:none">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">强制不自动升级</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="agent[agent_not_upgrade]" value="0" checked="">允许自动升级</label>
            <label class="radio-inline">
                <input type="radio" name="agent[agent_not_upgrade]" value="1">强制不自动升级</label>
            <span class="help-block">如果强制不自动升级，满足任何条件，此分销商的级别也不会改变</span>
    
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">黑名单</label>
        <div class="col-sm-9 col-xs-12">    
            <label class="radio-inline">
                <input type="radio" name="agent[is_black]" value="1"<?php  if($agent['is_black']) { ?> checked<?php  } ?>>是</label>
            <label class="radio-inline">
                <input type="radio" name="agent[is_black]" value="0"<?php  if(!$agent['is_black']) { ?> checked<?php  } ?>>否</label>
        </div>
    </div>
    
    <div class="form-group" style="display:none">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
        <div class="col-sm-9 col-xs-12">
            <textarea name="agent[content]" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group<?php echo substr(IMS_VERSION, 0, 1)>=2?' foot-fixed text-center':' col-sm-12'?>">
        <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
        <input type="hidden" name="id" value="<?php  echo $agent['id'];?>">
        <input type="hidden" name="op" value="post">
        <input type="submit" class="btn btn-primary" name="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;保存&nbsp;&nbsp;&nbsp;&nbsp;" />
    </div>
</form>
<script type="text/javascript">

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH));?>