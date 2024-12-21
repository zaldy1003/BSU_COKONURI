-- Active: 1722404976395@@127.0.0.1@3306@peminjaman_lab
CREATE DATABASE BSU_COKONURI;

use BSU_COKONURI;

DROP Table ;

CREATE Table Pengelola (createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, id INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(255), password VARCHAR(255), kontak VARCHAR(50));

CREATE TABLE Pengaturan_transaksi (createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, id INT PRIMARY KEY AUTO_INCREMENT, jenisSampah VARCHAR(255), hargaPerKG FLOAT);

CREATE TABLE Nasabah (createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, id INT PRIMARY KEY AUTO_INCREMENT, namaNasabah VARCHAR(255), kontak VARCHAR(50), jumlahTransaksi INT); 

CREATE TABLE Transaksi_sampah (id INT PRIMARY KEY AUTO_INCREMENT, idPengelola INT, idNasabah INT, idJenisSampah INT, tanggalWaktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP, totalPoinTransaksi FLOAT, deskripsi TEXT);

show TABLES;
DESC Nasabah;

ALTER TABLE Transaksi_sampah
ADD CONSTRAINT FK_pengelola
FOREIGN KEY (idPengelola) REFERENCES Pengelola(id)
ON DELETE CASCADE
ON UPDATE CASCADE; 

ALTER TABLE Transaksi_sampah
ADD CONSTRAINT FK_pengaturan_transaksi
FOREIGN KEY (idJenisSampah) REFERENCES Pengaturan_transaksi(id)
ON DELETE CASCADE
ON UPDATE CASCADE; 

ALTER TABLE Transaksi_sampah
ADD CONSTRAINT FK_nasabah
FOREIGN KEY (idNasabah) REFERENCES Nasabah(id)
ON DELETE CASCADE
ON UPDATE CASCADE; 

-- ============================= NASABAH ============================= --
-- TAMBAH NASABAH --
DELIMITER //
CREATE PROCEDURE tambahNasabah(
    IN nama VARCHAR(100),
    IN kontakIn VARCHAR(15),
    IN alamatIn TEXT,
    IN jumlahTransaksiIn INT
)
BEGIN
    INSERT INTO Nasabah (namaNasabah, kontak, alamat, jumlahTransaksi)
    VALUES (nama, kontakIn, alamatIn, jumlahTransaksiIn);
END
DELIMITER ;

-- HITUNG NASABAH --
DELIMITER //
CREATE PROCEDURE hitungNasabah()
BEGIN
    SELECT COUNT(*) AS jumlah_nasabah FROM Nasabah;
END
DELIMITER;

CALL hitungNasabah();
-- UPDATE NASABAH --
DELIMITER //
CREATE PROCEDURE updateNasabah (
    IN idIn INT,
    IN namaIn VARCHAR(100),
    IN kontakIn VARCHAR(15),
    IN alamatIn TEXT,
    IN jumlahTransaksiIn INT
)
BEGIN
    UPDATE Nasabah SET 
        namaNasabah = namaIn,
        kontak = kontaIn,
        alamat = alamatIn,
        jumlahTransaksi = jumlahTransaksiIn
    WHERE id = idIn;
END
DELIMITER;

-- DELETE NASABAH --
DELIMITER //
CREATE PROCEDURE hapusNasabah (
    IN idIn INT
)
BEGIN
    DELETE FROM Nasabah WHERE id = idIn;
END
DELIMITER;

-- SELECT NASABAH --
DELIMITER //
CREATE PROCEDURE tampilNasabah ()
BEGIN
    SELECT * FROM Nasabah;
END
DELIMITER;


-- ============================= PENGELOLA ============================= --
-- TAMBAH PENGELOLA --
DELIMITER //
CREATE PROCEDURE tambahPengelola(
    IN usernameIn VARCHAR(100),
    IN passwordIn VARCHAR(255),
    IN kontakIn VARCHAR(15)
)
BEGIN
    INSERT INTO Pengelola (username, password, kontak)
    VALUES (usernameIn, passwordIn, kontakIn);
END 
DELIMITER ;

-- UPDATE PENGELOLA --
DELIMITER //
CREATE PROCEDURE updatePengelola(
    IN idIn INT,
    IN usernameIn VARCHAR(100),
    IN passwordIn VARCHAR(255),
    IN kontakIn VARCHAR(15)
)
BEGIN
    UPDATE Pengelola
    SET 
        username = usernameIn,
        password = passwordIn,
        kontak = kontakIn
    WHERE id = idIn;
END 
DELIMITER ;

-- DELETE PENGELOLA --
DELIMITER //
CREATE PROCEDURE hapusPengelola(
    IN idIn INT
)
BEGIN
    DELETE FROM Pengelola
    WHERE id = idIn;
END 
DELIMITER ;

-- SELECT PENGELOLA --
DELIMITER //
CREATE PROCEDURE tampilPengelola ()
BEGIN
    SELECT * FROM Pengelola;
END
DELIMITER;


-- ============================= PENGATURAN_TRANSAKSI ============================= --
-- TAMBAH JENIS SAMPAH --
DELIMITER //
CREATE PROCEDURE tambahJenisSampah(
    IN jenisSampahIn VARCHAR(100),
    IN hargaPerKGIn FLOAT
)
BEGIN
    INSERT INTO Pengaturan_transaksi (jenisSampah, hargaPerKG)
    VALUES (jenisSampahIn, hargaPerKGIn);
END 
DELIMITER ;

