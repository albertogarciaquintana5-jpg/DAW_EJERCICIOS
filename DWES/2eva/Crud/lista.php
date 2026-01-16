
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal con padding -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="mb-4 text-primary">Listado de Usuarios</h2>

                <!-- Botón para crear nuevo usuario -->
                <a href="create.php" class="btn btn-success mb-3">
                    Crear nuevo usuario
                </a>

                <!-- Tabla con estilos Bootstrap -->
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Fecha</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Incluir conexión a BD
                        include "db.php";
                        // Recuperar todos los usuarios
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
                    </tbody>
                </table>

                <!-- Botón volver -->
                <a href="home.php" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
    </div>
</body>
</html>
