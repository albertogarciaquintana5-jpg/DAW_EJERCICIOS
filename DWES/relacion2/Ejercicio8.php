
<?php
// Procesamiento de la calculadora (antes de cualquier salida HTML)
error_reporting(E_ALL);
ini_set('display_errors', '1');

$error = '';
$resultado = null;

$num1 = filter_input(INPUT_GET, 'num1', FILTER_VALIDATE_FLOAT);
$num2 = filter_input(INPUT_GET, 'num2', FILTER_VALIDATE_FLOAT);
$operador = filter_input(INPUT_GET, 'operador', FILTER_UNSAFE_RAW);

if ($num1 !== null && $num2 !== null && $operador !== null) {
    // Validación de división por cero
    if (($operador === '/' || $operador === '%') && $num2 == 0) {
        $error = 'Error: División por cero.';
    } else {
        switch ($operador) {
            case '+':
                $resultado = $num1 + $num2;
                break;
            case '-':
                $resultado = $num1 - $num2;
                break;
            case '*':
                $resultado = $num1 * $num2;
                break;
            case '/':
                $resultado = $num1 / $num2;
                break;
            case '%':
                $resultado = $num1 % $num2;
                break;
            default:
                $error = 'Operador no válido.';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 8 - Calculadora</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <style>
        body { background-color: #f8f9fa; }
        .card-calculator { max-width: 640px; margin: 40px auto; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Calculadora PHP</a>
        </div>
    </nav>

    <main class="container">
        <div class="card card-calculator shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Calculadora básica</h5>

                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                <?php elseif ($resultado !== null): ?>
                    <div class="alert alert-success" role="alert">
                        Resultado: <strong><?= htmlspecialchars((string)$num1) ?></strong>
                        <?= htmlspecialchars($operador) ?>
                        <strong><?= htmlspecialchars((string)$num2) ?></strong>
                        = <strong><?= htmlspecialchars((string)$resultado) ?></strong>
                    </div>
                <?php endif; ?>

                            

                <form method="get" class="row g-3">
                    <div class="col-md-5">
                        <label for="num1" class="form-label">Número 1</label>
                        <input type="number" step="any" class="form-control" id="num1" name="num1" required value="<?= isset($num1) ? htmlspecialchars((string)$num1) : '' ?>">
                    </div>

                    <div class="col-md-2 d-flex align-items-end justify-content-center">
                        <select class="form-select" id="operador" name="operador" required>
                            <?php
                            $ops = ['+' => '+', '-' => '-', '*' => '×', '/' => '÷', '%' => '%'];
                            foreach ($ops as $val => $label) {
                                $sel = ($operador === $val) ? ' selected' : '';
                                echo "<option value=\"{$val}\"{$sel}>{$label}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="num2" class="form-label">Número 2</label>
                        <input type="number" step="any" class="form-control" id="num2" name="num2" required value="<?= isset($num2) ? htmlspecialchars((string)$num2) : '' ?>">
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Calcular</button>
                        <a href="./Ejercicio8.php" class="btn btn-outline-secondary ms-2">Borrar</a>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted text-center small">
                Operadores soportados: +, -, × (multiplicación), ÷ (división), % (módulo)
            </div>
        </div>
    </main>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>
</body>
</html>