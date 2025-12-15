/**
 * Main JavaScript for Genpedia
 * Features:
 * 1. Instant Hover-Intent Navigation (SPA) with Prefetching.
 * 2. Sliding Navigation Marker.
 * 3. Dynamic content handling.
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Configuration ---
    const pathArray = window.location.pathname.split('/');
    const baseURL = window.location.origin + '/' + pathArray[1] + '/public';

    // --- State Management ---
    let hoverTimeout;
    const HOVER_DELAY = 50; // Dipercepat: Hampir instan tapi cukup untuk cegah glitch
    let isAnimating = false;
    
    // Cache menyimpan Promise, bukan string HTML mentah.
    // Ini memungkinkan kita me-request data SEBELUM kita membutuhkannya.
    const pageCache = {}; 

    // --- DOM Elements ---
    const mainContainer = document.querySelector('main.container');
    const navLinks = document.querySelectorAll('.nav-links a');
    const marker = document.querySelector('.nav-marker');

    /**
     * Starts fetching the page content immediately.
     * Returns a Promise that resolves to the HTML content.
     * @param {string} url 
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
                    delete pageCache[url]; // Hapus dari cache jika gagal
                    throw err;
                });
        }
        return pageCache[url];
    }

    /**
     * Navigate to URL using cached/prefetched data
     */
    async function navigateTo(url, pushToHistory = true) {
        if (url === window.location.href || isAnimating) return;

        isAnimating = true;

        try {
            // Kita tunggu Promise yang (seharusnya) sudah dimulai saat 'mouseenter'
            const pageData = await prefetchPage(url);

            if (pushToHistory) {
                window.history.pushState({ path: url }, '', url);
            }

            document.title = pageData.title;
            updateActiveMenu(url);
            performTransition(pageData.html);

        } catch (error) {
            // Fallback ke load biasa jika fetch error
            window.location.href = url;
        } finally {
            setTimeout(() => { isAnimating = false; }, 300); // Sesuaikan dengan durasi animasi CSS
        }
    }

    function performTransition(htmlContent) {
        if (!mainContainer) return;

        // Snapshot konten lama
        const oldContent = document.createElement('div');
        oldContent.className = 'view-wrapper view-visible';
        while (mainContainer.firstChild) {
            oldContent.appendChild(mainContainer.firstChild);
        }
        mainContainer.appendChild(oldContent);

        // Siapkan konten baru
        const newContent = document.createElement('div');
        newContent.className = 'view-wrapper view-hidden';
        newContent.innerHTML = htmlContent;
        mainContainer.appendChild(newContent);

        // Force Reflow
        void newContent.offsetWidth;

        // Animasi Masuk (CSS handle sisanya)
        requestAnimationFrame(() => {
            oldContent.style.opacity = '0';
            // Sedikit delay agar old content hilang dulu visualnya
            newContent.className = 'view-wrapper view-visible';
        });

        // Cleanup DOM
        setTimeout(() => {
            oldContent.remove();
            // Unwrap untuk menjaga struktur DOM bersih
            while (newContent.firstChild) {
                mainContainer.appendChild(newContent.firstChild);
            }
            newContent.remove();
            
            reattachDynamicEvents();
        }, 300); // 300ms sesuai CSS layout.css
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
        // Re-attach Live Search
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
                .then(res => res.text())
                .then(html => gridContainer.innerHTML = html)
                .catch(err => console.error(err));
            });
        }
    }

    // --- Event Listeners ---

    navLinks.forEach(link => {
        link.addEventListener('mouseenter', (e) => {
            moveIndicator(e.target);
            
            // 1. PREFETCH LANGSUNG! Jangan tunggu timer.
            // Ini kunci agar loading terasa instan.
            const targetUrl = link.href;
            if (targetUrl !== window.location.href) {
                prefetchPage(targetUrl);
            }

            // 2. Set timer untuk navigasi visual
            hoverTimeout = setTimeout(() => {
                navigateTo(targetUrl);
            }, HOVER_DELAY);
        });

        link.addEventListener('mouseleave', () => {
            clearTimeout(hoverTimeout);
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

    // Init
    const activeLink = document.querySelector('.nav-links a.active');
    if (activeLink) {
        moveIndicator(activeLink);
        setTimeout(() => moveIndicator(activeLink), 100);
    }
    
    reattachDynamicEvents();

    // Global Delete Delegation
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