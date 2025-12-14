// ===================================================================
// 1. TOGGLE MENU MOBILE
// ===================================================================
const menuToggle = document.getElementById('menu-toggle');
const navLinks = document.querySelector('.nav-links');

if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });

    // Tutup otomatis bila klik link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            if (navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
            }
        });
    });
}

// ===================================================================
// 2. POP UP PROMO
// ===================================================================
const promoBtn = document.getElementById("promoBtn");
const promoModal = document.getElementById("promoModal");
const closePromo = document.getElementById("closePromo");

if (promoBtn && promoModal && closePromo) {
    promoBtn.addEventListener("click", () => {
        promoModal.style.display = "flex";
    });

    closePromo.addEventListener("click", () => {
        promoModal.style.display = "none";
    });
}

// ===================================================================
// 3. POPUP GAMBAR GALERI + NAVIGASI
// ===================================================================
const popup = document.getElementById("imgPopup");
const popupImg = document.getElementById("popupImg");
const closeImg = document.querySelector(".close-popup");
const galleryImages = document.querySelectorAll("#galeri .menu-item img");
const nextBtn = document.querySelector(".next-img");
const prevBtn = document.querySelector(".prev-img");

let currentIndex = 0;

if (popup && popupImg && closeImg && galleryImages.length > 0) {
    // Klik gambar untuk membuka popup
    galleryImages.forEach((img, index) => {
        img.addEventListener("click", () => {
            popup.style.display = "flex";
            popupImg.src = img.src;
            currentIndex = index;
        });
    });

    // Tombol next
    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % galleryImages.length;
            popupImg.src = galleryImages[currentIndex].src;
        });
    }

    // Tombol prev
    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
            popupImg.src = galleryImages[currentIndex].src;
        });
    }

    // Tutup popup
    closeImg.addEventListener("click", () => {
        popup.style.display = "none";
    });
}

// ===================================================================
// 4. POPUP DETAIL MENU & INPUT FORMULIR (DIPERBAIKI)
// ===================================================================
const menuPopup = document.getElementById("menuPopup");
const popupMenuImg = document.getElementById("popupMenuImg");
const popupMenuTitle = document.getElementById("popupMenuTitle");
const popupMenuPrice = document.getElementById("popupMenuPrice");
const popupMenuDesc = document.getElementById("popupMenuDesc");

// Input Hidden untuk Database
const inputMenuName = document.getElementById("inputMenuName");
const inputMenuPrice = document.getElementById("inputMenuPrice");

// Klik menu untuk buka popup detail
document.querySelectorAll("#menu .menu-item").forEach(item => {
    item.addEventListener("click", () => {

        // 1. AMBIL DATA DARI ATRIBUT KARTU MENU
        // (Pastikan file menu.php Anda punya atribut data-title, data-price, data-desc)
        const img = item.getAttribute("data-image");
        const title = item.getAttribute("data-title");
        const priceStr = item.getAttribute("data-price"); // Contoh: "Rp 15.000"
        const desc = item.getAttribute("data-desc");

        // 2. TAMPILKAN DI POPUP (VISUAL)
        if(popupMenuImg) popupMenuImg.src = img;
        if(popupMenuTitle) popupMenuTitle.textContent = title;
        if(popupMenuPrice) popupMenuPrice.textContent = priceStr;
        if(popupMenuDesc) popupMenuDesc.textContent = desc;

        // 3. MASUKKAN KE KOTAK RAHASIA (DATABASE) - INI KUNCINYA
        if (inputMenuName) {
            inputMenuName.value = title; // Isi Nama Menu
        }

        if (inputMenuPrice) {
            // Ubah "Rp 15.000" menjadi "15000" (Angka saja)
            let priceClean = priceStr.replace(/[^0-9]/g, '');
            inputMenuPrice.value = priceClean; // Isi Harga
        }

        // Tampilkan Popup
        if(menuPopup) menuPopup.style.display = "flex";
    });
});

// Tutup popup
const closeMenuBtn = document.querySelector(".close-menu-popup");
if (closeMenuBtn && menuPopup) {
    closeMenuBtn.addEventListener("click", () => {
        menuPopup.style.display = "none";
    });
}