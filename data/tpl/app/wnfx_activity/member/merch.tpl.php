<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-table-view{margin-bottom:18px;}
.mui-table-view-cell{padding: 11px 12px;}
.mui-card.mui-one{box-shadow:none;}
.mui-card-header{background:#f76a0e}
.mui-card-header .mui-table-view{background:linear-gradient(to bottom right, #f96a0c 10%, #f96a0c 0%, #fca204 60%);}
.mui-card-header .mui-table-view-cell.mui-media{min-height:3rem;background:no-repeat url(<?php  echo tomedia('addons/wnfx_activity/app/resource/images/header_1.png')?>);background-size:auto 100%;-moz-background-size:auto 100%;}
.mui-card-header .mui-table-view-cell.mui-media:after{height:0;}
.mui-card-header .mui-table-view-cell p:first-child{ font-size:16px;min-height:8px;line-height:28px;margin-bottom:15px;position:relative;}
.mui-card-header .mui-table-view-cell .mui-icon-fanhui1{padding-right:32px; margin:0 12px 0 5px; position:relative; color:#fff;}
.mui-card-header .mui-table-view-cell .mui-icon-fanhui1:active{color:#5b5855;}
.mui-card-header .mui-table-view-cell .mui-icon-fanhui1:after{content: ""; position:absolute; right:0; top:50%; width:0.5px;border-right:1px solid #5b5855; height:120%;-webkit-transform: translateY(-50%) scaleX(0.5); transform: translateY(-50%) scaleX(0.5);}
.mui-card-header .mui-table-view-cell:last-child{background:-webkit-linear-gradient(left, #f96a0c 10%, transparent 0%);padding:0;}
.mui-card-header .mui-table-view-cell:last-child div{background:#FFF;padding:5px;border-radius:9px 9px 0 0!important;}

.mui-card-header .mui-media, .mui-card-header .mui-media p{color:#FFF;}
.mui-card-header .mui-media .mui-navigate-right:after{color:#FFF;font-size:1rem;right:0!important;}
.mui-card-header .mui-media .mui-media-body{padding:inherit;padding-top:1rem;padding-bottom:1rem;min-height:4rem!important;}
.mui-card-header .mui-media .mui-media-body .mui-media-object{max-width:2rem;height:2rem;margin-right:0.35rem;vertical-align:middle;float:left;}
.mui-card-header .mui-media .mui-media-body .mui-media-object img{width:2rem!important;height:2rem!important;box-shadow: 0 1px 2px rgba(0,0,0,0.35);border-radius:50%;}
.mui-card-header .mui-media .mui-media-body .mui-media-object~p{line-height:1.2;font-size:0.55rem;padding-top:0.42rem;}

.mui-card-header .mui-media .mui-media-body .mui-media-object~p span.credit i{ position:relative; padding-right:10px;font-style:normal;}
.mui-card-header .mui-media .mui-media-body .mui-media-object~p span.credit i:after{content: ""!important;width: 0;height: 0;border-top: .21rem solid transparent;border-left:.21rem solid #fff;border-bottom: .21rem solid transparent;margin-left: .18rem;font-size: 0;position: absolute;top:48%;transform: translate(-48%, -48%);-webkit-transform: translate(-48%, -48%);}
.mui-card-header .mui-media .mui-badge{right:1rem;padding-left:0.8rem;font-size:0.5rem!important;background:rgba(255,255,255,0.25)!important;padding-top:5px;color:#fff!important}
.mui-card-header .mui-media .mui-icon-renzheng1:before{left:5px;color:#ffd67c;font-size:0.5rem;top:53%}

.mui-card-footer{ background-color:#2c2623!important;padding-top: 12px!important;}
.mui-card-footer .mui-card-link{ width:50%; color:#959290; font-size:12px; line-height:1; position:relative;margin-left:0}
.mui-card-footer .mui-card-link:first-child:after{content: ""; position:absolute; right:0; top:50%; width:0.5px;border-right:1px solid #5b5855; height:100%;-webkit-transform: translateY(-50%) scaleX(0.5); transform: translateY(-50%) scaleX(0.5);}
.mui-card-footer .mui-ext-icon{ font-size:20px; line-height:1;color:#959290;margin-bottom: 8px;}

.mui-grid-view{background:#fff!important;border:none!important;}
.mui-grid-view .mui-table-view-cell{ border:none!important;background-color:#fff!important;padding: 8px 15px!important; position:relative}
.mui-grid-view .mui-table-view-cell:last-child:after{ border:none;}
.mui-grid-view span.mui-ext-icon{ position:relative; width:30px; height:25px; margin:0 auto;display:inline-block;}
.mui-grid-view span.mui-ext-icon:before{left:50%;transform: translate(-50%,-50%);-webkit-transform: translate(-50%,-50%);font-size:22px;background:linear-gradient(to bottom right, #f67f0b 10%, #fec200);-webkit-background-clip: text;color: transparent;}
.mui-grid-view span.mui-ext-icon.mui-icon-qianbao:before{ font-size:18px;}
.mui-grid-view .mui-badge{ position:absolute;}
.mui-grid-view .mui-table-view-cell .mui-media-body{font-size:14px!important;line-height:1.2!important;color:#666!important}
.mui-grid-view:nth-child(2) .mui-table-view-cell:after{content: ""; position:absolute; right:0!important; left:auto!important; top:50%;border-right:1px solid #e0e0e0; height:60%!important;-webkit-transform: translateY(-50%) scaleX(0.5); transform: translateY(-50%) scaleX(0.5);}
</style>
    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/nav', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/nav', TEMPLATE_INCLUDEPATH));?>
    <div class="mui-content">
        <div class="mui-card mui-one mui-radius-none" style="margin:0;">
        	<div class="mui-card-header" style="padding:0;">
                <ul class="mui-table-view mui-radius-none" style="margin-top: 0;">
                    <li class="mui-table-view-cell mui-media">
                    	<p style="display:none"><?php  if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android1')) { ?><a href="javascript:history.go(-1);"><span class="mui-ext-icon mui-icon-fanhui1"></span></a> 主办方中心<?php  } ?></p>
                        <div class="mui-media-body mui-navigate-right js-popover" data-popover='merch'>
                        	<div class="mui-media-object">
                            	<img src="<?php  echo $merchant['logo'];?>">
                                <?php  if(empty($merchant['logo']) || empty($merchant['name']) || empty($merchant['linkman_mobile']) || empty($merchant['linkman_name']) || empty($merchant['detail'])) { ?><?php  } ?>
                            </div>
                            <p>
                                <span><?php  echo $merchant['name'];?><br></span>
                                <span class="credit"><b><?php  if($credits['credit1']=='') { ?>0.00<?php  } else { ?><?php  echo $credits['credit1'];?><?php  } ?></b><i class="mui-small">&nbsp;&nbsp;<?php  echo m('member')->getCreditName('credit1')?></i></span>
                            </p>
                            <i class="mui-badge mui-ext-icon mui-icon-renzheng1 mui-text-success">
                            <?php  if(ADMIN) { ?>
                        		平台方
                            <?php  } else { ?>
                                <?php  if(empty($mcert)) { ?>
                                    未认证
                                <?php  } else if($mcert['status']==0) { ?>
                                    认证审核中
                                <?php  } else if($mcert['status']==2) { ?>
                                    认证被驳回
                                <?php  } else { ?>
                                    <?php  if(TIMESTAMP > $mcert['endtime']) { ?><font class="mui-text-danger">认证到期</font><?php  } else { ?>已认证<?php  } ?>
                                <?php  } ?>
                            <?php  } ?>
                            </i>
                        </div>
                    </li>
                    <li class="mui-table-view-cell"><div></div></li>
                </ul>
            </div>
            <div class="mui-card-footer" style="text-align:center; display:none">
                <a class="mui-card-link" href="<?php  echo app_url('member/project',array('index'=>1))?>">
                <p class="mui-ext-icon mui-icon-xiangmu"></p>活动管理</a>
                <a class="mui-card-link" href="<?php  echo app_url('member/profile',array('id'=>MERCHANTID,'uid'=>$_W['member']['uid']));?>">
                <p class="mui-ext-icon mui-icon-zhuyeicon"></p>我的主页</a>
            </div>
        </div>
        <ul class="mui-table-view mui-grid-view mui-grid-9">
            <li class="mui-table-view-cell mui-media mui-col-xs-6"><a href="<?php  echo app_url('member/project',array('index'=>1))?>">
                    <span class="mui-ext-icon mui-icon-xiangmu"></span>
                    <div class="mui-media-body">活动管理</div></a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-6"><a href="<?php  echo app_url('member/profile',array('id'=>MERCHANTID,'uid'=>$_W['member']['uid']));?>">
                    <span class="mui-ext-icon mui-icon-zhuyeicon"></span>
                    <div class="mui-media-body">我的主页</div></a></li>
            
        </ul>
        
        <ul class="mui-table-view mui-grid-view mui-grid-9" style="border-radius:0.48rem!important;overflow:hidden;margin-top:0.55rem;">
            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php  echo app_url('member/merch/income')?>">
                    <span class="mui-ext-icon mui-icon-qianbao mui-text-currency"></span>
                    <div class="mui-media-body">收入</div></a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php  echo app_url('member/merch/hexiao')?>">
                    <span class="mui-ext-icon mui-icon-renyuanguanli mui-text-purple"></span>
                    <div class="mui-media-body">核销员</div></a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php  echo app_url('member/merch/fans')?>">
                    <span class="mui-ext-icon mui-icon-fensi mui-text-purple"></span>
                    <div class="mui-media-body">粉丝</div></a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php  echo app_url('member/merch/help')?>">
                    <span class="mui-ext-icon mui-icon-bangzhu mui-text-yellow"></span>
                    <div class="mui-media-body">帮助</div></a></li><?php  if($_W['_config']['probtn']) { ?>
            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php  echo app_url('member/project/post')?>">
                    <span class="mui-ext-icon mui-icon-fabu3 mui-text-currency"></span>
                    <div class="mui-media-body">发布</div></a></li><?php  } ?>
            
        </ul>
        <ul class="mui-table-view" style="display:none">
        	<li class="mui-table-view-cell">
                <a class="mui-navigate-right" href="<?php  echo app_url('member/favorite')?>">
                <span class="mui-ext-icon mui-icon-bangzhu1 mui-text-currency"><p class="mui-pl20">&nbsp;帮助</p></span></a>
            </li>
        </ul>
        <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('copyright', TEMPLATE_INCLUDEPATH)) : (include fx_template('copyright', TEMPLATE_INCLUDEPATH));?>
    </div>
    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('member/setting', TEMPLATE_INCLUDEPATH)) : (include fx_template('member/setting', TEMPLATE_INCLUDEPATH));?>
    <?php  if(empty($merchant['logo']) || empty($merchant['name']) || empty($merchant['linkman_mobile']) || empty($merchant['linkman_name']) || empty($merchant['detail'])) { ?><script>setTimeout(function(){mui('#merch').popover('toggle')},200);</script><?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>