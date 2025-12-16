<?php
// Helper to set active class
function isActive($keyword) {
    $currentUrl = $_SERVER['REQUEST_URI'];
    if ($keyword == '/' && (trim($currentUrl, '/') == '' || $currentUrl == '/genpedia/')) {
        return 'active';
    }
    if ($keyword != '/' && strpos($currentUrl, $keyword) !== false) {
        return 'active';
    }
    return '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($data['title']) ? $data['title'] : SITENAME; ?></title>
    
    <link rel="icon" href="<?php echo URLROOT; ?>/assets/img/favicon.png" type="image/png">
    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/layout.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/cards.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/forms.css">
</head>
<body>
    <nav class="navbar">
        <div class="container nav-flex">
            <a href="<?php echo URLROOT; ?>" class="brand">
                <img src="<?php echo URLROOT; ?>/assets/img/favicon.png" alt="Genpedia Logo" class="nav-logo">
            </a>
            
            <ul id="nav-menu">
                <li><a href="<?php echo URLROOT; ?>" class="<?php echo isActive('/'); ?>">Home</a></li>
                <li><a href="<?php echo URLROOT; ?>/characters" class="<?php echo isActive('characters'); ?>">Character</a></li>
                <li><a href="<?php echo URLROOT; ?>/weapons" class="<?php echo isActive('weapons'); ?>">Weapon</a></li>
                <li><a href="<?php echo URLROOT; ?>/artifacts" class="<?php echo isActive('artifacts'); ?>">Artifact</a></li>
            </ul>
        </div>
    </nav>
    <main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Trigger Fade-In on Load
            const mainContent = document.querySelector('main');
            // Slight timeout to ensure CSS transition catches the change
            setTimeout(() => {
                mainContent.classList.add('loaded');
            }, 50);

            // 2. Setup Hover Navigation
            const navLinks = document.querySelectorAll('#nav-menu li a');
            let hoverTimer; // Variable to store our timer

            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    // Ignore if we are already on this page
                    if (this.classList.contains('active')) return;

                    // Start a timer: Only navigate if user hovers for 300ms
                    hoverTimer = setTimeout(() => {
                        // Start Fade Out
                        mainContent.classList.remove('loaded');
                        mainContent.classList.add('fading-out');

                        // Wait for animation (300ms) then change page
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 300); 
                    }, 300); // 300ms debounce delay
                });

                // If mouse leaves before timer finishes, cancel everything!
                link.addEventListener('mouseleave', function() {
                    clearTimeout(hoverTimer);
                });
            });
        });
    </script>