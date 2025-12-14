<?php 
/**
 * Partial View: Character List Grid
 * Style: Genshin Namecard UI (Horizontal Banner)
 * Icon on Left, Info on Right, Decorative Background.
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
            // Determine Rarity Class for Background
            $rarityClass = ($char['rarity'] == 5) ? 'bg-rarity-5' : 'bg-rarity-4';
            
            // Element Color for Badge
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

        <a href="<?= BASEURL; ?>/characters/detail/<?= $char['id']; ?>" class="namecard-style">
            
            <div class="namecard-bg <?= $rarityClass; ?>"></div>
            
            <div class="namecard-overlay"></div>

            <div class="namecard-avatar-container">
                <img src="<?= $char['image_url']; ?>" alt="<?= $char['name']; ?>" class="namecard-avatar-img">
            </div>

            <div class="namecard-info">
                <h3 class="namecard-name"><?= $char['name']; ?></h3>
                
                <div class="namecard-meta">
                    <span class="element-badge" style="background-color: <?= $elmColor; ?>20; border-color: <?= $elmColor; ?>; color: <?= $elmColor; ?>;">
                        <?= $char['element']; ?>
                    </span>
                    
                    <span><?= $char['weapon_type']; ?></span>
                    
                    <span style="color: #FFD700; margin-left: 5px; font-weight: 700;">
                        <?= $char['rarity']; ?>★
                    </span>
                </div>
                
                <div style="font-size: 0.75rem; color: rgba(255,255,255,0.7); margin-top: 6px; text-transform: uppercase; letter-spacing: 0.5px;">
                    <?= $char['role']; ?>
                </div>
            </div>

        </a>
    <?php endforeach; ?>

<?php endif; ?>