<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
ul{list-style:none;padding:0; margin:0}
#extension-box #header{background-color:#f15353}
#extension-box #header .top{position:relative;display:flex;padding:0.65rem;background-color:#f15353;align-items:center}
#extension-box #header .img{overflow:hidden;width:2.4rem;height:2.4rem;border:solid .08rem #fff;border-radius:50%}
#extension-box #header .header-info{margin-left:.625rem;color:#fff;text-align:left;font-size:14px}
#extension-box #header .header-info .header-name{margin-bottom:.15rem;font-weight:700;font-size:0.72rem}
#extension-box #header .header-info span{font-size:0.5rem;opacity: 0.5;}
#extension-box #header .share{position:absolute;right:.875rem;display:flex;padding:0.425rem;height:1.125rem;border-radius:.8125rem;background-color:rgba(255,255,255,.2);color:#fff;line-height:0.32rem;font-size:0.6rem}
#extension-box #detail{border-top:solid .01rem #ebebeb;border-bottom:solid .01rem #ebebeb;background-color:#fff}
#extension-box #detail li{position:relative;display:flex;margin-left:.875rem;padding-right:.875rem;border-top:solid .01rem #ebebeb;font-size:16px;line-height:1.7rem}
#extension-box #detail li .iconfont{margin-right:.375rem;color:#f15353;font-size:1.625rem}
#extension-box #detail li .fa{position:absolute;right:.875rem;color:#c9c9c9;font-size:24px;line-height:1.7rem}
#extension-box #detail li:first-child{border:none}
#extension-box #more-power,#extension-box #power{margin-top:.625rem;background-color:#fff}
#extension-box #more-power .title,#extension-box #power .title{display:flex;padding:0 .875rem;border-bottom:solid .01rem #ebebeb;line-height:2.25rem}
#extension-box #more-power .title .spare,#extension-box #power .title .spare{margin-top:.42rem;margin-right:.5rem;width:.15rem;height:.575rem;border-radius:.0625rem;background-color:#f15353}
#extension-box #more-power .title h1,#extension-box #power .title h1{font-size:0.58rem;margin:.42rem 0;}
#extension-box #more-power .plugg,#extension-box #power .plugg{display:flex;flex-wrap:wrap}
#extension-box #more-power .plugg .plug-list,#extension-box #power .plugg .plug-list{width:50%;border-right:solid .01rem #ebebeb;border-bottom:solid .01rem #ebebeb}
#extension-box #more-power .plugg .plug-list:nth-child(2n),#extension-box #power .plugg .plug-list:nth-child(2n){border-right:none}
#extension-box #more-power ul,#extension-box #power ul{display:flex;padding:.875rem .625rem}
#extension-box #more-power ul .info,#extension-box #power ul .info{position:relative;margin-left:.375rem;width:100%;text-align:left}
#extension-box #more-power ul .info .top,#extension-box #power ul .info .top{display:flex;font-size:0.6rem;line-height:1.3;justify-content:space-between}
#extension-box #more-power ul .info .top .name,#extension-box #power ul .info .top .name{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
#extension-box #more-power ul .info .top .left,#extension-box #power ul .info .top .left{text-align:right;flex:1}
#extension-box #more-power ul .info .grade span,#extension-box #power ul .info .grade span{padding:0.12rem .375rem;border-radius:.1875rem;background-color:#ebebeb;color:#999;font-size:0.46rem}
#extension-box #more-power ul .info .money,#extension-box #power ul .info .money{color:#f15353;font-size:0.72rem;line-height:1.3}
#extension-box #more-power ul .info .money small,#extension-box #power ul .info .money small{font-size:12px}
#extension-box #more-power ul:nth-child(2n),#extension-box #power ul:nth-child(2n){border-right:none}
.mui-card.mui-one{box-shadow:none}
.mui-card-media .mui-table-view:after{ height:1px!important;}
.mui-card-link.mui-text-gray p{color:#828282!important}
.mui-table-view.mui-grid-view{ background-color:none;}
.mui-table-view.mui-grid-view .mui-table-view-cell{ border:none;background-color:#fff;padding: 12px 15px; position:relative;margin-right:0px;}
.mui-table-view.mui-grid-view .mui-table-view-cell:after{content: ""; position:absolute; right:0; left:auto; top:50%;border-right:1px solid #e0e0e0; height:60%;-webkit-transform: translateY(-50%) scaleX(0.5); transform: translateY(-50%) scaleX(0.5);}
.mui-table-view.mui-grid-view .mui-table-view-cell>a:not(.mui-btn){ margin: -11px -14px;}
.mui-table-view.mui-grid-view .mui-table-view-cell:last-child:after{ border:none;}
.mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body{color:#777777; font-size:80%;margin-top:6px;height:auto}
.mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body b{color: #f15353;}
.mui-table-view.mui-grid-view span.mui-ext-icon{ position:relative; width:30px; height:25px; margin:0 auto;display:inline-block;}
.mui-table-view.mui-grid-view span.mui-ext-icon:before{ left:50%;transform: translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);font-size:1.2rem; color:#999}
.mui-table-view.mui-grid-view span.mui-ext-icon.mui-icon-qianbao:before{font-size:18px;}
.mui-table-view.mui-grid-view .mui-badge{ position:absolute;}
.scale .mui-navigate-right:after{font-family:Muiext;content: "\e656";color:#f15353}
</style>
<div class="mui-content">
<div id="app">
	<div style="">
		<div id="extension-box">
			<div id="header">
				<div class="top">
					<div class="img">
						<img style="width: 100%; height: 100%;" src="<?php  echo $_W['member']['avatar'];?>">
					</div>
					<ul class="header-info">
						<li class="header-name"><?php  echo $_W['member']['nickname'];?></li>
						<li>
                        	<span>
                            推荐人：<?php  echo $agent['level'];?><br>
                            加入时间：<?php  echo $agent['created_at'];?><br>
                            </span>
                        </li>
					</ul>
				</div>
			</div>
            <ul class="mui-table-view mui-afterbefore-no" style="margin-top:0;">
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right" href="<?php  echo app_url('commission', array('op' => 'lower'))?>">
                    <p>&nbsp;我的客户</p>
                    <span class="mui-badge mui-badge-inverted"><?php  echo $agent['lowers'];?>人</span></a>
                </li>
            </ul>
            <ul class="mui-table-view mui-afterbefore-no scale">
                <li class="mui-table-view-cell js-question">
                    <a class="mui-navigate-right" href="javascript:;">
                    <p>&nbsp;默认分享奖励比例</p></a>
                </li>
                <li class="mui-table-view-cell">
                    <a href="javascript:;">
                    <p>&nbsp;佣金比例</p>
                    <span class="mui-badge mui-badge-inverted">
                    一级：<?php  echo $set['rule']['first_level_rate'];?>%
                    <?php  if($set['level']>1) { ?>
                    二级：<?php  echo $set['rule']['second_level_rate'];?>%
                    <?php  } ?>
                    <?php  if($set['level']==3) { ?>
                    三级：<?php  echo $set['rule']['third_level_rate'];?>%
                    <?php  } ?>
                    </span></a>
                </li>
            </ul>
            <div class="mui-card mui-one">
                <div class="mui-card-header mui-card-media" style="padding:0;">
                    <ul class="mui-table-view">
                        <li class="mui-table-view-cell">
                            <a href="javascript:;"><p>&nbsp;佣金</p></a>
                        </li>
                    </ul>
                </div>
                <ul class="mui-table-view mui-grid-view mui-afterbefore-no mui-text-gray" style="margin:0; padding:0;">
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;" class="mui-text-gray">
                        <span class="mui-ext-icon mui-icon-youxiaoqi"></span>
                        <div class="mui-media-body">预计佣金<br><b><?php  echo number_format($commission['1'],2)?></b>元</div></a>
                    </li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;">
                        <span class="mui-ext-icon mui-icon-myouhui-1"></span>
                        <div class="mui-media-body">未结算佣金<br><b><?php  echo number_format($commission['2'],2)?></b>元</div></a>
                    </li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;">
                        <span class="mui-ext-icon mui-icon-myue"></span>
                        <div class="mui-media-body">已结算佣金<br><b><?php  echo number_format($commission['3'],2)?></b>元</div></a>
                    </li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;" class="mui-text-gray">
                        <span class="mui-ext-icon mui-icon-mjifen"></span>
                        <div class="mui-media-body">未提现佣金<br><b><?php  echo number_format($commission['4'],2)?></b>元</div></a>
                    </li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;">
                        <span class="mui-ext-icon mui-icon-myue"></span>
                        <div class="mui-media-body">已提现佣金<br><b><?php  echo number_format($commission['5'],2)?></b>元</div></a>
                    </li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
                        <a href="javascript:;">
                        <span class="mui-ext-icon mui-icon-jinggao"></span>
                        <div class="mui-media-body">无效佣<br><b>00.00</b>元金</div></a>
                    </li>
                </ul>
            </div>
			<div class="mui-card mui-one">
                <div class="mui-card-header mui-card-media" style="padding:0;">
                    <ul class="mui-table-view">
                        <li class="mui-table-view-cell">
                            <a href="javascript:;">
                            <p>&nbsp;分享订单</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mui-card-footer mui-small" style="text-align:center">
                    <a class="mui-card-link mui-text-gray" href="<?php  echo app_url('commission/order', '', MAIN_MODULE)?>"><p><?php  echo $total0;?></p>全部订单</a>
                    <a class="mui-card-link mui-text-gray" href="<?php  echo app_url('commission/order', array('status'=>0), MAIN_MODULE)?>"><p><?php  echo $total1;?></p>未付款</a>
                    <a class="mui-card-link mui-text-gray" href="<?php  echo app_url('commission/order', array('status'=>1), MAIN_MODULE)?>"><p><?php  echo $total2;?></p>已付款</a>
                    <a class="mui-card-link mui-text-gray" href="<?php  echo app_url('commission/order', array('status'=>3), MAIN_MODULE)?>"><p><?php  echo $total3;?></p>已完成</a>
                </div>
            </div>
		</div>
		<div style="height: 6.25rem;">
		</div>
	</div>
	<!---->
</div>
</div>
<script type="text/javascript">
$(function(){
	$('.js-question').on("tap",function(e) {
		util.alert('因商品、供应商可以独立设置佣金，您最终获得的佣金可能与此比例不同', '默认推客比例');
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>