<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="js-user-edit-account" ng-controller="UserEditAccount" ng-cloak>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('user/edit-header', TEMPLATE_INCLUDEPATH)) : (include template('user/edit-header', TEMPLATE_INCLUDEPATH));?>
	<table class="table we7-table ">
		<col width="400px">
		<col width="200px">
		<tr>
			<th class="user-dateline-box">
				<span class="color-default">总计</span>用户有效期<i  data-trigger="hover" data-toggle="popover" data-placement="bottom"  data-html="true" data-content="</i>
					用户有效期由<span class='color-red'>用户所在的用户组</span>、系统设置的<span class='color-red'>附加时间</span>、用户自己在<span class='color-red'>商城购买的用户组</span>构成。请单独修改对应选项" class='wi wi-info color-default'></i>
			</th>
			<th class="text-left">
				<span class="color-default"><?php  echo $total_timelimit;?></span>
			</th>
			<th class="text-right">到期时间：<?php  echo $endtime;?></th>
		</tr>
		<tr>
			<td class="color-gray">所属用户组：{{ group_info.name }}</td>
			<td class="text-left">
				<span ng-if="group_info && group_info.timelimit == 0"> 永久 </span>
				<span ng-if="group_info && group_info.timelimit != 0"> {{ group_info.timelimit }} 天</span>
			</td>
			<td class="text-right">
				<a href="javascript:;" ng-if="user.groupid != 0" class="color-default" ng-click="delUserGroup(group_info.id)">删除</a>
				<a href="javascript:;" class="color-default" data-toggle="modal" data-target="#group">修改</a>
			</td>
		</tr>
		<tr>
			<td class="color-gray">附加权限</td>
			<td class="text-left">{{ extra_limit_info.timelimit > 0 ? (extra_limit_info.timelimit + ' 天') : '0天' }}</td>
			<td class="text-right">
				<a href="#date" class="color-default" data-toggle="modal" data-target="#date" >修改</a>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="group" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">应用权限组</div>
				</div>
				<div class="modal-body">
					<div class="alert we7-page-alert">
						<i class="wi wi-info"></i> 此处仅可选择已有用户权限组且享有组内的有效时间，如需修改请到用户权限组修改
						<a href="<?php  echo url('user/group')?>" class="color-default">去修改</a>
					</div>
					<div class="form-group">
						<div class="dropdown nice-select" style="width: 500px !important; margin: 0 auto;">
							<div data-toggle="dropdown" data-target="#" class="current">
								{{group_info.name || '请选择所属用户组'}}
							</div>
							<ul class="list dropdown">
								<li data-value="" class="option" ng-click="changeGroupId('')" ng-class="{'selected': group_info.id == ''}">请选择所属用户组</li>
								<li data-value="{{group.id}}" class="option" ng-repeat="group in groups" ng-class="{'selected': group.id == group_info.id}" ng-click="changeGroupId(group.id)" data-content="{{group.timelimit > 0 ? group.timelimit : '永久'}}">
									{{group.name}}
								</li>
							</ul>
						</div>
						<!-- <select class="we7-select" ng-model="groupid">
							<option value="">请选择所属用户组</option>
							<option ng-value="group.id" ng-repeat="group in groups" ng-selected="group.id == group_info.id" ng-bind="group.name"></option>
						</select> -->
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="changeGroup()">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="date" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">附加天数</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" ng-change="changeTime()" ng-model="extra_limit_info.timelimit">
							<div class="input-group-addon"  we7-date-range-picker ng-model="dateRange" enabletimepicker={{datePickerConfig}}>
								<i class="fa fa-calendar"></i>	选择日期
							</div>
						</div>
					</div>
					<div class="text-center color-gray">
						到期时间：{{ dateRange.startDate }}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="chageExtraTimelimit()" >确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	require(['daterangepicker'], function() {
		angular.module('userManageApp').value('config', {
			uid : <?php  echo $_GPC['uid']?>,
			user: <?php echo !empty($user) ? json_encode($user) : 'null'?>,
			profile: <?php echo !empty($profile) ? json_encode($profile) : 'null'?>,
			group_info: <?php echo !empty($group_info) ? json_encode($group_info) : 'null'?>,
			extra_limit_info: <?php echo !empty($extra_limit_info) ? json_encode($extra_limit_info) : 'null'?>,
			groups: <?php echo !empty($groups) ? json_encode($groups) : 'null'?>,
			links: {
				recycleUser: "<?php  echo url('user/display/operate', array('type' => 'recycle'))?>",
				editUserGroup: "<?php  echo url('user/edit/edit_user_group', array('uid' => $uid))?>",
				deleteUserGroupUrl: "<?php  echo url('user/edit/delete_user_group')?>",
				chageExtraTimelimit: "<?php  echo url('user/edit/edit_user_extra_limit', array('uid' => $uid))?>",
			},
		});
		angular.bootstrap($('#js-user-edit-account'), ['userManageApp']);
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>