-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2026 at 05:29 AM
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

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `module`, `description`, `meta`, `ip_address`, `created_at`) VALUES
(1, 4, 'category.created', 'category', 'Created category: ssssdff', '\"{\\\"name\\\":\\\"ssssdff\\\",\\\"description\\\":\\\"s\\\",\\\"id\\\":9}\"', '127.0.0.1', '2026-04-12 22:05:44'),
(2, 4, 'category.DiHapus', 'category', 'DiHapus category: ssss', '\"{\\\"id\\\":8,\\\"name\\\":\\\"ssss\\\",\\\"description\\\":null}\"', '127.0.0.1', '2026-04-12 22:20:53'),
(3, 4, 'tool.DiHapus', 'tool', 'DiHapus tool: Muhammad Farhan', '\"{\\\"id\\\":14,\\\"category_id\\\":7,\\\"name\\\":\\\"Muhammad Farhan\\\",\\\"item_type\\\":\\\"single\\\",\\\"price\\\":1,\\\"min_credit_score\\\":0,\\\"description\\\":null,\\\"code_slug\\\":\\\"yono\\\",\\\"photo_path\\\":\\\"tools\\\\\\/7Xehg5zJXmujkwxoROoc6IqaGIvnamsxqHtgJzTe.png\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-12 23:07:09'),
(4, 4, 'tool.DiHapus', 'tool', 'DiHapus tool: Muhammad Farhan', '\"{\\\"id\\\":15,\\\"category_id\\\":7,\\\"name\\\":\\\"Muhammad Farhan\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":100,\\\"min_credit_score\\\":1,\\\"description\\\":null,\\\"code_slug\\\":\\\"yonos\\\",\\\"photo_path\\\":\\\"tools\\\\\\/UoAtQgkpn75MPB0JIfuqgB5Ji0qvQriTCDC82z4Q.png\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-12 23:07:13'),
(5, 4, 'category.DiUpdate', 'category', 'DiUpdate category: Elektronik', '\"{\\\"id\\\":9,\\\"name\\\":\\\"Elektronik\\\",\\\"description\\\":\\\"s\\\"}\"', '127.0.0.1', '2026-04-12 23:07:31'),
(6, 4, 'category.DiUpdate', 'category', 'DiUpdate category: Telekomunikasi', '\"{\\\"id\\\":7,\\\"name\\\":\\\"Telekomunikasi\\\",\\\"description\\\":null}\"', '127.0.0.1', '2026-04-12 23:08:17'),
(7, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: Hp', '\"{\\\"category_id\\\":\\\"7\\\",\\\"name\\\":\\\"Hp\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":\\\"10\\\",\\\"min_credit_score\\\":\\\"1\\\",\\\"code_slug\\\":\\\"TLM\\\",\\\"description\\\":null,\\\"photo_path\\\":\\\"tools\\\\\\/KLYFtoZwvZImEVJApY8NbaNQwcWsJGi8Ej4dhUmg.webp\\\",\\\"id\\\":17}\"', '127.0.0.1', '2026-04-12 23:09:58'),
(8, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: Handphone', '\"{\\\"name\\\":\\\"Handphone\\\",\\\"category_id\\\":\\\"7\\\",\\\"item_type\\\":\\\"bundle_tool\\\",\\\"code_slug\\\":\\\"handphone\\\",\\\"photo_path\\\":\\\"tools\\\\\\/KLYFtoZwvZImEVJApY8NbaNQwcWsJGi8Ej4dhUmg.webp\\\",\\\"description\\\":null,\\\"id\\\":18}\"', '127.0.0.1', '2026-04-12 23:09:58'),
(9, 4, 'toolunit.DiBuat', 'toolunit', 'DiBuat toolunit: ', '\"{\\\"code\\\":\\\"HANDPHONE-001\\\",\\\"tool_id\\\":18,\\\"status\\\":\\\"available\\\",\\\"notes\\\":null}\"', '127.0.0.1', '2026-04-12 23:10:13'),
(10, 4, 'tool.DiHapus', 'tool', 'DiHapus tool: Hp', '\"{\\\"id\\\":17,\\\"category_id\\\":7,\\\"name\\\":\\\"Hp\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":10,\\\"min_credit_score\\\":1,\\\"description\\\":null,\\\"code_slug\\\":\\\"TLM\\\",\\\"photo_path\\\":\\\"tools\\\\\\/KLYFtoZwvZImEVJApY8NbaNQwcWsJGi8Ej4dhUmg.webp\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-12 23:11:10'),
(11, 4, 'toolunit.DiHapus', 'toolunit', 'DiHapus toolunit: ', '\"{\\\"code\\\":\\\"HANDPHONE-001\\\",\\\"tool_id\\\":18,\\\"status\\\":\\\"available\\\",\\\"notes\\\":null,\\\"created_at\\\":\\\"2026-04-13 13:10:13\\\"}\"', '127.0.0.1', '2026-04-12 23:13:02'),
(12, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: Laudzai Muaddab Budi', '\"{\\\"category_id\\\":\\\"7\\\",\\\"name\\\":\\\"Laudzai Muaddab Budi\\\",\\\"item_type\\\":\\\"single\\\",\\\"price\\\":\\\"11\\\",\\\"min_credit_score\\\":\\\"1\\\",\\\"code_slug\\\":\\\"yo\\\",\\\"description\\\":null,\\\"photo_path\\\":\\\"tools\\\\\\/VREpDNzcLSQ4OP2qRjbSjM2dps7j9D5fpNHmdpcQ.png\\\",\\\"id\\\":19}\"', '127.0.0.1', '2026-04-12 23:13:28'),
(13, 4, 'toolunit.DiBuat', 'toolunit', 'DiBuat toolunit: ', '\"{\\\"code\\\":\\\"YO-001\\\",\\\"tool_id\\\":19,\\\"status\\\":\\\"available\\\",\\\"notes\\\":null}\"', '127.0.0.1', '2026-04-12 23:13:40'),
(14, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: Muhammad Farhan', '\"{\\\"category_id\\\":\\\"7\\\",\\\"name\\\":\\\"Muhammad Farhan\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":\\\"111\\\",\\\"min_credit_score\\\":\\\"2\\\",\\\"code_slug\\\":\\\"yono\\\",\\\"description\\\":null,\\\"photo_path\\\":\\\"tools\\\\\\/6dQk5suvbg4d1k383ZWX2EDiwPrFLGasy0ZsLiI8.png\\\",\\\"id\\\":20}\"', '127.0.0.1', '2026-04-12 23:18:22'),
(15, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: Handphone', '\"{\\\"name\\\":\\\"Handphone\\\",\\\"category_id\\\":\\\"7\\\",\\\"item_type\\\":\\\"bundle_tool\\\",\\\"code_slug\\\":\\\"handphone\\\",\\\"photo_path\\\":\\\"tools\\\\\\/6dQk5suvbg4d1k383ZWX2EDiwPrFLGasy0ZsLiI8.png\\\",\\\"description\\\":null,\\\"id\\\":21}\"', '127.0.0.1', '2026-04-12 23:18:22'),
(16, 4, 'toolunit.DiBuat', 'toolunit', 'DiBuat toolunit: ', '\"{\\\"code\\\":\\\"YONO-001\\\",\\\"tool_id\\\":20,\\\"status\\\":\\\"available\\\",\\\"notes\\\":null}\"', '127.0.0.1', '2026-04-12 23:18:40'),
(17, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: VV', '\"{\\\"category_id\\\":\\\"9\\\",\\\"name\\\":\\\"VV\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":\\\"100\\\",\\\"min_credit_score\\\":\\\"2\\\",\\\"code_slug\\\":\\\"wwww\\\",\\\"description\\\":null,\\\"photo_path\\\":\\\"tools\\\\\\/xhUAWdhnexHcppKLF1v6zdOiEIFNYZ64SbDzKjjs.png\\\",\\\"id\\\":22}\"', '127.0.0.1', '2026-04-13 00:11:25'),
(18, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: dd', '\"{\\\"name\\\":\\\"dd\\\",\\\"category_id\\\":\\\"9\\\",\\\"item_type\\\":\\\"bundle_tool\\\",\\\"code_slug\\\":\\\"dd\\\",\\\"photo_path\\\":\\\"tools\\\\\\/xhUAWdhnexHcppKLF1v6zdOiEIFNYZ64SbDzKjjs.png\\\",\\\"price\\\":\\\"1\\\",\\\"description\\\":\\\"ffff\\\",\\\"id\\\":23}\"', '127.0.0.1', '2026-04-13 00:11:25'),
(20, 4, 'tool.DiUpdate', 'tool', 'DiUpdate tool: Laudzai Muaddab Budis', '\"{\\\"id\\\":19,\\\"category_id\\\":\\\"7\\\",\\\"name\\\":\\\"Laudzai Muaddab Budis\\\",\\\"item_type\\\":\\\"single\\\",\\\"price\\\":\\\"11\\\",\\\"min_credit_score\\\":\\\"1\\\",\\\"description\\\":null,\\\"code_slug\\\":\\\"yo\\\",\\\"photo_path\\\":\\\"tools\\\\\\/VREpDNzcLSQ4OP2qRjbSjM2dps7j9D5fpNHmdpcQ.png\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-13 01:07:52'),
(23, 4, 'tool.DiUpdate', 'tool', 'DiUpdate tool: VVs', '\"{\\\"id\\\":22,\\\"category_id\\\":\\\"9\\\",\\\"name\\\":\\\"VVs\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":\\\"100\\\",\\\"min_credit_score\\\":\\\"2\\\",\\\"description\\\":null,\\\"code_slug\\\":\\\"wwww\\\",\\\"photo_path\\\":\\\"tools\\\\\\/xhUAWdhnexHcppKLF1v6zdOiEIFNYZ64SbDzKjjs.png\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-13 01:40:23'),
(24, 4, 'tool.DiUpdate', 'tool', 'DiUpdate tool: VVsa', '\"{\\\"id\\\":22,\\\"category_id\\\":\\\"9\\\",\\\"name\\\":\\\"VVsa\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":\\\"100\\\",\\\"min_credit_score\\\":\\\"2\\\",\\\"description\\\":null,\\\"code_slug\\\":\\\"wwww\\\",\\\"photo_path\\\":\\\"tools\\\\\\/xhUAWdhnexHcppKLF1v6zdOiEIFNYZ64SbDzKjjs.png\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-13 01:40:35'),
(25, 4, 'tool.DiUpdate', 'tool', 'DiUpdate tool: Muhammad Farhans', '\"{\\\"id\\\":20,\\\"category_id\\\":\\\"7\\\",\\\"name\\\":\\\"Muhammad Farhans\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":\\\"111\\\",\\\"min_credit_score\\\":\\\"2\\\",\\\"description\\\":null,\\\"code_slug\\\":\\\"yono\\\",\\\"photo_path\\\":\\\"tools\\\\\\/6dQk5suvbg4d1k383ZWX2EDiwPrFLGasy0ZsLiI8.png\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-13 01:41:15'),
(26, 4, 'tool.DiHapus', 'tool', 'DiHapus tool: VVsa', '\"{\\\"id\\\":22,\\\"category_id\\\":9,\\\"name\\\":\\\"VVsa\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":100,\\\"min_credit_score\\\":2,\\\"description\\\":null,\\\"code_slug\\\":\\\"wwww\\\",\\\"photo_path\\\":\\\"tools\\\\\\/xhUAWdhnexHcppKLF1v6zdOiEIFNYZ64SbDzKjjs.png\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-13 01:49:51'),
(27, 4, 'tool.DiUpdate', 'tool', 'DiUpdate tool: Laudzai Muaddab Budiss', '\"{\\\"id\\\":19,\\\"category_id\\\":\\\"7\\\",\\\"name\\\":\\\"Laudzai Muaddab Budiss\\\",\\\"item_type\\\":\\\"single\\\",\\\"price\\\":\\\"11\\\",\\\"min_credit_score\\\":\\\"1\\\",\\\"description\\\":null,\\\"code_slug\\\":\\\"yo\\\",\\\"photo_path\\\":\\\"tools\\\\\\/VREpDNzcLSQ4OP2qRjbSjM2dps7j9D5fpNHmdpcQ.png\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-13 01:50:16'),
(28, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: Muhammad Farhans', '\"{\\\"category_id\\\":\\\"7\\\",\\\"name\\\":\\\"Muhammad Farhans\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":\\\"200\\\",\\\"min_credit_score\\\":\\\"1\\\",\\\"code_slug\\\":\\\"dd\\\",\\\"description\\\":null,\\\"photo_path\\\":\\\"tools\\\\\\/jgF9fLTw6jHvkhMDeF5Xya4wC5A0DYwldwuDKJwJ.webp\\\",\\\"id\\\":24}\"', '127.0.0.1', '2026-04-13 01:50:45'),
(29, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: xxx', '\"{\\\"name\\\":\\\"xxx\\\",\\\"category_id\\\":\\\"7\\\",\\\"item_type\\\":\\\"bundle_tool\\\",\\\"code_slug\\\":\\\"xxx\\\",\\\"photo_path\\\":\\\"tools\\\\\\/jgF9fLTw6jHvkhMDeF5Xya4wC5A0DYwldwuDKJwJ.webp\\\",\\\"price\\\":\\\"11\\\",\\\"description\\\":null,\\\"id\\\":25}\"', '127.0.0.1', '2026-04-13 01:50:45'),
(30, 4, 'tool.DiUpdate', 'tool', 'DiUpdate tool: Muhammad Farhanss', '\"{\\\"id\\\":24,\\\"category_id\\\":\\\"7\\\",\\\"name\\\":\\\"Muhammad Farhanss\\\",\\\"item_type\\\":\\\"bundle\\\",\\\"price\\\":\\\"200\\\",\\\"min_credit_score\\\":\\\"1\\\",\\\"description\\\":null,\\\"code_slug\\\":\\\"dd\\\",\\\"photo_path\\\":\\\"tools\\\\\\/jgF9fLTw6jHvkhMDeF5Xya4wC5A0DYwldwuDKJwJ.webp\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-13 01:51:06'),
(31, 4, 'tool.DiUpdate', 'tool', 'DiUpdate tool: xxx', '\"{\\\"id\\\":25,\\\"category_id\\\":7,\\\"name\\\":\\\"xxx\\\",\\\"item_type\\\":\\\"bundle_tool\\\",\\\"price\\\":\\\"11\\\",\\\"min_credit_score\\\":null,\\\"description\\\":\\\"-\\\",\\\"code_slug\\\":\\\"xxx\\\",\\\"photo_path\\\":\\\"tools\\\\\\/jgF9fLTw6jHvkhMDeF5Xya4wC5A0DYwldwuDKJwJ.webp\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null}\"', '127.0.0.1', '2026-04-13 01:51:06'),
(32, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: ssss', '\"{\\\"name\\\":\\\"ssss\\\",\\\"category_id\\\":\\\"7\\\",\\\"item_type\\\":\\\"bundle_tool\\\",\\\"code_slug\\\":\\\"ssss\\\",\\\"photo_path\\\":\\\"tools\\\\\\/jgF9fLTw6jHvkhMDeF5Xya4wC5A0DYwldwuDKJwJ.webp\\\",\\\"price\\\":\\\"11\\\",\\\"description\\\":\\\"ddd\\\",\\\"id\\\":26}\"', '127.0.0.1', '2026-04-13 01:53:03'),
(33, 4, 'tool.DiBuat', 'tool', 'DiBuat tool: Handphone', '\"{\\\"name\\\":\\\"Handphone\\\",\\\"category_id\\\":\\\"7\\\",\\\"item_type\\\":\\\"bundle_tool\\\",\\\"code_slug\\\":\\\"handphone\\\",\\\"photo_path\\\":\\\"tools\\\\\\/jgF9fLTw6jHvkhMDeF5Xya4wC5A0DYwldwuDKJwJ.webp\\\",\\\"price\\\":\\\"222\\\",\\\"description\\\":\\\"dddsss\\\",\\\"id\\\":27}\"', '127.0.0.1', '2026-04-13 01:55:18'),
(34, 4, 'user.DiBuat', 'user', 'DiBuat user: 6', '\"{\\\"credit_score\\\":100,\\\"is_restricted\\\":0,\\\"email\\\":\\\"peminjam@ukk2026.com\\\",\\\"role\\\":\\\"peminjam\\\",\\\"updated_at\\\":\\\"2026-04-14T00:56:17.000000Z\\\",\\\"created_at\\\":\\\"2026-04-14T00:56:17.000000Z\\\",\\\"id\\\":6}\"', '127.0.0.1', '2026-04-13 17:56:17'),
(35, 4, 'user.DiBuat', 'user', 'DiBuat user: 7', '\"{\\\"credit_score\\\":100,\\\"is_restricted\\\":0,\\\"email\\\":\\\"petugas@gmail.com\\\",\\\"role\\\":\\\"petugas\\\",\\\"updated_at\\\":\\\"2026-04-14T02:26:23.000000Z\\\",\\\"created_at\\\":\\\"2026-04-14T02:26:23.000000Z\\\",\\\"id\\\":7}\"', '127.0.0.1', '2026-04-13 19:26:23'),
(36, 4, 'user.DiUpdate', 'user', 'DiUpdate user: 7', '\"{\\\"id\\\":7,\\\"email\\\":\\\"petugas@ukk2026.com\\\",\\\"role\\\":\\\"Petugas\\\",\\\"credit_score\\\":100,\\\"is_restricted\\\":0,\\\"created_at\\\":\\\"2026-04-14T02:26:23.000000Z\\\",\\\"updated_at\\\":\\\"2026-04-14T02:27:02.000000Z\\\"}\"', '127.0.0.1', '2026-04-13 19:27:02'),
(37, 4, 'user.DiBuat', 'user', 'DiBuat user: 8', '\"{\\\"credit_score\\\":100,\\\"is_restricted\\\":0,\\\"email\\\":\\\"aan@gmail.comm\\\",\\\"role\\\":\\\"peminjam\\\",\\\"updated_at\\\":\\\"2026-04-14T04:25:46.000000Z\\\",\\\"created_at\\\":\\\"2026-04-14T04:25:46.000000Z\\\",\\\"id\\\":8}\"', '127.0.0.1', '2026-04-13 21:25:46');

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
  `qty` int NOT NULL COMMENT 'Jumlah sub-tool ini dalam satu bundle',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bundle_tools`
--

INSERT INTO `bundle_tools` (`id`, `bundle_id`, `tool_id`, `qty`, `created_at`, `updated_at`) VALUES
(7, 24, 26, 1, NULL, NULL);

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
(7, 'Telekomunikasi', NULL),
(9, 'Elektronik', 's');

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

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `tool_id`, `unit_code`, `employee_id`, `status`, `loan_date`, `due_date`, `purpose`, `notes`, `created_at`, `updated_at`) VALUES
(1, 6, 19, 'YO-001', 7, 'closed', '2026-04-14', '2026-04-24', 'ddd', NULL, '2026-04-13 18:43:44', '2026-04-13 20:58:27'),
(2, 6, 24, 'YONO-001', 7, 'closed', '2026-06-20', '2026-06-21', 'injem', 'Menunggu konfirmasi pengembalian', '2026-04-13 18:45:49', '2026-04-13 20:58:21'),
(3, 6, 19, 'YO-001', 7, 'rejected', '2026-04-14', '2026-04-30', 'pengen', 'malas', '2026-04-13 21:00:39', '2026-04-13 21:01:05'),
(4, 8, 20, 'YO-001', 7, 'closed', '2026-04-14', '2026-04-30', 'ssss', NULL, '2026-04-13 21:27:04', '2026-04-13 21:51:29'),
(5, 6, 20, 'YONO-001', 7, 'closed', '2026-04-14', '2026-04-14', 'ee', NULL, '2026-04-13 21:30:19', '2026-04-13 21:51:32');

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
  `employee_id` int DEFAULT NULL COMMENT 'FK ke users   (  Employee  )   yang mencatat pengembalian',
  `condition_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK ke unit_conditions  ,   kondisi alat saat dikembalikan',
  `return_date` date NOT NULL COMMENT 'Tanggal aktual alat dikembalikan',
  `proof` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Catatan pengembalian dari Employee',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `loan_id`, `employee_id`, `condition_id`, `return_date`, `proof`, `notes`, `created_at`) VALUES
(1, 1, 7, NULL, '2026-04-14', 'returns/2oIrxiwQ0xb3tO0C8lxL8808ovoABQRb9x44JmfJ.png', 'Dikonfirmasi petugas', NULL),
(2, 2, 7, NULL, '2026-04-14', 'returns/UpKqdZhlFbIFnAHu7eRxyhGdj3dZgVgBQ6EKmnoV.webp', 'Dikonfirmasi petugas', NULL),
(3, 4, 7, NULL, '2026-04-14', 'returns/UflW2dnACA4XYPymSHg5sIOGQYBg4D53Z9kfv2i6.png', 'Dikonfirmasi petugas', NULL),
(4, 5, 7, NULL, '2026-04-14', 'returns/cQ5mTYdExpI21RBuwVibFlYcQsS2dyu2UMNZBkUE.png', 'Dikonfirmasi petugas', NULL);

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

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `category_id`, `name`, `item_type`, `price`, `min_credit_score`, `description`, `code_slug`, `photo_path`, `created_at`, `updated_at`) VALUES
(18, 7, 'Handphone', 'bundle_tool', NULL, NULL, NULL, 'handphone', 'tools/KLYFtoZwvZImEVJApY8NbaNQwcWsJGi8Ej4dhUmg.webp', NULL, NULL),
(19, 7, 'Laudzai Muaddab Budiss', 'single', 11, 1, NULL, 'yo', 'tools/VREpDNzcLSQ4OP2qRjbSjM2dps7j9D5fpNHmdpcQ.png', NULL, NULL),
(20, 7, 'Muhammad Farhans', 'bundle', 111, 2, NULL, 'yono', 'tools/6dQk5suvbg4d1k383ZWX2EDiwPrFLGasy0ZsLiI8.png', NULL, NULL),
(24, 7, 'Muhammad Farhanss', 'bundle', 200, 1, NULL, 'dd', 'tools/jgF9fLTw6jHvkhMDeF5Xya4wC5A0DYwldwuDKJwJ.webp', NULL, NULL),
(26, 7, 'ssss', 'bundle_tool', 11, NULL, 'ddd', 'ssss', 'tools/jgF9fLTw6jHvkhMDeF5Xya4wC5A0DYwldwuDKJwJ.webp', NULL, NULL);

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

--
-- Dumping data for table `tool_units`
--

INSERT INTO `tool_units` (`code`, `tool_id`, `status`, `notes`, `created_at`) VALUES
('YO-001', 19, 'available', NULL, '2026-04-13 06:13:40'),
('YONO-001', 20, 'available', NULL, '2026-04-13 06:18:40');

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

--
-- Dumping data for table `unit_conditions`
--

INSERT INTO `unit_conditions` (`id`, `unit_code`, `return_id`, `conditions`, `notes`, `recorded_at`) VALUES
('69ddbb28c9ab2', 'YONO-001', 2, 'good', 'Dari peminjam', '2026-04-13 20:57:28'),
('69ddc250bc4b0', 'YO-001', 3, 'broken', 'Dari peminjam', '2026-04-13 21:28:00'),
('69ddc30a3c4d9', 'YONO-001', 4, 'broken', 'Dari peminjam', '2026-04-13 21:31:06');

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
(4, 'admin@ukk2026.com', '$2y$12$9bERSRUiOE2s5P4fTBW46.jw7csYC/YTcFwd9pZtPIDTTtNBKnJge', 'Admin', 100, 0, '2026-04-07 23:54:55', '2026-04-07 23:54:55'),
(6, 'peminjam@ukk2026.com', '$2y$12$b57o5hvDlXvxUp/0VAV2guXZg8DgekZ/FwXhDZ.uyghuhm.y3DFIu', 'Peminjam', 100, 0, '2026-04-13 17:56:17', '2026-04-13 17:56:17'),
(7, 'petugas@ukk2026.com', '$2y$12$Bkucpnf8I0VvUoiWmg1YjeP92f4AyjQiKDshKi4rZjV/dYoKY5kL2', 'Petugas', 100, 0, '2026-04-13 19:26:23', '2026-04-13 19:27:02'),
(8, 'aan@gmail.comm', '$2y$12$P8.J5JZh02rLfmRBplmUPez4BJdIK.j3DU8UOEL3Nbzv36SBWN1Ra', 'Peminjam', 100, 0, '2026-04-13 21:25:46', '2026-04-13 21:25:46');

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
('2323434343', 7, 'Farhan', '3434343334', 'assssss', '2026-04-14', '2026-04-13 19:26:23', '2026-04-13 19:26:23'),
('232343434333', 8, 'Farhan Kebab', '2323232323', 'sssss', '2026-04-14', '2026-04-13 21:25:46', '2026-04-13 21:25:46'),
('2323442334', 6, 'Afthan', '83838888883', 'Jl.jati', '2026-04-14', '2026-04-13 17:56:17', '2026-04-13 17:56:17'),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settlements`
--
ALTER TABLE `settlements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
