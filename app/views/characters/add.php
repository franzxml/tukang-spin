<div class="container">
    <div style="max-width: 600px; margin: 0 auto; background: var(--bg-secondary); padding: 30px; border-radius: 8px; border: 1px solid var(--border-color);">
        <h2 style="color: var(--text-secondary); margin-bottom: 20px; text-align: center;">Add New Character</h2>

        <form action="<?= BASEURL; ?>/characters/store" method="POST">
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Character Name</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 5px;">Element</label>
                    <select name="element" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                        <option value="Pyro">Pyro</option>
                        <option value="Hydro">Hydro</option>
                        <option value="Anemo">Anemo</option>
                        <option value="Electro">Electro</option>
                        <option value="Dendro">Dendro</option>
                        <option value="Cryo">Cryo</option>
                        <option value="Geo">Geo</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 5px;">Weapon Type</label>
                    <select name="weapon_type" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                        <option value="Sword">Sword</option>
                        <option value="Claymore">Claymore</option>
                        <option value="Polearm">Polearm</option>
                        <option value="Bow">Bow</option>
                        <option value="Catalyst">Catalyst</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Rarity</label>
                <div style="display: flex; gap: 20px;">
                    <label><input type="radio" name="rarity" value="4" checked> 4-Star</label>
                    <label><input type="radio" name="rarity" value="5"> 5-Star</label>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Primary Role</label>
                <input type="text" name="role" placeholder="e.g. Main DPS, Healer" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Image URL (Direct Link)</label>
                <input type="url" name="image_url" placeholder="https://..." required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <button type="submit" class="btn-cta" style="width: 100%; border: none; cursor: pointer; font-size: 1rem;">Add Character</button>
            <a href="<?= BASEURL; ?>/characters" style="display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none;">Cancel</a>

        </form>
    </div>
</div>