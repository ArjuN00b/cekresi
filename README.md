# 🚚 Sistem Pelacakan Paket (Cek Resi) 

Aplikasi web sederhana dan minimalis untuk melacak status pengiriman paket menggunakan integrasi **BinderByte API**. Proyek ini dibuat untuk tugas mata kuliah **Pemrograman Web A**.

## ✨ Fitur
- Melacak nomor resi dari berbagai ekspedisi populer (JNE, J&T, SiCepat, AnterAja, TIKI, POS Indonesia, SPX).
- Antarmuka (UI) minimalis, premium, dan responsif (ramah pengguna *mobile*).
- Menampilkan informasi detail pengiriman (Status, Kurir, Penerima, No. Resi).
- Menampilkan tabel riwayat perjalanan paket (*tracking history*) secara kronologis.

## 📁 Struktur Folder
Proyek ini dirancang secara modular agar kode lebih rapi dan mudah dikembangkan:
```bash
cekresi/
│
├── config.php       # Menyimpan konfigurasi global (seperti API Key)
├── tracker.php      # Logika backend & integrasi fungsi API BinderByte
├── style.css        # Styling halaman dengan desain minimalis & modern
├── index.php        # Halaman utama (tampilan antarmuka / UI)
└── README.md        # Dokumentasi proyek
```

## 🚀 Cara Instalasi & Menjalankan Lokal

### 1. Prasyarat
Pastikan Anda sudah menginstal web server lokal (seperti **Laragon**, **XAMPP**, atau PHP terinstal secara lokal di sistem Anda).

### 2. Kloning Repositori
```bash
git clone https://github.com/ArjuN00b/cekresi.git
```
Pindahkan folder hasil kloning ke direktori web server Anda (misal `C:\laragon\www\` atau `C:\xampp\htdocs\`).

### 3. Konfigurasi API Key
Daftar/login di [BinderByte](https://binderbyte.com/) untuk mendapatkan API Key gratis. Buka file `config.php` dan masukkan API Key Anda:
```php
define('BINDERBYTE_API_KEY', 'API_KEY_ANDA_DI_SINI');
```

### 4. Jalankan Aplikasi
Buka browser Anda dan akses:
- **Laragon**: `http://cekresi.test` atau `http://localhost/cekresi`
- **XAMPP**: `http://localhost/cekresi`

## 🛠️ Teknologi yang Digunakan
- **PHP** (Backend & API request)
- **HTML5** & **CSS3** (Struktur & Desain responsif)
- **Plus Jakarta Sans** (Google Fonts untuk tipografi premium)
- **BinderByte API** (Sumber data pelacakan kurir)

---
