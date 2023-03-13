<?php defined('IN_IA') or exit('Access Denied');?><?php  if($_W['plugin']['poster']['config']['commission_enable']) { ?>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">分销设置</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">开启分销</label>
            <div class="col-sm-6 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="prize[commission]" value="1"<?php  if($item['prize']['commission']) { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="prize[commission]" value="0"<?php  if($item['prize']['commission']=='0' || empty($item['prize']['commission'])) { ?> checked<?php  } ?>> 关闭
                </label>
                <div class="input-group" style="margin-top:15px">
                    <span class="input-group-addon">一级分销</span>
                    <input type="text" name="prize[commission_rule][first_level_rate]" class="form-control" value="<?php  echo $item['prize']['commission_rule']['first_level_rate'];?>" />
                    <span class="input-group-addon">% 二级分销</span>
                    <input type="text" name="prize[commission_rule][second_level_rate]" class="form-control" value="<?php  echo $item['prize']['commission_rule']['second_level_rate'];?>" />
                    <span class="input-group-addon">% 三级分销</span>
                    <input type="text" name="prize[commission_rule][third_level_rate]" class="form-control" value="<?php  echo $item['prize']['commission_rule']['third_level_rate'];?>" />
                    <span class="input-group-addon">%</span>
                </div>
                <span class="help-block">比率不设置，应用分销插件参数设置。</span>
            </div>
        </div>
    </div>
</div>
<?php  } ?>
<?php  if(perm('goods.senior.credit')) { ?>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2"><?php  echo $creditName;?>设置</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">奖励规则</label>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">报名赠送</span>
                    <input type="text" name="prize[credit]" class="form-control" value="<?php  if($item['prize']['credit']=='') { ?>0<?php  } else { ?><?php  echo $item['prize']['credit'];?><?php  } ?>">
                    <span class="input-group-addon"><?php  echo $creditName;?></span>
                </div>
                <p></p>
                <div class="input-group" style="margin-top:15px">
                    <span class="input-group-addon">分享赠送</span>
                    <input type="text" name="prize[share_credit]" class="form-control" value="<?php  if($item['prize']['share_credit']=='') { ?>0<?php  } else { ?><?php  echo $item['prize']['share_credit'];?><?php  } ?>">
                    <span class="input-group-addon"><?php  echo $creditName;?>, 每天奖励</span>
                    <input type="text" name="prize[share_times]" class="form-control" value="<?php  if($item['prize']['share_times']=='') { ?>0<?php  } else { ?><?php  echo $item['prize']['share_times'];?><?php  } ?>">
                    <span class="input-group-addon">次</span>
                </div>
                <p></p>
                <div class="input-group" style="margin-top:15px">
                    <span class="input-group-addon">核销赠送</span>
                    <input type="text" name="prize[sign_credit]" class="form-control" value="<?php  if($item['prize']['sign_credit']=='') { ?>0<?php  } else { ?><?php  echo $item['prize']['sign_credit'];?><?php  } ?>">
                    <span class="input-group-addon"><?php  echo $creditName;?></span>
                    <!--
                    <input type="text" name="prize[sign_times]" class="form-control" value="<?php  if($item['prize']['sign_times']=='') { ?>0<?php  } else { ?><?php  echo $item['prize']['sign_times'];?><?php  } ?>">
                    <span class="input-group-addon">次</span>
                    -->
                </div>
                <span class="help-block">如果不填或者填0，则默认为不奖励<?php  echo $creditName;?>。</span>
            </div>
        </div>
    </div>
</div>
<?php  } ?>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">抽奖设置</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">是否开启</label>
            <div class="col-sm-8 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" value="1" name="prize[lottery][enable]" <?php  if($item['prize']['lottery']['enable']) { ?>checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" name="prize[lottery][enable]" <?php  if(!$item['prize']['lottery']['enable']) { ?>checked<?php  } ?>> 关闭
                </label>
                <div class="input-group" style="margin-top:15px">
                    <span class="input-group-addon">抽奖连接</span>
                    <input type="text" name="prize[lottery][url]" class="form-control" value="<?php  echo $item['prize']['lottery']['url'];?>">
                </div>
                <label class="checkbox-inline">
                    <input type="checkbox" value="1" name="prize[lottery][fee]" <?php  if($item['prize']['lottery']['fee']) { ?>checked<?php  } ?>> 仅限付费用户
                </label>
            </div>
        </div>
    </div>
</div>
<?php  if($_W['plugin']['card']['config']['card_enable']) { ?>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">年卡设置</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">开启折扣</label>
            <div class="col-sm-8 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" value="1" name="prize[cardper][enable]" <?php  if($item['prize']['cardper']['enable']) { ?>checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" name="prize[cardper][enable]" <?php  if(!$item['prize']['cardper']['enable']) { ?>checked<?php  } ?>> 关闭
                </label>
                <div class="input-group fixsingle-input-group" style=" margin-top:15px">
                    <span class="input-group-addon">专享折扣</span>
                    <input type="text" name="prize[cardper][percent]" class="form-control" value="<?php  echo $item['prize']['cardper']['percent'];?>" placeholder="系统默认：<?php echo empty($_W['plugin']['card']['config']['percent'])?'8.8':$_W['plugin']['card']['config']['percent']?>">
                    <span class="input-group-addon">折</span>
                </div>
                <span class="help-block">开启年卡折扣，所有年卡价格不再生效！</span>
            </div>
        </div>
    </div>
</div>
<?php  } ?>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">优惠设置</div>
    <div class="region-activity-right col-sm-10">
        <div class="alert alert-info">
            1、设置会员组，折扣、满减不生效；<br>2、折扣、满减同时设置，只有折扣生效【注：开启规格时建议选择折扣类型】。
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">优惠方式</label>
            <div class="col-sm-8 col-xs-12">
                <ul class="nav nav-tabs" id="myTab2">
                    <li class="active"><a href="#tab_discount">折扣</a></li>
                    <li class=""><a href="#tab_enough">满减</a></li>
                    <li class=""><a href="#tab_deduction"><?php  echo $creditName;?>抵扣</a></li>
                    <li class=""><a href="#tab_mcgroup">会员组</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_discount">
                        <div class="recharge-items">
                            <?php  if(is_array($marketing['0'])) { foreach($marketing['0'] as $key => $v) { ?>
                            <div class="input-group recharge-item" style="margin-top:5px"><span class="input-group-addon">单次报名满</span><input type="text" class="form-control" name="discount[<?php  echo $key;?>][meet]" value="<?php  echo $v['meet'];?>"><span class="input-group-addon">人 优惠</span><input type="text" class="form-control" name="discount[<?php  echo $key;?>][give]" value="<?php  echo $v['give'];?>"><span class="input-group-addon">折</span><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="removeConsumeItem(this)"><i class="fa fa-remove"></i></button></div></div>
                            <?php  } } ?>
                        </div>
                        <div style="margin-top:5px">
                            <button type="button" class="btn btn-default" onclick="addConsumeItem(this,'discount')" style="margin-bottom:5px"><i class="fa fa-plus"></i> 增加优惠项</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_enough">
                        <div class="recharge-items">
                            <?php  if(is_array($marketing['1'])) { foreach($marketing['1'] as $key => $v) { ?>
                            <div class="input-group recharge-item" style="margin-top:5px"><span class="input-group-addon">单次报名满</span><input type="text" class="form-control" name="enough[<?php  echo $key;?>][meet]" value="<?php  echo $v['meet'];?>"><span class="input-group-addon">人 立减</span><input type="text" class="form-control" name="enough[<?php  echo $key;?>][give]" value="<?php  echo $v['give'];?>"><span class="input-group-addon">元</span><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="removeConsumeItem(this)"><i class="fa fa-remove"></i></button></div></div>
                            <?php  } } ?>
                        </div>
                        <div style="margin-top:5px">
                            <button type="button" class="btn btn-default" onclick="addConsumeItem(this,'enough')" style="margin-bottom:5px"><i class="fa fa-plus"></i> 增加优惠项</button>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="tab_deduction">
                        <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/marketing/deduction', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/marketing/deduction', TEMPLATE_INCLUDEPATH));?>
                    </div>
                    
                    <div class="tab-pane" id="tab_mcgroup">
                        <div class="recharge-items">
                            <?php  if(is_array($marketing['2'])) { foreach($marketing['2'] as $key => $v) { ?>
                            <div class="input-group recharge-item" style="margin-top:5px">
                                <span class="input-group-addon">折扣</span>
                                <input type="text" class="form-control" name="mcgroup[<?php  echo $key;?>][discount]" value="<?php  echo $v['discount'];?>">
                                <span class="input-group-addon">折 立减</span>
                                <input type="text" class="form-control" name="mcgroup[<?php  echo $key;?>][money]" value="<?php  echo $v['money'];?>">
                                <span class="input-group-addon">元</span>
                                <div class="input-group-select">
                                	<input type="hidden" name="mcgroup[<?php  echo $key;?>][grouptitle]" value="<?php  echo $v['grouptitle'];?>">
                                    <select name="mcgroup[<?php  echo $key;?>][groupid]" class="form-control">
                                        <?php  if(is_array($mcgroups)) { foreach($mcgroups as $g) { ?>
                                        <option value="<?php  echo $g['groupid'];?>"<?php  if($v['groupid']==$g['groupid']) { ?> selected<?php  } ?>><?php  echo $g['title'];?></option>
                                        <?php  } } ?>
                                    </select>
                                </div>
                                <div class="input-group-btn">                                    
                                    <button class="btn btn-danger" type="button" onclick="removeConsumeItem(this)"><i class="fa fa-remove"></i></button>
                                </div>
                            </div>
                            <?php  } } ?>
                        </div>
                        <div style="margin-top:5px">
                            <button type="button" class="btn btn-default" onclick="addConsumeItem(this,'mcgroup')" style="margin-bottom:5px"><i class="fa fa-plus"></i> 增加优惠项</button>
                        </div>
                    </div>
                </div>
                <script>
                $(function () {
                    window.optionchanged = false;
                    $('#myTab2 a').click(function (e) {
                        e.preventDefault();//阻止a链接的跳转行为
                        $(this).tab('show');//显示当前选中的链接及关联的content
                    })
                });
                </script>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function addConsumeItem(obj,type){
            var key = $("#tab_"+type+" .recharge-item").length;
            var mcgroups = <?php  echo json_encode($mcgroups);?>;
            var html = '';
            html = '<div class="input-group recharge-item" style="margin-top:5px">'
                +'<span class="input-group-addon">单次报名满</span>'
                +'<input type="text" class="form-control" name="'+type+'['+key+'][meet]" value="">'
                +'<span class="input-group-addon">人 '+(type=='discount'?'优惠':'立减')+'</span>'
                +'<input type="text" class="form-control" name="'+type+'['+key+'][give]" value="">'
                +'<span class="input-group-addon">'+(type=='discount'?'折':'元')+'</span>'
                +'<div class="input-group-btn">'
                +'	<button class="btn btn-danger" type="button" onclick="removeConsumeItem(this)"><i class="fa fa-remove"></i></button>'
                +'</div>'
            +'</div>';
            if (type == 'mcgroup'){
                var option,k=0;
                $.each(mcgroups, function(i, o) {
                    if (k==0) firsttitle = o.title;
                    option+='<option value="'+o.groupid+'">'+o.title+'</option>';
                    k++;
                });
                html = '<div class="input-group recharge-item" style="margin-top:5px">'
                    +'<span class="input-group-addon">折扣</span>'
                    +'<input type="text" class="form-control" name="'+type+'['+key+'][discount]" value="">'
                    +'<span class="input-group-addon">折 立减</span>'
                    +'<input type="text" class="form-control" name="'+type+'['+key+'][money]" value="">'
                    +'<span class="input-group-addon">元</span>'					
                    +'<div class="input-group-select">'
					+'	<input type="hidden" name="mcgroup['+key+'][grouptitle]" value="'+firsttitle+'">'
                    +'	<select name="mcgroup['+key+'][groupid]" class="form-control">'
                    +'	'+option
                    +'	</select>'
                    +'</div>'
                    +'<div class="input-group-btn">'                    
                    +'	<button class="btn btn-danger" type="button" onclick="removeConsumeItem(this)"><i class="fa fa-remove"></i></button>'
                    +'</div>'
                +'</div>';
            }
            $(obj).parent().siblings('.recharge-items').append(html);
        }
        function removeConsumeItem(obj){
            $(obj).parent().parent().remove();
        }
        $("#tab_mcgroup").delegate("select","change",function(e){
            $(this).prev('input').val($(this).find('option:selected').text());
        });
    </script>
</div>