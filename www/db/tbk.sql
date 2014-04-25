/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.1.24-rc-community : Database - tbk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`diduquan` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `diduquan`;

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '类型',
  `uri` varchar(255) NOT NULL DEFAULT '' COMMENT 'URI',
  `did` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '数据ID',
  `message` varchar(512) NOT NULL DEFAULT '' COMMENT 'Message',
  `maker` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建者',
  `mktime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `log` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '菜单名',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'url',
  `target` varchar(32) NOT NULL DEFAULT 'inner' COMMENT '打开方式',
  `isleaf` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否叶子节点',
  `deep` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '深度',
  `maker` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建者',
  `mktime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`pid`,`name`,`sort`,`url`,`target`,`isleaf`,`deep`,`maker`,`mktime`) values (4,0,'系统设置',9,'#','',0,1,1,1371460794),(5,0,'菜单管理',2,'#','',0,1,1,1371461910),(6,5,'菜单管理',0,'#','',0,2,1,1371464088),(7,6,'添加菜单',0,'/admin/menu/create','inner',1,3,1,1371464125),(8,6,'菜单管理',2,'/admin/menu/','inner',1,3,1,1371464162),(9,5,'菜单管理2',0,'#','',0,2,1,1371466427),(10,0,'邮件',0,'#','',0,1,1,1371467985),(11,10,'邮件管理',0,'#','',0,2,1,1371468021),(12,11,'发送邮件',1,'/admin/mail/send','inner',1,3,1,1371468083),(13,11,'邮件管理',2,'/admin/mail/','inner',1,3,1,1371468110),(14,11,'邮件日志',3,'/admin/mail-log/','inner',1,3,1,1371468136),(15,11,'退订管理',4,'/admin/email-unsubscribe/','inner',1,3,1,1371468163);

/*Table structure for table `post` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型0:管理员;1:普通用户',
  `nick` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT '亲昵',
  `email` varchar(128) NOT NULL DEFAULT '' COMMENT 'Email',
  `mobile` varchar(16) NOT NULL DEFAULT '' COMMENT '手机号',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `tao_uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '淘宝ID',
  `last_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',
  `last_ip` varchar(15) CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '登录IP',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态',
  `maker` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建者',
  `mktime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `disable` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除标记',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert  into `user`(`id`,`type`,`nick`,`email`,`mobile`,`password`,`tao_uid`,`last_time`,`last_ip`,`state`,`maker`,`mktime`,`disable`) values (1,0,'èƒ¡é›„é£ž','455816735@qq.com','','a82cff5cc53ac9419572b72ae2c815e6',1,1371445496,'127.0.0.1',1,1,1371029058,0),(2,0,'æŽçŽ‰åŽ','550807257@qq.com','','ab4ea8d686d82513f1aed139a8eafb37',0,1371029099,'127.0.0.1',1,1,1371029058,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
