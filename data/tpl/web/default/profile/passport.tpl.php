<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('profile/common', TEMPLATE_INCLUDEPATH)) : (include template('profile/common', TEMPLATE_INCLUDEPATH));?>
<div id="js-profile-passport" ng-controller="oauthCtrl" ng-cloak>
	<table class="table we7-table table-form">
		<col width="180px " />
		<col />
		<col width="100px" />
		<tr>
			<th>公众平台oAuth设置</th>
			<th></th>
			<th></th>
		</tr>
		<?php  if($_W['account']['level'] != ACCOUNT_SERVICE_VERIFY) { ?>
			<tr>
				<td class="text-left">
					选择公众号
				</td>
				<td class="text-left color-gray" ng-bind="oauthtitle"></td>
				<td >
					<div class="link-group"><a href="javascript:;" data-toggle="modal" data-type="oauth" data-target="#jsauth_acid">修改</a></div>
				</td>
			</tr>
		<?php  } ?>
		<tr>
			<td class="text-left">
				oAuth独立域名
			</td>
			<td class="text-left color-gray" ng-bind="originalHost"></td>
			<td >
				<div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#host">修改</a></div>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="host" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">oAuth独立域名</div>
				</div>
				<div class="modal-body">
					<div class="form-group we7-form">
						<input type="text"  name="host" ng-model="oauthHost" class="form-control" placeholder="oAuth独立域名">
						<span class="help-block">适用于您的微站或是活动有多个域名的情况下，由此域名做统一的oauth授权用。例如：http://www.baidu.com 注意：结尾没有/ </span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveOauth('oauth')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" ng-click="recover()">取消</button>
				</div>
			</div>
		</div>
	</div>

	<table class="table we7-table table-form">
		<col width="180px " />
		<col />
		<col width="100px" />
		<tr>
			<th>借用 JS 分享设置</th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<td class="text-left">
				选择公众号
			</td>
			<td class="text-left color-gray" ng-bind="jsOauthtitle"></td>
			<td >
				<div class="link-group"><a href="javascript:;" data-toggle="modal" data-type="jsoauth" data-target="#jsauth_acid">修改</a></div>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="jsauth_acid" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog oauth-account-modal">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">选择借权公众号</div>
				</div>
				<div class="modal-body oauth-account-modal-box">
					<div class="alert we7-page-alert" ng-if="changeType == 'oauth'">
					在微信公众号请求用户网页授权之前，开发者需要先到公众平台网站的【公众号设置】 / 【功能设置】中配置授权回调域名。</div>
					<div class="alert we7-page-alert" ng-if="changeType == 'jsoauth'">
						在系统中使用微信分享接口前，开发者需要先到公众平台网站的【公众号设置】 / 【功能设置】中配置 【JS 接口安全域名】。</div>
					<div class="search-box we7-form">
						<div class="search-form">
							<div class="input-group ">
								<input type="text" name="keyword" id="" ng-model="keyword" class="form-control" placeholder="输入公众号名称"/>
								<span class="input-group-btn" ng-click="getList()"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
							</div>
						</div>
						<input type="checkbox" ng-model="accountNull" ng-change="checkNull()" id="account-none">
						<label for="account-none">不借用任何权限</label>
					</div>
					<div class="account-list">
						<div class="account-item" ng-repeat="item in accountList" ng-class="{active: item.uniacid == changeAccount && !accountNull}" ng-click="checkItem(item)" ng-style="{}">
							<!-- <div ng-style="{'background-image' : 'url('+item.logo+')'}" class="account-logo"></div>
							 -->
							 <img ng-src="{{item.logo}}" class="account-logo account-img" alt="">
							<div class="account-name text-over">{{item.name}}</div>
							<div class="mask">
								<span class="center wi wi-right"></span>
							</div>
						</div>
					</div>
					<div class="pull-right">
						<we7-page conf="page"></we7-page>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveOauth()">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	angular.module('profileApp').value('config', {
		'oauthAccount' : "<?php echo empty($oauth['account']) ? '' : $oauth['account']?>",
		'oauthHost' : "<?php echo empty($oauth['host']) ? '' : $oauth['host']?>",
		'jsOauth' : "<?php  echo $jsoauth;?>",
		'oauthAccounts' : <?php  echo json_encode($oauth_accounts)?>,
		'jsOauthAccounts' : <?php  echo json_encode($jsoauth_accounts)?>,
		'oauth_url' : "<?php  echo url('profile/passport/save_oauth')?>",
		'get_accounts_url' : "<?php  echo url('profile/passport/oauth_accounts')?>",
		'get_setting_url' : "<?php  echo url('profile/passport/get_setting')?>"
	});
	angular.bootstrap($('#js-profile-passport'), ['profileApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>