-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2013 at 01:07 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `geek`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE IF NOT EXISTS `tbl_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jid` int(11) NOT NULL,
  `image` varchar(222) NOT NULL,
  `uploaded_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jid` (`jid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_images`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs`
--

CREATE TABLE IF NOT EXISTS `tbl_jobs` (
  `jid` int(11) NOT NULL AUTO_INCREMENT,
  `headline` varchar(222) NOT NULL,
  `type` varchar(222) NOT NULL,
  `category` varchar(222) NOT NULL,
  `location` varchar(222) NOT NULL,
  `relocation` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `job_perks_description` text NOT NULL,
  `how_to_apply` text NOT NULL,
  `name` varchar(222) NOT NULL,
  `logo` varchar(222) DEFAULT NULL,
  `url` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `privacy` varchar(222) NOT NULL,
  `created_on` varchar(222) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`jid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_jobs`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `uid` varchar(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `name` varchar(222) NOT NULL,
  `status` int(11) NOT NULL,
  `joined_on` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD CONSTRAINT `tbl_images_ibfk_1` FOREIGN KEY (`jid`) REFERENCES `tbl_jobs` (`jid`) ON DELETE CASCADE ON UPDATE CASCADE;
