<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
    .mui-card.mui-one{box-shadow:none}
    .mui-card-member .mui-card-header{height:135px;background:bottom no-repeat url('../addons/wnfx_activity/app/resource/images/header_2.png');background-size:73% auto;-moz-background-size:80% auto;border-radius: 0 0 70% 70%!important;overflow: hidden;-webkit-backface-visibility: hidden;-moz-backface-visibility: hidden;-webkit-transform: translate3d(0,0,0);-moz-transform: translate3d(0,0,0);margin:0 -20%;padding:10px 22%;}
    .mui-card-member .mui-card-header>img{width:60px!important;height:60px!important;border:solid .08rem #fff;margin-left:5px}
    .mui-card-member .mui-card-header .mui-media-body{margin-left:75px!important;margin-top:5px;min-height:auto!important;color:#FFF!important;font-weight:600!important}
    .mui-card-member .mui-card-header .mui-media-body span{vertical-align:text-bottom;font-size:18px;line-height:1.6;font-weight:700!important}
    .mui-card-member .mui-card-header .mui-media-body span~img{margin-left:10px;}
    .mui-card-member .mui-card-header .mui-navigate-right:after{color:#FFF}
    .mui-card-member .mui-card-content{top:98px;position:absolute!important;margin:auto 10%;width: 80%;border-radius:1.3rem;overflow: hidden;z-index: 99;box-shadow: rgb(235,235,235) 0px 2px 5px}
    
    .mui-table-view.mui-grid-view .mui-table-view-cell{ border:none;background-color:#fff;padding:10px 15px; position:relative;margin-right:0px;}
    .mui-table-view.mui-grid-view .mui-table-view-cell:after{content: ""; position:absolute; right:0; left:auto; top:50%;border-right:1px solid #e0e0e0; height:60%;-webkit-transform: translateY(-50%) scaleX(0.5); transform: translateY(-50%) scaleX(0.5);}
    .mui-table-view.mui-grid-view .mui-table-view-cell>a:not(.mui-btn){ margin: -11px -14px;}
    .mui-table-view.mui-grid-view .mui-table-view-cell:last-child:after{border:none;}	
    .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body{color:#777777;font-size:80%;margin-top:0px;}
    .mui-card-footer{text-align:center;padding:2.5rem 0 0.5rem 0!important;;font-size:0.45rem;line-height:1}
    
	.mui-card-classic{box-shadow:rgb(235,235,235) 0px 1px 8px!important;}
    .mui-card-classic .mui-card-content .mui-table-view-cell>a{padding-left:5px;}
    .mui-card-classic .mui-card-content .mui-table-view-cell:after{left:5px}
    .mui-card-classic .mui-card-content .mui-card-content-inner{padding-top:0}
</style>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/nav', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/nav', TEMPLATE_INCLUDEPATH));?>
<div class="mui-content">
    <div class="mui-card mui-card-member mui-one" style="margin-top:0;">
        <div class="mui-card-header mui-card-media js-popover" data-popover='member'>
            <img src="<?php  echo $member['avatar'];?>">
            <div class="mui-media-body mui-navigate-right" style="line-height:normal!important">
                <span><?php  echo $member['nickname'];?></span>
                <?php  if($is_vip) { ?><img src="<?php  echo tomedia('addons/wnfx_activity/app/resource/images/vip.png')?>" width="60"><?php  } ?><br>
                手机号：<?php echo !empty($member['mobile'])?$member['mobile']:'待绑定'?>
            </div>
        </div>
        <div class="mui-card-content">
            <ul class="mui-table-view mui-grid-view mui-afterbefore-no mui-text-gray" style="margin:0;padding:0;">
                <li class="mui-table-view-cell mui-media mui-col-xs-6 mui-col-sm-6">
                    <a href="<?php  echo app_url('member/favorite')?>">
                    <img src="<?php  echo tomedia('addons/wnfx_activity/app/resource/images/icon_06.png')?>" width="25%">
                    <div class="mui-media-body">我的收藏</div></a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-6 mui-col-sm-6">
                    <a href="<?php  echo app_url('member/profile/list')?>">
                    <img src="<?php  echo tomedia('addons/wnfx_activity/app/resource/images/icon_07.png')?>" width="25%">
                    <div class="mui-media-body">我的关注</div></a>
                </li>
            </ul>
        </div>
        <?php  if($_W['_config']['wechatstatus']==2) { ?>
        <?php  $tabs = array(array('待付款','1'),array('待参与','2'),array('已完成','3'),array('已取消','4'),array('已退款','5'));?>
        <?php  } else { ?>
        <?php  $tabs = array(array('待参与','2'),array('已完成','3'),array('已取消','4'));?>
        <?php  } ?>
        <div class="mui-card-footer">
            <?php  if(is_array($tabs)) { foreach($tabs as $k => $v) { ?>
            <a class="mui-card-link mui-text-gray" href="<?php  echo app_url('records',array('index'=>$k+1))?>"><img src="<?php  echo tomedia('addons/wnfx_activity/app/resource/images/icon_0'.$v[1].'.png')?>" style="max-width: 2.3rem;"><br><?php  echo $v['0'];?></a>
            <?php  } } ?>
        </div>
    </div>
    <?php  if($_W['_config']['credit2']==1 || $_W['_config']['creditstatus']==1 || $_W['plugin']['poster']['config']['commission_enable']) { ?>
    <div class="mui-card mui-card-classic mui-one">
        <div class="mui-card-header mui-card-media"><b>我的服务</b></div>
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
                <ul class="mui-table-view mui-afterbefore-no">
                    <?php  if($_W['_config']['credit2']==1) { ?>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href="<?php  echo app_url('recharge')?>">
                        <span class="mui-ext-icon mui-icon-tixian mui-text-primary"><p class="mui-pl20">&nbsp;余额充值</p></span>
                        <span class="mui-badge mui-badge-inverted"></span></a>
                    </li>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href="<?php echo empty($creditlink)?$credit2link:$creditlink?>">
                        <span class="mui-ext-icon mui-icon-myue mui-text-currency"><p class="mui-pl20">&nbsp;我的钱包</p></span>
                        <span class="mui-badge mui-badge-inverted mui-rmb"><?php  if($credits['credit2']=='') { ?>0.00<?php  } else { ?><?php  echo $credits['credit2'];?><?php  } ?></span></a>
                    </li>
                    <?php  } ?>
                    <?php  if($_W['_config']['creditstatus']==1) { ?>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href="<?php echo empty($creditlink)?$credit1link:$creditlink?>">
                        <span class="mui-ext-icon mui-icon-mjifen mui-text-purple"><p class="mui-pl20">&nbsp;会员<?php  echo m('member')->getCreditName('credit1')?></p></span>
                        <span class="mui-badge mui-badge-inverted"><?php  if($credits['credit1']=='') { ?>0.00<?php  } else { ?><?php  echo $credits['credit1'];?><?php  } ?> <?php  echo m('member')->getCreditName('credit1')?></span></a>
                    </li>
                    <?php  } ?>
                    <?php  if($_W['plugin']['poster']['config']['commission_enable']) { ?>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href="<?php  echo $commission_url;?>">
                        <span class="mui-ext-icon mui-icon-myouhui-1 mui-text-yellow"><p class="mui-pl20">&nbsp;合伙人中心</p></span></a>
                    </li>
                    <?php  } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php  } ?>
    <?php  if($_W['plugin']['card']['config']['card_enable'] || ($_W['_config']['merch'] || ADMIN)) { ?>
    <div class="mui-card mui-card-classic mui-one">
        <div class="mui-card-header mui-card-media"><b>特权服务</b></div>
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
                <ul class="mui-table-view mui-afterbefore-no">
                    <?php  if($_W['plugin']['card']['config']['card_enable']) { ?>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href="<?php echo $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=cardfans&m=' . PLUGIN_CARD;?>">
                        <span class="mui-ext-icon mui-icon-mingxi mui-text-currency"><p class="mui-pl20">&nbsp;<?php  echo $yearcard['name'];?></p></span>
                        <span class="mui-badge mui-badge-inverted"><?php  if(!$is_vip) { ?>升级您的尊贵权益<?php  } else { ?><font class="mui-text-yellow">已开通</font><?php  } ?></span></a>
                    </li>
                    <?php  } ?>
                    <?php  if($_W['_config']['merch'] || ADMIN) { ?>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href="<?php  echo app_url('member/merch')?>">
                        <span class="mui-ext-icon mui-icon-iconmoban mui-text-yellow"><p class="mui-pl20">&nbsp;<?php  if(ADMIN) { ?>平台管理入口<?php  } else if(MERCHANTID) { ?>主办方入口<?php  } else { ?>成为主办方<?php  } ?></p></span>
                        <?php  if(!ADMIN) { ?>
                        <span class="mui-badge mui-badge-inverted">                        	
                            <?php  if(empty($merchant)) { ?>
                            	<font class="mui-text-yellow">待申请</font>
                            <?php  } else if($merchant['status']==0) { ?>
                            	<font class="mui-text-danger">已禁用</font>
                            <?php  } else if(empty($mcert)) { ?>
                                未认证
                            <?php  } else if($mcert['status']==0) { ?>
                                认证审核中
                            <?php  } else if($mcert['status']==2) { ?>
                                认证被驳回
                            <?php  } else { ?>
                                <?php  if(TIMESTAMP > $mcert['endtime']) { ?><font class="mui-text-danger">认证到期</font><?php  } else { ?>已认证<?php  } ?>
                            <?php  } ?>                            
                        </span>
                        <?php  } ?>
                        </a>
                    </li>
                    <?php  } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php  } ?>
    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('copyright', TEMPLATE_INCLUDEPATH)) : (include fx_template('copyright', TEMPLATE_INCLUDEPATH));?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('member/setting', TEMPLATE_INCLUDEPATH)) : (include fx_template('member/setting', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>