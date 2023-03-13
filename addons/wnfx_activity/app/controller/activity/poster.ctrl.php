<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 * url2qr.ctrl
 * 主办方二维码控制器
 */
if ($_W['account']->typeSign == 'account') {
	m('member')->getInfo();
}
if (!$_W['plugin']['poster']['config']['poster_enable']) {
	fx_message('访问错误', '', 'warning', '抱歉暂时不支持海报功能');
}

$pagetitle = "生成海报";
$id        = intval($_GPC['id'])?intval($_GPC['id']):intval($_GPC['activityid']);
$activity  = model_activity::getSingleActivity($id, '*');
$merchant  = model_activity::getActivityMerchant($activity['merchantid']);
$orderid   = intval($_GPC['orderid'])?intval($_GPC['orderid']):0;
$order     = $orderid ? model_records::getOrderCount($orderid) : array();

$imgnum     = intval($_GPC['imgnum']) ? intval($_GPC['imgnum']) : 1;
$font_file  = IA_ROOT . '/addons/wnfx_activity/app/resource/fonts/MSYH.ttf';

$where = "$uniacid and enable=1 and goodsid=".$activity['id'];
$poster = pdo_getall('fx_poster', array('uniacid' => $_W['uniacid'],'enable' => 1,'goodsid' => $activity['id']));

$_W['fans']['uid'] = !empty($_GPC['uid']) ? $_GPC['uid'] : $_W['member']['uid'];

