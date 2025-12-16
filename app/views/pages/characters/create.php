<?php
require_once dirname(__DIR__, 2) . '/layouts/header.php';
require_once dirname(__DIR__, 2) . '/components/navbar.php';
?>

<div class="container">
    <h1>Add New Character</h1>
    <form action="/character/store" method="POST" class="char-form">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Region</label>
            <input type="text" name="region" required>
        </div>
        <div class="form-group">
            <label>Element</label>
            <select name="element">
                <option>Anemo</option><option>Geo</option><option>Electro</option>
                <option>Dendro</option><option>Hydro</option><option>Pyro</option><option>Cryo</option>
            </select>
        </div>
        <div class="form-group">
            <label>Weapon</label>
            <select name="weapon">
                <option>Sword</option><option>Claymore</option><option>Polearm</option>
                <option>Catalyst</option><option>Bow</option>
            </select>
        </div>
        <div class="form-group">
            <label>Rarity</label>
            <select name="rarity">
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>
        <button type="submit" class="btn-primary">Save Character</button>
    </form>
</div>

<?php require_once dirname(__DIR__, 2) . '/layouts/footer.php'; ?>