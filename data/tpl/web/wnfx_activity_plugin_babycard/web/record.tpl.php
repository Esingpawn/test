<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=20170826" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/util.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>web/resource/js/util.min.js?v=20170912"></script>
<style>
.label-default{background-color:#d1dade;color:#5e5e5e;}
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline{padding-top:0; line-height:0.95;}
.dropdown-menu{ min-width:145px; }
.multi-img-details .multi-item{height:auto;}
#member.multi-img-details .multi-item{text-align:center; max-width:100px;}
#member.multi-img-details .multi-item img{ max-width:90px; max-height:90px;}
#member.multi-img-details .multi-item .title{ overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
#myTab2.nav-tabs{border-color: #1ab394;}
#myTab2.nav-tabs>li>a{border-radius:0!important;padding: 7px 15px;}
#myTab2.nav-tabs>li>a:hover{ color:#333}
#myTab2.nav-tabs>li.active>a, #myTab2.nav-tabs>li.active>a:hover, #myTab2.nav-tabs>li.active>a:focus{color: #FFF;border-radius:0;background-color: #1ab394;border-color: #1ab394;}
</style>
<?php  if($op == 'display') { ?>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="" method="get" class="form-horizontal" role="form" id="form1">
        	<input type="hidden" name="c" value="site">
            <input type="hidden" name="a" value="entry">
            <input type="hidden" name="m" value="<?php echo MODULE_PLUGIN_NAME;?>">
            <input type="hidden" name="do" value="record">
            <input type="hidden" name="ac" value="record">
            <input type="hidden" name="op" value="display">
            <div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用状态</label>
				<div class="col-sm-8 col-xs-12">
					<div class="btn-group">
						<a href="<?php  echo $this->createWeburl('record', array('status' => '','version_id'=>$_GPC['version_id']))?>" class="btn <?php  if($_GPC['status']=='') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo $this->createWeburl('record', array('status' => 1,'version_id'=>$_GPC['version_id']))?>" class="btn <?php  if($_GPC['status']=='1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已支付</a>
						<a href="<?php  echo $this->createWeburl('record', array('status' => 0,'version_id'=>$_GPC['version_id']))?>" class="btn <?php  if($_GPC['status']=='0') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未支付</a>
					</div>
				</div>
                <div class="col-md-2 pull-right text-right">
                	<a href="<?php  echo $this->createWeburl('record', array('op' => 'post','version_id'=>$_GPC['version_id']))?>" class="btn btn-primary">添加用户</a>
                </div>
			</div>
            <div class="form-group" style="margin-bottom:0px;">
            	<label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名/手机号</label>
                <div class="col-sm-10 col-xs-12">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键字">
                        <div class="input-group-btn">
                            <span class="btn" id="search">搜索</span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
        </form>
    </div>
</div>
<script type="text/javascript">
	$("#search").click(function(){
		$('#form1')[0].submit();
	});
</script>
<form class="form-horizontal" action="" method="post">
<div class="panel panel-default">
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="navbar-inner">
                <tr>
                    <th class="text-center" style="width:40px;">
                        <input type="checkbox" name="checkall" value="" id="checkall" onClick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});">
                    </th>
                    <th class="text-center" style="width:40px;">ID</th>
                    <th class="text-left" style="width:100px;">受益人/关系</th>
                    <th class="text-left">购买人</th>
                    <th class="text-center" style="width:80px;">首次激活</th>
                    <th class="text-center" style="width:80px;">累计支付</th>
                    <th class="text-center" style="width:50px;">状态</th>
                    <th class="text-left" style="width:120px;">激活时间</th>
                    <th class="text-left" style="width:120px;">截至日期</th>
                    <th class="text-center" style="width:130px;">操作</th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
            <?php  if(is_array($record)) { foreach($record as $row) { ?>
                <tr>
                    <td class="text-center"><input type="checkbox" name="check" value="<?php  echo $row['id'];?>" class="items"></td>
                    <td><?php  echo $row['id'];?></td>
                    <td class="text-left"><?php  echo $row['whois'];?><br><span class="label label-info"><?php  echo $row['relation'];?></span></td>
                    <td class="text-left"><?php  echo $row['realname'];?><br><?php  echo $row['mobile'];?></td>
                    <td class="text-center"><?php echo $row['is_first']==1?'<span style="color:#FF0000">√</span>':'<span>×</span>'?></td>
                    <td class="text-center"><span class="small">￥<?php  echo $row['pay_fee'];?></span></td>
                    <td class="text-center"><?php echo $row['status']?'<span class="label label-success">已支付</span>':'<span class="label label-default">未支付</span>'?></td>
                    <td class="text-left"><span class="small"><?php echo $row['createtime']?date('Y-m-d H:i', $row['createtime']):''?></span></td>
                    <td class="text-left"><?php  if($row['end_time']) { ?><span class="label <?php  if(TIMESTAMP > $row['end_time']) { ?>label-danger<?php  } else { ?>label-success<?php  } ?>"><?php  echo date('Y-m-d H:i', $row['end_time'])?><?php  if(TIMESTAMP > $row['end_time']) { ?> 已到期<?php  } ?></span><?php  } ?></td>
                    <td class="text-center">                        
                            <a href="<?php  echo $this->createWeburl('record', array('op'=>'post', 'id'=>$row['id']))?>" class="btn btn-success btn-sm">编辑</a>
                            <a href="javascript:void(0);" class="js-delete btn btn-danger btn-sm" data-id="<?php  echo $row['id'];?>">删除</a>
                        
                    </td>
                </tr>
            <?php  } } ?>
            <thead>
            <tr>
                <td colspan="10">
                <a href="javascript:;" class="btn btn-danger min-width js-batch js-deletes">删除</a>
                </td>
            </tr>
            </thead>
            </tbody>
        </table>
    </div>
	<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
