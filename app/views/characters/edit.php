<div class="container">
    <div style="max-width: 800px; margin: 0 auto; background: var(--bg-secondary); padding: 30px; border-radius: 8px; border: 1px solid var(--border-color);">
        <h2 style="color: var(--text-secondary); margin-bottom: 20px; text-align: center;">Edit Karakter</h2>

        <form action="<?= BASEURL; ?>/characters/update" method="POST" autocomplete="off">
            
            <input type="hidden" name="id" value="<?= $data['character']['id']; ?>">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px;">Nama Karakter</label>
                    <input type="text" name="name" value="<?= $data['character']['name']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px;">Role Utama</label>
                    <input type="text" name="role" value="<?= $data['character']['role']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px;">Elemen</label>
                    <select name="element" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <?php foreach (['Pyro', 'Hydro', 'Anemo', 'Electro', 'Dendro', 'Cryo', 'Geo'] as $elm) : ?>
                            <option value="<?= $elm; ?>" <?= ($data['character']['element'] == $elm) ? 'selected' : ''; ?>><?= $elm; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px;">Tipe Senjata</label>
                    <select name="weapon_type" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <?php foreach (['Sword', 'Claymore', 'Polearm', 'Bow', 'Catalyst'] as $wep) : ?>
                            <option value="<?= $wep; ?>" <?= ($data['character']['weapon_type'] == $wep) ? 'selected' : ''; ?>><?= $wep; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div style="background: rgba(78, 124, 255, 0.05); padding: 15px; border-radius: 6px; border: 1px solid var(--border-color);">
                    <label style="display: block; margin-bottom: 5px; color: var(--accent-color); font-weight: bold;">Senjata</label>
                    <select name="equipped_weapon_id" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <option value="">-- Kosong --</option>
                        <?php foreach ($data['weapons'] as $wep) : ?>
                            <option value="<?= $wep['id']; ?>" <?= ($data['character']['equipped_weapon_id'] == $wep['id']) ? 'selected' : ''; ?>>
                                <?= $wep['name']; ?> (<?= $wep['rarity']; ?>★)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="background: rgba(211, 188, 142, 0.05); padding: 15px; border-radius: 6px; border: 1px solid var(--border-color);">
                    <label style="display: block; margin-bottom: 5px; color: var(--text-secondary); font-weight: bold;">Set Artefak</label>
                    <select name="equipped_artifact_set_id" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <option value="">-- Kosong --</option>
                        <?php foreach ($data['artifacts'] as $art) : ?>
                            <option value="<?= $art['id']; ?>" <?= ($data['character']['equipped_artifact_set_id'] == $art['id']) ? 'selected' : ''; ?>>
                                <?= $art['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label style="display: block; margin-bottom: 5px;">Statistik Utama Artefak</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                <div>
                    <select name="art_sands" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <option value="">(Sands)</option>
                        <?php foreach(['ATK%', 'ER', 'EM', 'HP%', 'DEF%'] as $stat): ?>
                            <option value="<?= $stat; ?>" <?= ($data['character']['art_sands'] == $stat) ? 'selected' : ''; ?>><?= $stat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <select name="art_goblet" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <option value="">(Goblet)</option>
                        <?php foreach(['Pyro DMG', 'Hydro DMG', 'Anemo DMG', 'Electro DMG', 'Dendro DMG', 'Cryo DMG', 'Geo DMG', 'Physical DMG', 'ATK%', 'HP%', 'EM'] as $stat): ?>
                            <option value="<?= $stat; ?>" <?= ($data['character']['art_goblet'] == $stat) ? 'selected' : ''; ?>><?= $stat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <select name="art_circlet" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                        <option value="">(Circlet)</option>
                        <?php foreach(['Crit Rate', 'Crit DMG', 'Healing Bonus', 'EM', 'ATK%', 'HP%'] as $stat): ?>
                            <option value="<?= $stat; ?>" <?= ($data['character']['art_circlet'] == $stat) ? 'selected' : ''; ?>><?= $stat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px;">Level</label>
                    <input type="number" name="level" value="<?= $data['character']['level']; ?>" min="1" max="90" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px;">Konstelasi</label>
                    <input type="number" name="constellation" value="<?= $data['character']['constellation']; ?>" min="0" max="6" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px;">Rarity</label>
                    <div style="display: flex; gap: 15px; align-items: center; height: 42px;">
                        <label><input type="radio" name="rarity" value="4" <?= ($data['character']['rarity'] == 4) ? 'checked' : ''; ?>> 4★</label>
                        <label><input type="radio" name="rarity" value="5" <?= ($data['character']['rarity'] == 5) ? 'checked' : ''; ?>> 5★</label>
                    </div>
                </div>
            </div>

            <label style="display: block; margin-bottom: 5px;">Talenta (NA / Skill / Burst)</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                <input type="number" name="talent_na" value="<?= $data['character']['talent_na']; ?>" min="1" max="10" placeholder="NA" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                <input type="number" name="talent_skill" value="<?= $data['character']['talent_skill']; ?>" min="1" max="13" placeholder="Skill" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
                <input type="number" name="talent_burst" value="<?= $data['character']['talent_burst']; ?>" min="1" max="13" placeholder="Burst" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Link Gambar</label>
                <input type="url" name="image_url" value="<?= $data['character']['image_url']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Catatan / Deskripsi</label>
                <textarea name="description" rows="3" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 6px; resize: vertical;"><?= $data['character']['description']; ?></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <button type="submit" class="btn-cta" style="flex: 2;">Simpan Perubahan</button>
                <a href="<?= BASEURL; ?>/characters" class="btn-cta" style="flex: 1; background-color: var(--bg-primary); border: 1px solid var(--border-color); color: #888; text-align: center;">Batal</a>
            </div>

        </form>
    </div>
</div>