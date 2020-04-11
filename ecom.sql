-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2020 at 08:13 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `ikan_id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `qty`, `ikan_id`, `pembelian_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 3, '2020-04-07 01:40:37', '2020-04-07 01:40:37'),
(2, 1, 4, 4, '2020-04-07 02:00:58', '2020-04-07 02:00:58'),
(3, 1, 3, 5, '2020-04-10 21:45:11', '2020-04-10 21:45:11'),
(4, 1, 8, 5, '2020-04-10 21:45:11', '2020-04-10 21:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `ikan`
--

CREATE TABLE `ikan` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ikan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tambak_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ikan`
--

INSERT INTO `ikan` (`id`, `kode`, `nama_ikan`, `harga`, `foto`, `berat`, `deskripsi`, `tambak_id`, `created_at`, `updated_at`) VALUES
(3, '12345', 'Tenggiri', 323, 'e4eac3m5xerD2pmUMcW0T0C8qbMebh2ymroxKzQz.jpeg', '1', 'dsada', 2, '2020-03-23 08:00:58', '2020-04-10 21:36:35'),
(4, '#dsdsd', 'Mujaer 2', 100000, 'baA4eQPzopHJO0KemuLTFyMVw7kwyZp41TlTPzaj.jpeg', '1', 'ini tuna', 2, '2020-03-27 06:19:46', '2020-04-10 21:35:07'),
(5, '#1234', 'Mujaer 4', 300000, 'FRC5wi98x1JHC19VSe0XgNIjmn3RbLOyMgOkzQVU.jpeg', '1', 'ini pari', 2, '2020-03-27 06:20:59', '2020-04-10 21:35:36'),
(6, '#432345', 'Mujaer 5', 67000, 'O7iyPd0hxHPrlVr9u5z8A18J4o2lK7aiqapiXRCv.jpeg', '1', 'ini tongkol', 2, '2020-03-27 06:23:05', '2020-04-10 21:35:51'),
(7, '#123456', 'Mujaer 3', 40000, 'aAyXQwxdDaHEoTYCdrmivjabCv9STMS0cEjEgoQL.jpeg', '1', 'ini lele', 2, '2020-03-27 06:23:57', '2020-04-10 21:35:20'),
(8, '#43545', 'Pindang', 60000, '2Ceoc6dfTDNorBseVB44TE76EO9uYf7ya9f4oTkV.jpeg', '1', 'ini pindang', 2, '2020-03-27 06:27:21', '2020-04-10 21:36:21'),
(9, '#dsfd3234', 'Mujaer 1', 420000, '2KQ34FczPKzHGC1w3xXzT0j0Rxm9abKkwVQIiIYP.jpeg', '1', 'ini hiu', 2, '2020-03-27 06:28:21', '2020-04-10 21:34:52'),
(10, '#eeee', 'Mujaer 6', 100000, '72wEd1thsk0RTUVHcQKj1VY71kVSuRlod8237SCv.jpeg', '1', 'kepiting', 2, '2020-03-27 06:29:12', '2020-04-10 21:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkir` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama`, `ongkir`, `created_at`, `updated_at`) VALUES
(1, 'Buleleng', 10000, '2020-04-04 06:13:46', '2020-04-04 06:13:46'),
(2, 'Denpasar', 20000, '2020-04-04 06:14:08', '2020-04-04 06:14:08'),
(3, 'Tabanan', 15000, '2020-04-04 06:14:23', '2020-04-04 06:14:23'),
(4, 'Badung', 14000, '2020-04-04 06:14:39', '2020-04-04 06:14:39'),
(5, 'Gianyar', 11000, '2020-04-04 06:14:56', '2020-04-04 06:14:56');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2020_03_15_100311_create_pelanggans_table', 2),
(5, '2020_03_12_065826_create_tambaks_table', 3),
(6, '2020_03_18_132447_create_ikans_table', 3),
(7, '2020_03_28_143012_create_pembelians_table', 4),
(8, '2020_03_28_145814_create_detail_pembelians_table', 4),
(9, '2020_04_01_135028_create_kabupatens_table', 4),
(11, '2020_04_05_140415_create_pembayarans_table', 5),
(12, '2020_04_05_135934_create_pengirimen_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `username`, `email`, `password`, `no_telp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'adimas putra', 'adimas02', 'adimasistiawan01@gmail.com', '$2y$10$4Poi7RucLi/C3oM2PgKCGO1VTXcSXJisFdF1YQsFPV6NQA63xvAni', '0896465664', 'jalan raya', '2020-03-15 02:12:48', '2020-04-10 06:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bukti_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `invoice`, `tanggal_pembayaran`, `bukti_pembayaran`, `status_pembayaran`, `pembelian_id`, `created_at`, `updated_at`) VALUES
(1, 'INV - 96933', '2020-04-15', 'HhbTozvn1BqD8hRkSO4dGyiRLYfn0i1e9PitsPzX.jpeg', '1', 4, '2020-04-10 21:21:47', '2020-04-10 21:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_nominal` int(11) NOT NULL,
  `status_pembelian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `invoice`, `tanggal_pembelian`, `total_nominal`, `status_pembelian`, `pelanggan_id`, `created_at`, `updated_at`) VALUES
(4, 'INV - 96933', '2020-04-07', 110000, '1', 1, '2020-04-07 02:00:58', '2020-04-07 02:00:58'),
(5, 'INV - 84169', '2020-04-11', 70323, '4', 1, '2020-04-10 21:45:11', '2020-04-10 22:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` int(10) UNSIGNED NOT NULL,
  `alamat_pengiriman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkir` int(11) NOT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `pembelian_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `alamat_pengiriman`, `kabupaten`, `ongkir`, `tanggal_kirim`, `pembelian_id`, `created_at`, `updated_at`) VALUES
(2, 'jalan raya denpasar', 'Buleleng', 10000, NULL, 4, '2020-04-07 02:00:58', '2020-04-07 02:00:58'),
(3, 'jalan raya', 'Buleleng', 10000, NULL, 5, '2020-04-10 21:45:12', '2020-04-10 21:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `tambak`
--

CREATE TABLE `tambak` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_tambak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tambak`
--

INSERT INTO `tambak` (`id`, `nama_tambak`, `alamat`, `no_telp`, `foto`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'adit tambak', 'jalan raya 2', '23232432', 'ed5TlzEgeUSWwZAMZNaBtEbkHort7TBZUpUDmRfl.png', 7, NULL, '2020-03-21 19:29:34', '2020-03-24 05:53:26'),
(5, 'test2', 'jalan raya 2', '2324354', '', 7, NULL, '2020-03-24 06:02:34', '2020-03-24 06:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'adimas', 'adimas01', 'adimasistiawan01@gmail.com', '$2y$10$fZCTxCpDGTXuFppGcMtu..DYYDKVHcR.A9g2FtJLqGZx5QwEfELna', '1', 'gvZd38bV0JtyI9cuWJkbi8bBUaagfreNNDoQjQh0CmzAtyQKOxlsttGQb37i', '2020-03-13 06:32:00', '2020-03-13 06:32:00'),
(5, 'jaka', 'jaka123', 'jaka@gmail.com', '$2y$10$FEezuaNwe2Fgd/Map3dh5e.XagF2fTDomJnBXUx8YhfXgJy46wFSy', '0', NULL, '2020-03-18 01:18:50', '2020-03-18 01:18:50'),
(7, 'adit', 'adit123', 'adit@gmail.com', '$2y$10$ImwF0zjLkCMe6tjcM1BJJOO3OGCObOCtA0ANdCoRQvBn9gO3kbZ7O', '0', 'bXBYLopgzsvQ6TVldhLCfMGiRTpn02lqaJIL43PZBTczVlUZCswDlBIcI2DK', '2020-03-21 19:29:33', '2020-03-22 02:15:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ikan`
--
ALTER TABLE `ikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
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
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tambak`
--
ALTER TABLE `tambak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ikan`
--
ALTER TABLE `ikan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tambak`
--
ALTER TABLE `tambak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
