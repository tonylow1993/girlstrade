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
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `locationID` int(11) NOT NULL,
  `parentID` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `nameCN` varchar(50) DEFAULT NULL,
  `postCount` bigint(20) DEFAULT NULL,
  `viewCount` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`locationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (0,0,1,'All Locations','All Locations',16,0),(1,NULL,1,'Hong Kong Island','香港',1,0),(2,NULL,1,'Kowloon','九龍',1,0),(3,NULL,1,'New Territories','新畀',0,0),(4,1,2,'Central and Western','中西區',1,0),(5,1,2,'Eastern','東區',0,0),(6,1,2,'Southern','南區',0,0),(7,1,2,'Wan Chai','灣仔區',0,0),(8,2,2,'Sham Shui Po','深水埗區',0,0),(9,2,2,'Kowloon City','九龍城區',0,0),(10,2,2,'Kwun Tong','觀塘區',1,0),(11,2,2,'Wong Tai Sin','黃大仙區',0,0),(12,2,2,'Yau Tsim Mong','油尖旺區',0,0),(13,3,2,'Islands','離島區',0,0),(14,3,2,'Kwai Tsing','葵青區',0,0),(15,3,2,'North','北區',0,0),(16,3,2,'Sai Kung','西貢區',0,0),(17,3,2,'Sha Tin','沙田區',0,0),(18,3,2,'Tai Po','大埔區',0,0),(19,3,2,'Tsuen Wan','荃灣區',0,0),(20,3,2,'Tuen Mun','屯門區',0,0),(21,3,2,'Yuen Long','元朗區',0,0),(22,15,3,'Lo Wu','羅湖',0,0),(23,15,3,'Lok Ma Chau','落馬洲',0,0),(24,15,3,'Sheung Shui','上水',0,0),(25,15,3,'Fanling','粉嶺',0,0),(26,18,3,'Tai Wo','太和',0,0),(27,18,3,'Tai Po Market','大埔墟',0,0),(28,17,3,'University','大學',0,0),(29,17,3,'Racecourse','馬場',0,0),(30,17,3,'Sha Tin','沙田',0,0),(31,17,3,'Tai Wai','大圍',0,0),(32,11,3,'Kowloon Tong','九龍塘',0,0),(33,12,3,'Mong Kok East','旺角東',0,0),(34,12,3,'Hung Hom','紅磡',0,0),(35,12,3,'Whampoa','',0,0),(36,11,3,'Ho Man Tin','',0,0),(37,12,3,'Yau Ma Tei','油麻地',0,0),(38,12,3,'Mong Kok','旺角',0,0),(39,12,3,'Prince Edward','太子',0,0),(40,11,3,'Shek Kip Mei','石硤尾',0,0),(42,11,3,'Lok Fu','樂富',0,0),(43,11,3,'Wong Tai Sin','黃大仙',0,0),(44,11,3,'Diamond Hill','鑽石山',0,0),(45,11,3,'Choi Hung','彩虹',0,0),(46,10,3,'Kowloon Bay','九龍灣',0,0),(47,10,3,'Ngau Tau Kok','牛頭角',0,0),(48,10,3,'Kwun Tong','觀塘',0,0),(49,10,3,'Lam Tin','藍田',0,0),(50,10,3,'Yau Tong','油塘',0,0),(51,16,3,'Tiu Keng Leng','調景嶺',0,0),(52,19,3,'Tsuen Wan','荃灣',0,0),(53,19,3,'Tai Wo Hau','大窩口',0,0),(54,14,3,'Kwai Hing','葵興',0,0),(55,14,3,'Kwai Fong','葵芳',0,0),(56,14,3,'Lai King','荔景',0,0),(57,14,3,'Mei Foo','美孚',0,0),(58,8,3,'Lai Chi Kok','荔枝角',0,0),(59,8,3,'Cheung Sha Wan','長沙灣\n',0,0),(60,8,3,'Sham Shui Po','深水埗\n',0,0),(61,12,3,'Jordan','佐敦',0,0),(62,12,3,'Tsim Sha Tsui','尖沙咀',0,0),(63,4,3,'Admiralty','金鐘',0,0),(64,4,3,'Central','中環',1,0),(65,4,3,'Kennedy Town','堅尼地城',0,0),(66,4,3,'HKU','香港大學',0,0),(67,4,3,'Sai Ying Pun','西營盤',0,0),(68,4,3,'Sheung Wan','上環',0,0),(69,7,3,'Wan Chai','灣仔',0,0),(70,7,3,'Causeway Bay','銅鑼灣',0,0),(71,7,3,'Tin Hau','天后',0,0),(72,5,3,'Fortress Hill','炮台山',0,0),(73,5,3,'North Point','北角',0,0),(74,5,3,'Quarry Bay','鰂魚涌',0,0),(75,5,3,'Tai Koo','太古',0,0),(76,5,3,'Sai Wan Ho','西灣河',0,0),(77,5,3,'Shau Kei Wan','筲箕灣',0,0),(78,5,3,'Heng Fa Chuen','杏花綫',0,0),(79,5,3,'Chai Wan','柴灣',0,0),(80,13,3,'Tung Chung','東涌',0,0),(81,13,3,'Sunny Bay','欣澳',0,0),(82,14,3,'Tsing Yi','青衣',0,0),(84,8,3,'Nam Cheong','南昌',0,0),(85,8,3,'Olympic','奧運',0,0),(88,13,3,'Airport','',0,0),(89,16,3,'Po Lam','寶琳',0,0),(90,16,3,'Hang Hau','坑口',0,0),(91,16,3,'LOHAS Park','康城',0,0),(92,16,3,'Tseung Kwan O','將軍澳',0,0),(93,20,3,'Tuen Mun','屯門',0,0),(94,20,3,'Siu Hong','兆康',0,0),(95,20,3,'Tin Shui Wai','天水圍',0,0),(96,20,3,'Long Ping','朗屏',0,0),(97,21,3,'Yuen Long','元朗',0,0),(98,21,3,'Kam Sheung Road','錦上路',0,0),(99,19,3,'Tsuen Wan West','荃灣西',0,0),(100,12,3,'Austin','柯士甸',0,0),(101,12,3,'East Tsim Sha Tsui','尖東',0,0),(102,12,3,'Hung Hom','紅磡',0,0),(103,16,3,'Wu Kai Sha','烏溪沙',0,0),(104,16,3,'Ma On Shan','馬鞍山',0,0),(105,16,3,'Heng On','恒安',0,0),(106,16,3,'Tai Shui Hang','大水坑',0,0),(107,16,3,'Shek Mun','石門',0,0),(108,16,3,'City One','第一城',0,0),(109,16,3,'Sha Tin Wai','沙田圍',0,0),(110,16,3,'Che Kung Temple','車公廟',0,0);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-20  4:52:25
