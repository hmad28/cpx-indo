import { readFile } from 'node:fs/promises';
import { fileURLToPath } from 'node:url';
import { runSchema } from './database.js';

const schemaPath = fileURLToPath(new URL('../database/neon-schema.sql', import.meta.url));
const schema = await readFile(schemaPath, 'utf8');

await runSchema(schema);
console.log('Neon database schema dan sample data berhasil disiapkan.');
