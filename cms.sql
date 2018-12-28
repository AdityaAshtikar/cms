-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2018 at 05:44 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cms`;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `atext` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `atext`, `user_id`, `q_id`) VALUES
(0, '50%', 1, 1),
(0, '88%', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `topic` varchar(100) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `user_id`, `status`, `created`, `topic`, `comment`) VALUES
(8, 'tac.sql', 22, 1, '2018-09-23 09:47:34', 'sql', 'tac db file'),
(9, 'Main.class', 22, 1, '2018-09-23 09:54:51', 'javaFiles', 'Prime number solution'),
(10, 'Main.java', 22, 1, '2018-09-23 09:54:51', 'javaFiles', 'Prime number solution'),
(11, 'Main.class', 22, 1, '2018-09-23 09:56:11', 'javaFiles', 'solution'),
(12, 'Main.java', 22, 1, '2018-09-23 09:56:11', 'javaFiles', 'solution'),
(13, '938967-widescreen-fernando-torres-wallpaper-2018-1920x1200.jpg', 21, 1, '2018-09-24 11:01:50', 'Sports', 'CVSTU sports day'),
(14, 'joshua-earle-560344-unsplash.jpg', 21, 1, '2018-09-24 11:01:50', 'Sports', 'CVSTU sports day'),
(15, 'mishal-ibrahim-649128-unsplash.jpg', 21, 1, '2018-09-24 11:01:50', 'Sports', 'CVSTU sports day'),
(17, 'Gone.Girl.2014.720p.BluRay.x264.YIFY.srt', 21, 1, '2018-09-27 12:44:31', 'srt file', 'gone girl');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isRandom` tinyint(4) NOT NULL,
  `postId` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `isRandom`, `postId`, `status`) VALUES
(1, 'random', 1, 0, 1),
(2, 'Academics', 0, 0, 1),
(3, 'Training and Placements', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postId`, `user_id`, `comment`, `created`) VALUES
(4, 3, 1, 'ok', '2018-12-28 12:01:41'),
(5, 3, 1, 'yes', '2018-12-28 12:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`, `created`) VALUES
(1, 'Aasthahuja.01@gmail.com', '2018-10-31 00:00:00'),
(2, 'ashtikar.aditya97@gmail.com', '2018-10-31 00:00:00'),
(3, 'himanshuparmar1212@gmail.com', '2018-10-31 00:00:00'),
(4, '	\r\nanilhansda07@gmail.com', '2018-10-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `cat_id` varchar(10) NOT NULL,
  `isImportant` tinyint(4) NOT NULL DEFAULT '0',
  `access_to` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `content`, `cat_id`, `isImportant`, `access_to`, `user_id`, `created`, `status`) VALUES
(2, 'Come to lab 8A', '3', 1, 'everyone', 1, '2018-12-28 12:00:05', 1),
(3, 'Sports day celebrations today', '1', 1, 'student', 1, '2018-12-28 12:01:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int(11) NOT NULL,
  `important` tinyint(4) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qfa`
--

CREATE TABLE `qfa` (
  `id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `appr` int(11) NOT NULL,
  `dppr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qfa`
--

INSERT INTO `qfa` (`id`, `q_id`, `f_id`, `appr`, `dppr`) VALUES
(1, 2, 21, 1, 0),
(2, 1, 21, 0, 1),
(3, 3, 21, 0, 1),
(4, 7, 25, 0, 1),
(5, 9, 25, 0, 1),
(6, 1, 26, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `qtext` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `isUnknown` tinyint(4) NOT NULL DEFAULT '0',
  `fac_appr_count` int(11) NOT NULL DEFAULT '0',
  `upvote` int(11) NOT NULL DEFAULT '0',
  `downvote` int(11) NOT NULL DEFAULT '0',
  `upvote_fac_count` int(11) NOT NULL DEFAULT '0',
  `target_fac_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `appr_fac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `qtext`, `user_id`, `status`, `isUnknown`, `fac_appr_count`, `upvote`, `downvote`, `upvote_fac_count`, `target_fac_id`, `created`, `appr_fac_id`) VALUES
(1, 'when is the last date to submit the exam form', 26, 1, 0, 2, 0, 0, 0, 19, '2018-10-31 11:10:12', 1),
(2, 'Attendance today?', 1, 1, 0, 0, 0, 0, 0, 0, '2018-12-27 11:56:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `faculty_id` varchar(200) NOT NULL,
  `is_faculty` tinyint(4) NOT NULL DEFAULT '0',
  `is_HOD` tinyint(4) NOT NULL DEFAULT '0',
  `is_CR` tinyint(4) NOT NULL DEFAULT '0',
  `profile_pic` text NOT NULL,
  `isVerified` tinyint(4) NOT NULL DEFAULT '0',
  `token` text NOT NULL,
  `created` datetime NOT NULL,
  `cookieToken` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `department`, `email`, `phone`, `password`, `faculty_id`, `is_faculty`, `is_HOD`, `is_CR`, `profile_pic`, `isVerified`, `token`, `created`, `cookieToken`) VALUES
(1, 'aditya', 'ashtikar', 'adi', 'CSE', 'ashtikar.aditya97@gmail.com', '8871877665', 'b0fdb96da124c5826f43895548874ed9', 'AQ8439', 1, 0, 0, 'assets/images/profilePic/939007-fernando-torres-wallpaper-2018-1920x1295-hd-1080p.jpg', 1, '', '2018-12-27 11:53:51', '54b6dda270b1a793cbc788d012f8aa71');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qfa`
--
ALTER TABLE `qfa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qfa`
--
ALTER TABLE `qfa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
