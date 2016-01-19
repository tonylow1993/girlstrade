-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: raydb
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `parentID` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `nameCH` varchar(45) DEFAULT NULL,
  `postCount` bigint(20) DEFAULT NULL,
  `iconImage` varchar(300) DEFAULT NULL,
  `viewCount` bigint(20) DEFAULT NULL,
  `childCount` bigint(20) DEFAULT NULL,
  `searchCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`categoryID`),
  KEY `fk_category_1_idx` (`parentID`),
  CONSTRAINT `fk_category_1` FOREIGN KEY (`parentID`) REFERENCES `category` (`categoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,NULL,1,'Dresses','連身裙',11,'images/category_icon/連身裙.png',0,4,66),(2,NULL,1,'Tops','上身',0,'images/category_icon/上身.png',0,5,1),(3,NULL,1,'Bottoms','下身',0,'images/category_icon/下身.png',0,5,11),(4,NULL,1,'Outerwear','外套',0,'images/category_icon/外套.png',0,4,1),(5,NULL,1,'Rompers','連衫褲',0,'images/category_icon/連衫褲.png',0,3,7),(6,NULL,1,'Hat','帽子',0,'images/category_icon/帽子.png',0,0,2),(7,NULL,1,'Jewelry','珠寶首飾',0,'images/category_icon/珠寶首飾.png',0,6,7),(8,NULL,1,'Bag/Wallet','袋',0,'images/category_icon/袋.png',0,5,5),(9,NULL,1,'Shoes','鞋子',0,'images/category_icon/鞋子.png',0,5,1),(10,NULL,1,'Kids/Baby','兒童產品',0,'images/category_icon/兒童產品.png',0,1,0),(11,NULL,1,'Sleepwear','睡衣',0,'images/category_icon/睡衣.png',0,3,0),(12,NULL,1,'Swimwear','游泳衣',0,'images/category_icon/游泳衣.png',0,1,0),(13,NULL,1,'Beauty','美容產品',0,'images/category_icon/美容產品.png',0,5,6),(14,NULL,1,'Lingerie','內衣褲',0,'images/category_icon/內衣褲.png',0,4,2),(15,NULL,1,'Electronics','電子產品',0,'images/category_icon/電子產品.png',0,4,0),(16,NULL,1,'Sportwear','運動服',0,'images/category_icon/運動服.png',0,1,9),(17,NULL,1,'Other','其他',0,'images/category_icon/其他.png',0,5,10),(19,1,2,'Long Dress','長裙',5,'images/category_icon/長裙.png',1,0,11),(20,1,2,'Short Dress','短裙',2,'images/category_icon/短裙.png',0,0,9),(21,1,2,'Formal Dress','禮服',0,'images/category_icon/禮服.png',0,0,12),(23,2,2,'T-Shirt','短袖衫',0,'images/category_icon/短袖衫.png',0,0,24),(24,2,2,'Long Sleeve','長袖衫',0,'images/category_icon/長袖衫.png',0,0,33),(25,2,2,'Tank ','背心',0,'images/category_icon/背心.png',0,0,1),(26,2,2,'Blouse','隆重衣服',0,'images/category_icon/隆重衣服.png',0,0,2),(28,3,2,'Skirt','半截裙',0,'images/category_icon/半截裙.png',0,0,2),(29,3,2,'Shorts','短褲',0,'images/category_icon/短褲.png',0,0,0),(30,3,2,'Long Pants','長褲',0,'images/category_icon/長褲.png',0,0,1),(31,3,2,'Leggings','緊身褲',0,'images/category_icon/緊身褲.png',0,0,2),(33,4,2,'Jacket','外套',0,'images/category_icon/外套.png',0,0,12),(34,4,2,'Vest','背心',0,'images/category_icon/背心.png',0,0,2),(35,4,2,'Blazer','西裝外套',0,'images/category_icon/西裝外套.png',0,0,13),(37,5,2,'Formal','隆重連衫褲',0,'images/category_icon/隆重連衫褲.png',0,0,0),(38,5,2,'Sporty','運動連衫褲',0,'images/category_icon/運動連衫褲.png',0,0,2),(40,8,2,'Handbag','手袋',0,'images/category_icon/手袋.png',0,0,14),(41,8,2,'Backpack','背包',0,'images/category_icon/背包.png',0,0,7),(42,8,2,'Wallet','錢包',0,'images/category_icon/錢包.png',0,0,14),(43,8,2,'Shoulder Bag','單肩包',0,'images/category_icon/單肩包.png',0,0,2),(45,7,2,'Necklace','頸鏈',0,'images/category_icon/頸鏈.png',0,0,12),(46,7,2,'Earrings','耳環',0,'images/category_icon/耳環.png',0,0,3),(47,7,2,'Ring','指環',0,'images/category_icon/指環.png',0,0,2),(48,7,2,'Bracelet','手鐲',0,'images/category_icon/手鐲.png',0,0,1),(49,7,2,'Watch','手錶',0,'images/category_icon/手錶.png',0,0,3),(52,9,2,'High heels','高跟鞋',0,'images/category_icon/高跟鞋.png',0,0,0),(53,9,2,'Sneakers','帆布鞋',0,'images/category_icon/帆布鞋.png',0,0,3),(54,9,2,'Sandals','拖鞋',0,'images/category_icon/拖鞋.png',0,0,0),(55,9,2,'Boots','靴子',0,'images/category_icon/靴子.png',0,0,0),(58,11,2,'Clothes','衣物',0,'images/category_icon/衣物.png',0,0,1),(62,11,2,'Equipment','用品',0,'images/category_icon/用品.png',0,0,86),(64,13,2,'Beauty','美容電器',0,'images/category_icon/美容電器.png',0,0,25),(65,13,2,'Mask','面膜',0,'images/category_icon/面膜.png',0,0,16),(66,13,2,'Cream','精華霜',0,'images/category_icon/精華霜.png',0,0,0),(67,13,2,'Beauty Products','美容用品',0,'images/category_icon/美容用品.png',0,0,2),(69,14,2,'Underclothes','內衣',0,'images/category_icon/內衣.png',0,0,2),(70,14,2,'Bra','胸罩',0,'images/category_icon/胸罩.png',0,0,2),(71,14,2,'Underwear','內衣褲',0,'images/category_icon/內衣褲.png',0,0,0),(73,15,2,'Beauty','美容電器',0,'images/category_icon/美容電器.png',0,0,0),(74,15,2,'Home Product','家庭電器',0,'images/category_icon/家庭電器.png',0,0,2),(75,15,2,'Photography','攝錄器材',0,'images/category_icon/攝錄器材.png',0,0,2),(78,17,2,'Phone case','手機套',0,'images/category_icon/手機套.png',0,0,0),(79,17,2,'Book','書',0,'images/category_icon/書.png',0,0,0),(80,17,2,'CD/DVD','CD/DVD',0,'images/category_icon/CD/DVD.png',0,0,5),(81,17,2,'Accessories','裝飾物',0,'images/category_icon/裝飾物.png',0,0,0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-20  4:52:23
