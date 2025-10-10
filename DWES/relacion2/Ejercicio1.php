<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- 1- Crea un formulario de entrada para una calculadora en PHP a partir de dos números enteros y un operador. Para la introducción de datos, utilizaremos dos campos de texto y un select que contenga como opción diferentes operadores : +,-,*,/,%. Probaremos el envío mediante los métodos GET y POST y apreciaremos las diferencias -->
    <form action="Ejercicio1.php" method="get">
        <input type="number" name="num1" required>
        <select name="operador" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="%">%</option>
        </select>
        <input type="number" name="num2" required>
        <input type="submit" value="Calcular">
    </form>

    
</body>
</html>
<?php
if (!empty($_GET)) {
    if (isset($_GET['num1']) && isset($_GET['num2']) && isset($_GET['operador'])) {
        $num1 = $_GET['num1'];
        $num2 = $_GET['num2'];
        $operador = $_GET['operador'];
        $resultado = 0;

        $resultado = match ($operador) {
            '+'=> $resultado = $num1 + $num2,
            '-'=> $resultado = $num1 - $num2,
            '*'=> $resultado = $num1 * $num2,
            '/'=> $num2 != 0 ? $resultado = $num1 / $num2 : exit("Error: División por cero."),
            '%'=> $num2 != 0 ? $resultado = $num1 % $num2 : exit("Error: División por cero."),
            default => exit("Operador no válido."),
        };

        /* Alternativa con switch case
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
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                } else {
                    echo "Error: División por cero.";
                    exit;
                }
                break;
            case '%':
                if ($num2 != 0) {
                    $resultado = $num1 % $num2;
                } else {
                    echo "Error: División por cero.";
                    exit;
                }
                break;
            default:
                echo "Operador no válido.";
                exit;
        }
        */

        echo "El resultado de $num1 $operador $num2 es: $resultado";
    }
}
?>