<div class="container">
    <div style="margin-bottom: 20px;">
        <a href="<?= BASEURL; ?>/characters" style="color: #86868b;">&larr; Kembali</a>
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
                    <a href="<?= BASEURL; ?>/characters/edit/<?= $data['character']['id']; ?>" class="detail-tag" style="background: white; color: black !important;">Edit</a>
                </div>
            </div>
        </div>
    </div>

    <div class="gear-grid">
        
        <div class="gear-card">
            <h3>Senjata Terpasang</h3>
            <?php if (!empty($data['character']['weapon_name'])) : ?>
                <div class="item-flex">
                    <img src="<?= $data['character']['weapon_image']; ?>" class="item-thumb">
                    <div>
                        <div style="font-weight: 700; font-size: 1.1rem;"><?= $data['character']['weapon_name']; ?></div>
                        <div style="font-size: 0.9rem; color: var(--accent-blue); margin-top: 4px;">
                            <?= $data['character']['weapon_substat_type']; ?> <?= $data['character']['weapon_substat_value']; ?>
                        </div>
                        <div style="font-size: 0.8rem; color: #86868b; margin-top: 2px;">Base ATK: <?= $data['character']['weapon_atk']; ?></div>
                    </div>
                </div>
            <?php else : ?>
                <p style="color: #86868b; font-style: italic;">Tidak ada senjata.</p>
            <?php endif; ?>
        </div>

        <div class="gear-card">
            <h3>Set Artefak</h3>
            <?php if (!empty($data['character']['artifact_name'])) : ?>
                <div class="item-flex" style="margin-bottom: 15px;">
                    <img src="<?= $data['character']['artifact_image']; ?>" class="item-thumb" style="border-radius: 50%;">
                    <div>
                        <div style="font-weight: 700;"><?= $data['character']['artifact_name']; ?></div>
                        <div style="font-size: 0.8rem; color: #86868b; margin-top: 4px;">Bonus set aktif</div>
                    </div>
                </div>
                
                <div class="stat-row">
                    <span class="stat-label">Sands</span>
                    <span class="stat-val"><?= $data['character']['art_sands'] ?? '-'; ?></span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">Goblet</span>
                    <span class="stat-val"><?= $data['character']['art_goblet'] ?? '-'; ?></span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">Circlet</span>
                    <span class="stat-val"><?= $data['character']['art_circlet'] ?? '-'; ?></span>
                </div>
            <?php else : ?>
                <p style="color: #86868b; font-style: italic;">Tidak ada artefak.</p>
            <?php endif; ?>
        </div>

        <div class="gear-card">
            <h3>Statistik & Talenta</h3>
            <div class="stat-row">
                <span class="stat-label">Level</span>
                <span class="stat-val"><?= $data['character']['level']; ?></span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Konstelasi</span>
                <span class="stat-val" style="color: var(--accent-blue);">C<?= $data['character']['constellation']; ?></span>
            </div>
            <div style="margin-top: 15px; display: flex; gap: 10px;">
                <div style="flex: 1; text-align: center; background: #f5f5f7; padding: 8px; border-radius: 8px;">
                    <div style="font-size: 0.7rem; color: #86868b;">NA</div>
                    <div style="font-weight: 700;"><?= $data['character']['talent_na']; ?></div>
                </div>
                <div style="flex: 1; text-align: center; background: #f5f5f7; padding: 8px; border-radius: 8px;">
                    <div style="font-size: 0.7rem; color: #86868b;">Skill</div>
                    <div style="font-weight: 700;"><?= $data['character']['talent_skill']; ?></div>
                </div>
                <div style="flex: 1; text-align: center; background: #f5f5f7; padding: 8px; border-radius: 8px;">
                    <div style="font-size: 0.7rem; color: #86868b;">Burst</div>
                    <div style="font-weight: 700;"><?= $data['character']['talent_burst']; ?></div>
                </div>
            </div>
        </div>

    </div>
</div>