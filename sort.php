<!-- Form Sort, Order & Filter -->
    <form method="GET" class="mb-3 d-flex align-items-center flex-wrap">
        <input type="text" name="search" class="form-control me-2 mb-2" placeholder="Cari..." value="<?= htmlspecialchars($keyword) ?>">

        <label for="sort" class="me-2 mb-2">Urutkan:</label>
        <select name="sort" id="sort" class="form-select me-2 mb-2" style="width: 200px;">
            <option value="s.nama_siswa" <?= ($sort_column=='s.nama_siswa')?'selected':'' ?>>Nama Murid</option>
            <option value="s.tanggal_lahir" <?= ($sort_column=='s.tanggal_lahir')?'selected':'' ?>>Tanggal Lahir</option>
            <option value="s.tanggal_mulai" <?= ($sort_column=='s.tanggal_mulai')?'selected':'' ?>>Tanggal Mulai</option>
            <option value="s.tanggal_selesai" <?= ($sort_column=='s.tanggal_selesai')?'selected':'' ?>>Tanggal Selesai</option>
            <option value="s.jam" <?= ($sort_column=='s.jam')?'selected':'' ?>>Jam</option>
            <option value="s.hari" <?= ($sort_column=='s.hari')?'selected':'' ?>>Hari</option>
            <option value="t.name" <?= ($sort_column=='t.name')?'selected':'' ?>>Nama Guru</option>
            <option value="d.name" <?= ($sort_column=='d.name')?'selected':'' ?>>Daerah</option>
        </select>

        <?php if(!empty($filter_options)): ?>
            <label for="filter" class="me-2 mb-2">Filter:</label>
            <select name="filter" id="filter" class="form-select me-2 mb-2" style="width: 150px;">
                <option value="">Semua</option>
                <?php foreach($filter_options as $opt): ?>
                    <option value="<?= htmlspecialchars($opt) ?>" <?= ($filter_value==$opt)?'selected':'' ?>><?= htmlspecialchars($opt) ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>

        <select name="order" class="form-select me-2 mb-2" style="width: 120px;">
            <option value="ASC" <?= ($order=='ASC')?'selected':'' ?>>Menaik</option>
            <option value="DESC" <?= ($order=='DESC')?'selected':'' ?>>Menurun</option>
        </select>

        <button type="submit" class="btn btn-primary mb-2">Terapkan</button>
    </form>
