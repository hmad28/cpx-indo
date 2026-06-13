import { createReadStream, existsSync, statSync } from 'node:fs';
import { extname, join, normalize } from 'node:path';
import { fileURLToPath } from 'node:url';
import { createServer } from 'node:http';
import { getProducts, getSiteSettings, getTestimonials } from './database.js';

const root = fileURLToPath(new URL('..', import.meta.url));
const dist = join(root, 'dist');
const port = Number(process.env.PORT || 3000);
const mimeTypes = {
    '.css': 'text/css; charset=utf-8',
    '.html': 'text/html; charset=utf-8',
    '.ico': 'image/x-icon',
    '.jpeg': 'image/jpeg',
    '.jpg': 'image/jpeg',
    '.js': 'text/javascript; charset=utf-8',
    '.json': 'application/json; charset=utf-8',
    '.png': 'image/png',
    '.svg': 'image/svg+xml',
    '.webp': 'image/webp',
};

function json(response, status, payload) {
    response.writeHead(status, {
        'Content-Type': 'application/json; charset=utf-8',
        'Cache-Control': 'no-store',
    });
    response.end(JSON.stringify(payload));
}

async function api(request, response, pathname) {
    if (request.method !== 'GET') return json(response, 405, { error: 'Method not allowed' });

    if (pathname === '/api/health') {
        return json(response, 200, { status: 'ok', database: process.env.DATABASE_URL ? 'neon' : 'demo' });
    }

    if (pathname === '/api/storefront') {
        const [products, testimonials, settings] = await Promise.all([
            getProducts(),
            getTestimonials(),
            getSiteSettings(),
        ]);
        return json(response, 200, { products, testimonials, settings });
    }

    return json(response, 404, { error: 'Endpoint tidak ditemukan' });
}

function staticFile(response, pathname) {
    const requested = pathname === '/' ? 'index.html' : pathname.slice(1);
    const safePath = normalize(requested).replace(/^(\.\.(\/|\\|$))+/, '');
    let filePath = join(dist, safePath);

    if (!existsSync(filePath) || statSync(filePath).isDirectory()) {
        filePath = join(dist, 'index.html');
    }

    response.writeHead(200, {
        'Content-Type': mimeTypes[extname(filePath)] || 'application/octet-stream',
        'Cache-Control': filePath.endsWith('index.html') ? 'no-cache' : 'public, max-age=31536000, immutable',
    });
    createReadStream(filePath).pipe(response);
}

const server = createServer(async (request, response) => {
    try {
        const { pathname } = new URL(request.url, `http://${request.headers.host}`);
        if (pathname.startsWith('/api/')) return await api(request, response, pathname);
        if (!existsSync(dist)) return json(response, 503, { error: 'Build belum tersedia. Jalankan npm run build.' });
        staticFile(response, decodeURIComponent(pathname));
    } catch (error) {
        console.error(error);
        json(response, 500, { error: 'Terjadi kesalahan pada server.' });
    }
});

server.listen(port, () => {
    console.log(`CPX JavaScript server running at http://localhost:${port}`);
});
