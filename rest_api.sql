/*Create user*/
CREATE USER 'restapi'@'localhost' IDENTIFIED BY 'restapi';
GRANT ALL PRIVILEGES ON *.* TO 'restapi'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;

/*Create database*/
CREATE DATABASE rest_api;

-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: rest_api
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `quantity` float DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'LG P880 4X HD','LG_P880_4X_HD','My first awesome phone!',336,3,'2019-01-31 16:39:54','2019-01-31 11:09:54'),(2,'Google Nexus 4','Google_Nexus_4','The most awesome phone of 2013!',299,2,'2019-01-31 16:42:15','2019-01-31 11:12:15'),(3,'Samsung Galaxy S4','Samsung_Galaxy_S4','How about no?',600,3,'2019-01-31 16:42:15','2019-01-31 11:12:15'),(4,'Bench Shirt','Bench_Shirt','The best shirt!',29,1,'2019-01-31 16:42:15','2019-01-31 11:12:15'),(5,'Lenovo Laptop','Lenovo_Laptop','My business partner.',399,2,'2019-01-31 16:42:15','2019-01-31 11:12:15'),(6,'Samsung Galaxy Tab 10.1','Samsung_Galaxy_Tab_10.1','Good tablet.',259,2,'2019-01-31 16:42:15','2019-01-31 11:12:15'),(7,'Spalding Watch','Spalding_Watch','My sports watch.',199,1,'2019-01-31 16:42:15','2019-01-31 11:12:15'),(8,'Sony Smart Watch','Sony_Smart_Watch','The coolest smart watch!',300,2,'2019-01-31 16:42:15','2019-01-31 11:12:15'),(9,'Huawei Y300','Huawei_Y300','For testing purposes.',100,2,'2019-01-31 16:42:15','2019-01-31 11:12:15');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-31 16:56:04
