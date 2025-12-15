<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <section class="hero-section">
        <div class="hero-text">
            <h1 class="hero-title">Gudang Senjata</h1>
            <p class="hero-description">Koleksi pedang, busur, dan katalis legendaris untuk memperkuat karakter Anda.</p>
            <a href="<?= BASEURL; ?>/weapons/add" class="btn-cta btn-black">+ Tambah Senjata</a>
        </div>
        <div class="hero-visual">
            <img src="<?= BASEURL; ?>/img/home/4.5-wallpapers.png" alt="Weapons Visual" class="hero-img">
        </div>
    </section>

    <div class="item-grid">
        
        <?php foreach ($data['weapons'] as $wep) : ?>
            <div class="item-card">
                
                <div class="item-card-visual">
                    <img src="<?= $wep['image_url']; ?>" alt="<?= $wep['name']; ?>" class="item-card-img">
                    <a href="<?= BASEURL; ?>/weapons/delete/<?= $wep['id']; ?>" 
                       class="item-delete-btn"
                       onclick="return confirm('Hapus senjata ini?');">
                        &times;
                    </a>
                </div>

                <div class="item-card-body">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <h4 class="item-card-title"><?= $wep['name']; ?></h4>
                        <span style="font-size: 0.8rem; font-weight: 700; color: #e0b46a;"><?= $wep['rarity']; ?>★</span>
                    </div>
                    
                    <div class="item-card-sub"><?= $wep['type']; ?> &bull; Base ATK <?= $wep['base_atk']; ?></div>

                    <div class="item-stat-badge">
                        <?= $wep['sub_stat_type']; ?> +<?= $wep['sub_stat_value']; ?>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>