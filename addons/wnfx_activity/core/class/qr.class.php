<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 报名操作模型类
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
 class qr
 {
	/** 
	* 生成临时参数二维码
	* 
	* @access static
	* @name insertQrcode 
	* @param keyword 绑定的关键词
	* @return array 
	*/  
	static function getQrcode($param){
		global $_W,$_GPC;
		$acid = $_W['uniacid'];
		$barcode = array(
			'expire_seconds' => '',
			'action_name' => '',
			'action_info' => array(
				'scene' => array()
			),
		);
		$keyword = 'FX'.$param['id'];
		$qrcode = pdo_fetch("SELECT * FROM ".tablename('qrcode')." WHERE acid = :acid AND model = '1' AND type = 'scene' AND scene_str = :scene_str AND keyword = :keyword ORDER BY qrcid DESC LIMIT 1", array(':acid' => $acid,':scene_str'=>$param['scene_str'],':keyword'=>$keyword));
		
		if (!empty($qrcode)) {
			$qrcode['endtime'] = $qrcode['createtime'] + $qrcode['expire'];
			if (TIMESTAMP > $qrcode['endtime']) {
				$scene_id = $qrcode['qrcid'];
			} else {
				$arr = array(
					'error'=>0,
					'ticket'=>$qrcode['ticket'],
				);
				return $arr;
			}			
		}else{
			$qrcid = pdo_fetchcolumn("SELECT qrcid FROM ".tablename('qrcode')." WHERE acid = :acid AND model = '1' AND type = 'scene' ORDER BY qrcid DESC LIMIT 1", array(':acid' => $acid));
			$scene_id = !empty($qrcid) ? ($qrcid + 1) : 100001;
		}
		
		$barcode['action_info']['scene']['scene_id'] = $scene_id;
		$barcode['action_info']['scene']['scene_str'] = $param['scene_str'];
		$barcode['expire_seconds'] = intval($param['seconds']);
		$barcode['action_name'] = 'QR_SCENE';
		$uniacccount = WeAccount::create($acid);
		$result = $uniacccount->barCodeCreateDisposable($barcode);
		
		if (!is_error($result)) {
			$data = array(
				'uniacid' => $_W['uniacid'],
				'acid' => $acid,
				'qrcid' => $barcode['action_info']['scene']['scene_id'],
				'scene_str' => $barcode['action_info']['scene']['scene_str'],
				'keyword' => $keyword,
				'name' => $param['name'],
				'model' => $param['model'],
				'ticket' => $result['ticket'],
				'url' => $result['url'],
				'expire' => $result['expire_seconds'],
				'createtime' => TIMESTAMP,
				'status' => '1',
				'type' => 'scene',
			);
			if (!empty($qrcode)) {
				pdo_update('qrcode', $data,array('uniacid'=>$acid,'scene_str'=>$param['scene_str'],'keyword'=>$keyword));
			}else{
				pdo_insert('qrcode', $data);
			}
			$arr = array(
				'error'=>0,
				'ticket'=>$result['ticket'],
				'msg'=>"恭喜，设置带参数二维码成功",
			);
		} else {
			$arr = array(
				'error'=>1,
				'msg'=>"公众平台返回接口错误. <br />错误代码为: {$result['errorcode']} <br />错误信息为: {$result['message']}",
			);
		}
		return $arr;
	}
	
	static function setReply($param){
		global $_W,$_GPC;
		$reply = pdo_get('cover_reply', array('module' => IN_MODULE, 'multiid' => $param['id'], 'uniacid' => $_W['uniacid']));
		
		$rule = array(
			'uniacid' => $_W['uniacid'],
			'name' => IN_MODULE.":".$_GPC['do'].':'.$param['id'],
			'module' => 'cover',
			'containtype' => '',
			'status' => 1,
			'displayorder' => 0,
		);
		
		if (!empty($reply)) {
			$rid = $reply['rid'];
			//$result = pdo_update('rule', $rule, array('id' => $rid));
		} else {
			$result = pdo_insert('rule', $rule);
			$rid = pdo_insertid();
			$keyword_data = array(
				'uniacid' => $_W['uniacid'],
				'rid' => $rid,
				'module' => 'cover',
				'content' => 'FX'.$param['id'],
				'type' => 1,
				'displayorder' => 0,
				'status' => 1
			);
			pdo_insert('rule_keyword', $keyword_data);
		}
		
		if (!empty($rid)) {
			$entry = array(
				'uniacid' => $_W['uniacid'],
				'multiid' => $param['id'],
				'rid' => $rid,
				'title' => $param['title'],
				'description' => $param['description'],
				'thumb' => $param['thumb'],
				'url' => app_url('activity/detail',array('id'=>$param['id'])),
				'do' => $_GPC['do'],
				'module' => IN_MODULE,
			);
			if (empty($reply['id'])) {
				pdo_insert('cover_reply', $entry);
			} else {
				pdo_update('cover_reply', $entry, array('id' => $reply['id']));
			}
		}
	}
}