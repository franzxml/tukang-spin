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
        
        <div style="display: flex; gap: 10px;" id="search-container">
            <input type="text" id="keyword" placeholder="Search by Name..." autocomplete="off" style="padding: 8px 15px; border-radius: 4px; border: 1px solid var(--border-color); background: var(--bg-primary); color: var(--text-primary); outline: none; width: 250px;">

            <a href="<?= BASEURL; ?>/characters/add" class="btn-cta" style="font-size: 0.9rem; margin-top: 0; align-self: center;">+ Add New</a>
        </div>
    </div>

    <div id="character-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 25px;">
        
        <?php 
            // Load the partial view for the initial load
            require_once '../app/views/characters/list.php'; 
        ?>

    </div>
</div>