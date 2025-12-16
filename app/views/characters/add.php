<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <a href="<?php echo URLROOT; ?>/characters" class="back-link">Back to Archive</a>
    <h2>Add New Character</h2>
    
    <form action="<?php echo URLROOT; ?>/characters/add" method="POST">
        <div class="form-group">
            <label>Name: <input type="text" name="name" required></label>
        </div>
        <div class="form-group">
            <label>Element: <input type="text" name="element" required></label>
        </div>
        <div class="form-group">
            <label>Weapon: <input type="text" name="weapon" required></label>
        </div>
        <div class="form-group">
            <label>Level (1-90): <input type="number" name="level" min="1" max="90" value="1" required></label>
        </div>
        <div class="form-group">
            <label>Talents (e.g., 8/8/8): <input type="text" name="talents_level" placeholder="1/1/1" required></label>
        </div>
        <div class="form-group">
            <label>Rarity (4 or 5): <input type="number" name="rarity" min="4" max="5" required></label>
        </div>
        <div class="form-group">
            <label>Region: <input type="text" name="region" required></label>
        </div>
        <input type="submit" value="Submit" class="btn">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>