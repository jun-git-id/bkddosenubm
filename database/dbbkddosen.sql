-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2019 at 06:26 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbkddosen`
--
CREATE DATABASE IF NOT EXISTS `dbbkddosen` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbbkddosen`;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nidn` int(10) DEFAULT NULL,
  `nama_dosen` varchar(50) DEFAULT NULL,
  `email_dosen` varchar(50) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tgl_lahir` varchar(20) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `jabatan` varchar(55) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nidn`, `nama_dosen`, `email_dosen`, `jenis_kelamin`, `tgl_lahir`, `telepon`, `jabatan`, `foto`) VALUES
(2, 123456789, 'Abiel Filetus', 'abielf@ubm.ac.id', 'L', '30/04/1997', '081234567890', 'Dosen Tetap', 'http://localhost/bkddosen/assets/foto_dosen/123456789.jpg'),
(4, 124123, 'Mariyus', 'marius@ubm.ac.id', 'L', '10/11/1999', '0812321498', 'Dosen Kontrak', 'http://localhost/bkddosen/assets/foto_dosen/124123124123.png'),
(5, 1241235, 'Mariyus', 'marius@ubm.ac.id', 'L', '10/11/1999', '0812321498', 'Dosen Kontrak', 'http://localhost/bkddosen/assets/foto_dosen/12412351241235.png'),
(7, 1241236, 'Mariyus', 'marius@ubm.ac.id', 'L', '10/11/1999', '0812321498', 'Dosen Kontrak', 'http://localhost/bkddosen/assets/foto_dosen/12412361241236.png'),
(8, 1234567890, 'Abiel Filetus', 'abiel@ubm.ac.id', 'L', '30/04/1997', '081234567890', 'Dosen Tetap', 'http://localhost/bkddosen/assets/foto_dosen/1234567890.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

DROP TABLE IF EXISTS `mata_kuliah`;
CREATE TABLE `mata_kuliah` (
  `id_matkul` int(11) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `sks` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_matkul`, `nama_matkul`, `sks`) VALUES
(2, 'Aljabar Linear', 4),
(3, 'Pemrograman Dasar', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

DROP TABLE IF EXISTS `mengajar`;
CREATE TABLE `mengajar` (
  `id_mengajar` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `tahun_ajaran` varchar(20) DEFAULT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `sk_mengajar` text DEFAULT NULL,
  `sks` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`id_mengajar`, `id_dosen`, `tahun_ajaran`, `id_matkul`, `sk_mengajar`, `sks`) VALUES
(7, 2, '08/2018', 2, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

DROP TABLE IF EXISTS `penelitian`;
CREATE TABLE `penelitian` (
  `id_penelitian` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `semester_penelitian` varchar(20) DEFAULT NULL,
  `tahun_penelitian` varchar(20) DEFAULT NULL,
  `judul_penelitian` varchar(55) DEFAULT NULL,
  `biaya_penelitian` int(12) DEFAULT NULL,
  `lokasi_penelitian` text DEFAULT NULL,
  `anggota_penelitian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian`
--

DROP TABLE IF EXISTS `pengabdian`;
CREATE TABLE `pengabdian` (
  `id_pengabdian` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `semester_pengabdian` varchar(20) DEFAULT NULL,
  `tahun_pengabdian` varchar(20) DEFAULT NULL,
  `anggota_pengabdian` int(11) DEFAULT NULL,
  `mitra_pengabdian` varchar(55) DEFAULT NULL,
  `alamat_mitra` text DEFAULT NULL,
  `sampul_laporan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengabdian`
--

INSERT INTO `pengabdian` (`id_pengabdian`, `id_dosen`, `semester_pengabdian`, `tahun_pengabdian`, `anggota_pengabdian`, `mitra_pengabdian`, `alamat_mitra`, `sampul_laporan`) VALUES
(1, 2, 'Ganjil', '08/2019', 5, 'Tes judul', 'UBM', 'http://localhost/bkddosen/assets/pengabdian/2-082019-Ganjil-Tes_judul.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penunjang`
--

DROP TABLE IF EXISTS `penunjang`;
CREATE TABLE `penunjang` (
  `id_penunjang` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `semester_penunjang` varchar(20) DEFAULT NULL,
  `tahun_penunjang` varchar(20) DEFAULT NULL,
  `jenis_kegiatan` varchar(50) DEFAULT NULL,
  `topik_penunjang` varchar(100) DEFAULT NULL,
  `tempat_penunjang` text DEFAULT NULL,
  `tgl_pelaksanaan` varchar(25) DEFAULT NULL,
  `penyelenggara_penunjang` varchar(100) DEFAULT NULL,
  `sertifikat_penunjang` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penunjang`
--

INSERT INTO `penunjang` (`id_penunjang`, `id_dosen`, `semester_penunjang`, `tahun_penunjang`, `jenis_kegiatan`, `topik_penunjang`, `tempat_penunjang`, `tgl_pelaksanaan`, `penyelenggara_penunjang`, `sertifikat_penunjang`) VALUES
(1, 2, 'Ganjil', '08/2019', 'Seminar', 'Data Scientist', 'UBM', '15/06/2019', 'UBM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publikasi`
--

DROP TABLE IF EXISTS `publikasi`;
CREATE TABLE `publikasi` (
  `id_publikasi` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `jenis_buku` varchar(55) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publikasi`
--

INSERT INTO `publikasi` (`id_publikasi`, `id_dosen`, `judul_buku`, `jenis_buku`, `isbn`, `penerbit`, `tahun_terbit`) VALUES
(1, 2, 'Data Structure', 'Buku', '12345', 'UBM', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
CREATE TABLE `user_login` (
  `id_user` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id_user`, `email`, `password`) VALUES
(2, 'marius@ubm.ac.id', '7df7723acf1b32c9ecd3fdf7f196303e'),
(3, 'abielf@ubm.ac.id', 'cfc5ec449054555d1e7c6eb5224ca626');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`id_mengajar`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id_penelitian`);

--
-- Indexes for table `pengabdian`
--
ALTER TABLE `pengabdian`
  ADD PRIMARY KEY (`id_pengabdian`);

--
-- Indexes for table `penunjang`
--
ALTER TABLE `penunjang`
  ADD PRIMARY KEY (`id_penunjang`);

--
-- Indexes for table `publikasi`
--
ALTER TABLE `publikasi`
  ADD PRIMARY KEY (`id_publikasi`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mengajar`
--
ALTER TABLE `mengajar`
  MODIFY `id_mengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id_penelitian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengabdian`
--
ALTER TABLE `pengabdian`
  MODIFY `id_pengabdian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penunjang`
--
ALTER TABLE `penunjang`
  MODIFY `id_penunjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `publikasi`
--
ALTER TABLE `publikasi`
  MODIFY `id_publikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
