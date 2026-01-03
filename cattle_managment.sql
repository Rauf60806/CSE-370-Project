-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2026 at 10:20 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `cattle`
--

CREATE TABLE `cattle` (
  `cattle_id` int(11) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `weight` decimal(6,2) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `cattle_type` enum('Cow','Goat','Sheep') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cattle`
--

INSERT INTO `cattle` (`cattle_id`, `age`, `gender`, `weight`, `price`, `cattle_type`) VALUES
(25, 10, 'Male', 100.00, 0, 'Cow'),
(26, 12, 'Male', 100.00, 0, 'Cow'),
(27, 14, 'Male', 100.00, 0, 'Cow'),
(28, 10, 'Male', 200.00, 0, 'Cow'),
(29, 10, 'Male', 150.00, 0, 'Cow'),
(30, 8, 'Male', 175.00, 0, 'Cow'),
(31, 10, 'Male', 50.00, 0, 'Cow'),
(32, 10, 'Male', 50.00, 0, 'Cow'),
(33, 10, 'Male', 50.00, 0, 'Goat'),
(34, 45, 'Male', 40.00, 0, 'Goat'),
(35, 5, 'Male', 20.00, 0, 'Sheep'),
(36, 6, 'Male', 25.00, 0, 'Sheep'),
(37, 7, 'Male', 30.00, 0, 'Sheep'),
(38, 8, 'Female', 40.00, 0, 'Sheep'),
(39, 6, 'Male', 10.00, 0, 'Sheep'),
(40, 10, 'Female', 40.00, 0, 'Goat'),
(41, 10, 'Female', 40.00, 0, 'Goat'),
(42, 500, 'Female', 1.00, 0, 'Goat'),
(43, 500, 'Female', 1.00, 0, 'Goat'),
(44, 500, 'Female', 1.00, 0, 'Goat'),
(45, 500, 'Female', 1.00, 0, 'Goat'),
(46, 500, 'Female', 1.00, 0, 'Goat'),
(47, 500, 'Female', 1.00, 0, 'Goat'),
(52, 5, 'Male', 5.00, 0, 'Cow'),
(53, 69, 'Male', 96.00, 0, 'Cow'),
(54, 500, 'Male', 60.00, 0, 'Cow'),
(56, 6, 'Male', 30.00, 0, 'Goat'),
(57, 5, 'Female', 11.00, 0, 'Sheep'),
(58, 4, 'Male', 40.00, 0, 'Goat'),
(60, 9, 'Male', 180.00, 0, 'Cow'),
(61, 8, 'Male', 170.00, 0, 'Cow'),
(62, 9, 'Male', 195.00, 0, 'Cow'),
(63, 11, 'Male', 210.00, 0, 'Cow'),
(64, 12, 'Male', 200.00, 0, 'Cow'),
(65, 7, 'Female', 240.00, 0, 'Cow'),
(66, 8, 'Female', 220.00, 0, 'Cow'),
(67, 5, 'Female', 150.00, 0, 'Cow'),
(68, 9, 'Female', 200.00, 0, 'Cow'),
(69, 8, 'Male', 230.00, 0, 'Cow'),
(70, 6, 'Male', 190.00, 0, 'Cow'),
(71, 5, 'Male', 40.00, 0, 'Goat'),
(72, 2, 'Female', 26.00, 0, 'Sheep');

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
-- Table structure for table `dashboard_panel`
--

CREATE TABLE `dashboard_panel` (
  `user_name` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profit` int(255) NOT NULL,
  `farm_name` varchar(50) NOT NULL,
  `Farm_location` varchar(50) NOT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard_panel`
--

INSERT INTO `dashboard_panel` (`user_name`, `first_name`, `last_name`, `email`, `profit`, `farm_name`, `Farm_location`, `pass`) VALUES
('Ahnaf Hossain Rauf', 'Ahnaf Hossain', 'Rauf', 'ahnaf.hossain.rauf@g.bracu.ac.bd', 0, 'Gazipur Wool Factory', 'Gazipur', 'Rauf123'),
('Fuad', '', '', 'Fuad@gmail.com', 0, 'Farmville', 'Mirpur', 'fuad');

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
  `user_name` varchar(255) NOT NULL,
  `inventory_type` varchar(255) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`purchase_id`, `user_name`, `inventory_type`, `amount`, `purchase_date`, `price`) VALUES
(1, 'Fuad', 'Rake', 6, '2026-01-01', 600.00),
(2, 'Fuad', 'Hay', 4, '2026-01-01', 300.00),
(3, 'Fuad', 'Water', 6, '2026-01-01', 300.00),
(4, 'Fuad', 'Shovel', 6, '2026-01-01', 300.00),
(6, 'Fuad', 'Safety equipment set', 5, '2026-01-01', 600.00),
(8, 'Fuad', 'Hay', 5, '2026-01-08', 100.00);

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
-- Table structure for table `owns_cattle`
--

CREATE TABLE `owns_cattle` (
  `user_name` varchar(255) NOT NULL,
  `cattle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owns_cattle`
--

INSERT INTO `owns_cattle` (`user_name`, `cattle_id`) VALUES
('Ahnaf Hossain Rauf', 52),
('Ahnaf Hossain Rauf', 53),
('Ahnaf Hossain Rauf', 54),
('Ahnaf Hossain Rauf', 56),
('Ahnaf Hossain Rauf', 57),
('Ahnaf Hossain Rauf', 58),
('Fuad', 60),
('Fuad', 61),
('Fuad', 62),
('Fuad', 63),
('Fuad', 64),
('Fuad', 65),
('Fuad', 66),
('Fuad', 67),
('Fuad', 68),
('Fuad', 69),
('Fuad', 70),
('Fuad', 71),
('Fuad', 72);

-- --------------------------------------------------------

--
-- Table structure for table `owns_product`
--

CREATE TABLE `owns_product` (
  `user_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owns_product`
--

INSERT INTO `owns_product` (`user_name`, `product_id`) VALUES
('Ahnaf Hossain Rauf', 2),
('Ahnaf Hossain Rauf', 3),
('Fuad', 4);

-- --------------------------------------------------------

--
-- Table structure for table `owns_worker`
--

CREATE TABLE `owns_worker` (
  `user_name` varchar(255) NOT NULL,
  `worker_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owns_worker`
--

INSERT INTO `owns_worker` (`user_name`, `worker_id`) VALUES
('Ahnaf Hossain Rauf', '4'),
('Ahnaf Hossain Rauf', '5'),
('Ahnaf Hossain Rauf', '6'),
('Fuad', '7');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category`, `price`) VALUES
(1, 'Milk', 100.00),
(2, 'Meat', 700.00),
(3, 'Wool', 700.00),
(4, 'Milk', 70.00);

