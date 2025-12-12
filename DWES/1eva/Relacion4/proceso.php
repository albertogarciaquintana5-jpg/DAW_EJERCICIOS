<?php
/*
  proceso.php
  Recibe POST desde login.php, valida las credenciales mediante una función local,
  inicia sesión, crea cookie "id_usuario" (30s) y variable de sesión "id_usuario".
  Muestra por pantalla el valor según cookie y según $_SESSION.
  Recarga la página cada 5 segundos.
*/

session_start();

// Refresca la página cada 5 segundos
header('Refresh: 5');

// Función local que valida credenciales (usa valores locales)
function validarCredenciales(string $usuario, string $contrasena): bool {
    // Credenciales por defecto: admin / 1234
    if ($usuario === 'admin' && $contrasena === '1234') {
        return true;
    }
    return false;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tomamos los datos enviados por POST
    $nombre_usuario = isset($_POST['nombre_usuario']) ? trim($_POST['nombre_usuario']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';

    // Validamos con la función PHP
    if (validarCredenciales($nombre_usuario, $contrasena)) {
        // Establecemos cookie (30 segundos) y variable de sesión
        // setcookie y session variables deben establecerse antes de enviar salida
        setcookie('id_usuario', $nombre_usuario, time() + 30, '/');
        $_SESSION['id_usuario'] = $nombre_usuario;
        $mensaje = "Credenciales correctas. Sesión iniciada para: $nombre_usuario";
    } else {
        $mensaje = 'Credenciales incorrectas. No se inició sesión.';
    }
} else {
    $mensaje = 'Accede desde el formulario de login.';
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Proceso - Login</title>
  <!-- Comentario HTML invisible: Esta página muestra cookie y variable de sesión -->
</head>
<body>
  <h1>Proceso de login</h1>
  <p><?php echo htmlspecialchars($mensaje, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>

  <!-- Mostramos el valor según la cookie (nota: tras la primera carga la cookie puede no estar aún disponible) -->
  <h2>Valor desde cookie</h2>
  <p>
  <?php
    if (isset($_COOKIE['id_usuario'])) {
        // Cookie disponible (en recargas posteriores)
        echo 'Cookie id_usuario = ' . htmlspecialchars($_COOKIE['id_usuario'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    } else {
        echo 'Cookie id_usuario NO está disponible todavía (se activa en la siguiente petición).';
    }
  ?>
  </p>

  <!-- Mostramos el valor desde la sesión -->
  <h2>Valor desde sesión</h2>
  <p>
  <?php
    if (isset($_SESSION['id_usuario'])) {
        echo '$_SESSION["id_usuario"] = ' . htmlspecialchars($_SESSION['id_usuario'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    } else {
        echo 'No hay variable de sesión id_usuario.';
    }
  ?>
  </p>

  <p>Esta página se refresca cada 5 segundos. La cookie caduca 30 segundos después de ser creada.</p>

  <p><a href="login.php">Volver al login</a></p>
</body>
</html>
