/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50625
 Source Host           : localhost
 Source Database       : yii2-workshop-rbac-db

 Target Server Type    : MySQL
 Target Server Version : 50625
 File Encoding         : utf-8

 Date: 09/02/2015 21:44:29 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `auth_assignment`
-- ----------------------------
BEGIN;
INSERT INTO `auth_assignment` VALUES ('Admin', '1', '1441170443'), ('Admin', '9', '1441190077'), ('Author', '3', '1441170443'), ('Author', '4', '1441170443'), ('Author', '8', '1441189965'), ('Management', '2', '1441170443');
COMMIT;

-- ----------------------------
--  Table structure for `auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `auth_item`
-- ----------------------------
BEGIN;
INSERT INTO `auth_item` VALUES ('Admin', '1', 'สำหรับการดูแลระบบ', null, null, '1441170443', '1441170443'), ('Author', '1', 'การเขียนบทความ', null, null, '1441170443', '1441170443'), ('createBlog', '2', 'สร้าง blog', null, null, '1441170443', '1441170443'), ('loginToBackend', '2', 'ล็อกอินเข้าใช้งานส่วน backend', null, null, '1441170443', '1441170443'), ('Management', '1', 'จัดการข้อมูลผู้ใช้งานและบทความ', null, null, '1441170443', '1441170443'), ('ManageUser', '1', 'จัดการข้อมูลผู้ใช้งาน', null, null, '1441170443', '1441170443'), ('updateBlog', '2', 'แก้ไข blog', null, null, '1441170443', '1441170443'), ('updateOwnPost', '2', 'แก้ไขบทความตัวเอง', 'isAuthor', null, '1441170443', '1441170443');
COMMIT;

-- ----------------------------
--  Table structure for `auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `auth_item_child`
-- ----------------------------
BEGIN;
INSERT INTO `auth_item_child` VALUES ('Management', 'Author'), ('Author', 'createBlog'), ('ManageUser', 'loginToBackend'), ('Admin', 'Management'), ('Management', 'ManageUser'), ('updateOwnPost', 'updateBlog'), ('Author', 'updateOwnPost');
COMMIT;

