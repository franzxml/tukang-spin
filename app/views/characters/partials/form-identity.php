<div class="form-group">
    <label for="name" class="form-label">Nama Karakter</label>
    <input type="text" class="form-control" id="name" name="name" 
           value="<?= isset($data['character']['name']) ? $data['character']['name'] : ''; ?>" 
           placeholder="Isi nama karakter..." required autocomplete="off">
</div>

<div class="form-group">
    <label for="description" class="form-label">Catatan</label>
    <textarea class="form-control font-sf" id="description" name="description" placeholder="Isi catatan karakter..." rows="3"><?= isset($data['character']['description']) ? $data['character']['description'] : ''; ?></textarea>
</div>

<div class="form-group">
    <label for="image_url" class="form-label">Gambar Karakter (URL)</label>
    <input type="text" class="form-control" id="image_url" name="image_url" 
           value="<?= isset($data['character']['image_url']) ? $data['character']['image_url'] : ''; ?>"
           placeholder="Tempel tautan gambar (https://...)" autocomplete="off">
</div>