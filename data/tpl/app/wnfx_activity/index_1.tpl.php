<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="<?php echo FX_BASE;?>app/resource/css/index.css?v=1.0.1">
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/followed', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/followed', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/nav', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/nav', TEMPLATE_INCLUDEPATH));?>
<div class="mui-content">         
    <div class="header-inner">
    	<div class="inner-content<?php  if(!$_W['_config']['probtn'] && !$_W['_config']['citys'] && !$_W['_config']['search']) { ?> mui-pt0<?php  } ?>">
        	<?php  if($_W['_config']['probtn'] || $_W['_config']['citys'] || $_W['_config']['search']) { ?>
            <header class="mui-bar mui-bar-nav mui-after-no<?php  if(empty($advlist)) { ?> reset<?php  } ?>">
            	<?php  if($_W['_config']['citys'] || $_W['_config']['search']) { ?>
                <div class="mod-search"<?php  if($_W['_config']['probtn']) { ?> style="width:<?php echo $_W['_config']['search']?90:23?>%;margin-left:0;"<?php  } ?>>
                    <?php  if($_W['_config']['citys']) { ?><span class="search-city mui-ext-icon mui-icon-angle<?php  if(!$_W['_config']['search']) { ?> mui-before-no<?php  } ?>" id="ucity"><a class="mui-ellipsis" href="<?php  echo app_url('utility/city')?>"></a></span><?php  } ?>
                    <?php  if($_W['_config']['search']) { ?><span class="search-keywords mui-ext-icon mui-icon-sousuo js-popover" data-popover="mui_search">&nbsp;&nbsp;输入主办方、或感兴趣的活动</span><?php  } ?>
                </div>
                <?php  } ?>
                <?php  if($_W['_config']['probtn']) { ?>
                <a class="mod-faqi" href="<?php  echo app_url('member/project/post')?>"><p class="mui-ext-icon mui-icon-jiahao"></p>发布</a>
                <?php  } ?>
            </header>
            <?php  } ?>
            <?php  if(count($advlist) > 0) { ?>
            <div class="mui-slider" id="slider1">
                <div class="mui-slider-group mui-slider-loop">
                    <!--支持循环，需要重复图片节点-->
                    <?php  if(is_array(array_reverse($advlist))) { foreach(array_reverse($advlist) as $adv) { ?>
                    <div class="mui-slider-item mui-slider-item-duplicate" data-bg="<?php  echo $adv['color'];?>">
                    <a href="<?php  echo $adv['link'];?>"><img src="<?php  echo tomedia($adv['thumb'])?>" /></a></div>
                    <?php  break;?>
                    <?php  } } ?>
                    <?php  if(is_array($advlist)) { foreach($advlist as $adv) { ?>
                    <div class="mui-slider-item"  data-bg="<?php  echo $adv['color'];?>">
                    <a href="<?php  echo $adv['link'];?>"><img src="<?php  echo tomedia($adv['thumb'])?>" /></a></div>
                    <?php  } } ?>
                    <!--支持循环，需要重复图片节点-->
                    <?php  if(is_array($advlist)) { foreach($advlist as $adv) { ?>
                    <div class="mui-slider-item mui-slider-item-duplicate" data-bg="">
                    <a href="<?php  echo $adv['link'];?>"><img src="<?php  echo tomedia($adv['thumb'])?>" /></a></div>
                    <?php  break;?>
                    <?php  } } ?>
                </div>
                <?php  if(count($advlist) > 1) { ?>
                <div class="mui-slider-indicator">
                    <?php  if(is_array($advlist)) { foreach($advlist as $k => $adv) { ?>
                    <div class="mui-indicator<?php  if($k==0) { ?> mui-active<?php  } ?>"></div>
                    <?php  } } ?>
                </div>
                <?php  } ?>
            </div>
            <script>
                var bgcolor = $('#slider1 .mui-slider-item').eq(1).data('bg'), gallery = mui('.mui-slider');
                <?php  if(count($advlist) > 1) { ?>gallery.slider({interval:2000});<?php  } ?>		
                $('.inner-content').css({'background':bgcolor});
                document.getElementById('slider1').addEventListener('slide', function(e) {
                    var num = e.detail.slideNumber + 1;
                    //console.log($(e.target).find('.mui-active').data('bg'));
                    if ($(".mui-content").scrollTop()<5) bgcolor = $("#slider1 .mui-slider-item").eq(num).data('bg');
                    $('.inner-content').css({'background':$("#slider1 .mui-slider-item").eq(num).data('bg')});
                    //$('.inner-content').animate({backgroundColor: "#aa0000"}, 1000 );
                });
                $('.mui-content').on('scroll',function() {
                    if ($(".mui-content").scrollTop() >= 5) {
                        $("header").addClass('reset');
                    } else {
                        $("header").removeClass('reset');
                    }	
                });
            </script>
            <div class="bottom_bg"></div>
            <?php  } ?>
        </div>
    </div>    
        
    <div class="main-inner">
        <?php  if($_W['_config']['cateswitch'] && $_W['_config']['catesindex']) { ?>
        <div class="mod-cate">
            <div class="mui-slider">
                <div class="mui-slider-group">                    
                    <div class="mui-slider-item">
                        <ul class="mui-table-view mui-grid-view mui-grid-9">
                            <?php  if(is_array($catePro['0'])) { foreach($catePro['0'] as $k => $v) { ?>
                            <li class="mui-table-view-cell mui-media<?php  if($_W['_config']['caterow']) { ?> mui-col-xs-2 mui-col-sm-2<?php  } ?>">
                                <a href="<?php echo !empty($v['redirect'])?$v['redirect']:app_url('activity',array('pid'=>$v['parentid']?$v['parentid']:$v['id'],cid=>$v['parentid']?$v['id']:0))?>"><span class="mui-category-ico"><img width='100%' height="100%" src="<?php  echo tomedia($v['thumb']);?>" /></span><div class="mui-media-body"><?php  echo $v['name'];?></div></a>
                            </li>
                            <?php if(!fmod($k+1,$_W['_config']['caterow']?10:5) && ($k+1<$catePro[2] || ($k+1==$catePro[2] && $_W['_config']['catemore']))) { ?></ul></div><div class="mui-slider-item"><ul class="mui-table-view mui-grid-view mui-grid-9"><?php  } ?>
                            <?php  } } ?>
                            <?php  if($_W['_config']['catemore']) { ?>
                            <li class="mui-table-view-cell mui-media<?php  if($_W['_config']['caterow']) { ?> mui-col-xs-2 mui-col-sm-2<?php  } ?>">
                                <a class="js-popover" data-popover="category">
                                <span class="mui-category-ico"><img width='100%' height="100%" src="<?php  echo $catemoreico;?>?v=20190415002" /></span>
                                <div class="mui-media-body">全部</div>
                                </a>
                            </li>
                            <?php  } ?>
                        </ul>
                    </div>
                </div>
                <div class="mui-slider-indicator">
                    <?php  if(is_array($catePro['0'])) { foreach($catePro['0'] as $kk => $v) { ?>
                    <?php  if($kk==0) { ?><div class="mui-indicator mui-active"></div><?php  } ?>
                    <?php if(!fmod($kk+1,$_W['_config']['caterow']?10:5) && ($kk+1<$catePro[2] || ($kk+1==$catePro[2] && $_W['_config']['catemore']))) { ?><div class="mui-indicator"></div><?php  } ?>
                    <?php  } } ?>
                </div>
            </div>     
        </div>       
        <?php  } ?>
        
        <div class="mui-card mui-afterbefore-no" id="hot">
        	<div class="mui-card-header mui-text-center"><b>精选活动</b></div>
        	<div class="mui-card-content">
                <div class="mui-card-content-inner" id="hotlist">
                	
                </div>
                <div class="mui-card-footer hot-reload">
                	<span class="mui-text-yellow">换一换</span><span class="mui-text-yellow mui-icon mui-icon-reload"></span>
                </div>
            </div>
        </div>
        
        <?php  if($_W['plugin']['card']['config']['card_enable'] && $_W['plugin']['card']['config']['index_enable']) { ?>
        <div class="mui-card mui-afterbefore-no card">
            <div class="mui-card-header">
            <a href="<?php echo $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=cardfans&m=' . PLUGIN_CARD;?>" class="mui-navigate-right"><h5><b>会员卡</b></h5><span class="mui-badge mui-badge-inverted">开通会员</span></a></div>
            <div class="mui-card-content">
                <div class="mui-card-content-inner" style="height:4.95rem;">
                    <a href="<?php echo $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=cardfans&m=' . PLUGIN_CARD;?>">
                    <img height="100%" src="<?php  if($yearcard['thumb']) { ?><?php  echo tomedia($yearcard['thumb'])?><?php  } else { ?>../addons/wnfx_activity/web/resource/images/card/1.png?v=20191111<?php  } ?>" />
                    <div class="card-info">
                        <h4>会员权益</h4>
                        <div class="info-list mui-small">
                            <ul>
                                <li>可享受活动专享折扣</li>
                                <li>可享受活动免单</li>
                                <?php  if($_W['plugin']['card']['config']['credit_double']) { ?><li><?php  echo m('member')->getCreditName('credit1')?>奖励翻倍</li><?php  } ?>
                            </ul>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <?php  } ?>
        
        <div id="prolist" class="mui-card mui-afterbefore-no">        	
            <div class="mui-card-content">
                <ul class="mui-table-view"></ul>
            </div>
        </div>
        
	</div>
