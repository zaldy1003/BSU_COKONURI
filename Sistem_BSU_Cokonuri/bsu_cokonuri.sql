-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 04:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsu_cokonuri`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `catatTransaksi` (IN `idNasabahIn` INT, IN `idPengelolaIn` INT, IN `idJenisSampahIn` INT, IN `beratIn` FLOAT, IN `deskripsiIn` TEXT)   BEGIN
    DECLARE harga FLOAT;
    DECLARE total FLOAT;
    DECLARE poin FLOAT;
    DECLARE tanggal DATETIME;
    DECLARE sampah VARCHAR(50);
    -- Ambil harga per KG dari tabel pengaturan_transaksi
    SELECT hargaPerKG INTO harga
    FROM Pengaturan_transaksi
    WHERE id = idJenisSampahIn;
    -- Hitung total harga dan poin
    SET total = beratIn * harga;
    SET poin = FLOOR(total / 1000); -- 1 poin per 1000 rupiah
    SET tanggal = NOW();
    SELECT jenisSampah INTO sampah FROM Pengaturan_transaksi WHERE id = idJenisSampahIn;
    -- Masukkan transaksi ke tabel
    INSERT INTO Transaksi_sampah (idPengelola, idNasabah, idJenisSampah, tanggalWaktu, beratSampah, totalPoinTransaksi, deskripsi)
    VALUES (idPengelolaIn, idNasabahIn, idJenisSampahIn, tanggal, beratIn, poin, deskripsiIn);
    -- Tampilkan hasil kalkulasi
    SELECT beratIn AS `Berat Sampah(KG)`, sampah AS `Jenis Sampah`, total AS `Total Harga`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusJenisSampah` (IN `idIn` INT)   BEGIN
    DELETE FROM Pengaturan_transaksi
    WHERE id = idIn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusNasabah` (IN `idIn` INT)   BEGIN
    DELETE FROM Nasabah WHERE id = idIn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusPengelola` (IN `idIn` INT)   BEGIN
    DELETE FROM Pengelola
    WHERE id = idIn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hitungNasabah` ()   BEGIN
    SELECT COUNT(*) AS jumlah_nasabah FROM Nasabah;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hitungTotalTransaksi` ()   BEGIN
    SELECT COUNT(*) AS total_transaksi FROM transaksi_sampah;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahJenisSampah` (IN `jenisSampahIn` VARCHAR(100), IN `hargaPerKGIn` FLOAT)   BEGIN
    INSERT INTO Pengaturan_transaksi (jenisSampah, hargaPerKG)
    VALUES (jenisSampahIn, hargaPerKGIn);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahNasabah` (IN `nama` VARCHAR(100), IN `kontakIn` VARCHAR(15), IN `alamatIn` TEXT, IN `jumlahTransaksiIn` INT)   BEGIN
    INSERT INTO Nasabah (namaNasabah, kontak, alamat, jumlahTransaksi)
    VALUES (nama, kontakIn, alamatIn, jumlahTransaksiIn);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahPengelola` (IN `usernameIn` VARCHAR(100), IN `passwordIn` VARCHAR(255), IN `kontakIn` VARCHAR(15))   BEGIN
    INSERT INTO Pengelola (username, password, kontak)
    VALUES (usernameIn, passwordIn, kontakIn);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilJenisSampah` ()   BEGIN
    SELECT * FROM Pengaturan_transaksi;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilJumlahBeratSampahperBulan` (IN `monthIn` VARCHAR(5), IN `yearIn` VARCHAR(5))   BEGIN
    SELECT SUM(beratSampah) AS berat_sampah
    FROM transaksi_sampah
    WHERE MONTH(tanggalWaktu) = monthIn  AND YEAR(tanggalWaktu) = yearIn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilJumlahPoinperBulan` (IN `monthIn` VARCHAR(5), IN `yearIn` VARCHAR(5))   BEGIN
    SELECT SUM(totalPoinTransaksi) AS total_poin
    FROM transaksi_sampah
    WHERE MONTH(tanggalWaktu) = monthIn  AND YEAR(tanggalWaktu) = yearIn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilJumlahTransaksiperBulan` (IN `monthIn` VARCHAR(5), IN `yearIn` VARCHAR(5))   BEGIN
    SELECT COUNT(*) as total_transaksi 
    from transaksi_sampah 
    WHERE MONTH(tanggalWaktu) = monthIn AND YEAR(tanggalWaktu) = yearIn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilNasabah` ()   BEGIN
    SELECT * FROM Nasabah;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilPengelola` ()   BEGIN
    SELECT * FROM Pengelola;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilSampah` ()   BEGIN
    SELECT * FROM Pengaturan_transaksi;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilTableLaporan` (IN `monthIn` VARCHAR(5), IN `yearIn` VARCHAR(5))   BEGIN
    SELECT 
    p.jenisSampah AS jenis,
    COUNT(ts.id) AS total_transaksi,
    SUM(ts.beratSampah) AS total_berat
        FROM 
    transaksi_sampah ts
        JOIN 
    pengaturan_transaksi p
        ON 
    ts.idJenisSampah = p.id
        WHERE 
    MONTH(ts.tanggalWaktu) = monthIn
    AND YEAR(ts.tanggalWaktu) = yearIn
        GROUP BY 
    p.jenisSampah;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilTransaksiSampahTerbanyak` ()   BEGIN
        SELECT pt.jenisSampah, 
        COUNT(ts.idJenisSampah) AS jumlah_transaksi
        FROM 
            transaksi_sampah ts
        JOIN 
            pengaturan_transaksi pt
        ON 
            ts.idJenisSampah = pt.id
        GROUP BY 
            pt.jenisSampah
        ORDER BY 
            jumlah_transaksi DESC
        LIMIT 1;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateJenisSampah` (IN `idIn` INT, IN `jenisSampahIn` VARCHAR(100), IN `hargaPerKGIn` FLOAT)   BEGIN
    UPDATE Pengaturan_transaksi
    SET 
        jenisSampah = jenisSampahIn,
        hargaPerKG = hargaPerKGIn
    WHERE id = idIn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateNasabah` (IN `idIn` INT, IN `namaIn` VARCHAR(100), IN `kontakIn` VARCHAR(15), IN `alamatIn` TEXT, IN `jumlahTransaksiIn` INT)   BEGIN
    UPDATE Nasabah SET 
        namaNasabah = namaIn,
        kontak = kontaIn,
        alamat = alamatIn,
        jumlahTransaksi = jumlahTransaksiIn
    WHERE id = idIn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePengelola` (IN `idIn` INT, IN `usernameIn` VARCHAR(100), IN `passwordIn` VARCHAR(255), IN `kontakIn` VARCHAR(15))   BEGIN
    UPDATE Pengelola
    SET 
        username = usernameIn,
        password = passwordIn,
        kontak = kontakIn
    WHERE id = idIn;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL,
  `namaNasabah` varchar(255) DEFAULT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jumlahTransaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`createAt`, `id`, `namaNasabah`, `kontak`, `alamat`, `jumlahTransaksi`) VALUES
('2024-12-06 06:33:13', 1, 'Asep', '08135512123', 'jln. Cokonuri Antartika', 0),
('2024-12-06 06:33:59', 2, 'Asep', '08135512123', 'jln. Cokonuri Antartika', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_transaksi`
--

