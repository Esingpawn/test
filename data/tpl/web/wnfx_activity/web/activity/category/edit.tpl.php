<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.dd-handle { height: 40px; line-height: 30px}
.dd-list { width:860px;}
.dd-handle span {
	font-weight: normal;
}
</style>
<div class="page-header">
    当前位置：<span class="text-primary"><?php  echo $cateTitle;?>活动分类</span>
</div>

<div class="page-content">
    <div class="page-toolbar">
        <span class="pull-left">
        	<?php  if($_W['op'] == 'display') { ?><button type="button" id="btnExpand" class="btn btn-default" data-action="expand"><i class="fa fa-angle-down"></i> 折叠所有</button><?php  } ?>
            <a href="<?php  echo web_url('activity/category/add')?>" class="btn btn-primary"><i class="fa fa-plus"></i> 添加新分类</a>
        </span>
		<div class="input-group"></div>
	</div>
    <form  action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
        <?php  if(!empty($parentid)) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">上级分类</label>
            <div class="col-sm-9 col-xs-12 control-label" style="text-align:left;"><?php  echo $parent['name'];?></div>
        </div>
        <?php  } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">排序</label>
            <div class="col-sm-9 col-xs-12">
                <input class="form-control" type="text" name="displayorder" value="<?php  if(empty($item['displayorder'])) { ?>0<?php  } else { ?><?php  echo $item['displayorder'];?><?php  } ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">分类名称</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" name="catename" class="form-control" value="<?php  echo $item['name'];?>" data-rule-required='true'/>
            </div>
        </div>
        <!--
        <div class="form-group">
            <label class="col-sm-2 control-label">分类描述</label>
            <div class="col-sm-9 col-xs-12">
                <textarea name="description" class="form-control" cols="70"></textarea>
            </div>
        </div>-->
        <div class="form-group">
            <label class="col-sm-2 control-label">分类图片</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
                <span class="help-block">建议尺寸: 200*200 </span>
            </div>
        </div>
        <?php  if(empty($parentid)) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">广告链接</label>
            <div class="col-sm-9 col-xs-12">
                <input class="form-control" type="text" name="redirect" value="<?php  echo $item['redirect'];?>" />
                <span class="help-block">指定点击分类时要跳转的链接（注：链接需加http://；仅限一级分类）。</span>
            </div>
        </div>
        <?php  } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">设置颜色</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_color('color', $value = $item['color'])?>
                <span class="help-block">颜色设置只支持一级分类，且在点击首页"全部"分类时才会生效</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">首页推荐</label>
            <div class="col-md-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="visible_level" value="1" <?php  if($item['visible_level'] == '1') { ?> checked="checked" <?php  } ?> />是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="visible_level" value="0" <?php  if(empty($item['visible_level'])) { ?> checked="checked" <?php  } ?> />否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">是否显示</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="enabled" value="1" <?php  if($item['enabled'] == '1') { ?> checked="checked" <?php  } ?> />是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="enabled" value="0" <?php  if(empty($item['enabled'])) { ?> checked="checked" <?php  } ?> />否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="submit" value="提交" class="btn btn-primary"/>
                <input type="button" name="back" onclick='history.back()' style='margin-left:10px;' value="返回列表" class="btn btn-default"/>
            </div>
        </div>
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>