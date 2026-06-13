const fallbackProducts = [
    { id: 1, slug: 'jersey-volta-home', name: 'Volta Home Jersey', category: 'Football', price: 189000, image: '1758646646_main.jpg', is_best_seller: true, description: 'Jersey performa dengan material dry-fit ringan dan detail sublimasi tajam.' },
    { id: 2, slug: 'jersey-aero-away', name: 'Aero Away Jersey', category: 'Football', price: 199000, image: '1758646649_main.jpg', is_best_seller: true, description: 'Potongan atletik, breathable, dan nyaman untuk pertandingan intens.' },
    { id: 3, slug: 'jersey-cpx-rush', name: 'CPX Rush', category: 'Futsal', price: 175000, image: '1758646667_main.jpg', is_best_seller: false, description: 'Jersey futsal fleksibel untuk pergerakan cepat di lapangan.' },
    { id: 4, slug: 'jersey-court-pro', name: 'Court Pro', category: 'Basketball', price: 215000, image: '1758646669_main.jpg', is_best_seller: true, description: 'Basketball jersey loose fit dengan sirkulasi udara maksimal.' },
    { id: 5, slug: 'jersey-esport-velocity', name: 'Velocity Esports', category: 'Esports', price: 185000, image: '1758646706_main.jpg', is_best_seller: false, description: 'Visual modern dan material lembut untuk sesi kompetisi panjang.' },
    { id: 6, slug: 'jersey-custom-team', name: 'Custom Team Series', category: 'Custom', price: 165000, image: '1758646948_main.jpg', is_best_seller: true, description: 'Paket jersey custom lengkap dengan konsultasi desain gratis.' },
];

const fallbackTestimonials = [
    { id: 1, name: 'Raka Pratama', position: 'Manager Garuda FC', message: 'Desainnya berani, warna cetaknya solid, dan ukuran satu tim aman semua.' },
    { id: 2, name: 'Dinda Maharani', position: 'Captain Vortex Esports', message: 'Brief kami diterjemahkan dengan detail. Proses revisinya juga cepat dan jelas.' },
    { id: 3, name: 'Alvin Wijaya', position: 'Komunitas Run Bogor', message: 'Dari konsultasi sampai barang datang selalu diberi update. Recommended.' },
];

let sqlClient;

async function getSql() {
    if (!process.env.DATABASE_URL) return null;
    if (sqlClient) return sqlClient;

    try {
        const { neon } = await import('@neondatabase/serverless');
        sqlClient = neon(process.env.DATABASE_URL);
        return sqlClient;
    } catch (error) {
        console.error('[database] Neon driver tidak tersedia:', error.message);
        return null;
    }
}

export async function getProducts() {
    const sql = await getSql();
    if (!sql) return fallbackProducts;

    try {
        return await sql`
            SELECT p.id, p.slug, p.name, p.price, p.image, p.description,
                   p.is_best_seller, c.name AS category
            FROM products p
            LEFT JOIN categories c ON c.id = p.category_id
            WHERE p.is_active = true
            ORDER BY p.is_best_seller DESC, p.created_at DESC
        `;
    } catch (error) {
        console.error('[database] Gagal mengambil produk, memakai data demo:', error.message);
        return fallbackProducts;
    }
}

export async function getTestimonials() {
    const sql = await getSql();
    if (!sql) return fallbackTestimonials;

    try {
        return await sql`
            SELECT id, name, position, message
            FROM testimonials
            WHERE is_published = true
            ORDER BY created_at DESC
        `;
    } catch (error) {
        console.error('[database] Gagal mengambil testimoni, memakai data demo:', error.message);
        return fallbackTestimonials;
    }
}

export async function getSiteSettings() {
    const sql = await getSql();
    const fallback = { whatsapp: '6285172003667', production_days: '7–14', minimum_order: 12 };
    if (!sql) return fallback;

    try {
        const rows = await sql`SELECT key, value FROM site_settings`;
        return rows.reduce((settings, row) => ({ ...settings, [row.key]: row.value }), fallback);
    } catch {
        return fallback;
    }
}

export async function runSchema(schema) {
    const sql = await getSql();
    if (!sql) throw new Error('DATABASE_URL Neon belum diatur.');
    await sql.query(schema);
}
