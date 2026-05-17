# CPX Official

CPX Official adalah aplikasi katalog dan dashboard admin untuk bisnis jersey custom. Aplikasi ini memakai Laravel, Blade, Tailwind, Alpine, Flowbite, dan Vite untuk mengelola produk, kategori, best seller, diskon, FAQ, testimoni, nomor WhatsApp, cart, serta halaman publik.

## Fitur Utama

- Landing page dengan desain CPX baru, hero visual, section about, katalog produk, dan CTA custom jersey.
- Katalog produk dengan filter `All`, `Best Seller`, `New`, dan `Custom Design`.
- Halaman detail produk dengan galeri, ukuran, kelebihan produk, harga diskon, cart, dan CTA WhatsApp.
- Cart sederhana berbasis session.
- Dashboard admin "CPX Command Center" dengan metrik operasional, health checklist, produk terbaru, distribusi kategori, diskon aktif, dan quick actions.
- CRUD admin untuk produk, kategori, testimoni, FAQ, best seller, diskon, dan nomor WhatsApp.
- Auth Laravel Breeze dengan login via email atau username.
- Seeder demo untuk user, kategori, produk, dan ukuran.

## Stack

- PHP `^8.2`
- Laravel `^12.0`
- Pest `^3.8`
- Laravel Pint
- Vite `^7.0`
- Tailwind CSS `^4.1`
- Alpine.js
- Flowbite

## Setup Lokal

1. Install dependency PHP dan Node:
   - `composer install`
   - `npm install`

2. Siapkan environment:
   - `cp .env.example .env`
   - `php artisan key:generate`

3. Siapkan SQLite lokal:
   - `touch database/database.sqlite`
   - Pastikan `.env` memakai `DB_CONNECTION=sqlite`.

4. Jalankan migrasi dan seed:
   - `php artisan migrate:fresh --seed`

5. Jalankan aplikasi:
   - Terminal 1: `php artisan serve`
   - Terminal 2: `npm run dev`

6. Buka aplikasi:
   - Public site: `http://localhost:8000`
   - Login admin: `http://localhost:8000/login`

## Akun Demo

Seeder membuat user admin demo:

- Username: `test`
- Email: `test@example.com`
- Password: `admin123`

## Command Penting

- `php artisan test` - menjalankan seluruh test Laravel/Pest.
- `npm run build` - build asset frontend production.
- `./vendor/bin/pint` - format PHP sesuai Laravel Pint.
- `composer run dev` - menjalankan server Laravel, queue listener, pail, dan Vite secara bersamaan.

## Struktur Penting

- `routes/web.php` - route public, auth, cart, dashboard, dan admin.
- `app/Http/Controllers/DashboardController.php` - agregasi data dashboard admin.
- `resources/views/components/header.blade.php` - header publik global.
- `resources/views/components/footer.blade.php` - footer publik global.
- `resources/views/layouts/app.blade.php` - layout area admin/authenticated.
- `resources/views/layouts/guest.blade.php` - layout login/register.
- `resources/views/dashboard/index.blade.php` - dashboard admin.
- `resources/views/home.blade.php` - landing page.
- `resources/views/our-products.blade.php` - katalog produk.
- `public/css/style.css` dan `resources/css/app.css` - design system CPX.

## Catatan Desain

Desain terbaru memakai arah visual CPX yang konsisten:

- Header dan footer publik gelap dengan rounded container.
- Background warm cream untuk halaman publik.
- Aksen merah CPX untuk CTA, badge, dan hover state.
- Card modern dengan radius besar dan shadow lembut.
- Auth split layout untuk login/register.
- Admin shell dan dashboard memakai gaya "Command Center".

## Testing

Sebelum merge, jalankan:

- `php artisan test`
- `npm run build`

Untuk perubahan UI, lakukan manual check minimal pada:

- `/`
- `/our-products`
- `/custom`
- `/login`
- `/dashboard`
