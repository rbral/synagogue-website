-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2026 at 04:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shul_flow`
--

-- --------------------------------------------------------

--
-- Table structure for table `membership_type`
--

CREATE TABLE `membership_type` (
  `membership_type_id` int(11) NOT NULL,
  `membership_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_type`
--

INSERT INTO `membership_type` (`membership_type_id`, `membership_type_name`) VALUES
(2, 'Family'),
(1, 'Individual');

-- --------------------------------------------------------

--
-- Table structure for table `nusach_type`
--

CREATE TABLE `nusach_type` (
  `nusach_id` int(11) NOT NULL,
  `nusach_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nusach_type`
--

INSERT INTO `nusach_type` (`nusach_id`, `nusach_name`) VALUES
(2, 'Ashkenaz'),
(1, 'Edot HaMizrach'),
(3, 'Sefard');

-- --------------------------------------------------------

--
-- Table structure for table `pledges`
--

CREATE TABLE `pledges` (
  `pledge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pledge_status`
--

CREATE TABLE `pledge_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pledge_status`
--

INSERT INTO `pledge_status` (`status_id`, `status_name`) VALUES
(3, 'Canceled'),
(2, 'Paid'),
(1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `membership_type_id` int(11) DEFAULT NULL,
  `nusach_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `tel`, `password_hash`, `role_id`, `membership_type_id`, `nusach_id`) VALUES
(1, 'Rivka', 'Aharoni', 'rivka@example.com', '000000000', '$2y$10$qRzc1GA5RFfGN7Sxs0AXROpPyHi4UL6RMvIC64Jxhx76xur4ihg32', 2, NULL, NULL),
(9, 'Sarah', 'Cohen', 'sarah@example.com', '1111111111', '$2y$10$yY1ixwYtIygYNSSZW4f.fuSB2gpYo/Wcqln8ikf/Y/Qw0hiMK7LqC', 2, NULL, NULL),
(10, 'Admin', 'Test', 'admin@example.com', '2222222222', '$2y$10$LiNtieoVjPwq5X3SewPGgO6pikZvrZ/eOTrjMMyxljiLPFs0V.uEu', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `membership_type`
--
ALTER TABLE `membership_type`
  ADD PRIMARY KEY (`membership_type_id`),
  ADD UNIQUE KEY `membership_type_name` (`membership_type_name`);

--
-- Indexes for table `nusach_type`
--
ALTER TABLE `nusach_type`
  ADD PRIMARY KEY (`nusach_id`),
  ADD UNIQUE KEY `nusach_name` (`nusach_name`);

--
-- Indexes for table `pledges`
--
ALTER TABLE `pledges`
  ADD PRIMARY KEY (`pledge_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `status` (`status_id`);

--
-- Indexes for table `pledge_status`
--
ALTER TABLE `pledge_status`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status_name` (`status_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `membership_type_id` (`membership_type_id`),
  ADD KEY `nusach_id` (`nusach_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membership_type`
--
ALTER TABLE `membership_type`
  MODIFY `membership_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nusach_type`
--
ALTER TABLE `nusach_type`
  MODIFY `nusach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pledges`
--
ALTER TABLE `pledges`
  MODIFY `pledge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pledge_status`
--
ALTER TABLE `pledge_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pledges`
--
ALTER TABLE `pledges`
  ADD CONSTRAINT `pledges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `pledges_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `pledge_status` (`status_id`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `user_info_ibfk_2` FOREIGN KEY (`membership_type_id`) REFERENCES `membership_type` (`membership_type_id`),
  ADD CONSTRAINT `user_info_ibfk_3` FOREIGN KEY (`nusach_id`) REFERENCES `nusach_type` (`nusach_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
