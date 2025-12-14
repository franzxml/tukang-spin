<div class="container">
    <div class="row"><div class="col-lg-12"><?php Flasher::flash(); ?></div></div>

    <div style="margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="color: var(--text-secondary);">Koleksi Artefak</h2>
            <p style="color: #888; margin: 0;">Database set artefak dan efek bonusnya.</p>
        </div>
        <a href="<?= BASEURL; ?>/artifacts/add" class="btn-cta" style="font-size: 0.9rem;">+ Tambah Set</a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px;">
        <?php foreach ($data['artifacts'] as $art) : ?>
            <div style="background: var(--bg-secondary); border-radius: 8px; border: 1px solid var(--border-color); display: flex; overflow: hidden; min-height: 140px; position: relative;">
                <div style="width: 100px; background: #202028; display: flex; align-items: center; justify-content: center;">
                    <img src="<?= $art['image_url']; ?>" alt="<?= $art['name']; ?>" style="width: 80%; height: 80%; object-fit: contain;">
                </div>
                <div style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: center;">
                    <h4 style="color: var(--text-primary); margin: 0 0 8px 0; font-size: 1rem;"><?= $art['name']; ?></h4>
                    
                    <div style="font-size: 0.8rem; margin-bottom: 5px;">
                        <span style="color: var(--accent-color); font-weight: 600;">2pc:</span> 
                        <span style="color: #ccc;"><?= $art['bonus_2pc']; ?></span>
                    </div>
                    <div style="font-size: 0.8rem; line-height: 1.3;">
                        <span style="color: var(--text-secondary); font-weight: 600;">4pc:</span> 
                        <span style="color: #888;"><?= mb_strimwidth($art['bonus_4pc'], 0, 80, '...'); ?></span>
                    </div>

                    <a href="<?= BASEURL; ?>/artifacts/delete/<?= $art['id']; ?>" onclick="return confirm('Hapus set ini?');" style="position: absolute; top: 5px; right: 10px; color: var(--danger-color);">&times;</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>