/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.5.25a : Database - diduquan
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `log` */

insert  into `log`(`id`,`type`,`uri`,`did`,`message`,`maker`,`mktime`) values (2,'1','2',4,'5',6,7),(3,'index','/index/index',0,'ServiceTest Start',0,1378364575),(4,'index','/index/index',0,'ServiceTest End',0,1378364575),(5,'index','/index/index',0,'ServiceTest Start',0,1378364585),(6,'index','/index/index',0,'ServiceTest End',0,1378364585),(7,'index','/index/index',0,'ServiceTest Start',0,1378364591),(8,'index','/index/index',0,'ServiceTest End',0,1378364591),(9,'index','/index/index',0,'ServiceTest Start',0,1378364593),(10,'index','/index/index',0,'ServiceTest End',0,1378364593),(11,'index','/index/index',0,'ServiceTest Start',0,1378364595),(12,'index','/index/index',0,'ServiceTest End',0,1378364595),(13,'index','/index/index',0,'ServiceTest Start',0,1378364736),(14,'index','/index/index',0,'ServiceTest End',0,1378364736),(15,'login','/login/ajax',0,'',0,1387003130),(16,'login','/login/ajax',0,'huxf',0,1387366140),(17,'login','/login/ajax',0,'huxf',0,1387366192),(18,'login','/login/ajax',0,'huxf',0,1387366267),(19,'login','/login/ajax',0,'huxf',0,1387366336),(20,'login','/register/ajax',0,'',0,1387603773),(21,'login','/register/ajax',0,'',0,1387604184),(22,'login','/login/ajax',0,'huxf',0,1387607149),(23,'login','/login/ajax',0,'huxf',0,1387619771),(24,'login','/login/ajax',0,'huxf',0,1387619823),(25,'login','/login/ajax',0,'huxf',0,1387625935),(26,'login','/login/ajax',0,'huxf',0,1387625972),(27,'login','/login/ajax',0,'huxf',0,1387626245),(28,'login','/login/ajax',0,'huxf',0,1387626380),(29,'login','/login/ajax',0,'huxf',0,1387626819),(30,'login','/login/ajax',0,'huxf',0,1387626927),(31,'login','/login/ajax',0,'huxf',0,1387626934),(32,'login','/login/ajax',0,'huxf',0,1387627034),(33,'login','/login/ajax',0,'huxf',0,1387627110),(34,'login','/login/ajax',0,'huxf',0,1387627149),(35,'login','/login/ajax',0,'huxf',0,1388565072);

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`pid`,`name`,`sort`,`url`,`target`,`isleaf`,`deep`,`maker`,`mktime`) values (1,0,'后台菜单',0,'#','inner',0,0,1,1371468163),(2,0,'前台菜单',0,'#','inner',0,0,1,1371468163),(3,1,'创建应用',10,'#','',0,1,1,1388821155),(4,1,'系统设置',9,'#','',0,1,1,1371460794),(5,4,'菜单管理',2,'#','',0,1,1,1371461910),(6,3,'创建app',0,'/admin/create-app/','inner',1,2,1,1388821155),(7,5,'添加菜单',0,'/admin/menu/create','inner',1,2,1,1371464125),(8,5,'菜单管理',2,'/admin/menu/','inner',1,2,1,1371464162),(11,4,'邮件管理',2,'#','',0,1,1,1371468021),(12,11,'发送邮件',1,'/admin/mail/send','inner',1,2,1,1371468083),(13,11,'邮件管理',2,'/admin/mail/','inner',1,2,1,1371468110),(14,11,'邮件日志',3,'/admin/mail-log/','inner',1,2,1,1371468136),(15,11,'退订管理',4,'/admin/email-unsubscribe/','inner',1,2,1,1371468163),(16,1,'会员管理',3,'#','',0,1,1,1388816016),(17,16,'会员列表',0,'/admin/member/','inner',1,2,1,1388816578),(18,16,'添加会员',2,'/admin/member/create','inner',1,2,1,1388821155),(19,1,'商家管理',2,'#','inner',0,1,0,1388829400),(20,19,'商家列表',1,'/admin/parter','inner',1,2,0,1388829461),(21,19,'添加商家',2,'/admin/parter/create','inner',1,2,0,1388829496),(22,1,'类型管理',3,'#','inner',0,1,0,1388830614),(23,22,'添加类型',1,'/admin/type/create','inner',1,2,0,1388830660),(24,22,'类型列表',0,'/admin/type/','inner',1,2,0,1388830704),(25,1,'试用管理',1,'#','inner',0,1,0,1390215260),(26,25,'产品列表',1,'/admin/try/','inner',1,2,0,1390215362),(27,25,'添加产品',2,'/admin/try/create','inner',1,2,0,1390215390);

