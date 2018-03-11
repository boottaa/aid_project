-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 192.168.33.10    Database: Aid
-- ------------------------------------------------------
-- Server version	5.5.57-0ubuntu0.14.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'asd','asd','boo@asd.com',0,'',0,'2018-03-09 14:48:59','0'),(2,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-09 15:16:58','0'),(3,'фыв','фыв','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',0,'2018-03-10 12:17:53','0'),(4,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:14:55','0'),(5,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:16:44','0'),(6,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:18:07','0'),(7,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:22','0'),(8,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:22','0'),(9,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:23','0'),(10,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:23','0'),(11,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:24','0'),(12,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:25','0'),(13,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:25','0'),(14,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 13:35:25','0'),(15,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:19:39','0'),(16,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:22:22','0'),(17,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:28:53','0'),(18,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:31:03','0'),(19,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 15:35:43','0'),(20,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 16:00:40','0'),(21,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 17:48:22','0'),(22,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-10 17:57:56','0'),(23,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-11 12:25:40','0'),(24,'FFF','AAA','asd@asd.com',100,'47e1841c8f52d31cd3a4633bd14998c5',1,'2018-03-11 12:33:47','0');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-11 20:03:34
