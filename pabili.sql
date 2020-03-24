/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100134
Source Host           : localhost:3306
Source Database       : pabili

Target Server Type    : MYSQL
Target Server Version : 100134
File Encoding         : 65001

Date: 2020-03-24 22:37:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_admin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------
INSERT INTO `tbl_admin` VALUES ('1', '2', 'sanpedroadmin', '1');
INSERT INTO `tbl_admin` VALUES ('2', '1', 'sanroqueadmin', '1');

-- ----------------------------
-- Table structure for tbl_areas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_areas`;
CREATE TABLE `tbl_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `town_id` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_areas
-- ----------------------------
INSERT INTO `tbl_areas` VALUES ('1', '1', 'San Roque', '1');
INSERT INTO `tbl_areas` VALUES ('2', '1', 'San Pedro', '1');

-- ----------------------------
-- Table structure for tbl_orders
-- ----------------------------
DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` text,
  `lugar` text,
  `order` text,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_orders
-- ----------------------------
INSERT INTO `tbl_orders` VALUES ('1', '1585053783', '2020-03-24 13:43:03', 'King Villanueva', '09669260373', 'Unit 1 No 57 Saint Clement St.', '2', '[{\"qty\":\"10\",\"sukat\":\"Kilo\",\"item\":\"Manok\"},{\"qty\":\"5\",\"sukat\":\"Piraso\",\"item\":\"gulay\"}]', '0');
INSERT INTO `tbl_orders` VALUES ('2', '1585053824', '2020-03-24 13:43:44', 'King Villanueva', '09669260373', 'Unit 1 No 57 Saint Clement St.', '2', '[{\"qty\":\"10\",\"sukat\":\"Kilo\",\"item\":\"Manok\"},{\"qty\":\"5\",\"sukat\":\"Piraso\",\"item\":\"gulay\"}]', '0');
INSERT INTO `tbl_orders` VALUES ('3', '1585053905', '2020-03-24 13:45:05', 'King Villanueva', '09669260373', 'Unit 1 No 57 Saint Clement St.', '1', '[{\"qty\":\"1\",\"sukat\":\"Bote\",\"item\":\"Suka\"},{\"qty\":\"5\",\"sukat\":\"Piraso\",\"item\":\"Talong\"}]', '0');
INSERT INTO `tbl_orders` VALUES ('4', '1585054040', '2020-03-24 13:47:20', 'King Villanueva', '09669260373', 'Unit 1 No 57 Saint Clement St.', '2', '[{\"qty\":\"1\",\"sukat\":\"Tali\",\"item\":\"Sitaw\"},{\"qty\":\"1\",\"sukat\":\"Bote\",\"item\":\"Toyo\"},{\"qty\":\"1\",\"sukat\":\"Kilo\",\"item\":\"Bawang\"},{\"qty\":\"1\",\"sukat\":\"Kilo\",\"item\":\"Sibuyas Pula\"}]', '0');
INSERT INTO `tbl_orders` VALUES ('5', '1585058570', '2020-03-24 15:02:50', 'King Villanueva', '09669260373', 'Unit 1 No 57 Saint Clement St.', '1', '[{\"qty\":\"2\",\"sukat\":\"Kilo\",\"item\":\"Manok\"}]', '0');

-- ----------------------------
-- Table structure for tbl_towns
-- ----------------------------
DROP TABLE IF EXISTS `tbl_towns`;
CREATE TABLE `tbl_towns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `town` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_towns
-- ----------------------------
INSERT INTO `tbl_towns` VALUES ('1', 'Angono', '1');
SET FOREIGN_KEY_CHECKS=1;
