<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('perm/perms', TEMPLATE_INCLUDEPATH)) : (include fx_template('perm/perms', TEMPLATE_INCLUDEPATH));?>
<?php  if(perm('perm.role')) { ?>
<?php  } else { ?>
<script language='javascript'>
    $(function(){
        //$(':checkbox').attr('disabled',true);
    })
</script>
<?php  } ?>