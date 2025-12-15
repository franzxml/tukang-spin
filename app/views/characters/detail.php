<div class="container">
    
    <div class="action-bar">
        <a href="<?= BASEURL; ?>/characters" class="btn-back">
            <span>&larr;</span> Kembali
        </a>

        <a href="<?= BASEURL; ?>/characters/delete/<?= $data['character']['id']; ?>" 
           class="btn-cta btn-danger"
           onclick="return confirm('Apakah Anda yakin ingin menghapus karakter ini selamanya?');">
           Hapus
        </a>
    </div>

    <div class="detail-header">
        <div class="detail-header-bg" style="background-image: url('<?= $data['character']['namecard_url']; ?>');"></div>
        <div class="detail-header-overlay"></div>

        <div class="detail-profile">
            <img src="<?= $data['character']['image_url']; ?>" alt="Avatar" class="detail-avatar">
            
            <div class="detail-title-block">
                <h1><?= $data['character']['name']; ?></h1>
                
                <div class="detail-tags">
                    <span class="detail-tag"><?= $data['character']['element']; ?></span>
                    <span class="detail-tag"><?= $data['character']['weapon_type']; ?></span>
                    <span class="detail-tag"><?= $data['character']['role']; ?></span>
                    <span class="detail-tag" style="color: #FFD700 !important; border-color: #FFD700;"><?= $data['character']['rarity']; ?>★</span>
                    
                    <a href="<?= BASEURL; ?>/characters/edit/<?= $data['character']['id']; ?>" class="detail-tag" style="background: white; color: black !important; padding: 6px 18px;">Edit</a>
                </div>
            </div>
        </div>
    </div>

    <div class="gear-grid">
        
        <div style="display: flex; flex-direction: column; gap: 30px;">
            
            <div class="gear-card">
                <h3>Senjata Terpasang</h3>
                <?php if (!empty($data['character']['weapon_name'])) : ?>
                    <div class="item-flex">
                        <img src="<?= $data['character']['weapon_image']; ?>" class="item-thumb">
                        <div>
                            <div style="font-weight: 700; font-size: 1.2rem;"><?= $data['character']['weapon_name']; ?></div>
                            <div style="font-size: 0.95rem; color: var(--accent-blue); margin-top: 4px;">
                                <?= $data['character']['weapon_substat_type']; ?> <?= $data['character']['weapon_substat_value']; ?>
                            </div>
                            <div style="font-size: 0.85rem; color: #86868b; margin-top: 2px;">Base ATK: <?= $data['character']['weapon_atk']; ?></div>
                        </div>
                    </div>
                <?php else : ?>
                    <p style="color: #86868b; font-style: italic;">Tidak ada senjata.</p>
                <?php endif; ?>
            </div>

            <div class="gear-card">
                <h3>Set Artefak</h3>
                <?php if (!empty($data['character']['artifact_name'])) : ?>
                    <div class="item-flex" style="margin-bottom: 25px;">
                        <img src="<?= $data['character']['artifact_image']; ?>" class="item-thumb" style="border-radius: 50%;">
                        <div>
                            <div style="font-weight: 700; font-size: 1.1rem;"><?= $data['character']['artifact_name']; ?></div>
                            <div style="font-size: 0.9rem; color: #86868b; margin-top: 4px;">Bonus set aktif</div>
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <?php 
                        $stats = [
                            'Sands' => $data['character']['art_sands'],
                            'Goblet' => $data['character']['art_goblet'],
                            'Circlet' => $data['character']['art_circlet']
                        ];
                        foreach($stats as $label => $val): ?>
                            <div class="stat-row">
                                <span class="stat-label"><?= $label; ?></span>
                                <span class="stat-val"><?= $val ?? '-'; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p style="color: #86868b; font-style: italic;">Tidak ada artefak.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="gear-card">
            <h3>Statistik & Talenta</h3>
            
            <div style="margin-bottom: 30px;">
                <div class="stat-row">
                    <span class="stat-label">Level Karakter</span>
                    <span class="stat-val" style="font-size: 1.1rem;"><?= $data['character']['level']; ?></span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">Konstelasi</span>
                    <span class="stat-val" style="color: var(--accent-blue); font-size: 1.1rem;">C<?= $data['character']['constellation']; ?></span>
                </div>
            </div>

            <h3 style="margin-bottom: 15px;">Level Talenta</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px;">
                <div style="text-align: center; background: #f5f5f7; padding: 15px; border-radius: 16px;">
                    <div style="font-size: 0.75rem; color: #86868b; text-transform: uppercase; letter-spacing: 0.05em;">Normal</div>
                    <div style="font-weight: 800; font-size: 1.4rem; margin-top: 5px;"><?= $data['character']['talent_na']; ?></div>
                </div>
                <div style="text-align: center; background: #f5f5f7; padding: 15px; border-radius: 16px;">
                    <div style="font-size: 0.75rem; color: #86868b; text-transform: uppercase; letter-spacing: 0.05em;">Skill</div>
                    <div style="font-weight: 800; font-size: 1.4rem; margin-top: 5px;"><?= $data['character']['talent_skill']; ?></div>
                </div>
                <div style="text-align: center; background: #f5f5f7; padding: 15px; border-radius: 16px;">
                    <div style="font-size: 0.75rem; color: #86868b; text-transform: uppercase; letter-spacing: 0.05em;">Burst</div>
                    <div style="font-weight: 800; font-size: 1.4rem; margin-top: 5px;"><?= $data['character']['talent_burst']; ?></div>
                </div>
            </div>
        </div>

    </div>
</div>