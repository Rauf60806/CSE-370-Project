-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2026 at 12:07 PM
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
  `who` varchar(255) NOT NULL,
  `did_what` text NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`report_id`, `who`, `did_what`, `log_date`, `log_time`) VALUES
(1, 'Ahnaf Hossain Rauf', 'Added a new Cow (Weight: 60 kg, Gender: Male)', '2025-12-27', '08:15:04'),
(2, 'Ahnaf Hossain Rauf', 'Added a new  (Weight:  kg, Gender: )', '2025-12-27', '08:49:14'),
(3, 'Ahnaf Hossain Rauf', 'Added a new Cow (Weight: 2 kg, Gender: Male)', '2025-12-27', '13:41:24'),
(4, 'Ahnaf Hossain Rauf', 'Sold Cattle ID: #51', '2025-12-27', '13:52:02'),
(5, 'Ahnaf Hossain Rauf', 'Added a new Goat (Weight: 30 kg, Gender: Male)', '2025-12-27', '13:54:05'),
(6, 'Ahnaf Hossain Rauf', 'Added a new Sheep (Weight: 11 kg, Gender: Female)', '2025-12-27', '13:54:33'),
(7, 'Ahnaf Hossain Rauf', 'Added a new  (Weight:  kg, Gender: )', '2025-12-27', '13:54:52'),
(8, 'Ahnaf Hossain Rauf', 'Added a new Goat (Weight: 40 kg, Gender: Male)', '2025-12-30', '13:24:29'),
(9, 'Ahnaf Hossain Rauf', 'Added a new  (Weight:  kg, Gender: )', '2025-12-30', '13:25:57'),
(10, 'Fuad', 'Added a new Cow (Weight: 200 kg, Gender: Male)', '2025-12-30', '13:41:14'),
(11, 'Fuad', 'Added a new Cow (Weight: 180 kg, Gender: Male)', '2025-12-30', '13:41:25'),
(12, 'Fuad', 'Added a new Cow (Weight: 170 kg, Gender: Male)', '2025-12-30', '13:41:34'),
(13, 'Fuad', 'Added a new Cow (Weight: 195 kg, Gender: Male)', '2025-12-30', '13:41:51'),
(14, 'Fuad', 'Added a new Cow (Weight: 210 kg, Gender: Male)', '2025-12-30', '13:42:05'),
(15, 'Fuad', 'Added a new Cow (Weight: 200 kg, Gender: Male)', '2025-12-30', '13:42:20'),
(16, 'Fuad', 'Added a new Cow (Weight: 240 kg, Gender: Female)', '2025-12-30', '13:42:31'),
(17, 'Fuad', 'Added a new Cow (Weight: 220 kg, Gender: Female)', '2025-12-30', '13:42:42'),
(18, 'Fuad', 'Added a new Cow (Weight: 150 kg, Gender: Female)', '2025-12-30', '13:42:53'),
(19, 'Fuad', 'Added a new Cow (Weight: 200 kg, Gender: Female)', '2025-12-30', '13:53:03'),
(20, 'Fuad', 'Added a new Cow (Weight: 230 kg, Gender: Male)', '2025-12-30', '13:53:11'),
(21, 'Fuad', 'Added a new Cow (Weight: 190 kg, Gender: Male)', '2025-12-30', '13:53:23'),
(22, 'Fuad', 'Added a new  (Weight:  kg, Gender: )', '2025-12-31', '18:28:34'),
(23, 'Fuad', 'Added a new  (Weight:  kg, Gender: )', '2025-12-31', '18:30:17'),
(24, 'Fuad', 'Added new inventory item (Rake), Quantity: , Price: 600', '2026-01-01', '07:13:50'),
(25, 'Fuad', 'Added new inventory item (Hay), Quantity: 4, Price: 300', '2026-01-01', '07:43:31'),
(26, 'Fuad', 'Added new inventory item (Water), Quantity: 6, Price: 300', '2026-01-01', '07:45:15'),
(27, 'Fuad', 'Added new inventory item (Shovel), Quantity: 6, Price: 300', '2026-01-01', '07:45:23'),
(28, 'Fuad', 'Added new inventory item (Fence), Quantity: 10, Price: 400', '2026-01-01', '07:45:36'),
(29, 'Fuad', 'Added new inventory item (Safety equipment set), Quantity: 5, Price: 600', '2026-01-01', '07:45:45'),
(30, 'Fuad', 'Added new inventory item (Shovel), Quantity: 4, Price: 100', '2026-01-01', '08:10:26'),
(31, 'Fuad', 'Deleted inventory item ID: 7', '2026-01-01', '08:19:03'),
(32, 'Fuad', 'Deleted inventory item ID: 7', '2026-01-01', '08:19:12'),
(33, 'Fuad', 'Deleted inventory item ID: 7', '2026-01-01', '08:20:55'),
(34, 'Fuad', 'Deleted inventory item ID: 7', '2026-01-01', '08:21:00'),
(35, 'Fuad', 'Deleted inventory item ID: 5', '2026-01-01', '08:21:13'),
(36, 'Fuad', 'Added new inventory item (Hay), Quantity: 5, Price: 100', '2026-01-01', '08:21:26'),
(37, 'Fuad', 'Added a new Goat (Weight: 40 kg, Gender: Male)', '2026-01-01', '08:26:38'),
(38, 'Fuad', 'Added a new Sheep (Weight: 26 kg, Gender: Female)', '2026-01-01', '08:35:54');

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

