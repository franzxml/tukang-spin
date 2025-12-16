<?php
/**
 * View: Add Character
 * Description: Displays the form to add a new character.
 * Uses a Split Card layout (Image Left, Form Right) to match the homepage aesthetic.
 *
 * @var array $data Contains title, weapons, artifacts, and other view data.
 */
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <div class="form-split-card">
                
                <div class="form-split-visual">
                    <img src="<?= BASEURL; ?>/img/home/mizuki-hotspring.jpg" 
                         alt="New Character Banner" 
                         loading="lazy">
                    
                    <a href="<?= BASEURL; ?>/characters" class="visual-back-btn">
                        &larr; Kembali
                    </a>
                </div>

                <div class="form-split-content">
                    
                    <div class="form-header-simple">
                        <h2>Tambah Karakter</h2>
                        <p>Lengkapi identitas, atribut, dan relasi untuk mendaftarkan pahlawan baru ke database.</p>
                    </div>

                    <form action="<?= BASEURL; ?>/characters/store" method="post" autocomplete="off">
                        
                        <?php require_once __DIR__ . '/form_fields.php'; ?>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn-cta btn-black w-100">
                                Simpan Karakter
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>