/*
SQLyog Community v11.31 (64 bit)
MySQL - 5.6.17 : Database - i3template
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`i3template` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `i3template`;

/*Table structure for table `sys_themes` */

DROP TABLE IF EXISTS `sys_themes`;

CREATE TABLE `sys_themes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) DEFAULT NULL,
  `parent_file` varchar(50) DEFAULT NULL,
  `is_active` int(1) DEFAULT '1',
  `is_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `sys_themes` */

LOCK TABLES `sys_themes` WRITE;

insert  into `sys_themes`(`ID`,`filename`,`parent_file`,`is_active`,`is_delete`) values (1,'readable','bootswatch',0,0),(2,'cerulean','bootswatch',1,0),(3,'cosmo','bootswatch',0,0),(4,'cyborg','bootswatch',0,0),(5,'darkly','bootswatch',0,0),(6,NULL,'bootswatch',0,1),(7,'flatly','bootswatch',0,0),(8,'journal','bootswatch',0,0),(9,'lumen','bootswatch',0,0),(10,'sandstone','bootswatch',0,0),(11,'simplex','bootswatch',0,0),(12,'slate','bootswatch',0,0),(13,'spacelab','bootswatch',0,0),(14,'united','bootswatch',0,0),(15,'yeti','bootswatch',0,0);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
