<?php
require_once __DIR__ . '/libreria.php';

$num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_INT);
$num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_INT);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Resultado - Numeros amigos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <h1 class="h5 mb-4">Resultado - Numeros amigos</h1>

            <?php
              if ($num1 === null || $num2 === null) {
                  echo '<div class="alert alert-danger">ERROR: No se han recibido los datos por POST.</div>';
                  echo '<a href="formulario.php" class="btn btn-secondary">Volver al formulario</a>';
                  exit;
              }

              if ($num1 === false || $num2 === false) {
                  echo '<div class="alert alert-danger">ERROR: Ambos valores deben ser enteros válidos.</div>';
                  echo '<a href="formulario.php" class="btn btn-secondary">Volver al formulario</a>';
                  exit;
              }

              $num1 = (int)$num1;
              $num2 = (int)$num2;

              if (sonAmigos($num1, $num2)) {
                  echo '<div class="alert alert-success fw-bold">Los números introducidos son amigos</div>';
              } else {
                  echo '<div class="alert alert-warning fw-bold">Los números introducidos no son amigos</div>';
              }

              echo '<hr>';
              echo '<h2>Pruebas de ejemplo</h2>';
              echo '<ul>';
              echo '<li>Comprobación 220 y 284: ' . (sonAmigos(220, 284) ? '<strong>amistosos</strong>' : 'no amistosos') . '</li>';
              echo '<li>Comprobación 100 y 500: ' . (sonAmigos(100, 500) ? '<strong>amistosos</strong>' : 'no amistosos') . '</li>';
              echo '</ul>';

              echo '<div class="mt-4">';
              echo '<a href="formulario.php" class="btn btn-primary me-2">Volver al formulario</a>';
              echo '</div>';

            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>