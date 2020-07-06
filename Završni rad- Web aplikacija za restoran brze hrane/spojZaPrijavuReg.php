<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restoran_brze_hrane";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>