</div>
<div class="floatbar rlower">
	<div class="backtop mui-ext-icon mui-icon-top head-backtop" onclick="javascript:$('.mui-content').scrollTop(0)"></div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH));?>
<script type="text/html" id="tpl_hot">
<div class="hot-item">
<a href="<?php  echo app_url('activity/detail')?>&id={{d.id}}">
<div class="media">
	<img class="media" src="{{d.thumb}}" width="100%">
</div>
<p class="mui-ellipsis-2">{{d.title}}</p>
<p class="mui-small mui-text-gray"><span>{{d.starttime}}</span>{{# if(d.tpl_price!=''){ }}<span class="mui-pull-right">{{d.tpl_price}}</span>{{# } }}</p>
</a>
</div>
</script>
<script type="text/html" id="tpl_list">
<li class="mui-table-view-cell mui-media" style="display:none">
	<a href="<?php  echo app_url('activity/detail')?>&id={{d.id}}">
		{{# if(d.tpl_atlas==''){ }}<div class="mui-media-object mui-pull-right"><img height="100%" width="100%" src="{{d.thumb}}" ></div>{{# } }}
		<div class="mui-media-body">
			<div class="body-title mui-ellipsis"><b>{{d.title}}</b></div>
			<div class="body-con mui-small">
				<p>{{d.tpl_status}}
				{{# if(d.switch.joinnum==1){ }} | <span>已<?php  echo $_W['_config']['buytitle'];?> {{d.joinnum}} 人</span>{{# } }}
				{{# if(d.gnumshow==1){ }} | <span>剩余名额:{{d.tpl_gnum}}</span>{{# } }}
				<?php  if($_W['_config']['location']) { ?>{{# if(d.hasonline!=1){ }}<span class="mui-pull-right">{{d.distance}}</span>{{# } }}<?php  } ?>
				</p>
				<p class="mui-ellipsis">{{d.intro}}</p>
				<p>
					{{d.tpl_price}}
					{{# if(d.mprice>0){ }}<span class="mui-rmb mui-del">{{d.mprice}}</span>{{# } }}
					{{# if(d.iscard>0){ }}<span class="mui-badge gradient"><?php  echo $yearcard["name"];?>{{d.tpl_costprice}}</span>{{# } }}
					{{# if(d.tpl_price==''){ }}<span class="mui-badge inverted">{{d.freetitle}}</span>{{# } }}
					{{# if(d.hasonline==1){ }}<span class="mui-badge inverted">线上活动</span>{{# } }}
				</p>
			</div>
			{{# if(d.tpl_atlas!=''){ }}
			<div class="body-atlas">
				{{d.tpl_atlas}}
			</div>
			{{# } }}
		</div>
		{{d.tpl_angle}}
	</a>	
</li>
</script>
<script>
<?php  if($_W['_config']['citys']) { ?>
$('#ucity a').text(position.ucity ? position.ucity : '定位中...');
<?php  } ?>
mui('.wrapper').scroll({
	scrollY: false, //是否竖向滚动
	scrollX: true, //是否横向滚动
	indicators: false, //是否显示滚动条
});
var hotData = new Array(),tplhot = document.getElementById('tpl_hot').innerHTML;
$.getJSON("<?php  echo app_url('home/hot')?>", {page:1,lat:position.lat,lng:position.lng,ucity:position.ucity}, function(data) {
	hotData = data;
	console.log(data);
	$("#hotlist").html(loadData(data));
	if (data.tpage>0){
		$("#hot").fadeIn();
	}
});

var headerH = $('.header-inner').height(),thispage=1;
//上拉加载活动列表
$('.mui-content').dropload({
	scrollArea : $('.mui-content'),
	threshold : 100,
	loadDownFn : function(me){
		mui.getJSON("<?php  echo app_url('home/getlist')?>", {page:thispage,lat:position.lat,lng:position.lng,ucity:position.ucity}, 
		function(data){
			var stime = new Date(), result='', gettpl = document.getElementById('tpl_list').innerHTML;
			
			if (data.tpage == 0){
				result = '<li class="mui-table-view-cell"><p style="text-align:center">当前没有数据</p><li>';
			}
			if (thispage >= data.tpage || data.tpage == 0){
				me.lock();// 锁定
				me.noData();// 无数据
			}
			for(var i = 0; i < data.list.length; i++){
				joinstime = new Date(data.list[i].joinstime.replace("-", "/").replace("-", "/"));
				joinetime = new Date(data.list[i].joinetime.replace("-", "/").replace("-", "/"));
				starttime = new Date(data.list[i].starttime.replace("-", "/").replace("-", "/"));
				endtime   = new Date(data.list[i].endtime.replace("-", "/").replace("-", "/"));
				
				var joinnum = parseInt(data.list[i].joinnum),
				gnum  = parseInt(data.list[i].gnum),
				aprice = data.list[i].aprice,
				costprice   = data.list[i].costprice,
				minprice = data.list[i].minprice,
				maxprice = data.list[i].maxprice,
				hasonline = parseInt(data.list[i].hasonline);
				if (stime > endtime){
					data.list[i].tpl_status = '<span style="color:#b6b6b6;">已结束</span>';
					data.list[i].tpl_angle = '<div id="angle"><em>已结束</em></div>';
				}else{
					if (joinnum >= gnum && gnum > 0){
						data.list[i].tpl_status = '<span class="mui-badge" style="color:#b6b6b6;">名额已满</span>';
						data.list[i].tpl_angle = '<div id="angle"><em>已满</em></div>';
					}else{						
						data.list[i].tpl_status = joinstime > stime ? '<span style="color:#ff4934;">预热中</span>' : (stime>joinetime ? '<span style="color:#b6b6b6;">已截止</span>': '<span style="color:#fe9900;"><?php  echo $_W['_config']['buytitle'];?>中</span>');
						data.list[i].tpl_angle = joinstime > stime ? '<div id="angle" class="gradient"><em>预热中</em></div>' : (stime>joinetime ? '<div id="angle"><em>已截止</em></div>':'<div id="angle" style="background:#feda00;color:#72400b;"><em><?php  echo $_W['_config']['buytitle'];?>中</em></div>');
					}						
				}
				data.list[i].tpl_price = aprice > 0 ? '<span class="mui-text-rmb mui-rmb"><font class="mui-big"><b>' + aprice + '</b></font></span>':'';
				data.list[i].tpl_price = maxprice.aprice > 0 ?'<span class="mui-text-rmb mui-rmb"><font class="mui-big"><b>' + minprice.aprice + '</b></font><font class="mui-small">起</font></span>':data.list[i].tpl_price;
				
				if (data.list[i].prize!=null && data.list[i].prize.cardper!=undefined && data.list[i].prize.cardper.enable==1){
					data.list[i].tpl_costprice = ' '+data.list[i].prize.cardper.percent+' 折';
				}else{
					data.list[i].tpl_costprice = costprice > 0 || maxprice.costprice > 0 ? ' ¥'+(maxprice.costprice?minprice.costprice+' 起':costprice+' 元') : '免单';
				}
				
				data.list[i].tpl_gnum = gnum>0?(gnum-joinnum)+' 人':' 不限';
				
				data.list[i].tpl_atlas='';
				if (data.list[i].atlas!=null){
					if (data.list[i].atlas.length>2){
						$.each(data.list[i].atlas, function(k, atlas) {
							data.list[i].tpl_atlas+='<img src="'+atlas+'">';
							if (k == 2) return false;
						});
					}
				}
				laytpl(gettpl).render(data.list[i], function(html){
					$("#prolist").find('.mui-table-view').append(html);
					$("#prolist").find('.mui-table-view .mui-table-view-cell').fadeIn();
				});
			}
			
			//$(id).find('.list-content').append(result);
			thispage++;
			// 每次数据加载完，必须重置
			me.resetload();
		});
	}
});
$('.mui-content').on('scroll',function() {
	if ($(this).scrollTop() >= 500) {
		$(".backtop").addClass('head-backtop-show');
	} else {
		$(".backtop").removeClass('head-backtop-show');
	}	
});
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
$('.hot-reload').on('tap',function reload() {
	$("#hotlist").html(loadData(hotData));
});
function loadData(data) {
	var data = hotData,conthtml='',len=data.list.length,iArray =[],num = parseInt("<?php  echo $_W['_config']['home']['recom'];?>");
	num = num?num:3;
	for(var i=0;i<len;i++){//一个从0到len的数组
		iArray.push(i);
	}
	iArray.sort(function(){//随机打乱这个数组
		return Math.random()-0.5;
	})
	$.each(iArray,function(index,i){
		var aprice = data.list[i].aprice,
		costprice   = data.list[i].costprice,
		minprice = data.list[i].minprice,
		maxprice = data.list[i].maxprice;
		starttime = new Date(data.list[i].starttime.replace("-", "/").replace("-", "/"));
		endtime   = new Date(data.list[i].endtime.replace("-", "/").replace("-", "/"));
		data.list[i].tpl_price = aprice > 0 || maxprice.aprice > 0 ?'<font class="mui-rmb mui-small"></font>'+(maxprice.aprice ? minprice.aprice + ' <i class="mui-small">起</i>':aprice):data.list[i].freetitle;		
		data.list[i].starttime = starttime.format('MM-dd hh:mm');
		laytpl(tplhot).render(data.list[i], function(html){
			conthtml = conthtml + html;
		});
		if (index==num) return false;
	});
	return conthtml;
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>