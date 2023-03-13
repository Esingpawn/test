<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.mui-table-view .mui-media-object{ max-width:115px!important;width:115px!important; height:85px;background-size:auto 100%!important;border-radius: 4px;}
.mui-card.mui-one .mui-card-content-inner{ padding:0;}
.mui-card.mui-one .mui-card-content-inner .mui-table-view-cell{ padding:10px;}
.mui-card.mui-two:first-child{ margin-top:0px;}
.mui-card.mui-two .mui-card-header{ position:relative;}
.mui-card.mui-one .mui-card-header:after{ position:absolute;left:10px;right:10px;bottom:0;height:1px;background-color:#D9D9D9!important;content:"";-webkit-transform:scaleY(0.5);transform:scaleY(0.5);}
.mui-card.mui-two .mui-card-header,.mui-card.mui-one .mui-card-footer{ background:none;}
.mui-card.mui-two .mui-card-header img:first-child{ width: 28px!important;height: 28px!important;border-radius:100px;}
.mui-card.mui-two .mui-card-header .mui-media-body{ min-height:28px; max-height:28px; font-size:13px; line-height:2.3!important;overflow:hidden;margin-left:35px;}
.mui-card.mui-two .mui-card-header .mui-media-body>span{ overflow:hidden; position:relative;}
.mui-card.mui-two .mui-card-header .mui-media-body i.mui-badge{ right:0; padding:5px 10px; padding-bottom:3px;}
.mui-card.mui-two .mui-card-header .mui-media-body i.mui-badge-orange{ background:#fff!important; color:#ff6f02!important;}
.mui-card.mui-two .mui-card-header .mui-media-body i.mui-badge-orange:after{content: " ";width: 200%;height: 200%;position: absolute;top: 0;left: 0;border: 1px solid #ff6f02;box-sizing: border-box;border-radius: 100px;-webkit-transform: scale(0.5);transform: scale(0.5);-webkit-transform-origin: 0 0;transform-origin: 0 0;}
.mui-card.mui-two .mui-card-header .mui-icon-renzheng3{ width:15px; height:15px;font-size:12px;line-height:15px; text-align:center;position:absolute; top:35px;left:35px;background:#fff;border-radius: 100%; z-index:999}
.mui-card.mui-two .mui-card-header .mui-icon-renzheng3:after{ color:#ff6d1f;}
.list-content{min-height:45%;}
</style>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/nav', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/nav', TEMPLATE_INCLUDEPATH));?>
<div class="mui-content">
    <div class="mui-scroll-wrapper-ext">
    <div class="mui-scroll-ext">
        <div class="list-content"></div>
    </div>
    </div>
</div>
<script type="text/html" id="favlist">
<a href="<?php  echo app_url('activity/detail')?>&activityid={{d.activityid}}">
<div class="mui-card mui-one mui-two">
	<div class="mui-card-header mui-card-media">
		<img src="{{d.merchant.logo}}">
		<div class="mui-media-body">
			<span class="mui-ellipsis">{{d.merchant.name}}</span><i class="mui-badge mui-pull-right js-favorite" data-favorite="0" data-id="{{d.id}}" data-aid="{{d.activityid}}" onclick="javascript:return false;">取消</i>
		</div>
	</div>
	<div class="mui-card-content">
		<div class="mui-card-content-inner">
			<ul class="mui-table-view mui-afterbefore-no">
				<li class="mui-table-view-cell mui-media">
				<div class="mui-media-object mui-pull-left" style="background:url('{{d.thumb}}') no-repeat center">
				</div>
				<div class="mui-media-body">
					<p class="title mui-ellipsis">{{d.title}}</p>
					<p class="mui-ellipsis-2 mui-small">{{d.intro}}</p>
					<p class="mui-small">{{# if(d.switch.joinnum==1){ }}已<?php  echo $_W['_config']['buytitle'];?>：<font color="#666666">{{d.joinnum}} 人</font>{{# } }} 剩余：<font color="#666666">{{d.tpl_gnum}}</font></p>
					<div class="mui-media-footer">{{d.tpl_status}} {{d.tpl_price}}</div>
				</div>
				</li>
			</ul>
		</div>
	</div>
</div>
</a>
</script>
<script>
//收藏
$('.list-content').delegate('.js-favorite',"tap",function(e) {
	var favorite = $(this).attr('data-favorite');
	var $this = $(this)
	$.post("<?php  echo app_url('member/favorite/set')?>",{fid:$(this).data('id'),favorite:favorite,activityid:$(this).data('aid')},function(d){
		console.log(d);
		if(d.result == 1){
			util.tips('操作成功');
			$this.attr("data-favorite",d.data);
			$this.toggleClass("mui-badge-orange");
			$this.text(d.data ? '+ 收藏' : '取消');
		}else{
			util.tips('操作失败','','error');
		}
	},"json");
});
//上拉加载活动列表
var pageStart = 0,pageEnd = 0,totalpage=0,thispage = 1,thispsize = 10;
$('.mui-scroll-ext').dropload({
	scrollArea : $('.mui-scroll-wrapper-ext'),
	threshold : 50,
	loadDownFn : function(me){
		mui.getJSON("<?php  echo app_url('member/favorite/ajax')?>", {page:thispage,psize:thispsize}, function(data){
			var stime = new Date(),result='';
			totalpage = data.tpage;
			if (thispage > totalpage || data.tpage == 0){
				me.lock();// 锁定
				me.noData();// 无数据
			}
			if (data.tpage == 0){
				result = '<div class="no-orders-at-all">'
					+'<div class="head-block">'
					+'    <div class="blank-icon mui-ext-icon mui-icon-mhuodong"></div>'
					+'    <p class="hint mui-text-gray">暂无收藏信息</p>'
					+'    <p class="recommend-hint"></p>'
					+'</div></div>';
				$('.mui-scroll-ext').html('');
				$('.mui-scroll-ext').append(result);
				me.resetload();
				return false;
			}
			
			for(var i = 0; i < data.list.length; i++){
				//console.log(pageStart);
				var merchant  = data.list[i].merchant;
				if (data.list[i].favoexists){
					joinstime = new Date(data.list[i].joinstime.replace("-", "/").replace("-", "/"));
					joinetime = new Date(data.list[i].joinetime.replace("-", "/").replace("-", "/"));
					starttime = new Date(data.list[i].starttime.replace("-", "/").replace("-", "/"));
					endtime   = new Date(data.list[i].endtime.replace("-", "/").replace("-", "/"));
					sToend1 = joinetime.format('MM月dd日 hh:mm');
					sToend2 = starttime.format('MM月dd日 hh:mm');//+'~'+endtime.format('MM月dd日 hh:mm')
					
					var joinnum = parseInt(data.list[i].joinnum),
					gnum  = parseInt(data.list[i].gnum),
					aprice = data.list[i].aprice,
					minaprice = data.list[i].minaprice;
					if (stime > endtime){
						data.list[i].tpl_status = '<span class="mui-badge">活动结束</span>';
					}else{
						if (joinnum >= gnum && gnum > 0){
							data.list[i].tpl_status = '<span class="mui-badge mui-badge-danger">名额已满</span>';
						}else{
							data.list[i].tpl_status = joinstime > stime ? '<span class="mui-badge">还未开始</span>' : (stime>joinetime ? '<span class="mui-badge"><?php  echo $_W['_config']['buytitle'];?>结束</span>': '<span class="mui-badge mui-badge-orange"><?php  echo $_W['_config']['buytitle'];?>中</span>');
						}						
					}
					data.list[i].tpl_price = aprice > 0 || minaprice > 0 ?'<span class="mui-text-orange mui-rmb">'+(minaprice?minaprice+' 起':aprice)+'</span>':'<span class="mui-text-success">'+(data.list[i].freetitle!=''?data.list[i].freetitle:'免费活动')+'</span>';
					data.list[i].tpl_gnum = gnum>0?(gnum-joinnum)+' 人':' 不限';
					data.list[i].merchant = merchant;
					var gettpl = document.getElementById('favlist').innerHTML;
					laytpl(gettpl).render(data.list[i], function(html){
						$('.list-content').append(html);
					});
				}else{
					result+='<a href="'+"<?php  echo app_url('activity/detail')?>&activityid="+data.list[i].activityid+'">'
					+'<div class="mui-card mui-one mui-two">'
					+'	<div class="mui-card-header mui-card-media">'
					+'		<img src="'+merchant.logo+'">'
					+'		<div class="mui-media-body">'
					+'			<span class="mui-ellipsis">'+merchant.name+'</span>'
					+'			<i class="mui-badge mui-pull-right js-favorite" data-favorite="0" data-id="'+data.list[i].id+'" data-aid="'+data.list[i].activityid+'" onclick="javascript:return false;">取消</i>'
					+'		</div>'
					+'	</div>'
					+'	<div class="mui-card-content">'
					+'		<div class="mui-card-content-inner" style="text-align:center"><div class="mui-content-padded"><p>当前活动已删除</p></div></div>'
					+'	</div>'
					+'</div></a>';
					$('.list-content').append(result);
				}
			}
			thispage++;
			// 每次数据加载完，必须重置
			me.resetload();
		});
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

function FreshTime(id,starttime,endtime){
	var st = starttime.replace(/-/g,"/"),//开始时间
	    et = endtime.replace(/-/g,"/");//结束时间
		st = new Date(st);//开始时间
	    et = new Date(et);//结束时间
		//console.log(st);
	var nowtime = new Date(),//当前时间
		start_time = parseInt(st.getTime()),
		end_time = parseInt(et.getTime()),
		now_time = parseInt(nowtime.getTime()),
		lefttime = 0; 
	if (start_time > now_time){
		lefttime = parseInt((start_time - now_time)/1000);
	}else if(end_time > now_time){
		lefttime = parseInt((end_time - now_time)/1000);
	}
	//var bar_width =  (1-(lefttime/3600))*100+"%"; //计算进度条百分比
	if (lefttime > 0) {
		hh=parseInt((lefttime/3600));
		mm=parseInt((lefttime/60)%60);
		ss=parseInt(lefttime%60);
		if (start_time > now_time){
			$(id).html('剩余<span id="ti_time_hour">'+hh+'</span>:<span id="ti_time_min">'+mm+'</span>:<span id="ti_time_sec">'+ss+'</span>开始');
		}else if(end_time > now_time){
			$(id).html('剩余<span id="ti_time_hour">'+hh+'</span>:<span id="ti_time_min">'+mm+'</span>:<span id="ti_time_sec">'+ss+'</span>结束');
		}
		//$('#progressbar').css("width",bar_width);
	}else{
		$(id).html('<font color="#FF0000">活动结束</font>');
	}
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>