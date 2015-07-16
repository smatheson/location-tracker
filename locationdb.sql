-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2015 at 11:20 AM
-- Server version: 5.5.42-37.1-log
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `locationtracker_v2`
--
CREATE DATABASE `locationtracker_v2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `locationtracker_v2`;

-- --------------------------------------------------------

--
-- Table structure for table `coords`
--

DROP TABLE IF EXISTS `coords`;
CREATE TABLE IF NOT EXISTS `coords` (
  `coords_key` int(11) NOT NULL AUTO_INCREMENT,
  `xcoord` int(11) NOT NULL,
  `ycoord` int(11) NOT NULL,
  `coordCount` int(11) NOT NULL,
  `walkthrough_key` int(11) NOT NULL,
  `floor_key` int(11) NOT NULL,
  PRIMARY KEY (`coords_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5173 ;

-- --------------------------------------------------------

--
-- Table structure for table `floorNumber`
--

DROP TABLE IF EXISTS `floorNumber`;
CREATE TABLE IF NOT EXISTS `floorNumber` (
  `floor_key` int(11) NOT NULL,
  `floor_num` int(11) NOT NULL,
  PRIMARY KEY (`floor_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `walkthrough`
--

DROP TABLE IF EXISTS `walkthrough`;
CREATE TABLE IF NOT EXISTS `walkthrough` (
  `walkthrough_key` int(11) NOT NULL AUTO_INCREMENT,
  `timedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `patronCount` int(11) NOT NULL,
  `initials` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`walkthrough_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
