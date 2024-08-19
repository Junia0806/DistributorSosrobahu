/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `daftar_toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daftar_toko` (
  `id_daftar_toko` int NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_daftar_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `kunjungan_toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kunjungan_toko` (
  `id_kunjungan_toko` int NOT NULL AUTO_INCREMENT,
  `id_daftar_toko` int NOT NULL,
  `tanggal` date NOT NULL,
  `sisa_produk` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kunjungan_toko`),
  KEY `id_daftar_toko_2` (`id_daftar_toko`),
  KEY `id_daftar_toko` (`id_daftar_toko`),
  CONSTRAINT `kunjungan_toko_ibfk_1` FOREIGN KEY (`id_daftar_toko`) REFERENCES `daftar_toko` (`id_daftar_toko`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `master_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_barang` (
  `id_master_barang` int NOT NULL AUTO_INCREMENT,
  `nama_rokok` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_karton_pabrik` int NOT NULL,
  `stok_karton` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_slop` int NOT NULL,
  PRIMARY KEY (`id_master_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_agen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_agen` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `id_user_agen` int NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` date NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pemesanan` int NOT NULL,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `id_user_agen` (`id_user_agen`),
  CONSTRAINT `order_agen_ibfk_1` FOREIGN KEY (`id_user_agen`) REFERENCES `user_agen` (`id_user_agen`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_distributor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_distributor` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `id_user_distributor` int NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` date NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pemesanan` int NOT NULL,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `id_user_distributor_2` (`id_user_distributor`),
  KEY `id_user_distributor` (`id_user_distributor`),
  CONSTRAINT `order_distributor_ibfk_1` FOREIGN KEY (`id_user_distributor`) REFERENCES `user_distributor` (`id_user_distributor`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_sales` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `id_user_sales` int NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` date NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pemesanan` int NOT NULL,
  `nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `id_user_sales` (`id_user_sales`),
  CONSTRAINT `order_sales_ibfk_1` FOREIGN KEY (`id_user_sales`) REFERENCES `user_sales` (`id_user_sales`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tbl_barang_agen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_barang_agen` (
  `id_barang_agen` int NOT NULL AUTO_INCREMENT,
  `id_master_barang` int NOT NULL,
  `id_user_agen` int NOT NULL,
  `harga_agen` int NOT NULL,
  `stok_karton` int NOT NULL,
  PRIMARY KEY (`id_barang_agen`),
  KEY `id_master_barang` (`id_master_barang`),
  KEY `id_use_agen` (`id_user_agen`),
  CONSTRAINT `tbl_barang_agen_ibfk_1` FOREIGN KEY (`id_user_agen`) REFERENCES `user_agen` (`id_user_agen`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_barang_agen_ibfk_2` FOREIGN KEY (`id_master_barang`) REFERENCES `master_barang` (`id_master_barang`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tbl_barang_disitributor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_barang_disitributor` (
  `id_barang_distributor` int NOT NULL AUTO_INCREMENT,
  `id_master_barang` int NOT NULL,
  `id_user_distributor` int NOT NULL,
  `harga_distributor` int NOT NULL,
  `stok_karton` int NOT NULL,
  PRIMARY KEY (`id_barang_distributor`),
  KEY `id_master_barang` (`id_master_barang`),
  KEY `id_user_distributor` (`id_user_distributor`),
  CONSTRAINT `tbl_barang_disitributor_ibfk_1` FOREIGN KEY (`id_master_barang`) REFERENCES `master_barang` (`id_master_barang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_barang_disitributor_ibfk_2` FOREIGN KEY (`id_user_distributor`) REFERENCES `user_distributor` (`id_user_distributor`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tbl_barang_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_barang_sales` (
  `id_barang_sales` int NOT NULL AUTO_INCREMENT,
  `id_master_barang` int NOT NULL,
  `id_user_sales` int NOT NULL,
  `harga_sales` int NOT NULL,
  `stok_slop` int NOT NULL,
  PRIMARY KEY (`id_barang_sales`),
  KEY `id_master_barang` (`id_master_barang`),
  KEY `id_user_sales` (`id_user_sales`),
  CONSTRAINT `tbl_barang_sales_ibfk_1` FOREIGN KEY (`id_user_sales`) REFERENCES `user_sales` (`id_user_sales`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_barang_sales_ibfk_2` FOREIGN KEY (`id_master_barang`) REFERENCES `master_barang` (`id_master_barang`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_agen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_agen` (
  `id_user_agen` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `level` int NOT NULL,
  `gambar_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user_agen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_distributor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_distributor` (
  `id_user_distributor` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `level` int NOT NULL,
  `gambar_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user_distributor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_pabrik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_pabrik` (
  `id_user_pabrik` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int NOT NULL,
  PRIMARY KEY (`id_user_pabrik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_sales` (
  `id_user_sales` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `level` int NOT NULL,
  `gambar_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user_sales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2024_08_09_083334_create_daftar_toko_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2024_08_09_083334_create_kunjungan_toko_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2024_08_09_083334_create_master_barang_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2024_08_09_083334_create_order_agen_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2024_08_09_083334_create_order_distributor_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2024_08_09_083334_create_order_sales_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2024_08_09_083334_create_tbl_barang_agen_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'2024_08_09_083334_create_tbl_barang_disitributor_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37,'2024_08_09_083334_create_tbl_barang_sales_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38,'2024_08_09_083334_create_user_agen_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39,'2024_08_09_083334_create_user_distributor_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40,'2024_08_09_083334_create_user_pabrik_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (41,'2024_08_09_083334_create_user_sales_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (42,'2024_08_09_083337_add_foreign_keys_to_kunjungan_toko_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (43,'2024_08_09_083337_add_foreign_keys_to_order_agen_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (44,'2024_08_09_083337_add_foreign_keys_to_order_distributor_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (45,'2024_08_09_083337_add_foreign_keys_to_order_sales_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (46,'2024_08_09_083337_add_foreign_keys_to_tbl_barang_agen_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (47,'2024_08_09_083337_add_foreign_keys_to_tbl_barang_disitributor_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (48,'2024_08_09_083337_add_foreign_keys_to_tbl_barang_sales_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (49,'2024_08_15_012942_add_timestamps_to_daftar_toko_table',2);
