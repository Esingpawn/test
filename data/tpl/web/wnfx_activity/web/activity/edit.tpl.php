<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>

<style type='text/css'>
    .tabs-container .form-group {overflow: hidden;}
    .tabs-container .tabs-left > .nav-tabs {}
    .tab-activity .nav li {float:left;}
    .spec_item_thumb {position: relative; width: 30px; height: 20px; padding: 0; border-left: none;}
    .spec_item_thumb i {position: absolute; top: -5px; right: -5px;}
    .multi-img-details, .multi-audio-details {margin-top:.5em;max-width: 700px; padding:0; }
    .multi-audio-details .multi-audio-item {width:155px; height: 40px; position:relative; float: left; margin-right: 5px;}
    .region-activity-details {
        background: #f8f8f8;
        margin-bottom: 10px;
        padding: 0 10px;
    }
    .region-activity-left{
        text-align: center;
        font-weight: bold;
        color: #333;
        font-size: 14px;
        padding: 20px 0;
    }
    .region-activity-right{
        border-left: 3px solid #fff;
        padding: 10px 10px;
    }
</style>
<div class="page-header">
	当前位置：<span class="text-primary"><?php  if(empty($id)) { ?>添加<?php  } else { ?>编辑<?php  } ?>活动 &nbsp;<small><?php  if(!empty($item['title'])) { ?>修改【<span class="text-info"><?php  echo $item['title'];?></span>】<?php  } ?></small></span>
</div>
<div class="page-content">
    <div class="page-sub-toolbar">
        <span class=''>
            <?php  if(perm('goods.add')) { ?><a class="btn btn-primary btn-sm" href="<?php  echo web_url('activity/edit')?>" >添加活动</a><?php  } ?>
            <a class="btn btn-default" href="<?php  echo web_url('activity')?>">返回列表</a>
        </span>
    </div>
    <form action="" method="post" class="form-horizontal form-validate" id="formEdit" enctype="multipart/form-data">
        <input type="hidden" id="tab" name="tab" value="#tab_<?php  echo $tab;?>" />
        <div class="tabs-container tab-activity">
            <div class="tabs-left">
                <ul class="nav nav-tabs" id="myTab">
                    <li<?php  if(strpos('tab_basic', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_basic">基本</a></li>
                    <li<?php  if(strpos('tab_option', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_option">库存/规格</a></li>
                    <li<?php  if(strpos('tab_falsedata', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_falsedata">虚拟参数</a></li>
                    <li<?php  if(strpos('tab_des', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_des">详情</a></li>
                    <!--<li><a href="#tab_buy">购买权限</a></li>-->
                    <li<?php  if(strpos('tab_sale', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_sale">营销</a></li>
                    <li<?php  if(strpos('tab_share', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_share">分享</a></li>
                    <li<?php  if(strpos('tab_notice', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_notice">通知</a></li>
                    <li<?php  if(strpos('tab_customer', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_customer">客服弹窗</a></li>
                    <li<?php  if(strpos('tab_verify', $tab) !== false) { ?> class="active"<?php  } ?> id="tab_nav_verify"<?php  if($item['hasonline']==1) { ?>style="display:none"<?php  } ?>><a href="#tab_verify">线下核销</a></li>
                    <li<?php  if(strpos('tab_diyform', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_diyform">自定义表单</a></li>
                    <li<?php  if(strpos('tab_agreement', $tab) !== false) { ?> class="active"<?php  } ?>><a href="#tab_agreement">报名协议</a></li>
                    <!--<li style="display:none" class="showverifygoods"><a href="#tab_verifygoods">记次/时核销</a></li>-->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane<?php  if(strpos('tab_basic', $tab) !== false) { ?> active<?php  } ?>" id="tab_basic">
                         <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/basic', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/basic', TEMPLATE_INCLUDEPATH));?></div>
                    </div>
                    
                    <div class="tab-pane<?php  if(strpos('tab_option', $tab) !== false) { ?> active<?php  } ?>" id="tab_option">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/option', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/option', TEMPLATE_INCLUDEPATH));?></div>
                    </div>
                    
                    <div class="tab-pane<?php  if(strpos('tab_falsedata', $tab) !== false) { ?> active<?php  } ?>" id="tab_falsedata">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/falsedata', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/falsedata', TEMPLATE_INCLUDEPATH));?></div>
                    </div>
                    
                    <div class="tab-pane<?php  if(strpos('tab_des', $tab) !== false) { ?> active<?php  } ?>" id="tab_des">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/des', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/des', TEMPLATE_INCLUDEPATH));?></div>
                    </div>                    
                    <!--
                    <div class="tab-pane<?php  if(strpos('tab_buy', $tab) !== false) { ?> active<?php  } ?>" id="tab_buy">
                        <div class="panel-body">
                            <div class="region-activity-details row">
                                <div class="region-activity-left col-sm-2">购买权限</div>
                                <div class=" region-activity-right col-sm-10"></div>
                            </div>
                        </div>
                    </div>-->                    
                    <div class="tab-pane<?php  if(strpos('tab_sale', $tab) !== false) { ?> active<?php  } ?>" id="tab_sale">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/sale', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/sale', TEMPLATE_INCLUDEPATH));?></div>
                    </div>
                    <div class="tab-pane<?php  if(strpos('tab_share', $tab) !== false) { ?> active<?php  } ?>" id="tab_share">
                         <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/share', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/share', TEMPLATE_INCLUDEPATH));?></div>
                    </div>
                    <div class="tab-pane<?php  if(strpos('tab_notice', $tab) !== false) { ?> active<?php  } ?>" id="tab_notice">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/notice', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/notice', TEMPLATE_INCLUDEPATH));?></div>
                    </div>                
                    <div class="tab-pane<?php  if(strpos('tab_customer', $tab) !== false) { ?> active<?php  } ?>" id="tab_customer">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/customer', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/customer', TEMPLATE_INCLUDEPATH));?></div>
                    </div>                    
                    <div class="tab-pane<?php  if(strpos('tab_verify', $tab) !== false) { ?> active<?php  } ?>" id="tab_verify">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/verify', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/verify', TEMPLATE_INCLUDEPATH));?></div>
                    </div>
                    <div class="tab-pane<?php  if(strpos('tab_diyform', $tab) !== false) { ?> active<?php  } ?>" id="tab_diyform">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/diyform', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/diyform', TEMPLATE_INCLUDEPATH));?></div>
                    </div>
                    <div class="tab-pane<?php  if(strpos('tab_agreement', $tab) !== false) { ?> active<?php  } ?>" id="tab_agreement">
                        <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('activity/edit/agreement', TEMPLATE_INCLUDEPATH)) : (include fx_template('activity/edit/agreement', TEMPLATE_INCLUDEPATH));?></div>
                    </div>                    
                </div>
            </div>
        </div>
            
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 subtitle">
                <input type="submit" value="保存活动" class="btn btn-primary"/>
                <a class="btn btn-default" href="<?php  echo web_url('activity')?>">返回列表</a>
            </div>
        </div>
	</form>
