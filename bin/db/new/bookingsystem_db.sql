-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 03:46 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookingsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `account_type`) VALUES
(1, 'Individual'),
(2, 'Corporate');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `photo` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `photo`, `created`, `modified`) VALUES
(1, 'Gardening', '/images/categories/gardening.jpg', '2020-12-10 17:18:19', '2020-12-10 17:18:19'),
(2, 'Plumbing', '/images/categories/plumbing.jpg', '2020-12-10 17:18:19', '2020-12-10 17:18:19'),
(3, 'Electrician', '/images/categories/electrician.jpg', '2020-12-10 17:18:19', '2020-12-10 17:18:19'),
(4, 'Food', '/images/categories/food.jpg', '2020-12-10 17:18:19', '2020-12-10 17:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `consumers`
--

CREATE TABLE `consumers` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `phone_number` int(50) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `consumers`
--

INSERT INTO `consumers` (`id`, `username`, `first_name`, `last_name`, `phone_number`, `email`, `password`, `modified`, `created`) VALUES
(2, 'aira', 'Aira', 'Aranas', 1234567, 'aira@aranas.com', 123, '2020-12-10 21:49:17', '2020-12-10 21:49:17'),
(3, 'aira2', 'Aira', 'Aranas', 1234567, 'aira@aranas.com', 123, '2020-12-10 21:51:54', '2020-12-10 21:51:54'),
(4, 'aira3', 'Aira', 'Aranas', 1234567, 'aira@aranas.com', 123, '2020-12-10 21:53:07', '2020-12-10 21:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_type` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `primary_category_id` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `account_type`, `username`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `primary_category_id`, `modified`, `created`) VALUES
(8, 1, 'aira7', 'aira@aranas.com', 'pass1', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 19:18:58', '2020-12-10 19:18:58'),
(9, 1, 'aira8', 'aira@aranas.com', 'pass1', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 19:50:47', '2020-12-10 19:50:47'),
(10, 1, 'aira9', 'aira@aranas.com', 'pass', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 20:16:20', '2020-12-10 20:16:20'),
(11, 1, 'aira10', 'aira@aranas.com', '123', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 20:26:21', '2020-12-10 20:26:21'),
(12, 1, 'aira11', 'aira@aranas.com', '123123', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 21:14:40', '2020-12-10 21:14:40'),
(15, 1, 'aira14', 'aira@aranas.com', '123', 'Aira', 'Aranas', '1234567', 3, '2020-12-10 21:42:06', '2020-12-10 21:42:06'),
(16, 1, 'aira15', 'aira@aranas.com', '123', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 22:36:36', '2020-12-10 22:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `access_type` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `username`, `password`, `access_type`, `modified`, `created`) VALUES
(1, 'aira', 'pass1', 1, '2020-12-07 20:59:57', '2020-12-07 20:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(2) NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`) VALUES
(1, 'provider'),
(2, 'consumer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumers`
--
ALTER TABLE `consumers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `consumers`
--
ALTER TABLE `consumers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
