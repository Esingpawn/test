<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
.mui-media-object {width: 110px;height: 110px;padding: 2px;border-radius: 5px;background-color: #FFF;}
.mui-media-object span{ width:106px; height:106px; border-radius: 5px;display:block;background-size:auto 100%!important;  }
#selector{background:#f7f7f7; height:80%;}
#selector .mui-popover-content{ height:80%;}
#selector .mui-scroll-wrapper{ margin-bottom:0;}
#selector .mui-table-view:after{ height:1px;}
#selector .mui-table-view{border-radius: 0; text-align:left;color:#333;}
#selector .mui-table-view.mui-table-view-radio li{display:inline-block;border-radius:8px;padding:8px 10px;background:#eaeaea;margin:0 8px 5px 0;}
#selector .mui-table-view.mui-table-view-radio li:after{height:0;}
#selector .mui-table-view.mui-table-view-radio li.mui-selected{color:#FFF;background:#ff5000;}
#selector .mui-table-view.mui-table-view-radio li.noselect{color: #333;background:#eaeaea;}
#selector .mui-table-view.mui-table-view-radio.mui-single li{display:block;font-size:14px;margin-right:0;margin-bottom:10px;border-radius:5px;line-height:2.2;background:#f5f5f5;border:1px solid #eaeaea;}
#selector .mui-table-view.mui-table-view-radio.mui-single li>a:not(.mui-btn){margin: -11px -10px;border-radius:0;}
#selector .mui-table-view.mui-table-view-radio.mui-single li .mui-badge{right:5px;color:#FF7B33}
#selector .mui-table-view.mui-table-view-radio.mui-single li .mui-navigate-right:after{font-family:Muiext;content: " ";font-size:18px;}
#selector .mui-table-view.mui-table-view-radio.mui-single li.mui-selected{color:#333;background:#f5f5f5;border:1px solid #008fe0;}
#selector .mui-table-view.mui-table-view-radio.mui-single li.mui-selected .mui-navigate-right:after{color:#008fe0;content:"\e675";top:inherit!important;right:-0px;bottom:-6px}
#selector .mui-table-view.mui-table-view-radio .disabled{-webkit-filter:grayscale(100%);filter:grayscale(100%);color: #999}
#selector .mui-bar-footer{padding:0; background:#fff; height:45px;line-height:50px;}
#selector .mui-bar-footer .mui-btn{width:40%;height:100%;top: 0px;font-size: 0.65rem;border-radius:0;float:right;margin:0!important}
#icon-close{ color:#5f646e;position: absolute; top:40px; right:5px;font-weight: bold; z-index:999;}
</style>
<div id="selector" class="mui-popover mui-popover-bottom mui-popover-action">
	<div class="mui-popover-header">请选择<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="selector"><me class="mui-icon mui-icon-closeempty"></me></a></div>
    <div class="mui-popover-content">
    	<div class="mui-scroll-wrapper">
            <div class="mui-scroll" style="padding-bottom:50px;">
                <!-- 可选择菜单 -->
                <?php  if(is_array($specs)) { foreach($specs as $spec) { ?>
                <input type='hidden' name="optionid[]" class='optionid optionid_<?php  echo $spec['id'];?>' value="" title="<?php  echo $spec['title'];?>">
                <p style="margin: 8px;"><?php  echo $spec['title'];?></p>
                <ul class="mui-table-view mui-table-view-radio<?php  if(count($specs)==1) { ?> mui-single<?php  } ?>" specid='<?php  echo $spec['id'];?>'>
                <?php  if(is_array($spec['items'])) { foreach($spec['items'] as $k => $sp) { ?>
                    <?php  if(count($specs)==1) { ?>
                        <?php  $option = $sp['option'];?>
                        <li class="mui-table-view-cell mui-badge js-selector-check<?php  if($options[$k]['check']) { ?> mui-selected<?php  } ?><?php  if($option['stock']-$options[$k]['usednum']-$option['falsenum']<=0) { ?> disabled<?php  } ?>" specid='<?php  echo $spec['id'];?>' oid="<?php  echo $sp['id'];?>" select="<?php  if($k==0) { ?>true<?php  } else { ?>false<?php  } ?>">
                        <a class="mui-navigate-right"><?php  echo $sp['title'];?><span class="mui-badge mui-badge-inverted mui-big <?php  if($option['marketprice']>0) { ?>mui-rmb<?php  } ?>">
                        <?php echo $option['marketprice']>0?$option['marketprice']:'免费'?>
                        <?php  if($_W['plugin']['card']['config']['card_enable'] && $activity['iscard']==1 && !$activity['prize']['cardper']['enable'] && $option['aprice']>0) { ?>
                            <span class="mui-small"><?php  echo $yearcard['name'];?>:<?php  echo $option['costprice'];?></span>
                        <?php  } ?>
                        </span></a></li>                    
                    <?php  } else { ?>
                    	<li class="mui-table-view-cell mui-badge js-selector-check" specid='<?php  echo $spec['id'];?>' oid="<?php  echo $sp['id'];?>" select="false"><?php  echo $sp['title'];?></li>
                    <?php  } ?>
                <?php  } } ?>
                </ul>
                <?php  } } ?>
                <ul class="mui-table-view"<?php  if($activity['limitnum']==1) { ?> style="display:none"<?php  } ?>>
                    <li class="mui-table-view-cell" style="padding:8px 0;">
                        <span style="line-height:2.1">输入数量</span>
                        <span class="mui-numbox mui-pull-right">
                        <button class="mui-btn mui-btn-numbox-minus" type="button">-</button>
                        <input name="buynum" class="mui-input-numbox js-buynum" type="number" value="1" pattern="[0-9]*">
                        <button class="mui-btn mui-btn-numbox-plus" type="button">+</button>
                        </span>
                    </li>
                </ul>
                <?php  if($activity['gnumshow']) { ?>
                <p class="mui-text-gray mui-text-right" style="padding-right:8px;"><span id="gnum"><?php  if($activity['gnum']>0 || $optgnum>0) { ?>剩余<?php echo $forgnum?$forgnum:($activity['gnum']>$joinnum?$activity['gnum']-$joinnum:0);?><?php  echo $activity['unitstr'];?><?php  } else { ?>不限量<?php  } ?></span></p>
                <?php  } ?>
                <p style="padding-bottom:50px;"></p>
            </div>
        </div>
    </div>
    <div class="mui-bar mui-bar-footer">
        <p class="mui-pl10" id="option_aprice" style="width:60%;display:inline-block;">合计
        	<span class="mui-rmb mui-big mui-text-orange"><?php  echo $payprice;?></span>
            <?php  if($_W['plugin']['card']['config']['card_enable'] && in_array($activity['iscard'], array('1','2')) && !$activity['prize']['cardper']['enable']) { ?>
            <span class="mui-small <?php  if($is_vip) { ?>mui-text-orange<?php  } else { ?>mui-del mui-text-gray<?php  } ?>">(VIP)</span>
            <span class="mui-small mui-rmb mui-del mui-text-gray"><?php  if($is_vip) { ?><?php  echo $options[0]['marketprice'];?><?php  } else { ?><?php  echo $costprice;?><?php  } ?></span>
            <?php  } ?>
        </p>
        <input type="hidden" id="marketprice" name="marketprice" value="<?php  echo $marketprice;?>"/>
        <input type="hidden" id="costprice" name="costprice" value="<?php  echo $costprice;?>"/>
        <input type="hidden" id="payprice" name="payprice" value="<?php  echo $payprice;?>"/>
        <input type="hidden" id="optionid" name="optionid" value="<?php  echo $optionid;?>"/>
        <input type="hidden" id="forgnum" value="<?php echo $forgnum?$forgnum:($activity['gnum']>$joinnum?$activity['gnum']-$joinnum:0);?>" />
        <input type="hidden" id="stock" value="<?php echo $optgnum?$optgnum:$activity['gnum']?>" />
        <button type="button" class="mui-btn mui-btn-yellow" onclick="joinNext()">下一步</button>
    </div>
</div>
<script>
mui('.mui-scroll-wrapper').scroll();
//触发规格选择器
$(".js-selector").on("tap",function(e) {
	mui('#selector').popover('toggle');
});
var options = <?php  echo json_encode($options)?>;
var specs = <?php  echo json_encode($specs)?>;
var aprice   ="<?php  echo $activity['aprice'];?>",
	limitnum = parseInt("<?php  echo $activity['limitnum'];?>"),
	agnum    = parseInt("<?php  echo $activity['gnum'];?>"),
	joinnum   = parseInt("<?php  echo $joinnum;?>"),
	optionid  = parseInt("<?php  echo $optionid;?>"),
	atype     = parseInt("<?php  echo $activity['atype'];?>"),
	unitstr   = "<?php  echo $activity['unitstr'];?>";
var selected = [];
function option_selected() {
	var ret = {
		no: [],
		is: [],
		all: []
	};
	$(".optionid").each(function () {
		ret.all.push($(this).val());
		//console.log($(this).val());
		if ($(this).val() == '') {
			ret.no.push($(this).attr("title"));
			//ret.no = $(this).attr("title");
		}else{
			ret.is.push($(this).attr("title"));
			
		}
	})
	if (typeof(ret.no[0])=='undefined'){
		ret.no[0]='';
	}
	return ret;
}
$(function(){
	//输入名额控制
	$("input.js-buynum").bind('input propertychange, change', function(e) {
		e.stopPropagation();
		var forgnum=parseInt($("#forgnum").val()),stock=parseInt($("#stock").val());
		if ($(this).val()<=0){
			$(this).val(1);
		}
		//判断名额
		if(forgnum==0 && stock>0){
			$(this).val(0);
			util.alert('该票已售完', ' ');
			return false;
		}else if($(this).val() > forgnum && stock>0){
			$(this).val(forgnum);
			util.alert('已超出剩余最大值', ' ');
			return false;
		}
		if ($(this).val() > limitnum && limitnum > 0){
			$(".js-buynum").val(limitnum);
			util.alert('已达该票输入最大值', ' ', function() {
				$(".js-buynum").val(limitnum);
			});
		}else{
			var payprice = ($('#payprice').val()*$(this).val()).toFixed(2);
			$('#option_aprice .mui-rmb').html(payprice);
			$("#option_aprice .mui-rmb").next().next().html(($("#<?php echo $is_vip?'marketprice':'costprice'?>").val()*$(this).val()).toFixed(2))
		}
	});
	//选项控制
	$(".js-selector-check").on("tap",function() {
		var specid = $(this).attr("specid");
		var specnum = $('.mui-table-view-radio').length;
		var oid = $(this).attr("oid");
		$(".optionid_" + specid).val(oid);
		
		if ($(this).attr("select")=='true' && specnum>1){//多规格选中后取消
		    console.log('多规格选中后取消')
			$(this).toggleClass('noselect');
			$(this).attr("select", "flase");
			$(".optionid_" + specid).val('');
			if (aprice>0){
				$("#option_aprice .mui-rmb").html((aprice*$(".js-buynum").val()).toFixed(2));
				$("#marketprice").val(aprice);
			}else{
				$("#option_aprice .mui-rmb").html('0.00');
				$("#marketprice").val('0.00');
			}
			if (agnum>0 && agnum>joinnum){
				$("#gnum").html("剩余"+(agnum-joinnum)+unitstr);
			}else{
				$("#gnum").html("不限量");
			}
			var ret = option_selected();
			var option_msg = '';
			for (var i = 0; i < ret.no.length; i++) {
				option_msg += ret.no[i]+' ';
			}
			optionid = 0;
			$("#option_msg").html('请选择：'+option_msg);	
		}else{//选中
		console.log('选中')
			$(this).removeClass('noselect');
			$(this).parent('ul').find('.js-selector-check').attr("select", "flase");
			$(this).attr("select", "true");
			var stock = 0, optused = 0, marketprice = 0, costprice = 0, opttitle = '', option_msg = '';
			var ret = option_selected();
			var len = options.length;
			if (ret.no[0] == '') {//判断是否全选中
				for (var i = 0; i < len; i++) {
					var o = options[i];
					var ids = ret.all.sort();
					var specs = o.specs.split('_').sort();
					option_msg += ret.is[i]+' ';
					if (specs.toString() == ids.toString()) {
						optionid = o.id;
						stock = parseInt(o.stock);
						optused = parseInt(o.usednum)+parseInt(o.falsenum);
						marketprice = o.marketprice;
						costprice = o.costprice;
						opttitle = o.title;
						break;
					}
				}
				$("#optionid").val(optionid);
				$("#gnumval").val(stock);
				$("#option_msg").html('已选：'+opttitle);
				
				<?php  if($_W['plugin']['card']['config']['card_enable'] && $is_vip && $activity['iscard']==1 && !$activity['prize']['cardper']['enable']) { ?>
					if (marketprice>0){
						$("#option_aprice .mui-rmb").html((costprice*$(".js-buynum").val()).toFixed(2));
						$("#option_aprice .mui-rmb").next().html('(VIP)');
						$("#option_aprice .mui-rmb").next().next().html((marketprice*$(".js-buynum").val()).toFixed(2));
						$("#marketprice").val(marketprice);
						$("#costprice").val(costprice);
						$("#payprice").val(costprice);
					}else{
						$("#option_aprice .mui-rmb").html('0.00');
						$("#marketprice").val('0.00');
						$("#payprice").val('0.00');
					}
				<?php  } else { ?>
					if (marketprice>0){
						$("#option_aprice .mui-rmb").html((marketprice*$(".js-buynum").val()).toFixed(2));
						$("#option_aprice .mui-rmb").next().next().html((costprice*$(".js-buynum").val()).toFixed(2));
						$("#marketprice").val(marketprice);
						$("#costprice").val(costprice);
						$("#payprice").val(marketprice);
					}else{
						$("#option_aprice .mui-rmb").html('0.00');
						$("#marketprice").val('0.00');
						$("#payprice").val('0.00');
					}
				<?php  } ?>		
				
				if(stock>0){
					num = stock > optused ? stock-optused:0;
					$("#gnum").html("剩余"+num+unitstr);
					$("#forgnum").val(num);
					$("#stock").val(stock);
					if (num<=0) util.alert('该票已售完', ' ');
				}else{
					$("#gnum").html("不限量");
					$("#forgnum").val(0);
					$("#stock").val(0);
				}
				
			}else{
				for (var i = 0; i < ret.no.length; i++) {
					option_msg += ret.no[i]+' ';
				}
				$("#option_msg").html('请选择：'+option_msg);	
			}
		}
		
	});
});

function joinNext() {
	var ret = option_selected();
	ret.no[0] = optionid?'':ret.no[0];
	if (ret.no[0] != '') {
		util.alert('请选择 '+ret.no[0]+' !', ' ', function() {});
		return;
	}
	var inputnum = parseInt($(".js-buynum").val());
	var url = "<?php  echo app_url('order/create', array('id'=>$id))?>" + "&optionid=" + $("#optionid").val() + "&buynum=" + inputnum;
	history.back(-1);
	util.program.navigate(url, "<?php  echo $_W['routes'];?>");
}
</script>