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

/*Table structure for table `tbl_editable` */

DROP TABLE IF EXISTS `tbl_editable`;

CREATE TABLE `tbl_editable` (
  `editable_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `editable_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `editable_textarea` text COLLATE utf8_unicode_ci,
  `editable_select` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `editable_select2` text COLLATE utf8_unicode_ci,
  `editable_checkbox` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `editable_date` date DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `is_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`editable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_editable` */

insert  into `tbl_editable`(`editable_id`,`editable_text`,`editable_textarea`,`editable_select`,`editable_select2`,`editable_checkbox`,`editable_date`,`record_date`,`update_date`,`is_delete`) values ('064913E0-5ED1-3FEE-B9E7-30F797AB88DB','Test 1','ini\ncobaaan\nsahaja\ngeng','2','1','1,2','2016-02-10','2016-01-26 15:51:01','2016-02-10 08:38:39',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
