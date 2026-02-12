<?php
include 'config.php';
$students = $con->query("SELECT * FROM students");
$classes = $con->query("SELECT * FROM kelas");

if(isset($_POST['submit'])){
    $student_id = $_POST['student_id'];
    $class_id = $_POST['class_id'];
    $tanggal_mulai = $_POST['tanggal_mulai'];

    $con->query("UPDATE student_class SET tanggal_selesai = '$tanggal_mulai' WHERE student_id = $student_id AND tanggal_selesai IS NULL");
    $con->query("INSERT INTO student_class (student_id, class_id, tanggal_mulai) VALUES ($student_id,$class_id,'$tanggal_mulai')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Naik Kelas Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <h2>Naik / Assign Kelas</h2>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label>Murid</label>
            <select name="student_id" class="form-select">
                <?php while($s = $students->fetch_assoc()): ?>
                    <option value="<?= $s['id'] ?>"><?= $s['nama_siswa'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <select name="class_id" class="form-select">
                <?php while($c = $classes->fetch_assoc()): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
