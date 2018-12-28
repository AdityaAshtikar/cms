-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 01, 2018 at 02:24 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tac`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `isAdmin` char(5) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `email`, `pass`, `isAdmin`) VALUES
(3, 'parmar', 'p@gmail.com', 'ppp', 'no'),
(5, 'prashita', 'prashita@gmail.com', 'ppp', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_time` time NOT NULL,
  `e_time` time NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`b_id`, `f_id`, `c_id`, `s_time`, `e_time`) VALUES
(4, 3, 6, '20:00:00', '21:00:00'),
(3, 5, 1, '08:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `batch_students`
--

CREATE TABLE IF NOT EXISTS `batch_students` (
  `b_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_time` time NOT NULL,
  `e_time` time NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_students`
--

INSERT INTO `batch_students` (`b_id`, `f_id`, `c_id`, `s_time`, `e_time`, `s_id`) VALUES
(1, 3, 1, '14:00:00', '16:00:00', 1),
(1, 3, 1, '14:00:00', '16:00:00', 6),
(2, 5, 7, '17:00:00', '18:00:00', 3),
(2, 5, 7, '17:00:00', '18:00:00', 8),
(2, 5, 7, '17:00:00', '18:00:00', 3),
(2, 5, 7, '17:00:00', '18:00:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL,
  `c_duration` varchar(30) NOT NULL,
  `fees` int(11) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `c_name`, `c_duration`, `fees`) VALUES
(1, 'PHP', '30', 4000),
(8, 'C', '30', 3000),
(7, 'Java', '60', 6000),
(6, 'Android', '50', 5000),
(9, 'C++', '30', 4000),
(10, 'Arduino', '90', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `college` varchar(100) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `sem` int(11) NOT NULL,
  `no_students` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`s_id`, `name`, `phone`, `email`, `college`, `branch`, `sem`, `no_students`, `c_id`, `date`) VALUES
(1, 'Aditya', '8871877665', 'aditya@gmail.com', 'RCET, Raipur', 'CSE', 8, 4, 1, '2016-03-05'),
(2, 'Aditya', '8871877665', 'aditya@gmail.com', 'RCET, Raipur', 'CSE', 8, 4, 8, '2016-03-05'),
(3, 'Aditya', '8871877665', 'aditya@gmail.com', 'RCET, Raipur', 'CSE', 8, 4, 7, '2016-03-05'),
(4, 'Aditya', '8871877665', 'aditya@gmail.com', 'RCET, Raipur', 'CSE', 8, 4, 6, '2016-03-05'),
(5, 'Aditya', '8871877665', 'aditya@gmail.com', 'RCET, Raipur', 'CSE', 8, 4, 9, '2016-03-05'),
(6, 'Shweeta', '7415535562', 's@abc.com', 'SSIPMT', 'BCA', 5, 3, 1, '2013-10-06'),
(7, 'Shweeta', '7415535562', 's@abc.com', 'SSIPMT', 'BCA', 5, 3, 8, '2013-10-06'),
(8, 'Shweeta', '7415535562', 's@abc.com', 'SSIPMT', 'BCA', 5, 3, 7, '2013-10-06'),
(9, 'Shweeta', '7415535562', 's@abc.com', 'SSIPMT', 'BCA', 5, 3, 6, '2013-10-06'),
(10, 'Satyajeet', '44566332', 'satya@gmail.com', 'REC BHILAI', 'Mech', 4, 1, 1, '2018-07-29'),
(11, 'Satyajeet', '44566332', 'satya@gmail.com', 'REC BHILAI', 'Mech', 4, 1, 6, '2018-07-29'),
(12, 'Satyajeet', '44566332', 'satya@gmail.com', 'REC BHILAI', 'Mech', 4, 1, 9, '2018-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_status`
--

CREATE TABLE IF NOT EXISTS `enquiry_status` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `status` varchar(3) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `enquiry_status`
--

INSERT INTO `enquiry_status` (`s_id`, `c_id`, `status`) VALUES
(1, 1, 'no'),
(2, 8, 'no'),
(3, 7, 'yes'),
(4, 6, 'no'),
(5, 1, 'no'),
(6, 8, 'no'),
(7, 7, 'no'),
(8, 6, 'yes'),
(9, 9, 'no'),
(10, 1, 'no'),
(11, 1, 'no'),
(12, 8, 'no'),
(13, 7, 'no'),
(14, 6, 'no'),
(15, 9, 'no'),
(16, 1, 'no'),
(17, 8, 'no'),
(18, 7, 'no'),
(19, 6, 'no'),
(20, 1, 'no'),
(21, 6, 'no'),
(22, 9, 'no');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
