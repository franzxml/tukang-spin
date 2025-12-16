<?php
require_once dirname(__DIR__, 2) . '/layouts/header.php';
require_once dirname(__DIR__, 2) . '/components/navbar.php';

// Helper to check selection
function isSelected($current, $target) {
    return $current == $target ? 'selected' : '';
}
?>

<div class="container">
    <h1>Edit Character: <?= htmlspecialchars($character['name']) ?></h1>
    
    <form action="/character/update/<?= $character['id'] ?>" method="POST" class="char-form">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($character['name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Region</label>
            <input type="text" name="region" value="<?= htmlspecialchars($character['region']) ?>" required>
        </div>
        <div class="form-group">
            <label>Element</label>
            <select name="element">
                <?php 
                $elements = ['Anemo', 'Geo', 'Electro', 'Dendro', 'Hydro', 'Pyro', 'Cryo'];
                foreach ($elements as $el): ?>
                    <option <?= isSelected($character['element'], $el) ?>><?= $el ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Weapon</label>
            <select name="weapon">
                <?php 
                $weapons = ['Sword', 'Claymore', 'Polearm', 'Catalyst', 'Bow'];
                foreach ($weapons as $wp): ?>
                    <option <?= isSelected($character['weapon_type'], $wp) ?>><?= $wp ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Rarity</label>
            <select name="rarity">
                <option value="4" <?= isSelected($character['rarity'], 4) ?>>4 Stars</option>
                <option value="5" <?= isSelected($character['rarity'], 5) ?>>5 Stars</option>
            </select>
        </div>
        <button type="submit" class="btn-primary">Update Character</button>
    </form>
</div>

<?php require_once dirname(__DIR__, 2) . '/layouts/footer.php'; ?>