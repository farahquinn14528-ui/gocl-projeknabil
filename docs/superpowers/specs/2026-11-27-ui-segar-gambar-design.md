# UI segar dan gambar rapi — desain singkat

## Intent

Kamu minta tampilan dibuat lebih bagus, gambar dibetulkan, dan gaya diubah. Dari tiga pilihan yang ditunjukkan di browser, kamu memilih yang ketiga: segar dan terbuka.

## Goals

- Tampilan lebih segar dan lapang, tapi tetap mudah dibaca.
- Gambar tampil rapi: logo klien tidak terpotong, gambar produk dan proyek punya tinggi yang sama.
- Perubahan tetap aman di 1280 px dan 390 px tanpa overflow horizontal.

## Non-goals

- Mengganti teks, struktur halaman, atau susunan blok Elementor.
- Menambah gambar baru. Semua文件 sudah ada di `wp-content/uploads/2026/11/`.
- Mengubah warna biru utama `#1c6bb0` yang sudah dikenal sebagai warna GOCL.

## Constraints

- Tema aktif tetap `gocl-pemula`.
- Enam halaman tetap tersedia: beranda, about-us, products, clients, portfolio, contact.
- Kredensial hosting tidak ditulis ke file atau log.
- Hasil akhir harus tampil di lokal, hosting, dan repo GitHub.

## Approaches

1. **CSS tema saja.** Paling kecil, tapi tidak bisa mengembalikan logo klien yang sudah dipotong jadi thumbnail 150×150. Tidak cukup untuk masalah gambar.
2. **Ubah isi Elementor di database.** Gambar bisa diganti satu per satu, tapi menyentuh konten dan sulit dibatalkan.
3. **Filter ukuran galeri di `functions.php` ditambah CSS tema** (dipilih). Galeri WordPress defaultnya memakai thumbnail kotak. Filter mengubah ukuran bawaan ke `large`, lalu CSS mengatur kotak gambar yang seragam. Tidak menyentuh isi Elementor, dan perubahannya dua baris PHP.

Pilihan gaya: **Segar & terbuka** (dipilih). Dua alternatif lain, bersih-modern dan biru tua korporat, tidak dipakai.

## Design yang disetujui

- Warna utama `#1c6bb0` tetap dipakai untuk tautan, tombol, dan menu aktif.
- Aksen baru hijau laut `#147d76` dipakai untuk logo teks, garis bawah judul bagian, dan gradasi hero.
- Latar bagian selang-seling `#ffffff` dan `#eef8f5`. Border lembut `#e1ece8`.
- Sudut kartu dan gambar 14 px, sudut tombol 10 px. Jarak bagian 64 px, lebar konten 1120 px.
- Hero memakai gradasi `#147d76` ke `#1c6bb0`, teks putih, tinggi minimal 420 px.
- Footer memakai warna `#243c3a`, teks terang, border atas hijau laut.
- Logo klien memakai ukuran `large` dan `object-fit: contain` dalam kotak 140 px, supaya sisi logo tidak terpotong.
- Gambar proyek dan produk memakai kotak tinggi 180–200 px dengan `object-fit: cover`, supaya barisnya rapi.
- Foto tim memakai kotak 320 px dengan `object-fit: cover`.

## Yang tersisa untuk implementasi

- Tambah filter ukuran galeri di `functions.php`.
- Sesuaikan deklarasi di `style.css` tanpa menambah file baru.
- Cek enam halaman di lokal dan hosting pada 1280×900 serta 390×844, termasuk computed style gambar dan saturasi warna.
- Unggah `style.css` dan `functions.php` yang berubah ke hosting, lalu commit dan push ke GitHub.
