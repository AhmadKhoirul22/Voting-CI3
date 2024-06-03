-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 03 Jun 2024 pada 02.05
-- Versi server: 8.0.31
-- Versi PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahmad-vote`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(64) NOT NULL,
  `level` varchar(15) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Ahmad', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin'),
(3, 'haiii', 'Pemilih Setia', '72ccaac2011f355b90d858e95e9961c0', 'Pemilih'),
(4, 'rzyen', 'ryzen', '0a982909948c6dd8f5697dee7acf25eb', 'Pemilih'),
(5, 'luxxy', 'luxxy', 'e5f72824245e824d3eae99fcd5418135', 'Pemilih'),
(6, 'zuxxy', 'zuxxy', '67391578c8c755ba13160626e56bb9fc', 'Pemilih'),
(7, 'coboy', 'coboy', '8a182911887b12622e47fcba1d832828', 'Pemilih'),
(8, 'coach', 'coach', 'f931b13aead002d7fcdb02f84e0f794f', 'Pemilih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ikut`
--

DROP TABLE IF EXISTS `ikut`;
CREATE TABLE IF NOT EXISTS `ikut` (
  `id_ikut` int NOT NULL AUTO_INCREMENT,
  `id_voting` int NOT NULL,
  `id_admin` int NOT NULL,
  `waktu` date NOT NULL,
  PRIMARY KEY (`id_ikut`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ikut_kandidat`
--

DROP TABLE IF EXISTS `ikut_kandidat`;
CREATE TABLE IF NOT EXISTS `ikut_kandidat` (
  `id_ikut_kandidat` int NOT NULL AUTO_INCREMENT,
  `id_voting` int NOT NULL,
  `id_kandidat` int NOT NULL,
  `poin` int NOT NULL,
  PRIMARY KEY (`id_ikut_kandidat`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `ikut_kandidat`
--

INSERT INTO `ikut_kandidat` (`id_ikut_kandidat`, `id_voting`, `id_kandidat`, `poin`) VALUES
(14, 8, 7, 0),
(13, 8, 6, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kandidat`
--

DROP TABLE IF EXISTS `kandidat`;
CREATE TABLE IF NOT EXISTS `kandidat` (
  `id_kandidat` int NOT NULL AUTO_INCREMENT,
  `nama_kandidat` varchar(45) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kandidat`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nama_kandidat`, `keterangan`, `foto`) VALUES
(6, 'Ahmad', 'NPC kelas', '20240228041226.jpg'),
(7, 'Khoirul', 'NPC kelas', '20240228041238.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `voting`
--

DROP TABLE IF EXISTS `voting`;
CREATE TABLE IF NOT EXISTS `voting` (
  `id_voting` int NOT NULL AUTO_INCREMENT,
  `nama_voting` varchar(50) NOT NULL,
  PRIMARY KEY (`id_voting`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `voting`
--

INSERT INTO `voting` (`id_voting`, `nama_voting`) VALUES
(8, 'on top');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
