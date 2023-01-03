-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 05:23 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siedp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabangs`
--

CREATE TABLE `cabangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_cabang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cabangs`
--

INSERT INTO `cabangs` (`id`, `kode_cabang`, `cabang`, `Alamat`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'PDL', 'Padalarang', '', NULL, NULL, NULL),
(2, 'TGL', 'Tegal', '', NULL, NULL, NULL),
(3, 'MDO', 'Manado', '', NULL, NULL, NULL),
(4, 'MKS', 'Makassar', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_departemen` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departemen` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `kode_departemen`, `departemen`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'MKT', 'Marketing', NULL, NULL, NULL),
(2, 'PRC', 'Perencanaan', NULL, NULL, NULL),
(3, 'PRO', 'Produksi', NULL, NULL, NULL),
(4, 'GPJ', 'Gudang Produk Jadi', NULL, NULL, NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(67, '2014_10_12_000000_create_users_table', 1),
(68, '2014_10_12_100000_create_password_resets_table', 1),
(69, '2019_08_19_000000_create_failed_jobs_table', 1),
(70, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(71, '2022_11_15_134013_create_depts_table', 1),
(72, '2022_11_15_144858_create_cabang_table', 1),
(73, '2022_11_22_150816_add_depts_id_column_to_users_table', 1),
(74, '2022_11_23_125203_create_roles_table', 1),
(75, '2022_11_23_125702_add_cabang_id_column_to_users_table', 2),
(76, '2022_11_23_131206_add_level_to_users', 3),
(78, '2022_11_28_124248_create_departemens_table', 4),
(79, '2022_11_28_134724_create_departemens_table', 5),
(80, '2022_11_28_135135_add_departemen_id_column_to_user', 6),
(81, '2022_11_28_140624_create_departemens_table', 7),
(82, '2022_11_28_140903_create_departemens_table', 8),
(83, '2022_11_28_170843_create_departemens_table', 9),
(84, '2022_12_11_045213_create_workorders_table', 10),
(85, '2022_12_12_190024_create_perangkats_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perangkat`
--

CREATE TABLE `perangkat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_inventaris` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_perangkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spesifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cabang_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perangkat`
--

INSERT INTO `perangkat` (`id`, `no_inventaris`, `jenis_perangkat`, `spesifikasi`, `merk`, `type`, `harga`, `status`, `user_id`, `cabang_id`, `created_at`, `updated_at`) VALUES
(1, 'PDL/CPU/001', 'CPU', 'RAM 4 GB WIN 10', 'ASUS', 'TC 708', 1000000, '1', '2', '2', NULL, NULL);

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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'ho', NULL, NULL, NULL),
(2, 'cabang', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `departemen_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabang_id` bigint(20) UNSIGNED NOT NULL,
  `role` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `password`, `no_wa`, `foto`, `departemen_id`, `created_at`, `updated_at`, `cabang_id`, `role`) VALUES
(11, 'Ahmad Fauzi', 'ahmadfauzi@arnonfood.com', '$2y$10$5BhWqDcbA.xPj8rkN9OzDePIH6A/x1cCxbyFthHHTSjOp9SNIwYQe', NULL, 'default.jpg', 2, '2022-11-24 07:52:32', '2022-11-24 07:52:32', 1, 2),
(20, 'annisa', 'annisaz@arnonfood.com', '$2y$10$86WtFmars0wSyZI4vXc9XOU4XDD0uhaJ132RtF5dwqQ9KbMn4mBpW', NULL, 'default.jpg', 4, '2022-11-30 08:38:02', '2022-11-30 08:38:02', 2, 2),
(23, 'Muhamad Saepul A R', 'msaepul@arnonfood.com', '$2y$10$dPNhUfPP.k38yyTNYKx3CeR7L70szl4E1UflgN4qXbnYt456IEMKa', NULL, 'default.jpg', 1, '2022-12-03 19:49:12', '2022-12-03 19:49:12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `workorders`
--

CREATE TABLE `workorders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_wo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wo_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kategori_wo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_perangkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obyek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keadaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workorders`
--

INSERT INTO `workorders` (`id`, `no_wo`, `wo_create`, `kategori_wo`, `jenis_perangkat`, `lokasi`, `obyek`, `keadaan`, `status`, `lampiran`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'WO - PDL/2022/XII/001', '2022-12-12 09:17:00', 'hardware', 'PDL/CPU/002', 'Area Gudang', 'UPS', 'UPS Tidak berfungsi', 'draft', NULL, 23, '2022-12-12 09:18:42', '2022-12-12 09:18:42'),
(4, 'WO - PDL/2022/XII/002', '2022-12-12 09:18:59', 'brainware', NULL, 'Admin Kantor', 'Rumus Excel', 'Minta tolong dibuatkan rumus excel SUM', 'draft', NULL, 23, '2022-12-12 09:19:27', '2022-12-12 09:19:27'),
(7, 'WO - PDL/2022/XII/003', '2022-12-12 09:19:57', 'brainware', NULL, 'Admin Kantor', 'Rumus Excel', 'Minta tolong dibuatkan rumus excel SUMA', 'draft', NULL, 23, '2022-12-12 09:20:01', '2022-12-12 09:20:01'),
(8, 'WO - PDL/2022/XII/004', '2022-12-15 10:50:22', 'brainware', NULL, 'sad', 'adada', 'fafaaffa', 'draft', NULL, 23, '2022-12-15 10:50:35', '2022-12-15 10:50:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabangs`
--
ALTER TABLE `cabangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `perangkat`
--
ALTER TABLE `perangkat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perangkat_no_inventaris_unique` (`no_inventaris`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`),
  ADD KEY `users_cabang_foreign` (`cabang_id`),
  ADD KEY `users_role_foreign` (`role`);

--
-- Indexes for table `workorders`
--
ALTER TABLE `workorders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `workorders_no_wo_unique` (`no_wo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabangs`
--
ALTER TABLE `cabangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `perangkat`
--
ALTER TABLE `perangkat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `workorders`
--
ALTER TABLE `workorders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_cabang_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`),
  ADD CONSTRAINT `users_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
