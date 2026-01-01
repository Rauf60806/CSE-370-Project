-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2026 at 06:45 PM
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
-- Database: `cattle_managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `report_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `who` varchar(255) NOT NULL,
  `did_what` text NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`report_id`, `user_name`, `who`, `did_what`, `log_date`, `log_time`) VALUES
(43, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Sold 54', '2026-01-01', '16:49:06'),
(44, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Sold 56', '2026-01-01', '16:49:08'),
(45, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Added a new Cow (Weight: 63 kg, Gender: Female)', '2026-01-01', '16:50:20'),
(46, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Added a new Cow (Weight: 60 kg, Gender: Male)', '2026-01-01', '17:15:23'),
(47, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Sold Cattle 58', '2026-01-01', '17:15:34'),
(48, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Added a new Worker (ID: 8 kg, Contact: )', '2026-01-01', '17:16:00'),
(49, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 8', '2026-01-01', '17:16:09'),
(50, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Added a new Worker (ID: 9, Contact: )', '2026-01-01', '17:17:13'),
(51, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 9', '2026-01-01', '17:17:18'),
(52, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Added a new Worker (ID: 10, Contact: 96995683838)', '2026-01-01', '17:18:31'),
(53, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 10', '2026-01-01', '17:18:40'),
(54, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Added a new  (Quantity: 848777 (kg or L), Price: 1558)', '2026-01-01', '17:19:36'),
(55, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Added a new  (Quantity: 98499 (kg or L), Price: 99965)', '2026-01-01', '17:19:46'),
(56, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Sold Product 5', '2026-01-01', '17:19:53'),
(57, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Sold Product 6', '2026-01-01', '17:19:53'),
(58, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 501', '2026-01-01', '18:05:17'),
(59, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 502', '2026-01-01', '18:05:17'),
(60, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 503', '2026-01-01', '18:05:17'),
(61, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 504', '2026-01-01', '18:05:17'),
(62, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 505', '2026-01-01', '18:05:18'),
(63, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 506', '2026-01-01', '18:05:18'),
(64, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 507', '2026-01-01', '18:05:18'),
(65, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 508', '2026-01-01', '18:05:18'),
(66, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 509', '2026-01-01', '18:05:18'),
(67, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 510', '2026-01-01', '18:05:19'),
(68, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 4', '2026-01-01', '18:06:43'),
(69, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 5', '2026-01-01', '18:06:44'),
(70, 'Ahnaf Hossain Rauf', 'Ahnaf Hossain Rauf', 'Removed Worker 4', '2026-01-01', '18:06:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `dashboard_panel` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
