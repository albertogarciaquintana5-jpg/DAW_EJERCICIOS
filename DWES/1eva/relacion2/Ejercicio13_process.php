<?php
// Ejercicio13_process.php
// Recibe datos POST del formulario y realiza cálculos
// Devuelve salida con Bootstrap progress bar

$errors = [];
$resultado = null;
$nombre = '';
$email = '';

// Leer y validar datos servidor-side
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $inicial = isset($_POST['inicial']) ? $_POST['inicial'] : null;
    $primera = isset($_POST['primera']) ? $_POST['primera'] : null;
    $segunda = isset($_POST['segunda']) ? $_POST['segunda'] : null;
    $tercera = isset($_POST['tercera']) ? $_POST['tercera'] : null;

    // Validaciones
    if (strlen($nombre) < 2) {
        $errors[] = 'Nombre debe tener al menos 2 caracteres.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Correo electrónico no válido.';
    }

    // Validar notas
    $notes = ['inicial' => $inicial, 'primera' => $primera, 'segunda' => $segunda, 'tercera' => $tercera];
    $validNotes = [];
    foreach ($notes as $key => $val) {
        $fVal = filter_var($val, FILTER_VALIDATE_FLOAT);
        if ($fVal === false) {
            $errors[] = "La nota '{$key}' no es válida.";
        } else {
            if ($fVal < 0 || $fVal > 10) {
                $errors[] = "La nota '{$key}' debe estar entre 0 y 10.";
            } else {
                $validNotes[$key] = $fVal;
            }
        }
    }

    // Si no hay errores, calcular resultado
    if (empty($errors) && count($validNotes) === 4) {
        $suma = array_sum($validNotes);
        $resultado = $suma / 4.0;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado - Ejercicio 13</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .result-card { max-width: 600px; margin: 40px auto; }
        .progress-wrapper { margin: 20px 0; }
        .grade-badge {
            font-size: 2.5rem;
            font-weight: bold;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .grade-excellent { background-color: #d4edda; color: #155724; }
        .grade-good { background-color: #cce5ff; color: #004085; }
        .grade-fair { background-color: #fff3cd; color: #856404; }
        .grade-poor { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Resultado - Ejercicio 13</a>
        </div>
    </nav>

    <main class="container">
        <div class="card result-card shadow">
            <div class="card-body">
                <h5 class="card-title mb-3">Resultado del Cálculo de Calificación</h5>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <h6 class="alert-heading">Errores de validación</h6>
                        <ul class="mb-0">
                            <?php foreach ($errors as $e): ?>
                                <li><?= htmlspecialchars($e) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php elseif ($resultado !== null): ?>
                    <!-- Información del estudiante -->
                    <div class="mb-4">
                        <h6 class="text-muted">Estudiante</h6>
                        <p class="mb-1"><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
                        <p class="mb-0"><strong>Correo:</strong> <?= htmlspecialchars($email) ?></p>
                    </div>

                    <!-- Detalles de notas -->
                    <div class="mb-4">
                        <h6 class="text-muted">Calificaciones por evaluación</h6>
                        <div class="row g-2">
                            <?php foreach (['inicial' => 'Inicial', 'primera' => '1ª Evaluación', 'segunda' => '2ª Evaluación', 'tercera' => '3ª Evaluación'] as $key => $label): ?>
                                <div class="col-6 col-md-3">
                                    <div class="card text-center">
                                        <div class="card-body p-2">
                                            <div class="small text-muted"><?= $label ?></div>
                                            <div class="h5 mb-0"><?= number_format($validNotes[$key], 2) ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Calificación final con progress bar -->
                    <div class="progress-wrapper">
                        <h6 class="text-muted">Calificación Final</h6>
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: <?= ($resultado / 10) * 100 ?>%; background-color: <?= getColorForGrade($resultado) ?>;" 
                                 aria-valuenow="<?= $resultado ?>" aria-valuemin="0" aria-valuemax="10">
                                <?= number_format($resultado, 2) ?>
                            </div>
                        </div>
                    </div>

                    <!-- Badge con clasificación -->
                    <div class="grade-badge <?= getClassForGrade($resultado) ?>">
                        <?= number_format($resultado, 2) ?>/10
                    </div>

                    <!-- Descripción -->
                    <div class="alert alert-info mt-3" role="alert">
                        <strong>Resultado:</strong> <?= getDescriptionForGrade($resultado) ?>
                    </div>

                    <!-- Tabla resumen -->
                    <div class="table-responsive mt-3">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Concepto</th>
                                    <th class="text-end">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Media (Inicial + 1ª + 2ª + 3ª) / 4</td>
                                    <td class="text-end"><strong><?= number_format($resultado, 3) ?></strong></td>
                                </tr>
                                <tr>
                                    <td>Suma total de evaluaciones</td>
                                    <td class="text-end"><?= number_format(array_sum($validNotes), 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Número de evaluaciones</td>
                                    <td class="text-end">4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        No se recibieron datos válidos. Por favor, regresa al formulario.
                    </div>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="Ejercicio13.php" class="btn btn-primary">Volver al formulario</a>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Funciones auxiliares
function getColorForGrade($grade) {
    if ($grade >= 9) return '#28a745';       // Verde
    if ($grade >= 7) return '#17a2b8';       // Azul
    if ($grade >= 5) return '#ffc107';       // Amarillo
    return '#dc3545';                        // Rojo
}

function getClassForGrade($grade) {
    if ($grade >= 9) return 'grade-excellent';
    if ($grade >= 7) return 'grade-good';
    if ($grade >= 5) return 'grade-fair';
    return 'grade-poor';
}

function getDescriptionForGrade($grade) {
    if ($grade >= 9) return 'Excelente. Desempeño sobresaliente.';
    if ($grade >= 7) return 'Bueno. Desempeño satisfactorio.';
    if ($grade >= 5) return 'Aceptable. Desempeño regular.';
    return 'Insuficiente. Desempeño por debajo de lo esperado.';
}
?>
