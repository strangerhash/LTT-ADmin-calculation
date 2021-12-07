-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2021 at 06:09 AM
-- Server version: 10.3.32-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iscuahvw_iscube`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', NULL, NULL),
(1, 'super_admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_admin_user`
--

CREATE TABLE `admin_role_admin_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_role_id` bigint(20) UNSIGNED NOT NULL,
  `admin_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_role_admin_user`
--

INSERT INTO `admin_role_admin_user` (`id`, `admin_role_id`, `admin_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `fullname`, `password`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'spadmin', 'SP Admin', '$2y$10$H6Rw.sI4VKrq.K0TAgNCluJlpQoymZ6A63Xz5JbjeSQ...', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `digital_thrift_transactions`
--

CREATE TABLE `digital_thrift_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `paymentmethod` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `digital_thrift_transactions`
--

INSERT INTO `digital_thrift_transactions` (`id`, `user_id`, `amount`, `quantity`, `paymentmethod`, `date_created`) VALUES
(1, 5, 8000.00, 2, 4, '2020-04-05 06:38:01'),
(2, 5, 8000.00, 2, 4, '2020-04-06 07:36:36'),
(3, 2, 4000.00, 1, 6, '2020-12-14 13:02:51'),
(1, 5, 8000.00, 2, 4, '2020-04-05 06:38:01'),
(2, 5, 8000.00, 2, 4, '2020-04-06 07:36:36'),
(3, 2, 4000.00, 1, 6, '2020-12-14 13:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `earning_histories`
--

CREATE TABLE `earning_histories` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL COMMENT 'Account ID',
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Amount involved in transaction',
  `purpose` varchar(200) NOT NULL COMMENT 'Reason why the transaction occurred',
  `trans_type` int(1) NOT NULL COMMENT '0 - Credit or 1 - Debit',
  `date_created` datetime NOT NULL COMMENT 'Date of transaction'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fund_deposit`
--

CREATE TABLE `fund_deposit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fund_deposit`
--

INSERT INTO `fund_deposit` (`id`, `user_id`, `amount`, `payment_method`, `status`, `date_created`) VALUES
(1, 14, '5000', 'e-wallet', 1, '2021-03-14 07:50:24'),
(3, 4, '4545', 'other', 1, '2021-03-14 12:18:00'),
(4, 16, '65656', 'e-wallet', 1, '2021-03-14 12:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `fund_wallet`
--

CREATE TABLE `fund_wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `file_name` varchar(225) DEFAULT NULL,
  `depositor_name` varchar(225) DEFAULT NULL,
  `verified` int(1) NOT NULL,
  `payment_method` int(1) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_wallet`
--

INSERT INTO `fund_wallet` (`id`, `user_id`, `amount`, `file_name`, `depositor_name`, `verified`, `payment_method`, `date_created`, `date_updated`) VALUES
(1, 4, 100.00, NULL, NULL, 1, 2, '2020-06-30 19:26:30', NULL),
(2, 4, 100.00, '1593531193.png', 'WILLIAMS OLUMIDE', 0, 1, '2020-06-30 19:33:13', NULL),
(3, 4, 100.00, '1593531276.png', 'WILLIAMS OLUMIDE', 1, 1, '2020-06-30 19:34:36', '2020-06-30 19:38:57'),
(4, 4, 100.00, '1593534064.png', 'WILLIAMS OLUMIDE', 0, 1, '2020-06-30 20:21:04', NULL),
(5, 4, 100.00, '1593534227.png', 'WILLIAMS OLUMIDE', 0, 1, '2020-06-30 20:23:47', NULL),
(6, 4, 100.00, '1593534289.png', 'WILLIAMS OLUMIDE', 0, 1, '2020-06-30 20:24:49', NULL),
(7, 4, 100.00, '1593534343.png', 'WILLIAMS OLUMIDE', 0, 1, '2020-06-30 20:25:43', NULL),
(8, 2, 1000.00, '1593534892.jpg', 'spadmin', 0, 1, '2020-06-30 20:34:52', NULL),
(9, 2, 2000.00, '1593582751.jpg', 'jsdhfjdshfj', 0, 1, '2020-07-01 09:52:31', NULL),
(10, 2, 1000.00, '1_1593584314.jpg', 'YYYYY', 0, 1, '2020-07-01 10:18:34', NULL),
(11, 2, 1000.00, '87f32728-9482-4d4d-9724-9159d0e3b301_1593586548.jpg', 'YYYYYuuuu', 0, 1, '2020-07-01 10:55:48', NULL),
(12, 2, 5000.00, '87f32728-9482-4d4d-9724-9159d0e3b301_1593588565.jpg', 'YYYYYuuuu', 1, 1, '2020-07-01 11:29:25', '2020-07-01 22:34:43'),
(13, 2, 5000.00, 'f958cbd8-af77-4a5d-bec2-222565060da5_1593590154.jpg', 'Mesh Manuel', 1, 1, '2020-07-01 11:55:54', '2020-07-01 11:57:40'),
(14, 4, 100.00, 'IMG-20200701-WA0012_1593595370.jpg', 'WILLIAMS OLUMIDE', 1, 1, '2020-07-01 13:22:50', '2021-03-11 20:33:24'),
(15, 2, 100.00, NULL, NULL, 1, 2, '2021-06-18 16:39:56', NULL),
(16, 2, 100.00, NULL, NULL, 1, 2, '2021-06-21 18:11:10', NULL),
(17, 2, 100.00, NULL, NULL, 1, 2, '2021-06-22 17:07:35', NULL),
(18, 4, 100.00, NULL, NULL, 1, 2, '2021-10-26 15:53:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matrices`
--

CREATE TABLE `matrices` (
  `id` int(11) NOT NULL COMMENT 'matrix id',
  `user_id` int(11) NOT NULL COMMENT 'id of the user from users table',
  `current_matrix` int(11) NOT NULL COMMENT 'current matrix of the user',
  `total_users` int(11) NOT NULL COMMENT 'total users in this matrix',
  `is_filled` int(11) NOT NULL COMMENT 'check if this matrix is filled',
  `date_created` datetime NOT NULL COMMENT 'Time and date this matrix was created'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `matrices_`
--

CREATE TABLE `matrices_` (
  `id` int(11) NOT NULL COMMENT 'matrix id',
  `user_id` int(11) NOT NULL COMMENT 'id of the user from users table',
  `current_matrix` int(11) NOT NULL COMMENT 'current matrix of the user',
  `quorum_0` datetime DEFAULT NULL COMMENT 'Time and date this Quorum 0 matrix was created',
  `quorum_1` datetime DEFAULT NULL COMMENT 'Time and date this Quorum 1 matrix was created',
  `quorum_2` datetime DEFAULT NULL COMMENT 'Time and date this Quorum 2 matrix was created',
  `quorum_3` datetime DEFAULT NULL COMMENT 'Time and date this Quorum 3 matrix was created',
  `quorum_4` datetime DEFAULT NULL COMMENT 'Time and date this Quorum 4 matrix was created',
  `quorum_5` datetime DEFAULT NULL COMMENT 'Time and date this Quorum 5 matrix was created'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matrices_`
--

INSERT INTO `matrices_` (`id`, `user_id`, `current_matrix`, `quorum_0`, `quorum_1`, `quorum_2`, `quorum_3`, `quorum_4`, `quorum_5`) VALUES
(1, 1, 0, '2020-03-03 07:10:45', NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, '2020-03-20 22:45:35', '2020-12-14 13:03:43', NULL, NULL, NULL, NULL),
(3, 4, 0, '2020-03-21 00:15:52', NULL, NULL, NULL, NULL, NULL),
(4, 5, 0, '2020-03-21 00:32:52', NULL, NULL, NULL, NULL, NULL),
(5, 9, 0, '2020-03-23 20:40:17', NULL, NULL, NULL, NULL, NULL),
(6, 7, 0, '2020-04-03 07:28:27', NULL, NULL, NULL, NULL, NULL),
(7, 20, 0, '2020-04-04 20:15:53', NULL, NULL, NULL, NULL, NULL),
(8, 19, 0, '2020-04-04 20:41:23', NULL, NULL, NULL, NULL, NULL),
(9, 14, 0, '2020-04-14 12:52:03', NULL, NULL, NULL, NULL, NULL),
(10, 27, 0, '2020-04-19 22:46:43', NULL, NULL, NULL, NULL, NULL),
(11, 33, 0, '2020-05-01 21:47:50', NULL, NULL, NULL, NULL, NULL),
(1, 1, 0, '2020-03-03 07:10:45', NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, '2020-03-20 22:45:35', '2020-12-14 13:03:43', NULL, NULL, NULL, NULL),
(3, 4, 0, '2020-03-21 00:15:52', NULL, NULL, NULL, NULL, NULL),
(4, 5, 0, '2020-03-21 00:32:52', NULL, NULL, NULL, NULL, NULL),
(5, 9, 0, '2020-03-23 20:40:17', NULL, NULL, NULL, NULL, NULL),
(6, 7, 0, '2020-04-03 07:28:27', NULL, NULL, NULL, NULL, NULL),
(7, 20, 0, '2020-04-04 20:15:53', NULL, NULL, NULL, NULL, NULL),
(8, 19, 0, '2020-04-04 20:41:23', NULL, NULL, NULL, NULL, NULL),
(9, 14, 0, '2020-04-14 12:52:03', NULL, NULL, NULL, NULL, NULL),
(10, 27, 0, '2020-04-19 22:46:43', NULL, NULL, NULL, NULL, NULL),
(11, 33, 0, '2020-05-01 21:47:50', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matrix_details`
--

CREATE TABLE `matrix_details` (
  `id` int(11) NOT NULL,
  `matrix_id` int(11) NOT NULL COMMENT 'references who owns this matrix_details in the matrices table',
  `members_id` int(11) DEFAULT NULL COMMENT 'those who filled up the matrix',
  `position_on_chart` int(11) NOT NULL COMMENT 'displays their position on the chart',
  `date_created` datetime NOT NULL COMMENT 'the day the matrix was created',
  `date_filled` datetime DEFAULT NULL COMMENT 'the day the matrix was filled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `matrix_incentives`
--

CREATE TABLE `matrix_incentives` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `level` int(10) DEFAULT NULL,
  `incentive_id` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_collected` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matrix_incentives`
--

INSERT INTO `matrix_incentives` (`id`, `user_id`, `level`, `incentive_id`, `date_created`, `date_collected`) VALUES
(1, 2, 0, NULL, '2020-12-14 13:03:43', NULL),
(1, 2, 0, NULL, '2020-12-14 13:03:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matrix_transactions`
--

CREATE TABLE `matrix_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry` varchar(11) DEFAULT NULL,
  `paymentmethod` int(11) DEFAULT NULL,
  `is_commission` int(11) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matrix_transactions`
--

INSERT INTO `matrix_transactions` (`id`, `user_id`, `entry`, `paymentmethod`, `is_commission`, `amount`, `comment`, `date_created`) VALUES
(1, 4, 'credit', 4, NULL, 5000.00, 'Account Upgrade', '2020-03-21 04:15:53'),
(2, 4, 'debit', 12, NULL, 5000.00, 'Account Upgrade', '2020-03-21 04:15:53'),
(3, 5, 'credit', 4, NULL, 5000.00, 'Account Upgrade', '2020-03-21 04:32:53'),
(4, 5, 'debit', 12, NULL, 5000.00, 'Account Upgrade', '2020-03-21 04:32:53'),
(5, 2, 'credit', 4, NULL, 5000.00, 'Account Upgrade', '2020-03-21 04:15:53'),
(6, 2, 'debit', 12, NULL, 5000.00, 'Account Upgrade', '2020-03-21 04:15:53'),
(7, 9, 'credit', 4, NULL, 5000.00, 'Account Upgrade', '2020-03-24 00:40:17'),
(8, 9, 'debit', 12, NULL, 5000.00, 'Account Upgrade', '2020-03-24 00:40:17'),
(9, 7, 'credit', 4, NULL, 5000.00, 'Account Upgrade', '2020-04-03 11:28:28'),
(10, 7, 'debit', 12, NULL, 5000.00, 'Account Upgrade', '2020-04-03 11:28:28'),
(11, 20, 'credit', 4, NULL, 5000.00, 'Account Upgrade', '2020-04-05 00:15:53'),
(12, 20, 'debit', 12, NULL, 5000.00, 'Account Upgrade', '2020-04-05 00:15:53'),
(13, 19, 'credit', 4, NULL, 5000.00, 'Account Upgrade', '2020-04-05 00:41:24'),
(14, 19, 'debit', 12, NULL, 5000.00, 'Account Upgrade', '2020-04-05 00:41:24'),
(15, 5, 'credit', 4, NULL, 8000.00, 'Purchase of 2 STT Unit(s)', '2020-04-05 10:38:01'),
(16, 5, 'debit', 12, NULL, 8000.00, 'Purchase of 2 STT Unit(s)', '2020-04-05 10:38:01'),
(17, 5, 'credit', 4, NULL, 8000.00, 'Purchase of 2 STT Unit(s)', '2020-04-06 11:36:36'),
(18, 5, 'debit', 12, NULL, 8000.00, 'Purchase of 2 STT Unit(s)', '2020-04-06 11:36:36'),
(19, 14, 'credit', 4, NULL, 5175.00, 'Account Upgrade and Transaction Charge', '2020-04-14 16:52:03'),
(20, 14, 'debit', 12, NULL, 5175.00, 'Account Upgrade and Transaction Charge', '2020-04-14 16:52:03'),
(21, 27, 'credit', 4, NULL, 5175.00, 'Account Upgrade and Transaction Charge', '2020-04-20 02:46:43'),
(22, 27, 'debit', 12, NULL, 5175.00, 'Account Upgrade and Transaction Charge', '2020-04-20 02:46:43'),
(23, 33, 'credit', 4, NULL, 5175.00, 'Account Upgrade and Transaction Charge', '2020-05-02 01:47:50'),
(24, 33, 'debit', 12, NULL, 5175.00, 'Account Upgrade and Transaction Charge', '2020-05-02 01:47:50'),
(25, 4, 'credit', 4, NULL, 100.00, 'Wallet Funding', '2020-06-30 19:26:30'),
(26, 4, 'credit', 5, NULL, 100.00, 'Wallet Funding', '2020-06-30 19:38:57'),
(27, 2, 'credit', 5, NULL, 5000.00, 'Wallet Funding', '2020-07-01 11:57:40'),
(28, 2, 'credit', 5, NULL, 5000.00, 'Wallet Funding', '2020-07-01 22:34:43'),
(29, 21, 'credit', 6, 1, 4200.00, 'Short Term Thrift completed.', '2020-07-03 16:00:02'),
(30, 5, 'credit', 6, 1, 4200.00, 'Completed Thrift for courtesy_1', '2020-07-03 16:00:02'),
(31, 22, 'credit', 6, 1, 4200.00, 'Short Term Thrift completed.', '2020-07-03 16:00:02'),
(32, 5, 'credit', 6, 1, 4200.00, 'Completed Thrift for courtesy_2', '2020-07-03 16:00:02'),
(33, 24, 'credit', 6, 1, 4200.00, 'Short Term Thrift completed.', '2020-07-04 16:00:03'),
(34, 5, 'credit', 6, 1, 4200.00, 'Completed Thrift for courtesy_3', '2020-07-04 16:00:03'),
(35, 25, 'credit', 6, 1, 4200.00, 'Short Term Thrift completed.', '2020-07-04 16:00:03'),
(36, 5, 'credit', 6, 1, 4200.00, 'Completed Thrift for courtesy_4', '2020-07-04 16:00:03'),
(37, 2, 'debit', 6, NULL, 4000.00, 'Purchase of 1 STT units', '2020-12-14 18:02:51'),
(38, 2, 'debit', 6, NULL, 1200.00, 'Purchase of 1 LTT units', '2020-12-14 18:04:31'),
(39, 2, 'credit', 4, NULL, 100.00, 'Wallet Funding', '2021-06-18 12:39:56'),
(40, 2, 'credit', 6, 1, 100.00, 'Withdrawal from LLT Account', '2021-06-18 13:04:48'),
(41, 2, 'credit', 4, NULL, 100.00, 'Wallet Funding', '2021-06-21 14:11:10'),
(42, 2, 'credit', 4, NULL, 100.00, 'Wallet Funding', '2021-06-22 13:07:35'),
(43, 2, 'credit', 6, 1, 100.00, 'Withdrawal from LLT Account', '2021-07-08 18:34:22'),
(44, 4, 'credit', 4, NULL, 100.00, 'Wallet Funding', '2021-10-26 11:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `matrix_types`
--

CREATE TABLE `matrix_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'this is the name of the matrix for users e.g. the name of the stage (Stage 1, Stage 2 etc)',
  `code` int(11) NOT NULL COMMENT 'matrix code is the numeric representation of the matrix which is same as current_matrix in other tables',
  `required_number` int(10) NOT NULL COMMENT 'Number of users required to fill up this matrix',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matrix_types`
--

INSERT INTO `matrix_types` (`id`, `name`, `code`, `required_number`, `date_created`) VALUES
(1, 'Intro', 0, 12, '2019-08-09 08:51:00'),
(2, 'Quorum 1', 1, 12, '2019-08-09 08:51:00'),
(3, 'Quorum 2', 2, 12, '2019-08-09 08:51:00'),
(4, 'Quorum 3', 3, 12, '2019-11-28 05:16:00'),
(5, 'Quorum 4', 4, 12, '2019-11-28 05:16:00'),
(6, 'Quorum 5', 5, 24, '2019-11-28 05:16:00'),
(1, 'Intro', 0, 12, '2019-08-09 08:51:00'),
(2, 'Quorum 1', 1, 12, '2019-08-09 08:51:00'),
(3, 'Quorum 2', 2, 12, '2019-08-09 08:51:00'),
(4, 'Quorum 3', 3, 12, '2019-11-28 05:16:00'),
(5, 'Quorum 4', 4, 12, '2019-11-28 05:16:00'),
(6, 'Quorum 5', 5, 24, '2019-11-28 05:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_03_09_233426_create_tracking_table', 1),
(2, '2020_03_09_233426_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('meshmmanuel@yahoo.com', '$2y$10$QQIGoygFS8KoHSgObr9tD.S0G.qr3lZwaBe4NEhMdvdxcazu2S2Mi', '2020-02-18 13:35:43'),
('topwealth99@gmail.com', '$2y$10$82eYG3YC1qujuvTBccpype4Y8YPrxBz4K1gp3oN6wTH8L/Zkz2mQq', '2020-04-04 21:17:34'),
('risquat@yahoo.com', '$2y$10$WfDajjEHFEK6N79yadgODOBecmVdNZhU3IBa01tOEwbZLqUC17yoq', '2020-04-14 16:30:06'),
('ibikunleoluwaseun26@gmail.com', '$2y$10$Dm9CSWyj3p6I3BbtfnGnd.hC2UufvL7lnZ7EAW3H9IL3YjoOTL1p6', '2020-04-22 18:50:28'),
('jram.snh@gmail.com', '$2y$10$ynRmtEHecbW.Rac4AlRhe..Po/BtadOqfalzTdrezw5SnLQy.AYEa', '2021-11-12 18:41:14'),
('iscubeco@gmail.com', '$2y$10$FhmnOTEFDFLF9xRLJxQBrO8tr1onKKiybatag2.qZ66k/FHKetNs2', '2021-11-17 16:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `paystack_transactions`
--

CREATE TABLE `paystack_transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paystack_transactions`
--

INSERT INTO `paystack_transactions` (`id`, `transaction_id`, `date_created`) VALUES
(1, 'gRt81sCsOYmjWheQW4ql7RLeS', '2020-03-20 22:45:35'),
(3, 'TgqYCAQXWDmgNGk2RkcAq2v7O', '2020-03-21 00:15:51'),
(4, 'QfL9yTrXTtOwfADCLcFMBJAp6', '2020-03-21 00:32:51'),
(5, 'fpZN8R2cF00qMOmt9ifRDgIMZ', '2020-03-23 20:40:17'),
(6, '1x3QSTyTgjwsYm1D3EA4YF6NP', '2020-04-03 07:28:27'),
(7, 'ZC70MhApUSL3cxCNimmVVuKfZ', '2020-04-04 20:15:53'),
(8, 'jrQn1OwTpWDyfJ2NozhVFHhpt', '2020-04-04 20:41:23'),
(9, 'oOZBAUWwmPR5J2SyY1ohg0A1k', '2020-04-05 06:38:01'),
(10, 'BbgayplU61Zrdw3fz4si9NoCM', '2020-04-06 07:36:36'),
(11, 'LTRbzM5wFL38bErkdOGjZ9dfD', '2020-04-14 12:52:03'),
(12, 'n80VIE6UJGBohXp8IMD0w2WvG', '2020-04-19 22:46:43'),
(13, 'vHeTsfSnGkpjGJ1TYtWUuqBNE', '2020-05-01 21:47:50'),
(14, 'JZZawvbyTUaxXNqsn7zhUGwZ0', '2020-06-30 15:26:30'),
(15, 'LogP3InLWa36ca4UCJ1z0FdE1', '2021-06-09 08:05:15'),
(17, 'pB16FAFxjnw8lIoA2bEr10Gdu', '2021-06-09 08:07:25'),
(18, 'VJT8NeyhYXQqGIRYv5ZbsPA5d', '2021-06-13 08:34:55'),
(20, 'QNtq1owgjkq65q8Pj1dnJW5Et', '2021-06-16 13:11:22'),
(21, 'jdPL8f403AMIrTEvTAfa8od1s', '2021-06-16 13:25:40'),
(22, 'TuiDEFuuCJ4QU2ne3qsJ8mS90', '2021-06-18 08:39:56'),
(23, 'bklfKhBeUYRvLOm522xYJ7vnS', '2021-06-21 10:11:10'),
(24, '0GmJnGapkwU9hLWdd0lbJ92e4', '2021-06-22 09:07:35'),
(25, 'WsqEHR85dw4Apy7SGmQX8LxtQ', '2021-10-26 07:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `pie_system`
--

CREATE TABLE `pie_system` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Owner of this PIE account',
  `amount` decimal(10,2) NOT NULL COMMENT 'Investment amount',
  `no_of_pie` int(10) NOT NULL COMMENT 'No. of investment units',
  `track` varchar(100) DEFAULT NULL COMMENT 'Who initiated this PIE account',
  `start_date` date DEFAULT NULL COMMENT 'Date investment starts counting',
  `end_date` date DEFAULT NULL COMMENT 'Expected date of maturity',
  `withdraw_date` timestamp NULL DEFAULT NULL COMMENT 'Date of withdrawal',
  `amount_withdrawn` decimal(10,2) NOT NULL COMMENT 'Amount withdrawn. This should be the entire amount.',
  `date_closed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pie_system`
--

INSERT INTO `pie_system` (`id`, `user_id`, `amount`, `no_of_pie`, `track`, `start_date`, `end_date`, `withdraw_date`, `amount_withdrawn`, `date_closed`) VALUES
(1, 2, 5000.00, 5, 'pie_bonus', '2020-12-14', '2023-12-14', NULL, 0.00, NULL),
(2, 1, 1000.00, 1, 'sponsor_bonus', '2020-12-14', '2023-12-14', NULL, 0.00, NULL),
(3, 2, 1000.00, 1, 'purchased', '2020-12-14', '2023-12-14', NULL, 0.00, NULL),
(4, 2, 1000.00, 1, 'purchased', '2021-05-31', '2024-05-30', NULL, 0.00, NULL),
(5, 2, 1000.00, 1, 'purchased', '2021-06-01', '2024-05-31', NULL, 0.00, NULL),
(6, 2, 2000.00, 2, 'purchased', '2021-06-08', '2024-06-07', NULL, 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pie_transactions`
--

CREATE TABLE `pie_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pie_id` int(11) DEFAULT NULL,
  `entry` varchar(20) DEFAULT NULL,
  `paymentmethod` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `comment` varchar(255) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pie_transactions`
--

INSERT INTO `pie_transactions` (`id`, `user_id`, `pie_id`, `entry`, `paymentmethod`, `amount`, `comment`, `date_created`) VALUES
(1, 2, 1, 'credit', 12, 5000.00, 'Purchase of 5 PIE Units', '2020-12-14 13:03:43'),
(2, 1, 2, 'credit', 12, 1000.00, 'Sponsor bonus', '2020-12-14 13:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `pie_withdrawals`
--

CREATE TABLE `pie_withdrawals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pie_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Amount involved in transaction',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pie_withdrawals`
--

INSERT INTO `pie_withdrawals` (`id`, `user_id`, `pie_id`, `status`, `amount`, `date_created`) VALUES
(1, 2, 3, 1, 100.00, '2021-06-18 09:04:48'),
(2, 2, 3, 1, 100.00, '2021-07-08 14:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE `pins` (
  `id` bigint(11) NOT NULL,
  `batch_number` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `pin_unique_value` varchar(100) NOT NULL COMMENT 'this is like the membership id',
  `date_printed` timestamp NULL DEFAULT NULL,
  `date_used` timestamp NULL DEFAULT NULL,
  `is_used` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pins`
--

INSERT INTO `pins` (`id`, `batch_number`, `pin`, `pin_unique_value`, `date_printed`, `date_used`, `is_used`) VALUES
(1, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC001', 'ISC001', NULL, NULL, NULL),
(2, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC002', 'ISC002', NULL, '2020-03-20 22:45:35', 0),
(3, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC003', 'ISC003', NULL, '2020-03-21 00:15:51', 0),
(4, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC004', 'ISC004', NULL, '2020-03-21 00:32:51', 0),
(5, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC005', 'ISC005', NULL, '2020-03-23 20:40:17', 0),
(6, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC006', 'ISC006', NULL, '2020-04-03 07:28:27', 0),
(7, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC007', 'ISC007', NULL, '2020-04-04 20:15:53', 0),
(8, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC008', 'ISC008', NULL, '2020-04-04 20:41:23', 0),
(9, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC009', 'ISC009', NULL, '2020-04-05 06:38:01', 0),
(10, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC0010', 'ISC0010', NULL, '2020-04-05 06:38:01', 0),
(11, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC0011', 'ISC0011', NULL, '2020-04-06 07:36:36', 0),
(12, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC0012', 'ISC0012', NULL, '2020-04-06 07:36:37', 0),
(13, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC0013', 'ISC0013', NULL, '2020-04-14 12:52:03', 0),
(14, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC0014', 'ISC0014', NULL, '2020-04-19 22:46:43', 0),
(15, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC0015', 'ISC0015', NULL, '2020-05-01 21:47:50', 0),
(16, 'shdfsfysdf6sdfs6df6sd3sfsdf', 'ISC0016', 'ISC0016', NULL, '2020-12-14 13:02:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `recharge`
--

CREATE TABLE `recharge` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_upgraded` int(1) NOT NULL,
  `wallet` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recharge`
--

INSERT INTO `recharge` (`id`, `user_id`, `is_upgraded`, `wallet`, `date_created`) VALUES
(1, 1, 0, 0.00, '2020-03-03 07:10:45'),
(2, 2, 0, 0.00, '2020-03-20 11:50:29'),
(3, 3, 0, 0.00, '2020-03-20 23:15:41'),
(4, 4, 0, 0.00, '2020-03-21 00:10:49'),
(5, 5, 0, 0.00, '2020-03-21 00:30:13'),
(6, 6, 0, 0.00, '2020-03-21 01:06:01'),
(7, 7, 0, 0.00, '2020-03-21 01:23:23'),
(8, 8, 0, 0.00, '2020-03-21 06:21:24'),
(9, 9, 0, 0.00, '2020-03-21 06:51:54'),
(10, 10, 0, 0.00, '2020-03-23 23:13:17'),
(11, 11, 0, 0.00, '2020-03-23 23:17:39'),
(12, 12, 0, 0.00, '2020-03-24 06:46:12'),
(13, 13, 0, 0.00, '2020-03-28 12:49:55'),
(14, 14, 0, 0.00, '2020-03-28 14:30:28'),
(15, 15, 0, 0.00, '2020-03-30 14:30:55'),
(16, 16, 0, 0.00, '2020-03-30 18:34:42'),
(17, 17, 0, 0.00, '2020-03-31 18:02:27'),
(18, 18, 0, 0.00, '2020-03-31 18:32:28'),
(19, 19, 0, 0.00, '2020-04-04 16:12:07'),
(20, 20, 0, 0.00, '2020-04-04 20:05:15'),
(21, 23, 0, 0.00, '2020-04-05 08:57:18'),
(22, 26, 0, 0.00, '2020-04-07 12:55:05'),
(23, 27, 0, 0.00, '2020-04-14 12:52:49'),
(24, 28, 0, 0.00, '2020-04-17 12:58:24'),
(25, 29, 0, 0.00, '2020-04-17 14:34:55'),
(26, 30, 0, 0.00, '2020-04-17 18:58:44'),
(27, 31, 0, 0.00, '2020-04-19 18:32:27'),
(28, 32, 0, 0.00, '2020-04-20 07:44:50'),
(29, 33, 0, 0.00, '2020-04-22 20:24:24'),
(30, 34, 0, 0.00, '2020-04-22 20:46:14'),
(31, 35, 0, 0.00, '2020-05-22 03:35:46'),
(32, 36, 0, 0.00, '2020-09-17 19:21:41'),
(33, 39, 0, 0.00, '2021-04-27 09:56:13'),
(34, 40, 0, 0.00, '2021-04-27 10:00:08'),
(35, 41, 0, 0.00, '2021-04-27 11:48:03'),
(36, 42, 0, 0.00, '2021-05-07 17:08:53'),
(37, 43, 0, 0.00, '2021-07-14 01:17:25'),
(38, 44, 0, 0.00, '2021-07-26 18:04:11'),
(39, 45, 0, 0.00, '2021-09-13 17:29:24'),
(40, 46, 0, 0.00, '2021-11-12 18:32:49'),
(41, 47, 0, 0.00, '2021-11-12 18:44:39'),
(42, 48, 0, 0.00, '2021-11-12 18:46:55'),
(43, 49, 0, 0.00, '2021-11-12 19:13:31'),
(44, 50, 0, 0.00, '2021-11-15 20:09:46'),
(45, 51, 0, 0.00, '2021-11-17 19:58:57'),
(46, 52, 0, 0.00, '2021-11-24 14:27:21'),
(47, 53, 0, 0.00, '2021-11-24 14:28:27'),
(48, 54, 0, 0.00, '2021-11-24 14:29:17'),
(49, 55, 0, 0.00, '2021-11-24 14:31:06'),
(50, 56, 0, 0.00, '2021-11-24 14:32:30'),
(51, 57, 0, 0.00, '2021-11-24 14:38:09'),
(52, 58, 0, 0.00, '2021-11-28 23:26:25'),
(53, 59, 0, 0.00, '2021-12-02 19:02:14'),
(54, 60, 0, 0.00, '2021-12-02 19:31:05'),
(55, 61, 0, 0.00, '2021-12-02 19:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `recharge_airtime`
--

CREATE TABLE `recharge_airtime` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wallet` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `provider` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recharge_commissions`
--

CREATE TABLE `recharge_commissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `from_id` int(11) NOT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recharge_data`
--

CREATE TABLE `recharge_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `provider` int(11) DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `wallet` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recharge_fund_wallet`
--

CREATE TABLE `recharge_fund_wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recharge_transactions`
--

CREATE TABLE `recharge_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry` varchar(11) DEFAULT NULL,
  `paymentmethod` int(11) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recharge_withdrawal`
--

CREATE TABLE `recharge_withdrawal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `date_completed` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `_key` varchar(200) NOT NULL,
  `_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `_key`, `_value`) VALUES
(1, 'mt_daily_limit', '2'),
(2, 'mt_price', '4000'),
(3, 'pie_price_ordinary', '1200'),
(4, 'pie_price_upgraded', '1000'),
(5, 'app_name', 'Iscube Networks'),
(6, 'recharge_upgrade_level_0', '25'),
(7, 'recharge_upgrade_level_1', '25'),
(8, 'recharge_upgrade_level_2', '10'),
(9, 'recharge_airtime_level_0', '2'),
(10, 'recharge_airtime_level_1', '1'),
(11, 'recharge_airtime_level_2', '0.5'),
(12, 'recharge_upgrade_amount', '5000'),
(13, 'recharge_data_level_1', '1'),
(14, 'recharge_data_level_2', '0.5'),
(15, 'recharge_data_level_0', '2'),
(16, 'recharge_airtime_code', '{\"1\":\"MTN-NG\", \"2\":\"Airtel\", \"3\":\"Glo\", \"4\":\"9-mobile\"}'),
(17, 'recharge_wallet_code', '{\"11\":\"PIE Account\", \"12\":\"Matrix Account\", \"13\":\"Recharge Account\", \"4\":\"Online Payment\", \"5\":\"Bank Payment\", \"6\":\"My Wallet\"}'),
(18, 'recharge_tv_subscriptions_provider', '{\"1\":\"DSTV\", \"2\":\"GoTV\", \"3\":\"StarTimes\"}'),
(19, 'recharge_data_plans', '[\r\n    { \"network\": \"1\" , \"desc\": \"Daily 25MB\", \"amount\": \"50\" },\r\n    { \"network\": \"1\" , \"desc\": \"Daily 75MB\", \"amount\": \"100\" },\r\n    { \"network\": \"1\" , \"desc\": \"Daily 1GB\", \"amount\": \"350\" },\r\n    { \"network\": \"1\" , \"desc\": \"2 Days 200MB\", \"amount\": \"200\" },\r\n    { \"network\": \"1\" , \"desc\": \"2 Days 2GBB\", \"amount\": \"500\" },\r\n    { \"network\": \"1\" , \"desc\": \"Weekly 350MB\", \"amount\": \"300\" },\r\n    { \"network\": \"1\" , \"desc\": \"Weekly 750MB\", \"amount\": \"500\" },\r\n    { \"network\": \"1\" , \"desc\": \"Weekly 1GB\", \"amount\": \"500\" },\r\n    { \"network\": \"1\" , \"desc\": \"Weekly 6GB\", \"amount\": \"1500\" },\r\n    { \"network\": \"1\" , \"desc\": \"Monthly 1.5GB\", \"amount\": \"1000\" },\r\n    { \"network\": \"1\" , \"desc\": \"Monthly 2GB\", \"amount\": \"1200\" },\r\n    { \"network\": \"1\" , \"desc\": \"Monthly 3GB\", \"amount\": \"1500\" },\r\n    { \"network\": \"1\" , \"desc\": \"Monthly 4.5GB\", \"amount\": \"2000\" },\r\n    { \"network\": \"1\" , \"desc\": \"Monthly 6GB\", \"amount\": \"2500\" },\r\n    { \"network\": \"2\" , \"desc\": \"Daily 25MB\", \"amount\": \"50\" },\r\n    { \"network\": \"2\" , \"desc\": \"Daily 75MB\", \"amount\": \"100\" },\r\n    { \"network\": \"2\" , \"desc\": \"Daily 1GB\", \"amount\": \"300\" },\r\n    { \"network\": \"2\" , \"desc\": \"3 Days 200MB\", \"amount\": \"200\" },\r\n    { \"network\": \"2\" , \"desc\": \"14 Days 750MB\", \"amount\": \"500\" },\r\n    { \"network\": \"2\" , \"desc\": \"7 Days 1GB\", \"amount\": \"500\" },\r\n    { \"network\": \"2\" , \"desc\": \"Daily 2GB\", \"amount\": \"500\" },\r\n    { \"network\": \"2\" , \"desc\": \"7 Days 6GB\", \"amount\": \"1500\" },\r\n    { \"network\": \"3\" , \"desc\": \"Daily 25MB\", \"amount\": \"50\" },\r\n    { \"network\": \"3\" , \"desc\": \"Daily 75MB\", \"amount\": \"100\" },\r\n    { \"network\": \"3\" , \"desc\": \"Daily 1GB\", \"amount\": \"300\" },\r\n    { \"network\": \"3\" , \"desc\": \"3 Days 200MB\", \"amount\": \"200\" },\r\n    { \"network\": \"3\" , \"desc\": \"14 Days 750MB\", \"amount\": \"500\" },\r\n    { \"network\": \"3\" , \"desc\": \"7 Days 1GB\", \"amount\": \"500\" },\r\n    { \"network\": \"3\" , \"desc\": \"Daily 2GB\", \"amount\": \"500\" },\r\n    { \"network\": \"3\" , \"desc\": \"7 Days 6GB\", \"amount\": \"1500\" },\r\n    { \"network\": \"4\" , \"desc\": \"Daily 25MB\", \"amount\": \"50\" },\r\n    { \"network\": \"4\" , \"desc\": \"Daily 75MB\", \"amount\": \"100\" },\r\n    { \"network\": \"4\" , \"desc\": \"Daily 1GB\", \"amount\": \"300\" },\r\n    { \"network\": \"4\" , \"desc\": \"3 Days 200MB\", \"amount\": \"200\" },\r\n    { \"network\": \"4\" , \"desc\": \"14 Days 750MB\", \"amount\": \"500\" },\r\n    { \"network\": \"4\" , \"desc\": \"7 Days 1GB\", \"amount\": \"500\" },\r\n    { \"network\": \"4\" , \"desc\": \"Daily 2GB\", \"amount\": \"500\" },\r\n    { \"network\": \"4\" , \"desc\": \"7 Days 6GB\", \"amount\": \"1500\" }\r\n]'),
(20, 'pie_account_id', 'ISCPIE-00'),
(21, 'wallet_code', '{\"11\":\"PIE Account\", \"12\":\"Matrix Account\", \"13\":\"Recharge Account\", \"4\":\"Online Payment\", \"5\":\"Bank Payment\", \"6\":\"My Wallet\"}'),
(22, 'matrix_levels', '{\"0\":\"Intro Stage\", \"1\":\"Quorum 1\", \"2\":\"Quorum 2\", \"3\":\"Quorum 3\", \"4\":\"Quorum 4\", \"5\":\"Quorum 5\"}'),
(23, 'matrix_incentives', '[\r\n    { \"stage\": \"1\" , \"desc\": \"Intro Workshop\", \"code\": \"101\" },\r\n    { \"stage\": \"1\" , \"desc\": \"Intro Workshop 2\", \"code\": \"102\" },\r\n    { \"stage\": \"1\" , \"desc\": \"Intro Workshop 3\", \"code\": \"103\" },\r\n    { \"stage\": \"2\" , \"desc\": \"Small Business Development 1\", \"code\": \"201\" },\r\n    { \"stage\": \"2\" , \"desc\": \"Small Business Development 2\", \"code\": \"202\" },\r\n    { \"stage\": \"2\" , \"desc\": \"Small Business Development 3\", \"code\": \"203\" },\r\n    { \"stage\": \"3\" , \"desc\": \"Small Business Development\", \"code\": \"301\" },\r\n    { \"stage\": \"3\" , \"desc\": \"Interest Free Soft Help\", \"code\": \"302\" },\r\n    { \"stage\": \"4\" , \"desc\": \"Approved Network Marketing business\", \"code\": \"401\" },\r\n    { \"stage\": \"4\" , \"desc\": \"A Laptop, Small Generator or N55000 cash equivalent\", \"code\": \"401\" },\r\n    { \"stage\": \"5\" , \"desc\": \"A New Motocycle, Tricycle, Industrial Sewing machine or N500,000 cash equivalent\", \"code\": \"501\" },\r\n    { \"stage\": \"5\" , \"desc\": \"Free Healthcare Insurance\", \"code\": \"502\" }\r\n]'),
(24, 'matrix_upgrade_amount', '5000'),
(25, 'general_broadcast_message', ''),
(26, 'recharge_sticky_message', ''),
(27, 'matrix_sticky_message', ''),
(28, 'disable_login', '1'),
(29, 'disable_registration', '1'),
(30, 'disable_upgrade', '1'),
(31, 'disable_pie_purchase', '1'),
(32, 'disable_stt_purchase', '1'),
(33, 'disable_recharge', '0'),
(34, 'paystack_percent_charge', '0.016'),
(35, 'paystack_flat_fee', '100');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `ip_address`, `date_created`) VALUES
(1, '49.36.227.157', '2021-02-01 17:13:15'),
(2, '102.134.114.1', '2021-04-12 15:36:11'),
(3, '223.185.131.139', '2021-04-13 14:09:23'),
(4, '106.204.213.79', '2021-04-27 10:31:43'),
(5, '49.36.230.176', '2021-04-27 12:11:44'),
(6, '106.204.211.40', '2021-04-29 10:14:10'),
(7, '197.149.127.197', '2021-05-03 11:42:13'),
(8, '106.204.198.189', '2021-05-04 16:43:55'),
(9, '106.206.234.76', '2021-05-11 07:59:57'),
(10, '41.190.31.67', '2021-05-12 18:11:49'),
(11, '49.36.231.197', '2021-05-13 15:16:22'),
(12, '49.36.229.197', '2021-05-20 13:59:33'),
(13, '36.76.105.43', '2021-07-13 21:20:23'),
(14, '197.210.28.103', '2021-07-14 12:21:16'),
(15, '197.149.127.196', '2021-07-14 12:21:20'),
(16, '212.102.57.73', '2021-10-18 22:53:27'),
(17, '212.102.57.7', '2021-10-19 06:12:01'),
(18, '157.39.124.2', '2021-11-12 13:29:11'),
(19, '223.185.42.140', '2021-11-12 13:29:13'),
(20, '223.185.23.188', '2021-11-15 16:03:16'),
(21, '52.114.14.71', '2021-11-16 13:07:46'),
(22, '49.156.107.142', '2021-11-16 13:31:06'),
(23, '106.66.10.53', '2021-11-17 04:32:11'),
(24, '188.43.136.33', '2021-11-17 08:21:54'),
(25, '91.144.157.70', '2021-11-17 08:21:56'),
(26, '102.89.1.132', '2021-11-17 12:43:00'),
(27, '223.177.207.147', '2021-11-17 14:58:10'),
(28, '42.104.120.71', '2021-11-17 15:26:41'),
(29, '197.210.45.39', '2021-11-17 15:41:41'),
(30, '122.173.28.167', '2021-11-17 16:05:41'),
(31, '49.44.80.41', '2021-11-17 16:05:47'),
(32, '172.58.29.253', '2021-11-17 16:06:32'),
(33, '49.36.225.187', '2021-11-18 13:40:26'),
(34, '106.78.40.110', '2021-11-23 08:54:34'),
(35, '49.36.231.120', '2021-11-23 16:53:35'),
(36, '154.118.40.38', '2021-11-24 09:37:24'),
(37, '106.211.75.214', '2021-11-24 12:52:19'),
(38, '122.173.28.108', '2021-11-24 18:00:59'),
(39, '52.54.82.162', '2021-11-24 18:02:22'),
(40, '106.212.17.75', '2021-11-26 12:27:33'),
(41, '103.92.43.104', '2021-11-26 16:19:03'),
(42, '52.114.32.212', '2021-11-28 07:58:59'),
(43, '146.196.45.118', '2021-11-28 08:02:34'),
(44, '103.6.219.60', '2021-11-28 08:05:34'),
(45, '27.106.94.8', '2021-12-01 17:06:21'),
(46, '172.58.29.220', '2021-12-01 17:06:47'),
(47, '103.205.112.236', '2021-12-02 13:57:50'),
(48, '49.44.86.102', '2021-12-02 14:00:52'),
(49, '132.154.25.72', '2021-12-02 14:06:38'),
(50, '103.201.133.18', '2021-12-02 14:29:51'),
(51, '172.56.13.114', '2021-12-02 18:01:05'),
(52, '103.92.43.111', '2021-12-02 18:07:26'),
(53, '203.76.189.6', '2021-12-03 05:40:33'),
(54, '157.39.125.127', '2021-12-06 09:54:26'),
(55, '110.227.227.98', '2021-12-06 09:54:37'),
(56, '146.196.32.107', '2021-12-06 10:39:51'),
(57, '49.36.95.154', '2021-12-07 05:55:34'),
(58, '18.212.191.209', '2021-12-07 10:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `wallet_type`, `amount`, `description`, `date_created`) VALUES
(1, 0, 'e-wallet', '1234', 'fffsfsf', '2021-02-01 17:18:25'),
(2, 16, 'e-wallet', '222', '221', '2021-04-10 06:40:36'),
(3, 1, 'e-wallet', '111', 'wefewf', '2021-04-10 06:41:06'),
(4, 1, 'e-wallet', '331', 'efrfrf', '2021-04-10 06:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_histories`
--

CREATE TABLE `transaction_histories` (
  `id` int(11) NOT NULL,
  `user_id` int(20) DEFAULT NULL COMMENT 'ID in the user''s table',
  `pie_id` int(20) DEFAULT NULL COMMENT 'ID of PIE account',
  `amount` decimal(20,2) DEFAULT NULL COMMENT 'Transaction amount',
  `entry` int(1) DEFAULT NULL COMMENT '0 - Debit, 1 - Credit',
  `ref` int(1) DEFAULT NULL COMMENT '0 - Pie transaction, 1 - Matrix transaction',
  `purpose` varchar(250) DEFAULT NULL COMMENT 'What''s the transaction for',
  `status` int(1) DEFAULT NULL COMMENT '0 - Processing, 1 - Approved, 2 - Cancelled',
  `date_created` datetime DEFAULT NULL COMMENT 'Transaction date',
  `date_completed` datetime DEFAULT NULL COMMENT 'Date transaction was completed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin_unique_value` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'unique id of pin is like a membership id',
  `parent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'id of parent from user''s table',
  `sponsor_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'id of sponsor from user''s table',
  `position` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'position of this user under the parent.',
  `current_matrix` int(1) DEFAULT NULL COMMENT 'known as stage in other systems',
  `is_upgraded` int(1) DEFAULT 0 COMMENT 'Checks if users has upgraded. 0 is not upgraded. 1 is upgraded',
  `is_matrix_thrift` int(100) DEFAULT 0 COMMENT 'If set to 0, then its not a MT. If set to any integer, that integer is the owner of the MT',
  `is_thrift_completed` int(1) NOT NULL DEFAULT 0 COMMENT 'Flag 1 if Matrix Thrift has moved to Q1.',
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_bvn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1=Active, 0=Inactive/Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `pin_unique_value`, `parent_id`, `sponsor_id`, `position`, `current_matrix`, `is_upgraded`, `is_matrix_thrift`, `is_thrift_completed`, `fname`, `lname`, `username`, `phone`, `gender`, `dob`, `account_name`, `account_number`, `account_bvn`, `bank_code`, `email`, `email_verified_at`, `password`, `remember_token`, `last_login_at`, `created_at`, `updated_at`, `status`) VALUES
(1, 'First User', 'ISC001', '0', '0', '0', 0, 1, 0, 0, NULL, NULL, 'admin@mlm.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin@mlm.com', NULL, '\0\0\0x?????OO,I542V\0?', NULL, '2020-04-26 22:46:07', '2020-03-03 07:10:45', '2021-11-24 14:46:48', 0),
(2, 'Lawrence Okata', 'ISC002', 'ISC001', '12', 'L', 1, 1, 0, 0, 'Lawrence', 'Okata', 'admin', '09022271924', 'm', '1956-09-11', 'Lawrence Okata', '0150497302', '', 't9alkPgHf2', 'iscubeco@gmail.com', '2020-06-30 14:47:09', 't9gKmmcXpC2Ew', '', '2021-12-02 23:07:25', '2020-03-20 11:50:29', '2021-12-02 23:07:25', 1),
(3, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'olu', '08112237055', NULL, NULL, NULL, NULL, NULL, NULL, 'meshmmanuel@gmail.com', NULL, '$2y$10$lJrMcNvFeqcRG0n/lferf.yPBHGYavMgNwTUjlcUpuEYd5niPpVee', NULL, '2020-03-23 17:18:13', '2020-03-20 23:15:41', '2021-11-24 14:47:20', 0),
(4, 'Olumide Williams', 'ISC003', 'ISC002', '2', 'L', 0, 1, 0, 0, 'Olumide', 'Williams', 'bettertomorrow', '08186001619', 'm', '1983-11-23', 'Olumide Williams', '0033246857', '', '044', 'oluolawills@gmail.com', '2020-06-30 14:46:22', '77', '3muNJBxkwDEOAUaAcS0Avfhd3zKpNUoy6L3BjIIdeaDvgLFbyTfoKPEIFMul', '2021-07-26 18:13:08', '2020-03-21 00:10:49', '2021-11-24 14:47:31', 0),
(5, 'Olawale John Olagunju', 'ISC004', 'ISC002', '2', 'M', 0, 1, 0, 0, 'Olawale John', 'Olagunju', 'courtesy', '08060520308', 'm', '1987-06-11', 'OLAGUNJU OLAWALE JOHN', '0049470443', '', '058', 'jowaol1st@yahoo.com', NULL, '$2y$10$xaySymn.RY423bEu3cKGTOzZH/aY9xc3GcfCytE5FUTYswUtWsyNe', NULL, '2020-04-06 07:38:27', '2020-03-21 00:30:13', '2020-04-06 07:38:27', 1),
(6, 'Abraham Oluborode', NULL, NULL, '5', NULL, NULL, 0, 0, 0, 'Abraham', 'Oluborode', 'revbj', '08033471658', 'm', '1977-09-05', 'OLUBORODE ABRAHAM', '0030882381', '', '058', 'revbjabraham2010@gmail.com', NULL, '$2y$10$5OfoOMaLSIj42h5QkWAYw.RwW4Xw46/OwRmHG4iD7qT6.wPC4l3jC', NULL, '2020-03-21 01:13:57', '2020-03-21 01:06:01', '2020-03-21 01:13:57', 1),
(7, 'OLAYINKA FISAYO', 'ISC006', 'ISC004', '5', 'L', 0, 1, 0, 0, 'OLAYINKA', 'FISAYO', 'olynk', '07034313336', 'f', '1991-07-14', 'FAGBAMIYE OLAYINKA FISAYO', '0117709413', '', '058', 'olynkf@gmail.com', NULL, '$2y$10$9Ww7JPh8hWu/fpUUPAZONO8bt0cCbXe6LMAlFfdMd5s/wVjYHOHNy', NULL, '2020-04-03 07:32:01', '2020-03-21 01:23:23', '2020-04-03 07:32:01', 1),
(8, 'Caroline Eyo', NULL, NULL, '5', NULL, NULL, 0, 0, 0, 'Caroline', 'Eyo', 'freebest', '08020547643', 'f', '1985-7-15', 'Caroline E. Eyo', '0117080020', '', '058', 'freebest20@gmail.com', NULL, '$2y$10$MGQEDVS5o0A4bkGk.R56VOut/cF/d1OFOxEEWpH6AKMBvuNDptFRu', NULL, NULL, '2020-03-21 06:21:24', '2020-03-21 06:24:33', 1),
(9, 'OLATUNDE FAGBOYE', 'ISC005', 'ISC002', '2', 'R', 0, 1, 0, 0, 'OLATUNDE', 'FAGBOYE', 'tunde2222', '08033456031', 'm', '1972-11-23', 'OLATUNDE  FAGBOYE', '3005449982', '', '011', 'fagboyeo@gmail.com', NULL, '$2y$10$aCyFgjqhUzG0EIcx5AZruOf6HIu8aogaAYwx7OkysjlJEN0iWG72u', NULL, '2020-05-01 21:53:43', '2020-03-21 06:51:54', '2021-05-20 21:43:57', 1),
(10, 'Samuel Onikosi', NULL, NULL, '9', NULL, NULL, 0, 0, 0, 'Samuel', 'Onikosi', 'divinesuccess1', '08156721924', 'm', '1977-11-19', 'Samuel Omobowale Onikosi', '0033991811', '', '058', 'dappycrown.oo77@gmail.com', NULL, '$2y$10$yxFtC2E50/aURxdVW8gYnelR1dmqdQBU8csvKhMpf.is8ClQYgJ4y', NULL, '2020-03-23 23:25:13', '2020-03-23 23:13:17', '2020-03-23 23:25:13', 1),
(11, NULL, NULL, NULL, '9', NULL, NULL, 0, 0, 0, NULL, NULL, 'simonobaje', '08062200724', NULL, NULL, NULL, NULL, NULL, NULL, 'simonobaje@gmail.com', NULL, '$2y$10$XMb4c1hIg8m858FMnlfXxuYt0ua3AkCGlpD8y1pXrIHgYB3.FivaS', NULL, NULL, '2020-03-23 23:17:39', '2020-03-23 23:17:39', 1),
(12, NULL, NULL, NULL, '9', NULL, NULL, 0, 0, 0, NULL, NULL, 'chosenlilly', '+254720881623', NULL, NULL, NULL, NULL, NULL, NULL, 'lilianakinyi2000@gmail.com', NULL, '$2y$10$N8p2JIVjM0lsCYqTx2QjjeU15TWdkBZV45j0o.WQ/.4IJZzO5tNni', NULL, '2020-03-24 07:59:27', '2020-03-24 06:46:12', '2020-03-24 07:59:27', 1),
(13, NULL, NULL, NULL, '4', NULL, NULL, 0, 0, 0, NULL, NULL, 'areapastor31', '8127637322', NULL, NULL, NULL, NULL, NULL, NULL, 'philadeniyi@gmail.com', NULL, '$2y$10$2airpfp1TinyVBpJwdljnO9Jdta2k/UPTotY6uPvYW4joNK33bRsq', NULL, NULL, '2020-03-28 12:49:55', '2020-03-28 12:49:55', 1),
(14, 'Paul Okoro', 'ISC0013', 'ISC003', '4', 'L', 0, 1, 0, 0, 'Paul', 'Okoro', 'sirpaul', '+2348038700006', 'm', '1953-08-03', 'Paul N Okoro', '0007643722', '', '058', 'po.healthwealth@gmail.com', NULL, '$2y$10$TWh20m1H.JX0p6ewx4beDevuhHyU5lupgdVUAv6zkp1hCr0bVYp/2', 'xQy49fV2auHdEGYM0VIpxnvsVH1sYey41lxBGX0JwaCjeneQaZJja3KW3ddi', '2020-04-14 13:11:23', '2020-03-28 14:30:28', '2020-04-14 13:11:23', 1),
(15, 'Ibikunle Doris', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 'Ibikunle', 'Doris', 'twinsktk', '08098056945', 'f', '1981-05-23', 'Ibikunle oluwaseunDoris', '0079301069', '', '044', 'ibikunleoluwaseun26@gmail.com', NULL, '$2y$10$GgUswx05Hn4IJZX9ydrA0e/ax14BZVu.y320KDMIcC0e321TlJtx6', NULL, NULL, '2020-03-30 14:30:55', '2020-04-22 13:09:18', 1),
(16, 'KEN EZEBUBE', NULL, NULL, '9', NULL, NULL, 0, 0, 0, 'KEN', 'EZEBUBE', 'scotnet', '09083223097', 'm', '1974-06-26', 'KEN  EZEBUBE', '1003438056', '', '057', 'ezebubekenscot@yahoo.com', NULL, '$2y$10$PEyJ6xHIzszhbXfDcVBJietpx6.1Z7xSA8s7exMFtILYr3vXYZBny', NULL, '2020-03-30 18:40:42', '2020-03-30 18:34:42', '2020-03-30 18:40:42', 1),
(17, NULL, NULL, NULL, '9', NULL, NULL, 0, 0, 0, NULL, NULL, '3005449982', '08062812196', NULL, NULL, NULL, NULL, NULL, NULL, 'chiburoyal2019@gmail.com_', NULL, '$2y$10$4WQijORs78vI8L9jvUoWRusKyuaEY57IxJGVn1KGC2UhRt1wanhl.', NULL, '2020-03-31 18:05:51', '2020-03-31 18:02:27', '2020-03-31 18:05:51', 1),
(18, NULL, NULL, NULL, '9', NULL, NULL, 0, 0, 0, NULL, NULL, 'godfirst75', '+2348062812196', NULL, NULL, NULL, NULL, NULL, NULL, 'chiburoyal2019@gmail.com', NULL, '$2y$10$xhgJqwDaI10BbSmGVVqZ7e56xjZN/gSxc9Cn17CrZS0BtXdU4ZYca', NULL, '2020-03-31 20:02:39', '2020-03-31 18:32:28', '2020-03-31 20:02:39', 1),
(19, 'Imoh Eshiet', 'ISC008', 'ISC005', '9', 'M', 0, 1, 0, 0, 'Imoh', 'Eshiet', 'piecompro', '08087070282', 'm', '1976-02-20', 'Eshiet,Imoh Udoh', '2022760964', '', '033', 'piecompro@gmail.com', NULL, '$2y$10$bva8Lb4ASdJfy3MJM5x.9Oq2545CTO6wxvfgKCOHSU7G.QtQZ7KUm', NULL, '2020-04-04 21:01:58', '2020-04-04 16:12:07', '2020-04-04 21:01:58', 1),
(20, 'Tope Akinwumi', 'ISC007', 'ISC005', '9', 'L', 0, 1, 0, 0, 'Tope', 'Akinwumi', 'topwealth', '07038700226', 'm', '1960-10-10', 'Tope      AKINWUMI', '6237706882', '', '070', 'topwealth99@gmail.com', NULL, '$2y$10$OIvJRAoQGqY9HC6ZV7Ry4.Xfdfy3Y7g4m4GS9hwo0kLUXnBk5QoVO', NULL, '2020-04-22 19:56:38', '2020-04-04 20:05:15', '2020-04-22 19:56:38', 1),
(21, 'courtesy_1', 'ISC009', 'ISC004', '5', 'M', 1, 1, 5, 1, 'STT: Olawale John_1', 'STT:Olagunju_1', 'courtesy_1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'courtesy1@iscubenetworks.com', NULL, 'disabled', NULL, NULL, '2020-04-05 06:38:01', '2020-07-03 12:00:02', 1),
(22, 'courtesy_2', 'ISC0010', 'ISC004', '5', 'R', 1, 1, 5, 1, 'STT: Olawale John_2', 'STT:Olagunju_2', 'courtesy_2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'courtesy2@iscubenetworks.com', NULL, 'disabled', NULL, NULL, '2020-04-05 06:38:01', '2020-07-03 12:00:02', 1),
(23, 'Adesumbo Adekunle', NULL, NULL, '19', NULL, NULL, 0, 0, 0, 'Adesumbo', 'Adekunle', 'meribah', '08176448951', 'f', '1976-06-18', 'Adekunle Adesumbo Fehint', '0171791049', '', '058', 'almondlife82@gmail.com', NULL, '$2y$10$CuTbwRGa5/3DnPxFFD5xpe.gD9cpiHtzL327NrJrL5OUk1tS5sMJy', NULL, '2020-04-05 09:05:45', '2020-04-05 08:57:18', '2020-04-05 09:05:45', 1),
(24, 'courtesy_3', 'ISC0011', 'ISC006', '5', 'L', 1, 1, 5, 1, 'STT: Olawale John_3', 'STT:Olagunju_3', 'courtesy_3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'courtesy3@iscubenetworks.com', NULL, 'disabled', NULL, NULL, '2020-04-06 07:36:36', '2020-07-04 12:00:03', 1),
(25, 'courtesy_4', 'ISC0012', 'ISC006', '5', 'M', 1, 1, 5, 1, 'STT: Olawale John_4', 'STT:Olagunju_4', 'courtesy_4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'courtesy4@iscubenetworks.com', NULL, 'disabled', NULL, NULL, '2020-04-06 07:36:37', '2020-07-04 12:00:03', 1),
(26, NULL, NULL, NULL, '4', NULL, NULL, 0, 0, 0, NULL, NULL, 'ikisiguzo', '08032832710', 'm', '1980-05-31', NULL, NULL, NULL, NULL, 'isiguzoikenna@gmail.com', NULL, '$2y$10$1hwAgTh4IJeyRZ6ykFmhxuRXaIY3mWrhLgC0S9rW1LWvK5iBMCS02', NULL, '2020-04-07 13:25:32', '2020-04-07 12:55:05', '2020-04-07 13:25:32', 1),
(27, 'Oluwabukola Ebiti', 'ISC0014', 'ISC003', '4', 'M', 0, 1, 0, 0, 'Oluwabukola', 'Ebiti', 'bukkybukky', '08027603234', 'f', '1965-03-11', 'Ebiti Risikat Oluwabukola', '0803795224', '', '044', 'risquat@yahoo.com', NULL, '$2y$10$ciiCuKe.QbEm6Rz2jqeq8ehqyYOpnlWGXHGdTYqBVmwMD06FhP7li', NULL, '2020-04-19 22:53:42', '2020-04-14 12:52:49', '2020-04-19 22:53:42', 1),
(28, NULL, NULL, NULL, '4', NULL, NULL, 0, 0, 0, NULL, NULL, 'immaculate', '08188284367', 'f', '1985-05-15', NULL, NULL, NULL, NULL, 'smartstudiofx@gmail.com', NULL, '$2y$10$/msoXc.GwnN96hHjvGGGS.wlXla2CwJ.6oY3W05N9W.zRCE.PIf6y', NULL, '2020-04-17 21:28:54', '2020-04-17 12:58:24', '2020-04-17 21:28:54', 1),
(29, NULL, NULL, NULL, '4', NULL, NULL, 0, 0, 0, NULL, NULL, 'ekundayo', '08137976130', 'm', '1994-06-13', NULL, NULL, NULL, NULL, 'ekundayostephen7@gmail.com', NULL, '$2y$10$t6IBfyUlTuVX5dkrpv79/OxHZ/90rxQCY/mqG67TO6LM4aJqjOus6', NULL, NULL, '2020-04-17 14:34:55', '2020-04-17 14:39:40', 1),
(30, NULL, NULL, NULL, '4', NULL, NULL, 0, 0, 0, NULL, NULL, 'sumaila', '07068682020', NULL, NULL, NULL, NULL, NULL, NULL, 'ppkingwonder@gmail.com', NULL, '$2y$10$akkS.bAnQwvfXQZZy0C6d.b71r4tEw25cju14xaFVQyn6eb8fi4MC', NULL, NULL, '2020-04-17 18:58:44', '2020-04-17 18:58:44', 1),
(31, 'Chinasa Chukwuemeka', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 'Chinasa', 'Chukwuemeka', 'angelbae', '08037894920', 'f', '1976-03-24', 'Chinasa chukwuemeka', '0040506177', '', '044', 'chinasankechi@gmail.com', NULL, '$2y$10$q1buQGlLeSZbw908nQZx6ux2LmrbIgW4pAQc3LqKxp2.h2WMB73dG', NULL, '2020-04-19 18:41:01', '2020-04-19 18:32:27', '2020-04-19 18:41:01', 1),
(32, 'Sulaimon Oluwaseun', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 'Sulaimon', 'Oluwaseun', 'engrsulex', '08189702756', 'm', '1992-10-04', 'Sulaimon Oluwaseun aree', '0161299957', '', '058', 'aresulaimon@gmail.com', NULL, '$2y$10$3c1kbdFTWvzj9M00x4BX.uvsbjlYskb62nP19OQYgNidQvI4c3HJq', NULL, NULL, '2020-04-20 07:44:50', '2020-04-20 07:47:12', 1),
(33, 'Jane Peter', 'ISC0015', 'ISC005', '9', 'R', 0, 1, 0, 0, 'Jane', 'Peter', 'mamaj1', '08062776477', 'f', '2020-04-01', 'Jane Ujugbo Peter', '0031092074', '', '044', 'janepeter1975@gmail.com', NULL, '$2y$10$mOvpSOQjveQ1ylw6C/Dz1eA10Uwb5oMf8n2sMVAmjoX4xzwIacsAO', NULL, '2020-05-01 23:53:49', '2020-04-22 20:24:24', '2020-05-01 23:53:49', 1),
(34, NULL, NULL, NULL, '33', NULL, NULL, 0, 0, 0, NULL, NULL, 'slow', '+918448064536', NULL, NULL, NULL, NULL, NULL, NULL, 'ks4836257@gmail.com', NULL, '$2y$10$8HA5zQOa539NqTg32/uH3./XN7.U1VCOC2LJn9KELqDXbIGYFqhBa', NULL, NULL, '2020-04-22 20:46:14', '2020-04-22 20:46:14', 1),
(35, NULL, NULL, NULL, '4', NULL, NULL, 0, 0, 0, NULL, NULL, 'godwinlambo', '07063944764', NULL, NULL, NULL, NULL, NULL, NULL, 'kolawolegodwinlambo@gmail.com', NULL, '$2y$10$M9I2qRpRACnHNrUyVF2qSOy9sAGDpzLu3MYtC.UwxChtepfQ3lM3S', NULL, NULL, '2020-05-22 03:35:46', '2020-05-22 03:35:46', 1),
(36, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'shasha1980', '08121990988', NULL, NULL, NULL, NULL, NULL, NULL, 'daviwenc.o.x.b.s43@gmail.com', '2020-09-17 19:25:11', '$2y$10$AosvaLuYG/Ht9RwIhQGbZO1vLGBEzjN2lMb1A0nN2e49sXVh5hUtu', NULL, NULL, '2020-09-17 19:21:41', '2020-09-17 19:25:11', 1),
(37, 'admin_1', 'ISC0016', 'ISC003', '2', 'R', 0, 1, 2, 0, 'STT: Lawrence_1', 'STT:Okata_1', 'admin_1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin1@iscubenetworks.com', NULL, 'disabled', NULL, NULL, '2020-12-14 13:02:51', '2020-12-14 13:02:51', 1),
(38, 'test', 'ISC0016', 'ISC003', '2', 'R', 0, 1, 2, 0, 'test', 'dev', 'test_dev', '454353453453', NULL, NULL, NULL, NULL, NULL, NULL, 'test@yopmail.com', '2021-05-10 12:02:51', '$2y$10$bm88bhnizUivL3FEKGa6h.LwOQWzWnNk1ZV2dfkX01hBVcU1a.o02', NULL, '2021-05-11 10:12:37', '2021-04-10 13:02:51', '2021-05-11 10:12:37', 0),
(39, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'testdev1', '78787987987', NULL, NULL, NULL, NULL, NULL, NULL, 'testdev1@yopmail.com', NULL, '$2y$10$5uwNn8PqLR.YK9YV1GUhJeqUx/PeHlbYbAJdBvHEGdg2vD8Qh3IF2', NULL, '2021-04-27 11:47:08', '2021-04-27 09:56:13', '2021-04-27 11:47:08', 0),
(40, NULL, NULL, NULL, '39', NULL, NULL, 0, 0, 0, NULL, NULL, 'testdev2', '7897897987', NULL, NULL, NULL, NULL, NULL, NULL, 'testdev2@yopmail.com', NULL, '$2y$10$HYocEyS7nGkN3MzqbCClpOxMpgsOCerK1ZwHMzxg1sMhchf5KNt62', NULL, NULL, '2021-04-27 10:00:08', '2021-04-27 10:00:08', 0),
(41, NULL, NULL, NULL, '39', NULL, NULL, 0, 0, 0, NULL, NULL, 'stackdev', '87878878700', NULL, NULL, NULL, NULL, NULL, NULL, 'email.stackdeveloper@gmail.com', NULL, '$2y$10$hjbHoSjx5FYP3TMKvCU0MeXO9wOnDenxSUySFkGp6lYktCH7yKpD.', NULL, '2021-04-27 12:33:19', '2021-04-27 11:48:02', '2021-04-27 12:33:19', 0),
(42, NULL, NULL, NULL, '4', NULL, NULL, 0, 0, 0, NULL, NULL, 'buyryte', '08186001619', NULL, NULL, NULL, NULL, NULL, NULL, 'williamsolumide@gmail.com', '2021-05-21 21:37:38', '$2y$10$z0gf9YMs71Nf5W6VFAk9teEfFq0z3lxC42dKj0dHkY34DNEzpa2l6', NULL, '2021-07-26 18:19:51', '2021-05-07 17:08:53', '2021-07-26 18:19:51', 0),
(43, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'combet', '081366763639', NULL, NULL, NULL, NULL, NULL, NULL, 'mr.combetohct@gmail.com', '2021-07-14 01:18:23', '$2y$10$coPNoOADrkKAPe3dFylll.68EFyFTqvrPupRsacq3loMZvVZeWux.', NULL, '2021-07-14 01:20:23', '2021-07-14 01:17:25', '2021-07-14 01:20:23', 0),
(44, NULL, NULL, NULL, '4', NULL, NULL, 0, 0, 0, NULL, NULL, 'oshodi', '08186001611', NULL, NULL, NULL, NULL, NULL, NULL, 'immaculateoge@gmail.com', NULL, '$2y$10$wFKZjDsbExsWFVJNBjWniuJWfVPoXuSqAgRKvAQ.QinItGBES3dd6', NULL, '2021-07-26 18:09:07', '2021-07-26 18:04:11', '2021-07-26 18:09:07', 0),
(45, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'kntl', '082274797699', NULL, NULL, NULL, NULL, NULL, NULL, 'pengaduan6300@gmail.com', NULL, '$2y$10$rcD8Sgv2zzssmYqZ3EiXNeZIJ94yv8Nw1oDImjCnqftyGXIyGhm8G', NULL, NULL, '2021-09-13 17:29:24', '2021-09-13 17:29:24', 0),
(48, NULL, NULL, NULL, '7', NULL, NULL, 0, 0, 0, NULL, NULL, 'test', '2342342342', NULL, NULL, NULL, NULL, NULL, NULL, 'jram.snh@gmail.com', '2021-11-12 18:49:12', '$2y$10$gc2/HCcC4rCEu44wiK8eHewuhEr8epJRIesFwtH.zJxefbGi/uRq.', NULL, '2021-11-12 19:11:14', '2021-11-12 18:46:55', '2021-11-12 19:11:14', 0),
(49, NULL, NULL, NULL, '44', NULL, NULL, 0, 0, 0, NULL, NULL, 'admin1', '2342342342', NULL, NULL, NULL, NULL, NULL, NULL, 'admin@admin.com', NULL, '$2y$10$H6Rw.sI4VKrq.K0TAgNCluJlpQoymZ6A63Xz5JbjeSQCe4gNUXBj2', NULL, NULL, '2021-11-12 19:13:31', '2021-11-12 19:13:31', 0),
(50, NULL, NULL, NULL, '48', NULL, NULL, 0, 0, 0, NULL, NULL, 'tester2', '9876541230', NULL, NULL, NULL, NULL, NULL, NULL, 'tester23@yopmail.com', '2021-11-15 20:11:14', '$2y$10$Mx6ILb2Arc5K4L2fV/oWYet0ERRxbSUwt0na6PiAQXtxYqfXL7GvG', NULL, '2021-11-15 21:03:14', '2021-11-15 20:09:46', '2021-11-15 21:03:14', 0),
(51, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'sameer', '978152155', NULL, NULL, NULL, NULL, NULL, NULL, 'sameer@yopmail.com', '2021-11-17 20:01:32', '$2y$10$yqyk92fchjCoVUD88LxTcea04OH.3AIdlGuHuTZsX4C66jjYGqrnK', NULL, '2021-11-17 20:26:49', '2021-11-17 19:58:57', '2021-11-17 20:26:49', 0),
(52, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'salvador_dickinson54', '364-791-2492', NULL, NULL, NULL, NULL, NULL, NULL, 'your.email+fakedata79474@gmail.com', NULL, '$2y$10$veTnDl0JF3Tt6zFHbSQNCetFqK1C7ocDQFYkC78kL8ofOj0L0z4RC', NULL, NULL, '2021-11-24 14:27:21', '2021-11-24 14:27:21', 0),
(53, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'tony_lemke', '415-822-0906', NULL, NULL, NULL, NULL, NULL, NULL, 'your.email+fakedata19488@gmail.com', NULL, '$2y$10$qRlDx.2Wu6oacVgcLfi6gOIjpPlpmvtRj79Nik.Q2.l79MHy8PMKS', NULL, NULL, '2021-11-24 14:28:27', '2021-11-24 14:28:27', 0),
(54, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'jace.lowe', '034-290-7117', NULL, NULL, NULL, NULL, NULL, NULL, 'your.email+fakedata62101@gmail.com', NULL, '$2y$10$K3TeuCeqHDOwHDDO8ZvjA.A0T.eeljzhN6vJTJfAXpcykRtyMW2pi', NULL, NULL, '2021-11-24 14:29:17', '2021-11-24 14:29:17', 0),
(55, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'lisandro17', '451-603-4858', NULL, NULL, NULL, NULL, NULL, NULL, 'your.email+fakedata49797@gmail.com', NULL, '$2y$10$A5XH4bSVLlGBE07o6.GB3.QBDQCcHVEE3qDv4GUZC6II5GmN6jdRO', NULL, NULL, '2021-11-24 14:31:06', '2021-11-24 14:31:06', 0),
(56, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'tester', '009900990099', NULL, NULL, NULL, NULL, NULL, NULL, 'chadly@chad.com', NULL, '$2y$10$6m2.AcfqFtw/op9BXGkOUO1HaO.7eL39Yd5oGTg2Zd4ykXhJFrfi2', NULL, '2021-11-24 14:37:23', '2021-11-24 14:32:30', '2021-11-24 14:37:23', 0),
(57, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'chadly', '+448099009900', NULL, NULL, NULL, NULL, NULL, NULL, 'chadly@mailinator.com', '2021-11-24 14:39:58', '$2y$10$FLRzTWwSUcdrt/45MW0bzeGW92j2fk72xHrHFbo7qrfaaPyrk/O6m', NULL, NULL, '2021-11-24 14:38:09', '2021-11-24 14:39:58', 0),
(58, NULL, NULL, NULL, '56', NULL, NULL, 0, 0, 0, NULL, NULL, 'user', '8855223612', NULL, NULL, NULL, NULL, NULL, NULL, 'gamovob666@latovic.com', '2021-11-28 23:28:32', '$2y$10$Go2rMNxG8v.O0EPZFwa7qehCo4TNbFRlqX08wDbKw3qf2Ta6CCJHe', NULL, '2021-12-01 22:05:45', '2021-11-28 23:26:25', '2021-12-01 22:05:45', 0),
(59, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'sameer', '8284904441', NULL, NULL, NULL, NULL, NULL, NULL, 'sameer.smartitventures@gmail.com', NULL, '$2y$10$dArV6KkH2PZ8sfzH2B34v.Nd2gf2mV2jGLfHbuRqJ3ERIruRlVSKi', NULL, NULL, '2021-12-02 19:02:14', '2021-12-02 19:02:14', 0),
(60, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'bhupender', '7906336193', NULL, NULL, NULL, NULL, NULL, NULL, 'bkanyal824@gmail.com', '2021-12-02 19:32:37', '$2y$10$EQNc5l9uTIgdC/VxddMZkutS1Gj2Owwdv5f4dsDeK9sFkV7YQkjbq', NULL, NULL, '2021-12-02 19:31:05', '2021-12-02 19:32:37', 0),
(61, NULL, NULL, NULL, '2', NULL, NULL, 0, 0, 0, NULL, NULL, 'bhupender', '7906336193', NULL, NULL, NULL, NULL, NULL, NULL, 'bkanyal824@gmail.com', NULL, '$2y$10$cqJTXvO3EMCdVegz2z4cy.kSfjyi5mfDL9LR9gS/losDqzylyBF/W', NULL, NULL, '2021-12-02 19:31:08', '2021-12-02 19:31:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vital_variables`
--

CREATE TABLE `vital_variables` (
  `id` int(11) NOT NULL,
  `cost_of_upgrade` varchar(100) NOT NULL,
  `cost_of_ltt` varchar(100) NOT NULL,
  `cost_of_stt` varchar(100) NOT NULL,
  `stt_max_purchase` varchar(100) NOT NULL,
  `ltt_overall_purchase` varchar(100) NOT NULL,
  `returns_stt_ltt` varchar(100) NOT NULL,
  `duration_of_ltt_stt` varchar(100) NOT NULL,
  `no_of_month_withdraw_ltt` varchar(100) NOT NULL,
  `allow_ltt_purchase_completing` tinyint(4) NOT NULL,
  `enroll_3upgraded_users` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vital_variables`
--

INSERT INTO `vital_variables` (`id`, `cost_of_upgrade`, `cost_of_ltt`, `cost_of_stt`, `stt_max_purchase`, `ltt_overall_purchase`, `returns_stt_ltt`, `duration_of_ltt_stt`, `no_of_month_withdraw_ltt`, `allow_ltt_purchase_completing`, `enroll_3upgraded_users`, `created_at`) VALUES
(3, '10000', '5000', '5000', '1200', '1200', '1200', '1200', '1200', 1, 1, '2021-07-01 13:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pie` decimal(10,2) NOT NULL DEFAULT 0.00,
  `incoming` decimal(10,2) DEFAULT 0.00,
  `outgoing` decimal(10,2) DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `pie`, `incoming`, `outgoing`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(2, 2, 200.00, 0.00, 800.00, 0.00, NULL, '2020-07-01 18:34:43'),
(3, 3, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(4, 4, 0.00, 0.00, 400.00, 0.00, NULL, '2021-03-11 15:33:24'),
(5, 5, 16800.00, 0.00, 0.00, 0.00, NULL, NULL),
(6, 6, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(7, 7, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(8, 8, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(9, 9, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(10, 10, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(11, 11, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(12, 12, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(13, 13, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(14, 14, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(15, 15, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(16, 16, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(17, 17, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(18, 18, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(19, 19, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(20, 20, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(21, 21, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(22, 22, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(23, 23, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(24, 24, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(25, 25, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(26, 26, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(27, 27, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(28, 28, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(29, 29, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(30, 30, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(31, 31, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(32, 32, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(33, 33, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(34, 34, 0.00, 0.00, 0.00, 0.00, NULL, NULL),
(35, 35, 0.00, 0.00, 0.00, 0.00, '2020-05-22 03:35:46', '2020-05-22 03:35:46'),
(36, 36, 0.00, 0.00, 0.00, 0.00, '2020-09-17 19:21:41', '2020-09-17 19:21:41'),
(37, 37, 0.00, 0.00, 0.00, 0.00, '2020-12-14 13:02:51', '2020-12-14 13:02:51'),
(38, 39, 0.00, 0.00, 0.00, 0.00, '2021-04-27 11:56:13', '2021-04-27 11:56:13'),
(39, 40, 0.00, 0.00, 0.00, 0.00, '2021-04-27 12:00:08', '2021-04-27 12:00:08'),
(40, 41, 0.00, 0.00, 0.00, 0.00, '2021-04-27 13:48:02', '2021-04-27 13:48:02'),
(41, 42, 0.00, 0.00, 0.00, 0.00, '2021-05-07 19:08:53', '2021-05-07 19:08:53'),
(42, 43, 0.00, 0.00, 0.00, 0.00, '2021-07-13 17:17:25', '2021-07-13 17:17:25'),
(43, 44, 0.00, 0.00, 0.00, 0.00, '2021-07-26 10:04:11', '2021-07-26 10:04:11'),
(44, 45, 0.00, 0.00, 0.00, 0.00, '2021-09-13 09:29:24', '2021-09-13 09:29:24'),
(45, 46, 0.00, 0.00, 0.00, 0.00, '2021-11-12 08:32:49', '2021-11-12 08:32:49'),
(46, 47, 0.00, 0.00, 0.00, 0.00, '2021-11-12 08:44:39', '2021-11-12 08:44:39'),
(47, 48, 0.00, 0.00, 0.00, 0.00, '2021-11-12 08:46:55', '2021-11-12 08:46:55'),
(48, 49, 0.00, 0.00, 0.00, 0.00, '2021-11-12 09:13:31', '2021-11-12 09:13:31'),
(49, 50, 0.00, 0.00, 0.00, 0.00, '2021-11-15 10:09:46', '2021-11-15 10:09:46'),
(50, 51, 0.00, 0.00, 0.00, 0.00, '2021-11-17 09:58:57', '2021-11-17 09:58:57'),
(51, 52, 0.00, 0.00, 0.00, 0.00, '2021-11-24 04:27:21', '2021-11-24 04:27:21'),
(52, 53, 0.00, 0.00, 0.00, 0.00, '2021-11-24 04:28:27', '2021-11-24 04:28:27'),
(53, 54, 0.00, 0.00, 0.00, 0.00, '2021-11-24 04:29:17', '2021-11-24 04:29:17'),
(54, 55, 0.00, 0.00, 0.00, 0.00, '2021-11-24 04:31:06', '2021-11-24 04:31:06'),
(55, 56, 0.00, 0.00, 0.00, 0.00, '2021-11-24 04:32:30', '2021-11-24 04:32:30'),
(56, 57, 0.00, 0.00, 0.00, 0.00, '2021-11-24 04:38:09', '2021-11-24 04:38:09'),
(57, 58, 0.00, 0.00, 0.00, 0.00, '2021-11-28 13:26:25', '2021-11-28 13:26:25'),
(58, 59, 0.00, 0.00, 0.00, 0.00, '2021-12-02 09:02:14', '2021-12-02 09:02:14'),
(59, 60, 0.00, 0.00, 0.00, 0.00, '2021-12-02 09:31:05', '2021-12-02 09:31:05'),
(60, 61, 0.00, 0.00, 0.00, 0.00, '2021-12-02 09:31:08', '2021-12-02 09:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `account` int(1) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Amount involved in transaction',
  `date_created` datetime DEFAULT current_timestamp(),
  `date_completed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `status`, `account`, `amount`, `date_created`, `date_completed`) VALUES
(1, 2, 0, 0, 100.00, '2020-12-16 14:53:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_request`
--

CREATE TABLE `withdrawal_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `amount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal_request`
--

INSERT INTO `withdrawal_request` (`id`, `user_id`, `amount`, `status`, `date_created`) VALUES
(1, 8, '4454', 0, '2021-03-14 17:47:28'),
(2, 4, '4000.00', 1, '2021-05-25 10:45:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earning_histories`
--
ALTER TABLE `earning_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fund_deposit`
--
ALTER TABLE `fund_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fund_wallet`
--
ALTER TABLE `fund_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matrices`
--
ALTER TABLE `matrices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matrix_details`
--
ALTER TABLE `matrix_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matrix_transactions`
--
ALTER TABLE `matrix_transactions`
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
-- Indexes for table `paystack_transactions`
--
ALTER TABLE `paystack_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `pie_system`
--
ALTER TABLE `pie_system`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pie_transactions`
--
ALTER TABLE `pie_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pie_withdrawals`
--
ALTER TABLE `pie_withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pins`
--
ALTER TABLE `pins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pin` (`pin`);

--
-- Indexes for table `recharge`
--
ALTER TABLE `recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recharge_airtime`
--
ALTER TABLE `recharge_airtime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `wallet` (`wallet`),
  ADD KEY `phone_number` (`phone_number`),
  ADD KEY `user_id_2` (`user_id`,`wallet`);

--
-- Indexes for table `recharge_commissions`
--
ALTER TABLE `recharge_commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recharge_data`
--
ALTER TABLE `recharge_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recharge_fund_wallet`
--
ALTER TABLE `recharge_fund_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recharge_transactions`
--
ALTER TABLE `recharge_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recharge_withdrawal`
--
ALTER TABLE `recharge_withdrawal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_histories`
--
ALTER TABLE `transaction_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vital_variables`
--
ALTER TABLE `vital_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_request`
--
ALTER TABLE `withdrawal_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `earning_histories`
--
ALTER TABLE `earning_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fund_deposit`
--
ALTER TABLE `fund_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fund_wallet`
--
ALTER TABLE `fund_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `matrices`
--
ALTER TABLE `matrices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'matrix id';

--
-- AUTO_INCREMENT for table `matrix_details`
--
ALTER TABLE `matrix_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matrix_transactions`
--
ALTER TABLE `matrix_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paystack_transactions`
--
ALTER TABLE `paystack_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pie_system`
--
ALTER TABLE `pie_system`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pie_transactions`
--
ALTER TABLE `pie_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pie_withdrawals`
--
ALTER TABLE `pie_withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pins`
--
ALTER TABLE `pins`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `recharge`
--
ALTER TABLE `recharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `recharge_airtime`
--
ALTER TABLE `recharge_airtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recharge_commissions`
--
ALTER TABLE `recharge_commissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recharge_data`
--
ALTER TABLE `recharge_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recharge_fund_wallet`
--
ALTER TABLE `recharge_fund_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recharge_transactions`
--
ALTER TABLE `recharge_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recharge_withdrawal`
--
ALTER TABLE `recharge_withdrawal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction_histories`
--
ALTER TABLE `transaction_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `vital_variables`
--
ALTER TABLE `vital_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawal_request`
--
ALTER TABLE `withdrawal_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
