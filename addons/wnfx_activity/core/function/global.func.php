<?php
/**
 * [山西微链网络科技有限公司] Copyright (c) 2023
 * 全局常用方法
 */
defined('IN_IA') or exit('Access Denied');
function m($name = "") 
{
	static $_modules = array( );
	if( isset($_modules[$name]) ) 
	{
		return $_modules[$name];
	}
	$model = FX_CORE . '/model/' . strtolower($name) . '.mod.php';
	if( !is_file($model) ) 
	{
		exit( " Model " . $name . " Not Found!" );
	}
	require_once($model);
	$class_name = ucfirst($name) . "_FxModel";
	$_modules[$name] = new $class_name();
	return $_modules[$name];
}
function fx_message($msg, $redirect = '', $type = '', $desc='', $btntext='完成') {
	global $_W, $_GPC;
	if($redirect == 'refresh') {
		$redirect = $_W['script_name'] . '?' . $_SERVER['QUERY_STRING'];
	} elseif (!empty($redirect) && strexists($redirect, 'javascript')) {
		$redirect = $redirect;
	} elseif (!empty($redirect) && !strexists($redirect, 'http://') && !strexists($redirect, 'https://')) {
		$urls = parse_url($redirect);
		$redirect = $_W['siteroot'] . 'app/index.php?' . $urls['query'];
	}
	if (empty($redirect)) {
		$redirect = "javascript:history.go(-1);";
	}
	
	$type = in_array($type, array('success', 'error', 'info', 'warning', 'ajax', 'sql')) ? $type : 'success';
	
	if($_W['isajax'] || $type == 'ajax') {
		$vars = array();
		$vars['message'] = $msg;
		$vars['redirect'] = $redirect;
		$vars['type'] = $type;
		$vars['desc'] = $desc;
		exit(json_encode($vars));
	}
	if (empty($msg) && !empty($redirect)) {
		header('location: '.$redirect);
	}
	$label = $type;
	if($type == 'error') {
		$label = 'danger';
	}
	if($type == 'ajax' || $type == 'sql') {
		$label = 'warning';
	}
	if (defined('IN_API')) {
		exit($msg);
	}
	fx_load()->func('template');
	include fx_template('common/message', TEMPLATE_INCLUDEPATH);
	exit();
}
function show_json($return = NULL, $status = 1) {
	global $_W, $_GPC;
	$ret = array("status" => $status, "result" => ($status == 1 ? array("url" => referer()) : array()));
	if(!$status){
		$ret["result"]["message"] = $return;
		exit(json_encode($ret));
	}
	if(is_array($return)){
		$ret["result"] = $return;
		if( isset($return["url"]) ) 
		{
			$ret["result"]["url"] = $return["url"];
		}
		else 
		{
			$ret["result"]["url"] = referer();
		}
		
	}else{
		if(isset($return)){
			$ret["result"]["url"] = $return;
		}
	}
	exit(json_encode($ret));
}
function web_json($return = NULL, $status = 1) {
	global $_W, $_GPC;
	$ret = array("status" => $status, "result" => ($status == 1 ? array("url" => referer()) : array()));
	if(!$status){
		$ret["result"]["message"] = $return;
		exit(json_encode($ret));
	}
	if(is_array($return)){
		if(isset($return["url"]))
		$ret["result"]["url"] = $return["url"];
		if(isset($return["message"]))
		$ret["result"]["message"] = $return['message'];
	}else{
		if(isset($return)){
			$ret["result"]["url"] = $return;
		}
	}
	exit(json_encode($ret));
}
function is_array2($array) 
{
	if( is_array($array) ) 
	{
		foreach( $array as $k => $v ) 
		{
			return is_array($v);
		}
		return false;
	}
	else 
	{
		return false;
	}
}
//货币格式
function currency_format($currency, $decimals = 2) {
	$currency = floatval($currency);
	if (empty($currency)) {
		return '0.00';
	}
	$currency = number_format($currency, $decimals);
	$currency = str_replace(',', '', $currency);
	return $currency;
}

