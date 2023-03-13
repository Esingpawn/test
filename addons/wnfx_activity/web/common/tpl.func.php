<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 */
defined('IN_IA') or exit('Access Denied');

function getmenuFrames(){
	global $_W;
	global $_GPC;
	$submenu = array(
		'shop'=>true,
		'activity'=>true,
		'records'=>true,
		'store'=>true,
		'merch'=>true,
		'apply'=>true,
		'finance'=>true,
		'shop'=>true,		
		'member'=>true,
		'sale'=>true,
		'sysset'=>true,
		'perm'=>true,
		'seat'=>true
	);
	return $submenu;
}

function tpl_selector($name, $options = array()){
	$options["multi"] = intval($options["multi"]);//多选
	$options["buttontext"] = (isset($options["buttontext"]) ? $options["buttontext"] : "请选择");//按钮文本
	$options["items"] = (isset($options["items"]) && $options["items"] ? $options["items"] : array( ));//按钮文本
	$options["readonly"] = (isset($options["readonly"]) ? $options["readonly"] : true);
	$options["callback"] = (isset($options["callback"]) ? $options["callback"] : "");
	$options["key"] = (isset($options["key"]) ? $options["key"] : "id");
	$options["text"] = (isset($options["text"]) ? $options["text"] : "title");
	$options["thumb"] = (isset($options["thumb"]) ? $options["thumb"] : "thumb");
	$options["preview"] = (isset($options["preview"]) ? $options["preview"] : true);
	$options["type"] = (isset($options["type"]) ? $options["type"] : "image");
	$options["input"] = (isset($options["input"]) ? $options["input"] : true);
	$options["required"] = (isset($options["required"]) ? $options["required"] : false);
	$options["nokeywords"] = (isset($options["nokeywords"]) ? $options["nokeywords"] : 0);
	$options["placeholder"] = (isset($options["placeholder"]) ? $options["placeholder"] : "请输入关键词");
	$options["autosearch"] = (isset($options["autosearch"]) ? $options["autosearch"] : 0);
	if(empty($options["items"])){
		$options["items"] = array();
	}else{
		if(!is_array2($options["items"])){
			$options["items"] = array($options["items"]);
		}
	}
	$options["name"] = $name;
	$titles = "";
	foreach($options["items"] as $item) 
	{
		$titles .= $item[$options["text"]];
		if(1 < count($options["items"])) 
		{
			$titles .= "; ";
		}
	}
	$options["value"] = (isset($options["value"]) ? $options["value"] : $titles);
	$readonly = ($options["readonly"] ? "readonly" : "");
	$required = ($options["required"] ? " data-rule-required=\"true\"" : "");
	$callback = (!empty($options["callback"]) ? ", " . $options["callback"] : "");
	$id = ($options["multi"] ? (string) $name . "[]" : $name);
	$html = "<div id='" . $name . "_selector' class='selector'\r\n                     data-type=\"" . $options["type"] . "\"\r\n                     data-key=\"" . $options["key"] . "\"\r\n                     data-text=\"" . $options["text"] . "\"\r\n                     data-thumb=\"" . $options["thumb"] . "\"\r\n                     data-multi=\"" . $options["multi"] . "\"\r\n                     data-callback=\"" . $options["callback"] . "\"\r\n                     data-url=\"" . $options["url"] . "\"\r\n                     data-nokeywords=\"" . $options["nokeywords"] . "\"\r\n                  data-autosearch=\"" . $options["autosearch"] . "\"\r\n\r\n                 >";
	$html .= "<div class='input-group'>" . "<input type='text' id='" . $name . "_text' name='" . $name . "_text'  value='" . $options["value"] . "' class='form-control text'  " . $readonly . "  " . $required . "/>" . "<div class='input-group-btn'>";
	$html .= "<button class='btn btn-primary' type='button' onclick='biz.selector.select(" . json_encode($options, JSON_HEX_APOS) . ");'>" . $options["buttontext"] . "</button></div></div>";
	
	$show = ($options["preview"] ? "" : " style='display:none'");
	if($options["type"] == "image"){		
		$html .= "<div class='input-group multi-img-details container' " . $show . ">";
	}else{
		$html .= "<div class='input-group multi-audio-details container' " . $show . ">";
	}
	foreach($options["items"] as $item){
		if($options["type"] == "image") 
		{
			$html .= "<div class='multi-item' data-" . $options["key"] . "='" . $item[$options["key"]] . "' data-name='" . $name . "'>\r\n                                      <img class='img-responsive img-thumbnail' src='" . tomedia($item[$options["thumb"]]) . "' onerror='this.src=\"../addons/".IN_MODULE."/static/images/nopic.png\"' style='width:100px;height:100px;'>\r\n                                      <div class='img-nickname'>" . $item[$options["text"]] . "</div>\r\n                                     <input type='hidden' value='" . $item[$options["key"]] . "' name='" . $id . "'>\r\n                                     <em onclick='biz.selector.remove(this,\"" . $name . "\")'  class='close'>×</em>\r\n                            <div style='clear:both;'></div>\r\n                         </div>";
		}else{
			$html .= "<div class='multi-audio-item ' data-" . $options["key"] . "='" . $item[$options["key"]] . "' >\r\n                       <div class='input-group'>\r\n                       <input type='text' class='form-control img-textname' readonly='' value='" . $item[$options["text"]] . "'>\r\n                       <input type='hidden'  value='" . $item[$options["key"]] . "' name='" . $id . "'>\r\n                       <div class='input-group-btn'><button class='btn btn-default' onclick='biz.selector.remove(this,\"" . $name . "\")' type='button'><i class='fa fa-remove'></i></button>\r\n                       </div></div></div>";
		}
		if($options["type"] == "merch") {
			session_start();
			$_SESSION['merchid'] = $item[$options["key"]];
		}
	}
	$html .= "</div></div>";
	return $html;
}
function tpl_form_field_editor($params = array( ), $callback = NULL){
	$html = "<span class=\"form-editor-group\">";
	$html .= "<span class=\"form-control-static form-editor-show\">";
	$html .= "<a class=\"form-editor-text\">" . $params["value"] . "</a>";
	$html .= "<a class=\"text-primary form-editor-btn\">修改</a>";
	$html .= "</span>";
	$html .= "<span class=\"input-group form-editor-edit\">";
	$html .= "<input class=\"form-control form-editor-input\" value=\"" . $params["value"] . "\" name=\"" . $params["name"] . "\"";
	if( !empty($params["placeholder"]) ) 
	{
		$html .= "placeholder=\"" . $params["placeholder"] . "\"";
	}
	if( !empty($params["id"]) ) 
	{
		$html .= "id=\"" . $params["id"] . "\"";
	}
	if( !empty($params["data-rule-required"]) || !empty($params["required"]) ) 
	{
		$html .= " data-rule-required=\"true\"";
	}
	if( !empty($params["data-msg-required"]) ) 
	{
		$html .= " data-msg-required=\"" . $params["data-msg-required"] . "\"";
	}
	$html .= " /><span class=\"input-group-btn\">";
	$html .= "<span class=\"btn btn-default form-editor-finish\"";
	if( $callback ) 
	{
		$html .= "data-callback=\"" . $callback . "\"";
	}
	$html .= "><i class=\"icow icow-wancheng\"></i></span>";
	$html .= "</span>";
	$html .= "</span>";
	return $html;
}
if( !function_exists("tpl_form_field_video2")) {
function tpl_form_field_video2($name, $value = "", $options = array( )) {
	$options["btntext"] = (!empty($options["btntext"]) ? $options["btntext"] : "选择视频");
	if( $options["disabled"] ) 
	{
		$options["readonly"] = true;
	}
	$html = "";
	$html .= "<div class=\"input-group\"";
	if( $options["disabled"] ) 
	{
		$html .= " style=\"width: 100%;\"";
	}
	$html .= "><input class=\"form-control\" id=\"select-video-" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\" data-url=\"" . tomedia($value) . "\" placeholder=\"" . $options["placeholder"] . "\"";
	if( $options["readonly"] ) 
	{
		$html .= " readonly=\"readonly\"";
	}
	$html .= "/>";
	if( !$options["disabled"] ) 
	{
		$html .= "<span class=\"input-group-addon btn btn-primary\" data-toggle=\"selectVideo\" data-input=\"#select-video-" . $name . "\" data-network=\"" . $options["network"] . "\">" . $options["btntext"] . "</span>";
	}
	$html .= "</div>";
	$html .= "<div class=\"input-group\"><div class=\"multi-item\" style=\"display: block\" title=\"预览视频\" data-toggle=\"previewVideo\" data-input=\"#select-video-" . $name . "\"><div class=\"img-responsive img-thumbnail img-video\" style=\"width: 100px; height: 100px; position: relative; text-align: center; cursor: pointer;\" src=\"\"><i class=\"fa fa-play-circle\" style=\"font-size: 60px; line-height: 90px; color: #999;\"></i></div>";
	if( !$options["disabled"] ) 
	{
		$html .= "<em class=\"close\" title=\"移除视频\" data-toggle=\"previewVideoDel\" data-element=\"#select-video-" . $name . "\">×</em>";
	}
	$html .= "</div></div>";
	return $html;
}}