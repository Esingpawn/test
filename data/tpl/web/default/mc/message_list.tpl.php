<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="js-profile-message" ng-controller="mcMessageListCtrl" ng-cloak>
<ul class="we7-page-tab">
	<li class="active">
		<a href="<?php  echo url('mc/message')?>" >留言管理</a>
	</li>
</ul>
<div class="alert alert-info we7-page-alert">
	<i class="wi wi-info-sign"></i> 使用平台的定时群发功能发送图文素材，并且保证微信公众号已开通留言管理功能！<br>
</div>
<div class="article-list-panel">
	<table class="table we7-table table-hover article-list vertical-middle">
		<col width="80px"/>
		<col />
		<col width="220px"/>
		<col width="120px"/>
		<tr>
			<th>排序</th>
			<th class="text-left">标题</th>
			<th class="text-center">是否开启留言功能</th>
			<th class="text-right">操作</th>
		</tr>
		<tr ng-if="lists == '' || lists == undefined">
			<td colspan="4" class="text-center">暂无数据</td>
		</tr>
		<tr ng-repeat="new in lists">
			<td ng-bind="$index"></td>
			<td class="text-left"><div  class="text-over" style="max-width: 220px" ng-bind="new.title"></div></td>
			<td class="text-center">
				<label>
					<div ng-class="{1:'switch switchOn', 0:'switch switchOff'}[new.need_open_comment]" id="key-1390" ng-click="switch(new)"></div>
				</label>
			</td>
			<td>
				<div class="link-group">
					<a href="javascript:void(0);" ng-click="getMessageInfo(new.index, new.msg_data_id)">查看留言</a>
				</div>
			</td>
		</tr>
	</table>
</div>
</div>
<script>
	angular.module('profileApp').value('config', {
		'lists' : <?php  echo json_encode($news_arr)?>,
		'getMessageInfoUrl' : "<?php  echo url('mc/message/message_info')?>",
		'switchMessageUrl' : "<?php  echo url('mc/message/message_switch')?>",
	});
	angular.bootstrap($('#js-profile-message'), ['profileApp']);
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>