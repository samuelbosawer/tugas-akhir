-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 at 03:17 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta-lama`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_ranjang` char(8) NOT NULL DEFAULT 'rjg-0001',
  `id_pelanggan` char(8) NOT NULL,
  `id_perlengkapan` char(8) NOT NULL,
  `stok_sewa` int(4) NOT NULL,
  `waktu_mulai` date NOT NULL,
  `waktu_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `nama_akun` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `status_aktivasi` int(1) NOT NULL,
  `status_validasi` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `nama_akun`, `password`, `hak_akses`, `status_aktivasi`, `status_validasi`) VALUES
(2, 'papuamusic@gmail.com', 'SamBOa', '$2y$10$13p6And.dh2FtTqvXs7Wpe6l///W32hdItlcNTYGQa.qewIxpRzDa', 1, 1, 1),
(4, 'udinsewa@gmail.com', 'Udin', '$2y$10$pIvb3WPd1SqBmEGYsE6eMubTQT8YFdMYCbK.ZN/xs0TqffARVgy4e', 2, 1, 1),
(5, 'zam.bosawer@gmail.com', 'Samuel', '$2y$10$sxXyePCINxS8lLBQ5oUUkusPWATSRYspZGMZ/ApBiefNm0FiXtcw2', 3, 1, 1),
(6, 'yapo22@gmail.com', 'Cv. Yapo ', '$2y$10$72OWesIoLI7wgFVNov4tbu.q0gU.BYKZUEp/9kOgw3EHMnyDBO5ui', 2, 1, 1),
(7, 'citra@gmail.com', 'Cv. Citra jaya ', '$2y$10$uZXJSkw4raYEvsiwSxxag.YA5RA/02GSEHePdplo3nHA7imfy4iF6', 2, 1, 1),
(8, 'vcsiam@gmail.com', 'Cv Siam', '$2y$10$8TyKzloGhS5VeXSyOVquZOxghwrw22J/8y0TuA09vDAqFbEHgKWjm', 2, 1, 1),
(9, 'karya22@gmail.com', 'CV. Karya M', '$2y$10$xxVIMPWee6vb1BqtqwRMMeoEpr.BDF7zsMuVJsDyswM/RpyqYwdbC', 2, 1, 1),
(10, 'sesiloam@gmail.com', 'Pennyewaan Siloam', '$2y$10$wXWvH0e7Rxm8ZW.Kuqp4.ebYGFyZSenFP1jjsmP/msMRSuOdKjlpC', 2, 1, 1),
(12, 'chilestachi@gmail.com', 'Chilestachi', '$2y$10$Y82.nTjfFpnAhG6CuDWhXu47l/7EbxG9LEjbpJHZcaWfQ22Y8icaG', 2, 1, 1),
(13, 'demptempat@gmail.com', 'demptempat@gmail.com', '$2y$10$C8rvZ.GjmGs45WwNagLdDuf0A4AUjmAEKmTw7MG8294XfsE5AZ3ZK', 3, 1, 0),
(14, 'solatapapua@gmail.com', 'Solata', '$2y$10$DJ6WffKRl204khmNh1vm/.TQk9V5XhPG/Zp4Eoz7uoES7503tZZuu', 2, 1, 1),
(15, 'daaengpapua@gmail.com', 'Daeng Sewa', '$2y$10$ca6lXWhFZIdgGAsrUiHT3.qg484DWd.FgZwgMi4Xlk44tiNj9hvs.', 2, 1, 1),
(16, 'exoticmandala@gmail.com', 'Exotic Sewa', '$2y$10$zjAxVwCVieAKNmUli1CyQuITgo4HzFP6oP.0jBEDyJJZ7YkY6tJ0O', 2, 1, 1),
(17, 'machmud@gmail.com', 'Penyewaan Machmud', '$2y$10$JdqbZFV5UIDLQeI8LRI8buGtjagOJUYZY.6HIO.pHbtXzCorQq03m', 2, 1, 1),
(18, 'wijayasewa@gmail.com', 'Wijaya  ', '$2y$10$1kbWuZbCrjwv6H8i8HNqoeBHuSyLJRxRc43B7Z79ZAzBNlQUW3FBG', 2, 1, 1),
(19, 'marlasheila.pieter@gmail.com', 'Marla', '$2y$10$27QP5SGnuEr9LqCXATCq3.FtejjY3bGXtqRhBGClrXsqC35tQzoI6', 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(8) NOT NULL DEFAULT 'plg-0001',
  `nama` varchar(35) NOT NULL,
  `alamat_distrik` varchar(35) NOT NULL,
  `alamat_jalan` text NOT NULL,
  `nm_hp` char(12) NOT NULL,
  `email` varchar(35) NOT NULL,
  `ktp` varchar(25) NOT NULL,
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat_distrik`, `alamat_jalan`, `nm_hp`, `email`, `ktp`, `foto`) VALUES
('plg-0001', 'Samuel', 'Abepura', 'Kotaraja', '082198159714', 'zam.bosawer@gmail.com', 'pl-210707-eabcdb.jpg', 'pl-210707-eabcdb1.jpg'),
('plg-0002', 'demptempat@gmail.com', 'Abepura', 'Kotaraja', '082198112233', 'demptempat@gmail.com', 'pl-210715-afb08d.jpg', 'pl-210715-afb08d1.jpg'),
('plg-0003', 'Marla', 'Muara Tami', 'Jayapura Utara', '082198654323', 'marlasheila.pieter@gmail.com', 'pl-211102-aa2e44.png', 'pl-211102-aa2e441.png');

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `id_sewa` char(7) NOT NULL,
  `pendapatan_tempat` int(11) NOT NULL,
  `pendapatan_admin` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendapatan`
--

INSERT INTO `pendapatan` (`id_pendapatan`, `id_sewa`, `pendapatan_tempat`, `pendapatan_admin`, `tanggal`) VALUES
(1, '1', 17820, 180, '2021-07-07'),
(2, '2', 594000, 6000, '2021-07-07'),
(3, '3', 11880, 120, '2021-07-07'),
(4, '4', 62370, 630, '2021-07-07'),
(5, '5', 594000, 6000, '2021-07-07'),
(6, '6', 4455000, 45000, '2021-07-07'),
(7, '7', 41580, 420, '2021-07-07'),
(8, '8', 2970, 30, '2021-07-08'),
(9, '9', 297000, 3000, '2021-07-08'),
(10, '10', 2970, 30, '2021-07-08'),
(11, '11', 297000, 3000, '2021-07-08'),
(12, '12', 2970, 30, '2021-07-08'),
(13, '13', 47520, 480, '2021-07-08'),
(14, '14', 39600, 400, '2021-07-08'),
(15, '15', 29700, 300, '2021-07-08'),
(16, '16', 2970, 30, '2021-07-08'),
(17, '17', 396000, 4000, '2021-07-08'),
(18, '18', 594000, 6000, '2021-07-08'),
(19, '19', 7920, 80, '2021-07-08'),
(20, '20', 396000, 4000, '2021-07-08'),
(21, '21', 4950, 50, '2021-07-08'),
(22, '22', 1287000, 13000, '2021-07-08'),
(23, '23', 1287000, 13000, '2021-07-08'),
(24, '24', 693000, 7000, '2021-07-08'),
(25, '25', 1485000, 15000, '2021-07-10'),
(26, '26', 594000, 6000, '2021-07-10'),
(27, '27', 891000, 9000, '2021-07-10'),
(28, '28', 990000, 10000, '2021-07-10'),
(29, '29', 1980000, 20000, '2021-07-10'),
(30, '30', 178200, 1800, '2021-07-10'),
(31, '31', 2079000, 21000, '2021-07-10'),
(32, '32', 2970000, 30000, '2021-07-10'),
(33, '33', 6930000, 70000, '2021-07-10'),
(34, '34', 396000, 4000, '2021-07-11'),
(35, '35', 198000, 2000, '2021-07-12'),
(36, '36', 198000, 2000, '2021-07-12'),
(37, '37', 1980000, 20000, '2021-11-02'),
(38, '38', 9820800, 99200, '2021-11-02'),
(39, '39', 34650, 350, '2021-11-02'),
(40, '40', 118800, 1200, '2021-11-02'),
(41, '41', 29700, 300, '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `no_penyewaan` char(17) NOT NULL,
  `id_sewa` int(11) NOT NULL,
  `id_pelanggan` char(8) NOT NULL,
  `id_perlengkapan` char(8) NOT NULL,
  `harga` int(11) NOT NULL,
  `mulai_sewa` date NOT NULL,
  `akhir_sewa` date NOT NULL,
  `jumlah_stok` int(4) NOT NULL,
  `status_sewa` int(1) NOT NULL,
  `status_pembayaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`no_penyewaan`, `id_sewa`, `id_pelanggan`, `id_perlengkapan`, `harga`, `mulai_sewa`, `akhir_sewa`, `jumlah_stok`, `status_sewa`, `status_pembayaran`) VALUES
