<?php
session_start();
include "db.php";

$error = "";
$success = "";

// Mostrar mensaje si venimos de registro
if (isset($_GET['registered']) && $_GET['registered'] == '1') {
    $nombre_reg = isset($_GET['nombre']) ? urldecode($_GET['nombre']) : '';
    $success = "Registro exitoso. Ya puedes iniciar sesión.";
}

// LOGIN
if ($_POST) {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];

        $resultado = $conexion->query("SELECT * FROM usuarios WHERE email='$email' AND contraseña='$contraseña'");

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: home.php");
            exit;
        } else {
            $error = "Email o contraseña incorrectos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CRUD PHP</title>
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
                        <h2 class="text-center mb-4 fw-bold">Iniciar Sesión</h2>

                        <?php if ($error != ""): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error:</strong> <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if ($success != ""): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($nombre_reg) && $nombre_reg != ''): ?>
                            <div class="alert alert-success" role="alert">
                                ¡Bienvenido <?php echo htmlspecialchars($nombre_reg, ENT_QUOTES, 'UTF-8'); ?>! Tu cuenta fue creada correctamente.
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                            </div>

                            <button type="submit" name="login" class="btn btn-primary w-100">Entrar</button>
                        </form>

                        <hr>

                        <p class="text-center">¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
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
