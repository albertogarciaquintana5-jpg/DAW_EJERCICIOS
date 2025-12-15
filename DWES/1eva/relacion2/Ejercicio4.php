 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
 <?php

        echo '<div class="container mt-5 p-4 border border-2 rounded-3" style="max-width: 400px;">';
        echo '<h2 class="mb-4 text-center">Números pares del 1 al 100</h2>';

        // Declaración de un array constante con los días de la semana
        define('DIAS_SEMANA', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']);
    
        // Mostrar el primer día de la semana
        echo "<h2>Primer día de la semana:</h2>";
        echo "<p>" . DIAS_SEMANA[0] . "</p>";
    
        // Mostrar todos los días secuencialmente
        echo "<h2>Todos los días secuencialmente:</h2>";
        foreach (DIAS_SEMANA as $dia) {
            echo "<p>$dia</p>";
        }
    
        // Mostrar todos los días en formato de lista numerada
        echo "<h2>Días en formato de lista numerada:</h2>";
        echo '<ol class="list-group list-group-numbered">';
        foreach (DIAS_SEMANA as $dia) {
            echo "<li>$dia</li>";
        }
        echo "</ol>";
        echo '</div>';
    ?>
</body>
</html>

