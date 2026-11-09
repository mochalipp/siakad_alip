# SIAKAD — Sistem Informasi Akademik

Aplikasi SIAKAD berbasis **Laravel 9**, dibangun dari materi **PBO Pertemuan 12**
(Pemrograman Berorientasi Objek 1, Politeknik Negeri Subang, dosen Erick Febriyanto, S.Kom., M.TI.).

Materi sumber (3 PDF):
- Part 1 — Read & Detail Data
- Part 2 — Create, Update & Delete Data
- Part 3 — Login, Register, Logout, Print, Chart & ID Otomatis

## Cara menjalankan

> **Penting:** folder `vendor/` tidak disertakan dalam zip ini, karena PHP dan
> Composer tidak tersedia di mesin tempat project ini dibuat. Jalankan
> langkah berikut di komputer sendiri (XAMPP/Laragon atau PHP 8.0+).

```bash
# 1. Masuk ke folder project
cd pbo12-siakad

# 2. Install dependensi (wajib, pertama kali)
composer install

# 3. Salin file environment dan generate key
cp .env.example .env
php artisan key:generate

# 4. Buat database MySQL bernama "siakad" (misalnya lewat phpMyAdmin),
#    lalu sesuaikan DB_USERNAME / DB_PASSWORD di file .env bila perlu.
#    Default di .env.example: host 127.0.0.1, user root, password kosong.

# 5. Migrasi + isi data contoh
php artisan migrate --seed

# 6. Jalankan server
php artisan serve
```

Buka http://localhost:8000 — halaman login akan muncul.

Tidak perlu `npm install` / `npm run dev`: semua CSS & JS (Bootstrap 4,
AdminLTE 3.2, Font Awesome, DataTables, Chart.js) diambil dari CDN
(lihat bagian Asumsi).

## Akun bawaan (hasil seeder)

Password semua akun: `password123` — **ganti setelah instalasi pertama!**

| Email | Level | Keterangan |
|---|---|---|
| admin@siakad.test | 1 | Admin |
| user@siakad.test | 2 | User |
| mahasiswa@siakad.test | 3 | Mahasiswa |
| dosen@siakad.test | 4 | Dosen |

Data dosen contoh (dari screenshot materi): Mohammad Iqbal, S.Kom., M.T.
(NIP 199001262019031025, Pemrograman Berorientasi Objek) dan
Tri Herdiawan Apandi, S.ST., M.T. (NIP 198801052019031001, Data Mining).

## Fitur

### Part 1 — Read & Detail
- Halaman Dosen (`/dosen`): DataTable AdminLTE dengan kolom No, NIP, Nama
  Dosen, Mata Kuliah, Foto Dosen, Action (Detail/Edit/Delete), tombol Add
  Data, export Copy/CSV/Excel/PDF/Print, search dan pagination.
- Halaman Detail Dosen (`/dosen/detail/{id_dosen}`): kartu "Quick Example"
  berisi NIP, Nama, Mata Kuliah, Foto, tombol Kembali.
- Model `M_Dosen` memakai **Query Builder** (`DB` facade), bukan Eloquent:
  `allData()`, `detailData($id_dosen)`.
- Controller `C_Dosen`: `index()`, `detail()` (cek data dulu, kalau tidak
  ada `abort(404)`).
- Sidebar: Home, Dosen, Mahasiswa, User (khusus Admin), About, Logout.

### Part 2 — Create, Update & Delete
- `M_Dosen` ditambah `addData()`, `editData()`, `deleteData()`.
- `C_Dosen`: `add()`, `insert()` (validasi + upload foto + redirect dengan
  pesan), `edit()`, `update()` (2 cabang: ganti foto / tidak), `delete()`
  (hapus file foto dulu dengan `unlink`, baru hapus data).
- Validasi insert: NIP `required|unique:tb_dosen,nip|min:17|max:18`, nama
  dan mata kuliah wajib, foto wajib `mimes:jpg,jpeg,png,bmp|max:1024`
  (maks 1 MB), dengan pesan error kustom Bahasa Indonesia.
- Validasi update: NIP **tanpa** `unique` (karena tidak berubah), foto
  tidak wajib.
- Nama file foto = **NIP + ekstensi asli**, disimpan di `public/foto_dosen/`.
- Form: `v_adddosen` (`old()` + `@error` + `@csrf` + `enctype="multipart/form-data"`),
  `v_editdosen` (NIP `readonly` + preview foto lama).
