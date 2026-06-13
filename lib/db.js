import 'server-only';
import { neon } from '@neondatabase/serverless';
import { sampleProducts, sampleSettings, sampleTestimonials } from './sample-data';

function database() {
    return process.env.DATABASE_URL ? neon(process.env.DATABASE_URL) : null;
}

export async function getStorefrontData() {
    const sql = database();

    if (!sql) {
        return {
            products: sampleProducts,
            testimonials: sampleTestimonials,
            settings: sampleSettings,
            source: 'demo',
        };
    }

    try {
        const [products, testimonials, settingsRows] = await Promise.all([
            sql`
                SELECT p.id, p.slug, p.name, p.price, p.image, p.description,
                       p.is_best_seller, c.name AS category
                FROM products p
                LEFT JOIN categories c ON c.id = p.category_id
                WHERE p.is_active = true
                ORDER BY p.is_best_seller DESC, p.created_at DESC
            `,
            sql`
                SELECT id, name, position, message
                FROM testimonials
                WHERE is_published = true
                ORDER BY created_at DESC
            `,
            sql`SELECT key, value FROM site_settings`,
        ]);

        return {
            products,
            testimonials,
            settings: settingsRows.reduce(
                (result, row) => ({ ...result, [row.key]: row.value }),
                sampleSettings,
            ),
            source: 'neon',
        };
    } catch (error) {
        console.error('Neon storefront query failed:', error);
        return {
            products: sampleProducts,
            testimonials: sampleTestimonials,
            settings: sampleSettings,
            source: 'fallback',
        };
    }
}
