<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <a href="<?php echo URLROOT; ?>/characters" class="back-link">Back to Archive</a>
    <h2>Edit Character: <?php echo $data['data']->name; ?></h2>
    
    <form action="<?php echo URLROOT; ?>/characters/edit/<?php echo $data['data']->id; ?>" method="POST">
        <div class="form-group">
            <label>Name: <input type="text" name="name" value="<?php echo $data['data']->name; ?>" required></label>
        </div>
        <div class="form-group">
            <label>Element: <input type="text" name="element" value="<?php echo $data['data']->element; ?>" required></label>
        </div>
        <div class="form-group">
            <label>Weapon: <input type="text" name="weapon" value="<?php echo $data['data']->weapon; ?>" required></label>
        </div>
        <div class="form-group">
            <label>Level: <input type="number" name="level" min="1" max="90" value="<?php echo $data['data']->level; ?>" required></label>
        </div>
        <div class="form-group">
            <label>Talents: <input type="text" name="talents_level" value="<?php echo $data['data']->talents_level; ?>" required></label>
        </div>
        <div class="form-group">
            <label>Rarity: <input type="number" name="rarity" min="4" max="5" value="<?php echo $data['data']->rarity; ?>" required></label>
        </div>
        <div class="form-group">
            <label>Region: <input type="text" name="region" value="<?php echo $data['data']->region; ?>" required></label>
        </div>
        <input type="submit" value="Update Character" class="btn">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>