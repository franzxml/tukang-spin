<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="header-content">
    <h1>Weapon Archive</h1>
    <a href="<?php echo URLROOT; ?>/weapons/add" class="btn">Add Weapon</a>
</div>

<div class="grid">
    <?php foreach ($data['weapons'] as $w) : ?>
        <div class="card">
            <h3><?php echo $w->name; ?></h3>
            <span class="badge"><?php echo $w->type; ?></span>
            <p><strong>Base ATK:</strong> <?php echo $w->base_atk; ?></p>
            <p><strong>Rarity:</strong> <?php echo $w->rarity; ?> Star</p>
            <p style="font-size:0.9rem; color:#666;"><?php echo $w->description; ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>