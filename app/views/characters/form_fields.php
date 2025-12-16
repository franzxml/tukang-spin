<div class="form-group">
    <label for="name" class="form-label">Nama Karakter</label>
    <input type="text" class="form-control" id="name" name="name" 
           value="<?= isset($data['character']['name']) ? $data['character']['name'] : ''; ?>" 
           placeholder="Isi nama karakter..." required autocomplete="off">
</div>

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

<div class="form-group">
    <label for="weapon_id" class="form-label">Rekomendasi Senjata</label>
    <select class="form-select" id="weapon_id" name="weapon_id">
        <option value="" <?= !isset($data['character']['weapon_id']) ? 'selected' : ''; ?>>Pilih senjata...</option>
        <?php foreach ($data['weapons'] as $weapon) : 
             $selected = (isset($data['character']['weapon_id']) && $data['character']['weapon_id'] == $weapon['id']) ? 'selected' : '';
        ?>
            <option value="<?= $weapon['id']; ?>" <?= $selected; ?>><?= $weapon['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="artifact_id" class="form-label">Rekomendasi Artefak</label>
    <select class="form-select" id="artifact_id" name="artifact_id">
        <option value="" <?= !isset($data['character']['artifact_id']) ? 'selected' : ''; ?>>Pilih artefak...</option>
        <?php foreach ($data['artifacts'] as $artifact) : 
             $selected = (isset($data['character']['artifact_id']) && $data['character']['artifact_id'] == $artifact['id']) ? 'selected' : '';
        ?>
            <option value="<?= $artifact['id']; ?>" <?= $selected; ?>><?= $artifact['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea class="form-control" id="description" name="description" placeholder="Isi deskripsi karakter..." rows="3"><?= isset($data['character']['description']) ? $data['character']['description'] : ''; ?></textarea>
</div>

<div class="form-group">
    <label for="image" class="form-label">Gambar Karakter</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
    <?php if(isset($data['character']['image_url'])): ?>
        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
    <?php endif; ?>
</div>