$sys_pnum  = 0;
$font_data = array();
$img_data  = array();
$bg_data   = array();
if(empty($poster)){
	//文本参数
	$font_data  = array(
		array(
			'x'=>array(0,0,0,0,0,0,0),
			'y'=>array(225,675,1172,1420,200,0,0),
			'w'=>array(220,750,500,750,0,0,0),
			'size'=>array(30,35,25,25,50,0,0),
			'color'=>array(array(250,230,167),array(250,230,167),array(250,230,167),array(250,230,167)),
			'show'=>array(1,1,1,1,0,0,0)
		), 
		array(
			'x'=>array(150,390,360,360,0,0),
			'y'=>array(112,1077,1705,1790,0,0,0),
			'w'=>array(220,630,500,710,0,0,0),
			'size'=>array(30,35,25,25,0,0,0),
			'color'=>array(array(255,255,255),array(255,255,255),array(255,255,255),array(255,255,255)),
			'show'=>array(1,1,1,1,0,0,0)
		), 
		array(
			'x'=>array(0,0,0,0,0,0,0),
			'y'=>array(212,660,1450,1520,0,0,0),
			'w'=>array(220,620,500,900,0,0,0),
			'size'=>array(30,35,25,25,0,0,0),
			'color'=>array(array(255,255,255),array(255,255,255),array(255,255,255),array(255,255,255)),
			'show'=>array(1,1,1,1,0,0,0)
		), 
		array(
			'x'=>array(815,399,198,198,0,0,0),
			'y'=>array(1114,1265,1742,1820,0,0,0),
			'w'=>array(220,630,500,900,0,0,0),
			'size'=>array(30,35,25,25,0,0,0),
			'color'=>array(array(255,255,255),array(255,255,255),array(255,255,255),array(255,255,255)),
			'show'=>array(1,1,1,1,0,0,0)
		), 
		array(
			'x'=>array(0,0,221,221,0,0,0),
			'y'=>array(1790,550,1550,1620,0,0,0),
			'w'=>array(220,730,500,700,0,0,0),
			'size'=>array(30,35,25,25,0,0,0),
			'color'=>array(array(170,140,95),array(170,140,95),array(170,140,95),array(170,140,95)),
			'show'=>array(1,1,1,1,0,0,0)
		), 
		array(
			'x'=>array(0,0,0,0,0,0,0),
			'y'=>array(212,710,840,1377,0,0,0),
			'w'=>array(220,630,500,500,0,0,0),
			'size'=>array(30,35,25,25,0,0,0),
			'color'=>array(array(255,255,255),array(255,255,255),array(255,255,255),array(255,255,255)),
			'show'=>array(1,1,1,1,0,0,0)
		), 
		array(
			'x'=>array(0,325,522,582,0,0,0),
			'y'=>array(179,837,828,830,0,0,0),
			'w'=>array(220,45,20,30,0,0,0),
			'size'=>array(30,35,25,25,0,0,0),
			'color'=>array(array(239,213,178),array(239,213,178),array(239,213,178),array(239,213,178)),
			'show'=>array(1,1,1,1,0,0,0)
		), 
		array(
			'x'=>array(0,0,175,175,0,0,0),
			'y'=>array(242,905,1705,1785,0,0,0),
			'w'=>array(220,630,500,900,0,0,0),
			'size'=>array(30,35,25,25,0,0,0),
			'color'=>array(array(31,61,95),array(31,61,95),array(31,61,95),array(31,61,95)),
			'show'=>array(1,1,1,1,0,0,0)
		)
	);
	//图片参数
	$img_data = array(
		array(
			'x'=>array(505,45,433),
			'y'=>array(108,80,1554),
			'w'=>array(72,900,215),
			'h'=>array(72,450,215),
			'show'=>array(1,0,1)
		),
		array(
			'x'=>array(65,45,571),
			'y'=>array(70,80,1242),
			'w'=>array(60,900,230),
			'h'=>array(60,450,230),
			'show'=>array(1,0,1)
		),
		array(
			'x'=>array(505,45,433),
			'y'=>array(82,80,869),
			'w'=>array(72,900,229),
			'h'=>array(72,450,229),
			'show'=>array(1,0,1)
		),
		array(
			'x'=>array(730,45,770),
			'y'=>array(1065,80,1382),
			'w'=>array(72,900,229),
			'h'=>array(72,450,229),
			'show'=>array(1,0,1)
		),
		array(
			'x'=>array(505,45,432),
			'y'=>array(1660,80,1114),
			'w'=>array(72,900,232),
			'h'=>array(72,450,232),
			'show'=>array(1,0,1)
		),
		array(
			'x'=>array(505,45,428),
			'y'=>array(95,80,1040),
			'w'=>array(72,900,232),
			'h'=>array(72,450,232),
			'show'=>array(1,0,1)
		),
		array(
			'x'=>array(505,45,778),
			'y'=>array(60,80,1509),
			'w'=>array(72,900,231),
			'h'=>array(72,450,231),
			'show'=>array(1,0,1)
		),
		array(
			'x'=>array(505,45,422),
			'y'=>array(115,80,1170),
			'w'=>array(71,900,232),
			'h'=>array(71,450,232),
			'show'=>array(1,0,1)
		),
	);
	//背景参数
	$bg_data = array(
		'addons/wnfx_activity/app/resource/images/tpl/poster/1.jpg',
		'addons/wnfx_activity/app/resource/images/tpl/poster/2.jpg',
		'addons/wnfx_activity/app/resource/images/tpl/poster/3.jpg',
		'addons/wnfx_activity/app/resource/images/tpl/poster/4.jpg',
		'addons/wnfx_activity/app/resource/images/tpl/poster/5.jpg',
		'addons/wnfx_activity/app/resource/images/tpl/poster/6.jpg',
		'addons/wnfx_activity/app/resource/images/tpl/poster/7.jpg',
		'addons/wnfx_activity/app/resource/images/tpl/poster/8.jpg',
	);
	$poster = pdo_getall('fx_poster', array('uniacid' => $_W['uniacid'],'enable' => 1,'goodsid'=>''));
	$sys_pnum = count($bg_data);
	$where = "$uniacid and enable=1 and goodsid=''";
}

//组合自定义的海报参数
foreach($poster as $key => $s) {
	$s['textdata'] = unserialize($s['textdata']);
	$s['imgdata'] = unserialize($s['imgdata']);
	for ($c = 0; $c < 6; $c++) {
		if (empty($s['textdata']['color'][$c])){
			array_unshift($s['textdata']['color'], explode(',',$s['rgb']));
		}else{
			if (!is_array($s['textdata']['color'][$c])){
				$s['textdata']['color'][$c] = explode(',',$s['rgb']);
			}
		}
	}
	array_unshift($font_data, $s['textdata']);
	array_unshift($img_data, $s['imgdata']);
	array_unshift($bg_data, $s['thumb']);
}
//当前背景图片路径
if (strpos($bg_data[$imgnum-1], 'addons/') !== false) {
	$bgimg = IA_ROOT.'/'.$bg_data[$imgnum-1];
}else{
	$bgimg = $_W['setting']['remote']['type'] ? tomedia($bg_data[$imgnum-1]) : ATTACHMENT_ROOT . $bg_data[$imgnum-1];
}