-- ----------------------------
--  Table structure for `auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `auth_rule`
-- ----------------------------
BEGIN;
INSERT INTO `auth_rule` VALUES ('isAuthor', 'O:22:\"common\\rbac\\AuthorRule\":3:{s:4:\"name\";s:8:\"isAuthor\";s:9:\"createdAt\";i:1441170443;s:9:\"updatedAt\";i:1441170443;}', '1441170443', '1441170443');
COMMIT;

-- ----------------------------
--  Table structure for `blog`
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT 'ชื่อเรื่อง',
  `content` text COMMENT 'เนื้อหา',
  `category` int(11) DEFAULT NULL COMMENT 'หมวดหมู่',
  `tag` varchar(255) DEFAULT NULL COMMENT 'คำค้น',
  `created_at` int(11) DEFAULT NULL COMMENT 'สร้างวันที่',
  `created_by` int(11) DEFAULT NULL COMMENT 'สร้างโดย',
  `updated_at` int(11) DEFAULT NULL COMMENT 'แก้ไขวันที่',
  `updated_by` int(11) DEFAULT NULL COMMENT 'แก้ไขโดย',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  FULLTEXT KEY `content` (`content`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `blog`
-- ----------------------------
BEGIN;
INSERT INTO `blog` VALUES ('2', 'sdf', 'sdf', '1', '', '1440350259', '3', '1440350259', '3'), ('3', 'aaa', 'ddddd', '2', '', '1440350356', '4', '1440350356', '4'), ('4', 'สร้าง Rule เพื่อตรวจสอบก่อนแก้ไขบทความ', 'เราจะทำการสร้าง Rule ขึ้นมา 1 ตัว ชื่อ AuthorRule เอาไว้ตรวจสอบว่าบทความที่เรากำลังจะแก้ไขเป็นของเราจริงหรือไม่ ถ้าใช่ก็จะอนุญาติให้แก้ไขบทความ ถ้าไม่ใช่ก็จะ error forbidden แจ้งให้ทราบว่าไม่มีสิทธิ์เข้าใช้งาน\r\n\r\nให้ทำการสร้างไฟล์ ชื่อ AuthorRule.php ไว้ที่ common/rbac/AuthorRule.php หากไม่มีโฟลเดอร์ rbac ให้สร้างได้เลย\r\n\r\nจากนั้นทำการสร้าง Rule ตามโค้ดด้านล่าง', '1', 'rbac,role,rule', '1440465487', '1', '1440605682', '1');
COMMIT;

-- ----------------------------
--  Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `migration`
-- ----------------------------
BEGIN;
INSERT INTO `migration` VALUES ('m000000_000000_base', '1440129630'), ('m130524_201442_init', '1440141419'), ('m140506_102106_rbac_init', '1440129925'), ('m150824_122129_rbac', '1441170443');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'user-a', 'x-qLXjXlKQuKE-BVn0CS-HGqq07Ge9Zc', '$2y$13$wR9jW4p284D3F.NkG9vo3.ywx8HZjYNK51m2NKFL1fIG97HmK6JJq', null, 'user-a@gmail.com', '10', '1440147853', '1441187558'), ('2', 'user-b', 'gHsni8ZqHEK9ts_8Ld-RFD9aASVEC5te', '$2y$13$2iiAblFuwN.T6Xgww0NiC.ZgUCvZK5T5D4mRVvoG8w1FPPbmAspIq', null, 'user-b@gmail.com', '10', '1440147873', '1440147873'), ('3', 'user-c', 'bXDQPigzuLScISomlg3Ls4LJBQ6NDCrY', '$2y$13$BcsbnDLku4kmgLumHCrWTO4aSot54oRQ6bq37Nc2MF5HBo7Myd6Yu', null, 'user-c@gmail.com', '10', '1440147895', '1440147895'), ('4', 'user-d', 'B4k6FjNYGJDiJ7v9jTadGOMRW3ElCKd7', '$2y$13$jomXpXeK4LaCPgJk0SIkm..SdnOMdQdGKk7v0TLtNN8cqhIcEvuf.', null, 'user-d@gmail.com', '10', '1440304250', '1440304250'), ('5', 'user-e', 'ro7MqQVD1iuHzD2PeVSdDdOk3CtG0STz', '$2y$13$M27.xgyOU4hdeSeOlO/AKe08bOz7sFW6McK/Tq4E/P3hYg/By1o2W', null, 'user-e@gmail.com', '10', '1440933014', '1440933014'), ('6', 'aaa', 'UAgTsGf7EKYrM1f1iNYipyfevUKYao4p', '$2y$13$aAd6cd2eOabQvRoDaPy2AO/H0oLMDJh.wuYL.ufeRr3VUoFErGgwu', null, 'aaa@gmail.com', '10', '1441116366', '1441116366'), ('7', 'bbb', 'zD17YnnLtpKj5s1q6yhjln3Ndxa-YHST', '$2y$13$/xK0CCyxMNpl4lthvt9OxuFyO59HTwdl1YaA3ySr.epvRnx3R09ly', null, 'bbb@gmail.com', '10', '1441120040', '1441125077'), ('8', 'sdf', 'PB1qbVUOrMgtkESDfY5zRkzxRYaRN1Ds', '$2y$13$krQzUl6MSRGAyTTRU0GLQuU4GioGTA7uguNqacuu7W6aAsR2vOhw.', null, 'sdf@gmail.com', '10', '1441189965', '1441189965'), ('9', 'zzz', 'ExD3Z2QkkCtibcoM9Vc6uecRM55qtDFq', '$2y$13$GMDk1Y.tBkRWJIDE3dZSDeZgpwQJG9AIahMtMGppjmBtJgZ/4QamK', null, 'zzz@gmail.com', '10', '1441190077', '1441190077');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
