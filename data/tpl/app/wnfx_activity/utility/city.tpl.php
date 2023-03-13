<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/header', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.mui-toast-container{top:30%;}
.noscroll,.noscroll body,.noscroll .mui-content,.noscroll .mui-indexed-list{position:relative;overflow:hidden!important;}
.mui-indexed-list-bar a{text-align:right;height:21.2692px;line-height:21.2692px;}
.mui-table-view-cell{overflow:hidden!important}
.mui-icon-dingwei:before,.mui-icon-dingwei p:last-child{color:#008fe0}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo FX_URL;?>app/resource/components/mui/mui.indexedlist.css?v=2018010702">
<script type="text/javascript" src="<?php echo FX_URL;?>app/resource/components/mui/mui.indexedlist.js?v=20180109"></script>

<div class="mui-content">
    <div id="list" class="mui-indexed-list" style="height:100%;position:relative;">
        <div class="mui-indexed-list-search mui-input-row mui-search">
            <input type="search" class="mui-input-clear mui-indexed-list-search-input" placeholder="" data-input-clear="1" data-input-search="1">
            <span class="mui-icon mui-icon-clear mui-hidden"></span>
            <span class="mui-placeholder"><span class="mui-icon mui-icon-search"></span><span>输入城市名称</span></span>
        </div>
        <div class="mui-indexed-list-bar" style="height:560px;">
            <a>~</a>
            <a>热</a>
            <a>A</a>
            <a>B</a>
            <a>C</a>
            <a>D</a>
            <a>E</a>
            <a>F</a>
            <a>G</a>
            <a>H</a>
            <a>I</a>
            <a>J</a>
            <a>K</a>
            <a>L</a>
            <a>M</a>
            <a>N</a>
            <a>O</a>
            <a>P</a>
            <a>Q</a>
            <a>R</a>
            <a>S</a>
            <a>T</a>
            <a>U</a>
            <a>V</a>
            <a>W</a>
            <a>X</a>
            <a>Y</a>
            <a>Z</a>
        </div>
        <div class="mui-indexed-list-alert"></div>
        <div class="mui-indexed-list-inner" style="height:560px;position:relative;z-index:1;">
        	<div class="mui-indexed-list-empty-alert">没有数据</div>
            <ul class="mui-table-view" style="margin-top:0;">
                <li class="mui-table-view-divider mui-indexed-list-group" style="line-height:30px;padding-right:23px;">当前定位</li>
                <li class="mui-table-view-cell mui-ext-icon mui-icon-dingwei" id="address"><p class="mui-pull-left mui-ellipsis-2 mui-pl20 add" style="width:75%"></p><p class="mui-pull-right" style="margin-right:20px;">重新定位</p></li>
                <li data-group="~" class="mui-table-view-divider mui-indexed-list-group" style="line-height:30px;padding-right:23px;">当前城市</li>
                <li class="mui-table-view-cell mui-indexed-list-item" style="padding-bottom:2px;"><span id="city1" class="city mui-ellipsis">徐州</span><span>全国</span></li>
                <li class="mui-table-view-divider mui-indexed-list-group" style="line-height:30px;padding-right:23px;">当前访问</li>
                <li class="mui-table-view-cell mui-indexed-list-item active" style="padding-bottom:2px;"><span id="city2" class="city mui-ellipsis">徐州</span></li>
                <li data-group="热" class="mui-table-view-divider mui-indexed-list-group" style="line-height:30px;padding-right:23px;">热门城市</li>
                <li class="mui-table-view-cell mui-indexed-list-item" style="padding-bottom:2px;">
                	<span>北京</span>
                    <span>上海</span>
                    <span>深圳</span>
                    <span>苏州</span>
                    <span>广州</span>
                    <span>杭州</span>
                    <span>郑州</span>
                    <span>西安</span>
                    <span>南京</span>
                    <span>武汉</span>
                </li>
				<li data-group="A" class="mui-table-view-divider mui-indexed-list-group">A</li>
                <li data-value="as" data-tags="anshan" class="mui-table-view-cell mui-indexed-list-item">鞍山</li>
                <li data-value="aq" data-tags="anqing" class="mui-table-view-cell mui-indexed-list-item">安庆</li>
                <li data-value="ay" data-tags="anyang" class="mui-table-view-cell mui-indexed-list-item">安阳</li>
                <li data-value="as" data-tags="anshun" class="mui-table-view-cell mui-indexed-list-item">安顺</li>
                <li data-value="ak" data-tags="ankang" class="mui-table-view-cell mui-indexed-list-item">安康</li>
                <li data-value="aq" data-tags="anqiu" class="mui-table-view-cell mui-indexed-list-item">安丘</li>
                <li data-value="alsm" data-tags="alashanmeng" class="mui-table-view-cell mui-indexed-list-item">阿拉善盟</li>
                <li data-value="aks" data-tags="akesu" class="mui-table-view-cell mui-indexed-list-item">阿克苏</li>
                <li data-value="aj" data-tags="anji" class="mui-table-view-cell mui-indexed-list-item">安吉</li>
                <li data-value="ay" data-tags="anyue" class="mui-table-view-cell mui-indexed-list-item">安岳</li>
                <li data-value="ap" data-tags="anping" class="mui-table-view-cell mui-indexed-list-item">安平</li>
                <li data-value="ax" data-tags="anxi" class="mui-table-view-cell mui-indexed-list-item">安溪</li>
                <li data-value="an" data-tags="anning" class="mui-table-view-cell mui-indexed-list-item">安宁</li>
                <li data-value="ah" data-tags="anhua" class="mui-table-view-cell mui-indexed-list-item">安化</li>
                <li data-value="ale" data-tags="alaer" class="mui-table-view-cell mui-indexed-list-item">阿拉尔</li>
                <li data-value="af" data-tags="anfu" class="mui-table-view-cell mui-indexed-list-item">安福</li>
                <li data-value="alts" data-tags="aletaishi" class="mui-table-view-cell mui-indexed-list-item">阿勒泰市</li>
                <li data-value="atss" data-tags="atushishi" class="mui-table-view-cell mui-indexed-list-item">阿图什市</li>
                <li data-value="azq" data-tags="anzhouqu" class="mui-table-view-cell mui-indexed-list-item">安州区</li>
                <li data-value="arq" data-tags="arongqi" class="mui-table-view-cell mui-indexed-list-item">阿荣旗</li>
                <li data-value="als" data-tags="anlushi" class="mui-table-view-cell mui-indexed-list-item">安陆市</li>
                <li data-value="ab" data-tags="aba" class="mui-table-view-cell mui-indexed-list-item">阿坝</li>
                <li data-value="al" data-tags="ali" class="mui-table-view-cell mui-indexed-list-item">阿里</li>
                <li data-value="alt" data-tags="aletai" class="mui-table-view-cell mui-indexed-list-item">阿勒泰</li>
                <li data-value="am" data-tags="aomen" class="mui-table-view-cell mui-indexed-list-item">澳门</li>
                <li data-group="B" class="mui-table-view-divider mui-indexed-list-group">B</li>
                <li data-value="bj" data-tags="beijing" class="mui-table-view-cell mui-indexed-list-item">北京</li>
                <li data-value="bd" data-tags="baoding" class="mui-table-view-cell mui-indexed-list-item">保定</li>
                <li data-value="bt" data-tags="baotou" class="mui-table-view-cell mui-indexed-list-item">包头</li>
                <li data-value="bb" data-tags="bengbu" class="mui-table-view-cell mui-indexed-list-item">蚌埠</li>
                <li data-value="bz" data-tags="bozhou" class="mui-table-view-cell mui-indexed-list-item">亳州</li>
                <li data-value="bz" data-tags="binzhou" class="mui-table-view-cell mui-indexed-list-item">滨州</li>
                <li data-value="bj" data-tags="baoji" class="mui-table-view-cell mui-indexed-list-item">宝鸡</li>
                <li data-value="byne" data-tags="bayannaoer" class="mui-table-view-cell mui-indexed-list-item">巴彦淖尔</li>
                <li data-value="bx" data-tags="benxi" class="mui-table-view-cell mui-indexed-list-item">本溪</li>
                <li data-value="bs" data-tags="baishan" class="mui-table-view-cell mui-indexed-list-item">白山</li>
                <li data-value="bc" data-tags="baicheng" class="mui-table-view-cell mui-indexed-list-item">白城</li>
                <li data-value="bh" data-tags="beihai" class="mui-table-view-cell mui-indexed-list-item">北海</li>
                <li data-value="bs" data-tags="baise" class="mui-table-view-cell mui-indexed-list-item">百色</li>
                <li data-value="bz" data-tags="bazhong" class="mui-table-view-cell mui-indexed-list-item">巴中</li>                
                <li data-value="bz" data-tags="bazhou" class="mui-table-view-cell mui-indexed-list-item">霸州</li>
                <li data-value="bj" data-tags="bijiediqu" class="mui-table-view-cell mui-indexed-list-item">毕节</li>
                <li data-value="bs" data-tags="baoshan" class="mui-table-view-cell mui-indexed-list-item">保山</li>
                <li data-value="by" data-tags="baiyin" class="mui-table-view-cell mui-indexed-list-item">白银</li>
                <li data-value="by" data-tags="baoying" class="mui-table-view-cell mui-indexed-list-item">宝应</li>
                <li data-value="bl" data-tags="beiliu" class="mui-table-view-cell mui-indexed-list-item">北流</li>
                <li data-value="ba" data-tags="boai" class="mui-table-view-cell mui-indexed-list-item">博爱</li>
                <li data-value="bf" data-tags="baofeng" class="mui-table-view-cell mui-indexed-list-item">宝丰</li>
                <li data-value="bx" data-tags="boxing" class="mui-table-view-cell mui-indexed-list-item">博兴</li>
                <li data-value="by" data-tags="biyang" class="mui-table-view-cell mui-indexed-list-item">泌阳</li>
                <li data-value="bx" data-tags="binxian" class="mui-table-view-cell mui-indexed-list-item">彬县</li>
                <li data-value="bs" data-tags="bishan" class="mui-table-view-cell mui-indexed-list-item">璧山</li>
                <li data-value="bs" data-tags="boshan" class="mui-table-view-cell mui-indexed-list-item">博山</li>
                <li data-value="by" data-tags="binyang" class="mui-table-view-cell mui-indexed-list-item">宾阳</li>
                <li data-value="bts" data-tags="botoushi" class="mui-table-view-cell mui-indexed-list-item">泊头市</li>
                <li data-value="blx" data-tags="boluoxian" class="mui-table-view-cell mui-indexed-list-item">博罗县</li>
                <li data-value="bbx" data-tags="bobaixian" class="mui-table-view-cell mui-indexed-list-item">博白县</li>
                <li data-value="bzs" data-tags="beizhenshi" class="mui-table-view-cell mui-indexed-list-item">北镇市</li>
                <li data-value="bas" data-tags="beianshi" class="mui-table-view-cell mui-indexed-list-item">北安市</li>
                <li data-value="byx" data-tags="bayanxian" class="mui-table-view-cell mui-indexed-list-item">巴彦县</li>
                <li data-value="bcx" data-tags="bachuxian" class="mui-table-view-cell mui-indexed-list-item">巴楚县</li>
                <li data-value="betl" data-tags="boertala" class="mui-table-view-cell mui-indexed-list-item">博尔塔拉</li>
                <li data-value="bz" data-tags="bazhou" class="mui-table-view-cell mui-indexed-list-item">巴州</li>
                <li data-value="bh" data-tags="binhai" class="mui-table-view-cell mui-indexed-list-item">滨海</li>
                <li data-value="bp" data-tags="beipei" class="mui-table-view-cell mui-indexed-list-item">北碚</li>
                <li data-group="C" class="mui-table-view-divider mui-indexed-list-group">C</li>
                <li data-value="cq" data-tags="chongqing" class="mui-table-view-cell mui-indexed-list-item">重庆</li>
                <li data-value="cd" data-tags="chengdu" class="mui-table-view-cell mui-indexed-list-item">成都</li>
                <li data-value="cs" data-tags="changsha" class="mui-table-view-cell mui-indexed-list-item">长沙</li>
                <li data-value="cz" data-tags="changzhou" class="mui-table-view-cell mui-indexed-list-item">常州</li>
                <li data-value="cc" data-tags="changchun" class="mui-table-view-cell mui-indexed-list-item">长春</li>
                <li data-value="cd" data-tags="chengde" class="mui-table-view-cell mui-indexed-list-item">承德</li>
                <li data-value="cz" data-tags="cangzhou" class="mui-table-view-cell mui-indexed-list-item">沧州</li>
                <li data-value="cz" data-tags="changzhi" class="mui-table-view-cell mui-indexed-list-item">长治</li>
                <li data-value="cf" data-tags="chifeng" class="mui-table-view-cell mui-indexed-list-item">赤峰</li>
                <li data-value="cz" data-tags="chuzhou" class="mui-table-view-cell mui-indexed-list-item">滁州</li>
                <li data-value="cd" data-tags="changde" class="mui-table-view-cell mui-indexed-list-item">常德</li>
                <li data-value="cz" data-tags="chenzhou" class="mui-table-view-cell mui-indexed-list-item">郴州</li>
                <li data-value="cs" data-tags="changshu" class="mui-table-view-cell mui-indexed-list-item">常熟</li>
                <li data-value="cx" data-tags="cixi" class="mui-table-view-cell mui-indexed-list-item">慈溪</li>
                <li data-value="cy" data-tags="chaoyang" class="mui-table-view-cell mui-indexed-list-item">朝阳</li>
                <li data-value="ch" data-tags="chaohu" class="mui-table-view-cell mui-indexed-list-item">巢湖</li>
                <li data-value="cz" data-tags="chizhou" class="mui-table-view-cell mui-indexed-list-item">池州</li>
                <li data-value="cz" data-tags="chaozhou" class="mui-table-view-cell mui-indexed-list-item">潮州</li>
                <li data-value="ch" data-tags="conghua" class="mui-table-view-cell mui-indexed-list-item">从化</li>
                <li data-value="cx" data-tags="changxing" class="mui-table-view-cell mui-indexed-list-item">长兴</li>
                <li data-value="cy" data-tags="changyi" class="mui-table-view-cell mui-indexed-list-item">昌邑</li>
                <li data-value="cn" data-tags="cangnan" class="mui-table-view-cell mui-indexed-list-item">苍南</li>
                <li data-value="cg" data-tags="changge" class="mui-table-view-cell mui-indexed-list-item">长葛</li>
                <li data-value="cz" data-tags="chongzuo" class="mui-table-view-cell mui-indexed-list-item">崇左</li>
                <li data-value="cx" data-tags="chuxiong" class="mui-table-view-cell mui-indexed-list-item">楚雄</li>
                <li data-value="cj" data-tags="changji" class="mui-table-view-cell mui-indexed-list-item">昌吉</li>
                <li data-value="cl" data-tags="changle" class="mui-table-view-cell mui-indexed-list-item">长乐</li>
                <li data-value="cz" data-tags="chongzhou" class="mui-table-view-cell mui-indexed-list-item">崇州</li>
                <li data-value="cb" data-tags="chibi" class="mui-table-view-cell mui-indexed-list-item">赤壁</li>
                <li data-value="ca" data-tags="chunan" class="mui-table-view-cell mui-indexed-list-item">淳安</li>
                <li data-value="cdx" data-tags="chengdexian" class="mui-table-view-cell mui-indexed-list-item">承德县</li>
                <li data-value="cl" data-tags="changlecl" class="mui-table-view-cell mui-indexed-list-item">昌乐</li>
                <li data-value="cfd" data-tags="caofeidian" class="mui-table-view-cell mui-indexed-list-item">曹妃甸</li>
                <li data-value="cx" data-tags="cixian" class="mui-table-view-cell mui-indexed-list-item">磁县</li>
                <li data-value="cy" data-tags="changyuan" class="mui-table-view-cell mui-indexed-list-item">长垣</li>
                <li data-value="ca" data-tags="chengan" class="mui-table-view-cell mui-indexed-list-item">成安</li>
                <li data-value="cl" data-tags="changli" class="mui-table-view-cell mui-indexed-list-item">昌黎</li>
                <li data-value="cx" data-tags="cenxi" class="mui-table-view-cell mui-indexed-list-item">岑溪</li>
                <li data-value="cp" data-tags="chiping" class="mui-table-view-cell mui-indexed-list-item">茌平</li>
                <li data-value="cp" data-tags="changpingzhen" class="mui-table-view-cell mui-indexed-list-item">常平</li>
                <li data-value="cx" data-tags="caoxian" class="mui-table-view-cell mui-indexed-list-item">曹县</li>
                <li data-value="cg" data-tags="chenggu" class="mui-table-view-cell mui-indexed-list-item">城固</li>
                <li data-value="ct" data-tags="changting" class="mui-table-view-cell mui-indexed-list-item">长汀</li>
                <li data-value="ca" data-tags="chaoan" class="mui-table-view-cell mui-indexed-list-item">潮安</li>
                <li data-value="cs" data-tags="changshou" class="mui-table-view-cell mui-indexed-list-item">长寿</li>
                <li data-value="cs" data-tags="changshan" class="mui-table-view-cell mui-indexed-list-item">常山</li>
                <li data-value="cs" data-tags="chishui" class="mui-table-view-cell mui-indexed-list-item">赤水</li>
                <li data-value="cl" data-tags="cili" class="mui-table-view-cell mui-indexed-list-item">慈利</li>
                <li data-value="cns" data-tags="changningshi" class="mui-table-view-cell mui-indexed-list-item">常宁市</li>
                <li data-value="cl" data-tags="chalingxian" class="mui-table-view-cell mui-indexed-list-item">茶陵</li>
                <li data-value="cfx" data-tags="changfengxian" class="mui-table-view-cell mui-indexed-list-item">长丰县</li>
                <li data-value="cxx" data-tags="cangxixian" class="mui-table-view-cell mui-indexed-list-item">苍溪县</li>
                <li data-value="cqq" data-tags="changqingqu" class="mui-table-view-cell mui-indexed-list-item">长清区</li>
                <li data-value="cmq" data-tags="chongmingqu" class="mui-table-view-cell mui-indexed-list-item">崇明区</li>
                <li data-value="cwx" data-tags="chengwuxian" class="mui-table-view-cell mui-indexed-list-item">成武县</li>
                <li data-value="cjx" data-tags="chengjiangxian" class="mui-table-view-cell mui-indexed-list-item">澄江县</li>
                <li data-value="cd" data-tags="changdu" class="mui-table-view-cell mui-indexed-list-item">昌都</li>                
                <li data-group="D" class="mui-table-view-divider mui-indexed-list-group">D</li>
                <li data-value="dl" data-tags="dalian" class="mui-table-view-cell mui-indexed-list-item">大连</li>
                <li data-value="dg" data-tags="dongguan" class="mui-table-view-cell mui-indexed-list-item">东莞</li>
                <li data-value="dq" data-tags="daqing" class="mui-table-view-cell mui-indexed-list-item">大庆</li>
                <li data-value="dt" data-tags="datong" class="mui-table-view-cell mui-indexed-list-item">大同</li>
                <li data-value="dd" data-tags="dandong" class="mui-table-view-cell mui-indexed-list-item">丹东</li>
                <li data-value="dy" data-tags="dongying" class="mui-table-view-cell mui-indexed-list-item">东营</li>
                <li data-value="dz" data-tags="dezhou" class="mui-table-view-cell mui-indexed-list-item">德州</li>
                <li data-value="dy" data-tags="deyang" class="mui-table-view-cell mui-indexed-list-item">德阳</li>
                <li data-value="dz" data-tags="dazhou" class="mui-table-view-cell mui-indexed-list-item">达州</li>
                <li data-value="dl" data-tags="dali" class="mui-table-view-cell mui-indexed-list-item">大理</li>
                <li data-value="dx" data-tags="dingxi" class="mui-table-view-cell mui-indexed-list-item">定西</li>
                <li data-value="dy" data-tags="danyang" class="mui-table-view-cell mui-indexed-list-item">丹阳</li>
                <li data-value="dy" data-tags="dongyang" class="mui-table-view-cell mui-indexed-list-item">东阳</li>
                <li data-value="df" data-tags="dafeng" class="mui-table-view-cell mui-indexed-list-item">大丰</li>
                <li data-value="dt" data-tags="dongtai" class="mui-table-view-cell mui-indexed-list-item">东台</li>
                <li data-value="df" data-tags="dengfeng" class="mui-table-view-cell mui-indexed-list-item">登封</li>
                <li data-value="dz" data-tags="danzhou" class="mui-table-view-cell mui-indexed-list-item">儋州</li>
                <li data-value="djy" data-tags="dujiangyan" class="mui-table-view-cell mui-indexed-list-item">都江堰</li>
                <li data-value="dsq" data-tags="dashiqiao" class="mui-table-view-cell mui-indexed-list-item">大石桥</li>
                <li data-value="dz" data-tags="dengzhou" class="mui-table-view-cell mui-indexed-list-item">邓州</li>
                <li data-value="dq" data-tags="deqing" class="mui-table-view-cell mui-indexed-list-item">德清</li>
                <li data-value="dy" data-tags="dangyang" class="mui-table-view-cell mui-indexed-list-item">当阳</li>
                <li data-value="dg" data-tags="donggang" class="mui-table-view-cell mui-indexed-list-item">东港</li>
                <li data-value="dy" data-tags="daye" class="mui-table-view-cell mui-indexed-list-item">大冶</li>
                <li data-value="dx" data-tags="dongxing" class="mui-table-view-cell mui-indexed-list-item">东兴</li>
                <li data-value="dbs" data-tags="diaobingshan" class="mui-table-view-cell mui-indexed-list-item">调兵山</li>
                <li data-value="dt" data-tags="dengta" class="mui-table-view-cell mui-indexed-list-item">灯塔</li>
                <li data-value="dt" data-tags="datongshi" class="mui-table-view-cell mui-indexed-list-item">大通</li>
                <li data-value="df" data-tags="dongfang" class="mui-table-view-cell mui-indexed-list-item">东方</li>
                <li data-value="dp" data-tags="dongping" class="mui-table-view-cell mui-indexed-list-item">东平</li>
                <li data-value="db" data-tags="dianbai" class="mui-table-view-cell mui-indexed-list-item">电白</li>
                <li data-value="dh" data-tags="donghai" class="mui-table-view-cell mui-indexed-list-item">东海</li>
                <li data-value="dz" data-tags="dingzhou" class="mui-table-view-cell mui-indexed-list-item">定州</li>
                <li data-value="dc" data-tags="dancheng" class="mui-table-view-cell mui-indexed-list-item">郸城</li>
                <li data-value="dl" data-tags="dalixian" class="mui-table-view-cell mui-indexed-list-item">大荔</li>
                <li data-value="dltq" data-tags="dalateqi" class="mui-table-view-cell mui-indexed-list-item">达拉特旗</li>
                <li data-value="dz" data-tags="dazhu" class="mui-table-view-cell mui-indexed-list-item">大竹</li>
                <li data-value="dw" data-tags="dawa" class="mui-table-view-cell mui-indexed-list-item">大洼</li>
                <li data-value="dy" data-tags="dayi" class="mui-table-view-cell mui-indexed-list-item">大邑</li>
                <li data-value="ds" data-tags="dangshan" class="mui-table-view-cell mui-indexed-list-item">砀山</li>
                <li data-value="dh" data-tags="dunhua" class="mui-table-view-cell mui-indexed-list-item">敦化</li>
                <li data-value="dg" data-tags="dongguang" class="mui-table-view-cell mui-indexed-list-item">东光</li>
                <li data-value="dx" data-tags="daoxian" class="mui-table-view-cell mui-indexed-list-item">道县</li>
                <li data-value="das" data-tags="daanshi" class="mui-table-view-cell mui-indexed-list-item">大安市</li>
                <li data-value="dax" data-tags="dinganxian" class="mui-table-view-cell mui-indexed-list-item">定安县</li>
                <li data-value="dj" data-tags="dianjiang" class="mui-table-view-cell mui-indexed-list-item">垫江</li>
                <li data-value="dmx" data-tags="dongmingxian" class="mui-table-view-cell mui-indexed-list-item">东明县</li>
                <li data-value="dtq" data-tags="dingtaoqu" class="mui-table-view-cell mui-indexed-list-item">定陶区</li>
                <li data-value="dbx" data-tags="dingbianxian" class="mui-table-view-cell mui-indexed-list-item">定边县</li>
                <li data-value="dchzzzx" data-tags="dachangzizhixian" class="mui-table-view-cell mui-indexed-list-item">大厂回族自治县</li>
                <li data-value="dyx" data-tags="dingyuanxian" class="mui-table-view-cell mui-indexed-list-item">定远县</li>
                <li data-value="dwx" data-tags="dawuxia" class="mui-table-view-cell mui-indexed-list-item">大悟县</li>
                <li data-value="dxal" data-tags="daxinganling" class="mui-table-view-cell mui-indexed-list-item">大兴安岭</li>
                <li data-value="dh" data-tags="dehong" class="mui-table-view-cell mui-indexed-list-item">德宏</li>
                <li data-value="dq" data-tags="diqing" class="mui-table-view-cell mui-indexed-list-item">迪庆</li>
                <li data-value="dh" data-tags="dunhuang" class="mui-table-view-cell mui-indexed-list-item">敦煌</li>
                <li data-group="E" class="mui-table-view-divider mui-indexed-list-group">E</li>
                <li data-value="eeds" data-tags="eerduosi" class="mui-table-view-cell mui-indexed-list-item">鄂尔多斯</li>
                <li data-value="ez" data-tags="ezhou" class="mui-table-view-cell mui-indexed-list-item">鄂州</li>
                <li data-value="es" data-tags="enshi" class="mui-table-view-cell mui-indexed-list-item">恩施</li>
                <li data-value="ep" data-tags="enping" class="mui-table-view-cell mui-indexed-list-item">恩平</li>
                <li data-value="ems" data-tags="emeishan" class="mui-table-view-cell mui-indexed-list-item">峨眉山</li>
                <li data-value="emx" data-tags="eminxian" class="mui-table-view-cell mui-indexed-list-item">额敏县</li>
                <li data-value="eegn" data-tags="eerguna" class="mui-table-view-cell mui-indexed-list-item">额尔古纳</li>
                <li data-group="F" class="mui-table-view-divider mui-indexed-list-group">F</li>
                <li data-value="fz" data-tags="fuzhou" class="mui-table-view-cell mui-indexed-list-item">福州</li>
                <li data-value="fs" data-tags="foshan" class="mui-table-view-cell mui-indexed-list-item">佛山</li>
                <li data-value="fs" data-tags="fushun" class="mui-table-view-cell mui-indexed-list-item">抚顺</li>
                <li data-value="fy" data-tags="fuyang" class="mui-table-view-cell mui-indexed-list-item">阜阳</li>
                <li data-value="fz" data-tags="fuzhoufz" class="mui-table-view-cell mui-indexed-list-item">抚州</li>
                <li data-value="fx" data-tags="fuxin" class="mui-table-view-cell mui-indexed-list-item">阜新</li>
                <li data-value="fy" data-tags="fuyangfy" class="mui-table-view-cell mui-indexed-list-item">富阳</li>
                <li data-value="fl" data-tags="fuling" class="mui-table-view-cell mui-indexed-list-item">涪陵</li>
                <li data-value="fq" data-tags="fuqing" class="mui-table-view-cell mui-indexed-list-item">福清</li>
                <li data-value="fh" data-tags="fenghua" class="mui-table-view-cell mui-indexed-list-item">奉化</li>
                <li data-value="fc" data-tags="feicheng" class="mui-table-view-cell mui-indexed-list-item">肥城</li>
                <li data-value="fcg" data-tags="fangchenggang" class="mui-table-view-cell mui-indexed-list-item">防城港</li>
                <li data-value="fh" data-tags="fenghuang" class="mui-table-view-cell mui-indexed-list-item">凤凰</li>
                <li data-value="fn" data-tags="funing" class="mui-table-view-cell mui-indexed-list-item">阜宁</li>
                <li data-value="fc" data-tags="fengcheng" class="mui-table-view-cell mui-indexed-list-item">凤城</li>
                <li data-value="fy" data-tags="fenyang" class="mui-table-view-cell mui-indexed-list-item">汾阳</li>
                <li data-value="fk" data-tags="fukang" class="mui-table-view-cell mui-indexed-list-item">阜康</li>
                <li data-value="fc" data-tags="fch" class="mui-table-view-cell mui-indexed-list-item">丰城</li>
                <li data-value="fx" data-tags="fanxian" class="mui-table-view-cell mui-indexed-list-item">范县</li>
                <li data-value="fc" data-tags="fanchang" class="mui-table-view-cell mui-indexed-list-item">繁昌</li>
                <li data-value="fx" data-tags="feixiang" class="mui-table-view-cell mui-indexed-list-item">肥乡</li>
                <li data-value="fq" data-tags="fengqiu" class="mui-table-view-cell mui-indexed-list-item">封丘</li>
                <li data-value="ff" data-tags="fufeng" class="mui-table-view-cell mui-indexed-list-item">扶风</li>
                <li data-value="fx" data-tags="fengxian" class="mui-table-view-cell mui-indexed-list-item">丰县</li>
                <li data-value="fs" data-tags="fusong" class="mui-table-view-cell mui-indexed-list-item">抚松</li>
                <li data-value="fs" data-tags="fushunxian" class="mui-table-view-cell mui-indexed-list-item">富顺</li>
                <li data-value="fx" data-tags="feixian" class="mui-table-view-cell mui-indexed-list-item">费县</li>
                <li data-value="fg" data-tags="fogang" class="mui-table-view-cell mui-indexed-list-item">佛冈</li>
                <li data-value="fn" data-tags="fengning" class="mui-table-view-cell mui-indexed-list-item">丰宁</li>
                <li data-value="fg" data-tags="fugou" class="mui-table-view-cell mui-indexed-list-item">扶沟</li>
                <li data-value="ft" data-tags="fengtai" class="mui-table-view-cell mui-indexed-list-item">凤台</li>
                <li data-value="fx" data-tags="fengxin" class="mui-table-view-cell mui-indexed-list-item">奉新</li>
                <li data-value="fc" data-tags="fangcheng" class="mui-table-view-cell mui-indexed-list-item">方城</li>
                <li data-value="fyx" data-tags="fuyuanxian" class="mui-table-view-cell mui-indexed-list-item">富源县</li>
                <li data-value="fy" data-tags="fenyi" class="mui-table-view-cell mui-indexed-list-item">分宜</li>
                <li data-value="fsx" data-tags="fusuixian" class="mui-table-view-cell mui-indexed-list-item">扶绥县</li>
                <li data-value="fxx" data-tags="feixixian" class="mui-table-view-cell mui-indexed-list-item">肥西县</li>
                <li data-value="fzx" data-tags="fanzhixian" class="mui-table-view-cell mui-indexed-list-item">繁峙县</li>
                <li data-value="fxx" data-tags="fengxiangxian" class="mui-table-view-cell mui-indexed-list-item">凤翔县</li>
                <li data-value="fa" data-tags="fuan" class="mui-table-view-cell mui-indexed-list-item">福安</li>
                <li data-value="fds" data-tags="fudingshi" class="mui-table-view-cell mui-indexed-list-item">福鼎市</li>
                <li data-value="fgx" data-tags="fuguxian" class="mui-table-view-cell mui-indexed-list-item">府谷县</li>
                <li data-value="fj" data-tags="fengjie" class="mui-table-view-cell mui-indexed-list-item">奉节</li>
                <li data-value="fd" data-tags="fengdu" class="mui-table-view-cell mui-indexed-list-item">丰都</li>
                <li data-value="fdx" data-tags="feidongxian" class="mui-table-view-cell mui-indexed-list-item">肥东县</li>
                <li data-group="G" class="mui-table-view-divider mui-indexed-list-group">G</li>
                <li data-value="gz" data-tags="guangzhou" class="mui-table-view-cell mui-indexed-list-item">广州</li>
                <li data-value="gy" data-tags="guiyang" class="mui-table-view-cell mui-indexed-list-item">贵阳</li>
                <li data-value="gl" data-tags="guilin" class="mui-table-view-cell mui-indexed-list-item">桂林</li>
                <li data-value="gz" data-tags="ganzhou" class="mui-table-view-cell mui-indexed-list-item">赣州</li>
                <li data-value="gg" data-tags="guigang" class="mui-table-view-cell mui-indexed-list-item">贵港</li>
                <li data-value="gy" data-tags="guangyuan" class="mui-table-view-cell mui-indexed-list-item">广元</li>
                <li data-value="ga" data-tags="guangan" class="mui-table-view-cell mui-indexed-list-item">广安</li>
                <li data-value="gy" data-tags="gaoyou" class="mui-table-view-cell mui-indexed-list-item">高邮</li>
                <li data-value="gy" data-tags="gongyi" class="mui-table-view-cell mui-indexed-list-item">巩义</li>
                <li data-value="gm" data-tags="gaomi" class="mui-table-view-cell mui-indexed-list-item">高密</li>
                <li data-value="gbd" data-tags="gaobeidian" class="mui-table-view-cell mui-indexed-list-item">高碑店</li>
                <li data-value="gz" data-tags="gaozhou" class="mui-table-view-cell mui-indexed-list-item">高州</li>
                <li data-value="gy" data-tags="guyuan" class="mui-table-view-cell mui-indexed-list-item">固原</li>
                <li data-value="gr" data-tags="guangrao" class="mui-table-view-cell mui-indexed-list-item">广饶</li>
                <li data-value="gp" data-tags="guiping" class="mui-table-view-cell mui-indexed-list-item">桂平</li>
                <li data-value="gzl" data-tags="gongzhuling" class="mui-table-view-cell mui-indexed-list-item">公主岭</li>
                <li data-value="gh" data-tags="guanghan" class="mui-table-view-cell mui-indexed-list-item">广汉</li>
                <li data-value="gc" data-tags="gaocheng" class="mui-table-view-cell mui-indexed-list-item">藁城</li>
                <li data-value="gp" data-tags="gaoping" class="mui-table-view-cell mui-indexed-list-item">高平</li>
                <li data-value="gj" data-tags="gejiu" class="mui-table-view-cell mui-indexed-list-item">个旧</li>
                <li data-value="gz" data-tags="gaizhou" class="mui-table-view-cell mui-indexed-list-item">盖州</li>
                <li data-value="gj" data-tags="gujiao" class="mui-table-view-cell mui-indexed-list-item">古交</li>
                <li data-value="gem" data-tags="geermu" class="mui-table-view-cell mui-indexed-list-item">格尔木</li>
                <li data-value="gy" data-tags="guanyun" class="mui-table-view-cell mui-indexed-list-item">灌云</li>
                <li data-value="gn" data-tags="guannan" class="mui-table-view-cell mui-indexed-list-item">灌南</li>
                <li data-value="gy" data-tags="ganyu" class="mui-table-view-cell mui-indexed-list-item">赣榆</li>
                <li data-value="ga" data-tags="gaoan" class="mui-table-view-cell mui-indexed-list-item">高安</li>
                <li data-value="gd" data-tags="guangde" class="mui-table-view-cell mui-indexed-list-item">广德</li>
                <li data-value="gqc" data-tags="gongqingcheng" class="mui-table-view-cell mui-indexed-list-item">共青城</li>
                <li data-value="gy" data-tags="gaoyang" class="mui-table-view-cell mui-indexed-list-item">高阳</li>
                <li data-value="gl" data-tags="gaoling" class="mui-table-view-cell mui-indexed-list-item">高陵</li>
                <li data-value="ga" data-tags="gongan" class="mui-table-view-cell mui-indexed-list-item">公安</li>
                <li data-value="gsx" data-tags="gushixian" class="mui-table-view-cell mui-indexed-list-item">固始县</li>
                <li data-value="gz" data-tags="guangze" class="mui-table-view-cell mui-indexed-list-item">光泽</li>
                <li data-value="gsx" data-tags="guangshanxian" class="mui-table-view-cell mui-indexed-list-item">光山县</li>
                <li data-value="gz" data-tags="ganzi" class="mui-table-view-cell mui-indexed-list-item">甘孜</li>
                <li data-value="gn" data-tags="gannan" class="mui-table-view-cell mui-indexed-list-item">甘南</li>
                <li data-value="gl" data-tags="guoluo" class="mui-table-view-cell mui-indexed-list-item">果洛</li>
                <li data-value="gx" data-tags="gaoxiong" class="mui-table-view-cell mui-indexed-list-item">高雄</li>
                <li data-value="gly" data-tags="gulangyu" class="mui-table-view-cell mui-indexed-list-item">鼓浪屿</li>
                <li data-group="H" class="mui-table-view-divider mui-indexed-list-group">H</li>
                <li data-value="hz" data-tags="hangzhou" class="mui-table-view-cell mui-indexed-list-item">杭州</li>
                <li data-value="hf" data-tags="hefei" class="mui-table-view-cell mui-indexed-list-item">合肥</li>
                <li data-value="heb" data-tags="haerbin" class="mui-table-view-cell mui-indexed-list-item">哈尔滨</li>
                <li data-value="hk" data-tags="haikou" class="mui-table-view-cell mui-indexed-list-item">海口</li>
                <li data-value="hd" data-tags="handan" class="mui-table-view-cell mui-indexed-list-item">邯郸</li>
                <li data-value="hhht" data-tags="huhehaote" class="mui-table-view-cell mui-indexed-list-item">呼和浩特</li>
                <li data-value="ha" data-tags="huaian" class="mui-table-view-cell mui-indexed-list-item">淮安</li>
                <li data-value="hz" data-tags="huzhou" class="mui-table-view-cell mui-indexed-list-item">湖州</li>
                <li data-value="hy" data-tags="hengyang" class="mui-table-view-cell mui-indexed-list-item">衡阳</li>
                <li data-value="hz" data-tags="huizhou" class="mui-table-view-cell mui-indexed-list-item">惠州</li>
                <li data-value="hld" data-tags="huludao" class="mui-table-view-cell mui-indexed-list-item">葫芦岛</li>
                <li data-value="hs" data-tags="hengshui" class="mui-table-view-cell mui-indexed-list-item">衡水</li>
                <li data-value="hn" data-tags="huainan" class="mui-table-view-cell mui-indexed-list-item">淮南</li>
                <li data-value="hz" data-tags="heze" class="mui-table-view-cell mui-indexed-list-item">菏泽</li>
                <li data-value="hs" data-tags="huangshi" class="mui-table-view-cell mui-indexed-list-item">黄石</li>
                <li data-value="hg" data-tags="huanggang" class="mui-table-view-cell mui-indexed-list-item">黄冈</li>
                <li data-value="hh" data-tags="huaihua" class="mui-table-view-cell mui-indexed-list-item">怀化</li>
                <li data-value="hlbe" data-tags="hulunbeier" class="mui-table-view-cell mui-indexed-list-item">呼伦贝尔</li>
                <li data-value="hg" data-tags="hegang" class="mui-table-view-cell mui-indexed-list-item">鹤岗</li>
                <li data-value="hh" data-tags="heihe" class="mui-table-view-cell mui-indexed-list-item">黑河</li>
                <li data-value="hb" data-tags="huaibei" class="mui-table-view-cell mui-indexed-list-item">淮北</li>
                <li data-value="hs" data-tags="huangshan" class="mui-table-view-cell mui-indexed-list-item">黄山</li>
                <li data-value="hb" data-tags="hebi" class="mui-table-view-cell mui-indexed-list-item">鹤壁</li>
                <li data-value="hy" data-tags="heyuan" class="mui-table-view-cell mui-indexed-list-item">河源</li>
                <li data-value="hz" data-tags="hezhou" class="mui-table-view-cell mui-indexed-list-item">贺州</li>
                <li data-value="hc" data-tags="hechi" class="mui-table-view-cell mui-indexed-list-item">河池</li>
                <li data-value="hh" data-tags="honghe" class="mui-table-view-cell mui-indexed-list-item">红河</li>
                <li data-value="hz" data-tags="hanzhong" class="mui-table-view-cell mui-indexed-list-item">汉中</li>
                <li data-value="hd" data-tags="huadu" class="mui-table-view-cell mui-indexed-list-item">花都</li>
                <li data-value="hn" data-tags="haining" class="mui-table-view-cell mui-indexed-list-item">海宁</li>
                <li data-value="hd" data-tags="huidong" class="mui-table-view-cell mui-indexed-list-item">惠东</li>
                <li data-value="hy" data-tags="huiyang" class="mui-table-view-cell mui-indexed-list-item">惠阳</li>
                <li data-value="hc" data-tags="haicheng" class="mui-table-view-cell mui-indexed-list-item">海城</li>
                <li data-value="hm" data-tags="haimen" class="mui-table-view-cell mui-indexed-list-item">海门</li>
                <li data-value="hy" data-tags="haiyang" class="mui-table-view-cell mui-indexed-list-item">海阳</li>
                <li data-value="ha" data-tags="haian" class="mui-table-view-cell mui-indexed-list-item">海安</li>
                <li data-value="hz" data-tags="huazhou" class="mui-table-view-cell mui-indexed-list-item">化州</li>
                <li data-value="hc" data-tags="hechuan" class="mui-table-view-cell mui-indexed-list-item">合川</li>
                <li data-value="hd" data-tags="hengdian" class="mui-table-view-cell mui-indexed-list-item">横店</li>
                <li data-value="hd" data-tags="haidong" class="mui-table-view-cell mui-indexed-list-item">海东</li>
                <li data-value="hm" data-tags="hami" class="mui-table-view-cell mui-indexed-list-item">哈密</li>
                <li data-value="hs" data-tags="heshan" class="mui-table-view-cell mui-indexed-list-item">鹤山</li>
                <li data-value="hd" data-tags="huadian" class="mui-table-view-cell mui-indexed-list-item">桦甸</li>
                <li data-value="hy" data-tags="huayin" class="mui-table-view-cell mui-indexed-list-item">华阴</li>
                <li data-value="hm" data-tags="houma" class="mui-table-view-cell mui-indexed-list-item">侯马</li>
                <li data-value="hj" data-tags="hejin" class="mui-table-view-cell mui-indexed-list-item">河津</li>
                <li data-value="hz" data-tags="huozhou" class="mui-table-view-cell mui-indexed-list-item">霍州</li>
                <li data-value="hh" data-tags="huanghua" class="mui-table-view-cell mui-indexed-list-item">黄骅</li>
                <li data-value="hl" data-tags="hailin" class="mui-table-view-cell mui-indexed-list-item">海林</li>
                <li data-value="hy" data-tags="haiyan" class="mui-table-view-cell mui-indexed-list-item">海盐</li>
                <li data-value="hy" data-tags="huaiyang" class="mui-table-view-cell mui-indexed-list-item">淮阳</li>
                <li data-value="hy" data-tags="hanyin" class="mui-table-view-cell mui-indexed-list-item">汉阴</li>
                <li data-value="hs" data-tags="hanshan" class="mui-table-view-cell mui-indexed-list-item">含山</li>
                <li data-value="hx" data-tags="hexian" class="mui-table-view-cell mui-indexed-list-item">和县</li>
                <li data-value="hx" data-tags="huxian" class="mui-table-view-cell mui-indexed-list-item">户县</li>
                <li data-value="hx" data-tags="huixian" class="mui-table-view-cell mui-indexed-list-item">辉县</li>
                <li data-value="hr" data-tags="huairen" class="mui-table-view-cell mui-indexed-list-item">怀仁</li>
                <li data-value="hx" data-tags="huaxian" class="mui-table-view-cell mui-indexed-list-item">滑县</li>
                <li data-value="ha" data-tags="huian" class="mui-table-view-cell mui-indexed-list-item">惠安</li>
                <li data-value="hc" data-tags="hancheng" class="mui-table-view-cell mui-indexed-list-item">韩城</li>
                <li data-value="ht" data-tags="huating" class="mui-table-view-cell mui-indexed-list-item">华亭</li>
                <li data-value="hd" data-tags="hongtong" class="mui-table-view-cell mui-indexed-list-item">洪洞</li>
                <li data-value="hk" data-tags="hekou" class="mui-table-view-cell mui-indexed-list-item">河口</li>
                <li data-value="hn" data-tags="huinan" class="mui-table-view-cell mui-indexed-list-item">辉南</li>
                <li data-value="hh" data-tags="honghu" class="mui-table-view-cell mui-indexed-list-item">洪湖</li>
                <li data-value="hc" data-tags="haicang" class="mui-table-view-cell mui-indexed-list-item">海沧</li>
                <li data-value="hq" data-tags="huoqiu" class="mui-table-view-cell mui-indexed-list-item">霍邱</li>
                <li data-value="hc" data-tags="hunchun" class="mui-table-view-cell mui-indexed-list-item">珲春</li>
                <li data-value="hn" data-tags="huaining" class="mui-table-view-cell mui-indexed-list-item">怀宁</li>
                <li data-value="hyx" data-tags="huaiyuanxian" class="mui-table-view-cell mui-indexed-list-item">怀远县</li>
                <li data-value="hzx" data-tags="huizexian" class="mui-table-view-cell mui-indexed-list-item">会泽县</li>
                <li data-value="hjs" data-tags="hejianshi" class="mui-table-view-cell mui-indexed-list-item">河间市</li>
                <li data-value="hpx" data-tags="hepuxian" class="mui-table-view-cell mui-indexed-list-item">合浦县</li>
                <li data-value="hyx" data-tags="hengyangxian" class="mui-table-view-cell mui-indexed-list-item">衡阳县</li>
                <li data-value="hsx" data-tags="hengshanxian" class="mui-table-view-cell mui-indexed-list-item">衡山县</li>
                <li data-value="hdx" data-tags="hengdongxian" class="mui-table-view-cell mui-indexed-list-item">衡东县</li>
                <li data-value="hcx" data-tags="huangchuanxian" class="mui-table-view-cell mui-indexed-list-item">潢川县</li>
                <li data-value="hlx" data-tags="helanxian" class="mui-table-view-cell mui-indexed-list-item">贺兰县</li>
                <li data-value="hnq" data-tags="hannanqu" class="mui-table-view-cell mui-indexed-list-item">汉南区</li>
                <li data-value="hls" data-tags="hailunshi" class="mui-table-view-cell mui-indexed-list-item">海伦市</li>
                <li data-value="hjx" data-tags="hejiangxian" class="mui-table-view-cell mui-indexed-list-item">合江县</li>
                <li data-value="hx" data-tags="huanxian" class="mui-table-view-cell mui-indexed-list-item">环县</li>
                <li data-value="hlx" data-tags="huanglingxian" class="mui-table-view-cell mui-indexed-list-item">黄陵县</li>
                <li data-value="hcx" data-tags="huachuanxian" class="mui-table-view-cell mui-indexed-list-item">桦川县</li>
                <li data-value="hsq" data-tags="hengshanqu" class="mui-table-view-cell mui-indexed-list-item">横山区</li>
                <li data-value="hr" data-tags="huarong" class="mui-table-view-cell mui-indexed-list-item">华容</li>
                <li data-value="hb" data-tags="haibei" class="mui-table-view-cell mui-indexed-list-item">海北</li>
                <li data-value="hn" data-tags="huangnan" class="mui-table-view-cell mui-indexed-list-item">黄南</li>
                <li data-value="hnz" data-tags="hainanzhou" class="mui-table-view-cell mui-indexed-list-item">海南州</li>
                <li data-value="hx" data-tags="haixi" class="mui-table-view-cell mui-indexed-list-item">海西</li>
                <li data-value="ht" data-tags="hetian" class="mui-table-view-cell mui-indexed-list-item">和田</li>
                <li data-value="hl" data-tags="hualian" class="mui-table-view-cell mui-indexed-list-item">花莲</li>
                <li data-value="hc" data-tags="hengchun" class="mui-table-view-cell mui-indexed-list-item">恒春</li>
                <li data-group="J" class="mui-table-view-divider mui-indexed-list-group">J</li>
                <li data-value="jn" data-tags="jinan" class="mui-table-view-cell mui-indexed-list-item">济南</li>
                <li data-value="jl" data-tags="jilin" class="mui-table-view-cell mui-indexed-list-item">吉林</li>
                <li data-value="jx" data-tags="jiaxing" class="mui-table-view-cell mui-indexed-list-item">嘉兴</li>
                <li data-value="jh" data-tags="jinhua" class="mui-table-view-cell mui-indexed-list-item">金华</li>
                <li data-value="jn" data-tags="jining" class="mui-table-view-cell mui-indexed-list-item">济宁</li>
                <li data-value="jz" data-tags="jingzhou" class="mui-table-view-cell mui-indexed-list-item">荆州</li>
                <li data-value="jm" data-tags="jiangmen" class="mui-table-view-cell mui-indexed-list-item">江门</li>
                <li data-value="jy" data-tags="jiangyin" class="mui-table-view-cell mui-indexed-list-item">江阴</li>
                <li data-value="jz" data-tags="jiaozuo" class="mui-table-view-cell mui-indexed-list-item">焦作</li>
                <li data-value="jz" data-tags="jinzhou" class="mui-table-view-cell mui-indexed-list-item">锦州</li>
                <li data-value="jj" data-tags="jiujiang" class="mui-table-view-cell mui-indexed-list-item">九江</li>
                <li data-value="jms" data-tags="jiamusi" class="mui-table-view-cell mui-indexed-list-item">佳木斯</li>
                <li data-value="jm" data-tags="jingmen" class="mui-table-view-cell mui-indexed-list-item">荆门</li>
                <li data-value="jy" data-tags="jieyang" class="mui-table-view-cell mui-indexed-list-item">揭阳</li>
                <li data-value="jj" data-tags="jinjiang" class="mui-table-view-cell mui-indexed-list-item">晋江</li>
                <li data-value="jc" data-tags="jincheng" class="mui-table-view-cell mui-indexed-list-item">晋城</li>
                <li data-value="jz" data-tags="jinzhong" class="mui-table-view-cell mui-indexed-list-item">晋中</li>
                <li data-value="jx" data-tags="jixi" class="mui-table-view-cell mui-indexed-list-item">鸡西</li>
                <li data-value="jdz" data-tags="jingdezhen" class="mui-table-view-cell mui-indexed-list-item">景德镇</li>
                <li data-value="ja" data-tags="jian" class="mui-table-view-cell mui-indexed-list-item">吉安</li>
                <li data-value="jy" data-tags="jiyuan" class="mui-table-view-cell mui-indexed-list-item">济源</li>
                <li data-value="jq" data-tags="jiuquan" class="mui-table-view-cell mui-indexed-list-item">酒泉</li>
                <li data-value="jj" data-tags="jingjiang" class="mui-table-view-cell mui-indexed-list-item">靖江</li>
                <li data-value="jt" data-tags="jintan" class="mui-table-view-cell mui-indexed-list-item">金坛</li>
                <li data-value="js" data-tags="jiashan" class="mui-table-view-cell mui-indexed-list-item">嘉善</li>
                <li data-value="jr" data-tags="jurong" class="mui-table-view-cell mui-indexed-list-item">句容</li>
                <li data-value="jz" data-tags="jiaozhou" class="mui-table-view-cell mui-indexed-list-item">胶州</li>
                <li data-value="jm" data-tags="jimo" class="mui-table-view-cell mui-indexed-list-item">即墨</li>
                <li data-value="jd" data-tags="jiangdu" class="mui-table-view-cell mui-indexed-list-item">江都</li>
                <li data-value="jc" data-tags="jinchang" class="mui-table-view-cell mui-indexed-list-item">金昌</li>
                <li data-value="jyg" data-tags="jiayuguan" class="mui-table-view-cell mui-indexed-list-item">嘉峪关</li>
                <li data-value="js" data-tags="jiangshan" class="mui-table-view-cell mui-indexed-list-item">江山</li>
                <li data-value="jh" data-tags="jianhu" class="mui-table-view-cell mui-indexed-list-item">建湖</li>
                <li data-value="jz" data-tags="jinzhoushi" class="mui-table-view-cell mui-indexed-list-item">晋州</li>
                <li data-value="jd" data-tags="jiande" class="mui-table-view-cell mui-indexed-list-item">建德</li>
                <li data-value="jy" data-tags="jianyang" class="mui-table-view-cell mui-indexed-list-item">简阳</li>
                <li data-value="jx" data-tags="jiexiu" class="mui-table-view-cell mui-indexed-list-item">介休</li>
                <li data-value="ja" data-tags="jianshi" class="mui-table-view-cell mui-indexed-list-item">集安</li>
                <li data-value="jh" data-tags="jiaohe" class="mui-table-view-cell mui-indexed-list-item">蛟河</li>
                <li data-value="jy" data-tags="jianyangjy" class="mui-table-view-cell mui-indexed-list-item">建阳</li>
                <li data-value="jx" data-tags="jiaxian" class="mui-table-view-cell mui-indexed-list-item">郏县</li>
                <li data-value="jt" data-tags="jintang" class="mui-table-view-cell mui-indexed-list-item">金堂</li>
                <li data-value="jl" data-tags="jianli" class="mui-table-view-cell mui-indexed-list-item">监利</li>
                <li data-value="jj" data-tags="jiangjin" class="mui-table-view-cell mui-indexed-list-item">江津</li>
                <li data-value="jy" data-tags="juye" class="mui-table-view-cell mui-indexed-list-item">巨野</li>
                <li data-value="jx" data-tags="jiaxiang" class="mui-table-view-cell mui-indexed-list-item">嘉祥</li>
                <li data-value="jx" data-tags="jinxiang" class="mui-table-view-cell mui-indexed-list-item">金乡</li>
                <li data-value="jy" data-tags="jinyun" class="mui-table-view-cell mui-indexed-list-item">缙云</li>
                <li data-value="js" data-tags="jingshan" class="mui-table-view-cell mui-indexed-list-item">京山</li>
                <li data-value="jy" data-tags="jiangyou" class="mui-table-view-cell mui-indexed-list-item">江油</li>
                <li data-value="jn" data-tags="junan" class="mui-table-view-cell mui-indexed-list-item">莒南</li>
                <li data-value="jh" data-tags="jinhu" class="mui-table-view-cell mui-indexed-list-item">金湖</li>
                <li data-value="jm" data-tags="jimei" class="mui-table-view-cell mui-indexed-list-item">集美</li>
                <li data-value="js" data-tags="jinsha" class="mui-table-view-cell mui-indexed-list-item">金沙</li>
                <li data-value="jx" data-tags="jingxian" class="mui-table-view-cell mui-indexed-list-item">泾县</li>
                <li data-value="jax" data-tags="jianxian" class="mui-table-view-cell mui-indexed-list-item">吉安县</li>
                <li data-value="jsx" data-tags="jishuixian" class="mui-table-view-cell mui-indexed-list-item">吉水县</li>
                <li data-value="jcx" data-tags="jiangchuanxian" class="mui-table-view-cell mui-indexed-list-item">江川县</li>
                <li data-value="jlx" data-tags="jianglexian" class="mui-table-view-cell mui-indexed-list-item">将乐县</li>
                <li data-value="jhyzzzx" data-tags="jianghuayaozuzizhixian" class="mui-table-view-cell mui-indexed-list-item">江华瑶族自治县</li>
                <li data-value="jnx" data-tags="jinningxian" class="mui-table-view-cell mui-indexed-list-item">晋宁县</li>
                <li data-value="jy" data-tags="jiangyong" class="mui-table-view-cell mui-indexed-list-item">江永</li>
                <li data-value="jsx" data-tags="jianshuixian" class="mui-table-view-cell mui-indexed-list-item">建水县</li>
                <li data-value="jcx" data-tags="juanchengxian" class="mui-table-view-cell mui-indexed-list-item">鄄城县</li>
                <li data-value="jb" data-tags="jingbian" class="mui-table-view-cell mui-indexed-list-item">靖边</li>
                <li data-value="jyx" data-tags="jiayuxian" class="mui-table-view-cell mui-indexed-list-item">嘉鱼县</li>
                <li data-value="jzqx" data-tags="jzqixian" class="mui-table-view-cell mui-indexed-list-item">祁县</li>
                <li data-value="jhx" data-tags="jinghexian" class="mui-table-view-cell mui-indexed-list-item">精河县</li>
                <li data-value="jxx" data-tags="jingxixian" class="mui-table-view-cell mui-indexed-list-item">靖西县</li>
                <li data-value="jzg" data-tags="jiuzhaigou" class="mui-table-view-cell mui-indexed-list-item">九寨沟</li>
                <li data-value="jgs" data-tags="jinggangshan" class="mui-table-view-cell mui-indexed-list-item">井冈山</li>
                <li data-value="jl" data-tags="jilong" class="mui-table-view-cell mui-indexed-list-item">基隆</li>
                <li data-value="jys" data-tags="jiayi" class="mui-table-view-cell mui-indexed-list-item">嘉义市</li>
                <li data-group="K" class="mui-table-view-divider mui-indexed-list-group">K</li>
                <li data-value="km" data-tags="kunming" class="mui-table-view-cell mui-indexed-list-item">昆明</li>
                <li data-value="ks" data-tags="kunshan" class="mui-table-view-cell mui-indexed-list-item">昆山</li>
                <li data-value="kf" data-tags="kaifeng" class="mui-table-view-cell mui-indexed-list-item">开封</li>
                <li data-value="klmy" data-tags="kelamayi" class="mui-table-view-cell mui-indexed-list-item">克拉玛依</li>
                <li data-value="kp" data-tags="kaiping" class="mui-table-view-cell mui-indexed-list-item">开平</li>
                <li data-value="kel" data-tags="kuerle" class="mui-table-view-cell mui-indexed-list-item">库尔勒</li>
                <li data-value="kh" data-tags="kaihua" class="mui-table-view-cell mui-indexed-list-item">开化</li>
                <li data-value="kt" data-tags="kuitun" class="mui-table-view-cell mui-indexed-list-item">奎屯</li>
                <li data-value="kzq" data-tags="kaizhouqu" class="mui-table-view-cell mui-indexed-list-item">开州区</li>
                <li data-value="kl" data-tags="kenli" class="mui-table-view-cell mui-indexed-list-item">垦利</li>
                <li data-value="kc" data-tags="kuancheng" class="mui-table-view-cell mui-indexed-list-item">宽城</li>
                <li data-value="kc" data-tags="kuche" class="mui-table-view-cell mui-indexed-list-item">库车</li>
                <li data-value="ky" data-tags="kaiyang" class="mui-table-view-cell mui-indexed-list-item">开阳</li>
                <li data-value="kx" data-tags="kangxian" class="mui-table-view-cell mui-indexed-list-item">康县</li>
                <li data-value="kz" data-tags="kezhou" class="mui-table-view-cell mui-indexed-list-item">克州</li>
                <li data-value="ksdq" data-tags="kashi" class="mui-table-view-cell mui-indexed-list-item">喀什地区</li>
                <li data-value="kd" data-tags="kending" class="mui-table-view-cell mui-indexed-list-item">垦丁</li>
                <li data-group="L" class="mui-table-view-divider mui-indexed-list-group">L</li>
                <li data-value="lyg" data-tags="lianyungang" class="mui-table-view-cell mui-indexed-list-item">连云港</li>
                <li data-value="ly" data-tags="linyi" class="mui-table-view-cell mui-indexed-list-item">临沂</li>
                <li data-value="ly" data-tags="luoyang" class="mui-table-view-cell mui-indexed-list-item">洛阳</li>
                <li data-value="lz" data-tags="liuzhou" class="mui-table-view-cell mui-indexed-list-item">柳州</li>
                <li data-value="lz" data-tags="lanzhou" class="mui-table-view-cell mui-indexed-list-item">兰州</li>
                <li data-value="lf" data-tags="langfang" class="mui-table-view-cell mui-indexed-list-item">廊坊</li>
                <li data-value="lf" data-tags="linfen" class="mui-table-view-cell mui-indexed-list-item">临汾</li>
                <li data-value="ly" data-tags="liaoyang" class="mui-table-view-cell mui-indexed-list-item">辽阳</li>
                <li data-value="ls" data-tags="lishui" class="mui-table-view-cell mui-indexed-list-item">丽水</li>
                <li data-value="la" data-tags="liuan" class="mui-table-view-cell mui-indexed-list-item">六安</li>
                <li data-value="ly" data-tags="longyan" class="mui-table-view-cell mui-indexed-list-item">龙岩</li>
                <li data-value="lc" data-tags="liaocheng" class="mui-table-view-cell mui-indexed-list-item">聊城</li>
                <li data-value="ls" data-tags="leshan" class="mui-table-view-cell mui-indexed-list-item">乐山</li>
                <li data-value="ls" data-tags="lasa" class="mui-table-view-cell mui-indexed-list-item">拉萨</li>
                <li data-value="ll" data-tags="lvliang" class="mui-table-view-cell mui-indexed-list-item">吕梁</li>
                <li data-value="ly" data-tags="liaoyuan" class="mui-table-view-cell mui-indexed-list-item">辽源</li>
                <li data-value="lw" data-tags="laiwu" class="mui-table-view-cell mui-indexed-list-item">莱芜</li>
                <li data-value="lh" data-tags="luohe" class="mui-table-view-cell mui-indexed-list-item">漯河</li>
                <li data-value="ld" data-tags="loudi" class="mui-table-view-cell mui-indexed-list-item">娄底</li>
                <li data-value="lb" data-tags="laibin" class="mui-table-view-cell mui-indexed-list-item">来宾</li>
                <li data-value="lz" data-tags="luzhou" class="mui-table-view-cell mui-indexed-list-item">泸州</li>
                <li data-value="ls" data-tags="liangshan" class="mui-table-view-cell mui-indexed-list-item">凉山</li>
                <li data-value="lps" data-tags="liupanshui" class="mui-table-view-cell mui-indexed-list-item">六盘水</li>
                <li data-value="lj" data-tags="lijiang" class="mui-table-view-cell mui-indexed-list-item">丽江</li>
                <li data-value="ly" data-tags="liyang" class="mui-table-view-cell mui-indexed-list-item">溧阳</li>
                <li data-value="lh" data-tags="linhai" class="mui-table-view-cell mui-indexed-list-item">临海</li>
                <li data-value="lx" data-tags="lanxi" class="mui-table-view-cell mui-indexed-list-item">兰溪</li>
                <li data-value="lk" data-tags="longkou" class="mui-table-view-cell mui-indexed-list-item">龙口</li>
                <li data-value="ly" data-tags="leiyang" class="mui-table-view-cell mui-indexed-list-item">耒阳</li>
                <li data-value="lz" data-tags="laizhou" class="mui-table-view-cell mui-indexed-list-item">莱州</li>
                <li data-value="la" data-tags="linan" class="mui-table-view-cell mui-indexed-list-item">临安</li>
                <li data-value="ly" data-tags="laiyang" class="mui-table-view-cell mui-indexed-list-item">莱阳</li>
                <li data-value="lf" data-tags="lufeng" class="mui-table-view-cell mui-indexed-list-item">陆丰</li>
                <li data-value="ly" data-tags="liuyang" class="mui-table-view-cell mui-indexed-list-item">浏阳</li>
                <li data-value="lj" data-tags="lianjiang" class="mui-table-view-cell mui-indexed-list-item">廉江</li>
                <li data-value="lz" data-tags="linzhou" class="mui-table-view-cell mui-indexed-list-item">林州</li>
                <li data-value="lc" data-tags="lincang" class="mui-table-view-cell mui-indexed-list-item">临沧</li>
                <li data-value="lx" data-tags="linxia" class="mui-table-view-cell mui-indexed-list-item">临夏</li>
                <li data-value="lc" data-tags="lechang" class="mui-table-view-cell mui-indexed-list-item">乐昌</li>
                <li data-value="lq" data-tags="linqing" class="mui-table-view-cell mui-indexed-list-item">临清</li>
                <li data-value="lb" data-tags="lingbao" class="mui-table-view-cell mui-indexed-list-item">灵宝</li>
                <li data-value="lsj" data-tags="lengshuijiang" class="mui-table-view-cell mui-indexed-list-item">冷水江</li>
                <li data-value="ll" data-tags="laoling" class="mui-table-view-cell mui-indexed-list-item">乐陵</li>
                <li data-value="lh" data-tags="longhai" class="mui-table-view-cell mui-indexed-list-item">龙海</li>
                <li data-value="ll" data-tags="liling" class="mui-table-view-cell mui-indexed-list-item">醴陵</li>
                <li data-value="lx" data-tags="laixi" class="mui-table-view-cell mui-indexed-list-item">莱西</li>
                <li data-value="lp" data-tags="leping" class="mui-table-view-cell mui-indexed-list-item">乐平</li>
                <li data-value="lz" data-tags="langzhong" class="mui-table-view-cell mui-indexed-list-item">阆中</li>
                <li data-value="lq" data-tags="luquan" class="mui-table-view-cell mui-indexed-list-item">鹿泉</li>
                <li data-value="lc" data-tags="lichuan" class="mui-table-view-cell mui-indexed-list-item">利川</li>
                <li data-value="lhk" data-tags="laohekou" class="mui-table-view-cell mui-indexed-list-item">老河口</li>
                <li data-value="lh" data-tags="linghai" class="mui-table-view-cell mui-indexed-list-item">凌海</li>
                <li data-value="ln" data-tags="luannan" class="mui-table-view-cell mui-indexed-list-item">滦南</li>
                <li data-value="ls" data-tags="lingshan" class="mui-table-view-cell mui-indexed-list-item">灵山</li>
                <li data-value="lz" data-tags="lianzhou" class="mui-table-view-cell mui-indexed-list-item">连州</li>
                <li data-value="ls" data-tags="lingshui" class="mui-table-view-cell mui-indexed-list-item">陵水</li>
                <li data-value="lj" data-tags="linjiang" class="mui-table-view-cell mui-indexed-list-item">临江</li>
                <li data-value="lj" data-tags="lianjiangxian" class="mui-table-view-cell mui-indexed-list-item">连江</li>
                <li data-value="lq" data-tags="linqu" class="mui-table-view-cell mui-indexed-list-item">临朐</li>
                <li data-value="lt" data-tags="laoting" class="mui-table-view-cell mui-indexed-list-item">乐亭</li>
                <li data-value="lx" data-tags="luanxian" class="mui-table-view-cell mui-indexed-list-item">滦县</li>
                <li data-value="lc" data-tags="luancheng" class="mui-table-view-cell mui-indexed-list-item">栾城</li>
                <li data-value="ls" data-tags="lushanls" class="mui-table-view-cell mui-indexed-list-item">鲁山</li>
                <li data-value="ls" data-tags="lingshi" class="mui-table-view-cell mui-indexed-list-item">灵石</li>
                <li data-value="lz" data-tags="linzhang" class="mui-table-view-cell mui-indexed-list-item">临漳</li>
                <li data-value="lt" data-tags="lintong" class="mui-table-view-cell mui-indexed-list-item">临潼</li>
                <li data-value="lt" data-tags="lantian" class="mui-table-view-cell mui-indexed-list-item">蓝田</li>
                <li data-value="lc" data-tags="longchang" class="mui-table-view-cell mui-indexed-list-item">隆昌</li>
                <li data-value="ly" data-tags="luyi" class="mui-table-view-cell mui-indexed-list-item">鹿邑</li>
                <li data-value="lh" data-tags="liuhe" class="mui-table-view-cell mui-indexed-list-item">柳河</li>
                <li data-value="ly" data-tags="linyixian" class="mui-table-view-cell mui-indexed-list-item">临猗</li>
                <li data-value="ls" data-tags="liangshanxian" class="mui-table-view-cell mui-indexed-list-item">梁山</li>
                <li data-value="lj" data-tags="lijin" class="mui-table-view-cell mui-indexed-list-item">利津</li>
                <li data-value="ly" data-tags="linyily" class="mui-table-view-cell mui-indexed-list-item">临邑</li>
                <li data-value="lq" data-tags="longquan" class="mui-table-view-cell mui-indexed-list-item">龙泉</li>
                <li data-value="lc" data-tags="lingchuan" class="mui-table-view-cell mui-indexed-list-item">陵川</li>
                <li data-value="ly" data-tags="longyao" class="mui-table-view-cell mui-indexed-list-item">隆尧</li>
                <li data-value="lz" data-tags="leizhou" class="mui-table-view-cell mui-indexed-list-item">雷州</li>
                <li data-value="lc" data-tags="luanchuan" class="mui-table-view-cell mui-indexed-list-item">栾川</li>
                <li data-value="ly" data-tags="longyou" class="mui-table-view-cell mui-indexed-list-item">龙游</li>
                <li data-value="ll" data-tags="lanling" class="mui-table-view-cell mui-indexed-list-item">兰陵</li>
                <li data-value="ls" data-tags="linshu" class="mui-table-view-cell mui-indexed-list-item">临沭</li>
                <li data-value="ls" data-tags="lianshui" class="mui-table-view-cell mui-indexed-list-item">涟水</li>
                <li data-value="lx" data-tags="lixian" class="mui-table-view-cell mui-indexed-list-item">澧县</li>
                <li data-value="lz" data-tags="liaozhong" class="mui-table-view-cell mui-indexed-list-item">辽中</li>
                <li data-value="lpx" data-tags="luopingxian" class="mui-table-view-cell mui-indexed-list-item">罗平县</li>
                <li data-value="lys" data-tags="lianyuanshi" class="mui-table-view-cell mui-indexed-list-item">涟源市</li>
                <li data-value="ljx" data-tags="lujiangxian" class="mui-table-view-cell mui-indexed-list-item">庐江县</li>
                <li data-value="ly" data-tags="linying" class="mui-table-view-cell mui-indexed-list-item">临颍</li>
                <li data-value="ls" data-tags="lanshan" class="mui-table-view-cell mui-indexed-list-item">蓝山</li>
                <li data-value="lh" data-tags="longhui" class="mui-table-view-cell mui-indexed-list-item">隆回</li>
                <li data-value="lx" data-tags="luxi" class="mui-table-view-cell mui-indexed-list-item">芦溪</li>
                <li data-value="lsx" data-tags="lushixian" class="mui-table-view-cell mui-indexed-list-item">卢氏县</li>
                <li data-value="lhx" data-tags="longhuaxian" class="mui-table-view-cell mui-indexed-list-item">隆化县</li>
                <li data-value="ln" data-tags="luoningxian" class="mui-table-view-cell mui-indexed-list-item">洛宁</li>
                <li data-value="lkx" data-tags="lankaoxian" class="mui-table-view-cell mui-indexed-list-item">兰考县</li>
                <li data-value="ll" data-tags="linli" class="mui-table-view-cell mui-indexed-list-item">临澧</li>
                <li data-value="lx" data-tags="lixin" class="mui-table-view-cell mui-indexed-list-item">利辛</li>
                <li data-value="lqx" data-tags="lingqiuxian" class="mui-table-view-cell mui-indexed-list-item">灵丘县</li>
                <li data-value="lfx" data-tags="lufengxian" class="mui-table-view-cell mui-indexed-list-item">禄丰县</li>
                <li data-value="lsq" data-tags="lishuiqu" class="mui-table-view-cell mui-indexed-list-item">溧水区</li>
                <li data-value="lx" data-tags="luxian" class="mui-table-view-cell mui-indexed-list-item">泸县</li>
                <li data-value="lcx" data-tags="luochuanxian" class="mui-table-view-cell mui-indexed-list-item">洛川县</li>
                <li data-value="lds" data-tags="luodingshi" class="mui-table-view-cell mui-indexed-list-item">罗定市</li>
                <li data-value="ld" data-tags="ledong" class="mui-table-view-cell mui-indexed-list-item">乐东</li>
                <li data-value="lp" data-tags="liangping" class="mui-table-view-cell mui-indexed-list-item">梁平</li>
                <li data-value="lgx" data-tags="lingaoxian" class="mui-table-view-cell mui-indexed-list-item">临高县</li>
                <li data-value="lyx" data-tags="luoyuanxian" class="mui-table-view-cell mui-indexed-list-item">罗源县</li>
                <li data-value="lcx" data-tags="luchuanxian" class="mui-table-view-cell mui-indexed-list-item">陆川县</li>
                <li data-value="lqx" data-tags="linquanxian" class="mui-table-view-cell mui-indexed-list-item">临泉县</li>
                <li data-value="lz" data-tags="linzhi" class="mui-table-view-cell mui-indexed-list-item">林芝</li>
                <li data-value="ln" data-tags="longnan" class="mui-table-view-cell mui-indexed-list-item">陇南</li>
                <li data-group="M" class="mui-table-view-divider mui-indexed-list-group">M</li>
                <li data-value="my" data-tags="mianyang" class="mui-table-view-cell mui-indexed-list-item">绵阳</li>
                <li data-value="mdj" data-tags="mudanjiang" class="mui-table-view-cell mui-indexed-list-item">牡丹江</li>
                <li data-value="mas" data-tags="maanshan" class="mui-table-view-cell mui-indexed-list-item">马鞍山</li>
                <li data-value="mm" data-tags="maoming" class="mui-table-view-cell mui-indexed-list-item">茂名</li>
                <li data-value="mz" data-tags="meizhou" class="mui-table-view-cell mui-indexed-list-item">梅州</li>
                <li data-value="ms" data-tags="meishan" class="mui-table-view-cell mui-indexed-list-item">眉山</li>
                <li data-value="ms" data-tags="mishan" class="mui-table-view-cell mui-indexed-list-item">密山</li>
                <li data-value="mzl" data-tags="manzhouli" class="mui-table-view-cell mui-indexed-list-item">满洲里</li>
                <li data-value="mhk" data-tags="meihekou" class="mui-table-view-cell mui-indexed-list-item">梅河口</li>
                <li data-value="ml" data-tags="miluo" class="mui-table-view-cell mui-indexed-list-item">汨罗</li>
                <li data-value="mg" data-tags="mingguang" class="mui-table-view-cell mui-indexed-list-item">明光</li>
                <li data-value="mc" data-tags="macheng" class="mui-table-view-cell mui-indexed-list-item">麻城</li>
                <li data-value="mz" data-tags="mengzhou" class="mui-table-view-cell mui-indexed-list-item">孟州</li>
                <li data-value="mj" data-tags="mengjin" class="mui-table-view-cell mui-indexed-list-item">孟津</li>
                <li data-value="mp" data-tags="muping" class="mui-table-view-cell mui-indexed-list-item">牟平</li>
                <li data-value="mx" data-tags="meixian" class="mui-table-view-cell mui-indexed-list-item">眉县</li>
                <li data-value="mq" data-tags="minquan" class="mui-table-view-cell mui-indexed-list-item">民权</li>
                <li data-value="mc" data-tags="mianchi" class="mui-table-view-cell mui-indexed-list-item">渑池</li>
                <li data-value="mz" data-tags="mianzhu" class="mui-table-view-cell mui-indexed-list-item">绵竹</li>
                <li data-value="my" data-tags="mengyin" class="mui-table-view-cell mui-indexed-list-item">蒙阴</li>
                <li data-value="mzs" data-tags="mengzishi" class="mui-table-view-cell mui-indexed-list-item">蒙自市</li>
                <li data-value="mc" data-tags="mengcheng" class="mui-table-view-cell mui-indexed-list-item">蒙城</li>
                <li data-value="mx" data-tags="menglaxian" class="mui-table-view-cell mui-indexed-list-item">勐腊县</li>
                <li data-value="myx" data-tags="miyixian" class="mui-table-view-cell mui-indexed-list-item">米易县</li>
                <li data-value="mhx" data-tags="minhouxian" class="mui-table-view-cell mui-indexed-list-item">闽侯县</li>
                <li data-value="msx" data-tags="mingshuixian" class="mui-table-view-cell mui-indexed-list-item">明水县</li>
                <li data-value="mh" data-tags="mohe" class="mui-table-view-cell mui-indexed-list-item">漠河</li>
                <li data-value="ml" data-tags="miaoli" class="mui-table-view-cell mui-indexed-list-item">苗栗</li>
                <li data-value="mwx" data-tags="mingwangxing" class="mui-table-view-cell mui-indexed-list-item">冥王星</li>
                <li data-group="N" class="mui-table-view-divider mui-indexed-list-group">N</li>
                <li data-value="nj" data-tags="nanjing" class="mui-table-view-cell mui-indexed-list-item">南京</li>
                <li data-value="nb" data-tags="ningbo" class="mui-table-view-cell mui-indexed-list-item">宁波</li>
                <li data-value="nn" data-tags="nanning" class="mui-table-view-cell mui-indexed-list-item">南宁</li>
                <li data-value="nt" data-tags="nantong" class="mui-table-view-cell mui-indexed-list-item">南通</li>
                <li data-value="nc" data-tags="nanchang" class="mui-table-view-cell mui-indexed-list-item">南昌</li>
                <li data-value="ny" data-tags="nanyang" class="mui-table-view-cell mui-indexed-list-item">南阳</li>
                <li data-value="nd" data-tags="ningde" class="mui-table-view-cell mui-indexed-list-item">宁德</li>
                <li data-value="nc" data-tags="nanchong" class="mui-table-view-cell mui-indexed-list-item">南充</li>
                <li data-value="np" data-tags="nanping" class="mui-table-view-cell mui-indexed-list-item">南平</li>
                <li data-value="nj" data-tags="neijiang" class="mui-table-view-cell mui-indexed-list-item">内江</li>
                <li data-value="nh" data-tags="ninghai" class="mui-table-view-cell mui-indexed-list-item">宁海</li>
                <li data-value="na" data-tags="nanan" class="mui-table-view-cell mui-indexed-list-item">南安</li>
                <li data-value="nx" data-tags="ningxiang" class="mui-table-view-cell mui-indexed-list-item">宁乡</li>
                <li data-value="ns" data-tags="nansha" class="mui-table-view-cell mui-indexed-list-item">南沙</li>
                <li data-value="nh" data-tags="nehe" class="mui-table-view-cell mui-indexed-list-item">讷河</li>
                <li data-value="nx" data-tags="nanxiong" class="mui-table-view-cell mui-indexed-list-item">南雄</li>
                <li data-value="nl" data-tags="nanle" class="mui-table-view-cell mui-indexed-list-item">南乐</li>
                <li data-value="nl" data-tags="nanling" class="mui-table-view-cell mui-indexed-list-item">南陵</li>
                <li data-value="ny" data-tags="ningyang" class="mui-table-view-cell mui-indexed-list-item">宁阳</li>
                <li data-value="ng" data-tags="ningguo" class="mui-table-view-cell mui-indexed-list-item">宁国</li>
                <li data-value="nj" data-tags="ningjin" class="mui-table-view-cell mui-indexed-list-item">宁晋</li>
                <li data-value="nj" data-tags="ningjinnj" class="mui-table-view-cell mui-indexed-list-item">宁津</li>
                <li data-value="nq" data-tags="neiqiu" class="mui-table-view-cell mui-indexed-list-item">内丘</li>
                <li data-value="ng" data-tags="nangong" class="mui-table-view-cell mui-indexed-list-item">南宫</li>
                <li data-value="nh" data-tags="neihuang" class="mui-table-view-cell mui-indexed-list-item">内黄</li>
                <li data-value="nh" data-tags="nanhe" class="mui-table-view-cell mui-indexed-list-item">南和</li>
                <li data-value="nbx" data-tags="nanbuxian" class="mui-table-view-cell mui-indexed-list-item">南部县</li>
                <li data-value="npx" data-tags="nanpixian" class="mui-table-view-cell mui-indexed-list-item">南皮县</li>
                <li data-value="nl" data-tags="ninglingxian" class="mui-table-view-cell mui-indexed-list-item">宁陵</li>
                <li data-value="nzx" data-tags="nanzhengxian" class="mui-table-view-cell mui-indexed-list-item">南郑县</li>
                <li data-value="nlyzzzx" data-tags="ninglangyizuzizhixian" class="mui-table-view-cell mui-indexed-list-item">宁蒗彝族自治县</li>
                <li data-value="njx" data-tags="nenjiangxian" class="mui-table-view-cell mui-indexed-list-item">嫩江县</li>
                <li data-value="nyx" data-tags="ningyuanxian" class="mui-table-view-cell mui-indexed-list-item">宁远县</li>
                <li data-value="nj" data-tags="nujiang" class="mui-table-view-cell mui-indexed-list-item">怒江</li>
                <li data-value="nq" data-tags="naqu" class="mui-table-view-cell mui-indexed-list-item">那曲</li>
                <li data-value="nt" data-tags="nantou" class="mui-table-view-cell mui-indexed-list-item">南投</li>
                <li data-group="P" class="mui-table-view-divider mui-indexed-list-group">P</li>
                <li data-value="pt" data-tags="putian" class="mui-table-view-cell mui-indexed-list-item">莆田</li>
                <li data-value="pj" data-tags="panjin" class="mui-table-view-cell mui-indexed-list-item">盘锦</li>
                <li data-value="pds" data-tags="pingdingshan" class="mui-table-view-cell mui-indexed-list-item">平顶山</li>
                <li data-value="py" data-tags="puyang" class="mui-table-view-cell mui-indexed-list-item">濮阳</li>
                <li data-value="px" data-tags="pingxiang" class="mui-table-view-cell mui-indexed-list-item">萍乡</li>
                <li data-value="pzh" data-tags="panzhihua" class="mui-table-view-cell mui-indexed-list-item">攀枝花</li>
                <li data-value="pe" data-tags="puer" class="mui-table-view-cell mui-indexed-list-item">普洱</li>
                <li data-value="pl" data-tags="pingliang" class="mui-table-view-cell mui-indexed-list-item">平凉</li>
                <li data-value="pz" data-tags="pizhou" class="mui-table-view-cell mui-indexed-list-item">邳州</li>
                <li data-value="ph" data-tags="pinghu" class="mui-table-view-cell mui-indexed-list-item">平湖</li>
                <li data-value="pn" data-tags="puning" class="mui-table-view-cell mui-indexed-list-item">普宁</li>
                <li data-value="pd" data-tags="pingdu" class="mui-table-view-cell mui-indexed-list-item">平度</li>
                <li data-value="pz" data-tags="pengzhou" class="mui-table-view-cell mui-indexed-list-item">彭州</li>
                <li data-value="pl" data-tags="penglai" class="mui-table-view-cell mui-indexed-list-item">蓬莱</li>
                <li data-value="px" data-tags="peixian" class="mui-table-view-cell mui-indexed-list-item">沛县</li>
                <li data-value="py" data-tags="pingyang" class="mui-table-view-cell mui-indexed-list-item">平阳</li>
                <li data-value="py" data-tags="poyang" class="mui-table-view-cell mui-indexed-list-item">鄱阳</li>
                <li data-value="pj" data-tags="pujiang" class="mui-table-view-cell mui-indexed-list-item">浦江</li>
                <li data-value="ps" data-tags="panshi" class="mui-table-view-cell mui-indexed-list-item">磐石</li>
                <li data-value="py" data-tags="pingyuan" class="mui-table-view-cell mui-indexed-list-item">平原</li>
                <li data-value="pt" data-tags="pingtan" class="mui-table-view-cell mui-indexed-list-item">平潭</li>
                <li data-value="pc" data-tags="pucheng" class="mui-table-view-cell mui-indexed-list-item">蒲城</li>
                <li data-value="px" data-tags="panxian" class="mui-table-view-cell mui-indexed-list-item">盘县</li>
                <li data-value="pj" data-tags="pingjiang" class="mui-table-view-cell mui-indexed-list-item">平江</li>
                <li data-value="pyx" data-tags="puyangxian" class="mui-table-view-cell mui-indexed-list-item">濮阳县</li>
                <li data-value="ps" data-tags="pingshan" class="mui-table-view-cell mui-indexed-list-item">平山</li>
                <li data-value="pq" data-tags="pingquan" class="mui-table-view-cell mui-indexed-list-item">平泉</li>
                <li data-value="py" data-tags="pingyi" class="mui-table-view-cell mui-indexed-list-item">平邑</li>
                <li data-value="py" data-tags="pingyu" class="mui-table-view-cell mui-indexed-list-item">平舆</li>
                <li data-value="py" data-tags="pingyao" class="mui-table-view-cell mui-indexed-list-item">平遥</li>
                <li data-value="pg" data-tags="pingguo" class="mui-table-view-cell mui-indexed-list-item">平果</li>
                <li data-value="plx" data-tags="pingluoxian" class="mui-table-view-cell mui-indexed-list-item">平罗县</li>
                <li data-value="pyx" data-tags="pingyinxian" class="mui-table-view-cell mui-indexed-list-item">平阴县</li>
                <li data-value="plx" data-tags="pingluxian" class="mui-table-view-cell mui-indexed-list-item">平陆县</li>
                <li data-value="pcx" data-tags="pingchangxian" class="mui-table-view-cell mui-indexed-list-item">平昌县</li>
                <li data-value="pnx" data-tags="pingnanxian" class="mui-table-view-cell mui-indexed-list-item">平南县</li>
                <li data-value="psmztjzzzx" data-tags="pengshuizizhixian" class="mui-table-view-cell mui-indexed-list-item">彭水苗族土家族自治县</li>
                <li data-value="ph" data-tags="penghu" class="mui-table-view-cell mui-indexed-list-item">澎湖</li>
                <li data-group="Q" class="mui-table-view-divider mui-indexed-list-group">Q</li>
                <li data-value="qd" data-tags="qingdao" class="mui-table-view-cell mui-indexed-list-item">青岛</li>
                <li data-value="qz" data-tags="quanzhou" class="mui-table-view-cell mui-indexed-list-item">泉州</li>
                <li data-value="qhd" data-tags="qinhuangdao" class="mui-table-view-cell mui-indexed-list-item">秦皇岛</li>
                <li data-value="qqhe" data-tags="qiqihaer" class="mui-table-view-cell mui-indexed-list-item">齐齐哈尔</li>
                <li data-value="qz" data-tags="quzhou" class="mui-table-view-cell mui-indexed-list-item">衢州</li>
                <li data-value="qy" data-tags="qingyuan" class="mui-table-view-cell mui-indexed-list-item">清远</li>
                <li data-value="qj" data-tags="qujing" class="mui-table-view-cell mui-indexed-list-item">曲靖</li>
                <li data-value="qth" data-tags="qitaihe" class="mui-table-view-cell mui-indexed-list-item">七台河</li>
                <li data-value="qz" data-tags="qinzhou" class="mui-table-view-cell mui-indexed-list-item">钦州</li>
                <li data-value="qdn" data-tags="qiandongnan" class="mui-table-view-cell mui-indexed-list-item">黔东南</li>
                <li data-value="qy" data-tags="qingyang" class="mui-table-view-cell mui-indexed-list-item">庆阳</li>
                <li data-value="qa" data-tags="qianan" class="mui-table-view-cell mui-indexed-list-item">迁安</li>
                <li data-value="qz" data-tags="qingzhou" class="mui-table-view-cell mui-indexed-list-item">青州</li>
                <li data-value="qd" data-tags="qidong" class="mui-table-view-cell mui-indexed-list-item">启东</li>
                <li data-value="qj" data-tags="qianjiang" class="mui-table-view-cell mui-indexed-list-item">潜江</li>
                <li data-value="qxn" data-tags="qianxinan" class="mui-table-view-cell mui-indexed-list-item">黔西南</li>
                <li data-value="qn" data-tags="qiannan" class="mui-table-view-cell mui-indexed-list-item">黔南</li>
                <li data-value="qh" data-tags="qionghai" class="mui-table-view-cell mui-indexed-list-item">琼海</li>
                <li data-value="qy" data-tags="qinyang" class="mui-table-view-cell mui-indexed-list-item">沁阳</li>
                <li data-value="ql" data-tags="qionglai" class="mui-table-view-cell mui-indexed-list-item">邛崃</li>
                <li data-value="qh" data-tags="qihe" class="mui-table-view-cell mui-indexed-list-item">齐河</li>
                <li data-value="qf" data-tags="qingfeng" class="mui-table-view-cell mui-indexed-list-item">清丰</li>
                <li data-value="qx" data-tags="qixian" class="mui-table-view-cell mui-indexed-list-item">淇县</li>
                <li data-value="qj" data-tags="quanjiao" class="mui-table-view-cell mui-indexed-list-item">全椒</li>
                <li data-value="qx" data-tags="qixia" class="mui-table-view-cell mui-indexed-list-item">栖霞</li>
                <li data-value="qt" data-tags="qingtian" class="mui-table-view-cell mui-indexed-list-item">青田</li>
                <li data-value="qh" data-tags="qinghe" class="mui-table-view-cell mui-indexed-list-item">清河</li>
                <li data-value="qy" data-tags="qingyun" class="mui-table-view-cell mui-indexed-list-item">庆云</li>
                <li data-value="qs" data-tags="qianshan" class="mui-table-view-cell mui-indexed-list-item">潜山</li>
                <li data-value="qx" data-tags="qingxian" class="mui-table-view-cell mui-indexed-list-item">青县</li>
                <li data-value="qdx" data-tags="qidongxian" class="mui-table-view-cell mui-indexed-list-item">祁东县</li>
                <li data-value="qax" data-tags="qinganxian" class="mui-table-view-cell mui-indexed-list-item">庆安县</li>
                <li data-value="qx" data-tags="qixiankaifeng" class="mui-table-view-cell mui-indexed-list-item">杞县</li>
                <li data-value="qgx" data-tags="qinggangxian" class="mui-table-view-cell mui-indexed-list-item">青冈县</li>
                <li data-value="qsx" data-tags="qishanxian" class="mui-table-view-cell mui-indexed-list-item">岐山县</li>
                <li data-value="qz" data-tags="qiongzhong" class="mui-table-view-cell mui-indexed-list-item">琼中</li>
                <li data-value="qyx" data-tags="qingyangxian" class="mui-table-view-cell mui-indexed-list-item">青阳县</li>
                <li data-group="R" class="mui-table-view-divider mui-indexed-list-group">R</li>
                <li data-value="rz" data-tags="rizhao" class="mui-table-view-cell mui-indexed-list-item">日照</li>
                <li data-value="ra" data-tags="ruian" class="mui-table-view-cell mui-indexed-list-item">瑞安</li>
                <li data-value="rc" data-tags="rongcheng" class="mui-table-view-cell mui-indexed-list-item">荣成</li>
                <li data-value="rs" data-tags="rushan" class="mui-table-view-cell mui-indexed-list-item">乳山</li>
                <li data-value="rg" data-tags="rugao" class="mui-table-view-cell mui-indexed-list-item">如皋</li>
                <li data-value="rz" data-tags="ruzhou" class="mui-table-view-cell mui-indexed-list-item">汝州</li>
                <li data-value="rd" data-tags="rudong" class="mui-table-view-cell mui-indexed-list-item">如东</li>
                <li data-value="rh" data-tags="renhuai" class="mui-table-view-cell mui-indexed-list-item">仁怀</li>
                <li data-value="rj" data-tags="ruijin" class="mui-table-view-cell mui-indexed-list-item">瑞金</li>
                <li data-value="rc" data-tags="ruichang" class="mui-table-view-cell mui-indexed-list-item">瑞昌</li>
                <li data-value="rs" data-tags="renshou" class="mui-table-view-cell mui-indexed-list-item">仁寿</li>
                <li data-value="rq" data-tags="renqiu" class="mui-table-view-cell mui-indexed-list-item">任丘</li>
                <li data-value="ry" data-tags="ruyang" class="mui-table-view-cell mui-indexed-list-item">汝阳</li>
                <li data-value="rx" data-tags="renxian" class="mui-table-view-cell mui-indexed-list-item">任县</li>
                <li data-value="rcx" data-tags="ruchengxian" class="mui-table-view-cell mui-indexed-list-item">汝城县</li>
                <li data-value="rx" data-tags="rongxian" class="mui-table-view-cell mui-indexed-list-item">容县</li>
                <li data-value="rcq" data-tags="rongchangqu" class="mui-table-view-cell mui-indexed-list-item">荣昌区</li>
                <li data-value="rkz" data-tags="rikaze" class="mui-table-view-cell mui-indexed-list-item">日喀则</li>
                <li data-group="S" class="mui-table-view-divider mui-indexed-list-group">S</li>
                <li data-value="sh" data-tags="shanghai" class="mui-table-view-cell mui-indexed-list-item">上海</li>
                <li data-value="sz" data-tags="shenzhen" class="mui-table-view-cell mui-indexed-list-item">深圳</li>
                <li data-value="sy" data-tags="shenyang" class="mui-table-view-cell mui-indexed-list-item">沈阳</li>
                <li data-value="sjz" data-tags="shijiazhuang" class="mui-table-view-cell mui-indexed-list-item">石家庄</li>
                <li data-value="sz" data-tags="suzhou" class="mui-table-view-cell mui-indexed-list-item">苏州</li>
                <li data-value="sy" data-tags="sanya" class="mui-table-view-cell mui-indexed-list-item">三亚</li>
                <li data-value="st" data-tags="shantou" class="mui-table-view-cell mui-indexed-list-item">汕头</li>
                <li data-value="sx" data-tags="shaoxing" class="mui-table-view-cell mui-indexed-list-item">绍兴</li>
                <li data-value="sy" data-tags="songyuan" class="mui-table-view-cell mui-indexed-list-item">松原</li>
                <li data-value="sq" data-tags="suqian" class="mui-table-view-cell mui-indexed-list-item">宿迁</li>
                <li data-value="sz" data-tags="suzhousz" class="mui-table-view-cell mui-indexed-list-item">宿州</li>
                <li data-value="sr" data-tags="shangrao" class="mui-table-view-cell mui-indexed-list-item">上饶</li>
                <li data-value="sq" data-tags="shangqiu" class="mui-table-view-cell mui-indexed-list-item">商丘</li>
                <li data-value="sy" data-tags="shiyan" class="mui-table-view-cell mui-indexed-list-item">十堰</li>
                <li data-value="sy" data-tags="shaoyang" class="mui-table-view-cell mui-indexed-list-item">邵阳</li>
                <li data-value="sg" data-tags="shaoguan" class="mui-table-view-cell mui-indexed-list-item">韶关</li>
                <li data-value="sd" data-tags="shunde" class="mui-table-view-cell mui-indexed-list-item">顺德</li>
                <li data-value="sz" data-tags="shuozhou" class="mui-table-view-cell mui-indexed-list-item">朔州</li>
                <li data-value="sp" data-tags="siping" class="mui-table-view-cell mui-indexed-list-item">四平</li>
                <li data-value="sys" data-tags="shuangyashan" class="mui-table-view-cell mui-indexed-list-item">双鸭山</li>
                <li data-value="sh" data-tags="suihua" class="mui-table-view-cell mui-indexed-list-item">绥化</li>
                <li data-value="sm" data-tags="sanming" class="mui-table-view-cell mui-indexed-list-item">三明</li>
                <li data-value="smx" data-tags="sanmenxia" class="mui-table-view-cell mui-indexed-list-item">三门峡</li>
                <li data-value="sz" data-tags="suizhou" class="mui-table-view-cell mui-indexed-list-item">随州</li>
                <li data-value="sw" data-tags="shanwei" class="mui-table-view-cell mui-indexed-list-item">汕尾</li>
                <li data-value="sn" data-tags="suining" class="mui-table-view-cell mui-indexed-list-item">遂宁</li>
                <li data-value="sl" data-tags="shangluo" class="mui-table-view-cell mui-indexed-list-item">商洛</li>
                <li data-value="szs" data-tags="shizuishan" class="mui-table-view-cell mui-indexed-list-item">石嘴山</li>
                <li data-value="shz" data-tags="shihezi" class="mui-table-view-cell mui-indexed-list-item">石河子</li>
                <li data-value="ss" data-tags="shishi" class="mui-table-view-cell mui-indexed-list-item">石狮</li>
                <li data-value="sy" data-tags="shangyu" class="mui-table-view-cell mui-indexed-list-item">上虞</li>
                <li data-value="sg" data-tags="shouguang" class="mui-table-view-cell mui-indexed-list-item">寿光</li>
                <li data-value="sz" data-tags="shengzhou" class="mui-table-view-cell mui-indexed-list-item">嵊州</li>
                <li data-value="sy" data-tags="shuyang" class="mui-table-view-cell mui-indexed-list-item">沭阳</li>
                <li data-value="sy" data-tags="sheyang" class="mui-table-view-cell mui-indexed-list-item">射阳</li>
                <li data-value="sh" data-tags="sanhe" class="mui-table-view-cell mui-indexed-list-item">三河</li>
                <li data-value="sc" data-tags="shucheng" class="mui-table-view-cell mui-indexed-list-item">舒城</li>
                <li data-value="ss" data-tags="shaoshan" class="mui-table-view-cell mui-indexed-list-item">韶山</li>
                <li data-value="sh" data-tags="shahe" class="mui-table-view-cell mui-indexed-list-item">沙河</li>
                <li data-value="sh" data-tags="sihui" class="mui-table-view-cell mui-indexed-list-item">四会</li>
                <li data-value="sz" data-tags="songzi" class="mui-table-view-cell mui-indexed-list-item">松滋</li>
                <li data-value="sl" data-tags="shulan" class="mui-table-view-cell mui-indexed-list-item">舒兰</li>
                <li data-value="sd" data-tags="shaodong" class="mui-table-view-cell mui-indexed-list-item">邵东</li>
                <li data-value="sx" data-tags="suixian" class="mui-table-view-cell mui-indexed-list-item">睢县</li>
                <li data-value="sy" data-tags="siyang" class="mui-table-view-cell mui-indexed-list-item">泗阳</li>
                <li data-value="sw" data-tags="shawan" class="mui-table-view-cell mui-indexed-list-item">沙湾</li>
                <li data-value="sx" data-tags="shexian" class="mui-table-view-cell mui-indexed-list-item">涉县</li>
                <li data-value="sm" data-tags="shenmu" class="mui-table-view-cell mui-indexed-list-item">神木</li>
                <li data-value="sz" data-tags="suizhong" class="mui-table-view-cell mui-indexed-list-item">绥中</li>
                <li data-value="sg" data-tags="shanggao" class="mui-table-view-cell mui-indexed-list-item">上高</li>
                <li data-value="sq" data-tags="shiquan" class="mui-table-view-cell mui-indexed-list-item">石泉</li>
                <li data-value="sh" data-tags="sihong" class="mui-table-view-cell mui-indexed-list-item">泗洪</li>
                <li data-value="sx" data-tags="shanxian" class="mui-table-view-cell mui-indexed-list-item">单县</li>
                <li data-value="sq" data-tags="shenqiu" class="mui-table-view-cell mui-indexed-list-item">沈丘</li>
                <li data-value="sm" data-tags="sanmen" class="mui-table-view-cell mui-indexed-list-item">三门</li>
                <li data-value="sn" data-tags="suiningxian" class="mui-table-view-cell mui-indexed-list-item">睢宁</li>
                <li data-value="sc" data-tags="shangcai" class="mui-table-view-cell mui-indexed-list-item">上蔡</li>
                <li data-value="sc" data-tags="suichang" class="mui-table-view-cell mui-indexed-list-item">遂昌</li>
                <li data-value="sd" data-tags="shidao" class="mui-table-view-cell mui-indexed-list-item">石岛</li>
                <li data-value="sf" data-tags="shifang" class="mui-table-view-cell mui-indexed-list-item">什邡</li>
                <li data-value="sh" data-tags="shanghang" class="mui-table-view-cell mui-indexed-list-item">上杭</li>
                <li data-value="sx" data-tags="songxian" class="mui-table-view-cell mui-indexed-list-item">嵩县</li>
                <li data-value="sh" data-tags="shehong" class="mui-table-view-cell mui-indexed-list-item">射洪</li>
                <li data-value="sh" data-tags="shanghe" class="mui-table-view-cell mui-indexed-list-item">商河</li>
                <li data-value="ss" data-tags="sishui" class="mui-table-view-cell mui-indexed-list-item">泗水</li>
                <li data-value="sq" data-tags="sheqi" class="mui-table-view-cell mui-indexed-list-item">社旗</li>
                <li data-value="sx" data-tags="sixian" class="mui-table-view-cell mui-indexed-list-item">泗县</li>
                <li data-value="szs" data-tags="shenzhoushi" class="mui-table-view-cell mui-indexed-list-item">深州市</li>
                <li data-value="slx" data-tags="shanglinxian" class="mui-table-view-cell mui-indexed-list-item">上林县</li>
                <li data-value="ssx" data-tags="shangshuixian" class="mui-table-view-cell mui-indexed-list-item">商水县</li>
                <li data-value="sf" data-tags="shuangfeng" class="mui-table-view-cell mui-indexed-list-item">双峰</li>
                <li data-value="sc" data-tags="suichuan" class="mui-table-view-cell mui-indexed-list-item">遂川</li>
                <li data-value="sl" data-tags="shangli" class="mui-table-view-cell mui-indexed-list-item">上栗</li>
                <li data-value="scx" data-tags="shachexian" class="mui-table-view-cell mui-indexed-list-item">莎车县</li>
                <li data-value="snx" data-tags="suningxian" class="mui-table-view-cell mui-indexed-list-item">肃宁县</li>
                <li data-value="scx" data-tags="shangchengxian" class="mui-table-view-cell mui-indexed-list-item">商城县</li>
                <li data-value="sz" data-tags="sangzhi" class="mui-table-view-cell mui-indexed-list-item">桑植</li>
                <li data-value="sm" data-tags="shimen" class="mui-table-view-cell mui-indexed-list-item">石门</li>
                <li data-value="ssx" data-tags="shanshanxian" class="mui-table-view-cell mui-indexed-list-item">鄯善县</li>
                <li data-value="sdx" data-tags="suidexian" class="mui-table-view-cell mui-indexed-list-item">绥德县</li>
                <li data-value="sx" data-tags="shaxian" class="mui-table-view-cell mui-indexed-list-item">沙县</li>
                <li data-value="szx" data-tags="shenzexian" class="mui-table-view-cell mui-indexed-list-item">深泽县</li>
                <li data-value="sz" data-tags="shizhu" class="mui-table-view-cell mui-indexed-list-item">石柱</li>
                <li data-value="sw" data-tags="shaowu" class="mui-table-view-cell mui-indexed-list-item">邵武</li>
                <li data-value="sx" data-tags="shouxian" class="mui-table-view-cell mui-indexed-list-item">寿县</li>
                <li data-value="stx" data-tags="santaixian" class="mui-table-view-cell mui-indexed-list-item">三台县</li>
                <li data-value="sdx" data-tags="shandanxian" class="mui-table-view-cell mui-indexed-list-item">山丹县</li>
                <li data-value="szq" data-tags="shanzhouqu" class="mui-table-view-cell mui-indexed-list-item">陕州区</li>
                <li data-value="snx" data-tags="suiningxiansnx" class="mui-table-view-cell mui-indexed-list-item">绥宁县</li>
                <li data-value="sc" data-tags="shuangcheng" class="mui-table-view-cell mui-indexed-list-item">双城</li>
                <li data-value="sp" data-tags="suiping" class="mui-table-view-cell mui-indexed-list-item">遂平</li>
                <li data-value="sy" data-tags="shaya" class="mui-table-view-cell mui-indexed-list-item">沙雅</li>
                <li data-value="sx" data-tags="sanxia" class="mui-table-view-cell mui-indexed-list-item">三峡</li>
                <li data-value="sn" data-tags="shannan" class="mui-table-view-cell mui-indexed-list-item">山南</li>
                <li data-value="snj" data-tags="shennongjia" class="mui-table-view-cell mui-indexed-list-item">神农架</li>
                <li data-value="sqs" data-tags="sanqingshan" class="mui-table-view-cell mui-indexed-list-item">三清山</li>
                <li data-group="T" class="mui-table-view-divider mui-indexed-list-group">T</li>
                <li data-value="tj" data-tags="tianjin" class="mui-table-view-cell mui-indexed-list-item">天津</li>
                <li data-value="ty" data-tags="taiyuan" class="mui-table-view-cell mui-indexed-list-item">太原</li>
                <li data-value="ts" data-tags="tangshan" class="mui-table-view-cell mui-indexed-list-item">唐山</li>
                <li data-value="tz" data-tags="taizhou" class="mui-table-view-cell mui-indexed-list-item">泰州</li>
                <li data-value="tz" data-tags="taizhoutz" class="mui-table-view-cell mui-indexed-list-item">台州</li>
                <li data-value="ta" data-tags="taian" class="mui-table-view-cell mui-indexed-list-item">泰安</li>
                <li data-value="tx" data-tags="tongxiang" class="mui-table-view-cell mui-indexed-list-item">桐乡</li>
                <li data-value="tc" data-tags="taicang" class="mui-table-view-cell mui-indexed-list-item">太仓</li>
                <li data-value="tl" data-tags="tongliao" class="mui-table-view-cell mui-indexed-list-item">通辽</li>
                <li data-value="tl" data-tags="tieling" class="mui-table-view-cell mui-indexed-list-item">铁岭</li>
                <li data-value="th" data-tags="tonghua" class="mui-table-view-cell mui-indexed-list-item">通化</li>
                <li data-value="tl" data-tags="tongling" class="mui-table-view-cell mui-indexed-list-item">铜陵</li>
                <li data-value="tr" data-tags="tongrendiqu" class="mui-table-view-cell mui-indexed-list-item">铜仁</li>
                <li data-value="tc" data-tags="tongchuan" class="mui-table-view-cell mui-indexed-list-item">铜川</li>
                <li data-value="ts" data-tags="tianshui" class="mui-table-view-cell mui-indexed-list-item">天水</li>
                <li data-value="ts" data-tags="taishan" class="mui-table-view-cell mui-indexed-list-item">台山</li>
                <li data-value="tx" data-tags="taixing" class="mui-table-view-cell mui-indexed-list-item">泰兴</li>
                <li data-value="tz" data-tags="tengzhou" class="mui-table-view-cell mui-indexed-list-item">滕州</li>
                <li data-value="tm" data-tags="tianmen" class="mui-table-view-cell mui-indexed-list-item">天门</li>
                <li data-value="tc" data-tags="tianchang" class="mui-table-view-cell mui-indexed-list-item">天长</li>
                <li data-value="tl" data-tags="tonglu" class="mui-table-view-cell mui-indexed-list-item">桐庐</li>
                <li data-value="tn" data-tags="taonan" class="mui-table-view-cell mui-indexed-list-item">洮南</li>
                <li data-value="tc" data-tags="tongcheng" class="mui-table-view-cell mui-indexed-list-item">桐城</li>
                <li data-value="tq" data-tags="taiqian" class="mui-table-view-cell mui-indexed-list-item">台前</li>
                <li data-value="th" data-tags="taihe" class="mui-table-view-cell mui-indexed-list-item">太和</li>
                <li data-value="tt" data-tags="tiantai" class="mui-table-view-cell mui-indexed-list-item">天台</li>
                <li data-value="tg" data-tags="taigu" class="mui-table-view-cell mui-indexed-list-item">太谷</li>
                <li data-value="tx" data-tags="tengxian" class="mui-table-view-cell mui-indexed-list-item">藤县</li>
                <li data-value="ty" data-tags="tangyin" class="mui-table-view-cell mui-indexed-list-item">汤阴</li>
                <li data-value="tmtyq" data-tags="tumoteyouqi" class="mui-table-view-cell mui-indexed-list-item">土默特右旗</li>
                <li data-value="tc" data-tags="tancheng" class="mui-table-view-cell mui-indexed-list-item">郯城</li>
                <li data-value="tl" data-tags="tongliang" class="mui-table-view-cell mui-indexed-list-item">铜梁</li>
                <li data-value="ta" data-tags="tongan" class="mui-table-view-cell mui-indexed-list-item">同安</li>
                <li data-value="ty" data-tags="taoyuanxian" class="mui-table-view-cell mui-indexed-list-item">桃源</li>
                <li data-value="thx" data-tags="taihexian" class="mui-table-view-cell mui-indexed-list-item">泰和县</li>
                <li data-value="tg" data-tags="tonggu" class="mui-table-view-cell mui-indexed-list-item">铜鼓</li>
                <li data-value="tdx" data-tags="tiandongxian" class="mui-table-view-cell mui-indexed-list-item">田东县</li>
                <li data-value="tkx" data-tags="taikangxian" class="mui-table-view-cell mui-indexed-list-item">太康县</li>
                <li data-value="txx" data-tags="tongxuxian" class="mui-table-view-cell mui-indexed-list-item">通许县</li>
                <li data-value="thx" data-tags="tonghaixian" class="mui-table-view-cell mui-indexed-list-item">通海县</li>
                <li data-value="tyx" data-tags="tongyuxian" class="mui-table-view-cell mui-indexed-list-item">通榆县</li>
                <li data-value="th" data-tags="tanghe" class="mui-table-view-cell mui-indexed-list-item">唐河</li>
                <li data-value="txx" data-tags="tongxinxian" class="mui-table-view-cell mui-indexed-list-item">同心县</li>
                <li data-value="tcs" data-tags="tachengshi" class="mui-table-view-cell mui-indexed-list-item">塔城市</li>
                <li data-value="tw" data-tags="taiwan" class="mui-table-view-cell mui-indexed-list-item">台湾</li>
                <li data-value="tjx" data-tags="tongjiangxian" class="mui-table-view-cell mui-indexed-list-item">通江县</li>
                <li data-value="thx" data-tags="tonghexian" class="mui-table-view-cell mui-indexed-list-item">通河县</li>
                <li data-value="tlf" data-tags="tulufan" class="mui-table-view-cell mui-indexed-list-item">吐鲁番</li>
                <li data-value="tc" data-tags="tacheng" class="mui-table-view-cell mui-indexed-list-item">塔城</li>
                <li data-value="tb" data-tags="taibei" class="mui-table-view-cell mui-indexed-list-item">台北</li>
                <li data-value="tc" data-tags="tengchong" class="mui-table-view-cell mui-indexed-list-item">腾冲</li>
                <li data-value="tz" data-tags="taizhong" class="mui-table-view-cell mui-indexed-list-item">台中</li>
                <li data-value="tn" data-tags="tainan" class="mui-table-view-cell mui-indexed-list-item">台南</li>
                <li data-value="td" data-tags="taidong" class="mui-table-view-cell mui-indexed-list-item">台东</li>
                <li data-value="ty" data-tags="taoyuan" class="mui-table-view-cell mui-indexed-list-item">桃园</li>
                <li data-group="W" class="mui-table-view-divider mui-indexed-list-group">W</li>
                <li data-value="wh" data-tags="wuhan" class="mui-table-view-cell mui-indexed-list-item">武汉</li>
                <li data-value="wx" data-tags="wuxi" class="mui-table-view-cell mui-indexed-list-item">无锡</li>
                <li data-value="wz" data-tags="wenzhou" class="mui-table-view-cell mui-indexed-list-item">温州</li>
                <li data-value="wh" data-tags="wuhu" class="mui-table-view-cell mui-indexed-list-item">芜湖</li>
                <li data-value="wf" data-tags="weifang" class="mui-table-view-cell mui-indexed-list-item">潍坊</li>
                <li data-value="wh" data-tags="weihai" class="mui-table-view-cell mui-indexed-list-item">威海</li>
                <li data-value="wlmq" data-tags="wulumuqi" class="mui-table-view-cell mui-indexed-list-item">乌鲁木齐</li>
                <li data-value="wn" data-tags="weinan" class="mui-table-view-cell mui-indexed-list-item">渭南</li>
                <li data-value="wj" data-tags="wujiang" class="mui-table-view-cell mui-indexed-list-item">吴江</li>
                <li data-value="wl" data-tags="wenling" class="mui-table-view-cell mui-indexed-list-item">温岭</li>
                <li data-value="wh" data-tags="wuhai" class="mui-table-view-cell mui-indexed-list-item">乌海</li>
                <li data-value="wlcb" data-tags="wulanchabu" class="mui-table-view-cell mui-indexed-list-item">乌兰察布</li>
                <li data-value="wz" data-tags="wuzhou" class="mui-table-view-cell mui-indexed-list-item">梧州</li>
                <li data-value="ww" data-tags="wuwei" class="mui-table-view-cell mui-indexed-list-item">武威</li>
                <li data-value="wz" data-tags="wanzhou" class="mui-table-view-cell mui-indexed-list-item">万州</li>
                <li data-value="wa" data-tags="wuan" class="mui-table-view-cell mui-indexed-list-item">武安</li>
                <li data-value="wd" data-tags="wendeng" class="mui-table-view-cell mui-indexed-list-item">文登</li>
                <li data-value="wc" data-tags="wuchuan" class="mui-table-view-cell mui-indexed-list-item">吴川</li>
                <li data-value="wfd" data-tags="wafangdian" class="mui-table-view-cell mui-indexed-list-item">瓦房店</li>
                <li data-value="ws" data-tags="wenshan" class="mui-table-view-cell mui-indexed-list-item">文山</li>
                <li data-value="wz" data-tags="wuzhong" class="mui-table-view-cell mui-indexed-list-item">吴忠</li>
                <li data-value="wys" data-tags="wuyishan" class="mui-table-view-cell mui-indexed-list-item">武夷山</li>
                <li data-value="wy" data-tags="wuyuan" class="mui-table-view-cell mui-indexed-list-item">婺源</li>
                <li data-value="wc" data-tags="wenchang" class="mui-table-view-cell mui-indexed-list-item">文昌</li>
                <li data-value="wx" data-tags="wuxue" class="mui-table-view-cell mui-indexed-list-item">武穴</li>
                <li data-value="wn" data-tags="wanning" class="mui-table-view-cell mui-indexed-list-item">万宁</li>
                <li data-value="wg" data-tags="wugang" class="mui-table-view-cell mui-indexed-list-item">舞钢</li>
                <li data-value="wx" data-tags="wenxian" class="mui-table-view-cell mui-indexed-list-item">温县</li>
                <li data-value="w" data-tags="wuzhi" class="mui-table-view-cell mui-indexed-list-item">武陟</li>
                <li data-value="ws" data-tags="wusu" class="mui-table-view-cell mui-indexed-list-item">乌苏</li>
                <li data-value="ww" data-tags="wuweiww" class="mui-table-view-cell mui-indexed-list-item">无为</li>
                <li data-value="whx" data-tags="wuhuxian" class="mui-table-view-cell mui-indexed-list-item">芜湖县</li>
                <li data-value="wh" data-tags="weihui" class="mui-table-view-cell mui-indexed-list-item">卫辉</li>
                <li data-value="wltqq" data-tags="wltqq" class="mui-table-view-cell mui-indexed-list-item">乌拉特前旗</li>
                <li data-value="ws" data-tags="weishan" class="mui-table-view-cell mui-indexed-list-item">微山</li>
                <li data-value="ws" data-tags="wenshang" class="mui-table-view-cell mui-indexed-list-item">汶上</li>
                <li data-value="wc" data-tags="wucheng" class="mui-table-view-cell mui-indexed-list-item">武城</li>
                <li data-value="wc" data-tags="weichang" class="mui-table-view-cell mui-indexed-list-item">围场</li>
                <li data-value="wy" data-tags="wuyi" class="mui-table-view-cell mui-indexed-list-item">武义</li>
                <li data-value="wm" data-tags="wuming" class="mui-table-view-cell mui-indexed-list-item">武鸣</li>
                <li data-value="wn" data-tags="weining" class="mui-table-view-cell mui-indexed-list-item">威宁</li>
                <li data-value="wy" data-tags="wuyang" class="mui-table-view-cell mui-indexed-list-item">舞阳</li>
                <li data-value="wj" data-tags="wuji" class="mui-table-view-cell mui-indexed-list-item">无极</li>
                <li data-value="wr" data-tags="wanrong" class="mui-table-view-cell mui-indexed-list-item">万荣</li>
                <li data-value="wz" data-tags="wanzai" class="mui-table-view-cell mui-indexed-list-item">万载</li>
                <li data-value="wx" data-tags="weixian" class="mui-table-view-cell mui-indexed-list-item">威县</li>
                <li data-value="wpx" data-tags="wupingxian" class="mui-table-view-cell mui-indexed-list-item">武平县</li>
                <li data-value="wsx" data-tags="weishixian" class="mui-table-view-cell mui-indexed-list-item">尉氏县</li>
                <li data-value="wlx" data-tags="wulongxian" class="mui-table-view-cell mui-indexed-list-item">武隆县</li>
                <li data-value="wcs" data-tags="wuchangshi" class="mui-table-view-cell mui-indexed-list-item">五常市</li>
                <li data-value="wcx" data-tags="wangcangxian" class="mui-table-view-cell mui-indexed-list-item">旺苍县</li>
                <li data-value="wkx" data-tags="wangkuixian" class="mui-table-view-cell mui-indexed-list-item">望奎县</li>
                <li data-value="wgs" data-tags="wugangshi" class="mui-table-view-cell mui-indexed-list-item">武冈市</li>
                <li data-value="wds" data-tags="wudangshan" class="mui-table-view-cell mui-indexed-list-item">武当山</li>
                <li data-value="wz" data-tags="wuzhen" class="mui-table-view-cell mui-indexed-list-item">乌镇</li>
                <li data-group="X" class="mui-table-view-divider mui-indexed-list-group">X</li>
                <li data-value="xa" data-tags="xian" class="mui-table-view-cell mui-indexed-list-item">西安</li>
                <li data-value="xm" data-tags="xiamen" class="mui-table-view-cell mui-indexed-list-item">厦门</li>
                <li data-value="xz" data-tags="xuzhou" class="mui-table-view-cell mui-indexed-list-item">徐州</li>
                <li data-value="xy" data-tags="xiangyang" class="mui-table-view-cell mui-indexed-list-item">襄阳</li>
                <li data-value="xx" data-tags="xinxiang" class="mui-table-view-cell mui-indexed-list-item">新乡</li>
                <li data-value="xt" data-tags="xingtai" class="mui-table-view-cell mui-indexed-list-item">邢台</li>
                <li data-value="xc" data-tags="xuancheng" class="mui-table-view-cell mui-indexed-list-item">宣城</li>
                <li data-value="xc" data-tags="xuchang" class="mui-table-view-cell mui-indexed-list-item">许昌</li>
                <li data-value="xy" data-tags="xinyang" class="mui-table-view-cell mui-indexed-list-item">信阳</li>
                <li data-value="xg" data-tags="xiaogan" class="mui-table-view-cell mui-indexed-list-item">孝感</li>
                <li data-value="xt" data-tags="xiangtan" class="mui-table-view-cell mui-indexed-list-item">湘潭</li>
                <li data-value="xy" data-tags="xianyang" class="mui-table-view-cell mui-indexed-list-item">咸阳</li>
                <li data-value="xn" data-tags="xining" class="mui-table-view-cell mui-indexed-list-item">西宁</li>
                <li data-value="xz" data-tags="xinzhou" class="mui-table-view-cell mui-indexed-list-item">忻州</li>
                <li data-value="xam" data-tags="xinganmeng" class="mui-table-view-cell mui-indexed-list-item">兴安盟</li>
                <li data-value="xy" data-tags="xinyu" class="mui-table-view-cell mui-indexed-list-item">新余</li>
                <li data-value="xn" data-tags="xianning" class="mui-table-view-cell mui-indexed-list-item">咸宁</li>
                <li data-value="xsbn" data-tags="xishuangbanna" class="mui-table-view-cell mui-indexed-list-item">西双版纳</li>
                <li data-value="xt" data-tags="xiantao" class="mui-table-view-cell mui-indexed-list-item">仙桃</li>
                <li data-value="xh" data-tags="xinghua" class="mui-table-view-cell mui-indexed-list-item">兴化</li>
                <li data-value="xt" data-tags="xintai" class="mui-table-view-cell mui-indexed-list-item">新泰</li>
                <li data-value="xj" data-tags="xinji" class="mui-table-view-cell mui-indexed-list-item">辛集</li>
                <li data-value="xy" data-tags="xinyi" class="mui-table-view-cell mui-indexed-list-item">新沂</li>
                <li data-value="xz" data-tags="xinzheng" class="mui-table-view-cell mui-indexed-list-item">新郑</li>
                <li data-value="xm" data-tags="xinmi" class="mui-table-view-cell mui-indexed-list-item">新密</li>
                <li data-value="xy" data-tags="xinyixy" class="mui-table-view-cell mui-indexed-list-item">信宜</li>
                <li data-value="xlgl" data-tags="xilinguolemeng" class="mui-table-view-cell mui-indexed-list-item">锡林郭勒</li>
                <li data-value="xx" data-tags="xiangxi" class="mui-table-view-cell mui-indexed-list-item">湘西</li>
                <li data-value="xy" data-tags="xiangyin" class="mui-table-view-cell mui-indexed-list-item">湘阴</li>
                <li data-value="xs" data-tags="xiangshui" class="mui-table-view-cell mui-indexed-list-item">响水</li>
                <li data-value="xy" data-tags="xingyang" class="mui-table-view-cell mui-indexed-list-item">荥阳</li>
                <li data-value="xn" data-tags="xingning" class="mui-table-view-cell mui-indexed-list-item">兴宁</li>
                <li data-value="xm" data-tags="xinmin" class="mui-table-view-cell mui-indexed-list-item">新民</li>
                <li data-value="xc" data-tags="xiangcheng" class="mui-table-view-cell mui-indexed-list-item">项城</li>
                <li data-value="xy" data-tags="xiaoyi" class="mui-table-view-cell mui-indexed-list-item">孝义</li>
                <li data-value="xx" data-tags="xiangxiang" class="mui-table-view-cell mui-indexed-list-item">湘乡</li>
                <li data-value="xc" data-tags="xingcheng" class="mui-table-view-cell mui-indexed-list-item">兴城</li>
                <li data-value="xp" data-tags="xingping" class="mui-table-view-cell mui-indexed-list-item">兴平</li>
                <li data-value="xs" data-tags="xiangshan" class="mui-table-view-cell mui-indexed-list-item">象山</li>
                <li data-value="xw" data-tags="xiuwu" class="mui-table-view-cell mui-indexed-list-item">修武</li>
                <li data-value="xj" data-tags="xiajin" class="mui-table-view-cell mui-indexed-list-item">夏津</li>
                <li data-value="xh" data-tags="xinhua" class="mui-table-view-cell mui-indexed-list-item">新化</li>
                <li data-value="xj" data-tags="xianju" class="mui-table-view-cell mui-indexed-list-item">仙居</li>
                <li data-value="xy" data-tags="xiangyuan" class="mui-table-view-cell mui-indexed-list-item">襄垣</li>
                <li data-value="xw" data-tags="xuanwei" class="mui-table-view-cell mui-indexed-list-item">宣威</li>
                <li data-value="xp" data-tags="xiapu" class="mui-table-view-cell mui-indexed-list-item">霞浦</li>
                <li data-value="xa" data-tags="xinan" class="mui-table-view-cell mui-indexed-list-item">新安</li>
                <li data-value="xxx" data-tags="xinxiangxian" class="mui-table-view-cell mui-indexed-list-item">新乡县</li>
                <li data-value="xy" data-tags="xuyi" class="mui-table-view-cell mui-indexed-list-item">盱眙</li>
                <li data-value="xw" data-tags="xuwen" class="mui-table-view-cell mui-indexed-list-item">徐闻</li>
                <li data-value="xy" data-tags="xiayi" class="mui-table-view-cell mui-indexed-list-item">夏邑</li>
                <li data-value="jx" data-tags="xunxian" class="mui-table-view-cell mui-indexed-list-item">浚县</li>
                <li data-value="xx" data-tags="xixiang" class="mui-table-view-cell mui-indexed-list-item">西乡</li>
                <li data-value="xp" data-tags="xiping" class="mui-table-view-cell mui-indexed-list-item">西平</li>
                <li data-value="xl" data-tags="xinle" class="mui-table-view-cell mui-indexed-list-item">新乐</li>
                <li data-value="xc" data-tags="xinchang" class="mui-table-view-cell mui-indexed-list-item">新昌</li>
                <li data-value="xc" data-tags="xuecheng" class="mui-table-view-cell mui-indexed-list-item">薛城</li>
                <li data-value="xh" data-tags="xihua" class="mui-table-view-cell mui-indexed-list-item">西华</li>
                <li data-value="xs" data-tags="xishui" class="mui-table-view-cell mui-indexed-list-item">浠水</li>
                <li data-value="xh" data-tags="xianghe" class="mui-table-view-cell mui-indexed-list-item">香河</li>
                <li data-value="xf" data-tags="xinfeng" class="mui-table-view-cell mui-indexed-list-item">信丰</li>
                <li data-value="xc" data-tags="xincai" class="mui-table-view-cell mui-indexed-list-item">新蔡</li>
                <li data-value="xp" data-tags="xupu" class="mui-table-view-cell mui-indexed-list-item">溆浦</li>
                <li data-value="xc" data-tags="xichuan" class="mui-table-view-cell mui-indexed-list-item">淅川</li>
                <li data-value="xg" data-tags="xingan" class="mui-table-view-cell mui-indexed-list-item">新干</li>
                <li data-value="xgx" data-tags="xingguoxian" class="mui-table-view-cell mui-indexed-list-item">兴国县</li>
                <li data-value="xt" data-tags="xintian" class="mui-table-view-cell mui-indexed-list-item">新田</li>
                <li data-value="xwx" data-tags="xunwuxian" class="mui-table-view-cell mui-indexed-list-item">寻乌县</li>
                <li data-value="xyx" data-tags="xiangyunxian" class="mui-table-view-cell mui-indexed-list-item">祥云县</li>
                <li data-value="xcx" data-tags="xiangchengxian" class="mui-table-view-cell mui-indexed-list-item">襄城县</li>
                <li data-value="xn" data-tags="xinning" class="mui-table-view-cell mui-indexed-list-item">新宁</li>
                <li data-value="xx" data-tags="xianxian" class="mui-table-view-cell mui-indexed-list-item">献县</li>
                <li data-value="xzq" data-tags="xinzhouqu" class="mui-table-view-cell mui-indexed-list-item">新洲区</li>
                <li data-value="xstjzmzzzx" data-tags="xiushantujiazumiaozuzizh" class="mui-table-view-cell mui-indexed-list-item">秀山土家族苗族自治县</li>
                <li data-value="xy" data-tags="xinye" class="mui-table-view-cell mui-indexed-list-item">新野</li>
                <li data-value="xyx" data-tags="xianyouxian" class="mui-table-view-cell mui-indexed-list-item">仙游县</li>
                <li data-value="xjx" data-tags="xinjinxian" class="mui-table-view-cell mui-indexed-list-item">新津县</li>
                <li data-value="xyx" data-tags="xunyangxian" class="mui-table-view-cell mui-indexed-list-item">旬阳县</li>
                <li data-value="xcx" data-tags="xiaochangxian" class="mui-table-view-cell mui-indexed-list-item">孝昌县</li>
                <li data-value="xx" data-tags="xixian" class="mui-table-view-cell mui-indexed-list-item">息县</li>
                <li data-value="xg" data-tags="xianggang" class="mui-table-view-cell mui-indexed-list-item">香港</li>
                <li data-value="xgll" data-tags="xianggelila" class="mui-table-view-cell mui-indexed-list-item">香格里拉</li>
                <li data-value="xt" data-tags="xitang" class="mui-table-view-cell mui-indexed-list-item">西塘</li>
                <li data-value="xb" data-tags="xinbei" class="mui-table-view-cell mui-indexed-list-item">新北</li>
                <li data-value="xzs" data-tags="xinzhushi" class="mui-table-view-cell mui-indexed-list-item">新竹市</li>
                <li data-group="Y" class="mui-table-view-divider mui-indexed-list-group">Y</li>
                <li data-value="yt" data-tags="yantai" class="mui-table-view-cell mui-indexed-list-item">烟台</li>
                <li data-value="yz" data-tags="yangzhou" class="mui-table-view-cell mui-indexed-list-item">扬州</li>
                <li data-value="yc" data-tags="yancheng" class="mui-table-view-cell mui-indexed-list-item">盐城</li>
                <li data-value="yc" data-tags="yichang" class="mui-table-view-cell mui-indexed-list-item">宜昌</li>
                <li data-value="yy" data-tags="yueyang" class="mui-table-view-cell mui-indexed-list-item">岳阳</li>
                <li data-value="yc" data-tags="yinchuan" class="mui-table-view-cell mui-indexed-list-item">银川</li>
                <li data-value="yc" data-tags="yuncheng" class="mui-table-view-cell mui-indexed-list-item">运城</li>
                <li data-value="yk" data-tags="yingkou" class="mui-table-view-cell mui-indexed-list-item">营口</li>
                <li data-value="yc" data-tags="yichun" class="mui-table-view-cell mui-indexed-list-item">宜春</li>
                <li data-value="yy" data-tags="yiyang" class="mui-table-view-cell mui-indexed-list-item">益阳</li>
                <li data-value="yj" data-tags="yangjiang" class="mui-table-view-cell mui-indexed-list-item">阳江</li>
                <li data-value="yl" data-tags="yulin" class="mui-table-view-cell mui-indexed-list-item">玉林</li>
                <li data-value="yb" data-tags="yibin" class="mui-table-view-cell mui-indexed-list-item">宜宾</li>
                <li data-value="yl" data-tags="yulinyl" class="mui-table-view-cell mui-indexed-list-item">榆林</li>
                <li data-value="yw" data-tags="yiwu" class="mui-table-view-cell mui-indexed-list-item">义乌</li>
                <li data-value="yx" data-tags="yixing" class="mui-table-view-cell mui-indexed-list-item">宜兴</li>
                <li data-value="yy" data-tags="yuyao" class="mui-table-view-cell mui-indexed-list-item">余姚</li>
                <li data-value="yq" data-tags="yueqing" class="mui-table-view-cell mui-indexed-list-item">乐清</li>
                <li data-value="yq" data-tags="yangquan" class="mui-table-view-cell mui-indexed-list-item">阳泉</li>
                <li data-value="yb" data-tags="yanbian" class="mui-table-view-cell mui-indexed-list-item">延边</li>
                <li data-value="yt" data-tags="yingtan" class="mui-table-view-cell mui-indexed-list-item">鹰潭</li>
                <li data-value="yz" data-tags="yongzhou" class="mui-table-view-cell mui-indexed-list-item">永州</li>
                <li data-value="yf" data-tags="yunfu" class="mui-table-view-cell mui-indexed-list-item">云浮</li>
                <li data-value="yx" data-tags="yuxi" class="mui-table-view-cell mui-indexed-list-item">玉溪</li>
                <li data-value="ya" data-tags="yanan" class="mui-table-view-cell mui-indexed-list-item">延安</li>
                <li data-value="yz" data-tags="yanzhou" class="mui-table-view-cell mui-indexed-list-item">兖州</li>
                <li data-value="yk" data-tags="yongkang" class="mui-table-view-cell mui-indexed-list-item">永康</li>
                <li data-value="yd" data-tags="yingde" class="mui-table-view-cell mui-indexed-list-item">英德</li>
                <li data-value="yz" data-tags="yizheng" class="mui-table-view-cell mui-indexed-list-item">仪征</li>
                <li data-value="yc" data-tags="yongcheng" class="mui-table-view-cell mui-indexed-list-item">永城</li>
                <li data-value="yz" data-tags="yuzhou" class="mui-table-view-cell mui-indexed-list-item">禹州</li>
                <li data-value="yn" data-tags="yining" class="mui-table-view-cell mui-indexed-list-item">伊宁</li>
                <li data-value="yc" data-tags="yongchuan" class="mui-table-view-cell mui-indexed-list-item">永川</li>
                <li data-value="ya" data-tags="yaan" class="mui-table-view-cell mui-indexed-list-item">雅安</li>
                <li data-value="ys" data-tags="yangshuo" class="mui-table-view-cell mui-indexed-list-item">阳朔</li>
                <li data-value="yc" data-tags="yichuan" class="mui-table-view-cell mui-indexed-list-item">伊川</li>
                <li data-value="ys" data-tags="yanshi" class="mui-table-view-cell mui-indexed-list-item">偃师</li>
                <li data-value="yz" data-tags="yangzhong" class="mui-table-view-cell mui-indexed-list-item">扬中</li>
                <li data-value="yj" data-tags="yongji" class="mui-table-view-cell mui-indexed-list-item">永济</li>
                <li data-value="yc" data-tags="yucheng" class="mui-table-view-cell mui-indexed-list-item">禹城</li>
                <li data-value="yc" data-tags="yicheng" class="mui-table-view-cell mui-indexed-list-item">宜城</li>
                <li data-value="yp" data-tags="yuanping" class="mui-table-view-cell mui-indexed-list-item">原平</li>
                <li data-value="yd" data-tags="yidu" class="mui-table-view-cell mui-indexed-list-item">宜都</li>
                <li data-value="yj" data-tags="yuanjiang" class="mui-table-view-cell mui-indexed-list-item">沅江</li>
                <li data-value="yh" data-tags="yuhuan" class="mui-table-view-cell mui-indexed-list-item">玉环</li>
                <li data-value="yn" data-tags="yongnian" class="mui-table-view-cell mui-indexed-list-item">永年</li>
                <li data-value="yc" data-tags="yangcheng" class="mui-table-view-cell mui-indexed-list-item">阳城</li>
                <li data-value="yy" data-tags="yunyang" class="mui-table-view-cell mui-indexed-list-item">云阳</li>
                <li data-value="yx" data-tags="yexian" class="mui-table-view-cell mui-indexed-list-item">叶县</li>
                <li data-value="yx" data-tags="yixian" class="mui-table-view-cell mui-indexed-list-item">易县</li>
                <li data-value="yy" data-tags="yiyangyy" class="mui-table-view-cell mui-indexed-list-item">宜阳</li>
                <li data-value="yl" data-tags="yanliang" class="mui-table-view-cell mui-indexed-list-item">阎良</li>
                <li data-value="yy" data-tags="yuanyang" class="mui-table-view-cell mui-indexed-list-item">原阳</li>
                <li data-value="yc" data-tags="yuchengxian" class="mui-table-view-cell mui-indexed-list-item">虞城</li>
                <li data-value="ys" data-tags="yushan" class="mui-table-view-cell mui-indexed-list-item">玉山</li>
                <li data-value="yg" data-tags="yanggu" class="mui-table-view-cell mui-indexed-list-item">阳谷</li>
                <li data-value="yc" data-tags="yunchengxian" class="mui-table-view-cell mui-indexed-list-item">郓城</li>
                <li data-value="yjhlq" data-tags="yijinhuoluoqi" class="mui-table-view-cell mui-indexed-list-item">伊金霍洛旗</li>
                <li data-value="yl" data-tags="yangling" class="mui-table-view-cell mui-indexed-list-item">杨凌</li>
                <li data-value="ys" data-tags="yishui" class="mui-table-view-cell mui-indexed-list-item">沂水</li>
                <li data-value="yn" data-tags="yinan" class="mui-table-view-cell mui-indexed-list-item">沂南</li>
                <li data-value="yd" data-tags="yudu" class="mui-table-view-cell mui-indexed-list-item">于都</li>
                <li data-value="yf" data-tags="yifeng" class="mui-table-view-cell mui-indexed-list-item">宜丰</li>
                <li data-value="ysx" data-tags="yingshanxian" class="mui-table-view-cell mui-indexed-list-item">营山县</li>
                <li data-value="ya" data-tags="yongan" class="mui-table-view-cell mui-indexed-list-item">永安</li>
                <li data-value="yl" data-tags="yanling" class="mui-table-view-cell mui-indexed-list-item">鄢陵</li>
                <li data-value="yf" data-tags="yongfeng" class="mui-table-view-cell mui-indexed-list-item">永丰</li>
                <li data-value="yx" data-tags="yongxin" class="mui-table-view-cell mui-indexed-list-item">永新</li>
                <li data-value="yxx" data-tags="yongxingxian" class="mui-table-view-cell mui-indexed-list-item">永兴县</li>
                <li data-value="yx" data-tags="youxian" class="mui-table-view-cell mui-indexed-list-item">攸县</li>
                <li data-value="ysx" data-tags="yongshunxian" class="mui-table-view-cell mui-indexed-list-item">永顺县</li>
                <li data-value="ymx" data-tags="yuminxian" class="mui-table-view-cell mui-indexed-list-item">裕民县</li>
                <li data-value="yytjzmzzzx" data-tags="youyangtujiazumiaozuzizh" class="mui-table-view-cell mui-indexed-list-item">酉阳土家族苗族自治县</li>
                <li data-value="yx" data-tags="yingxian" class="mui-table-view-cell mui-indexed-list-item">应县</li>
                <li data-value="ysx" data-tags="yangshanxian" class="mui-table-view-cell mui-indexed-list-item">阳山县</li>
                <li data-value="yss" data-tags="yushushi" class="mui-table-view-cell mui-indexed-list-item">榆树市</li>
                <li data-value="ylx" data-tags="yuanlingxian" class="mui-table-view-cell mui-indexed-list-item">沅陵县</li>
                <li data-value="ydx" data-tags="yongdengxian" class="mui-table-view-cell mui-indexed-list-item">永登县</li>
                <li data-value="ytx" data-tags="yutaixian" class="mui-table-view-cell mui-indexed-list-item">鱼台县</li>
                <li data-value="yzs" data-tags="yizhoushi" class="mui-table-view-cell mui-indexed-list-item">宜州市</li>
                <li data-value="yms" data-tags="yimashi" class="mui-table-view-cell mui-indexed-list-item">义马市</li>
                <li data-value="yjx" data-tags="yongjiaxian" class="mui-table-view-cell mui-indexed-list-item">永嘉县</li>
                <li data-value="yx" data-tags="yuxian" class="mui-table-view-cell mui-indexed-list-item">盂县</li>
                <li data-value="ylx" data-tags="yiliangxian" class="mui-table-view-cell mui-indexed-list-item">宜良县</li>
                <li data-value="yc" data-tags="yichunyc" class="mui-table-view-cell mui-indexed-list-item">伊春</li>
                <li data-value="ys" data-tags="yushu" class="mui-table-view-cell mui-indexed-list-item">玉树</li>
                <li data-value="yl" data-tags="yili" class="mui-table-view-cell mui-indexed-list-item">伊犁</li>
                <li data-value="yl" data-tags="yilan" class="mui-table-view-cell mui-indexed-list-item">宜兰</li>
                <li data-group="Z" class="mui-table-view-divider mui-indexed-list-group">Z</li>
                <li data-value="zz" data-tags="zhengzhou" class="mui-table-view-cell mui-indexed-list-item">郑州</li>
                <li data-value="zb" data-tags="zibo" class="mui-table-view-cell mui-indexed-list-item">淄博</li>
                <li data-value="zh" data-tags="zhuhai" class="mui-table-view-cell mui-indexed-list-item">珠海</li>
                <li data-value="zs" data-tags="zhongshan" class="mui-table-view-cell mui-indexed-list-item">中山</li>
                <li data-value="zj" data-tags="zhenjiang" class="mui-table-view-cell mui-indexed-list-item">镇江</li>
                <li data-value="zz" data-tags="zhuzhou" class="mui-table-view-cell mui-indexed-list-item">株洲</li>
                <li data-value="zj" data-tags="zhanjiang" class="mui-table-view-cell mui-indexed-list-item">湛江</li>
                <li data-value="zjk" data-tags="zhangjiakou" class="mui-table-view-cell mui-indexed-list-item">张家口</li>
                <li data-value="zs" data-tags="zhoushan" class="mui-table-view-cell mui-indexed-list-item">舟山</li>
                <li data-value="zz" data-tags="zhangzhou" class="mui-table-view-cell mui-indexed-list-item">漳州</li>
                <li data-value="zz" data-tags="zaozhuang" class="mui-table-view-cell mui-indexed-list-item">枣庄</li>
                <li data-value="zk" data-tags="zhoukou" class="mui-table-view-cell mui-indexed-list-item">周口</li>
                <li data-value="zmd" data-tags="zhumadian" class="mui-table-view-cell mui-indexed-list-item">驻马店</li>
                <li data-value="zq" data-tags="zhaoqing" class="mui-table-view-cell mui-indexed-list-item">肇庆</li>
                <li data-value="zy" data-tags="zunyi" class="mui-table-view-cell mui-indexed-list-item">遵义</li>
                <li data-value="zjg" data-tags="zhangjiagang" class="mui-table-view-cell mui-indexed-list-item">张家港</li>
                <li data-value="zj" data-tags="zhuji" class="mui-table-view-cell mui-indexed-list-item">诸暨</li>
                <li data-value="zjj" data-tags="zhangjiajie" class="mui-table-view-cell mui-indexed-list-item">张家界</li>
                <li data-value="zg" data-tags="zigong" class="mui-table-view-cell mui-indexed-list-item">自贡</li>
                <li data-value="zy" data-tags="ziyang" class="mui-table-view-cell mui-indexed-list-item">资阳</li>
                <li data-value="zt" data-tags="zhaotong" class="mui-table-view-cell mui-indexed-list-item">昭通</li>
                <li data-value="zy" data-tags="zhangye" class="mui-table-view-cell mui-indexed-list-item">张掖</li>
                <li data-value="zz" data-tags="zhuozhou" class="mui-table-view-cell mui-indexed-list-item">涿州</li>
                <li data-value="zq" data-tags="zhangqiu" class="mui-table-view-cell mui-indexed-list-item">章丘</li>
                <li data-value="zc" data-tags="zengcheng" class="mui-table-view-cell mui-indexed-list-item">增城</li>
                <li data-value="zy" data-tags="zaoyang" class="mui-table-view-cell mui-indexed-list-item">枣阳</li>
                <li data-value="zc" data-tags="zhucheng" class="mui-table-view-cell mui-indexed-list-item">诸城</li>
                <li data-value="zh" data-tags="zhuanghe" class="mui-table-view-cell mui-indexed-list-item">庄河</li>
                <li data-value="zy" data-tags="zhaoyuan" class="mui-table-view-cell mui-indexed-list-item">招远</li>
                <li data-value="zh" data-tags="zunhua" class="mui-table-view-cell mui-indexed-list-item">遵化</li>
                <li data-value="zc" data-tags="zoucheng" class="mui-table-view-cell mui-indexed-list-item">邹城</li>
                <li data-value="zw" data-tags="zhongwei" class="mui-table-view-cell mui-indexed-list-item">中卫</li>
                <li data-value="zp" data-tags="zouping" class="mui-table-view-cell mui-indexed-list-item">邹平</li>
                <li data-value="zx" data-tags="zhongxiang" class="mui-table-view-cell mui-indexed-list-item">钟祥</li>
                <li data-value="zj" data-tags="zhijiang" class="mui-table-view-cell mui-indexed-list-item">枝江</li>
                <li data-value="zp" data-tags="zhangpu" class="mui-table-view-cell mui-indexed-list-item">漳浦</li>
                <li data-value="zs" data-tags="zhangshu" class="mui-table-view-cell mui-indexed-list-item">樟树</li>
                <li data-value="zd" data-tags="zhengding" class="mui-table-view-cell mui-indexed-list-item">正定</li>
                <li data-value="zm" data-tags="zhongmou" class="mui-table-view-cell mui-indexed-list-item">中牟</li>
                <li data-value="zx" data-tags="zhaoxian" class="mui-table-view-cell mui-indexed-list-item">赵县</li>
                <li data-value="zc" data-tags="zhecheng" class="mui-table-view-cell mui-indexed-list-item">柘城</li>
                <li data-value="zgeq" data-tags="zhungeerqi" class="mui-table-view-cell mui-indexed-list-item">准格尔旗</li>
                <li data-value="zz" data-tags="zhouzhi" class="mui-table-view-cell mui-indexed-list-item">周至</li>
                <li data-value="zj" data-tags="zhijiangtongzu" class="mui-table-view-cell mui-indexed-list-item">芷江</li>
                <li data-value="zj" data-tags="zhijin" class="mui-table-view-cell mui-indexed-list-item">织金</li>
                <li data-value="zp" data-tags="zhangping" class="mui-table-view-cell mui-indexed-list-item">漳平</li>
                <li data-value="zxs" data-tags="zixingshi" class="mui-table-view-cell mui-indexed-list-item">资兴市</li>
                <li data-value="zlts" data-tags="zhalantunshi" class="mui-table-view-cell mui-indexed-list-item">扎兰屯市</li>
                <li data-value="zx" data-tags="zhongxian" class="mui-table-view-cell mui-indexed-list-item">忠县</li>
                <li data-value="zr" data-tags="zherong" class="mui-table-view-cell mui-indexed-list-item">柘荣</li>
                <li data-value="zjx" data-tags="zhongjiangxian" class="mui-table-view-cell mui-indexed-list-item">中江县</li>
                <li data-value="zxx" data-tags="zhenxiongxian" class="mui-table-view-cell mui-indexed-list-item">镇雄县</li>
                <li data-value="zz" data-tags="zhouzhuang" class="mui-table-view-cell mui-indexed-list-item">周庄</li>
                <li data-value="zh" data-tags="zhanghua" class="mui-table-view-cell mui-indexed-list-item">彰化</li>				
            </ul>
        </div>
    </div>
</div>
<script>
$('#city1').text(position.city.replace("市", ""));
$('#city2').text(position.ucity);
$('#address .add').text(position.addr);
$('#address').on('tap',function(){
	$(this).find('.add').text('正在获取位置......');
	util.location(function(res) {
		$('#address').find('.add').text(res.addr);
	})
});
mui.init();
mui.ready(function() {
	var list = document.getElementById('list');
	//list.style.height = (document.body.offsetHeight) + 'px';
	window.indexedList = new mui.IndexedList(list);
});

$('.mui-indexed-list-item').on('click', function(){
	if ($(this).find('span').length) return false;
	position.ucity = $(this).text();
	$.setCookie("position", JSON.stringify(position), 'd1');
	window.location.href = document.referrer;
	wx.miniProgram.navigateBack({
		 delta: 1
	})
	wx.miniProgram.postMessage({
		data: $(this).text()
	})
});
$('.mui-indexed-list-item span').on('click', function(){
	position.ucity = $(this).text();
	$.setCookie("position", JSON.stringify(position), 'd1');
	window.location.href = document.referrer;
	wx.miniProgram.navigateBack({
		 delta: 1
	})
	wx.miniProgram.postMessage({
		data: $(this).text()
	})
});
$('.mui-placeholder').on('click', function(){
	$('.mui-search').addClass('mui-active');
	$('.mui-search input').attr('placeholder','搜索城市').focus();
});
$('.mui-icon-clear').on('tap', function(){
	$('.mui-search input').val('');
	$('.mui-search input').focus();
	$('.mui-search').find('.mui-icon-clear').addClass('mui-hidden');
});
$('.mui-search input').on('blur',function(e){
	if (!$(this).val().length){
		$(this).attr('placeholder','');
		$('.mui-search').removeClass('mui-active');
		$('.mui-search').find('.mui-icon-clear').addClass('mui-hidden');
	}
});
document.querySelector('.mui-search').addEventListener('input', function() {
	if ($('.mui-search input').val()!=''){
		$('.mui-search').find('.mui-icon-clear').removeClass('mui-hidden');
	}else{
		$('.mui-search').find('.mui-icon-clear').addClass('mui-hidden');
	}
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/footer', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/footer', TEMPLATE_INCLUDEPATH));?>