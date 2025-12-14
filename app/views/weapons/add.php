<div class="container">
    <div style="max-width: 700px; margin: 0 auto; background: var(--bg-secondary); padding: 30px; border-radius: 8px; border: 1px solid var(--border-color);">
        <h2 style="color: var(--text-secondary); margin-bottom: 20px; text-align: center;">Tambah Senjata Baru</h2>

        <form action="<?= BASEURL; ?>/weapons/store" method="POST">
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Nama Senjata</label>
                <input type="text" name="name" placeholder="Contoh: Staff of Homa" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 5px;">Tipe Senjata</label>
                    <select name="type" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <option value="Sword">Sword (Pedang)</option>
                        <option value="Claymore">Claymore</option>
                        <option value="Polearm">Polearm (Tombak)</option>
                        <option value="Bow">Bow (Panah)</option>
                        <option value="Catalyst">Catalyst</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 5px;">Tingkat (Rarity)</label>
                    <select name="rarity" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <option value="5">Bintang 5</option>
                        <option value="4">Bintang 4</option>
                        <option value="3">Bintang 3</option>
                    </select>
                </div>
            </div>

            <label style="display: block; margin-bottom: 5px;">Statistik (Lv. 90)</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <input type="number" name="base_atk" placeholder="Base ATK" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                    <small style="color: #666; font-size: 0.8rem;">Base Attack</small>
                </div>
                
                <div>
                    <select name="sub_stat_type" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <option value="Crit DMG">Crit DMG</option>
                        <option value="Crit Rate">Crit Rate</option>
                        <option value="ATK%">ATK%</option>
                        <option value="HP%">HP%</option>
                        <option value="DEF%">DEF%</option>
                        <option value="Energy Recharge">Energy Recharge</option>
                        <option value="Elemental Mastery">Elemental Mastery</option>
                        <option value="Physical DMG">Physical DMG</option>
                    </select>
                    <small style="color: #666; font-size: 0.8rem;">Tipe Sub-Stat</small>
                </div>

                <div>
                    <input type="text" name="sub_stat_value" placeholder="Contoh: 66.2%" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                    <small style="color: #666; font-size: 0.8rem;">Nilai Sub-Stat</small>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Nama Efek Pasif</label>
                <input type="text" name="passive_name" placeholder="Contoh: Reckless Cinnabar" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Deskripsi Pasif</label>
                <textarea name="description" rows="3" placeholder="Jelaskan efek pasif senjata..." style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;"></textarea>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Link Gambar (URL)</label>
                <input type="url" name="image_url" placeholder="https://..." required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
            </div>

            <div style="display: flex; gap: 15px;">
                <button type="submit" class="btn-cta" style="flex: 2;">Simpan Senjata</button>
                <a href="<?= BASEURL; ?>/weapons" class="btn-cta" style="flex: 1; background-color: var(--bg-primary); border: 1px solid var(--border-color); color: #888; text-align: center;">Batal</a>
            </div>

        </form>
    </div>
</div>