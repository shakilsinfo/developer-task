-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2020 at 11:04 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `marital_atatus` int(3) DEFAULT NULL,
  `gender` int(3) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `parmanent_address` text DEFAULT NULL,
  `identity_proof_image` text DEFAULT NULL,
  `profile_image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `contact_no`, `nid`, `email_address`, `profession`, `marital_atatus`, `gender`, `present_address`, `parmanent_address`, `identity_proof_image`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'Mirza Tahmid Tajik', '01756116668', '123654787963258', 'tajik@gmail.com', 'Software Eng.', 1, 1, 'Uttara, Dhaka, Bangladesh', 'Uttara, Dhaka, Bangladesh', '511160419053410.jpg, 792160419053410.jpg', '722160419053410.png', '2019-04-15 23:34:10', '2019-04-15 23:34:10'),
(2, 'Atahar Sharif', '01723698544', '1254789632145896', 'sharif@gmail.com', 'Designer', 1, 1, 'Uttara, Dhaka, Bangladesh', 'Uttara, Dhaka, Bangladesh', '511160419053410.jpg, 792160419053410.jpg', '722160419053410.png', '2019-04-17 07:09:44', NULL),
(3, 'Arif Chowdhury', '01369857455', '45649813249874132', 'arif@gmail.com', 'Software Eng.', 1, 1, 'Uttara, Dhaka, Bangladesh', 'Uttara, Dhaka, Bangladesh', '511160419053410.jpg, 792160419053410.jpg', '722160419053410.png', '2019-04-17 07:11:21', NULL),
(4, 'Rehena Khatun', '0156721369', '56465419875132198411', 'rehena@gmail.com', 'Doctor', 2, 2, 'Dhaka', 'Dhaka, Bangladesh', '918210419071806.jpg, 954210419071806.jpg', '441210419071806.png', '2019-04-21 01:18:07', '2019-04-21 01:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer_bill`
--

CREATE TABLE `customer_bill` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `bill_month` tinyint(4) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1=paid,2=due',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_bill`
--

INSERT INTO `customer_bill` (`id`, `customer_id`, `bill_month`, `amount`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 9, '4000.00', 2020, 1, '2020-09-19 01:53:36', '2020-09-19 02:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `nid`, `phone_number`, `present_address`, `parmanent_address`, `profession`, `user_type`, `status`, `created_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$TL.z5bTB1dS5adoBj4Smg.fKA07vDFilwnY/omdhq.gKI/u0zLNUS', '653030718082426.jpg', '5050505050505', '0175585858585', 'Dhaka', 'Dhaka', NULL, 1, 1, 1, 'xW7f8wSidMVQmmrAkKeIdavhynG85n0BhD2Zl9W7uZg5I7bkwuOtxyrK7kCW', NULL, NULL),
(9, 'User1', 'user1@email.com', '$2y$10$nfEZC.8OHKQTDRTKMLPq8.jsSFgrQhjEhYk6VV/c258ItovMF17Wi', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '2020-09-19 00:29:51', '2020-09-19 00:29:51'),
(10, 'user2', 'user2@email.com', '$2y$10$p/NiFFq1HvizWTax91Yq6uAR6PPxyhgdjah4znC4QRSUaJW29thLu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '2020-09-19 00:29:51', '2020-09-19 00:29:51'),
(11, 'Demo Customer', 'customer1@gmail.com', '$2y$10$pqCXQy8alH1p9mrwuRNzmec.fB/35eJUMPVo3kyzpjVXSOHBXkCbO', NULL, NULL, '019000000000', 'mirpur, dhaka, bangladesh.', NULL, NULL, 2, 1, 1, NULL, '2020-09-19 01:10:40', '2020-09-19 01:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, '2018-11-13 01:59:56', '2018-11-13 01:59:56'),
(2, 'Customer', NULL, '2018-11-13 02:00:10', '2019-04-16 05:03:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `customer_bill`
--
ALTER TABLE `customer_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_bill`
--
ALTER TABLE `customer_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
