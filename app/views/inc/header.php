<?php
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
                <li><a href="<?php echo URLROOT; ?>" class="<?php echo isActive('/'); ?>"><span>Home</span></a></li>
                <li><a href="<?php echo URLROOT; ?>/characters" class="<?php echo isActive('characters'); ?>"><span>Character</span></a></li>
                <li><a href="<?php echo URLROOT; ?>/weapons" class="<?php echo isActive('weapons'); ?>"><span>Weapon</span></a></li>
                <li><a href="<?php echo URLROOT; ?>/artifacts" class="<?php echo isActive('artifacts'); ?>"><span>Artifact</span></a></li>
            </ul>
        </div>
    </nav>
    <main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainContent = document.querySelector('main');
            setTimeout(() => {
                mainContent.classList.add('loaded');
            }, 50);

            const navLinks = document.querySelectorAll('#nav-menu li a');
            let hoverTimer;

            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    if (this.classList.contains('active')) return;

                    // FASTER DEBOUNCE: Reduced to 150ms for snappier reaction
                    hoverTimer = setTimeout(() => {
                        mainContent.classList.remove('loaded');
                        mainContent.classList.add('fading-out');

                        // FASTER TRANSITION: Wait 200ms to match CSS
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 200); 
                    }, 150); 
                });

                link.addEventListener('mouseleave', function() {
                    clearTimeout(hoverTimer);
                });
            });
        });
    </script>