-- --------------------------------------------------------

--
-- Table structure for table `production_date`
--

CREATE TABLE `production_date` (
  `production_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `production_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL
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
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `worker_id` int(11) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `work_hour` int(11) DEFAULT NULL,
  `contact_number` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`worker_id`, `pass`, `name`, `age`, `salary`, `work_hour`, `contact_number`) VALUES
(4, '12345678', 'naomi', 24, 24000.00, 6, 0),
(5, 'eufuwbuif', 'raj', 25, 25000.00, 6, 0),
(6, 'joif', 'Sheikh Joifullah', 25, 500.00, 10, 0),
(7, 'vai', 'Major vai', 40, 50000.00, 45, 0);

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
-- Indexes for table `dashboard_panel`
--
ALTER TABLE `dashboard_panel`
  ADD PRIMARY KEY (`user_name`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

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
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `cattle_id` (`cattle_id`);

--
-- Indexes for table `owns_cattle`
--
ALTER TABLE `owns_cattle`
  ADD KEY `cattle_id` (`cattle_id`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `owns_product`
--
ALTER TABLE `owns_product`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `owns_worker`
--
ALTER TABLE `owns_worker`
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `production_date`
--
ALTER TABLE `production_date`
  ADD PRIMARY KEY (`production_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `login_id` (`user_name`);

--
-- Indexes for table `sheep`
--
ALTER TABLE `sheep`
  ADD PRIMARY KEY (`cattle_id`);

--
-- Indexes for table `surveillance`
--
ALTER TABLE `surveillance`
  ADD PRIMARY KEY (`surveillance_id`),
  ADD KEY `cattle_id` (`cattle_id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `cattle`
--
ALTER TABLE `cattle`
  MODIFY `cattle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `production_date`
--
ALTER TABLE `production_date`
  MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveillance`
--
ALTER TABLE `surveillance`
  MODIFY `surveillance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `dashboard_panel` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cow`
--
ALTER TABLE `cow`
  ADD CONSTRAINT `cow_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`);

--
-- Constraints for table `production_date`
--
ALTER TABLE `production_date`
  ADD CONSTRAINT `production_date_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