CREATE TABLE `pengaturan_transaksi` (
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL,
  `jenisSampah` varchar(255) DEFAULT NULL,
  `hargaPerKG` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan_transaksi`
--

INSERT INTO `pengaturan_transaksi` (`createAt`, `id`, `jenisSampah`, `hargaPerKG`) VALUES
('2024-12-06 13:26:30', 1, 'Plastik', 5000),
('2024-12-06 13:53:10', 2, 'Kardus', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `pengelola`
--

CREATE TABLE `pengelola` (
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `kontak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengelola`
--

INSERT INTO `pengelola` (`createAt`, `id`, `username`, `password`, `kontak`) VALUES
('2024-12-06 13:27:47', 1, 'Yani', 'admin', '081329298473');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_sampah`
--

CREATE TABLE `transaksi_sampah` (
  `id` int(11) NOT NULL,
  `idPengelola` int(11) DEFAULT NULL,
  `idNasabah` int(11) DEFAULT NULL,
  `idJenisSampah` int(11) DEFAULT NULL,
  `tanggalWaktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `beratSampah` float DEFAULT NULL,
  `totalPoinTransaksi` float DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_sampah`
--

INSERT INTO `transaksi_sampah` (`id`, `idPengelola`, `idNasabah`, `idJenisSampah`, `tanggalWaktu`, `beratSampah`, `totalPoinTransaksi`, `deskripsi`) VALUES
(1, 1, 1, 1, '2024-12-06 13:49:25', 10, 50, 'sampah botol plastik'),
(2, 1, 1, 1, '2024-12-06 13:49:25', 10, 50, 'sampah botol plastik'),
(3, 1, 1, 1, '2024-12-06 13:50:44', 20, 100, 'sampah botol plastik'),
(4, 1, 1, 1, '2024-12-06 13:50:58', 20, 100, 'sampah botol plastik'),
(5, 1, 1, 1, '2024-12-06 13:51:56', 20, 100, 'sampah botol plastik'),
(6, 1, 1, 2, '2024-12-06 13:53:57', 10, 60, 'sampah Kardus TV'),
(7, 1, 2, 2, '2024-12-06 13:55:47', 10, 60, 'sampah Kardus TV'),
(8, 1, 2, 2, '2024-12-06 13:56:30', 10, 60, 'sampah Kardus TV'),
(9, 1, 2, 2, '2024-12-06 14:08:06', 10, 60, 'sampah Kardus TV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan_transaksi`
--
ALTER TABLE `pengaturan_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengelola`
--
ALTER TABLE `pengelola`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_sampah`
--
ALTER TABLE `transaksi_sampah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pengelola` (`idPengelola`),
  ADD KEY `FK_pengaturan_transaksi` (`idJenisSampah`),
  ADD KEY `FK_nasabah` (`idNasabah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengaturan_transaksi`
--
ALTER TABLE `pengaturan_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengelola`
--
ALTER TABLE `pengelola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_sampah`
--
ALTER TABLE `transaksi_sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_sampah`
--
ALTER TABLE `transaksi_sampah`
  ADD CONSTRAINT `FK_nasabah` FOREIGN KEY (`idNasabah`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pengaturan_transaksi` FOREIGN KEY (`idJenisSampah`) REFERENCES `pengaturan_transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pengelola` FOREIGN KEY (`idPengelola`) REFERENCES `pengelola` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
