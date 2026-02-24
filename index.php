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

$limit = 10; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;

$start = ($page - 1) * $limit;

$keyword = '';
$where = "";

if(isset($_GET['search']) && $_GET['search'] != ''){
    $keyword = $con->real_escape_string($_GET['search']);
    $where = " WHERE s.nama_siswa LIKE '%$keyword%' 
               OR s.jam LIKE '%$keyword%'
               OR s.hari LIKE '%$keyword%'
               OR s.tanggal_mulai LIKE '%$keyword%'
               OR s.tanggal_selesai LIKE '%$keyword%'";
}


$count_sql = "SELECT COUNT(*) as total 
              FROM students s
              LEFT JOIN teachers t ON s.teachers_id = t.id
              LEFT JOIN daerah d ON s.daerah_id = d.id
              $where";

$count_result = $con->query($count_sql);
$total_data = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit);

$sql = "SELECT 
            s.id, s.nama_siswa, s.nama_ortu, s.tanggal_lahir, s.alamat, s.active, 
            s.tanggal_mulai, s.tanggal_selesai, s.jam, s.hari, 
            t.name AS teachers_name, d.name AS daerah_name
        FROM students s
        LEFT JOIN teachers t ON s.teachers_id = t.id
        LEFT JOIN daerah d ON s.daerah_id = d.id
        $where
        ORDER BY s.id DESC
        LIMIT $start, $limit";

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

<?php include "navigation.php"; ?>    
	
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

    <!-- Pagination -->
    <?php if($total_pages > 1): ?>
    <nav>
        <ul class="pagination justify-content-center mt-4">
            
            <!-- Previous -->
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" 
                   href="?page=<?= $page-1 ?>&search=<?= urlencode($keyword) ?>">Previous</a>
            </li>

            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" 
                       href="?page=<?= $i ?>&search=<?= urlencode($keyword) ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <!-- Next -->
            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                <a class="page-link" 
                   href="?page=<?= $page+1 ?>&search=<?= urlencode($keyword) ?>">Next</a>
            </li>

        </ul>
    </nav>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>