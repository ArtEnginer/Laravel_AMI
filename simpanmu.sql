-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 06, 2023 at 02:19 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpanmu`
--

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `audit_plan_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_plans`
--

CREATE TABLE `audit_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faculty_id` bigint(20) UNSIGNED NOT NULL,
  `study_program_id` bigint(20) UNSIGNED NOT NULL,
  `lead_auditor_id` bigint(20) UNSIGNED NOT NULL,
  `auditor_1_id` bigint(20) UNSIGNED DEFAULT NULL,
  `auditor_2_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('proses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `tahun` year(4) NOT NULL,
  `tanggal_rtm` date DEFAULT NULL,
  `kesimpulan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_plans`
--

INSERT INTO `audit_plans` (`id`, `faculty_id`, `study_program_id`, `lead_auditor_id`, `auditor_1_id`, `auditor_2_id`, `status`, `tahun`, `tanggal_rtm`, `kesimpulan`, `foto_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 7, 7, 7, 'selesai', 2023, NULL, NULL, NULL, '2023-08-02 07:49:16', '2023-08-02 07:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `buktis`
--

CREATE TABLE `buktis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `standard_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buktis`
--

INSERT INTO `buktis` (`id`, `standard_id`, `value`, `created_at`, `updated_at`) VALUES
(3, 1, 'http://localhost:8888/phpMyAdmin5/index.php?route=/sql&pos=0&db=simpanmu&table=buktis', '2023-08-04 06:14:30', '2023-08-04 06:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dekan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nidn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `dekan`, `nidn`, `telp`, `created_at`, `updated_at`) VALUES
(1, 'Fakultas 01', 'Dekan 01', '010000000001', '082028192301', '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(2, 'Fakultas 02', 'Dekan 02', '010000000002', '082028192302', '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(3, 'Fakultas 03', 'Dekan 03', '010000000003', '082028192303', '2023-07-29 23:08:39', '2023-07-29 23:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_02_28_153708_add_role_column_to_users_table', 1),
(7, '2023_03_01_143235_add_username_column_to_users_table', 1),
(8, '2023_03_04_145846_add_avatar_column_to_users_table', 1),
(9, '2023_07_07_021943_create_faculties_table', 1),
(10, '2023_07_08_033257_create_standards_table', 1),
(11, '2023_07_08_033656_create_questions_table', 1),
(12, '2023_07_08_062247_create_audit_plans_table', 1),
(13, '2023_07_09_135425_create_values_table', 1),
(14, '2023_07_12_075058_create_audits_table', 1),
(15, '2023_08_04_123900_create_buktis_table', 2),
(16, '2023_08_04_154850_create_rekomendasis_table', 3),
(17, '2023_08_05_085145_add_tahun_to_audit_plans', 4),
(18, '2023_08_05_091008_create_tahuns_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `standard_id` bigint(20) UNSIGNED NOT NULL,
  `questionText` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `standard_id`, `questionText`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>ASX</p>', '2023-07-29 23:16:04', '2023-07-29 23:16:04'),
(2, 1, '<p>vv</p>', '2023-08-03 21:51:39', '2023-08-03 21:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasis`
--

CREATE TABLE `rekomendasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `standard_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekomendasis`
--

INSERT INTO `rekomendasis` (`id`, `standard_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rekomendasi 1s', '2023-08-04 20:48:09', '2023-08-04 20:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`id`, `name`, `desc`, `value`, `created_at`, `updated_at`) VALUES
(1, 'X', 'A', 'SSSS', '2023-07-29 23:15:50', '2023-07-29 23:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `tahuns`
--

CREATE TABLE `tahuns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahuns`
--

INSERT INTO `tahuns` (`id`, `value`, `created_at`, `updated_at`) VALUES
(1, '2023', '2023-08-05 02:19:28', '2023-08-05 02:21:32'),
(2, '2024', '2023-08-05 02:21:37', '2023-08-05 02:21:37'),
(3, '2025', '2023-08-05 02:21:41', '2023-08-05 02:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','auditor','prodi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kaprodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` bigint(20) UNSIGNED DEFAULT NULL,
  `study_program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `role`, `email_verified_at`, `password`, `avatar`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `nidn`, `kaprodi`, `faculty_id`, `study_program_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 'admin', '2023-07-29 23:08:39', '$2y$10$Q5XtG95Jj9YSTmHBEbQI/essBtQo3s88.liX2teNcWT22J0ruZaci', NULL, NULL, NULL, NULL, 'iOs1aYLUXEVUztA1gcuP1kEm7M9bZNUBAkeGIaBtg5Eldabipzi57lv92YKI', NULL, NULL, NULL, NULL, '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(2, 'Admin 01', 'admin01@gmail.com', 'admin01', 'admin', '2023-07-29 23:08:39', '$2y$10$gYFeivtjxvJsKp.8xJbRMerqFIoB5v8T3SBqMO6fQpD9ahSm7.1RC', NULL, NULL, NULL, NULL, 'DZhfR2bxO7ovVDFBZeWwP187xDZd9CtrzwSK0JC9Up3h9phgr99rTRIk3s8r', '000000000001', NULL, NULL, NULL, '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(3, 'Admin 02', 'admin02@gmail.com', 'admin02', 'admin', '2023-07-29 23:08:39', '$2y$10$.aR/Bg3gESRlIjZLSQiBS.DQG2H/Jlex6d9RDhGS6gb1uY5zvIHdG', NULL, NULL, NULL, NULL, 'yy5qRSxuqo', '000000000002', NULL, NULL, NULL, '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(4, 'Prodi 01', 'prodi01@gmail.com', 'prodi01', 'prodi', '2023-07-29 23:08:39', '$2y$10$F7srL9EfX5kn8SNcr.bk8OwXHuLRM/6e18Q7gpEtBTaxTu.jKXXry', NULL, NULL, NULL, NULL, '2mXWuXc1XuWu5YpALr4fMxbvixTUixRf2JnVcoodz7oWHTcWc6EniBx5xuAh', '200000000001', 'Kaprodi 01', NULL, NULL, '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(5, 'Prodi 02', 'prodi02@gmail.com', 'prodi02', 'prodi', '2023-07-29 23:08:39', '$2y$10$s3EcpqEc.4wjypFyDr13oeFOeh8G/PEcORkXr7g7ICTNJ3g9Y1TEu', NULL, NULL, NULL, NULL, '2Dg3Gf85Vo', '200000000002', 'Kaprodi 02', NULL, NULL, '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(6, 'Prodi 03', 'prodi03@gmail.com', 'prodi03', 'prodi', '2023-07-29 23:08:39', '$2y$10$70UR2LuiB5yDWNfexydqTeBrEzVXOrut1iZjT9kLhY69txS8AzuIa', NULL, NULL, NULL, NULL, 'cWRoGBmXDS', '200000000003', 'Kaprodi 03', NULL, NULL, '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(7, 'Auditor 01', 'auditor01@gmail.com', 'auditor01', 'auditor', '2023-07-29 23:08:39', '$2y$10$zn62xmNTePdjiJ94x5qpi.BBAm5L3Qxf42LB57S/DfcM/j/6aqnpK', NULL, NULL, NULL, NULL, '8OGR5rYApuer8ByekYIZPvKChBJRKuVADl3aegUM6E1WtsykJZTW6kaiSLFB', '300000000001', NULL, 1, 4, '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(8, 'Auditor 02', 'auditor02@gmail.com', 'auditor02', 'auditor', '2023-07-29 23:08:39', '$2y$10$.1V7s8NgsbbTARNJiXyIqumEB/S.7hotsf/UGVTTLI5UGbUYJTtJi', NULL, NULL, NULL, NULL, '0umWv9S8BX', '300000000002', NULL, 2, 5, '2023-07-29 23:08:39', '2023-07-29 23:08:39'),
(9, 'Auditor 03', 'auditor03@gmail.com', 'auditor03', 'auditor', '2023-07-29 23:08:39', '$2y$10$QtQycu5/MknqyUFCj4T4a.suaa/fMhbC5bYzoYYaW9D3nvqY0DwVq', NULL, NULL, NULL, NULL, 'rTun7ci3Rf', '300000000003', NULL, 3, 6, '2023-07-29 23:08:40', '2023-07-29 23:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

CREATE TABLE `values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `standard_id` bigint(20) UNSIGNED NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`id`, `standard_id`, `answer`, `score`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>asd</p>', '4', '2023-08-02 07:50:11', '2023-08-02 07:50:11'),
(3, 1, '<p>gg</p>', '2', '2023-08-04 07:07:27', '2023-08-04 07:07:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_plans`
--
ALTER TABLE `audit_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buktis`
--
ALTER TABLE `buktis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekomendasis`
--
ALTER TABLE `rekomendasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahuns`
--
ALTER TABLE `tahuns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `values`
--
ALTER TABLE `values`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_plans`
--
ALTER TABLE `audit_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buktis`
--
ALTER TABLE `buktis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rekomendasis`
--
ALTER TABLE `rekomendasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tahuns`
--
ALTER TABLE `tahuns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `values`
--
ALTER TABLE `values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
