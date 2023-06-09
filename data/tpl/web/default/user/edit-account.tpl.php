<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="js-user-edit-account" ng-controller="UserEditAccount" ng-cloak>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('user/edit-header', TEMPLATE_INCLUDEPATH)) : (include template('user/edit-header', TEMPLATE_INCLUDEPATH));?>

	<table class="table we7-table table-hover vertical-middle">
		<col width="70px"/>
		<col width="400px"/>
		<col />
		<col width="240px"/>
		<tr>
			<th colspan="2" class="text-left">可使用的账号</th>
			<th></th>
			<th class="text-right">操作</th>
		</tr>

		<tr ng-repeat="account in account_list" ng-if="account_list">
			<td class="text-left"><img ng-src="{{account.logo}}" class="img-responsive account-img__list"/></td>
			<td class="text-left">
				<p ng-bind="account.name"></p>
				<span class="color-gray" >
					<i class="wi wi-{{we7TypeDefault[account.type_sign]['icon']}}"></i>
					<span >{{we7TypeDefault[account.type_sign]['name']}}</span>
				</span>
			</td>
			<td>
				<span ng-if="account.role == 'founder'">创始人</span>
				
				<span ng-if="account.role == 'vice_founder'">副创始人</span>
				
				<span ng-if="account.role == 'owner'">主管理员</span>
				<span ng-if="account.role == 'manager'">管理员</span>
				<span ng-if="account.role == 'operator'"  class="label-versions">操作员</span>
				<span ng-if="account.role == 'clerk'">应用操作员</span>
			</td>
			<td>
				<div class="link-group">
					<a ng-href="{{account.manageurl}}" class="color-default">设置</a>
					<a ng-href="{{account.roleurl}}" class="color-default">操作员设置</a>
				</div>
			</td>
		</tr>
		<tr ng-if="!account_list">
			<td colspan="100">
				<div class="we7-empty-block">
					暂无可使用账号
				</div>
			</td>
		</tr>
	</table>
</div>
<script>
	require(['daterangepicker'], function() {
		angular.module('userManageApp').value('config', {
			user: <?php echo !empty($user) ? json_encode($user) : 'null'?>,
			account_list : <?php echo !empty($account_list) ? json_encode($account_list) : 'null'?>,
			profile: <?php echo !empty($profile) ? json_encode($profile) : 'null'?>,
			links: {
				recycleUser: "<?php  echo url('user/display/operate', array('type' => 'recycle'))?>",
			},
		});
		angular.bootstrap($('#js-user-edit-account'), ['userManageApp']);
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>