/*模板消息*/
function sendtplnotice($touser, $template_id, $postdata, $url = '') {
	global $_W;
	$account_api = WeAccount::create();
	$result = $account_api->sendTplNotice($touser, $template_id, $postdata, $url);
	return $result;
}
//触发消息
function sendCustomNotice($openid, $msg, $url = '') {
	global $_W;
	if ($_W['account']->typeSign == 'wxapp') return;
	$account_api = WeAccount::create();
	$content = "";
	if (is_array($msg)) {
		foreach ($msg as $key => $value) {
			if (!empty($value['title'])) {
				$content .= $value['title'] . ":" . $value['value'] . "\n";
			} else {
				$content .= $value['value'] . "\n";
				if ($key == 0) {
					$content .= "\n";
				}
			}
		}
	} else {
		$content = $msg;
	}
	if (!empty($url)) {
		$content .= "<a href='{$url}'>点击查看详情</a>";
	}	
	return $account_api -> sendCustomNotice(array("touser" => $openid, "msgtype" => "text", "text" => array('content' => urlencode($content))));
}

//sms短信发送
function sendSMS($mobile, $smsParam, $template_id, $type=false) {
	global $_W, $_GPC;
	$appkey = $_W['_config']['sms_appkey'];
	$secret = $_W['_config']['sms_appsecret'];
	$signNam = $_W['_config']['sms_signname'];
	if (!$type){
		require_once FX_CORE . '/library/alidayu/TopSdk.php';
		date_default_timezone_set('Asia/Shanghai'); 
		$c = new TopClient;
		$c ->appkey = $appkey;
		$c ->secretKey = $secret;
		$req = new AlibabaAliqinFcSmsNumSendRequest;
		$req ->setExtend("");//可不填写
		$req ->setSmsType("normal");
		$req ->setSmsFreeSignName($signNam);//短信签名，传入的短信签名必须是审核通过的签名
		$req ->setSmsParam(json_encode($smsParam));//这里是发送内容的相关参数变量
		$req ->setRecNum("$mobile");//接收短信的手机号
		$req ->setSmsTemplateCode($template_id);//这里是短信模板ID
		$resp = $c ->execute($req);
	}else{
		require_once FX_CORE . '/library/alidayu/apilite/SignatureHelper.php';
		//use Aliyun\DySDKLite\SignatureHelper;
		$accessKeyId = $appkey;
		$accessKeySecret = $secret;
		$params["PhoneNumbers"] = "$mobile";
		$params["SignName"] = "$signNam";
		$params["TemplateCode"] = "$template_id";
		$params['TemplateParam'] = $smsParam;
		$params['OutId'] = "12345";
		// fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
		//$params['SmsUpExtendCode'] = "1234567";
		if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
			$params["TemplateParam"] = json_encode($params["TemplateParam"]);
		}
		$helper = new Aliyun\DySDKLite\SignatureHelper;
		try {
			$content = $helper->request($accessKeyId, $accessKeySecret, "dysmsapi.aliyuncs.com",
				array_merge($params, array(
					"RegionId" => "cn-hangzhou",
					"Action" => "SendSms",
					"Version" => "2017-05-25",
				))
			);
		} catch (Exception $e) {
			$content =  $e-> getMessage();
		}
		$resp = $content;
	}
	return $resp;
}

