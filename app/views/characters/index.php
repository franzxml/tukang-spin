<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row header-row">
        <h1>Genpedia Archive</h1>
        <a href="<?php echo URLROOT; ?>/characters/add" class="btn">Add Character</a>
    </div>

    <div class="grid">
        <?php foreach($data['characters'] as $char) : ?>
            <div class="card">
                <a href="<?php echo URLROOT; ?>/characters/show/<?php echo $char->id; ?>" class="card-content-link">
                    <h3><?php echo $char->name; ?></h3>
                    <p><strong>Weapon:</strong> <?php echo $char->weapon; ?></p>
                    <p><strong>Level:</strong> <?php echo $char->level; ?></p>
                </a>

                <div class="card-actions">
                    <a href="<?php echo URLROOT; ?>/characters/edit/<?php echo $char->id; ?>" class="btn-sm">Edit</a>
                    <form action="<?php echo URLROOT; ?>/characters/delete/<?php echo $char->id; ?>" method="POST" class="inline-form">
                        <input type="submit" value="Delete" class="btn-sm btn-danger">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>