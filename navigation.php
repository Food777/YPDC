<?php
    $keyword = $keyword ?? '';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">YPDC Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Halaman Utama</a></li>
                <li class="nav-item"><a class="nav-link" href="add_student.php">Tambah Murid</a></li>
                <li class="nav-item"><a class="nav-link" href="add_class.php">Naik Kelas</a></li>
                <li class="nav-item"><a class="nav-link" href="transactions.php">Transaksi</a></li>
            </ul>
            <form class="d-flex" method="GET" action="index.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Cari murid, jam, hari, tanggal" value="<?= htmlspecialchars($keyword) ?>" style="width: 250px;">
                <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>
        </div>
    </div>
</nav>