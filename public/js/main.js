/**
 * Main JavaScript for Genpedia
 * Handles AJAX Live Search, Event Delegation, and UI Animations.
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. Sliding Navigation Marker Logic ---
    const marker = document.querySelector('.nav-marker');
    const navLinks = document.querySelectorAll('.nav-links a');
    const activeLink = document.querySelector('.nav-links a.active');

    function moveIndicator(element) {
        if (element && marker) {
            // Hitung posisi dan lebar elemen target relatif terhadap parent (ul)
            const parentRect = element.closest('.nav-links').getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();

            // Set lebar marker sesuai lebar teks link
            marker.style.width = elementRect.width + 'px';
            
            // Set posisi kiri marker
            marker.style.left = (elementRect.left - parentRect.left) + 'px';
        }
    }

    // A. Set posisi awal ke link yang aktif saat halaman dimuat
    if (activeLink) {
        moveIndicator(activeLink);
        
        // Timeout kecil untuk fix jika font belum keload sempurna
        setTimeout(() => moveIndicator(activeLink), 100);
    }

    // B. Event Listeners untuk Hover
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', (e) => {
            moveIndicator(e.target);
        });
    });

    // C. Kembalikan ke link aktif saat mouse keluar dari area menu
    const navContainer = document.querySelector('.nav-links');
    if (navContainer) {
        navContainer.addEventListener('mouseleave', () => {
            if (activeLink) {
                moveIndicator(activeLink);
            } else {
                // Jika tidak ada yang aktif, sembunyikan marker (lebar 0)
                marker.style.width = '0';
            }
        });
    }

    // --- Configuration ---
    const pathArray = window.location.pathname.split('/');
    const baseURL = window.location.origin + '/' + pathArray[1] + '/public';

    // --- DOM Elements ---
    const keywordInput = document.getElementById('keyword');
    const gridContainer = document.getElementById('character-grid');

    // --- Live Search Logic ---
    if (keywordInput && gridContainer) {
        keywordInput.addEventListener('keyup', function() {
            const keyword = this.value;

            fetch(baseURL + '/characters/liveSearch', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ keyword: keyword })
            })
            .then(response => response.text())
            .then(html => {
                gridContainer.innerHTML = html;
            })
            .catch(error => console.error('Error fetching data:', error));
        });
    }

    // --- Delete Confirmation ---
    if (gridContainer) {
        gridContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-btn')) {
                const name = e.target.getAttribute('data-name');
                if (!confirm('Are you sure you want to delete ' + name + '?')) {
                    e.preventDefault();
                }
            }
        });
    }
    
    // Recalculate marker on window resize to keep it aligned
    window.addEventListener('resize', () => {
        if (activeLink) moveIndicator(activeLink);
    });

});