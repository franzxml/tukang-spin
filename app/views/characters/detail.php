<div class="container">
    <div style="margin-bottom: 20px;">
        <a href="<?= BASEURL; ?>/characters" style="color: #888; text-decoration: none;">&larr; Back to Roster</a>
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
            
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; border-bottom: 2px solid var(--border-color); padding-bottom: 20px;">
                <div>
                    <h1 style="font-size: 3rem; line-height: 1; color: var(--text-primary); margin-bottom: 10px;">
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
                    Edit Data
                </a>
            </div>

            <h3 style="color: #888; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px; margin-bottom: 15px;">Core Stats</h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px;">
                
                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #888;">Level</div>
                    <div style="font-size: 1.5rem; color: var(--text-primary); font-weight: bold;"><?= $data['character']['level']; ?></div>
                </div>

                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #888;">Constellation</div>
                    <div style="font-size: 1.5rem; color: var(--accent-color); font-weight: bold;">C<?= $data['character']['constellation']; ?></div>
                </div>

                <div style="background: var(--bg-primary); padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="font-size: 0.8rem; color: #888;">Weapon</div>
                    <div style="font-size: 1.2rem; color: var(--text-primary);"><?= $data['character']['weapon_type']; ?></div>
                </div>

            </div>

            <h3 style="color: #888; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px; margin-bottom: 15px;">Talents</h3>
            <div style="display: flex; gap: 15px; margin-bottom: 40px;">
                
                <div style="flex: 1; background: var(--bg-primary); padding: 10px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center;">
                    <span>Normal Attack</span>
                    <span style="color: <?= ($data['character']['talent_na'] >= 9) ? '#4e7cff' : 'inherit'; ?>; font-weight: bold;"><?= $data['character']['talent_na']; ?></span>
                </div>

                <div style="flex: 1; background: var(--bg-primary); padding: 10px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center;">
                    <span>Skill (E)</span>
                    <span style="color: <?= ($data['character']['talent_skill'] >= 9) ? '#4e7cff' : 'inherit'; ?>; font-weight: bold;"><?= $data['character']['talent_skill']; ?></span>
                </div>

                <div style="flex: 1; background: var(--bg-primary); padding: 10px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center;">
                    <span>Burst (Q)</span>
                    <span style="color: <?= ($data['character']['talent_burst'] >= 9) ? '#4e7cff' : 'inherit'; ?>; font-weight: bold;"><?= $data['character']['talent_burst']; ?></span>
                </div>

            </div>

            <?php if (!empty($data['character']['description'])) : ?>
                <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 8px; border-left: 3px solid var(--text-secondary);">
                    <h4 style="color: var(--text-secondary); margin-bottom: 10px;">Notes</h4>
                    <p style="color: #ccc; font-style: italic;"><?= nl2br($data['character']['description']); ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>