<?php
// Include Layouts
require_once dirname(__DIR__, 2) . '/layouts/header.php';
require_once dirname(__DIR__, 2) . '/components/navbar.php';
?>

<div class="container">
    <div class="char-header">
        <h1>Characters</h1>
        <a href="/character/create" class="btn-primary" style="padding: 10px 20px;">
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
                    <div class="char-actions">
                        <a href="/character/edit/<?= $char['id'] ?>" class="btn-primary">
                            Edit
                        </a>
                        <form action="/character/delete/<?= $char['id'] ?>" method="POST" 
                              onsubmit="return confirm('Delete this character?');">
                            <button type="submit" class="btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once dirname(__DIR__, 2) . '/layouts/footer.php'; ?>