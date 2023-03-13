<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/nav', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/nav', TEMPLATE_INCLUDEPATH));?>
<?php  if($_W['_config']['wechatstatus']==2) { ?>
<?php  $tabs = array('0'=>'待支付','1'=>'待参与','3'=>'已完成','5'=>'已取消','7'=>'已退款');?>
<?php  } else { ?>
<?php  $tabs = array('1'=>'待参与','3'=>'已完成','5'=>'已取消');?>
<?php  } ?>
<style type="text/css">
.mui-bar-nav~.mui-slider-group{padding-top:1.75rem;}
.mui-bar-nav:after{ height:0}
.list-content{margin:0 0.4rem;}
.field{border-radius:0.45rem;margin-top:0.25rem;}
.field:first-child{margin-top:0;}
.field-item:before,.field-item:after{width:94%;left:3%;}
.field-head{padding:0 10px}
.field-head-name{width:auto;max-width:50%;}
.mui-slider-indicator .mui-slider-progress-ext{height:0.13rem;border-radius:2px;top:auto;bottom:1px;margin-left:0.88rem;
background:-webkit-linear-gradient(right, rgba(254,189,0,1) 0%, rgba(255,211,0,1) 100%);
background:-moz-linear-gradient(right, rgba(254,189,0,1) 10%, rgba(255,211,0,1) 100%);
background:-o-linear-gradient(right, rgba(254,189,0,1) 0%, rgba(255,211,0,1) 100%);
background:linear-gradient(right, rgba(254,189,0,1) 0%, rgba(255,211,0,1) 100%);}
.mui-bar-nav .mui-segmented-control .mui-control-item.mui-active{font-weight:bold}
.mui-bar-nav .mui-segmented-control .mui-control-item.mui-active,.mui-bar-nav .mui-segmented-control .mui-control-item{font-size:.52rem;margin-left: 0.88rem;color:#000!important;line-height:1.6rem;border-bottom:none!important}
.mui-bar-nav,.mui-bar-nav .mui-segmented-control.mui-scroll-wrapper,.mui-segmented-control.mui-scroll-wrapper .mui-scroll{height:1.5rem!important;}
.field-console-btns .mui-btn{line-height:normal;padding:0.1rem 0.2rem; font-size:0.43rem; margin-left:0.1rem;}
.mui-btn-yellow{background-color: #feda00!important;border:none!important}
</style>
<div class="mui-content">
<div id="slider" class="mui-slider" style="height:100%">   
    <header class="mui-bar mui-bar-nav">
      <div class="mui-scroll-wrapper mui-slider-indicator mui-segmented-control mui-segmented-control-inverted" style="font-size:0;">
        <div class="mui-scroll">
            <a class="mui-control-item mui-active" href="#item0" data-status='-1'>全部</a>
            <?php  $tabNum=0;?>
            <?php  if(is_array($tabs)) { foreach($tabs as $k => $v) { ?>
            <a class="mui-control-item" href="#item<?php  echo $tabNum+1?>" data-status='<?php  echo $k;?>'><?php  echo $v;?></a>
            <?php  $tabNum++;?>
            <?php  } } ?>
            <div id="sliderProgressBar" class="mui-slider-progress-ext"></div>
        </div>
      </div>
    </header>
    <div class="mui-slider-group" style="height:100%">
        <div id="item0" class="mui-slider-item mui-control-content mui-active">
            <div class="mui-scroll-wrapper-ext">
                <div class="mui-scroll-ext">
                    <div class="list-content"></div>
                </div>
             </div> 
        </div>
        <?php  $tabNum=0;?>
        <?php  if(is_array($tabs)) { foreach($tabs as $k => $v) { ?>
        <div id="item<?php  echo $tabNum+1?>" class="mui-slider-item mui-control-content">
             <div class="mui-scroll-wrapper-ext">
                <div class="mui-scroll-ext">
                    <div class="list-content"></div>
                </div>
             </div>
        </div>
        <?php  $tabNum++;?>
        <?php  } } ?>        
    </div>
</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH));?>
<script>
//屏蔽slider选项卡弹出遮罩
$('.mui-control-item').on("tap",function(e) {
	$("body").addClass('mui-backdrop-none');
	setTimeout(function() {
		$("body").find('.mui-backdrop').remove();
		$("body").removeClass('mui-backdrop-none');
	});
});
//取消订单
$(document).on('click','.cancel',function(){
	var id = $(this).attr('rid');
	var aid = $(this).attr('aid');
	util.confirm('确认取消<?php  echo $_W['_config']['buytitle'];?>？', ' ', function(e) {
		if (e.index == 1) {
			$.post("<?php  echo app_url('records/cancel')?>",{id:id,aid:aid},function(d){
				if(d.result == 1){
					util.toast('<?php  echo $_W['_config']['buytitle'];?>取消成功');
					setTimeout(function () {
						location.href = "<?php  echo app_url('records')?>";
					}, 1000);
				}else{
					util.toast('<?php  echo $_W['_config']['buytitle'];?>取消失败');
				}
			},"json");
		} else {}
	})
});

