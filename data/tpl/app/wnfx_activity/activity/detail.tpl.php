<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo FX_URL;?>app/resource/css/style.css?v=20170912">
<link rel="stylesheet" type="text/css" href="<?php echo FX_URL;?>app/resource/css/detail.css?v=20211129001">
<?php  if(!empty($activity['video'])) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo FX_URL;?>app/resource/components/video/video.css?v=202111080001">
<script src="<?php echo FX_URL;?>app/resource/components/video/video.js?v=202111100001"></script>
<?php  } ?>
<style type="text/css">
#slider{position: absolute;left:0}
#slider .img-gradient{width:100%;height:0%;position:absolute;left:0;bottom:-1px;background:linear-gradient(to bottom, rgba(242,242,242,0), rgba(242,242,242,1))}
.main-inner{position:relative;margin:0;z-index:10;top:6rem;border-radius:0.45rem;transition: top 0s linear;background: #f2f2f2}
.mui-card-view .mui-media-body{color:#a6742b}
.mui-card-view .mui-table-view-cell.mui-media{border-radius:0!important;}
.mui-card .mui-media .mui-media-body .mui-ext-icon:before{color:#a2a7ab;top:48%;}

.mui-grid-view.mui-table-view .mui-table-view-cell .mui-media-body{margin:0;height:auto;line-height:1}
.mui-grid-view.mui-table-view{border:none;padding-left:0.27rem;background-color:#fafafa;border-radius:0}
.mui-grid-view.mui-table-view .mui-table-view-cell{border:none;padding:0.4rem 0.2rem}
.mui-grid-view.mui-table-view .mui-ext-icon{position:relative;padding-left:0.6rem;color:#a2a7ab;font-size:0.43rem}
.mui-grid-view.mui-table-view .mui-ext-icon:before{left:1px;color:#a2a7ab!important;font-size:0.4rem}

.pricebar>.mui-card .mui-card-header{padding:0;height:2rem;display: table;table-layout: auto;width: 100%; font-size:0.45rem;}
.pricebar>.mui-card .mui-card-header .p{display: table-cell;vertical-align: middle;height:100%}
.pricebar>.mui-card .mui-card-header .price{padding-left:10px}
.pricebar>.mui-card .mui-card-header .time{width:45%; padding-right:0.4rem;background:no-repeat left top / auto 100% url(../addons/wnfx_activity/app/resource/images/top_bg_2.png)}
.pricebar>.mui-card .mui-card-header .time .txt{text-align:right;color:#f20000;display:block}
.pricebar>.mui-card .mui-card-header .time .clockrun{color:#ff1f29}
.pricebar>.mui-card .mui-card-header .time .clockrun span{color:#fff!important;background:#ff1f29!important}
.pricebar>.mui-card .mui-card-header .mui-badge.card{border-radius:0.05rem; top:-3px; position:relative; margin-left:0.3rem}
.pricebar>.mui-card .mui-card-header .mui-badge.card em{width: 0;height: 0;left: -0.15rem; top:0;border: 0.2rem solid;border-color: #feda00 transparent transparent;position:absolute}
.pricebar>.mui-card .mui-card-content{font-size:0.6rem}
.pricebar>.mui-card .mui-card-content h5{color:#333333;line-height:1.5;font-weight:700;font-size:0.6rem;margin:0;margin-right:20%;margin-left:5px;}
.pricebar>.mui-card .mui-card-content .share{position:absolute;top:8px;font-size:0.45rem;line-height:2;right:0;padding:0.1rem 0.5rem 0.1rem 1.2rem;background:#fff2ef;color:#2e2e2e;border-radius: 0.5rem 0 0 0.5rem;}
.pricebar>.mui-card .mui-card-content .share:before{color:#fb6028;font-size:0.65rem;-webkit-transform:translateY(-50%);transform: translateY(-50%);position:absolute;top: 50%;left:0.3rem;display: inline-block;}
.pricebar>.mui-card .mui-card-footer{min-height:25px;padding:11px 15px;-webkit-justify-content:left;justify-content:left;display:block}
.pricebar>.mui-card .mui-card-footer span{ color:#828282;}
.pricebar>.mui-card .mui-card-view .mui-navigate-right:after{color:#FFF; font-size:16px;right:2px;}
.mui-card-media .mui-table-view:after{height:1px!important;}
.mui-card-media .mui-table-view a.mui-active{background:#fff;}
.mui-card.mui-one{box-shadow:none;}
.mui-card.mui-one .mui-card-footer .mui-footer-item{ margin-right:10px;}

.mui-card.mui-two .mui-card-header{ position:relative;}
.mui-card.mui-two .mui-card-header{ background:none;}
.mui-card.mui-two .mui-card-header img:first-child{ width: 36px!important;height: 36px!important;border-radius:5px;}
.mui-card.mui-two .mui-card-header .mui-media-body{ height:36px; font-size:13px; line-height:1.8!important;overflow:hidden;margin-left:48px;}
.mui-card.mui-two .mui-card-header .mui-media-body>span{ overflow:hidden; position:relative;}
.mui-card.mui-two .mui-card-header .mui-media-body i.mui-badge{ right:0; padding-top:4px;}
.mui-card.mui-two .mui-card-header .mui-media-body i.mui-badge-orange:after{content: " ";width: 200%;height: 200%;position: absolute;top: 0;left: 0;border: 1px solid #ff6f02;box-sizing: border-box;border-radius: 100px;-webkit-transform: scale(0.5);transform: scale(0.5);-webkit-transform-origin: 0 0;transform-origin: 0 0;}
.mui-card.mui-two .mui-card-header .mui-icon-renzheng3{ width:15px; height:15px;font-size:12px;line-height:15px; text-align:center;position:absolute; top:35px;left:35px;background:#fff;border-radius: 100%; z-index:999}
.mui-card.mui-two .mui-card-header .mui-icon-renzheng3:after{ color:#ff6d1f;}
.mui-card.mui-two .mui-card-content{ margin:0 10px;}
.mui-card.mui-two .mui-card-content:after{ height:0px;}
.mui-card.mui-two .mui-card-content-inner{background:#f7f7f7;border-radius:10px}
.mui-card.mui-two .mui-card-content-inner p.mui-small{ font-size:80%!important;line-height:1.5}
.mui-card.mui-two .mui-card-footer .mui-badge{font-size:0.45rem;padding:0.32rem 0.85rem;}
.mui-card.mui-two .mui-card-footer span:nth-child(3){position:relative}
.mui-card.mui-two .mui-card-footer span:nth-child(3):after{content: " ";position: absolute;border-right: 1px solid #d3d3d3;top: 50%;height: 120%;-webkit-transform: scaleX(0.5) translateY(-50%);transform: scaleX(0.5) translateY(-50%);-webkit-transform-origin: 0 100%;transform-origin: 0 100%;}

.mui-media .mui-media-header .mui-badge,.mui-index .mui-table-view .mui-badge{border-radius: 3px;padding:3px;}
.mui-media .mui-media-body p b{font-size:0.48rem;}
.mui-media.location-phone .mui-media-body{overflow:initial;position: relative}
.mui-media.location-phone .mui-media-body .mui-ext-icon{line-height:1.3;position:relative;}
.mui-media.location-phone .mui-media-body:after{content: " ";position: absolute;border-right: 1px solid #e5e5e5;top: 0px;right: -10px;height: 100%;-webkit-transform: scaleX(0.5);transform: scaleX(0.5)}
.mui-media.location-phone>a.mui-navigate-right:after{line-height:2;color:#11c0a3;font-size:1rem;right:0.35rem}
.mui-media label{font-size:0.45rem;color:#969792}
.mui-media label~.mui-media-body{padding-left:0.75rem;color:#232426}
.mui-media label~.mui-media-body p{color:#232426;font-size:0.45rem;margin-bottom:0.35rem; padding-right:0.5rem}
.mui-media label~.mui-media-body p:nth-last-child(1){margin:0}
.mui-media label~.mui-media-body .mui-badge{padding: 0 0.15rem;padding-top:1px;margin-right: 0.35rem;font-size:0.42rem;border-radius: 0.07rem;line-height:normal;display: unset}
.mui-media label~.mui-media-body .mui-badge-red2{color:#e3604d!important;background-color: #fee9e6!important;}
.market-box.mui-table-view:before{left:14px;}

.market-box span.mui-badge-orange.mui-badge-outlined{padding:1px 5px;font-size:11px;position:relative;}
.market-box span.mui-badge-orange.mui-badge-outlined:before{border-radius:10px;}
.market-box span.mui-badge-orange.mui-badge-outlined~span{padding-left:0.1rem;}

.join-none{background:rgba(0, 0, 0, 0.75);box-shadow:none;-webkit-box-shadow:none;}
.join-none .mui-btn{background:none!important;border:none!important; color:#fff}
.mui-icon-location-fill:after{content: '\e333';}
footer.mui-bar.mui-bar-tab,footer.mui-bar.mui-bar-tab .mui-tab-item{height:2rem!important;}
footer.mui-bar.mui-bar-tab .mui-tab-item{color:#333333;}
footer.mui-bar.mui-bar-tab .mui-tab-item .mui-icon{width:20px;height:20px;top:0px;}
footer.mui-bar.mui-bar-tab .mui-ext-icon:before{font-size:16px;color:#929292;font-weight:bold}
footer.mui-bar.mui-bar-tab .mui-active.mui-ext-icon:before{color:#ff5100;}
footer.mui-bar.mui-bar-tab .mui-btn{font-size:16px!important;width:85%;line-height:1.6;top:0!important;border-radius:1rem!important;}
footer.mui-bar.mui-bar-tab .mui-gradient-orange{background:-webkit-linear-gradient(left, rgba(255,202,0,1) 0%, rgba(255,148,2,1) 100%);background:-moz-linear-gradient(left, rgba(255,202,0,1) 0%, rgba(255,148,2,1) 100%);background:-o-linear-gradient(left, rgba(255,202,0,1) 0%, rgba(255,148,2,1) 100%);background:linear-gradient(left, rgba(255,202,0,1) 0%, rgba(255,148,2,1) 100%);color:#fff!important}

.process .mui-card-footer{padding:10px 15px!important;}
.process .mui-card-footer:after{position:absolute;left:5px;right:5px;bottom:0;height:1px;background-color:#ededed;content:"";-webkit-transform: scaleY(0.5);transform: scaleY(0.5);}
.process .mui-card-footer .mui-card-link{color:#333}
.process .mui-card-footer:last-child:after{height:0;}
.process .mui-card-footer:first-child .mui-card-link .mui-ext-icon:before{font-size:20px;}
.process .mui-card-footer:last-child .mui-card-link .mui-ext-icon:before{font-size:16px;}
.process .mui-card-footer:last-child .mui-card-link{ padding:10px 0}
.process .mui-card-footer:last-child .mui-navigate-right:after{ right:auto; font-size:24px}
</style>
<?php  if($activity['atype']!=4) { ?>
<footer class="mui-bar mui-bar-tab">
    <?php  if($activity['show']==1 && $activity['review']==1) { ?>
        <?php  if($_W['_config']['homebtn']!='0') { ?>
        <a class="mui-tab-item" href="<?php echo $_W['_config']['homeurl']!=''?$_W['_config']['homeurl']:app_url('home')?>" style="width:1%;">
            <span class="mui-icon mui-ext-icon mui-icon-merchants"></span>
            <span class="mui-tab-label">首页</span>
        </a>
        <?php  } ?>
        <?php  if($_W['_config']['kefu']['switch']) { ?>
        <a class="mui-tab-item<?php  if($_W['_config']['kefu']['type']!=2) { ?> js-popover<?php  } ?>" data-popover="kefu" data-type="kefu" href="<?php  if($_W['_config']['kefu']['type']==2) { ?><?php  echo $_W['_config']['kefu']['url'];?><?php  } else { ?>javascript:;<?php  } ?>"  style="width:1%;">
            <span class="mui-icon mui-ext-icon mui-icon-kefu4"></span>
            <span class="mui-tab-label">客服</span>
        </a>
        <?php  } ?>
        <a class="mui-tab-item" data-type="favorite" data-favorite="<?php  if($favo) { ?>0<?php  } else { ?>1<?php  } ?>" style="width:1%;">
            <span class="mui-icon mui-ext-icon mui-icon-favorite js-favorite<?php  if($favo) { ?> mui-active<?php  } ?>"></span>
            <span class="mui-tab-label">收藏</span>
        </a>        
        <a class="mui-tab-item <?php  echo $joinJs;?>" href="<?php  echo $joinUrl;?>" data-popover="selector" style="width:3%;">
            <span class="mui-btn <?php  if($joinbtnActive) { ?>mui-btn-yellow<?php  } else { ?>mui-btn-default<?php  } ?>"><?php  echo $joinbtnName;?></span>
        </a>
    <?php  } else { ?>
        <a class="mui-tab-item" href="javascript:;">
            <span class="mui-btn mui-btn-default">仅供浏览</span>
        </a>
    <?php  } ?>
</footer>
<?php  } ?>

<?php  if($_W['_config']['fbtn']!='0') { ?>
<div id="touchbtn" style="position:fixed;bottom:4.7rem;right:0.65rem;z-index:999;opacity:0.65">
    <a href="<?php  echo app_url('member')?>" >
       <span class="mui-ext-icon mui-icon-person" style="width:1.4rem;height:1.4rem;line-height:1.2;color:#72400b;font-size:0.75rem;text-align:center;background:#feda00;display:block;padding:0.2rem;border-radius:50%;border:0.1rem solid #fff;box-shadow:0 1px 2px rgba(0, 0, 0, 0.18);"></span>
    </a>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/followed', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/followed', TEMPLATE_INCLUDEPATH));?>
<header id="header" class="mui-bar mui-bar-header mui-bar-transparent">
	<a class="mui-header-item mui-active" data-anchor="slider"><span>基本信息</span></a>
    <?php  if(!empty($activity['info'])) { ?><a class="mui-header-item" data-anchor="info"><span>须知</span></a><?php  } ?>
    <a class="mui-header-item" data-anchor="detail"><span>详情</span></a>
</header>
<div class="mui-content">
    <div class="mui-slider m-video" id="slider">
        <div class="mui-slider-group mui-slider-loop">
            <!--支持循环，需要重复图片节点-->
            <?php  if(is_array($activity['atlas'])) { ?>
            <?php  if(is_array(array_reverse($activity['atlas']))) { foreach(array_reverse($activity['atlas']) as $row) { ?>
            <div class="mui-slider-item mui-slider-item-duplicate"><img src="<?php  echo tomedia($row)?>" /><div class="img-gradient"></div></div>
            <?php  break;?>
            <?php  } } ?>
            <?php  } ?>
            <?php  if(is_array($activity['atlas'])) { foreach($activity['atlas'] as $k => $row) { ?>
            <div class="mui-slider-item<?php  if($k==0 && !empty($activity['video'])) { ?> play-video<?php  } ?>" data-src="<?php  echo tomedia($activity['video'])?>"><img src="<?php  echo tomedia($row)?>" /><?php  if($k==0 && !empty($activity['video'])) { ?><i class="i i-bofang" style="transition: none 0s ease 0s;"></i><?php  } ?></div>
            <?php  } } ?>
            <?php  unset($k);?>
            <!--支持循环，需要重复图片节点-->
            <?php  if(is_array($activity['atlas'])) { foreach($activity['atlas'] as $row) { ?>
            <div class="mui-slider-item mui-slider-item-duplicate<?php  if(!empty($activity['video'])) { ?> play-video<?php  } ?>" data-src="<?php  echo tomedia($activity['video'])?>"><img src="<?php  echo tomedia($row)?>" /><?php  if(!empty($activity['video'])) { ?><i class="i i-bofang" style="transition: none 0s ease 0s;"></i><?php  } ?><div class="img-gradient"></div></div>
            <?php  break;?>
            <?php  } } ?>
        </div>
        <?php  if(count($activity['atlas']) > 1) { ?>
        <div class="mui-slider-indicator">
            <?php  if(is_array($activity['atlas'])) { foreach($activity['atlas'] as $k => $row) { ?>
            <div class="mui-indicator<?php  if($k==0) { ?> mui-active<?php  } ?>"></div>
            <?php  } } ?>
        </div>
        <?php  } ?>
        <div class="img-gradient"></div>
    </div>
    <script>var gallery = mui('.mui-slider');gallery.slider({interval:0});</script>
    
    <div class="main-inner">
        <div class="pricebar" id="J_PriceBar">
            <div class="mui-card mui-one" style="margin:0;">
                <div class="mui-card-header mui-card-media mui-gradient-danger" style="padding-bottom:0;">
                    <div class="p price">
                        <div>
                        <?php  if($activity['aprice'] > 0 || $activity['maxprice']['aprice']>0) { ?>
                            <span class="mui-rmb"><?php echo $activity['maxprice']['aprice'] > $activity['minprice']['aprice'] ? '<span style="font-size:180%">'.$activity['minprice']['aprice'].'</span> 起':'<span style="font-size:180%">'.$activity['minprice']['aprice'].'</span>';?></span>
                        <?php  } else { ?>
                            <span style="font-size:140%"><?php  if($activity['freetitle']!='') { ?><?php  echo $activity['freetitle'];?><?php  } else { ?>免费活动<?php  } ?></span>
                        <?php  } ?>
                        <?php  if($_W['plugin']['card']['config']['card_enable'] && ($activity['iscard']==1 || $activity['iscard']==2)) { ?>
                            <span class="mui-badge mui-badge-yellow mui-small card" style="line-height:normal;padding:0px 2px;">
                            <em></em>
                            <?php  if($activity['iscard']==1) { ?>
                                <?php  echo $yearcard['name'];?>
                                <?php  if($activity['prize']['cardper']['enable']) { ?>
                                    <?php  echo $activity['prize']['cardper']['percent'];?> 折
                                <?php  } else { ?>
                                    <?php echo $activity['costprice'] > 0 ? '¥'.$activity['costprice'].($activity['maxprice']['costprice'] > 0?'起':''):'：免单'?>
                                <?php  } ?>
                            <?php  } ?>
                            <?php  if($activity['iscard']==2) { ?> 仅限<?php  echo $yearcard['name'];?><?php  } ?>
                            </span>
                        <?php  } ?>
                        </div>
                        <div class="mui-small">
                            <?php  if($activity['mprice'] > 0) { ?>
                                <span class="mui-del" style="margin-right:0.3rem">原价<em class="mui-rmb"><?php  echo $activity['mprice'];?></em></span> 
                            <?php  } ?>
                            <?php  if($activity['switch']['joinnum']) { ?>
                                已<?php  echo $_W['_config']['buytitle'];?> <?php  echo $joinnum;?><?php  if($activity['gnumshow']) { ?>/<?php echo $activity['gnum']>0 ? $activity['gnum'] : '名额不限'?><?php  } else { ?> 人<?php  } ?>
                            <?php  } else if($activity['gnumshow']) { ?>
                                <?php echo $activity['gnum']>0?'剩余'.($activity['gnum']-$joinnum):'名额不限'?>
                            <?php  } ?>
                        </div>
                    </div>
                    <?php  if($_W['_config']['countdown']) { ?>
                    <div class="p time countdown">
                        <?php  if(TIMESTAMP < strtotime($activity['joinstime'])) { ?>
                        <p class="txt">活动预热中</p>
                        <?php  } else { ?>
                        <p class="txt" id="J_CountDownTxt"></p>
                        <div class="clockrun mui-pull-right"></div>
                        <?php  } ?>                    	
                    </div>
                    <?php  } ?>
                </div>
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <h5 class="mui-ellipsis-2"><?php  echo $activity['title'];?></h5>
                        <?php  if(!empty($activity['intro'])) { ?><p class="mui-small mui-text-gray mui-ellipsis-2" style="margin:0;margin-left:5px;margin-top:10px; line-height:1.8"><?php  echo $activity['intro'];?></p><?php  } ?>
                        <div class="share mui-ext-icon mui-icon-fenxiang" onclick="openFun.guide(1);"> 转发</div>
                        <?php  if($_W['plugin']['card']['config']['card_enable'] && ($activity['iscard']==1 || $activity['iscard']==2)) { ?>
                        <ul class="mui-table-view mui-afterbefore-no mui-card-view" style="margin-top:10px">
                            <li class="mui-table-view-cell mui-media">
                                <a href="<?php  if($is_vip) { ?>javascript:;<?php  } else { ?><?php echo $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=cardfans&m=' . PLUGIN_CARD;?><?php  } ?>" style="background: #fcf5e3;border-radius:20rem;">
                                <div class="mui-media-body">
                                    <?php  echo $yearcard['name'];?>专享
                                    <p class="mui-small mui-text-gray">开通<?php  echo $yearcard['name'];?>，下单可享受专属特权</p>
                                </div>
                                <?php  if(!$is_vip) { ?>
                                <span class="mui-badge mui-gradient-orange mui-navigate-right " style="padding:8px;padding-right:20px">
                                <?php  if(!empty($vipdata) && TIMESTAMP > $vipdata['end_time']) { ?>立即续费<?php  } else { ?>立即开通<?php  } ?>
                                </span>
                                <?php  } else { ?>
                                <span class="mui-badge mui-gradient-orange">已开通</span>
                                <?php  } ?></a>
                            </li>
                        </ul>
                        <?php  } ?>
                    </div>
                </div>
                <ul class="mui-table-view mui-grid-view mui-grid-9">
                    <li class="mui-table-view-cell mui-media">
                        <div class="mui-media-body"><span class="mui-ext-icon mui-icon-eye"> <?php  echo $activity['falsedata']['read']+$activity['trueread']?></span></div>
                    </li>
                    <li class="mui-table-view-cell mui-media">
                        <div class="mui-media-body"><span class="mui-ext-icon mui-icon-fenxiangs"> <?php  echo $activity['falsedata']['share']+$activity['trueshare']?></span></div>
                    </li>
                    <li class="mui-table-view-cell mui-media">
                        <div class="mui-media-body"><span class="mui-ext-icon mui-icon-shoucang"> <?php  echo $favonum;?></span></div>
                    </li> 
                </ul>
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell mui-media" id="storeData" style="padding-right:12px;">
                        <a class="" style="background:#fff;">
                            <div class="mui-media-body">
                                <div class="mui-media-content-inner">
                                    <p class="mui-ext-icon mui-icon-shizhong">
                                        <span class="mui-pl20 mui-ellipsis-2"><?php  echo date('Y-m-d H:i',strtotime($activity['starttime']))?> 至 <?php  echo date('Y-m-d H:i',strtotime($activity['endtime']))?></span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php  if($activity['hasonline']) { ?>
                    <li class="mui-table-view-cell mui-media">
                        <a style="background:#fff;">
                            <div class="mui-media-body">
                                <div class="mui-media-content-inner">
                                    <p class="mui-ext-icon mui-icon-dingwei">
                                        <span class="mui-pl20 mui-ellipsis-2 mui-text-gray">线上活动（无须现场参与）</span>
                                    </p>
                                </div>
                
                            </div>
                        </a>
                    </li>
                    <?php  if(!empty($merchant['tel'])) { ?>
                    <li class="mui-table-view-cell mui-media location-phone">
                        <a class="mui-navigate-right mui-icon-phone-fill" href="tel:<?php  echo $merchant['tel'];?>">
                            <div class="mui-media-body">
                                <div class="mui-media-content-inner">
                                    <p class="mui-ext-icon mui-icon-phone">
                                        <span class="mui-pl20 mui-ellipsis-2 mui-text-gray"><?php  echo $merchant['tel'];?></span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php  } ?>
                    <?php  } ?>               
                </ul>
                
            </div>
        </div>
        
        <?php  if(!empty($marketing['0']) || !empty($marketing['1']) || !empty($marketing['2']) || $activity['prize']['credit'] || $activity['prize']['share_credit'] || $activity['prize']['sign_credit']) { ?>
        <div class="mui-card mui-one">
            <div class="mui-card-content">
                <ul class="mui-table-view market-box mui-afterbefore-no">
                    <?php  if(!empty($marketing['0']) || !empty($marketing['1']) || !empty($marketing['2'])) { ?>
                    <li class="mui-table-view-cell mui-media">
                        <a class="mui-navigate-right navigate-bottom js-popover" data-popover='marketing'>
                        <label class="mui-pull-left">优惠</label>
                        <div class="mui-media-body">                            
                            <?php  if(!empty($marketing['0'])) { ?>
                                <p><span class="mui-badge mui-badge-red2">折扣</span>
                                单次下单满<?php  echo $marketing[0][0]['meet'];?>名<?php  echo $marketing[0][0]['give'];?>折</p>
                            <?php  } ?>               
                            
                            <?php  if(!empty($marketing['1'])) { ?>
                                <p><span class="mui-badge mui-badge-red2">满减</span>
                                单次下单满<?php  echo $marketing[1][0]['meet'];?>名，省<?php  echo $marketing[1][0]['give'];?>元</p>
                            <?php  } ?>
                            
                            <?php  if(!empty($marketing['2'])) { ?>
                                <p class="mui-ellipsis"><span class="mui-badge mui-badge-red2">会员组专享</span>
                                <?php  if(is_array($marketing['2'])) { foreach($marketing['2'] as $ii => $v) { ?>
                                    <?php  if($v['discount']) { ?>
                                       <?php  echo $v['grouptitle'];?><?php  echo $v['discount'];?>折
                                    <?php  } else { ?>
                                       <?php  echo $v['grouptitle'];?>立减<?php  echo $v['money'];?>元
                                    <?php  } ?>
                                    <?php echo $ii+1 < count($marketing[2])?'、':''?>
                                <?php  } } ?>
                                </p>
                            <?php  } ?>                            
                        </div>
                        </a>
                    </li>
                    <?php  } ?>
                    <?php  if($activity['prize']['credit'] || $activity['prize']['share_credit'] || $activity['prize']['sign_credit']) { ?>
                    <li class="mui-table-view-cell mui-media">
                        <a class="mui-navigate-right navigate-bottom js-popover" data-popover='marketing_1'>
                        <label class="mui-pull-left">活动</label>
                        <div class="mui-media-body">
                            <p>
                                <span class="mui-badge mui-badge-red2"><?php  echo m('member')->getCreditName('credit1')?>奖励</span>
                                <?php  if($activity['prize']['credit']) { ?>
                                    <span><?php  echo $_W['_config']['buytitle'];?>可得 <?php  echo $activity['prize']['credit'];?> <?php  echo m('member')->getCreditName('credit1')?></span>
                                <?php  } else if($activity['prize']['share_credit']) { ?>
                                    <span>分享可得 <?php  echo $activity['prize']['share_credit'];?>  <?php  echo m('member')->getCreditName('credit1')?></span>
                                <?php  } else { ?>
                                <span>签到可得 <?php  echo $activity['prize']['sign_credit'];?>  <?php  echo m('member')->getCreditName('credit1')?></span>
                                <?php  } ?>
                            </p>
                        </div>
                        </a>
                    </li>
                    <?php  } ?>
                </ul>                        
            </div>
        </div>
        <?php  } ?>
        
        <div class="content">
            <!-- 基本信息 -->
            <?php  if($activity['switch']['avatar'] && (!empty($records) || $activity['falsedata']['num'])) { ?>
            <div class="M_detail" style="margin-top:10px;">
                <div class="mod_tab" style="display:none"><span>男士：<?php  echo $gender['man'];?>人&nbsp;&nbsp;&nbsp;&nbsp;女士：<?php  echo $gender['women'];?>人</span></div>
                <ul class="mui-table-view mui-before-no" style="margin-top:0">
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href="<?php  echo app_url('home/user', array('id'=>$id))?>"><p>已<?php  echo $_W['_config']['buytitle'];?><?php  if($activity['switch']['joinnum']) { ?>(<?php  echo $joinnum;?>)<?php  } ?></p><span class="mui-badge mui-badge-inverted">查看全部</span></a>
                    </li>
                </ul>
                <div class="detail-item detail-more">
                <a href="<?php  echo app_url('home/user', array('id'=>$id))?>" class="more-user">
                <?php  if(is_array($records)) { foreach($records as $i => $row) { ?>
                <div class="bm-user">
                <?php  if($row['buynum']>1) { ?><div class="mui-badge mui-badge-purple" style="position:absolute;z-index:10;top:20px;right:-10px;padding:2px 4px;background:rgba(138,109,233,0.95)">× <?php  echo $row['buynum'];?></div><?php  } ?>
                <img src="<?php  echo tomedia($row['avatar']);?>"/>
                <p class="mui-small mui-text-gray"><?php  echo $row['nickname'];?></p>
                </div>
                <?php  } } ?>
                <?php  if($i<11) { ?>
                    <?php  if(is_array($activity['falsedata']['head'])) { foreach($activity['falsedata']['head'] as $k => $headurl) { ?>
                    <?php  if($k > $activity['falsedata']['num']-1 || $k > 11-$i) { ?><?php  break;?><?php  } ?>
                    <div class="bm-user">
                    <img src="<?php  echo tomedia($headurl);?>" />
                    <p class="mui-small mui-text-gray"><?php  echo $activity['falsedata']['nickname'][$k];?></p>
                    </div>
                    <?php  } } ?>
                <?php  } ?>
                </a>
                </div>
            </div>
            <?php  } ?>  
            <div class="mui-card mui-one mui-two" style="font-family:'微软雅黑'">
                <div class="mui-card-header mui-card-media">
                    <a  class="mui-navigate-right" href="<?php  if($_W['_config']['merch']==1) { ?><?php  echo app_url('member/profile',array('id'=>$merchant['id'],'muid'=>$merchant['uid']));?><?php  } else { ?>javascript:;<?php  } ?>">
                        <img src="<?php  echo $merchant['logo'];?>">
                        <?php  if($merchant['iscert']) { ?>
                        <span class="mui-ext-icon mui-icon-renzheng3"></span>
                        <?php  } ?>
                        <div class="mui-media-body">
                            <span class="mui-ellipsis"><b><?php  echo $merchant['name'];?></b></span>
                            <p class="mui-small"><?php  echo $merchant['goods'];?> 场活动 │ <?php  echo number_format($fansnum,0)?> 人关注</p>
                        </div>
                    </a>
                </div>
                <div class="mui-card-content">
                    <?php  if(!empty($merchant['detail'])) { ?>
                    <div class="mui-card-content-inner">
                        <p class="mui-ellipsis-3 mui-text-gray mui-small" style="margin:0;"><?php  echo $merchant['detail'];?></p>
                    </div>
                    <?php  } ?>
                </div>
                <?php  if($_W['_config']['kefu']['switch'] || $_W['_config']['merch']==1) { ?>
                <div class="mui-card-footer">
                    <div> </div>
                    <?php  if($_W['_config']['kefu']['switch']) { ?>
                    	<?php  if($_W['_config']['kefu']['type']==1) { ?>
                    	<div class="js-popover" data-popover="kefu" data-type="kefu"><span class="mui-badge mui-badge-outlined"><i class="mui-ext-icon mui-icon-kefu4"> </i>联系Ta</span></div>
                        <?php  } else { ?>
                        <div><a href="<?php  echo $_W['_config']['kefu']['url'];?>" style="display:block"><span class="mui-badge mui-badge-outlined"><i class="mui-ext-icon mui-icon-kefu4"> </i>联系Ta</span></a></div>
                        <?php  } ?>
                    <?php  } ?>
                    <?php  if($_W['_config']['merch']==1) { ?><div><a href="<?php  echo app_url('member/profile',array('id'=>$merchant['id'],'muid'=>$merchant['uid']))?>" style="display:block"><span class="mui-badge mui-badge-outlined"><i class="mui-ext-icon mui-icon-merchants"> </i>进入主页</span></a></div><?php  } ?>
                    <div> </div>
                </div>
                <?php  } ?>
            </div>
            
            <div class="mui-card mui-one process" style="margin-bottom:0px;">
                <div class="mui-card-content">
                    <?php  if($_W['plugin']['poster']['config']['commission_enable'] && $activity['prize']['commission']) { ?>
                    <?php  if(!$_W['plugin']['poster']['config']['become'] || (isset($agent['parent_id']) && $agent['parent_id']==0)) { ?>
                    <div class="mui-card-footer">
                        <div class="mui-card-link" style="white-space:nowrap;">分享好友<?php  echo $_W['_config']['buytitle'];?><?php  if(!empty($agent)) { ?>获取<span class="mui-text-orange"> <?php  echo $commission_rule['first_level_rate'];?>% </span>奖励<?php  } else { ?>有惊喜<?php  } ?>
                        <br><span class="mui-text-gray mui-small">发朋友圈成功率更高</span></div>
                        <div class="mui-card-link mui-text-center mui-small" onclick="openFun.guide(1);"><span class="mui-ext-icon mui-icon-wechat mui-text-success"></span><br>发给好友</div>
                        <div class="mui-card-link mui-text-center mui-small" onclick="util.program.navigate('<?php  echo app_url('activity/poster',array('id'=>$id))?>')"><span class="mui-ext-icon mui-icon-tupian mui-text-org"></span><br>获取海报</div>
                    </div>
                    <?php  } ?>
                    <?php  } ?>
                    <?php  if($activity['atype']!=4) { ?>
                    <div class="mui-card-footer">
                        <div class="mui-card-link mui-text-center" style="line-height:1;">流程</div>
                        <div class="mui-card-link mui-text-center mui-small mui-navigate-right"><span class="mui-ext-icon mui-icon-01 mui-text-rmb"></span>参加<?php  echo $_W['_config']['buytitle'];?></div>
                        <div class="mui-card-link mui-text-center mui-small mui-navigate-right"><span class="mui-ext-icon mui-icon-02 mui-text-rmb"></span>提交资料</div>
                        <div class="mui-card-link mui-text-center mui-small"><span class="mui-ext-icon mui-icon-03 mui-text-rmb"></span>参与</div>
                    </div>
                    <?php  } ?>
                </div>
            </div>
            
            <?php  if(!empty($activity['info'])) { ?>
            <div class="mui-card mui-one details" id="info" style="margin-top:10px;">
                <div class="mui-card-header mui-card-media"><?php  echo $_W['_config']['buytitle'];?>须知</div>
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <?php  echo $activity['info'];?>
                    </div>
                </div>
            </div>
            <?php  } ?>
            
            <div class="mui-card mui-one details" id="detail" style="margin-top:10px">
                <div class="mui-card-header mui-card-media">活动详情</div>
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <?php  echo $activity['detail'];?>
                    </div>
                </div>
            </div>
            
            <div style="height:65px;"></div>
        </div>
    </div>

</div>
<div id="guide" onclick="openFun.guide(0);">
    <img src="<?php echo FX_URL;?>app/resource/images/guide.png" width="60%">
    <?php  if($_W['plugin']['poster']['config']['poster_enable']) { ?>
    <div class="mui-content-padded" style="margin-top:30%">
        <input type="button" name="submit" class="mui-btn mui-btn-yellow mui-btn-block" onclick="javascript:util.program.navigate('<?php  echo app_url('activity/poster',array('id'=>$id, 'mid'=>$mid))?>')" value="生成专属海报">
    </div>
    <?php  } ?>
</div>
<div class="floatbar rlower">
	<div class="backtop mui-ext-icon mui-icon-top head-backtop" onclick="javascript:$(window).scrollTop(0)"></div>
</div>
<?php  if($activity['hasoption'] == '1') { ?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/activity_option', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/activity_option', TEMPLATE_INCLUDEPATH));?><?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/popover', TEMPLATE_INCLUDEPATH));?>
<script type="text/html" id="storeTpl">
{{# if(d.total>=1){ }}
<li class="mui-table-view-cell mui-media location-phone">
	<a class="mui-navigate-right mui-icon-location-fill" onClick="openFun.wxMap({{d.lat}},{{d.lng}},'{{d.storename}}','{{d.address}}');" >
		<div class="mui-media-body">
			<div class="mui-media-content-inner">
				<p class="mui-ext-icon mui-icon-dingwei">
					<span class="mui-pl20">{{d.storename}}</span>
					<span class="mui-pl20 mui-ellipsis-2 mui-small mui-text-gray">{{d.address}}<?php  if($_W['_config']['location']) { ?> {{d.distance}}<?php  } ?></span>					
				</p>
			</div>
		</div>
	</a>
</li>
{{# }else{ }}
<li class="mui-table-view-cell mui-media">
	<a class="mui-navigate-right navigate-bottom js-popover" data-popover="storelist">
		<div class="mui-media-body">
			<div class="mui-media-content-inner">
				<p class="mui-ext-icon mui-icon-dingwei">
					<span class="mui-pl20">{{d.storename}}</span>
					<span class="mui-pl20 mui-ellipsis-2 mui-small mui-text-gray">{{d.address}}<?php  if($_W['_config']['location']) { ?> {{d.distance}} 离我最近<?php  } ?></span>					
				</p>
			</div>
		</div>
	</a>
</li>
{{# } }}
{{# if(d.tel!=''){ }}
<li class="mui-table-view-cell mui-media location-phone">
	<a class="mui-navigate-right mui-icon-phone-fill" href="tel:{{d.tel}}">
		<div class="mui-media-body">
			<div class="mui-media-content-inner">
				<p class="mui-ext-icon mui-icon-phone">
					<span class="mui-pl20 mui-ellipsis-2 mui-text-gray">{{d.tel}}</span>
				</p>
			</div>
		</div>
	</a>
</li>
{{# } }}
</script>
<script>
$('.mui-bar-tab').on('tap','a',function(e){
	if ($(this).data('type')!=undefined){
		if ($(this).data('type')=='favorite'){
			openFun.setProperty(this, "<?php  echo $activity['id'];?>", 'favorite');
		}
	}	
});
var container = "<?php  echo $_W['container'];?>";
var openFun = {
	guide:function(a){
		if (a==1){			
			$('#guide').show();
		}else{
			$('#guide').hide();
		}
		
	},
	wxMap:function(lat,lng,name,address){
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
	},
	loadstore:function(latitude, longitude){
		var pageStart = 0,pageEnd = 0,thispage = 1,thispsize = 10;
		$('#storelist').find('.mui-scroll').dropload({
			scrollArea : $('#storelist').find('.mui-scroll-wrapper'),
			threshold : 50,
			loadDownFn : function(me){				
				$.post("<?php  echo app_url('activity/detail/getstore',array('id'=>$id))?>",{lat:latitude,lng:longitude,page:thispage}, function(data){
					var gettpl = document.getElementById('storeTpl').innerHTML;
					if (thispage >= data.tpage || data.tpage == 0){
						me.lock();// 锁定
						me.noData();// 无数据
					}
					if (data.list[0]!=null && thispage==1) {
						var store = data.list[0];						
						if (data.total==1) store.total = 1;
						laytpl(gettpl).render(store, function(html){							
							$(html).insertAfter('#storeData');
						});				
						if (data.total==1) return false;
					}
					
					$.each(data.list, function(i, o) {
						o.total = data.total;
						laytpl(gettpl).render(o, function(html){
							html = '<ul class="mui-table-view mui-table-view-chevron">'+html+'</ul>';
							$('#storelist .list-content').append(html);
						});
					});
						//$('#storeData').append(arr.join(''));
					thispage++;
					// 每次数据加载完，必须重置
					me.resetload();
				}, 'json');
			}
		});
	},
	setProperty:function(obj,id,op){/*收藏 */
		var total_favo = parseInt($(obj).find('em').text());
		var favorite = parseInt($(obj).attr('data-favorite'));
		util.loading();
		$.post("<?php  echo app_url('activity/detail/favorite')?>",{id:id,favorite:favorite,type:'<?php  echo $_GPC["ac"];?>'},function(d){
			util.loading().close();
			if (op=='favorite'){
				if(d.result=='1'){;
					util.tips(d.data?'取消收藏':'收藏成功');
					$(obj).attr("data-favorite",d.data);
					if (d.data){
						$('.js-favorite').removeClass("mui-active");
					}else{
						$('.js-favorite').addClass("mui-active");
					}
					
					$(obj).find('em').text(' ' + (d.data?total_favo-1:total_favo+1));
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
					util.tips('收藏失败');
				}
			}
		},"json");
	}
}
<?php  if(!$activity['hasonline']) { ?>
openFun.loadstore(position.lat,position.lng);
<?php  } ?>
//关注
$('.js-merch-follow').on("tap",function(e) {
	var $this = $(this);
	util.loading();
	$.post("<?php  echo app_url('member/profile/follow')?>",
	{id:$this.data('id'),muid:$this.data('muid'),follow:$this.attr('data-follow'),type:'<?php  echo $_GPC["ac"];?>'},function(d){
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
//计时
var sh,joinstime = "<?php  echo $activity['joinstime'];?>",joinetime = "<?php  echo $activity['joinetime'];?>";
FreshTime(".clockrun",joinstime,joinetime);
sh=setInterval(function(){FreshTime(".clockrun",joinstime,joinetime)},1000);
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
		lefttime = -1; 
	if (start_time > now_time){
		lefttime = parseInt((start_time - now_time)/1000);
	}else if(end_time > now_time){
		lefttime = parseInt((end_time - now_time)/1000);
		//console.log(lefttime);
	}
	//var bar_width =  (1-(lefttime/3600))*100+"%"; //计算进度条百分比
	if (lefttime >= 0) {
		dd=util.pad(parseInt((lefttime/86400)),2);
		hh=util.pad(parseInt((lefttime/3600))-dd*24,2);
		mm=util.pad(parseInt((lefttime/60)%60),2);
		ss=util.pad(parseInt(lefttime%60),2);
		var clockrun ='<span id="ti_time_hour">'+hh+'</span>:<span id="ti_time_min">'+mm+'</span>:<span id="ti_time_sec">'+ss+'</span>';
		clockrun = dd!='00' ? '<span id="ti_time_day">'+dd+'</span> 天 ' + clockrun : clockrun;
		if (start_time > now_time){
			$('#J_CountDownTxt').text('距开始<?php  echo $_W['_config']['buytitle'];?>');
			$('.js-join').find('span.mui-btn').text('<?php  echo $_W['_config']['buytitle'];?>还未开始');
			$(id).html(clockrun);
		}else if(end_time > now_time){
			var hasoption = parseInt("<?php  echo $activity['hasoption'];?>");
			var guanzhu = parseInt("<?php  echo $_W['_config']['guanzhu_join'];?>");
			var follow = parseInt("<?php  echo $_W['fans']['follow'];?>");
			$('#J_CountDownTxt').text('距<?php  echo $_W['_config']['buytitle'];?>结束');
			if (((guanzhu==2 && follow) || guanzhu==1) && container=='wechat'){
				$('.js-join').attr('href',"<?php  echo $joinUrl;?>");
				if (hasoption){
					$('.js-join').addClass("<?php  echo $joinJs;?>");
				}
			}
			$('.js-join').find('span.mui-btn').text('<?php  echo $joinbtnName;?>');
			$('.js-join').find('span.mui-btn').removeClass('mui-btn-default');
			$('.js-join').find('span.mui-btn').addClass('mui-btn-yellow');
			$(id).html(clockrun);
		}
		//$('#progressbar').css("width",bar_width);
	}else{
		$('.js-join').attr('href','javascript:;');
		$('.js-join').removeClass('js-selector');
		$('.js-join').find('span.mui-btn').text('<?php  echo $_W['_config']['buytitle'];?>结束');
		$('.js-join').find('span.mui-btn').addClass('mui-btn-default');
		$('.js-join').find('span.mui-btn').addClass('mui-btn-yellow');
		$('#J_CountDownTxt').text('<?php  echo $_W['_config']['buytitle'];?>结束');
		$('.clockrun').remove();
	}
}

$(function() {
	var imgdefereds=[];
	$('#slider img').each(function(){
		var dfd=$.Deferred();
		$(this).bind('load',function(){
			dfd.resolve();
		}).bind('error',function(){
			//图片加载错误，加入错误处理
			// dfd.resolve();
		})
		if(this.complete) dfd.resolve();
		//setTimeout(function(){			dfd.resolve();		}, 100);
		imgdefereds.push(dfd);
	})
	$.when.apply(null,imgdefereds).done(function(){
		//主区域覆盖效果调整
		//$("#vm").animate({"opacity": 0}, 1500);
		var sliderH = $('#slider').height(), sliderW = $('#slider').width();
		if (sliderW - sliderH < 0) {
			$('.main-inner').css({'top':(sliderH-10)+'px'});
		}else{
			$('.main-inner').css({'top':(sliderH-10)+'px'});
		}
		//背景上滑动移动效果
		var bodyBox = document.querySelector('body');
		var bodyH = bodyBox.offsetHeight;
		$(window).scroll(function(){
			var top = $(this).scrollTop();			
			var sliderTop = (top / bodyH * sliderH) / htmlFont;
			$('#slider').css('top', sliderTop * 0.45 +'rem');
		});
	});
	var $headerList = $('#header .mui-header-item'),
		headerHeight = $('#header').height(),
		contTopList = [];
	$headerList.each(function(){
		var anchor = '#' + $(this).data("anchor");
		contTopList.push($(anchor).offset().top + headerHeight);
	});
	console.log("contTopList---,", contTopList);
	$(window).scroll(function(){
		if ($(this).scrollTop() >= 100) {
			$(".backtop").addClass('head-backtop-show');
		} else {
			$('#header .mui-header-item').eq(0).addClass('mui-active').siblings().removeClass('mui-active');
			$(".backtop").removeClass('head-backtop-show');
		}
		$headerList.each(function(i){
			var anchor = $(this).data("anchor");				
			if ($(window).scrollTop() >= contTopList[i]) {
				$(this).addClass('mui-active').siblings().removeClass('mui-active');
			}
		});
	});
	$('#header .mui-header-item').click(function() {
		var anchor = $(this).data("anchor");		
		$('html,body').animate({
			scrollTop: $('#'+anchor).offset().top - headerHeight
		}, 300); 
	});
	mui('.mui-bar-transparent').transparent({top:50});
});

//阅读量计数器
$.post("<?php  echo app_url('activity/detail/read',array('id'=>$activity['id']))?>",function(d) {},"json");
<?php  if($_W['plugin']['card']['config']['card_enable'] && ($activity['iscard']==1 || $activity['iscard']==2) && !empty($vipdata) && TIMESTAMP > $vipdata['end_time'] && $vipdata['remind']) { ?>
util.confirm('高级会员已过期，是否续费!', ' ', ['不再提醒', '是'], function(e) {
	if (e.index == 1) {
		location.href = "<?php echo $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=cardfans&m=' . PLUGIN_CARD;?>";
	}else{
		$.post("<?php echo $_W['siteroot'] . 'app/index.php?i='.$_W['uniacid'].'&c=entry&do=set&m=' . PLUGIN_CARD;?>", {id:"<?php  echo $vipdata['id'];?>"},function(d){
				
		},"json");
	}
});
<?php  } ?>
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>