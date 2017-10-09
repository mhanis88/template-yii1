/*
SQLyog Community v12.01 (64 bit)
MySQL - 5.6.17 : Database - i3template
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `sys_action` */

DROP TABLE IF EXISTS `sys_action`;

CREATE TABLE `sys_action` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `action_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller_id` int(11) NOT NULL,
  `record_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `update_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`action_id`),
  KEY `controller_id` (`controller_id`),
  CONSTRAINT `sys_action_ibfk_1` FOREIGN KEY (`controller_id`) REFERENCES `sys_controller` (`controller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_action` */

insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (1,'admin','Listing Modules',1,'sysadmin','2015-11-20 16:46:43','sysadmin','2015-11-20 16:55:52');
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (2,'create','Create New Module',1,'sysadmin','2015-11-20 16:46:57',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (3,'update','Update Existing Module',1,'sysadmin','2015-11-20 16:47:17',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (4,'deleteBulk','Delete Existing Module(s)',1,'sysadmin','2015-11-20 16:47:33',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (5,'admin','Listing Controllers',2,'sysadmin','2015-11-20 16:48:06','sysadmin','2015-11-20 16:56:00');
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (6,'create','Create New Controller',2,'sysadmin','2015-11-20 16:48:24',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (7,'update','Update Existing Controller',2,'sysadmin','2015-11-20 16:48:45',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (8,'deleteBulk','Delete Existing Controller(s)',2,'sysadmin','2015-11-20 16:49:03',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (9,'admin','Listing Actions',3,'sysadmin','2015-11-20 16:49:38','sysadmin','2015-11-20 16:56:07');
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (10,'create','Create New Action',3,'sysadmin','2015-11-20 16:49:52',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (11,'update','Update Existing Action',3,'sysadmin','2015-11-20 16:50:13',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (12,'deleteBulk','Delete Existing Action(s)',3,'sysadmin','2015-11-20 16:52:42','sysadmin','2015-11-20 16:55:03');
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (13,'admin','Listing Menus',4,'sysadmin','2015-11-20 16:53:35','sysadmin','2015-11-20 16:56:20');
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (14,'create','Create New Menu',4,'sysadmin','2015-11-20 16:53:53',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (15,'update','Update Existing Menu',4,'sysadmin','2015-11-20 16:54:12',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (16,'deleteBulk','Delete Existing Menu(s)',4,'sysadmin','2015-11-20 16:54:49',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (17,'admin','Listing Roles',5,'sysadmin','2015-11-20 16:55:44','sysadmin','2015-11-20 17:06:44');
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (18,'create','Create New Role',5,'sysadmin','2015-11-20 17:07:04',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (19,'update','Update Existing Role',5,'sysadmin','2015-11-20 17:07:22',NULL,NULL);
insert  into `sys_action`(`action_id`,`action_name`,`action_desc`,`controller_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (20,'deleteBulk','Delete Existing Role(s)',5,'sysadmin','2015-11-20 17:07:46',NULL,NULL);

/*Table structure for table `sys_controller` */

DROP TABLE IF EXISTS `sys_controller`;

CREATE TABLE `sys_controller` (
  `controller_id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `controller_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_id` int(11) NOT NULL,
  `record_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `update_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`controller_id`),
  KEY `module_id` (`module_id`),
  CONSTRAINT `sys_controller_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `sys_module` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_controller` */

insert  into `sys_controller`(`controller_id`,`controller_name`,`controller_desc`,`module_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (1,'sysModule',NULL,1,'sysadmin','2015-11-20 16:46:21',NULL,NULL);
insert  into `sys_controller`(`controller_id`,`controller_name`,`controller_desc`,`module_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (2,'sysController',NULL,1,'sysadmin','2015-11-20 16:47:47',NULL,NULL);
insert  into `sys_controller`(`controller_id`,`controller_name`,`controller_desc`,`module_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (3,'sysAction',NULL,1,'sysadmin','2015-11-20 16:49:19',NULL,NULL);
insert  into `sys_controller`(`controller_id`,`controller_name`,`controller_desc`,`module_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (4,'sysMenu',NULL,1,'sysadmin','2015-11-20 16:53:11',NULL,NULL);
insert  into `sys_controller`(`controller_id`,`controller_name`,`controller_desc`,`module_id`,`record_by`,`record_date`,`update_by`,`update_date`) values (5,'sysRole',NULL,1,'sysadmin','2015-11-20 16:55:18',NULL,NULL);

/*Table structure for table `sys_menu` */

DROP TABLE IF EXISTS `sys_menu`;

CREATE TABLE `sys_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `menu_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_menu_id` int(11) DEFAULT NULL,
  `divider` int(1) DEFAULT '0',
  `menu_level` int(1) NOT NULL,
  `seq` int(5) NOT NULL,
  `record_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `update_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `is_publish` int(1) DEFAULT '0',
  PRIMARY KEY (`menu_id`),
  KEY `parent_menu_id` (`parent_menu_id`),
  CONSTRAINT `sys_menu_ibfk_1` FOREIGN KEY (`parent_menu_id`) REFERENCES `sys_menu` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`menu_id`,`menu_name`,`menu_url`,`parent_menu_id`,`divider`,`menu_level`,`seq`,`record_by`,`record_date`,`update_by`,`update_date`,`is_publish`) values (1,'Config','#',NULL,0,1,1000,'sysadmin','2015-11-20 16:43:54',NULL,NULL,1);
insert  into `sys_menu`(`menu_id`,`menu_name`,`menu_url`,`parent_menu_id`,`divider`,`menu_level`,`seq`,`record_by`,`record_date`,`update_by`,`update_date`,`is_publish`) values (2,'Module','config/sysModule/admin',1,0,2,1001,'sysadmin','2015-11-20 16:44:22',NULL,NULL,1);
insert  into `sys_menu`(`menu_id`,`menu_name`,`menu_url`,`parent_menu_id`,`divider`,`menu_level`,`seq`,`record_by`,`record_date`,`update_by`,`update_date`,`is_publish`) values (3,'Controller','config/sysController/admin',1,0,2,1002,'sysadmin','2015-11-20 16:44:43',NULL,NULL,1);
insert  into `sys_menu`(`menu_id`,`menu_name`,`menu_url`,`parent_menu_id`,`divider`,`menu_level`,`seq`,`record_by`,`record_date`,`update_by`,`update_date`,`is_publish`) values (4,'Action','config/sysAction/admin',1,0,2,1003,'sysadmin','2015-11-20 16:45:03',NULL,NULL,1);
insert  into `sys_menu`(`menu_id`,`menu_name`,`menu_url`,`parent_menu_id`,`divider`,`menu_level`,`seq`,`record_by`,`record_date`,`update_by`,`update_date`,`is_publish`) values (5,'Menu','config/sysMenu/admin',1,1,2,1004,'sysadmin','2015-11-20 16:45:23',NULL,NULL,1);
insert  into `sys_menu`(`menu_id`,`menu_name`,`menu_url`,`parent_menu_id`,`divider`,`menu_level`,`seq`,`record_by`,`record_date`,`update_by`,`update_date`,`is_publish`) values (6,'Role','config/sysRole/admin',1,0,2,1005,'sysadmin','2015-11-20 16:45:44',NULL,NULL,1);

/*Table structure for table `sys_module` */

DROP TABLE IF EXISTS `sys_module`;

CREATE TABLE `sys_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `module_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `update_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_module` */

insert  into `sys_module`(`module_id`,`module_name`,`module_desc`,`record_by`,`record_date`,`update_by`,`update_date`) values (1,'config',NULL,'sysadmin','2015-11-20 16:46:02',NULL,NULL);

/*Table structure for table `sys_role` */

DROP TABLE IF EXISTS `sys_role`;

CREATE TABLE `sys_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_page` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `update_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `is_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_role` */

insert  into `sys_role`(`role_id`,`role_name`,`role_desc`,`home_page`,`record_by`,`record_date`,`update_by`,`update_date`,`is_delete`) values (1,'Admin',NULL,NULL,'sysadmin','2015-11-20 17:08:38','sysadmin','2015-11-20 17:09:05',0);

/*Table structure for table `sys_role_access` */

DROP TABLE IF EXISTS `sys_role_access`;

CREATE TABLE `sys_role_access` (
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `controller_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  KEY `role_id` (`role_id`),
  KEY `module_id` (`module_id`),
  KEY `controller_id` (`controller_id`),
  KEY `action_id` (`action_id`),
  CONSTRAINT `sys_role_access_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `sys_role` (`role_id`),
  CONSTRAINT `sys_role_access_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `sys_module` (`module_id`),
  CONSTRAINT `sys_role_access_ibfk_3` FOREIGN KEY (`controller_id`) REFERENCES `sys_controller` (`controller_id`),
  CONSTRAINT `sys_role_access_ibfk_4` FOREIGN KEY (`action_id`) REFERENCES `sys_action` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_role_access` */

/*Table structure for table `sys_role_menu` */

DROP TABLE IF EXISTS `sys_role_menu`;

CREATE TABLE `sys_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`menu_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_role_menu` */

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `reset_request` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'strtotime request to reset password',
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `sys_role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*Data for the table `tbl_user` */

insert  into `tbl_user`(`user_id`,`user_username`,`user_password`,`email`,`role_id`,`reset_request`) values ('sysadmin','sysadmin','$2y$13$EX56wGVGC4UOPBwR4qAPieiBLtUGyX79nPg2SSUBscLfKFb7/JcOi','test1@example.com',0,NULL);

/*Table structure for table `tmp_type` */

DROP TABLE IF EXISTS `tmp_type`;

CREATE TABLE `tmp_type` (
  `type_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `update_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT '1',
  `is_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `vw_role_access` */

DROP TABLE IF EXISTS `vw_role_access`;

/*!50001 DROP VIEW IF EXISTS `vw_role_access` */;
/*!50001 DROP TABLE IF EXISTS `vw_role_access` */;

/*!50001 CREATE TABLE  `vw_role_access`(
 `role_id` int(11) ,
 `module_id` int(11) ,
 `controller_id` int(11) ,
 `action_id` int(11) ,
 `role_name` varchar(100) ,
 `module_name` varchar(100) ,
 `controller_name` varchar(100) ,
 `action_name` varchar(100) 
)*/;

/*View structure for view vw_role_access */

/*!50001 DROP TABLE IF EXISTS `vw_role_access` */;
/*!50001 DROP VIEW IF EXISTS `vw_role_access` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_role_access` AS (select `sra`.`role_id` AS `role_id`,`sra`.`module_id` AS `module_id`,`sra`.`controller_id` AS `controller_id`,`sra`.`action_id` AS `action_id`,`sr`.`role_name` AS `role_name`,`sm`.`module_name` AS `module_name`,`sc`.`controller_name` AS `controller_name`,`sa`.`action_name` AS `action_name` from ((((`sys_role_access` `sra` left join `sys_role` `sr` on((`sra`.`role_id` = `sr`.`role_id`))) left join `sys_module` `sm` on((`sra`.`module_id` = `sm`.`module_id`))) left join `sys_controller` `sc` on((`sra`.`controller_id` = `sc`.`controller_id`))) left join `sys_action` `sa` on((`sra`.`action_id` = `sa`.`action_id`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
