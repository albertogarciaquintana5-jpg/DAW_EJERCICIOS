<?php
// Aqui se establece la conexión a la base de datos y puede copiar las credenciales
$conexion = new mysqli("localhost", "root", "", "crud_php");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>