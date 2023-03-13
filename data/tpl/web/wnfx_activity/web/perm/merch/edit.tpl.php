<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?> 
<div class="page-header">
    <span>当前位置：<span class="text-primary"> 编辑权限 <small></small></span></span>

</div>
 <div class="page-content">
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="mid" value="<?php  echo $mid;?>" />
        <input type="hidden" name="rolename" value="<?php  echo $rolename;?>" />
        <div class="form-group">
            <label class="col-lg control-label">商户名称</label>
            <div class="col-sm-9 col-xs-12">
                <div class='form-control-static'><?php  echo $rolename;?></div>
            </div>
        </div>
        <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('perm/perms', TEMPLATE_INCLUDEPATH)) : (include fx_template('perm/perms', TEMPLATE_INCLUDEPATH));?>
        <?php  if(perm('perm.role')) { ?>
        <?php  } else { ?>
        <script language='javascript'>
			$(function(){
				//$(':checkbox').attr('disabled',true);
			})
		</script>
		<?php  } ?>
		<div class="form-group"></div>
		<div class="form-group">
				<label class="col-lg control-label"></label>
				<div class="col-sm-9 col-xs-12">
					<?php  if(perm('perm.role')) { ?>
						<input type="submit" value="提交" class="btn btn-primary"  />
						
					<?php  } ?>
				   <input type="button" name="back" onclick='history.back()' <?php  if(perm('perm.role.add|perm.role.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
				</div>
		</div>
    </form>
 </div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>