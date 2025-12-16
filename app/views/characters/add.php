<?php
/**
 * View: Add Character
 * Description: Displays the form to add a new character.
 * Uses a Compact Split Card layout to reduce vertical scrolling.
 *
 * @var array $data Contains title, weapons, artifacts, and other view data.
 */
?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1"> <div class="form-split-card">
                
                <div class="form-split-visual">
                    <img src="<?= BASEURL; ?>/img/home/mizuki-hotspring.jpg" 
                         alt="Visual" 
                         loading="lazy">
                    
                    <a href="<?= BASEURL; ?>/characters" class="visual-back-btn">
                        &larr; Batal
                    </a>
                </div>

                <div class="form-split-content">
                    
                    <div class="form-header-simple">
                        <h2>Tambah Karakter</h2>
                        <p>Masukkan data pahlawan baru.</p>
                    </div>

                    <form action="<?= BASEURL; ?>/characters/store" method="post" autocomplete="off">
                        
                        <?php require_once __DIR__ . '/form_fields.php'; ?>

                        <div class="form-group" style="margin-top: 20px; margin-bottom: 0;">
                            <button type="submit" class="btn-cta btn-black w-100">
                                Simpan Data
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>