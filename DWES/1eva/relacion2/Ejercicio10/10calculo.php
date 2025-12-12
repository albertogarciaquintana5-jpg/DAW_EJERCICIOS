<?php
// Calcula la operación y muestra el resultado.

function esc($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

$num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
$num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
$operacion = isset($_POST['operacion']) ? $_POST['operacion'] : '';

switch ($operacion) {
  case 'sumar':
    $simbolo = '+';
    $resultado = $num1 + $num2;
    break;
  case 'restar':
    $simbolo = '−';
    $resultado = $num1 - $num2;
    break;
  case 'multiplicar':
    $simbolo = '×';
    $resultado = $num1 * $num2;
    break;
  case 'dividir':
    $simbolo = '÷';
    $resultado = ($num2 != 0) ? $num1 / $num2 : 'Error: división por cero';
    break;
  default:
    $simbolo = '?';
    $resultado = 'Operación no válida';
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Resultado del cálculo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <h1>Resultado de la operación</h1>

  <p><strong>
    <?php echo esc($num1); ?> <?php echo esc($simbolo); ?> <?php echo esc($num2); ?> =
    <?php echo is_numeric($resultado) ? esc($resultado) : esc($resultado); ?>
  </strong></p>

  <hr>
  <?php
    // Enlace para volver y editar con los mismos valores
    $qs = '?num1=' . urlencode($num1)
        . '&num2=' . urlencode($num2)
        . '&operacion=' . urlencode($operacion);
  ?>
  <a href="10formulario.php<?php echo $qs; ?>">Editar</a>
  <br><br>
  <a href="10formulario.php">Nuevo cálculo</a>
</body>
</html>
