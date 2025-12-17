/**
 * Hover Navigation Component JavaScript
 * 
 * @package Genpedia
 * @author franzxml
 */

document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.navigation-link');
    
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const href = this.getAttribute('href');
            if (href && href !== window.location.pathname) {
                window.location.href = href;
            }
        });
    });
});