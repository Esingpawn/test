<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div id="js-user-account-group-post" ng-controller="userCreateGroupPost">
	<ol class="breadcrumb we7-breadcrumb">
		<a href="<?php  echo url('user/create-group/display')?>"><i class="wi wi-back-circle"></i></a>
		<li><a href="<?php  echo url('user/create-group/display')?>">帐号权限组列表</a></li>
		<li>添加帐号权限组</li>
	</ol>
	<form  method="post" action="" class="we7-form" name="createGroup">
		<div class="form-group" >
			<label for="" class="control-label col-sm-2">账号权限组</label>
			<div class="form-controls col-sm-8">
				<input type="text" name="group_name" required class="form-control" placeholder="请输入账号权限组名称" ng-model="groupInfo.group_name" autocomplete="off" />
				<span class="help-block">请输入账号权限组名称</span>
				<span ng-bind=""></span>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2">创建账号个数</label>
			<div class="form-controls col-sm-8">
				<div class="we7-account-num-box">
					<div class="item" ng-repeat="(type, item) in we7TypeDefault" ng-if="type != 'welcome'">
						<div class="name"><i ng-class="item.icon"></i>{{item.name}}</div>
						<input type="text" name="{{'max' + type}}" required class="form-control" ng-model="groupInfo['max' + type]">
					</div>
				</div>
				<span class="help-block">限制各平台账号的创建数量，为0则不允许添加。</span>
			</div>
		</div>
		
		<div class="col-sm-offset-2">
			<input type="submit" name="submit" class="btn btn-primary btn-submit" value="提交"/>
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
		</div>
	</form>
</div>

<script>
	angular.module('userCreateGroup').value('config', {
		groupInfo : <?php echo !empty($account_group_info) ? json_encode($account_group_info) : 'null'?>,
	});
	angular.bootstrap($('#js-user-account-group-post'), ['userCreateGroup']);
</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>