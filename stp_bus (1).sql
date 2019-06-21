-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2019 at 08:16 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stp_bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` int(11) NOT NULL,
  `bus_name` varchar(111) NOT NULL,
  `bus_number` varchar(11) NOT NULL,
  `max_seat` int(11) NOT NULL,
  `bus_standard` enum('ordinary','luxury','semi-luxury','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_name`, `bus_number`, `max_seat`, `bus_standard`) VALUES
(1, 'Shabiby line', 'T DFP 1234', 40, 'ordinary'),
(2, 'Aboud', 'T DFT 1238', 40, 'ordinary'),
(3, 'Kimbinyiko', 'T DFU 7234', 40, 'ordinary'),
(4, 'Shabiby line', 'T DOP 0234', 40, 'semi-luxury'),
(5, 'Aboud', 'T DFI 4234', 40, 'semi-luxury'),
(6, 'Kimbinyiko', 'T DOK 3234', 40, 'semi-luxury'),
(7, 'Shabiby line', 'T DTU 7034', 40, 'luxury'),
(8, 'Aboud', 'T DWP 1534', 40, 'luxury');

-- --------------------------------------------------------

--
-- Table structure for table `bus_schedule`
--

CREATE TABLE `bus_schedule` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `departure_time_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `seat_status` enum('full','empty','open','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_schedule`
--

INSERT INTO `bus_schedule` (`id`, `bus_id`, `day`, `departure_time_id`, `route_id`, `seat_status`) VALUES
(1, 1, '2019-06-06', 1, 1, 'open'),
(2, 2, '2019-06-06', 2, 1, 'empty'),
(3, 2, '2019-06-06', 4, 2, 'empty');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departure_time`
--

CREATE TABLE `departure_time` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departure_time`
--

INSERT INTO `departure_time` (`id`, `time`) VALUES
(1, '06:00:00'),
(2, '08:00:00'),
(3, '10:00:00'),
(4, '12:00:00'),
(5, '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(3) NOT NULL,
  `bus_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `route_id` int(11) NOT NULL,
  `seat_id` int(12) NOT NULL,
  `date` date NOT NULL,
  `departure_time` time NOT NULL,
  `cost_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `bus_id`, `user_id`, `route_id`, `seat_id`, `date`, `departure_time`, `cost_id`) VALUES
(1, 1, 3, 1, 2, '2019-06-08', '06:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_source` varchar(255) NOT NULL,
  `post_destination` varchar(255) NOT NULL,
  `post_via` varchar(255) NOT NULL,
  `post_via_time` varchar(255) NOT NULL,
  `post_query_count` int(3) NOT NULL,
  `max_seats` int(3) NOT NULL,
  `available_seats` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `bus_standard` varchar(60) NOT NULL,
  `price` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `bus_standard`, `price`) VALUES
(1, 'ordinary', '15000'),
(2, 'semi-luxury', '25000'),
(3, 'luxury', '40000');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `query_id` int(3) NOT NULL,
  `query_bus_id` int(3) NOT NULL,
  `query_user` varchar(255) NOT NULL,
  `query_email` varchar(255) NOT NULL,
  `query_date` date NOT NULL,
  `query_content` text NOT NULL,
  `query_replied` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `from` varchar(40) NOT NULL,
  `to` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `from`, `to`) VALUES
(1, 'Dar es salaam', 'Dodoma'),
(2, 'Dodoma', 'Dar es salaam');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `seat_number` char(3) NOT NULL,
  `available_seats` enum('yes','null','','') NOT NULL,
  `booked_seat` enum('yes','no','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `bus_id`, `seat_number`, `available_seats`, `booked_seat`) VALUES
(1, 1, 'A1', 'null', 'yes'),
(2, 1, 'A2', 'yes', 'no'),
(3, 1, 'B1', 'null', 'yes'),
(4, 1, 'B2', 'yes', 'no'),
(5, 1, 'C1', 'yes', 'no'),
(6, 1, 'C2', 'yes', 'yes'),
(7, 1, 'D1', 'yes', 'no'),
(8, 1, 'D2', 'yes', 'no'),
(9, 1, 'E1', 'yes', 'no'),
(10, 1, 'E2', 'yes', 'no'),
(11, 1, 'F1', 'yes', 'no'),
(12, 1, 'F2', 'yes', 'no'),
(13, 1, 'G1', 'yes', 'no'),
(14, 1, 'G2', 'yes', 'no'),
(15, 1, 'H1', 'yes', 'no'),
(16, 1, 'H2', 'yes', 'no'),
(17, 1, 'I1', 'yes', 'no'),
(18, 1, 'I2', 'yes', 'no'),
(19, 1, 'J1', 'yes', 'no'),
(20, 1, 'J2', 'yes', 'no'),
(21, 1, 'K1', 'null', 'yes'),
(22, 1, 'K2', 'yes', 'no'),
(23, 1, 'L1', 'yes', 'no'),
(24, 1, 'L2', 'yes', 'no'),
(25, 1, 'M1', 'yes', 'no'),
(26, 1, 'M2', 'yes', 'no'),
(27, 1, 'N1', 'yes', 'no'),
(28, 1, 'N2', 'yes', 'no'),
(29, 1, 'O1', 'yes', 'no'),
(30, 1, 'O2', 'yes', 'no'),
(31, 1, 'P1', 'yes', 'no'),
(32, 1, 'P2', 'yes', 'no'),
(33, 1, 'Q1', 'yes', 'no'),
(34, 1, 'Q2', 'yes', 'no'),
(35, 1, 'R1', 'yes', 'no'),
(36, 1, 'R2', 'yes', 'no'),
(37, 1, 'S1', 'yes', 'no'),
(38, 1, 'S2', 'yes', 'no'),
(39, 1, 'T1', 'yes', 'no'),
(40, 1, 'T2', 'yes', 'no'),
(41, 1, 'U1', 'yes', 'no'),
(42, 1, 'U2', 'yes', 'no'),
(43, 1, 'V1', 'yes', 'no'),
(44, 1, 'V2', 'yes', 'no'),
(45, 1, 'W1', 'yes', 'no'),
(46, 1, 'W2', 'yes', 'no'),
(47, 1, 'X1', 'yes', 'no'),
(48, 1, 'X2', 'yes', 'no'),
(49, 1, 'Y1', 'yes', 'no'),
(50, 1, 'Y2', 'yes', 'no'),
(51, 1, 'Z1', 'yes', 'no'),
(52, 1, 'Z2', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `expire_date` datetime NOT NULL,
  `status` enum('active','expire','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phoneno` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_email`, `user_phoneno`, `user_role`) VALUES
(2, 'admin', '1234', 'admin@gmail.com', '0789675643', 'admin'),
(3, 'joo', '1234', 'joo@gmail.com', '0656431239', 'subscriber');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `bus_schedule`
--
ALTER TABLE `bus_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `departure_time`
--
ALTER TABLE `departure_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`query_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `bus_schedule`
--
ALTER TABLE `bus_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departure_time`
--
ALTER TABLE `departure_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `query_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
