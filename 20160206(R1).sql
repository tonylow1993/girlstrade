-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: raydb_backup
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
-- Table structure for table `abusemessages`
--

DROP TABLE IF EXISTS `abusemessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abusemessages` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `fUserID` int(11) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `reportreason` varchar(100) DEFAULT NULL,
  `recipientName` varchar(100) DEFAULT NULL,
  `senderEmail` varchar(100) DEFAULT NULL,
  `recipientPhoneNumber` varchar(20) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`messageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abusemessages`
--

LOCK TABLES `abusemessages` WRITE;
/*!40000 ALTER TABLE `abusemessages` DISABLE KEYS */;
/*!40000 ALTER TABLE `abusemessages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `sequence` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `country` varchar(3) DEFAULT NULL,
  `area` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `building` varchar(45) DEFAULT NULL,
  `roomNo` varchar(45) DEFAULT NULL,
  `postalCode` varchar(16) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `default` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`sequence`,`userID`),
  KEY `fk_Address_1_idx` (`userID`),
  CONSTRAINT `fk_Address_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `category` VALUES (1,NULL,1,'Dresses','連身裙',3,'images/category_icon/連身裙.png',23,3,71),(2,NULL,1,'Tops','上身',0,'images/category_icon/上身.png',0,4,1),(3,NULL,1,'Bottoms','下身',0,'images/category_icon/下身.png',0,4,11),(4,NULL,1,'Outerwear','外套',0,'images/category_icon/外套.png',0,3,1),(5,NULL,1,'Rompers','連衫褲',0,'images/category_icon/連衫褲.png',0,2,7),(6,NULL,1,'Hat','帽子',1,'images/category_icon/帽子.png',69,0,2),(7,NULL,1,'Jewelry','珠寶首飾',0,'images/category_icon/珠寶首飾.png',0,5,7),(8,NULL,1,'Bag/Wallet','袋',0,'images/category_icon/袋.png',0,4,5),(9,NULL,1,'Shoes','鞋子',0,'images/category_icon/鞋子.png',0,4,1),(10,NULL,1,'Kids/Baby','兒童產品',0,'images/category_icon/兒童產品.png',0,0,0),(11,NULL,1,'Sleepwear','睡衣',0,'images/category_icon/睡衣.png',0,2,0),(12,NULL,1,'Swimwear','游泳衣',0,'images/category_icon/游泳衣.png',0,0,0),(13,NULL,1,'Beauty','美容產品',0,'images/category_icon/美容產品.png',0,4,6),(14,NULL,1,'Lingerie','內衣褲',0,'images/category_icon/內衣褲.png',0,3,2),(15,NULL,1,'Electronics','電子產品',0,'images/category_icon/電子產品.png',0,3,0),(16,NULL,1,'Sportwear','運動服',0,'images/category_icon/運動服.png',0,0,9),(17,NULL,1,'Other','其他',0,'images/category_icon/其他.png',0,4,10),(19,1,2,'Long Dress','長裙',1,'images/category_icon/長裙.png',2,0,3),(20,1,2,'Short Dress','短裙',0,'images/category_icon/短裙.png',0,0,9),(21,1,2,'Formal Dress','禮服',1,'images/category_icon/禮服.png',4,0,12),(23,2,2,'T-Shirt','短袖衫',0,'images/category_icon/短袖衫.png',0,0,24),(24,2,2,'Long Sleeve','長袖衫',0,'images/category_icon/長袖衫.png',0,0,33),(25,2,2,'Tank ','背心',0,'images/category_icon/背心.png',0,0,1),(26,2,2,'Blouse','隆重衣服',0,'images/category_icon/隆重衣服.png',0,0,2),(28,3,2,'Skirt','半截裙',0,'images/category_icon/半截裙.png',0,0,2),(29,3,2,'Shorts','短褲',0,'images/category_icon/短褲.png',0,0,0),(30,3,2,'Long Pants','長褲',0,'images/category_icon/長褲.png',0,0,1),(31,3,2,'Leggings','緊身褲',0,'images/category_icon/緊身褲.png',0,0,2),(33,4,2,'Jacket','外套',0,'images/category_icon/外套.png',0,0,12),(34,4,2,'Vest','背心',0,'images/category_icon/背心.png',0,0,2),(35,4,2,'Blazer','西裝外套',0,'images/category_icon/西裝外套.png',0,0,13),(37,5,2,'Formal','隆重連衫褲',0,'images/category_icon/隆重連衫褲.png',0,0,0),(38,5,2,'Sporty','運動連衫褲',0,'images/category_icon/運動連衫褲.png',0,0,2),(40,8,2,'Handbag','手袋',0,'images/category_icon/手袋.png',0,0,14),(41,8,2,'Backpack','背包',0,'images/category_icon/背包.png',0,0,7),(42,8,2,'Wallet','錢包',0,'images/category_icon/錢包.png',0,0,14),(43,8,2,'Shoulder Bag','單肩包',0,'images/category_icon/單肩包.png',0,0,2),(45,7,2,'Necklace','頸鏈',0,'images/category_icon/頸鏈.png',0,0,12),(46,7,2,'Earrings','耳環',0,'images/category_icon/耳環.png',0,0,3),(47,7,2,'Ring','指環',0,'images/category_icon/指環.png',0,0,2),(48,7,2,'Bracelet','手鐲',0,'images/category_icon/手鐲.png',0,0,1),(49,7,2,'Watch','手錶',0,'images/category_icon/手錶.png',0,0,3),(52,9,2,'High heels','高跟鞋',0,'images/category_icon/高跟鞋.png',0,0,0),(53,9,2,'Sneakers','帆布鞋',0,'images/category_icon/帆布鞋.png',0,0,3),(54,9,2,'Sandals','拖鞋',0,'images/category_icon/拖鞋.png',0,0,0),(55,9,2,'Boots','靴子',0,'images/category_icon/靴子.png',0,0,0),(58,11,2,'Clothes','衣物',0,'images/category_icon/衣物.png',0,0,1),(62,11,2,'Equipment','用品',0,'images/category_icon/用品.png',0,0,86),(64,13,2,'Beauty','美容電器',0,'images/category_icon/美容電器.png',0,0,25),(65,13,2,'Mask','面膜',0,'images/category_icon/面膜.png',0,0,16),(66,13,2,'Cream','精華霜',0,'images/category_icon/精華霜.png',0,0,0),(67,13,2,'Beauty Products','美容用品',0,'images/category_icon/美容用品.png',0,0,2),(69,14,2,'Underclothes','內衣',0,'images/category_icon/內衣.png',0,0,2),(70,14,2,'Bra','胸罩',0,'images/category_icon/胸罩.png',0,0,2),(71,14,2,'Underwear','內衣褲',0,'images/category_icon/內衣褲.png',0,0,0),(73,15,2,'Beauty','美容電器',0,'images/category_icon/美容電器.png',0,0,0),(74,15,2,'Home Product','家庭電器',0,'images/category_icon/家庭電器.png',0,0,2),(75,15,2,'Photography','攝錄器材',0,'images/category_icon/攝錄器材.png',0,0,2),(78,17,2,'Phone case','手機套',0,'images/category_icon/手機套.png',0,0,0),(79,17,2,'Book','書',0,'images/category_icon/書.png',0,0,0),(80,17,2,'CD/DVD','CD/DVD',0,'images/category_icon/CD/DVD.png',0,0,5),(81,17,2,'Accessories','裝飾物',0,'images/category_icon/裝飾物.png',0,0,0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text,
  `createDate` datetime DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`commentID`),
  KEY `fk_comment_1_idx` (`postID`),
  KEY `fk_comment_2_idx` (`userID`),
  CONSTRAINT `fk_comment_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactHistory`
--

DROP TABLE IF EXISTS `contactHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactHistory` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `contactTypeID` varchar(45) CHARACTER SET utf8 NOT NULL,
  `message` varchar(800) CHARACTER SET utf8 DEFAULT NULL,
  `createDate` datetime NOT NULL,
  `status` varchar(3) NOT NULL,
  `updateDate` datetime NOT NULL,
  PRIMARY KEY (`contactID`),
  KEY `contactTypeID` (`contactTypeID`),
  KEY `contactTypeID_2` (`contactTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactHistory`
--

LOCK TABLES `contactHistory` WRITE;
/*!40000 ALTER TABLE `contactHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `contactHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactType`
--

DROP TABLE IF EXISTS `contactType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactType` (
  `contactTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nameCH` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `value` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`contactTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactType`
--

LOCK TABLES `contactType` WRITE;
/*!40000 ALTER TABLE `contactType` DISABLE KEYS */;
INSERT INTO `contactType` VALUES (1,'Advertising','廣告查詢','advertising'),(2,'Girlstrade Partnership','合作方案','partnership'),(3,'Girlstrade Account','會員帳戶','account'),(4,'General Suggestions','提出意見','suggestions'),(5,'Others','其他查詢','others');
/*!40000 ALTER TABLE `contactType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indexstat`
--

DROP TABLE IF EXISTS `indexstat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indexstat` (
  `trustedseller` int(11) DEFAULT NULL,
  `facebookfans` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indexstat`
--

LOCK TABLES `indexstat` WRITE;
/*!40000 ALTER TABLE `indexstat` DISABLE KEYS */;
/*!40000 ALTER TABLE `indexstat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interestedproduct`
--

DROP TABLE IF EXISTS `interestedproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interestedproduct` (
  `postID` int(11) DEFAULT NULL,
  `viewCount` int(11) DEFAULT NULL,
  `session_id` varchar(300) DEFAULT NULL,
  `cookies_id` varchar(300) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interestedproduct`
--

LOCK TABLES `interestedproduct` WRITE;
/*!40000 ALTER TABLE `interestedproduct` DISABLE KEYS */;
/*!40000 ALTER TABLE `interestedproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemcomments`
--

DROP TABLE IF EXISTS `itemcomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemcomments` (
  `postID` bigint(20) DEFAULT NULL,
  `usercommentID` bigint(20) DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `rejectReason` varchar(300) DEFAULT NULL,
  `rejectSpecifiedReason` varchar(300) DEFAULT NULL,
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `parentID` bigint(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemcomments`
--

LOCK TABLES `itemcomments` WRITE;
/*!40000 ALTER TABLE `itemcomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `itemcomments` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `location` VALUES (0,0,1,'All Locations','All Locations',1,0),(1,NULL,1,'Hong Kong Island','香港',3,0),(2,NULL,1,'Kowloon','九龍',0,0),(3,NULL,1,'New Territories','新界',0,0),(4,1,2,'Central and Western','中西區',2,0),(5,1,2,'Eastern','東區',0,0),(6,1,2,'Southern','南區',0,0),(7,1,2,'Wan Chai','灣仔區',1,0),(8,2,2,'Sham Shui Po','深水埗區',0,0),(9,2,2,'Kowloon City','九龍城區',0,0),(10,2,2,'Kwun Tong','觀塘區',0,0),(11,2,2,'Wong Tai Sin','黃大仙區',0,0),(12,2,2,'Yau Tsim Mong','油尖旺區',0,0),(13,3,2,'Islands','離島區',0,0),(14,3,2,'Kwai Tsing','葵青區',0,0),(15,3,2,'North','北區',0,0),(16,3,2,'Sai Kung','西貢區',0,0),(17,3,2,'Sha Tin','沙田區',0,0),(18,3,2,'Tai Po','大埔區',0,0),(19,3,2,'Tsuen Wan','荃灣區',0,0),(20,3,2,'Tuen Mun','屯門區',0,0),(21,3,2,'Yuen Long','元朗區',0,0),(22,15,3,'Lo Wu','羅湖',0,0),(23,15,3,'Lok Ma Chau','落馬洲',0,0),(24,15,3,'Sheung Shui','上水',0,0),(25,15,3,'Fanling','粉嶺',0,0),(26,18,3,'Tai Wo','太和',0,0),(27,18,3,'Tai Po Market','大埔墟',0,0),(28,17,3,'University','大學',0,0),(29,17,3,'Racecourse','馬場',0,0),(30,17,3,'Sha Tin','沙田',0,0),(31,17,3,'Tai Wai','大圍',0,0),(32,11,3,'Kowloon Tong','九龍塘',0,0),(33,12,3,'Mong Kok East','旺角東',0,0),(34,12,3,'Hung Hom','紅磡',0,0),(35,12,3,'Whampoa','',0,0),(36,11,3,'Ho Man Tin','',0,0),(37,12,3,'Yau Ma Tei','油麻地',0,0),(38,12,3,'Mong Kok','旺角',0,0),(39,12,3,'Prince Edward','太子',0,0),(40,11,3,'Shek Kip Mei','石硤尾',0,0),(42,11,3,'Lok Fu','樂富',0,0),(43,11,3,'Wong Tai Sin','黃大仙',0,0),(44,11,3,'Diamond Hill','鑽石山',0,0),(45,11,3,'Choi Hung','彩虹',0,0),(46,10,3,'Kowloon Bay','九龍灣',0,0),(47,10,3,'Ngau Tau Kok','牛頭角',0,0),(48,10,3,'Kwun Tong','觀塘',0,0),(49,10,3,'Lam Tin','藍田',0,0),(50,10,3,'Yau Tong','油塘',0,0),(51,16,3,'Tiu Keng Leng','調景嶺',0,0),(52,19,3,'Tsuen Wan','荃灣',0,0),(53,19,3,'Tai Wo Hau','大窩口',0,0),(54,14,3,'Kwai Hing','葵興',0,0),(55,14,3,'Kwai Fong','葵芳',0,0),(56,14,3,'Lai King','荔景',0,0),(57,14,3,'Mei Foo','美孚',0,0),(58,8,3,'Lai Chi Kok','荔枝角',0,0),(59,8,3,'Cheung Sha Wan','長沙灣\n',0,0),(60,8,3,'Sham Shui Po','深水埗\n',0,0),(61,12,3,'Jordan','佐敦',0,0),(62,12,3,'Tsim Sha Tsui','尖沙咀',0,0),(63,4,3,'Admiralty','金鐘',0,0),(64,4,3,'Central','中環',0,0),(65,4,3,'Kennedy Town','堅尼地城',0,0),(66,4,3,'HKU','香港大學',1,0),(67,4,3,'Sai Ying Pun','西營盤',0,0),(68,4,3,'Sheung Wan','上環',0,0),(69,7,3,'Wan Chai','灣仔',0,0),(70,7,3,'Causeway Bay','銅鑼灣',0,0),(71,7,3,'Tin Hau','天后',1,0),(72,5,3,'Fortress Hill','炮台山',0,0),(73,5,3,'North Point','北角',0,0),(74,5,3,'Quarry Bay','鰂魚涌',0,0),(75,5,3,'Tai Koo','太古',0,0),(76,5,3,'Sai Wan Ho','西灣河',0,0),(77,5,3,'Shau Kei Wan','筲箕灣',0,0),(78,5,3,'Heng Fa Chuen','杏花綫',0,0),(79,5,3,'Chai Wan','柴灣',0,0),(80,13,3,'Tung Chung','東涌',0,0),(81,13,3,'Sunny Bay','欣澳',0,0),(82,14,3,'Tsing Yi','青衣',0,0),(84,8,3,'Nam Cheong','南昌',0,0),(85,8,3,'Olympic','奧運',0,0),(88,13,3,'Airport','',0,0),(89,16,3,'Po Lam','寶琳',0,0),(90,16,3,'Hang Hau','坑口',0,0),(91,16,3,'LOHAS Park','康城',0,0),(92,16,3,'Tseung Kwan O','將軍澳',0,0),(93,20,3,'Tuen Mun','屯門',0,0),(94,20,3,'Siu Hong','兆康',0,0),(95,20,3,'Tin Shui Wai','天水圍',0,0),(96,20,3,'Long Ping','朗屏',0,0),(97,21,3,'Yuen Long','元朗',0,0),(98,21,3,'Kam Sheung Road','錦上路',0,0),(99,19,3,'Tsuen Wan West','荃灣西',0,0),(100,12,3,'Austin','柯士甸',0,0),(101,12,3,'East Tsim Sha Tsui','尖東',0,0),(102,12,3,'Hung Hom','紅磡',0,0),(103,16,3,'Wu Kai Sha','烏溪沙',0,0),(104,16,3,'Ma On Shan','馬鞍山',0,0),(105,16,3,'Heng On','恒安',0,0),(106,16,3,'Tai Shui Hang','大水坑',0,0),(107,16,3,'Shek Mun','石門',0,0),(108,16,3,'City One','第一城',0,0),(109,16,3,'Sha Tin Wai','沙田圍',0,0),(110,16,3,'Che Kung Temple','車公廟',0,0);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `fUserID` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `content` text,
  `createDate` datetime DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `replyID` int(11) DEFAULT NULL,
  `postID` bigint(20) NOT NULL,
  `recipientName` varchar(100) DEFAULT NULL,
  `senderEmail` varchar(100) DEFAULT NULL,
  `recipientPhoneNumber` varchar(100) DEFAULT NULL,
  `commentID` bigint(20) DEFAULT '0',
  `parentID` bigint(20) DEFAULT '0',
  `readflag` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`messageID`),
  KEY `fk_message_1_idx` (`userID`),
  KEY `fk_message_2_idx` (`fUserID`),
  KEY `fk_message_3_idx` (`replyID`),
  CONSTRAINT `fk_message_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_2` FOREIGN KEY (`fUserID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_3` FOREIGN KEY (`replyID`) REFERENCES `message` (`messageID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagevisited`
--

DROP TABLE IF EXISTS `pagevisited`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagevisited` (
  `userID` bigint(20) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `session_id` varchar(1000) DEFAULT NULL,
  `cookies_id` varchar(1000) DEFAULT NULL,
  `visit_time` datetime DEFAULT NULL,
  `page_visit` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagevisited`
--

LOCK TABLES `pagevisited` WRITE;
/*!40000 ALTER TABLE `pagevisited` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagevisited` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `picture`
--

DROP TABLE IF EXISTS `picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `picture` (
  `sequence` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `picturePath` varchar(45) DEFAULT NULL,
  `pictureName` varchar(45) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `thumbnailPath` varchar(45) DEFAULT NULL,
  `thumbnailName` varchar(45) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`sequence`),
  KEY `fk_picture_1_idx` (`postID`),
  KEY `fk_picture_2_idx` (`userID`),
  CONSTRAINT `fk_picture_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_picture_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `picture`
--

LOCK TABLES `picture` WRITE;
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `viewCount` int(11) DEFAULT NULL,
  `catID` int(11) DEFAULT NULL,
  `locID` int(11) DEFAULT NULL,
  `itemName` varchar(45) DEFAULT NULL,
  `itemNameCH` varchar(45) DEFAULT NULL,
  `itemPrice` double DEFAULT NULL,
  `itemQual` varchar(2) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `description` text,
  `paymentMethod` varchar(45) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `infoDisplayStatus` tinyint(1) DEFAULT NULL,
  `draftIndicator` varchar(2) DEFAULT NULL,
  `typeAds` varchar(30) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `expriyDate` datetime DEFAULT NULL,
  `newUsed` varchar(1) DEFAULT NULL,
  `postDate` datetime DEFAULT NULL,
  `soldDate` datetime DEFAULT NULL,
  `soldToUserID` int(11) DEFAULT NULL,
  `sellerRating` int(11) DEFAULT NULL,
  `sellerComment` varchar(3000) DEFAULT NULL,
  `buyerRating` int(11) DEFAULT NULL,
  `buyerComment` varchar(3000) DEFAULT NULL,
  `buyerDate` datetime DEFAULT NULL,
  `rejectSpecifiedReason` varchar(300) DEFAULT NULL,
  `rejectReason` varchar(45) DEFAULT NULL,
  `blockDate` datetime DEFAULT NULL,
  `remainQty` bigint(20) DEFAULT NULL,
  `deleteDate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`postID`),
  KEY `fk_post_1_idx` (`catID`),
  CONSTRAINT `fk_post_1` FOREIGN KEY (`catID`) REFERENCES `category` (`categoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `postmessage`
--

DROP TABLE IF EXISTS `postmessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postmessage` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `content` text,
  `status` varchar(2) DEFAULT NULL,
  `reply` varchar(2) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`messageID`),
  KEY `fk_postMessage_2_idx` (`userID`),
  KEY `fk_postMessage_1_idx` (`postID`),
  CONSTRAINT `fk_postMessage_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_postMessage_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postmessage`
--

LOCK TABLES `postmessage` WRITE;
/*!40000 ALTER TABLE `postmessage` DISABLE KEYS */;
/*!40000 ALTER TABLE `postmessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postviewhistory`
--

DROP TABLE IF EXISTS `postviewhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postviewhistory` (
  `postID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `viewTime` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `session_id` varchar(1000) DEFAULT NULL,
  `cookies_id` varchar(45) DEFAULT NULL,
  KEY `fk_postViewHistory_1_idx` (`postID`),
  KEY `fk_postViewHistory_2_idx` (`userID`),
  CONSTRAINT `fk_postViewHistory_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_postViewHistory_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postviewhistory`
--

LOCK TABLES `postviewhistory` WRITE;
/*!40000 ALTER TABLE `postviewhistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `postviewhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requestpost`
--

DROP TABLE IF EXISTS `requestpost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requestpost` (
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `status` varchar(3) DEFAULT NULL,
  `viewOption` varchar(3) DEFAULT NULL,
  `expriyDate` datetime DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`postID`),
  KEY `fk_requestPost_2_idx` (`postID`),
  CONSTRAINT `fk_requestPost_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_requestPost_2` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requestpost`
--

LOCK TABLES `requestpost` WRITE;
/*!40000 ALTER TABLE `requestpost` DISABLE KEYS */;
/*!40000 ALTER TABLE `requestpost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `savedAds`
--

DROP TABLE IF EXISTS `savedAds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `savedAds` (
  `userID` int(11) DEFAULT NULL,
  `postID` int(11) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `expriyDate` datetime DEFAULT NULL,
  `createDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `savedAds`
--

LOCK TABLES `savedAds` WRITE;
/*!40000 ALTER TABLE `savedAds` DISABLE KEYS */;
/*!40000 ALTER TABLE `savedAds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `searchhistory`
--

DROP TABLE IF EXISTS `searchhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `searchhistory` (
  `userID` int(11) DEFAULT NULL,
  `keyword` varchar(45) DEFAULT NULL,
  `catID` int(11) DEFAULT NULL,
  `locID` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `session_id` varchar(1000) DEFAULT NULL,
  `viewtime` datetime DEFAULT NULL,
  `minPrice` decimal(10,0) DEFAULT '0',
  `maxPrice` decimal(10,0) DEFAULT NULL,
  `cookies_id` varchar(1000) DEFAULT NULL,
  KEY `fk_searchHistory_1_idx` (`userID`),
  CONSTRAINT `fk_searchHistory_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `searchhistory`
--

LOCK TABLES `searchhistory` WRITE;
/*!40000 ALTER TABLE `searchhistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `searchhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription` (
  `userID` int(11) NOT NULL,
  `sUserID` int(11) NOT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`sUserID`),
  KEY `fk_subscription_2_idx` (`sUserID`),
  CONSTRAINT `fk_subscription_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_subscription_2` FOREIGN KEY (`sUserID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `sequence` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) NOT NULL,
  `tag` varchar(45) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  PRIMARY KEY (`sequence`,`postID`),
  KEY `fk_table1_1_idx` (`postID`),
  CONSTRAINT `fk_table1_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `tradecomments`
--

DROP TABLE IF EXISTS `tradecomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tradecomments` (
  `postID` bigint(20) DEFAULT NULL,
  `soldQty` int(11) DEFAULT NULL,
  `soldDate` datetime DEFAULT NULL,
  `soldToUserID` bigint(20) DEFAULT NULL,
  `sellerRating` int(11) DEFAULT NULL,
  `sellerComment` varchar(500) DEFAULT NULL,
  `buyerUserID` bigint(20) DEFAULT NULL,
  `buyerRating` int(11) DEFAULT NULL,
  `buyerComment` varchar(500) DEFAULT NULL,
  `buyerDate` datetime DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `rejectReason` varchar(300) DEFAULT NULL,
  `rejectSpecifiedReason` varchar(300) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tradecomments`
--

LOCK TABLES `tradecomments` WRITE;
/*!40000 ALTER TABLE `tradecomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tradecomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `postID` int(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `lastModified` datetime DEFAULT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `fk_transaction_1_idx` (`postID`),
  KEY `fk_transaction_2_idx` (`userID`),
  CONSTRAINT `fk_transaction_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaction_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `ip` varbinary(16) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `accountStatus` varchar(2) DEFAULT NULL,
  `createDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usertype` varchar(45) DEFAULT NULL,
  `lastLoginTime` datetime DEFAULT NULL,
  `picturePath` varchar(100) DEFAULT NULL,
  `pictureName` varchar(45) DEFAULT NULL,
  `photostatus` varchar(1) DEFAULT NULL,
  `thumbnailPath` varchar(100) DEFAULT NULL,
  `thumbnailName` varchar(45) DEFAULT NULL,
  `blockDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `usename_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useremail`
--

DROP TABLE IF EXISTS `useremail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useremail` (
  `userID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`email`),
  CONSTRAINT `fk_userEmail_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useremail`
--

LOCK TABLES `useremail` WRITE;
/*!40000 ALTER TABLE `useremail` DISABLE KEYS */;
/*!40000 ALTER TABLE `useremail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
  `userID` int(11) NOT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `country` varchar(3) DEFAULT NULL,
  `language` varchar(2) DEFAULT NULL,
  `phoneNo` varchar(45) DEFAULT NULL,
  `telNo` varchar(45) DEFAULT NULL,
  `hidetelno` tinyint(1) DEFAULT NULL,
  `profilePicID` int(11) DEFAULT NULL,
  `signature` int(11) DEFAULT NULL,
  `documentID` varchar(45) DEFAULT NULL,
  `documentType` varchar(45) DEFAULT NULL,
  `checkBox1` tinyint(1) DEFAULT NULL,
  `checkBox2` tinyint(1) DEFAULT NULL,
  `lastModified` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `fk_userInfo_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userloginhistory`
--

DROP TABLE IF EXISTS `userloginhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userloginhistory` (
  `userID` int(11) DEFAULT NULL,
  `ip` varbinary(16) DEFAULT NULL,
  `loginTime` datetime DEFAULT NULL,
  `logoutTime` datetime DEFAULT NULL,
  `client` varchar(45) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `logMsg` varchar(300) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  KEY `fk_userLoginHistory_1` (`userID`),
  CONSTRAINT `fk_userLoginHistory_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userloginhistory`
--

LOCK TABLES `userloginhistory` WRITE;
/*!40000 ALTER TABLE `userloginhistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `userloginhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userpassword`
--

DROP TABLE IF EXISTS `userpassword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userpassword` (
  `userID` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `password` char(40) NOT NULL,
  `createDate` datetime DEFAULT NULL,
  `expriyDate` datetime DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`userID`,`sequence`),
  CONSTRAINT `fk_userPassword_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userpassword`
--

LOCK TABLES `userpassword` WRITE;
/*!40000 ALTER TABLE `userpassword` DISABLE KEYS */;
/*!40000 ALTER TABLE `userpassword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userstat`
--

DROP TABLE IF EXISTS `userstat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userstat` (
  `userID` int(11) NOT NULL,
  `inboxMsgCount` int(11) NOT NULL,
  `approveMsgCount` int(11) NOT NULL,
  `myAdsCount` int(11) NOT NULL,
  `savedAdsCount` int(11) NOT NULL,
  `pendingMsgCount` int(11) NOT NULL,
  `archivedAdsCount` int(11) NOT NULL,
  `visitCount` int(11) NOT NULL,
  `totalMyAdsCount` int(11) NOT NULL,
  `favoriteAdsCount` int(11) NOT NULL,
  `outgoingMsgCount` int(11) NOT NULL,
  `buyAdsCount` int(11) NOT NULL,
  `directsendhistCount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userstat`
--

LOCK TABLES `userstat` WRITE;
/*!40000 ALTER TABLE `userstat` DISABLE KEYS */;
/*!40000 ALTER TABLE `userstat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-06 11:50:33
