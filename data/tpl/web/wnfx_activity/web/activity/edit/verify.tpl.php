<?php defined('IN_IA') or exit('Access Denied');?><div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">签到设置</div>
    <div class="region-activity-right col-sm-10">
        <div class="alert alert-info">
            提示：签到功能仅用于报名用户现场扫描活动签到码有效，核销员核销无用。
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">现场签到</label>
            <div class="col-sm-5 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][signin]" value="1"<?php  if($item['switch']['signin']) { ?> checked<?php  } ?>> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[switch][signin]" value="0"<?php  if(!$item['switch']['signin']) { ?> checked<?php  } ?>> 关闭
                </label>                        	
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">签到次数</label>
            <div class="col-sm-5 col-xs-12">
                <div class="input-group">
                    <input type="text" name="activity[signin][num]" class="form-control" value="<?php echo $item['signin']['num']>0?$item['signin']['num']:''?>" placeholder="默认只可签到1次" />
                    <span class="input-group-addon">
                        <label class="checkbox-inline"><input type="checkbox" name="activity[signin][everyday]" value="1" <?php  if($item['signin']['everyday']) { ?>checked<?php  } ?>> 每天</label>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group ">
            <label class="col-sm-2 control-label">距离限制</label>
            <div class="col-sm-5 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[signin][rangeon]" value="1"<?php  if($item['signin']['rangeon']) { ?> checked<?php  } ?> onclick="groupShow('.signinrange',1)"> 开启
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[signin][rangeon]" value="0"<?php  if(!$item['signin']['rangeon']) { ?> checked<?php  } ?> onclick="groupShow('.signinrange',0)"> 关闭
                </label>
            </div>
        </div>
        <div class="form-group signinrange" style="<?php  if($item['signin']['rangeon']!=1) { ?>display:none<?php  } ?>">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-5 col-xs-12">
                <div class="input-group">
                    <input type="number" name="activity[signin][range]" class="form-control" value="<?php echo $item['signin']['range']>0?$item['signin']['range']:''?>" placeholder="默认500米" />
                    <span class="input-group-addon">米</span>
                </div>
                <span class="help-block">限制用户位置与现场的距离，超过不可签到，请填写整数</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">有效期限</label>
            <div class="col-sm-5 col-xs-12">
                <label class="radio-inline">
                    <input type="radio" name="activity[signin][istime]" value="2"<?php  if($item['signin']['istime']==2) { ?> checked<?php  } ?> onclick="groupShow('.signintime',1)"> 设置
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[signin][istime]" value="1"<?php  if($item['signin']['istime']==1) { ?> checked<?php  } ?> onclick="groupShow('.signintime',0)"> 不限制
                </label>
                <label class="radio-inline">
                    <input type="radio" name="activity[signin][istime]" value="0"<?php  if(empty($item['signin']['istime'])) { ?> checked<?php  } ?> onclick="groupShow('.signintime',0)"> 默认
                </label>
                <div class="input-group signintime" style="margin-top:15px;<?php  if($item['signin']['istime']!=2) { ?>display:none<?php  } ?>">
                    <span class="input-group-addon">选择时间</span>
                    <?php  echo tpl_form_field_daterange('activity[signin]', array('start' =>$item['signin']['start'],'end' =>$item['signin']['end']), true);?>
                </div>
                <span class="help-block">默认：活动开始提前30分钟进行</span>
            </div>
        </div>
    </div>
</div>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">场地设置</div>
    <div class="region-activity-right col-sm-10">
    	<?php  if(checkplugin('seat')) { ?>
    	<div class="form-group">
        	<label class="col-sm-2 control-label">支持选座</label>
            <div class="col-sm-5 col-xs-12">
                <label class="checkbox-inline">
                    <input type="checkbox" name="activity[switch][seat]" value="1"<?php  if($item['switch']['seat']) { ?> checked<?php  } ?> onclick='if($(this).get(0).checked){$("#my_seat").show()}else{$("#my_seat").hide()}'> 开启
                </label>
                <span class="help-block">开启后，当前活动在下单时支持座位选择</span>          
            </div>
        </div>
        <div class="form-group" id="my_seat" style="<?php  if($item['switch']['seat']!=1) { ?>display:none<?php  } ?>">
        	<label class="col-sm-2 control-label"></label>
            <div class="col-sm-6 col-xs-12">
                <?php  echo tpl_selector('seatid',array('text'=>'name','nokeywords'=>1,'preview'=>false,'type'=>'text','placeholder'=>'座位名称','buttontext'=>'选择座位 ', 'items'=>$seat,'url'=>web_url('seat/query',array('merchid'=>$merch['id']))))?>                
            </div>
        </div>
        <?php  } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">选择场地</label>
            <div class="col-sm-6 col-xs-12 chks">               
                <?php  echo tpl_selector('storeid',array('multi'=>1,'text'=>'storename','nokeywords'=>1,'preview'=>true,'type'=>'text','placeholder'=>'门店名称','buttontext'=>'选择门店 ', 'items'=>$store,'url'=>web_url('store/query',array('merchid'=>$merch['id']))))?>
            </div>
            <div class="col-sm-4 col-xs-12">
                <label class="checkbox-inline">
                    <input type="checkbox" name="activity[hasstore]" value="1"<?php  if($item['hasstore']==1) { ?>checked<?php  } ?> onclick='if($(this).get(0).checked){$("#my_store").show()}else{$("#my_store").hide()}' />内部设置
                </label>
            </div>
        </div>
        <div class="form-group" id="my_store" style="<?php  if($item['hasstore']!=1) { ?>display:none<?php  } ?>">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">场地名称</span>
                    <input type="text" name="activity[addname]" class="form-control" value="<?php  echo $item['addname'];?>" placeholder="例如XXX大厦"/>
                </div>
                <div class="input-group" style="margin-top:10px">
                    <span class="input-group-addon">联系电话</span>
                    <input type="text" name="activity[tel]" class="form-control" value="<?php  echo $item['tel'];?>" placeholder="不填写不显示"/>
                </div>
                <div class="input-group" style="margin-top:10px">
                    <span class="input-group-addon">详细地址</span>
                    <input type="text" name="activity[address]" class="form-control" value="<?php  echo $item['address'];?>" placeholder="活动详细地址" id="address"/>
                </div>
                <div class="input-group" style="margin-top:10px">
                    <span class="input-group-addon">场地坐标</span>
                    <?php  echo tpl_form_field_position('activity',array('lng'=>$item['lng'],'lat'=>$item['lat'],'adinfo'=>$item['adinfo']))?>
                </div>
                <span class="help-block">
                    提醒：开启内部设置，选择场地将失效，同时只有全局核销员才可以核销当前活动。
                </span>
            </div>
        </div>        
        <div class="form-group">
        	<label class="col-sm-2 control-label"> </label>
        	<div class="col-sm-10 col-xs-12">
            </div>
        </div>
    </div>
</div>
<script language='javascript'>
function select_merch(o) {
	$('#storeid_selector').data("url","<?php  echo web_url('store/query')?>&merchid="+o.id);
	$('#storeid-selector-modal').remove();
	$('#seatid_selector').data("url","<?php  echo web_url('seat/query')?>&merchid="+o.id);
	$('#seatid-selector-modal').remove();
}
</script>