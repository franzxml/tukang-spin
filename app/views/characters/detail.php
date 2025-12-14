<style>
    /* CSS for Weapon Hover Effect */
    .weapon-container { position: relative; cursor: pointer; }
    
    .alt-weapons-popup {
        display: none;
        position: absolute;
        top: 100%; left: 0; width: 100%;
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px;
        z-index: 100;
        box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        margin-top: 10px;
    }
    
    .weapon-container:hover .alt-weapons-popup { display: block; animation: fadeIn 0.2s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
    
    .alt-item { display: flex; gap: 10px; align-items: center; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
    .alt-item:last-child { border-bottom: none; }
    .alt-item img { width: 40px; height: 40px; background: #202028; border-radius: 4px; object-fit: contain; }
</style>

<div class="container">
    <div style="margin-bottom: 20px;">
        <a href="<?= BASEURL; ?>/characters" style="color: #86868b; text-decoration: none;">&larr; Kembali ke Daftar</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        
        <div style="position: relative; background: linear-gradient(to bottom, #2c2c35, var(--bg-primary)); min-height: 500px; display: flex; align-items: center; justify-content: center;">
            <img src="<?= $data['character']['image_url']; ?>" alt="<?= $data['character']['name']; ?>" style="width: 100%; height: 100%; object-fit: cover; max-height: 600px; mask-image: linear-gradient(to bottom, black 80%, transparent 100%);">
            
            <div style="position: absolute; top: 20px; left: 20px; font-size: 2rem; text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
               <?php 
                    $color = match($data['character']['element']) {
                        'Pyro' => '#FF5C5C',
                        'Hydro' => '#4E7CFF',
                        'Dendro' => '#A5C882',
                        'Electro' => '#AF8EC1',
                        'Anemo' => '#74E2D1',
                        'Cryo' => '#9FD6E3',
                        'Geo' => '#FFE699',
                        default => '#FFF'
                    };
               ?>
               <span style="color: <?= $color; ?>; font-weight: bold;"><?= $data['character']['element']; ?></span>
            </div>
        </div>

        <div style="padding: 40px;">
            
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 20px;">
                <div>
                    <h1 style="font-size: 3rem; line-height: 1; margin-bottom: 10px;">
                        <?= $data['character']['name']; ?>
                    </h1>
                    <span style="background: var(--text-secondary); color: var(--bg-primary); padding: 5px 12px; border-radius: 4px; font-weight: bold; text-transform: uppercase; font-size: 0.8rem;">
                        <?= $data['character']['role']; ?>
                    </span>
                    <span style="margin-left: 10px; color: gold; font-size: 1.2rem;">
                        <?= str_repeat('★', $data['character']['rarity']); ?>
                    </span>
                </div>
                
                <a href="<?= BASEURL; ?>/characters/edit/<?= $data['character']['id']; ?>" class="btn-cta" style="background: transparent; border: 1px solid var(--text-secondary); color: var(--text-secondary);">
                    Ubah Data
                </a>
            </div>

            <h3 style="color: #86868b; font-size: 0.8rem; letter-spacing: 1px; margin-bottom: 15px; text-transform: uppercase;">Senjata (Hover untuk Alternatif)</h3>
            
            <div class="weapon-container">
                <?php if (!empty($data['character']['weapon_name'])) : ?>
                    <div style="display: flex; gap: 20px; background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); border-radius: 8px; padding: 15px;">
                        <div style="width: 80px; height: 80px; background: #202028; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                             <img src="<?= $data['character']['weapon_image']; ?>" alt="Weapon" style="max-width: 90%; max-height: 90%; object-fit: contain;">
                        </div>
                        <div style="flex-grow: 1;">
                            <div style="display: flex; justify-content: space-between;">
                                <h4 style="color: var(--text-primary); margin: 0 0 5px 0;"><?= $data['character']['weapon_name']; ?></h4>
                                <span style="color: gold; font-weight: bold; font-size: 0.9rem;"><?= $data['character']['weapon_rarity']; ?>★</span>
                            </div>
                            
                            <div style="font-size: 0.9rem; color: #ccc; margin-bottom: 3px;">
                                Base ATK: <strong style="color: white;"><?= $data['character']['weapon_atk']; ?></strong>
                            </div>
                            <div style="font-size: 0.9rem; color: var(--accent-color);">
                                <?= $data['character']['weapon_substat_type']; ?>: <strong><?= $data['character']['weapon_substat_value']; ?></strong>
                            </div>

                            <?php if (!empty($data['character']['weapon_passive_name'])) : ?>
                                <div style="margin-top: 8px; font-size: 0.8rem; color: #86868b; font-style: italic;">
                                    "<?= $data['character']['weapon_passive_name']; ?>"
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div style="padding: 20px; background: rgba(0,0,0,0.2); border-radius: 8px; color: #666; font-style: italic;">
                        Belum ada senjata yang dipasang.
                    </div>
                <?php endif; ?>

                <?php if (!empty($data['alt_weapons'])) : ?>
                    <div class="alt-weapons-popup">
                        <div style="font-size: 0.75rem; color: #86868b; margin-bottom: 10px; text-transform: uppercase; font-weight: bold;">Opsi Alternatif</div>
                        <?php foreach ($data['alt_weapons'] as $alt) : ?>
                            <div class="alt-item">
                                <img src="<?= $alt['image_url']; ?>" alt="icon">
                                <div>
                                    <div style="font-size: 0.9rem; color: var(--text-primary); font-weight: 500;"><?= $alt['name']; ?></div>
                                    <div style="font-size: 0.8rem; color: var(--accent-color);">
                                        <?= $alt['sub_stat_type']; ?> <?= $alt['sub_stat_value']; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <h3 style="color: #86868b; font-size: 0.8rem; letter-spacing: 1px; margin: 30px 0 15px 0; text-transform: uppercase;">Artefak</h3>
            <div style="background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); border-radius: 8px; padding: 20px;">
                <?php if (!empty($data['character']['artifact_name'])) : ?>
                    <div style="display: flex; gap: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; margin-bottom: 15px;">
                        <div style="width: 70px; height: 70px; background: #202028; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid var(--text-secondary); flex-shrink: 0;">
                            <img src="<?= $data['character']['artifact_image']; ?>" style="width: 80%; height: 80%; object-fit: contain;">
                        </div>
                        <div>
                            <h4 style="color: var(--text-secondary); margin: 0 0 8px 0;"><?= $data['character']['artifact_name']; ?></h4>
                            
                            <div style="font-size: 0.85rem; margin-bottom: 4px;">
                                <span style="color: var(--accent-color); font-weight: 600;">2-Set:</span> 
                                <span style="color: #ccc;"><?= $data['character']['artifact_2pc']; ?></span>
                            </div>
                            <div style="font-size: 0.85rem; line-height: 1.4;">
                                <span style="color: #86868b; font-weight: 600;">4-Set:</span> 
                                <span style="color: #aaa;"><?= $data['character']['artifact_4pc']; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; text-align: center;">
                        <div style="background: rgba(255,255,255,0.05); padding: 10px; border-radius: 6px;">
                            <div style="font-size: 0.7rem; color: #86868b; text-transform: uppercase;">Sands</div>
                            <div style="font-size: 0.9rem; font-weight: 600; color: var(--text-primary);"><?= $data['character']['art_sands'] ?? '-'; ?></div>
                        </div>
                        <div style="background: rgba(255,255,255,0.05); padding: 10px; border-radius: 6px;">
                            <div style="font-size: 0.7rem; color: #86868b; text-transform: uppercase;">Goblet</div>
                            <div style="font-size: 0.9rem; font-weight: 600; color: var(--text-primary);"><?= $data['character']['art_goblet'] ?? '-'; ?></div>
                        </div>
                        <div style="background: rgba(255,255,255,0.05); padding: 10px; border-radius: 6px;">
                            <div style="font-size: 0.7rem; color: #86868b; text-transform: uppercase;">Circlet</div>
                            <div style="font-size: 0.9rem; font-weight: 600; color: var(--text-primary);"><?= $data['character']['art_circlet'] ?? '-'; ?></div>
                        </div>
                    </div>
                <?php else : ?>
                    <div style="color: #666; font-style: italic;">Belum ada set artefak yang dipasang.</div>
                <?php endif; ?>
            </div>

            <h3 style="color: #86868b; font-size: 0.8rem; letter-spacing: 1px; margin: 30px 0 15px 0; text-transform: uppercase;">Statistik Karakter</h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #86868b;">Level</div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: var(--text-primary);"><?= $data['character']['level']; ?></div>
                </div>
                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #86868b;">Konstelasi</div>
                    <div style="font-size: 1.5rem; color: var(--accent-color); font-weight: bold;">C<?= $data['character']['constellation']; ?></div>
                </div>
                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #86868b;">Tipe Senjata</div>
                    <div style="font-size: 1.2rem; font-weight: 500; color: var(--text-primary);"><?= $data['character']['weapon_type']; ?></div>
                </div>
            </div>

            <h3 style="color: #86868b; font-size: 0.8rem; letter-spacing: 1px; margin: 30px 0 15px 0; text-transform: uppercase;">Talenta</h3>
            <div style="display: flex; gap: 15px; margin-bottom: 40px;">
                <div style="flex: 1; background: var(--bg-primary); padding: 12px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.9rem;">Normal</span>
                    <span style="color: <?= ($data['character']['talent_na'] >= 9) ? 'var(--accent-color)' : 'inherit'; ?>; font-weight: bold; font-size: 1.1rem;"><?= $data['character']['talent_na']; ?></span>
                </div>
                <div style="flex: 1; background: var(--bg-primary); padding: 12px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.9rem;">Skill</span>
                    <span style="color: <?= ($data['character']['talent_skill'] >= 9) ? 'var(--accent-color)' : 'inherit'; ?>; font-weight: bold; font-size: 1.1rem;"><?= $data['character']['talent_skill']; ?></span>
                </div>
                <div style="flex: 1; background: var(--bg-primary); padding: 12px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.9rem;">Burst</span>
                    <span style="color: <?= ($data['character']['talent_burst'] >= 9) ? 'var(--accent-color)' : 'inherit'; ?>; font-weight: bold; font-size: 1.1rem;"><?= $data['character']['talent_burst']; ?></span>
                </div>
            </div>

            <?php if (!empty($data['character']['description'])) : ?>
                <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 8px; border-left: 3px solid var(--text-secondary);">
                    <h4 style="color: var(--text-secondary); margin-bottom: 10px; font-size: 1rem;">Catatan</h4>
                    <p style="color: #ccc; font-style: italic; line-height: 1.6;"><?= nl2br($data['character']['description']); ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>