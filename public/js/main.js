/**
 * Main JavaScript for Genpedia
 * Handles Sliding Nav, Dynamic Hero Preview, and Live Search.
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. Sliding Navigation Marker Logic ---
    const marker = document.querySelector('.nav-marker');
    const navLinks = document.querySelectorAll('.nav-links a');
    const activeLink = document.querySelector('.nav-links a.active');
    
    // Fungsi untuk memindahkan garis bawah
    function moveIndicator(element) {
        if (element && marker) {
            const parentRect = element.closest('.nav-links').getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();
            marker.style.width = elementRect.width + 'px';
            marker.style.left = (elementRect.left - parentRect.left) + 'px';
        }
    }

    // Set posisi awal marker
    if (activeLink) {
        moveIndicator(activeLink);
        setTimeout(() => moveIndicator(activeLink), 100);
    }

    // --- 2. Dynamic Hero Image Preview (The "Content Swap" Effect) ---
    // Cari elemen visual utama di halaman ini (bisa berupa IMG atau DIV background)
    const heroVisual = document.querySelector('.hero-img'); 
    const headerCard = document.querySelector('.page-header-card');
    
    // Tentukan target yang akan dimanipulasi
    let visualTarget = null;
    let originalState = null;
    let isImgTag = false;

    if (heroVisual) {
        visualTarget = heroVisual;
        originalState = heroVisual.src;
        isImgTag = true;
        // Pastikan transisi opacity aktif via JS style jika belum ada di CSS
        visualTarget.style.transition = "opacity 0.3s ease, transform 0.5s ease";
    } else if (headerCard) {
        visualTarget = headerCard;
        // Simpan background image asli (url)
        originalState = window.getComputedStyle(headerCard).backgroundImage;
        isImgTag = false;
        visualTarget.style.transition = "background-image 0.3s ease-in-out";
    }

    // Fungsi ganti gambar
    function swapHeroImage(newSrc) {
        if (!visualTarget || !newSrc) return;

        if (isImgTag) {
            // Efek Fade untuk IMG tag
            visualTarget.style.opacity = 0.6; // Sedikit transparan saat ganti
            setTimeout(() => {
                visualTarget.src = newSrc;
                visualTarget.style.opacity = 1;
            }, 150);
        } else {
            // Efek ganti background untuk DIV
            // Kita pertahankan gradient overlay, hanya ganti URL gambarnya
            const gradient = "linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4))";
            visualTarget.style.backgroundImage = `${gradient}, url('${newSrc}')`;
        }
    }

    // Event Listeners Navigasi
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', (e) => {
            // A. Geser Marker
            moveIndicator(e.target);

            // B. Ganti Hero Image (Preview)
            const previewImg = link.getAttribute('data-img');
            if (previewImg) {
                swapHeroImage(previewImg);
            }
        });
    });

    // Reset saat mouse keluar area menu
    const navContainer = document.querySelector('.nav-links');
    if (navContainer) {
        navContainer.addEventListener('mouseleave', () => {
            // A. Kembalikan Marker
            if (activeLink) {
                moveIndicator(activeLink);
            } else {
                marker.style.width = '0';
            }

            // B. Kembalikan Hero Image Asli
            if (visualTarget && originalState) {
                if (isImgTag) {
                    swapHeroImage(originalState);
                } else {
                    visualTarget.style.backgroundImage = originalState;
                }
            }
        });
    }

    // --- 3. Window Resize Handler ---
    window.addEventListener('resize', () => {
        if (activeLink) moveIndicator(activeLink);
    });

    // --- 4. Live Search & Utilities ---
    const pathArray = window.location.pathname.split('/');
    const baseURL = window.location.origin + '/' + pathArray[1] + '/public';
    const keywordInput = document.getElementById('keyword');
    const gridContainer = document.getElementById('character-grid');

    if (keywordInput && gridContainer) {
        keywordInput.addEventListener('keyup', function() {
            const keyword = this.value;
            fetch(baseURL + '/characters/liveSearch', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ keyword: keyword })
            })
            .then(response => response.text())
            .then(html => gridContainer.innerHTML = html)
            .catch(error => console.error('Error:', error));
        });
    }

    if (gridContainer) {
        gridContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-btn')) {
                const name = e.target.getAttribute('data-name');
                if (!confirm('Hapus ' + name + '?')) e.preventDefault();
            }
        });
    }
});