<?php
/**
 * [山西微链网络科技有限公司] Copyright (c) 2016/3/23
 */
defined('IN_IA') or exit('Access Denied');
function fx_template($filename = '', $flag = TEMPLATE_DISPLAY) {
	global $_W;
	$modulename = IN_MODULE;
	$moduleroot = MODULE_ROOT;
	if (empty($filename)) {
		$filename = str_replace('.', '/', $_W['routes']);
	}
	if (defined('IN_SYS')) {
		$filename = str_replace('/add', '/edit', $filename);
		$filename = str_replace('/post', '/edit', $filename);
		$filename_default = str_replace('/add', '/edit', $filename);
		$filename_default = str_replace('/post', '/edit', $filename_default);
		$filename = 'web/' . $filename_default;
		$filename_v2 = 'web_v2/' . $filename_default;
		
		$compile = IA_ROOT . "/data/tpl/web/{$_W['current_module']['name']}/{$filename}.tpl.php";
		if ($_W['isv2']) {
			if ($_W['_plugin'] == 'merch') {
				$source = $moduleroot . '/template/web_v2/plugins/merch/manage/' . $filename_default . '.html';
				if(!is_file($source)) {
					$source = $moduleroot . '/template/web_v2/plugins/merch/manage/' . $filename_default . '/index.html';
				}
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$_W['current_module']['name']}/template/{$filename_v2}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$_W['current_module']['name']}/template/{$filename_v2}/index.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$modulename}/template/{$filename_v2}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$modulename}/template/{$filename_v2}/index.html";
			}
			if(!is_file($source)) {
				$source = $moduleroot . '/template/web_v2/plugins/' . $filename_default . '.html';
			}
			if (!is_file($source)) {
				$source = $moduleroot . '/template/web_v2/plugins/' . $filename_default . '/index.html';
			}
			if(!is_file($source)) {
				$source = $moduleroot . "/template/{$filename}.html";
			}		
			if(!is_file($source)) {
				$source = $moduleroot . "/template/{$filename}/index.html";
			}
		}else{
			$source = IA_ROOT . "/addons/{$_W['current_module']['name']}/template/{$filename}.html";	
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$_W['current_module']['name']}/template/{$filename}/index.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$_W['current_module']['name']}/template/{$filename_default}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$_W['current_module']['name']}/template/{$filename_default}/index.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$modulename}/template/{$filename}.html";
			}		
			if(!is_file($source)) {
				$source = IA_ROOT . "/addons/{$modulename}/template/{$filename}/index.html";
			}
			if(!is_file($source)) {
				$source = $moduleroot . "/template/{$filename}.html";
			}		
			if(!is_file($source)) {
				$source = $moduleroot . "/template/{$filename}/index.html";
			}
		}
	}else{
		$template = m('cache')->getString('template_shop');
		if (empty($template)) {
			$tpl = m('common')->getSysset('template');
			m('cache')->set('template_shop', $tpl['style']);
			$template = $tpl['style'];
		}
		if (empty($template)) {			 
			$template = 'default';
		}
		if (!is_dir($moduleroot . '/template/mobile/' . $template)) {
			$template = 'default';
		}
		$compile = IA_ROOT . "/data/tpl/app/{$_W['current_module']['name']}/{$filename}.tpl.php";
		$source = IA_ROOT . "/addons/{$_W['current_module']['name']}/template/mobile/{$filename}.html";
		if(!is_file($source)) {			
			$source = IA_ROOT . "/addons/{$_W['current_module']['name']}/template/mobile/{$filename}/index.html";
		}		
		if(!is_file($source)) {
			$source = IA_ROOT . "/addons/{$modulename}/template/mobile/{$template}/{$filename}.html";
		}
		if(!is_file($source)) {
			$source = IA_ROOT . "/addons/{$modulename}/template/mobile/default/{$filename}.html";
		}
		if(!is_file($source)) {
			$source = IA_ROOT . "/addons/{$modulename}/template/mobile/{$template}/{$filename}/index.html";
		}
		if(!is_file($source)) {
			$source = IA_ROOT . "/addons/{$modulename}/template/mobile/default/{$filename}/index.html";
		}		
		if(!is_file($source)) {
			$source = $moduleroot . "/template/mobile/{$template}/{$filename}.html";
		}
		if(!is_file($source)) {
			$source = $moduleroot . "/template/mobile/default/{$filename}.html";
		}
		if(!is_file($source)) {
			$source = $moduleroot . "/template/mobile/{$template}/{$filename}/index.html";
		}
		if(!is_file($source)) {
			$source = $moduleroot . "/template/mobile/default/{$filename}/index.html";
		}
		if(!is_file($source)) {
			$source = IA_ROOT . "/app/themes/{$_W['template']}/{$filename}.html";
		}
	}
	if(!is_file($source)) {
		exit("Error: template source '{$source}' is not exist!");
	}
	if(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
		fx_template_compile($source, $compile);
	}
	switch ($flag) {
		case TEMPLATE_DISPLAY:
			return $compile;
			break;
		case TEMPLATE_FETCH:
			extract($GLOBALS, EXTR_SKIP);
			ob_flush();
			ob_clean();
			ob_start();
			include $compile;
			$contents = ob_get_contents();
			ob_clean();
			return $contents;
			break;
		case TEMPLATE_INCLUDEPATH:
			return $compile;
			break;
		default:
			extract($GLOBALS, EXTR_SKIP);
			include $compile;
			break;
	}
}

