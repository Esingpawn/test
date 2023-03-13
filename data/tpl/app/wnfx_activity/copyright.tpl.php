<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
.footer{width: 100%;padding-top: 10px;padding-bottom: 80px;display: inline-block;text-align: center; font-size:12px}
.footer img{ display:block; margin:0 auto 5px auto; }
.latecolor,.latecolor a{color: #c3c3c3;}
</style>
<div class="footer latecolor">
<?php  $copyright = $_W['_config']['copyright']?>
<a href="<?php echo !empty($copyright['link'])?$copyright['link']:'javascript:;'?>">
<?php  if(!empty($copyright['logo'])) { ?><img src="<?php  echo tomedia($copyright['logo'])?>" height="30" /><?php  } ?>
<?php  if(!empty($copyright['title'])) { ?><?php  echo $copyright['title'];?><?php  } ?></a>
</div>