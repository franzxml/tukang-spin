<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div style="margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 15px;">
        
        <div>
            <h2 style="color: var(--text-secondary);">Character Roster</h2>
            <p style="color: #888; margin: 0;">Manage your owned characters and their meta roles.</p>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <form action="<?= BASEURL; ?>/characters/search" method="POST" style="display: flex;">
                <input type="text" name="keyword" placeholder="Search by Name..." autocomplete="off" style="padding: 8px; border-radius: 4px 0 0 4px; border: 1px solid var(--border-color); background: var(--bg-primary); color: var(--text-primary); outline: none;">
                <button type="submit" style="padding: 8px 15px; background: var(--accent-color); color: white; border: none; border-radius: 0 4px 4px 0; cursor: pointer;">
                    Search
                </button>
            </form>

            <a href="<?= BASEURL; ?>/characters/add" class="btn-cta" style="font-size: 0.9rem; margin-top: 0; align-self: center;">+ Add New</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 25px;">
        
        <?php if (empty($data['characters'])) : ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888;">
                <h3>No characters found.</h3>
                <p>Try searching for a different name or add a new character.</p>
            </div>
        <?php else : ?>

            <?php foreach ($data['characters'] as $char) : ?>
                <div style="background: var(--bg-secondary); border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color); display: flex; flex-direction: column;">
                    
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
                        style="color: #ff4e4e; text-decoration: none; font-size: 0.9rem;"
                        onclick="return confirm('Are you sure you want to delete <?= $char['name']; ?>?');">
                            Delete
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>