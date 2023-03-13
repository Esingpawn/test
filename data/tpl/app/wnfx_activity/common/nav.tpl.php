<?php defined('IN_IA') or exit('Access Denied');?><?php  
$category = Util::getNumData('*', 'fx_category', array('enabled'=>1,'redirect'=>''), 'displayorder DESC',0,0,0);
$children = array();
if (!empty($category['0'])) {
	foreach ($category['0'] as $ci=>$v) {
		if (!empty($v['parentid'])){
			$children[$v['parentid']][] = $v;
			unset($category['0'][$ci]);				
		}			
	}
}
?>
<style type="text/css">
#category .mui-popover-content{height:100%;}
#category .mui-table-view.mui-group-btn dd{position:relative;padding:8px 10px;line-height: normal;}
#category .mui-table-view.mui-group-btn dd:after{content:'';position:absolute;left:0;bottom:-1px;right:auto;top:auto;height:1px;width:100%;background-color:#e6e6e6;display:block;z-index:100;-webkit-transform:scaleY(.5);transform:scaleY(.5);-webkit-transform-origin:0 90%;transform-origin: 0 90%;}
#category .mui-table-view.mui-group-btn dd a{ display:block;}
#category .mui-table-view.mui-group-btn dd span{display:-webkit-inline-box;font-size:14px;padding:inherit;}
#category .mui-table-view.mui-group-btn dd span:nth-child(2){font-size:16px;padding-left:10px;}
#category .mui-table-view.mui-group-btn dd img{border-radius:100%;width:22px; height:22px;font-size:0;}
#category .mui-table-view.mui-group-btn .mui-table-view-cell{float:left;border-radius:0!important;text-align:center;width:25%;padding:0;}
#category .mui-table-view.mui-group-btn .mui-table-view-cell:after{left:0px;height:0;}
#category .mui-table-view.mui-group-btn .mui-table-view-cell:last-child:after{height:1px;}
#category .mui-table-view.mui-group-btn .mui-table-view-cell a{margin:0!important;color:#666666;line-height:1.7rem; font-size:0.48rem;padding:0;overflow:initial}
#category .mui-table-view.mui-group-btn .mui-table-view-cell a:before{content:'';position:absolute;left:0;bottom:0;height:1px;width:100%;background:#e6e6e6;display:block;z-index:100;-webkit-transform:scaleY(.5);transform:scaleY(.5);-webkit-transform-origin:0 90%;transform-origin: 0 90%;}
#category .mui-table-view.mui-group-btn .mui-table-view-cell a:after{content:" ";position:absolute;top:0;right:0;width:1px;height:100%;background:#e6e6e6;-webkit-transform:scaleX(.5);transform:scaleX(.5);-webkit-transform-origin: 0 100%;transform-origin: 0 100%;}
#category .mui-table-view.mui-group-btn .mui-table-view-cell.bdr-none a:after{width:0;}
.mui-bar-tab .mui-tab-item.mui-active{color:#929292!important;}
.mui-bar-tab .mui-tab-item.active{color:#593A25!important;}
.head-slide~.mui-content{padding-bottom:0;}
</style>
<div id="category" class="mui-popover mui-popover-left">
	<div class="mui-popover-header">所有分类<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="category"><me class="mui-icon mui-icon-closeempty"></me></a></div>
	<div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
            <div class="mui-content-padded" style="padding-bottom:100px;">
                <?php  if(is_array($category['0'])) { foreach($category['0'] as $k => $cate) { ?>
                <ul class="mui-table-view mui-group-btn" style="border-radius:7px;">
                	<dd><a class="mui-navigate-right" href="<?php  echo app_url('activity',array('pid'=>$cate['id']))?>">
                        <span class="mui-pull-left"><img src="<?php  echo tomedia($cate['thumb']);?>" /></span>
                        <span style="color:<?php echo empty($cate['color'])?'#666666':$cate['color']?>"><?php  echo $cate['name'];?></span>
                        <span class="mui-pull-right"></span></a>
                    </dd>
                    <?php  if(is_array($children[$cate['id']])) { foreach($children[$cate['id']] as $i => $ccate) { ?>
                    <li class="mui-table-view-cell<?php  if(($i+1)%4==0) { ?> bdr-none<?php  } ?>"><a href="<?php  echo app_url('activity',array('pid'=>$cate['id'],cid=>$ccate['id']))?>"><?php  echo $ccate['name'];?></a></li>
                    <?php  } } ?>
                </ul>
                <?php  } } ?>
            </div>
            </div>
        </div>
    </div>
</div>
<?php  if($_GPC['from']!='wxapp') { ?>
    <?php  if(empty($keyword) && $_W['_config']['navswitch']) { ?>
    <style type="text/css">.mui-tab-item p.icon{height:18px;overflow:hidden;margin-bottom:4px;line-height:normal}</style>
    <nav class="mui-bar mui-bar-tab" id="bar">
    	<?php  if($_W['_config']['homeswitch'] || $_W['_config']['homeswitch']=='') { ?>
        <a class="mui-tab-item<?php  if($routes['0']=='home') { ?> active<?php  } ?>" href="<?php  echo app_url('home')?>">
            <p class="icon"><img height="100%" src="../addons/wnfx_activity/app/resource/images/home<?php  if($routes['0']=='home') { ?>-active<?php  } ?>.png?v=5431232" /></p>
            <span class="mui-tab-label">首页</span>
        </a>
        <?php  } ?>
        <?php  if($_W['_config']['cateswitch']) { ?>
        <a class="mui-tab-item<?php  if($routes['0']=='activity') { ?> active<?php  } ?> js-popover" data-popover="category" href="javascript:;">
            <p class="icon"><img height='100%' src="../addons/wnfx_activity/app/resource/images/fenlei.png?v=5431232" /></p>
            <span class="mui-tab-label">分类</span>
        </a>
        <?php  } ?>
        <a class="mui-tab-item<?php  if($routes['0']=='records') { ?> active<?php  } ?>" href="<?php  echo app_url('records')?>">
            <p class="icon"><img height='100%' src="../addons/wnfx_activity/app/resource/images/shoucang<?php  if($routes['0']=='records') { ?>-active<?php  } ?>.png?v=5431232" /></p>
            <span class="mui-tab-label">我的<?php  echo $_W['_config']['buytitle'];?></span>
        </a>
        <a class="mui-tab-item<?php  if($routes['0']=='member') { ?> active<?php  } ?>" href="<?php  echo app_url('member')?>">
            <p class="icon"><img height='100%' src="../addons/wnfx_activity/app/resource/images/person<?php  if($routes['0']=='member') { ?>-active<?php  } ?>.png?v=5431233" /></p>
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
    });
    </script>
    <?php  } ?>
<?php  } else { ?>
	<nav class="mui-bar-tab" style="display:none"></nav>
<?php  } ?>