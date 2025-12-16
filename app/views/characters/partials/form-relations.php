<div class="form-group">
    <label for="weapon_id" class="form-label">Senjata</label>
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
    <label for="artifact_id" class="form-label">Artefak</label>
    <select class="form-select" id="artifact_id" name="artifact_id">
        <option value="" <?= !isset($data['character']['artifact_id']) ? 'selected' : ''; ?>>Pilih artefak...</option>
        <?php foreach ($data['artifacts'] as $artifact) : 
             $selected = (isset($data['character']['artifact_id']) && $data['character']['artifact_id'] == $artifact['id']) ? 'selected' : '';
        ?>
            <option value="<?= $artifact['id']; ?>" <?= $selected; ?>><?= $artifact['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>