-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 05:46 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kursus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `nama_admin`, `no_hp`) VALUES
(1, 'admin', 'adminisii', '78666'),
(2, 'admin1', 'admin1', '8768677');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nip`, `nama_kelas`) VALUES
(1, 67575, 'nama1'),
(3, 33223, 'jb');

-- --------------------------------------------------------

--
-- Table structure for table `kelaspeserta`
--

CREATE TABLE `kelaspeserta` (
  `id_kp` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelaspeserta`
--

INSERT INTO `kelaspeserta` (`id_kp`, `id_kelas`, `id_peserta`) VALUES
(1, 1, 3),
(4, 3, 2),
(5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_materi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `nip`, `id_kelas`, `nama_materi`) VALUES
(2, 67575, 3, 'Program 2'),
(3, 33223, 1, 'Program 1'),
(4, 67575, 3, 'Program 4');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_pengajar` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nilai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_pengajar`, `id_peserta`, `id_materi`, `id_kelas`, `nilai`) VALUES
(3, 33223, 1, 2, 3, '45'),
(4, 33223, 2, 2, 3, '55'),
(5, 33223, 1, 2, 3, '77'),
(6, 33223, 2, 2, 3, '77'),
(8, 33223, 2, 4, 3, '100'),
(9, 33223, 1, 2, 0, '12'),
(10, 33223, 2, 2, 0, '21');

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

CREATE TABLE `pengajar` (
  `nip` int(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_pengajar` varchar(250) NOT NULL,
  `alamat_pengajar` text NOT NULL,
  `no_hp` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajar`
--

INSERT INTO `pengajar` (`nip`, `username`, `nama_pengajar`, `alamat_pengajar`, `no_hp`) VALUES
(3141, '', 'dvv', 'vdv', '8676'),
(33223, 'pengajar', 'Guru2', 'huhu', '43343');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `username`, `nama_peserta`, `alamat`, `nohp`) VALUES
(1, 'peserta', 'Rudianto', 'sumberan', '085236115299'),
(2, '', 'Rudi2', 'dn', '98797'),
(3, '', 'rudi', 'flnjnkj', '98997'),
(4, 'rudiii', 'rudiii', 'rudiii', '798787'),
(5, 'rud11', 'rud11', 'rud11', '435354');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `level`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '0'),
(2, 'pengajar', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '1'),
(3, 'peserta', 'ee2b554af530f2962f1e9ad8e1ca20c59f4b8108', '2'),
(4, 'rud11', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(5, 'admin1', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', '0'),
(6, 'jnj', 'd3ab8e31be411d3c834471ad7c825b6c40120d9d', '0'),
(13, 'hhh1', 'effdb5f96a28acd2eb19dcb15d8f43af762bd0ae', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kelaspeserta`
--
ALTER TABLE `kelaspeserta`
  ADD PRIMARY KEY (`id_kp`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelaspeserta`
--
ALTER TABLE `kelaspeserta`
  MODIFY `id_kp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `nip` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33224;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
