<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Calculadora</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form method="post" novalidate>
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="numero1" class="form-label">Primer número</label>
                            <input type="number" class="form-control" id="numero1" name="numero1" step="any" required
                                   value="<?php echo isset($_POST['numero1']) ? htmlspecialchars($_POST['numero1']) : ''; ?>">
                            <div class="invalid-feedback">Introduce el primer número.</div>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="operacion" class="form-label">Operación</label>
                            <select class="form-select" id="operacion" name="operacion" required>
                                <option value="" disabled selected>Selecciona operación</option>
                                <option value="suma" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'suma') ? 'selected' : ''; ?>>Suma (+)</option>
                                <option value="resta" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'resta') ? 'selected' : ''; ?>>Resta (-)</option>
                                <option value="multiplicacion" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'multiplicacion') ? 'selected' : ''; ?>>Multiplicación (×)</option>
                                <option value="division" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'division') ? 'selected' : ''; ?>>División (÷)</option>
                            </select>
                            <div class="invalid-feedback">Debes seleccionar una operación.</div>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="numero2" class="form-label">Segundo número</label>
                            <input type="number" class="form-control" id="numero2" name="numero2" step="any" required
                                   value="<?php echo isset($_POST['numero2']) ? htmlspecialchars($_POST['numero2']) : ''; ?>">
                            <div class="invalid-feedback">Introduce el segundo número.</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Calcular</button>
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numero1']) && isset($_POST['numero2']) && isset($_POST['operacion']) && $_POST['operacion'] !== '') {
        
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h2>Resultado del Cálculo</h2>";
        
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $operacion = $_POST['operacion'];
        
        // Validar números
        if (!is_numeric($numero1) || !is_numeric($numero2)) {
            echo "<div class='alert alert-danger'>Ambos valores deben ser números válidos.</div>";
        } else {
            $numero1 = (float)$numero1;
            $numero2 = (float)$numero2;
            
            // Usar match para realizar la operación
            $resultado = match($operacion) {
                'suma' => $numero1 + $numero2,
                'resta' => $numero1 - $numero2,
                'multiplicacion' => $numero1 * $numero2,
                'division' => $numero2 != 0 ? $numero1 / $numero2 : 'Error: División por cero',
                default => 'Operación no válida'
            };
            
            // Usar match para obtener el símbolo de la operación
            $simbolo = match($operacion) {
                'suma' => '+',
                'resta' => '-',
                'multiplicacion' => '×',
                'division' => '÷',
                default => '?'
            };
            
            echo "<div class='alert alert-success'>";
            echo "<h5>Resultado:</h5>";
            echo "<p class='mb-0 display-6'>$numero1 $simbolo $numero2 = <strong>$resultado</strong></p>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>

<script>
// Validación básica del formulario
document.querySelector('form').addEventListener('submit', function (e) {
    const inputNumero1 = document.getElementById('numero1');
    const inputNumero2 = document.getElementById('numero2');
    const selectOperacion = document.getElementById('operacion');
    
    let valid = true;
    
    if (!inputNumero1.value || isNaN(inputNumero1.value)) {
        inputNumero1.classList.add('is-invalid');
        valid = false;
    } else {
        inputNumero1.classList.remove('is-invalid');
    }
    
    if (!inputNumero2.value || isNaN(inputNumero2.value)) {
        inputNumero2.classList.add('is-invalid');
        valid = false;
    } else {
        inputNumero2.classList.remove('is-invalid');
    }
    
    if (!selectOperacion.value || selectOperacion.value === '') {
        selectOperacion.classList.add('is-invalid');
        valid = false;
    } else {
        selectOperacion.classList.remove('is-invalid');
    }

    if (!valid) {
        e.preventDefault();
        e.stopPropagation();
    }
});
</script>

</body>
</html>