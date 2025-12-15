<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <section class="hero-section">
        <div class="hero-text">
            <h1 class="hero-title">Koleksi Artefak</h1>
            <p class="hero-description">Set peralatan kuno yang memberikan kekuatan elemen dan bonus statistik unik.</p>
            <a href="<?= BASEURL; ?>/artifacts/add" class="btn-cta btn-black">+ Tambah Set</a>
        </div>
        <div class="hero-visual">
            <img src="<?= BASEURL; ?>/img/home/summer-resort.jpg" alt="Artifacts Visual" class="hero-img">
        </div>
    </section>

    <div class="item-grid">
        <?php foreach ($data['artifacts'] as $art) : ?>
            <div class="item-card">
                
                <div class="item-card-visual" style="background: #202028;">
                    <img src="<?= $art['image_url']; ?>" alt="<?= $art['name']; ?>" class="item-card-img" style="filter: none;">
                    <a href="<?= BASEURL; ?>/artifacts/delete/<?= $art['id']; ?>" 
                       class="item-delete-btn"
                       onclick="return confirm('Hapus set ini?');">
                        &times;
                    </a>
                </div>

                <div class="item-card-body">
                    <h4 class="item-card-title" style="margin-bottom: 10px;"><?= $art['name']; ?></h4>
                    
                    <div style="font-size: 0.85rem; margin-bottom: 6px;">
                        <span style="color: var(--accent-blue); font-weight: 600;">2pc:</span> 
                        <span style="color: var(--text-secondary);"><?= $art['bonus_2pc']; ?></span>
                    </div>
                    
                    <div style="font-size: 0.85rem; line-height: 1.4;">
                        <span style="color: var(--text-primary); font-weight: 600;">4pc:</span> 
                        <span style="color: var(--text-secondary);"><?= mb_strimwidth($art['bonus_4pc'], 0, 70, '...'); ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>