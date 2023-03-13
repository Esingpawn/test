<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">会员详情</span></div>
<div class="page-content">
<form <?php  if(perm('member.list.edit')) { ?>action="" method='post'<?php  } ?> class='form-horizontal form-validate'>
	<div class="tabs-container">
		<div class="tabs">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#tab-basic" aria-expanded="true"> 基本信息</a></li>
				<li class=""><a data-toggle="tab" href="#tab-trade" aria-expanded="false"> 交易信息</a></li>
				<?php  if($hascommission) { ?> <?php  if(perm('commission.agent.main')) { ?>
				<li class=""><a data-toggle="tab" href="#tab-commission" aria-expanded="false"> 分销商信息</a></li>
                <?php  } ?>
                <?php  } ?>
			</ul>
			<div class="tab-content ">
				<div id="tab-basic" class="tab-pane active"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('member/detail/basic', TEMPLATE_INCLUDEPATH)) : (include fx_template('member/detail/basic', TEMPLATE_INCLUDEPATH));?></div>
				<div id="tab-trade" class="tab-pane"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('member/detail/trade', TEMPLATE_INCLUDEPATH)) : (include fx_template('member/detail/trade', TEMPLATE_INCLUDEPATH));?></div>
				<?php  if($hascommission) { ?>
                <?php  if(perm('commission.agent.main')) { ?>
				<div id="tab-commission" class="tab-pane">
                    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('member/detail/commission', TEMPLATE_INCLUDEPATH)) : (include fx_template('member/detail/commission', TEMPLATE_INCLUDEPATH));?>
                </div>
				<?php  } ?>
				<?php  } ?>
			</div>
		</div>
	</div>
	<div class="form-group"></div>
          <div class="form-group">
		<label class="col-lg control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<?php  if(perm('member.list.edit')) { ?>
			<input type="submit"  value="提交" class="btn btn-primary" />
			<?php  } ?>
			<input type="button" class="btn btn-default" name="submit" onclick="history.back();" value="返回列表" <?php  if(perm('member.list.edit')) { ?>style='margin-left:10px;'<?php  } ?> />
		</div>
	</div>

</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>