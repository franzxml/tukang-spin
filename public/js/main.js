/**
 * Main JavaScript for Genpedia Application
 * * Features:
 * 1. Instant Hover-Intent Navigation (SPA-like feel) with Queueing logic.
 * 2. Sliding Navigation Marker.
 * 3. Dynamic content fetching and DOM manipulation.
 * 4. Premium Toast Notification Auto-Dismissal.
 * 5. Custom iOS-Style Confirmation Modal.
 * 6. Fix for Double Notifications (strips native onclick handlers).
 * * @author FranzXML
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Configuration ---
    
    const logoLink = document.querySelector('.brand-logo');
    const baseURL = logoLink ? logoLink.href.replace(/\/+$/, '') : window.location.origin;

    // --- State Management ---
    
    let hoverTimeout;
    const HOVER_DELAY = 50; 
    let isAnimating = false;
    let pendingNavigation = null; 
    const pageCache = {}; 

    // --- DOM Elements ---
    
    const mainContainer = document.querySelector('main.container');
    const navLinks = document.querySelectorAll('.nav-links a');
    const marker = document.querySelector('.nav-marker');

    // --- Functions ---

    /**
     * Removes inline 'onclick' attributes from delete buttons.
     * Prevents native browser confirm dialogs from double-firing.
     */
    function cleanInlineHandlers() {
        const buttons = document.querySelectorAll('.btn-danger, .item-delete-btn, a[onclick*="confirm"]');
        buttons.forEach(btn => {
            if (btn.hasAttribute('onclick')) {
                btn.removeAttribute('onclick');
            }
        });
    }

    /**
     * Prefetch page content to enable instant navigation.
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
     * Handles navigation with smooth transitions and queuing.
     */
    async function navigateTo(url, pushToHistory = true) {
        if (isAnimating) {
            pendingNavigation = { url, pushToHistory };
            return;
        }

        if (url === window.location.href) return;

        isAnimating = true;
        pendingNavigation = null;

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
            window.location.href = url;
        } finally {
            setTimeout(() => {
                isAnimating = false;
                if (pendingNavigation) {
                    const next = pendingNavigation;
                    if (next.url !== window.location.href) {
                        navigateTo(next.url, next.pushToHistory);
                    }
                }
            }, 350); 
        }
    }

    /**
     * Executes the visual transition between pages.
     */
    function performTransition(htmlContent) {
        if (!mainContainer) return;

        const oldContent = document.createElement('div');
        oldContent.className = 'view-exit'; 
        while (mainContainer.firstChild) {
            oldContent.appendChild(mainContainer.firstChild);
        }
        mainContainer.appendChild(oldContent);

        const newContent = document.createElement('div');
        newContent.className = 'view-wrapper view-visible';
        newContent.innerHTML = htmlContent;
        mainContainer.appendChild(newContent);

        void newContent.offsetWidth;

        setTimeout(() => {
            oldContent.remove();
            while (newContent.firstChild) {
                mainContainer.appendChild(newContent.firstChild);
            }
            newContent.remove();
            
            reattachDynamicEvents();
            initToast();
            cleanInlineHandlers(); // Re-clean after navigation
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
            const newInput = keywordInput.cloneNode(true);
            keywordInput.parentNode.replaceChild(newInput, keywordInput);
            
            newInput.addEventListener('keyup', function() {
                const keyword = this.value;
                fetch(baseURL + '/characters/liveSearch', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ keyword: keyword })
                })
                .then(res => {
                    if (!res.ok) throw new Error('Live search failed');
                    return res.text();
                })
                .then(html => gridContainer.innerHTML = html)
                .catch(err => console.error(err));
            });
        }
    }

    /**
     * Initializes Toast Notifications.
     */
    function initToast() {
        const toast = document.querySelector('.flash-toast');
        if (toast) {
            setTimeout(() => {
                dismissToast(toast);
            }, 4000);
            toast.style.pointerEvents = 'auto';
            toast.addEventListener('click', () => dismissToast(toast));
        }
    }

    function dismissToast(element) {
        if (!element) return;
        element.classList.add('hiding');
        element.addEventListener('animationend', () => {
            element.remove();
        });
    }

    /**
     * Shows a custom iOS-style confirmation modal.
     */
    function showCustomConfirm(title, message, onConfirm) {
        const overlay = document.createElement('div');
        overlay.className = 'ios-modal-overlay'; // Fixed centered overlay

        overlay.innerHTML = `
            <div class="ios-modal">
                <div class="ios-modal-content">
                    <div class="ios-modal-title">${title}</div>
                    <div class="ios-modal-message">${message}</div>
                </div>
                <div class="ios-modal-actions">
                    <button class="ios-modal-btn btn-cancel">Batal</button>
                    <button class="ios-modal-btn btn-confirm">Hapus</button>
                </div>
            </div>
        `;

        document.body.appendChild(overlay);

        const cancelBtn = overlay.querySelector('.btn-cancel');
        const confirmBtn = overlay.querySelector('.btn-confirm');

        function closeModal() {
            overlay.style.transition = 'opacity 0.2s ease';
            overlay.style.opacity = '0';
            setTimeout(() => {
                if (document.body.contains(overlay)) {
                    document.body.removeChild(overlay);
                }
            }, 200);
        }

        cancelBtn.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal();
        });
        
        confirmBtn.addEventListener('click', (e) => {
            e.preventDefault();
            onConfirm();
            closeModal();
        });

        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeModal();
        });
    }

    // --- Initialization & Event Listeners ---

    navLinks.forEach(link => {
        link.addEventListener('mouseenter', (e) => {
            moveIndicator(e.target);
            const targetUrl = link.href;
            if (targetUrl !== window.location.href) prefetchPage(targetUrl);
            hoverTimeout = setTimeout(() => navigateTo(targetUrl), HOVER_DELAY);
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

    // Initial Setup
    const activeLink = document.querySelector('.nav-links a.active');
    if (activeLink) {
        moveIndicator(activeLink);
        setTimeout(() => moveIndicator(activeLink), 100);
    }
    
    reattachDynamicEvents();
    initToast();
    cleanInlineHandlers(); // Run on first load

    // Global Confirm Delete Handler (Using Custom Modal)
    document.addEventListener('click', function(e) {
        let target = e.target;
        if (!target.classList.contains('btn-danger') && !target.classList.contains('item-delete-btn')) {
            target = target.closest('.btn-danger, .item-delete-btn');
        }

        if (target && (target.classList.contains('btn-danger') || target.classList.contains('item-delete-btn'))) {
            const deleteUrl = target.getAttribute('href');
            
            if (deleteUrl && deleteUrl !== '#') {
                e.preventDefault();
                e.stopPropagation();

                showCustomConfirm(
                    'Konfirmasi Hapus',
                    'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
                    () => {
                        window.location.href = deleteUrl;
                    }
                );
            }
        }
    });
    
    window.addEventListener('resize', () => {
        const currentActive = document.querySelector('.nav-links a.active');
        if (currentActive) moveIndicator(currentActive);
    });
});