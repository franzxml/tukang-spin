<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Genpedia' ?></title>
    
    <?php if (isset($css)): ?>
        <link rel="stylesheet" href="/css/<?= $css ?>.css">
    <?php endif; ?>
    
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; }
        .container { padding: 20px; max-width: 1200px; margin: 0 auto; }
    </style>
</head>
<body>