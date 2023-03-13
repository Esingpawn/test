<?php defined('IN_IA') or exit('Access Denied');?><div class="form_item" style="padding:15px;margin-right:-15px;margin-left:-15px;" id='form_<?php  echo $form['id'];?>'>
	<input name="form_id[]" type="hidden" class="form-control form_id" value="<?php  echo $form['id'];?>"/>
    <input name="form_fieldstype[<?php  echo $form['id'];?>]" type="hidden" class="form-control js-fieldstype" value="<?php  echo $form['fieldstype'];?>"/>
    <input name="form_displaytype[<?php  echo $form['id'];?>]" type="hidden" class="form-control js-displaytype" value="<?php  echo $form['displaytype'];?>"/>
	<div class="form-group" style="margin-bottom:0px;">
		<div class="col-xs-12 col-sm-12 col-lg-12">
        	<div class="input-group">
            	<span class="input-group-addon">标题</span>
                <input name="form_title[<?php  echo $form['id'];?>]" type="text" class="form-control form_title" value="<?php  echo $form['title'];?>" placeholder="<?php  echo $form['placeholder'];?>"/>
                <span class="input-group-addon">描述</span>
                <input name="form_description[<?php  echo $form['id'];?>]" type="text" class="form-control" value="<?php  echo $form['description'];?>" placeholder="不填写默认标题名称"/>
                <span class="input-group-addon">
                <label class="checkbox-inline">
                    <input type="checkbox" <?php  if($form['essential']==1) { ?>checked<?php  } ?> value="1" onclick='essentialForm(this)'>必填
                    <input type="hidden" class="form_essential" name="form_essential[<?php  echo $form['id'];?>]" VALUE="<?php  echo $form['essential'];?>" />
                </label>
                </span>
                <div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="removeForm('<?php  echo $form['id'];?>')"><i class="fa fa-remove"></i></button></div>
            </div>
		</div>
	</div>
    <?php  if($form['displaytype']!=='' && in_array($form['displaytype'], array(0,1,2))) { ?>
	<div class="form-group js-child" style="margin-bottom:0px;">
		<div class="col-xs-12 col-sm-10 col-lg-10">
			<div id="form_item_<?php  echo $form['id'];?>" class='form_item_items'>
			<?php  if(is_array($form['items'])) { foreach($form['items'] as $k => $formitem) { ?>
            <?php  $formitem['placeholder']='输入选项'.($k+1);?>
            <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/tpl/form_item', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/tpl/form_item', TEMPLATE_INCLUDEPATH));?>
			<?php  } } ?>
			</div>
		</div>
        <div class="col-xs-12 col-sm-8 col-lg-8">
        <a href="javascript:;" id="add-formitem-<?php  echo $form['id'];?>" formid='<?php  echo $form['id'];?>' class="btn btn-info add-formitem" onclick="addFormItem('<?php  echo $form['id'];?>')"><i class="fa fa-plus"></i> 添加选项</a>
        </div>
	</div>
    <?php  } ?>
</div>