<?php defined('IN_IA') or exit('Access Denied');?><?php  if(($_W['_config']['guanzhu'] == 1 || $_W['_config']['guanzhu_join'] == 2) && empty($_W['fans']['follow']) && $_GPC['from']!='wxapp') { ?>
<style type="text/css">
.subscribe{position: absolute;width: 100%; left: 0; right: 0; background-color: rgba(0, 0, 0, 0.72); z-index: 10; overflow: hidden; margin: 0 auto;height:2.3rem;}
.subscribe .img{width:1.5rem; height:1.5rem; position:absolute; left:0.35rem; top:0.36rem;}
.subscribe .img img{width:1.5rem; height:1.5rem; border-radius:0.2rem;}
.subscribe .text{padding:0.35rem 3.8rem 0.35rem 2.2rem; line-height:1.3; color:#fff;}
.subscribe .text p{ font-size:0.55rem;}
.subscribe .text font{color:#FA5343;}
.subscribe .btn{position:absolute; right:10px; top:0.55rem;}
.subscribe .btn .buttonn{background:#FA5343;width:3rem;height:1.2rem;line-height:2.2; font-size:0.55rem;text-align:center; border-radius:5px; color: #fff;border:none;}
.subscribe p{ color:#FFF; margin-bottom: 5px;}
.st{position:absolute;top:20%;left:0;right:0;z-index:100000;opacity:0.75;color:white;background: rgba(68, 68, 68, 0);background-image:initial;background-position-x:initial;background-position-y:initial;background-size: initial;background-repeat-x:initial;background-repeat-y:initial;background-attachment: initial;background-origin:initial;background-clip:initial;background-color:rgba(68, 68, 68, 0);}
.st .m_guide{ text-align:center}
.st .close{ display:block; width:200px; margin:auto; text-align:right;}
.all{position:absolute;z-index:99999;width: 100%;height: 100%;opacity: 0.75;background-color: #000000;}
</style>
<?php  if($_W['container']=='wechat') { ?>
<div class="top" id="m_popUp" style="display: none;">
    <div class="all" style="font-size:14px;">
    </div>
    <div class="st">
        <div class="st" style="position: absolute;margin-top: -80px; text-align:center"><span class="close">×关闭</span></div>
        <div style="float: right;opacity: 0.75;color: #000000;"></div>
        <div class="m_guide">
            <div style="margin-left: auto;margin-right: auto;background-color: rgba(0, 0, 0, 0);">
                <img src="<?php  echo tomedia($_W['_config']['followed_image']);?>" style="width: 200px;height: 200px;">
            </div>
            <div class="m_how" style="margin-top: 10px;">
                <h4 style="text-align: center;">长按识别二维码打开公众号</h4>
            </div>
        </div>
    </div>
</div>
<?php  if($_W['_config']['guanzhu'] == 1) { ?>
<div class="subscribe">
    <div class="img"><img src="<?php  echo tomedia($_W['_config']['slogo']);?>"></div>
    <div class="text">
        <p>欢迎来到<font><?php  echo $_W['_config']['sname'];?></font></p>
        <p>前往公众号，享受专属服务</p>
    </div>
    <div class="btn">
        <a class="lizhuanz" href="javascript:;"><div class="buttonn">立即前往</div></a>
    </div>
</div>
<?php  } ?>
<?php  } ?>
<script>
$(function() {
	$(document).on('tap', '.js-follow', function() {
		<?php  if($_W['container']=='wechat') { ?>
			util.confirm('打开公众号按提示操作', ' ', function(e) {
				if (e.index == 1) {
					$('#m_popUp').show();
					//$('.subscribe').remove();
				}else{}
			});
		<?php  } else { ?>
			util.alert('请分享此连接到微信打开', ' ', function(e) {});
		<?php  } ?>
	})
	$('.buttonn').on('tap', function() {
		<?php  if($_W['container']=='wechat') { ?>
			$('#m_popUp').show();
			$('.subscribe').addClass("animated slideUp");
		<?php  } else { ?>
			util.alert('请分享此连接到微信打开', ' ', function(e) {});
		<?php  } ?>
		//$('.subscribe').remove();
	});
	$('.top .close').on('click', function(e) {
		$('.top').hide();
		$.post("<?php  echo app_url('check/check/follow')?>",'',function(d){
			if(d.result){
				window.location.reload();
			}
		},"json");
	});
	
	$(".subscribe").headroom({
		scrollArea:'.mui-scroll-wrapper-ext',
		distance:100,
		classes: {
			initial: "animated",
			pinned: "slideDown",
			unpinned: "slideUp"
		}
	});
	$(".subscribe").headroom({
		scrollArea:'.mui-content',
		distance:100,
		classes: {
			initial: "animated",
			pinned: "slideDown",
			unpinned: "slideUp"
		}
	});
});
</script>  
<?php  } ?>