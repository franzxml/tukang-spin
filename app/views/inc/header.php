<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($data['title']) ? $data['title'] : SITENAME; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/layout.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/cards.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/forms.css">
</head>
<body>
    <nav class="navbar">
        <div class="container nav-flex">
            <a href="<?php echo URLROOT; ?>" class="brand"><?php echo SITENAME; ?></a>
            <ul>
                <li><a href="<?php echo URLROOT; ?>">Home</a></li>
                <li><a href="<?php echo URLROOT; ?>/characters">Characters</a></li>
            </ul>
        </div>
    </nav>
    <main>