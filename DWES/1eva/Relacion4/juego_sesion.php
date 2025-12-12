<?php
/*
  juego_sesion.php
  Juego de adivinar un número entre 1 y 100 usando sesiones para mantener
  el número secreto entre peticiones. Incluye opción de reiniciar la batalla.
*/

session_start();

// Si pedimos reinicio, borramos la variable de sesión y recargamos
if (isset($_GET['reset'])) {
    unset($_SESSION['numero_secreto']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Si no existe el secreto en la sesión, lo generamos
if (!isset($_SESSION['numero_secreto'])) {
    $_SESSION['numero_secreto'] = rand(1, 100);
}

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guess = isset($_POST['guess']) ? (int)$_POST['guess'] : null;
    $secreto = (int)$_SESSION['numero_secreto'];

    if ($guess === $secreto) {
        $mensaje = "¡Correcto! El número era $secreto.";
    } elseif ($guess > $secreto) {
        $mensaje = 'Te has pasado.';
    } else {
        $mensaje = 'Te has quedado corto.';
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Juego (sesión) - Relación 4</title>
</head>
<body>
  <h1>Adivina el número (sesión)</h1>
  <p><?php echo htmlspecialchars($mensaje, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>

  <form action="" method="post">
    <label for="guess">Introduce un número (1-100):</label>
    <input type="number" id="guess" name="guess" min="1" max="100" required />
    <button type="submit">Enviar</button>
  </form>

  <p>
    <a href="?reset=1">Reiniciar partida (generar nuevo número)</a>
  </p>

  <p>DEBUG: número secreto en sesión (solo para pruebas): <?php echo isset($_SESSION['numero_secreto']) ? (int)$_SESSION['numero_secreto'] : 'N/A'; ?></p>

  <p><a href="login.php">Volver al login</a></p>
</body>
</html>
