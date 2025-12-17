<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Add Weapon</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/components/header.css">
    <link rel="stylesheet" href="/css/components/navigation.css">
    <link rel="stylesheet" href="/css/components/weapon-add-content.css">
    <link rel="stylesheet" href="/css/components/hero-section.css">
    <link rel="stylesheet" href="/css/components/form.css">
    <link rel="stylesheet" href="/css/components/button.css">
    <link rel="stylesheet" href="/css/components/footer.css">
</head>
<body>
    <?php include BASE_PATH . '/app/views/components/header.php'; ?>
    
    <main class="weapon-add-content">
        <section class="hero-section hero-section-form">
            <div class="hero-image">
                <img src="/images/hero3.png" alt="Add Weapon" class="hero-img">
            </div>
            <div class="hero-content">
                <h1 class="hero-title">Add New Weapon</h1>
                <form class="weapon-form" method="POST" action="/weapon/store">
                    <div class="form-group">
                        <label for="weaponName" class="form-label">Weapon Name</label>
                        <input type="text" id="weaponName" name="weaponName" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="weaponType" class="form-label">Weapon Type</label>
                        <select id="weaponType" name="weaponType" class="form-input" required>
                            <option value="">Select Type</option>
                            <option value="Bow">Bow</option>
                            <option value="Catalyst">Catalyst</option>
                            <option value="Claymore">Claymore</option>
                            <option value="Polearm">Polearm</option>
                            <option value="Sword">Sword</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="weaponBaseAtk" class="form-label">Weapon Base ATK</label>
                        <input type="number" id="weaponBaseAtk" name="weaponBaseAtk" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="weaponSubStat" class="form-label">Weapon Sub-stat Bonus</label>
                        <select id="weaponSubStat" name="weaponSubStat" class="form-input" required>
                            <option value="">Select Sub-stat</option>
                            <option value="ATK%">ATK%</option>
                            <option value="DEF%">DEF%</option>
                            <option value="HP%">HP%</option>
                            <option value="CDM%">CDM%</option>
                            <option value="CR%">CR%</option>
                            <option value="EM">EM</option>
                            <option value="ER%">ER%</option>
                            <option value="Physical DMG Bonus%">Physical DMG Bonus%</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </main>

    <?php include BASE_PATH . '/app/views/components/footer.php'; ?>
    
    <script src="/js/components/navigation.js"></script>
    <script src="/js/components/hover-navigation.js"></script>
</body>
</html>