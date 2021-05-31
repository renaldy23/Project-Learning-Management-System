-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2021 pada 08.15
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be_smart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_without_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `password_without_hash`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'admin1234', '$2y$10$ILrmLZtxOR6j8jvl/Q9YYugx2DFY3RsxIC.lKW39fQTQenSRTnwa6', 'secret', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `option` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_ajar`
--

CREATE TABLE `bahan_ajar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_class`
--

CREATE TABLE `course_class` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_without_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_online` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `singkatan`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Pendingin dan Tata Udara', 'TPTU', '2021-05-31 06:14:25', '2021-05-31 06:14:25'),
(2, 'Teknik Otomasi Industri', 'TOI', '2021-05-31 06:14:25', '2021-05-31 06:14:25'),
(3, 'Instrumentasi Otomatisasi Proses', 'IOP', '2021-05-31 06:14:25', '2021-05-31 06:14:25'),
(4, 'Teknik Elektronika Daya dan Komunikasi', 'TEDK', '2021-05-31 06:14:25', '2021-05-31 06:14:25'),
(5, 'Teknik Elektronika Industri', 'TEI', '2021-05-31 06:14:25', '2021-05-31 06:14:25'),
(6, 'Sistem Informasi Jaringan dan Aplikasi', 'SIJA', '2021-05-31 06:14:25', '2021-05-31 06:14:25'),
(7, 'Rekayasa Perangkat Lunak', 'RPL', '2021-05-31 06:14:25', '2021-05-31 06:14:25'),
(8, 'Produksi Film dan Program Televisi', 'PFPT', '2021-05-31 06:14:25', '2021-05-31 06:14:25'),
(9, 'Teknik Mekatronika', 'MEKA', '2021-05-31 06:14:25', '2021-05-31 06:14:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `walikelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `jurusan_id`, `nama_kelas`, `walikelas_id`, `created_at`, `updated_at`) VALUES
(1, 7, 'X RPL A', NULL, '2021-05-31 06:14:27', '2021-05-31 06:14:27'),
(2, 7, 'X RPL B', NULL, '2021-05-31 06:14:27', '2021-05-31 06:14:27'),
(3, 7, 'X RPL C', NULL, '2021-05-31 06:14:27', '2021-05-31 06:14:27'),
(4, 7, 'XI RPL A', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(5, 7, 'XI RPL B', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(6, 7, 'XI RPL C', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(7, 7, 'XII RPL A', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(8, 7, 'XII RPL B', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(9, 7, 'XII RPL C', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(10, 5, 'X TEI A', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(11, 5, 'X TEI B', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(12, 5, 'X TEI C', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(13, 5, 'XI TEI A', NULL, '2021-05-31 06:14:28', '2021-05-31 06:14:28'),
(14, 5, 'XI TEI B', NULL, '2021-05-31 06:14:29', '2021-05-31 06:14:29'),
(15, 5, 'XI TEI C', NULL, '2021-05-31 06:14:29', '2021-05-31 06:14:29'),
(16, 5, 'XII TEI A', NULL, '2021-05-31 06:14:29', '2021-05-31 06:14:29'),
(17, 5, 'XII TEI B', NULL, '2021-05-31 06:14:29', '2021-05-31 06:14:29'),
(18, 5, 'XII TEI C', NULL, '2021-05-31 06:14:29', '2021-05-31 06:14:29'),
(19, 1, 'X TPTU A', NULL, '2021-05-31 06:14:29', '2021-05-31 06:14:29'),
(20, 1, 'X TPTU B', NULL, '2021-05-31 06:14:29', '2021-05-31 06:14:29'),
(21, 1, 'X TPTU C', NULL, '2021-05-31 06:14:29', '2021-05-31 06:14:29'),
(22, 1, 'XI TPTU A', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(23, 1, 'XI TPTU B', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(24, 1, 'XI TPTU C', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(25, 1, 'XII TPTU A', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(26, 1, 'XII TPTU B', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(27, 1, 'XII TPTU C', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(28, 6, 'X SIJA A', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(29, 6, 'X SIJA B', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(30, 6, 'X SIJA C', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(31, 6, 'XI SIJA A', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(32, 6, 'XI SIJA B', NULL, '2021-05-31 06:14:30', '2021-05-31 06:14:30'),
(33, 6, 'XI SIJA C', NULL, '2021-05-31 06:14:31', '2021-05-31 06:14:31'),
(34, 6, 'XII SIJA A', NULL, '2021-05-31 06:14:31', '2021-05-31 06:14:31'),
(35, 6, 'XII SIJA B', NULL, '2021-05-31 06:14:31', '2021-05-31 06:14:31'),
(36, 6, 'XII SIJA C', NULL, '2021-05-31 06:14:31', '2021-05-31 06:14:31'),
(37, 6, 'XIII SIJA A', NULL, '2021-05-31 06:14:31', '2021-05-31 06:14:31'),
(38, 6, 'XIII SIJA B', NULL, '2021-05-31 06:14:31', '2021-05-31 06:14:31'),
(39, 6, 'XIII SIJA C', NULL, '2021-05-31 06:14:31', '2021-05-31 06:14:31'),
(40, 2, 'X TOI A', NULL, '2021-05-31 06:14:31', '2021-05-31 06:14:31'),
(41, 2, 'X TOI B', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(42, 2, 'X TOI C', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(43, 2, 'XI TOI A', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(44, 2, 'XI TOI B', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(45, 2, 'XI TOI C', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(46, 2, 'XII TOI A', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(47, 2, 'XII TOI B', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(48, 2, 'XII TOI C', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(49, 2, 'XIII TOI A', NULL, '2021-05-31 06:14:32', '2021-05-31 06:14:32'),
(50, 2, 'XIII TOI B', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(51, 2, 'XIII TOI C', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(52, 8, 'X FPPT A', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(53, 8, 'X PFPT B', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(54, 8, 'X PFPT C', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(55, 8, 'XI PFPT A', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(56, 8, 'XI PFPT B', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(57, 8, 'XI PFPT C', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(58, 8, 'XII PFPT A', NULL, '2021-05-31 06:14:33', '2021-05-31 06:14:33'),
(59, 8, 'XII PFPT B', NULL, '2021-05-31 06:14:34', '2021-05-31 06:14:34'),
(60, 8, 'XII PFPT C', NULL, '2021-05-31 06:14:34', '2021-05-31 06:14:34'),
(61, 8, 'XIII PFPT A', NULL, '2021-05-31 06:14:34', '2021-05-31 06:14:34'),
(62, 8, 'XIII PFPT B', NULL, '2021-05-31 06:14:34', '2021-05-31 06:14:34'),
(63, 8, 'XIII PFPT C', NULL, '2021-05-31 06:14:34', '2021-05-31 06:14:34'),
(64, 9, 'X MEKA A', NULL, '2021-05-31 06:14:34', '2021-05-31 06:14:34'),
(65, 9, 'X MEKA B', NULL, '2021-05-31 06:14:34', '2021-05-31 06:14:34'),
(66, 9, 'X MEKA C', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(67, 9, 'XI MEKA A', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(68, 9, 'XI MEKA B', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(69, 9, 'XI MEKA C', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(70, 9, 'XII MEKA A', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(71, 9, 'XII MEKA B', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(72, 9, 'XII MEKA C', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(73, 9, 'XIII MEKA A', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(74, 9, 'XIII MEKA B', NULL, '2021-05-31 06:14:35', '2021-05-31 06:14:35'),
(75, 9, 'XIII MEKA C', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(76, 3, 'X IOP A', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(77, 3, 'X IOP B', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(78, 3, 'X IOP C', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(79, 3, 'XI IOP A', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(80, 3, 'XI IOP B', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(81, 3, 'XI IOP C', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(82, 3, 'XII IOP A', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(83, 3, 'XII IOP B', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(84, 3, 'XII IOP C', NULL, '2021-05-31 06:14:36', '2021-05-31 06:14:36'),
(85, 3, 'XIII IOP A', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(86, 3, 'XIII IOP B', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(87, 3, 'XIII IOP C', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(88, 4, 'X TEDK A', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(89, 4, 'X TEDK B', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(90, 4, 'X TEDK C', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(91, 4, 'XI TEDK A', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(92, 4, 'XI TEDK B', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(93, 4, 'XI TEDK C', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(94, 4, 'XII TEDK A', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(95, 4, 'XII TEDK B', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(96, 4, 'XII TEDK C', NULL, '2021-05-31 06:14:37', '2021-05-31 06:14:37'),
(97, 4, 'XIII TEDK A', NULL, '2021-05-31 06:14:38', '2021-05-31 06:14:38'),
(98, 4, 'XIII TEDK B', NULL, '2021-05-31 06:14:38', '2021-05-31 06:14:38'),
(99, 4, 'XIII TEDK C', NULL, '2021-05-31 06:14:38', '2021-05-31 06:14:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_detail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2021_05_07_075922_create_jurusans_table', 1),
(3, '2021_05_07_080041_create_gurus_table', 1),
(4, '2021_05_07_154115_create_kelas_table', 1),
(5, '2021_05_07_170805_create_siswas_table', 1),
(6, '2021_05_08_172111_create_courses_table', 1),
(7, '2021_05_08_172631_create_course_class_table', 1),
(8, '2021_05_09_112526_create_admins_table', 1),
(9, '2021_05_10_025506_create_lessons_table', 1),
(10, '2021_05_10_184404_create_tasks_table', 1),
(11, '2021_05_11_163115_create_presences_table', 1),
(12, '2021_05_11_173101_create_bahan_ajars_table', 1),
(13, '2021_05_11_230147_create_siswa_presence_table', 1),
(14, '2021_05_12_202444_create_submissions_table', 1),
(15, '2021_05_14_165145_add_guru_id_to_submissions_table', 1),
(16, '2021_05_14_171136_add_graded_at_to_submissions_table', 1),
(17, '2021_05_14_200711_add_comment_to_submissions_table', 1),
(18, '2021_05_15_073449_add_last_online_to_siswa_table', 1),
(19, '2021_05_15_073506_add_last_online_to_guru_table', 1),
(20, '2021_05_16_090416_add_course_id_to_tasks_table', 1),
(21, '2021_05_17_093529_create_task_details_table', 1),
(22, '2021_05_18_161928_create_quizzes_table', 1),
(23, '2021_05_18_181328_create_questions_table', 1),
(24, '2021_05_19_093643_create_quiz_attempt_table', 1),
(25, '2021_05_19_123020_create_answers_table', 1),
(26, '2021_05_19_130857_create_quiz_results_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `presences`
--

CREATE TABLE `presences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `presence_detail`
--

CREATE TABLE `presence_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `presence_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `question_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_a` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_b` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_c` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_d` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_question` int(11) NOT NULL,
  `access_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `allowed_attempt` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_attempt`
--

CREATE TABLE `quiz_attempt` (
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `attempt_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `point` int(11) NOT NULL,
  `correct_answer` int(11) NOT NULL,
  `max_points` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_without_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_online` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guru_id` bigint(20) UNSIGNED DEFAULT NULL,
  `online_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach_files` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `graded_at` datetime DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `task_details`
--

CREATE TABLE `task_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `attach_files` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indeks untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_quiz_id_foreign` (`quiz_id`),
  ADD KEY `answers_question_id_foreign` (`question_id`),
  ADD KEY `answers_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `bahan_ajar`
--
ALTER TABLE `bahan_ajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan_ajar_lesson_id_foreign` (`lesson_id`);

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_guru_id_foreign` (`guru_id`);

--
-- Indeks untuk tabel `course_class`
--
ALTER TABLE `course_class`
  ADD KEY `course_class_course_id_foreign` (`course_id`),
  ADD KEY `course_class_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_username_unique` (`username`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `kelas_walikelas_id_foreign` (`walikelas_id`);

--
-- Indeks untuk tabel `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presences_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `presence_detail`
--
ALTER TABLE `presence_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presence_detail_siswa_id_foreign` (`siswa_id`),
  ADD KEY `presence_detail_presence_id_foreign` (`presence_id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quiz_id_foreign` (`quiz_id`);

--
-- Indeks untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_course_id_foreign` (`course_id`),
  ADD KEY `quizzes_lesson_id_foreign` (`lesson_id`);

--
-- Indeks untuk tabel `quiz_attempt`
--
ALTER TABLE `quiz_attempt`
  ADD KEY `quiz_attempt_quiz_id_foreign` (`quiz_id`),
  ADD KEY `quiz_attempt_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_results_quiz_id_foreign` (`quiz_id`),
  ADD KEY `quiz_results_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_username_unique` (`username`),
  ADD KEY `siswa_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `siswa_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submissions_task_id_foreign` (`task_id`),
  ADD KEY `submissions_siswa_id_foreign` (`siswa_id`),
  ADD KEY `submissions_guru_id_foreign` (`guru_id`);

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_lesson_id_foreign` (`lesson_id`),
  ADD KEY `tasks_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `task_details`
--
ALTER TABLE `task_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_details_task_id_foreign` (`task_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bahan_ajar`
--
ALTER TABLE `bahan_ajar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT untuk tabel `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `presences`
--
ALTER TABLE `presences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `presence_detail`
--
ALTER TABLE `presence_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `task_details`
--
ALTER TABLE `task_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bahan_ajar`
--
ALTER TABLE `bahan_ajar`
  ADD CONSTRAINT `bahan_ajar_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `course_class`
--
ALTER TABLE `course_class`
  ADD CONSTRAINT `course_class_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_class_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`),
  ADD CONSTRAINT `kelas_walikelas_id_foreign` FOREIGN KEY (`walikelas_id`) REFERENCES `guru` (`id`);

--
-- Ketidakleluasaan untuk tabel `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presences`
--
ALTER TABLE `presences`
  ADD CONSTRAINT `presences_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presence_detail`
--
ALTER TABLE `presence_detail`
  ADD CONSTRAINT `presence_detail_presence_id_foreign` FOREIGN KEY (`presence_id`) REFERENCES `presences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `presence_detail_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizzes_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz_attempt`
--
ALTER TABLE `quiz_attempt`
  ADD CONSTRAINT `quiz_attempt_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempt_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_results_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `task_details`
--
ALTER TABLE `task_details`
  ADD CONSTRAINT `task_details_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
