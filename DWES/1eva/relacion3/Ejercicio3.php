<!DOCTYPE html>
<html>
<head>
    <title>Máximo Común Divisor</title>
</head>
<body>
    <h1>Máximo Común Divisor (MCD)</h1>
    <form method="POST">
        <label>Primer número:</label>
        <input type="number" name="num1" min="0" required><br><br>
        
        <label>Segundo número:</label>
        <input type="number" name="num2" min="0" required><br><br>
        
        <button type="submit">Calcular MCD</button>
    </form>

    <?php
    function mcdIterativo($a, $b) {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }

    function mcdRecursivo($a, $b) {
        if ($b == 0) {
            return $a;
        }
        return mcdRecursivo($b, $a % $b);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["num1"]) && isset($_POST["num2"])) {
        $num1 = intval($_POST["num1"]);
        $num2 = intval($_POST["num2"]);
        
        echo "<h2>Resultado:</h2>";
        echo "<div style='background-color: #f0f0f0; padding: 10px; border-radius: 5px;'>";
        echo "<p>MCD iterativo de $num1 y $num2: " . mcdIterativo($num1, $num2) . "</p>";
        echo "<p>MCD recursivo de $num1 y $num2: " . mcdRecursivo($num1, $num2) . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>