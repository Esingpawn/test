<?php defined('IN_IA') or exit('Access Denied');?><div class="account-info">
	<!--logo-->
	<img src="<?php  echo $_W['account']['logo'];?>" class="head-logo account-img">
	<!-- 名称-->
	<div class="account-name text-over"><?php  echo $_W['account']['name'];?></div>
	<div class="account-type">
		版本：<?php  echo $version_info['version'];?>
	</div>
	<div class="account-operate">
		<a href="<?php  echo url('miniapp/version/display', array('iscontroller' => 0))?>" class="h">切换版本</a>
		<?php  if(in_array($_W['role'], array(ACCOUNT_MANAGE_NAME_OWNER, ACCOUNT_MANAGE_NAME_MANAGER)) || $_W['isfounder']) { ?>
			<a href="<?php  echo $_W['account']['manageurl'] . '&iscontroller=0'?>" class="h">管理设置</a>
		<?php  } ?>
	</div>
</div>