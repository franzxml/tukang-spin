<div class="container">
    <div style="max-width: 800px; margin: 0 auto; background: var(--bg-card); padding: 40px; border-radius: 20px; border: 1px solid var(--border-subtle); box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <h2 style="color: var(--text-primary); margin-bottom: 30px; text-align: center;">Tambah Karakter</h2>

        <form action="<?= BASEURL; ?>/characters/store" method="POST" autocomplete="off">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Nama Karakter</label>
                    <input type="text" name="name" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Role Utama</label>
                    <input type="text" name="role" placeholder="e.g. Main DPS" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Elemen</label>
                    <select name="element" required>
                        <option value="Pyro">Pyro</option>
                        <option value="Hydro">Hydro</option>
                        <option value="Anemo">Anemo</option>
                        <option value="Electro">Electro</option>
                        <option value="Dendro">Dendro</option>
                        <option value="Cryo">Cryo</option>
                        <option value="Geo">Geo</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Tipe Senjata</label>
                    <select name="weapon_type" required>
                        <option value="Sword">Sword</option>
                        <option value="Claymore">Claymore</option>
                        <option value="Polearm">Polearm</option>
                        <option value="Bow">Bow</option>
                        <option value="Catalyst">Catalyst</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Senjata (Opsional)</label>
                    <select name="equipped_weapon_id">
                        <option value="">-- Kosong --</option>
                        <?php foreach ($data['weapons'] as $wep) : ?>
                            <option value="<?= $wep['id']; ?>">
                                <?= $wep['name']; ?> (<?= $wep['rarity']; ?>★)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Set Artefak (Opsional)</label>
                    <select name="equipped_artifact_set_id">
                        <option value="">-- Kosong --</option>
                        <?php foreach ($data['artifacts'] as $art) : ?>
                            <option value="<?= $art['id']; ?>">
                                <?= $art['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Statistik Utama Artefak</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                <select name="art_sands"><option value="">(Sands)</option><option value="ATK%">ATK%</option><option value="ER">ER</option><option value="EM">EM</option><option value="HP%">HP%</option><option value="DEF%">DEF%</option></select>
                <select name="art_goblet"><option value="">(Goblet)</option><option value="Pyro DMG">Pyro DMG</option><option value="Hydro DMG">Hydro DMG</option><option value="Anemo DMG">Anemo DMG</option><option value="Electro DMG">Electro DMG</option><option value="Dendro DMG">Dendro DMG</option><option value="Cryo DMG">Cryo DMG</option><option value="Geo DMG">Geo DMG</option><option value="Physical DMG">Physical DMG</option><option value="ATK%">ATK%</option><option value="HP%">HP%</option><option value="EM">EM</option></select>
                <select name="art_circlet"><option value="">(Circlet)</option><option value="Crit Rate">Crit Rate</option><option value="Crit DMG">Crit DMG</option><option value="Healing Bonus">Healing Bonus</option><option value="EM">EM</option><option value="ATK%">ATK%</option><option value="HP%">HP%</option></select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div><label style="display: block; margin-bottom: 8px; font-weight: 500;">Level</label><input type="number" name="level" value="90"></div>
                <div><label style="display: block; margin-bottom: 8px; font-weight: 500;">Konstelasi</label><input type="number" name="constellation" value="0"></div>
                <div><label style="display: block; margin-bottom: 8px; font-weight: 500;">Rarity</label><div style="padding: 10px;"><label><input type="radio" name="rarity" value="5" checked> 5★</label> &nbsp; <label><input type="radio" name="rarity" value="4"> 4★</label></div></div>
            </div>

            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Talenta (NA / Skill / Burst)</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <input type="number" name="talent_na" value="1" placeholder="NA">
                <input type="number" name="talent_skill" value="1" placeholder="Skill">
                <input type="number" name="talent_burst" value="1" placeholder="Burst">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Link Gambar (Icon)</label>
                <input type="url" name="image_url" placeholder="https://..." required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Link Namecard (Banner)</label>
                <input type="url" name="namecard_url" placeholder="https://..." required>
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Catatan</label>
                <textarea name="description" rows="3"></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <button type="submit" class="btn-cta" style="flex: 2;">Simpan</button>
                <a href="<?= BASEURL; ?>/characters" class="btn-cta" style="flex: 1; background-color: var(--bg-panel); color: var(--text-primary); text-align: center;">Batal</a>
            </div>

        </form>
    </div>
</div>