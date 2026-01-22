<?php
include "db.php";

// Obtener ID del usuario a editar
$id = $_GET['id'];
$usuario = $conexion->query("SELECT * FROM usuarios WHERE id=$id")->fetch_assoc();

// Procesar formulario al enviar
if ($_POST) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $error = '';

    // Verificar si el email ya existe en otro usuario
    if ($email !== $usuario['email']) {
        $verificarEmail = $conexion->query("SELECT id FROM usuarios WHERE email='$email'");
        if ($verificarEmail->num_rows > 0) {
            $error = "El correo ya está registrado por otro usuario";
        }
    }

    // Verificar si el teléfono ya existe en otro usuario
    if (empty($error) && $telefono !== $usuario['telefono']) {
        $verificarTelefono = $conexion->query("SELECT id FROM usuarios WHERE telefono='$telefono'");
        if ($verificarTelefono->num_rows > 0) {
            $error = "El teléfono ya está registrado por otro usuario";
        }
    }

    // Actualizar usuario en la BD
    if (empty($error)) {
    $conexion->query("UPDATE usuarios SET nombre='$nombre', apellido='$apellido', fecha='$fecha', telefono='$telefono', email='$email' WHERE id=$id");
    header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h2 class="mb-0">Editar Usuario</h2>
                    </div>
                    <div class="card-body">
                        <!-- Mostrar mensaje de error si existe -->
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>

                        <!-- Formulario de edición -->
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $usuario['apellido'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" value="<?= $usuario['telefono'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $usuario['fecha'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contraseña" name="contraseña" value="<?= $usuario['contraseña'] ?>" required>
                            </div>

                            <!-- Botón de actualizar -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning btn-lg">Actualizar usuario</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Botón volver -->
                <div class="mt-3">
                    <a href="home.php" class="btn btn-secondary w-100">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
