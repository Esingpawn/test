<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">座位管理</span>
</div>
<div class="page-content">
	<form action="" method="get" class="form-horizontal form-search" role="form">
        <input type="hidden" name="c" value="site">
        <input type="hidden" name="a" value="entry">
        <input type="hidden" name="m" value="<?php echo IN_MODULE;?>">
        <input type="hidden" name="do" value="web">
        <input type="hidden" name="r" value="seat">
        <div class="page-toolbar">
            <div class="pull-left">
                <a class="btn btn-primary btn-sm" href="<?php  echo web_url('seat/edit')?>"><i class="fa fa-plus"></i> 添加座位</a>
            </div>
            <div class="pull-right col-sm-6">
                <div class="input-group">                    
                    <input type="text" class="form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="输入场地名称">
                    <span class="input-group-btn"><button class="btn btn-primary" type="submit">搜索</button></span>
                </div>
            </div>
        </div>
    </form>
    <?php  if(count($list)>0) { ?>
	<form action="" method="post">    	
		<div class="page-table-header">
            <input type="checkbox">
            <div class="btn-group">
                <?php  if(perm('seat.delete')) { ?>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo web_url('seat/delete')?>">
                    <i class='icow icow-shanchu1'></i> 删除
                </button>
                <?php  } ?>
            </div>
        </div>
		<table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th style="width:25px;"></th>
                    <?php  if(!MERCHANTID) { ?><th style="width:160px;">所属商户</th><?php  } ?>
                    <th style="">场地名称</th>
                    <th style="">规格</th>
                    <th style="width: 125px;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>                    
                    <td><input type='checkbox'   value="<?php  echo $row['id'];?>"/></td>
                    <?php  if(!MERCHANTID) { ?><td><?php  if($row['merchname']) { ?><?php  echo $row['merchname'];?><?php  } else { ?><span class="label label-success">官方平台</span><?php  } ?></td><?php  } ?>
                    <td><?php  echo $row['name'];?></td>                    
                    <td><span><span style="color: #5097d3"><?php  echo $row['rows'];?></span> 排</span> × <span><span class="text-warning"><?php  echo $row['columns'];?></span> 列</span></td>
                    <td>
                        <a class='btn btn-default btn-sm btn-op btn-operation' href="<?php  echo web_url('seat/edit', array('id' => $row['id']))?>">
                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="编辑">
                            	<i class="icow icow-bianji2"></i>
                            </span>
                        </a>
                        <?php  if(perm('seat.delete')) { ?>
                        <a class='btn btn-default  btn-sm btn-op btn-operation' data-toggle="ajaxRemove"  href="<?php  echo web_url('seat/delete', array('id' => $row['id']))?>" data-confirm="确认删除此门店吗？">
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
                    <td colspan="<?php  if(MERCHANTID) { ?>1<?php  } else { ?>2<?php  } ?>">
                        <div class="btn-group">
                            <?php  if(perm('seat.delete')) { ?>
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo web_url('seat/delete')?>">
                                <i class='icow icow-shanchu1'></i> 删除
                            </button>
                            <?php  } ?>
                        </div>
                    </td>
                    <td colspan="2" class="text-right"> <?php  echo $pager;?></td>
                </tr>
            </tfoot>
        </table>
	</form>
    <?php  } else { ?>
    <div class="panel panel-default">
        <div class="panel-body empty-data">暂时没有任何信息!</div>
    </div>
    <?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>