<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-card.mui-two:first-child{ margin-top:0px;}
.mui-card.mui-two .mui-card-header{ position:relative;}
.mui-card.mui-two .mui-card-header,.mui-card.mui-one .mui-card-footer{ background:none;}
.mui-card.mui-two .mui-card-header img:first-child{ width: 36px!important;height: 36px!important;border-radius:100px;}
.mui-card.mui-two .mui-card-header .mui-media-body{ height:36px; font-size:13px; line-height:1.8!important;overflow:hidden;margin-left:48px;}
.mui-card.mui-two .mui-card-header .mui-media-body>span{ overflow:hidden; position:relative;}
.mui-card.mui-two .mui-card-header .mui-media-body i.mui-badge{ right:0;padding:5px 10px; padding-bottom:3px;}
.mui-card.mui-two .mui-card-header .mui-media-body i.mui-badge-orange{ background:#fff!important; color:#ff6f02!important;}
.mui-card.mui-two .mui-card-header .mui-media-body i.mui-badge-orange:after{content: " ";width: 200%;height: 200%;position: absolute;top: 0;left: 0;border: 1px solid #ff6f02;box-sizing: border-box;border-radius: 100px;-webkit-transform: scale(0.5);transform: scale(0.5);-webkit-transform-origin: 0 0;transform-origin: 0 0;}
.mui-card.mui-two .mui-card-header .mui-icon-renzheng3{ width:15px; height:15px;font-size:12px;line-height:15px; text-align:center;position:absolute; top:35px;left:35px;background:#fff;border-radius: 100%; z-index:999}
.mui-card.mui-two .mui-card-header .mui-icon-renzheng3:after{ color:#ff6d1f;}
.mui-card.mui-two .mui-card-content:after{ height:0px;}
.mui-card.mui-two .mui-card-content-inner p.mui-small{ font-size:80%!important;line-height:1.5}
.mui-card.mui-two .mui-card-footer span{position:relative; width:50%; text-align:center}
.mui-card.mui-two .mui-card-footer span:after{content: " ";position: absolute;border-right: 1px solid #d3d3d3;top: 50%;right: 0;height: 120%;-webkit-transform: scaleX(0.5) translateY(-50%);transform: scaleX(0.5) translateY(-50%);-webkit-transform-origin: 0 100%;transform-origin: 0 100%;}
.mui-card.mui-two .mui-card-footer span:last-child:after{border:none}
.mui-card.mui-two .mui-card-footer span em{ font-size:12px;}
.list-content{min-height:45%;}
</style>
    <div class="mui-content">
        <div class="mui-scroll-wrapper-ext">
            <div class="mui-scroll-ext">
            	<div class="list-content">
                </div>
            </div>
        </div>
    </div>
<script>
$(function(){
	//关注
	$('.list-content').delegate('.js-follow',"tap",function(e) {
		var $this = $(this);
		util.loading();
		//console.log($(this).attr('data-follow'));
		$.post("<?php  echo app_url('member/profile/follow')?>",
		{id:$this.data('id'),muid:$this.data('muid'),follow:$this.attr('data-follow'),type:'<?php  echo $_GPC["ac"];?>',list:1},function(d){
			util.loading().close();
			if(d.result==1){
				util.tips('操作成功');
				$this.attr("data-follow",d.data);
				$this.toggleClass("mui-badge-orange");
				$this.text(d.data ? '+ 关注' : '已关注');
			}else{
				util.tips('操作失败','','error');
			}
		},"json");
	});
});
//上拉加载活动列表
var pageStart = 0,pageEnd = 0,totalpage=0,thispage = 1,thispsize = 10;
$('.mui-scroll-ext').dropload({
	scrollArea : $('.mui-scroll-wrapper-ext'),
	threshold : 50,
	loadDownFn : function(me){
		mui.getJSON("<?php  echo app_url('member/profile/list')?>", {page:thispage,psize:thispsize}, function(data){
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
					+'    <p class="hint mui-text-gray">暂无关注信息</p>'
					+'    <p class="recommend-hint"></p>'
					+'</div></div>';
				$('.mui-scroll-ext').html('');
				$('.mui-scroll-ext').append(result);
				me.resetload();
				return false;
			}
			
			for(var i = 0; i < data.list.length; i++){
				//console.log(data.list[i].id);
				
				result+='<a href="'+"<?php  echo app_url('member/profile');?>&id="+data.list[i].merchantid+'&muid='+data.list[i].muid+'">'
				+'	<div class="mui-card mui-one mui-two">'
				+'		<div class="mui-card-header mui-card-media">'
				+'			<img src="'+data.list[i].logo+'">'
				+'			'+(data.list[i].merchantid!=data.list[i].muid || data.list[i].merchantid==0 ? '<span class="mui-ext-icon mui-icon-renzheng3"></span>':'')
				+'			<div class="mui-media-body">'
				+'				<span class="mui-ellipsis">'+data.list[i].name+'</span>'
				+'				<p class="mui-small">'+data.list[i].activity+' 场活动</p>'
				+'				<i class="mui-badge mui-pull-right js-follow" data-follow="'+(data.list[i].follow?0:1)+'" data-id="'+data.list[i].merchantid+'" data-muid="'+data.list[i].muid+'" onclick="javascript:return false;">已关注</i>'
				+'			</div>'
				+'		</div>'
				+'		<div class="mui-card-content">'
				+'			<div class="mui-card-content-inner">'
				+'				<p class="mui-ellipsis-3 mui-text-gray mui-small">'+data.list[i].detail+'</p>'
				+'			</div>'
				+'		</div>'
				+'		<div class="mui-card-footer mui-small" style="display:none">'
				+'			<span class="mui-text-gray"><em>121</em> 场活动</span>'
				+'			<span class="mui-text-gray"><em>50</em> 位粉丝</span>'
				+'		</div>'
				+'	</div>'
				+'</a>';

			}
			
			$('.list-content').append(result);
			thispage++;
			// 每次数据加载完，必须重置
			me.resetload();
		});
	}
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>