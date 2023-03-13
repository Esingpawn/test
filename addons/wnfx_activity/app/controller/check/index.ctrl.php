<?php
$_W['op'] = !empty($_W['op']) ? $_W['op'] : 'code';

if($_W['op'] =='follow'){//判断是否关注公众号
	die(json_encode(array('result'=>$_W['fans']['follow']?1:0)));
}
if($_W['op'] =='m_follow'){//判断是否关注主办方
	
}
if($_W['op'] =='favorite'){//判断是否收藏
	
}
if($_W['op'] =='join'){//判断是否报名
	
}