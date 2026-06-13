import './style.css';

const state = {
    products: [],
    testimonials: [],
    settings: { whatsapp: '6285172003667', production_days: '7–14', minimum_order: 12 },
    filter: 'Semua',
    cart: JSON.parse(localStorage.getItem('cpx-cart') || '[]'),
};

const money = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 });
const icons = {
    arrow: '<svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>',
    bag: '<svg viewBox="0 0 24 24"><path d="M6 8h12l1 12H5L6 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg>',
    menu: '<svg viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></svg>',
    close: '<svg viewBox="0 0 24 24"><path d="m6 6 12 12M18 6 6 18"/></svg>',
};

document.querySelector('#app').innerHTML = `
    <div class="progress"><span></span></div>
    <header class="nav">
        <a class="brand" href="#top"><img src="/images/logo cpx.jpeg" alt="CPX"><span><b>CPX</b><small>Official wear</small></span></a>
        <nav>
            <a href="#story">Tentang</a><a href="#process">Cara Order</a><a href="#catalog">Produk</a><a href="#reviews">Testimoni</a>
        </nav>
        <div class="nav-actions">
            <button class="icon-btn cart-button" aria-label="Buka keranjang">${icons.bag}<em data-cart-count>0</em></button>
            <a class="button button-small" href="#custom">Mulai Custom ${icons.arrow}</a>
            <button class="icon-btn menu-button" aria-label="Buka menu">${icons.menu}</button>
        </div>
    </header>

    <main id="top">
        <section class="hero">
            <div class="hero-image"></div><div class="hero-shade"></div>
            <div class="hero-grid" aria-hidden="true"></div>
            <div class="hero-content reveal">
                <p class="eyebrow"><span></span> Custom performance experience</p>
                <h1>Seragam tim.<br><i>Naik kelas.</i></h1>
                <p class="hero-copy">Jersey custom premium untuk tim yang ingin datang bukan cuma untuk bermain, tapi untuk meninggalkan kesan.</p>
                <div class="hero-actions">
                    <a class="button" href="#custom">Konsultasi desain ${icons.arrow}</a>
                    <a class="text-link" href="#catalog">Lihat koleksi <span>↓</span></a>
                </div>
            </div>
            <div class="hero-proof reveal">
                <div><b>500+</b><span>Tim Indonesia</span></div>
                <div><b data-production-days>7–14</b><span>Hari produksi</span></div>
                <div><b>4.9/5</b><span>Kepuasan klien</span></div>
            </div>
            <div class="hero-index">CPX / 001</div>
        </section>

        <section class="marquee" aria-label="Layanan CPX"><div>
            <span>Football</span><i>✦</i><span>Futsal</span><i>✦</i><span>Basketball</span><i>✦</i>
            <span>Running</span><i>✦</i><span>Esports</span><i>✦</i><span>Corporate</span><i>✦</i>
            <span>Football</span><i>✦</i><span>Futsal</span><i>✦</i><span>Basketball</span><i>✦</i>
        </div></section>

        <section class="story section" id="story">
            <div class="section-label reveal">01 — Tentang CPX</div>
            <div class="story-grid">
                <div class="story-title reveal"><h2>Bukan sekadar<br><i>jersey.</i></h2></div>
                <div class="story-copy reveal">
                    <p>Kami membangun identitas tim melalui desain yang kuat, material teruji, dan produksi yang bisa kamu pantau.</p>
                    <p class="muted">Dari klub lokal sampai komunitas nasional, setiap detail dikerjakan agar tim kamu tampil sebagai satu kesatuan.</p>
                    <a href="#process" class="line-link">Lihat cara kami bekerja ${icons.arrow}</a>
                </div>
            </div>
            <div class="story-visual reveal">
                <img src="/images/about3.jpg" alt="Proses produksi jersey CPX">
                <div class="story-card"><span>Built for the team</span><b>Designed<br>to perform.</b></div>
            </div>
        </section>

        <section class="process section" id="process">
            <div class="section-label reveal">02 — Proses Produksi</div>
            <div class="section-heading reveal"><h2>Empat langkah.<br><i>Satu identitas.</i></h2><p>Proses ringkas dan transparan, tanpa bikin kamu menebak-nebak progres.</p></div>
            <div class="process-list reveal">
                ${[
                    ['01', 'Brief', 'Ceritakan tim, warna, referensi, jumlah, dan target waktumu.'],
                    ['02', 'Design', 'Desainer kami menerjemahkan ide menjadi visual yang siap produksi.'],
                    ['03', 'Produce', 'Cetak, potong, dan jahit melewati quality control yang konsisten.'],
                    ['04', 'Deliver', 'Pesanan dikemas aman dan dikirim dengan update yang jelas.'],
                ].map(([number, title, copy]) => `<article class="process-item"><span>${number}</span><h3>${title}</h3><p>${copy}</p><b>+</b></article>`).join('')}
            </div>
        </section>

        <section class="catalog section" id="catalog">
            <div class="section-label reveal">03 — Selected Products</div>
            <div class="catalog-head reveal"><h2>Siap main.<br><i>Siap menang.</i></h2><div class="filters" data-filters></div></div>
            <div class="product-grid" data-products><div class="loading">Menyiapkan koleksi CPX...</div></div>
        </section>

        <section class="custom section" id="custom">
            <div class="custom-bg"></div>
            <div class="custom-content reveal">
                <p class="eyebrow"><span></span> Your team, your identity</p>
                <h2>Punya konsep?<br><i>Kita wujudkan.</i></h2>
                <p>Mulai dari konsultasi gratis. Tidak harus sudah punya desain—tim kreatif kami siap membantu dari nol.</p>
                <div class="custom-meta"><span>Minimum <b data-minimum-order>12 pcs</b></span><span>Produksi <b data-production-days>7–14 hari</b></span></div>
                <a class="button whatsapp-link" href="#" target="_blank">Mulai via WhatsApp ${icons.arrow}</a>
            </div>
        </section>

        <section class="reviews section" id="reviews">
            <div class="section-label reveal">04 — Mereka yang sudah pakai</div>
            <div class="reviews-grid" data-testimonials></div>
        </section>
    </main>

    <footer>
        <div class="footer-main"><div><a class="brand" href="#top"><img src="/images/logo cpx.jpeg" alt="CPX"><span><b>CPX</b><small>Official wear</small></span></a><p>Custom jersey studio dari Bogor<br>untuk tim di seluruh Indonesia.</p></div>
        <div class="footer-links"><div><b>Explore</b><a href="#story">Tentang</a><a href="#catalog">Produk</a><a href="#process">Cara order</a></div><div><b>Connect</b><a class="whatsapp-link" href="#">WhatsApp</a><a href="#">Instagram</a><a href="#">TikTok</a></div></div></div>
        <div class="footer-bottom"><span>© ${new Date().getFullYear()} CPX Official</span><span>Built for local champions.</span></div>
    </footer>

    <aside class="drawer" aria-hidden="true"><div class="drawer-head"><div><small>Your selection</small><h2>Keranjang</h2></div><button class="icon-btn close-cart">${icons.close}</button></div><div class="cart-items" data-cart-items></div><div class="cart-foot"><div><span>Total</span><b data-cart-total>Rp0</b></div><a class="button checkout-button" href="#">Checkout via WhatsApp ${icons.arrow}</a></div></aside>
    <div class="drawer-backdrop"></div>
    <div class="toast" role="status"></div>
`;

