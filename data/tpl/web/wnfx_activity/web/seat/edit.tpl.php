<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo FX_BASE;?>web/resource_v2/js/dist/seat-charts/style.css?v=1.0.3" rel="stylesheet">
<style>
    .checkbox-inline{
        display: block;
    }    .btns a i{
        display: inline-block;
        width: 100%;
        height: 20px;
        background: #f95959;
    }
    .btn-color {
        width: 25px;
        height: 25px;
        border: 1px solid #fff;
        margin: 2px;
        padding: 0;
    }
    </style>
<div class="page-header">
    当前位置：<span class="text-primary"><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>座位
        <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['name'];?>】<?php  } ?></small>
    </span>
</div>

<div class="page-content">
    <div class="page-sub-toolbar">
        <a class="btn btn-primary btn-sm" href="<?php  echo web_url('seat/edit')?>">添加新座位</a>
    </div>
	<form ction="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>"/>
        <div class="demo clearfix">

            <!---左边座位列表----->
            <div  class="col-sm-5">
                <div style="border-right: 1px dotted #adadad;padding:0 15px 15px 0">
                    <div class="front">屏幕</div>
                    <div style="overflow-x:auto;height:480px; position:relative;">
                        <div id="seat_area" style="position:absolute;width:max-content">
                        </div>
                    </div>
                </div>
            </div>

            <!---右边选座信息----->

            <div class="col-sm-7 booking_area">
            	<div class="form-group">
                    <label class="col-sm-2 control-label must">场地名称</label>
                    <div class="col-sm-10 col-xs-12">
                        <input type="text" name="seat[name]" class="form-control" value="<?php  echo $item['name'];?>" data-rule-required="true"/>
                    </div>
                </div>
                <div class="form-group"<?php  if(MERCHANTID) { ?> style="display:none"<?php  } ?>>
                    <label class="col-sm-2 control-label must">选择商户</label>
                    <div class="col-sm-10 col-xs-12">
                        <?php  echo tpl_selector('merchid',array('key'=>'id','text'=>'name','nokeywords'=>0,'preview'=>false,'multi'=>0,'type'=>'text','placeholder'=>'请输入商户名称','buttontext'=>'选择商户', 'items'=>$merch,'url'=>web_url('merch/user/query') ))?>
                    </div>
                </div>     
                <div class="form-group">
                    <label class="col-sm-2 control-label must">行列比例</label>
                    <div class="col-sm-8 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon">行</span>
                            <input type="number" name="seat[rows]" class="form-control" value="<?php  echo $item['rows'];?>" placeholder="默认15排">
                            <span class="input-group-addon">：</span>
                            <input type="number" name="seat[columns]" class="form-control" value="<?php  echo $item['columns'];?>" placeholder="默认15列">
                            <span class="input-group-addon">列</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">已售出</label>
                    <div class="col-sm-8 col-xs-12">
                        <textarea id="unavailable" class="form-control" rows="3" readonly><?php echo empty($item['unavailable'])?'':str_replace(',', '座，', str_replace('_', '排', $item['unavailable'])).'座'?></textarea>
                        <input type="hidden" name="seat[unavailable]" class="form-control" value="<?php  echo $item['unavailable'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">不可选</label>
                    <div class="col-sm-8 col-xs-12">
                        <textarea id="noavailable" class="form-control" rows="3" readonly><?php echo empty($item['noavailable'])?'':str_replace(',', '座，', str_replace('_', '排', $item['noavailable'])).'座'?></textarea>
                        <input type="hidden" name="seat[noavailable]" class="form-control" value="<?php  echo $item['noavailable'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态设置</label>
                    <div class="col-sm-8 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-select" style="padding:0">
                                <select name="status" class="form-control" style="width:120px;">
                                    <option value="">选择状态</option>
                                    <option value="unavailable">已售出</option>
                                    <option value="noavailable">不可选</option>
                                </select>
                            </span>
                            <span class="input-group-addon">整行</span>
                            <input type="number" name="row" class="form-control" value="">
                            <span class="input-group-addon">整列</span>
                            <input type="number" name="column" class="form-control" value="">                        
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="setStatus(this)">设置</button>
                                <button class="btn btn-danger" type="button" onclick="setStatus(this)">清除</button>
                            </span>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-select" style="padding:0">
                                <select name="status" class="form-control" style="width:120px;">
                                    <option value="">选择状态</option>
                                    <option value="unavailable">已售出</option>
                                    <option value="noavailable">不可选</option>
                                </select>
                            </span>
                            <span class="input-group-addon">指定</span>
                            <input type="text" name="seatval" class="form-control" value="" placeholder='多个逗号分开，格式：1_1,2_5,3_6'>
                            
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="setStatus(this)">设置</button>
                                <button class="btn btn-danger" type="button" onclick="setStatus(this)">清除</button>
                            </span>
                        </div>
                    </div>
                </div>   
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 col-xs-12">
                        <div id="legend"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 col-xs-12">
                        <input type="submit" value="提交" class="btn btn-primary"/>
                        <input type="button" name="back" onclick='history.back()' style='margin-left:10px;' value="返回列表" class="btn btn-default" />
                    </div>
                </div>
        	</div>
        </div>        
	</form>
