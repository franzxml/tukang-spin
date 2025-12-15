<div class="container">
    
    <div class="form-card" style="padding: 0; overflow: hidden;">
        
        <div style="height: 240px; overflow: hidden; position: relative;">
            <img src="<?= BASEURL; ?>/img/home/mizuki-hotspring.jpg" 
                 alt="New Character Banner" 
                 style="width: 100%; height: 100%; object-fit: cover; object-position: center 30%;">
            
            <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 60px; background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.02));"></div>
        </div>

        <div style="padding: 40px;">
            
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
                            <input type="text" name="role" placeholder="Contoh: Off-field DPS" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Elemen</label>
                            <input list="elements_list" name="element" placeholder="Pilih atau ketik..." required>
                            <datalist id="elements_list">
                                <option value="Pyro">
                                <option value="Hydro">
                                <option value="Anemo">
                                <option value="Electro">
                                <option value="Dendro">
                                <option value="Cryo">
                                <option value="Geo">
                            </datalist>
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
                        <input list="weapon_types" name="weapon_type" placeholder="Pilih atau ketik..." required>
                        <datalist id="weapon_types">
                            <option value="Sword">
                            <option value="Claymore">
                            <option value="Polearm">
                            <option value="Bow">
                            <option value="Catalyst">
                        </datalist>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="form-section-title">Build & Equipment</h4>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Senjata (Opsional)</label>
                            <select name="equipped_weapon_id">
                                <option value="">Tidak dipasang</option>
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
                                <option value="">Tidak dipasang</option>
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
                            <div>
                                <select name="art_sands">
                                    <option value="" disabled selected>Sands</option>
                                    <option value="ATK%">ATK%</option>
                                    <option value="HP%">HP%</option>
                                    <option value="DEF%">DEF%</option>
                                    <option value="Energy Recharge">Energy Recharge</option>
                                    <option value="Elemental Mastery">Elemental Mastery</option>
                                </select>
                            </div>
                            
                            <div>
                                <select name="art_goblet">
                                    <option value="" disabled selected>Goblet</option>
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
                                    <option value="Elemental Mastery">Elemental Mastery</option>
                                </select>
                            </div>

                            <div>
                                <select name="art_circlet">
                                    <option value="" disabled selected>Circlet</option>
                                    <option value="Crit Rate">Crit Rate</option>
                                    <option value="Crit DMG">Crit DMG</option>
                                    <option value="Healing Bonus">Healing Bonus</option>
                                    <option value="Elemental Mastery">Elemental Mastery</option>
                                    <option value="ATK%">ATK%</option>
                                    <option value="HP%">HP%</option>
                                </select>
                            </div>
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
                            <label class="form-label">Konstelasi</label>
                            <select name="constellation">
                                <?php for($i=0; $i<=6; $i++): ?>
                                    <option value="<?= $i; ?>">C<?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Level Talenta</label>
                        <div class="form-grid-3">
                            <div>
                                <select name="talent_na">
                                    <option value="" disabled>NA</option>
                                    <?php for($i=1; $i<=13; $i++): ?>
                                        <option value="<?= $i; ?>" <?= ($i==1)?'selected':''; ?>><?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <small style="color: var(--text-secondary); font-size: 0.75rem; margin-top: 4px; display: block; text-align: center;">Normal</small>
                            </div>
                            <div>
                                <select name="talent_skill">
                                    <option value="" disabled>Skill</option>
                                    <?php for($i=1; $i<=13; $i++): ?>
                                        <option value="<?= $i; ?>" <?= ($i==1)?'selected':''; ?>><?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <small style="color: var(--text-secondary); font-size: 0.75rem; margin-top: 4px; display: block; text-align: center;">Skill</small>
                            </div>
                            <div>
                                <select name="talent_burst">
                                    <option value="" disabled>Burst</option>
                                    <?php for($i=1; $i<=13; $i++): ?>
                                        <option value="<?= $i; ?>" <?= ($i==1)?'selected':''; ?>><?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <small style="color: var(--text-secondary); font-size: 0.75rem; margin-top: 4px; display: block; text-align: center;">Burst</small>
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
</div>