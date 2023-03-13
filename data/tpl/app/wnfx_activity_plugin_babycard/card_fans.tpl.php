<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-card{height:7rem;border-radius:5px;margin-left:22%;margin-right:22%;background:#1a1a1a;margin-top:8px;border:none;-webkit-box-shadow: 0 -3px 20px rgba(0,0,0,.7);box-shadow: 0 -3px 20px rgba(0,0,0,.7);}
.mui-card .mui-card-header{background:transparent;border:none;position:relative}
.mui-card .mui-card-header.mui-navigate-right:after{color:#d5b577}
.mui-card .mui-card-header img:first-child{width:50px!important;height:50px!important;margin-top:5px;}
.mui-card .mui-card-header .mui-media-body{color:#d5b577;font-size:16px;padding:5px 0;margin-left: 60px;position:relative;line-height:1.5}
.mui-card .mui-card-header .mui-media-body .mui-badge{border-radius:3px;}
.mui-card .mui-card-content-inner{padding:0;color:#d5b577!important;}
.mui-card .mui-card-content-inner .card-info{ text-align:center}
.mui-bar-footer {padding: 0;background: #fff;height:45px;line-height:48px}
.mui-bar-footer .mui-btn {width: 50%;height: 45px;border-radius: 0;float: right;margin: 0!important}
.crad-desc-friends{background:#FFF;margin:10px 0; padding:8px 15px; font-size:18px;}
.crad-desc-friends span{color:#999;font-size:12px;}
.del_line{text-decoration:line-through}
.mui-input-group .mui-input-row{background-color:#fff!important;height:42px;}
.mui-help.mui-checkbox label, .mui-help.mui-radio label{padding-left:35px;width:50%;}
.mui-help.mui-checkbox.mui-left input[type=checkbox], .mui-help.mui-radio.mui-left input[type=radio]{left:5px;height:25px;width:50%;}
.mui-help.mui-checkbox input[type=checkbox]:before, .mui-help.mui-radio input[type=radio]:before{font-size:25px;}
.mui-help .mui-help-info{line-height:1.8;text-align:right;padding-right:15px!important;width:50%!important;}
.miu-tequan .mui-media-object{border-radius:50%;width:42px;position:relative;color:#fff}
.miu-tequan .mui-media-object.mui-ext-icon:before{left:50%;-webkit-transform:translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);}
.miu-tequan .mui-media.mui-media-object{ color:#fff}
</style>
    <div class="mui-content" style="z-index:1;background-color: #f8f9fb;">
        <div style="background:#555555;padding-top:8px;border-radius: 0 0 100% 100%;margin:0 -35% 13px -35%;overflow:hidden;">
            <div class="mui-card">
            	<div class="mui-card-header mui-card-media<?php  if($tobuy) { ?> mui-navigate-right<?php  } ?>">
                	<?php $do = $tobuy ? 'cardfriend':'card';?>
                    <?php $op = $tobuy ? 'buylist':'';?>
                	<a href="<?php echo $_W['siteroot'] . 'app/index.php?i='.$_W['uniacid'].'&c=entry&do='.$do.'&op='.$op.'&m=wnfx_activity_plugin_babycard';?>">
					<img src="<?php  echo $member['avatar'];?>">
					<div class="mui-media-body">
						<?php  echo $member['nickname'];?>
						<p style="margin-top:5px;"><?php  if($tobuy) { ?>已拥有 <?php  echo $tobuy;?> 张<?php  } else { ?>还未开通<?php  } ?></p>
                        <?php  if(!$tobuy) { ?>
                        <div style="position:absolute;right:30px;top:0px; text-align:right;">
                        	<div style="font-size:16px;">
                            	<span class="mui-small">仅需<font class="mui-rmb"></font> 
                                <?php  if($card['min_value_first']>0) { ?>
                                	<?php  echo $min_value_first;?> ~ <?php  echo $max_value;?>
                                <?php  } else { ?>
                                	<?php  echo $max_value;?>
                                <?php  } ?></span>
                            </div>
                        	<span class="mui-badge mui-badge-brown" style="padding:5px 6px;">立即开通</span>
                        </div>
                        <?php  } ?>
					</div>
                    </a>
				</div>
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                    	<div class="card-info" style="padding-top:1rem">
                            <span class="mui-ext-icon mui-icon-gouwu" style="margin:0;color:#d2b275;border-right:solid 1px #d2b275;padding-right:20px;"> 累计消费 <?php  echo sprintf("%.2f", $getFee['price'])?></span>
                            <span class="mui-ext-icon mui-icon-qian" style="margin:0;color:#d2b275;margin-left:20px;"> 为您节省 <?php  echo sprintf("%.2f", $getFee['vipdeduct'])?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-image:radial-gradient(200px at 50px 0px, #fff 50px, #4169E1 50px); position:absolute; left:0; bottom:0; right:0;"></div>
        </div>
        <div class="miu-tequan" style="background:#FFF; padding-top:10px;overflow: hidden;">
        	<div class="mui-content-padded">
        		<div style="text-align:center;">
                <p style="font-size:16px"><span class="mui-del">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $card['name'];?>特权&nbsp;&nbsp;&nbsp;&nbsp;<span class="mui-del">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
                <span class="mui-text-danger mui-small">温馨提示：<?php  echo $card['name'];?>购买后不支持退款</span>
                </div>
            </div>
            <ul class="mui-table-view mui-afterbefore-no" style="margin-top:0">
                <li class="mui-table-view-cell mui-media">
                    <a  href="javascript:;">
                    	<div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-myouhui-2" style="background:#51cec0"></div>
                        <div class="mui-media-body">
                            <p>特权1</p>
                            <span class="mui-ellipsis mui-small">超级<?php  echo $card['name'];?>活动享折上折优惠</span>
                        </div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media">
                    <a  href="javascript:;">
                    	<div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-mjifen" style="background:#24cca9"></div>
                        <div class="mui-media-body">
                            <p>特权2</p>
                            <span class="mui-ellipsis mui-small">超级<?php  echo $card['name'];?>活动消费返更多积分</span>
                        </div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media">
                    <a  href="javascript:;">
                    	<div class="mui-media-object mui-pull-left mui-ext-icon mui-icon-mhuodong" style="background:#2aacfa"></div>
                        <div class="mui-media-body">
                            <p>特权3</p>
                            <span class="mui-ellipsis mui-small">超级<?php  echo $card['name'];?>专属活动</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mui-content-padded">
        	<input type="button" name="submit" class="mui-btn mui-btn-black mui-btn-block" onclick="javascript:util.program.navigate('<?php echo $_W['siteroot'] . 'app/index.php?i='.$_W['uniacid'].'&c=entry&do=card&m=wnfx_activity_plugin_babycard'?>')" value="<?php echo $tobuy ? '继续购买':'立即购买'?><?php  echo $card['name'];?>">
        </div>
    </div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>