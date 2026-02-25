<?php
include 'config.php';

// Ambil ID murid dari query string
$id = $_GET['id'] ?? null;

if(!$id){
    header("Location: index.php");
    exit;
}

// Ambil data murid beserta relasinya
$sql = "SELECT s.*, 
               k.id AS kelas_id, k.name AS kelas_name,
               j.id AS jam_id, j.time_value AS jam_value,
               h.id AS hari_id, h.name AS hari_name,
               d.id AS daerah_id, d.name AS daerah_name
        FROM students s
        LEFT JOIN kelas k ON s.kelas_id = k.id
        LEFT JOIN jam j ON s.jam = j.id
        LEFT JOIN hari h ON s.hari = h.id
        LEFT JOIN daerah d ON s.daerah_id = d.id
        WHERE s.id = $id";

$result = $con->query($sql);
$student = $result->fetch_assoc();

// Ambil daftar pilihan
$teachers = $con->query("SELECT * FROM teachers");
$daerahs = $con->query("SELECT * FROM daerah");
$jam = $con->query("SELECT * FROM jam");
$hari = $con->query("SELECT * FROM hari");
$kelas = $con->query("SELECT * FROM kelas");

// Jika form dikirim
if(isset($_POST['submit'])){
    $nama = $_POST['nama_siswa'];
    $ortu = $_POST['nama_ortu'];
    $tgl_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $teacher_id = $_POST['teachers_id'];
    $active = isset($_POST['active']) ? 1 : 0;
    $kelas_id = $_POST['kelas_id'];
    $jam_id = $_POST['jam_id'];
    $hari_id = $_POST['hari_id'];
    $daerah_id = $_POST['daerah_id'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    $sql = "UPDATE students SET 
            nama_siswa='$nama',
            nama_ortu='$ortu',
            tanggal_lahir='$tgl_lahir',
            alamat='$alamat',
            teachers_id=$teacher_id,
            active=$active,
            kelas_id=$kelas_id,
            jam='$jam_id',
            hari='$hari_id',
            daerah_id=$daerah_id,
            tanggal_mulai='$tanggal_mulai',
            tanggal_selesai='$tanggal_selesai'
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body { padding-top: 30px; padding-bottom: 90px; }
</style>
<body>

<?php include "navigation.php"; ?>

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
        <div class="mb-3">
            <label>Kelas <span class="text-danger">*</span></label>
            <select name="kelas_id" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <?php while($k = $kelas->fetch_assoc()): ?>
                    <option value="<?= $k['id'] ?>" <?= $k['id']==$student['kelas_id']?'selected':'' ?>><?= $k['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Jam <span class="text-danger">*</span></label>
            <select name="jam_id" class="form-select" required>
                <option value="">-- Pilih Jam --</option>
                <?php while($j = $jam->fetch_assoc()): ?>
                    <option value="<?= $j['id'] ?>" <?= $j['id']==$student['jam']?'selected':'' ?>><?= $j['time_value'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Hari <span class="text-danger">*</span></label>
            <select name="hari_id" class="form-select" required>
                <option value="">-- Pilih Hari --</option>
                <?php while($h = $hari->fetch_assoc()): ?>
                    <option value="<?= $h['id'] ?>" <?= $h['id']==$student['hari']?'selected':'' ?>><?= $h['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Daerah <span class="text-danger">*</span></label>
            <select name="daerah_id" class="form-select" required>
                <option value="">-- Pilih Daerah --</option>
                <?php while($d = $daerahs->fetch_assoc()): ?>
                    <option value="<?= $d['id'] ?>" <?= $d['id']==$student['daerah_id']?'selected':'' ?>><?= $d['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="<?= $student['tanggal_mulai'] ?>">
        </div>
        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="<?= $student['tanggal_selesai'] ?>">
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="active" <?= $student['active']?'checked':'' ?>>
            <label class="form-check-label">Aktif</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>