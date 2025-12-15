<?php
// Crear array con range
$numeros = range(1, 100);

// Función para detectar primos
function esPrimo($n) {
    if ($n <= 1) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

// Polyfill para array_all y array_any 
function array_all($array, $callback) {
    foreach ($array as $item) {
        if (!$callback($item)) return false;
    }
    return true;
}

function array_any($array, $callback) {
    foreach ($array as $item) {
        if ($callback($item)) return true;
    }
    return false;
}

function array_find($array, $callback) {
    foreach ($array as $item) {
        if ($callback($item)) return $item;
    }
    return null;
}

// Aplicar funciones callback
$todosPositivos = array_all($numeros, fn($n) => $n > 0);
$hayMultiplo5 = array_any($numeros, fn($n) => $n % 5 == 0);
$primos = array_filter($numeros, 'esPrimo');
$primerDobleCifra = array_find($numeros, fn($n) => $n > 9 && $n < 100 && $n % 11 == 0);
$cuadrados = array_map(fn($n) => $n * $n, $numeros);

$numerosDobles = $numeros;
array_walk($numerosDobles, function(&$valor) {
    $valor *= 2;
});
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 16 - Callbacks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Funciones Array con Callbacks</h1>
        
        <div class="alert alert-primary">
            <h4>array_all - ¿Todos positivos?</h4>
            <p><?= $todosPositivos ? 'Sí' : 'No' ?></p>
        </div>

        <div class="alert alert-success">
            <h4>array_any - ¿Hay múltiplos de 5?</h4>
            <p><?= $hayMultiplo5 ? 'Sí' : 'No' ?></p>
        </div>

        <div class="alert alert-warning">
            <h4>array_filter - Números primos (primeros 10)</h4>
            <p><?= implode(', ', array_slice($primos, 0, 10)) ?>...</p>
        </div>

        <div class="alert alert-info">
            <h4>array_find - Primer número con dos cifras iguales</h4>
            <p><?= $primerDobleCifra ?? 'No encontrado' ?></p>
        </div>

        <div class="alert alert-secondary">
            <h4>array_map - Cuadrados (primeros 10)</h4>
            <p><?= implode(', ', array_slice($cuadrados, 0, 10)) ?>...</p>
        </div>

        <div class="alert alert-dark">
            <h4>array_walk - Dobles (primeros 10)</h4>
            <p><?= implode(', ', array_slice($numerosDobles, 0, 10)) ?>...</p>
        </div>
    </div>
</body>
</html>