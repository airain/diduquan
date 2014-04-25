CREATE DATABASE /*!32312 IF NOT EXISTS*/`diduquan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `diduquan`;

/*Table structure for table `log` */

CREATE TABLE IF NOT EXISTS  `log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '类型',
  `uri` varchar(255) NOT NULL DEFAULT '' COMMENT 'URI',
  `did` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '数据ID',
  `message` varchar(512) NOT NULL DEFAULT '' COMMENT 'Message',
  `maker` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建者',
  `mktime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `log` */

insert  into `log`(`id`,`type`,`uri`,`did`,`message`,`maker`,`mktime`) values (2,'1','2',4,'5',6,7),(3,'index','/index/index',0,'ServiceTest Start',0,1378364575),(4,'index','/index/index',0,'ServiceTest End',0,1378364575),(5,'index','/index/index',0,'ServiceTest Start',0,1378364585),(6,'index','/index/index',0,'ServiceTest End',0,1378364585),(7,'index','/index/index',0,'ServiceTest Start',0,1378364591),(8,'index','/index/index',0,'ServiceTest End',0,1378364591),(9,'index','/index/index',0,'ServiceTest Start',0,1378364593),(10,'index','/index/index',0,'ServiceTest End',0,1378364593),(11,'index','/index/index',0,'ServiceTest Start',0,1378364595),(12,'index','/index/index',0,'ServiceTest End',0,1378364595),(13,'index','/index/index',0,'ServiceTest Start',0,1378364736),(14,'index','/index/index',0,'ServiceTest End',0,1378364736),(15,'login','/login/ajax',0,'',0,1387003130);

/*Table structure for table `menu` */

CREATE TABLE IF NOT EXISTS  `menu` (
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

insert  into `menu`(`id`,`pid`,`name`,`sort`,`url`,`target`,`isleaf`,`deep`,`maker`,`mktime`) values (1,0,'后台菜单',0,'#','inner',0,0,1,1371468163),(2,0,'前台菜单',0,'#','inner',0,0,1,1371468163),(4,1,'系统设置',9,'#','',0,1,1,1371460794),(5,1,'菜单管理',2,'#','',0,1,1,1371461910),(6,5,'菜单管理',0,'#','',0,2,1,1371464088),(7,6,'添加菜单',0,'/admin/menu/create','inner',1,3,1,1371464125),(8,6,'菜单管理',2,'/admin/menu/','inner',1,3,1,1371464162),(9,5,'菜单管理2',0,'#','',0,2,1,1371466427),(10,1,'邮件',0,'#','',0,1,1,1371467985),(11,10,'邮件管理',0,'#','',0,2,1,1371468021),(12,11,'发送邮件',1,'/admin/mail/send','inner',1,3,1,1371468083),(13,11,'邮件管理',2,'/admin/mail/','inner',1,3,1,1371468110),(14,11,'邮件日志',3,'/admin/mail-log/','inner',1,3,1,1371468136),(15,11,'退订管理',4,'/admin/email-unsubscribe/','inner',1,3,1,1371468163);

/*Table structure for table `user` */

CREATE TABLE IF NOT EXISTS  `user` (
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

insert  into `user`(`id`,`type`,`nick`,`email`,`mobile`,`password`,`tao_uid`,`last_time`,`last_ip`,`state`,`maker`,`mktime`,`disable`) values (1,0,'èƒ¡é›„é£ž','455816735@qq.com','','a82cff5cc53ac9419572b72ae2c815e6',1,1378115568,'127.0.0.1',1,1,1371029058,0),(2,0,'æŽçŽ‰åŽ','550807257@qq.com','','ab4ea8d686d82513f1aed139a8eafb37',0,1371029099,'127.0.0.1',1,1,1371029058,0);


-- -------------------


-- 用户信息
CREATE TABLE IF NOT EXISTS  `qinzi_users` (
  `uid` int(11) unsigned NOT NULL auto_increment,
  `nick` varchar(50) NOT NULL  comment "用户昵称",
  `pwd` varchar(64)  NOT NULL comment "登陆密码",
  `gender` enum('男','女') comment '性别',
  `avatar` varchar(100) default null comment "头像",
  `email` varchar(100) default null comment "邮箱",
  `realname` varchar(20) default null comment "真实姓名",
  `mobile` varchar(15) default null comment "手机号",
  `address` varchar(100) default null comment "地址",
  `postcode` varchar(6) default null comment "邮编",
  `isemail` tinyint(1) default 0 comment "邮箱是否确认",
  `status`  tinyint(1) default 0 comment "用户状态[0正常，1停用]",
  `jifen` int(11) NOT NULL default 0 comment "积分" ,
  `regtime` int(11) unsigned NOT NULL default 0 comment "添加时间" ,

  `try_cnt` int(11) NOT NULL default 0 comment "申请成功次数" ,
  `try_bj_cnt` int(11) NOT NULL default 0 comment "发布报告次数" ,

   `last_ip` varchar(15) NOT NULL DEFAULT '0' COMMENT '登录IP',
   `last_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',

  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment " 用户信息 ";

