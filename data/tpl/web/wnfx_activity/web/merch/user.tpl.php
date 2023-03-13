<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">商户管理</span>
</div>
<div class="page-content">
	<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
        <input type="hidden" name="c" value="site">
        <input type="hidden" name="a" value="entry">
        <input type="hidden" name="m" value="<?php echo IN_MODULE;?>">
        <input type="hidden" name="do" value="web">
        <input type="hidden" name="r" value="merch.user">
        <div class="page-toolbar">
            <div class="pull-left">
                <a class="btn btn-primary btn-sm" href="<?php  echo web_url('merch/user/edit')?>"><i class="fa fa-plus"></i> 添加商户</a>
            </div>
            <div class="pull-right col-sm-6">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name="mcert" class="form-control">
                            <option value=""<?php  if($_GPC['mcert']=='') { ?> selected<?php  } ?>>认证状态</option>
                            <option value="1"<?php  if($_GPC['mcert']==1) { ?> selected<?php  } ?>>未认证</option>
                            <option value="2"<?php  if($_GPC['mcert']==2) { ?> selected<?php  } ?>>已认证</option>                            
                            <option value="3"<?php  if($_GPC['mcert']==3) { ?> selected<?php  } ?>>认证待审</option>
                            <option value="4"<?php  if($_GPC['mcert']==4) { ?> selected<?php  } ?>>认证驳回</option>
                            <option value="5"<?php  if($_GPC['mcert']==5) { ?> selected<?php  } ?>>认证到期</option>
                        </select>
                    </div>
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
				<button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php  echo web_url('merch/user/status',array('status'=>1))?>"><i class="icow icow-qiyong"></i> 启用</button>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php  echo web_url('merch/user/status',array('status'=>0))?>"><i class="icow icow-qiyong"></i> 禁用</button>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo web_url('merch/user/delete')?>"><i class="icow icow-shanchu1"></i> 删除</button>
			</div>
		</div>
		<table class="table table-responsive table-hover">
		<thead class="navbar-inner">
		<tr>
			<th style="width:25px"></th>
			<th style="width:250px">商户名称</th>
			<th style="width:100px">总金额</th>
			<th style="width:100px">可结算</th>
            <th style="width:100px">线下付款</th>
            <th style="width:100px">佣金比</th>
            <th style="width:100px" class="text-center">是否认证</th>
            <th style="width:100px" class="text-center">状态</th>
            <th class="text-right">操作</th>
		</tr>
		</thead>
		<tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
		<tr>
			<td>
				<input type="checkbox" value="<?php  echo $row['id'];?>">
			</td>
			<td><?php  echo $row['name'];?></td>
            <td><?php  echo $row['amount'];?>元</td>
			<td><?php  echo $row['no_money'];?>元</td>
            <td><?php  echo $row['delivery'];?>元</td>
            <td><?php  if(!empty($row['percent'])) { ?><?php  echo $row['percent'];?>%<?php  } else { ?>0.00%<?php  } ?></td>
            <td class="text-center">
            	<?php  if(empty($row['mcert'])) { ?>
                    <span>否</span>
                <?php  } else if($row['mcert']['status']==0) { ?>
                    <a class="btn btn-primary btn-xs" data-toggle="ajaxModal"  href="<?php  echo web_url('merch/op/mcert', array('id'=>$row['id']))?>">认证待审</a>
                <?php  } else if($row['mcert']['status']==2) { ?>
                    <a class="btn btn-default btn-xs" data-toggle="ajaxModal"  href="<?php  echo web_url('merch/op/mcert', array('id'=>$row['id']))?>">认证驳回</a>
                <?php  } else { ?>
                    <?php  if(TIMESTAMP > $row['mcert']['endtime']) { ?>
                    	<a class="btn btn-danger btn-xs" data-toggle="ajaxModal"  href="<?php  echo web_url('merch/op/mcert', array('id'=>$row['id']))?>">认证到期</a>
                    <?php  } else { ?>
                        <a class="btn btn-success btn-xs" data-toggle="ajaxModal"  href="<?php  echo web_url('merch/op/mcert', array('id'=>$row['id']))?>">已认证</a>
                    <?php  } ?>
                <?php  } ?>
            </td>            
            <td align="center">
                 <span class='label <?php  if($row['status']==1) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>'
                          data-toggle='ajaxSwitch' 
                          data-switch-value='<?php  echo $row['status'];?>'
                          data-switch-value0='0|禁用|label label-default|<?php  echo web_url('merch/user/status',array('status'=>1,'id'=>$row['id']))?>'
                          data-switch-value1='1|启用|label label-success|<?php  echo web_url('merch/user/status',array('status'=>0,'id'=>$row['id']))?>'>
                          <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
            </td>
			<td class="text-right" style="overflow:visible;">
            	<a class="btn btn-op btn-operation" href="<?php  echo web_url('merch/user/edit', array('id'=>$row['id']))?>">编辑</a>
                <a class="btn btn-op btn-operation" href="<?php  echo web_url('merch/finance/account', array('id'=>$row['id']))?>" target="_blank">结算</a>
                <a class="btn btn-op btn-operation" href="<?php  echo web_url('perm/merch/edit', array('mid'=>$row['id']))?>">权限</a>                
                <a class="btn btn-op btn-operation" data-toggle="ajaxModal"  href="<?php  echo web_url('merch/op/updateData', array('id'=>$row['id']))?>">更新数据</a>                
                <a data-toggle="ajaxRemove" href="<?php  echo web_url('merch/user/delete',array('id'=>$row['id']))?>" class="btn btn-op btn-operation" data-confirm="确认要删除此商户吗?"><span data-toggle="tooltip" data-placement="top" data-original-title="删除"><i class="icow icow-shanchu1"></i></span></a>
			</td>
		</tr>
        <?php  } } ?>
		</tbody>
		<tfoot>
		<tr>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<div class="btn-group">
					<button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php  echo web_url('merch/user/status',array('status'=>1))?>"><i class="icow icow-qiyong"></i> 启用</button>
                    <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php  echo web_url('merch/user/status',array('status'=>0))?>"><i class="icow icow-qiyong"></i> 禁用</button>
                    <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo web_url('merch/user/delete')?>"><i class="icow icow-shanchu1"></i> 删除</button>
				</div>
			</td>
			<td colspan="7" style="text-align:right">
				<?php  echo $pager;?>
			</td>
		</tr>
		</tfoot>
		</table>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>