<?php
require_once dirname(__DIR__, 2) . '/layouts/header.php';
require_once dirname(__DIR__, 2) . '/components/navbar.php';
$c = $character; // Shorten variable
?>

<div class="container">
    <h1>Edit: <?= htmlspecialchars($c['name']) ?></h1>
    <form action="/character/update/<?= $c['id'] ?>" method="POST" class="char-form">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?= $c['name'] ?>" required>
        </div>
        <div class="form-group">
            <label>Region</label>
            <input type="text" name="region" value="<?= $c['region'] ?>" required>
        </div>
        <div class="form-group">
            <label>Element</label>
            <select name="element">
                <?php foreach(['Anemo','Geo','Electro','Dendro','Hydro','Pyro','Cryo'] as $e): ?>
                    <option <?= $c['element'] == $e ? 'selected' : '' ?>><?= $e ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Weapon</label>
            <select name="weapon">
                <?php foreach(['Sword','Claymore','Polearm','Catalyst','Bow'] as $w): ?>
                    <option <?= $c['weapon_type'] == $w ? 'selected' : '' ?>><?= $w ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Rarity</label>
            <select name="rarity">
                <option value="4" <?= $c['rarity'] == 4 ? 'selected' : '' ?>>4 Stars</option>
                <option value="5" <?= $c['rarity'] == 5 ? 'selected' : '' ?>>5 Stars</option>
            </select>
        </div>
        <button type="submit" class="btn-primary">Update</button>
    </form>
</div>
<?php require_once dirname(__DIR__, 2) . '/layouts/footer.php'; ?>