//地图位置坐标
function tpl_form_field_position($field, $value = array()) {
	$s = '';
	if(!defined('TPL_INIT_COORDINATE')) {
		$s .= '<script type="text/javascript">
				function showCoordinate(elm) {
					var val = {};
					val.lng = parseFloat($(elm).parent().prev().prev().find(":text").val());
					val.lat = parseFloat($(elm).parent().prev().find(":text").val());
					val.adinfo = parseFloat($(elm).prev().find(":hidden").val());
					util.maps(val, function(r){
						$(elm).parent().prev().prev().find(":text").val(r.lng);
						$(elm).parent().prev().find(":text").val(r.lat);
						$(elm).parent().find(":hidden").val(r.adinfo);
						$("#address").val(r.label);
					},"'. web_url('map/tencent').'");
				}

			</script>';
		define('TPL_INIT_COORDINATE', true);
	}
	$s .= '
		<div class="row row-fix">
			<div class="col-xs-4 col-sm-4">
				<input type="text" name="' . $field . '[lng]" value="'.$value['lng'].'" placeholder="地理经度"  class="form-control" />
			</div>
			<div class="col-xs-4 col-sm-4">
				<input type="text" name="' . $field . '[lat]" value="'.$value['lat'].'" placeholder="地理纬度"  class="form-control" />
			</div>
			<div class="col-xs-4 col-sm-4" style="text-align:right;">
				<input type="hidden" name="' . $field . '[adinfo]" value="'.$value['adinfo'].'"/>
				<button onclick="showCoordinate(this);" class="btn btn-default" type="button">选择坐标</button>
			</div>
		</div>';
	return $s;
}
//生成商户订单号
function createUniontid(){
	//$randNum = substr(time(), -5).substr(microtime(), 2, 5).sprintf('%02d', rand(0, 99));
	$randNum = substr(microtime(), 2, 4).sprintf('%02d', rand(0, 99));
	$uniontid = 'WN'.date('YmdHis').$randNum;
	return $uniontid;
}
//生成随机码
function createRandomNumber($number){
	$str = '';
	$chars = '0123456789';
	for ($i = 0; $i < $number; $i++) {
		$str .= $chars[mt_rand(0, strlen($chars) - 1)];
	}
	return $str;
}
//生成指定范围随机数串
function createNumber($banNum = array()){
	//这里设置0-9999数组
	$arrNum = range (0000,9999);
	//遍历并删除$arrNum中已出现的号码$banNum
	foreach($banNum as $row)
	{  
		unset($arrNum[$row['num']]); 
	}
	//从剩余中随机取出一个,已占用的不会再出现
	$num = $arrNum[array_rand($arrNum,1)];
	$num = sprintf("%04d", $num);//不足4位补0
	return $num;
}