('sw-1625702927-383', 8, 'plg-0001', 'plk-0002', 3000, '2021-07-08', '2021-07-09', 1, 3, 'settlement'),
('sw-1625716369-322', 13, 'plg-0001', 'plk-0002', 48000, '2021-07-08', '2021-07-16', 1, 3, 'settlement'),
('sw-1625716369-322', 14, 'plg-0001', 'plk-0003', 40000, '2021-07-08', '2021-07-16', 7, 0, 'settlement'),
('sw-1625756723-992', 20, 'plg-0001', 'plk-0004', 400000, '2021-07-08', '2021-07-10', 1, 2, 'settlement'),
('sw-1625759725-943', 21, 'plg-0001', 'plk-0003', 5000, '2021-07-08', '2021-07-10', 1, 3, 'settlement'),
('sw-1625760650-482', 24, 'plg-0001', 'plk-0023', 700000, '2021-07-08', '2021-07-10', 1, 3, 'settlement'),
('sw-1625885061-179', 26, 'plg-0001', 'plk-0001', 600000, '2021-07-10', '2021-07-11', 2, 0, 'settlement'),
('sw-1625925396-428', 27, 'plg-0001', 'plk-0001', 900000, '2021-07-10', '2021-07-11', 3, 3, 'settlement'),
('sw-1625925396-428', 28, 'plg-0001', 'plk-0004', 1000000, '2021-07-10', '2021-07-11', 5, 3, 'settlement'),
('sw-1625927232-817', 29, 'plg-0001', 'plk-0005', 2000000, '2021-07-10', '2021-07-12', 2, 3, 'settlement'),
('sw-1625927232-817', 30, 'plg-0001', 'plk-0014', 180000, '2021-07-10', '2021-07-12', 6, 0, 'settlement'),
('sw-1625927232-817', 31, 'plg-0001', 'plk-0023', 2100000, '2021-07-10', '2021-07-12', 3, 0, 'settlement'),
('sw-1625929384-614', 32, 'plg-0001', 'plk-0005', 3000000, '2021-07-10', '2021-07-12', 3, 3, 'settlement'),
('sw-1625929751-377', 33, 'plg-0001', 'plk-0009', 7000000, '2021-07-10', '2021-07-12', 10, 2, 'settlement'),
('sw-1626011057-341', 34, 'plg-0001', 'plk-0004', 400000, '2021-07-11', '2021-07-12', 1, 1, 'settlement'),
('sw-1626046132-886', 35, 'plg-0001', 'plk-0004', 200000, '2021-07-12', '2021-07-13', 1, 1, 'settlement'),
('sw-1626046270-195', 36, 'plg-0001', 'plk-0004', 200000, '2021-07-12', '2021-07-13', 1, 3, 'settlement'),
('sw-1635834731-816', 37, 'plg-0001', 'plg-0026', 2000000, '2021-11-02', '2021-11-03', 2, 0, 'pending'),
('sw-1635834731-816', 38, 'plg-0001', 'plg-0031', 9920000, '2021-11-02', '2021-11-03', 496, 0, 'pending'),
('sw-1635834731-816', 39, 'plg-0001', 'plk-0007', 35000, '2021-11-02', '2021-11-03', 10, 0, 'pending'),
('sw-1635834731-816', 40, 'plg-0001', 'plk-0030', 120000, '2021-11-02', '2021-11-03', 8, 0, 'pending'),
('sw-1635836634-992', 41, 'plg-0003', 'plk-0029', 30000, '2021-11-02', '2021-11-03', 10, 0, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `perlengkapan`
--

CREATE TABLE `perlengkapan` (
  `id_perlengkapan` char(8) NOT NULL DEFAULT 'plk-0001',
  `nama_perlengkapan` varchar(35) NOT NULL,
  `kategori` varchar(12) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(4) NOT NULL,
  `id_tempat` char(5) NOT NULL,
  `foto` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perlengkapan`
--

INSERT INTO `perlengkapan` (`id_perlengkapan`, `nama_perlengkapan`, `kategori`, `harga`, `stok`, `id_tempat`, `foto`, `deskripsi`) VALUES
('plg-0026', 'Kursi 1000 + Meja 4', 'Paket', 1000000, 2, 'ts-01', 'plk-210714-f9f867.jpg', ' '),
('plg-0031', 'Kursi dan sarung', 'Paket', 20000, 500, 'ts-12', 'plk-210716-cf8cf3.jpg', ' '),
('plk-0001', 'Tenda', 'Perlengkapan', 300000, 5, 'ts-01', 'plk210707-4e59ad.jpg', ' '),
('plk-0002', 'Kursi biasa', 'Perlengkapan', 3000, 1000, 'ts-01', 'plk210707-4b70e1.jpg', 'Kursi Plastik'),
('plk-0003', 'Kursi', 'Perlengkapan', 2500, 200, 'ts-02', 'plk210708-49db66.jpg', ' '),
('plk-0004', 'Meja Prasmanan', 'Perlengkapan', 200000, 5, 'ts-02', 'plk210708-0769d2.png', ' '),
('plk-0005', 'Sound system', 'Perlengkapan', 500000, 3, 'ts-02', 'plk210708-f00bf3.jpg', ' '),
('plk-0006', 'Tenda', 'Perlengkapan', 350000, 3, 'ts-03', 'plk210708-bd6dd9.jpg', ' Tenda 4x6 '),
('plk-0007', 'Kursi', 'Perlengkapan', 3500, 700, 'ts-03', 'plk210708-640686.jpg', ' '),
('plk-0008', 'Piring', 'Perlengkapan', 4000, 1000, 'ts-03', 'plk210708-8ecff2.jpg', ' '),
('plk-0009', 'Tenda biasa', 'perlengkapan', 350000, 13, 'ts-04', 'plk210708-2eb273.jpg', '  Tenda biasa  '),
('plk-0010', 'Kursi', 'Perlengkapan', 3000, 880, 'ts-04', 'plk210708-ce5ef0.jpg', ' '),
('plk-0011', 'Kursi + sarung', 'Paket', 20000, 880, 'ts-04', 'plk-210708-549046.jpg', ' '),
('plk-0012', 'Tenda', 'Perlengkapan', 350000, 40, 'ts-05', 'plk210708-acdff8.jpg', ' '),
('plk-0013', 'Kursi Plastik', 'Perlengkapan', 3000, 2000, 'ts-05', 'plk210708-f5578c.jpg', ' '),
('plk-0014', 'Kursi Chitose', 'Perlengkapan', 15000, 500, 'ts-05', 'plk210708-17ec09.jpg', ' '),
('plk-0015', 'Tenda 4x6 ', 'Perlengkapan', 350000, 10, 'ts-06', 'plk210708-c2a0f8.jpeg', ' Tenda ukuran 4x6 '),
('plk-0016', 'Tenda kecil', 'Perlengkapan', 300000, 5, 'ts-06', 'plk210708-b89f37.jpeg', ' '),
('plk-0017', 'Kursi', 'Perlengkapan', 3500, 5000, 'ts-06', 'plk210708-3325cb.jpg', ' '),
('plk-0018', 'Tenda biasa', 'Perlengkapan', 300000, 10, 'ts-07', 'plk210708-638127.jpg', ' '),
('plk-0019', 'Tenda + Sarung (VIP)', 'Paket', 500000, 10, 'ts-07', 'plk-210708-5dbfa7.jpg', ' '),
('plk-0020', 'Kursi + sarung', 'Paket', 15000, 100, 'ts-07', 'plk-210708-27a5ee.jpg', ' '),
('plk-0021', 'Kursi Plastik', 'Perlengkapan', 2000, 1000, 'ts-07', 'plk210708-1c4463.jpg', ' '),
('plk-0022', 'Kursi Chitose', 'Perlengkapan', 10000, 100, 'ts-07', 'plk210708-403392.jpg', ' '),
('plk-0023', 'Tenda biasa', 'Perlengkapan', 350000, 3, 'ts-08', 'plk210708-0cd1c8.jpg', ' '),
('plk-0024', 'Tenda VIP', 'Perlengkapan', 650000, 3, 'ts-08', 'plk210708-31ae04.jpg', ' '),
('plk-0025', 'Kursi', 'Perlengkapan', 3000, 200, 'ts-08', 'plk210708-5b1119.jpg', ' '),
('plk-0026', 'Tenda', 'Perlengkapan', 350000, 40, 'ts-11', 'plk-210716-2fcf1d.jpeg', ' '),
('plk-0027', 'Kursi Plastik', 'Perlengkapan', 3000, 2000, 'ts-11', 'plk-210716-640bbb.jpg', ' '),
('plk-0028', 'Tenda', 'Perlengkapan', 300000, 10, 'ts-12', 'plk-210716-2fbdbe.jpg', ' '),
('plk-0029', 'Kursi plasti', 'Perlengkapan', 3000, 1000, 'ts-12', 'plk-210716-051328.jpg', ' '),
('plk-0030', 'Kursi Chitose ', 'Perlengkapan', 15000, 500, 'ts-12', 'plk-210716-928d90.jpg', ' '),
('plk-0031', 'Kursi Plastik', 'perlengkapan', 15000, 2000, 'ts-13', 'T.jpg', '           '),
('plk-0032', 'Tenda ', 'perlengkapan', 350000, 30, 'ts-13', 'plk-210718-b8ad40.jpg', '           ');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` char(8) NOT NULL DEFAULT 'rtg-0001',
  `id_tempat` char(5) NOT NULL,
  `id_pelanggan` char(8) NOT NULL,
  `jumlah_rating` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `id_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_tempat`, `id_pelanggan`, `jumlah_rating`, `komentar`, `id_sewa`) VALUES
('rtg-0001', 'ts-01', 'plg-0001', 4, 'Terbaik', 0),
('rtg-0002', 'ts-01', 'plg-0001', 3, '', 8),
('rtg-0003', 'ts-02', 'plg-0001', 4, 'Keren', 14),
('rtg-0004', 'ts-01', 'plg-0001', 1, '', 13),
('rtg-0005', 'ts-02', 'plg-0001', 4, '', 20),
('rtg-0006', 'ts-02', 'plg-0001', 1, '', 21),
('rtg-0007', 'ts-08', 'plg-0001', 2, 'Sipp ya\r\n', 24),
('rtg-0008', 'ts-01', 'plg-0001', 3, 'Kalas', 26),
('rtg-0009', 'ts-02', 'plg-0001', 4, 'Mantap', 28),
('rtg-0010', 'ts-01', 'plg-0001', 4, '', 27),
('rtg-0011', 'ts-02', 'plg-0001', 2, '', 29),
('rtg-0012', 'ts-02', 'plg-0001', 3, 'Mantap\r\n', 32),
('rtg-0013', 'ts-02', 'plg-0001', 4, 'pELAYAN CEPAT', 36);

-- --------------------------------------------------------

--
-- Table structure for table `tempat_sewa`
--

CREATE TABLE `tempat_sewa` (
  `id_tempat` char(5) NOT NULL DEFAULT 'ts-01',
  `nama_tempat` varchar(35) NOT NULL,
  `alamat_distrik` varchar(35) NOT NULL,
  `alamat_jalan` text NOT NULL,
  `nm_hp` char(12) NOT NULL,
  `email` varchar(25) NOT NULL,
  `ktp` varchar(25) NOT NULL,
  `siup` varchar(25) NOT NULL,
  `peta_google` text NOT NULL,
  `logo` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempat_sewa`
--

INSERT INTO `tempat_sewa` (`id_tempat`, `nama_tempat`, `alamat_distrik`, `alamat_jalan`, `nm_hp`, `email`, `ktp`, `siup`, `peta_google`, `logo`) VALUES
('ts-01', 'Udin', 'Abepura', 'Kotaraja Dalam', '08219876457', 'udinsewa@gmail.com', 'kt-210707-7ad986.jpg', 'kt-210707-7ad9861.jpg', '', 'kt-210707-7ad9862.jpg'),
('ts-02', 'Cv. Yapo ', 'Abepura', 'Perumahan binamarga ', '081234832912', 'yapo22@gmail.com', 'kt-210708-80d754.jpg', 'kt-210708-80d7541.jpg', '', 'kt-210708-80d7542.jpg'),
('ts-03', 'Cv. Citra jaya ', 'Abepura', 'BTN Kamkey', '082198764571', 'citra@gmail.com', 'kt-210708-5f14d6.jpg', 'kt-210708-5f14d61.jpg', '', 'kt-210708-5f14d62.jpg'),
('ts-04', 'Cv Siam', 'Heram', 'Perumnas 1 Jalan Ondikeleuw rumah n', '085244547472', 'vcsiam@gmail.com', 'kt-210708-1817be.jpg', 'kt-210708-1817be1.jpg', '', 'kt-210708-1817be2.jpg'),
('ts-05', 'CV. Karya M', 'Jayapura Selatan', 'Entrop', '081244090912', 'karya22@gmail.com', 'kt-210708-179ecf.jpg', 'kt-210708-179ecf1.jpg', 'https://goo.gl/maps/QwL2yeQHZdorvNAE6', 'kt-210708-179ecf2.jpg'),
('ts-06', 'Pennyewaan Siloam', 'Heram', 'Jemaat Siloam', '082144986732', 'sesiloam@gmail.com', 'kt-210708-c23531.jpg', 'kt-210708-c235311.jpg', 'https://goo.gl/maps/pFgxeQzQwz7u5HS7A', 'kt-210708-c235312.jpg'),
('ts-08', 'Chilestachi', 'Jayapura Utara', 'Jalan Mariam No. 33 Dok 5 Atas', '081344505436', 'chilestachi@gmail.com', 'kt-210708-aede1e.jpg', 'kt-210708-aede1e1.jpg', '', 'kt-210708-aede1e2.jpg'),
('ts-09', 'Solata', 'Jayapura Selatan', 'Pasar hamadi', '081228732812', 'solatapapua@gmail.com', 'kt-210716-09aedf.jpg', 'kt-210716-09aedf1.jpg', '', 'kt-210716-09aedf2.jpg'),
('ts-10', 'Daeng Sewa', 'Jayapura Selatan', 'Argapura', '085254664475', 'daaengpapua@gmail.com', 'kt-210716-1fafd6.jpg', 'kt-210716-1fafd61.jpg', '', 'kt-210716-1fafd62.jpg'),
('ts-11', 'Exotic Sewa', 'Jayapura Utara', 'Mandala', '081248393212', 'exoticmandala@gmail.com', 'kt-210716-c45616.jpeg', 'kt-210716-c45616.jpg', 'https://goo.gl/maps/1NgHgfd5V1bvnnqQA', 'kt-210716-c456161.jpg'),
('ts-12', 'Penyewaan Machmud', 'Jayapura Utara', 'Tj. Ria', '081344450112', 'machmud@gmail.com', '1622647748.jpg', 'kt-210716-7061971.jpg', 'https://goo.gl/maps/42E6Rn5Trr9USnhZ6', 'logo.jpg'),
('ts-13', 'Wijaya  ', 'Muara Tami', 'Jl. Durian 2 Koya Timur', '082198562112', 'wijayasewa@gmail.com', 'kt-210718-48f452.jpg', 'kt-210718-48f4521.jpg', 'https://goo.gl/maps/nawPxcKYnPA9rhaA8', 'kt-210718-48f4522.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `token_daftar`
--

CREATE TABLE `token_daftar` (
  `id` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `token` varchar(255) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token_daftar`
--

INSERT INTO `token_daftar` (`id`, `email`, `token`, `tgl_daftar`) VALUES
(2, 'udinsewa@gmail.com', 'slPU1v29yYL+Aa3kOhKRuoEe8u/dBTI0uBb6+h+vJ2Q=', '2021-07-07'),
(4, 'yapo22@gmail.com', 'CjPNL6fugDvTljvRhBcE2uRGDq5ySlRP1Jrbger4Wfk=', '2021-07-08'),
(5, 'citra@gmail.com', 'h0A7W5kwCZW7RR4GvBX3vLM+/bAWDkRCr/mm2YZu4u0=', '2021-07-08'),
(6, 'vcsiam@gmail.com', 'k7fv7rmc7VU+iaQuL/1xubpdKZgcmFkxecGh5Z2xC5E=', '2021-07-08'),
(7, 'karya22@gmail.com', '5rE8VzvFKDlllgQTSw8POArDokQVWvslVPOmSg3RA8Y=', '2021-07-08'),
(8, 'sesiloam@gmail.com', 'sIV+Lk0dBNKrum9D6fy340DLfBU41vF+RCf2J8b+W+w=', '2021-07-08'),
(9, 'str@gmail.com', '4dUlHFz37FuwsI63ofl9AVzpBiTxeZqiRRUXm2dhCfc=', '2021-07-08'),
(10, 'chilestachi@gmail.com', 'Lhb5dHXTDmqiMeDi0k6pKGY9cTtOA3bl43tPLt5AYZE=', '2021-07-08'),
(12, 'solatapapua@gmail.com', 'pUzXOXjaIZ0sG3YBVddGdaTgaUKlWYMPS8D3FiE0r4Y=', '2021-07-16'),
(13, 'daaengpapua@gmail.com', 'IhU6r683S7Onhay+azb5rfDQFu+8ecPFPjJ7agpgX+Y=', '2021-07-16'),
(14, 'exoticmandala@gmail.com', 'yJtNB9F1PaZH5kN5m4DokjpVi2oKbmSF16EySUr7aa4=', '2021-07-16'),
(15, 'machmud@gmail.com', 'qYeJ3AuwjOiYPn5YTV+RFtncPbSFQuwpyTXFwRU6V1I=', '2021-07-16'),
(16, 'wijayasewa@gmail.com', '5oDwDMSFQpxI5jO09sDRdKZl2hKwXRe3p2G6uVOjOls=', '2021-07-18'),
(19, 'marlasheila.pieter@gmail.com', '/Eq2OR8ffhKusEgLbVCGrrnhNE+ANmtaN0DqVGwD8Es=', '2021-11-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_ranjang`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indexes for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  ADD PRIMARY KEY (`id_perlengkapan`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `tempat_sewa`
--
ALTER TABLE `tempat_sewa`
  ADD PRIMARY KEY (`id_tempat`);

--
-- Indexes for table `token_daftar`
--
ALTER TABLE `token_daftar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `token_daftar`
--
ALTER TABLE `token_daftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
