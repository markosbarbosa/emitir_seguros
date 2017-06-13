-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: emitir_seguros
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `emitir_seguros`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `emitir_seguros` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `emitir_seguros`;

--
-- Table structure for table `creditcards`
--

DROP TABLE IF EXISTS `creditcards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditcards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expiration_year` char(4) DEFAULT NULL,
  `expiration_month` char(2) DEFAULT NULL,
  `cvv` varchar(5) DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `number` char(16) DEFAULT NULL,
  `purchases_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_creditcard_purchases1_idx` (`purchases_id`),
  CONSTRAINT `fk_creditcard_purchases1` FOREIGN KEY (`purchases_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditcards`
--

LOCK TABLES `creditcards` WRITE;
/*!40000 ALTER TABLE `creditcards` DISABLE KEYS */;
INSERT INTO `creditcards` VALUES (21,'2018','05','218','visa','4539364224900581',32,'2017-06-12 08:49:58','2017-06-12 08:49:58'),(22,'2018','04','99-0','visa','8080980808080808',33,'2017-06-12 09:39:12','2017-06-12 09:39:12'),(23,'2018','04','99-0','visa','8080980808080808',34,'2017-06-12 09:39:14','2017-06-12 09:39:14'),(24,'2018','05','218','visa','4539364224900581',35,'2017-06-12 09:54:48','2017-06-12 09:54:48'),(25,'2018','05','218','visa','4539364224900581',36,'2017-06-12 10:12:36','2017-06-12 10:12:36'),(26,'2018','05','218','visa','4539364224900581',37,'2017-06-12 10:31:04','2017-06-12 10:31:04'),(34,'2018','05','218','visa','4539364224900581',45,'2017-06-12 10:37:22','2017-06-12 10:37:22'),(35,'2018','05','218','visa','4539364224900581',46,'2017-06-12 10:39:27','2017-06-12 10:39:27'),(45,'2018','05','218','visa','4539364224900581',56,'2017-06-12 10:51:15','2017-06-12 10:51:15'),(52,'2019','02','192','visa','5227450997868156',63,'2017-06-13 05:36:42','2017-06-13 05:36:42'),(59,'2019','03','195','visa','5227450997868156',70,'2017-06-13 06:50:08','2017-06-13 06:50:08'),(69,'2019','02','193','visa','5227450997868156',80,'2017-06-13 07:08:18','2017-06-13 07:08:18'),(70,'2019','02','193','visa','5227450997868156',81,'2017-06-13 07:47:37','2017-06-13 07:47:37'),(71,'2019','02','193','visa','5227450997868156',82,'2017-06-13 07:59:46','2017-06-13 07:59:46');
/*!40000 ALTER TABLE `creditcards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insureds`
--

DROP TABLE IF EXISTS `insureds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insureds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` varchar(50) DEFAULT NULL,
  `document_type` varchar(50) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `purchases_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_insureds_purchases_idx` (`purchases_id`),
  CONSTRAINT `fk_insureds_purchases` FOREIGN KEY (`purchases_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insureds`
--

LOCK TABLES `insureds` WRITE;
/*!40000 ALTER TABLE `insureds` DISABLE KEYS */;
INSERT INTO `insureds` VALUES (31,'756.546.517-81','CPF','Marcos Barbosa','1986-05-14',32,'2017-06-12 08:49:58','2017-06-12 08:49:58'),(32,'980.808.090-00','CPF','ddfads','2017-06-13',33,'2017-06-12 09:39:12','2017-06-12 09:39:12'),(33,'980.808.090-00','CPF','ddfads','2017-06-13',34,'2017-06-12 09:39:14','2017-06-12 09:39:14'),(34,'356.494.200-92','CPF','Teste 2','1990-09-17',35,'2017-06-12 09:54:48','2017-06-12 09:54:48'),(35,'813.803.236-73','CPF','Teste 1','1986-09-13',36,'2017-06-12 10:12:36','2017-06-12 10:12:36'),(36,'138.004.253-43','CPF','Teste 2','1980-07-17',36,'2017-06-12 10:12:36','2017-06-12 10:12:36'),(37,'123.456.789-99','CPF','Marcos Barbosa','1987-09-14',37,'2017-06-12 10:31:04','2017-06-12 10:31:04'),(45,'123.456.789-99','CPF','Marcos Barbosa','1987-09-14',45,'2017-06-12 10:37:22','2017-06-12 10:37:22'),(46,'123.456.789-99','CPF','Marcos Barbosa','1987-09-14',46,'2017-06-12 10:39:27','2017-06-12 10:39:27'),(56,'387.663.515-29','CPF','Marcos Barbosa','1986-05-14',56,'2017-06-12 10:51:15','2017-06-12 10:51:15'),(64,'775.639.766-55','CPF','Marcos Barbosa','1986-05-14',63,'2017-06-13 05:36:42','2017-06-13 05:36:42'),(71,'775.639.766-55','CPF','Marcos Barbosa','1986-05-14',70,'2017-06-13 06:50:08','2017-06-13 06:50:08'),(84,'212.464.541-22','CPF','Marcos Barbosa','1986-05-14',80,'2017-06-13 07:08:18','2017-06-13 07:08:18'),(85,'577.988.227-47','CPF','Marcos Barbosa','1986-05-14',81,'2017-06-13 07:47:37','2017-06-13 07:47:37'),(86,'074.882.493-64','CPF','Marcos Barbosa','1986-05-14',82,'2017-06-13 07:59:46','2017-06-13 07:59:46'),(87,'355.280.387-40','CPF','Teste','1986-09-14',82,'2017-06-13 07:59:46','2017-06-13 07:59:46');
/*!40000 ALTER TABLE `insureds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_contacts`
--

DROP TABLE IF EXISTS `purchase_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `purchases_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_contact_purchases1_idx` (`purchases_id`),
  CONSTRAINT `fk_purchase_contact_purchases1` FOREIGN KEY (`purchases_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_contacts`
--

LOCK TABLES `purchase_contacts` WRITE;
/*!40000 ALTER TABLE `purchase_contacts` DISABLE KEYS */;
INSERT INTO `purchase_contacts` VALUES (21,'Marcos Barbosa','(31) 92343-0101','1233',32,'2017-06-12 08:49:58','2017-06-12 08:49:58'),(22,'sdfasd','(09) 8080-08900','1233',33,'2017-06-12 09:39:13','2017-06-12 09:39:13'),(23,'sdfasd','(09) 8080-08900','1233',34,'2017-06-12 09:39:14','2017-06-12 09:39:14'),(24,'Marcos Barbosa','(31) 9876-56777','1233',35,'2017-06-12 09:54:48','2017-06-12 09:54:48'),(25,'Marcos Barbosa','(31) 9877-68886','1233',36,'2017-06-12 10:12:36','2017-06-12 10:12:36'),(26,'Marcos Barbosa','(31) 8980-00000','1233',37,'2017-06-12 10:31:04','2017-06-12 10:31:04'),(34,'Marcos Barbosa','(31) 8980-00000','1233',45,'2017-06-12 10:37:22','2017-06-12 10:37:22'),(35,'Marcos Barbosa','(31) 8980-00000','1233',46,'2017-06-12 10:39:27','2017-06-12 10:39:27'),(45,'Marcos Barbosa','(45) 3936-42249','1233',56,'2017-06-12 10:51:15','2017-06-12 10:51:15'),(52,'Marcos Barbosa','(31) 9887-98980','1233',63,'2017-06-13 05:36:42','2017-06-13 05:36:42'),(59,'Marcos Barbosa','(31) 0980-80980','1233',70,'2017-06-13 06:50:08','2017-06-13 06:50:08'),(69,'Marcos Barbosa','(31) 0890-80808','1233',80,'2017-06-13 07:08:18','2017-06-13 07:08:18'),(70,'Marcos Barbosa','(31) 9809-80809','1233',81,'2017-06-13 07:47:37','2017-06-13 07:47:37'),(71,'Marcos Barbosa','(31) 0989-08098','1233',82,'2017-06-13 07:59:46','2017-06-13 07:59:46');
/*!40000 ALTER TABLE `purchase_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` int(11) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `coverage_begin` date DEFAULT NULL,
  `coverage_end` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `parcels` int(11) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `holder_cpf` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (32,12,'brasil','2017-06-13','2017-06-30','creditcard',56.88,1,'Marcos Barbosa','756.546.517-81','2017-06-12 08:49:58','2017-06-12 08:49:58'),(33,14,'brasil','2017-06-13','2017-06-30','creditcard',107.64,1,'dsfasdf','098.080.980-89','2017-06-12 09:39:12','2017-06-12 09:39:12'),(34,14,'brasil','2017-06-13','2017-06-30','creditcard',107.64,1,'dsfasdf','098.080.980-89','2017-06-12 09:39:14','2017-06-12 09:39:14'),(35,14,'brasil','2017-06-13','2017-06-30','creditcard',107.64,1,'Marcos Barbosa','886.562.887-17','2017-06-12 09:54:48','2017-06-12 09:54:48'),(36,14,'brasil','2017-06-13','2017-06-30','creditcard',107.64,1,'Marcos Barbosa','682.095.274-01','2017-06-12 10:12:36','2017-06-12 10:12:36'),(37,49,'brasil','2017-06-13','2017-06-13','creditcard',11.95,1,'Marcos Barbosa','682.095.274-01','2017-06-12 10:31:04','2017-06-12 10:31:04'),(45,49,'brasil','2017-06-13','2017-06-13','creditcard',11.95,1,'Marcos Barbosa','682.095.274-01','2017-06-12 10:37:22','2017-06-12 10:37:22'),(46,49,'brasil','2017-06-13','2017-06-13','creditcard',11.95,1,'Marcos Barbosa','682.095.274-01','2017-06-12 10:39:27','2017-06-12 10:39:27'),(56,49,'brasil','2017-06-13','2017-06-13','creditcard',11.95,1,'Marcos Barbosa','387.663.515-29','2017-06-12 10:51:15','2017-06-12 10:51:15'),(63,14,'brasil','2017-06-13','2017-06-13','creditcard',5.98,1,'Marcos Barbosa','775.639.766-55','2017-06-13 05:36:42','2017-06-13 05:36:42'),(70,14,'brasil','2017-06-14','2017-06-14','creditcard',5.98,1,'Marcos Barbosa','775.639.766-55','2017-06-13 06:50:08','2017-06-13 06:50:08'),(80,14,'brasil','2017-06-14','2017-06-14','creditcard',5.98,1,'Marcos Barbosa','212.464.541-22','2017-06-13 07:08:18','2017-06-13 07:08:18'),(81,14,'brasil','2017-06-14','2017-06-18','creditcard',29.90,1,'Marcos Barbosa','577.988.227-47','2017-06-13 07:47:37','2017-06-13 07:47:37'),(82,33,'brasil','2017-06-14','2017-06-16','creditcard',7.89,1,'Marcos Barbosa','074.882.493-64','2017-06-13 07:59:46','2017-06-13 07:59:46');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-13  2:01:01
