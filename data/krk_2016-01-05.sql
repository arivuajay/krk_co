/*
SQLyog Ultimate v8.55 
MySQL - 5.6.14 : Database - krk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_admin` */

DROP TABLE IF EXISTS `tbl_admin`;

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_wipo_user_role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_admin` */

insert  into `tbl_admin`(`id`,`username`,`name`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`) values (1,'admin','admin','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec',NULL,'vinodh.arumugam@me.com',1,'1',1413526995,1431398513);

/*Table structure for table `tbl_audit_trail` */

DROP TABLE IF EXISTS `tbl_audit_trail`;

CREATE TABLE `tbl_audit_trail` (
  `aud_id` int(11) NOT NULL AUTO_INCREMENT,
  `aud_user` int(11) NOT NULL,
  `aud_class` varchar(100) DEFAULT 'comment-o',
  `aud_action` varchar(255) DEFAULT NULL,
  `aud_message` varchar(255) NOT NULL,
  `aud_ip_address` varchar(100) DEFAULT NULL,
  `aud_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aud_id`),
  KEY `FK_wipo_audit_trail_user` (`aud_user`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_audit_trail` */

insert  into `tbl_audit_trail`(`aud_id`,`aud_user`,`aud_class`,`aud_action`,`aud_message`,`aud_ip_address`,`aud_created_date`) values (6,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-05 18:53:48'),(7,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-05 18:54:10'),(8,1,'user','site.default.login','admin logged-in successfully.','::1','2015-08-05 18:54:16'),(9,1,'user','site.user.create','Created User successfully.','::1','2015-08-05 19:27:58'),(10,1,'user','site.user.update','Updated User successfully.','::1','2015-08-05 19:33:19'),(11,1,'user','site.company.create','Created Company successfully.','::1','2015-08-06 12:27:59'),(12,1,'user','site.company.create','Created Company successfully.','::1','2015-08-06 12:33:30'),(13,1,'user','site.company.create','Created Company successfully.','::1','2015-08-06 12:33:56'),(14,1,'user','site.company.create','Created Company successfully.','::1','2015-08-06 12:34:47'),(15,1,'user','site.masters.company_create','Created Company successfully.','::1','2015-08-06 12:40:32'),(16,1,'user','site.masters.company_create','Created Company successfully.','::1','2015-08-06 12:43:06'),(17,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 17:11:32'),(18,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 17:14:37'),(19,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 18:24:04'),(20,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 18:24:05'),(21,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 18:32:37'),(22,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 18:33:04'),(23,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:39:16'),(24,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:39:21'),(25,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:39:31'),(26,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:40:56'),(27,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:41:10'),(28,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:42:21'),(29,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 18:51:47'),(30,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 18:56:54'),(31,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:04:56'),(32,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:06:05'),(33,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:06:19'),(34,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:06:43'),(35,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:07:51'),(36,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:10:04'),(37,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:10:58'),(38,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:05'),(39,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:11'),(40,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:45'),(41,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:50'),(42,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:54'),(43,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:58'),(44,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:12:03'),(45,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:12:15'),(46,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:16:05'),(47,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:23:04'),(48,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:26:27'),(49,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:29:57'),(50,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:33:28'),(51,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:33:41'),(52,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:34:41'),(53,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:35:14'),(54,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:42:31'),(55,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:42:59'),(56,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:43:43'),(57,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:44:48'),(58,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:46:05'),(59,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:46:44'),(60,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:47:18'),(61,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:47:35'),(62,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:48:01'),(63,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:51:42'),(64,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:51:43'),(65,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:51:59'),(66,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:52:01'),(67,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:52:34'),(68,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:52:35'),(69,1,'user','site.masters.company_create','Created Company successfully.','::1','2015-08-07 11:05:22'),(70,1,'user','site.masters.company_update','Updated Company successfully.','::1','2015-08-07 11:15:55'),(71,1,'user','site.masters.company_update','Updated Company successfully.','::1','2015-08-07 11:16:08'),(72,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 11:19:58'),(73,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 11:20:11'),(74,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 11:20:24'),(75,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 12:48:45'),(76,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 12:50:03'),(77,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 13:09:19'),(78,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 13:11:44'),(79,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 13:26:59'),(80,1,'user','site.masters.permit_delete','Deleted Permit successfully.','::1','2015-08-07 13:28:46'),(81,1,'user','site.masters.permit_delete','Deleted Permit successfully.','::1','2015-08-07 13:28:52'),(82,1,'user','site.masters.family_save','Created Product Family successfully.','::1','2015-08-07 14:12:29'),(83,1,'user','site.masters.family_save','Created Product Family successfully.','::1','2015-08-07 14:13:15'),(84,1,'user','site.masters.family_save','Created Product Family successfully.','::1','2015-08-07 15:24:12'),(85,1,'user','site.masters.family_save','Updated Product Family successfully.','::1','2015-08-07 15:24:28'),(86,1,'user','site.masters.family_save','Updated Product Family successfully.','::1','2015-08-07 15:25:24'),(87,1,'user','site.masters.product_save','Created Product Family successfully.','::1','2015-08-07 15:58:10'),(88,1,'user','site.masters.product_save','Created Product Family successfully.','::1','2015-08-07 16:01:29'),(89,1,'user','site.masters.product_save','Created Product Family successfully.','::1','2015-08-07 16:01:40'),(90,1,'user','site.masters.variety_save','Created Product Variety Family successfully.','::1','2015-08-07 16:42:24'),(91,1,'user','site.masters.permit_save','Updated Permit successfully.','::1','2015-08-07 16:52:20'),(92,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:07:22'),(93,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:07:30'),(94,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:08:07'),(95,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:08:42'),(96,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:11:05'),(97,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:11:28'),(98,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:12:03'),(99,1,'user','site.masters.grade_save','Created Product Grade Family successfully.','::1','2015-08-07 19:23:25'),(100,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-08 11:59:51'),(101,1,'user','site.default.login','admin logged-in successfully.','::1','2015-08-08 12:00:25'),(102,1,'user','site.masters.grade_save','Created Product Grade Family successfully.','::1','2015-08-08 12:04:42'),(103,1,'user','site.masters.grade_save','Updated Product Grade Family successfully.','::1','2015-08-08 12:36:13'),(104,1,'user','site.masters.vendor_save','Created Vendor successfully.','::1','2015-08-08 13:34:37'),(105,1,'user','site.masters.vendor_delete','Deleted Vendor successfully.','::1','2015-08-08 13:43:55'),(106,1,'user','site.masters.vendor_save','Created Vendor successfully.','::1','2015-08-08 13:44:19'),(107,1,'user','site.masters.liner_save','Created Liner successfully.','::1','2015-08-08 18:01:08'),(108,1,'user','site.user.update','Updated User successfully.','::1','2015-08-08 18:02:32'),(109,1,'user','site.user.delete','Deleted User successfully.','::1','2015-08-08 18:02:41'),(110,1,'user','site.user.create','Created User successfully.','::1','2015-08-08 18:03:08'),(111,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-08 18:05:28'),(112,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-08 19:26:11'),(113,1,'user','site.default.login','admin logged-in successfully.','::1','2015-08-08 19:26:21'),(114,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-08 19:34:06'),(115,1,'user','site.default.login','admin logged-in successfully.','::1','2015-08-10 10:17:45'),(116,1,'user','site.masters.size_save','Updated Product Size Family successfully.','::1','2015-08-10 19:01:59'),(117,1,'user','site.masters.size_save','Updated Product Size Family successfully.','::1','2015-08-10 19:02:13'),(118,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 17:43:45'),(119,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 17:47:40'),(120,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 17:49:53'),(121,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 17:51:19'),(122,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 18:21:54'),(123,1,'user','site.default.logout','admin logged-out successfully.','127.0.0.1','2015-08-12 12:26:37'),(124,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-08-12 12:35:38'),(125,2,'user','site.user.create','Created User successfully.','127.0.0.1','2015-08-12 13:24:35'),(126,2,'user','site.user.create','Created User successfully.','127.0.0.1','2015-08-12 13:28:58'),(127,2,'user','site.default.logout','asas logged-out successfully.','127.0.0.1','2015-08-12 13:32:13'),(128,4,'user','site.default.login','pa0002 logged-in successfully.','127.0.0.1','2015-08-12 13:33:17'),(129,4,'user','site.default.logout','Prakash logged-out successfully.','127.0.0.1','2015-08-12 13:36:31'),(130,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-08-12 13:36:37'),(131,2,'user','site.user.update','Updated User successfully.','127.0.0.1','2015-08-12 13:36:51'),(132,2,'user','site.default.login','admin logged-in successfully.','::1','2015-08-13 15:42:27'),(133,2,'user','site.user.update','Updated User successfully.','::1','2015-08-13 17:07:16'),(134,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-14 11:16:23'),(135,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-14 11:21:18'),(136,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-14 11:26:23'),(137,1,'user','site.masters.variety_save','Created Product Variety Family successfully.','::1','2015-08-14 12:07:40'),(138,1,'user','site.invoice.create','Created Invoice successfully.','::1','2015-08-14 12:40:32'),(139,1,'user','site.invoice.create','Created Invoice successfully.','::1','2015-08-14 12:46:18'),(140,1,'user','site.invoice.create','Created Invoice successfully.','::1','2015-08-14 12:54:14'),(141,1,'user','site.invoice.create','Created Invoice successfully.','::1','2015-08-14 12:59:22'),(142,1,'user','site.billlading.create','Created BillLading successfully.','::1','2015-08-14 16:27:06'),(143,1,'user','site.pytoorigin.create','Created PytoOrigin successfully.','::1','2015-08-14 17:17:23'),(144,2,'user','site.default.login','admin logged-in successfully.','103.231.216.206','2015-08-14 07:49:26'),(145,2,'user','site.masters.family_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:08:24'),(146,2,'user','site.user.update','Updated User successfully.','103.231.216.206','2015-08-14 08:24:00'),(147,2,'user','site.masters.company_save','Created Company successfully.','103.231.216.206','2015-08-14 08:29:15'),(148,2,'user','site.masters.company_save','Created Company successfully.','103.231.216.206','2015-08-14 08:29:35'),(149,2,'user','site.masters.permit_save','Created Permit successfully.','103.231.216.206','2015-08-14 08:30:22'),(150,2,'user','site.masters.permit_save','Created Permit successfully.','103.231.216.206','2015-08-14 08:30:56'),(151,2,'user','site.masters.family_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:31:13'),(152,2,'user','site.masters.family_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:31:19'),(153,2,'user','site.masters.family_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:31:25'),(154,2,'user','site.masters.family_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:31:32'),(155,2,'user','site.masters.product_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:31:48'),(156,2,'user','site.masters.product_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:31:57'),(157,2,'user','site.masters.product_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:32:08'),(158,2,'user','site.masters.product_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:32:17'),(159,2,'user','site.masters.product_save','Created Product Family successfully.','103.231.216.206','2015-08-14 08:32:32'),(160,2,'user','site.masters.variety_save','Created Product Variety Family successfully.','103.231.216.206','2015-08-14 08:33:35'),(161,2,'user','site.masters.variety_save','Created Product Variety Family successfully.','103.231.216.206','2015-08-14 08:33:55'),(162,2,'user','site.masters.variety_save','Created Product Variety Family successfully.','103.231.216.206','2015-08-14 08:34:06'),(163,2,'user','site.masters.variety_save','Created Product Variety Family successfully.','103.231.216.206','2015-08-14 08:34:17'),(164,2,'user','site.masters.variety_save','Created Product Variety Family successfully.','103.231.216.206','2015-08-14 08:34:27'),(165,2,'user','site.masters.variety_save','Created Product Variety Family successfully.','103.231.216.206','2015-08-14 08:34:37'),(166,2,'user','site.masters.size_save','Created Product Size Family successfully.','103.231.216.206','2015-08-14 08:35:11'),(167,2,'user','site.masters.size_save','Created Product Size Family successfully.','103.231.216.206','2015-08-14 08:35:22'),(168,2,'user','site.masters.size_save','Created Product Size Family successfully.','103.231.216.206','2015-08-14 08:35:32'),(169,2,'user','site.masters.size_save','Created Product Size Family successfully.','103.231.216.206','2015-08-14 08:35:42'),(170,2,'user','site.masters.size_save','Created Product Size Family successfully.','103.231.216.206','2015-08-14 08:35:55'),(171,2,'user','site.masters.size_save','Created Product Size Family successfully.','103.231.216.206','2015-08-14 08:36:05'),(172,2,'user','site.masters.size_save','Created Product Size Family successfully.','103.231.216.206','2015-08-14 08:36:15'),(173,2,'user','site.masters.grade_save','Created Product Grade Family successfully.','103.231.216.206','2015-08-14 08:36:38'),(174,2,'user','site.masters.grade_save','Created Product Grade Family successfully.','103.231.216.206','2015-08-14 08:36:52'),(175,2,'user','site.masters.grade_save','Created Product Grade Family successfully.','103.231.216.206','2015-08-14 08:37:10'),(176,2,'user','site.masters.grade_save','Created Product Grade Family successfully.','103.231.216.206','2015-08-14 08:37:28'),(177,2,'user','site.masters.vendor_save','Created Vendor successfully.','103.231.216.206','2015-08-14 08:39:37'),(178,2,'user','site.masters.vendor_save','Created Vendor successfully.','103.231.216.206','2015-08-14 08:40:47'),(179,2,'user','site.masters.liner_save','Created Liner successfully.','103.231.216.206','2015-08-14 08:41:01'),(180,2,'user','site.masters.liner_save','Created Liner successfully.','103.231.216.206','2015-08-14 08:41:12'),(181,2,'user','site.masters.liner_save','Created Liner successfully.','103.231.216.206','2015-08-14 08:41:22'),(182,2,'user','site.masters.liner_save','Created Liner successfully.','103.231.216.206','2015-08-14 08:41:36'),(183,2,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','103.231.216.206','2015-08-14 08:46:18'),(184,2,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','103.231.216.206','2015-08-14 08:54:53'),(185,2,'user','site.invoice.create','Created Invoice successfully.','103.231.216.206','2015-08-14 08:57:41'),(186,2,'user','site.invoice.create','Created Invoice successfully.','103.231.216.206','2015-08-14 08:59:14'),(187,2,'user','site.user.update','Updated User successfully.','103.231.216.206','2015-08-14 09:00:53'),(188,2,'user','site.user.update','Updated User successfully.','103.231.216.206','2015-08-14 09:03:28'),(189,2,'user','site.billlading.create','Created BillLading successfully.','103.231.216.206','2015-08-14 09:04:19'),(190,2,'user','site.billlading.create','Created BillLading successfully.','103.231.216.206','2015-08-14 09:05:49'),(191,2,'user','site.pytoorigin.create','Created PytoOrigin successfully.','103.231.216.206','2015-08-14 09:06:41'),(192,2,'user','site.pytoorigin.create','Created PytoOrigin successfully.','103.231.216.206','2015-08-14 09:07:05'),(193,2,'user','site.default.logout','asas logged-out successfully.','103.231.216.206','2015-08-14 09:10:19'),(194,2,'user','site.default.login','admin logged-in successfully.','103.231.216.206','2015-08-14 09:10:25'),(195,2,'user','site.default.logout','Chandra Mohan logged-out successfully.','103.231.216.206','2015-08-14 09:10:28'),(196,2,'user','site.default.login','admin logged-in successfully.','106.208.226.112','2015-08-14 11:57:39'),(197,2,'user','site.masters.size_save','Created Product Size Family successfully.','106.208.226.112','2015-08-14 12:04:16'),(198,2,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','106.208.226.112','2015-08-14 12:07:06'),(199,2,'user','site.user.update','Updated User successfully.','106.208.226.112','2015-08-14 12:13:45'),(200,2,'user','site.user.update','Updated User successfully.','106.208.135.191','2015-08-14 13:10:22'),(201,2,'user','site.default.logout','Chandra Mohan logged-out successfully.','106.208.135.191','2015-08-14 13:10:35'),(202,2,'user','site.default.login','admin logged-in successfully.','106.208.135.191','2015-08-14 13:10:42'),(203,4,'user','site.user.update','Updated User successfully.','127.0.0.1','2015-08-18 12:18:51'),(204,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-08-18 12:42:57'),(205,4,'user','site.masters.vendor_save','Updated Vendor successfully.','127.0.0.1','2015-08-18 13:25:51'),(206,4,'user','site.masters.vendor_save','Updated Vendor successfully.','127.0.0.1','2015-08-18 13:27:54'),(207,4,'user','site.masters.vendor_save','Updated Vendor successfully.','127.0.0.1','2015-08-18 13:28:53'),(208,4,'user','site.masters.vendor_save','Updated Vendor successfully.','127.0.0.1','2015-08-18 15:56:33'),(209,4,'user','site.masters.vendor_save','Updated Vendor successfully.','127.0.0.1','2015-08-18 15:59:55'),(210,4,'user','site.invoice.create','Created Invoice successfully.','127.0.0.1','2015-08-18 16:48:01'),(211,4,'user','site.masters.family_save','Updated Product Family successfully.','127.0.0.1','2015-08-19 15:56:17'),(212,4,'user','site.masters.company_save','Updated Company successfully.','127.0.0.1','2015-08-19 15:57:29'),(213,4,'user','site.masters.product_save','Created Product Family successfully.','127.0.0.1','2015-08-19 16:27:19'),(214,4,'user','site.payment.create','Created Payment successfully.','127.0.0.1','2015-08-28 13:44:29'),(215,4,'user','site.payment.create','Created Payment successfully.','127.0.0.1','2015-08-28 13:45:55'),(216,4,'user','site.payment.create','Created Payment successfully.','127.0.0.1','2015-08-28 14:03:19'),(217,4,'user','site.payment.create','Created Payment successfully.','127.0.0.1','2015-08-28 15:37:47'),(218,2,'user','site.purchaseorder.create','PurchaseOrder Saved successfully.','::1','2015-08-28 18:30:24'),(219,2,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-29 09:48:16'),(220,2,'user','site.purchaseorder.create','PurchaseOrder Saved successfully.','::1','2015-08-29 09:54:18'),(221,2,'user','site.purchaseorder.update','Updated PurchaseOrder successfully.','127.0.0.1','2015-08-29 15:42:41'),(222,2,'user','site.purchaseorder.create','PurchaseOrder Saved successfully.','127.0.0.1','2015-08-29 15:43:20'),(223,2,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','127.0.0.1','2015-08-29 15:43:38'),(224,2,'user','site.invoice.update','Updated Invoice successfully.','127.0.0.1','2015-08-29 15:47:27'),(225,2,'user','site.invoice.update','Updated Invoice successfully.','127.0.0.1','2015-08-29 15:48:42'),(226,2,'user','site.billlading.create','Created BillLading successfully.','127.0.0.1','2015-08-29 16:01:12'),(227,2,'user','site.billlading.create','Created BillLading successfully.','127.0.0.1','2015-08-29 16:04:04'),(228,2,'user','site.default.logout','Chandra Mohan logged-out successfully.','127.0.0.1','2015-09-09 16:13:21'),(229,4,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','127.0.0.1','2015-09-11 15:23:19'),(230,4,'user','site.expenses.create','Created Expenses successfully.','127.0.0.1','2015-09-11 15:32:39'),(231,4,'user','site.purchaseexpenses.create','Created PurchaseExpenses successfully.','127.0.0.1','2015-09-11 16:57:58'),(232,4,'user','site.purchaseexpenses.update','Updated PurchaseExpenses successfully.','127.0.0.1','2015-09-11 17:11:46'),(233,4,'user','site.salesexpenses.create','Created SalesExpenses successfully.','127.0.0.1','2015-09-11 18:15:50'),(234,4,'user','site.salesexpenses.update','Updated SalesExpenses successfully.','127.0.0.1','2015-09-11 18:19:40'),(235,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-09-16 10:48:01'),(236,2,'user','site.masters.exp_type_save','Created Expense Type successfully.','127.0.0.1','2015-09-16 17:11:46'),(237,2,'user','site.masters.exp_type_save','Updated Expense Type successfully.','127.0.0.1','2015-09-16 17:14:48'),(238,2,'user','site.masters.exp_type_save','Updated Expense Type successfully.','127.0.0.1','2015-09-16 17:15:03'),(239,2,'user','site.masters.exp_subtype_save','Created Expense Sub-Type successfully.','127.0.0.1','2015-09-16 17:21:36'),(240,2,'user','site.masters.exp_subtype_save','Updated Expense Sub-Type successfully.','127.0.0.1','2015-09-16 17:24:17'),(241,2,'user','site.masters.exp_type_delete','Deleted Expense Type successfully.','127.0.0.1','2015-09-16 17:27:13'),(242,2,'user','site.masters.exp_subtype_delete','Deleted Expense Sub-Type successfully.','127.0.0.1','2015-09-16 17:27:18'),(243,2,'user','site.masters.exp_subtype_save','Created Expense Sub-Type successfully.','127.0.0.1','2015-09-16 17:27:28'),(244,2,'user','site.masters.exp_type_save','Created Expense Type successfully.','127.0.0.1','2015-09-16 17:27:35'),(245,2,'user','site.masters.exp_type_save','Created Expense Type successfully.','127.0.0.1','2015-09-17 12:51:20'),(246,2,'user','site.masters.exp_subtype_save','Created Expense Sub-Type successfully.','127.0.0.1','2015-09-17 12:51:32'),(247,2,'user','site.expense.create','Created Expense successfully.','127.0.0.1','2015-09-17 13:00:15'),(248,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2015-09-17 13:12:48'),(249,2,'user','site.expense.delete','Deleted Expense successfully.','127.0.0.1','2015-09-17 13:29:20'),(250,2,'user','site.expense.create','Created Expense successfully.','127.0.0.1','2015-09-17 13:29:33'),(251,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2015-09-17 13:31:19'),(252,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2015-09-17 13:40:51'),(253,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2015-09-17 14:00:45'),(254,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2015-09-17 14:01:02'),(255,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-09-23 11:34:29'),(256,2,'user','site.default.logout','Chandra Mohan logged-out successfully.','127.0.0.1','2015-09-25 18:31:16'),(257,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-09-25 18:31:20'),(258,2,'user','site.masters.vendor_save','Updated Vendor successfully.','127.0.0.1','2015-10-07 10:36:33'),(259,2,'user','site.billlading.create','Created BillLading successfully.','127.0.0.1','2015-10-07 12:17:26'),(260,2,'user','site.payment.create','Created Payment successfully.','127.0.0.1','2015-10-07 15:24:41'),(261,2,'user','site.masters.permit_save','Created Permit successfully.','127.0.0.1','2015-10-07 16:19:34'),(262,2,'user','site.payment.create','Created Payment successfully.','127.0.0.1','2015-10-07 16:22:11'),(263,2,'user','site.default.login','admin logged-in successfully.','::1','2015-10-12 11:54:19'),(264,2,'user','site.default.login','admin logged-in successfully.','::1','2015-10-12 18:04:32'),(265,2,'user','site.user.update','Updated User successfully.','127.0.0.1','2015-10-13 11:20:46'),(266,2,'user','site.user.update','Updated User successfully.','127.0.0.1','2015-10-13 11:20:55'),(267,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-10-13 12:29:26'),(268,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-10-13 12:34:19'),(269,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-10-13 12:39:08'),(270,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-10-13 12:45:01'),(271,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-10-13 13:07:12'),(272,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-10-13 13:07:31'),(273,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-10-13 13:16:38'),(274,2,'user','site.billentry.update','Updated BillEntry successfully.','127.0.0.1','2015-10-13 13:19:37'),(275,2,'user','site.billentry.delete','Deleted BillEntry successfully.','127.0.0.1','2015-10-13 13:19:44'),(276,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-10-13 13:20:07'),(277,2,'user','site.billentry.delete','Deleted BillEntry successfully.','127.0.0.1','2015-10-13 13:20:15'),(278,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-10-29 16:43:24'),(279,2,'user','site.purchaseorder.create','PurchaseOrder Saved successfully.','127.0.0.1','2015-11-06 11:08:32'),(280,2,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','127.0.0.1','2015-11-06 11:09:06'),(281,2,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','127.0.0.1','2015-11-06 11:10:40'),(282,2,'user','site.billentry.create','Created BillEntry successfully.','127.0.0.1','2015-11-06 11:13:20'),(283,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-12-21 11:06:24'),(284,2,'user','site.payment.create','Created Payment successfully.','127.0.0.1','2015-12-26 12:07:10'),(285,2,'user','site.invoice.update','Invoice Saved successfully.','127.0.0.1','2016-01-04 13:59:38'),(286,2,'user','site.invoice.update','Updated Invoice successfully.','127.0.0.1','2016-01-04 14:00:17'),(287,2,'user','site.invoice.update','Updated Invoice successfully.','127.0.0.1','2016-01-04 14:00:42'),(288,2,'user','site.invoice.update','Updated Invoice successfully.','127.0.0.1','2016-01-04 14:01:32'),(289,2,'user','site.invoice.update','Updated Invoice successfully.','127.0.0.1','2016-01-04 14:02:29'),(290,2,'user','site.invoice.update','Updated Invoice successfully.','127.0.0.1','2016-01-04 16:01:10'),(291,2,'user','site.invoice.create','Invoice Saved successfully.','127.0.0.1','2016-01-04 16:10:04'),(292,2,'user','site.invoice.create','Created Invoice successfully.','127.0.0.1','2016-01-04 16:10:09'),(293,2,'user','site.invoice.create','Invoice Saved successfully.','127.0.0.1','2016-01-04 16:14:00'),(294,2,'user','site.payment.create','Created Payment successfully.','127.0.0.1','2016-01-04 16:28:04'),(295,2,'user','site.expense.create','Created Expense successfully.','127.0.0.1','2016-01-04 16:32:33'),(296,2,'user','site.billlading.update','Updated BillLading successfully.','127.0.0.1','2016-01-04 19:23:25'),(297,2,'user','site.billlading.update','Updated BillLading successfully.','127.0.0.1','2016-01-04 19:24:15'),(298,2,'user','site.billlading.update','Updated BillLading successfully.','127.0.0.1','2016-01-04 19:24:25'),(299,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 11:05:56'),(300,2,'user','site.expense.create','Created Expense successfully.','127.0.0.1','2016-01-05 12:28:29'),(301,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:44:57'),(302,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:47:42'),(303,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:48:01'),(304,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:49:02'),(305,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:49:21'),(306,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:49:39'),(307,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:51:06'),(308,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:51:25'),(309,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:55:05'),(310,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:55:22'),(311,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:56:35'),(312,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 12:58:34'),(313,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 13:13:25'),(314,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 13:45:35'),(315,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 13:46:29'),(316,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 13:46:53'),(317,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 13:56:19'),(318,2,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 13:57:03'),(319,0,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 14:00:55'),(320,0,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 14:01:24'),(321,0,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 14:03:31'),(322,0,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 14:04:30'),(323,0,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 15:06:02'),(324,0,'user','site.expense.update','Updated Expense successfully.','127.0.0.1','2016-01-05 15:13:28');

/*Table structure for table `tbl_bill_entry` */

DROP TABLE IF EXISTS `tbl_bill_entry`;

CREATE TABLE `tbl_bill_entry` (
  `bt_id` int(11) NOT NULL AUTO_INCREMENT,
  `bl_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `bt_file` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`bt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bill_entry` */

insert  into `tbl_bill_entry`(`bt_id`,`bl_id`,`inv_id`,`bt_file`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,12345,1,'/billentry/3757d424a05558e15cca3428d83b8d0e.xls','2015-11-06 11:13:20',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_bill_lading` */

DROP TABLE IF EXISTS `tbl_bill_lading`;

CREATE TABLE `tbl_bill_lading` (
  `bl_id` int(11) NOT NULL AUTO_INCREMENT,
  `bl_company_id` int(11) NOT NULL,
  `bl_vendor_id` int(11) NOT NULL,
  `bl_po_id` int(11) NOT NULL,
  `bl_invoice_id` int(11) NOT NULL,
  `bl_number` varchar(100) NOT NULL,
  `bl_issue_date` date DEFAULT NULL,
  `bl_issue_place` varchar(100) DEFAULT NULL,
  `bl_load_port` varchar(100) DEFAULT NULL,
  `bl_discharge_port` varchar(100) DEFAULT NULL,
  `bl_vessal_name` varchar(100) DEFAULT NULL,
  `bl_shipped_date` date DEFAULT NULL,
  `bl_liner_id` int(11) DEFAULT NULL,
  `bl_container_count` decimal(10,2) DEFAULT NULL,
  `bl_free_days` smallint(6) DEFAULT NULL,
  `bl_frieght_paid` enum('Y','N') DEFAULT 'N',
  `bl_documents` text,
  `bl_remarks` text,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`bl_id`),
  KEY `FK_tbl_bill_lading_company` (`bl_company_id`),
  KEY `FK_tbl_bill_lading_vendor` (`bl_vendor_id`),
  KEY `FK_tbl_bill_lading_po` (`bl_po_id`),
  KEY `FK_tbl_bill_lading_invoice` (`bl_invoice_id`),
  KEY `FK_tbl_bill_lading_liner` (`bl_liner_id`),
  CONSTRAINT `FK_tbl_bill_lading_company` FOREIGN KEY (`bl_company_id`) REFERENCES `tbl_company` (`company_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_bill_lading_invoice` FOREIGN KEY (`bl_invoice_id`) REFERENCES `tbl_invoice` (`invoice_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_bill_lading_liner` FOREIGN KEY (`bl_liner_id`) REFERENCES `tbl_liner` (`liner_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_bill_lading_po` FOREIGN KEY (`bl_po_id`) REFERENCES `tbl_purchase_order` (`po_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_bill_lading_vendor` FOREIGN KEY (`bl_vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bill_lading` */

insert  into `tbl_bill_lading`(`bl_id`,`bl_company_id`,`bl_vendor_id`,`bl_po_id`,`bl_invoice_id`,`bl_number`,`bl_issue_date`,`bl_issue_place`,`bl_load_port`,`bl_discharge_port`,`bl_vessal_name`,`bl_shipped_date`,`bl_liner_id`,`bl_container_count`,`bl_free_days`,`bl_frieght_paid`,`bl_documents`,`bl_remarks`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,1,1,1,1,'12345','2015-08-15','Chennai','121216','32152136','Vessel','2015-08-27',1,NULL,8,'N',NULL,'','1','2015-08-14 09:04:19',0,'2016-01-04 19:23:25',2),(2,1,1,1,2,'12345','2015-08-29','Chennai','121216','32152136','Vessel','2015-08-28',4,NULL,15,'N',NULL,NULL,'1','2015-08-14 09:05:49',0,NULL,NULL),(3,1,1,1,1,'12345','2015-08-29','Madurai','965921','265266','26526','2015-08-29',2,NULL,10,'N',NULL,'Remarkssss','1','2015-08-29 16:01:12',0,NULL,NULL),(4,1,1,1,1,'12345','2015-08-29','Madurai','','265266','','1970-01-01',NULL,NULL,5,'N','/billlading/f7517a9ea643060bb60923f1f6d5a1fe.xls','asd asdasdasdsad','1','2015-08-29 16:04:03',0,NULL,NULL),(5,1,1,1,2,'12345','2015-10-07','8888','','','','1970-01-01',2,NULL,NULL,'N','/billlading/8e2ae2eb2298b877b25d8a1909c8ac1d.xls','','1','2015-10-07 12:17:26',0,'2016-01-04 19:24:25',2);

/*Table structure for table `tbl_company` */

DROP TABLE IF EXISTS `tbl_company`;

CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_company` */

insert  into `tbl_company`(`company_id`,`company_name`,`company_address`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'KRK & Co International Pvt Ltd','Anna Fruit Market Chennai 600107','1','2015-08-14 08:29:15',2,'2015-08-19 15:57:29',4),(2,'KRK & Sons International Pvt Ltd','Anna Fruit Market Chennai 600107','1','2015-08-14 08:29:35',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_country` */

DROP TABLE IF EXISTS `tbl_country`;

CREATE TABLE `tbl_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_country` */

insert  into `tbl_country`(`country_id`,`country_name`,`status`,`created_at`,`modified_at`) values (1,'India','1','2015-08-07 18:04:27','0000-00-00 00:00:00'),(2,'Jappan','1','2015-08-07 18:04:52','0000-00-00 00:00:00'),(3,'Singapor','1','2015-08-07 18:05:09','0000-00-00 00:00:00');

/*Table structure for table `tbl_expense` */

DROP TABLE IF EXISTS `tbl_expense`;

CREATE TABLE `tbl_expense` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_type_id` int(11) NOT NULL,
  `exp_subtype_id` int(11) NOT NULL,
  `exp_voucher` varchar(50) NOT NULL,
  `exp_pay_mode` varchar(50) NOT NULL,
  `exp_ref_no` varchar(50) NOT NULL,
  `exp_bank_name` varchar(50) NOT NULL,
  `exp_transaction_id` varchar(50) NOT NULL,
  `exp_remarks` text,
  `exp_paid_amount` decimal(10,2) NOT NULL,
  `exp_bol_no` int(11) NOT NULL,
  `exp_invoices` varchar(500) NOT NULL,
  `exp_containers` varchar(500) NOT NULL,
  `exp_agent_party` varchar(100) DEFAULT NULL,
  `exp_file` text,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`exp_id`),
  KEY `FK_tbl_expense_type` (`exp_type_id`),
  KEY `FK_tbl_expense_subtype` (`exp_subtype_id`),
  CONSTRAINT `FK_tbl_expense_subtype` FOREIGN KEY (`exp_subtype_id`) REFERENCES `tbl_expense_subtype` (`exp_subtype_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_expense_type` FOREIGN KEY (`exp_type_id`) REFERENCES `tbl_expense_type` (`exp_type_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_expense` */

insert  into `tbl_expense`(`exp_id`,`exp_type_id`,`exp_subtype_id`,`exp_voucher`,`exp_pay_mode`,`exp_ref_no`,`exp_bank_name`,`exp_transaction_id`,`exp_remarks`,`exp_paid_amount`,`exp_bol_no`,`exp_invoices`,`exp_containers`,`exp_agent_party`,`exp_file`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (2,2,2,'1232123','NEFT','515451451','SBI','57487515715','Remarks','5000.00',12345,'[\"12345\",\"1525\",\"111111111\"]','[\"987\",\"118418148\"]','','','1','2015-09-17 13:29:33',2,'2016-01-05 11:05:56',2),(3,2,2,'TEEE','test','tetet','test','test','asdsd','122.00',12345,'[\"12345\"]','[\"123\",\"456\"]','test','','1','2016-01-04 16:32:33',2,'2016-01-05 15:06:01',2),(4,2,2,'asdasd','asdasdas','dsadasd','dasdad','asdasdasd','','123213.00',12345,'[\"1525\"]','[\"60\"]','','{\"0\":\"\\/expense\\/e685ba6af7f0243d44ddb7dc3725aa03_statement.xls\",\"2\":\"\\/expense\\/dd3c781fc84a9a57ab507256772f39be_WorkImport(1).csv\"}','1','2016-01-05 12:28:29',2,'2016-01-05 15:13:28',2);

/*Table structure for table `tbl_expense_subtype` */

DROP TABLE IF EXISTS `tbl_expense_subtype`;

CREATE TABLE `tbl_expense_subtype` (
  `exp_subtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_type_id` int(11) NOT NULL,
  `exp_subtype_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`exp_subtype_id`),
  KEY `FK_tbl_expense_subtype_type` (`exp_type_id`),
  CONSTRAINT `FK_tbl_expense_subtype_type` FOREIGN KEY (`exp_type_id`) REFERENCES `tbl_expense_type` (`exp_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_expense_subtype` */

insert  into `tbl_expense_subtype`(`exp_subtype_id`,`exp_type_id`,`exp_subtype_name`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (2,2,'Sub type 1','1','2015-09-16 17:27:28',NULL,'0000-00-00 00:00:00',NULL),(3,3,'Sub type 2','1','2015-09-17 12:51:32',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_expense_type` */

DROP TABLE IF EXISTS `tbl_expense_type`;

CREATE TABLE `tbl_expense_type` (
  `exp_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_type_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`exp_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_expense_type` */

insert  into `tbl_expense_type`(`exp_type_id`,`exp_type_name`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (2,'Expense type 1','1','2015-09-16 17:27:35',NULL,'0000-00-00 00:00:00',NULL),(3,'Expense type 2','1','2015-09-17 12:51:19',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_invoice` */

DROP TABLE IF EXISTS `tbl_invoice`;

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `po_cur_status` tinyint(4) NOT NULL COMMENT '1=> Open, 2=> Partially Invoiced,3=> Fully Invoiced,4=>Rejected,5=>Cancelled,6=>Closed',
  `permit_no` varchar(100) NOT NULL,
  `bol_no` varchar(100) NOT NULL,
  `inv_no` varchar(100) NOT NULL,
  `vessel_name` varchar(100) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_file` varchar(255) DEFAULT NULL,
  `pkg_list_file` varchar(255) DEFAULT NULL,
  `inv_remarks` text,
  `inv_amount` decimal(10,2) DEFAULT NULL,
  `inv_eta_date` date DEFAULT NULL,
  `inv_onboard_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `FK_tbl_invoice_po` (`po_id`),
  KEY `FK_tbl_invoice_vendor` (`vendor_id`),
  KEY `FK_tbl_invoice_company` (`company_id`),
  CONSTRAINT `FK_tbl_invoice_company` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_po` FOREIGN KEY (`po_id`) REFERENCES `tbl_purchase_order` (`po_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_invoice` */

insert  into `tbl_invoice`(`invoice_id`,`vendor_id`,`company_id`,`po_id`,`po_cur_status`,`permit_no`,`bol_no`,`inv_no`,`vessel_name`,`inv_date`,`inv_file`,`pkg_list_file`,`inv_remarks`,`inv_amount`,`inv_eta_date`,`inv_onboard_date`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,1,1,1,2,'123456','12345','12345','Vessel','2015-09-05',NULL,NULL,'Test','1220.00',NULL,NULL,1,'2015-10-12 15:34:48',2,'2015-08-29 15:47:27',2),(2,1,1,1,2,'123456478','12345','12345','Vessel','2015-09-04',NULL,NULL,'Test','9856.00',NULL,NULL,1,'2015-10-12 15:34:52',2,'0000-00-00 00:00:00',2),(3,1,1,1,0,'959','12345','1525','','2015-09-01','/invoice/bd90c133039c32f94d104c5ba5912f13.xlsx','/invoice/599842ded7a58f5146428d549345ac2c.xlsx',NULL,'7200.00',NULL,NULL,1,'2015-10-12 15:34:56',4,'0000-00-00 00:00:00',NULL),(4,1,1,1,2,'23BC 387837','12345','111111111','','2015-08-11',NULL,NULL,'','20000.00',NULL,NULL,1,'2015-10-12 18:15:49',2,'0000-00-00 00:00:00',NULL),(5,2,2,6,2,'KLC938948494','898','112','','2015-08-21',NULL,NULL,'','1000.00','2015-08-21','2015-08-21',1,'2015-10-12 15:41:52',2,'2016-01-04 16:01:10',2),(6,2,1,6,2,'KLC938948494','898','112','','2015-08-19',NULL,NULL,'','0.00',NULL,NULL,1,'2015-11-06 11:12:19',2,'0000-00-00 00:00:00',NULL),(7,1,1,1,2,'23BC 387837','898','112','','2015-12-24',NULL,NULL,'','0.00',NULL,NULL,1,'2015-12-26 12:23:00',2,'0000-00-00 00:00:00',NULL),(8,1,1,1,2,'23BC 387837','898','112','','2015-12-24',NULL,NULL,'','0.00',NULL,NULL,1,'2015-12-26 12:23:41',2,'0000-00-00 00:00:00',NULL),(9,1,1,1,2,'23BC 387837','898','Awww','','2016-01-05',NULL,NULL,'','0.00','2016-01-12','2016-01-05',1,'2016-01-04 16:02:22',2,'0000-00-00 00:00:00',NULL),(10,1,1,1,2,'23BC 387837','898','Awww','','2016-01-05',NULL,NULL,'','0.00','2016-01-12','2016-01-05',1,'2016-01-04 16:03:52',2,'0000-00-00 00:00:00',NULL),(11,1,1,1,2,'23BC 387837','898','Awww','','2016-01-05',NULL,NULL,'','0.00','2016-01-12','2016-01-05',1,'2016-01-04 16:04:13',2,'0000-00-00 00:00:00',NULL),(12,1,1,1,2,'23BC 387837','898','Awww','','2016-01-05',NULL,NULL,'','0.00','2016-01-12','2016-01-05',1,'2016-01-04 16:08:29',2,'0000-00-00 00:00:00',NULL),(13,1,1,1,2,'23BC 387837','123321','AXXXX','','2016-01-05',NULL,NULL,'','0.00','2016-01-04','2016-01-11',1,'2016-01-04 16:10:09',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_invoice_items` */

DROP TABLE IF EXISTS `tbl_invoice_items`;

CREATE TABLE `tbl_invoice_items` (
  `inv_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_id` int(11) NOT NULL,
  `inv_det_prod_fmly_id` int(11) NOT NULL,
  `inv_det_product_id` int(11) NOT NULL,
  `inv_det_variety_id` int(11) NOT NULL,
  `inv_det_grade` int(11) NOT NULL,
  `inv_det_size` int(11) NOT NULL,
  `inv_det_cotton_qty` decimal(10,2) DEFAULT NULL,
  `inv_det_currency` varchar(100) DEFAULT NULL,
  `inv_det_price` decimal(10,2) DEFAULT NULL,
  `inv_det_net_amount` decimal(10,2) DEFAULT NULL,
  `inv_det_net_weight` decimal(10,2) DEFAULT NULL,
  `inv_det_gross_weight` decimal(10,2) DEFAULT NULL,
  `inv_det_ctnr_no` varchar(100) DEFAULT NULL,
  `is_delivered` enum('Y','N') NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`inv_det_id`),
  KEY `FK_tbl_invoice_items_prod_family` (`inv_det_prod_fmly_id`),
  KEY `FK_tbl_invoice_items_product` (`inv_det_product_id`),
  KEY `FK_tbl_invoice_items_product_variety` (`inv_det_variety_id`),
  KEY `FK_tbl_invoice_items_inv` (`inv_id`),
  KEY `FK_tbl_invoice_items_grade` (`inv_det_grade`),
  KEY `FK_tbl_invoice_items_size` (`inv_det_size`),
  CONSTRAINT `FK_tbl_invoice_items_grade` FOREIGN KEY (`inv_det_grade`) REFERENCES `tbl_product_grade` (`grade_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_inv` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_product` FOREIGN KEY (`inv_det_product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_product_variety` FOREIGN KEY (`inv_det_variety_id`) REFERENCES `tbl_product_variety` (`variety_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_prod_family` FOREIGN KEY (`inv_det_prod_fmly_id`) REFERENCES `tbl_product_family` (`pro_family_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_size` FOREIGN KEY (`inv_det_size`) REFERENCES `tbl_product_size` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_invoice_items` */

insert  into `tbl_invoice_items`(`inv_det_id`,`inv_id`,`inv_det_prod_fmly_id`,`inv_det_product_id`,`inv_det_variety_id`,`inv_det_grade`,`inv_det_size`,`inv_det_cotton_qty`,`inv_det_currency`,`inv_det_price`,`inv_det_net_amount`,`inv_det_net_weight`,`inv_det_gross_weight`,`inv_det_ctnr_no`,`is_delivered`,`created_at`,`created_by`,`modified_at`,`modified_by`,`status`) values (5,3,1,1,2,1,1,'60.00','INR (INR)','60.00','3600.00','60.00','60.00','60','N',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(6,3,1,1,2,2,2,'60.00','INR (INR)','60.00','3600.00','60.00','60.00','60','N',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(7,1,1,1,1,2,1,'10.00','USD ($)','10.00','100.00','100.00','80.00','987','N',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(8,1,1,1,1,1,2,'20.00','INR (INR)','56.00','1120.00','92.00','51.00','654','N',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(9,2,1,1,1,1,2,'56.00','USD ($)','88.00','4928.00','45.00','68.00','123','N',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(10,2,1,1,1,1,1,'56.00','USD ($)','88.00','4928.00','45.00','68.00','456','N',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(11,4,1,1,1,1,1,'100.00','INR (INR)','100.00','10000.00','100.00','68.00','118418148','N','2015-08-29 15:52:55','0000-00-00 00:00:00',NULL,NULL,'1'),(12,4,1,1,1,2,2,'100.00','INR (INR)','100.00','10000.00','100.00','68.00','118418148','N','2015-08-29 15:52:55','0000-00-00 00:00:00',NULL,NULL,'1'),(14,6,1,2,3,3,4,'10.00','INR (INR)','100.00',NULL,'100.00','100.00','5415','N','2015-11-06 11:12:19','0000-00-00 00:00:00',NULL,NULL,'1'),(15,6,1,1,1,1,1,'10.00','INR (INR)','100.00',NULL,'100.00','100.00','505515','Y','2015-11-06 11:12:19','0000-00-00 00:00:00',NULL,NULL,'1'),(16,7,1,1,1,2,1,'5.00','INR (INR)','5.00',NULL,'5.00','5.00','5','N','2015-12-26 12:23:00','0000-00-00 00:00:00',NULL,NULL,'1'),(21,5,1,1,1,2,11,'10.00','INR (INR)','100.00','1000.00','100.00','100.00','5415','N','2015-10-07 16:20:40','0000-00-00 00:00:00',NULL,NULL,'1'),(22,9,1,1,1,1,1,'50.00','INR (INR)','60.00',NULL,'10.00','10.00','5511215','N','2016-01-04 16:02:21','0000-00-00 00:00:00',NULL,NULL,'1'),(23,11,1,1,1,1,2,'50.00','INR (INR)','50.00',NULL,'0.00','0.00','','N','2016-01-04 16:04:13','0000-00-00 00:00:00',NULL,NULL,'1'),(24,12,1,2,3,3,4,'10.00','INR (INR)','0.00',NULL,'0.00','0.00','','N','2016-01-04 16:08:29','0000-00-00 00:00:00',NULL,NULL,'1'),(25,13,1,1,1,2,8,'60.00','INR (INR)','0.00',NULL,'0.00','0.00','','N','2016-01-04 16:10:08','0000-00-00 00:00:00',NULL,NULL,'1');

/*Table structure for table `tbl_liner` */

DROP TABLE IF EXISTS `tbl_liner`;

CREATE TABLE `tbl_liner` (
  `liner_id` int(11) NOT NULL AUTO_INCREMENT,
  `liner_code` varchar(100) NOT NULL,
  `liner_name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `no_of_free_days` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`liner_id`),
  KEY `FK_tbl_liner_country` (`country_id`),
  CONSTRAINT `FK_tbl_liner_country` FOREIGN KEY (`country_id`) REFERENCES `tbl_country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_liner` */

insert  into `tbl_liner`(`liner_id`,`liner_code`,`liner_name`,`country_id`,`no_of_free_days`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'LC0001','Hundai',1,8,'1','2015-08-14 08:41:01',2,'0000-00-00 00:00:00',NULL),(2,'LC0002','Global',1,12,'1','2015-08-14 08:41:12',2,'0000-00-00 00:00:00',NULL),(3,'LC0003','FastGoods',2,2,'1','2015-08-14 08:41:22',2,'0000-00-00 00:00:00',NULL),(4,'LC0004','WANHAI',3,25,'1','2015-08-14 08:41:36',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_payment` */

DROP TABLE IF EXISTS `tbl_payment`;

CREATE TABLE `tbl_payment` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `pay_type` varchar(25) NOT NULL,
  `po_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `invoice_amount` decimal(10,2) DEFAULT NULL,
  `pay_amount` decimal(10,2) NOT NULL,
  `pay_deal_id` varchar(100) NOT NULL,
  `invoice_currency` varchar(30) NOT NULL,
  `pay_inr_rate` decimal(10,2) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_inr_amount` float DEFAULT NULL,
  `pay_mode` varchar(50) NOT NULL,
  `pay_ref_info` varchar(100) DEFAULT NULL,
  `pay_transaction_id` varchar(50) DEFAULT NULL,
  `pay_transaction_date` date DEFAULT NULL,
  `pay_bank_name` varchar(50) DEFAULT NULL,
  `pay_remarks` text,
  `pay_shift_advise` varchar(255) DEFAULT NULL,
  `pay_debit_advise` varchar(255) DEFAULT NULL,
  `pay_other_doc` varchar(255) DEFAULT NULL,
  `pay_deal_id_copy` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `FK_tbl_payment_vendor` (`vendor_id`),
  KEY `FK_tbl_payment_po` (`po_id`),
  KEY `FK_tbl_payment_invoice` (`invoice_id`),
  CONSTRAINT `FK_tbl_payment_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `tbl_invoice` (`invoice_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_payment_po` FOREIGN KEY (`po_id`) REFERENCES `tbl_purchase_order` (`po_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_payment_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_payment` */

insert  into `tbl_payment`(`pay_id`,`vendor_id`,`pay_type`,`po_id`,`invoice_id`,`invoice_amount`,`pay_amount`,`pay_deal_id`,`invoice_currency`,`pay_inr_rate`,`pay_date`,`pay_inr_amount`,`pay_mode`,`pay_ref_info`,`pay_transaction_id`,`pay_transaction_date`,`pay_bank_name`,`pay_remarks`,`pay_shift_advise`,`pay_debit_advise`,`pay_other_doc`,`pay_deal_id_copy`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,1,'Advance',1,1,'1220.00','100.00','5154515','','52.00','2015-08-21',5200,'RTGS','','',NULL,'','',NULL,NULL,NULL,NULL,'2015-10-07 15:24:41','0000-00-00 00:00:00',NULL,NULL),(2,2,'DP',6,5,'1000.00','10.00','115451','','10.00','2015-09-22',100,'RTGS','','',NULL,'','',NULL,NULL,NULL,NULL,'2015-10-07 16:22:11','0000-00-00 00:00:00',NULL,NULL),(3,1,'DP',1,2,'9856.00','80.00','a12323','','96.00','2015-12-23',7680,'RTGS','','',NULL,'','',NULL,NULL,NULL,NULL,'2015-12-26 12:07:10','0000-00-00 00:00:00',NULL,NULL),(4,1,'Advance',1,1,'1220.00','10.00','123231','','10.00','2016-01-20',NULL,'Tes','','','2016-01-04','','',NULL,NULL,NULL,NULL,'2016-01-04 16:28:04','0000-00-00 00:00:00',NULL,NULL);

/*Table structure for table `tbl_permit` */

DROP TABLE IF EXISTS `tbl_permit`;

CREATE TABLE `tbl_permit` (
  `permit_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `permit_no` varchar(100) NOT NULL,
  `doissue` date NOT NULL,
  `valupto` date NOT NULL,
  `permit_regno` varchar(100) DEFAULT NULL,
  `permit_poissue` varchar(100) DEFAULT NULL,
  `permit_file` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`permit_id`),
  KEY `FK_tbl_permit_company` (`company_id`),
  KEY `FK_tbl_permit_vendor` (`vendor_id`),
  CONSTRAINT `FK_tbl_permit_company` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_permit_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permit` */

insert  into `tbl_permit`(`permit_id`,`company_id`,`vendor_id`,`permit_no`,`doissue`,`valupto`,`permit_regno`,`permit_poissue`,`permit_file`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,1,1,'23BC 387837','2015-04-06','2016-02-26','UOC938948494','CHENNAI',NULL,'1','2015-08-28 16:07:38',2,'0000-00-00 00:00:00',NULL),(2,2,1,'79UC 939849','2015-08-12','2016-06-23','KI93839484949','CHENNAI',NULL,'1','2015-08-28 16:07:41',2,'0000-00-00 00:00:00',NULL),(3,2,2,'KLC938948494','2015-10-09','2019-11-27','','',NULL,'1','2015-10-07 16:19:34',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_product` */

DROP TABLE IF EXISTS `tbl_product`;

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(100) NOT NULL,
  `pro_family_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`product_id`),
  KEY `FK_tbl_product_family` (`pro_family_id`),
  CONSTRAINT `FK_tbl_product_family` FOREIGN KEY (`pro_family_id`) REFERENCES `tbl_product_family` (`pro_family_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product` */

insert  into `tbl_product`(`product_id`,`product_code`,`pro_family_id`,`pro_name`,`status`,`created_by`,`created_at`,`modified_by`,`modified_at`) values (1,'P001',1,'Apple','1',2,'2015-08-14 08:31:48',NULL,'0000-00-00 00:00:00'),(2,'P002',1,'Orange','1',2,'2015-08-14 08:31:57',NULL,'0000-00-00 00:00:00'),(3,'P003',1,'grape','1',2,'2015-08-14 08:32:08',NULL,'0000-00-00 00:00:00'),(4,'P004',2,'Onion','1',2,'2015-08-14 08:32:17',NULL,'0000-00-00 00:00:00'),(5,'P005',2,'Tomoto','1',2,'2015-08-14 08:32:32',NULL,'0000-00-00 00:00:00'),(6,'P006',1,'Banana','1',4,'2015-08-19 16:27:19',NULL,'0000-00-00 00:00:00');

/*Table structure for table `tbl_product_family` */

DROP TABLE IF EXISTS `tbl_product_family`;

CREATE TABLE `tbl_product_family` (
  `pro_family_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_family_code` varchar(100) NOT NULL,
  `pro_family_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pro_family_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_family` */

insert  into `tbl_product_family`(`pro_family_id`,`pro_family_code`,`pro_family_name`,`status`,`created_by`,`created_at`,`modified_by`,`modified_at`) values (1,'PF0001','Fresh Fruits','1',2,'2015-08-14 08:31:13',4,'2015-08-19 15:56:17'),(2,'PF0002','Fresh Vegitables','1',2,'2015-08-14 08:31:19',NULL,'0000-00-00 00:00:00'),(3,'PF0003','Fresh Flowers','1',2,'2015-08-14 08:31:25',NULL,'0000-00-00 00:00:00'),(4,'PF0004','Toys','1',2,'2015-08-14 08:31:32',NULL,'0000-00-00 00:00:00');

/*Table structure for table `tbl_product_grade` */

DROP TABLE IF EXISTS `tbl_product_grade`;

CREATE TABLE `tbl_product_grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade_code` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `grade_short_name` varchar(255) NOT NULL,
  `grade_long_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`grade_id`),
  KEY `FK_tbl_product_grade_product` (`product_id`),
  CONSTRAINT `FK_tbl_product_grade_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_grade` */

insert  into `tbl_product_grade`(`grade_id`,`grade_code`,`product_id`,`grade_short_name`,`grade_long_name`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'G001',1,'P','Permium','1','2015-08-14 08:36:38',2,'0000-00-00 00:00:00',NULL),(2,'G002',1,'I','1st Class','1','2015-08-14 08:36:52',2,'0000-00-00 00:00:00',NULL),(3,'G003',2,'I','No 1','1','2015-08-14 08:37:10',2,'0000-00-00 00:00:00',NULL),(4,'G004',4,'I','No One','1','2015-08-14 08:37:28',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_product_size` */

DROP TABLE IF EXISTS `tbl_product_size`;

CREATE TABLE `tbl_product_size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `size_code` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`size_id`),
  KEY `FK_tbl_product_size_product` (`product_id`),
  CONSTRAINT `FK_tbl_product_size_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_size` */

insert  into `tbl_product_size`(`size_id`,`size_code`,`product_id`,`size_name`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'S001',1,'100','1','2015-08-14 08:35:11',2,'0000-00-00 00:00:00',NULL),(2,'S002',1,'125','1','2015-08-14 08:35:22',2,'0000-00-00 00:00:00',NULL),(3,'S003',2,'80','1','2015-08-14 08:35:32',2,'0000-00-00 00:00:00',NULL),(4,'S004',2,'100','1','2015-08-14 08:35:42',2,'0000-00-00 00:00:00',NULL),(5,'S005',4,' 	1','1','2015-08-14 08:35:55',2,'0000-00-00 00:00:00',NULL),(6,'S006',4,'2','1','2015-08-14 08:36:05',2,'0000-00-00 00:00:00',NULL),(7,'S007',5,'10KG','1','2015-08-14 08:36:15',2,'0000-00-00 00:00:00',NULL),(8,'S008',1,'130','1','2015-08-14 12:04:16',2,'0000-00-00 00:00:00',NULL),(11,'S009',1,'135','1','2015-09-25 18:39:40',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_product_variety` */

DROP TABLE IF EXISTS `tbl_product_variety`;

CREATE TABLE `tbl_product_variety` (
  `variety_id` int(11) NOT NULL AUTO_INCREMENT,
  `variety_code` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variety_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`variety_id`),
  KEY `FK_tbl_product_variety_product` (`product_id`),
  CONSTRAINT `FK_tbl_product_variety_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_variety` */

insert  into `tbl_product_variety`(`variety_id`,`variety_code`,`product_id`,`variety_name`,`status`,`created_by`,`created_at`,`modified_by`,`modified_at`) values (1,'V001',1,'Washington','1',2,'2015-08-14 08:33:35',NULL,'0000-00-00 00:00:00'),(2,'V002',1,'Fuiji','1',2,'2015-08-14 08:33:55',NULL,'0000-00-00 00:00:00'),(3,'V003',2,'Australia','1',2,'2015-08-14 08:34:06',NULL,'0000-00-00 00:00:00'),(4,'V004',2,'Egypt','1',2,'2015-08-14 08:34:17',NULL,'0000-00-00 00:00:00'),(5,'V005',4,'China Onion','1',2,'2015-08-14 08:34:27',NULL,'0000-00-00 00:00:00'),(6,'V006',5,'Japan Tomoto','1',2,'2015-08-14 08:34:37',NULL,'0000-00-00 00:00:00');

/*Table structure for table `tbl_purchase_expenses` */

DROP TABLE IF EXISTS `tbl_purchase_expenses`;

CREATE TABLE `tbl_purchase_expenses` (
  `pur_exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `pur_exp_date` date NOT NULL,
  `pur_exp_amount` decimal(10,2) NOT NULL,
  `pur_exp_remarks` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`pur_exp_id`),
  KEY `FK_tbl_purchase_expenses` (`po_id`),
  CONSTRAINT `FK_tbl_purchase_expenses` FOREIGN KEY (`po_id`) REFERENCES `tbl_purchase_order` (`po_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_expenses` */

insert  into `tbl_purchase_expenses`(`pur_exp_id`,`po_id`,`pur_exp_date`,`pur_exp_amount`,`pur_exp_remarks`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,2,'2015-09-11','500.00','test','2015-09-11 16:57:58',0,'2015-09-11 17:11:46',4);

/*Table structure for table `tbl_purchase_order` */

DROP TABLE IF EXISTS `tbl_purchase_order`;

CREATE TABLE `tbl_purchase_order` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_code` varchar(100) NOT NULL,
  `po_date` date NOT NULL,
  `po_company_id` int(11) NOT NULL,
  `po_vendor_id` int(11) NOT NULL,
  `po_liner_id` int(11) DEFAULT NULL,
  `sent_vendor` enum('0','1') NOT NULL DEFAULT '0',
  `po_remarks` text,
  `status` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1' COMMENT '1=> Open, 2=> Partially Invoiced,3=> Fully Invoiced,4=>Rejected,5=>Cancelled,6=>Closed',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_id`),
  KEY `FK_tbl_purchase_order_company` (`po_company_id`),
  KEY `FK_tbl_purchase_order_vendor` (`po_vendor_id`),
  KEY `FK_tbl_purchase_order_liner` (`po_liner_id`),
  CONSTRAINT `FK_tbl_purchase_order_company` FOREIGN KEY (`po_company_id`) REFERENCES `tbl_company` (`company_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_purchase_order_liner` FOREIGN KEY (`po_liner_id`) REFERENCES `tbl_liner` (`liner_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_purchase_order_vendor` FOREIGN KEY (`po_vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_order` */

insert  into `tbl_purchase_order`(`po_id`,`purchase_order_code`,`po_date`,`po_company_id`,`po_vendor_id`,`po_liner_id`,`sent_vendor`,`po_remarks`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'PO0000000000001','2015-08-13',1,1,1,'0',NULL,'2','2015-08-14 08:46:18',0,NULL,NULL),(2,'PO0000000000002','2015-08-29',1,1,3,'0',NULL,'4','2015-08-14 08:54:53',0,NULL,NULL),(3,'PO0000000000003','2015-08-14',1,1,1,'0',NULL,'1','2015-08-14 12:07:06',0,NULL,NULL),(4,'FY2016_15_19_08_PO4','2015-08-19',1,1,NULL,'0','Tesaas dasd','1','2015-08-29 09:48:15',2,'2015-08-29 15:42:40',2),(5,'FY2016_15_01_08_PO5','2015-08-01',1,1,NULL,'0','Test','2','2015-08-29 15:43:38',2,NULL,NULL),(6,'FY2016_15_24_09_PO6','2015-09-24',1,2,NULL,'0','test','2','2015-09-11 15:23:19',4,NULL,NULL),(7,'FY2016_15_17_11_PO7','2015-11-17',1,1,NULL,'0','','3','2015-11-06 11:09:06',2,NULL,NULL),(8,'FY2016_15_06_11_PO8','2015-11-06',1,2,NULL,'0','','6','2015-11-06 11:10:40',2,NULL,NULL);

/*Table structure for table `tbl_purchase_order_details` */

DROP TABLE IF EXISTS `tbl_purchase_order_details`;

CREATE TABLE `tbl_purchase_order_details` (
  `po_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `po_det_prod_fmly_id` int(11) NOT NULL,
  `po_det_product_id` int(11) NOT NULL,
  `po_det_variety_id` int(11) NOT NULL,
  `po_det_grade` varchar(500) NOT NULL,
  `po_det_size` varchar(500) NOT NULL,
  `po_det_net_weight` decimal(10,3) DEFAULT NULL,
  `po_det_container_qty` decimal(10,2) DEFAULT NULL,
  `po_det_cotton_qty` decimal(10,2) DEFAULT NULL,
  `po_det_currency` varchar(100) DEFAULT NULL COMMENT 'R->Rupee, D->Dollar',
  `po_det_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`po_det_id`),
  KEY `FK_tbl_purchase_order_details_po` (`po_id`),
  KEY `FK_tbl_purchase_order_details_prod_family` (`po_det_prod_fmly_id`),
  KEY `FK_tbl_purchase_order_details_product` (`po_det_product_id`),
  KEY `FK_tbl_purchase_order_details_product_variety` (`po_det_variety_id`),
  CONSTRAINT `FK_tbl_purchase_order_details_po` FOREIGN KEY (`po_id`) REFERENCES `tbl_purchase_order` (`po_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_purchase_order_details_product` FOREIGN KEY (`po_det_product_id`) REFERENCES `tbl_product` (`product_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_purchase_order_details_product_variety` FOREIGN KEY (`po_det_variety_id`) REFERENCES `tbl_product_variety` (`variety_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_purchase_order_details_prod_family` FOREIGN KEY (`po_det_prod_fmly_id`) REFERENCES `tbl_product_family` (`pro_family_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_order_details` */

insert  into `tbl_purchase_order_details`(`po_det_id`,`po_id`,`po_det_prod_fmly_id`,`po_det_product_id`,`po_det_variety_id`,`po_det_grade`,`po_det_size`,`po_det_net_weight`,`po_det_container_qty`,`po_det_cotton_qty`,`po_det_currency`,`po_det_price`,`created_at`,`created_by`,`modified_at`,`modified_by`,`status`) values (1,1,1,1,1,'[\"1\"]','[\"1\"]','100.000','10.00','20.00',NULL,'82.00',NULL,0,NULL,NULL,'1'),(2,1,1,1,1,'[\"2\"]','[\"2\"]','50.000','8.00','15.00',NULL,'57.00',NULL,0,NULL,NULL,'1'),(3,2,1,1,1,'[\"1\"]','[\"2\"]','10.000','80.00','24.00','USD ($)','22.00',NULL,0,NULL,NULL,'1'),(4,2,1,1,1,'[\"1\"]','[\"1\"]','10.000','28.00','35.00','INR (INR)','55.00',NULL,0,NULL,NULL,'1'),(5,3,1,1,1,'[\"1\",\"2\"]','[\"1\"]','20.000','1.00','1200.00','USD ($)','19.00',NULL,0,NULL,NULL,'1'),(6,3,1,1,1,'[\"2\"]','[\"2\"]','20.000','1.00','1200.00','USD ($)','19.00',NULL,0,NULL,NULL,'1'),(8,4,1,1,1,'[\"2\"]','[\"2\"]','11.000','80.00','544.00','INR (INR)','22.00','2015-08-29 09:48:16',0,NULL,NULL,'1'),(9,5,1,1,1,'[\"2\"]','[\"1\"]','10.000','80.00','24.00','INR (INR)','55.00','2015-08-29 15:43:38',0,NULL,NULL,'1'),(10,5,1,2,3,'[\"3\"]','[\"3\",\"4\"]','80.000','80.00','80.00','INR (INR)','580.00','2015-08-29 15:43:38',0,NULL,NULL,'1'),(11,6,1,1,1,'[\"1\",\"2\"]','[\"1\",\"2\",\"8\",\"11\"]','9.000','9.00','9.00','INR (INR)','9.00','2015-09-11 15:23:19',0,NULL,NULL,'1'),(12,7,1,2,3,'[\"3\"]','[\"3\",\"4\"]','60.000','3.00','5.00','INR (INR)','30.00','2015-11-06 11:09:06',NULL,'0000-00-00 00:00:00',NULL,'1'),(13,8,1,1,1,'[\"1\",\"2\"]','[\"1\",\"2\",\"8\",\"11\"]','10.000','10.00','10.00','INR (INR)','10.00','2015-11-06 11:10:40',NULL,'0000-00-00 00:00:00',NULL,'1');

/*Table structure for table `tbl_pyto_origin` */

DROP TABLE IF EXISTS `tbl_pyto_origin`;

CREATE TABLE `tbl_pyto_origin` (
  `pyto_id` int(11) NOT NULL AUTO_INCREMENT,
  `pyto_company_id` int(11) NOT NULL,
  `pyto_vendor_id` int(11) NOT NULL,
  `pyto_po_id` int(11) NOT NULL,
  `pyto_invoice_id` int(11) NOT NULL,
  `pyto_cert_no` varchar(150) DEFAULT NULL,
  `doinspection` date NOT NULL,
  `origin_cert_no` varchar(150) DEFAULT NULL,
  `pyto_file` varchar(255) DEFAULT NULL,
  `origin_file` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`pyto_id`),
  KEY `FK_tbl_pyto_origin_company` (`pyto_company_id`),
  KEY `FK_tbl_pyto_origin_vendor` (`pyto_vendor_id`),
  KEY `FK_tbl_pyto_origin_po` (`pyto_po_id`),
  KEY `FK_tbl_pyto_origin_invoice` (`pyto_invoice_id`),
  CONSTRAINT `FK_tbl_pyto_origin_company` FOREIGN KEY (`pyto_company_id`) REFERENCES `tbl_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_pyto_origin_invoice` FOREIGN KEY (`pyto_invoice_id`) REFERENCES `tbl_invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_pyto_origin_po` FOREIGN KEY (`pyto_po_id`) REFERENCES `tbl_purchase_order` (`po_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_pyto_origin_vendor` FOREIGN KEY (`pyto_vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pyto_origin` */

insert  into `tbl_pyto_origin`(`pyto_id`,`pyto_company_id`,`pyto_vendor_id`,`pyto_po_id`,`pyto_invoice_id`,`pyto_cert_no`,`doinspection`,`origin_cert_no`,`pyto_file`,`origin_file`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,1,1,1,1,'5656565656','2015-08-27','777878877788888',NULL,NULL,1,'2015-08-14 09:06:41',2,'0000-00-00 00:00:00',NULL),(2,1,1,1,2,'1549849844','2015-08-20','87979847',NULL,NULL,1,'2015-08-14 09:07:05',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_sales_expenses` */

DROP TABLE IF EXISTS `tbl_sales_expenses`;

CREATE TABLE `tbl_sales_expenses` (
  `sale_exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `sale_exp_date` date NOT NULL,
  `sale_exp_amount` decimal(10,2) NOT NULL,
  `sale_exp_remarks` text,
  `sales_exp_cust_name` varchar(100) DEFAULT NULL,
  `sales_exp_address` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`sale_exp_id`),
  KEY `FK_tbl_purchase_expenses` (`product_id`),
  CONSTRAINT `FK_tbl_sales_expenses_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sales_expenses` */

insert  into `tbl_sales_expenses`(`sale_exp_id`,`product_id`,`sale_exp_date`,`sale_exp_amount`,`sale_exp_remarks`,`sales_exp_cust_name`,`sales_exp_address`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,3,'2015-05-01','60.00','asd asd','etasd','asd asdad','2015-09-11 18:15:50',4,'2015-09-11 18:19:40',4);

/*Table structure for table `tbl_temp_session` */

DROP TABLE IF EXISTS `tbl_temp_session`;

CREATE TABLE `tbl_temp_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_name` varchar(255) NOT NULL,
  `session_key` varchar(100) NOT NULL,
  `session_data` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_temp_session_user` (`created_by`),
  CONSTRAINT `FK_tbl_temp_session_user` FOREIGN KEY (`created_by`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_temp_session` */

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `address` text,
  `dojoin` date DEFAULT NULL,
  `dobirtrh` date DEFAULT NULL,
  `authorize` longtext NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`user_id`,`username`,`password_hash`,`password_reset_token`,`first_name`,`last_name`,`email_id`,`mobile_no`,`address`,`dojoin`,`dobirtrh`,`authorize`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (2,'admin','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec',NULL,'Chandra Mohan','Jeyapal','c.mohanixm@gmail.com','9003111959','','2015-08-01','2015-02-02','{\"default\":\"1\",\"user\":\"1\",\"masters\":\"1\",\"processchart\":\"0\",\"purchaseorder\":\"1\",\"billlading\":\"1\",\"perfinvoice\":\"1\",\"pytoorigin\":\"1\",\"invoice\":\"1\",\"permit\":\"0\",\"expense\":\"1\",\"payment\":\"1\",\"billentry\":\"1\",\"balancesheet\":\"1\",\"invreport\":\"1\",\"arrivalreport\":\"1\",\"expensereport\":\"1\",\"containerreport\":\"1\",\"poreport\":\"1\",\"cusentry\":\"1\",\"saletable\":\"1\"}','1','2015-09-16 16:47:41',1,'2015-10-13 11:20:46',2),(4,'pa0002','870bcbf489722763f2a3cd5cb8744f7f2d6173edaf1742a4dbcd1a13ced451105bdd0dfa1a936ecca462dc1f66d4add9b9039056b29a5bd28767ea2ea2af06b0',NULL,'Prakash','Arul mani','softwaretesterid@gmail.com','','','1970-01-01','1970-01-01','{\"default\":\"1\",\"user\":\"1\",\"masters\":\"1\",\"processchart\":\"1\",\"purchaseorder\":\"1\",\"billlading\":\"1\",\"perfinvoice\":\"1\",\"pytoorigin\":\"1\",\"invoice\":\"1\",\"permit\":\"1\",\"expense\":\"1\",\"payment\":\"1\",\"billentry\":\"1\",\"balancesheet\":\"1\",\"invreport\":\"1\",\"arrivalreport\":\"1\",\"expensereport\":\"1\",\"containerreport\":\"1\",\"poreport\":\"1\",\"cusentry\":\"1\",\"saletable\":\"1\"}','1','2015-09-16 16:47:46',2,'2015-10-13 11:20:55',2);

/*Table structure for table `tbl_vendor` */

DROP TABLE IF EXISTS `tbl_vendor`;

CREATE TABLE `tbl_vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_code` varchar(100) NOT NULL,
  `vendor_type_id` int(11) NOT NULL,
  `vendor_name` varchar(50) NOT NULL,
  `vendor_address` text NOT NULL,
  `vendor_city` varchar(255) DEFAULT NULL,
  `vendor_country` varchar(255) NOT NULL,
  `vendor_contact_person` varchar(255) NOT NULL,
  `vendor_mobile_no` varchar(100) DEFAULT NULL,
  `vendor_office_no` varchar(100) DEFAULT NULL,
  `vendor_email` varchar(255) NOT NULL,
  `vendor_website` varchar(255) DEFAULT NULL,
  `vendor_trade_mark` varchar(255) DEFAULT NULL,
  `vendor_remarks` text,
  `vendor_terms` text,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`vendor_id`),
  KEY `FK_tbl_vendor_type` (`vendor_type_id`),
  CONSTRAINT `FK_tbl_vendor_type` FOREIGN KEY (`vendor_type_id`) REFERENCES `tbl_vendor_type` (`vendor_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_vendor` */

insert  into `tbl_vendor`(`vendor_id`,`vendor_code`,`vendor_type_id`,`vendor_name`,`vendor_address`,`vendor_city`,`vendor_country`,`vendor_contact_person`,`vendor_mobile_no`,`vendor_office_no`,`vendor_email`,`vendor_website`,`vendor_trade_mark`,`vendor_remarks`,`vendor_terms`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'VC0000001',1,'TIANSHUI JIAWEI COMMERCIAL & TRADE CO LTD','Dengzhuang village, Huaniu town maiji district,Tianshui city\r\nGansu province,CHINA. Phone no','Tianshui city','CHINA','SELINA','','','369565545@qq.com','','','','<ul>\r\n                            <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>\r\n                            <li>Consectetur adipiscing elit Consectetur adipiscing elit Consectetur adipiscing elit</li>\r\n                            <li>Integer molestie lorem at massa Consectetur adipiscing elit Consectetur adipiscing elit</li>\r\n                            <li>Facilisis in pretium nisl aliquet Facilisis in pretium nisl alique</li>\r\n                            <li>Faucibus porta lacus fringilla vel</li>\r\n                            <li>Aenean sit amet erat nunc</li>\r\n                            <li>TIANSHUI JIAWEI COMMERCIAL & TRADE CO, LTD</li>\r\n                        </ul>','1','2015-08-14 08:39:37',2,'2015-10-07 10:36:33',2),(2,'VC0000002',1,'SHAANXI BOQI','LIJIAZHUO VILLAGE,LEIYA TOWN,WEINAN CITY SHAANXI,CHINA','LEIYA TOWN','CHINA','BOQ','','','BOQ@YAHOO.COM','','','','<ul>\r\n                            <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>\r\n                            <li>Consectetur adipiscing elit Consectetur adipiscing elit Consectetur adipiscing elit</li>\r\n                            <li>Integer molestie lorem at massa Consectetur adipiscing elit Consectetur adipiscing elit</li>\r\n                            <li>Facilisis in pretium nisl aliquet Facilisis in pretium nisl alique</li>\r\n                            <li>Faucibus porta lacus fringilla vel</li>\r\n                            <li>Aenean sit amet erat nunc</li>\r\n                            <li>Eget porttitor lorem uioler 1234</li>\r\n                        </ul>','1','2015-08-14 08:40:47',2,'2015-08-18 15:56:33',4);

/*Table structure for table `tbl_vendor_type` */

DROP TABLE IF EXISTS `tbl_vendor_type`;

CREATE TABLE `tbl_vendor_type` (
  `vendor_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_type` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`vendor_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_vendor_type` */

insert  into `tbl_vendor_type`(`vendor_type_id`,`vendor_type`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'Exporter','1','2015-08-07 18:05:54',NULL,'0000-00-00 00:00:00',NULL),(2,'Third Party','1','2015-08-07 18:06:18',NULL,'0000-00-00 00:00:00',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
