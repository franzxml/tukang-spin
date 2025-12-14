<div class="container">
    <div style="max-width: 600px; margin: 0 auto; background: var(--bg-secondary); padding: 30px; border-radius: 8px; border: 1px solid var(--border-color);">
        <h2 style="color: var(--text-secondary); margin-bottom: 20px; text-align: center;">Forge New Weapon</h2>

        <form action="<?= BASEURL; ?>/weapons/store" method="POST">
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Weapon Name</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 5px;">Type</label>
                    <select name="type" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                        <option value="Sword">Sword</option>
                        <option value="Claymore">Claymore</option>
                        <option value="Polearm">Polearm</option>
                        <option value="Bow">Bow</option>
                        <option value="Catalyst">Catalyst</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 5px;">Rarity</label>
                    <select name="rarity" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                        <option value="5">5-Star</option>
                        <option value="4">4-Star</option>
                        <option value="3">3-Star</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 5px;">Base ATK (Lv90)</label>
                    <input type="number" name="base_atk" placeholder="e.g. 674" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 5px;">Sub-Stat (Value)</label>
                    <input type="text" name="sub_stat" placeholder="e.g. Crit DMG 44.1%" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Image URL</label>
                <input type="url" name="image_url" placeholder="https://..." required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Passive Description</label>
                <textarea name="description" rows="2" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;"></textarea>
            </div>

            <button type="submit" class="btn-cta" style="width: 100%; border: none; cursor: pointer; font-size: 1rem;">Forge Weapon</button>
            <a href="<?= BASEURL; ?>/weapons" style="display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none;">Cancel</a>

        </form>
    </div>
</div>