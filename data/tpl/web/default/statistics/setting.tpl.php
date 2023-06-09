<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="we7-page-tab">
	<?php  if(is_array($active_sub_permission)) { foreach($active_sub_permission as $active_menu) { ?>
	<?php  if(permission_check_account_user($active_menu['permission_name'], false) && (empty($active_menu['is_display']) || is_array($active_menu['is_display']) && in_array($_W['account']['type'], $active_menu['is_display']))) { ?>
	<li <?php  if($action == $active_menu['active']) { ?>class="active"<?php  } ?>><a href="<?php  echo $active_menu['url'] . 'version_id=' . $_GPC['version_id']?>"><?php  echo $active_menu['title'];?></a></li>
	<?php  } ?>
	<?php  } } ?>
</ul>
<div id="js-statistics-setting" ng-controller="statisticsSettingCtrl" ng-cloak>
	<div class="panel we7-panel statistics-panel">
		<div class="panel-heading">API访问流量总计</div>
		<div class="panel-body">
			<div class="statistics-info">
				<div class="statistics-info__title color-gray">可用API访问量</div>
				<div class="statistics-info__num">
					<span class="num color-default"><?php  echo $total_remain_num;?></span>次
					<a href="<?php  echo url('home/welcome/ext', array('m' => 'store'))?>" class="btn btn-primary">去购买</a>
				</div>
				<div class="statistics-info__desc">
					<div class="buy item">
						<div class="item__header color-gray">付费流量剩余</div>
						<div class="item__num">
							<?php echo $highest_api_visit- $month_use >= 0 ? $order_num : ($order_num + $highest_api_visit - $statistics_setting['use'] >= 0 ? $order_num + $highest_api_visit - $statistics_setting['use'] : 0)?> 次</div>
					</div>
					<div class="item bold">
						+
					</div>
					<div class="buy item">
						<div class="item__header color-gray">本月赠送<i class="wi wi-info color-red" data-trigger="hover" data-title="月赠送说明" data-toggle="popover" data-placement="bottom" data-content="创始人设置的该平台的每月免费使用API访问流量数月末将清零"></i></div>
						<div class="item__num"><?php  echo $highest_api_visit;?>次</div>
					</div>
					<div class="item bold">
						-
					</div>
					<div class='buy item'>
						<div class="item__header color-gray">本月使用</div>
						<div class="item__num"><?php echo empty($statistics_setting['founder']) ? '不统计' : $month_use . '次'?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<table class="table we7-table statistics-table table-hover table-form">
		<col  width="300px"/>
		<col />
		<tr>
			<th class="text-left" colspan="3">每日访问流量设置</th>
		</tr>
		<tr>
			<td class="color-gray">每日最高访问次数</td>
			<td ng-if="setting"><span ng-bind="setting"></span><span class="color-gray"> 次 / 天</span></td>
			<td ng-if="!setting">不限次数</span></td>
			<td >
				<div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#edit-setting" ng-click="editInfo('visit', setting)">修改</a></div>
			</td>
		</tr>
		<tr>
			<td class="color-gray">检测时间间隔</td>
			<td ng-if="interval"><span ng-bind="interval"></span><span class="color-gray"> 秒</span></td>
			<td ng-if="!interval">无间隔</span></td>
			<td >
				<div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#edit-setting-time" ng-click="editInfo('interval', interval)">修改</a></div>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="edit-setting" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">每天最高访问次数</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="number" ng-model="newVisitVal" step="1" class="form-control">
						<span class="help-block">设置为0，表示每天最高访问次数在创始人设置的每月该平台访问总次数内；</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveSetting('visit')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-setting-time" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">检测时间间隔（单位：秒）</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="number" ng-model="newInterval" step="1" class="form-control">
						<span class="help-block">
							设置为0，表示每次访问都要判断是否超过设定值（精确限制访问量，但会增加服务器压力）；<br>
							建议值：600，即每10分钟进行一次检测（模糊限制访问量，与设定值会存在一定误差，但服务器压力小）。
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveSetting('interval')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	angular.module('statisticsApp').value('config', {
		'highest_visit': <?php echo !empty($highest_visit) ? json_encode($highest_visit) : 'null'?>,
		'interval': <?php echo !empty($interval) ? json_encode($interval) : 'null'?>,
		'links': {
			'editSetting': "<?php  echo url('statistics/setting/edit_setting')?>",
		},
	});
	angular.bootstrap($('#js-statistics-setting'), ['statisticsApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>