-- UPDATE JENIS SAMPAH --
DELIMITER //
CREATE PROCEDURE updateJenisSampah(
    IN idIn INT,
    IN jenisSampahIn VARCHAR(100),
    IN hargaPerKGIn FLOAT
)
BEGIN
    UPDATE Pengaturan_transaksi
    SET 
        jenisSampah = jenisSampahIn,
        hargaPerKG = hargaPerKGIn
    WHERE id = idIn;
END
DELIMITER ;

-- DELETE JENIS SAMPAH --
DELIMITER //
CREATE PROCEDURE hapusJenisSampah(
    IN idIn INT
)
BEGIN
    DELETE FROM Pengaturan_transaksi
    WHERE id = idIn;
END 
DELIMITER ;

DELIMITER //
CREATE PROCEDURE tampilSampah()
BEGIN
    SELECT * FROM Pengaturan_transaksi;
END
DELIMITER;
call tampilSampah();
-- SELECT JENIS SAMPAH --
DELIMITER //
CREATE PROCEDURE tampilJenisSampah ()
BEGIN
    SELECT * FROM Pengaturan_transaksi;
END
DELIMITER ;

-- ============================= TRANSAKSI_SAMPAH ============================= --
DELIMITER //
CREATE PROCEDURE catatTransaksi(
    IN idNasabahIn INT,
    IN idPengelolaIn INT,
    IN idJenisSampahIn INT,
    IN beratIn FLOAT,
    IN deskripsiIn TEXT
)
BEGIN
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
    END 
    DELIMITER ;

    DELIMITER //
    CREATE PROCEDURE hitungTotalTransaksi()
    BEGIN
        SELECT COUNT(*) AS total_transaksi FROM transaksi_sampah;
    END
    DELIMITER;

    CALL hitungTotalTransaksi;

    DELIMITER //
    CREATE PROCEDURE tampilJumlahTransaksiperBulan(
        IN monthIn VARCHAR(5),
        IN yearIn VARCHAR(5)
    )
    BEGIN
        SELECT COUNT(*) as total_transaksi 
        from transaksi_sampah 
        WHERE MONTH(tanggalWaktu) = monthIn AND YEAR(tanggalWaktu) = yearIn;
    END 
    DELIMITER ;
    DROP PROCEDURE tampilJumlahTransaksiperBulan;
    DELIMITER //
    CREATE PROCEDURE tampilJumlahPoinperBulan(
        IN monthIn VARCHAR(5),
        IN yearIn VARCHAR(5)
    )
    BEGIN
        SELECT SUM(totalPoinTransaksi) AS total_poin
        FROM transaksi_sampah
        WHERE MONTH(tanggalWaktu) = monthIn  AND YEAR(tanggalWaktu) = yearIn;
    END 
    DELIMITER ;

    DELIMITER //
    CREATE PROCEDURE tampilJumlahBeratSampahperBulan(
        IN monthIn VARCHAR(5),
        IN yearIn VARCHAR(5)
    )
    BEGIN
        SELECT SUM(beratSampah) AS berat_sampah
        FROM transaksi_sampah
        WHERE MONTH(tanggalWaktu) = monthIn  AND YEAR(tanggalWaktu) = yearIn;
    END 
    DELIMITER ;

    DELIMITER //
    CREATE PROCEDURE tampilTableLaporan(
        IN monthIn VARCHAR(5),
        IN yearIn VARCHAR(5)
    )
    BEGIN
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
    END 
    DELIMITER ;

    DELIMITER //
    CREATE PROCEDURE tampilTransaksiSampahTerbanyak()
    BEGIN
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
    END

    DELIMITER;

    CALL tampilTransaksiSampahTerbanyak();


CALL tampilLaporanBulananTop('12', '2024');
CALL tampilJumlahBeratSampahperBulan('12', '2024');
drop procedure tampilLaporanBulananTop;
show tables;
drop PROCEDURE catatTransaksi;
select * from Pengaturan_transaksi;
select * from Nasabah;
select * from Pengelola;
call tambahPengelola("Yani", "admin", "081329298473");
call tambahJenisSampah("Kardus", 6000);
alter table Transaksi_sampah add beratSampah float after tanggalWaktu;
call catatTransaksi(2,1,2,10,"sampah Kardus TV");

desc Transaksi_sampah;

call tampilJumlahTransaksiperBulan('12', '2024');



CALL `tambahNasabah`( "Asep", "08135512123", "jln. Cokonuri Antartika", 0);


desc Pengaturan_transaksi;




SELECT * FROM Transaksi_sampah;

CALL  tampilNasabah;

SELECT jenisSampah FROM Pengaturan_transaksi WHERE id = 1;

SELECT COUNT(*) as total_tansaksi from transaksi_sampah WHERE MONTH(tanggalWaktu) = '12' AND YEAR(tanggalWaktu) = '2024';

SELECT SUM(totalPoinTransaksi) AS total_poin
FROM transaksi_sampah
WHERE MONTH(tanggalWaktu) = '12'  AND YEAR(tanggalWaktu) = '2024';
FROM transaksi_sampah
WHERE MONTH(tanggalWaktu) = '12' AND YEAR(tanggalWaktu) = '2024';

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
    MONTH(ts.tanggalWaktu) = '12' 
    AND YEAR(ts.tanggalWaktu) = '2024'
GROUP BY 
    p.jenisSampah;

use BSU_COKONURI;

SELECT COUNT(*) from nasabah;

SELECT * FROM nasabah;

SELECT * FROM pengelola;

SELECT * FROM pengaturan_transaksi;
SHOW tables;
