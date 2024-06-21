<?php
$servername = "localhost";
$username = "root";
$password = "21009";
$dbname = "Senai";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Deu ruim...". mysqli_connect_error());
}
?>