<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
    .popover{
        width:170px;
        font-size:12px;
        line-height: 21px;
        color: #0d0706;
    }
    .popover span{
        color: #b9b9b9;
    }
    .nickname{
        display: inline-block;
        max-width:200px;
        overflow: hidden;
        text-overflow:ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }
	.point{ position:relative}
	.point:after{
		position: absolute;
		content: '';
		width: 4px;
		height: 4px;
		border-radius: 50%;
		top: 4px;
		right:-8px;
		border: 2px solid red;
	}
</style>
<div class="page-header">当前位置：<span class="text-primary">会员列表</span></div>
<div class="page-content">
    <div class="fixed-header">
        <div style="width:25px;"></div>
        <div style="width: 250px;">粉丝</div>
        <div class="flex1">会员组</div>
        <div class="flex1">注册时间</div>
        <div class="flex1"><?php  echo m('member')->getCreditName('credit1')?>/余额</div>
        <div class="flex1">成交</div>
        <div style="width: 125px;text-align: center;">操作</div>
    </div>
    <form action="./index.php" method="get" class="form-horizontal table-search" role="form">
        <input type="hidden" name="c" value="site"/>
        <input type="hidden" name="a" value="entry"/>
        <input type="hidden" name="m" value="<?php echo IN_MODULE;?>"/>
        <input type="hidden" name="do" value="web"/>
        <input type="hidden" name="r" value="member"/>
        <div class="page-toolbar">
            <span class="pull-left" style="padding-right:5px;">
                <?php  echo tpl_form_field_daterange('datelimit', array('start' => $_GPC['datelimit']['start'],'end' => $_GPC['datelimit']['end']), false)?>
            </span>
            <div class="input-group">
                <span class="input-group-select">
                    <select name='followed' class='form-control'>
                        <option value=''>关注</option>
                        <option value='0' <?php  if($_GPC['followed']=='0') { ?>selected<?php  } ?>>未关注</option>
                        <option value='1' <?php  if($_GPC['followed']=='1') { ?>selected<?php  } ?>>已关注</option>
                        <option value='2' <?php  if($_GPC['followed']=='2') { ?>selected<?php  } ?>>取消关注</option>
                    </select>
                </span>
                
                <span class="input-group-select">
                    <select name='groupid' class='form-control'>
                        <option value=''>会员分组</option>
                        <?php  if(is_array($groups)) { foreach($groups as $group) { ?>
                            <option value="<?php  echo $group['groupid'];?>" <?php  if($_GPC['groupid']==$group['groupid']) { ?>selected<?php  } ?>><?php  echo $group['title'];?></option>
                        <?php  } } ?>
                    </select>
                </span>
                <?php  if($_W['plugin']['poster']['config']['commission_enable']) { ?>
                <span class="input-group-select">
                    <select name='iscommission' class='form-control'>
                        <option value=''>是否分销商</option>
                        <option value='0' <?php  if($_GPC['iscommission']=='0') { ?>selected<?php  } ?>>否</option>
                        <option value='1' <?php  if($_GPC['iscommission']=='1') { ?>selected<?php  } ?>>是</option>
                    </select>
                </span>
                <?php  } ?>
                <span class="input-group-select">
                    <select name='isblack' class='form-control'>
                        <option value=''>黑名单</option>
                        <option value='0' <?php  if($_GPC['isblack']=='0') { ?>selected<?php  } ?>>否</option>
                        <option value='1' <?php  if($_GPC['isblack']=='1') { ?>selected<?php  } ?>>是</option>
                    </select>
                </span>

                <input type="text" class="form-control " name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="可搜索昵称/姓名/手机号/ID">
                <span class="input-group-btn">
                    <button class="btn  btn-primary" type="submit"> 搜索</button>
                    <!--button type="submit" name="export" value="1" class="btn btn-success ">导出</button-->
                </span>
            </div>
        </div>
    </form>

    <?php  if(empty($list)) { ?>
        <div class="panel panel-default">
            <div class="panel-body empty-data">未查询到相关数据</div>
        </div>
    <?php  } else { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="page-table-header">
                    <input type="checkbox">
                    <div class="btn-group">
                        <?php  if(perm('member.list.edit')) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo web_url('member/setblack',array('isblack'=>1))?>">
                            <i class="icow icow-heimingdan2"></i>设置黑名单
                        </button>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo web_url('member/setblack',array('isblack'=>0))?>">
                            <i class="icow icow-yongxinyonghu"></i> 取消黑名单
                        </button>
                        <?php  } ?>
                        <?php  if(1!=1) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo web_url('member/delete')?>">
                            <i class="icow icow-shanchu1"></i> 批量删除
                        </button>
                        <?php  } ?>
                        <!--button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-group'> <i class="icow icow-fenzuqunfa"></i>修改分组</button-->
                    </div>
                </div>
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th style="width:25px;"></th>
                        <th style="width:250px;">粉丝</th>
                        <th>会员组</th>
                        <th>注册时间</th>
                        <th><?php  echo m('member')->getCreditName('credit1')?>/余额</th>
                        <th style="width:100px;" data-toggle="tooltip" data-placement="top" data-original-title="只包含完成的订单"><span class="point">消费</span></th>
                        <th style="width: 125px;text-align: center;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <tr>
                            <td style="position: relative; ">
                                <input type='checkbox' value="<?php  echo $row['uid'];?>" class="checkone"/></td>
                            <td style="overflow: visible">
                                <div rel="pop" style="display:flex"  data-content="<span>ID: </span><?php  echo $row['uid'];?> </br>
                                <span>推荐人：</span>
                                <?php  if(empty($row['parent_id'])) { ?>
                                    <?php  if($row['isagent']) { ?>
                                          总店
                                    <?php  } else { ?>
                                         暂无
                                    <?php  } ?>
                                <?php  } else { ?>
                                    <?php  if(!empty($row['agent']['avatar'])) { ?>
                                        <img src='<?php  echo $row['agent']['avatar'];?>' style='width:20px;height:20px;padding1px;border:1px solid #ccc' />
                                    <?php  } ?>
                                	[<?php  echo $row['parent_id'];?>]<?php  if(empty($row['agent']['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['agent']['nickname'];?><?php  } ?>
                                <?php  } ?>
                                <br/>
                                <span>真实姓名：</span> <?php  if(empty($row['realname'])) { ?>未填写<?php  } else { ?><?php  echo $row['realname'];?><?php  } ?>
                                <br/>
                                <span>手机号：</span><?php  if(!empty($row['mobile'])) { ?><?php  echo $row['mobile'];?><?php  } else { ?>未绑定<?php  } ?> <br/>
                                <span>是否关注：</span>
                                <?php  if(empty($row['follow'])) { ?>
                                    <?php  if(empty($row['unfollowtime'])) { ?>
                                        <i>未关注</>
                                    <?php  } else { ?>
                                        <i>取消关注</i>
                                    <?php  } ?>
                                <?php  } else { ?>
                            		<i>已关注</i>
                        		<?php  } ?> <br/>
                               <span>是否分销商:</span>  <?php  if($row['isagent']==1) { ?>是<?php  } else { ?>否<?php  } ?><br/>
                               <span>状态:</span>  <?php  if($row['isblack']==1) { ?>黑名单<?php  } else { ?>正常<?php  } ?> ">

                                   <img class="img-40" src="<?php  echo tomedia($row['avatar'])?>" style='border-radius:50%;border:1px solid #efefef;' onerror="this.src='<?php echo FX_BASE;?>web/resource_v2/images/noface.png'" />
                                   <span style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;padding-left: 5px">
                                       <span class="nickname">
                                           <?php  if(strexists($row['openid'],'sns_wa')) { ?><i class="icow icow-xiaochengxu" style="color: #7586db;vertical-align: middle;" data-toggle="tooltip" data-placement="top" title="" data-original-title="来源: 小程序"></i><?php  } ?>
                                           <?php  if(strexists($row['openid'],'sns_qq')||strexists($row['openid'],'sns_wx')||strexists($row['openid'],'wap_user')) { ?><i class="icow icow-app" style="color: #44abf7;vertical-align: top;" data-toggle="tooltip" data-placement="bottom" data-original-title="来源: 全网通(<?php  if(strexists($row['openid'],'wap_user')) { ?>手机号注册<?php  } else { ?>APP<?php  } ?>)"></i><?php  } ?>

                                           <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>
                                       </span>
                                       <?php  if($row['isblack']) { ?>
                                            <span class="text-danger">黑名单<i class="icow icow-heimingdan1"style="color: #db2228;margin-left: 2px;font-size: 13px;"></i></span>
                                       <?php  } ?>
                                   </span>

                                </div>
                            </td>

                            <td>
                                <?php  if(empty($row['group']['title'])) { ?>普通会员<?php  } else { ?><?php  echo $row['group']['title'];?><?php  } ?>
                            </td>

                            <td><?php  echo date("Y-m-d",$row['createtime'])?><br/><?php  echo date("H:i:s",$row['createtime'])?></td>
                            <td><span ><?php  echo m('member')->getCreditName('credit1')?>:  <span style="color: #5097d3"><?php  echo intval($row['credit1'])?></span> </span>
                                <br/><span>余额: <span class="text-warning"><?php  echo number_format($row['credit2'],2)?> </span></span></td>

                            <td><span>订单: <?php  echo $row['ordercount'];?></span>
                                <br/><span> 金额: <span class="text-warning"><?php  echo floatval($row['ordermoney'])?></span></span></td>
                            <td style="overflow:visible;text-align: center;">

                                <div class="btn-group">
                                <?php  if(perm('member.list.edit')) { ?>
                                <a class="btn  btn-op btn-operation" href="<?php  echo web_url('member/detail',array('id' => $row['uid']));?>" title="">
                                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="会员详情">
                                        <i class='icow icow-bianji2'></i>
                                    </span>
                                </a>
                                <?php  } ?>
                                
                                <?php  if(perm('order.list')) { ?>
                                <a class="btn  btn-op btn-operation" href="<?php  echo web_url('records', array('searchfield'=>'mid','keyword'=>$row['uid']))?>" title=''>
                                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="会员订单">
                                        <i class='icow icow-dingdan2'></i>
                                    </span>
                                </a>
                                <?php  } ?>
                                <?php  if(perm('finance.recharge.credit1')) { ?>
                                <a class="btn  btn-op btn-operation" data-toggle="ajaxModal" href="<?php  echo web_url('finance/recharge', array('type'=>'credit1','id'=>$row['uid']))?>" title=''>
                                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="充值">
                                       <i class='icow icow-31'></i>
                                    </span>
                                </a>
                                <?php  } ?>
                                </div>
                            </td>
                        </tr>
                        <?php  } } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td colspan="2">
                            <div class="btn-group">
                                <?php  if(perm('member.list.edit')) { ?>
                                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo web_url('member/setblack',array('isblack'=>1))?>">
                                    <i class="icow icow-heimingdan2"></i>设置黑名单
                                </button>
                                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo web_url('member/setblack',array('isblack'=>0))?>">
                                    <i class="icow icow-yongxinyonghu"></i> 取消黑名单
                                </button>
                                <?php  } ?>
                                <?php  if(1!=1) { ?>
                                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo web_url('member/delete')?>">
                                    <i class="icow icow-shanchu1"></i> 批量删除
                                </button>
                                <?php  } ?>
                                <!--button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-group'> <i class="icow icow-fenzuqunfa"></i>修改分组</button-->
                            </div>
                        </td>
                        <td colspan="4" style="text-align:right">
                            <?php  echo $pager;?>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php  } ?>