//生成url参数二维码
$url =  app_url('activity/detail', array('mid' => $_W['fans']['uid'], 'id' => $id));
if ($_GPC['from']=='wxapp'){
	//生成小程序码	
	$qrcode = createQrcode::createverQrcode(urldecode(IN_MODULE.'/pages/goods/detail?id='.$id.'&mid='.$_W['fans']['uid']),$id,$_W['fans']['uid'],"poster/$id",1);
}else{
	$qrcode = createQrcode::createverQrcode($url,$id,$_W['fans']['uid'],"poster/$id",1);
}

//活动地址
if ($activity['hasonline']){//线上
	$address = '线上活动无需现场参与';
}elseif ($activity['hasstore']){//内部设置
	$address = $activity['address'];
}else{//门店
	if (!empty($activity['storeids'])){
		$stores = model_activity::getNumActivityStore($activity['storeids']);
		foreach ($stores as $key => $row) {
			$address = $row['address'];
			break;
		}
	}else{
		$address  = $merchant['address'];
	}
}

if ($_W['op'] == 'display'){
	if ($_W['plugin']['poster']['config']['commission_enable']){
		//成为分销员
		model_api::handler($_W['plugin']['poster']['config']);
		model_api::commission_member($mid);	
	}
	//缓存头像
	$path    = IA_ROOT . '/addons/wnfx_activity/data/files/poster/';
	$getimg  = getImage($_W['fans']['avatar'], $path, $_W['fans']['uid'], 1);
	//设置参数cookie，兼容ios
	$arr = array(
		'nickname' => $_W['fans']['nickname'],
		'avatar'   => $getimg['save_path'],
		'uid'   => $_W['fans']['uid'],
	);
		
	$total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('fx_poster') . " WHERE $where") + $sys_pnum;
	include fx_template('activity/poster');
}

if ($_W['op'] == 'style' && $_W['isajax']) {
	list($bg_w, $bg_h, $bg_type) = getimagesize($bgimg);
	die(json_encode(array('font_data' => $font_data[$imgnum-1], 'img_data' => $img_data[$imgnum-1],'bgimg'=>tomedia($bg_data[$imgnum-1]),'bg_w'=>$bg_w,'bg_h'=>$bg_h)));
	exit;
}

if ($_W['op'] == 'down2') {
	header("Content-Type:image/jpeg;text/html;charset=utf-8");
	$uid      = $_GPC['uid'];
	$nickname = $_GPC['nickname'];
	$realname = $order['realname'];
	$hexiaoma = $order['hexiaoma'];
	$avatar   = IA_ROOT . "/addons/wnfx_activity/data/files/poster/{$uid}.jpg";
	$thumb    = $_W['setting']['remote']['type'] ? tomedia($s['thumb']) : ATTACHMENT_ROOT.'/'.$s['thumb'];
	$images   = array($avatar, $thumb, $qrcode);
	$text     = array(
		$nickname, 
		$activity['title'], 
		'开始时间：'.date('Y-m-d H:i',strtotime($activity['starttime'])), 
		$address, 
		$realname, 
		$hexiaoma,
		'结束时间：'.date('Y-m-d H:i',strtotime($activity['endtime']))
	);
	image_copy_image($bgimg,$images,$img_data[$imgnum-1],'',$text,$font_file,$font_data[$imgnum-1]);
}
/**
 * png图文合成 by wangzhaobo
 * @param  string $bgimg  要合成的背景图片
 * @param  array $images 要合成的子图片
 * @param  array $img_data 要合成的子图片参数信息
 * @param  string $path  图片输出目录
 * @param  string $font_file  字体路径
 * @param  array $text       文本
 * @param  array $font_data  文本参数
 */
