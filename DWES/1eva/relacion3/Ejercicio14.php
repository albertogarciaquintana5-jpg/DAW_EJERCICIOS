<?php
// Funciones anónimas para cálculos geométricos
$circunferencia = function ($r) {
    return 2 * M_PI * $r;
};

$circulo = function ($r) {
    return M_PI * pow($r, 2);
};

$esfera = function ($r) {
    return (4/3) * M_PI * pow($r, 3);
};

// Procesar formulario
$resultados = [];
if ($_POST['radio'] ?? false) {
    $radio = floatval($_POST['radio']);
    if ($radio > 0) {
        $resultados = [
            'circunferencia' => $circunferencia($radio),
            'circulo' => $circulo($radio),
            'esfera' => $esfera($radio)
        ];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 14 - Funciones Anónimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Cálculos Geométricos con Funciones Anónimas</h1>
        
        <?php if (!empty($resultados)): ?>
            <div class="alert alert-success">
                <h4>Resultados para radio = <?= $_POST['radio'] ?></h4>
                <p>Longitud circunferencia: <?= number_format($resultados['circunferencia'], 2) ?></p>
                <p>Área círculo: <?= number_format($resultados['circulo'], 2) ?></p>
                <p>Volumen esfera: <?= number_format($resultados['esfera'], 2) ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Radio (valor positivo):</label>
                <input type="number" name="radio" step="0.01" min="0.01" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Calcular</button>
            </div>
        </form>
    </div>
</body>
</html>