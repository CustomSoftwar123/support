-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2022 at 02:44 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocm`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticketattachments`
--

CREATE TABLE `ticketattachments` (
  `id` int(11) NOT NULL,
  `ticketid` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `mid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticketattachments`
--

INSERT INTO `ticketattachments` (`id`, `ticketid`, `filename`, `datetime`, `mid`) VALUES
(83, '62dc890b17664', '62dc893409109.webp', '2022-07-24 04:50:12', '62dc8924a93ad'),
(84, '62dc8ad6e8f5e', '62dc8aee80ccc.webp', '2022-07-24 04:57:34', NULL),
(85, '62dc890b17664', '62dcb5e906900.jpeg', '2022-07-24 08:00:57', '62dcb5cfc82e5'),
(86, '62dcb636dc1ea', '62dcb64815fdb.jpeg', '2022-07-24 08:02:32', NULL),
(87, '62dd4b2333323', '62dd6ce23702e.sql', '2022-07-24 21:01:38', '62dd6cd8e36d4'),
(88, '62dd4b2333323', '62dd6ced8d39a.jpeg', '2022-07-24 21:01:49', '62dd6cd8e36d4'),
(89, '62dd4b2333323', '62dd6d3b68288.jpeg', '2022-07-24 21:03:07', '62dd6d20de576'),
(90, '62dcb636dc1ea', '62dd733c30f8d.png', '2022-07-24 21:28:44', '62dd7329e782d'),
(91, '62dd774c7a679', '62dd778a5606b.jpeg', '2022-07-24 21:47:06', NULL),
(92, '62dd929dacc22', '62dd92cc5a79b.jpeg', '2022-07-24 23:43:24', NULL),
(93, '62dde4856cbd7', '62dde49cc61cf.png', '2022-07-25 05:32:28', NULL),
(94, '62deb56f51e2a', '62deb589e3afc.webp', '2022-07-25 20:23:53', NULL),
(95, '62deb56f51e2a', '62deb589e3b07.png', '2022-07-25 20:23:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticketmessages`
--

CREATE TABLE `ticketmessages` (
  `id` int(11) NOT NULL,
  `ticketid` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `mid` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticketmessages`
--

INSERT INTO `ticketmessages` (`id`, `ticketid`, `username`, `mid`, `message`, `user`, `created_at`, `created_by`) VALUES
(20, '62dc890b17664', 'admin@hse.ie', '62dc8924a93ad', 'issue resolved', 'client', '2022-07-24 04:50:13', 1),
(21, '62dc8ad6e8f5e', 'admin@hse.ie', '62dc8c54ce91d', 'closing this ticket!', 'client', '2022-07-24 05:03:48', 1),
(22, '62dc8ad6e8f5e', 'test@abc.com', '62dcb5ab49af7', 'closed', 'client', '2022-07-24 08:00:04', 7),
(23, '62dc890b17664', 'test@abc.com', '62dcb5cfc82e5', 'cant figure out this problem.', 'client', '2022-07-24 08:01:34', 7),
(24, '62dc890b17664', 'test@abc.com', '62dcb5cfc82e5', 'cant figure out this problem.', 'client', '2022-07-24 08:01:34', 7),
(25, '62dcb636dc1ea', 'admin@hse.ie', '62dd48150f520', 'unable to solve this please look into this.', 'client', '2022-07-24 18:26:19', 1),
(26, '62dcb636dc1ea', 'admin@hse.ie', '62dd48e2d0a7b', 'unable to solve this please look into this.', 'client', '2022-07-24 18:28:12', 1),
(27, '62dd4b2333323', 'admin@hse.ie', '62dd4b5c0b220', 'please look into this, thanks', 'client', '2022-07-24 18:38:55', 1),
(28, '62dd4b2333323', 'admin@ocm.ie', '62dd6d20de576', 'issue has been resolved', 'client', '2022-07-24 21:03:08', 1),
(29, '62dd4b2333323', 'admin@ocm.ie', '62dd6d20de576', 'issue has been resolved', 'client', '2022-07-24 21:03:14', 1),
(30, '62dcb636dc1ea', 'admin@hse.ie', '62dd7329e782d', 'unable to solve this please look into this.', 'client', '2022-07-24 21:28:46', 1),
(31, '62dd774c7a679', 'admin@hse.ie', '62dd7790f1477', 'please look into this', 'client', '2022-07-24 21:47:22', 1),
(32, '62dd774c7a679', 'admin@ocm.ie', '62dd8646ae0bf', 'issue has been resolved.', 'client', '2022-07-24 22:50:12', 1),
(33, '62dd774c7a679', 'admin@ocm.ie', '62dd8646ae0bf', 'issue has been resolved.', 'client', '2022-07-24 22:50:19', 1),
(34, '62dd774c7a679', 'admin@ocm.ie', '62dd8646ae0bf', 'issue has been resolved.', 'client', '2022-07-24 22:50:41', 1),
(35, '62dd774c7a679', 'admin@ocm.ie', '62dd8671994eb', 'resolved.', 'client', '2022-07-24 22:50:56', 1),
(36, '62dcb636dc1ea', 'agent@ocm.ie', '62dd86d37f66d', 'closed', 'client', '2022-07-24 22:52:27', 2),
(37, '62dd929dacc22', 'admin@hse.ie', '62dd9312ebd6e', 'please check', 'client', '2022-07-24 23:44:39', 1),
(38, '62dd929dacc22', 'sarmad@ocm.ie', '62dd9341f04ef', 'new reply', 'client', '2022-07-24 23:45:27', 1),
(39, '62dd929dacc22', 'admin@hse.ie', '62dd9355f1188', 'reply 2 wo b new', 'client', '2022-07-24 23:45:51', 1),
(40, '62dd929dacc22', 'sarmad@ocm.ie', '62dd937300be1', 'closed', 'client', '2022-07-24 23:46:18', 1),
(41, '62ddb1669ebff', 'admin@hse.ie', '62ddb17e48625', 'please look into', 'client', '2022-07-25 01:54:31', 1),
(42, '62ddb1669ebff', 'sarmad@ocm.ie', '62ddb1b86a9d2', 'this is the message', 'client', '2022-07-25 01:55:52', 1),
(43, '62ddb1669ebff', 'sarmad@ocm.ie', '62ddb1d8e5ab3', 'more time required to resolve this matter', 'client', '2022-07-25 01:56:10', 1),
(44, '62ddb1669ebff', 'sarmad@ocm.ie', '62ddb1eacb1fc', 'resolved', 'client', '2022-07-25 02:03:27', 1),
(45, '62dde4856cbd7', 'admin@hse.ie', '62dde4a1959c4', '..', 'client', '2022-07-25 05:32:38', 1),
(46, '62dde4d2b4cc1', 'admin@hse.ie', '62dde539b816d', 'cd', 'client', '2022-07-25 05:35:09', 1),
(47, '62deb56f51e2a', 'admin@hse.ie', '62deb59ccbad5', 'please look into this issue', 'client', '2022-07-25 20:24:57', 1),
(48, '62deb56f51e2a', 'sarmad@ocm.ie', '62deb6026b36f', 'the issue has been resolved. thanks', 'client', '2022-07-25 20:26:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ticketid` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `patientname` varchar(255) DEFAULT NULL,
  `requestid` int(11) DEFAULT NULL,
  `sampleid` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `internal` int(11) DEFAULT NULL,
  `requestedat` datetime DEFAULT NULL,
  `startedat` datetime DEFAULT NULL,
  `assignedat` datetime DEFAULT NULL,
  `assignedto` varchar(255) DEFAULT NULL,
  `business` varchar(255) DEFAULT NULL,
  `estresponse` int(11) DEFAULT NULL,
  `esttime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticketid`, `username`, `patientname`, `requestid`, `sampleid`, `subject`, `department`, `priority`, `message`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`, `internal`, `requestedat`, `startedat`, `assignedat`, `assignedto`, `business`, `estresponse`, `esttime`) VALUES
(12330, '62dc890b17664', 'admin@hse.ie', 'Brady Shauna | MRN 61109', 12412, 8000065, 'Request not saving when user try to add amylase with fbc', 'Technical Department', 'Critical', 'Request not saving when user try to add amylase with fbc please check this issue', '2022-07-24 04:49:54', 1, NULL, NULL, 'Closed', NULL, NULL, NULL, NULL, 'test@abc.com', 'OCM Portal', 2, 8),
(12331, '62dc8ad6e8f5e', 'admin@hse.ie', NULL, NULL, NULL, 'Facing problem in blood transfusion section', 'Technical Department', 'High', 'Facing problem in blood transfusion section, please check this matter. Thanks', '2022-07-24 04:57:35', 1, NULL, NULL, 'Closed', NULL, NULL, NULL, NULL, 'test@abc.com', 'OCM Portal', 2, 24),
(12332, '62dcb636dc1ea', 'test@abc.com', NULL, NULL, NULL, 'facing problem in blood transfusion section', 'Technical Department', 'Medium', 'facing problem in blood transfusion section \r\n<button type=\"button\" class=\"btn btn-primary float-right saveupdatebtn\" value=\"Submit\">Generate Ticket</button>', '2022-07-24 08:02:36', 7, NULL, NULL, 'Closed', 1, '2022-07-24 21:28:46', NULL, '2022-07-24 22:49:32', 'agent@ocm.ie', 'OCM Portal', 2, 48),
(12333, '62dd4b2333323', 'admin@hse.ie', NULL, NULL, NULL, 'Documents not uploading', 'Technical Department', 'Medium', 'Trying to upload some document in ocm, but getting error while uploading please resolve this issue asap.', '2022-07-24 18:38:32', 1, NULL, NULL, 'Closed', 1, '2022-07-02 21:28:46', NULL, NULL, NULL, 'OCM Portal', 2, 48),
(12334, '62dd774c7a679', 'admin@hse.ie', NULL, NULL, NULL, 'New issue detected in logs', 'Technical Department', 'High', 'New issue detected in logs please check this issue,', '2022-07-24 21:47:07', 1, NULL, NULL, 'Closed', 1, '2022-07-24 21:47:22', NULL, '2022-07-24 22:49:21', 'admin@ocm.ie', 'OCM Portal', 2, 24),
(12335, '62dd929dacc22', 'admin@hse.ie', 'Beagan Francis | MRN 118503', 12412, 12412412, 'No issue found in the software why ?', 'Technical Department', 'Medium', 'error occurred while adding new request in the above section.', '2022-07-24 23:43:25', 1, NULL, NULL, 'Closed', 1, '2022-07-24 23:44:39', NULL, '2022-07-24 23:45:13', 'sarmad@ocm.ie', 'OCM Portal', 2, 48),
(12336, '62ddb1669ebff', 'admin@hse.ie', NULL, NULL, NULL, 'Issue found in managing business profile', 'Technical Department', 'Critical', 'Issue found in managing business profile', '2022-07-25 01:54:18', 1, NULL, NULL, 'Closed', 1, '2022-07-25 01:54:31', NULL, '2022-07-25 01:55:18', 'sarmad@ocm.ie', 'OCM Portal', 2, 8),
(12337, '62dde4856cbd7', 'admin@hse.ie', NULL, NULL, NULL, 'Facing problem in blood transfusion section', 'Technical Department', 'Critical', 'Facing problem in blood transfusion section', '2022-07-25 05:32:30', 1, NULL, NULL, 'Processing', 1, '2022-07-25 05:32:38', NULL, '2022-07-25 05:35:33', 'sameer@ocm.ie', 'OCM Portal', 2, 8),
(12338, '62dde4d2b4cc1', 'admin@hse.ie', NULL, NULL, NULL, 'Documents not uploading', 'Technical Department', 'High', 'Documents not uploading , please check', '2022-07-25 05:35:01', 1, NULL, NULL, 'Processing', 1, '2022-07-25 05:35:09', NULL, '2022-07-25 22:33:21', 'sarmad@ocm.ie', 'OCM Portal', 4, 24),
(12339, '62deb56f51e2a', 'admin@hse.ie', NULL, NULL, NULL, 'facing problem in blood transfusion section', 'Technical Department', 'Critical', 'facing problem in blood transfusion section', '2022-07-25 20:23:55', 1, NULL, NULL, 'Closed', 1, '2022-07-25 20:24:57', NULL, '2022-07-25 20:25:50', 'sarmad@ocm.ie', 'OCM Portal', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `ticketstime`
--

CREATE TABLE `ticketstime` (
  `id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `response` varchar(255) NOT NULL,
  `resolution` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticketstime`
--

INSERT INTO `ticketstime` (`id`, `bid`, `type`, `response`, `resolution`) VALUES
(1, 1, 'Critical', '2', '8'),
(2, 1, 'High', '4', '24'),
(3, 1, 'Medium', '8', '48'),
(4, 1, 'Low', '12', '72');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticketattachments`
--
ALTER TABLE `ticketattachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketmessages`
--
ALTER TABLE `ticketmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketstime`
--
ALTER TABLE `ticketstime`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticketattachments`
--
ALTER TABLE `ticketattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `ticketmessages`
--
ALTER TABLE `ticketmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12340;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
