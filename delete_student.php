<?php
include 'config.php';

$id = $_GET['id'] ?? null;

if($id){
    $con->query("DELETE FROM students WHERE id=$id");
}

header("Location: index.php");
exit;
?>
