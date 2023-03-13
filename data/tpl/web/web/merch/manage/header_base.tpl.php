<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php  if(!empty($copyright) && !empty($copyright['title'])) { ?><?php  echo $copyright['title'];?><?php  } ?></title>
        <link rel="shortcut icon" href="<?php echo FX_URL;?>icon.jpg" />
        <link href="<?php echo FX_BASE;?>web/resource_v2/css/bootstrap.min.css?v=3.3.7" rel="stylesheet">
        <link href="<?php echo FX_BASE;?>web/resource_v2/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
        <link href="<?php echo FX_BASE;?>web/resource_v2/css/animate.css" rel="stylesheet">
        <link href="<?php echo FX_BASE;?>web/resource_v2/css/v2.css?v=4.1.1" rel="stylesheet">
        <link href="<?php echo FX_BASE;?>web/resource_v2/css/common_v2.css?v=3.0.2" rel="stylesheet">
        <link href="<?php echo FX_BASE;?>web/resource_v2/fonts/wxiconx/iconfont.css?v=2016070717" rel="stylesheet" type="text/css">
		<script src="<?php echo FX_PATH;?>web/resource/js/lib/jquery-1.11.1.min.js"></script>
        <script src="<?php echo FX_BASE;?>web/resource_v2/js/dist/jquery/jquery.gcjs.js"></script>
        <script src="<?php echo FX_PATH;?>web/resource/js/app/util.js"></script>
        <script>
		var module_name='<?php echo IN_MODULE;?>';
            window.sysinfo = {
            <?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
            <?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
            <?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
            <?php  if(!empty($_W['uid'])) { ?>'uid': '<?php  echo $_W['uid'];?>',<?php  } ?>
            'isfounder': <?php  if(!empty($_W['isfounder'])) { ?>1<?php  } else { ?>0<?php  } ?>,
            'siteroot': '<?php  echo $_W['siteroot'];?>',
                    'siteurl': '<?php  echo $_W['siteurl'];?>',
                    'attachurl': '<?php  echo $_W['attachurl'];?>',
                    'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
                    'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
                    'module' : {'url' : '<?php  if(defined('MODULE_URL')) { ?><?php echo MODULE_URL;?><?php  } ?>', 'name' : '<?php  if(defined('IN_MODULE')) { ?><?php echo IN_MODULE;?><?php  } ?>'},
            'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
            'account' : <?php  echo json_encode($_W['account'])?>,
            };
        </script>

        <!-- 兼容微擎1.5.3 -->
        <?php  if(IMS_VERSION >= 1.5) { ?>
        <link href="<?php echo FX_BASE;?>web/resource_v2/css/we7.common.css?v=1.0.0" rel="stylesheet">
        <script type="text/javascript" src="<?php echo FX_PATH;?>web/resource/js/lib/bootstrap.min.js"></script>
    	<script type="text/javascript" src="<?php echo FX_PATH;?>web/resource/js/app/common.min.js?v=20170802"></script>
        <script type="text/javascript">if(util){util.clip = function(){}}</script>
        <?php  } ?>

        <script src="<?php echo FX_BASE;?>web/resource_v2/js/require.js"></script>

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
			if (navigator.appName == 'Microsoft Internet Explorer') {
				if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
					alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
				}
			}
        </script>
</head>

