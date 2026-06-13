import { readFile } from 'node:fs/promises';
import { neon } from '@neondatabase/serverless';

if (!process.env.DATABASE_URL) {
    throw new Error('DATABASE_URL wajib diisi di .env.local.');
}

const schema = await readFile(new URL('../database/neon-schema.sql', import.meta.url), 'utf8');
const sql = neon(process.env.DATABASE_URL);

await sql.query(schema);
console.log('Neon schema dan sample data berhasil disiapkan.');
