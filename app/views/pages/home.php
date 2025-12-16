<?php
/**
 * Home Page View.
 * Assembles layout parts.
 */

// Include Header
require_once dirname(__DIR__) . '/layouts/header.php';

// Include Navbar
require_once dirname(__DIR__) . '/components/navbar.php';
?>

<div class="container">
    <div class="hero">
        <h1>Welcome to Genpedia</h1>
        <p>Your private Genshin Impact Database.</p>
    </div>
</div>

<?php
// Include Footer
require_once dirname(__DIR__) . '/layouts/footer.php';
?>