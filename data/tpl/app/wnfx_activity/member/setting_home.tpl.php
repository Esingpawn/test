<?php defined('IN_IA') or exit('Access Denied');?><div id="member" class="mui-popover mui-popover-left">
    <div class="mui-popover-header">个人资料<a class="mui-pull-right mui-popover-close js-popover-close" data-popover="member"><me class="mui-icon mui-icon-closeempty"></me></a></div>
    <div class="mui-popover-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <ul class="mui-table-view">
                    <li class="mui-table-view-cell avatar">
                        <a id="head" class="mui-navigate-right">头像
                            <span class="mui-pull-right">
                                <img class="head-img mui-action-preview" width="40" height="40" src="<?php  echo $member['avatar'];?>">
                            </span>
                        </a>
                        <div class="upload-btn js-avatar-avatar" style="position:absolute;"></div>
                    </li>
                    <script>
                        util.img($('.js-avatar-avatar'), function(url){
                            $('.avatar img').attr('src', url.url);
                            $.post('./index.php?i=<?php  echo $_W["uniacid"];?>&c=mc&a=profile&do=avatar&', {'avatar' : url.attachment}, function(data) {
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
                    <li class="mui-table-view-cell" data-type="nickname">
                        <a>会员<span class="mui-badge mui-badge-inverted"><?php  echo $_W['member']['groupname'];?></span></a>
                    </li>
                    <li class="mui-table-view-cell js-change" data-type="nickname">
                        <a>昵称<span class="mui-badge mui-badge-inverted"><?php  echo $member['nickname'];?></span></a>
                    </li>
                    <li class="mui-table-view-cell js-change" data-type="realname">
                        <a>姓名<span class="mui-badge mui-badge-inverted"><?php  echo $member['realname'];?></span></a>
                    </li>
                    <li class="mui-table-view-cell js-change" data-type="gender">
                        <a>性别<span class="mui-badge mui-badge-inverted"><?php  echo $member['gender'];?></span></a>
                    </li>
                    <li class="mui-table-view-cell js-change" data-type="age">
                        <a>年龄<span class="mui-badge mui-badge-inverted"><?php  echo $member['age'];?></span></a>
                    </li>
                    <li class="mui-table-view-cell js-popover-sub js-change-address" data-popover="address">
                        <a>收货地址<span class="mui-badge mui-badge-inverted"><?php  echo $member['address'];?></span></a>
                    </li>
                </ul>
                <ul class="mui-table-view">
                    <li class="mui-table-view-cell">
                        <a href="<?php  echo app_url('member/bond/mobile',array('setting'=>1))?>">手机号<span class="mui-badge mui-badge-inverted<?php  if(empty($member['mobile'])) { ?> mui-text-primary<?php  } ?>"><?php  if(empty($member['mobile'])) { ?>待绑定<?php  } else { ?><?php  echo $member['mobile'];?><?php  } ?></span></a>
                    </li>
                    <li class="mui-table-view-cell js-change" data-type="qq">
                        <a>QQ号<span class="mui-badge mui-badge-inverted<?php  if(empty($member['qq'])) { ?> mui-text-primary<?php  } ?>"><?php  if(empty($member['qq'])) { ?>待绑定<?php  } else { ?><?php  echo $member['qq'];?><?php  } ?></span></a>
                    </li>
                    <li class="mui-table-view-cell" style="display:none">
                        <a>邮箱地址<span class="mui-badge mui-badge-inverted"><?php  echo $member['email'];?></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="address" class="mui-popover mui-popover-sub mui-popover-left">
	<div class="mui-popover-header">收货地址管理
		<a class="mui-pull-right mui-popover-close js-popover-sub-close" data-popover="address"><me class="mui-icon mui-icon-closeempty"></me></a>
	</div>
	<div class="mui-popover-content">
		<form id="formaddress" action="" method="post" onSubmit="return check(this)">
		<div class="mui-scroll-wrapper">
			<div class="mui-scroll">
				<h5 class="mui-content-padded"></h5>
				<div class="mui-input-group">
                	<div class="mui-input-row">
						<label>所在地区</label>
						<?php  echo tpl_app_fans_form('reside', array('province' => $member['resideprovince'], 'city' => $member['residecity'], 'district' => $member['residedist']), $placeholder);?>
					</div>
					<div class="mui-input-row">
						<label>详细地址</label>
						<input type="text" name="address" value="<?php  echo $member['address'];?>">
					</div>
                    <p></p>
				</div>
				<h5 class="mui-content-padded"></h5>
				<div class="mui-input-group" style="display:none">
					<div class="mui-input-row">
						<label>默认地址</label>
						<div class="mui-switch mui-switch-mini mui-active">
							<div class="mui-switch-handle"></div>
							<input type="hidden" name="status" value="1">
						</div>
					</div>
                    <p></p>
				</div>
				<div class="mui-content-padded">
					<input type="hidden" name="id" value="" />
					<input type="hidden" name="type" value="address">
					<input type="submit" class="mui-btn mui-btn-orange mui-btn-block" name="submit" value="保存"/>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
<script>
    $(".js-change").on('tap',function(e) {
        e.detail.gesture.preventDefault(); //修复iOS 8.x平台存在的bug，使用plus.nativeUI.prompt会造成输入法闪一下又没了
        var $this = $(this);
        var placeholder = '', params = '', value = '', type = $(this).data("type");
        switch(type){
            case 'nickname':placeholder = '请输入新的昵称';params = {'nickname' : '', type : type};break;
            case 'realname':placeholder = '请输入真实姓名';params = {'realname' : '', type : type};break;
            case 'qq'      :placeholder = '请输入您的QQ';params = {'qq' : '', type : type};break;
			case 'age'     :placeholder = '请输入您的年龄';params = {'age' : '', type : type};break;
			case 'address' :placeholder = '请输入您的收货地址';params = {'address' : '', type : type};break;
            default:break;
        }	
        if (type!='gender'){
            mui.prompt('资料修改', placeholder,' ', function(e) {
                if (e.index == 1) {
                    value = e.value;
                    if ($.trim(value)==''){
                        util.tips('更改信息不能为空');
                        return false;
                    }
					params[type] = value;
					//console.log(params);
					$.post("<?php  echo app_url('member/mc');?>", params, function(data) {
                        data = $.parseJSON(data);
                        if (data.type == 'success') {
                            util.toast(data.message);
                            $this.find('span').removeClass('mui-text-primary').text(value);
                        } else {
                            util.toast(data.message);
                        }
                    })
                }
            });
        }else{
            var options = {data: [{"text":"\u4fdd\u5bc6","value":0},{"text":"\u7537","value":1},{"text":"\u5973","value":2}]};
            var $this = $(this);
            util.poppicker(options, function(items){
                $.post("<?php  echo app_url('member/mc');?>", {'gender' : items[0].value, type : type}, function(data) {
                    data = $.parseJSON(data);
                    if (data.type == 'success') {
                        util.toast(data.message);
                        $this.find('span').removeClass('mui-text-primary').text(items[0].value==1?'男':(items[0].value==2?'女':'保密'));
                    } else {
                        util.toast(data.message);
                    }
                })
            });
        }
    });
function check(form){
	if ($.trim(form['reside[province]'].value) == '') {
		util.alert('请选择地区', ' ', function() {
			$('.mui-district-picker-reside').focus();
		});
		return false;
	}
	if ($.trim(form['address'].value) == '') {
		util.alert('详细地址不能为空', ' ', function() {
			$(form['address']).focus();
		});
		return false;
	}	
	change_address(form);
	return false;
}
function change_address(obj){
	$.post("<?php  echo app_url('member/mc')?>", $(obj).serialize(), function(data){
		if (!data.errno){
			setTimeout(function() {
				$(obj).parents('.mui-popover').removeClass('mui-active').fadeOut();
				$('body').find('.mui-backdrop-sub').remove();history.back(-1);
				}, 500);
			util.tips('保存成功！');
			$('#member').find(".js-change-"+obj['type'].value+" span").text(obj['address'].value);
		}else{
			util.tips('没有发生改变！');
		}
	},"json");
}
</script>