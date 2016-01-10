-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2016 at 09:12 PM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `raydb`
--

Create database if not exists `raydb`;
use raydb;

CREATE TABLE IF NOT EXISTS `abusemessages` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
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
  KEY `fk_Address_1_idx` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
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
  KEY `fk_category_1_idx` (`parentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `parentID`, `level`, `name`, `nameCH`, `postCount`, `iconImage`, `viewCount`, `childCount`, `searchCount`) VALUES
(1, NULL, 1, 'Dresses', '連身裙', 8, 'images/category_icon/連身裙.png', 1, 4, 53),
(2, NULL, 1, 'Tops', '上身', 0, 'images/category_icon/上身.png', 0, 5, 8),
(3, NULL, 1, 'Bottoms', '下身', 0, 'images/category_icon/下身.png', 0, 5, 11),
(4, NULL, 1, 'Outerwear', '外套', 0, 'images/category_icon/外套.png', 0, 4, 1),
(5, NULL, 1, 'Rompers', '連衫褲', 0, 'images/category_icon/連衫褲.png', 0, 3, 7),
(6, NULL, 1, 'Hat', '帽子', 0, 'images/category_icon/帽子.png', 0, 0, 2),
(7, NULL, 1, 'Jewelry', '珠寶首飾', 0, 'images/category_icon/珠寶首飾.png', 0, 6, 7),
(8, NULL, 1, 'Bag/Wallet', '袋', 0, 'images/category_icon/袋.png', 0, 5, 5),
(9, NULL, 1, 'Shoes', '鞋子', 0, 'images/category_icon/鞋子.png', 0, 5, 1),
(10, NULL, 1, 'Kids/Baby', '兒童產品', 0, 'images/category_icon/兒童產品.png', 0, 1, 0),
(11, NULL, 1, 'Sleepwear', '睡衣', 0, 'images/category_icon/睡衣.png', 0, 3, 0),
(12, NULL, 1, 'Swimwear', '游泳衣', 0, 'images/category_icon/游泳衣.png', 0, 1, 0),
(13, NULL, 1, 'Beauty', '美容產品', 0, 'images/category_icon/美容產品.png', 0, 5, 6),
(14, NULL, 1, 'Lingerie', '內衣褲', 0, 'images/category_icon/內衣褲.png', 0, 4, 2),
(15, NULL, 1, 'Electronics', '電子產品', 0, 'images/category_icon/電子產品.png', 0, 4, 0),
(16, NULL, 1, 'Sportwear', '運動服', 0, 'images/category_icon/運動服.png', 0, 1, 9),
(17, NULL, 1, 'Other', '其他', 0, 'images/category_icon/其他.png', 0, 5, 9),
(18, 1, 2, 'General', '多用途', 3, 'images/category_icon/多用途.png', 43, 0, 29),
(19, 1, 2, 'Long Dress', '長裙', 5, 'images/category_icon/長裙.png', 117, 0, 10),
(20, 1, 2, 'Short Dress', '短裙', 0, 'images/category_icon/短裙.png', 0, 0, 7),
(21, 1, 2, 'Formal Dress', '禮服', 0, 'images/category_icon/禮服.png', 0, 0, 12),
(22, 2, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 37),
(23, 2, 2, 'T-Shirt', '短袖衫', 0, 'images/category_icon/短袖衫.png', 0, 0, 24),
(24, 2, 2, 'Long Sleeve', '長袖衫', 0, 'images/category_icon/長袖衫.png', 0, 0, 33),
(25, 2, 2, 'Tank ', '背心', 0, 'images/category_icon/背心.png', 0, 0, 1),
(26, 2, 2, 'Blouse', '隆重衣服', 0, 'images/category_icon/隆重衣服.png', 0, 0, 2),
(27, 3, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 27),
(28, 3, 2, 'Skirt', '半截裙', 0, 'images/category_icon/半截裙.png', 0, 0, 2),
(29, 3, 2, 'Shorts', '短褲', 0, 'images/category_icon/短褲.png', 0, 0, 0),
(30, 3, 2, 'Long Pants', '長褲', 0, 'images/category_icon/長褲.png', 0, 0, 1),
(31, 3, 2, 'Leggings', '緊身褲', 0, 'images/category_icon/緊身褲.png', 0, 0, 2),
(32, 4, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 6),
(33, 4, 2, 'Jacket', '外套', 0, 'images/category_icon/外套.png', 0, 0, 12),
(34, 4, 2, 'Vest', '背心', 0, 'images/category_icon/背心.png', 0, 0, 2),
(35, 4, 2, 'Blazer', '西裝外套', 0, 'images/category_icon/西裝外套.png', 0, 0, 13),
(36, 5, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 23),
(37, 5, 2, 'Formal', '隆重連衫褲', 0, 'images/category_icon/隆重連衫褲.png', 0, 0, 0),
(38, 5, 2, 'Sporty', '運動連衫褲', 0, 'images/category_icon/運動連衫褲.png', 0, 0, 2),
(39, 8, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 24),
(40, 8, 2, 'Handbag', '手袋', 0, 'images/category_icon/手袋.png', 0, 0, 9),
(41, 8, 2, 'Backpack', '背包', 0, 'images/category_icon/背包.png', 0, 0, 7),
(42, 8, 2, 'Wallet', '錢包', 0, 'images/category_icon/錢包.png', 0, 0, 14),
(43, 8, 2, 'Shoulder Bag', '單肩包', 0, 'images/category_icon/單肩包.png', 0, 0, 2),
(44, 7, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 7),
(45, 7, 2, 'Necklace', '頸鏈', 0, 'images/category_icon/頸鏈.png', 0, 0, 12),
(46, 7, 2, 'Earrings', '耳環', 0, 'images/category_icon/耳環.png', 0, 0, 3),
(47, 7, 2, 'Ring', '指環', 0, 'images/category_icon/指環.png', 0, 0, 2),
(48, 7, 2, 'Bracelet', '手鐲', 0, 'images/category_icon/手鐲.png', 0, 0, 1),
(49, 7, 2, 'Watch', '手錶', 0, 'images/category_icon/手錶.png', 0, 0, 3),
(51, 9, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 0),
(52, 9, 2, 'High heels', '高跟鞋', 0, 'images/category_icon/高跟鞋.png', 0, 0, 0),
(53, 9, 2, 'Sneakers', '帆布鞋', 0, 'images/category_icon/帆布鞋.png', 0, 0, 2),
(54, 9, 2, 'Sandals', '拖鞋', 0, 'images/category_icon/拖鞋.png', 0, 0, 0),
(55, 9, 2, 'Boots', '靴子', 0, 'images/category_icon/靴子.png', 0, 0, 0),
(56, 16, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 2),
(57, 11, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 23),
(58, 11, 2, 'Clothes', '衣物', 0, 'images/category_icon/衣物.png', 0, 0, 1),
(60, 12, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 0),
(62, 11, 2, 'Equipment', '用品', 0, 'images/category_icon/用品.png', 0, 0, 86),
(63, 13, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 1),
(64, 13, 2, 'Beauty', '美容電器', 0, 'images/category_icon/美容電器.png', 0, 0, 25),
(65, 13, 2, 'Mask', '面膜', 0, 'images/category_icon/面膜.png', 0, 0, 16),
(66, 13, 2, 'Cream', '精華霜', 0, 'images/category_icon/精華霜.png', 0, 0, 0),
(67, 13, 2, 'Beauty Products', '美容用品', 0, 'images/category_icon/美容用品.png', 0, 0, 2),
(68, 14, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 2),
(69, 14, 2, 'Underclothes', '內衣', 0, 'images/category_icon/內衣.png', 0, 0, 2),
(70, 14, 2, 'Bra', '胸罩', 0, 'images/category_icon/胸罩.png', 0, 0, 2),
(71, 14, 2, 'Underwear', '內衣褲', 0, 'images/category_icon/內衣褲.png', 0, 0, 0),
(72, 15, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 6),
(73, 15, 2, 'Beauty', '美容電器', 0, 'images/category_icon/美容電器.png', 0, 0, 0),
(74, 15, 2, 'Home Product', '家庭電器', 0, 'images/category_icon/家庭電器.png', 0, 0, 2),
(75, 15, 2, 'Photography', '攝錄器材', 0, 'images/category_icon/攝錄器材.png', 0, 0, 2),
(76, 10, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 23),
(77, 17, 2, 'General', '多用途', 0, 'images/category_icon/多用途.png', 0, 0, 2),
(78, 17, 2, 'Phone case', '手機套', 0, 'images/category_icon/手機套.png', 0, 0, 0),
(79, 17, 2, 'Book', '書', 0, 'images/category_icon/書.png', 0, 0, 0),
(80, 17, 2, 'CD/DVD', 'CD/DVD', 0, 'images/category_icon/CD/DVD.png', 0, 0, 5),
(81, 17, 2, 'Accessories', '裝飾物', 0, 'images/category_icon/裝飾物.png', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text,
  `createDate` datetime DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`commentID`),
  KEY `fk_comment_1_idx` (`postID`),
  KEY `fk_comment_2_idx` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contactHistory`
--

CREATE TABLE IF NOT EXISTS `contactHistory` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `contactTypeID` varchar(45) CHARACTER SET utf8 NOT NULL,
  `message` varchar(800) CHARACTER SET utf8 DEFAULT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`contactID`),
  KEY `contactTypeID` (`contactTypeID`),
  KEY `contactTypeID_2` (`contactTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `contactHistory`
--


-- --------------------------------------------------------

--
-- Table structure for table `contactType`
--

CREATE TABLE IF NOT EXISTS `contactType` (
  `contactTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nameCH` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `value` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`contactTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contactType`
--



-- --------------------------------------------------------

--
-- Table structure for table `indexstat`
--

CREATE TABLE IF NOT EXISTS `indexstat` (
  `trustedseller` int(11) DEFAULT NULL,
  `facebookfans` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interestedproduct`
--

CREATE TABLE IF NOT EXISTS `interestedproduct` (
  `postID` int(11) DEFAULT NULL,
  `viewCount` int(11) DEFAULT NULL,
  `session_id` varchar(1000) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interestedproduct`
--



-- --------------------------------------------------------

--
-- Table structure for table `itemcomments`
--

CREATE TABLE IF NOT EXISTS `itemcomments` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `itemcomments`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `locationID` int(11) NOT NULL,
  `parentID` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `nameCN` varchar(50) DEFAULT NULL,
  `postCount` bigint(20) DEFAULT NULL,
  `viewCount` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`locationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationID`, `parentID`, `level`, `name`, `nameCN`, `postCount`, `viewCount`) VALUES
(0, NULL, 1, 'All Locations', 'All Locations', 8, 0),
(1, NULL, 1, 'East Rail Line', 'East Rail Line', 0, 0),
(2, NULL, 1, 'Kwun Tong Line', 'Kwun Tong Line', 0, 0),
(3, NULL, 1, 'Tsuen Wan', 'Tsuen Wan', 0, 0),
(4, NULL, 1, 'Island Line', 'Island Line', 0, 0),
(5, NULL, 1, 'Tung Chung', 'Tung Chung', 0, 0),
(6, NULL, 1, 'Airport Express', 'Airport Express', 0, 0),
(7, NULL, 1, 'Tseung Kwan O', 'Tseung Kwan O', 0, 0),
(8, NULL, 1, 'West Rail Line', 'West Rail Line', 0, 0),
(9, NULL, 1, 'Ma On Shan Line', 'Ma On Shan Line', 0, 0),
(10, 1, 2, 'Lo Wu', 'Lo Wu', 0, 0),
(11, 1, 2, 'Lok Ma Chau', 'Lok Ma Chau', 0, 0),
(12, 1, 2, 'Kwu Tung', 'Kwu Tung', 0, 0),
(13, 1, 2, 'Sheung Shui', 'Sheung Shui', 0, 0),
(14, 1, 2, 'Fanling', 'Fanling', 0, 0),
(15, 1, 2, 'Tai Wo', 'Tai Wo', 0, 0),
(16, 1, 2, 'Tai Po Market', 'Tai Po Market', 0, 0),
(17, 1, 2, 'University', 'University', 0, 0),
(18, 1, 2, 'Racecourse', 'Racecourse', 0, 0),
(19, 1, 2, 'Fo Tan', 'Fo Tan', 0, 0),
(20, 1, 2, 'Sha Tin', 'Sha Tin', 0, 0),
(21, 1, 2, 'Tai Wai', 'Tai Wai', 0, 0),
(22, 1, 2, 'Kowloon Tong', 'Kowloon Tong', 0, 0),
(23, 1, 2, 'Mong Kok East', 'Mong Kok East', 0, 0),
(24, 1, 2, 'Hung Hom', 'Hung Hom', 0, 0),
(25, 2, 2, 'Whampoa', 'Whampoa', 0, 0),
(26, 2, 2, 'Ho Man Tin', 'Ho Man Tin', 0, 0),
(27, 2, 2, 'Yau Ma Tei', 'Yau Ma Tei', 0, 0),
(28, 2, 2, 'Mong Kok', 'Mong Kok', 0, 0),
(29, 2, 2, 'Prince Edward', 'Prince Edward', 0, 0),
(30, 2, 2, 'Shek Kip Mei', 'Shek Kip Mei', 0, 0),
(31, 2, 2, 'Kowloon Tong', 'Kowloon Tong', 0, 0),
(32, 2, 2, 'Lok Fu', 'Lok Fu', 0, 0),
(33, 2, 2, 'Wong Tai Sin', 'Wong Tai Sin', 0, 0),
(34, 2, 2, 'Diamond Hill', 'Diamond Hill', 0, 0),
(35, 2, 2, 'Choi Hung', 'Choi Hung', 0, 0),
(36, 2, 2, 'Kowloon Bay', 'Kowloon Bay', 0, 0),
(37, 2, 2, 'Ngau Tau Kok', 'Ngau Tau Kok', 0, 0),
(38, 2, 2, 'Kwun Tong', 'Kwun Tong', 0, 0),
(39, 2, 2, 'Lam Tin', 'Lam Tin', 0, 0),
(40, 2, 2, 'Yau Tong', 'Yau Tong', 0, 0),
(41, 2, 2, 'Tiu Keng Leng', 'Tiu Keng Leng', 0, 0),
(42, 3, 2, 'Tsuen Wan', 'Tsuen Wan', 0, 0),
(43, 3, 2, 'Tai Wo Hau', 'Tai Wo Hau', 0, 0),
(44, 3, 2, 'Kwai Hing', 'Kwai Hing', 0, 0),
(45, 3, 2, 'Kwai Fong', 'Kwai Fong', 0, 0),
(46, 3, 2, 'Lai King', 'Lai King', 0, 0),
(47, 3, 2, 'Mei Foo', 'Mei Foo', 0, 0),
(48, 3, 2, 'Lai Chi Kok', 'Lai Chi Kok', 0, 0),
(49, 3, 2, 'Cheung Sha Wan', 'Cheung Sha Wan', 0, 0),
(50, 3, 2, 'Sham Shui Po', 'Sham Shui Po', 0, 0),
(51, 3, 2, 'Prince Edward', 'Prince Edward', 0, 0),
(52, 3, 2, 'Mong Kok', 'Mong Kok', 0, 0),
(53, 3, 2, 'Yau Ma Tei', 'Yau Ma Tei', 0, 0),
(54, 3, 2, 'Jordan', 'Jordan', 0, 0),
(55, 3, 2, 'Tsim Sha Tsui', 'Tsim Sha Tsui', 0, 0),
(56, 3, 2, 'Admiralty', 'Admiralty', 0, 0),
(57, 3, 2, 'Central', 'Central', 0, 0),
(58, 4, 2, 'Kennedy Town', 'Kennedy Town', 0, 0),
(59, 4, 2, 'HKU', 'HKU', 0, 0),
(60, 4, 2, 'Sai Ying Pun', 'Sai Ying Pun', 0, 0),
(61, 4, 2, 'Sheung Wan', 'Sheung Wan', 0, 0),
(62, 4, 2, 'Central', 'Central', 0, 0),
(63, 4, 2, 'Admiralty', 'Admiralty', 0, 0),
(64, 4, 2, 'Wan Chai', 'Wan Chai', 0, 0),
(65, 4, 2, 'Causeway Bay', 'Causeway Bay', 0, 0),
(66, 4, 2, 'Tin Hau', 'Tin Hau', 0, 0),
(67, 4, 2, 'Fortress Hill', 'Fortress Hill', 0, 0),
(68, 4, 2, 'North Point', 'North Point', 0, 0),
(69, 4, 2, 'Quarry Bay', 'Quarry Bay', 0, 0),
(70, 4, 2, 'Tai Koo', 'Tai Koo', 0, 0),
(71, 4, 2, 'Sai Wan Ho', 'Sai Wan Ho', 0, 0),
(72, 4, 2, 'Shau Kei Wan', 'Shau Kei Wan', 0, 0),
(73, 4, 2, 'Heng Fa Chuen', 'Heng Fa Chuen', 0, 0),
(74, 4, 2, 'Chai Wan', 'Chai Wan', 0, 0),
(75, 5, 2, 'Tung Chung', 'Tung Chung', 0, 0),
(76, 5, 2, 'Sunny Bay', 'Sunny Bay', 0, 0),
(77, 5, 2, 'Tsing Yi', 'Tsing Yi', 0, 0),
(78, 5, 2, 'Lai King', 'Lai King', 0, 0),
(79, 5, 2, 'Nam Cheong', 'Nam Cheong', 0, 0),
(80, 5, 2, 'Olympic', 'Olympic', 0, 0),
(81, 5, 2, 'Kowloon', 'Kowloon', 0, 0),
(82, 5, 2, 'Hong Kong', 'Hong Kong', 0, 0),
(83, 6, 2, 'AsiaWorld–Expo', 'AsiaWorld–Expo', 0, 0),
(84, 6, 2, 'Airport', 'Airport', 0, 0),
(85, 6, 2, 'Tsing Yi', 'Tsing Yi', 0, 0),
(86, 6, 2, 'Kowloon', 'Kowloon', 0, 0),
(87, 6, 2, 'Hong Kong', 'Hong Kong', 0, 0),
(88, 7, 2, 'Po Lam', 'Po Lam', 0, 0),
(89, 7, 2, 'Hang Hau', 'Hang Hau', 0, 0),
(90, 7, 2, 'LOHAS Park', 'LOHAS Park', 0, 0),
(91, 7, 2, 'Tseung Kwan O', 'Tseung Kwan O', 0, 0),
(92, 7, 2, 'Tiu Keng Leng', 'Tiu Keng Leng', 0, 0),
(93, 7, 2, 'Yau Tong', 'Yau Tong', 0, 0),
(94, 7, 2, 'Quarry Bay', 'Quarry Bay', 0, 0),
(95, 7, 2, 'North Point', 'North Point', 0, 0),
(96, 8, 2, 'Tuen Mun', 'Tuen Mun', 0, 0),
(97, 8, 2, 'Siu Hong', 'Siu Hong', 0, 0),
(98, 8, 2, 'Tin Shui Wai', 'Tin Shui Wai', 0, 0),
(99, 8, 2, 'Long Ping', 'Long Ping', 0, 0),
(100, 8, 2, 'Yuen Long', 'Yuen Long', 0, 0),
(101, 8, 2, 'Kam Sheung Road', 'Kam Sheung Road', 0, 0),
(102, 8, 2, 'Tsuen Wan West', 'Tsuen Wan West', 0, 0),
(103, 8, 2, 'Mei Foo', 'Mei Foo', 0, 0),
(104, 8, 2, 'Nam Cheong', 'Nam Cheong', 0, 0),
(105, 8, 2, 'Austin', 'Austin', 0, 0),
(106, 8, 2, 'East Tsim Sha Tsui', 'East Tsim Sha Tsui', 0, 0),
(107, 8, 2, 'Hung Hom', 'Hung Hom', 0, 0),
(108, 9, 2, 'Wu Kai Sha', 'Wu Kai Sha', 0, 0),
(109, 9, 2, 'Ma On Shan', 'Ma On Shan', 0, 0),
(110, 9, 2, 'Heng On', 'Heng On', 0, 0),
(111, 9, 2, 'Tai Shui Hang', 'Tai Shui Hang', 0, 0),
(112, 9, 2, 'Shek Mun', 'Shek Mun', 0, 0),
(113, 9, 2, 'City One', 'City One', 0, 0),
(114, 9, 2, 'Sha Tin Wai', 'Sha Tin Wai', 0, 0),
(115, 9, 2, 'Che Kung Temple', 'Che Kung Temple', 0, 0),
(116, 9, 2, 'Tai Wai', 'Tai Wai', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
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
  PRIMARY KEY (`messageID`),
  KEY `fk_message_1_idx` (`userID`),
  KEY `fk_message_2_idx` (`fUserID`),
  KEY `fk_message_3_idx` (`replyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `message`
--
-- --------------------------------------------------------

--
-- Table structure for table `pagevisited`
--

CREATE TABLE IF NOT EXISTS `pagevisited` (
  `userID` bigint(20) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `session_id` varchar(1000) DEFAULT NULL,
  `cookies_id` varchar(1000) DEFAULT NULL,
  `visit_time` datetime DEFAULT NULL,
  `page_visit` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagevisited`
--

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
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
  KEY `fk_picture_2_idx` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=318 ;

--
-- Dumping data for table `picture`
--
-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
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
  KEY `fk_post_1_idx` (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=615 ;

--
-- Dumping data for table `post`
--

--
-- Table structure for table `postmessage`
--

CREATE TABLE IF NOT EXISTS `postmessage` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `content` text,
  `status` varchar(2) DEFAULT NULL,
  `reply` varchar(2) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`messageID`),
  KEY `fk_postMessage_2_idx` (`userID`),
  KEY `fk_postMessage_1_idx` (`postID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `postviewhistory`
--

CREATE TABLE IF NOT EXISTS `postviewhistory` (
  `postID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `viewTime` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `session_id` varchar(1000) DEFAULT NULL,
  `cookies_id` varchar(45) DEFAULT NULL,
  KEY `fk_postViewHistory_1_idx` (`postID`),
  KEY `fk_postViewHistory_2_idx` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postviewhistory`
--
-- --------------------------------------------------------

--
-- Table structure for table `requestpost`
--

CREATE TABLE IF NOT EXISTS `requestpost` (
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `status` varchar(3) DEFAULT NULL,
  `viewOption` varchar(3) DEFAULT NULL,
  `expriyDate` datetime DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`postID`),
  KEY `fk_requestPost_2_idx` (`postID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestpost`
--


--
-- Table structure for table `savedAds`
--

CREATE TABLE IF NOT EXISTS `savedAds` (
  `userID` int(11) DEFAULT NULL,
  `postID` int(11) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `expriyDate` datetime DEFAULT NULL,
  `createDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savedAds`
--


-- --------------------------------------------------------

--
-- Table structure for table `searchhistory`
--

CREATE TABLE IF NOT EXISTS `searchhistory` (
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
  KEY `fk_searchHistory_1_idx` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `searchhistory`
--

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
  `userID` int(11) NOT NULL,
  `sUserID` int(11) NOT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`sUserID`),
  KEY `fk_subscription_2_idx` (`sUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `sequence` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) NOT NULL,
  `tag` varchar(45) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  PRIMARY KEY (`sequence`,`postID`),
  KEY `fk_table1_1_idx` (`postID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tradecomments`
--

CREATE TABLE IF NOT EXISTS `tradecomments` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tradecomments`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `postID` int(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `lastModified` datetime DEFAULT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `fk_transaction_1_idx` (`postID`),
  KEY `fk_transaction_2_idx` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `ip`, `point`, `accountStatus`, `createDate`, `usertype`, `lastLoginTime`, `picturePath`, `pictureName`, `photostatus`, `thumbnailPath`, `thumbnailName`, `blockDate`) VALUES
(65, 'admin', '203.168.206.172', 0, 'A', '2015-12-19 03:25:14', 'PREMIUMPOSTEXPIRYDAYS', '2016-01-07 09:37:20', 'USER_PHOTO/admin/Resize', 'admin_2015-12-20-06-03-32_main_1.png', 'A', 'USER_PHOTO/admin/Resize', 'admin_2015-12-20-06-03-32_thumb_1.png', NULL),
(66, 'rchiu5hk', '203.168.206.172', 0, 'A', '2015-12-19 03:25:55', 'PREMIUMPOSTEXPIRYDAYS', '2016-01-09 13:16:27', NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'tester', '219.77.95.89', 0, 'A', '2015-12-20 19:14:06', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-23 09:31:25', NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'test123', '219.77.95.89', 0, 'A', '2015-12-20 19:21:16', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-20 12:21:16', NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'mytest', '219.77.95.89', 0, 'A', '2015-12-20 19:22:03', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-20 12:22:03', NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'tonylow123', '113.255.13.203', 0, 'A', '2015-12-22 05:47:45', 'PREMIUMPOSTEXPIRYDAYS', '2016-01-06 00:00:58', NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'rchiu1hk', '203.168.206.172', 0, 'A', '2015-12-26 22:20:12', 'PREMIUMPOSTEXPIRYDAYS', '2016-01-09 10:19:40', NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'rchiu2hk', '203.168.206.172', 0, 'A', '2015-12-26 22:21:15', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-27 23:33:48', NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'rchiu3hk', '203.168.206.172', 0, 'A', '2015-12-26 22:22:01', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-27 23:37:23', NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'rchiu4hk', '203.168.206.172', 0, 'A', '2015-12-26 22:23:28', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-27 23:49:10', NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'gttest', '219.77.95.89', 0, 'A', '2015-12-28 07:15:04', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-28 00:17:01', NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'gttest01', '219.77.95.89', 0, 'A', '2015-12-28 07:21:17', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-28 00:22:32', NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'gttest0101', '219.77.95.89', 0, 'A', '2015-12-28 07:23:57', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-28 00:27:27', NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'rchiu4', '203.168.206.172', 0, 'A', '2015-12-31 04:24:10', 'PREMIUMPOSTEXPIRYDAYS', '2015-12-30 22:51:23', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `useremail`
--

CREATE TABLE IF NOT EXISTS `useremail` (
  `userID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `useremail`
--

INSERT INTO `useremail` (`userID`, `email`, `priority`, `status`, `createDate`) VALUES
(65, 'chiuwinghing@gmail.com', 1, 'A', '0000-00-00 00:00:00'),
(66, 'rchiu5hk@yahoo.com.hk', 1, 'A', '0000-00-00 00:00:00'),
(67, 'test@hotmail.com', 1, 'U', '0000-00-00 00:00:00'),
(68, 'test123@hotmail.com', 1, 'U', '0000-00-00 00:00:00'),
(69, 'mytest@hotmail.com', 1, 'U', '0000-00-00 00:00:00'),
(70, 'tonylow1993@gmail.com', 1, 'A', '0000-00-00 00:00:00'),
(71, 'rchiU1hk@yahoo.com.hk', 1, 'A', '0000-00-00 00:00:00'),
(72, 'rchiu2hk@yahoo.com.hk', 1, 'A', '0000-00-00 00:00:00'),
(73, 'rchiu3hk@yahoo.com.hk', 1, 'A', '0000-00-00 00:00:00'),
(74, 'rchiu4hk@yahoo.com.hk', 1, 'A', '0000-00-00 00:00:00'),
(75, 'gttest01@outlook.com', 1, 'A', '0000-00-00 00:00:00'),
(76, 'gttest0101@gmail.com', 1, 'A', '0000-00-00 00:00:00'),
(77, 'gttest0101@yahoo.com', 1, 'A', '0000-00-00 00:00:00'),
(78, 'rchiu4@yahoo.com.hk', 1, 'A', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
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
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userID`, `lastName`, `firstName`, `gender`, `country`, `language`, `phoneNo`, `telNo`, `hidetelno`, `profilePicID`, `signature`, `documentID`, `documentType`, `checkBox1`, `checkBox2`, `lastModified`) VALUES
(65, '', '', NULL, '', '', '', '52207405', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-18 20:25:14'),
(66, '', '', NULL, '', '', '', '52207405', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-18 20:25:55'),
(67, '', '', NULL, '', '', '', '123456789', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-20 12:14:06'),
(68, '', '', NULL, '', '', '', '+12345678', 1, NULL, NULL, NULL, NULL, 1, 1, '2015-12-20 12:21:16'),
(69, '', '', NULL, '', '', '', '12345678', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-20 12:22:03'),
(70, '', '', NULL, '', '', '', '12345678', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-21 22:47:45'),
(71, '', '', NULL, '', '', '', '52207405', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-26 15:20:12'),
(72, '', '', NULL, '', '', '', '52207405', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-26 15:21:15'),
(73, '', '', NULL, '', '', '', '52207405', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-26 15:22:01'),
(74, '', '', NULL, '', '', '', '52207405', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-26 15:23:28'),
(75, '', '', NULL, '', '', '', '69723099', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-28 00:15:04'),
(76, '', '', NULL, '', '', '', '69723099', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-28 00:21:17'),
(77, '', '', NULL, '', '', '', '69723099', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-28 00:23:57'),
(78, '', '', NULL, '', '', '', '52207405', 0, NULL, NULL, NULL, NULL, 1, 1, '2015-12-30 21:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `userloginhistory`
--

CREATE TABLE IF NOT EXISTS `userloginhistory` (
  `userID` int(11) DEFAULT NULL,
  `ip` varbinary(16) DEFAULT NULL,
  `loginTime` datetime DEFAULT NULL,
  `logoutTime` datetime DEFAULT NULL,
  `client` varchar(45) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `logMsg` varchar(300) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  KEY `fk_userLoginHistory_1` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userloginhistory`
--

-- --------------------------------------------------------

--
-- Table structure for table `userpassword`
--

CREATE TABLE IF NOT EXISTS `userpassword` (
  `userID` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `password` char(40) NOT NULL,
  `createDate` datetime DEFAULT NULL,
  `expriyDate` datetime DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`userID`,`sequence`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userpassword`
--

INSERT INTO `userpassword` (`userID`, `sequence`, `password`, `createDate`, `expriyDate`, `status`) VALUES
(65, 1, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2015-12-18 20:25:14', '2016-01-17 00:00:00', 'U'),
(66, 1, 'fdf2e91f1c33859eb6098f1efdd8ee8837829650', '2015-12-18 20:25:55', '2016-01-17 00:00:00', 'U'),
(67, 1, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2015-12-20 12:14:06', '2016-01-19 00:00:00', 'U'),
(68, 1, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2015-12-20 12:21:16', '2016-01-19 00:00:00', 'U'),
(69, 1, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2015-12-20 12:22:03', '2016-01-19 00:00:00', 'U'),
(70, 1, '7c222fb2927d828af22f592134e8932480637c0d', '2015-12-21 22:47:45', '2016-01-20 00:00:00', 'U'),
(71, 0, '7c222fb2927d828af22f592134e8932480637c0d', '2015-05-17 00:00:00', '2015-08-17 00:00:00', 'U'),
(72, 1, '7c222fb2927d828af22f592134e8932480637c0d', '2015-12-26 15:21:15', '2016-01-25 00:00:00', 'U'),
(73, 1, '7c222fb2927d828af22f592134e8932480637c0d', '2015-12-26 15:22:01', '2016-01-25 00:00:00', 'U'),
(74, 1, '7c222fb2927d828af22f592134e8932480637c0d', '2015-12-26 15:23:28', '2016-01-25 00:00:00', 'U'),
(75, 1, '202ca7940245c66f6ea62b62e80a4c92ac986620', '2015-12-28 00:15:04', '2016-01-27 00:00:00', 'U'),
(76, 1, '202ca7940245c66f6ea62b62e80a4c92ac986620', '2015-12-28 00:21:17', '2016-01-27 00:00:00', 'U'),
(77, 1, '202ca7940245c66f6ea62b62e80a4c92ac986620', '2015-12-28 00:23:57', '2016-01-27 00:00:00', 'U'),
(78, 1, 'fdf2e91f1c33859eb6098f1efdd8ee8837829650', '2015-12-30 21:24:10', '2016-01-29 00:00:00', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `userstat`
--

CREATE TABLE IF NOT EXISTS `userstat` (
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

--
-- Dumping data for table `userstat`
--

INSERT INTO `userstat` (`userID`, `inboxMsgCount`, `approveMsgCount`, `myAdsCount`, `savedAdsCount`, `pendingMsgCount`, `archivedAdsCount`, `visitCount`, `totalMyAdsCount`, `favoriteAdsCount`, `outgoingMsgCount`, `buyAdsCount`, `directsendhistCount`) VALUES
(65, 1, 0, 0, 2, 0, 0, 0, 0, 0, 2, 0, 1),
(66, 2, 0, 4, 0, 0, 0, 113, 7, 0, 1, 0, 0),
(67, 2, 0, 1, 0, 0, 0, 21, 2, 0, 0, 0, 0),
(70, 0, 0, 2, 0, 0, 0, 18, 14, 0, 0, 0, 0),
(71, 0, 0, 1, 0, 0, 0, 9, 2, 0, 0, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_Address_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_1` FOREIGN KEY (`parentID`) REFERENCES `category` (`categoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comment_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_2` FOREIGN KEY (`fUserID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_3` FOREIGN KEY (`replyID`) REFERENCES `message` (`messageID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `fk_picture_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_picture_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_1` FOREIGN KEY (`catID`) REFERENCES `category` (`categoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `postmessage`
--
ALTER TABLE `postmessage`
  ADD CONSTRAINT `fk_postMessage_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_postMessage_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `postviewhistory`
--
ALTER TABLE `postviewhistory`
  ADD CONSTRAINT `fk_postViewHistory_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_postViewHistory_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `requestpost`
--
ALTER TABLE `requestpost`
  ADD CONSTRAINT `fk_requestPost_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requestPost_2` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `searchhistory`
--
ALTER TABLE `searchhistory`
  ADD CONSTRAINT `fk_searchHistory_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `fk_subscription_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subscription_2` FOREIGN KEY (`sUserID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `fk_table1_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_transaction_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaction_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `useremail`
--
ALTER TABLE `useremail`
  ADD CONSTRAINT `fk_userEmail_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `fk_userInfo_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userloginhistory`
--
ALTER TABLE `userloginhistory`
  ADD CONSTRAINT `fk_userLoginHistory_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userpassword`
--
ALTER TABLE `userpassword`
  ADD CONSTRAINT `fk_userPassword_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
