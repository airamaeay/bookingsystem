-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 04:26 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinebookingsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(1) NOT NULL,
  `account_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `booking_status` (
  `id` int(2) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `color` varchar(50) NOT NULL,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `books` (
  `id` int(200) NOT NULL,
  `service` int(100) NOT NULL,
  `consumer` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `date_time_from_to` varchar(100) NOT NULL,
  `rating` int(1) DEFAULT 0,
  `rating_to_consumer` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(3) NOT NULL,
  `category` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `picture` varchar(300) NOT NULL,
  `picture_position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created`, `modified`, `picture`, `picture_position`) VALUES
(6, 'plumbing', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'plumbing.jpg', ''),
(7, 'electrical', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'electrical.jpg', ''),
(8, 'food', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'food.jpg', ''),
(9, 'roof', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'roof.jpg', ''),
(10, 'gardening', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'gardening.jpg', 'bottom center'),
(11, 'floor', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'floor.jpg', ''),
(12, 'wastes', '2021-01-05 17:21:17', '2021-01-05 17:21:17', 'wastes.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `definitions`
--

CREATE TABLE `definitions` (
  `id` int(2) NOT NULL,
  `definition` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL,
  `booking` int(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `seen` int(1) NOT NULL DEFAULT 0,
  `status_update` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `owner` int(11) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `category` int(4) NOT NULL,
  `availability` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
  `primary_category` int(3) NOT NULL DEFAULT 1,
  `definition` int(1) NOT NULL,
  `online_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `definitions`
--
ALTER TABLE `definitions`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
