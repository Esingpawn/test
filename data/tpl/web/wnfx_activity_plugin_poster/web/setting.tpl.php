<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=2017082601" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/util.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>web/resource/js/util.min.js?v=20170912"></script>
<style>
.multi-img-details .multi-item{height:auto;}
#member.multi-img-details .multi-item{text-align:center; max-width:100px;}
#member.multi-img-details .multi-item img{ max-width:90px; max-height:90px;}
#member.multi-img-details .multi-item .title{ overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
.plugins_wrp ul {margin-right:-24px;overflow: hidden;padding-left:0px}
.plugins_wrp .item_wrp{float:left;display:inline-block;width:100%;position:relative;margin-bottom: 10px;}
.plugin_item{display:block;overflow:hidden;background-color:#f4f5f9;margin-right:24px;color:#222;padding: 10px 20px;}
.plugin_item:hover{text-decoration:none;background-color:#eff0f4;border-color:#d9dadc}
.plugin_item .plugin_status{position:relative;float:right;text-align:right; padding:8px 0}
.plugin_item .plugin_status .status_txt.warn{color:#e15f63}
.plugin_item .plugin_status .access{width:16px;height:16px;vertical-align:middle;display:inline-block;position:absolute;right:10px;top:40px}
.plugin_item .plugin_content{overflow:hidden}
.plugin_item .plugin_content .title{margin-bottom:4px;width:216px;font-size:14px;font-weight:400;font-style:normal;margin-top: 0px;}
.plugin_item .plugin_content .desc{color:#8d8d8d;font-size:12px;line-height:1.8;width:238px;margin:0;}
.bs-callout{padding:20px;margin-bottom:20px;border:1px solid #eee;border-left-width:5px;border-radius:3px;background-color: white;}
.bs-callout h4{margin-top:0;margin-bottom:5px}
.bs-callout p:last-child{margin-bottom:0}
.bs-callout code{border-radius:3px}
.bs-callout+.bs-callout{margin-top:-5px}
.bs-callout-danger{border-left-color:#ce4844}
.bs-callout-danger h4{color:#ce4844}
.bs-callout-warning{border-left-color:#aa6708}
.bs-callout-warning h4{color:#aa6708}
.bs-callout-info{border-left-color:#1b809e}
.bs-callout-info h4{color:#1b809e}
</style>
<form class="form-horizontal form" action="" method="post">
	<h4 style="display:none">海报推广设置</h4>		
	<div class="plugins_wrp">
    	<ul>
            <li class="item_wrp">
                <div class="plugin_item">
                    <div class="plugin_status">
                        <i class="access"></i>
                        <span class="status_txt">	
                            <div class="switch switch<?php echo $settings['poster_enable'] ? 'On' : 'Off'?>">
                            	<input type="hidden" name="module[poster_enable]" value="<?php  echo (int)$settings['poster_enable']?>" />
                            </div>
                        </span>
                    </div>
                    <div class="plugin_content">
                        <h3 class="title">开启海报</h3>
                        <p class="desc" style="width:100%;">
                            开启后，您的平台会员可生成分享海报，增加推广渠道。
                        </p>
                    </div>
                </div>
            </li>
            <li class="item_wrp">
                <div class="plugin_item">
                    <div class="plugin_status">
                        <i class="access"></i>
                        <span class="status_txt">	
                            <div class="switch switch<?php echo $settings['commission_enable'] ? 'On' : 'Off'?>">
                            	<input type="hidden" name="module[commission_enable]" value="<?php  echo (int)$settings['commission_enable']?>" />
                            </div>
                        </span>
                    </div>
                    <div class="plugin_content">
                        <h3 class="title">开启分销</h3>
                        <p class="desc" style="width:100%;">
                            开启后，您的平台会员生成海报、或者分享活动详情连接，可自主申请成为分销员。
                        </p>
                    </div>
                </div>
                <input type="hidden" name="module[commission_api]" value="1" />
            </li>            
            <li class="item_wrp">
                <div class="plugin_item">
                    <div class="plugin_status">
                        <i class="access"></i>
                        <span class="status_txt">	
                            <div class="switch switch<?php echo $settings['become'] ? 'On' : 'Off'?>">
                            	<input type="hidden" name="module[become]" value="<?php  echo (int)$settings['become']?>" />
                            </div>
                        </span>
                    </div>
                    <div class="plugin_content">
                        <h3 class="title">成为总店是否需要审核</h3>
                        <p class="desc" style="width: 100%;">
                            开启状态需要审核，关闭状态自动通过，审核状态用户不可以发展线下。
                        </p>
                    </div>
                </div>
            </li>
            <li class="item_wrp">
                <div class="plugin_item">
                    <div class="plugin_status">
                        <i class="access"></i>
                        <span class="status_txt">	
                            <div class="switch switch<?php echo $settings['become_check'] ? 'On' : 'Off'?>">
                            	<input type="hidden" name="module[become_check]" value="<?php  echo (int)$settings['become_check']?>" />
                            </div>
                        </span>
                    </div>
                    <div class="plugin_content">
                        <h3 class="title">发展下线是否需要审核</h3>
                        <p class="desc" style="width: 100%;">
                            开启状态需要审核，关闭状态自动通过。
                        </p>
                    </div>
                </div>
            </li>
            <li class="item_wrp">
                <div class="plugin_item">
                    <div class="plugin_content">
                        <h3 class="title">分销设置</h3>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销层级</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="module[level]" id="commission_level" onchange="commissionLevel()">
                                    <option value="1"<?php  if($settings['level']==1) { ?> selected<?php  } ?>>一级分销
                                    </option>
                                    <option value="2"<?php  if($settings['level']==2) { ?> selected<?php  } ?>>二级分销
                                    </option>
                                    <option value="3"<?php  if($settings['level']==3) { ?> selected<?php  } ?>>三级分销
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分销比例</label>
                            <div class="col-xs-12 col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon">一级分销</span>
                                    <input type="text" name="module[rule][first_level_rate]" class="form-control" value="<?php  echo $settings['rule']['first_level_rate'];?>" />
                                    <span class="input-group-addon">二级分销</span>
                                    <input type="text" name="module[rule][second_level_rate]" class="form-control" value="<?php  echo $settings['rule']['second_level_rate'];?>" />
                                    <span class="input-group-addon">三级分销</span>
                                    <input type="text" name="module[rule][third_level_rate]" class="form-control" value="<?php  echo $settings['rule']['third_level_rate'];?>" />
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销内购</label>
                            <div class="col-sm-9 col-xs-12 form-control-static">
                                <div class="switch switch<?php echo $settings['self_buy'] ? 'On' : 'Off'?>">
                                    <input type="hidden" name="module[self_buy]" value="<?php  echo (int)$settings['self_buy']?>" />
                                </div>
                                <span class="help-block">开启分销内购，分销商自己购买商品，享受一级佣金，上级享受二级佣金，上上级享受三级佣金</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="item_wrp">
                <div class="plugin_item">
                    <div class="plugin_content">
                        <h3 class="title">结算设置</h3>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">自动结算</label>
                            <div class="col-sm-9 col-xs-12 form-control-static">
                                <div class="switch switch<?php echo $settings['settlement_model'] ? 'On' : 'Off'?>">
                                    <input type="hidden" name="module[settlement_model]" value="<?php  echo (int)$settings['settlement_model']?>" />
                                </div>
                                <span class="help-block">自动结算：订单完成后，根据结算期时间来加入到提现<br>手动结算：订单完成后，需要进入推广中心手动领取才可以提现<br>注：请确认主模块计划任务是否设置 -> 参数设置 -> 其它设置 -> 计划任务【<a target="_blank" href="<?php  echo $taskurl;?>" class="product-grey-font" style="color:#3296fa">前往设置</a>】</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付完成转结算期</label>
                            <div class="col-sm-9 col-xs-12 form-control-static">
                                <div class="switch switch<?php echo $settings['settlement_event'] ? 'On' : 'Off'?>">
                                    <input type="hidden" name="module[settlement_event]" value="<?php  echo (int)$settings['settlement_event']?>" />
                                </div>
                                <span class="help-block">默认[订单完成后，即核销完成]分销订单进入结算计算(ps:计算结算期)</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">结算天数</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="module[settle_days]" class="form-control" value="<?php  echo (int)$settings['settle_days']?>">
                                <span class="help-block">当订单完成后的n天后，佣金才能申请提现</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="item_wrp">
                <div class="plugin_item">
                    <div class="plugin_content">
                        <h3 class="title">提现设置</h3>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现到余额</label>
                            <div class="col-sm-9 col-xs-12 form-control-static">
                                <div class="switch switch<?php echo $settings['income']['balance'] ? 'On' : 'Off'?>">
                                    <input type="hidden" name="module[income][balance]" value="<?php  echo (int)$settings['income']['balance']?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现到微信</label>
                            <div class="col-sm-9 col-xs-12 form-control-static">
                                <div class="switch switch<?php echo $settings['income']['wechat'] || $settings['income']['wechat']=='' ? 'On' : 'Off'?>">
                                    <input type="hidden" name="module[income][wechat]" value="<?php echo $settings['income']['wechat'] || $settings['income']['wechat']=='' ? '1' : '0'?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display:none">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现到支付宝</label>
                            <div class="col-sm-9 col-xs-12 form-control-static">
                                <div class="switch switch<?php echo $settings['income']['alipay'] ? 'On' : 'Off'?>">
                                    <input type="hidden" name="module[income][alipay]" value="<?php  echo (int)$settings['income']['alipay']?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现额度</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="module[commission][roll_out_limit]" class="form-control" value="<?php  echo $settings['commission']['roll_out_limit'];?>">
                                <span class="help-block">当前分销商的佣金达到此额度时才能提现</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">最高提现额度</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="module[commission][max_roll_out_limit]" class="form-control" value="<?php  echo $settings['commission']['max_roll_out_limit'];?>">
                                <span class="help-block">当前分销商的佣金每天最高提现此额度，超过则不能提现</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">最高提现次数</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="module[commission][max_time_out_limit]" class="form-control" value="<?php  echo $settings['commission']['max_time_out_limit'];?>">
                                <span class="help-block">当前分销商的佣金每天最高提现次数，超过则不能提现</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现手续费</label>
                            <div class="col-sm-9 col-xs-12">
                            	<div class="input-group">
                                    <input type="text" name="module[commission][poundage_rate]" class="form-control" value="<?php  echo $settings['commission']['poundage_rate'];?>">
                                    <div class="input-group-addon">%</div>
                                </div>
                                <span class="help-block">提现手续费比例</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">劳务税比例</label>
                            <div class="col-sm-9 col-xs-12">
                                <div class="input-group">
                                    <input type="text" name="module[income][servicetax_rate]" class="form-control" value="<?php  echo $settings['income']['servicetax_rate'];?>">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">收入提现免审核</label>
                            <div class="col-sm-9 col-xs-12 form-control-static">
                                <div class="switch switch<?php echo $settings['income']['free_audit'] ? 'On' : 'Off'?>">
                                    <input type="hidden" name="module[income][free_audit]" value="<?php  echo (int)$settings['income']['free_audit']?>" />
                                </div>
                                <span class="help-block">收入提现自动审核、自动打款（自动打款只支持提现到余额、提现到微信支付两种方式！）<br>注：请确认主模块计划任务是否设置 -> 参数设置 -> 其它设置 -> 计划任务【<a target="_blank" href="<?php  echo $taskurl;?>" class="product-grey-font" style="color:#3296fa">前往设置</a>】</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
		</ul>
        <div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only" style="display:none">
            <h4>对接芸众商城分销【分支：免费版】</h4>下载安装地址：
            <a href="javascript:;" class="js-clip" title="点击复制链接" data-url="https://s.we7.cc/module-4048.html">https://s.we7.cc/module-4048.html</a>
            <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 15px; top: 9px; width: 612px; height: 16px; z-index: 99;"><embed id="ZeroClipboardMovie_1" src="./resource/components/zclip/ZeroClipboard.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="612" height="16" name="ZeroClipboardMovie_1" align="middle" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="id=1&amp;width=612&amp;height=16" wmode="transparent"></div>
        </div>
    </div>
    <div class="form-group<?php echo substr(IMS_VERSION, 0, 1)>=2?' foot-fixed text-center':' col-sm-12'?>">
        <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
        <input type="submit" class="btn btn-primary" name="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;保存&nbsp;&nbsp;&nbsp;&nbsp;" />
    </div>
</form>
<script type="text/javascript">
//系统1.0+显示switch
$('.switch').click(function(e){
	var state = $(this).hasClass("switchOff");
	var show = state ? 1 : 0;	
	$(this).toggleClass("switchOff");
	$(this).toggleClass("switchOn");
	$(this).find('input').val(show ? 1 : 0);

});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH));?>