<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
tbody tr td{position:relative}
tbody tr .icow-weibiaoti--{visibility:hidden;display:inline-block;color:#fff;height:18px;width:18px;background:#e0e0e0;text-align:center;line-height:18px;vertical-align:middle}
tbody tr:hover .icow-weibiaoti--{visibility:visible}
tbody tr .icow-weibiaoti--.hidden{visibility:hidden!important}
.full .icow-weibiaoti--{margin-left:10px}
.full>span{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;vertical-align:middle;align-items:center}
tbody tr .label{margin:5px 0}
.activity_attribute a{cursor:pointer}
.newactivityflag{width:22px;height:16px;background-color:red;color:#fff;text-align:center;position:absolute;bottom:70px;left:57px;font-size:12px}
.catetag{overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2}
</style>
<div class="page-header">
	当前位置： <span class="text-primary">活动管理</span>
</div>
<div class="page-content">
	<div class="fixed-header">
		<div style="width:25px"></div>
		<div style="width:80px;text-align:center">排序</div>
		<div style="width:80px">活动</div>
		<div class="flex1">&nbsp;</div>
		<div style="width:100px">已收款</div>
		<div style="width:80px">库存</div>
		<div style="width:80px">报名</div>
		<div style="width:80px">实际报名</div>
		<?php  if($type!='cycle') { ?>
		<div style="width:80px;text-align:center">状态</div>
		<?php  } ?>
		<div style="width:120px">属性</div>
		<div style="width:<?php  if($type!='verify') { ?>185<?php  } else { ?>120<?php  } ?>px">操作</div>
	</div>
	<form action="" method="get" class="form-horizontal form-search" role="form">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="<?php echo IN_MODULE;?>" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r"  value="activity" />
        <input type="hidden" name="type"  value="<?php  echo $type;?>" />
        <div class="page-toolbar">
            <?php  if(perm('goods.add')) { ?>
            <span class="pull-left" style="margin-right:30px;">
                <a class='btn btn-sm btn-primary' href="<?php  echo web_url('activity/edit')?>"><i class='fa fa-plus'></i> 添加活动</a>
            </span>
            <?php  } ?>
            <div class="input-group col-sm-5 pull-right">
                <span class="input-group-select" style="display:none">
                    <select name="attribute" class='form-control select2' style="width:150px;" data-placeholder="活动属性">
                        <option value="">活动属性</option>
                        <option value="recommand">推荐</option>
                        <option value="discount">年卡</option>
                        <option value="commission">分销</option>
                    </select>
                </span>
                <span class="input-group-select">
                    <select name="cate" class='form-control select2' style="width:150px;" data-placeholder="活动分类">
                        <option value=""<?php  if(empty($_GPC['cate'])) { ?> selected<?php  } ?>>活动分类</option>
                        <?php  if(is_array($category['0'])) { foreach($category['0'] as $parent) { ?>
                            <option value="<?php  echo $parent['id'];?>"<?php  if($_GPC['cate']==$parent['id']) { ?> selected<?php  } ?>><?php  echo $parent['name'];?></option>
                            <?php  if(is_array($category['1'][$parent['id']])) { foreach($category['1'][$parent['id']] as $child) { ?>
                            <option value="<?php  echo $child['id'];?>"<?php  if($_GPC['cate']==$child['id']) { ?> selected<?php  } ?>><?php  echo $parent['name'];?> - <?php  echo $child['name'];?></option>
                            <?php  } } ?>
                        <?php  } } ?>
                    </select>
                </span>
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $keyword;?>" placeholder="ID/名称/商户名称">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"> 搜索</button>&nbsp;
                    <!--
                        <button type="submit" value="1" name="export" class="btn btn-sm btn-success">导出活动</button>
                    -->
                </span>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="page-table-header">
                <input type="checkbox">
                <div class="btn-group">
                    <?php  if(!in_array($type, array('cycle','verify'))) { ?>
                    <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php echo web_url('activity/property',array('type'=>'show','value'=>($type=='stock'?1:0)))?>" disabled><?php echo $type=='stock'?'<i class="icow icow-shangjia2"></i> 上架':'<i class="icow icow-xiajia3"></i> 下架'?></button>
                    <?php  } ?>
                                        
                    <?php  if($type=='cycle') { ?>
                    <?php  if(perm('goods.delete1')) { ?>
                    <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch-remove' data-confirm="如果商品存在购买记录，会无法关联到商品, 确认要彻底删除吗?" data-href="<?php  echo web_url('activity/delete1')?>">
                        <i class='icow icow-shanchu1'></i> 彻底删除</button>                    
                    <?php  } ?>
                    <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要批量恢复吗?" data-href="<?php  echo web_url('activity/restore')?>">
                        <i class='icow icow-huifu1'></i> 批量恢复</button>
                    <?php  } else { ?>
                    <?php  if(perm('goods.delete')) { ?>
                    <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除吗?" data-href="<?php  echo web_url('activity/delete')?>">
                        <i class='icow icow-shanchu1'></i> 删除</button>
                    <?php  } ?>
                    <?php  } ?>
                    <?php  if(!MERCHANTID) { ?>
                    <?php  if($_GPC['type']=='verify') { ?>
                    <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch-remove' data-confirm="确定要通过审核吗?" data-href="<?php  echo web_url('activity/property',array('type'=>'review','value'=>1))?>">
                        <i class='icow icow-shenhetongguo'></i> 批量通过</button>
                        <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch' data-confirm="确定要拒审吗?" data-href="<?php  echo web_url('activity/property',array('type'=>'review','value'=>2))?>">
                        <i class='icow icow-shenhetongguo'></i> 批量拒审</button>
                    <?php  } ?>
                    <?php  } ?>
                    <!--button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-group" id="batchcatesbut" disabled>批量分类</button>-->
                </div>
            </div>
            <table class="table table-responsive">
            <thead class="navbar-inner">
            <tr>
                <th style="width:25px"></th>
                <th style="width:80px;text-align:center">排序</th>
                <th style="width:80px">活动</th>
                <th>&nbsp;</th>
                <th style="width:100px">已收款</th>
                <th style="width:80px">库存</th>
                <th style="width:80px">报名</th>
                <th style="width:80px" data-toggle="tooltip" data-placement="top" title="" data-original-title="不包含已申请退款、取消的订单">实际报名</th>
                <?php  if($type!='cycle') { ?>
                <th style="width:80px;text-align:center">状态</th>
                <?php  } ?>
                <th style="width:120px">属性</th>
                <th style="width:<?php  if($type!='verify') { ?>185<?php  } else { ?>120<?php  } ?>px">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($activity)) { foreach($activity as $item) { ?>
            <tr>
                <td>
                    <input type="checkbox" value="<?php  echo $item['id'];?>">
                </td>
                <td style="text-align:center">
                    <a href="javascript:;" data-toggle="ajaxEdit" data-href="<?php  echo web_url('activity/change.displayorder',array('id'=>$item['id']))?>"><?php  echo $item['displayorder'];?></a><i class="icow icow-weibiaoti--" data-toggle="ajaxEdit2"></i>
                </td>
                <td>
                    <a href="<?php  echo web_url('activity/edit',array('id'=>$item['id']))?>"><img src="<?php  echo $item['thumb'];?>" style="width:72px;height:72px;padding:1px;border:1px solid #efefef;margin:7px 0" onerror="this.src='<?php echo FX_BASE;?>web/resource_v2/images/nopic.png'"></a>
                </td>
                <td class="full">
                    <span>
                        <span style="display:block;width:100%">
                            <a href="javascript:;" data-toggle="ajaxEdit" data-edit="textarea" data-href="<?php  echo web_url('activity/change/title',array('id'=>$item['id']))?>" style="overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical"><?php  echo str_replace('请编辑！','<font color="#FF0000"><i>请编辑！</i></font>',$item['title'])?> </a>
                            <span class="catetag"><span class="text-info"><?php  if(!empty($item['catename'])) { ?>[<?php  echo $item['catename'];?>]<?php  } ?></span></span>
                        </span>
                        <i class="icow icow-weibiaoti--" data-toggle="ajaxEdit2"></i>
                    </span>
                </td>
                <td><?php  if($item['aprice'] >0) { ?>¥ <?php  echo $item['amount'];?><?php  } else { ?>免费<?php  } ?></td>
                <td><?php  if($item['gnum'] == 0) { ?>不限<?php  } else { ?><?php  echo $item['gnum'];?><?php  } ?></td>
                <td><?php  echo $item['sales'];?></td>
                <td><?php  echo $item['buynum'];?></td>
                <?php  if($type!='cycle') { ?>
                <td style="overflow:visible;text-align:center">
                    <span class="label label-<?php  if($item['show']) { ?>primary<?php  } else { ?>default<?php  } ?> pointer-label" 
                    <?php  if(perm('goods.edit')) { ?>
                    data-toggle="ajaxSwitch" 
                    data-confirm="确认<?php echo $item['show']?'下架':'上架'?>？" 
                    data-switch-refresh="true" 
                    data-switch-value="<?php  echo $item['show'];?>" 
                    data-switch-value0="0|下架|label label-default|<?php  echo web_url('activity/property',array('type'=>'show','value'=>1,'id'=>$item['id']))?>" 
                    data-switch-value1="1|上架|label label-success|<?php  echo web_url('activity/property',array('type'=>'show','value'=>0,'id'=>$item['id']))?>"
                    <?php  } ?>>
                    <?php echo $item['show']?'上架':'下架'?></span>
                    <?php  if(!empty($item['merchantid'])) { ?>
                    <br>
                    <span class="label label-<?php  if($item['review']==1) { ?>primary<?php  } else if($item['review']==2) { ?>danger<?php  } else { ?>warning<?php  } ?> pointer-label"
                    <?php  if(perm('goods.edit')) { ?>
                    <?php  if(!MERCHANTID) { ?>
                    data-toggle="ajaxSwitch"
                    data-confirm="确认<?php  if($item['review']==1) { ?>转审核<?php  } else { ?>审核通过<?php  } ?>？"
                    data-switch-refresh="true"
                    data-switch-value="<?php echo $item['review']!=1?0:1?>"
                    data-switch-value0="0|审核中|label label-warning|<?php  echo web_url('activity/property',array('type'=>'review','value'=>1,'id'=>$item['id']))?>"
                    data-switch-value1="1|通过|label label-success|<?php  echo web_url('activity/property',array('type'=>'review','value'=>0,'id'=>$item['id']))?>"
                    <?php  } ?>
                    <?php  } ?>>
                    <?php  if($item['review']==1) { ?>通过<?php  } else if($item['review']==2) { ?>已拒审<?php  } else { ?>审核中<?php  } ?></span>
                    <?php  } ?>
                </td>
                <?php  } ?>
                <td class="activity_attribute">
                	<?php  if(!MERCHANTID) { ?>
                    <a class="text-<?php  if($item['recommend']) { ?>danger<?php  } else { ?>default<?php  } ?>" data-toggle="ajaxSwitch" data-switch-value="<?php  echo $item['recommend'];?>" data-switch-value0="0||text-default|<?php  echo web_url('activity/property',array('type'=>'recommend','value'=>1,'id'=>$item['id']))?>" data-switch-value1="1||text-danger|<?php  echo web_url('activity/change/recommend',array('value'=>0,'id'=>$item['id']))?>">推荐</a>
                    <?php  } ?>
                    <a class="text-<?php  if($item['hasonline']) { ?>danger<?php  } else { ?>default<?php  } ?>" data-toggle="ajaxSwitch" data-switch-value="<?php  echo $item['hasonline'];?>" data-switch-value0="0||text-default|<?php  echo web_url('activity/property',array('type'=>'hasonline','value'=>1,'id'=>$item['id']))?>" data-switch-value1="1||text-danger|<?php  echo web_url('activity/property',array('type'=>'hasonline','value'=>0,'id'=>$item['id']))?>">线上</a>
                </td>
                <td style="overflow:visible;position:relative">
                	<?php  if(perm('goods.edit')) { ?>
                    <a class="btn btn-op btn-operation" href="<?php  echo web_url('activity/edit',array('id'=>$item['id']))?>"><span data-toggle="tooltip" data-placement="top" title="" data-original-title="编辑"><i class="icow icow-bianji2"></i></span></a>
                    <?php  } ?>
                    <?php  if($type=='cycle') { ?>
                    <a class="btn  btn-op btn-operation" data-toggle="ajaxRemove" href="<?php  echo web_url('activity/restore',array('type'=>$type,'id'=>$item['id']))?>" data-confirm="确认要恢复?"><span data-toggle="tooltip" data-placement="top" title="" data-original-title="恢复"><i class="icow icow-huifu1"></i></span></a>
                    <?php  } else { ?>
                        <?php  if($item['review']==1) { ?>
                        <a class="btn btn-op btn-operation" href="<?php  echo web_url('records',array('aid'=>$item['id']))?>" target="_blank"><span data-toggle="tooltip" data-placement="top" title="" data-original-title="报名管理"><i class="icow icow-dingdan"></i></span></a>
                        <?php  if(perm('messages.main')) { ?>
                        <a class="btn btn-op btn-operation" data-toggle="ajaxModal" href="<?php  echo web_url('activity/op/msg',array('id'=>$item['id']))?>"><span data-toggle="tooltip" data-placement="top" title="" data-original-title="通知"><i class="icow icow-info" style="font-weight:bold"></i></span></a>
                        <?php  } ?>
                        <a class="btn btn-op btn-operation" data-toggle="ajaxPost" href="<?php  echo web_url('activity/copyitem',array('id'=>$item['id']))?>" data-confirm="确认复制当前活动?"><span data-toggle="tooltip" data-placement="top" title="" data-original-title="复制一个"><i class="fa fa-copy"></i></span></a>
                        <?php  } ?>
                    <?php  } ?>
                    <?php  if($type=='cycle') { ?>                   
                    <?php  if(perm('goods.delete1')) { ?>
                    <a class='btn btn-op btn-operation' data-toggle='ajaxRemove' href="<?php  echo web_url('activity/delete1', array('id' => $item['id']))?>" data-confirm='如果活动存在报名记录，会无法关联, 确认要彻底删除吗?'>
                        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="彻底删除">
                            <i class='icow icow-shanchu1'></i>
                        </span>
                    </a>
                    <?php  } ?>
                    <?php  } else { ?>
                    <?php  if(perm('goods.delete')) { ?>
                    <a class='btn btn-op btn-operation' data-toggle='ajaxRemove' href="<?php  echo web_url('activity/delete', array('id' => $item['id']))?>" data-confirm='确认要删除吗？'>
                        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                             <i class='icow icow-shanchu1'></i>
                        </span>
                    </a>
                    <?php  } ?>
                    <?php  } ?>
                    <?php  if($_W['account']->typeSign == 'wxapp') { ?>
                    <a href="javascript:;" class="btn btn-op btn-operation js-clip" data-url="/<?php echo IN_MODULE;?>/pages/goods/detail?id=<?php  echo $item['id'];?>"><span data-toggle="tooltip" data-placement="top" data-original-title="复制链接"><i class="icow icow-lianjie2"></i></span></a>
                    <?php  } else { ?>
                        <?php  if(MERCHANTID) { ?>
                        <a href="javascript:;" class="btn btn-op btn-operation js-clip" data-url="<?php  echo app_url('activity/detail',array('id'=>$_GPC['id']))?>"><span data-toggle="tooltip" data-placement="top" data-original-title="复制链接"><i class="icow icow-lianjie2"></i></span></a>
                        <?php  } else { ?>
                        <a class="btn btn-op btn-operation js-clip" data-toggle="ajaxModal" href="<?php  echo web_url('activity/op/entry',array('id'=>$item['id']))?>"><span data-toggle="tooltip" data-placement="top" data-original-title="复制链接"><i class="icow icow-lianjie2" style="font-weight:bold"></i></span></a>
                        <?php  } ?>
                    <?php  } ?>
                    <a href="javascript:down(<?php  echo $item['id'];?>);" class="btn btn-op btn-operation" data-toggle="popover" data-trigger="hover" data-html="true" data-content="<img src='<?php  echo $item['qrcode'];?>' width='130' alt='链接二维码'>" data-placement="auto right" data-original-title="" title=""><i class="icow icow-erweima3"></i></a>
                </td>
            </tr>
            <?php  } } ?>                    
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <input type="checkbox">
                </td>
                <td colspan="3">
                    <div class="btn-group">         
                        <?php  if(perm('goods.edit')) { ?>
                        <?php  if($type=='sale') { ?>
                        <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch'  data-href="<?php  echo web_url('activity/property',array('type'=>'show','value'=>0))?>">
                            <i class='icow icow-xiajia3'></i> 下架</button>
                        <?php  } ?>
                        <?php  if($type=='stock') { ?>
                        <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch' data-href="<?php  echo web_url('activity/property',array('type'=>'show','value'=>1))?>">
                            <i class='icow icow-shangjia2'></i> 上架</button>
                        <?php  } ?>
                        <?php  } ?>
                        <?php  if($type=='cycle') { ?>
                        <?php  if(perm('goods.delete1')) { ?>
                        <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch-remove' data-confirm="如果活动存在报名记录，会无法关联, 确认要彻底删除吗?" data-href="<?php  echo web_url('activity/delete1')?>">
                            <i class='icow icow-shanchu1'></i> 彻底删除</button>
                        <?php  } ?>
                        <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要批量恢复吗?" data-href="<?php  echo web_url('activity/restore')?>">
                        	<i class='icow icow-huifu1'></i> 批量恢复</button>
                        <?php  } else { ?>
                        <?php  if(perm('goods.delete1')) { ?>
                        <button class="btn btn-default btn-sm  btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要彻底删除吗?" data-href="<?php  echo web_url('activity/delete1')?>">
                            <i class='icow icow-shanchu1'></i> 彻底删除</button>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </td>
                <td colspan="<?php  if($type!='cycle') { ?>7<?php  } else { ?>6<?php  } ?>" style="text-align:right">
                    <?php  echo $pager;?>
                </td>
            </tr>
            </tfoot>
            </table>
        </div>
    </div>
</div>

<div id="batchcates" class="modal fade form-horizontal form-validate batchcates" tabindex="-1" role="dialog" aria-hidden="true" enctype="multipart/form-data">
	<div class="modal-dialog" style="position:absolute;">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">选取分类</h4>
			</div>
			<div class="modal-body overflow-auto we7-form" style="height:270px">
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-8 col-xs-12">
						<label class="radio-inline"><input type="radio"  name="iscover" value="0"  checked="checked" /> 保留原有分类</label>
						<label class="radio-inline"><input type="radio"  name="iscover" value="1"  /> 覆盖原有分类</label>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">活动分类</label>
					<div class="col-sm-8 col-xs-12">
							<select id="cates"  name='cates[]' class="form-control select2" style='width:550px;' multiple='' >
							</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary">确认</button>
				<button class="btn btn-default" aria-hidden="true" data-dismiss="modal">取消</button>
			</div>
		</div>
	</div>
</div>
<script>
	//获得分类标签
	// var length = $('#catetag').children().length;
	// if (length >10){
	//     for (var i=2;i<length;i++)
	//     {
	//         $('#catetag').children().eq(i).hide();
	//     }
	//     $('#catetag').append('...等');
	// }
	//显示批量分类
	$('#batchcatesbut').click(function () {
		$('#batchcates').modal('show');
	})

	//关闭批量分类
	$('.modal-header .close').click(function () {
		$('#batchcates').hide();
	})

	// 取消批量分类
	$('.modal-footer .btn.btn-default').click(function () {
		$('#batchcates').hide();
	})


	//确认
	$('.modal-footer .btn.btn-primary').click(function () {
		var selected_checkboxs = $('.table-responsive tbody tr td:first-child [type="checkbox"]:checked');
		var activityids = selected_checkboxs.map(function () {
			return $(this).val()
		}).get();
		var cates=$('#cates').val();
		var iscover=$('input[name="iscover"]:checked').val();
		$.post(biz.url('activity/ajax_batchcates'),{'activityids':activityids,'cates': cates,'iscover':iscover}, function (ret) {
			if (ret.status == 1) {
				$('#batchcates').hide();
				tip.msgbox.suc('修改成功');
				window.location.reload();
				return
			} else {
				tip.msgbox.err('修改失败');
			}
		}, 'json');
	})
	$(document).on("click", '[data-toggle="ajaxEdit2"]', function (e) {
		var _this = $(this)
		$(this).addClass('hidden')
		var obj = $(this).parent().find('a'),
			url = obj.data('href') || obj.attr('href'),
			data = obj.data('set') || {},
			html = $.trim(obj.text()),
			required = obj.data('required') || true,
			edit = obj.data('edit') || 'input';
		var oldval = $.trim($(this).text());
		e.preventDefault();

		submit = function () {
			e.preventDefault();
			var val = $.trim(input.val());
			if (required) {
				if (val == '') {
					tip.msgbox.err(tip.lang.empty);
					return;
				}
			}
			if (val == html) {
				input.remove(), obj.html(val).show();
				//obj.closest('tr').find('.icow').css({visibility:'visible'})
				return;
			}
			if (url) {
				$.post(url, {
					value: val
				}, function (ret) {
					ret = eval("(" + ret + ")");
					if (ret.status == 1) {
						obj.html(val).show();
					} else {
						tip.msgbox.err(ret.result.message, ret.result.url);
					}
					input.remove();
				}).fail(function () {
					input.remove(), tip.msgbox.err(tip.lang.exception);
				});
			} else {
				input.remove();
				obj.html(val).show();
			}
			obj.trigger('valueChange', [val, oldval]);
		},
			obj.hide().html('<i class="fa fa-spinner fa-spin"></i>');
		var input = $('<input type="text" class="form-control input-sm" style="width: 80%;display: inline;" />');
		if (edit == 'textarea') {
			input = $('<textarea type="text" class="form-control" style="resize:none;" rows=3 width="100%" ></textarea>');
		}
		obj.after(input);

		input.val(html).select().blur(function () {
			submit(input);
			_this.removeClass('hidden')

		}).keypress(function (e) {
			if (e.which == 13) {
				submit(input);
				_this.removeClass('hidden')
			}
		});

	})
	function down(id){
		location.href = "<?php  echo web_url('activity/down')?>&id="+id;
	}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>