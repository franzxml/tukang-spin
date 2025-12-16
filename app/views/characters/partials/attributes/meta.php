<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="rarity" class="form-label">Rarity (Bintang)</label>
            <select class="form-select" id="rarity" name="rarity" required>
                <?php 
                $rarityVal = isset($data['character']['rarity']) ? $data['character']['rarity'] : '';
                ?>
                <option value="4" <?= $rarityVal == '4' ? 'selected' : ''; ?>>4-Star</option>
                <option value="5" <?= $rarityVal == '5' ? 'selected' : ''; ?>>5-Star</option>
            </select>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="region" class="form-label">Region</label>
            <input type="text" class="form-control" id="region" name="region" 
                   value="<?= isset($data['character']['region']) ? $data['character']['region'] : ''; ?>"
                   placeholder="Isi region..." required autocomplete="off">
        </div>
    </div>
</div>