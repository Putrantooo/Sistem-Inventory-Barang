-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 17 Sep 2020 pada 17.08
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_junada`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bahan`
--

DROP TABLE IF EXISTS `tb_bahan`;
CREATE TABLE IF NOT EXISTS `tb_bahan` (
  `kode_bahan` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `nama_bahan` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`kode_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bahan`
--

INSERT INTO `tb_bahan` (`kode_bahan`, `nama_bahan`, `stok`, `harga`) VALUES
('KOM01', 'Kayu ', 2, 12550);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detailbeli`
--

DROP TABLE IF EXISTS `tb_detailbeli`;
CREATE TABLE IF NOT EXISTS `tb_detailbeli` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembelian` varchar(10) NOT NULL,
  `kode_bahan` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `kode_supplier` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `Harga` double NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Total` double NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detailbeli`
--

INSERT INTO `tb_detailbeli` (`kode`, `id_pembelian`, `kode_bahan`, `kode_supplier`, `Harga`, `Jumlah`, `Total`) VALUES
(11, 'PEM002', 'KOM3', 'PEM01', 12550, 3, 37650),
(12, 'PEM002', 'KOM1', 'PEM01', 12001, 4, 48004);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detailmutasi`
--

DROP TABLE IF EXISTS `tb_detailmutasi`;
CREATE TABLE IF NOT EXISTS `tb_detailmutasi` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `kd_mutasi` varchar(10) NOT NULL,
  `kd_payung` varchar(10) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `Total` double NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detailmutasi`
--

INSERT INTO `tb_detailmutasi` (`kode`, `kd_mutasi`, `kd_payung`, `harga`, `jumlah`, `Total`) VALUES
(25, 'MUT001', 'P002', 11501, 2, 23002);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detailproduksi`
--

DROP TABLE IF EXISTS `tb_detailproduksi`;
CREATE TABLE IF NOT EXISTS `tb_detailproduksi` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `kd_produksi` varchar(10) NOT NULL,
  `kode_bahan` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detailproduksi`
--

INSERT INTO `tb_detailproduksi` (`kode`, `kd_produksi`, `kode_bahan`, `jumlah`) VALUES
(1, 'PRO11', 'KOM1', 10),
(2, 'PRO11', 'KOM1', 10),
(3, 'PRO11', 'KOM1', 50),
(4, 'PRO11', 'KOM1', 40),
(5, 'PRO11', 'KOM1', 10),
(6, 'PRO11', 'KOM1', 10),
(7, 'PRO11', 'KOM2', 2),
(11, 'PRO11', 'KOM1', 10),
(12, 'PRO11', 'KOM1', 10),
(13, 'PRO11', 'KOM2', 10),
(17, 'PRO11', 'KOM2', 11),
(18, 'PRO11', 'KOM2', 10),
(19, 'PRO11', 'KOM2', 10),
(20, 'PRO11', 'KOM2', 2),
(21, 'PRO11', 'KOM2', 10),
(22, 'PRO11', 'KOM2', 10),
(23, 'PRO11', 'KOM1', 12),
(24, 'PRO11', 'KOM2', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

DROP TABLE IF EXISTS `tb_kategori`;
CREATE TABLE IF NOT EXISTS `tb_kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama`) VALUES
('KAT01', 'Payung biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

DROP TABLE IF EXISTS `tb_login`;
CREATE TABLE IF NOT EXISTS `tb_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `nama_lengkap` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `nama_lengkap`, `password`, `image`) VALUES
(3, 'yayu', 'putranto', '12345', '2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mutasi`
--

DROP TABLE IF EXISTS `tb_mutasi`;
CREATE TABLE IF NOT EXISTS `tb_mutasi` (
  `kd_mutasi` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `Tanggal` date NOT NULL,
  PRIMARY KEY (`kd_mutasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mutasi`
--

INSERT INTO `tb_mutasi` (`kd_mutasi`, `Tanggal`) VALUES
('MUT001', '2020-06-03'),
('MUT002', '2020-08-05'),
('MUT003', '2020-08-06'),
('MUT004', '2020-08-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_payung`
--

DROP TABLE IF EXISTS `tb_payung`;
CREATE TABLE IF NOT EXISTS `tb_payung` (
  `kd_payung` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `Nama` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `id_kategori` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `Stok` int(11) NOT NULL,
  `Harga` double NOT NULL,
  PRIMARY KEY (`kd_payung`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_payung`
--

INSERT INTO `tb_payung` (`kd_payung`, `Nama`, `id_kategori`, `Stok`, `Harga`) VALUES
('P002', 'Payung Merah size s', 'KAT01', 128, 11501),
('PAY03', 'Payung Unyil Biru', 'KAT01', 14, 11501);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

DROP TABLE IF EXISTS `tb_pembelian`;
CREATE TABLE IF NOT EXISTS `tb_pembelian` (
  `id_pembelian` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `Tanggal` date NOT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `Tanggal`) VALUES
('2', '2020-06-15'),
('4', '2020-07-03'),
('5', '2020-07-01'),
('6', '2020-07-01'),
('7', '2020-07-01'),
('PEM001', '2020-07-07'),
('PEM002', '2020-07-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produksi`
--

DROP TABLE IF EXISTS `tb_produksi`;
CREATE TABLE IF NOT EXISTS `tb_produksi` (
  `kd_produksi` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `Tanggal` date NOT NULL,
  PRIMARY KEY (`kd_produksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_produksi`
--

INSERT INTO `tb_produksi` (`kd_produksi`, `Tanggal`) VALUES
('PRO1', '2020-08-03'),
('PRO11', '2020-06-02'),
('PRO2', '2020-08-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produksifix`
--

DROP TABLE IF EXISTS `tb_produksifix`;
CREATE TABLE IF NOT EXISTS `tb_produksifix` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `kd_produksi` varchar(10) NOT NULL,
  `kd_payung` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produksifix`
--

INSERT INTO `tb_produksifix` (`kode`, `kd_produksi`, `kd_payung`, `jumlah`) VALUES
(7, 'PRO1', 'P002', 30),
(8, 'PRO11', 'PAY03', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_suplier`
--

DROP TABLE IF EXISTS `tb_suplier`;
CREATE TABLE IF NOT EXISTS `tb_suplier` (
  `kode_supplier` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 NOT NULL,
  `telp` varchar(13) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_suplier`
--

INSERT INTO `tb_suplier` (`kode_supplier`, `nama`, `alamat`, `telp`) VALUES
('2', 'akpin gilangs', 'sdsabsjfbaj', '089765123567'),
('PEM01', 'Solikin', 'Sleman', '085223935073'),
('PEM02', 'Paiyah', 'bantul', '085223935073'),
('qw2', 'Solikin', 'jlaasas', '085223935073'),
('qw23', 'Solikin', 'jlaasas', '085223935073'),
('SUP04', 'Solikin', 'Bantul', '085223935073');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
