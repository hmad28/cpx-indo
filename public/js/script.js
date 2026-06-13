document.addEventListener("DOMContentLoaded", () => {
    const header = document.querySelector("body > header");
    const progress = document.getElementById("scroll-progress");

    const updateScrollUi = () => {
        const scrollTop = window.scrollY;
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;

        header?.classList.toggle("navbar-fixed", scrollTop > 24);

        if (progress) {
            progress.style.width = `${scrollable > 0 ? (scrollTop / scrollable) * 100 : 0}%`;
        }
    };

    updateScrollUi();
    window.addEventListener("scroll", updateScrollUi, { passive: true });

    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    revealObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12 },
    );

    document.querySelectorAll("[data-reveal]").forEach((element) => revealObserver.observe(element));

    const processData = [
        {
            title: "Ceritakan kebutuhan timmu.",
            copy: "Diskusikan jenis olahraga, jumlah jersey, warna, referensi, dan target waktu melalui WhatsApp. Tim kami akan bantu memilih opsi terbaik tanpa biaya konsultasi.",
            icon: "fa-comments",
        },
        {
            title: "Visualkan identitas tim.",
            copy: "Desainer CPX menyusun konsep berdasarkan brief kamu. Warna, logo, nama, nomor, dan detail sponsor dirapikan sampai desain disetujui.",
            icon: "fa-pen-ruler",
        },
        {
            title: "Kami kerjakan dengan presisi.",
            copy: "Setelah desain final, jersey masuk proses cetak, potong, dan jahit dengan quality control pada warna, ukuran, serta kerapian detail.",
            icon: "fa-shirt",
        },
        {
            title: "Siap dipakai satu tim.",
            copy: "Pesanan dikemas aman dan dikirim ke alamat kamu. Tim CPX memberikan update supaya progres pesanan tetap mudah dipantau.",
            icon: "fa-truck-fast",
        },
    ];

    const process = document.querySelector("[data-process]");

    if (process) {
        const tabs = [...process.querySelectorAll("[data-process-tab]")];
        const panel = process.querySelector(".cpx-process-panel");
        const label = process.querySelector("[data-process-label]");
        const title = process.querySelector("[data-process-title]");
        const copy = process.querySelector("[data-process-copy]");
        const icon = process.querySelector("[data-process-icon]");

        const selectStep = (index) => {
            const item = processData[index];
            if (!item) return;

            tabs.forEach((tab, tabIndex) => {
                const active = tabIndex === index;
                tab.classList.toggle("is-active", active);
                tab.setAttribute("aria-selected", String(active));
            });

            label.textContent = `Step ${String(index + 1).padStart(2, "0")}`;
            title.textContent = item.title;
            copy.textContent = item.copy;
            icon.className = `fa-solid ${item.icon}`;
            panel.classList.remove("is-changing");
            window.requestAnimationFrame(() => panel.classList.add("is-changing"));
        };

        tabs.forEach((tab, index) => tab.addEventListener("click", () => selectStep(index)));
    }
});
