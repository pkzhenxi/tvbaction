/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : zenaction

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-05-10 16:36:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tv_ad`
-- ----------------------------
DROP TABLE IF EXISTS `tv_ad`;
CREATE TABLE `tv_ad` (
  `aid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `adname` varchar(100) NOT NULL DEFAULT '',
  `adenname` varchar(60) NOT NULL DEFAULT '',
  `timeset` int(10) unsigned NOT NULL DEFAULT '0',
  `intro` char(255) NOT NULL DEFAULT '',
  `adsbody` text,
  PRIMARY KEY (`aid`),
  KEY `timeset` (`timeset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_ad
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tv_admin`;
CREATE TABLE `tv_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  `add_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tv_admin
-- ----------------------------
INSERT INTO `tv_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'pkzhenxi@126.com', '', null, '1390549789');
INSERT INTO `tv_admin` VALUES ('13', 'test', '1104959d53dc3b60f2d40cd4a47d79e7', '2@126.com', '', '1390549548', '1390552495');

-- ----------------------------
-- Table structure for `tv_album`
-- ----------------------------
DROP TABLE IF EXISTS `tv_album`;
CREATE TABLE `tv_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vid` int(11) NOT NULL DEFAULT '0',
  `artist` varchar(255) DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `language` varchar(15) NOT NULL,
  `introduction` mediumtext NOT NULL,
  `picture` mediumtext NOT NULL,
  `pubtime` varchar(255) NOT NULL,
  `recommend` enum('0','1') NOT NULL DEFAULT '0',
  `hit` int(11) NOT NULL DEFAULT '0',
  `good` int(11) DEFAULT NULL,
  `time` datetime NOT NULL,
  `check` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_album
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_artist`
-- ----------------------------
DROP TABLE IF EXISTS `tv_artist`;
CREATE TABLE `tv_artist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `letter` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_artist
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_artist_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tv_artist_comment`;
CREATE TABLE `tv_artist_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `artist_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(11) DEFAULT NULL,
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `ischeck` smallint(6) NOT NULL DEFAULT '0',
  `dtime` int(10) unsigned NOT NULL DEFAULT '0',
  `msg` text,
  `m_type` int(6) unsigned NOT NULL DEFAULT '0',
  `reply` int(6) unsigned NOT NULL DEFAULT '0',
  `agree` int(6) unsigned NOT NULL DEFAULT '0',
  `anti` int(6) unsigned NOT NULL DEFAULT '0',
  `pic` varchar(255) NOT NULL DEFAULT '',
  `vote` int(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `v_id` (`ischeck`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_artist_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_artist_image`
-- ----------------------------
DROP TABLE IF EXISTS `tv_artist_image`;
CREATE TABLE `tv_artist_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artist_id` (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_artist_image
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_artist_news`
-- ----------------------------
DROP TABLE IF EXISTS `tv_artist_news`;
CREATE TABLE `tv_artist_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) unsigned DEFAULT NULL,
  `news_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artist` (`artist_id`),
  KEY `news` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_artist_news
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_artist_video`
-- ----------------------------
DROP TABLE IF EXISTS `tv_artist_video`;
CREATE TABLE `tv_artist_video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `arrist_id` int(11) DEFAULT NULL,
  `v_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_artist_video
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_authassignment`
-- ----------------------------
DROP TABLE IF EXISTS `tv_authassignment`;
CREATE TABLE `tv_authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_authassignment
-- ----------------------------
INSERT INTO `tv_authassignment` VALUES ('测试', '2', null, 'N;');

-- ----------------------------
-- Table structure for `tv_authitem`
-- ----------------------------
DROP TABLE IF EXISTS `tv_authitem`;
CREATE TABLE `tv_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_authitem
-- ----------------------------
INSERT INTO `tv_authitem` VALUES ('Siteconfig.Default.*', '1', '站点配置', null, 'N;');
INSERT INTO `tv_authitem` VALUES ('Siteconfig.Default.Index', '0', '网站基本配置', null, 'N;');
INSERT INTO `tv_authitem` VALUES ('Siteconfig.Default.Ipfilter', '0', 'IP过滤设置', null, 'N;');
INSERT INTO `tv_authitem` VALUES ('Siteconfig.Default.Sitemail', '0', '邮件设置', null, 'N;');
INSERT INTO `tv_authitem` VALUES ('Siteconfig.Default.Siteregister', '0', '会员注册设置', null, 'N;');
INSERT INTO `tv_authitem` VALUES ('站点配置管理', '2', '站点配置', null, 'N;');

-- ----------------------------
-- Table structure for `tv_authitemchild`
-- ----------------------------
DROP TABLE IF EXISTS `tv_authitemchild`;
CREATE TABLE `tv_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_authitemchild
-- ----------------------------
INSERT INTO `tv_authitemchild` VALUES ('siteconfig', 'siteconfig.*');
INSERT INTO `tv_authitemchild` VALUES ('测试', 'Siteconfig.Default.*');
INSERT INTO `tv_authitemchild` VALUES ('站点配置管理', 'Siteconfig.Default.*');

-- ----------------------------
-- Table structure for `tv_category`
-- ----------------------------
DROP TABLE IF EXISTS `tv_category`;
CREATE TABLE `tv_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `isshow` tinyint(1) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `keyword` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_category
-- ----------------------------
INSERT INTO `tv_category` VALUES ('1', '1', '1', '44', '1', '视频分类', null, null, null, null, null, null, null);
INSERT INTO `tv_category` VALUES ('2', '1', '42', '43', '2', '现代剧', null, null, null, '1', '', '', '');
INSERT INTO `tv_category` VALUES ('3', '1', '38', '39', '2', '古装剧', null, null, null, '1', '', '', '');
INSERT INTO `tv_category` VALUES ('4', '1', '40', '41', '2', '民国剧', null, null, null, '1', '', '', '');

-- ----------------------------
-- Table structure for `tv_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tv_comment`;
CREATE TABLE `tv_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `v_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '视频ID',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '评论者',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `ischeck` smallint(6) NOT NULL DEFAULT '0' COMMENT '审核',
  `dtime` int(10) unsigned NOT NULL DEFAULT '0',
  `msg` text,
  `m_type` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '评论类型',
  `reply` int(6) NOT NULL COMMENT '前台回复',
  `agree` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '同意',
  `anti` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '反对',
  `pic` varchar(255) NOT NULL DEFAULT '',
  `vote` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '顶',
  PRIMARY KEY (`id`),
  KEY `v_id` (`v_id`,`ischeck`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_content`
-- ----------------------------
DROP TABLE IF EXISTS `tv_content`;
CREATE TABLE `tv_content` (
  `vid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `body` mediumtext,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_content
-- ----------------------------
INSERT INTO `tv_content` VALUES ('7', '2', '哈哈西嘻嘻');
INSERT INTO `tv_content` VALUES ('10', '2', '介绍介绍......');
INSERT INTO `tv_content` VALUES ('11', '3', '叛逃影片介绍ddd');

-- ----------------------------
-- Table structure for `tv_data`
-- ----------------------------
DROP TABLE IF EXISTS `tv_data`;
CREATE TABLE `tv_data` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '类别ID',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '名称',
  `state` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '集数',
  `pic` varchar(255) NOT NULL DEFAULT '',
  `hit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `money` smallint(6) NOT NULL DEFAULT '0',
  `rank` smallint(6) NOT NULL DEFAULT '0',
  `digg` smallint(6) NOT NULL DEFAULT '0',
  `tread` smallint(6) NOT NULL DEFAULT '0',
  `commend` smallint(6) NOT NULL DEFAULT '0' COMMENT '星级推荐',
  `wrong` smallint(8) unsigned NOT NULL DEFAULT '0',
  `ismake` smallint(1) unsigned NOT NULL DEFAULT '0',
  `actor` varchar(200) DEFAULT NULL,
  `color` char(7) NOT NULL DEFAULT '',
  `publishyear` char(20) NOT NULL DEFAULT '0',
  `publisharea` char(20) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) DEFAULT NULL,
  `topic` int(11) unsigned NOT NULL DEFAULT '0',
  `note` char(30) NOT NULL DEFAULT '',
  `tags` char(30) NOT NULL DEFAULT '',
  `letter` char(3) NOT NULL DEFAULT '',
  `isunion` smallint(6) NOT NULL DEFAULT '0',
  `recycled` smallint(6) NOT NULL DEFAULT '0',
  `director` varchar(200) DEFAULT NULL,
  `enname` varchar(200) DEFAULT NULL,
  `lang` varchar(200) DEFAULT NULL,
  `score` bigint(10) DEFAULT '0',
  `extratype` text,
  PRIMARY KEY (`id`),
  KEY `idx_addtime` (`addtime`),
  KEY `idx_name` (`name`,`tid`),
  KEY `idx_tid` (`tid`,`recycled`,`addtime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_data
-- ----------------------------
INSERT INTO `tv_data` VALUES ('7', '2', '流金岁月', '500', '201405/536de15e760e1.jpg', '200', '0', '0', '0', '0', '3', '0', '0', '罗嘉良', '#0000CC', '2014', '香港', '1396154264', '1399710049', '1', '', '', 'L', '0', '0', '', null, '粤语', '0', '');
INSERT INTO `tv_data` VALUES ('11', '4', '叛逃', '10', '201405/53648ef305636.jpg', '300', '0', '0', '0', '0', '5', '0', '0', '吴x', '', '2014', '香港', '1397961098', '1399102776', '1', '', '', 'p', '0', '0', '未知', null, '粤语', '0', '3,4');
INSERT INTO `tv_data` VALUES ('10', '2', '测试', '100', '201405/536de16a6617a.jpg', '220', '0', '0', '0', '0', '5', '0', '0', '刘德华', '#00FF00', '2004', '大陆', '1396849700', '1399710060', '1', '', '高清', 'C', '0', '0', '徐克', null, '粤语', '0', '');

-- ----------------------------
-- Table structure for `tv_flink`
-- ----------------------------
DROP TABLE IF EXISTS `tv_flink`;
CREATE TABLE `tv_flink` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `sortrank` smallint(6) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `webname` varchar(30) NOT NULL DEFAULT '',
  `msg` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `dtime` int(10) unsigned NOT NULL DEFAULT '0',
  `ischeck` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_flink
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_guestbook`
-- ----------------------------
DROP TABLE IF EXISTS `tv_guestbook`;
CREATE TABLE `tv_guestbook` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(60) NOT NULL DEFAULT '',
  `mid` mediumint(8) unsigned DEFAULT '0',
  `posttime` int(10) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(30) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `dtime` int(10) unsigned NOT NULL DEFAULT '0',
  `ischeck` smallint(6) NOT NULL DEFAULT '1',
  `msg` text,
  PRIMARY KEY (`id`),
  KEY `ischeck` (`ischeck`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_guestbook
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_news`
-- ----------------------------
DROP TABLE IF EXISTS `tv_news`;
CREATE TABLE `tv_news` (
  `n_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tid` smallint(8) unsigned NOT NULL DEFAULT '0',
  `n_title` varchar(60) NOT NULL DEFAULT '',
  `n_keyword` varchar(80) DEFAULT NULL,
  `n_pic` varchar(255) NOT NULL DEFAULT '',
  `n_hit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `n_author` varchar(80) DEFAULT NULL,
  `n_addtime` int(10) NOT NULL DEFAULT '0',
  `n_letter` char(1) NOT NULL DEFAULT '',
  `n_content` mediumtext,
  `n_outline` varchar(255) DEFAULT NULL,
  `tname` varchar(60) NOT NULL DEFAULT '',
  `n_from` varchar(50) NOT NULL DEFAULT '',
  `n_inbase` enum('0','1') NOT NULL DEFAULT '0',
  `n_entitle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`n_id`),
  KEY `tid` (`tid`,`n_hit`),
  KEY `v_addtime` (`n_inbase`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_news
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_playdata`
-- ----------------------------
DROP TABLE IF EXISTS `tv_playdata`;
CREATE TABLE `tv_playdata` (
  `v_id` mediumint(8) NOT NULL DEFAULT '0',
  `tid` smallint(8) unsigned NOT NULL DEFAULT '0',
  `body` mediumtext,
  `body1` mediumtext,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_playdata
-- ----------------------------
INSERT INTO `tv_playdata` VALUES ('7', '2', 'qvod$$第1集$ddd$qvod$$$百度影音$$第1集$ggsgsge$bdhd', null);
INSERT INTO `tv_playdata` VALUES ('8', '3', 'qvod$$第1集$d$qvod', null);
INSERT INTO `tv_playdata` VALUES ('9', '2', 'qvod$$第1集$d$qvod', null);
INSERT INTO `tv_playdata` VALUES ('10', '2', 'qvod$$第1集$DADADAD$qvod$$$迅播高清$$第1集$DADADAD$gvod', null);
INSERT INTO `tv_playdata` VALUES ('12', '4', '优酷$$第1集$dddddd$youku', null);
INSERT INTO `tv_playdata` VALUES ('11', '3', 'qvod$$第1集$DADADAD$qvod$$$迅播高清$$第1集$DADADAD$gvod', null);

-- ----------------------------
-- Table structure for `tv_profile`
-- ----------------------------
DROP TABLE IF EXISTS `tv_profile`;
CREATE TABLE `tv_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `ename` varchar(50) DEFAULT NULL,
  `brithday` varchar(50) DEFAULT NULL,
  `native` varchar(10) DEFAULT NULL,
  `constellation` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `blood` varchar(10) DEFAULT NULL,
  `marriage` varchar(255) DEFAULT NULL,
  `family` varchar(255) DEFAULT NULL,
  `hate` varchar(255) DEFAULT NULL,
  `favartist` varchar(255) DEFAULT NULL,
  `favplace` varchar(255) DEFAULT NULL,
  `favthing` varchar(255) DEFAULT NULL,
  `favanimal` varchar(255) DEFAULT NULL,
  `favcolor` varchar(255) DEFAULT NULL,
  `favfood` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_profile
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_settings`
-- ----------------------------
DROP TABLE IF EXISTS `tv_settings`;
CREATE TABLE `tv_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_settings
-- ----------------------------

-- ----------------------------
-- Table structure for `tv_topic`
-- ----------------------------
DROP TABLE IF EXISTS `tv_topic`;
CREATE TABLE `tv_topic` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `enname` char(60) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  `template` char(50) NOT NULL DEFAULT '',
  `pic` char(80) NOT NULL DEFAULT '',
  `des` text,
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_topic
-- ----------------------------
INSERT INTO `tv_topic` VALUES ('1', '罗嘉良', 'luo', '0', '', '', null);
INSERT INTO `tv_topic` VALUES ('2', '怀旧', 'old', '1', '', '', null);

-- ----------------------------
-- Table structure for `tv_users`
-- ----------------------------
DROP TABLE IF EXISTS `tv_users`;
CREATE TABLE `tv_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) DEFAULT '',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `create_at` int(11) DEFAULT NULL,
  `lastvisit_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username` (`username`),
  UNIQUE KEY `user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tv_users
-- ----------------------------
INSERT INTO `tv_users` VALUES ('3', 'abc', '1104959d53dc3b60f2d40cd4a47d79e7', '1@126.com', '', '1', '1', '1391825414', '1391825414');
