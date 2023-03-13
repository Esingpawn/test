<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .feed-activity-list {
        width: 100%;
        overflow: hidden;
    }

    .feed-element {
        float: left;
        width: 320px;
        height: 120px;
        margin-left: 15px;
        margin-bottom: 20px;
        border: 1px solid #efefef;
        padding: 20px;
    }

    .feed-element::after {
        display: none
    }

    .feed-element .title {
        font-size: 14px;
        height: 24px;
        line-height: 20px;
        vertical-align: bottom;
        color: #333;
        font-weight: bold;
        margin-left: 10px;
    }

    .feed-element img.img-circle,
    .dropdown-messages-box img.img-circle {
        float: left;
        width: 60px;
        height: 60px;
        border-radius: 4px;
    }

    .media-body {
        margin-top: 3px;
        height: 65px;
    }

    .text-muted {
        margin-left: 10px;
        width: 200px;
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .authorization{
        width: 95%;
        height:20px;
        color: #999;
        line-height: 24px;
        border-top: 1px solid #efefef;
    }
</style>
<div class="page-header">
        <div class="pull-right">
            <div class="input-group" style="width:400px;">
                <span class="input-group-addon">搜索</span>
                <input type="text" class="form-control" id="name" placeholder="输入应用名称进行快速搜索">

            </div>
        </div>
    当前位置：<span class="text-primary">我的应用</span>
</div>
<div class="page-content">
    <div class='panel panel-default' style='border:none;'>
    	<?php  if(!MERCHANTID) { ?>
    	<?php  if(perm('merch')) { ?>
        <div class="panel-heading" style='background:none;border:none;'>业务类</div>
        <div class="feed-activity-list">
            <a class="feed-element" href="<?php  echo web_url('merch/user')?>" data-name="多商户" target="_blank">
                <span class="pull-left">
                    <img src="<?php echo FX_BASE;?>web/resource_v2/images/merch.jpg" class="img-circle" alt="image" onerror="this.src='<?php echo FX_BASE;?>web/resource_v2/images/yingyong.png'">
                </span>
                <div class="media-body">
                    <span class="title">
                        <span class="fl">多商户</span>
                        <?php  if($v['wxapp_support']==2) { ?>
                        <img src="<?php echo FX_BASE;?>web/resource_v2/images/xcx.png" alt="" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" data-content="已支持小程序" style="font-size: 12px;color: #00c952;margin-left:5px;">
                        <?php  } ?>
                    </span>
                    <small class="text-muted">自己活动不够丰富，邀请更多主办方入驻，丰富平台活动。</small>            
                </div>
            </a>
        </div>
        <?php  } ?>
        <?php  } ?>
    	<?php  if(is_array($group_plugin)) { foreach($group_plugin as $i => $row) { ?>
        <div class="panel-heading" style='background:none;border:none;'><?php  echo $row['type'];?></div>
        <div class="feed-activity-list">
        	<?php  if(is_array($row['mod'])) { foreach($row['mod'] as $mod) { ?>
            <a class="feed-element" href="<?php  if(!MERCHANTID) { ?>?c=home&a=welcome&do=account_ext&module_name=<?php  echo $mod['name'];?><?php  } else { ?><?php  echo web_url($mod['name'])?><?php  } ?>" data-name="<?php  echo $mod['title'];?>" target="_blank">
                <span class="pull-left">
                    <img src="<?php  echo tomedia($mod['logo'])?>" class="img-circle" alt="image" onerror="this.src='<?php echo FX_BASE;?>web/resource_v2/images/yingyong.png'">
                </span>
                <div class="media-body">
                    <span class="title">
                        <span class="fl"><?php  echo $mod['title'];?></span>
                        <?php  if($mod['wxapp_support']==2) { ?>
                        <img src="<?php echo FX_BASE;?>web/resource_v2/images/xcx.png" alt="" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" data-content="已支持小程序" style="font-size: 12px;color: #00c952;margin-left:5px;">
                        <?php  } ?>
                    </span>
                    <small class="text-muted"><?php  echo $mod['description'];?></small>            
                </div>
            </a>
            <?php  } } ?>
        </div>
        <?php  } } ?>
    </div>
</div>
<script>
 $(function(){
	$('#name').bind('input propertychange',function(){
		var name = $.trim( $('#name').val() );
		if( name==''){
			$('.feed-activity-list').prev('.panel-heading').show();
			$('.feed-element').show();
		}else{

			$('.feed-activity-list').prev('.panel-heading').hide();
			$('.feed-element').hide();

			$('.feed-element').each(function(){

				if($(this).data('name').indexOf( name )!=-1){
					$(this).show().closest('.feed-activity-list').prev('.panel-heading').show();
				}
			});
		}

	})
})
$(document).ready(function () {
	$('.feed-activity-list,.plugin_tabs').each(function () {
		if ($(this).children().length <= 0) {
			$(this).prev().remove();
			$(this).remove();
		}
	});
})

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>