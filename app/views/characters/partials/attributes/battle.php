<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="element" class="form-label">Elemen</label>
            <select class="form-select" id="element" name="element" required>
                <option value="" disabled <?= !isset($data['character']['element']) ? 'selected' : ''; ?>>Pilih elemen...</option>
                <?php 
                $elements = ['Anemo', 'Geo', 'Electro', 'Dendro', 'Hydro', 'Pyro', 'Cryo'];
                foreach($elements as $el) : 
                    $selected = (isset($data['character']['element']) && $data['character']['element'] == $el) ? 'selected' : '';
                ?>
                    <option value="<?= $el; ?>" <?= $selected; ?>><?= $el; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="weapon_type" class="form-label">Tipe Senjata</label>
            <select class="form-select" id="weapon_type" name="weapon_type" required>
                <option value="" disabled <?= !isset($data['character']['weapon_type']) ? 'selected' : ''; ?>>Pilih tipe senjata...</option>
                <?php 
                $weapons = ['Sword', 'Claymore', 'Polearm', 'Bow', 'Catalyst'];
                foreach($weapons as $wp) : 
                    $selected = (isset($data['character']['weapon_type']) && $data['character']['weapon_type'] == $wp) ? 'selected' : '';
                ?>
                    <option value="<?= $wp; ?>" <?= $selected; ?>><?= $wp; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>