--
-- Dumping data for table `cattle`
--

INSERT INTO `cattle` (`cattle_id`, `age`, `gender`, `weight`, `cattle_type`) VALUES
(25, 10, 'Male', 100.00, 'Cow'),
(26, 12, 'Male', 100.00, 'Cow'),
(27, 14, 'Male', 100.00, 'Cow'),
(28, 10, 'Male', 200.00, 'Cow'),
(29, 10, 'Male', 150.00, 'Cow'),
(30, 8, 'Male', 175.00, 'Cow'),
(31, 10, 'Male', 50.00, 'Cow'),
(32, 10, 'Male', 50.00, 'Cow'),
(33, 10, 'Male', 50.00, 'Goat'),
(34, 45, 'Male', 40.00, 'Goat'),
(35, 5, 'Male', 20.00, 'Sheep'),
(36, 6, 'Male', 25.00, 'Sheep'),
(37, 7, 'Male', 30.00, 'Sheep'),
(38, 8, 'Female', 40.00, 'Sheep'),
(39, 6, 'Male', 10.00, 'Sheep'),
(40, 10, 'Female', 40.00, 'Goat'),
(41, 10, 'Female', 40.00, 'Goat'),
(42, 500, 'Female', 1.00, 'Goat'),
(43, 500, 'Female', 1.00, 'Goat'),
(44, 500, 'Female', 1.00, 'Goat'),
(45, 500, 'Female', 1.00, 'Goat'),
(46, 500, 'Female', 1.00, 'Goat'),
(47, 500, 'Female', 1.00, 'Goat'),
(52, 5, 'Male', 5.00, 'Cow'),
(53, 69, 'Male', 96.00, 'Cow'),
(54, 500, 'Male', 60.00, 'Cow'),
(56, 6, 'Male', 30.00, 'Goat'),
(57, 5, 'Female', 11.00, 'Sheep'),
(58, 4, 'Male', 40.00, 'Goat'),
(60, 9, 'Male', 180.00, 'Cow'),
(61, 8, 'Male', 170.00, 'Cow'),
(62, 9, 'Male', 195.00, 'Cow'),
(63, 11, 'Male', 210.00, 'Cow'),
(64, 12, 'Male', 200.00, 'Cow'),
(65, 7, 'Female', 240.00, 'Cow'),
(66, 8, 'Female', 220.00, 'Cow'),
(67, 5, 'Female', 150.00, 'Cow'),
(68, 9, 'Female', 200.00, 'Cow'),
(69, 8, 'Male', 230.00, 'Cow'),
(70, 6, 'Male', 190.00, 'Cow'),
(71, 5, 'Male', 40.00, 'Goat'),
(72, 2, 'Female', 26.00, 'Sheep');

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
  `email` varchar(255) NOT NULL,
  `farm_name` varchar(50) NOT NULL,
  `Farm_location` varchar(50) NOT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard_panel`
--

INSERT INTO `dashboard_panel` (`user_name`, `email`, `farm_name`, `Farm_location`, `pass`) VALUES
('Ahnaf Hossain Rauf', '', 'Gazipur Wool Factory', 'Gazipur', 'Rauf123'),
('Fuad', 'Fuad@gmail.com', 'Farmville', 'Mirpur', 'fuad');

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
  `production_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category`, `production_date`, `price`, `quantity`) VALUES
(1, 'Milk', '0000-00-00', 100.00, 5),
(2, 'Meat', '2025-12-27', 700.00, 100),
(3, 'Wool', '2025-12-27', 700.00, 5),
(4, 'Milk', '2025-12-31', 70.00, 1);

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
  ADD PRIMARY KEY (`report_id`);

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
-- Constraints for table `cow`
--
ALTER TABLE `cow`
  ADD CONSTRAINT `cow_ibfk_1` FOREIGN KEY (`cattle_id`) REFERENCES `cattle` (`cattle_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
