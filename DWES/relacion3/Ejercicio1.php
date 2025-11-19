<!DOCTYPE html>
<html>
<head>
    <title>Números Primos</title>
</head>
<body>
    <h1>Números Primos</h1>
    <form method="POST">
        <label>Ingrese un número natural:</label>
        <input type="number" name="numero" min="1" required>
        <button type="submit">Calcular Primos</button>
    </form>

    <?php
    function esPrimo($num) {
        if ($num <= 1) return false;
        if ($num == 2) return true;
        if ($num % 2 == 0) return false;
        
        for ($i = 3; $i <= sqrt($num); $i += 2) {
            if ($num % $i == 0) return false;
        }
        return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero"])) {
        $numero = intval($_POST["numero"]);
        echo "<h2>Resultado:</h2>";
        echo "<p>Números primos entre 1 y $numero:</p>";
        echo "<div style='background-color: #f0f0f0; padding: 10px; border-radius: 5px;'>";
        for ($i = 1; $i <= $numero; $i++) {
            if (esPrimo($i)) {
                echo "<strong>$i </strong>";
            }
        }
        echo "</div>";
    }
    ?>
</body>
</html>