//页面跳转
function app_url($segment, $params = array() ,$mod = '') {
	global $_W,$_GPC;
	list($do, $ac, $op) = explode('/', $segment);
	$mod = empty($mod)?(MODULE_PLUGIN_NAME!='' ? MODULE_PLUGIN_NAME : MAIN_MODULE):$mod;
	$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=$mod";
	if (!$_W['isv2'] && $mod!=MAIN_MODULE){	
		if (!empty($do)) {
			$url .= "&do={$do}";
		}
		if (!empty($ac)) {
			$url .= "&ac={$ac}";
		}
		if (!empty($op)) {
			$url .= "&op={$op}";
		}
	}else{
		$url .= "&do=mobile";
		if (!empty($do)) {
			$url .= "&r={$do}";
		}
		if (!empty($ac)) {
			$url .= ".{$ac}";
		}
		if (!empty($op)) {
			$url .= ".{$op}";
		}
	}
	if (!empty($params)) {
		$queryString = http_build_query($params, '', '&');
		$url .= '&' . $queryString;
	}
	if ($_GPC['from'] == 'wxapp'){
		$url .= '&from=wxapp';
	}
	return $url;
}
function web_url($segment = '', $params = array() ,$mod = '') {
	global $_W,$_GPC;
	list($do, $ac, $op) = explode('/', $segment);
	$mod = empty($mod)?(MODULE_PLUGIN_NAME!='' ? MODULE_PLUGIN_NAME : MAIN_MODULE):$mod;
	if((int)MERCHANTID){
		$url = $_W['siteroot'] . 'addons/'.MAIN_MODULE.'/web/merch.php?';
	}else{		
		$url = $_W['siteroot'] . "web/index.php?c=site&a=entry&m=$mod";
	}
	if (!$_W['isv2'] && $mod!=MAIN_MODULE){
		if (!empty($do)) {
			$url .= "&do={$do}";
		}
		if (!empty($ac)) {
			$url .= "&ac={$ac}";
		}
		if (!empty($op)) {
			$url .= "&op={$op}";
		}
	}else{
		$url .= "&do=web";
		if (!empty($do)) {
			$url .= "&r={$do}";
		}
		if (!empty($ac)) {
			$url .= ".{$ac}";
		}
		if (!empty($op)) {
			$url .= ".{$op}";
		}
	}
	if (!empty($params)) {
		$queryString = http_build_query($params, '', '&');
		if (!empty($queryString))
			$url .= '&' . $queryString;
	}
	return $url;
}
function perm($permtypes) {
	global $_W;
	$perm = perms::check_perm($permtypes);
	return $perm;
}
function perm_isopen($name, $iscom = false){
	global $_W;
	$config['commission'] = $_W['plugin']['poster']['config']['commission_enable'];
	$config['poster'] = $_W['plugin']['poster']['config']['poster_enable'];
	$config['vipcard'] = $_W['plugin']['card']['config']['card_enable'];
	$config['seat'] = checkplugin('seat');
	$config['merch'] = $_W['_config']['merch'];
	return $config[$name];
}
//时间转换函数
function tranTime($time) {
	if ($time!=NULL && $time!=''){
		$rtime = date("m月d日 H:i", $time);
		$rtime2 = date("Y年m月d日 H:i", $time);
		$htime = date("H:i", $time);
		$time = time() - $time;
		if ($time < 60) {
			$str = '刚刚';
		} elseif ($time < 60 * 60) {
			$min = floor($time / 60);
			$str = $min . ' 分钟前';
		} elseif ($time < 60 * 60 * 24) {
			$h = floor($time / (60 * 60));
			$str = $h . '小时前 ' . $htime;
		} elseif ($time < 60 * 60 * 24 * 3) {
			$d = floor($time / (60 * 60 * 24));
			if ($d == 1) $str = '昨天 ' . $htime;
			else $str = '前天 ' . $htime;
		} elseif ($time < 60 * 60 * 24 * 7) {
			$d = floor($time / (60 * 60 * 24));
			$str = $d . ' 天前 ' . $htime;
		} elseif ($time < 60 * 60 * 24 * 30) {
			$str = $rtime;
		} else {
			$str = $rtime2;
		}
	}else{
		$str = "无";
	}
	return $str;
}
//星期转换函数
function getWeek($num) {
	$week = '';
	switch($num){
		case 1:
			$week = '周一';
			break;
		case 2:
			$week = '周二';
			break;
		case 3:
			$week = '周三';
			break;
		case 4:
			$week = '周四';
			break;
		case 5:
			$week = '周五';
			break;
		case 6:
			$week = '周六';
			break;
		case 7:
			$week = '周日';
			break;
		default:;
	}
	return $week;
}
/** 
* 短网址生成
* 
* @name short_url 
* @param $url_long  长连接
* @param $appkey  新浪appkey
* @return array 
*/

function short_url($url_long){
	$arrkey = array('2849184197','202088835','211160679');
	foreach ($arrkey as $i => $appkey) {
		$response = ihttp_get("http://api.weibo.com/2/short_url/shorten.json?source=" . $appkey . "&url_long=" . $url_long);
		if (is_error($response)) {
			$short_url = $url_long;
			$res = error(-1, "读取新浪接口失败, 错误: {$response['message']}");
			if ($i==2) $res['url_short'] = $url_long;
		}
		$result = @json_decode($response['content'], true);
		if (empty($result)) {
			$res = error(-1, "接口调用失败, 元数据: {$response['meta']}");
			if ($i==2) $res['url_short'] = $url_long;
		} elseif (!empty($result['error_code'])) {
			$res = error(-1, "接口调用失败, 错误代码: {$result['error_code']}, 错误信息: {$result['error']}");
			if ($i==2) $res['url_short'] = $url_long;
		} else{
			$res['url_short'] = $result['urls'][0]['url_short'];
			break;
		}
	}
	//$res = error(0, "成功");
	return $res['url_short'];
}
/* 附近 */
/**
 * 计算当前商家位置是否在范围内
 * @param 当前位置经度 $lat_a
 * @param 计算经度 $lng_a
 * @param 当前位置维度 $lat_b
 * @param 计算纬度 $lng_b
 * @author bieanju
 * @return number 距离  */
