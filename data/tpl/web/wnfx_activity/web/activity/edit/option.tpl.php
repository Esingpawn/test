<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">#options.markethide .card-type, .markethide.market{display:none}</style>
<div class="region-activity-details row">
    <div class="region-activity-left col-sm-2">库存</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-1 control-label">库存</label>
            <div class="col-sm-11 col-xs-12">
                <input type="text" name="activity[gnum]" id="gnum" class="form-control hasoption" value="<?php echo $item['gnum']?$item['gnum']:'';?>"<?php  if($item['hasoption']==1) { ?>readonly<?php  } ?> style="width:400px;display:inline;margin-right:20px;"/>
                <label class="checkbox-inline">
                <input type="checkbox" id="gnumshow" value="1" name="activity[gnumshow]" <?php  if($item['gnumshow']==1) { ?>checked<?php  } ?>/>显示库存
                </label>
                <span class="help-block">活动的剩余数量, 如启用多规格，则此处设置无效.</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">限购设置</label>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <input type="text" name="activity[limitnum]" class="form-control" value="<?php echo $item['limitnum']?$item['limitnum']:'';?>">
                    <span class="input-group-addon">名额</span>
                </div>
                <span class="help-block">单次购买数量上限，默认不填或填 0 则不限制。（填 1 则不显示数量输入框）</span>
            </div>
        </div>                                                                
    </div>                            
</div>
<style type='text/css'>.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {border:none !important;}</style>
<div class="region-activity-details row" id="option_inner"<?php  if($item['hasoption']==2) { ?> style="display:none"<?php  } ?>>
    <div class="region-activity-left col-sm-2">规格</div>
    <div class="region-activity-right col-sm-10">
        <div class="form-group">
            <div class="" style='padding-left:30px;'>
                <label class="checkbox-inline">
                <input type="checkbox" id="hasoption" value="1" name="activity[hasoption]" <?php  if($item['hasoption']==1) { ?>checked<?php  } ?><?php  if($item['hasoption']==2) { ?> disabled<?php  } ?>/>启用
                </label>
                <span class="help-block">启用活动规格后，活动的价格及库存以活动规格为准，库存设置为0为不限制</span>
            </div>
        </div>
        <div id='tboption' style="padding-left:15px;<?php  if($item['hasoption']!=1) { ?>display:none<?php  } ?>">
            <div class="alert alert-info">
                1. 拖动规格可调整规格显示顺序, 更改规格及规格项后请点击下方的【刷新规格项目表】来更新数据。
                <br/>
                2. 每一种规格代表不同型号，例如颜色为一种规格，尺寸为一种规格，如果设置多规格，手机用户必须每一种规格都选择一个规格项，才能添加购物车或购买。
            </div>
            <div id='specs'>
            	<?php  if($item['hasoption']!=2) { ?>
                <?php  if(is_array($specs['0'])) { foreach($specs['0'] as $spec) { ?>
                <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/tpl/spec', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/tpl/spec', TEMPLATE_INCLUDEPATH));?>
                <?php  } } ?>
                <?php  } ?>
            </div>
            <table class="table">
            <tr>
                <td>
                    <h4><a href="javascript:;" class='btn btn-primary' id='add-spec' onclick="addSpec()" style="margin-top:10px;margin-bottom:10px;" title="添加规格"><i class='fa fa-plus'></i> 添加规格</a>
                    <a href="javascript:;" onclick="refreshOptions();" title="刷新规格项目表" class="btn btn-primary"><i class="fa fa-refresh"></i> 刷新规格项目表</a></h4>
                </td>
            </tr>
            <tr style="display:none;" id="optiontip">
                <td>
                    <div class="alert alert-danger">
                        警告：规格数据有变动，请重新点击上方 [刷新规格项目表] 按钮！
                    </div>
                </td>
            </tr>
            </table>
            <div id="options" class="<?php  if($item['iscard']!=1) { ?>markethide<?php  } ?>" style="padding:0;">
            	<?php  if($item['hasoption']!=2) { ?><?php  echo $specs['1'];?><?php  } ?>
            </div>
        </div>        
    </div>
