/**
 * Navigation Component JavaScript
 * 
 * @package Genpedia
 * @author franzxml
 */

document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.navigation-link');
    const activeLink = document.querySelector('.navigation-link.active');
    
    if (activeLink) {
        moveBar(activeLink);
    }
    
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            moveBar(this);
        });
        
        link.addEventListener('mouseleave', function() {
            if (activeLink) {
                moveBar(activeLink);
            }
        });
    });
    
    /**
     * Move sliding bar to target link
     * 
     * @param {HTMLElement} target Target navigation link
     */
    function moveBar(target) {
        const bar = document.querySelector('.navigation-bar');
        const targetRect = target.getBoundingClientRect();
        const navRect = target.closest('.navigation-list').getBoundingClientRect();
        
        bar.style.width = targetRect.width + 'px';
        bar.style.left = (targetRect.left - navRect.left) + 'px';
    }
});