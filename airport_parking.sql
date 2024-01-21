-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2024 at 01:27 AM
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
-- Database: `airport_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `park_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `amount` float NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `park_id`, `customer_id`, `from_date`, `to_date`, `amount`, `is_paid`, `create_date`) VALUES
(1, 1, 13, '2024-01-21 00:00:00', '2024-01-30 00:00:00', 123, 0, '2024-01-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`) VALUES
(1, 'test', 'customer', '', 'customer@gmail.com', 'customer'),
(2, 'maryam', 'maryam', '', 'maryam@gmail.com', '123'),
(3, 'asdf', 'asd', '', 'as@gmial.com', 'asd'),
(4, 'asdf', 'as', '', 'as@gmail.oxs', 'as'),
(5, 'asd', 'asd', '', 'asd@gmail.com', 'asd'),
(6, 'e', 'e', '098765432', 'e@gmail.com', 'e'),
(7, 'qqq', 'qqq', '12345678', 'qqq@gmail.com', 'qqq'),
(8, 'o', 'o', '2345678', 'o@gmail.com', 'o'),
(9, 'wala', 'wala', '0987654321', 'wala@gmail.com', 'wala'),
(11, 'rr', 'rr', 'rr@gmail.com', 'rr', '778899002'),
(12, 'rr', 'rr', 'rr@gmail.com', 'rr', '778899002'),
(13, 'rr', 'rr', 'rr@gmail.com', 'rr', '778899002'),
(16, 'fatimah', 'salman', '0530901638', 'fatimah.s00@hotmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `salary` float NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `date_of_birth`, `salary`, `phone`, `email`, `password`) VALUES
(1, 'محمد ناصر العسيري', '2024-01-21', 2500, '098767893', 'mohammed@gmail.com', '123456'),
(2, 'خالد محمد الغامدي', '2024-01-21', 5600, '0997733333', 'khaled@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `park`
--

CREATE TABLE `park` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `park`
--

INSERT INTO `park` (`id`, `name`, `detail`) VALUES
(1, 'موقف1', 'على يمين البوابة الجنبوبية'),
(2, 'موقف 2', 'على يسار البوابة العامة مقابل صالة الانتظار');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `amount_per_hour` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `amount_per_hour`) VALUES
(1, 180);

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`id`, `email`, `usertype`) VALUES
(1, 'admin@gmail.com', 'a'),
(2, 'customer@gmail.com', 'c'),
(3, 'maryam@gmail.com', 'c'),
(4, 'ftoom@gmail.com', 'e'),
(5, 'as@gmial.com', 'c'),
(6, 'as@gmial.com', 'c'),
(7, 'as@gmial.com', 'c'),
(8, 'as@gmail.oxs', 'c'),
(9, 'asd@gmail.com', 'c'),
(10, 'asdfg@gmail.com', 'e'),
(11, 'e@gmail.com', 'c'),
(12, 'qqq@gmail.com', 'c'),
(13, 'eng@gmail.com', 'e'),
(14, 'o@gmail.com', 'c'),
(15, 'ww@gmail.com', 'e'),
(16, 'rr@gmail.com', 'c'),
(17, 'rr@gmail.com', 'c'),
(18, 'rr@gmail.com', 'c'),
(20, 'qqqq@gmail.com', 'c'),
(21, 'jj@gmail.com', 'e'),
(22, 'fatimah.s00@hotmail.com', 'c'),
(23, 'aa@gmail.com', 'e'),
(24, 'aa@gmail.com', 'e'),
(25, 'q@gmail.com', 'e'),
(26, 'a@gmail.com', 'c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_booking_park` (`park_id`),
  ADD KEY `fk_booking_customer` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `park`
--
ALTER TABLE `park`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `park`
--
ALTER TABLE `park`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `webuser`
--
ALTER TABLE `webuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_park` FOREIGN KEY (`park_id`) REFERENCES `park` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