/*Table structure for table `qinzi_activities` */

DROP TABLE IF EXISTS `qinzi_activities`;

CREATE TABLE `qinzi_activities` (
  `aid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8_unicode_ci COMMENT '产品详细信息',
  `sponsor` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT '活动主办方',
  `pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '产品logo',
  `totype` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '年龄段',
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '申请区域[城市]',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市id',
  `provice` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '省份',
  `province_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '省份id',
  `type` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活动类型',
  `isfree` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否免费[1免费，0不免费]',
  `used_cnt` smallint(8) unsigned NOT NULL DEFAULT '0' COMMENT '已用名额',
  `remain_cnt` smallint(8) unsigned NOT NULL DEFAULT '0' COMMENT '剩余名额',
  `b_cnt` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '报名人数',
  `b_stattime` date DEFAULT NULL COMMENT '报名开始时间',
  `b_endtime` date DEFAULT NULL COMMENT '报名截止日期',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='活动';

/*Data for the table `qinzi_activities` */

insert  into `qinzi_activities`(`aid`,`title`,`content`,`sponsor`,`pic`,`totype`,`city`,`city_id`,`provice`,`province_id`,`type`,`isfree`,`used_cnt`,`remain_cnt`,`b_cnt`,`b_stattime`,`b_endtime`,`createtime`) values (1,'欢乐圣诞，挑战思维——优贝乐科学馆主题Party','别等宝宝会走了，您才后悔没带TA参加爬行比赛！ 一次亲密的接触，一场酣畅的比赛，一回快乐的亲子，一段美好的回忆。 好太太网携手各知名早教中心为您打造北京城最火爆，最高品质的亲子盛宴。7大城区，65场爬行赛事，真正实现最近路程，最低收费，最优品质。瑟瑟深秋，一起去收获快乐吧！！ 只要您宝宝在6-13个月，只要您愿意共享开心，那就来吧……','优贝乐科学馆通州旗舰店','http://img.pcbaby.com.cn/images/sns/tryprod/20139/25/13800876026700120_160x120.jpg',0,'北京',0,'北京',0,1,1,0,100,1,'0000-00-00','0000-00-00',1387194738),(2,'欢乐圣诞，挑战思维——优贝乐科学馆主题Party','别等宝宝会走了，您才后悔没带TA参加爬行比赛！ \n一次亲密的接触，一场酣畅的比赛，一回快乐的亲子，一段美好的回忆。 \n好太太网携手各知名早教中心为您打造北京城最火爆，最高品质的亲子盛宴。7大城区，65场爬行赛事，真正实现最近路程，最低收费，最优品质。瑟瑟深秋，一起去收获快乐吧！！ \n \n只要您宝宝在6-13个月，只要您愿意共享开心，那就来吧……','优贝乐科学馆通州旗舰店','http://img.pcbaby.com.cn/images/sns/tryprod/20139/25/13800876026700120_160x120.jpg',0,'北京',0,'北京',0,1,1,0,100,0,'2013-12-16','2014-01-15',1387194981);

/*Table structure for table `qinzi_activitiy_comments` */

DROP TABLE IF EXISTS `qinzi_activitiy_comments`;

CREATE TABLE `qinzi_activitiy_comments` (
  `acid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活动id',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '评论类型[0活动，1活动感想]',
  `content` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '评论内容',
  `pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片',
  `parentid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`acid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=' 活动评论 ';

/*Data for the table `qinzi_activitiy_comments` */

/*Table structure for table `qinzi_activitiy_orders` */

DROP TABLE IF EXISTS `qinzi_activitiy_orders`;

CREATE TABLE `qinzi_activitiy_orders` (
  `aoid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活动id',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '活动标题',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `cnt` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '参加人数',
  `realname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地址',
  `postcode` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮编',
  `state` tinyint(1) DEFAULT '0' COMMENT '状态[0报名成功，1报名失败，2报名成功]',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`aoid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=' 活动报名名单 ';

/*Data for the table `qinzi_activitiy_orders` */

insert  into `qinzi_activitiy_orders`(`aoid`,`aid`,`title`,`uid`,`cnt`,`realname`,`mobile`,`address`,`postcode`,`state`,`createtime`) values (1,1,'欢乐圣诞，挑战思维——优贝乐科学馆主题Party',1,1,'张三','13888888888','','',0,1387195618);

/*Table structure for table `qinzi_activitiy_topics` */

DROP TABLE IF EXISTS `qinzi_activitiy_topics`;

CREATE TABLE `qinzi_activitiy_topics` (
  `tpid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活动id',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `content` text COLLATE utf8_unicode_ci COMMENT '内容',
  `pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '提取内容中的一张图片',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`tpid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=' 活动感想 ';

/*Data for the table `qinzi_activitiy_topics` */

/*Table structure for table `qinzi_parters` */

DROP TABLE IF EXISTS `qinzi_parters`;

CREATE TABLE `qinzi_parters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录名称',
  `pwd` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录密码',
  `company` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '公司名称',
  `logo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公司logo图',
  `type` tinyint(1) DEFAULT NULL COMMENT '公司类型',
  `info` text COLLATE utf8_unicode_ci COMMENT '公司介绍',
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公司地址',
  `postcode` char(6) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮编',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `contact` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系人',
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系电话',
  `iphone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '其他联系电话',
  `statue` tinyint(1) DEFAULT '0' COMMENT '状态[0正常,1停用]',
  `disable` tinyint(1) DEFAULT '0' COMMENT '是否删除',
  `mktime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='合作商信息';

/*Data for the table `qinzi_parters` */

insert  into `qinzi_parters`(`id`,`username`,`pwd`,`company`,`logo`,`type`,`info`,`address`,`postcode`,`email`,`contact`,`mobile`,`iphone`,`statue`,`disable`,`mktime`) values (1,'test','123456','汽车达人','src/20140121/20140121030134144.jpg',4,'ss33<img src=\"http://qinzi.com/assets/img/parter/500x500/20140114/2014011404421382.jpg\"><img src=\"http://qinzi.com/assets/img/parter/500x500/20140114/20140114041219489.jpg\">33333333','北京朝阳区三环以内曙光西里时间国际A座701','','airain2010@hotmail.com','tt','13466369279','',0,0,1388830288),(3,'afadfa','123456','afafdasdfa','src/20140120/20140120061921603.jpg',4,'33eafa3333333333','北京朝阳区三环以内曙光西里时间国际A座701','afda','airain2010@hotmail.com','','','',0,0,1390206519);

/*Table structure for table `qinzi_product_applies` */

DROP TABLE IF EXISTS `qinzi_product_applies`;

CREATE TABLE `qinzi_product_applies` (
  `paid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品标题',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `isbg` tinyint(1) DEFAULT '0' COMMENT '是否已提交报告',
  `des` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '申请宣言',
  `state` tinyint(1) DEFAULT '0' COMMENT '是否审核[0审核中，1未通过，2通过]',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '申请时间',
  PRIMARY KEY (`paid`),
  UNIQUE KEY `uid` (`uid`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='试用申请名单';

/*Data for the table `qinzi_product_applies` */

insert  into `qinzi_product_applies`(`paid`,`uid`,`title`,`pid`,`isbg`,`des`,`state`,`createtime`) values (1,1,'金领冠珍护7天轻松体验计划试用礼盒免费试用ddd',1,0,'非常非常想参加',0,1387195993);

/*Table structure for table `qinzi_product_topics` */

DROP TABLE IF EXISTS `qinzi_product_topics`;

CREATE TABLE `qinzi_product_topics` (
  `prid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `des` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '报告简要',
  `img_cnt` smallint(5) DEFAULT '0' COMMENT '图片数量',
  `content` text COLLATE utf8_unicode_ci COMMENT '报告内容',
  `reward_jifen` smallint(10) DEFAULT '0' COMMENT '奖励积分',
  `reward_ojifen` smallint(10) DEFAULT '0' COMMENT '额外奖励积分',
  `state` tinyint(1) DEFAULT '0' COMMENT '是否删除',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '提交时间',
  PRIMARY KEY (`prid`),
  UNIQUE KEY `uid` (`uid`,`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='试用申请报告';

/*Data for the table `qinzi_product_topics` */

/*Table structure for table `qinzi_product_type` */

DROP TABLE IF EXISTS `qinzi_product_type`;

CREATE TABLE `qinzi_product_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `type` tinyint(1) DEFAULT '0' COMMENT '0产品类型，1活动类型, 2年龄段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='类型';

/*Data for the table `qinzi_product_type` */

insert  into `qinzi_product_type`(`id`,`name`,`type`) values (1,'0-3岁',2),(2,'3-6岁',2),(3,'6岁以上',2),(4,'玩具',0),(5,'娱乐活动',1),(6,'护肤',3);

/*Table structure for table `qinzi_products` */

DROP TABLE IF EXISTS `qinzi_products`;

CREATE TABLE `qinzi_products` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parter_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '合作商id',
  `title` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品类型id',
  `price` float(5,2) NOT NULL DEFAULT '0.00' COMMENT '产品价格',
  `jifen` smallint(10) NOT NULL DEFAULT '0' COMMENT '产品消费积分',
  `reward_jifen` smallint(10) NOT NULL DEFAULT '0' COMMENT '试用报价奖励积分',
  `totype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]',
  `desc` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '申请规则',
  `content` text COLLATE utf8_unicode_ci COMMENT '产品详细信息',
  `pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '产品logo',
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '申请区域[城市]',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市id',
  `provice` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '省份',
  `province_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '省份id',
  `posttype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '配送方式[1包邮，2自取，3付邮]',
  `used_cnt` smallint(8) unsigned NOT NULL DEFAULT '0' COMMENT '已用商品数[申请成功人数]',
  `remain_cnt` smallint(8) unsigned NOT NULL DEFAULT '0' COMMENT '剩余商品数',
  `b_cnt` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '申请人数',
  `b_stattime` date DEFAULT NULL COMMENT '报名开始时间',
  `b_endtime` date DEFAULT NULL COMMENT '报名截止日期',
  `bg_stattime` date DEFAULT NULL COMMENT '报告提交开始时间',
  `bg_endtime` date DEFAULT NULL COMMENT '报告提交截止日期',
  `bg_cnt` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '已提交报告数',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='试用产品';

/*Data for the table `qinzi_products` */

insert  into `qinzi_products`(`pid`,`parter_id`,`title`,`type_id`,`price`,`jifen`,`reward_jifen`,`totype`,`desc`,`content`,`pic`,`city`,`city_id`,`provice`,`province_id`,`posttype`,`used_cnt`,`remain_cnt`,`b_cnt`,`b_stattime`,`b_endtime`,`bg_stattime`,`bg_endtime`,`bg_cnt`,`createtime`) values (1,1,'金领冠珍护7天轻松体验计划试用礼盒免费试用ddd',0,0.00,0,0,0,'<p>在普通的网页中显示datepicker比较简单,</p>\r\n<p>将<em>bootstrap-datepicker</em>-zh_CN.js 和 <em>bootstrap-datepicker</em>.css 拷贝到rails工程中相应的assets目录中,并在application.js ...</p>','','','北京',110000,'',110000,0,0,0,1,'2014-01-21','2014-01-24','2014-01-25','2014-01-31',0,1387009323),(2,1,'PCbaby孕妇大礼包',6,800.00,0,0,0,'1.您的资料完善度在60%以上，并已通过手机验证 http://play10.pcbaby.com.cn/baby130528/ 2.您或者您的家人是孕妇 3.试用发放地区为全国 4.您留下的地址、电话真实有效 5.凡申请成功者，如因地址不详或电话错误、无人接听造成无法寄送，商家不再补寄或重新邮寄','本次试用说明： 1.本次试用申请无需抵押积分 活动详情： 当身体中孕育了小小的新生命，孕期的所有也都将变得美好和神奇。太平洋亲子网关爱着每一位准妈妈，现在特别推出孕妈妈关爱活动，PCbaby孕妈大礼包免费领！ 只要您是一个孕妇，或者您家里有一个孕妇，就可以免费申领PCbaby孕妇大礼包哦！还犹豫什么？快快动动手指赶紧来申请吧！PCbaby将会陪您度过最难忘的280天！ 领取方法： 1、每一位亲子网注册孕妈参与活动，手机成功验证即可获得PCbaby为您提供的精美母婴用品！ 2、获得礼品后，您还可以到亲子论坛晒单，获得我们精美礼品！ 活动时间： 2013年9月—2014年 温馨提示： 获得孕妈礼包的准妈妈将会收到亲子网的回访电话核实相关信息，若不符合孕妇身份即会被取消获奖资格。','','',0,'',0,1,0,300,0,'2013-12-16','2013-12-28','2014-01-05','2014-01-15',0,1387195071);

/*Table structure for table `qinzi_rule_record` */

DROP TABLE IF EXISTS `qinzi_rule_record`;

CREATE TABLE `qinzi_rule_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0' COMMENT '用户id',
  `name` varchar(50) DEFAULT NULL COMMENT '规则名称',
  `ename` varchar(30) DEFAULT NULL COMMENT '规则简写(字母)',
  `pre_score` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作之前积分总和',
  `score` smallint(10) NOT NULL DEFAULT '0' COMMENT '积分',
  `info` varchar(100) DEFAULT NULL COMMENT '积分简介',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '记录时间',
  PRIMARY KEY (`id`),
  KEY `uid_ename` (`uid`,`ename`,`createtime`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='积分记录';

/*Data for the table `qinzi_rule_record` */

insert  into `qinzi_rule_record`(`id`,`uid`,`name`,`ename`,`pre_score`,`score`,`info`,`createtime`) values (1,1,'登录','login',0,1,'登录加分',1387620326),(2,1,'登录','login',1,1,'登录加1分',1387620364),(3,1,NULL,'login',2,1,'登录加1分',1387625935),(4,1,NULL,'login',3,1,'登录加1分',1387625972),(5,1,NULL,'login',4,1,'登录加1分',1387626244),(6,1,NULL,'login',5,1,'登录加1分',1387626347),(7,1,NULL,'login',6,1,'登录加1分',1387626357),(8,1,NULL,'login',7,1,'登录加1分',1387626380),(9,1,NULL,'login',8,1,'登录加1分',1387626819),(10,1,NULL,'login',9,1,'登录加1分',1387626927),(11,1,NULL,'login',10,1,'登录加1分',1387626934),(12,1,NULL,'login',11,1,'登录加1分',1387627033),(13,1,NULL,'login',12,1,'登录加1分',1387627110),(14,1,NULL,'login',13,1,'登录加1分',1387627149),(15,1,NULL,'login',14,1,'登录加1分',1388565072);

/*Table structure for table `qinzi_rules` */

DROP TABLE IF EXISTS `qinzi_rules`;

CREATE TABLE `qinzi_rules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '规则名称',
  `ename` varchar(30) DEFAULT NULL COMMENT '规则简写(字母)',
  `type` enum('+','-') DEFAULT NULL COMMENT '类型',
  `score` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `desc` varchar(100) DEFAULT NULL COMMENT '规则描述',
  `limit_count` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '限制次数',
  `limit_time` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '限制时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ename` (`ename`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='积分规则';

/*Data for the table `qinzi_rules` */

insert  into `qinzi_rules`(`id`,`name`,`ename`,`type`,`score`,`desc`,`limit_count`,`limit_time`) values (1,'登录','login','+',1,'登录加1分',0,0);

/*Table structure for table `qinzi_share` */

DROP TABLE IF EXISTS `qinzi_share`;

CREATE TABLE `qinzi_share` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '分类[1活动，2试用，3报告]',
  `oid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '产品id',
  `sns_site` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '分享类型[space,qq,sina]',
  `jifen` smallint(5) DEFAULT '0' COMMENT '积分奖励',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分享时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='分享记录';

/*Data for the table `qinzi_share` */

/*Table structure for table `qinzi_user_babies` */

DROP TABLE IF EXISTS `qinzi_user_babies`;

CREATE TABLE `qinzi_user_babies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `baby_state` tinyint(1) DEFAULT '0' COMMENT '宝宝状态[已有宝宝，已怀孕，准备怀孕]',
  `baby_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '宝宝姓名',
  `baby_birth` date DEFAULT NULL COMMENT '宝宝生日',
  `baby_sex` enum('男','女') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '宝宝性别',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=' 宝宝信息 ';

/*Data for the table `qinzi_user_babies` */

insert  into `qinzi_user_babies`(`id`,`uid`,`baby_state`,`baby_name`,`baby_birth`,`baby_sex`,`createtime`) values (1,1,1,'赤炎','2012-12-01',NULL,1387614696);

/*Table structure for table `qinzi_user_friends` */

DROP TABLE IF EXISTS `qinzi_user_friends`;

CREATE TABLE `qinzi_user_friends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `fuid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '好友id',
  `state` tinyint(1) DEFAULT '0' COMMENT '状态[0正常]',
  `mktime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_fuid` (`uid`,`fuid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=' 用户好友';

/*Data for the table `qinzi_user_friends` */

insert  into `qinzi_user_friends`(`id`,`uid`,`fuid`,`state`,`mktime`) values (3,1,2,0,0),(4,2,1,0,0);

/*Table structure for table `qinzi_user_messages` */

DROP TABLE IF EXISTS `qinzi_user_messages`;

CREATE TABLE `qinzi_user_messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型:0普通消息,1系统消息,2添加好友',
  `touid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '接受人id',
  `content` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '内容',
  `state` tinyint(1) DEFAULT '0' COMMENT '状态',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=' 用户消息';

/*Data for the table `qinzi_user_messages` */

insert  into `qinzi_user_messages`(`id`,`uid`,`type`,`touid`,`content`,`state`,`createtime`) values (1,1,0,2,'这个活动不错 @幸福一家子 我们一起去参加吧.',0,1387702316),(2,2,0,1,'这个活动不错 @幸福一家子 我们一起去参加吧.',0,1387702383);

/*Table structure for table `qinzi_user_sns` */

DROP TABLE IF EXISTS `qinzi_user_sns`;

CREATE TABLE `qinzi_user_sns` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `sns_site` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'space, sina',
  `sns_uid` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sns用户id',
  `sns_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sns用户昵称',
  `sns_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'sns握手token',
  `sns_secret` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'sns续期验证token',
  `sns_expires` smallint(10) DEFAULT NULL COMMENT 'sns有效时长',
  `uptime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_site` (`uid`,`sns_site`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=' 用户sns关联信息 ';

/*Data for the table `qinzi_user_sns` */

/*Table structure for table `qinzi_users` */

DROP TABLE IF EXISTS `qinzi_users`;

CREATE TABLE `qinzi_users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `pwd` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '登陆密码',
  `gender` enum('男','女') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '性别',
  `avatar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `realname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地址',
  `postcode` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮编',
  `isemail` tinyint(1) DEFAULT '0' COMMENT '邮箱是否确认',
  `status` tinyint(1) DEFAULT '0' COMMENT '用户状态[0正常，1停用]',
  `jifen` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `try_cnt` int(11) NOT NULL DEFAULT '0' COMMENT '申请成功次数',
  `try_bj_cnt` int(11) NOT NULL DEFAULT '0' COMMENT '发布报告次数',
  `last_ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '登录IP',
  `last_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `nick` (`nick`),
  UNIQUE KEY `NewIndex1` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT=' 用户信息 ';

/*Data for the table `qinzi_users` */

insert  into `qinzi_users`(`uid`,`nick`,`pwd`,`gender`,`avatar`,`email`,`realname`,`mobile`,`address`,`postcode`,`isemail`,`status`,`jifen`,`regtime`,`try_cnt`,`try_bj_cnt`,`last_ip`,`last_time`) values (1,'huxf','72be6ccf4f7a50acf9f66055a613642a0972d361','男','src/20131221/20131221073129728.gif','huxiongfei2005@163.com','额阿发','323323','232323','232',0,0,15,1387604184,0,0,'127.0.0.1',1388565072),(2,'lhj','72be6ccf4f7a50acf9f66055a613642a0972d361','男','src/20131221/20131221073129728.gif','airain2010@hotmail.com',NULL,NULL,NULL,NULL,0,0,0,0,0,0,'0',0);

/*Table structure for table `user` */

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

insert  into `user`(`id`,`type`,`nick`,`email`,`mobile`,`password`,`tao_uid`,`last_time`,`last_ip`,`state`,`maker`,`mktime`,`disable`) values (1,0,'èƒ¡é›„é£ž','455816735@qq.com','','df6385738e8e22882fc8a4bcee2fe37b',1,1390125903,'127.0.0.1',1,1,1371029058,0),(2,0,'æŽçŽ‰åŽ','550807257@qq.com','','ab4ea8d686d82513f1aed139a8eafb37',0,1371029099,'127.0.0.1',1,1,1371029058,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
