<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.input-group-addon .radio-inline, .input-group-addon .checkbox-inline {
    padding-top: 0;
    line-height: 0.95;
}
.multi-img-details .multi-item{height:auto}
</style>
<div class="page-header">当前位置：<span class="text-primary">基础设置</span></div>
<div class="page-content">
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" style="" novalidate="novalidate">
    <div class="form-group-title">基本设置</div>
    <div class="form-group">
        <label class="col-lg control-label">报名模式</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[onlyonce]" value="0" <?php  if(!$settings['onlyonce']) { ?>checked="checked"<?php  } ?>> 全部
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[onlyonce]" value="1" <?php  if($settings['onlyonce']) { ?>checked="checked"<?php  } ?>> 单一
            </label>
            <span class="help-block">单一模式，用户有“待参与”订单时，不可报名其它活动.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">开启留言</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[joinmsg]" value="1" <?php  if($settings['joinmsg']) { ?>checked="checked"<?php  } ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[joinmsg]" value="0" <?php  if(!$settings['joinmsg']) { ?>checked="checked"<?php  } ?>> 关闭
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">图片裁切</label>
        <div class="col-xs-12 col-sm-7">
            <label class="radio-inline">
                <input type="radio" name="module[image][ratio]" value="1/1" <?php  if($settings['image']['ratio']=='1/1' || $settings['image']['bigimg']=='') { ?>checked="checked"<?php  } ?>> 1:1
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[image][ratio]" value="4/3" <?php  if($settings['image']['ratio']=='4/3') { ?>checked="checked"<?php  } ?>> 4:3
            </label>
             <label class="radio-inline">
                <input type="radio" name="module[image][ratio]" value="16/9" <?php  if($settings['image']['ratio']=='16/9') { ?>checked="checked"<?php  } ?>> 16:9
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[image][ratio]" value="NaN" <?php  if($settings['image']['ratio']=='NaN') { ?>checked="checked"<?php  } ?>> 自由裁切
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group">
                <span class="input-group-addon">最大宽度</span>
                <input type="text" name="module[image][pxsize]" class="form-control" placeholder="默认：640" value="<?php  echo $settings['image']['pxsize'];?>" />
                <span class="input-group-addon">PX</span>
            </div>
            <span class="help-block">图片裁切功能只在报名用户图片上传时有效.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">数据导出</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group">
                <span class="input-group-addon">每次执行</span>
                <input type="text" name="module[output][pagesize]" class="form-control" value="<?php  echo $settings['output']['pagesize'];?>" placeholder="默认：200">
                <span class="input-group-addon">条记录【防超时，建议 <= 1000】</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">更新二维码</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group">
                <button type="button" class="btn btn-primary js-qrcode" data-placement="left">如果域名变更，旧域名二维码失效，请点此更新！</button>
            </div>
        </div>
    </div>    

    <div class="form-group-title">城市定位</div>
    <div class="alert alert-info">
        提示：请确保站点域名已配置SSL证书，即开启"https://"访问模式 (注：如果开启远程附件，同样需要配置SSL证书).
    </div>
    <div class="form-group">
        <label class="col-lg control-label">开启位置</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[location]" value="1" <?php  if($settings['location']) { ?>checked="checked"<?php  } ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[location]" value="0" <?php  if(!$settings['location']) { ?>checked="checked"<?php  } ?>> 关闭
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">开启城市</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[citys]" value="1" <?php  if($settings['citys']) { ?>checked="checked"<?php  } ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[citys]" value="0" <?php  if(!$settings['citys']) { ?>checked="checked"<?php  } ?>> 关闭
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">初始区域</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[countrie]" value="1" <?php  if($settings['countrie']==1 || empty($settings['countrie'])) { ?>checked="checked"<?php  } ?>> 全国
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[countrie]" value="2" <?php  if($settings['countrie']==2) { ?>checked="checked"<?php  } ?>> 当前城市
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">最近优先</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="module[distance]" value="1" <?php  if($settings['distance']) { ?>checked="checked"<?php  } ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="module[distance]" value="0" <?php  if(!$settings['distance']) { ?>checked="checked"<?php  } ?>> 关闭
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <input type="submit" value="提交" class="btn btn-primary">
        </div>
    </div>
</form>
</div>
<script>
$(function () {	
	//更新二维码
	$('.js-qrcode').click(function(e) {
		tip.confirm('确定更新？', function(){
			$.post("<?php  echo web_url('sysset/qrupdate')?>", function(data) {
				tip.msgbox.suc('更新完成');
			}, 'json');			
		});
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>