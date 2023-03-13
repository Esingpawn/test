<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_fx_activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(11) NOT NULL,
  `uniacid` int(10) NOT NULL COMMENT '公众号ID',
  `title` varchar(255) NOT NULL COMMENT '活动名称',
  `pagetitle` varchar(50) NOT NULL COMMENT '标题名称',
  `freetitle` varchar(32) NOT NULL COMMENT '免费活动标题',
  `aprice` decimal(10,2) NOT NULL COMMENT '活动金额',
  `costprice` decimal(10,2) NOT NULL COMMENT '年卡价格',
  `mprice` decimal(10,2) NOT NULL COMMENT '原价',
  `sharetitle` varchar(200) NOT NULL COMMENT '分享标题',
  `sharepic` varchar(255) NOT NULL COMMENT '分享图片',
  `sharedesc` varchar(255) NOT NULL COMMENT '分享描述',
  `kefu` text NOT NULL COMMENT '客服信息',
  `unitintro` text NOT NULL COMMENT '主办单位介绍',
  `tel` varchar(13) NOT NULL COMMENT '联系电话',
  `intro` text NOT NULL COMMENT '简要概述',
  `detail` mediumtext NOT NULL COMMENT '详细内容',
  `starttime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '开始时间',
  `endtime` timestamp NULL DEFAULT NULL COMMENT '结束时间',
  `joinstime` timestamp NULL DEFAULT NULL COMMENT '报名开始时间',
  `joinetime` timestamp NULL DEFAULT NULL COMMENT '报名结束时间',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `atlas` text NOT NULL COMMENT '图集',
  `gnum` int(11) NOT NULL COMMENT '活动库存',
  `lng` varchar(255) NOT NULL COMMENT '经度',
  `lat` varchar(255) NOT NULL COMMENT '纬度',
  `adinfo` varchar(255) NOT NULL COMMENT '城市信息',
  `addname` varchar(255) NOT NULL COMMENT '地点名称',
  `address` varchar(255) NOT NULL COMMENT '详细地址',
  `prize` text NOT NULL COMMENT '奖励设置',
  `form` text NOT NULL COMMENT '固定表单',
  `displayorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `limitnum` int(11) NOT NULL COMMENT '限购数量',
  `hasoption` tinyint(2) NOT NULL DEFAULT '0' COMMENT '开启规格',
  `show` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `midkey` varchar(50) NOT NULL COMMENT '商家二维码key',
  `smsnotify` varchar(2000) NOT NULL COMMENT '短信通知',
  `trueread` int(11) NOT NULL DEFAULT '0' COMMENT '真实阅读量',
  `trueshare` int(11) NOT NULL DEFAULT '0' COMMENT '真实转发量',
  `parentid` int(11) NOT NULL COMMENT '一级分类ID',
  `childid` int(11) NOT NULL COMMENT '二级分类ID',
  `recommend` tinyint(2) NOT NULL DEFAULT '0' COMMENT '推荐',
  `viewauth` tinyint(2) NOT NULL DEFAULT '0' COMMENT '访问权限:0公开1私密2粉丝可见',
  `review` tinyint(2) NOT NULL DEFAULT '1' COMMENT '发布审核状态：0为待审核，1为已审核',
  `openids` text NOT NULL COMMENT '管理员openid',
  `tmplmsg` text NOT NULL COMMENT '自定义消息标题备注',
  `merchantid` int(11) NOT NULL COMMENT '商家ID',
  `storeids` text NOT NULL COMMENT '门店ID',
  `hasstore` tinyint(2) NOT NULL DEFAULT '0' COMMENT '位置自定义开启',
  `atype` tinyint(2) NOT NULL DEFAULT '1' COMMENT '活动类型',
  `agreement` text NOT NULL COMMENT '报名协议',
  `info` text NOT NULL COMMENT '报名须知',
  `falsedata` text NOT NULL COMMENT '虚拟数据',
  `hasonline` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否线上活动',
  `unitstr` varchar(32) NOT NULL COMMENT '库存单位',
  `gnumshow` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否显示库存',
  `costcredit` int(11) DEFAULT NULL COMMENT '报名消耗积分',
  `switch` text NOT NULL COMMENT '功能开关字段',
  `iscard` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启年卡支持',
  `signin` text COMMENT '签到设置',
  `cycle` tinyint(2) NOT NULL DEFAULT '0' COMMENT '回收站：0恢复，1回收站',
  `thumbsize` varchar(2000) NOT NULL COMMENT '缩略图信息',
  `seatid` int(11) NOT NULL COMMENT '座位ID',
  `video` varchar(1000) NOT NULL DEFAULT '' COMMENT '视频',
  `phasetype` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_activity_favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `activityid` int(11) NOT NULL,
  `openid` varchar(200) NOT NULL,
  `uid` int(11) NOT NULL,
  `favo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_activity_records` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `openid` varchar(255) NOT NULL COMMENT '微信用户id',
  `activityid` int(11) NOT NULL COMMENT '活动ID',
  `buynum` int(11) NOT NULL DEFAULT '1' COMMENT '购买数量',
  `orderno` varchar(50) NOT NULL COMMENT '订单编号',
  `price` varchar(45) NOT NULL COMMENT '应付金额',
  `aprice` varchar(45) NOT NULL COMMENT '活动金额',
  `freight` varchar(45) NOT NULL COMMENT '运费',
  `vipdeduct` varchar(45) NOT NULL COMMENT '高级vip优惠金额',
  `paytime` timestamp NULL DEFAULT NULL COMMENT '支付成功时间',
  `uniontid` varchar(50) NOT NULL COMMENT '商户单号',
  `transid` varchar(50) NOT NULL COMMENT '交易单号',
  `remark` varchar(1024) NOT NULL COMMENT '备注',
  `payprice` varchar(45) NOT NULL COMMENT '实付金额',
  `paytype` varchar(45) NOT NULL COMMENT '支付方式',
  `nickname` varchar(255) NOT NULL COMMENT '用户昵称',
  `realname` varchar(255) NOT NULL COMMENT '姓名',
  `mobile` varchar(255) NOT NULL COMMENT '手机',
  `gender` varchar(10) NOT NULL COMMENT '性别',
  `pic` varchar(255) NOT NULL COMMENT '照片',
  `headimgurl` varchar(255) NOT NULL COMMENT '粉丝头像',
  `msg` text NOT NULL COMMENT '留言',
  `jointime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '报名时间',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '报名状态：0未支付,1支付，2免费，3已消费，4已签收，5已取消，6待退款，7已退款',
  `ishexiao` int(2) NOT NULL DEFAULT '0' COMMENT '0未核销1已核销',
  `hexiaoma` varchar(50) NOT NULL COMMENT '核销码',
  `sendtime` timestamp NULL DEFAULT NULL COMMENT '核销时间',
  `veropenid` varchar(200) NOT NULL COMMENT '核销员onpenid',
  `specs` text NOT NULL,
  `specitems` text NOT NULL,
  `operation` varchar(50) NOT NULL COMMENT '操作员',
  `optionid` int(11) NOT NULL COMMENT '规格ID',
  `optionname` varchar(200) NOT NULL COMMENT '规格名称',
  `review` tinyint(2) NOT NULL DEFAULT '1' COMMENT '审核状态：0为待审核，1为已审核，2为已拒绝, 3为驳回修改',
  `signin` int(11) NOT NULL DEFAULT '0' COMMENT '签到',
  `merchantid` int(11) NOT NULL COMMENT '商家ID',
  `storeid` int(11) NOT NULL COMMENT '门店ID',
  `marketing` text NOT NULL COMMENT '优惠数据',
  `usernum` int(10) NOT NULL COMMENT '用户编号',
  `refundtime` int(11) NOT NULL COMMENT '退款时间',
  `seats` varchar(2000) NOT NULL COMMENT '座位',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_activity_sysset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `sets` longtext,
  `plugins` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `advname` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `applink` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `color` varchar(50) NOT NULL DEFAULT '',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `enabled` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_agents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `agent_level_id` int(11) DEFAULT '0',
  `is_black` tinyint(1) DEFAULT '0',
  `commission_total` decimal(14,2) DEFAULT '0.00',
  `agent_not_upgrade` tinyint(1) DEFAULT '0',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `parent` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_pay` decimal(14,2) DEFAULT '0.00',
  `is_pass` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否通过',
  `del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '关系解除被标记',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_attachment_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `merch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `thumb` varchar(255) NOT NULL COMMENT '分类图片',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `isrecommand` int(10) DEFAULT '0',
  `description` varchar(500) NOT NULL COMMENT '分类介绍',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  `visible_level` int(11) NOT NULL,
  `open` int(11) DEFAULT '0',
  `color` varchar(10) NOT NULL COMMENT '颜色',
  `redirect` varchar(255) NOT NULL COMMENT '跳转连接',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_commission_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `order_sn` varchar(255) DEFAULT NULL,
  `ordertable_id` int(11) DEFAULT NULL,
  `buy_id` int(11) DEFAULT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `commission_amount` decimal(14,2) DEFAULT '0.00',
  `formula` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hierarchy` int(11) DEFAULT '1',
  `commission_rate` decimal(14,2) DEFAULT '0.00',
  `commission` decimal(14,2) DEFAULT '0.00',
  `status` tinyint(1) DEFAULT '0',
  `recrive_at` int(11) DEFAULT NULL,
  `settle_days` int(11) DEFAULT '0',
  `statement_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `withdraw` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `displaytype` varchar(3) NOT NULL,
  `content` text NOT NULL,
  `activityid` int(11) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `essential` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fieldstype` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_form_data` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `activityid` int(11) NOT NULL,
  `recordid` int(11) NOT NULL,
  `formid` int(11) NOT NULL,
  `data` varchar(800) NOT NULL,
  `displayorder` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_form_data_common` (
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `realname` varchar(10) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthyear` smallint(6) unsigned NOT NULL,
  `birthmonth` tinyint(3) unsigned NOT NULL,
  `birthday` tinyint(3) unsigned NOT NULL,
  `constellation` varchar(10) NOT NULL,
  `zodiac` varchar(5) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `idcard` varchar(30) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `resideprovince` varchar(30) NOT NULL,
  `residecity` varchar(30) NOT NULL,
  `residedist` varchar(30) NOT NULL,
  `graduateschool` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `education` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `revenue` varchar(10) NOT NULL,
  `affectivestatus` varchar(30) NOT NULL,
  `lookingfor` varchar(255) NOT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `alipay` varchar(30) NOT NULL,
  `msn` varchar(30) NOT NULL,
  `taobao` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `interest` text NOT NULL,
  `age` tinyint(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_form_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `formid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `content` text NOT NULL,
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_formid` (`formid`),
  KEY `idx_show` (`show`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_marketing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `activityid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1折扣2满减3抵扣',
  `value` text COMMENT '设置的值',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`activityid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众账号id',
  `isblack` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否黑名单',
  PRIMARY KEY (`id`),
  KEY `idx_uid` (`uid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_member_income` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `incometable_type` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `incometable_id` int(11) DEFAULT NULL,
  `type_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(14,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `pay_status` tinyint(3) NOT NULL DEFAULT '0',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `create_month` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `separate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_merch_perm_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rolename` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `perms` text,
  `perms2` text,
  `deleted` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_deleted` (`deleted`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_merchant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(145) NOT NULL,
  `logo` varchar(225) NOT NULL,
  `industry` varchar(45) NOT NULL,
  `address` varchar(115) NOT NULL,
  `linkman_name` varchar(145) NOT NULL,
  `linkman_mobile` varchar(145) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `createtime` varchar(115) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `detail` varchar(1222) NOT NULL,
  `salenum` int(11) NOT NULL COMMENT '商家销量',
  `open` int(11) NOT NULL COMMENT '是否分配商家权限',
  `uname` varchar(45) NOT NULL,
  `password` varchar(145) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `messageopenid` text NOT NULL,
  `openid` varchar(150) NOT NULL,
  `goodsnum` int(11) NOT NULL,
  `percent` varchar(100) NOT NULL,
  `allsalenum` int(11) DEFAULT NULL,
  `falsenum` int(11) DEFAULT NULL,
  `tag` text,
  `storename` varchar(50) DEFAULT NULL,
  `lng` varchar(145) DEFAULT NULL,
  `lat` varchar(145) DEFAULT NULL,
  `adinfo` varchar(32) DEFAULT NULL,
  `kefuimg` varchar(225) DEFAULT NULL,
  `follownum` int(11) NOT NULL DEFAULT '0' COMMENT '关注量',
  `followno` int(11) NOT NULL DEFAULT '0' COMMENT '虚拟关注量',
  `status` tinyint(3) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_merchant_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchantid` int(11) NOT NULL COMMENT '主办方ID',
  `uniacid` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '操作员id',
  `amount` decimal(10,2) NOT NULL COMMENT '交易总金额',
  `updatetime` varchar(45) NOT NULL COMMENT '上次结算时间',
  `no_money` decimal(10,2) NOT NULL COMMENT '目前未结算金额',
  `no_money_doing` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_merchant_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `merchantid` int(11) NOT NULL,
  `muid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `follow` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` varchar(115) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_merchant_mcert` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '微信openid',
  `mid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1为个人，2为企业',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0待审核，1已审核，2驳回修改',
  `detail` longtext NOT NULL,
  `createtime` int(11) unsigned NOT NULL COMMENT '最后修改时间',
  `endtime` int(11) unsigned NOT NULL COMMENT '到期时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_merchant_money_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `merchantid` int(11) DEFAULT NULL COMMENT '主办方ID',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '变动金额',
  `createtime` varchar(145) DEFAULT NULL COMMENT '变动时间',
  `recordsid` int(11) DEFAULT NULL COMMENT '订单ID',
  `type` int(11) DEFAULT NULL COMMENT '1支付成功2核销成功纳入可结算金额3取消核销4主办方结算5退款6线下支付7手续费',
  `detail` text COMMENT '详情',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_merchant_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchantid` int(11) NOT NULL COMMENT '主办方id',
  `money` varchar(45) NOT NULL COMMENT '本次结算金额',
  `uid` int(11) NOT NULL COMMENT '操作员id',
  `createtime` varchar(45) NOT NULL COMMENT '结算时间',
  `uniacid` int(11) NOT NULL,
  `orderno` varchar(100) DEFAULT NULL,
  `commission` varchar(100) DEFAULT NULL,
  `percent` varchar(100) DEFAULT NULL,
  `get_money` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `updatetime` varchar(145) DEFAULT NULL,
  `checktime` varchar(145) DEFAULT NULL,
  `paytime` varchar(145) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_perm_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `rolename` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `perms` text,
  `perms2` text,
  `deleted` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_deleted` (`deleted`),
  KEY `idx_merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_perm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `username` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `roleid` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `perms` text,
  `perms2` text,
  `deleted` tinyint(3) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `openid` varchar(50) DEFAULT NULL,
  `openid_wa` varchar(50) DEFAULT NULL,
  `member_nick` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_roleid` (`roleid`),
  KEY `idx_status` (`status`),
  KEY `idx_deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE IF NOT EXISTS `ims_fx_poster` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uniacid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `thumb` varchar(500) NOT NULL,
  `textdata` text NOT NULL,
  `imgdata` text NOT NULL,
  `hex` varchar(50) NOT NULL,
  `rgb` varchar(50) NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `enable` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否启用',
  `gname` varchar(200) NOT NULL COMMENT '产品名称',
  `goodsid` int(11) NOT NULL COMMENT '产品ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_refund_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL COMMENT '1手机端2Web端3最后一人退款4部分退款',
  `activityid` int(11) NOT NULL COMMENT '商品ID',
  `payfee` varchar(100) NOT NULL COMMENT '支付金额',
  `refundfee` varchar(100) NOT NULL COMMENT '退还金额',
  `transid` varchar(115) NOT NULL COMMENT '订单编号',
  `refund_id` varchar(115) NOT NULL COMMENT '微信退款单号',
  `refundername` varchar(100) NOT NULL COMMENT '退款人姓名',
  `refundermobile` varchar(100) NOT NULL COMMENT '退款人电话',
  `activityname` varchar(100) NOT NULL COMMENT '商品名称',
  `createtime` varchar(45) NOT NULL COMMENT '退款时间',
  `status` int(11) NOT NULL COMMENT '0未成功1成功',
  `uniacid` int(11) NOT NULL,
  `recordid` varchar(45) NOT NULL,
  `merchantid` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_saler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `storeid` varchar(225) NOT NULL DEFAULT '',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` text NOT NULL,
  `nickname` varchar(145) NOT NULL,
  `avatar` varchar(225) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `merchantid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_storeid` (`storeid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_seat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '场地名称',
  `rows` int(11) NOT NULL COMMENT '行数',
  `columns` int(11) NOT NULL COMMENT '列数',
  `unavailable` text NOT NULL COMMENT '已售出',
  `noavailable` text NOT NULL COMMENT '不可选',
  `gid` varchar(500) NOT NULL,
  `storeid` varchar(500) NOT NULL,
  `merchid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_spec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `content` text NOT NULL,
  `activityid` int(11) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `essential` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `clock1` varchar(50) NOT NULL,
  `clock2` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_spec_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_spec_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `costprice` decimal(10,2) DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `falsenum` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `storename` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `lat` varchar(255) DEFAULT '',
  `lng` varchar(255) DEFAULT '',
  `adinfo` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `createtime` varchar(45) NOT NULL,
  `merchantid` int(11) NOT NULL,
  `storehours` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_withdraw` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `withdraw_sn` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `type` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amounts` decimal(14,2) DEFAULT NULL,
  `poundage` decimal(14,2) DEFAULT NULL,
  `poundage_rate` decimal(11,2) DEFAULT NULL,
  `pay_way` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `audit_at` int(11) DEFAULT NULL,
  `pay_at` int(11) DEFAULT NULL,
  `arrival_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `actual_amounts` decimal(14,2) NOT NULL,
  `actual_poundage` decimal(14,2) NOT NULL,
  `servicetax` decimal(12,2) DEFAULT NULL COMMENT '劳务税',
  `servicetax_rate` decimal(11,2) DEFAULT NULL COMMENT '劳务税比例',
  `actual_servicetax` decimal(12,2) DEFAULT NULL COMMENT '最终劳务税',
  `manual_type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_yearcard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '年卡名称',
  `value` varchar(500) NOT NULL COMMENT '面值',
  `value_first` varchar(500) NOT NULL COMMENT '首次激活面值',
  `is_first` tinyint(3) unsigned NOT NULL COMMENT '开启首次激活',
  `is_first_num` tinyint(3) unsigned NOT NULL COMMENT '首次激活允许累计',
  `thumb` varchar(225) NOT NULL COMMENT '年封面图片',
  `credit` int(11) unsigned NOT NULL COMMENT '赠送积分/年',
  `description` text NOT NULL COMMENT '专属特权',
  `detail` text NOT NULL COMMENT '使用须知',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_yearcard_friend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `realname` varchar(100) NOT NULL,
  `gender` tinyint(1) unsigned NOT NULL,
  `relation` varchar(32) NOT NULL,
  `birthyear` smallint(6) unsigned NOT NULL,
  `birthmonth` tinyint(3) NOT NULL,
  `birthday` tinyint(3) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_fx_yearcard_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `buyuid` int(10) unsigned NOT NULL COMMENT '开卡用户ID',
  `openid` varchar(100) NOT NULL,
  `fid` int(11) unsigned NOT NULL COMMENT '子用户ID',
  `cid` int(10) unsigned NOT NULL COMMENT '年卡ID',
  `value` decimal(10,2) NOT NULL COMMENT '面值',
  `value_first` decimal(10,2) NOT NULL COMMENT '首次激活面值',
  `fee` decimal(10,2) NOT NULL COMMENT '支付金额',
  `pay_fee` decimal(10,2) NOT NULL COMMENT '累计支付',
  `orderno` varchar(50) NOT NULL COMMENT '支付订单号',
  `buynum` int(10) NOT NULL DEFAULT '0' COMMENT '一次购买购买数量',
  `is_first` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是首次激活',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0未支付，1已支付，2已退款',
  `enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用：1启用，2禁用',
  `createtime` int(11) unsigned NOT NULL COMMENT '最后修改时间',
  `end_time` int(11) unsigned NOT NULL COMMENT '到期时间',
  `cycletype` tinyint(1) unsigned NOT NULL DEFAULT '3' COMMENT '周期：1月，2季，3年',
  `remind` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '过期提醒：0关闭，1提醒',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

";
pdo_run($sql);
if(!pdo_fieldexists("fx_activity", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_activity", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `uniacid` int(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "title")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "pagetitle")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `pagetitle` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "freetitle")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `freetitle` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "aprice")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `aprice` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "costprice")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `costprice` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "mprice")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `mprice` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "sharetitle")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `sharetitle` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "sharepic")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `sharepic` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "sharedesc")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `sharedesc` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "kefu")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `kefu` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "unitintro")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `unitintro` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "tel")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `tel` varchar(13) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "intro")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `intro` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "detail")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `detail` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "starttime")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `starttime` timestamp DEFAULT 'CURRENT_TIMESTAMP';");
}
if(!pdo_fieldexists("fx_activity", "endtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `endtime` timestamp;");
}
if(!pdo_fieldexists("fx_activity", "joinstime")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `joinstime` timestamp;");
}
if(!pdo_fieldexists("fx_activity", "joinetime")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `joinetime` timestamp;");
}
if(!pdo_fieldexists("fx_activity", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "atlas")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `atlas` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "gnum")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `gnum` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "lng")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `lng` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "lat")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `lat` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "adinfo")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `adinfo` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "addname")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `addname` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "address")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `address` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "prize")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `prize` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "form")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `form` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `displayorder` int(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "limitnum")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `limitnum` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "hasoption")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `hasoption` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "show")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `show` tinyint(2) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_activity", "midkey")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `midkey` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "smsnotify")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `smsnotify` varchar(2000) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "trueread")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `trueread` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "trueshare")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `trueshare` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "parentid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `parentid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "childid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `childid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "recommend")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `recommend` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "viewauth")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `viewauth` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "review")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `review` tinyint(2) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_activity", "openids")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `openids` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "tmplmsg")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `tmplmsg` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "storeids")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `storeids` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "hasstore")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `hasstore` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "atype")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `atype` tinyint(2) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_activity", "agreement")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `agreement` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "info")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `info` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "falsedata")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `falsedata` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "hasonline")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `hasonline` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "unitstr")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `unitstr` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "gnumshow")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `gnumshow` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "costcredit")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `costcredit` int(11);");
}
if(!pdo_fieldexists("fx_activity", "switch")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `switch` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "iscard")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `iscard` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "signin")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `signin` text;");
}
if(!pdo_fieldexists("fx_activity", "cycle")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `cycle` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity", "thumbsize")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `thumbsize` varchar(2000) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "seatid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `seatid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity", "video")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `video` varchar(1000) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("fx_activity", "phasetype")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity")." ADD `phasetype` tinyint(4) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_favorite", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_favorite")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_activity_favorite", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_favorite")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_favorite", "activityid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_favorite")." ADD `activityid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_favorite", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_favorite")." ADD `openid` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_favorite", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_favorite")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_favorite", "favo")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_favorite")." ADD `favo` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_activity_records", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_activity_records", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `openid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "activityid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `activityid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "buynum")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `buynum` int(11) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_activity_records", "orderno")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `orderno` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "price")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `price` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "aprice")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `aprice` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "freight")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `freight` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "vipdeduct")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `vipdeduct` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "paytime")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `paytime` timestamp;");
}
if(!pdo_fieldexists("fx_activity_records", "uniontid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `uniontid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "transid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `transid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "remark")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `remark` varchar(1024) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "payprice")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `payprice` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "paytype")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `paytype` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `nickname` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "realname")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `realname` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `mobile` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "gender")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `gender` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "pic")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `pic` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "headimgurl")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `headimgurl` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "msg")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `msg` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "jointime")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `jointime` timestamp NOT NULL DEFAULT 'CURRENT_TIMESTAMP';");
}
if(!pdo_fieldexists("fx_activity_records", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `status` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity_records", "ishexiao")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `ishexiao` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity_records", "hexiaoma")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `hexiaoma` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "sendtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `sendtime` timestamp;");
}
if(!pdo_fieldexists("fx_activity_records", "veropenid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `veropenid` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "specs")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `specs` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "specitems")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `specitems` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "operation")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `operation` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "optionid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `optionid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "optionname")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `optionname` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "review")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `review` tinyint(2) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_activity_records", "signin")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `signin` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity_records", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "storeid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `storeid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "marketing")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `marketing` text NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "usernum")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `usernum` int(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "refundtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `refundtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_records", "seats")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_records")." ADD `seats` varchar(2000) NOT NULL;");
}
if(!pdo_fieldexists("fx_activity_sysset", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_sysset")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_activity_sysset", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_sysset")." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_activity_sysset", "sets")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_sysset")." ADD `sets` longtext;");
}
if(!pdo_fieldexists("fx_activity_sysset", "plugins")) {
 pdo_query("ALTER TABLE ".tablename("fx_activity_sysset")." ADD `plugins` longtext;");
}
if(!pdo_fieldexists("fx_adv", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_adv", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_adv", "advname")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `advname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("fx_adv", "link")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("fx_adv", "applink")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `applink` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("fx_adv", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `thumb` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("fx_adv", "color")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `color` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("fx_adv", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_adv", "enabled")) {
 pdo_query("ALTER TABLE ".tablename("fx_adv")." ADD `enabled` int(11) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_agents", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_agents", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("fx_agents", "member_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `member_id` int(11);");
}
if(!pdo_fieldexists("fx_agents", "parent_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `parent_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_agents", "agent_level_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `agent_level_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_agents", "is_black")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `is_black` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_agents", "commission_total")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `commission_total` decimal(14,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_agents", "agent_not_upgrade")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `agent_not_upgrade` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_agents", "content")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `content` text;");
}
if(!pdo_fieldexists("fx_agents", "created_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `created_at` int(11);");
}
if(!pdo_fieldexists("fx_agents", "updated_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `updated_at` int(11);");
}
if(!pdo_fieldexists("fx_agents", "deleted_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `deleted_at` int(11);");
}
if(!pdo_fieldexists("fx_agents", "parent")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `parent` varchar(20);");
}
if(!pdo_fieldexists("fx_agents", "commission_pay")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `commission_pay` decimal(14,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_agents", "is_pass")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `is_pass` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_agents", "del")) {
 pdo_query("ALTER TABLE ".tablename("fx_agents")." ADD `del` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_attachment_group", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_attachment_group")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_attachment_group", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_attachment_group")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_attachment_group", "group_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_attachment_group")." ADD `group_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_attachment_group", "merch_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_attachment_group")." ADD `merch_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_category", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_category", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_category", "name")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `name` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_category", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_category", "parentid")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `parentid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_category", "isrecommand")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `isrecommand` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_category", "description")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `description` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists("fx_category", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_category", "enabled")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_category", "visible_level")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `visible_level` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_category", "open")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `open` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_category", "color")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `color` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_category", "redirect")) {
 pdo_query("ALTER TABLE ".tablename("fx_category")." ADD `redirect` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_commission_order", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_commission_order", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("fx_commission_order", "order_sn")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `order_sn` varchar(255);");
}
if(!pdo_fieldexists("fx_commission_order", "ordertable_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `ordertable_id` int(11);");
}
if(!pdo_fieldexists("fx_commission_order", "buy_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `buy_id` int(11);");
}
if(!pdo_fieldexists("fx_commission_order", "member_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `member_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_commission_order", "commission_amount")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `commission_amount` decimal(14,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_commission_order", "formula")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `formula` varchar(60);");
}
if(!pdo_fieldexists("fx_commission_order", "hierarchy")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `hierarchy` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists("fx_commission_order", "commission_rate")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `commission_rate` decimal(14,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_commission_order", "commission")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `commission` decimal(14,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_commission_order", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_commission_order", "recrive_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `recrive_at` int(11);");
}
if(!pdo_fieldexists("fx_commission_order", "settle_days")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `settle_days` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_commission_order", "statement_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `statement_at` int(11);");
}
if(!pdo_fieldexists("fx_commission_order", "created_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `created_at` int(11);");
}
if(!pdo_fieldexists("fx_commission_order", "updated_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `updated_at` int(11);");
}
if(!pdo_fieldexists("fx_commission_order", "deleted_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `deleted_at` int(11);");
}
if(!pdo_fieldexists("fx_commission_order", "withdraw")) {
 pdo_query("ALTER TABLE ".tablename("fx_commission_order")." ADD `withdraw` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_form", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_form", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_form", "title")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_form", "description")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `description` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists("fx_form", "displaytype")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `displaytype` varchar(3) NOT NULL;");
}
if(!pdo_fieldexists("fx_form", "content")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists("fx_form", "activityid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `activityid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_form", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_form", "essential")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `essential` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_form", "fieldstype")) {
 pdo_query("ALTER TABLE ".tablename("fx_form")." ADD `fieldstype` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data")." ADD `id` bigint(20) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_form_data", "activityid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data")." ADD `activityid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data", "recordid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data")." ADD `recordid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data", "formid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data")." ADD `formid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data", "data")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data")." ADD `data` varchar(800) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data")." ADD `displayorder` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_form_data_common", "rid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `mobile` varchar(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "email")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `email` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `createtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "realname")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `realname` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "qq")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `qq` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "gender")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `gender` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "birthyear")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `birthyear` smallint(6) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "birthmonth")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `birthmonth` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "birthday")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `birthday` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "constellation")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `constellation` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "zodiac")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `zodiac` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "telephone")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `telephone` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "idcard")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `idcard` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "studentid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `studentid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "grade")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `grade` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "address")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `address` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "zipcode")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `zipcode` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "nationality")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `nationality` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "resideprovince")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `resideprovince` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "residecity")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `residecity` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "residedist")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `residedist` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "graduateschool")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `graduateschool` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "company")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `company` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "education")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `education` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "occupation")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `occupation` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "position")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `position` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "revenue")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `revenue` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "affectivestatus")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `affectivestatus` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "lookingfor")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `lookingfor` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "bloodtype")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `bloodtype` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "height")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `height` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "weight")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `weight` varchar(5) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "alipay")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `alipay` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "msn")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `msn` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "taobao")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `taobao` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "site")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `site` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "bio")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `bio` text NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "interest")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `interest` text NOT NULL;");
}
if(!pdo_fieldexists("fx_form_data_common", "age")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_data_common")." ADD `age` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_item", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_item")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_form_item", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_item")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_form_item", "formid")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_item")." ADD `formid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_form_item", "title")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_item")." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_form_item", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_item")." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_form_item", "show")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_item")." ADD `show` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_form_item", "content")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_item")." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists("fx_form_item", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_form_item")." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_marketing", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_marketing")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_marketing", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_marketing")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("fx_marketing", "activityid")) {
 pdo_query("ALTER TABLE ".tablename("fx_marketing")." ADD `activityid` int(11);");
}
if(!pdo_fieldexists("fx_marketing", "type")) {
 pdo_query("ALTER TABLE ".tablename("fx_marketing")." ADD `type` int(11);");
}
if(!pdo_fieldexists("fx_marketing", "value")) {
 pdo_query("ALTER TABLE ".tablename("fx_marketing")." ADD `value` text;");
}
if(!pdo_fieldexists("fx_member", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_member")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_member", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_member")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_member", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_member")." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_member", "isblack")) {
 pdo_query("ALTER TABLE ".tablename("fx_member")." ADD `isblack` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_member_income", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_member_income", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_member_income", "member_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `member_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_member_income", "incometable_type")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `incometable_type` varchar(60) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("fx_member_income", "incometable_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `incometable_id` int(11);");
}
if(!pdo_fieldexists("fx_member_income", "type_name")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `type_name` varchar(120);");
}
if(!pdo_fieldexists("fx_member_income", "amount")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `amount` decimal(14,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_member_income", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_member_income", "pay_status")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `pay_status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_member_income", "detail")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `detail` text;");
}
if(!pdo_fieldexists("fx_member_income", "create_month")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `create_month` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists("fx_member_income", "created_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `created_at` int(11);");
}
if(!pdo_fieldexists("fx_member_income", "updated_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `updated_at` int(11);");
}
if(!pdo_fieldexists("fx_member_income", "deleted_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `deleted_at` int(11);");
}
if(!pdo_fieldexists("fx_member_income", "separate")) {
 pdo_query("ALTER TABLE ".tablename("fx_member_income")." ADD `separate` text;");
}
if(!pdo_fieldexists("fx_merch_perm_role", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_merch_perm_role")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_merch_perm_role", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merch_perm_role")." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_merch_perm_role", "rolename")) {
 pdo_query("ALTER TABLE ".tablename("fx_merch_perm_role")." ADD `rolename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_merch_perm_role", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_merch_perm_role")." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_merch_perm_role", "perms")) {
 pdo_query("ALTER TABLE ".tablename("fx_merch_perm_role")." ADD `perms` text;");
}
if(!pdo_fieldexists("fx_merch_perm_role", "perms2")) {
 pdo_query("ALTER TABLE ".tablename("fx_merch_perm_role")." ADD `perms2` text;");
}
if(!pdo_fieldexists("fx_merch_perm_role", "deleted")) {
 pdo_query("ALTER TABLE ".tablename("fx_merch_perm_role")." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_merchant", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_merchant", "name")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `name` varchar(145) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "logo")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `logo` varchar(225) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "industry")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `industry` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "address")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `address` varchar(115) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "linkman_name")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `linkman_name` varchar(145) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "linkman_mobile")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `linkman_mobile` varchar(145) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `createtime` varchar(115) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "detail")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `detail` varchar(1222) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "salenum")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `salenum` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "open")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `open` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "uname")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `uname` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "password")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `password` varchar(145) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "messageopenid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `messageopenid` text NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `openid` varchar(150) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "goodsnum")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `goodsnum` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "percent")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `percent` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant", "allsalenum")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `allsalenum` int(11);");
}
if(!pdo_fieldexists("fx_merchant", "falsenum")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `falsenum` int(11);");
}
if(!pdo_fieldexists("fx_merchant", "tag")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `tag` text;");
}
if(!pdo_fieldexists("fx_merchant", "storename")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `storename` varchar(50);");
}
if(!pdo_fieldexists("fx_merchant", "lng")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `lng` varchar(145);");
}
if(!pdo_fieldexists("fx_merchant", "lat")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `lat` varchar(145);");
}
if(!pdo_fieldexists("fx_merchant", "adinfo")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `adinfo` varchar(32);");
}
if(!pdo_fieldexists("fx_merchant", "kefuimg")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `kefuimg` varchar(225);");
}
if(!pdo_fieldexists("fx_merchant", "follownum")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `follownum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_merchant", "followno")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `followno` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_merchant", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant")." ADD `status` tinyint(3) DEFAULT '1';");
}
if(!pdo_fieldexists("fx_merchant_account", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_account")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_merchant_account", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_account")." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_account", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_account")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_account", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_account")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_account", "amount")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_account")." ADD `amount` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_account", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_account")." ADD `updatetime` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_account", "no_money")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_account")." ADD `no_money` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_account", "no_money_doing")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_account")." ADD `no_money_doing` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_fans", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_fans")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_merchant_fans", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_fans")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_fans", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_fans")." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_fans", "muid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_fans")." ADD `muid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_fans", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_fans")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_fans", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_fans")." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_fans", "follow")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_fans")." ADD `follow` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_merchant_fans", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_fans")." ADD `createtime` varchar(115) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_mcert", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_merchant_mcert", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_mcert", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `openid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_mcert", "mid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `mid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_mcert", "type")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `type` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_mcert", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_merchant_mcert", "detail")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `detail` longtext NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_mcert", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `createtime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_mcert", "endtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_mcert")." ADD `endtime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_money_record", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_money_record")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_merchant_money_record", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_money_record")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("fx_merchant_money_record", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_money_record")." ADD `merchantid` int(11);");
}
if(!pdo_fieldexists("fx_merchant_money_record", "money")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_money_record")." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_merchant_money_record", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_money_record")." ADD `createtime` varchar(145);");
}
if(!pdo_fieldexists("fx_merchant_money_record", "recordsid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_money_record")." ADD `recordsid` int(11);");
}
if(!pdo_fieldexists("fx_merchant_money_record", "type")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_money_record")." ADD `type` int(11);");
}
if(!pdo_fieldexists("fx_merchant_money_record", "detail")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_money_record")." ADD `detail` text;");
}
if(!pdo_fieldexists("fx_merchant_record", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_merchant_record", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_record", "money")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `money` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_record", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_record", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `createtime` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_record", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_merchant_record", "orderno")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `orderno` varchar(100);");
}
if(!pdo_fieldexists("fx_merchant_record", "commission")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `commission` varchar(100);");
}
if(!pdo_fieldexists("fx_merchant_record", "percent")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `percent` varchar(100);");
}
if(!pdo_fieldexists("fx_merchant_record", "get_money")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `get_money` varchar(100);");
}
if(!pdo_fieldexists("fx_merchant_record", "type")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `type` int(11);");
}
if(!pdo_fieldexists("fx_merchant_record", "updatetime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `updatetime` varchar(145);");
}
if(!pdo_fieldexists("fx_merchant_record", "checktime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `checktime` varchar(145);");
}
if(!pdo_fieldexists("fx_merchant_record", "paytime")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `paytime` varchar(145);");
}
if(!pdo_fieldexists("fx_merchant_record", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_merchant_record")." ADD `status` int(11);");
}
if(!pdo_fieldexists("fx_perm_role", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_role")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_perm_role", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_role")." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_role", "merchid")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_role")." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_role", "rolename")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_role")." ADD `rolename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_perm_role", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_role")." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_role", "perms")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_role")." ADD `perms` text;");
}
if(!pdo_fieldexists("fx_perm_role", "perms2")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_role")." ADD `perms2` text;");
}
if(!pdo_fieldexists("fx_perm_role", "deleted")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_role")." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_user", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_perm_user", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_user", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_user", "username")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `username` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_perm_user", "password")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `password` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_perm_user", "roleid")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `roleid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_user", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_user", "perms")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `perms` text;");
}
if(!pdo_fieldexists("fx_perm_user", "perms2")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `perms2` text;");
}
if(!pdo_fieldexists("fx_perm_user", "deleted")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_perm_user", "realname")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `realname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_perm_user", "mobile")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `mobile` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_perm_user", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `openid` varchar(50);");
}
if(!pdo_fieldexists("fx_perm_user", "openid_wa")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `openid_wa` varchar(50);");
}
if(!pdo_fieldexists("fx_perm_user", "member_nick")) {
 pdo_query("ALTER TABLE ".tablename("fx_perm_user")." ADD `member_nick` varchar(50);");
}
if(!pdo_fieldexists("fx_poster", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_poster", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_poster", "name")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `name` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_poster", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `thumb` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists("fx_poster", "textdata")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `textdata` text NOT NULL;");
}
if(!pdo_fieldexists("fx_poster", "imgdata")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `imgdata` text NOT NULL;");
}
if(!pdo_fieldexists("fx_poster", "hex")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `hex` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_poster", "rgb")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `rgb` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_poster", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `createtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_poster", "enable")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `enable` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_poster", "gname")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `gname` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("fx_poster", "goodsid")) {
 pdo_query("ALTER TABLE ".tablename("fx_poster")." ADD `goodsid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_refund_record", "type")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `type` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "activityid")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `activityid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "payfee")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `payfee` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "refundfee")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `refundfee` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "transid")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `transid` varchar(115) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "refund_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `refund_id` varchar(115) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "refundername")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `refundername` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "refundermobile")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `refundermobile` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "activityname")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `activityname` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `createtime` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `status` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "recordid")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `recordid` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_refund_record", "remark")) {
 pdo_query("ALTER TABLE ".tablename("fx_refund_record")." ADD `remark` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists("fx_saler", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_saler")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_saler", "storeid")) {
 pdo_query("ALTER TABLE ".tablename("fx_saler")." ADD `storeid` varchar(225) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists("fx_saler", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_saler")." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_saler", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fx_saler")." ADD `openid` text NOT NULL;");
}
if(!pdo_fieldexists("fx_saler", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("fx_saler")." ADD `nickname` varchar(145) NOT NULL;");
}
if(!pdo_fieldexists("fx_saler", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("fx_saler")." ADD `avatar` varchar(225) NOT NULL;");
}
if(!pdo_fieldexists("fx_saler", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_saler")." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_saler", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_saler")." ADD `merchantid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_seat", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_seat", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_seat", "name")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_seat", "rows")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `rows` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_seat", "columns")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `columns` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_seat", "unavailable")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `unavailable` text NOT NULL;");
}
if(!pdo_fieldexists("fx_seat", "noavailable")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `noavailable` text NOT NULL;");
}
if(!pdo_fieldexists("fx_seat", "gid")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `gid` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists("fx_seat", "storeid")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `storeid` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists("fx_seat", "merchid")) {
 pdo_query("ALTER TABLE ".tablename("fx_seat")." ADD `merchid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_spec", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_spec", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_spec", "title")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_spec", "description")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `description` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists("fx_spec", "content")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists("fx_spec", "activityid")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `activityid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec", "essential")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `essential` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec", "clock1")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `clock1` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_spec", "clock2")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec")." ADD `clock2` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_spec_item", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_item")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_spec_item", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_item")." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_spec_item", "specid")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_item")." ADD `specid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec_item", "title")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_item")." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_spec_item", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_item")." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_spec_item", "show")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_item")." ADD `show` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec_item", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_item")." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec_option", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_spec_option", "activityid")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `activityid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec_option", "title")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists("fx_spec_option", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `thumb` varchar(60) DEFAULT '';");
}
if(!pdo_fieldexists("fx_spec_option", "marketprice")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `marketprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_spec_option", "productprice")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `productprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_spec_option", "costprice")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `costprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists("fx_spec_option", "stock")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `stock` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec_option", "falsenum")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `falsenum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec_option", "displayorder")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_spec_option", "specs")) {
 pdo_query("ALTER TABLE ".tablename("fx_spec_option")." ADD `specs` text;");
}
if(!pdo_fieldexists("fx_store", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_store", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_store", "storename")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `storename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_store", "address")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_store", "tel")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `tel` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_store", "lat")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `lat` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_store", "lng")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `lng` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_store", "adinfo")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `adinfo` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists("fx_store", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists("fx_store", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `createtime` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists("fx_store", "merchantid")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("fx_store", "storehours")) {
 pdo_query("ALTER TABLE ".tablename("fx_store")." ADD `storehours` varchar(100);");
}
if(!pdo_fieldexists("fx_withdraw", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_withdraw", "withdraw_sn")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `withdraw_sn` varchar(120) NOT NULL;");
}
if(!pdo_fieldexists("fx_withdraw", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("fx_withdraw", "member_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `member_id` int(11);");
}
if(!pdo_fieldexists("fx_withdraw", "type")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `type` varchar(60);");
}
if(!pdo_fieldexists("fx_withdraw", "type_id")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `type_id` text;");
}
if(!pdo_fieldexists("fx_withdraw", "type_name")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `type_name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_withdraw", "amounts")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `amounts` decimal(14,2);");
}
if(!pdo_fieldexists("fx_withdraw", "poundage")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `poundage` decimal(14,2);");
}
if(!pdo_fieldexists("fx_withdraw", "poundage_rate")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `poundage_rate` decimal(11,2);");
}
if(!pdo_fieldexists("fx_withdraw", "pay_way")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `pay_way` varchar(100);");
}
if(!pdo_fieldexists("fx_withdraw", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("fx_withdraw", "created_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `created_at` int(11);");
}
if(!pdo_fieldexists("fx_withdraw", "audit_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `audit_at` int(11);");
}
if(!pdo_fieldexists("fx_withdraw", "pay_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `pay_at` int(11);");
}
if(!pdo_fieldexists("fx_withdraw", "arrival_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `arrival_at` int(11);");
}
if(!pdo_fieldexists("fx_withdraw", "updated_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `updated_at` int(11);");
}
if(!pdo_fieldexists("fx_withdraw", "deleted_at")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `deleted_at` int(11);");
}
if(!pdo_fieldexists("fx_withdraw", "actual_amounts")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `actual_amounts` decimal(14,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_withdraw", "actual_poundage")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `actual_poundage` decimal(14,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_withdraw", "servicetax")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `servicetax` decimal(12,2);");
}
if(!pdo_fieldexists("fx_withdraw", "servicetax_rate")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `servicetax_rate` decimal(11,2);");
}
if(!pdo_fieldexists("fx_withdraw", "actual_servicetax")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `actual_servicetax` decimal(12,2);");
}
if(!pdo_fieldexists("fx_withdraw", "manual_type")) {
 pdo_query("ALTER TABLE ".tablename("fx_withdraw")." ADD `manual_type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_yearcard", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_yearcard", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "name")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `name` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "value")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `value` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "value_first")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `value_first` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "is_first")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `is_first` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "is_first_num")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `is_first_num` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `thumb` varchar(225) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "credit")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `credit` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "description")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `description` text NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "detail")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `detail` text NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard")." ADD `createtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `uid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "realname")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `realname` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "gender")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `gender` tinyint(1) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "relation")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `relation` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "birthyear")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `birthyear` smallint(6) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "birthmonth")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `birthmonth` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "birthday")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `birthday` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_friend", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_friend")." ADD `createtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "id")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("fx_yearcard_record", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "uid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `uid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "buyuid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `buyuid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "openid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "fid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `fid` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "cid")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `cid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "value")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `value` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "value_first")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `value_first` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "fee")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `fee` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "pay_fee")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `pay_fee` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "orderno")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `orderno` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "buynum")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `buynum` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_yearcard_record", "is_first")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `is_first` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_yearcard_record", "status")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists("fx_yearcard_record", "enable")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `enable` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists("fx_yearcard_record", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `createtime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "end_time")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `end_time` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists("fx_yearcard_record", "cycletype")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `cycletype` tinyint(1) unsigned NOT NULL DEFAULT '3';");
}
if(!pdo_fieldexists("fx_yearcard_record", "remind")) {
 pdo_query("ALTER TABLE ".tablename("fx_yearcard_record")." ADD `remind` tinyint(1) unsigned NOT NULL DEFAULT '1';");
}
