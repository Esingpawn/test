<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="we7-page-tab">
	<?php  if(is_array($active_sub_permission)) { foreach($active_sub_permission as $active_menu) { ?>
	<?php  if(permission_check_account_user($active_menu['permission_name'], false) && (empty($active_menu['is_display']) || is_array($active_menu['is_display']) && in_array($_W['account']['type'], $active_menu['is_display']))) { ?>
	<li <?php  if($action == $active_menu['active']) { ?>class="active"<?php  } ?>><a href="<?php  echo $active_menu['url'];?>"><?php  echo $active_menu['title'];?></a></li>
	<?php  } ?>
	<?php  } } ?>
</ul>
<div class="main" id="js-profile-refund" ng-controller="refundCtrl" ng-cloak>
	<form id="form21" action="" method="post" class="we7-form form" enctype="multipart/form-data">
		<table class="we7-table table-hover table-form">
			<col width="150px"/>
			<col />
			<col width="150px"/>
			<tr>
				<th colspan="4">微信退款设置</th>
			</tr>
			<tr>
				<td>微信退款</td>
				<td class="color-gray"></td>
				<td class="color-gray">{{ wechat_refund.switch == 1 ? '开启' :  '关闭' }}</td>
				<td class="text-right">
					<div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#wechat_refund">修改</a></div>
				</td>
			</tr>
		</table>

		<table class="we7-table table-hover table-form">
			<col width="150px"/>
			<col />
			<col width="150px"/>
			<tr>
				<th colspan="4">支付宝退款设置</th>
			</tr>
			<tr>
				<td>支付宝退款</td>
				<td class="color-gray"></td>
				<td class="color-gray">{{ ali_refund.switch == 1 ? '开启' :  '关闭' }}</td>
				<td class="text-right">
					<div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#ali_refund">修改</a></div>
				</td>
			</tr>
		</table>
	</form>
	<div class="modal fade" id="ali_refund" tabindex="-1" role="dialog" aria-hidden="true" ng-cloak>
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<form action="<?php  echo url('profile/refund/save_setting')?>" id="form_ali" method="post" class="we7-form form" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div class="modal-title">支付宝退款设置</div>
					</div>
					<div class="modal-body">
						<div class="alert alert-warning">
							商户私钥生成教程 <a href="//opendocs.alipay.com/open/58/103242" class="color-default" target="_blank">去查看</a>
						</div>
						<div class="we7-form">
							<div class="form-group">
								<label for="" class="control-label col-sm-3"><span class="pull-right">支付宝退款设置</span></label>
								<div class="form-controls col-sm-7 pull-right">
									<input type="radio" id="radio-wechat-3" name="param[switch]" value="1" ng-checked="ali_refund.switch == 1" ng-click="change_switch('ali_refund', 1)"/>
									<label for="radio-wechat-3">开启 </label>
									<input type="radio" id="raido-wechat-4" name="param[switch]" value="0" ng-checked="ali_refund.switch != 1" ng-click="change_switch('ali_refund', 0)"/>
									<label for="raido-wechat-4">关闭 </label>
								</div>
							</div>
							<input type="hidden" name="type" value="ali_refund">
							<div class="form-group">
								<label for="" class="control-label col-sm-3"><span class="pull-right">app_id</span></label>
								<div class="form-controls col-sm-4" style="margin-left: 10ex;">
									<input type="text" class="form-control" name="param[app_id]" value="" ng-model="ali_refund.app_id">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-5">rsa_private_key.pem 证书</label>
								<span class="text-success  col-sm-4">{{ ali_refund.private_key != '' && ali_refund.private_key != undefind ? '已上传' : '' }}</span>
								<div class="form-controls col-sm-3">
									<input type="file" id="private_key" class="hidden" name="private_key">
									<a class="color-default" href="javascript:;" onclick="private_key.click()">上传证书</a>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">确定</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="wechat_refund" tabindex="-1" role="dialog" aria-hidden="true" ng-cloak>
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<form action="<?php  echo url('profile/refund/save_setting')?>" method="post" class="we7-form form" id="form_wechat" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div class="modal-title">微信退款设置</div>
					</div>
					<div class="modal-body">
						<div class="we7-form">
							<div class="alert alert-warning">
								证书:<br/>
								使用微信退款功能需要上传双向证书。<br/>
								证书下载方式:<br>
								微信商户平台(pay.weixin.qq.com)-->账户中心-->账户设置-->API安全-->证书下载。<br>
								我们仅用到apiclient_cert.pem 和 apiclient_key.pem这两个证书<br>

							</div>
							<div class="alert alert-warning">
								接口:<br/>
								支付回调URL: <?php  echo $_W['siteroot'];?>payment/wechat/refund.php
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-3"><span class="pull-right">微信退款</span></label>
								<div class="form-controls col-sm-7 pull-right">
									<input type="radio" id="radio-wechat-1" name="param[switch]" value="1" ng-checked="wechat_refund.switch == 1" ng-click="change_switch('wechat_refund', 1)"/>
									<label for="radio-wechat-1">开启 </label>
									<input type="radio" id="raido-wechat-0" name="param[switch]" value="0" ng-checked="wechat_refund.switch != 1" ng-click="change_switch('wechat_refund', 0)"/>
									<label for="raido-wechat-0">关闭 </label>
								</div>
							</div>
							<input type="hidden" name="type" value="wechat_refund">
							<div class="form-group">
								<label for="" class="control-label col-sm-5">apiclient_cert.pem 证书</label>
								<span class="text-success  col-sm-4">{{ wechat_refund.cert != '' && wechat_refund.cert != undefind ? '已上传' : '' }}</span>
								<div class="form-controls col-sm-3 pull-right">
									<input type="file" id="cert" class="hidden" name="cert">
									<a class="color-default" href="javascript:;" onclick="cert.click()">上传证书</a>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-5">apiclient_key.pem 证书</label>
								<span class="text-success  col-sm-4">{{ wechat_refund.key != '' && wechat_refund.key != undefind ? '已上传' : '' }}</span>
								<div class="form-controls col-sm-3pull-right">
									<input type="file" id="key" class="hidden" name="key">
									<a class="color-default" href="javascript:;" onclick="key.click()">上传证书</a>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">确定</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
<script>
	angular.module('profileApp').value('config', {
		'setting' : <?php  echo json_encode($setting)?>,
	});
	angular.bootstrap($('#js-profile-refund'), ['profileApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>