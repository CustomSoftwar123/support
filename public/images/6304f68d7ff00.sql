-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2022 at 02:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tickets`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) DEFAULT NULL,
  `department` int(11) NOT NULL DEFAULT 0,
  `subdepartment` int(11) DEFAULT 0,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `new` int(11) DEFAULT 0,
  `colorscheme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '#2678bd',
  `font` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_weight` int(11) DEFAULT NULL,
  `resolution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `department`, `subdepartment`, `status`, `phone`, `address`, `city`, `state`, `country`, `zip`, `file`, `created_at`, `updated_at`, `created_by`, `updated_by`, `remember_token`, `api_token`, `email_verified_at`, `new`, `colorscheme`, `font`, `font_link`, `font_weight`, `resolution`) VALUES
(1, 'System Admin', 'admin@hse.ie', '$2y$10$3JWrTTZm2rWGyRoeTXk1gONsOMZwUSANwNe6y6otdNPxIC/C24IFi', 0, 0, 0, 'Active', '12333', '1020', 'Adare', 'Carlow', 'Ireland', '54', '62fa4e9b312c7.jpg', NULL, NULL, NULL, NULL, 'Ae6ZWiXS3HKIKYezCUSt2VP7O0ZJmunt3D3xcJafTwNA1xQBm3ePYybAhUUW', 'yljEDGCDSBBu8IMVDYTRU7qmPQx4FwUZCSlKA4MX8CmU23QS9buacNgwCIs8', NULL, 0, '1976D2', 'Finlandica', 'https://fonts.googleapis.com/css2?family=Finlandica:wght@600&display=swap', 600, '100'),
(2, 'zain', 'd@gmail', '12345678', 1, 0, 0, 'Active', '123', 'ss', 'Abbeyleix', 'Cavan', 'Argentina', '545645', NULL, '2022-08-14 14:41:16', '2022-08-15 15:45:27', NULL, 1, NULL, NULL, NULL, 0, '1976D2', 'Finlandica', 'https://fonts.googleapis.com/css2?family=Finlandica:wght@600&display=swap', 600, '100'),
(4, 'asddggg', 'scc@gmail', '$2y$10$tooKutDjJHiPp.kaQy41MO5mTOgh45n1GdrVAVAe4G61LOzIM2CfO', 1, 0, 0, 'Active', 'ss', 'asff', 'Aghada - Farsid - Rostellan', 'Clare', 'Argentina', '545645', NULL, '2022-08-14 14:50:31', '2022-08-15 14:20:48', NULL, 1, NULL, NULL, NULL, 0, '1976D2', 'Finlandica', 'https://fonts.googleapis.com/css2?family=Finlandica:wght@600&display=swap', 600, '100'),
(5, 'hamza', 'hamza@gmail.com', '$2y$10$8T9q81f1Cw6DJXp3h6I05eSGD1e.sAVIp6JxoiJbEl3S9/kKEzTqm', 1, 0, 0, 'Active', 'ss', 'ss', '', '', '', '545645', NULL, '2022-08-14 18:11:31', '2022-08-15 15:46:53', NULL, 1, NULL, NULL, NULL, 0, '8BC1AA', 'Finlandica', 'https://fonts.googleapis.com/css2?family=Finlandica:wght@600&display=swap', 600, '100'),
(6, 'ali', 'ali@gmail.com', '$2y$10$7kVvxrZZFyVTrT1Y5TO3je/Q4xNCchntdBMM5mLtrWzmeODz2BHWq', 1, 0, 0, 'Active', '0900', 'Model Town', '', '', '', '5400', NULL, '2022-08-15 14:21:58', '2022-08-15 14:22:48', NULL, 1, NULL, NULL, NULL, 0, '#2678bd', NULL, NULL, NULL, NULL),
(7, 'new', 'n@gmail.com', '$2y$10$XeZ5HPXHQjmxUv3Hub3iHupL5q0XIo3snl/l.Dg7nWu0DFEBjxajm', 2, 0, 0, 'InActive', '090011', NULL, 'Adare', 'Donegal', NULL, NULL, 'default.jpg', '2022-08-15 14:37:09', NULL, 1, NULL, NULL, NULL, NULL, 0, '42A5F5', 'Kantumruy Pro', 'https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400&display=swap', NULL, '100'),
(8, 'nn', 'nnn@gmail', '$2y$10$fZJT4zPZNAfuP8IVergW5.x3hq123ujZ/UFIhwwd.cuTr7qT/i8Xu', 1, 0, 0, 'Pending', '123', 'Shad Bagh', 'Adamstown', 'Carlow', 'Belarus', 'sdfgg', 'default.jpg', '2022-08-17 13:38:35', NULL, 1, NULL, NULL, NULL, NULL, 0, '1976D2', 'Finlandica', 'https://fonts.googleapis.com/css2?family=Finlandica:wght@600&display=swap', 600, '100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
