<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  if(isset($title)) $_W['page']['title'] = $title?><?php  if(!empty($_W['page']['title'])) { ?><?php  echo $_W['page']['title'];?><?php  } ?><?php  if(empty($_W['page']['copyright']['sitename'])) { ?><?php  if(IMS_FAMILY != 'x') { ?><?php  if(!empty($_W['page']['title'])) { ?> - <?php  } ?><?php  echo $_W['_config']['sname'];?>报名管理平台<?php  } ?><?php  } else { ?><?php  if(!empty($_W['page']['title'])) { ?> - <?php  } ?><?php  echo $_W['page']['copyright']['sitename'];?><?php  } ?></title>
    <link rel="shortcut icon" href="<?php echo FX_URL;?>icon.jpg" />
    <link href="<?php echo FX_BASE;?>web/resource_v2/css/bootstrap.min.css?v=3.3.0" rel="stylesheet">
    <link href="<?php echo FX_BASE;?>web/resource_v2/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo FX_BASE;?>web/resource_v2/css/animate.css" rel="stylesheet">
    <link href="<?php echo FX_BASE;?>web/resource_v2/css/common_v2.css?v=<?php echo FX_RELEASE_DATE;?>" rel="stylesheet">
    <link href="<?php echo FX_BASE;?>web/resource_v2/css/v2.css?v=<?php echo FX_RELEASE_DATE;?>" rel="stylesheet">
    <link href="<?php echo FX_BASE;?>web/resource_v2/fonts/v2/iconfont.css?v=20181126" rel="stylesheet" type="text/css">
    <link href="<?php echo FX_BASE;?>web/resource_v2/fonts/iconfont.css?v=2016070717" rel="stylesheet" type="text/css">
    <link href="<?php echo FX_BASE;?>web/resource_v2/fonts/wxiconx/iconfont.css?v=2016070717" rel="stylesheet" type="text/css">
    <script src="<?php echo FX_PATH;?>web/resource/js/lib/jquery-1.11.1.min.js"></script>
    <script src="<?php echo FX_PATH;?>web/resource/js/app/util.js?v=<?php echo IMS_RELEASE_DATE;?>"></script>
    <script src="<?php echo FX_BASE;?>web/resource_v2/fonts/v2/iconfont.js"></script>
	<script src="<?php echo FX_BASE;?>web/resource_v2/js/dist/jquery/jquery.gcjs.js"></script>
    <script type="text/javascript">
		if(navigator.appName == 'Microsoft Internet Explorer'){
			if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
				alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
			}
		}
		var module_ver = <?php  if($_W['routes']!='') { ?>'v2'<?php  } else { ?>'v1'<?php  } ?>, module_name='<?php echo IN_MODULE;?>';
		window.sysinfo = {
			<?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
			<?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
			<?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
			<?php  if(!empty($_W['role'])) { ?>'role': '<?php  echo $_W['role'];?>',<?php  } ?>
			<?php  if(!empty($_W['highest_role'])) { ?>'highest_role': '<?php  echo $_W['highest_role'];?>',<?php  } ?>
			'isfounder': <?php  if(!empty($_W['isfounder'])) { ?>1<?php  } else { ?>0<?php  } ?>,
			'family': '<?php echo IMS_FAMILY;?>',
			'siteroot': '<?php  echo $_W['siteroot'];?>',
			'siteurl': '<?php  echo $_W['siteurl'];?>',
			'attachurl': '<?php  echo $_W['attachurl'];?>',
			'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
			'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
			'module' : {'url' : '<?php  if(defined('MODULE_URL')) { ?><?php echo MODULE_URL;?><?php  } ?>', 'name' : '<?php  if(defined('IN_MODULE')) { ?><?php echo IN_MODULE;?><?php  } ?>'},
			'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
			'account' : <?php  echo json_encode($_W['account'])?>,
			'server' : {'php' : '<?php  echo phpversion()?>'},
			'frame': '<?php echo FRAME;?>',
		};
    </script>
    <?php  if(IMS_VERSION >= 2.6) { ?><script>var require = { urlArgs: 'v=<?php echo FX_RELEASE_DATE;?>' };</script><?php  } ?>
    <!-- 兼容微擎1.5 -->
	<?php  if(IMS_VERSION >= 1.5) { ?>
    <link href="<?php echo FX_PATH;?>web/resource/css/common.css?v=<?php echo IMS_RELEASE_DATE;?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo FX_PATH;?>web/resource/js/lib/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo FX_PATH;?>web/resource/js/app/common.min.js?v=<?php echo IMS_RELEASE_DATE;?>"></script>
    <script type="text/javascript">if(util){util.clip = function(){}}</script>
    <?php  } ?>
    <script src="<?php echo FX_BASE;?>web/resource_v2/js/require.js"></script>
    <?php  if(IMS_VERSION >= 2.6) { ?><script type="text/javascript" src="<?php echo FX_PATH;?>web/resource/js/lib/jquery.nice-select.js?v=<?php echo IMS_RELEASE_DATE;?>"></script><?php  } ?>
    <?php  if(IMS_VERSION > 0.8 && IMS_VERSION != '1.0.0') { ?>
	<script src="<?php echo FX_BASE;?>web/resource_v2/js/config1.0.js?v=1.0.2"></script>
    <?php  } else { ?>
    <script src="./resource/js/app/config.js"></script>
    <?php  } ?>
    <script>
        require.config({
            waitSeconds: 0
        });
    </script>
    <script src="<?php echo FX_BASE;?>web/resource_v2/js/myconfig.js?v=20181128"></script>
    <script type="text/javascript">
		myrequire.path = "resource_v2/js/";
		myconfig.path = "<?php echo FX_BASE;?>web/resource_v2/js/";
        function preview_html(txt)
        {
            var win = window.open("", "win", "width=300,height=600"); // a window object
            win.document.open("text/html", "replace");
            win.document.write($(txt).val());
            win.document.close();
        }
    </script>
</head>
<body>
