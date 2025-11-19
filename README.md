# PasienApp
### 1. Cara Setup Project (Langkah-Langkah Instalasi)
Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:
Prasyarat
- PHP (versi 8.0 atau lebih tinggi)
- Composer
- Database (MySQL atau PostgreSQL)
  #### 1.1 Kloning Repositori
    Kloning repositori GitHub Anda ke folder lokal
  #### 1.2 Instalasi Dependensi
    Jalankan Composer untuk menginstal semua paket Laravel dan dependensi:
   ```bash
    composer install 
   ```
  #### 1.3 Konfigurasi Environment
    Buat salinan dari file .env.example dan ganti namanya menjadi .env:
    ```bash
    cp .env.example .env
    ```
    Lalu, hasilkan application key baru:
    ```bash
    php artisan key:generate
    ```
  #### 1.4 Konfigurasi Database
    Edit file .env dan atur detail koneksi database Anda (misalnya untuk MySQL):
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=username_anda
    DB_PASSWORD=password_anda
    ```
  #### 1.5 Migrasi dan Seeding Database
    Jalankan migrasi untuk membuat tabel patients dan visits. Anda dapat menambahkan seeder jika ada data dummy awal yang ingin dimasukkan:
    ```bash
    php artisan migrate --seed
    ```
   #### 1.6 Menjalankan Server Lokal
  
   ```bash
      php artisan serve
   ```

### 2. Struktur Folder Kustom (Tidak Ada)
Proyek ini mengikuti struktur folder standar Laravel (app, config, database, public, resources, routes). Tidak ada penyesuaian besar pada struktur folder inti.

### 3. Fitur Utama
  - CRUD Data Pasien: Mengelola data pasien (Tambah, Lihat Daftar, Cari, Edit, Hapus).
  - Pendaftaran Kunjungan: Merekam kunjungan baru dengan memilih pasien, poli, dokter, tanggal kunjungan, dan keluhan awal.
  - Riwayat Kunjungan Pasien: Menampilkan riwayat kunjungan spesifik berdasarkan pasien.

### 4. Fitur Tambahan (Extra Features)
  - Export Data Pasien ke PDF: Menyediakan fungsionalitas untuk mengekspor seluruh daftar data pasien ke dalam format PDF (Menggunakan paket barryvdh/laravel-dompdf).
  - Export Data Kunjungan ke Excel: Menyediakan fungsionalitas untuk mengekspor seluruh riwayat data kunjungan ke dalam format Excel (.xlsx) (Menggunakan paket maatwebsite/excel).
  - Filter Lanjutan Riwayat Kunjungan: Halaman Riwayat Kunjungan kini dilengkapi dengan filter berdasarkan: Pasien, Poli (Department), dan Rentang Tanggal Kunjungan (Dari & Sampai).
