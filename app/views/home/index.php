<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Selamat Datang di Genpedia.</h1>
        <p class="hero-subtitle">Database pribadi untuk manajemen build Genshin Impact.</p>
        <p class="hero-description">Kelola tim, senjata, dan artefak Anda dengan efisiensi maksimal. Nikmati pengalaman manajemen yang mulus dan terintegrasi.</p>
        
        <div class="hero-actions">
            <a href="<?= BASEURL; ?>/characters" class="btn-cta btn-primary">Mulai Kelola</a>
            <a href="<?= BASEURL; ?>/weapons" class="btn-link">Lihat Senjata &rsaquo;</a>
        </div>
    </div>

    <div class="hero-visual-wrapper">
        <img src="https://i.imgur.com/QJU6mHq.jpeg" alt="Genshin Impact Banner" class="hero-img">
    </div>
</section>

<div class="stats-grid">
    <div class="stats-card">
        <h3>Total Karakter Anda</h3> 
        <p class="stats-number">
            <?= $data['total_characters']; ?>
        </p>
        <p class="stats-label">Terdaftar di database</p>
    </div>
</div>