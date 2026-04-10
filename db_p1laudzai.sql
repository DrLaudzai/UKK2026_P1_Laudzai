-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2026 at 07:26 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_p1laudzai`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL COMMENT 'FK ke users yang melakukan aksi. NULL jika aksi otomatis sistem',
  `action` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kode aksi: loan.created  ,   loan.approved  ,   return.recorded  ,   violation.created  ,   settlement.created  ,   appeal.approved  ,   dst',
  `module` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Modul terkait: loans  ,   returns  ,   violations  ,   settlements  ,   appeals  ,   tools  ,   users',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Penjelasan aksi dalam bahasa natural',
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Data konteks tambahan dalam format JSON string. Contoh: ARRAY[\\\\\\\\\\"loan_id\\\\\\\\',
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP address pelaku aksi',
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appeals`
--

CREATE TABLE `appeals` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'FK ke users   (  User  )   yang mengajukan banding',
  `reviewed_by` int DEFAULT NULL COMMENT 'FK ke users   (  Admin  )   yang mereview banding',
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Alasan atau refleksi dari user  ,   biasanya diajukan saat penalty_points tinggi sehingga tidak ada alat yang bisa dipinjam',
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_changed` int DEFAULT NULL COMMENT 'Jumlah poin yang dikurangi dari penalty_points jika approved. Default 1  ,   Admin bisa ubah',
  `admin_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Catatan atau feedback Admin ke user',
  `created_at` timestamp NOT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu Admin memutuskan. NULL jika masih pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_configs`
--

CREATE TABLE `app_configs` (
  `id` int NOT NULL,
  `name` int NOT NULL COMMENT 'Kunci konfigurasi. Contoh: app_name  ,   points_per_day_late  ,   points_damaged  ,   points_lost  ,   default_appeal_deduction  ,   max_loan_days',
  `late_point` int NOT NULL COMMENT 'poin penalty yang bertambah jika pengembalian alat terlambat',
  `broken_point` int NOT NULL COMMENT 'poin penalty yang bertambah jika alat rusak',
  `lost_point` int NOT NULL COMMENT 'poin penalty yang bertambah jika alat hilang',
  `late_fine` int NOT NULL,
  `broken_fine` int NOT NULL,
  `lost_fine` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Terakhir diubah oleh Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bundle_tools`
--