function imageUrl(image) {
    return `/images/${image || 'produk-1.jpg'}`;
}

function renderProducts() {
    const categories = ['Semua', ...new Set(state.products.map((product) => product.category).filter(Boolean))];
    document.querySelector('[data-filters]').innerHTML = categories.map((category) =>
        `<button class="${state.filter === category ? 'active' : ''}" data-filter="${category}">${category}</button>`
    ).join('');

    const products = state.filter === 'Semua' ? state.products : state.products.filter((product) => product.category === state.filter);
    document.querySelector('[data-products]').innerHTML = products.length ? products.map((product, index) => `
        <article class="product-card reveal visible" style="--delay:${index * 60}ms">
            <div class="product-image">
                <img src="${imageUrl(product.image)}" alt="${product.name}" loading="lazy">
                ${product.is_best_seller ? '<span class="badge">Best seller</span>' : ''}
                <button class="quick-add" data-add="${product.id}" aria-label="Tambah ke keranjang">+</button>
            </div>
            <div class="product-info"><div><small>${product.category || 'CPX Series'}</small><h3>${product.name}</h3></div><b>${money.format(product.price)}</b></div>
        </article>
    `).join('') : '<div class="empty">Belum ada produk pada kategori ini.</div>';
}

function renderTestimonials() {
    document.querySelector('[data-testimonials]').innerHTML = state.testimonials.map((item, index) => `
        <blockquote class="review reveal ${index === 0 ? 'review-featured' : ''}">
            <div class="stars">★★★★★</div><p>“${item.message}”</p><footer><b>${item.name}</b><span>${item.position || 'CPX Customer'}</span></footer>
        </blockquote>
    `).join('');
}

