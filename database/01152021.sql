-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2021 at 01:02 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new_onlinebookingsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE IF NOT EXISTS `account_types` (
`id` int(1) NOT NULL,
  `account_type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `account_type`) VALUES
(1, 'Individual'),
(2, 'Corporate');

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE IF NOT EXISTS `booking_status` (
`id` int(2) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `color` varchar(50) NOT NULL,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_status`
--

INSERT INTO `booking_status` (`id`, `status`, `created`, `modified`, `color`, `action`) VALUES
(1, 'For Approval', '2021-01-11 22:00:13', '2021-01-11 22:00:13', 'warning', 'Approve Booking'),
(2, 'Booking Approved', '2021-01-11 22:00:13', '2021-01-11 22:00:13', 'info', 'Work Done'),
(3, 'Successful Business', '2021-01-13 11:52:08', '2021-01-13 11:52:08', 'success', 'Book Closed'),
(4, 'Canceled. Explanation required', '2021-01-13 11:54:34', '2021-01-13 11:54:34', 'danger', 'This Book was Canceled.'),
(5, 'Canceled. Explanation Denied', '2021-01-13 11:59:33', '2021-01-13 11:59:33', 'danger', 'Canceled and Denied Explanation.'),
(6, 'Canceled. Explanation Accepted', '2021-01-13 12:32:28', '2021-01-13 12:32:28', 'success', 'Canceled but Accepted Explanation.'),
(7, 'Reported!', '2021-01-13 12:36:50', '2021-01-13 12:36:50', 'danger', 'This book has a history.');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
`id` int(200) NOT NULL,
  `service` int(100) NOT NULL,
  `consumer` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `date_time_from_to` varchar(100) NOT NULL,
  `rating` int(1) DEFAULT '0',
  `rating_to_consumer` int(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `service`, `consumer`, `created`, `modified`, `status`, `date_time_from_to`, `rating`, `rating_to_consumer`) VALUES
(49, 30, 53, '2021-01-15 01:09:46', '2021-01-15 01:09:46', 7, '2021-01-20---10:00-------2021-01-20---23:00', 0, -5),
(50, 30, 53, '2021-01-15 01:15:26', '2021-01-15 01:15:26', 7, '2021-12-12---15:15-------2021-12-12---16:15', -5, 5),
(51, 31, 58, '2021-01-15 02:13:51', '2021-01-15 02:13:51', 3, '2021-01-20---08:13-------2021-01-20---10:13', 5, 3),
(52, 31, 53, '2021-01-15 02:58:27', '2021-01-15 02:58:27', 3, '2021-01-16---08:30-------2021-01-16---09:30', 5, 5),
(53, 31, 53, '2021-01-15 03:14:38', '2021-01-15 03:14:38', 7, '2021-01-17---09:30-------2021-01-21---00:29', 0, -5),
(54, 31, 53, '2021-01-15 17:53:02', '2021-01-15 17:53:02', 3, '2021-01-22---23:52-------2021-01-22---12:52', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(3) NOT NULL,
  `category` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `picture` varchar(300) NOT NULL,
  `picture_position` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created`, `modified`, `picture`, `picture_position`) VALUES
(6, 'Plumbing', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'plumbing.jpg', ''),
(7, 'Electrical', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'electrician.jpg', ''),
(8, 'Laundry', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'laundry.jpeg', ''),
(9, 'Roof repair', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'roof.jpg', ''),
(10, 'Gardening', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'gardening.jpg', 'bottom center'),
(11, 'Floor', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'floor.jpg', ''),
(12, 'Painter', '2021-01-15 17:21:17', '2021-01-15 17:21:17', 'painters.jpeg', 'bottom center'),
(13, 'Cleaners', '2021-01-14 13:42:17', '2021-01-14 13:42:17', 'cleaning.jpeg', 'bottom center');

-- --------------------------------------------------------

--
-- Table structure for table `definitions`
--

CREATE TABLE IF NOT EXISTS `definitions` (
`id` int(2) NOT NULL,
  `definition` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `definitions`
--

INSERT INTO `definitions` (`id`, `definition`, `created`, `modified`) VALUES
(1, 'provider', '2021-01-05 17:38:30', '2021-01-05 17:38:30'),
(2, 'consumer', '2021-01-05 17:38:30', '2021-01-05 17:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL,
  `booking` int(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `seen` int(1) NOT NULL DEFAULT '0',
  `status_update` int(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=694 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender`, `booking`, `created`, `modified`, `seen`, `status_update`) VALUES
(639, 'pa ayos garden ko----------2021-01-20---10:00-------2021-01-20---23:00', 53, 49, '2021-01-15 01:09:46', '2021-01-15 01:09:46', 1, 0),
(640, '1', 53, 49, '2021-01-15 01:09:46', '2021-01-15 01:09:46', 1, 1),
(641, 'location po?', 54, 49, '2021-01-15 01:11:38', '2021-01-15 01:11:38', 1, 0),
(642, 'sto tomas lang', 53, 49, '2021-01-15 01:12:04', '2021-01-15 01:12:04', 1, 0),
(643, '2', 54, 49, '2021-01-15 01:12:17', '2021-01-15 01:12:17', 1, 1),
(644, 'dadasdadd----------2021-12-12---15:15-------2021-12-12---16:15', 53, 50, '2021-01-15 01:15:26', '2021-01-15 01:15:26', 1, 0),
(645, '1', 53, 50, '2021-01-15 01:15:26', '2021-01-15 01:15:26', 1, 1),
(646, 'hey', 53, 50, '2021-01-15 01:15:39', '2021-01-15 01:15:39', 1, 0),
(647, 'hey', 54, 50, '2021-01-15 01:15:59', '2021-01-15 01:15:59', 1, 0),
(648, '2', 54, 50, '2021-01-15 01:16:05', '2021-01-15 01:16:05', 1, 1),
(649, '3', 54, 50, '2021-01-15 01:17:49', '2021-01-15 01:17:49', 1, 1),
(650, '5=======Service', 54, 50, '2021-01-15 01:17:54', '2021-01-15 01:17:54', 1, 0),
(651, 'report+++++++provider', 53, 50, '2021-01-15 01:18:12', '2021-01-15 01:18:12', 1, 0),
(652, 'I need help to fix in our house----------2021-01-20---08:13-------2021-01-20---10:13', 58, 51, '2021-01-15 02:13:51', '2021-01-15 02:13:51', 1, 0),
(653, '1', 58, 51, '2021-01-15 02:13:51', '2021-01-15 02:13:51', 1, 1),
(654, 'location?', 54, 51, '2021-01-15 02:14:21', '2021-01-15 02:14:21', 1, 0),
(655, 'malaban', 58, 51, '2021-01-15 02:14:45', '2021-01-15 02:14:45', 1, 0),
(656, '2', 54, 51, '2021-01-15 02:14:53', '2021-01-15 02:14:53', 1, 1),
(657, 'Thank you!\\', 58, 51, '2021-01-15 02:15:05', '2021-01-15 02:15:05', 1, 0),
(658, '3', 54, 51, '2021-01-15 02:15:06', '2021-01-15 02:15:06', 1, 1),
(659, '3=======Service', 54, 51, '2021-01-15 02:15:10', '2021-01-15 02:15:10', 1, 0),
(660, '1=======Service', 58, 51, '2021-01-15 02:15:24', '2021-01-15 02:15:24', 1, 0),
(661, '5=======Service', 58, 51, '2021-01-15 02:15:27', '2021-01-15 02:15:27', 1, 0),
(662, '1=======Service', 58, 51, '2021-01-15 02:15:28', '2021-01-15 02:15:28', 1, 0),
(663, '1=======Service', 58, 51, '2021-01-15 02:15:29', '2021-01-15 02:15:29', 1, 0),
(664, '5=======Service', 58, 51, '2021-01-15 02:15:31', '2021-01-15 02:15:31', 1, 0),
(665, '3', 54, 49, '2021-01-15 02:16:32', '2021-01-15 02:16:32', 1, 1),
(666, 'report+++++++consumer', 54, 49, '2021-01-15 02:16:34', '2021-01-15 02:16:34', 1, 0),
(667, 'Hi----------2021-01-16---08:30-------2021-01-16---09:30', 53, 52, '2021-01-15 02:58:27', '2021-01-15 02:58:27', 1, 0),
(668, '1', 53, 52, '2021-01-15 02:58:27', '2021-01-15 02:58:27', 1, 1),
(669, 'Hi', 53, 52, '2021-01-15 02:58:34', '2021-01-15 02:58:34', 1, 0),
(670, 'Hello', 54, 52, '2021-01-15 02:59:09', '2021-01-15 02:59:09', 1, 0),
(671, 'Pabook ako', 53, 52, '2021-01-15 02:59:31', '2021-01-15 02:59:31', 1, 0),
(672, 'ok', 54, 52, '2021-01-15 02:59:45', '2021-01-15 02:59:45', 1, 0),
(673, '2', 54, 52, '2021-01-15 02:59:49', '2021-01-15 02:59:49', 1, 1),
(674, 'otw na po', 54, 52, '2021-01-15 03:00:09', '2021-01-15 03:00:09', 1, 0),
(675, 'done na pi', 54, 52, '2021-01-15 03:00:13', '2021-01-15 03:00:13', 1, 0),
(676, 'thank you', 53, 52, '2021-01-15 03:00:23', '2021-01-15 03:00:23', 1, 0),
(677, '3', 54, 52, '2021-01-15 03:00:26', '2021-01-15 03:00:26', 1, 1),
(678, '5=======Service', 54, 52, '2021-01-15 03:00:32', '2021-01-15 03:00:32', 1, 0),
(679, '5=======Service', 53, 52, '2021-01-15 03:00:38', '2021-01-15 03:00:38', 1, 0),
(680, 'pabook ako----------2021-01-17---09:30-------2021-01-21---00:29', 53, 53, '2021-01-15 03:14:38', '2021-01-15 03:14:38', 1, 0),
(681, '1', 53, 53, '2021-01-15 03:14:38', '2021-01-15 03:14:38', 1, 1),
(682, '2', 54, 53, '2021-01-15 03:15:25', '2021-01-15 03:15:25', 1, 1),
(683, 'HI', 53, 53, '2021-01-15 15:18:12', '2021-01-15 15:18:12', 1, 0),
(684, 'sADAdDD', 53, 53, '2021-01-15 15:38:50', '2021-01-15 15:38:50', 1, 0),
(685, 'DASDASDD', 54, 53, '2021-01-15 15:39:19', '2021-01-15 15:39:19', 1, 0),
(686, '3', 54, 53, '2021-01-15 17:51:54', '2021-01-15 17:51:54', 1, 1),
(687, 'report+++++++consumer', 54, 53, '2021-01-15 17:51:57', '2021-01-15 17:51:57', 1, 0),
(688, 'hi----------2021-01-22---23:52-------2021-01-22---12:52', 53, 54, '2021-01-15 17:53:02', '2021-01-15 17:53:02', 1, 0),
(689, '1', 53, 54, '2021-01-15 17:53:02', '2021-01-15 17:53:02', 1, 1),
(690, '2', 54, 54, '2021-01-15 17:53:18', '2021-01-15 17:53:18', 1, 1),
(691, '3', 54, 54, '2021-01-15 17:53:19', '2021-01-15 17:53:19', 1, 1),
(692, '5=======Service', 54, 54, '2021-01-15 17:53:27', '2021-01-15 17:53:27', 1, 0),
(693, '5=======Service', 53, 54, '2021-01-15 17:53:37', '2021-01-15 17:53:37', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
`id` int(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `owner` int(11) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `category` int(4) NOT NULL,
  `availability` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `owner`, `description`, `created`, `modified`, `category`, `availability`) VALUES
(30, 'GARDEN BOY', 54, 'Book with us now!', '2021-01-15 00:55:44', '2021-01-15 00:55:44', 10, '8:00 AM-8:30 AM--1,2,3,4,5,6---6:00 AM-6:00 AM--'),
(31, 'Electrical', 54, 'We fix!', '2021-01-15 01:17:30', '2021-01-15 01:17:30', 7, '6:00 AM-6:00 AM--1,2,3'),
(32, 'Painter ', 57, 'I will paint ur house', '2021-01-15 02:07:53', '2021-01-15 02:07:53', 12, '10:00 AM-5:00 PM--1,3,5'),
(33, 'House Cleaning', 57, 'Hi This is House Cleaning. Book with us now! For more info. send as a message', '2021-01-15 02:21:18', '2021-01-15 02:21:18', 13, '5:00 AM-5:00 PM--1,3,5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `account_type` int(1) NOT NULL,
  `primary_category` int(3) NOT NULL DEFAULT '1',
  `definition` int(1) NOT NULL,
  `online_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `picture`, `created`, `modified`, `first_name`, `last_name`, `email`, `phone_number`, `account_type`, `primary_category`, `definition`, `online_status`) VALUES
(53, 'airamaeay', '123', '/.jpg', '2021-01-15 00:35:07', '2021-01-15 00:35:07', 'Aira', 'Aranas', 'airamaearanas@gmail.com', '09260651336', 0, 0, 2, 0),
(54, 'miamore', '1234', '/.jpg', '2021-01-15 00:54:06', '2021-01-15 00:54:06', 'Mi ', 'Amor', 'gummybabe07@gmail.com', '09996761977', 1, 10, 1, 1),
(55, 'aj', 'qwerty', '/.jpg', '2021-01-15 01:23:08', '2021-01-15 01:23:08', 'Arce', 'Jay', 'arce@gmail.com', '0912655162', 0, 0, 2, 0),
(56, 'ellapot', 'ella', '/.jpg', '2021-01-15 01:45:50', '2021-01-15 01:45:50', 'Ella', 'Aranas', 'airamaearanas@gmail.com', '09172339102', 0, 0, 2, 0),
(57, 'painterist', 'paint', '/.png', '2021-01-15 02:05:07', '2021-01-15 02:05:07', 'Mateo', 'G', 'painterist@gmail.com', '09228198871', 1, 12, 1, 0),
(58, 'yeyel', 'yel', '/.jpg', '2021-01-15 02:06:57', '2021-01-15 02:06:57', 'Ariel', 'Aranas', 'ariellynaranas@gmail.com', '092176153101', 0, 0, 2, 0),
(59, 'miyoung', 'cat', '29470520/83536987.png', '2021-01-15 13:36:11', '2021-01-15 13:36:11', 'Mi', 'Young', 'miyoung@gmail.com', '0922653711', 0, 0, 2, 0),
(60, 'mel', 'mel', '33013610/28171386.jpg', '2021-01-15 18:11:35', '2021-01-15 18:11:35', 'Mel', 'Aranas', 'melaranas@gmail.com', '091227131', 0, 0, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `definitions`
--
ALTER TABLE `definitions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
MODIFY `id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `definitions`
--
ALTER TABLE `definitions`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=694;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
