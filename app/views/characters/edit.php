<div class="container">
    <div style="max-width: 800px; margin: 0 auto; background: var(--bg-secondary); padding: 30px; border-radius: 8px; border: 1px solid var(--border-color);">
        <h2 style="color: var(--text-secondary); margin-bottom: 20px; text-align: center;">Edit Character</h2>

        <form action="<?= BASEURL; ?>/characters/update" method="POST">
            
            <input type="hidden" name="id" value="<?= $data['character']['id']; ?>">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                
                <div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Character Name</label>
                        <input type="text" name="name" value="<?= $data['character']['name']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Element</label>
                        <select name="element" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
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

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Weapon Type</label>
                        <select name="weapon_type" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                            <?php 
                            $weapons = ['Sword', 'Claymore', 'Polearm', 'Bow', 'Catalyst'];
                            foreach ($weapons as $wep) :
                            ?>
                                <option value="<?= $wep; ?>" <?= ($data['character']['weapon_type'] == $wep) ? 'selected' : ''; ?>>
                                    <?= $wep; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Rarity</label>
                        <div style="display: flex; gap: 20px;">
                            <label>
                                <input type="radio" name="rarity" value="4" <?= ($data['character']['rarity'] == 4) ? 'checked' : ''; ?>> 
                                4-Star
                            </label>
                            <label>
                                <input type="radio" name="rarity" value="5" <?= ($data['character']['rarity'] == 5) ? 'checked' : ''; ?>> 
                                5-Star
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                     <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Level (1-90)</label>
                        <input type="number" name="level" min="1" max="90" value="<?= $data['character']['level']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Constellation (C0-C6)</label>
                        <select name="constellation" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                            <?php for($i=0; $i<=6; $i++): ?>
                                <option value="<?= $i; ?>" <?= ($data['character']['constellation'] == $i) ? 'selected' : ''; ?>>
                                    C<?= $i; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Primary Role</label>
                        <input type="text" name="role" value="<?= $data['character']['role']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Image URL (CDN)</label>
                        <input type="url" name="image_url" value="<?= $data['character']['image_url']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                    </div>
                </div>
            </div>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                <label style="display: block; margin-bottom: 10px; color: var(--text-secondary);">Talent Levels (NA / Skill / Burst)</label>
                <div style="display: flex; gap: 15px;">
                    <input type="number" name="talent_na" min="1" max="15" value="<?= $data['character']['talent_na']; ?>" placeholder="NA" style="flex: 1; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                    <input type="number" name="talent_skill" min="1" max="15" value="<?= $data['character']['talent_skill']; ?>" placeholder="Skill" style="flex: 1; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                    <input type="number" name="talent_burst" min="1" max="15" value="<?= $data['character']['talent_burst']; ?>" placeholder="Burst" style="flex: 1; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                </div>
            </div>

            <div style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 5px;">Description / Notes</label>
                <textarea name="description" rows="3" placeholder="Build notes, artifact sets, etc..." style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px; resize: vertical;"><?= $data['character']['description'] ?? ''; ?></textarea>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn-cta" style="width: 100%; border: none; cursor: pointer; font-size: 1rem;">Update Character</button>
                <a href="<?= BASEURL; ?>/characters" style="display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none;">Cancel</a>
            </div>

        </form>
    </div>
</div>