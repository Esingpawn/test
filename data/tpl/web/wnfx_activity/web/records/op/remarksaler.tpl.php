<?php defined('IN_IA') or exit('Access Denied');?><form class="form-horizontal form-validate" action="<?php  echo web_url('records/op/remarksaler')?>" method="post" enctype="multipart/form-data">
	<input type='hidden' name='id' value='<?php  echo $id;?>' />
	<div class="modal-dialog">
           <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">备注</h4>
            </div>
            <div class="modal-body">
            	<textarea style="height:150px;" class="form-control" name="remark"  placeholder="商家备注" ><?php  echo $item['remark'];?></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">提交</button>
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
            </div>
        </div>
	</div>
</form>
<!--蜗牛科技-->  