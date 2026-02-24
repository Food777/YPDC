<?php
    session_start();
    error_reporting(E_ALL);
    //step 1 - koneksi dengan apache, mysql sekaligus memilih databasenya
    $con = mysqli_connect("localhost","root","","YPDC");
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //step 2 - query yang akan dikirimkan ke MySQL
    //2
    $name = $_POST["name"]; //reyner
    $pw = md5($_POST["password"]); //reyner12345
    $sql= "SELECT * FROM users ";
    $sql.= "WHERE name = '" .$name."' and password ='". $pw ."'";
    $rs= mysqli_query($con,$sql);
    
    echo $sql;

    // Associative array
    $row=mysqli_fetch_array($rs,MYSQLI_ASSOC);
    if(isset($row['name']) == false)
    {
        echo "Gagal login"; 
        $_SESSION['gagallogin'] = "Unknown username or password";
        header("location:login.php");
        exit;
    }
    else
    {
        echo "Berhasil login";
        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id'];
        header("location:index.php");
        exit;
    }


?>