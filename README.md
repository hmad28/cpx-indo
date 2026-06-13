# CPX Official — JavaScript + Neon

Storefront CPX adalah aplikasi JavaScript penuh untuk bisnis produksi jersey custom sekaligus penjualan produk sportswear.

## Stack

- Vite SPA (HTML, CSS, dan JavaScript tanpa framework)
- Node.js HTTP API
- Neon PostgreSQL melalui `@neondatabase/serverless`
- LocalStorage untuk cart pelanggan
- WhatsApp checkout

Laravel lama masih tersimpan untuk referensi migrasi data/admin, tetapi storefront utama tidak lagi membutuhkan PHP atau Blade.

## Menjalankan Lokal

Persyaratan: Node.js 20.19 atau lebih baru.

```bash
npm install
cp .env.example .env
npm run build
npm start
```

Buka `http://localhost:3000`.

Untuk frontend development dengan hot reload:

```bash
# Terminal 1 — API
npm run dev

# Terminal 2 — Vite
npm run dev:web
```

Vite berjalan pada `http://localhost:5173` dan meneruskan request `/api` ke port `3000`.

## Menyiapkan Neon

1. Buat project PostgreSQL di [Neon](https://neon.tech).
2. Salin pooled connection string dari menu **Connect**.
3. Isi `DATABASE_URL` di `.env`.
4. Jalankan schema dan sample data:

```bash
npm run db:setup
```

Schema berada di `database/neon-schema.sql`. Bila `DATABASE_URL` belum tersedia atau Neon sedang tidak dapat diakses, API otomatis memakai data demo agar storefront tetap dapat dijalankan.

## Commands

| Command | Kegunaan |
| --- | --- |
| `npm run dev` | Menjalankan API Node dengan watch mode |
| `npm run dev:web` | Menjalankan Vite development server |
| `npm run build` | Membuat production build ke `dist/` |
| `npm start` | Menyajikan API dan production build |
| `npm run db:setup` | Membuat tabel dan sample data di Neon |
| `npm run check` | Memeriksa sintaks JavaScript dan production build |

## API

- `GET /api/health` — status server dan mode database.
- `GET /api/storefront` — produk, testimoni, dan pengaturan storefront.

## Deployment

Build command:

```bash
npm install && npm run build
```

Start command:

```bash
npm start
```

Environment production wajib:

```env
DATABASE_URL=postgresql://...
PORT=3000
```
