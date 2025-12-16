<?php
/**
 * Home Index View.
 *
 * Uses the global header and footer partials.
 * @var array $data Passed from controller.
 */
require APPROOT . '/views/inc/header.php';
?>

<div class="container text-center">
    <div class="hero-section">
        <h1 class="display-title"><?php echo $data['title']; ?></h1>
        <p class="lead-text"><?php echo $data['description']; ?></p>
        <hr class="divider">
        <p>Manage your Genshin Impact character database efficiently.</p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>