function persistCart() {
    localStorage.setItem('cpx-cart', JSON.stringify(state.cart));
    renderCart();
}

function renderCart() {
    const count = state.cart.reduce((total, item) => total + item.quantity, 0);
    const total = state.cart.reduce((sum, item) => sum + Number(item.price) * item.quantity, 0);
    document.querySelector('[data-cart-count]').textContent = count;
    document.querySelector('[data-cart-total]').textContent = money.format(total);
    document.querySelector('[data-cart-items]').innerHTML = state.cart.length ? state.cart.map((item) => `
        <article class="cart-item"><img src="${imageUrl(item.image)}" alt=""><div><small>${item.category}</small><h3>${item.name}</h3><b>${money.format(item.price)}</b><div class="quantity"><button data-qty="${item.id}" data-delta="-1">−</button><span>${item.quantity}</span><button data-qty="${item.id}" data-delta="1">+</button></div></div></article>
    `).join('') : '<div class="cart-empty"><span>00</span><p>Keranjangmu masih kosong.</p><a href="#catalog" class="close-cart">Pilih produk</a></div>';

    const message = encodeURIComponent(`Halo CPX, saya ingin order:\n${state.cart.map((item) => `- ${item.name} (${item.quantity}x)`).join('\n')}\nTotal: ${money.format(total)}`);
    document.querySelector('.checkout-button').href = `https://wa.me/${state.settings.whatsapp}?text=${message}`;
}

function showToast(message) {
    const toast = document.querySelector('.toast');
    toast.textContent = message;
    toast.classList.add('show');
    window.clearTimeout(showToast.timer);
    showToast.timer = window.setTimeout(() => toast.classList.remove('show'), 2200);
}

function toggleCart(open) {
    document.querySelector('.drawer').classList.toggle('open', open);
    document.querySelector('.drawer-backdrop').classList.toggle('open', open);
    document.querySelector('.drawer').setAttribute('aria-hidden', String(!open));
    document.body.classList.toggle('locked', open);
}

async function loadStorefront() {
    try {
        const response = await fetch('/api/storefront');
        if (!response.ok) throw new Error('Storefront API unavailable');
        const data = await response.json();
        Object.assign(state, data);
    } catch {
        const data = await import('./sample-data.js');
        Object.assign(state, data.default);
        document.querySelector('.loading')?.remove();
    }

    renderProducts();
    renderTestimonials();
    renderCart();
    document.querySelectorAll('[data-production-days]').forEach((element) => element.textContent = state.settings.production_days);
    document.querySelectorAll('[data-minimum-order]').forEach((element) => element.textContent = `${state.settings.minimum_order} pcs`);
    document.querySelectorAll('.whatsapp-link').forEach((link) => {
        link.href = `https://wa.me/${state.settings.whatsapp}?text=${encodeURIComponent('Halo CPX, saya mau konsultasi jersey custom.')}`;
        link.target = '_blank';
    });
    observeReveals();
}

function observeReveals() {
    const observer = new IntersectionObserver((entries) => entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    }), { threshold: 0.12 });
    document.querySelectorAll('.reveal:not(.visible)').forEach((element) => observer.observe(element));
}

document.addEventListener('click', (event) => {
    const filter = event.target.closest('[data-filter]');
    const add = event.target.closest('[data-add]');
    const quantity = event.target.closest('[data-qty]');

    if (filter) {
        state.filter = filter.dataset.filter;
        renderProducts();
    }
    if (add) {
        const product = state.products.find((item) => String(item.id) === add.dataset.add);
        const current = state.cart.find((item) => String(item.id) === String(product.id));
        if (current) current.quantity += 1;
        else state.cart.push({ ...product, quantity: 1 });
        persistCart();
        showToast(`${product.name} ditambahkan`);
    }
    if (quantity) {
        const item = state.cart.find((product) => String(product.id) === quantity.dataset.qty);
        item.quantity += Number(quantity.dataset.delta);
        state.cart = state.cart.filter((product) => product.quantity > 0);
        persistCart();
    }
    if (event.target.closest('.cart-button')) toggleCart(true);
    if (event.target.closest('.close-cart') || event.target.closest('.drawer-backdrop')) toggleCart(false);
    if (event.target.closest('.menu-button')) document.querySelector('.nav').classList.toggle('menu-open');
});

window.addEventListener('scroll', () => {
    const percentage = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight) * 100;
    document.querySelector('.progress span').style.width = `${percentage}%`;
    document.querySelector('.nav').classList.toggle('scrolled', window.scrollY > 30);
}, { passive: true });

observeReveals();
loadStorefront();
