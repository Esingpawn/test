<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="<?php echo FX_BASE;?>app/resource/css/index.css?v=1.0.1">
<link rel="stylesheet" href="<?php echo FX_BASE;?>app/resource/js/waterfall/waterfall.css?v=1.0.5">
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
                    <img height="100%" src="<?php  if($yearcard['thumb']) { ?><?php  echo tomedia($yearcard['thumb'])?><?php  } else { ?>../addons/wnfx_activity/web/resource/images/card/1.png?v=20191111<?php  } ?>"/>
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
        <p class="bgtitle"><b>猜你喜欢</b></p>
        <div class="wraper">
            <div class="container"></div>
            <div class="loading"><span>加载中...</span></div>
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
<script id="tpl" type="text/html">
	<@for(i=0;i<list.length;i++){@>
	<div class="box" style="transition-delay: <@=i/50@>s;">
		<a href="<?php  echo app_url('activity/detail')?>&id=<@=list[i].id@>">
			<div class="content clearfix">
				<div class="content-media" style="height:<@=list[i].thumb_h@>px">
					<img src="<@=list[i].thumb@>">
					<span class="mui-badge">
					<@if(list[i].hasonline!=1){@>
						<@=list[i].adinfo@><@if(list[i].distance!=0){@> • <@=list[i].distance@><@}@>
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
					<p class="mui-ellipsis-2 desc"><span><@=list[i].intro@></span></p>
					<p>
					<@if(list[i].aprice > 0){@>
						<span class="mui-text-danger">
							<b class="mui-rmb"></b>
							<font class="mui-big"><@=list[i].aprice@></font><@if(list[i].hasoption==1){@> 起<@}@>
						</span>
						<@if(list[i].mprice > 0){@> 
							<span class="mui-rmb mui-del"><@=list[i].mprice@></span> 
							<span class="mui-badge mui-badge-outlined" style="position:relative; top:-0.06rem">已减<@=(list[i].mprice-list[i].aprice).toFixed(2)@>元</span>
						<@}@>
						<@if(list[i].iscard!='0'){@>
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
<script src="<?php echo FX_BASE;?>app/resource/js/waterfall/waterfall.js?v=1.0.4"></script>
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
	//console.log(data);
	$("#hotlist").html(loadData(data));
	if (data.tpage>0){
		$("#hot").fadeIn();
	}
});

var headerH = $('.header-inner').height(),curr=1;
//上拉加载活动列表
waterfall({
	wraper: $('.mui-content').find('.wraper'),
	scrollArea: $('.mui-content'),
	loadDown: function(ele){
		$.post("<?php  echo app_url('home/getlist')?>",  {page:curr,lat:position.lat,lng:position.lng,ucity:position.ucity}, function(data){			
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
			$('.mui-content').find('.container').css('height', '100%').append($tpl);
			setTimeout(function(){
				 $('.mui-content').find('.container').find('.box').addClass('ani');
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