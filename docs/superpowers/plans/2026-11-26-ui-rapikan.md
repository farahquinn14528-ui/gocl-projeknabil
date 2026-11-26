# Perapian UI GOCL Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Merapikan tampilan GOCL lewat perubahan CSS tema saja, lalu memastikan hasilnya tampil di lokal, hosting, dan GitHub.

**Architecture:** Satu diff di `wp-content/themes/gocl-pemula/style.css` mengubah tipografi, jarak, warna, border, dan radius. Tidak ada perubahan PHP, aset, atau blok Elementor. Set lokal diverifikasi, file CSS diunggah ke hosting, lalu commit didorong ke repo GitHub.

**Tech Stack:** WordPress 6.x, tema `gocl-pemula`, CSS, cPanel/FTP, gh CLI, browser Chrome DevTools.

**Spec:** `docs/superpowers/specs/2026-11-26-ui-rapikan-design.md`

## Global Constraints

- Tema aktif tetap `gocl-pemula`.
- Warna utama tetap `#1c6bb0`.
- Tampilan tetap polos; tidak menambah fitur, animasi, atau komponen baru.
- Konten Elementor di `home`, `about-us`, `products`, `clients`, dan `portfolio` tidak diubah.
- Halaman `contact` tetap tanpa Elementor.
- Tidak mengubah `header.php`, `footer.php`, `functions.php`, atau aset gambar.
- Aman di 1280×900 dan 390×844 tanpa overflow horizontal.
- Kredensial FTP/cPanel tidak boleh ditulis ke file, config, atau log.

## Review Focus

- Gaya inline Elementor bisa mengalahkan CSS tema; cek heading dan kartu di halaman Elementor, bukan hanya beranda lokal.
- Menu mobile bisa meluber di 390 px; cek `document.documentElement.scrollWidth <= window.innerWidth` pada keenam halaman.
- Border dan radius baru bisa membuat gambar clients/portfolio tampak terpotong; cek gambar masih `object-fit: contain` untuk clients dan `cover` untuk portfolio.
- Footer empat kolom bisa bertumpuk buruk di 390 px; cek `.footer-cols` jadi satu kolom lewat breakpoint 600 px.
- Upload FTP bisa salah path atau tersimpan cache lama; cek CSS live mengandung `max-width: 1120px` setelah upload.

---

### Task 1: Rapikan CSS tema dan verifikasi lokal

**Files:**
- Modify: `wp-content/themes/gocl-pemula/style.css`
- Modify: `.gitignore` (already contains `.superpowers/`; include in commit)

**Interfaces:**
- Consumes: nilai desain dari spec: `#1c6bb0`, `#f5f7fa`, `#e3e8ee`, `1120px`, `56px`, `4px`, `16px`, `32px`.
- Produces: `style.css` yang siap diunggah dan commit lokal.

- [ ] **Step 1: Jalankan pengecekan awal yang harus gagal**

Run:

```powershell
Select-String -Path 'C:\xampp\htdocs\gocl\wp-content\themes\gocl-pemula\style.css' -Pattern 'max-width: 1120px' -Quiet
```

Expected: `False` (exit code 1). Ini menandakan CSS lama belum dirapikan.

- [ ] **Step 2: Terapkan perubahan CSS dengan nilai pasti**

Di `style.css`, ubah saja deklarasi ini:

- `h1,h2,h3,h4`: `font-family: Arial, Helvetica, sans-serif;` dan `line-height: 1.3;`
- `h1`: `font-size: 34px;`
- `h2`: `font-size: 26px;`
- `h3`: `font-size: 19px;`
- `.wrap`: `max-width: 1120px;`
- `.topbar`: `background: #f7f7f7;`
- `.site-header`: `padding: 22px 0;`
- `.site-nav`: `background: #ffffff;` dan border `1px solid #e3e8ee;`
- `.site-nav a`: `padding: 14px 18px;`
- `.btn`: `border-radius: 4px;`
- `.section`: `padding: 56px 0;`
- `.section-alt`: `background: #f5f7fa;`
- `.client-grid`: `gap: 16px;`
- `.client-grid img`: `border: 1px solid #e3e8ee;`, `border-radius: 4px;`, `padding: 12px;`
- `.card`: `border: 1px solid #e3e8ee;`, `padding: 16px;`, `border-radius: 4px;`
- `.card img`: `border-radius: 4px;`
- `.portfolio-grid`: `gap: 16px;`
- `.portfolio-grid img`: `border: 1px solid #e3e8ee;`, `border-radius: 4px;`
- `.team-img`: `border: 1px solid #e3e8ee;`, `border-radius: 4px;`
- `.info-box`: `border: 1px solid #e3e8ee;`, `padding: 16px;`, `border-radius: 4px;`
- `.footer-cols`: `gap: 32px;`
- `.footer-bottom`: `border-top: 1px solid #4a4f55;`, `margin-top: 32px;`, `padding: 18px 0;`

