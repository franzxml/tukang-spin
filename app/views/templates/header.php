<?php
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
        
        <nav class="nav-container">
            <ul class="nav-links">
                <div class="nav-marker"></div>

                <li>
                    <a href="<?= BASEURL; ?>" 
                       class="<?= (strpos($uri, '/characters') === false && strpos($uri, '/weapons') === false && strpos($uri, '/artifacts') === false) ? 'active' : ''; ?>"
                       data-title="Beranda"
                       data-desc="Ringkasan koleksi dan statistik akun."
                       data-img="<?= BASEURL; ?>/img/ui/logo-genpedia.png">
                       Beranda
                    </a>
                </li>
                <li>
                    <a href="<?= BASEURL; ?>/characters" 
                       class="<?= (strpos($uri, '/characters') !== false) ? 'active' : ''; ?>"
                       data-title="Karakter"
                       data-desc="Kelola build hero, talenta, dan level."
                       data-img="<?= BASEURL; ?>/img/home/summer-resort.jpg">
                       Karakter
                    </a>
                </li>
                <li>
                    <a href="<?= BASEURL; ?>/weapons" 
                       class="<?= (strpos($uri, '/weapons') !== false) ? 'active' : ''; ?>"
                       data-title="Senjata"
                       data-desc="Gudang senjata dan statistik equipment."
                       data-img="<?= BASEURL; ?>/img/home/adventurers-trails.jpg">
                       Senjata
                    </a>
                </li>
                <li>
                    <a href="<?= BASEURL; ?>/artifacts" 
                       class="<?= (strpos($uri, '/artifacts') !== false) ? 'active' : ''; ?>"
                       data-title="Artefak"
                       data-desc="Katalog set artefak dan bonus efek."
                       data-img="<?= BASEURL; ?>/img/home/4.5-wallpapers.png">
                       Artefak
                    </a>
                </li>
            </ul>

            <div class="nav-preview-card" id="navPreview">
                <div class="preview-content">
                    <img src="" alt="Preview" class="preview-image" id="previewImg">
                    <div class="preview-text">
                        <h4 id="previewTitle">Judul</h4>
                        <p id="previewDesc">Deskripsi halaman.</p>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<main class="container">