function getDistance_map($lat_a, $lng_a, $lat_b, $lng_b) {
	//R是地球半径（米）
	$R = 6366000;
	$pk = doubleval(180 / 3.1416);
	$a1 = doubleval($lat_a / $pk);
	$a2 = doubleval($lng_a / $pk);
	$b1 = doubleval($lat_b / $pk);
	$b2 = doubleval($lng_b / $pk);
	$t1 = doubleval(cos($a1) * cos($a2) * cos($b1) * cos($b2));
	$t2 = doubleval(cos($a1) * sin($a2) * cos($b1) * sin($b2));
	$t3 = doubleval(sin($a1) * sin($b1));
	$tt = doubleval(acos($t1 + $t2 + $t3));
	return round($R * $tt);
}
 //比如微信昵称，当参数传入，返回处理后的值
function filterEmoji($emojiStr){
	$emojiStr = preg_replace_callback('/./u',match,$emojiStr);
	return $emojiStr;
}
function match(array $match){
	return strlen($match[0]) >= 4 ? '' : $match[0];
}
function filterNickname($nickname){
        $nickname = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $nickname);

        $nickname = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $nickname);

        $nickname = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $nickname);

        $nickname = preg_replace('/[\x{2600}-\x{26FF}]/u', '', $nickname);

        $nickname = preg_replace('/[\x{2700}-\x{27BF}]/u', '', $nickname);
        $nickname = preg_replace('/[\xf0-\xf7].{3}/', '', $nickname);

        $nickname = str_replace(array('"','\''), '', $nickname);

        return addslashes(trim($nickname));
    }
