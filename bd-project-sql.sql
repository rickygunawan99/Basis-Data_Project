-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2022 pada 06.34
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd-project-test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id_product` int(11) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `harga_lama` int(11) NOT NULL,
  `harga_baru` int(11) NOT NULL,
  `tgl_update` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id_product`, `email_admin`, `harga_lama`, `harga_baru`, `tgl_update`) VALUES
(2, 'admin@admin.com', 10000, 20800, '2022-06-08 11:36:29'),
(3, 'admin3@admin.com', 10000, 11000, '2022-06-08 11:36:29'),
(7, 'admin3@admin.com', 3000, 5000, '2022-06-08 11:36:29'),
(2, 'admin4@admin.com', 20800, 21000, '2022-06-13 01:47:34'),
(1, 'admin4@admin.com', 11000, 15000, '2022-06-13 01:49:05'),
(12, 'admin@admin.com', 20800, 25000, '2022-06-14 11:37:40'),
(1, 'admin@admin.com', 15000, 10000, '2022-06-14 12:06:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_produser` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `jml_item` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `id_produser`, `description`, `jml_item`, `harga`, `stock`) VALUES
(1, 1, '10.000 VGP', 10000, 10000, 4),
(2, 2, '20.000 VGP', 20000, 21000, 3),
(3, 5, '10.000 Voucher iTunes', 10000, 11000, 3),
(4, 4, 'Gymnostic X1000', 1000, 1500000, 84),
(6, 3, '60Day Battle Pass Genshin', 1, 125000, 87),
(7, 12, 'Produk Mystery', 1, 5000, 22),
(8, 12, 'Produk Misteri 2', 1, 8000, 23),
(9, 5, 'Voucher ITunes 30 Day', 1, 150000, 19),
(10, 9, 'Produk Tambahan', 1, 5000, 41),
(11, 1, '10.000 VGP', 10000, 11000, 0),
(12, 2, '20.000 VGP', 20000, 25000, 3),
(13, 22, 'Test', 1, 10000, 15),
(14, 22, 'Test 3', 10000, 12000, 10),
(15, 4, 'Gymonstic Crystal X200', 200, 100000, 25),
(16, 23, 'Voucher Play Card 10000', 10000, 11000, 9),
(17, 11, 'Produk 1', 1, 9, 10),
(18, 28, 'Produk Test', 1111, 1111, 11),
(19, 29, 'Alskndasn', 555, 555, 555);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produser`
--

CREATE TABLE `produser` (
  `id` int(11) NOT NULL,
  `nama_produser` varchar(50) NOT NULL,
  `nama_voucher` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produser`
--

INSERT INTO `produser` (`id`, `nama_produser`, `nama_voucher`) VALUES
(5, 'iTunes', 'Voucher Car'),
(3, 'MihoYo', 'Battle Passs'),
(4, 'MihoYo', 'Gymnostic Crystal'),
(12, 'MihoYo', 'Mystery Box'),
(18, 'Playstore', 'Google Gift'),
(10, 'Playstore', 'Google Gifta'),
(1, 'Playstore', 'Google Gifts'),
(23, 'Playstore', 'Google Play Card'),
(2, 'Playstore', 'Google Play Gifts'),
(17, 'Playstore', 'Google playgift'),
(26, 'Playstore', 'Playstore'),
(21, 'Playstore', 'Playstore baru'),
(14, 'Produk Lama', 'Produk apa ini'),
(28, 'produser 1', 'test 1'),
(9, 'produser baru', 'voucher baru'),
(13, 'Produser Baru', 'Voucher Lama'),
(11, 'produser entah', 'voucher apa ini'),
(22, 'Produser tambahan', 'Voucher tambahan'),
(29, 'testttt', 'testtt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'super'),
(2, 'admin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `session`
--

CREATE TABLE `session` (
  `id` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `session`
--

INSERT INTO `session` (`id`, `email`) VALUES
('62a59c02cb469', 'super@super.com'),
('62600c159c7f7', 'test3@test.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_products` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `kode_voucher` varchar(100) DEFAULT NULL,
  `status_pemesanan` int(11) NOT NULL DEFAULT 0,
  `tanggal_pembelian` timestamp NOT NULL DEFAULT current_timestamp(),
  `email_admin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `email`, `id_products`, `total_harga`, `kode_voucher`, `status_pemesanan`, `tanggal_pembelian`, `email_admin`) VALUES
(1, 'dummy@dummy.com', 2, 30000, NULL, -1, '2022-04-03 17:23:38', 'admin@admin.com'),
(4, 'test@tes.com', 6, 50000, '462613a6f08ac2', 1, '2021-04-05 04:59:42', 'admin@admin.com'),
(5, 'user@user.com', 8, 40000, NULL, -1, '2022-04-05 05:00:12', NULL),
(6, 'dummy@dummy.com', 1, 20000, '662613ab67214b', 1, '2019-04-05 05:01:49', 'admin@admin.com'),
(8, 'tes@test.com', 3, 11000, '8625ff3d800beb', 1, '2022-04-06 09:06:05', NULL),
(9, 'test@tes.com', 3, 11000, NULL, -1, '2018-04-19 18:24:06', 'admin@admin.com'),
(10, 'test3@test.com', 2, 20800, '1062602f2d34806', 1, '2022-04-20 12:50:07', NULL),
(11, 'test3@test.com', 2, 20800, NULL, -1, '2022-04-20 12:51:08', 'admin@admin.com'),
(12, 'dummy@dummy.com', 11, 30000, '126279ec6bd97f9', 1, '2022-05-02 09:35:53', 'admin@admin.com'),
(13, 'user2@gmail.com', 10, 25000, NULL, -1, '2022-05-02 10:00:12', 'admin@admin.com'),
(14, 'user2@gmail.com', 2, 10000, '14627aa43058e37', 1, '2022-05-10 17:42:38', 'admin3@admin.com'),
(15, 'admin@admin.com', 15, 100000, NULL, 0, '2022-05-22 05:42:24', NULL),
(16, 'admin@admin.com', 3, 10000, '166289ed39504f3', 1, '2022-05-22 07:58:09', 'admin@admin.com'),
(17, 'admin@admin.com', 3, 11000, '176289eda026225', 1, '2022-05-22 08:00:19', 'admin@admin.com'),
(18, 'admin@admin.com', 3, 11000, '186289f1bd8a94f', 1, '2022-05-22 08:17:53', 'admin@admin.com'),
(19, 'admin@admin.com', 9, 150000, '196289f1d59bfd8', 1, '2022-05-22 08:18:19', 'admin@admin.com'),
(20, 'admin@admin.com', 9, 150000, NULL, 0, '2022-05-22 08:18:37', NULL),
(21, 'admin@admin.com', 15, 100000, NULL, 0, '2022-05-25 05:26:59', NULL),
(22, 'user@user.com', 6, 125000, '226295984568c6b', 1, '2022-05-31 04:22:54', 'admin@admin.com'),
(23, 'user@user.com', 3, 11000, NULL, 0, '2022-05-31 05:20:17', NULL),
(24, 'user@user.com', 4, 1500000, '246296de2a3dd57', 1, '2022-06-01 03:33:22', 'admin3@admin.com'),
(25, 'user@user.com', 9, 150000, NULL, 0, '2022-06-01 11:35:13', NULL),
(26, 'user@user.com', 3, 11000, NULL, 0, '2022-06-02 07:13:29', NULL),
(27, 'user@user.com', 1, 11000, '27629cf33dd13ab', 1, '2022-06-05 18:17:10', 'admin@admin.com'),
(28, 'user@user.com', 6, 125000, NULL, 0, '2022-06-09 16:38:03', NULL),
(29, 'tes5@tes.com', 6, 125000, NULL, 0, '2022-06-11 13:06:32', NULL),
(30, 'user@user.com', 4, 1500000, '3062a817313e98c', 1, '2022-06-14 05:05:16', 'admin@admin.com'),
(31, 'user@user.com', 9, 150000, '3162a99b51dbc66', 1, '2022-06-15 08:41:05', 'admin@admin.com'),
(32, 'user@user.com', 4, 1500000, '3262b295caf122a', 1, '2022-06-22 04:08:05', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL DEFAULT '-',
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`email`, `password`, `username`, `no_hp`, `role`) VALUES
('admin10@admin.com', '$2y$10$HkJRR1A0jCiRgTlzmllGZemEm3j66vsZixtWdADM6O0pw2/QY48US', 'admin10', '12319488', 2),
('admin3@admin.com', '$2y$10$rmmQq2zUxzo4zGoLLsuDgOIfbijqzuWlIpkpSg43q5pXlkzqEYKxm', 'admin3', '-', 2),
('admin4@admin.com', '$2y$10$dUChTZFh7Z1ioAPRF2Q2..U2XKROp1VZX5rwzzKZMgQJzobuQ69fC', 'admin4', '-', 2),
('admin6@admin.com', '$2y$10$Z/Os.29FqB9h8/t43ZQls.B8Qa0/nwH/fZnmgzYoxLEr/wv/sIo/G', 'admin6', '-', 2),
('admin7@admin.com', '$2y$10$cxeibxkIDUoiJ142JjY73Or.YZGFz5pLQ.vl6q6s91KivuonefVZC', 'admin7', '1231237', 2),
('admin8@admin.com', '$2y$10$9BAURpSwGemzDNpzMU.ofuqF.lBs5BGGUl6XD5AepW8aqjUVvR8lO', 'admin8', '1232455', 2),
('admin9@admin.com', '$2y$10$0TlHG3uvvFyuBNVebDJTHeVyKiYK3HTBWS8by5W1KQbL2yMLg1BdG', 'admin9', 'admin', 2),
('admin@admin.com', '$2y$10$r3ABX.4PRRX18MFsEYkipeSkiOHH9xl9oqogquuR5i/ENRDAW8fku', 'admin', '08123', 2),
('adminbaru@admin.com', '$2y$10$lIprC/D6emVhcGPJjVgcvumjb98bgtbl0w0jASaXCaCABZKtO9sdS', 'adminbaru', '-', 2),
('dummy@dummy.com', '$2y$10$/FqBXG3yMMMIp/ysnpeYDup8TuPb97TWsfL6xHPSrDo7Ju5df0jza', 'dummy', '088124', 3),
('super@super.com', '$2y$10$Qh5cNlOZeAP2gXMg8nVSfe.tx76rr5z4r/opEb/0SrZKM/kuudErS', 'super', '08125', 1),
('tes5@tes.com', '$2y$10$y5d9LF7W7PQIV59XHYlxQOr/NCRvUWlF84H4HmvKtmZRwrfx8K9ki', 'test5', '-', 3),
('tes8@tes.com', '$2y$10$EK38KFKn8W.4H1erTGyMG.TnAYLTDNSYlpsfhwd1O37GPV08TkEpC', 'tes8', '123145345', 3),
('tes@tes.com', '$2y$10$kI9cx6.yDpGdQKbLkUaNweYBMXKJnLpyPvhQ9e1FYWbxjapGx3GYW', 'tes', '08126', 3),
('tes@test.com', '$2y$10$8K1QV1euzkk8LQW4GrH2qumD5nMeukQ6iy/SifVBNxl99YUc.1mK6', 'test', '089789', 3),
('test3@test.com', '$2y$10$U.6A0.t3ANXIdtMDSdAx7.z/CXpT3VGwgwGW0iO4oXS/8N2IKdud.', 'test3', '-', 3),
('test4@test.com', '$2y$10$qK2P0JJbh19phti4JJ6cEelSESVyJ5HteFz.ebNxHsUapT0BK2F.6', 'test4', '-', 3),
('test@tes.com', '$2y$10$/Qg2j3tn6Gqi.DC.Zdj3HePot1.HKUo3XIvqVCEQtWl.oJOY15ph.', 'test', '08745', 3),
('test@tess.com', '$2y$10$tmb4dL4VnwXFSjCPmzHIzO7PgLNpJn6oGHe17RnVFcscGaCM4ifbm', 'test', '1231234242', 3),
('user2@gmail.com', '$2y$10$cXRbFA4i1VFVVLavP0CNKehy3NZXsgHK0JbW8xdP61TAe4yagXhou', 'user2', '4122', 3),
('user@user.com', '$2y$10$c3I9.NQiy5NyypKQM/hKMeJjvMUqBVisu4xSmZqGCi6zwNEkVXdd6', 'usercoba', '04678', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD KEY `fk_history_email` (`email_admin`),
  ADD KEY `fk_history_prod` (`id_product`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_produser` (`id_produser`);

--
-- Indeks untuk tabel `produser`
--
ALTER TABLE `produser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `field_uniq` (`nama_produser`,`nama_voucher`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `session`
--
ALTER TABLE `session`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_session_user` (`email`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transactions_users` (`email`),
  ADD KEY `fk_transactions_products` (`id_products`),
  ADD KEY `fk_transactions_admin` (`email_admin`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`) USING BTREE,
  ADD KEY `fk_users_role` (`role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `produser`
--
ALTER TABLE `produser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_email` FOREIGN KEY (`email_admin`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `fk_history_prod` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_produser` FOREIGN KEY (`id_produser`) REFERENCES `produser` (`id`);

--
-- Ketidakleluasaan untuk tabel `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_session_user` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_admin` FOREIGN KEY (`email_admin`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `fk_transactions_products` FOREIGN KEY (`id_products`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_transactions_users` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
