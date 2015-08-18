/*
SQLyog Ultimate v8.55 
MySQL - 5.5.36 : Database - krk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_audit_trail` */

insert  into `tbl_audit_trail`(`aud_id`,`aud_user`,`aud_class`,`aud_action`,`aud_message`,`aud_ip_address`,`aud_created_date`) values (6,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-05 18:53:48'),(7,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-05 18:54:10'),(8,1,'user','site.default.login','admin logged-in successfully.','::1','2015-08-05 18:54:16'),(9,1,'user','site.user.create','Created User successfully.','::1','2015-08-05 19:27:58'),(10,1,'user','site.user.update','Updated User successfully.','::1','2015-08-05 19:33:19'),(11,1,'user','site.company.create','Created Company successfully.','::1','2015-08-06 12:27:59'),(12,1,'user','site.company.create','Created Company successfully.','::1','2015-08-06 12:33:30'),(13,1,'user','site.company.create','Created Company successfully.','::1','2015-08-06 12:33:56'),(14,1,'user','site.company.create','Created Company successfully.','::1','2015-08-06 12:34:47'),(15,1,'user','site.masters.company_create','Created Company successfully.','::1','2015-08-06 12:40:32'),(16,1,'user','site.masters.company_create','Created Company successfully.','::1','2015-08-06 12:43:06'),(17,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 17:11:32'),(18,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 17:14:37'),(19,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 18:24:04'),(20,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 18:24:05'),(21,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 18:32:37'),(22,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 18:33:04'),(23,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:39:16'),(24,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:39:21'),(25,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:39:31'),(26,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:40:56'),(27,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:41:10'),(28,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 18:42:21'),(29,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 18:51:47'),(30,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 18:56:54'),(31,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:04:56'),(32,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:06:05'),(33,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:06:19'),(34,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:06:43'),(35,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:07:51'),(36,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:10:04'),(37,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:10:58'),(38,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:05'),(39,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:11'),(40,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:45'),(41,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:50'),(42,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:54'),(43,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:11:58'),(44,1,'user','site.masters.company_delete','Deleted Company successfully.','::1','2015-08-06 19:12:03'),(45,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:12:15'),(46,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:16:05'),(47,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:23:04'),(48,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:26:27'),(49,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:29:57'),(50,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:33:28'),(51,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-06 19:33:41'),(52,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:34:41'),(53,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-06 19:35:14'),(54,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:42:31'),(55,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:42:59'),(56,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:43:43'),(57,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:44:48'),(58,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:46:05'),(59,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:46:44'),(60,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:47:18'),(61,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:47:35'),(62,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 10:48:01'),(63,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:51:42'),(64,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:51:43'),(65,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:51:59'),(66,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:52:01'),(67,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:52:34'),(68,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 10:52:35'),(69,1,'user','site.masters.company_create','Created Company successfully.','::1','2015-08-07 11:05:22'),(70,1,'user','site.masters.company_update','Updated Company successfully.','::1','2015-08-07 11:15:55'),(71,1,'user','site.masters.company_update','Updated Company successfully.','::1','2015-08-07 11:16:08'),(72,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 11:19:58'),(73,1,'user','site.masters.company_save','Updated Company successfully.','::1','2015-08-07 11:20:11'),(74,1,'user','site.masters.company_save','Created Company successfully.','::1','2015-08-07 11:20:24'),(75,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 12:48:45'),(76,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 12:50:03'),(77,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 13:09:19'),(78,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 13:11:44'),(79,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-07 13:26:59'),(80,1,'user','site.masters.permit_delete','Deleted Permit successfully.','::1','2015-08-07 13:28:46'),(81,1,'user','site.masters.permit_delete','Deleted Permit successfully.','::1','2015-08-07 13:28:52'),(82,1,'user','site.masters.family_save','Created Product Family successfully.','::1','2015-08-07 14:12:29'),(83,1,'user','site.masters.family_save','Created Product Family successfully.','::1','2015-08-07 14:13:15'),(84,1,'user','site.masters.family_save','Created Product Family successfully.','::1','2015-08-07 15:24:12'),(85,1,'user','site.masters.family_save','Updated Product Family successfully.','::1','2015-08-07 15:24:28'),(86,1,'user','site.masters.family_save','Updated Product Family successfully.','::1','2015-08-07 15:25:24'),(87,1,'user','site.masters.product_save','Created Product Family successfully.','::1','2015-08-07 15:58:10'),(88,1,'user','site.masters.product_save','Created Product Family successfully.','::1','2015-08-07 16:01:29'),(89,1,'user','site.masters.product_save','Created Product Family successfully.','::1','2015-08-07 16:01:40'),(90,1,'user','site.masters.variety_save','Created Product Variety Family successfully.','::1','2015-08-07 16:42:24'),(91,1,'user','site.masters.permit_save','Updated Permit successfully.','::1','2015-08-07 16:52:20'),(92,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:07:22'),(93,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:07:30'),(94,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:08:07'),(95,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:08:42'),(96,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:11:05'),(97,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:11:28'),(98,1,'user','site.masters.size_save','Created Product Size Family successfully.','::1','2015-08-07 19:12:03'),(99,1,'user','site.masters.grade_save','Created Product Grade Family successfully.','::1','2015-08-07 19:23:25'),(100,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-08 11:59:51'),(101,1,'user','site.default.login','admin logged-in successfully.','::1','2015-08-08 12:00:25'),(102,1,'user','site.masters.grade_save','Created Product Grade Family successfully.','::1','2015-08-08 12:04:42'),(103,1,'user','site.masters.grade_save','Updated Product Grade Family successfully.','::1','2015-08-08 12:36:13'),(104,1,'user','site.masters.vendor_save','Created Vendor successfully.','::1','2015-08-08 13:34:37'),(105,1,'user','site.masters.vendor_delete','Deleted Vendor successfully.','::1','2015-08-08 13:43:55'),(106,1,'user','site.masters.vendor_save','Created Vendor successfully.','::1','2015-08-08 13:44:19'),(107,1,'user','site.masters.liner_save','Created Liner successfully.','::1','2015-08-08 18:01:08'),(108,1,'user','site.user.update','Updated User successfully.','::1','2015-08-08 18:02:32'),(109,1,'user','site.user.delete','Deleted User successfully.','::1','2015-08-08 18:02:41'),(110,1,'user','site.user.create','Created User successfully.','::1','2015-08-08 18:03:08'),(111,1,'user','site.masters.permit_save','Created Permit successfully.','::1','2015-08-08 18:05:28'),(112,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-08 19:26:11'),(113,1,'user','site.default.login','admin logged-in successfully.','::1','2015-08-08 19:26:21'),(114,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-08 19:34:06'),(115,1,'user','site.default.login','admin logged-in successfully.','::1','2015-08-10 10:17:45'),(116,1,'user','site.masters.size_save','Updated Product Size Family successfully.','::1','2015-08-10 19:01:59'),(117,1,'user','site.masters.size_save','Updated Product Size Family successfully.','::1','2015-08-10 19:02:13'),(118,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 17:43:45'),(119,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 17:47:40'),(120,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 17:49:53'),(121,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 17:51:19'),(122,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-11 18:21:54'),(123,1,'user','site.default.logout','admin logged-out successfully.','127.0.0.1','2015-08-12 12:26:37'),(124,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-08-12 12:35:38'),(125,2,'user','site.user.create','Created User successfully.','127.0.0.1','2015-08-12 13:24:35'),(126,2,'user','site.user.create','Created User successfully.','127.0.0.1','2015-08-12 13:28:58'),(127,2,'user','site.default.logout','asas logged-out successfully.','127.0.0.1','2015-08-12 13:32:13'),(128,4,'user','site.default.login','pa0002 logged-in successfully.','127.0.0.1','2015-08-12 13:33:17'),(129,4,'user','site.default.logout','Prakash logged-out successfully.','127.0.0.1','2015-08-12 13:36:31'),(130,2,'user','site.default.login','admin logged-in successfully.','127.0.0.1','2015-08-12 13:36:37'),(131,2,'user','site.user.update','Updated User successfully.','127.0.0.1','2015-08-12 13:36:51'),(132,2,'user','site.default.login','admin logged-in successfully.','::1','2015-08-13 15:42:27'),(133,2,'user','site.user.update','Updated User successfully.','::1','2015-08-13 17:07:16'),(134,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-14 11:16:23'),(135,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-14 11:21:18'),(136,1,'user','site.purchaseorder.create','Created PurchaseOrder successfully.','::1','2015-08-14 11:26:23'),(137,1,'user','site.masters.variety_save','Created Product Variety Family successfully.','::1','2015-08-14 12:07:40'),(138,1,'user','site.invoice.create','Created Invoice successfully.','::1','2015-08-14 12:40:32'),(139,1,'user','site.invoice.create','Created Invoice successfully.','::1','2015-08-14 12:46:18'),(140,1,'user','site.invoice.create','Created Invoice successfully.','::1','2015-08-14 12:54:14'),(141,1,'user','site.invoice.create','Created Invoice successfully.','::1','2015-08-14 12:59:22'),(142,1,'user','site.billlading.create','Created BillLading successfully.','::1','2015-08-14 16:27:06'),(143,1,'user','site.pytoorigin.create','Created PytoOrigin successfully.','::1','2015-08-14 17:17:23'),(144,1,'user','site.default.logout','admin logged-out successfully.','::1','2015-08-14 19:41:29');

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
  `bl_container_number` varchar(100) DEFAULT NULL,
  `bl_liner_id` int(11) DEFAULT NULL,
  `bl_container_count` decimal(10,2) DEFAULT NULL,
  `bl_free_days` smallint(6) DEFAULT NULL,
  `bl_frieght_paid` enum('Y','N') DEFAULT 'N',
  `bl_documents` text,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bill_lading` */

insert  into `tbl_bill_lading`(`bl_id`,`bl_company_id`,`bl_vendor_id`,`bl_po_id`,`bl_invoice_id`,`bl_number`,`bl_issue_date`,`bl_issue_place`,`bl_load_port`,`bl_discharge_port`,`bl_vessal_name`,`bl_shipped_date`,`bl_container_number`,`bl_liner_id`,`bl_container_count`,`bl_free_days`,`bl_frieght_paid`,`bl_documents`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,2,2,5,5,'2111111','0000-00-00','asaa','saq','qqsasa','sasasa','0000-00-00','111111',1,'100.00',80,'Y','\\billlading\\0e11f70b696c9cfdbc4fc72f59bf5362.png','1','2015-08-14 16:27:06','0000-00-00 00:00:00',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_company` */

