<?php
$sql="
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
