<?php
session_start();
error_reporting(E_ALL);

// koneksi database
$con = mysqli_connect("localhost","root","","YPDC");
if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_error();
}
?>