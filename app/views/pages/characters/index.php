<?php
// Include Layouts
require_once dirname(__DIR__, 2) . '/layouts/header.php';
require_once dirname(__DIR__, 2) . '/components/navbar.php';
?>

<div class="container">
    <div class="char-header">
        <h1>Characters</h1>
        <a href="/character/create" class="btn-primary">
            + Add Character
        </a>
    </div>

    <div class="char-grid">
        <?php if (empty($characters)): ?>
            <p>No characters found in the database.</p>
        <?php else: ?>
            <?php foreach ($characters as $char): ?>
                <div class="char-card">
                    <h3><?= htmlspecialchars($char['name']) ?></h3>
                    <div class="char-info">
                        <?= htmlspecialchars($char['element']) ?> / 
                        <?= htmlspecialchars($char['weapon_type']) ?>
                    </div>
                    <div class="char-info">
                        <?= $char['rarity'] ?> Stars
                    </div>
                    <div style="margin-top: 15px;">
                        <a href="/character/edit/<?= $char['id'] ?>" class="btn-primary" style="padding: 5px 10px; font-size: 0.9rem;">
                            Edit
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once dirname(__DIR__, 2) . '/layouts/footer.php'; ?>