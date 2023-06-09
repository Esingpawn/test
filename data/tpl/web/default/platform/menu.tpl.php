<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="wechat_menu">
	<div class="platform-menu-status" ng-controller="menuStatus" id="menuStatus">
		<div class="icon">
			<i class="wi wi-custommenu color-default"></i>
		</div>
		<div class="desc">
			<div class="item">自定义菜单</div>
			<div class="item color-gray">该功能<?php  if($menu_display == 1 ) { ?>已开启 <?php  } else { ?>未启用<?php  } ?></div>
		</div>
		<div class="action">
			<a class="btn btn-primary" ng-click="setMenu(<?php  echo $menu_display;?>)"><?php  if($menu_display == 1 ) { ?>停用 <?php  } else { ?>启用<?php  } ?></a>
		</div>
	</div>
	<?php  if($menu_display != 1) { ?>
	<div class="platform-menu-close color-gray">
		<i class="wi wi-info"></i>该功能未开启，如需使用请先点击启用
	</div>
	<?php  } else { ?>
	<ul class="we7-page-tab">
		<?php  if(is_array($active_sub_permission)) { foreach($active_sub_permission as $active_menu) { ?>
		<?php  if(permission_check_account_user($active_menu['permission_name'], false) && (empty($active_menu['is_display']) || is_array($active_menu['is_display']) && in_array($_W['account']['type'], $active_menu['is_display']))) { ?>
		<li <?php  if($active_menu['active'] == 'post' && $type == 1 || $do == $active_menu['active'] && $type == 3) { ?>class="active"<?php  } ?>>
			<a href="<?php  echo $active_menu['url'];?>"><?php  echo $active_menu['title'];?></a>
		</li>
		<?php  } ?>
		<?php  } } ?>
	</ul>
	<?php  if($do == 'display') { ?>
	<div class="clearfix" ng-controller="menuDisplay" id="menuDisplay">
		<div class="we7-margin-bottom clearfix">
			<?php  if($type != MENU_CONDITIONAL) { ?>
			<ul class="btn-group-sub" style="margin-bottom: 0;">
				<a href="<?php  echo url('platform/menu/post');?>" class="btn">当前菜单</a>
				<a href="<?php  echo url('platform/menu/display');?>" class="btn active">历史菜单</a>
			</ul>
			<?php  } ?>
			<div class="pull-right">
				<?php  if($type == MENU_CURRENTSELF) { ?>
				<a href="<?php  echo url('platform/menu/post', array('type' => MENU_CURRENTSELF));?>" class="btn btn-primary we7-padding-horizontal">+添加新菜单</a>
				<?php  } else if($type == MENU_CONDITIONAL) { ?>
				<a href="<?php  echo url('platform/menu/post', array('type' => MENU_CONDITIONAL));?>" class="btn btn-primary we7-padding-horizontal">+添加个性化菜单</a>
				<?php  } ?>
			</div>
			<form action="./index.php" method="get" class="form-horizontal col-sm-4 pull-right" role="form">
				<div class="input-group">
					<input type="hidden" name="c" value="platform">
					<input type="hidden" name="a" value="menu">
					<input type="hidden" name="type" value="<?php  echo $_GPC['type'];?>">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
					<input type="text" name="keyword" id="" value="<?php  echo $_GPC['keyword'];?>" class="form-control" placeholder="搜索关键字"/>
					<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
				</div>
			</form>
		</div>
		<table class="table we7-table table-hover vertical-middle we7-form">
			<col width="200px"/>
			<col />
			<col width="180px"/>
			<col width="220px"/>
			<tr>
				<th class="text-left">菜单组名</th>
				<th class="text-left">显示对象</th>
				<th>
					是否在微信生效
					<?php  if($type == MENU_CURRENTSELF) { ?><div class="color-gray">(只能生效一个默认菜单)</div><?php  } ?>
				</th>
				<th class="text-right">操作</th>
			</tr>
			<?php  if(is_array($data)) { foreach($data as $da) { ?>
			<?php  if($da['type'] == MENU_CURRENTSELF && $da['status'] == STATUS_ON) { ?><?php  continue;?><?php  } ?>
			<tr>
				<td class="text-left">
					<?php  if(empty($da['title'])) { ?>
					<?php  if($da['type'] == MENU_CURRENTSELF) { ?>
					默认菜单
					<?php  } else if($da['type'] == MENU_HISTORY) { ?>
					默认菜单(历史记录)
					<?php  } else { ?>
					个性化菜单
					<?php  } ?>
					<?php  } else { ?>
					<?php  echo $da['title'];?>
					<?php  } ?>
				</td>
				<td class="text-left">
					<?php  if($da['type'] == MENU_CONDITIONAL) { ?>
					<?php  if($da['sex'] > 0) { ?>性别:<?php  echo $names['sex'][$da['sex']];?> ;<?php  } ?>
					<?php  if($da['group_id'] != -1) { ?>粉丝标签:<?php  if($da['group_id'] == -1) { ?>不限<?php  } else { ?><?php  echo $groups[$da['group_id']]['name'];?><?php  } ?> ;<?php  } ?>
					<?php  if($da['client_platform_type'] > 0) { ?>客户端:<?php  echo $names['client_platform_type'][$da['client_platform_type']];?> ;<?php  } ?>
					<?php  if(!empty($da['area'])) { ?>地区:<?php  echo $da['area'];?><?php  } ?>
					<?php  } else { ?>
					所有粉丝
					<?php  } ?>
				</td>
				<td>
					<?php  if($da['type'] == MENU_CURRENTSELF) { ?>
					<?php  if($da['status'] == STATUS_OFF) { ?>
					<a href="javascript:;" class="js-switch-<?php  echo $da['id'];?> color-default" data-id="<?php  echo $da['id'];?>" data-status="<?php  echo $da['status'];?>" ng-click="changeStatus(<?php  echo $da['id'];?>, <?php  echo $da['status'];?>, <?php  echo $da['type'];?>)">点击生效</a>
					<?php  } ?>
					<?php  } else { ?>
					<label style="margin: 0; vertical-align: middle;">
						<input name="js-checkbox-<?php  echo $da['id'];?>" id="" class="form-control" type="checkbox"  style="display: none;" data-id="<?php  echo $da['id'];?>" data-status="<?php  echo $da['status'];?>" ng-click="changeStatus(<?php  echo $da['id'];?>, <?php  echo $da['status'];?>, <?php  echo $da['type'];?>)">
						<div class="switch js-switch-<?php  echo $da['id'];?> <?php  if(intval($da['status'] == STATUS_ON)) { ?>switchOn<?php  } ?>"></div>
					<?php  } ?>
					</label>
				</td>
				<td>
					<div class="link-group">
						<?php  if($da['type'] == MENU_CURRENTSELF) { ?>
						<a href="<?php  echo url('platform/menu/post', array('id' => $da['id'], 'type'=> 1));?>">编辑</a>
						<?php  } else { ?>
						<a href="<?php  echo url('platform/menu/post', array('id' => $da['id'], 'type'=> $da['type']));?>">查看</a>
						<?php  } ?>
						<?php  if($da['type'] == MENU_CONDITIONAL) { ?>
						<?php  if($_GPC['status'] != 'history') { ?>
						<a href="<?php  echo url('platform/menu/copy', array('id' => $da['id']));?>" onclick="if(!confirm('确定复制吗')) return false;">复制</a>
						<?php  } ?>
						<?php  } ?>
						<?php  if($da['type'] != MENU_CURRENTSELF || ($da['type'] == MENU_CURRENTSELF && $da['status'] == STATUS_OFF)) { ?>
						<a href="javascript:void(0);" class="del" onclick="deleteMenu('<?php  echo url("platform/menu/delete", array("id" => $da["id"]));?>')">删除</a>
						<?php  } ?>
					</div>
				</td>
			</tr>
			<?php  } } ?>
		</table>
		<div class="text-right">
			<?php  echo $pager;?>
		</div>
	</div>
	<?php  } ?>

	<?php  if($do == 'post') { ?>
	<?php  if($type != MENU_CONDITIONAL && !empty($default_menu)) { ?>
	<ul class="btn-group-sub we7-margin-bottom">
		<a href="<?php  echo url('platform/menu/post');?>" class="btn active">当前菜单</a>
		<a href="<?php  echo url('platform/menu/display');?>" class="btn">历史菜单</a>
	</ul>
	<a href="<?php  echo url('platform/menu/post', array('type' => MENU_CURRENTSELF));?>" class="btn btn-primary pull-right"><span>+</span>添加新菜单</a>
	<?php  } ?>
	<div class="conditionMenu menu-post-page" ng-controller="conditionMenuDesigner" id="conditionMenuDesigner" ng-cloak>
		<div class="new">
			<?php  if(empty($default_menu)) { ?>
			<ol class="breadcrumb we7-breadcrumb">
				<a href="<?php  echo url('platform/menu', array('type' => $_GPC['type']))?>"><i class="wi wi-back-circle"></i></a>
				<li>
					<a href="<?php  echo url('platform/menu', array('type' => $_GPC['type']))?>">自定义菜单</a>
				</li>
				<li>
					<?php  if(!empty($id)) { ?>
					编辑菜单
					<?php  } else { ?>
					新建菜单
					<?php  } ?>
				</li>
			</ol>
			<?php  } ?>
			<div class="we7-form">
				<div class="form-group">
					<label for="" class="control-label col-sm-2">菜单组名称</label>
					<div class="form-controls col-sm-8">
						<input type="text" style="width: 600px" class="form-control" ng-model="context.group.title" ng-disabled="context.group.disabled">
						<span class="help-block">给菜单组起个名字吧！以便查找</span>
					</div>
				</div>
				<?php  if($type != 1) { ?>
				<div class="form-group">
					<label for="" class="control-label col-sm-2">菜单显示对象</label>
					<div class="form-controls col-sm-8" style="z-index: 2">
						<select class="pull-left we7-margin-right" ng-model="context.group.matchrule.sex" ng-disabled="context.group.disabled" <?php  if($params['matchrule']['sex'] == 0) { ?>ng-init="context.group.matchrule.sex = '0'"<?php  } ?>>
							<option value="0" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.sex == 0">性别不限</option>
							<option value="1" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.sex == 1">男</option>
							<option value="2" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.sex == 2">女</option>
						</select>
						<select class="pull-left we7-margin-right" ng-model="context.group.matchrule.group_id" ng-disabled="context.group.disabled" <?php  if($params['matchrule']['group_id'] == -1 || empty($params)) { ?>ng-init="context.group.matchrule.group_id = '-1'"<?php  } ?>>
						<option value="-1" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.group_id == -1">粉丝标签不限</option>
						<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
						<option value="<?php  echo $group['id'];?>" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.group_id == <?php  echo $group['id'];?>"><?php  echo $group['name'];?></option>
						<?php  } } ?>
						</select>
						<select class="pull-left we7-margin-right" ng-model="context.group.matchrule.client_platform_type" ng-disabled="context.group.disabled" <?php  if($params['matchrule']['client_platform_type'] == 0) { ?>ng-init="context.group.matchrule.client_platform_type = '0'"<?php  } ?>>
							<option value="0" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.client_platform_type == 0" >手机系统不限</option>
							<option value="1" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.client_platform_type == 1">IOS(苹果)</option>
							<option value="2" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.client_platform_type == 2">Android(安卓)</option>
							<option value="3" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.client_platform_type == 3">Others(其他)</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-sm-2"></label>
					<div class="form-controls col-sm-8" style="z-index: 1">
						<select class="pull-left we7-margin-right" ng-model="context.group.matchrule.language" ng-disabled="context.group.disabled">
							<option value="" ng-selected="context.group.matchrule.language == ''">语言不限</option>
							<?php  if(is_array($languages)) { foreach($languages as $language) { ?>
							<option value="<?php  echo $language['en'];?>" ng-disabled="context.group.disabled" ng-selected="context.group.matchrule.language == '<?php  echo $language['en'];?>'"><?php  echo $language['ch'];?></option>
							<?php  } } ?>
						</select>
						<span class="tpl-district-container ">
							<select data-value="<?php  echo $menu['data']['matchrule']['province'];?>" ng-model="context.group.matchrule.province" ng-disabled="context.group.disabled" class="tpl-province we7-select pull-left we7-margin-right">
							</select>
							<select data-value="<?php  echo $menu['data']['matchrule']['city'];?>" ng-model="context.group.matchrule.city" ng-disabled="context.group.disabled" class="tpl-city we7-select pull-left we7-margin-right">
							</select>
						</span>
						<div class="clearfix"></div>
						<span class="help-block "> 根据条件对显示对象进行筛选</span>
					</div>
				</div>
				<?php  } ?>
				<div class="menu-setting-area">
					<div class="menu-preview-area">
						<div class="mobile-menu-preview">
							<div class="mobile-hd">{{context.group.type == 3 ? "个性化菜单" : "默认菜单"}}</div>
							<div class="mobile-bd">
								<div class="js-quickmenu nav-menu-wx clearfix" ng-class="{0 : 'has-nav-0', 1 : 'has-nav-1', 2: 'has-nav-2', 3: 'has-nav-3', 4 : 'has-nav-3'}[context.group.button.length + 1]">
									<ul class="designer-x  pre-menu-list">
										<li class="js-sortable pre-menu-item" ng-repeat="but in context.group.button" ng-class="{0 : '', 1 : 'active'}[context.activeItem == but ? 1 : 0 ]">
											<input type="hidden" data-role="parent" data-hash="{{but.$$hashKey}}"/>
											<a href="javascript:void(0);" title="拖动排序"  class="pre-menu-link" ng-click="context.editBut('', but, <?php  echo $id;?>);">
												<i class="icon-menu-dot" ng-show="but.sub_button.length > 0"></i>
												{{but.name}}
											</a>
											<div class="sub-pre-menu-box">
												<ul class="sub-pre-menu-list sub-designer-y">
													<li ng-repeat="subBut in but.sub_button" class='sub-js-sortable'>
														<input type="hidden" data-role="sub" data-hash="{{subBut.$$hashKey}}"/>
														<span class="sub-pre-menu-inner" ng-click="context.editBut(subBut, but, <?php  echo $id;?>);">
														<span>{{subBut.name}}</span>
														</span>
													</li>
													<li ng-if="but.sub_button.length < 5" ng-click="context.addSubBut(but);" class="sub-js-not-sortable"><i class="fa fa-plus"></i></li>
												</ul>
											</div>
										</li>
										<li class="pre-menu-item grid-item js-not-sortable" ng-if="context.group.button.length < 3" ng-hide="context.group.disabled">
											<a href="javascript:void(0);" ng-click="context.addBut();" class="pre-menu-link">
												<i class="icon14-menu-add"></i>
												<span class="">添加菜单</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="menu-form-area">
						<div class="menu-initial-tips tips-global" style="display: none;">点击左侧菜单进行编辑操作</div>
						<div class="portable-editor to-left" style="display: block;">
							<div class="editor-inner">
								<div class="menu-form-hd">
									<span class="pull-left font-defalut">当前菜单</span>
									<div class="text-right">
										<a href="javascript:void(0);" class="color-default" ng-click="context.removeBut(context.activeItem, context.activeType)">删除该菜单</a>
									</div>
								</div>
								<div style="display: none;" class="we7-padding-top color-gray">已添加子菜单，仅可设置菜单名称。</div>
								<div class="we7-form we7-padding-top">
									<div class="form-group">
										<label for="" class="control-label col-sm-2">菜单名称</label>
										<div class="form-controls col-sm-8">
											<div class="input-group">
												<input type="text" name="" class="form-control" placeholder=""  id="title" ng-model="context.activeItem.name" ng-disabled="context.group.disabled">
												<span ng-if="!context.group.disabled" class="input-group-btn bg-default color-default" ng-click="context.selectEmoji();"><a href="javascript:;" class="btn btn-default">添加表情</a></span>
											</div>
											<span class="help-block">字数不超过5个汉字或8个字母</span>
										</div>
									</div>
									<div class="form-group" ng-show="context.activeItem.forceHide == 0">
										<label for="" class="control-label col-sm-2">菜单内容</label>
										<div class="form-controls col-sm-10">
											<input id="radio-1" type="radio" name="ipt" ng-checked="context.activeItem.type == 'media_id' || context.activeItem.type == 'click'" ng-model="context.activeItem.type" value="click" ng-disabled="context.group.disabled">
											<label for="radio-1">发送消息 </label>
											<input id="radio-2" type="radio" name="ipt" ng-model="context.activeItem.type" value="view" ng-disabled="context.group.disabled">
											<?php  if($_W['account']['level'] != ACCOUNT_SUBSCRIPTION) { ?>
											<label for="radio-2">跳转网页 </label>
											<input id="radio-3" type="radio" name="ipt" ng-model="context.activeItem.type" value="scancode_push" ng-disabled="context.group.disabled">
											<?php  } ?>

											<label for="radio-3">扫码 </label>
											<input id="radio-4" type="radio" name="ipt" ng-model="context.activeItem.type" value="scancode_waitmsg" ng-disabled="context.group.disabled">
											<label for="radio-4">扫码（等待信息） </label>
											<input id="radio-5" type="radio" name="ipt" ng-model="context.activeItem.type" value="location_select" ng-disabled="context.group.disabled">
											<label for="radio-5">地理位置 </label>
											<input id="radio-6" type="radio" name="ipt" ng-model="context.activeItem.type" value="pic_sysphoto" ng-disabled="context.group.disabled">
											<label for="radio-6">拍照发图 </label>
											<input id="radio-7" type="radio" name="ipt" ng-model="context.activeItem.type" value="pic_photo_or_album" ng-disabled="context.group.disabled">
											<label for="radio-7">拍照相册</label>
											<input id="radio-8" type="radio" name="ipt" ng-model="context.activeItem.type" value="pic_weixin" ng-disabled="context.group.disabled">
											<label for="radio-8">相册发图 </label>
											<input id="radio-9" type="radio" name="ipt" ng-model="context.activeItem.type" value="miniprogram" ng-disabled="context.group.disabled">
											<label for="radio-9">关联小程序</label>

										</div>
									</div>
									<div class="menu-content" ng-show="(context.activeItem.type == 'view' || context.activeItem.type == 'miniprogram')  && context.activeItem.forceHide == 0">
										<div class="panel we7-panel panel-new">
											<div class="panel-heading">
												<span ng-show="context.activeItem.type == 'view'">跳转网页</span>
												<span ng-show="context.activeItem.type == 'miniprogram'">关联小程序</span>
												<span class="color-gray" ng-show="context.activeItem.type == 'view'">订阅者点击该子菜单会跳转到以下链接</span>
												<span class="color-gray" ng-show="context.activeItem.type == 'miniprogram'">点击该菜单跳转到关联的小程序</span>
											</div>
											<div class="panel-body">
												<div class="form-group" ng-show="context.activeItem.type == 'view'">
													<label for="" class="control-label col-sm-2" >页面地址</label>
													<div class="form-controls col-sm-8" >
														<div class=" input-group">	
														<input type="text" class="form-control" id="ipt-url" type="text" ng-model="context.activeItem.url" ng-disabled="context.group.disabled">
														<span ng-if="!context.group.disabled" class="input-group-btn color-default" id="search" ng-click="context.select_link()"><a class="btn btn-default">选择地址</a> </span>
														</div>
														
														<span class="help-block">指定点击此菜单时要跳转的链接（注：链接需加http://）</span>
													</div>
												</div>
													<!-- 小程序 -->
												<div class="form-group col-sm-12" ng-show="context.activeItem.type == 'miniprogram'">
													<label for="ipt-url-appid" class="control-label col-sm-2">APPID</label>
													<div class="form-controls col-sm-7">
														<input type="text" class="form-control" id="ipt-url-appid" ng-model="context.activeItem.appid" ng-disabled="context.group.disabled" placeholder="请确保小程序与公众号已关联，填写小程序的APPID">
														<span class="help-block">
															<a href="http://weixiao.qq.com/notice/view?mid=0&cid=2&id=274" target="_blank">如何获取</a>
														</span>
													</div>
												</div>
												<div class="form-group col-sm-12" ng-show="context.activeItem.type == 'miniprogram'">
													<label for="ipt-url-pagepath" class="control-label col-sm-2">页面</label>
													<div class="form-controls col-sm-7">
														<input type="text" class="form-control" id="ipt-url-pagepath" ng-model="context.activeItem.pagepath" ng-disabled="context.group.disabled" placeholder="请填写跳转页面的小程序访问路径">
														<span class="help-block"><a href="http://weixiao.qq.com/notice/view?mid=0&cid=2&id=275" target="_blank">填写指引</a></span>
													</div>
												</div>
												<div class="form-group col-sm-12" ng-show="context.activeItem.type == 'miniprogram'">
													<label for="ipt-url-url" class="control-label col-sm-2">备用网页</label>
													<div class="form-controls col-sm-10">
														<input type="text" class="form-control" id="ipt-url-url" ng-model="context.activeItem.url" ng-disabled="context.group.disabled" placeholder="写入要跳转的链接">
														<span class="help-block">旧版微信客户端不支持小程序，用户点击菜单时会打开该网页</span>
													</div>
												</div>
											</div>
										</div>	
										
									</div>
									<div class="panel we7-panel panel-new" ng-show="context.activeItem.type != 'view' && context.activeItem.type != 'click' && context.activeItem.type != 'miniprogram' && context.activeItem.forceHide == 0" style="width:100%;">
										<div class="panel-heading">
											<span ng-show="context.activeItem.type == 'location_select'">地理位置</span>
											<span ng-show="context.activeItem.type == 'pic_sysphoto'">拍照发图</span>
											<span ng-show="context.activeItem.type == 'pic_photo_or_album'">拍照发图</span>
											<span ng-show="context.activeItem.type == 'pic_weixin'">相册发图</span>
											<span ng-show="context.activeItem.type == 'scancode_push'">扫码</span>
											<span ng-show="context.activeItem.type == 'scancode_waitmsg'">扫码（等待信息）</span>
											<span class="color-gray" ng-show="context.activeItem.type == 'location_select'">菜单内容为地理位置，那么点击这个菜单时，系统发送当前地理位置</span>
											<span class="color-gray"  ng-show="context.activeItem.type == 'pic_sysphoto' || context.activeItem.type == 'pic_photo_or_album'">菜单内容为系统拍照发图/拍照或者相册发图，那么点击这个菜单是，系统拍照</span>
											<span class="color-gray" ng-show="context.activeItem.type == 'pic_weixin'">菜单内容为微信相册发图，那么点击这个菜单是，选择图片发送</span>
											<span class="color-gray" ng-show="context.activeItem.type == 'scancode_push' || context.activeItem.type == 'scancode_waitmsg'">菜单内容为扫码，那么点击这个菜单是，手机扫描二维码</span>
										</div>
										<!--<label for="" class="control-label">选择</label>-->
										<div class="panel-body we7-padding">
											
											<ul class="keywords-list">
												<li ng-if="context.activeItem.material[0].etype == 'click'">
													<div>
														<div class="desc">
															<div class="media-content">
																<a class="title-wrp" href="javascript:;">
																	<span class="title">[关键字]{{context.activeItem.material[0].name}}</span>
																</a>
																<p class="desc"><a href="javascript:;" class="appmsg-desc">{{context.activeItem.material[0].content}}</a></p>
															</div>
														</div>
													</div>
												</li>
												<li ng-if="context.activeItem.material[0].etype == 'module'">
													<div class="">
														<div class="desc">
															<div class="media-content">
																<div class="appmsgSendedItem">
																	<a class="title-wrp" href="javascript:;">
																		<span class="icon cover" style="background-image:url({{context.activeItem.material[0].icon}});"></span>
																		<span class="title">[模块]{{context.activeItem.material[0].title}}</span>
																	</a>
																	<p class="desc"><a href="javascript:;" class="appmsg-desc">{{context.activeItem.material[0].name}}</a></p>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>

											<div class=" we7-padding-vertical-max" ng-show="context.activeItem.type == 'scancode_push' || context.activeItem.type == 'scancode_waitmsg' || context.activeItem.type == 'pic_photo_or_album' || context.activeItem.type == 'pic_weixin' || context.activeItem.type == 'location_select' || context.activeItem.type == 'pic_sysphoto'">
												<ul class="tab-reply-list">
													<li class="tab-reply-item tab-cardmsg"  ng-click="context.select_mediaid('keyword', '1');">
														<div>
															<img src="./resource/images/reply/keyword-icon.png" />
															<p class="msg-tab-title">触发关键字</p>
														</div>
													</li>
												</ul>
											</div>

										</div>
									</div>
									<div class="panel we7-panel panel-new" style="width: 100%;" ng-show="context.activeItem.type == 'click' && context.activeItem.forceHide == 0">
										<div class="panel-heading">
											回复内容
										</div>
										<div class="panel-body we7-padding">
											<ul class="keywords-list">
												<li ng-if="context.activeItem.material[0].type == 'keyword' || (context.activeItem.type == 'click' && context.activeItem.key)">
													<div>
														<div class="desc">
															<div class="media-content">
																<a class="title-wrp" href="javascript:;">
																	<span class="title">[关键字]{{context.activeItem.material[0].content ? context.activeItem.material[0].content : context.activeItem.key}}</span>
																</a>
															</div>
														</div>
													</div>
												</li>
												<li ng-if="context.activeItem.material[0].type == 'news'">
													<div class="">
														<div class="desc">
															<div class="media-content">
																<div class="appmsgSendedItem">
																	<a class="title-wrp" href="javascript:;">
																		<span class="icon cover" style="background-image:url({{context.activeItem.material[0].items[0].thumb_url}});"></span>
																		<span class="title">[图文消息]{{context.activeItem.material[0].items[0].title}}</span>
																	</a>
																	<p class="desc"><a href="javascript:;" class="appmsg-desc">{{context.activeItem.material[0].items[0].digest}}</a></p>
																</div>
															</div>
														</div>
													</div>
												</li>
												<li ng-if="context.activeItem.material[0].type == 'image'">
													<div>
														<div class="desc">
															<div class="media-content">
																<div class="appmsgSendedItem">
																	<a class="title-wrp" href="javascript:;">
																		<span class="icon cover" style="background-image:url({{context.activeItem.material[0].url}})"></span>
																		<span class="title">[图片]</span>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</li>
												<li ng-if="context.activeItem.material[0].type == 'voice'">
													<div>
														<div class="desc">
															<div class="media-content">
																<div class="audio-msg">
																	<div class="icon-audio-wrp">
																		<span class="icon-audio-msg"></span>
																	</div>
																	<div class="audio-content">
																		<div class="audio-title">[语音]{{context.activeItem.material[0].filename}}</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>
												<li ng-if="context.activeItem.material[0].type == 'video'">
													<div>
														<div class="desc">
															<div class="media-content">
																<div class="appmsgSendedItem">
																	<a class="title-wrp" href="javascript:;">
																		<span class="icon cover" data-contenturl="'+material.tag.down_url+'"></span>
																		<span class="title">[视频]{{context.activeItem.material[0].tag.title}}</span>
																		<p class="desc"><a href="javascript:;" class="appmsg-desc">{{context.activeItem.material[0].tag.description}}</a></p>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</li>

											</ul>
											<div class=" we7-padding-vertical-max">
												<ul class="tab-reply-list">
													<li class="tab-reply-item tab-appmsg" ng-click="context.select_mediaid('news', 'wx');">
														<div>
															<img src="./resource/images/reply/appmsg-icon.png" />
															<p class="msg-tab-title">图文</p>
														</div>
													</li>
													<li class="tab-reply-item tab-img" ng-click="context.select_mediaid('image');">
														<div>
															<img src="./resource/images/reply/image-icon.png" />
															<p class="msg-tab-title">图片</p>
														</div>
													</li>
													<li class="tab-reply-item tab-audio" ng-click="context.select_mediaid('voice');">
														<div>
															<img src="./resource/images/reply/radio-icon.png" />
															<p class="msg-tab-title">语音</p>
														</div>
													</li>
													<li class="tab-reply-item tab-video" ng-click="context.select_mediaid('video');">
														<div>
															<img src="./resource/images/reply/vedio-icon.png" />
															<p class="msg-tab-title">视频</p>
														</div>
													</li>
													<li class="tab-reply-item tab-cardmsg" ng-click="context.select_mediaid('keyword', '1');">
														<div>
															<img src="./resource/images/reply/keyword-icon.png" />
															<p class="msg-tab-title">触发关键字</p>
														</div>
													</li>

												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<span class="editor-arrow-wrp hidden">
								<i class="editor-arrow editor-arrow-out"></i>
								<i class="editor-arrow editor-arrow-in"></i>
							</span>
						</div>
					</div>
				</div>
				<div class="menu-submit">
					<input type="submit" name="" value="完成" class="btn btn-primary" ng-if="<?php  echo ($type == 1 || empty($id) || $copy == 1)?>" ng-click="context.submit('publish');"/>
					<?php  if(empty($default_menu) && $type == 1) { ?>
					<input type="submit" name="" value="仅保存" class="btn btn-default" ng-if="<?php  echo ($type == 1 || empty($id) || $copy == 1)?>" ng-click="context.submit('save');"/>
					<?php  } ?>
					<input type="button" name="" value="预览" class="btn btn-default" data-toggle="modal" data-target="#mobileDiv"/>
				</div>
				<div class="modal fade" id="mobileDiv" role="dialog" aria-hidden="true">
					<div class="mobile-preview" >
						<div class="mobile-preview-hd">
							<strong class="nickname">{{context.group.type == 3 ? "个性化菜单" : "默认菜单"}}</strong>
						</div>
						<div class="mobile-preview-bd">
							<ul id="viewShow" class="show-list"></ul>
						</div>
						<div class="mobile-preview-ft">
							<ul class="pre-menu-list grid-line" id="viewList">
								<li class="pre-menu-item grid-item" ng-repeat="but in context.group.button" id="menu-0">
									<a href="javascript:void(0);" class="pre-menu-link" title="菜单名称">
										<i class="icon-menu-dot"></i>
										{{but.name}}
									</a>
									<div class="sub-pre-menu-box" style="display: block;">
										<ul class="sub-pre-menu-list">
											<li ng-repeat="subBut in but.sub_button">
												<a href="javascript:void(0);" class="" title="{{subBut.name}}">{{subBut.name}}</a>
											</li>
										</ul>
										<i class="arrow arrow-out"></i>
										<i class="arrow arrow-in"></i>
									</div>
								</li>
							</ul>
						</div>
						<a href="javascript:void(0);" class="mobile-preview-closed btn btn-default" id="viewClose" data-dismiss="modal">退出预览</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php  } ?>
	<?php  } ?>
