<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">.mui-tab-item p.icon{height:18px;overflow:hidden;margin-bottom:4px;line-height:normal}</style>
<?php  if($_W['_config']['navswitch'] || $_W['_config']['navswitch']=='') { ?>
<nav class="mui-bar mui-bar-tab" id="bar">
    <a class="mui-tab-item<?php  if($_GPC['do']=='records') { ?> mui-active<?php  } ?>" href="<?php  echo app_url('records')?>">
        <p class="icon"><img height='100%' src="../addons/wnfx_activity/app/resource/images/shoucang<?php  if($_GPC['do']=='records') { ?>-active<?php  } ?>.png?v=5431232" /></p>
        <span class="mui-tab-label">我的<?php  echo $_W['_config']['buytitle'];?></span>
    </a>
    <a class="mui-tab-item<?php  if($_GPC['do']=='member') { ?> mui-active<?php  } ?>" href="<?php  echo app_url('member')?>">
        <p class="icon"><img height='100%' src="../addons/wnfx_activity/app/resource/images/person<?php  if($_GPC['do']=='member') { ?>-active<?php  } ?>.png?v=5431233" /></p>
        <span class="mui-tab-label">我的</span>
    </a>
</nav>
<script>
mui.init();
$(function() {
	$("#bar").headroom({
		scrollArea:'.mui-scroll-wrapper-ext',
		distance:100,
		classes: {
			initial: "head-slide",
			pinned: "head-slide-reset",
			unpinned: "head-slide-down"
		}
	});
	$("#bar").headroom({
		scrollArea:'.mui-content',
		distance:100,
		classes: {
			initial: "head-slide",
			pinned: "head-slide-reset",
			unpinned: "head-slide-down"
		}
	});
	if ($("#bar").hasClass('head-slide')){
		$('.mui-content').css('padding-bottom',0);
	}
});
</script><?php  } ?>