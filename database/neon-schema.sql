CREATE TABLE IF NOT EXISTS categories (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    slug VARCHAR(140) UNIQUE NOT NULL,
    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS products (
    id BIGSERIAL PRIMARY KEY,
    category_id BIGINT REFERENCES categories(id) ON DELETE SET NULL,
    name VARCHAR(180) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    description TEXT NOT NULL DEFAULT '',
    price INTEGER NOT NULL CHECK (price >= 0),
    image VARCHAR(255),
    is_best_seller BOOLEAN NOT NULL DEFAULT FALSE,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS testimonials (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    position VARCHAR(160),
    message TEXT NOT NULL,
    is_published BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS site_settings (
    key VARCHAR(80) PRIMARY KEY,
    value TEXT NOT NULL
);

INSERT INTO categories (name, slug) VALUES
    ('Football', 'football'), ('Futsal', 'futsal'), ('Basketball', 'basketball'),
    ('Esports', 'esports'), ('Custom', 'custom')
ON CONFLICT (slug) DO NOTHING;

INSERT INTO products (category_id, name, slug, description, price, image, is_best_seller)
SELECT c.id, seed.name, seed.slug, seed.description, seed.price, seed.image, seed.is_best_seller
FROM (VALUES
    ('football', 'Volta Home Jersey', 'jersey-volta-home', 'Jersey performa dengan material dry-fit ringan dan detail sublimasi tajam.', 189000, '1758646646_main.jpg', TRUE),
    ('football', 'Aero Away Jersey', 'jersey-aero-away', 'Potongan atletik, breathable, dan nyaman untuk pertandingan intens.', 199000, '1758646649_main.jpg', TRUE),
    ('futsal', 'CPX Rush', 'jersey-cpx-rush', 'Jersey futsal fleksibel untuk pergerakan cepat di lapangan.', 175000, '1758646667_main.jpg', FALSE),
    ('basketball', 'Court Pro', 'jersey-court-pro', 'Basketball jersey loose fit dengan sirkulasi udara maksimal.', 215000, '1758646669_main.jpg', TRUE),
    ('esports', 'Velocity Esports', 'jersey-esport-velocity', 'Visual modern dan material lembut untuk sesi kompetisi panjang.', 185000, '1758646706_main.jpg', FALSE),
    ('custom', 'Custom Team Series', 'jersey-custom-team', 'Paket jersey custom lengkap dengan konsultasi desain gratis.', 165000, '1758646948_main.jpg', TRUE)
) AS seed(category_slug, name, slug, description, price, image, is_best_seller)
JOIN categories c ON c.slug = seed.category_slug
ON CONFLICT (slug) DO NOTHING;

INSERT INTO testimonials (name, position, message) VALUES
    ('Raka Pratama', 'Manager Garuda FC', 'Desainnya berani, warna cetaknya solid, dan ukuran satu tim aman semua.'),
    ('Dinda Maharani', 'Captain Vortex Esports', 'Brief kami diterjemahkan dengan detail. Proses revisinya juga cepat dan jelas.'),
    ('Alvin Wijaya', 'Komunitas Run Bogor', 'Dari konsultasi sampai barang datang selalu diberi update. Recommended.');

INSERT INTO site_settings (key, value) VALUES
    ('whatsapp', '6285172003667'), ('production_days', '7–14'), ('minimum_order', '12')
ON CONFLICT (key) DO NOTHING;
