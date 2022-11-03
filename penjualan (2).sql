-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2022 pada 05.06
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` bigint(20) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `food_menu_id` int(11) NOT NULL,
  `harga_menu` varchar(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `sub_total` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `penjualan_id`, `food_menu_id`, `harga_menu`, `jumlah`, `sub_total`) VALUES
(31, 9, 1, '15000', 2, '30000'),
(32, 9, 2, '14000', 1, '14000'),
(35, 11, 6, '14000', 2, '28000'),
(36, 11, 9, '13500', 2, '27000'),
(37, 12, 8, '15000', 1, '15000'),
(38, 13, 1, '15000', 1, '15000'),
(39, 14, 8, '15000', 3, '45000'),
(40, 14, 7, '15000', 1, '15000'),
(41, 14, 9, '13500', 1, '13500'),
(42, 15, 6, '14000', 2, '28000'),
(43, 16, 7, '15000', 1, '15000'),
(45, 18, 4, '16000', 2, '32000'),
(46, 18, 2, '14000', 1, '14000'),
(47, 17, 5, '16000', 1, '16000'),
(48, 17, 9, '13500', 2, '27000'),
(58, 22, 4, '16000', 1, '16000'),
(59, 22, 2, '14000', 1, '14000'),
(60, 22, 11, '18000', 1, '18000'),
(61, 23, 16, '5000', 2, '10000'),
(62, 23, 4, '16000', 1, '16000'),
(63, 24, 16, '5000', 1, '5000'),
(64, 25, 15, '10000', 1, '10000'),
(65, 25, 17, '12000', 1, '12000'),
(66, 26, 15, '10000', 1, '10000'),
(67, 26, 6, '14000', 1, '14000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `food_menu`
--

CREATE TABLE `food_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(128) NOT NULL,
  `harga_menu` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `food_menu`
--

INSERT INTO `food_menu` (`id`, `nama_menu`, `harga_menu`) VALUES
(1, 'Vietnam Drip', 15000),
(2, 'Japanese', 14000),
(4, 'Vanilla Latte', 16000),
(5, 'Cafe Latte', 16000),
(6, 'Americano', 14000),
(7, 'Choco Latte', 15000),
(8, 'Taro Latte', 15000),
(11, 'Coffee Beer', 18000),
(14, 'Coffee Beer (Ice)', 20000),
(15, 'Susu Jahe', 10000),
(16, 'Teh Original', 5000),
(17, 'Teh Mint', 12000),
(18, 'Teh Strawberry', 13000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `no_penjualan` varchar(20) DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL,
  `tgl_penjualan` date DEFAULT current_timestamp(),
  `jam_penjualan` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `bayar` varchar(28) NOT NULL,
  `kembalian` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_penjualan`, `user_id`, `tgl_penjualan`, `jam_penjualan`, `total`, `bayar`, `kembalian`) VALUES
(9, 'MDK1656042583', 12, '2022-06-20', '10:49:43', 44000, '0', '0'),
(11, 'MDK1656074753', 12, '2022-06-20', '19:45:53', 55000, '0', '0'),
(12, 'MDK1656075200', 12, '2022-06-20', '19:53:20', 15000, '0', '0'),
(13, 'MDK1656075260', 22, '2022-06-21', '19:54:20', 15000, '0', '0'),
(14, 'MDK1656077053', 22, '2022-06-21', '20:24:13', 73500, '0', '0'),
(15, 'MDK1656130332', 22, '2022-06-21', '11:12:12', 28000, '0', '0'),
(16, 'MDK1656164670', 12, '2022-06-21', '20:44:30', 15000, '20.000', '0'),
(17, 'MDK1656165216', 12, '2022-06-22', '20:53:36', 43000, '20000', '7000'),
(18, 'MDK1656165730', 12, '2022-06-22', '21:02:10', 46000, '50000', '4000'),
(22, 'MDK1656396704', 12, '2022-06-25', '13:11:44', 48000, '50000', '2000'),
(23, 'MDK1656422847', 12, '2022-06-23', '20:27:27', 26000, '30000', '4000'),
(24, 'MDK1656669025', 12, '2022-06-24', '16:50:25', 5000, '10000', '5000'),
(25, 'MDK1656676978', 12, '2022-07-01', '19:02:58', 22000, '25000', '3000'),
(26, 'MDK1656677024', 12, '2022-07-01', '19:03:44', 24000, '25000', '1000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing`
--

CREATE TABLE `purchasing` (
  `id` int(11) NOT NULL,
  `nama_item` varchar(128) NOT NULL,
  `harga_item` int(28) NOT NULL,
  `tgl_pembelian` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `purchasing`
--

INSERT INTO `purchasing` (`id`, `nama_item`, `harga_item`, `tgl_pembelian`) VALUES
(22, 'Kentang', 60000, '2022-06-29'),
(23, 'Gula', 40000, '2022-06-30'),
(24, 'Teh', 35000, '2022-07-01'),
(25, 'Sedotan', 15000, '2022-07-01'),
(31, 'Kentang', 40000, '2022-07-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(1) NOT NULL,
  `image` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `role_id`, `image`, `date_created`) VALUES
(12, 'Galih Prayoga', 'admin', '$2y$10$DDl4/AeCdCODO5UWqCyTnuxp23MeEJ2YOEeTclDtE/QlWNpYNQ9A2', 1, 'default.jpg', 1655002665),
(13, 'Andi', 'andi123', '$2y$10$vq3gY4.wf0/gwl6k5YcDv.Gq8irsalxyCSEDC4Oj8u/eY6yDjS9uS', 2, 'default.jpg', 1655019875),
(22, 'Sebastian Vettel', 'vettel123', '$2y$10$ClA/soxDlogfcnAbkpRNGuQpnfj.dvtmcCzPipEmUrnLAghVUCrQy', 2, 'default.jpg', 1655448471);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`) VALUES
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user'),
(3, 2, 'Selling', 'user/selling', 'fas fa-fw fa-cash-register'),
(4, 1, 'User List', 'admin/user_list', 'fas fa-fw fa-users'),
(5, 1, 'Menu List', 'admin/menu_list', 'fas fa-fw fa-utensils'),
(6, 2, 'Selling History', 'penjualan', 'far fa-fw fa-list-alt'),
(7, 1, 'Selling Achievement', 'admin/achievement', 'fas fa-fw fa-stream'),
(8, 2, 'Purchasing', 'user/purchasing', 'fas fa-fw fa-shopping-basket'),
(9, 2, 'Report', 'user/laporan', 'fas fa-fw fa-folder');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `food_menu`
--
ALTER TABLE `food_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `food_menu`
--
ALTER TABLE `food_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
