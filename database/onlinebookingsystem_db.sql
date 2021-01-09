-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 05:17 PM
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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(50) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `owner` int(11) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
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
  `account_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `picture`, `created`, `modified`, `first_name`, `last_name`, `email`, `phone_number`, `account_type`) VALUES
(19, 'aira', '123', '', '2021-01-03 04:44:52', '2021-01-03 04:44:52', 'Aira', 'Aranas', 'aira@aranas.com', '+10901234567', 1),
(20, 'aira2', '123', '', '2021-01-03 05:00:01', '2021-01-03 05:00:01', 'Aira', 'Aranas', 'aira@aranas.com', '+10901234567', 0),
(21, 'aira3', '123', '', '2021-01-03 05:00:26', '2021-01-03 05:00:26', 'Aira', 'Aranas', 'aira@aranas.com', '+10901234567', 0),
(22, 'aira4', '123', '', '2021-01-03 05:01:49', '2021-01-03 05:01:49', 'Aira', 'Aranas', 'aira@aranas.com', '+10901234567', 1),
(23, 'aira5', '123', '', '2021-01-03 05:02:15', '2021-01-03 05:02:15', 'Aira', 'Aranas', 'aira@aranas.com', '+10901234567', 2),
(24, 'aira6', '123', '', '2021-01-03 05:02:29', '2021-01-03 05:02:29', 'Aira', 'Aranas', 'aira@aranas.com', '+10901234567', 1),
(25, 'aira7', '123', 'mich.jpg', '2021-01-03 05:21:56', '2021-01-03 05:21:56', 'Aira', 'Aranas', 'aira@aranas.com', '+10901234567', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
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
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