</div>
<script type="text/javascript" src="<?php echo FX_BASE;?>web/resource_v2/js/dist/seat-charts/jquery.seat-charts.min.js?v=1111"></script>
<script language='javascript'>
var rows = <?php  echo $rows;?>, columns = <?php  echo $columns;?>, map = <?php  echo json_encode($map)?>, sc = Object;
$(document).ready(function() {
	var $cart = $('#unavailable'), //座位区
		$tickects_num = $('#tickects_num'), //票数
		$total_price = $('#total_price'); //票价总额

	sc = $('#seat_area').seatCharts({
		map: map,
		naming: {//设置行列等信息
			top: false, //不显示顶部横坐标（行）
			getLabel: function(character, row, column) { //返回座位信息
				return column;
			}
		},
		legend: {//定义图例
			node: $('#legend'),
			items: [
				['c', 'available', '可选座'],
				['c', 'unavailable', '已售出'],
				['c', 'noavailable', '不可选']
			]
		},
		click: function() {
			var cartval = $cart.val();
			if (this.status() == 'available') { //若为可选座状态，添加座位	
				$(this.settings.$node).addClass('unavailable');				
				getStatus('unavailable');
				return 'unavailable';
			} else if (this.status() == 'unavailable') { //若为选中状态
				$(this.settings.$node).removeClass('unavailable noavailable');
				getStatus('unavailable');
				return 'available';
			} else if (this.status() == 'noavailable') { //若为不何选
				$(this.settings.$node).removeClass('unavailable noavailable');
				getStatus('noavailable');
				return 'available';
			} else {
				return this.style();
			}
		},
		focus: function() {
			if (this.status() == "available" && !$(this.settings.$node).hasClass('unavailable') && !$(this.settings.$node).hasClass('noavailable')) {
				return "focused"
			} else {
				return this.style()
			}
		}
	});
	
	//设置已售出的座位
	var arr1 = "<?php  echo $item['unavailable'];?>".split(',');
	sc.get(arr1).status('unavailable');
	
	//设置不可选的座位
	var arr2 = "<?php  echo $item['noavailable'];?>".split(',');
	sc.get(arr2).status('noavailable');
});

function getStatus(c){
	var status = '', len = $('#seat_area .' + c).length;
	$('#seat_area .' + c).each(function(i){
		status = status + $(this).attr("id");
		status += i < len-1 ? ',' : '';
	});
	if (status!=''){
		$('#'+c).val(status.replace(/_/ig, '排').replace(/,/ig, '座，') + '座');
		$('#'+c).next().val(status);
	}else{
		$('#'+c).val('');
		$('#'+c).next().val('');
	}
}

function setStatus(o){
	var $box = $(o).parents('.input-group'), 
		status = $(o).text()!='清除' ? $box.find('option:selected').val() : 'available';
		
	if (status=='' && $(o).text()!='清除') {
		tip.msgbox.err('请选择一个状态!');
		return;
	}

	var className = status=='unavailable' ? 'noavailable' : 'unavailable',
		row = parseInt($box.find(":input[name='row']").val()), 
		column = parseInt($box.find(":input[name='column']").val()),
		seatval = [];
		
	if ($box.find(":input[name='seatval']").val() !='' && typeof($box.find(":input[name='seatval']").val()) != "undefined") {
		seatval = $box.find(":input[name='seatval']").val().split(',');
	}else{
		if (row > 0) {		
			for(var i = 0; i < columns; i++){
				seatval.push(row+'_'+(i+1));
			}
		}
		
		if (column > 0) {
			for(var i = 0; i < rows; i++){
				seatval.push((i+1)+'_'+column);
			}
		}
	}
	sc.get(seatval).status(status);
	getStatus('unavailable');
	getStatus('noavailable');
}

$("input[name='seat[rows]'], input[name='seat[columns]']").bind('input propertychange, change', function(e) {
	var $seat_area = $('#seat_area'), $cart = $('#unavailable'), map = [];
	
	rows = $("input[name='seat[rows]']").val(), 
	columns = $("input[name='seat[columns]']").val();
	
	$seat_area.html('');
	for(var i = 0; i < rows; i++){
		var c = '';
		for(var ii = 0; ii < columns; ii++){
			c = c + 'c';
		}
		map.push(c);
	}
	sc = $('#seat_area').seatCharts({
		map: map,
		naming: {//设置行列等信息
			top: false, //不显示顶部横坐标（行）
			getLabel: function(character, row, column) { //返回座位信息
				return column;
			}
		},
		click: function() {
			var cartval = $cart.val();
			if (this.status() == 'available' || this.status() == 'reset') { //若为可选座状态，添加座位	
				$(this.settings.$node).addClass('unavailable');				
				getStatus('unavailable');					
				return 'unavailable';
			} else if (this.status() == 'unavailable') { //若为选中状态
				$(this.settings.$node).removeClass('unavailable noavailable');
				getStatus('unavailable');
				return 'available';
			} else if (this.status() == 'noavailable') { //若为不何选
				$(this.settings.$node).removeClass('unavailable noavailable');
				getStatus('noavailable');
				return 'available';
			} else {
				return this.style();
			}
		},
		focus: function() {
			if (this.status() == "available" && !$(this.settings.$node).hasClass('unavailable') && !$(this.settings.$node).hasClass('noavailable')) {
				return "focused"
			} else {
				return this.style()
			}
		}
	});
	getStatus('unavailable');
	getStatus('noavailable');
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>