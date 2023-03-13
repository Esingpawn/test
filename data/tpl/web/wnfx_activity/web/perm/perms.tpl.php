<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
        <label class="col-lg control-label">可用权限</label>
        <div class="col-sm-10 col-xs-12">
            <div id="accordion" class="panel-group">
            <div class='panel panel-default' ><?php  $i=0?>
            <?php  if(is_array($perms['parent'])) { foreach($perms['parent'] as $key => $value) { ?>
                <div class='panel-heading' style='background:#f8f8f8;display:'>
                    <a class="btn btn-link btn-sm pull-right" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php  echo $key;?>" style="display:<?php  if(count($perms['parent'][$key])==1 && count($perms['son'][$key])<1 && count($perms['grandson'][$key])<1) { ?>none<?php  } ?>"><i class='fa fa-angle-down'></i> 展开</a>
                    <label class='checkbox-inline'>
                         <input type='checkbox' id="perm_<?php  echo $key;?>" name='perms[]' value='<?php  echo $key;?>' class='perm-all perms' data-group='<?php  echo $key;?>' 
                         <?php  if(in_array($key,$role_perms) || in_array($key,$user_perms) ) { ?> checked<?php  } ?>
                         <?php  if(in_array($key,$role_perms) && $_W['action']=='perm.user') { ?> disabled<?php  } ?> /> <?php  echo $value['text'];?>
                    </label>
                </div>
                <div id="collapse<?php  echo $key;?>" class="panel-collapse <?php  if($i==0) { ?>in<?php  } else { ?>collapse<?php  } ?>">
                <div class='panel-body perm-group'>
                    <?php  if(count($perms['parent'][$key]) >1) { ?>
                    <span>
                    <?php  if(is_array($perms['parent'][$key])) { foreach($perms['parent'][$key] as $ke => $val) { ?>
                    <?php  if($ke != 'text') { ?>
                         <label class='checkbox-inline'>
                             <input type='checkbox'  name='perms[]'  value='<?php  echo $key;?>.<?php  echo $ke;?>' class='perm-item perms' 
                             data-group='<?php  echo $key;?>' data-parent='text' 
                             <?php  if(in_array($key.".".$ke,$role_perms) || in_array($key.".".$ke,$user_perms)) { ?> checked<?php  } ?>
                             <?php  if(in_array($key.".".$ke,$role_perms) && $_W['action']=='perm.user') { ?> disabled<?php  } ?> />  <?php  echo str_replace("-log", "", $val)?>
                         </label>
                    <?php  } else { ?>
                         <label class='checkbox-inline'>
                             <input type='checkbox'  name='perms[]'  value='<?php  echo $key;?>' class='perm-all-item perms' 
                             data-group='<?php  echo $key;?>' data-parent='text' 
                             <?php  if(in_array($key,$role_perms) || in_array($key,$user_perms)) { ?> checked<?php  } ?>
                             <?php  if(in_array($key,$role_perms) && $_W['action']=='perm.user') { ?> disabled<?php  } ?> />  <b><?php  echo str_replace("-log", "", $val)?></b>
                         </label>
                    <?php  } ?>
                    <?php  } } ?>
                    </span>
                    <br>
                    <?php  } ?>
                    
                    <?php  if(is_array($perms['son'][$key])) { foreach($perms['son'][$key] as $ke => $val) { ?>
                    <?php  if(count($val) >1) { ?>
                    <span>
                        <?php  if(is_array($val)) { foreach($val as $k => $v) { ?>
                        <?php  if($k != 'text') { ?>
                             <label class='checkbox-inline'>
                                 <input type='checkbox'  name='perms[]'  value='<?php  echo $key;?>.<?php  echo $ke;?>.<?php  echo $k;?>' class='perm-item perms' 
                                 data-group='<?php  echo $key;?>' data-parent='<?php  echo $ke;?>' data-son="<?php  echo $k;?>" 
                                 <?php  if(in_array($key.".".$ke.".".$k,$role_perms) || in_array($key.".".$ke.".".$k,$user_perms)) { ?> checked<?php  } ?>
                                 <?php  if(in_array($key.".".$ke.".".$k,$role_perms) && $_W['action']=='perm.user') { ?> disabled<?php  } ?> />  <?php  echo str_replace("-log", "", $v)?>
                             </label>
                        <?php  } else { ?>
                             <label class='checkbox-inline'>
                                 <input type='checkbox'  name='perms[]'  value='<?php  echo $key;?>.<?php  echo $ke;?>' class='perm-all-item perms' 
                                 data-group='<?php  echo $key;?>' data-parent='<?php  echo $ke;?>' data-son="<?php  echo $k;?>" 
                                 <?php  if(in_array($key.".".$ke,$role_perms) || in_array($key.".".$ke,$user_perms)) { ?> checked<?php  } ?>
                                 <?php  if(in_array($key.".".$ke,$role_perms) && $_W['action']=='perm.user') { ?> disabled<?php  } ?> />  <b><?php  echo str_replace("-log", "", $v)?></b>
                             </label>
                        <?php  } ?>
                        <?php  } } ?>
                        </span>
                    <br>
                    <?php  } ?>
                    <?php  } } ?>

                    <?php  if(is_array($perms['grandson'][$key])) { foreach($perms['grandson'][$key] as $ke => $val) { ?>
                    <?php  if(is_array($val)) { foreach($val as $k => $v) { ?>
                    <?php  if(count($v) >1) { ?>
                     <span>
                    <?php  if(is_array($v)) { foreach($v as $kk => $vv) { ?>
                    <?php  if($kk != 'text') { ?>
                             <label class='checkbox-inline'>
                                 <input type='checkbox'  name='perms[]'  value='<?php  echo $key;?>.<?php  echo $ke;?>.<?php  echo $k;?>.<?php  echo $kk;?>' class='perm-item perms' 
                                 data-group='<?php  echo $key;?>' data-parent='<?php  echo $ke;?>' data-son="<?php  echo $k;?>" data-grandson="<?php  echo $kk;?>" 
                                 <?php  if(in_array($key.".".$ke.".".$k.".".$kk,$role_perms) || in_array($key.".".$ke.".".$k.".".$kk,$user_perms)) { ?> checked<?php  } ?>
                                 <?php  if(in_array($key.".".$ke.".".$k.".".$kk,$role_perms) && $_W['action']=='perm.user') { ?> disabled<?php  } ?> />  <?php  echo str_replace("-log", "", $vv)?>
                             </label>
                    <?php  } else { ?>
                             <label class='checkbox-inline'>
                                 <input type='checkbox'  name='perms[]'  value='<?php  echo $key;?>.<?php  echo $ke;?>.<?php  echo $k;?>' class='perm-all-item perms' 
                                 data-group='<?php  echo $key;?>' data-parent='<?php  echo $ke;?>' data-son="<?php  echo $k;?>" data-grandson="<?php  echo $kk;?>" 
                                 <?php  if(in_array($key.".".$ke.".".$k,$role_perms) || in_array($key.".".$ke.".".$k,$user_perms)) { ?> checked<?php  } ?>
                                 <?php  if(in_array($key.".".$ke.".".$k,$role_perms) && $_W['action']=='perm.user') { ?> disabled<?php  } ?> />  <b><?php  echo str_replace("-log", "", $vv)?></b>
                             </label>
                    <?php  } ?>
                    <?php  } } ?>
                     </span>
                    <br>
                    <?php  } ?>
                    <?php  } } ?>
                    <?php  } } ?>
                </div>
         </div>
               <?php  $i++?>
            <?php  } } ?>
            </div>
        </div>
    </div>
    <input type="hidden" name="permsarray" value="">
