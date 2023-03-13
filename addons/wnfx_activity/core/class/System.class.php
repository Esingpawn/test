<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2023-2025.
// +----------------------------------------------------------------------
// | Describe: 入口模型
// +----------------------------------------------------------------------
// | Author: sxwelink
// +----------------------------------------------------------------------
class System
{
	/**
     * 处理历史记录
     */
	static function history_url()
	{
		global $_W;
		global $_GPC;

		$history_url = $_GPC['history_url'];

		if (empty($history_url)) {
			$history_url = array();
		}
		else {
			$history_url = htmlspecialchars_decode($history_url);
			$history_url = json_decode($history_url, true);
		}

		if (!empty($history_url)) {
			$this_url = str_replace($_W['siteroot'] . 'web/', './', $_W['siteurl']);

			foreach ($history_url as $index => $history_url_item) {
				$item_url = str_replace($_W['siteroot'] . 'web/', './', $history_url_item['url']);

				if ($item_url == $this_url) {
					unset($history_url[$index]);
				}
			}
		}

		$submenu = $this->getSubMenus(true);
		$thispage = array();

		if (!empty($submenu)) {
			foreach ($submenu as $submenu_item) {
				if ($_GPC['r'] == $submenu_item['route'] && $this->verifyParam($submenu_item)) {
					$submenu_item['url'] = str_replace($_W['siteroot'] . 'web/', './', $submenu_item['url']);
					$thispage = $submenu_item;

					if (!empty($submenu_item['toptitle'])) {
						$thispage['title'] = $submenu_item['toptitle'] . '-' . $submenu_item['title'];
					}

					break;
				}
			}
		}

		if ($thispage) {
			$thispage_item = array(
				array('title' => $thispage['title'], 'url' => $thispage['url'])
			);
			$history_url = array_merge($thispage_item, $history_url);

			if (10 < count($history_url)) {
				$history_url = array_slice($history_url, 0, 10);
			}

			isetcookie(!$this->merch ? 'history_url' : 'merch_history_url', json_encode($history_url), 7 * 86400);
		}
	}
}