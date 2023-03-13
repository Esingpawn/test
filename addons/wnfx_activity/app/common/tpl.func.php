<?php
/**
 * [sxwelink] Copyright (c) 2016/8/18
 */
defined('IN_IA') or exit('Access Denied');

function tpl_app_form_field($field, $value = '', $placeholder = '', $fromkey = '') {
	$fromkey = $fromkey!=='' ? '_' . $fromkey : $fromkey;
	$placeholders[$field] = '请填写' . $placeholder;
	if(in_array($field, array('birth', 'reside', 'gender', 'education', 'constellation', 'zodiac', 'bloodtype'))) {
		$placeholders[$field] = '请选择' . str_replace("(必填)","(必选)",$placeholder);
	}
	if($field == 'height') {
		$placeholders[$field] = '请填写' . $placeholder . '(单位:cm)';
	} elseif ($field == 'weight') {
		$placeholders[$field] = '请填写' . $placeholder . '(单位:kg)';
	}
	switch ($field) {
		case 'avatar':
			$html = tpl_app_form_field_avatar('avatar', $value);
			break;
		case 'birth':
		case 'birthyear':
		case 'birthmonth':
		case 'birthday':
			$html = _tpl_app_form_field_calendar('birth'.$fromkey, $value, $placeholder);
			break;
		case 'reside':
		case 'resideprovince':
		case 'residecity':
		case 'residedist':
			$html = _tpl_app_form_field_district('reside'.$fromkey, $value, $placeholder);
			break;
		case 'bio':
		case 'interest':
			$html = '<textarea name="' . $field . '" rows="3" placeholder="' . $placeholders[$field] . '">' . $value . '</textarea>';
			break;
		case 'gender':
		case 'education':
		case 'constellation':
		case 'zodiac':
		case 'bloodtype':
			if($field == 'gender') {
				$options = array(
					'0' => '保密',
					'1' => '男',
					'2' => '女',
				);
				$text_value = $options[$value];
			} else {
				if ($field == 'bloodtype') {
					$options = array('A', 'B', 'AB', 'O', '其它');
				} elseif ($field == 'zodiac') {
					$options = array('鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪');
				} elseif ($field == 'constellation') {
					$options = array('水瓶座', '双鱼座', '白羊座', '金牛座', '双子座', '巨蟹座', '狮子座', '处女座', '天秤座', '天蝎座', '射手座', '摩羯座');
				} elseif ($field == 'education') {
					$options = array('博士', '硕士', '本科', '专科', '中学', '小学', '其它');
				}
				$text_value = $value;
			}
			$data = array();
			foreach($options as $key => $option) {
				if(!$option) {
					continue;
				}
				if($field == 'gender') {
					$data[] = array(
						'text' => $option,
						'value' => $key
					);
				} else {
					$data[] = array(
						'text' => $option,
						'value' => $option
					);
				}
			}
			if($field != 'gender') {
				$text_value = $value;
				unset($options);
			}
			$html = '
				<input class="mui-'. $field . '-picker'. $fromkey .'" type="text" value="'. $text_value .'" readonly placeholder="' . $placeholders[$field] . '"/>
				<input type="hidden" name="'. $field . $fromkey  .'" value="'. $value .'"/>
				<script type="text/javascript">
					$(".mui-'. $field .'-picker'. $fromkey .'").on("tap", function(){
						var $this = $(this);
						util.poppicker({data: '. json_encode($data) .'}, function(items){
							$this.val(items[0].text).next().val(items[0].value);
						});
					});
				</script>';
			break;
		case 'nickname':
		case 'realname':
		case 'address':
		case 'mobile':
		case 'qq':
		case 'msn':
		case 'email':
		case 'telephone':
		case 'taobao':
		case 'alipay':
		case 'studentid':
		case 'grade':
		case 'graduateschool':
		case 'idcard':
		case 'zipcode':
		case 'site':
		case 'affectivestatus':
		case 'lookingfor':
		case 'nationality':
		case 'height':
		case 'weight':
		case 'company':
		case 'occupation':
		case 'position':
		case 'revenue':
		default:
			$html = '<input type="text" name="' . $field . $fromkey  . '" value="' . $value . '"  placeholder="' . $placeholders[$field] . '"/>';
			break;
	}
	return $html;
}

function _tpl_app_form_field_calendar($name, $values = array(), $placeholder = '') {
	$placeholder = empty($placeholder) ? '请选择日期' : '请选择' . str_replace("(必填)","(必选)",$placeholder);
	$value = (empty($values['year']) || empty($values['month']) || empty($values['day'])) ? '' : implode('-', $values);
	$html = '';
	$html .= '<input class="mui-calendar-picker" type="text" placeholder="'.$placeholder.'" readonly value="' . $value . '" name="' . $name . '" />';
	$html .= '<input type="hidden" value="' . $values['year'] . '" name="' . $name . '[year]"/>';
	$html .= '<input type="hidden" value="' . $values['month'] . '" name="' . $name . '[month]"/>';
	$html .= '<input type="hidden" value="' . $values['day'] . '" name="' . $name . '[day]"/>';
	if (!defined('TPL_INIT_CALENDAR')) {
		$html .= '
			<script type="text/javascript">
				$(document).on("tap", ".mui-calendar-picker", function(){
					var $this = $(this);
					util.datepicker({
						type: "date", 
						beginYear: 1910, 
						endYear: 2060, 
						selected : {
							year : "' . $values['year'] . '", month : "' . $values['month'] . '", day : "' . $values['day'] . '"}
						}, function(rs){
							$this.val(rs.value)
							.next().val(rs.y.text)
							.next().val(rs.m.text)
							.next().val(rs.d.text)
					});
				});
			</script>';
		define('TPL_INIT_CALENDAR', true);
	}
	return $html;
}

function _tpl_app_form_field_district($name, $values = array(), $placeholder = '') {
	$placeholder = empty($placeholder) ? '请选择地区' : '请选择' . str_replace("(必填)","(必选)",$placeholder);
	$value = (empty($values['province']) || empty($values['city'])) ? '' : implode(' ', $values);
	$html = '';
	$html .= '<input class="mui-district-picker-' . $name .'" placeholder="'.$placeholder.'" type="text" readonly value="' . $value . '"/>';
	$html .= '<input type="hidden" value="' . $values['province'] . '" name="' . $name . '[province]"/>';
	$html .= '<input type="hidden" value="' . $values['city'] . '" name="' . $name . '[city]"/>';
	$html .= '<input type="hidden" value="' . $values['district'] . '" name="' . $name . '[district]"/>';
	$html .= '
		<script type="text/javascript">
			$(document).on("tap", ".mui-district-picker-' . $name . '", function(){
				var $this = $(this);
				util.districtpicker(function(item){
					item[2].text = item[2].text || "";
					$this.val(item[0].text+" "+item[1].text+" "+item[2].text)
					.next().val(item[0].text)
					.next().val(item[1].text)
					.next().val(item[2].text);
				}, {province : "' . $values['province'] . '", city : "' . $values['city'] . '", district : "' . $values['district'] . '"});
			});
		</script>';
	return $html;
}