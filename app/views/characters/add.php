<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="content-header" style="align-items: flex-start;">
                <div class="content-title">
                    <h3>Tambah Karakter Baru</h3>
                    <p>Lengkapi data di bawah untuk menambahkan karakter ke database.</p>
                </div>
                <a href="<?= BASEURL; ?>/characters" class="btn-back">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card-item" style="padding: 32px; background: var(--bg-panel); border-radius: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                
                <form action="<?= BASEURL; ?>/characters/store" method="post" enctype="multipart/form-data" novalidate>
                    
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Karakter</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Isi nama karakter..." required autocomplete="off">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="element" class="form-label">Elemen</label>
                                <select class="form-select" id="element" name="element" required>
                                    <option value="" disabled selected>Pilih elemen...</option>
                                    <option value="Anemo">Anemo</option>
                                    <option value="Geo">Geo</option>
                                    <option value="Electro">Electro</option>
                                    <option value="Dendro">Dendro</option>
                                    <option value="Hydro">Hydro</option>
                                    <option value="Pyro">Pyro</option>
                                    <option value="Cryo">Cryo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="weapon_type" class="form-label">Tipe Senjata</label>
                                <select class="form-select" id="weapon_type" name="weapon_type" required>
                                    <option value="" disabled selected>Pilih tipe senjata...</option>
                                    <option value="Sword">Sword</option>
                                    <option value="Claymore">Claymore</option>
                                    <option value="Polearm">Polearm</option>
                                    <option value="Bow">Bow</option>
                                    <option value="Catalyst">Catalyst</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rarity" class="form-label">Rarity (Bintang)</label>
                                <select class="form-select" id="rarity" name="rarity" required>
                                    <option value="4">4-Star</option>
                                    <option value="5">5-Star</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region" class="form-label">Region</label>
                                <input type="text" class="form-control" id="region" name="region" placeholder="Isi region..." required autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weapon_id" class="form-label">Rekomendasi Senjata</label>
                        <select class="form-select" id="weapon_id" name="weapon_id">
                            <option value="" selected>Pilih senjata...</option>
                            <?php foreach ($data['weapons'] as $weapon) : ?>
                                <option value="<?= $weapon['id']; ?>"><?= $weapon['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="artifact_id" class="form-label">Rekomendasi Artefak</label>
                        <select class="form-select" id="artifact_id" name="artifact_id">
                            <option value="" selected>Pilih artefak...</option>
                            <?php foreach ($data['artifacts'] as $artifact) : ?>
                                <option value="<?= $artifact['id']; ?>"><?= $artifact['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Isi deskripsi karakter..." rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Gambar Karakter</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <div class="form-group" style="margin-top: 32px;">
                        <button type="submit" class="btn-cta" style="width: 100%;">Simpan Data</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>