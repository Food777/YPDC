<?php
session_start();
error_reporting(E_ALL);

// koneksi database
$con = mysqli_connect("localhost","root","","YPDC");
if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_error();
}

$count = $con->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'];

if($count == 0){
    $con->query("ALTER TABLE students AUTO_INCREMENT = 1");
}
?>