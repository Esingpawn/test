<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.dd-handle { height: 40px; line-height: 30px}
.dd-list { width:860px;}
.dd-handle span {
	font-weight: normal;
}
</style>
<div class="page-header">
    当前位置：<span class="text-primary"><?php  echo $cateTitle;?>活动分类</span>
</div>

<div class="page-content">
    <div class="page-toolbar">
        <span class="pull-left">
        	<button type="button" id="btnExpand" class="btn btn-default" data-action="expand"><i class="fa fa-angle-down"></i> 折叠所有</button>
            <a href="<?php  echo web_url('activity/category/add')?>" class="btn btn-primary"><i class="fa fa-plus"></i> 添加新分类</a>
        </span>
		<div class="input-group"></div>
	</div>

    <form action="" method="post" class="form-validate">
    <div class="dd" id="div_nestable">
        <ol class="dd-list">
            <?php  if(is_array($list)) { foreach($list as $pcate) { ?>
            <li class="dd-item full" data-id="<?php  echo $pcate['id'];?>">
                <div class="dd-handle" >
                    [ID: <?php  echo $pcate['id'];?>] <?php  echo $pcate['name'];?><?php  if(!empty($pcate['redirect'])) { ?> &nbsp;<div class='label label-default'>广告连接</div><?php  } ?>
                    <span class="pull-right">
                        <div class='label <?php  if($pcate['enabled']) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>'
                             data-toggle='ajaxSwitch'
                             data-switch-value='<?php  echo $pcate['enabled'];?>'
                             data-switch-value0='0|隐藏|label label-default|<?php  echo web_url('activity/category/enabled',array('id'=>$pcate['id'],'enabled'=>1))?>'
                             data-switch-value1='1|显示|label label-primary|<?php  echo web_url('activity/category/enabled',array('id'=>$pcate['id'],'enabled'=>0))?>'>
                             <?php echo $pcate['enabled']?'显示':'隐藏'?>
                         </div>
                         <?php  if(empty($pcate['redirect'])) { ?>
                         <a class='btn btn-default btn-sm btn-operation btn-op' href="<?php  echo web_url('activity/category/add',array('parentid'=>$pcate['id']))?>" title='' >
                             <span data-toggle="tooltip" data-placement="top" title="" data-original-title="添加子分类">
                                <i class="icow icow-tianjia"></i>
                             </span>
                         </a>
                         <?php  } ?>
                         <a class='btn btn-default btn-sm btn-operation btn-op' href="<?php  echo web_url('activity/category/edit',array('id'=>$pcate['id']))?>">
                            <span data-toggle="tooltip" data-placement="top"  data-original-title="修改">
                               <i class="icow icow-bianji2"></i>
                            </span>
                         </a>
                         <a class="btn btn-default btn-sm btn-operation btn-op js-clip" href="javascript:;"data-url="<?php echo !empty($pcate['redirect'])?$pcate['redirect']:app_url('activity',array('pid'=>$pcate['id']))?>"><span data-toggle="tooltip" data-placement="top" data-original-title="复制链接"><i class="icow icow-lianjie2"></i></span></a>
                         <a class='btn btn-default btn-sm btn-operation btn-op' data-toggle='ajaxPost' href="<?php  echo web_url('activity/category/delete',array('id'=>$pcate['id']))?>" data-confirm='确认删除此分类吗？'>
                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                                <i class="icow icow-shanchu1"></i>
                            </span>
                         </a>
                    </span>
                </div>
                <?php  if(!empty($children[$pcate['id']])) { ?>
                <ol class="dd-list">
                    <?php  if(is_array($children[$pcate['id']])) { foreach($children[$pcate['id']] as $ccate) { ?>
                    <li class="dd-item full" data-id="<?php  echo $ccate['id'];?>">
                        <div class="dd-handle" style="width:100%;">
                            [ID: <?php  echo $ccate['id'];?>] <?php  echo $ccate['name'];?><?php  if(!empty($ccate['redirect'])) { ?> &nbsp;<div class='label label-default'>广告连接</div><?php  } ?>
                            <span class="pull-right">
                                <div class='label <?php  if($ccate['enabled']) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>'
                                    data-toggle='ajaxSwitch'
                                    data-switch-value='<?php  echo $ccate['enabled'];?>'
                                    data-switch-value0='0|隐藏|label label-default|<?php  echo web_url('activity/category/enabled',array('enabled'=>1,'id'=>$ccate['id']))?>'
                                    data-switch-value1='1|显示|label label-primary|<?php  echo web_url('activity/category/enabled',array('enabled'=>0,'id'=>$ccate['id']))?>'>
                                    <?php echo $ccate['enabled']?'显示':'隐藏'?>
                                </div>
                                <a class='btn btn-default btn-sm btn-operation btn-op' href="<?php  echo web_url('activity/category/edit',array('id'=>$ccate['id']))?>" title="" >
                                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="修改">
                                        <i class="icow icow-bianji2"></i>
                                    </span>
                                </a>
                                <a class="btn btn-default btn-sm btn-operation btn-op js-clip" href="javascript:;" data-url="<?php echo !empty($ccate['redirect'])?$ccate['redirect']:app_url('activity',array('pid'=>$pcate['id'],'cid' => $ccate['id']))?>"><span data-toggle="tooltip" data-placement="top" data-original-title="复制链接"><i class="icow icow-lianjie2"></i></span></a>
                                <a class='btn btn-default btn-sm btn-operation btn-op'  data-toggle='ajaxPost' href="<?php  echo web_url('activity/category/delete',array('id'=>$ccate['id']))?>" data-confirm="确认删除此分类吗？">
                                    <span data-toggle="tooltip" data-placement="top"  data-original-title="删除">
                                        <i class="icow icow-shanchu1"></i>
                                    </span>
                                </a>
                            </span>
                        </div>
                    </li>
                    <?php  } } ?>
                </ol>
                <?php  } ?>    
            </li>        
            <?php  } } ?>              
        </ol>
        <table class='table'>
            <tr>
                <td>
                    <input id="save_category" type="submit" class="btn btn-primary" value="保存">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    <input type="hidden" name="datas" value="" />
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </form>
	<script language='javascript'>
        myrequire(['jquery.nestable'], function () {
    
            $('#btnExpand').click(function () {
                var action = $(this).data('action');
                if (action === 'expand') {
                    $('#div_nestable').nestable('collapseAll');
                    $(this).data('action', 'collapse').html('<i class="fa fa-angle-up"></i> 展开所有');
    
                } else {
                    $('#div_nestable').nestable('expandAll');
                    $(this).data('action', 'expand').html('<i class="fa fa-angle-down"></i> 折叠所有');
                }
            })
            var depth = 2;
            if (depth <= 0) {
                depth = 2;
            }
            $('#div_nestable').nestable({maxDepth: depth});
    
            $('.dd-item').addClass('full');
    
            $(".dd-handle a,.dd-handle div").mousedown(function (e) {
    
                e.stopPropagation();
            });
    
            var $expand = false;
            $('#nestableMenu').on('click', function (e)
            {
                if ($expand) {
                    $expand = false;
                    $('.dd').nestable('expandAll');
                } else {
                    $expand = true;
                    $('.dd').nestable('collapseAll');
                }
            });
    
            $('form').submit(function(){
                var json = window.JSON.stringify($('#div_nestable').nestable("serialize"));
                $(':input[name=datas]').val(json);
                return false;
            });
    
        })
    </script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>