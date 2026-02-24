<?php
include 'config.php';

// Ambil daftar teacher dan daerah
$teachers = $con->query("SELECT * FROM teachers");
$daerahs = $con->query("SELECT * FROM daerah");
$parents = $con->query("SELECT DISTINCT nama_ortu FROM students");

if(isset($_POST['submit'])){
    $nama = $_POST['nama_siswa'];
    $ortu = $_POST['nama_ortu'];
    $tgl_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $teacher_id = $_POST['teachers_id'];
    $active = isset($_POST['active']) ? 1 : 0;
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $jam = $_POST['jam'];
    $hari = $_POST['hari'];
    $daerah_id = $_POST['daerah_id'];

    // Insert student
    $sql = "INSERT INTO students 
            (nama_siswa, nama_ortu, tanggal_lahir, alamat, teachers_id, active, tanggal_mulai, tanggal_selesai, jam, hari, daerah_id)
            VALUES 
            ('$nama','$ortu','$tgl_lahir','$alamat',$teacher_id,$active,'$tanggal_mulai','$tanggal_selesai','$jam','$hari',$daerah_id)";

    if($con->query($sql)){
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $con->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body { padding-top: 30px; }
</style>

<body>

<?php include "navigation.php"; ?>s

<div class="container mt-4">
    <h2>Tambah Murid</h2>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label>Nama Murid <span class="text-danger">*</span></label>
            <input type="text" name="nama_siswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Orang Tua</label>
            <input type="text" name="nama_ortu" list="parent_list" class="form-control" required>
            <datalist id="parent_list">
                <?php while($p = $parents->fetch_assoc()): ?>
                    <option value="<?= $p['nama_ortu'] ?>">
                <?php endwhile; ?>
            </datalist>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat <span class="text-danger">*</span></label>
            <textarea name="alamat" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label>Teacher <span class="text-danger">*</span></label>
            <select name="teachers_id" class="form-select" required>
                <option value="">-- Pilih Teacher --</option>
                <?php while($t = $teachers->fetch_assoc()): ?>
                    <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control">
        </div>
        <div class="mb-3">
            <label>Jam</label>
            <input type="text" name="jam" class="form-control" placeholder="08:00 - 10:00">
        </div>
        <div class="mb-3">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" placeholder="Senin / Selasa ...">
        </div>
        <div class="mb-3">
            <label>Daerah</label>
            <select name="daerah_id" class="form-select">
                <option value="">-- Pilih Daerah --</option>
                <?php while($d = $daerahs->fetch_assoc()): ?>
                    <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="active" checked>
            <label class="form-check-label">Aktif</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
