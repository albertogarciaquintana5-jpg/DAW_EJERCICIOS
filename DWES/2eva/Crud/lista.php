
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<h2>Listado de Usuarios</h2>

<a href="create.php">Crear nuevo usuario</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Fecha</th>
        <th>Teléfono</th>
        <th>Email</th>
    </tr>

    <?php
    include "db.php";
    $resultado = $conexion->query("SELECT * FROM usuarios");

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
            <td>{$fila['id']}</td>
            <td>{$fila['nombre']}</td>
            <td>{$fila['apellido']}</td>
            <td>{$fila['fecha']}</td>
            <td>{$fila['telefono']}</td>
            <td>{$fila['email']}</td>
          </tr>";
    }
    ?>
</table>
<br>
<a href="home.php">Volver</a>
</body>
</html>