</div>
<div class="pull-right"><?php  echo $pager;?></div>
</form>
<script>
$(function(){
	//批量删除效果b
	$('.js-batch').click(function(e){
		e.stopPropagation();
		var ids = [];
		var $checkboxes = $('.items:checkbox:checked');
		$checkboxes.each(function() {
			if (this.checked) {
				ids.push(this.value);
			};
		});
	
		if (ids.length == 0) {
			util.tips('请选择要操作的信息!', 2000);
			return false;
		}
		var op = '';
		var html = '';
		if ($(this).hasClass('id1')) {
			op = 'on_shelves';
			html = '待定?';
		} else if ($(this).hasClass('id2')) {
			op = 'off_shelves';
			html = '待定?';
		} else if ($(this).hasClass('js-deletes')) {
			op = 'deleteArr';
			html = '确认删除?';
		} else if ($(this).hasClass('js-remove')) {
			op = 'remove';
			html = '确认选中彻底删除?';
		}
		var $this = $(this);
		util.nailConfirm(this, function(state) {
			if(!state) return;
			$.post("<?php  echo $this->createWeburl('record', array('op' => 'delete'))?>", {id : ids}, function(data){
				if(!data.errno){
					$checkboxes.each(function() {
						$(this).parent().parent().remove();
					});
				};
				util.tips(data.message);
			}, 'json');
		}, {html: html,placement: $this.data('placement')});
	});

	//删除效果b，单条操作
	$('.js-delete').click(function(e) {
		e.stopPropagation();
		var $this = $(this);
		var id = $this.data('id');
		util.nailConfirm(this, function(state) {
			if (!state) return;
			$.post("<?php  echo $this->createWeburl('record', array('op' => 'delete'))?>", {id : id}, function(data) {
				if(!data.errno){
					$this.parents('tr').remove();
				}
				util.tips(data.message);
			}, 'json');
		}, {html:"确定删除？",placement: $this.data('placement')});
	});
});
</script>
<?php  } else if($op == 'post') { ?>
<form action="" method="post" onsubmit="return check(this)" class="form-horizontal form" enctype="multipart/form-data">
<div class="panel panel-default">
	<div class="panel-heading">添加用户</div>
    <div class="panel-body">
        <div class="form-group">
        	<label class="control-label col-xs-12 col-sm-2">设置用户</label>
            <div class="col-xs-12 col-sm-9">            	
                <div class='input-group'>
                    <input type="text" name="nickname" maxlength="30" value="<?php  echo $member['nickname'];?>" class="form-control" readonly />
                    <div class='input-group-btn'>
                        <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-member').modal();">选择用户</button>
                    </div>
                </div>
                <div class="input-group multi-img-details" id="member" style="display:none">
                    <div class="multi-item">                    	
                        <input type="hidden" name="record[buyuid]" value="<?php  echo $record['buyuid'];?>">
                        <input type="hidden" name="record[openid]" value="<?php  echo $record['openid'];?>">
                    </div>
                </div>
                <div id="modal-module-member"  class="modal fade" tabindex="-1">
                    <div class="modal-dialog" style='width: 660px;'>
                        <div class="modal-content">
                            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择用户</h3></div>
                            <div class="modal-body" >
                                <div class="row">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="keyword" value="" id="member-kwd" placeholder="请输入粉丝昵称或openid" />
                                        <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_members();">搜索</button></span>
                                    </div>
                                </div>
                                <div id="module-member" style="padding-top:5px;"></div>
                            </div>
                            <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	<label class="control-label col-xs-12 col-sm-2">截至日期</label>
            <div class="col-xs-12 col-sm-9">
                <?php  echo tpl_form_field_daterange('time', array('start' => $record['createtime'],'end' => $record['end_time']), true);?>
            </div>
        </div>
        <div class="form-group">
        	<label class="control-label col-xs-12 col-sm-2">支付状态</label>
            <div class="col-xs-12 col-sm-9">
                <label class="radio radio-inline">
                    <input type="radio" name="record[status]" value="1"<?php  if($record['status']=='' || $record['status']) { ?> checked<?php  } ?>> 已支付
                </label>
                <label class="radio radio-inline">
                    <input type="radio" name="record[status]" value="0"<?php  if($record['status']=='0') { ?> checked<?php  } ?>> 未支付
                </label>
            </div>
        </div>
    </div>
</div>
<div class="form-group" style="text-align:center;">
	<div class="col-sm-12">
        <input name="submit" type="submit" value="　　保存　　" class="btn btn-primary"/>
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
    </div>
</div>
</form>
<?php  } ?>
<script language='javascript'>               
//选择会员
function select_member(o) {
	var modalobj = $('#modal-module-member')	
	$("input[name='nickname']").val(o.nickname);
	$("#member").find("input[name='record[buyuid]']").val(o.uid).next().val(o.openid);
	modalobj.modal('hide');
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>