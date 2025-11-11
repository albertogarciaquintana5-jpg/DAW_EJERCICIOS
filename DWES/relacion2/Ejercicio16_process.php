<?php

function h($s){ return htmlspecialchars($s, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); }

$n = filter_input(INPUT_POST, 'n', FILTER_VALIDATE_INT, ['options'=>['min_range'=>1]]);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

// Validación básica
$errors = [];
if ($n === false || $n === null) {
    $errors[] = 'El número debe ser un entero positivo (>= 1).';
}
if ($action !== 'primo' && $action !== 'divisores') {
    $errors[] = 'Acción inválida. Elija "primo" o "divisores".';
}

?><!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado - Ejercicio 15/16</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .tested { color:#666; }
    .divisor { color: #0f5132; font-weight:700; }
    </style>
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-3">Resultado - Ejercicio 15/16</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                <?php foreach ($errors as $err): ?>
                    <li><?= h($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <p><a href="Ejercicio16.php" class="btn btn-secondary">Volver al formulario</a></p>
    <?php else: ?>

        <div class="card mb-3">
            <div class="card-body">
                <h5>Entrada</h5>
                <dl class="row">
                    <dt class="col-sm-3">Número</dt><dd class="col-sm-9"><?= h($n) ?></dd>
                    <dt class="col-sm-3">Acción</dt><dd class="col-sm-9"><?= h($action) ?></dd>
                </dl>
            </div>
        </div>

        <?php if ($action === 'primo'): ?>
            <?php
            // Determinar si n es primo mostrando los tests
            if ($n == 1) {
                $isPrime = false;
                $tests = [1];
            } else {
                $isPrime = true;
                $tests = [];
                $limit = (int) floor(sqrt($n));
                for ($i = 2; $i <= $limit; $i++) {
                    $tests[] = $i;
                    if ($n % $i === 0) { $isPrime = false; break; }
                }
            }
            ?>

            <h3>Comprobación de primalidad</h3>
            <?php if ($isPrime): ?>
                <div class="alert alert-success">El número <?= h($n) ?> es <strong>PRIMO</strong>.</div>
            <?php else: ?>
                <div class="alert alert-warning">El número <?= h($n) ?> no es primo.</div>
            <?php endif; ?>

            <div class="mb-3">
                <h5>Pruebas realizadas (divisores probados hasta sqrt(n))</h5>
                <?php if (empty($tests)): ?>
                    <p class="tested">No se realizaron pruebas (n ≤ 1).</p>
                <?php else: ?>
                    <p>
                    <?php foreach ($tests as $t):
                        $isDiv = ($n % $t === 0);
                        if ($isDiv) echo "<span class='divisor'>" . h($t) . "</span> ";
                        else echo "<span class='tested'>" . h($t) . "</span> ";
                    endforeach; ?>
                    </p>
                <?php endif; ?>
            </div>

            <?php if (!$isPrime):
                // mostrar al menos un divisor encontrado
                $divs = [];
                for ($i = 1; $i <= $n; $i++) if ($n % $i === 0) $divs[] = $i;
            ?>
                <div class="mb-3">
                    <h5>Divisores (completos)</h5>
                    <p>
                        <?php foreach ($divs as $d):
                            $cls = ($d == 1 || $d == $n) ? 'badge bg-secondary me-1' : 'badge bg-success me-1';
                            echo "<span class='" . $cls . "'>" . h($d) . "</span> ";
                        endforeach; ?>
                    </p>
                </div>
            <?php endif; ?>

        <?php else: /* divisores */ ?>

            <h3>Divisores y trazado de pruebas</h3>
            <p>Se muestran todos los números probados de 1 a <?= h($n) ?>; los divisores aparecen destacados.</p>
            <p>
            <?php for ($i = 1; $i <= $n; $i++):
                if ($n % $i === 0) echo "<span class='divisor'>" . h($i) . "</span> ";
                else echo "<span class='tested'>" . h($i) . "</span> ";
            endfor; ?>
            </p>

        <?php endif; ?>

        <p class="mt-3"><a href="Ejercicio16.php" class="btn btn-secondary">Volver</a></p>

    <?php endif; ?>

</div>
</body>
</html>
