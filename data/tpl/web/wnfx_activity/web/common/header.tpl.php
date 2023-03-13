<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header-base', TEMPLATE_INCLUDEPATH));?>
    <div class="wb-header" style="position:fixed">
        <div class="logo<?php  if($_COOKIE['foldnav']) { ?> small<?php  } ?>">
        <?php  if(!empty($_W['_config']['merch_logo']) && MERCHANTID) { ?>
        <img class='logo-img' src="<?php  echo tomedia($_W['_config']['merch_logo'])?>" onerror="this.src='<?php echo FX_BASE;?>web/resource_v2/images/nologo.png'"/>
        <?php  } else { ?>
        <img class='logo-img' src="<?php echo FX_BASE;?>icon.jpg" onerror="this.src='<?php echo FX_BASE;?>web/resource_v2/images/nologo.png'"/>
        <?php  } ?>
        </div>        
        <ul>
            <?php  if(perm('merchset')) { ?><li><a href="<?php  if(MERCHANTID) { ?><?php  echo web_url('sysset/shop')?><?php  } else { ?><?php  echo web_url()?><?php  } ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="管理首页"><i class="icow icow-homeL"></i></a></li><?php  } ?>
            <?php  if(!($routes['0']=="records" && !empty($aid))) { ?><li class="wb-shortcut" style="border-right: 1px solid #efefef;"><a id="showmenu"><i class="icow icow-list"></i></a></li><?php  } ?>
        </ul>
        
        <div class="wb-topbar-search expand-search" id="navwidth" style="display:none">
            <form action="" id="topbar-search">
                <input type="hidden" name="c" value="site">
                <input type="hidden" name="a" value="entry">
                <input type="hidden" name="m" value="<?php echo IN_MODULE;?>">
                <input type="hidden" name="do" value="web">
                <input type="hidden" name="r" value="system.sys.fastlist">
                
                <div class="input-group">
                    <input type="text" placeholder="请输入关键词进行功能搜索..." class="form-control wb-search-box" maxlength="15" name="keyword"><span class="input-group-btn"><a class="btn wb-header-btn"><i class="icow icow-sousuo-sousuo"></i></a></span>
                </div>
            </form>
            <div class="wb-search-result">
                <ul>
                </ul>
            </div>
        </div>
        <div class="wb-header-flex"><?php  if(!empty($aid)) { ?>
            <style>
                .header-goods{overflow:hidden;padding:2px}
                .header-goods span{float:left}
                .header-goods .goods-img{max-width:75px;height:45px;margin-right:15px;overflow:hidden;}
                .header-goods .goods-img img{height:100%;width:auto;}
            </style>
            <div class="header-goods">
                <span class="goods-img"><a target="_blank" href="<?php  echo app_url('activity/detail',array('id'=>$aid))?>"><img src="<?php  echo tomedia($activity['thumb'])?>"></a></span>
                <span class="goods-detail">
                    <a target="_blank" href="<?php  echo app_url('activity/detail',array('id'=>$aid))?>"><?php  echo $activity['title'];?></a><br>
                    <font color="#8f8e8e"><?php  if(TIMESTAMP < strtotime($activity['endtime'])) { ?>进行中<?php  } else { ?>已结束<?php  } ?></font>
                </span>
            </div>
        <?php  } ?></div>
        <ul><?php  if(1!=1) { ?>
            <li style="display:none"><a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=system">系统管理</a></li>
            <li style="display:none"><a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=system.plugin.apps" target="_blank"><i class="icow icow-icon_shoppingmall" style="margin-right:10px;color:#f34347"></i>用户中心</a></li><?php  } ?>
            <li class="dropdown ellipsis"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php  echo $_W['uniaccount']['name'];?> <span></span></a>
            <ul class="dropdown-menu"<?php  if(MERCHANTID) { ?> style="width:217px"<?php  } ?>>
            	<?php  if(!MERCHANTID) { ?>
                <li><a href="/web/home.php#/platform"><i class="icow icow-qiehuan" style="font-size:30px"></i><span style="display:block">切换平台</span></a></li>
                <?php  if($_W['role'] == 'manager' || $_W['role'] == 'founder' || $_W['role'] == 'owner') { ?>
                <li><a href="/web/index.php?c=account&a=post&uniacid=<?php  echo $_W['uniacid'];?>&acid=<?php  echo $_W['acid'];?>" target="_blank"><i class="icow icow-bianji5" style="font-size:30px"></i><span style="display:block">编辑平台</span></a></li>
                <?php  } ?>
                <li style="display:none"><a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=sysset.payset"><i class="icow icow-zhifu" style="font-size:30px"></i><span style="display:block">支付方式</span></a></li>
                <?php  if(perm('perm')) { ?><li><a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=perm"><i class="icow icow-quanxian" style="font-size:30px"></i><span style="display:block">权限管理</span></a></li><?php  } ?>
                <li><a href="./index.php?c=user&a=profile" target="_blank"><i class="icow icow-quanxian1 " style="font-size: 30px;"></i><span style="display: block">修改密码</span></a></li>
                <li><a href="./index.php?c=account&a=display">返回系统</a></li>
                <?php  } else { ?>
                <li<?php  if(MERCHANTID) { ?> style="width:100%"<?php  } ?>><a href="<?php  echo web_url('updatelogin')?>" target="_blank"><i class="icow icow-quanxian1" style="font-size:30px"></i><span style="display:block">修改密码</span></a></li>
                <li style="display:none"></li>
                <?php  } ?>
            </ul>
            </li>
            <li data-toggle="tooltip" data-placement="bottom" title="退出登录" data-href="<?php  if(!MERCHANTID) { ?>./index.php?c=user&a=logout<?php  } else { ?><?php  echo web_url('logout')?><?php  } ?>">
                <a class="wb-header-logout"><i class="icow icow-exit"></i></a>
            </li>
        </ul>
        <div class="fast-nav<?php  if($_COOKIE['foldnav']) { ?> indent<?php  } ?>">
            <div class="fast-list menu">
                <span class="title">全部导航</span>
                <?php  if(!MERCHANTID) { ?>
                <?php  $col=7?>
                <?php  if(perm('shop')) { ?><a href="javascript:;" class="active" data-tab="tab-0">店铺首页</a><?php  } ?>
                <?php  if(perm('goods')) { ?><a href="javascript:;" data-tab="tab-1">活动管理</a><?php  } ?>
                <?php  if(perm('order')) { ?><a href="javascript:;" data-tab="tab-2">订单管理</a><?php  } ?>             
                <?php  if(perm('store')) { ?><a href="javascript:;" data-tab="tab-3">门店</a><?php  } ?>
                <?php  if(perm('member')) { ?><a href="javascript:;" data-tab="tab-4">会员管理</a><?php  } ?>
                <?php  if(perm('sale')) { ?><a href="javascript:;" data-tab="tab-5">营销设置</a><?php  } ?>
                <?php  if(perm('sysset')) { ?><a href="javascript:;" data-tab="tab-6">系统设置</a><?php  } ?>
                <?php  } else { ?>
                <?php  $col=5?>
                <?php  if(perm('goods')) { ?><a href="javascript:;" class="active" data-tab="tab-0">活动管理</a><?php  } ?>
                <?php  if(perm('order')) { ?><a href="javascript:;" data-tab="tab-1">订单管理</a><?php  } ?>                
                <?php  if(perm('store')) { ?><a href="javascript:;" data-tab="tab-2">门店</a><?php  } ?>
                <?php  if(perm('apply')) { ?><a href="javascript:;" data-tab="tab-3">结算</a><?php  } ?>
                <?php  if(perm('merchset')) { ?><a href="javascript:;" data-tab="tab-4">系统设置</a><?php  } ?>
                <?php  } ?>
            </div>
            <div class="fast-list list">
                <?php  if(!MERCHANTID) { ?>
                <div class="list-inner in" data-tab="tab-0">
                    <a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=shop.adv">幻灯片 </a>
                </div>
                <?php  } ?>
                <div class="list-inner<?php  if($col==5) { ?> in<?php  } ?>" data-tab="tab-<?php  echo $col-6?>">
                    <a href="<?php  echo web_url('activity')?>">进行中</a>
                    <a href="<?php  echo web_url('activity',array('type'=>'out'))?>">已结束</a>
                    <a href="<?php  echo web_url('activity',array('type'=>'stock'))?>">未上架</a>
                    <a href="<?php  echo web_url('activity',array('type'=>'cycle'))?>">回收站</a>
                    <?php  if(!MERCHANTID) { ?><a href="<?php  echo web_url('activity',array('type'=>'verify'))?>">待审核</a><?php  } ?>
                </div>
                <?php  if(perm('order')) { ?>
                <div class="list-inner" data-tab="tab-<?php  echo $col-5?>">
                    <a href="<?php  echo web_url('records',array('aid'=>$aid))?>">全部</a>
                    <a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'1'))?>">待参与</a>
                    <a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'3'))?>">已参与</a>
                    <a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'0'))?>">待付款</a>
                    <a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'5'))?>">已取消</a>
                    <a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'6'))?>">待退款</a>
                    <a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'7'))?>">已退款</a>
                    <a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'8'))?>">待审核</a>
                </div>
                <?php  } ?>
                <?php  if(perm('store')) { ?>
                <div class="list-inner" data-tab="tab-<?php  echo $col-4?>">
                    <a href="<?php  echo web_url('store')?>">门店管理</a>
                    <a href="<?php  echo web_url('store/saler')?>">店员管理</a>
                    <a href="<?php  echo web_url('store/set')?>">关键词设置</a>
                </div>
                <?php  } ?>
                <?php  if(!MERCHANTID) { ?>
                <?php  if(perm('member')) { ?>
                <div class="list-inner" data-tab="tab-<?php  echo $col-3?>">
                    <a href="<?php  echo web_url('member')?>">会员列表</a>
                </div>
                <?php  } ?>
                <?php  if(perm('sale.recharge')) { ?>
                <div class="list-inner" data-tab="tab-<?php  echo $col-2?>">
                    <a href="<?php  echo web_url('sale')?>">充值设置</a>
                </div>
                <?php  } ?>
                <?php  } ?>
                <?php  if(MERCHANTID) { ?>
                <div class="list-inner" data-tab="tab-<?php  echo $col-2?>">
                    <a href="<?php  echo web_url('apply/finance/account')?>">提现申请</a>
                    <a href="<?php  echo web_url('apply/list/status1')?>">待确认申请</a>
                    <a href="<?php  echo web_url('apply/list/status2')?>">待打款申请</a>
                    <a href="<?php  echo web_url('apply/list/status3')?>">已打款申请</a>
                </div>
                <?php  } ?>
                <div class="list-inner" data-tab="tab-<?php  echo $col-1?>">
                	<?php  if(!MERCHANTID) { ?>
                    <a href="<?php  echo web_url('sysset/sys')?>">基础设置</a>
                    <a href="<?php  echo web_url('sysset/shop')?>">信息设置</a>
                    <a href="<?php  echo web_url('sysset/share')?>">分享关注</a>
                    <a href="<?php  echo web_url('sysset/pay')?>">支付设置</a>
                    <a href="<?php  echo web_url('sysset/agreement')?>">协议设置</a>
                    <a href="<?php  echo web_url('sysset/task')?>">计划任务</a>
                    <?php  if($_W['account']->typeSign=='account') { ?><a href="<?php  echo web_url('sysset/msg')?>">模板消息</a><?php  } ?>
                    <a href="<?php  echo web_url('sysset/sms')?>">短信设置</a>
                    <a href="<?php  echo web_url('sysset/member')?>">会员设置</a>
                    <a href="<?php  echo web_url('sysset/cate')?>">分类设置</a>
                    <a href="<?php  echo web_url('sysset/page')?>">WAP设置</a>
                    <?php  } else { ?>
                    <a href="<?php  echo web_url('sysset/shop')?>">基础设置</a>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>
            
    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header-nav', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header-nav', TEMPLATE_INCLUDEPATH));?>
    <?php  if(1!=1) { ?>
    <div class="wb-panel">
        <div class="panel-group" id="panel-accordion">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#panel-accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h4 class="panel-title"><i class="icow icow-dingdan"></i><a class="news">订单消息</a><span></span></h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" aria-labelledby="headingOne">
                    <ul class="panel-body">
                        <li class="panel-list">
                        <div class="panel-list-text text-center">
                            暂无消息提醒
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#panel-accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h4 class="panel-title"><i class="icow icow-gonggao"></i><a>内部公告</a><span></span></h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <ul class="panel-body">
                        <li class="panel-list small">
                        <div class="panel-list-text text-center">
                            暂无消息提醒
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree" data-toggle="collapse" data-parent="#panel-accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <h4 class="panel-title"><i class="icow icow-yongjinmingxi"></i><a>佣金提现</a><span></span></h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <ul class="panel-body">
                        <li class="panel-list">
                        <div class="panel-list-text text-center">
                            暂无消息提醒
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFour" data-toggle="collapse" data-parent="#panel-accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                    <h4 class="panel-title"><i class="icow icow-pingjia"></i><a>评价</a><span></span></h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <ul class="panel-body">
                        <li class="panel-list">
                        <div class="panel-list-text text-center">
                            暂无消息提醒
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFive" data-toggle="collapse" data-parent="#panel-accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                    <h4 class="panel-title"><i class="icow icow-lingdang1"></i><a style="position:relative">系统提示 <i class="systips"></i></a><span></span></h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <ul class="panel-body">
                        <li class="panel-list">
                        <div class="panel-list-text nomsg">
                            暂无消息提醒
                        </div>
                        <div class="panel-list-text upmsg" style="display:none;max-height:none">
                            <div>检测到更新</div>
                            <div>新版本 <span id="sysversion">------</span></div>
                            <div>新版本 <span id="sysrelease">------</span></div>
                            <div>
                                <a class="text-primary" href="system.auth.upgrade">立即更新</a><a class="text-warning" href="javascript:check_<?php echo IN_MODULE;?>_upgrade_hide();" style="margin-left:15px">暂不提醒</a>
                            </div>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wb-panel-fold" style="display:none"><i class="icow icow-info"></i> 消息提醒</div><?php  } ?>
    <div class="wb-container right-panel">