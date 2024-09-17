/*
SQLyog Ultimate v10.3 
MySQL - 8.0.30 : Database - db_antrian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_data_antrian` */

DROP TABLE IF EXISTS `tb_data_antrian`;

CREATE TABLE `tb_data_antrian` (
  `id_data_antrian` int NOT NULL AUTO_INCREMENT,
  `uuid_data_antrian` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_meja` int NOT NULL,
  `tanggal_data_antrian` date NOT NULL,
  `status_data_antrian` enum('dicetak','dipanggil','selesai dipanggil','tidak hadir','hadir') COLLATE utf8mb3_unicode_ci NOT NULL,
  `nomor_data_antrian` int NOT NULL,
  `jam_antrian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_data_antrian`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*Data for the table `tb_data_antrian` */

insert  into `tb_data_antrian`(`id_data_antrian`,`uuid_data_antrian`,`id_meja`,`tanggal_data_antrian`,`status_data_antrian`,`nomor_data_antrian`,`jam_antrian`) values (1,'cdiObxwTakkXSSlxlHFXNZrqvvtKHOzRYONLUPYGLTTQRSQYXQ',1,'2024-09-16','selesai dipanggil',1,'2024-09-17 13:33:01');

/*Table structure for table `tb_meja` */

DROP TABLE IF EXISTS `tb_meja`;

CREATE TABLE `tb_meja` (
  `id_meja` int NOT NULL AUTO_INCREMENT,
  `uuid_meja` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nomor_meja` int NOT NULL,
  `keterangan_meja` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `kode_meja` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_meja`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*Data for the table `tb_meja` */

insert  into `tb_meja`(`id_meja`,`uuid_meja`,`nomor_meja`,`keterangan_meja`,`kode_meja`) values (1,'ab1791bcdb2d1d65e94fa69c5681d266',1,'Kesekretariatan','KS'),(2,'da732fdb4395e7344c49137a6bff0eed',2,'Kepaniteraan','KP'),(3,'9412777ef0a754782a92eedf640f005c',3,'Ecourt','E'),(4,'3d6f2324c1a7e04525bcdcd29d41d8f8',4,'Informasi','I'),(5,'7d8b65bf7123fd2b41feb421720a3c2c',5,'Prioritas','P');

/*Table structure for table `tb_operator` */

DROP TABLE IF EXISTS `tb_operator`;

CREATE TABLE `tb_operator` (
  `id_operator` int NOT NULL AUTO_INCREMENT,
  `id_meja` int NOT NULL,
  `uuid_operator` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nama_operator` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `level` enum('admin','operator') COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_operator`),
  KEY `id_meja` (`id_meja`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*Data for the table `tb_operator` */

insert  into `tb_operator`(`id_operator`,`id_meja`,`uuid_operator`,`nama_operator`,`username`,`password`,`level`) values (1,1,'eQoXpkmhknYBEGRykYNYZSVZxBtOOIQUFzUQIEVOLVZXPWPRWZ','Okta 1','admin','$2y$10$K9FQIM2qxqIeGQS99OeO2ebB24b9jHczU63Fmx8UQTHAqxw9pb.Jm','admin'),(8,1,'rsx7pLKfnwxmijxIwSQsXvAAEECSPWGYDVTSCVILQYYUVWUOOT','vendetta','rose','$2y$10$lNX1UbZp/hDEf0PNYgid6e57l2IkchutKQ62GWDQvhTCuo96Rpozm','operator');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
