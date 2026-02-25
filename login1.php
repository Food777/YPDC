<?php
session_start();
error_reporting(E_ALL);
$con = mysqli_connect("localhost","root","","YPDC");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Ambil data dari form
if(isset($_POST['name']) && isset($_POST['password'])) {
    $name = $_POST["name"];
    $pw = md5($_POST["password"]); // kalau pakai md5

    // Query user
    $sql = "SELECT * FROM users WHERE name='$name' AND password='$pw'";
    $rs = mysqli_query($con, $sql);

    if(!$rs) {
        die("Query error: ".mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($rs);

    if(!$row) {
        // Login gagal
        $_SESSION['gagallogin'] = "Unknown username or password";
        header("Location: login.php");
        exit;
    } else {
        // Login berhasil
        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id'];       // Simpan ID user
        $_SESSION['name'] = $row['name'];   // Simpan nama user

        header("Location: index.php");
        exit;
    }
} else {
    echo "Form belum di-submit!";
}
?>