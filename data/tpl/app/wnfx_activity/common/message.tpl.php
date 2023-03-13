<?php defined('IN_IA') or exit('Access Denied');?><?php  define(MUI, true);?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.mui-message .mui-message-icon{margin-top:1rem;}
.mui-message .mui-message-icon span{width:2rem;height:2rem;}
.mui-message h4.title{margin-top:0.12rem; font-size:0.62rem}
.mui-table-view{text-align:left;border-radius:0.3rem;overflow:hidden}
.mui-table-view .mui-navigate-right:after{color:#FFF;font-size:16px;right:2px}
.mui-lottery-view .mui-media-body{color:#a6742b;}
.mui-commission-view .mui-media-body,.mui-commission-view .mui-media-body p{color:#fff;}
.mui-commission-view .mui-navigate-right:after{color:#fa682d;}
.mui-table-view.pay .mui-table-view-cell{padding: 11px 0;}
.mui-table-view.pay .mui-table-view-cell>.mui-badge{ right:0; font-size:15px; padding:0}
.mui-button-area{position:fixed;margin:0!important;bottom:2rem;width:100%;left:0;z-index:9999;text-align:center}
.mui-button-area a.mui-icon{display:block;border-radius:50%;height:2rem;width:2rem;margin:0 auto;background:#feda00;color:#72400b;line-height:2rem;font-size:1.5rem;box-shadow: rgba(0,0,0,0.2) 0px 2px 5px;margin-bottom:5px;}
.mui-rmb{margin-bottom:20px;font-size:1rem;}
.mui-rmb font{font-size:1.6rem;}
.padded-top{margin-top:40%;}
</style>
<?php  if(strexists($msg, 'SQL Error:')) { ?>
<div class="mui-content-padded">
    <div class="mui-message">
        <div class="mui-message-icon">
            <span class="mui-msg-error"></span>
        </div>
        <h4 class="title">系统错误</h4>
        <div class="mui-desc" style="color:#929292;">请及时联系管理员</div>
        <div class="mui-desc" style="color:#929292; margin-top:10px; text-align:left;"><?php  echo $msg;?></div>
        <div class="mui-button-area">
            <a href="javascript:history.go(-1);" class="mui-icon mui-icon-closeempty"></a>
        </div>
    </div>
</div>
<?php  } else { ?>
<script type="text/html" id="msg">
<div class="mui-content fadeInUpBig animated mui-backdrop" style="background-color:#fff">
	<div class="mui-scroll-wrapper">
		<div class="mui-scroll">
			<div class="mui-content-padded">
				<div class="mui-message">
					<div class="mui-message-icon">
						<span class="mui-msg-<?php  echo $type;?>"></span>
					</div>
					<h4 class="title mui-text-<?php  echo $type;?>"><?php  echo $msg;?></h4>
					<?php  if($_W['pay']['price'] > 0) { ?><p class="mui-rmb"><font><?php  echo $_W['pay']['price'];?></font></p><?php  } ?>
					<p class="mui-desc"><?php  echo $desc;?></p>
					<?php  if($_W['pay']['price'] > 0) { ?>
					<ul class="mui-table-view mui-before-no pay" style="background:transparent;margin-bottom:15px;">
						<li class="mui-table-view-cell mui-media">
						<div class="mui-media-body">
							付款方式
						</div>
						<span class="mui-badge mui-badge-inverted">
						<?php  if($_W['pay']['paytype']=='wechat') { ?>
							微信
						<?php  } else if($_W['pay']['paytype']=='credit') { ?>
							余额支付
						<?php  } else if($_W['pay']['paytype']=='delivery') { ?>
							线下转账
						<?php  } else { ?>
							免支付
						<?php  } ?>						
						</span></li>
					</ul>
					<?php  } ?>
					<?php  if($_W['lottery']['enable'] && (!$_W['lottery']['fee'] || ($_W['lottery']['fee'] && strpos($msg,'支付成功') !== false))) { ?>
					<ul class="mui-table-view mui-afterbefore-no mui-lottery-view">
						<li class="mui-table-view-cell mui-media"><a href="<?php  echo $_W['lottery']['url'];?>" style="background:#fcf5e3;">
						<div class="mui-media-body">
							抽奖特权
							<p class="mui-small mui-text-gray">
								恭喜您获得抽奖机会！
							</p>
						</div>
						<span class="mui-badge mui-gradient-orange mui-navigate-right" style="padding:8px;padding-right:20px">马上抽奖</span></a></li>
					</ul>
					<?php  } ?>
					<?php  if($_W['commission']['commission_enable']) { ?>
					<ul class="mui-table-view mui-afterbefore-no mui-commission-view">
						<li class="mui-table-view-cell mui-media"><a href="<?php  echo $_W['commission']['url'];?>" style="background:-webkit-linear-gradient(left, rgba(255,150,42,1) 0%, rgba(244,54,54,1) 100%);">
						<div class="mui-media-body">
							分享好友<?php  echo $_W['_config']['buytitle'];?>获取 <?php  echo $_W['commission']['rule']['first_level_rate'];?>% 佣金
							<p class="mui-small">
								发朋友圈成功率更高
							</p>
						</div>
						<span class="mui-badge mui-navigate-right" style="padding:8px;padding-right:20px;background:#fff4c6;color:#fa682d">专属海报</span></a></li>
					</ul>
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="mui-button-area">
		<div class="mui-content-padded">
			<?php  if($_GPC['do']=='pay') { ?>
			<a href="<?php  echo $redirect;?>" class="mui-icon mui-icon-closeempty"></a>
			<?php  } else { ?>
			<a href="<?php  echo $redirect;?>" class="mui-btn mui-btn-yellow mui-btn-block"><?php  echo $btntext;?></a>
			<?php  } ?>
		</div>
	</div>
</div>
</script>
<?php  if($_W['kefu']['switch1']) { ?>
<div id="poster" class="mui-popover mui-popover-default" style="width:80%;height:auto;max-height:75%;background:transparent;">
	<div class="mui-popover-content">
        <a href="<?php echo empty($_W['kefu']['url1'])?'javascript:;':$_W['kefu']['url1']?>"><img width="100%" src="<?php  echo tomedia($_W['kefu']['thumb'])?>" style="vertical-align:bottom;"></a>
    </div>
    <me class="mui-icon mui-icon-closeempty js-popover-close" data-popover="poster" style="position:absolute;font-size:1.5rem;color:#999;z-index:999; bottom:0;border-radius:100%;bottom:-2.4rem;border: 1px solid #999;left:50%;-webkit-transform: translateX(-50%);transform: translateX(-50%);"></me>
</div>
<?php  } ?>
<script type="text/javascript">
    //util.message('<?php  echo $msg;?>', '<?php  echo $redirect;?>', '<?php  echo $type;?>', '<?php  echo $desc;?>');
    var gettpl = document.getElementById('msg').innerHTML;
    $("body").append(gettpl);
    if ($(".mui-content-padded").height()<$(window).height()/3){
        $(".mui-content-padded").addClass('padded-top');
    }
    mui('.mui-scroll-wrapper').scroll({indicators: false});
	<?php  if($_W['kefu']['switch1']) { ?>
	setTimeout(function(){
		mui("#poster").popover('toggle');
	}, 300);
	$(".js-popover-close").on("click",function(e) {
		var popover = "#"+$(this).data("popover");
		mui(popover).popover('hide');
	}); 
	<?php  } ?>
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>