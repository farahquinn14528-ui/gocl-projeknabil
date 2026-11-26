# Rapiikan UI GOCL — desain singkat

## Intent

Kamu minta tampilan sedikit dirapikan. Arahnya merapikan kesan, bukan menyusun ulang konten. Situs tetap terasa sederhana seperti sebelumnya.

## Goals

- Tipografi, jarak, warna, dan footer lebih konsisten.
- Perubahan masuk lewat satu file CSS tema.
- Konten Elementor di `home`, `about-us`, `products`, `clients`, dan `portfolio` tidak diubah.
- `contact` tetap tanpa Elementor.

## Non-goals

- Menambah fitur, animasi, atau komponen baru.
- Mengganti struktur halaman atau blok Elementor.
- Mengubah `header.php`, `footer.php`, `functions.php`, atau konfigurasi WordPress.

## Constraints

- Tema aktif: `gocl-pemula`.
- Warna utama tetap biru `#1c6bb0`.
- Tampilan sengaja polos; perubahan ini hanya merapikan, tidak membuat desain baru.
- Perlu aman di 1280 px dan 390 px tanpa overflow horizontal.

## Approaches

1. **CSS tema saja** (dipilih). Satu diff di `style.css`. Paling kecil, tidak menyentuh konten, mudah di-rollback.
2. **Menyusun ulang blok Elementor.** Lebih terlihat di beranda, tapi menyentuh lima halaman dan berisiko menggeser konten yang sudah ada.
3. **Child theme atau design system baru.** Terlalu besar untuk permintaan "sedikit dirapikan".

## Design yang disetujui

- Judul memakai stack sans-serif yang sama dengan body; ukuran `h1` 34 px, `h2` 26 px, `h3` 19 px, line-height 1,3.
- `.wrap` maksimal 1120 px. `.section` padding 56 px vertikal. `.section-alt` jadi `#f5f7fa`.
- Menu tetap putih dengan border halus; tautan padding `14px 18px`; item aktif tetap biru.
- Kartu, kotak info, dan gambar dapat radius 4 px dan border `#e3e8ee`; padding kartu 16 px.
- Gap portofolio 16 px; gap footer 32 px; footer bawah lebih renggang dan border lebih lembut.
- Breakpoint tetap 900 px dan 600 px. Menu mobile tetap bertumpuk dengan area klik lebih besar.
- Tidak ada file PHP, aset baru, atau dependency baru yang diubah.

## Yang tersisa untuk implementasi

- Terapkan diff CSS di `wp-content/themes/gocl-pemula/style.css`.
- Cek lokal di 1280×900 dan 390×844, enam halaman, tanpa overflow horizontal.
- Unggah `style.css` yang berubah ke hosting dan cek ulang URL live.
- Commit dan push perubahan ke repo GitHub `gocl-projeknabil`.
