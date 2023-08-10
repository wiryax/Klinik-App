-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2023 pada 15.49
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik-app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_pemeriksaan`
--

CREATE TABLE `informasi_pemeriksaan` (
  `kd_pemeriksaan` varchar(30) NOT NULL,
  `kd_pasien` varchar(12) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `hasil_periksa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `informasi_pemeriksaan`
--

INSERT INTO `informasi_pemeriksaan` (`kd_pemeriksaan`, `kd_pasien`, `tgl_periksa`, `hasil_periksa`) VALUES
('Booking-1632281', 'p-1', '2023-07-20', 'Kanker Otak'),
('Booking-1632522', 'p-1', '2023-07-21', 'Tumor Kulit'),
('Booking-1632553', 'p-1', '2023-07-22', 'Test'),
('Booking-42414', 'p-1', '2023-08-10', 'Tumor otak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_obat`
--

CREATE TABLE `item_obat` (
  `kd_resep` varchar(255) NOT NULL,
  `kd_obat` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `item_obat`
--

INSERT INTO `item_obat` (`kd_resep`, `kd_obat`) VALUES
('formula-Booking-1632281', 'etrsp-1'),
('formula-Booking-1632281', 'vitC-1'),
('formula-Booking-1632522', 'etrsp-1'),
('formula-Booking-1632522', 'neo-1'),
('formula-Booking-1632522', 'vitC-1'),
('formula-Booking-1632553', 'inza-1'),
('formula-Booking-42414', 'neo-1'),
('formula-Booking-42414', 'vitC-1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masukan`
--

CREATE TABLE `masukan` (
  `username` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masukan`
--

INSERT INTO `masukan` (`username`, `perihal`, `pesan`) VALUES
('', 'ads', 'das'),
('muhammad', 'Test', 'das'),
('muhammad', 'Test', 'asd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `kd_obat` varchar(12) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `harga` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`kd_obat`, `nama_obat`, `harga`) VALUES
('etrsp-1', 'Entrostop', 8000),
('inza-1', 'inzana', 20000),
('neo-1', 'neozhep', 10000),
('pctml-1', 'Paracetamol', 15000),
('RL-1', 'Red Label', 75000),
('vitC-1', 'Vitamin C', 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `kd_pasien` varchar(5) NOT NULL,
  `role` varchar(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_tlp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`kd_pasien`, `role`, `username`, `alamat`, `no_tlp`, `password`) VALUES
('p-1', '2', 'Muhammad', 'Kuta Bumi', '0841236589', '123'),
('p-2', '2', 'Nugraha', 'Pasar Kemis', '0812458959', '213'),
('p-3', '2', 'Rizky Purnomo', 'Dadap', '08292324578', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_transaksi` varchar(12) NOT NULL,
  `kd_pemeriksaan` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `biaya` int(8) NOT NULL,
  `status` varchar(25) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`no_transaksi`, `kd_pemeriksaan`, `tgl`, `biaya`, `status`, `file`) VALUES
('Pay-1', 'Booking-1632281', '2023-07-19', 33000, 'Lunas', '3ece20838c53e01ad180bf283f568987 (2)_8.jpg'),
('Pay-2', 'Booking-1632522', '2023-07-19', 43000, 'Lunas', '13185c7ca3282bab81f7105d43cf270a_3.jpg'),
('Pay-3', 'Booking-1632553', '2023-08-09', 20000, 'Lunas', '3ece20838c53e01ad180bf283f568987 (2)_9.jpg'),
('Pay-4', 'Booking-42414', '2023-08-09', 35000, 'Lunas', '33d0fd960abb7f7c60103332d1d030a0.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep_obat`
--

CREATE TABLE `resep_obat` (
  `kd_resep` varchar(255) NOT NULL,
  `kd_pemeriksaan` varchar(30) NOT NULL,
  `kd_pasien` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep_obat`
--

INSERT INTO `resep_obat` (`kd_resep`, `kd_pemeriksaan`, `kd_pasien`) VALUES
('formula-Booking-1632281', 'Booking-1632281', 'p-1'),
('formula-Booking-1632522', 'Booking-1632522', 'p-1'),
('formula-Booking-1632553', 'Booking-1632553', 'p-1'),
('formula-Booking-42414', 'Booking-42414', 'p-1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `kd_admin` int(2) NOT NULL,
  `role` varchar(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`kd_admin`, `role`, `username`, `pass`) VALUES
(1, '1', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `informasi_pemeriksaan`
--
ALTER TABLE `informasi_pemeriksaan`
  ADD PRIMARY KEY (`kd_pemeriksaan`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`kd_pasien`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indeks untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`kd_resep`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kd_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `kd_admin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
