/**
 * Main JavaScript for Genpedia
 * Features:
 * 1. Instant Hover-Intent Navigation (SPA) with Queueing logic.
 * 2. Sliding Navigation Marker.
 * 3. Dynamic content handling without layout trashing.
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Configuration ---
    const pathArray = window.location.pathname.split('/');
    const baseURL = window.location.origin + '/' + pathArray[1] + '/public';

    // --- State Management ---
    let hoverTimeout;
    const HOVER_DELAY = 50; 
    let isAnimating = false;
    
    // QUEUE SYSTEM: Untuk menyimpan tujuan berikutnya jika animasi sedang berjalan
    let pendingNavigation = null; 

    const pageCache = {}; 

    // --- DOM Elements ---
    const mainContainer = document.querySelector('main.container');
    const navLinks = document.querySelectorAll('.nav-links a');
    const marker = document.querySelector('.nav-marker');

    /**
     * Prefetch page content immediately
     */
    function prefetchPage(url) {
        if (!pageCache[url]) {
            pageCache[url] = fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.text();
                })
                .then(text => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(text, 'text/html');
                    const newMain = doc.querySelector('main.container');
                    const newTitle = doc.querySelector('title').innerText;
                    
                    if (!newMain) throw new Error('Invalid page structure');
                    
                    return {
                        html: newMain.innerHTML,
                        title: newTitle
                    };
                })
                .catch(err => {
                    console.error('Prefetch failed:', err);
                    delete pageCache[url];
                    throw err;
                });
        }
        return pageCache[url];
    }

    /**
     * Navigate to URL with Queue Support
     */
    async function navigateTo(url, pushToHistory = true) {
        // Jika sedang animasi, masukkan request ke antrean (Queue)
        // Ini memperbaiki bug "tidak kedetect" saat hover cepat
        if (isAnimating) {
            pendingNavigation = { url, pushToHistory };
            return;
        }

        // Cek apakah URL sama (kecuali ada di antrean, kita force cek nanti)
        if (url === window.location.href) return;

        isAnimating = true;
        pendingNavigation = null; // Reset antrean karena kita mulai proses baru

        try {
            const pageData = await prefetchPage(url);

            if (pushToHistory) {
                window.history.pushState({ path: url }, '', url);
            }

            document.title = pageData.title;
            updateActiveMenu(url);
            performTransition(pageData.html);

        } catch (error) {
            console.error('Navigation error:', error);
            window.location.href = url; // Fallback
        } finally {
            // Tunggu animasi CSS selesai (300ms) + buffer sedikit
            setTimeout(() => {
                isAnimating = false;
                
                // CEK ANTREAN: Apakah user pindah ke menu lain saat kita sedang animasi?
                if (pendingNavigation) {
                    const next = pendingNavigation;
                    // Eksekusi navigasi yang tertunda
                    if (next.url !== window.location.href) {
                        navigateTo(next.url, next.pushToHistory);
                    }
                }
            }, 350); 
        }
    }

    function performTransition(htmlContent) {
        if (!mainContainer) return;

        // Snapshot konten lama
        const oldContent = document.createElement('div');
        oldContent.className = 'view-exit'; 
        while (mainContainer.firstChild) {
            oldContent.appendChild(mainContainer.firstChild);
        }
        mainContainer.appendChild(oldContent);

        // Konten baru
        const newContent = document.createElement('div');
        newContent.className = 'view-wrapper view-visible';
        newContent.innerHTML = htmlContent;
        mainContainer.appendChild(newContent);

        // Force Reflow
        void newContent.offsetWidth;

        // Cleanup DOM
        setTimeout(() => {
            oldContent.remove();
            
            while (newContent.firstChild) {
                mainContainer.appendChild(newContent.firstChild);
            }
            newContent.remove();
            
            reattachDynamicEvents();
        }, 300); 
    }

    function updateActiveMenu(currentUrl) {
        navLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('active');
                moveIndicator(link);
            } else {
                link.classList.remove('active');
            }
        });
    }

    function moveIndicator(element) {
        if (element && marker) {
            const parentRect = element.closest('.nav-links').getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();
            marker.style.width = elementRect.width + 'px';
            marker.style.left = (elementRect.left - parentRect.left) + 'px';
        }
    }

    function reattachDynamicEvents() {
        const keywordInput = document.getElementById('keyword');
        const gridContainer = document.getElementById('character-grid');

        if (keywordInput && gridContainer) {
            // Clone node to strip old listeners avoids duplication
            const newInput = keywordInput.cloneNode(true);
            keywordInput.parentNode.replaceChild(newInput, keywordInput);
            
            newInput.addEventListener('keyup', function() {
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
            // Focus balik ke input jika perlu (opsional)
            newInput.focus(); 
        }
    }

    // --- Event Listeners ---

    navLinks.forEach(link => {
        link.addEventListener('mouseenter', (e) => {
            moveIndicator(e.target);
            
            const targetUrl = link.href;
            if (targetUrl !== window.location.href) {
                prefetchPage(targetUrl);
            }

            hoverTimeout = setTimeout(() => {
                navigateTo(targetUrl);
            }, HOVER_DELAY);
        });

        link.addEventListener('mouseleave', () => {
            clearTimeout(hoverTimeout);
            
            // Kembalikan marker ke menu yang sedang AKTIF (bukan yang di-queue)
            // agar visual konsisten dengan halaman yang sedang tampil
            const activeLink = document.querySelector('.nav-links a.active');
            if (activeLink) moveIndicator(activeLink);
        });

        link.addEventListener('click', (e) => {
            e.preventDefault();
            clearTimeout(hoverTimeout);
            navigateTo(link.href);
        });
    });

    window.addEventListener('popstate', () => {
        navigateTo(window.location.href, false);
    });

    // Init Marker
    const activeLink = document.querySelector('.nav-links a.active');
    if (activeLink) {
        moveIndicator(activeLink);
        setTimeout(() => moveIndicator(activeLink), 100);
    }
    
    reattachDynamicEvents();

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn')) {
            const name = e.target.getAttribute('data-name');
            if (!confirm('Are you sure you want to delete ' + name + '?')) {
                e.preventDefault();
            }
        }
    });
    
    window.addEventListener('resize', () => {
        const currentActive = document.querySelector('.nav-links a.active');
        if (currentActive) moveIndicator(currentActive);
    });
});