- Modal konfirmasi hapus per baris di `v_dosen` (tombol Yes = link
  `/dosen/delete/{id}`, No = tutup modal).
- Flash message memakai key session `pesan`, ditampilkan sebagai alert hijau.
- **Latihan soal (tugas):** seluruh pola di atas direplikasi untuk
  **Mahasiswa** — `M_Mahasiswa`, `C_Mahasiswa`, view `v_mahasiswa`,
  `v_detailmahasiswa`, `v_addmahasiswa`, `v_editmahasiswa`, route
  `/mahasiswa/...` dengan key **NIM** (varchar 20, primary key), foto ke
  `public/foto_mahasiswa/` dengan nama file **NIM + ekstensi**.

### Part 3 — Login, Register, Logout, Print, Chart & ID Otomatis
- Login multiuser 4 level (tabel `users` + field `level`): 1 Admin,
  2 User, 3 Mahasiswa, 4 Dosen. Middleware `admin`, `user`,
  `mahasiswa`, `dosen` didaftarkan di `app/Http/Kernel.php` dan dipakai
  di route yang sensitif (tambah/edit/hapus hanya Admin; halaman User
  hanya Admin). Navigasi/sidebar juga menyesuaikan level (menu User hanya
  tampil untuk Admin).
- Register (`/register`): nama, email, password + konfirmasi, pilih level.
- Print PDF: tombol "Print PDF" di halaman Dosen/Mahasiswa, memakai
  `dompdf/dompdf` (lihat `composer.json`), controller `print()` +
  view `v_print` / `v_print_mahasiswa`, kertas A4 portrait.
- Chart (Chart.js) di Home: jumlah Dosen per Mata Kuliah dan jumlah
  Mahasiswa per Prodi.
- ID Otomatis: `id_dosen` digenerate sistem = nilai maksimum yang ada + 1
  (method `M_Dosen::getNextId()`), ditampilkan di form tambah sebagai
  field readonly. NIM tetap identitas mahasiswa: form tambah menampilkan
  **saran NIM otomatis** (tahun berjalan + nomor urut 3 digit, misal
  2026001) yang masih bisa diubah manual sebelum disimpan
  (`M_Mahasiswa::generateNim()`).

## Route (routes/web.php)

| Method | URI | Controller | Keterangan |
|---|---|---|---|
| GET | `/` | C_Login@index | Halaman login |
| POST | `/login` | C_Login@login | Proses login |
| GET | `/logout` | C_Login@logout | Logout |
| GET | `/register` | C_Register@index | Form register |
| POST | `/register` | C_Register@store | Simpan akun |
| GET | `/home` | C_Home@index | Dashboard + chart (auth) |
| GET | `/about` | C_Home@about | About (auth) |
| GET | `/about2/{id}` | C_Home@about2 | About + id (auth) |
| GET | `/user` | C_User@index | Daftar user (auth + admin) |
| GET | `/dosen` | C_Dosen@index | Daftar dosen (auth, name: dosen) |
| GET | `/dosen/print` | C_Dosen@print | Print PDF (auth) |
| GET | `/dosen/detail/{id_dosen}` | C_Dosen@detail | Detail (auth) |
| GET | `/dosen/add` | C_Dosen@add | Form tambah (auth + admin) |
| POST | `/dosen/insert` | C_Dosen@insert | Simpan (auth + admin) |
| GET | `/dosen/edit/{id_dosen}` | C_Dosen@edit | Form edit (auth + admin) |
| POST | `/dosen/update/{id_dosen}` | C_Dosen@update | Update (auth + admin) |
| GET | `/dosen/delete/{id_dosen}` | C_Dosen@delete | Hapus (auth + admin) |
| GET | `/mahasiswa` (+ print/detail/add/insert/edit/update/delete) | C_Mahasiswa | Paralel dengan Dosen, key `{nim}` (name: mahasiswa) |

## Struktur file penting

