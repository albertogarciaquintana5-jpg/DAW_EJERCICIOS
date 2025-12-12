<?php
/*
  sesiones_demo.php
  Demostración práctica de uso de variables de sesión para mantener dos
  contadores: a y b. Incluye un formulario select con acciones para
  incrementar, decrementar, resetear y destruir la sesión.
*/

session_start();

// Inicializamos variables en sesión si no existen
if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = 0;
}
if (!isset($_SESSION['b'])) {
    $_SESSION['b'] = 0;
}

// Procesamos acción al enviar el formulario (method POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

    switch ($accion) {
        case 'inc_a':
            $_SESSION['a']++;
            break;
        case 'dec_a':
            $_SESSION['a']--;
            break;
        case 'inc_b':
            $_SESSION['b']++;
            break;
        case 'dec_b':
            $_SESSION['b']--;
            break;
        case 'reset_a':
            $_SESSION['a'] = 0;
            break;
        case 'reset_b':
            $_SESSION['b'] = 0;
            break;
        case 'destroy':
            // Destruye la sesión y refresca la página
            session_unset();
            session_destroy();
            // Forzamos recarga para que la sesión quede reiniciada
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
            break;
        default:
            // Por defecto, si no se elige nada, aumentamos 'a'
            $_SESSION['a']++;
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Demo Sesiones - Relación 4</title>
  <!-- Comentario HTML: usa select para elegir operación sobre a y b -->
</head>
<body>
  <h1>Demo de variables de sesión</h1>
  <p>Valores actuales (almacenados en <code>$_SESSION</code>)</p>
  <ul>
    <li>a = <?php echo isset($_SESSION['a']) ? (int)$_SESSION['a'] : 'N/A'; ?></li>
    <li>b = <?php echo isset($_SESSION['b']) ? (int)$_SESSION['b'] : 'N/A'; ?></li>
  </ul>

  <form action="" method="post">
    <label for="accion">Elige una acción:</label>
    <select name="accion" id="accion">
      <option value="inc_a">Aumentar a</option>
      <option value="dec_a">Disminuir a</option>
      <option value="inc_b">Aumentar b</option>
      <option value="dec_b">Disminuir b</option>
      <option value="reset_a">Resetear a</option>
      <option value="reset_b">Resetear b</option>
      <option value="destroy">Destruir sesión</option>
    </select>
    <button type="submit">Ejecutar</button>
  </form>

  <p>Nota: si cierras la pestaña y vuelves a abrirla, la sesión persiste mientras la cookie de sesión del navegador exista. Para empezar de cero usa la opción <strong>Destruir sesión</strong>.</p>

  <p><a href="login.php">Volver al login</a></p>
</body>
</html>
