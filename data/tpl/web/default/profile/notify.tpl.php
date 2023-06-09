<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('profile/common', TEMPLATE_INCLUDEPATH)) : (include template('profile/common', TEMPLATE_INCLUDEPATH));?>
<div id="js-profile-notify" ng-controller="emailCtrl" ng-cloak>
	<table class="table we7-table table-form">
		<colgroup>
			<col width="150px">
		</colgroup>
		<tr>
			<th >服务器设置</th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<td>网易邮箱服务器</td>
			<td class="color-gray">
				<span ng-if="setting_type == '163'">已开启</span>
				<span ng-if="setting_type != '163'">未开启</span>
			</td>
			<td>
				<div class="link-group">
					<a ng-click="changeType('163')" href="javascript:;">修改</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>qq邮箱服务器</td>
			<td class="color-gray">
				<span ng-if="setting_type == 'qq'">已开启</span>
				<span ng-if="setting_type != 'qq'">未开启</span>
			</td>
			<td>
				<div class="link-group">
					<a ng-click="changeType('qq')" href="javascript:;">修改</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>自定义</td>
			<td class="color-gray">
				<span ng-if="setting_type == 'custom'">已开启</span>
				<span ng-if="setting_type != 'custom'">未开启</span>
			</td>
			<td>
				<div class="link-group">
					<a ng-click="changeType('custom')" href="javascript:;">修改</a>
				</div>
			</td>
		</tr>
	</table>

	<div class="modal fade" id="setting-from" tabindex="-1" role="dialog" aria-hidden="true">
		<form action="" method="post">
			<div class="we7-modal-dialog modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div class="modal-title">{{modalTitle}}参数设置</div>
					</div>
					<div class="modal-body overflow-auto">
						<div class="we7-form">
							<div class="form-group">
								<label class="control-label col-sm-2">是否开启</label>
								<div class="form-controls col-sm-10">
									<input type="hidden" name="type" value="{{type}}">
									<input id='status-1' type="radio" name="status" value="1" ng-checked="setting.smtp.type == type"/>
									<label for="status-1">是</label>
									<input id='status-2' type="radio" name="status" value="0" ng-checked="setting.smtp.type != type"/>
									<label for="status-2">否</label>
								</div>
							</div>
							<div class="form-group" ng-show="type == 'custom'">
								<label class="control-label col-sm-2">SMTP服务器地址</label>
								<div class="form-controls col-sm-10">
									<input type="text"  name="smtp[server]" value="{{setting.smtp.server}}" class="form-control">
									<span class="help-block">指定SMTP服务器的地址 </span>
								</div>
							</div>
							<div class="form-group" ng-show="type == 'custom'">
								<label class="control-label col-sm-2">SMTP服务器端口</label>
								<div class="form-controls col-sm-10">
									<input type="text" name="smtp[port]" value="{{setting.smtp.port}}" class="form-control">
									<span class="help-block">指定SMTP服务器的端口 </span>
								</div>
							</div>
							<div class="form-group" ng-show="type == 'custom'">
								<label class="control-label col-sm-2">使用SSL加密</label>
								<div class="form-controls col-sm-10  form-control-static">
									<input id='radio-11' type="radio" name="smtp[authmode]" value="1" ng-checked="setting['smtp']['authmode'] == 1" />
									<label for="radio-11">是</label>
									<input id='radio-12' type="radio" name="smtp[authmode]" value="0" ng-checked="!setting.smtp.authmode || setting.smtp.authmode == 0"/>
									<label for="radio-12">否</label>
									<span class="help-block">开启此项后，连接将用SSL的形式，此项需要SMTP服务器支持</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">发送帐号用户名</label>
								<div class="form-controls col-sm-10">
									<input type="text" name="username" ng-model="setting.username" class="form-control">
									<span class="help-block">指定发送邮件的用户名，例如：test@163.com </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">smtp客户端授权密码</label>
								<div class="form-controls col-sm-10">
									<input type="password" name="password" ng-model="setting.password" class="form-control">
									<span class="help-block">
										指定发送邮件的密码，QQ邮箱此处为授权码，
										<a href="http://service.mail.qq.com/cgi-bin/help?subtype=1&amp;&amp;id=28&amp;&amp;no=1001256" target="_Blank">查看授权码获取方法</a>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">发件人名称</label>
								<div class="form-controls col-sm-10">
									<input type="text"  name="sender" value="{{setting.sender}}" class="form-control">
									<span class="help-block">指定发送邮件发信人名称 </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">邮件签名</label>
								<div class="form-controls col-sm-10">
									<textarea rows="5" name="signature" class="form-control">{{setting.signature}}</textarea>
									<span class="help-block">指定邮件末尾添加的签名信息 </span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						<input type="submit" name="submit" value="确定" class="btn btn-primary" />
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	angular.module('profileApp').value('config', {
		'setting' : <?php echo empty($notify['mail']) ? json_encode(array()) : json_encode($notify['mail'])?>,
	});
	angular.bootstrap($('#js-profile-notify '), ['profileApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
