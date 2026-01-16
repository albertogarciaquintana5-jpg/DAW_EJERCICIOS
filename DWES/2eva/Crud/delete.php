<?php
// Incluir conexión a BD
include "db.php";

// Obtener ID del usuario a eliminar
$id = $_GET['id'];

// Eliminar usuario de la BD
$conexion->query("DELETE FROM usuarios WHERE id=$id");

// Redirigir al listado principal
header("Location: index.php");
?>