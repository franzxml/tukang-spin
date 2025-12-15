<div class="container">
    
    <div class="form-card">
        <div class="form-header">
            <h2>Karakter Baru</h2>
            <p style="color: var(--text-secondary); margin-top: 5px;">Lengkapi data untuk menambahkan karakter ke database.</p>
        </div>

        <form action="<?= BASEURL; ?>/characters/store" method="POST" autocomplete="off">
            
            <div class="form-section">
                <h4 class="form-section-title">Identitas Utama</h4>
                
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Karakter</label>
                        <input type="text" name="name" placeholder="Contoh: Furina" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role Utama</label>
                        <input type="text" name="role" placeholder="Contoh: Off-field DPS / Buffer" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Elemen</label>
                        <select name="element" required>
                            <option value="" disabled selected>Pilih Elemen...</option>
                            <option value="Pyro">Pyro (Api)</option>
                            <option value="Hydro">Hydro (Air)</option>
                            <option value="Anemo">Anemo (Angin)</option>
                            <option value="Electro">Electro (Listrik)</option>
                            <option value="Dendro">Dendro (Tumbuhan)</option>
                            <option value="Cryo">Cryo (Es)</option>
                            <option value="Geo">Geo (Tanah)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tingkat Kelangkaan</label>
                        <div class="segmented-control">
                            <input type="radio" id="rarity-5" name="rarity" value="5" checked>
                            <label for="rarity-5" class="segmented-label">
                                <span style="color: #FFD700;">★</span> Bintang 5
                            </label>

                            <input type="radio" id="rarity-4" name="rarity" value="4">
                            <label for="rarity-4" class="segmented-label">
                                <span style="color: #A06CD5;">★</span> Bintang 4
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipe Senjata</label>
                    <select name="weapon_type" required>
                        <option value="" disabled selected>Pilih Senjata...</option>
                        <option value="Sword">Sword (Pedang)</option>
                        <option value="Claymore">Claymore (Pedang Besar)</option>
                        <option value="Polearm">Polearm (Tombak)</option>
                        <option value="Bow">Bow (Panah)</option>
                        <option value="Catalyst">Catalyst (Buku)</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <h4 class="form-section-title">Build & Equipment</h4>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Senjata (Opsional)</label>
                        <select name="equipped_weapon_id">
                            <option value="">-- Tidak Dipasang --</option>
                            <?php foreach ($data['weapons'] as $wep) : ?>
                                <option value="<?= $wep['id']; ?>">
                                    <?= $wep['name']; ?> (<?= $wep['rarity']; ?>★)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Set Artefak (Opsional)</label>
                        <select name="equipped_artifact_set_id">
                            <option value="">-- Tidak Dipasang --</option>
                            <?php foreach ($data['artifacts'] as $art) : ?>
                                <option value="<?= $art['id']; ?>">
                                    <?= $art['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Statistik Utama Artefak</label>
                    <div class="form-grid-3">
                        <select name="art_sands">
                            <option value="" disabled selected>Sands (Jam)</option>
                            <option value="ATK%">ATK%</option>
                            <option value="HP%">HP%</option>
                            <option value="DEF%">DEF%</option>
                            <option value="ER">Energy Recharge</option>
                            <option value="EM">Elemental Mastery</option>
                        </select>
                        <select name="art_goblet">
                            <option value="" disabled selected>Goblet (Gelas)</option>
                            <option value="Pyro DMG">Pyro DMG</option>
                            <option value="Hydro DMG">Hydro DMG</option>
                            <option value="Anemo DMG">Anemo DMG</option>
                            <option value="Electro DMG">Electro DMG</option>
                            <option value="Dendro DMG">Dendro DMG</option>
                            <option value="Cryo DMG">Cryo DMG</option>
                            <option value="Geo DMG">Geo DMG</option>
                            <option value="Physical DMG">Physical DMG</option>
                            <option value="ATK%">ATK%</option>
                            <option value="HP%">HP%</option>
                            <option value="EM">EM</option>
                        </select>
                        <select name="art_circlet">
                            <option value="" disabled selected>Circlet (Topi)</option>
                            <option value="Crit Rate">Crit Rate</option>
                            <option value="Crit DMG">Crit DMG</option>
                            <option value="Healing Bonus">Healing Bonus</option>
                            <option value="EM">EM</option>
                            <option value="ATK%">ATK%</option>
                            <option value="HP%">HP%</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h4 class="form-section-title">Progres Karakter</h4>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Level Karakter</label>
                        <input type="number" name="level" value="90" min="1" max="90">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konstelasi (C0-C6)</label>
                        <input type="number" name="constellation" value="0" min="0" max="6">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Level Talenta</label>
                    <div class="form-grid-3">
                        <div>
                            <input type="number" name="talent_na" value="1" min="1" max="10" placeholder="Normal">
                            <small style="color: var(--text-secondary); font-size: 0.75rem; margin-top: 4px; display: block; text-align: center;">Normal Attack</small>
                        </div>
                        <div>
                            <input type="number" name="talent_skill" value="1" min="1" max="13" placeholder="Skill">
                            <small style="color: var(--text-secondary); font-size: 0.75rem; margin-top: 4px; display: block; text-align: center;">Elem. Skill</small>
                        </div>
                        <div>
                            <input type="number" name="talent_burst" value="1" min="1" max="13" placeholder="Burst">
                            <small style="color: var(--text-secondary); font-size: 0.75rem; margin-top: 4px; display: block; text-align: center;">Elem. Burst</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h4 class="form-section-title">Visual & Lainnya</h4>

                <div class="form-group">
                    <label class="form-label">URL Gambar (Icon/Avatar)</label>
                    <input type="url" name="image_url" placeholder="https://..." required>
                </div>

                <div class="form-group">
                    <label class="form-label">URL Namecard (Banner)</label>
                    <input type="url" name="namecard_url" placeholder="https://..." required>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan Tambahan</label>
                    <textarea name="description" rows="3" placeholder="Tulis catatan build atau rotasi tim di sini..."></textarea>
                </div>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 20px;">
                <button type="submit" class="btn-cta" style="flex: 2;">Simpan Karakter</button>
                <a href="<?= BASEURL; ?>/characters" class="btn-cta btn-secondary" style="flex: 1; text-align: center;">Batal</a>
            </div>

        </form>
    </div>
</div>