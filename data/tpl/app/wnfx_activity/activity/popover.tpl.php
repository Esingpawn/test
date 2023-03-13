<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
.mui-popup-backdrop{z-index:1009!important;}
.marketing-popover{ background:#f7f7f7!important;height:80%;}
.marketing-popover .mui-popover-content{height:85%;}
.marketing-popover .mui-scroll-wrapper{ margin-bottom:0;}
.marketing-popover .mui-table-view{text-align:left!important;color:rgb(102, 102, 102)!important;}
.marketing-popover .mui-table-view li{border-radius:0!important;}
.marketing-popover .mui-table-view li:last-child:after{ height:0;}
.marketing-popover .mui-table-view li.noselect{color:#333!important;background-color:#eaeaea!important;}
.marketing-popover .mui-table-view li a{border-radius:0!important;}
.marketing-popover .mui-input-group:before{ height:0;}
.marketing-popover .mui-input-row{ background:none!important;}
.marketing-popover .mui-input-row:last-child:after{ height:0;}
.marketing-popover .mui-input-row label{ float:left!important; line-height:1}
#marketing_1 span.mui-badge-orange.mui-badge-outlined{left:-10px;}
#marketing_1 span.mui-badge-orange.mui-badge-outlined:before{border-radius:100px;}
#marketing_1 span.mui-badge-orange.mui-badge-outlined~span{padding-left:0;}
#storelist .mui-table-view .mui-media-body{position:relative;width:100%;overflow:initial;}
#storelist .closesttome{display:none;}
</style>
<?php  if($_W['action']=='order.create' || $_W['action']=='activity.detail') { ?>
<?php  if(!empty($marketing['0']) || !empty($marketing['1']) || !empty($marketing['2'])) { ?>
<div id="marketing" class="mui-popover mui-popover-bottom mui-popover-action marketing-popover">
    <div class="mui-popover-header">优惠<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="marketing"><me class="mui-icon mui-icon-closeempty"></me></a></div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <?php  if($_W['action']=='order.create') { ?>
            <div class="mui-input-group">
                <?php  if(!empty($marketing['0'])) { ?>
                <?php  if(is_array($marketing['0'])) { foreach($marketing['0'] as $key => $v) { ?>
                <div class="mui-input-row js-marketlist mui-checkbox<?php  if($afterMarketing['max']!=$v['meet'] || !$afterMarketing['m1']) { ?> mui-disabled<?php  } ?>" data-meet="<?php  echo $v['meet'];?>" data-type="1">
                    <label>折扣：满<?php  echo $v['meet'];?>名，可享 <?php  echo $v['give'];?> 折</label>
                    <input name="give" value="<?php  echo $v['give'];?>" type="checkbox"<?php  if($afterMarketing['max']==$v['meet'] && $afterMarketing['m1']) { ?> checked disabled<?php  } else { ?> disabled<?php  } ?>>
                </div>
                <?php  } } ?>
                <?php  } else { ?>
                <?php  if(is_array($marketing['1'])) { foreach($marketing['1'] as $key => $v) { ?>
                <div class="mui-input-row js-marketlist mui-checkbox<?php  if($afterMarketing['max']!=$v['meet'] || !$afterMarketing['m2']) { ?> mui-disabled<?php  } ?>" data-meet="<?php  echo $v['meet'];?>" data-type="2">
                    <label>满减：省<?php  echo $v['give'];?>元，满<?php  echo $v['meet'];?>名可使用</label>
                    <input name="give" value="<?php  echo $v['give'];?>" type="checkbox"<?php  if($afterMarketing['max']==$v['meet'] && $afterMarketing['m2']) { ?> checked disabled<?php  } else { ?> disabled<?php  } ?>>
                </div>
                <?php  } } ?>
                <?php  } ?>
                
                <?php  if(!empty($marketing['2'])) { ?>
                <?php  if(is_array($marketing['2'])) { foreach($marketing['2'] as $v) { ?>
                <div class="mui-input-row mui-checkbox<?php  if($_W['member']['groupid'] != $v['groupid']) { ?> mui-disabled<?php  } ?>">
                <?php  if($v['discount']) { ?>
                    <label>VIP <?php  echo $v['grouptitle'];?> 专享：<?php  echo $v['discount'];?> 折</label>
                    <input name="discount" value="<?php  echo $v['discount'];?>" type="checkbox"<?php  if($afterMarketing['orderMarket']['vip']['groupid'] != $v['groupid']) { ?> disabled<?php  } else { ?> checked disabled<?php  } ?>>
                <?php  } else { ?>
                    <label>VIP <?php  echo $v['grouptitle'];?> 专享：立减 <?php  echo $v['money'];?> 元</label>
                    <input name="money" value="<?php  echo $v['money'];?>" type="checkbox"<?php  if($afterMarketing['orderMarket']['vip']['groupid'] != $v['groupid']) { ?> disabled<?php  } else { ?> checked disabled<?php  } ?>>
                <?php  } ?>
                </div>
                <?php  } } ?>
                <?php  } ?>
            </div>
            <?php  } else { ?>
            <ul class="mui-table-view mui-afterbefore-no">
                <?php  if(!empty($marketing['0'])) { ?>
                <?php  if(is_array($marketing['0'])) { foreach($marketing['0'] as $key => $v) { ?>
                <li class="mui-table-view-cell">折扣：<?php  echo $v['give'];?> 折<span class="mui-badge mui-badge-inverted">单次<?php  echo $_W['_config']['buytitle'];?>满<?php  echo $v['meet'];?>人:可使用</span></li>
                <?php  } } ?>
                <?php  } else { ?>
                <?php  if(is_array($marketing['1'])) { foreach($marketing['1'] as $key => $v) { ?>
                <li class="mui-table-view-cell">满减：省 <?php  echo $v['give'];?> 元<span class="mui-badge mui-badge-inverted">单次<?php  echo $_W['_config']['buytitle'];?>满<?php  echo $v['meet'];?>人:可使用</span></li>
                <?php  } } ?>
                <?php  } ?>
                <?php  if(!empty($marketing['2'])) { ?>
                <?php  if(is_array($marketing['2'])) { foreach($marketing['2'] as $key => $v) { ?>
                <?php  if($v['discount']) { ?>
                <li class="mui-table-view-cell">折扣：<?php  echo $v['discount'];?> 折<span class="mui-badge mui-badge-inverted">VIP <?php  echo $v['grouptitle'];?> 专享</span></li>
                <?php  } else { ?>
                <li class="mui-table-view-cell">立减券：省 <?php  echo $v['money'];?> 元<span class="mui-badge mui-badge-inverted">VIP <?php  echo $v['grouptitle'];?> 专享</span></li>
                <?php  } ?>
                <?php  } } ?>
                <?php  } ?>
            </ul>
            <?php  } ?>
        </div>
        </div>
    </div>
</div>
<?php  } ?>
<?php  } ?>

<?php  if($_W['action']=='order.create' || $_W['action']=='activity.detail') { ?>
<?php  if($activity['prize']['credit'] || $activity['prize']['share_credit'] || $activity['prize']['sign_credit']) { ?>
<div id="marketing_1" class="mui-popover mui-popover-bottom mui-popover-action marketing-popover">
    <div class="mui-popover-header"><?php  echo m('member')->getCreditName('credit1')?>奖励<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="marketing_1"><me class="mui-icon mui-icon-closeempty"></me></a></div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <ul class="mui-table-view mui-afterbefore-no market-box">
                <?php  if($activity['prize']['credit']) { ?><li class="mui-table-view-cell"><span class="mui-badge-orange mui-badge-outlined<?php  if(!strpos($_SERVER['HTTP_USER_AGENT'], 'Mac OS X')) { ?> android<?php  } ?>"><?php  echo $_W['_config']['buytitle'];?></span><span>可得 <?php  echo $activity['prize']['credit'];?> <?php  echo m('member')->getCreditName('credit1')?></span></li><?php  } ?>
                <?php  if($activity['prize']['share_credit']) { ?><li class="mui-table-view-cell"><span class="mui-badge-orange mui-badge-outlined<?php  if(!strpos($_SERVER['HTTP_USER_AGENT'], 'Mac OS X')) { ?> android<?php  } ?>">分享</span><span>可得 <?php  echo $activity['prize']['share_credit'];?> <?php  echo m('member')->getCreditName('credit1')?></span></li><?php  } ?>
                <?php  if($activity['prize']['sign_credit']) { ?><li class="mui-table-view-cell"><span class="mui-badge-orange mui-badge-outlined<?php  if(!strpos($_SERVER['HTTP_USER_AGENT'], 'Mac OS X')) { ?> android<?php  } ?>">签到</span><span>可得 <?php  echo $activity['prize']['sign_credit'];?> <?php  echo m('member')->getCreditName('credit1')?></span><span class="mui-badge mui-badge-inverted">活动日期现场有效</span></li><?php  } ?>
            </ul>
        </div>
        </div>
    </div>
</div>
<?php  } ?>

<?php  if($_W['_config']['agreement']['0']) { ?>
<div id="agreement" class="mui-popover mui-popover-default">
    <div class="mui-popover-header"><?php  echo $_W['_config']['buytitle'];?>协议</div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <div class="mui-content-padded"><?php echo empty($activity['agreement'])?$_W['_config']['joinagreement']:$activity['agreement']?></div>
            </div>
        </div>
    </div>
    <div class="mui-content-padded">
        <button type="button" class="mui-btn mui-btn-success mui-btn-block js-popover-close" data-popover="agreement">已阅读并同意</button>
    </div>
</div>
<?php  } ?>
<?php  } ?>

<?php  if($_W['action']=='activity.detail') { ?>
<div id="storelist" class="mui-popover mui-popover-bottom mui-popover-action" style="background:#f7f7f7;height:80%">
	<div class="mui-popover-header">活动场地<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="storelist"><me class="mui-icon mui-icon-closeempty"></me></a></div>
    <div class="mui-popover-content" style="height:95%">
    	<div class="mui-scroll-wrapper">
        <div class="mui-scroll">
        	<div class="list-content"></div>
        </div>
        </div>
    </div>
</div>
<?php  if($_W['_config']['kefu']['switch']) { ?>
<div id="kefu" class="mui-popover mui-popover-default" style="width:80%;max-height:80%;height:auto;background:transparent;padding-bottom:0;">
	<div class="mui-popover-content" style="height:100%!important;">
        <img width="100%" src="<?php  echo $merchant['kefuimg'];?>" style="vertical-align:bottom;border-radius:0.75rem;">
        <me class="mui-icon mui-icon-closeempty js-popover-close" data-popover="kefu" style="position:absolute; display:none;font-size:1.5rem;color:#999;border-radius:100%;border: 1px solid #999;left:50%;bottom:-2.4rem;-webkit-transform: translateX(-50%);transform: translateX(-50%);"></me>
    </div>    
</div>
<?php  } ?>
<?php  } ?>

<?php  if($_W['action']=='home' || $_W['action']=='activity') { ?>
<div id="mui_search" class="mui-popover mui-popover-left">
	<form action="" method="get" onSubmit="return check(this)" style="position: initial">
    	<input type="hidden" name="i" value="<?php  echo $_GPC['i'];?>">
    	<input type="hidden" name="c" value="<?php  echo $_GPC['c'];?>">
    	<input type="hidden" name="do" value="mobile">
        <input type="hidden" name="r" value="activity">
        <input type="hidden" name="m" value="<?php  echo $_GPC['m'];?>">
    <div class="mui-popover-header">
    	<div class="mui-input-row mui-search mui-active" style="margin:0;width:85%; background:none;">
            <input type="search" name="keyword" class="mui-input-clear" placeholder="输入主办方、或感兴趣的活动" data-input-clear="1" data-input-search="1" value="<?php  echo $keyword;?>">
            <span class="mui-icon mui-icon-clear"></span>
            <span class="mui-placeholder"><span class="mui-icon mui-icon-search"></span></span>
        </div>
        <a class="mui-pull-right mui-popover-close js-popover-close" data-popover="mui_search" style="right: -30px;padding: inherit;">取消&nbsp;</a>
    </div>
    </form>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <div class="mui-content-padded">
                </div>
            </div>
        </div>
    </div>
</div>
<?php  } ?>

<?php  if($_W['action']=='order.create' && checkplugin('seat') && $activity['switch']['seat']) { ?>
<link href="<?php echo FX_BASE;?>app/resource/components/seat-charts/style.css?v=1.0.5" rel="stylesheet">
<div id="seatbox" class="mui-popover mui-popover-bottom mui-popover-action marketing-popover" style="height:100%;border-radius: 0.45rem 0.45rem 0 0; overflow:hidden">
	<div class="mui-popover-header" style="color:#666"><a class="js-popover-close" data-popover="seatbox" style="color:#969696"><span class="mui-ext-icon mui-icon-open"></span></a></div>
    <div class="mui-popover-content" style="height:95%;margin:0">
        <div class="mui-scroll-wrapper-ext seat_area" style="height:70%">
            <div class="mui-scroll-ext pinch-zoom" id="pinch" data-scale="1" data-x="0" data-y="0" style="width:auto">
            	<div id="seat_area" style="width:max-content; margin-top:0.6rem"></div>
            </div>
        </div>
        <!---右边选座信息----->
        <div class="booking_area">
            <div id="legend"></div>
            <div class="chosebox">
                <div class="mui-scroll-wrapper" style="margin-top:3px;">
                    <div class="mui-scroll" style="width:auto">
                        <ul id="seats_chose"></ul>
                    </div>
                </div>
            </div>
            <div class="mui-content-padded">
                <input type="hidden" id="seat_temp" value="" />
                <input type="button" class="mui-btn mui-btn-block mui-btn-yellow js-chose" value="确定选座"/>
            </div>        
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo FX_BASE;?>app/resource/components/seat-charts/jquery.seat-charts.min.js?v=1.0.2"></script>
<script>
var price = 100, init_seat = <?php  echo json_encode($init_seat)?>, sc = Object;
$(document).ready(function() {
	var $cart = $('#seats_chose'),
		$tickects_num = $('#tickects_num');
	sc = $('#seat_area').seatCharts({
		map: init_seat,
		naming: {
			top: false,
			getLabel: function(character, row, column) {
				return column
			}
		},
		legend: {
			node: $('#legend'),
			items: [
				['c', 'available', '可选座'],				
				['c', 'selected', '已选中'],
				['c', 'unavailable', '已占用']
			]
		},
		click: function() {			
			if (this.status() == 'available') {
				if ($('#seat_area .selected').length >= $('.js-pay-num').val()) {
					util.tips('只可选择 '+$('.js-pay-num').val() +' 个座位');
					return 'available'
				}
				$('<li class="mui-icon mui-icon-closeempty">' + (this.settings.row + 1) + '排' + this.settings.label + '座</li>').attr('id', 'cart-item-' + this.settings.id).data('seatId', this.settings.id).appendTo($cart);
				$tickects_num.text(sc.find('selected').length + 1);
				return 'selected'
			} else if (this.status() == 'selected') {
				$('#cart-item-' + this.settings.id).remove();
				return 'available'
			} else if (this.status() == 'unavailable') {
				return 'unavailable'
			} else {
				return this.style()
			}
		}
	});
	//设置已售出的座位
	var arr1 = "<?php  echo $seat['unavailable'];?>".split(',');
	sc.get(arr1).status('unavailable');
});

function getStatus(c){
	var status = '', len = $('#seat_area .' + c).length;
	$('#seat_area .' + c).each(function(i){
		status = status + $(this).attr("id");
		status += i < len-1 ? ',' : '';
	});
	if (status!=''){
		$('input[name="seats"]').val(status.replace(/_/ig, '排').replace(/,/ig, '座,') + '座');
		$('#seat_show').text(status.replace(/_/ig, '排').replace(/,/ig, '座,') + '座');
		$('#seat_temp').val(status);
	}else{
		$('input[name="seats"]').val('');
		$('#seat_show').text('');
		$('#seat_temp').val('');
	}
}

$('.js-chose').on("tap",function(e) {
	getStatus('selected');
	mui('#seatbox').popover('hide');
	history.back(-1);
});

$('#seats_chose').delegate('li', 'tap', function(e) {
	$(this).remove();
	sc.get([$(this).attr("id").replace(/cart-item-/ig, '')]).status('available');
	getStatus('selected');
});

function getTotalPrice(sc) {
	var total = 0;
	sc.find('selected').each(function() {
		total += price
	});
	return total
}
function seatChose(sc){
	var seats = $("input[name='seats']").val(), 
    chosenum = seats == '' ? 0 : seats.split(',').length, 
    paynum = parseInt($('.js-pay-num').val());
	if (chosenum != paynum) {
		if (chosenum > paynum)
			util.tips('只可选择 ' + paynum + ' 个座位！');
		else
			util.tips('请再选择 ' + (paynum - chosenum) + ' 个座位！');
		sc.get($("#seat_temp").val().split(',')).status('selected');
		$('#seats_chose').find('li').remove();
		$('#seat_show').text('');
		sc.find('selected').each(function() {
			var index = $.inArray(this.settings.id, $("#seat_temp").val().split(','));
			if (index >= 0){
				$('<li class="mui-icon mui-icon-closeempty">' + (this.settings.row + 1) + '排' + this.settings.label + '座</li>').attr('id', 'cart-item-' + this.settings.id).data('seatId', this.settings.id).appendTo($('#seats_chose'));
				$('#seat_show').text((this.settings.row + 1) + '排' + this.settings.label + '座、');
			}else
				sc.get([this.settings.id]).status('available');
		});
	}
	var H = $("#seat_area").height();
	$("#pinch").css("height", H+'px');
	pinch();
}
function pinch(){
	$("#pinch").removeClass('transnone');
	setTimeout(function(){		
		$("#pinch").css("transform","scale(1, 1)");
		$("#seatbox .booking_area").css("transform", "translate(0px, 0px)");
	}, 300);
	setTimeout(function(){
		$("#pinch").addClass('trans');
	}, 600);
	setTimeout(function(){
		$("#pinch").addClass('transnone');
		$("#pinch").attr("data-scale",1);
	}, 1500);
}

//座位区域缩放http://hammerjs.github.io/
require(['//hammerjs.github.io/dist/hammer.min.js'], function (hammertime){
	$("#seatbox").css('transition','');
	$("#seat_area").load(function(){
        $(this).css("marginLeft",(-1*$(this).width()/2)+"px");
        $(this).css("marginTop",(-1*$(this).height()/2)+"px");
    });

    //创建一个新的hammer对象并且在初始化时指定要处理的dom元素
    var hammertime = new Hammer($(".pinch-zoom")[0]);
    //var hammertime = new Hammer(document.getElementById("test"));
    hammertime.get('pinch').set({ enable: true });
    hammertime.add(new Hammer.Pinch());
    //hammertime.get('pan').set({ direction: Hammer.DIRECTION_ALL });
    hammertime.get('swipe').set({ direction: Hammer.DIRECTION_ALL });//横向和纵向的swipe事件
    hammertime.get('swipe').set({ threshold: 0 });//识别之前所需的最小距离
    hammertime.get('swipe').set({ velocity: 0.2 });//识别之前所需的最小距离
	$("#pinch").css("transform","scale(0.7,0.7)");
	//捏开
	hammertime.on("pinchout", function (e) {
			//console.log(">>>>>>>>>>>>>>>>");
			var W = $("#seat_area").width();
			var H = $("#seat_area").height();
			var scale = 1;
			//var mouseX=e.pageX;//鼠标
			//var mouseY=e.pageY;
			var mouseX=e.center.x;//捏开点
			var mouseY=e.center.y;
	
			if($("#pinch").attr("data-scale")!=1){
				var translateX=0;
				var translateY=0;
				//计算当前点击点相对于图片的偏移比例
				var posX = mouseX/W;
				var posY = mouseY/H;
				translateX= (W * posX / scale) * -1;
				translateY= (H * posY / scale) * -1;
				
				//console.log("###["+translateX+"]###");
				//$("#pinch").css("transformOrigin","0% 0%");
				$("#pinch").css("transform","scale(1,1)");
				$("#pinch").attr("data-x",translateX);
				$("#pinch").attr("data-y",translateY);
				$("#pinch").attr("data-scale",1);
				setTimeout(function(){
					$("#pinch").addClass('transnone');
				}, 500);
				//console.log("点击点的百分比>>>   "+posX+","+posY+"                  ");
				//console.log("偏移>>>   "+translateX+","+translateY+"                  ");
				//console.log("鼠标："+mouseX+","+mouseY+"                  ");
				//console.log("捏开开开开>>>>  " + e.center.x + "," + e.center.y+"                  ");
				//console.log("x————————"+ $("#pinch").attr("data-x") );
				//onsole.log("y————————"+ $("#pinch").attr("data-y") );
			}
	});
	//捏合
	hammertime.on("pinchin", function (e) {
		var W = $("#seat_area").width()+30, H = $("#seat_area").height()+30, scale = 0;
		var winW = $(document).width();
		var winH = $('.seat_area').height();
		if (W > H)
			scale = winW / W;
		else
			scale = winH / H;
		scale = scale.toFixed(1);
		$("#pinch").removeClass('transnone');
		$("#pinch").css({"transform":"scale("+scale+","+scale+")", 'transform-origin': '0 0'});		
		$("#pinch").attr("data-x",0);
		$("#pinch").attr("data-y",0);
		$("#pinch").attr("data-scale", scale);
		console.log("捏合合合合>>" );
	});
	
	function move123(x,y){
		//console.log($("#pinch").attr("data-scale")+"【】【】")
		if($("#pinch").attr("data-scale")==1){
			var W = $("#seat_area").width();
			var H = $("#seat_area").height();
			var winW = $(document).width();
			var winH = $('.seat_area').height();
			var marginTop = H * -1/2 - $("#pinch").height();
			var marginLeft = W * -1/2 - winW -20;
			var marginBottom = 0;
			//console.log("marginTop="+marginTop);
			//console.log("marginBottom="+marginBottom);
	
			var translateX = $("#pinch").attr("data-x");
			var translateY = $("#pinch").attr("data-y");
			
			translateX = x;
			translateY = y;
			//console.log("y=" + translateY);			
			//console.log("marginBottom————::: "+ marginBottom +"           ]");
			//console.log("原始的：translateX = "+ translateX + "      " +"translateY = " + translateY);
			if(translateX>0){translateX=0;console.log("分支: 左往右拨动");}
			if(translateX < marginLeft ){translateX = marginLeft;console.log("分支: 右往左拨动");}
			if(translateY < marginTop ){translateY = marginTop;console.log("分支: 下往上拨动");}
			if(translateY > marginBottom ){translateY = marginBottom;console.log("分支: 上往下拨动");}
			console.log("改了的：translateX = "+ translateX + "      " +"translateY = " + translateY);
	
			
			$("#pinch").css("transform","scale(1,1) translate("+translateX+"px, "+translateY+"px)");
			$("#pinch").attr("data-x",translateX);
			$("#pinch").attr("data-y",translateY);
			$("#pinch").attr("data-scale", 1);
		}
	}
	
	$("#pinch").on({
		touchstart: function(e){
			var self = this;
			var e = event || window.event, touch = e.touches[0];
			startX = touch.pageX - $("#pinch").attr("data-x");
			startY = touch.pageY - $("#pinch").attr("data-y");
		},
		touchmove: function(e){
			var e = event || window.event, touch = e.touches[0];	
			//获取最后的坐标位置
			endx = Math.floor(touch.pageX);
			endy = Math.floor(touch.pageY);
			//console.log('结束');
			//获取开始位置和离开位置的距离
			nx = endx-startX;
			ny = endy-startY;			
			//通过坐标计算角度公式 Math.atan2(y,x)*180/Math.PI
			angle = Math.atan2(ny, nx) * 180 / Math.PI;
			if(Math.abs(nx)<=10 || Math.abs(ny)<=1){
				//console.log('滑动距离太小');
				return false;
			}
			move123(nx, ny);
			//通过滑动的角度判断触摸的方向
			if(angle<45 && angle>=-45){
				//console.log('右滑动');
				return false;
			}else if(angle<135 && angle>=45){
				//console.log('下滑动');
				return false;
			}else if((angle<=180 && angle>=135) || (angle>=-180 && angle<-135 )){
				 //console.log('左滑动');
				 return false;
			}else if(angle<=-45 && angle >=-135){
				//console.log('上滑动');
				return false;
			}
		},
		touchend: function(e){
			//console.log(3);
		}
	});
	hammertime.on("swipe", function (e) {
		//console.log("事件发生点(deltaX) x: "+e.deltaX + "(deltaY)  y: "+e.deltaY);
		if($("#pinch").attr("data-scale")==1){
			//console.log("拖动结束  " + e.deltaX + "," + e.deltaY);
			//move123(e.deltaX,e.deltaY);
		}
	});
});
</script>
<?php  } ?>
<script>
//mui('.mui-scroll-wrapper').scroll({indicators: false});
mui('.mui-scroll-wrapper').scroll({
	scrollY: true, //是否竖向滚动
	scrollX: true, //是否横向滚动
	startX: 0, //初始化时滚动至x
	startY: 0, //初始化时滚动至y
	indicators: false, //是否显示滚动条
	deceleration:0.0006, //阻尼系数,系数越小滑动越灵敏
	bounce: true //是否启用回弹
});
$(function() {
	//触发规格选择器
	$('body').delegate('.js-popover', 'tap', function(e) {
		$("body").removeClass('mui-backdrop-top');
		var popover = "#"+$(this).data("popover");
		mui(popover).popover('toggle');
		if (popover == '#mui_search') {
			var t = '<?php  echo $keyword;?>';
			if (util.ios()){
				$("input[name='keyword']").focus().val(t);
			}else{	
				setTimeout(function(){$("input[name='keyword']").focus().val(t);}, 520);
			}
		}
		if (popover == '#seatbox') {
			seatChose(sc);
		}
	});
	$(".js-popover-close").on("click",function(e) {
		var popover = "#"+$(this).data("popover");
		mui(popover).popover('hide');
		if (popover=='#agreement')
			$("input[name='agreement']").prop("checked", true);
	}); 
	
	$('.mui-search .mui-icon-clear').on("click", function(e) {
		$("input[name='keyword']").focus();
		$("input[name='keyword']").val('');
	});
});
function check(form){
	if ($.trim(form['keyword'].value) == '') {
		util.tips('关键词不能为空');
		return false;
	}else{
		history.back(-1);
		if ("<?php  echo $_GPC['from'];?>"=="wxapp") {
			if ("<?php  echo $_W['routes'];?>"!='activity'){
				util.program.navigate("<?php  echo app_url('activity')?>&keyword="+form['keyword'].value, "<?php  echo $_W['routes'];?>")
			}else{
				return true;
			}
		}else{			
			util.program.navigate("<?php  echo app_url('activity')?>&keyword="+form['keyword'].value, "<?php  echo $_W['routes'];?>")
		}
	}
	return false;
}
</script>