//上拉加载活动列表
var loadItem=function(id,sn,status){
	var thispage = 1,pagesize = 10;
	var counter=0;//计数器
    $(id).find('.mui-scroll-ext').dropload({
        scrollArea : $(id).find('.mui-scroll-wrapper-ext'),
		threshold : 2 * htmlFont,
        loadDownFn : function(me){
            $.ajax({
                type: 'GET',
                url: "<?php  echo app_url('records/ajax')?>",
				data: {page:thispage,pagesize:pagesize,status:status},
                dataType: 'json',
                success: function(data){
					console.log(data);
					var stime = new Date(),result='',status=0;
					if (thispage > data.tpage || data.tpage == 0){
						me.lock();// 锁定
						me.noData();// 无数据
					}
					if (data.tpage == 0){
						result = '<div class="no-orders-at-all">'
						+'<div class="head-block">'
						+'    <div class="blank-icon mui-ext-icon mui-icon-mhuodong"></div>'
						+'    <p class="hint">当前没有任何信息</p>'
						+'    <p class="recommend-hint"></p>'
						+'</div></div>';
						$(id).find('.list-content').append(result).next().remove();
						me.resetload();
						return false;
					}
					
                    for(var i = 0; i < data.list.length; i++){
						status = parseInt(data.list[i].status);
						price = data.list[i].price;
						aprice = data.list[i].aprice;
						payprice = data.list[i].payprice;
						paytype = data.list[i].paytype;
						joincancel = parseInt(data.list[i].joincancel);
						review = parseInt(data.list[i].review);
						merchant  = data.list[i].merchant;
						joinstime = new Date(data.list[i].joinstime.replace(/-/g, "/"));
						joinetime = new Date(data.list[i].joinetime.replace(/-/g, "/"));
						starttime = new Date(data.list[i].starttime.replace(/-/g, "/"));
						endtime   = new Date(data.list[i].endtime.replace(/-/g, "/"));
						jointime  = new Date(data.list[i].jointime.replace(/-/g, "/"));
						
						sToend1 = joinetime.format('MM月dd日 hh:mm');//<?php  echo $_W['_config']['buytitle'];?>结束时间
						sToend2 = starttime.format('MM月dd日 hh:mm')+'~'+endtime.format('MM月dd日 hh:mm');//活动开始时间段
						btns = '<a href="'+"<?php  echo app_url('order/detail')?>&id="+data.list[i].id+'&type=u" class="mui-btn mui-btn-warning">查看详情</a>';
						var statusmsg='';
						switch(status){
						case 0: 
							var systime = new Date();
							if (endtime > systime){
								statusmsg = aprice > 0 && paytype != 'delivery' ? '<font class="mui-text-error">待支付</font>' : (paytype == 'delivery' ? '<font class="mui-text-error">线下待确认</font>' : '');
								btns = aprice > 0 && paytype!='delivery' ? btns + '<a href="'+"<?php  echo app_url('pay/paytype')?>&id="+data.list[i].id+'" class="mui-btn mui-btn-warning">去支付</a>' : btns;
								btns = (paytype != 'delivery' && joincancel==1 ? '<div class="mui-btn mui-btn-outlined cancel" rid="'+data.list[i].id+'" aid="'+data.list[i].activityid+'">取消<?php  echo $_W['_config']['buytitle'];?></div> ' : '')+btns;
							}
							break;
						case 1:statusmsg = '待参与';
							btns = btns + (review==1 ? '&nbsp;<a href="'+"<?php  echo app_url('records/qrcode')?>&id="+data.list[i].id+'" class="mui-btn mui-btn-warning mui-btn-outlined"><i class="fa fa-qrcode"></i>&nbsp;电子票</a>' : '');break;
						case 2:statusmsg = '待参与';
							btns = (stime < joinetime && joincancel==1 ? '<div class="mui-btn mui-btn-outlined cancel" rid="'+data.list[i].id+'" aid="'+data.list[i].activityid+'">取消<?php  echo $_W['_config']['buytitle'];?></div> ': '')+btns;
							btns = btns + (review==1 ? '&nbsp;<a href="'+"<?php  echo app_url('records/qrcode')?>&id="+data.list[i].id+'" class="mui-btn mui-btn-warning mui-btn-outlined"><i class="fa fa-qrcode"></i>&nbsp;电子票</a>':'');break;
						case 3: statusmsg = '<font class="mui-text-success">已参与</font>';
							btns = btns + (review==1 ? '&nbsp;<a href="'+"<?php  echo app_url('records/qrcode')?>&id="+data.list[i].id+'" class="mui-btn mui-btn-warning mui-btn-outlined"><i class="fa fa-qrcode"></i>&nbsp;电子票</a>':'');
						break;
						case 5: statusmsg = '<font color="#666">已取消</font>';break;
						case 6: statusmsg = '<font class="mui-text-warning">退款中</font>';break;
						case 7: statusmsg = '<font class="mui-text-error">已退款</font>';break;
						default:break;
						break;
						}
						
						switch(review){
							case 0: statusmsg = '<font class="mui-text-danger">待审核</font>';break;
							case 2: statusmsg = '<font class="mui-text-danger">已拒审</font>';break;
							case 3: statusmsg = '<font class="mui-text-danger">驳回修改</font>';break;
							default:break;
							break;
						}
						price =  '合计:￥<span class="mui-big">'+price+'</span>';
						price = aprice == '' ? '免费票' : price;
						
						result+= '<div class="field">'
						+'    <div class="field-head">'
						+'        <span class="field-head-name"><i class="icon iconfont icon-shop"></i> ' + merchant.name + '</span>'
						+'        <span class="field-head-status field-head-status-light">'+statusmsg+'</span>'
						+'    </div>'
						+'    <a class="field-item" href="javascript:;">'
						+'    <div class="avatar" style="background-image:url('+data.list[i].thumb+')"></div>'
						+'    <div class="contentt">' + (aprice !='' ?'<p class="mui-badge mui-pull-right mui-badge-inverted mui-rmb">'+aprice+'</p>':'')
						+'        <p class="delivery_tip">'+data.list[i].title+'</p>'
						+'        <p class="order-time">'+sToend2+'</p>'
						+'        <p class="pp_time mui-small" id="pp_'+sn+'_'+thispage+'_'+i+'"></p><p class="mui-badge mui-pull-right mui-badge-inverted">×'+data.list[i].buynum+'</p>'
						+'    </div>'
						+'    <i class="field-arrow icon-arrow-right"></i></a>'
						+'    <div class="field-console">'
						+'        <div class="mui-text-right mui-small">共'+data.list[i].buynum+'张票&nbsp;&nbsp;'+price+'</div>'
						+'        <div class="field-console-btns">'
						+'            '+btns
						+'        </div>'
						+'    </div>'
						+'</div>'
						+'<script>FreshTime("#pp_'+sn+'_'+thispage+'_'+i+'","'+data.list[i].starttime+'","'+data.list[i].endtime+'");var sh;sh=setInterval(function(){FreshTime("#pp_'+sn+'_'+thispage+'_'+i+'","'+data.list[i].starttime+'","'+data.list[i].endtime+'")},1000);<\/script>';
                    }
					
					thispage++;
					$(id).find('.list-content').append(result);
					// 每次数据加载完，必须重置
					me.resetload();
                },
                error: function(xhr, type){
                    // alert('加载失败，请刷新下重试!');
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        }
    });
}

$(function() {
	var itemIndex = parseInt('<?php  echo $index;?>');
		itemWidth = new Array(),
		itemID =  new Array(),
		transX = 0;
	$(".mui-control-item").each(function(key){
		itemWidth[key]=$(this).width();//初始化每个control-item的宽度
		itemID[key]=document.getElementById('item'+key);//初始slider-item,ID
	});
	$('#sliderProgressBar').css("width",itemWidth[0]);
	
	document.getElementById('slider').addEventListener('slide', function(e) {
		//初始化当前被激活的item序号
		var sn = e.detail.slideNumber, itemX = 0;
		//初始化每次进度条滑动的距离
		for (var i = 0; i < sn; i++ ){
			itemX += itemWidth[i];
		}
		transX = itemX/htmlFont+0.88*sn;
		$('#sliderProgressBar').css('left',transX+'rem');
		setTimeout(function() {
			$('#sliderProgressBar').css('width',itemWidth[sn]);
		}, 150);
		if (itemID[sn].querySelector('.mui-loading')) itemID[sn].querySelector('.list-content').innerHTML = '';
		if (itemID[sn].querySelector('.list-content').innerHTML == '') {
			loadItem(itemID[sn],sn,$('.mui-control-item').eq(sn).data("status"));	
		}		
	});
	
	if (itemIndex > 0) {
		$('#item'+itemIndex).find('.list-content').append('<div class="mui-loading"><div class="mui-spinner"></div></div>');
		setTimeout(function() {			
			mui('#slider').slider().gotoItem(itemIndex);
		}, 50);
	}else{
		loadItem('#item0', 0, -1);
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

//计时
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
		dd=parseInt((lefttime/86400));
		hh=parseInt((lefttime/3600))-dd*24;
		mm=parseInt((lefttime/60)%60);
		ss=parseInt(lefttime%60);
		if (start_time > now_time){
			$(id).html('<span id="ti_time_day">'+dd+'</span>天<span id="ti_time_hour">'+hh+'</span>:<span id="ti_time_min">'+mm+'</span>:<span id="ti_time_sec">'+ss+'</span>开始');
		}else if(end_time > now_time){
			$(id).html('<span id="ti_time_day">'+dd+'</span>天<span id="ti_time_hour">'+hh+'</span>:<span id="ti_time_min">'+mm+'</span>:<span id="ti_time_sec">'+ss+'</span>结束');
		}
		//$('#progressbar').css("width",bar_width);
	}else{
		$(id).html('<font color="#FF0000">活动结束</font>');
	}
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>