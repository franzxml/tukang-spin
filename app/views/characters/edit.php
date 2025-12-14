<div class="container">
    <div style="max-width: 600px; margin: 0 auto; background: var(--bg-secondary); padding: 30px; border-radius: 8px; border: 1px solid var(--border-color);">
        <h2 style="color: var(--text-secondary); margin-bottom: 20px; text-align: center;">Edit Character</h2>

        <form action="<?= BASEURL; ?>/characters/update" method="POST">
            
            <input type="hidden" name="id" value="<?= $data['character']['id']; ?>">

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Character Name</label>
                <input type="text" name="name" value="<?= $data['character']['name']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div style="flex: 1;">
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
                <div style="flex: 1;">
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

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Primary Role</label>
                <input type="text" name="role" value="<?= $data['character']['role']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Image URL (Direct Link)</label>
                <input type="url" name="image_url" value="<?= $data['character']['image_url']; ?>" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <button type="submit" class="btn-cta" style="width: 100%; border: none; cursor: pointer; font-size: 1rem;">Update Character</button>
            <a href="<?= BASEURL; ?>/characters" style="display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none;">Cancel</a>

        </form>
    </div>
</div>