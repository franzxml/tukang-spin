<style>
    /* CSS for Weapon Hover Effect */
    .weapon-container { position: relative; cursor: pointer; }
    .alt-weapons-popup {
        display: none;
        position: absolute;
        top: 100%; left: 0; width: 100%;
        background: var(--bg-secondary);
        border: 1px solid var(--text-secondary);
        border-radius: 8px;
        padding: 10px;
        z-index: 100;
        box-shadow: 0 10px 20px rgba(0,0,0,0.6);
        margin-top: 10px;
    }
    .weapon-container:hover .alt-weapons-popup { display: block; animation: fadeIn 0.2s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
    
    .alt-item { display: flex; gap: 10px; align-items: center; padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
    .alt-item:last-child { border-bottom: none; }
    .alt-item img { width: 40px; height: 40px; background: #202028; border-radius: 4px; }
</style>

<div class="container">
    <div style="margin-bottom: 20px;"><a href="<?= BASEURL; ?>/characters" style="color: #888;">&larr; Kembali</a></div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        
        <div style="position: relative; background: linear-gradient(to bottom, #2c2c35, var(--bg-primary)); min-height: 500px; display: flex; align-items: center; justify-content: center;">
            <img src="<?= $data['character']['image_url']; ?>" alt="<?= $data['character']['name']; ?>" style="width: 100%; height: 100%; object-fit: cover; max-height: 600px; mask-image: linear-gradient(to bottom, black 80%, transparent 100%);">
            <div style="position: absolute; top: 20px; left: 20px; font-size: 2rem; font-weight: bold; color: white; text-shadow: 0 2px 5px black;"><?= $data['character']['element']; ?></div>
        </div>

        <div style="padding: 40px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; border-bottom: 2px solid var(--border-color); padding-bottom: 20px;">
                <div>
                    <h1 style="font-size: 3rem; line-height: 1; margin-bottom: 10px;"><?= $data['character']['name']; ?></h1>
                    <span style="background: var(--text-secondary); color: var(--bg-primary); padding: 5px 12px; border-radius: 4px; font-weight: bold; font-size: 0.8rem; text-transform: uppercase;"><?= $data['character']['role']; ?></span>
                </div>
                <a href="<?= BASEURL; ?>/characters/edit/<?= $data['character']['id']; ?>" class="btn-cta" style="background: transparent; border: 1px solid var(--text-secondary); color: var(--text-secondary);">Ubah Data</a>
            </div>

            <h3 style="color: #888; font-size: 0.9rem; letter-spacing: 1px; margin-bottom: 15px; text-transform: uppercase;">Senjata (Hover untuk Alternatif)</h3>
            <div class="weapon-container">
                <?php if (!empty($data['character']['weapon_name'])) : ?>
                    <div style="display: flex; gap: 20px; background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); border-radius: 8px; padding: 15px;">
                        <div style="width: 80px; height: 80px; background: #202028; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                             <img src="<?= $data['character']['weapon_image']; ?>" style="max-width: 90%; max-height: 90%;">
                        </div>
                        <div>
                            <h4 style="color: var(--text-primary); margin: 0;"><?= $data['character']['weapon_name']; ?></h4>
                            <div style="font-size: 0.9rem; color: #ccc;">Base ATK: <strong style="color: white;"><?= $data['character']['weapon_atk']; ?></strong></div>
                            <div style="font-size: 0.9rem; color: var(--accent-color);"><?= $data['character']['weapon_substat_type']; ?>: <?= $data['character']['weapon_substat_value']; ?></div>
                        </div>
                    </div>
                <?php else : ?>
                    <div style="padding: 15px; background: rgba(0,0,0,0.2); border-radius: 8px; color: #666; font-style: italic;">Tidak ada senjata.</div>
                <?php endif; ?>

                <?php if (!empty($data['alt_weapons'])) : ?>
                    <div class="alt-weapons-popup">
                        <div style="font-size: 0.8rem; color: #888; margin-bottom: 5px; text-transform: uppercase;">Opsi Alternatif</div>
                        <?php foreach ($data['alt_weapons'] as $alt) : ?>
                            <div class="alt-item">
                                <img src="<?= $alt['image_url']; ?>" alt="icon">
                                <div>
                                    <div style="font-size: 0.9rem; color: var(--text-primary);"><?= $alt['name']; ?></div>
                                    <div style="font-size: 0.75rem; color: var(--accent-color);"><?= $alt['sub_stat_type']; ?> <?= $alt['sub_stat_value']; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <h3 style="color: #888; font-size: 0.9rem; letter-spacing: 1px; margin: 30px 0 15px 0; text-transform: uppercase;">Artefak</h3>
            <div style="background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); border-radius: 8px; padding: 20px;">
                <?php if (!empty($data['character']['artifact_name'])) : ?>
                    <div style="display: flex; gap: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; margin-bottom: 15px;">
                        <div style="width: 60px; height: 60px; background: #202028; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid var(--text-secondary);">
                            <img src="<?= $data['character']['artifact_image']; ?>" style="width: 80%; height: 80%; object-fit: contain;">
                        </div>
                        <div>
                            <h4 style="color: var(--text-secondary); margin: 0;"><?= $data['character']['artifact_name']; ?></h4>
                            <p style="font-size: 0.8rem; color: #aaa; margin: 5px 0 0 0;"><?= $data['character']['artifact_bonuses']; ?></p>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; text-align: center;">
                        <div style="background: rgba(0,0,0,0.3); padding: 8px; border-radius: 4px;">
                            <div style="font-size: 0.7rem; color: #888;">Sands</div>
                            <div style="font-size: 0.9rem; font-weight: 600;"><?= $data['character']['art_sands'] ?? '-'; ?></div>
                        </div>
                        <div style="background: rgba(0,0,0,0.3); padding: 8px; border-radius: 4px;">
                            <div style="font-size: 0.7rem; color: #888;">Goblet</div>
                            <div style="font-size: 0.9rem; font-weight: 600;"><?= $data['character']['art_goblet'] ?? '-'; ?></div>
                        </div>
                        <div style="background: rgba(0,0,0,0.3); padding: 8px; border-radius: 4px;">
                            <div style="font-size: 0.7rem; color: #888;">Circlet</div>
                            <div style="font-size: 0.9rem; font-weight: 600;"><?= $data['character']['art_circlet'] ?? '-'; ?></div>
                        </div>
                    </div>
                <?php else : ?>
                    <div style="color: #666; font-style: italic;">Belum ada set artefak yang dipasang.</div>
                <?php endif; ?>
            </div>

            <h3 style="color: #888; font-size: 0.9rem; letter-spacing: 1px; margin: 30px 0 15px 0; text-transform: uppercase;">Statistik Karakter</h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #888;">Level</div>
                    <div style="font-size: 1.5rem; font-weight: bold;"><?= $data['character']['level']; ?></div>
                </div>
                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #888;">Konstelasi</div>
                    <div style="font-size: 1.5rem; color: var(--accent-color); font-weight: bold;">C<?= $data['character']['constellation']; ?></div>
                </div>
                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #888;">Talenta</div>
                    <div style="font-size: 1rem; font-weight: bold;">
                        <?= $data['character']['talent_na']; ?> / <?= $data['character']['talent_skill']; ?> / <?= $data['character']['talent_burst']; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>