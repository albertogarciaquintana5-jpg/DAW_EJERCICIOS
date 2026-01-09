<?php
include "db.php";

if ($_POST) {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contrseña'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];

    $conexion->query("INSERT INTO usuarios (nombre, contraseña,apellido, fecha, telefono, email) VALUES ('$nombre', '$contraseña','$apellido', '$fecha', '$telefono', '$email')");
    header("Location: index.php");
}
?>

<h2>Crear Usuario</h2>

<form method="POST">
    Nombre: <input type="text" name="nombre" required><br><br>
    Contraseña: <input type="password" name="contraseña" required><br><br>
    Apellido: <input type="text" name="apellido" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Telefono: <input type="number" name="telefono" required><br><br>
    Año de nacimiento: <input type="date" name="fecha" required><br><br>

    <button type="submit">Guardar</button>
</form>

<a href="index.php">Volver</a>