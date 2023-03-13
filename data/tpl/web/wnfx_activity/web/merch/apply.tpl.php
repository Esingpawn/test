<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary"><?php  echo $applytitle;?>提现申请</span>
</div>
<div class="page-content">
    <form action="" method="get" class="form-horizontal table-search" role="form">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="<?php echo IN_MODULE;?>" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="merch.apply.status<?php  echo $status;?>" />
        <div class="page-toolbar m-b-sm m-t-sm">
            <div class="col-sm-6">
                <div class='input-group input-group-sm'   >
                   <div class="input-group-select">
                       <select name='timetype'   class='form-control  input-sm select-md' >
                           <option value=''>不按时间</option>
                           <?php  if($status>=1) { ?><option value='createtime' <?php  if($_GPC['timetype']=='createtime') { ?>selected<?php  } ?>>申请时间</option><?php  } ?>
                           <?php  if($status>=2) { ?><option value='checktime' <?php  if($_GPC['timetype']=='checktime') { ?>selected<?php  } ?>>审核时间</option><?php  } ?>
                           <?php  if($status>=3) { ?><option value='paytime' <?php  if($_GPC['timetype']=='paytime') { ?>selected<?php  } ?>>打款时间</option><?php  } ?>
                       </select>
                   </div>
                   <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i'),'endtime'=>date('Y-m-d H:i')), true);?>
                </div>
            </div>

            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <?php  if(!MERCHANTID) { ?>
                    <div class="input-group-select">
                        <select name='searchfield'  class='form-control  input-sm select-md'   style="width:110px;"  >
                            <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>商户信息</option>
                            <option value='applyno' <?php  if($_GPC['searchfield']=='applyno') { ?>selected<?php  } ?>>提现单号</option>
                        </select>
                    </div>
                    <?php  } ?>
                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="<?php  if(!MERCHANTID) { ?>请输入关键词<?php  } else { ?>请输入申请单号<?php  } ?>"/>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"> 搜索</button>
                    </span>
                </div>

            </div>
        </div>
    </form>

    <?php  $col=6?>
    <?php  if(count($list)>0) { ?>
    <table class="table table-hover table-responsive">
        <thead class="navbar-inner">
        <tr>
            <!--<th style="width:25px;"><input type='checkbox' /></th>-->
            <th style="width:200px;">提现单号</th>
            <th>商户信息</th>
            <th style="width:100px;">申请金额<br>抽成后金额</th>
            
            <?php  if($status == 3) { ?>
            <?php  $col++?>
            <th>实际打款金额</th>
            <?php  } ?>
            <th style="width:80px;">抽成比例</th>
            <!--<th>申请订单个数<?php  if($status > 1) { ?><br>通过申请订单个数<?php  } ?></th>-->
            <th>提现方式</th>
            <th>申请时间</th>
            <?php  if(!MERCHANTID) { ?>
            <?php  $col++?>
            <th>操作</th>
            <?php  } ?>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <!--<td style="position: relative; "><input type='checkbox'   value="<?php  echo $row['id'];?>"/></td>-->
            <td><?php  echo $row['orderno'];?></td>
            <td><?php  echo $row['merchant']['name'];?><br/><?php  echo $row['merchant']['linkman_mobile'];?></td>
            <td><?php  echo $row['money'];?><br><?php  echo $row['get_money'];?></td>
            <?php  if($status == 3) { ?>
            <td><?php  echo $row['get_money'];?></td>
            <?php  } ?>
            <td><?php  echo $row['percent'];?>%</td>
            <td>
                <?php  if($row['type']==1) { ?>
                <i class="icow icow-weixin text-success"></i>微信钱包
                <?php  } else if($row['type']=='2') { ?>
                <label class="label label-info">手动处理</label>
                <?php  } else if($row['applytype']=='3') { ?>
                <i class="icow icow-weixin text-primary"></i>支付宝
                <i class="icow icow-icon text-warning"></i>银行卡
                <?php  } ?>
            </td>
            <td>
                <?php  echo date('Y-m-d',$row['createtime'])?><br/><?php  echo date('H:i',$row['updatetime'])?>
            </td>
            <?php  if(!MERCHANTID) { ?>
            <td style="overflow:visible;">                
                <?php  if($row['status']<3) { ?>
                    <?php  if($row['status']==1) { ?>
                    <a class='btn btn-default btn-sm btn-op btn-operation' data-toggle="ajaxPost" href="<?php  echo web_url('merch/apply/merchpay', array( 'id'=>$row['id'],'type'=>1))?>" data-confirm="通过申请后无法进行修改，确认吗？">确认</a>
                    <?php  } ?>
                    <a class='btn btn-default btn-sm btn-op btn-operation' data-toggle="ajaxPost" href="<?php  echo web_url('merch/apply/merchpay', array( 'id'=>$row['id'],'type'=>2))?>" data-confirm="确认要打款吗？">确认并打款</a>
                    <a class='btn btn-default btn-sm btn-op btn-operation' data-toggle="ajaxPost" href="<?php  echo web_url('merch/apply/merchpay', array( 'id'=>$row['id'],'type'=>3))?>" data-confirm="手动处理 , 系统不进行任何打款操作!<br/>请确认你已通过线下方式为商户打款!!!<br/>是否进行手动处理?">手动处理</a>
                <?php  } else { ?>
                <a class='btn btn-default btn-sm btn-op btn-operation' href="#">已完成</a>
                <?php  } ?>
            </td>
            <?php  } ?>
        </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="<?php  echo $col;?>">
                    <?php  echo $pager;?>
                </td>
            </tr>
        </tfoot>
    </table>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何申请!
        </div>
    </div>
    <?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>