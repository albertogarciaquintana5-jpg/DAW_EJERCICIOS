<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 19 - Conversión Decimal a Otras Bases</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Ejercicio 19 - Conversión Decimal a Otras Bases</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form method="post" novalidate>
                <div class="mb-3">
                    <label for="numeroDecimal" class="form-label">Número decimal (entero positivo)</label>
                    <input type="number" class="form-control" id="numeroDecimal" name="numeroDecimal" min="0" step="1" required
                           value="<?php echo isset($_POST['numeroDecimal']) ? htmlspecialchars($_POST['numeroDecimal']) : ''; ?>">
                    <div class="invalid-feedback">Introduce un número entero positivo (>= 0).</div>
                </div>

                <div class="mb-3">
                    <label for="base" class="form-label">Base de conversión</label>
                    <select class="form-select" id="base" name="base" required>
                        <option value="">Selecciona una base</option>
                        <option value="2" <?php echo (isset($_POST['base']) && $_POST['base'] == '2') ? 'selected' : ''; ?>>Binario (Base 2)</option>
                        <option value="8" <?php echo (isset($_POST['base']) && $_POST['base'] == '8') ? 'selected' : ''; ?>>Octal (Base 8)</option>
                        <option value="16" <?php echo (isset($_POST['base']) && $_POST['base'] == '16') ? 'selected' : ''; ?>>Hexadecimal (Base 16)</option>
                    </select>
                    <div class="invalid-feedback">Selecciona una base válida.</div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Convertir</button>
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numeroDecimal']) && isset($_POST['base'])) {
        
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h2>Resultado de la Conversión</h2>";
        
        $numeroDecimal = $_POST['numeroDecimal'];
        $base = (int)$_POST['base'];
        
        // Validar que el número sea un entero positivo y que la base sea válida
        if (!is_numeric($numeroDecimal) || $numeroDecimal < 0 || floor($numeroDecimal) != $numeroDecimal || !in_array($base, [2, 8, 16])) {
            echo "<div class='alert alert-danger'>El número debe ser un entero positivo y la base debe ser 2, 8 o 16.</div>";
        } else {
            $numeroDecimal = (int)$numeroDecimal;
            
            // Convertir el número decimal a la base especificada
            $numero = $numeroDecimal;
            $resultado = '';
            $pasos = [];
            $digitosHex = '0123456789ABCDEF';

            // Usar match para obtener el nombre de la base
            $nombreBase = match($base) {
                2 => 'binario',
                8 => 'octal',
                16 => 'hexadecimal',
                default => 'desconocida'
            };

            echo "<p class='lead'>Conversión de <strong>$numeroDecimal</strong> a base $base ($nombreBase):</p>";
            
            if ($numero == 0) {
                $resultado = '0';
                $pasos[] = "0 / $base = 0 con resto 0";
            } else {
                while ($numero > 0) {
                    $resto = $numero % $base;
                    $cociente = intdiv($numero, $base);
                    
                    // Usar match para el formato del resto según la base
                    $restoFormateado = match($base) {
                        16 => "$resto ({$digitosHex[$resto]})",
                        default => (string)$resto
                    };
                    
                    if ($base == 16) {
                        $resultado = $digitosHex[$resto] . $resultado;
                    } else {
                        $resultado = $resto . $resultado;
                    }
                    
                    $pasos[] = "$numero / $base = $cociente con resto $restoFormateado";
                    $numero = $cociente;
                }
            }

            // Mostrar los pasos intermedios
            echo "<div class='mb-3'>";
            echo "<h5>Pasos de la conversión:</h5>";
            echo "<div class='list-group'>";
            foreach ($pasos as $paso) {
                echo "<div class='list-group-item'>$paso</div>";
            }
            echo "</div>";
            echo "</div>";

            // Mostrar el resultado final
            echo "<div class='alert alert-success'>";
            echo "<h5>Resultado final:</h5>";
            echo "<p class='mb-0'>El número decimal <strong>$numeroDecimal</strong> en base $base ($nombreBase) es: <strong>$resultado</strong></p>";
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
    const inputNumero = document.getElementById('numeroDecimal');
    const selectBase = document.getElementById('base');
    const valorNumero = Number(inputNumero.value);
    const valorBase = selectBase.value;
    
    let valid = true;
    
    if (!Number.isInteger(valorNumero) || valorNumero < 0 || isNaN(valorNumero)) {
        inputNumero.classList.add('is-invalid');
        valid = false;
    } else {
        inputNumero.classList.remove('is-invalid');
    }
    
    if (valorBase === '' || !['2', '8', '16'].includes(valorBase)) {
        selectBase.classList.add('is-invalid');
        valid = false;
    } else {
        selectBase.classList.remove('is-invalid');
    }

    if (!valid) {
        e.preventDefault();
        e.stopPropagation();
    }
});
</script>

</body>
</html>