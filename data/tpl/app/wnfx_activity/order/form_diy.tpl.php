<?php defined('IN_IA') or exit('Access Denied');?><input name="form_id_<?php  echo $ii;?>[]" type="hidden" class="form-control" value="<?php  echo $form['id'];?>"/>
<?php  if($form['displaytype']==0) { ?>
    <h5 class="mui-desc-title mui-pl15">请选择<?php  echo $form['title'];?><?php echo empty($form['description']) ?'':'【'.$form['description'].'】'?><?php  if($form['essential']==1) { ?> <span class="mui-text-error"> *</span><?php  } ?></h5>
    <?php  if(is_array($form['items'])) { foreach($form['items'] as $formitem) { ?>
    <div class="mui-input-row mui-radio">
        <label><?php  echo $formitem['title'];?></label>
        <input name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" type="radio" value="<?php  echo $formitem['title'];?>">
    </div>
    <?php  } } ?>
    <p></p>
<?php  } else if($form['displaytype']==1) { ?>
    <h5 class="mui-desc-title mui-pl15">请选择<?php  echo $form['title'];?><?php echo empty($form['description']) ?'':'【'.$form['description'].'】'?>(可多选)<?php  if($form['essential']==1) { ?> <span class="mui-text-error"> *</span><?php  } ?></h5>
    <?php  if(is_array($form['items'])) { foreach($form['items'] as $formitem) { ?>
    <div class="mui-input-row mui-checkbox">
        <label><?php  echo $formitem['title'];?></label>
        <input name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>[]" value="<?php  echo $formitem['title'];?>" type="checkbox">
    </div>
    <?php  } } ?>
    <p></p>
<?php  } else if($form['displaytype']==2) { ?>
    <div class="mui-input-row">
    <label><?php  echo $form['title'];?></label>
    <input class="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" type="text" value="" readonly placeholder="<?php echo empty($form['description'])?'请选择'.$form['title']:$form['description']?><?php  if($form['essential']==1) { ?> (必选)<?php  } ?>">
    <script type="text/javascript">
    $(".form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>").on("tap", function(){
		var $this = $(this), layer = <?php echo m('common')->arrayLevel($form['options'])==2?1:2?>, options = {data: <?php  echo json_encode($form['options'])?>,layer:layer};
        util.poppicker(options, function(items){
			if (layer==2)
            	$this.val(items[1].value!=undefined ? items[0].value+", "+items[1].value : items[0].value);
			else
				$this.val(items[0].value);
        });
    });
    </script>
    </div>
<?php  } else if($form['displaytype']==3) { ?>
    <div class="mui-input-row">
        <label><?php  echo $form['title'];?></label>
        <input name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" value="" type="text"  placeholder="<?php echo empty($form['description'])?'请输入'.$form['title']:$form['description']?><?php echo  $form['essential']==1?' (必填)':''?>">
    </div>
<?php  } else if($form['displaytype']==4) { ?>
    <div class="mui-input-row">
        <label><?php  echo $form['title'];?></label>
        <input name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" value="" type="number"  placeholder="<?php echo empty($form['description'])?'请输入'.$form['title']:$form['description']?><?php  if($form['essential']==1) { ?> (必填)<?php  } ?>" pattern="[0-9]*">
    </div>
<?php  } else if($form['displaytype']==5) { ?>
    <p></p>
    <div class="mui-input-cell mui-after-no">
        <div class="mui-table-view-chevron">
            <div class="mui-image-uploader">
                <div class="mui-image-preview js-image-preview-<?php  echo $key;?>-<?php  echo $ii;?>">
                    <div class="file-item js-thumb" data-id="" style="display:none;">
                    <img src="<?php echo FX_URL;?>app/resource/images/nopic.jpg" data-preview-src="" data-preview-group="__IMG_UPLOAD_pic"/>
                    <input type="hidden" value="" id="pic<?php  echo $key;?><?php  echo $ii;?>" name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" />
                    <div class="file-panel"><span>×</span></div>
                    </div>
                </div>
                <a href="javascript:;" class="mui-upload-btn js-image-pic-<?php  echo $key;?>-<?php  echo $ii;?> mui-inline"></a>
            </div>
            <div style="padding:0 15px;text-align:right"><h5 class="mui-small"><?php  echo $placeholder;?></h5></div>
            <script>
                util.img(".js-image-pic-<?php  echo $key;?>-<?php  echo $ii;?>", function(data){
					var _this = ".js-image-pic-<?php  echo $key;?>-<?php  echo $ii;?>";
                    $(_this).parent().find('.js-image-preview-<?php  echo $key;?>-<?php  echo $ii;?>').find('#pic<?php  echo $key;?><?php  echo $ii;?>').val(data.attachment);
                    $(_this).parent().find('.js-image-preview-<?php  echo $key;?>-<?php  echo $ii;?>').find('img').attr("src",data.url);                    
                    $(_this).parent().find('.js-image-preview-<?php  echo $key;?>-<?php  echo $ii;?>').find('img').attr("data-preview-src",data.url);
					$(_this).parent().find('.js-image-preview-<?php  echo $key;?>-<?php  echo $ii;?>').find('.js-thumb').attr("data-id",data.id);
                    $(_this).parent().find('.js-image-preview-<?php  echo $key;?>-<?php  echo $ii;?>').find('.js-thumb').show();
                    $("input[name='token']"). val(data.token);
                }, {
                    crop : true,
                    multiple : false,
                    preview : '__IMG_UPLOAD_pic',
                    pxSize : <?php echo intval($_W['_config']['image']['pxsize'])>0?$_W['_config']['image']['pxsize']:640?>,
                    aspectRatio:<?php  echo $_W['_config']['image']['ratio'];?>,
                    resizable:1
                });
                setTimeout(function(){
                   $(".js-image-pic-<?php  echo $key;?>-<?php  echo $ii;?>").append('<div class="btn-intro" style="position:absolute;color:#d7d7d7;top:54px;line-height: 1.2; left:0; right:0;"><span<?php  if($form['essential']==1) { ?> class="must"<?php  } ?>>上传单图</span></div>')
                },1000);
            </script>
        </div>
    </div>
    <p></p>
<?php  } else if($form['displaytype']==6) { ?>
    <p></p>
    <div class="mui-input-cell mui-after-no">
        <div class="mui-table-view-chevron">
            <div class="mui-image-uploader">
                <div class="mui-image-preview js-image-nopic mui-pull-left" style="display:none">
                    <img src="<?php echo FX_URL;?>app/resource/images/nopic.jpg"/>
                </div>
                <div class="mui-image-preview js-image-preview-<?php  echo $key;?>-<?php  echo $ii;?>"></div>
                <a href="javascript:;" class="mui-upload-btn js-image-pic-<?php  echo $key;?>-<?php  echo $ii;?> mui-inline"></a>
            </div>
            <div style="padding:0 15px;text-align:right"><h5 class="mui-small"><?php  echo $placeholder;?></h5></div>
            <script>
                util.img(".js-image-pic-<?php  echo $key;?>-<?php  echo $ii;?>", function(data){
					var _this = ".js-image-pic-<?php  echo $key;?>-<?php  echo $ii;?>";
                    $(_this).parent().find('.js-image-preview-<?php  echo $key;?>-<?php  echo $ii;?>').append('<div class="file-item js-thumb-item" data-id="'+data.id+'"><input type="hidden" value="'+data.attachment+'" name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>[]" /><img src="'+data.url+'" data-preview-src="" data-preview-group="__IMG_UPLOAD_image" /><div class="file-panel"><span>×</span></div></div>');
                    $(".js-image-nopic").hide();
                    $("input[name='token']"). val(data.token);
                }, {
                    crop : true,
                    multiple : true,
                    preview : '__IMG_UPLOAD_pic',
                    pxSize : <?php echo intval($_W['_config']['image']['pxsize'])>0?$_W['_config']['image']['pxsize']:640?>,
                    aspectRatio:<?php  echo $_W['_config']['image']['ratio'];?>,
                    resizable:1
                });
                setTimeout(function(){
                   $(".js-image-pic-<?php  echo $key;?>-<?php  echo $ii;?>").append('<div class="btn-intro" style="position:absolute;color:#d7d7d7;top:54px;line-height: 1.2; left:0; right:0;"><span<?php  if($form['essential']==1) { ?> class="must"<?php  } ?>>上传多图</span></div>')
                },1000);
            </script>
        </div>
    </div>
    <p></p>
<?php  } else if($form['displaytype']==7) { ?>
    <div class="mui-input-row">
        <label><?php  echo $form['title'];?></label>
        <input class="mui-calendar-picker-<?php  echo $key;?>-<?php  echo $ii;?>" type="text" placeholder="<?php echo empty($form['description'])?'请选择'.$form['title']:$form['description']?><?php  if($form['essential']==1) { ?> (必选)<?php  } ?>" readonly value="" name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" />
        <script type="text/javascript">
            $(document).on("tap", ".mui-calendar-picker-<?php  echo $key;?>-<?php  echo $ii;?>", function(){
                var $this = $(this);
                util.datepicker({
                    type: "datetime", 
                    beginYear: 1900, 
                    endYear: 2060
                }, function(rs){
                    $this.val(rs.value).next().val(rs.value);
                });
            });
        </script>
    </div>
<?php  } else if($form['displaytype']==8) { ?>
    <div class="mui-input-row">
        <label><?php  echo $form['title'];?></label>
        <?php  echo _tpl_app_form_field_district('form_item_val_'.$key.'_'.$ii, array('province' => '', 'city' => '', 'district' => ''), $placeholder);?>
    </div>
<?php  } else if($form['displaytype']==9) { ?>
    <p></p>
    <div style="background:#FFF;overflow:hidden">
        <div class="mui-content-padded">
            <textarea name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" placeholder="<?php echo empty($form['description'])?'请输入'.$form['title']:$form['description']?><?php  if($form['essential']==1) { ?> (必填)<?php  } ?>" style="padding:3px;"></textarea>
        </div>
    </div>
    <p></p>
<?php  } else if($form['displaytype']==10) { ?>
    <div class="mui-input-row mobiles" title="<?php  echo $form['title'];?>">
        <label><?php  echo $form['title'];?></label>
        <input name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" value="" type="text"  placeholder="<?php echo empty($form['description'])?'请输入'.$form['title']:$form['description']?><?php  if($form['essential']==1) { ?> (必填)<?php  } ?>">
    </div>
<?php  } else if($form['displaytype']==11) { ?>
    <div class="mui-input-row">
        <label><?php  echo $form['title'];?></label>        
        <?php  echo _tpl_app_form_field_calendar('form_item_val_'.$key.'_'.$ii, array('year' => '', 'month' => '', 'day' => ''), $placeholder);?>
    </div>
<?php  } else if($form['displaytype']==12) { ?>
    <p></p>
    <div class="mui-input-cell mui-after-no">
        <div class="mui-table-view-chevron">
            <div class="mui-image-uploader">
                <div class="mui-image-preview js-video-preview-<?php  echo $key;?>-<?php  echo $ii;?>">
                    <div class="file-item js-video" data-id="" style="display:none;">
                    <img src="<?php echo FX_URL;?>app/resource/images/video.png"/>
                    <input type="hidden" value="" id="video<?php  echo $key;?><?php  echo $ii;?>" name="form_item_val_<?php  echo $key;?>_<?php  echo $ii;?>" />
                    <div class="file-panel"><span>×</span></div>
                    </div>
                </div>
                <a href="javascript:;" class="mui-upload-btn js-video-<?php  echo $key;?>-<?php  echo $ii;?> mui-inline"></a>
            </div>
            <div style="padding:0 15px;text-align:right"><h5 class="mui-small"><?php  echo $placeholder;?></h5></div>
            <script>
                util.video(".js-video-<?php  echo $key;?>-<?php  echo $ii;?>", function(data){
					var _this = ".js-video-<?php  echo $key;?>-<?php  echo $ii;?>";
                    $(_this).parent().find('.js-video-preview-<?php  echo $key;?>-<?php  echo $ii;?>').find('.js-video').attr("data-id",data.id);
					$(_this).parent().find('.js-video-preview-<?php  echo $key;?>-<?php  echo $ii;?>').find('.js-video').fadeTo(500,1);
					$(_this).parent().find('.js-video-preview-<?php  echo $key;?>-<?php  echo $ii;?>').find('#video<?php  echo $key;?><?php  echo $ii;?>').val(data.attachment);                   
                    $("input[name='token']"). val(data.token);
                }, {
					fileSize: <?php  echo $_W['setting']['upload']['audio']['limit'];?>
				});
                setTimeout(function(){
                   $(".js-video-<?php  echo $key;?>-<?php  echo $ii;?>").append('<div class="btn-intro" style="position:absolute;color:#d7d7d7;top:54px;line-height: 1.2; left:0; right:0;"><span<?php  if($form['essential']==1) { ?> class="must"<?php  } ?>>上传视频</span></div>')
                },1000);
            </script>
        </div>
    </div>
    <p></p>
<?php  } ?>