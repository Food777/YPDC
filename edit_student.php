<?php
include 'config.php';

// Ambil ID murid dari query string
$id = $_GET['id'] ?? null;

if(!$id){
    header("Location: index.php");
    exit;
}

// Ambil data murid
$result = $con->query("SELECT * FROM students WHERE id=$id");
$student = $result->fetch_assoc();

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

    $sql = "UPDATE students SET 
            nama_siswa='$nama',
            nama_ortu='$ortu',
            tanggal_lahir='$tgl_lahir',
            alamat='$alamat',
            teachers_id=$teacher_id,
            active=$active
            WHERE id=$id";

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
    <title>Edit Murid</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Murid</h2>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label>Nama Murid <span class="text-danger">*</span></label>
            <input type="text" name="nama_siswa" class="form-control" value="<?= $student['nama_siswa'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama Orang Tua <span class="text-danger">*</span></label>
            <input type="text" name="nama_ortu" class="form-control" value="<?= $student['nama_ortu'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $student['tanggal_lahir'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat <span class="text-danger">*</span></label>
            <textarea name="alamat" class="form-control" rows="3" required><?= $student['alamat'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Teacher <span class="text-danger">*</span></label>
            <select name="teachers_id" class="form-select" required>
                <option value="">-- Pilih Teacher --</option>
                <?php while($t = $teachers->fetch_assoc()): ?>
                    <option value="<?= $t['id'] ?>" <?= $t['id']==$student['teachers_id']?'selected':'' ?>><?= $t['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="active" <?= $student['active']?'checked':'' ?>>
            <label class="form-check-label">Aktif</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
