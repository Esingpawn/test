<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline {
    padding-top: 0;
    line-height: 0.95;
}
.multi-img-details .multi-item{height:auto}
</style>
<div class="page-header">当前位置：<span class="text-primary">基础设置</span></div>
<div class="page-content">
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" style="" novalidate="novalidate">
	<input type="hidden" id="tab" name="tab" value="#tab_<?php  echo $tab;?>">
    <div class="tabs-container">
        <ul class="nav nav-tabs" id="myTab">
            <li<?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?> class="active"<?php  } ?>><a href="#tab_basic">基本</a></li>
            <li<?php  if($_GPC['tab']=='web') { ?> class="active"<?php  } ?>><a href="#tab_web">商户登录</a></li>
            <li<?php  if($_GPC['tab']=='perm') { ?> class="active"<?php  } ?>><a href="#tab_perm">默认权限</a></li>
            <li<?php  if($_GPC['tab']=='protocol') { ?> class="active"<?php  } ?>><a href="#tab_protocol">发布协议</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>active<?php  } ?>" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('merch/set/basic', TEMPLATE_INCLUDEPATH)) : (include fx_template('merch/set/basic', TEMPLATE_INCLUDEPATH));?></div>
            <div class="tab-pane <?php  if($_GPC['tab']=='web') { ?>active<?php  } ?>" id="tab_web"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('merch/set/web', TEMPLATE_INCLUDEPATH)) : (include fx_template('merch/set/web', TEMPLATE_INCLUDEPATH));?></div>
            <div class="tab-pane <?php  if($_GPC['tab']=='perm') { ?>active<?php  } ?>" id="tab_perm"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('perm/merch/set', TEMPLATE_INCLUDEPATH)) : (include fx_template('perm/merch/set', TEMPLATE_INCLUDEPATH));?></div>
            <div class="tab-pane <?php  if($_GPC['tab']=='protocol') { ?>active<?php  } ?>" id="tab_protocol"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('merch/set/protocol', TEMPLATE_INCLUDEPATH)) : (include fx_template('merch/set/protocol', TEMPLATE_INCLUDEPATH));?></div>
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
require(['bootstrap'], function () {
	$('#myTab a').click(function (e) {
		$('#tab').val( $(this).attr('href'));
		e.preventDefault();
		$(this).tab('show');
	})
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>