</div>
<!--蜗牛科技-->
<script type="text/javascript">
	window.type = "";
	window.virtual = "";
	require(['bootstrap'], function () {
		$('#myTab a').click(function (e) {
			$('#tab').val( $(this).attr('href'));
			e.preventDefault();
			$(this).tab('show');
		})
	});
	
	require(['jquery.ui'],function(){
		$('.multi-img-details').sortable({scroll:'false'});
		$('.multi-img-details').sortable('option', 'scroll', false);
	})
	
	$(function () {
		$(':radio[name=isverify]').click(function () {
			window.type = $("input[name='isverify']:checked").val();

			if (window.type == '2') {
				$(':checkbox[name=cash]').attr("checked",false);
				$(':checkbox[name=cash]').parent().hide();
			} else {
				$(':checkbox[name=cash]').parent().show();
			}
		});
		$(':radio[name="activity[iscard]"]').click(function () {
			window.iscard = $("input[name='activity[iscard]']:checked").val();
            if(window.iscard!='1'){
                $("#options").addClass('markethide');
				$(".iscard").hide();
            }else{
                $("#options").removeClass('markethide');
				$(".iscard").show();
            }
		})
		$(":checkbox[name='buyshow']").click(function () {
			if ($(this).prop('checked')) {
				$(".bcontent").show();
			}
			else {
				$(".bcontent").hide();
			}
		})

		$(':radio[name=buyshow]').click(function () {
			window.buyshow = $("input[name='buyshow']:checked").val();

			if(window.buyshow=='1'){
				$('.bcontent').show();
			} else {
				$('.bcontent').hide();
			}
		})
		$(":radio[name='activity[kefu][type]']").click(function(){
		var obj = $(this);
			if (obj.val()!='2'){
				$(".kefu-item").eq(0).show();
				$(".kefu-item").eq(1).hide();
			}else{
				$(".kefu-item").eq(0).hide();
				$(".kefu-item").eq(1).show();				
			}
		});
	})
	
	window.optionchanged = false;

	$('form').submit(function(){
		var check = true;
		$(".form_title").each(function(){
			var val = $(this).val();
			if(!val){
				$('#myTab a[href="#tab_diyform"]').tab('show');
				$(this).focus(),$('form').attr('stop',1),tip.msgbox.err('自定义表单字段名称不能为空!');
				check =false;
				return false;
			}
		});

		var diyformtype = $(':radio[name=diyformtype]:checked').val();

		if (diyformtype == 2) {
			if(kw == 0) {
				$('#myTab a[href="#tab_diyform"]').tab('show');
				$(this).focus(),$('form').attr('stop',1),tip.msgbox.err('请先添加自定义表单字段再提交!');
				check =false;
				return false;
			}
		}

		if(!check){return false;}

		window.type = $("input[name='type']:checked").val();
		window.virtual = $("#virtual").val();
		
		if ($("#activityname").isEmpty()) {
			$('#myTab a[href="#tab_basic"]').tab('show');
			$('form').attr('stop',1);
			$(this).focus(),$('form').attr('stop',1),tip.msgbox.err('请填写活动名称!');
			return false;
		}
		
		$('#phaseBox .table-con').each(function(key){
			var _this = $(this), data_id = $(this).data('id');
			$("input[name='spec_item_title_"+data_id+"[]']").each(function(i){
				if($(this).isEmpty()) {
					$(this).focus(),$('form').attr('stop',1),tip.msgbox.err(_this.find('.goods-des input').eq(0).val()+' 设置错误！');
					check = false;
					return false;
				}
			});
			if(!check) {
				$(this).addClass('active');
				$(this).find('.fold-inner').show();
				return false;
			}
		});
		if(!check){return false;}
		
		var inum = 0;
		$('.gimgs').find('.img-thumbnail').each(function(){
			inum++;
		});
		if(inum == 0){
			$('#myTab a[href="#tab_basic"]').tab('show');
			$('form').attr('stop',1),tip.msgbox.err('请上传活动图片!');
			return false;
		}

		var full = true;
		if (window.type == '3') {
			if (window.virtual != '0') {  //如果单规格，不能有规格
				if ($('#hasoption').get(0).checked) {
					$('form').attr('stop',1),tip.msgbox.err('您的活动类型为：虚拟物品(卡密)的单规格形式，需要关闭活动规格！');
					return false;
				}
			}
			else {

				var has = false;
				$('.spec_item_virtual').each(function () {
					has = true;
					if ($(this).val() == '' || $(this).val() == '0') {
						$('#myTab a[href="#tab_option"]').tab('show');
						$(this).next().focus();
						$('form').attr('stop',1),tip.msgbox.err('请选择虚拟物品模板!');
						full = false;
						return false;
					}
				});
				if (!has) {
					$('#myTab a[href="#tab_option"]').tab('show');
					$('form').attr('stop',1),tip.msgbox.err('您的活动类型为：虚拟物品(卡密)的多规格形式，请添加规格！');
					return false;
				}
			}
		}
		else if (window.type == '5') {
			if ($('#hasoption').get(0).checked) {
				$('form').attr('stop',1),tip.msgbox.err('您的活动类型为：核销产品，无法设置多活动规格！');
				return false;
			}
		}
		else if(window.type=='10'){
			var spec_itemlen = $(".spec_item").length;
			if (!$('#hasoption').get(0).checked || spec_itemlen<1) {
				$('#myTab a[href="#tab_option"]').tab('show');
				$('form').attr('stop',1),tip.msgbox.err('您的活动类型为：话费流量充值，需要开启并设置活动规格！');
				return false;
			}
			if(spec_itemlen>1){
				$('#myTab a[href="#tab_option"]').tab('show');
				$('form').attr('stop',1),tip.msgbox.err('您的活动类型为：话费流量充值，只可添加一个规格！');
				return false;
			}
		}
		if (!full) {
			return false;
		}

		full = checkoption();
		if (!full) {
			$('form').attr('stop',1),tip.msgbox.err('请输入规格名称!');
			return false;
		}
		if (optionchanged) {
			$('#myTab a[href="#tab_option"]').tab('show');
			$('form').attr('stop',1),tip.msgbox.err('规格数据有变动，请重新点击 [刷新规格项目表] 按钮!');
			return false;
		}
		var spec_item_title = 1;
		if($('#hasoption').get(0).checked){
			$(".spec_item").each(function (i) {
				var _this = this;
				if($(_this).find(".spec_item_title").length == 0){
					spec_item_title = 0;
				}
			});
		}
		if(spec_item_title == 0){
			$('form').attr('stop',1),tip.msgbox.err('详细规格没有填写,请填写详细规格!');
			return false;
		}
		$('form').attr('stop',1);
		//处理规格
		optionArray();
		isdiscountDiscountsArray();
		discountArray();
		commissionArray();
		$('form').removeAttr('stop');
		return true;
	});
	
	function groupShow(obj,show){
		if(show){
			$(obj).show();
		}else{
			$(obj).hide();
		}
	}	
	function optionArray()
	{
		var option_stock = new Array();
		$('.option_stock').each(function (index,item) {
			option_stock.push($(item).val());
		});

		var option_id = new Array();
		$('.option_id').each(function (index,item) {
			option_id.push($(item).val());
		});

		var option_ids = new Array();
		$('.option_ids').each(function (index,item) {
			option_ids.push($(item).val());
		});

		var option_title = new Array();
		$('.option_title').each(function (index,item) {
			option_title.push($(item).val());
		});

		var option_virtual = new Array();
		$('.option_virtual').each(function (index,item) {
			option_virtual.push($(item).val());
		});

		var option_marketprice = new Array();
		$('.option_marketprice').each(function (index,item) {
			option_marketprice.push($(item).val());
		});
		var option_falsenum = new Array();
		$('.option_falsenum').each(function (index,item) {
			option_falsenum.push($(item).val());
		});

		var option_productprice = new Array();
		$('.option_productprice').each(function (index,item) {
			option_productprice.push($(item).val());
		});

		var option_costprice = new Array();
		$('.option_costprice').each(function (index,item) {
			option_costprice.push($(item).val());
		});

		var option_activitysn = new Array();
		$('.option_activitysn').each(function (index,item) {
			option_activitysn.push($(item).val());
		});
        var option_distribution = new Array();
		$('.option_distribution').each(function (index,item) {
			option_distribution.push($(item).val());
		});
		var option_productsn = new Array();
		$('.option_productsn').each(function (index,item) {
			option_productsn.push($(item).val());
		});

		var option_weight = new Array();
		$('.option_weight').each(function (index,item) {
			option_weight.push($(item).val());
		});

		var options = {
			option_stock : option_stock,
			option_id : option_id,
			option_ids : option_ids,
			option_title : option_title,
			option_falsenum : option_falsenum,
			option_marketprice : option_marketprice,
			option_productprice : option_productprice,
			option_costprice : option_costprice,
			option_activitysn : option_activitysn,
			option_productsn : option_productsn,
			option_weight : option_weight,
			option_distribution:option_distribution,
			option_virtual : option_virtual
		};
		$("input[name='optionArray']").val(JSON.stringify(options));
	}

	function isdiscountDiscountsArray()
	{

				var isdiscount_discounts_default = new Array();
		$(".isdiscount_discounts_default").each(function (index,item) {
			isdiscount_discounts_default.push($(item).val());
		});
		
		var isdiscount_discounts_id = new Array();
		$('.isdiscount_discounts_id').each(function (index,item) {
			isdiscount_discounts_id.push($(item).val());
		});

		var isdiscount_discounts_ids = new Array();
		$('.isdiscount_discounts_ids').each(function (index,item) {
			isdiscount_discounts_ids.push($(item).val());
		});

		var isdiscount_discounts_title = new Array();
		$('.isdiscount_discounts_title').each(function (index,item) {
			isdiscount_discounts_title.push($(item).val());
		});

		var isdiscount_discounts_virtual = new Array();
		$('.isdiscount_discounts_virtual').each(function (index,item) {
			isdiscount_discounts_virtual.push($(item).val());
		});

		var options = {
				isdiscount_discounts_default : isdiscount_discounts_default,
				isdiscount_discounts_id : isdiscount_discounts_id,
				isdiscount_discounts_ids : isdiscount_discounts_ids,
			isdiscount_discounts_title : isdiscount_discounts_title,
			isdiscount_discounts_virtual : isdiscount_discounts_virtual
	};
		$("input[name='isdiscountDiscountsArray']").val(JSON.stringify(options));
	}

	function discountArray()
	{

				var discount_default = new Array();
		$(".discount_default").each(function (index,item) {
			discount_default.push($(item).val());
		});
		
		var discount_id = new Array();
		$('.discount_id').each(function (index,item) {
			discount_id.push($(item).val());
		});

		var discount_ids = new Array();
		$('.discount_ids').each(function (index,item) {
			discount_ids.push($(item).val());
		});

		var discount_title = new Array();
		$('.discount_title').each(function (index,item) {
			discount_title.push($(item).val());
		});

		var discount_virtual = new Array();
		$('.discount_virtual').each(function (index,item) {
			discount_virtual.push($(item).val());
		});

		var options = {
				discount_default : discount_default,
				discount_id : discount_id,
				discount_ids : discount_ids,
			discount_title : discount_title,
			discount_virtual : discount_virtual
	};
		$("input[name='discountArray']").val(JSON.stringify(options));
	}

	function commissionArray()
	{
        if(!$('#hasoption').get(0).checked) {
            return false;
        }
	    var specs = [];
		$(".spec_item").each(function (i) {
			var _this = $(this);

			var spec = {
				id: _this.find(".spec_id").val(),
				title: _this.find(".spec_title").val()
			};

			var items = [];
			_this.find(".spec_item_item").each(function () {
				var __this = $(this);
				var item = {
					id: __this.find(".spec_item_id").val(),
					title: __this.find(".spec_item_title").val(),
					virtual: __this.find(".spec_item_virtual").val(),
					show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
				}
				items.push(item);
			});
			spec.items = items;
			specs.push(spec);
		});
		specs.sort(function (x, y) {
			if (x.items.length > y.items.length) {
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
		for (var i = 0; i < len; i++) {
			var itemlen = specs[i].items.length;
			if (itemlen <= 0) {
				itemlen = 1
			}
			newlen *= itemlen;
			h[i] = new Array(newlen);
			for (var j = 0; j < newlen; j++) {
				h[i][j] = new Array();
			}
			var l = specs[i].items.length;
			rowspans[i] = 1;
			for (j = i + 1; j < len; j++) {
				rowspans[i] *= specs[j].items.length;
			}
		}

		for (var m = 0; m < len; m++) {
			var k = 0, kid = 0, n = 0;
			for (var j = 0; j < newlen; j++) {
				var rowspan = rowspans[m];
				if (j % rowspan == 0) {
					h[m][j] = {
						title: specs[m].items[kid].title,
						virtual: specs[m].items[kid].virtual,
						id: specs[m].items[kid].id
					};
				}
				else {
					h[m][j] = {
						title: specs[m].items[kid].title,
						virtual: specs[m].items[kid].virtual,
						id: specs[m].items[kid].id
					};
				}
				n++;
				if (n == rowspan) {
					kid++;
					if (kid > specs[m].items.length - 1) {
						kid = 0;
					}
					n = 0;
				}
			}
		}

		var commission = {};
		var commission_level = [{"key":"default","levelname":"\u9ed8\u8ba4\u7b49\u7ea7"}];
		for (var i = 0; i < newlen; i++) {
			var ids = [];
			for (var j = 0; j < len; j++) {
				ids.push(h[j][i].id);
			}
			ids = ids.join('_');
			$.each(commission_level,function (key,val) {
				if(val.key == 'default')
				{
					var kkk = "commission_level_"+val.key+"_"+ids;
					commission[kkk] = {};
					$("input[data-name=commission_level_"+val.key+"_"+ids+"]").each(function (k,v) {
						commission[kkk][k] = $(v).val();
					});
				}
				else
				{
					var kkk = "commission_level_"+val.id+"_"+ids;
					commission[kkk] = {};
					$("input[data-name=commission_level_"+val.id+"_"+ids+"]").each(function (k,v) {
						commission[kkk][k] = $(v).val();
					});
					var kkk = "commission_level_"+val.id+"_"+ids;
					commission[kkk] = {};
					$("input[data-name=commission_level_"+val.id+"_"+ids+"]").each(function (k,v) {
						commission[kkk][k] = $(v).val();
					});
				}
			})
		}

		var commission_id = new Array();
		$('.commission_id').each(function (index,item) {
			commission_id.push($(item).val());
		});

		var commission_ids = new Array();
		$('.commission_ids').each(function (index,item) {
			commission_ids.push($(item).val());
		});

		var commission_title = new Array();
		$('.commission_title').each(function (index,item) {
			commission_title.push($(item).val());
		});

		var commission_virtual = new Array();
		$('.commission_virtual').each(function (index,item) {
			commission_virtual.push($(item).val());
		});



		var options = {
			commission : commission,
			commission_id : commission_id,
			commission_ids : commission_ids,
			commission_title : commission_title,
			commission_virtual : commission_virtual
		};
		$("input[name='commissionArray']").val(JSON.stringify(options));
	}

	function checkoption() {
		var full = true;
		var $spec_title = $(".spec_title");
		var $spec_item_title = $(".spec_item_title");
		if ($("#hasoption").get(0).checked) {
			if($spec_title.length==0){
				$('#myTab a[href="#tab_option"]').tab('show');
				full = false;
			}
			if($spec_item_title.length==0){
				$('#myTab a[href="#tab_option"]').tab('show');
				full = false;
			}
		}
		if (!full) {
			return false;
		}
		return full;
	}
</script>
<div id="page-loading">
    <div class="page-loading-inner">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>