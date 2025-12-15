/**
 * Main JavaScript for Genpedia
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. Sliding Navigation Marker Logic (Existing) ---
    const marker = document.querySelector('.nav-marker');
    const navLinks = document.querySelectorAll('.nav-links a');
    const activeLink = document.querySelector('.nav-links a.active');
    
    // --- 2. Preview Card Logic (NEW) ---
    const previewCard = document.getElementById('navPreview');
    const previewImg = document.getElementById('previewImg');
    const previewTitle = document.getElementById('previewTitle');
    const previewDesc = document.getElementById('previewDesc');
    let hoverTimeout;

    // Fungsi Marker (Sama seperti sebelumnya)
    function moveIndicator(element) {
        if (element && marker) {
            const parentRect = element.closest('.nav-links').getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();
            marker.style.width = elementRect.width + 'px';
            marker.style.left = (elementRect.left - parentRect.left) + 'px';
        }
    }

    if (activeLink) {
        moveIndicator(activeLink);
        setTimeout(() => moveIndicator(activeLink), 100);
    }

    // Event Listeners untuk Navigasi
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', (e) => {
            // A. Pindahkan Marker
            moveIndicator(e.target);

            // B. Tampilkan Preview Card
            const title = link.getAttribute('data-title');
            const desc = link.getAttribute('data-desc');
            const img = link.getAttribute('data-img');

            if (previewCard && title) {
                // Clear timeout lama jika user geser cepat
                clearTimeout(hoverTimeout);

                // Update konten kartu
                previewTitle.textContent = title;
                previewDesc.textContent = desc;
                previewImg.src = img;

                // Tampilkan kartu
                previewCard.classList.add('visible');
            }
        });
    });

    // Event saat Mouse Keluar dari Area Menu
    const navContainer = document.querySelector('.nav-links');
    if (navContainer) {
        navContainer.addEventListener('mouseleave', () => {
            // A. Reset Marker ke link aktif
            if (activeLink) {
                moveIndicator(activeLink);
            } else {
                marker.style.width = '0';
            }

            // B. Sembunyikan Preview Card
            if (previewCard) {
                // Beri jeda sedikit supaya transisi smooth
                hoverTimeout = setTimeout(() => {
                    previewCard.classList.remove('visible');
                }, 50);
            }
        });
    }

    // --- (Sisa kode JS seperti Live Search dll tetap sama) ---
    // ...
    // ... (Pastikan kode sisa di file asli tetap ada)
    
    // Konfigurasi & Live Search
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

    window.addEventListener('resize', () => {
        if (activeLink) moveIndicator(activeLink);
    });
});