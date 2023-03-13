<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="js-user-edit-base" ng-controller="UserEditOperatoers" ng-cloak>

	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('user/edit-header', TEMPLATE_INCLUDEPATH)) : (include template('user/edit-header', TEMPLATE_INCLUDEPATH));?>

	<table class="table we7-table">
		<tr>
			<th>操作应用</th>
			<th>所属平台</th>
			<th>权限信息</th>
			<th>操作</th>
		</tr>
		<?php  if(is_array($module_permission)) { foreach($module_permission as $permission) { ?>
		<tr>
			<td><?php  echo $modules_info[$permission['type']]['title'];?></td>
			<td><?php  echo $accounts_info[$permission['uniacid']]['name'];?></td>
			<td class="color-default"><?php  echo $permission['count'];?> 项</td>
			<?php  if($_W['isfounder']) { ?>
			<td class="color-default">
				<a target="_blank" href="<?php  echo url('module/display/switch', array('module_name' => $permission['permission_module'], 'uniacid' => $permission['uniacid'], 'redirect' => urlencode(url('module/permission/post', array('uid' => $permission['uid'], 'module_name' => $permission['permission_module'], 'uniacid' => $permission['uniacid']))) ))?>">
					权限设置
				</a>
				<?php  if(empty($permission['main_module'])) { ?>
				<a ng-click="deleteClerk(<?php  echo $permission['uid'];?>,'<?php  echo $permission['permission_module'];?>',<?php  echo $permission['uniacid'];?>)" href="javascript:;">
					删除
				</a>
				<?php  } ?>
			</td>
			<?php  } ?>
		</tr>
		<?php  } } ?>
		<?php  if(empty($module_permission)) { ?>
		<tr>
			<td colspan="10" class="text-center">暂无应用...</td>
		</tr>
		<?php  } ?>
	</table>
	<div class="text-right">
		<?php  echo $pager;?>
	</div>
</div>
<script>
	angular.module('userProfile').value('config', {
		user: <?php echo !empty($user) ? json_encode($user) : 'null'?>,
		profile: <?php echo !empty($profile) ? json_encode($profile) : 'null'?>,
		links: {
			recycleUser: "<?php  echo url('user/display/operate', array('type' => 'recycle'))?>",
			deleteClerk: "<?php  echo url('module/permission/delete')?>"
		},
    });
	angular.bootstrap($('#js-user-edit-base'), ['userProfile']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

