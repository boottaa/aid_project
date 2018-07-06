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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-22 13:41:57