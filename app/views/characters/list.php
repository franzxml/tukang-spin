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
    </div>
<?php else : ?>

    <?php foreach ($data['characters'] as $char) : ?>
        <?php 
            $elmColor = match($char['element']) {
                'Pyro' => '#FF5C5C', 'Hydro' => '#4E7CFF', 'Dendro' => '#A5C882',
                'Electro' => '#AF8EC1', 'Anemo' => '#74E2D1', 'Cryo' => '#9FD6E3',
                'Geo' => '#FFE699', default => '#999'
            };
            // Use Namecard URL if available, fallback to gradient
            $bgStyle = !empty($char['namecard_url']) 
                ? "background-image: url('" . $char['namecard_url'] . "');" 
                : "background: linear-gradient(90deg, #ccc, #eee);";
        ?>

        <a href="<?= BASEURL; ?>/characters/detail/<?= $char['id']; ?>" class="namecard-style">
            
            <div class="namecard-bg" style="<?= $bgStyle; ?>"></div>
            
            <div class="namecard-overlay"></div>

            <div class="namecard-avatar-container">
                <img src="<?= $char['image_url']; ?>" class="namecard-avatar-img">
            </div>

            <div class="namecard-info">
                <h3 class="namecard-name"><?= $char['name']; ?></h3>
                <div class="namecard-meta">
                    <span class="element-badge" style="background-color: <?= $elmColor; ?>40; border-color: <?= $elmColor; ?>; color: #fff;">
                        <?= $char['element']; ?>
                    </span>
                    <span><?= $char['weapon_type']; ?></span>
                    <span style="color: #FFD700; margin-left: 5px; font-weight: 700;"><?= $char['rarity']; ?>★</span>
                </div>
            </div>

        </a>
    <?php endforeach; ?>

<?php endif; ?>