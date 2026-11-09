# AnalisaPost - Portal Berita Online

> **AnalisaPost** (*Simple and Independent*) — Portal media online berita aktual, kritis, dan berimbang berbasis di Surabaya, Jawa Timur.

Repository ini memuat kode sumber website **AnalisaPost Rebuild** berbasis **WordPress 6.x / 7.x**, **PHP 8.3**, dan **Tema Kustom Modern (`analisapost-theme`)** yang dirancang dengan optimasi Core Web Vitals, arsitektur monetisasi multi-jalur (*Google AdSense, MGID Native, & Iklan Baris lokal*), serta struktur ramah SEO, GEO, dan AEO.

---

## 🚀 Fitur Utama & Layout

1. **Header & Leaderboard IAB (728 x 90 px):**
   * Top utility bar dengan penanggalan, trending hashtags, dan ikon media sosial.
   * Logo branding AnalisaPost terintegrasi slot resmi Google AdSense Leaderboard.
2. **Navigasi Kategori Lengkap:**
   * Rubrik Nasional, Politik, Hukum & Kriminal, Peristiwa, Ekonomi, UMKM, dan Iklan Baris.
3. **Sorotan Utama (Hero Story):**
   * Menampilkan 1 berita utama dengan foto lebar 16:9, badge *Sorotan Utama*, kutipan ringkas, dan estimasi waktu baca.
4. **Grid Berita 2-Kolom & List Horizontal:**
   * Menggantikan format 4-kolom lama yang sempit. Menjaga keterbacaan judul agar tidak terpotong (pola baca *F-Pattern*).
5. **Arsitektur Monetisasi Terpadu:**
   * **Google Ads:** Header (728x90), In-Feed (728x90), Sidebar Medium Rectangle (300x250).
   * **MGID Native Widget:** Rekomendasi artikel sponsor (Grid 3 kartu & sidebar vertikal).
   * **Iklan Baris Jawa Timur:** Format kartu modern dengan filter kategori (*Properti, Lowongan, Jasa*) dan tombol interaktif **Direct Chat WhatsApp** (`wa.me`).
6. **Widget Sidebar Dinamis:**
   * Berita Terpopuler otomatis berperingkat (1–4) berdasarkan jumlah pembaca (`post_views_count`).
   * Tag cloud topik terhangat.
7. **Footer Editorial 4 Kolom:**
   * Profil media, pedoman media siber, kontak redaksi, dan hak cipta.

---

## 🛠️ Tech Stack & Spesifikasi

* **CMS Core:** WordPress 6.x / 7.x
* **PHP:** PHP 8.3 (Strict typing `declare(strict_types=1);` & Null-safe)
* **Database:** MySQL 8.x / MariaDB 10.4+
* **CSS Framework:** Tailwind CSS
* **Local Development:** Laragon / XAMPP (Apache 2.4, PHP 8.3.36 patched)
* **Target Production Hosting:** DomaiNesia Nimbus Plus (CloudLinux, Redis Object Cache, Cloudflare Edge Cache)

---

## 📂 Struktur Direktori

```text
wordpress/
├── wp-admin/                               # WordPress Admin Panel
├── wp-includes/                            # WordPress Core Library
├── wp-content/                             # WordPress Content Directory
│   └── themes/
│       └── analisapost-theme/              # Tema Kustom AnalisaPost
│           ├── style.css                   # Informasi & metadata tema
│           ├── functions.php               # CPT Iklan Baris, View Tracker, Setup
│           ├── header.php                  # Header, Topbar, Navigasi, Google Ads 728x90
│           ├── footer.php                  # Footer 4 kolom & copyright
│           ├── index.php                   # Beranda berita utama
│           ├── category.php                # Halaman kategori (Peristiwa, dll)
│           ├── single.php                  # Halaman baca artikel lengkap
│           ├── sidebar.php                 # Terpopuler, Iklan Baris, MGID, Ads
│           └── screenshot.jpg              # Pratinjau tema di dashboard WP
├── wp-config-sample.php                    # Contoh konfigurasi database
└── index.php                               # Entry point
```

---

## 💻 Panduan Instalasi di Localhost (Laragon)

1. Pastikan Anda sudah menginstal **Laragon** dengan **PHP 8.3**.
2. Clone repository ini ke dalam direktori Laragon www:
   ```bash
   cd C:\laragon\www
   git clone https://github.com/shoopekyx-collab/analisapost.git
   ```
   *(Atau buat Junction jika folder berada di drive lain)*:
   ```cmd
   mklink /J "C:\laragon\www\analisapost" "D:\Jamal\Analisa Post\wordpress"
   ```
3. Buka **Laragon**, klik tombol **Start All** (Apache & MySQL).
4. Buat database baru bernama **`db_analisapost`** via HeidiSQL / phpMyAdmin / CLI:
   ```sql
   CREATE DATABASE IF NOT EXISTS db_analisapost CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
5. Salin `wp-config-sample.php` menjadi `wp-config.php`, lalu sesuaikan kredensial database jika diperlukan.
6. Buka browser dan akses: `http://analisapost.test` (atau `http://localhost/analisapost`).
7. Selesaikan wizard instalasi akun admin WordPress.
8. Masuk ke menu **Appearance > Themes**, lalu aktifkan **AnalisaPost Theme**.

---

## 📄 Lisensi
Hak Cipta © 2026 AnalisaPost. Simple and Independent. All Rights Reserved.
