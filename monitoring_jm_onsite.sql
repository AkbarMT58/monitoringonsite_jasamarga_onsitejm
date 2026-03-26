-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: monitoring_security_jm
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `advance_salaries`
--

DROP TABLE IF EXISTS `advance_salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advance_salaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `date` date NOT NULL,
  `advance_salary` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advance_salaries`
--

LOCK TABLES `advance_salaries` WRITE;
/*!40000 ALTER TABLE `advance_salaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `advance_salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendences`
--

DROP TABLE IF EXISTS `attendences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `date` date NOT NULL,
  `clock_in` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_out` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terlambat` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `absent` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_dokumen` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu_cetak` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendences`
--

LOCK TABLES `attendences` WRITE;
/*!40000 ALTER TABLE `attendences` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'est ad','sunt','2025-05-21 02:56:02','2025-05-21 02:56:02'),(2,'at possimus','dolorem','2025-05-21 02:56:02','2025-05-21 02:56:02'),(3,'cumque recusandae','molestiae','2025-05-21 02:56:02','2025-05-21 02:56:02'),(4,'voluptatem qui','aperiam','2025-05-21 02:56:02','2025-05-21 02:56:02'),(5,'quia veritatis','nihil','2025-05-21 02:56:02','2025-05-21 02:56:02');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shopname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Cyril Lebsack','victoria57@example.net','(609) 782-2166','27579 Zulauf Route Suite 341\nJessiestad, NV 64110-9871','Barton and Sons',NULL,'Prof. Kyleigh Bergnaum','94548064','BNI','Brekkeside','West Kurt','2025-05-21 02:56:00','2025-05-21 02:56:00'),(2,'Reilly Tremblay','derick.deckow@example.com','518-310-5814','608 Lakin Brooks\nChaimfurt, PA 82268-2747','Heathcote, Schamberger and Funk',NULL,'Arturo Lang','47342595','BNI','Lake Leola','South Monte','2025-05-21 02:56:00','2025-05-21 02:56:00'),(3,'Miss Eve Kohler MD','gcarter@example.net','(516) 758-3206','54818 Garnet Forge\nDinahaven, FL 44649','Kuhic Group',NULL,'Prof. Moises Hagenes Sr.','19371283','BJB','Jadenland','Hellerside','2025-05-21 02:56:00','2025-05-21 02:56:00'),(4,'Mekhi Tillman','schmitt.liam@example.com','304.864.2830','4117 Brisa Ferry\nLisetteshire, MN 48559','Larkin, Nolan and Lesch',NULL,'Prof. Lorenz Goodwin','57713336','BJB','South Eddmouth','East Addisonhaven','2025-05-21 02:56:00','2025-05-21 02:56:00'),(5,'Tremayne Bednar','ulehner@example.net','+1 (352) 943-3651','437 McLaughlin Track Suite 039\nHirtheland, NV 19092','Marks-Crona',NULL,'Geovanny Sauer Sr.','98831707','BRI','East Henrytown','Beattyburgh','2025-05-21 02:56:00','2025-05-21 02:56:00'),(6,'Pearlie Hamill','christina16@example.org','260-836-1459','95396 Conrad Key Suite 937\nSouth Gladyceberg, MT 27856-0413','Wolff, Bogan and Welch',NULL,'Jarod Cormier','94269731','BCA','Lake Lempi','Tristonton','2025-05-21 02:56:00','2025-05-21 02:56:00'),(7,'Kale Towne','hessel.dannie@example.net','347-851-1220','3567 Karianne Parkways Suite 754\nLoweton, HI 83442-2187','Bartoletti, Casper and Romaguera',NULL,'Dr. Moises Baumbach I','19920624','BCA','West Ceciliastad','Lake Vivien','2025-05-21 02:56:00','2025-05-21 02:56:00'),(8,'Alfreda Jaskolski','guillermo38@example.com','+1.559.648.3840','99708 Bernhard Mills Apt. 704\nRueckertown, WI 04401','Runolfsdottir Inc',NULL,'Leilani Farrell','21503367','BSI','East Breannestad','West Jerel','2025-05-21 02:56:00','2025-05-21 02:56:00'),(9,'Dr. Brad Leuschke Jr.','judah45@example.org','+1 (364) 600-3126','11414 Aracely Mountains Apt. 782\nEast Macimouth, MT 44033','Watsica and Sons',NULL,'Prof. Josue Little Sr.','84317698','MANDIRI','Mannland','Port Christaside','2025-05-21 02:56:00','2025-05-21 02:56:00'),(10,'Ms. Earnestine Sanford III','tmccullough@example.org','1-864-857-1359','437 Trantow Ford\nNew Noble, AL 37277-2086','Bergstrom, Spencer and Legros',NULL,'Mrs. Felicia Shields DDS','65297274','BJB','Port Saul','South Derekfort','2025-05-21 02:56:00','2025-05-21 02:56:00'),(11,'Barry Greenfelder IV','wkoepp@example.org','619-845-6492','61451 Bartoletti Crest Suite 517\nPort Aubrey, OR 57072','Dibbert PLC',NULL,'Timmy Harvey','73841824','BRI','Romagueramouth','Shirleyport','2025-05-21 02:56:00','2025-05-21 02:56:00'),(12,'Coleman Will','vallie91@example.org','+1 (917) 475-8375','155 Leonor Branch\nNorth Chrisland, MD 42415','White Ltd',NULL,'Beatrice Kirlin','48356972','MANDIRI','Lake Lavonne','West Laylatown','2025-05-21 02:56:00','2025-05-21 02:56:00'),(13,'Walker Ankunding','elbert.reichel@example.org','1-248-544-0447','50288 Koelpin Extension\nLindsaymouth, OH 66036','Shields, Pfannerstill and Hyatt',NULL,'Damien Okuneva','72512169','BJB','East Ethantown','Pricefurt','2025-05-21 02:56:00','2025-05-21 02:56:00'),(14,'Alvera Murphy','vjacobson@example.net','361.890.0093','8212 Cleveland Springs Suite 654\nRyleymouth, SC 73792','Bradtke-Klein',NULL,'Dwight Crist','71466856','BNI','South Janelle','Lake Sabrina','2025-05-21 02:56:00','2025-05-21 02:56:00'),(15,'Florida Dach','luther.douglas@example.com','+1-661-385-9752','85909 Jermaine Fields Suite 358\nLaurieville, LA 83835-3991','Conroy, Hirthe and Kemmer',NULL,'Dr. Ethelyn Renner','76439726','MANDIRI','Lake Bretfort','Florianview','2025-05-21 02:56:00','2025-05-21 02:56:00'),(16,'Dr. Tyrel Nicolas Sr.','jdaugherty@example.org','540-302-8484','2355 Tad Light\nAuerchester, SC 40342-0948','Quigley-McLaughlin',NULL,'Prof. Vidal Brakus III','25136417','MANDIRI','Port Jackshire','Port Missouritown','2025-05-21 02:56:00','2025-05-21 02:56:00'),(17,'Johann Lindgren','rhoda.bogisich@example.org','(971) 530-7823','483 Schaefer Pass\nBiankaburgh, AR 01201-9177','McClure, Rippin and Fay',NULL,'Dr. Dave Green','30252337','BJB','Kreigershire','North Rowanton','2025-05-21 02:56:00','2025-05-21 02:56:00'),(18,'Ms. Alverta Pagac','ronaldo39@example.net','(678) 393-6525','3488 Pearl Ports Apt. 398\nNew Ahmadhaven, SD 55172-0689','Ernser and Sons',NULL,'Prof. Pansy Shields','36735800','BNI','West Marcellusstad','New Macieborough','2025-05-21 02:56:00','2025-05-21 02:56:00'),(19,'Mariam Murray','randi.marvin@example.com','810.920.4235','287 Estevan Ferry Apt. 029\nNew Alfredoport, TN 59447','Padberg, O\'Reilly and Russel',NULL,'Alf Prosacco','97677972','BCA','Nitzschetown','Rohanmouth','2025-05-21 02:56:00','2025-05-21 02:56:00'),(20,'Stanford Runolfsdottir','mante.henri@example.net','(650) 245-0413','45345 Asa Lock\nChristiansenfurt, ME 61702-0781','Gorczany-Wyman',NULL,'Willy Cartwright','34910433','BCA','Port Estamouth','Hartmannmouth','2025-05-21 02:56:00','2025-05-21 02:56:00'),(21,'Xzavier Gutkowski','bartell.federico@example.net','870.875.8030','971 Cummings Knoll\nSamanthamouth, IL 94691','Waters, Jast and McGlynn',NULL,'Theresia Towne','78625264','BRI','East Aliceville','Stephenport','2025-05-21 02:56:00','2025-05-21 02:56:00'),(22,'Prof. Domenick Raynor I','tromp.stella@example.com','+1-561-849-3933','832 Swaniawski Lights Suite 394\nGoldenside, TX 78039','Lindgren-O\'Hara',NULL,'Alicia Pollich','85837609','BJB','Ferryshire','Madisenhaven','2025-05-21 02:56:00','2025-05-21 02:56:00'),(23,'Clare Ortiz','xmurphy@example.com','+1 (445) 677-5140','67057 River Rest Apt. 518\nNorth Randal, ND 12771','Altenwerth, Pfannerstill and Volkman',NULL,'Iliana Muller','52104783','BRI','Port Delaneyberg','New Dustymouth','2025-05-21 02:56:00','2025-05-21 02:56:00'),(24,'Kamille Powlowski','kuhic.ian@example.net','(325) 548-7561','137 Kling Landing Suite 326\nPort Randallstad, KS 45678','Oberbrunner, Wolf and Considine',NULL,'Roxanne Wiza','95225137','MANDIRI','West Aliburgh','Lake Kathrynfort','2025-05-21 02:56:00','2025-05-21 02:56:00'),(25,'Roma Hartmann','aglae.luettgen@example.net','+1-979-893-1227','5915 Nick Viaduct\nPort Kenchester, KS 19656-1685','Wolff PLC',NULL,'Wilhelmine Wisozk','49745401','BNI','Alanashire','South Ameliamouth','2025-05-21 02:56:00','2025-05-21 02:56:00');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_signatures`
--

DROP TABLE IF EXISTS `data_signatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_signatures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `kategori_jabatan` int DEFAULT NULL,
  `ttd_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_signatures`
--

LOCK TABLES `data_signatures` WRITE;
/*!40000 ALTER TABLE `data_signatures` DISABLE KEYS */;
INSERT INTO `data_signatures` VALUES (1,1,1,'dfea0768cc6ba51dd20c7224016b0bd7.jpg',NULL,'2025-07-31 05:20:35'),(2,6,4,'99607461cdb9c26e2bd5f31b12dcf27a.jpg',NULL,NULL),(3,8,6,'5d79099fcdf499f12b79770834c0164a.jpg',NULL,NULL),(5,7,5,'400c3241004b5db7ca7f5abfef2794f2.jpg',NULL,NULL),(6,3,2,'5f93f983524def3dca464469d2cf9f3e.png',NULL,NULL),(8,9,5,'656c8f81486b1e4fe59bf39ce9ff7b33.jpg',NULL,NULL);
/*!40000 ALTER TABLE `data_signatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `nik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` int DEFAULT NULL,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` int DEFAULT NULL,
  `vacation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annual_leave_total` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`),
  UNIQUE KEY `employees_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Muhammad Taufik Akbar','taufiksakbar@gmail.com','083832497471','395 Shea Branch\r\nSouth Jaiden, IN 14518-1537','236253554374374575745',1,'3 Year',NULL,0,NULL,'Jakarta',10,'2025-05-21 02:56:00','01-08-2025-16:23:34'),(2,'Rizky Sugiarti','mckenna24@example.net','085717850355','28370 Ethyl Crescent Suite 691\r\nLilianfurt, NM 00516-1358','5465778888888',3,'1 Year',NULL,0,NULL,'Jakarta',0,'2025-05-21 02:56:00','2025-07-17 16:48:05'),(3,'Surya','fskiles@example.org','081228723508','778 Jerde Turnpike Suite 773\r\nHowellbury, DC 80772',NULL,2,'3 Year',NULL,0,NULL,'Jakarta',5,'2025-05-21 02:56:00','01-08-2025-16:25:51'),(4,'Feby','reese.connelly@example.com','+1.208.376.5819','8151 Justine Course Suite 754\r\nEast Jettie, AR 06189-5490',NULL,2,'1 Year',NULL,0,NULL,'Jakarta',12,'2025-05-21 02:56:00','2025-07-14 14:23:13'),(6,'Ade Supriyatna','ade.supriyatna7172@gmail.com','1234567890','-','0',4,'5 Year',NULL,0,NULL,'0',0,'2025-07-24 08:28:05','2025-07-24 15:32:50'),(7,'R. Aditya Renaldi','adtya@gmail.com','0','-','0',5,'5 Year',NULL,0,NULL,'0',0,'2025-07-24 15:43:38','2025-07-24 22:45:06'),(8,'Dara Ramadhani','dara@gmail.com','1233322323','0','43444',6,NULL,NULL,0,NULL,'0',12,'2025-07-24 15:48:56','2025-07-24 22:49:31'),(9,'Hendra Saputra Yuriswanto','hendrasaputra@gmail.com','6656767','-','44544',7,'5 Year',NULL,0,NULL,'Jakarta',12,'2025-08-01 04:57:52','2026-03-25 10:33:21');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_03_15_044621_add_username_and_photo_to_users',1),(6,'2023_03_24_080143_create_employees_table',1),(7,'2023_03_29_025458_create_customers_table',1),(8,'2023_03_30_020042_create_suppliers_table',1),(9,'2023_03_30_083652_create_advance_salaries_table',1),(10,'2023_04_01_142106_create_pay_salaries_table',1),(11,'2023_04_02_141037_create_attendences_table',1),(12,'2023_04_04_041700_create_categories_table',1),(13,'2023_04_04_052256_create_products_table',1),(14,'2023_04_10_043156_create_orders_table',1),(15,'2023_04_10_044212_create_order_details_table',1),(16,'2023_04_13_222344_create_permission_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(2,'App\\Models\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int DEFAULT NULL,
  `unitcost` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_products` int NOT NULL,
  `sub_total` int DEFAULT NULL,
  `vat` int DEFAULT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay` int DEFAULT NULL,
  `due` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_salaries`
--

DROP TABLE IF EXISTS `pay_salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pay_salaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `paid_amount` int NOT NULL,
  `advance_salary` int DEFAULT NULL,
  `due_salary` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_salaries`
--

LOCK TABLES `pay_salaries` WRITE;
/*!40000 ALTER TABLE `pay_salaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengajuan_cuti_onsite`
--

DROP TABLE IF EXISTS `pengajuan_cuti_onsite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengajuan_cuti_onsite` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `jumlah_pengajuan_cuti` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sisa_cuti` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan_cuti` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status_cuti` int DEFAULT NULL,
  `dokumen_cuti` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mengetahui_karyawan` int DEFAULT NULL,
  `mengetahui_leader` int DEFAULT NULL,
  `mengetahui_spv_vendor` int DEFAULT NULL,
  `mengetahui_spv_onsite` int DEFAULT NULL,
  `mengetahui_manajer_onsite` int DEFAULT NULL,
  `dateFrom` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateTo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_email` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `tanggal_cetak` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajuan_cuti_onsite`
--

LOCK TABLES `pengajuan_cuti_onsite` WRITE;
/*!40000 ALTER TABLE `pengajuan_cuti_onsite` DISABLE KEYS */;
INSERT INTO `pengajuan_cuti_onsite` VALUES (1,1,'2','8','Sakit','Sakit',NULL,NULL,1,4,5,6,5,'2025-08-01','2025-08-04',NULL,'2025-08-01 09:23:34','01-08-2025-16:23:34','01-08-2025-16:24:25'),(2,1,'2','3','-','-',NULL,NULL,1,4,5,6,5,'2025-08-01','2025-08-04',NULL,'2025-08-01 09:25:51','01-08-2025-16:25:51','01-08-2025-16:27:57');
/*!40000 ALTER TABLE `pengajuan_cuti_onsite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `performa_testing`
--

DROP TABLE IF EXISTS `performa_testing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `performa_testing` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `checker_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_aplikasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_web` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akses` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_mobile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_desktop` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link_capture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `jam_pengecekan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_cetak` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tools` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performa_testing`
--

LOCK TABLES `performa_testing` WRITE;
/*!40000 ALTER TABLE `performa_testing` DISABLE KEYS */;
/*!40000 ALTER TABLE `performa_testing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'pos.menu','web','pos','2025-05-21 02:56:04','2025-05-21 02:56:04'),(2,'employee.menu','web','employee','2025-05-21 02:56:05','2025-05-21 02:56:05'),(3,'customer.menu','web','customer','2025-05-21 02:56:05','2025-05-21 02:56:05'),(4,'supplier.menu','web','supplier','2025-05-21 02:56:05','2025-05-21 02:56:05'),(5,'salary.menu','web','salary','2025-05-21 02:56:05','2025-05-21 02:56:05'),(6,'attendence.menu','web','attendence','2025-05-21 02:56:05','2025-05-21 02:56:05'),(7,'category.menu','web','category','2025-05-21 02:56:05','2025-05-21 02:56:05'),(8,'product.menu','web','product','2025-05-21 02:56:05','2025-05-21 02:56:05'),(9,'orders.menu','web','orders','2025-05-21 02:56:06','2025-05-21 02:56:06'),(10,'stock.menu','web','stock','2025-05-21 02:56:06','2025-05-21 02:56:06'),(11,'roles.menu','web','roles','2025-05-21 02:56:06','2025-05-21 02:56:06'),(12,'user.menu','web','user','2025-05-21 02:56:06','2025-05-21 02:56:06'),(13,'database.menu','web','database','2025-05-21 02:56:06','2025-05-21 02:56:06'),(14,'timesheet.menu','web','timesheet','2025-08-13 09:50:50','2025-08-13 10:26:08');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `product_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_garage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_store` int DEFAULT NULL,
  `buying_date` date DEFAULT NULL,
  `expire_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_price` int DEFAULT NULL,
  `selling_price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'laboriosam',1,4,'PC01','A',NULL,563,'2025-05-21','2027-05-21 09:56:01',69,9,'2025-05-21 02:56:01','2025-05-21 02:56:01'),(2,'dolore',2,8,'PC02','C',NULL,458,'2025-05-21','2027-05-21 09:56:01',43,52,'2025-05-21 02:56:01','2025-05-21 02:56:01'),(3,'veniam',5,5,'PC03','D',NULL,348,'2025-05-21','2027-05-21 09:56:01',3,37,'2025-05-21 02:56:01','2025-05-21 02:56:01'),(4,'quos',4,9,'PC04','D',NULL,331,'2025-05-21','2027-05-21 09:56:01',91,48,'2025-05-21 02:56:01','2025-05-21 02:56:01'),(5,'quis',2,6,'PC05','D',NULL,680,'2025-05-21','2027-05-21 09:56:01',88,5,'2025-05-21 02:56:01','2025-05-21 02:56:01'),(6,'nesciunt',5,9,'PC06','B',NULL,485,'2025-05-21','2027-05-21 09:56:02',62,69,'2025-05-21 02:56:02','2025-05-21 02:56:02'),(7,'maxime',4,7,'PC07','D',NULL,347,'2025-05-21','2027-05-21 09:56:02',4,93,'2025-05-21 02:56:02','2025-05-21 02:56:02'),(8,'ullam',4,8,'PC08','C',NULL,194,'2025-05-21','2027-05-21 09:56:02',62,0,'2025-05-21 02:56:02','2025-05-21 02:56:02'),(9,'eveniet',3,6,'PC09','C',NULL,255,'2025-05-21','2027-05-21 09:56:02',52,89,'2025-05-21 02:56:02','2025-05-21 02:56:02'),(10,'molestias',5,3,'PC10','C',NULL,471,'2025-05-21','2027-05-21 09:56:02',66,58,'2025-05-21 02:56:02','2025-05-21 02:56:02');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `report_timesheet`
--

DROP TABLE IF EXISTS `report_timesheet`;
/*!50001 DROP VIEW IF EXISTS `report_timesheet`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `report_timesheet` AS SELECT 
 1 AS `employee_id`,
 1 AS `bulan`,
 1 AS `year`,
 1 AS `staff`,
 1 AS `leader`,
 1 AS `spv_onsite`,
 1 AS `manajer_onsite`,
 1 AS `ttd_employee`,
 1 AS `ttd_leader`,
 1 AS `ttd_spv`,
 1 AS `ttd_mnj`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(6,2),(3,3),(4,3),(12,3),(2,4),(5,4),(8,4),(9,4),(10,4);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SuperAdmin','web','2025-05-21 02:56:06','2025-05-21 02:56:06'),(2,'Admin','web','2025-05-21 02:56:07','2025-05-21 02:56:07'),(3,'Account','web','2025-05-21 02:56:07','2025-05-21 02:56:07'),(4,'Manager','web','2025-05-21 02:56:07','2025-05-21 02:56:07');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shopname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suppliers_email_unique` (`email`),
  UNIQUE KEY `suppliers_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'Aimee Runolfsson','edwin.donnelly@example.org','320-603-6349','293 O\'Kon Harbors\nHauckmouth, MD 44130-7264','Dickinson LLC',NULL,'Distributor','Mr. Emmanuel Schiller','47738531','MANDIRI','East Dorian','North Emilie','2025-05-21 02:56:01','2025-05-21 02:56:01'),(2,'Rickie Treutel','terrell63@example.net','380.518.9111','2148 Kari Union\nNorth Jeffborough, IA 99639','Tremblay, Turcotte and Kertzmann',NULL,'Whole Seller','Breana Barrows IV','91914625','BJB','East Jarrell','West Malachi','2025-05-21 02:56:01','2025-05-21 02:56:01'),(3,'Dr. Nico Leffler','fisher.salma@example.org','+1-610-371-7511','9338 Thelma Highway Suite 241\nGrahamport, SD 55315-2943','Leannon-Rolfson',NULL,'Distributor','Dr. Lee Watsica','83562648','BSI','Kaylieshire','Haileeport','2025-05-21 02:56:01','2025-05-21 02:56:01'),(4,'Vincent Boyer','hilario83@example.net','248.980.0077','174 Block Spurs\nSchimmelland, ID 30324','Harvey-Pouros',NULL,'Distributor','Kelli Rosenbaum PhD','21445615','BJB','Schadenfurt','West Jaiden','2025-05-21 02:56:01','2025-05-21 02:56:01'),(5,'Vena Predovic PhD','hegmann.patsy@example.org','1-458-491-4454','628 Stanton Meadow Suite 165\nLake Eltonborough, MD 30667-3416','Brekke, Hermann and Bruen',NULL,'Distributor','Giles Breitenberg','26096285','MANDIRI','South Dashawn','Port Broderickberg','2025-05-21 02:56:01','2025-05-21 02:56:01'),(6,'Dereck Fay','tod79@example.com','+1-351-425-8677','259 Maggio Radial\nO\'Connellborough, AR 19295','Volkman, Fay and Medhurst',NULL,'Whole Seller','Clementina Schowalter','86056799','BJB','New Arvillaport','East Gregorio','2025-05-21 02:56:01','2025-05-21 02:56:01'),(7,'Rhiannon Wolff','pagac.webster@example.com','(540) 801-2003','781 Jonathon Way\nFritschland, DC 20535-1852','Funk Inc',NULL,'Distributor','Daren Schmeler','24533953','BJB','Aimeeview','Franciscofurt','2025-05-21 02:56:01','2025-05-21 02:56:01'),(8,'Mrs. Fabiola Oberbrunner','treutel.tod@example.com','+1-534-644-7540','245 Block Square\nMcCulloughhaven, WA 31711-7644','Ernser, Bins and Labadie',NULL,'Distributor','Leilani Okuneva','44735981','BNI','East Bradyton','New Veronica','2025-05-21 02:56:01','2025-05-21 02:56:01'),(9,'Mr. Ulises Kirlin Sr.','shakira18@example.net','+1-619-718-4275','395 Buckridge Glens Suite 167\nJohnathonport, OR 28452-5322','Davis-Bergstrom',NULL,'Distributor','Lamont Ruecker','36352821','BNI','Abernathyville','New Clairview','2025-05-21 02:56:01','2025-05-21 02:56:01'),(10,'Mrs. Ciara Stokes I','klein.effie@example.com','1-802-366-6252','5603 Naomie River Apt. 772\nTiannabury, DC 29149-5783','Quitzon, Durgan and Gerlach',NULL,'Distributor','Claudia Kunde','21609064','MANDIRI','Crooksville','South Hestermouth','2025-05-21 02:56:01','2025-05-21 02:56:01');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timesheet_work`
--

DROP TABLE IF EXISTS `timesheet_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timesheet_work` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `past_activity` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_activity` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obstacle` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `today_goal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_timesheet` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_cetak` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_tanggal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timesheet_work`
--

LOCK TABLES `timesheet_work` WRITE;
/*!40000 ALTER TABLE `timesheet_work` DISABLE KEYS */;
INSERT INTO `timesheet_work` VALUES (1,1,NULL,'<p>-Wajib diisikan</p>',NULL,'<p>testing isi</p>','','','01-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-14:59:11','2026-03-12 14:59:11'),(2,1,NULL,'<p>-Wajib diisi</p>',NULL,NULL,'','','02-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-14:58:49','2026-03-12 14:58:49'),(3,1,'','','','','','','03-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(4,1,'','','','','','','04-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(5,1,'','','','','','','05-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(6,1,'','','','','','','06-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(7,1,'','','','','','','07-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(8,1,'','','','','','','08-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(9,1,'','','','','','','09-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(10,1,'','','','','','','10-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(11,1,'','','','','','','11-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(12,1,'','','','','','','12-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(13,1,'','','','','','','13-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(14,1,'','','','','','','14-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(15,1,'','','','','','','15-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(16,1,'','','','','','','16-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(17,1,'','','','','','','17-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(18,1,'','','','','','','18-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(19,1,'','','','','','','19-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(20,1,'','','','','','','20-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(21,1,'','','','','','','21-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(22,1,'','','','','','','22-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(23,1,'','','','','','','23-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(24,1,'','','','','','','24-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(25,1,'','','','','','','25-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(26,1,'','','','','','','26-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(27,1,'','','','','','','27-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(28,1,'','','','','','','28-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(29,1,'','','','','','','29-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(30,1,'','','','','','','30-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL),(31,1,'','','','','','','31-03-2026','12-03-2026-10:25:31','12-03-2026','12-03-2026-10:25:31',NULL);
/*!40000 ALTER TABLE `timesheet_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timesheet_work_signature`
--

DROP TABLE IF EXISTS `timesheet_work_signature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timesheet_work_signature` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `bulan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff` int DEFAULT NULL,
  `leader` int DEFAULT NULL,
  `spv_onsite` int DEFAULT NULL,
  `manajer_onsite` int DEFAULT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timesheet_work_signature`
--

LOCK TABLES `timesheet_work_signature` WRITE;
/*!40000 ALTER TABLE `timesheet_work_signature` DISABLE KEYS */;
INSERT INTO `timesheet_work_signature` VALUES (4,1,'03','2026',1,6,3,8,'12-03-2026-10:25:31','25-03-2026-10:26:21');
/*!40000 ALTER TABLE `timesheet_work_signature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tk`
--

DROP TABLE IF EXISTS `tk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `kategori_aplikasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_aplikasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `framework` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_manual_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_link_1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_link_2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_tk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bahasa_pemograman` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_cetak` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tk`
--

LOCK TABLES `tk` WRITE;
/*!40000 ALTER TABLE `tk` DISABLE KEYS */;
INSERT INTO `tk` VALUES (7,2,NULL,'1','testing 123','Laravel 10',NULL,NULL,NULL,'testing 456','1','PHP','1970-01-01 15:00:00','1','1970-01-01 15:00:00');
/*!40000 ALTER TABLE `tk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Super Admin','taufiksakbar@gmail.com','2025-05-21 02:55:58','$2y$10$GHxmk4eodRGBijTFo8IWbO2DXbHraE4gSh1YZdpOXWd3wNOZ476Oq','tqhENV2qLaMBs66GocUak7Jgi5AiCmr1aicYfjDMj3ExTVb7pkrdsIcgh2YD','2025-05-21 02:55:58','2026-03-26 07:37:19','admin',NULL),(2,2,'Rizky','rizky@gmail.com','2025-05-21 02:55:58','$2y$10$PMzwM4u8GKfEI05x11WpsuKCU0Ex4af45sexA0A9VKz9gL2iaq3gq','gHhbzYfuwF6fWC74apqqM9RyxgS3unLEIhb0eo6aTL7hZqecDITAalGkIlxI','2025-05-21 02:55:58','2025-08-13 09:58:56','user',NULL),(3,3,'Surya','surya@gmail.com',NULL,'$2y$10$.H6lJMDvvzowRo8YQeFSYu1Ny57KetFdjGoQJupaIih1PiIuLxM7e',NULL,'2025-08-14 07:22:53','2025-08-14 07:22:53','surya',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_list_absent`
--

DROP TABLE IF EXISTS `v_list_absent`;
/*!50001 DROP VIEW IF EXISTS `v_list_absent`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_list_absent` AS SELECT 
 1 AS `date`,
 1 AS `waktu_cetak`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_timesheet`
--

DROP TABLE IF EXISTS `v_timesheet`;
/*!50001 DROP VIEW IF EXISTS `v_timesheet`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_timesheet` AS SELECT 
 1 AS `id`,
 1 AS `employee_id`,
 1 AS `count_past_activity`,
 1 AS `count_plant_activity`,
 1 AS `count_obstacle`,
 1 AS `today_goal`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_total_timesheetbyemployee_id`
--

DROP TABLE IF EXISTS `v_total_timesheetbyemployee_id`;
/*!50001 DROP VIEW IF EXISTS `v_total_timesheetbyemployee_id`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_total_timesheetbyemployee_id` AS SELECT 
 1 AS `employee_id`,
 1 AS `tot_past`,
 1 AS `tot_plant`,
 1 AS `tot_obstacle`,
 1 AS `tot_today_goal`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `zap`
--

DROP TABLE IF EXISTS `zap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zap` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `kategori_aplikasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_aplikasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akses` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `high` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `low` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `informational` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_capture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_zap_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solusi_troubleshoot` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status_zap` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tanggal_cetak` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zap`
--

LOCK TABLES `zap` WRITE;
/*!40000 ALTER TABLE `zap` DISABLE KEYS */;
INSERT INTO `zap` VALUES (2,2,'1','1','1','1','1','1','1','mobile - sistem berjalan normal\r\n dekstop - sistem berjalan normal','https://drive.google.com/file/d/17lTXIsNq2dl0rAdtJEpZkb96NQYgLt13/view?usp=sharing','42d6c7d61481d1c21bd1635f59edae05.pdf','https://drive.google.com/file/d/17lTXIsNq2dl0rAdtJEpZkb96NQYgLt13/view?usp=sharing','2','2025-05-22 09:32:14','2025-05-22 09:32:14','2025-05-22 17:32:14');
/*!40000 ALTER TABLE `zap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `report_timesheet`
--

/*!50001 DROP VIEW IF EXISTS `report_timesheet`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `report_timesheet` AS select `b`.`employee_id` AS `employee_id`,month(str_to_date(`timesheet_work`.`tanggal_timesheet`,'%d-%m-%Y')) AS `bulan`,year(str_to_date(`timesheet_work`.`tanggal_timesheet`,'%d-%m-%Y')) AS `year`,`b`.`staff` AS `staff`,`b`.`leader` AS `leader`,`b`.`spv_onsite` AS `spv_onsite`,`b`.`manajer_onsite` AS `manajer_onsite`,(case when (`b`.`staff` <> '') then (select `data_signatures`.`ttd_link` from `data_signatures` where (`data_signatures`.`employee_id` = `b`.`staff`)) end) AS `ttd_employee`,(case when (`b`.`leader` <> '') then (select `data_signatures`.`ttd_link` from `data_signatures` where (`data_signatures`.`employee_id` = `b`.`leader`)) end) AS `ttd_leader`,(case when (`b`.`spv_onsite` <> '') then (select `data_signatures`.`ttd_link` from `data_signatures` where (`data_signatures`.`employee_id` = `b`.`spv_onsite`)) end) AS `ttd_spv`,(case when (`b`.`manajer_onsite` <> '') then (select `data_signatures`.`ttd_link` from `data_signatures` where (`data_signatures`.`employee_id` = `b`.`manajer_onsite`)) end) AS `ttd_mnj` from ((`timesheet_work` left join `timesheet_work_signature` `b` on((`b`.`employee_id` = `timesheet_work`.`employee_id`))) left join `data_signatures` `c` on((`c`.`employee_id` = `b`.`employee_id`))) group by `b`.`employee_id`,month(str_to_date(`timesheet_work`.`tanggal_timesheet`,'%d-%m-%Y')),year(str_to_date(`timesheet_work`.`tanggal_timesheet`,'%d-%m-%Y')),`b`.`staff`,`b`.`leader`,`b`.`spv_onsite`,`c`.`ttd_link`,`b`.`manajer_onsite` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_list_absent`
--

/*!50001 DROP VIEW IF EXISTS `v_list_absent`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_list_absent` AS select `attendences`.`date` AS `date`,`attendences`.`waktu_cetak` AS `waktu_cetak` from `attendences` group by `attendences`.`date`,`attendences`.`waktu_cetak` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_timesheet`
--

/*!50001 DROP VIEW IF EXISTS `v_timesheet`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_timesheet` AS select `timesheet_work`.`id` AS `id`,`timesheet_work`.`employee_id` AS `employee_id`,(case when (`timesheet_work`.`past_activity` is not null) then '1' else '0' end) AS `count_past_activity`,(case when (`timesheet_work`.`plan_activity` is not null) then '1' else '0' end) AS `count_plant_activity`,(case when (`timesheet_work`.`obstacle` is not null) then '1' when (`timesheet_work`.`obstacle` is null) then '1' else '0' end) AS `count_obstacle`,(case when (`timesheet_work`.`today_goal` is not null) then '1' else '0' end) AS `today_goal` from `timesheet_work` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_total_timesheetbyemployee_id`
--

/*!50001 DROP VIEW IF EXISTS `v_total_timesheetbyemployee_id`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_total_timesheetbyemployee_id` AS select `v_timesheet`.`employee_id` AS `employee_id`,sum(`v_timesheet`.`count_past_activity`) AS `tot_past`,sum(`v_timesheet`.`count_plant_activity`) AS `tot_plant`,sum(`v_timesheet`.`count_obstacle`) AS `tot_obstacle`,sum(`v_timesheet`.`today_goal`) AS `tot_today_goal` from `v_timesheet` where (`v_timesheet`.`count_past_activity` is not null) group by `v_timesheet`.`employee_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-26 15:19:59
