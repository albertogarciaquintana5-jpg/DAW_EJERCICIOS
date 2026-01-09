<?php
include "db.php";

$error = "";
$success = "";

// REGISTRO
if ($_POST) {
    if (isset($_POST['register'])) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];

        // Verificar si el email existe
        $verificar = $conexion->query("SELECT * FROM usuarios WHERE email='$email'");

        if ($verificar->num_rows > 0) {
            $error = "El email ya está registrado";
        } else {
            $conexion->query("INSERT INTO usuarios (nombre, email, contraseña, apellido, telefono, fecha) VALUES ('$nombre', '$email', '$contraseña', '', '', '2000-01-01')");
            $success = "Registro exitoso, ahora puedes iniciar sesión";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - CRUD PHP</title>
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                            </div>

                            <button type="submit" name="register" class="btn btn-success w-100">Registrarse</button>
                        </form>

                        <hr>

                        <p class="text-center">¿Ya tienes cuenta? <a href="index.php">Inicia sesión aquí</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-4 mb-2 text-muted">
        CRUD en PHP - Bootstrap 5
    </footer>

</body>

</html>
