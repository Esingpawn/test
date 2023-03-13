<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.mui-content img{pointer-events:none;vertical-align:sub;}
.content-inner div{position:absolute;color:#FFF;line-height:1.4;word-break:break-word}
.content-inner img{vertical-align:bottom;font-size:0}
.content-inner .bg_box{display:none}
.content-inner #imgbg~img{opacity:0;position:absolute}
.content-inner #down_ctrl{ width:100%; height:100%;z-index:1;left:0;top:0;}
.mui-bar-footer{padding:10px;}
.mui-bar-footer span{line-height:normal;display:inline-block}
.mui-bar-footer span:nth-child(2){ margin-left:0.2rem;}
.mui-bar-footer .mui-badge{border-radius:0.15rem;font-size:0.55rem;padding:0.15rem 0.3rem!important;}
#poster_pop{transition: opacity .3s ease-in-out;opacity: 0;}
#poster_pop.ani{opacity: 1;}
#poster_pop.mui-popover{width:65%;height:auto!important;padding:0;background:rgba(255,255,255,.45);}
#poster_pop.mui-popover .mui-popover-header{position:absolute;right:0;top:-1.5rem;}
#poster_pop.mui-popover .mui-popover-header:after{height:0}
#poster_pop.mui-popover .mui-popover-header a.mui-popover-close{background:rgba(255,255,255,.45);color:#000;border-radius:50%;}
#poster_pop.mui-popover .mui-popover-content img{display:block}
.mui-backdrop{background-color: rgba(0,0,0,1);}
</style>
<?php  if($total>1) { ?>
<div class="mui-bar mui-bar-footer">
    <span class="mui-badge mui-badge-yellow" onclick="loadStyle(-1)">上一个</span>
    <span class="mui-badge mui-badge-yellow" onclick="loadStyle(1)">下一个</span>
    <span class="mui-badge mui-badge-yellow mui-pull-right js-down">生成</span>
</div>
<?php  } ?>
<div class="mui-content">
	<div class="mui-scroll-wrapper">
        <div class="mui-scroll content-inner bg_box">
        	<img id="imgbg" src="<?php  echo tomedia($bg_data['0'])?>" width="100%" height="auto">
            <img id="img1" src="<?php  echo $_W['fans']['avatar'];?>" style="border-radius: 100%;">
            <img id="img2" src="" style="display:none">
            <img id="img3" src="<?php  echo tomedia($qrcode)?>">
            <div id="text1"><?php  echo $_W['fans']['nickname'];?></div>
            <div id="text2"><?php  echo $activity['title'];?></div>
            <div id="text3">开始时间：<?php  echo date('Y-m-d H:i',strtotime($activity['starttime']))?></div>
            <div id="text4"><?php  echo $address;?></div>
            <div id="text5"><?php  echo $order['realname'];?></div>
            <div id="text6"><?php  echo $order['hexiaoma'];?></div>
            <div id="text7">结束时间：<?php  echo date('Y-m-d H:i',strtotime($activity['endtime']))?></div>
            <div id="down_ctrl" data-popover="down_pop" style="background:#FFF"></div>
        </div>
    </div>
</div>
<div id="down_pop" class="mui-popover mui-popover-action mui-popover-bottom">
	<ul class="mui-table-view">
        <li class="mui-table-view-cell js-down">
            <a href="javascript:;" class="mui-text-primary">生成海报</a>
        </li>
    </ul>
    <ul class="mui-table-view">
        <li class="mui-table-view-cell" data-popover="down_pop">
            <a class="mui-text-gray mui-popover-close js-popover-close" data-popover="down_pop"><me>取消</me></a>
        </li>
    </ul>
</div>
<div id="poster_pop" class="mui-popover mui-popover-default">
	<div class="mui-popover-header"><a class="mui-pull-right mui-popover-close js-popover-close" data-popover="poster_pop"><me class="mui-icon mui-icon-closeempty"></me></a></div>
    <div class="mui-popover-content" style="height:auto!important;border-radius:7px;overflow:hidden;"></div>
</div>
<script>
mui('.mui-scroll-wrapper').scroll({indicators: false});
setTimeout(function(e){
	//util.alert('长按背景图片生成您的海报!',' ');
}, 2000);
var num = 1, total = parseInt('<?php  echo $total;?>');

$(window).load(function(){
	if (total>1){
		loadStyle(0);
		$('#imgbg').css("margin-bottom",$('.mui-bar-footer').height()+20);
	}else{
		lodImg(num);
	}
});
function loadStyle(key){
	util.loading();
	num = num + key;
	num = num == 0 ? total : (num > total ? 1 : num);
	console.log(num);
	$.post("<?php  echo app_url('activity/poster/style',array('from'=>$_GPC['from'],'modid'=>$_GPC['modid']))?>",{activityid:'<?php  echo $id;?>',imgnum:num},function(d){
		var bg_w = d.bg_w, bg_h = d.bg_h;
		var boxW = $('#imgbg').width(),
			boxH = (boxW / bg_w * bg_h).toFixed(0);
		
		//背景图片设置
		$("#imgbg").attr('src',d.bgimg);
		$("#down_ctrl").fadeTo(1000, 0);
		util.loading().close();
		
		//图片布局
		for(var i = 0; i < 3; i++){
			if (!d.img_data['show'][i]){
				$('#img'+(i+1)).hide();
			}else {
				var img_left=0;
				//图片左侧距离比
				var ratio_x = (d.img_data['x'][i]/bg_w).toFixed(3);
				//图片顶部距离比
				var ratio_y = (d.img_data['y'][i]/bg_h).toFixed(3);
				//图片显示宽度比
				var ratio_w = (d.img_data['w'][i]/bg_w).toFixed(3);
				//图片显示高度比
				var ratio_h = (d.img_data['h'][i]/bg_h).toFixed(3);
				
				img_left  = ratio_x == 0 ? (boxW - (ratio_w * boxW))/2 : ratio_x * boxW;
				$('#img'+(i+1)).show().css({"left":img_left, "top":ratio_y * boxH, "width":ratio_w * boxW, "opacity":1});
			}			
		}
		//文字布局
		$.each(d.font_data['x'], function(idx, val) {		
			if (!d.font_data['show'][idx]){
				$('#text'+(idx+1)).hide();
			}else{
				var font_left = 0, font_width = 0, text_width = 0, show_width = 0, fine_tun = idx > 1 ? 0.016 : 0.017;
				//文字左侧距离比
				var ratio_x = (d.font_data['x'][idx]/bg_w).toFixed(3);
				//文字顶部距离比
				var ratio_y = (d.font_data['y'][idx]/bg_h).toFixed(3);
				//文字显示宽度比
				var ratio_w = (d.font_data['w'][idx]/bg_w).toFixed(3);
				//文字字号比
				var ratio_size = (d.font_data['size'][idx]/bg_w+0.006).toFixed(3);
				
				$("#text"+(idx+1)).show().css({"left":'', 'font-size':ratio_size*boxW, 'width':'', 'text-align':''});
				text_width = $("#text"+(idx+1)).width();
				font_left  = ratio_x * boxW;
				font_width = text_width > ratio_w*boxW ? ratio_w*boxW : text_width;
				show_width = text_width == font_width ? '' : font_width;
				//if (idx==1){console.log(text_width);}
				
				if (Number(val) == 0) {			
					font_left  = (boxW - font_width)/2;
					$("#text"+(idx+1)).css({"left":font_left, "top":ratio_y*boxH-(boxH*fine_tun), 'width':show_width, 'text-align':'center'});
				}else{
					$("#text"+(idx+1)).css({"left":font_left, "top":ratio_y*boxH-(boxH*fine_tun), 'width':show_width, 'text-align':''});
					if (num == total - 8 + 7 && idx > 0){
						console.log(idx);
						$("#text"+(idx+1)).css({'line-height':'1.2', 'text-align':'center'});
					}
				}
				$("#text"+(idx+1)).css({'color':'rgb('+d.font_data['color'][idx][0]+','+d.font_data['color'][idx][1]+','+d.font_data['color'][idx][2]+')'});
			}			
		});
		
	},"json");
}
$("#down_ctrl").on({
    touchstart: function(e){
		var self = this;
		e.preventDefault();
        timeOutEvent = setTimeout(function(e){
			var popover = "#"+$(self).attr("data-popover");
			mui(popover).popover('toggle');
		}, 500);//这里设置长按响应时间
		var e = event || window.event;
		var touch = e.touches[0];
        touchY = touch.clientY;
    },
    touchmove: function(e){
		var e = event || window.event,touch = e.touches[0];	
		if(Math.abs(touch.clientY - touchY) > 0){	
			clearTimeout(timeOutEvent);
			timeOutEvent = 0;
        }
    },
    touchend: function(e){
        clearTimeout(timeOutEvent);
		timeOutEvent = 0;
    }
});
$(".js-down").on("tap",function(e) {
	lodImg(num);
});
$(".mui-popover-close").on("tap",function(e) {
	var popover = "#"+$(this).data("popover");
	mui(popover).popover('hide');
	$('#poster_pop').removeClass('ani');
	if (total==1){
		util.program.isMiniProgram(function(res){//判断是否是小程序页面的回调函数
			if (res) {
				wx.miniProgram.navigateBack({
					 delta: 1
				})
			}else{
				history.go(-1);
			}
		})
	}
});
$('body').delegate('.mui-backdrop','tap', function(e) {
	$('#poster_pop').removeClass('ani');
	if (total==1){
		util.program.isMiniProgram(function(res){//判断是否是小程序页面的回调函数
			if (res) {
				wx.miniProgram.navigateBack({
					 delta: 1
				})
			}else{
				history.go(-1);
			}
		})
	}
});
function Base64UrlToBlob(urlData, filetype) {
	//去掉url的头，并转换为byte
	var bytes = window.atob(urlData.split(',')[1]);

	//处理异常,将ascii码小于0的转换为大于0
	var ab = new ArrayBuffer(bytes.length);
	var ia = new Uint8Array(ab);
	for (var i = 0; i < bytes.length; i++) {
		ia[i] = bytes.charCodeAt(i);
	}
	// 类型
	if (filetype === '' || !filetype) {
		filetype = 'image/png';
	}
	return new Blob([ab], {type: filetype});
}

function blobToFile(theBlob, fileName){
   theBlob.lastModifiedDate = new Date();
   theBlob.name = fileName;
   return theBlob;
}
function lodImg(num){
	util.loading();
	$('#poster_pop .mui-popover-content img').hide();
	if ($('#item_'+num).length==0){
		var $tpl = '<img id="item_'+num+'" src="' + "<?php  echo app_url('activity/poster/down2',array('from'=>$_GPC['from'],'modid'=>$_GPC['modid'],'orderid'=>$orderid))?>&id=<?php  echo $id;?>&uid=<?php  echo $_W['member']['uid'];?>&nickname=<?php  echo $_W['fans']['nickname'];?>&imgnum="+num+'" width="100%" height="auto">';
		$('#poster_pop .mui-popover-content').append($tpl);
	}
	$('#item_'+num).show();
	mui('#poster_pop').popover('toggle');
	
	var imgdefereds=[];
	$('#poster_pop img').each(function(){
		var dfd=$.Deferred();
		$(this).bind('load',function(){
			dfd.resolve();
		}).bind('error',function(){
			//图片加载错误，加入错误处理
			//dfd.resolve();
		})
		if(this.complete) dfd.resolve();
		imgdefereds.push(dfd);
	})
	$.when.apply(null,imgdefereds).done(function(){
		util.loading().close();
		$('#poster_pop').addClass('ani');
	});
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>