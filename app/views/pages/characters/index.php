<?php
require_once dirname(__DIR__, 2) . '/layouts/header.php';
require_once dirname(__DIR__, 2) . '/components/navbar.php';
?>

<div class="container">
    <div class="char-header">
        <h1>Characters</h1>
        <a href="/character/create" class="btn-primary">+ Add</a>
    </div>

    <div class="char-grid">
        <?php if (empty($characters)): ?>
            <p>No characters found.</p>
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
                    <div style="margin-top:10px;">
                        <a href="/character/edit/<?= $char['id'] ?>" class="btn-primary" 
                           style="padding:5px 10px; font-size:0.8rem">Edit</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once dirname(__DIR__, 2) . '/layouts/footer.php'; ?>