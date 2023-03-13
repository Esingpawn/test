<?php defined('IN_IA') or exit('Access Denied');?><?php  if($_W['op'] == 'display') { ?>
<style type="text/css">
.mui-icon-jinggao{font-size:0.75rem!important;}
.mui-icon-jinggao:before{color:#ff6400;font-size:0.8rem;margin-right:0.2rem;}
.mui-card-header:after{position:absolute;left:15px;right: 0;bottom: 0;height: 1px;background-color:#e0e0e0;content: "";-webkit-transform: scaleY(0.5);transform: scaleY(0.5);}
.mui-cert .mui-card-header i{position:relative; margin:0 1rem;}
.mui-cert .mui-card-header i:before{content: "";position:absolute;width:0.15rem;height:0.17rem;background:#1596f2;top:50%;-webkit-transform: translateY(-50%) ;transform:translateY(-50%) rotate(-45deg);z-index:2}
.mui-cert .mui-card-header i:after{content: "";position:absolute;left:-0.2rem;width:0.2rem;height:0.21rem;background:#6cc2ff;top:50%;-webkit-transform: translateY(-50%) ;transform:translateY(-50%) rotate(-45deg);z-index:1}
.mui-cert .mui-card-header i:nth-child(2):after{left:0.2rem;}
.mui-cert .mui-media-object{border-radius:50%;width:1.6rem;height:1.6rem;max-width:1.6rem;position:relative;color:#fff}
.mui-cert .mui-media-object.mui-ext-icon:before {left:50%; font-size:1rem;-webkit-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%)}
.mui-cert .mui-image-uploader{padding: 0 0 11px 0!important;}
.mui-cert .mui-image-uploader .mui-block span{display:inline-block;text-align:center;width:50%;line-height:2.5}
.mui-cert .mui-image-uploader .mui-upload-btn{margin:0 0.961rem;}
.mui-cert .mui-image-uploader .mui-upload-btn .webuploader-pick{font-family:Muiext!important;margin-top:0.5rem;width:2.3rem;height:2.3rem;font-size:2.3rem;}
.mui-cert .mui-image-uploader .mui-upload-btn .webuploader-pick:before{content: "\e697";}
.mui-cert .mui-image-uploader .mui-upload-btn, .mui-cert .mui-image-uploader img, .mui-cert .mui-image-uploader .file-item{width:5.5rem;height:4rem;}
.mui-cert .mui-image-uploader .file-item{margin: 0 0.961rem;}
.mui-cert .mui-image-uploader img{border-radius: 6px;}
.mui-cert .mui-image-uploader .mui-image-preview{left:0;overflow:hidden;display:inline-block;}
.mui-cert .mui-input-group .mui-input-cell:after{height:0;}
.mui-cert .mui-table-view .mui-table-view-cell{ overflow:hidden!important}
#mcert_enterprise .mui-image-uploader .mui-upload-btn{margin: 0 auto;display:block}
#mcert_enterprise .mui-image-uploader .mui-image-preview{display:block}
#mcert_enterprise .mui-image-uploader .file-item{margin: 0 auto;display:block;float:none}
#mcert_enterprise .mui-image-uploader .mui-block span{width:100%;}
#mcert_enterprise .mui-input-row label{width: 40%;}
#mcert_enterprise .mui-input-row label~input{width:60%;}
</style>
<div id="merch" class="mui-popover mui-popover-left">
    <div class="mui-popover-header">主办方资料<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="merch"><me class="mui-icon mui-icon-closeempty"></me></a></div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <ul class="mui-table-view">
                    <li class="mui-table-view-cell avatar">
                        <a id="head" class="mui-navigate-right">头像
                            <span class="mui-pull-right">
                                <?php  if(empty($merchant['logo'])) { ?><font class="mui-text-primary">待完善 </font><?php  } ?>
                                <img class="head-img mui-action-preview" width="40" height="40" src="<?php  echo $merchant['logo'];?>">
                            </span>
                        </a>
                        <div class="upload-btn js-avatar-avatar" style="position:absolute;"></div>
                    </li>
                    <script>
                        util.img($('.js-avatar-avatar'), function(url){
                            $('.avatar img').attr('src', url.url);
                            $.post("<?php  echo app_url('member/merch/update');?>", {'logo' : url.attachment,'type':'logo'}, function(data) {
                                data = $.parseJSON(data);
                                if (data.type == 'success') {
                                    $('.mui-media-object img').attr('src', url.url);
                                    util.toast(data.message);
                                } else {
                                    util.toast('更新失败');
                                }
                            })
                        }, {
                            crop : true,
                            pxSize : 320,
                            aspectRatio:1/1
                        });
                    </script>
                    <li class="mui-table-view-cell js-change" data-type="name">
                        <a class="mui-navigate-right">名称<span class="mui-badge mui-badge-inverted<?php  if(empty($merchant['name'])) { ?> mui-text-primary<?php  } ?>"><?php  if(empty($merchant['name'])) { ?>待完善<?php  } else { ?><?php  echo $merchant['name'];?><?php  } ?> <font class="mui-text-primary">(认证后，不可修改)</font></span></a>
                    </li>
                    <li class="mui-table-view-cell js-change-detail js-popover-sub" data-popover="merch_detail">
                        <a class="mui-navigate-right">简介<span class="mui-badge mui-badge-inverted<?php  if(empty($merchant['detail'])) { ?> mui-text-primary<?php  } ?>"><?php  if(empty($merchant['detail'])) { ?>待完善<?php  } ?></span></a>
                    </li>
                    <li class="mui-table-view-cell<?php  if(!ADMIN) { ?> js-popover-sub<?php  } ?> js-change-mcert" data-popover="merch_mcert">
                        <a class="mui-navigate-right">认证<span class="mui-badge mui-badge-inverted mui-text-primary">
                        <?php  if(ADMIN) { ?>
                        	平台方无需认证
                        <?php  } else { ?>
                        	<?php  if(empty($mcert)) { ?>
                            	未认证
                            <?php  } else if($mcert['status']==0) { ?>
                            	<font class="mui-text-danger">审核中</font>
                            <?php  } else if($mcert['status']==2) { ?>
                            	<font class="mui-text-danger">资料被驳回</font>
                            <?php  } else { ?>
                            	<?php  if(TIMESTAMP > $mcert['endtime']) { ?><font class="mui-text-danger">已到期</font><?php  } else { ?>有效期：<?php  echo date('Y年m月d H:i', $mcert['endtime'])?><?php  } ?>
                            <?php  } ?>
                        <?php  } ?></span></a>
                    </li>
                </ul>
                <ul class="mui-table-view">
                    <li class="mui-table-view-cell js-change" data-type="linkman_mobile">
                        <a class="mui-navigate-right">手机号<span class="mui-badge mui-badge-inverted<?php  if(empty($merchant['linkman_mobile'])) { ?> mui-text-primary<?php  } ?>"><?php  if(empty($merchant['linkman_mobile'])) { ?>待绑定<?php  } else { ?><?php  echo $merchant['linkman_mobile'];?><?php  } ?></span></a>
                    </li>
                    <li class="mui-table-view-cell js-change" data-type="linkman_name">
                        <a class="mui-navigate-right">联系人<span class="mui-badge mui-badge-inverted<?php  if(empty($merchant['linkman_name'])) { ?> mui-text-primary<?php  } ?>"><?php  if(empty($merchant['linkman_name'])) { ?>待完善<?php  } else { ?><?php  echo $merchant['linkman_name'];?><?php  } ?></span></a>
                    </li>
                </ul>
                <div class="mui-content-padded">
                	<?php  if(empty($merchant['logo']) || empty($merchant['name']) || empty($merchant['linkman_mobile']) || empty($merchant['linkman_name']) || empty($merchant['detail'])) { ?>
                    <button type="button" class="mui-btn mui-btn-yellow mui-btn-block js-release" disabled="disabled">请先完善资料</button>
                    <?php  } else { ?>
                    <button type="button" class="mui-btn mui-btn-yellow mui-btn-block js-release">去发布</button>
                    <?php  } ?>
                </div>
                <div class="mui-content-padded">
                	<div class="mui-help mui-text-center mui-small mui-text-gray">凡是显示"待完善"的选项，请全部完善后，方可发布活动。</div>    
                </div>
            </div>
        </div>
    </div>
</div>
<div id="merch_detail" class="mui-popover mui-popover-left mui-popover-sub">
    <div class="mui-popover-header">简介
        <a class="mui-pull-right mui-popover-close js-popover-sub-close" data-popover="merch_detail"><me class="mui-icon mui-icon-closeempty"></me></a>
    </div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <div class="mui-content-padded">
                    <textarea id="textarea" class="mui-input-clear" name="detail" rows="5" placeholder="请输入主办方简介，最多70字"><?php  echo $merchant['detail'];?></textarea>
                </div>
                <div class="mui-content-padded">
                    <button type="button" class="mui-btn mui-btn-orange mui-btn-block js-change" data-type="detail">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(".js-release").on('tap',function(e) {
	location.href = "<?php  echo app_url('member/project/post')?>";
});
$(".js-change").on('tap',function(e) {
	e.detail.gesture.preventDefault(); //修复iOS 8.x平台存在的bug，使用plus.nativeUI.prompt会造成输入法闪一下又没了
	var $this = $(this);
	var placeholder = '', params = '', value = '', type = $(this).data("type"),status="<?php  echo $mcert['status'];?>";
	if (type=='name' && status==1){
		util.tips('认证后，主办方名称不可修改');
		return false;
	}
	if (type!='detail'){
		switch(type){
			case 'name'          :placeholder = '请输入主办方名称';break;
			case 'linkman_mobile':placeholder = '请输入联系方式';break;
			case 'linkman_name'  :placeholder = '请输入联系人姓名';break;
			default:break;
		}
		mui.prompt('资料修改', placeholder,' ', function(e){
			if (e.index == 1) {
				value = e.value;
				if ($.trim(value)==''){
					util.tips('更改信息不能为空');
					return false;
				}
				switch(type){
					case 'name'          :params = {name : value, type : type};break;
					case 'linkman_mobile':params = {linkman_mobile : value, type : type};break;
					case 'linkman_name'  :params = {linkman_name : value, type : type};break;
					default:break;
				}
				//console.log(params);
				$.post("<?php  echo app_url('member/merch/update');?>", params, function(data) {
					var merchant = data.merchant;
					if (data.type == 'success') {
						util.toast(data.message);
						if (merchant.logo!='' || merchant.name!='' || merchant.linkman_mobile!='' || merchant.linkman_name!='' || merchant.detail!=''){
							$(".js-release").text('去发布').removeAttr("disabled");
						}
						$this.find('span').removeClass('mui-text-primary').text(value);
					} else {
						util.tips(data.message);
					}
				}, 'json');
			}
		});
	}else{
		$('#merch_detail #textarea').blur();
		var value= $('#merch_detail #textarea').val();
		if ($.trim(value)==''){
			util.tips('简介信息不能为空');
			return false;
		}
		$.post("<?php  echo app_url('member/merch/update');?>", {detail : value, type : 'detail'}, function(data) {
			var merchant = data.merchant;
			if (data.type == 'success') {
				util.tips(data.message);
				$('#merch_detail #textarea').val(value);
				$('.js-change-detail').find('span').removeClass('mui-text-primary').text('');
				if (merchant.logo!='' || merchant.name!='' || merchant.linkman_mobile!='' || merchant.linkman_name!='' || merchant.detail!=''){
					$(".js-release").text('去发布').removeAttr("disabled");
				}
				setTimeout(function() {
					$('#merch_detail').removeClass('mui-active').fadeOut();
					$('body').find('.mui-backdrop-sub').remove();history.back(-1);
				},500);
			} else {
				util.tips(data.message);
			}
		}, 'json');
	}
});
</script>
<div id="merch_mcert" class="mui-popover mui-popover-left mui-popover-sub mui-cert">
    <div class="mui-popover-header">身份认证
        <a class="mui-pull-right mui-popover-close js-popover-sub-close" data-popover="merch_mcert"><me class="mui-icon mui-icon-closeempty"></me></a>
    </div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <div class="mui-card mui-one mui-afterbefore-no" style="margin-top:0">
                    <div class="mui-card-content">
                        <div class="mui-card-content-inner mui-text-center">
                        	<?php  if(empty($mcert)) { ?>
                            	<h3 class="mui-ext-icon mui-icon-jinggao">未认证</h3>
                                <p></p>
                                <p class="mui-text-gray mui-small">为了保障和享受更多权益，请先认证</p>
                            <?php  } else if($mcert['status']==1) { ?>
                            	<?php  if(TIMESTAMP > $mcert['endtime']) { ?><font class="mui-text-danger">认证已到期</font><?php  } else { ?>有效期：<?php  echo date('Y年m月d H:i', $mcert['endtime'])?><?php  } ?>
                            <?php  } else if($mcert['status']==2) { ?>
                            	<font class="mui-text-danger">资料不符合要求被驳回，请仔细查看认证说明！</font>
                            <?php  } else { ?>
                            	<font class="mui-text-primary">资料审核中，预计审核时间：一到两个工作日！</font>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
                <div class="mui-card mui-one mui-afterbefore-no">
                	<div class="mui-card-header mui-text-center"><i></i>认证介绍<i></i></div>
                    <div class="mui-card-content">
                        <div class="mui-card-content-inner">
                            <ul class="mui-table-view" style="margin:0;">
                            	<li class="mui-table-view-cell mui-media">
                                	<div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-renzheng2" style="background:#31b6fb"></div>
                                    <div class="mui-media-body">
                                        <p>全新认证体系</p>
                                        <p class="mui-small mui-text-gray">提供更安全、更严格的真实性认证，更好的保护主办方及参与者的合法权益。</p>
                                    </div>
                                </li>
                                <li class="mui-table-view-cell mui-media">
                                	<div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-myouhui-2" style="background:#fea851"></div>
                                    <div class="mui-media-body">
                                        <p>提现要求</p>
                                        <p class="mui-small mui-text-gray">为了主办方资金安全，只有身份认证完成后，方可进行提现。</p>
                                    </div>
                                </li>
                                <li class="mui-table-view-cell mui-media">
                                	<div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-renzhenghuizhang" style="background:#d7b079"></div>
                                    <div class="mui-media-body">
                                        <p>认证特有标识</p>
                                        <p class="mui-small mui-text-gray">认证完成，用户将在个人中心看到认证特有的标识。</p>
                                    </div>
                                </li>
                                <li class="mui-table-view-cell mui-media">
                                	<div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-youxiaoqi" style="background:#51cec0"></div>
                                    <div class="mui-media-body">
                                        <p>认证有效期</p>
                                        <p class="mui-small mui-text-gray">从审核成功之日起，一年内有效。</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="mui-card mui-one mui-afterbefore-no" style="padding-bottom:45px;">
                	<div class="mui-card-header mui-text-center"><i></i>认证申明<i></i></div>
                    <div class="mui-card-content">
                        <div class="mui-card-content-inner">
                            <ul>
                                <li>认证成功即拥有一年的认证有效期。每年即将到期时，都需要重新提交认证资料，审核通过后，有效期自动延长一年。如过期，则认证失效，原认证权益全部失效。</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="mui-bar mui-bar-tab js-mcert-type" style="position:fixed; bottom:0;">
        	<div class="mui-content-padded" style=" margin-top:0">
            	<button type="button" class="mui-btn mui-btn-orange mui-btn-block js-popover-sub" data-popover="mcert_<?php  if(empty($mcert) || $mcert['status']==2 || TIMESTAMP > $mcert['endtime']) { ?>type<?php  } else if($mcert['type']==1) { ?>person<?php  } else { ?>enterprise<?php  } ?>">
                <?php  if(empty($mcert)) { ?>
                   立即认证
                <?php  } else { ?>
                	<?php  if($mcert['status']==2 || TIMESTAMP > $mcert['endtime']) { ?>
                    	重新提交
                    <?php  } else { ?>
                    	查看认证资料
                    <?php  } ?>
                <?php  } ?>
                </button>
            </div>
        </footer>
    </div>
</div>
<div id="mcert_type" class="mui-popover mui-popover-left mui-popover-sub mui-cert">
	<div class="mui-popover-header">认证方式
        <a class="mui-pull-right mui-popover-close js-popover-sub-close" data-popover="mcert_type"><me class="mui-icon mui-icon-closeempty"></me></a>
    </div>
    <div class="mui-popover-content">
    	<ul class="mui-table-view" style="margin:0;">
            <li class="mui-table-view-cell mui-media js-popover-sub" data-popover="mcert_person">
                <div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-renzheng2" style="background:#31b6fb"></div>
                <div class="mui-media-body mui-navigate-right">
                    <p>个人认证</p>
                    <p class="mui-small mui-text-gray" style="padding-right:20px">适用于以个人名义举办活动的主办方。</p>
                </div>
            </li>
            <li class="mui-table-view-cell mui-media js-popover-sub" data-popover="mcert_enterprise">
                <div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-renzheng2" style="background:#fea851"></div>
                <div class="mui-media-body mui-navigate-right">
                    <p>企业认证</p>
                    <p class="mui-small mui-text-gray" style="padding-right:20px">适用于以企业名义举办活动的主办方，包括国企、民企、个体工商户等。</p>
                </div>
            </li>
        </ul>
    </div>
</div>
<div id="mcert_person" class="mui-popover mui-popover-left mui-popover-sub mui-cert">
	<div class="mui-popover-header">个人认证
        <a class="mui-pull-right mui-popover-close js-popover-sub-close" data-popover="mcert_person"><me class="mui-icon mui-icon-closeempty"></me></a>
    </div>
    <div class="mui-popover-content">
    	<form id="formperson" action="" method="post" onSubmit="return check(this)">
		<div class="mui-scroll-wrapper">
			<div class="mui-scroll">
				<h5 class="mui-content-padded"></h5>
				<div class="mui-input-group group-list">
					<div class="mui-input-row">
						<label>真实姓名</label>
						<input type="text" name="mcert[detail][name]" placeholder="请输入你的真实姓名" value="">
					</div>
                    <ul class="mui-table-view" style="margin:0;">
                        <li class="mui-table-view-cell mui-media">
                        	<a href="javascript:;" class="">
                                <p style="padding-left:5px">证件类型</p>
                                <span class="mui-badge mui-badge-inverted js-person">身份证</span>
                            </a>
                        </li>
                        <li class="mui-table-view-cell" style="display:none"></li>
                    </ul>
					<div class="mui-input-row">
						<label>证件号码</label>
						<input type="text" name="mcert[detail][idcard]" placeholder="请输入你的证件号码" value="">
					</div>
					<div class="mui-input-row" style="display:none"></div>	
                    <p></p>
                    <div class="mui-input-cell">
                        <div class="mui-table-view-chevron">
                            <div class="mui-image-uploader">
                                <label class="mui-block mui-text-gray"><span>手持证件正面照片</span><span>证件背面照片</span></label>
                                <div class="mui-image-preview" style="display:none">
                                    <div class="file-item" data-id="0">
                                        <input type="hidden" value="" name="mcert[detail][thumb][]" />
                                        <img src="<?php  echo FX_URL.'app/resource/images/nopic.jpg'?>" data-preview-src="" data-preview-group="__IMG_UPLOAD_pic"/>
                                        <?php  if(empty($mcert) || $mcert['status']==2 || TIMESTAMP > $mcert['endtime']) { ?><div class="file-panel"><span>×</span></div><?php  } ?>
                                    </div>
                                </div>
                                <a href="javascript:;" class="mui-upload-btn js-personone mui-inline"></a>
                                <div class="mui-image-preview" style="display:none">
                                    <div class="file-item" data-id="0">
                                        <input type="hidden" value="" name="mcert[detail][thumb][]" />
                                        <img src="<?php  echo FX_URL.'app/resource/images/nopic.jpg'?>" data-preview-src="" data-preview-group="__IMG_UPLOAD_pic"/>
                                        <?php  if(empty($mcert) || $mcert['status']==2 || TIMESTAMP > $mcert['endtime']) { ?><div class="file-panel"><span>×</span></div><?php  } ?>
                                    </div>
                                </div>
                                <a href="javascript:;" class="mui-upload-btn js-persontwo mui-inline"></a>
                            </div>
                        </div>
                    </div>                    
				</div>
                <?php  if(empty($mcert) || $mcert['status']==2 || TIMESTAMP > $mcert['endtime']) { ?>
				<div class="mui-content-padded js-submit">
					<input type="hidden" name="mcert[mid]" value="<?php echo MERCHANTID;?>" />
					<input type="hidden" name="mcert[type]" value="1">
					<input type="submit" class="mui-btn mui-btn-orange mui-btn-block" name="submit" value="保存"/>
				</div>
                <?php  } ?>
			</div>
		</div>
		</form>
    </div>
</div>
<div id="mcert_enterprise" class="mui-popover mui-popover-left mui-popover-sub mui-cert">
	<div class="mui-popover-header">企业认证
        <a class="mui-pull-right mui-popover-close js-popover-sub-close" data-popover="mcert_enterprise"><me class="mui-icon mui-icon-closeempty"></me></a>
    </div>
    <div class="mui-popover-content">
    	<form id="formenterprise" action="" method="post" onSubmit="return check(this)">
		<div class="mui-scroll-wrapper">
			<div class="mui-scroll">
				<h5 class="mui-content-padded"></h5>
				<div class="mui-input-group group-list">
					<div class="mui-input-row">
						<label>企业全称</label>
						<input type="text" name="mcert[detail][company]" placeholder="请输入企业全称" value="">
					</div>
                    <div class="mui-input-row">
						<label>营业执照注册码</label>
						<input type="text" name="mcert[detail][idcard]" placeholder="请输入营业执照注册码" value="">
					</div>
					<div class="mui-input-row">
						<label>法定代表人姓名</label>
						<input type="text" name="mcert[detail][name]" placeholder="请输入法定代表人姓名" value="">
					</div>
					<div class="mui-input-row" style="display:none"></div>	
                    <p></p>
                    <div class="mui-input-cell">
                        <div class="mui-table-view-chevron">
                            <div class="mui-image-uploader">
                                <label class="mui-block mui-text-gray"><span>营业执照照片</span></label>
                                <div class="mui-image-preview" style="display:none">
                                    <div class="file-item" data-id="0">
                                        <input type="hidden" value="" name="mcert[detail][thumb][]" />
                                        <img src="<?php  echo FX_URL.'app/resource/images/nopic.jpg'?>" data-preview-src="" data-preview-group="__IMG_UPLOAD_pic"/>
                                        <?php  if(empty($mcert) || $mcert['status']==2 || TIMESTAMP > $mcert['endtime']) { ?><div class="file-panel"><span>×</span></div><?php  } ?>
                                    </div>
                                </div>
                                <a href="javascript:;" class="mui-upload-btn js-enterprise mui-inline"></a>
                            </div>
                        </div>
                    </div>
                    
				</div>
                <?php  if(empty($mcert) || $mcert['status']==2 || TIMESTAMP > $mcert['endtime']) { ?>
				<div class="mui-content-padded js-submit">
					<input type="hidden" name="mcert[mid]" value="<?php echo MERCHANTID;?>" />
					<input type="hidden" name="mcert[type]" value="2">
					<input type="submit" class="mui-btn mui-btn-orange mui-btn-block" name="submit" value="保存"/>
				</div>
                <?php  } ?>
			</div>
		</div>
		</form>
    </div>
</div>
<script>
var obj_img = new Array(".js-personone",".js-persontwo",".js-enterprise");

util.img(obj_img[0], function(url){
	$(obj_img[0]).prev().find('.file-item').find("input[name='mcert[detail][thumb][]']").val(url.attachment);
	$(obj_img[0]).prev().find('.file-item').attr("data-id",url.id);
	$(obj_img[0]).prev().find('.file-item').find('img').attr("src",url.url).attr("data-preview-src",url.url);
	$(obj_img[0]).hide().prev().show();
}, {
	crop : true,
	multiple : false,
	preview : '__IMG_UPLOAD_pic',
	aspectRatio:NaN,
	resizable:1
});
util.img(obj_img[1], function(url){
	$(obj_img[1]).prev().find('.file-item').find("input[name='mcert[detail][thumb][]']").val(url.attachment);
	$(obj_img[1]).prev().find('.file-item').attr("data-id",url.id);
	$(obj_img[1]).prev().find('.file-item').find('img').attr("src",url.url).attr("data-preview-src",url.url);
	$(obj_img[1]).hide().prev().show();
}, {
	crop : true,
	multiple : false,
	preview : '__IMG_UPLOAD_pic',
	aspectRatio:NaN,
	resizable:1
});
util.img(obj_img[2], function(url){
	$(obj_img[2]).prev().find('.file-item').find("input[name='mcert[detail][thumb][]']").val(url.attachment);
	$(obj_img[2]).prev().find('.file-item').attr("data-id",url.id);
	$(obj_img[2]).prev().find('.file-item').find('img').attr("src",url.url).attr("data-preview-src",url.url);
	$(obj_img[2]).hide().prev().show();
}, {
	crop : true,
	multiple : false,
	preview : '__IMG_UPLOAD_pic',
	aspectRatio:NaN,
	resizable:1
});
setTimeout(function(){
   $('.mui-upload-btn').append('<div class="btn-intro" style="position:absolute;color:#d7d7d7;bottom:0.5rem;line-height:1.2;left:0;right:0;">点击上传</div>');
},1500);
//删除图片
$('.mui-image-preview .file-panel').on('click', function(e){
	$(this).parents('.mui-image-preview').hide().next().show();
});
function check(form){
	if (form['mcert[type]'].value == 1) {
		var pattern = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
		if ($(form['mcert[detail][name]']).val()=='') {
			util.tips('请填写您的真实姓名');
			$(form['mcert[detail][name]']).focus();
			return false;
		}		
		if ($(form['mcert[detail][idcard]']).val()=='') {
			util.tips('请填写您的证件号');
			$(form['mcert[detail][idcard]']).focus();
			return false;
		}
		if (!pattern.test($(form['mcert[detail][idcard]']).val())) {
			util.tips('填写的证件号不合法');
			$(form['mcert[detail][idcard]']).focus();
			return false;
		}
		if ($(form['mcert[detail][thumb][]']).eq(0).val()=='') {
			util.tips('手持证件正面照片');
			return false;
		}
		if ($(form['mcert[detail][thumb][]']).eq(1).val()=='') {
			util.tips('证件背面照片');
			return false;
		}
	}else{
		if ($(form['mcert[detail][company]']).val()=='') {
			util.tips('请填写企业全称');
			$(form['mcert[detail][company]']).focus();
			return false;
		}
		if ($(form['mcert[detail][idcard]']).val()=='') {
			util.tips('请填写营业执照注册码');
			$(form['mcert[detail][idcard]']).focus();
			return false;
		}
		if ($(form['mcert[detail][name]']).val()=='') {
			util.tips('请填写法定代表人姓名');
			$("input[name='mcert[detail][name]']").focus();
			return false;
		}
		if ($(form['mcert[detail][thumb][]']).eq(0).val()=='') {
			util.tips('营业执照照片');
			return false;
		}
	}
	
	postData.mcert(form['mcert[type]'].value);
	return false;
}
$('body').delegate('.js-popover-sub','tap', function(e) {
	var _this = this;
	if ($(this).attr('data-popover')=='mcert_person' || $(this).attr('data-popover')=='mcert_enterprise'){
		var tormtype = $(this).attr('data-popover')=='mcert_person' ? '#formperson' : '#formenterprise';
		mui.getJSON("<?php  echo app_url('member/merch/mcert')?>", function(data){
			if (!$.isEmptyObject(data)){
				console.log(data);
				var timestamp = Math.round(new Date().getTime()/1000);
				if (data.type=='1'){//个人
					$(tormtype).find("input[name='mcert[detail][name]']").val(data.detail.name);
					$(tormtype).find("input[name='mcert[detail][idcard]']").val(data.detail.idcard);
					$(tormtype).find("input[name='mcert[detail][thumb][]']").eq(0).val(data.detail.thumb[0]);
					$(tormtype).find("input[name='mcert[detail][thumb][]']").eq(1).val(data.detail.thumb[1]);
					$(tormtype).find('.file-item').eq(0).attr("data-id",data.detail.thumbid[0]);
					$(tormtype).find('.file-item').eq(1).attr("data-id",data.detail.thumbid[1]);
					$(tormtype).find('img').eq(0).attr("src",data.detail.pic[0]).attr("data-preview-src",data.detail.pic[0])
					$(tormtype).find('img').eq(1).attr("src",data.detail.pic[1]).attr("data-preview-src",data.detail.pic[1])
				}
				if (data.type=='2'){//企业
					$(tormtype).find("input[name='mcert[detail][company]']").val(data.detail.company);
					$(tormtype).find("input[name='mcert[detail][idcard]']").val(data.detail.idcard);
					$(tormtype).find("input[name='mcert[detail][name]']").val(data.detail.name);
					$(tormtype).find("input[name='mcert[detail][thumb][]']").eq(0).val(data.detail.thumb[0]);
					$(tormtype).find('file-item').eq(0).attr("data-id",data.detail.thumbid[0]);
					$(tormtype).find('img').eq(0).attr("src",data.detail.pic[0]).attr("data-preview-src",data.detail.pic[0])
				}
				if (data.status==0 || (data.status==1 && timestamp < data.endtime)){
					$(tormtype).find('.file-panel').hide();
					$(tormtype).find('.js-submit').hide();
					$(tormtype).find('input').attr('onfocus', "this.blur()");
				}
				$(tormtype).find('.mui-upload-btn').hide().prev().show();
			}
		});
	}
});
</script>
<?php  } else if($_W['op'] == "hexiao") { ?>
<style type="text/css">
.mui-input-row label,.mui-input-row .mui-label{color:#6e6e6e;}
.group-list .mui-input-row{background-color:#fff!important;}
.group-list .mui-input-row label~input{text-align: right;}
.group-list .mui-input-row .mui-label{width:100%; padding-left:15px;}
.group-list .mui-input-row .mui-ext-icon,.group-child .mui-input-row .mui-ext-icon{position:absolute;top:0;z-index:10;width:40px;height:40px;line-height:41.5px;text-align:center;color:#ccc;font-size:18px;-webkit-transform: translateY(-50%);transform: translateY(-50%);}
.group-list .mui-input-row .mui-icon-remove,.group-child .mui-input-row .mui-icon-remove{right:0;}
.group-list .mui-input-row.mui-help .mui-help-info{width:60%;padding:0.5rem 0;margin-right:5%;font-size:0.55rem;line-height:1.3}
.group-list .mui-input-row.mui-help .mui-help-info span{margin-right:2rem;border:0;color:#ccc}
.group-child .mui-input-row input{padding-left:35px;}
.mui-input-row .mui-switch{margin-right:12px;}
.mui-input-group .mui-input-cell:after{height:0;}
.mui-image-uploader .file-item .file-title{position:absolute;left:0;bottom:0;line-height:1.6;width:100%;padding:0 5px; font-size:75%; color:#fff;background: rgba(0,0,0,0.5);}
.map-container{position: fixed;top: 0; left:0;bottom: 0; right:0;z-index:9999;height:auto;overflow:hidden;display:none;background:#FFF;}
.map-container.map-active{display:block}
.map-container iframe{width:100%;height:100%; padding-bottom:60px;border: none;}
</style>
<div id="merch_saler" class="mui-popover mui-popover-left">
	<div class="mui-popover-header">核销员设置
		<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="merch_saler"><me class="mui-icon mui-icon-closeempty"></me></a>
	</div>
	<div class="mui-popover-content">
		<form id="formsaler" action="" method="post" onSubmit="return check(this)">
		<div class="mui-scroll-wrapper">
			<div class="mui-scroll">
				<h5 class="mui-content-padded"></h5>
				<div class="mui-input-group">
					<div class="mui-input-cell">
						<div class="mui-table-view-chevron">
							<div class="mui-image-uploader">
								<div class="mui-image-preview js-saler-preview"></div>
								<a href="javascript:;" class="mui-upload-btn mui-inline webuploader-container">
									<div class="webuploader-pick js-popover-sub" data-popover='mui_search' data-type="saler"></div>
									<div class="btn-intro" style="position:absolute;color:#d7d7d7;top:54px;line-height: 1.2; left:0; right:0;">设置核销员</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<h5 class="mui-content-padded"></h5>
				<div class="mui-input-group group-list">
					<div class="js-store-preview"></div>
					<div class="mui-input-row js-saler-status">
						<label>是否启用</label>
						<div class="mui-switch mui-switch-mini mui-active">
							<div class="mui-switch-handle"></div>
							<input type="hidden" name="status" value="1">
						</div>
					</div>
				</div>                      
				<div class="mui-text-primary" style="background:#fff;overflow:hidden">
					<div class="mui-content-padded mui-text-center js-popover-sub" data-popover="mui_search" data-type="store">+添加核销场地</div>
				</div>
				<div class="mui-content-padded">
					<input type="hidden" name="id" value="" />
					<input type="hidden" name="type" value="saler">
					<input type="submit" class="mui-btn mui-btn-orange mui-btn-block" name="submit" value="保存"/>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

<div id="merch_store" class="mui-popover mui-popover-left">
	<div class="mui-popover-header">场地设置
		<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="merch_store"><me class="mui-icon mui-icon-closeempty"></me></a>
	</div>
	<div class="mui-popover-content">
		<form id="formstore" action="" method="post" onSubmit="return check(this)">
		<div class="mui-scroll-wrapper">
			<div class="mui-scroll">
				<h5 class="mui-content-padded"></h5>
				<div class="mui-input-group group-list">
					<div class="mui-input-row">
						<label>场地名称</label>
						<input type="text" name="storename" placeholder="(必填)" value="">
					</div>
					<div class="mui-input-row">
						<label>联系电话</label>
						<input type="text" name="tel" placeholder="(选填)" value="">
					</div>
					<div class="mui-input-row mui-help js-map js-address" data-type="map">
						<label>位置位置</label>
						<div class="mui-help-info mui-navigate-right mui-text-right mui-ellipsis"><span class="address">(必须)</span></div>
						<input type="hidden" value="" name="address">
						<input type="hidden" value="" name="map[lat]">
						<input type="hidden" value="" name="map[lng]">
						<input type="hidden" value="" name="map[adinfo]">
					</div>
					<div class="mui-input-row js-store-status">
						<label>是否启用</label>
						<div class="mui-switch mui-switch-mini mui-active">
							<div class="mui-switch-handle"></div>
							<input type="hidden" name="status" value="1">
						</div>
					</div>
					
				</div>
				<div class="mui-content-padded">
					<input type="hidden" name="id" value="" />
					<input type="hidden" name="type" value="store">
					<input type="submit" class="mui-btn mui-btn-orange mui-btn-block" name="submit" value="保存"/>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

<div id="mui_search" class="mui-popover mui-popover-left mui-popover-sub">
	<form action="" method="post" onsubmit="return check_search(this)" style="position: initial">
	<div class="mui-popover-header">
		<div class="mui-input-row mui-search mui-active" style="margin:0;width:85%; background:none;">
			<input type="search" name="keyword" class="mui-input-clear" placeholder="输入微信昵称" data-input-clear="1" data-input-search="1" value="">
			<input type="hidden" name="type" value="saler">
			<span class="mui-icon mui-icon-clear"></span>
			<span class="mui-placeholder"><span class="mui-icon mui-icon-search"></span></span>
		</div>
		<a class="mui-pull-right mui-popover-close js-popover-sub-close" data-popover="mui_search" style="right: -30px;padding: inherit;">取消&nbsp;</a>
	</div>
	</form>
	<div class="mui-popover-content" id="searchlist">
		<div class="mui-scroll-wrapper-ext" data-scroll="4">
			<div class="mui-scroll-ext">
				<div class="list-content">
					<ul class="mui-table-view" style="margin:0;max-height:none;"></ul>
			   </div>
			</div>
		</div>
	</div>
</div>
<script type="text/html" id="tpl_saler_earch">
<li class="mui-table-view-cell mui-media">
	<a href="javascript:;" class="js-set-hexiao" data-openid="{{d.openid}}" data-nickname="{{d.member.nickname}}" data-type="saler">
		<img class="mui-media-object mui-pull-left" src="{{d.member.avatar}}">
		<div class="mui-media-body" style="padding:inherit">
			<div class="mui-pull-left" style="width:75%"><span class="mui-ellipsis-1">{{d.member.nickname}}</span></div>
			<div class="mui-pull-right"><p><font class="mui-text-orange">选择</font></p></div>
		</div>
	</a>
</li>
</script>
<script type="text/html" id="tpl_store_earch">
<li class="mui-table-view-cell mui-media">
	<a href="javascript:;" class="js-set-hexiao" data-storename="{{d.storename}}" data-id="{{d.id}}" data-type="store">
		<div class="mui-media-body" style="padding:inherit">
			<div class="mui-pull-left" style="width:75%"><span class="mui-ellipsis-1">{{d.storename}}</span></div>
			<div class="mui-pull-right"><p><font class="mui-text-orange">选择</font></p></div>
		</div>
	</a>
</li>
</script>
<script type="text/html" id="tpl_saler">
<div class="file-item js-saler-item">
	<img src="{{d.avatar}}">
	<input type="hidden" name="openids[]" value="{{d.openid}}">
	<div class="file-title mui-ellipsis"><span>{{d.nickname}}</span></div>
	<div class="file-panel js-remove"><span>×</span></div>
</div>
</script>
<script type="text/html" id="tpl_store">
<div class="mui-input-row mui-help js-store-item" storeid="{{d.id}}">
	<i class="mui-ext-icon mui-icon-remove js-remove"></i>
	<span class="mui-label js-form-edit" data-id="gender">{{d.storename}}</span>
	<input type="hidden" value="{{d.id}}" name="storeids[]">
</div>
</script>
<script>
function check(form){
	if (form['type'].value == 'saler') {
		if (!$("input[name='openids[]']").length) {
			util.tips('请设置一个核销员');
			return false;
		}
	}else{
		if ($.trim(form['storename'].value) == '') {
			util.alert('场地名称不能为空', ' ', function() {
				$(form['storename']).focus();
			});
			return false;
		}
		if ($.trim(form['address'].value) == '') {
			util.alert('位置不能为空', ' ', function() {
				$('.js-map').trigger('tap');
			});
			return false;
		}
	}
	
	postData.hexiao(form['type'].value);
	return false;
}
$('.js-map').on('tap',function(e){
	location.href = location.href + '#map_set';
});
//核销编辑
$('body').delegate('.js-popover', 'tap', function(e) {	
	$('.js-saler-preview').html('');
	$('.js-store-preview').html('');
	var type = $(this).attr('data-popover')=="merch_saler" ? 'saler' : 'store';
	$('#form'+type).find("input[name='id']").val($(this).data("id"));
	if ($(this).data("id")) {
		mui.getJSON("<?php  echo app_url('member/merch/hexiao', array('opp'=>'post'))?>", {id:$(this).data("id"), 'type':type}, 
		function(data){
			if (type=='saler'){//核销员
				var tpl_saler = document.getElementById('tpl_saler').innerHTML;
				var tpl_store = document.getElementById('tpl_store').innerHTML;
				for(var i = 0; i < data.member.length; i++){
					laytpl(tpl_saler).render(data.member[i], function(html){
						$('.js-saler-preview').append(html);
					});
				}
				for(var i = 0; i < data.stores.length; i++){
					laytpl(tpl_store).render(data.stores[i], function(html){
						$('.js-store-preview').append(html);
					});
				}
			}
			if (type=='store'){//门店
				$('#formstore').find("input[name='storename']").val(data.storename);
				$('#formstore').find("input[name='tel']").val(data.tel);
				
				$('.js-address').find('.address').text(data.address);
				$('.js-address').find("input").eq(0).val(data.address).next().val(data.lat).next().val(data.lng).next().val(data.adinfo);
			}
			//状态
			$('.js-'+type+'-status').find("input[name='status']").val(data.status);
			if (data.status==1) {
				$('.js-'+type+'-status').find('.mui-switch').addClass('mui-active');
				$('.js-'+type+'-status').find('.mui-switch-handle').css('transform','translate(16px, 0px)');
				
			}else{
				$('.js-'+type+'-status').find('.mui-switch').removeClass('mui-active');
				$('.js-'+type+'-status').find('.mui-switch-handle').css('transform','translate(0px, 0px)');
			}
		});
	}else{
		$('#formstore').find("input[name='storename']").val('');
		$('#formstore').find("input[name='tel']").val('');					
		$('.js-address').find('.address').text('(必须)');
		$('.js-address').find("input").eq(0).val('').next().val('').next().val('').next().val('');
	}
});
//核销搜索控制
$(".js-popover-sub").on('tap',function(e) {
	var type = $(this).data('type'),
		placeholder = type=='saler' ? '输入微信昵称' : '输入场地名称，直接搜索显示所有门店';
	$('#mui_search').find("input[name='keyword']").attr('placeholder', placeholder);
	$('#mui_search').find("input[name='type']").val(type);
	if($('#searchlist').find('.js-set-hexiao').length && !$('#searchlist').find('.js-set-hexiao[data-type="'+type+'"]').length){
		$('#searchlist').find('.list-content .mui-table-view').html('');
		$('#searchlist').find('.dropload-down').remove();
	}
});
var loadSearch=function(id, type, keyword){
	var thispage = 1;
	$(id).find('.mui-scroll-ext').dropload({
		scrollArea : $(id).find('.mui-scroll-wrapper-ext'),
		threshold : 50,
		loadDownFn : function(me){
			mui.getJSON("<?php  echo app_url('member/merch/hexiao',array('opp'=>'search'))?>",{page:thispage,type:type,keyword:keyword}, 
			function(data){
				//console.log(data);
				var stime = new Date(),result='';
				if (data.tpage == 0){
					result = '<div class="no-orders-at-all">'
					+'<div class="head-block">'
					+'    <p class="recommend-hint"></p>'
					+'</div></div>';
					$(id).find('.list-content').append(result);
				}
				if (thispage >= data.tpage || data.tpage == 0){
					me.lock();// 锁定
					me.noData();// 无数据
				}
				
				var gettpl = document.getElementById('tpl_'+type+'_earch').innerHTML;
				for(var i = 0; i < data.list.length; i++){
					laytpl(gettpl).render(data.list[i], function(html){
						$(id).find('.list-content .mui-table-view').append(html);
					});
				}
				
				thispage++;
				// 每次数据加载完，必须重置
				me.resetload();
			});
		}
	});
	
};
function check_search(form){
	if ($.trim(form['keyword'].value) == '' && form['type'].value == 'saler') {
		util.tips('关键词不能为空');
		return false;
	}else{
		$('#searchlist').find('.dropload-down').remove();
		$('#searchlist').find('.no-orders-at-all').remove();
		$('#searchlist').find('.list-content .mui-table-view').html('');
		loadSearch('#searchlist', form['type'].value, $.trim(form['keyword'].value));
	}
	return false;
}
//开关
$('.mui-switch').on('tap',function(e){
	if ($(this).hasClass("mui-active")){
		$(this).find('input').val(1);
	}else{
		$(this).find('input').val(0);
	}
	//console.log("你启动了开关");
});
//选择核销员
$("#searchlist").delegate('.js-set-hexiao', 'tap',function(e) {
	var hh = '', istrue = true, _this = this, type = $(this).data('type');
	if (type == 'store'){
		if($('.js-store-item[storeid="' + $(this).data('id') +'"]').length>0){
			util.tips('场地不能重复');
			return;
		}
		hh += '<div class="mui-input-row mui-help js-store-item" storeid="' + $(this).data('id') +'">'
		+'	<i class="mui-ext-icon mui-icon-remove js-remove"></i>'
		+'	<span class="mui-label js-form-edit" data-id="gender">' +$(this).data('storename') +'</span>'
		+'	<input type="hidden" value="' + $(this).data('id') +'" name="storeids[]">'
		+'</div>';
		$(".js-"+type+"-preview").append(hh);
	}else{
		$("input[name='openids[]']").each(function(){
			if ($(this).val()==$(_this).data("openid")){
				util.tips('当前核销员已设置');
				istrue = false;
				return false;
			}
		});
		if (!istrue) return false;
		hh += '<div class="file-item js-saler-item">'
		+'	<img src="'+$(this).find("img").attr("src")+'">'
		+'	<input type="hidden" name="openids[]" value="'+$(this).data("openid")+'">'
		+'	<div class="file-title mui-ellipsis"><span>'+$(this).data("nickname")+'</span></div>'
		+'	<div class="file-panel"><span>×</span></div>'
		+'</div>';
		$(".js-"+type+"-preview").html(hh);
	}
	
	setTimeout(function() {
		$('#mui_search').removeClass('mui-active').fadeOut();
		$('body').find('.mui-backdrop-sub').remove();history.back(-1);
	},500);
});
//移除核销员、核销场地
$('#merch_saler').delegate(".js-remove","tap",function(e){
	var $this = $(this);
	$this.parents('.js-saler-item').remove();
	$this.parents('.js-store-item').remove();
});
</script>
<?php  } ?>
<script>
//数据发送
var postData = {
	hexiao:function(type){
		$.post("<?php  echo app_url('member/merch/hexiao', array('opp'=>'post'))?>", $('#form'+type).serialize(), function(data){
			if (!data.errno){
				var key = (type=='saler' ? 0 : 1);
				util.tips('操作成功，刷新中！');	
				setTimeout(function() {mui('#merch_'+type).popover('toggle')}, 500);
				setTimeout(function() {
					$("#item"+key).find('.mui-table-view').html('');
					$("#item"+key).find('.dropload-down').remove();
					history.back(-1);
					loadItem('#item'+key, type);
				}, 1000);
			}else{
				util.tips('没有发生改变！');
			}
		},"json");
	},
	mcert:function(type){
		type = type == 1 ? 'person' : 'enterprise';
		$.post("<?php  echo app_url('member/merch/mcert')?>", $('#form'+type).serialize(), function(data){
			if (!data.errno){
				setTimeout(function() {
					$('#mcert_'+type).removeClass('mui-active').fadeOut();
					$('body').find('.mui-backdrop-sub').remove();history.back(-1);
					}, 500);
				util.tips('保存成功，已进入审核！');
				$("#merch_mcert").find('.js-mcert-type button').attr('data-popover', 'mcert_'+type).text('查看认证资料');
				$(".js-change-mcert").find("span").html('<font class="mui-text-danger">审核中</font>');
			}else{
				util.tips('没有发生改变！');
			}
		},"json");
	}
}
</script>