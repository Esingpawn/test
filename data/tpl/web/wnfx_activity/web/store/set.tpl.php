<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header"> 当前位置：<span class="text-primary">核销设置</span> </div>
<div class="page-content">
    <form id="dataform" action="" method="post" class="form-horizontal form-validate">    
        <div class="form-group">
        <label class="col-sm-2 control-label must">关键词</label>
        <div class="col-sm-9 col-xs-12">
            <?php  if(perm('store.set')) { ?>
                <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" data-rule-required='true' />
                <span class='help-block'>店员核销使用，使用方法: 回复关键词后系统会提示输入消费码</span>
            <?php  } else { ?> 
                <div class="form-control-static"><?php  echo $keyword;?></div>
            <?php  } ?>
        </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php  if(perm('store.set')) { ?>
                    <input type="submit"  value="保存设置" class="btn btn-primary"/>
                <?php  } ?>
            </div>
        </div>
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>

