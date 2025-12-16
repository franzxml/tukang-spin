<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <a href="<?php echo URLROOT; ?>/characters" class="back-link">Back to Archive</a>
    
    <div class="card detail-card" style="overflow: hidden;">
        <?php if($data['character']->namecard): ?>
            <div style="height: 150px; background: url('<?php echo $data['character']->namecard; ?>') center/cover; margin: -40px -40px 20px -40px;"></div>
        <?php endif; ?>

        <div style="display: flex; align-items: center; gap: 20px;">
            <?php if($data['character']->icon): ?>
                <img src="<?php echo $data['character']->icon; ?>" alt="Icon" style="width: 80px; height: 80px; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
            <?php endif; ?>
            <h1><?php echo $data['character']->name; ?></h1>
        </div>

        <div class="detail-grid">
            <div class="detail-item"><strong>Weapon:</strong> <?php echo $data['character']->weapon; ?></div>
            <div class="detail-item"><strong>Level:</strong> Lv. <?php echo $data['character']->level; ?></div>
            <div class="detail-item"><strong>Talents:</strong> <?php echo $data['character']->talents_level; ?></div>
        </div>
        
        <hr class="divider">
        <div class="actions row">
            <a href="<?php echo URLROOT; ?>/characters/edit/<?php echo $data['character']->id; ?>" class="btn">Edit</a>
            <form action="<?php echo URLROOT; ?>/characters/delete/<?php echo $data['character']->id; ?>" method="POST">
                <input type="submit" value="Delete Character" class="btn btn-danger">
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>