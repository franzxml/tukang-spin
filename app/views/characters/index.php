<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div class="page-header-card">
        <h1 class="page-title">Daftar Karakter</h1>
        <p>Kelola roster, lihat statistik build, dan atur tim Anda.</p>
        
        <div style="margin-top: 25px; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
            <input type="text" id="keyword" placeholder="Cari nama karakter..." autocomplete="off" style="max-width: 300px; background: white; color: black; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            
            <a href="<?= BASEURL; ?>/characters/add" class="btn-cta btn-white" style="color: black !important;">+ Tambah Baru</a>
        </div>
    </div>

    <div id="character-grid" class="character-grid-wrapper">
        
        <?php 
            // Load the partial view for the initial load
            require_once '../app/views/characters/list.php'; 
        ?>

    </div>
</div>