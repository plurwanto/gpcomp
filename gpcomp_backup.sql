/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.21-MariaDB : Database - gpcomp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `CategoryId` varchar(10) NOT NULL,
  `CategoryName` varchar(50) DEFAULT NULL,
  `Status` varchar(1) DEFAULT NULL,
  `AddDate` date DEFAULT '0000-00-00',
  `EditDate` date DEFAULT '0000-00-00',
  `AddUser` varchar(10) DEFAULT NULL,
  `EditUser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`CategoryId`,`CategoryName`,`Status`,`AddDate`,`EditDate`,`AddUser`,`EditUser`) values ('BL','BUKALAPAK','Y','2017-09-29','0000-00-00','1',NULL),('TP','TOKOPEDIA','Y','2017-09-29','0000-00-00','1',NULL);

/*Table structure for table `mcategory` */

DROP TABLE IF EXISTS `mcategory`;

CREATE TABLE `mcategory` (
  `category_id` varchar(5) NOT NULL,
  `category_tx` varchar(40) NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mcategory` */

insert  into `mcategory`(`category_id`,`category_tx`,`updated_by`,`updated_on`) values ('00000','None','gun','2017-11-05 21:08:57'),('0001','category1','gun','2017-11-05 08:29:45');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `category_link` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `unique` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `menu` */

insert  into `menu`(`category_id`,`category_name`,`category_link`,`parent_id`,`sort_order`) values (1,'Home','',0,0),(2,'Tutorials','#',0,1),(3,'Java','java',2,1),(4,'Liferay','liferay',2,1),(5,'Frameworks','#',0,2),(6,'JSF','jsf',5,2),(7,'Struts','struts',5,2),(8,'Spring','spring',5,2),(9,'Hibernate','hibernate',5,2),(10,'Webservices','#',0,3),(11,'REST','rest',10,3),(12,'SOAP','soap',10,3),(13,'Contact','contact',0,4),(14,'About','about',0,5);

/*Table structure for table `mequipment` */

DROP TABLE IF EXISTS `mequipment`;

