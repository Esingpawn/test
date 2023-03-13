<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-slider{ height:100%;}
.mui-slider .mui-scroll-wrapper.mui-slider-indicator{width:100%;margin:auto;}
.mui-slider .mui-scroll-wrapper.mui-slider-indicator .mui-scroll{width:100%;}
.mui-slider .mui-control-item{color:#999!important;position:relative;width:33.3333%!important}
.mui-slider .mui-control-item.mui-active{color:#333!important;border:none!important;}
.mui-slider .mui-control-item.mui-active:after{position:absolute;left:0;right:0;bottom:0;height:3px;background-color:#EC0000;content: "";}
.mui-slider .mui-slider-group{height:100%;}
.mui-slider .mui-slider-group .mui-slider-item{border:none!important;padding:8px 12px;position:relative;height:100%}
.mui-slider .mui-slider-group .mui-slider-item:before{position:absolute;left:0;right:0;top:0;height:1px;background-color:#e0e0e0!important;content:"";-webkit-transform: scaleY(0.5);transform: scaleY(0.5);}
.mui-card.mui-one{box-shadow:none}
.mui-card.mui-one .mui-card-header img:first-child{width:18px!important;height:18px!important;}
.mui-card.mui-one .mui-card-header.mui-card-media .mui-media-body{font-weight:normal;margin-left:25px;min-height:22px;height:22px;overflow:hidden}
.mui-card.mui-one .mui-card-header.mui-card-media .mui-media-body p{color:#99a5b5;}
.mui-card.mui-one .mui-card-header .mui-media-body i.mui-badge{right:-10px;border-radius: 100px 0 0 100px;}
.mui-card.mui-one .mui-fee-bar{border-radius:3px;line-height:2.2;height:44px;background:#fff5f4;border-left:solid 2px #ffdbdd;padding:8px;padding-left:0px;overflow:hidden;}
.mui-card.mui-one .mui-card-content-inner{line-height:2.2;}
.dropload-down{height:100px}
</style>
    <div class="mui-content" style="z-index:1">
    	<div class="mui-card mui-one mui-card-line">
            <div class="mui-card-content">
                <div class="mui-card-content-inner">
                    <p style="font-size:14px;margin-bottom:0">客户数量<span class="mui-text-orange mui-pull-right"><?php  echo $agent['lowers'];?>人</span></p>
                    <p style="font-size:14px;margin-bottom:0">订单总额<span class="mui-text-orange mui-pull-right"><?php  echo $agent['amounts'];?>元</span></p>
                </div>
            </div>
        </div>
        
        <div id="slider" class="mui-slider" style="margin-top:10px;">
            <div class="mui-scroll-wrapper mui-slider-indicator mui-segmented-control mui-segmented-control-inverted" style="background:#FFF;<?php  if(!empty($_GPC['uid'])) { ?>display:none<?php  } ?>">
                <div class="mui-scroll">
                    <a class="mui-control-item mui-active" href="#item1" data-key="1">一级(<?php  echo $agent['first'];?>人)</a>
                    <?php  if($set['level']>1) { ?>
                    <a class="mui-control-item" href="#item2" data-key="2">二级(<?php  echo $agent['second'];?>人)</a>
                    <?php  } ?>
                    <?php  if($set['level']>2) { ?>
                    <a class="mui-control-item" href="#item3" data-key="3">三级(<?php  echo $agent['third'];?>人)</a>
                    <?php  } ?>
                </div>
            </div>
            <div class="mui-slider-group">
                <div id="item1" class="mui-slider-item mui-control-content mui-active">
                    <div class="mui-scroll-wrapper-ext">
                        <div class="mui-scroll-ext">
                            <div class="list-content"></div>
                        </div>
                    </div>
                </div>
                <?php  if(empty($_GPC['uid'])) { ?>
                <div id="item2" class="mui-slider-item mui-control-content">
                	<div class="mui-scroll-wrapper-ext">
                        <div class="mui-scroll-ext">
                            <div class="list-content"></div>
                        </div>
                    </div>
                </div>
                <div id="item3" class="mui-slider-item mui-control-content">
                	<div class="mui-scroll-wrapper-ext">
                        <div class="mui-scroll-ext">
                            <div class="list-content"></div>
                        </div>
                    </div>
                </div>
                <?php  } ?>
            </div>
        </div>
    </div>
<script type="text/html" id="lowerlist">
<div class="mui-card mui-one mui-card-line">
    <div class="mui-card-header mui-card-media">
		<a class="mui-navigate-right" href="<?php  echo app_url('commission', array('op' => 'lower'))?>&uid={{d.member_id}}">
			<img src="{{d.member.avatar}}">
			<div class="mui-media-body">
				<p class="mui-small" style="line-height:1.9!important;">{{d.member.nickname}}</p>
			</div>
		</a>
    </div>
	<div class="mui-card-footer mui-before-no">
		<div class="mui-text-gray">订单个数：{{d.ordernum}}个<br>客户数量：{{d.lowers}}个</div>
        <div class="mui-text-gray">订单总额：{{d.amounts}}元<br>客户订单：{{d.lower_amount}}元</div>
    </div>
</div>
</script>
<script>
$(function(){
	//屏蔽slider选项卡弹出遮罩
	$('.mui-slider .mui-control-item').on('tap',function(e) {
		setTimeout(function(){
			$('.mui-backdrop').remove();
			$("body").css('overflow','');
			$('.mui-content').css('overflow','');
		});
		$("body").addClass('mui-backdrop-none');
	});
	//激活tab选项卡
	$('.mui-control-item').on("tap",function(e) {
		var key = $(this).data("key"),itemid = document.getElementById('item'+key);
		$('#item'+key).addClass("mui-active").siblings(".mui-control-content").removeClass("mui-active");
		if($(itemid).find('.list-content').html()==""){
			loadItem('#item'+key, key);
		}
		
	});
	loadItem('#item1',1);	
});

//上拉加载活动列表
var loadItem=function(obj, key){
	var totalpage=0,thispage = 1,thispsize = 10;
	$(obj).find('.mui-scroll-ext').dropload({
		scrollArea : $(obj).find('.mui-scroll-wrapper-ext'),
		threshold : 80,
		loadDownFn : function(me){
			mui.getJSON("<?php  echo app_url('commission',array('op'=>'lower','uid'=>$_GPC['uid']), MODULE_PLUGIN_NAME)?>", {page:thispage,pagesize:thispsize,level:key}, function(data){
				var stime = new Date(),result='';
				totalpage = data.tpage;
				if (thispage > totalpage || data.tpage == 0){
					me.lock();// 锁定
					me.noData();// 无数据
				}
				if (data.tpage == 0){
					result = '<div class="mui-text-gray" style="text-align:center;margin-top:10%;">无数据</div>';
					$(obj).find('.mui-scroll-ext').html('');
					$(obj).find('.mui-scroll-ext').append(result);
					me.resetload();
					return false;
				}
				console.log(key);
				var gettpl = document.getElementById('lowerlist').innerHTML;
				for(var i = 0; i < data.list.length; i++){
					var newDate = new Date();
					newDate.setTime(data.list[i].created_at * 1000);
					createtime = newDate.format('yyyy-MM-dd hh:mm:ss');
					laytpl(gettpl).render(data.list[i], function(html){
						$(obj).find('.list-content').append(html);
					});

				}
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