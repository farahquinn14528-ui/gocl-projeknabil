# UI segar dan gambar rapi — desain singkat

## Intent

Kamu minta tampilan dibuat lebih bagus, gambar dibetulkan, dan gaya diubah. Dari tiga pilihan yang ditunjukkan di browser, kamu memilih yang ketiga: segar dan terbuka.

## Goals

- Tampilan lebih segar dan lapang, tapi tetap mudah dibaca.
- Gambar tampil rapi: logo klien tidak terpotong, gambar produk dan proyek punya tinggi yang sama.
- Perubahan tetap aman di 1280 px dan 390 px tanpa overflow horizontal.

## Non-goals

- Mengganti teks, struktur halaman, atau susunan blok Elementor.
- Menambah gambar baru. Semua berkas sudah ada di `wp-content/uploads/2026/11/`.
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
- Aksen baru hijau laut `#147d76` dipakai untuk logo teks, garis bawah judul bagian, dan latar bagian selang-seling.
- Latar bagian selang-seling `#ffffff` dan `#eef8f5`. Border lembut `#e1ece8`.
- Sudut kartu dan gambar 14 px, sudut tombol 10 px. Jarak bagian 64 px, lebar konten 1120 px.
- Hero memakai gambar yang sudah ada, tinggi 420 px desktop dan 240 px mobile.
- Footer memakai warna `#243c3a`, teks terang, border atas hijau laut.
- Logo klien memakai ukuran `large` dan `object-fit: contain` dalam kotak 140 px, supaya sisi logo tidak terpotong.
- Gambar proyek dan produk memakai kotak tinggi 180–200 px dengan `object-fit: cover`, supaya barisnya rapi.
- Foto tim memakai kotak 320 px dengan `object-fit: cover`.

## Status implementasi

- Filter ukuran galeri dan perbaikan `src` galeri yang tersimpan di cache Elementor ada di `functions.php`.
- Gaya dan kotak gambar sudah disesuaikan di `style.css` tanpa menambah berkas baru.
- Enam halaman lokal sudah dicek pada 1280×900 dan 390×844: tidak ada overflow horizontal, gambar termuat, ukuran gambar seragam.
- GitHub sudah menerima perubahan ini di `main`.
- Tautan yang mengikuti perubahan sudah live di `https://gocl-projeknabil.vercel.app`. Mirror statisnya memakai `style.css` yang sama dengan lokal dan berkas gambar ukuran penuh.
- Enam halaman di URL tersebut terverifikasi HTTP 200 pada 1280×900 dan 390×844: tanpa overflow horizontal, console bersih, galeri tanpa thumbnail, ukuran gambar seragam.
- Domain WordPress lama `https://projeknabil.latihanwebdesain.my.id/` belum berubah karena kredensial FTP/cPanel belum tersedia.
