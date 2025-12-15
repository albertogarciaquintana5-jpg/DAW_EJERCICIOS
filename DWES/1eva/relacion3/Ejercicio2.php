<!DOCTYPE html>
<html>
<head>
    <title>Factorial</title>
</head>
<body>
    <h1>Cálculo de Factorial</h1>
    <form method="POST">
        <label>Ingrese un número natural:</label>
        <input type="number" name="numero" min="0" required>
        <button type="submit">Calcular Factorial</button>
    </form>

    <?php
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero"])) {
        $numero = intval($_POST["numero"]);
        echo "<h2>Resultado:</h2>";
        echo "<div style='background-color: #f0f0f0; padding: 10px; border-radius: 5px;'>";
        echo "<p>Factorial iterativo de $numero: " . factorialIterativo($numero) . "</p>";
        echo "<p>Factorial recursivo de $numero: " . factorialRecursivo($numero) . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>