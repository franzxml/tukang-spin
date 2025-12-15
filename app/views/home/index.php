<div class="row">
    <div class="col-lg-12">
        <?php Flasher::flash(); ?>
    </div>
</div>

<section class="hero-section">
    <div class="hero-text">
        <h1 class="hero-title">Selamat Datang di Genpedia.</h1>
        <p class="hero-subtitle">Database pribadi untuk manajemen build Genshin Impact.</p>
        <p class="hero-description">Kelola tim, senjata, dan artefak Anda dengan efisiensi maksimal dalam satu tempat yang terorganisir.</p>
        
        <div class="hero-actions">
            <a href="<?= BASEURL; ?>/characters" class="btn-cta btn-black">Mulai Kelola</a>
            <a href="<?= BASEURL; ?>/weapons" class="link-cta">Lihat Senjata &rsaquo;</a>
        </div>
    </div>

    <div class="hero-visual">
        <img src="<?= BASEURL; ?>/img/home/summer-resort.jpg" 
             alt="Genshin Impact Visual" 
             class="hero-img"
             fetchpriority="high"
             decoding="async">
    </div>
</section>

<section class="stats-section">
    <div class="stats-card-split">
        <div class="stats-content">
            <h3 class="stats-title">Koleksi Karakter</h3>
            
            <div class="stats-metric">
                <span class="metric-value"><?= $data['total_characters']; ?></span>
                <span class="metric-label">Terdaftar</span>
            </div>
            
            <p class="stats-desc">Karakter yang telah Anda daftarkan dan kelola di database Genpedia.</p>
        </div>
        
        <div class="stats-visual">
            <img src="<?= BASEURL; ?>/img/home/adventurers-trails.jpg" 
                 alt="Character Collection" 
                 class="stats-img"
                 loading="lazy"
                 decoding="async">
        </div>
    </div>
</section>