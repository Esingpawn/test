<?php defined('IN_IA') or exit('Access Denied');?><?php  if($ii==0) { ?>
    <?php  if($sysform['realname']['show']!='0') { ?>
    <div class="mui-input-row">
        <label><?php  echo $sysform['realname']['title'];?></label>
        <input type="text" name="member_<?php  echo $ii;?>[realname]" placeholder="<?php  echo $sysform['realname']['title'];?> (必填)" value="<?php  echo $profile['realname'];?>">
    </div>
    <?php  } ?>
    <?php  if($sysform['mobile']['show']!='0') { ?>
    <div class="mui-input-row mui-help">
        <label><?php  echo $sysform['mobile']['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[mobile]" class="mobile" placeholder="<?php  echo $sysform['mobile']['title'];?> (必填)" pattern="[0-9]*" value="<?php  echo $profile['mobile'];?>"<?php  if(!empty($profile['mobile']) && $_W['_config']['smsswitch']) { ?> onfocus="this.blur()"<?php  } ?>/>
        <?php  if(!empty($profile['mobile']) && $_W['_config']['smsswitch']) { ?>
        <div class="mui-help-info mui-navigate-right mui-text-right js-check-mobile"><span class="mui-badge mui-badge-inverted">点此变更</span></div>
        <?php  } ?>
    </div>
    <?php  } ?>
    <?php  if($_W['_config']['smsswitch']) { ?>
    <div class="mui-input-row mui-help<?php echo $profile['mobile']?'':' active';?>"<?php  if(!empty($profile['mobile'])) { ?> style="display:none"<?php  } ?>>
        <label>验证码</label>
        <input type="number" name="smscode" placeholder="验证码 (必填)" pattern="[0-9]*">
        <div class="mui-help-info mui-text-right" style="padding-right:18px;"><a href="javascript:;" class="send_code" data-key="<?php  echo $ii;?>">获取验证码</a></div>
    </div>
    <?php  } ?>
<?php  } else { ?>
	<?php  if($sysform['realname']['show']!='0') { ?>
    <div class="mui-input-row">
        <label><?php  echo $sysform['realname']['title'];?></label>
        <input type="text" name="member_<?php  echo $ii;?>[realname]" placeholder="<?php  echo $sysform['realname']['title'];?> (必填)" value="">
    </div>
    <?php  } ?>
    <?php  if($sysform['mobile']['show']!='0') { ?>
    <div class="mui-input-row">
        <label><?php  echo $sysform['mobile']['title'];?></label>
        <input type="number" name="member_<?php  echo $ii;?>[mobile]" class="mobile" placeholder="<?php  echo $sysform['mobile']['title'];?> (必填)" pattern="[0-9]*" value="" />
    </div>
    <?php  } ?>
    <?php  if($_W['_config']['smsswitch']) { ?>
    <div class="mui-input-row mui-help active">
        <label>验证码</label>
        <input type="number" name="smscode" placeholder="验证码 (必填)" pattern="[0-9]*">
        <div class="mui-help-info mui-text-right" style="padding-right:18px;"><a href="javascript:;" class="send_code" data-key="<?php  echo $ii;?>">获取验证码</a></div>
    </div>
    <?php  } ?>
<?php  } ?>