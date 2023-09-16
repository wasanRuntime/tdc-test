-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 02:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tdc_vehicles`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_makes`
--

CREATE TABLE `car_makes` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `car_image_path` varchar(255) DEFAULT NULL,
  `year_of_manufacture` int(11) NOT NULL,
  `transmission` enum('automatic','manual') NOT NULL,
  `mileage` decimal(10,2) NOT NULL,
  `car_image_path_1` varchar(255) DEFAULT NULL,
  `car_image_path_2` varchar(255) DEFAULT NULL,
  `car_image_path_3` varchar(255) DEFAULT NULL,
  `car_image_path_4` varchar(255) DEFAULT NULL,
  `car_image_path_5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_makes`
--

INSERT INTO `car_makes` (`id`, `seller_id`, `make`, `model`, `price`, `car_image_path`, `year_of_manufacture`, `transmission`, `mileage`, `car_image_path_1`, `car_image_path_2`, `car_image_path_3`, `car_image_path_4`, `car_image_path_5`) VALUES
(1, 8, 'vvvv', '0', '99999999.99', 'uploads/_MG_6606.jpg', 0, 'automatic', '0.00', NULL, NULL, NULL, NULL, NULL),
(2, 8, 'DFW', 'DW', '99999999.99', 'uploads/_MG_6627.jpg', 0, 'automatic', '0.00', NULL, NULL, NULL, NULL, NULL),
(3, 1, 'v8', '345fr', '344556.00', 'uploads/images.png', 0, 'automatic', '0.00', NULL, NULL, NULL, NULL, NULL),
(4, 1, 'Subaru', 'Imprezer', '4000000.00', 'uploads/sedan.jpg', 0, 'automatic', '0.00', NULL, NULL, NULL, NULL, NULL),
(5, 1, 'BMW', 'cvb', '21345435.00', 'uploads/sedan.jpg', 2012, 'manual', '12000.00', NULL, NULL, NULL, NULL, NULL),
(6, 1, 'v8', 'fdd', '344556.00', 'uploads/Stakeholder Mapping.drawio.png', 2012, 'manual', '12454.00', 'uploads/230707_194302.jpg', 'uploads/230707_203333.jpg', 'uploads/_MG_6714.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `make_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `seller_name`, `email`, `phone_number`, `make_id`, `username`, `password`) VALUES
(1, 'Edward Barasa', 'barasa@gmail.com', '0783123462', NULL, 'barasa', '$2y$10$9LbHT0BeYhplWO.H7Fpp0.7eytsMi/AXUk3GoLNYNW5BShR7uoKlq'),
(4, 'Simi\\on Simiyu', 'simiyu@gmail.com', '0746828391', NULL, 'simiyu', '$2y$10$InoNxfI/zu32PaaA4U5qKOREQe64hMb9KX6Svqvyk4GNdQElay04m'),
(5, 'Moses Anoma', 'anoma@gmail.com', '0787457654', NULL, 'anoma', '$2y$10$mfNHumDYWQ2.Yx6I3Dw45OrjII/8Ujcpho8h1sQLOYBQyRiPeZjVe'),
(6, 'Victoria Mutyhoni', 'muthoni@gmail.com', '(888) 888-4446', NULL, 'vicky', '$2y$10$aAIWDRUqNpuhybpOZjBIJ.gra5.ZUk9syLRMU4HRjtTyhCKkLdeBm'),
(7, 'Tizia Kubali', 'kubali@gmail.com', '(888) 678-0446', NULL, 'kubali', '$2y$10$7q2CWf/EUd7uVCK7VPORCujYZjBZq6OJZ1JL2ZY7ZUv9gyt9vvP6K'),
(8, 'Melvin Malasya', 'malasya@gmail.com', '0745373628', NULL, 'malasya', '$2y$10$Pn7YHKf8xR4sgOYxL57xBOMyZBXSAnrqyUYrahptpv8tzfxCWmAnW'),
(9, 'Elisha Kibiwat', 'kibi@gmail.com', '07834171253', NULL, 'kibi', '$2y$10$ud5sin/gn.yz5y0lnzGGge4Tvm0OMQzOALXZ/3i2nxeMwQ2w80LMq'),
(10, '', '', NULL, NULL, 'john miningwa', '7c4a8d09ca3762af61e59520943dc26494f8941b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_makes`
--
ALTER TABLE `car_makes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_makes`
--
ALTER TABLE `car_makes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_makes`
--
ALTER TABLE `car_makes`
  ADD CONSTRAINT `car_makes_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
