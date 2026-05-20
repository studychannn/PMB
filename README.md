# PMB UIN Siber Syekh Nurjati Cirebon

Sistem informasi Penerimaan Mahasiswa Baru (PMB) berbasis web untuk UIN Siber Syekh Nurjati Cirebon. Dibangun menggunakan PHP native, MySQL, dan Bootstrap 5.

## Teknologi

- PHP 8+
- MySQL
- Bootstrap 5.3
- Apache XAMPP

## Fitur

**Halaman Publik**
- Informasi alur PMB 6 tahap
- Jalur masuk (SNBP, SNBT, SPAN-PTKIN, UM-PTKIN)
- Jadwal PMB
- Form kontak

**Calon Mahasiswa**
- Registrasi dan login akun
- Isi biodata pendaftaran
- Upload dokumen persyaratan
- Pantau status pendaftaran
- Lihat pengumuman hasil seleksi
- Informasi daftar ulang dan ospek

**Admin**
- Login terpisah dari user
- Dashboard statistik peserta
- Kelola status berkas dan hasil seleksi peserta
- Lihat pesan masuk dari form kontak

## Instalasi

1. Clone repository dan letakkan di folder `htdocs` (XAMPP) atau `www` (Laragon) dengan nama folder `uinssc`
2. Buka phpMyAdmin, buat database baru bernama `uinssc_pmb`
3. Import file `database/schema.sql`
4. Sesuaikan konfigurasi database di `includes/db.php`
5. Akses di browser: `http://localhost/uinssc`

## Akun Default

**Admin**
- URL login: `http://localhost/uinssc/admin/login.php`
- Email: `admin@uinssc.ac.id`
- Password: `admin123`

**User**
- Daftar akun baru di: `http://localhost/uinssc/register.php`

## Struktur Folder

```
uinssc/
├── admin/          - Halaman khusus admin
├── assets/         - Gambar dan aset statis
├── database/       - File SQL schema database
├── includes/       - File PHP yang digunakan bersama
├── storage/        - Penyimpanan sesi PHP
├── uploads/        - File dokumen yang diupload user
├── user/           - Halaman khusus calon mahasiswa
├── index.php       - Beranda
├── alur.php        - Alur PMB
├── jalur.php       - Jalur masuk
├── jadwal.php      - Jadwal PMB
├── kontak.php      - Kontak
├── login.php       - Login user
├── register.php    - Registrasi user
└── logout.php      - Logout
```

## Alur PMB

1. Pendaftaran Online - Isi formulir dan pilih jalur masuk
2. Seleksi Berkas - Verifikasi dokumen oleh panitia
3. Ujian Masuk - Tes sesuai jalur yang dipilih
4. Pengumuman Hasil - Cek status kelulusan
5. Daftar Ulang dan Pembayaran - Selesaikan administrasi
6. Ospek - Orientasi mahasiswa baru
