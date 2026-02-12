<?php
include 'config.php';

// Ambil daftar teacher
$teachers = $con->query("SELECT * FROM teachers");

// Jika form dikirim
if(isset($_POST['submit'])){
    $nama = $_POST['nama_siswa'];
    $ortu = $_POST['nama_ortu'];
    $tgl_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $teacher_id = $_POST['teachers_id'];
    $active = isset($_POST['active']) ? 1 : 0;

    $sql = "INSERT INTO students (nama_siswa, nama_ortu, tanggal_lahir, alamat, teachers_id, active)
            VALUES ('$nama','$ortu','$tgl_lahir','$alamat',$teacher_id,$active)";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Murid</h2>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label>Nama Murid <span class="text-danger">*</span></label>
            <input type="text" name="nama_siswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Orang Tua <span class="text-danger">*</span></label>
            <input type="text" name="nama_ortu" class="form-control" required>
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
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="active" checked>
            <label class="form-check-label">Aktif</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
