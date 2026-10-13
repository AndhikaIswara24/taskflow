# TaskFlow — Task Management Application

TaskFlow adalah aplikasi manajemen tugas berbasis web yang dikembangkan menggunakan Laravel. Aplikasi ini dirancang untuk membantu pengguna mencatat, mengatur, dan memantau penyelesaian tugas harian melalui dashboard yang sederhana dan informatif.

## Fitur Utama

- **Dashboard:** Menampilkan ringkasan tugas berdasarkan status dan tenggat waktu.
- **Manajemen Tugas:** Menambahkan, melihat, mengubah, dan menghapus tugas.
- **Status Tugas:** Mengelola progres tugas berdasarkan status pengerjaan.
- **Prioritas Tugas:** Mengatur prioritas untuk membantu menentukan tugas yang perlu dikerjakan terlebih dahulu.
- **Tenggat Waktu:** Menentukan batas waktu dan memantau tugas yang terlambat.
- **Daftar Tugas:** Menampilkan informasi tugas agar mudah dipantau.
- **Notifikasi:** Menampilkan pemberitahuan ketika operasi berhasil atau terjadi kesalahan.

## Teknologi

- PHP
- Laravel
- MySQL
- Blade Template
- Tailwind CSS
- JavaScript
- NPM
- Git dan GitHub

## Persyaratan Sistem

Pastikan perangkat telah memiliki:

- PHP dengan ekstensi yang dibutuhkan Laravel.
- Composer.
- MySQL atau MariaDB.
- Node.js dan NPM.
- Git.

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/USERNAME/taskflow.git
cd taskflow
```

Ganti `USERNAME` dengan username GitHub pemilik repository.

### 2. Instal Dependensi

```bash
composer install
npm install
```

### 3. Siapkan File Environment

Salin file `.env.example` menjadi `.env`.

Pada Git Bash, jalankan:

```bash
cp .env.example .env
```

Buat application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Buat database MySQL baru, misalnya `taskflow`.

Sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskflow
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama database, username, dan password dengan konfigurasi lokal masing-masing.

### 5. Jalankan Migrasi

```bash
php artisan migrate
```

Jika proyek memerlukan data awal, jalankan seeder yang tersedia sesuai kebutuhan.

### 6. Build Frontend

```bash
npm run build
```

### 7. Jalankan Aplikasi

```bash
php artisan serve
```

Buka aplikasi melalui browser:

http://127.0.0.1:8000

## Struktur Direktori

```text
app/                Logika aplikasi, model, dan controller
database/           Migrasi dan seeder database
public/             File publik aplikasi
resources/views/    Tampilan Blade
routes/             Definisi rute aplikasi
tests/              Pengujian aplikasi
```

## Tujuan Pengembangan

TaskFlow dikembangkan sebagai proyek pembelajaran dan portofolio untuk meningkatkan kemampuan dalam membangun aplikasi web menggunakan Laravel, PHP, dan MySQL.

## Status Proyek

Versi awal aplikasi telah selesai dikembangkan. Pengembangan selanjutnya dapat mencakup peningkatan keamanan, pengujian otomatis, dan penambahan fitur sesuai kebutuhan.

## Lisensi

Lisensi proyek belum ditentukan.
