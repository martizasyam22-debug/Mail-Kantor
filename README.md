# Aplikasi Surat Kantor

Aplikasi web sederhana untuk mengelola surat masuk dan keluar di kantor, dibangun dengan PHP, MySQL, dan Tailwind CSS.

## Deskripsi

Aplikasi ini memungkinkan pengguna untuk:
- Mengelola surat masuk (lihat, tandai dibaca, balas, hapus)
- Membuat dan mengirim surat keluar
- Upload file lampiran
- Sistem login dengan autentikasi

## Fitur

### Surat Masuk
- Daftar surat masuk dengan status (Baru/Dibaca)
- Detail surat dengan informasi lengkap
- Tombol Balas untuk membuat surat keluar
- Tombol Hapus surat
- Otomatis tandai dibaca saat dibuka

### Surat Keluar
- Form pembuatan surat keluar dengan field lengkap
- Upload file lampiran (PDF/DOCX)
- Daftar surat keluar yang sudah dikirim
- Detail surat dengan isi lengkap
- Tombol Hapus surat

### Sistem
- Login/logout dengan session
- Dashboard dengan navigasi sidebar
- Responsive design dengan Tailwind CSS
- Keamanan dasar (escape input, hash password)

## Persyaratan Sistem

- PHP 7.4 atau lebih baru
- MySQL 5.7 atau lebih baru
- Web server (Apache/Nginx)
- Browser modern

## Instalasi

1. **Clone repository**:
   ```bash
   git clone https://github.com/username/surat-kantor.git
   cd surat-kantor
   ```

2. **Setup database**:
   - Import file `database_surat_kantor.sql` ke MySQL
   - Atau jalankan query di file tersebut

3. **Konfigurasi**:
   - Pastikan folder `uploads/` writable (chmod 755)
   - Edit `core/db.php` jika perlu mengubah konfigurasi database

4. **Jalankan aplikasi**:
   - Akses `http://localhost/surat-kantor/login.php`
   - Login dengan akun default:
     - Email: `admin@kantor.com` / Password: `admin123`
     - Email: `user@kantor.com` / Password: `user123`

## Struktur Database

### Tabel `pengguna`
- `id` (INT, PRIMARY KEY)
- `nama` (VARCHAR)
- `email` (VARCHAR, UNIQUE)
- `password` (VARCHAR, MD5 hash)
- `created_at` (TIMESTAMP)

### Tabel `surat_masuk`
- `id` (INT, PRIMARY KEY)
- `nomor_surat` (VARCHAR)
- `dari` (VARCHAR)
- `perihal` (VARCHAR)
- `tanggal_surat` (DATE)
- `tanggal_terima` (DATE)
- `status` (ENUM: 'Baru', 'Dibaca')
- `file_lampiran` (VARCHAR)
- `created_at` (TIMESTAMP)

### Tabel `surat_keluar`
- `id` (INT, PRIMARY KEY)
- `nomor_surat` (VARCHAR)
- `tanggal_kirim` (DATE)
- `kepada` (VARCHAR)
- `perihal` (VARCHAR)
- `isi_surat` (TEXT)
- `file_lampiran` (VARCHAR)
- `status` (ENUM: 'Terkirim')
- `created_at` (TIMESTAMP)

### Tabel `disposisi`
- `id` (INT, PRIMARY KEY)
- `surat_masuk_id` (INT, FOREIGN KEY)
- `kepada` (VARCHAR)
- `instruksi` (TEXT)
- `tanggal_disposisi` (DATE)
- `status` (ENUM: 'Pending', 'Selesai')
- `created_at` (TIMESTAMP)

### Tabel `log_aktivitas`
- `id` (INT, PRIMARY KEY)
- `user_id` (INT, FOREIGN KEY)
- `aksi` (VARCHAR)
- `deskripsi` (TEXT)
- `created_at` (TIMESTAMP)

## Struktur Folder

```
surat-kantor/
├── core/
│   ├── auth.php      # Fungsi autentikasi
│   └── db.php        # Koneksi database
├── views/
│   ├── surat_masuk.php
│   ├── daftar_surat_keluar.php
│   ├── form_surat_keluar.php
│   └── ...
├── uploads/          # Folder untuk file lampiran
├── images/           # Folder untuk gambar dokumentasi/screenshot aplikasi
├── css/
│   └── style.css
├── database_surat_kantor.sql
├── index.php
├── login.php
├── logout.php
└── README.md
```

## Penggunaan

1. **Login**: Masuk dengan email dan password
2. **Dashboard**: Pilih menu Surat Masuk atau Surat Keluar
3. **Surat Masuk**: Klik surat untuk lihat detail, gunakan tombol Balas/Hapus
4. **Surat Keluar**: Klik "Tulis Surat" untuk buat surat baru
5. **Logout**: Klik logout di sidebar

## Keamanan

- Password di-hash dengan MD5 (untuk demo; gunakan bcrypt di production)
- Input di-escape dengan `mysqli_real_escape_string`
- Session-based authentication
- File upload dengan validasi dasar

## Kontribusi

1. Fork repository
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## Lisensi

Distributed under the MIT License. See `LICENSE` for more information.

## Kontak

- Email: your-email@example.com
- GitHub: [@yourusername](https://github.com/yourusername)