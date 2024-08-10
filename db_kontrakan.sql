-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306:3306
-- Waktu pembuatan: 10 Agu 2024 pada 17.03
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kontrakan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `password`, `role`) VALUES
(2, 'admin', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `nama_kontrakan` varchar(50) NOT NULL,
  `waktu` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `kode_kamar` char(4) NOT NULL,
  `nomor_kamar` varchar(3) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `fasilitas` varchar(128) NOT NULL,
  `luas` varchar(13) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kamar`
--

INSERT INTO `tb_kamar` (`id`, `id_pemilik`, `kode_kamar`, `nomor_kamar`, `nama_kamar`, `alamat`, `fasilitas`, `luas`, `harga`, `status`, `kontak`, `gambar`) VALUES
(33, 7, 'F-1', '001', 'Kontrakan Farhan', 'Jakarta bekasi', 'kamar mandi, ac', '90', 180000, 'Digunakan', '089787678888', '66b735eb3b373_kost-1.jpg'),
(34, 7, 'F-2', '002', 'Kontrakan Coklat Farhan', 'Jakarta bekasi', 'kamar mandi', '90', 200000, 'tersedia', '089787678888', '66b7361491059_kost-1.jpg'),
(35, 7, 'F-3', '003', 'Kontrakan Kuning Farhan', 'Jakarta bekasi', 'motor', '90', 300000, 'tersedia', '089787678888', '66b7363475af6_kost-1.jpg'),
(36, 8, 'J-1', '004', 'Kontrakan Joshua', 'Bogor', 'kamar mandi, ac', '60', 400000, 'tersedia', '089787678888', '66b736aa7d37c_kost-2.jpeg'),
(37, 8, 'J-2', '005', 'Kontrakan Kuning Jo', 'Bogor', 'ac,tv', '60', 500000, 'tersedia', '089787678888', '66b736ca95096_kost-2.jpeg'),
(38, 8, 'J-3', '006', 'Coklat Jos', 'Bogor', 'kamar mandi, ac', '60', 600000, 'tersedia', '089787678888', '66b736fcbfb51_kost-2.jpeg'),
(39, 9, 'P-1', '007', 'Kontrakan Priyo', 'bekasi', 'kamar mandi, ac', '50', 700000, 'Digunakan', '089787678888', '66b737c1df852_kost-3.jpeg'),
(40, 9, 'P-2', '008', 'Kontrakan Coklat Prio', 'bekasi', 'kamar mandi', '50', 800000, 'tersedia', '089787678888', '66b737e1aa9cf_kost-3.jpeg'),
(41, 9, 'P-3', '009', 'Coklat ', 'bekasi', 'ac,tv', '50', 900000, 'tersedia', '089787678888', '66b738011dfd7_kost-3.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` int(11) NOT NULL,
  `id_penghuni` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `bayar` int(11) NOT NULL,
  `bukti_pembayaran` varchar(50) NOT NULL,
  `status_pembayaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `id_penghuni`, `id_tagihan`, `tanggal_pembayaran`, `bulan`, `bayar`, `bukti_pembayaran`, `status_pembayaran`) VALUES
(46, 107, 70, '2024-08-10', 'Januari', 700000, '66b753a5cfd87_logo-kontrakan.jpg', 'disetujui'),
(47, 108, 71, '2024-08-02', 'Januari', 100000, '66b75aae0d5e1_kost-3.jpeg', 'disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penghuni`
--

CREATE TABLE `tb_penghuni` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nik` int(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` int(13) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penghuni`
--

INSERT INTO `tb_penghuni` (`id`, `id_pengguna`, `nik`, `nama`, `tgl_lahir`, `no_hp`, `pekerjaan`, `tujuan`) VALUES
(107, 4, 321687, 'Faisal ', '2024-08-01', 2147483647, 'Mahasiswa', 'Tempat tinggal'),
(108, 5, 321687, 'Rfky1', '2024-08-10', 628565445, 'Mahasiswa', 'Tempat tinggal'),
(109, 5, 321687, 'Rfky1', '2024-08-10', 2147483647, 'Mahasiswa', 'Tempat tinggal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penyewaan`
--

CREATE TABLE `tb_penyewaan` (
  `id` int(11) NOT NULL,
  `id_penghuni` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `tanggal_penyewaan` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penyewaan`
--

INSERT INTO `tb_penyewaan` (`id`, `id_penghuni`, `id_kamar`, `id_pemilik`, `tanggal_penyewaan`, `status`) VALUES
(69, 107, 39, 9, '2024-08-10', 'Disetujui'),
(70, 108, 33, 7, '2024-08-01', 'Disetujui'),
(71, 109, 39, 9, '2024-08-16', 'Disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_registrasi`
--

CREATE TABLE `tb_registrasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` int(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_registrasi`
--

INSERT INTO `tb_registrasi` (`id`, `nama`, `no_hp`, `email`, `password`, `status`) VALUES
(4, 'Faisal basri', 2147483647, 'faisal@gmail.com', 'user', 'penyewa'),
(5, 'Rifki Maulana', 2147483647, 'rifki@gmail.com', 'user', 'penyewa'),
(6, 'Alif Nayandra', 2147483647, 'alif@gmail.com', 'user', 'penyewa'),
(7, 'Farhan', 2147483647, 'farhan@gmail.com', 'admin', 'pemilik'),
(8, 'joshua', 2147483647, 'joshua@gmail.com', 'admin', 'pemilik'),
(9, 'Priyo', 2147483647, 'priyo@gmail.com', 'admin', 'pemilik'),
(10, 'admin', 6283232, 'admin@gmail.com', 'superadmin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tagihan`
--

CREATE TABLE `tb_tagihan` (
  `id` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `id_penyewaan` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tagihan`
--

INSERT INTO `tb_tagihan` (`id`, `id_pemilik`, `id_penyewaan`, `bulan`, `status`) VALUES
(70, 9, 69, 'Januari', 'Lunas'),
(71, 7, 70, 'Januari', 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `id_penghuni` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tagihan` (`id_tagihan`),
  ADD KEY `id_user` (`id_penghuni`),
  ADD KEY `id_penghuni` (`id_penghuni`);

--
-- Indeks untuk tabel `tb_penghuni`
--
ALTER TABLE `tb_penghuni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `tb_penyewaan`
--
ALTER TABLE `tb_penyewaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penghuni` (`id_penghuni`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indeks untuk tabel `tb_registrasi`
--
ALTER TABLE `tb_registrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penyewaan` (`id_penyewaan`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penghuni` (`id_penghuni`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_kamar`
--
ALTER TABLE `tb_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `tb_penghuni`
--
ALTER TABLE `tb_penghuni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT untuk tabel `tb_penyewaan`
--
ALTER TABLE `tb_penyewaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `tb_registrasi`
--
ALTER TABLE `tb_registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD CONSTRAINT `tb_kamar_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `tb_registrasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_tagihan`) REFERENCES `tb_tagihan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_2` FOREIGN KEY (`id_penghuni`) REFERENCES `tb_penghuni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_penghuni`
--
ALTER TABLE `tb_penghuni`
  ADD CONSTRAINT `tb_penghuni_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_registrasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_penyewaan`
--
ALTER TABLE `tb_penyewaan`
  ADD CONSTRAINT `tb_penyewaan_ibfk_1` FOREIGN KEY (`id_penghuni`) REFERENCES `tb_penghuni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_penyewaan_ibfk_2` FOREIGN KEY (`id_kamar`) REFERENCES `tb_kamar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_penyewaan_ibfk_3` FOREIGN KEY (`id_pemilik`) REFERENCES `tb_kamar` (`id_pemilik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD CONSTRAINT `tb_tagihan_ibfk_1` FOREIGN KEY (`id_penyewaan`) REFERENCES `tb_penyewaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_tagihan_ibfk_2` FOREIGN KEY (`id_pemilik`) REFERENCES `tb_registrasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_penghuni`) REFERENCES `tb_penghuni` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
