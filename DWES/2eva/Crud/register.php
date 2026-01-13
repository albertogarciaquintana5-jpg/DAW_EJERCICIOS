<?php
include "db.php";

$error = "";
$success = "";

// REGISTRO
if ($_POST) {
    if (isset($_POST['register'])) {
        // Datos del usuario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $fecha = $_POST['fecha'];
        


        // Verificar si el email existe
        $verificar = $conexion->query("SELECT * FROM usuarios WHERE email='$email'");

        if ($verificar->num_rows > 0) {
            $error = "El email ya está registrado";
        } else {
            $conexion->query("INSERT INTO usuarios (nombre, email, contraseña, fecha, apellido, telefono) VALUES ('$nombre', '$email', '$contraseña', '$fecha','$apellido', '$telefono')");
            // Redirigir a la página de login con mensaje de éxito (no auto-login)
            header('Location: index.php?registered=1&nombre=' . urlencode($nombre));
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">CRUD en PHP</a>
        </div>
    </nav>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 fw-bold">Crear Cuenta</h2>

                        <?php if ($error != ""): ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Error:</strong> <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success != ""): ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Éxito:</strong> <?php echo $success; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>
                        
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                            </div>

                                    <button type="submit" name="register" class="btn btn-success w-100">Registrarse</button>
                                    <br><br>
                                   <a href="index.php"><button type="button" class="btn btn-success w-100">Volver al login</button></a>

                        </form>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-4 mb-2 text-muted">
        CRUD en PHP - Bootstrap 5
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
