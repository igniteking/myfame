-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 10:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myfame`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_description` text NOT NULL,
  `category_name` text DEFAULT NULL,
  `created_at` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_description`, `category_name`, `created_at`, `id`) VALUES
('instagram', 'Instagram', '2023-09-21 10:41:01', 1),
('', '', '2023-09-21 11:02:06', 2);

-- --------------------------------------------------------

--
-- Table structure for table `main_wallet`
--

CREATE TABLE `main_wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_wallet`
--

INSERT INTO `main_wallet` (`id`, `user_id`, `amount`) VALUES
(1, 1, '602'),
(2, 2, '200');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `package_name` text NOT NULL,
  `amount` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `code` text NOT NULL,
  `created_at` text NOT NULL,
  `link` text NOT NULL,
  `reward` text NOT NULL,
  `quantity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `category_name`, `package_name`, `amount`, `user_id`, `status`, `code`, `created_at`, `link`, `reward`, `quantity`) VALUES
(1, 'instagram', 'Follow', '10', 2, 1, '2207', '2023-09-25 02:36:14', 'zaidan.com', '100', '1000'),
(2, 'instagram', 'Follow', '10', 1, 1, '', '2023-09-25 02:36:50', 'zaidan.com', '1', '10'),
(3, 'instagram', 'Follow', '10', 2, 1, '2207', '2023-09-25 02:42:56', 'https://htmx.org/', '2', '20'),
(4, 'instagram', 'Follow', '10', 1, 1, '', '2023-09-26 23:29:45', 'zaidan.com', '10', '100');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_description` text NOT NULL,
  `package_name` text DEFAULT NULL,
  `created_at` text NOT NULL,
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` text NOT NULL,
  `min_quanitity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_description`, `package_name`, `created_at`, `id`, `category_id`, `amount`, `min_quanitity`) VALUES
('Gain a follower ', 'Follow', '2023-09-21 14:03:16', 1, 1, '10', ''),
(' Gain a view', 'NEW View', '2023-09-21 14:03:40', 2, 1, '20', '5'),
(' Gain a comment', 'Comment', '2023-09-21 14:04:02', 3, 2, '50', '');

-- --------------------------------------------------------

--
-- Table structure for table `refral_wallet`
--

CREATE TABLE `refral_wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refral_wallet`
--

INSERT INTO `refral_wallet` (`id`, `user_id`, `amount`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `created_at` text NOT NULL,
  `id` int(11) NOT NULL,
  `profile_picture` text NOT NULL,
  `user_email` text DEFAULT NULL,
  `user_name` text NOT NULL,
  `user_password` text NOT NULL,
  `user_type` text NOT NULL,
  `code` text NOT NULL,
  `mycode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`created_at`, `id`, `profile_picture`, `user_email`, `user_name`, `user_password`, `user_type`, `code`, `mycode`) VALUES
('2023-09-21 10:23:31', 1, '', 'khanzaidan786@gmail.com', 'Zaidan Khan', '$2y$10$AiRZLXVfPsWZlTuc0SRiUeoaJ04//uRoyP64if8OQN5iHLuYI4GBG', 'admin', '', 2207),
('2023-09-25 01:25:51', 2, '', 'ghufranarshad700@gmail.com', 'Ghufran Arshad', '$2y$10$Qg8HyErLgmPw2qb9bWMbGOpZkiLgDLCGwzp8CqPxOrjWZ5U1Zwtve', 'admin', '2207', 368);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `amount` text NOT NULL,
  `reference_id` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `amount`, `reference_id`, `user_id`, `created_at`, `status`) VALUES
(1, '10000', 'ZEE@123', 2, '2023-09-25 02:35:48', 'success'),
(2, '10000', '', 2, '2023-09-25 02:36:14', 'deducted'),
(3, '100', '', 1, '2023-09-25 02:36:25', 'bonus'),
(4, '100', '', 1, '2023-09-25 02:36:50', 'deducted'),
(5, '200', '', 2, '2023-09-25 02:42:56', 'deducted'),
(8, '1000', 'ZEE@123', 1, '2023-09-26 23:28:32', 'success'),
(9, '1000', '', 1, '2023-09-26 23:29:45', 'deducted'),
(10, '2', '', 1, '2023-09-27 00:09:06', 'bonus'),
(11, '2', '', 1, '2023-09-27 00:09:21', 'bonus');

-- --------------------------------------------------------

--
-- Table structure for table `widthrawl_request`
--

CREATE TABLE `widthrawl_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` text NOT NULL,
  `status` text NOT NULL,
  `created_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `widthrawl_request`
--

INSERT INTO `widthrawl_request` (`id`, `user_id`, `amount`, `status`, `created_at`) VALUES
(1, 1, '2', 'completed', '2023-09-27 00:46:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_wallet`
--
ALTER TABLE `main_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refral_wallet`
--
ALTER TABLE `refral_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widthrawl_request`
--
ALTER TABLE `widthrawl_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `main_wallet`
--
ALTER TABLE `main_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `refral_wallet`
--
ALTER TABLE `refral_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `widthrawl_request`
--
ALTER TABLE `widthrawl_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
