-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 12:38 PM
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
-- Database: `text4pay`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_addresses`
--

CREATE TABLE `billing_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `city` varchar(125) DEFAULT NULL,
  `postal_code` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_addresses`
--

INSERT INTO `billing_addresses` (`id`, `user_id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `postal_code`, `country`, `phone`, `state`, `created_at`, `updated_at`) VALUES
(1, 3, 'sdv', 'sdv', 'sdv', 'sdv', 'sdv', 'sdv', 'sdv', 'sdv', 'sdv', '2021-06-28 04:00:36', '2021-06-28 04:00:36'),
(2, 4, 'sdbsdb', 'sdb', 'sdbsdb', 'sdb', 'sdbsdb', 'bsdb', 'sdb', 'sdb', 'sdb', '2021-06-28 04:03:07', '2021-06-28 04:03:07'),
(3, 5, 'sdvsdv', 'sdv', 'sdvsdv', 'sdvsd', 'vsdvs', 'dvsdv', 'sdvsdv', 'sdvdsvsd', 'vsdvds', '2021-06-28 04:08:01', '2021-06-28 04:08:01'),
(4, 6, 'sdvdsv', 'sdvsd', 'vsdvsd', 'vsdvds', 'vsdv', 'dsvsdv', 'vsdvsdv', 'sdvsd', 'vsdv', '2021-06-28 04:08:53', '2021-06-28 04:08:53'),
(5, 15, 'fbsdb', 'sdvsd', 'vsd', 'vsdv', 'vds', 'vsdv', 'sdvsd', 'vsdvsd', 'vsdv', '2021-06-28 14:50:21', '2021-06-28 14:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `contact_generators`
--

CREATE TABLE `contact_generators` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `search_key` varchar(120) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `contact_file` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_generators`
--

INSERT INTO `contact_generators` (`id`, `user_id`, `search_key`, `status`, `contact_file`, `created_at`, `updated_at`) VALUES
(1, 16, '123GF', 0, NULL, '2021-06-29 14:42:49', '2021-06-29 14:42:49'),
(2, 16, '123AC', 1, 'contact_1625052292.txt', '2021-06-29 14:42:49', '2021-06-30 06:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referrer_id` int(11) DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_package` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `package_validation` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `referrer_id`, `payment_id`, `username`, `email`, `email_verified_at`, `password`, `website`, `current_package`, `package_validation`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 'admin@admin.com', NULL, '$2y$10$lcq4pY8KgWyK9o9TB0gZsO8aCnO3UmTmmRrx9XvSvhtaArR8Kx75q', 'text4pay', 'free', NULL, 'admin', NULL, '2021-05-24 09:14:00', '2021-05-24 09:14:00'),
(2, NULL, NULL, NULL, 'user@email.com', NULL, '$2y$10$YaXH5BTIN4iNV2D.beJGzuIMbNSWrrqrRBP7mZWxT3WH3orwpEzY2', 'text4pay', 'free', NULL, 'user', NULL, '2021-05-24 16:27:16', '2021-05-24 16:27:16'),
(3, NULL, NULL, NULL, 'sdsvd@fdb.fb', NULL, '$2y$10$a8ZEY1XNpfCjNc.xeyMQ7uj6djax.fJlKZahxdG5AJ2DaNY46zZXu', 'text4pay', 'free', NULL, 'user', NULL, '2021-06-28 04:00:36', '2021-06-28 04:00:36'),
(4, NULL, NULL, NULL, 'sdsdvs@dfb.dfb', NULL, '$2y$10$gTkniVwVQRgCbzT8lK3KJ.whHoUCwSIFKVutRc4Tr3//cfIlN7D42', 'text4pay', 'free', NULL, 'user', NULL, '2021-06-28 04:03:07', '2021-06-28 04:03:07'),
(5, NULL, 'ch_1J7GRhKuGDN8tiVq6cL6dEdL', 'dsdsv', 'dsvsdv@th.yul', NULL, '$2y$10$bpiPK0IbYm5SEtP4UrjHNuRmitYfAFcjTJ1DIpWnVhpMt7wqKaJQS', 'text4pay', 'PRODUCTS', NULL, 'user', NULL, '2021-06-28 04:08:01', '2021-06-28 04:08:01'),
(6, 16, 'ch_1J7GSWKuGDN8tiVquQ31QdLa', 'asdvsa', 'asvasv@sdfb.dfb', NULL, '$2y$10$Xcl80UBxd.RrJxzRPvT/0eGJ.P7is94m8KjeiPedzbpK.jDGwP4K.', 'text4pay', 'PRODUCTS', NULL, 'user', NULL, '2021-06-28 04:08:53', '2021-06-28 04:08:53'),
(14, 16, NULL, 'ascasc@sdfv.dfb', 'ascasc@sdfv.dfb', NULL, '$2y$10$poIMaPMaQ4Fk2EhAzaLz1el8uSk0g0vWpOs0Q8zEPE2ZDpMO2/5iO', 'text4pay', 'free', NULL, 'user', NULL, '2021-06-28 14:35:17', '2021-06-28 14:35:17'),
(15, 16, 'ch_1J7QTIKuGDN8tiVqbfcR53VT', 'dvsdv', 'dvsvd@ser.fgnrtn', NULL, '$2y$10$51bSiEvkUfXIwpGCCQ6ojeYYIoXT4vE0af2BkpO6D1nWzvCDv6Jge', 'text4pay', 'unlimited', NULL, 'user', NULL, '2021-06-28 14:50:21', '2021-06-28 14:50:21'),
(16, 0, 'ch_1J899dKuGDN8tiVqAw87XdaT', 'abdul', 'basit@gmail.com', NULL, '$2y$10$EyBJu01Nms4Ia8qkO9TCGu7/H6a3pBTdATF1.0b94mC49oa/QL1la', 'automatedcontactgenerator', '2', '2021-07-07 19:33:01', 'user', NULL, '2021-06-29 13:20:53', '2021-06-30 14:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_package_details`
--

CREATE TABLE `user_package_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `package_name` varchar(125) DEFAULT NULL,
  `package_price` varchar(25) DEFAULT NULL,
  `package_start_date` varchar(255) DEFAULT NULL,
  `package_end_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_package_details`
--

INSERT INTO `user_package_details` (`id`, `user_id`, `payment_id`, `package_name`, `package_price`, `package_start_date`, `package_end_date`, `created_at`, `updated_at`) VALUES
(2, 16, 'ch_1J899dKuGDN8tiVqAw87XdaT', '1 week', '100', '2021-06-30 19:33:01', '2021-07-07 19:33:01', '2021-06-30 14:33:01', '2021-06-30 14:33:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_addresses`
--
ALTER TABLE `billing_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_generators`
--
ALTER TABLE `contact_generators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_package_details`
--
ALTER TABLE `user_package_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_addresses`
--
ALTER TABLE `billing_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_generators`
--
ALTER TABLE `contact_generators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_package_details`
--
ALTER TABLE `user_package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
