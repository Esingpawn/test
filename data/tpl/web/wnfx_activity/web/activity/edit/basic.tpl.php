<?php defined('IN_IA') or exit('Access Denied');?><div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">基本信息</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">排序</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" name="activity[displayorder]" id="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>"/>
                <span class='help-block'>数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">活动名称</label>
            <div class="col-sm-7 gtitle" style="padding-right:0;">
                <input type="text" name="activity[title]" id="activityname" class="form-control" value="<?php  echo $item['title'];?>" data-parent="#activityname" data-rule-required="true"/>
            </div>
            <div class="col-sm-2" style="padding-left:5px">
                <input type="text" name="activity[unitstr]" class="form-control" value="<?php  echo $item['unitstr'];?>" placeholder="单位, 如: 件/份/名额"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">副标题</label>
            <div class="col-sm-9 subtitle">
                <textarea id="" name="activity[intro]" id="subtitle" rows="5" class="form-control" data-parent=".subtitle" maxlength="100" data-rule-maxlength="100"><?php  echo $item['intro'];?></textarea>
                <div class="help-block">
                    副标题的长度请控制在100字以内
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动类型</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                <input type="radio" name="activity[atype]" value="1" <?php  if(intval($item['atype'])==1 || empty($item['atype'])) { ?>checked="true"<?php  } ?> /> 常规
                </label>
                <?php  if(!MERCHANTID && $_W['_config']['merch']) { ?>
                <label class="radio-inline">
                <input type="radio" name="activity[atype]" value="3" <?php  if(intval($item['atype'])==3) { ?>checked="true"<?php  } ?> /> 官方推广
                </label>
                <?php  } ?>
                <label class="radio-inline">
                <input type="radio" name="activity[atype]" value="4" <?php  if(intval($item['atype'])==4) { ?>checked="true"<?php  } ?> /> 仅供浏览
                </label>
                <?php  if(!MERCHANTID && $_W['_config']['merch']) { ?>
                <span class="help-block">设置为官方推广，所有商户主页均可显示，设置权限：平台</span>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">主办商户</label>
             <div class="col-sm-9 col-xs-12">
                <?php  if(MERCHANTID) { ?>
                <span class="uneditable-input form-control"><?php  echo $merch['name'];?></span>
                <input name="merchid" value="<?php  echo $merch['id'];?>" type="hidden">
                <?php  } else { ?>
                <?php  echo tpl_selector('merchid',array('key'=>'id','text'=>'name','nokeywords'=>0,'preview'=>false,'multi'=>0,'type'=>'text','placeholder'=>'商户名称','buttontext'=>'选择商户','callback'=>'select_merch','items'=>$merch,'url'=>web_url('merch/user/query') ))?>
                <?php  } ?>
            </div>
        </div>
    </div>
</div>
<!--活动信息-->
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">活动信息</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">活动属性</label>
            <div class="col-sm-9 col-xs-12">
                <label for="recommend" class="checkbox-inline">
                    <input type="checkbox" name="activity[recommend]" id="recommend" value="1"<?php  if($item['recommend']==1) { ?> checked<?php  } ?> /> 推荐
                </label>
                <!--<label for="ishot" class="checkbox-inline">
                    <input type="checkbox" name="ishot" id="ishot" value="1"<?php  if($item['ishot']==1) { ?> checked<?php  } ?> /> 热门
                </label>-->
                <label for="hasonline" class="checkbox-inline">
                    <input type="checkbox" name="activity[hasonline]" id="hasonline" value="1" <?php  if($item['hasonline']==1) { ?>checked<?php  } ?> onclick='if($(this).get(0).checked){$("#tab_nav_verify").hide()}else{$("#tab_nav_verify").show()}'/>线上参与
                </label>
                <span class="help-block">开启推荐会在首页精选区域显示，否则显示在下方列表.<br>设置为线上活动，线下核销设置关闭，用户无需现场参与.</span>
            </div>
        </div>                                                             
        <div class="form-group">
            <label class="col-sm-2 control-label">活动分类</label>
            <div class="col-sm-9 col-xs-12">
                <select name="cates" class='form-control select2' data-placeholder="活动分类">
                    <option value="">活动分类</option>
                    <?php  if(is_array($category['0'])) { foreach($category['0'] as $parent) { ?>
                        <option value="<?php  echo $parent['id'];?>"<?php  if($item['parentid']==$parent['id']) { ?> selected<?php  } ?>><?php  echo $parent['name'];?></option>
                        <?php  if(is_array($category['1'][$parent['id']])) { foreach($category['1'][$parent['id']] as $child) { ?>
                        <option value="<?php  echo $parent['id'];?>,<?php  echo $child['id'];?>"<?php  if($item['childid']==$child['id']) { ?> selected<?php  } ?>><?php  echo $parent['name'];?> - <?php  echo $child['name'];?></option>
                        <?php  } } ?>
                    <?php  } } ?>
                </select>
            </div>
        </div>
        <div <?php  if(!$_W['plugin']['card']['config']['card_enable']) { ?>style="display:none"<?php  } ?>>
        <div class="form-group">
            <label class="col-sm-2 control-label">年卡优惠</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[iscard]" value="0"<?php  if(intval($item['iscard'])==0 || empty($item['iscard'])) { ?> checked<?php  } ?>> 关闭
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[iscard]" value="1"<?php  if(intval($item['iscard'])==1) { ?> checked<?php  } ?>> 支持
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[iscard]" value="2"<?php  if(intval($item['iscard'])==2) { ?> checked<?php  } ?>> 年卡专属
                </label>
                <span class="help-block">提示：是否开启活动年卡支持</span>
            </div>
        </div>
        <div class="form-group iscard"<?php  if($item['iscard']!=1) { ?> style="display:none"<?php  } ?>>
            <label class="col-sm-2 control-label">年卡价格</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">￥</span>
                    <input type="text" name="activity[costprice]" class="form-control" value="<?php  echo $item['costprice'];?>" placeholder="不设置，免费">
                </div>
            </div>
        </div>
        </div>
        <div class="form-group price">
            <label class="col-sm-2 control-label">活动价格</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">￥</span>
                    <input type="text" name="activity[aprice]" class="form-control" value="<?php  echo $item['aprice'];?>" placeholder="不设置，免费">
                    <span class="input-group-addon">原价￥</span>
                    <input type="text" name="activity[mprice]" class="form-control" value="<?php  echo $item['mprice'];?>">
                    <span class="input-group-addon">免费标签</span>
                    <input type="text" name="activity[freetitle]" class="form-control" value="<?php  echo $item['freetitle'];?>" placeholder="默认：免费活动">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">消耗<?php  echo $creditName;?></label>
            <div class="col-sm-9 col-xs-12">
            	<input type="number" name="activity[costcredit]" class="form-control" value="<?php  echo $item['costcredit'];?>" placeholder="不设置，不消耗<?php  echo $creditName;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">报名时间</label>
            <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_form_field_daterange('joinTime', array('start' =>$item['joinstime'],'end' =>$item['joinetime']), true);?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动时间</label>
            <div class="col-sm-9 col-xs-12">
            	<style>#timeBox{display:inline-block}#phaseBox~.group-btn{display:inline-block}#phaseBox~.group-btn .fa{font-size:9px;text-align:center;position:relative;width:11px;height:10px;}#phaseBox~.group-btn .fa:before{left:0;position:absolute;}</style>
                <div id="timeBox" style="<?php  if($item['hasoption']==2) { ?> display:none<?php  } ?>"><?php  echo tpl_form_field_daterange('activityTime', array('start' =>$item['starttime'],'end' =>$item['endtime']), true);?></div>
                <div id="phaseBox" style="margin-top:7px;<?php  if($item['hasoption']==1 || empty($specs['0'])) { ?>display:none<?php  } ?>">
                	<?php  if($item['hasoption']==2 && !empty($specs['0'])) { ?>
                    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/tpl/phase', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/tpl/phase', TEMPLATE_INCLUDEPATH));?>
                    <?php  } ?>
                </div>
                <div class="group-btn" style="display:none">
                    <a class="btn btn-op<?php  if(!empty($hasorder)) { ?> btn-danger disabled<?php  } else { ?> btn-info<?php  } ?>" data-toggle="ajaxModal" href="<?php  echo web_url('activity/op/phase',array('id'=>$item['id']))?>"<?php  if($item['hasoption']==2) { ?> style=" display:none"<?php  } ?>>
                        <span data-toggle="tooltip" data-placement="top" data-original-title="适合相同的活动内容，在不同时间多次举办。可对每场活动的报名时间、票价等内容单独设置。">
                             <i class="fa fa-calendar"></i> <?php  if(!empty($hasorder)) { ?>已有订单“举办多次”功能不可用<?php  } else { ?>举办多次<?php  } ?>
                        </span>
                    </a>
                    <a class="btn btn-op btn-info" onclick='removePhase(this)'<?php  if($item['hasoption']!=2) { ?> style="display:none"<?php  } ?>>
                        <span data-toggle="tooltip" data-placement="top" data-original-title="活动只举办一次，请选择此功能。">
                             <i class="fa fa-calendar-o">1</i> 举办一次
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">缩略图片</label>
            <div class="col-sm-9 col-xs-12 gimg">
                <input type="hidden" name="thumb_old" value="<?php  echo $item['thumb'];?>">
                <?php  echo tpl_form_field_image('activity[thumb]', $item['thumb']);?>
                <span class="help-block">尺寸建议宽度为640</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">详情图片</label>
            <div class="col-sm-9 col-xs-12 gimgs">
                <?php  echo tpl_form_field_multi_image('atlas',$item['atlas']);?>
                <span class="help-block image-block">尺寸建议宽度为640，建议比例：1：1，并保持图片大小一致，图片大小依照首图尺寸显示</span>
                <span class="help-block">您可以拖动图片改变其显示顺序 </span>
            </div>
        </div>        
        
        <div class="form-group">
            <label class="col-sm-2 control-label">首图视频</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_video2('video', $item['video'], array('disabled'=>!perm('goods.edit'), 'network'=>true, 'placeholder'=>'请选择视频'))?>
                <div class='form-control-static'>设置后商品详情首图默认显示视频</div>
            </div>
        </div>
    </div>