function fx_template_compile($from, $to, $inmodule = false) {
	$path = dirname($to);
	if (!is_dir($path)) {
		load()->func('file');
		mkdirs($path);
	}
	$content = fx_template_parse(file_get_contents($from), $inmodule);
	if(IMS_FAMILY == 'x' && !preg_match('/(footer|header|account\/welcome|login|register|home\/welcome)+/', $from)) {
		$content = str_replace('微擎', '系统', $content);
	}
	file_put_contents($to, $content);
}


function fx_template_parse($str, $inmodule = false) {
	global $_GPC;
	$str = preg_replace('/<!--{(.+?)}-->/s', '{$1}', $str);
	$str = preg_replace('/{fx_template\s+(.+?)}/', '<?php (!empty($this) && $this instanceof WeModuleSite || '.intval($inmodule).') ? (include fx_template($1, TEMPLATE_INCLUDEPATH)) : (include fx_template($1, TEMPLATE_INCLUDEPATH));?>', $str);
	$str = preg_replace('/{template\s+(.+?)}/', '<?php (!empty($this) && $this instanceof WeModuleSite || '.intval($inmodule).') ? (include $this->template($1, TEMPLATE_INCLUDEPATH)) : (include template($1, TEMPLATE_INCLUDEPATH));?>', $str);
	$str = preg_replace('/{php\s+(.+?)}/', '<?php $1?>', $str);
	$str = preg_replace('/{if\s+(.+?)}/', '<?php if($1) { ?>', $str);
	$str = preg_replace('/{else}/', '<?php } else { ?>', $str);
	$str = preg_replace('/{else ?if\s+(.+?)}/', '<?php } else if($1) { ?>', $str);
	$str = preg_replace('/{\/if}/', '<?php } ?>', $str);
	$str = preg_replace('/{loop\s+(\S+)\s+(\S+)}/', '<?php if(is_array($1)) { foreach($1 as $2) { ?>', $str);
	$str = preg_replace('/{loop\s+(\S+)\s+(\S+)\s+(\S+)}/', '<?php if(is_array($1)) { foreach($1 as $2 => $3) { ?>', $str);
	$str = preg_replace('/{\/loop}/', '<?php } } ?>', $str);
	$str = preg_replace('/{(\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)}/', '<?php echo $1;?>', $str);
	$str = preg_replace('/{(\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff\[\]\'\"\$]*)}/', '<?php echo $1;?>', $str);
	$str = preg_replace('/{url\s+(\S+)}/', '<?php echo url($1);?>', $str);
	$str = preg_replace('/{url\s+(\S+)\s+(array\(.+?\))}/', '<?php echo url($1, $2);?>', $str);
	$str = preg_replace('/{media\s+(\S+)}/', '<?php echo tomedia($1);?>', $str);
	$str = preg_replace_callback('/<\?php([^\?]+)\?>/s', "fx_template_addquote", $str);
	$str = preg_replace('/{\/hook}/', '<?php ; ?>', $str);
	$str = preg_replace('/{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)}/s', '<?php echo $1;?>', $str);
	$str = str_replace('{##', '{', $str);
	$str = str_replace('##}', '}', $str);
	if (!empty($GLOBALS['_W']['setting']['remote']['type'])) {
		$str = str_replace('</body>', "<script>$(function(){\$('img').attr('onerror', '').on('error', function(){if (!\$(this).data('check-src') && (this.src.indexOf('http://') > -1 || this.src.indexOf('https://') > -1)) {this.src = this.src.indexOf('{$GLOBALS['_W']['attachurl_local']}') == -1 ? this.src.replace('{$GLOBALS['_W']['attachurl_remote']}', '{$GLOBALS['_W']['attachurl_local']}') : this.src.replace('{$GLOBALS['_W']['attachurl_local']}', '{$GLOBALS['_W']['attachurl_remote']}');\$(this).data('check-src', true);}});});</script></body>", $str);
	}
	$str = "<?php defined('IN_IA') or exit('Access Denied');?>" . $str;
	return $str;
}

function fx_template_addquote($matchs) {
	$code = "<?php {$matchs[1]}?>";
	$code = preg_replace('/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\](?![a-zA-Z0-9_\-\.\x7f-\xff\[\]]*[\'"])/s', "['$1']", $code);
	return str_replace('\\\"', '\"', $code);
}