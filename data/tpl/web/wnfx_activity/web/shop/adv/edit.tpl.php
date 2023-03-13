<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary"><?php  if(!empty($adv['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>幻灯片<?php  if(!empty($adv['id'])) { ?>(<?php  echo $adv['advname'];?>)<?php  } ?></span>
</div>
<div class="page-content">
<div class="page-sub-toolbar">
	<span class=''>
	<a class="btn btn-primary btn-sm" href="<?php  echo web_url('shop/adv/add')?>">添加新幻灯片</a>
	</span>
</div>
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php  echo $adv['id'];?>"/>
	<div class="form-group">
		<label class="col-lg control-label">排序</label>
		<div class="col-sm-9 col-xs-12">
            <input type="text" name="displayorder" class="form-control" value="<?php  echo $adv['displayorder'];?>" />
			<span class='help-block'>数字越大，排名越靠前</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg control-label must">幻灯片标题</label>
		<div class="col-sm-9 col-xs-12 ">
			<input type="text" id='advname' name="advname" class="form-control" value="<?php  echo $adv['advname'];?>" data-rule-required="true"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg control-label">幻灯片图片</label>
		<div class="col-sm-9 col-xs-12">
			<?php  echo tpl_form_field_image('thumb', $adv['thumb'])?>
			<span class='help-block'>建议尺寸:640 * 350 , 请将所有幻灯片图片尺寸保持一致</span>
		</div>
	</div>
    <div class="form-group">
        <label class="col-lg control-label">背景色调</label>
        <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_form_field_color('color', $value = $adv['color'])?>
            <span class="help-block">图片轮播自动变换指定背景颜色【默认：#a6835a】</span>
        </div>
    </div>
	<div class="form-group">
		<label class="col-lg control-label">幻灯片链接</label>
		<div class="col-sm-9 col-xs-12">			
            <div class="input-group">
                <span class="input-group-addon">H5</span>
                <input type="text" value="<?php  echo $adv['link'];?>" class="form-control valid" name="link" placeholder="" id="advlink">
            </div>
		</div>
	</div>
    <div class="form-group">
		<label class="col-lg control-label"></label>
		<div class="col-sm-9 col-xs-12">			
            <div class="input-group">
                <span class="input-group-addon">小程序</span>
                <input type="text" value="<?php  echo $adv['applink'];?>" class="form-control valid" name="applink" placeholder="">
            </div>
            <span class="help-block">如果跳转到其它小程序，请在连接后添加对应小程序的"appid"参数，格式：/pages/index/index?appid=wx4ge65sfd98g84fe</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg control-label">状态</label>
		<div class="col-sm-9 col-xs-12">
			<label class='radio-inline'>
                <input type='radio' name='enabled' value='1' <?php  if($adv['enabled']==1) { ?>checked<?php  } ?> /> 显示
            </label>
            <label class='radio-inline'>
                <input type='radio' name='enabled' value='0' <?php  if(empty($adv['enabled'])) { ?>checked<?php  } ?> /> 隐藏
            </label>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<input type="submit" value="提交" class="btn btn-primary"/>
			<a class="btn btn-default btn-sm" href="<?php  echo web_url('shop/adv')?>">返回列表</a>
		</div>
	</div>
</form>
<script language='javascript'>
    function formcheck() {
        if ($("#advname").isEmpty()) {
            Tip.focus("advname", "请填写幻灯片名称!");
            return false;
        }
        return true;
    }
</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>