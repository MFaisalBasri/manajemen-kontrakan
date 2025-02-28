# Manajemen Kontrakan

**Manajemen Kontrakan** adalah aplikasi web yang memungkinkan pemilik kontrakan untuk mengelola kontrakan mereka, sementara penyewa dapat melakukan kunjungan, pembayaran, dan cek status pembayaran. Sistem ini juga dilengkapi dengan notifikasi tagihan untuk penyewa. Terdapat tiga role pengguna: Superadmin, Pemilik, dan Penyewa.

## Fitur

### 1. **Superadmin**
- Dapat mengelola semua data dan pengguna di dalam sistem.
- Memiliki akses penuh untuk memverifikasi dan mengatur hak akses pemilik dan penyewa.

### 2. **Pemilik**
- Mengupload kontrakan yang tersedia.
- Mengelola detail kontrakan (harga, fasilitas, deskripsi, foto).
- Memantau jadwal kunjungan yang diatur oleh penyewa.
- Melihat status pembayaran dari penyewa.

### 3. **Penyewa**
- Melakukan jadwal kunjungan kontrakan.
- Melakukan pembayaran untuk kontrakan.
- Melihat riwayat pembayaran dan status pembayaran.
- Mendapatkan notifikasi tagihan dan pembayaran yang harus dilakukan.

## Teknologi yang Digunakan

- **Frontend**: HTML,  JavaScript, CSS (bootstrap)
- **Backend**: CodeIgniter 4
- **Database**: MySQL

## Instalasi

### 1. Clone Repository

Clone repositori ini ke komputer Anda:

```bash
git clone https://github.com/mfaisalbasri/manajemen-kontrakan.git
cd manajemen-kontrakan
```
### 2. Instalasi Dependencies

Setelah meng-clone repositori, pastikan Anda sudah menginstal PHP versi 7.3 ke atas dan Composer untuk mengelola dependensi proyek. Berikut adalah langkah-langkah untuk menginstal dependensi yang dibutuhkan oleh proyek ini.

**Langkah 1: Instal PHP dan Composer
Instalasi PHP**

Pastikan PHP versi 7.3 ke atas sudah terinstal. Berikut cara menginstal PHP di beberapa sistem operasi:
- **Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install php php-cli php-mbstring php-xml php-curl php-mysql
```
- **Windows:** Unduh PHP dari [situs resmi PHP](https://www.php.net/downloads.php) atau gunakan paket XAMPP yang sudah mencakup PHP.


**Instalasi Composer**
**Composer** adalah alat untuk mengelola dependensi PHP. Ikuti langkah-langkah berikut untuk menginstal Composer.
- **Di Windows:** Unduh **Composer** dari [situs resmi Composer](https://getcomposer.org/download/) dan ikuti petunjuk penginstalan di sana.


**Langkah 2: Menginstal Dependensi**
Setelah Composer terinstal, masuk ke dalam folder proyek yang sudah Anda clone dan jalankan perintah berikut untuk menginstal semua dependensi yang diperlukan oleh proyek ini:
```bash
composer install
```
Perintah ini akan mengunduh dan menginstal semua paket yang diperlukan yang tercantum dalam file `composer.json.`

### 3. Menyiapkan Database
Pastikan Anda sudah menyiapkan database MySQL sesuai dengan kebutuhan proyek ini. Sesuaikan pengaturan database.

Contoh pengaturan untuk MySQL di `app -> config -> database.php:`
```bash
'hostname'     => 'localhost',
'username'     => 'root',
'password'     => '',
'database'     => 'db_kontrakan',
```

### 4. Menjalankan Aplikasi
Sekarang, Anda siap untuk menjalankan aplikasi menggunakan server internal bawaan dari CodeIgniter 4. Jalankan perintah berikut:
```bash
php spark serve
```
Aplikasi Anda akan berjalan pada http://localhost:8000.

### 5. Akses Aplikasi
Buka browser Anda dan akses aplikasi di http://localhost:8000.

## Kontribusi

Kami membuka kesempatan bagi Anda yang ingin berkontribusi dalam mengembangkan website Bank Sampah ini. Jika Anda tertarik untuk berkolaborasi, silakan fork repository ini dan kirimkan pull request!



