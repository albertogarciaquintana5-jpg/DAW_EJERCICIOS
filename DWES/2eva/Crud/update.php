<?php
include "db.php";

$id = $_GET['id'];
$usuario = $conexion->query("SELECT * FROM usuarios WHERE id=$id")->fetch_assoc();


if ($_POST) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    $conexion->query("UPDATE usuarios SET nombre='$nombre', apellido='$apellido', fecha='$fecha', telefono='$telefono', email='$email' WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2>Editar Usuario</h2>

<form method="POST">
    Nombre: <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required><br><br>
    Apellido: <input type="text" name="apellido" value="<?= $usuario['apellido'] ?>" required><br><br>
    Fecha de nacimiento: <input type="date" name="fecha" value="<?= $usuario['fecha'] ?>" required><br><br>
    Teléfono: <input type="number" name="telefono" value="<?= $usuario['telefono'] ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $usuario['email'] ?>" required><br><br>
    Contraseña: <input type="password" name="contraseña" value="<?= $usuario['contraseña'] ?>" required><br><br>
    <button type="submit">Actualizar</button>
</form>

<a href="home.php">Volver</a>
</body>
</html>
