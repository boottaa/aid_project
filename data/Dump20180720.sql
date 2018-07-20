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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(16) NOT NULL,
  `lname` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL COMMENT 'Рейтинг участника системы (в соответсвие с ним определяется приоритет и выдается заказ) ',
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 - не удален\n1 - удален\n',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'asd','asd','boo@asd.com',0,'',0,'2018-03-09 14:48:59','1'),(2,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-09 15:16:58','1'),(3,'фыв','фыв','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 12:17:53','1'),(4,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:14:55','1'),(5,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:16:44','1'),(6,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:18:07','1'),(7,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:35:22','1'),(8,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:35:22','1'),(9,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:35:23','1'),(10,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:35:23','1'),(11,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:35:24','1'),(12,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:35:25','1'),(13,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:35:25','1'),(14,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 13:35:25','1'),(15,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 15:19:39','1'),(16,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 15:22:22','1'),(17,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 15:28:53','1'),(18,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 15:31:03','1'),(19,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 15:35:43','1'),(20,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 16:00:40','1'),(21,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 17:48:22','1'),(22,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 17:57:56','1'),(23,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-11 12:25:40','1'),(24,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-11 12:33:47','1'),(25,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-04-24 07:44:36','1'),(26,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-04-24 07:53:43','1'),(27,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-04-24 07:55:27','1'),(28,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-04-24 08:21:37','1'),(29,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-05-04 08:43:43','1'),(30,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-05-04 08:44:20','1'),(31,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-05-04 11:00:47','1'),(32,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-05-04 11:01:19','1'),(33,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-05-04 11:02:48','1'),(34,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-05-04 11:31:29','1'),(35,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-06-04 12:46:12','1'),(36,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-06-13 11:42:37','1'),(37,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 07:53:18','1'),(38,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 09:05:53','1'),(39,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 09:06:25','1'),(40,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 09:11:31','1'),(41,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 09:13:08','1'),(42,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 12:09:32','1'),(43,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 12:18:14','1'),(44,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 12:18:40','1'),(45,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 12:18:49','1'),(46,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 12:19:15','1'),(47,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-22 12:19:21','1'),(48,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-26 11:24:35','1'),(49,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-26 11:24:44','1'),(50,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-26 11:24:51','1'),(51,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-27 14:57:22','1'),(52,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-06-28 08:16:16','1'),(53,'xxx','x2x','aaa@fs.ru',50,'test',0,'2018-06-28 11:52:11','1'),(54,'xxx','x2x','aaa@fs.ru',50,'test',0,'2018-06-28 11:52:15','1'),(55,'xxx','x2x','aaa@fs.ru',50,'test',0,'2018-06-28 12:52:03','1'),(56,'xxx','x2x','aaa@fs.ru',50,'test',0,'2018-06-28 12:52:29','1'),(57,'xxx','x2x','aaa@fs.ru',50,'test',0,'2018-06-28 12:54:25','1'),(58,'xxx','x2x','aaa@fs.ru',50,'test',0,'2018-06-28 12:56:56','1'),(59,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-06-29 11:50:44','1'),(60,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-06-29 13:35:57','1'),(61,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-06-29 14:00:51','1'),(62,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-06-29 14:00:52','1'),(63,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-02 10:54:22','1'),(64,'TEST_AUT','TEST_AUT','TEST_AUT@te.ru',50,'TEST_AUT',0,'2018-07-02 10:58:18','1'),(65,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-09 10:17:43','1'),(66,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-09 10:19:15','1'),(67,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-13 09:43:35','1'),(68,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-13 10:53:51','1'),(69,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-13 10:57:37','1'),(70,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-13 10:57:47','1'),(71,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-13 10:58:52','1'),(72,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-13 10:59:04','1'),(73,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-13 10:59:40','1'),(74,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-13 10:59:55','1'),(75,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-17 13:41:55','1'),(76,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',0,'2018-07-17 13:43:50','1'),(77,'TEST_MODEL','x2x','aaa@fs.ru',50,'test',1,'2018-07-17 13:59:29','0');
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
INSERT INTO `employee_profession` VALUES (1,1,'2018-06-04 12:45:41','0',100,'1 год','HAHAHAH'),(2,2,'2018-06-26 11:23:53','0',100,'2 года','TEST TEST TEST TEST'),(2,16,'2018-06-26 11:24:08','0',100,'2 года','TEST TEST TEST TEST'),(4,1,'2018-05-17 14:11:54','0',0,'',''),(41,12,'2018-06-22 09:42:35','0',100,'2 года','TEST TEST TEST TEST'),(41,13,'2018-06-22 09:44:22','0',100,'2 года','TEST TEST TEST TEST'),(47,14,'2018-06-22 12:19:43','0',100,'2 года','TEST TEST TEST TEST'),(50,17,'2018-06-26 11:25:17','0',100,'2 года','TEST TEST TEST TEST'),(50,18,'2018-06-26 11:25:38','0',100,'2 года','TEST TEST TEST TEST'),(50,19,'2018-06-26 11:25:41','0',100,'2 года','TEST TEST TEST TEST'),(50,20,'2018-06-26 11:25:57','0',100,'2 года','TEST TEST TEST TEST'),(60,24,'2018-06-29 13:59:00','0',50,'2 года','test'),(60,25,'2018-06-29 13:59:08','1',50,'2 года','test'),(62,26,'2018-06-29 14:01:00','1',50,'2 года','test'),(63,27,'2018-07-02 10:54:54','1',50,'2 года','test'),(64,28,'2018-07-02 10:58:31','0',100,'2 года','TEST TEST TEST TEST');
/*!40000 ALTER TABLE `employee_profession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `address` text,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 - не удален\n1 - удален\n',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,NULL,NULL,0,'blabla','9160','bb@asd.com','2018-03-07 11:50:30','1'),(2,NULL,NULL,0,'blabla','9160','bb@asd.com','2018-03-07 11:50:43','1'),(3,NULL,NULL,0,'2222','9160','bb@asd.com','2018-03-07 11:50:52','1'),(4,NULL,NULL,0,'111111','12321312','bb@asd.com','2018-03-07 11:50:58','1'),(5,NULL,NULL,1,'TEST','1991',NULL,'2018-03-09 12:12:24','1'),(6,NULL,NULL,1,'FFFF','1991',NULL,'2018-03-09 12:12:24','1'),(7,NULL,NULL,1,'asddddd','1991',NULL,'2018-03-09 12:12:24','1'),(8,NULL,NULL,1,'asddddd','1111435',NULL,'2018-03-09 12:12:24','1'),(9,NULL,NULL,1,'asddddd','123213',NULL,'2018-03-09 12:12:24','1'),(10,NULL,NULL,0,'asddddd','1111222',NULL,'2018-03-09 12:12:24','1'),(11,NULL,NULL,1,'asddddd','1111222',NULL,'2018-03-09 12:12:24','1'),(12,NULL,NULL,1,'asddddd','1111222','boo@dd.com','2018-03-09 12:12:24','1'),(13,NULL,NULL,0,'asddddd','1111222','boo@dd.ru','2018-03-09 12:12:24','1'),(14,NULL,NULL,0,'asddddd','1111222','boo@dd.cc','2018-03-09 12:12:24','1'),(15,NULL,NULL,0,'фывыфв',NULL,NULL,'2018-03-10 12:16:10','1'),(16,NULL,NULL,0,'фывыфв','1111222','boo@dd.cc','2018-06-22 08:36:50','1'),(17,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 08:54:50','1'),(18,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 08:59:42','1'),(19,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 09:02:28','1'),(20,NULL,NULL,0,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 09:06:40','1'),(21,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 09:13:05','1'),(22,NULL,NULL,0,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 09:13:23','1'),(23,NULL,NULL,0,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 12:19:28','1'),(24,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-22 12:19:35','1'),(25,NULL,NULL,0,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-06-26 11:24:56','1'),(26,1,62,0,'test','777777','test@te.ru','2018-06-29 14:36:08','1'),(27,1,62,0,'test','777777','test@te.ru','2018-06-29 14:36:22','1'),(28,1,63,0,'test','777777','test@te.ru','2018-07-02 10:55:06','1'),(29,NULL,NULL,0,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-02 10:58:25','1'),(30,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 13:33:13','1'),(31,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 13:35:54','1'),(32,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 14:00:40','1'),(33,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 14:07:13','1'),(34,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 14:09:00','1'),(35,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 14:09:59','1'),(36,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 14:10:25','1'),(37,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 14:10:37','1'),(38,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 14:10:49','1'),(39,NULL,NULL,1,NULL,NULL,NULL,'2018-07-04 14:12:32','1'),(40,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:18:25','1'),(41,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:19:00','1'),(42,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:20:10','1'),(43,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:22:15','1'),(44,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:53:59','1'),(45,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:54:10','1'),(46,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:54:46','1'),(47,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:56:36','1'),(48,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:56:51','1'),(49,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:57:42','1'),(50,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:58:28','1'),(51,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 14:59:53','1'),(52,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:02:24','1'),(53,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:02:39','1'),(54,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:02:49','1'),(55,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:03:18','1'),(56,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:04:01','1'),(57,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:04:05','1'),(58,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:04:48','1'),(59,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:04:52','1'),(60,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:05:03','1'),(61,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:09:16','1'),(62,NULL,NULL,1,'TESTAUT TEST TEST','111111111','TEST_AUT@te.ru','2018-07-04 15:10:11','1'),(63,NULL,NULL,1,NULL,NULL,NULL,'2018-07-09 10:19:23','1'),(64,NULL,NULL,1,NULL,NULL,NULL,'2018-07-17 13:58:14','1'),(65,NULL,NULL,1,NULL,NULL,NULL,'2018-07-17 13:59:00','1'),(66,NULL,NULL,1,NULL,NULL,NULL,'2018-07-17 13:59:48','1'),(67,NULL,NULL,1,NULL,NULL,NULL,'2018-07-17 14:04:34','1'),(68,NULL,NULL,1,NULL,NULL,NULL,'2018-07-17 14:15:17','1'),(69,NULL,NULL,1,NULL,NULL,NULL,'2018-07-17 14:16:46','1'),(70,NULL,NULL,1,NULL,NULL,NULL,'2018-07-17 14:19:19','1'),(71,NULL,NULL,1,NULL,NULL,NULL,'2018-07-17 14:19:46','1'),(72,1,77,1,'test test test test test testtesttest','777777','test@te.ru','2018-07-17 14:20:53','1');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profession`
--

DROP TABLE IF EXISTS `profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profession` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profession`
--

LOCK TABLES `profession` WRITE;
/*!40000 ALTER TABLE `profession` DISABLE KEYS */;
INSERT INTO `profession` VALUES (1,'Сантехник','2018-03-10 12:20:03','1'),(2,'Электрик','2018-03-10 12:20:03','1'),(3,'ТВ мастер','2018-03-10 12:20:03','1'),(4,'ПК мастер','2018-03-10 12:20:03','1'),(5,'Ремонт стиральных машинок','2018-03-10 12:20:03','1'),(6,'hello','2018-04-25 06:25:02','1'),(7,'hello','2018-04-25 06:27:05','1'),(8,'БОГ','2018-05-04 11:31:38','1'),(9,'БОГ','2018-05-04 11:32:13','1'),(10,'БОГ','2018-05-04 11:32:15','1'),(11,'БОГ','2018-05-04 11:32:33','1'),(12,'TEST_PROF','2018-06-22 09:28:10','1'),(13,'TEST_PROF','2018-06-22 09:44:19','1'),(14,'TEST_PROF','2018-06-22 12:19:38','1'),(15,'TEST_PROF','2018-06-22 12:19:48','1'),(16,'TEST_PROF','2018-06-26 11:24:05','1'),(17,'TEST_PROF','2018-06-26 11:25:09','1'),(18,'TEST_PROF','2018-06-26 11:25:33','1'),(19,'TEST_PROF','2018-06-26 11:25:40','1'),(20,'TEST_PROF','2018-06-26 11:25:56','1'),(21,'TEST_MODEL','2018-06-28 13:22:12','1'),(22,'TEST_MODEL','2018-06-28 13:23:47','1'),(23,'TEST_MODEL','2018-06-29 13:29:55','1'),(24,'TEST_MODEL','2018-06-29 13:35:59','1'),(25,'TEST_MODEL','2018-06-29 13:59:06','1'),(26,'TEST_MODEL','2018-06-29 14:00:55','1'),(27,'TEST_MODEL','2018-07-02 10:54:35','1'),(28,'TEST_PROF','2018-07-02 10:58:29','1'),(29,'TEST_MODEL','2018-07-13 12:30:37','1'),(30,'TEST_MODEL','2018-07-13 12:45:20','1'),(31,'TEST_MODEL','2018-07-13 12:46:31','1'),(32,'TEST_MODEL','2018-07-17 13:44:18','1'),(33,'TEST_MODEL','2018-07-17 14:21:06','0');
/*!40000 ALTER TABLE `profession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_address`
--

DROP TABLE IF EXISTS `users_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_address` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `address` text NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_address`
--

LOCK TABLES `users_address` WRITE;
/*!40000 ALTER TABLE `users_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_address` ENABLE KEYS */;
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

-- Dump completed on 2018-07-20 19:37:38
