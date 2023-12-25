# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 11.2.2-MariaDB)
# Database: pos
# Generation Time: 2023-12-25 07:20:38 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table master_barang
# ------------------------------------------------------------

DROP TABLE IF EXISTS `master_barang`;

CREATE TABLE `master_barang` (
  `kode_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `master_barang` WRITE;
/*!40000 ALTER TABLE `master_barang` DISABLE KEYS */;

INSERT INTO `master_barang` (`kode_barang`, `id_kategori`, `nama_barang`, `deskripsi`, `harga`)
VALUES
	(1,4,'Sabun Kecantikan','Sabun Mandi','5000'),
	(2,4,'Kopi Luwak','Kopi Luwak Bali','10000');

/*!40000 ALTER TABLE `master_barang` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table master_barang_kategori
# ------------------------------------------------------------

DROP TABLE IF EXISTS `master_barang_kategori`;

CREATE TABLE `master_barang_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(125) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `master_barang_kategori` WRITE;
/*!40000 ALTER TABLE `master_barang_kategori` DISABLE KEYS */;

INSERT INTO `master_barang_kategori` (`id_kategori`, `nama_kategori`)
VALUES
	(4,'Kebutuhan Harian');

/*!40000 ALTER TABLE `master_barang_kategori` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table penjualan_header
# ------------------------------------------------------------

DROP TABLE IF EXISTS `penjualan_header`;

CREATE TABLE `penjualan_header` (
  `no_transaksi` varchar(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `customer` varchar(250) NOT NULL,
  `total_bayar` int(10) unsigned NOT NULL,
  `kode_promo` varchar(20) DEFAULT NULL,
  `ppn` int(11) DEFAULT NULL,
  `grand_total` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `penjualan_header` WRITE;
/*!40000 ALTER TABLE `penjualan_header` DISABLE KEYS */;

INSERT INTO `penjualan_header` (`no_transaksi`, `tgl_transaksi`, `customer`, `total_bayar`, `kode_promo`, `ppn`, `grand_total`)
VALUES
	('202312-001','2023-12-25 14:17:58','Darmawan',90000,'promo-001',11,99900),
	('202312-002','2023-12-25 14:19:05','Yanti',10000,'',11,11100);

/*!40000 ALTER TABLE `penjualan_header` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table penjualan_header_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `penjualan_header_detail`;

CREATE TABLE `penjualan_header_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(20) NOT NULL,
  `kode_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(10) unsigned NOT NULL,
  `discount` int(11) DEFAULT 0,
  `subtotal` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `penjualan_header_detail` WRITE;
/*!40000 ALTER TABLE `penjualan_header_detail` DISABLE KEYS */;

INSERT INTO `penjualan_header_detail` (`id_detail`, `no_transaksi`, `kode_barang`, `qty`, `harga`, `discount`, `subtotal`)
VALUES
	(16,'202312-001',1,12,5000,0,54000),
	(17,'202312-001',2,4,10000,0,36000),
	(18,'202312-002',1,2,5000,0,10000);

/*!40000 ALTER TABLE `penjualan_header_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table promo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `promo`;

CREATE TABLE `promo` (
  `kode_promo` varchar(20) NOT NULL,
  `nama_promo` varchar(100) NOT NULL,
  `promo` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`kode_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `promo` WRITE;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;

INSERT INTO `promo` (`kode_promo`, `nama_promo`, `promo`, `keterangan`)
VALUES
	('promo-001','Promo New Year',10,'Untuk Tahun Baru');

/*!40000 ALTER TABLE `promo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_admin`;

CREATE TABLE `user_admin` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(125) NOT NULL,
  `alamat_user` text NOT NULL,
  `no_hp_user` varchar(15) NOT NULL,
  `username_user` varchar(125) NOT NULL,
  `password_user` varchar(125) NOT NULL,
  `level_user` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `user_admin` WRITE;
/*!40000 ALTER TABLE `user_admin` DISABLE KEYS */;

INSERT INTO `user_admin` (`id_user`, `nama_user`, `alamat_user`, `no_hp_user`, `username_user`, `password_user`, `level_user`)
VALUES
	(1,'Admin SGV','Bali','088118811881','admin','21232f297a57a5a743894a0e4a801fc3',1),
	(2,'Staff SVG','Bali','081177117711','staff','1253208465b1efa876f982d8a9e73eef',2);

/*!40000 ALTER TABLE `user_admin` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
