<?php
/**
 * Header Component
 * 
 * @package Genpedia
 * @author franzxml
 */
?>
<header class="header">
    <div class="header-container">
        <img src="/images/logo.png" alt="<?php echo APP_NAME; ?> Logo" class="header-logo">
        <nav class="navigation">
            <ul class="navigation-list">
                <li class="navigation-item">
                    <a href="/" class="navigation-link <?php echo (!isset($currentPage) || $currentPage === 'home') ? 'active' : ''; ?>">Home</a>
                </li>
                <li class="navigation-item">
                    <a href="/character" class="navigation-link <?php echo (isset($currentPage) && $currentPage === 'character') ? 'active' : ''; ?>">Character</a>
                </li>
                <li class="navigation-item">
                    <a href="/weapon" class="navigation-link <?php echo (isset($currentPage) && $currentPage === 'weapon') ? 'active' : ''; ?>">Weapon</a>
                </li>
                <li class="navigation-item">
                    <a href="/artifact" class="navigation-link <?php echo (isset($currentPage) && $currentPage === 'artifact') ? 'active' : ''; ?>">Artifact</a>
                </li>
                <span class="navigation-bar"></span>
            </ul>
        </nav>
    </div>
</header>