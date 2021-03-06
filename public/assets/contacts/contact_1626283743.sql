-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2021 at 10:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_no` varchar(30) NOT NULL,
  `client_id_no` varchar(30) NOT NULL,
  `vehicle_licence` varchar(50) DEFAULT NULL,
  `place_id` int(11) NOT NULL,
  `price_id` int(11) DEFAULT NULL,
  `promocode_id` int(11) DEFAULT NULL,
  `promocode` varchar(100) DEFAULT NULL,
  `space` varchar(100) DEFAULT NULL,
  `arrival_time` datetime NOT NULL,
  `departure_time` datetime NOT NULL,
  `release_time` datetime DEFAULT NULL,
  `booking_period` varchar(100) DEFAULT NULL,
  `net_price` float(8,1) DEFAULT 0.0,
  `discount` float(8,1) DEFAULT 0.0,
  `vat` float(8,1) NOT NULL DEFAULT 0.0,
  `fine` float(8,1) NOT NULL DEFAULT 0.0,
  `total_price` float(8,1) NOT NULL DEFAULT 0.0,
  `note` varchar(512) DEFAULT NULL,
  `release_note` varchar(512) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0->not paid, 1->paid',
  `booking_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0->current, 1->release'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `id_no`, `client_id_no`, `vehicle_licence`, `place_id`, `price_id`, `promocode_id`, `promocode`, `space`, `arrival_time`, `departure_time`, `release_time`, `booking_period`, `net_price`, `discount`, `vat`, `fine`, `total_price`, `note`, `release_note`, `created_at`, `created_by`, `payment_type`, `booking_status`) VALUES
