typeof baidu!='undefined' && baidu.template && ( baidu.template.LEFT_DELIMITER='<@', baidu.template.RIGHT_DELIMITER='@>');
var wxf=wxf || {
        tpl:typeof baidu!='undefined'?baidu.template:null
    };

//加载提示
var $wraper='', $loading='';
var waterfall = function (e){
	//模拟加载条数
	var loaded=true, a = {
		lock:function(e){
			loaded=true;
			this.end();
		},
		noData:function(e){
			$wraper.find('.loading span').text('~~ 暂无数据 ~~');
		},
		resetload:function(e){
			$loading.hide();
			loaded=false;
		},
		location:function(e){
			imgLocation();
		},
		end:function(e){
			$wraper.find('.loading span').text('~~ 我是有底线的 ~~');
		}
	}
	$wraper = e.wraper;
	$loading = e.wraper.find('.loading');	
	$loading.show();
	if ($.isFunction(e.loadDown)) {
		e.loadDown(a);
	}
	wraperTop = $wraper.offset().top;
	$(e.scrollArea).on("scroll",function(){
		$wraper = $(this).find('.wraper');
		$loading = $(this).find('.loading');
		$loading.show();
		
		//console.log(wraperTop);
		if(!loaded){
			if (scrollside(e.scrollArea, wraperTop)){
				loaded=true;
				e.loadDown(a);
			}
		}
	});
	
}


//摆放box位置
function imgLocation(){
    var box=$wraper.find('.box');                                         //盒子
    //var boxWidth=box.eq(0).width();                            //获取瀑布流每个图片盒子宽度,以第一个为例
    //var num=Math.floor($(document).width()/boxWidth);      //每排图片盒子数量
    var num=2;      //每排图片盒子数量
    var boxArr=[];                                             //空数组
    box.each(function(index,value){                            //循环盒子
        var boxHeight=box.eq(index).height();                  //当前盒子高度
        if(index<num){                                         //循环第一排盒子
            boxArr[index]=boxHeight;                           //将第一排盒子高度放入数组
        }else{
            var boxMinHeight=Math.min.apply(null,boxArr);      //将第一排盒子的高度放入数组后,计算数组里最小的高度
            var minboxIndex=$.inArray(boxMinHeight,boxArr);    //获取数组里最小的高度对应的索引值即box的index
            $(value).css({                                     //设置后面每个img盒子插入的位置
                'position':'absolute',
                'top':boxMinHeight+12+'px',
                'left':box.eq(minboxIndex).position().left+'px'
            });
            boxArr[minboxIndex]+=box.eq(index).height()+12;       //插入到位置后,更新当前位置的高度
        }
    });

    var lastboxheight=Math.max.apply(null,boxArr);
    $wraper.height(lastboxheight);
}

$(window).resize(function(){
    //$("#container").find('img').width(Math.floor((document.body.clientWidth-42-12)/2)-22);
    imgLocation();
});



//滚动加载
function scrollside(scrollArea, wraperTop){
    var box=$(scrollArea).find('.box');
    var lastboxheight=box.last().get(0).offsetTop + Math.floor(box.last().height()/2);
    var documentheight=$(scrollArea).height();
    var scrolltop=$(scrollArea).scrollTop();
    return (lastboxheight + wraperTop <scrolltop+documentheight)?true:false;
}

