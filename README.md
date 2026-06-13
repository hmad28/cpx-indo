# CPX Official — Next.js + Neon

CPX Official sekarang menggunakan arsitektur full-stack JavaScript serverless:

- **Next.js App Router** untuk storefront, Server Components, dan routing.
- **React Client Component** untuk filter produk, cart, animasi, dan WhatsApp checkout.
- **Next.js Route Handlers** untuk API serverless.
- **Neon PostgreSQL** melalui HTTP serverless driver.
- **Vercel-ready** tanpa custom Express/Node server.

Laravel lama masih tersedia sebagai arsip referensi migrasi data. Runtime utama aplikasi berada di `app/`, `components/`, dan `lib/`.

## Menjalankan Lokal

Gunakan Node.js 20.19 atau lebih baru:

```bash
npm install
cp .env.example .env.local
npm run db:setup
npm run dev
```

Buka `http://localhost:3000`.

Jika `DATABASE_URL` belum diisi, storefront tetap berjalan dengan demo data lokal. API akan mengembalikan `source: "demo"`.

## Neon Database

1. Buat project di [Neon](https://neon.tech).
2. Buka **Connect** dan salin pooled connection string.
3. Simpan sebagai `DATABASE_URL` di `.env.local`.
4. Jalankan:

```bash
npm run db:setup
```

Schema idempotent berada di `database/neon-schema.sql` dan menyediakan:

- `categories`
- `products`
- `testimonials`
- `site_settings`

Koneksi database hanya digunakan pada server melalui `lib/db.js`. Connection string tidak pernah dikirim ke browser.

## Struktur Next.js

| Path | Fungsi |
| --- | --- |
| `app/layout.js` | Metadata, font, dan root layout |
| `app/page.js` | Server Component storefront |
| `components/storefront.js` | UI interaktif dan cart |
| `app/api/storefront/route.js` | API serverless data storefront |
| `app/api/health/route.js` | Health check deployment |
| `lib/db.js` | Query Neon server-side |
| `database/neon-schema.sql` | Schema dan initial data |
| `scripts/setup-database.mjs` | Menjalankan schema ke Neon |

## Commands

```bash
npm run dev       # Next.js development server
npm run build     # Production build
npm start         # Menjalankan production build
npm run lint      # ESLint
npm run db:setup  # Setup Neon schema
```

## API

### `GET /api/storefront`

Mengembalikan:

- `products`
- `testimonials`
- `settings`
- `source`: `neon`, `demo`, atau `fallback`

### `GET /api/health`

Mengembalikan runtime Next.js serverless dan status konfigurasi database.

## Deploy ke Vercel

1. Import repository ke Vercel.
2. Framework Preset akan terdeteksi sebagai **Next.js**.
3. Tambahkan environment variable:

```env
DATABASE_URL=postgresql://...
```

4. Deploy. Tidak perlu mengatur custom start command atau server process.

`next.config.mjs` mengaktifkan standalone output agar aplikasi juga dapat dijalankan pada platform Node/serverless lain.
