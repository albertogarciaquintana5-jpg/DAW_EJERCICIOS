<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
 <?php
    // Declaración de un array asociativo constante con los días de la semana y sus temperaturas máximas. Decorarlo con boostrap 5

    
        define('TEMP_MAX_SEMANA', [
            'Lunes' => 22.5,
            'Martes' => 24.0,
            'Miércoles' => 23.5,
            'Jueves' => 25.0,
            'Viernes' => 26.5,
            'Sábado' => 27.0,
            'Domingo' => 24.5
        ]);

        echo '<div class="container mt-5 p-4 border border-2 rounded-3" style="max-width: 400px;">';
        echo '<h2 class="mb-4 text-center">Temperaturas máximas de la semana</h2>';
        echo '<ul class="list-group">';
        foreach (TEMP_MAX_SEMANA as $dia => $temp) {
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>$dia <span class='badge bg-primary rounded-pill'>{$temp}°C</span></li>";
        }
        echo '</ul>';
        echo '</div>';


?>
</body>
</html>