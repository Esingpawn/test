<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="./resource/css/app.css" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=<?php echo FX_RELEASE_DATE;?>" rel="stylesheet">
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
.ui-widget-content{z-index:2;position:absolute!important;top:0;left:0;font-size:17px;line-height:1.2;background: rgba(255,255,255,.55)!important;}
.drag{cursor:default}
.menu-list{width:125px;height:auto;overflow:hidden;display: block;background:#EEE;box-shadow:0 1px 1px #888,1px 0 1px #ccc;border: 1px solid #DDD;position:absolute;z-index:999}
.menu-list .menu-item{width:130px;height: 25px;line-height: 25px;padding: 0 10px}
.menu-list .menu-item:hover{cursor: pointer;background-color: #39F}
</style>
<?php  if($op == 'display') { ?>
<div class="we7-page-search we7-padding-bottom clearfix">
	<div class="pull-right">
        <a href="<?php  echo $this->createWeburl('poster', array('op' => 'post'))?>" class="btn btn-primary we7-padding-horizontal">+添加海报</a>
    </div>
	<form action="" method="get" class="form-inline ng-pristine ng-valid" role="form">
		<input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="<?php echo MODULE_PLUGIN_NAME;?>" />
        <input type="hidden" name="do" value="poster" />
		<div class="form-group">
			<div class="input-group col-sm-12">
				<div class="input-group-btn">
					<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    	<span class="menu_text"><?php echo $search_type==1 ? '精确' : '模糊'?></span>
						<span class="caret"></span>
					</button>
					<ul role="menu" class="dropdown-menu">
						<li>
							<a href="javascript:;" onclick="$('input[name=search_type]').val(1);$('.menu_text').text('精确')">精确</a>
						</li>
						<li>
							<a href="javascript:;" onclick="$('input[name=search_type]').val(2);$('.menu_text').text('模糊')">模糊</a>
						</li>
					</ul>
				</div>
				<input name="search_type" type="hidden" value="<?php  echo $search_type;?>">
				<input name="keyword" value="<?php  echo $_GPC['keyword'];?>" class="form-control" placeholder="" type="text">
				<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
			</div>
		</div>
	</form>
</div>
<form method="post" class="we7-form" id="form1">
    <table class="table we7-table table-hover vertical-middle">
        <input type="hidden" name="do" value="del">
        <tbody>
        <tr>
            <th class="text-left" width="60">删除</th>
            <th width="200px">海报名称</th>
            <th>所属活动</th>
            <th width="80px">状态</th>
            <th class="text-right" width="210px">操作</th>
        </tr>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td style="overflow: hidden;">
                <input type="checkbox" id="id-<?php  echo $row['id'];?>" name="id[]" value="<?php  echo $row['id'];?>" class="items">
                <label for="id-<?php  echo $row['id'];?>">&nbsp;</label>
            </td>
            <td><?php  echo $row['name'];?></td>
            <td><?php echo empty($row['gname'])?'通用':$row['gname']?></td>
            <td><div class="switch switch<?php echo $row['enable'] ? 'On' : 'Off'?>" data-id="<?php  echo $row['id'];?>"></div></td>
            <td style="overflow:visible;">
                <div class="link-group">
                    <a href="javascript:void(0);" class="js-post" data-id="<?php  echo $row['id'];?>" data-placement="left" title="复制">复制</a>
                    <a href="<?php  echo $this->createWeburl('poster', array('op' => 'post', 'id' => $row['id']))?>">管理设置</a>
                    <a href="javascript:void(0);" class="js-delete" data-id="<?php  echo $row['id'];?>" data-placement="left" title="删除">删除</a>
                </div>
            </td>
        </tr>
        <?php  } } ?>
    </tbody></table>
    
	<div class="text-right<?php echo substr(IMS_VERSION, 0, 1)>=2?' foot-fixed':''?>">
    	<div class="pull-left" style="padding-left:14px;">
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
            <input type="checkbox" id="check-all" name="check-all" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
            <label for="check-all"> &nbsp;</label>
            <button type="button" class="btn btn-danger btn-submit js-batch js-deletes" data-placement="right">删除</button>
        </div>
		<?php  echo $pager;?>
    </div>
</form>
<script type="text/javascript">
$(function(){
	//switch样式
	$('.switch').click(function(e){
		var id = $(this).data('id');
		var state = $(this).hasClass("switchOff");
		var enable = state ? 1 : 0;
		$.getJSON("<?php  echo $this->createWeburl('poster', array('op' => 'enable'))?>", {id:id, enable:enable}, function(data) {
			util.tips(data.message, 2000);
		});
		$(this).toggleClass("switchOff");
		$(this).toggleClass("switchOn");
	});
	$('.js-post').click(function(e) {
		e.stopPropagation();
		var $this = $(this);
		var id = $this.data('id');
		util.nailConfirm(this, function(state) {
			if (!state) return;
			$.post("<?php  echo $this->createWeburl('poster', array('op' => 'copy'))?>", {id : id}, function(data) {				
				if(!data.errno){
					location.reload();
				}
				util.tips(data.message);
			}, 'json');
		}, {html:"确定复制当前样式吗？",placement: $this.data('placement')});
	});
	//删除效果b，单条操作
	$('.js-delete').click(function(e) {
		e.stopPropagation();
		var $this = $(this);
		var id = $this.data('id');
		util.nailConfirm(this, function(state) {
			if (!state) return;
			$.post("<?php  echo $this->createWeburl('poster', array('op' => 'delete'))?>", {id : id}, function(data) {
				if(!data.errno){
					$this.parents('tr').remove();
				}
				util.tips(data.message);
			}, 'json');
		}, {html:"确定删除？",placement: $this.data('placement')});
	});
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
		var op = '',html = '';
		if ($(this).hasClass('js-deletes')) {
			op = 'delete';
			html = '确认删除?';
		}
		var $this = $(this);
		util.nailConfirm(this, function(state) {
			if(!state) return;
			$.post("<?php  echo $this->createWeburl('poster')?>", {op : op,id : ids}, function(data){
				if(!data.errno && op=='delete'){
					$checkboxes.each(function() {
						$(this).parents('tr').remove();
					});
				};
				util.tips(data.message);
			}, 'json');
		}, {html: html, placement: $this.data('placement')});
	});
});
</script>
<?php  } else if($op == 'post') { ?>
<form action="" method="post" class="form-horizontal">
	<div class="panel panel-default">
		<div class="panel-heading">设置海报</div>
		<div class="panel-body">
			<div class="app clearfix">
				<div class="app-preview wap-editor-footer">
					<div class="app-header"></div>
					<div class="app-content app-coupon">
						<div class="inner">
							<div class="con">
								<div class="ump-coupon-detail-wrap">
									<div class="promote-poster" id="poster">
                                    	<img class="poster-bg ng-scope js-poster-bg" width="100%" height="100%" src="<?php  if($poster['thumb']) { ?><?php  echo tomedia($poster['thumb'])?><?php  } else { ?>resource/images/nopic-203.png<?php  } ?>" style="bottom:0">
                                        <?php  if($img_data['show']['0']) { ?>
                                        <div class="drag ui-widget-content" type="head" style="width:<?php  echo round($img_data['w']['0']/$bg_w*320)?>px;height:<?php  echo round($img_data['h']['0']/$bg_w*320)?>px;left:<?php  echo round($img_data['x']['0']/$bg_w*320)?>px;top:<?php  echo round($img_data['y']['0']/$bg_h*$boxH)?>px;">
                                            <img width="100%" height="100%" src="../addons/wnfx_activity_plugin_poster/web/resource/images/head.png">
                                            <input type="hidden" name="param[head][x]" value="<?php  echo $img_data['x']['0'];?>">
                                            <input type="hidden" name="param[head][y]" value="<?php  echo $img_data['y']['0'];?>">
                                            <input type="hidden" name="param[head][w]" value="<?php  echo $img_data['w']['0'];?>">
                                            <input type="hidden" name="param[head][h]" value="<?php  echo $img_data['h']['0'];?>">                                           
                                            <input type="hidden" name="param[head][show]" value="1">
                                        </div>
                                        <?php  } ?>
                                        <?php  if($text_data['show']['0']) { ?>
                                        <div class="drag ui-widget-content" type="nickname" style="width:<?php  echo round($text_data['w']['0']/$bg_w*320)?>px;height:<?php  echo round($text_data['size']['0']/$bg_w/0.741*320/0.8)?>px;left:<?php  echo round($text_data['x']['0']/$bg_w*320)?>px;top:<?php  echo round($text_data['y']['0']/$bg_h*$boxH/1.038)?>px;font-size:<?php  echo round($text_data['size']['0']/$bg_w/0.741*320)?>px;color:rgb(<?php  echo $text_data['color']['0']?>);">
                                        	用户昵称
                                            <input type="hidden" name="param[nickname][x]" value="<?php  echo $text_data['x']['0'];?>">
                                            <input type="hidden" name="param[nickname][y]" value="<?php  echo $text_data['y']['0'];?>">
                                            <input type="hidden" name="param[nickname][w]" value="<?php  echo $text_data['w']['0'];?>">
                                            <input type="hidden" name="param[nickname][size]" value="<?php  echo $text_data['size']['0'];?>">
                                            <input type="hidden" name="param[nickname][color]" value="<?php  echo $text_data['color']['0'];?>">
                                            <input type="hidden" name="param[nickname][show]" value="1">
                                        </div>
                                        <?php  } ?>
                                        <?php  if($text_data['show']['1']) { ?>
                                        <div class="drag ui-widget-content" type="title" style="width:<?php  echo round($text_data['w']['1']/$bg_w*320)?>px;height:<?php  echo round($text_data['size']['1']/$bg_w/0.741*320/0.8)?>px;left:<?php  echo round($text_data['x']['1']/$bg_w*320)?>px;top:<?php  echo round($text_data['y']['1']/$bg_h*$boxH/1.038)?>px;font-size:<?php  echo round($text_data['size']['1']/$bg_w/0.741*320)?>px;color:rgb(<?php  echo $text_data['color']['1']?>);">
                                            活动名称
                                            <input type="hidden" name="param[title][x]" value="<?php  echo $text_data['x']['1'];?>">
                                            <input type="hidden" name="param[title][y]" value="<?php  echo $text_data['y']['1'];?>">
                                            <input type="hidden" name="param[title][w]" value="<?php  echo $text_data['w']['1'];?>">
                                            <input type="hidden" name="param[title][size]" value="<?php  echo $text_data['size']['1'];?>">
                                            <input type="hidden" name="param[title][color]" value="<?php  echo $text_data['color']['1'];?>">
                                            <input type="hidden" name="param[title][show]" value="1">
                                        </div>
                                        <?php  } ?>
                                        <?php  if($text_data['show']['2']) { ?>
                                        <div class="drag ui-widget-content" type="time" style="width:<?php  echo round($text_data['w']['2']/$bg_w*320)?>px;height:<?php  echo round($text_data['size']['2']/$bg_w/0.741*320/0.8)?>px;left:<?php  echo round($text_data['x']['2']/$bg_w*320)?>px;top:<?php  echo round($text_data['y']['2']/$bg_h*$boxH/1.038)?>px;font-size:<?php  echo round($text_data['size']['2']/$bg_w/0.741*320)?>px;color:rgb(<?php  echo $text_data['color']['2']?>);">
                                            活动时间(Y-m-d H:i)
                                            <input type="hidden" name="param[time][x]" value="<?php  echo $text_data['x']['2'];?>">
                                            <input type="hidden" name="param[time][y]" value="<?php  echo $text_data['y']['2'];?>">
                                            <input type="hidden" name="param[time][w]" value="<?php  echo $text_data['w']['2'];?>">
                                            <input type="hidden" name="param[time][size]" value="<?php  echo $text_data['size']['2'];?>">
                                            <input type="hidden" name="param[time][color]" value="<?php  echo $text_data['color']['2'];?>">
                                            <input type="hidden" name="param[time][show]" value="1">
                                        </div>
                                        <?php  } ?>
                                        <?php  if($text_data['show']['6']) { ?>
                                        <div class="drag ui-widget-content" type="endtime" style="width:<?php  echo round($text_data['w']['6']/$bg_w*320)?>px;height:<?php  echo round($text_data['size']['6']/$bg_w/0.741*320/0.8)?>px;left:<?php  echo round($text_data['x']['6']/$bg_w*320)?>px;top:<?php  echo round($text_data['y']['6']/$bg_h*$boxH/1.038)?>px;font-size:<?php  echo round($text_data['size']['6']/$bg_w/0.741*320)?>px;color:rgb(<?php  echo $text_data['color']['6']?>);">
                                            结束时间(Y-m-d H:i)
                                            <input type="hidden" name="param[endtime][x]" value="<?php  echo $text_data['x']['6'];?>">
                                            <input type="hidden" name="param[endtime][y]" value="<?php  echo $text_data['y']['6'];?>">
                                            <input type="hidden" name="param[endtime][w]" value="<?php  echo $text_data['w']['6'];?>">
                                            <input type="hidden" name="param[endtime][size]" value="<?php  echo $text_data['size']['6'];?>">
                                            <input type="hidden" name="param[endtime][color]" value="<?php  echo $text_data['color']['6'];?>">
                                            <input type="hidden" name="param[endtime][show]" value="1">
                                        </div>
                                        <?php  } ?>
                                        <?php  if($text_data['show']['3']) { ?>
                                        <div class="drag ui-widget-content" type="add" style="width:<?php  echo round($text_data['w']['3']/$bg_w*320)?>px;height:<?php  echo round($text_data['size']['3']/$bg_w/0.741*320/0.8)?>px;left:<?php  echo round($text_data['x']['3']/$bg_w*320)?>px;top:<?php  echo round($text_data['y']['3']/$bg_h*$boxH/1.038)?>px;font-size:<?php  echo round($text_data['size']['3']/$bg_w/0.741*320)?>px;color:rgb(<?php  echo $text_data['color']['3']?>);">
                                            活动地址
                                            <input type="hidden" name="param[add][x]" value="<?php  echo $text_data['x']['3'];?>">
                                            <input type="hidden" name="param[add][y]" value="<?php  echo $text_data['y']['3'];?>">
                                            <input type="hidden" name="param[add][w]" value="<?php  echo $text_data['w']['3'];?>">
                                            <input type="hidden" name="param[add][size]" value="<?php  echo $text_data['size']['3'];?>">
                                            <input type="hidden" name="param[add][color]" value="<?php  echo $text_data['color']['3'];?>">
                                            <input type="hidden" name="param[add][show]" value="1">
                                        </div>
                                        <?php  } ?>
                                        <?php  if($text_data['show']['4']) { ?>
                                        <div class="drag ui-widget-content" type="realname" style="width:<?php  echo round($text_data['w']['4']/$bg_w*320)?>px;height:<?php  echo round($text_data['size']['4']/$bg_w/0.741*320/0.8)?>px;left:<?php  echo round($text_data['x']['4']/$bg_w*320)?>px;top:<?php  echo round($text_data['y']['4']/$bg_h*$boxH/1.038)?>px;font-size:<?php  echo round($text_data['size']['4']/$bg_w/0.741*320)?>px;color:rgb(<?php  echo $text_data['color']['4']?>);">
                                            姓名
                                            <input type="hidden" name="param[realname][x]" value="<?php  echo $text_data['x']['4'];?>">
                                            <input type="hidden" name="param[realname][y]" value="<?php  echo $text_data['y']['4'];?>">
                                            <input type="hidden" name="param[realname][w]" value="<?php  echo $text_data['w']['4'];?>">
                                            <input type="hidden" name="param[realname][size]" value="<?php  echo $text_data['size']['4'];?>">
                                            <input type="hidden" name="param[realname][color]" value="<?php  echo $text_data['color']['4'];?>">
                                            <input type="hidden" name="param[realname][show]" value="1">
                                        </div>
                                        <?php  } ?>
                                        <?php  if($text_data['show']['5']) { ?>
                                        <div class="drag ui-widget-content" type="idcode" style="width:<?php  echo round($text_data['w']['5']/$bg_w*320)?>px;height:<?php  echo round($text_data['size']['5']/$bg_w/0.741*320/0.8)?>px;left:<?php  echo round($text_data['x']['5']/$bg_w*320)?>px;top:<?php  echo round($text_data['y']['5']/$bg_h*$boxH/1.038)?>px;font-size:<?php  echo round($text_data['size']['5']/$bg_w/0.741*320)?>px;color:rgb(<?php  echo $text_data['color']['5']?>);">
                                            核销码
                                            <input type="hidden" name="param[idcode][x]" value="<?php  echo $text_data['x']['5'];?>">
                                            <input type="hidden" name="param[idcode][y]" value="<?php  echo $text_data['y']['5'];?>">
                                            <input type="hidden" name="param[idcode][w]" value="<?php  echo $text_data['w']['5'];?>">
                                            <input type="hidden" name="param[idcode][size]" value="<?php  echo $text_data['size']['5'];?>">
                                            <input type="hidden" name="param[idcode][color]" value="<?php  echo $text_data['color']['5'];?>">
                                            <input type="hidden" name="param[idcode][show]" value="1">
                                        </div>
                                        <?php  } ?>
                                        <?php  if($img_data['show']['2']) { ?>
                                        <div class="drag ui-widget-content" type="qr" style="width:<?php  echo round($img_data['w']['2']/$bg_w*320)?>px;height:<?php  echo round($img_data['h']['2']/$bg_w*320)?>px;left:<?php  echo round($img_data['x']['2']/$bg_w*320)?>px;top:<?php  echo round($img_data['y']['2']/$bg_h*$boxH)?>px;">
                                            <img width="100%" height="100%" src="../addons/wnfx_activity_plugin_poster/web/resource/images/qr.png">
                                            <input type="hidden" name="param[qr][x]" value="<?php  echo $img_data['x']['2'];?>">
                                            <input type="hidden" name="param[qr][y]" value="<?php  echo $img_data['y']['2'];?>">
                                            <input type="hidden" name="param[qr][w]" value="<?php  echo $img_data['w']['2'];?>">
                                            <input type="hidden" name="param[qr][h]" value="<?php  echo $img_data['h']['2'];?>">
                                            <input type="hidden" name="param[qr][show]" value="1">
                                        </div>
                                        <?php  } ?>
									</div>									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="app-side" style="margin: 0;">
					<div class="app-coupon-edit">
						<div class="arrow-left"></div>
						<div class="inner">
							<div class="panel panel-default">
								<div class="panel-heading b">编辑海报</div>
								<div class="panel-body">
									<div class="form-group">
										<label class="col-md-2 control-label">海报名称</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="poster[name]" value="<?php  echo $poster['name'];?>">
										</div>
									</div>
									
                                    <div class="form-group" id="value_first">
										<label class="col-md-2 control-label">是否启用</label>
										<div class="col-md-9">
                                        	<label class="radio-inline">
												<input type="radio" value="1" name="poster[enable]"<?php  if($poster['enable']==1) { ?> checked<?php  } ?> />启用
											</label>
                                            <label class="radio-inline">
												<input type="radio" value="0" name="poster[enable]"<?php  if($poster['enable']=='' || $poster['enable']==0) { ?> checked<?php  } ?> />禁用
											</label>
										</div>
									</div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2">指定活动</label>
                                        <div class="col-xs-12 col-sm-9">            	
                                            <div class='input-group'>
                                                <input type="text" name="poster[gname]" id="gname" maxlength="30" value="<?php  echo $poster['gname'];?>" class="form-control" readonly />
                                                <div class='input-group-btn'>
                                                    <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-goods').modal();">选择活动</button>
                                                    <button class="btn btn-default goodsclean" type="button"><span><i class="fa fa-remove"></i></span></button>
                                                </div>
                                            </div>
                                            <div class="input-group multi-img-details" style="display:none">
                                                <div class="multi-item">
                                                    <input type="hidden" name="poster[goodsid]" value="<?php  echo $poster['goodsid'];?>" id="goodsid">
                                                </div>
                                            </div>
                                            <div id="modal-module-goods"  class="modal fade" tabindex="-1">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择活动</h3></div>
                                                        <div class="modal-body" >
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="keyword" value="" id="goods-kwd" placeholder="输入活动名称" />
                                                                <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_goods();">搜索</button></span>
                                                            </div>
                                                            <div id="module-goods" style="padding-top:5px;"></div>
                                                        </div>
                                                        <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
												//选择活动
												function select_goods(o) {
													$('#gname').val(o.title);
													$('#goodsid').val(o.id);
													util.tips("操作成功");
												}
												function search_goods(o) {
													$("#module-goods").html("正在搜索....")
													$.get("<?php  echo $this->createWeburl('poster', array('op' => 'selectgoods'))?>", {
														keyword: $.trim($('#goods-kwd').val())
													}, function(dat){
														$('#module-goods').html(dat);
													});
												}
												$(".goodsclean").click(function(){
													$('#gname').val("");
													$('#goodsid').val("");
												});
											</script>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
										<label class="col-md-2 control-label">海报封面</label>
										<div class="col-md-9">
											<script type="text/javascript">
												function showImageDialog(elm, opts, options) {
													require(["util"], function(util){
														var btn = $(elm);
														var ipt = btn.parent().prev();
														var val = ipt.val();
														var img = ipt.parent().next().children();
														options = {'global':false,'class_extra':'','direct':true,'multiple':false,'fileSizeLimit':5120000};
														util.image(val, function(url){
															if(url.url){
																if(img.length > 0){
																	img.get(0).src = url.url;
																}
																ipt.val(url.attachment);
																ipt.attr("filename",url.filename);
																ipt.attr("url",url.url);
																$('.js-poster-bg').attr('src',url.url);
															}
															if(url.media_id){
																if(img.length > 0){
																	img.get(0).src = "";
																}
																ipt.val(url.media_id);
															}
														}, options);
													});
												}
												function deleteImage(elm){
													$(elm).prev().attr("src", "./resource/images/nopic.jpg");
													$(elm).parent().prev().find("input").val("");
													$('.js-poster-bg').attr('src','resource/images/nopic-203.png');
												}
											</script>
                                            <div class="input-group ">
                                                <input type="text" name="poster[thumb]" value="<?php  echo $poster['thumb'];?>" class="form-control" autocomplete="off">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>
                                                </span>
                                            </div>
                                            <div class="input-group " style="margin-top:.5em;">
                                                <img src="<?php  if($poster['thumb']) { ?><?php  echo tomedia($poster['thumb'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="this.src='<?php  if($poster['thumb']) { ?><?php  echo tomedia($poster['thumb'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>'; this.title='图片未找到.'" class="img-responsive img-thumbnail"  width="150" />
                                                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
                                            </div>
                                            <span class="help-block">图片比例 9 : 16【JPG格式】</span>
										</div>
									</div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">海报元素</label>
                                        <div class="col-sm-9 col-xs-12">
                                            <button class="btn btn-default btn-com" type="button" data-type="head" style="margin-bottom: 4px">头像</button>
                                            <button class="btn btn-default btn-com" type="button" data-type="nickname" style="margin-bottom: 4px">昵称</button>                                           
                                            <button class="btn btn-default btn-com" type="button" data-type="title" style="margin-bottom: 4px">活动名称</button>
                                            <button class="btn btn-default btn-com" type="button" data-type="time" style="margin-bottom: 4px">活动时间(Y-m-d H:i)</button>
                                            <button class="btn btn-default btn-com" type="button" data-type="endtime" style="margin-bottom: 4px">结束时间(Y-m-d H:i)</button>
                                            <button class="btn btn-default btn-com" type="button" data-type="add" style="margin-bottom: 4px">地址</button>                                            
                                            <button class="btn btn-default btn-com" type="button" data-type="qr" style="margin-bottom: 4px">二维码</button>
                                            <!--<button class="btn btn-default btn-com" type="button" data-type="realname" style="margin-bottom: 4px">姓名</button>-->
                                            <!--<button class="btn btn-default btn-com" type="button" data-type="idcode" style="margin-bottom: 4px">核销码</button>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">字体颜色</label>
                                        <div class="col-sm-9 col-xs-12">
                                        	<script type="text/javascript">
												$(function(){
													$(".colorpicker").each(function(){
														var elm = this;
														util.colorpicker(elm, function(color){
															$(elm).parent().prev().prev().val(color.toHexString());
															$(elm).parent().prev().prev().prev().val(color.toRgb().r+','+color.toRgb().g+','+color.toRgb().b);
															$(elm).parent().prev().css("background-color", color.toHexString());
															console.log(color);
															console.log(color.toRgb().r);
															console.log(color.toRgbString());
														});
													});
													$(".colorclean").click(function(){
														$(this).parent().prev().prev().val("");
														$(this).parent().prev().css("background-color", "#FFF");
													});
												});
											</script>
                                            <div class="row row-fix">
                                                <div class="col-xs-8 col-sm-8" style="padding-right:0;">
                                                    <div class="input-group">
                                                        <input class="form-control" type="hidden" name="poster[rgb]" value="<?php  if(empty($poster['rgb'])) { ?>255,255,255<?php  } else { ?><?php  echo $poster['rgb'];?><?php  } ?>">
                                                        <input class="form-control" type="text" name="poster[hex]" placeholder="请选择颜色" value="<?php  if(empty($poster['hex'])) { ?>#ffffff<?php  } else { ?><?php  echo $poster['hex'];?><?php  } ?>" readonly="readonly">
                                                        <span class="input-group-addon" style="width:35px;border-left:none;background-color:rgb(<?php  if(empty($poster['rgb'])) { ?>255,255,255<?php  } else { ?><?php  echo $poster['rgb'];?><?php  } ?>);"></span>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
                                                            <button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="form-group<?php echo substr(IMS_VERSION, 0, 1)>=2?' foot-fixed text-center':' col-sm-12'?>">
    	<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
        <input type="hidden" name="id" value="<?php  echo $poster['id'];?>">
        <input type="hidden" name="op" value="post">
        <input name="submit" type="submit" class="btn btn-primary min-width" value="保存">
    </div>
</form>
<div class="menu-list" id="menu-layer"></div>
<link href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>app/resource/components/layui/laytpl.js"></script>
<script type="text/html" id="tpl_poster">
{{# if(d == 'head'){ }}
<div class="drag ui-widget-content" type="head" style="width:50px;height:50px;">
	<img width="100%" height="100%" src="../addons/wnfx_activity_plugin_poster/web/resource/images/head.png">
	<input type="hidden" name="param[head][x]" value="">
	<input type="hidden" name="param[head][y]" value="">
	<input type="hidden" name="param[head][w]" value="">
	<input type="hidden" name="param[head][h]" value="">
	<input type="hidden" name="param[head][show]" value="1">
</div>
{{# }else if(d == 'nickname'){ }}
<div class="drag ui-widget-content" type="nickname" style="width:100px;height:20px;top:55px">
	用户昵称
	<input type="hidden" name="param[nickname][x]" value="">
	<input type="hidden" name="param[nickname][y]" value="">
	<input type="hidden" name="param[nickname][w]" value="">
	<input type="hidden" name="param[nickname][size]" value="">
	<input type="hidden" name="param[nickname][color]" value="">
	<input type="hidden" name="param[nickname][show]" value="1">
</div>
{{# }else if(d == 'title'){ }}
<div class="drag ui-widget-content" type="title" style="width:260px;height:20px;top:105px">
	活动名称
	<input type="hidden" name="param[title][x]" value="">
	<input type="hidden" name="param[title][y]" value="">
	<input type="hidden" name="param[title][w]" value="">
	<input type="hidden" name="param[title][size]" value="">
	<input type="hidden" name="param[title][color]" value="">
	<input type="hidden" name="param[title][show]" value="1">
</div>
{{# }else if(d == 'time'){ }}
<div class="drag ui-widget-content" type="time" style="width:165px;height:20px;top:135px">
	活动时间(Y-m-d H:i)
	<input type="hidden" name="param[time][x]" value="">
	<input type="hidden" name="param[time][y]" value="">
	<input type="hidden" name="param[time][w]" value="">
	<input type="hidden" name="param[time][size]" value="">
	<input type="hidden" name="param[time][color]" value="">
	<input type="hidden" name="param[time][show]" value="1">
</div>
{{# }else if(d == 'endtime'){ }}
<div class="drag ui-widget-content" type="endtime" style="width:165px;height:20px;top:165px">
	结束时间(Y-m-d H:i)
	<input type="hidden" name="param[endtime][x]" value="">
	<input type="hidden" name="param[endtime][y]" value="">
	<input type="hidden" name="param[endtime][w]" value="">
	<input type="hidden" name="param[endtime][size]" value="">
	<input type="hidden" name="param[endtime][color]" value="">
	<input type="hidden" name="param[endtime][show]" value="1">
</div>
{{# }else if(d == 'add'){ }}
<div class="drag ui-widget-content" type="add" style="width:260px;height:20px;top:195px">
	活动地址
	<input type="hidden" name="param[add][x]" value="">
	<input type="hidden" name="param[add][y]" value="">
	<input type="hidden" name="param[add][w]" value="">
	<input type="hidden" name="param[add][size]" value="">
	<input type="hidden" name="param[add][color]" value="">
	<input type="hidden" name="param[add][show]" value="1">
</div>
{{# }else if(d == 'realname'){ }}
<div class="drag ui-widget-content" type="realname" style="width:100px;height:20px;top:80px">
	姓名
	<input type="hidden" name="param[realname][x]" value="">
	<input type="hidden" name="param[realname][y]" value="">
	<input type="hidden" name="param[realname][w]" value="">
	<input type="hidden" name="param[realname][size]" value="">
	<input type="hidden" name="param[realname][color]" value="">
	<input type="hidden" name="param[realname][show]" value="1">
</div>
{{# }else if(d == 'idcode'){ }}
<div class="drag ui-widget-content" type="idcode" style="width:100px;height:20px;top:225px">
	核销码
	<input type="hidden" name="param[idcode][x]" value="">
	<input type="hidden" name="param[idcode][y]" value="">
	<input type="hidden" name="param[idcode][w]" value="">
	<input type="hidden" name="param[idcode][size]" value="">
	<input type="hidden" name="param[idcode][color]" value="">
	<input type="hidden" name="param[idcode][show]" value="1">
</div>
{{# }else if(d == 'qr'){ }}
<div class="drag ui-widget-content" type="qr" style="width:100px;height:100px;top:265px;">
	<img width="100%" height="100%" src="../addons/wnfx_activity_plugin_poster/web/resource/images/qr.png">
	<input type="hidden" name="param[qr][x]" value="">
	<input type="hidden" name="param[qr][y]" value="">
	<input type="hidden" name="param[qr][w]" value="">
	<input type="hidden" name="param[qr][h]" value="">
	<input type="hidden" name="param[qr][show]" value="1">
</div>
{{# } }}
</script>
<script type="text/javascript">
var scrollTop=$(window).scrollTop();
$(window).scroll(function(){
	scrollTop = $(this).scrollTop();
});

//创建右键菜单
var epMenu={
	create:function(point,option){
		var menuNode=document.getElementById('menu-layer');
		if(!menuNode){
			//没有菜单节点的时候创建一个
			menuNode=document.createElement("div");
			menuNode.setAttribute('class','menu-list');
			menuNode.setAttribute('id','menu-layer');
		}else {
			$(menuNode).html('').show();//清空里面的内容
		}
		
		$(menuNode).css({left:point.left+'px',top:(point.top+scrollTop)+'px'});
		for(var x in option){
			var tempNode=document.createElement("div");
			$(tempNode).addClass('menu-item');
			$(tempNode).text(option[x]['name']).on('click',option[x].action);
			if (option[x]['bind']=='color') {
				util.colorpicker(tempNode, function(color){
					$(epMenu.elm).find('input').eq(4).val(color.toRgb().r+','+color.toRgb().g+','+color.toRgb().b);
					$(epMenu.elm).css("color", color.toHexString());
				});
			}
			menuNode.appendChild(tempNode);
		}			
		$("body").append(menuNode);
	},
	destory:function(){
		$("#menu-layer").hide();
	},
	delcolor:function(e){
		$(epMenu.elm).find('input').eq(4).val('');
		$(epMenu.elm).css("color", '');
	},
	del:function(){
		$(epMenu.elm).remove();
	},
	elm:'',
};	
//关闭右键菜单
window.onclick=function(e){
	//用户触发click事件就可以关闭了，因为绑定在window上，按事件冒泡处理，不会影响菜单的功能
	epMenu.destory();
}
require(['jquery.ui'], function ($){
	//初始化海报设置
	$('#poster').find('.drag').each(function(i){
		var type = $(this).attr('type'), 
			aspectRatio = type=='head' || type=='qr' ? 1 : (type == 'nickname' ? 9 / 2 : 0);
		$(this).draggable({
			start: function(event) {},
			drag: function(e) {},
			stop: function(event) {
				setparam(this, event.target);
			}
		});
		$(this).resizable({
			aspectRatio: aspectRatio,
			ghost: true,
			start: function(event) {},
			resize: function(e) {},
			stop: function(event) {				
				setparam(this, event.target, true);
			}
		});
		//加载右键菜单
		this.oncontextmenu=function(e){
			//设置当前要操作元素节点
			epMenu.elm = this;
			//取消默认的浏览器自带右键 很重要！！
			e.preventDefault();
			//根据事件对象中鼠标点击的位置，进行定位
			epMenu.create({left:e.clientX,top:e.clientY},[
			{name:'删除元素','action':epMenu.del},
			{name:'设置颜色',bind:'color'},
			{name:'清除颜色','action':epMenu.delcolor},
			{name:'关闭','action':epMenu.destory}]);
		}
		
	});
});
$(function(){
	$('.btn-com').on('click',function(){
		var type = $(this).data('type'), 
			aspectRatio = type=='head' || type=='qr' ? 1 : 0, 
			gettpl = document.getElementById('tpl_poster').innerHTML,
			elm = '[type="'+type+'"]';
			
		if ($("#poster").html().indexOf('"'+type+'"')!=-1){
			util.tips('同一元素不可重复添加！');
			return false;
		}
		laytpl(gettpl).render(type, function(html){
			$('#poster').append(html);
		});
		$(elm).get(0).oncontextmenu=function(e){
			//设置当前要操作元素节点
			epMenu.elm = this;
			//取消默认的浏览器自带右键 很重要！！
			e.preventDefault();
			//根据事件对象中鼠标点击的位置，进行定位
			epMenu.create({left:e.clientX,top:e.clientY},[{name:'删除元素','action':epMenu.del}]);
		}
		setparam(elm, $(elm).get(0));
		$(elm).resizable({
			aspectRatio: aspectRatio,
			ghost: true,
			start: function(event) {},
			resize: function(e) {},
			stop: function(event) {
				setparam(this, event.target, true);
			}
		});
		$(".drag").draggable({
			start: function(event) {},
			drag: function(e) {},
			stop: function(event) {
				console.log(event);
				setparam(this, event.target);
			}
		});
	});
});
function setparam(elm, target, a) {
	var bgWidth = $(".js-poster-bg")[0].naturalWidth,
		bgHeight = $(".js-poster-bg")[0].naturalHeight,
		boxH = (320 / bgWidth * bgHeight).toFixed(0);
		console.log(boxH);
	var offsetLeft = target.offsetLeft,
		offsetWidth = target.offsetWidth,
		offsetHeight = target.offsetHeight,
		offsetTop = target.offsetTop;
	offsetWidth = offsetWidth > 300 ? 300 : offsetWidth;
	$(elm).css('width', offsetWidth);
	
	offsetLeft = offsetLeft < 0 ? 0 : (offsetLeft >= 320 ? 310 - offsetWidth : offsetLeft);
	offsetTop = offsetTop < 0 ? 0 : offsetTop;
	$(elm).css({'left':offsetLeft});
	$(elm).css('top', offsetTop);
	
	offsetLeft = (offsetLeft / 320 * bgWidth).toFixed(0);
	offsetWidth = (offsetWidth / 320 * bgWidth).toFixed(0);
	offsetHeight = (offsetHeight / 320 * bgWidth).toFixed(0);
	offsetTop = (offsetTop / boxH * bgHeight).toFixed(0);
	offsetSize = ((target.offsetHeight*0.8)/320 * bgWidth * 0.741).toFixed(0);
	
	console.log(offsetHeight);
	if ($(elm).attr('type')=='head' || $(elm).attr('type')=='qr' || $(elm).attr('type')=='pic') {
		$(elm).find('input').eq(0).val(offsetLeft);
		$(elm).find('input').eq(1).val(offsetTop);
		$(elm).find('input').eq(2).val(offsetWidth);
		$(elm).find('input').eq(3).val(offsetHeight);
	}else{
		$(elm).css('font-size', target.offsetHeight*0.8);
		$(elm).find('input').eq(0).val(offsetLeft);
		$(elm).find('input').eq(1).val((offsetTop * 1.038).toFixed(0));
		$(elm).find('input').eq(2).val(offsetWidth);
		$(elm).find('input').eq(3).val(offsetSize);
	}
}
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH));?>