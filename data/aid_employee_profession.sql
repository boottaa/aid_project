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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-22 13:41:57
