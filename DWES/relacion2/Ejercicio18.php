<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 18 - Conversión Decimal a Binario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Ejercicio 18 - Conversión Decimal a Binario</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form action="ejercicio19_process.php" method="post" novalidate>
                <div class="mb-3">
                    <label for="numeroDecimal" class="form-label">Número decimal (entero positivo)</label>
                    <input type="number" class="form-control" id="numeroDecimal" name="numeroDecimal" min="0" step="1" required>
                    <div class="invalid-feedback">Introduce un número entero positivo (>= 0).</div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Convertir a Binario</button>
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numeroDecimal'])) {
        $iNumejercicio = 19;
        
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h2>Resultado de la Conversión</h2>";
        
        $numeroDecimal = $_POST['numeroDecimal'];
        
        // Validar que el número sea un entero positivo
        if (!is_numeric($numeroDecimal) || $numeroDecimal < 0 || floor($numeroDecimal) != $numeroDecimal) {
            echo "<div class='alert alert-danger'>El número debe ser un entero positivo.</div>";
        } else {
            $numeroDecimal = (int)$numeroDecimal;
            
            // Convertir el número decimal a binario
            $numero = $numeroDecimal;
            $binario = '';
            $pasos = [];

            echo "<p class='lead'>Conversión de <strong>$numeroDecimal</strong> a binario:</p>";
            
            if ($numero == 0) {
                $binario = '0';
                $pasos[] = "0 / 2 = 0 con resto 0";
            } else {
                while ($numero > 0) {
                    $resto = $numero % 2;
                    $cociente = intdiv($numero, 2);
                    $binario = $resto . $binario;
                    $pasos[] = "$numero / 2 = $cociente con resto $resto";
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
            echo "<p class='mb-0'>El número decimal <strong>$numeroDecimal</strong> en binario es: <strong>$binario</strong></p>";
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
    const input = document.getElementById('numeroDecimal');
    const valor = Number(input.value);
    
    if (!Number.isInteger(valor) || valor < 0 || isNaN(valor)) {
        input.classList.add('is-invalid');
        e.preventDefault();
        e.stopPropagation();
    } else {
        input.classList.remove('is-invalid');
    }
});
</script>

</body>
</html>