CREATE TABLE `mequipment` (
  `equip_id` varchar(18) NOT NULL,
  `equip_tx` varchar(40) NOT NULL,
  `serial_no` varchar(18) NOT NULL DEFAULT '',
  `status` varchar(1) NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`equip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mequipment` */

insert  into `mequipment`(`equip_id`,`equip_tx`,`serial_no`,`status`,`updated_by`,`updated_on`) values ('100','equipment','200','X','','0000-00-00 00:00:00'),('101','equipment','201','X','','0000-00-00 00:00:00'),('103','equipment','104','X','','0000-00-00 00:00:00'),('104','equipment','105','X','','0000-00-00 00:00:00'),('105','equipment','106','X','','0000-00-00 00:00:00'),('106','equipment','107','X','','0000-00-00 00:00:00'),('107','equipment','108','X','','0000-00-00 00:00:00'),('108','equipment','109','X','','0000-00-00 00:00:00'),('109','equipment','110','X','','0000-00-00 00:00:00'),('110','equipment','111','X','','0000-00-00 00:00:00'),('111','equipment','112','X','','0000-00-00 00:00:00'),('112','equipment','113','X','','0000-00-00 00:00:00'),('113','equipment','114','X','','0000-00-00 00:00:00'),('114','equipment','115','X','','0000-00-00 00:00:00'),('116','equipment','117','X','','0000-00-00 00:00:00'),('117','equipment','118','X','','0000-00-00 00:00:00'),('118','equipment','119','X','','0000-00-00 00:00:00'),('119','equipment','1100','X','','0000-00-00 00:00:00'),('222','equipment','333','X','','0000-00-00 00:00:00'),('2400','equipment','600','X','','0000-00-00 00:00:00'),('2500','equipment','6000','X','','0000-00-00 00:00:00'),('50015','equipment','54545','X','','0000-00-00 00:00:00');

/*Table structure for table `mmaterial` */

DROP TABLE IF EXISTS `mmaterial`;

CREATE TABLE `mmaterial` (
  `mat_id` varchar(18) NOT NULL,
  `mat_tx` varchar(40) NOT NULL,
  `category_id` varchar(5) NOT NULL DEFAULT '',
  `subcategory_id` varchar(5) NOT NULL DEFAULT '',
  `color_id` varchar(3) NOT NULL DEFAULT '',
  `updated_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mmaterial` */

insert  into `mmaterial`(`mat_id`,`mat_tx`,`category_id`,`subcategory_id`,`color_id`,`updated_by`,`updated_on`) values ('mat11','material11','0001','00000',' ','gun','2017-11-05 21:04:41'),('mat13','material 13','0001','SUBwa',' ','gun','2017-11-05 21:23:46'),('mat3','mat3','X1234','X0001',' ','gun','2017-11-05 18:59:55'),('mat4','materail 4','X0002','SUBwa',' ','gun','2017-11-05 19:00:10'),('Yamaha01','Yamaha vixion','X1234','X0001',' ','gun','2017-11-05 18:59:23');

/*Table structure for table `mplant` */

DROP TABLE IF EXISTS `mplant`;

CREATE TABLE `mplant` (
  `plant_id` varchar(4) NOT NULL,
  `plant_tx` varchar(40) NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`plant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mplant` */

insert  into `mplant`(`plant_id`,`plant_tx`,`updated_by`,`updated_on`) values ('A001','Bekasi Timur ','gun','0000-00-00 00:00:00');

/*Table structure for table `mstorage` */

DROP TABLE IF EXISTS `mstorage`;

CREATE TABLE `mstorage` (
  `plant_id` varchar(4) NOT NULL,
  `sloc` varchar(4) NOT NULL,
  `sloc_tx` varchar(40) NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`plant_id`,`sloc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mstorage` */

insert  into `mstorage`(`plant_id`,`sloc`,`sloc_tx`,`updated_by`,`updated_on`) values ('A001','L001','Storage Bekasi','Gun','0000-00-00 00:00:00'),('A001','L002','Bekasi 2','Gun','0000-00-00 00:00:00');

/*Table structure for table `msubcategory` */

DROP TABLE IF EXISTS `msubcategory`;

CREATE TABLE `msubcategory` (
  `subcategory_id` varchar(5) NOT NULL,
  `subcategory_tx` varchar(40) NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `msubcategory` */

insert  into `msubcategory`(`subcategory_id`,`subcategory_tx`,`updated_by`,`updated_on`) values ('00000','None','gun','2017-11-05 19:09:54'),('X0002','X0002','gun','2017-11-04 20:31:08');

/*Table structure for table `mvendor` */

DROP TABLE IF EXISTS `mvendor`;

CREATE TABLE `mvendor` (
  `vendor_id` varchar(10) NOT NULL,
  `vendor_tx` varchar(40) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `hp` varchar(18) NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `updated_by` varchar(10) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mvendor` */

insert  into `mvendor`(`vendor_id`,`vendor_tx`,`address`,`phone`,`hp`,`postal_code`,`email`,`updated_by`,`updated_on`) values ('cust01','Agus Ahmad','Jl. gading indah bulevard','081543343434','0218343434','10610','gunawans2014@gmail.com','gun','2017-11-05 09:18:07');

/*Table structure for table `pembelian_detail` */

DROP TABLE IF EXISTS `pembelian_detail`;

CREATE TABLE `pembelian_detail` (
  `IDTransaksi` varchar(20) NOT NULL,
  `NamaProduk` varchar(250) NOT NULL,
  `HargaProduk` decimal(10,0) DEFAULT NULL,
  `JumlahProduk` decimal(10,0) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT '0000-00-00 00:00:00',
  `UpdateUser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IDTransaksi`,`NamaProduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_detail` */

insert  into `pembelian_detail`(`IDTransaksi`,`NamaProduk`,`HargaProduk`,`JumlahProduk`,`UpdateDate`,`UpdateUser`) values ('170435263232','Flashdisk SanDisk Cruzer Blade 16GB','61900','1','2017-12-29 13:26:44','admin'),('170437090482','Flashdisk SanDisk Cruzer Blade 16GB','61900','4','2017-12-29 13:26:44','admin'),('170459158232','Flashdisk Sandisk Cruzer Edge CZ51 16GB','61900','4','2017-12-29 13:26:44','admin'),('170463330272','Flashdisk Sandisk Cruzer Edge CZ51 16GB','61900','10','2017-12-29 13:26:44','admin'),('170482739832','Flashdisk SanDisk Cruzer Blade 16GB USB Flash Drive CZ50 - GARANSI RESMI','66000','5','2017-12-29 13:26:44','admin'),('170506517407','Flashdisk SanDisk Cruzer Blade 16GB USB Flash Drive CZ50 - GARANSI RESMI','69000','5','2017-12-29 13:26:44','admin'),('170512909112','USB Flashdisk SANDISK CRUIZER BLADE 16GB','68900','20','2017-12-29 13:26:44','admin'),('170534293077','Flashdisk SanDisk Cruzer Blade 16GB USB Flash Drive CZ50 - GARANSI RESMI','69000','10','2017-12-29 13:26:44','admin'),('170555366812','Flashdisk SanDisk Cruzer Blade 16GB USB Flash Drive CZ50 - GARANSI RESMI','69000','20','2017-12-29 13:26:44','admin'),('170579888189','Flashdisk Sandisk Cruzer Edge Cz51 32GB - Garansi Resmi','126000','5','2017-12-29 13:26:44','admin'),('170590033524','SanDisk Flashdisk Cruzer Blade CZ50 - 16GB Garansi Resmi','69000','10','2017-12-29 13:26:44','admin'),('180610614249','SanDisk Flashdisk Cruzer Blade CZ50 - 16GB Garansi Resmi','69000','10','2018-01-21 16:44:11','admin'),('180613363139','Sandisk Blade 16GB  USB Flashdisk ORIGINAL','68000','3','2018-01-21 16:44:11','admin'),('180615962499','Sandisk Blade 16GB  USB Flashdisk ORIGINAL','68000','20','2018-01-24 23:11:18','admin');

/*Table structure for table `pembelian_header` */

DROP TABLE IF EXISTS `pembelian_header`;

CREATE TABLE `pembelian_header` (
  `CategoryId` varchar(10) DEFAULT NULL,
  `Tanggal` datetime DEFAULT '0000-00-00 00:00:00',
  `IDTransaksi` varchar(20) NOT NULL,
  `Penjual` varchar(50) DEFAULT NULL,
  `Pembeli` varchar(50) DEFAULT NULL,
  `HPPembeli` varchar(20) DEFAULT NULL,
  `AlamatPembeli` varchar(100) DEFAULT NULL,
  `KecamatanPembeli` varchar(50) DEFAULT NULL,
  `KotaPembeli` varchar(50) DEFAULT NULL,
  `PropinsiPembeli` varchar(50) DEFAULT NULL,
  `KodePosPembeli` varchar(10) DEFAULT NULL,
  `BiayaPengiriman` decimal(10,0) DEFAULT NULL,
  `BiayaAsuransi` decimal(10,0) DEFAULT NULL,
  `BiayaPelayanan` decimal(10,0) DEFAULT NULL,
  `Voucher` decimal(10,0) DEFAULT NULL,
  `KodePembayaran` decimal(10,0) DEFAULT NULL,
  `TotalTerbayar` decimal(10,0) DEFAULT NULL,
  `Kurir` varchar(50) DEFAULT NULL,
  `KodeTracking` varchar(25) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `MetodePembayaran` varchar(100) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT '0000-00-00 00:00:00',
  `UpdateUser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IDTransaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_header` */

insert  into `pembelian_header`(`CategoryId`,`Tanggal`,`IDTransaksi`,`Penjual`,`Pembeli`,`HPPembeli`,`AlamatPembeli`,`KecamatanPembeli`,`KotaPembeli`,`PropinsiPembeli`,`KodePosPembeli`,`BiayaPengiriman`,`BiayaAsuransi`,`BiayaPelayanan`,`Voucher`,`KodePembayaran`,`TotalTerbayar`,`Kurir`,`KodeTracking`,`Status`,`MetodePembayaran`,`UpdateDate`,`UpdateUser`) values ('BL','2017-06-05 17:10:56','170435263232','asim ridista','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','9000','0','0','-9000','0','61900','NINJA REG','NVIDBLAPK000058368','Diterima & Selesai','BukaDompet','2017-12-29 13:26:44','admin'),('BL','2017-06-08 07:44:21','170437090482','asim ridista','Purwanto','087884096677','PT Victoria Care Indonesia Jl Daan mogot KM 11 Wisma SSK Lt5 Kedaung kali angke','Cengkareng','Jakarta Barat','DKI Jakarta','11710','9000','0','0','-20000','971','237571','NINJA REG','NVIDBLAPK000060519','Diterima & Selesai','Transfer','2017-12-29 13:26:44','admin'),('BL','2017-07-15 13:03:16','170459158232','asim ridista','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','9000','0','0','-20000','756','237356','JNE REG','014470040086317','Diterima & Selesai','Transfer','2017-12-29 13:26:44','admin'),('BL','2017-07-22 00:04:55','170463330272','asim ridista','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','9000','0','0','-20000','1401','609401','JNE REG','CGKBZ02222535017','Diterima & Selesai','Transfer','2017-12-29 13:26:44','admin'),('BL','2017-08-18 14:27:05','170482739832','usblinkcorner','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','9000','0','0','-25000','0','314000','JNE REG','3143935710006','Diterima & Selesai','BukaDompet','2017-12-29 13:26:44','admin'),('BL','2017-09-19 09:09:06','170506517407','usblinkcorner','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','9000','0','0','-25000','0','329000','JNE REG','010470807769717','Diterima & Selesai','BukaDompet','2017-12-29 13:26:44','admin'),('BL','2017-09-27 09:02:43','170512909112','karuniaonline','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','8080','0','0','-20000','1090','1367170','Pos Kilat Khusus','15635410744','Diterima & Selesai','Transfer','2017-12-29 13:26:44','admin'),('BL','2017-10-24 09:53:45','170534293077','usblinkcorner','Purwanto','087884096677','Lobby Plaza Asia Jl Jendral Sudirman Kav.59 Jakarta','Kebayoran Baru','Jakarta Selatan','DKI Jakarta','12190','15000','0','0','-15000','1937','691937','GO-SEND Same Day','GK-43409787','Diterima & Selesai','Transfer','2017-12-29 13:26:44','admin'),('BL','2017-11-16 09:32:16','170555366812','usblinkcorner','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','9000','0','0','0','1852','1390852','JNE REG','010470985759317','Diterima & Selesai','Transfer','2017-12-29 13:26:44','admin'),('BL','2017-12-11 06:43:53','170579888189','usblinkcorner','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','10000','0','0','0','0','640000','J&T REG','JD0003454483','Diterima & Selesai','BukaDompet','2017-12-29 13:26:44','admin'),('BL','2017-12-19 06:00:45','170590033524','Ridista Online Store','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','5000','0','0','0','1656','696656','Grab Parcel Reguler','BLG3LLTRZZUZYUJ4','Diterima & Selesai','Transfer','2017-12-29 13:26:44','admin'),('BL','2018-01-07 07:42:03','180610614249','Ridista Online Store','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','5000','0','0','-15000','0','695000','Grab Parcel Reguler','BLG3T7WFXVB34FTY','Diterima & Selesai','Transfer Virtual Account','2018-01-21 16:44:11','admin'),('BL','2018-01-09 09:53:06','180613363139','Buka Komputer','Purwanto','087884096677','Lobby Plaza Asia Jl Jendral Sudirman Kav.59 Jakarta','Kebayoran Baru','Jakarta Selatan','DKI Jakarta','12190','15000','0','0','0','0','219000','GO-SEND Same Day','GK-56163404','Diterima & Selesai','Transfer Virtual Account','2018-01-21 16:44:11','admin'),('BL','2018-01-11 07:14:20','180615962499','Buka Komputer','Ratih','087884096677','Taman Palem Lestari Ruko Galaxy Blok O No.1 Cengkareng Barat','Cengkareng','Jakarta Barat','DKI Jakarta','11730','10000','0','0','-70000','0','1370000','Grab Parcel Reguler','BLG3T81PIQIRDA0J','Diterima & Selesai','Transfer Virtual Account','2018-01-24 23:11:17','admin');

/*Table structure for table `penjualan_detail` */

DROP TABLE IF EXISTS `penjualan_detail`;

CREATE TABLE `penjualan_detail` (
  `IDTransaksi` varchar(50) NOT NULL,
  `NamaProduk` varchar(250) NOT NULL,
  `HargaBeli` decimal(10,0) DEFAULT NULL,
  `HargaProduk` decimal(10,0) DEFAULT NULL,
  `JumlahProduk` decimal(10,0) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT '0000-00-00 00:00:00',
  `UpdateUser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IDTransaksi`,`NamaProduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualan_detail` */

insert  into `penjualan_detail`(`IDTransaksi`,`NamaProduk`,`HargaBeli`,`HargaProduk`,`JumlahProduk`,`UpdateDate`,`UpdateUser`) values ('170427818977','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170436584647','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170438484132','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170456336707','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170457147292','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170459057087','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170460232492','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170462408932','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170463230487','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170464986472','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170467165857','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170467588117','USB flashdisk bootable windows 16GB','61900','100000','1','2017-12-29 11:25:00','admin'),('170473455902','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170475784257','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170478316857','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170480121102','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170480774357','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170482655657','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170501499087','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170502678392','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170503816777','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170505792422','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170507783902','USB flashdisk bootable windows 16GB','66000','100000','1','2017-12-29 11:25:00','admin'),('170511038842','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','85000','1','2017-12-29 11:25:00','admin'),('170512040647','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:25:00','admin'),('170512709847','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:25:00','admin'),('170512709847','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:25:00','admin'),('170512709847','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:25:00','admin'),('170513369587','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:25:00','admin'),('170514058437','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:25:00','admin'),('170514095052','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:25:00','admin'),('170516241477','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:25:00','admin'),('170516451637','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170516694192','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170517841282','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170521236262','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170521378842','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170526777622','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170531247302','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170531619107','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170532466362','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170533126702','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170533508792','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170533927212','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170535854987','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170538388147','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170538536327','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170543350777','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170545492682','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170546469217','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170546740572','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170547906357','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170550108052','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170550125412','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170552439977','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170553020487','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170553695382','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170555209037','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170555919242','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170555922562','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170558624207','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170559431252','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170562069642','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170563759714','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170564913204','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170565864864','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170571264529','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170573190819','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170575351214','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170577386764','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170579271924','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170582319439','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170583946454','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170584523154','USB flashdisk bootable windows 16GB','69000','109000','1','2017-12-29 11:24:59','admin'),('170587413889','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:24:59','admin'),('170587469109','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-17 09:20:25','admin'),('170592533259','USB flashdisk bootable windows 32GB Dilengkapi Driver Pack 2017','126000','179000','1','2018-01-17 09:20:24','admin'),('170596325174','USB flashdisk bootable windows 16GB','69000','109000','1','2018-01-17 09:20:24','admin'),('170597463839','Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-17 09:20:24','admin'),('170598607369','USB flashdisk bootable windows 32GB Dilengkapi Driver Pack 2017','126000','179000','1','2018-01-17 09:20:24','admin'),('170600459904','USB flashdisk bootable windows 16GB','69000','109000','1','2018-01-17 09:20:24','admin'),('180607413254','USB flashdisk bootable windows 16GB','69000','109000','1','2018-01-17 09:20:24','admin'),('180611343869','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-17 09:20:24','admin'),('180613187214','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-17 09:20:24','admin'),('180613504194','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-17 09:20:24','admin'),('180615052064','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-17 09:20:24','admin'),('180619051969','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','68000','90000','1','2018-01-24 23:52:34','admin'),('180619562524','USB flashdisk bootable windows 32GB Dilengkapi Driver Pack 2017','126000','179000','1','2018-01-24 23:52:34','admin'),('180619713189','USB flashdisk bootable windows 32GB Dilengkapi Driver Pack 2017','126000','179000','1','2018-01-24 23:52:34','admin'),('180621392184','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','68000','90000','1','2018-01-24 23:52:34','admin'),('180623381059','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','68000','90000','1','2018-01-24 23:52:34','admin'),('180623691669','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','68000','90000','1','2018-01-24 23:52:34','admin'),('180627432519','USB flashdisk bootable windows 16GB','68000','109000','1','2018-01-24 23:52:34','admin'),('INV/20171213/XVII/XII/122744910','USB flashdisk bootable windows 16GB','69000','105000','1','2017-12-29 11:29:14','admin'),('INV/20171215/XVII/XII/123087222','USB flashdisk bootable windows 16GB','69000','105000','1','2017-12-29 11:29:14','admin'),('INV/20171216/XVII/XII/123281895','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2017-12-29 11:29:14','admin'),('INV/20171228/XVII/XII/125373254','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-18 12:21:22','ADMIN'),('INV/20171231/XVII/XII/126004272','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-18 12:21:22','ADMIN'),('INV/20180101/XVIII/I/126189958','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-18 12:21:22','ADMIN'),('INV/20180103/XVIII/I/126522432','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-18 12:21:22','ADMIN'),('INV/20180106/XVIII/I/127345553','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-18 12:21:22','ADMIN'),('INV/20180108/XVIII/I/127566283','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-18 12:21:22','ADMIN'),('INV/20180108/XVIII/I/127653321','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-18 12:21:22','ADMIN'),('INV/20180112/XVIII/I/128573648','Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','69000','90000','1','2018-01-18 12:21:22','ADMIN');

/*Table structure for table `penjualan_header` */

DROP TABLE IF EXISTS `penjualan_header`;

CREATE TABLE `penjualan_header` (
  `CategoryId` varchar(10) DEFAULT NULL,
  `Tanggal` datetime DEFAULT '0000-00-00 00:00:00',
  `IDTransaksi` varchar(50) NOT NULL,
  `TransaksiDropshipper` varchar(20) DEFAULT NULL,
  `NamaDropshipper` varchar(50) DEFAULT NULL,
  `DetailDropshipper` varchar(50) DEFAULT NULL,
  `Penjual` varchar(50) DEFAULT NULL,
  `Pembeli` varchar(50) DEFAULT NULL,
  `HPPembeli` varchar(20) DEFAULT NULL,
  `AlamatPembeli` varchar(100) DEFAULT NULL,
  `KecamatanPembeli` varchar(50) DEFAULT NULL,
  `KotaPembeli` varchar(50) DEFAULT NULL,
  `PropinsiPembeli` varchar(50) DEFAULT NULL,
  `KodePosPembeli` varchar(10) DEFAULT NULL,
  `BiayaPengiriman` decimal(10,0) DEFAULT NULL,
  `BiayaAsuransi` decimal(10,0) DEFAULT NULL,
  `TotalTerbayar` decimal(10,0) DEFAULT NULL,
  `Kurir` varchar(50) DEFAULT NULL,
  `KodeTracking` varchar(25) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT '0000-00-00 00:00:00',
  `UpdateUser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IDTransaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualan_header` */

insert  into `penjualan_header`(`CategoryId`,`Tanggal`,`IDTransaksi`,`TransaksiDropshipper`,`NamaDropshipper`,`DetailDropshipper`,`Penjual`,`Pembeli`,`HPPembeli`,`AlamatPembeli`,`KecamatanPembeli`,`KotaPembeli`,`PropinsiPembeli`,`KodePosPembeli`,`BiayaPengiriman`,`BiayaAsuransi`,`TotalTerbayar`,`Kurir`,`KodeTracking`,`Status`,`UpdateDate`,`UpdateUser`) values ('BL','2017-05-27 21:09:06','170427818977','Tidak','-','-','GP Comp','Amin Iskandar','082115656191','Kp. Leuweungmalang Ds. SukaresmiKec. Cikarang Selatan - Bekasi','Cikarang Selatan','Kab. Bekasi','Jawa Barat','17851','9000','0','109000','JNE REG','013610181330217','Diterima & Selesai','2017-12-29 11:24:59','admin'),('BL','2017-06-07 12:39:50','170436584647','Tidak','-','-','GP Comp','irfan','08157741773','Apotek ILNA FARMA jl raya babelan rt 06 rw 01 no 14babelan bekasi','Babelan','Kab. Bekasi','Jawa Barat','17610','9000','0','109000','JNE REG','013610190918317','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-06-10 04:36:41','170438484132','Tidak','-','-','GP Comp','muhammad ardiyani','085393434682','jl. dr. murjani gang kurnia RT: 001 RW: 008 (disamping rumah haji ijai)','Pahandut','Palangkaraya','Kalimantan Tengah','73111','33000','0','133000','JNE REG','013610194476917','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-11 10:59:38','170456336707','Tidak','-','-','GP Comp','Achmad Suherlan','083824927471','achmad suherlanda. H.Sobari Rt 03/03 dusun 02 Desa pabuaran lorKec. Pabuaran - Kab. Cirebon.Kab. Cir','Cirebon Barat','Cirebon','Jawa Barat','45188','11000','0','111000','JNE REG','013610218230317','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-12 12:21:10','170457147292','Tidak','-','-','GP Comp','Rendy Renaldy','08998512555','Dusun Karajan Desa Mekarjaya rt/rw 01/01 Kec Purwasari Kab Karawang','Purwasari','Karawang','Jawa Barat','41373','22000','0','122000','JNE YES','013610218411417','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-15 09:58:47','170459057087','Tidak','-','-','GP Comp','MUJI ALWAAN NAWWAF','081911127117','jalan sultan hasanudin no. 35  toko minyak wangi abu iqbal sebelah pasar.','Tambun Selatan','Kab. Bekasi','Jawa Barat','17510','6000','0','106000','Wahana Tarif Normal','AEL25475','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-17 11:03:34','170460232492','Tidak','-','-','GP Comp','Rido Kurniawan','089660551054','Giant Ekstra Sentul, Funworld lantai 1 ,Jl. M.H. Thamrin (Sentul City), Bogor 16810, Jawa Barat','Citeureup','Kab. Bogor','Jawa Barat','16810','18000','0','118000','JNE YES','013610222689117','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-20 14:41:58','170462408932','Tidak','-','-','GP Comp','Anggiat','082111810498','Jl. anyer 2 no 13 RT 003 RW 02 kelurahan menteng','Menteng','Jakarta Pusat','DKI Jakarta','10310','9000','0','109000','JNE REG','013610227960017','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-21 20:08:31','170463230487','Ya','GP Comp','','GP Comp','ali cell','082113344133','jl.sukarno hattaRt:5','Talisayan','Berau','Kalimantan Timur','77372','82000','0','182000','JNE REG','010570193855617','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-24 22:05:47','170464986472','Tidak','-','-','GP Comp','Anang Wijayanto','081333113587','JL. ROGONOTO GANG MERDEKA 126RT 03 / RW 04 KELURAHAN LOSARISINGOSARI - MALANGJAWA TIMUR','Singosari','Kab. Malang','Jawa Timur','65153','33000','0','133000','JNE REG','013610233109017','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-27 18:17:05','170467165857','Tidak','-','-','GP Comp','okky','0818996559','ruko sedayu square blok C no 22, jl. kamal outer ringroad, cengkareng, jakbar','Cengkareng','Jakarta Barat','DKI Jakarta','11730','9000','0','109000','JNE REG','013610236283117','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-07-28 11:34:08','170467588117','Tidak','-','-','GP Comp','Agustinus Herry','089621233440','Jl. Bojong Koneng - Telaga Murni no.103 RT 003/02 Telaga Murni, Cikarang Barat ( depan makam Telaga ','Cikarang Barat','Kab. Bekasi','Jawa Barat','17520','9000','0','109000','JNE REG','013610237495317','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-08-04 22:19:23','170473455902','Tidak','-','-','GP Comp','dasep nurman','0817221819','abie komputer jln.sukadana no 72 cikajang garut','Cikajang','Garut','Jawa Barat','44171','18000','0','118000','JNE REG','013610247014417','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-08-08 08:16:19','170475784257','Tidak','-','-','GP Comp','Yudho','08567877429','jl Anggrek 3 no 25, kompleks Larangan Indah, Ciledug, Tangerang','Larangan','Tangerang','Banten','15154','18000','0','118000','JNE YES','013610249710717','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-08-11 13:45:32','170478316857','Tidak','-','-','GP Comp','Dadang','083805655077','jl. Kramat asem raya no.4   Rt05/Rw04 utankayu jakarta timur','Matraman','Jakarta Timur','DKI Jakarta','13120','9000','0','109000','JNE REG','013610254649317','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-08-14 13:17:50','170480121102','Tidak','-','-','GP Comp','ASEP SUPRIATNA','085798582848','KANTOR PDAM TIRTA BUMI WIBAWA KOTA SUKABUMI  Jl. Kadudampit Km. 1,4 Nagrak Jambatan Ds. Sukasari RT.','Cisaat','Kab. Sukabumi','Jawa Barat','43152','10000','0','110000','JNE REG','013610143975217','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-08-15 12:01:38','170480774357','Tidak','-','-','GP Comp','ibnu sabit','082322297790','dk.kaligadung rt 01 rw 03,penggarutan,bumiayu','Bumiayu','Brebes','Jawa Tengah','52273','21000','0','121000','JNE REG','013610258168517','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-08-18 12:33:24','170482655657','Tidak','-','-','GP Comp','Aditya Wiranda','081319543058','Gedung menara bank BTN Jl. Gajah Mada no 1 lantai 11 Sharia DivisonDKI Jakarta - Kota Jakarta Pusat ','Gambir','Jakarta Pusat','DKI Jakarta','10130','9000','0','109000','JNE REG','013610261328617','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-12 09:50:58','170501499087','Tidak','-','-','GP Comp','HERMAN','089601130340','Jln.L  RT 004/04 No.40Kel: Slipi','Palmerah','Jakarta Barat','DKI Jakarta','11410','9000','0','109000','JNE REG','013610290105417','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-13 20:02:34','170502678392','Tidak','-','-','GP Comp','m nanang fauzi','081931890999','Jl.soekarno hatta no.442 Bandung, PT. LEN persero - gedung T lantai 2 ( LRS )','Batununggal','Bandung','Jawa Barat','40254','11000','0','111000','JNE REG','010570220423017','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-15 12:18:59','170503816777','Tidak','-','-','GP Comp','Ivan Loga','085369777700','(DI AMBIL SENDIRI)JNE TUGUMULYO 2 LOGA CELL (DEPAN BANK MUAMALAT)jl.lintas timur pasar tugu mulyo','Palembang','Palembang','Sumatera Selatan','30657','22000','0','122000','JNE REG','010570221843017','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-18 13:17:27','170505792422','Tidak','-','-','GP Comp','Muhammad Hasan','085715182101','Jl. Kepu dalam X , ( SDN Kemayoran 01 Pagi ) Kel. Kemayoran  Jakarta Pusat','Kemayoran','Jakarta Pusat','DKI Jakarta','10620','9000','0','109000','JNE REG','013530007020117','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-20 17:55:23','170507783902','Tidak','-','-','GP Comp','iyus','083870665570','jl.lodan raya,komplek lodan center blok i5','Pademangan','Jakarta Utara','DKI Jakarta','14430','9000','0','109000','JNE REG','013530001378217','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-25 01:07:15','170511038842','Tidak','-','-','GP Comp','Dany Kurniawan','081296956290','PT Waskita Karya zona HK-3 ,Desa Gedong Srimulyo ( samping balai desa)','Way Serdang','Mesuji','Lampung','34999','47000','0','132000','JNE REG','013530000424817','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-26 09:22:37','170512040647','Tidak','-','-','GP Comp','SAEPUL MISBAH','083818200005','Jl. Bangbayang, Kp. Cipari, RT 03, RW 02, Desa Cisaat','Cicurug','Kab. Sukabumi','Jawa Barat','43159','17000','0','107000','JNE REG','013610305443117','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-26 22:14:50','170512709847','Tidak','-','-','GP Comp','Eko prasetio budi','082375489888','Jl raya balimbing/jalan raya gisting, Gisting Bawah blok 2 dusun 4 rt 012 rw 006. Kel. Gisting bawah','Gisting','Tanggamus','Lampung','35678','18685','0','108685','Pos Kilat Khusus','15593538592','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-27 18:16:43','170513369587','Tidak','-','-','GP Comp','Denny Armansyah','08121091207','Citra Gran Cluster Central Garden G-19 / 30 Cibubur.','Jatisampurna','Bekasi','Jawa Barat','17435','8080','0','98080','Pos Kilat Khusus','15593539037','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-28 14:47:08','170514058437','Tidak','-','-','GP Comp','Yan Rinaldi','081808908532','Mutiara Gading Timur Blok Q3 No.27','Mustika Jaya','Bekasi','Jawa Barat','17158','9000','0','118000','JNE REG','013610308280117','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-09-28 15:30:04','170514095052','Tidak','-','-','GP Comp','iksan','081319907417','Rt. 002/03 Cilandak Timur Pasar Minggu','Pasar Minggu','Jakarta Selatan','DKI Jakarta','12560','9000','0','118000','JNE REG','013610312251817','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-10-01 14:01:27','170516241477','Tidak','-','-','GP Comp','noval / nvlcloth','081379352794','air perikan, jl. cekdin depan sekolah Mts dari hikmah, kel. nendagung','Pagar Alam Selatan','Pagar Alam','Sumatera Selatan','31527','33000','0','123000','JNE REG','013530005450417','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-10-01 19:57:02','170516451637','Tidak','-','-','GP Comp','AHMAD SARMILI','08111732123','RAWA BEBEK RT007/12 N105 KOTABARU BEKASI','Bekasi Barat','Bekasi','Jawa Barat','17139','9000','0','99000','JNE REG','013530005122217','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-10-02 04:56:40','170516694192','Tidak','-','-','GP Comp','abraham leatemia','081212987484','jl karet karya 1 no 11 tt 04 rw 02','Setiabudi','Jakarta Selatan','DKI Jakarta','12910','9000','0','118000','JNE REG','013530006553817','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-10-03 11:26:55','170517841282','Tidak','-','-','GP Comp','ANDRI ISWANTO','085733337522','Perumahan Graha Eksekutif no.5, Latsari VI, Latsari, Tuban - 62314.','Tuban','Tuban','Jawa Timur','62314','24000','0','133000','JNE REG','013530007728617','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-10-07 17:44:26','170521236262','Tidak','-','-','GP Comp','Rahmat Arif Nugroho','085213469722','Perum d parahyangan blok e no.7 RT.04 RW.03 desa Wadas','Telukjambe Timur','Karawang','Jawa Barat','41361','10000','0','100000','JNE REG','010900390397417','Diterima & Selesai','2017-12-29 11:24:58','admin'),('BL','2017-10-07 22:30:02','170521378842','Tidak','-','-','GP Comp','muherwan','081370130329','PLN Area Rantauprapat Jln.Listrik No.1 Rantauprapat','Rantau Utara','Labuhanbatu','Sumatera Utara','21411','50000','0','140000','JNE REG','010900390396517','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-14 14:33:08','170526777622','Tidak','-','-','GP Comp','dendy','085883664698','jln gelatik no 105 rt02 rw003 kelurahan sawah kecamatan ciputat','Ciputat','Tangerang Selatan','Banten','15414','19000','0','128000','J&T REG','888040659027','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-20 09:03:31','170531247302','Tidak','-','-','GP Comp','chery','089676601006','PERUM TAMAN GRIYAJL.DANAU TAMBLINGAN XII NO 11 KELURAHAN JIMBARAN','Kuta Selatan','Badung','Bali','80361','35000','0','125000','J&T REG','JD0001825743','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-20 16:28:02','170531619107','Tidak','-','-','GP Comp','zulhamsyah sinaga','085373560687','jln.mulawarman no. 08 rt. 46 tarakan, kalimantan utara (PT. united tractors) zulhamsyah sinaga,08537','Tarakan Barat','Tarakan','Kalimantan Utara','77111','30000','0','120000','Wahana Tarif Normal','AFQ43867','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-21 19:28:53','170532466362','Tidak','-','-','GP Comp','Budianto','08156091221','Jl. Situ Aksan No. 31','Babakanciparay','Bandung','Jawa Barat','40221','11000','0','120000','J&T REG','888046694385','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-22 19:50:12','170533126702','Tidak','-','-','GP Comp','TOTO ARIANTO','081315802251','PT.Siko Nakamura Dwi Karya.Kawasan Pancatama Blok E57,Kel Leuwilimus,Kec Cikande.Kabupaten Serang Ba','Cikande','Kab. Serang','Banten','42186','14000','0','104000','J&T REG','JD0001869903','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-23 10:40:42','170533508792','Tidak','-','-','GP Comp','nanang','081394849680','SMK YBKP3 GARUT JL TERUSAN PEMBANGUNAN NO.692 PATARUMAN GARUT  44151','Tarogong Kidul','Garut','Jawa Barat','44151','14000','0','123000','J&T REG','JD0001870114','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-23 18:49:55','170533927212','Tidak','-','-','GP Comp','Kemal','085282505200','jl. abragem blok E-06 RT/RW 02/04','Wonosobo','Wonosobo','Jawa Tengah','56311','22220','0','112220','Pos Kilat Khusus','15822644416','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-25 23:07:03','170535854987','Tidak','-','-','GP Comp','Agusman','0811429890','Gading Serpong Sektor 1D, Jl. Kelapa Kopyor 3, Blok CA 4, No: 9-10','Kelapa Dua','Kab. Tangerang','Banten','15810','6000','0','115000','Wahana Tarif Normal','AFS06736','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-28 22:10:28','170538388147','Tidak','-','-','GP Comp','Anwar/Lathifah','085104638402','Desa klagen serut rt 17 rw5 dukuh ngerco kec jiwan kab Madiun','Jiwan','Kab. Madiun','Jawa Timur','63161','26000','0','135000','J&T REG','JD0002032455','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-10-29 08:06:49','170538536327','Tidak','-','-','GP Comp','Fajri Altsani','08996950013','Kaliabang Tengah - Jl. Kelinci 2 - Rt/Rw : 007/015 - No : 23','Bekasi Utara','Bekasi','Jawa Barat','17125','10000','0','100000','J&T REG','JD0002032456','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-03 11:33:29','170543350777','Tidak','-','-','GP Comp','Aditya Wiranda','081319543058','Gedung menara bank BTN Jl. Gajah Mada no 1 lantai 11 Sharia DivisonDKI Jakarta - Kota Jakarta Pusat ','Gambir','Jakarta Pusat','DKI Jakarta','10130','9000','0','118000','JNE REG','010900392171217','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-06 01:23:10','170545492682','Tidak','-','-','GP Comp','ruli gartika','081221346125','jl. golf no.b-14 ujungberung','Arcamanik','Bandung','Jawa Barat','40294','11000','0','101000','J&T REG','JD0002291592','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-06 23:33:12','170546469217','Tidak','-','-','GP Comp','Subani','081281655642','Asrama yonif 203/AK jln Gatot Subroto km6 rw 01 RT 10 Kel Gandasari','Jatiuwung','Tangerang','Banten','15137','10000','0','100000','J&T REG','JD0002329457','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-07 09:56:54','170546740572','Tidak','-','-','GP Comp','Beni Abdillah. CV RAU','085223522507','Salamnunggal. Rt/Rw. 01/08. Sirnagalih','Indihiang','Tasikmalaya','Jawa Barat','46151','13000','0','103000','TIKI Reg','030081226589','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-08 11:14:31','170547906357','Tidak','-','-','GP Comp','agus','081286322539','java phone ,pulogadung trade center Lt.1 Blok A no.23,jl.raya bekasi-jakarta timur','Duren Sawit','Jakarta Timur','DKI Jakarta','13460','18000','0','108000','JNE YES','010900392480817','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-10 16:11:37','170550108052','Tidak','-','-','GP Comp','Yanto','085695183122','jalan raya bogor km 33,gang sawo rt 06/02 no 43','Cimanggis','Depok','Jawa Barat','16453','9000','0','99000','JNE REG','013610356232917','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-10 16:31:28','170550125412','Tidak','-','-','GP Comp','Anang Wijayanto','081333113587','JL. ROGONOTO GANG MERDEKA 126RT 03 / RW 04 KELURAHAN LOSARISINGOSARI - MALANGJAWA TIMUR','Singosari','Kab. Malang','Jawa Timur','65153','33000','0','142000','J&T REG','888048126776','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-13 10:41:16','170552439977','Tidak','-','-','GP Comp','Eksi Prasetyaningrum','085349595009','Jl Musang Blok ii No 8 RT 18 BTN Pupuk Kaltim','Bontang Utara','Bontang','Kalimantan Timur','75313','69000','0','159000','J&T REG','JD0002510164','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-13 21:00:17','170553020487','Tidak','-','-','GP Comp','Sutrisno','085273551116','dusun 1 suka mulya rt002 rw001 kelurahan suka mulya','Lempuing','Ogan Komering Ilir','Sumatera Selatan','30657','42000','0','151000','J&T REG','JD0002547893','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-14 14:44:01','170553695382','Tidak','-','-','GP Comp','Rolandius','081225132287','Tanggul Mas Timur 137','Semarang Utara','Semarang','Jawa Tengah','50177','18000','0','127000','J&T REG','JD0002547894','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-16 05:59:48','170555209037','Tidak','-','-','GP Comp','Iskandar','089685742426','Jati baru -  bubulak kel. Tanjungpura kec. Karawang barat rt. 02 rw. 07 no. 26','Karawang Barat','Karawang','Jawa Barat','41316','10000','0','119000','J&T REG','JD0002613424','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-16 19:17:59','170555919242','Tidak','-','-','GP Comp','Adhe Syafi\'i Ridwan','087879393690','MA Nihayatul Amal Rawamerta (Belakang Polsek Rawamerta), Jl Kaum Ash Shodiqien Komplek Pondok Pesant','Rawamerta','Karawang','Jawa Barat','41382','10000','0','100000','JNE REG','010900393489717','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-16 19:21:59','170555922562','Tidak','-','-','GP Comp','Adhe Syafi\'i Ridwan','087879393690','MA Nihayatul Amal Rawamerta (Belakang Polsek Rawamerta), Jl Kaum Ash Shodiqien Komplek Pondok Pesant','Rawamerta','Karawang','Jawa Barat','41382','10000','0','119000','JNE REG','010900393489717','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-19 21:11:08','170558624207','Tidak','-','-','GP Comp','Hayatuddin','085888358199','Jl.Angsana Dalam No.47c Rt.005/05','Kebon Jeruk','Jakarta Barat','DKI Jakarta','11530','9000','0','118000','JNE REG','010900393393217','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-20 15:59:49','170559431252','Tidak','-','-','GP Comp','Dhenatika (Ibu Dhyas)','081316328753','Kp berkat RT 02/RW 01(Belakang Agen JNE 192), Kalisuren','Tajurhalang','Kab. Bogor','Jawa Barat','16320','9000','0','118000','JNE REG','010900393777817','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-23 10:32:15','170562069642','Tidak','-','-','GP Comp','Heru Khaerul Rohman','085222930233','Bengkel bpk waryat,blok badak Rt/Rw 010/002 Desa mundak jaya.','Cikedung','Indramayu','Jawa Barat','45262','10000','0','119000','Wahana Tarif Normal','AGB37232','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-25 08:42:48','170563759714','Tidak','-','-','GP Comp','ERLANGGA TIRTA AGUSTINUS','083865595535','Alamat: Jalan Kyai Haji Wahid Hasyim No. 101 - 103, Karangklesem, Purwokerto, Jawa Tengah 53144, Ind','Banyumas','Banyumas','Jawa Tengah','53144','27000','0','136000','J&T REG','JD0002867485','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-26 14:16:04','170564913204','Tidak','-','-','GP Comp','fahmi fachri','081311171721','jl. bukit raya, perumahan roswood garden blok F no 8  , serua indah, ciputat , tangerang selatan','Ciputat','Tangerang Selatan','Banten','15414','9000','0','99000','JNE REG','010900394200317','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-11-27 12:25:52','170565864864','Tidak','-','-','GP Comp','Don Adjie Poerwanto','081909304555','Jl. Jend. Sudirman No. 16','Purwakarta','Purwakarta','Jawa Barat','41114','14000','0','123000','J&T REG','JD0002940516','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-02 13:28:31','170571264529','Tidak','-','-','GP Comp','Ahmad Bashir','085692085114','Taman Gebang Raya Blok K5 Rt 04 Rw 06 Kel.Gebang Raya Kec.Periuk Kota Tangerang Prov.Banten 15132','Periuk','Tangerang','Banten','15132','9000','0','118000','JNE REG','013610380537117','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-04 13:39:00','170573190819','Tidak','-','-','GP Comp','andre','08562980711','Jl. Swadaya Kp. Rw. Badung No. 27B, RT/RW 004/013 kel, Jatinegara, kec, Cakung, Kota Jakarta Timur, ','Cakung','Jakarta Timur','DKI Jakarta','13930','18000','0','127000','JNE YES','010900394572317','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-06 11:59:01','170575351214','Tidak','-','-','GP Comp','Ayub','081319534973','Jl. Bhineka No. 13 RT 001/02','Ciputat','Tangerang Selatan','Banten','15411','10000','0','100000','J&T REG','JD0003260623','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-08 11:20:43','170577386764','Tidak','-','-','GP Comp','kurniaraffa','082136302900','jl asparagus no 1f rt.04 rw.10 sukabumi utara kebonjeruk jakarta barat','Kebon Jeruk','Jakarta Barat','DKI Jakarta','11540','10000','0','119000','J&T REG','JD0003346078','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-10 12:48:52','170579271924','Tidak','-','-','GP Comp','ridwan','081584015988','Allegra residence, jln. kemang raya no. 59 (samping bang BCA)','Mampang Prapatan','Jakarta Selatan','DKI Jakarta','12730','10000','0','119000','J&T REG','JD0003436673','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-12 20:07:14','170582319439','Tidak','-','-','GP Comp','Dul Ikhrom','087885598025','Gedung bank panin senayan lt.7 Jl. Jend sudirman jakarta pusat jakarta 10270( bunderan senayan victo','Tanah Abang','Jakarta Pusat','DKI Jakarta','10270','9000','0','99000','JNE REG','010900395354417','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-13 22:21:52','170583946454','Tidak','-','-','GP Comp','SHINTA DEVI','082133079557','Jl.cisalak Perum Cisalak Pratama No.28A','Cipedes','Tasikmalaya','Jawa Barat','46131','13000','0','103000','TIKI Reg','030084113849','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-14 11:39:22','170584523154','Tidak','-','-','GP Comp','Bara Raka Aditya','085237176246','jalan adi santoso,  gang kentang, kost bpk kasim, kel. ardirejo, kec. kepanjen, kab.Malang, jawa tim','Kepanjen','Kab. Malang','Jawa Timur','65163','26000','0','135000','J&T REG','JD0003585280','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-16 15:48:29','170587413889','Tidak','-','-','GP Comp','putra ucke','081288997272','Aeon credit service indonesiaPlaza Kuningan, Menara Selatan, 3A Floor, Jl. HR. Rasuna Said Kav. C11 ','Setiabudi','Jakarta Selatan','DKI Jakarta','12940','9000','0','99000','JNE REG','010900395828217','Diterima & Selesai','2017-12-29 11:24:57','admin'),('BL','2017-12-16 16:52:00','170587469109','Tidak','-','-','GP Comp','Bp. Paksi','081226939642','Jatisari Indah Blok A8 No.10Mangga V RT3 RW5Perumahan BSB-Jatisari Mijen Semarang Barat','Mijen','Semarang','Jawa Tengah','50275','18000','0','108000','JNE REG','010900395355317','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2017-12-21 11:14:54','170592533259','Tidak','-','-','GP Comp','Khaidir','085211225558','Jl.Anggrek Rosliana IV No.29 Rt.007 Rw.005  Kemanggisan Palmerah','Palmerah','Jakarta Barat','DKI Jakarta','11480','9000','0','188000','TIKI Reg','030084861798','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2017-12-25 11:55:55','170596325174','Tidak','-','-','GP Comp','Ehrse Dwi Winastyo','08161940660','Jl. Gili Sampeng No. 36 C. RT.011 RW.005Kebon Jeruk','Kebon Jeruk','Jakarta Barat','DKI Jakarta','11530','10000','0','119000','J&T REG','JD0003978973','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2017-12-26 14:08:42','170597463839','Ya','mozastore','0895353448448','GP Comp','D.net','087818308398','Jl. Tanjung Raya II komp. delima mas no. A1  kel. saigon.','Pontianak Timur','Pontianak','Kalimantan Barat','78232','30000','0','120000','JNE REG','013610417321117','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2017-12-27 14:57:49','170598607369','Tidak','-','-','GP Comp','Mega Suryono Putri','081319642982','Kp. Sasaktiga Jl. Jati Kubang Hebras Bawah No. 108 Ds. Tridayasakti RT 004/ RW 005  Kecamatan Tambun','Bekasi Timur','Bekasi','Jawa Barat','17510','10000','0','189000','J&T REG','888054449580','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2017-12-29 10:33:30','170600459904','Tidak','-','-','GP Comp','Yuli mama Tasya','081510002214','Jalan Karang Satria Raya Perumahan Royale Residence Blok C No 9','Tambun Utara','Kab. Bekasi','Jawa Barat','17510','9000','0','118000','JNE REG','010900397060517','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2018-01-04 14:50:07','180607413254','Tidak','-','-','GP Comp','M. Zainuddin','08881634156','Jl. Aljauhari 1 no.68 RT.011/003 Kalisari, Pasar Rebo, Jakarta Timur','Pasar Rebo','Jakarta Timur','DKI Jakarta','13790','18000','0','127000','JNE YES','013610005043118','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2018-01-07 19:49:41','180611343869','Tidak','-','-','GP Comp','Tonny Atwinda Supriyadi','085778896713','Perumahan Gramapuri PersadaBlok U7 No.9Ds. Sukajaya, Rt 01 Rw 17Kec. Cibitung, Kab. Bekasi','Cibitung','Kab. Bekasi','Jawa Barat','17521','9000','0','99000','JNE REG','010900000500318','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2018-01-09 07:55:42','180613187214','Tidak','-','-','GP Comp','hendra','081297296364','perumahan Graha harapan blok e14 no 41','Mustika Jaya','Bekasi','Jawa Barat','17165','9000','0','99000','JNE REG','013950005042018','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2018-01-09 11:20:58','180613504194','Tidak','-','-','GP Comp','Agung Setyo Wibowo','083830323264','Jeruk Gg. Tengah no. 70 rt. 02/rw. 02','Lakarsantri','Surabaya','Jawa Timur','60212','19000','0','109000','J&T REG','888040639253','Diterima & Selesai','2018-01-17 09:20:24','admin'),('BL','2018-01-10 13:28:42','180615052064','Tidak','-','-','GP Comp','linda prastiyoso','081234514510','jl.menganti babatan 5f no26 rt07/rw01 kel babatan','Wiyung','Surabaya','Jawa Timur','60227','19000','0','109000','JNE REG','010900000927818','Diterima & Selesai','2018-01-17 09:20:23','admin'),('BL','2018-01-13 11:43:29','180619051969','Tidak','-','-','GP Comp','Reihanza','085691271833','Perumahan Griya Serpong Asri Blok K1 No 6 RT 07 RW 07 Suradita (Samping Masjid Miftahussalam)','Cisauk','Kab. Tangerang','Banten','15343','10000','0','100000','J&T REG','JD0004715351','Diterima & Selesai','2018-01-24 23:52:34','admin'),('BL','2018-01-13 19:40:55','180619562524','Tidak','-','-','GP Comp','Afif Eka Indrayana','085800242978','Ngegot Rt.05/Rw.01, Sumberagung','Klego','Boyolali','Jawa Tengah','57385','20000','0','199000','Wahana Tarif Normal','AGU46064','Diterima & Selesai','2018-01-24 23:52:34','admin'),('BL','2018-01-13 22:24:03','180619713189','Tidak','-','-','GP Comp','stephanus andrian yudistira','082257606186','smk pancasila tambolaka, Ds radamata','Tambolaka','Sumba Barat Daya','Nusa Tenggara Timur','87255','69000','0','248000','TIKI Reg','16321814117','Diterima & Selesai','2018-01-24 23:52:34','admin'),('BL','2018-01-15 08:44:41','180621392184','Tidak','-','-','GP Comp','sutamar','081216045124','pt.sejahtera buana trada (dealer suzuki mobil)jl.sultan agung,pondok ungu, rt 006/07medan satria - h','Medan Satria','Bekasi','Jawa Barat','17182','10000','0','100000','J&T REG','JD0004785653','Diterima & Selesai','2018-01-24 23:52:33','admin'),('BL','2018-01-16 13:19:02','180623381059','Tidak','-','-','GP Comp','ery mustofa','085869259690','perum sukoharjo indah, jl.madukara 1 blok F17.ds. sukoharjo','Margorejo','Pati','Jawa Tengah','59163','27000','0','117000','J&T REG','888054241004','Diterima & Selesai','2018-01-24 23:52:33','admin'),('BL','2018-01-16 17:11:50','180623691669','Tidak','-','-','GP Comp','Muhammad Rinaldi (Aal)','087773176380','Perumahan Duta Indah Residence cluster dolomite blok d1 no 40 kelurahan gebang raya','Periuk','Tangerang','Banten','15132','15000','0','105000','TIKI ONS','030086580611','Diterima & Selesai','2018-01-24 23:52:33','admin'),('BL','2018-01-19 09:23:18','180627432519','Tidak','-','-','GP Comp','edi wahid','087872029025','Jl. Jabaru IV No.7 Pasirkuda','Bogor Barat','Bogor','Jawa Barat','16119','5000','0','114000','Wahana Tarif Normal','AGW13275','Diterima & Selesai','2018-01-24 23:52:33','admin'),('TP','2017-12-13 14:18:22','INV/20171213/XVII/XII/122744910','Tidak','-','-','GP Comp','Ari Sigit Sulistyo','081575575539','Kantor PDAM Tirta Kajen Jl. Singosari No 732 Kajen','Kajen','Pekalongan','Jawa Tengah','51161','21000','0','126000','JNE REG','013610401580117','Diterima & Selesai','2017-12-29 11:29:14','admin'),('TP','2017-12-15 08:12:22','INV/20171215/XVII/XII/123087222','Tidak','-','-','GP Comp','juventus Man','082298684611','jln masjid al makmur rt 09 rw 08 n0 41 (patokannya deket rumah pak RT 09','Pasar Minggu','Jakarta Selatan','DKI Jakarta','12510','18000','0','123000','JNE YES','010900395719417','Diterima & Selesai','2017-12-29 11:29:14','admin'),('TP','2017-12-16 08:24:22','INV/20171216/XVII/XII/123281895','Tidak','-','-','GP Comp','stefven','08118856660','jalan cipto mangunkusumo no.76 (seberang sd negri kauman)','Jepara','Jepara','Jawa Tengah','59417','21000','0','111000','JNE REG','013950108996817','Diterima & Selesai','2017-12-29 11:29:14','admin'),('TP','2017-12-28 08:25:22','INV/20171228/XVII/XII/125373254','Tidak','-','-','GP Comp','Herru Chaerudin','81380169555','PDAM Kota Bogor Jl. Siliwangi No 121 (Bagisn SPI)','Bogor Timur','Bogor','Jawa Barat','16142','9000','0','99000','JNE REG','1.09004E+13','Diterima & Selesai','2018-01-18 12:21:22','ADMIN'),('TP','2017-12-31 07:39:00','INV/20171231/XVII/XII/126004272','Tidak','-','-','GP Comp','NAILIE AZIZAH','81334314486','JL. PANJI SUROSO PERUM PURI KARTIKA ASRI BLOK I-1 KEL. PURWODADI','BLIMBING','Malang','Jawa Timur','65125','22000','0','112000','J&T - Reguler','JD0004194817','Diterima & Selesai','2018-01-18 12:21:22','ADMIN'),('TP','2018-01-01 13:34:22','INV/20180101/XVIII/I/126189958','Tidak','-','-','GP Comp','Nana Supriatna','81395000478','Karang Anyar Rt. 01 Rw. 27 Desa Nagasari','Karawang Barat','Karawang','Jawa Barat','41312','22000','0','112000','JNE YES','1.361E+13','Diterima & Selesai','2018-01-18 12:21:22','ADMIN'),('TP','2018-01-03 09:16:22','INV/20180103/XVIII/I/126522432','Tidak','-','-','GP Comp','EMA','85694885745','JALAN MATRAMAN DALAM III N0.38 RT.009/RW.07 KELURAHAN PEGANGSAAN','Menteng','Jakarta Pusat','DKI Jakarta','10320','9000','0','99000','JNE REG','1.09E+13','Diterima & Selesai','2018-01-18 12:21:22','ADMIN'),('TP','2018-01-06 23:04:22','INV/20180106/XVIII/I/127345553','Tidak','-','-','GP Comp','Vicky Hermawan','8999510520','Perum Villa Pertiwi , blok H3 no.2','Cilodong','Depok','Jawa Barat','16415','9000','0','99000','JNE REG','1.09E+13','Diterima & Selesai','2018-01-18 12:21:22','ADMIN'),('TP','2018-01-08 10:41:22','INV/20180108/XVIII/I/127566283','Tidak','-','-','GP Comp','Tony Yuda','811104289','Jl. Waribang no. 9','Kesiman Petilan','Denpasar Timur','Bali','80237','22000','0','112000','JNE REG','1.09004E+13','Diterima & Selesai','2018-01-18 12:21:22','ADMIN'),('TP','2018-01-08 15:07:22','INV/20180108/XVIII/I/127653321','Tidak','-','-','GP Comp','ADITYA SAPUTRA','82113598077','PT. PLN(PERSERO) APP CAWANG (GEDUNG PDKB), JL. CILILITAN BESAR NO.1','CILILITAN','JAKARTA TIMUR','DKI Jakarta','13640','18000','0','108000','JNE YES','1.09004E+13','Diterima & Selesai','2018-01-18 12:21:22','ADMIN'),('TP','2018-01-12 18:18:00','INV/20180112/XVIII/I/128573648','Tidak','-','-','GP Comp','John Mada','85239244029','Jl Bajawa Blok I No. 1 Fatululi','Oebobo','Kupang','Nusa Tenggara Timur','85111','55000','0','145000','J&T - Reguler','JD0004687155','Diterima & Selesai','2018-01-18 12:21:22','ADMIN');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NamaProduk` varchar(250) DEFAULT NULL,
  `HargaBeliProduk` decimal(10,0) DEFAULT NULL,
  `HargaJualProduk` decimal(10,0) DEFAULT NULL,
  `MulaiJual` date DEFAULT '0000-00-00',
  `Gambar` varchar(50) DEFAULT NULL,
  `Status` varchar(1) DEFAULT NULL,
  `LastUpdate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

insert  into `produk`(`id`,`NamaProduk`,`HargaBeliProduk`,`HargaJualProduk`,`MulaiJual`,`Gambar`,`Status`,`LastUpdate`,`UpdateBy`) values (1,'USB flashdisk bootable windows 16GB','68000','109000','2017-05-27',NULL,'Y','2018-01-24 23:47:43','1'),(2,'Paket Software Design Corel - photoshop - autocad USB Flashdisk Sandisk 16GB','68000','90000','2017-09-24',NULL,'Y','2018-01-24 23:47:58','1'),(3,'Driver Pack Solution 2017 USB Flashdisk Sandisk 16GB','68000','90000','2017-09-24',NULL,'Y','2018-01-24 23:48:09','1'),(4,'USB Flashdisk Bootable Windows 32GB Dilengkapi Driver Pack 2017','126000','179000','2017-12-14',NULL,'Y','2018-01-18 10:43:01','1'),(5,'Paket Software Multimedia - After Effects - Premiere Pro USB Flashdisk Sandisk 16GB','68000','90000','2017-01-12',NULL,'Y','2018-01-24 23:48:21','1');

/*Table structure for table `setup_no` */

DROP TABLE IF EXISTS `setup_no`;

CREATE TABLE `setup_no` (
  `Tahun` varchar(12) DEFAULT NULL,
  `no_receiving` int(11) DEFAULT NULL,
  `no_struk` int(11) DEFAULT NULL,
  `no_retur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `setup_no` */

insert  into `setup_no`(`Tahun`,`no_receiving`,`no_struk`,`no_retur`) values ('2017',2500025,2600001,2700001),('2018',2500002,NULL,NULL);

/*Table structure for table `tmovedtl` */

DROP TABLE IF EXISTS `tmovedtl`;

CREATE TABLE `tmovedtl` (
  `move_doc` varchar(10) NOT NULL,
  `line_id` int(5) NOT NULL,
  `mat_id` varchar(18) NOT NULL,
  `plant_id` varchar(4) NOT NULL,
  `sloc` varchar(4) NOT NULL,
  `riplant_id` varchar(4) DEFAULT NULL,
  `risloc` varchar(4) DEFAULT NULL,
  `equip_id` varchar(18) NOT NULL,
  `serial_no` varchar(18) NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `amount_lc` decimal(12,2) NOT NULL,
  `curr` varchar(3) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(10) DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`move_doc`,`line_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tmovedtl` */

insert  into `tmovedtl`(`move_doc`,`line_id`,`mat_id`,`plant_id`,`sloc`,`riplant_id`,`risloc`,`equip_id`,`serial_no`,`qty`,`price`,`amount_lc`,`curr`,`created_by`,`created_on`,`updated_by`,`updated_on`) values ('2500001',1,'mat11','A001','L002',NULL,NULL,'222','333','1.00','5000.00','5000.00','IDR','admin','2018-01-03 13:27:16',NULL,'2018-01-03 13:27:16'),('2500020',1,'mat11','A001','L002',NULL,NULL,'112','113','1.00','5000.00','5000.00','','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),('2500020',2,'mat11','A001','L002',NULL,NULL,'113','114','1.00','6000.00','6000.00','','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),('2500021',1,'mat11','A001','L002',NULL,NULL,'114','115','1.00','500.00','500.00','','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),('2500021',2,'mat13','A001','L002',NULL,NULL,'116','117','1.00','5000.00','5000.00','','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),('2500022',1,'mat4','A001','L002',NULL,NULL,'117','118','1.00','600.00','600.00','','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),('2500022',2,'mat4','A001','L002',NULL,NULL,'118','119','1.00','6000.00','6000.00','','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),('2500022',3,'mat4','A001','L001',NULL,NULL,'119','1100','1.00','4000.00','4000.00','','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),('2500023',1,'mat3','A001','L002',NULL,NULL,'2500','6000','1.00','1000.00','1000.00','IDR','admin','2017-12-12 10:47:14',NULL,'0000-00-00 00:00:00'),('2500023',2,'mat13','A001','L002',NULL,NULL,'2400','600','1.00','10000.00','10000.00','IDR',NULL,'0000-00-00 00:00:00','admin','2017-12-12 10:48:16'),('2500024',1,'mat3','A001','L002',NULL,NULL,'50015','54545','1.00','6000.00','6000.00','IDR','admin','2017-12-12 15:12:34',NULL,'2017-12-12 15:12:34');

/*Table structure for table `tmoveheader` */

DROP TABLE IF EXISTS `tmoveheader`;

CREATE TABLE `tmoveheader` (
  `move_doc` varchar(10) NOT NULL,
  `move_date` datetime NOT NULL,
  `posting_date` datetime NOT NULL,
  `move_type` varchar(3) NOT NULL,
  `order_doc` varchar(10) NOT NULL,
  `shipped_from` varchar(20) NOT NULL,
  `si_doc` varchar(10) NOT NULL,
  `shipped_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vendor_id` varchar(10) NOT NULL,
  `po_no` varchar(20) NOT NULL,
  `header_tx` varchar(40) NOT NULL,
  `reference` varchar(40) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(10) DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`move_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tmoveheader` */

insert  into `tmoveheader`(`move_doc`,`move_date`,`posting_date`,`move_type`,`order_doc`,`shipped_from`,`si_doc`,`shipped_date`,`vendor_id`,`po_no`,`header_tx`,`reference`,`status`,`created_by`,`created_on`,`updated_by`,`updated_on`) values ('2500001','2018-01-03 00:00:00','2018-01-03 00:00:00','101','55','','','2018-01-03 00:00:00','cust01','1122','','','0','admin','2018-01-03 13:27:16','admin','2018-01-03 13:27:16'),('2500020','2017-12-11 00:00:00','2017-12-11 00:00:00','101','001','','','2017-12-11 15:58:12','cust01','P01','','','1','admin','2017-12-11 15:58:00',NULL,'0000-00-00 00:00:00'),('2500021','2017-12-11 00:00:00','2017-12-11 00:00:00','101','002','','','2017-12-11 16:00:38','cust01','P02','','','1','admin','2017-12-11 16:00:18',NULL,'0000-00-00 00:00:00'),('2500022','2017-12-11 00:00:00','2017-12-11 00:00:00','101','003','','','2017-12-11 16:04:23','cust01','P03','','','1','admin','2017-12-11 16:03:26',NULL,'0000-00-00 00:00:00'),('2500023','2017-12-12 00:00:00','2017-12-12 00:00:00','101','004','k','','2017-12-12 00:00:00','cust01','P04','','','0','admin','2017-12-12 10:47:14',NULL,'0000-00-00 00:00:00'),('2500024','2017-12-12 00:00:00','2017-12-12 00:00:00','101','004','','','2017-12-12 15:12:37','cust01','P05','','','1','admin','2017-12-12 15:12:34','admin','2017-12-12 15:12:37');

/*Table structure for table `tmutation` */

DROP TABLE IF EXISTS `tmutation`;

CREATE TABLE `tmutation` (
  `no_mutation` int(6) NOT NULL AUTO_INCREMENT,
  `mutation_date` date NOT NULL,
  `type` char(1) NOT NULL COMMENT 'I=Input O=output',
  `mat_doc` int(11) NOT NULL,
  `move_type` varchar(5) NOT NULL,
  `plant_id` varchar(4) DEFAULT NULL,
  `sloc` varchar(4) DEFAULT NULL,
  `mat_id` varchar(18) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `amount_lc` decimal(10,0) NOT NULL,
  `status` varchar(1) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `updated_by` varchar(10) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`no_mutation`,`mat_doc`,`move_type`,`mat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tmutation` */

insert  into `tmutation`(`no_mutation`,`mutation_date`,`type`,`mat_doc`,`move_type`,`plant_id`,`sloc`,`mat_id`,`qty`,`amount_lc`,`status`,`description`,`updated_by`,`updated_on`) values (1,'2017-12-11','I',2500020,'101','A001','L002','mat11','1','5000','','','admin','2017-12-11 15:58:12'),(2,'2017-12-11','I',2500020,'101','A001','L002','mat11','1','6000','','','admin','2017-12-11 15:58:12'),(3,'2017-12-11','I',2500021,'101','A001','L002','mat11','1','500','','','admin','2017-12-11 16:00:38'),(4,'2017-12-11','I',2500021,'101','A001','L002','mat13','1','5000','','','admin','2017-12-11 16:00:38'),(5,'2017-12-11','I',2500022,'101','A001','L002','mat4','1','600','','','admin','2017-12-11 16:04:23'),(6,'2017-12-11','I',2500022,'101','A001','L002','mat4','1','6000','','','admin','2017-12-11 16:04:23'),(7,'2017-12-11','I',2500022,'101','A001','L001','mat4','1','4000','','','admin','2017-12-11 16:04:23'),(8,'2017-12-12','I',2500024,'101','A001','L002','mat3','1','6000','','','admin','2017-12-12 15:12:36');

/*Table structure for table `tstock` */

DROP TABLE IF EXISTS `tstock`;

CREATE TABLE `tstock` (
  `created` int(4) NOT NULL,
  `mat_id` varchar(18) NOT NULL,
  `plant_id` varchar(4) NOT NULL,
  `sloc` varchar(4) NOT NULL,
  `beginqty01` decimal(10,0) DEFAULT '0',
  `inqty01` decimal(10,0) DEFAULT '0',
  `outqty01` decimal(10,0) DEFAULT '0',
  `endqty01` decimal(10,0) DEFAULT '0',
  `beginqty02` decimal(10,0) DEFAULT '0',
  `inqty02` decimal(10,0) DEFAULT '0',
  `outqty02` decimal(10,0) DEFAULT '0',
  `endqty02` decimal(10,0) DEFAULT '0',
  `beginqty03` decimal(10,0) DEFAULT '0',
  `inqty03` decimal(10,0) DEFAULT '0',
  `outqty03` decimal(10,0) DEFAULT '0',
  `endqty03` decimal(10,0) DEFAULT '0',
  `beginqty04` decimal(10,0) DEFAULT '0',
  `inqty04` decimal(10,0) DEFAULT '0',
  `outqty04` decimal(10,0) DEFAULT '0',
  `endqty04` decimal(10,0) DEFAULT '0',
  `beginqty05` decimal(10,0) DEFAULT '0',
  `inqty05` decimal(10,0) DEFAULT '0',
  `outqty05` decimal(10,0) DEFAULT '0',
  `endqty05` decimal(10,0) DEFAULT '0',
  `beginqty06` decimal(10,0) DEFAULT '0',
  `inqty06` decimal(10,0) DEFAULT '0',
  `outqty06` decimal(10,0) DEFAULT '0',
  `endqty06` decimal(10,0) DEFAULT '0',
  `beginqty07` decimal(10,0) DEFAULT '0',
  `inqty07` decimal(10,0) DEFAULT '0',
  `outqty07` decimal(10,0) DEFAULT '0',
  `endqty07` decimal(10,0) DEFAULT '0',
  `beginqty08` decimal(10,0) DEFAULT '0',
  `inqty08` decimal(10,0) DEFAULT '0',
  `outqty08` decimal(10,0) DEFAULT '0',
  `endqty08` decimal(10,0) DEFAULT '0',
  `beginqty09` decimal(10,0) DEFAULT '0',
  `inqty09` decimal(10,0) DEFAULT '0',
  `outqty09` decimal(10,0) DEFAULT '0',
  `endqty09` decimal(10,0) DEFAULT '0',
  `beginqty10` decimal(10,0) DEFAULT '0',
  `inqty10` decimal(10,0) DEFAULT '0',
  `outqty10` decimal(10,0) DEFAULT '0',
  `endqty10` decimal(10,0) DEFAULT '0',
  `beginqty11` decimal(10,0) DEFAULT '0',
  `inqty11` decimal(10,0) DEFAULT '0',
  `outqty11` decimal(10,0) DEFAULT '0',
  `endqty11` decimal(10,0) DEFAULT '0',
  `beginqty12` decimal(10,0) DEFAULT '0',
  `inqty12` decimal(10,0) DEFAULT '0',
  `outqty12` decimal(10,0) DEFAULT '0',
  `endqty12` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`created`,`mat_id`,`plant_id`,`sloc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tstock` */

insert  into `tstock`(`created`,`mat_id`,`plant_id`,`sloc`,`beginqty01`,`inqty01`,`outqty01`,`endqty01`,`beginqty02`,`inqty02`,`outqty02`,`endqty02`,`beginqty03`,`inqty03`,`outqty03`,`endqty03`,`beginqty04`,`inqty04`,`outqty04`,`endqty04`,`beginqty05`,`inqty05`,`outqty05`,`endqty05`,`beginqty06`,`inqty06`,`outqty06`,`endqty06`,`beginqty07`,`inqty07`,`outqty07`,`endqty07`,`beginqty08`,`inqty08`,`outqty08`,`endqty08`,`beginqty09`,`inqty09`,`outqty09`,`endqty09`,`beginqty10`,`inqty10`,`outqty10`,`endqty10`,`beginqty11`,`inqty11`,`outqty11`,`endqty11`,`beginqty12`,`inqty12`,`outqty12`,`endqty12`) values (2017,'mat11','A001','L002','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','3','0','3'),(2017,'mat13','A001','L002','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','0','1'),(2017,'mat3','A001','L002','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','0','1'),(2017,'mat4','A001','L001','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','0','1'),(2017,'mat4','A001','L002','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2','0','2');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Active` varchar(1) NOT NULL DEFAULT 'T',
  `UserLevel` int(10) DEFAULT '2',
  `AddDate` datetime DEFAULT '0000-00-00 00:00:00',
  `EditDate` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`UserName`,`Password`,`Active`,`UserLevel`,`AddDate`,`EditDate`) values (1,'admin','46f94c8de14fb36680850768ff1b7f2a','Y',-1,'2017-09-06 09:42:30','2017-09-19 12:14:24');

/*Table structure for table `users_levels` */

DROP TABLE IF EXISTS `users_levels`;

CREATE TABLE `users_levels` (
  `UserLevelID` int(11) NOT NULL DEFAULT '0',
  `UserLevelName` varchar(50) NOT NULL,
  `Status` varchar(1) DEFAULT NULL COMMENT 'Y=Active, T= not active',
  `AddDate` date NOT NULL DEFAULT '0000-00-00',
  `EditDate` date NOT NULL DEFAULT '0000-00-00',
  `AddUser` varchar(10) DEFAULT NULL,
  `EditUser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`UserLevelID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `users_levels` */

insert  into `users_levels`(`UserLevelID`,`UserLevelName`,`Status`,`AddDate`,`EditDate`,`AddUser`,`EditUser`) values (-1,'Administrator','Y','2017-09-19','0000-00-00',NULL,NULL),(1,'RESEARCH','Y','0000-00-00','0000-00-00',NULL,NULL),(2,'USERS','Y','0000-00-00','0000-00-00',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
