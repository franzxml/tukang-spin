<?php 
/**
 * Partial View: Character List Grid
 * Style: Genshin Impact Character Card (Vertical, Rarity Background)
 */
?>

<?php if (empty($data['characters'])) : ?>
    <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: #86868b;">
        <h3 style="font-weight: 500;">Tidak ada karakter ditemukan.</h3>
        <p>Coba kata kunci lain atau tambahkan karakter baru.</p>
    </div>
<?php else : ?>

    <?php foreach ($data['characters'] as $char) : ?>
        <?php 
            // Determine Rarity Class
            $rarityClass = ($char['rarity'] == 5) ? 'bg-rarity-5' : 'bg-rarity-4';
            
            // Determine Element Color for Dot
            $elmColor = match($char['element']) {
                'Pyro' => '#FF5C5C',
                'Hydro' => '#4E7CFF',
                'Dendro' => '#A5C882',
                'Electro' => '#AF8EC1',
                'Anemo' => '#74E2D1',
                'Cryo' => '#9FD6E3',
                'Geo' => '#FFE699',
                default => '#999'
            };
        ?>

        <a href="<?= BASEURL; ?>/characters/detail/<?= $char['id']; ?>" class="genshin-card">
            
            <div class="genshin-bg-wrapper <?= $rarityClass; ?>">
                
                <img src="<?= $char['image_url']; ?>" alt="<?= $char['name']; ?>" class="char-image">
                
                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.6); padding: 4px 8px; border-radius: 8px; color: #FFD700; font-size: 0.8rem; font-weight: 700; z-index: 2;">
                    <?= $char['rarity']; ?> ★
                </div>

                <div class="card-info">
                    <h3 class="card-name"><?= $char['name']; ?></h3>
                    
                    <div class="card-meta">
                        <span class="element-dot" style="background-color: <?= $elmColor; ?>;"></span>
                        <span><?= $char['element']; ?></span>
                        <span style="color: #d2d2d7;">|</span>
                        <span><?= $char['weapon_type']; ?></span>
                    </div>

                    <div style="margin-top: 8px; font-size: 0.75rem; color: #86868b; text-transform: uppercase; letter-spacing: 0.5px;">
                        <?= $char['role']; ?>
                    </div>
                </div>

            </div>
        </a>
    <?php endforeach; ?>

<?php endif; ?>