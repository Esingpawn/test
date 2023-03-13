<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="<?php echo FX_BASE;?>app/resource/js/waterfall/waterfall.css?v=1.0.5">
<style type="text/css">
.mui-rmb:before{position:relative;left:-2px;}
.mui-bar-tab~.mui-content{padding-bottom:0;overflow:visible}
.mui-content .mui-control-content{height: 100%;}
.mui-bar-nav:after{height:0}
.mui-bar-nav .nav-inner{display:table;width:100%;height:1.5rem;position:relative;overflow:hidden;}
.mui-bar-nav .nav-inner>.inner-item{vertical-align:middle;display:table-cell;}
.mui-bar-nav .nav-inner>.leftbar{min-width:2px;max-width:4.5rem;padding-left:0.5rem;padding-right:0.2rem;white-space: nowrap;}
.mui-bar-nav .nav-inner>.leftbar .mui-ext-icon{color:#72400b;font-size:0.5rem;background:#feda00;border-radius:1.3rem;display:block;padding:0 0.3rem;padding-right:0.65rem;line-height:1.8;position:relative}
.mui-bar-nav .nav-inner>.leftbar .mui-ext-icon:after{color:#72400b;font-size:0.2rem;right:0.15rem;position:absolute;top:50%;-webkit-transform: translateY(-50%);transform: translateY(-50%);}

.mui-bar-nav .nav-inner>.mui-segmented-control.mui-scroll-wrapper{vertical-align:unset;background:none;height:1.5rem;font-size:0;display:table-cell}
.mui-bar-nav .nav-inner>.mui-segmented-control.mui-scroll-wrapper .mui-scroll{height:1.5rem}
.mui-bar-nav .nav-inner>.mui-segmented-control .mui-control-item{color:#000!important;font-size:.48rem;margin:0 0.5rem;line-height:1.5rem;border-bottom:none!important;opacity:0.75}
.mui-bar-nav .nav-inner>.mui-segmented-control .mui-control-item.mui-active{color:#000!important;font-size:.55rem;font-weight:700;border-bottom:none!important;opacity:1;position:relative}
.mui-bar-nav .nav-inner>.mui-segmented-control .mui-control-item.mui-active:after{position:absolute;bottom:0.2rem;content: '';height:0.12rem;width:45%;left:50%;-webkit-transform: translateX(-50%);transform: translateX(-50%);
border-radius:0.25rem;
background:-webkit-linear-gradient(right, rgba(254,189,0,1) 0%, rgba(255,211,0,1) 120%);
background:-moz-linear-gradient(right, rgba(254,189,0,1) 10%, rgba(255,211,0,1) 120%);
background:-o-linear-gradient(right, rgba(254,189,0,1) 0%, rgba(255,211,0,1) 120%);
background:linear-gradient(right, rgba(254,189,0,1) 0%, rgba(255,211,0,1) 120%);}

.mui-bar-nav .nav-inner>.rightbar{font-size:0.7rem;color:#000;line-height:1.3;display:table-cell;vertical-align:middle;padding: 0 0.5rem;text-align:right;position: relative;z-index: 5;}
.mui-bar-nav .nav-inner>.rightbar:before{opacity:0.8}

.mui-bar-nav .nav-inner>.search{width:100%;display:table-cell;vertical-align:middle;height:1.5rem;padding-left:0.5rem;}
.mui-bar-nav .nav-inner>.search .search-bg{border-radius:1.3rem;background:#f0f0f0;display:block;line-height:2.2;color:#666}
.mui-bar-nav .nav-inner>.search .search-txt{ font-size:0.5rem;}
.mui-bar-nav .nav-inner>.city~.search{padding-left:0.3rem;}
.mui-bar-nav~.mui-content{padding-top:3.6rem;}
.mui-bar-nav~.mui-content .mui-card:first-child{margin-top:0;}

.mui-popover .mui-popover-content{height:100%;}
.mui-popover-top{width:100%!important;border-radius:0;-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0);-webkit-box-shadow:none;box-shadow:none;-webkit-transition:-webkit-transform .3s,opacity .3s;transition:transform .3s,opacity .3s;}
.mui-popover-top.mui-active{position:fixed;-webkit-transform:translate3d(0,0,0);transform: translate3d(0,0,0);}
#mui_screen{ width:80%;left:auto;right:0;}
#mui_screen .mui-popover-content{padding-bottom:45px;}
#mui_screen .mui-btn-group{height:45px;overflow:hidden;background:#fafafa;margin-top:-40px;position:relative;z-index:15;}
#mui_screen .mui-btn-group .mui-btn{width:50%;height:45px;border-radius:0;}
.mui-table-view.mui-group-btn{margin:0; padding-left:10px!important;}
.mui-table-view.mui-group-btn,.mui-table-view.mui-group-btn .mui-table-view-cell{border-radius:0!important;}
.mui-table-view.mui-group-btn .mui-table-view-cell{float:left;text-align:center;width:28%; margin-right:5%;padding:3px 0!important; margin-bottom:3px;}
.mui-table-view.mui-group-btn .mui-table-view-cell:after{height:0!important;}
.mui-table-view.mui-group-btn .mui-table-view-cell a{background:#fff!important;margin:0!important;border-radius:5px!important;line-height:2;font-size:12px;}
.mui-table-view.mui-group-btn .mui-table-view-cell.mui-selected a{color:#febd00;}
.mui-table-view.mui-group-btn .mui-table-view-cell.mui-selected a:after{border:1px solid #febd00;}

.selector-control{ z-index:100; position:relative; height:1.71rem; overflow:hidden; background:#fdfdfd;}
.selector-control .mui-table-view{ background:#fdfdfd; margin-top:0; display:table;width:100%;table-layout: fixed;height:1.7rem;}
.selector-control .mui-table-view-cell.mui-collapse{ overflow:visible;vertical-align: middle; padding:0;width:100%; text-align:center;display:table-cell!important;}
.selector-control .mui-table-view-cell.mui-collapse a{ line-height:3.5;font-size:0.5rem;}
.selector-control .mui-table-view-cell.mui-collapse.mui-active{ background:#fdfdfd; color:#FF7B33}
.selector-control .mui-table-view-cell.mui-collapse a.mui-active{ background:none; color:#FF7B33}
.selector-control .mui-table-view-cell.mui-collapse a:after{ right:inherit;content: ""!important; width: 0;height: 0;border-top: .2rem solid #bbb;border-left: .18rem solid transparent;border-right: .18rem solid transparent;border-bottom: 0;margin-left: .18rem;}
.selector-control .mui-table-view-cell.mui-collapse.mui-active a:after{ color:#FF7B33;border-top: 0;border-left: .18rem solid transparent;border-right: .18rem solid transparent;border-bottom: .2rem solid #FF7B33;margin-bottom: 0;}
.cate-sub{background:#fff;font-size:0.42rem;line-height:normal;overflow:hidden;text-align: center;}
.cate-sub .sub-item{background:#f5f6f8;border-radius:1.3rem;padding:0.2rem 0.25rem; margin:0.3rem 0.5rem;display:inline-block;}
.cate-sub .sub-item a{color:#848492; margin:0 0.25rem}
.cate-sub~.mui-scroll-wrapper-ext{}
.selector-content{left:0;right:0;box-shadow:none;height:0;max-height:75%;width:100%;background:#FFF;}
.selector-content .selector-content-item{display:none;position:relative; height:100%; padding-bottom:5px;}
.selector-content .mui-table-view-cell a{ padding-left:30px; font-size:14px; line-height:1.5;}
.selector-content .mui-table-view-cell:after{ left:0;}
.selector-content .mui-table-view-cell.mui-selected{ color:#FF7B33;}
.selector-content .mui-table-view-cell.mui-selected a:before{ content: '\e472';left: 5px; font-size: 24px;}
.selector-content .selector-content-item ul:after{height:1px;}

.mui-bar-tab.address {color:#a98865;box-shadow: none;background:transparent;height:1.2rem!important;font-size:0.5rem;}
.mui-bar-tab.address .item{line-height:1.2rem;display:table-cell;background:#fefaee;position:relative;padding-left:0.4rem}
.mui-bar-tab.address .mui-icon-dingwei{margin-right:0.85rem;display:block}
.mui-bar-tab.address .mui-icon-dingwei:before, .address .mui-icon-refresh:before{color:#a98865;margin-right:0.1rem;}
.mui-bar-tab.address .mui-icon-refresh:before{right:0.4rem;position:absolute;top: 50%;display:inline-block;font-size:inherit;text-decoration: none;-webkit-font-smoothing: antialiased;-webkit-transform: translateY(-50%);transform: translateY(-50%);}
.wraper .container .content .mui-badge{line-height:normal;border-radius:0.13rem;padding:0.05rem 0.2rem;font-size:0.36rem;}
.wraper .container .content-media{position:relative}
.wraper .container .content-media .mui-badge{color:#FFF;font-weight:700;position:absolute;bottom:0.2rem;left:0.2rem;background-color: rgba(75,75,75, 0.5);}
.wraper .container .content-media .angle{position: absolute;z-index:1;right:-2.8rem;top:-2.8rem;width:4rem;height:4rem;color:#fff;background:#CCC;transform:rotate(45deg);-ms-transform:rotate(45deg);-moz-transform:rotate(45deg);-webkit-transform:rotate(45deg);-o-transform:rotate(45deg);}
.wraper .container .content-media .angle em{position:absolute;bottom:0.08rem;left:50%;font-size:0.3rem;line-height:1;-webkit-transform: translate(-50%);transform: translate(-50%);}
.wraper .container .content-inner .mui-big{font-weight:700;font-size:180%!important}
.wraper .container .content-inner .mui-badge{color:#fa4c4b!important;background:#fff5f4!important;padding:0 0.15rem;}
.wraper .container .content-inner .mui-badge-outlined:before{border:1px solid #ffc8c2!important;border-radius:0.2rem;}
.wraper .container .content .content-inner p span.mui-del{color:#939393}
</style>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/followed', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/followed', TEMPLATE_INCLUDEPATH));?>
<?php  if($_W['_config']['location']) { ?>
<div class="mui-bar mui-bar-tab address">
	<div class="item mui-ext-icon mui-icon-refresh">
        <span class="mui-icon-dingwei mui-ellipsis"></span>
    </div>
</div>
<?php  } ?>
<div class="mui-content">
	
	<div id="slider" class="mui-slider" style="height:100%">
        <header class="mui-bar mui-bar-nav" style="height:auto;z-index:1000;">
            <div class="nav-inner">
            	<?php  if(empty($keyword)) { ?>
                <div class="inner-item leftbar js-selector" data-popover="selector"><span class="mui-ext-icon mui-icon-angle mui-ellipsis"><?php  echo $catename;?></span></div>
                <?php  } ?>
                <?php  if($_W['_config']['cateswitch'] && empty($keyword)) { ?>
                <div class="inner-item mui-scroll-wrapper mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
                    <div class="mui-scroll ccate">
                        <a class="mui-control-item<?php  if(!$cid) { ?> mui-active<?php  } ?>" href="#item_0" data-pid='<?php  echo $pid;?>' data-cid='0' data-key='0'>全部</a>
                        <?php  if(is_array($children[$pid])) { foreach($children[$pid] as $i => $ccate) { ?>
                        <?php  $key = $i+1;?>
                        <a class="mui-control-item<?php  if($ccate['id']==$cid) { ?> mui-active<?php  } ?>" href="#item_<?php  echo $key;?>" data-pid='<?php  echo $pid;?>' data-cid='<?php  echo $ccate['id'];?>' data-key='<?php  echo $key;?>'><?php  echo $ccate['name'];?></a>
                        <?php  } } ?>
                    </div>
                </div>
                <?php  } else { ?>
                <div class="inner-item search js-popover" data-popover="mui_search">
                	<div class="search-bg">
                    	<span class="search-txt mui-ext-icon mui-icon-sousuo mui-pl10"> <?php  if(!empty($keyword)) { ?><?php  echo $keyword;?><?php  } else { ?>搜全网：如主办方、活动名称<?php  } ?></span>
                    </div>
                </div>
                <?php  } ?>
                <div class="inner-item rightbar mui-ext-icon mui-icon-gengduo-1 js-popover" data-popover="mui_screen"></div>
            </div>
        </header>
        
        <div class="mui-slider-group" style="height:100%">
            <div id="item_0" class="mui-slider-item mui-control-content<?php  if($cid==0) { ?> mui-active<?php  } ?>">
            	<div class="wraper-scroll">
                    <div class="wraper">
                    	<div class="container"></div>
                        <div class="loading"><span>加载中...</span></div>
                    </div>
                </div>
            </div>
            <?php  if(is_array($children[$pid])) { foreach($children[$pid] as $ii => $ccate) { ?>
            <div id="item_<?php  echo $ii+1;?>" class="mui-slider-item mui-control-content<?php  if($ccate['id']==$cid) { ?> mui-active<?php  } ?>">
                <div class="wraper-scroll">
                    <div class="wraper">
                        <div class="container"></div>
                        <div class="loading"><span>加载中...</span></div>
                    </div>
                </div>
            </div>
            <?php  } } ?>
        </div>
	</div>
</div>

<div id="selector" class="mui-popover mui-popover-top mui-radius-none selector-content" style="padding-bottom:0;">
	<div class="selector-content-item">
        <div class="mui-popover-content">
            <div class="mui-row mui-fullscreen" style="overflow:hidden">
                <div class="mui-col-xs-12" style="height:100%;">
                    <div class="scrollbar">
                        <div class="mui-segmented-control mui-segmented-control-inverted mui-segmented-control-vertical">
                            <?php  $i=0;?>
                            <?php  if(is_array($cates)) { foreach($cates as $cate) { ?>
                            <?php  $i++?>
                            <a class="mui-control-item js-cate-check<?php  if($pid==$cate['id']) { ?> mui-active<?php  } ?>" data-pid="<?php  echo $cate['id'];?>" data-key="<?php  echo $i;?>"><?php  echo $cate['name'];?></a>
                            <?php  } } ?>
                        </div>
                    </div>
                </div>
                <div class="mui-col-xs-6" style="height:100%;background:#f5f5f5; display:none">
                <div class="scrollbar">
                    <div class="mui-control-contents">
                    <div id="content0" class="mui-control-content<?php  if(!$pid) { ?> mui-active<?php  } ?>"></div>
                    <?php  $i=0;?>
                    <?php  if(is_array($cates)) { foreach($cates as $cate) { ?>
                    	<?php  $i++?>
                        <div id="content<?php  echo $i;?>" class="mui-control-content<?php  if($pid==$cate['id']) { ?> mui-active<?php  } ?>"><?php  if((!empty($children[$cate['id']]))) { ?>
                            <ul class="mui-table-view" style="max-height:inherit; margin-top:0;">
                            	<li class="mui-table-view-cell js-cate-check<?php  if($pid==$cate['id'] && !$cid) { ?> active<?php  } ?>" data-key="<?php  echo $i;?>" data-pid="<?php  echo $cate['id'];?>" data-cid="0" data-all="1">全部<?php  echo $cate['name'];?></li>
                                <?php  if(is_array($children[$cate['id']])) { foreach($children[$cate['id']] as $ccate) { ?>
                                <li class="mui-table-view-cell js-cate-check<?php  if($cid==$ccate['id']) { ?> active<?php  } ?>" data-key="<?php  echo $i;?>" data-pid="<?php  echo $cate['id'];?>" data-cid="<?php  echo $ccate['id'];?>"><?php  echo $ccate['name'];?></li>
                                <?php  } } ?>
                            </ul>
                        <?php  } ?></div>
                    <?php  } } ?>
                    </div>
                </div>
                </div>
        	</div>
        </div>
    </div>
</div>

<div id="mui_screen" class="mui-popover mui-popover-left">
	<input type="hidden" name="order" value="0"/>
    <input type="hidden" name="pricetype" value="0"/>
    <input type="hidden" name="status" value="0"/>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
            	<div style="background:#FFF;line-height:3;margin-top:10px"><span class="mui-content-padded">排序</span></div>
            	<ul class="mui-table-view mui-group-btn mui-table-view-radio">
                    <li class="mui-table-view-cell mui-selected"><a class="mui-border mui-navigate-left" data-order="0">综合排序</a></li>
                    <li class="mui-table-view-cell"><a class="mui-border mui-navigate-left" data-order="1">最新发布</a></li>
                    <li class="mui-table-view-cell"><a class="mui-border mui-navigate-left" data-order="2">人气最高</a></li>
                    <?php  if($_W['_config']['location']) { ?><li class="mui-table-view-cell"><a class="mui-border mui-navigate-left" data-order="3">离我最近</a></li><?php  } ?>
                </ul>
                <?php  if($_W['_config']['wechatstatus']==2 || $_W['_config']['creditpay'] || $_W['_config']['deliverystatus']==2) { ?>
                <div style="background:#FFF;line-height:3;margin-top:10px"><span class="mui-content-padded">费用</span></div>
                <ul class="mui-table-view mui-group-btn mui-table-view-radio">
                    <li class="mui-table-view-cell mui-selected"><a class="mui-border mui-navigate-left" data-price="0">全部</a></li>
                    <li class="mui-table-view-cell"><a class="mui-border mui-navigate-left" data-price="1">只看免费</a></li>
                    <li class="mui-table-view-cell"><a class="mui-border mui-navigate-left" data-price="2">只看收费</a></li>
                </ul>
                <?php  } ?>
                <div style="background:#FFF;line-height:3;margin-top:10px"><span class="mui-content-padded">活动状态</span></div>
                <ul class="mui-table-view mui-group-btn mui-table-view-radio">
                    <li class="mui-table-view-cell mui-selected"><a class="mui-border mui-navigate-left" data-status="0">不限</a></li>
                    <li class="mui-table-view-cell"><a class="mui-border mui-navigate-left" data-status="1"><?php  echo $_W['_config']['buytitle'];?>中</a></li>
                    <li class="mui-table-view-cell"><a class="mui-border mui-navigate-left" data-status="2">未开始</a></li>
                    <li class="mui-table-view-cell"><a class="mui-border mui-navigate-left" data-status="3">已结束</a></li>
                </ul>
                </div>
        </div>
    </div>
    <div class="mui-btn-group">
    	<button type="button" class="mui-btn mui-btn-yellow mui-pull-right submit">确定</button>
    	<button type="button" class="mui-btn mui-btn-default mui-pull-right reset">重置</button>
    </div>
</div>
<div class="floatbar rlower">
	<a class="btn mui-ext-icon mui-icon-fanhui3" href="<?php  echo app_url('home')?>"></a>
    <div class="backtop mui-ext-icon mui-icon-top" onclick="javascript:$('.mui-slider-item.mui-active .wraper-scroll').scrollTop(0)"></div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH));?>
<script type="text/html" id="tpl_ccate">
<a class="mui-control-item" href="#item_{{d.key}}" data-pid="{{d.pid}}" data-cid="{{d.id}}" data-key="{{d.key}}">{{d.name}}</a>
</script>
<script type="text/html" id="tpl_group">
<div id="item_{{d.key}}" class="mui-slider-item mui-control-content">
    <div class="wraper-scroll">
        <div class="wraper">
            <div class="container"></div>
			<div class="loading" style="display: none;"><span>加载中...</span></div>                        
        </div>
    </div>
</div>
</script>
<script id="tpl" type="text/html">
	<@for(i=0;i<list.length;i++){@>
	<div class="box" style="transition-delay: <@=i/50@>s;">
		<a href="<?php  echo app_url('activity/detail')?>&id=<@=list[i].id@>">
			<div class="content clearfix">
				<div class="content-media" style="height:<@=list[i].thumb_h@>px">
					<img src="<@=list[i].thumb@>">
					<span class="mui-badge">
					<@if(list[i].hasonline!=1){@>
						<@=list[i].adinfo@><@if(list[i].adinfo!=''){@> • <@=list[i].distance@><@}@>
					<@}else{@>
						线上活动
					<@}@>
					</span>
					<@if(list[i].tpl_angle!=''){@>
						<@=list[i].tpl_angle@>
					<@}@>
				</div>
				<div class="content-inner">
					<p class="mui-ellipsis-2"><b><@=list[i].title@></b></p>
					<p class="mui-ellipsis"><span><@=list[i].intro@></span></p>
					<p>
					<@if(list[i].price > 0){@>
						<span class="mui-text-danger">
							<b class="mui-rmb"></b>
							<font class="mui-big"><@=list[i].aprice@></font><@if(list[i].hasoption==1){@> 起<@}@>
						</span>
						<@if(list[i].mprice > 0){@> 
							<span class="mui-rmb mui-del"><@=list[i].mprice@></span> 
							<span class="mui-badge mui-badge-outlined" style="position:relative; top:-0.06rem">已减<@=(list[i].mprice-list[i].aprice).toFixed(2)@>元</span>
						<@}@>
						<@if(list[i].iscard){@>
							<@if(list[i].prize.cardper.enable==1){@> 
								<span class="mui-badge mui-badge-outlined" style="position:relative; top:-0.06rem"><?php  echo $yearcard["name"];?><@=list[i].prize.cardper.percent@>折</span>
							<@}else{@> 
								<span class="mui-badge mui-badge-outlined" style="position:relative; top:-0.06rem"><?php  echo $yearcard["name"];?><@=list[i].costprice@>元起</span>
							<@}@>
						<@}@>
					<@}else{@>
						<span class="mui-badge mui-badge-outlined"><@=list[i].freetitle@></span>
					<@}@>
					</p>
				</div>
				<div class="content-footer">
					<@if(list[i].switch.joinnum==1){@><span class="footer-link">已<?php  echo $_W['_config']['buytitle'];?><@=list[i].joinnum@><@if(list[i].gnumshow==1){@> | <@=list[i].rstock@><@}@></span><@}@>
					<span class="footer-link"></span>
				</div>
			</div>			
		</a>		
	</div>
	<@}@>
</script>
<script src="<?php echo FX_BASE;?>app/resource/js/waterfall/baiduTemplate.min.js"></script>
<script src="<?php echo FX_BASE;?>app/resource/js/waterfall/waterfall.js?v=1.0.2"></script>
<?php  if($_W['_config']['location']) { ?>
<script>
$('#ucity a').text(position.ucity ? position.ucity : '定位中...');
$('.address p').html(position.addr ? position.addr : '正在获取位置......');
$('.mui-bar-tab.address span').html(position.addr ? position.addr : '正在获取位置......');
$('.mui-bar-tab.address').on('tap',function(){
	$('.address p').html('正在获取位置......');
	$('.mui-bar-tab.address span').html('正在获取位置......');
	util.location(function(res) {
		$('.address p').html(res.addr);
		$('.mui-bar-tab.address span').html(res.addr);
	})
});
</script>
<?php  } ?>
<script>
//屏蔽slider选项卡弹出遮罩
$('.mui-slider').delegate('.mui-control-item','tap', function(e) {
	setTimeout(function(){$('.mui-backdrop').remove()});
	$("body").addClass('mui-backdrop-none');
});
var key=<?php  echo $item;?>,pid=<?php  echo $pid;?>,cid=<?php  echo $cid;?>,
	headerH   = $('.mui-bar.mui-bar-nav').height(),
	children  = <?php  echo json_encode($children)?>;
$('.mui-slider-group').css('padding-top', (headerH / htmlFont + 0.4) + 'rem');
$('.selector-content').css('top', headerH / htmlFont + 'rem');
mui('.scrollbar').scroll({indicators: false});
//加载数据方法
function getLoads(){
	var curr = 1
	$item = $("#item_"+key),
	ordertype = $("#mui_screen input[name='order']").val(),
	pricetype = $("#mui_screen input[name='pricetype']").val(),
	status = $("#mui_screen input[name='status']").val();
	waterfall({
		wraper: $("#item_"+key).find('.wraper'),
		scrollArea: $("#item_"+key).find('.wraper-scroll'),
		loadDown: function(ele){			
			$.post("<?php  echo app_url('activity/ajax',array('keyword' => $keyword))?>", {page:curr,parentid:pid,childid:cid,ordertype:ordertype,pricetype:pricetype,status:status,lat:position.lat,lng:position.lng,ucity:position.ucity}, function(data){
				//console.log(key);
				if (curr > data.tpage || data.tpage == 0){
					if (data.tpage == 0){
						ele.noData();
					}else{
						ele.lock();
					}
					return false;
				}
				var systime = new Date();
				for(var i = 0; i < data.list.length; i++){
					joinstime = new Date(data.list[i].joinstime.replace("-", "/").replace("-", "/"));
					joinetime = new Date(data.list[i].joinetime.replace("-", "/").replace("-", "/"));
					starttime = new Date(data.list[i].starttime.replace("-", "/").replace("-", "/"));
					endtime   = new Date(data.list[i].endtime.replace("-", "/").replace("-", "/"));
					var joinnum  = parseInt(data.list[i].joinnum),
						gnum    = parseInt(data.list[i].gnum);
					if (systime > endtime){
						data.list[i].tpl_angle = '<span class="angle"><em>已结束</em></span>';
					}else{
						if (joinnum >= gnum && gnum > 0){
							data.list[i].tpl_angle = '<span class="angle"><em>已满</em></span>';
						}else{
							data.list[i].tpl_angle = joinstime > systime ? '<span class="angle mui-btn-orange"><em>预热中</em></span>' : (systime>joinetime ? '<span class="angle"><em>已截止</em></span>':'');
						}						
					}
					if (data.list[i].adinfo!='' ){
						var adlist = data.list[i].adinfo.split(',');
						adlist[2] = adlist[2]!="" && adlist[2]!=undefined ? adlist[2].replace('市', ""):'';
						adlist[3] = adlist[3]!="" && adlist[3]!=undefined ? adlist[3]:'';
						data.list[i].adinfo = position.ucity != '全国' ? adlist[3] : adlist[2] + adlist[3];
					}else{
						data.list[i].adinfo = '';
					}
					data.list[i].thumb_h = ($('body').width() * 0.97 * 0.4688 * (data.list[i].thumbsize[1]/data.list[i].thumbsize[0])).toFixed(2);
				}
				
				wxf.tpl.ESCAPE = false;
				var $tpl=wxf.tpl('tpl', data);
				$("#item_"+key).find('.container').css('height', '100%').append($tpl);
				setTimeout(function(){
					 $("#item_"+key).find('.container').find('.box').addClass('ani');
				}, 50);
				
				curr++;
				if (data.tpage==1){
					ele.lock();
				}else{
					ele.resetload();
				}
				ele.location();
			},"json");
		}
	});	
}
//初始化数据
getLoads();

$(function() {
	var winW = $(window).width(),winH = $(window).height(),iTime = 0;
	//弹窗控制器
	$(".js-selector").on("tap",function(e) {
		var popover = "#"+$(this).data("popover"),
			checked = document.querySelector('.selector-content.mui-active'),
			selectorH;
		$(popover).show();
		$(popover).find('.selector-content-item').fadeIn(800);
		selectorH = $(popover).find('.mui-fullscreen .mui-segmented-control').height();
		if (!checked){
			$(popover).css({'-webkit-transition':'height 0.65s ease-in-out',transition:'height 0.65s ease-in-out'});
			mui(popover).popover('toggle');
			if ((winH*0.75-50) >= selectorH){
				$(popover).css("height",selectorH+10+'px');
			}else{
				$(popover).css("height",(winH*0.75-50)+'px');
			}			
		}else{
			init.selector(iTime);
		}
		$('.mui-backdrop').css('top', headerH / htmlFont + 'rem');
	});	
	//分类控制
	<?php  if($_W['_config']['cateswitch']) { ?>
	//监听slide
	document.getElementById('slider').addEventListener('slide', function(e) {
		key = parseInt(e.detail.slideNumber);
		pid = $('#slider .mui-control-item').eq(key).data("pid");
		cid = $('#slider .mui-control-item').eq(key).data("cid");
		if ($('.mui-slider-item.mui-active .wraper-scroll').scrollTop() >= 500) {
			$(".backtop").addClass('head-backtop-show');
		} else {
			$(".backtop").removeClass('head-backtop-show');
		}
		loadChild(pid,cid,key);
	});
	//分类选择
	$('#selector .js-cate-check').on('tap',function(e) {
		key = 0;
		pid = $(this).data("pid");
		cid = 0;
		
		var tpl_ccate = document.getElementById('tpl_ccate').innerHTML,
			tpl_group = document.getElementById('tpl_group').innerHTML;
		$('.js-selector span').text($(this).text());
		$('.ccate').css('transform','translate3d(0px,0px,0px) translateZ(0px)').html('<a class="mui-control-item mui-active" href="#item_0" data-pid="'+pid+'" data-cid="0" data-key="0">全部</a>');
		$('.mui-slider-group').css('transform','translate3d(0px,0px,0px) translateZ(0px)').html('<div id="item_0" class="mui-slider-item mui-control-content"><div class="wraper-scroll"><div class="wraper"><div class="container"></div><div class="loading" style="display: none;"><span>加载中...</span></div></div></div></div>');
		if (children[pid]!=undefined){
			for(var i = 0; i < children[pid].length; i++){
				children[pid][i].pid = pid;
				children[pid][i].key = i+1;
				laytpl(tpl_ccate).render(children[pid][i], function(data){
					$('.ccate').append(data);
				});
				laytpl(tpl_group).render(children[pid][i], function(data){
					$('.mui-slider-group').append(data);
				});
			}
		}
		getLoads();
		mui('#slider').slider().gotoItem(0);
		init.selector(iTime);
		init.headroom();
		history.back(-1);
	});
	<?php  } ?>
	//筛选控制
	$('#mui_screen button').on("tap",function(e) {
		if ($(this).hasClass('reset')){
			$("#mui_screen input[name='order']").val(0);
			$("#mui_screen input[name='pricetype']").val(0);
			$("#mui_screen input[name='status']").val(0);
			$('#mui_screen li').removeClass('mui-selected');
			$('#mui_screen ul').each(function(){
				$(this).find('li').eq(0).addClass('mui-selected');
			});
			return false;
		}
		mui('#mui_screen').popover('hide');
		history.back(-1);
		if ($('header .mui-control-item').length){//判断是否开启分类功能
			key = $('.mui-control-item.mui-active').data("key");
			pid = $('.mui-control-item.mui-active').data("pid");
			cid = $('.mui-control-item.mui-active').data("cid");
			
		}
		$('#mui_screen li.mui-selected a').each(function(){
			if ($(this).data('order')!=undefined){
				$("#mui_screen input[name='order']").val($(this).data('order'));
			}
			if ($(this).data('price')!=undefined){
				$("#mui_screen input[name='pricetype']").val($(this).data('price'));
			}
			if ($(this).data('status')!=undefined){
				$("#mui_screen input[name='status']").val($(this).data('status'));
			}
		});
		setTimeout(function() {
			if ($('header .mui-control-item').length){//判断是否开启分类功能
				loadChild(pid,cid,key);
			}else{
				$('#item_'+key).find('.container').html('');
				$('#item_'+key).find('.loading span').text('加载中...');
				getLoads();
			}
		},100);
	});
	//单击空白关闭弹窗出发事件
	$('body').delegate('.mui-backdrop','tap', function(e) {
		init.selector(iTime);
		if ($('#mui_screen').hasClass('mui-active')) {
			$("#mui_screen ul").find('li').removeClass('mui-selected');
			$("#mui_screen input").each(function(i){
				$("#mui_screen ul").eq(i).find('li').eq($(this).val()).addClass('mui-selected');
			});
		}		
	});
	init.headroom();
});

<?php  if($_W['_config']['cateswitch']) { ?>
var old_screen = new Array(),cid_arr = new Array();
var loadChild = function(pid,cid,key){
	var get_screen = new Array();
	$("#mui_screen input").each(function(i){
		get_screen[i] = $(this).val();
	});
	old_screen[key] = !old_screen[key] ? '0,0,0' : old_screen[key];
	if ($('#item_'+key).find('.container').text()=='' || get_screen.toString() != old_screen[key].toString()){
		$('#item_'+key).find('.container').html('');
		$('#item_'+key).find('.loading span').text('加载中...');
		getLoads();
	}
	old_screen[key] = get_screen;
};
<?php  } ?>

var init = {
	selector:function(iTime){
		clearTimeout(iTime);
		$('#selector').css('transition','transform .45s,opacity .45s');
		$('#selector .selector-content-item').fadeOut(200);
		mui('#selector').popover('hide');
		iTime = setTimeout(function(){
				$('#selector').css("height",0);
		}, 200);
	},
	headroom:function(){
		$(".mui-bar.address").headroom({
			scrollArea:'.mui-slider-group .wraper-scroll',
			distance:100,
			classes: {
				initial: "head-slide",
				pinned: "head-slide-reset",
				unpinned: "head-slide-down"
			}
		});
	},
}

//格式化日期
Date.prototype.format = function(format) {
    var o = {
        "M+": this.getMonth() + 1,
        "d+": this.getDate(),
        "h+": this.getHours(),
        "m+": this.getMinutes(),
        "s+": this.getSeconds(),
        "q+": Math.floor((this.getMonth() + 3) / 3),
        "S": this.getMilliseconds()
    }
    if (/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return format;
}
$('.mui-slider-item .wraper-scroll').on('scroll',function() {
	if ($(this).scrollTop() >= 500) {
		$(".backtop").addClass('head-backtop-show');
	} else {
		$(".backtop").removeClass('head-backtop-show');
	}
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>