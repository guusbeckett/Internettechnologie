-- phpMyAdmin SQL Dump
-- version 4.2.11
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2014 at 03:20 PM
-- Server version: 5.5.40-0+wheezy1
-- PHP Version: 5.4.34-0+deb7u1

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
  `ALARM_TIME` datetime NOT NULL,
  `TYPE` int(11) NOT NULL,
  `STREAM` int(11) NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alarm`
--

INSERT INTO `alarm` (`RADIO_ID`, `ALARM_TIME`, `TYPE`, `STREAM`, `DESCRIPTION`) VALUES
(1, '2014-11-13 08:30:00', 1, 1, 'Goede morgen!');

-- --------------------------------------------------------

--
-- Table structure for table `radios`
--

CREATE TABLE IF NOT EXISTS `radios` (
`ID` int(11) NOT NULL,
  `NAME` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
`ID` int(11) NOT NULL,
  `URL` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `streams43`
--

INSERT INTO `streams43` (`NAME`, `ID`, `URL`) VALUES
('Celtic Music Radio', 23, 'https://195.10.228.6:8000/celticmusic.mp3'),
('Radio Nostalgie', 24, 'https://84.16.67.203/nostalgiewhatafeeling-128.mp3'),
('Kiss FM Ukraine ', 25, 'https://195.95.206.14:8000/kiss'),
('Rainwave ', 26, 'https://108.178.51.210:8000/all.mp3?26735:OuANWgvoAD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `radios`
--
ALTER TABLE `radios`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `streams43`
--
ALTER TABLE `streams43`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `radios`
--
ALTER TABLE `radios`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `streams43`
--
ALTER TABLE `streams43`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
