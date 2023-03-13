<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
body, .mui-content{position: unset;overflow: unset;}
.mui-segmented-control{ height:40px;display:block;}
.mui-segmented-control .mui-control-item{line-height:38px;margin: 0 0.7rem;display: inline-block;width: auto;border-bottom: 2px solid rgba(0,0,0,0)!important;}
.mui-segmented-control .mui-control-item.mui-active{ color:#FF7B33!important}
.mui-bar{ padding:0; height:39.5px; background:#FFF;}
.mui-bar .mui-segmented-control{height:40px;}
.mui-card.mui-one{position:relative;box-shadow:none;border-radius:0!important}
.mui-card:first-child .mui-card-header{background-size: 100% auto!important;}
.mui-card:first-child .mui-card-header>img:first-child{width:80px!important; height:80px!important; border:#FFF solid 1px;position: absolute; top:4.2rem;}
.mui-card:first-child .mui-card-content-inner{ position:relative}
.mui-card:first-child .mui-card-content-inner p:nth-child(2){line-height:30px;height: 40px; overflow:hidden}
.mui-card:first-child .mui-card-content-inner p:nth-child(2) span{display:inline-block;overflow:hidden;}
.mui-card:first-child .mui-card-content-inner p:nth-child(2) span:first-child{font-size:16px;line-height:27px;}
.mui-card:first-child .mui-card-content-inner p:nth-child(2) em{border-radius: 3px;padding: 3px;}
.mui-card:first-child .mui-card-content-inner p:nth-child(3){margin-bottom:5; font-size:85%; line-height:1.5;position:relative;}
.mui-card:first-child .mui-card-content-inner p:nth-child(3) em{color:#406599;position:absolute; right:5px;top:48%;-webkit-transform: translateY(-50%);transform: translateY(-50%); display:none;}
.mui-card:first-child .mui-card-content-inner p:nth-child(4){font-size:12px;}
.mui-card:first-child .mui-card-content-inner p:nth-child(4) span{ color:#406599}
.mui-card:first-child .mui-card-content-inner:after{content:'';position:absolute;left:0;bottom:0;right:auto;top:auto;height:1px;width:100%;background-color:#e8e8e8;display:block;z-index:15;-webkit-transform:scaleY(.5);transform:scaleY(.5);}
.mui-card:first-child .mui-card-footer{ min-height:40px; max-height:40px;}
.mui-table-view .mui-media-object{ max-width:115px!important;width:115px!important; height:85px;background-size:auto 100%!important;border-radius: 4px;}
.mui-scroll-wrapper-ext{height:100%; }
</style>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/nav_1', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/nav_1', TEMPLATE_INCLUDEPATH));?>
	<header id="header" class="mui-bar">
        <div class="mui-segmented-control mui-segmented-control-inverted" style="top:0">
            <a class="mui-control-item mui-active" href="#" data-key="1">精选</a>
            <a class="mui-control-item" href="#" data-key="2">全部活动</a>
        </div>
    </header>
    <div class="mui-content">
        <div class="mui-card mui-one" style="margin:0;">
        	<div class="mui-card-header mui-card-media" style="height:6rem;background:url(<?php  echo $_W['merchant']['thumb'];?>) no-repeat center">
            	<img src="<?php  echo tomedia($_W['merchant']['logo'])?>">
            </div>
        	<div class="mui-card-content-inner">
            	<p class="mui-padded-top-10" style="overflow:hidden"><span class="mui-badge<?php  if(!$fans) { ?> mui-badge-orange<?php  } ?> mui-pull-right js-follow" data-follow="<?php  if($fans) { ?>0<?php  } else { ?>1<?php  } ?>" data-id="<?php  echo $_W['merchant']['id'];?>" data-muid="<?php  echo $_W['merchant']['uid'];?>"><?php  if($fans) { ?>已关注<?php  } else { ?>+ 关注<?php  } ?></span></p>
                <p class="mui-padded-top-10">
                    <span><b><?php  echo $_W['merchant']['name'];?></b></span>
                    <span>&nbsp;<em class="mui-badge mui-badge-orange mui-small">主办方</em></span>
                </p>
                <p class="mui-ellipsis js-detail"><span><?php  echo $_W['merchant']['detail'];?></span><em class="js-show">展开</em></p>
                <p class="mui-text-gray">
                <span><?php  echo number_format($total['fans'],0);?>位</span> 粉丝&nbsp;&nbsp;
                <span><?php  echo number_format($total['activity'],0);?>场</span> 活动</p>
                <script>
					$(function(){
						var w1 = $('.js-detail').width(),
							w2 = $('.js-detail').find('span').width();
						if(w2>w1){
							$('.js-detail').css('padding-right','25px');
							$('.js-detail').find('em').show();
						}
						$('.js-show').on("tap",function(e) {
							$(this).parent().removeClass('mui-ellipsis').css('padding-right','0');
							$(this).remove();
						});
					});
				</script>
            </div>
            <div id="segmentedControl" class="mui-card-footer" style="padding:0">
                <div class="mui-segmented-control mui-segmented-control-inverted">
                    <a class="mui-control-item mui-active" href="#" data-key="1">精选</a>
                    <a class="mui-control-item" href="#" data-key="2">全部活动</a>
                </div>
            </div>
        </div>
        <div id="item">
            <div id="item1" class="mui-control-content mui-active">
                <div class="mui-scroll-wrapper-ext">
                    <div class="mui-scroll-ext">
                        <ul class="mui-table-view mui-afterbefore-no" style="margin-top:8px;">
                        </ul>
                    </div>
                </div>
            </div>
            <div id="item2" class="mui-control-content">
                <div class="mui-scroll-wrapper-ext">
                    <div class="mui-scroll-ext">
                        <ul class="mui-table-view mui-afterbefore-no" style="margin-top:8px;">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
var wHeight = window.innerHeight;//获取初始可视窗口高度
var container = "<?php  echo $_W['container'];?>";
$('.mui-control-content').css('height',(wHeight-40)+'px');
$(function(){
	loadItem('#item1',1);
	$('#item1').find('.mui-scroll-wrapper-ext').css('position','unset').css('height','100%');
	//tab跟随
	$("#header").fadeTo(0,0);
	var Y = $(".mui-card.mui-one").height();
	$(window).on('scroll',function() {
		if ($(window).scrollTop() >= Y-50) {
			$("#header").fadeTo(0,1);
			$(".mui-card-footer").fadeTo(0,0);
			$('#item').find('.mui-scroll-wrapper-ext').css('position','').css('height','');
		} else {
			$("#header").fadeTo(0,0);
			$(".mui-card-footer").fadeTo(0,1);
			$('#item').find('.mui-scroll-wrapper-ext').css('position','unset').css('height','100%');
		}
	});
	//激活tab选项卡
	$('.mui-control-item').on("tap",function(e) {
		var key = $(this).data("key"),itemid = document.getElementById('item'+key);
		$('#item'+key).addClass("mui-active").siblings(".mui-control-content").removeClass("mui-active");
		if(!itemid.querySelector('li')){
			loadItem('#item'+key, key);
		}
		//同步浮动选项卡激活状态
		if($(this).parents('#header').length){
			$('#segmentedControl .mui-control-item').eq(key-1).addClass('mui-active').siblings().removeClass("mui-active");
		}else{
			$('#header .mui-control-item').eq(key-1).addClass('mui-active').siblings().removeClass("mui-active");
			$('#item'+key).find('.mui-scroll-wrapper-ext').css('position','initial');
		}
		//屏蔽slider选项卡弹出遮罩
		$("body").addClass('mui-backdrop-none');
		setTimeout(function() {
			$("body").find('.mui-backdrop').remove();
			$("body").removeClass('mui-backdrop-none');
		});
	});	
	//关注
	$('.js-follow').on("tap",function(e) {
		var $this = $(this);
		util.loading();
		//console.log($(this).attr('data-follow'));
		$.post("<?php  echo app_url('member/profile/follow')?>",
		{id:$this.data('id'),muid:$this.data('muid'),follow:$this.attr('data-follow'), type:'<?php  echo $_GPC["ac"];?>'},function(d){
			util.loading().close();
			if(d.result==1){
				util.tips('操作成功');
				$this.attr("data-follow",d.data);
				$this.toggleClass("mui-badge-orange");
				$this.text(d.data ? '+ 关注' : '已关注');
			}else if (d.result==2){
				if (container=='wechat'){
					util.confirm('还未注册，点击确认自动注册？', ' ', function(e) {
						if (e.index == 1) {
							location.href = "<?php  echo app_url('auth/oauth/info')?>";
						}
					});
				}else{
					util.tips('需要在微信中打开');
				}
			}else{
				util.tips('操作失败','','error');
			}
		},"json");
	});
});
//上拉加载活动列表
var loadItem=function(obj,type){
	var pageStart = 0,pageEnd = 0,totalpage=0,thispage = 1,thispsize = 10;
	$(obj).find('.mui-scroll-ext').dropload({
		scrollArea : $(obj).find('.mui-scroll-wrapper-ext'),
		threshold : 50,
		loadDownFn : function(me){
			mui.getJSON("<?php  echo app_url('member/profile/activity',array('id'=>$merchantid,'muid'=>$muid))?>", {page:thispage,psize:thispsize,type:type}, function(data){
				console.log(data);
				var stime = new Date(),result='';
				totalpage = data.tpage;
				if (thispage > totalpage || data.tpage == 0){
					me.lock();// 锁定
					me.noData();// 无数据
				}
				if (data.tpage == 0){
					result = '<div class="mui-text-gray" style="text-align:center;margin-top:10%;">暂无活动</div>';
					$(obj).find('.mui-scroll-ext').html('');
					$(obj).find('.mui-scroll-ext').append(result);
					me.resetload();
					return false;
				}
				
				for(var i = 0; i < data.list.length; i++){
					//console.log(data.list[i].id);
					joinstime = new Date(data.list[i].joinstime.replace("-", "/").replace("-", "/"));
					joinetime = new Date(data.list[i].joinetime.replace("-", "/").replace("-", "/"));
					starttime = new Date(data.list[i].starttime.replace("-", "/").replace("-", "/"));
					endtime   = new Date(data.list[i].endtime.replace("-", "/").replace("-", "/"));
					sToend1 = joinetime.format('MM月dd日 hh:mm');
					sToend2 = starttime.format('MM月dd日 hh:mm');//+'~'+endtime.format('MM月dd日 hh:mm')
					
					var joinnum = parseInt(data.list[i].joinnum),
					gnum  = parseInt(data.list[i].gnum),
					aprice = data.list[i].aprice,
					minaprice = 0;
					if (stime > endtime){
						tpl_status = '<span class="mui-badge">活动结束</span>';
					}else{
						if (joinnum >= gnum && gnum > 0){
							tpl_status = '<span class="mui-badge mui-badge-danger">名额已满</span>';
						}else{
							tpl_status = joinstime > stime ? '<span class="mui-badge">还未开始</span>' : (stime>joinetime ? '<span class="mui-badge"><?php  echo $_W['_config']['buytitle'];?>结束</span>': '<span class="mui-badge mui-badge-orange"><?php  echo $_W['_config']['buytitle'];?>中</span>');
						}						
					}
					
					tpl_price = aprice > 0 || minaprice > 0 ?'<span class="mui-text-orange mui-rmb">'+(minaprice?minaprice+' 起':aprice)+'</span>':'<span class="mui-text-success">'+(data.list[i].freetitle!=''?data.list[i].freetitle:'免费活动')+'</span>';
							
					result+='<li class="mui-table-view-cell mui-media">'
					+'    <a href="'+"<?php  echo app_url('activity/detail')?>&activityid="+data.list[i].id+'">'
					+'        <div class="mui-media-object mui-pull-left" style="background:url('+data.list[i].thumb+') no-repeat center"></div>'
					+'        <div class="mui-media-body">'
					+'            <p class="title mui-ellipsis">'+data.list[i].title+'</p>'
					+'            <p class="mui-ellipsis-2 mui-small">'+data.list[i].intro+'</p>'
					+'            <p class="mui-small">'+(data.list[i].switch.joinnum==1?'已<?php  echo $_W['_config']['buytitle'];?>：<font color="#666666">'+joinnum+' 人</font> ':'')+'剩余名额：<font color="#666666">'+(gnum>0?(gnum-joinnum)+' 人':' 不限')+'</font></p>'
					+'            <div class="mui-media-footer">'
					+'            ' + tpl_status
					+'            ' + tpl_price
					+'            </div>'
					+'        </div>'
					+'    </a>'
					+'</li>';

				}
				
				$(obj).find('.mui-table-view').append(result);
				thispage++;
				// 每次数据加载完，必须重置
				me.resetload();
			});
		}
	});
};
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
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>