Jangan menambah aturan baru, variabel CSS, atau file CSS lain.

- [ ] **Step 3: Jalankan ulang pengecekan CSS**

Run:

```powershell
Select-String -Path 'C:\xampp\htdocs\gocl\wp-content\themes\gocl-pemula\style.css' -Pattern 'max-width: 1120px' -Quiet
```

Expected: `True`.

- [ ] **Step 4: Cek enam halaman lokal kembali HTTP 200**

Run:

```powershell
$pages = @('/','/about-us/','/products/','/clients/','/portfolio/','/contact/')
foreach ($p in $pages) { $c = curl.exe -s -o NUL -w '%{http_code}' ("http://localhost/gocl$p"); Write-Output "$p=$c" }
```

Expected: semua `=200`.

- [ ] **Step 5: Cek overflow di 1280×900 dan 390×844**

Pakai Chrome DevTools: buka `http://localhost/gocl/`, resize ke `1280×900`, lalu evaluasi:

```javascript
() => ({ w: window.innerWidth, sw: document.documentElement.scrollWidth })
```

Ulangi untuk `390×844` dan untuk keenam URL di Step 4. Expected: `sw <= w` di semua kombinasi.

Pada 390 px, evaluasi juga:

```javascript
() => ({
  footerCols: getComputedStyle(document.querySelector('.footer-cols')).gridTemplateColumns,
  clientFit: document.querySelector('.client-grid img') ? getComputedStyle(document.querySelector('.client-grid img')).objectFit : 'absent',
  portfolioFit: document.querySelector('.portfolio-grid img') ? getComputedStyle(document.querySelector('.portfolio-grid img')).objectFit : 'absent'
})
```

Expected: `footerCols` satu kolom, `clientFit` `contain`, `portfolioFit` `cover` bila elemen ada.

- [ ] **Step 6: Cek CSS benar-benar dipakai browser**

Evaluasi di halaman lokal:

```javascript
() => ({ maxWidth: getComputedStyle(document.querySelector('.wrap')).maxWidth, radius: getComputedStyle(document.querySelector('.card') || document.body).borderRadius })
```

Expected: `maxWidth` `1120px`. `radius` `4px` bila `.card` ada di halaman itu.

- [ ] **Step 7: Commit**

```bash
git add wp-content/themes/gocl-pemula/style.css .gitignore docs/superpowers/plans/2026-11-26-ui-rapikan.md
git commit -m "style: rapikan tampilan tema GOCL"
```

### Task 2: Unggah ke hosting dan verifikasi publik

**Files:**
- No new files. Consumes the committed `style.css` from Task 1.

**Interfaces:**
- Consumes: `wp-content/themes/gocl-pemula/style.css` dari Task 1.
- Produces: style yang sama aktif di `https://projeknabil.latihanwebdesain.my.id/` dan commit yang sama di `origin/main`.

- [ ] **Step 1: Unggah `style.css` lewat FTP**

Ambil kredensial FTP dari konteks sesi, jangan tulis ke disk. Run dengan variabel lingkungan:

```powershell
curl.exe --ftp-pasv -T 'C:\xampp\htdocs\gocl\wp-content\themes\gocl-pemula\style.css' -u "$env:GOCL_FTP_USER:$env:GOCL_FTP_PASS" 'ftp://latihanwebdesain.my.id/public_html/projeknabil/wp-content/themes/gocl-pemula/style.css'
```

Expected: exit code 0.

- [ ] **Step 2: Cek CSS live terbaru**

Run:

```powershell
$css = curl.exe -s 'https://projeknabil.latihanwebdesain.my.id/wp-content/themes/gocl-pemula/style.css?ui=rapikan'; Write-Output ($css -match 'max-width:\s*1120px')
```

Expected: `True`.

- [ ] **Step 3: Cek enam halaman live HTTP 200 dan tanpa error browser**

Run HTTP check untuk enam URL yang sama seperti Task 1 Step 4 dengan base `https://projeknabil.latihanwebdesain.my.id`. Expected: semua `=200`. Lalu buka beranda dan `contact` di Chrome DevTools, cek `list_console_messages` tidak ada error baru.

- [ ] **Step 4: Cek overflow live di 1280×900 dan 390×844**

Ulangi evaluasi scrollWidth dari Task 1 Step 5 pada URL live. Expected: `sw <= w` di semua halaman.

- [ ] **Step 5: Push ke GitHub**

```bash
git push origin main
```

Expected: `main` remote sama dengan HEAD lokal.

- [ ] **Step 6: Verifikasi remote**

```bash
git ls-remote origin refs/heads/main
git rev-parse HEAD
```

Expected: SHA keduanya sama.
