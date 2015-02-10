-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2015 at 01:43 PM
-- Server version: 5.5.40-MariaDB-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipac_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `alarm`
--

CREATE TABLE IF NOT EXISTS `alarm` (
  `RADIO_ID` int(11) NOT NULL,
  `ALARM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ALARM_TIME` datetime NOT NULL,
  `TYPE` int(11) NOT NULL,
  `STREAM` int(11) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  PRIMARY KEY (`ALARM_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `alarm`
--

INSERT INTO `alarm` (`RADIO_ID`, `ALARM_ID`, `ALARM_TIME`, `TYPE`, `STREAM`, `DESCRIPTION`) VALUES
(1, 1, '2015-01-12 21:30:00', 0, 25, '120 running CC'),
(1, 2, '2015-01-16 17:22:00', 0, 24, 'Laatste dag');

-- --------------------------------------------------------

--
-- Table structure for table `radios`
--

CREATE TABLE IF NOT EXISTS `radios` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `radios`
--

INSERT INTO `radios` (`ID`, `NAME`) VALUES
(1, 'Joris');

-- --------------------------------------------------------

--
-- Table structure for table `streams43`
--

CREATE TABLE IF NOT EXISTS `streams43` (
  `NAME` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `streams43`
--

INSERT INTO `streams43` (`NAME`, `ID`, `URL`) VALUES
('Celtic Music Radio', 23, '195.10.228.6:8000/celticmusic.mp3'),
('Radio Nostalgie', 24, '84.16.67.203/nostalgiewhatafeeling-128.mp3'),
('Kiss FM Ukraine ', 25, '195.95.206.14:8000/kiss'),
('Rainwave ', 26, '108.178.51.210:8000/all.mp3?26735:OuANWgvoAD'),
('Je moeder', 29, '188.166.22.194/Je_moeder.mp3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
