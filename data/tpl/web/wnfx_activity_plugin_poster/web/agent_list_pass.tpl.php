<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="./resource/css/app.css" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=20170826" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/util.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>web/resource/js/util.min.js?v=20170912"></script>
<style>
.app .panel {background-color: #FFF;}
.app .app-preview.wap-editor-footer{border-radius:18px;padding-bottom:50px;position:relative}
.app .app-preview .app-content {width: 322px;margin: 0 auto;padding-bottom: 0px;border: 1px solid #c5c5c5;min-height:400px;background: #fff}
.app .app-side{width:58%;}
.app .app-side>div{width:auto}
.app .app-coupon .promote-poster {-webkit-tap-highlight-color:transparent;position:relative;height:569px;overflow:hidden;border-radius:0;margin:0;color: #fff;}
.app .app-coupon .promote-poster .dot {width:100%;height: 5px;background-size: auto 5px;margin-top: 3px}
.app .app-coupon .promote-poster .name {position: relative;padding: 0 70px 0 10px;height: 60px;line-height: 60px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;font-size: 18px}
.app .app-coupon .promote-poster .promote-value {font-size: 30px;line-height: 40px}
.app .app-coupon .promote-poster .promote-limit {font-size: 14px;line-height: 40px}
.app .app-coupon .promote-poster .poster-info{background-color:#FFF;position:absolute; left:0;bottom:0; right:0;}
.app .app-coupon .promote-poster .poster-info .promote-state{color: rgba(0,0,0,0.8);padding-left:15px; line-height:2}
.app .app-coupon .promote-poster .poster-info .promote-time {padding-left:15px;color: rgba(0,0,0,0.5);font-size: 12px;padding-bottom: 5px;border-radius:0  0 8px 8px}
.app .app-coupon .promote-desc{ background:#f2f2f2}
.app .app-coupon .promote-desc>div{background:#FFF}
.app .app-coupon .promote-desc .promote-desc-title {padding: 2px 15px; text-align:center; border-bottom: 1px solid #ddd;}
.app .app-coupon .promote-desc .promote-desc-title .nav.nav-tabs{margin:0;border-bottom:none;width: 60%;margin: auto;}
.app .app-coupon .promote-desc .promote-desc-title .nav>li{width:50%;}
.app .app-coupon .promote-desc .promote-desc-title .nav>li>a{padding:5px 10px;border:none;margin:0;position:relative;color:#999}
.app .app-coupon .promote-desc .promote-desc-title .nav-tabs>li.active>a{color:#000}
.app .app-coupon .promote-desc .promote-desc-title .nav-tabs>li.active>a:after{position:absolute;left:30px;right:30px;bottom: 0;height: 2px;background-color: #EC0000;content: "";}
.app .app-coupon .promote-desc .desc-detail {min-height:80px;padding: 15px}
.app .app-coupon .promote-desc .list-group{margin-bottom:0;}
.app .app-coupon .promote-desc .list-group-item{padding-left:0;margin-left:15px;border:none;border-top: 1px solid #ddd;border-radius:0;}
.app .app-coupon .promote-desc .list-group-item:first-child{border:none;}
.app .app-coupon .promote-desc .list-group-item .fa{ color:#83c53f}
.app .app-coupon .promote-desc .promote-desc-friends{background:#FFF;margin:10px 0; padding:8px 15px; font-size:18px;}
.app .app-coupon .promote-desc .promote-desc-friends span{ color:#999;font-size:12px;}
.app .app-coupon-edit .panel {border-radius: 0;border-bottom: 0}
.app .app-coupon-edit .panel:last-child {border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;border-bottom: 1px solid #ddd}
.ui-icon{width:12px!important;height:12px!important;}
.ui-widget-content{z-index:2;position:absolute!important;top:0;left:0;font-size:17px;line-height:1.2}
.drag{cursor:default}
.menu-list{width:125px;height:auto;overflow:hidden;display:none;background:#EEE;box-shadow:0 1px 1px #888,1px 0 1px #ccc;border: 1px solid #DDD;position:absolute;z-index:999}
.menu-list .menu-item{width:130px;height: 25px;line-height: 25px;padding: 0 10px}
.menu-list .menu-item:hover{cursor: pointer;background-color: #39F}
.we7-table>tbody>tr>td{padding:5px 0;}
.form-inline .form-group .input-group{ margin-right:10px;}
.we7-page-title {display: block!important;border-bottom: 1px solid #ddd;font-size: 14px!important;padding: 0 10px 5px 0px;margin-bottom: 15px}
</style>
<div class="we7-page-search we7-padding-bottom clearfix">
	<div class="we7-page-title">分销商管理 - 申请列表</div>	
	<form action="" method="get" class="form-inline" role="form">
		<input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="<?php echo MODULE_PLUGIN_NAME;?>" />
        <input type="hidden" name="do" value="agent" />
        <input type="hidden" name="op" value="display.pass" />
        <input type="hidden" name="version_id" value="0" />
        <div class="form-group" style="padding-left:0">
            <div class="input-group col-md-5">
                <div class="input-group-btn" style="width:1%">
					<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    	<span class="menu_text"><?php echo $search['membertype'] > 0 ? ($search['membertype']>1?'总店':'推荐人') : '全部会员'?></span>
						<span class="caret"></span>
					</button>
					<ul role="menu" class="dropdown-menu js-search-menu">
						<li>
							<a href="javascript:;" data-type="0">全部会员</a>
						</li>
						<li>
							<a href="javascript:;" data-type="1">推荐人</a>
						</li>
                        <li>
							<a href="javascript:;" data-type="2">总店</a>
						</li>
					</ul>
				</div>
				<input name="search[membertype]" type="hidden" value="<?php  echo $search['membertype'];?>">
				<input name="search[member]" value="<?php  echo $search['member'];?>" class="form-control" placeholder="会员ID/昵称/姓名/手机/openId" type="text" style="80%">
                <span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
            </div>
            <div class="pull-right">
                <a href="<?php  echo web_url('agent', array('op' => 'display'))?>" class="btn btn-primary we7-padding-horizontal">返回分销商列表</a>
            </div>
        </div>        
	</form>
</div>
<form method="post" class="we7-form" id="form1">
    <table class="table we7-table table-hover vertical-middle" style="<?php echo substr(IMS_VERSION, 0, 1)>=2?'margin-bottom:35px':''?>">
        <input type="hidden" name="do" value="del">
        <tbody>
        <tr>
            <th class="text-left" width="8%">会员ID</th>
            <th width="15%">推荐人</th>
            <th width="15%">昵称</th>
            <th width="10%">姓名</th>
            <th width="15%">手机</th>
            <th width="10%">申请时间</th>
            <th width="8%">详情</th>
            <th class="text-right">操作</th>
        </tr>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td><?php  echo $row['member_id'];?></td>
            <td>
            	<?php  if($row['parent_id']) { ?>
                    <img src="<?php  echo $row['parentMember']['avatar'];?>" style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
                    </br>
                    <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:145px;display:block;"><?php  echo $row['parentMember']['nickname'];?></span>
                <?php  } else { ?>
                    <span class='label label-info'>总店</span>
                <?php  } ?>
            </td>
            <td><img src="<?php  echo $row['member']['avatar'];?>" style="width:30px; height: 30px;border:1px solid #ccc;padding:1px;">
            	</br><span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:145px;display:block;"><?php  echo $row['member']['nickname'];?></span>
                </td>
            <td><?php  echo $row['member']['realname'];?></td>
            <td><?php  echo $row['member']['mobile'];?></td>
            <td><?php  echo $row['created_at'];?></td>
            <td><a class="btn btn-default" href="<?php  echo web_url('agent', array('op' => 'detail','uid'=>$row['member_id']))?>" title="详细信息">查看会员详情</a></td>
            <td style="overflow:visible;">
            	<div class="btn-group btn-group-sm">
                    <a class="btn btn-default js-pass" href="javascript:;" data-id="<?php  echo $row['member_id'];?>">通过</a>
                </div>
            </td>
        </tr>
        <?php  } } ?>
    </tbody></table>
    
	<div class="text-right<?php echo substr(IMS_VERSION, 0, 1)>=2?' foot-fixed':''?>">
    	<div class="pull-left text-left text-muted">
            累计：<?php  echo $total;?> 条记录
        </div>
		<?php  echo $pager;?>
    </div>
</form>
<script type="text/javascript">
$(function(){
	$(".js-search-menu li").click(function (e) {
		$('input[name="search[membertype]"]').val($(this).find('a').data('type'));
		$(this).parents('.dropdown-menu').prev().find('.menu_text').text($(this).find('a').text());
    });
	$(".js-pass").click(function (e) {
		e.stopPropagation();
		var _this = $(this);
        var id = _this.data('id');
		
		util.nailConfirm(this, function(state) {
			$.ajax({
				url: "<?php  echo $this->createWeburl('agent', array('op' => 'pass'))?>",
				dataType: 'json',
				data: {id: $.trim(id)}, 
				success: function (data) {
					if (!data.result) {
						util.tips(data.msg);
						_this.parents('tr').remove();
					}				
				}
			});
		}, {html: '确定审核通过吗？',placement: 'left'});
    });
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH));?>