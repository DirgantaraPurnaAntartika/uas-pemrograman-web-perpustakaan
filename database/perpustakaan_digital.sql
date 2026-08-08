-- =========================================================
-- Database: perpustakaan_digital
-- Aplikasi : Perpustakaan Buku Digital (CodeIgniter 3 + MySQL)
-- UAS Pemrograman Web II - IF405
-- =========================================================

CREATE DATABASE IF NOT EXISTS `perpustakaan_digital`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `perpustakaan_digital`;

-- ---------------------------------------------------------
-- Tabel: users (untuk login & session)
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,   -- di-hash menggunakan password_hash() PHP (bcrypt)
  `name` VARCHAR(100) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password default: admin123
-- Hash di bawah dihasilkan dari password_hash('admin123', PASSWORD_BCRYPT)
INSERT INTO `users` (`username`, `password`, `name`) VALUES
('admin', '$2y$10$XDKTg8DO2Q0BnKbx1Cxis.E2bAsaDZI/owiKM8JtlW8X2Ofw47zhq', 'Administrator Perpustakaan');

-- ---------------------------------------------------------
-- Tabel: buku
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(255) NOT NULL,
  `penulis` VARCHAR(150) NOT NULL,
  `penerbit` VARCHAR(150) NOT NULL,
  `tahun_terbit` YEAR NOT NULL,
  `kategori` VARCHAR(50) NOT NULL,
  `stok` INT UNSIGNED NOT NULL DEFAULT 0,
  `sinopsis` TEXT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  KEY `idx_judul` (`judul`),
  KEY `idx_kategori` (`kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data awal (sample)
INSERT INTO `buku` (`judul`, `penulis`, `penerbit`, `tahun_terbit`, `kategori`, `stok`, `sinopsis`) VALUES
('Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'Fiksi', 12, 'Kisah perjuangan anak-anak Belitung dalam meraih pendidikan.'),
('Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 'Fiksi', 8, 'Novel sejarah tentang kehidupan di masa kolonial Hindia Belanda.'),
('Filosofi Teras', 'Henry Manampiring', 'Kompas', 2018, 'Non-Fiksi', 15, 'Pengantar filsafat Stoa untuk kehidupan modern.'),
('Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Harper', 2011, 'Sains', 10, 'Sejarah singkat umat manusia dari zaman purba hingga modern.'),
('Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, 'Teknologi', 6, 'Panduan menulis kode program yang bersih dan mudah dipelihara.'),
('Atomic Habits', 'James Clear', 'Avery', 2018, 'Non-Fiksi', 20, 'Cara membangun kebiasaan baik dan menghilangkan kebiasaan buruk.'),
('Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia', 2009, 'Fiksi', 9, 'Kisah santri di pondok pesantren yang bermimpi menaklukkan dunia.'),
('Sejarah Indonesia Modern', 'M.C. Ricklefs', 'Serambi', 2005, 'Sejarah', 5, 'Ulasan sejarah Indonesia dari 1200 hingga masa kini.'),
('Cosmos', 'Carl Sagan', 'Random House', 1980, 'Sains', 7, 'Eksplorasi alam semesta dan tempat manusia di dalamnya.'),
('Sang Pemimpi', 'Andrea Hirata', 'Bentang Pustaka', 2006, 'Fiksi', 11, 'Lanjutan kisah Laskar Pelangi tentang mimpi dan persahabatan.'),
('The Pragmatic Programmer', 'David Thomas & Andrew Hunt', 'Addison-Wesley', 1999, 'Teknologi', 4, 'Panduan praktis menjadi programmer yang profesional.'),
('Pendidikan Karakter', 'Thomas Lickona', 'Bumi Aksara', 2012, 'Pendidikan', 13, 'Konsep pendidikan karakter bagi generasi muda.');
