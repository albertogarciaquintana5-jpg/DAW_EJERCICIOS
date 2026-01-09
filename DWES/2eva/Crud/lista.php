<?php include "db.php"; ?>

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
        <th>Acciones</th>
    </tr>

    <?php
    $resultado = $conexion->query("SELECT * FROM usuarios");

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
            <td>{$fila['id']}</td>
            <td>{$fila['nombre']}</td>
            <td>{$fila['apellido']}</td>
            <td>{$fila['fecha']}</td>
            <td>{$fila['telefono']}</td>
            <td>{$fila['email']}</td>
            <td>
                <a href='update.php?id={$fila['id']}'>Editar</a> |
                <a href='delete.php?id={$fila['id']}'>Eliminar</a>
            </td>
          </tr>";
    }
    ?>
</table>