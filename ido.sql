/*
 Navicat MySQL Data Transfer

 Source Server         : self
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : ido

 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 09/15/2016 03:33:57 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ido_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `ido_admin_user`;
CREATE TABLE `ido_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_pass` char(32) NOT NULL,
  `real_name` varchar(50) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `last_login` int(11) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ido_admin_user`
-- ----------------------------
BEGIN;
INSERT INTO `ido_admin_user` VALUES ('1', 'admin', '098f6bcd4621d373cade4e832627b4f6', '系统管理员', null, '1', '1473830057', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ido_banner`
-- ----------------------------
DROP TABLE IF EXISTS `ido_banner`;
CREATE TABLE `ido_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(100) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `operator` int(11) NOT NULL,
  `ct` int(11) NOT NULL,
  `mt` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ido_category`
-- ----------------------------
DROP TABLE IF EXISTS `ido_category`;
CREATE TABLE `ido_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `ct` int(11) DEFAULT NULL,
  `mt` int(11) DEFAULT NULL,
  `operator` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ido_goods_info`
-- ----------------------------
DROP TABLE IF EXISTS `ido_goods_info`;
CREATE TABLE `ido_goods_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ct` int(10) unsigned DEFAULT NULL,
  `mt` int(10) unsigned DEFAULT NULL,
  `operator` int(10) unsigned NOT NULL,
  `catid1` int(10) unsigned NOT NULL,
  `catid2` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ido_msg`
-- ----------------------------
DROP TABLE IF EXISTS `ido_msg`;
CREATE TABLE `ido_msg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `ct` int(11) NOT NULL,
  `mt` int(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 正常 2 已处理',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
