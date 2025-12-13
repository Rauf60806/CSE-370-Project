-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2025 at 02:33 PM
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
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `access_key` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `contract_duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buys`
--

CREATE TABLE `buys` (
  `customer_id` int(11) NOT NULL,
  `cattle_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `buy_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cattle`
--

CREATE TABLE `cattle` (
  `cattle_id` int(11) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `weight` decimal(6,2) DEFAULT NULL,
  `cattle_type` enum('Cow','Goat','Sheep') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cow`
--

CREATE TABLE `cow` (
  `cattle_id` int(11) NOT NULL,
  `cow_breed` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `receipt_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_panel`
--

CREATE TABLE `dashboard_panel` (
  `login_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `worker_id` int(11) NOT NULL,
  `experience` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farm_owner`
--

CREATE TABLE `farm_owner` (
  `registration_id` int(11) NOT NULL,
  `Farm_name` varchar(100) DEFAULT NULL,
  `farm_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goat`
--

CREATE TABLE `goat` (
  `cattle_id` int(11) NOT NULL,
  `goat_breed` varchar(100) DEFAULT NULL,
  `beard_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `purchase_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `report_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meat`
--

CREATE TABLE `meat` (
  `product_id` int(11) NOT NULL,
  `meat_area` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_record`
--

CREATE TABLE `medical_record` (
  `record_id` int(11) NOT NULL,
  `cattle_id` int(11) DEFAULT NULL,
  `pregnancy` tinyint(1) DEFAULT NULL,
  `doctor_name` varchar(100) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `vaccine` varchar(100) DEFAULT NULL,
  `injury` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `milk`
--

CREATE TABLE `milk` (
  `product_id` int(11) NOT NULL,
  `fat_per` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produces`
--

CREATE TABLE `produces` (
  `cattle_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `production_date` date DEFAULT NULL,
  `cattle_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `registration_id` int(11) NOT NULL,
  `access_key` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `weight_tracking` tinyint(1) DEFAULT NULL,
  `bath_cleaning_report` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sheep`
--

CREATE TABLE `sheep` (
  `cattle_id` int(11) NOT NULL,
  `wool_color` varchar(50) DEFAULT NULL,
  `wool_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supervises`
--

CREATE TABLE `supervises` (
  `registration_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `purchase_id` int(11) NOT NULL,
  `supplies` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveillance`
--

CREATE TABLE `surveillance` (
  `surveillance_id` int(11) NOT NULL,
  `cattle_id` int(11) NOT NULL,
  `camera_id` varchar(50) NOT NULL,
  `camera_feed_url` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `captured_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveillance_access`
--

CREATE TABLE `surveillance_access` (
  `surveillance_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `takes_care`
--

CREATE TABLE `takes_care` (
  `cattle_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wool`
--

CREATE TABLE `wool` (
  `product_id` int(11) NOT NULL,
  `fiber_type` varchar(50) DEFAULT NULL,
  `wool_color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `worker_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `work_hour` int(11) DEFAULT NULL,
  `access_key` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`access_key`);

--
-- Indexes for table `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`customer_id`,`product_id`),
  ADD KEY `cattle_id` (`cattle_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cattle`
--
ALTER TABLE `cattle`
  ADD PRIMARY KEY (`cattle_id`);

--
-- Indexes for table `cow`
--
ALTER TABLE `cow`
  ADD PRIMARY KEY (`cattle_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `dashboard_panel`
--
ALTER TABLE `dashboard_panel`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`worker_id`);

--
-- Indexes for table `farm_owner`
--
ALTER TABLE `farm_owner`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `goat`
--
ALTER TABLE `goat`
  ADD PRIMARY KEY (`cattle_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`report_id`,`login_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `meat`
--
ALTER TABLE `meat`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `cattle_id` (`cattle_id`);

--
-- Indexes for table `milk`
--
ALTER TABLE `milk`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `produces`
--
ALTER TABLE `produces`
  ADD PRIMARY KEY (`cattle_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cattle_id` (`cattle_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`registration_id`,`access_key`),
  ADD KEY `access_key` (`access_key`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `sheep`
--
ALTER TABLE `sheep`
  ADD PRIMARY KEY (`cattle_id`);

--
-- Indexes for table `supervises`
--
ALTER TABLE `supervises`
  ADD PRIMARY KEY (`registration_id`,`worker_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `surveillance`
--
ALTER TABLE `surveillance`
  ADD PRIMARY KEY (`surveillance_id`),
  ADD KEY `cattle_id` (`cattle_id`);

--
-- Indexes for table `surveillance_access`
--
ALTER TABLE `surveillance_access`
  ADD PRIMARY KEY (`surveillance_id`,`login_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `takes_care`
--
ALTER TABLE `takes_care`
  ADD PRIMARY KEY (`cattle_id`,`worker_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `wool`
--
ALTER TABLE `wool`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`worker_id`),
  ADD KEY `access_key` (`access_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `access_key` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cattle`
--
ALTER TABLE `cattle`
  MODIFY `cattle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboard_panel`
--
ALTER TABLE `dashboard_panel`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farm_owner`
--
ALTER TABLE `farm_owner`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveillance`
--
ALTER TABLE `surveillance`
  MODIFY `surveillance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buys`
--
ALTER TABLE `buys`
  ADD CONSTRAINT `buys_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `buys_ibfk_2` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`),
  ADD CONSTRAINT `buys_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `cow`
--
ALTER TABLE `cow`
  ADD CONSTRAINT `cow_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`);

--
-- Constraints for table `goat`
--
ALTER TABLE `goat`
  ADD CONSTRAINT `goat_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`purchase_id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `report` (`report_id`),
  ADD CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`login_id`) REFERENCES `dashboard_panel` (`login_id`);

--
-- Constraints for table `meat`
--
ALTER TABLE `meat`
  ADD CONSTRAINT `meat_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD CONSTRAINT `medical_record_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`);

--
-- Constraints for table `milk`
--
ALTER TABLE `milk`
  ADD CONSTRAINT `milk_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `produces`
--
ALTER TABLE `produces`
  ADD CONSTRAINT `produces_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`),
  ADD CONSTRAINT `produces_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `dashboard_panel` (`login_id`);

--
-- Constraints for table `registers`
--
ALTER TABLE `registers`
  ADD CONSTRAINT `registers_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `farm_owner` (`registration_id`),
  ADD CONSTRAINT `registers_ibfk_2` FOREIGN KEY (`access_key`) REFERENCES `admin_panel` (`access_key`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`);

--
-- Constraints for table `sheep`
--
ALTER TABLE `sheep`
  ADD CONSTRAINT `sheep_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`);

--
-- Constraints for table `supervises`
--
ALTER TABLE `supervises`
  ADD CONSTRAINT `supervises_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `farm_owner` (`registration_id`),
  ADD CONSTRAINT `supervises_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`);

--
-- Constraints for table `supplies`
--
ALTER TABLE `supplies`
  ADD CONSTRAINT `supplies_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`purchase_id`);

--
-- Constraints for table `surveillance`
--
ALTER TABLE `surveillance`
  ADD CONSTRAINT `surveillance_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`);

--
-- Constraints for table `surveillance_access`
--
ALTER TABLE `surveillance_access`
  ADD CONSTRAINT `surveillance_access_ibfk_1` FOREIGN KEY (`surveillance_id`) REFERENCES `surveillance` (`surveillance_id`),
  ADD CONSTRAINT `surveillance_access_ibfk_2` FOREIGN KEY (`login_id`) REFERENCES `dashboard_panel` (`login_id`);

--
-- Constraints for table `takes_care`
--
ALTER TABLE `takes_care`
  ADD CONSTRAINT `takes_care_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`),
  ADD CONSTRAINT `takes_care_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`);

--
-- Constraints for table `wool`
--
ALTER TABLE `wool`
  ADD CONSTRAINT `wool_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `worker`
--
ALTER TABLE `worker`
  ADD CONSTRAINT `worker_ibfk_1` FOREIGN KEY (`access_key`) REFERENCES `admin_panel` (`access_key`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
