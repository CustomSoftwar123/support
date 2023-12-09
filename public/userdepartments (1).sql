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
-- Table structure for table `userdepartments`
--

CREATE TABLE `userdepartments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `InUse` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdepartments`
--

INSERT INTO `userdepartments` (`id`, `name`, `description`, `InUse`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'ED', '..', 1, '2022-04-01 15:25:24', '2022-04-16 18:09:10', 1, 2),
(2, 'Medical Inpatient', '.', 1, '2022-04-01 15:25:24', '2022-04-16 18:09:18', 1, 2),
(3, 'Surgial Inpatient', NULL, 1, '2022-04-16 18:09:21', NULL, 2, NULL),
(4, 'Paediatric inpatient', NULL, 1, '2022-04-16 18:09:25', NULL, 2, NULL),
(5, 'Renal in patient', NULL, 1, '2022-04-16 18:09:27', NULL, 2, NULL),
(6, 'Stepdown', NULL, 1, '2022-04-16 18:09:30', NULL, 2, NULL),
(7, 'Psychiatry inpatient', NULL, 1, '2022-04-16 18:09:33', NULL, 2, NULL),
(8, 'Gynae in Patient', NULL, 1, '2022-04-16 18:09:35', NULL, 2, NULL),
(9, 'Obstetrics inpatient', NULL, 1, '2022-04-16 18:09:40', NULL, 2, NULL),
(10, 'Out Patients', NULL, 1, '2022-04-16 18:09:43', NULL, 2, NULL),
(11, 'Radiology', NULL, 1, '2022-04-16 18:09:46', NULL, 2, NULL),
(12, 'Pharmacy', NULL, 1, '2022-04-16 18:09:49', NULL, 2, NULL),
(13, 'Physiotherapy', NULL, 1, '2022-04-16 18:09:52', NULL, 2, NULL),
(14, 'Dietetics', NULL, 1, '2022-04-16 18:09:55', NULL, 2, NULL),
(15, 'Laboratory', NULL, 1, '2022-04-16 18:09:58', NULL, 2, NULL),
(16, 'Clarical Support', NULL, 1, '2022-04-16 18:10:02', NULL, 2, NULL),
(17, 'Management', NULL, 1, '2022-04-16 18:10:06', NULL, 2, NULL),
(18, 'Chronic Disease', NULL, 1, '2022-04-16 18:10:10', NULL, 2, NULL),
(19, 'Anaesthetic', NULL, 1, '2022-04-16 18:10:13', NULL, 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userdepartments`
--
ALTER TABLE `userdepartments`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
