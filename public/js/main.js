/**
 * Main JavaScript for Genpedia Application
 * * Features:
 * 1. Instant Hover-Intent Navigation (SPA-like feel) with Queueing logic.
 * 2. Sliding Navigation Marker.
 * 3. Dynamic content fetching and DOM manipulation.
 * 4. Premium Toast Notification Auto-Dismissal.
 * 5. Custom iOS-Style Confirmation Modal (Replacing standard window.confirm).
 * 6. Robust Base URL handling for Virtual Hosts.
 * * @author FranzXML
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Configuration ---
    
    /** * Determine the Base URL dynamically from the logo link.
     * This ensures accuracy across Localhost and Virtual Hosts.
     * @type {string}
     */
    const logoLink = document.querySelector('.brand-logo');
    const baseURL = logoLink ? logoLink.href.replace(/\/+$/, '') : window.location.origin;

    // --- State Management ---
    
    let hoverTimeout;
    const HOVER_DELAY = 50; 
    let isAnimating = false;
    
    /** * Navigation Queue to store the pending destination 
     * if the user hovers/clicks while an animation is active.
     */
    let pendingNavigation = null; 

    const pageCache = {}; 

    // --- DOM Elements ---
    
    const mainContainer = document.querySelector('main.container');
    const navLinks = document.querySelectorAll('.nav-links a');
    const marker = document.querySelector('.nav-marker');

    // --- Functions ---

    /**
     * Prefetch page content to enable instant navigation.
     * Caches the result to avoid redundant network requests.
     * * @param {string} url - The URL to fetch.
     * @returns {Promise} - Resolves with page HTML and Title.
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
     * * @param {string} url - Destination URL.
     * @param {boolean} pushToHistory - Whether to push state to History API.
     */
    async function navigateTo(url, pushToHistory = true) {
        // If animating, queue the request to prevent glitches
        if (isAnimating) {
            pendingNavigation = { url, pushToHistory };
            return;
        }

        // Ignore if already on the requested page
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
            window.location.href = url; // Fallback to standard navigation
        } finally {
            // Buffer to ensure CSS transition completes
            setTimeout(() => {
                isAnimating = false;
                
                // Process the queue if a new request came in
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
     * * @param {string} htmlContent - The new HTML content to inject.
     */
    function performTransition(htmlContent) {
        if (!mainContainer) return;

        // Snapshot old content for exit animation
        const oldContent = document.createElement('div');
        oldContent.className = 'view-exit'; 
        while (mainContainer.firstChild) {
            oldContent.appendChild(mainContainer.firstChild);
        }
        mainContainer.appendChild(oldContent);

        // Inject new content
        const newContent = document.createElement('div');
        newContent.className = 'view-wrapper view-visible';
        newContent.innerHTML = htmlContent;
        mainContainer.appendChild(newContent);

        // Force browser reflow to trigger animation
        void newContent.offsetWidth;

        // Cleanup after animation
        setTimeout(() => {
            oldContent.remove();
            
            while (newContent.firstChild) {
                mainContainer.appendChild(newContent.firstChild);
            }
            newContent.remove();
            
            reattachDynamicEvents();
            initToast(); // Re-initialize toasts for new content
        }, 300); 
    }

    /**
     * Updates the active state of navigation links and moves the marker.
     * * @param {string} currentUrl 
     */
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

    /**
     * Moves the sliding underline marker to the target element.
     * * @param {HTMLElement} element 
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
     * Re-attaches event listeners to dynamic elements (e.g., Live Search).
     * Called after content replacement.
     */
    function reattachDynamicEvents() {
        const keywordInput = document.getElementById('keyword');
        const gridContainer = document.getElementById('character-grid');

        if (keywordInput && gridContainer) {
            // Clone node to strip old listeners and avoid duplication
            const newInput = keywordInput.cloneNode(true);
            keywordInput.parentNode.replaceChild(newInput, keywordInput);
            
            newInput.addEventListener('keyup', function() {
                const keyword = this.value;
                
                // Use the correct Base URL
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
     * Sets auto-dismiss timer and click-to-dismiss behavior.
     */
    function initToast() {
        const toast = document.querySelector('.flash-toast');
        if (toast) {
            // Auto dismiss after 4 seconds
            setTimeout(() => {
                dismissToast(toast);
            }, 4000);

            // Allow manual dismissal
            toast.style.pointerEvents = 'auto';
            toast.addEventListener('click', () => dismissToast(toast));
        }
    }

    /**
     * Animates the toast out and removes it from DOM.
     * * @param {HTMLElement} element 
     */
    function dismissToast(element) {
        if (!element) return;
        element.classList.add('hiding');
        element.addEventListener('animationend', () => {
            element.remove();
        });
    }

    /**
     * Shows a custom iOS-style confirmation modal.
     * Replaces standard browser confirm() dialogs.
     * * @param {string} title - Title of the modal
     * @param {string} message - Description text
     * @param {Function} onConfirm - Callback to execute on confirmation
     */
    function showCustomConfirm(title, message, onConfirm) {
        // Create Overlay
        const overlay = document.createElement('div');
        overlay.className = 'ios-modal-overlay';

        // Create Modal HTML
        overlay.innerHTML = `
            <div class="ios-modal">
                <div class="ios-modal-content">
                    <div class="ios-modal-title">${title}</div>
                    <div class="ios-modal-desc">${message}</div>
                </div>
                <div class="ios-modal-actions">
                    <button class="ios-modal-btn cancel-btn">Batal</button>
                    <button class="ios-modal-btn is-danger confirm-btn">Hapus</button>
                </div>
            </div>
        `;

        document.body.appendChild(overlay);

        // Handlers
        const cancelBtn = overlay.querySelector('.cancel-btn');
        const confirmBtn = overlay.querySelector('.confirm-btn');

        function closeModal() {
            overlay.style.opacity = '0';
            setTimeout(() => overlay.remove(), 200);
        }

        cancelBtn.addEventListener('click', closeModal);
        
        confirmBtn.addEventListener('click', () => {
            onConfirm();
            closeModal();
        });

        // Close on backdrop click
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeModal();
        });
    }

    // --- Initialization & Event Listeners ---

    navLinks.forEach(link => {
        // Hover Intent
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

        // Cancel navigation
        link.addEventListener('mouseleave', () => {
            clearTimeout(hoverTimeout);
            const activeLink = document.querySelector('.nav-links a.active');
            if (activeLink) moveIndicator(activeLink);
        });

        // Click fallback
        link.addEventListener('click', (e) => {
            e.preventDefault();
            clearTimeout(hoverTimeout);
            navigateTo(link.href);
        });
    });

    // Handle Browser Back/Forward buttons
    window.addEventListener('popstate', () => {
        navigateTo(window.location.href, false);
    });

    // Initial Marker Position
    const activeLink = document.querySelector('.nav-links a.active');
    if (activeLink) {
        moveIndicator(activeLink);
        setTimeout(() => moveIndicator(activeLink), 100);
    }
    
    // Initial Setup
    reattachDynamicEvents();
    initToast();

    // Global Confirm Delete Handler (Replacing Native Alert)
    document.addEventListener('click', function(e) {
        // Target element checking
        let target = e.target;
        // Traverse up if clicked on icon inside button
        if (!target.classList.contains('btn-danger') && !target.classList.contains('item-delete-btn')) {
            target = target.closest('.btn-danger, .item-delete-btn');
        }

        if (target && (target.classList.contains('btn-danger') || target.classList.contains('item-delete-btn'))) {
            // Prevent default navigation
            e.preventDefault();
            e.stopPropagation();

            const deleteUrl = target.getAttribute('href');
            
            if (deleteUrl) {
                showCustomConfirm(
                    'Konfirmasi Hapus',
                    'Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus data ini?',
                    () => {
                        window.location.href = deleteUrl;
                    }
                );
            }
        }
    });
    
    // Responsive Marker Adjustment
    window.addEventListener('resize', () => {
        const currentActive = document.querySelector('.nav-links a.active');
        if (currentActive) moveIndicator(currentActive);
    });
});