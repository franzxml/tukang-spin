<?php
/**
 * Home Index View.
 *
 * @var array $data Passed from controller.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/style.css">
</head>
<body>
    <main class="container">
        <h1><?php echo $data['title']; ?></h1>
        <p><?php echo $data['description']; ?></p>
        <p>Status: Core MVC Operational.</p>
    </main>
    <script src="<?php echo URLROOT; ?>/assets/js/main.js"></script>
</body>
</html>