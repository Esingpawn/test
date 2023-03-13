<?php defined('IN_IA') or exit('Access Denied');?><?php $index = !empty($index) ? $index : 0?>
<?php  for ($ii = $index; $ii < $formnum; $ii++) { ?>
<div class="mui-input-group form">
    <div class="mui-input-row mui-group-title"<?php  if($formnum==1) { ?> style="display:none"<?php  } ?>><label>第<?php  echo $ii+1?>位用户</label></div>
    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('order/form_basic', TEMPLATE_INCLUDEPATH)) : (include fx_template('order/form_basic', TEMPLATE_INCLUDEPATH));?>
    <?php  $key = 0;?>
    <?php  if(is_array($forms['0'])) { foreach($forms['0'] as $k => $form) { ?>
    <?php $placeholder = empty($form['description']) ? $form['title'] : $form['description'];?>
    <?php  if($form['essential']==1) { ?>
    	<?php  $placeholder .= ' (必填)';?>
        <?php  if(!empty($form['fieldstype'])) { ?>
            <input name="must" type="hidden" value="" title="<?php  echo $form['title'];?>" data-type="<?php  echo $form['fieldstype'];?>"/>
        <?php  } else { ?>
            <input name="must" type="hidden" value="<?php  echo $key;?>" title="<?php  echo $form['title'];?>" data-type="<?php  echo $form['displaytype'];?>"/>
        <?php  } ?>
    <?php  } ?>
    
    <?php  if(!empty($form['fieldstype'])) { ?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('order/form_fields', TEMPLATE_INCLUDEPATH)) : (include fx_template('order/form_fields', TEMPLATE_INCLUDEPATH));?>
    <?php  } else { ?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('order/form_diy', TEMPLATE_INCLUDEPATH)) : (include fx_template('order/form_diy', TEMPLATE_INCLUDEPATH));?>
        <?php  $key++;?>
    <?php  } ?>
    
    <?php  } } ?>
    <p></p>
</div>
<?php  } ?>