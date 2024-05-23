-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 01:06 PM
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
(9, 2024, '2024-04-28', '2024-06-28', 'April', 'GENERIC - INTAKE', 1, 1, '2024-04-29 15:53:14', '2024-04-29 15:53:14');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `academicyear`, `uploadlist_id`, `fname`, `lname`, `gender`, `class`, `entry_level`, `campus`, `email`, `processed`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 'Elvis', 'Jack', 'F', 'CCM1', 'Basic', 'Lilongwe', 'student1@gmail.com', '0', '2024-05-22 10:11:05', '2024-05-22 10:11:05'),
(2, 9, 1, 'Fatsi', 'Malembo', 'F', 'CCM1', 'Basic', 'Lilongwe', 'student2@gmail.com', '0', '2024-05-22 10:11:05', '2024-05-22 10:11:05'),
(3, 9, 1, 'Lazarus', 'Kaira', 'M', 'CCM1', 'Basic', 'Lilongwe', 'student3@gmail.com', '0', '2024-05-22 10:11:05', '2024-05-22 10:11:05'),
(4, 9, 1, 'Mary', 'Banda', 'F', 'CCM1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-05-22 10:11:05', '2024-05-22 10:11:05'),
(5, 9, 2, 'Mebble', 'Linda', 'F', 'CCM1', 'Basic', 'Blantyre', 'student1@gmail.com', '0', '2024-05-22 10:17:05', '2024-05-22 10:17:05'),
(6, 9, 2, 'Harris', 'Mambo', 'F', 'CCM1', 'Basic', 'Blantyre', 'student2@gmail.com', '0', '2024-05-22 10:17:05', '2024-05-22 10:17:05'),
(7, 9, 2, 'Frank', 'Zulu', 'M', 'CCM1', 'Basic', 'Blantyre', 'student3@gmail.com', '0', '2024-05-22 10:17:05', '2024-05-22 10:17:05'),
(8, 9, 2, 'Elisa', 'Banda', 'F', 'CCM1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-05-22 10:17:05', '2024-05-22 10:17:05'),
(9, 9, 3, 'Malita', 'Mmanga', 'F', 'CPH1', 'Basic', 'Zomba', 'student1@gmail.com', '0', '2024-05-22 10:18:28', '2024-05-22 10:18:28'),
(10, 9, 3, 'Eve', 'Migo', 'F', 'CPH1', 'Basic', 'Zomba', 'student2@gmail.com', '0', '2024-05-22 10:18:28', '2024-05-22 10:18:28'),
(11, 9, 3, 'Mike', 'Jaji', 'M', 'CPH1', 'Basic', 'Zomba', 'student3@gmail.com', '0', '2024-05-22 10:18:28', '2024-05-22 10:18:28'),
(12, 9, 3, 'Seve', 'Mwale', 'F', 'CPH1', 'Basic', 'Zomba', 'student4@gmail.com', '0', '2024-05-22 10:18:28', '2024-05-22 10:18:28'),
(13, 9, 4, 'Mefa', 'Ponda', 'F', 'CPH1', 'Basic', 'Lilongwe', 'student1@gmail.com', '0', '2024-05-22 10:19:51', '2024-05-22 10:19:51'),
(14, 9, 4, 'Alice', 'Meja', 'F', 'CPH1', 'Basic', 'Lilongwe', 'student2@gmail.com', '0', '2024-05-22 10:19:51', '2024-05-22 10:19:51'),
(15, 9, 4, 'Alufeyo', 'Banda', 'M', 'CPH1', 'Basic', 'Lilongwe', 'student3@gmail.com', '0', '2024-05-22 10:19:51', '2024-05-22 10:19:51'),
(16, 9, 4, 'Zebo', 'Bandawe', 'F', 'CPH1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-05-22 10:19:51', '2024-05-22 10:19:51'),
(17, 9, 5, 'Vitu', 'Mwawa', 'F', 'DCA1', 'Basic', 'Lilongwe', 'student1@gmail.com', '0', '2024-05-22 10:21:01', '2024-05-22 10:21:01'),
(18, 9, 5, 'Sally', 'Benson', 'F', 'DCA1', 'Basic', 'Lilongwe', 'student2@gmail.com', '0', '2024-05-22 10:21:01', '2024-05-22 10:21:01'),
(19, 9, 5, 'Annie', 'Gondwe', 'M', 'DCA1', 'Basic', 'Lilongwe', 'student3@gmail.com', '0', '2024-05-22 10:21:01', '2024-05-22 10:21:01'),
(20, 9, 5, 'Nomsy', 'Michael', 'F', 'DCA1', 'Basic', 'Lilongwe', 'student4@gmail.com', '0', '2024-05-22 10:21:01', '2024-05-22 10:21:01'),
(21, 9, 6, 'Kalabo', 'Zimba', 'F', 'DCA1', 'Basic', 'Blantyre', 'student1@gmail.com', '0', '2024-05-22 10:26:35', '2024-05-22 10:26:35'),
(22, 9, 6, 'Mike', 'Chilewani', 'F', 'DCA1', 'Basic', 'Blantyre', 'student2@gmail.com', '0', '2024-05-22 10:26:35', '2024-05-22 10:26:35'),
(23, 9, 6, 'Zex', 'Amadu', 'M', 'DCA1', 'Basic', 'Blantyre', 'student3@gmail.com', '0', '2024-05-22 10:26:35', '2024-05-22 10:26:35'),
(24, 9, 6, 'Nancy', 'Sembo', 'F', 'DCA1', 'Basic', 'Blantyre', 'student4@gmail.com', '0', '2024-05-22 10:26:35', '2024-05-22 10:26:35');

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
(21, 'DCA1105', 35, 'Practical anaesthesia', 1, 1, '2024-05-22 06:09:36', '2024-05-22 06:09:36');

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
  `classid` tinyint(4) NOT NULL,
  `courseid` tinyint(4) NOT NULL,
  `userid` tinyint(4) NOT NULL,
  `coordinator` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(49, '2024_05_21_151154_add_campus_id_to_studentsubjects', 36);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `campus_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `myclasssubjects`
--

INSERT INTO `myclasssubjects` (`id`, `programclass_id`, `classcode`, `semester`, `course_id`, `ca_weight`, `exam_weight`, `pass_mark`, `is_project`, `is_major`, `category`, `created_at`, `updated_at`, `campus_id`) VALUES
(1, 3, 'CCM1', 1, 5, 40, 60, 50, '2', '2', '1', '2024-05-22 10:47:38', '2024-05-22 10:47:38', 2),
(2, 3, 'CCM1', 1, 6, 40, 60, 50, '2', '2', '1', '2024-05-22 11:08:01', '2024-05-22 11:08:01', 2),
(3, 5, 'CCM1', 1, 7, 40, 60, 50, '2', '2', '1', '2024-05-22 11:09:31', '2024-05-22 11:09:31', 1),
(4, 5, 'CCM1', 1, 8, 40, 60, 50, '2', '2', '1', '2024-05-22 11:10:30', '2024-05-22 11:10:30', 1),
(5, 5, 'CCM1', 1, 9, 40, 60, 50, '2', '2', '1', '2024-05-22 11:11:28', '2024-05-22 11:11:28', 1),
(6, 5, 'CCM1', 1, 10, 40, 60, 50, '2', '2', '1', '2024-05-22 11:12:35', '2024-05-22 11:12:35', 1),
(7, 8, 'CPH1', 1, 1, 40, 60, 50, '2', '2', '1', '2024-05-22 11:15:07', '2024-05-22 11:15:07', 3),
(8, 8, 'CPH1', 1, 2, 40, 60, 50, '2', '2', '1', '2024-05-22 11:20:28', '2024-05-22 11:20:28', 3),
(9, 8, 'CPH1', 1, 3, 40, 60, 50, '2', '2', '1', '2024-05-22 11:21:08', '2024-05-22 11:21:08', 3),
(10, 8, 'CPH1', 1, 4, 40, 60, 50, '2', '2', '1', '2024-05-22 11:21:59', '2024-05-22 11:21:59', 3),
(11, 7, 'CPH1', 1, 4, 40, 60, 50, '2', '2', '1', '2024-05-22 11:23:11', '2024-05-22 11:23:11', 1),
(12, 7, 'CPH1', 1, 1, 40, 60, 50, '2', '2', '1', '2024-05-22 11:25:00', '2024-05-22 11:25:00', 1),
(13, 11, 'DCA1', 1, 17, 40, 60, 50, '2', '2', '1', '2024-05-22 11:27:09', '2024-05-22 11:27:09', 2),
(14, 11, 'DCA1', 1, 18, 40, 60, 50, '2', '2', '1', '2024-05-22 11:27:51', '2024-05-22 11:27:51', 2),
(15, 11, 'DCA1', 1, 19, 40, 60, 50, '2', '2', '1', '2024-05-22 11:28:52', '2024-05-22 11:28:52', 2),
(16, 9, 'DCA1', 1, 21, 40, 60, 50, '2', '2', '1', '2024-05-22 11:33:24', '2024-05-22 11:33:24', 1),
(17, 9, 'DCA1', 1, 20, 40, 60, 50, '2', '2', '1', '2024-05-22 11:34:16', '2024-05-22 11:34:16', 1),
(18, 9, 'DCA1', 1, 19, 40, 60, 50, '2', '2', '1', '2024-05-22 11:35:34', '2024-05-22 11:35:34', 1),
(19, 9, 'DCA1', 1, 18, 40, 60, 50, '2', '2', '1', '2024-05-22 11:36:35', '2024-05-22 11:36:35', 1);

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

--
-- Dumping data for table `myclasssubject_user`
--

INSERT INTO `myclasssubject_user` (`id`, `myclasssubject_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 16, 159, NULL, NULL),
(2, 17, 159, NULL, NULL),
(3, 18, 159, NULL, NULL),
(4, 19, 159, NULL, NULL),
(5, 16, 160, NULL, NULL),
(6, 17, 160, NULL, NULL),
(7, 18, 160, NULL, NULL),
(8, 19, 160, NULL, NULL),
(9, 16, 161, NULL, NULL),
(10, 17, 161, NULL, NULL),
(11, 18, 161, NULL, NULL),
(12, 19, 161, NULL, NULL),
(13, 16, 162, NULL, NULL),
(14, 17, 162, NULL, NULL),
(15, 18, 162, NULL, NULL),
(16, 19, 162, NULL, NULL),
(17, 16, 168, NULL, NULL),
(18, 17, 168, NULL, NULL),
(19, 18, 168, NULL, NULL),
(20, 19, 168, NULL, NULL);

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
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `under_basic` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programclasses`
--

INSERT INTO `programclasses` (`id`, `classcode`, `classname`, `classyear`, `feecategory_id`, `program_id`, `created_at`, `updated_at`, `coordinator`, `campus_id`, `under_basic`) VALUES
(1, 'DR1', 'Diploma in Radiography 1', 1, 1, 4, '2024-04-28 11:10:05', '2024-04-28 11:10:05', 34, 1, 1),
(2, 'DR2', 'Diploma in Radiography 2', 2, 1, 4, '2024-04-28 11:24:31', '2024-04-28 11:24:31', 34, 1, 1),
(3, 'CCM1', 'Certificate in Clinical Medicine 1', 1, 1, 2, '2024-04-28 11:30:44', '2024-04-28 11:30:44', 38, 2, 0),
(4, 'CCM2', 'Certificate in Clinical Medicine 2', 2, 1, 2, '2024-04-28 11:31:10', '2024-04-28 11:31:10', 39, 2, 0),
(5, 'CCM1', 'Certificate in Clinical Medicine 1', 1, 1, 1, '2024-04-28 11:34:18', '2024-04-28 11:34:18', 33, 1, 0),
(6, 'CCM2', 'Certificate in Clinical Medicine 2', 2, 1, 1, '2024-04-28 11:34:49', '2024-04-28 11:34:49', 38, 1, 0),
(7, 'CPH1', 'Certificate in Pharmacy 1', 1, 1, 7, '2024-04-30 17:40:50', '2024-04-30 17:40:50', 36, 1, 0),
(8, 'CPH1', 'Certificate in Pharmacy 1', 1, 1, 6, '2024-04-30 17:41:37', '2024-04-30 17:41:37', 37, 3, 0),
(9, 'DCA1', 'Diploma in Clinical Anesthesia', 1, 1, 9, '2024-05-02 19:13:38', '2024-05-02 19:13:38', 43, 1, 0),
(10, 'DCA2', 'Certificate in Clinical Anesthesia 2', 2, 1, 9, '2024-05-02 19:14:26', '2024-05-02 19:14:26', 40, 1, 0),
(11, 'DCA1', 'Diploma in Clinical Anesthesia 1', 1, 1, 10, '2024-05-02 19:15:57', '2024-05-02 19:15:57', 2, 2, 0),
(12, 'DCA2', 'Diploma in Clinical Anesthesia 2', 2, 1, 10, '2024-05-02 19:16:26', '2024-05-02 19:16:26', 5, 2, 0),
(13, 'CCH1', 'Certificate in Community Health', 1, 1, 8, '2024-05-04 06:01:19', '2024-05-04 06:01:19', 2, 1, 0),
(14, 'CCH1', 'Certificate in Community Health', 1, 2, 8, '2024-05-04 06:36:24', '2024-05-04 06:36:24', 8, 3, 0),
(15, 'DCM1', 'Diploma in Clinical Medicine', 1, 1, 8, '2024-05-04 06:40:03', '2024-05-04 06:40:03', 31, 1, 1),
(16, 'DCM1', 'Certificate in Clinical Medicine 1', 1, 1, 8, '2024-05-04 06:40:31', '2024-05-04 06:40:31', 38, 2, 1),
(17, 'NMT1', 'Diploma in Nursing and Midwifery Technician', 1, 1, 5, '2024-05-05 15:24:56', '2024-05-05 15:24:56', 6, 3, 1);

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
(3, NULL, 'DCM', 'Diploma in Clinical Medicine', 48, 'Basic', 31, 24, 1, 'diploma', '2024-04-28 07:54:39', '2024-04-28 07:54:39'),
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
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(6, 7, 4, '2024-04-07', '2024-04-10', '2024-04-07', '2024-04-21', 1, '2024-04-06 07:42:19', '2024-04-06 07:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academicyear_id` bigint(20) UNSIGNED NOT NULL,
  `uploadlist_id` smallint(4) NOT NULL,
  `programclass` varchar(20) DEFAULT NULL,
  `reg_no` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `entry_level` varchar(255) NOT NULL,
  `campus` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `assessment1` int(11) NOT NULL DEFAULT 0,
  `assessment2` int(11) NOT NULL DEFAULT 0,
  `exam_grade` int(11) NOT NULL DEFAULT 0,
  `final_grade` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `campus_id` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentsubjects`
--

INSERT INTO `studentsubjects` (`id`, `academicyr_id`, `programclass_id`, `semester`, `registration_no`, `course_code`, `assessment1`, `assessment2`, `exam_grade`, `final_grade`, `created_at`, `updated_at`, `campus_id`) VALUES
(1, 9, 9, 1, 'DCA/LL/2024/4/01', 'DCA1105', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(2, 9, 9, 1, 'DCA/LL/2024/4/01', 'DCA1104', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(3, 9, 9, 1, 'DCA/LL/2024/4/01', 'DCA1103', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(4, 9, 9, 1, 'DCA/LL/2024/4/01', 'DCA1102', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(5, 9, 9, 1, 'DCA/LL/2024/4/02', 'DCA1105', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(6, 9, 9, 1, 'DCA/LL/2024/4/02', 'DCA1104', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(7, 9, 9, 1, 'DCA/LL/2024/4/02', 'DCA1103', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(8, 9, 9, 1, 'DCA/LL/2024/4/02', 'DCA1102', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(9, 9, 9, 1, 'DCA/LL/2024/4/03', 'DCA1105', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(10, 9, 9, 1, 'DCA/LL/2024/4/03', 'DCA1104', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(11, 9, 9, 1, 'DCA/LL/2024/4/03', 'DCA1103', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(12, 9, 9, 1, 'DCA/LL/2024/4/03', 'DCA1102', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(13, 9, 9, 1, 'DCA/LL/2024/4/04', 'DCA1105', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(14, 9, 9, 1, 'DCA/LL/2024/4/04', 'DCA1104', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(15, 9, 9, 1, 'DCA/LL/2024/4/04', 'DCA1103', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(16, 9, 9, 1, 'DCA/LL/2024/4/04', 'DCA1102', 46, 50, 61, 66, '2024-05-22 12:47:10', '2024-05-22 12:47:10', 1),
(17, 9, 9, 1, 'DCA/LL/2024/4/05', 'DCA1105', 46, 50, 61, 66, '2024-05-22 12:54:35', '2024-05-22 12:54:35', 1),
(18, 9, 9, 1, 'DCA/LL/2024/4/05', 'DCA1104', 46, 50, 61, 66, '2024-05-22 12:54:35', '2024-05-22 12:54:35', 1),
(19, 9, 9, 1, 'DCA/LL/2024/4/05', 'DCA1103', 46, 50, 61, 66, '2024-05-22 12:54:35', '2024-05-22 12:54:35', 1),
(20, 9, 9, 1, 'DCA/LL/2024/4/05', 'DCA1102', 46, 50, 61, 66, '2024-05-22 12:54:35', '2024-05-22 12:54:35', 1);

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
(1, 9, '2024 CCM Lilongwe', 4, 1, '1', 1, '2024-05-22 10:11:05', '2024-05-22 10:11:46'),
(2, 9, '2024 CCM Blantyre', 4, 2, '1', 1, '2024-05-22 10:17:05', '2024-05-22 10:17:15'),
(3, 9, '2024 - CPH Zomba', 4, 3, '1', 1, '2024-05-22 10:18:28', '2024-05-22 10:18:34'),
(4, 9, '2024 - CPH Lilongwe', 4, 1, '1', 1, '2024-05-22 10:19:51', '2024-05-22 10:19:58'),
(5, 9, '2024 - DCA Lilongwe', 4, 1, '1', 1, '2024-05-22 10:21:01', '2024-05-22 10:21:07'),
(6, 9, '2024 - DCA Blantyre', 4, 2, '1', 1, '2024-05-22 10:26:35', '2024-05-22 10:26:42');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `department_id`, `academicyear_id`, `uploadlist_id`, `programclass`, `lname`, `reg_num`, `phone`, `gender`, `role`, `semester`, `registered`, `exam_number`, `entry_level`, `campus`, `email`, `country`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Andy', NULL, NULL, NULL, NULL, 'Chigalu', '', NULL, NULL, 'admin', NULL, 0, 0, NULL, NULL, 'andy.chigalu@gmail.com', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, '2024-02-27 04:53:36', '2024-02-27 04:53:36'),
(2, 'Tahla', NULL, NULL, NULL, NULL, 'Mwale', NULL, NULL, 'F', NULL, NULL, 0, 0, NULL, NULL, 'tmwale@gmail.com', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL),
(5, 'Charity', NULL, NULL, NULL, NULL, 'Sinkala', NULL, NULL, 'F', NULL, NULL, 0, 0, NULL, NULL, 'charity@gmail.com', NULL, NULL, '$2y$12$Icpl36FqdDQ5sSb7tnmI/.dq4usOUeWuhJYiPv56EJCrsI7EOnxlq', NULL, NULL, NULL),
(6, 'Joyce', NULL, NULL, NULL, NULL, 'Malota', NULL, NULL, 'F', NULL, NULL, 0, 0, NULL, NULL, 'joyce@gmail.com', NULL, NULL, 'password', NULL, NULL, NULL),
(7, 'Symon', NULL, NULL, NULL, NULL, 'Nyondo', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'symon@gmail.com', NULL, NULL, 'password', NULL, NULL, NULL),
(8, 'Esther', NULL, NULL, NULL, NULL, 'Kaunda', NULL, NULL, 'F', NULL, NULL, 0, 0, NULL, NULL, 'esther@gmail.com', NULL, NULL, 'password', NULL, NULL, NULL),
(31, 'Wicliff', NULL, NULL, NULL, NULL, 'Kaputalambwe', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'wkaputalambwe@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(33, 'Joseph', NULL, NULL, NULL, NULL, 'January', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'jjanuary@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(34, 'Eva', NULL, NULL, NULL, NULL, 'Nthete', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'enthete@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(35, 'Doubt', NULL, NULL, NULL, NULL, 'Kajilime', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'dkajilime@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(36, 'Ginjer', NULL, NULL, NULL, NULL, 'Mtonga', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'jmtonga@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(37, 'King', NULL, NULL, NULL, NULL, 'Bwaila', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'kbwaila@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(38, 'Petros', NULL, NULL, NULL, NULL, 'Muonjeza', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 'pmuonjeza@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(39, 'Frank', NULL, NULL, NULL, NULL, 'Mpotha', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 'fmpotha@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(40, 'Joviter', NULL, NULL, NULL, NULL, 'Mwaulemu', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 'jmwaulemu@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(41, 'Ibrahim', NULL, NULL, NULL, NULL, 'Gama', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'igama@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(42, 'Chris', NULL, NULL, NULL, NULL, 'Chimzimu', NULL, NULL, 'M', NULL, NULL, 0, 0, NULL, NULL, 'cchinzimu@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(43, 'Jimmy', NULL, NULL, NULL, NULL, 'Mwakhanzi', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 'jmwakhanzi@mchs.mw', NULL, NULL, 'password', NULL, NULL, NULL),
(143, 'Mary', NULL, 9, 1, 'CCM1', 'Banda', 'CCM/LL/2024/4/01', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'ccmll2024401@mchs.mw', NULL, NULL, '$2y$12$8vcPLgMN975q4P8pXdIl5Op5LweKemD38ICy/KAMBXOVN5BdoojmG', NULL, '2024-05-22 10:11:45', '2024-05-22 10:11:45'),
(144, 'Elvis', NULL, 9, 1, 'CCM1', 'Jack', 'CCM/LL/2024/4/02', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'ccmll2024402@mchs.mw', NULL, NULL, '$2y$12$3O9HPTSdONRo/WTR1I..lOj6dDLrazY/LZ2vzHeMnrn5zHLFqFBBS', NULL, '2024-05-22 10:11:45', '2024-05-22 10:11:45'),
(145, 'Lazarus', NULL, 9, 1, 'CCM1', 'Kaira', 'CCM/LL/2024/4/03', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'ccmll2024403@mchs.mw', NULL, NULL, '$2y$12$G00M2HiSQKRAacKD1jipVO9JGtHkQVlhzfZtbdgTOuGz.S5VGrWXy', NULL, '2024-05-22 10:11:46', '2024-05-22 10:11:46'),
(146, 'Fatsi', NULL, 9, 1, 'CCM1', 'Malembo', 'CCM/LL/2024/4/04', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'ccmll2024404@mchs.mw', NULL, NULL, '$2y$12$rJ.W6kmVFc22TxrMys/w9OEOLifmSlb3JRc8ka89VydreLTS8KHV.', NULL, '2024-05-22 10:11:46', '2024-05-22 10:11:46'),
(147, 'Elisa', NULL, 9, 2, 'CCM1', 'Banda', 'CCM/BT/2024/4/01', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'ccmbt2024401@mchs.mw', NULL, NULL, '$2y$12$5DORx9G3lF9aFGkReQm2TOU50XnB0fhIqVGRvYuKma1V3THJSoQN2', NULL, '2024-05-22 10:17:14', '2024-05-22 10:17:14'),
(148, 'Mebble', NULL, 9, 2, 'CCM1', 'Linda', 'CCM/BT/2024/4/02', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'ccmbt2024402@mchs.mw', NULL, NULL, '$2y$12$pgMIEiwZ9QmUrMpUUgt/Dux5jaSVWyRp5YFDkf8mYVWvjzBs.HnFW', NULL, '2024-05-22 10:17:14', '2024-05-22 10:17:14'),
(149, 'Harris', NULL, 9, 2, 'CCM1', 'Mambo', 'CCM/BT/2024/4/03', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'ccmbt2024403@mchs.mw', NULL, NULL, '$2y$12$RYSJgk6ZM66ocWyiGGSJk.kH63l0fGLxOA6KTBTzBNiHPRfCLnIlq', NULL, '2024-05-22 10:17:15', '2024-05-22 10:17:15'),
(150, 'Frank', NULL, 9, 2, 'CCM1', 'Zulu', 'CCM/BT/2024/4/04', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'ccmbt2024404@mchs.mw', NULL, NULL, '$2y$12$Q2sofC2hZXOWFq8FVjauHen2MREVzmxiK1/.EE1axW63AdrUFt8nO', NULL, '2024-05-22 10:17:15', '2024-05-22 10:17:15'),
(151, 'Mike', NULL, 9, 3, 'CPH1', 'Jaji', 'CPH/ZA/2024/4/01', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Zomba', 'cphza2024401@mchs.mw', NULL, NULL, '$2y$12$v7Cvi/T069PbbrXyH0xP6utxRuue6/JK60/Z5eI7Zz1.54wwNJD.y', NULL, '2024-05-22 10:18:33', '2024-05-22 10:18:33'),
(152, 'Eve', NULL, 9, 3, 'CPH1', 'Migo', 'CPH/ZA/2024/4/02', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Zomba', 'cphza2024402@mchs.mw', NULL, NULL, '$2y$12$qvoFeu7vBJKILK3/yRoHj.teVpXdVaEdW7yKlhgLleNATlIIJIBti', NULL, '2024-05-22 10:18:34', '2024-05-22 10:18:34'),
(153, 'Malita', NULL, 9, 3, 'CPH1', 'Mmanga', 'CPH/ZA/2024/4/03', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Zomba', 'cphza2024403@mchs.mw', NULL, NULL, '$2y$12$I3KCjxPaouNhNg4M1kvgxOpJ2vpuZwGjlXuRYh6M5jB2c3UWeSFSW', NULL, '2024-05-22 10:18:34', '2024-05-22 10:18:34'),
(154, 'Seve', NULL, 9, 3, 'CPH1', 'Mwale', 'CPH/ZA/2024/4/04', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Zomba', 'cphza2024404@mchs.mw', NULL, NULL, '$2y$12$HlqFnkkg8bwdJugGDCzAbujXTDYshhX3Hrx2fx.5Gaou.o.pvm2pm', NULL, '2024-05-22 10:18:34', '2024-05-22 10:18:34'),
(155, 'Alufeyo', NULL, 9, 4, 'CPH1', 'Banda', 'CPH/LL/2024/4/01', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'cphll2024401@mchs.mw', NULL, NULL, '$2y$12$1j5st307Vt2rOYpvznYbK.1mzXiJt1TYeO8g8zSffOpGqu6TK8uE.', NULL, '2024-05-22 10:19:57', '2024-05-22 10:19:57'),
(156, 'Zebo', NULL, 9, 4, 'CPH1', 'Bandawe', 'CPH/LL/2024/4/02', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'cphll2024402@mchs.mw', NULL, NULL, '$2y$12$Ar8BbDxA3Fotl6gZ4Fywcu78uHRKNOvVwLg2y2l0eByGn0XFVjnH2', NULL, '2024-05-22 10:19:58', '2024-05-22 10:19:58'),
(157, 'Alice', NULL, 9, 4, 'CPH1', 'Meja', 'CPH/LL/2024/4/03', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'cphll2024403@mchs.mw', NULL, NULL, '$2y$12$qTwUYcw63ZhctLXoG0YT9e4V8728ZCWJxXmqfOJgLGCPctvMCf2bW', NULL, '2024-05-22 10:19:58', '2024-05-22 10:19:58'),
(158, 'Mefa', NULL, 9, 4, 'CPH1', 'Ponda', 'CPH/LL/2024/4/04', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'cphll2024404@mchs.mw', NULL, NULL, '$2y$12$VasG5mqJSDoRkdvshETyXudtdgZ3Vm/WVtFjqizGcsHpMHZCZ87mS', NULL, '2024-05-22 10:19:58', '2024-05-22 10:19:58'),
(159, 'Sally', NULL, 9, 5, 'DCA1', 'Benson', 'DCA/LL/2024/4/01', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcall2024401@mchs.mw', NULL, NULL, '$2y$12$Dp2Lr/JdK8pjZjJ7D0tXke7AVNbVxv4chOWHgqtqR2FL/M2bjuohu', NULL, '2024-05-22 10:21:06', '2024-05-22 10:21:06'),
(160, 'Annie', NULL, 9, 5, 'DCA1', 'Gondwe', 'DCA/LL/2024/4/02', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcall2024402@mchs.mw', NULL, NULL, '$2y$12$F57B4cKrVN2U.BdqY8KG/.U9Xj8Ba3kJj/GTftbyiFfsxfy4W7qFy', NULL, '2024-05-22 10:21:06', '2024-05-22 10:21:06'),
(161, 'Nomsy', NULL, 9, 5, 'DCA1', 'Michael', 'DCA/LL/2024/4/03', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcall2024403@mchs.mw', NULL, NULL, '$2y$12$yaEwD.OppiS14Dtr5xBOteJ9UuqQBEMVgTNpUU2z85lNV.b9/CbLy', NULL, '2024-05-22 10:21:07', '2024-05-22 10:21:07'),
(162, 'Vitu', NULL, 9, 5, 'DCA1', 'Mwawa', 'DCA/LL/2024/4/04', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Lilongwe', 'dcall2024404@mchs.mw', NULL, NULL, '$2y$12$EGuiktosqwQ7IQerl2xZc.m/W/WO0orKQTopLPcHLGC.rFdj9XhlW', NULL, '2024-05-22 10:21:07', '2024-05-22 10:21:07'),
(163, 'Zex', NULL, 9, 6, 'DCA1', 'Amadu', 'DCA/BT/2024/4/01', NULL, 'M', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcabt2024401@mchs.mw', NULL, NULL, '$2y$12$nFvYh.5vPya0w39A2jwYd.jjSnoqARxrFjwpHTHI502Wg4kEZERnC', NULL, '2024-05-22 10:26:41', '2024-05-22 10:26:41'),
(164, 'Mike', NULL, 9, 6, 'DCA1', 'Chilewani', 'DCA/BT/2024/4/02', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcabt2024402@mchs.mw', NULL, NULL, '$2y$12$rM4NfCk0L9YoxyJXGN26u.a8wfWON7ekkWp5M0vZgXpebAYdalTie', NULL, '2024-05-22 10:26:42', '2024-05-22 10:26:42'),
(165, 'Nancy', NULL, 9, 6, 'DCA1', 'Sembo', 'DCA/BT/2024/4/03', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcabt2024403@mchs.mw', NULL, NULL, '$2y$12$FY5cd.tLNpL2VotUi44ZVuTTSrAsmcJIf6OtdwsLjqtJse6wIQVyG', NULL, '2024-05-22 10:26:42', '2024-05-22 10:26:42'),
(166, 'Kalabo', NULL, 9, 6, 'DCA1', 'Zimba', 'DCA/BT/2024/4/04', NULL, 'F', 'student', 1, 0, 0, 'Basic', 'Blantyre', 'dcabt2024404@mchs.mw', NULL, NULL, '$2y$12$ACX1uxKfgZSE3TXPVhribOWqEWFhWrv1/5zyI8NzdSAgkIsF4PP5m', NULL, '2024-05-22 10:26:42', '2024-05-22 10:26:42'),
(168, 'Manasse', NULL, 9, 6, 'DCA1', 'Ngwira', 'DCA/LL/2024/4/05', '0000000000', 'M', 'student', 1, 0, 0, 'basic', 'Lilongwe', 'DCALL2024405@mchs.mw', NULL, NULL, '$2y$12$Q2sofC2hZXOWFq8FVjauHen2MREVzmxiK1/.EE1axW63AdrUFt8nO', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicyears`
--
ALTER TABLE `academicyears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `myclasssubjects`
--
ALTER TABLE `myclasssubjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `myclasssubject_user`
--
ALTER TABLE `myclasssubject_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programclasses`
--
ALTER TABLE `programclasses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentsubjects`
--
ALTER TABLE `studentsubjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `uploadlists`
--
ALTER TABLE `uploadlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

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