</div>

<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">常用开关</div>
    <div class="region-activity-right col-sm-10">
        <?php  if(perm('goods.switch.refund')) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">支持退款</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][refund]" value="1"<?php  if($item['switch']['refund']) { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][refund]" value="0"<?php  if(!$item['switch']['refund']) { ?> checked<?php  } ?>> 关闭
                </label>
            </div>
        </div>
        <?php  } ?>
        <?php  if(perm('goods.switch.buycheck')) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">报名审核</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][joinreview]" value="1"<?php  if($item['switch']['joinreview']) { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][joinreview]" value="0"<?php  if(!$item['switch']['joinreview']) { ?> checked<?php  } ?>> 关闭【默认关闭无需审核】
                </label>
            </div>
        </div>
        <?php  } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">显示头像</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][avatar]" value="1"<?php  if($item['switch']['avatar'] || $item['switch']['avatar']=='') { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][avatar]" value="0"<?php  if($item['switch']['avatar']=='0') { ?> checked<?php  } ?>> 关闭【详情页显示报名用户头像列表】
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">已报人数</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][joinnum]" value="1"<?php  if($item['switch']['joinnum'] || $item['switch']['joinnum']=='') { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][joinnum]" value="0"<?php  if($item['switch']['joinnum']=='0') { ?> checked<?php  } ?>> 关闭【开启时移动端显示已报名人数】
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">取消报名</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][joincancel]" value="1"<?php  if($item['switch']['joincancel']) { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][joincancel]" value="0"<?php  if(!$item['switch']['joincancel']) { ?> checked<?php  } ?>> 关闭【已支付报名不可取消】
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">重复报名</label>
            <div class="col-sm-9 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][rejoin]" value="1"<?php  if($item['switch']['rejoin']) { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][rejoin]" value="0"<?php  if(!$item['switch']['rejoin']) { ?> checked<?php  } ?>> 关闭【同一用户可重复报名当前活动】
                </label>
            </div>
        </div>
    </div>
