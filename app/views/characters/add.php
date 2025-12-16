<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Add New Character</h2>
    <form action="<?php echo URLROOT; ?>/characters/add" method="POST">
        <label>Name: <input type="text" name="name" required></label><br>
        
        <label>Element: 
            <select name="element">
                <option value="Pyro">Pyro</option>
                <option value="Hydro">Hydro</option>
                <option value="Anemo">Anemo</option>
                <option value="Electro">Electro</option>
                <option value="Dendro">Dendro</option>
                <option value="Cryo">Cryo</option>
                <option value="Geo">Geo</option>
            </select>
        </label><br>

        <label>Weapon: <input type="text" name="weapon" required></label><br>
        <label>Rarity (4 or 5): <input type="number" name="rarity" min="4" max="5" required></label><br>
        <label>Region: <input type="text" name="region" required></label><br>
        <label>Description: <textarea name="description"></textarea></label><br>
        
        <input type="submit" value="Submit">
    </form>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>