/** 
* 格式化html
* 
* @name $htmlstr
* @name $htmlstr
* @name $res
*/ 
function html_format($htmlstr, $arr = array('img')){
	$allow = "<h1> <h2> <h3> <ul> <ol> <li> <p> <b> <strong> <span> <a>";
	$allow.= in_array('img', $arr) ? "" : " <img>";
	$res = preg_replace("/(\s)class=.+?['|\"]/i", "", htmlspecialchars_decode($htmlstr));
	$res = preg_replace("/(\s)id=.+?['|\"]/i", "", $res);
	$res = preg_replace("/&#39;/i", chr(39), $res);
	
	$res = preg_replace_callback("/(style=.+?['|\"]>)/is", function($matched){
    	return preg_replace("/\">/is", ';">', $matched[0]);
	}, $res);
	$res = preg_replace_callback("/(style=.+?['|\"]>)/is", function($matched){
    	return preg_replace("/'>/is", ";'>", $matched[0]);
	}, $res);
	
	$res = preg_replace("/;;'>/i", ";'>", $res);
	$res = preg_replace("/;;\">/i", ";\">", $res);
	$res = preg_replace("/ul(\s)style=.+?['|\"]/i", "ul", $res);
	$res = preg_replace("/ol(\s)style=.+?['|\"]/i", "ol", $res);
	$res = preg_replace('/font:[^;]+?;/i', "", $res);
	$res = preg_replace('/font-family:[^;]+?;/i', "", $res);
	$res = preg_replace('/font-size-adjust:[^;]+?;/i', "", $res);
	$res = preg_replace('/font-stretch:[^;]+?;/i', "", $res);
	$res = preg_replace('/font-style:[^;]+?;/i', "", $res);
	$res = preg_replace('/font-variant:[^;]+?;/i', "", $res);
	$res = preg_replace('/font-weight:[^;]+?;/i', "", $res);
	
	$res = preg_replace('/line-height:[^;]+?;/i', "", $res);
	$res = preg_replace('/vertical-align:[^;]+?;/i', "", $res);
	$res = preg_replace('/margin.*?:[^;]+?;/i', "", $res);
	$res = preg_replace('/padding.*?:[^;]+?;/i', "", $res);
	$res = preg_replace('/background.*?:[^;]+?;/i', "", $res);
	$res = preg_replace('/border.*?:[^;]+?;/i', "", $res);
	$res = preg_replace('/float:[^;]+?;/i', "", $res);
	//$res = preg_replace('/:[^;]+?;/i', "", $res);
	
	$res = preg_replace_callback("/(style=.+?['|\"])/is", function($matched){
    	return preg_replace('/[\s\n]+/is', '', $matched[0]);
	}, $res);
	$res = preg_replace_callback("/<span[\s]style=.+?['|\"]/is", function($matched){
    	return preg_replace('/text-align:[^;]+?;/is', '', $matched[0]);
	}, $res);
	
	$res = preg_replace("/(\s)style=['|\"];['|\"]/i", "", $res);
	$res = preg_replace("/(\s)style=['|\"]['|\"]/i", "", $res);	
	$res = strip_tags($res, $allow);
	return $res;
}
function getFile(){
	$f = $_FILES['file'];
	return $f;
}
function charReplace($str) {
	$str = str_replace(['/','\\',':','*','"','<','>','|','?'],'_',$str);
	return $str;
}
/* 
*功能：php完美实现下载远程图片保存到本地 
*参数：文件url,保存文件目录,保存文件名称，使用的下载方式 
*当保存文件名称为空时则使用远程文件原来的名称 
*/ 
function getImage($url,$save_dir='',$filename='',$type=0){ 
    if(trim($url)==''){ 
        return array('file_name'=>'','save_path'=>'','error'=>1); 
    } 
    if(trim($save_dir)==''){ 
        $save_dir='./'; 
    } 
	$ext=strrchr($url,'.'); 
	if($ext!='.gif'&&$ext!='.jpg'){ 
		$ext = '.jpg';
	}
    if(trim($filename)==''){//保存文件名 
        $filename=time().$ext; 
    }else{
		$filename=$filename.$ext; 
	}
    if(strlen($save_dir) - strrpos($save_dir,'/') > 1){ 
        $save_dir.='/'; 
    }
	load()->func('file');
	file_delete($save_dir.$filename);
    //创建保存目录 
    if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){ 
        return array('file_name'=>'','save_path'=>'','error'=>5); 
    }
    //获取远程文件所采用的方法
    if($type){ 
        $ch=curl_init(); 
        $timeout=5; 
        curl_setopt($ch,CURLOPT_URL,$url); 
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); 
		//设置curl默认访问为IPv4
		if(defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')){
			curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		}
        $img=curl_exec($ch); 
        curl_close($ch); 
    }else{ 
        ob_start();  
        readfile($url); 
        $img=ob_get_contents();  
        ob_end_clean();  
    } 
    //$size=strlen($img); 
    //文件大小  
    $fp2=@fopen($save_dir.$filename,'a'); 
    fwrite($fp2,$img); 
    fclose($fp2); 
    unset($img,$url); 
    return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0); 
}

function mb_substr_replace($string, $replacement, $start, $length = null, $encoding = null)
{
	if (extension_loaded('mbstring') === true) {
		$string_length = (is_null($encoding) === true) ? mb_strlen($string) : mb_strlen($string, $encoding);

		if ($start < 0) {
			$start = max(0, $string_length + $start);
		} else if ($start > $string_length) {
			$start = $string_length;
		}

		if ($length < 0) {
			$length = max(0, $string_length - $start + $length);
		} else if ((is_null($length) === true) || ($length > $string_length)) {
			$length = $string_length;
		}

		if (($start + $length) > $string_length) {
			$length = $string_length - $start;
		}

		if (is_null($encoding) === true) {
			return mb_substr($string, 0, $start) . $replacement . mb_substr($string, $start + $length, $string_length - $start - $length);
		}

		return mb_substr($string, 0, $start, $encoding) . $replacement . mb_substr($string, $start + $length, $string_length - $start - $length, $encoding);
	}

	return (is_null($length) === true) ? substr_replace($string, $replacement, $start) : substr_replace($string, $replacement, $start, $length);
}
?>