insert  into `tbl_company`(`company_id`,`company_name`,`company_address`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'AAAAAAAA','BBBBBB','1','2015-08-07 11:05:21',1,'2015-08-07 11:16:08',1),(2,'CCCCCCC','EEEEEEEEEEEEE','1','2015-08-07 11:19:58',1,'2015-08-07 11:20:10',1),(3,'AAAAAA','SSSSSSSSS','1','2015-08-07 11:20:24',1,'0000-00-00 00:00:00',NULL);

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

/*Table structure for table `tbl_invoice` */

DROP TABLE IF EXISTS `tbl_invoice`;

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `permit_no` varchar(100) NOT NULL,
  `bol_no` varchar(100) NOT NULL,
  `inv_no` varchar(100) NOT NULL,
  `vessel_name` varchar(100) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_file` varchar(255) DEFAULT NULL,
  `pkg_list_file` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_invoice` */

insert  into `tbl_invoice`(`invoice_id`,`vendor_id`,`company_id`,`po_id`,`permit_no`,`bol_no`,`inv_no`,`vessel_name`,`inv_date`,`inv_file`,`pkg_list_file`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (5,2,2,5,'111111','2111111','111111111','1122233','2015-08-08','\\invoice\\d6bbc4ab8ece10a45958f5fdfe0258e6.png','\\invoice\\9462e51ffc53a9df08034312317f8168.png',1,'2015-08-14 12:59:22',1,'0000-00-00 00:00:00',NULL);

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
  CONSTRAINT `FK_tbl_invoice_items_size` FOREIGN KEY (`inv_det_size`) REFERENCES `tbl_product_size` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_grade` FOREIGN KEY (`inv_det_grade`) REFERENCES `tbl_product_grade` (`grade_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_inv` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_product` FOREIGN KEY (`inv_det_product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_product_variety` FOREIGN KEY (`inv_det_variety_id`) REFERENCES `tbl_product_variety` (`variety_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_invoice_items_prod_family` FOREIGN KEY (`inv_det_prod_fmly_id`) REFERENCES `tbl_product_family` (`pro_family_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_invoice_items` */

insert  into `tbl_invoice_items`(`inv_det_id`,`inv_id`,`inv_det_prod_fmly_id`,`inv_det_product_id`,`inv_det_variety_id`,`inv_det_grade`,`inv_det_size`,`inv_det_cotton_qty`,`inv_det_currency`,`inv_det_price`,`inv_det_net_weight`,`inv_det_gross_weight`,`inv_det_ctnr_no`,`is_delivered`,`created_at`,`created_by`,`modified_at`,`modified_by`,`status`) values (1,5,3,2,1,2,2,'100.00','INR (INR)','10.00','10.00','10.00','111111','Y',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(2,5,3,2,1,2,2,'100.00','INR (INR)','10.00','10.00','10.00','111111','Y',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(3,5,3,2,1,2,1,'100.00','INR (INR)','10.00','10.00','10.00','111111','Y',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(4,5,3,2,1,2,3,'100.00','INR (INR)','10.00','10.00','10.00','111111','Y',NULL,'0000-00-00 00:00:00',NULL,NULL,'1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_liner` */

insert  into `tbl_liner`(`liner_id`,`liner_code`,`liner_name`,`country_id`,`no_of_free_days`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'','ASASA',2,8,'1','2015-08-08 18:01:07',1,'0000-00-00 00:00:00',NULL);

/*Table structure for table `tbl_permit` */

DROP TABLE IF EXISTS `tbl_permit`;

CREATE TABLE `tbl_permit` (
  `permit_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
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
  CONSTRAINT `FK_tbl_permit_company` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permit` */

insert  into `tbl_permit`(`permit_id`,`company_id`,`permit_no`,`doissue`,`valupto`,`permit_regno`,`permit_poissue`,`permit_file`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,1,'asasasas','1970-01-01','1970-01-01','asasasasa','asasas','\\permit\\6f1cd971d49c1fbae70de5a2af4dc564.png','1','2015-08-07 12:48:45',1,'2015-08-07 16:52:20',1),(2,2,'ASASASA','0000-00-00','0000-00-00','asasasas','asasas','\\permit\\80841a705630b3ddcce6f15e2a38ff90.png','1','2015-08-07 12:50:03',1,'0000-00-00 00:00:00',NULL),(3,3,'ASASASA','0000-00-00','0000-00-00','nbvnvbnv','vbnvbnvb',NULL,'1','2015-08-07 13:09:18',1,'0000-00-00 00:00:00',NULL),(4,1,'4535435','2015-08-13','2015-08-27','454354354','',NULL,'1','2015-08-08 18:05:27',1,'0000-00-00 00:00:00',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product` */

insert  into `tbl_product`(`product_id`,`product_code`,`pro_family_id`,`pro_name`,`status`,`created_by`,`created_at`,`modified_by`,`modified_at`) values (1,'',2,'bbbvcbvc','1',1,'2015-08-07 15:58:10',NULL,'0000-00-00 00:00:00'),(2,'',3,'Asasasasas','1',1,'2015-08-07 16:01:29',NULL,'0000-00-00 00:00:00'),(3,'',3,'asasasa','1',1,'2015-08-07 16:01:40',NULL,'0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_family` */

insert  into `tbl_product_family`(`pro_family_id`,`pro_family_code`,`pro_family_name`,`status`,`created_by`,`created_at`,`modified_by`,`modified_at`) values (1,'','ASASA','1',1,'2015-08-07 14:12:29',NULL,'0000-00-00 00:00:00'),(2,'','asasas','1',1,'2015-08-07 14:13:15',NULL,'0000-00-00 00:00:00'),(3,'','XXXXXX','1',1,'2015-08-07 15:24:12',1,'2015-08-07 15:25:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_grade` */

insert  into `tbl_product_grade`(`grade_id`,`grade_code`,`product_id`,`grade_short_name`,`grade_long_name`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'',3,'hjghfgh','ghfghfg','1','2015-08-07 19:23:25',1,'0000-00-00 00:00:00',NULL),(2,'',2,'ASASA','ASASA','1','2015-08-08 12:04:42',1,'2015-08-08 12:36:13',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_size` */

insert  into `tbl_product_size`(`size_id`,`size_code`,`product_id`,`size_name`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'',2,'AAAAAA','1','2015-08-07 19:07:22',1,'0000-00-00 00:00:00',NULL),(2,'',2,'BBBBB','1','2015-08-07 19:07:30',1,'2015-08-10 19:01:59',1),(3,'',2,'CCCCC','1','2015-08-07 19:08:07',1,'2015-08-10 19:02:12',1),(4,'',2,'AAAAAA','1','2015-08-07 19:08:42',1,'0000-00-00 00:00:00',NULL),(5,'',3,'AAAAAAA','1','2015-08-07 19:11:05',1,'0000-00-00 00:00:00',NULL),(6,'',3,'BBBBB','1','2015-08-07 19:11:28',1,'0000-00-00 00:00:00',NULL),(7,'',3,'XXXX','1','2015-08-07 19:12:02',1,'0000-00-00 00:00:00',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_variety` */

insert  into `tbl_product_variety`(`variety_id`,`variety_code`,`product_id`,`variety_name`,`status`,`created_by`,`created_at`,`modified_by`,`modified_at`) values (1,'',2,'1000','1',1,'2015-08-07 16:42:24',NULL,'0000-00-00 00:00:00'),(2,'V002',3,'500','1',1,'2015-08-14 12:07:40',NULL,'0000-00-00 00:00:00');

/*Table structure for table `tbl_purchase_order` */

DROP TABLE IF EXISTS `tbl_purchase_order`;

CREATE TABLE `tbl_purchase_order` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_code` varchar(100) NOT NULL,
  `po_date` date NOT NULL,
  `po_company_id` int(11) NOT NULL,
  `po_vendor_id` int(11) NOT NULL,
  `po_liner_id` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_id`),
  KEY `FK_tbl_purchase_order_company` (`po_company_id`),
  KEY `FK_tbl_purchase_order_vendor` (`po_vendor_id`),
  KEY `FK_tbl_purchase_order_liner` (`po_liner_id`),
  CONSTRAINT `FK_tbl_purchase_order_company` FOREIGN KEY (`po_company_id`) REFERENCES `tbl_company` (`company_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_purchase_order_liner` FOREIGN KEY (`po_liner_id`) REFERENCES `tbl_liner` (`liner_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_purchase_order_vendor` FOREIGN KEY (`po_vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_order` */

insert  into `tbl_purchase_order`(`po_id`,`purchase_order_code`,`po_date`,`po_company_id`,`po_vendor_id`,`po_liner_id`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,'PO0000000000001','2015-08-15',3,2,1,'1','2015-08-11 18:21:54','0000-00-00 00:00:00',NULL,NULL),(2,'PO0000000000002','2015-08-29',2,2,1,'1','2015-08-14 11:16:23','0000-00-00 00:00:00',NULL,NULL),(3,'PO0000000000003','2015-08-31',1,2,1,'1','2015-08-14 11:20:40','0000-00-00 00:00:00',NULL,NULL),(4,'PO0000000000004','2015-08-31',1,2,1,'1','2015-08-14 11:21:18','0000-00-00 00:00:00',NULL,NULL),(5,'PO0000000000005','2015-08-21',2,2,1,'1','2015-08-14 11:23:56','0000-00-00 00:00:00',NULL,NULL),(6,'PO0000000000006','2015-08-21',2,2,1,'1','2015-08-14 11:26:23','0000-00-00 00:00:00',NULL,NULL);

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
  `po_det_currency` text COMMENT 'R->Rupee, D->Dollar',
  `po_det_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_order_details` */

insert  into `tbl_purchase_order_details`(`po_det_id`,`po_id`,`po_det_prod_fmly_id`,`po_det_product_id`,`po_det_variety_id`,`po_det_grade`,`po_det_size`,`po_det_net_weight`,`po_det_container_qty`,`po_det_cotton_qty`,`po_det_currency`,`po_det_price`,`created_at`,`created_by`,`modified_at`,`modified_by`,`status`) values (1,1,3,2,1,'[\"2\"]','[\"1\",\"2\"]','10.000','25.00','20.00','USD ($)','80.00',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(2,1,3,2,1,'[\"2\"]','[\"1\",\"2\"]','10.000','1000.00','100.00',NULL,'100.00',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(3,1,3,2,1,'[\"2\"]','[\"1\",\"3\"]','80.000','8.00','256.00',NULL,'100.00',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(4,2,3,2,1,'[\"2\"]','[\"1\",\"2\"]','10.000','10.00','10.00',NULL,'100.00',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(5,2,3,2,1,'[\"2\"]','[\"1\",\"2\"]','25.000','200.00','28.00',NULL,'80.00',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(6,4,3,2,1,'[\"2\"]','[\"1\",\"2\",\"3\"]','80.000','80.00','100.00',NULL,'322.00',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(7,4,3,2,1,'[\"2\"]','[\"3\",\"4\"]','20.000','80.00','100.00',NULL,'50.00',NULL,'0000-00-00 00:00:00',NULL,NULL,'1'),(8,6,3,2,1,'[\"2\"]','[\"2\",\"3\"]','10.000','100.00','50.00',NULL,'80.00',NULL,'0000-00-00 00:00:00',NULL,NULL,'1');

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
  CONSTRAINT `FK_tbl_pyto_origin_invoice` FOREIGN KEY (`pyto_invoice_id`) REFERENCES `tbl_invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_pyto_origin_company` FOREIGN KEY (`pyto_company_id`) REFERENCES `tbl_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_pyto_origin_po` FOREIGN KEY (`pyto_po_id`) REFERENCES `tbl_purchase_order` (`po_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_pyto_origin_vendor` FOREIGN KEY (`pyto_vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pyto_origin` */

insert  into `tbl_pyto_origin`(`pyto_id`,`pyto_company_id`,`pyto_vendor_id`,`pyto_po_id`,`pyto_invoice_id`,`pyto_cert_no`,`doinspection`,`origin_cert_no`,`pyto_file`,`origin_file`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (1,2,2,5,5,'5656565656','2015-08-29','777878877788888',NULL,NULL,1,'2015-08-14 17:17:23',1,'0000-00-00 00:00:00',NULL);

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

insert  into `tbl_user`(`user_id`,`username`,`password_hash`,`password_reset_token`,`first_name`,`last_name`,`email_id`,`mobile_no`,`address`,`dojoin`,`dobirtrh`,`authorize`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (2,'admin','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec',NULL,'asas','asasas','asasa@fafda.com','4984798798','','2015-08-01','2015-06-22','{\"default\":\"1\",\"user\":\"1\",\"masters\":\"1\",\"processchart\":\"1\",\"purchaseorder\":\"1\",\"billoflad\":\"1\",\"perfinvoice\":\"1\",\"pytoorigin\":\"1\",\"invoice\":\"1\",\"permit\":\"1\",\"purchaseexpense\":\"0\",\"balancesheet\":\"0\",\"invreport\":\"0\",\"arrivalreport\":\"0\",\"expensereport\":\"0\",\"containerreport\":\"0\",\"poreport\":\"0\",\"cusentry\":\"0\",\"saletable\":\"0\"}','1','2015-08-13 16:07:08',1,'2015-08-13 17:07:15',2),(4,'pa0002','870bcbf489722763f2a3cd5cb8744f7f2d6173edaf1742a4dbcd1a13ced451105bdd0dfa1a936ecca462dc1f66d4add9b9039056b29a5bd28767ea2ea2af06b0',NULL,'Prakash','Arul mani','softwaretesterid@gmail.com','','','1970-01-01','1970-01-01','{\"default\":\"1\",\"user\":\"1\",\"masters\":\"1\"}','1','2015-08-13 16:08:22',2,'0000-00-00 00:00:00',NULL);

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

insert  into `tbl_vendor`(`vendor_id`,`vendor_code`,`vendor_type_id`,`vendor_name`,`vendor_address`,`vendor_city`,`vendor_country`,`vendor_contact_person`,`vendor_mobile_no`,`vendor_office_no`,`vendor_email`,`vendor_website`,`vendor_trade_mark`,`vendor_remarks`,`status`,`created_at`,`created_by`,`modified_at`,`modified_by`) values (2,'',1,'Test','asasas','Sample','INDIA','Ajay','','','sadsadsa@dsdsadsa.com','','','','1','2015-08-08 13:44:19',1,NULL,NULL);

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
