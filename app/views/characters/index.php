<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row header-row">
        <h1>Genpedia Archive</h1>
        <a href="<?php echo URLROOT; ?>/characters/add" class="btn">Add Character</a>
    </div>

    <div class="grid">
        <?php foreach($data['characters'] as $char) : ?>
            <div class="card">
                <h3>
                    <a href="<?php echo URLROOT; ?>/characters/show/<?php echo $char->id; ?>" class="card-link">
                        <?php echo $char->name; ?>
                    </a>
                </h3>
                <p><strong>Element:</strong> <?php echo $char->element; ?></p>
                <p><strong>Weapon:</strong> <?php echo $char->weapon; ?></p>
                <p><strong>Region:</strong> <?php echo $char->region; ?></p>
                <span class="rarity star-<?php echo $char->rarity; ?>">
                    <?php echo $char->rarity; ?> Stars
                </span>
                <div class="card-actions" style="margin-top: 15px;">
                    <a href="<?php echo URLROOT; ?>/characters/edit/<?php echo $char->id; ?>" class="btn-sm">Edit</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>