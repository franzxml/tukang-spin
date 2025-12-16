<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="header-content">
    <h1><?php echo $data['title']; ?></h1>
    <a href="<?php echo URLROOT; ?>/characters/add" class="btn">Add Character</a>
</div>

<form action="<?php echo URLROOT; ?>/search" method="GET" style="margin-bottom: 20px;">
    <input type="text" name="q" placeholder="Search by name or element..." 
           style="padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 4px;">
</form>

<div class="grid">
    <?php if(empty($data['characters'])): ?>
        <p>No characters found.</p>
    <?php else: ?>
        <?php foreach ($data['characters'] as $char) : ?>
            <div class="card">
                <h3><?php echo $char->name; ?></h3>
                <span class="badge"><?php echo $char->element; ?></span>
                <p><strong>Weapon:</strong> <?php echo $char->weapon; ?></p>
                <p><strong>Rarity:</strong> <?php echo $char->rarity; ?> Star</p>
                <a href="<?php echo URLROOT; ?>/edit/index/<?php echo $char->id; ?>" 
                   style="display:block; margin-top:10px; color:#333;">Edit</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>