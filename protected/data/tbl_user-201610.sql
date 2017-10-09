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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`i3template` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `reset_request` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'strtotime request to reset password',
  `record_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `update_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `is_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `sys_role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`user_id`,`user_username`,`user_password`,`email`,`role_id`,`reset_request`,`record_by`,`record_date`,`update_by`,`update_date`,`is_delete`) values ('D0D97F52-92BE-3962-9BB0-20887B002E1B','admin1','$2y$13$aNfGcKH2jGSrGLqkRe2C6OZx8KOEcWYEPDSLQuREkl26IDZichlZm','admin1@ikram.com.myy',1,NULL,NULL,NULL,'sysadmin','2016-10-14 16:21:53',0);
insert  into `tbl_user`(`user_id`,`user_username`,`user_password`,`email`,`role_id`,`reset_request`,`record_by`,`record_date`,`update_by`,`update_date`,`is_delete`) values ('sysadmin','sysadmin','$2y$13$IKD5Q2/1kI68DBh.qIVOauVfYGNmng20i796MUZ0/d12StBRrFS9i','test1@example.com',0,NULL,NULL,NULL,NULL,NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
