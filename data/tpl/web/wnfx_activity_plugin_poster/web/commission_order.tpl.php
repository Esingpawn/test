<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="./resource/css/app.css" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/common.min.css?v=20170826" rel="stylesheet">
<link href="<?php echo FX_URL;?>web/resource/css/util.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo FX_URL;?>web/resource/js/util.min.js?v=20170912"></script>
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
    <li<?php  if($_GPC['status']=='') { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('order', array('op' => 'display','status'=>''))?>">所有订单</a>
    </li>
    <li<?php  if($_GPC['status']=='0') { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('order', array('op' => 'display','status'=>0))?>">预计佣金</a>
    </li>
    <li<?php  if($_GPC['status']==1) { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('order', array('op' => 'display','status'=>1))?>">未结算</a>
    </li>
    <li<?php  if($_GPC['status']==2) { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('order', array('op' => 'display','status'=>2))?>">已结算</a>
    </li>
    <li<?php  if($_GPC['status']==3) { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('order', array('op' => 'display','status'=>3))?>">未提现</a>
    </li>
    <li<?php  if($_GPC['status']==4) { ?> class="active"<?php  } ?>>
        <a href="<?php  echo web_url('order', array('op' => 'display','status'=>4))?>">已提现</a>
    </li>    
</ul>
<div class="we7-page-search we7-padding-bottom clearfix">
	<div class="pull-right" style="display:none">
        <a href="<?php  echo $this->createWeburl('poster', array('op' => 'post'))?>" class="btn btn-primary we7-padding-horizontal">+添加海报</a>
    </div>
	<form action="" method="get" class="form-inline ng-pristine ng-valid" role="form">
		<input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="<?php echo MODULE_PLUGIN_NAME;?>" />
        <input type="hidden" name="do" value="order" />
         <input type="hidden" name="version_id" value="0" />
		<div class="form-group col-md-9" style="padding-left:0">
        	<div class="input-group col-md-2">
                <select name="search[hierarchy]" class="form-control" style="color:inherit!important">
                    <option value="">分销层级</option>
                    <option value="1"<?php  if($search['hierarchy']==1) { ?> selected<?php  } ?>>一级</option>
                    <option value="2"<?php  if($search['hierarchy']==2) { ?> selected<?php  } ?>>二级</option>
                    <option value="3"<?php  if($search['hierarchy']==3) { ?> selected<?php  } ?>>三级</option>
                </select>
            </div>
			<div class="input-group">
				<div class="input-group-btn">
					<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    	<span class="menu_text"><?php echo $search['membertype'] > 0 ? ($search['membertype']==1?'购买者':'推荐者') : '用户类型'?></span>
						<span class="caret"></span>
					</button>
					<ul role="menu" class="dropdown-menu">
						<li>
							<a href="javascript:;" data-type="0">用户类型</a>
						</li>
						<li>
							<a href="javascript:;" data-type="1">购买者</a>
						</li>
                        <li>
							<a href="javascript:;" data-type="2">推荐者</a>
						</li>
					</ul>
				</div>
				<input name="search[member]" value="<?php  echo $search['member'];?>" class="form-control" placeholder="会员ID/昵称/手机" type="text">
                <input name="search[membertype]" type="hidden" value="<?php  echo $search['membertype'];?>">
			</div>
            <div class="input-group col-md-5">
                <input name="search[order]" value="<?php  echo $search['order'];?>" class="form-control" placeholder="订单ID/订单号" type="text" style="80%">
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
            <th class="text-left" width="5%">ID</th>
            <th width="15%">订单号</th>
            <th>购买者信息</th>
            <th width="10%">订单金额</th>
            <th width="15%">分销计算金额</br>计算方式</th>
            <th width="10%">推荐者信息</th>
            <th width="15%">分销层级/佣金比例</th>
            <th width="10%">佣金金额</th>
            <th class="text-right" width="8%">佣金状态</th>
        </tr>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td><?php  echo $row['id'];?></td>
            <td><a href=""><span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:78%;display:block;"><?php  echo $row['order_sn'];?></span></a></td>
            <td><img src="<?php  echo $row['member']['avatar'];?>" style="width: 40px; height: 40px;border:1px solid #ccc;padding:1px;">
            	</br><?php  echo $row['member']['realname'];?></td>
            <td><?php  echo $row['commission_amount'];?></td>
            <td><?php  echo $row['commission_amount'];?></br>商品独立佣金</td>
            <td><img src="<?php  echo $row['parentMember']['avatar'];?>" style="width: 40px; height: 40px;border:1px solid #ccc;padding:1px;">
            	</br><?php  echo $row['parentMember']['realname'];?></td>
            <td>层级:<?php  echo $row['hierarchy'];?> - 比例:<?php  echo $row['commission_rate'];?></td>
            <td>
            <?php  if($row['status'] <= '1' && $row['status'] != '-1') { ?>
                <a href="javascript:;" class="edit-commission color-default"><?php  echo $row['commission'];?> 修改 </a>
                <input style="display:none; width:80%" type="text" class="updated-commission" data-id="<?php  echo $row['id'];?>" name="commission" value="<?php  echo $row['commission'];?>"/>
            <?php  } else { ?>
                <?php  echo $row['commission'];?>
            <?php  } ?></td>
            <td style="overflow:visible;">
            	<?php  if($row['status'] == '-1') { ?>
                    无效佣金
                <?php  } else if($row['status'] == '0') { ?>
                    预计佣金
                <?php  } else if($row['status'] == '1') { ?>
                    未结算
                <?php  } else if($row['status'] == '2' && $row['withdraw'] == '0') { ?>
                    未提现
                <?php  } else if($row['status'] == '2' && $row['withdraw'] == '1') { ?>
                    已提现
                <?php  } ?>
            </td>
        </tr>
        <?php  } } ?>
    </tbody></table>
    
	<div class="text-right<?php echo substr(IMS_VERSION, 0, 1)>=2?' foot-fixed':''?>">
    	<div class="pull-left text-left text-muted small">
            累计：总佣金 <?php  if($total['coms']['0']>0) { ?><?php  echo sprintf("%.2f",$total['coms']['0'])?><?php  } else { ?>0<?php  } ?>，订单总额 <?php  if($total['coms']['1']>0) { ?><?php  echo sprintf("%.2f",$total['coms']['1'])?><?php  } else { ?>0<?php  } ?><br>
            预计佣金 <?php  if($total['coms']['2']>0) { ?><?php  echo sprintf("%.2f",$total['coms']['2'])?><?php  } else { ?>0<?php  } ?>，
            未结算 <?php  if($total['coms']['3']>0) { ?><?php  echo sprintf("%.2f",$total['coms']['3'])?><?php  } else { ?>0<?php  } ?>，
            已结算 <?php  if($total['coms']['4']>0) { ?><?php  echo sprintf("%.2f",$total['coms']['4'])?><?php  } else { ?>0<?php  } ?>，
            未提现 <?php  if($total['coms']['5']>0) { ?><?php  echo sprintf("%.2f",$total['coms']['5'])?><?php  } else { ?>0<?php  } ?>，
            已提现 <?php  if($total['coms']['6']>0) { ?><?php  echo sprintf("%.2f",$total['coms']['6'])?><?php  } else { ?>0<?php  } ?>
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
});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/2.0/footer', TEMPLATE_INCLUDEPATH));?>