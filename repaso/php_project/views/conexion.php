<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "lmm12345";
$dbname = "dvdpeliculas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>