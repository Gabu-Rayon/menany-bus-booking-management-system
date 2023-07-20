-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 09:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menany-buses-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `bus_number` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `bus_number`, `status`, `date_updated`) VALUES
(1, 'Economy', 'KDL 546G', 1, '2023-07-19 19:29:10'),
(2, 'Premium', 'KDK 506J', 1, '2023-07-19 19:32:10'),
(3, 'Executive', 'KDK 700K', 1, '2023-07-19 19:32:10'),
(4, 'Dulex', 'KDG 800K', 1, '2023-07-19 19:46:37'),
(5, 'Luxury', 'KCB 540K', 1, '2023-07-19 19:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(30) NOT NULL,
  `terminal_name` text NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0= inactive , 1= active',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `terminal_name`, `city`, `state`, `status`, `date_updated`) VALUES
(1, 'Meru-Town', 'Meru', 'MR', 1, '2023-07-09 16:02:19'),
(2, 'Nairobi-City', 'Nairobi', 'NRB', 1, '2023-07-09 16:02:47'),
(3, 'Thika-Town', 'Thika', 'Muranga', 1, '2023-07-19 19:40:41'),
(4, 'Chuka-Town', 'Chuka', 'Tharaka-Nithi', 1, '2023-07-19 19:35:59'),
(5, 'Embu-Town', 'Embu', 'Embu', 1, '2023-07-19 19:36:53'),
(6, 'Maua-Town', 'Maua', 'MR', 1, '2023-07-19 19:38:01'),
(7, 'Nanyuki-Town', 'Nanyuki', 'Laikipia', 1, '2023-07-19 19:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `paid_tickets`
--

CREATE TABLE `paid_tickets` (
  `id` int(11) NOT NULL,
  `bus` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `from_terminal` varchar(255) NOT NULL,
  `to_destination` varchar(255) NOT NULL,
  `departure` timestamp NOT NULL DEFAULT current_timestamp(),
  `eta` timestamp NOT NULL DEFAULT current_timestamp(),
  `how_many` varchar(244) NOT NULL,
  `luggage_count` varchar(244) NOT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `type_payment` varchar(255) DEFAULT NULL,
  `payment_ref_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paid_tickets`
--

INSERT INTO `paid_tickets` (`id`, `bus`, `customer_id`, `from_terminal`, `to_destination`, `departure`, `eta`, `how_many`, `luggage_count`, `ref_no`, `amount_paid`, `type_payment`, `payment_ref_no`) VALUES
(1, 'Economy', '10', 'Meru-Town, Meru, MR', 'Meru-Town, Meru, MR', '2023-07-10 00:21:57', '2023-07-10 03:14:32', '2', '1', 'REF64b7f5034287e', 1400, 'mpesa', 'hilgo;f456465484'),
(2, 'Economy', '10', 'Meru-Town, Meru, MR', 'Meru-Town, Meru, MR', '2023-07-10 00:21:57', '2023-07-10 03:14:32', '2', '1', 'REF64b7f5034287e', 1400, 'mpesa', 'hilgo;f456465484'),
(3, 'Economy', '10', 'Nairobi-City, Nairobi, NRB', 'Meru-Town, Meru, MR', '2023-07-11 08:25:19', '2023-07-11 11:20:28', '0', '0', NULL, NULL, NULL, NULL),
(4, 'Economy', '10', 'Nairobi-City, Nairobi, NRB', 'Meru-Town, Meru, MR', '2023-07-11 08:25:19', '2023-07-11 11:20:28', '0', '0', NULL, NULL, NULL, NULL),
(5, 'Economy', '10', 'Nairobi-City, Nairobi, NRB', 'Meru-Town, Meru, MR', '2023-07-11 08:25:19', '2023-07-11 11:20:28', '0', '0', NULL, NULL, NULL, NULL),
(6, 'Economy', '11', 'Meru-Town, Meru, MR', 'Nairobi-City, Nairobi, NRB', '2023-07-10 00:21:57', '2023-07-10 03:14:32', '2', '1', 'REF64b8dfc285ed1', 1400, 'mpesa', 'bndbeb56jinn'),
(7, 'Executive', '11', 'Thika-Town, Thika, Muranga', 'Nanyuki-Town, Nanyuki, Laikipia', '2023-07-19 15:47:38', '2023-07-19 18:47:38', '2', '2', 'REF64b8dfc285ed1', 1400, 'mpesa', 'bndbeb56jinn'),
(8, 'Economy', '11', 'Meru-Town, Meru, MR', 'Nairobi-City, Nairobi, NRB', '2023-07-10 00:21:57', '2023-07-10 03:14:32', '2', '1', 'REF64b8dfc285ed1', 1400, 'mpesa', 'bndbeb56jinn');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `bus_id` int(30) NOT NULL,
  `from_location` int(30) NOT NULL,
  `to_location` int(30) NOT NULL,
  `departure_time` datetime NOT NULL,
  `eta` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `availability` int(11) NOT NULL,
  `price` text NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `bus_id`, `from_location`, `to_location`, `departure_time`, `eta`, `status`, `availability`, `price`, `date_updated`) VALUES
(1, 1, 1, 2, '2023-07-10 03:21:57', '2023-07-10 06:14:32', 1, 30, '700', '2023-07-19 16:47:26'),
(2, 2, 2, 1, '2023-07-11 11:25:19', '2023-07-11 14:20:28', 1, 30, '900', '2023-07-19 16:47:32'),
(3, 3, 3, 7, '2023-07-19 18:47:38', '2023-07-19 21:47:38', 1, 30, '1700', '2023-07-19 16:50:24'),
(4, 4, 2, 6, '2023-07-19 18:47:38', '2023-07-19 23:47:38', 1, 32, '1800', '2023-07-19 16:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `firstname`, `lastname`, `email`, `password`, `contact`) VALUES
(10, 'murimi', 'murimi', 'admin@mail.com', '$2y$10$rMK9ey7aoB0xyJAZc4ssAeF5jwuJhZhJfyjKwU.SmSc.K/QNV.HOu', '0758519193'),
(11, 'Tems', 'murimi', 'tems@mail.com', '$2y$10$9IY9RirNmUsfa78AdypPy.wTLZUpVj6JFT2uPyjY0S30FvNwXKMgK', '0758519193'),
(12, 'murimi', 'muri', 'admin@mail.com', '$2y$10$KJ5uSNXQaS4O0YgvaWbc9O0.VWL0eQ2MAIbvifKQc6Ek62ClYitv2', '0758519193'),
(13, 'Tems', 'jikooo', 'tem789@mail.com', '$2y$10$uEFtgYEJ4PlkbrBYIWMTX.Hp38CTjjOvmw8nICzMSWQ88j5k.2CWa', '0758519193'),
(14, 'murimi', 'murimi', 'admin@mail.com', '$2y$10$MMw2q//Vq.WsQSztZwL1VOo13DcpUBLGIKGfIHKaiGRDbxQvtl2oe', '0758519193'),
(15, 'Gibson ', 'Muriuki', 'gibsonmurimi4@gmail.com', '$2y$10$Qrd0ubU5F61tTgW8R2I4I.OIlwJSVOOPBFihN3puWF5vPOsBiKD9K', '0758519193'),
(16, 'brian', 'muthomi', 'muthomi@gmail.com', '$2y$10$T05IFGFoCa.R4ClQo6buVObzeECR1K6iBZyUp3t/LsSRPXrRt453m', '537823768'),
(17, 'brian', 'muthomi', 'muthomi@gmail.com', '$2y$10$pMUu1o6nN20JoWO8cnOqP.NqpZc3MJ2GoE360SJSb/8Wh9rIbp0ai', '556778'),
(18, 'brian', 'muthomi', 'muthomi@gmail.com', '$2y$10$S8x/SxdoOnSA3zAWZkQTkeLhkD32tF5ps3a5YKCq.Vlb993pRbvxW', '556778'),
(19, 'brian', 'muthomi', 'muthomi@gmail.com', '$2y$10$gF3QvMCGpM5EICtnM.A3nu8PijPK1FlyR1Q97o37iglwirjIl0Mhy', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ticket_refNo` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `type_payment` varchar(255) NOT NULL,
  `mpesa_refNo` varchar(255) DEFAULT NULL,
  `mastercard_No` int(11) DEFAULT NULL,
  `mastercard_username` varchar(255) DEFAULT NULL,
  `mastercard_valid` date DEFAULT NULL,
  `visacard_No` int(11) DEFAULT NULL,
  `visacard_username` varchar(255) DEFAULT NULL,
  `visacard_valid` date DEFAULT NULL,
  `bank_branchName` varchar(255) DEFAULT NULL,
  `bankPayment_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_refNo`, `customer_id`, `amount_paid`, `type_payment`, `mpesa_refNo`, `mastercard_No`, `mastercard_username`, `mastercard_valid`, `visacard_No`, `visacard_username`, `visacard_valid`, `bank_branchName`, `bankPayment_Date`) VALUES
(1, 'REF64b55defb0607', 10, 1400, 'mpesa', '454556455', NULL, NULL, NULL, NULL, '454556455', NULL, NULL, NULL),
(2, 'REF64b7f5034287e', 10, 1400, 'mpesa', 'hilgo;f456465484', NULL, NULL, NULL, NULL, 'hilgo;f456465484', NULL, NULL, NULL),
(3, 'REF64b818b94dd99', 11, 1400, 'mpesa', 'hilgo;f456465484', NULL, NULL, NULL, NULL, 'hilgo;f456465484', NULL, NULL, NULL),
(4, 'REF64b8df9436bc6', 11, 3400, 'mpesa', 'bndbeb56', NULL, NULL, NULL, NULL, 'bndbeb56', NULL, NULL, NULL),
(5, 'REF64b8dfc285ed1', 11, 1400, 'mpesa', 'bndbeb56jinn', NULL, NULL, NULL, NULL, 'bndbeb56jinn', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unpaid_tickets`
--

CREATE TABLE `unpaid_tickets` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `bus` varchar(255) NOT NULL,
  `bus_plate` varchar(255) NOT NULL,
  `from_terminal` varchar(255) NOT NULL,
  `to_destination` varchar(255) NOT NULL,
  `departure` timestamp NOT NULL DEFAULT current_timestamp(),
  `eta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fare_amount` varchar(255) NOT NULL,
  `how_many` varchar(244) DEFAULT NULL,
  `luggage_count` varchar(244) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unpaid_tickets`
--

INSERT INTO `unpaid_tickets` (`id`, `customer_id`, `bus`, `bus_plate`, `from_terminal`, `to_destination`, `departure`, `eta`, `fare_amount`, `how_many`, `luggage_count`) VALUES
(5, '10', 'Economy', 'KDL 546G', 'Meru-Town, Meru, MR', 'Meru-Town, Meru, MR', '2023-07-10 00:21:57', '2023-07-10 03:14:32', '1400', '2', '1'),
(6, '10', 'Economy', 'KDL 546G', 'Meru-Town, Meru, MR', 'Meru-Town, Meru, MR', '2023-07-10 00:21:57', '2023-07-10 03:14:32', '1400', '2', '1'),
(9, '10', 'Economy', 'KDL 546G', 'Nairobi-City, Nairobi, NRB', 'Meru-Town, Meru, MR', '2023-07-11 08:25:19', '2023-07-11 11:20:28', '900', '0', '0'),
(12, '11', 'Economy', 'KDL 546G', 'Meru-Town, Meru, MR', 'Nairobi-City, Nairobi, NRB', '2023-07-10 00:21:57', '2023-07-10 03:14:32', '1400', '2', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paid_tickets`
--
ALTER TABLE `paid_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unpaid_tickets`
--
ALTER TABLE `unpaid_tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paid_tickets`
--
ALTER TABLE `paid_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unpaid_tickets`
--
ALTER TABLE `unpaid_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
