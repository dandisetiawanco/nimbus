# NIMBUS CMS

Sistem Content Management System (CMS) modern yang dibangun menggunakan:
- Laravel 12 (PHP 8.4+)
- MySQL (Bisa juga SQLite untuk testing)
- Blade + Tailwind CSS
- Trix Editor untuk Richtext Content
- Spatie Laravel-Permission untuk Role & Akses

## Persyaratan (Environment)
- PHP >= 8.4
- Node.js & NPM
- Composer
- Server Database MySQL (XAMPP / MAMP) atau SQLite 

## Cara Instalasi & Menjalankan (Run)
1. Buka folder `nimbus` di terminal
2. Copy `.env.example` ke `.env` (jika `.env` belum ada)
3. Sesuaikan konfigurasi database `.env` Anda dengan kredensial MySQL. Pastikan database bernama `nimbus` sudah Anda buat di MySQL (Misalnya `CREATE DATABASE nimbus;`). 
   _Catatan: Jika memakai MAMP, pastikan DB_PORT sesuai, bisa `3306` atau `8889`._
4. Install dependensi PHP & Node:
   ```bash
   composer install
   npm install && npm run build
   ```
5. Binding Storage (Symlink) dan Migrasi + Seeder
   ```bash
   php artisan storage:link
   php artisan migrate:fresh --seed
   ```
6. Jalankan Local Server
   ```bash
   php artisan serve
   ```
   Akses `http://localhost:8000` atau URL web Anda (misalnya `http://localhost/nimbus/public`).

## Akun Default Admin
Saat seeder (`php artisan db:seed`) dijalankan, akun-akun berikut akan dibuat:

- **Admin Account:**
  - Email: `admin@nimbuscms.test`
  - Password: `password`
- **Author Account:**
  - Email: `author@nimbuscms.test`
  - Password: `password`

## Struktur Permission & Role (Spatie)
CMS ini memiliki 4 level Roles dasar:
- **Admin**: Akses mutlak (`Permission::all()`).
- **Editor**: Dapat mengatur semua pages, posts, media, menus, dan components.
- **Author**: Hanya bisa membuat dan mengubah data post miliknya sendiri (`create own posts`, `edit own posts`) dan mengunggah gambar/media (`upload media`).
- **Viewer**: Read-only halaman admin.

## Cara Upload Media & Set Featured Image
1. Upload form/button disediakan pada halaman **Media Library** (Admin).
2. Sistem akan menyimpan berkas ke `storage/app/public` dan ter-link karena sudah menjalankan `storage:link`.
3. Pada saat create/edit form di **Pages** atau **Posts**, pengguna bisa memilih ID media yang sebelumnya di-upload untuk kolom `featured_image_id`.
4. Render gambar di Blade dapat diambil pada object property dari URL Media, misalnya:
   `<img src="{{ $post->featuredImage->url }}" alt="...">`

Fitur telah direalisasikan termasuk: Form Validation request, Security Policies (Author tidak bisa edit punya pengguna lain), Seeding komplit, UI Admin + Frontend, Tailwind Styling (Dark Mode), Route grouping dengan Middleware per level, serta Testing Unit/Feature.
