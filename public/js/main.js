/**
 * Main JavaScript for Genpedia
 * Features:
 * 1. Instant Hover-Intent Navigation (SPA) with Prefetching.
 * 2. Sliding Navigation Marker.
 * 3. Dynamic content handling (Ghost-free transitions).
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Configuration ---
    const pathArray = window.location.pathname.split('/');
    const baseURL = window.location.origin + '/' + pathArray[1] + '/public';

    // --- State Management ---
    let hoverTimeout;
    const HOVER_DELAY = 50; 
    let isAnimating = false;
    const pageCache = {}; 

    // --- DOM Elements ---
    const mainContainer = document.querySelector('main.container');
    const navLinks = document.querySelectorAll('.nav-links a');
    const marker = document.querySelector('.nav-marker');

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

    async function navigateTo(url, pushToHistory = true) {
        if (url === window.location.href || isAnimating) return;

        isAnimating = true;

        try {
            const pageData = await prefetchPage(url);

            if (pushToHistory) {
                window.history.pushState({ path: url }, '', url);
            }

            document.title = pageData.title;
            updateActiveMenu(url);
            performTransition(pageData.html);

        } catch (error) {
            window.location.href = url;
        } finally {
            setTimeout(() => { isAnimating = false; }, 400); 
        }
    }

    function performTransition(htmlContent) {
        if (!mainContainer) return;

        // 1. Snapshot konten lama & Ubah jadi Absolute (Float)
        // Ini kunci agar konten baru tidak terdorong ke bawah
        const oldContent = document.createElement('div');
        oldContent.className = 'view-exit'; // Class baru di layout.css
        
        while (mainContainer.firstChild) {
            oldContent.appendChild(mainContainer.firstChild);
        }
        mainContainer.appendChild(oldContent);

        // 2. Siapkan konten baru
        const newContent = document.createElement('div');
        newContent.className = 'view-wrapper view-visible'; // Langsung trigger animasi masuk
        newContent.innerHTML = htmlContent;
        mainContainer.appendChild(newContent);

        // 3. Cleanup DOM setelah animasi selesai
        setTimeout(() => {
            oldContent.remove();
            
            // Unwrap konten baru agar DOM tetap bersih (tidak bersarang)
            while (newContent.firstChild) {
                mainContainer.appendChild(newContent.firstChild);
            }
            newContent.remove();
            
            reattachDynamicEvents();
        }, 300); // 300ms sesuai durasi transisi CSS
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