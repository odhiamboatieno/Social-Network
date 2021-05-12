-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2019 at 09:39 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharetime`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `user_name`, `user_pass`) VALUES
(1, 'Odhiambo Thomas', '05f3672ba34409136aa71b8d00070d1b');

-- --------------------------------------------------------

--
-- Table structure for table `sharetime`
--

CREATE TABLE `sharetime` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `date_added` date NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(32) NOT NULL,
  `photos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sharetime`
--

INSERT INTO `sharetime` (`id`, `body`, `date_added`, `post_time`, `added_by`, `photos`) VALUES
(5, 'hey', '2019-03-13', '2019-03-15 08:48:25', 'kenny', 'tommmy/1550579663.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sharetime_comments`
--

CREATE TABLE `sharetime_comments` (
  `id` int(11) NOT NULL,
  `ShareTime_body` text NOT NULL,
  `date_added` date NOT NULL,
  `time` datetime NOT NULL,
  `ShareTime_by` varchar(32) NOT NULL,
  `ShareTime_to` varchar(32) NOT NULL,
  `opened` varchar(3) NOT NULL DEFAULT 'no',
  `ShareTime_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `share_likes`
--

CREATE TABLE `share_likes` (
  `id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `share_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emoticons`
--

CREATE TABLE `emoticons` (
  `id` int(11) NOT NULL,
  `chars` text NOT NULL,
  `photos` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `user_from` varchar(32) NOT NULL,
  `user_to` varchar(32) NOT NULL,
  `time` datetime NOT NULL,
  `opened` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `user_from`, `user_to`, `time`, `opened`) VALUES
(139, 'tommmy', 'osamaq', '2019-02-19 15:21:48', 'no'),
(140, 'cutie', 'osamab', '2019-02-19 16:36:27', 'no'),
(149, 'kenny', 'mercy', '2019-03-12 17:26:56', 'no'),
(144, 'cutie', 'tommmy', '2019-03-01 12:48:15', 'no'),
(158, 'kenny', 'suzzy', '2019-03-17 22:47:14', 'yes'),
(152, 'neoboy', 'kenny', '2019-03-14 19:36:01', 'yes'),
(155, 'cutie', 'kenny', '2019-03-15 12:59:16', 'yes'),
(154, 'josephgabi', 'tommmy', '2019-03-15 12:37:09', 'no'),
(157, 'pieretek', 'josephgabi', '2019-03-15 13:39:03', 'yes'),
(159, 'suzzy', 'kenny', '2019-03-17 22:51:46', 'yes'),
(160, 'suzzy', 'neoboy', '2019-03-18 19:27:29', 'yes'),
(161, 'ngotho', 'sexallday', '2019-03-30 08:27:42', 'no'),
(162, 'neoboy', 'suzzy', '2019-04-04 17:29:04', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `ShareTime_body` text NOT NULL,
  `date_added` date NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(255) NOT NULL,
  `user_posted_to` varchar(255) NOT NULL,
  `share_post` int(11) NOT NULL,
  `ShareTime_post` int(11) NOT NULL,
  `ShareTime_give` tinyint(1) NOT NULL DEFAULT '0',
  `discription` text NOT NULL,
  `photos` text NOT NULL,
  `newsfeedshow` tinyint(1) NOT NULL DEFAULT '1',
  `report` tinyint(1) NOT NULL DEFAULT '0',
  `note` tinyint(1) NOT NULL DEFAULT '0',
  `note_privacy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `ShareTime_body`, `date_added`, `post_time`, `added_by`, `user_posted_to`, `share_post`, `ShareTime_post`, `ShareTime_give`, `discription`, `photos`, `newsfeedshow`, `report`, `note`, `note_privacy`) VALUES
(229, '', '', '2019-02-15', '2019-02-15 08:33:10', 'osamaq', 'osamaq', 0, 0, 0, 'changed his profile picture.', 'osamaq/1550219590.jpg', 1, 1, 0, ''),
(230, 'HELLO NIGGAS', '', '2019-02-15', '2019-02-15 08:35:29', 'osamaq', 'osamaq', 0, 0, 0, '', 'osamaq/1550219729.jpg', 1, 0, 0, ''),
(231, '', '', '2019-02-15', '2019-02-15 09:05:29', 'osamaq', 'osamaq', 0, 0, 0, 'updated his cover photo.', 'osamaq/1550221529.jpg', 1, 0, 0, ''),
(232, 'hey guys', '', '2019-02-19', '2019-02-19 12:21:35', 'tommmy', 'tommmy', 0, 0, 0, '', '', 1, 0, 0, ''),
(233, '', '', '2019-02-19', '2019-02-19 12:33:57', 'tommmy', 'tommmy', 0, 0, 0, 'changed his profile picture.', 'tommmy/1550579637.jpg', 1, 0, 0, ''),
(234, '', '', '2019-02-19', '2019-02-19 12:34:23', 'tommmy', 'tommmy', 0, 0, 0, 'updated his cover photo.', 'tommmy/1550579663.jpg', 1, 0, 0, ''),
(235, '', '', '2019-02-19', '2019-02-19 13:33:59', 'cutie', 'cutie', 0, 0, 0, 'changed his profile picture.', 'cutie/1550583239.jpg', 1, 0, 0, ''),
(236, '', '', '2019-02-19', '2019-02-19 13:34:26', 'cutie', 'cutie', 0, 0, 0, 'updated his cover photo.', 'cutie/1550583266.JPG', 1, 0, 0, ''),
(237, '', '', '2019-02-19', '2019-02-19 16:21:00', 'cutie', 'tommmy', 0, 0, 0, '', 'cutie/1550593260.gif', 0, 0, 0, ''),
(238, '', '', '2019-02-19', '2019-02-19 16:25:19', 'cutie', 'cutie', 0, 0, 0, 'changed his profile picture.', 'cutie/1550593519.jpg', 1, 0, 0, ''),
(239, '', '', '2019-02-19', '2019-02-19 16:25:59', 'cutie', 'cutie', 0, 0, 0, 'changed his profile picture.', 'cutie/1550593559.jpg', 1, 0, 0, ''),
(240, '', '', '2019-02-19', '2019-02-19 16:27:16', 'cutie', 'cutie', 0, 0, 0, 'changed his profile picture.', 'cutie/1550593636.jpg', 1, 0, 0, ''),
(241, '', '', '2019-02-19', '2019-02-19 16:29:27', 'cutie', 'cutie', 0, 0, 0, 'changed his profile picture.', 'cutie/1550593767.jpg', 1, 0, 0, ''),
(242, '', '', '2019-02-19', '2019-02-19 16:39:31', 'cutie', 'cutie', 0, 0, 0, 'updated his cover photo.', 'cutie/1550594371.jpg', 1, 0, 0, ''),
(243, 'sharetime  is aweome guys join me here', '', '2019-02-19', '2019-02-19 16:40:40', 'cutie', 'cutie', 0, 0, 0, '', '', 1, 0, 0, ''),
(244, '', 'Hello guys today is a nice day for we all', '2019-03-01', '2019-03-01 09:50:45', 'cutie', 'cutie', 0, 0, 1, '', '', 1, 0, 0, ''),
(245, '', '', '2019-03-01', '2019-03-01 10:49:33', 'mercy', 'mercy', 0, 0, 0, '', 'mercy/1551437373.jpg', 1, 0, 0, ''),
(246, '', '', '2019-03-01', '2019-03-01 10:50:03', 'mercy', 'mercy', 0, 0, 0, '', 'mercy/1551437403.jpg', 1, 0, 0, ''),
(247, '', '', '2019-03-01', '2019-03-01 10:50:28', 'mercy', 'mercy', 0, 0, 0, '', 'mercy/1551437428.jpg', 1, 0, 0, ''),
(248, '', '', '2019-03-01', '2019-03-01 10:50:47', 'mercy', 'mercy', 0, 0, 0, '', 'mercy/1551437447.jpg', 1, 0, 0, ''),
(249, '', '', '2019-03-01', '2019-03-01 10:51:34', 'cutie', 'cutie', 0, 0, 0, '', 'cutie/1551437494.jpg', 1, 0, 0, ''),
(250, '', '', '2019-03-01', '2019-03-01 10:52:12', 'cutie', 'cutie', 0, 0, 0, '', 'cutie/1551437532.jpg', 1, 0, 0, ''),
(251, '', '', '2019-03-01', '2019-03-01 10:53:25', 'cutie', 'cutie', 0, 0, 0, '', 'cutie/1551437604.jpg', 1, 0, 0, ''),
(252, '', '', '2019-03-01', '2019-03-01 11:00:33', 'cutie', 'cutie', 0, 0, 0, 'changed her profile picture.', 'cutie/1551438033.jpg', 0, 0, 0, ''),
(253, '', '', '2019-03-01', '2019-03-01 11:07:07', 'cutie', 'cutie', 0, 0, 0, 'changed her profile picture.', 'cutie/1551438427.jpg', 0, 0, 0, ''),
(254, '', '', '2019-03-01', '2019-03-01 11:11:49', 'cutie', 'cutie', 0, 0, 0, 'updated her cover photo.', 'cutie/1551438709.jpg', 0, 0, 0, ''),
(255, '', '', '2019-03-01', '2019-03-01 11:19:46', 'kenny', 'kenny', 0, 0, 0, 'changed his profile picture.', 'kenny/1551439186.jpg', 0, 0, 0, ''),
(256, '', '', '2019-03-01', '2019-03-01 11:20:33', 'kenny', 'kenny', 0, 0, 0, 'updated his cover photo.', 'kenny/1551439233.jpg', 0, 0, 0, ''),
(257, '', '', '2019-03-02', '2019-03-02 09:40:17', 'cutie', 'cutie', 0, 0, 0, 'changed her profile picture.', 'cutie/1551519617.jpg', 0, 0, 0, ''),
(258, '', '', '2019-03-02', '2019-03-02 09:41:27', 'cutie', 'cutie', 0, 0, 0, 'updated her cover photo.', 'cutie/1551519687.jpg', 0, 0, 0, ''),
(259, 'dffebh dgrhh dfeteh', '', '2019-03-06', '2019-03-06 07:49:56', 'kenny', 'kenny', 0, 0, 0, '', '', 1, 0, 0, ''),
(260, '', '', '2019-03-06', '2019-03-06 07:58:04', 'mercy', 'mercy', 0, 0, 0, 'changed her profile picture.', 'mercy/1551859084.jpg', 0, 0, 0, ''),
(261, '', '', '2019-03-06', '2019-03-06 08:00:05', 'mercy', 'mercy', 0, 0, 0, 'updated her cover photo.', 'mercy/1551859205.jpg', 0, 0, 0, ''),
(262, '', '', '2019-03-12', '2019-03-12 12:56:00', 'cutie', 'cutie', 0, 0, 0, 'changed her profile picture.', 'cutie/1552395360.jpg', 0, 0, 0, ''),
(263, '', '', '2019-03-12', '2019-03-12 12:56:58', 'cutie', 'cutie', 0, 0, 0, 'changed her profile picture.', 'cutie/1552395418.jpg', 0, 0, 0, ''),
(264, '', 'Hello dudes', '2019-03-12', '2019-03-12 14:12:28', 'kenny', 'kenny', 0, 0, 1, '', '', 1, 0, 0, ''),
(265, '', 'ASDFGHJKL;\'', '2019-03-12', '2019-03-12 14:13:41', 'kenny', 'kenny', 0, 0, 1, '', '', 1, 0, 0, ''),
(266, 'asdfghjkl;', '', '2019-03-12', '2019-03-12 14:14:12', 'kenny', 'kenny', 0, 0, 0, '', 'kenny/1552400052.jpg', 1, 0, 0, ''),
(267, '', '', '2019-03-12', '2019-03-12 14:15:54', 'kenny', 'kenny', 0, 0, 0, 'changed his profile picture.', 'kenny/1552400154.png', 0, 0, 0, ''),
(268, '', '', '2019-03-12', '2019-03-12 14:45:57', 'neoboy', 'neoboy', 0, 0, 0, 'changed his profile picture.', 'neoboy/1552401957.png', 0, 0, 0, ''),
(269, '', '', '2019-03-12', '2019-03-12 14:46:45', 'neoboy', 'neoboy', 0, 0, 0, 'updated his cover photo.', 'neoboy/1552402005.jpg', 0, 0, 0, ''),
(270, '', '', '2019-03-12', '2019-03-12 14:47:01', 'neoboy', 'neoboy', 0, 0, 0, 'updated his cover photo.', 'neoboy/1552402021.jpg', 0, 0, 0, ''),
(271, 'kool', '', '2019-03-12', '2019-03-12 14:49:28', 'neoboy', 'neoboy', 0, 0, 0, '', 'neoboy/1552402168.jpg', 1, 0, 0, ''),
(272, '', '', '2019-03-13', '2019-03-13 07:59:54', 'kenny', 'kenny', 0, 0, 0, 'changed his profile picture.', 'kenny/1552463994.jpg', 0, 0, 0, ''),
(273, '', '', '2019-03-13', '2019-03-13 12:27:38', 'kenny', 'kenny', 0, 0, 0, 'changed his profile picture.', 'kenny/1552480058.png', 0, 0, 0, ''),
(275, '', '', '2019-03-13', '2019-03-13 13:03:39', 'neoboy', 'neoboy', 0, 0, 0, 'changed his profile picture.', 'neoboy/1552482219.jpg', 0, 0, 0, ''),
(276, '', '', '2019-03-13', '2019-03-13 13:04:01', 'neoboy', 'neoboy', 0, 0, 0, 'changed his profile picture.', 'neoboy/1552482241.jpg', 0, 0, 0, ''),
(277, 'I am really annoyed', '', '2019-03-13', '2019-03-13 16:17:25', 'neoboy', 'neoboy', 0, 0, 0, '', '', 1, 0, 0, ''),
(278, 'I am really annoyed', '', '2019-03-13', '2019-03-13 16:18:02', 'neoboy', 'neoboy', 0, 0, 0, '', '', 1, 0, 0, ''),
(279, 'fuck them all', '', '2019-03-13', '2019-03-13 16:25:45', 'neoboy', 'neoboy', 0, 0, 0, '', '', 1, 0, 0, ''),
(280, 'asdfghj', '', '2019-03-13', '2019-03-13 16:26:12', 'neoboy', 'neoboy', 0, 0, 0, '', '', 1, 0, 0, ''),
(281, 'ASDRFTYUI', '', '2019-03-13', '2019-03-13 16:26:17', 'neoboy', 'neoboy', 0, 0, 0, '', '', 1, 0, 0, ''),
(282, 'ASDFGYHUIOL', '', '2019-03-13', '2019-03-13 16:26:22', 'neoboy', 'neoboy', 0, 0, 0, '', '', 1, 0, 0, ''),
(283, 'ASDFGYHUIOL', '', '2019-03-13', '2019-03-13 16:43:04', 'neoboy', 'neoboy', 0, 0, 0, '', '', 1, 0, 0, ''),
(284, 'good night', '', '2019-03-13', '0000-00-00 00:00:00', 'neoboy', 'neoboy', 0, 0, 0, 'public', '', 0, 0, 1, 'public'),
(285, '', '', '2019-03-14', '2019-03-14 16:37:14', 'neoboy', 'neoboy', 0, 0, 0, 'changed his profile picture.', 'neoboy/1552581434.jpg', 0, 0, 0, ''),
(286, '', '', '2019-03-14', '2019-03-14 16:44:19', 'josephgabi', 'josephgabi', 0, 0, 0, 'changed his profile picture.', 'josephgabi/1552581859.jpg', 0, 0, 0, ''),
(287, '', '', '2019-03-14', '2019-03-14 16:44:36', 'josephgabi', 'josephgabi', 0, 0, 0, 'updated his cover photo.', 'josephgabi/1552581876.jpg', 0, 0, 0, ''),
(288, '', 'hey buddy', '2019-03-14', '2019-03-14 18:41:17', 'josephgabi', 'josephgabi', 0, 0, 1, '', 'josephgabi/1552588877.jpg', 1, 0, 0, ''),
(289, '', '', '2019-03-15', '2019-03-15 10:07:38', 'pieretek', 'pieretek', 0, 0, 0, 'changed his profile picture.', 'pieretek/1552644458.jpg', 0, 0, 0, ''),
(290, '', '', '2019-03-15', '2019-03-15 10:07:50', 'pieretek', 'pieretek', 0, 0, 0, 'changed his profile picture.', 'pieretek/1552644470.jpg', 0, 0, 0, ''),
(291, '', '', '2019-03-15', '2019-03-15 10:08:36', 'pieretek', 'pieretek', 0, 0, 0, 'updated his cover photo.', 'pieretek/1552644516.jpg', 0, 0, 0, ''),
(292, 'Kesho ni Weekend', '', '2019-03-15', '0000-00-00 00:00:00', 'josephgabi', 'josephgabi', 0, 0, 0, 'public', '', 0, 0, 1, 'public'),
(293, 'I miss my girlfriend Faith', '', '2019-03-17', '2019-03-17 13:20:41', 'neoboy', 'neoboy', 0, 0, 0, '', '', 1, 0, 0, ''),
(295, 'I really miss my sweetheart Faith', '', '2019-03-17', '2019-03-17 13:23:03', 'neoboy', 'neoboy', 0, 0, 0, '', 'neoboy/1552828983.jpg', 1, 0, 0, ''),
(296, '', '', '2019-03-17', '2019-03-17 13:36:59', 'suzzy', 'suzzy', 0, 0, 0, 'changed her profile picture.', 'suzzy/1552829819.jpg', 0, 0, 0, ''),
(297, '', '', '2019-03-17', '2019-03-17 13:37:31', 'suzzy', 'suzzy', 0, 0, 0, 'updated her cover photo.', 'suzzy/1552829851.jpg', 0, 0, 0, ''),
(298, '', '', '2019-03-17', '2019-03-17 13:38:31', 'suzzy', 'suzzy', 0, 0, 0, 'updated her cover photo.', 'suzzy/1552829911.jpg', 0, 0, 0, ''),
(299, '', '', '2019-03-17', '2019-03-17 18:57:43', 'neoboy', 'neoboy', 0, 0, 0, 'updated his cover photo.', 'neoboy/1552849063.png', 0, 0, 0, ''),
(301, 'Baby gal', '', '2019-03-17', '2019-03-17 19:05:45', 'neoboy', 'neoboy', 0, 0, 0, '', 'neoboy/1552849545.jpg', 1, 0, 0, ''),
(302, '', '', '2019-03-17', '2019-03-17 19:07:41', 'neoboy', 'neoboy', 0, 0, 0, '', 'neoboy/1552849661.jpg', 1, 1, 0, ''),
(305, 'thi ss is bad', '', '2019-03-17', '2019-03-17 19:26:24', 'suzzy', 'suzzy', 0, 0, 0, '', '', 1, 0, 0, ''),
(309, 'thi ss is bad', '', '2019-03-17', '2019-03-17 19:33:58', 'suzzy', 'suzzy', 0, 0, 0, '', '', 1, 0, 0, ''),
(310, 'hello people', '', '2019-03-18', '2019-03-18 16:27:45', 'suzzy', 'suzzy', 0, 0, 0, '', '', 1, 0, 0, ''),
(311, '', '', '2019-03-20', '2019-03-20 15:26:24', 'calmer9890', 'calmer9890', 0, 0, 0, 'changed his profile picture.', 'calmer9890/1553095584.jpg', 0, 0, 0, ''),
(312, '', '', '2019-03-20', '2019-03-20 15:26:37', 'calmer9890', 'calmer9890', 0, 0, 0, 'updated his cover photo.', 'calmer9890/1553095597.jpg', 0, 0, 0, ''),
(313, 'Hello World', '', '2019-03-26', '2019-03-26 17:37:54', 'markzuckerberg', 'markzuckerberg', 0, 0, 0, '', '', 1, 0, 0, ''),
(314, '', '', '2019-03-26', '2019-03-26 17:39:14', 'markzuckerberg', 'markzuckerberg', 0, 0, 0, 'changed his profile picture.', 'markzuckerberg/1553621954.jpg', 0, 0, 0, ''),
(315, '', '', '2019-03-26', '2019-03-26 17:40:04', 'markzuckerberg', 'markzuckerberg', 0, 0, 0, 'updated his cover photo.', 'markzuckerberg/1553622004.jpg', 0, 0, 0, ''),
(316, '', '', '2019-03-26', '2019-03-26 17:42:49', 'markzuckerberg', 'markzuckerberg', 0, 0, 0, 'updated his cover photo.', 'markzuckerberg/1553622169.jpg', 0, 0, 0, ''),
(317, 'Long ago when I was a little boy', '', '2019-03-26', '2019-03-26 17:44:19', 'markzuckerberg', 'markzuckerberg', 0, 0, 0, '', 'markzuckerberg/1553622259.jpg', 1, 0, 0, ''),
(318, '', '', '2019-03-27', '2019-03-27 16:12:48', 'markzuckerberg', 'markzuckerberg', 0, 0, 0, 'updated his cover photo.', 'markzuckerberg/1553703168.PNG', 0, 0, 0, ''),
(319, '', '', '2019-03-27', '2019-03-27 16:14:27', 'markzuckerberg', 'markzuckerberg', 0, 0, 0, 'updated his cover photo.', 'markzuckerberg/1553703267.jpg', 0, 0, 0, ''),
(320, 'good to know yo live guys', '', '2019-03-27', '2019-03-27 16:18:19', 'markzuckerberg', 'markzuckerberg', 0, 0, 0, '', '', 1, 0, 0, ''),
(321, '', '', '2019-03-30', '2019-03-30 05:41:29', 'kenny', 'kenny', 0, 0, 0, '', 'kenny/1553924489.png', 1, 1, 0, ''),
(322, 'Hello friends', '', '2019-04-07', '2019-04-07 09:55:41', 'kenny', 'kenny', 0, 0, 0, '', 'kenny/1554630941.jpg', 1, 0, 0, ''),
(323, '', '', '2019-04-07', '2019-04-07 09:59:42', 'oscah', 'oscah', 0, 0, 0, 'changed his profile picture.', 'oscah/1554631182.jpg', 0, 0, 0, ''),
(324, '', '', '2019-04-07', '2019-04-07 10:00:02', 'oscah', 'oscah', 0, 0, 0, 'updated his cover photo.', 'oscah/1554631202.jpg', 0, 0, 0, ''),
(325, 'hello cool chat... im tonny', '', '2019-04-07', '0000-00-00 00:00:00', 'oscah', 'oscah', 0, 0, 0, 'public', '', 0, 0, 1, 'public'),
(326, 'shsajs', '', '2019-04-07', '2019-04-07 10:05:04', 'oscah', 'oscah', 0, 0, 0, '', '', 1, 0, 0, ''),
(327, 'shsajs', '', '2019-04-07', '2019-04-07 10:06:15', 'oscah', 'oscah', 0, 0, 0, '', '', 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `date_added` date NOT NULL,
  `time` datetime NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `posted_to` varchar(255) NOT NULL,
  `opened` varchar(3) NOT NULL DEFAULT 'no',
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_body`, `date_added`, `time`, `posted_by`, `posted_to`, `opened`, `post_id`) VALUES
(1, 'cute', '2019-02-19', '2019-02-19 19:16:38', 'cutie', 'cutie', 'yes', 236),
(2, 'cute', '2019-02-19', '2019-02-19 19:17:03', 'tommmy', 'cutie', 'yes', 236),
(3, 'nice', '2019-02-19', '2019-02-19 19:35:44', 'tommmy', 'tommmy', 'yes', 234),
(4, 'good', '2019-02-20', '2019-02-20 13:46:58', 'cutie', 'cutie', 'yes', 239),
(5, 'yes', '2019-03-12', '2019-03-12 17:23:12', 'cutie', 'kenny', 'yes', 264),
(6, 'RIP dad', '2019-03-12', '2019-03-12 17:25:39', 'cutie', 'kenny', 'yes', 255),
(7, 'good one', '2019-03-13', '2019-03-13 10:50:20', 'kenny', 'neoboy', 'yes', 269),
(8, 'omera', '2019-03-13', '2019-03-13 11:03:35', 'kenny', 'kenny', 'yes', 259),
(9, 'why', '2019-03-13', '2019-03-13 19:17:55', 'neoboy', 'neoboy', 'yes', 277),
(10, 'good one', '2019-03-15', '2019-03-15 12:05:27', 'josephgabi', 'kenny', 'yes', 273),
(11, 'so ?', '2019-03-15', '2019-03-15 13:14:03', 'pieretek', 'josephgabi', 'no', 292),
(12, 'KUTAWAKA MOTO', '2019-03-15', '2019-03-15 13:14:40', 'josephgabi', 'josephgabi', 'no', 292),
(13, 'hahaaa love jooh', '2019-03-17', '2019-03-17 16:25:34', 'kenny', 'neoboy', 'yes', 294),
(14, 'KUTAWAKA MOTO', '2019-03-17', '2019-03-17 22:08:13', 'neoboy', 'neoboy', 'yes', 302),
(15, 'Gal I miss u.. and i miss when am gonna f*ck you', '2019-03-17', '2019-03-17 22:42:37', 'suzzy', 'suzzy', 'no', 297),
(16, 'Nice to see ', '2019-03-27', '2019-03-27 19:14:47', 'markzuckerberg', 'markzuckerberg', 'no', 319);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_name`, `post_id`) VALUES
(1, 'cutie', 236),
(2, 'tommmy', 236),
(3, 'cutie', 229),
(4, 'cutie', 242),
(5, 'kenny', 232),
(6, 'josephgabi', 5),
(7, 'josephgabi', 272),
(9, 'josephgabi', 287),
(10, 'josephgabi', 286),
(11, 'josephgabi', 266),
(12, 'josephgabi', 267),
(13, 'josephgabi', 256),
(14, 'josephgabi', 288),
(15, 'cutie', 266),
(16, 'cutie', 250),
(17, 'josephgabi', 289),
(19, 'neoboy', 295),
(20, 'suzzy', 266),
(21, 'markzuckerberg', 313),
(22, 'markzuckerberg', 317),
(23, 'neoboy', 287);

-- --------------------------------------------------------

--
-- Table structure for table `pvt_messages`
--

CREATE TABLE `pvt_messages` (
  `id` int(11) NOT NULL,
  `user_from` varchar(255) NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `msg_body` text NOT NULL,
  `date` date NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opened` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pvt_messages`
--

INSERT INTO `pvt_messages` (`id`, `user_from`, `user_to`, `msg_body`, `date`, `msg_time`, `opened`, `user_id`) VALUES
(1, 'tommmy', 'neoboy', 'hello bro', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(2, 'tommmy', 'cutie', 'Hello My cutie', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(4, 'tommmy', 'cutie', 'how are you doing', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(5, 'cutie', 'tommmy', 'am good', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(6, 'tommmy', 'cutie', 'ok gal', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(7, 'cutie', 'tommmy', 'come neo', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(8, 'tommmy', 'cutie', 'where', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(9, 'cutie', 'tommmy', 'School', '2019-02-19', '0000-00-00 00:00:00', 'no', 0),
(10, 'tommmy', 'cutie', 'ok', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(11, 'cutie', 'tommmy', 'ok', '2019-02-19', '0000-00-00 00:00:00', 'yes', 0),
(12, 'kenny', 'osamaq', 'hello Neo', '2019-03-06', '0000-00-00 00:00:00', 'no', 0),
(13, 'mercy', 'kenny', 'hi Ken', '2019-03-06', '0000-00-00 00:00:00', 'yes', 0),
(14, 'kenny', 'mercy', 'Hi to you Mercy', '2019-03-06', '0000-00-00 00:00:00', 'no', 0),
(15, 'neoboy', 'tommmy', 'yes', '2019-03-12', '0000-00-00 00:00:00', 'no', 0),
(16, 'neoboy', 'kenny', 'hello Ken', '2019-03-13', '0000-00-00 00:00:00', 'yes', 0),
(17, 'kenny', 'neoboy', 'yes bro', '2019-03-13', '0000-00-00 00:00:00', 'yes', 0),
(18, 'cutie', 'tommmy', 'Hello', '2019-04-04', '0000-00-00 00:00:00', 'no', 0),
(19, 'cutie', 'tommmy', 'Yes Cutie', '2019-04-04', '0000-00-00 00:00:00', 'no', 0),
(20, 'cutie', 'tommmy', 'How\'s U', '2019-04-04', '0000-00-00 00:00:00', 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `birthday` date NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `hometown` text NOT NULL,
  `sign_up_date` date NOT NULL,
  `activated` enum('0','1') NOT NULL,
  `confirmCode` int(11) NOT NULL DEFAULT '0',
  `blocked_user` enum('0','1') NOT NULL DEFAULT '0',
  `bio` text NOT NULL,
  `queote` text NOT NULL,
  `profile_pic` text NOT NULL,
  `cover_pic` text NOT NULL,
  `friend_array` text NOT NULL,
  `closed` varchar(3) NOT NULL DEFAULT 'no',
  `relationship` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `pub_email` varchar(255) NOT NULL,
  `company` text NOT NULL,
  `position` text NOT NULL,
  `school` text NOT NULL,
  `concentration` text NOT NULL,
  `nick_name` varchar(32) NOT NULL,
  `verify_id` varchar(3) NOT NULL DEFAULT 'no',
  `pass_question` text NOT NULL,
  `pass_ans` text NOT NULL,
  `chatOnlineTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `username`, `email`, `password`, `gender`, `birthday`, `country`, `city`, `hometown`, `sign_up_date`, `activated`, `confirmCode`, `blocked_user`, `bio`, `queote`, `profile_pic`, `cover_pic`, `friend_array`, `closed`, `relationship`, `mobile`, `pub_email`, `company`, `position`, `school`, `concentration`, `nick_name`, `verify_id`, `pass_question`, `pass_ans`, `chatOnlineTime`) VALUES
