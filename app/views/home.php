<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/components/header.css">
    <link rel="stylesheet" href="/css/components/navigation.css">
    <link rel="stylesheet" href="/css/components/home-content.css">
    <link rel="stylesheet" href="/css/components/hero-section.css">
    <link rel="stylesheet" href="/css/components/footer.css">
</head>
<body>
    <?php include BASE_PATH . '/app/views/components/header.php'; ?>
    
    <main class="home-content">
        <section class="hero-section">
        </section>
    </main>

    <?php include BASE_PATH . '/app/views/components/footer.php'; ?>
    
    <script src="/js/components/navigation.js"></script>
</body>
</html>