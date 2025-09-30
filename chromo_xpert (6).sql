-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2025 at 07:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chromo_xpert`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_code` varchar(255) DEFAULT NULL,
  `lab_id` bigint(20) DEFAULT NULL,
  `referee_doctor_id` bigint(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `pet_id` bigint(20) DEFAULT NULL,
  `petowner_id` bigint(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_status` enum('Pending','Completed','Failed') DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_code`, `lab_id`, `referee_doctor_id`, `appointment_date`, `appointment_time`, `pet_id`, `petowner_id`, `notes`, `subtotal`, `discount`, `total`, `paid_amount`, `due_amount`, `payment_mode`, `transaction_id`, `payment_status`, `payment_date`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'APT001', 1, 1, '2025-09-18', '13:33:00', 3, 1, 'NA', 1000.00, 100.00, 900.00, NULL, NULL, 'Cash', NULL, 'Pending', '2025-09-18 00:00:00', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-18 02:30:49', '2025-09-18 02:30:49'),
(2, 'APT002', 1, 1, '2025-09-18', '18:00:00', 3, 1, 'NA', 200.00, NULL, 200.00, NULL, NULL, 'Cash', '1233', 'Pending', '2025-09-18 00:00:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-18 07:30:48', '2025-09-18 07:30:48'),
(3, 'APT003', 1, 1, '2025-09-22', '10:20:00', 3, 1, NULL, 900.00, NULL, 900.00, NULL, NULL, 'Cash', NULL, 'Completed', '2025-09-22 00:00:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-21 23:17:53', '2025-09-21 23:17:53'),
(4, 'APT004', 1, 1, '2025-09-22', '12:10:00', 3, 1, NULL, 900.00, 50.00, 850.00, NULL, NULL, 'Cash', NULL, 'Completed', '2025-09-22 00:00:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-21 23:34:26', '2025-09-21 23:34:26'),
(5, 'APT005', 1, 1, '2025-09-22', '13:49:00', 3, 1, NULL, 1700.00, 100.00, 1600.00, NULL, NULL, 'Cash', NULL, 'Completed', '2025-09-22 13:49:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-22 02:49:42', '2025-09-22 02:49:42'),
(6, 'APT006', 1, 1, '2025-09-22', '15:06:00', 3, 1, NULL, 900.00, 50.00, 850.00, 700.00, 150.00, 'Cash', NULL, 'Pending', '2025-09-22 15:06:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-22 04:08:02', '2025-09-22 04:08:02'),
(7, 'APT007', 1, 1, '2025-09-22', '15:06:00', 3, 1, NULL, 900.00, 50.00, 850.00, 700.00, 150.00, 'Cash', NULL, 'Pending', '2025-09-22 15:06:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-22 04:09:46', '2025-09-22 04:09:46'),
(8, 'APT008', 1, 1, '2025-09-22', '16:30:00', 3, 1, NULL, 900.00, 50.00, 850.00, 700.00, 150.00, 'UPI', '1233', 'Completed', '2025-09-22 16:30:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-22 05:31:58', '2025-09-22 05:31:58'),
(9, 'APT009', 1, 1, '2025-09-22', '17:37:00', 3, 1, NULL, 900.00, 50.00, 850.00, 600.00, 250.00, 'Card', NULL, 'Pending', '2025-09-22 17:37:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-22 06:39:24', '2025-09-22 06:39:24'),
(10, 'APT010', 1, 1, '2025-09-23', '10:57:00', 3, 1, NULL, 2500.00, 100.00, 2400.00, 2400.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-23 10:57:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-22 23:58:30', '2025-09-22 23:58:30'),
(11, 'APT011', 1, 1, '2025-09-23', '16:00:00', 3, 1, NULL, 4300.00, 300.00, 4000.00, 4000.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-23 16:58:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-23 05:59:57', '2025-09-23 05:59:58'),
(12, 'APT012', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 01:56:30', '2025-09-24 01:56:30'),
(13, 'APT013', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 02:04:26', '2025-09-24 02:04:26'),
(14, 'APT014', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 02:11:04', '2025-09-24 02:11:04'),
(15, 'APT015', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 02:11:43', '2025-09-24 02:11:43'),
(16, 'APT016', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 02:12:18', '2025-09-24 02:12:18'),
(17, 'APT017', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 02:13:44', '2025-09-24 02:13:44'),
(18, 'APT018', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 02:22:45', '2025-09-24 02:22:45'),
(19, 'APT019', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 03:30:09', '2025-09-24 03:30:09'),
(20, 'APT020', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 03:34:22', '2025-09-24 03:34:22'),
(21, 'APT021', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 03:35:50', '2025-09-24 03:35:50'),
(22, 'APT022', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 03:36:53', '2025-09-24 03:36:53'),
(23, 'APT023', 1, 1, '2025-09-24', '12:55:00', 14, 11, NULL, 1700.00, 100.00, 1600.00, 1600.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-24 12:55:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 03:37:17', '2025-09-24 03:37:17'),
(24, 'APT024', 1, 1, '2025-09-26', '10:50:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-26 10:50:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-25 23:51:12', '2025-09-25 23:51:12'),
(25, 'APT025', 1, 1, '2025-09-26', '11:26:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-26 11:26:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-26 00:27:25', '2025-09-26 00:27:25'),
(26, 'APT026', 1, 1, '2025-09-26', '11:38:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Pending', '2025-09-26 11:38:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-26 00:39:49', '2025-09-26 00:39:49'),
(27, 'APT027', 1, 1, '2025-09-26', '11:38:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Pending', '2025-09-26 11:38:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-26 00:47:02', '2025-09-26 00:47:02'),
(28, 'APT028', 1, 1, '2025-09-26', '11:47:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-26 11:47:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-26 00:47:53', '2025-09-26 00:47:54'),
(29, 'APT029', 1, 1, '2025-09-26', '11:47:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-26 11:47:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-26 00:48:45', '2025-09-26 00:48:45'),
(30, 'APT030', 1, 1, '2025-09-26', '11:50:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-26 11:50:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-26 00:51:02', '2025-09-26 00:51:02'),
(31, 'APT031', 1, 1, '2025-09-26', '12:51:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-26 12:51:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-26 01:51:57', '2025-09-26 01:51:57'),
(32, 'APT032', 1, 1, '2025-09-26', '12:52:00', 3, 1, NULL, 900.00, NULL, 900.00, 900.00, 0.00, 'Cash', NULL, 'Completed', '2025-09-26 12:52:00', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-26 01:53:24', '2025-09-26 01:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_tests`
--

CREATE TABLE `appointment_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) DEFAULT NULL,
  `test_id` bigint(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_tests`
--

INSERT INTO `appointment_tests` (`id`, `appointment_id`, `test_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, '2025-09-18 02:30:50', '2025-09-18 02:30:50'),
(2, 1, 3, NULL, '2025-09-18 02:30:50', '2025-09-18 02:30:50'),
(3, 2, 4, NULL, '2025-09-18 07:30:49', '2025-09-18 07:30:49'),
(4, 3, 2, NULL, '2025-09-21 23:17:53', '2025-09-21 23:17:53'),
(5, 4, 2, NULL, '2025-09-21 23:34:26', '2025-09-21 23:34:26'),
(6, 5, 2, NULL, '2025-09-22 02:49:42', '2025-09-22 02:49:42'),
(7, 5, 3, NULL, '2025-09-22 02:49:42', '2025-09-22 02:49:42'),
(8, 6, 2, NULL, '2025-09-22 04:08:02', '2025-09-22 04:08:02'),
(9, 7, 2, NULL, '2025-09-22 04:09:46', '2025-09-22 04:09:46'),
(10, 8, 2, NULL, '2025-09-22 05:31:58', '2025-09-22 05:31:58'),
(11, 9, 2, NULL, '2025-09-22 06:39:24', '2025-09-22 06:39:24'),
(12, 10, 2, NULL, '2025-09-22 23:58:30', '2025-09-22 23:58:30'),
(13, 10, 3, NULL, '2025-09-22 23:58:30', '2025-09-22 23:58:30'),
(14, 10, 5, NULL, '2025-09-22 23:58:30', '2025-09-22 23:58:30'),
(15, 11, 2, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(16, 11, 3, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(17, 11, 4, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(18, 11, 5, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(19, 11, 6, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(20, 11, 10, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(21, 12, 2, NULL, '2025-09-24 01:56:30', '2025-09-24 01:56:30'),
(22, 12, 3, NULL, '2025-09-24 01:56:30', '2025-09-24 01:56:30'),
(23, 13, 2, NULL, '2025-09-24 02:04:26', '2025-09-24 02:04:26'),
(24, 13, 3, NULL, '2025-09-24 02:04:26', '2025-09-24 02:04:26'),
(25, 14, 2, NULL, '2025-09-24 02:11:04', '2025-09-24 02:11:04'),
(26, 14, 3, NULL, '2025-09-24 02:11:04', '2025-09-24 02:11:04'),
(27, 15, 2, NULL, '2025-09-24 02:11:43', '2025-09-24 02:11:43'),
(28, 15, 3, NULL, '2025-09-24 02:11:43', '2025-09-24 02:11:43'),
(29, 16, 2, NULL, '2025-09-24 02:12:18', '2025-09-24 02:12:18'),
(30, 16, 3, NULL, '2025-09-24 02:12:18', '2025-09-24 02:12:18'),
(31, 17, 2, NULL, '2025-09-24 02:13:44', '2025-09-24 02:13:44'),
(32, 17, 3, NULL, '2025-09-24 02:13:44', '2025-09-24 02:13:44'),
(33, 18, 2, NULL, '2025-09-24 02:22:45', '2025-09-24 02:22:45'),
(34, 18, 3, NULL, '2025-09-24 02:22:45', '2025-09-24 02:22:45'),
(35, 19, 2, NULL, '2025-09-24 03:30:09', '2025-09-24 03:30:09'),
(36, 19, 3, NULL, '2025-09-24 03:30:09', '2025-09-24 03:30:09'),
(37, 20, 2, NULL, '2025-09-24 03:34:22', '2025-09-24 03:34:22'),
(38, 20, 3, NULL, '2025-09-24 03:34:22', '2025-09-24 03:34:22'),
(39, 21, 2, NULL, '2025-09-24 03:35:50', '2025-09-24 03:35:50'),
(40, 21, 3, NULL, '2025-09-24 03:35:50', '2025-09-24 03:35:50'),
(41, 22, 2, NULL, '2025-09-24 03:36:53', '2025-09-24 03:36:53'),
(42, 22, 3, NULL, '2025-09-24 03:36:53', '2025-09-24 03:36:53'),
(43, 23, 2, NULL, '2025-09-24 03:37:17', '2025-09-24 03:37:17'),
(44, 23, 3, NULL, '2025-09-24 03:37:17', '2025-09-24 03:37:17'),
(45, 24, 2, NULL, '2025-09-25 23:51:12', '2025-09-25 23:51:12'),
(46, 25, 12, NULL, '2025-09-26 00:27:25', '2025-09-26 00:27:25'),
(47, 26, 2, NULL, '2025-09-26 00:39:49', '2025-09-26 00:39:49'),
(48, 27, 2, NULL, '2025-09-26 00:47:02', '2025-09-26 00:47:02'),
(49, 28, 2, NULL, '2025-09-26 00:47:54', '2025-09-26 00:47:54'),
(50, 29, 2, NULL, '2025-09-26 00:48:45', '2025-09-26 00:48:45'),
(51, 30, 2, NULL, '2025-09-26 00:51:02', '2025-09-26 00:51:02'),
(52, 31, 2, NULL, '2025-09-26 01:51:57', '2025-09-26 01:51:57'),
(53, 32, 2, NULL, '2025-09-26 01:53:24', '2025-09-26 01:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_code` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `state_id` bigint(20) DEFAULT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `branch_logo_name` varchar(255) DEFAULT NULL,
  `branch_logo_path` varchar(255) DEFAULT NULL,
  `lab_incharge` bigint(20) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `branch_name`, `email`, `mobile`, `address`, `country_id`, `state_id`, `city_id`, `pincode`, `branch_logo_name`, `branch_logo_path`, `lab_incharge`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BR001', 'PandrPur Lab Deepak', 'pndl1@gmail.com', '+919173185601', 'Bair Amad Karari1', 1, 20, 523, '212216', 'download (1).jpeg', 'images/branches/zq6yXfxtfV3yuZ0TUKf1qYFhpFPDTKrdLi71bG2h.jpg', 2, '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-02 06:28:13', '2025-09-02 23:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `name`, `state_id`) VALUES
(1, 'Port Blair', 1),
(2, 'Adoni', 2),
(3, 'Amaravati', 2),
(4, 'Anantapur', 2),
(5, 'Chandragiri', 2),
(6, 'Chittoor', 2),
(7, 'Dowlaiswaram', 2),
(8, 'Eluru', 2),
(9, 'Guntur', 2),
(10, 'Kadapa', 2),
(11, 'Kakinada', 2),
(12, 'Kurnool', 2),
(13, 'Machilipatnam', 2),
(14, 'Nagarjunakoṇḍa', 2),
(15, 'Rajahmundry', 2),
(16, 'Srikakulam', 2),
(17, 'Tirupati', 2),
(18, 'Vijayawada', 2),
(19, 'Visakhapatnam', 2),
(20, 'Vizianagaram', 2),
(21, 'Yemmiganur', 2),
(22, 'Itanagar', 3),
(23, 'Dhuburi', 4),
(24, 'Dibrugarh', 4),
(25, 'Dispur', 4),
(26, 'Guwahati', 4),
(27, 'Jorhat', 4),
(28, 'Nagaon', 4),
(29, 'Sivasagar', 4),
(30, 'Silchar', 4),
(31, 'Tezpur', 4),
(32, 'Tinsukia', 4),
(33, 'Ara', 5),
(34, 'Barauni', 5),
(35, 'Begusarai', 5),
(36, 'Bettiah', 5),
(37, 'Bhagalpur', 5),
(38, 'Bihar Sharif', 5),
(39, 'Bodh Gaya', 5),
(40, 'Buxar', 5),
(41, 'Chapra', 5),
(42, 'Darbhanga', 5),
(43, 'Dehri', 5),
(44, 'Dinapur Nizamat', 5),
(45, 'Gaya', 5),
(46, 'Hajipur', 5),
(47, 'Jamalpur', 5),
(48, 'Katihar', 5),
(49, 'Madhubani', 5),
(50, 'Motihari', 5),
(51, 'Munger', 5),
(52, 'Muzaffarpur', 5),
(53, 'Patna', 5),
(54, 'Purnia', 5),
(55, 'Pusa', 5),
(56, 'Saharsa', 5),
(57, 'Samastipur', 5),
(58, 'Sasaram', 5),
(59, 'Sitamarhi', 5),
(60, 'Siwan', 5),
(61, 'Chandigarh', 6),
(62, 'Ambikapur', 7),
(63, 'Bhilai', 7),
(64, 'Bilaspur', 7),
(65, 'Dhamtari', 7),
(66, 'Durg', 7),
(67, 'Jagdalpur', 7),
(68, 'Raipur', 7),
(69, 'Rajnandgaon', 7),
(70, 'Daman', 8),
(71, 'Diu', 8),
(72, 'Silvassa', 8),
(73, 'Delhi', 9),
(74, 'New Delhi', 9),
(75, 'Madgaon', 10),
(76, 'Panaji', 10),
(77, 'Ahmadabad', 11),
(78, 'Amreli', 11),
(79, 'Bharuch', 11),
(80, 'Bhavnagar', 11),
(81, 'Bhuj', 11),
(82, 'Dwarka', 11),
(83, 'Gandhinagar', 11),
(84, 'Godhra', 11),
(85, 'Jamnagar', 11),
(86, 'Junagadh', 11),
(87, 'Kandla', 11),
(88, 'Khambhat', 11),
(89, 'Kheda', 11),
(90, 'Mahesana', 11),
(91, 'Morbi', 11),
(92, 'Nadiad', 11),
(93, 'Navsari', 11),
(94, 'Okha', 11),
(95, 'Palanpur', 11),
(96, 'Patan', 11),
(97, 'Porbandar', 11),
(98, 'Rajkot', 11),
(99, 'Surat', 11),
(100, 'Surendranagar', 11),
(101, 'Valsad', 11),
(102, 'Veraval', 11),
(103, 'Ambala', 12),
(104, 'Bhiwani', 12),
(105, 'Chandigarh', 12),
(106, 'Faridabad', 12),
(107, 'Firozpur Jhirka', 12),
(108, 'Gurugram', 12),
(109, 'Hansi', 12),
(110, 'Hisar', 12),
(111, 'Jind', 12),
(112, 'Kaithal', 12),
(113, 'Karnal', 12),
(114, 'Kurukshetra', 12),
(115, 'Panipat', 12),
(116, 'Pehowa', 12),
(117, 'Rewari', 12),
(118, 'Rohtak', 12),
(119, 'Sirsa', 12),
(120, 'Sonipat', 12),
(121, 'Bilaspur', 13),
(122, 'Chamba', 13),
(123, 'Dalhousie', 13),
(124, 'Dharmshala', 13),
(125, 'Hamirpur', 13),
(126, 'Kangra', 13),
(127, 'Kullu', 13),
(128, 'Mandi', 13),
(129, 'Nahan', 13),
(130, 'Shimla', 13),
(131, 'Una', 13),
(132, 'Anantnag', 14),
(133, 'Baramula', 14),
(134, 'Doda', 14),
(135, 'Gulmarg', 14),
(136, 'Jammu', 14),
(137, 'Kathua', 14),
(138, 'Punch', 14),
(139, 'Rajouri', 14),
(140, 'Srinagar', 14),
(141, 'Udhampur', 14),
(142, 'Bokaro', 15),
(143, 'Chaibasa', 15),
(144, 'Deoghar', 15),
(145, 'Dhanbad', 15),
(146, 'Dumka', 15),
(147, 'Giridih', 15),
(148, 'Hazaribag', 15),
(149, 'Jamshedpur', 15),
(150, 'Jharia', 15),
(151, 'Rajmahal', 15),
(152, 'Ranchi', 15),
(153, 'Saraikela', 15),
(154, 'Badami', 16),
(155, 'Ballari', 16),
(156, 'Bengaluru', 16),
(157, 'Belagavi', 16),
(158, 'Bhadravati', 16),
(159, 'Bidar', 16),
(160, 'Chikkamagaluru', 16),
(161, 'Chitradurga', 16),
(162, 'Davangere', 16),
(163, 'Halebid', 16),
(164, 'Hassan', 16),
(165, 'Hubballi-Dharwad', 16),
(166, 'Kalaburagi', 16),
(167, 'Kolar', 16),
(168, 'Madikeri', 16),
(169, 'Mandya', 16),
(170, 'Mangaluru', 16),
(171, 'Mysuru', 16),
(172, 'Raichur', 16),
(173, 'Shivamogga', 16),
(174, 'Shravanabelagola', 16),
(175, 'Shrirangapattana', 16),
(176, 'Tumakuru', 16),
(177, 'Vijayapura', 16),
(178, 'Alappuzha', 17),
(179, 'Vatakara', 17),
(180, 'Idukki', 17),
(181, 'Kannur', 17),
(182, 'Kochi', 17),
(183, 'Kollam', 17),
(184, 'Kottayam', 17),
(185, 'Kozhikode', 17),
(186, 'Mattancheri', 17),
(187, 'Palakkad', 17),
(188, 'Thalassery', 17),
(189, 'Thiruvananthapuram', 17),
(190, 'Thrissur', 17),
(191, 'Kargil', 18),
(192, 'Leh', 18),
(193, 'Balaghat', 19),
(194, 'Barwani', 19),
(195, 'Betul', 19),
(196, 'Bharhut', 19),
(197, 'Bhind', 19),
(198, 'Bhojpur', 19),
(199, 'Bhopal', 19),
(200, 'Burhanpur', 19),
(201, 'Chhatarpur', 19),
(202, 'Chhindwara', 19),
(203, 'Damoh', 19),
(204, 'Datia', 19),
(205, 'Dewas', 19),
(206, 'Dhar', 19),
(207, 'Dr. Ambedkar Nagar (Mhow)', 19),
(208, 'Guna', 19),
(209, 'Gwalior', 19),
(210, 'Hoshangabad', 19),
(211, 'Indore', 19),
(212, 'Itarsi', 19),
(213, 'Jabalpur', 19),
(214, 'Jhabua', 19),
(215, 'Khajuraho', 19),
(216, 'Khandwa', 19),
(217, 'Khargone', 19),
(218, 'Maheshwar', 19),
(219, 'Mandla', 19),
(220, 'Mandsaur', 19),
(221, 'Morena', 19),
(222, 'Murwara', 19),
(223, 'Narsimhapur', 19),
(224, 'Narsinghgarh', 19),
(225, 'Narwar', 19),
(226, 'Neemuch', 19),
(227, 'Nowgong', 19),
(228, 'Orchha', 19),
(229, 'Panna', 19),
(230, 'Raisen', 19),
(231, 'Rajgarh', 19),
(232, 'Ratlam', 19),
(233, 'Rewa', 19),
(234, 'Sagar', 19),
(235, 'Sarangpur', 19),
(236, 'Satna', 19),
(237, 'Sehore', 19),
(238, 'Seoni', 19),
(239, 'Shahdol', 19),
(240, 'Shajapur', 19),
(241, 'Sheopur', 19),
(242, 'Shivpuri', 19),
(243, 'Ujjain', 19),
(244, 'Vidisha', 19),
(281, 'Imphal', 21),
(282, 'Cherrapunji', 22),
(283, 'Shillong', 22),
(284, 'Aizawl', 23),
(285, 'Lunglei', 23),
(286, 'Kohima', 24),
(287, 'Mon', 24),
(288, 'Phek', 24),
(289, 'Wokha', 24),
(290, 'Zunheboto', 24),
(291, 'Balangir', 25),
(292, 'Baleshwar', 25),
(293, 'Baripada', 25),
(294, 'Bhubaneshwar', 25),
(295, 'Brahmapur', 25),
(296, 'Cuttack', 25),
(297, 'Dhenkanal', 25),
(298, 'Kendujhar', 25),
(299, 'Konark', 25),
(300, 'Koraput', 25),
(301, 'Paradip', 25),
(302, 'Phulabani', 25),
(303, 'Puri', 25),
(304, 'Sambalpur', 25),
(305, 'Udayagiri', 25),
(306, 'Karaikal', 26),
(307, 'Mahe', 26),
(308, 'Puducherry', 26),
(309, 'Yanam', 26),
(310, 'Amritsar', 27),
(311, 'Batala', 27),
(312, 'Chandigarh', 27),
(313, 'Faridkot', 27),
(314, 'Firozpur', 27),
(315, 'Gurdaspur', 27),
(316, 'Hoshiarpur', 27),
(317, 'Jalandhar', 27),
(318, 'Kapurthala', 27),
(319, 'Ludhiana', 27),
(320, 'Nabha', 27),
(321, 'Patiala', 27),
(322, 'Rupnagar', 27),
(323, 'Sangrur', 27),
(324, 'Abu', 28),
(325, 'Ajmer', 28),
(326, 'Alwar', 28),
(327, 'Amer', 28),
(328, 'Barmer', 28),
(329, 'Beawar', 28),
(330, 'Bharatpur', 28),
(331, 'Bhilwara', 28),
(332, 'Bikaner', 28),
(333, 'Bundi', 28),
(334, 'Chittaurgarh', 28),
(335, 'Churu', 28),
(336, 'Dhaulpur', 28),
(337, 'Dungarpur', 28),
(338, 'Ganganagar', 28),
(339, 'Hanumangarh', 28),
(340, 'Jaipur', 28),
(341, 'Jaisalmer', 28),
(342, 'Jalor', 28),
(343, 'Jhalawar', 28),
(344, 'Jhunjhunu', 28),
(345, 'Jodhpur', 28),
(346, 'Kishangarh', 28),
(347, 'Kota', 28),
(348, 'Merta', 28),
(349, 'Nagaur', 28),
(350, 'Nathdwara', 28),
(351, 'Pali', 28),
(352, 'Phalodi', 28),
(353, 'Pushkar', 28),
(354, 'Sawai Madhopur', 28),
(355, 'Shahpura', 28),
(356, 'Sikar', 28),
(357, 'Sirohi', 28),
(358, 'Tonk', 28),
(359, 'Udaipur', 28),
(360, 'Gangtok', 29),
(361, 'Gyalshing', 29),
(362, 'Lachung', 29),
(363, 'Mangan', 29),
(364, 'Arcot', 30),
(365, 'Chengalpattu', 30),
(366, 'Chennai', 30),
(367, 'Chidambaram', 30),
(368, 'Coimbatore', 30),
(369, 'Cuddalore', 30),
(370, 'Dharmapuri', 30),
(371, 'Dindigul', 30),
(372, 'Erode', 30),
(373, 'Kanchipuram', 30),
(374, 'Kanniyakumari', 30),
(375, 'Kodaikanal', 30),
(376, 'Kumbakonam', 30),
(377, 'Madurai', 30),
(378, 'Mamallapuram', 30),
(379, 'Nagappattinam', 30),
(380, 'Nagercoil', 30),
(381, 'Palayamkottai', 30),
(382, 'Pudukkottai', 30),
(383, 'Rajapalayam', 30),
(384, 'Ramanathapuram', 30),
(385, 'Salem', 30),
(386, 'Thanjavur', 30),
(387, 'Tiruchchirappalli', 30),
(388, 'Tirunelveli', 30),
(389, 'Tiruppur', 30),
(390, 'Thoothukudi', 30),
(391, 'Udhagamandalam', 30),
(392, 'Vellore', 30),
(393, 'Hyderabad', 31),
(394, 'Karimnagar', 31),
(395, 'Khammam', 31),
(396, 'Mahbubnagar', 31),
(397, 'Nizamabad', 31),
(398, 'Sangareddi', 31),
(399, 'Warangal', 31),
(400, 'Agartala', 32),
(401, 'Agra', 33),
(402, 'Aligarh', 33),
(403, 'Amroha', 33),
(404, 'Ayodhya', 33),
(405, 'Azamgarh', 33),
(406, 'Bahraich', 33),
(407, 'Ballia', 33),
(408, 'Banda', 33),
(409, 'Bara Banki', 33),
(410, 'Bareilly', 33),
(411, 'Basti', 33),
(412, 'Bijnor', 33),
(413, 'Bithur', 33),
(414, 'Budaun', 33),
(415, 'Bulandshahr', 33),
(416, 'Deoria', 33),
(417, 'Etah', 33),
(418, 'Etawah', 33),
(419, 'Faizabad', 33),
(420, 'Farrukhabad-cum-Fatehgarh', 33),
(421, 'Fatehpur', 33),
(422, 'Fatehpur Sikri', 33),
(423, 'Ghaziabad', 33),
(424, 'Ghazipur', 33),
(425, 'Gonda', 33),
(426, 'Gorakhpur', 33),
(427, 'Hamirpur', 33),
(428, 'Hardoi', 33),
(429, 'Hathras', 33),
(430, 'Jalaun', 33),
(431, 'Jaunpur', 33),
(432, 'Jhansi', 33),
(433, 'Kannauj', 33),
(434, 'Kanpur', 33),
(435, 'Lakhimpur', 33),
(436, 'Lalitpur', 33),
(437, 'Lucknow', 33),
(438, 'Mainpuri', 33),
(439, 'Mathura', 33),
(440, 'Meerut', 33),
(441, 'Mirzapur-Vindhyachal', 33),
(442, 'Moradabad', 33),
(443, 'Muzaffarnagar', 33),
(444, 'Partapgarh', 33),
(445, 'Pilibhit', 33),
(446, 'Prayagraj', 33),
(447, 'Rae Bareli', 33),
(448, 'Rampur', 33),
(449, 'Saharanpur', 33),
(450, 'Sambhal', 33),
(451, 'Shahjahanpur', 33),
(452, 'Sitapur', 33),
(453, 'Sultanpur', 33),
(454, 'Tehri', 33),
(455, 'Varanasi', 33),
(456, 'Almora', 34),
(457, 'Dehra Dun', 34),
(458, 'Haridwar', 34),
(459, 'Mussoorie', 34),
(460, 'Nainital', 34),
(461, 'Pithoragarh', 34),
(462, 'Alipore', 35),
(463, 'Alipur Duar', 35),
(464, 'Asansol', 35),
(465, 'Baharampur', 35),
(466, 'Bally', 35),
(467, 'Balurghat', 35),
(468, 'Bankura', 35),
(469, 'Baranagar', 35),
(470, 'Barasat', 35),
(471, 'Barrackpore', 35),
(472, 'Basirhat', 35),
(473, 'Bhatpara', 35),
(474, 'Bishnupur', 35),
(475, 'Budge Budge', 35),
(476, 'Burdwan', 35),
(477, 'Chandernagore', 35),
(478, 'Darjeeling', 35),
(479, 'Diamond Harbour', 35),
(480, 'Dum Dum', 35),
(481, 'Durgapur', 35),
(482, 'Halisahar', 35),
(483, 'Haora', 35),
(484, 'Hugli', 35),
(485, 'Ingraj Bazar', 35),
(486, 'Jalpaiguri', 35),
(487, 'Kalimpong', 35),
(488, 'Kamarhati', 35),
(489, 'Kanchrapara', 35),
(490, 'Kharagpur', 35),
(491, 'Cooch Behar', 35),
(492, 'Kolkata', 35),
(493, 'Krishnanagar', 35),
(494, 'Malda', 35),
(495, 'Midnapore', 35),
(496, 'Murshidabad', 35),
(497, 'Nabadwip', 35),
(498, 'Palashi', 35),
(499, 'Panihati', 35),
(500, 'Purulia', 35),
(501, 'Raiganj', 35),
(502, 'Santipur', 35),
(503, 'Shantiniketan', 35),
(504, 'Shrirampur', 35),
(505, 'Siliguri', 35),
(506, 'Siuri', 35),
(507, 'Tamluk', 35),
(508, 'Titagarh', 35),
(509, 'Ahmednagar', 20),
(510, 'Akola', 20),
(511, 'Amravati', 20),
(512, 'Aurangabad', 20),
(513, 'Beed', 20),
(514, 'Bhandara', 20),
(515, 'Buldhana', 20),
(516, 'Chandrapur', 20),
(517, 'Dhule', 20),
(518, 'Gadchiroli', 20),
(519, 'Gondia', 20),
(520, 'Hingoli', 20),
(521, 'Jalgaon', 20),
(522, 'Jalna', 20),
(523, 'Kolhapur', 20),
(524, 'Latur', 20),
(525, 'Mumbai City', 20),
(526, 'Mumbai Suburban', 20),
(527, 'Nagpur', 20),
(528, 'Nanded', 20),
(529, 'Nandurbar', 20),
(530, 'Nashik', 20),
(531, 'Osmanabad', 20),
(532, 'Palghar', 20),
(533, 'Parbhani', 20),
(534, 'Pune', 20),
(535, 'Raigad', 20),
(536, 'Ratnagiri', 20),
(537, 'Sangli', 20),
(538, 'Satara', 20),
(539, 'Sindhudurg', 20),
(540, 'Solapur', 20),
(541, 'Thane', 20),
(542, 'Wardha', 20),
(543, 'Washim', 20),
(544, 'Yavatmal', 20);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `name`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `department_head` bigint(20) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `code`, `department_name`, `description`, `email`, `mobile`, `department_head`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DEPT001', 'Pathology', NULL, 'ddh@gmail.com', '+917318560108', 14, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-15 23:39:13', '2025-09-15 23:39:13'),
(2, 'DEPT002', 'Radiology', NULL, 'ddh@gmail.com', '+917318560108', 14, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-15 23:39:41', '2025-09-15 23:39:41'),
(3, 'DEPT003', 'Cardiology', NULL, 'ddh@gmail.com', '+917318560108', 14, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-15 23:40:09', '2025-09-15 23:40:09'),
(4, 'DEPT004', 'Microbiology', NULL, 'ddh@gmail.com', '+917318560108', 14, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-15 23:41:30', '2025-09-15 23:41:30'),
(5, 'DEPT005', 'Biochemistry', NULL, 'ddh@gmail.com', '+917318560108', 14, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-15 23:43:47', '2025-09-15 23:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `map_link` longtext DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `skype_url` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `email`, `mobile`, `address`, `map_link`, `facebook_url`, `linkedin_url`, `instagram_url`, `twitter_url`, `skype_url`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '07318560108', 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-08-11 06:33:23', '2025-08-11 06:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `internal_doctors`
--

CREATE TABLE `internal_doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `doctor_image_name` varchar(255) DEFAULT NULL,
  `doctor_image_path` varchar(255) DEFAULT NULL,
  `doctor_sign_name` varchar(255) DEFAULT NULL,
  `doctor_sign_path` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internal_doctors`
--

INSERT INTO `internal_doctors` (`id`, `code`, `doctor_name`, `gender`, `email`, `mobile`, `address`, `doctor_image_name`, `doctor_image_path`, `doctor_sign_name`, `doctor_sign_path`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ID0001', 'Dr Deepak Internal Doctor1', 'Male', 'drdeepakinternaldoctor1@gmail.com', '+917318560108', 'Bair Amad Karari1', 'SmartSelect_20240905_214054_WhatsApp-sunil-jatania.jpg', 'images/internal_doctors/up3g9sanUufnVqUB4gXDL1Ca0yng801PLstwDHgG.jpg', 'fake-signature-10161016-facsimile-11562888097yoll1qgp4t.png', 'images/internal_doctors/signatures/c6rxVeP6mCZr9J7RDQ8HHcKqTxVJMynICOQ5es3p.png', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-02 00:12:14', '2025-09-02 00:44:55'),
(2, 'ID0002', 'xyz', 'Male', 'xyz@gmail.com', '+917318560108', 'Bair Amad Karari', 'SmartSelect_20240905_214054_WhatsApp-sunil-jatania.jpg', 'images/internal_doctors/AURP5Wbf2WfknZgmdjqwzvPeIRYfbuLOnPokaLQ5.jpg', 'fake-signature-10161016-facsimile-11562888097yoll1qgp4t.png', 'images/internal_doctors/signatures/uRirhRpozDOvJYZ0CNzZsgQMuEXem4fmi2uLaX6n.png', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-02 00:57:23', '2025-09-02 00:57:23'),
(3, 'ID0003', 'Internal Doctor', 'Male', 'internaldoctor@gmail.com', '+917318560108', 'Bair Amad Karari', 'SmartSelect_20240905_214054_WhatsApp-sunil-jatania.jpg', 'images/internal_doctors/dfIzVFLaV0QnzrxWS9zDmXuSeZKoGeNoPvwOPBfd.jpg', 'fake-signature-10161016-facsimile-11562888097yoll1qgp4t.png', 'images/internal_doctors/signatures/6AYReXsXfEBOQ3maXyOfccP0wFhzaWLywCugyUxM.png', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-04 06:09:33', '2025-09-04 06:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `master_admins`
--

CREATE TABLE `master_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_profile_image_path` varchar(255) DEFAULT NULL,
  `user_profile_image_name` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `otp` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_admins`
--

INSERT INTO `master_admins` (`id`, `user_type`, `user_id`, `user_name`, `email`, `password`, `mobile_no`, `role_id`, `address`, `user_profile_image_path`, `user_profile_image_name`, `fcm_token`, `access_token`, `last_login`, `remember_token`, `otp`, `status`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'system', NULL, 'ChromoXpert', 'admin@gmail.com', '$2y$10$InJ0GHoOaHXJHMuEYqTMye.t5E4QfWDrzNLW/pltguVNM/OZCpFUm', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2025-09-30 04:44:17', NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, '2025-09-29 23:14:17'),
(2, 'system', NULL, 'Deepak Tripathi', 'deepakmegreat@gmail.com', '$2y$10$xNQAIXTjEX.0BWxRGhCRQOij7hFkletib0oR9o33ExwSrzTp3EzSi', '07318560108', '2', 'Bair Amad Karari', NULL, NULL, NULL, NULL, '2025-09-02 09:26:03', NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-07-24 03:52:01', '2025-09-02 03:56:03'),
(3, 'system', NULL, 'Deepak Tripathi', 'rec@gmail.com', '$2y$10$NJsMZ1s/k0ahYflkrDmJcu9BjBRS9URYgC0V8vb3jX.bltSLnMPZ2', '7318560108', '3', 'Bair Amad Karari', NULL, NULL, NULL, NULL, '2025-08-14 08:22:15', NULL, NULL, 'delete', '127.0.0.1', '127.0.0.1', 1, 1, '2025-08-14 02:51:24', '2025-08-14 02:52:15'),
(4, 'customer', NULL, 'Deepak Tripathi', 'deep@gmail.com', '$2y$10$QpGDu/lTa1t9C5zFgWtOu.eLUj1Qdem5XgTYLBz7oGrC.BRWITHQe', '7318560108', NULL, 'Hello this is Deepak Address', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', '127.0.0.1', 1, 1, '2025-09-01 01:16:48', '2025-09-01 03:44:11'),
(5, 'customer', NULL, 'Harsh', 'harsh@gmail.com', '$2y$10$eM1ObjunjEvGTyWTqjE0M..QL0SSmvrdoWhwhD.vBLLNqAzgbUaz.', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 03:47:33', '2025-09-01 03:47:33'),
(6, 'customer', NULL, 'Deepak Tripathi', 'deepak@gmail.com', '$2y$10$QfB24mVynUib/DiOpzkk8ufRqscw4YemEJOVFJmgKmnn5SE9YR6YW', '07318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:15:37', '2025-09-01 04:15:37'),
(7, 'customer', NULL, 'asdsa', 'member@gmail.com', '$2y$10$eazqE/pgz1CTAtoao90yOedGzR5WtVdC87PcURaLNaZTfh194cDn.', '07318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:23:21', '2025-09-01 04:23:21'),
(8, 'customer', NULL, 'Deepak Tripathi', 'sadsa@gmial.com', '$2y$10$knEU.qA.IwzQnLZLADxpWu7y3.I58z3fADCA8DP/usaedzDm/M/Va', '07318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:24:03', '2025-09-01 04:24:03'),
(9, 'customer', NULL, 'deepseek', 'deepakseek@gmail.com', '$2y$10$Vzf2RB0QhyVr3tsoeqgFeead3KvZFz/4SDvKaQzWKvgdGi5gnQCBG', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:24:59', '2025-09-01 04:24:59'),
(10, 'customer', NULL, 'aDasDasdDeepak', 'sadasdfd@gmail.com', '$2y$10$jMwetIH1T8Bh24t8x8.jtOkez9fu3rHEgc51Pk2D8.HIZOX5ZmTJi', '07318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', '127.0.0.1', 1, 1, '2025-09-01 04:31:32', '2025-09-01 04:31:56'),
(11, 'customer', NULL, 'Deepak Pet Parent', 'deepalpetparent@gmail.com', '$2y$10$1T4VLF319ej97EXANG3RmuzA/mV5ZNrlB9FiK9oe1xpo/HZRg5Pmq', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:33:00', '2025-09-01 04:33:00'),
(12, 'internal_doctor', NULL, 'Dr Deepak Internal Doctor1', 'drdeepakinternaldoctor1@gmail.com', '$2y$10$r0GzCP.fOPmFfb9UYp8TeuVm0FAN7rOFP18NqTHl8p5Nyk3b1.Pe.', '+917318560108', '4', 'Bair Amad Karari1', 'images/internal_doctors/up3g9sanUufnVqUB4gXDL1Ca0yng801PLstwDHgG.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', '127.0.0.1', 1, 1, '2025-09-02 00:12:14', '2025-09-02 00:44:55'),
(13, 'internal_doctor', NULL, 'xyz', 'xyz@gmail.com', '$2y$10$dbCzWmCbq5ksFnke5X1aI.qrumCLiLKAopZP4xavtfqMvBm.lqvIu', '+917318560108', '4', 'Bair Amad Karari', 'images/internal_doctors/AURP5Wbf2WfknZgmdjqwzvPeIRYfbuLOnPokaLQ5.jpg', NULL, NULL, NULL, '2025-09-05 05:01:07', NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-02 00:57:23', '2025-09-04 23:31:07'),
(14, 'system', NULL, 'Deepak Department Head', 'ddh@gmail.com', '$2y$10$sNTRXU1UFsEke6sKjyMvn.ohff45.GvbSejfDmPw6VEv.qi/aeUC2', '7318560108', '3', 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-03 03:16:33', '2025-09-03 03:16:33'),
(15, 'internal_doctor', NULL, 'Internal Doctor', 'internaldoctor@gmail.com', '$2y$10$S7pa8ksDr1twKO3YXa7Md.m4aTd6Pp1lyrQTdZ33AcrRSsxYyoc0a', '+917318560108', '4', 'Bair Amad Karari', 'images/internal_doctors/dfIzVFLaV0QnzrxWS9zDmXuSeZKoGeNoPvwOPBfd.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-04 06:09:33', '2025-09-04 06:09:33'),
(16, 'customer', NULL, 'Michael Maged', 'mm@gmail.com', '$2y$10$/FKxCr3jvqYO8mnt4gFdM.dh7FWUpVGGMkHETIwuQ7Ho9uNySVASW', '+917318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-11 05:22:19', '2025-09-11 05:22:19'),
(17, 'customer', NULL, 'Deepak Tripathi', 'deepak1@gmail.com', '$2y$10$ojQbygGrV8GZMbwDd7O/tu.nc3sZuOjcV4cvwl4vpj7ikI89kWNNa', '7318560109', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-15 00:48:12', '2025-09-15 00:48:12'),
(18, 'customer', NULL, 'Deep', 'deepakmegreat1@gmail.com', '$2y$10$N8mZl/SFVMNM7eBna2qjXeWNWkr0uavi0pBO8f5Rz.eJqjWhFEVxi', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-24 00:23:25', '2025-09-24 00:23:25'),
(19, 'customer', NULL, 'Deep', 'deep1@gmail.com', '$2y$10$6LsqsiHFmUBVirezQBhxu.6q.L9fQWQ69x6RhmVUjtPCcI1HjpxQe', '7318560110', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-24 00:32:20', '2025-09-24 00:32:20'),
(20, 'customer', NULL, 'Mohit Gupta', 'mohit@gmail.com', '$2y$10$JEh5eH3e7KjvuEHs3f64kOwwUmCnYhdIsWJ0o38fQrn734C4WoKq6', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-24 00:40:23', '2025-09-24 00:40:23'),
(21, 'customer', NULL, 'Vikas Dueby', 'vikas@gmail.com', '$2y$10$Eke7.aKvFMqqFAZsUIZ2OesJsd9AGBa4j7oGZTD0YiNx9PMtdMPLe', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-24 00:50:18', '2025-09-24 00:50:18'),
(22, 'customer', NULL, 'Ankit', 'ankit@gmail.com', '$2y$10$bGDLb3WY4I9GR3.MS6q4ZOwrUQkq/PEtUaVQYtg9VSb/RGplwpaXS', '7318569800', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-24 00:57:59', '2025-09-24 00:57:59'),
(23, 'customer', NULL, 'Shivam Ojha', 'shivam@gmail.com', '$2y$10$q70WB4qFhaKgAKIMvFUHreG59HPLBX2mbFETZGsEvhBYE07CNnJiG', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-24 01:11:13', '2025-09-24 01:11:13'),
(24, 'customer', NULL, 'Shiv', 'shiv@gnmail.com', '$2y$10$q3XVnbwjN006Px4OHz8g.eqhcx1jugIoSD3/suxPwgMmrLPWikVCq', '7218560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-24 01:18:57', '2025-09-24 01:18:57'),
(25, 'customer', NULL, 'Satyam Ojha', 'snojha@gmail.com', '$2y$10$glo53fQMFVmqhG5AOjVHheJtvFZX6AGyQ.Sw6z3uFw9Ccay3XAlSC', '1234567890', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-24 01:32:04', '2025-09-24 01:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_05_075239_create_master_admins_table', 1),
(6, '2023_07_13_034312_create_general_settings_table', 1),
(7, '2023_08_22_102532_create_role_privileges_table', 1),
(8, '2023_08_28_112847_create_visual_settings_table', 1),
(10, '2025_09_01_045614_create_petparents_table', 2),
(11, '2025_09_01_112932_create_referee_doctors_table', 3),
(12, '2025_09_02_050059_create_internal_doctors_table', 4),
(13, '2025_09_02_093535_create_branches_table', 5),
(15, '2025_09_03_072046_create_departments_table', 6),
(16, '2025_09_04_061330_create_pets_table', 7),
(19, '2025_09_05_080749_create_parameter_options_table', 8),
(27, '2025_09_05_080633_create_test_parameters_table', 11),
(28, '2025_09_10_122330_create_appointments_table', 12),
(29, '2025_09_11_115035_create_appointment_tests_table', 13),
(30, '2025_09_12_113402_add_transaction_details_to_appointments_table', 14),
(32, '2025_09_05_080504_create_tests_table', 15),
(33, '2025_09_17_124719_create_test_results_table', 16),
(34, '2025_09_22_090944_add_test_for_to_tests_table', 16),
(35, '2025_09_22_091720_add_paid_amount_to_appointments_table', 17),
(36, '2025_09_23_070550_add_signed_columns_to_test_results_table', 18),
(37, '2025_09_23_124538_create_test_result_components_table', 19),
(38, '2025_09_26_112205_create_test_profiles_table', 20),
(39, '2025_09_26_112226_create_test_profile_tests_table', 20),
(40, '2025_09_29_070120_add_profile_code_and_description_to_test_profiles_table', 21),
(41, '2025_09_29_122714_add_price_2_to_tests_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `parameter_options`
--

CREATE TABLE `parameter_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter_id` bigint(20) DEFAULT NULL,
  `option_value` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parameter_options`
--

INSERT INTO `parameter_options` (`id`, `parameter_id`, `option_value`, `sort_order`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 12, 'Option 1', 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-18 00:22:42', '2025-09-18 00:22:42'),
(2, 12, 'option 2', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-18 00:22:42', '2025-09-18 00:22:42'),
(3, 16, 'Normal', 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:17:06', '2025-09-22 04:17:06'),
(4, 16, 'abnormal', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:17:06', '2025-09-22 04:17:06'),
(5, 20, 'Normal', 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:19:01', '2025-09-22 04:19:01'),
(6, 20, 'abnormal', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:19:01', '2025-09-22 04:19:01'),
(7, 24, 'option 1', 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:23:30', '2025-09-22 04:23:30'),
(8, 24, 'option 1', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:23:30', '2025-09-22 04:23:30'),
(9, 32, 'option 1', 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:29:26', '2025-09-22 04:29:26'),
(10, 32, 'option 1', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:29:26', '2025-09-22 04:29:26'),
(11, 36, 'option 1', 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:38:28', '2025-09-22 04:38:28'),
(12, 36, 'option 2', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:38:28', '2025-09-22 04:38:28'),
(13, 42, 'Option 1', 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-26 00:26:40', '2025-09-26 00:26:40'),
(14, 42, 'Option 2', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-26 00:26:40', '2025-09-26 00:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petparents`
--

CREATE TABLE `petparents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petparents`
--

INSERT INTO `petparents` (`id`, `code`, `name`, `gender`, `email`, `mobile`, `address`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PP0001', 'Deepak Pet Parent', 'Male', 'deepalpetparent@gmail.com', '+917318560108', 'Bair Amad Karari', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-01 04:33:00', '2025-09-01 04:33:00'),
(3, 'PP0003', 'Deepak Tripathi', 'Male', 'deepak1@gmail.com', '+917318560109', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-15 00:48:12', '2025-09-15 00:48:12'),
(4, 'PP0004', 'Deep', NULL, 'deepakmegreat1@gmail.com', '7318560108', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:23:25', '2025-09-24 00:23:25'),
(5, 'PP0005', 'Deep', NULL, 'deep1@gmail.com', '7318560110', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:32:20', '2025-09-24 00:32:20'),
(6, 'PP0006', 'Mohit Gupta', NULL, 'mohit@gmail.com', '7318560108', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:40:23', '2025-09-24 00:40:23'),
(7, 'PP0007', 'Vikas Dueby', NULL, 'vikas@gmail.com', '7318560108', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:50:17', '2025-09-24 00:50:17'),
(8, 'PP0008', 'Ankit', NULL, 'ankit@gmail.com', '7318569800', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:57:58', '2025-09-24 00:57:58'),
(9, 'PP0009', 'Shivam Ojha', NULL, 'shivam@gmail.com', '7318560108', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 01:11:13', '2025-09-24 01:11:13'),
(10, 'PP0010', 'Shiv', NULL, 'shiv@gnmail.com', '7218560108', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 01:18:57', '2025-09-24 01:18:57'),
(11, 'PP0011', 'Satyam Ojha', NULL, 'snojha@gmail.com', '1234567890', 'Bair Amad Karari', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 01:32:04', '2025-09-24 01:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pet_code` varchar(255) DEFAULT NULL,
  `pet_parent_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `species` varchar(255) DEFAULT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `pet_code`, `pet_parent_id`, `name`, `species`, `breed`, `type`, `gender`, `dob`, `age`, `weight`, `image_name`, `image_path`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PET001', 1, 'Jacy1', 'Feline', 'Birman', 'Dog', 'Female', '2025-06-30', '2 months 5 days', '2.5', 'download (2).jpeg', 'images/pets/uHW3C7TWlvfpos75o2KhJLswvpVxp9BQO4Dmh5xu.jpg', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-09-04 02:33:53', '2025-09-04 05:03:11'),
(2, 'PET002', 1, 'Deepak', 'Feline', 'Persian', 'Dog', 'Male', '2025-08-20', '15 days', '2', 'download (2).jpeg', 'images/pets/2XKvifin4MfnPUQj7jx4nbl5U60BH95RvHsDQEFf.jpg', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-09-04 02:50:56', '2025-09-04 02:50:56'),
(3, 'PET003', 1, 'Tommy', 'Canine', 'Labrador Retriever', 'Dog', 'Male', '2025-07-20', '1 month 15 days', '10', 'download (2).jpeg', 'images/pets/64Vv5mxTAcZ8qcuNito2FTNObXtvORJxsjpSrSs4.jpg', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-04 04:54:23', '2025-09-04 04:54:23'),
(4, 'PET004', 2, 'Deepak ka pet', 'Canine', 'Golden Retriever', 'Dog', 'Male', '2025-07-11', '2 months', '34', 'download (2).jpeg', 'images/pets/GwOQgad5Vp0uZzrcRyhMcJnULdMnA6yrvL9UhGyp.jpg', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-09-11 05:22:21', '2025-09-11 05:22:21'),
(5, 'PET005', 3, 'Pet1', 'Feline', 'Siamese', 'Dog', 'Male', '2025-05-01', '4 months 14 days', '80', 'download (2).jpeg', 'images/pets/zOEkSxNKElNiyWxtH2wwsoKAUPMBAENvXMbBIpXr.jpg', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-15 00:50:07', '2025-09-15 00:50:07'),
(6, 'PET006', 3, 'Pet2', 'Avian', 'Birman', 'Cat', 'Male', '2025-07-15', '2 months', '30', 'download (2).jpeg', 'images/pets/3WyGk3KJHmHbxG07Y9EelYeGwWG2fjdBg8oXC0hJ.jpg', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-15 00:50:58', '2025-09-15 00:50:58'),
(7, 'PET007', 4, 'John', 'Canine', 'Labrador Retriever', 'Dog', 'Male', '2025-08-04', '1 month 20 days', '10', NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:23:25', '2025-09-24 00:23:25'),
(8, 'PET008', 5, 'John', 'Canine', 'Bulldog', 'Dog', 'Male', '2025-08-01', '1 month 23 days', '30', NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:32:20', '2025-09-24 00:32:20'),
(9, 'PET009', 6, 'john', 'Canine', 'Poodle', 'Dog', 'Male', '2025-09-02', '22 days', '4', NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:40:23', '2025-09-24 00:40:23'),
(10, 'PET010', 7, 'Vikky', 'Canine', 'Golden Retriever', 'Dog', 'Male', '2025-09-02', '22 days', '5', NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:50:18', '2025-09-24 00:50:18'),
(11, 'PET011', 8, 'Jacky', 'Canine', 'Rottweiler', 'Dog', 'Male', '2025-09-01', '23 days', '40', NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 00:57:59', '2025-09-24 00:57:59'),
(12, 'PET012', 9, 'Tom', 'Canine', 'Boxer', 'Dog', 'Male', '2025-08-10', '1 month 14 days', '5', NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 01:11:13', '2025-09-24 01:11:13'),
(13, 'PET013', 10, 'Captain', 'Canine', 'Poodle', 'Dog', 'Male', '2025-09-08', '16 days', '3', NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 01:18:57', '2025-09-24 01:18:57'),
(14, 'PET014', 11, 'Kalu', 'Canine', 'Yorkshire Terrier', 'Dog', 'Male', '2025-09-01', '23 days', '4', NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-24 01:32:04', '2025-09-24 01:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `referee_doctors`
--

CREATE TABLE `referee_doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `commission_percent` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referee_doctors`
--

INSERT INTO `referee_doctors` (`id`, `code`, `doctor_name`, `gender`, `email`, `mobile`, `commission_percent`, `address`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RD0001', 'Dr Deepak More', 'Male', 'drmore@gmail.com', '+917318560108', '5', 'Bair Amad Karari', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-01 06:24:18', '2025-09-01 06:35:46'),
(2, 'RD0002', 'Dr Deepu', 'Male', 'drdeepu@gmail.com', '+917318560100', '5', 'Bair Amad Karari', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-09 05:37:57', '2025-09-09 05:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_privileges`
--

CREATE TABLE `role_privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `privileges` text DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_privileges`
--

INSERT INTO `role_privileges` (`id`, `role_name`, `privileges`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'dashboard_view,appointments_view,appointments_add,appointments_edit,appointments_delete,appointments_status_change,reports_view,branch_view,branch_add,branch_edit,branch_delete,branch_status_change,departments_view,departments_add,departments_edit,departments_delete,departments_status_change,doctors_view,doctors_add,doctors_edit,doctors_delete,doctors_status_change,internal_doctors_view,internal_doctors_add,internal_doctors_edit,internal_doctors_delete,internal_doctors_status_change,referee_doctors_view,referee_doctors_add,referee_doctors_edit,referee_doctors_delete,referee_doctors_status_change,pet_owners_view,pet_owners_add,pet_owners_edit,pet_owners_delete,pet_owners_status_change,pet_view,pet_add,pet_edit,pet_delete,pet_status_change,test_view,test_add,test_edit,test_delete,test_status_change,revenue_view,system_users_view,user_view,user_add,user_edit,user_delete,user_status_change,role_privileges_view,role_privileges_add,role_privileges_edit,role_privileges_delete,role_privileges_status_change,settings_view,general_setting_view,general_setting_add,general_setting_edit,visual_setting_view,visual_setting_add,visual_setting_edit,change_password_view,change_password_edit,notifications_view,logout_view', NULL, '127.0.0.1', NULL, 1, 'active', NULL, '2025-09-08 04:06:27'),
(2, 'Lab  Incharge', 'appointments_view,appointments_add,appointments_edit,appointments_delete,appointments_status_change,reports_view,notifications_view,logout_view', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-07-24 03:51:39', '2025-09-03 03:14:50'),
(3, 'Department Head', 'appointments_view,appointments_add,appointments_edit,reports_view', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-08-14 02:42:34', '2025-09-03 03:15:37'),
(4, 'Internal Doctor', 'dashboard_view,reports_view,notifications_view,logout_view', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-04 06:24:11', '2025-09-04 07:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `name`, `country_id`) VALUES
(1, 'Andaman and Nicobar Islands (union territory)', 1),
(2, 'Andhra Pradesh', 1),
(3, 'Arunachal Pradesh', 1),
(4, 'Assam', 1),
(5, 'Bihar', 1),
(6, 'Chandigarh (union territory)', 1),
(7, 'Chhattisgarh', 1),
(8, 'Dadra and Nagar Haveli and Daman and Diu (union territory)', 1),
(9, 'Delhi (national capital territory)', 1),
(10, 'Goa', 1),
(11, 'Gujarat', 1),
(12, 'Haryana', 1),
(13, 'Himachal Pradesh', 1),
(14, 'Jammu and Kashmir (union territory)', 1),
(15, 'Jharkhand', 1),
(16, 'Karnataka', 1),
(17, 'Kerala', 1),
(18, 'Ladakh (union territory)', 1),
(19, 'Madhya Pradesh', 1),
(20, 'Maharashtra', 1),
(21, 'Manipur', 1),
(22, 'Meghalaya', 1),
(23, 'Mizoram', 1),
(24, 'Nagaland', 1),
(25, 'Odisha', 1),
(26, 'Puducherry (union territory)', 1),
(27, 'Punjab', 1),
(28, 'Rajasthan', 1),
(29, 'Sikkim', 1),
(30, 'Tamil Nadu', 1),
(31, 'Telangana', 1),
(32, 'Tripura', 1),
(33, 'Uttar Pradesh', 1),
(34, 'Uttarakhand', 1),
(35, 'West Bengal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) DEFAULT NULL,
  `sample_type` varchar(255) DEFAULT NULL,
  `test_for` enum('all','male','female') DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `precautions` text DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_code`, `name`, `short_name`, `department_id`, `sample_type`, `test_for`, `base_price`, `precautions`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TC001', 'Deepak Tripathi', 'CBC', 1, 'Blood', 'all', 600.00, 'Na', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 00:21:22', '2025-09-16 00:21:22'),
(2, 'TC002', 'Test1', 'CBC', 2, 'Blood', 'all', 900.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:05:35', '2025-09-16 02:05:35'),
(3, 'TC003', 'Test2', 'CBC', 2, 'Blood', 'all', 800.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:06:23', '2025-09-16 02:06:23'),
(4, 'TC004', 'Test23', '23', 5, 'Blood', 'all', 200.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-18 00:22:42', '2025-09-18 00:22:42'),
(5, 'TC005', 'Test', 'Tst', 1, 'Blood', 'all', 800.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:17:06', '2025-09-22 04:17:06'),
(6, 'TC006', 'Test For Female', 'Female', 1, 'Blood', 'all', 800.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:19:01', '2025-09-22 04:19:01'),
(7, 'TC007', 'Test For Female 1', 'Femaile 1', 1, 'Blood', 'all', 700.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:23:30', '2025-09-22 04:23:30'),
(8, 'TC008', 'Test Female 3', 'Female 3', 1, 'Blood', 'all', 800.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:27:15', '2025-09-22 04:27:15'),
(9, 'TC009', 'test For  male', 'TFM', 1, 'Blood', 'all', 900.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:29:26', '2025-09-22 04:29:26'),
(10, 'TC010', 'Test1 for male', 't1M', 1, 'Blood', NULL, 800.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:38:28', '2025-09-22 04:38:28'),
(11, 'TC011', 'Deepak Tetting Test', 'CBC', 1, 'Blood', 'male', 900.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:42:37', '2025-09-22 04:42:37'),
(12, 'TC012', 'Options Testing Test', 'OTT', 1, 'Blood', 'male', 900.00, 'NA', '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-26 00:26:40', '2025-09-26 00:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `test_parameters`
--

CREATE TABLE `test_parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) DEFAULT NULL,
  `row_type` enum('component','title') NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `result_type` enum('text','select') NOT NULL DEFAULT 'text',
  `reference_range` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_parameters`
--

INSERT INTO `test_parameters` (`id`, `test_id`, `row_type`, `name`, `title`, `unit`, `result_type`, `reference_range`, `sort_order`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 00:21:22', '2025-09-16 00:21:22'),
(2, 1, 'component', 'wwwere', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 00:21:22', '2025-09-16 00:21:22'),
(3, 2, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:05:35', '2025-09-16 02:05:35'),
(4, 2, 'component', 'wwwere', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:05:35', '2025-09-16 02:05:35'),
(5, 2, 'title', NULL, 'RBC Count', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:05:35', '2025-09-16 02:05:35'),
(6, 2, 'component', 'ASDasd', NULL, 'mill/cumm', 'text', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:05:35', '2025-09-16 02:05:35'),
(7, 3, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:06:23', '2025-09-16 02:06:23'),
(8, 3, 'component', 'Volume', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:06:23', '2025-09-16 02:06:23'),
(9, 3, 'title', NULL, 'aewasdasd', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:06:23', '2025-09-16 02:06:23'),
(10, 3, 'component', 'zxczx', NULL, 'mill/cumm', 'text', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-16 02:06:23', '2025-09-16 02:06:23'),
(11, 4, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-18 00:22:42', '2025-09-18 00:22:42'),
(12, 4, 'component', 'wwwere', NULL, 'g/dl', 'select', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-18 00:22:42', '2025-09-18 00:22:42'),
(13, 5, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:17:06', '2025-09-22 04:17:06'),
(14, 5, 'component', 'wwwere', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:17:06', '2025-09-22 04:17:06'),
(15, 5, 'title', NULL, 'aewasdasd', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:17:06', '2025-09-22 04:17:06'),
(16, 5, 'component', 'ASDasd', NULL, 'mill/cumm', 'select', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:17:06', '2025-09-22 04:17:06'),
(17, 6, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:19:01', '2025-09-22 04:19:01'),
(18, 6, 'component', 'wwwere', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:19:01', '2025-09-22 04:19:01'),
(19, 6, 'title', NULL, 'aewasdasd', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:19:01', '2025-09-22 04:19:01'),
(20, 6, 'component', 'zxczx', NULL, 'mill/cumm', 'select', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:19:01', '2025-09-22 04:19:01'),
(21, 7, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:23:30', '2025-09-22 04:23:30'),
(22, 7, 'component', 'dsfds', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:23:30', '2025-09-22 04:23:30'),
(23, 7, 'title', NULL, 'aewasdasd', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:23:30', '2025-09-22 04:23:30'),
(24, 7, 'component', 'ASDasd', NULL, 'mill/cumm', 'select', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:23:30', '2025-09-22 04:23:30'),
(25, 8, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:27:15', '2025-09-22 04:27:15'),
(26, 8, 'component', 'Volume', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:27:15', '2025-09-22 04:27:15'),
(27, 8, 'title', NULL, 'aewasdasd', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:27:15', '2025-09-22 04:27:15'),
(28, 8, 'component', 'ASDasd', NULL, 'mill/cumm', 'text', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:27:15', '2025-09-22 04:27:15'),
(29, 9, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:29:26', '2025-09-22 04:29:26'),
(30, 9, 'component', 'Volume', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:29:26', '2025-09-22 04:29:26'),
(31, 9, 'title', NULL, 'aewasdasd', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:29:26', '2025-09-22 04:29:26'),
(32, 9, 'component', 'ASDasd', NULL, 'mill/cumm', 'select', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:29:26', '2025-09-22 04:29:26'),
(33, 10, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:38:28', '2025-09-22 04:38:28'),
(34, 10, 'component', 'Volume', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:38:28', '2025-09-22 04:38:28'),
(35, 10, 'title', NULL, 'RBC Count', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:38:28', '2025-09-22 04:38:28'),
(36, 10, 'component', 'ASDasd', NULL, 'mill/cumm', 'select', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:38:28', '2025-09-22 04:38:28'),
(37, 11, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:42:38', '2025-09-22 04:42:38'),
(38, 11, 'component', 'dsfds', NULL, 'g/dl', 'text', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:42:38', '2025-09-22 04:42:38'),
(39, 11, 'title', NULL, 'RBC Count', NULL, 'text', NULL, 2, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:42:38', '2025-09-22 04:42:38'),
(40, 11, 'component', 'ASDasd', NULL, 'mill/cumm', 'text', '4.5-5.5', 3, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-22 04:42:38', '2025-09-22 04:42:38'),
(41, 12, 'title', NULL, 'Hemoglobin', NULL, 'text', NULL, 0, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-26 00:26:40', '2025-09-26 00:26:40'),
(42, 12, 'component', 'Uric Acid', NULL, 'ml', 'select', '13.0-17.0', 1, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-26 00:26:40', '2025-09-26 00:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `test_profiles`
--

CREATE TABLE `test_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_code` varchar(255) DEFAULT NULL,
  `profile_price` decimal(10,2) NOT NULL,
  `profile_description` text DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_profiles`
--

INSERT INTO `test_profiles` (`id`, `name`, `profile_code`, `profile_price`, `profile_description`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Testing Profile', NULL, 1100.00, NULL, '127.0.0.1', '127.0.0.1', NULL, 1, 'active', '2025-09-26 07:10:46', '2025-09-26 07:10:46'),
(2, 'Deepak', NULL, 900.00, NULL, '127.0.0.1', '127.0.0.1', NULL, NULL, 'active', '2025-09-28 23:53:50', '2025-09-29 01:01:52'),
(3, 'Profile Testing Name', 'Test', 900.00, 'This description', '127.0.0.1', NULL, NULL, NULL, 'active', '2025-09-29 02:06:48', '2025-09-29 02:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `test_profile_tests`
--

CREATE TABLE `test_profile_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_profile_id` bigint(20) NOT NULL,
  `test_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_profile_tests`
--

INSERT INTO `test_profile_tests` (`id`, `test_profile_id`, `test_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-09-26 07:10:46', '2025-09-26 07:10:46'),
(2, 1, 4, '2025-09-26 07:10:46', '2025-09-26 07:10:46'),
(5, 2, 2, '2025-09-29 01:01:52', '2025-09-29 01:01:52'),
(6, 3, 2, '2025-09-29 02:06:48', '2025-09-29 02:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_result_code` varchar(255) DEFAULT NULL,
  `appointment_id` bigint(20) DEFAULT NULL,
  `test_id` bigint(20) DEFAULT NULL,
  `priority` enum('Low','Medium','High') NOT NULL DEFAULT 'Medium',
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `comment` text DEFAULT NULL,
  `signed_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `signed_date` datetime DEFAULT NULL,
  `done` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_results`
--

INSERT INTO `test_results` (`id`, `test_result_code`, `appointment_id`, `test_id`, `priority`, `status`, `comment`, `signed_by_id`, `signed_date`, `done`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'TR0008', 8, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-22 05:31:58', '2025-09-22 05:31:58'),
(2, 'TR0009', 9, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-22 06:39:24', '2025-09-22 06:39:24'),
(3, 'TR0010', 10, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-22 23:58:30', '2025-09-22 23:58:30'),
(4, 'TR0010', 10, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-22 23:58:30', '2025-09-22 23:58:30'),
(5, 'TR0010', 10, 5, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-22 23:58:30', '2025-09-22 23:58:30'),
(6, 'TR0011', 11, 2, 'Medium', 'completed', NULL, NULL, NULL, 'yes', NULL, '127.0.0.1', NULL, NULL, '2025-09-23 05:59:58', '2025-09-23 06:32:18'),
(7, 'TR0011', 11, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(8, 'TR0011', 11, 4, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(9, 'TR0011', 11, 5, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(10, 'TR0011', 11, 6, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(11, 'TR0011', 11, 10, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-23 05:59:58', '2025-09-23 05:59:58'),
(12, 'TR0012', 12, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 01:56:30', '2025-09-24 01:56:30'),
(13, 'TR0012', 12, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 01:56:30', '2025-09-24 01:56:30'),
(14, 'TR0013', 13, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:04:26', '2025-09-24 02:04:26'),
(15, 'TR0013', 13, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:04:26', '2025-09-24 02:04:26'),
(16, 'TR0014', 14, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:11:04', '2025-09-24 02:11:04'),
(17, 'TR0014', 14, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:11:04', '2025-09-24 02:11:04'),
(18, 'TR0015', 15, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:11:43', '2025-09-24 02:11:43'),
(19, 'TR0015', 15, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:11:43', '2025-09-24 02:11:43'),
(20, 'TR0016', 16, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:12:18', '2025-09-24 02:12:18'),
(21, 'TR0016', 16, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:12:18', '2025-09-24 02:12:18'),
(22, 'TR0017', 17, 2, 'Medium', 'completed', NULL, NULL, NULL, 'yes', NULL, '127.0.0.1', NULL, NULL, '2025-09-24 02:13:44', '2025-09-24 04:03:39'),
(23, 'TR0017', 17, 3, 'Medium', 'completed', NULL, NULL, NULL, 'yes', NULL, '127.0.0.1', NULL, NULL, '2025-09-24 02:13:44', '2025-09-24 04:05:40'),
(24, 'TR0018', 18, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:22:45', '2025-09-24 02:22:45'),
(25, 'TR0018', 18, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 02:22:45', '2025-09-24 02:22:45'),
(26, 'TR0019', 19, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:30:09', '2025-09-24 03:30:09'),
(27, 'TR0019', 19, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:30:09', '2025-09-24 03:30:09'),
(28, 'TR0020', 20, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:34:22', '2025-09-24 03:34:22'),
(29, 'TR0020', 20, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:34:22', '2025-09-24 03:34:22'),
(30, 'TR0021', 21, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:35:50', '2025-09-24 03:35:50'),
(31, 'TR0021', 21, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:35:50', '2025-09-24 03:35:50'),
(32, 'TR0022', 22, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:36:53', '2025-09-24 03:36:53'),
(33, 'TR0022', 22, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:36:53', '2025-09-24 03:36:53'),
(34, 'TR0023', 23, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:37:17', '2025-09-24 03:37:17'),
(35, 'TR0023', 23, 3, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-24 03:37:18', '2025-09-24 03:37:18'),
(36, 'TR0024', 24, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-25 23:51:12', '2025-09-25 23:51:12'),
(37, 'TR0025', 25, 12, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-26 00:27:25', '2025-09-26 00:27:25'),
(38, 'TR0026', 26, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-26 00:39:49', '2025-09-26 00:39:49'),
(39, 'TR0027', 27, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-26 00:47:02', '2025-09-26 00:47:02'),
(40, 'TR0028', 28, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-26 00:47:54', '2025-09-26 00:47:54'),
(41, 'TR0029', 29, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-26 00:48:45', '2025-09-26 00:48:45'),
(42, 'TR0030', 30, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-26 00:51:02', '2025-09-26 00:51:02'),
(43, 'TR0031', 31, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-26 01:51:57', '2025-09-26 01:51:57'),
(44, 'TR0032', 32, 2, 'Medium', 'pending', NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, '2025-09-26 01:53:24', '2025-09-26 01:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `test_result_components`
--

CREATE TABLE `test_result_components` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_result_id` bigint(20) NOT NULL,
  `component_id` bigint(20) NOT NULL,
  `result` text DEFAULT NULL,
  `result_status` enum('normal','abnormal','critical') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_result_components`
--

INSERT INTO `test_result_components` (`id`, `test_result_id`, `component_id`, `result`, `result_status`, `created_at`, `updated_at`) VALUES
(1, 22, 4, '15.0', 'normal', '2025-09-24 03:46:43', '2025-09-24 04:03:39'),
(2, 22, 6, '6.0', 'abnormal', '2025-09-24 03:46:43', '2025-09-24 04:03:39'),
(3, 23, 8, '18', 'abnormal', '2025-09-24 04:05:40', '2025-09-24 04:05:40'),
(4, 23, 10, '4.7', 'normal', '2025-09-24 04:05:40', '2025-09-24 04:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visual_settings`
--

CREATE TABLE `visual_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo_image_path` varchar(255) DEFAULT NULL,
  `logo_image_name` varchar(255) DEFAULT NULL,
  `mini_logo_image_path` varchar(255) DEFAULT NULL,
  `mini_logo_image_name` varchar(255) DEFAULT NULL,
  `logo_email_image_path` varchar(255) DEFAULT NULL,
  `logo_email_image_name` varchar(255) DEFAULT NULL,
  `favicon_image_path` varchar(255) DEFAULT NULL,
  `favicon_image_name` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_tests`
--
ALTER TABLE `appointment_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_doctors`
--
ALTER TABLE `internal_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_admins`
--
ALTER TABLE `master_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameter_options`
--
ALTER TABLE `parameter_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `petparents`
--
ALTER TABLE `petparents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pets_pet_code_unique` (`pet_code`);

--
-- Indexes for table `referee_doctors`
--
ALTER TABLE `referee_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_privileges`
--
ALTER TABLE `role_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_parameters`
--
ALTER TABLE `test_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_profiles`
--
ALTER TABLE `test_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_profile_tests`
--
ALTER TABLE `test_profile_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_result_components`
--
ALTER TABLE `test_result_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visual_settings`
--
ALTER TABLE `visual_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `appointment_tests`
--
ALTER TABLE `appointment_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=545;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `internal_doctors`
--
ALTER TABLE `internal_doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_admins`
--
ALTER TABLE `master_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `parameter_options`
--
ALTER TABLE `parameter_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petparents`
--
ALTER TABLE `petparents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `referee_doctors`
--
ALTER TABLE `referee_doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_privileges`
--
ALTER TABLE `role_privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `test_parameters`
--
ALTER TABLE `test_parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `test_profiles`
--
ALTER TABLE `test_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test_profile_tests`
--
ALTER TABLE `test_profile_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `test_result_components`
--
ALTER TABLE `test_result_components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visual_settings`
--
ALTER TABLE `visual_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`state_id`);

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
