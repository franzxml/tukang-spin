<?php
// Deteksi URL saat ini untuk menentukan menu yang aktif
$uri = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?> | Genpedia</title>
    
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/main.css">
</head>
<body>

<header class="main-header">
    <div class="container nav-flex">
        <a href="<?= BASEURL; ?>" class="brand-logo">
            <img src="<?= BASEURL; ?>/img/ui/logo-genpedia.png" alt="Genpedia Logo">
        </a>
        
        <nav>
            <ul class="nav-links">
                <li>
                    <a href="<?= BASEURL; ?>" 
                       class="<?= (strpos($uri, '/characters') === false && strpos($uri, '/weapons') === false && strpos($uri, '/artifacts') === false) ? 'active' : ''; ?>">
                       Beranda
                    </a>
                </li>
                <li>
                    <a href="<?= BASEURL; ?>/characters" 
                       class="<?= (strpos($uri, '/characters') !== false) ? 'active' : ''; ?>">
                       Karakter
                    </a>
                </li>
                <li>
                    <a href="<?= BASEURL; ?>/weapons" 
                       class="<?= (strpos($uri, '/weapons') !== false) ? 'active' : ''; ?>">
                       Senjata
                    </a>
                </li>
                <li>
                    <a href="<?= BASEURL; ?>/artifacts" 
                       class="<?= (strpos($uri, '/artifacts') !== false) ? 'active' : ''; ?>">
                       Artefak
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="container">