<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-lg control-label">粉丝</label>
    <div class="col-sm-9 col-xs-12">
        <img class="radius50" src="<?php  echo $member['avatar'];?>" style='width:50px;height:50px;padding:1px;border:1px solid #ccc' onerror="this.src='<?php echo FX_BASE;?>web/resource_v2/images/noface.png'"/>
        <?php  if(strexists($member['openid'],'sns_wa')) { ?><i class="icow icow-xiaochengxu" style="color: #7586db;vertical-align: middle;" data-toggle="tooltip" data-placement="bottom" data-original-title="来源: 小程序"></i><?php  } ?>
        <?php  if(strexists($member['openid'],'sns_qq')||strexists($member['openid'],'sns_wx')||strexists($member['openid'],'wap_user')) { ?><i class="icow icow-app" style="color: #44abf7;vertical-align: middle;" data-toggle="tooltip" data-placement="bottom" data-original-title="来源: 全网通(<?php  if(strexists($member['openid'],'wap_user')) { ?>手机号注册<?php  } else { ?>APP<?php  } ?>)"></i><?php  } ?>
        <?php  echo $member['nickname'];?>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">OPENID</label>
    <div class="col-sm-9 col-xs-12">
        <div class="form-control-static js-clip text-primary" data-url='<?php  echo $member['openid'];?>'><?php  echo $member['openid'];?></div>
</div>
</div>
<div class="form-group">
    <label class="col-lg control-label">会员等级</label>
    <div class="col-sm-9 col-xs-12">
        <?php  if(perm('member.list.edit')) { ?>
        <select name='data[groupid]' class='form-control'>
            <option value=''><?php echo empty($group['title'])?'普通会员':$group['title']?></option>
            <?php  if(is_array($groups)) { foreach($groups as $group) { ?>
            <option value='<?php  echo $group['groupid'];?>' <?php  if($member['groupid']==$group['groupid']) { ?>selected<?php  } ?>><?php  echo $group['title'];?></option>
            <?php  } } ?>
        </select>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php echo empty($group['title'])?'普通会员':$group['title']?>
        </div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-lg control-label">真实姓名</label>
    <div class="col-sm-9 col-xs-12">
        <?php  if(perm('member.list.edit')) { ?>
            <?php  echo tpl_form_field_editor(array('name'=>'data[realname]', 'value'=>$member['realname']))?>
        <?php  } else { ?>
            <div class='form-control-static'><?php  echo $member['realname'];?></div>
        <?php  } ?>
    </div>
</div>

<?php  if(!$openbind) { ?>
<div class="form-group">
    <label class="col-lg control-label">手机号</label>
    <div class="col-sm-9 col-xs-12">
        <?php  if(perm('member.list.edit')) { ?>
            <?php  echo tpl_form_field_editor(array('name'=>'data[mobile]', 'value'=>$member['mobile']))?>
        <?php  } else { ?>
            <div class='form-control-static'><?php  echo $member['mobile'];?></div>
        <?php  } ?>
    </div>
</div>
<?php  } ?>

<div class="form-group">
    <label class="col-lg control-label"><?php  echo m('member')->getCreditName('credit1')?></label>
    <div class="col-sm-3">
        <div class='form-control-static'><?php  echo $member['credit1'];?>
            <?php  if(perm('finance.recharge.credit1')) { ?>
            <a class="text-primary " data-toggle='ajaxModal' href="<?php  echo web_url('finance/recharge', array('type'=>'credit1','id'=>$member['uid']))?>" style="padding-left: 5px;">充值</a>
            <?php  } ?>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-lg control-label">余额</label>
    <div class="col-sm-3">
        <div class='form-control-static'><?php  echo $member['credit2'];?>
            <?php  if(perm('finance.recharge.credit2')) { ?>
                <a class="text-primary " data-toggle='ajaxModal' href="<?php  echo web_url('finance/recharge', array('type'=>'credit2','id'=>$member['uid']))?>" style="padding-left: 5px;">充值</a>
            <?php  } ?>
        </div>
    </div>
</div> <div class="form-group">
    <label class="col-lg control-label">注册时间</label>
    <div class="col-sm-9 col-xs-12">
        <div class='form-control-static'><?php  echo date("Y-m-d H:i:s",$member['createtime'])?></div>
    </div>
</div>


<?php  if(!empty($member['birthyear'])) { ?>
<div class="form-group">
    <label class="col-lg control-label">出生日期</label>
    <div class="col-sm-9 col-xs-12">
        <div class='form-control-static'><?php  echo $member['birthyear'];?>-<?php  echo $member['birthmonth'];?>-<?php  echo $member['birthday'];?></div>
    </div>
</div>
<?php  } ?>

<?php  if(!empty($member['idcard'])) { ?>
<div class="form-group">
    <label class="col-lg control-label">身份证号</label>
    <div class="col-sm-9 col-xs-12">
        <div class='form-control-static'><?php  echo $member['idcard'];?></div>
    </div>
</div>
<?php  } ?>

<div class="form-group">
    <label class="col-lg control-label">关注状态</label>
    <div class="col-sm-9 col-xs-12">
        <div class='form-control-static'>
            <?php  if(!$member['follow']) { ?>
            <?php  if(empty($member['uid'])) { ?>
            <label class='label label-default'>未关注</label>
            <?php  } else { ?>
            <label class='label label-warning'>取消关注</label>
            <?php  } ?>
            <?php  } else { ?>
            <label class='label label-success'>已关注</label>
            <?php  } ?>

        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">黑名单</label>
    <div class="col-sm-9 col-xs-12">
        <?php  if(perm('member.list.edit')) { ?>
        <label class="radio-inline"><input type="radio" name="isblack" value="1" <?php  if($member['isblack']==1) { ?>checked<?php  } ?>>是</label>
        <label class="radio-inline" ><input type="radio" name="isblack" value="0" <?php  if($member['isblack']==0) { ?>checked<?php  } ?>>否</label>
        <span class="help-block">设置黑名单后，此会员无法访问商城</span>
        <?php  } else { ?>
        <input type='hidden' name='isblack' value='<?php  echo $member['isblack'];?>' />
        <div class='form-control-static'><?php  if($member['isblack']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
        <?php  } ?>

    </div>
</div>
<script type="text/javascript">
    $(function () {
        $(".btn-maxcredit").unbind('click').click(function () {
            var val = $(this).val();
            if(val==1){
                $(".maxcreditinput").css({'display':'inline-block'});
            }else{
                $(".maxcreditinput").css({'display':'none'});
            }
        });
    })
</script>