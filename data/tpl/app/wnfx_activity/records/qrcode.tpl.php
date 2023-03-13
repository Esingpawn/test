<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-card{border-radius:0.2rem!important;margin:0.55rem!important;}
.mui-card.border:before{border-radius:0.36rem;border:0.04rem solid rgba(0,0,0,.18)}
.mui-card-header{background:none;font-size:0.55rem;padding:0.45rem 0.35rem;line-height:1.5}
.mui-card-header.border:before{border:none;border-bottom:0.04rem solid rgba(0,0,0,.18)}
.mui-card .mui-card-content-inner{padding:0.35rem;}
.mui-card .mui-table-view .mui-table-view-cell{padding:0.5rem 0}
.mui-card .mui-table-view .mui-table-view-cell:after{left:0}
.mui-card .mui-table-view .mui-table-view-cell a{margin:-0.5rem 0;}
.mui-card .mui-table-view .mui-table-view-cell a p{width:2.2rem;font-size:0.5rem;text-align-last: justify}
.mui-card .mui-table-view .mui-table-view-cell .mui-badge{margin-left:3rem;font-size:0.45rem}
.mui-slider .mui-slider-group .mui-slider-item img{width:5rem;height:5rem}
.mui-slider-indicator{bottom:5%}
.mui-slider-indicator .mui-indicator{width:0.15rem;border-radius:0.15rem!important;background: rgba(0,0,0,.18);}
.mui-slider-indicator .mui-indicator.mui-active{background: rgba(0,0,0,.45);}
.store .info .ico{ float:left; padding-right:0.3rem;color:#828282;}
.store .info1{width:80%; float:left;  margin-bottom:0.3rem;font-size:85%}
.store .info1,.store .info1 a{color:#828282;}
.store .info1, .store .info1 .fa{line-height:2;}
.store .info1~a{float:right;margin-left:0.3rem;color:#ccc; padding-left:0.2rem;font-size:0.8rem; position:relative}
.store .info1~a .ico3{color:#999;line-height:2;}
.store .info1~a:before{content: " ";position: absolute;border-left: 1px solid #e5e5e5;top:48%;left:-0.5rem;height:40%;-webkit-transform: scaleX(0.5) translateY(-50%);transform: scaleX(0.5) translateY(-50%);;-webkit-transform-origin: 0 100%;
transform-origin: 0 100%;}
.mui-popover-default{ height:80%}
.mui-popover-default .mui-popover-content{height:80%!important; margin:0 0.5rem;}
.voucher-code { position:relative}
.voucher-code p{ margin:0.35rem 0!important}
.voucher-code .r{position:absolute;z-index:999;width:100%;height:0.52rem;bottom:-0.23rem;}
.voucher-code .r span{position:absolute;width:0.25rem;height:0.52rem;top:0;background:#f2f2f2;border:0.02rem solid rgba(0,0,0,.085)}
.voucher-code .r span.l{border-radius:0 0.5rem 0.5rem 0;border-left:0.02rem solid #f2f2f2;left:-0.35rem}
.voucher-code .r span.r{border-radius:0.5rem 0 0 0.5rem;border-right:0.02rem solid #f2f2f2;right:-0.35rem}
.mui-popover .mui-btn.mui-btn-block{border-radius:1rem}
</style>
<div class="mui-content">
    <div class="mui-slider" id="slider" style="height:100%">
        <div class="mui-slider-group" style="height:90%">
        	<?php  if(is_array($list)) { foreach($list as $row) { ?>
            <div class="mui-slider-item">
            	<div class="mui-card border">
                    <div class="mui-card-header border">
                        <?php  if($row['aprice']>0) { ?>
                            <?php  if($row['payprice']) { ?>
                            票价：<font class="mui-rmb"><?php  echo $row['payprice'];?></font>
                            <?php  } else { ?>
                            免费票
                            <?php  } ?>
                        <?php  } ?></br>
                        <?php  echo $row['realname'];?>(<?php  echo $row['mobile'];?>)
                        <?php  if($row['NO']) { ?><span class="mui-pull-right mui-text-gray">NO.<?php  echo $row['NO'];?></span><?php  } ?>                        
                    </div>
                    <div class="mui-card-content">
                        <div class="mui-card-content-inner">
                            <div class="voucher-code">
                                <p style="margin-bottom:0"><span style="font-size:120%">核销码：<?php  echo $row['hexiaoma'];?></span>
                                <?php  if($row['paytype']=='delivery' && $row['status']=='0') { ?><br><font class="mui-text-error">需线下付款</font><?php  } ?></p>
                                <p><img src="<?php  echo $row['qrcode'];?>" onerror="javascript:this.src='http://qr.topscan.com/api.php?w=300&text=<?php  echo $row['qrcodeurl'];?>';" <?php  if(in_array($row['status'],array(5,6,7)) || $row['review']!=1 || (TIMESTAMP > strtotime($activity['endtime']))) { ?> style="opacity:0.35"<?php  } ?>></p>
                                <?php  if($row['review']==1) { ?>
                                    <?php  if($row['status']==3) { ?><p class="mui-text-success">已完成</p><?php  } ?>
                                    <?php  if(in_array($row['status'],array(1,2))) { ?>
                                    	<?php  if(TIMESTAMP > strtotime($activity['endtime'])) { ?>
                                        <p class="mui-text-red">已过期</p>
                                        <?php  } else { ?>
                                    	<p class="mui-text-yellow">待参与</p>
                                        <?php  } ?>
                                    <?php  } ?>
                                    <?php  if($row['status']=='5') { ?><p class="mui-text-gray">已取消</p><?php  } ?>
                                    <?php  if($row['status']=='6') { ?><p class="mui-text-red">退款中</p><?php  } ?>
                                    <?php  if($row['status']=='7') { ?><p class="mui-text-red">已退款</p><?php  } ?>
                                <?php  } else { ?>
                                	<p class="mui-text-red">审核中</p>
                                <?php  } ?>
                                <div class="r">
                                    <span class="l"></span>
                                    <span class="r"></span>
                                </div>
                            </div>
                            <ul class="mui-table-view mui-afterbefore-no" style="margin-top:0;">
                                <li class="mui-table-view-cell mui-media">
                                    <a class="mui-navigate-right" href="<?php  echo app_url('activity/detail')?>&id=<?php  echo $item['activityid'];?>"><p>活动名称</p><span class="mui-badge mui-badge-inverted"><?php  echo $activity['title'];?></span></a>
                                </li>
                                <?php  if(count($list) < 2) { ?>
                                <li class="mui-table-view-cell mui-media">
                                    <a><p>名额</p><span class="mui-badge mui-badge-inverted"><?php  echo $row['buynum'];?></span></a>
                                </li>
                                <?php  } ?>
                                <?php  if(!empty($row['optionname'])) { ?>
                                <li class="mui-table-view-cell mui-media">  
                                    <a><p>规格</p><span class="mui-badge mui-badge-inverted"><?php  echo $row['optionname'];?></span></a>
                                </li>
                                <?php  } ?>
                                <li class="mui-table-view-cell mui-media">
                                    <a><p>活动时间</p><span class="mui-badge mui-badge-inverted"><?php  echo $activity['starttime'];?> ~ <?php  echo $activity['endtime'];?></span></a>
                                </li>
                                <li class="mui-table-view-cell mui-media">
                                    <a><p><?php  echo $_W['_config']['buytitle'];?>时间</p><span class="mui-badge mui-badge-inverted"><?php  echo $row['jointime'];?></span></a>
                                </li>
                                <?php  if($activity['switch']['seat']) { ?>
                                <li class="mui-table-view-cell mui-media">
                                    <a><p>座位</p><span class="mui-badge mui-badge-inverted"><?php  echo $row['seats'];?></span></a>
                                </li>
                                <?php  } ?>
                                
                                <?php  if($activity['hasonline']) { ?>
                                <li class="mui-table-view-cell mui-media">
                                    <a class="mui-navigate-right"><p>地点</p><span class="mui-badge mui-badge-inverted">线上活动</span></a>
                                </li>
                                <?php  } else { ?>
                                <?php  if(empty($store)) { ?>
                                <li class="mui-table-view-cell mui-media js-popover" data-popover="stores">
                                    <a class="mui-navigate-right"><p>地点</p><span class="mui-badge mui-badge-inverted mui-ellipsis-2">点击查看</span></a>
                                </li>
                                <?php  } else { ?>
                                <li class="mui-table-view-cell mui-media" onclick="wxMap('<?php  echo $store['lat'];?>','<?php  echo $store['lng'];?>','<?php  echo $store['storename'];?>','<?php  echo $store['address'];?>');">
                                    <a class="mui-navigate-right"><p>地点</p><span class="mui-badge mui-badge-inverted mui-ellipsis-2"><?php  if(empty($store)) { ?>点击查看<?php  } else { ?><?php  echo $store['address'];?><?php  } ?></span></a>
                                </li>
                                <?php  } ?>
                                <?php  } ?>
                                <li class="mui-table-view-cell mui-media">
                                    <a class="mui-navigate-right" href="tel:<?php  echo $merch['tel'];?>"><p>主办方</p><span class="mui-badge mui-badge-inverted"><?php  echo $merch['name'];?> (联系Ta)</span></a>
                                </li>
                                <?php  if(!empty($row['remark'])) { ?>
                                <li class="mui-table-view-cell mui-media">
                                    <a><p>备注信息</p><span class="mui-badge mui-badge-inverted"><?php  echo $row['remark'];?></span></a>
                                </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php  } } ?>
        </div>
        <?php  if(count($list) > 1) { ?>
        <div class="mui-slider-indicator">
            <?php  if(is_array($list)) { foreach($list as $k => $r) { ?>
            <div class="mui-indicator<?php  if($k==0) { ?> mui-active<?php  } ?>"></div>
            <?php  } } ?>
        </div>
        <?php  } ?>
    </div>
    <?php  if($total>1) { ?>
    <script>
		document.getElementById('slider').addEventListener('slide', function(e) {
			var num = e.detail.slideNumber + 1;
			$('head title').text('电子票('+num+'/<?php  echo $total;?>)');
		});
	</script>
    <?php  } ?>
    <div class="mui-content-padded mui-button-area" style="display:none">
		<a href="javascript:history.go(-1);" class="mui-btn mui-btn-yellow mui-btn-block">返回</a>
	</div>
</div>

<div id="stores" class="mui-popover mui-popover-default">
    <div class="mui-popover-header">场地列表</div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <table width="98%">
                	<?php  if(!empty($stores)) { ?>
                    <?php  if(is_array($stores)) { foreach($stores as $store) { ?>
                        <tr>
                            <td>
                                <div class="store" style="padding:5px 0">
                                    <div class="info">
                                        <div class="ico mui-ext-icon mui-icon-merchants"></div>
                                        <div class="info1">
                                            <div class="inner">
                                                 <div class="user"><?php  echo $store['storename'];?></div>
                                                 <div class="addresss"><a href="javascript:;" onclick="wxMap('<?php  echo $store['lat'];?>','<?php  echo $store['lng'];?>','<?php  echo $store['storename'];?>','<?php  echo $store['address'];?>');"><div class="ico2"><i class="fa fa-map-marker"> <?php  echo $store['address'];?></i></div></a></div>
                                             </div>
                                         </div>                                         
                                         <a href="tel:<?php  echo $store['tel'];?>"><div class="ico3"><i class="fa fa-phone"></i></div></a>               
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php  } } ?>
                    <?php  } else { ?>
                        <tr>
                            <td>
                                <div class="store" style="padding:5px 0">
                                    <div class="info">
                                        <div class="ico mui-ext-icon mui-icon-merchants"></div>
                                        <div class="info1">
                                            <div class="inner">
                                                 <div class="user"><?php  echo $store['storename'];?></div>
                                                 <div class="addresss"><a href="javascript:;" onclick="wxMap('<?php  echo $store['lat'];?>','<?php  echo $store['lng'];?>','<?php  echo $store['storename'];?>','<?php  echo $store['address'];?>');"><div class="ico2"><i class="fa fa-map-marker"> <?php  echo $store['address'];?></i></div></a></div>
                                                 <div class="tel">电话: <?php  echo $store['tel'];?></div>
                                             </div>
                                         </div>
                                         <a href="tel:<?php  echo $store['tel'];?>"><div class="ico3"><i class="fa fa-phone"></i></div></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php  } ?>
                    </table>
            </div>
        </div>        
    </div>
    <div class="mui-content-padded">
    	<input type="button" class="mui-btn mui-btn-block mui-btn-yellow js-popover-close" data-popover="stores" value="关闭"/>
    </div>
</div>
<script>
var container = "<?php  echo $_W['container'];?>";
function wxMap(lat,lng,name,address){
	if (container=='wechat'){
		util.program.isMiniProgram(function(res){//判断是否是小程序页面的回调函数
			if (res) {
				wx.miniProgram.navigateTo({
					url: '/wnfx_activity/pages/map/map?lat='+lat+'&lng='+lng+'&name='+name+'&address='+address
				});
			}else{
				wx.ready(function () {
					wx.openLocation({
						latitude: lat, // 纬度，浮点数，范围为90 ~ -90
						longitude: lng, // 经度，浮点数，范围为180 ~ -180。
						name: name, // 位置名
						address: address, // 地址详情说明
						scale: 16, // 地图缩放级别,整形值,范围从1~28。默认为最大
						infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
					});
				});
			}
		});
	}else{
		location.href = "https://apis.map.qq.com/uri/v1/marker?marker=coord:"+lat+","+lng+";title:"+name+";addr:"+address+"&referer=myapp";
	}
}
mui('.mui-scroll-wrapper').scroll({
	scrollY: true, //是否竖向滚动
	scrollX: true, //是否横向滚动
	startX: 0, //初始化时滚动至x
	startY: 0, //初始化时滚动至y
	indicators: true, //是否显示滚动条
	deceleration:0.0006, //阻尼系数,系数越小滑动越灵敏
	bounce: true //是否启用回弹
});
$('body').delegate('.js-popover', 'tap', function(e) {
	var popover = "#"+$(this).data("popover");	
	setTimeout(function(){mui(popover).popover('toggle');}, 100);
});
$(".js-popover-close").on("click",function(e) {
		var popover = "#"+$(this).data("popover");
		mui(popover).popover('hide');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>