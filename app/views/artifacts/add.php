<div class="container">
    <div style="max-width: 600px; margin: 0 auto; background: var(--bg-secondary); padding: 30px; border-radius: 8px; border: 1px solid var(--border-color);">
        <h2 style="color: var(--text-secondary); margin-bottom: 20px; text-align: center;">Tambah Set Artefak</h2>
        <form action="<?= BASEURL; ?>/artifacts/store" method="POST" autocomplete="off">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Nama Set</label>
                <input type="text" name="name" placeholder="Contoh: Emblem of Severed Fate" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Efek Bonus (2pc / 4pc)</label>
                <textarea name="bonuses" rows="3" placeholder="2pc: ER +20%..." style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;"></textarea>
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Link Gambar</label>
                <input type="url" name="image_url" placeholder="https://..." required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
            </div>
            <div style="display: flex; gap: 15px;">
                <button type="submit" class="btn-cta" style="flex: 2;">Simpan</button>
                <a href="<?= BASEURL; ?>/artifacts" class="btn-cta" style="flex: 1; background-color: var(--bg-primary); border: 1px solid var(--border-color); color: #888; text-align: center;">Batal</a>
            </div>
        </form>
    </div>
</div>  