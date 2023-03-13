<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
#category .mui-table-view{overflow: hidden}
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
</style>
<div class="mui-content">
    <div class="mui-scroll-wrapper" id="category">
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
<script>
mui('.mui-scroll-wrapper').scroll();
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>