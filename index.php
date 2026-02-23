<?php
session_start();
error_reporting(E_ALL);

if(!isset($_SESSION['login'])){
    header("location:login.php");
    exit;
}

$con = mysqli_connect("localhost","root","","YPDC");
if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_error();
    exit;
}

$keyword = '';
if(isset($_GET['search'])){
    $keyword = $con->real_escape_string($_GET['search']);
}

$sql = "SELECT 
            s.id, s.nama_siswa, s.nama_ortu, s.tanggal_lahir, s.alamat, s.active, 
            s.tanggal_mulai, s.tanggal_selesai, s.jam, s.hari, 
            t.name AS teachers_name, d.name AS daerah_name
        FROM students s
        LEFT JOIN teachers t ON s.teachers_id = t.id
        LEFT JOIN daerah d ON s.daerah_id = d.id";

if($keyword != ''){
    $sql .= " WHERE s.nama_siswa LIKE '%$keyword%' 
               OR s.jam LIKE '%$keyword%'
               OR s.hari LIKE '%$keyword%'
               OR s.tanggal_mulai LIKE '%$keyword%'
               OR s.tanggal_selesai LIKE '%$keyword%'";
}

$sql .= " ORDER BY s.id";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>YPDC Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { padding-top: 70px; }
    .table-responsive { max-height: 70vh; overflow-y: auto; }
</style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">YPDC Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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

<div class="container-fluid mt-4">
    <h1 class="mb-4">Daftar Murid</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Murid</th>
                    <th>Nama Orang Tua</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Aktif</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Jam</th>
                    <th>Hari</th>
                    <th>Daerah</th>
                    <th>Teachers</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nama_ortu'] ?></td>
                        <td><?= $row['tanggal_lahir'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td class="text-center"><?= $row['active'] ? 'Ya' : 'Tidak' ?></td>
                        <td><?= $row['tanggal_mulai'] ?></td>
                        <td><?= $row['tanggal_selesai'] ?></td>
                        <td><?= $row['jam'] ?></td>
                        <td><?= $row['hari'] ?></td>
                        <td><?= $row['daerah_name'] ?></td>
                        <td><?= $row['teachers_name'] ?></td>
                        <td class="text-center">
                            <a href="edit_student.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_student.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="13" class="text-center">Tidak ada data</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