(68, 'One Neo', 'neoboy', 'odhiambothomas09@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '0000-00-00', 'Kenya', 'Kisumu', 'Nyakach', '2019-02-15', '1', 138898, '0', 'I am just a little living being who is much in love with code', 'The road of life is rocky and you may stumble too, so while you point your fingers somebody else is judging you', 'neoboy/1552581434.jpg', 'neoboy/1552849063.png', '', 'no', '', '0797049299', 'odhiambothomas09@gmail.com', 'Neo Hacker Group', 'CEO', '', '', '', 'no', '', '', '2019-04-04 19:03:05'),
(69, 'One Neo', 'osamab', 'cyberosama@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Male', '0000-00-00', '', '', '', '2019-02-15', '1', 0, '0', '', '', '', '', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-02-15 08:29:32'),
(70, 'One Neo', 'osamaq', 'josephoduor@gmail.com', '93656d3e8b20783e498522df4c0c7492', 'Male', '0000-00-00', '', '', '', '2019-02-15', '1', 0, '0', '', '', 'osamaq/1550219590.jpg', 'osamaq/1550221529.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-02-15 09:06:25'),
(71, 'One Neo', 'tommmy', 'cyberosam@gmail.com', '65f185ec6bd47af8f082f8196d0b4d24', 'Male', '0000-00-00', 'Kenya', 'Kisumu', 'Nyakach', '2019-02-19', '1', 0, '0', 'I am a young Kenyan Boy who is crazy about Tech', 'Ideas do not come out fully formed, they only become clearer as you continue working on them so you just need to get started', 'tommmy/1550579637.jpg', 'tommmy/1550579663.jpg', '', 'no', '', '0797049288', 'cyberosama@gmail.com', 'Neo Hacker Gropu', 'Head Of Hackers', '', '', '', 'no', '', '', '2019-02-19 16:44:11'),
(72, 'Ruto Mourine', 'cutie', 'cutie@gmail.com', '05f3672ba34409136aa71b8d00070d1b', 'Female', '0000-00-00', '', '', '', '2019-02-19', '1', 0, '0', '', '', 'cutie/1552395418.jpg', 'cutie/1551519687.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-04-18 07:33:58'),
(73, 'Ken Otieno', 'kenny', 'odhiambothomas@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '0000-00-00', '', '', '', '2019-03-01', '1', 0, '0', 'Iam a God fearing fellow', '', 'kenny/1552480058.png', 'kenny/1551439233.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-04-18 07:37:54'),
(74, 'Mercy Anyango', 'mercy', 'odhiambothomas0@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Female', '0000-00-00', '', '', '', '2019-03-01', '1', 0, '0', '', '', 'mercy/1551859084.jpg', 'mercy/1551859205.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-03-06 08:02:32'),
(75, 'Joseph Gabi', 'josephgabi', 'joseph3611975500@gmail.com', '670b14728ad9902aecba32e22fa4f6bd', 'Male', '0000-00-00', '', '', '', '2019-03-14', '1', 0, '0', '', '', 'josephgabi/1552581859.jpg', 'josephgabi/1552581876.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-03-15 15:07:10'),
(76, 'Odhiambo Thomas', 'pieretek', 'odhiambothomas12@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '0000-00-00', '', '', '', '2019-03-15', '1', 0, '0', '', '', 'pieretek/1552644470.jpg', 'pieretek/1552644516.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-03-15 14:57:21'),
(77, 'Suzzy Faith', 'suzzy', 'suzzy@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Female', '0000-00-00', '', '', '', '2019-03-17', '1', 0, '0', '', '', 'suzzy/1552829819.jpg', 'suzzy/1552829911.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-03-19 17:37:48'),
(78, 'Emmanuel', 'calmer9890', 'calmer9890@gmail.com', 'b3be681e399993726a64a4a99f1819f1', 'Male', '0000-00-00', '', '', '', '2019-03-20', '1', 0, '0', '', '', 'calmer9890/1553095584.jpg', 'calmer9890/1553095597.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-03-22 16:51:33'),
(79, 'Asca Kwamboka', 'ascakwamboka', 'asca@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Female', '0000-00-00', '', '', '', '2019-03-22', '1', 0, '0', '', '', '', '', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-03-26 17:33:28'),
(80, 'Mark Zuckerberg', 'markzuckerberg', 'markzuckerberg@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '0000-00-00', '', '', '', '2019-03-26', '1', 0, '0', 'Iam just a little brat who is so curious about Technology', 'The Road of life is Rocky and you may stumble too so while you point your finger somebody else is judging you.', 'markzuckerberg/1553621954.jpg', 'markzuckerberg/1553703267.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-03-28 17:25:53'),
(81, 'Mark Zuckerberg', 'mariko', 'mariko@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '0000-00-00', '', '', '', '2019-03-29', '1', 0, '0', '', '', '', '', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-03-29 06:39:45'),
(82, 'Tonny Tei', 'oscah', 'tonnytei4@gmail.com', 'eb20c9e46b4ca58b56c3c0ad33fc3b89', 'Male', '0000-00-00', '', '', '', '2019-04-07', '1', 0, '0', '', '', 'oscah/1554631182.jpg', 'oscah/1554631202.jpg', '', 'no', '', '', '', '', '', '', '', '', 'no', '', '', '2019-04-07 10:06:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharetime`
--
ALTER TABLE `sharetime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharetime_comments`
--
ALTER TABLE `sharetime_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_likes`
--
ALTER TABLE `share_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emoticons`
--
ALTER TABLE `emoticons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pvt_messages`
--
ALTER TABLE `pvt_messages`
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
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sharetime`
--
ALTER TABLE `sharetime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sharetime_comments`
--
ALTER TABLE `sharetime_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `share_likes`
--
ALTER TABLE `share_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emoticons`
--
ALTER TABLE `emoticons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pvt_messages`
--
ALTER TABLE `pvt_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
