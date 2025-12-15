/**
 * Main JavaScript for Genpedia
 * * Features implemented:
 * 1. Hover-Intent Navigation (SPA-like transitions).
 * 2. Sliding Navigation Marker logic.
 * 3. Dynamic content fetching and URL updating (History API).
 * 4. DOM Clean-up to maintain performance.
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Configuration ---
    const pathArray = window.location.pathname.split('/');
    const baseURL = window.location.origin + '/' + pathArray[1] + '/public';

    // --- State Management ---
    let hoverTimeout;
    const HOVER_DELAY = 150; // Waktu tunggu (ms) sebelum pindah halaman (biar tidak "kaget" saat lewat doang)
    let isAnimating = false;
    const pageCache = {}; // Cache untuk menyimpan HTML agar navigasi kedua kali instan

    // --- DOM Elements ---
    const mainContainer = document.querySelector('main.container');
    const navLinks = document.querySelectorAll('.nav-links a');
    const marker = document.querySelector('.nav-marker');

    /**
     * Core Function: Navigate to URL without refreshing
     * @param {string} url - Target URL
     * @param {boolean} pushToHistory - Whether to update browser URL bar
     */
    async function navigateTo(url, pushToHistory = true) {
        // Jangan navigasi jika sedang di URL yang sama atau sedang animasi
        if (url === window.location.href || isAnimating) return;

        isAnimating = true;

        try {
            // 1. Dapatkan Konten Baru (Cache First)
            let newContentHTML = '';

            if (pageCache[url]) {
                newContentHTML = pageCache[url];
            } else {
                const response = await fetch(url);
                if (!response.ok) throw new Error('Network error');
                
                const text = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(text, 'text/html');
                
                // Ambil isi <main> dan <title>
                const newMain = doc.querySelector('main.container');
                const newTitle = doc.querySelector('title').innerText;
                
                if (!newMain) throw new Error('Invalid page structure');

                newContentHTML = newMain.innerHTML;
                
                // Update Title & Cache
                document.title = newTitle;
                pageCache[url] = newContentHTML;
            }

            // 2. Update URL Browser (Penting agar tombol Back berfungsi)
            if (pushToHistory) {
                window.history.pushState({ path: url }, '', url);
            }

            // 3. Update Menu Aktif & Marker
            updateActiveMenu(url);

            // 4. Lakukan Transisi Visual (Cross-fade / Slide)
            performTransition(newContentHTML);

        } catch (error) {
            console.error('Navigation failed:', error);
            // Fallback: Jika fetch gagal, load biasa
            window.location.href = url; 
        } finally {
            // Reset flag setelah delay aman
            setTimeout(() => { isAnimating = false; }, 600);
        }
    }

    /**
     * Handles the visual transition between old and new content
     * @param {string} htmlContent - The new HTML string to inject
     */
    function performTransition(htmlContent) {
        if (!mainContainer) return;

        // Bungkus konten lama agar bisa dianimasikan keluar
        const oldContent = document.createElement('div');
        oldContent.className = 'view-wrapper view-visible'; // Class ada di layout.css
        
        // Pindahkan anak-anak mainContainer ke oldContent
        while (mainContainer.firstChild) {
            oldContent.appendChild(mainContainer.firstChild);
        }
        mainContainer.appendChild(oldContent);

        // Siapkan konten baru
        const newContent = document.createElement('div');
        newContent.className = 'view-wrapper view-hidden'; // Mulai dari hidden
        newContent.innerHTML = htmlContent;
        mainContainer.appendChild(newContent);

        // Trigger Reflow
        void newContent.offsetWidth;

        // Jalankan Animasi
        // 1. Konten lama fade out
        oldContent.style.opacity = '0';
        oldContent.style.transform = 'translateY(-10px)'; // Sedikit naik saat hilang

        // 2. Konten baru masuk (Slide Up dari layout.css @keyframes pageEnter)
        // Kita ganti class view-hidden jadi view-visible untuk memicu animasi CSS
        setTimeout(() => {
            newContent.className = 'view-wrapper view-visible';
            
            // Bersihkan DOM setelah animasi selesai (agar tidak menumpuk div)
            setTimeout(() => {
                oldContent.remove();
                // Unwrap: Pindahkan isi newContent kembali ke mainContainer langsung
                // Ini penting agar event listener global tetap jalan normal
                while (newContent.firstChild) {
                    mainContainer.appendChild(newContent.firstChild);
                }
                newContent.remove();
                
                // Re-attach event listeners untuk konten baru (Search, Delete btn, dll)
                reattachDynamicEvents();
            }, 500); // Sesuaikan dengan durasi animasi CSS
        }, 50);
    }

    /**
     * Updates the active class on navigation links and moves the marker
     */
    function updateActiveMenu(currentUrl) {
        navLinks.forEach(link => {
            // Cek apakah href link cocok dengan URL sekarang
            if (link.href === currentUrl) {
                link.classList.add('active');
                moveIndicator(link);
            } else {
                link.classList.remove('active');
            }
        });
    }

    /**
     * Moves the sliding underline marker
     */
    function moveIndicator(element) {
        if (element && marker) {
            const parentRect = element.closest('.nav-links').getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();
            
            marker.style.width = elementRect.width + 'px';
            marker.style.left = (elementRect.left - parentRect.left) + 'px';
        }
    }

    /**
     * Re-attaches necessary event listeners for dynamic content
     * (Called after every page navigation)
     */
    function reattachDynamicEvents() {
        // 1. Live Search Logic
        const keywordInput = document.getElementById('keyword');
        const gridContainer = document.getElementById('character-grid');

        if (keywordInput && gridContainer) {
            // Remove old listener first (clone node trick) or just add fresh
            // Simple approach: Add new listener (Garbage collector handles old nodes removed from DOM)
            keywordInput.addEventListener('keyup', function() {
                const keyword = this.value;
                fetch(baseURL + '/characters/liveSearch', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ keyword: keyword })
                })
                .then(res => res.text())
                .then(html => gridContainer.innerHTML = html)
                .catch(err => console.error(err));
            });
        }
    }

    // --- Event Listeners Setup ---

    // 1. Navigation Hover Logic
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', (e) => {
            // Pindahkan marker visual dulu biar responsif
            moveIndicator(e.target);

            // Tunggu sebentar (HOVER_DELAY), kalau user masih di situ, baru pindah halaman
            hoverTimeout = setTimeout(() => {
                navigateTo(link.href);
            }, HOVER_DELAY);
        });

        link.addEventListener('mouseleave', () => {
            // Batalkan navigasi jika user cuma lewat cepat
            clearTimeout(hoverTimeout);
            
            // Kembalikan marker ke halaman yang aktif sekarang
            const activeLink = document.querySelector('.nav-links a.active');
            if (activeLink) moveIndicator(activeLink);
        });

        // Handle Klik manual (biar gak full reload)
        link.addEventListener('click', (e) => {
            e.preventDefault();
            clearTimeout(hoverTimeout);
            navigateTo(link.href);
        });
    });

    // 2. Handle Browser Back/Forward Buttons
    window.addEventListener('popstate', () => {
        navigateTo(window.location.href, false); // false = jangan push history lagi
    });

    // 3. Initialize Marker on Load
    const activeLink = document.querySelector('.nav-links a.active');
    if (activeLink) {
        moveIndicator(activeLink);
        setTimeout(() => moveIndicator(activeLink), 100); // Double check for font loading
    }

    // 4. Initial Event Attachment
    reattachDynamicEvents();

    // 5. Global Event Delegation (Delete Buttons)
    // Ini aman ditaruh sekali saja karena nempel di document
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn')) {
            const name = e.target.getAttribute('data-name');
            if (!confirm('Are you sure you want to delete ' + name + '?')) {
                e.preventDefault();
            }
        }
    });

    // 6. Resize Handler
    window.addEventListener('resize', () => {
        const currentActive = document.querySelector('.nav-links a.active');
        if (currentActive) moveIndicator(currentActive);
    });

});