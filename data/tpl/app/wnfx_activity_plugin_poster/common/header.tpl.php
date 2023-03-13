<?php defined('IN_IA') or exit('Access Denied');?><?php  fx_load()->app('common');?>
<?php  $routes = explode('.', $_W['routes'])?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php  if(!empty($pagetitle)) { ?><?php  echo $pagetitle;?><?php  } else if(!empty($_W['page']['title'])) { ?><?php  echo $_W['page']['title'];?><?php  } ?></title>
    <meta name="format-detection" content="telephone=no, email=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <link rel="shortcut icon" href="<?php echo FX_URL;?>icon.jpg" />
    <link rel="stylesheet" type="text/css" href="../app/resource/css/common.min.css?v=<?php echo IMS_RELEASE_DATE;?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FX_BASE;?>app/resource/components/mui/mui.ext.css?v=<?php echo FX_RELEASE_DATE;?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FX_BASE;?>app/resource/components/dropload/dropload.css?v=20171106">
    <?php  echo wx_jssdk(false);?>
    <!--兼容图片上传1.0-->
    <script>var app_module_name='<?php echo IN_MODULE;?>';</script>
    <script type="text/javascript" src="../app/resource/js/app/util.js?v=<?php echo FX_RELEASE_DATE;?>"></script>
    <script type="text/javascript" src="../app/resource/js/require.js?v=<?php echo FX_RELEASE_DATE;?>"></script>
    <script type="text/javascript" src="../app/resource/js/lib/jquery-1.11.1.min.js?v=<?php echo IMS_RELEASE_DATE;?>"></script>
    <script type="text/javascript" src="<?php echo FX_BASE;?>app/resource/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?php echo FX_BASE;?>app/resource/js/app/util.min.js?v=<?php echo FX_RELEASE_DATE;?>"></script>
    <script type="text/javascript" src="<?php echo FX_BASE;?>app/resource/components/mui/js/mui.min.js?v=<?php echo FX_RELEASE_DATE;?>"></script>
    <script type="text/javascript" src="../app/resource/js/app/common.js?v=<?php echo IMS_RELEASE_DATE;?>"></script>
    <script type="text/javascript" src="<?php echo FX_BASE;?>app/resource/components/dropload/dropload.min.js?v=1.0.1"></script>
    <script type="text/javascript" src="<?php echo FX_BASE;?>app/resource/components/layui/laytpl.js"></script>
    <script type="text/javascript" src="<?php echo FX_BASE;?>app/resource/components/headroom/jQuery.headroom.js?v=20171114"></script>
    <script type="text/javascript">
		var htmlFont = $("html").css("font-size").replace('px',''),
		shareData = {
			title : "<?php  echo $_W['share']['title'];?>",
			desc  : "<?php  echo $_W['share']['desc'];?>",
			link  : location.href.split('from')[0] + "&mid=<?php  echo $_W['fans']['uid'];?>",
			imgUrl: "<?php  echo tomedia($_W['share']['pic'])?>"
		}, 
		wxapp_data = {
			'url': '/wnfx_activity/pages/index/index',
			'shareDesc': shareData.desc,
			'shareImage': shareData.imgUrl,
			'shareTitle': shareData.title,
			'id': "<?php  echo $_GPC['id'];?>",
			'mid': "<?php  echo $_W['fans']['uid'];?>"
		},
		position = {lat:0,lng:0,addr:'',city:'',ucity:"<?php echo intval($_W['_config']['countrie'])==1 || !intval($_W['_config']['countrie']) ? '全国' : ''?>"};
		position = $.getCookie("position")==null ? position : JSON.parse($.getCookie("position"));
<?php  if(intval($_W['_config']['location']) && ($routes['0']=='home' || $routes['0']=='activity')) { ?>
		if ($.getCookie("position")==null){
			util.location(function(res) {
				res.ucity = position.ucity!='' ? position.ucity : res.city.replace("市", "");
				$.setCookie("position", JSON.stringify(res), 's3600');
				window.location.reload()
			});
		}
<?php  } ?>
		wx.ready(function () {
			var _sharedata = {
				title  : shareData.title,
				desc   : shareData.desc,
				link   : shareData.link,
				imgUrl : shareData.imgUrl,
				success: function(share){
				<?php  if($_W['action']=='activity.detail') { ?>
					$.post("<?php  echo app_url('activity/detail/share',array('id'=>$id))?>",function(d) {
						if (d.result==1 || d.result==2){
							util.alert(d.data,' ',function(){ });							
						}
						<?php  if($_W['plugin']['poster']['config']['commission_enable'] && $activity['prize']['commission'] && empty($agent)) { ?>	util.confirm('分享好友<?php  echo $_W['_config']['buytitle'];?>获取 <?php  echo $commission_rule["first_level_rate"];?>% 佣金，点击我要推广，升级为推广员', ' ', ['取消', '我要推广'], function(e) {
								if (e.index == 1) location.href = "<?php  echo $commission_url;?>"
							});								
						<?php  } ?>
					},"json");		
				<?php  } ?>},
				cancel : function(){util.alert('已取消分享', ' ')}
			};
			<?php echo $_W['container']=='workwechat' ? 'wx.onMenuShareWechat(_sharedata);' : '';?>
			wx.onMenuShareAppMessage(_sharedata);
			wx.onMenuShareTimeline(_sharedata);
			wx.onMenuShareQQ(_sharedata);
		});
	</script>
</head>
<body>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/loader', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/loader', TEMPLATE_INCLUDEPATH));?>