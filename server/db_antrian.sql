/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - db_antrian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_antrian` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_antrian`;

/*Table structure for table `tb_data_antrian` */

DROP TABLE IF EXISTS `tb_data_antrian`;

CREATE TABLE `tb_data_antrian` (
  `id_data_antrian` int(11) NOT NULL AUTO_INCREMENT,
  `uuid_data_antrian` varchar(255) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `tanggal_data_antrian` date NOT NULL,
  `status_data_antrian` enum('dicetak','dipanggil','selesai dipanggil','tidak hadir','hadir') NOT NULL,
  `nomor_data_antrian` int(11) NOT NULL,
  PRIMARY KEY (`id_data_antrian`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tb_data_antrian` */

insert  into `tb_data_antrian`(`id_data_antrian`,`uuid_data_antrian`,`id_meja`,`tanggal_data_antrian`,`status_data_antrian`,`nomor_data_antrian`) values 
(1,'6A5DC9ESEJrJLmCDiOXzpqqNsHOGKMzyMPFPTLLNIZOTQNUUVR',2,'2023-09-13','selesai dipanggil',1),
(2,'rvhv9haDCtUUjRNYCXlXTIRDXZGGZyYOSFUBKIZLRPYSTVUQQT',2,'2023-09-13','selesai dipanggil',2),
(3,'QhsPyfQivoxdUfxGRAtGFUqtSFKvvJQOBzDLJPYVQHVOKYURXQ',2,'2023-09-13','selesai dipanggil',3),
(4,'8AZfrfDdaRUpiTOLqWFRDwoMEKLMzwyRIMWKDEUSXQKYXZWPVS',2,'2023-09-13','selesai dipanggil',4),
(5,'6WlCSdvGzliHQmgtnCpTyprZPGsZzNJLyYOVEOWRVTQJYSMZXT',2,'2023-09-13','selesai dipanggil',5),
(6,'zvhpJsJSBSWTJHvRpVOOLCEpwDDQGKSDIzOOSREIOSJJNTMUPY',2,'2023-09-13','selesai dipanggil',6),
(7,'IQPbwknCiOkWkVFArIlRQzPxLsyIwBLRzVJSXLURNVNMYSNWRU',2,'2023-09-13','selesai dipanggil',7),
(8,'LORpqKyWAkCMryRMtoLyJIYKTEsXvVQGWRIHLFUTKWOKQLYSUU',2,'2023-09-13','selesai dipanggil',8),
(9,'PdOpVmJvAntUBfwBplRzCAyzJDWIGwCQIXKCHXZMNPIWUTOOSW',2,'2023-09-13','selesai dipanggil',9),
(10,'AusSKGdyNRpDrNsDxJXyJsMHtLzZHNZESLVHPXEPGHRYVVTZWP',2,'2023-09-13','selesai dipanggil',10),
(11,'3GCPlvAlhqdZYKrwHGPZABLuuwIKAFIHLWZKIJLUOQINOZOOWW',2,'2023-09-13','selesai dipanggil',11),
(12,'lY6cEcdnHmoEBEuYOQLYGtsIDFswHRDRFVCUZYOKJWTUZUTZYP',2,'2023-09-13','selesai dipanggil',12),
(13,'qy7ufwdvgjfnkHHGGuOMursyFNTKxSHENZAQQIILRIJTQQQPSW',2,'2023-09-13','dicetak',13),
(14,'RimSsCEyatezrthuvKAXNpEUIUttFPMXHSUNDVGJRHPJSOYTZU',2,'2023-09-13','dicetak',14),
(15,'zwzJHznYdCQdjhqkLYoUnSJLtIxtzMxGBXTGIENZPYTNLLSQYS',2,'2023-09-13','dicetak',15),
(16,'xOmlU9hRjKPBBYhryJtEYTwxTDEXwGLNGQZQQLRGRLWOOSQSSY',2,'2023-09-13','dicetak',16),
(17,'ALRCrrtqdKgtCLCwiTNHEsANwrIWuJRxGXDGXLLJINQMXVMYTZ',2,'2023-09-13','dicetak',17),
(18,'egLOvkUxJBuBZpgWXnrtMBPzQRYNBJSDTELPMIXQXLPVLRXNWU',2,'2023-09-13','dicetak',18),
(19,'NERkzwREZoWgqrXKYrtTsxLLGxHFYBOBEZKLLVTGGNXUNXVOVP',4,'2023-09-13','selesai dipanggil',1),
(20,'uVg7e8JKdVhmeFirxAKlYEEzuvLCRJOQAWQSEKKHGNTKWXPRWS',4,'2023-09-13','selesai dipanggil',2),
(21,'h9AIjdOzoElJZpkLCtAGwBCLJTXZUEHyFBOVLWVUNVIVWUSRVW',4,'2023-09-13','selesai dipanggil',3),
(22,'bCGawXWEbkfvygyYQNRwNXJTxWMLYGCYyNGYZFFFZNQMSYYYXP',4,'2023-09-13','selesai dipanggil',4),
(23,'56pzripzLqnLvPqwrKUrIAyCAVsPQPCGRSLBPNVZKYYYYSXNUR',4,'2023-09-13','selesai dipanggil',5),
(24,'98tAXmwvTrWsZANrVzqJNzqDXZTwSNDRTWSQCEEWIXRXMRNVWV',4,'2023-09-13','dicetak',6);

/*Table structure for table `tb_meja` */

DROP TABLE IF EXISTS `tb_meja`;

CREATE TABLE `tb_meja` (
  `id_meja` int(11) NOT NULL AUTO_INCREMENT,
  `uuid_meja` varchar(255) NOT NULL,
  `nomor_meja` int(11) NOT NULL,
  `keterangan_meja` varchar(255) NOT NULL,
  `kode_meja` varchar(255) NOT NULL,
  PRIMARY KEY (`id_meja`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tb_meja` */

insert  into `tb_meja`(`id_meja`,`uuid_meja`,`nomor_meja`,`keterangan_meja`,`kode_meja`) values 
(1,'ab1791bcdb2d1d65e94fa69c5681d266',1,'Kesekretariatan','KS'),
(2,'da732fdb4395e7344c49137a6bff0eed',2,'Kepaniteraan','KP'),
(3,'9412777ef0a754782a92eedf640f005c',3,'Ecourt','E'),
(4,'3d6f2324c1a7e04525bcdcd29d41d8f8',4,'Informasi','I'),
(5,'7d8b65bf7123fd2b41feb421720a3c2c',5,'Prioritas','P');

/*Table structure for table `tb_operator` */

DROP TABLE IF EXISTS `tb_operator`;

CREATE TABLE `tb_operator` (
  `id_operator` int(11) NOT NULL AUTO_INCREMENT,
  `id_meja` int(11) NOT NULL,
  `uuid_operator` varchar(255) NOT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','operator') NOT NULL,
  PRIMARY KEY (`id_operator`),
  KEY `id_meja` (`id_meja`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tb_operator` */

insert  into `tb_operator`(`id_operator`,`id_meja`,`uuid_operator`,`nama_operator`,`username`,`password`,`level`) values 
(1,1,'eQoXpkmhknYBEGRykYNYZSVZxBtOOIQUFzUQIEVOLVZXPWPRWZ','Okta 1','admin','$2y$10$K9FQIM2qxqIeGQS99OeO2ebB24b9jHczU63Fmx8UQTHAqxw9pb.Jm','admin'),
(3,1,'q3vQpTfbgKOduxQPyOuYJvMOxWyJPxBzAQXLOEOSULTKURXNQQ','Okta 2','meja1','$2y$10$997p9fCsUeE1nRgK4QG45.5PiDNNXpkaIO/2EqlKJd1yRKLTUXcz6','operator'),
(4,2,'r75LeLXHxdmpmZwtLkGXRrzYURRLRVLJSYQVUZUOIOYSUOWXWY','meja2','meja2','$2y$10$CW9EWTgK.oiZE3tYpvxbiO0twSgIIZacsx5L8hw/xNyOIBHhr7Ym2','operator'),
(5,4,'teSI7VvXiFJiAXWHjrmADoDYSPSCPXNUDXPOYLIYGRMYZMMNZS','Meja 3','meja3','$2y$10$QXLlgudOO23RA7xb2FzLL.TOJBSflxA/gP/prUYqTxi92upOm.b6G','operator'),
(6,4,'mu8mliiaIqTdiyANKRPoWttMqRHCKCxMMWTJRLYJYYOJKPTROW','Meja 4','meja4','$2y$10$/MCZ2ALqnjaPjlEx0cG8QupJ//JLKm0H/d2xHJ1TH3gJGyeyYhsQS','operator'),
(7,5,'vezVSTQddduDwouDNvtNARwBxNVyMFEHGWASTSILUUQJTRXZQZ','Meja 5','meja5','$2y$10$QkrucNf78FzRLagauToQTuedcY4VbNMnMxc/0L6BkMqOcjJz4UOvu','operator');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
