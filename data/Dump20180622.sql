CREATE DATABASE  IF NOT EXISTS `aid` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `aid`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 192.168.33.11    Database: aid
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Table structure for table `api_access`
--

DROP TABLE IF EXISTS `api_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `applications` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_hash` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_access`
--

LOCK TABLES `api_access` WRITE;
/*!40000 ALTER TABLE `api_access` DISABLE KEYS */;
INSERT INTO `api_access` VALUES (1,'33f3c8db70d437ce41cfbd1bbde0f413',1,'web_aid_project','2018-03-08 09:06:38','0');
/*!40000 ALTER TABLE `api_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(16) NOT NULL,
  `lname` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL COMMENT 'Рейтинг участника системы (в соответсвие с ним определяется приоритет и выдается заказ) ',
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 - не удален\n1 - удален\n',
  PRIMARY KEY (`id_employee`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'asd','asd','boo@asd.com',0,'',0,'2018-03-09 14:48:59','1'),(2,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-09 15:16:58','0'),(3,'фыв','фыв','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 12:17:53','0'),(4,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:14:55','0'),(5,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:16:44','0'),(6,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:18:07','0'),(7,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:22','0'),(8,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:22','0'),(9,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:23','0'),(10,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:23','0'),(11,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:24','0'),(12,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:25','0'),(13,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:25','0'),(14,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:25','0'),(15,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:19:39','0'),(16,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:22:22','0'),(17,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:28:53','0'),(18,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:31:03','0'),(19,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:35:43','0'),(20,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 16:00:40','0'),(21,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 17:48:22','0'),(22,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 17:57:56','0'),(23,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-11 12:25:40','0'),(24,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-11 12:33:47','0'),(25,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-04-24 07:44:36','0'),(26,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-04-24 07:53:43','0'),(27,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-04-24 07:55:27','0'),(28,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-04-24 08:21:37','0'),(29,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-05-04 08:43:43','0'),(30,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-05-04 08:44:20','0'),(31,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-05-04 11:00:47','0'),(32,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-05-04 11:01:19','0'),(33,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-05-04 11:02:48','0'),(34,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-05-04 11:31:29','0'),(35,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-06-04 12:46:12','0'),(36,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-06-13 11:42:37','0'),(37,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 07:53:18','1'),(38,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',1,'2018-06-22 09:05:53','0'),(39,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',1,'2018-06-22 09:06:25','0'),(40,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',1,'2018-06-22 09:11:31','0'),(41,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 09:13:08','1');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_profession`
--

DROP TABLE IF EXISTS `employee_profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_profession` (
  `id_employee` int(11) NOT NULL,
  `id_profession` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 - не удален\n1 - удален\n',
  `price` int(11) NOT NULL DEFAULT '0',
  `experience` varchar(100) NOT NULL DEFAULT '' COMMENT 'Стаж работы по данной специальности.',
  `description` text,
  PRIMARY KEY (`id_employee`,`id_profession`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Сответсвует рабочему и професии.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_profession`
--

LOCK TABLES `employee_profession` WRITE;
/*!40000 ALTER TABLE `employee_profession` DISABLE KEYS */;
INSERT INTO `employee_profession` VALUES (1,1,'2018-06-04 12:45:41','0',100,'1 год','HAHAHAH'),(4,1,'2018-05-17 14:11:54','0',0,'',''),(41,12,'2018-06-22 09:42:35','0',100,'2 года','TEST TEST TEST TEST'),(41,13,'2018-06-22 09:44:22','0',100,'2 года','TEST TEST TEST TEST');
/*!40000 ALTER TABLE `employee_profession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `address` text,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 - не удален\n1 - удален\n',
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,NULL,NULL,0,'blabla','9160','bb@asd.com','2018-03-07 11:50:30','1'),(2,NULL,NULL,0,'blabla','9160','bb@asd.com','2018-03-07 11:50:43','0'),(3,NULL,NULL,0,'2222','9160','bb@asd.com','2018-03-07 11:50:52','0'),(4,NULL,NULL,0,'111111','12321312','bb@asd.com','2018-03-07 11:50:58','0'),(5,NULL,NULL,1,'TEST','1991',NULL,'2018-03-09 12:12:24','0'),(6,NULL,NULL,1,'FFFF','1991',NULL,'2018-03-09 12:12:24','0'),(7,NULL,NULL,1,'asddddd','1991',NULL,'2018-03-09 12:12:24','0'),(8,NULL,NULL,1,'asddddd','1111435',NULL,'2018-03-09 12:12:24','0'),(9,NULL,NULL,1,'asddddd','123213',NULL,'2018-03-09 12:12:24','0'),(10,NULL,NULL,0,'asddddd','1111222',NULL,'2018-03-09 12:12:24','1'),(11,NULL,NULL,1,'asddddd','1111222',NULL,'2018-03-09 12:12:24','0'),(12,NULL,NULL,1,'asddddd','1111222','boo@dd.com','2018-03-09 12:12:24','0'),(13,NULL,NULL,0,'asddddd','1111222','boo@dd.ru','2018-03-09 12:12:24','1'),(14,NULL,NULL,0,'asddddd','1111222','boo@dd.cc','2018-03-09 12:12:24','1'),(15,NULL,NULL,0,'фывыфв',NULL,NULL,'2018-03-10 12:16:10','0'),(16,NULL,NULL,0,'фывыфв','1111222','boo@dd.cc','2018-06-22 08:36:50','0'),(17,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 08:54:50','0'),(18,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 08:59:42','0'),(19,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 09:02:28','0'),(20,NULL,NULL,0,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 09:06:40','1'),(21,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 09:13:05','0'),(22,NULL,NULL,0,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 09:13:23','1');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profession`
--

DROP TABLE IF EXISTS `profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profession` (
  `id_profession` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_profession`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profession`
--

LOCK TABLES `profession` WRITE;
/*!40000 ALTER TABLE `profession` DISABLE KEYS */;
INSERT INTO `profession` VALUES (1,'Сантехник','2018-03-10 12:20:03','0'),(2,'Электрик','2018-03-10 12:20:03','0'),(3,'ТВ мастер','2018-03-10 12:20:03','0'),(4,'ПК мастер','2018-03-10 12:20:03','0'),(5,'Ремонт стиральных машинок','2018-03-10 12:20:03','0'),(6,'hello','2018-04-25 06:25:02','1'),(7,'hello','2018-04-25 06:27:05','1'),(8,'БОГ','2018-05-04 11:31:38','0'),(9,'БОГ','2018-05-04 11:32:13','0'),(10,'БОГ','2018-05-04 11:32:15','0'),(11,'БОГ','2018-05-04 11:32:33','0'),(12,'TEST_PROF','2018-06-22 09:28:10','0'),(13,'TEST_PROF','2018-06-22 09:44:19','0');
/*!40000 ALTER TABLE `profession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'aid'
--

--
-- Dumping routines for database 'aid'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-22 13:43:56
