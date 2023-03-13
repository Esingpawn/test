<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
  .city_users { background:#FFF; }
  .city_users li { padding:8px 10px 8px 15px; border-bottom:1px solid #EFEFEF; font-size:16px;color: #646464}
  .city_users li span{display: inline-block;height: 35px}
  .mui-media-body,.mui-media-body p{ color:#666666;}
  .mui-media-body p:first-child span { overflow:hidden; display:inline-block;line-height:1;}
  .mui-media-body p:first-child span.mui-ellipsis{ max-width:60%;}
  .mui-media-body p:first-child span.mui-ext-icon{ width:15px; height:15px; margin-left:10px; position:relative; border-radius: 100%;}
  .mui-media-body p:first-child span.mui-ext-icon:before{ font-size:12px;top:42%;left: 60%;-webkit-transform: translateX(-50%) translateY(-50%) scale(0.8);transform: translateX(-50%) translateY(-50%) scale(0.8);}
  .mui-media-body p:first-child span.mui-icon-nan{background:#71a4df; color:#FFF;}
  .mui-media-body p:first-child span.mui-icon-nv{background:#fb8282; color:#FFF;}
  .mui-table-view li img{border-radius:10%; margin-right:10px;vertical-align: middle;}
</style>
<div class="mui-content">
	<?php  if(!empty($join)) { ?>
	<ul class="mui-table-view mui-table-view-chevron" style="margin-top: 0;">
        <li class="mui-table-view-cell mui-media">
            <a class="mui-navigate-right" href="<?php  if(!empty($join)) { ?><?php  echo app_url('home/user/show',array('rid'=>$join['id']))?><?php  } else { ?>javascript:;<?php  } ?>">
                <img class="mui-media-object mui-pull-left" src="<?php  echo tomedia($_W['fans']['avatar'])?>">
                <div class="mui-media-body">
                	<p><span class="mui-ellipsis"><?php  echo $join['nickname'];?></span> <span class="mui-ext-icon<?php  if(!empty($join['gender']) && $join['gender']!='保密') { ?><?php echo $join['gender']=='女'?' mui-icon-nv':' mui-icon-nan'?><?php  } ?>">&nbsp;</span></p>
                    <p class="mui-ellipsis mui-small">人数 <span class="mui-text-orange"><?php  echo $join['buynum'];?></span> 人 <?php  echo $_W['_config']['buytitle'];?>时间 <?php  echo tranTime(strtotime($join['jointime']))?></p>
                </div>
            </a>
        </li>
    </ul>
    <?php  } ?>
	<div class="mui-content-padded">
	<p>已有 <span class="mui-text-orange"><?php  echo $joinnum;?></span> 位用户成功<?php  echo $_W['_config']['buytitle'];?></p>
    </div>
    <ul class="mui-table-view mui-table-view-chevron">
    	<?php  if(is_array($records)) { foreach($records as $row) { ?>
        <?php  if($row['id']!=$join['id']) { ?>
        <li class="mui-table-view-cell mui-media">
            <a class="mui-navigate-right" href="<?php  if(!empty($join)) { ?><?php  echo app_url('home/user/show',array('rid'=>$row['id']))?><?php  } else { ?>javascript:;<?php  } ?>">
                <img class="mui-media-object mui-pull-left" src="<?php  echo tomedia($row['avatar']);?>">
                <div class="mui-media-body">
                    <p><span class="mui-ellipsis"><?php  echo $row['nickname'];?></span> <span class="mui-ext-icon<?php  if(!empty($row['gender']) && $row['gender']!='保密') { ?><?php echo $row['gender']=='女'?' mui-icon-nv':' mui-icon-nan'?><?php  } ?>">&nbsp;</span></p>
                    <p class="mui-ellipsis mui-small">人数 <span class="mui-text-orange"><?php  echo $row['buynum'];?></span> 人 <?php  echo $_W['_config']['buytitle'];?>时间 <?php  echo tranTime(strtotime($row['jointime']))?></p>
                </div>
            </a>
        </li>
        <?php  $lasttime = strtotime($row['jointime'])?>
        <?php  } ?>
        <?php  } } ?>
        <?php  if(is_array($activity['falsedata']['head'])) { foreach($activity['falsedata']['head'] as $k => $headurl) { ?>
        <?php  if($k > $activity['falsedata']['num']-1) { ?><?php  break;?><?php  } ?>
        <li class="mui-table-view-cell mui-media">
            <a class="mui-navigate-right" href="javascript:;">
                <img class="mui-media-object mui-pull-left" src="<?php  echo tomedia($headurl);?>">
                <div class="mui-media-body">
                    <?php  echo $activity['falsedata']['nickname'][$k];?>
                    <?php $stime = empty($lasttime)?strtotime($activity['joinstime'])+789594:$lasttime?>
                    <?php  $timestr = $stime-(1812*3.1415926*($k+1)*0.2898875469)-pow(5.644541,0.02877598*($k+1))?>
                    <p class="mui-ellipsis mui-small">人数 <span class="mui-text-orange">1</span> 人 <?php  echo $_W['_config']['buytitle'];?>时间 <?php  echo tranTime($timestr)?></p>
                </div>
            </a>
        </li>
        <?php  } } ?>
    </ul>
    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('copyright', TEMPLATE_INCLUDEPATH)) : (include fx_template('copyright', TEMPLATE_INCLUDEPATH));?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>