<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Add New Weapon</h2>
    <form action="<?php echo URLROOT; ?>/weapons/add" method="POST">
        <label>Name: <input type="text" name="name" required></label><br>
        
        <label>Type: 
            <select name="type">
                <option value="Sword">Sword</option>
                <option value="Claymore">Claymore</option>
                <option value="Polearm">Polearm</option>
                <option value="Catalyst">Catalyst</option>
                <option value="Bow">Bow</option>
            </select>
        </label><br>

        <label>Rarity (1-5): <input type="number" name="rarity" min="1" max="5" required></label><br>
        <label>Base ATK: <input type="number" name="base_atk" required></label><br>
        <label>Description: <textarea name="description"></textarea></label><br>
        
        <input type="submit" value="Add Weapon" class="btn">
    </form>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>