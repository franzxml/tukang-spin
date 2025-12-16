<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <a href="<?php echo URLROOT; ?>/characters" class="back-link">Back to Archive</a>
    
    <div class="card detail-card">
        <h1><?php echo $data['character']->name; ?></h1>
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Element:</strong> <?php echo $data['character']->element; ?>
            </div>
            <div class="detail-item">
                <strong>Weapon:</strong> <?php echo $data['character']->weapon; ?>
            </div>
            <div class="detail-item">
                <strong>Region:</strong> <?php echo $data['character']->region; ?>
            </div>
            <div class="detail-item">
                <strong>Rarity:</strong> 
                <span class="rarity star-<?php echo $data['character']->rarity; ?>">
                    <?php echo $data['character']->rarity; ?> Stars
                </span>
            </div>
        </div>
        
        <hr class="divider">
        <div class="actions">
            <a href="<?php echo URLROOT; ?>/characters/edit/<?php echo $data['character']->id; ?>" class="btn">Edit Character</a>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>