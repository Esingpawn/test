<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="we7-page-tab">
	<li><a href="<?php  echo url('platform/reply', array('module_name' => 'keyword'));?>">关键字自动回复 </a></li>
	<li><a href="<?php  echo url('platform/reply', array('module_name' => 'special'));?>">非文字自动回复</a></li>
	<li><a href="<?php  echo url('platform/reply', array('module_name' => 'welcome'));?>">首次访问自动回复</a></li>
	<li><a href="<?php  echo url('platform/reply', array('module_name' => 'default'));?>">默认回复</a></li>
	<li><a href="<?php  echo url('platform/reply', array('module_name' => 'service'));?>">常用服务</a></li>
	<li><a href="<?php  echo url('platform/reply', array('module_name' => 'userapi'));?>">自定义接口回复</a></li>
	<li class="active"><a href="<?php  echo url('profile/reply-setting');?>">回复设置</a></li>
</ul>
<div class="alert alert-info we7-page-alert">
	<p><i class="fa fa-exclamation-circle"></i> 设置回复次数，则对于每一个用户，在当天内，某一个关键字连续并重复回复超过设置次数后，自动回复失效；</p>
	<p><i class="fa fa-exclamation-circle"></i> 为0表示不限制，最大可设置50。</p>
</div>
<form class="form-horizontal form" id="js-reply-setting" ng-controller="replySettingCtrl">
	<table class="table we7-table table-hover table-form  we7-form">
		<col width="150px " />
		<col />
		<tr>
			<th class="text-left" >回复次数</th>
			<th class="text-right" >操作</th>
		</tr>
		<tr>
			<td><?php  echo $times;?></td>
			<td class="text-right">
				<a href="javascript:;" class="color-default" data-toggle="modal" data-target="#name">修改</a>
			</td>
		</tr>
	</table>

	<!-- 编辑弹出框 start-->
	<div class="modal fade" id="name" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改回复次数</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<span class="col-xs-8 col-sm-2 col-md-2 col-lg-1 control-label">回复次数</span>
						<div class="col-sm-10 col-xs-12">
							<input type="text" ng-model="times" class="form-control" placeholder="" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveSetting()">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<!-- 编辑弹出框 end-->
</form>

<script>
	angular.module('profileApp').value('config', {
		times: "<?php  echo $times;?>",
		links: {
			'postUrl': "<?php  echo url('profile/reply-setting/post')?>",
		},
	});
	angular.bootstrap($('#js-reply-setting'), ['profileApp']);
</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>