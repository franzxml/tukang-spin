<div class="row">
    <div class="col-md-12"> <div class="form-group">
            <label for="rarity" class="form-label">Rarity</label>
            <select class="form-select" id="rarity" name="rarity" required>
                <?php 
                $rarityVal = isset($data['character']['rarity']) ? $data['character']['rarity'] : '';
                ?>
                <option value="4" <?= $rarityVal == '4' ? 'selected' : ''; ?>>4-Star</option>
                <option value="5" <?= $rarityVal == '5' ? 'selected' : ''; ?>>5-Star</option>
            </select>
        </div>
    </div>
    
    </div>