</div>
<input type="hidden" name="optionArray" value=''>
<input type="hidden" name="isdiscountDiscountsArray" value=''>
<input type="hidden" name="discountArray" value=''>
<input type="hidden" name="commissionArray" value=''>
<script language="javascript">
$(function(){
    $(document).on('input propertychange change', '#specs input', function () {
        // 改变规格锁定提交
        window.optionchanged = true;
        $('#optiontip').show();
    });
	
    $(".spec_item_thumb").find('i').click(function(){
        var group  =$(this).parent();
        group.find('img').attr('src',"<?php echo FX_BASE;?>web/resource_v2/images/nopic100.jpg");
        group.find(':hidden').val('');
        $(this).hide();
        group.find('img').popover('destroy');
    });

	require(['jquery.ui'],function(){
		$('#specs').sortable({
			stop: function(){
				refreshOptions();
			}
		});
		$('.spec_item_items').sortable({
			handle:'.fa-arrows',
			stop: function(){
				refreshOptions();
			}
		}
		);
	});
	
    $("#hasoption").click(function(){
        var obj = $(this);
        if (obj.get(0).checked){
			refreshOptions();
            $("#tboption").show();
			$('#gnum').attr('readonly',true);
        }else{
			refreshOptions();
            $("#tboption").hide();
            $('#gnum').removeAttr('readonly').val('');
			
        }
    });
});

