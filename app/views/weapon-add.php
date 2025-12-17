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
        <section class="hero-section hero-section-form-single">
            <div class="hero-image">
                <img src="/images/hero3.png" alt="Add Weapon" class="hero-img">
            </div>
            <div class="hero-content">
                <h1 class="hero-title">Add New Weapon</h1>
                <p class="hero-description">Fill in the weapon details below.</p>
                
                <form class="weapon-form" method="POST" action="/weapon/store">
                    <div class="form-section">
                        <h3 class="form-section-title">Basic Information</h3>
                        
                        <div class="form-group">
                            <label for="weaponName" class="form-label">Weapon Name</label>
                            <input type="text" id="weaponName" name="weaponName" class="form-input" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="weaponType" class="form-label">Type</label>
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
                                <label for="weaponStar" class="form-label">Rarity</label>
                                <select id="weaponStar" name="weaponStar" class="form-input" required>
                                    <option value="">Select</option>
                                    <option value="3">⭐⭐⭐</option>
                                    <option value="4">⭐⭐⭐⭐</option>
                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3 class="form-section-title">Stats</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="weaponBaseAtk" class="form-label">Base ATK</label>
                                <input type="number" id="weaponBaseAtk" name="weaponBaseAtk" class="form-input" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="weaponLevel" class="form-label">Level</label>
                                <input type="number" id="weaponLevel" name="weaponLevel" class="form-input" min="1" max="90" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="refinementRank" class="form-label">Refinement</label>
                                <select id="refinementRank" name="refinementRank" class="form-input" required>
                                    <option value="">Select</option>
                                    <option value="1">R1</option>
                                    <option value="2">R2</option>
                                    <option value="3">R3</option>
                                    <option value="4">R4</option>
                                    <option value="5">R5</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="weaponSubStat" class="form-label">Sub-stat Bonus</label>
                            <select id="weaponSubStat" name="weaponSubStat" class="form-input" required>
                                <option value="">Select Sub-stat</option>
                                <option value="ATK%">ATK%</option>
                                <option value="DEF%">DEF%</option>
                                <option value="HP%">HP%</option>
                                <option value="CDM%">CRIT DMG%</option>
                                <option value="CR%">CRIT Rate%</option>
                                <option value="EM">Elemental Mastery</option>
                                <option value="ER%">Energy Recharge%</option>
                                <option value="Physical DMG Bonus%">Physical DMG Bonus%</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3 class="form-section-title">Passive Ability</h3>
                        
                        <div class="form-group">
                            <label for="weaponPassiveName" class="form-label">Passive Name</label>
                            <input type="text" id="weaponPassiveName" name="weaponPassiveName" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="weaponPassiveDesc" class="form-label">Passive Description</label>
                            <textarea id="weaponPassiveDesc" name="weaponPassiveDesc" class="form-input form-textarea" rows="3" required></textarea>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3 class="form-section-title">Lore</h3>
                        
                        <div class="form-group">
                            <label for="weaponSummary" class="form-label">Summary</label>
                            <textarea id="weaponSummary" name="weaponSummary" class="form-input form-textarea" rows="2" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="weaponStory" class="form-label">Full Story</label>
                            <textarea id="weaponStory" name="weaponStory" class="form-input form-textarea" rows="4" required></textarea>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3 class="form-section-title">Media</h3>
                        
                        <div class="form-group">
                            <label for="weaponPicture" class="form-label">Weapon Image URL</label>
                            <input type="url" id="weaponPicture" name="weaponPicture" class="form-input" placeholder="https://example.com/weapon.png" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">Add Weapon</button>
                </form>
            </div>
        </section>
    </main>

    <?php include BASE_PATH . '/app/views/components/footer.php'; ?>
    
    <script src="/js/components/navigation.js"></script>
    <script src="/js/components/hover-navigation.js"></script>
</body>
</html>