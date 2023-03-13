<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'display') { ?>
<ul class="we7-page-tab">
	<?php  if(is_array($active_sub_permission)) { foreach($active_sub_permission as $active_menu) { ?>
	<?php  if(permission_check_account_user($active_menu['permission_name'], false) && (empty($active_menu['is_display']) || is_array($active_menu['is_display']) && in_array($_W['account']['type'], $active_menu['is_display']))) { ?>
	<li <?php  if($action == $active_menu['active']) { ?>class="active"<?php  } ?>><a href="<?php  echo $active_menu['url'];?>"><?php  echo $active_menu['title'];?></a></li>
	<?php  } ?>
	<?php  } } ?>
</ul>
<div class="js-profile-payment" ng-controller="paymentCtrl" ng-cloak>
	<table class="table we7-table table-hover table-form">
		<col width="240px " />
		<col />
		<col />
		<col />
		<col width="100px" />
		<tr>
			<th colspan="1" >支付参数</th>
			<th colspan="1" >充值</th>
			<th colspan="1" >支付</th>
			<th colspan="1" >参数配置</th>
			<th colspan="1" >支付/充值支持</th>
			<th colspan="1" >操作</th>
		</tr>
		<tr>
			<td colspan="1">
				货到支付
			</td>
			<td>
				<input name="" ng-disabled="paysetting['delivery'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('delivery', 'recharge_switch')" ng-if="paysetting['delivery'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
				<div ng-click="switchStatus('delivery', 'recharge_switch')" ng-class="paysetting['delivery'].recharge_switch === true || paysetting['delivery'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['delivery'].recharge_set === true"></div>
				<div ng-class="paysetting['delivery'].recharge_switch === true || paysetting['delivery'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-disabled="true" style="cursor:no-drop" ng-if="paysetting['delivery'].recharge_set == false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('delivery', 'pay_switch')">
				<div ng-click="switchStatus('delivery', 'pay_switch')" ng-class="paysetting['delivery'].pay_switch === true || paysetting['delivery'].pay_switch === 'true' ? 'switch switchOn' : 'switch'"></div>
			</td>
			<td>
				<span class="we7-circle"></span>无需配置
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;">— —</a>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				余额支付
			</td>
			<td>
				<input name="" ng-disabled="paysetting['credit'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('credit', 'recharge_switch')" ng-if="paysetting['credit'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
				<div ng-click="switchStatus('credit', 'recharge_switch')" ng-class="paysetting['credit'].recharge_switch === true || paysetting['credit'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['credit'].recharge_set === true"></div>
				<div ng-class="paysetting['credit'].recharge_switch === true || paysetting['credit'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-disabled="true" style="cursor:no-drop" ng-if="paysetting['credit'].recharge_set == false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('credit', 'pay_switch')">
				<div ng-click="switchStatus('credit', 'pay_switch')" ng-class="paysetting['credit'].pay_switch === true || paysetting['credit'].pay_switch === 'true' ? 'switch switchOn' : 'switch'"></div>
			</td>
			<td>
				<span class="we7-circle"></span>无需配置
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" >— —</a>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				混合支付<i class="wi wi-info color-red" data-trigger="click" data-title="混合支付说明" data-toggle="popover" data-placement="bottom" data-content="余额不足时，可用剩余余额付部分，用其它支付付剩余部分"></i>
			</td>
			<td>
				<input name="" ng-disabled="paysetting['mix'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('mix', 'recharge_switch')" ng-if="paysetting['mix'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
				<div ng-click="switchStatus('mix', 'recharge_switch')" ng-class="paysetting['mix'].recharge_switch === true || paysetting['mix'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['mix'].recharge_set === true"></div>
				<div ng-class="paysetting['mix'].recharge_switch === true || paysetting['mix'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-disabled="true" style="cursor:no-drop" ng-if="paysetting['mix'].recharge_set == false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('mix', 'pay_switch')">
				<div ng-click="switchStatus('mix', 'pay_switch')" ng-class="paysetting['mix'].pay_switch === true || paysetting['mix'].pay_switch === 'true' ? 'switch switchOn' : 'switch'"></div>
			</td>
			<td>
				<span class="we7-circle"></span>无需配置
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" >— —</a>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				支付宝支付<i class="wi wi-info color-red" data-trigger="click" data-title="支付宝支付说明" data-toggle="popover" data-placement="bottom" data-content="开启支付宝支付"></i>
			</td>
			<td>
				<input name="" ng-disabled="paysetting['alipay'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('alipay', 'recharge_switch')" ng-if="paysetting['alipay'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>

				<div ng-click="switchStatus('alipay', 'recharge_switch')" ng-class="paysetting['alipay'].recharge_switch === true || paysetting['alipay'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['alipay'].recharge_set === true"></div>
				<div ng-class="paysetting['alipay'].recharge_switch === true || paysetting['alipay'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" style="cursor:no-drop"  ng-if="paysetting['alipay'].recharge_set == false"></div> <!--此处改成elseif-->
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('alipay', 'pay_switch')">
				<div ng-click="switchStatus('alipay', 'pay_switch')" ng-class="paysetting['alipay'].pay_switch === true || paysetting['alipay'].pay_switch === 'true' ? 'switch switchOn' : 'switch'"></div>
			</td>
			<td>
				<span ng-class="paysetting['alipay'].has_config === true ? 'we7-circle success' : 'we7-circle '"></span>{{  paysetting['alipay'].has_config === true ? '已配置' : '未配置'  }}
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" data-toggle="modal" data-target="#zhifubao">
						{{  paysetting.alipay.has_config === true ? '修改配置' : '去配置'  }}
					</a>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				微信支付<i class="wi wi-info color-red" data-trigger="click" data-title="微信支付说明" data-toggle="popover" data-placement="bottom" data-content="接口类型:新版(2014年9月之后申请的)。"></i>
			</td>
			<td>
				<input name="" ng-disabled="paysetting['wechat'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('wechat', 'recharge_switch')" ng-if="paysetting['wechat'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
				<div ng-click="switchStatus('wechat', 'recharge_switch')" ng-class="paysetting['wechat'].recharge_switch === true || paysetting['wechat'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['wechat'].recharge_set === true"></div>
				<div ng-class="paysetting['wechat'].recharge_switch === true || paysetting['wechat'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-disabled="true" style="cursor:no-drop" ng-if="paysetting['wechat'].recharge_set == false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('wechat', 'pay_switch')">
				<div ng-click="switchStatus('wechat', 'pay_switch')" ng-class="paysetting['wechat'].pay_switch === true || paysetting['wechat'].pay_switch === 'true' ? 'switch switchOn' : 'switch'"></div>
			</td>
			<td>
				<span ng-class="paysetting['wechat'].has_config === true ? 'we7-circle success' : 'we7-circle '"></span>{{  paysetting['wechat'].has_config === true ? '已配置' : '未配置'  }}
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" ng-click="check_wechat()">
						{{  paysetting.wechat.has_config === true ? '修改配置' : '去配置'  }}
					</a>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>
				服务商支付
			</td>
			<td>
				<input name="" class="form-control" type="checkbox" style="display: none;">
				<div class="switch switchOn" style="cursor:no-drop" ng-if="paysetting.wechat_facilitator.switch === true"></div>
				<div class="switch" style="cursor:no-drop" ng-if="paysetting.wechat_facilitator.switch === false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox" style="display: none;">
				<div class="switch switchOn" style="cursor:no-drop" ng-if="paysetting.wechat_facilitator.switch === true"></div>
				<div class="switch" style="cursor:no-drop" ng-if="paysetting.wechat_facilitator.switch === false"></div>
			</td>
			<td>
				<span ng-class="paysetting['wechat_facilitator'].has_config === true ? 'we7-circle success' : 'we7-circle '"></span>{{  paysetting['wechat_facilitator'].has_config === true ? '已配置' : '未配置'  }}
			</td>
			<td>无需设置</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" class="color-default" data-toggle="modal" data-target="#wechat_fa">
						{{  paysetting.wechat_facilitator.has_config === true ? '修改配置' : '去配置'  }}
					</a>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>
				一码支付
			</td>
			<td>
				<input name="" ng-disabled="paysetting['jueqiymf'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('jueqiymf', 'recharge_switch')" ng-if="paysetting['jueqiymf'].has_config === true && paysetting['jueqiymf'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
				<div ng-click="switchStatus('jueqiymf', 'recharge_switch')" ng-class="paysetting['jueqiymf'].recharge_switch === true || paysetting['jueqiymf'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['jueqiymf'].has_config === true && paysetting['jueqiymf'].recharge_set === true"></div>
				<div ng-class="paysetting['jueqiymf'].recharge_switch === true || paysetting['jueqiymf'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-disabled="true" style="cursor:no-drop" ng-if="paysetting['jueqiymf'].has_config === false || paysetting['jueqiymf'].recharge_set == false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('jueqiymf', 'pay_switch')">
				<div ng-click="switchStatus('jueqiymf', 'pay_switch')" ng-class="paysetting['jueqiymf'].pay_switch === true || paysetting['jueqiymf'].pay_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['jueqiymf'].has_config === true "></div>
				<div ng-class="paysetting['jueqiymf'].pay_switch === true || paysetting['jueqiymf'].pay_switch === 'true' ? 'switch switchOn' : 'switch'" style="cursor:no-drop" ng-if="paysetting['jueqiymf'].has_config === false "></div>
			</td>
			<td >
				<span ng-class="paysetting['jueqiymf'].has_config === true ? 'we7-circle success' : 'we7-circle '"></span>{{  paysetting['jueqiymf'].has_config === true ? '已配置' : '未配置'  }}
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" data-toggle="modal" data-target="#jueqiymf">
						{{  paysetting.jueqiymf.has_config === true ? '修改配置' : '去配置'  }}
					</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				银联支付
			</td>
			<td>
				<input name="" ng-disabled="paysetting['unionpay'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('unionpay', 'recharge_switch')" ng-if="paysetting['unionpay'].has_config === true && paysetting['unionpay'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
				<div ng-click="switchStatus('unionpay', 'recharge_switch')" ng-class="paysetting['unionpay'].recharge_switch === true || paysetting['unionpay'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['unionpay'].has_config === true && paysetting['unionpay'].recharge_set === true"></div>
				<div ng-class="paysetting['unionpay'].recharge_switch === true || paysetting['unionpay'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-disabled="true" style="cursor:no-drop" ng-if="paysetting['unionpay'].has_config === false || paysetting['unionpay'].recharge_set == false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('unionpay', 'pay_switch')">
				<div ng-click="switchStatus('unionpay', 'pay_switch')" ng-class="paysetting['unionpay'].pay_switch === true || paysetting['unionpay'].pay_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['unionpay'].has_config === true"></div>
				<div ng-class="paysetting['unionpay'].pay_switch === true || paysetting['unionpay'].pay_switch === 'true' ? 'switch switchOn' : 'switch'" style="cursor:no-drop" ng-if="paysetting['unionpay'].has_config === false"></div>
			</td>
			<td >
				<span ng-class="paysetting['unionpay'].has_config === true ? 'we7-circle success' : 'we7-circle '"></span>{{  paysetting['unionpay'].has_config === true ? '已配置' : '未配置'  }}
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" data-toggle="modal" data-target="#yinlian">
						{{  paysetting.unionpay.has_config === true ? '修改配置' : '去配置'  }}
					</a>
				</div>
			</td>
		</tr>
		<tr>
			<td >
				百度钱包支付
			</td>
			<td>
				<input name="" ng-disabled="paysetting['baifubao'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('baifubao', 'recharge_switch')" ng-if="paysetting['baifubao'].has_config === true && paysetting['baifubao'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
				<div ng-click="switchStatus('baifubao', 'recharge_switch')" ng-class="paysetting['baifubao'].recharge_switch === true || paysetting['baifubao'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['baifubao'].has_config === true && paysetting['baifubao'].recharge_set === true"></div>
				<div ng-class="paysetting['baifubao'].recharge_switch === true || paysetting['baifubao'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-disabled="true" style="cursor:no-drop" ng-if="paysetting['baifubao'].has_config === false || paysetting['baifubao'].recharge_set == false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('baifubao', 'pay_switch')">
				<div ng-click="switchStatus('baifubao', 'pay_switch')" ng-class="paysetting['baifubao'].pay_switch === true || paysetting['baifubao'].pay_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['baifubao'].has_config === true"></div>
				<div ng-class="paysetting['baifubao'].pay_switch === true || paysetting['baifubao'].pay_switch === 'true' ? 'switch switchOn' : 'switch'" style="cursor:no-drop" ng-if="paysetting['baifubao'].has_config === false"></div>
			</td>
			<td >
				<span ng-class="paysetting['baifubao'].has_config === true ? 'we7-circle success' : 'we7-circle '"></span>{{  paysetting['baifubao'].has_config === true ? '已配置' : '未配置'  }}
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" data-toggle="modal" data-target="#baidu">
						{{  paysetting.baifubao.has_config === true ? '修改配置' : '去配置'  }}
					</a>
				</div>
			</td>
		</tr>
		<tr>
			<td >
				汇款支付
			</td>
			<td>
				<input name="" ng-disabled="paysetting['line'].recharge_set !== true" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus('line', 'recharge_switch')" ng-if="paysetting['line'].has_config === true && paysetting['line'].recharge_set === true">
				<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
				<div ng-click="switchStatus('line', 'recharge_switch')" ng-class="paysetting['line'].recharge_switch === true || paysetting['line'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['line'].has_config === true && paysetting['line'].recharge_set === true"></div>
				<div ng-class="paysetting['line'].recharge_switch === true || paysetting['line'].recharge_switch === 'true' ? 'switch switchOn' : 'switch'" ng-disabled="true" style="cursor:no-drop" ng-if="paysetting['line'].has_config === false || paysetting['line'].recharge_set == false"></div>
			</td>
			<td>
				<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus('line', 'pay_switch')">
				<div ng-click="switchStatus('line', 'pay_switch')" ng-class="paysetting['line'].pay_switch === true || paysetting['line'].pay_switch === 'true' ? 'switch switchOn' : 'switch'" ng-if="paysetting['line'].has_config === true"></div>
				<div ng-class="paysetting['line'].pay_switch === true || paysetting['line'].pay_switch === 'true' ? 'switch switchOn' : 'switch'" style="cursor:no-drop" ng-if="paysetting['line'].has_config === false"></div>
			</td>
			<td>
				<span ng-class="paysetting['line'].has_config === true ? 'we7-circle success' : 'we7-circle '"></span>{{  paysetting['line'].has_config === true ? '已配置' : '未配置'  }}
			</td>
			<td>
				支付/充值
			</td>
			<td >
				<div class="link-group">
					<a href="javascript:;" data-toggle="modal" data-target="#huikuan">
						{{  paysetting.line.has_config === true ? '修改配置' : '去配置'  }}
					</a>
				</div>
			</td>
		</tr>
	</table>

	<!--支付宝修改-->
	<div class="modal fade" id="zhifubao" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">支付宝支付</div>
				</div>
				<div class="modal-body overflow-auto">
					<div class="we7-form">
						<div class="form-group">
							<label for="" class="control-label col-sm-2">支付宝无线支付</label>
							<div class="form-controls col-sm-10">
								<div class="alert alert-warning">
									您的支付宝账号必须支持手机网页即时到账接口, 才能使用手机支付功能,
									<a href="https://b.alipay.com/order/productDetail.htm?productId=2013080604609688" target="_blank" class="color-default">申请及详情请查看这里</a>.
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">收款支付宝账号</label>
							<div class="form-controls col-sm-10">
								<div class="input-group">
									<input type="text" name="" class="form-control" placeholder="" ng-model="paysetting.alipay.account">
									<a herf="#" ng-click="aliaccounthelp = !aliaccounthelp" class="input-group-addon"><i class="fa fa-exclamation-circle"></i></a>
								</div>
								<span class="help-block" ng-show="aliaccounthelp">
									如果开启兑换或交易功能，请填写真实有效的支付宝账号，用于收取用户以现金兑换交易积分的相关款项。如账号无效或安全码有误，将导致用户支付后无法正确对其积分账户自动充值，或进行正常的交易对其积分账户自动充值，或进行正常的交易。 如您没有支付宝帐号，
									<a href="https://memberprod.alipay.com/account/reg/enterpriseIndex.htm" target="_blank">请点击这里注册</a>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">合作者身份</label>
							<div class="form-controls col-sm-10">
								<div class="input-group">
									<input type="text" name="" class="form-control" placeholder="" ng-model="paysetting.alipay.partner">
									<a herf="#" ng-click="alipartnerhelp = !alipartnerhelp" class="input-group-addon"><i class="fa fa-exclamation-circle"></i></a>
								</div>
								<span class="help-block" ng-show="alipartnerhelp">
									支付宝签约用户请在此处填写支付宝分配给您的合作者身份，签约用户的手续费按照您与支付宝官方的签约协议为准。
									<br>如果您还未签约，
										<a href="https://memberprod.alipay.com/account/reg/enterpriseIndex.htm" target="_blank">
											请点击这里签约
										</a>；
										如果已签约,
										<a href="https://openhome.alipay.com/platform/keyManage.htm?keyType=partner" target="_blank">
											请点击这里获取PID、Key
										</a>;
										如果在签约时出现合同模板冲突，请咨询0571-88158090
								</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">校验密钥</label>
							<div class="form-controls col-sm-10">
								<div class="input-group">
									<input type="text" name="" class="form-control" placeholder="" ng-model="paysetting.alipay.secret">
									<a herf="#" ng-click="alisecrethelp = !alisecrethelp" class="input-group-addon"><i class="fa fa-exclamation-circle"></i></a>
								</div>
								<span class="help-block" ng-show="alisecrethelp">支付宝签约用户可以在此处填写支付宝分配给您的交易安全校验码，此校验码您可以到支付宝官方的商家服务功能处查看 </span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">模拟测试</label>
							<div class="form-controls col-sm-10">
								<a href="javascript:;" class="form-control-static color-default" ng-click="test_alipay()">模拟测试</a>
								<span class="help-block">本测试将模拟提交 0.01 元人民币的订单进行测试，如果提交后成功出现付款界面，说明您站点的支付宝功能可以正常使用</span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveEdit('alipay')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>

	<!-- 微信修改 -->
	<div class="modal fade" id="weixin" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">微信支付</div>
				</div>
				<div class="modal-body overflow-auto">
					<div class="we7-form ">
						<div class="form-group">
							<label for="" class="control-label col-sm-2">微信支付</label>
							<div class="form-controls col-sm-10">
								<div class="alert alert-warning">
									你必须向微信公众平台提交企业信息以及银行账户资料，审核通过并签约后才能使用微信支付功能,
									<a href="https://pay.weixin.qq.com/guide/webbased_payment.shtml" class="color-default" target="_blank">申请及详情请查看这里</a>
								</div>
								<div class="alert alert-warning" >
									<p>微信支付的接口说明如下：</p>
									<br>
									<h4>JS API网页支付参数</h4>
									<p>支付授权目录: <?php  echo $_W['siteroot'];?>payment/wechat/ 和 <?php  echo $_W['siteroot'];?>app/</p>
									<p>支付请求实例: <?php  echo $_W['siteroot'];?>payment/wechat/pay.php</p>
									<p>共享收货地址: 选择"是"</p>
									<br>
									<h4>Native原生支付</h4>
									<p>支付回调URL: <?php  echo $_W['siteroot'];?>payment/wechat/native.php</p>
									<p>维权通知URL: <?php  echo $_W['siteroot'];?>payment/wechat/rights.php</p>
									<p>警告通知URL: <?php  echo $_W['siteroot'];?>payment/wechat/warning.php</p>
								</div>
								<?php  if($account['level'] > ACCOUNT_SERVICE) { ?>
								<?php  if($account['level'] == ACCOUNT_SERVICE_VERIFY) { ?>
								<input id='radio-11' type="radio" name='wechat[switch]' ng-checked='paysetting.wechat.switch == 1' ng-click="changeSwitch('wechat', 1)" value="1"/>
								<label for="radio-11">微信支付 </label>
								<?php  } ?>
								<input ng-if="borrows" id='radio-12' type="radio" name='wechat[switch]' ng-checked='paysetting.wechat.switch == 2' ng-click="changeSwitch('wechat', 2)" value="2"/>
								<label ng-if="borrows" for="radio-12">借用支付  </label>
								
								<input ng-if="services" id='radio-13' type="radio" name='wechat[switch]' ng-checked='paysetting.wechat.switch == 3' ng-click="changeSwitch('wechat', 3)" value="3"/>
								<label ng-if="services" for="radio-13">服务商支付  </label>
								
								<?php  } ?>
							<!-- 	<input id='radio-24' type="radio" name='wechat[switch]' ng-checked='paysetting.wechat.switch == 4 || paysetting.wechat.switch === false' ng-click="changeSwitch('wechat', 4)" value="4" checked=""/>
								<label for="radio-24">关闭 </label> -->
							</div>
						</div>
						<?php  if($account['level'] > ACCOUNT_SERVICE) { ?>
						<?php  if($account['level'] == ACCOUNT_SERVICE_VERIFY) { ?>
						<div ng-show="paysetting.wechat.switch == 1">
							<div class="form-group">
								<label for="" class="control-label col-sm-2">接口类型</label>
								<div class="form-controls col-sm-10">
									<input id='radio-15' type="radio" name='paysetting[wechat][version]' ng-checked='paysetting.wechat.version == 1'  value="1" ng-click="changeVersion(1)"/>
									<label for="radio-15">旧版  </label>
									<input id='radio-25' type="radio" name='paysetting[wechat][version]' ng-checked='paysetting.wechat.version == 2' value="2" ng-click="changeVersion(2)"/>
									<label for="radio-25">新版(2014年9月之后申请的)  </label>
									<span class="help-block">由于微信支付接口调整，需要根据申请时间来区分支付接口</span>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-2">支付账号</label>
								<div class="form-controls col-sm-10">
									<a href="" class="form-control-static color-default"><?php  echo $_W['account']['name'];?></a>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-2">身份标识<br>(appId)</label>
								<div class="form-controls col-sm-10">
									<input type="text" name="" disabled class="form-control" value="<?php  echo $_W['account']['key'];?>" placeholder="">
									<span class="help-block">
										公众号身份标识
										<a href="./index.php?c=account&amp;a=post&amp;uniacid=2">
											请通过修改公众号信息来保存
										</a>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-2">身份密钥<br>(appSecret)</label>
								<div class="form-controls col-sm-10">
									<input type="text" disabled  value="<?php  echo $_W['account']['secret'];?>" name="" class="form-control" placeholder="">
									<span class="help-block">公众平台API(参考文档API 接口部分)的权限获取所需密钥Key
										<a href="./index.php?c=account&amp;a=post&amp;uniacid=2">
											请通过修改公众号信息来保存
										</a>
									</span>
								</div>
							</div>
							<div ng-show="paysetting.wechat.version == 1">
								<div class="form-group">
									<label for="" class="control-label col-sm-2">商户身份</label>
									<div class="form-controls col-sm-10">
										<input type="text" class="form-control" ng-model="paysetting.wechat.partner" placeholder="">
										<span class="help-block">
											财付通商户身份标识
											<br>
											 公众号支付请求中用于加密的密钥Key
										</span>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">商户密钥</label>
									<div class="form-controls col-sm-10">
										<input type="text" name="" ng-model="paysetting.wechat.key" class="form-control" placeholder="">
										<span class="help-block">
											财付通商户权限密钥
										</span>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">通信密钥</label>
									<div class="form-controls col-sm-10">
										<input type="text" name="" ng-model="paysetting.wechat.signkey" class="form-control" placeholder="">
										<span class="help-block">
											财付通商户权限密钥
										</span>
									</div>
								</div>
							</div>
							<div ng-show="paysetting.wechat.version == 2">
								<div class="form-group">
									<label for="" class="control-label col-sm-2">微信支付商户号</label>
									<div class="form-controls col-sm-10">
										<input type="text" name="" ng-model="paysetting.wechat.mchid" class="form-control" placeholder="">
										<span class="help-block">
											财付通商户权限密钥
										</span>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">微信支付密钥</label>
									<div class="form-controls col-sm-10">
										<div class="input-group">
											<input type="text" name="" ng-model="paysetting.wechat.apikey" class="form-control" placeholder="">
											<a href="javascript:;" class="input-group-addon" ng-click="tokenGen('wechat.apikey')">生成新的密钥</a>
										</div>
										<span class="help-block">
											财付通商户权限密钥
										</span>
									</div>
								</div>
							</div>
						</div>
						<?php  } ?>
						<div ng-if="borrows" ng-show="paysetting.wechat.switch == 2">
							<div class="form-group">
								<label for="" class="control-label col-sm-2">借用公众号</label>
								<div class="form-controls col-sm-10">
									<select name="borrow" search="1" class="we7-select" ng-model="paysetting.wechat.borrow">
										<option value="" ng-selected="paysetting.wechat.borrow == 0 || paysetting.wechat.borrow == '' || paysetting.wechat.borrow == undefined">请选择要借用的公众号</option>
										<option value="{{key}}" ng-selected="paysetting.wechat.borrow == key" ng-repeat="(key, account) in borrows track by key">{{ account }}</option>
									</select>
									<span class="help-block">借用认证服务号支付权限完成支付。</span>
								</div>
							</div>
						</div>
						
						<div ng-if="services" ng-show="paysetting.wechat.switch == 3">
							<div class="form-group">
								<label for="" class="control-label col-sm-2">服务商公众号</label>
								<div class="form-controls col-sm-10">
									<select name="service" search="1" class="we7-select" ng-model="paysetting.wechat.service">
										<option value="">请选择服务商公众号</option>
										<option value="{{key}}" ng-selected="paysetting.wechat.service == key" ng-repeat="(key, account) in services track by key">{{ account }}</option>
									</select>
									<span class="help-block">借用认证服务号支付权限完成支付。</span>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-2">子商户号</label>
								<div class="form-controls col-sm-10">
									<input type="text" name="" ng-model="paysetting.wechat.sub_mch_id" class="form-control" placeholder="">
										<span class="help-block">
											子商户的商户号
										</span>
								</div>
							</div>
						</div>
						
						<?php  } ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click='saveEdit("wechat")'>确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="wechat_fa" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">服务商支付</div>
				</div>
				<div class="modal-body">
					<div class="we7-form">
						<div class="form-group">
							<label for="" class="control-label col-sm-2">服务商支付</label>
							<div class="form-controls col-sm-10">
								<input id='radio-111' type="radio" name='wechat_facilitator' value="true" ng-checked="paysetting.wechat_facilitator.switch === true" ng-click="changeSwitch('wechat_facilitator', true)"/>
								<label for="radio-111">开启 </label>
								<input id='radio-222' type="radio" name='wechat_facilitator' value="false" ng-checked="paysetting.wechat_facilitator.switch === false" ng-click="changeSwitch('wechat_facilitator', false)"/>
								<label for="radio-222">关闭 </label>
								<span class="help-block">设置为服务商，其他商户可以授权给服务商，让服务商完成支付。</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">服务商商户号</label>
							<div class="form-controls col-sm-10">
								<input name="" ng-model="paysetting.wechat_facilitator.mchid" class="form-control" placeholder="" >
								<span class="help-block">需要填写申请为服务商的商户号。注：服务商的商户号与微信支付的商户号不是同一个号。</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">商户支付密钥</label>
							<div class="form-controls col-sm-10">
								<input type="text" name="" ng-model="paysetting.wechat_facilitator.signkey" class="form-control" placeholder="">
								<span class="help-block">此商户密钥为服务商商户号对应的支付密钥，与微信支付的支付密钥不相同。</span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveEdit('wechat_facilitator')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	

	<!--银联支付-->
	<div class="modal fade" id="yinlian" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<form action="<?php  echo url('profile/payment/save_setting', array('type' => 'unionpay'))?>" enctype="multipart/form-data" method="post" id="form1" >
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div class="modal-title">银联支付</div>
					</div>
					<div class="modal-body">
						<div class="we7-form">
							<div class="form-group">
								<label for="" class="control-label col-sm-2">商户私钥证书（签名）</label>
								<div class="form-controls col-sm-10">
									<input type="file" name="unionpay[signcertpath]" id="amend" <?php  if($pay_setting['unionpay']['signcertexists'] !== false) { ?>style="display:none;"<?php  } ?> class="form-control" placeholder="">
									<span <?php  if($pay_setting['unionpay']['signcertexists'] === false) { ?>style="display:none;"<?php  } ?>>证书已上传<input type="button" class="btn btn-success" onclick="amend.click()" value="修改"></span>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-2">商户号</label>
								<div class="form-controls col-sm-10">
									<input type="text" name="unionpay[merid]" value="<?php  echo $pay_setting['unionpay']['merid'];?>" class="form-control" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-2">商户私钥证书密码</label>
								<div class="form-controls col-sm-10">
									<input type="text" name="unionpay[signcertpwd]" value="<?php  echo $pay_setting['unionpay']['signcertpwd'];?>" class="form-control" placeholder="">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">确定</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					</div>
				</div>
			</form>
		</div>
	</div>


	<div class="modal fade" id="jueqiymf" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">一码付</div>
				</div>
				<div class="modal-body">
					<div class="we7-form">
						<div class="we7-margin-bottom color-gray">参数设置</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">后台地址</label>
							<div class="form-controls col-sm-10">
								<input type="text"ng-model="paysetting.jueqiymf.url" name="" class="form-control" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">商户号</label>
							<div class="form-controls col-sm-10">
								<input type="text"ng-model="paysetting.jueqiymf.mchid" name="" class="form-control" placeholder="">
							</div>
						</div>
						<div class="border-top border-bottom we7-margin-horizontal-exceed we7-padding-top we7-padding-horizontal">
							<div class="form-group">
								<label for="" class="control-label col-sm-2 color-gray we7-padding-vertical-none">支付参数</label>
								<div class="form-controls col-sm-10">
									<input type="checkbox" id="zhifu-1" name="zhifu" ng-model="paysetting.jueqiymf.pay_switch" ng-checked="paysetting['jueqiymf'].pay_switch === true || paysetting['jueqiymf'].pay_switch === 'true' ? true : false"/>
									<label class="checkbox-inline we7-margin-right" for="zhifu-1">支付</label>
									<input type="checkbox" id="zhifu-2" name="zhifu" ng-model="paysetting.jueqiymf.recharge_switch" ng-checked="paysetting['jueqiymf'].recharge_switch === true || paysetting['jueqiymf'].recharge_switch === 'true' ? true : false"/>
									<label class="checkbox-inline" for="zhifu-2">充值</label>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-2 color-gray we7-padding-vertical-none">支付参数</label>
								<div class="form-controls col-sm-10">
									<input type="radio" id="status-1" name="status" ng-value="true" ng-model="paysetting.jueqiymf.has_status" ng-checked="paysetting['jueqiymf'].has_status === true || paysetting['jueqiymf'].has_status === 'true' ? true : false"/>
									<label class="radio-inline we7-margin-right" for="status-1">开启</label>
									<input type="radio" id="status-2" name="status" ng-value="false" ng-model="paysetting.jueqiymf.has_status" ng-checked="paysetting['jueqiymf'].has_status === true || paysetting['jueqiymf'].has_status === 'true' ? false : true"/>
									<label class="radio-inline" for="status-2">关闭</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveEdit('jueqiymf')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<!--百度钱包-->
	<div class="modal fade" id="baidu" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">百度钱包</div>
				</div>
				<div class="modal-body">
					<div class="we7-form">
						<div class="form-group">
							<label for="" class="control-label col-sm-2">商户号</label>
							<div class="form-controls col-sm-10">
								<input type="text"ng-model="paysetting.baifubao.mchid" name="" class="form-control" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">商户支付密钥</label>
							<div class="form-controls col-sm-10">
								<input type="text" name="" ng-model="paysetting.baifubao.signkey" class="form-control" placeholder="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveEdit('baifubao')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>

	<!--汇款-->
	<div class="modal fade" id="huikuan" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">汇款支付</div>
				</div>
				<div class="modal-body">
					<div class="we7-form">
						<div class="form-group">
							<label for="" class="control-label col-sm-2">账户信息</label>
							<div class="form-controls col-sm-10">
								<input type="text" id="" name="" ng-model="paysetting.line.message" class="form-control" placeholder="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveEdit('line')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  } ?>

<?php  if($do == 'switch') { ?>
<ol class="breadcrumb we7-breadcrumb">
	<a href="<?php  echo url('profile/payment');?>"><i class="wi wi-back-circle"></i> </a>
	<li>
		<a href="<?php  echo url('profile/payment');?>">支付配置</a>
	</li>
	<li>
		<a href="javascript:;">支付支持</a></li>
	</li>
</ol>

<div class="js-profile-payment" ng-controller="paymentCtrl" ng-cloak>
	<table class="table we7-table table-hover table-form">
		<col width="140px " />
		<col width="400px"/>
		<col />
		<col width="140px" />
		<tr>
			<th colspan="5" >支付方式设置(<?php  echo $payment_types[$_GPC['type']];?>)</th>
			<th colspan="1" >操作</th>
		</tr>
		<tr>
			<td colspan="2">
				充值
			</td>
			<td colspan="2">
				<label>
					<input name="" class="form-control" type="checkbox" style="display: none;" ng-click="switchStatus(config.paytype, 'recharge_switch')" ng-if="paysetting[config.paytype].recharge_set === true">
					<input name="" class="form-control" type="checkbox" style="display: none;" ng-else>
					<div ng-class="paysetting[config.paytype].recharge_switch === true || paysetting[config.paytype].recharge_switch === 'true' ? 'switch switchOn' : 'switch'"></div>
				</label>
			</td>
			<td colspan="2" ng-if="paysetting[config.paytype].recharge_set !== true">不可启用</td>
			<td colspan="2" ng-if="paysetting[config.paytype].recharge_set === true"></td>
		</tr>
		<tr>
			<td colspan="2">
				支付
			</td>
			<td colspan="2">
				<label>
					<input name="" class="form-control" type="checkbox"  style="display: none;" ng-click="switchStatus(config.paytype, 'pay_switch')">
					<div ng-class="paysetting[config.paytype].pay_switch === true || paysetting[config.paytype].pay_switch === 'true' ? 'switch switchOn' : 'switch'"></div>
				</label>
			</td>
			<td colspan="2"></td>
		</tr>
	</table>
</div>
<?php  } ?>
<script>
	angular.module('profileApp').value('config', {
		'paysetting' : <?php  echo json_encode($pay_setting)?>,
		'paytype' : "<?php  echo $_GPC['type'];?>",
		'saveurl' : "<?php  echo url('profile/payment/save_setting')?>",
		'text_alipay_url' : "<?php  echo url('profile/payment/test_alipay')?>",
		'change_status': "<?php  echo url('profile/payment/change_status')?>",
		'get_setting_url' : "<?php  echo url('profile/payment/get_setting')?>",
		'account_level' : "<?php  echo $account['level'];?>",
		'links': {
			'getAccountWechatProxy': "<?php  echo url('profile/payment/get_account_wechatpay_proxy')?>",
		}
	});

	angular.bootstrap($('.js-profile-payment'), ['profileApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>