</div>
<script type="text/javascript">
	function deleteMenu(url) {
		util.confirm(function () {
			window.location.href = url;
		}, function () {
			return false;
		}, '删除默认菜单会清空所有菜单记录，确定吗？?');
	}
	$(function(){
		var push_url = "<?php  echo url('platform/menu/push')?>";
		type = "<?php  echo $type;?>";
		group = <?php echo !empty($params) ? json_encode($params) : "null"?>;
		id = "<?php  echo $id;?>";
		status = "<?php  echo $params['status'];?>";
		delete_url = "<?php  echo url('platform/menu/delete', array('id' => $id));?>";
		set_menu_url = "<?php  echo url('platform/menu/set_menu')?>";
		success_url = "<?php  echo url('platform/menu/display');?>";
		site_url = "<?php  echo $_W['siteroot'];?>";
		current_menu_url = "<?php  echo url('platform/menu/current_menu')?>";
		angular.module('menuApp').value('config', {
			'id' : id,
			'status' : status,
			'group' : group,
			'type' : type,
			'delete_url' : delete_url,
			'success_url' : success_url,
			'site_url' : site_url,
			'push_url' : push_url,
			'set_menu_url': set_menu_url,
			'current_menu_url' : current_menu_url
		});
		angular.bootstrap($('#wechat_menu'), ['menuApp']);
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>