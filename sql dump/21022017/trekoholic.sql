-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2017 at 12:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `travios`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `enqId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `empdepartment`
--

CREATE TABLE IF NOT EXISTS `empdepartment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `empdepartment`
--

INSERT INTO `empdepartment` (`id`, `name`) VALUES
(1, 'sales'),
(2, 'operations');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tourid` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `touristCount` varchar(10) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `price` varchar(10) NOT NULL,
  `transactionId` varchar(128) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `lastUpdatedByUser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tourid` (`tourid`,`lastUpdatedByUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE IF NOT EXISTS `tours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `desc` text NOT NULL,
  `price` varchar(32) NOT NULL,
  `region` varchar(128) NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `url`, `name`, `desc`, `price`, `region`, `createdAt`) VALUES
(1, 'http://www.travios.in/?travel=terrific-thailand', 'Terrific Thailand', 'Thailand is a country on Southeast Asia’s Indochina peninsula known for tropical beaches, opulent royal palaces, ancient ruins and ornate temples displaying figures of Buddha, a revered symbol. In Bangkok, the capital, an ultramodern cityscape rises next to quiet canal and riverside communities. Commercial hubs such as Chinatown consist of labyrinthine alleys crammed with shop houses, markets and diners.', '201301', 'Thailand', '2017-02-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(128) NOT NULL,
  `state` varchar(45) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `companyName` varchar(128) NOT NULL DEFAULT 'Travios',
  `photo` varchar(255) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userTypeId` (`userTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `userTypeId`, `email`, `password`, `phone`, `address1`, `address2`, `city`, `state`, `pin`, `companyName`, `photo`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Pushpraj', 1, 'pushpraj@purologics.com', '1234', '8744924689', 'm702', 'Prateek Laurel', 'Noida', 'UP', '201301', 'Travios', 'noimage.png', '', '', '2017-02-21 00:00:00', '2017-02-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `name`) VALUES
(1, 'agent'),
(2, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `xrefenqdept`
--

CREATE TABLE IF NOT EXISTS `xrefenqdept` (
  `userId` int(11) NOT NULL,
  `enqId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  KEY `userId` (`userId`,`enqId`),
  KEY `enqId` (`enqId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xrefuserdept`
--

CREATE TABLE IF NOT EXISTS `xrefuserdept` (
  `userId` int(11) NOT NULL,
  `deptId` int(11) NOT NULL,
  KEY `userId` (`userId`,`deptId`),
  KEY `deptId` (`deptId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xrefuserdept`
--

INSERT INTO `xrefuserdept` (`userId`, `deptId`) VALUES
(1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `xrefenqdept`
--
ALTER TABLE `xrefenqdept`
  ADD CONSTRAINT `xrefenqdept_ibfk_2` FOREIGN KEY (`enqId`) REFERENCES `enquiry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `xrefenqdept_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `tours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `xrefuserdept`
--
ALTER TABLE `xrefuserdept`
  ADD CONSTRAINT `xrefuserdept_ibfk_2` FOREIGN KEY (`deptId`) REFERENCES `empdepartment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `xrefuserdept_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
