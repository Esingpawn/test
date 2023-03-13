<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">模版设置</span></div>

<div class="page-content">
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
		<div class="alert alert-primary">
            <p style="text-indent: 18px;">说明：</p>
            <p style="text-indent: 18px;">1. 创建路径：addons/<?php echo IN_MODULE;?>/template/mobile/</p>
            <p style="text-indent: 18px;">2. 目录结构：必须遵循“default”文件夹内的文件结构，否则不生效.</p>
            <p style="text-indent: 18px;">3. 调用规则：如果自定义目录对应的某个文件不存在，系统会自动调用"default"内的对应文件，以确保页面正常显示.</p>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">手机端模板</label>
            <div class="col-sm-9 col-xs-12">
                <?php  if(perm('sysset.tpl.edit')) { ?>
                <select class='form-control' name='data[style]'>
                    <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
                    <option value='<?php  echo $style;?>' <?php  if($style==$data['style']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
                    <?php  } } ?>
                </select>
                <?php  } else { ?>
                <input type="hidden" name="data[style]" value="<?php  echo $data['shop']['style'];?>"/>
                <div class='form-control-static'>
                    <?php  if(empty($data['style'])) { ?>default<?php  } else { ?><?php  echo $data['style'];?><?php  } ?>
                </div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php  if(perm('sysset.tpl.edit')) { ?>
                <input type="submit" value="提交" class="btn btn-primary"/>
                <?php  } ?>
            </div>
        </div>
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>