-- 宝宝信息
CREATE TABLE IF NOT EXISTS  `qinzi_user_babies` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default 0,
  `baby_type` tinyint(1) default 0 comment"宝宝状态[已有宝宝，已怀孕，准备怀孕]",
  `baby_name` varchar(50) default null comment "宝宝姓名",
  `baby_birth` date comment "宝宝生日",
  `baby_sex` enum('男','女') comment "宝宝性别",
  `createtime` int(11) unsigned NOT NULL default 0 comment "添加时间" ,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment " 宝宝信息 ";


-- 用户sns关联信息
CREATE TABLE IF NOT EXISTS  `qinzi_user_sns` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default 0 comment '用户id',
  `sns_site` varchar(10) not null default '' comment"space, sina",
  `sns_uid` varchar(64) not null comment "sns用户id",
  `sns_name` varchar(20) not null  comment "sns用户昵称",
  `sns_token` varchar(100) comment "sns握手token",
  `sns_secret` varchar(100) comment "sns续期验证token",
  `sns_expires` smallint(10) comment "sns有效时长",
  `uptime` int(11) unsigned NOT NULL default 0 comment "更新时间" ,
  PRIMARY KEY  (`id`),
  unique Key `uid_site`(`uid`,`sns_site`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment " 用户sns关联信息 ";


-- 用户好友
CREATE TABLE IF NOT EXISTS  `qinzi_user_friends` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default 0 comment "用户id",
  `fuid` int(11) unsigned NOT NULL default 0 comment "好友id",
  `state`  tinyint(1) default 0 comment "状态[0正常]",
  `mktime` int(11) unsigned NOT NULL default 0 comment "添加时间" ,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uid_fuid`(`uid`,`fuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment " 用户好友";


-- 用户消息
CREATE TABLE IF NOT EXISTS  `qinzi_user_messages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default 0 comment "用户id",
  `type` tinyint(1) unsigned not null default 0 comment "类型:0普通消息,1系统消息,2添加好友",
  `touid` int(11) unsigned NOT NULL default 0 comment "接受人id",
  `content` varchar(300) comment "内容",
  `state`  tinyint(1) default 0 comment "状态",
  `createtime` int(11) unsigned NOT NULL default 0 comment "发送时间" ,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment " 用户消息";


-- 积分规则
CREATE TABLE IF NOT EXISTS `qinzi_rules` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT null comment '规则名称',
  `ename` varchar(30) DEFAULT null comment '规则简写(字母)',
  `type` enum('+','-')  comment '类型',
  `score` smallint(10) unsigned NOT NULL DEFAULT 0 comment'积分',
  `desc` varchar(100) DEFAULT null comment'规则描述',
  `limit_count` smallint(10) unsigned NOT NULL DEFAULT 0 comment'限制次数',
  `limit_time` smallint(10) unsigned NOT NULL DEFAULT 0 comment'限制时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ename`(`ename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 comment'积分规则';

-- 积分记录
CREATE TABLE IF NOT EXISTS `qinzi_rule_record` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT 0 comment '用户id',
  `ename` varchar(30) DEFAULT null comment '规则简写(字母)',
  `pre_score` int(10) unsigned NOT NULL DEFAULT 0 comment'操作之前积分总和',
  `score` smallint(10) NOT NULL DEFAULT 0 comment'积分',
  `info` varchar(100) default null comment '积分简介',
  `createtime` int(11) unsigned NOT NULL DEFAULT 0 comment'记录时间',
  PRIMARY KEY (`id`),
  KEY `uid_ename`(`uid`,`ename`,`createtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 comment'积分记录';


-- 合作商信息
CREATE TABLE IF NOT EXISTS  `qinzi_parters` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(50) not null comment "登录名称",
  `pwd` varchar(20) not null comment "登录密码",
  `company` varchar(100) NOT NULL comment"公司名称",
  `logo` varchar(200) comment "公司logo图",
  `type` tinyint(1)  comment "公司类型",
  `info` text comment "公司介绍",
  `address` varchar(100) default NULL comment"公司地址",
  `postcode` char(6) default null comment"邮编",
  `email` varchar(100) comment "邮箱",
  `contact`varchar(20) default null comment "联系人",
  `mobile` varchar(20) default null comment "联系电话",
  `iphone` varchar(100) default null comment "其他联系电话",
  `statue` tinyint(1) default 0 comment "状态[0正常,1停用]",
  `disable` tinyint(1) default 0 comment "是否删除",
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment "合作商信息" ;

-- 类型[年龄段1:0-3, 2:3-6, 3:其他]
CREATE TABLE IF NOT EXISTS  `qinzi_product_type` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(120) NOT NULL comment "名称",
  `type` tinyint(1) default 0 comment "0产品类型，1活动类型, 2年龄段",
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment "类型";

-- 城市xx

-- 试用产品
CREATE TABLE IF NOT EXISTS  `qinzi_products` (
  `pid` int(11) unsigned NOT NULL auto_increment,
  `parter_id` int(11) unsigned NOT NULL default 0 comment "合作商id",
  `title` varchar(120) NOT NULL comment "标题",
  `type_id` int(11) NOT NULL default 0 comment "产品类型id",
  `price` float(5,2) NOT NULL default 0 comment "产品价格",
  `jifen` smallint(10) not null default 0 comment "产品消费积分",
  `reward_jifen` smallint(10) not null default 0 comment "试用报价奖励积分",
  `totype` tinyint(1) unsigned not null default 0 comment "参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]",
  `desc` varchar(200) comment "申请规则",
  `content` text comment "产品详细信息",
  `pic` varchar(100) default null comment "产品logo",
  `city` varchar(50) default null comment "申请区域[城市]",
  `city_id` int(11) unsigned NOT NULL default 0  comment "城市id",
  `provice` varchar(50) default null comment "省份",
  `province_id` int(11) unsigned NOT NULL default 0 comment "省份id",
  `posttype` tinyint(1) unsigned not null default 0 comment "配送方式[1包邮，2自取，3付邮]",
  `used_cnt` smallint(8) unsigned not null default 0 comment "已用商品数[申请成功人数]",
  `remain_cnt` smallint(8) unsigned not null default 0 comment "剩余商品数",
  `b_cnt` int(11) unsigned not null default 0 comment "申请人数",
  `b_stattime` date default null comment "报名开始时间",
  `b_endtime` date default null comment "报名截止日期",
  `bg_stattime` date default null comment "报告提交开始时间",
  `bg_endtime` date default null comment "报告提交截止日期",
  `bg_cnt` int(11) unsigned not null default 0 comment "已提交报告数",
  `createtime` int(11) unsigned NOT NULL default 0 comment "添加时间" ,
  PRIMARY KEY  (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment "试用产品";

-- 试用申请名单
CREATE TABLE IF NOT EXISTS  `qinzi_product_applies` (
  `paid` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default 0 comment "用户id",
  `pid` int(11) unsigned NOT NULL default 0 comment "商品id",
  `title`  varchar(120) NOT NULL comment "商品标题",
  `isbg`  tinyint(1) default 0 comment "是否已提交报告", 
  `des` varchar(300) default null comment "申请宣言",
  `state` tinyint(1) default 0 comment "是否审核[0审核中，1未通过，2通过]",
  `createtime` int(11) unsigned not null default 0 comment "申请时间",
  PRIMARY KEY  (`paid`),
  unique KEY (`uid`,`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment "试用申请名单";

-- 试用申请报告
CREATE TABLE IF NOT EXISTS  `qinzi_product_topics` (
  `prid` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default 0 comment "用户id",
  `pid` int(11) unsigned NOT NULL default 0 comment "商品id",
  `title` varchar(100)  default null comment "标题",
  `des` varchar(200)  default null comment "报告简要",
  `img_cnt` smallint(5) default 0 comment "图片数量",
  `content` text default null comment "报告内容",
  `reward_jifen` smallint(10) default 0 comment "奖励积分",
  `reward_ojifen` smallint(10) default 0 comment "额外奖励积分",
  `state` tinyint(1) default 0 comment "是否删除",
  `createtime` int(11) unsigned not null default 0 comment "提交时间",
  PRIMARY KEY  (`prid`),
  unique KEY(`uid`,`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment "试用申请报告";

-- 分享记录
CREATE TABLE IF NOT EXISTS  `qinzi_share` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default 0 comment "用户id",
  `type` tinyint(1) unsigned NOT NULL default 0 comment "分类[1活动，2试用，3报告]",
  `oid` int(11) unsigned NOT NULL default 0 comment "产品id",
  `sns_site` varchar(10)  default null comment "分享类型[space,qq,sina]",
  `jifen` smallint(5) default 0 comment "积分奖励",
  `createtime` int(11) unsigned not null default 0 comment "分享时间",
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment "分享记录";

-- 活动
CREATE TABLE IF NOT EXISTS  `qinzi_activities` (
  `aid` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(120) NOT NULL comment "标题",
  `content` text comment "产品详细信息",
  `sponsor` varchar(120) NOT NULL comment "活动主办方",
  `pic` varchar(100) default null comment "产品logo",
  `totype` int(1) unsigned not null default 0 comment "年龄段[1:0-3,2:3-6,3:6-12]",
  `city` varchar(50) default null comment "申请区域[城市]",
  `city_id` int(11) unsigned NOT NULL default 0  comment "城市id",
  `provice` varchar(50) default null comment "省份",
  `province_id` int(11) unsigned NOT NULL default 0 comment "省份id",
  `type` int(11) unsigned not null default 0 comment "活动类型",
  `isfree` tinyint(1) unsigned not null default 1 comment "是否免费[1免费，0不免费]",
  `used_cnt` smallint(8) unsigned not null default 0 comment "已用名额",
  `remain_cnt` smallint(8) unsigned not null default 0 comment "剩余名额",
  `b_cnt` int(11) unsigned not null default 0 comment "报名人数",
  `b_stattime` date default null comment "报名开始时间",
  `b_endtime` date default null comment "报名截止日期",
  `createtime` int(11) unsigned NOT NULL default 0 comment "添加时间" ,
  PRIMARY KEY  (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment "活动";

-- 活动报名名单
CREATE TABLE IF NOT EXISTS  `qinzi_activitiy_orders` (
  `aoid` int(11) unsigned NOT NULL auto_increment,
  `aid` int(11) unsigned NOT NULL default 0 comment "活动id",
  `title` varchar(120) NOT NULL comment "活动标题",
  `uid` int(11) unsigned NOT NULL default 0 comment "用户id",
  `cnt` smallint(5) unsigned not null default 0 comment "参加人数",
  `realname` varchar(20) default null comment "真实姓名",
  `mobile` varchar(15) default null comment "手机号",
  `address` varchar(100) default null comment "地址",
  `postcode` varchar(6) default null comment "邮编", 
  `state` tinyint(1) default 0 comment "状态[0报名成功，1报名失败，2报名成功]",
  `createtime` int(11) unsigned NOT NULL default 0 comment "添加时间" ,
  PRIMARY KEY  (`aoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment " 活动报名名单 ";

-- 活动感想
CREATE TABLE IF NOT EXISTS  `qinzi_activitiy_topics` (
  `tpid` int(11) unsigned NOT NULL auto_increment,
  `aid` int(11) unsigned NOT NULL default 0 comment "活动id",
  `uid` int(11) unsigned NOT NULL default 0 comment "用户id",
  `title` varchar(100) comment '标题',
  `content` text comment "内容",
  `pic` varchar(100) comment "提取内容中的一张图片",
  `createtime` int(11) unsigned NOT NULL default 0 comment "添加时间" ,
  PRIMARY KEY  (`tpid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment " 活动感想 ";

-- 活动评论
CREATE TABLE IF NOT EXISTS  `qinzi_activitiy_comments` (
  `acid` int(11) unsigned NOT NULL auto_increment,
  `aid` int(11) unsigned NOT NULL default 0 comment "活动id",
  `uid` int(11) unsigned NOT NULL default 0 comment "用户id",
  `type` tinyint(1) unsigned NOT NULL default 0 comment "评论类型[0活动，1活动感想]",
  `content` varchar(200) default null comment '评论内容',
  `pic` varchar(100) default null comment "图片",
  `parentid` int(11) unsigned NOT NULL default 0 comment "父id",
  `createtime` int(11) unsigned NOT NULL default 0 comment "添加时间" ,
  PRIMARY KEY  (`acid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 comment " 活动评论 ";

