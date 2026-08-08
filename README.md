# Perpustakaan Buku Digital

Aplikasi web pengelolaan buku perpustakaan digital, dibangun menggunakan **CodeIgniter 3** dan **MySQL/MariaDB**, untuk memenuhi Ujian Akhir Semester mata kuliah **Pemrograman Web II (IF405)**.

## Fitur

- **CRUD** (Create, Read, Update, Delete) data buku
- **Penanganan Session** — login/logout dengan proteksi halaman
- **Searching** — pencarian buku berdasarkan judul, penulis, penerbit, atau kategori
- **Pagination** — daftar buku ditampilkan 5 data per halaman

## Teknologi

- PHP (CodeIgniter 3, kompatibel PHP 8.x)
- MySQL / MariaDB
- Bootstrap 5.3.3 + Bootstrap Icons (bundled lokal, tanpa dependensi CDN)

## Struktur Project

```
perpustakaan-digital/
├── application/
│   ├── controllers/
│   │   ├── Auth.php          # login, logout, session
│   │   └── Buku.php          # CRUD, search, pagination
│   ├── core/
│   │   └── MY_Controller.php # proteksi session/login
│   ├── models/
│   │   ├── User_model.php
│   │   └── Buku_model.php
│   ├── views/
│   │   ├── auth/login.php
│   │   ├── buku/ (index, create, edit, detail)
│   │   └── templates/ (header, footer)
│   └── config/               # database.php, routes.php, autoload.php, dll
├── assets/                   # Bootstrap CSS/JS lokal
├── database/
│   └── perpustakaan_digital.sql
├── system/                   # Core CodeIgniter 3 (tidak diubah)
└── index.php
```

## Instalasi & Menjalankan

1. **Clone / salin project** ke folder server lokal Anda (contoh: `htdocs` pada XAMPP, atau `www` pada Laragon).

2. **Buat database** MySQL baru:
   ```sql
   CREATE DATABASE perpustakaan_digital;
   ```
   Lalu import file `database/perpustakaan_digital.sql`:
   ```bash
   mysql -u root -p perpustakaan_digital < database/perpustakaan_digital.sql
   ```

3. **Konfigurasi koneksi database** di `application/config/database.php`:
   ```php
   'hostname' => 'localhost',
   'username' => 'root',
   'password' => '',       // sesuaikan dengan environment Anda
   'database' => 'perpustakaan_digital',
   ```

4. **Konfigurasi base URL** di `application/config/config.php`:
   ```php
   $config['base_url'] = 'http://localhost/perpustakaan-digital/';
   ```

5. **Jalankan** — buka browser ke base URL di atas. Anda akan otomatis diarahkan ke halaman login.

   Atau jalankan dengan PHP built-in server untuk testing cepat:
   ```bash
   php -S localhost:8080
   ```

## Akun Demo

| Username | Password  |
|----------|-----------|
| admin    | admin123  |

## Rute Utama

| Rute                  | Keterangan                          |
|------------------------|--------------------------------------|
| `/auth/login`           | Halaman login                       |
| `/auth/logout`          | Logout & hapus session              |
| `/buku`                 | Daftar buku (search + pagination)   |
| `/buku/create`          | Form tambah buku                    |
| `/buku/edit/{id}`       | Form edit buku                      |
| `/buku/detail/{id}`     | Detail buku                         |
| `/buku/delete/{id}`     | Hapus buku                          |

## Catatan

- Semua controller yang membutuhkan login meng-extend `MY_Controller`, yang otomatis memvalidasi session dan redirect ke halaman login jika belum terautentikasi.
- Password pengguna disimpan menggunakan `password_hash()` (bcrypt), bukan plain text.
- Aplikasi telah diuji secara end-to-end (login, CRUD, search, pagination, logout) — lihat laporan untuk detail hasil pengujian.
