-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 06 Jan 2021 pada 06.45
-- Versi server: 5.7.24
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_phpdasar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nip`, `email`, `jurusan`, `gambar`) VALUES
(3, 'Pratiwi Nur Syafira', '12342', 'tiwi@gmail.com', 'Hukum Pemerintahan', '5ff55527b2089.jpg'),
(15, 'Ihsan Miftahul Huda', '12345', 'isan@gmail.com', 'Teknik Informatika', '5ec6871c252ba.jpg'),
(19, 'Qoriah indah Susilowati', '123', 'qori@gmail.com', 'Teknik Informatika', '5ec68590e48cb.jpg'),
(20, 'Fachrul ', '231', 'fachrul@gmail.com', 'Bahasa Arab', '5ec6862c4a87b.jpg'),
(21, 'Ratu', '21342', 'ratu@gmail.com', 'Pendidikan Bahasa Arab', '5ecba73ad7892.jpg'),
(22, 'Ahmad Saeful Muslim', '98932', 'epul@gmail.com', 'Teknik Komputer', '5ecbaaea61049.jpg'),
(23, 'Mahmud Js', '1232', 'mahmud@gmail.com', 'Bahasa Inggris', '5ff55546c5fbc.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'ihsan miftahul huda', '$2y$10$n9pk6kXUXZWaUhWT7jVfSeVBcl/pPWFK.yWigcHRE4ue/v/TOxF6i'),
(2, 'admin', '$2y$10$0wXdInragdzasOUi0gWJEe3/Q79NjtK.Py27KEQ/l8yWZeLlFHlj6'),
(3, 'ihsan', '$2y$10$cGFq1LLBE6NN0R6vsgFLKO0WKBJGFK0iVe2VOmy9MUbQSY2/twwWy');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
