<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <h2>Edit Character: <?php echo $data['char']->name; ?></h2>
    <?php $c = $data['char']; ?>
    
    <form action="<?php echo URLROOT; ?>/edit/update/<?php echo $c->id; ?>" method="POST">
        <label>Name: <input type="text" name="name" value="<?php echo $c->name; ?>" required></label><br>
        
        <label>Element: <select name="element">
            <?php 
            $els = ['Pyro','Hydro','Anemo','Electro','Dendro','Cryo','Geo'];
            foreach($els as $e) echo "<option value='$e' ".($c->element==$e?'selected':'').">$e</option>"; 
            ?>
        </select></label><br>

        <label>Weapon: <input type="text" name="weapon" value="<?php echo $c->weapon; ?>" required></label><br>
        <label>Rarity: <input type="number" name="rarity" min="4" max="5" value="<?php echo $c->rarity; ?>" required></label><br>
        <label>Region: <input type="text" name="region" value="<?php echo $c->region; ?>" required></label><br>
        <textarea name="description"><?php echo $c->description; ?></textarea><br>
        
        <input type="submit" value="Update Character" class="btn">
    </form>
</div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>