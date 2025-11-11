<?php
// Ejercicio7_process.php
// Recibe datos por GET o POST y realiza una operación simple.

// Determinar método y origen de datos
$method = $_SERVER['REQUEST_METHOD'];
$data = ($method === 'POST') ? $_POST : $_GET;

// Helper para tomar y validar
function get_param($data, $name){
    return isset($data[$name]) ? $data[$name] : null;
}

$num1 = get_param($data, 'num1');
$num2 = get_param($data, 'num2');
$oper = get_param($data, 'operador');

$errors = [];

// Validaciones servidor
if ($num1 === null || $num2 === null || $oper === null) {
    $errors[] = 'Faltan parámetros. Asegúrate de enviar num1, num2 y operador.';
} else {
    if (!is_numeric($num1)) $errors[] = 'num1 no es numérico.';
    if (!is_numeric($num2)) $errors[] = 'num2 no es numérico.';
    $allowed = ['+','-','*','/','%'];
    if (!in_array($oper, $allowed, true)) $errors[] = 'Operador no válido.';
}

$result = null;
if (empty($errors)){
    $a = floatval($num1);
    $b = floatval($num2);
    switch ($oper){
        case '+': $result = $a + $b; break;
        case '-': $result = $a - $b; break;
        case '*': $result = $a * $b; break;
        case '/':
            if ($b == 0) $errors[] = 'División por cero.'; else $result = $a / $b;
            break;
        case '%':
            if ($b == 0) $errors[] = 'Módulo por cero.'; else $result = fmod($a, $b);
            break;
    }
}

// Salida sencilla (SoC: solo renderización básica)
?><!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Resultado Ejercicio 7</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>body{padding:14px}</style>
</head>
<body>
  <div class="container">
    <h1 class="mb-3">Resultado (<?php echo htmlspecialchars($method); ?>)</h1>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach($errors as $e): ?>
            <li><?php echo htmlspecialchars($e); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php else: ?>
      <div class="alert alert-success">
        <p>Operación: <strong><?php echo htmlspecialchars($num1); ?> <?php echo htmlspecialchars($oper); ?> <?php echo htmlspecialchars($num2); ?></strong></p>
        <p>Resultado: <strong><?php echo htmlspecialchars((string)$result); ?></strong></p>
      </div>
    <?php endif; ?>

    <p><a href="Ejercicio7-11.php">Volver al formulario</a></p>
  </div>
</body>
</html>
