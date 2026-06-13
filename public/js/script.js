console.log("Script.js is connected!");

// navbar-fixed
window.onscroll = function () {
    const header = document.querySelector("header");
    const fixedNav = header.offsetTop;

    if (window.pageYOffset > fixedNav) {
        header.classList.add("navbar-fixed");
    } else {
        header.classList.remove("navbar-fixed");
    }
};

// hamburger start
const hamburger = document.querySelector("#hamburger");
const navMenu = document.querySelector("#nav-menu");

hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("hamburger-active");
    navMenu.classList.toggle("hidden");
});
// hamburger end

// kategori start
const btn = document.getElementById("dropdownButton");
const menu = document.getElementById("dropdownMenu");
const iconRight = document.getElementById("iconRight");
const iconDown = document.getElementById("iconDown");

btn.addEventListener("click", function () {
    menu.classList.toggle("hidden");
    iconRight.classList.toggle("hidden");
    iconDown.classList.toggle("hidden");
});

document.addEventListener("click", function (e) {
    const wrapper = document.getElementById("dropdownWrapper");

    if (!wrapper.contains(e.target)) {
        menu.classList.add("hidden");
        iconRight.classList.remove("hidden");
        iconDown.classList.add("hidden");
    }
});
// kategori end

// slider text start
const categories = [
    "Apple",
    "Samsung",
    "Oppo",
    "Xiaomi",
    "Huawei",
    "Motorola",
    "Realme",
    "Vivo",
    "Apple",
    "Samsung",
    "Oppo",
    "Xiaomi",
    "Huawei",
    "Motorola",
    "Realme",
    "Vivo",
    "Apple",
    "Samsung",
    "Oppo",
    "Xiaomi",
    "Huawei",
    "Motorola",
    "Realme",
    "Vivo",
];

let startIndex = 0;
const visibleCount = 20;

const carousel = document.getElementById("carousel");
const nextBtn = document.getElementById("nextBtn");

function renderCarousel() {
    carousel.innerHTML = "";
    const endIndex = startIndex + visibleCount;
    const visibleItems = categories.slice(startIndex, endIndex);

    visibleItems.forEach((cat) => {
        const link = document.createElement("a");
        link.href = "#";
        link.className =
            "px-3 py-1 bg-amber-100 text-yellow-800/70 rounded-md hover:bg-amber-100/90";
        link.textContent = cat;
        carousel.appendChild(link);
    });
}

nextBtn.addEventListener("click", () => {
    startIndex = (startIndex + 1) % categories.length;

    if (startIndex + visibleCount > categories.length) {
        startIndex = 0;
    }

    renderCarousel();
});

renderCarousel();
// slider text end



 