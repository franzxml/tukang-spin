<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <a href="<?php echo URLROOT; ?>/characters" class="back-link">Back to Archive</a>
    <h2>Add New Character</h2>
    
    <form action="<?php echo URLROOT; ?>/characters/add" method="POST">
        <div class="form-group">
            <label>Name: 
                <input type="text" name="name" required autocomplete="off">
            </label>
        </div>
        
        <div class="form-group">
            <label>Weapon Type:</label>
            <select name="weapon" required>
                <option value="Sword">Sword</option>
                <option value="Polearm">Polearm</option>
                <option value="Claymore">Claymore</option>
                <option value="Bow">Bow</option>
                <option value="Catalyst">Catalyst</option>
            </select>
        </div>

        <div class="form-group">
            <label>Level (1-90): 
                <input type="number" name="level" min="1" max="90" value="1" required>
            </label>
        </div>

        <div class="form-group">
            <label>Talent Levels (NA / Skill / Burst):</label>
            <div style="display: flex; gap: 10px;">
                <select name="talent_na" required>
                    <?php for($i=1; $i<=13; $i++) echo "<option value='$i'>Normal: $i</option>"; ?>
                </select>
                <select name="talent_es" required>
                    <?php for($i=1; $i<=13; $i++) echo "<option value='$i'>Skill: $i</option>"; ?>
                </select>
                <select name="talent_eb" required>
                    <?php for($i=1; $i<=13; $i++) echo "<option value='$i'>Burst: $i</option>"; ?>
                </select>
            </div>
        </div>

        <input type="submit" value="Submit" class="btn">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>