</div>


<script language="javascript">
    <?php  if($_W['plugin']['poster']['config']['commission_enable']) { ?>
    require(['bootstrap'], function () {
        $("[rel=pop]").popover({
            trigger: 'manual',
            placement: 'right',
            title: $(this).data('title'),
            html: 'true',
            content: $(this).data('content'),
            animation: false
        }).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(this).siblings(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide")
                }
            }, 100);
        });
    });
    <?php  } ?>

    $("[data-toggle='batch-group'], [data-toggle='batch-level']").click(function () {
        var toggle = $(this).data('toggle');
        $("#modal-change .modal-title").text(toggle=='batch-group'?"批量修改标签组":"批量修改会员等级");
        $("#modal-change").find("."+toggle).show().siblings().hide();
        $("#modal-change-btn").attr('data-toggle', toggle=='batch-group'?'group':'level');
        $("#modal-change").modal();
    });
    $("#modal-change-btn").click(function () {
        var _this = $(this);
        if(_this.attr('stop')){
            return;
        }
        var toggle = $(this).data('toggle');
        var ids = [];
        $(".checkone").each(function () {
            var checked = $(this).is(":checked");
            var id = $(this).val();
            if(checked && id){
                ids.push(id);
            }
        });
        if(ids.length<1){
            tip.msgbox.suc("请选择要批量操作的会员");
            return;
        }
        var option = $("#modal-change .batch-"+toggle+" option:selected");
        level = '';
        if (toggle=='group'){
            for(i=0;i<option.length;i++){
                if (level == ''){
                    level += $(option[i]).val();
                }else{
                    level += ','+$(option[i]).val();
                }
            }
        }else{
            var level = option.val();
        }

        var levelname = option.text();
        tip.confirm("确定要将选中会员移动到 "+levelname+" 吗？", function () {
            _this.attr('stop', 1).text("操作中...");
            $.post(biz.url('member/list/changelevel'),{
                level: level,
                ids: ids,
                toggle: toggle
            }, function (ret) {
                $("#modal-change").modal('hide');
                if(ret.status==1){
                    tip.msgbox.suc("操作成功");
                    setTimeout(function () {
                        location.reload();
                    },1000);
                }else{
                    tip.msgbox.err(ret.result.message);
                }
            }, 'json')
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>