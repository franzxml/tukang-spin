/**
 * Main JavaScript for Genpedia
 * Handles AJAX Live Search and Event Delegation for dynamic elements.
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Configuration ---
    // Detect base URL dynamically based on current path
    const pathArray = window.location.pathname.split('/');
    // Assuming structure is /genpedia/public/...
    // Adjust index if your folder structure is deeper or shallower
    const baseURL = window.location.origin + '/' + pathArray[1] + '/public';

    // --- DOM Elements ---
    const keywordInput = document.getElementById('keyword');
    const searchContainer = document.getElementById('search-container');
    const gridContainer = document.getElementById('character-grid');

    // --- Live Search Logic ---
    if (keywordInput && gridContainer) {
        
        keywordInput.addEventListener('keyup', function() {
            const keyword = this.value;

            fetch(baseURL + '/characters/liveSearch', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ keyword: keyword })
            })
            .then(response => response.text())
            .then(html => {
                gridContainer.innerHTML = html;
            })
            .catch(error => console.error('Error fetching data:', error));
        });
    }

    // --- Delete Confirmation (Event Delegation) ---
    // We use delegation because the delete buttons are re-rendered by AJAX
    if (gridContainer) {
        gridContainer.addEventListener('click', function(e) {
            // Check if the clicked element is a delete button or inside one
            if (e.target.classList.contains('delete-btn')) {
                const name = e.target.getAttribute('data-name');
                if (!confirm('Are you sure you want to delete ' + name + '?')) {
                    e.preventDefault();
                }
            }
        });
    }

});