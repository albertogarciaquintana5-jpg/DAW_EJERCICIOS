<?php
// Librería relacion3.php
// Contiene todas las funciones de los ejercicios 1 al 3

// Ejercicio 1: Función para números primos
function esPrimo($num) {
    if ($num <= 1) return false;
    if ($num == 2) return true;
    if ($num % 2 == 0) return false;
    
    for ($i = 3; $i <= sqrt($num); $i += 2) {
        if ($num % $i == 0) return false;
    }
    return true;
}

// Ejercicio 2: Funciones factorial
function factorialIterativo($n) {
    if ($n < 0) return "Error: No existe factorial de números negativos";
    if ($n == 0 || $n == 1) return 1;
    
    $resultado = 1;
    for ($i = 2; $i <= $n; $i++) {
        $resultado *= $i;
    }
    return $resultado;
}

function factorialRecursivo($n) {
    if ($n < 0) return "Error: No existe factorial de números negativos";
    if ($n == 0 || $n == 1) return 1;
    return $n * factorialRecursivo($n - 1);
}

// Ejercicio 3: Funciones MCD
function mcdIterativo($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

function mcdRecursivo($a, $b) {
    if ($b == 0) {
        return $a;
    }
    return mcdRecursivo($b, $a % $b);
}
?>