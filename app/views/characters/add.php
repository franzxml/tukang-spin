<div class="container">
    <div style="max-width: 800px; margin: 0 auto; background: var(--bg-secondary); padding: 30px; border-radius: 8px; border: 1px solid var(--border-color);">
        <h2 style="color: var(--text-secondary); margin-bottom: 20px; text-align: center;">Add New Character</h2>

        <form action="<?= BASEURL; ?>/characters/store" method="POST">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px;">Character Name</label>
                    <input type="text" name="name" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px;">Primary Role</label>
                    <input type="text" name="role" placeholder="e.g. Main DPS" required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                <div>
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
                <div>
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

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px;">Level (1-90)</label>
                    <input type="number" name="level" value="90" min="1" max="90" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px;">Constellation (0-6)</label>
                    <input type="number" name="constellation" value="0" min="0" max="6" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px;">Rarity</label>
                    <div style="display: flex; gap: 15px; align-items: center; height: 42px;">
                        <label><input type="radio" name="rarity" value="4" checked> 4★</label>
                        <label><input type="radio" name="rarity" value="5"> 5★</label>
                    </div>
                </div>
            </div>

            <label style="display: block; margin-bottom: 5px;">Talent Levels (Normal / Skill / Burst)</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                <input type="number" name="talent_na" value="1" min="1" max="10" placeholder="NA" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                <input type="number" name="talent_skill" value="1" min="1" max="13" placeholder="Skill" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
                <input type="number" name="talent_burst" value="1" min="1" max="13" placeholder="Burst" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Image URL (Direct Link)</label>
                <input type="url" name="image_url" placeholder="https://..." required style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Notes / Build Description</label>
                <textarea name="description" rows="3" placeholder="e.g. 4pc Emblem, The Catch R5" style="width: 100%; padding: 10px; background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 4px; resize: vertical;"></textarea>
            </div>

            <button type="submit" class="btn-cta" style="width: 100%; border: none; cursor: pointer; font-size: 1rem;">Add Character</button>
            <a href="<?= BASEURL; ?>/characters" style="display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none;">Cancel</a>

        </form>
    </div>
</div>