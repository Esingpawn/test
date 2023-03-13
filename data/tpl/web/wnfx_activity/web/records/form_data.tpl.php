<?php defined('IN_IA') or exit('Access Denied');?><?php 
$activity = model_activity::getSingleActivity($row['activityid'], '*');
$forms = model_activity::getNumActivityForm($row['activityid']);
$formdata = model_records::getNumFormData($row['id']);
$formdata_common = Util::getSingelData('*', 'fx_form_data_common', array('rid'=>$row['id']));
$formdata_common = empty($formdata_common)?m('member')->getMember($row['openid']):$formdata_common;
$sysform  = $activity['form'];
?>
<ul style="width:100%">
	<?php  if(!empty($sysform)) { ?>
        <?php  if(is_array($sysform)) { foreach($sysform as $k => $v) { ?>
            <?php  if($v['show']=='' || $v['show']) { ?>
                <li><div><span class="title"><?php  echo $v['title'];?>：</span><span class="text">
                <?php  echo $formdata_common[$k];?></span></div></li>
            <?php  } ?>
        <?php  } } ?>
    <?php  } ?>
    <?php  if(is_array($forms['0'])) { foreach($forms['0'] as $form) { ?>
    <?php  if($form['fieldstype']!='') { ?>
    	<li><div><span class="title"><?php  echo $form['title'];?>：</span><span class="text">
        <?php  if($form['fieldstype']=='gender') { ?>
            <?php echo $formdata_common['gender']==0 ? '保密' :( $formdata_common['gender']==1?'男':'女')?>
        <?php  } else if($form['fieldstype']=='age') { ?>
            <?php  echo $formdata_common['age'];?> 岁
        <?php  } else if($form['fieldstype']=='birthyear') { ?>
             <?php  echo $formdata_common['birthyear'].'年'.$formdata_common['birthmonth'].'月'.$formdata_common['birthday'].'日'?>
        <?php  } else if($form['fieldstype']=='resideprovince') { ?>
            <?php  echo $formdata_common['resideprovince'];?><?php  echo $formdata_common['residecity'];?><?php  echo $formdata_common['residedist'];?> 
        <?php  } else { ?>
        	<?php  echo $formdata_common[$form['fieldstype']];?>
        <?php  } ?></span></div></li>
    <?php  } ?>
    <?php  } } ?>
    <?php  if(is_array($formdata)) { foreach($formdata as $k => $data) { ?>
    <?php  $form = model_activity::getSingleActivityForm($data['formid']);?>
    <?php  if(!empty($form)) { ?>
    	<li><div><span class="title"><?php  echo $form['title'];?>：</span><span class="text">
        <?php  if(($form['displaytype']==5 || $form['displaytype']==6) && $data['data']!='') { ?>
            <?php  $pics = explode(',',$data['data']);?>
            <?php  if(is_array($pics)) { foreach($pics as $v) { ?>
            <a href="<?php  echo tomedia($v)?>" target="_blank"><img src="<?php  echo tomedia($v);?>" height="65" style="margin:0 5px 5px 0;"></a>
            <?php  } } ?>
        <?php  } else if($form['displaytype']==7) { ?>
        	<?php  echo str_replace(',','-',$data['data'])?>
        <?php  } else if($form['displaytype']==12) { ?>
            <?php  if(!empty($data['data'])) { ?><a class="btn btn-primary btn-xs" href="<?php  echo tomedia($data['data'])?>" target="_blank">播放</a><?php  } ?>
        <?php  } else { ?>
        	<?php  echo str_replace(',',' ',$data['data'])?>
        <?php  } ?></span></div></li>
    <?php  } ?>
    <?php  } } ?>
    <li>
        <span class="title">规格：</span>
        <span class="text"><?php  echo $row['optionname'];?></span>
    </li>
    <li>
        <span class="title">留言：</span>
        <span class="text"><?php  echo $row['msg'];?></span>
    </li>
</ul>