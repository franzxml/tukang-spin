<div class="container">
    <div style="max-width: 800px; margin: 0 auto; background: var(--bg-card); padding: 40px; border-radius: 20px; border: 1px solid var(--border-subtle); box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <h2 style="color: var(--text-primary); margin-bottom: 30px; text-align: center;">Edit Karakter</h2>

        <form action="<?= BASEURL; ?>/characters/update" method="POST" autocomplete="off">
            
            <input type="hidden" name="id" value="<?= $data['character']['id']; ?>">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Nama Karakter</label>
                    <input type="text" name="name" value="<?= $data['character']['name']; ?>" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Role Utama</label>
                    <input type="text" name="role" value="<?= $data['character']['role']; ?>" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Elemen</label>
                    <select name="element" required>
                        <?php 
                        $elements = ['Pyro', 'Hydro', 'Anemo', 'Electro', 'Dendro', 'Cryo', 'Geo'];
                        foreach ($elements as $elm) : 
                        ?>
                            <option value="<?= $elm; ?>" <?= ($data['character']['element'] == $elm) ? 'selected' : ''; ?>>
                                <?= $elm; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Tipe Senjata</label>
                    <select name="weapon_type" required>
                        <?php 
                        $types = ['Sword', 'Claymore', 'Polearm', 'Bow', 'Catalyst'];
                        foreach ($types as $type) : 
                        ?>
                            <option value="<?= $type; ?>" <?= ($data['character']['weapon_type'] == $type) ? 'selected' : ''; ?>>
                                <?= $type; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Senjata (Opsional)</label>
                    <select name="equipped_weapon_id">
                        <option value="">-- Kosong --</option>
                        <?php foreach ($data['weapons'] as $wep) : ?>
                            <option value="<?= $wep['id']; ?>" <?= ($data['character']['equipped_weapon_id'] == $wep['id']) ? 'selected' : ''; ?>>
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
                            <option value="<?= $art['id']; ?>" <?= ($data['character']['equipped_artifact_set_id'] == $art['id']) ? 'selected' : ''; ?>>
                                <?= $art['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Statistik Utama Artefak</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                <select name="art_sands">
                    <option value="">(Sands)</option>
                    <?php foreach(['ATK%', 'ER', 'EM', 'HP%', 'DEF%'] as $stat): ?>
                        <option value="<?= $stat; ?>" <?= ($data['character']['art_sands'] == $stat) ? 'selected' : ''; ?>><?= $stat; ?></option>
                    <?php endforeach; ?>
                </select>
                
                <select name="art_goblet">
                    <option value="">(Goblet)</option>
                    <?php foreach(['Pyro DMG', 'Hydro DMG', 'Anemo DMG', 'Electro DMG', 'Dendro DMG', 'Cryo DMG', 'Geo DMG', 'Physical DMG', 'ATK%', 'HP%', 'EM'] as $stat): ?>
                        <option value="<?= $stat; ?>" <?= ($data['character']['art_goblet'] == $stat) ? 'selected' : ''; ?>><?= $stat; ?></option>
                    <?php endforeach; ?>
                </select>
                
                <select name="art_circlet">
                    <option value="">(Circlet)</option>
                    <?php foreach(['Crit Rate', 'Crit DMG', 'Healing Bonus', 'EM', 'ATK%', 'HP%'] as $stat): ?>
                        <option value="<?= $stat; ?>" <?= ($data['character']['art_circlet'] == $stat) ? 'selected' : ''; ?>><?= $stat; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Level</label>
                    <input type="number" name="level" value="<?= $data['character']['level']; ?>" min="1" max="90">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Konstelasi</label>
                    <input type="number" name="constellation" value="<?= $data['character']['constellation']; ?>" min="0" max="6">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">Rarity</label>
                    <div style="padding: 10px;">
                        <label style="margin-right: 15px;">
                            <input type="radio" name="rarity" value="5" <?= ($data['character']['rarity'] == 5) ? 'checked' : ''; ?>> 5★
                        </label>
                        <label>
                            <input type="radio" name="rarity" value="4" <?= ($data['character']['rarity'] == 4) ? 'checked' : ''; ?>> 4★
                        </label>
                    </div>
                </div>
            </div>

            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Talenta (NA / Skill / Burst)</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <input type="number" name="talent_na" value="<?= $data['character']['talent_na']; ?>" placeholder="NA">
                <input type="number" name="talent_skill" value="<?= $data['character']['talent_skill']; ?>" placeholder="Skill">
                <input type="number" name="talent_burst" value="<?= $data['character']['talent_burst']; ?>" placeholder="Burst">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Link Gambar (Icon)</label>
                <input type="url" name="image_url" value="<?= $data['character']['image_url']; ?>" placeholder="https://..." required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Link Namecard (Banner)</label>
                <input type="url" name="namecard_url" value="<?= $data['character']['namecard_url']; ?>" placeholder="https://...">
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Catatan</label>
                <textarea name="description" rows="3" style="resize: vertical;"><?= $data['character']['description']; ?></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <button type="submit" class="btn-cta" style="flex: 2;">Simpan Perubahan</button>
                <a href="<?= BASEURL; ?>/characters/detail/<?= $data['character']['id']; ?>" class="btn-cta" style="flex: 1; background-color: var(--bg-panel); color: var(--text-primary); text-align: center;">Batal</a>
            </div>

        </form>
    </div>
</div>