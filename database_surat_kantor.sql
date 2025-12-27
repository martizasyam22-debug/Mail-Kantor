-- SQL Database untuk Aplikasi Surat Kantor
-- Nama Database: mail_kantor

-- Membuat database
CREATE DATABASE IF NOT EXISTS mail_kantor;
USE mail_kantor;

-- Tabel pengguna (untuk login)
CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel surat_masuk
CREATE TABLE IF NOT EXISTS surat_masuk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_surat VARCHAR(50),
    dari VARCHAR(100) NOT NULL,
    perihal VARCHAR(255) NOT NULL,
    tanggal_surat DATE,
    tanggal_terima DATE NOT NULL,
    status ENUM('Baru', 'Dibaca') DEFAULT 'Baru',
    file_lampiran VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel surat_keluar
CREATE TABLE IF NOT EXISTS surat_keluar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_surat VARCHAR(50) NOT NULL,
    tanggal_kirim DATE NOT NULL,
    kepada VARCHAR(100) NOT NULL,
    perihal VARCHAR(255) NOT NULL,
    isi_surat TEXT,
    file_lampiran VARCHAR(255),
    status ENUM('Terkirim') DEFAULT 'Terkirim',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data contoh untuk pengguna (password di-hash dengan MD5 untuk demo, gunakan bcrypt di production)
DELETE FROM log_aktivitas;
DELETE FROM pengguna;
INSERT INTO pengguna (nama, email, password) VALUES
('Administrator', 'admin@kantor.com', 'e6e061838856bf47e1de730719fb2609f'),
('User Kantor', 'user@kantor.com', '6ad14ba9986e3615423dfca256d04e3f');

-- Insert data contoh untuk surat_masuk
INSERT IGNORE INTO surat_masuk (nomor_surat, dari, perihal, tanggal_surat, tanggal_terima, status) VALUES
('001/SM/2025', 'PT ABC Indonesia', 'Undangan Rapat Koordinasi', '2025-12-20', '2025-12-25', 'Baru'),
('002/SM/2025', 'Bank XYZ', 'Konfirmasi Transfer Dana', '2025-12-22', '2025-12-26', 'Dibaca'),
('003/SM/2025', 'Kementerian Komunikasi', 'Pemberitahuan Perubahan Regulasi', '2025-12-24', '2025-12-27', 'Baru'),
('004/SM/2025', 'CV Teknologi Maju', 'Proposal Kerjasama', '2025-12-26', '2025-12-27', 'Baru');

-- Insert data contoh untuk surat_keluar
INSERT IGNORE INTO surat_keluar (nomor_surat, tanggal_kirim, kepada, perihal, isi_surat, status) VALUES
('001/SK/2025', '2025-12-25', 'PT ABC Indonesia', 'Balasan Undangan Rapat', 'Terima kasih atas undangan rapat koordinasi. Kami akan hadir pada waktu yang ditentukan.', 'Terkirim'),
('002/SK/2025', '2025-12-26', 'Bank XYZ', 'Konfirmasi Penerimaan Transfer', 'Dengan hormat, kami telah menerima transfer dana sesuai dengan jumlah yang disepakati.', 'Terkirim'),
('003/SK/2025', '2025-12-27', 'Kementerian Komunikasi', 'Permohonan Izin', 'Dengan ini kami mengajukan permohonan izin untuk...', 'Terkirim');

-- Tabel disposisi untuk surat masuk
CREATE TABLE IF NOT EXISTS disposisi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    surat_masuk_id INT NOT NULL,
    kepada VARCHAR(100) NOT NULL,
    instruksi TEXT,
    tanggal_disposisi DATE NOT NULL,
    status ENUM('Pending', 'Selesai') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (surat_masuk_id) REFERENCES surat_masuk(id) ON DELETE CASCADE
);

-- Tabel log_aktivitas untuk tracking
CREATE TABLE IF NOT EXISTS log_aktivitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    aksi VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES pengguna(id) ON DELETE CASCADE
);