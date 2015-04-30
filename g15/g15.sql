-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2015 at 12:43 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `g15`
--
CREATE DATABASE IF NOT EXISTS `g15` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `g15`;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `BlockId` int(20) NOT NULL AUTO_INCREMENT,
  `Blocker` int(5) NOT NULL,
  `Blocked` int(5) NOT NULL,
  PRIMARY KEY (`BlockId`),
  KEY `BLK-BIID` (`Blocker`),
  KEY `BLK-BIIID` (`Blocked`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int(20) NOT NULL AUTO_INCREMENT,
  `UId` int(5) NOT NULL,
  `MediaId` int(20) NOT NULL,
  `comment` varchar(80) NOT NULL,
  PRIMARY KEY (`commentId`),
  KEY `CMNT-MIDD` (`MediaId`),
  KEY `CMNT-UID` (`UId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `dandv`
--

CREATE TABLE IF NOT EXISTS `dandv` (
  `DnId` int(20) NOT NULL AUTO_INCREMENT,
  `MediaId` int(20) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `UId` int(5) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`DnId`),
  KEY `DANDV-UID` (`UId`),
  KEY `DANDV-MIDD` (`MediaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Table structure for table `friendreq`
--

CREATE TABLE IF NOT EXISTS `friendreq` (
  `fid` int(20) NOT NULL AUTO_INCREMENT,
  `UId` int(5) NOT NULL,
  `friend` int(5) NOT NULL,
  `reqStat` enum('pending','accepted','rejected') NOT NULL,
  PRIMARY KEY (`fid`),
  KEY `FRQ-FRND` (`UId`),
  KEY `frndrq-casc2` (`friend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `KeywordId` int(20) NOT NULL AUTO_INCREMENT,
  `MediaId` int(20) NOT NULL,
  `keyword` varchar(20) NOT NULL,
  PRIMARY KEY (`KeywordId`),
  KEY `keywrds-casc1` (`MediaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `LikeId` int(20) NOT NULL AUTO_INCREMENT,
  `UId` int(5) NOT NULL,
  `MediaId` int(20) NOT NULL,
  `Type` enum('like','dislike') NOT NULL,
  PRIMARY KEY (`LikeId`),
  KEY `LIKE-MIDD` (`MediaId`),
  KEY `LIKE-USR` (`UId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `MediaId` int(11) NOT NULL AUTO_INCREMENT,
  `MediaName` varchar(64) NOT NULL,
  `MediaPath` varchar(256) NOT NULL,
  `MediaType` varchar(30) DEFAULT '0',
  `UploadTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UId` int(5) NOT NULL,
  `ShareWith` enum('Public','Private','None') NOT NULL,
  PRIMARY KEY (`MediaId`),
  KEY `UID-MID` (`UId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `MessageId` int(20) NOT NULL AUTO_INCREMENT,
  `Sender` int(5) NOT NULL,
  `Receiver` int(5) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MessageId`),
  KEY `MSG-SNDR` (`Sender`),
  KEY `MSG-RCVR` (`Receiver`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE IF NOT EXISTS `meta` (
  `MediaId` int(20) NOT NULL,
  `Title` varchar(20) NOT NULL,
  `Description` text NOT NULL,
  `Category` varchar(20) NOT NULL,
  `MediaType` varchar(20) NOT NULL,
  PRIMARY KEY (`MediaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `PId` int(20) NOT NULL AUTO_INCREMENT,
  `UId` int(5) NOT NULL,
  `Pname` varchar(20) NOT NULL,
  PRIMARY KEY (`PId`),
  KEY `UID-PL` (`UId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `plstfiles`
--

CREATE TABLE IF NOT EXISTS `plstfiles` (
  `plstId` int(20) NOT NULL AUTO_INCREMENT,
  `PId` int(20) NOT NULL,
  `MediaId` int(20) NOT NULL,
  PRIMARY KEY (`plstId`),
  KEY `plst` (`MediaId`),
  KEY `plst-pid` (`PId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `RId` int(20) NOT NULL AUTO_INCREMENT,
  `UId` int(5) NOT NULL,
  `Rating` int(20) NOT NULL,
  `MediaId` int(20) NOT NULL,
  PRIMARY KEY (`RId`),
  KEY `UID-RATE` (`UId`),
  KEY `MID-MID` (`MediaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `SId` int(5) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(20) NOT NULL,
  `UId` int(5) NOT NULL,
  PRIMARY KEY (`SId`),
  KEY `UID-SRCHHH` (`UId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `SubId` int(20) NOT NULL AUTO_INCREMENT,
  `Subscriber` int(5) NOT NULL,
  `SubscribedTo` int(5) NOT NULL,
  PRIMARY KEY (`SubId`),
  UNIQUE KEY `fk_sub_usr` (`Subscriber`),
  KEY `UID-SUBSD` (`SubscribedTo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UId` int(5) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Uname` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `DOB` date NOT NULL,
  `Role` varchar(10) NOT NULL,
  PRIMARY KEY (`UId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `block-casc` FOREIGN KEY (`Blocker`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `block-casc2` FOREIGN KEY (`Blocked`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments-casc` FOREIGN KEY (`UId`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments-casc2` FOREIGN KEY (`MediaId`) REFERENCES `media` (`MediaId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dandv`
--
ALTER TABLE `dandv`
  ADD CONSTRAINT `dandv-casc1` FOREIGN KEY (`UId`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dandv-casc2` FOREIGN KEY (`MediaId`) REFERENCES `media` (`MediaId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friendreq`
--
ALTER TABLE `friendreq`
  ADD CONSTRAINT `frndrq-casc1` FOREIGN KEY (`UId`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frndrq-casc2` FOREIGN KEY (`friend`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keywords`
--
ALTER TABLE `keywords`
  ADD CONSTRAINT `keywrds-casc1` FOREIGN KEY (`MediaId`) REFERENCES `media` (`MediaId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes-casc1` FOREIGN KEY (`MediaId`) REFERENCES `media` (`MediaId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes-casc2` FOREIGN KEY (`UId`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media-casc` FOREIGN KEY (`UId`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages-casc1` FOREIGN KEY (`Sender`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages-casc2` FOREIGN KEY (`Receiver`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meta`
--
ALTER TABLE `meta`
  ADD CONSTRAINT `casc-meta` FOREIGN KEY (`MediaId`) REFERENCES `media` (`MediaId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meta-casc` FOREIGN KEY (`MediaId`) REFERENCES `media` (`MediaId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist-casc` FOREIGN KEY (`UId`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plstfiles`
--
ALTER TABLE `plstfiles`
  ADD CONSTRAINT `plstf-casc1` FOREIGN KEY (`PId`) REFERENCES `playlist` (`PId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plstf-casc2` FOREIGN KEY (`MediaId`) REFERENCES `media` (`MediaId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating-casc1` FOREIGN KEY (`UId`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating-casc2` FOREIGN KEY (`MediaId`) REFERENCES `media` (`MediaId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `search`
--
ALTER TABLE `search`
  ADD CONSTRAINT `search-casc` FOREIGN KEY (`UId`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subsc-casc1` FOREIGN KEY (`Subscriber`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subsc-casc2` FOREIGN KEY (`SubscribedTo`) REFERENCES `user` (`UId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
