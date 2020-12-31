-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 02:26 AM
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
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(200) NOT NULL,
  `consumer` int(100) NOT NULL,
  `service` int(100) NOT NULL,
  `message` text COLLATE utf8mb4_bin NOT NULL,
  `time` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `address` text COLLATE utf8mb4_bin NOT NULL,
  `approved` int(1) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `consumer`, `service`, `message`, `time`, `address`, `approved`, `modified`, `created`) VALUES
(9, 2, 13, 'sfghsfghsfghsfgh', '04:39--04:38', 'adfhadghadgha', 2, '2020-12-14 04:37:57', '2020-12-14 04:37:57'),
(10, 2, 13, 'sd fsd fsd fsdf sd fsd sd sd fsd fadf gad ghae5 harth a', '04:43--04:39', 'werfsfsdfd sdf sd sf sd f', 2, '2020-12-14 04:38:31', '2020-12-14 04:38:31'),
(11, 2, 13, 'ad gadf gadf gadfg adf gadfg', '04:41--04:40', 'af gadg adf', 2, '2020-12-14 04:38:37', '2020-12-14 04:38:37'),
(12, 2, 21, 's fghsf hsfh sfh h sf hg', '04:42--04:40', 'sfgh sfhsfg hsf hsf', 0, '2020-12-14 04:39:00', '2020-12-14 04:39:00'),
(13, 2, 13, 'Pabilis', '09:13--09:13', 'Susana', 2, '2020-12-14 08:13:26', '2020-12-14 08:13:26');

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `user_type` int(2) NOT NULL,
  `message` text COLLATE utf8mb4_bin NOT NULL,
  `book` int(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_type`, `message`, `book`, `created`) VALUES
(20, 1, 'Yes po?', 9, '2020-12-14 06:43:57'),
(21, 2, 'yung garden ko po', 9, '2020-12-14 06:44:34'),
(22, 1, 'o ano', 9, '2020-12-14 06:44:43'),
(23, 2, 'paayos po', 9, '2020-12-14 06:44:50'),
(24, 1, 'luh gagi', 9, '2020-12-14 06:44:59'),
(25, 2, 'bakit', 9, '2020-12-14 06:45:02'),
(26, 1, 'kaya mo na yan', 9, '2020-12-14 06:45:07'),
(27, 2, 'tae, nag post pa kayo ng service', 9, '2020-12-14 06:45:48'),
(28, 1, 'baket bawal?', 9, '2020-12-14 06:47:10'),
(29, 2, 'nice guys', 9, '2020-12-14 06:48:03'),
(30, 1, 'english english ka pa', 9, '2020-12-14 06:48:20'),
(31, 2, 'sungit mo po', 9, '2020-12-14 06:48:34'),
(32, 1, 'oo ', 9, '2020-12-14 06:52:18'),
(33, 2, 'okay!', 9, '2020-12-14 06:53:03'),
(34, 2, 'so ano', 9, '2020-12-14 06:53:17'),
(35, 1, 'sf hsfh sf h', 9, '2020-12-14 06:59:31'),
(36, 2, ' adfga', 9, '2020-12-14 06:59:38'),
(37, 1, 'sfg adf', 9, '2020-12-14 07:00:06'),
(38, 1, 's ghsfgh', 9, '2020-12-14 07:00:09'),
(39, 2, 'a gadf gafdg', 9, '2020-12-14 07:00:14'),
(40, 2, ' tyujgsd jgsdj', 9, '2020-12-14 07:00:30'),
(41, 2, 'sf ghsg hs hsf hsf hsfh sfh fh h fsg h', 9, '2020-12-14 07:00:53'),
(42, 2, 'g hsf hsh ', 9, '2020-12-14 07:00:54'),
(43, 2, 'fs hf hsfh s h', 9, '2020-12-14 07:00:55'),
(44, 2, 'h h sf hsfh sfh', 9, '2020-12-14 07:00:56'),
(45, 2, ' sf hsfg h', 9, '2020-12-14 07:00:57'),
(46, 2, ' sf hsfg h', 9, '2020-12-14 07:00:57'),
(47, 2, ' hsfhsf hsf', 9, '2020-12-14 07:00:58'),
(48, 2, 'sf hh', 9, '2020-12-14 07:00:59'),
(49, 2, 'sf hh', 9, '2020-12-14 07:00:59'),
(50, 2, ' sf hfs', 9, '2020-12-14 07:00:59'),
(51, 2, 'sfg hsfg h', 9, '2020-12-14 07:01:00'),
(52, 2, 'sfh sfgh ', 9, '2020-12-14 07:01:01'),
(53, 1, 'sfhsf h', 9, '2020-12-14 07:01:02'),
(54, 1, 'sfhsf h', 9, '2020-12-14 07:01:02'),
(55, 1, ' sfgh sfgh sfg hsfgh ', 9, '2020-12-14 07:01:03'),
(56, 1, 'sfg hsfg h', 9, '2020-12-14 07:01:04'),
(57, 1, 'gh sfgh sfg', 9, '2020-12-14 07:01:05'),
(58, 1, 'sfg hsfgh ', 9, '2020-12-14 07:01:06'),
(59, 1, 'sfh fg h', 9, '2020-12-14 07:01:06'),
(60, 2, 'sfgh hsfh ', 9, '2020-12-14 07:01:07'),
(61, 2, 'g hsfgh', 9, '2020-12-14 07:01:07'),
(62, 1, 'try', 9, '2020-12-14 07:04:37'),
(63, 1, ' fgadf ', 9, '2020-12-14 07:04:47'),
(64, 1, 'asd asd ', 9, '2020-12-14 07:07:08'),
(65, 1, 'asda sdas', 9, '2020-12-14 07:07:10'),
(66, 1, '[THIS BOOKING IS NOW ACCEPTED]', 9, '2020-12-14 07:32:32'),
(67, 1, 'okay na', 9, '2020-12-14 07:32:39'),
(68, 1, '[THIS BOOKING IS NOW DECLINED]', 9, '2020-12-14 07:33:20'),
(69, 1, '[THIS BOOKING IS NOW ACCEPTED]', 10, '2020-12-14 07:51:16'),
(70, 1, '[THIS BOOKING IS NOW ACCEPTED]', 11, '2020-12-14 07:52:01'),
(71, 1, 'ok', 9, '2020-12-14 07:56:06'),
(72, 1, 'ok', 9, '2020-12-14 07:56:19'),
(73, 1, 'ok', 9, '2020-12-14 07:56:21'),
(74, 1, 'kookoko', 9, '2020-12-14 07:56:23'),
(75, 1, 'kokokokokokokokoko', 9, '2020-12-14 07:56:26'),
(76, 1, 'ok ok', 13, '2020-12-14 08:14:42'),
(77, 2, 'dali na', 13, '2020-12-14 08:15:51'),
(78, 1, ' oko koko kok ok oko ', 13, '2020-12-14 08:16:23'),
(79, 1, '[THIS BOOKING IS NOW ACCEPTED]', 13, '2020-12-14 08:16:50'),
(80, 1, '[THIS BOOKING IS NOW DECLINED]', 13, '2020-12-14 08:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_type` int(11) NOT NULL,
  `company_name` varchar(200) COLLATE utf8mb4_bin NOT NULL,
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

INSERT INTO `providers` (`id`, `account_type`, `company_name`, `username`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `primary_category_id`, `modified`, `created`) VALUES
(8, 1, '', 'aira7', 'aira@aranas.com', 'pass1', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 19:18:58', '2020-12-10 19:18:58'),
(9, 1, '', 'aira8', 'aira@aranas.com', 'pass1', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 19:50:47', '2020-12-10 19:50:47'),
(10, 1, '', 'aira9', 'aira@aranas.com', 'pass', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 20:16:20', '2020-12-10 20:16:20'),
(11, 1, '', 'aira10', 'aira@aranas.com', '123', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 20:26:21', '2020-12-10 20:26:21'),
(12, 1, '', 'aira11', 'aira@aranas.com', '123123', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 21:14:40', '2020-12-10 21:14:40'),
(15, 1, '', 'aira14', 'aira@aranas.com', '123', 'Aira', 'Aranas', '1234567', 3, '2020-12-10 21:42:06', '2020-12-10 21:42:06'),
(16, 1, '', 'aira15', 'aira@aranas.com', '123', 'Aira', 'Aranas', '1234567', 1, '2020-12-10 22:36:36', '2020-12-10 22:36:36'),
(17, 1, '', 'aira', 'aira@aranas.com', '123', 'Aira', 'Aranas', '1234567', 1, '2020-12-13 22:16:10', '2020-12-13 22:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(100) NOT NULL,
  `category` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `details` text COLLATE utf8mb4_bin NOT NULL,
  `provider` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `availability` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category`, `status`, `title`, `details`, `provider`, `created`, `modified`, `availability`) VALUES
(13, 1, 1, 'Make your garden as beautiful as possible!', 'We have the tools to serve your garden. We also cater custom plants that you can buy from our store. We can\'t work with a loose backyard dog, I know you understand, that nobody wants to be bitten.', 15, '2020-12-13 15:00:47', '2020-12-13 15:00:47', '08:00--16:00'),
(14, 2, 1, 'Garden spray and sink!', 'We are not just gardening, we also fix pipes and sinks. We are professionally trained from the U.S. and ready to serve your home. We can\'t work with a loose backyard dog, I know you understand, that nobody wants to be bitten.', 15, '2020-12-13 15:04:51', '2020-12-13 15:04:51', '15:00--17:00'),
(15, 3, 1, 'Light up your nursery!', 'Your garden needs some lights in the night. So don\'t forget to contact us if you need some garden remodeling. We can\'t work with a loose backyard dog, I know you understand, that nobody wants to be bitten.', 15, '2020-12-13 15:05:00', '2020-12-13 15:05:00', '18:00--20:00'),
(16, 1, 1, 'Products for your garden.', 'Plants, seeds, soil, pot, and more! Don\'t hesitate to contact us 24 HOURS. It\'s free delivery! We can\'t work with a loose backyard dog, I know you understand, that nobody wants to be bitten.', 15, '2020-12-13 15:06:20', '2020-12-13 15:06:20', '24 HOURS'),
(21, 4, 1, 'Cookies Delivery', 'UNLAWFULLY DELICIOUS!!! Cookies buy now! Cookies buy now! Cookies buy now! Cookies buy now! Cookies buy now! Cookies buy now! Cookies buy now! ', 17, '2020-12-13 22:28:06', '2020-12-13 22:28:06', '06:00--18:00'),
(22, 1, 0, 'asdas dasd asd', 'sad asd asd sa', 15, '2020-12-14 09:10:31', '2020-12-14 09:10:31', '09:11--09:11'),
(23, 2, 0, 'sfgh sfghsf hfsg', 'h f hsfh ', 15, '2020-12-14 09:17:02', '2020-12-14 09:17:02', '24 HOURS'),
(24, 2, 0, 'sfgh sfgh sf ', 'hsfg hsfh sfg ', 15, '2020-12-14 09:19:02', '2020-12-14 09:19:02', '24 HOURS'),
(25, 2, 0, 'sfgh sfgh sf ', 'hsfg hsfh sfg ', 15, '2020-12-14 09:19:16', '2020-12-14 09:19:16', '24 HOURS'),
(26, 4, 0, 'adfg adfg ad', 'ad gadfg', 15, '2020-12-14 09:19:30', '2020-12-14 09:19:30', '24 HOURS'),
(27, 4, 0, 'adfg adfg ad', 'ad gadfg', 15, '2020-12-14 09:21:21', '2020-12-14 09:21:21', '24 HOURS'),
(28, 4, 0, 'adfg adfg ad', 'ad gadfg', 15, '2020-12-14 09:22:22', '2020-12-14 09:22:22', '24 HOURS'),
(29, 4, 0, 'adfg adfg ad', 'ad gadfg', 15, '2020-12-14 09:23:14', '2020-12-14 09:23:14', '24 HOURS'),
(30, 4, 0, 'adfg adfg ad', 'ad gadfg', 15, '2020-12-14 09:23:14', '2020-12-14 09:23:14', '24 HOURS'),
(31, 2, 0, 'sfghsfgh', 'sfghsfgh', 15, '2020-12-14 09:23:24', '2020-12-14 09:23:24', '24 HOURS'),
(32, 2, 0, 'aghafghaf', 'ghafghafgh', 15, '2020-12-14 09:25:05', '2020-12-14 09:25:05', '24 HOURS');

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
-- Indexes for table `consumers`
--
ALTER TABLE `consumers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
