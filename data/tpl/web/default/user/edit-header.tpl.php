<?php defined('IN_IA') or exit('Access Denied');?><ol class="breadcrumb we7-breadcrumb">
	<?php  if($user['founder_groupid'] == 2) { ?>
	<li><a href="<?php  echo url('founder/display');?>"><i class="wi wi-back-circle"></i>副创始人管理</a></li>
	<li>编辑创始人详情</li>
	<?php  } else { ?>
	<li><a href="<?php  echo url('user/display');?>"><i class="wi wi-back-circle"></i>用户管理</a></li>
	<li>编辑用户详情</li>
	<?php  } ?>
</ol>

<div class="user-head-info clearfix" >
	<img ng-src="{{profile.avatar || ''}}" class="img-circle user-avatar">
	<div class="info">
		<h3 class="title" ng-bind="user.username"></h3>
	</div>
	<?php  if(IMS_FAMILY == 'x') { ?>
	<?php  if($user['founder_groupid'] != ACCOUNT_MANAGE_GROUP_FOUNDER) { ?>
	<a href="javascript:;" class="btn btn-primary" ng-click="recycleUser()">禁用</a>
	<?php  } ?>
	<?php  } ?>
</div>

<div class="btn-group we7-btn-group we7-padding-bottom">
	<a href="<?php  echo url('user/edit/edit_base', array('uid' => $_GPC['uid']))?>" class="btn btn-default <?php  if($do == 'edit_base') { ?>active<?php  } ?>">基础信息</a>
	<?php  if(empty($user['founder_groupid'])) { ?>
	<a href="<?php  echo url('user/edit/edit_modules_tpl', array('uid' => $_GPC['uid']))?>" class="btn btn-default <?php  if($do == 'edit_modules_tpl') { ?>active<?php  } ?>">应用模板权限</a>
	<?php  } ?>

	
	<?php  if(!empty($user['founder_groupid'])) { ?>
	<a href="<?php  echo url('founder/edit/edit_modules_tpl', array('uid' => $_GPC['uid']))?>" class="btn btn-default <?php  if($do == 'edit_modules_tpl') { ?>active<?php  } ?>">应用模板权限</a>
	<?php  } ?>
	

	<a href="<?php  echo url('user/edit/edit_create_account_list', array('uid' => $_GPC['uid']))?>" class="btn btn-default <?php  if($do == 'edit_create_account_list') { ?>active<?php  } ?>">账号创建权限</a>
	<a href="<?php  echo url('user/edit/edit_account_dateline', array('uid' => $_GPC['uid']))?>" class="btn btn-default <?php  if($do == 'edit_account_dateline') { ?>active<?php  } ?>">账号使用期限</a>

	<?php  if(empty($user['founder_groupid'])) { ?>
	<a href="<?php  echo url('user/edit/edit_account', array('uid' => $_GPC['uid']))?>" class="btn btn-default <?php  if($do == 'edit_account') { ?>active<?php  } ?>">使用账号列表</a>
	<?php  } ?>

	
	<?php  if(!empty($user['founder_groupid'])) { ?>
	<a href="<?php  echo url('founder/edit/edit_account', array('uid' => $_GPC['uid']))?>" class="btn btn-default <?php  if($do == 'edit_account') { ?>active<?php  } ?>">使用账号列表</a>
	<?php  } ?>
	
	<a href="<?php  echo url('user/edit/operators', array('uid' => $_GPC['uid']))?>" class="btn btn-default <?php  if($do == 'operators') { ?>active<?php  } ?>">操作应用列表</a>
</div>
