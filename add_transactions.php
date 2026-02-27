<?php
include "config.php";

// Ambil data master untuk select option
$students = $con->query("SELECT * FROM students");
$pembayaran = $con->query("SELECT * FROM pembayaran");
$bulan = $con->query("SELECT * FROM bulan");

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $students_id = $_POST['students_id'];
    $pembayaran_id = $_POST['pembayaran_id'];
    $bulan_id = $_POST['bulan_id'];
    $no_rekening = $_POST['no_rekening'];
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    $stmt = $con->prepare("INSERT INTO transaksi (students_id, pembayaran_id, bulan_id, no_rekening, tanggal_pembayaran, nominal, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiissds", $students_id, $pembayaran_id, $bulan_id, $no_rekening, $tanggal_pembayaran, $nominal, $keterangan);
    $stmt->execute();
    $stmt->close();

    echo "<div class='alert alert-success'>Transaksi berhasil disimpan!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        body { padding-top: 70px; padding-bottom: 90px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Form Transaksi</h2>

    <?php include "navigation.php"; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Siswa</label>
            <select name="students_id" class="form-select" required>
                <option value="" disabled selected>Pilih Siswa</option>
                <?php while($row = $students->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Bank / Wallet</label>
            <select name="pembayaran_id" class="form-select" required>
                <option value="" disabled selected>Pilih Metode</option>
                <?php while($row = $pembayaran->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Bulan</label>
            <select name="bulan_id" class="form-select" required>
                <option value="" disabled selected>Pilih Bulan</option>
                <?php while($row = $bulan->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>



        <div class="mb-3">
            <label class="form-label">No Rekening</label>
            <input type="number" name="no_rekening" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Bayar</label>
            <input type="date" name="tanggal_pembayaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
            <a href="transactions.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>