<?php
include "db.php";

$error = '';

// Procesar formulario al enviar
if ($_POST) {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];

    // Verificar si el email ya existe
    $verificarEmail = $conexion->query("SELECT id FROM usuarios WHERE email='$email'");
    if ($verificarEmail->num_rows > 0) {
        $error = " El correo ya está registrado";
    }

    // Verificar si el teléfono ya existe
    elseif (!empty($telefono)) {
        $verificarTelefono = $conexion->query("SELECT id FROM usuarios WHERE telefono='$telefono'");
        if ($verificarTelefono->num_rows > 0) {
            $error = " El teléfono ya está registrado";
        }
    }

    // Si no hay errores, insertar usuario
    if (empty($error)) {
        $conexion->query("INSERT INTO usuarios (nombre, contraseña, apellido, fecha, telefono, email) VALUES ('$nombre', '$contraseña', '$apellido', '$fecha', '$telefono', '$email')");
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    
                        <!-- Mostrar mensaje de error si existe -->
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Crear nuevo usuario</h2>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de registro -->
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" required>
                            </div>

                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>

                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                            </div>

                            <!-- Botones de acción -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">Guardar usuario</button>
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