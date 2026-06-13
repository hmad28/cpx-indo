'use client';

import Image from 'next/image';
import { useEffect, useMemo, useState } from 'react';

const money = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
});

const Arrow = () => <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6" /></svg>;
const Bag = () => <svg viewBox="0 0 24 24"><path d="M6 8h12l1 12H5L6 8Z" /><path d="M9 9V6a3 3 0 0 1 6 0v3" /></svg>;
const Close = () => <svg viewBox="0 0 24 24"><path d="m6 6 12 12M18 6 6 18" /></svg>;

export default function Storefront({ initialData }) {
    const [filter, setFilter] = useState('Semua');
    const [cart, setCart] = useState([]);
    const [cartOpen, setCartOpen] = useState(false);
    const [menuOpen, setMenuOpen] = useState(false);
    const [scrolled, setScrolled] = useState(false);
    const [progress, setProgress] = useState(0);
    const [toast, setToast] = useState('');
    const { products, testimonials, settings, source } = initialData;

    useEffect(() => {
        const saved = window.localStorage.getItem('cpx-cart');
        if (saved) setCart(JSON.parse(saved));

        const updateScroll = () => {
            const scrollable = document.documentElement.scrollHeight - window.innerHeight;
            setProgress(scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0);
            setScrolled(window.scrollY > 30);
        };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach((element) => observer.observe(element));
        window.addEventListener('scroll', updateScroll, { passive: true });
        updateScroll();

        return () => {
            observer.disconnect();
            window.removeEventListener('scroll', updateScroll);
        };
    }, []);

    useEffect(() => {
        window.localStorage.setItem('cpx-cart', JSON.stringify(cart));
    }, [cart]);

    useEffect(() => {
        document.body.classList.toggle('locked', cartOpen);
        return () => document.body.classList.remove('locked');
    }, [cartOpen]);

    const categories = useMemo(
        () => ['Semua', ...new Set(products.map((product) => product.category).filter(Boolean))],
        [products],
    );
    const visibleProducts = filter === 'Semua'
        ? products
        : products.filter((product) => product.category === filter);
    const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
    const cartTotal = cart.reduce((total, item) => total + Number(item.price) * item.quantity, 0);

    function addProduct(product) {
        setCart((current) => {
            const existing = current.find((item) => String(item.id) === String(product.id));
            return existing
                ? current.map((item) => String(item.id) === String(product.id) ? { ...item, quantity: item.quantity + 1 } : item)
                : [...current, { ...product, quantity: 1 }];
        });
        setToast(`${product.name} ditambahkan`);
        window.setTimeout(() => setToast(''), 2200);
    }

    function changeQuantity(id, delta) {
        setCart((current) => current
            .map((item) => String(item.id) === String(id) ? { ...item, quantity: item.quantity + delta } : item)
            .filter((item) => item.quantity > 0));
    }

    const consultMessage = encodeURIComponent('Halo CPX, saya mau konsultasi jersey custom.');
    const checkoutMessage = encodeURIComponent(
        `Halo CPX, saya ingin order:\n${cart.map((item) => `- ${item.name} (${item.quantity}x)`).join('\n')}\nTotal: ${money.format(cartTotal)}`,
    );

    return (
        <>
            <div className="progress"><span style={{ width: `${progress}%` }} /></div>
            <header className={`nav ${scrolled ? 'scrolled' : ''} ${menuOpen ? 'menu-open' : ''}`}>
                <a className="brand" href="#top">
                    <Image src="/images/logo cpx.jpeg" alt="CPX" width={42} height={42} priority />
                    <span><b>CPX</b><small>Official wear</small></span>
                </a>
                <nav>
                    <a href="#story">Tentang</a><a href="#process">Cara Order</a>
                    <a href="#catalog">Produk</a><a href="#reviews">Testimoni</a>
                </nav>
                <div className="nav-actions">
                    <button className="icon-btn cart-button" onClick={() => setCartOpen(true)} aria-label="Buka keranjang">
                        <Bag /><em>{cartCount}</em>
                    </button>
                    <a className="button button-small" href="#custom">Mulai Custom <Arrow /></a>
                    <button className="icon-btn menu-button" onClick={() => setMenuOpen((open) => !open)} aria-label="Buka menu">
                        <span /><span /><span />
                    </button>
                </div>
            </header>

            <main id="top">
                <section className="hero">
                    <div className="hero-image" /><div className="hero-shade" /><div className="hero-grid" />
                    <div className="hero-content reveal">
                        <p className="eyebrow"><span /> Custom performance experience</p>
                        <h1>Seragam tim.<br /><i>Naik kelas.</i></h1>
                        <p className="hero-copy">Jersey custom premium untuk tim yang ingin datang bukan cuma untuk bermain, tapi untuk meninggalkan kesan.</p>
                        <div className="hero-actions">
                            <a className="button" href="#custom">Konsultasi desain <Arrow /></a>
                            <a className="text-link" href="#catalog">Lihat koleksi <span>↓</span></a>
                        </div>
                    </div>
                    <div className="hero-proof reveal">
                        <div><b>500+</b><span>Tim Indonesia</span></div>
                        <div><b>{settings.production_days}</b><span>Hari produksi</span></div>
                        <div><b>4.9/5</b><span>Kepuasan klien</span></div>
                    </div>
                    <div className="hero-index">CPX / 001</div>
                </section>

                <section className="marquee"><div>
                    {['Football', 'Futsal', 'Basketball', 'Running', 'Esports', 'Corporate', 'Football', 'Futsal', 'Basketball'].map((item, index) => (
                        <span key={`${item}-${index}`}>{item}<i>✦</i></span>
                    ))}
                </div></section>

                <section className="story section" id="story">
                    <div className="section-label reveal">01 — Tentang CPX</div>
                    <div className="story-grid">
                        <div className="reveal"><h2>Bukan sekadar<br /><i>jersey.</i></h2></div>
                        <div className="story-copy reveal">
                            <p>Kami membangun identitas tim melalui desain yang kuat, material teruji, dan produksi yang bisa kamu pantau.</p>
                            <p className="muted">Dari klub lokal sampai komunitas nasional, setiap detail dikerjakan agar tim kamu tampil sebagai satu kesatuan.</p>
                            <a href="#process" className="line-link">Lihat cara kami bekerja <Arrow /></a>
                        </div>
                    </div>
                    <div className="story-visual reveal">
                        <Image src="/images/about3.jpg" alt="Proses produksi jersey CPX" fill sizes="100vw" />
                        <div className="story-card"><span>Built for the team</span><b>Designed<br />to perform.</b></div>
                    </div>
                </section>

                <section className="process section" id="process">
                    <div className="section-label reveal">02 — Proses Produksi</div>
                    <div className="section-heading reveal"><h2>Empat langkah.<br /><i>Satu identitas.</i></h2><p>Proses ringkas dan transparan, tanpa bikin kamu menebak-nebak progres.</p></div>
                    <div className="process-list reveal">
                        {[
                            ['01', 'Brief', 'Ceritakan tim, warna, referensi, jumlah, dan target waktumu.'],
                            ['02', 'Design', 'Desainer kami menerjemahkan ide menjadi visual yang siap produksi.'],
                            ['03', 'Produce', 'Cetak, potong, dan jahit melewati quality control yang konsisten.'],
                            ['04', 'Deliver', 'Pesanan dikemas aman dan dikirim dengan update yang jelas.'],
                        ].map(([number, title, copy]) => <article className="process-item" key={number}><span>{number}</span><h3>{title}</h3><p>{copy}</p><b>+</b></article>)}
                    </div>
                </section>

                <section className="catalog section" id="catalog">
                    <div className="section-label reveal">03 — Selected Products <small>Data: {source}</small></div>
                    <div className="catalog-head reveal">
                        <h2>Siap main.<br /><i>Siap menang.</i></h2>
                        <div className="filters">{categories.map((category) => <button className={filter === category ? 'active' : ''} onClick={() => setFilter(category)} key={category}>{category}</button>)}</div>
                    </div>
                    <div className="product-grid">
                        {visibleProducts.map((product) => (
                            <article className="product-card reveal visible" key={product.id}>
                                <div className="product-image">
                                    <Image src={`/images/${product.image || 'produk-1.jpg'}`} alt={product.name} fill sizes="(max-width: 600px) 100vw, 33vw" />
                                    {product.is_best_seller && <span className="badge">Best seller</span>}
                                    <button className="quick-add" onClick={() => addProduct(product)} aria-label={`Tambah ${product.name}`}>+</button>
                                </div>
                                <div className="product-info"><div><small>{product.category || 'CPX Series'}</small><h3>{product.name}</h3></div><b>{money.format(product.price)}</b></div>
                            </article>
                        ))}
                    </div>
                </section>

                <section className="custom section" id="custom">
                    <div className="custom-bg" />
                    <div className="custom-content reveal">
                        <p className="eyebrow"><span /> Your team, your identity</p>
                        <h2>Punya konsep?<br /><i>Kita wujudkan.</i></h2>
                        <p>Mulai dari konsultasi gratis. Tidak harus sudah punya desain—tim kreatif kami siap membantu dari nol.</p>
                        <div className="custom-meta"><span>Minimum <b>{settings.minimum_order} pcs</b></span><span>Produksi <b>{settings.production_days} hari</b></span></div>
                        <a className="button" href={`https://wa.me/${settings.whatsapp}?text=${consultMessage}`} target="_blank" rel="noreferrer">Mulai via WhatsApp <Arrow /></a>
                    </div>
                </section>

                <section className="reviews section" id="reviews">
                    <div className="section-label reveal">04 — Mereka yang sudah pakai</div>
                    <div className="reviews-grid">
                        {testimonials.map((item, index) => <blockquote className={`review reveal ${index === 0 ? 'review-featured' : ''}`} key={item.id}><div className="stars">★★★★★</div><p>“{item.message}”</p><footer><b>{item.name}</b><span>{item.position || 'CPX Customer'}</span></footer></blockquote>)}
                    </div>
                </section>
            </main>

            <footer className="site-footer">
                <div className="footer-main"><div><a className="brand" href="#top"><Image src="/images/logo cpx.jpeg" alt="CPX" width={42} height={42} /><span><b>CPX</b><small>Official wear</small></span></a><p>Custom jersey studio dari Bogor<br />untuk tim di seluruh Indonesia.</p></div>
                    <div className="footer-links"><div><b>Explore</b><a href="#story">Tentang</a><a href="#catalog">Produk</a><a href="#process">Cara order</a></div><div><b>Connect</b><a href={`https://wa.me/${settings.whatsapp}`}>WhatsApp</a><a href="#">Instagram</a><a href="#">TikTok</a></div></div></div>
                <div className="footer-bottom"><span>© {new Date().getFullYear()} CPX Official</span><span>Built for local champions.</span></div>
            </footer>

            <aside className={`drawer ${cartOpen ? 'open' : ''}`} aria-hidden={!cartOpen}>
                <div className="drawer-head"><div><small>Your selection</small><h2>Keranjang</h2></div><button className="icon-btn" onClick={() => setCartOpen(false)}><Close /></button></div>
                <div className="cart-items">
                    {cart.length ? cart.map((item) => <article className="cart-item" key={item.id}><Image src={`/images/${item.image}`} alt={item.name} width={100} height={125} /><div><small>{item.category}</small><h3>{item.name}</h3><b>{money.format(item.price)}</b><div className="quantity"><button onClick={() => changeQuantity(item.id, -1)}>−</button><span>{item.quantity}</span><button onClick={() => changeQuantity(item.id, 1)}>+</button></div></div></article>) : <div className="cart-empty"><span>00</span><p>Keranjangmu masih kosong.</p><button onClick={() => setCartOpen(false)}>Pilih produk</button></div>}
                </div>
                <div className="cart-foot"><div><span>Total</span><b>{money.format(cartTotal)}</b></div><a className="button" href={`https://wa.me/${settings.whatsapp}?text=${checkoutMessage}`} target="_blank" rel="noreferrer">Checkout via WhatsApp <Arrow /></a></div>
            </aside>
            <button className={`drawer-backdrop ${cartOpen ? 'open' : ''}`} onClick={() => setCartOpen(false)} aria-label="Tutup keranjang" />
            <div className={`toast ${toast ? 'show' : ''}`} role="status">{toast}</div>
        </>
    );
}
