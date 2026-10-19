<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "db_rental_studio"; 

$koneksi  = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "Koneksi database MySQL Gagal : " . mysqli_connect_error();
}
?>
