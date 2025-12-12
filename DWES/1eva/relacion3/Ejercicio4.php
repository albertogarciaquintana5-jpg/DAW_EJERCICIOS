<!DOCTYPE html>
<html>
<head>
    <title>Usar Librería</title>
</head>
<body>
    <h1>Prueba de Librería relacion3.php</h1>
    
    <?php
    // Incluir la librería
    include 'relacion3.php';
    
    echo "<h2>Función esPrimo:</h2>";
    echo "<p>Números primos entre 1 y 20:</p>";
    echo "<div style='background-color: #e0f7fa; padding: 10px; border-radius: 5px;'>";
    for ($i = 1; $i <= 20; $i++) {
        if (esPrimo($i)) {
            echo "<strong>$i </strong>";
        }
    }
    echo "</div>";
    
    echo "<h2>Función factorial:</h2>";
    echo "<div style='background-color: #e8f5e9; padding: 10px; border-radius: 5px;'>";
    echo "<p>Factorial de 5:</p>";
    echo "<p>Iterativo: " . factorialIterativo(5) . "</p>";
    echo "<p>Recursivo: " . factorialRecursivo(5) . "</p>";
    echo "</div>";
    
    echo "<h2>Función MCD:</h2>";
    echo "<div style='background-color: #fff3e0; padding: 10px; border-radius: 5px;'>";
    echo "<p>MCD de 48 y 18:</p>";
    echo "<p>Iterativo: " . mcdIterativo(48, 18) . "</p>";
    echo "<p>Recursivo: " . mcdRecursivo(48, 18) . "</p>";
    echo "</div>";
    
    /*
    // Ejemplo de cómo anular una función (comentado):
    function esPrimo($num) {
        // Nueva implementación
        return true;
    }
    */
    ?>
</body>
</html>