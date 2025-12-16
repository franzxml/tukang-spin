<div class="form-group">
    <label for="name" class="form-label">Nama Karakter</label>
    <input type="text" class="form-control" id="name" name="name" 
           value="<?= isset($data['character']['name']) ? $data['character']['name'] : ''; ?>" 
           placeholder="Isi nama karakter..." required autocomplete="off">
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