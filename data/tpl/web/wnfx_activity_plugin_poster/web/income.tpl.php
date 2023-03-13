<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="./resource/css/app.css" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=20170826" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/util.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>web/resource/js/util.min.js?v=201709121"></script>
<style>
.app .panel {background-color: #FFF;}
.app .app-preview.wap-editor-footer{border-radius:18px;padding-bottom:50px;position:relative}
.app .app-preview .app-content {width: 322px;margin: 0 auto;padding-bottom: 0px;border: 1px solid #c5c5c5;min-height:400px;background: #fff}
.app .app-side{width:58%;}
.app .app-side>div{width:auto}
.app .app-coupon .promote-poster {-webkit-tap-highlight-color:transparent;position:relative;height:569px;overflow:hidden;border-radius:0;margin:0;color: #fff;}
.app .app-coupon .promote-poster .dot {width:100%;height: 5px;background-size: auto 5px;margin-top: 3px}
.app .app-coupon .promote-poster .name {position: relative;padding: 0 70px 0 10px;height: 60px;line-height: 60px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;font-size: 18px}
.app .app-coupon .promote-poster .promote-value {font-size: 30px;line-height: 40px}
.app .app-coupon .promote-poster .promote-limit {font-size: 14px;line-height: 40px}
.app .app-coupon .promote-poster .poster-info{background-color:#FFF;position:absolute; left:0;bottom:0; right:0;}
.app .app-coupon .promote-poster .poster-info .promote-state{color: rgba(0,0,0,0.8);padding-left:15px; line-height:2}
.app .app-coupon .promote-poster .poster-info .promote-time {padding-left:15px;color: rgba(0,0,0,0.5);font-size: 12px;padding-bottom: 5px;border-radius:0  0 8px 8px}
.app .app-coupon .promote-desc{ background:#f2f2f2}
.app .app-coupon .promote-desc>div{background:#FFF}
.app .app-coupon .promote-desc .promote-desc-title {padding: 2px 15px; text-align:center; border-bottom: 1px solid #ddd;}
.app .app-coupon .promote-desc .promote-desc-title .nav.nav-tabs{margin:0;border-bottom:none;width: 60%;margin: auto;}
.app .app-coupon .promote-desc .promote-desc-title .nav>li{width:50%;}
.app .app-coupon .promote-desc .promote-desc-title .nav>li>a{padding:5px 10px;border:none;margin:0;position:relative;color:#999}
.app .app-coupon .promote-desc .promote-desc-title .nav-tabs>li.active>a{color:#000}
.app .app-coupon .promote-desc .promote-desc-title .nav-tabs>li.active>a:after{position:absolute;left:30px;right:30px;bottom: 0;height: 2px;background-color: #EC0000;content: "";}
.app .app-coupon .promote-desc .desc-detail {min-height:80px;padding: 15px}
.app .app-coupon .promote-desc .list-group{margin-bottom:0;}
.app .app-coupon .promote-desc .list-group-item{padding-left:0;margin-left:15px;border:none;border-top: 1px solid #ddd;border-radius:0;}
.app .app-coupon .promote-desc .list-group-item:first-child{border:none;}
.app .app-coupon .promote-desc .list-group-item .fa{ color:#83c53f}
.app .app-coupon .promote-desc .promote-desc-friends{background:#FFF;margin:10px 0; padding:8px 15px; font-size:18px;}
.app .app-coupon .promote-desc .promote-desc-friends span{ color:#999;font-size:12px;}
.app .app-coupon-edit .panel {border-radius: 0;border-bottom: 0}
.app .app-coupon-edit .panel:last-child {border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;border-bottom: 1px solid #ddd}
.ui-icon{width:12px!important;height:12px!important;}
.ui-widget-content{z-index:2;position:absolute!important;top:0;left:0;font-size:17px;line-height:1.2}
.drag{cursor:default}
.menu-list{width:125px;height:auto;overflow:hidden;display:none;background:#EEE;box-shadow:0 1px 1px #888,1px 0 1px #ccc;border: 1px solid #DDD;position:absolute;z-index:999}
.menu-list .menu-item{width:130px;height: 25px;line-height: 25px;padding: 0 10px}
.menu-list .menu-item:hover{cursor: pointer;background-color: #39F}
.we7-table>tbody>tr>td{padding:5px 0;}
</style>
<?php  if($op == 'display') { ?>
<ul class="nav nav-tabs we7-margin-bottom">
    <li<?php  if($_GPC['pay_status']=='' && $_GPC['status']=='') { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('income', array('op' => 'display','pay_status'=>''))?>">全部记录</a>
    </li>
    <li<?php  if($_GPC['status']=='0') { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('income', array('op' => 'display','status'=>0))?>">未提现</a>
    </li>
    <li<?php  if($_GPC['pay_status']=='0') { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('income', array('op' => 'display','pay_status'=>0))?>">未审核</a>
    </li>
    <li<?php  if($_GPC['pay_status']==1) { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('income', array('op' => 'display','pay_status'=>1))?>">未打款</a>
    </li>
    <li<?php  if($_GPC['pay_status']==2) { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('income', array('op' => 'display','pay_status'=>2))?>">已打款</a>
    </li>
    <li<?php  if($_GPC['pay_status']==3) { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('income', array('op' => 'display','pay_status'=>3))?>">已驳回</a>
    </li>
    <li<?php  if($_GPC['pay_status']==-1) { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('income', array('op' => 'display','pay_status'=>-1))?>">无效提现</a>
    </li>    
</ul>
<div class="we7-page-search we7-padding-bottom clearfix">
	<form action="" method="get" class="form-inline ng-pristine ng-valid" role="form">
		<input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="<?php echo MODULE_PLUGIN_NAME;?>" />
        <input type="hidden" name="do" value="income" />
         <input type="hidden" name="version_id" value="0" />
		<div class="form-group col-md-9" style="padding-left:0">
			<div class="input-group col-md-2">
                <select name="search[status]" class="form-control" style="color:inherit!important">
                    <option value="">提现状态</option>
                    <option value="0"<?php  if($search['status']=='0') { ?> selected<?php  } ?>>未提现</option>
                    <option value="1"<?php  if($search['status']==1) { ?> selected<?php  } ?>>已提现</option>
                </select>
            </div>
            <div class="input-group">
				<input name="search[member]" value="<?php  echo $search['member'];?>" class="form-control" placeholder="昵称/姓名/手机" type="text">
                <span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
			</div>
		</div>
        
	</form>
</div>
<form method="post" class="we7-form" id="form1">
    <table class="table we7-table table-hover vertical-middle" style="<?php echo substr(IMS_VERSION, 0, 1)>=2?'margin-bottom:35px':''?>">
        <input type="hidden" name="do" value="del">
        <tbody>
        <tr>
        	<th class="text-left" width="60"></th>
            <th class="text-center">时间</th>
            <th class="text-center">会员ID</th>
            <th width="15%" class="text-center">粉丝</th>
            <th width="15%" class="text-center">姓名<br>手机号码</th>
            <th width="10%" class="text-center">收入金额</th>
            <th width="10%" class="text-center">业务类型</th>
            <th width="10%" class="text-center">提现状态</th>
            <th width="10%" class="text-center">打款状态</th>
            <th class="text-right" width="210px">操作</th>
        </tr>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
        	<td style="overflow: hidden;">
                <input type="checkbox" id="id-<?php  echo $row['id'];?>" name="id[]" value="<?php  echo $row['id'];?>" class="items">
                <label for="id-<?php  echo $row['id'];?>">&nbsp;</label>
            </td>
            <td class="text-center"><?php  echo $row['created_at'];?></td>
            <td class="text-center"><?php  echo $row['member']['uid'];?></td>
            <td class="text-center"><img src="<?php  echo $row['member']['avatar'];?>" style="width:30px;height:30px;border:1px solid #ccc;padding:1px;">
            	</br><?php  echo $row['member']['nickname'];?>
                </td>
            <td class="text-center"><?php  echo $row['member']['realname'];?>
                </br>
                <?php  echo $row['member']['mobile'];?></td>
            <td class="text-center"><?php  echo $row['amount'];?></td>
            <td class="text-center"><?php  echo $row['type_name'];?></td>
            <td class="text-center"><?php  echo $row['status_name'];?></td>
            <td class="text-center"><?php  echo $row['pay_status_name'];?></td>
            <td style="overflow:visible;">
                <div class="link-group">
                    <?php  if(!$row['status'] && $row['amount'] >= 1) { ?><a href="javascript:void(0);" class="js-withdraw" data-id="<?php  echo $row['id'];?>" data-placement="left" title="提现">提现</a><?php  } ?>
                </div>
            </td>
        </tr>
        <?php  } } ?>
    </tbody></table>
    
	<div class="text-right<?php echo substr(IMS_VERSION, 0, 1)>=2?' foot-fixed':''?>">
    	<div class="pull-left" style="padding-left:14px;">
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
            <input type="checkbox" id="check-all" name="check-all" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
            <label for="check-all"> &nbsp;</label>
            <button type="button" class="btn btn-primary btn-submit withdraw js-batch" data-placement="right">批量提现</button>
        </div>
		<?php  echo $pager;?>
    </div>
</form>
<script type="text/javascript">
$(function(){
	$(".edit-commission").click(function () {
        var _this = $(this);
        _this.hide();
        _this.next().show();

    });
	
	$(".updated-commission").blur(function () {
        var _this = $(this);
        var id;

        id = _this.data('id');
        $.ajax({
            url: "<?php  echo $this->createWeburl('order', array('op' => 'edit'))?>",
            dataType: 'json',
            data: {
                commission: $.trim(_this.val()),
                id: $.trim(id)
            }, success: function (data) {
                _this.hide();
                _this.prev().show();
                if (!data.result) {
                    _this.prev().text(_this.val() + ' 修改');
                }
				util.tips(data.msg);
            }
        });
    });

    $(".updated-commission").keydown(function (e) {
        if (e.which == 13) {
            $(".updated-commission").blur();
        }
    });
	$(".dropdown-menu li a").click(function (e) {
		$('input[name="search[membertype]"]').val($(this).data('type'));
		$('.menu_text').text($(this).text());
    });
	
	//提现效果，单条操作
	$('.js-withdraw').click(function(e) {
		e.stopPropagation();
		var $this = $(this);
		var id = $this.data('id');
		util.nailConfirm(this, function(state) {
			if (!state) return;
			util.loading("处理中...");
			$.post("<?php  echo $this->createWeburl('income', array('op' => 'withdraw', 'manual' => 2, 'submit_pay' => '打款到微信钱包'))?>", {id : id}, function(data) {
				util.message(data.msg,"refresh","success");
			}, 'json');
		}, {html:"确认提现？",placement: $this.data('placement')});
	});
	
	//批量提现效果
	$('.js-batch').click(function(e){
		e.stopPropagation();
		var ids = [];
		var $checkboxes = $('.items:checkbox:checked');
		$checkboxes.each(function() {
			if (this.checked) {
				ids.push(this.value);
			};
		});
		if (ids.length == 0) {
			util.tips('请选择要操作的信息!', 2000);
			return false;
		}
		var op = '',html = '';
		if ($(this).hasClass('withdraw')) {
			op = 'withdraw';
			html = '确认提现?';
		}
		var $this = $(this);
		util.nailConfirm(this, function(state) {
			if(!state) return;
			util.loading("处理中...");
			$.post("<?php  echo $this->createWeburl('income', array('manual' => 2, 'submit_pay' => '打款到微信钱包'))?>", {op : op,id : ids}, function(data){
				if(!data.error)
					util.message(data.msg,"refresh","success");
				else{
					util.loaded();
					util.message(data.msg,"refresh","error");
				}
			}, 'json');
		}, {html: html, placement: $this.data('placement')});
	});
});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH));?>