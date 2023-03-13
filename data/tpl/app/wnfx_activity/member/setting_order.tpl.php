<?php defined('IN_IA') or exit('Access Denied');?><div id="member_form" class="mui-popover mui-popover-left imgprev">
    <div class="mui-popover-header"><?php  echo $_W['_config']['buytitle'];?>信息<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="member_form"><me class="mui-icon mui-icon-closeempty"></me></a></div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
            	<?php  if(is_array($list)) { foreach($list as $k => $row) { ?>
                <div class="mui-card mui-one mui-card-line">
                    <div class="mui-card-content">
                        <div class="mui-card-content-inner">
                            <p style="font-size:14px;margin-bottom:0;">姓名：<span class="mui-text-gray"><?php  echo $row['realname'];?></span></p>
                            <p style="font-size:14px;margin-bottom:0;">手机：<span class="mui-text-gray"><?php  echo $row['mobile'];?></span></p>
                            <?php  if(is_array($row['forms']['0'])) { foreach($row['forms']['0'] as $form) { ?>
                            <?php  if($form['fieldstype']!='') { ?>
                                <p style="font-size:14px;margin-bottom:0;"><?php  echo $form['title'];?>：<span class="mui-text-gray">
                                <?php  if($form['fieldstype']=='gender') { ?>
                                    <?php echo $row['formdata_common']['gender']==0 ? '保密' :( $row['formdata_common']['gender']==1?'男':'女')?>
                                <?php  } else if($form['fieldstype']=='age') { ?>
                                    <?php  echo $row['formdata_common']['age'];?> 岁
                                <?php  } else if($form['fieldstype']=='birthyear') { ?>
                                     <?php  echo $row['formdata_common']['birthyear'].'年'.$row['formdata_common']['birthmonth'].'月'.$row['formdata_common']['birthday'].'日'?>
                                <?php  } else if($form['fieldstype']=='resideprovince') { ?>
                                    <?php  echo $row['formdata_common']['resideprovince'];?><?php  echo $row['formdata_common']['residecity'];?><?php  echo $row['formdata_common']['residedist'];?>
                                <?php  } else { ?>
                                    <?php  echo $row['formdata_common'][$form['fieldstype']];?>
                                <?php  } ?>
                                </span></p>
                            <?php  } else { ?>
                                <?php  $formdata = model_records::getSingleFormData($id, $form['id']);?>
                                <p style="font-size:14px;margin-bottom:0;"><?php  echo $form['title'];?>：
                                <?php  if($form['displaytype']==5 && $formdata['data']!='') { ?>
                                    <img src="<?php  echo tomedia($formdata['data']);?>" width="20%" style="display:-webkit-box">
                                <?php  } else if($form['displaytype']==6 && $formdata['data']!='') { ?>
                                    <br>
                                    <?php  $pics = explode(',', $formdata['data']);?>
                                    <?php  if(is_array($pics)) { foreach($pics as $v) { ?>
                                    <img src="<?php  echo tomedia($v);?>" width="20%" style="margin:0 5px 5px 0;display:inline-block">
                                    <?php  } } ?>
                                <?php  } else if($form['displaytype']==7) { ?>
                                    <span class="mui-text-gray"><?php  echo str_replace(',', '-', $formdata['data'])?></span>
                                <?php  } else if($form['displaytype']==12) { ?>
                                	<?php  if(!empty($formdata['data'])) { ?><a class="mui-text-primary" href="<?php  echo tomedia($formdata['data'])?>" target="_blank">播放</a><?php  } ?>
                                <?php  } else { ?>
                                    <span class="mui-text-gray"><?php  echo str_replace(',', ' ', $formdata['data'])?></span>
                                <?php  } ?></p>
                            <?php  } ?>
                            <?php  } } ?>
                            <?php  if(!empty($row['remark']) && $row['review']==3) { ?>
                            <p style="font-size:14px;margin-bottom:0;">备注：<span class="mui-text-gray"><?php  echo $row['remark'];?></span></p>
                            <?php  } ?>
                        </div>
                    </div>
                    <?php  if($row['review']==3) { ?>
                    <div class="mui-card-footer">
                        <div class="mui-text-gray">
                            <p class="mui-text-danger" style="margin-bottom:0;">注：请修改重新提交</p>
                        </div>
                        <div style="width:60%;text-align:right">
                        	<a class="mui-btn mui-small mui-btn-yellow" href="<?php  echo app_url('order/edit',array('id'=>$id))?>">编辑</a>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
                <?php  } } ?>
            </div>
        </div>
    </div>
</div>