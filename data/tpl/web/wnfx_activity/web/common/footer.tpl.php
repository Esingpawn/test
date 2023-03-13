<?php defined('IN_IA') or exit('Access Denied');?>    <!--微擎版权-->
    <style>
    .copyright-footer{background:#fff;border-radius:4px;margin:20px 0 0 0;padding:20px 0;line-height:20px;color:#999;font-size:12px}.copyright-footer a{color:#999}
    </style>
    <div class="container-fluid footer text-center copyright-footer" role="footer">
        <div class="copyright">
        <?php  if(!MERCHANTID) { ?>
        <?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>
            Powered by <a href="http://www.w7.cc"><b>微擎</b></a> v<?php echo IMS_VERSION;?> © 2014-2020 <a href="http://www.w7.cc">www.w7.cc</a>
        <?php  } else { ?>
            <?php  echo $_W['setting']['copyright']['footerleft'];?>
        <?php  } ?>
        <?php  } else { ?>
        	报名管理系统 V2 版 © 2016-2020
        <?php  } ?>
        </div>
    </div>
    <!--微擎版权结束-->
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer-base', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer-base', TEMPLATE_INCLUDEPATH));?>