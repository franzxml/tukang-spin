<section class="hero-section">
    <h1 class="hero-title">Selamat Datang di Genpedia</h1>
    <p>Database pribadi untuk manajemen build Genshin Impact.</p>
    <p>Kelola tim, senjata, dan artefak Anda dengan efisiensi maksimal.</p>
    
    <a href="<?= BASEURL; ?>/characters" class="btn-cta" style="margin-top: 20px;">Mulai Kelola</a>
</section>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
    
    <div style="background: var(--bg-card); padding: 30px; border-radius: 18px; border: 1px solid var(--border-subtle); text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h3 style="color: var(--text-secondary); font-size: 1rem; text-transform: uppercase; margin-bottom: 10px;">Total Karakter</h3>
        <p style="font-size: 3.5rem; font-weight: 700; color: var(--text-primary); line-height: 1;">
            <?= $data['total_characters']; ?>
        </p>
        <p style="color: var(--accent-blue); font-size: 0.9rem; margin-top: 10px;">Terdaftar di database</p>
    </div>

</div>