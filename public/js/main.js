/**
 * Main JavaScript for Genpedia
 * Features:
 * 1. Sliding Navigation Marker
 * 2. Full Page Content Preview (AJAX/Fetch) on Hover
 * 3. Live Search & Utilities
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Configuration ---
    // Detect base URL dynamically
    const pathArray = window.location.pathname.split('/');
    // Assuming structure is /genpedia/public/...
    // Adjust index if folder structure is different
    const baseURL = window.location.origin + '/' + pathArray[1] + '/public';

    // --- 1. View Manager (Content Swap Logic) ---
    const mainContainer = document.querySelector('main.container');
    const pageCache = {}; // Cache to store fetched HTML

    // Setup: Wrap existing content to preserve state
    if (mainContainer) {
        // Create wrapper for original content if it doesn't exist
        if (!document.getElementById('original-view')) {
            const originalWrapper = document.createElement('div');
            originalWrapper.id = 'original-view';
            originalWrapper.className = 'view-wrapper view-visible';
            
            // Move all current children into wrapper
            while (mainContainer.firstChild) {
                originalWrapper.appendChild(mainContainer.firstChild);
            }
            mainContainer.appendChild(originalWrapper);

            // Create wrapper for preview content (Hidden by default)
            const previewWrapper = document.createElement('div');
            previewWrapper.id = 'preview-view';
            previewWrapper.className = 'view-wrapper view-hidden';
            mainContainer.appendChild(previewWrapper);
        }
    }

    const originalView = document.getElementById('original-view');
    const previewView = document.getElementById('preview-view');
    let fetchController = null; // To abort stale requests

    /**
     * Fetches page content and updates the preview view.
     * @param {string} url - The URL to fetch.
     */
    async function loadPreview(url) {
        // If same as current page, do nothing (handled by resetView now)
        if (url === window.location.href) return;

        // Check Cache first
        if (pageCache[url]) {
            renderPreview(pageCache[url]);
            return;
        }

        // Fetch from network
        try {
            if (fetchController) fetchController.abort(); // Cancel previous
            fetchController = new AbortController();

            const response = await fetch(url, { signal: fetchController.signal });
            if (!response.ok) throw new Error('Network response was not ok');
            
            const text = await response.text();
            
            // Parse HTML to extract <main> content only
            const parser = new DOMParser();
            const doc = parser.parseFromString(text, 'text/html');
            const mainContent = doc.querySelector('main.container').innerHTML;

            // Cache and Render
            pageCache[url] = mainContent;
            renderPreview(mainContent);

        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('Preview fetch failed:', error);
            }
        }
    }

    function renderPreview(htmlContent) {
        if (!previewView || !originalView) return;
        
        // Inject content
        previewView.innerHTML = htmlContent;
        
        // Swap visibility
        originalView.classList.replace('view-visible', 'view-hidden');
        previewView.classList.replace('view-hidden', 'view-visible');
    }

    function resetView() {
        if (!previewView || !originalView) return;

        // Swap back to original content
        previewView.classList.replace('view-visible', 'view-hidden');
        originalView.classList.replace('view-hidden', 'view-visible');
        
        // Clear preview content after transition to avoid ID conflicts
        setTimeout(() => {
            if (previewView.classList.contains('view-hidden')) {
                previewView.innerHTML = ''; 
            }
        }, 200);
    }


    // --- 2. Navigation Interaction ---
    const marker = document.querySelector('.nav-marker');
    const navLinks = document.querySelectorAll('.nav-links a');
    const activeLink = document.querySelector('.nav-links a.active');
    const navContainer = document.querySelector('.nav-links');

    function moveIndicator(element) {
        if (element && marker) {
            const parentRect = element.closest('.nav-links').getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();
            marker.style.width = elementRect.width + 'px';
            marker.style.left = (elementRect.left - parentRect.left) + 'px';
        }
    }

    // Initialize Marker
    if (activeLink) {
        moveIndicator(activeLink);
        setTimeout(() => moveIndicator(activeLink), 100);
    }

    // Event Listeners
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', (e) => {
            // Move Marker
            moveIndicator(e.target);
            
            const targetUrl = link.href;
            
            // BUG FIX: Check if we are hovering the link of the CURRENT page
            if (targetUrl !== window.location.href) {
                // If different page, load preview
                loadPreview(targetUrl);
            } else {
                // If current page, restore original view (fix for "stuck" preview)
                resetView();
            }
        });
    });

    if (navContainer) {
        navContainer.addEventListener('mouseleave', () => {
            // Reset Marker to Active Link
            if (activeLink) {
                moveIndicator(activeLink);
            } else {
                marker.style.width = '0';
            }

            // Reset View (Hide Preview)
            resetView();
        });
    }

    // Recalculate marker on resize
    window.addEventListener('resize', () => {
        if (activeLink) moveIndicator(activeLink);
    });


    // --- 3. Internal Logic (Search, Delete) ---
    // Note: These listeners attach to the *original* DOM.
    
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
            .then(html => {
                gridContainer.innerHTML = html;
            })
            .catch(error => console.error('Error fetching data:', error));
        });
    }

    // Event Delegation for dynamic delete buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn')) {
            const name = e.target.getAttribute('data-name');
            if (!confirm('Are you sure you want to delete ' + name + '?')) {
                e.preventDefault();
            }
        }
    });

});