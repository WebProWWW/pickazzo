-- MySQL dump 10.13  Distrib 8.0.21, for macos10.15 (x86_64)
--
-- Host: localhost    Database: pickazzo
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `editor`
--

DROP TABLE IF EXISTS `editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `editor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  KEY `idx-editor-page_id` (`page_id`),
  CONSTRAINT `fk-editor-page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editor`
--

LOCK TABLES `editor` WRITE;
/*!40000 ALTER TABLE `editor` DISABLE KEYS */;
/*!40000 ALTER TABLE `editor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  KEY `idx-faq-page_id` (`page_id`),
  CONSTRAINT `fk-faq-page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-file-page_id` (`page_id`),
  CONSTRAINT `fk-file-page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (1,1,'home.php'),(2,2,'kollektsii.php'),(3,3,'hudozhniki.php'),(4,4,'prodano.php'),(5,5,'podlinnost.php'),(6,6,'sotrudnichestvo.php'),(7,7,'blog.php'),(8,8,'kontakty.php');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `html`
--

DROP TABLE IF EXISTS `html`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `html` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  KEY `idx-html-page_id` (`page_id`),
  CONSTRAINT `fk-html-page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `html`
--

LOCK TABLES `html` WRITE;
/*!40000 ALTER TABLE `html` DISABLE KEYS */;
/*!40000 ALTER TABLE `html` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'/img/catalog/demo-1.jpg'),(2,'/img/catalog/demo-2.jpg'),(3,'/img/catalog/demo-3.jpg'),(4,'/img/catalog/demo-4.jpg'),(5,'/img/catalog/demo-5.jpg'),(6,'/img/catalog/demo-6.jpg'),(7,'/img/catalog/demo-7.jpg'),(8,'/img/catalog/demo-8.jpg'),(9,'/img/catalog/demo-9.jpg');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1597206909),('m200708_005547_init',1598567743);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `default` tinyint DEFAULT '0',
  `active` tinyint DEFAULT '1',
  `order` int DEFAULT '0',
  `view` varchar(255) NOT NULL,
  `menu_enable` tinyint DEFAULT '0',
  `menu_label` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `idx-page-active` (`active`),
  KEY `idx-page-order` (`order`),
  KEY `idx-page-parent_id` (`parent_id`),
  CONSTRAINT `fk-page-parent` FOREIGN KEY (`parent_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,NULL,1,1,0,'file',1,'О проекте','О проекте','glavnaya',NULL,NULL,1598567742,1598567742),(2,NULL,0,1,0,'product-category-list',1,'Коллекции','Коллекции','kollektsii',NULL,NULL,1598567742,1598567742),(3,NULL,0,1,0,'file',1,'Художники','Художники','hudozhniki',NULL,NULL,1598567742,1598567742),(4,NULL,0,1,0,'file',1,'Продано','Продано','prodano',NULL,NULL,1598567742,1598567742),(5,NULL,0,1,0,'file',1,'Подлинность','Подлинность','podlinnost',NULL,NULL,1598567742,1598567742),(6,NULL,0,1,0,'file',1,'Сотрудничество','Сотрудничество','sotrudnichestvo',NULL,NULL,1598567742,1598567742),(7,NULL,0,1,0,'file',1,'Блог','Блог','blog',NULL,NULL,1598567742,1598567742),(8,NULL,0,1,0,'file',1,'Контакты','Контакты','kontakty',NULL,NULL,1598567742,1598567742),(9,2,0,1,0,'product-category',0,'','Дмитрий Миронов','dmitrij-mironov',NULL,NULL,1598567742,1598567742),(10,2,0,1,0,'product-category',0,'','Оксана Девочкина','oksana-devochkina',NULL,NULL,1598567742,1598567742),(11,2,0,1,0,'product-category',0,'','Лиза Земскова','liza-zemskova',NULL,NULL,1598567742,1598567742),(12,2,0,1,0,'product-category',0,'','Иван Иванов','ivan-ivanov',NULL,NULL,1598567742,1598567742),(13,2,0,1,0,'product-category',0,'','Анна Сашкевич','anna-sashkevich',NULL,NULL,1598567742,1598567742),(14,2,0,1,0,'product-category',0,'','Александр Спок','aleksandr-spok',NULL,NULL,1598567742,1598567742),(15,9,0,1,0,'product',0,'','Trust','trust-1',NULL,NULL,1598567742,1598567742),(16,9,0,1,0,'product',0,'','Trust','trust-2',NULL,NULL,1598567742,1598567742),(17,9,0,1,0,'product',0,'','Trust','trust-3',NULL,NULL,1598567742,1598567742),(18,10,0,1,0,'product',0,'','Trust','trust-4',NULL,NULL,1598567742,1598567742),(19,10,0,1,0,'product',0,'','Trust','trust-5',NULL,NULL,1598567742,1598567742),(20,10,0,1,0,'product',0,'','Trust','trust-6',NULL,NULL,1598567742,1598567742),(21,11,0,1,0,'product',0,'','Trust','trust-7',NULL,NULL,1598567742,1598567742),(22,11,0,1,0,'product',0,'','Trust','trust-8',NULL,NULL,1598567742,1598567742),(23,11,0,1,0,'product',0,'','Trust','trust-9',NULL,NULL,1598567742,1598567742),(24,12,0,1,0,'product',0,'','Trust','trust-10',NULL,NULL,1598567742,1598567742),(25,12,0,1,0,'product',0,'','Trust','trust-11',NULL,NULL,1598567742,1598567742),(26,12,0,1,0,'product',0,'','Trust','trust-12',NULL,NULL,1598567742,1598567742),(27,13,0,1,0,'product',0,'','Trust','trust-13',NULL,NULL,1598567742,1598567742),(28,13,0,1,0,'product',0,'','Trust','trust-14',NULL,NULL,1598567742,1598567742),(29,13,0,1,0,'product',0,'','Trust','trust-15',NULL,NULL,1598567742,1598567742),(30,14,0,1,0,'product',0,'','Trust','trust-16',NULL,NULL,1598567742,1598567742),(31,14,0,1,0,'product',0,'','Trust','trust-17',NULL,NULL,1598567742,1598567742),(32,14,0,1,0,'product',0,'','Trust','trust-18',NULL,NULL,1598567742,1598567742);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `views` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `img` varchar(255) DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  KEY `idx-post-page_id` (`page_id`),
  CONSTRAINT `fk-post-page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tag` (
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `idx-post_tag-post_id` (`post_id`),
  KEY `idx-post_tag-tag_id` (`tag_id`),
  CONSTRAINT `fk-post_tag-post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-post_tag-tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tag`
--

LOCK TABLES `post_tag` WRITE;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `artikul` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `description` longtext,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-product-page_id` (`page_id`),
  CONSTRAINT `fk-product-page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,15,'Trust','Cloud Mone','00001','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',495000),(2,16,'Trust','Cloud Mone','00002','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',500000),(3,17,'Trust','Cloud Mone','00003','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',510000),(4,18,'Trust','Cloud Mone','00004','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',520000),(5,19,'Trust','Cloud Mone','00005','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',530000),(6,20,'Trust','Cloud Mone','00006','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',540000),(7,21,'Trust','Cloud Mone','00007','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',560000),(8,22,'Trust','Cloud Mone','00008','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',570000),(9,23,'Trust','Cloud Mone','00009','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',580000),(10,24,'Trust','Cloud Mone','00010','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',590000),(11,25,'Trust','Cloud Mone','00011','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',600000),(12,26,'Trust','Cloud Mone','00012','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',610000),(13,27,'Trust','Cloud Mone','00013','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',620000),(14,28,'Trust','Cloud Mone','00014','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',630000),(15,29,'Trust','Cloud Mone','00015','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',640000),(16,30,'Trust','Cloud Mone','00016','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',650000),(17,31,'Trust','Cloud Mone','00017','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',660000),(18,32,'Trust','Cloud Mone','00018','4000х4000 px','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',670000);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-product_category-image_id` (`image_id`),
  KEY `idx-product_category-page_id` (`page_id`),
  CONSTRAINT `fk-product_category-image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-product_category-page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (1,9,'Дмитрий Миронов',1),(2,10,'Оксана Девочкина',2),(3,11,'Лиза Земскова',3),(4,12,'Иван Иванов',4),(5,13,'Анна Сашкевич',5),(6,14,'Александр Спок',6);
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_id` int NOT NULL,
  `order` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx-product_image-product_id` (`product_id`),
  KEY `idx-product_image-image_id` (`image_id`),
  CONSTRAINT `fk-product_image-image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-product_image-product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_image`
--

LOCK TABLES `product_image` WRITE;
/*!40000 ALTER TABLE `product_image` DISABLE KEYS */;
INSERT INTO `product_image` VALUES (1,1,1,1),(2,1,2,2),(3,1,3,3),(4,1,4,4),(5,1,5,5),(6,2,6,1),(7,2,7,2),(8,2,8,3),(9,2,9,4),(10,2,1,5),(11,3,2,1),(12,3,3,2),(13,3,4,3),(14,3,5,4),(15,3,6,5),(16,4,7,1),(17,4,8,2),(18,4,9,3),(19,4,1,4),(20,4,2,5),(21,5,3,1),(22,5,4,2),(23,5,5,3),(24,5,6,4),(25,5,7,5),(26,6,8,1),(27,6,9,2),(28,6,1,3),(29,6,2,4),(30,6,3,5),(31,7,4,1),(32,7,5,2),(33,7,6,3),(34,7,7,4),(35,7,8,5),(36,8,9,1),(37,8,1,2),(38,8,2,3),(39,8,3,4),(40,8,4,5),(41,9,5,1),(42,9,6,2),(43,9,7,3),(44,9,8,4),(45,9,9,5),(46,10,1,1),(47,10,2,2),(48,10,3,3),(49,10,4,4),(50,10,5,5),(51,11,6,1),(52,11,7,2),(53,11,8,3),(54,11,9,4),(55,11,1,5),(56,12,2,1),(57,12,3,2),(58,12,4,3),(59,12,5,4),(60,12,6,5),(61,13,7,1),(62,13,8,2),(63,13,9,3),(64,13,1,4),(65,13,2,5),(66,14,3,1),(67,14,4,2),(68,14,5,3),(69,14,6,4),(70,14,7,5),(71,15,8,1),(72,15,9,2),(73,15,1,3),(74,15,2,4),(75,15,3,5),(76,16,4,1),(77,16,5,2),(78,16,6,3),(79,16,7,4),(80,16,8,5),(81,17,9,1),(82,17,1,2),(83,17,2,3),(84,17,3,4),(85,17,4,5),(86,18,5,1),(87,18,6,2),(88,18,7,3),(89,18,8,4),(90,18,9,5);
/*!40000 ALTER TABLE `product_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `img` varchar(255) DEFAULT NULL,
  `content` longtext,
  `price` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-service-page_id` (`page_id`),
  CONSTRAINT `fk-service-page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tag-name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` smallint NOT NULL DEFAULT '20',
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_confirm_token` varchar(255) DEFAULT NULL,
  `api_key` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `subscribe` smallint DEFAULT '0',
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_confirm_token` (`email_confirm_token`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `idx-user-status` (`status`),
  KEY `idx-user-auth_key` (`auth_key`),
  KEY `idx-user-api_key` (`api_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,30,'Admin','Админ','admin@mail.com',NULL,'1GOeegQmxHqL4FCLJro2W9U-fWEq3yzp','hkcNL99qx5N6CS8kMAsR2dP2RTAwYh3T','$2y$13$wh64xKEmlcQCAppWCOEieutV.pcQvmggdaC0ETOh0AYg3N0ldIyz2',NULL,0,1598567742,1598567742);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-28  5:03:24
