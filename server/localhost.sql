-- Adminer 4.3.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tb_data_antrian`;
CREATE TABLE `tb_data_antrian` (
  `id_data_antrian` int NOT NULL AUTO_INCREMENT,
  `uuid_data_antrian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_meja` int NOT NULL,
  `tanggal_data_antrian` date NOT NULL,
  `status_data_antrian` enum('dicetak','dipanggil','selesai dipanggil','tidak hadir','hadir') COLLATE utf8_unicode_ci NOT NULL,
  `nomor_data_antrian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_data_antrian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO `tb_data_antrian` (`id_data_antrian`, `uuid_data_antrian`, `id_meja`, `tanggal_data_antrian`, `status_data_antrian`, `nomor_data_antrian`) VALUES
(1,	'4FTPpLQrbBULpQCkUBxSYUDKWDVIHBKEWZXGDJMVKMVVTWYQWQ',	1,	'2023-03-06',	'dipanggil',	'001'),
(2,	'tN7bfKJIFBcCUronDKStFRoSAvZSxVFRUOECXLKJGWKPOQXTQU',	1,	'2023-03-06',	'dicetak',	'002'),
(3,	'oseuyprhEVcEzGYjkOYRJGYNstDuIMHTLSRHYGSHXXILMWYPVT',	1,	'2023-03-06',	'dicetak',	'003');

DROP TABLE IF EXISTS `tb_meja`;
CREATE TABLE `tb_meja` (
  `id_meja` int NOT NULL AUTO_INCREMENT,
  `uuid_meja` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_meja` int NOT NULL,
  `keterangan_meja` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_meja` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_meja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO `tb_meja` (`id_meja`, `uuid_meja`, `nomor_meja`, `keterangan_meja`, `kode_meja`) VALUES
(1,	'ab1791bcdb2d1d65e94fa69c5681d266',	1,	'Pidana',	'M1'),
(2,	'da732fdb4395e7344c49137a6bff0eed',	2,	'Perdata',	'M2'),
(3,	'9412777ef0a754782a92eedf640f005c',	3,	'Umum',	'M3'),
(4,	'3d6f2324c1a7e04525bcdcd29d41d8f8',	4,	'Informasi & Pengaduan',	'M4'),
(5,	'7d8b65bf7123fd2b41feb421720a3c2c',	5,	'PTSP Mandiri',	'M5');

DROP TABLE IF EXISTS `tb_operator`;
CREATE TABLE `tb_operator` (
  `id_operator` int NOT NULL AUTO_INCREMENT,
  `id_meja` int NOT NULL,
  `uuid_operator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_operator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` enum('admin','operator') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_operator`),
  KEY `id_meja` (`id_meja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO `tb_operator` (`id_operator`, `id_meja`, `uuid_operator`, `nama_operator`, `username`, `password`, `level`) VALUES
(1,	1,	'eQoXpkmhknYBEGRykYNYZSVZxBtOOIQUFzUQIEVOLVZXPWPRWZ',	'Okta 1',	'meja1',	'$2y$10$oaBS6wQ/LJj2VRD79SiFnupVrbEiKwswYo1BKPZAkppI51tAcSzFS',	'admin'),
(3,	2,	'q3vQpTfbgKOduxQPyOuYJvMOxWyJPxBzAQXLOEOSULTKURXNQQ',	'Okta 2',	'meja2',	'$2y$10$gThrnP2ESZEjkglO.tVWK.r/ofCQ7RUamUJWNrA./mqUDSXCVAr3.',	'operator');

-- 2023-03-06 23:49:19
