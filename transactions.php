<?php
include 'config.php';

// Query transaksi lengkap dengan join ke master table
$sql = "SELECT 
            tr.id,
            tr.students_id,
            s.nama_siswa AS nama_siswa,
            tr.pembayaran_id,
            p.name AS nama_pembayaran,
            tr.bulan_id,
            b.name AS nama_bulan,
            tr.no_rekening,
            tr.tanggal_pembayaran,
            tr.nominal,
            tr.keterangan
        FROM transaksi tr
        JOIN students s ON tr.students_id = s.id
        JOIN pembayaran p ON tr.pembayaran_id = p.id
        JOIN bulan b ON tr.bulan_id = b.id
        ORDER BY tr.id DESC";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi Lengkap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body { padding-top: 70px; padding-bottom: 90px; }
    </style>
</head>
<body>

<?php include "navigation.php"; ?>

<div class="container mt-4">
    <h2>Riwayat Transaksi Lengkap</h2>

    <!-- Tombol Tambah Transaksi & Kembali -->
    <div class="mb-3 d-flex gap-2">
        <a href="add_transactions.php" class="btn btn-primary">Tambah Transaksi</a>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Siswa</th>
                    <th>Pembayaran ID</th>
                    <th>Nama Bank / Wallet</th>
                    <th>Bulan ID</th>
                    <th>Nama Bulan</th>
                    <th>No Rekening</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nama_siswa'] ?></td>
                            <td><?= $row['pembayaran_id'] ?></td>
                            <td><?= $row['nama_pembayaran'] ?></td>
                            <td><?= $row['bulan_id'] ?></td>
                            <td><?= $row['nama_bulan'] ?></td>
                            <td><?= $row['no_rekening'] ?></td>
                            <td><?= date("d-m-Y", strtotime($row['tanggal_pembayaran'])) ?></td>
                            <td><?= number_format($row['nominal'],0,',','.') ?></td>
                            <td><?= $row['keterangan'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center">Belum ada transaksi</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>