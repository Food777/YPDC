<?php
session_start();
error_reporting(E_ALL);

if(isset($_SESSION['login']) == false){
	header("location:login.php");
	exit;
}

// koneksi database
$con = mysqli_connect("localhost","root","","YPDC");
if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_error();
}

// Ambil data murid + kelas aktif
$sql = "SELECT s.id, s.nama_siswa, t.name AS teacher, k.name AS kelas
        FROM students s
        LEFT JOIN teachers t ON s.teachers_id = t.id
        LEFT JOIN student_class sc ON s.id = sc.student_id AND sc.tanggal_selesai IS NULL
        LEFT JOIN kelas k ON sc.class_id = k.id
        ORDER BY s.id";
$sql.="SELECT id, nama_siswa, nama_ortu, tanggal_lahir, alamat, teachers_id, active 
        FROM students ORDER BY id";

// Ambil semua murid dari tabel students
$sql = "SELECT id, nama_siswa, nama_ortu, tanggal_lahir, alamat, teachers_id, active 
        FROM students ORDER BY id";
$result = $con->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YPDC Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Daftar Murid</h1>
    <div class="mb-3">
        <a href="add_student.php" class="btn btn-primary">Tambah Murid</a>
        <a href="add_class.php" class="btn btn-success">Naik Kelas</a>
        <a href="transactions.php" class="btn btn-info">Transaksi</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Murid</th>
                <th>Nama Orang Tua</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama_siswa'] ?></td>
                <td><?= $row['nama_ortu'] ?></td>
                <td><?= $row['tanggal_lahir'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['active'] ? 'Ya' : 'Tidak' ?></td>
                <td>
                	<a href="edit_student.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                	<a href="delete_student.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
				</td>

            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
