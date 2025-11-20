<?php
// Crear arrays
$pares = array_filter(range(1, 20), fn($n) => $n % 2 == 0);
$multiplosDeTres = array_filter(range(1, 40), fn($n) => $n % 3 == 0);

// Aplicar diferentes funciones de array
$arrayCombinado = array_combine($pares, $multiplosDeTres);
$contadorPares = array_count_values($pares);
$interseccion = array_intersect($pares, $multiplosDeTres);
$arrayUnico = array_unique(array_merge($pares, $multiplosDeTres));
$arrayRevertido = array_reverse($pares);

// Búsqueda y modificación
$existeSeis = in_array(6, $pares);
$posicionDoce = array_search(12, $pares);

// Compact
$nombre = "Ana";
$edad = 30;
$datos = compact('nombre', 'edad');

// Polyfill para array_any
function array_any($array, $callback) {
    foreach ($array as $item) {
        if ($callback($item)) return true;
    }
    return false;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 17 - Más Funciones Array</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Más Funciones para Arrays</h1>
        
        <div class="alert alert-primary">
            <h4>Arrays originales</h4>
            <p><strong>Pares:</strong> <?= implode(', ', $pares) ?></p>
            <p><strong>Múltiplos de 3:</strong> <?= implode(', ', $multiplosDeTres) ?></p>
        </div>

        <div class="alert alert-success">
            <h4>array_intersect - Valores comunes</h4>
            <p><?= implode(', ', $interseccion) ?></p>
        </div>

        <div class="alert alert-info">
            <h4>array_count_values - Conteo pares</h4>
            <pre><?php print_r($contadorPares); ?></pre>
        </div>

        <div class="alert alert-warning">
            <h4>compact - Array desde variables</h4>
            <pre><?php print_r($datos); ?></pre>
        </div>

        <div class="alert alert-secondary">
            <h4>Búsquedas</h4>
            <p>¿Existe 6? <?= $existeSeis ? 'Sí' : 'No' ?></p>
            <p>Posición de 12: <?= $posicionDoce ?></p>
        </div>
    </div>
</body>
</html>