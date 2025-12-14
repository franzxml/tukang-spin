<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?> | Genpedia</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/main.css">
</head>
<body>

<header class="main-header">
    <div class="container nav-flex">
        <a href="<?= BASEURL; ?>" class="brand-logo">Genpedia</a>
        <nav>
            <ul class="nav-links">
                <li><a href="<?= BASEURL; ?>">Home</a></li>
                <li><a href="<?= BASEURL; ?>/characters">Characters</a></li>
                <li><a href="#">Weapons</a></li>    <li><a href="#">About</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container">