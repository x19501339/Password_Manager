-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 08:20 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `url`, `password`, `image`, `username`, `created_at`) VALUES
(2, 'saeedd', '123456', 'Screenshot 2023-04-01 203458.png', 'saeedd', '2023-04-23 19:12:49'),
(6, 'www.article.com', 'www.article.com', 'auto_full.cal.png', 'abc', '2023-04-25 01:43:05'),
(7, 'gmail.com', 'gmail.com', 'auto_full.cal.png', 'sadiss', '2023-04-25 11:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `otp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`, `otp`) VALUES
(1, 'chrisK', 'kingchristopher345@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', NULL),
(2, 'chrisK123', 'Christopher.king@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', NULL),
(3, 'chrisK23', 'ck@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user', NULL),
(4, 'chrisK', 'd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', NULL),
(5, '123456', '123456@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', NULL),
(6, '1234567', '1234567@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL),
(7, 'chrisK', '1334@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user', NULL),
(8, 'Test', 'Test@gmail.com', '0cbc6611f5540bd0809a388dc95a615b', 'admin', NULL),
(9, 'Test1', 'Test1@gmail.com', '0cbc6611f5540bd0809a388dc95a615b', 'user', NULL),
(10, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL),
(11, 'Chrisspam', 'chriskingspam2@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL),
(12, 'AdminChris', 'chriskingspam12@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL),
(13, 'test', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 'admin', NULL),
(14, 'saeed', 'saeed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