function selectSpecItemImage(obj){
    util.image('',function(val){
        $(obj).attr('src',val.url).popover({
            trigger: 'hover',
            html: true,
            container: $(document.body),
            content: "<img src='" + val.url  + "' style='width:100px;height:100px;' />",
            placement: 'top'
        });

        var group  =$(obj).parent();

        group.find(':hidden').val(val.attachment), group.find('i').show().unbind('click').click(function(){
            $(obj).attr('src',"<?php echo FX_BASE;?>web/resource_v2/images/nopic100.jpg");
            group.find(':hidden').val('');
            group.find('i').hide();
            $(obj).popover('destroy');
        });
    });
}
function addSpec(){
    var len = $(".spec_item").length;
    
    if(type==3 && virtual==0 && len>=1){
        tip.msgbox.err('您的商品类型为：虚拟物品(卡密)的多规格形式，只能添加一种规格！');
        return;
    }
    
    if(type==4 && virtual==0 && len>=2){
        tip.msgbox.err('您的商品类型为：批发商品的多规格形式，只能添加两种规格！');
        return;
    }
    
    if(type==10 && len>=1){
        tip.msgbox.err('您的商品类型为：话费流量充值，只能添加一种规格！')
        return;
    }
    
    $("#add-spec").html("正在处理...").attr("disabled", "true").toggleClass("btn-primary");
    var url = "<?php  echo web_url('activity/tpl/spec')?>";
    $.ajax({
        "url": url,
        success:function(data){
            $("#add-spec").html('<i class="fa fa-plus"></i> 添加规格').removeAttr("disabled").toggleClass("btn-primary"); ;
            $('#specs').append(data);
            var len = $(".add-specitem").length -1;
            $(".add-specitem:eq(" +len+ ")").focus();
            refreshOptions();
        }
    });
}
function removeSpec(specid){
    if (confirm('确认要删除此规格?')){
        $("#spec_" + specid).remove();
        refreshOptions();
    }
}
function addSpecItem(specid){
         $("#add-specitem-" + specid).html("正在处理...").attr("disabled", "true");
    var url = "<?php  echo web_url('activity/tpl/specitem')?>" + "&specid=" + specid;
    $.ajax({
        "url": url,
        success:function(data){
            $("#add-specitem-" + specid).html('<i class="fa fa-plus"></i> 添加规格项').removeAttr("disabled");
            $('#spec_item_' + specid).append(data);
            var len = $("#spec_" + specid + " .spec_item_title").length -1;
            $("#spec_" + specid + " .spec_item_title:eq(" +len+ ")").focus();
            refreshOptions();
            if(type==3 && virtual==0){
                $(".choosetemp").show();
            }
        }
    });
}
function removeSpecItem(obj){
    $(obj).closest('.spec_item_item').remove();
    refreshOptions();
}
function refreshOptions(){
    // 刷新后重置
    window.optionchanged = false;
    $('#optiontip').hide();

    var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
    var specs = [];
	if($('.spec_item').length<=0){
		$("#options").html('');
		$('#gnum').val('');
		return;
	}
    $(".spec_item").each(function(i){
        var _this = $(this);

        var spec = {
            id: _this.find(".spec_id").val(),
            title: _this.find(".spec_title").val()
        };

        var items = [];
        _this.find(".spec_item_item").each(function(){
            var __this = $(this);
            var item = {
                id: __this.find(".spec_item_id").val(),
                title: __this.find(".spec_item_title").val(),
                virtual: __this.find(".spec_item_virtual").val(),
                show:__this.find(".spec_item_show").get(0).checked?"1":"0"
            }
            items.push(item);
        });
        spec.items = items;
        specs.push(spec);
    });
    specs.sort(function(x,y){
        if (x.items.length > y.items.length){
            return 1;
        }
        if (x.items.length < y.items.length) {
            return -1;
        }
    });

    var len = specs.length;
    var newlen = 1;
    var h = new Array(len);
    var rowspans = new Array(len);
    for(var i=0;i<len;i++){
        html+="<th>" + specs[i].title + "</th>";
        var itemlen = specs[i].items.length;
        if(itemlen<=0) { itemlen = 1 };
        newlen*=itemlen;

        h[i] = new Array(newlen);
        for(var j=0;j<newlen;j++){
            h[i][j] = new Array();
        }
        var l = specs[i].items.length;
        rowspans[i] = 1;
        for(j=i+1;j<len;j++){
            rowspans[i]*= specs[j].items.length;
        }
    }

    html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">库存</div><div class="input-group"><input type="text" class="form-control  input-sm option_stock_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_stock\');"></a></span></div></div></th>';
    html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">虚拟报名</div><div class="input-group"><input type="text" class="form-control  input-sm option_falsenum_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_falsenum\');"></a></span></div></div></th>';
    html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">单价</div><div class="input-group"><input type="text" class="form-control  input-sm option_marketprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_marketprice\');"></a></span></div></div></th>';
    //html+='<th class="type-4"><div class=""><div style="padding-bottom:10px;text-align:center;">原价</div><div class="input-group"><input type="text" class="form-control  input-sm option_productprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_productprice\');"></a></span></div></div></th>';
	<?php  if($_W['plugin']['card']['config']['card_enable']) { ?>
    html+='<th class="card-type"><div class=""><div style="padding-bottom:10px;text-align:center;">年卡价</div><div class="input-group"><input type="text" class="form-control  input-sm option_costprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_costprice\');"></a></span></div></div></th>';
	<?php  } ?>
	html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">分销折扣价</div><div class="input-group"><input type="text" class="form-control  input-sm option_distribution_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_distribution\');"></a></span></div></div></th>';
    html+='</tr></thead>';

    for(var m=0;m<len;m++){
        var k = 0,kid = 0,n=0;
        for(var j=0;j<newlen;j++){
            var rowspan = rowspans[m];
            var spec_item = specs[m].items[kid] || {};
            var spec_item_title = spec_item.title;
            if(!spec_item_title || spec_item_title == 'undefined'){
                spec_item_title = '';
            }
            if( j % rowspan==0){
                h[m][j]={title: spec_item_title, virtual: spec_item.virtual,html: "<td class='full' rowspan='" +rowspan + "'>"+ spec_item_title+"</td>\r\n",id: spec_item.id};
            }
            else{
                h[m][j]={title:spec_item_title,virtual: spec_item.virtual, html: "",id: spec_item.id};
            }
            n++;
            if(n==rowspan){
                kid++; if(kid>specs[m].items.length-1) { kid=0; }
                n=0;
            }
        }
    }
    var hh = "",total_stock = 0;
    for(var i=0;i<newlen;i++){
        if (i != 0) {
            hh+="<tr style='border-top: 1px solid #eee'>";
        } else {
            hh+="<tr>";
        }

        var ids = [];
        var titles = [];
        var virtuals = [];
        for(var j=0;j<len;j++){
            hh+=h[j][i].html;
            ids.push( h[j][i].id);
            titles.push( h[j][i].title);
            virtuals.push( h[j][i].virtual);
        }

        var sortarr  = permute([],ids);
        titles= titles.join('+');
        ids = ids.join('_');
        var val ={ id : "",title:titles, stock : "",falsenum : "",costprice : "",productprice : "",marketprice : "",weight:"",productsn:"",goodssn:"",virtual:virtuals,distribution:"" };
        for(var kkk=0;kkk<sortarr.length;kkk++) {
            var sids = sortarr[kkk].join('_');
            if ($(".option_id_" + sids).length > 0) {
                val = {
                    id: $(".option_id_" + sids + ":eq(0)").val(),
                    title: titles,
                    stock: $(".option_stock_" + sids + ":eq(0)").val(),
                    falsenum: $(".option_falsenum_" + sids + ":eq(0)").val(),
                    costprice: $(".option_costprice_" + sids + ":eq(0)").val(),
                    productprice: $(".option_productprice_" + sids + ":eq(0)").val(),
                    distribution: $(".option_distribution_" + sids + ":eq(0)").val(),
                    marketprice: $(".option_marketprice_" + sids + ":eq(0)").val()
                }
				total_stock += parseInt(val.stock);
                break;
            }
        }
        hh += '<td>'
		hh += '<input name="option_stock_' + sids +'[]" type="text" class="form-control option_stock option_stock_' + sids +'" value="' +(val.stock=='undefined'?'':val.stock )+'"/>';
        hh += '<input name="option_id_' + sids +'[]" type="hidden" class="form-control option_id option_id_' + sids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
        hh += '<input name="option_ids[]" type="hidden" class="form-control option_ids option_ids_' + sids +'" value="' + sids +'"/>';
        hh += '<input name="option_title_' + sids +'[]" type="hidden" class="form-control option_title option_title_' + sids +'" value="' +(val.title=='undefined'?'':val.title )+'"/>';
        hh += '</td>';
        hh += '<td><input name="option_falsenum_' + sids +'[]" type="text" class="form-control option_falsenum option_falsenum_' + sids +'" value="' +(val.falsenum=='undefined'?'':val.falsenum )+'"/></td>';
        hh += '<td><input name="option_marketprice_' + sids +'[]" type="text" class="form-control option_marketprice option_marketprice_' + sids +'" value="' +(val.marketprice=='undefined'?'':val.marketprice )+'"/></td>';
		<?php  if($_W['plugin']['card']['config']['card_enable']) { ?>
        hh += '<td class="card-type"><input name="option_costprice_' + sids +'[]" type="text" class="form-control option_costprice option_costprice_' + sids +'" " value="' +(val.costprice=='undefined'?'':val.costprice )+'"/></td>';
		<?php  } ?>
// 		新增分销折扣价
        hh += '<td><input name="option_distribution_' + sids +'[]" type="text" class="form-control option_distribution option_distribution_' + sids +'" value="' +(val.distribution=='undefined'?'':val.distribution )+'"/></td>';

		//hh += '<td class="type-4"><input name="option_productprice_' + sids +'[]" type="text" class="form-control option_productprice option_productprice_' + sids +'" " value="' +(val.productprice=='undefined'?'':val.productprice )+'"/></td>';
        hh += "</tr>";
    }
    html+=hh;
    html+="</table>";
    $("#options").html(html);
	$('#gnum').val(total_stock);
    if(window.type=='4'){
        $('.type-4').hide();
    }else{
        $('.type-4').show();
    }
}
function permute(temArr,testArr){
    var permuteArr=[];
    var arr = testArr;
    function innerPermute(temArr){
        for(var i=0,len=arr.length; i<len; i++) {
            if(temArr.length == len - 1) {
                if(temArr.indexOf(arr[i]) < 0) {
                    permuteArr.push(temArr.concat(arr[i]));
                }
                continue;
            }
            if(temArr.indexOf(arr[i]) < 0) {
                innerPermute(temArr.concat(arr[i]));
            }
        }
    }
    innerPermute(temArr);
    return permuteArr;
}

function setCol(cls){
    	console.log(cls)
	$("."+cls).val( $("."+cls+"_all").val());
}
function showItem(obj){
	var show = $(obj).get(0).checked?"1":"0";
	$(obj).parents('.spec_item_item').find('.spec_item_show:eq(0)').val(show);
	$(obj).parent().find('.form_item_show:eq(0)').val(show);
}
function nofind(){
	var img=event.srcElement;
	img.src="./resource/image/module-nopic-small.jpg";
	img.onerror=null;
}
function choosetemp(id){
	$('#modal-module-chooestemp').modal();
	$('#modal-module-chooestemp').data("temp",id);
}
function addtemp(){
	var id = $('#modal-module-chooestemp').data("temp");
	var temp_id = $('#modal-module-chooestemp').find("select").val();
	var temp_name = $('#modal-module-chooestemp option[value='+temp_id+']').text();
	//alert(temp_id+":"+temp_name);
	$("#temp_name_"+id).val(temp_name);
	$("#temp_id_"+id).val(temp_id);
	$('#modal-module-chooestemp .close').click();
	refreshOptions()
}	
</script>