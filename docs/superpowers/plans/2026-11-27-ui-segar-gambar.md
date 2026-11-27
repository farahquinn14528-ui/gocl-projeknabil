# UI segar dan gambar rapi Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Ubah tampilan enam halaman GOCL ke gaya segar dan terbuka serta perbaiki gambar yang terpotong dan tinggi gambar yang tidak seragam, lalu publish ke hosting dan GitHub.

**Architecture:** Dua file tema. `functions.php` mengganti ukuran bawaan galeri WordPress dari thumbnail ke `large` supaya logo tidak terpotong. `style.css` mengganti deklarasi lama dan menambah override selektif untuk kelas Elementor yang benar-benar dipakai konten; kelas tema lama yang tidak pernah muncul di DOM dihapus.

**Tech Stack:** WordPress, tema `gocl-pemula`, Elementor Flexbox Container, CSS, filter PHP `shortcode_atts_gallery`.

**Spec:** `docs/superpowers/specs/2026-11-27-ui-segar-gambar-design.md`

## Global Constraints

- Teks situs dan balasan dalam Bahasa Indonesia.
- Warna biru utama `#1c6bb0`, aksen hijau laut `#147d76`, latar `#eef8f5`, border `#e1ece8`, radius kartu/gambar 14 px, radius tombol 10 px, jarak bagian 64 px, lebar konten 1120 px.
- Tidak menambah gambar baru; semua berkas sudah ada di `wp-content/uploads/2026/11/`.
- Tidak mengubah isi Elementor di database.
- Enam halaman: `/`, `/about-us/`, `/products/`, `/clients/`, `/portfolio/`, `/contact/`.
- Aman di 1280×900 dan 390×844 tanpa overflow horizontal, HTTP 200, tanpa error console/PHP.
- `http://localhost/wordpress/` dan `http://localhost/gocl/` tidak diubah.
- Kredensial hosting tidak ditulis ke file, config, atau log.

## Review Focus

- Logo klien yang sekarang dipotong jadi 150×150 harus memakai berkas full-size dan `object-fit: contain`.
- Gambar produk dengan tinggi tampil 52–300 px harus seragam tanpa meregang.
- Galeri proyek harus seragam dan tidak overflow di layar 390 px.
- Warna Elementor (judul biru muda `#6ec1e4`, tombol hijau `#61ce70`) harus kalah dengan gaya baru.
- Footer dan header tetap terbaca di kedua breakpoint.

---

### Task 1: Ukuran gambar galeri

**Files:**
- Modify: `wp-content/themes/gocl-pemula/functions.php`

**Interfaces:**
- Produces: filter `shortcode_atts_gallery` yang mengembalikan `size = large` untuk semua galeri.

- [ ] **Step 1: Tambah filter ukuran galeri**

Tambahkan fungsi pendek setelah `gocl_assets()` yang menerima array `$out` dan mengembalikan `$out` dengan `$out['size'] = 'large'`, lalu daftarkan lewat `add_filter( 'shortcode_atts_gallery', ... )`.

- [ ] **Step 2: Periksa sintaks PHP**

Run: `php -l wp-content/themes/gocl-pemula/functions.php`
Expected: `No syntax errors detected`.

### Task 2: Gaya segar dan kotak gambar seragam

**Files:**
- Modify: `wp-content/themes/gocl-pemula/style.css`

**Interfaces:**
- Consumes: galeri sekarang memakai berkas `large` dari Task 1.
- Produces: aturan CSS untuk header, menu, footer, konten Elementor, dan kotak gambar.

- [ ] **Step 1: Perbarui deklarasi tema yang dipakai**

Ubah warna, radius, dan jarak pada `body`, `a`, `h1..h4`, `.topbar`, `.site-header`, `.site-logo`, `.site-nav`, `.btn`, `.page-wrap`, `.site-footer`, `.footer-bottom`, dan media query sesuai spec. Hapus blok `.grid*`, `.client-grid`, `.card`, `.value-list`, `.portfolio-grid`, `.team-img`, `.cta`, `.info-grid`, `.info-box`, `.section*`, `.hero`, `.section-title` yang tidak dipakai DOM.

- [ ] **Step 2: Tambah override Elementor yang ringkas**

Tambah blok di akhir file yang menargetkan `.elementor h1/h2/h3`, `.elementor .e-con.e-parent:nth-child(even)`, `.elementor-button`, `.elementor-widget-image-gallery .gallery-item img`, `.elementor-widget-image img`, dan `.page-id-6 .elementor-widget-image img`. Gambar galeri memakai `object-fit: contain` dalam kotak 140 px; gambar produk dan proyek memakai `object-fit: cover` dalam kotak tinggi seragam. Gunakan `!important` hanya pada deklarasi yang ditimpa Elementor.

- [ ] **Step 3: Pratinjau tanpa menyentuh hosting**

Suntikkan isi `style.css` ke halaman live lewat browser dan ganti `src` galeri ke berkas full-size untuk simulasi filter. Cek computed style dan lebar dokumen di 1280×900 serta 390×844. Expected: tidak ada overflow, gambar tidak terpotong, tinggi gambar seragam.

### Task 3: Publish dan verifikasi

**Files:**
- Modify: `docs/superpowers/specs/2026-11-27-ui-segar-gambar-design.md` (tanda selesai bila perlu)
- Remote: FTP `wp-content/themes/gocl-pemula/style.css` dan `functions.php`; GitHub `main`.

**Interfaces:**
- Consumes: hasil Task 1 dan Task 2.

- [ ] **Step 1: Unggah dua file ke hosting**

Run: `curl -T` ke `ftp://latihanwebdesain.my.id/wp-content/themes/gocl-pemula/style.css` dan `.../functions.php` memakai kredensial dari environment variable. Jangan menulis kredensial ke file atau log.

Expected: HTTP/FTP transfer selesai tanpa error; hash lokal sama dengan berkas yang diunduh kembali.

- [ ] **Step 2: Verifikasi enam halaman live**

Run: browser pada 1280×900 dan 390×844 untuk enam URL.
Expected: HTTP 200, tidak ada overflow horizontal, console bersih, semua gambar termuat, galeri memakai berkas `large`, kotak gambar seragam.

- [ ] **Step 3: Commit dan push**

Run: `git add` untuk dua file tema, spec, dan plan; `git commit`; `git push origin main`.
Expected: commit baru terlihat di `origin/main`.

- [ ] **Step 4: Review akhir**

Jalankan review mandiri terhadap diff dan bandingkan hasil live dengan spec.
