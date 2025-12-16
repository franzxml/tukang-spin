<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="content-header" style="align-items: center; overflow: hidden; position: relative;">
                
                <div class="content-title" style="flex: 1; z-index: 2;">
                    <h3>Tambah Karakter Baru</h3>
                    <p>Lengkapi data di bawah untuk menambahkan karakter ke database.</p>
                </div>

                <img src="<?= BASEURL; ?>/img/home/mizuki-hotspring.jpg" 
                     alt="Hero Visual" 
                     style="height: 120px; width: auto; border-radius: 12px; object-fit: cover; margin: 0 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"
                     class="d-none d-md-block">

                <a href="<?= BASEURL; ?>/characters" class="btn-back" style="z-index: 2;">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card-item" style="padding: 32px; background: var(--bg-panel); border-radius: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                
                <form action="<?= BASEURL; ?>/characters/store" method="post" novalidate>
                    
                    <?php require_once __DIR__ . '/form_fields.php'; ?>

                    <div class="form-group" style="margin-top: 32px;">
                        <button type="submit" class="btn-cta" style="width: 100%;">Simpan Data</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>