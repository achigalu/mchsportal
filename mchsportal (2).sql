-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2024 at 09:49 PM
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
-- Database: `mchsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicyears`
--

CREATE TABLE `academicyears` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ayear` int(11) NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `month` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `category` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academicyears`
--

INSERT INTO `academicyears` (`id`, `ayear`, `sdate`, `edate`, `month`, `description`, `status`, `category`, `created_at`, `updated_at`) VALUES
(1, 2024, '2023-12-01', '2024-12-01', 'December', 'HSA Intake', 2, 2, NULL, '2024-04-08 12:13:26'),
(2, 2023, '2023-08-30', '2024-04-03', 'August', 'HSA - August Intake', 1, 2, '2024-04-03 07:43:50', '2024-04-04 12:43:53'),
(3, 2024, '2024-04-03', '2025-12-27', 'April', 'CCM - Lilongwe Intake', 1, 1, '2024-04-03 07:47:30', '2024-04-06 16:14:45'),
(4, 2024, '2024-04-09', '2024-12-31', 'May', 'DCA - Blantyre Intake', 1, 2, '2024-04-03 07:49:13', '2024-04-03 07:49:13'),
(5, 2020, '2020-02-03', '2023-12-06', 'January', 'GENERIC - Intake', 2, 1, '2024-04-03 10:22:04', '2024-04-06 13:40:20'),
(6, 2024, '2024-06-03', '2024-12-18', 'July', 'DCA - Lilongwe Intake', 1, 2, '2024-04-03 13:11:51', '2024-04-03 13:11:51'),
(7, 2024, '2024-04-13', '2025-09-10', 'April', 'CPH - Zomba Intake', 1, 2, '2024-04-04 15:09:00', '2024-04-13 10:27:17'),
(8, 2024, '2024-04-06', '2025-12-27', 'January', 'HSA - Zomba Intake', 1, 2, '2024-04-06 16:01:34', '2024-04-06 16:14:07'),
(9, 2024, '2024-04-28', '2024-06-28', 'April', 'GENERIC - INTAKE', 1, 1, '2024-04-29 15:53:14', '2024-04-29 15:53:14'),
(10, 2024, '2024-06-04', '2028-06-04', 'June', 'GENERIC - INTAKE - ALL', 1, 1, '2024-06-08 05:45:56', '2024-06-08 05:45:56'),
(11, 2024, '2024-06-20', '2024-12-20', 'July', 'Anaesthesia BT', 1, 2, '2024-06-20 09:06:46', '2024-06-20 09:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `accesslevels`
--

CREATE TABLE `accesslevels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `access_level` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accesslevels`
--

INSERT INTO `accesslevels` (`id`, `title`, `access_level`, `created_at`, `updated_at`) VALUES
(1, 'lecturer', 1, NULL, NULL),
(2, 'hod', 2, NULL, NULL),
(3, 'dean', 3, NULL, NULL),
(4, 'cr', 4, NULL, NULL),
(5, 'principal', 5, NULL, NULL),
(6, 'dcr', 6, NULL, NULL),
(7, 'reg', 7, NULL, NULL),
(8, 'ed', 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academicyear` tinyint(4) DEFAULT NULL,
  `uploadlist_id` tinyint(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `entry_level` varchar(255) DEFAULT NULL,
  `campus` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `processed` varchar(255) NOT NULL DEFAULT '0= No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reference_code` varchar(255) NOT NULL,
  `reg_num` varchar(255) DEFAULT NULL,
  `semester` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `academicyear`, `uploadlist_id`, `fname`, `lname`, `gender`, `class`, `entry_level`, `campus`, `email`, `processed`, `created_at`, `updated_at`, `reference_code`, `reg_num`, `semester`) VALUES
(1, 9, 1, 'Ibrahim', 'Madi', 'M', 'DCM1', 'Basic', 'Lilongwe', 'student1@gmail.com', '0', '2024-06-29 07:21:04', '2024-06-29 07:21:04', '200/001', NULL, 1),
(2, 9, 1, 'Steve', 'Mwase', 'M', 'DCM1', 'Basic', 'Lilongwe', 'student2@gmail.com', '0', '2024-06-29 07:21:04', '2024-06-29 07:21:04', '200/002', NULL, 1),
(3, 9, 1, 'Zelifa', 'Sipasi', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student3@gmail.com', '0', '2024-06-29 07:21:04', '2024-06-29 07:21:04', '200/003', NULL, 1),
(4, 9, 1, 'Maiden', 'Gondwe', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-06-29 07:21:04', '2024-06-29 07:21:04', '200/004', NULL, 1),
(5, 9, 2, 'James', 'Manda', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student1@gmail.com', '0', '2024-06-29 07:22:16', '2024-06-29 07:22:16', '200/005', NULL, 1),
(6, 9, 2, 'Jones', 'Mhone', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student2@gmail.com', '0', '2024-06-29 07:22:16', '2024-06-29 07:22:16', '200/006', NULL, 1),
(7, 9, 2, 'Cyrus', 'Khan', 'M', 'DCM1', 'Basic', 'Lilongwe', 'student3@gmail.com', '0', '2024-06-29 07:22:16', '2024-06-29 07:22:16', '200/007', NULL, 1),
(8, 9, 2, 'Melvis', 'Miya', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-06-29 07:22:16', '2024-06-29 07:22:16', '200/008', NULL, 1),
(9, 9, 3, 'Limbi', 'Malinda', 'F', 'DCM1', 'Basic', 'Blantyre', 'student1@gmail.com', '0', '2024-06-29 07:23:57', '2024-06-29 07:23:57', '200/009', NULL, 1),
(10, 9, 3, 'Joaq', 'Mussa', 'F', 'DCM1', 'Basic', 'Blantyre', 'student2@gmail.com', '0', '2024-06-29 07:23:57', '2024-06-29 07:23:57', '200/010', NULL, 1),
(11, 9, 3, 'Maneno', 'Harlod', 'M', 'DCM1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-06-29 07:23:57', '2024-06-29 07:23:57', '200/011', NULL, 1),
(12, 9, 3, 'Mnenenji', 'Njiwa', 'M', 'DCM1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-06-29 07:23:57', '2024-06-29 07:23:57', '200/012', NULL, 1),
(13, 9, 4, 'Namani', 'Banda', 'M', 'DCM1', 'Basic', 'Blantyre', 'student1@gmail.com', '0', '2024-06-29 07:25:05', '2024-06-29 07:25:05', '200/0013', NULL, 1),
(14, 9, 4, 'Chiletso', 'Nyirenda', 'F', 'DCM1', 'Basic', 'Blantyre', 'student2@gmail.com', '0', '2024-06-29 07:25:05', '2024-06-29 07:25:05', '200/0014', NULL, 1),
(15, 9, 4, 'Nephtali', 'Phiri', 'M', 'DCM1', 'Basic', 'Blantyre', 'student3@gmail.com', '0', '2024-06-29 07:25:05', '2024-06-29 07:25:05', '200/0015', NULL, 1),
(16, 9, 4, 'Hend', 'Mwale', 'F', 'DCM1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-06-29 07:25:05', '2024-06-29 07:25:05', '200/0016', NULL, 1),
(29, 5, 10, 'Steven', 'Kamanga', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student1@gmail.com', '0', '2024-06-29 08:22:16', '2024-06-29 08:22:16', '200/017', 'DCM/LL/2024/01/01', 2),
(30, 5, 10, 'Seyani', 'Kalambo', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student2@gmail.com', '0', '2024-06-29 08:22:16', '2024-06-29 08:22:16', '200/018', 'DCM/LL/2024/01/02', 2),
(31, 5, 10, 'Alfred', 'Kamuni', 'M', 'DCM1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-06-29 08:22:16', '2024-06-29 08:22:16', '200/019', 'DCM/LL/2024/01/03', 2),
(32, 5, 10, 'Mebble', 'Ngwira', 'M', 'DCM1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-06-29 08:22:16', '2024-06-29 08:22:16', '200/020', 'DCM/LL/2024/01/04', 2),
(33, 5, 11, 'Favour', 'Banda', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student1@gmail.com', '0', '2024-06-29 08:23:40', '2024-06-29 08:23:40', '200/00021', 'DCM/LL/2024/01/05', 2),
(34, 5, 11, 'Vic', 'Mwale', 'F', 'DCM1', 'Basic', 'Lilongwe', 'student2@gmail.com', '0', '2024-06-29 08:23:40', '2024-06-29 08:23:40', '200/00022', 'DCM/LL/2024/01/06', 2),
(35, 5, 11, 'Pempho', 'Banda', 'M', 'DCM1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-06-29 08:23:40', '2024-06-29 08:23:40', '200/00023', 'DCM/LL/2024/01/07', 2),
(36, 5, 11, 'Yankho', 'Phiri', 'M', 'DCM1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-06-29 08:23:40', '2024-06-29 08:23:40', '200/00024', 'DCM/LL/2024/01/08', 2),
(37, 5, 13, 'Yami', 'Ngozo', 'F', 'DCM1', 'Basic', 'Blantyre', 'student1@gmail.com', '0', '2024-06-29 08:30:30', '2024-06-29 08:30:30', '200/0030', 'DCM/BT/2023/056', 2),
(38, 5, 13, 'Su', 'Manda', 'F', 'DCM1', 'Basic', 'Blantyre', 'student2@gmail.com', '0', '2024-06-29 08:30:30', '2024-06-29 08:30:30', '200/0031', 'DCM/BT/2023/057', 2),
(39, 5, 13, 'Joy', 'Jeke', 'M', 'DCM1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-06-29 08:30:30', '2024-06-29 08:30:30', '200/0032', 'DCM/BT/2023/058', 2),
(40, 5, 13, 'Shilla', 'Amadu', 'M', 'DCM1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-06-29 08:30:30', '2024-06-29 08:30:30', '200/0033', 'DCM/BT/2023/059', 2),
(41, 5, 14, 'Yohaane', 'Kamanga', 'F', 'DCM1', 'Basic', 'Blantyre', 'student1@gmail.com', '0', '2024-06-29 08:31:46', '2024-06-29 08:31:46', '200/0036', 'DCM/BT/2023/6/023', 2),
(42, 5, 14, 'Esther', 'Mhango', 'F', 'DCM1', 'Basic', 'Blantyre', 'student2@gmail.com', '0', '2024-06-29 08:31:46', '2024-06-29 08:31:46', '200/0037', 'DCM/BT/2023/6/024', 2),
(43, 5, 14, 'Glad', 'Manda', 'M', 'DCM1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-06-29 08:31:46', '2024-06-29 08:31:46', '200/0038', 'DCM/BT/2023/6/025', 2),
(44, 5, 14, 'Jose', 'Mwamadi', 'M', 'DCM1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-06-29 08:31:46', '2024-06-29 08:31:46', '200/0039', 'DCM/BT/2023/6/026', 2);

-- --------------------------------------------------------

--
-- Table structure for table `assessmentlists`
--

CREATE TABLE `assessmentlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessmentlists`
--

INSERT INTO `assessmentlists` (`id`, `assessment_name`, `created_at`, `updated_at`) VALUES
(1, 'Assignment', NULL, NULL),
(2, 'Mid-Semester', NULL, NULL),
(3, 'End-of-semester Exam', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campus` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `campus`, `email`, `phone`, `district`, `created_at`, `updated_at`) VALUES
(1, 'Lilongwe', 'crlilongwe@mchs.mw', '0995628997', 'Lilongwe', '2024-04-10 05:40:57', '2024-04-10 05:40:57'),
(2, 'Blantyre', 'crblantyre@mchs.mw', '0999119743', 'Balaka', '2024-04-10 05:42:04', '2024-04-10 05:42:04'),
(3, 'Zomba', 'crzomba@mchs.mw', '0999332289', 'Neno', '2024-04-10 05:42:52', '2024-04-10 05:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `department_id`, `name`, `status`, `level`, `created_at`, `updated_at`) VALUES
(1, 'CPH1101', 33, 'Pharmacology', 1, 1, '2024-05-02 14:54:47', '2024-05-02 14:54:47'),
(2, 'CPH1102', 34, 'Pharmacy Trends', 1, 1, '2024-05-02 14:58:37', '2024-05-02 14:58:37'),
(3, 'CPH1103', 33, 'Basic Pharmaceutical calculations', 1, 1, '2024-05-02 14:59:58', '2024-05-02 14:59:58'),
(4, 'CPH1104', 33, 'Statistics', 1, 1, '2024-05-02 15:02:56', '2024-05-02 15:02:56'),
(5, 'CCM1101', 22, 'Medical Health', 1, 1, '2024-05-02 15:04:18', '2024-05-02 15:04:18'),
(6, 'CCM1102', 23, 'Pathology', 1, 1, '2024-05-02 15:04:50', '2024-05-02 15:04:50'),
(7, 'CCM1103', 22, 'Human Anatomy and Physiology', 1, 1, '2024-05-02 15:06:31', '2024-05-02 15:06:31'),
(8, 'CCM1104', 23, 'Internal Medicine', 1, 1, '2024-05-02 15:12:39', '2024-05-02 15:12:39'),
(9, 'CCM1105', 23, 'General Surgery', 1, 1, '2024-05-02 15:13:20', '2024-05-02 15:13:20'),
(10, 'CCM1106', 23, 'Dermatology', 1, 1, '2024-05-02 15:14:31', '2024-05-02 15:14:31'),
(11, 'DR1101', 28, 'Imaging Science', 1, 1, '2024-05-04 11:13:42', '2024-05-04 11:13:42'),
(12, 'DR1102', 28, 'Scanning Concepts', 1, 1, '2024-05-04 11:14:42', '2024-05-04 11:14:42'),
(13, 'DR1103', 28, 'Radiographic Mapping', 1, 1, '2024-05-04 11:15:29', '2024-05-04 11:15:29'),
(14, 'NMT1101', 31, 'Nursing Surgery', 1, 1, '2024-05-04 11:16:54', '2024-05-04 11:16:54'),
(15, 'NMT1102', 31, 'Midwifery Sciences', 1, 1, '2024-05-04 11:17:36', '2024-05-04 11:17:36'),
(16, 'DCM2101', 32, 'Surgical Medicine', 1, 1, '2024-05-06 15:56:00', '2024-05-06 15:56:00'),
(17, 'DCA1101', 35, 'Clinical Anaesthesia', 1, 1, '2024-05-22 06:06:20', '2024-05-22 06:06:20'),
(18, 'DCA1102', 35, 'Into to Anaesthesia lab', 1, 1, '2024-05-22 06:06:57', '2024-05-22 06:06:57'),
(19, 'DCA1103', 35, 'Anaesthesia sciences', 1, 1, '2024-05-22 06:08:11', '2024-05-22 06:08:11'),
(20, 'DCA1104', 35, 'Anaesthesia Concepts', 1, 1, '2024-05-22 06:08:42', '2024-05-22 06:08:42'),
(21, 'DCA1105', 35, 'Practical anaesthesia', 1, 1, '2024-05-22 06:09:36', '2024-05-22 06:09:36'),
(22, 'DCM1101', 24, 'Surgical Ethics', 1, 1, '2024-06-08 06:58:13', '2024-06-08 07:07:30'),
(23, 'DCM1102', 23, 'Medical Theory', 1, 1, '2024-06-08 07:06:52', '2024-06-08 07:06:52'),
(24, 'DCM1103', 24, 'Basic Parasitology', 1, 1, '2024-06-08 07:08:26', '2024-06-08 07:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `campus_id` tinyint(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `faculty_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `campus_id`, `user_id`, `faculty_id`, `created_at`, `updated_at`) VALUES
(22, 'Department of CCM', 1, 33, 6, '2024-04-28 06:15:55', '2024-04-28 06:15:55'),
(23, 'Department of CCM', 2, 39, 6, '2024-04-28 06:19:41', '2024-04-28 06:19:41'),
(24, 'Department of DCM', 1, 31, 6, '2024-04-28 06:22:06', '2024-04-28 06:22:06'),
(25, 'Department of Environmental Health', 1, 40, 5, '2024-04-28 06:29:40', '2024-04-28 06:29:40'),
(26, 'Department of Basic Sciences', 1, 43, 8, '2024-04-28 06:33:18', '2024-04-28 06:33:18'),
(27, 'Department of Basic Sciences', 2, 42, 8, '2024-04-28 06:42:47', '2024-04-28 06:42:47'),
(28, 'Department of Radiography', 1, 34, 8, '2024-04-28 06:47:07', '2024-04-28 06:47:07'),
(29, 'Department of Dental Therapy', 1, 35, 8, '2024-04-28 06:47:33', '2024-04-28 06:47:33'),
(30, 'Department of Community Health Nursing', 1, 5, 7, '2024-04-28 06:48:36', '2024-04-28 06:48:36'),
(31, 'Department of NMT', 3, 41, 7, '2024-04-28 06:49:02', '2024-04-28 06:49:02'),
(32, 'Department of DCM', 2, 38, 6, '2024-04-28 07:02:53', '2024-04-28 07:02:53'),
(33, 'Department of Pharmacy', 3, 37, 8, '2024-04-28 08:05:36', '2024-04-28 08:05:36'),
(34, 'Department of Pharmacy', 1, 36, 8, '2024-04-28 08:05:53', '2024-04-28 08:05:53'),
(35, 'Department of Clinical Anesthesia', 1, 39, 6, '2024-05-02 19:07:08', '2024-05-02 19:07:08'),
(36, 'Department of Clinical Anesthesia', 2, 38, 6, '2024-05-02 19:07:45', '2024-05-02 19:07:45'),
(37, 'Department of Basic Sciences', 3, 37, 8, '2024-05-04 05:18:50', '2024-05-04 05:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faculty_name` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty_name`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 'Faculty of Environmental Sciences', 8, '2024-04-28 06:01:20', '2024-04-28 06:01:20'),
(6, 'Faculty of Clinical Sciences', 7, '2024-04-28 06:01:35', '2024-04-28 06:01:35'),
(7, 'Faculty of Nursing Sciences', 6, '2024-04-28 06:02:01', '2024-04-28 06:02:01'),
(8, 'Faculty of Medical Sciences', 5, '2024-04-28 06:02:46', '2024-04-28 06:02:46');

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
-- Table structure for table `feecategories`
--

CREATE TABLE `feecategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feecode` varchar(255) NOT NULL,
  `feename` varchar(255) NOT NULL,
  `local_fee` int(255) DEFAULT NULL,
  `foreign_fee` int(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feecategories`
--

INSERT INTO `feecategories` (`id`, `feecode`, `feename`, `local_fee`, `foreign_fee`, `created_at`, `updated_at`) VALUES
(1, 'BE', 'Basic Entry', 660000, 0, '2024-04-11 12:57:30', '2024-04-11 12:57:30'),
(2, 'HSA-2024', 'HSA 2024', 800000, 789, '2024-04-11 12:58:34', '2024-04-11 12:58:34'),
(3, 'UPG', 'Upgrading', 880000, 0, '2024-04-19 17:29:14', '2024-04-19 17:29:14'),
(4, 'ME', 'Mature Entry', 1000000, 0, '2024-04-19 17:33:04', '2024-04-19 17:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_subjects`
--

CREATE TABLE `lecturer_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academicyr_id` tinyint(4) DEFAULT NULL,
  `classid` tinyint(4) NOT NULL,
  `courseid` tinyint(4) NOT NULL,
  `userid` tinyint(4) NOT NULL,
  `coordinator` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `semester` tinyint(4) DEFAULT NULL,
  `campus_id` tinyint(4) DEFAULT NULL,
  `access_level` tinyint(4) NOT NULL DEFAULT 1,
  `basic` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, '2024_03_13_175119_create_permission_tables', 2),
(6, '2024_03_24_084655_create_faculties_table', 2),
(7, '2024_03_24_101829_create_departments_table', 2),
(8, '2024_03_24_165043_add_lname_to_users_table', 3),
(9, '2024_03_24_165630_add_gender_to_users_table', 4),
(10, '2024_03_24_165739_add_roles_to_users_table', 4),
(11, '2024_03_24_165912_add_department_to_users_table', 4),
(12, '2024_03_24_181839_add_department_id_to_users_table', 5),
(13, '2024_03_24_183051_add_campus01_to_users_table', 6),
(14, '2024_03_24_183640_add_campus_ll_to_users_table', 7),
(15, '2024_03_24_184943_add_campus_bt_to_users_table', 8),
(16, '2024_03_24_185532_add_campus_bt_to_users_table', 9),
(17, '2024_03_24_185849_add_campus_za_to_users_table', 10),
(18, '2024_03_25_083805_create_campuses_table', 11),
(19, '2024_03_25_121519_create_faculties_table', 12),
(20, '2024_03_25_192732_create_faculties_table', 13),
(21, '2024_03_25_194557_create_faculties_table', 14),
(22, '2024_03_25_200455_create_faculties_table', 15),
(23, '2024_03_26_140158_create_departments_table', 16),
(24, '2024_03_28_140212_create_courses_table', 17),
(25, '2024_03_29_170615_create_feecategories_table', 18),
(26, '2024_03_29_171315_create_feecategories_table', 19),
(27, '2024_03_30_135128_create_programs_table', 20),
(29, '2024_04_02_092806_create_academicyears_table', 21),
(30, '2024_04_04_174253_create_semesters_table', 22),
(31, '2024_04_08_075040_create_admissions_table', 23),
(32, '2024_04_08_075128_create_uploadedstudents_table', 23),
(34, '2024_04_08_181019_create_uploadlists_table', 24),
(35, '2024_04_11_132442_create_programclasses_table', 25),
(36, '2024_04_12_152338_create_students_table', 26),
(38, '2024_04_18_155857_create_classsubjects_table', 27),
(39, '2024_04_19_183335_add_coordinator_to_programclasses', 28),
(41, '2024_04_21_185209_create_myclasssubjects_table', 29),
(42, '2024_04_24_140857_create_myclasssubject_user_table', 29),
(43, '2024_04_24_170803_create_studentsubjects_table', 30),
(44, '2024_04_28_072242_add_campus_id_to_programclasses', 31),
(45, '2024_05_04_080820_add_under_basic_to_programclasses_table', 32),
(46, '2024_05_04_133915_add_campus_id_to_myclasssubjects_table', 33),
(47, '2024_05_19_143004_create_lecturer_subjects_table', 34),
(48, '2024_05_19_145735_create_lecturer_subjects_table', 35),
(49, '2024_05_21_151154_add_campus_id_to_studentsubjects', 36),
(50, '2024_05_23_155715_add_semester_to_lecturer_subjects_table', 37),
(51, '2024_05_28_083143_create_assessmentlists_table', 38),
(52, '2024_05_31_091951_add_lecturer_id_to_studentsubjects_table', 39),
(53, '2024_05_31_130927_add_levels_to_studentsubjects_table', 40),
(54, '2024_06_01_084440_create_accesslevels_table', 41),
(55, '2024_06_05_185735_add_remark_to_studentsubjects_table', 42),
(56, '2024_06_05_193459_add_hod_id_to_studentsubjects_table', 43),
(57, '2024_06_15_092038_add_active_to_users_table', 44),
(58, '2024_06_18_114113_create_studentprofiles_table', 45),
(59, '2024_06_18_122548_add_photo_to_studentprofiles_table', 46),
(60, '2024_06_27_111001_add_reference_no_to_admissions_table', 47),
(61, '2024_06_28_122716_add_semester_to_admissions_table', 48);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 305);

-- --------------------------------------------------------

--
-- Table structure for table `myclasssubjects`
--

CREATE TABLE `myclasssubjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programclass_id` bigint(20) UNSIGNED NOT NULL,
  `classcode` varchar(255) DEFAULT NULL,
  `semester` tinyint(4) NOT NULL,
  `course_id` tinyint(4) NOT NULL,
  `ca_weight` int(11) DEFAULT NULL,
  `exam_weight` int(11) DEFAULT NULL,
  `pass_mark` int(11) DEFAULT NULL,
  `is_project` varchar(255) NOT NULL,
  `is_major` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `myclasssubject_user`
--

CREATE TABLE `myclasssubject_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `myclasssubject_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add academic session', 'add academic session', 'web', '2024-07-05 14:23:49', '2024-07-05 14:23:49'),
(2, 'edit academic session', 'edit academic session', 'web', '2024-07-05 14:24:49', '2024-07-05 14:24:49'),
(3, 'delete academic session', 'delete academic session', 'web', '2024-07-05 14:25:10', '2024-07-05 14:25:10'),
(4, 'add faculty', 'add faculty', 'web', '2024-07-05 14:25:33', '2024-07-05 14:25:33'),
(5, 'edit faculty', 'edit faculty', 'web', '2024-07-05 14:25:48', '2024-07-05 14:25:48'),
(6, 'delete faculty', 'delete faculty', 'web', '2024-07-05 14:26:07', '2024-07-06 08:23:52'),
(7, 'add campus', 'add campus', 'web', '2024-07-05 14:26:21', '2024-07-05 14:26:21'),
(8, 'edit campus', 'edit campus', 'web', '2024-07-05 14:26:36', '2024-07-05 14:26:36'),
(9, 'add department', 'add department', 'web', '2024-07-05 14:26:55', '2024-07-05 14:26:55'),
(10, 'edit department', 'edit department', 'web', '2024-07-05 14:27:15', '2024-07-05 14:27:15'),
(11, 'delete department', 'delete department', 'web', '2024-07-05 14:27:34', '2024-07-05 14:27:34'),
(12, 'add program', 'add program', 'web', '2024-07-06 07:52:35', '2024-07-06 07:52:35');

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
-- Table structure for table `programclasses`
--

CREATE TABLE `programclasses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classcode` varchar(255) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `classyear` tinyint(4) NOT NULL,
  `feecategory_id` bigint(255) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coordinator` tinyint(4) NOT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `under_basic` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=yes\r\n0=no\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programclasses`
--

INSERT INTO `programclasses` (`id`, `classcode`, `classname`, `classyear`, `feecategory_id`, `program_id`, `created_at`, `updated_at`, `coordinator`, `campus_id`, `under_basic`) VALUES
(1, 'DCM1', 'Diploma in Clinical Medicine 1', 1, 1, 3, '2024-06-08 06:05:58', '2024-06-13 06:20:30', 43, 1, 1),
(2, 'DCM2', 'Diploma in Clinical Medicine 2', 2, 1, 3, '2024-06-08 06:09:28', '2024-06-08 06:09:28', 31, 1, 0),
(3, 'DCM1', 'Diploma in Clinical Medicine 1', 1, 1, 11, '2024-06-08 06:11:14', '2024-06-13 07:51:50', 7, 2, 1),
(4, 'DCM2', 'Diploma in Clinical Medicine 2', 2, 1, 11, '2024-06-08 06:11:55', '2024-06-08 06:11:55', 39, 2, 0),
(5, 'CPH1', 'Certificate in Pharmacy 1', 1, 1, 6, '2024-06-08 06:43:54', '2024-06-08 06:43:54', 37, 3, 0),
(6, 'CPH2', 'Certificate in Pharmacy 2', 2, 1, 6, '2024-06-08 06:44:31', '2024-06-08 06:44:31', 37, 3, 0),
(7, 'CPH1', 'Certificate in Pharmacy 1', 1, 1, 7, '2024-06-08 06:45:34', '2024-06-08 06:45:34', 36, 1, 0),
(9, 'CPH2', 'Certificate in Pharmacy 2', 2, 1, 7, '2024-06-08 06:50:48', '2024-06-08 06:50:48', 36, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `program_code` varchar(255) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `entry_level` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `campus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `award` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `short_name`, `program_code`, `program_name`, `duration`, `entry_level`, `user_id`, `department_id`, `campus_id`, `award`, `created_at`, `updated_at`) VALUES
(1, NULL, 'CCM', 'Certificate in Clinical Medicine', 36, 'Basic', 33, 22, 1, 'certificate', '2024-04-28 07:20:09', '2024-04-28 07:20:09'),
(2, NULL, 'CCM', 'Certificate in Clinical Medicine', 36, 'Basic', 38, 23, 2, 'certificate', '2024-04-28 07:35:34', '2024-04-28 07:35:34'),
(3, NULL, 'DCM', 'Diploma in Clinical Medicine', 48, '1', 31, 24, 1, 'Certificate', '2024-04-28 07:54:39', '2024-06-13 13:25:14'),
(4, NULL, 'DR', 'Diploma in Radiography', 36, 'Basic', 34, 28, 1, 'diploma', '2024-04-28 08:03:21', '2024-04-28 08:03:21'),
(5, NULL, 'NMT', 'Diploma in Nursing and Midwifery Technician', 36, 'Basic', 41, 31, 3, 'diploma', '2024-04-28 08:16:05', '2024-04-28 08:16:05'),
(6, NULL, 'CPH', 'Certificate in Pharmacy', 24, 'Basic', 37, 33, 3, 'certificate', '2024-04-28 08:18:57', '2024-04-28 08:18:57'),
(7, NULL, 'CPH', 'Certificate in Pharmacy', 24, 'Basic', 36, 34, 1, 'certificate', '2024-04-28 08:19:36', '2024-04-28 08:19:36'),
(8, NULL, 'CCH', 'Certificate in Community Health', 12, 'Post Basic', 40, 25, 1, 'certificate', '2024-04-28 08:23:17', '2024-04-28 08:23:17'),
(9, NULL, 'DCA', 'Diploma in Clinical Anasthesia', 24, 'Basic', 38, 35, 1, 'diploma', '2024-05-02 19:10:06', '2024-05-02 19:10:06'),
(10, NULL, 'DCA', 'Diploma in Clinical Anasthesia', 24, 'Basic', 39, 36, 2, 'diploma', '2024-05-02 19:11:16', '2024-05-02 19:11:16'),
(11, NULL, 'DCM', 'Diploma in Clinical Medicine', 24, 'Basic', 39, 32, 2, 'diploma', '2024-05-06 15:54:15', '2024-05-06 15:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ED', 'Executive Director', 'web', '2024-07-05 13:29:35', '2024-07-05 13:29:35'),
(2, 'Registrar', 'College Registrar', 'web', '2024-07-05 13:30:44', '2024-07-06 07:44:35'),
(3, 'DCR-Academic', 'Deputy College Registrar - Academic', 'web', '2024-07-05 13:40:43', '2024-07-06 05:37:50'),
(4, 'DCR-Admin', 'Deputy College Registrar - Admin', 'web', '2024-07-05 13:41:09', '2024-07-06 08:24:21'),
(5, 'Admin', 'Administrator of the system', 'web', '2024-07-06 09:13:38', '2024-07-06 09:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 5),
(2, 5),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(8, 2),
(11, 2),
(11, 3),
(12, 2),
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academicyear_id` bigint(20) UNSIGNED NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `ssdate` date NOT NULL,
  `sedate` date NOT NULL,
  `rsdate` date NOT NULL,
  `redate` date NOT NULL,
  `is_semester_final` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `academicyear_id`, `semester`, `ssdate`, `sedate`, `rsdate`, `redate`, `is_semester_final`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '2024-04-13', '2024-05-20', '2024-04-13', '2024-04-30', 1, '2024-04-05 09:57:37', '2024-04-13 10:29:10'),
(2, 5, 2, '2024-05-06', '2025-12-26', '2024-05-09', '2024-05-29', 1, '2024-04-05 10:34:34', '2024-04-06 15:49:59'),
(3, 5, 1, '2024-04-08', '2024-04-28', '2024-04-06', '2024-04-20', 1, '2024-04-05 12:58:17', '2024-04-06 15:50:52'),
(4, 7, 2, '2024-04-20', '2024-04-30', '2024-04-20', '2024-05-04', 1, '2024-04-05 13:00:06', '2024-04-05 13:00:06'),
(5, 7, 3, '2024-04-05', '2024-04-18', '2024-04-05', '2024-04-19', 1, '2024-04-06 05:15:39', '2024-04-06 05:15:39'),
(6, 7, 4, '2024-04-07', '2024-04-10', '2024-04-07', '2024-04-21', 1, '2024-04-06 07:42:19', '2024-04-06 07:42:19'),
(7, 10, 1, '2024-06-04', '2024-10-04', '2024-06-04', '2024-06-20', 1, '2024-06-08 05:48:43', '2024-06-08 05:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `studentprofiles`
--

CREATE TABLE `studentprofiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `initials` varchar(255) NOT NULL,
  `dbirth` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `marital` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `traditional` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `student_phone1` varchar(255) NOT NULL,
  `student_phone2` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `kin_fullname` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `kin_phone` varchar(255) NOT NULL,
  `kin_email` varchar(255) NOT NULL,
  `kin_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentsubjects`
--

CREATE TABLE `studentsubjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academicyr_id` tinyint(4) NOT NULL,
  `programclass_id` tinyint(4) NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `assessment1` int(11) DEFAULT NULL,
  `assessment2` int(11) DEFAULT NULL,
  `exam_grade` int(11) DEFAULT NULL,
  `final_grade` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `campus_id` tinyint(4) DEFAULT NULL,
  `lecturer_id` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `access_level` tinyint(4) NOT NULL DEFAULT 0,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploadlists`
--

CREATE TABLE `uploadlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_yr_id` tinyint(4) NOT NULL,
  `upload_name` varchar(255) NOT NULL,
  `intake_month` tinyint(255) DEFAULT 0,
  `campus` int(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `processed` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploadlists`
--

INSERT INTO `uploadlists` (`id`, `academic_yr_id`, `upload_name`, `intake_month`, `campus`, `user_id`, `processed`, `created_at`, `updated_at`) VALUES
(1, 9, '2024 DCM Lilongwe', 4, 1, '1', 1, '2024-06-29 07:21:04', '2024-06-29 07:21:11'),
(2, 9, '2024 DCM Lilongwe SS', 4, 1, '1', 1, '2024-06-29 07:22:16', '2024-06-29 07:22:24'),
(3, 9, '2024 DCM Blantyre', 4, 2, '1', 1, '2024-06-29 07:23:57', '2024-06-29 07:24:19'),
(4, 9, '2024 DCM Blantyre SS', 4, 2, '1', 1, '2024-06-29 07:25:05', '2024-06-29 07:25:30'),
(10, 5, '2020 DCM Lilongwe old', 1, 1, '1', 1, '2024-06-29 08:22:16', '2024-06-29 08:22:24'),
(11, 5, '2024 DCM Lilongwe old extra', 1, 1, '1', 1, '2024-06-29 08:23:40', '2024-06-29 08:23:46'),
(12, 5, '2024 DCM Lilongwe', 1, 1, '1', 0, '2024-06-29 08:28:54', '2024-06-29 08:28:54'),
(13, 5, '2024 DCM Blantyre Old', 1, 2, '1', 1, '2024-06-29 08:30:30', '2024-06-29 08:30:35'),
(14, 5, '2020 DCM Blantyre Old extra', 1, 2, '1', 1, '2024-06-29 08:31:46', '2024-06-29 08:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `department_id` tinyint(4) DEFAULT NULL,
  `academicyear_id` int(11) DEFAULT NULL,
  `uploadlist_id` int(11) DEFAULT NULL,
  `programclass` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `reg_num` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `semester` tinyint(4) DEFAULT NULL,
  `registered` tinyint(4) DEFAULT 0,
  `exam_number` int(11) DEFAULT 0,
  `entry_level` varchar(255) DEFAULT NULL,
  `campus` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `department_id`, `academicyear_id`, `uploadlist_id`, `programclass`, `lname`, `reg_num`, `phone`, `gender`, `role`, `semester`, `registered`, `exam_number`, `entry_level`, `campus`, `email`, `country`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Andy', NULL, NULL, NULL, NULL, 'Chigalu', '', NULL, 'M', 'Registrar', NULL, 0, 0, NULL, NULL, 'andy.chigalu@gmail.com', NULL, NULL, '$2y$12$UCbP..93X1TG3i4kUXS7tuQDFwHFVleHrsfsaS/d8taLV5G9DYBTW', NULL, '2024-02-27 04:53:36', '2024-07-07 15:01:52', 1),
(2, 'Tahla', NULL, NULL, NULL, NULL, 'Mwale', NULL, NULL, 'F', 'lecturer', NULL, 0, 0, NULL, NULL, 'tmwale@gmail.com', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(5, 'Charity', NULL, NULL, NULL, NULL, 'Sinkala', NULL, NULL, 'F', 'DCR-Academic', NULL, 0, 0, NULL, NULL, 'charity@gmail.com', NULL, NULL, '$2y$12$.UVSoh.52ZbEJaXKVf9coOfFLHp8ZuIS8lKHdUjrI04l5os0Va6gC', NULL, NULL, '2024-07-06 17:01:57', 0),
(6, 'Joyce', NULL, NULL, NULL, NULL, 'Malota', NULL, NULL, 'F', 'lecturer', NULL, 0, 0, NULL, NULL, 'joyce@gmail.com', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(7, 'Symon', NULL, NULL, NULL, NULL, 'Nyondo', NULL, NULL, 'M', 'HOD', NULL, 0, 0, NULL, NULL, 'symon@gmail.com', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(8, 'Esther', 25, NULL, NULL, NULL, 'Kaunda', NULL, NULL, 'F', 'hod', NULL, 0, 0, NULL, 'Lilongwe', 'esther@gmail.com', NULL, NULL, '$2y$12$pkMoj8OsyGtws1Hnj8L6PewwlhjSBi6HMD5K29DzvD7OMAaYT65sK', NULL, NULL, '2024-06-18 07:44:17', 1),
(31, 'Wicliff', NULL, NULL, NULL, NULL, 'Kaputalambwe', NULL, NULL, 'M', 'HOD', NULL, 0, 0, NULL, NULL, 'wkaputalambwe@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(33, 'Joseph', NULL, NULL, NULL, NULL, 'January', NULL, NULL, 'M', 'Principal', NULL, 0, 0, NULL, NULL, 'jjanuary@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(34, 'Eva', 28, NULL, NULL, NULL, 'Nthete', NULL, NULL, 'M', 'DCR', NULL, 0, 0, NULL, NULL, 'enthete@mchs.mw', NULL, NULL, '$2y$12$GQ7eLwwp.11bQR20AujvBeaD2/VAUZF7di.A8rhwSp8znHhlLd0Vq', NULL, NULL, '2024-06-24 07:26:38', 1),
(35, 'Doubt', NULL, NULL, NULL, NULL, 'Kajilime', NULL, NULL, 'M', 'Campus Regitrar', NULL, 0, 0, NULL, NULL, 'dkajilime@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, '2024-06-15 09:27:49', 0),
(36, 'Ginjer', NULL, NULL, NULL, NULL, 'Mtonga', NULL, NULL, 'M', 'lecturer', NULL, 0, 0, NULL, NULL, 'jmtonga@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(37, 'King', NULL, NULL, NULL, NULL, 'Bwaila', NULL, NULL, 'M', 'HOD', NULL, 0, 0, NULL, NULL, 'kbwaila@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(38, 'Petros', NULL, NULL, NULL, NULL, 'Muonjeza', NULL, NULL, NULL, 'HOD BASIC BT', NULL, 0, 0, NULL, NULL, 'pmuonjeza@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(39, 'Frank', NULL, NULL, NULL, NULL, 'Mpotha', NULL, NULL, NULL, 'Dean', NULL, 0, 0, NULL, NULL, 'fmpotha@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(40, 'Joviter', NULL, NULL, NULL, NULL, 'Mwaulemu', NULL, NULL, NULL, 'lecturer', NULL, 0, 0, NULL, NULL, 'jmwaulemu@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(41, 'Ibrahim', NULL, NULL, NULL, NULL, 'Gama', NULL, NULL, 'M', 'College Registrar', NULL, 0, 0, NULL, NULL, 'igama@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, '2024-06-15 08:18:51', 0),
(42, 'Chris', NULL, NULL, NULL, NULL, 'Chimzimu', NULL, NULL, 'M', 'Executive Director', NULL, 0, 0, NULL, NULL, 'cchinzimu@mchs.mw', NULL, NULL, '$2y$12$tAoQHxoJfEtO5GE7QhhJm.BinqfCgmR/lwGGn7OkcwnDREhJ9XCz.', NULL, NULL, '2024-07-07 15:53:26', 0),
(43, 'Jimmy', NULL, NULL, NULL, NULL, 'Mwakhanzi', NULL, NULL, NULL, 'HOD BASIC LL', NULL, 0, 0, NULL, NULL, 'jmwakhanzi@mchs.mw', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL, 1),
(254, 'Maiden', NULL, 9, 1, 'DCM1', 'Gondwe', 'DCM/LL/2024/4/01', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcmll2024401@mchs.mw', NULL, NULL, '$2y$12$zZudWDmsERsqElj1nMTHAeTccIupZQI4GtAaGP2tiu17fvPHMXww2', NULL, '2024-06-29 07:21:10', '2024-06-29 07:21:10', 1),
(255, 'Ibrahim', NULL, 9, 1, 'DCM1', 'Madi', 'DCM/LL/2024/4/02', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcmll2024402@mchs.mw', NULL, NULL, '$2y$12$x7pqgxRXG4BPL1A7UyUCiOYOEZyFCUWnNOaG2ID0t09ykl0HpFdbW', NULL, '2024-06-29 07:21:11', '2024-06-29 07:21:11', 1),
(256, 'Steve', NULL, 9, 1, 'DCM1', 'Mwase', 'DCM/LL/2024/4/03', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcmll2024403@mchs.mw', NULL, NULL, '$2y$12$0fTg0bW4IzreWdV/oV3rDeu4vy6uqByMdNXd.8EDmx7YOeDRpxwca', NULL, '2024-06-29 07:21:11', '2024-07-07 17:46:40', 1),
(257, 'Zelifa', NULL, 9, 1, 'DCM1', 'Sipasi', 'DCM/LL/2024/4/04', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcmll2024404@mchs.mw', NULL, NULL, '$2y$12$JdIQky4sUBSR5741bj8OuOOAjeapivFgn0fceQSPgLhjQvVQf0h1K', NULL, '2024-06-29 07:21:11', '2024-06-29 07:21:11', 1),
(258, 'Cyrus', NULL, 9, 2, 'DCM1', 'Khan', 'DCM/LL/2024/4/05', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcmll2024405@mchs.mw', NULL, NULL, '$2y$12$xeFoRlujjCrqijqCu7t3puhP2r1UULpX2gW/AgXE6tF8WABgKToS.', NULL, '2024-06-29 07:22:23', '2024-06-29 07:22:23', 1),
(259, 'James', NULL, 9, 2, 'DCM1', 'Manda', 'DCM/LL/2024/4/06', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcmll2024406@mchs.mw', NULL, NULL, '$2y$12$I7JtIn7BltiTrhoqlkofVeZefyRPtLVDV.Ct5hfS7rB3sr./RBbSm', NULL, '2024-06-29 07:22:23', '2024-06-29 07:22:23', 1),
(260, 'Jones', NULL, 9, 2, 'DCM1', 'Mhone', 'DCM/LL/2024/4/07', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcmll2024407@mchs.mw', NULL, NULL, '$2y$12$0qEC8Ls/UOsQeVNSCFgfAeBii/F1fIeaWs8m3iFYnIRIS/j4jdvSi', NULL, '2024-06-29 07:22:24', '2024-06-29 07:22:24', 1),
(261, 'Melvis', NULL, 9, 2, 'DCM1', 'Miya', 'DCM/LL/2024/4/08', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcmll2024408@mchs.mw', NULL, NULL, '$2y$12$V65Iu6jPEYJJdHwh5b3aSO0gUqpajfaRmaeAf7bx.Ne0WRW2uez1O', NULL, '2024-06-29 07:22:24', '2024-06-29 07:22:24', 1),
(262, 'Maneno', NULL, 9, 3, 'DCM1', 'Harlod', 'DCM/BT/2024/4/01', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcmbt2024401@mchs.mw', NULL, NULL, '$2y$12$EU4zxRkSr7DkFXsHx9IXIe25rFoz1M1yFdF.s2/DoEV1n1YRVkv66', NULL, '2024-06-29 07:24:18', '2024-06-29 07:24:18', 1),
(263, 'Limbi', NULL, 9, 3, 'DCM1', 'Malinda', 'DCM/BT/2024/4/02', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcmbt2024402@mchs.mw', NULL, NULL, '$2y$12$Ih8y7n/ARd0lzCZ0oIvdmOgj73520xqw8O79FjAHoSD/6dQurGLNu', NULL, '2024-06-29 07:24:18', '2024-06-29 07:24:18', 1),
(264, 'Joaq', NULL, 9, 3, 'DCM1', 'Mussa', 'DCM/BT/2024/4/03', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcmbt2024403@mchs.mw', NULL, NULL, '$2y$12$dQka7UMklZh6n4dMJIuhI.OvX0hB3dHcAqWqlMRIBEwX6oDJAJLHS', NULL, '2024-06-29 07:24:18', '2024-06-29 07:24:18', 1),
(265, 'Mnenenji', NULL, 9, 3, 'DCM1', 'Njiwa', 'DCM/BT/2024/4/04', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcmbt2024404@mchs.mw', NULL, NULL, '$2y$12$DWHG314E79QEY96ILCw0keyOSFXKImaBFNbmO9D5s.Dg95t6kQl82', NULL, '2024-06-29 07:24:19', '2024-06-29 07:24:19', 1),
(266, 'Namani', NULL, 9, 4, 'DCM1', 'Banda', 'DCM/BT/2024/4/05', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcmbt2024405@mchs.mw', NULL, NULL, '$2y$12$M26McW3rcPCZKVDRW9bW1ef03Te.zBJ08G4KNVTWIAzmdKWtb76zK', NULL, '2024-06-29 07:25:30', '2024-06-29 07:25:30', 1),
(267, 'Hend', NULL, 9, 4, 'DCM1', 'Mwale', 'DCM/BT/2024/4/06', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcmbt2024406@mchs.mw', NULL, NULL, '$2y$12$7vk2Ys0lUr.SS45CHgeE9ObORzK6MmWmYT8fiqI1RQlELD2A1ByhK', NULL, '2024-06-29 07:25:30', '2024-06-29 07:25:30', 1),
(268, 'Chiletso', NULL, 9, 4, 'DCM1', 'Nyirenda', 'DCM/BT/2024/4/07', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcmbt2024407@mchs.mw', NULL, NULL, '$2y$12$H4XgXlHLtVC9.2mVVa3hnOuMlIuQSDC03c3EiIvieZxWkQjo1k/86', NULL, '2024-06-29 07:25:30', '2024-06-29 07:25:30', 1),
(269, 'Nephtali', NULL, 9, 4, 'DCM1', 'Phiri', 'DCM/BT/2024/4/08', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcmbt2024408@mchs.mw', NULL, NULL, '$2y$12$OukjEH.tvrM2HdyEzaVawO5CgTYpQP9R1D3oonRo5.PG6yCQSS4aW', NULL, '2024-06-29 07:25:30', '2024-06-29 07:25:30', 1),
(286, 'Seyani', NULL, 5, 10, 'DCM1', 'Kalambo', 'DCM/LL/2024/01/02', NULL, 'F', 'student', 2, 0, 0, 'Basic', 'Lilongwe', 'DCM/LL/2024/01/02@mchs.mw', NULL, NULL, '$2y$12$/tOO4GWF1q/zY14UiBPor.7kLDrEwxC9LAZSbgAxwilMoezPcvGJC', NULL, '2024-06-29 08:22:23', '2024-06-29 08:22:23', 1),
(287, 'Steven', NULL, 5, 10, 'DCM1', 'Kamanga', 'DCM/LL/2024/01/01', NULL, 'F', 'student', 2, 0, 0, 'Basic', 'Lilongwe', 'DCM/LL/2024/01/01@mchs.mw', NULL, NULL, '$2y$12$N4UtBUBUghP0yjQ629MkMeRvf0A.VYca2x.qJ1KdEsmfrTn.n6mW6', NULL, '2024-06-29 08:22:23', '2024-06-29 08:22:23', 1),
(288, 'Alfred', NULL, 5, 10, 'DCM1', 'Kamuni', 'DCM/LL/2024/01/03', NULL, 'M', 'student', 2, 0, 0, 'Basic', 'Lilongwe', 'DCM/LL/2024/01/03@mchs.mw', NULL, NULL, '$2y$12$ForX.zj8wwYrMg92xl1nhu9BjYOEBcitgL0tJpHvuO3G8eYQZs8Zy', NULL, '2024-06-29 08:22:24', '2024-06-29 08:22:24', 1),
(289, 'Mebble', NULL, 5, 10, 'DCM1', 'Ngwira', 'DCM/LL/2024/01/04', NULL, 'M', 'student', 2, 0, 0, 'Basic', 'Lilongwe', 'DCM/LL/2024/01/04@mchs.mw', NULL, NULL, '$2y$12$iv3vbB402RKBz0B/Hq.JsO8nUAbKLeNAd49Mnnui7YqXuz.70dxoa', NULL, '2024-06-29 08:22:24', '2024-06-29 08:22:24', 1),
(290, 'Favour', NULL, 5, 11, 'DCM1', 'Banda', 'DCM/LL/2024/01/05', NULL, 'F', 'student', 2, 0, 0, 'Basic', 'Lilongwe', 'DCM/LL/2024/01/05@mchs.mw', NULL, NULL, '$2y$12$LERh/7suUpy9TyCrllLTHufUWQK2Bsm7Gi7Vbjhs1g.NuNqSuthCq', NULL, '2024-06-29 08:23:45', '2024-06-29 08:23:45', 1),
(291, 'Pempho', NULL, 5, 11, 'DCM1', 'Banda', 'DCM/LL/2024/01/07', NULL, 'M', 'student', 2, 0, 0, 'Basic', 'Lilongwe', 'DCM/LL/2024/01/07@mchs.mw', NULL, NULL, '$2y$12$TCxsJRYW1GdUn8NWP.l8.OdJrN28Nq6XyXefkswnEGI.k0CK8n8r6', NULL, '2024-06-29 08:23:45', '2024-06-29 08:23:45', 1),
(292, 'Vic', NULL, 5, 11, 'DCM1', 'Mwale', 'DCM/LL/2024/01/06', NULL, 'F', 'student', 2, 0, 0, 'Basic', 'Lilongwe', 'DCM/LL/2024/01/06@mchs.mw', NULL, NULL, '$2y$12$QLOQ7XzBav2Ichhqdj7IS.QTC1HkeAraWrUb3XX71IiDdM1Ce98Ei', NULL, '2024-06-29 08:23:46', '2024-06-29 08:23:46', 1),
(293, 'Yankho', NULL, 5, 11, 'DCM1', 'Phiri', 'DCM/LL/2024/01/08', NULL, 'M', 'student', 2, 0, 0, 'Basic', 'Lilongwe', 'DCM/LL/2024/01/08@mchs.mw', NULL, NULL, '$2y$12$RzpffAYUBi6vxz5DhGd8V.Y3XEN/v6GJigzJxko80ZbMc..10ejbO', NULL, '2024-06-29 08:23:46', '2024-06-29 08:23:46', 1),
(294, 'Shilla', NULL, 5, 13, 'DCM1', 'Amadu', 'DCM/BT/2023/059', NULL, 'M', 'student', 2, 0, 0, 'Basic', 'Blantyre', 'DCM/BT/2023/059@mchs.mw', NULL, NULL, '$2y$12$3dBqoBpu9tElnJm.k.xo4.wYJxdw66A83BE.C7H9LFPFHX6eWrrhm', NULL, '2024-06-29 08:30:34', '2024-07-02 13:59:48', 1),
(295, 'Joy', NULL, 5, 13, 'DCM1', 'Jeke', 'DCM/BT/2023/058', NULL, 'M', 'student', 2, 0, 0, 'Basic', 'Blantyre', 'DCM/BT/2023/058@mchs.mw', NULL, NULL, '$2y$12$zbuXrIxZ4U56mH1eOsXNku6SDGr5BnAkGGcyfdsPAMyLLD6RhhrxW', NULL, '2024-06-29 08:30:34', '2024-06-29 08:30:34', 1),
(296, 'Su', NULL, 5, 13, 'DCM1', 'Manda', 'DCM/BT/2023/057', NULL, 'F', 'student', 2, 0, 0, 'Basic', 'Blantyre', 'DCM/BT/2023/057@mchs.mw', NULL, NULL, '$2y$12$jKnm4ChyeskNri876t/sXuLf0VITFXH20IKVJBv2M.9/hQFllIUyO', NULL, '2024-06-29 08:30:35', '2024-06-29 08:30:35', 1),
(297, 'Yami', NULL, 5, 13, 'DCM1', 'Ngozo', 'DCM/BT/2023/056', NULL, 'F', 'student', 2, 0, 0, 'Basic', 'Blantyre', 'DCM/BT/2023/056@mchs.mw', NULL, NULL, '$2y$12$ugbkPjArl/BWe71FOwROD.zyF.8z04/ufsTbdtsDKfhtbIgVWJUV2', NULL, '2024-06-29 08:30:35', '2024-06-29 08:30:35', 1),
(298, 'Yohaane', NULL, 5, 14, 'DCM1', 'Kamanga', 'DCM/BT/2023/6/023', NULL, 'F', 'student', 2, 0, 0, 'Basic', 'Blantyre', 'DCM/BT/2023/6/023@mchs.mw', NULL, NULL, '$2y$12$73/q4JjKou6aCf0eoDQ.ouvuKCbGcGDAgMPH4i1QRvPmcpemY6G.u', NULL, '2024-06-29 08:31:51', '2024-06-29 08:31:51', 1),
(299, 'Glad', NULL, 5, 14, 'DCM1', 'Manda', 'DCM/BT/2023/6/025', NULL, 'M', 'student', 2, 0, 0, 'Basic', 'Blantyre', 'DCM/BT/2023/6/025@mchs.mw', NULL, NULL, '$2y$12$JGSyRbgrft1ppBFdro5UFOhw8rKfDmayqr89MSevrr0Vnze1/Wro2', NULL, '2024-06-29 08:31:52', '2024-06-29 08:31:52', 1),
(300, 'Esther', NULL, 5, 14, 'DCM1', 'Mhango', 'DCM/BT/2023/6/024', NULL, 'F', 'student', 2, 0, 0, 'Basic', 'Blantyre', 'DCM/BT/2023/6/024@mchs.mw', NULL, NULL, '$2y$12$xPxZmGpIahVi6z6TvXnisOWKzfl5SAbLVGI5lXTYzVo2Pkx8Ol97e', NULL, '2024-06-29 08:31:52', '2024-06-29 08:31:52', 1),
(301, 'Jose', NULL, 5, 14, 'DCM1', 'Mwamadi', 'DCM/BT/2023/6/026', NULL, 'M', 'student', 2, 0, 0, 'Basic', 'Blantyre', 'DCM/BT/2023/6/026@mchs.mw', NULL, NULL, '$2y$12$QJ4LOEe2e/tvyZOHeQg7B.nnM6sUlAb9OeuXuEMzJYnRCEfLUYfO2', NULL, '2024-06-29 08:31:52', '2024-06-29 08:31:52', 1),
(302, 'Limbi', 24, NULL, NULL, NULL, 'Mwale', NULL, NULL, 'M', 'hod', NULL, 0, 0, NULL, 'Lilongwe', 'limbi@gmail.com', NULL, NULL, '$2y$12$67zWoEiefNifpiEgiPVAhuurRUau4rOboxbju00diCVbANHkEWypK', NULL, '2024-07-03 11:58:55', '2024-07-03 11:58:55', 1),
(303, 'Jakeem Vinson', 27, NULL, NULL, NULL, 'Hillary Hutchinson', NULL, NULL, 'F', 'dean', NULL, 0, 0, NULL, 'Lilongwe', 'hiburikut@mailinator.com', NULL, NULL, '$2y$12$nMIOkFcei2kUBZQyDbeXiuaEs48z0FdQXQQ9rvWoy34G1IYaXKLk2', NULL, '2024-07-06 09:02:16', '2024-07-06 09:02:16', 1),
(304, 'Temwa', 0, NULL, NULL, NULL, 'Banda', NULL, NULL, 'F', 'DCR-Admin', NULL, 0, 0, NULL, NULL, 'temwa@gmail.com', NULL, NULL, '$2y$12$QJ41t0CqXZ2a/e8sCxz1oe9J716lFookPCUmosd0fFRGodIzkejaa', NULL, '2024-07-06 09:30:01', '2024-07-06 09:30:01', 1),
(305, 'Yewo', 26, NULL, NULL, NULL, 'Banda', NULL, NULL, 'M', 'Admin', NULL, 0, 0, NULL, 'Lilongwe', 'yewo@gmail.com', NULL, NULL, '$2y$12$wVLGFQqwZJ2JSs/9j2Xn3eFrIs4c7zasMqYMVWmNDVE.Gmrtu8i5.', NULL, '2024-07-06 17:08:25', '2024-07-06 17:08:25', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicyears`
--
ALTER TABLE `academicyears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accesslevels`
--
ALTER TABLE `accesslevels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessmentlists`
--
ALTER TABLE `assessmentlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_department_id_foreign` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_user_id_foreign` (`user_id`),
  ADD KEY `departments_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculties_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feecategories`
--
ALTER TABLE `feecategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer_subjects`
--
ALTER TABLE `lecturer_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `myclasssubjects`
--
ALTER TABLE `myclasssubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myclasssubject_user`
--
ALTER TABLE `myclasssubject_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programclasses`
--
ALTER TABLE `programclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semesters_academicyear_id_foreign` (`academicyear_id`);

--
-- Indexes for table `studentprofiles`
--
ALTER TABLE `studentprofiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentsubjects`
--
ALTER TABLE `studentsubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploadlists`
--
ALTER TABLE `uploadlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicyears`
--
ALTER TABLE `academicyears`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `accesslevels`
--
ALTER TABLE `accesslevels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `assessmentlists`
--
ALTER TABLE `assessmentlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feecategories`
--
ALTER TABLE `feecategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lecturer_subjects`
--
ALTER TABLE `lecturer_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `myclasssubjects`
--
ALTER TABLE `myclasssubjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `myclasssubject_user`
--
ALTER TABLE `myclasssubject_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programclasses`
--
ALTER TABLE `programclasses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `studentprofiles`
--
ALTER TABLE `studentprofiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentsubjects`
--
ALTER TABLE `studentsubjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `uploadlists`
--
ALTER TABLE `uploadlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `departments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `semesters`
--
ALTER TABLE `semesters`
  ADD CONSTRAINT `semesters_academicyear_id_foreign` FOREIGN KEY (`academicyear_id`) REFERENCES `academicyears` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
