<?php
$servername = "localhost";
$username = "root"; // nombre de usuario de MySQL
$password = ""; // contraseña de MySQL
$dbname = "tiendasuministros"; // nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "<script>console.log('Conectado')</script>";
?>