<?php
/*
  juego_hidden.php
  Juego: el servidor "piensa" un número entre 1 y 100 y lo mantiene
  mediante un campo hidden en el formulario. No se usan sesiones.
  Usaremos método GET para facilitar el modo depuración.
*/

// Si se ha pedido reiniciar, olvidamos el valor enviado
if (isset($_GET['reset'])) {
    // redirigimos a la misma página sin parámetros
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}

$mensaje = '';
$secreto = '';

// Si no nos llega secret por GET, generamos uno y lo enviamos en el hidden
if (isset($_GET['secret'])) {
    $secreto = (int)$_GET['secret'];
}

if (isset($_GET['guess'])) {
    $guess = (int)$_GET['guess'];
    // Si no hay secreto en el GET algo falla, pero lo comprobamos
    if ($secreto === '') {
        $mensaje = 'Falta el número secreto (campo hidden).';
    } else {
        if ($guess === $secreto) {
            $mensaje = "¡Enhorabuena! Has acertado: $guess.";
        } elseif ($guess > $secreto) {
            $mensaje = 'Te has pasado.';
        } else {
            $mensaje = 'Te has quedado corto.';
        }
    }
}

// Si no hay secreto, generamos uno para el primer formulario
if ($secreto === '') {
    $secreto = rand(1, 100);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Juego (hidden) - Relación 4</title>
</head>
<body>
  <h1>Adivina el número (campo hidden)</h1>
  <p><?php echo htmlspecialchars($mensaje, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>

  <form action="" method="get">
    <label for="guess">Introduce un número (1-100):</label>
    <input type="number" id="guess" name="guess" min="1" max="100" required />
    <!-- Campo hidden que mantiene el número secreto entre peticiones -->
    <input type="hidden" name="secret" value="<?php echo htmlspecialchars($secreto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" />
    <button type="submit">Enviar</button>
  </form>

  <p>
    <a href="?reset=1">Reiniciar (generar nuevo número)</a>
  </p>

  <p><a href="login.php">Volver al login</a></p>
</body>
</html>
