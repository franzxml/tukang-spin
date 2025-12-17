<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Weapon</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/components/header.css">
    <link rel="stylesheet" href="/css/components/navigation.css">
    <link rel="stylesheet" href="/css/components/weapon-content.css">
    <link rel="stylesheet" href="/css/components/hero-section.css">
    <link rel="stylesheet" href="/css/components/button.css">
    <link rel="stylesheet" href="/css/components/footer.css">
</head>
<body>
    <?php include BASE_PATH . '/app/views/components/header.php'; ?>
    
    <main class="weapon-content">
        <section class="hero-section">
            <div class="hero-image">
                <img src="/images/hero2.png" alt="Weapon Hero" class="hero-img">
            </div>
            <div class="hero-content">
                <h1 class="hero-title">Weapon Database</h1>
                <p class="hero-description">Explore all weapons in Genshin Impact.</p>
                <button class="btn btn-primary">Add Weapon</button>
            </div>
        </section>
    </main>

    <?php include BASE_PATH . '/app/views/components/footer.php'; ?>
    
    <script src="/js/components/navigation.js"></script>
    <script src="/js/components/hover-navigation.js"></script>
</body>
</html>