function image_copy_image($bgimg,$images,$img_data,$path,$text,$font_file,$font_data){
    //图片信息
    list($image_w, $image_h, $image_type) = getimagesize($bgimg);
	
    //创建图片的实例
    $canvas = imagecreatefromjpeg($bgimg);
	foreach($images as $key => $value){
		if ($img_data['show'][$key]){
			$image_size = getimagesize($value);
			switch ($image_size[2]) {
				case 1://GIF
					$img = imagecreatefromgif($value);
					break;
				case 2://JPG
					$img = imagecreatefromjpeg($value);
					break;
				case 3://PNG
					$img = imagecreatefrompng($value);
					break;
				default:
					break;
			}
			//把图片处理成圆形
			if ($key==0){
				$w    = $image_size[0];
				$h    = $image_size[1];
				$w    = min($w, $h);
				$h    = $w;
				$temp = imagecreatetruecolor($w, $h);
				
				//这一句一定要有
				imagesavealpha($temp, true);				
				//拾取一个完全透明的颜色,最后一个参数127为全透明
				$bg = imagecolorallocatealpha($temp, 255, 255, 255, 127);
				imagefill($temp, 0, 0, $bg);
				$r   = $w / 2;//圆半径
				$y_x = $r;//圆心X坐标
				$y_y = $r;//圆心Y坐标
				for ($x = 0; $x < $w; $x++) {
					for ($y = 0; $y < $h; $y++) {
						$rgbColor = imagecolorat($img, $x, $y);
						if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
							imagesetpixel($temp, $x, $y, $rgbColor);
						}
					}
				}
				imageantialias($temp, true);//抗锯齿，有些PHP版本有问题，谨慎使用
				$img = $temp;
			}
			if (!$img_data['x'][$key]){
				$img_data['x'][$key] = ($image_w - $img_data['w'][$key]) / 2;//图片居中
			}
			imagecopyresized($canvas, $img, $img_data['x'][$key], $img_data['y'][$key], 0, 0, $img_data['w'][$key], $img_data['h'][$key], imagesx($img), imagesy($img));
		}
	}
	//添加文字排版
    imagesavealpha($canvas,true);//这里很重要 意思是不要丢了图像的透明色;
    foreach($text as $key => $value){
		$font_color = imagecolorallocate($canvas, $font_data['color'][$key][0], $font_data['color'][$key][1], $font_data['color'][$key][2]);//默认的文字颜色
		if ($font_data['show'][$key]){
			//换行处理，将字符串拆分成一个个单字 保存到数组 letter 中
			$content = "";
			preg_match_all("/./u", $value, $arr);
			$letter = $arr[0];
			foreach($letter as $l) {
				$teststr = $content.$l;
				$testbox = imagettfbbox($font_data['size'][$key], $angle, $font_file, $teststr);
				if (($testbox[2] > $font_data['w'][$key]) && ($content !== "")) {
					$content .= PHP_EOL;
				}
				$content .= $l;
			}
			$liststr = explode(PHP_EOL,$content);
			foreach($liststr as $k => $v){
				$textbox = imagettfbbox($font_data['size'][$key],0,$font_file,$v);
				$text_width = $textbox[2]-$textbox[0];
				if (!$font_data['x'][$key]){
					$x = ($image_w - $text_width) / 2;//文字居中
				}else{
					$x = $font_data['x'][$key];
				}
				
				$y = $font_data['y'][$key] + ($k * $font_data['size'][$key] * 1.6);
				imagefttext($canvas,$font_data['size'][$key],0,$x,$y,$font_color,$font_file,$v);
			}
		}
    }
    //按照画布类型输出图片
    $imgName = time().rand(0,9).".jpg";//生成图片名称
    switch ($image_type) {
        case 1://GIF
			if (!empty($path))
				imagegif($canvas, $path . $imgName);
			else
				imagegif($canvas);
            break;
        case 2://JPG
			if (!empty($path))
            	imagejpeg($canvas, $path . $imgName);
			else
				imagejpeg($canvas);
			break;
        case 3://PNG
			if (!empty($path))
				imagepng($canvas, $path . $imgName);
			else
				imagepng($canvas);
            break;
        default:
            break;
    }
	imagedestroy($canvas);
	return $imgName;
}

function imgToBase64($img_file) {
    $img_base64 = '';
    if (file_exists($img_file)) {
        $app_img_file = $img_file; // 图片路径
        $img_info = getimagesize($app_img_file); // 取得图片的大小，类型等
        //echo '<pre>' . print_r($img_info, true) . '</pre><br>';
        $fp = fopen($app_img_file, "r"); // 图片是否可读权限
        if ($fp) {
            $filesize = filesize($app_img_file);
            $content = fread($fp, $filesize);
            $file_content = chunk_split(base64_encode($content)); // base64编码
            switch ($img_info[2]) {           //判读图片类型
                case 1: $img_type = "gif";
                    break;
                case 2: $img_type = "jpg";
                    break;
                case 3: $img_type = "png";
                    break;
            }

            $img_base64 = 'data:image/' . $img_type . ';base64,' . $file_content;//合成图片的base64编码
        }
        fclose($fp);
    }
    return $img_base64; //返回图片的base64
}