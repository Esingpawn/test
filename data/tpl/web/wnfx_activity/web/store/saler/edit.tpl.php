<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
	当前位置：<span class="text-primary"><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>店员 <small><?php  if(!empty($item['id'])) { ?> - 所属商户【<?php  echo $merch['name'];?>】<?php  } ?></small></span>
</div>
<div class="page-content">
    <div class="page-sub-toolbar">
        <a class="btn btn-primary btn-sm" href="<?php  echo web_url('store/saler/edit')?>">添加新店员</a>
    </div>
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />        
        <div class="form-group">
            <label class="col-lg control-label must">选择会员</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_selector('openid',array('key'=>'openid', 'required'=>true, 'text'=>'nickname', 'thumb'=>'avatar','placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择会员 ', 'items'=>$saler,'url'=>web_url('member/query',array('no_wa'=>1))))?>
        		<span class='help-block'>平台绑定的微信会员，作为核销员</span>
            </div>
        </div>
        
        <div class="form-group"<?php  if(MERCHANTID) { ?> style="display:none"<?php  } ?>>
            <label class="col-lg control-label must">所属商家</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_selector('merchid',array('key'=>'id','text'=>'name','nokeywords'=>0,'preview'=>false,'multi'=>0,'type'=>'text','placeholder'=>'商户名称','buttontext'=>'选择商户',callback=>'select_merch','items'=>$merch,'url'=>web_url('merch/user/query') ))?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg control-label must">所属门店</label>
            <div class="col-sm-9 col-xs-12">
                  <?php  echo tpl_selector('storeid',array('multi'=>1,'text'=>'storename','nokeywords'=>1,'preview'=>true,'type'=>'text','thumb'=>'avatar','placeholder'=>'门店名称','buttontext'=>'选择门店 ', 'items'=>$store,'url'=>web_url('store/query',array('merchid'=>$merch['id']))))?>
                  <span class='help-block'>商户所属的门店，用于核销订单，不选择全店核销</span>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg control-label">状态</label>
            <div class="col-sm-9 col-xs-12">
                <label class='radio-inline'>
                    <input type='radio' name='status' value=1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 启用
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='status' value=0' <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 禁用
                </label>
            </div>
        </div>
            
        <div class="form-group"></div>
        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="submit" value="提交" class="btn btn-primary"  />
                <input type="button" name="back" onclick='history.back()' value="返回列表" class="btn btn-default" />
            </div>
        </div>
	</form>
</div>

<script language='javascript'>
    $(document).ready(function () {
        $('#openid_text').focusout(function () {
            return false;
        })
    })

    function search_users() {
        $("#module-menus1").html("正在搜索....")
        $.get('<?php  echo web_url("store/perm/role/query")?>', {
            keyword: $.trim($('#search-kwd1').val())
        }, function(dat){
            $('#module-menus1').html(dat);
        });
    }

    function select_role(o) {
        $("#userid").val(o.id);
        $("#user").val( o.rolename );
        $(".close2").click();
    }
	function select_merch(o) {
		$('#storeid_selector').data("url","<?php  echo web_url('store/query')?>&merchid="+o.id);
		$('#storeid-selector-modal').remove();
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>