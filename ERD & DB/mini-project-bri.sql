-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 03:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini-project-bri`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_user_menus`
--

CREATE TABLE `access_user_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_user_menus`
--

INSERT INTO `access_user_menus` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(5, 2, 2, NULL, NULL),
(6, 2, 3, NULL, NULL),
(7, 3, 3, NULL, NULL),
(8, 3, 4, NULL, NULL),
(9, 4, 4, NULL, NULL),
(10, 1, 4, NULL, NULL),
(11, 2, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `assistant_id` bigint(20) UNSIGNED NOT NULL,
  `code_id` bigint(20) UNSIGNED NOT NULL,
  `teaching_role` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `class_id`, `material_id`, `assistant_id`, `code_id`, `teaching_role`, `date`, `start`, `end`, `duration`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1, 'Tutor', '2024-03-11', '09:48:54', NULL, NULL, '2024-03-11 19:48:54', '2024-03-11 19:48:54'),
(2, 3, 3, 1, 2, 'Ketua', '2024-03-12', '10:06:42', '10:07:39', 0, '2024-03-11 20:06:42', '2024-03-11 20:07:39'),
(3, 4, 4, 3, 3, 'Ketua', '2024-03-12', '10:16:56', '10:17:32', 0, '2024-03-11 20:16:56', '2024-03-11 20:17:32'),
(4, 3, 3, 3, 4, 'Ketua', '2024-03-12', '10:20:50', NULL, NULL, '2024-03-11 20:20:50', '2024-03-11 20:20:50'),
(5, 3, 4, 5, 5, 'Ketua', '2024-03-13', '08:35:45', '20:32:12', 716, '2024-03-12 18:35:45', '2024-03-13 06:32:12'),
(6, 6, 6, 6, 6, 'Ketua', '2024-03-13', '21:48:37', '21:48:48', 0, '2024-03-13 07:48:37', '2024-03-13 07:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `major`, `faculty`, `level`, `created_at`, `updated_at`) VALUES
(1, '4KAXX', 'Teknik Informatika', 'Fakultsan Ilmu Komputer', 6, '2024-03-11 19:43:44', '2024-03-11 19:45:36'),
(3, '3KAXA', 'Akuntansi', 'Fakultas Ekonomi & Bisnis', 6, '2024-03-11 19:44:53', '2024-03-11 20:52:53'),
(4, '3KAXJ', 'Manajemen', 'Fakultas Ekonomi & Bisnis', 3, '2024-03-11 19:45:19', '2024-03-11 19:45:19'),
(5, '4KAXK', 'Sistem Informasi', 'Fakultsan Ilmu Komputer', 2, '2024-03-11 22:55:14', '2024-03-11 22:55:14'),
(6, '2ABBA', 'Ilmu Komunikasi', 'Fakultas Ilmu Komunikasi', 5, '2024-03-13 07:46:31', '2024-03-13 07:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id_user_get` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `code`, `user_id`, `id_user_get`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hGyMCQIl', 1, 3, 1, '2024-03-11 19:43:20', '2024-03-11 19:48:54'),
(2, '8dNeSyY4', 3, 1, 1, '2024-03-11 20:03:28', '2024-03-11 20:06:42'),
(3, 'dFQSEN5n', 1, 3, 1, '2024-03-11 20:16:10', '2024-03-11 20:16:56'),
(4, 'dR1JLfWe', 1, 3, 1, '2024-03-11 20:20:25', '2024-03-11 20:20:50'),
(5, 'vK8Xo8Mx', 1, 5, 1, '2024-03-12 18:35:17', '2024-03-12 18:35:45'),
(6, '6muKHXE4', 2, 6, 1, '2024-03-13 07:47:48', '2024-03-13 07:48:37');

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
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PROGRAMMING 1', '2024-03-11 19:45:54', '2024-03-11 19:45:59'),
(3, 'MANAJEMEN KEUANGAN', '2024-03-11 19:46:28', '2024-03-11 19:46:37'),
(4, 'AKUNTAN 1', '2024-03-11 19:48:01', '2024-03-11 19:48:01'),
(5, 'PROGRAMMING 2', '2024-03-11 22:52:10', '2024-03-11 22:52:10'),
(6, 'ILMU KOMUNIKASI', '2024-03-13 07:46:50', '2024-03-13 07:46:50');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_10_031047_create_user_roles_table', 1),
(6, '2024_03_10_031447_create_user_menus_table', 1),
(7, '2024_03_10_032117_create_classes_table', 1),
(8, '2024_03_10_032421_create_materials_table', 1),
(9, '2024_03_10_033527_add_role_id_column_to_users_table', 1),
(10, '2024_03_10_033843_create_user_submenus_table', 1),
(11, '2024_03_10_034107_add_menu_id_column_to_user_submenus_table', 1),
(12, '2024_03_10_034238_create_access_user_menus_table', 1),
(13, '2024_03_10_034737_create_codes_table', 1),
(15, '2024_03_11_030054_add_status_column_to_codes_table', 2),
(16, '2024_03_10_035202_create_attendances_table', 3),
(17, '2024_03_11_135134_add_status_attendance_column_to_users_table', 4),
(18, '2024_03_11_163851_add_icon_column_to_user_menus_table', 5),
(19, '2024_03_11_171423_add_icon_column_to_user_menus_table', 6),
(20, '2024_03_11_171602_add_short_column_to_user_submenus_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assistant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `join_date` date DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status_attendance` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `assistant_id`, `name`, `join_date`, `role_id`, `photo`, `status_attendance`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 11111111, 'Refian Eka Saputra', '2024-03-01', 1, 'default.jpg', 0, 'admin@admin.com', NULL, '$2y$10$/.Fk5E9cXtI51yEvmA.hy.k1KMl.Sy89Ydyn.cXpElX9vcCr/hR5y', NULL, NULL, '2024-03-11 20:07:39'),
(2, 11111112, 'Joko Staff', '2024-03-12', 2, 'default.jpg', 0, 'staff@staff.com', NULL, '$2y$10$bUXSOCaH9a8hkcj.QIV9L.IZDhl1KEwQ/m8taMScI9s4k0qpGOSWS', NULL, '2024-03-11 19:38:08', '2024-03-11 19:38:08'),
(3, 11111113, 'Siti PJ', '2024-03-12', 3, 'default.jpg', 0, 'pj@pj.com', NULL, '$2y$10$cm4YrdpQ3Eh407jxuHCAr.zOL5F2L3XjgM1uzh1NV3/MK5GaTTM8W', NULL, '2024-03-11 19:38:50', '2024-03-12 18:34:01'),
(5, 11111114, 'Bima Asisten', '2024-03-12', 4, 'default.jpg', 0, 'asisten@asisten.com', NULL, '$2y$10$90OZWa3V34L8fKxLvlQxCOCsPK77z51qVvZrsS3zwBBP/m4roPGwW', NULL, '2024-03-11 22:57:22', '2024-03-13 06:32:12'),
(6, 11111115, 'Jaka', '2024-03-13', 4, 'default.jpg', 0, 'jaka@staff.com', NULL, '$2y$10$/fwDN.KHuqr11TqY9F3roedXe6j3WjLS2YU0zNR.cWc2v04w2fDJ.', NULL, '2024-03-13 07:47:32', '2024-03-13 07:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_menus`
--

CREATE TABLE `user_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_menus`
--

INSERT INTO `user_menus` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(2, 'Data', 'bar-chart', NULL, NULL),
(3, 'Generator', 'cast', NULL, NULL),
(4, 'Report', 'clipboard', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Staff', NULL, NULL),
(3, 'PJ', NULL, NULL),
(4, 'Asisten', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_submenus`
--

CREATE TABLE `user_submenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `short` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_submenus`
--

INSERT INTO `user_submenus` (`id`, `menu_id`, `name`, `url`, `short`, `created_at`, `updated_at`) VALUES
(1, 2, 'Data Asisten', 'user', 'DA', NULL, NULL),
(2, 2, 'Data Kelas', 'class', 'DK', NULL, NULL),
(3, 2, 'Data Materi', 'material', 'DM', NULL, NULL),
(4, 3, 'Code Generator', 'code', 'CG', NULL, NULL),
(5, 4, 'Report', 'report', 'R', NULL, NULL),
(6, 4, 'Riwayat Absen', 'history', 'RA', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_user_menus`
--
ALTER TABLE `access_user_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_user_menus_role_id_foreign` (`role_id`),
  ADD KEY `access_user_menus_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_class_id_foreign` (`class_id`),
  ADD KEY `attendances_material_id_foreign` (`material_id`),
  ADD KEY `attendances_assistant_id_foreign` (`assistant_id`),
  ADD KEY `attendances_code_id_foreign` (`code_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codes_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_menus`
--
ALTER TABLE `user_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_submenus`
--
ALTER TABLE `user_submenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_submenus_menu_id_foreign` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_user_menus`
--
ALTER TABLE `access_user_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_menus`
--
ALTER TABLE `user_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_submenus`
--
ALTER TABLE `user_submenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_user_menus`
--
ALTER TABLE `access_user_menus`
  ADD CONSTRAINT `access_user_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `user_menus` (`id`),
  ADD CONSTRAINT `access_user_menus_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_assistant_id_foreign` FOREIGN KEY (`assistant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `attendances_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `attendances_code_id_foreign` FOREIGN KEY (`code_id`) REFERENCES `codes` (`id`),
  ADD CONSTRAINT `attendances_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`);

--
-- Constraints for table `codes`
--
ALTER TABLE `codes`
  ADD CONSTRAINT `codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

--
-- Constraints for table `user_submenus`
--
ALTER TABLE `user_submenus`
  ADD CONSTRAINT `user_submenus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `user_menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
