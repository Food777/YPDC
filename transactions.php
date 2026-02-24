<?php
include 'config.php';
$sql = "SELECT tr.id, s.nama_siswa, b.name AS bulan, p.name AS pembayaran, tr.tanggal_pembayaran
        FROM transaksi tr
        JOIN students s ON tr.students_id = s.id
        JOIN bulan b ON tr.bulan_id = b.id
        JOIN pembayaran p ON tr.pembayaran_id = p.id
        ORDER BY tr.id DESC";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<style>
    body { padding-top: 70px; }
</style>
<body>

<?php include "navigation.php"; ?>

<div class="container mt-4">
    <h2>Riwayat Transaksi</h2>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Murid</th>
                <th>Bulan</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama_siswa'] ?></td>
                <td><?= $row['bulan'] ?></td>
                <td><?= $row['pembayaran'] ?></td>
                <td><?= $row['tanggal_pembayaran'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