(1, 'A000001', 'A0001', NULL, 1, 24, 3, '123456', '1', '2019-09-22 08:00:00', '2019-09-22 12:00:00', NULL, '5 Hours = 30.0???', 2.0, 5.0, 285.2, 5.0, 3.0, 'test', NULL, '2019-07-28 20:34:06', 1, 1, 0),
(2, 'A000002', 'A0001', NULL, 1, 23, 3, '123456', '2', '2019-07-28 16:46:00', '2019-08-17 16:22:07', NULL, '2 Hours = 15.0???', 3.0, 5.0, 359.7, 5.0, 3.0, NULL, NULL, '2019-07-28 20:48:36', 1, 1, 0),
(3, 'A000003', 'A0001', NULL, 6, 22, NULL, NULL, '3', '2019-08-17 13:39:00', '2019-08-17 16:19:44', NULL, '1 Hours = 10.0???', 26.7, 0.0, 2.7, 5.0, 34.4, NULL, NULL, '2019-08-17 15:49:55', 1, 1, 0),
(4, 'A000004', 'A0021', 'Ad3x', 6, 27, NULL, '12345', '4', '2019-08-26 15:08:00', '2019-08-27 15:08:00', NULL, '1 Days = 50.0???', 50.0, 0.0, 5.0, 0.0, 55.0, 'Test', NULL, '2019-08-26 15:32:18', 1, 1, 0),
(5, 'A000005', 'A0021', 'Ad3x', 6, 22, NULL, '12345', '8', '2019-08-26 16:25:00', '2019-08-26 17:25:00', NULL, '1 Hours = 10.0???', 10.0, 0.0, 1.0, 0.0, 11.0, 'Test', NULL, '2019-08-26 16:27:38', 3, 1, 0),
(6, 'A000006', 'A0022', '211', 6, 25, NULL, NULL, '5', '2019-09-22 08:00:00', '2019-09-22 12:00:00', NULL, '12 Hours = 30.0???', 30.0, 0.0, 3.0, 0.0, 33.0, 'Test', NULL, '2019-08-26 16:28:42', 3, 1, 0),
(7, 'A000007', 'A0023', 'DHAKA 2', 6, 24, 1, '12345', '1', '2019-09-24 11:08:00', '2019-09-24 16:08:00', NULL, ' = 30.0???', 30.0, 10.0, 3.0, 0.0, 23.0, 'Test', NULL, '2019-09-24 11:10:45', 0, 0, 0),
(8, 'A000008', 'A0023', 'DHAKA 2', 6, 24, 1, '12345', '1', '2019-09-24 11:08:00', '2019-09-24 16:08:00', NULL, ' = 30.0???', 30.0, 10.0, 3.0, 0.0, 23.0, 'Test', NULL, '2019-09-24 11:11:14', 0, 0, 0),
(9, 'A000009', 'A0023', 'DHAKA 2', 6, 24, 1, '12345', '1', '2019-09-24 11:08:00', '2019-09-24 16:08:00', NULL, ' = 30.0???', 30.0, 10.0, 3.0, 0.0, 23.0, 'Test', NULL, '2019-09-24 11:12:00', 0, 0, 0),
(10, 'A000010', 'A0023', '211 Test', 6, 24, 1, '12345', '2', '2019-09-24 11:12:00', '2019-09-24 16:12:00', NULL, ' = 30.0???', 30.0, 10.0, 3.0, 0.0, 23.0, 'Test', NULL, '2019-09-24 11:13:12', 0, 1, 0),
(11, 'A000011', 'A0023', 'DHAKA 2', 6, 27, NULL, NULL, '3', '2019-09-24 11:13:00', '2019-09-25 11:13:00', NULL, ' = 50.0???', 50.0, 0.0, 5.0, 0.0, 55.0, '123', NULL, '2019-09-24 11:14:58', 0, 1, 0),
(12, 'A000012', 'A0023', '211 Test', 6, 22, 1, '12345', '2', '2019-09-29 11:18:00', '2019-09-29 12:18:00', NULL, ' = 10.0???', 10.0, 10.0, 1.0, 0.0, 1.0, 'Test', NULL, '2019-09-29 11:19:06', 0, 1, 0),
(13, 'A000013', 'A0023', 'VH 404', 6, 24, 1, '12345', '1', '2019-09-29 12:03:00', '2019-09-29 17:03:00', NULL, ' = 30.0???', 30.0, 10.0, 3.0, 0.0, 23.0, 'New Booking', NULL, '2019-09-29 12:04:34', 0, 1, 0),
(14, 'A000014', 'A0023', 'DHAKA 2', 6, 23, NULL, NULL, '1', '2019-10-14 10:36:00', '2019-10-14 12:36:00', NULL, ' = 15.0???', 15.0, 0.0, 1.5, 0.0, 16.5, NULL, NULL, '2019-10-14 11:22:23', 0, 1, 0),
(15, 'A000015', 'A0023', 'admin2@coderstrust.com', 6, 22, 1, '12345', '2', '2019-10-14 12:45:00', '2019-10-14 13:45:00', NULL, ' = 10.0???', 10.0, 10.0, 1.0, 0.0, 1.0, 'Test', NULL, '2019-10-14 11:54:18', 0, 1, 0),
(16, 'A000016', 'A0023', 'DHAKA 2', 6, 24, NULL, NULL, '3', '2019-10-14 11:56:00', '2019-10-14 16:56:00', NULL, ' = 30.0???', 30.0, 0.0, 3.0, 0.0, 33.0, NULL, NULL, '2019-10-14 11:56:38', 0, 1, 0),
(17, 'A000017', 'A0023', '211 Test', 6, 21, NULL, NULL, '1', '2019-10-14 15:17:00', '2019-10-14 15:47:00', NULL, ' = 5.0???', 5.0, 0.0, 0.5, 0.0, 5.5, NULL, NULL, '2019-10-14 15:17:52', 0, 1, 0),
(41, 'A000018', 'A0023', 'DHAKA 2', 6, 24, 1, '12345', '1', '2019-10-16 15:47:00', '2019-10-16 20:47:00', '2019-10-16 16:30:00', ' = 30.0???', 30.0, 10.0, 3.0, 0.0, 23.0, NULL, NULL, '2019-10-16 15:48:03', 0, 1, 1),
(42, 'A000019', 'A0023', '211 Test', 6, 22, NULL, NULL, '2', '2019-10-17 11:39:00', '2019-10-17 12:39:00', NULL, ' = 10.0???', 10.0, 0.0, 1.0, 0.0, 11.0, 'Test', NULL, '2019-10-17 11:39:16', 0, 1, 0),
(43, 'A000020', 'A0023', 'DHAKA 2', 6, 22, NULL, NULL, '1', '2019-10-24 11:57:00', '2019-10-24 12:57:00', NULL, ' = 10.0???', 10.0, 0.0, 1.0, 0.0, 11.0, 'Test', NULL, '2019-10-24 11:58:05', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_history`
--

CREATE TABLE `booking_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `booking_id_no` varchar(20) DEFAULT NULL,
  `client_id_no` varchar(20) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `payment_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking_history`
--

INSERT INTO `booking_history` (`id`, `transaction_id`, `booking_id_no`, `client_id_no`, `amount`, `data`, `created_at`, `payment_status`) VALUES
(28, 'PAYID-LWTOOVQ7P727667DM255440P', 'A000018', 'A0023', 23, '{\"id_no\":\"A000018\",\"client_id_no\":\"A0023\",\"vehicle_licence\":\"DHAKA 2\",\"place_id\":\"6\",\"price_id\":\"24\",\"promocode_id\":\"1\",\"promocode\":\"12345\",\"space\":\"1\",\"arrival_time\":\"2019-10-16 15:47:00\",\"departure_time\":\"2019-10-16 20:47:00\",\"release_time\":null,\"booking_period\":\" = 30.0\\u09f3\",\"net_price\":\"30.0\",\"discount\":\"10.0\",\"vat\":\"3.0\",\"fine\":\"0.0\",\"total_price\":\"23.0\",\"note\":null,\"release_note\":null,\"created_at\":\"2019-10-16 15:48:03\",\"created_by\":0,\"payment_type\":1,\"booking_status\":0}', '2019-10-16 15:48:06', '1'),
(29, 'PAYID-LWT75BY42L37461CM6021746', 'A000019', 'A0023', 11, '{\"id_no\":\"A000019\",\"client_id_no\":\"A0023\",\"vehicle_licence\":\"211 Test\",\"place_id\":\"6\",\"price_id\":\"22\",\"promocode_id\":null,\"promocode\":null,\"space\":\"2\",\"arrival_time\":\"2019-10-17 11:39:00\",\"departure_time\":\"2019-10-17 12:39:00\",\"release_time\":null,\"booking_period\":\" = 10.0\\u09f3\",\"net_price\":\"10.0\",\"discount\":\"0.0\",\"vat\":\"1.0\",\"fine\":\"0.0\",\"total_price\":\"11.0\",\"note\":\"Test\",\"release_note\":null,\"created_at\":\"2019-10-17 11:39:16\",\"created_by\":0,\"payment_type\":1,\"booking_status\":0}', '2019-10-17 11:39:21', '1'),
(30, 'PAYID-LWYT22I8CH33314WG0973237', 'A000020', 'A0023', 11, '{\"id_no\":\"A000020\",\"client_id_no\":\"A0023\",\"vehicle_licence\":\"DHAKA 2\",\"place_id\":\"6\",\"price_id\":\"22\",\"promocode_id\":null,\"promocode\":null,\"space\":\"1\",\"arrival_time\":\"2019-10-24 11:57:00\",\"departure_time\":\"2019-10-24 12:57:00\",\"release_time\":null,\"booking_period\":\" = 10.0\\u09f3\",\"net_price\":\"10.0\",\"discount\":\"0.0\",\"vat\":\"1.0\",\"fine\":\"0.0\",\"total_price\":\"11.0\",\"note\":\"Test\",\"release_note\":null,\"created_at\":\"2019-10-24 11:58:05\",\"created_by\":0,\"payment_type\":1,\"booking_status\":0}', '2019-10-24 11:58:09', '1');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `id_no`, `name`, `mobile`, `email`, `password`, `address`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(17, 'A0009', 'John Doe', '1234656789', 'john@demo.com', NULL, NULL, NULL, '2018-04-24 08:51:58', '2018-04-24 08:51:58', 0),
(18, 'A0006', 'Jennifer Lowrence', '0123456789', NULL, NULL, NULL, 3, '2018-04-24 14:22:46', '2018-04-24 14:22:46', 0),
(19, 'A0001', 'Jahed Abdullah', '0123456789', 'jahed@example.com', NULL, NULL, 3, '2018-04-24 14:25:18', '2018-04-24 14:25:18', 0),
(20, 'A0002', 'Test', '0123456789', 'test@gmail.com', NULL, 'Teest', 3, '2018-04-24 14:27:34', '2018-04-24 14:27:34', 1),
(22, 'A0016', 'Wiliam Smith', '0123567897', NULL, NULL, NULL, NULL, '2018-04-24 14:50:41', '2018-04-24 14:50:41', 1),
(23, 'A0017', 'Hannan', '01837689150', 'hannandiu42@gmail.com', NULL, 'Feni Sadar, Feni -3900', NULL, '2018-04-27 04:03:36', '2018-04-27 04:03:36', 1),
(24, 'A0018', 'Samuel', '01821742285', 'samuel@gmail.com', NULL, 'Kathalbagan, Dhaka - 1205', NULL, '2018-04-27 04:29:13', '2018-04-27 04:29:13', 1),
(25, 'A0019', 'Istiaq', '0123456789', NULL, NULL, NULL, 3, '2018-04-29 11:30:33', '2018-04-29 11:30:33', 1),
(27, 'A0020', 'Label 1', '', 'estcy@example.com', NULL, NULL, 3, '2018-04-29 15:06:57', '2018-04-29 15:09:16', 2),
(76, 'A0021', 'help.codekernel@gmail.com', '01234567888', 'sourav.diubd@gmail.com', NULL, NULL, NULL, '2019-08-26 12:34:55', '2019-08-26 12:34:55', 2),
(80, 'A0022', 'Alan', '1858884515', 'alan@example.com', NULL, NULL, NULL, '2019-08-26 12:44:49', '2019-08-26 12:44:49', 2),
(84, 'A0023', 'Demo User', '1858884515', 'client@codekernel.net', '$2y$10$oLcW8Kr.jSc7/wkQUgcMjOzgIZ4vpK1RPqEuRtdWHFZXp1WGXSRMS', 'Dhaka', NULL, '2019-08-27 06:34:32', '2019-09-29 07:13:11', 1),
(85, 'A0024', 'Demo User 2', '1858884515', 'demo@codekernel.net', '$2y$10$oLcW8Kr.jSc7/wkQUgcMjOzgIZ4vpK1RPqEuRtdWHFZXp1WGXSRMS', 'House# 82, Road# 19/A, Block# E, Banani', NULL, '2019-08-27 07:19:54', '2019-08-27 07:22:32', 1),
(86, 'A0025', 'Peyton Manning', '3035678910', 'sxn@coderstrust.com', '$2y$10$Rgovi1qu/oQkTc1y1G/OB.7a/eY8lKsW5mHn8NxzWXZZu9SSIwKmK', '1234 Main Street', 1, '2019-08-27 07:24:36', '2019-10-16 11:23:27', 1),
(87, 'A0026', 'Test', '01858884515', 'admin@test.com', '$2y$10$oLcW8Kr.jSc7/wkQUgcMjOzgIZ4vpK1RPqEuRtdWHFZXp1WGXSRMS', 'House# 82, Road# 19/A, Block# E, Banani', NULL, '2019-10-16 11:24:36', '2019-10-16 11:31:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_vehicle`
--

CREATE TABLE `client_vehicle` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id_no` varchar(20) DEFAULT NULL,
  `licence` varchar(50) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `note` varchar(512) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_vehicle`
--

INSERT INTO `client_vehicle` (`id`, `client_id_no`, `licence`, `photo`, `color`, `note`, `created_at`, `status`) VALUES
(20, 'A0021', 'Ad3x', 'public/assets/images/client/659b9c1f687c4256ec9ee8dc839438dd.jpg', 'Blue', 'Test', '2019-08-26 12:24:08', 1),
(21, 'A0022', '211', 'public/assets/images/client/1b3f2389f54281516f30c6e9e0744120.jpg', 'Blue', 'Test', '2019-08-26 14:16:46', 1),
(22, 'A0021', '211', 'public/assets/images/client/8edafb0de03bf5e3fa491b93ac71fb48.jpg', 'Blue', 'Test', '2019-08-26 14:19:16', 1),
(23, 'A0021', '13', 'public/assets/images/client/42dceec47b691a68fe21cb95aa17d525.jpg', 'Orange', 'Test', '2019-08-26 14:20:07', 1),
(24, 'A0021', '1', NULL, NULL, NULL, '2019-08-26 14:20:34', 1),
(25, 'A0021', '13', 'public/assets/images/client/a9089a516789bd0d6a7a7e18f73508aa.jpg', 'Blue', 'Test', '2019-08-26 14:21:10', 1),
(26, 'A0021', '211', NULL, 'Blue', NULL, '2019-08-26 14:22:32', 1),
(27, 'A0021', '13', 'public/assets/images/client/d290a6646976a8db70daa7cf91e476dc.jpg', 'Test', 'TSEtsdf', '2019-08-26 14:23:26', 1),
(28, 'A0021', '13', 'public/assets/images/client/6748ea9ad101f2e21e034da3f4baf32e.jpg', 'Test', 'TSEtsdf', '2019-08-26 14:23:59', 1),
(29, 'A0021', '13', 'public/assets/images/client/377499adbcd7eddbdd566154b355bbbb.jpg', 'Blue', NULL, '2019-08-26 14:24:24', 1),
(30, 'A0021', '13', NULL, NULL, NULL, '2019-08-26 14:25:45', 1),
(31, 'A0022', '211', NULL, 'TestRR', 'Teset', '2019-08-26 15:02:16', 1),
(32, 'A0023', '211 Test', NULL, 'TestRR', 'Teset', '2019-08-26 15:04:10', 1),
(33, 'A0021', '211', NULL, 'TestRR', 'Teset', '2019-08-26 15:05:41', 1),
(34, 'A0022', 'TEST', NULL, 'TestRR', 'Teset', '2019-08-26 15:05:51', 1),
(35, 'A0023', 'DHAKA 2', NULL, NULL, NULL, '2019-08-26 15:55:47', 0),
(36, 'A0022', 'CTG 30389', NULL, NULL, NULL, '2019-08-26 17:40:29', 1),
(37, 'A0022', 'CTG 30389', NULL, NULL, NULL, '2019-08-26 17:41:10', 1),
(38, 'A0022', 'CTG 30389', NULL, NULL, NULL, '2019-08-26 17:43:45', 1),
(39, 'A0022', 'CTG 30389', NULL, NULL, NULL, '2019-08-26 17:44:49', 1),
(40, 'A0023', 'admin@coderstrust.com', NULL, NULL, NULL, '2019-08-26 17:49:02', 0),
(41, 'A0023', 'admin2@coderstrust.com', NULL, NULL, NULL, '2019-08-26 17:51:44', 0),
(42, 'A0023', 'admin@coderstrust.com', NULL, NULL, NULL, '2019-08-27 11:33:37', 1),
(43, 'A0023', 'admin@coderstrust.com', NULL, NULL, NULL, '2019-08-27 11:34:32', 1),
(44, 'A0024', 'Ad3', NULL, NULL, NULL, '2019-08-27 12:19:54', 1),
(45, 'A0025', '211 TEST', NULL, NULL, NULL, '2019-08-27 12:24:36', 1),
(46, 'A0026', 'Dhaka 2394', NULL, NULL, NULL, '2019-08-28 12:10:05', 1),
(47, 'A0026', 'Dhaka 2394', NULL, NULL, NULL, '2019-08-28 12:18:05', 1),
(48, 'A0026', 'Dhaka 2394', NULL, NULL, NULL, '2019-08-28 12:32:55', 1),
(49, 'A0023', 'Feni Kha 10255', NULL, 'Red', 'Test', '2019-09-29 11:49:59', 1),
(50, 'A0023', 'VH 404', 'public/assets/images/client/531cb3520f031506a92338378f3bfa1d.jpg', 'Navy-Blue', 'Test', '2019-09-29 11:55:57', 1),
(51, 'A0026', 'Dhaka Kha 24442', NULL, NULL, NULL, '2019-10-16 16:24:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_history`
--

CREATE TABLE `email_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_setting_id` int(11) DEFAULT NULL,
  `client_id_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-pending, 1-sent, 2-quick-send'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_history`
--

INSERT INTO `email_history` (`id`, `email_setting_id`, `client_id_no`, `email`, `subject`, `message`, `schedule_at`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(3, 3, NULL, 'sourav.diubd@gmail.com', 'Test', 'Test', NULL, '2019-08-27 10:38:44', NULL, 1, 1),
(4, 3, NULL, 'sourav.diubd@gmail.com', 'Email Testing', 'Send, receive, and track emails with Mailgun???s free email API. You can quickly integrate with our RESTful APIs to get reliable email delivery of your important messages. ... For companies that need to send frequent marketing and transactional emails to their audiences,', NULL, '2019-08-27 10:41:12', NULL, 1, 1),
(5, 3, NULL, 'sourav.diubd@gmail.com', 'Email Testing', 'Send, receive, and track emails with Mailgun???s free email API. You can quickly integrate with our RESTful APIs to get reliable email delivery of your important messages. ... For companies that need to send frequent marketing and transactional emails to their audiences,', NULL, '2019-08-27 11:02:51', NULL, 1, 1),
(6, 3, NULL, 'admin@coderstrust.com', 'Email Testing', 'Ts', NULL, '2019-08-28 12:07:16', NULL, 1, 1),
(7, 3, NULL, 'shohrab@coderstrust.com', 'Email Testing', 'Ts', NULL, '2019-08-28 12:07:39', NULL, 1, 1),
(8, NULL, NULL, 'admin@coderstrust.com', 'admin@coderstrust.com', 'Test', NULL, '2019-09-17 15:52:39', NULL, NULL, 1),
(9, NULL, NULL, 'shohrab@coderstrust.com', 'Test', 'Test', NULL, '2019-09-17 15:53:27', NULL, NULL, 1),
(10, NULL, NULL, 'shohrab@coderstrust.com', 'Test 3', 'Teszfs', NULL, '2019-09-17 15:54:22', NULL, NULL, 1),
(11, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">24 Sep, 2019 11:12 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000009\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>24 Sep, 2019 11:12 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 11:08 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 04:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Not Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">23.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-24 11:12:01', NULL, 0, 0),
(12, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">24 Sep, 2019 11:13 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000010\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (211 Test)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 2 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>24 Sep, 2019 11:13 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 11:12 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 04:12 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">23.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-24 11:13:12', NULL, 0, 0),
(13, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">24 Sep, 2019 11:14 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000011\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 3 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 50.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>24 Sep, 2019 11:14 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 24 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">50.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 11:13 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>25 Sep, 2019 11:13 AM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">5.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">55.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-24 11:14:58', NULL, 0, 0),
(14, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">29 Sep, 2019 11:19 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000012\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (211 Test)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 2 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 10.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>29 Sep, 2019 11:19 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 1 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>29 Sep, 2019 11:18 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>29 Sep, 2019 12:18 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-29 11:19:07', NULL, 0, 0),
(15, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">29 Sep, 2019 12:04 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000013\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (VH 404)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>29 Sep, 2019 12:04 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>29 Sep, 2019 12:03 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>29 Sep, 2019 05:03 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">23.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-29 12:04:34', NULL, 0, 0),
(16, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">14 Oct, 2019 11:22 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000014\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 15.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>14 Oct, 2019 11:22 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 2 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">15.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 10:36 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 12:36 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.5???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">16.5???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-14 11:22:24', NULL, 0, 0),
(17, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">14 Oct, 2019 11:54 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000015\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (admin2@coderstrust.com)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 2 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 10.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>14 Oct, 2019 11:54 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 1 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 12:45 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 01:45 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-14 11:54:18', NULL, 0, 0),
(18, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">14 Oct, 2019 11:56 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000016\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 3 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>14 Oct, 2019 11:56 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 11:56 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 04:56 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-14 11:56:38', NULL, 0, 0),
(19, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">14 Oct, 2019 03:17 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000017\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (211 Test)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 5.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>14 Oct, 2019 03:17 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 30 Minutes</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">5.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 03:17 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 03:47 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.5???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">5.5???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-14 15:17:53', NULL, 0, 0),
(20, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 11:20 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000018\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (admin@coderstrust.com)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 10.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 11:20 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 1 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 11:19 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 12:19 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">11.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 11:20:16', NULL, 0, 0),
(21, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 11:28 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000019\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (admin@coderstrust.com)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 10.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 11:28 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 1 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 11:28 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 12:28 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">11.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 11:28:46', NULL, 0, 0),
(22, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 05:33 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000020\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 05:28 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 05:26 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 10:26 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 17:33:14', NULL, 0, 0);
INSERT INTO `email_history` (`id`, `email_setting_id`, `client_id_no`, `email`, `subject`, `message`, `schedule_at`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(23, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 05:38 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000020\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 05:28 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 05:26 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 10:26 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 17:38:12', NULL, 0, 0),
(24, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 05:38 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000020\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 05:28 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 05:26 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 10:26 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 17:38:39', NULL, 0, 0),
(25, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 05:39 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000020\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 05:28 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 05:26 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 10:26 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 17:39:41', NULL, 0, 0),
(26, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 11:15 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000021\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 15.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 11:14 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 2 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">15.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 11:14 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 01:14 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.5???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">16.5???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 11:15:35', NULL, 0, 0),
(27, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:10 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:10:04', NULL, 0, 0),
(28, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:10 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:10:52', NULL, 0, 0),
(29, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:12 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:12:42', NULL, 0, 0),
(30, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:12 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:12:58', NULL, 0, 0),
(31, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:13 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:13:22', NULL, 0, 0),
(32, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:14 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:14:18', NULL, 0, 0),
(34, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:48 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000018\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0??? \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:48 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:47 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:47 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5???)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0???</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">23.0???</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:48:33', NULL, 0, 0),
(35, 3, NULL, 'sharower@coderstrust.com', 'Email Testing', 'Test', NULL, '2019-10-21 17:31:36', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_setting`
--

CREATE TABLE `email_setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `driver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'smtp' COMMENT 'smtp, mailgun, mailtrap',
  `host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mailtrap.io',
  `port` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2525',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'tls' COMMENT 'tls',
  `sendmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'usr/sbin/sendmail -bs',
  `pretend` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_setting`
--

INSERT INTO `email_setting` (`id`, `driver`, `host`, `port`, `username`, `password`, `encryption`, `sendmail`, `pretend`) VALUES
(3, 'smtp', 'smtp.gmail.com', '587', 'sourav.diubd@gmail.com', 'dpisrhtgqtgwziww', 'tls', 'usr/sbin/sendmail -bs', '0');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(10) UNSIGNED NOT NULL,
  `setting` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'english',
  `default` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bangla` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `setting`, `default`, `bangla`) VALUES
(2, 'default', 'Log in to start your session', '??????????????? ???????????? ???????????? ???????????? ?????? ?????? ????????????'),
(3, 'default', 'Email', '????????????'),
(4, 'default', 'Password', '??????????????????????????????'),
(5, 'default', 'Remember Me', '????????? ??????????????????'),
(6, 'default', 'Forgot Your Password?', '??????????????? ?????????????????????????????? ???????????? ????????????????'),
(7, 'default', 'Send Password Reset Link', '?????????????????????????????? ????????????????????? ????????? ???????????? ???????????????'),
(8, 'default', 'Login', '????????????'),
(9, 'default', 'Label Here!', '??????????????? ???????????????!'),
(10, 'default', 'Label', '???????????????'),
(11, 'default', 'Reset Password?', '??????????????? ???????????????????????????????'),
(12, 'default', 'Home', '?????????'),
(13, 'default', 'Client', '??????????????????????????????'),
(14, 'default', 'New Client', '???????????? ??????????????????????????????'),
(15, 'default', 'Clients', '?????????????????????????????? ??????????????????'),
(16, 'default', 'Parking Zone', '????????????????????? ?????????'),
(17, 'default', 'New Parking Zone', '???????????? ????????????????????? ?????????'),
(18, 'default', 'Parking Zone', '????????????????????? ?????????'),
(19, 'default', 'Add New Label', '???????????? ??????????????? ????????? ????????????'),
(20, 'default', 'English', '??????????????????'),
(21, 'default', 'Parking Zones', '????????????????????? ????????? ??????????????????'),
(22, 'default', 'Price', '???????????????'),
(23, 'default', 'New Price', '???????????? ???????????????'),
(24, 'default', 'Prices', '??????????????? ??????????????????'),
(25, 'default', 'Promo Code', '?????????????????? ?????????'),
(26, 'default', 'New Promo Code', '???????????? ????????????????????? ?????????'),
(27, 'default', 'Promo Codes', '?????????????????? ????????? ??????????????????'),
(28, 'default', 'New Email', '???????????? ???????????????'),
(29, 'default', 'Email List', '???????????? ??????????????????'),
(30, 'default', 'Setting', '???????????????'),
(31, 'default', 'Booking', '???????????????'),
(32, 'default', 'New Booking', '???????????? ???????????????'),
(33, 'default', 'Bookings', '??????????????? ???????????????'),
(34, 'default', 'Application', '????????????????????????????????????'),
(35, 'default', 'Message', '??????????????????'),
(36, 'default', 'New Message', '???????????? ??????????????????'),
(37, 'default', 'Inbox Message', '?????????????????? ??????????????????'),
(38, 'default', 'Sent Message', '????????????????????? ??????????????????'),
(39, 'default', 'Language', '????????????'),
(40, 'default', 'Admin', '????????????????????????'),
(41, 'default', 'New User', '???????????? ?????????????????????????????????'),
(42, 'default', 'User List', '???????????????????????????????????? ??????????????????'),
(43, 'default', 'Profile', '????????????????????????'),
(44, 'default', 'Logout', '???????????????'),
(45, 'default', 'Main Navigation', '?????????????????? ??????????????????????????????'),
(46, 'default', 'Save', '?????????????????????'),
(47, 'default', 'Reset', '???????????????'),
(48, 'default', 'Update', '???????????????'),
(49, 'default', 'Update Label', '??????????????? ???????????????'),
(50, 'default', 'Delete', '???????????? ???????????????'),
(51, 'default', 'Save Successful!', '????????????????????? ????????????????????? ????????????!'),
(52, 'default', 'Add New Language', '???????????? ???????????? ??????????????????'),
(53, 'default', 'Enter Language Name', '???????????? ????????? ???????????????'),
(54, 'default', 'Language List', '???????????? ??????????????????'),
(55, 'default', 'Action', '?????????????????????'),
(56, 'default', 'Active', '?????????????????????'),
(57, 'default', 'Activated', '?????????????????????'),
(58, 'default', 'Bangla', '???????????????'),
(59, 'default', 'Default Language Activated!', '?????????????????? ???????????? ?????????????????????!'),
(60, 'default', 'Name', '?????????'),
(61, 'default', 'Enter Name', '????????? ?????????????????? ????????????'),
(62, 'default', 'Enter Phone or Mobile No.', '????????? ?????? ?????????????????? ??????????????? ???????????????'),
(63, 'default', 'Phone / Mobile', '????????? / ??????????????????'),
(64, 'default', 'Enter Email Address', '???????????? ?????????????????? ???????????????'),
(65, 'default', 'Enter Address', '?????????????????? ???????????????'),
(66, 'default', 'Address', '??????????????????'),
(67, 'default', 'Vehicle Licence', '????????????????????? ????????????????????????'),
(68, 'default', 'Enter Vehicle Licence No.', '??????????????????????????? ???????????????????????? ??????????????? ???????????????'),
(69, 'default', 'Vehicle Photo', '????????????????????? ?????????'),
(70, 'default', 'Note About Vehicle', '????????? ???????????????????????? ?????????????????????'),
(71, 'default', 'Note', '?????????'),
(72, 'default', 'Default', '??????????????????'),
(74, 'default', 'Status', '??????????????????'),
(75, 'default', 'SL No.', '?????? ?????? ??????'),
(76, 'default', 'ID No.', '???????????? ???????????????'),
(77, 'default', 'Update Successful!', '??????????????? ?????????!'),
(78, 'default', 'Please Try Again.', '????????????????????? ????????? ???????????? ?????????????????? ???????????????'),
(79, 'default', 'Latitude', '?????????????????????'),
(80, 'default', 'Space', '???????????????'),
(81, 'default', 'Limit', '???????????????'),
(82, 'default', 'Longitude', '??????????????????????????????'),
(83, 'default', 'Map Preview', '??????????????? ?????????????????????'),
(84, 'default', 'Parking Limit', '????????????????????? ???????????????'),
(85, 'default', 'Use Comma to Separate Input', '??????????????? ??????????????? ??????????????? ????????????????????? ????????????'),
(86, 'default', 'Edit Parking Zone', '????????????????????? ????????? ???????????????????????? ????????????'),
(87, 'default', 'Latitude & Longitude', '????????????????????? ??? ??????????????????????????????'),
(88, 'default', 'Time & Price', '???????????? ????????? ???????????????'),
(89, 'default', 'Time', '????????????'),
(90, 'default', 'Net Price', '????????? ???????????????'),
(91, 'default', 'Select Option', '???????????????????????? ????????????'),
(92, 'default', 'Every Single Unit', '???????????????????????? ????????? ???????????????'),
(94, 'default', 'Edit Price', '??????????????? ???????????????????????? ????????????'),
(95, 'default', 'Unit', '???????????????'),
(96, 'default', 'Offer Name', '???????????? ?????????'),
(97, 'default', 'Description', '??????????????????'),
(98, 'default', 'Discount', '????????????'),
(99, 'default', 'Start Date', '???????????? ???????????????'),
(100, 'default', 'End Date', '????????? ???????????????'),
(101, 'default', 'Edit Promo Code', '????????????????????? ????????? ???????????????????????? ????????????'),
(102, 'default', 'Phone', '?????????'),
(103, 'default', 'Message Sent!', '?????????????????? ?????????????????? ??????????????????!'),
(104, 'default', 'Send To', '?????????????????? ????????????'),
(105, 'default', 'Send', '???????????????'),
(106, 'default', 'Message', '??????????????????'),
(107, 'default', 'Subject', '???????????????'),
(108, 'default', 'Sender', '??????????????????'),
(109, 'default', 'Date', '???????????????'),
(110, 'default', 'Message Details', '?????????????????? ???????????????'),
(111, 'default', 'Receiver', '?????????????????????'),
(112, 'default', 'Confirm Password', '?????????????????????????????? ????????????????????? ????????????'),
(113, 'default', 'Photo', '?????????'),
(114, 'default', 'Created at', '???????????? ????????? ??????????????????'),
(115, 'default', 'Updated at', '??????????????? ????????? ??????????????????'),
(116, 'default', 'User Role', '???????????????????????????????????? ??????????????????'),
(117, 'default', 'Application Setting', '???????????????????????????????????? ???????????????'),
(118, 'default', 'Edit Profile', '???????????????????????? ???????????????????????? ????????????'),
(119, 'default', 'Application Title', '???????????????????????????????????? ?????????????????????'),
(120, 'default', 'Short Description / Slogan', '??????????????????????????? ??????????????? / ?????????????????????'),
(121, 'default', 'Favicon', '??????????????????'),
(122, 'default', 'Logo', '????????????'),
(123, 'default', 'Footer Text', '??????????????? ??????????????????'),
(124, 'default', 'Google Map', '???????????? ???????????????'),
(125, 'default', 'Google Map Api Key', '???????????? ??????????????? ??????????????? ??????'),
(126, 'default', 'Map Zoom Level', '??????????????? ????????? ???????????????'),
(127, 'default', 'Price Setting', '??????????????? ????????????????????????'),
(128, 'default', 'Currency & Vat', '?????????????????? ??? ???????????????'),
(129, 'default', 'Currency', '??????????????????'),
(130, 'default', 'Vat', '???????????????'),
(131, 'default', 'Delete Successful!', '??????????????? ?????????!'),
(132, 'default', 'Email History', '???????????? ??????????????????'),
(133, 'default', 'Email Campaign', '???????????? ????????????????????????????????????'),
(134, 'default', 'Mail Sent!', '????????? ??????????????????!'),
(135, 'default', 'Enter Receiver Email Address', '?????????????????? ???????????? ?????????????????? ???????????????'),
(136, 'default', 'Mail Driver', '???????????? ????????????'),
(137, 'default', 'Mail Host', '???????????? ???????????????'),
(138, 'default', 'Mail Port', '????????? ???????????????'),
(139, 'default', 'Username', '????????????????????????'),
(140, 'default', 'Encryption', '???????????????????????????'),
(141, 'default', 'Sendmail', 'Sendmail'),
(142, 'default', 'Email Setting', '??????????????? ???????????????'),
(143, 'default', 'Paid', '?????????????????????'),
(144, 'default', 'Not Paid', '????????????????????? ?????????'),
(145, 'default', 'Reports', '???????????????????????????'),
(146, 'default', 'Today\'s Booking', '??????????????? ???????????????'),
(147, 'default', 'Active Booking', '????????????????????? ???????????????'),
(148, 'default', 'Released', '???????????????'),
(149, 'default', 'Select Parking Zone', '????????????????????? ????????? ???????????????????????? ????????????'),
(150, 'default', 'Arrival Time', '?????????????????? ????????????'),
(151, 'default', 'Guest will \"Come and Go\"', '??????????????? ?????????  \"???????????? ????????? ????????? \"'),
(152, 'default', 'Select Space', '???????????????????????? ???????????????'),
(153, 'default', 'Departure Time', '???????????????????????? ????????????'),
(154, 'default', 'Available', '??????????????????'),
(155, 'default', 'Occupied', '????????????????????????'),
(156, 'default', 'Client ID', '?????????????????????????????? ????????????'),
(157, 'default', 'Booking Status', '??????????????? ??????????????????'),
(158, 'default', 'Payment Status', '????????????????????? ???????????????????????????'),
(159, 'default', 'Selected', '???????????????????????????'),
(160, 'default', 'Booking Now', '????????? ???????????????'),
(161, 'default', 'Pretend', '???????????????????????????'),
(162, 'default', 'Unpaid Booking', '?????????????????????????????? ???????????????'),
(163, 'default', 'Paid Booking', '????????? ???????????????'),
(164, 'default', 'Paid Now', '????????? ?????????????????????'),
(165, 'default', 'Booking ID', '??????????????? ????????????'),
(166, 'default', 'Total', '?????????'),
(167, 'default', 'Release', '???????????????'),
(168, 'default', 'Token', '???????????????'),
(169, 'default', 'All Booking', '?????? ???????????????'),
(170, 'default', 'Search', '???????????????????????????'),
(171, 'default', 'Filter', '?????????????????????'),
(172, 'default', 'Select Filter Type', '????????????????????? ????????? ???????????????????????? ????????????'),
(173, 'default', 'Release Time', '????????????????????? ????????????'),
(174, 'default', 'Total Amount', '????????? ??????????????????'),
(175, 'default', 'Grand Total', '?????????????????????'),
(176, 'default', 'Total Client', '????????? ??????????????????????????????'),
(177, 'default', 'This Year Booking', '?????? ????????? ???????????????'),
(178, 'default', 'From the Beginning ', '???????????? ???????????? ????????????'),
(179, 'default', 'Amount', '??????????????????'),
(180, 'default', 'Total Booking', '????????? ???????????????'),
(181, 'default', 'Recent Messages', '?????????????????????????????? ??????????????????'),
(182, 'default', 'View All', '??????????????? ??????'),
(183, 'default', 'Edit Client', '?????????????????????????????? ???????????????????????? ????????????'),
(184, 'default', 'Edit User', '????????????????????????????????? ???????????????????????? ????????????'),
(185, 'default', 'Due', '????????????'),
(186, 'default', 'You are not authorized to view this page!', '???????????? ?????? ???????????????????????? ??????????????? ???????????? ???????????????????????? ?????????!'),
(187, 'default', 'Super Admin', '??????????????? ????????????????????????'),
(188, 'default', 'Operator', '?????????????????????'),
(189, 'default', 'Net Amount', '????????? ??????????????????'),
(190, 'default', 'Vat Type', '??????????????? ??????????????????'),
(191, 'default', 'Fine Type', '???????????? ????????????'),
(192, 'default', 'Fine', '????????????'),
(193, 'default', 'Fixed', '??????????????????'),
(194, 'default', 'Percent', '???????????????'),
(195, 'default', 'Notification Setting', '?????????????????????????????? ???????????????'),
(196, 'default', 'SMS Notification', '?????????????????? ???????????????????????????'),
(197, 'default', 'Email Notification', '???-???????????? ???????????????????????????'),
(198, 'default', 'SMS Alert', '?????????????????? ??????????????????'),
(199, 'default', 'Minutes', '???????????????'),
(200, 'default', 'SMS Setting', '?????????????????? ???????????????'),
(201, 'default', 'Provider', '??????????????????????????????'),
(202, 'default', 'From', '????????????'),
(203, 'default', 'Mobile No.', '?????????????????? ??????'),
(204, 'default', 'API Key', 'API ??????'),
(205, 'default', 'SMS Campaign', '?????????????????? ??????????????????????????????'),
(206, 'default', 'New SMS', '???????????? ??????????????????'),
(207, 'default', 'SMS History', '?????????????????? ????????????????????????'),
(208, 'default', 'SMS Sent!', '?????????????????? ?????????????????? ??????????????????!'),
(209, 'default', 'SMS', '??????????????????'),
(210, 'default', 'Contact', '?????????????????????'),
(211, 'default', 'Bulk Email', '??????????????? ????????????'),
(212, 'default', 'User', '?????????????????????????????????'),
(213, NULL, 'Find Nearest Parking Lot', '??????????????????????????? ????????????????????? ?????? ??????????????????'),
(214, NULL, 'Cron Job Setting', '??????????????? ?????? ???????????????'),
(215, NULL, 'Website', '???????????????????????????'),
(216, 'default', 'Vehicle Types', '?????????????????? ?????????'),
(217, 'default', 'Vehicle Type', '?????????????????? ?????????'),
(218, 'default', 'Booking Time', '??????????????? ????????????'),
(219, 'default', 'Booking Period', '??????????????? ?????????????????????'),
(220, 'default', 'Extra Time Payment & Fine', '???????????????????????? ??????????????? ????????????  ?????????????????? ??? ????????????????????? '),
(221, 'default', 'Parking Lots', '????????????????????? ?????? '),
(222, 'english', 'ABOUT', '????????????????????????'),
(223, 'english', 'CONTACT US', '????????????????????? ????????????'),
(224, 'english', 'Register', '?????????????????????'),
(225, 'english', 'Login successful!', '????????? ????????????'),
(226, 'english', 'Booking History', '??????????????????????????? ??????????????????'),
(227, 'english', 'Print', '?????????????????????'),
(228, 'english', 'PayPal Setting', '??????????????? ???????????????'),
(229, 'english', 'Secret Key', '????????????????????? ??????'),
(230, 'english', 'Slider 1', '???????????????????????? ???'),
(231, 'english', 'Slider 2', '???????????????????????? ???'),
(232, 'english', 'Slider 3', '???????????????????????? ???'),
(233, 'english', 'Write something', '???????????? ???????????????'),
(234, 'english', 'Facebook URL', '?????????????????? ??????????????????'),
(235, 'english', 'Twitter URL', '?????????????????? ??????????????????'),
(236, 'english', 'YouTube URL', '?????????????????? ??????????????????'),
(237, 'english', 'Meta Description', '???????????? ??????????????????'),
(238, 'english', 'Meta Keyword', '???????????? ???????????????????????????');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0->Unseen, 1->Seen, 2->Delete',
  `receiver_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0->Unseen, 1->Seen, 2->Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES
(1, 2, 1, 'Test Subject', 'Test Message', '2018-04-04 08:32:25', 0, 1),
(2, 1, 2, 'Test Subject', 'Test Message', '2018-04-04 08:32:25', 0, 0),
(3, 1, 2, 'Test Subject 2', 'Officia velit laboriosam expedita voluptates. Doloremque eli..', '2018-04-12 08:32:25', 0, 0),
(4, 2, 1, 'Test Subject 3', 'Test Message 3', '2018-04-12 08:32:25', 0, 0),
(5, 1, 2, 'Test Subject 4', 'Test Message 4', '2018-04-12 08:32:25', 0, 0),
(6, 1, 2, 'Test Subject 5', 'Test Message 5', '2018-04-12 08:32:25', 0, 0),
(7, 1, 2, 'Test Subject 6', 'Test Message 6', '2018-04-12 08:32:25', 0, 0),
(8, 2, 1, 'Test', 'Test', '2018-04-15 05:14:45', 0, 0),
(9, 2, 3, 'Another Subject', 'Test', '2018-04-25 12:34:11', 0, 0),
(10, 2, 1, 'Test Subject', 'Test', '2018-04-25 12:34:46', 0, 0),
(11, 2, 1, 'Another Subject', 'Test', '2018-04-30 01:14:53', 0, 0),
(12, 1, 2, 'Hello', 'Hello John Doe', '2018-05-04 08:54:27', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@example.com', '$2y$10$hEVOID.E0EZbwuOTFFxyQehz2UEGJKx6/O4PswrEQdPZQpIJRkeZu', '2018-05-02 04:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `space` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`id`, `name`, `note`, `address`, `latitude`, `longitude`, `limit`, `space`, `status`) VALUES
(1, 'Concept Tower', NULL, 'Dhaka', '23.75654358103039', '90.39913415908813', '20', '20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1', 1),
(3, 'Central Plaza', NULL, 'Dhaka', '23.797439476340234', '90.42366027832031', '10', '10, 9, 8, 7, 6, 5, 4, 3, 2, 1', 1),
(4, 'BDBL Building', NULL, 'BDBL Building, Karwan Bazar, Dhaka', '23.74976075658071', '90.39323329925537', '20', '20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1', 1),
(5, 'Western Plaza', NULL, 'Saifurs', '23.81571855064589', '90.39853984532613', '20', 'A1, A2, A3, A4, A5, A6, A7, A8, A9,A10,B1,B2,B3,B4,B5,B6,B7,B8,B9,B10', 1),
(6, 'City Parking - Class A', NULL, 'City Parking - Class A', '23.764086983283196', '90.38857932124779', '20', '20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1', 1),
(7, 'City Parking - Class B', NULL, 'City Parking - Class B', '23.780652675467646', '90.40419530605004', '25', '25, 24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(10) UNSIGNED NOT NULL,
  `place_id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `time` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,1) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `place_id`, `vehicle_type_id`, `time`, `unit`, `price`, `note`, `status`) VALUES
(21, 6, 1, '30', 'minutes', 5.0, NULL, 1),
(22, 6, 1, '1', 'hours', 10.0, NULL, 1),
(23, 6, 1, '2', 'hours', 15.0, NULL, 1),
(24, 6, 1, '5', 'hours', 30.0, NULL, 1),
(25, 6, 1, '12', 'hours', 30.0, NULL, 1),
(26, 6, 1, '1', 'days', 50.0, NULL, 1),
(27, 6, 2, '1', 'days', 50.0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promocode` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `limit` int(11) NOT NULL,
  `used` int(11) NOT NULL DEFAULT 0,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`id`, `name`, `description`, `promocode`, `discount`, `limit`, `used`, `start_date`, `end_date`, `status`) VALUES
(1, 'Winter Offer', NULL, '12345', 10.00, 100, 19, '2018-01-17', '2020-03-31', 1),
(3, 'Summer offer', 'Test', '123456', 5.00, 20, 7, '2018-04-15', '2019-08-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scheduler`
--

CREATE TABLE `scheduler` (
  `id` int(10) UNSIGNED NOT NULL,
  `command` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_parameters` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arguments` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `expression` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_execution` datetime DEFAULT NULL,
  `without_overlapping` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scheduler`
--

INSERT INTO `scheduler` (`id`, `command`, `default_parameters`, `arguments`, `options`, `is_active`, `expression`, `description`, `last_execution`, `without_overlapping`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'inspire', NULL, NULL, NULL, 1, '0 0 1 1 * *', '', NULL, 1, '2018-04-25 14:38:43', '2018-04-25 14:49:40', '2018-04-25 14:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_1` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_1_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_2` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_2_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_3` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_3_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_enable` tinyint(1) NOT NULL DEFAULT 0,
  `footer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_api_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_zoom` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '7',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `vat` float(8,1) NOT NULL DEFAULT 0.0,
  `vat_type` tinyint(1) NOT NULL DEFAULT 1,
  `fine` float(8,1) NOT NULL DEFAULT 0.0,
  `fine_type` tinyint(1) NOT NULL DEFAULT 1,
  `sms_notification` tinyint(1) NOT NULL DEFAULT 0,
  `email_notification` tinyint(1) NOT NULL DEFAULT 0,
  `sms_alert` int(11) DEFAULT NULL,
  `paypal_client_id` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_secret_key` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `about`, `meta_keyword`, `meta_description`, `email`, `phone`, `address`, `favicon`, `logo`, `slider_1`, `slider_1_text`, `slider_2`, `slider_2_text`, `slider_3`, `slider_3_text`, `facebook`, `twitter`, `youtube`, `website_enable`, `footer`, `map_api_key`, `latitude`, `longitude`, `map_zoom`, `currency`, `vat`, `vat_type`, `fine`, `fine_type`, `sms_notification`, `email_notification`, `sms_alert`, `paypal_client_id`, `paypal_secret_key`) VALUES
(1, 'Smart Parking Lot', 'Parking is the act of stopping and disengaging a vehicle and leaving it unoccupied. Parking on one or both sides of a road is often permitted, though sometimes', 'Test', 'Test2', 'application@example.com', '+33658255205', '197/A, Free school street, Dhaka - 1205', 'public/assets/images/icons/favicon.png', 'public/assets/images/icons/logo.png', 'public/assets/images/icons/slider_1.png', 'Test  2', 'public/assets/images/icons/slider_2.png', NULL, 'public/assets/images/icons/slider_3.png', 'Test 3b', 'Facebook.com', 'twitter.com', 'linked.in', 1, '?? 2018 - 2019 Smart Parking Lot.', 'AIzaSyDDXkzEIj9sB3J_ohqT0woVWqAJQiyRmAE', '23.749937868096605', '90.39224624633789', '15', '???', 10.0, 1, 5.0, 0, 0, 0, NULL, 'EBWKjlELKMYqRNQ6sYvFo64FtaRLRR5BdHEESmha49TM', 'EO422dn3gQLgDbuwqTjzrFgFtaRLRR5BdHEESmha49TM');

-- --------------------------------------------------------

--
-- Table structure for table `sms_history`
--

CREATE TABLE `sms_history` (
  `id` int(11) NOT NULL,
  `sms_setting_id` int(11) NOT NULL,
  `client_id_no` varchar(20) DEFAULT NULL,
  `from` varchar(20) DEFAULT NULL,
  `to` varchar(20) DEFAULT NULL,
  `message` varchar(512) DEFAULT NULL,
  `response` varchar(512) DEFAULT NULL,
  `schedule_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-pending, 1-done, 2-high-priority'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_history`
--

INSERT INTO `sms_history` (`id`, `sms_setting_id`, `client_id_no`, `from`, `to`, `message`, `response`, `schedule_at`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(29, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000001, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-06 23:19:54', NULL, 1, 0),
(30, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000002, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-06 23:54:32', NULL, 1, 0),
(31, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000003, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:02:33', NULL, 1, 0),
(32, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000004, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:05:35', NULL, 1, 0),
(33, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000005, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:09:04', NULL, 1, 0),
(34, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000006, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:21:20', NULL, 1, 0),
(35, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000007, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:23:48', NULL, 1, 0),
(36, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000008, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:24:42', NULL, 1, 0),
(37, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000009, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:27:08', NULL, 1, 0),
(38, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000010, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:32:14', NULL, 1, 0),
(39, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000011, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:50:13', NULL, 1, 0),
(40, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000012, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:50:38', NULL, 1, 0),
(41, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000013, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 01:01:59', NULL, 1, 0),
(42, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000014, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 01:09:28', NULL, 1, 0),
(43, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000015, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-19 22:57:44', NULL, 1, 0),
(44, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000016, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-19 23:58:28', NULL, 1, 0),
(45, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000017, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-20 00:02:02', NULL, 1, 0),
(46, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000018, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-25 21:59:31', NULL, 1, 0),
(47, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000001, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-27 17:45:00', NULL, 1, 0),
(48, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000001, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-27 17:45:00', NULL, 1, 0),
(49, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000001, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-28 20:34:07', NULL, 1, 0),
(50, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000002, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-28 20:48:37', NULL, 1, 0),
(51, 1, NULL, 'Smart Parking Lot', '0123456789', 'Test', '{\"status\":true,\"message\":\"success: {\\n    \\\"message-count\\\": \\\"1\\\",\\n    \\\"messages\\\": [{\\n        \\\"status\\\": \\\"4\\\",\\n        \\\"error-text\\\": \\\"Bad Credentials\\\"\\n    }]\\n}\"}', NULL, '2019-07-28 23:42:45', NULL, 3, 1),
(52, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000003, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-08-17 15:49:55', NULL, 1, 0),
(53, 1, 'A0021', 'Smart Parking Lot', '3035678910', 'Smart Parking Lot. \nYour Booking ID: A000004, Client ID: A0021 and Booking Time: ', NULL, NULL, '2019-08-26 15:32:18', NULL, 1, 0),
(54, 1, 'A0021', 'Smart Parking Lot', '3035678910', 'Smart Parking Lot. \nYour Booking ID: A000005, Client ID: A0021 and Booking Time: ', NULL, NULL, '2019-08-26 16:27:38', NULL, 3, 0),
(55, 1, 'A0022', 'Smart Parking Lot', '3035678910', 'Smart Parking Lot. \nYour Booking ID: A000006, Client ID: A0022 and Booking Time: ', NULL, NULL, '2019-08-26 16:28:42', NULL, 3, 0),
(56, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000009, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-24 11:12:01', NULL, 0, 0),
(57, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000010, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-24 11:13:12', NULL, 0, 0),
(58, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000011, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-24 11:14:58', NULL, 0, 0),
(59, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000012, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-29 11:19:06', NULL, 0, 0),
(60, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000013, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-29 12:04:34', NULL, 0, 0),
(61, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000014, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-14 11:22:24', NULL, 0, 0),
(62, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000015, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-14 11:54:18', NULL, 0, 0),
(63, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000016, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-14 11:56:38', NULL, 0, 0),
(64, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000017, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-14 15:17:53', NULL, 0, 0),
(65, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000018, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-15 11:20:16', NULL, 0, 0),
(66, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000019, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-15 11:28:46', NULL, 0, 0),
(67, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:31:40', NULL, 0, 0),
(68, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:33:14', NULL, 0, 0),
(69, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:38:12', NULL, 0, 0),
(70, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:38:38', NULL, 0, 0),
(71, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:39:41', NULL, 0, 0),
(72, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000021, Client ID: A0023 and Booking Time: 2019-10-16 11:14:00', NULL, NULL, '2019-10-16 11:15:35', NULL, 0, 0),
(73, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:09:42', NULL, 0, 0),
(74, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:10:03', NULL, 0, 0),
(75, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:10:52', NULL, 0, 0),
(76, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:12:42', NULL, 0, 0),
(77, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:12:58', NULL, 0, 0),
(78, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:13:21', NULL, 0, 0),
(79, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:14:18', NULL, 0, 0),
(81, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000018, Client ID: A0023 and Booking Time: 2019-10-16 15:47:00', NULL, NULL, '2019-10-16 15:48:33', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sms_setting`
--

CREATE TABLE `sms_setting` (
  `id` int(11) NOT NULL,
  `provider` varchar(20) NOT NULL DEFAULT 'nexmo',
  `api_key` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `from` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0-inactive, 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_setting`
--

INSERT INTO `sms_setting` (`id`, `provider`, `api_key`, `username`, `password`, `from`, `status`) VALUES
(1, 'nexmo', 'b39edd600577b6b3bd16cc69aec82f05', 'yungong', '13906', 'Smart Parking Lot', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_role` varchar(20) DEFAULT 'operator',
  `place_id` varchar(128) DEFAULT NULL COMMENT 'multiple_id_of_parking_zone',
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `photo`, `remember_token`, `created_at`, `updated_at`, `user_role`, `place_id`, `status`) VALUES
(1, 'Administrator', 'superadmin@codekernel.net', '$2y$10$uy5YnzVc8YeyFuO5WjVVj.59RJsfMhHDBBj7Rwp4LZMUFytCvfPb2', NULL, 'zSuocH38D6FuGxrUcazn8j8F9TDQilpZAHijxkHmDa3vvgJ2aKGfo2YiSg8B', '2017-10-23 13:20:02', '2018-05-02 01:56:48', 'superadmin', NULL, 1),
(2, 'John Doe', 'admin@codekernel.net', '$2y$10$JqwVetKaTNDR8J5vKFuTzezsR6r1wCm9bVh2ja9wsMgnvsOZbeO/O', NULL, 'SlZbCMZ7qHz0YkwEFdxQjg2WHdtYV7hMVSpiBkPFa7CkH1SSnruFsFZQasSP', '2018-04-12 08:31:11', '2018-04-24 13:18:27', 'admin', NULL, 1),
(3, 'Jane', 'operator@codekernel.net', '$2y$10$Muri3PStFIlHGzTFmbjMeOGJtQH0Zpb0ptiU4B3a5rwsu0RIOXkIG', NULL, 'PKk7LBSG92pBtKCoMpahQ8ZQKKjdsT6gI6Qlgv0xb0OILCBKK3orQUGF1WRg', '2018-04-12 08:31:11', '2019-07-08 19:43:43', 'operator', '6,7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`id`, `name`, `description`, `status`) VALUES
(1, 'Car', NULL, 1),
(2, 'Bus', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_history`
--
ALTER TABLE `booking_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_vehicle`
--
ALTER TABLE `client_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_history`
--
ALTER TABLE `email_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_setting`
--
ALTER TABLE `email_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode`
--
ALTER TABLE `promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scheduler`
--
ALTER TABLE `scheduler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_email_unique` (`email`);

--
-- Indexes for table `sms_history`
--
ALTER TABLE `sms_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_setting`
--
ALTER TABLE `sms_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `booking_history`
--
ALTER TABLE `booking_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `client_vehicle`
--
ALTER TABLE `client_vehicle`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `email_history`
--
ALTER TABLE `email_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `email_setting`
--
ALTER TABLE `email_setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scheduler`
--
ALTER TABLE `scheduler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_history`
--
ALTER TABLE `sms_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `sms_setting`
--
ALTER TABLE `sms_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
