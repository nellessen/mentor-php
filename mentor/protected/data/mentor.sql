-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2012 at 03:20 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `goalId` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `day` date NOT NULL,
  `status` enum('completed','missed','unreported') NOT NULL DEFAULT 'unreported',
  PRIMARY KEY (`id`),
  KEY `goalId` (`goalId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `userId`, `goalId`, `description`, `day`, `status`) VALUES
(1, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-23', 'completed'),
(2, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-24', 'unreported'),
(3, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-25', 'unreported'),
(4, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-26', 'unreported'),
(5, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-27', 'unreported'),
(6, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-28', 'unreported'),
(7, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-29', 'unreported'),
(8, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-30', 'unreported'),
(9, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-31', 'unreported'),
(10, 1, 26, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-08-01', 'unreported'),
(11, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-24', 'completed'),
(12, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-25', 'unreported'),
(13, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-26', 'unreported'),
(14, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-27', 'unreported'),
(15, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-28', 'unreported'),
(16, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-29', 'unreported'),
(17, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-30', 'unreported'),
(18, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-07-31', 'unreported'),
(19, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-08-01', 'unreported'),
(20, 9, 27, 'Read 4 pages of Douglas Crockford''s JavaScript: The good parts.', '2012-08-02', 'unreported');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE IF NOT EXISTS `goal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `mentor1_email` varchar(128) DEFAULT NULL,
  `mentor1_name` varchar(128) DEFAULT NULL,
  `mentor2_email` varchar(128) DEFAULT NULL,
  `mentor2_name` varchar(128) DEFAULT NULL,
  `mentor3_email` varchar(128) DEFAULT NULL,
  `mentor3_name` varchar(128) DEFAULT NULL,
  `description` varchar(256) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`id`, `userId`, `mentor1_email`, `mentor1_name`, `mentor2_email`, `mentor2_name`, `mentor3_email`, `mentor3_name`, `description`, `active`, `created`) VALUES
(26, 1, 'philipp@web.de', 'Philipp', 'sarah@web.de', 'Sarah', 'konrad@web.de', 'Konrad', 'I would be a JavaScript Ninja', 1, '2012-07-23 11:15:59'),
(27, 9, 'info@davidn.de', 'David', '', '', '', '', 'I was a JS Ninja', 1, '2012-07-24 15:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `time-offset` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `firstname`, `lastname`, `gender`, `password`, `active`, `time-offset`) VALUES
(1, 'info@davidn.de', 'David', 'Nellessen', 'male', '8bfddbb7a13efcd793be1ab9756b8526', 0, 0),
(2, 'horst@web.de', 'Horst', 'Nellessen', 'male', 'c6b3347abc4df90960f26f9472000b40', 0, 0),
(3, 'adg@ad.de', 'ABC', 'DEF', 'male', 'd447fe52397d77b23c6c4b9b7ffd7fe7', 0, 0),
(4, 'rita@web.de', 'Rita', 'Nellessen', 'female', '439e3912e41b6a10e750e95bf20dba28', 0, 0),
(5, 'af@asd.de', 'Horst', 'horst@web.de', 'male', '439e3912e41b6a10e750e95bf20dba28', 0, 0),
(6, 'afaf@asd.de', 'David', 'Nellessen', 'male', '439e3912e41b6a10e750e95bf20dba28', 0, 0),
(7, 'aefqaef@asd.de', 'A', 'B', 'male', 'c6b3347abc4df90960f26f9472000b40', 0, 0),
(8, 'saegqwd@asd.de', 'David', 'N', 'male', 'c6b3347abc4df90960f26f9472000b40', 0, 0),
(9, '2horst@web.de', 'Horst', 'saegsg', 'male', '439e3912e41b6a10e750e95bf20dba28', 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`goalId`) REFERENCES `goal` (`id`),
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Constraints for table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `goal_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
