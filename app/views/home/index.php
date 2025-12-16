<div class="row">
    <div class="col-lg-12">
        <?php Flasher::flash(); ?>
    </div>
</div>

<section class="hero-section">
    <div class="hero-text">
        <h1 class="hero-title">Selamat datang di Genpedia!</h1>
        <p class="hero-description">Kelola tim, senjata, dan artefak Anda dengan efisiensi maksimal dalam satu tempat yang terorganisir.</p>
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
            <h3 class="stats-title-main">Berikut total database terdaftar:</h3>
            
            <p class="stats-desc-main">
                <?= $data['total_characters']; ?> karakter, 
                <?= $data['total_weapons']; ?> senjata, dan 
                <?= $data['total_artifacts']; ?> artefak.
            </p>
        </div>
        
        <div class="stats-visual">
            <img src="<?= BASEURL; ?>/img/home/adventurers-trails.jpg" 
                 alt="Database Stats Visual" 
                 class="stats-img"
                 loading="lazy"
                 decoding="async">
        </div>
    </div>
</section>