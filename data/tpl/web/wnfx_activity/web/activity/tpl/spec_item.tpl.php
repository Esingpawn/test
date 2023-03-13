<?php defined('IN_IA') or exit('Access Denied');?><div class="spec_item_item" style="margin:0 5px 10px 0;position:relative">
    <input type="hidden" class="form-control spec_item_show" name="spec_item_show_<?php  echo $spec['id'];?>[]" value="<?php  echo $specitem['show'];?>">
    <input type="hidden" class="form-control spec_item_id" name="spec_item_id_<?php  echo $spec['id'];?>[]" value="<?php  echo $specitem['id'];?>">
    <div class="input-group">
        <span class="input-group-addon"><input type="checkbox" <?php  if($specitem['show']==1) { ?>checked<?php  } ?> value="1" onclick="showItem(this)"></span>
        <input type="text" class="form-control spec_item_title valid" name="spec_item_title_<?php  echo $spec['id'];?>[]" value="<?php  echo $specitem['title'];?>" aria-invalid="false">
        <span class="input-group-addon"><a href="javascript:;" onclick="removeSpecItem(this)" title="删除"><i class="fa fa-times"></i></a><a href="javascript:;" class="fa fa-arrows" title="拖动调整显示顺序"></a></span>
    </div>						
</div>