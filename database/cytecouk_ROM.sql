-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2012 at 04:31 AM
-- Server version: 5.1.61
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cytecouk_ROM`
--

-- --------------------------------------------------------

--
-- Table structure for table `ROM_engineer`
--

CREATE TABLE IF NOT EXISTS `ROM_engineer` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `installer_id` int(64) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ROM_engineer`
--

INSERT INTO `ROM_engineer` (`id`, `installer_id`, `first_name`, `surname`, `mobile`, `email`) VALUES
(1, 1, 'Kris', 'Piskorski', NULL, 'pisak'),
(2, 2, 'Mark', 'Sheldon', NULL, NULL),
(3, 2, 'Chris', 'Jennings', '07813771926', 'c'),
(4, 1, 'Jason', 'Engineer', '07894644711', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ROM_installer`
--

CREATE TABLE IF NOT EXISTS `ROM_installer` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `address_1` varchar(64) DEFAULT NULL,
  `address_2` varchar(64) DEFAULT NULL,
  `postcode` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ROM_installer`
--

INSERT INTO `ROM_installer` (`id`, `name`, `phone`, `email`, `address_1`, `address_2`, `postcode`) VALUES
(1, 'AST London', '0208 568 6130', 'sales@astlondon.co.uk', 'Area 2, Riverside Works', 'Railshead Road, Isleworth', 'TW7 7BY'),
(2, 'Defence Security', '0121 500 6870', 'enquiries@defencesecurity.co.uk', 'Robecc House', 'Kelvin Way, West Bromwich', 'B70 7LB');

-- --------------------------------------------------------

--
-- Table structure for table `ROM_site`
--

CREATE TABLE IF NOT EXISTS `ROM_site` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `installer_id` int(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `address_1` varchar(64) NOT NULL,
  `address_2` varchar(64) NOT NULL,
  `postcode` varchar(16) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `contact_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `install_date` date NOT NULL,
  `sla` int(1) NOT NULL,
  `system` varchar(32) NOT NULL,
  `os` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ROM_site`
--

INSERT INTO `ROM_site` (`id`, `installer_id`, `name`, `address_1`, `address_2`, `postcode`, `phone`, `contact_name`, `email`, `install_date`, `sla`, `system`, `os`) VALUES
(1, 1, 'University of Arts', 'London', '', '', '', 'Derek Paxman', '', '0000-00-00', 0, '4', '8'),
(2, 2, 'Aston Science Park', 'Birmingham', '', '', '', 'Chris', '', '2012-03-14', 0, '2', '4'),
(3, 1, 'Octavia Housing', 'London', '', '', '', 'Fran Hausberger', '', '0000-00-00', 0, '5', '8'),
(4, 1, 'Cayenne court', 'Tower Bridge', 'London', 'S1', '01234 567 8910', 'Enrique', 'enrique@cayennecourt.com', '2011-05-03', 1, '2', '1'),
(5, 1, 'Lampton School', 'London', 'Address2', 'E3 4SD', '093413', 'Contact', 'lampton@school.com', '2012-03-17', 0, '1', '5'),
(6, 1, 'test ast site', '', '', '', '', '', '', '2012-03-17', 0, '3', '2');

-- --------------------------------------------------------

--
-- Table structure for table `ROM_ticket`
--

CREATE TABLE IF NOT EXISTS `ROM_ticket` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `site_id` int(64) NOT NULL,
  `installer_id` int(64) NOT NULL,
  `engineer_id` int(64) NOT NULL,
  `user_id` int(64) NOT NULL,
  `reference` int(32) NOT NULL,
  `problem` varchar(512) NOT NULL,
  `action_1` varchar(512) NOT NULL,
  `action_2` varchar(512) DEFAULT NULL,
  `action_3` varchar(512) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `open_date` datetime NOT NULL,
  `closed_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `ROM_ticket`
--

INSERT INTO `ROM_ticket` (`id`, `site_id`, `installer_id`, `engineer_id`, `user_id`, `reference`, `problem`, `action_1`, `action_2`, `action_3`, `status`, `open_date`, `closed_date`) VALUES
(1, 2, 2, 2, 1, 319156, 'Test ticketa', 'Test ticketa1', 'Test ticketa2', 'Test ticketa3', 0, '2012-03-07 22:33:00', NULL),
(3, 3, 1, 1, 1, 319157, 'Test ticketb', 'Test ticketb1', 'Test ticketb2', 'Test ticketb3', 0, '2012-03-08 20:16:00', NULL),
(4, 3, 1, 4, 1, 319158, 'Test ticketc', 'Test ticketc1', 'Test ticketc2', 'Test ticketc3', 0, '2012-03-08 21:23:00', NULL),
(5, 1, 1, 1, 1, 319159, 'Test ticketd', 'Test ticketd1', 'Test ticketd2', 'Test ticketd3', 0, '2012-03-08 21:27:00', NULL),
(34, 2, 2, 3, 1, 319163, 'E', 'F', 'G', 'H', 2, '2012-03-12 21:35:00', '0000-00-00 00:00:00'),
(35, 2, 2, 2, 1, 319164, 'i', 'j', 'k', 'l', 1, '2012-03-12 21:40:00', '0000-00-00 00:00:00'),
(33, 2, 2, 3, 1, 319162, 'A', 'B', 'C', 'D', 1, '2012-03-01 21:19:00', '0000-00-00 00:00:00'),
(31, 1, 1, 4, 1, 319160, 'Test tickete', 'Test tickete1Test ticketeTest ticketeTest ticketeTest ticketeTest ticketeTest ticketeTest ticketeTest tickete', 'Test tickete2Test ticketeTest ticketeTest ticketeTest ticketeTest ticketeTest tickete', 'Test tickete3Test ticketeTest ticketeTest ticketeTest ticketeTest ticketeTest ticketeTest ticketeTest ticketeTest tickete', 0, '2012-03-09 23:03:00', '2012-03-23 22:14:00'),
(32, 1, 1, 1, 1, 319161, '', '', NULL, NULL, 0, '2012-03-09 23:16:00', NULL),
(36, 2, 2, 3, 1, 319165, 'm', 'n', 'o', 'p', 0, '2012-03-20 21:44:00', '2012-03-12 21:48:44'),
(37, 3, 1, 4, 1, 319166, 'p', 'q', 'r', 's', 1, '2012-03-12 21:48:00', '0000-00-00 00:00:00'),
(38, 3, 1, 1, 1, 319167, '319167 Probab', '319167 Act 1ab', '319167 Act 2ab', '319167 Act 3ab', 0, '2012-03-14 22:13:00', '2012-03-16 22:22:00'),
(39, 2, 2, 2, 1, 319168, '', '', NULL, NULL, 0, '2012-03-15 22:22:00', NULL),
(40, 2, 2, 2, 1, 319169, '', '', NULL, NULL, 0, '2012-03-15 22:22:00', NULL),
(41, 2, 2, 2, 1, 319170, '', '', NULL, NULL, 0, '2012-03-15 22:22:00', NULL),
(42, 2, 2, 2, 1, 319171, '', '', NULL, NULL, 0, '2012-03-15 22:22:00', NULL),
(43, 2, 2, 2, 1, 319172, '', '', NULL, NULL, 0, '2012-03-15 22:22:00', NULL),
(44, 1, 1, 4, 1, 319173, '', '', NULL, NULL, 0, '2012-03-16 20:18:00', NULL),
(45, 1, 1, 1, 1, 319174, 'This is a test problem', 'this action was taken first', 'this action was taken second', 'This action was taken 3rd', 1, '2012-03-16 20:46:00', '0000-00-00 00:00:00'),
(46, 2, 2, 3, 1, 319175, 'abc', '1123', '546', 'rth', 0, '2012-03-16 22:30:00', '2012-03-16 22:30:35'),
(47, 6, 1, 4, 1, 319176, '1', '3', '5', '7', 2, '2012-03-23 23:00:00', '0000-00-00 00:00:00'),
(48, 6, 1, 1, 1, 319177, '2', '4', '6', '8', 1, '2012-03-23 23:01:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ROM_user`
--

CREATE TABLE IF NOT EXISTS `ROM_user` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) NOT NULL,
  `short_name` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `flag` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ROM_user`
--

INSERT INTO `ROM_user` (`id`, `user_name`, `short_name`, `password`, `flag`) VALUES
(1, 'ben@controlsoft.com', 'Ben', 'BenKent1', NULL),
(2, 'alex@controlsoft.com', 'Alex', 'AJ1', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
