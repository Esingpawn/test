<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<div class="new-keyword">
		<ol class="breadcrumb we7-breadcrumb">
			<a href="<?php  echo url('platform/reply', array('module_name' => 'special'));?>"><i class="wi wi-back-circle"></i> </a>
			<li><a href="<?php  echo url('platform/reply', array('module_name' => 'special'));?>">非文字自动回复</a></li>
			<li>编辑</li>
		</ol>
		<div class="we7-form" id="special-reply" ng-controller="PostCtrl">
			<form id="reply-form" class="we7-form form" action="<?php  echo url('platform/reply/post', array('module_name' => $m, 'rid' => $rid))?>" method="post" enctype="multipart/form-data">
			<div id="key">
				<?php  echo module_build_form('core', $rule_id, array('keyword' => false, 'module' => false))?>
			</div>
			<input type="submit" name="submit"  value="保存" class="btn btn-primary" style="padding: 6px 50px;"/>
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
			<input type="hidden" name="module_name" value="<?php  echo $m;?>">
			<input type="hidden" name="type" value="<?php  echo $type;?>">
		</form>
		</div>
	</div>
<script>
	angular.module('replyFormApp').value('config', {
		'url' : '<?php  echo url('platform/reply/change_status')?>',
		'status' : '<?php  echo $setting[$type]['type'];?>'
	});
	angular.bootstrap($('#special-reply'), ['replyFormApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>