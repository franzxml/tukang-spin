<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <section class="hero-section">
        
        <div class="hero-text">
            <h1 class="hero-title" style="font-size: 2.5rem;">Daftar Karakter</h1>
            <p class="hero-description">Kelola roster, lihat statistik build, dan atur tim Anda dengan mudah.</p>
            
            <div style="width: 100%; max-width: 400px; margin-top: 10px; display: flex; flex-direction: column; gap: 15px;">
                <input type="text" id="keyword" placeholder="Cari nama karakter..." autocomplete="off" style="background: white; border: 1px solid var(--border-subtle); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                
                <a href="<?= BASEURL; ?>/characters/add" class="btn-cta btn-black" style="text-align: center;">+ Tambah Karakter</a>
            </div>
        </div>

        <div class="hero-visual">
            <img src="<?= BASEURL; ?>/img/home/4.5-wallpapers.png" 
                 alt="Character Roster Visual" 
                 class="hero-img"
                 style="object-position: center 20%;"
                 loading="lazy"
                 decoding="async">
        </div>

    </section>

    <div id="character-grid" class="character-grid-wrapper">
        <?php 
            // Load the partial view for the initial load
            require_once '../app/views/characters/list.php'; 
        ?>
    </div>
</div>