<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="header-content">
    <h1><?php echo $data['title']; ?></h1>
    <a href="<?php echo URLROOT; ?>/characters/add" class="btn">Add Character</a>
</div>

<div class="grid">
    <?php foreach ($data['characters'] as $char) : ?>
        <div class="card">
            <h3><?php echo $char->name; ?></h3>
            <span class="badge"><?php echo $char->element; ?></span>
            <p><strong>Weapon:</strong> <?php echo $char->weapon; ?></p>
            <p><strong>Rarity:</strong> <?php echo $char->rarity; ?> Star</p>
            <p><strong>Region:</strong> <?php echo $char->region; ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>