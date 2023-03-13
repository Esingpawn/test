<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-media .mui-media-body .mui-pull-right{ text-align:right;}
</style>
    <div class="mui-content">
    	<div class="mui-scroll-wrapper-ext">
            <div class="mui-scroll-ext">
                <div class="list-content">
                <ul class="mui-table-view" style=" margin:0;">
                </ul>
                </div>
            </div>
        </div>
    </div>
<script>
//上拉加载活动列表
var pageStart = 0,pageEnd = 0,totalpage=0,thispage = 1,pagesize = 15;
var counter=0;//计数器
$(".mui-content").find('.mui-scroll-ext').dropload({
	scrollArea : $(".mui-content").find('.mui-scroll-wrapper-ext'),
	threshold : 50,
	loadDownFn : function(me){
		mui.getJSON("<?php  echo app_url('commission',array('op' => 'income'), MODULE_PLUGIN_NAME)?>}",{page:thispage,pagesize:pagesize},function(data){
			var stime = new Date(),result='';
			totalpage = data.tpage;
			if (thispage > totalpage || data.tpage == 0){
				me.lock();// 锁定
				me.noData();// 无数据
			}			
			if (data.tpage == 0){
				result = '<div class="no-orders-at-all">'
				+'<div class="head-block">'
				+'    <div class="blank-icon mui-ext-icon mui-icon-mhuodong"></div>'
				+'    <p class="hint">没有提现记录</p>'
				+'    <p class="recommend-hint"></p>'
				+'</div></div>';
				$(".mui-content").find('.list-content').html('');
				$(".mui-content").find('.list-content').append(result);
				me.resetload();
				return false;
			}
			pageEnd = data.list.length <= pagesize ? data.list.length : pagesize;
			for(var i = pageStart; i < pageEnd; i++){
				//console.log(pageStart);
				var newDate = new Date();
				newDate.setTime(data.list[i].created_at * 1000);
				createtime = newDate.format('yyyy-MM-dd hh:mm:ss');
				money = ' <font class="mui-text-success">+'+data.list[i].amount+'</font>';
				result+='<li class="mui-table-view-cell mui-media">'
				+'	<a href="javascript:;">'
				+'		<div class="mui-media-body">'
				+'			<div class="mui-pull-left">'+data.list[i].type_name+'<p class="mui-small">'+createtime+'</p></div>'
				+'			<div class="mui-pull-right"><p>'+money+'</p></div>'
				+'		</div>'
				+'	</a>'
				+'</li>';
			}
			$(".mui-content").find('.list-content .mui-table-view').append(result);
			thispage++;
			// 每次数据加载完，必须重置
			me.resetload();
		});
	}
});
//格式化日期
Date.prototype.format = function(format) {
    var o = {
        "M+": this.getMonth() + 1,
        "d+": this.getDate(),
        "h+": this.getHours(),
        "m+": this.getMinutes(),
        "s+": this.getSeconds(),
        "q+": Math.floor((this.getMonth() + 3) / 3),
        "S": this.getMilliseconds()
    }
    if (/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return format;
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>