<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-card{border-radius:10px; margin-top:0px;border:none;-webkit-box-shadow: 0 2px 6px rgba(0,0,0,.1);box-shadow: 0 2px 6px rgba(0,0,0,.1);}
.mui-card .mui-card-content-inner{padding:0;}
.mui-card .mui-card-content-inner .card-info{position:absolute;background-color:#FFF;left:0;bottom:0; right:0;}
.mui-card .mui-card-content-inner .card-info .info-state{color: rgba(0,0,0,0.8);padding-left:15px; line-height:2}
.mui-card .mui-card-content-inner .card-info .info-time{padding-left:15px;color: rgba(0,0,0,0.5);font-size: 12px;padding-bottom: 5px;border-radius:0  0 8px 8px}
.mui-bar-footer {padding: 0;background: #fff;height:45px;line-height:48px}
.mui-bar-footer .mui-btn {width: 50%;height: 45px;border-radius: 0;float: right;margin: 0!important}
.crad-desc-friends{background:#FFF;margin:10px 0; padding:8px 15px; font-size:18px;}
.crad-desc-friends span{color:#999;font-size:12px;}
.mui-slider .mui-scroll-wrapper.mui-slider-indicator{width:100%;margin:auto;}
.mui-slider .mui-scroll-wrapper.mui-slider-indicator .mui-scroll{width:100%;}
.mui-slider .mui-control-item{color:#999!important;position:relative;}
.mui-slider .mui-control-item.mui-active{color:#333!important;border:none!important;}
.mui-slider .mui-control-item.mui-active:after{position:absolute;left:35px;right:35px;bottom:5px;height:2px;background-color:#EC0000;content: "";}
.mui-slider .mui-slider-group{min-height:280px;}
.mui-slider .mui-slider-group .mui-slider-item{border:none!important;padding:8px 12px;position:relative}
.mui-slider .mui-slider-group .mui-slider-item:before{position:absolute;left:0;right:0;top:0;height:1px;background-color:#e0e0e0!important;content:"";-webkit-transform: scaleY(0.5);transform: scaleY(0.5);}
.mui-input-group .mui-input-row{background-color:#fff!important;height:42px;}
.mui-help.mui-checkbox label, .mui-help.mui-radio label{padding-left:35px;width:50%;}
.mui-help.mui-checkbox.mui-left input[type=checkbox], .mui-help.mui-radio.mui-left input[type=radio]{left:5px;height:25px;width:50%;}
.mui-help.mui-checkbox input[type=checkbox]:before, .mui-help.mui-radio input[type=radio]:before{font-size:25px;}
.mui-help .mui-help-info{line-height:1.8;text-align:right;padding-right:15px!important;width:50%!important;}
</style>
    <div class="mui-content" style="z-index:1">
        <div style="background:#FFF; padding-top:8px;">
            <div class="mui-card">
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <img width="100%" height="100%" src="<?php  if($card['thumb']) { ?><?php  echo tomedia($card['thumb'])?><?php  } else { ?>../addons/wnfx_activity/web/resource/images/card/1.png<?php  } ?>">
                    	<div class="card-info">
                            <div class="info-state"><span class="js-name"><?php  echo $card['name'];?></span><?php  if($tobuy) { ?>已激活<?php  } else { ?>待激活<?php  } ?></div>
                            <div class="info-time">
                                有效期：<span class="js-start-time">自激活日算起所购卡范围内有效</span><span class="js-end-time"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="mui-table-view mui-afterbefore-no">
                <li class="mui-table-view-cell">
                会员价格
                <span id="value_info" class="mui-badge mui-badge-inverted mui-rmb <?php  if($card['value_first']['y']['1'] && !$tobuy) { ?>mui-del<?php  } else { ?>mui-text-rmb<?php  } ?>"><?php  echo $value;?> 元</span>
                </li>
                <?php  if($card['is_first'] && !$tobuy) { ?>
                <li class="mui-table-view-cell">
                    <?php  if($card['is_first_num']==1) { ?>特惠价格<?php  } else { ?>首次特惠<?php  } ?>
                    <span id="first_info" class="mui-badge mui-badge-inverted mui-rmb mui-text-rmb"><?php  echo $value_first;?> 元</span>
                </li>
                <?php  } ?>
                <li class="mui-table-view-cell mui-media">
                <a class="mui-navigate-right js-price-options" style="margin:-11px -12px">
                    购买类型
                    <span class="mui-badge mui-badge-inverted js-price"><?php echo $cycletype==3?'年卡':($cycletype==2?'季卡':'月卡')?></span>
                    <input type="hidden" value="<?php  echo $value;?>" name="value" id="value">
                    <input type="hidden" value="<?php  echo $value_first;?>" name="value_first" id="value_first">
                    <input type="hidden" value="<?php  echo $cycletype;?>" name="cycletype" id="cycletype">
                </a>
				<script type="text/javascript">
                $(".js-price-options").on("tap", function(){
                    var options = {data: [
                    <?php  if($card['value']['y']['0']) { ?>	{"text":"年卡","value":"<?php  echo $card['value']['y']['1'];?>","value_first":"<?php  echo $card['value_first']['y']['1'];?>","type":3},
                    <?php  } ?>
                    <?php  if($card['value']['q']['0']) { ?>{"text":"季卡","value":"<?php  echo $card['value']['q']['1'];?>","value_first":"<?php  echo $card['value_first']['q']['1'];?>","type":2},
                    <?php  } ?>
                    <?php  if($card['value']['m']['0']) { ?>{"text":"月卡","value":"<?php  echo $card['value']['m']['1'];?>","value_first":"<?php  echo $card['value_first']['m']['1'];?>","type":1},
                    <?php  } ?>
                    ]};
                    var $this = $(this),is_first = <?php  echo $card['is_first'];?>,is_first_num = <?php  echo $card['is_first_num'];?>, tobuy = <?php  echo $tobuy;?>;
                    util.poppicker(options, function(items){
						$this.find('.js-price').text(items[0].text);
                        $this.find('input[name="value"]').val(items[0].value);
						$this.find('input[name="value_first"]').val(items[0].value_first);
						$this.find('input[name="cycletype"]').val(items[0].type);
						$('#value_info').text(items[0].value + ' 元');
						$('#first_info').text(items[0].value_first + ' 元');
						var fee;	
						if (is_first > 0 && !tobuy){
							if (is_first_num == 1) {
								fee = items[0].value_first * $('.js-buynum').val();
							}else{
								fee = items[0].value * ($('.js-buynum').val() - 1) + Number(items[0].value_first);
							}
						}else{
							fee = items[0].value * $('.js-buynum').val();
						}
						$('#feeshow .mui-rmb').html(fee.toFixed(2));
                    });
                });
                </script>
                </li>
                <li class="mui-table-view-cell">
                购买数量
                <div class="mui-numbox mui-pull-right">
                    <button class="mui-btn mui-btn-numbox-minus" type="button">-</button>
                    <input name="buynum" class="mui-input-numbox js-buynum" type="number" value="1" pattern="[0-9]*">
                    <button class="mui-btn mui-btn-numbox-plus" type="button">+</button>
                </div>
                </li>
			</ul>
        </div>
        <?php  if($fid || $fid=='0') { ?>
        <div class="mui-input-group" style="margin-top:10px;">
            <div class="mui-input-row mui-radio mui-left mui-help">
                <label><?php echo !empty($friend['realname'])?$friend['realname']:'默认自己'?></label>
                <input name="fid" value="<?php  echo $fid;?>" type="radio" checked="checked">
                <?php  if($record['status']) { ?>
                <div class="mui-help-info <?php  if(TIMESTAMP > $record['end_time']) { ?>mui-text-orange<?php  } else { ?>mui-text-success<?php  } ?>"><?php  if(TIMESTAMP > $record['end_time']) { ?>已到期<?php  } else { ?>有效期<?php  } ?> <?php  echo date('y年m月d H:i', $record['end_time'])?></div>
                <?php  } else { ?>
                <div class="mui-help-info mui-text-orange">未开通</div>
                <?php  } ?>
            </div>
        </div>
        <?php  } ?>
        <?php  if($config['friend_enable']) { ?>
        <ul class="mui-table-view mui-table-view-chevron mui-afterbefore-no">
            <li class="mui-table-view-cell mui-media">
                <a  href="<?php  echo app_url('cardfriend', array('op' => 'display','buytype'=>1))?>" class="mui-navigate-right">
                    <div class="mui-media-body">
                        <p class="mui-text-rmb" style="margin-bottom:5px; font-size:16px;">+
                        <?php  if($fid=='') { ?>绑定亲友信息<?php  } else { ?>重新选择<?php  } ?></p>
                        <span class="mui-ellipsis">请选择要开通的<?php  echo $card['name'];?>亲友</span>
                    </div>
                </a>
            </li>
        </ul>
        <?php  } ?>
        <div id="slider" class="mui-slider" style="background:#FFF; margin-top:10px;">
            <div class="mui-scroll-wrapper mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
                <div class="mui-scroll">
                    <a class="mui-control-item mui-active" href="#item0">专属特权</a>
                    <a class="mui-control-item" href="#item1">使用须知</a>
                </div>
            </div>
			<div class="mui-slider-group">
        		<div id="item0" class="mui-slider-item mui-control-content mui-active">
                	<?php  echo $card['description'];?>
        		</div>
        		<div id="item1" class="mui-slider-item mui-control-content"><?php  echo $card['detail'];?></div>
    		</div>
        </div>
    </div>
    <div class="mui-bar mui-bar-footer">
        <p class="mui-pl15" id="feeshow" style="width:50%;display:inline-block;">合计：<span class="mui-rmb mui-big mui-text-orange">
        <?php  if($card['is_first'] && !$tobuy) { ?><?php  echo $value_first;?><?php  } else { ?><?php  echo $value;?><?php  } ?></span></p>
        <input type="hidden" id="fee" name="fee" value="<?php  if($card['value_first'] && !$tobuy) { ?><?php  echo $card['value_first'];?><?php  } else { ?><?php  echo $card['value'];?><?php  } ?>">
        <button type="button" class="mui-btn mui-btn-orange mui-btn-block" onclick="payAction(<?php  echo $fid;?>)">立即开卡</button>
    </div>
    <?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('member/setting', TEMPLATE_INCLUDEPATH)) : (include fx_template('member/setting', TEMPLATE_INCLUDEPATH));?>
	<script>
    $(function(){
        //屏蔽slider选项卡弹出遮罩
        $('.mui-slider .mui-control-item').on('tap',function(e) {
            setTimeout(function(){
                $('.mui-backdrop').remove();
                $("body").css('overflow','');
                $('.mui-content').css('overflow','');
            });
            $("body").addClass('mui-backdrop-none');
        });
        //输入数量控制
        $("input.js-buynum").bind('input propertychange, change', function(e) {
            e.stopPropagation();
            var fee=0, value = Number($('#value').val()), value_first = Number($('#value_first').val()), is_first = <?php  echo $card['is_first'];?>,is_first_num = <?php  echo $card['is_first_num'];?>, tobuy = <?php  echo $tobuy;?>;
            if ($(this).val() <= 0){
                $(this).val(1);
            }
            
            if (is_first > 0 && !tobuy){
                if (is_first_num == 1) {
                    fee = value_first * $(this).val();
                }else{
                    fee = value * ($(this).val() - 1) + value_first;
                    if ($(this).val()>1){
                        $('#value_info').removeClass('mui-del').addClass('mui-text-rmb');
                        $('#first_info').addClass('mui-del').removeClass('mui-text-rmb');
                    }else{
                        $('#value_info').addClass('mui-del').removeClass('mui-text-rmb');
                        $('#first_info').removeClass('mui-del').addClass('mui-text-rmb');					
                    }
                }
            }else{
                fee = value * $(this).val();
            }
            $('#feeshow .mui-rmb').html(fee.toFixed(2));
    
        });
    });
    function payAction(fid) {
        var buynum = parseInt($(".js-buynum").val()),
            cycletype = parseInt($("#cycletype").val());
        <?php  if($config['friend_enable'] && $fid=='') { ?>
        util.tips('请选择亲友！');
        return false;
        <?php  } ?>
        util.program.navigate("<?php  echo app_url('cardrecord', array('op' => 'display','buytype'=>1,'fid'=>$fid))?>" + "&buynum=" + buynum + "&cycletype=" + cycletype);
    }
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>