CREATE TABLE `bundle_tools` (
  `id` int NOT NULL,
  `bundle_id` int NOT NULL COMMENT 'FK ke tools dimana item_type = bundle',
  `tool_id` int NOT NULL COMMENT 'FK ke tools dimana item_type = bundle_tool',
  `qty` int NOT NULL COMMENT 'Jumlah sub-tool ini dalam satu bundle'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama kategori alat',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi kategori'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(6, 'Za', 'ii');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'FK ke users  ,   peminjam yang mengajukan',
  `tool_id` int NOT NULL COMMENT 'FK ke tools  ,   template alat yang dipinjam',
  `unit_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'FK ke tool_units  ,   unit fisik spesifik yang dipilih user   (  berlaku untuk single maupun bundle)',
  `employee_id` int DEFAULT NULL COMMENT 'FK ke users   (  Employee  )    ,   diisi saat approve atau reject',
  `status` enum('pending','active','rejected','closed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_date` date NOT NULL COMMENT 'Tanggal mulai peminjaman',
  `due_date` date NOT NULL COMMENT 'Tanggal wajib kembali',
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tujuan/keperluan peminjaman dari user',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Catatan Employee saat approve atau reject',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_04_08_015411_create_categories_table', 1),
(2, '2026_04_08_015412_create_users_table', 1),
(3, '2026_04_08_015413_create_user_details_table', 1),
(4, '2026_04_08_015414_create_tools_table', 1),
(5, '2026_04_08_015415_create_tool_units_table', 1),
(6, '2026_04_08_015416_create_unit_conditions_table', 1),
(7, '2026_04_08_015417_create_bundle_tools_table', 1),
(8, '2026_04_08_015418_create_loans_table', 1),
(9, '2026_04_08_015419_create_returns_table', 1),
(10, '2026_04_08_015420_create_violations_table', 1),
(11, '2026_04_08_015421_create_settlements_table', 1),
(12, '2026_04_08_015422_create_appeals_table', 1),
(13, '2026_04_08_015423_create_activity_logs_table', 1),
(14, '2026_04_08_015424_create_app_configs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int NOT NULL,
  `loan_id` int NOT NULL COMMENT 'FK ke loans  ,   1 loan hanya bisa punya 1 return',
  `employee_id` int NOT NULL COMMENT 'FK ke users   (  Employee  )   yang mencatat pengembalian',
  `condition_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'FK ke unit_conditions  ,   kondisi alat saat dikembalikan',
  `return_date` date NOT NULL COMMENT 'Tanggal aktual alat dikembalikan',
  `proof` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Catatan pengembalian dari Employee',
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settlements`
--

CREATE TABLE `settlements` (
  `id` int NOT NULL,
  `violation_id` int NOT NULL COMMENT 'FK ke violations  ,   1 pelanggaran hanya bisa dilunasi 1 kali',
  `employee_id` int NOT NULL COMMENT 'FK ke users   (  Employee  )   yang mencatat pelunasan',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Penjelasan pelunasan: bayar denda / ganti alat / kesepakatan lain',
  `settled_at` timestamp NOT NULL COMMENT 'Waktu pelunasan dicatat. Setelah ini violations.status = settled dan users.is_restricted = 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` int NOT NULL,
  `category_id` int NOT NULL COMMENT 'FK ke categories',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama template/jenis alat',
  `item_type` enum('single','bundle','bundle_tool') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint DEFAULT NULL COMMENT 'Batas maks poin penalti user agar boleh meminjam alat ini. Contoh: nilai 3 = hanya user dengan penalty_points <= 3 yang bisa pinjam. NULL = semua user boleh pinjam',
  `min_credit_score` bigint DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi umum alat atau bundle',
  `code_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Path foto representatif alat',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tool_units`
--

CREATE TABLE `tool_units` (
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kode unik unit fisik  ,   dibuat BE. Single: LPT-001 | Bundle: SET-PK-001',
  `tool_id` int NOT NULL COMMENT 'FK ke tools   (  template)',
  `status` enum('available','nonactive','lent') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_conditions`
--

CREATE TABLE `unit_conditions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kode unik riwayat kondisi  ,   dibuat BE',
  `unit_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'FK ke tool_units',
  `return_id` int DEFAULT NULL COMMENT 'FK ke returns  ,   NULL jika dicatat di luar konteks pengembalian   (  entry awal  ,   maintenance  ,   inspeksi)',
  `conditions` enum('good','broken','maintenance') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Penjelasan kondisi saat dicatat',
  `recorded_at` timestamp NOT NULL COMMENT 'Waktu kondisi dicatat. Kondisi terkini = recorded_at paling baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email untuk login  ,   harus unik',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Password ter-hash   (  bcrypt)',
  `role` enum('Admin','Petugas','Peminjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Role untuk menentukan akses  ,   admin bisa manage user dan alat, petugas bisa manage peminjaman dan pengembalian, peminjam hanya bisa pinjam alat',
  `credit_score` int NOT NULL COMMENT 'Akumulasi poin pelanggaran  ,   bertambah tiap melanggar. Makin tinggi makin terbatas alat yang bisa dipinjam',
  `is_restricted` tinyint NOT NULL COMMENT '1 = sedang ada pinjaman aktif atau belum settlement  ,   tidak bisa ajukan pinjaman baru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `credit_score`, `is_restricted`, `created_at`, `updated_at`) VALUES
(4, 'admin@ukk2026.com', '$2y$12$9bERSRUiOE2s5P4fTBW46.jw7csYC/YTcFwd9pZtPIDTTtNBKnJge', 'Admin', 100, 0, '2026-04-07 23:54:55', '2026-04-07 23:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nomor Induk Kependudukan  ,   unik per orang',
  `user_id` int DEFAULT NULL COMMENT 'FK ke users',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nama lengkap',
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nomor handphone',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Alamat lengkap',
  `birth_date` date DEFAULT NULL COMMENT 'Tanggal lahir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`nik`, `user_id`, `name`, `no_hp`, `address`, `birth_date`, `created_at`, `updated_at`) VALUES
('2383939939', 4, 'Laudzai Muaddab Budi', '09228282882', 'Parakan Saat No. 88', '2026-04-08', '2026-04-07 23:55:32', '2026-04-07 23:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `id` int NOT NULL,
  `loan_id` int NOT NULL COMMENT 'FK ke loans yang menghasilkan pelanggaran',
  `user_id` int NOT NULL COMMENT 'FK ke users yang dikenakan pelanggaran',
  `return_id` int DEFAULT NULL COMMENT 'FK ke returns. NULL jika type = lost karena tidak ada pengembalian',
  `type` enum('late','damaged','lost') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_score` int NOT NULL COMMENT 'total kredit user yang berkurang',
  `fine` double DEFAULT NULL COMMENT 'Jumlah hari keterlambatan  ,   diisi hanya jika type = late',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Penjelasan detail pelanggaran',
  `status` enum('active','settled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `appeals`
--
ALTER TABLE `appeals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appeals_user_id_foreign` (`user_id`),
  ADD KEY `appeals_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `app_configs`
--
ALTER TABLE `app_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bundle_tools`
--
ALTER TABLE `bundle_tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bundle_tools_bundle_id_foreign` (`bundle_id`),
  ADD KEY `bundle_tools_tool_id_foreign` (`tool_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`),
  ADD KEY `loans_tool_id_foreign` (`tool_id`),
  ADD KEY `loans_unit_code_foreign` (`unit_code`),
  ADD KEY `loans_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `returns_loan_id_unique` (`loan_id`),
  ADD KEY `returns_employee_id_foreign` (`employee_id`),
  ADD KEY `returns_condition_id_foreign` (`condition_id`);

--
-- Indexes for table `settlements`
--
ALTER TABLE `settlements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settlements_violation_id_unique` (`violation_id`),
  ADD KEY `settlements_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tools_category_id_foreign` (`category_id`);

--
-- Indexes for table `tool_units`
--
ALTER TABLE `tool_units`
  ADD PRIMARY KEY (`code`),
  ADD KEY `tool_units_tool_id_foreign` (`tool_id`);

--
-- Indexes for table `unit_conditions`
--
ALTER TABLE `unit_conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_conditions_unit_code_foreign` (`unit_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `violations_loan_id_foreign` (`loan_id`),
  ADD KEY `violations_user_id_foreign` (`user_id`),
  ADD KEY `violations_return_id_foreign` (`return_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appeals`
--
ALTER TABLE `appeals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_configs`
--
ALTER TABLE `app_configs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bundle_tools`
--
ALTER TABLE `bundle_tools`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settlements`
--
ALTER TABLE `settlements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `appeals`
--
ALTER TABLE `appeals`
  ADD CONSTRAINT `appeals_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appeals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bundle_tools`
--
ALTER TABLE `bundle_tools`
  ADD CONSTRAINT `bundle_tools_bundle_id_foreign` FOREIGN KEY (`bundle_id`) REFERENCES `tools` (`id`),
  ADD CONSTRAINT `bundle_tools_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `loans_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`),
  ADD CONSTRAINT `loans_unit_code_foreign` FOREIGN KEY (`unit_code`) REFERENCES `tool_units` (`code`),
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_condition_id_foreign` FOREIGN KEY (`condition_id`) REFERENCES `unit_conditions` (`id`),
  ADD CONSTRAINT `returns_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `returns_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`);

--
-- Constraints for table `settlements`
--
ALTER TABLE `settlements`
  ADD CONSTRAINT `settlements_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `settlements_violation_id_foreign` FOREIGN KEY (`violation_id`) REFERENCES `violations` (`id`);

--
-- Constraints for table `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `tool_units`
--
ALTER TABLE `tool_units`
  ADD CONSTRAINT `tool_units_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`);

--
-- Constraints for table `unit_conditions`
--
ALTER TABLE `unit_conditions`
  ADD CONSTRAINT `unit_conditions_unit_code_foreign` FOREIGN KEY (`unit_code`) REFERENCES `tool_units` (`code`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `violations`
--
ALTER TABLE `violations`
  ADD CONSTRAINT `violations_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `violations_return_id_foreign` FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`),
  ADD CONSTRAINT `violations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
