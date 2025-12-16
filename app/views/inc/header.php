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
            const navLinks = document.querySelectorAll('#nav-menu li a');
            
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    // Only navigate if we aren't already on that page (to prevent loops)
                    if (!this.classList.contains('active')) {
                        window.location.href = this.href;
                    }
                });
            });
        });
    </script>