```
app/Http/Controllers/C_Dosen.php, C_Mahasiswa.php, C_Login.php,
  C_Register.php, C_Home.php, C_User.php
app/Http/Middleware/CekAdmin.php, CekUser.php, CekMahasiswa.php, CekDosen.php
app/Models/M_Dosen.php, M_Mahasiswa.php, M_User.php, User.php
database/migrations/  (users + level, tb_dosen, tb_mahasiswa, ...)
database/seeders/     (DatabaseSeeder, UserSeeder, DosenSeeder, MahasiswaSeeder)
resources/views/layout/v_template.blade.php, v_template_tables.blade.php, v_nav.blade.php
resources/views/v_dosen, v_detaildosen, v_adddosen, v_editdosen,
  v_mahasiswa, v_detailmahasiswa, v_addmahasiswa, v_editmahasiswa,
  v_login, v_register, v_home, v_user, v_about, v_print, v_print_mahasiswa
public/foto_dosen/, public/foto_mahasiswa/  (tempat upload foto)
```

## Asumsi yang dibuat (tidak dirinci di materi)

1. **CDN, bukan asset lokal.** AdminLTE 3.2, Bootstrap 4.6, Font Awesome 5,
   DataTables + Buttons, dan Chart.js dimuat dari CDN di layout Blade.
   Perlu koneksi internet saat membuka aplikasi. File `resources/css/app.css`
   dan `resources/js/app.js` tetap ada (standar scaffold) tapi hanya berisi
   tambahan kecil.
2. **ID Otomatis Dosen** = max(`id_dosen`) + 1 (materi tidak merinci
   formatnya). **NIM** tetap diinput (identitas), tapi form memberi saran
   NIM otomatis tahun + nomor urut yang bisa diubah.
3. **Kolom foto nullable** di migrasi (`foto_dosen`, `foto`) supaya seeder
   dan data awal bisa dibuat tanpa file foto; di form tambah foto tetap
   wajib sesuai validasi materi. View menampilkan `-` kalau foto kosong.
4. **Print PDF** memakai paket `dompdf/dompdf` langsung (sesuai perintah
   `composer require dompdf/dompdf` di materi), tanpa wrapper tambahan.
   Controller membuat instance `Dompdf\Dompdf` dan me-render view `v_print`.
5. **Tambahan di luar materi (kecil):** route + tombol Print PDF untuk
   Mahasiswa (paralel dengan Dosen), dan seeder contoh 2 mahasiswa.
6. **Middleware level** mengecek `Auth::user()->level` dan mengarahkan ke
   `/home` dengan pesan bila level tidak sesuai (materi tidak merinci
   perilaku saat akses ditolak).
7. **Timezone** aplikasi diset `Asia/Jakarta`, locale `id`.

## Jebakan dari materi (perhatian!)

1. **Delete memakai GET** (`/dosen/delete/{id}` dan link "Yes" di modal
   adalah `<a href>` biasa, tanpa CSRF). Ini pola materi, bukan best
   practice REST (seharusnya DELETE + form). Diikuti apa adanya supaya
   sesuai tugas, tapi jangan dipakai untuk aplikasi produksi.
2. **`php artisan migrate:fresh` menghapus SEMUA data** (drop semua tabel
   lalu migrate ulang). Backup/seed dulu sebelum menjalankannya. Untuk
   menjalankan ulang seeder tanpa menghapus tabel: `php artisan db:seed`.
3. **Validasi update di slide tertulis `'foto_dosen' => '|mimes:...'`**
   (ada karakter `|` di depan) — kemungkinan salah ketik di slide.
   Di project ini rule ditulis tanpa pipe di depan.
4. **Query ganda di `detail()`**: materi memanggil `detailData()` dua kali
   (cek `abort(404)` lalu isi data). Di project ini dipertahankan polanya
   supaya sama dengan materi, tapi lebih efisien bila disimpan dulu ke
   variabel.
5. **Nama file foto = NIP/NIM + ekstensi**: update foto menimpa file lama
   dengan nama yang sama; file foto lama **tidak** dihapus saat update
   (hanya saat delete via `unlink`). Kalau NIP/NIM berubah, bisa muncul
   file yatim di folder foto.
6. **Model memakai Query Builder, bukan Eloquent**: tidak ada `$table`,
   `$primaryKey`, atau `$fillable` di `M_Dosen`/`M_Mahasiswa`; semua query
   lewat `DB::table(...)`. (Model `User` untuk Auth tetap Eloquent
   standar Laravel, karena Auth membutuhkannya.)

## Referensi materi

- http://id-laravel.com/post/instalasi-laravel-9/
- https://www.sekolahkoding.com/kelas/tag/laravel
