<?php defined('IN_IA') or exit('Access Denied');?><?php  if($ii==0) { ?>
    <div class="mui-input-row<?php  if($form['essential']==1) { ?> js-check-fields<?php  } ?>" data-title="<?php  echo $form['title'];?>" data-type="<?php  echo $form['fieldstype'];?>">
	<?php  if($form['fieldstype']=='age') { ?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[<?php  echo $form['fieldstype'];?>]" value="<?php  echo $profile['age'];?>" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='studentid') { ?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[studentid]" value="<?php  echo $profile['studentid'];?>" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='zipcode') { ?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[zipcode]" value="<?php  echo $profile['zipcode'];?>" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='qq') { ?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[qq]" value="<?php  echo $profile['qq'];?>" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='weight') { ?>
        <?php $placeholder = $form['essential']==1 ? $form['title'] . '：单位kg' . ' (必填)':$form['title'];?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[weight]" value="<?php  echo $profile['weight'];?>" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='height') { ?>
        <?php $placeholder = $form['essential']==1 ? $form['title'] . '：单位cm' . ' (必填)':$form['title'];?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[height]" value="<?php  echo $profile['height'];?>" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='gender') { ?>	
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('gender', $profile['gender'], $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='birthyear') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('birth', array('year' => $profile['birthyear'], 'month' => $profile['birthmonth'], 'day' => $profile['birthday']), $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='resideprovince') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('reside', array('province' => $profile['resideprovince'], 'city' => $profile['residecity'], 'district' => $profile['residedist']), $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='education') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('education', $profile['education'], $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='constellation') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('constellation', $profile['constellation'], $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='zodiac') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('zodiac', $profile['zodiac'], $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='bloodtype') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('bloodtype', $profile['bloodtype'], $placeholder, $ii);?>
    <?php  } else { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_fans_form('member_'.$ii.'['.$form['fieldstype'].']', $profile[$form['fieldstype']], $placeholder);?>
    <?php  } ?>
    </div>
<?php  } else { ?>
    <div class="mui-input-row<?php  if($form['essential']==1) { ?> js-check-fields<?php  } ?>" data-title="<?php  echo $form['title'];?>" data-type="<?php  echo $form['fieldstype'];?>">
    <?php  if($form['fieldstype']=='age') { ?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[<?php  echo $form['fieldstype'];?>]" value="" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='studentid') { ?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[studentid]" value="" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='zipcode') { ?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[zipcode]" value="" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='qq') { ?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[qq]" value="" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='weight') { ?>
        <?php $placeholder = $form['essential']==1 ? $form['title'] . '：单位kg' . ' (必填)':$form['title'];?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[weight]" value="" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='height') { ?>
        <?php $placeholder = $form['essential']==1 ? $form['title'] . '：单位cm' . ' (必填)':$form['title'];?>
        <label><?php  echo $form['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[height]" value="" placeholder="请填写<?php  echo $placeholder;?>" pattern="[0-9]*">
    <?php  } else if($form['fieldstype']=='gender') { ?>	
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('gender', '', $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='birthyear') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('birth', array('year' => '', 'month' => '', 'day' => ''), $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='resideprovince') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('reside', array('province' => '', 'city' => '', 'district' => ''), $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='education') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('education', '', $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='constellation') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('constellation', '', $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='zodiac') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('zodiac', '', $placeholder, $ii);?>
    <?php  } else if($form['fieldstype']=='bloodtype') { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_form_field('bloodtype', '', $placeholder, $ii);?>
    <?php  } else { ?>
        <label><?php  echo $form['title'];?></label>
        <?php  echo tpl_app_fans_form('member_'.$ii.'['.$form['fieldstype'].']', '', $placeholder);?>
    <?php  } ?>
    </div>
<?php  } ?>