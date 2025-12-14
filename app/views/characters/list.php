<?php 
/**
 * Partial View: Character List Grid
 * This file renders only the character cards. 
 * It is used by the Index view and the AJAX Search response.
 */
?>

<?php if (empty($data['characters'])) : ?>
    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888;">
        <h3>No characters found.</h3>
        <p>Try searching for a different name or add a new character.</p>
    </div>
<?php else : ?>

    <?php foreach ($data['characters'] as $char) : ?>
        <div class="character-card" style="background: var(--bg-secondary); border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color); display: flex; flex-direction: column;">
            
            <div style="height: 250px; overflow: hidden; position: relative;">
                <img src="<?= $char['image_url']; ?>" alt="<?= $char['name']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                
                <span style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: gold; padding: 2px 8px; border-radius: 4px; font-weight: bold;">
                    <?= $char['rarity']; ?>★
                </span>
            </div>

            <div style="padding: 15px; flex-grow: 1;">
                <h3 style="color: var(--text-primary); font-size: 1.1rem; margin-bottom: 5px;"><?= $char['name']; ?></h3>
                
                <div style="display: flex; gap: 10px; font-size: 0.85rem; margin-bottom: 10px;">
                    <span style="color: var(--accent-color);"><?= $char['element']; ?></span>
                    <span style="color: #888;">•</span>
                    <span style="color: #ccc;"><?= $char['weapon_type']; ?></span>
                </div>

                <div style="background: rgba(0,0,0,0.2); padding: 5px 10px; border-radius: 4px; font-size: 0.8rem; color: var(--text-secondary); text-align: center;">
                    <?= $char['role']; ?>
                </div>
            </div>

            <div style="padding: 10px 15px; background: rgba(0,0,0,0.2); border-top: 1px solid var(--border-color); display: flex; justify-content: space-between;">
                <a href="<?= BASEURL; ?>/characters/edit/<?= $char['id']; ?>" style="color: #aaa; text-decoration: none; font-size: 0.9rem; transition: color 0.2s;">Edit</a>
                
                <a href="<?= BASEURL; ?>/characters/delete/<?= $char['id']; ?>" 
                   class="delete-btn"
                   data-name="<?= $char['name']; ?>"
                   style="color: #ff4e4e; text-decoration: none; font-size: 0.9rem;">
                    Delete
                </a>
            </div>
        </div>
    <?php endforeach; ?>

<?php endif; ?>