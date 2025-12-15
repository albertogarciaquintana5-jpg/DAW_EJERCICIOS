<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
 <?php
//Crea una tabla de datos, simulando un listado de personas (nombre, apellido, correo, teléfono, etc…) en PHP con formateo de Bootstrap 5. Experimenta con varios de ellos y quédate con el que prefieras.
    $personas = [
        ['Nombre' => 'Juan', 'Apellido' => 'Pérez', 'Correo' => 'perezdodo@gmail.com', 'Teléfono' => '123456789'],
        ['Nombre' => 'María', 'Apellido' => 'Gómez', 'Correo' => 'Mariaotaku@gmail.com', 'Teléfono' => '987654321'],
        ['Nombre' => 'Luis', 'Apellido' => 'Martínez', 'Correo' => 'Luiscantantemiguel@gmail.com', 'Teléfono' => '456123789'],
        ['Nombre' => 'Ana', 'Apellido' => 'López', 'Correo' => 'Analopez@gmail.com', 'Teléfono' => '321654987'],
    ];
    echo '<div class="container mt-5 p-4 border border-2 rounded-3" style="max-width: 800px;">';
    echo '<h2 class="mb-4 text-center">Listado de Personas</h2>';
    echo '<table class="table table-striped">';
    echo '<thead class="table-dark"><tr><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Teléfono</th></tr></thead>';
    echo '<tbody>';
    foreach ($personas as $persona) {
        echo '<tr>';
        foreach ($persona as $dato) {
            echo "<td>$dato</td>";
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
?>
</body>
</html>