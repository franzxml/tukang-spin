<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div style="margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="color: var(--text-secondary);">Koleksi Senjata</h2>
            <p style="color: #888; margin: 0;">Database senjata dan statistik lengkapnya.</p>
        </div>
        
        <a href="<?= BASEURL; ?>/weapons/add" class="btn-cta" style="font-size: 0.9rem;">+ Tambah Senjata</a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px;">
        
        <?php foreach ($data['weapons'] as $wep) : ?>
            <div style="background: var(--bg-secondary); border-radius: 8px; border: 1px solid var(--border-color); display: flex; overflow: hidden; height: 150px; position: relative;">
                
                <div style="width: 110px; background: #202028; position: relative; display: flex; align-items: center; justify-content: center;">
                    <img src="<?= $wep['image_url']; ?>" alt="<?= $wep['name']; ?>" style="width: 90%; height: 90%; object-fit: contain;">
                </div>

                <div style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <h4 style="color: var(--text-primary); margin: 0; font-size: 1rem; max-width: 140px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $wep['name']; ?></h4>
                        <span style="color: gold; font-weight: bold; font-size: 0.8rem; background: rgba(255, 215, 0, 0.1); padding: 2px 6px; border-radius: 4px;"><?= $wep['rarity']; ?>★</span>
                    </div>
                    
                    <div style="color: #666; font-size: 0.8rem; margin-bottom: 10px;"><?= $wep['type']; ?></div>

                    <div style="display: flex; gap: 10px; margin-top: auto;">
                        <div style="background: rgba(0,0,0,0.3); padding: 5px 10px; border-radius: 4px; flex: 1; text-align: center;">
                            <div style="font-size: 0.7rem; color: #888;">Base ATK</div>
                            <div style="color: white; font-weight: 600;"><?= $wep['base_atk']; ?></div>
                        </div>
                        <div style="background: rgba(106, 141, 255, 0.1); padding: 5px 10px; border-radius: 4px; flex: 1; text-align: center; border: 1px solid rgba(106, 141, 255, 0.2);">
                            <div style="font-size: 0.7rem; color: var(--accent-color);"><?= $wep['sub_stat_type']; ?></div>
                            <div style="color: var(--accent-color); font-weight: 600;"><?= $wep['sub_stat_value']; ?></div>
                        </div>
                    </div>

                    <a href="<?= BASEURL; ?>/weapons/delete/<?= $wep['id']; ?>" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus senjata ini?');" 
                       style="position: absolute; bottom: 10px; right: 10px; color: var(--danger-color); font-size: 1.2rem; line-height: 1;">
                        &times;
                    </a>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>