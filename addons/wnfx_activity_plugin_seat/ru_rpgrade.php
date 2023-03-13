<?php
$sql="
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

";
pdo_run($sql);
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
