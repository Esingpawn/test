<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">门店管理</span>
</div>
<div class="page-content">
	<form action="" method="get" class="form-horizontal form-search" role="form">
        <input type="hidden" name="c" value="site">
        <input type="hidden" name="a" value="entry">
        <input type="hidden" name="m" value="<?php echo IN_MODULE;?>">
        <input type="hidden" name="do" value="web">
        <input type="hidden" name="r" value="store">
        <div class="page-toolbar">
            <div class="pull-left">
                <a class="btn btn-primary btn-sm" href="<?php  echo web_url('store/edit')?>"><i class="fa fa-plus"></i> 添加门店</a>
            </div>
            <div class="pull-right col-sm-6">
                <div class="input-group">                    
                    <input type="text" class="form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词">
                    <span class="input-group-btn"><button class="btn btn-primary" type="submit">搜索</button></span>
                </div>
            </div>
        </div>
    </form>
	<form action="" method="post">
		<div class="page-table-header">
            <input type="checkbox">
            <div class="btn-group">
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo web_url('store/status',array('status'=>1))?>">
                    <i class='icow icow-qiyong'></i> 启用
                </button>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php  echo web_url('store/status',array('status'=>0))?>">
                    <i class='icow icow-jinyong'></i> 禁用
                </button>
                <?php  if(perm('store.delete')) { ?>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo web_url('store/delete')?>">
                    <i class='icow icow-shanchu1'></i> 删除
                </button>
                <?php  } ?>
            </div>
        </div>
		<table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th style="width:25px;"></th>
                    <th style="width:160px;">所属商家</th>
                    <th style=''>门店名称</th>
                    <th style="width:300px;">电话/地址</th>
                    <th style="width:80px;">核销员</th>
                    <th style="width:60px;">状态</th>
                    <th style="width: 125px;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>                    
                    <td><input type='checkbox'   value="<?php  echo $row['id'];?>"/></td>
                    <td><?php  if($row['merchname']) { ?><?php  echo $row['merchname'];?><?php  } else { ?><span class="label label-success">官方平台</span><?php  } ?></td>
                    <td><?php  echo $row['storename'];?></td>                    
                    <td><p><?php  echo $row['tel'];?></p><?php  echo $row['address'];?></td>
                    <td><?php  echo $row['salercount'];?></td>
                    <td>
                         <span class='label <?php  if($row['status']==1) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>'
                                  data-toggle='ajaxSwitch' 
                                  data-switch-value='<?php  echo $row['status'];?>'
                                  data-switch-value0='0|禁用|label label-default|<?php  echo web_url('store/status',array('status'=>1,'id'=>$row['id']))?>'
                                  data-switch-value1='1|启用|label label-success|<?php  echo web_url('store/status',array('status'=>0,'id'=>$row['id']))?>'>
                                  <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
                    </td>
                    <td>
                        <a class='btn btn-default btn-sm btn-op btn-operation' href="<?php  echo web_url('store/edit', array('id' => $row['id']))?>">
                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="编辑">
                            	<i class="icow icow-bianji2"></i>
                            </span>
                        </a>
                        <?php  if(perm('store.delete')) { ?>
                        <a class='btn btn-default  btn-sm btn-op btn-operation' data-toggle="ajaxRemove"  href="<?php  echo web_url('store/delete', array('id' => $row['id']))?>" data-confirm="确认删除此门店吗？">
                        	<span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                            	<i class='icow icow-shanchu1'></i>
                        	</span>
                        </a>
                        <?php  } ?>
                    </td>

                </tr>
                <?php  } } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><input type="checkbox"></td>
                    <td colspan="2">
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo web_url('store/status',array('status'=>1))?>">
                                <i class='icow icow-qiyong'></i> 启用
                            </button>
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php  echo web_url('store/status',array('status'=>0))?>">
                                <i class='icow icow-jinyong'></i> 禁用
                            </button>
                            <?php  if(perm('store.delete')) { ?>
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo web_url('store/delete')?>">
                                <i class='icow icow-shanchu1'></i> 删除
                            </button>
                            <?php  } ?>
                        </div>
                    </td>
                    <td colspan="4" class="text-right"> <?php  echo $pager;?></td>
                </tr>
            </tfoot>
        </table>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>