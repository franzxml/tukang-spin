<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div style="margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="color: var(--text-secondary);">Royal Armory</h2>
            <p style="color: #888; margin: 0;">Database of weapons and their stats.</p>
        </div>
        
        <a href="<?= BASEURL; ?>/weapons/add" class="btn-cta" style="font-size: 0.9rem;">+ Forge Weapon</a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        
        <?php foreach ($data['weapons'] as $wep) : ?>
            <div style="background: var(--bg-secondary); border-radius: 6px; border: 1px solid var(--border-color); display: flex; overflow: hidden; height: 140px;">
                
                <div style="width: 120px; background: #202028; position: relative;">
                    <img src="<?= $wep['image_url']; ?>" alt="<?= $wep['name']; ?>" style="width: 100%; height: 100%; object-fit: contain;">
                </div>

                <div style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: center;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <h4 style="color: var(--text-primary); margin: 0; font-size: 1rem;"><?= $wep['name']; ?></h4>
                        <span style="color: gold; font-weight: bold; font-size: 0.9rem;"><?= $wep['rarity']; ?>★</span>
                    </div>
                    
                    <div style="color: #888; font-size: 0.8rem; margin-bottom: 8px;"><?= $wep['type']; ?></div>

                    <div style="display: flex; gap: 15px; background: rgba(0,0,0,0.3); padding: 5px; border-radius: 4px;">
                        <div style="font-size: 0.8rem; color: #ccc;">
                            ATK <strong style="color: white;"><?= $wep['base_atk']; ?></strong>
                        </div>
                        <div style="font-size: 0.8rem; color: #ccc;">
                            <?= $wep['sub_stat']; ?>
                        </div>
                    </div>

                    <div style="margin-top: auto; text-align: right;">
                        <a href="<?= BASEURL; ?>/weapons/delete/<?= $wep['id']; ?>" onclick="return confirm('Dismantle weapon?');" style="color: #666; font-size: 0.8rem; text-decoration: none;">&times; Dismantle</a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>