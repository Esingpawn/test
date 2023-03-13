<?php defined('IN_IA') or exit('Access Denied');?><?php  $routes = explode('.', $_W['routes']);?>
<!-- 一级导航 -->
<div class="wb-nav<?php  if($_COOKIE['foldnav']) { ?> fold<?php  } ?>">
    <p class="wb-nav-fold">
        <i class="icow icow-zhedie"></i>
    </p>
    <ul id="navheight" class="wb-navheight"><?php  if(!MERCHANTID) { ?>
    	<?php  if(perm('shop')) { ?><li<?php  if($routes['0']=="shop") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('shop')?>"><i class="icow icow-store"></i><span class="wb-nav-title">店铺</span></a><span class="wb-nav-tip">店铺</span></li><?php  } ?>
        <?php  if(perm('goods')) { ?><li<?php  if($routes['0']=="activity") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity')?>"><i class="icow icow-goods"></i><span class="wb-nav-title">活动</span></a><span class="wb-nav-tip">活动</span></li><?php  } ?>
        <?php  if(perm('order')) { ?><li<?php  if($routes['0']=="records") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records')?>"><i class="icow icow-order"></i><span class="wb-nav-title">报名</span></a><span class="wb-nav-tip">报名</span></li><?php  } ?>
        <?php  if(perm('store')) { ?><li<?php  if($routes['0']=="store") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('store')?>"><i class="icow icow-mendianguanli"></i><span class="wb-nav-title">分会场</span></a><span class="wb-nav-tip">分会场</span></li><?php  } ?>
        <?php  if(perm('member')) { ?><li<?php  if($routes['0']=="member") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('member')?>"><i class="icow icow-member"></i><span class="wb-nav-title">会员</span></a><span class="wb-nav-tip">会员</span></li><?php  } ?>
        <?php  if(perm('sale')) { ?><li<?php  if($routes['0']=="sale") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sale')?>"><i class="icow icow-yingxiao"></i><span class="wb-nav-title">营销</span></a><span class="wb-nav-tip">营销</span></li><?php  } ?>
        <li<?php  if(in_array($routes['0'], array('plugins','merch','seat')) || $routes['1']=='merch') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('plugins')?>"><svg class="iconplug" aria-hidden="true"><use xlink:href="#icow-yingyong3"></use></svg><span class="wb-nav-title">应用</span></a><span class="wb-nav-tip">应用</span></li>
        <?php  if(perm('sysset')) { ?><li<?php  if($routes['0']=="sysset") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset')?>"><i class="icow icow-sysset"></i><span class="wb-nav-title point">设置</span></a><span class="wb-nav-tip">设置</span></li><?php  } ?>
        <?php  if(1!=1) { ?>
        <li class="sysset" style="display:none"><i class="icow icow-qiehuan"></i><span class="wb-nav-title" data-href="">系统管理</span>
        <div class="syssetsub">
            <div class="syssettitle">
                系统管理
            </div>
            <a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=system.plugin"><i class="icow icow-plugins"></i>应用</a>
            <a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=system.copyright"><i class="icow icow-banquan"></i>版权</a>
            <a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=system.data"><i class="icow icow-statistics"></i>数据</a>
            <a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=system.site"><i class="icow icow-wangzhan"></i>网站</a>
            <a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=system.auth"><i class="icow icow-iconfont-shouquan"></i>授权</a>
            <a href="/web/index.php?c=site&a=entry&m=<?php echo IN_MODULE;?>&do=web&r=system.auth.upgrade"><i class="icow icow-gengxin"></i>更新</a>
            <span class="syssettips"></span>
        </div>
        </li><?php  } ?>
        <?php  } else { ?>
        <?php  if(perm('goods')) { ?><li<?php  if($routes['0']=="activity") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity')?>"><i class="icow icow-goods"></i><span class="wb-nav-title">活动</span></a><span class="wb-nav-tip">活动</span></li><?php  } ?>
        <?php  if(perm('order')) { ?><li<?php  if($routes['0']=="records") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records')?>"><i class="icow icow-order"></i><span class="wb-nav-title">报名</span></a><span class="wb-nav-tip">报名</span></li><?php  } ?>
        <?php  if(perm('store')) { ?><li<?php  if($routes['0']=="store") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('store')?>"><i class="icow icow-mendianguanli"></i><span class="wb-nav-title">门店</span></a><span class="wb-nav-tip">门店</span></li><?php  } ?>
        <?php  if(perm('apply')) { ?><li<?php  if($routes['0']=='apply') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('apply')?>"><i class="icow icow-31"></i><span class="wb-nav-title">结算</span></a><span class="wb-nav-tip">结算</span></li><?php  } ?>
        <?php  if(perm('seat')) { ?><li<?php  if(in_array($routes['0'], array('plugins','merch','seat')) || $routes['1']=='merch') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('plugins')?>"><svg class="iconplug" aria-hidden="true"><use xlink:href="#icow-yingyong3"></use></svg><span class="wb-nav-title">应用</span></a><span class="wb-nav-tip">应用</span></li><?php  } ?>
        <?php  if(perm('merchset')) { ?><li<?php  if($_W['action']=="sysset.shop") { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/shop')?>"><i class="icow icow-sysset"></i><span class="wb-nav-title point">设置</span></a><span class="wb-nav-tip">设置</span></li><?php  } ?>
        <?php  } ?>
    </ul>
</div>
<!--低分辨率一级导航显示不全问题 start-->
<script>
    var navheight=document.getElementById("navheight"),
    	navwidth=document.getElementById("navwidth"),
    	vh=document.body.clientHeight,
		vw=screen.width;
    vh<800?navheight.classList.add("wb-navheight"):navheight.classList.remove("wb-navheight"),vw<1300&&navwidth.classList.add("wb-navwidth")
</script>

<!-- 二级导航 -->
<?php  $menuFrames = getmenuFrames()?>
<?php  if($menuFrames[$routes['0']] && !$no_left) { ?>
<div class="wb-subnav">
    <div style="width:100%;height:100%;overflow-y:auto">
    <?php  if($routes['0'] == 'activity') { ?>
        <div class="subnav-scene">活动管理</div>
        <ul class="single">
            <li<?php  if($type=='sale') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity')?>">进行中<span class="pull-right text-warning">(<?php  echo $totals['0'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($type=='out') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity',array('type'=>'out'))?>">已结束<span class="pull-right text-warning">(<?php  echo $totals['1'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($type=='stock') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity',array('type'=>'stock'))?>">未上架<span class="pull-right text-warning">(<?php  echo $totals['2'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($type=='cycle') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity',array('type'=>'cycle'))?>">回收站<span class="pull-right text-warning">(<?php  echo $totals['3'];?>)&nbsp;</span></a></li>
        </ul>
        <?php  if(!perm('goods.senior.ischeck')) { ?>
        <ul class="single">
            <li<?php  if($_W['routes']=='activity' && $type=='verify') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity',array('type'=>'verify'))?>">待审核<span class="pull-right text-warning">(<?php  echo $totals['4'];?>)&nbsp;</span></a></li>
        </ul>
        <?php  } ?>
        <?php  if(!MERCHANTID) { ?>
        <ul class="single">
            <li<?php  if($_W['routes']=='activity' && $type=='verify') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity',array('type'=>'verify'))?>">待审核<span class="pull-right text-warning">(<?php  echo $totals['4'];?>)&nbsp;</span></a></li>
        </ul>
        <div class="menu-header active">
        	<div class="menu-icon fa fa-caret-down"></div>
        	其它功能
        </div>
        <ul style="display:block">
            <li<?php  if($routes['1']=='category') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('activity/category')?>">活动分类</a></li>
        </ul>
        <?php  } ?>
    <?php  } ?>
    <?php  if($routes['0'] == 'records') { ?>
        <div class="subnav-scene">报名管理</div>
        <ul class="single">
            <li<?php  if($_GPC['status']=='') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records',array('aid'=>$aid))?>">全部<span class="pull-right text-warning">(<?php  echo $totals['0'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($_GPC['status']=='1') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'1'))?>">待参与<span class="pull-right text-warning">(<?php  echo $totals['1'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($_GPC['status']=='3') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'3'))?>">已参与<span class="pull-right text-warning">(<?php  echo $totals['2'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($_GPC['status']=='0') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'0'))?>">待付款<span class="pull-right text-warning">(<?php  echo $totals['3'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($_GPC['status']=='5') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'5'))?>">已取消<span class="pull-right text-warning">(<?php  echo $totals['4'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($_GPC['status']=='6') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'6'))?>">待退款<span class="pull-right text-warning">(<?php  echo $totals['5'];?>)&nbsp;</span></a></li>
        </ul>
        <ul class="single">
            <li<?php  if($_GPC['status']=='7') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'7'))?>">已退款<span class="pull-right text-warning">(<?php  echo $totals['6'];?>)&nbsp;</span></a></li>
        </ul>
        <?php  if(perm('goods.switch.buycheck')) { ?>
        <ul class="single">
        	<li<?php  if($_GPC['status']=='8') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records',array('aid'=>$aid,'status'=>'8'))?>">待审核<span class="pull-right text-warning">(<?php  echo $totals['7'];?>)&nbsp;</span></a></li>
        </ul>
        <?php  } ?>
        <?php  if(!empty($aid)) { ?>
        <div class="menu-header active">
        	<div class="menu-icon fa fa-caret-down"></div>
       		更多功能
        </div>
        <ul style="display:block">
        	<li<?php  if($_W['action']=='records.checkin') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('records/checkin',array('aid'=>$aid))?>">验票签到<?php  echo $_W['op']?></a></li>
        </ul>     
        <?php  } ?>
    <?php  } ?>
    <?php  if($routes['0'] == 'shop') { ?>
        <div class="subnav-scene">店铺首页</div>
        <div class="menu-header active">
            <div class="menu-icon fa fa-caret-down"></div>
            首页
        </div>
        <ul style="display:block">
        	<li<?php  if($_W['action']=='shop.adv') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('shop/adv')?>">幻灯片</a></li>
            <!--<li<?php  if($_W['action']=='nav') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('shop/nav')?>">导航栏</a></li>-->
        </ul>  
    <?php  } ?>
    <?php  if($routes['0'] == 'sysset') { ?>
    	<div class="subnav-scene">平台设置</div>
        <?php  if(perm('sysset.sys') || perm('sysset.shop') || perm('sysset.share') || perm('sysset.share') || perm('sysset.pay') || perm('sysset.merchant') || perm('sysset.agreement') || perm('sysset.task') || perm('sysset.tpl')) { ?>
        <div class="menu-header<?php  if(in_array($routes['1'], array('sys','shop','share','merchant','agreement','task'))) { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if(in_array($routes['1'], array('sys','shop','share','merchant','agreement','task','page','tpl'))) { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            平台
        </div>        
        <ul<?php  if(in_array($routes['1'], array('sys','shop','share','merchant','agreement','task','page','tpl'))) { ?> style="display:block"<?php  } ?>>
        	<?php  if(perm('sysset.sys')) { ?><li<?php  if($_W['routes']=='sysset.sys') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/sys')?>">基础设置</a></li><?php  } ?>
        	<?php  if(perm('sysset.shop')) { ?><li<?php  if($_W['routes']=='sysset.shop') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/shop')?>">信息设置</a></li><?php  } ?>
            <?php  if(perm('sysset.follow')) { ?><li<?php  if($_W['routes']=='sysset.share') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/share')?>">分享关注</a></li><?php  } ?>
            <?php  if(perm('sysset.agreement')) { ?><li<?php  if($_W['routes']=='sysset.agreement') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/agreement')?>">协议设置</a></li><?php  } ?>
            <?php  if(perm('sysset.task')) { ?><li<?php  if($_W['routes']=='sysset.task') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/task')?>">计划任务</a></li><?php  } ?>
            <?php  if(perm('sysset.tpl')) { ?><li<?php  if($_W['routes']=='sysset.tpl') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/tpl')?>">模板设置</a></li><?php  } ?>
            <?php  if(perm('sysset.page')) { ?><li<?php  if($_W['op'] =='page') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/page')?>">WAP设置</a></li><?php  } ?>
        </ul>
        
        <div class="menu-header<?php  if(in_array($routes['1'], array('trade','pay'))) { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if(in_array($routes['1'], array('trade','pay'))) { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            交易
        </div>
        <ul<?php  if(in_array($routes['1'], array('trade','pay'))) { ?>  style="display:block"<?php  } ?>>
        	<?php  if(perm('sysset.trade')) { ?><li<?php  if($_W['routes']=='sysset.trade') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/trade')?>">交易设置</a></li><?php  } ?>
            <?php  if(perm('sysset.pay')) { ?><li<?php  if($_W['routes']=='sysset.pay') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/pay')?>">支付设置</a></li><?php  } ?>
        </ul>
        <?php  } ?>
        <?php  if(perm('sysset.sms') || perm('sysset.temp')) { ?>
        <div class="menu-header<?php  if(in_array($routes['1'], array('msg','sms'))) { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if(in_array($routes['1'], array('msg','sms'))) { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            消息设置
        </div>
        <ul<?php  if(in_array($routes['1'], array('msg','sms'))) { ?>  style="display:block"<?php  } ?>>
        	<?php  if(perm('sysset.temp') && $_W['account']->typeSign=='account') { ?><li<?php  if($_W['op'] =='msg') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/msg')?>">模板消息</a></li><?php  } ?>
            <?php  if(perm('sysset.sms')) { ?><li<?php  if($_W['op'] =='sms') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/sms')?>">短信设置</a></li><?php  } ?>
        </ul>
        <?php  } ?>
        <?php  if(perm('sysset.member') || perm('sysset.cate')) { ?>
        <div class="menu-header<?php  if(in_array($routes['1'], array('member','cate'))) { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if(in_array($routes['1'], array('member','cate'))) { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            其它设置
        </div>
        <ul<?php  if(in_array($routes['1'], array('member','cate'))) { ?> style="display:block"<?php  } ?>>
        	<?php  if(perm('sysset.member')) { ?><li<?php  if($_W['op'] =='member') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/member')?>">会员设置</a></li><?php  } ?>
            <?php  if(perm('sysset.cate')) { ?><li<?php  if($_W['op'] =='cate') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/cate')?>">分类设置</a></li><?php  } ?>            
        </ul>
        <?php  } ?>
        <?php  if(perm('sysset.cover.shop') || perm('sysset.cover.member') || perm('sysset.cover.order') || perm('sysset.cover.merch')) { ?>
        <div class="menu-header<?php  if($routes['1']=='cover') { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if($routes['1']=='cover') { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            入口
        </div>        
        <ul<?php  if($routes['1']=='cover') { ?> style="display:block"<?php  } ?>>
        	<?php  if(perm('sysset.cover.shop')) { ?><li<?php  if($_W['op'] =='shop') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/cover/shop')?>">报名入口</a></li><?php  } ?>
            <?php  if(perm('sysset.cover.member')) { ?><li<?php  if($_W['op'] =='member') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/cover/member')?>">会员入口</a></li><?php  } ?>
            <?php  if(perm('sysset.cover.order')) { ?><li<?php  if($_W['op'] =='order') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/cover/order')?>">订单入口</a></li><?php  } ?>
            <?php  if(perm('sysset.cover.merch')) { ?><li<?php  if($_W['op'] =='merch') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sysset/cover/merch')?>">商户入口</a></li><?php  } ?>
        </ul>
        <?php  } ?>
    <?php  } ?>
    <?php  if($routes['0'] == 'store') { ?>
    	<div class="subnav-scene">分会场</div>    
        <div class="menu-header<?php  if(strpos($_W['routes'],'store') !== false) { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if(strpos($_W['routes'],'store') !== false) { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            门店管理
        </div>
        <ul<?php  if(strpos($_W['routes'],'store') !== false) { ?> style="display:block"<?php  } ?>>
        	<?php  if(perm('store')) { ?><li<?php  if($_W['routes']=='store' || $_W['routes']=='store.edit') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('store')?>">门店管理</a></li><?php  } ?>
            <?php  if(perm('store.saler')) { ?><li<?php  if(strpos($_W['routes'],'saler') !== false) { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('store/saler')?>">店员管理</a></li><?php  } ?>
            <li<?php  if(strpos($_W['routes'],'set') !== false) { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('store/set')?>">关键词设置</a></li>
        </ul>
    <?php  } ?>
    <?php  if($routes['0'] == 'merch' || $routes['0'] == 'apply' || $routes['0'] == 'finance') { ?>
		<div class="subnav-scene"><?php  if(!MERCHANTID) { ?>多商户<?php  } else { ?>结算<?php  } ?></div>
		<?php  if(!MERCHANTID) { ?>
        <?php  if($_W['action']!='merch.finance') { ?>
        <?php  if(perm('merch.user')) { ?>
        <div class="menu-header<?php  if($_W['routes']=='merch.user' || $_W['routes']=='merch.user.edit') { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if($_W['routes']=='merch.user' || $_W['routes']=='merch.user.edit') { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            商户管理
        </div>
        <ul<?php  if($_W['routes']=='merch.user' || $_W['routes']=='merch.user.edit') { ?> style="display:block"<?php  } ?>>
            <li <?php  if($_W['routes']=='merch.user' || $_W['routes']=='merch.user.edit') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('merch/user')?>">商户列表</a></li>
        </ul>
        <?php  } ?>
        <?php  if(perm('merch.check')) { ?>
        <div class="menu-header<?php  if($_W['action']=='merch.apply') { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if($_W['action']=='merch.apply') { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            提现申请
        </div>
        <ul<?php  if($_W['action']=='merch.apply') { ?> style="display:block"<?php  } ?>>
            <li<?php  if($_W['op'] =='status1') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('merch/apply/status1')?>">待确认</a></li>
            <li<?php  if($_W['op'] =='status2') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('merch/apply/status2')?>">待打款</a></li>
            <li<?php  if($_W['op'] =='status3') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('merch/apply/status3')?>">已打款</a></li>
        </ul>
        <?php  } ?>
        <?php  if(perm('merch.set')) { ?>
        <div class="menu-header active">
            <div class="menu-icon fa fa-caret-down"></div>
            商户设置
        </div>
        <ul style="display:block">
            <li<?php  if($_W['action']=='merch.set') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('merch/set')?>">基础设置</a></li>
        </ul>
        <?php  } ?>
        <?php  } else { ?>
        <ul class="single">
        	<li<?php  if($_W['op'] =='account') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('merch/finance/account', array('id'=>$id))?>">商户结算</a></li>
        </ul>
        <ul class="single">
        	<li<?php  if($_W['op'] =='record') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('merch/finance/record', array('id'=>$id))?>">结算记录</a></li>
        </ul>
        <ul class="single">
        	<li<?php  if($_W['op'] =='moneylog') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('merch/finance/moneylog', array('id'=>$id))?>">金额变更日志</a></li>
        </ul>
        <?php  } ?>
        <?php  } else { ?>
        <ul class="single">
        	<li<?php  if($_W['action']=='apply') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('apply')?>">提现申请</a></li>
        </ul>
        <ul class="single">
        	<li<?php  if($_W['op'] =='moneylog') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('finance/moneylog', array('id'=>$id))?>">金额变更日志</a></li>
        </ul>
        <div class="menu-header active">
            <div class="menu-icon fa fa-caret-down"></div>
            提现记录
        </div>
        <ul style="display:block">
            <li<?php  if($_W['op'] =='status1') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('apply/list/status1')?>">待确认</a></li>
            <li<?php  if($_W['op'] =='status2') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('apply/list/status2')?>">待打款</a></li>
            <li<?php  if($_W['op'] =='status3') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('apply/list/status3')?>">已打款</a></li>
        </ul>
        <?php  } ?>
    <?php  } ?>
    <?php  if($routes['0'] == 'member') { ?>
    	<div class="subnav-scene">会员管理</div>    
        <ul class="single">
        	<li<?php  if($_W['routes']=='member' || $_W['routes']=='member.detail') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('member')?>">会员列表</a></li>
        </ul>
    <?php  } ?>
    <?php  if($routes['0'] == 'sale') { ?>
    	<div class="subnav-scene">营销设置</div>
        <div class="menu-header<?php  if(in_array($routes['1'], array('recharge'))) { ?> active<?php  } ?>">
            <div class="menu-icon fa fa-caret-<?php  if(in_array($routes['1'], array('recharge'))) { ?>down<?php  } else { ?>right<?php  } ?>"></div>
            基本功能
        </div>
        <ul style="display:block">
        	<li<?php  if($_W['routes']=='sale' || $_W['routes']=='sale.recharge') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('sale/recharge')?>">充值设置</a></li>
        </ul>
    <?php  } ?>
    <?php  if($routes['0'] == 'seat') { ?>
    	<div class="subnav-scene">选座管理</div>    
        <ul class="single">
        	<li<?php  if($_W['routes']=='seat') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('seat')?>">座位列表</a></li>
        </ul>
    <?php  } ?>
    <?php  if($routes['0'] == 'perm') { ?>
    	<div class="subnav-scene">权限系统</div>    
        <ul class="single">
        	<li<?php  if($routes['1']=='role') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('perm/role')?>">角色管理</a></li>
        </ul>
        <ul class="single">
        	<li<?php  if($routes['1']=='user') { ?> class="active"<?php  } ?>><a href="<?php  echo web_url('perm/user')?>">操作员管理</a></li>
        </ul>
    <?php  } ?>
    <div class="wb-subnav-fold icow"></div>
    </div>
</div>
<?php  } ?>