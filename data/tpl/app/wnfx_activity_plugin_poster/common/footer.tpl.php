<?php defined('IN_IA') or exit('Access Denied');?><script>
$('body').delegate('a','click', function(event) {	
	if($(this).data('toggle')=='ajaxPost'){
		event.preventDefault();
		return;
	}
	
    var url = $(this).attr('href');
	if (url!=undefined && (url.indexOf('https://')>-1 || url.indexOf('http://')>-1)){
		event.preventDefault();
		util.program.navigate(url, "<?php  echo $_W['routes'];?>");
	}else{
		util.program.isMiniProgram(function(res){
			if (res) {
				if (url!='javascript:;' && url!='javascript:void(0);' && url.indexOf('tel:')<0) {
					event.preventDefault();
					if (url=='javascript:history.go(-1);') {
						wx.miniProgram.navigateBack({
							 delta: 1
						})
						return false;
					}
					if (url=='javascript:wx.closeWindow();') {
						wx.miniProgram.switchTab({
							url: '/wnfx_activity/pages/index/index'
						});
						return false;
					}
					if (url.indexOf('appid')>-1) {
						url = '/wnfx_activity/pages/navigator/index?topage='+encodeURIComponent(url);
					}
					wx.miniProgram.navigateTo({
						url: url
					})
					wx.miniProgram.switchTab({
						url: url
					});			
					return false;
				}
			}
		})			
	}		
});
<?php  if($_GPC['from']=='wxapp') { ?>
util.program.isMiniProgram(function(res){//判断是否是小程序页面的回调函数
	if (res) {
		wx.miniProgram.postMessage({
			data: wxapp_data
		})
	}
});
<?php  } ?>

//控制弹出层返回历史
$('body').delegate('.js-popover, .js-selector, .js-spec-edit, .js-form-edit, .js-popover-sub', 'tap', function(e) {
	var popover = "#"+$(this).attr('data-popover');
	location.href = location.href + popover;
});
$(".js-popover-close").on("click",function(e) {
	var popover = "#"+$(this).attr('data-popover');
	if(location.href.indexOf(popover)>-1){
		history.back(-1);
	}
});
$('body').delegate('.mui-backdrop.mui-active','tap', function(e) {
	if(location.href.indexOf('#')>-1){
		history.back(-1);
	}
});
$(window).on('popstate', function (e) {
	/// 当点击浏览器的 后退和前进按钮 时才会被触发，
	var _this = this;
	$(".mui-popover.mui-active").each(function(i){
		var popover = '#'+$(this).attr('id');	
		if(_this.location.href.indexOf(popover)==-1){
			console.log(popover);
			if ($(this).hasClass('mui-popover-sub')) {
				$(popover).removeClass('mui-active').fadeOut();
				$('body').find('.mui-backdrop-sub').remove();
			}else{
				if (popover=='#selector' && typeof init!="undefined"){
					init.selector(0);
					return;
				}
				$(popover).css('transition','');
				mui(popover).popover('hide');					
			}
		}		
	});
	if ($(".mui-editor .container").hasClass('text-editor')) {
		$('.mui-editor .container').removeClass("text-editor");
		$('html').removeClass("noscroll");
		$('footer.mui-bar').show();
	}
	if ($(".map-container").hasClass('map-active')) {
		$('.map-container').removeClass("map-active");
		$('body .mui-popup').next().remove();
		$('body .mui-popup').remove();
	}
});

$(document).ready(function() {
	$('.loader').fadeOut(150,function(){
		$(this).remove();
	});	
});
</script>
</body>
</html>