</div>
<script>
function addSpecItem1(obj, specid){
	var key = $(obj).parents('.spec_items').find('.spec_item').length+1;
	specid = specid == undefined ? '' : specid;
	$(obj).html("正在处理...").attr("disabled", "true");
	$.ajax({
		"url": "<?php  echo web_url('activity/tpl/phaseitem')?>" + "&specid=" + specid,
		data: {placeholder: '票种'+key, key: key},
		success:function(data){
			$(obj).html('<i class="fa fa-plus"></i> 添加票种').removeAttr("disabled");
			$(obj).parents('.table-footer').before(data);			
			//$('#'+$(data).find('.goods-des input').eq(0).attr('id')).rules('add', {required: true});
			$(obj).closest('.spec_items').find('.ops .op').removeClass("disabled");
		}
	});
}

function delSpec(obj){
	var siblings = $(obj).closest('.table-con').siblings('.table-con');
    $(obj).closest('.table-con').remove();
	siblings.each(function(key){
		var title =  $(this).find('.goods-des span').text();
		title = title.replace(/第(\d+)场/g, "第"+(key+1)+"场");
		$(this).find('.goods-des span').html(title), $(this).find('.goods-des span').next().val(title);
	});
}

function delSpecItem(obj){
	var last = $(obj).closest('.spec_item').siblings('.spec_item');
	last.length==1 && last.find('.ops .op').addClass("disabled");
    $(obj).closest('.spec_item').remove();	
}

function removePhase(obj){
	$('#ajaxModal').remove(),
	$('#timeBox').show(), 
	$('#phaseBox').html('').hide(), 
	$('#option_inner').show();
	$('#hasoption').removeAttr("disabled");
	$(obj).hide(), $(obj).prev().show();
}

function refreshPhase(){
	
}
</script>