</div>
<script language="javascript">
    $(function () {
        $('.perm-all').click(function () {
            var checked = $(this).get(0).checked;
            var group = $(this).data('group');
            $(".perm-item[data-group='" + group + "'],.perm-all-item[data-group='" + group + "']").each(function () {
                $(this).get(0).checked = checked;
            })
        })
        $('.perm-all-item').click(function () {
            var checked = $(this).get(0).checked;
            var group = $(this).data('group');
            var parent = $(this).data('parent');
            var son = $(this).data('son');
            var grandson = $(this).data('grandson');
            $(this).parents("span").find(".perm-item").each(function () {
                $(this).get(0).checked = checked;
            });
            group_check(this);

        });
        $('.perm-item').click(function () {
            var group = $(this).data('group');
            var parent = $(this).data('parent');
            var son = $(this).data('son');
            var grandson = $(this).data('grandson');
            var check = false;
            $(this).closest('span').find(".perm-item").each(function () {
                if ($(this).get(0).checked) {
                    check = true;
                    return false;
                }
            });
            var allitem = $(this).parents("span").find(".perm-all-item");
            if (allitem.length == 1) {
                allitem.get(0).checked = check;
            }
            group_check(this);

        });

        $(".panel-body").find("span").each(function (index, item) {
            if ($(this).find("label").length != 1) {
                $($(this).find("label").get(0)).wrap("<div class='col-sm-2' style='white-space:nowrap;'></div>");
                $($(this).find("label").not($(this).find("label").get(0))).wrapAll("<div class='col-sm-10'></div>");
            }
            else {
                $($(this).find("label").get(0)).wrap("<div class='col-sm-12'></div>");
            }
        });
		
		$("form").submit(function () {
            $(this).attr('stop',1);
            var perms = [];
            $(".perms:checked").each(function (index,e) {
                perms[index]=$(this).val();
            });
            perms = perms.join(',')
            $("input[name=permsarray]").val(perms);
            $(this).attr('stop',0);
            return false;
        });

    });

    function group_check(obj) {
        var check = false;
        $(obj).parents('.perm-group').find(":checkbox").each(function (index, item) {
            if (item.checked) {
                check = true;
            }
        });
        var group = $(obj).eq(0).data('group');
        $(".perm-all[data-group=" + group + "]").get(0).checked = check;
    }
</script>