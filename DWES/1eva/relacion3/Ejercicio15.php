<?php
// Funciones Arrow (versión simplificada de funciones anónimas)
$circunferencia = fn($r) => 2 * M_PI * $r;
$circulo = fn($r) => M_PI * pow($r, 2);
$esfera = fn($r) => (4/3) * M_PI * pow($r, 3);

// Comparación switch vs match
$valor = 2;

// Switch tradicional
$resultadoSwitch = '';
switch ($valor) {
    case 1: $resultadoSwitch = "uno"; break;
    case 2: $resultadoSwitch = "dos"; break;
    default: $resultadoSwitch = "otro";
}

// Match (PHP 8+)
$resultadoMatch = match($valor) {
    1 => "uno",
    2 => "dos",
    default => "otro"
};
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 15 - Funciones Arrow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Funciones Arrow y Match vs Switch</h1>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Funciones Arrow</div>
                    <div class="card-body">
                        <p>Circunferencia (r=5): <?= $circunferencia(5) ?></p>
                        <p>Círculo (r=5): <?= $circulo(5) ?></p>
                        <p>Esfera (r=5): <?= $esfera(5) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Switch vs Match</div>
                    <div class="card-body">
                        <p>Switch: <?= $resultadoSwitch ?></p>
                        <p>Match: <?= $resultadoMatch ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>