<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
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
    当前位置：<span class="text-primary"><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>门店
        <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['storename'];?>】<?php  } ?></small>
    </span>
</div>

<div class="page-content">
    <div class="page-sub-toolbar">
        <a class="btn btn-primary btn-sm" href="<?php  echo web_url('store/edit')?>">添加新门店</a>
    </div>
<form ction="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>"/>
    <div class="form-group"<?php  if(MERCHANTID) { ?> style="display:none"<?php  } ?>>
        <label class="col-lg control-label must">所属商家</label>
        <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_selector('merchid',array('key'=>'id','text'=>'name','nokeywords'=>0,'preview'=>false,'multi'=>0,'type'=>'text','placeholder'=>'商户名称','buttontext'=>'选择商户', 'items'=>$merch,'url'=>web_url('merch/user/query') ))?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label must">门店名称</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="storename" class="form-control" value="<?php  echo $item['storename'];?>" data-rule-required="true"/>
        </div>
    </div>
    <!--<div class="form-group">
        <label class="col-lg control-label must">门店LOGO</label>
        <div class="col-sm-9 col-xs-12">
        </div>
    </div>-->
    
    <div class="form-group">
        <label class="col-lg control-label must">门店电话</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="tel" class="form-control" value="<?php  echo $item['tel'];?>" data-rule-required="true"/>
        </div>
    </div>
    <!--<div class="form-group">
        <label class="col-lg control-label">营业时间</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="saletime" class="form-control" value="<?php  echo $item['saletime'];?>"/>
        </div>
    </div>-->
    <div class="form-group">
        <label class="col-lg control-label must">门店位置</label>
        <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_form_field_position('map',array('lng'=>$item['lng'],'lat'=>$item['lat'],'adinfo'=>$item['adinfo']))?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg control-label must">门店地址</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="address" id="address" class="form-control" value="<?php  echo $item['address'];?>" id="address"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg control-label">状态</label>
        <div class="col-sm-9 col-xs-12">
            <label class='radio-inline'>
                <input type='radio' name='status' value='1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 启用
            </label>
            <label class='radio-inline'>
                <input type='radio' name='status' value='0' <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 禁用
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <input type="submit" value="提交" class="btn btn-primary"/>
            <input type="button" name="back" onclick='history.back()' style='margin-left:10px;' value="返回列表" class="btn btn-default" />
        </div>
    </div>
</form>
</div>
<script language='javascript'>
    $(function () {
        $(':radio[name=type]').click(function () {
            type = $("input[name='type']:checked").val();

            if (type == '1' || type == '3') {
                $('#pick_info').show();
            } else {
                $('#pick_info').hide();
            }
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>